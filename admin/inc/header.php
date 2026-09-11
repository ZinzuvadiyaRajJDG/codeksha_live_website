<?php
/** Admin shell: <head>, sidebar, top bar. Pair with footer.php. */
if (!isset($PAGE_TITLE)) $PAGE_TITLE = 'Dashboard';
$me = current_admin();
$nav = [
    ['dashboard',   'Dashboard',        '/admin/index.php',       'grid'],
    ['visitors',    'Visitors',         '/admin/visitors.php',    'users'],
    ['sessions',    'Sessions',         '/admin/sessions.php',    'activity'],
    ['pageviews',   'Page Views',       '/admin/pageviews.php',   'file'],
    ['events',      'Interactions',     '/admin/events.php',      'mouse'],
    ['submissions', 'Form Submissions', '/admin/submissions.php', 'inbox'],
    ['live',        'Live',             '/admin/live.php',        'radio'],
];
$navBottom = [
    ['settings', 'Settings',     '/admin/settings.php', 'settings'],
];
if (is_role('admin')) {
    $navBottom[] = ['users', 'Admin Users', '/admin/users.php', 'shield'];
}
$icons = [
    'grid'    => '<path d="M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z"/>',
    'users'   => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>',
    'activity'=> '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>',
    'file'    => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/>',
    'mouse'   => '<rect x="6" y="3" width="12" height="18" rx="6"/><path d="M12 7v4"/>',
    'inbox'   => '<path d="M22 12h-6l-2 3h-4l-2-3H2"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>',
    'radio'   => '<circle cx="12" cy="12" r="2"/><path d="M4.93 19.07a10 10 0 0 1 0-14.14M7.76 16.24a6 6 0 0 1 0-8.49M16.24 7.76a6 6 0 0 1 0 8.49M19.07 4.93a10 10 0 0 1 0 14.14"/>',
    'settings'=> '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.6 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.6a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>',
    'shield'  => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
    'logout'  => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5M21 12H9"/>',
];
function nav_icon(array $icons, string $k): string
{
    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' . ($icons[$k] ?? '') . '</svg>';
}
$cur = $ACTIVE ?? '';
?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/Images/fevicon.png">
    <link rel="apple-touch-icon" href="/Images/fevicon.png">
<meta name="robots" content="noindex, nofollow">
<title><?= h($PAGE_TITLE) ?> · Codeksha Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/admin.css?v=1">
</head>
<body>
<div class="layout">
  <aside class="sidebar" id="sidebar">
    <div class="sb-brand">
      <img src="/Images/Codeksha-Logo.png" alt="Codeksha" height="28">
      <span>Admin</span>
    </div>
    <nav class="sb-nav">
      <?php foreach ($nav as [$id, $label, $href, $ic]): ?>
        <a href="<?= $href ?>" class="<?= $cur === $id ? 'active' : '' ?>"><?= nav_icon($icons, $ic) ?><span><?= h($label) ?></span></a>
      <?php endforeach; ?>
      <div class="sb-sep"></div>
      <?php foreach ($navBottom as [$id, $label, $href, $ic]): ?>
        <a href="<?= $href ?>" class="<?= $cur === $id ? 'active' : '' ?>"><?= nav_icon($icons, $ic) ?><span><?= h($label) ?></span></a>
      <?php endforeach; ?>
    </nav>
    <div class="sb-user">
      <div class="sb-user-info">
        <strong><?= h($me['username'] ?? '') ?></strong>
        <span><?= h(ucfirst($me['role'] ?? '')) ?></span>
      </div>
      <a href="/admin/logout.php" title="Log out" class="sb-logout"><?= nav_icon($icons, 'logout') ?></a>
    </div>
  </aside>

  <main class="main">
    <header class="topbar">
      <button class="menu-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')" aria-label="Menu">&#9776;</button>
      <h1><?= h($PAGE_TITLE) ?></h1>
      <div class="topbar-right">
        <a class="btn-ghost" href="<?= h(ck_config()['site_url']) ?>/" target="_blank" rel="noopener">View site &nearr;</a>
      </div>
    </header>
    <div class="content">
