<?php
/**
 * First-party analytics tracker.
 *
 * Loaded by one line at the very top of every public page
 *   <?php require __DIR__ . '/inc/tracker.php'; ?>
 * (or via auto_prepend_file where the host supports it).
 *
 * It must NEVER emit output on its own, NEVER fatal, and add negligible
 * latency (all DB work is deferred to shutdown).
 */

// Run at most once per request, and only if the rest of the code is present.
if (defined('CK_TRACKER_RAN')) {
    return;
}
define('CK_TRACKER_RAN', true);
if (!is_file(__DIR__ . '/lib.php') || !is_file(__DIR__ . '/config.php')) {
    return;
}

(function () {
    if (PHP_SAPI === 'cli') return;

    $uri  = $_SERVER['REQUEST_URI'] ?? '/';
    $path = strtok($uri, '?') ?: '/';

    // Never track the admin panel, the collector, includes or static assets.
    foreach (['/admin', '/track', '/inc/', '/db/', '/assets/', '/Images/', '/favicon'] as $skip) {
        if (str_starts_with($path, $skip)) return;
    }
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET') return;

    // Only real page loads (not fetch()/asset requests that slip through).
    $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
    if ($accept !== '' && !str_contains($accept, 'text/html') && !str_contains($accept, '*/*')) return;
    if (preg_match('/\.(css|js|json|xml|txt|map|jpe?g|png|gif|webp|svg|ico|woff2?|ttf|mp4|pdf)$/i', $path)) return;

    require_once __DIR__ . '/lib.php';

    $cfg = ck_config();
    if (empty($cfg['tracking']['enabled'])) return;
    if (!empty($cfg['tracking']['respect_dnt']) && ($_SERVER['HTTP_DNT'] ?? '') === '1') return;
    // visitor rejected non-essential cookies via the consent banner
    if (($_COOKIE['ck_consent'] ?? '') === 'essential') return;

    $ip = ck_client_ip();
    if (ck_try(fn() => ck_is_blocked_ip($ip))) return;

    // ---- cookies (headers not sent yet at prepend time) -------------------
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https';
    $base = ['path' => '/', 'secure' => $secure, 'httponly' => true, 'samesite' => 'Lax'];

    $vid = $_COOKIE['ck_vid'] ?? '';
    if (!preg_match('/^[0-9a-f-]{36}$/', $vid)) {
        $vid = ck_uuid();
    }
    setcookie('ck_vid', $vid, ['expires' => time() + 31536000] + $base);

    $sid = $_COOKIE['ck_sid'] ?? '';
    $newSession = !preg_match('/^[0-9a-f-]{36}$/', $sid);
    if ($newSession) {
        $sid = ck_uuid();
    }
    setcookie('ck_sid', $sid, ['expires' => time() + (int) $cfg['tracking']['session_timeout']] + $base);

    $pvid = ck_uuid();

    // ---- expose ids to the browser beacon --------------------------------
    $GLOBALS['__ck'] = compact('vid', 'sid', 'pvid');
    if (function_exists('ob_start')) {
        ob_start();
    }

    // ---- capture the request context now, write to DB on shutdown --------
    $ctx = [
        'vid'      => $vid,
        'sid'      => $sid,
        'pvid'     => $pvid,
        'ip'       => ck_anonymize_ip($ip),
        'ua'       => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 512),
        'path'     => substr($path, 0, 512),
        'query'    => substr((string) parse_url($uri, PHP_URL_QUERY), 0, 512),
        'referrer' => substr($_SERVER['HTTP_REFERER'] ?? '', 0, 512),
        'get'      => $_GET,
        'time'     => date('Y-m-d H:i:s'),
        'excluded' => ck_traffic_excluded($ip),
    ];

    register_shutdown_function('ck_track_finish', $ctx);
})();

/* ===================================================================== */

function ck_try(callable $fn, $fallback = null)
{
    try { return $fn(); } catch (\Throwable $e) { return $fallback; }
}

function ck_traffic_excluded(string $ip): int
{
    $list = array_filter(array_map('trim', explode(',', (string) ck_try(fn() => ck_setting('exclude_ips', '')))));
    return in_array($ip, $list, true) ? 1 : 0;
}

