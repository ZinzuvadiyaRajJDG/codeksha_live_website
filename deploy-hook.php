<?php
/**
 * GitHub push webhook -> deploys the site to this web root.
 *
 * Setup (once, on the live server only):
 *   1. cPanel > Git Version Control: clone the repo to  ~/repositories/codeksha
 *   2. add  'deploy_secret' => '<long random string>',  to the live inc/config.php
 *   3. GitHub > repo > Settings > Webhooks > Add:  https://codeksha.com/deploy-hook/
 *      Content type application/json, same secret, "Just the push event".
 *
 * Only requests signed with the secret (HMAC-SHA256) and for refs/heads/main are accepted.
 * No part of the request is ever used in a shell command.
 */
header('Content-Type: application/json');
header('X-Robots-Tag: noindex');

function ck_hook_end(int $code, string $msg): void
{
    http_response_code($code);
    echo json_encode(['ok' => $code === 200, 'message' => $msg]);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') ck_hook_end(405, 'POST only.');

$cfg = is_file(__DIR__ . '/inc/config.php') ? (require __DIR__ . '/inc/config.php') : [];
$secret = (string) ($cfg['deploy_secret'] ?? '');
if (strlen($secret) < 16) ck_hook_end(503, 'Deploy hook is not configured.');

$body = (string) file_get_contents('php://input');
$sig  = (string) ($_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '');
if (!hash_equals('sha256=' . hash_hmac('sha256', $body, $secret), $sig)) ck_hook_end(403, 'Bad signature.');

$event = (string) ($_SERVER['HTTP_X_GITHUB_EVENT'] ?? '');
if ($event === 'ping') ck_hook_end(200, 'pong - webhook is connected.');
if ($event !== 'push') ck_hook_end(200, 'Ignored event: ' . $event);

$payload = json_decode($body, true);
if (($payload['ref'] ?? '') !== 'refs/heads/main') ck_hook_end(200, 'Ignored: not the main branch.');

$webroot = __DIR__;
$repo    = dirname($webroot) . '/repositories/codeksha';
if (!is_dir($repo . '/.git')) ck_hook_end(500, 'Repository clone not found at ~/repositories/codeksha.');
if (!function_exists('exec')) ck_hook_end(500, 'exec() is disabled on this host.');

// one deploy at a time
$lock = fopen(sys_get_temp_dir() . '/ck-deploy.lock', 'c');
if (!$lock || !flock($lock, LOCK_EX | LOCK_NB)) ck_hook_end(200, 'A deploy is already running.');

putenv('HOME=' . dirname($webroot));
$r = escapeshellarg($repo);
$steps = [
    "git -C $r fetch --quiet origin main",
    "git -C $r reset --hard --quiet origin/main",
    // copy into the web root; never deletes, never touches the live config
    "/bin/rsync -rlptD --exclude='.git' --exclude='.gitignore' --exclude='.cpanel.yml' --exclude='inc/config.php' --exclude='db/' --exclude='*.md' $r/ " . escapeshellarg($webroot . '/'),
];
$log = [];
foreach ($steps as $cmd) {
    $out = [];
    exec($cmd . ' 2>&1', $out, $code);
    $log[] = '$ ' . $cmd . "\n" . implode("\n", $out);
    if ($code !== 0) {
        @file_put_contents(dirname($repo) . '/deploy-hook.log', date('c') . " FAILED\n" . implode("\n", $log) . "\n\n", FILE_APPEND);
        ck_hook_end(500, 'Deploy failed - see ~/repositories/deploy-hook.log');
    }
}
$sha = substr((string) ($payload['after'] ?? ''), 0, 7);
@file_put_contents(dirname($repo) . '/deploy-hook.log', date('c') . " OK {$sha}\n", FILE_APPEND);
ck_hook_end(200, 'Deployed ' . $sha);
