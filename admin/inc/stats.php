<?php
/** Aggregate queries for the dashboard. All exclude bots + filtered traffic. */

function st_since(int $days): string
{
    return date('Y-m-d H:i:s', time() - $days * 86400);
}

/** KPI block for a window, plus deltas vs the preceding equal window. */
function st_kpis(int $days): array
{
    $db = admin_db();
    $now = date('Y-m-d H:i:s');
    $a = st_since($days);
    $b = st_since($days * 2);

    $one = function (string $sql, array $p) use ($db) {
        $s = $db->prepare($sql); $s->execute($p); return (float) $s->fetchColumn();
    };
    $F = 'is_bot=0 AND excluded=0';

    $cur = [
        'visitors'  => $one("SELECT COUNT(DISTINCT visitor_id) FROM pageviews WHERE $F AND created_at>=?", [$a]),
        'new'       => $one("SELECT COUNT(*) FROM visitors WHERE is_bot=0 AND excluded=0 AND first_seen>=?", [$a]),
        'sessions'  => $one("SELECT COUNT(*) FROM sessions WHERE $F AND started_at>=?", [$a]),
        'pageviews' => $one("SELECT COUNT(*) FROM pageviews WHERE $F AND created_at>=?", [$a]),
        'avgdur'    => $one("SELECT AVG(duration_sec) FROM sessions WHERE $F AND started_at>=? AND pageviews>1", [$a]),
        'bounce'    => $one("SELECT AVG(is_bounce)*100 FROM sessions WHERE $F AND started_at>=?", [$a]),
    ];
    $prev = [
        'visitors'  => $one("SELECT COUNT(DISTINCT visitor_id) FROM pageviews WHERE $F AND created_at>=? AND created_at<?", [$b, $a]),
        'new'       => $one("SELECT COUNT(*) FROM visitors WHERE is_bot=0 AND excluded=0 AND first_seen>=? AND first_seen<?", [$b, $a]),
        'sessions'  => $one("SELECT COUNT(*) FROM sessions WHERE $F AND started_at>=? AND started_at<?", [$b, $a]),
        'pageviews' => $one("SELECT COUNT(*) FROM pageviews WHERE $F AND created_at>=? AND created_at<?", [$b, $a]),
        'avgdur'    => $one("SELECT AVG(duration_sec) FROM sessions WHERE $F AND started_at>=? AND started_at<? AND pageviews>1", [$b, $a]),
        'bounce'    => $one("SELECT AVG(is_bounce)*100 FROM sessions WHERE $F AND started_at>=? AND started_at<?", [$b, $a]),
    ];
    return ['cur' => $cur, 'prev' => $prev];
}

function st_delta(float $cur, float $prev): array
{
    if ($prev <= 0) return ['flat', $cur > 0 ? '+new' : '—'];
    $p = round((($cur - $prev) / $prev) * 100);
    return [$p > 0 ? 'up' : ($p < 0 ? 'down' : 'flat'), ($p > 0 ? '+' : '') . $p . '%'];
}

/** Daily new vs returning visitors for the chart. */
function st_daily(int $days): array
{
    $db = admin_db();
    $a = date('Y-m-d', time() - ($days - 1) * 86400);
    $labels = $newv = $ret = [];
    for ($i = 0; $i < $days; $i++) {
        $labels[date('Y-m-d', strtotime("$a +$i day"))] = 0;
    }
    $newv = $ret = $labels;

    $q = $db->prepare("SELECT DATE(first_seen) d, COUNT(*) c FROM visitors
        WHERE is_bot=0 AND excluded=0 AND first_seen>=? GROUP BY d");
    $q->execute([$a . ' 00:00:00']);
    foreach ($q as $r) if (isset($newv[$r['d']])) $newv[$r['d']] = (int) $r['c'];

    $q = $db->prepare("SELECT DATE(s.started_at) d, COUNT(DISTINCT s.visitor_id) c
        FROM sessions s JOIN visitors v ON v.id=s.visitor_id
        WHERE s.is_bot=0 AND s.excluded=0 AND s.started_at>=? AND v.first_seen < DATE(s.started_at)
        GROUP BY d");
    $q->execute([$a . ' 00:00:00']);
    foreach ($q as $r) if (isset($ret[$r['d']])) $ret[$r['d']] = (int) $r['c'];

    return [
        'labels' => array_map(fn($d) => date('M j', strtotime($d)), array_keys($labels)),
        'new'    => array_values($newv),
        'ret'    => array_values($ret),
    ];
}

function st_top(string $sql, array $p, int $limit = 8): array
{
    $db = admin_db();
    $s = $db->prepare($sql . ' LIMIT ' . (int) $limit);
    $s->execute($p);
    return $s->fetchAll();
}

function st_live_count(): int
{
    return (int) admin_db()->query(
        "SELECT COUNT(DISTINCT visitor_id) FROM pageviews
         WHERE is_bot=0 AND excluded=0 AND created_at > (NOW() - INTERVAL 5 MINUTE)"
    )->fetchColumn();
}

function fmt_dur(?float $s): string
{
    $s = (int) round($s ?? 0);
    if ($s < 60) return $s . 's';
    if ($s < 3600) return floor($s / 60) . 'm ' . ($s % 60) . 's';
    return floor($s / 3600) . 'h ' . floor(($s % 3600) / 60) . 'm';
}
function fmt_ago(string $ts): string
{
    $d = time() - strtotime($ts);
    if ($d < 60) return $d . 's ago';
    if ($d < 3600) return floor($d / 60) . 'm ago';
    if ($d < 86400) return floor($d / 3600) . 'h ago';
    return floor($d / 86400) . 'd ago';
}
