<?php
/** Walk-in enquiries: the answers from /walk-in-enquiry/ (form_type "walkin") in one readable table. */
require __DIR__ . '/inc/bootstrap.php';
require_login();
require __DIR__ . '/inc/stats.php';
$db = admin_db();

$flash = isset($_GET['deleted']) ? (int) $_GET['deleted'] . ' enquiry(ies) deleted.' : '';
$status = q_str('status', 16);
$course = q_str('course', 190);
$search = q_str('q');
$w = ["form_type='walkin'"]; $args = [];
if ($status !== '') { $w[] = 'status=?'; $args[] = $status; }
if ($course !== '') { $w[] = 'field1=?'; $args[] = $course; }
if ($search !== '') {
    $w[] = '(name LIKE ? OR email LIKE ? OR phone LIKE ? OR field1 LIKE ? OR field2 LIKE ? OR message LIKE ? OR extra_json LIKE ?)';
    for ($i = 0; $i < 7; $i++) $args[] = "%$search%";
}
$where = implode(' AND ', $w);

$page = pg_int('p', 1, 1, 100000);
$per = 30;
$cs = $db->prepare("SELECT COUNT(*) FROM form_submissions WHERE $where");
$cs->execute($args);
$total = (int) $cs->fetchColumn();
$pages = max(1, (int) ceil($total / $per));
$page = min($page, $pages);
$q = $db->prepare("SELECT * FROM form_submissions WHERE $where ORDER BY created_at DESC LIMIT $per OFFSET " . (($page - 1) * $per));
$q->execute($args);
$rows = $q->fetchAll();

$all   = (int) $db->query("SELECT COUNT(*) FROM form_submissions WHERE form_type='walkin'")->fetchColumn();
$today = (int) $db->query("SELECT COUNT(*) FROM form_submissions WHERE form_type='walkin' AND created_at >= CURDATE()")->fetchColumn();
$week  = (int) $db->query("SELECT COUNT(*) FROM form_submissions WHERE form_type='walkin' AND created_at >= (NOW() - INTERVAL 7 DAY)")->fetchColumn();
$new   = (int) $db->query("SELECT COUNT(*) FROM form_submissions WHERE form_type='walkin' AND status='new'")->fetchColumn();
$courses = $db->query("SELECT field1, COUNT(*) c FROM form_submissions WHERE form_type='walkin' AND field1 IS NOT NULL AND field1<>'' GROUP BY field1 ORDER BY c DESC")->fetchAll();
$counts = [];
foreach ($db->query("SELECT status, COUNT(*) c FROM form_submissions WHERE form_type='walkin' GROUP BY status") as $r) $counts[$r['status']] = $r['c'];
$canDelete = is_role('admin');

$PAGE_TITLE = 'Walk-in Enquiries';
$ACTIVE = 'walkins';
require __DIR__ . '/inc/header.php';
?>
<?php if ($flash): ?><div class="flash ok"><?= h($flash) ?></div><?php endif; ?>

<div class="kpis" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:12px;margin-bottom:16px">
  <?php foreach ([['Today', $today], ['Last 7 days', $week], ['New (unread)', $new], ['All time', $all]] as [$lbl, $val]): ?>
    <div class="panel" style="margin:0"><div class="panel-body" style="padding:14px 16px">
      <div style="color:var(--muted);font-size:12.5px;font-weight:600"><?= h($lbl) ?></div>
      <div style="font-size:26px;font-weight:800"><?= number_format($val) ?></div>
    </div></div>
  <?php endforeach; ?>
</div>

<form class="filters" method="get">
  <input type="search" name="q" placeholder="Search name / phone / email / course / city" value="<?= h($search) ?>" style="min-width:240px">
  <select name="course"><option value="">All courses</option>
    <?php foreach ($courses as $c): ?>
      <option value="<?= h($c['field1']) ?>" <?= $course === $c['field1'] ? 'selected' : '' ?>><?= h($c['field1']) ?> (<?= (int) $c['c'] ?>)</option>
    <?php endforeach; ?>
  </select>
  <select name="status"><option value="">Any status</option>
    <?php foreach (['new', 'read', 'replied', 'spam'] as $st): ?>
      <option value="<?= $st ?>" <?= $status === $st ? 'selected' : '' ?>><?= ucfirst($st) ?> (<?= (int) ($counts[$st] ?? 0) ?>)</option>
    <?php endforeach; ?>
  </select>
  <button class="btn btn-sm">Filter</button>
  <a class="btn-ghost btn-sm" href="/admin/export.php?type=walkins">Export CSV</a>
  <a class="btn-ghost btn-sm" href="/walk-in-enquiry/" target="_blank" rel="noopener">Open form &nearr;</a>
  <span style="margin-left:auto;color:var(--muted)"><?= number_format($total) ?> shown</span>
</form>

