<?php
/**
 * Handles the public contact + "become an instructor" form posts.
 * Route:  POST /submit  ->  inc/form-handler.php   (see root .htaccess)
 */

require_once __DIR__ . '/lib.php';
require_once __DIR__ . '/mailer.php';

$wantsJson = str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json')
    || strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'xmlhttprequest';

function ck_form_respond(bool $ok, string $msg, bool $json): void
{
    if ($json) {
        header('Content-Type: application/json');
        echo json_encode(['ok' => $ok, 'message' => $msg]);
        exit;
    }
    $back = $_SERVER['HTTP_REFERER'] ?? (ck_config()['site_url'] . '/');
    $back = strtok($back, '#') . ($ok ? '#sent' : '#error');
    header('Location: ' . $back, true, 303);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    ck_form_respond(false, 'Method not allowed.', $wantsJson);
}

$cfg = ck_config();
$type = in_array($_POST['form_type'] ?? '', ['instructor', 'demo'], true) ? $_POST['form_type'] : 'contact';

// ---- anti-spam -----------------------------------------------------------
$ip = ck_client_ip();

// 1) honeypot
if (trim($_POST['website'] ?? '') !== '') {
    ck_form_respond(true, 'Thanks — we\'ll be in touch.', $wantsJson); // silently drop
}

// 2) signed timing token (rendered by inc/form-fields.php)
$ts  = (int) ($_POST['ts'] ?? 0);
$tok = (string) ($_POST['tok'] ?? '');
$expected = hash_hmac('sha256', $type . '|' . $ts, $cfg['app_key']);
$age = time() - $ts;
if (!hash_equals($expected, $tok) || $age < 2 || $age > 7200) {
    ck_form_respond(false, 'Your session expired. Please reload the page and try again.', $wantsJson);
}

// 3) per-IP rate limit — max 5 submissions / 10 min
try {
    $db = ck_db();
    $rl = $db->prepare('SELECT COUNT(*) FROM form_submissions WHERE ip=? AND created_at > (NOW() - INTERVAL 10 MINUTE)');
    $rl->execute([$ip]);
    if ((int) $rl->fetchColumn() >= 5) {
        ck_form_respond(false, 'Too many submissions. Please try again later.', $wantsJson);
    }
} catch (\Throwable $e) {
    $db = null;
}

// ---- validate ----------------------------------------------------------
$name  = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$errors = [];
$fieldErrors = [];

if (mb_strlen($name) < 2 || mb_strlen($name) > 100)            $errors[] = 'name';
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 190) $errors[] = 'email';

[$phoneOk, $phone, $phoneErr] = ck_check_phone($_POST['phone'] ?? '');
if (!$phoneOk) { $errors[] = 'phone'; $fieldErrors[] = $phoneErr; }

$field2 = null;
if ($type === 'instructor') {
    $field1  = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if (mb_strlen($field1) < 2 || mb_strlen($field1) > 190) $errors[] = 'subject';
    if (mb_strlen($message) < 5 || mb_strlen($message) > 4000) $errors[] = 'message';
} elseif ($type === 'demo') {
    $field1  = trim($_POST['course'] ?? '');           // course they want a demo of
    $field2  = trim($_POST['preferred'] ?? '');        // preferred timing
    $message = trim($_POST['message'] ?? '');          // optional notes
    if (mb_strlen($field1) < 2 || mb_strlen($field1) > 190) $errors[] = 'course';
    if (mb_strlen($field2) > 190) $field2 = mb_substr($field2, 0, 190);
    if (mb_strlen($message) > 4000) $errors[] = 'message';
} else {
    $field1  = null;
    $message = trim($_POST['question'] ?? $_POST['message'] ?? '');
    if (mb_strlen($message) < 5 || mb_strlen($message) > 4000) $errors[] = 'message';
}

if ($errors) {
    $msg = $fieldErrors
        ? implode(' ', $fieldErrors)
        : 'Please check the ' . implode(', ', $errors) . ' field(s).';
    ck_form_respond(false, $msg, $wantsJson);
}

