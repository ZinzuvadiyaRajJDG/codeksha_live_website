<?php
require __DIR__ . '/inc/bootstrap.php';

$db = admin_db();
if ((int) $db->query('SELECT COUNT(*) FROM admin_users')->fetchColumn() === 0) {
    header('Location: /admin/setup.php');
    exit;
}
if (current_admin()) {
    header('Location: /admin/index.php');
    exit;
}

$ip = ck_client_ip();
$err = '';
$notice = match ($_GET['e'] ?? '') {
    'idle'    => 'You were signed out after 30 minutes of inactivity.',
    'expired' => 'Your session reached its time limit. Please sign in again.',
    'created' => 'Admin account created — sign in to continue.',
    'bye'     => 'You have been signed out.',
    default   => '',
};

// rate-limit check
$win = $ADMIN_CFG['login_window'];
$max = $ADMIN_CFG['login_max_fails'];
$rl = $db->prepare('SELECT COUNT(*) FROM admin_login_attempts WHERE ip=? AND ok=0 AND at > (NOW() - INTERVAL ? SECOND)');
$rl->execute([$ip, $win]);
$fails = (int) $rl->fetchColumn();
$locked = $fails >= $max;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$locked) {
    csrf_verify();
    usleep(300000); // constant-ish delay
    $u = trim($_POST['username'] ?? '');
    $p = (string) ($_POST['password'] ?? '');

    $st = $db->prepare('SELECT * FROM admin_users WHERE username=? LIMIT 1');
    $st->execute([$u]);
    $row = $st->fetch();

    $ok = $row && $row['is_active'] && password_verify($p, $row['password_hash']);
    $db->prepare('INSERT INTO admin_login_attempts (ip,username,ok,at) VALUES (?,?,?,NOW())')
       ->execute([$ip, mb_substr($u, 0, 64), $ok ? 1 : 0]);

    if ($ok) {
        if (password_needs_rehash($row['password_hash'], PASSWORD_DEFAULT)) {
            $db->prepare('UPDATE admin_users SET password_hash=? WHERE id=?')
               ->execute([password_hash($p, PASSWORD_DEFAULT), $row['id']]);
        }
        $db->prepare('UPDATE admin_users SET last_login_at=NOW(), last_login_ip=? WHERE id=?')->execute([$ip, $row['id']]);
        login_user($row);
        admin_log('login', 'ok');
        header('Location: ' . (($row['force_password_change'] ?? 0) ? '/admin/settings.php?pw=1' : '/admin/index.php'));
        exit;
    }
    $err = 'Incorrect username or password.';
    $fails++;
    $locked = $fails >= $max;
}
?><!doctype html><html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/png" href="/Images/fevicon.png">
    <link rel="apple-touch-icon" href="/Images/fevicon.png">
<meta name="robots" content="noindex,nofollow"><title>Sign in · Codeksha Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/admin.css"></head><body>
<div class="login-wrap"><form class="login-card" method="post" autocomplete="off">
  <img src="/Images/Codeksha-Logo.png" alt="Codeksha">
  <h1>Admin sign in</h1>
  <p class="sub">Codeksha website control panel</p>
  <?php if ($notice): ?><div class="flash ok"><?= h($notice) ?></div><?php endif; ?>
  <?php if ($err): ?><div class="flash err"><?= h($err) ?></div><?php endif; ?>
  <?php if ($locked): ?>
    <div class="flash err">Too many failed attempts. Try again in <?= (int) ceil($win / 60) ?> minutes.</div>
  <?php endif; ?>
  <?= csrf_field() ?>
  <div class="field"><label>Username</label><input name="username" required autofocus <?= $locked ? 'disabled' : '' ?>></div>
  <div class="field"><label>Password</label><input type="password" name="password" required <?= $locked ? 'disabled' : '' ?>></div>
  <button class="btn" <?= $locked ? 'disabled' : '' ?>>Sign in</button>
</form></div></body></html>