<form method="post" action="/admin/submissions.php" id="bulkForm">
<?= csrf_field() ?><input type="hidden" name="back" value="<?= h($_SERVER['REQUEST_URI']) ?>"><input type="hidden" name="id" id="delId" value="">
<?php if ($canDelete): ?>
<div class="filters" style="margin-bottom:10px">
  <button class="btn btn-sm btn-danger" name="action" value="delete_many" id="bulkDel" disabled
    onclick="return confirm('Delete the selected enquiries permanently? This cannot be undone.')">Delete selected</button>
  <span id="selCount" style="color:var(--muted)"></span>
</div>
<?php endif; ?>
<div class="panel"><div class="table-wrap"><table class="data">
  <thead><tr>
    <?php if ($canDelete): ?><th style="width:34px"><input type="checkbox" id="selAll" aria-label="Select all"></th><?php endif; ?>
    <th>Date &amp; time (IST)</th><th>Name</th><th>Phone</th><th>Email</th><th>Course</th><th>Interest</th><th>Currently</th>
    <th>Goal</th><th>Start</th><th>Batch</th><th>City</th><th>Heard via</th><th>Status</th><?php if ($canDelete): ?><th></th><?php endif; ?>
  </tr></thead>
  <tbody>
  <?php foreach ($rows as $r):
      $x = json_decode((string) $r['extra_json'], true) ?: [];
      $tel = preg_replace('/[^\d+]/', '', (string) $r['phone']); ?>
    <tr>
      <?php if ($canDelete): ?><td><input type="checkbox" class="selRow" name="ids[]" value="<?= (int) $r['id'] ?>" aria-label="Select #<?= (int) $r['id'] ?>"></td><?php endif; ?>
      <td style="white-space:nowrap"><a href="/admin/submissions.php?id=<?= (int) $r['id'] ?>"><?= h(date('d M Y', strtotime($r['created_at']))) ?></a><br><small style="color:var(--muted)"><?= h(date('h:i A', strtotime($r['created_at']))) ?> &middot; <?= h(fmt_ago($r['created_at'])) ?></small></td>
      <td><strong><?= h($r['name']) ?></strong></td>
      <td><?php if ($tel): ?><a href="tel:<?= h($tel) ?>"><?= h($r['phone']) ?></a><?php else: ?>&mdash;<?php endif; ?></td>
      <td><?= $r['email'] ? '<a href="mailto:' . h($r['email']) . '">' . h($r['email']) . '</a>' : '&mdash;' ?></td>
      <td><?= h($r['field1'] ?: '—') ?></td>
      <td><?= h($r['field2'] ?: '—') ?></td>
      <td><?= h($x['status'] ?? '—') ?><?= !empty($x['qualification']) ? '<br><small style="color:var(--muted)">' . h($x['qualification']) . '</small>' : '' ?></td>
      <td><?= h($x['goal'] ?? '—') ?></td>
      <td><?= h($x['start'] ?? '—') ?></td>
      <td><?= h($x['batch'] ?? '—') ?></td>
      <td><?= h($x['city'] ?? '—') ?></td>
      <td><?= h($x['source'] ?? '—') ?></td>
      <td><span class="tag <?= h($r['status']) ?>"><?= h($r['status']) ?></span></td>
      <?php if ($canDelete): ?><td><button class="btn btn-sm btn-danger" name="action" value="delete_one" type="submit"
        onclick="document.getElementById('delId').value=<?= (int) $r['id'] ?>; return confirm('Delete this enquiry permanently?')">Delete</button></td><?php endif; ?>
    </tr>
    <?php if (!empty($r['message'])): ?>
    <tr><td colspan="<?= $canDelete ? 15 : 13 ?>" style="padding-top:0;color:var(--muted);font-size:13px">&ldquo;<?= h(mb_substr($r['message'], 0, 300)) ?>&rdquo;</td></tr>
    <?php endif; ?>
  <?php endforeach; ?>
  <?php if (!$rows): ?><tr><td colspan="<?= $canDelete ? 15 : 13 ?>" class="empty">No walk-in enquiries yet. Share the form: <a href="/walk-in-enquiry/" target="_blank" rel="noopener">/walk-in-enquiry/</a></td></tr><?php endif; ?>
  </tbody>
</table></div></div>
</form>
<?php if ($canDelete): ?>
<script>
(function(){var all=document.getElementById('selAll'),rows=[].slice.call(document.querySelectorAll('.selRow')),btn=document.getElementById('bulkDel'),cnt=document.getElementById('selCount');
function upd(){var n=rows.filter(function(r){return r.checked}).length;btn.disabled=!n;cnt.textContent=n?n+' selected':'';if(all)all.checked=n&&n===rows.length;}
if(all)all.addEventListener('change',function(){rows.forEach(function(r){r.checked=all.checked});upd();});rows.forEach(function(r){r.addEventListener('change',upd)});})();
</script>
<?php endif; ?>
<?php require __DIR__ . '/inc/_pager.php'; ?>
<?php require __DIR__ . '/inc/footer.php'; ?>
