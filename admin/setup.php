<?php
/** First-run: create the initial admin account. Self-disables once one exists. */
require __DIR__ . '/inc/bootstrap.php';

$db = admin_db();
$count = (int) $db->query('SELECT COUNT(*) FROM admin_users')->fetchColumn();
if ($count > 0) {
    header('Location: /admin/login.php');
    exit;
}

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $u  = trim($_POST['username'] ?? '');
    $p  = (string) ($_POST['password'] ?? '');
    $p2 = (string) ($_POST['password2'] ?? '');
    if (!preg_match('/^[a-zA-Z0-9_.-]{3,64}$/', $u)) {
        $err = 'Username: 3-64 chars, letters/digits/._- only.';
    } elseif (strlen($p) < 10) {
        $err = 'Password must be at least 10 characters.';
    } elseif ($p !== $p2) {
        $err = 'Passwords do not match.';
    } else {
        $db->prepare('INSERT INTO admin_users (username,password_hash,role,is_active,created_at) VALUES (?,?,?,1,NOW())')
           ->execute([$u, password_hash($p, PASSWORD_DEFAULT), 'admin']);
        admin_log('setup', "created first admin '$u'");
        header('Location: /admin/login.php?e=created');
        exit;
    }
}
?><!doctype html><html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/png" href="/Images/fevicon.png">
    <link rel="apple-touch-icon" href="/Images/fevicon.png">
<meta name="robots" content="noindex,nofollow"><title>Set up admin · Codeksha</title>
<link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/admin.css"></head><body>
<div class="login-wrap"><form class="login-card" method="post">
  <img src="/Images/Codeksha-Logo.png" alt="Codeksha">
  <h1>Create admin account</h1>
  <p class="sub">This one-time page is only available until the first account exists.</p>
  <?php if ($err): ?><div class="flash err"><?= h($err) ?></div><?php endif; ?>
  <?= csrf_field() ?>
  <div class="field"><label>Username</label><input name="username" required autofocus value="<?= h($_POST['username'] ?? '') ?>"></div>
  <div class="field"><label>Password (min 10 chars)</label><input type="password" name="password" required></div>
  <div class="field"><label>Confirm password</label><input type="password" name="password2" required></div>
  <button class="btn">Create account</button>
</form></div></body></html>
