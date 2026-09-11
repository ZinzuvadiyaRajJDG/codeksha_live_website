<?php
require __DIR__ . '/inc/bootstrap.php';
require_login();
header('Content-Type: application/json');
$db = admin_db();

$active = $db->query(
    "SELECT p.visitor_id, p.path, MAX(p.created_at) last_at,
            v.country, v.city, v.device_type, v.browser, s.channel
     FROM pageviews p
     JOIN visitors v ON v.id = p.visitor_id
     LEFT JOIN sessions s ON s.id = p.session_id
     WHERE p.is_bot=0 AND p.excluded=0 AND p.created_at > (NOW() - INTERVAL 5 MINUTE)
     GROUP BY p.visitor_id
     ORDER BY last_at DESC
     LIMIT 100"
)->fetchAll();

$recent = $db->query(
    "SELECT type, label, path, created_at FROM events
     WHERE is_bot=0 AND excluded=0 AND created_at > (NOW() - INTERVAL 15 MINUTE)
     ORDER BY created_at DESC LIMIT 20"
)->fetchAll();

$pv15 = (int) $db->query("SELECT COUNT(*) FROM pageviews WHERE is_bot=0 AND excluded=0 AND created_at > (NOW() - INTERVAL 15 MINUTE)")->fetchColumn();

echo json_encode([
    'now'     => date('H:i:s'),
    'count'   => count($active),
    'pv15'    => $pv15,
    'active'  => $active,
    'events'  => $recent,
], JSON_UNESCAPED_SLASHES);
