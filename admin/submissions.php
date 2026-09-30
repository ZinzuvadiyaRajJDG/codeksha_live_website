<?php
require __DIR__ . '/inc/bootstrap.php';
require_login();
require __DIR__ . '/inc/stats.php';
$db = admin_db();

/* ---- actions (workflow) ---- */
$flash = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    if (is_role('viewer')) { http_response_code(403); exit('Read-only account.'); }
    $id = (int) ($_POST['id'] ?? 0);
    $act = $_POST['action'] ?? '';
    if ($act === 'status' && in_array($_POST['status'] ?? '', ['new', 'read', 'replied', 'spam'], true)) {
        $db->prepare('UPDATE form_submissions SET status=? WHERE id=?')->execute([$_POST['status'], $id]);
        admin_log('submission_status', "#$id -> {$_POST['status']}");
        $flash = 'Status updated.';
    } elseif ($act === 'note') {
        $db->prepare('UPDATE form_submissions SET admin_notes=? WHERE id=?')
           ->execute([mb_substr(trim($_POST['note'] ?? ''), 0, 5000), $id]);
        admin_log('submission_note', "#$id");
        $flash = 'Note saved.';
    } elseif ($act === 'delete' && is_role('admin')) {
        $db->prepare('DELETE FROM form_submissions WHERE id=?')->execute([$id]);
        admin_log('submission_delete', "#$id");
        header('Location: /admin/submissions.php');
        exit;
    }
    if (isset($_GET['id'])) { header('Location: /admin/submissions.php?id=' . $id . '&ok=1'); exit; }
}