/** Inject the beacon <script> into the buffered HTML, then write the pageview. */
function ck_track_finish(array $c): void
{
    // 1) inject beacon into the page output
    if (function_exists('ob_get_level') && ob_get_level() > 0) {
        $parts = [];
        while (ob_get_level() > 0) {
            $parts[] = ob_get_clean();
        }
        $html = implode('', array_reverse($parts));
        $ctype = '';
        foreach (headers_list() as $hh) {
            if (stripos($hh, 'content-type:') === 0) $ctype = strtolower($hh);
        }
        $isHtml = $ctype === '' || str_contains($ctype, 'text/html');
        if ($isHtml && stripos($html, '</body>') !== false) {
            $boot = '<script>window.__CK=' . json_encode([
                'sid'  => $c['sid'],
                'vid'  => $c['vid'],
                'pvid' => $c['pvid'],
                'ep'   => '/track/collect.php',
            ], JSON_UNESCAPED_SLASHES) . ';</script>' . "\n"
                . '<script src="/assets/track.js" defer></script>' . "\n"
                . '<script src="/assets/consent.js" defer></script>' . "\n";
            $html = preg_replace('/<\/body>/i', $boot . '</body>', $html, 1);
        }
        echo $html;
    }

    // 2) persist (fully guarded — a tracking failure must not surface anywhere)
    try {
        $db = ck_db();
        $now = $c['time'];
        [$browser, $bver, $os, $device, $isBot] = ck_parse_ua($c['ua']);
        $refHost = ck_host($c['referrer'] ?: null);
        $utm = [
            'utm_source'   => substr((string) ($c['get']['utm_source'] ?? ''), 0, 128) ?: null,
            'utm_medium'   => substr((string) ($c['get']['utm_medium'] ?? ''), 0, 128) ?: null,
            'utm_campaign' => substr((string) ($c['get']['utm_campaign'] ?? ''), 0, 191) ?: null,
            'utm_term'     => substr((string) ($c['get']['utm_term'] ?? ''), 0, 191) ?: null,
            'utm_content'  => substr((string) ($c['get']['utm_content'] ?? ''), 0, 191) ?: null,
        ];
        $channel = ck_channel($refHost, $utm);
        $excluded = (int) $c['excluded'];

        // -- visitor --------------------------------------------------------
        $v = $db->prepare('SELECT id,country FROM visitors WHERE uid=? LIMIT 1');
        $v->execute([$c['vid']]);
        $visitor = $v->fetch();

        $geo = ['country' => null, 'region' => null, 'city' => null];
        if (!$visitor || $visitor['country'] === null) {
            $geo = ck_geo_cached($c['ip']);
        }

        if (!$visitor) {
            $ins = $db->prepare(
                'INSERT INTO visitors
                 (uid,first_seen,last_seen,visits,pageviews,first_landing,first_referrer,first_referrer_host,
                  first_utm_source,first_utm_medium,first_utm_campaign,first_utm_term,first_utm_content,
                  ip,country,region,city,ua,browser,browser_version,os,device_type,is_bot,excluded)
                 VALUES (?,?,?,1,0,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)'
            );
            $ins->execute([
                $c['vid'], $now, $now, $c['path'], $c['referrer'] ?: null, $refHost,
                $utm['utm_source'], $utm['utm_medium'], $utm['utm_campaign'], $utm['utm_term'], $utm['utm_content'],
                $c['ip'], $geo['country'], $geo['region'], $geo['city'],
                $c['ua'], $browser, $bver, $os, $device, $isBot, $excluded,
            ]);
            $visitorId = (int) $db->lastInsertId();
        } else {
            $visitorId = (int) $visitor['id'];
            $db->prepare('UPDATE visitors SET last_seen=?, ip=?, country=COALESCE(country,?), region=COALESCE(region,?), city=COALESCE(city,?) WHERE id=?')
               ->execute([$now, $c['ip'], $geo['country'], $geo['region'], $geo['city'], $visitorId]);
        }

        // -- session -------------------------------------------------------
        $s = $db->prepare('SELECT id,started_at,pageviews FROM sessions WHERE sid=? LIMIT 1');
        $s->execute([$c['sid']]);
        $session = $s->fetch();

        if (!$session) {
            $db->prepare(
                'INSERT INTO sessions
                 (sid,visitor_id,started_at,last_activity,pageviews,entry_path,referrer,referrer_host,
                  utm_source,utm_medium,utm_campaign,channel,is_bot,excluded,country,device_type)
                 VALUES (?,?,?,?,1,?,?,?,?,?,?,?,?,?,?,?)'
            )->execute([
                $c['sid'], $visitorId, $now, $now, $c['path'], $c['referrer'] ?: null, $refHost,
                $utm['utm_source'], $utm['utm_medium'], $utm['utm_campaign'], $channel,
                $isBot, $excluded, $geo['country'], $device,
            ]);
            $sessionId = (int) $db->lastInsertId();
            // returning visitor starting a fresh session -> bump visit count
            if ($visitor) {
                $db->prepare('UPDATE visitors SET visits=visits+1 WHERE id=?')->execute([$visitorId]);
            }
            $isEntry = 1;
        } else {
            $sessionId = (int) $session['id'];
            $dur = max(0, strtotime($now) - strtotime($session['started_at']));
            $db->prepare('UPDATE sessions SET last_activity=?, duration_sec=?, pageviews=pageviews+1, is_bounce=0, exit_path=? WHERE id=?')
               ->execute([$now, $dur, $c['path'], $sessionId]);
            $isEntry = 0;
        }

        // -- pageview -----------------------------------------------------
        $db->prepare(
            'INSERT INTO pageviews
             (pvid,session_id,visitor_id,path,query,referrer,created_at,is_entry,is_bot,excluded)
             VALUES (?,?,?,?,?,?,?,?,?,?)'
        )->execute([
            $c['pvid'], $sessionId, $visitorId, $c['path'], $c['query'] ?: null,
            $c['referrer'] ?: null, $now, $isEntry, $isBot, $excluded,
        ]);

        $db->prepare('UPDATE visitors SET pageviews=pageviews+1 WHERE id=?')->execute([$visitorId]);
    } catch (\Throwable $e) {
        // swallow — never break the site because analytics hiccuped
        error_log('[ck-tracker] ' . $e->getMessage());
    }
}

function ck_geo_cached(string $ip): array
{
    $blank = ['country' => null, 'region' => null, 'city' => null];
    try {
        $db = ck_db();
        $q = $db->prepare('SELECT country,region,city FROM geo_cache WHERE ip=? LIMIT 1');
        $q->execute([$ip]);
        if ($row = $q->fetch()) {
            return $row;
        }
        $geo = ck_geo($ip);
        $db->prepare('INSERT INTO geo_cache (ip,country,region,city,resolved_at) VALUES (?,?,?,?,NOW())
                      ON DUPLICATE KEY UPDATE country=VALUES(country),region=VALUES(region),city=VALUES(city),resolved_at=NOW()')
           ->execute([$ip, $geo['country'], $geo['region'], $geo['city']]);
        return $geo;
    } catch (\Throwable $e) {
        return $blank;
    }
}
