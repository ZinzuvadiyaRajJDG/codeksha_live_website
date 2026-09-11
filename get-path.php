<?php
/**
 * TEMPORARY diagnostic. Open  https://raj.codeksha.com/get-path.php  once,
 * check everything says OK, then DELETE this file.
 */
header('Content-Type: text/plain; charset=utf-8');
$root = rtrim(str_replace('\\', '/', __DIR__), '/');

echo "Document root      : {$root}\n";
echo "inc/tracker.php    : " . (is_file("$root/inc/tracker.php") ? 'OK' : 'MISSING — upload the inc/ folder') . "\n";
echo "inc/config.php     : " . (is_file("$root/inc/config.php") ? 'OK' : 'MISSING — upload inc/config.php') . "\n";
echo "PHP version        : " . PHP_VERSION . "\n";
echo str_repeat('-', 60) . "\n";

// tracker include present at the top of index.php?
$idx = @file_get_contents("$root/index.php", false, null, 0, 120) ?: '';
echo "index.php loads the tracker : " . (str_contains($idx, 'inc/tracker.php') ? 'OK' : 'NO — re-upload index.php') . "\n";

// DB connection
echo "Database connection        : ";
try {
    $cfg = require "$root/inc/config.php";
    $c = $cfg['db'];
    $pdo = new PDO("mysql:host={$c['host']};port={$c['port']};dbname={$c['name']};charset=utf8mb4", $c['user'], $c['pass']);
    $n = $pdo->query('SELECT COUNT(*) FROM pageviews')->fetchColumn();
    echo "OK  ({$n} page views recorded so far)\n";
} catch (\Throwable $e) {
    echo "FAILED — fix the 'db' section in inc/config.php\n   " . $e->getMessage() . "\n";
}
echo str_repeat('-', 60) . "\n";
echo "If all say OK: open your homepage, View Source (Ctrl+U), search for\n";
echo "\"track.js\" — you should see it just before </body>. Then DELETE this file.\n";