/* ---- detail ---- */
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $s = $db->prepare('SELECT * FROM form_submissions WHERE id=?');
    $s->execute([$id]);
    $row = $s->fetch();
    if (!$row) { http_response_code(404); exit('Not found'); }
    if ($row['status'] === 'new') {
        $db->prepare('UPDATE form_submissions SET status="read" WHERE id=? AND status="new"')->execute([$id]);
        $row['status'] = 'read';
    }
    $PAGE_TITLE = 'Submission #' . $id;
    $ACTIVE = 'submissions';
    require __DIR__ . '/inc/header.php'; ?>
    <p class="crumb"><a href="/admin/submissions.php">&larr; All submissions</a></p>
    <?php if (isset($_GET['ok'])): ?><div class="flash ok"><?= h($flash ?: 'Saved.') ?></div><?php endif; ?>
    <div class="grid-2">
      <?php
        $typeLabel = ['contact' => 'Contact', 'instructor' => 'Instructor', 'demo' => 'Free demo class', 'popup' => 'Promo popup callback'][$row['form_type']] ?? ucfirst($row['form_type']);
        $isDemo = $row['form_type'] === 'demo';
      ?>
      <div class="panel"><div class="panel-head"><h2><?= h($typeLabel) ?> submission</h2>
        <span class="tag <?= h($row['status']) ?>"><?= h($row['status']) ?></span></div>
        <div class="panel-body"><dl class="kv">
          <dt>Name</dt><dd><?= h($row['name'] ?: '—') ?></dd>
          <dt>Email</dt><dd><?php if ($row['email']): ?><a href="mailto:<?= h($row['email']) ?>"><?= h($row['email']) ?></a><?php else: ?>—<?php endif; ?></dd>
          <dt>Phone</dt><dd><?php if ($row['phone']): ?><a href="tel:<?= h(preg_replace('/[^\d+]/', '', $row['phone'])) ?>"><?= h($row['phone']) ?></a><?php else: ?>—<?php endif; ?></dd>
          <?php if ($row['field1']): ?><dt><?= $isDemo ? 'Course' : ($row['form_type'] === 'popup' ? 'Promo code' : 'Subject') ?></dt><dd><?= h($row['field1']) ?></dd><?php endif; ?>
          <?php if ($isDemo): ?><dt>Preferred time</dt><dd><?= h($row['field2'] ?: 'Any time') ?></dd><?php endif; ?>
          <?php if ($row['message'] || !in_array($row['form_type'], ['popup'], true)): ?>
          <dt><?= $isDemo ? 'Notes' : 'Message' ?></dt><dd style="white-space:pre-wrap"><?= h($row['message'] ?: '—') ?></dd>
          <?php endif; ?>
          <dt>Received</dt><dd><?= h($row['created_at']) ?></dd>
          <dt>From page</dt><dd><?= h($row['page_path'] ?: '—') ?></dd>
          <dt>IP</dt><dd><?= h($row['ip'] ?: '—') ?> (<?= h($row['country'] ?: '?') ?>)</dd>
          <?php if ($row['visitor_id']): ?>
            <dt>Visitor</dt><dd><a href="/admin/visitors.php?id=<?= (int)$row['visitor_id'] ?>">View full journey &rarr;</a></dd>
          <?php endif; ?>
        </dl></div>
      </div>
      <div>
        <div class="panel"><div class="panel-head"><h2>Workflow</h2></div><div class="panel-body">
          <form method="post" action="?id=<?= $id ?>" class="filters" style="margin:0">
            <?= csrf_field() ?><input type="hidden" name="id" value="<?= $id ?>"><input type="hidden" name="action" value="status">
            <select name="status">
              <?php foreach (['new', 'read', 'replied', 'spam'] as $st): ?>
                <option value="<?= $st ?>" <?= $row['status'] === $st ? 'selected' : '' ?>><?= ucfirst($st) ?></option>
              <?php endforeach; ?>
            </select>
            <button class="btn btn-sm">Update</button>
            <?php if ($row['phone']): ?>
              <a class="btn-ghost btn-sm" href="tel:<?= h(preg_replace('/[^\d+]/', '', $row['phone'])) ?>">Call back</a>
            <?php endif; ?>
            <?php if ($row['email']): ?>
              <a class="btn-ghost btn-sm" href="mailto:<?= h($row['email']) ?>?subject=Re: your message to Codeksha">Reply by email</a>
            <?php endif; ?>
          </form>
        </div></div>
        <div class="panel"><div class="panel-head"><h2>Private notes</h2></div><div class="panel-body">
          <form method="post" action="?id=<?= $id ?>">
            <?= csrf_field() ?><input type="hidden" name="id" value="<?= $id ?>"><input type="hidden" name="action" value="note">
            <textarea name="note" rows="6" style="width:100%"><?= h($row['admin_notes']) ?></textarea>
            <div style="margin-top:10px"><button class="btn btn-sm">Save note</button>
            <?php if (is_role('admin')): ?>
              <button class="btn btn-sm btn-danger" name="action" value="delete"
                onclick="return confirm('Delete this submission permanently?')">Delete</button>
            <?php endif; ?></div>
          </form>
        </div></div>
      </div>
    </div>
    <?php require __DIR__ . '/inc/footer.php'; exit;
}

/* ---- list ---- */
$page = pg_int('p', 1, 1, 100000);
$per = 30;
$type = q_str('ftype', 32);
$status = q_str('status', 16);
$search = q_str('q');
$w = ['1=1']; $args = [];
if ($type !== '')   { $w[] = 'form_type=?'; $args[] = $type; }
if ($status !== '') { $w[] = 'status=?'; $args[] = $status; }
if ($search !== '') { $w[] = '(name LIKE ? OR email LIKE ? OR phone LIKE ? OR message LIKE ?)'; array_push($args, "%$search%", "%$search%", "%$search%", "%$search%"); }
$where = implode(' AND ', $w);

$cs = $db->prepare("SELECT COUNT(*) FROM form_submissions WHERE $where");
$cs->execute($args);
$total = (int) $cs->fetchColumn();
$pages = max(1, (int) ceil($total / $per));
$page = min($page, $pages);
$rows = $db->prepare("SELECT * FROM form_submissions WHERE $where ORDER BY created_at DESC LIMIT $per OFFSET " . (($page - 1) * $per));
$rows->execute($args);
$rows = $rows->fetchAll();

