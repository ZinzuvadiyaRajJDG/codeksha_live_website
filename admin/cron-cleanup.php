<?php
/**
 * Data-retention cleanup. Runs automatically once a day when an admin loads a
 * page, but you can also wire it to a real scheduled task:
 *
 *   Windows Task Scheduler (daily):
 *     "C:\xampp\php\php.exe" "C:\xampp\htdocs\codeksha\admin\cron-cleanup.php"
 */
if (PHP_SAPI !== 'cli') { http_response_code(403); exit('CLI only'); }

require_once __DIR__ . '/../inc/lib.php';

$days = max(7, (int) ck_setting('retention_days', 90));
$cut  = date('Y-m-d H:i:s', time() - $days * 86400);
$db = ck_db();

$e  = $db->prepare('DELETE FROM events    WHERE created_at < ?'); $e->execute([$cut]);
$p  = $db->prepare('DELETE FROM pageviews WHERE created_at < ?'); $p->execute([$cut]);
$s  = $db->prepare('DELETE FROM sessions  WHERE last_activity < ?'); $s->execute([$cut]);
$v  = $db->prepare('DELETE FROM visitors  WHERE last_seen < ? AND id NOT IN (SELECT visitor_id FROM form_submissions WHERE visitor_id IS NOT NULL)');
$v->execute([$cut]);
$db->prepare('DELETE FROM admin_login_attempts WHERE at < (NOW() - INTERVAL 30 DAY)')->execute();
$db->prepare('DELETE FROM geo_cache WHERE resolved_at < (NOW() - INTERVAL 60 DAY)')->execute();

ck_set_setting('last_cleanup', date('Y-m-d H:i:s'));
printf("cleanup done (retention %dd): events -%d, pageviews -%d, sessions -%d, visitors -%d\n",
    $days, $e->rowCount(), $p->rowCount(), $s->rowCount(), $v->rowCount());