// ---- persist ---------------------------------------------------------
$visitorId = $sessionId = null;
$country = null;
try {
    if (!$db) $db = ck_db();

    $vid = $_COOKIE['ck_vid'] ?? '';
    $sid = $_COOKIE['ck_sid'] ?? '';
    if (preg_match('/^[0-9a-f-]{36}$/', $vid)) {
        $q = $db->prepare('SELECT id,country FROM visitors WHERE uid=? LIMIT 1');
        $q->execute([$vid]);
        if ($row = $q->fetch()) { $visitorId = (int) $row['id']; $country = $row['country']; }
    }
    if (preg_match('/^[0-9a-f-]{36}$/', $sid)) {
        $q = $db->prepare('SELECT id FROM sessions WHERE sid=? LIMIT 1');
        $q->execute([$sid]);
        if ($row = $q->fetch()) $sessionId = (int) $row['id'];
    }

    $pagePath = substr(parse_url($_SERVER['HTTP_REFERER'] ?? '', PHP_URL_PATH) ?? '', 0, 512);

    $ins = $db->prepare(
        'INSERT INTO form_submissions
         (form_type,name,email,phone,field1,field2,message,visitor_id,session_id,page_path,ip,country,ua,status,created_at)
         VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())'
    );
    $ins->execute([
        $type, mb_substr($name, 0, 190), mb_substr($email, 0, 190), mb_substr($phone, 0, 20),
        $field1 ? mb_substr($field1, 0, 190) : null,
        $field2 ? mb_substr($field2, 0, 190) : null, $message,
        $visitorId, $sessionId, $pagePath, ck_anonymize_ip($ip), $country,
        substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 512), 'new',
    ]);
    $id = (int) $db->lastInsertId();

    if ($sessionId) {
        $db->prepare('INSERT INTO events (session_id,visitor_id,type,label,detail,path,created_at)
                      VALUES (?,?,?,?,?,?,NOW())')
           ->execute([$sessionId, $visitorId, 'form_submit', $type . ' form', 'submission #' . $id, $pagePath]);
    }
} catch (\Throwable $e) {
    error_log('[ck-form] ' . $e->getMessage());
    ck_form_respond(false, 'Something went wrong saving your message. Please try again.', $wantsJson);
}

// ---- alert email -----------------------------------------------------
try {
    if (ck_setting('alert_enabled') === '1' && ($to = trim((string) ck_setting('alert_email')))) {
        $label = match ($type) {
            'instructor' => 'instructor application',
            'demo'       => 'free demo class booking',
            default      => 'contact enquiry',
        };
        $lines = [
            "New {$label} on the Codeksha website",
            str_repeat('-', 48),
            "Name:    {$name}",
            "Email:   {$email}",
            "Phone:   {$phone}",
        ];
        if ($type === 'demo') {
            $lines[] = "Course:  " . ($field1 ?: '-');
            if ($field2) $lines[] = "Prefers: {$field2}";
        } elseif ($field1) {
            $lines[] = "Subject: {$field1}";
        }
        $lines[] = "Page:    " . ($pagePath ?: '/');
        $lines[] = "IP:      " . $ip;
        $lines[] = "";
        $lines[] = $message;
        $lines[] = "";
        $lines[] = "Open in admin: " . $cfg['site_url'] . "/admin/submissions.php?id={$id}";
        ck_send_mail($to, "[Codeksha] New {$label} from {$name}", implode("\n", $lines));
    }
} catch (\Throwable $e) {
    error_log('[ck-form-mail] ' . $e->getMessage());
}

ck_form_respond(true, match ($type) {
    'demo'       => 'Thanks — your free demo request is in. We\'ll call or email to confirm your slot shortly.',
    'instructor' => 'Thanks — we\'ve received your application and our team will get back to you soon.',
    default      => 'Thanks — we\'ve received your message and will get back to you shortly.',
}, $wantsJson);