$counts = [];
foreach ($db->query("SELECT status, COUNT(*) c FROM form_submissions GROUP BY status") as $r) $counts[$r['status']] = $r['c'];

$PAGE_TITLE = 'Form Submissions';
$ACTIVE = 'submissions';
require __DIR__ . '/inc/header.php';
?>
<?php if ($flash): ?><div class="flash ok"><?= h($flash) ?></div><?php endif; ?>
<form class="filters" method="get">
  <input type="search" name="q" placeholder="Search name / email / phone / message" value="<?= h($search) ?>" style="min-width:220px">
  <select name="ftype"><option value="">All forms</option>
    <option value="contact" <?= $type === 'contact' ? 'selected' : '' ?>>Contact</option>
    <option value="demo" <?= $type === 'demo' ? 'selected' : '' ?>>Free demo class</option>
    <option value="instructor" <?= $type === 'instructor' ? 'selected' : '' ?>>Instructor</option>
    <option value="popup" <?= $type === 'popup' ? 'selected' : '' ?>>Promo popup callback</option>
  </select>
  <select name="status"><option value="">Any status</option>
    <?php foreach (['new', 'read', 'replied', 'spam'] as $st): ?>
      <option value="<?= $st ?>" <?= $status === $st ? 'selected' : '' ?>><?= ucfirst($st) ?> (<?= (int)($counts[$st] ?? 0) ?>)</option>
    <?php endforeach; ?>
  </select>
  <button class="btn btn-sm">Filter</button>
  <a class="btn-ghost btn-sm" href="/admin/export.php?type=submissions&<?= h($_SERVER['QUERY_STRING'] ?? '') ?>">Export CSV</a>
  <span style="margin-left:auto;color:var(--muted)"><?= number_format($total) ?> total</span>
</form>
<div class="panel"><div class="table-wrap"><table class="data">
  <thead><tr><th>Received</th><th>Form</th><th>Name</th><th>Email</th><th>Phone</th><th>Message / details</th><th>Status</th></tr></thead>
  <tbody>
  <?php foreach ($rows as $r): ?>
    <?php
      $formTag = ['contact' => 'Contact', 'instructor' => 'Instructor', 'demo' => 'Demo', 'popup' => 'Popup'][$r['form_type']] ?? $r['form_type'];
      $detail = match ($r['form_type']) {
        'demo'  => trim(($r['field1'] ?: 'course?') . ($r['field2'] ? ' · ' . $r['field2'] : '') . ($r['message'] ? ' — ' . $r['message'] : '')),
        'popup' => 'Callback requested (code ' . ($r['field1'] ?: 'CK-10OFF') . ')',
        default => (string) $r['message'],
      };
    ?>
    <tr>
      <td><a href="?id=<?= (int)$r['id'] ?>"><?= h(fmt_ago($r['created_at'])) ?></a></td>
      <td><span class="tag<?= $r['form_type'] === 'demo' ? ' read' : '' ?>"><?= h($formTag) ?></span></td>
      <td><?= h($r['name']) ?></td>
      <td><?= h($r['email']) ?></td>
      <td><?= h($r['phone'] ?: '—') ?></td>
      <td class="wrap" style="max-width:320px;overflow:hidden;text-overflow:ellipsis"><?= h(mb_substr($detail, 0, 80)) ?><?= mb_strlen($detail) > 80 ? '…' : '' ?></td>
      <td><span class="tag <?= h($r['status']) ?>"><?= h($r['status']) ?></span></td>
    </tr>
  <?php endforeach; ?>
  <?php if (!$rows): ?><tr><td colspan="7" class="empty">No submissions.</td></tr><?php endif; ?>
  </tbody>
</table></div></div>
<?php require __DIR__ . '/inc/_pager.php'; ?>
<?php require __DIR__ . '/inc/footer.php'; ?>
