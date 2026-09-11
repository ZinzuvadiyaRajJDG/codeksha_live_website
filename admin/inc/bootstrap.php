<?php
/**
 * Admin panel bootstrap — session, security headers, auth + CSRF helpers.
 * Every admin page starts with:  require __DIR__ . '/inc/bootstrap.php';
 */
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/inc/lib.php';

$CFG = ck_config();
$ADMIN_CFG = $CFG['admin'];

/* ---------------- security headers ---------------- */
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: same-origin');
header('Cross-Origin-Opener-Policy: same-origin');
header("Content-Security-Policy: default-src 'self'; "
    . "script-src 'self' https://cdnjs.cloudflare.com 'unsafe-inline'; "
    . "style-src 'self' https://fonts.googleapis.com 'unsafe-inline'; "
    . "font-src https://fonts.gstatic.com 'self'; "
    . "img-src 'self' data:; connect-src 'self'; frame-ancestors 'none'; base-uri 'self'; form-action 'self'");

/* ---------------- hardened session ---------------- */
$https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
session_name('ck_admin');
session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/admin/',
    'secure'   => $https,
    'httponly' => true,
    'samesite' => 'Strict',
]);
ini_set('session.use_strict_mode', '1');
session_start();

/* ---------------- helpers ---------------- */
function admin_db(): PDO { return ck_db(); }

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}
function csrf_field(): string
{
    return '<input type="hidden" name="_csrf" value="' . h(csrf_token()) . '">';
}
function csrf_verify(): void
{
    $ok = isset($_POST['_csrf']) && hash_equals($_SESSION['csrf'] ?? '', (string) $_POST['_csrf']);
    if (!$ok) {
        http_response_code(419);
        exit('Security token expired. Go back, reload, and try again.');
    }
}

function admin_log(string $action, string $detail = ''): void
{
    try {
        admin_db()->prepare('INSERT INTO admin_activity (admin_id,admin_username,action,detail,ip,at) VALUES (?,?,?,?,?,NOW())')
            ->execute([
                $_SESSION['uid'] ?? null,
                $_SESSION['uname'] ?? null,
                mb_substr($action, 0, 128),
                mb_substr($detail, 0, 512),
                ck_client_ip(),
            ]);
    } catch (\Throwable $e) { /* ignore */ }
}

function current_admin(): ?array
{
    return $_SESSION['admin'] ?? null;
}
function is_role(string $r): bool
{
    return (($_SESSION['admin']['role'] ?? '') === $r);
}

/**
 * Gate a page. Redirects to login when not authenticated; enforces idle +
 * absolute timeouts and (optionally) IP / user-agent binding.
 */
function require_login(string $needRole = null): void
{
    global $ADMIN_CFG;
    $fail = function (string $why = '') {
        session_unset();
        session_destroy();
        header('Location: /admin/login.php' . ($why ? '?e=' . urlencode($why) : ''));
        exit;
    };

    if (empty($_SESSION['admin']) || empty($_SESSION['login_at'])) {
        $fail();
    }
    if (time() - $_SESSION['login_at'] > $ADMIN_CFG['absolute_timeout']) {
        $fail('expired');
    }
    if (time() - ($_SESSION['seen_at'] ?? 0) > $ADMIN_CFG['idle_timeout']) {
        $fail('idle');
    }
    if (($_SESSION['ua_hash'] ?? '') !== substr(hash('sha256', $_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 32)) {
        $fail();
    }
    if (!empty($ADMIN_CFG['bind_ip']) && ($_SESSION['ip'] ?? '') !== ck_client_ip()) {
        $fail();
    }
    $_SESSION['seen_at'] = time();

    // re-check the account still exists and is active
    $u = admin_db()->prepare('SELECT id,role,is_active FROM admin_users WHERE id=? LIMIT 1');
    $u->execute([$_SESSION['admin']['id']]);
    $row = $u->fetch();
    if (!$row || !$row['is_active']) {
        $fail();
    }
    $_SESSION['admin']['role'] = $row['role'];

    if ($needRole && $row['role'] !== $needRole) {
        http_response_code(403);
        exit('You do not have permission to view this page.');
    }
}

function login_user(array $u): void
{
    session_regenerate_id(true);
    $_SESSION['admin']   = ['id' => (int) $u['id'], 'username' => $u['username'], 'role' => $u['role']];
    $_SESSION['uid']     = (int) $u['id'];
    $_SESSION['uname']   = $u['username'];
    $_SESSION['login_at'] = time();
    $_SESSION['seen_at']  = time();
    $_SESSION['ip']       = ck_client_ip();
    $_SESSION['ua_hash']  = substr(hash('sha256', $_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 32);
    $_SESSION['csrf']     = bin2hex(random_bytes(32));
}

/* ---------------- pagination + filters ---------------- */
function pg_int(string $k, int $def, int $min, int $max): int
{
    $v = (int) ($_GET[$k] ?? $def);
    return max($min, min($v, $max));
}
function q_str(string $k, int $max = 190): string
{
    return mb_substr(trim((string) ($_GET[$k] ?? '')), 0, $max);
}
function range_days(): int
{
    $r = (string) ($_GET['range'] ?? '28');
    return in_array($r, ['1', '7', '28', '90', '365'], true) ? (int) $r : 28;
}

/* Opportunistic data-retention cleanup (once per day, on any admin page load). */
function maybe_cleanup(): void
{
    try {
        $last = ck_setting('last_cleanup');
        if ($last && strtotime($last) > time() - 86400) return;
        ck_set_setting('last_cleanup', date('Y-m-d H:i:s'));
        $days = max(7, (int) ck_setting('retention_days', 90));
        $cut  = date('Y-m-d H:i:s', time() - $days * 86400);
        $db = ck_db();
        $db->prepare('DELETE FROM events    WHERE created_at < ?')->execute([$cut]);
        $db->prepare('DELETE FROM pageviews WHERE created_at < ?')->execute([$cut]);
        $db->prepare('DELETE FROM sessions  WHERE last_activity < ?')->execute([$cut]);
        $db->prepare('DELETE FROM visitors  WHERE last_seen < ? AND id NOT IN (SELECT visitor_id FROM form_submissions WHERE visitor_id IS NOT NULL)')->execute([$cut]);
        $db->prepare('DELETE FROM admin_login_attempts WHERE at < (NOW() - INTERVAL 30 DAY)')->execute();
        $db->prepare('DELETE FROM geo_cache WHERE resolved_at < (NOW() - INTERVAL 60 DAY)')->execute();
    } catch (\Throwable $e) { /* ignore */ }
}
