<?php
require __DIR__ . '/inc/bootstrap.php';
require_login('admin');
$db = admin_db();
$me = current_admin();
$flash = ''; $err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $do = $_POST['do'] ?? '';
    if ($do === 'create') {
        $u = trim($_POST['username'] ?? '');
        $p = (string) ($_POST['password'] ?? '');
        $role = ($_POST['role'] ?? 'viewer') === 'admin' ? 'admin' : 'viewer';
        if (!preg_match('/^[a-zA-Z0-9_.-]{3,64}$/', $u)) {
            $err = 'Invalid username (3-64 chars: letters, digits, . _ -).';
        } elseif (strlen($p) < 10) {
            $err = 'Password must be at least 10 characters.';
        } else {
            try {
                $db->prepare('INSERT INTO admin_users (username,password_hash,role,is_active,force_password_change,created_at) VALUES (?,?,?,1,1,NOW())')
                   ->execute([$u, password_hash($p, PASSWORD_DEFAULT), $role]);
                admin_log('user_create', "$u ($role)");
                $flash = "User '$u' created.";
            } catch (\PDOException $e) {
                $err = 'That username already exists.';
            }
        }
    } elseif ($do === 'toggle') {
        $id = (int) $_POST['id'];
        if ($id !== $me['id']) {
            $db->prepare('UPDATE admin_users SET is_active = 1 - is_active WHERE id=?')->execute([$id]);
            admin_log('user_toggle', "#$id");
        } else { $err = 'You cannot deactivate your own account.'; }
    } elseif ($do === 'role') {
        $id = (int) $_POST['id'];
        $role = ($_POST['role'] ?? '') === 'admin' ? 'admin' : 'viewer';
        if ($id === $me['id']) { $err = 'You cannot change your own role.'; }
        else { $db->prepare('UPDATE admin_users SET role=? WHERE id=?')->execute([$role, $id]); admin_log('user_role', "#$id -> $role"); }
    } elseif ($do === 'reset') {
        $id = (int) $_POST['id'];
        $p = (string) ($_POST['password'] ?? '');
        if (strlen($p) < 10) { $err = 'Password must be at least 10 characters.'; }
        else {
            $db->prepare('UPDATE admin_users SET password_hash=?, force_password_change=1 WHERE id=?')
               ->execute([password_hash($p, PASSWORD_DEFAULT), $id]);
            admin_log('user_reset', "#$id");
            $flash = 'Password reset.';
        }
    } elseif ($do === 'delete') {
        $id = (int) $_POST['id'];
        $n = (int) $db->query('SELECT COUNT(*) FROM admin_users WHERE role="admin" AND is_active=1')->fetchColumn();
        if ($id === $me['id']) { $err = 'You cannot delete your own account.'; }
        elseif ($n <= 1) { $err = 'Cannot delete the last active admin.'; }
        else { $db->prepare('DELETE FROM admin_users WHERE id=?')->execute([$id]); admin_log('user_delete', "#$id"); $flash = 'User deleted.'; }
    }
}

$users = $db->query('SELECT * FROM admin_users ORDER BY created_at')->fetchAll();
$log = $db->query('SELECT * FROM admin_activity ORDER BY at DESC LIMIT 30')->fetchAll();

$PAGE_TITLE = 'Admin Users';
$ACTIVE = 'users';
require __DIR__ . '/inc/header.php';
?>
<?php if ($flash): ?><div class="flash ok"><?= h($flash) ?></div><?php endif; ?>
<?php if ($err): ?><div class="flash err"><?= h($err) ?></div><?php endif; ?>

<div class="panel"><div class="panel-head"><h2>Accounts</h2></div><div class="table-wrap"><table class="data">
  <thead><tr><th>Username</th><th>Role</th><th>Status</th><th>Last login</th><th>Actions</th></tr></thead>
  <tbody>
  <?php foreach ($users as $u): ?>
    <tr>
      <td><?= h($u['username']) ?><?= $u['id'] == $me['id'] ? ' <span class="tag">you</span>' : '' ?></td>
      <td>
        <?php if ($u['id'] != $me['id']): ?>
        <form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="do" value="role"><input type="hidden" name="id" value="<?= $u['id'] ?>">
          <select name="role" onchange="this.form.submit()">
            <option value="viewer" <?= $u['role'] === 'viewer' ? 'selected' : '' ?>>Viewer</option>
            <option value="admin" <?= $u['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
          </select></form>
        <?php else: ?><?= h(ucfirst($u['role'])) ?><?php endif; ?>
      </td>
      <td><?= $u['is_active'] ? '<span class="tag new">active</span>' : '<span class="tag spam">disabled</span>' ?></td>
      <td><?= h($u['last_login_at'] ?: 'never') ?></td>
      <td>
        <?php if ($u['id'] != $me['id']): ?>
        <form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="do" value="toggle"><input type="hidden" name="id" value="<?= $u['id'] ?>">
          <button class="btn btn-sm btn-ghost"><?= $u['is_active'] ? 'Disable' : 'Enable' ?></button></form>
        <form method="post" style="display:inline" onsubmit="return confirm('Delete this account?')"><?= csrf_field() ?><input type="hidden" name="do" value="delete"><input type="hidden" name="id" value="<?= $u['id'] ?>">
          <button class="btn btn-sm btn-danger">Delete</button></form>
        <?php endif; ?>
        <details style="display:inline-block"><summary class="btn btn-sm btn-ghost" style="list-style:none">Reset pw</summary>
          <form method="post" style="margin-top:6px"><?= csrf_field() ?><input type="hidden" name="do" value="reset"><input type="hidden" name="id" value="<?= $u['id'] ?>">
            <input type="password" name="password" placeholder="new password" required minlength="10">
            <button class="btn btn-sm">Set</button></form>
        </details>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table></div></div>

<div class="panel"><div class="panel-head"><h2>Add admin user</h2></div><div class="panel-body">
  <form method="post" class="filters" style="margin:0"><?= csrf_field() ?><input type="hidden" name="do" value="create">
    <input name="username" placeholder="username" required>
    <input type="password" name="password" placeholder="password (min 10)" required minlength="10" autocomplete="new-password">
    <select name="role"><option value="viewer">Viewer (read-only)</option><option value="admin">Admin (full access)</option></select>
    <button class="btn btn-sm">Create user</button>
  </form>
</div></div>

<div class="panel"><div class="panel-head"><h2>Recent admin activity</h2></div><div class="table-wrap"><table class="data">
  <thead><tr><th>When</th><th>User</th><th>Action</th><th>Detail</th><th>IP</th></tr></thead><tbody>
  <?php foreach ($log as $l): ?>
    <tr><td><?= h($l['at']) ?></td><td><?= h($l['admin_username']) ?></td><td><?= h($l['action']) ?></td>
      <td><?= h($l['detail']) ?></td><td><?= h($l['ip']) ?></td></tr>
  <?php endforeach; ?>
  </tbody>
</table></div></div>
<?php require __DIR__ . '/inc/footer.php'; ?>
