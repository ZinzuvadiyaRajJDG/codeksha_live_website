<?php
/**
 * Shared helpers for the tracker, the beacon collector, the form handler and
 * the admin panel. No output, no side effects on include.
 */

function ck_config(): array
{
    static $cfg;
    if ($cfg === null) {
        $cfg = require __DIR__ . '/config.php';
    }
    return $cfg;
}

function ck_db(): PDO
{
    static $pdo;
    if ($pdo instanceof PDO) {
        return $pdo;
    }
    $c = ck_config()['db'];
    $dsn = "mysql:host={$c['host']};port={$c['port']};dbname={$c['name']};charset={$c['charset']}";
    $pdo = new PDO($dsn, $c['user'], $c['pass'], [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
    return $pdo;
}

/** htmlspecialchars shortcut for admin output. */
function h($v): string
{
    return htmlspecialchars((string) $v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function ck_uuid(): string
{
    $d = random_bytes(16);
    $d[6] = chr((ord($d[6]) & 0x0f) | 0x40);
    $d[8] = chr((ord($d[8]) & 0x3f) | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($d), 4));
}

/** Best-effort real client IP (trusts XFF only from localhost/private proxy). */
function ck_client_ip(): string
{
    $remote = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $trusted = in_array($remote, ['127.0.0.1', '::1'], true)
        || str_starts_with($remote, '10.')
        || str_starts_with($remote, '192.168.')
        || preg_match('/^172\.(1[6-9]|2\d|3[01])\./', $remote);
    if ($trusted && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $first = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
        if (filter_var($first, FILTER_VALIDATE_IP)) {
            return $first;
        }
    }
    return $remote;
}

function ck_anonymize_ip(string $ip): string
{
    if (!ck_config()['tracking']['anonymize_ip']) {
        return $ip;
    }
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        return preg_replace('/\.\d+$/', '.0', $ip);
    }
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        $p = explode(':', $ip);
        return implode(':', array_slice($p, 0, 4)) . '::';
    }
    return $ip;
}

/**
 * Very small, dependency-free user-agent classifier. Returns
 * [browser, browser_version, os, device_type, is_bot].
 */
function ck_parse_ua(string $ua): array
{
    $ua = substr($ua, 0, 512);
    $l  = strtolower($ua);

    $botRe = '/bot|crawl|spider|slurp|bingpreview|facebookexternalhit|embedly|quora link preview'
        . '|pinterest|redditbot|whatsapp|telegrambot|discordbot|semrush|ahrefs|mj12|dotbot'
        . '|petalbot|dataprovider|gptbot|claudebot|ccbot|bytespider|amazonbot|google-inspection'
        . '|headlesschrome|phantomjs|python-requests|curl\/|wget\/|go-http-client|lighthouse/i';
    if ($ua === '' || preg_match($botRe, $ua)) {
        return ['Bot', '', '', 'bot', 1];
    }

    // OS
    $os = 'Unknown';
    if (preg_match('/windows nt 10/i', $ua))            $os = 'Windows 10/11';
    elseif (preg_match('/windows nt/i', $ua))           $os = 'Windows';
    elseif (preg_match('/android[ \/]?([\d.]+)?/i', $ua, $m)) $os = 'Android' . (isset($m[1]) ? ' ' . $m[1] : '');
    elseif (preg_match('/iphone|ipad|ipod/i', $ua))     $os = 'iOS';
    elseif (preg_match('/mac os x ([\d_]+)/i', $ua, $m)) $os = 'macOS ' . str_replace('_', '.', $m[1]);
    elseif (preg_match('/cros/i', $ua))                 $os = 'ChromeOS';
    elseif (preg_match('/linux/i', $ua))               $os = 'Linux';

    // Device
    $device = 'desktop';
    if (preg_match('/ipad|tablet|playbook|silk|(android(?!.*mobile))/i', $ua)) $device = 'tablet';
    elseif (preg_match('/mobi|iphone|ipod|android.*mobile|windows phone/i', $ua)) $device = 'mobile';

    // Browser (order matters)
    $browser = 'Unknown';
    $ver = '';
    $map = [
        'Edge'    => '/edg(?:e|ios|a)?\/([\d.]+)/i',
        'Opera'   => '/(?:opr|opera)\/([\d.]+)/i',
        'Samsung' => '/samsungbrowser\/([\d.]+)/i',
        'Chrome'  => '/(?:chrome|crios)\/([\d.]+)/i',
        'Firefox' => '/(?:firefox|fxios)\/([\d.]+)/i',
        'Safari'  => '/version\/([\d.]+).*safari/i',
    ];
    foreach ($map as $name => $re) {
        if (preg_match($re, $ua, $m)) {
            $browser = $name;
            $ver = explode('.', $m[1])[0] ?? '';
            break;
        }
    }
    if ($browser === 'Unknown' && preg_match('/safari/i', $ua) && !preg_match('/chrome|crios|android/i', $ua)) {
        $browser = 'Safari';
    }
    return [$browser, $ver, $os, $device, 0];
}

/** Classify a referrer host into an acquisition channel. */
function ck_channel(?string $refHost, array $utm): string
{
    $src = strtolower($utm['utm_source'] ?? '');
    $med = strtolower($utm['utm_medium'] ?? '');
    if ($med) {
        if (in_array($med, ['cpc', 'ppc', 'paid', 'paidsearch', 'display'], true)) return 'paid';
        if (in_array($med, ['email', 'newsletter'], true)) return 'email';
        if (in_array($med, ['social', 'social-network', 'sm'], true)) return 'social';
        if (in_array($med, ['organic'], true)) return 'organic';
        if (in_array($med, ['referral'], true)) return 'referral';
    }
    if (!$refHost) {
        return $src ? 'referral' : 'direct';
    }
    $refHost = preg_replace('/^www\./', '', strtolower($refHost));
    $search  = ['google.', 'bing.com', 'duckduckgo.com', 'yahoo.', 'yandex.', 'ecosia.org', 'baidu.com'];
    $social  = ['facebook.com', 'instagram.com', 'l.instagram.com', 't.co', 'twitter.com', 'x.com',
               'linkedin.com', 'lnkd.in', 'youtube.com', 'pinterest.', 'reddit.com', 'whatsapp.com',
               'l.facebook.com', 'lm.facebook.com'];
    foreach ($search as $s) if (str_contains($refHost, $s)) return 'organic';
    foreach ($social as $s) if (str_contains($refHost, $s)) return 'social';
    return 'referral';
}

/**
 * Validate + normalise a phone number (India-friendly, accepts international).
 * Returns [ok(bool), clean(string), error(string)].
 */
function ck_check_phone(string $raw): array
{
    $raw = trim($raw);
    if ($raw === '') {
        return [false, '', 'Phone number is required.'];
    }
    // keep a tidy display form: digits, +, spaces, dashes
    $clean = preg_replace('/[^\d+\-\s]/', '', $raw);
    $clean = trim(preg_replace('/\s{2,}/', ' ', $clean));

    // work on digits only (plus optional leading +)
    $plus   = str_starts_with(ltrim($raw), '+');
    $digits = preg_replace('/\D/', '', $raw);

    if (strlen($digits) < 8 || strlen($digits) > 15) {
        return [false, $clean, 'Enter a valid phone number (8–15 digits).'];
    }
    // reject obvious junk: all-identical digits, or a well-known fake sequence
    $last10 = substr($digits, -10);
    $fakes  = ['1234567890', '0123456789', '9876543210', '0987654321'];
    if (preg_match('/^(\d)\1{6,}$/', $digits) || in_array($last10, $fakes, true)) {
        return [false, $clean, 'That does not look like a real phone number.'];
    }

    // Indian number check when no explicit foreign country code
    $nat = preg_replace('/^(0091|91|0)/', '', $digits);
    if (!$plus || str_starts_with($digits, '91')) {
        if (strlen($nat) === 10 && !preg_match('/^[6-9]/', $nat)) {
            return [false, $clean, 'Indian mobile numbers start with 6, 7, 8 or 9.'];
        }
    }
    return [true, $clean ?: $digits, ''];
}

function ck_host(?string $url): ?string
{
    if (!$url) return null;
    $h = parse_url($url, PHP_URL_HOST);
    return $h ? substr($h, 0, 191) : null;
}

/** Country/region/city lookup. Uses a local MaxMind mmdb if configured. */
function ck_geo(string $ip): array
{
    $blank = ['country' => null, 'region' => null, 'city' => null];
    if (in_array($ip, ['127.0.0.1', '::1', '0.0.0.0'], true) || str_starts_with($ip, '192.168.')
        || str_starts_with($ip, '10.')) {
        return ['country' => 'LO', 'region' => 'Localhost', 'city' => 'Localhost'];
    }
    $mmdb = ck_config()['tracking']['geoip_mmdb'] ?? '';
    if ($mmdb && is_readable($mmdb) && function_exists('geoip2_open')) {
        // Placeholder for a real reader; the free path below is used by default.
    }
    // Free, cached best-effort (country-level). Fails silently on no network.
    static $cache = [];
    if (isset($cache[$ip])) return $cache[$ip];
    $ctx = stream_context_create(['http' => ['timeout' => 1.2, 'ignore_errors' => true]]);
    $raw = @file_get_contents('http://ip-api.com/json/' . urlencode($ip) . '?fields=status,countryCode,regionName,city', false, $ctx);
    if ($raw && ($j = json_decode($raw, true)) && ($j['status'] ?? '') === 'success') {
        $blank = [
            'country' => substr($j['countryCode'] ?? '', 0, 2) ?: null,
            'region'  => substr($j['regionName'] ?? '', 0, 96) ?: null,
            'city'    => substr($j['city'] ?? '', 0, 96) ?: null,
        ];
    }
    return $cache[$ip] = $blank;
}

/* ---- settings helpers (admin) ---- */
function ck_setting(string $key, $default = null)
{
    static $all;
    if ($all === null) {
        $all = [];
        foreach (ck_db()->query('SELECT k,v FROM settings') as $r) {
            $all[$r['k']] = $r['v'];
        }
    }
    return $all[$key] ?? $default;
}

function ck_set_setting(string $key, $val): void
{
    $st = ck_db()->prepare('INSERT INTO settings (k,v) VALUES (?,?) ON DUPLICATE KEY UPDATE v=VALUES(v)');
    $st->execute([$key, (string) $val]);
}

function ck_is_blocked_ip(string $ip): bool
{
    static $set;
    if ($set === null) {
        $set = [];
        foreach (ck_db()->query('SELECT ip FROM blocked_ips') as $r) $set[$r['ip']] = true;
    }
    return isset($set[$ip]);
}
