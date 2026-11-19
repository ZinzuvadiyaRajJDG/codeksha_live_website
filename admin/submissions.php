<?php
require __DIR__ . '/inc/bootstrap.php';
require_login();
require __DIR__ . '/inc/stats.php';
$db = admin_db();
require __DIR__ . '/inc/callstatus.php';   // $CALL, $canEdit, ck_call_* helpers
ck_call_handle($db, $CALL, $canEdit);

/* ---- actions (workflow) ---- */
$flash = isset($_GET['deleted']) ? (int) $_GET['deleted'] . ' submission(s) deleted.' : '';
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
    } elseif (in_array($act, ['delete_one', 'delete_many'], true) && is_role('admin')) {
        $ids = $act === 'delete_one' ? [(int) ($_POST['id'] ?? 0)] : array_map('intval', (array) ($_POST['ids'] ?? []));
        $ids = array_values(array_filter($ids));
        if ($ids) {
            $in = implode(',', array_fill(0, count($ids), '?'));
            $db->prepare("DELETE FROM form_submissions WHERE id IN ($in)")->execute($ids);
            admin_log('submission_delete', '#' . implode(',#', $ids));
        }
        $back = (string) ($_POST['back'] ?? '');
        if (!preg_match('#^/admin/(submissions|walkins)\.php(\?[^\s]*)?$#', $back)) $back = '/admin/submissions.php';
        $back = rtrim(preg_replace('/([?&])deleted=\d+&?/', '$1', $back), '?&');   // drop an earlier flash param
        header('Location: ' . $back . (str_contains($back, '?') ? '&' : '?') . 'deleted=' . count($ids));
        exit;
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
        $typeLabel = ['contact' => 'Contact', 'instructor' => 'Instructor', 'demo' => 'Free demo class', 'popup' => 'Promo popup callback', 'enquiry' => 'Course enquiry', 'walkin' => 'Walk-in inquiry'][$row['form_type']] ?? ucfirst($row['form_type']);
        $isDemo = $row['form_type'] === 'demo';
      ?>
      <div class="panel"><div class="panel-head"><h2><?= h($typeLabel) ?> submission</h2>
        <span class="tag <?= h($row['status']) ?>"><?= h($row['status']) ?></span></div>
        <div class="panel-body"><dl class="kv">
          <dt>Name</dt><dd><?= h($row['name'] ?: '—') ?></dd>
          <dt>Email</dt><dd><?php if ($row['email']): ?><a href="mailto:<?= h($row['email']) ?>"><?= h($row['email']) ?></a><?php else: ?>—<?php endif; ?></dd>
          <dt>Phone</dt><dd><?php if ($row['phone']): ?><a href="tel:<?= h(preg_replace('/[^\d+]/', '', $row['phone'])) ?>"><?= h($row['phone']) ?></a><?php else: ?>—<?php endif; ?></dd>
          <?php if ($row['field1']): ?><dt><?= ($isDemo || in_array($row['form_type'], ['enquiry', 'walkin'], true)) ? 'Course' : ($row['form_type'] === 'popup' ? 'Promo code' : 'Subject') ?></dt><dd><?= h($row['field1']) ?></dd><?php endif; ?>
          <?php if ($row['form_type'] === 'walkin'): ?>
            <dt>Interested in</dt><dd><?= h($row['field2'] ?: '—') ?></dd>
            <?php $labels = ['status' => 'Currently', 'qualification' => 'Qualification / college', 'goal' => 'Goal', 'start' => 'Plans to start', 'batch' => 'Preferred batch', 'city' => 'City / area', 'source' => 'Heard about us via'];
            foreach (json_decode((string) $row['extra_json'], true) ?: [] as $k => $v): if (!isset($labels[$k])) continue; ?>
              <dt><?= h($labels[$k]) ?></dt><dd><?= h($v) ?></dd>
            <?php endforeach; ?>
          <?php endif; ?>
          <?php if ($isDemo): ?><dt>Preferred time</dt><dd><?= h($row['field2'] ?: 'Any time') ?></dd><?php endif; ?>
          <?php if ($row['message'] || !in_array($row['form_type'], ['popup', 'enquiry'], true)): ?>
          <dt><?= $isDemo ? 'Notes' : 'Message' ?></dt><dd style="white-space:pre-wrap"><?= h($row['message'] ?: '—') ?></dd>
          <?php endif; ?>
          <dt>Received (IST)</dt><dd><?= h(fmt_ist($row['created_at'])) ?> &nbsp;<span class="tag"><?= h(fmt_ago($row['created_at'])) ?></span></dd>
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
          <?php $cx = json_decode((string) $row['extra_json'], true) ?: []; ?>
          <div style="margin-top:14px">
            <label style="display:block;font-weight:600;font-size:13px;margin-bottom:6px">Call status</label>
            <?= ck_call_select($CALL, $cx['call_status'] ?? '', (int) $row['id'], $canEdit, 'Call status', 'cs-lg') ?>
            <div class="cs-meta" id="csMeta"><?= !empty($cx['call_status']) && !empty($cx['call_at']) ? 'Updated ' . h(fmt_ist($cx['call_at'])) . (!empty($cx['call_by']) ? ' by ' . h($cx['call_by']) : '') : '' ?></div>
          </div>
          <?= ck_call_assets() ?>
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
$call = q_str('call', 16);
$search = q_str('q');
$w = ["form_type<>'walkin'"]; $args = [];   // walk-in enquiries live in their own tab (walkins.php)
if ($type !== '')   { $w[] = 'form_type=?'; $args[] = $type; }
ck_call_where($call, $CALL, $w, $args);
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
foreach ($db->query("SELECT COALESCE(JSON_UNQUOTE(JSON_EXTRACT(extra_json,'$.call_status')),'none') s, COUNT(*) c FROM form_submissions WHERE form_type<>'walkin' GROUP BY s") as $r) $counts[$r['s']] = $r['c'];

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
    <option value="enquiry" <?= $type === 'enquiry' ? 'selected' : '' ?>>Course enquiry</option>
  </select>
  <select name="call"><option value="">Any call status</option>
    <option value="none" <?= $call === 'none' ? 'selected' : '' ?>>Not called yet (<?= (int) ($counts['none'] ?? 0) ?>)</option>
    <?php foreach ($CALL as $slug => $label): ?>
      <option value="<?= $slug ?>" <?= $call === $slug ? 'selected' : '' ?>><?= h($label) ?> (<?= (int) ($counts[$slug] ?? 0) ?>)</option>
    <?php endforeach; ?>
  </select>
  <button class="btn btn-sm">Filter</button>
  <a class="btn-ghost btn-sm" href="/admin/export.php?type=submissions&<?= h($_SERVER['QUERY_STRING'] ?? '') ?>">Export CSV</a>
  <span style="margin-left:auto;color:var(--muted)"><?= number_format($total) ?> total</span>
</form>
<?php $canDelete = is_role('admin'); ?>
<form method="post" action="/admin/submissions.php" id="bulkForm">
<?= csrf_field() ?><input type="hidden" name="back" value="<?= h($_SERVER['REQUEST_URI']) ?>">
<?php if ($canDelete): ?>
<div class="filters" style="margin-bottom:10px">
  <button class="btn btn-sm btn-danger" name="action" value="delete_many" id="bulkDel" disabled
    onclick="return confirm('Delete the selected submissions permanently? This cannot be undone.')">Delete selected</button>
  <span id="selCount" style="color:var(--muted)"></span>
</div>
<?php endif; ?>
<div class="panel"><div class="table-wrap"><table class="data">
  <thead><tr><?php if ($canDelete): ?><th style="width:34px"><input type="checkbox" id="selAll" aria-label="Select all"></th><?php endif; ?><th>Date &amp; time (IST)</th><th>Form</th><th>Name</th><th>Email</th><th>Phone</th><th>Message / details</th><th>Call status</th><?php if ($canDelete): ?><th></th><?php endif; ?></tr></thead>
  <tbody>
  <?php foreach ($rows as $r): ?>
    <?php
      $x = json_decode((string) $r['extra_json'], true) ?: [];
      $formTag = ['contact' => 'Contact', 'instructor' => 'Instructor', 'demo' => 'Demo', 'popup' => 'Popup', 'enquiry' => 'Enquiry', 'walkin' => 'Walk-in'][$r['form_type']] ?? $r['form_type'];
      $detail = match ($r['form_type']) {
        'demo'  => trim(($r['field1'] ?: 'course?') . ($r['field2'] ? ' · ' . $r['field2'] : '') . ($r['message'] ? ' — ' . $r['message'] : '')),
        'enquiry' => 'Wants info on: ' . ($r['field1'] ?: 'a course'),
        'walkin' => ($r['field1'] ?: 'course?') . ($r['field2'] ? ' · ' . $r['field2'] : ''),
        'popup' => 'Callback requested (code ' . ($r['field1'] ?: 'CK-10OFF') . ')',
        default => (string) $r['message'],
      };
    ?>
    <tr>
      <?php if ($canDelete): ?><td><input type="checkbox" class="selRow" name="ids[]" value="<?= (int)$r['id'] ?>" aria-label="Select #<?= (int)$r['id'] ?>"></td><?php endif; ?>
      <td style="white-space:nowrap"><a href="?id=<?= (int)$r['id'] ?>"><?= h(date('d M Y', strtotime($r['created_at']))) ?></a><br><small style="color:var(--muted)"><?= h(date('h:i A', strtotime($r['created_at']))) ?> &middot; <?= h(fmt_ago($r['created_at'])) ?></small></td>
      <td><span class="tag<?= $r['form_type'] === 'demo' ? ' read' : '' ?>"><?= h($formTag) ?></span></td>
      <td><?= h($r['name']) ?></td>
      <td><?= h($r['email']) ?></td>
      <td><?= h($r['phone'] ?: '—') ?></td>
      <td class="wrap" style="max-width:320px;overflow:hidden;text-overflow:ellipsis"><?= h(mb_substr($detail, 0, 80)) ?><?= mb_strlen($detail) > 80 ? '…' : '' ?></td>
      <td><?= ck_call_select($CALL, $x['call_status'] ?? '', (int) $r['id'], $canEdit, 'Call status for ' . $r['name']) ?></td>
      <?php if ($canDelete): ?><td><button class="btn btn-sm btn-danger" name="action" value="delete_one" type="submit"
        formaction="/admin/submissions.php" onclick="document.getElementById('delId').value=<?= (int)$r['id'] ?>; return confirm('Delete this submission permanently?')">Delete</button></td><?php endif; ?>
    </tr>
  <?php endforeach; ?>
  <?php if (!$rows): ?><tr><td colspan="9" class="empty">No submissions.</td></tr><?php endif; ?>
  </tbody>
</table></div></div>
<input type="hidden" name="id" id="delId" value="">
</form>
<?php if ($canDelete): ?>
<script>
(function(){var all=document.getElementById('selAll'),rows=[].slice.call(document.querySelectorAll('.selRow')),btn=document.getElementById('bulkDel'),cnt=document.getElementById('selCount');
function upd(){var n=rows.filter(function(r){return r.checked}).length;btn.disabled=!n;cnt.textContent=n?n+' selected':'';if(all)all.checked=n&&n===rows.length;}
if(all)all.addEventListener('change',function(){rows.forEach(function(r){r.checked=all.checked});upd();});rows.forEach(function(r){r.addEventListener('change',upd)});})();
</script>
<?php endif; ?>
<?= ck_call_assets() ?>
<?php require __DIR__ . '/inc/_pager.php'; ?>
<?php require __DIR__ . '/inc/footer.php'; ?>
