<?php
require __DIR__ . '/inc/bootstrap.php';
require_login();
require dirname(__DIR__) . '/inc/mailer.php';
$db = admin_db();
$me = current_admin();
$flash = ''; $err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $do = $_POST['do'] ?? '';

    if ($do === 'password') {
        $cur = (string) ($_POST['current'] ?? '');
        $new = (string) ($_POST['new'] ?? '');
        $cf  = (string) ($_POST['confirm'] ?? '');
        $u = $db->prepare('SELECT password_hash FROM admin_users WHERE id=?');
        $u->execute([$me['id']]);
        $hash = $u->fetchColumn();
        if (!password_verify($cur, $hash)) {
            $err = 'Current password is incorrect.';
        } elseif (strlen($new) < 10) {
            $err = 'New password must be at least 10 characters.';
        } elseif ($new !== $cf) {
            $err = 'New passwords do not match.';
        } else {
            $db->prepare('UPDATE admin_users SET password_hash=?, force_password_change=0 WHERE id=?')
               ->execute([password_hash($new, PASSWORD_DEFAULT), $me['id']]);
            admin_log('password_change', 'self');
            $flash = 'Password updated.';
        }
    } elseif ($do === 'tracking' && is_role('admin')) {
        ck_set_setting('retention_days', max(7, min(1095, (int) $_POST['retention_days'])));
        ck_set_setting('exclude_ips', implode(',', array_filter(array_map('trim', preg_split('/[\s,]+/', $_POST['exclude_ips'] ?? '')))));
        admin_log('settings_tracking', '');
        $flash = 'Tracking settings saved.';
    } elseif ($do === 'selfexclude') {
        $ips = array_filter(array_map('trim', explode(',', (string) ck_setting('exclude_ips', ''))));
        $mine = ck_client_ip();
        if (!in_array($mine, $ips, true)) $ips[] = $mine;
        ck_set_setting('exclude_ips', implode(',', $ips));
        $flash = "Your IP ($mine) is now excluded from analytics.";
    } elseif ($do === 'alerts' && is_role('admin')) {
        ck_set_setting('alert_enabled', isset($_POST['alert_enabled']) ? '1' : '0');
        ck_set_setting('alert_email', trim($_POST['alert_email'] ?? ''));
        ck_set_setting('smtp_host', trim($_POST['smtp_host'] ?? ''));
        ck_set_setting('smtp_port', (int) ($_POST['smtp_port'] ?: 587));
        ck_set_setting('smtp_secure', in_array($_POST['smtp_secure'] ?? '', ['tls', 'ssl', 'none'], true) ? $_POST['smtp_secure'] : 'tls');
        ck_set_setting('smtp_user', trim($_POST['smtp_user'] ?? ''));
        if (($_POST['smtp_pass'] ?? '') !== '') ck_set_setting('smtp_pass', $_POST['smtp_pass']);
        ck_set_setting('smtp_from', trim($_POST['smtp_from'] ?? ''));
        ck_set_setting('smtp_from_name', trim($_POST['smtp_from_name'] ?? 'Codeksha Website'));
        admin_log('settings_alerts', '');
        $flash = 'Alert settings saved.';
        if (isset($_POST['send_test'])) {
            $to = trim($_POST['alert_email'] ?? '');
            $flash .= $to && ck_send_mail($to, 'Codeksha admin test email', "This is a test from your Codeksha admin panel.\nIf you can read this, alerts are working.")
                ? " Test email sent to $to." : ' Test email could NOT be sent — check SMTP details.';
        }
    } elseif ($do === 'block' && is_role('admin')) {
        $ip = trim($_POST['ip'] ?? '');
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            $db->prepare('INSERT INTO blocked_ips (ip,reason,created_at) VALUES (?,?,NOW()) ON DUPLICATE KEY UPDATE reason=VALUES(reason)')
               ->execute([$ip, mb_substr($_POST['reason'] ?? '', 0, 200)]);
            $flash = "Blocked $ip.";
        } else { $err = 'Not a valid IP address.'; }
    } elseif ($do === 'unblock' && is_role('admin')) {
        $db->prepare('DELETE FROM blocked_ips WHERE ip=?')->execute([$_POST['ip'] ?? '']);
        $flash = 'IP unblocked.';
    }
}

