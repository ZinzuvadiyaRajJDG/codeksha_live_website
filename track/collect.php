<?php
/**
 * Beacon collector — receives small JSON payloads from /assets/track.js
 * (navigator.sendBeacon / fetch keepalive) and enriches the row the
 * server-side tracker already created for this page view.
 *
 * Responds 204 always (a tracking endpoint should never leak state).
 */

http_response_code(204);
header('Content-Type: text/plain');
header('Cache-Control: no-store');

require_once __DIR__ . '/../inc/lib.php';

try {
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') return;

    $raw = file_get_contents('php://input', false, null, 0, 16384); // hard size cap
    if (!$raw) return;
    $in = json_decode($raw, true);
    if (!is_array($in)) return;

    $cfg = ck_config();
    if (empty($cfg['tracking']['enabled'])) return;
    if (!empty($cfg['tracking']['respect_dnt']) && ($_SERVER['HTTP_DNT'] ?? '') === '1') return;
    if (($_COOKIE['ck_consent'] ?? '') === 'essential') return;

    $ip = ck_client_ip();
    if (ck_is_blocked_ip($ip)) return;

    $uuid = fn($x) => (is_string($x) && preg_match('/^[0-9a-f-]{36}$/', $x)) ? $x : null;
    $sid  = $uuid($in['sid'] ?? null);
    $vid  = $uuid($in['vid'] ?? null);
    $pvid = $uuid($in['pvid'] ?? null);
    if (!$sid || !$vid) return;

    // cookies must match the claimed ids — stops cross-visitor spoofing
    if (($_COOKIE['ck_sid'] ?? '') !== $sid || ($_COOKIE['ck_vid'] ?? '') !== $vid) return;

    $db = ck_db();
    $sess = $db->prepare('SELECT s.id, s.visitor_id, s.excluded, s.is_bot
                          FROM sessions s WHERE s.sid=? LIMIT 1');
    $sess->execute([$sid]);
    $s = $sess->fetch();
    if (!$s) return;
    $sessionId = (int) $s['id'];
    $visitorId = (int) $s['visitor_id'];
    $isBot = (int) $s['is_bot'];
    $excluded = (int) $s['excluded'];

    $pv = null;
    if ($pvid) {
        $q = $db->prepare('SELECT id FROM pageviews WHERE pvid=? AND session_id=? LIMIT 1');
        $q->execute([$pvid, $sessionId]);
        $pv = $q->fetch();
    }
    $pageviewId = $pv ? (int) $pv['id'] : null;

    $int = fn($x, $max) => max(0, min((int) $x, $max));
    $type = (string) ($in['t'] ?? '');

    if ($type === 'enrich') {
        $sw = $int($in['sw'] ?? 0, 20000);
        $sh = $int($in['sh'] ?? 0, 20000);
        $vw = $int($in['vw'] ?? 0, 20000);
        $vh = $int($in['vh'] ?? 0, 20000);
        $title = mb_substr((string) ($in['title'] ?? ''), 0, 255);
        if ($pageviewId) {
            $db->prepare('UPDATE pageviews SET viewport_w=?, viewport_h=?, title=COALESCE(NULLIF(?,""),title) WHERE id=?')
               ->execute([$vw ?: null, $vh ?: null, $title, $pageviewId]);
        }
        $db->prepare('UPDATE visitors SET screen_w=COALESCE(?,screen_w), screen_h=COALESCE(?,screen_h) WHERE id=?')
           ->execute([$sw ?: null, $sh ?: null, $visitorId]);
        return;
    }

    if ($type === 'pv_update') {
        if (!$pageviewId) return;
        $top = $int($in['top'] ?? 0, 86400);     // seconds on page (cap 24h)
        $scr = $int($in['scr'] ?? 0, 100);       // scroll %
        $db->prepare('UPDATE pageviews
                      SET time_on_page_sec = GREATEST(COALESCE(time_on_page_sec,0), ?),
                          max_scroll_pct   = GREATEST(COALESCE(max_scroll_pct,0), ?)
                      WHERE id=?')
           ->execute([$top, $scr, $pageviewId]);
        // keep the session duration fresh from real engagement
        $db->prepare('UPDATE sessions SET last_activity=NOW(),
                          duration_sec = GREATEST(duration_sec, TIMESTAMPDIFF(SECOND, started_at, NOW()))
                      WHERE id=?')->execute([$sessionId]);
        return;
    }

    if ($type === 'event') {
        $etype  = mb_substr((string) ($in['type'] ?? 'click'), 0, 32);
        $label  = mb_substr((string) ($in['label'] ?? ''), 0, 255);
        $detail = mb_substr((string) ($in['detail'] ?? ''), 0, 512);
        $path   = mb_substr((string) ($in['path'] ?? ''), 0, 512);
        $allowed = ['click', 'outbound', 'download', 'tel', 'mailto', 'cta',
                    'form_start', 'form_abandon', 'form_submit', 'scroll_milestone', 'rage_click'];
        if (!in_array($etype, $allowed, true)) return;

        // light per-session flood guard
        $cnt = $db->prepare('SELECT COUNT(*) FROM events WHERE session_id=? AND created_at > (NOW() - INTERVAL 1 MINUTE)');
        $cnt->execute([$sessionId]);
        if ((int) $cnt->fetchColumn() > 120) return;

        $db->prepare('INSERT INTO events (session_id,visitor_id,pageview_id,type,label,detail,path,created_at,is_bot,excluded)
                      VALUES (?,?,?,?,?,?,?,NOW(),?,?)')
           ->execute([$sessionId, $visitorId, $pageviewId, $etype, $label ?: null, $detail ?: null, $path ?: null, $isBot, $excluded]);
        $db->prepare('UPDATE sessions SET events=events+1, last_activity=NOW() WHERE id=?')->execute([$sessionId]);
        return;
    }
} catch (\Throwable $e) {
    error_log('[ck-collect] ' . $e->getMessage());
}
