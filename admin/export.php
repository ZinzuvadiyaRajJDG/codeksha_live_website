<?php
require __DIR__ . '/inc/bootstrap.php';
require_login();
require __DIR__ . '/inc/stats.php';
$db = admin_db();

$type = $_GET['type'] ?? '';
$maps = [
    'visitors'   => 'SELECT id,uid,first_seen,last_seen,visits,pageviews,country,region,city,ip,device_type,browser,browser_version,os,first_referrer_host,first_utm_source,first_utm_medium,first_utm_campaign,is_bot FROM visitors ORDER BY last_seen DESC LIMIT 50000',
    'sessions'   => 'SELECT id,sid,visitor_id,started_at,duration_sec,pageviews,events,channel,referrer_host,utm_source,utm_medium,utm_campaign,entry_path,exit_path,is_bounce,country,device_type FROM sessions ORDER BY started_at DESC LIMIT 50000',
    'pageviews'  => 'SELECT id,session_id,visitor_id,path,query,title,created_at,time_on_page_sec,max_scroll_pct,viewport_w,viewport_h,is_entry,referrer FROM pageviews ORDER BY created_at DESC LIMIT 50000',
    'events'     => 'SELECT id,session_id,visitor_id,type,label,detail,path,created_at FROM events ORDER BY created_at DESC LIMIT 50000',
    'submissions'=> 'SELECT id,form_type,name,email,phone,field1,field2,message,extra_json,status,page_path,ip,country,created_at,admin_notes FROM form_submissions WHERE form_type<>\'walkin\' ORDER BY created_at DESC LIMIT 50000',
];
$maps['walkins'] = "SELECT id,created_at,name,phone,email,field1 AS course,field2 AS interests,JSON_UNQUOTE(JSON_EXTRACT(extra_json,'$.status')) AS currently,JSON_UNQUOTE(JSON_EXTRACT(extra_json,'$.qualification')) AS qualification,JSON_UNQUOTE(JSON_EXTRACT(extra_json,'$.goal')) AS goal,JSON_UNQUOTE(JSON_EXTRACT(extra_json,'$.start')) AS plans_to_start,JSON_UNQUOTE(JSON_EXTRACT(extra_json,'$.batch')) AS batch,JSON_UNQUOTE(JSON_EXTRACT(extra_json,'$.city')) AS city,JSON_UNQUOTE(JSON_EXTRACT(extra_json,'$.source')) AS heard_via,message AS notes,status,admin_notes FROM form_submissions WHERE form_type='walkin' ORDER BY created_at DESC LIMIT 50000";
if (!isset($maps[$type])) { http_response_code(400); exit('Unknown export type'); }

admin_log('export', $type);

$stmt = $db->query($maps[$type]);
$file = 'codeksha-' . $type . '-' . date('Ymd-His') . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $file . '"');

$out = fopen('php://output', 'w');
fwrite($out, "\xEF\xBB\xBF"); // UTF-8 BOM for Excel
$first = true;
foreach ($stmt as $row) {
    if ($first) { fputcsv($out, array_keys($row)); $first = false; }
    fputcsv($out, $row);
}
if ($first) fputcsv($out, ['no data']);
fclose($out);