$S = fn($k, $d = '') => ck_setting($k, $d);
$blocked = $db->query('SELECT * FROM blocked_ips ORDER BY created_at DESC')->fetchAll();
$dbSize = $db->query("SELECT
    (SELECT COUNT(*) FROM pageviews) pv, (SELECT COUNT(*) FROM events) ev,
    (SELECT COUNT(*) FROM visitors) vi, (SELECT COUNT(*) FROM sessions) se")->fetch();

$PAGE_TITLE = 'Settings';
$ACTIVE = 'settings';
require __DIR__ . '/inc/header.php';
?>
<?php if ($flash): ?><div class="flash ok"><?= h($flash) ?></div><?php endif; ?>
<?php if ($err): ?><div class="flash err"><?= h($err) ?></div><?php endif; ?>
<?php if (isset($_GET['pw'])): ?><div class="flash err">Please set a new password before continuing.</div><?php endif; ?>

<div class="grid-2">
  <div class="panel"><div class="panel-head"><h2>Change your password</h2></div><div class="panel-body">
    <form method="post">
      <?= csrf_field() ?><input type="hidden" name="do" value="password">
      <div class="field" style="margin-bottom:12px"><label>Current password</label><br><input type="password" name="current" required style="width:100%"></div>
      <div class="field" style="margin-bottom:12px"><label>New password (min 10)</label><br><input type="password" name="new" required style="width:100%"></div>
      <div class="field" style="margin-bottom:12px"><label>Confirm new password</label><br><input type="password" name="confirm" required style="width:100%"></div>
      <button class="btn">Update password</button>
    </form>
  </div></div>

  <div class="panel"><div class="panel-head"><h2>Exclude your own traffic</h2></div><div class="panel-body">
    <p style="margin-top:0;color:var(--muted)">Your current IP: <strong><?= h(ck_client_ip()) ?></strong></p>
    <form method="post"><?= csrf_field() ?><input type="hidden" name="do" value="selfexclude">
      <button class="btn btn-ghost">Stop tracking my visits</button>
    </form>
    <p style="font-size:13px;color:var(--faint);margin-bottom:0">Adds your IP to the exclusion list below.</p>
  </div></div>
</div>

<?php if (is_role('admin')): ?>
<div class="panel"><div class="panel-head"><h2>Tracking &amp; data retention</h2></div><div class="panel-body">
  <form method="post"><?= csrf_field() ?><input type="hidden" name="do" value="tracking">
    <div class="grid-2">
      <div class="field"><label>Keep raw analytics data for (days)</label><br>
        <input type="number" name="retention_days" min="7" max="1095" value="<?= h($S('retention_days', '90')) ?>">
        <p style="font-size:13px;color:var(--faint)">Older page views, events &amp; sessions are auto-deleted daily. Form submissions are always kept.</p>
      </div>
      <div class="field"><label>Excluded IP addresses (comma/space separated)</label><br>
        <textarea name="exclude_ips" rows="3" style="width:100%"><?= h($S('exclude_ips')) ?></textarea>
        <p style="font-size:13px;color:var(--faint)">Visits from these IPs are recorded but hidden from all stats.</p>
      </div>
    </div>
    <button class="btn">Save</button>
  </form>
  <p style="color:var(--muted);font-size:13px;margin-bottom:0">
    Stored now: <?= number_format($dbSize['vi']) ?> visitors · <?= number_format($dbSize['se']) ?> sessions ·
    <?= number_format($dbSize['pv']) ?> page views · <?= number_format($dbSize['ev']) ?> events.
  </p>
</div></div>

<div class="panel"><div class="panel-head"><h2>Email alerts for new form submissions</h2></div><div class="panel-body">
  <form method="post"><?= csrf_field() ?><input type="hidden" name="do" value="alerts">
    <label style="font-weight:600"><input type="checkbox" name="alert_enabled" value="1" <?= $S('alert_enabled') === '1' ? 'checked' : '' ?>> Send me an email when a form is submitted</label>
    <div class="grid-2" style="margin-top:14px">
      <div class="field"><label>Send alerts to</label><br><input type="email" name="alert_email" value="<?= h($S('alert_email')) ?>" style="width:100%" placeholder="you@codeksha.com"></div>
      <div class="field"><label>From address</label><br><input type="email" name="smtp_from" value="<?= h($S('smtp_from')) ?>" style="width:100%" placeholder="website@codeksha.com"></div>
    </div>
    <h3 style="font-size:14px;margin:14px 0 10px">SMTP (leave host blank to use the server's built-in mail)</h3>
    <div class="grid-2">
      <div class="field"><label>SMTP host</label><br><input name="smtp_host" value="<?= h($S('smtp_host')) ?>" style="width:100%" placeholder="smtp.gmail.com"></div>
      <div class="field"><label>Port</label><br><input name="smtp_port" value="<?= h($S('smtp_port', '587')) ?>" style="width:120px"></div>
      <div class="field"><label>Encryption</label><br>
        <select name="smtp_secure">
          <?php foreach (['tls', 'ssl', 'none'] as $o): ?><option value="<?= $o ?>" <?= $S('smtp_secure', 'tls') === $o ? 'selected' : '' ?>><?= strtoupper($o) ?></option><?php endforeach; ?>
        </select></div>
      <div class="field"><label>From name</label><br><input name="smtp_from_name" value="<?= h($S('smtp_from_name', 'Codeksha Website')) ?>" style="width:100%"></div>
      <div class="field"><label>SMTP username</label><br><input name="smtp_user" value="<?= h($S('smtp_user')) ?>" style="width:100%" autocomplete="off"></div>
      <div class="field"><label>SMTP password</label><br><input type="password" name="smtp_pass" placeholder="<?= $S('smtp_pass') ? '•••••• (unchanged)' : 'not set' ?>" style="width:100%" autocomplete="new-password"></div>
    </div>
    <div style="margin-top:12px"><button class="btn">Save alert settings</button>
      <button class="btn btn-ghost" name="send_test" value="1">Save &amp; send test email</button></div>
  </form>
</div></div>

<div class="panel"><div class="panel-head"><h2>Blocked IP addresses</h2></div><div class="panel-body">
  <form method="post" class="filters" style="margin-top:0"><?= csrf_field() ?><input type="hidden" name="do" value="block">
    <input name="ip" placeholder="1.2.3.4" required>
    <input name="reason" placeholder="reason (optional)">
    <button class="btn btn-sm">Block</button>
  </form>
  <div class="table-wrap"><table class="data"><thead><tr><th>IP</th><th>Reason</th><th>Since</th><th></th></tr></thead><tbody>
    <?php foreach ($blocked as $b): ?>
      <tr><td><?= h($b['ip']) ?></td><td><?= h($b['reason']) ?></td><td><?= h($b['created_at']) ?></td>
        <td><form method="post" onsubmit="return confirm('Unblock?')"><?= csrf_field() ?>
          <input type="hidden" name="do" value="unblock"><input type="hidden" name="ip" value="<?= h($b['ip']) ?>">
          <button class="btn btn-sm btn-ghost">Unblock</button></form></td></tr>
    <?php endforeach; ?>
    <?php if (!$blocked): ?><tr><td colspan="4" class="empty">No blocked IPs.</td></tr><?php endif; ?>
  </tbody></table></div>
  <p style="font-size:13px;color:var(--faint);margin-bottom:0">Blocked IPs are not tracked at all. They can still browse the site.</p>
</div></div>
<?php endif; ?>

<?php require __DIR__ . '/inc/footer.php'; ?>
