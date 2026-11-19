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
<?php
$moreLabels = ['status' => 'Currently', 'qualification' => 'Qualification / college', 'goal' => 'Goal', 'start' => 'Plans to start',
               'batch' => 'Preferred batch', 'city' => 'City / area', 'source' => 'Heard about us via'];
$cols = $canDelete ? 8 : 7;
?>
<div class="panel"><div class="table-wrap"><table class="data">
  <thead><tr>
    <?php if ($canDelete): ?><th style="width:34px"><input type="checkbox" id="selAll" aria-label="Select all"></th><?php endif; ?>
    <th>Date &amp; time (IST)</th><th>Name</th><th>Phone</th><th>Email</th><th>Course</th><th>Status</th><th style="text-align:right">Actions</th>
  </tr></thead>
  <tbody>
  <?php foreach ($rows as $r):
      $x = json_decode((string) $r['extra_json'], true) ?: [];
      $tel = preg_replace('/[^\d+]/', '', (string) $r['phone']);
      $digits = preg_replace('/\D/', '', (string) $r['phone']);
      $wa = strlen($digits) === 10 ? '91' . $digits : ltrim($digits, '0');
      $more = [];
      foreach ($moreLabels as $k => $lbl) { if (!empty($x[$k])) $more[] = [$lbl, $x[$k]]; }
      $detail = [
          'id' => (int) $r['id'], 'name' => $r['name'], 'phone' => $r['phone'], 'tel' => $tel, 'wa' => $wa, 'email' => $r['email'],
          'course' => $r['field1'], 'interest' => array_values(array_filter(array_map('trim', explode(',', (string) $r['field2'])))),
          'status' => $r['status'], 'when' => fmt_ist($r['created_at']), 'ago' => fmt_ago($r['created_at']),
          'notes' => $r['message'], 'more' => $more,
      ];
      $json = json_encode($detail, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>
    <tr>
      <?php if ($canDelete): ?><td><input type="checkbox" class="selRow" name="ids[]" value="<?= (int) $r['id'] ?>" aria-label="Select #<?= (int) $r['id'] ?>"></td><?php endif; ?>
      <td style="white-space:nowrap"><strong style="font-weight:600"><?= h(date('d M Y', strtotime($r['created_at']))) ?></strong><br><small style="color:var(--muted)"><?= h(date('h:i A', strtotime($r['created_at']))) ?> &middot; <?= h(fmt_ago($r['created_at'])) ?></small></td>
      <td><strong><?= h($r['name']) ?></strong></td>
      <td style="white-space:nowrap"><?php if ($tel): ?><a href="tel:<?= h($tel) ?>"><?= h($r['phone']) ?></a><?php else: ?>&mdash;<?php endif; ?></td>
      <td><?= $r['email'] ? '<a href="mailto:' . h($r['email']) . '">' . h($r['email']) . '</a>' : '&mdash;' ?></td>
      <td><?= h($r['field1'] ?: '—') ?></td>
      <td><span class="tag <?= h($r['status']) ?>"><?= h($r['status']) ?></span></td>
      <td style="white-space:nowrap;text-align:right">
        <button type="button" class="btn btn-sm js-details" data-d="<?= h($json) ?>">Details</button>
        <?php if ($canDelete): ?><button class="btn btn-sm btn-danger" name="action" value="delete_one" type="submit"
          onclick="document.getElementById('delId').value=<?= (int) $r['id'] ?>; return confirm('Delete this enquiry permanently?')">Delete</button><?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
  <?php if (!$rows): ?><tr><td colspan="<?= $cols ?>" class="empty">No walk-in enquiries yet. Share the form: <a href="/walk-in-enquiry/" target="_blank" rel="noopener">/walk-in-enquiry/</a></td></tr><?php endif; ?>
  </tbody>
</table></div></div>
</form>

<!-- details popup -->
<div class="wkm" id="wkm" hidden>
  <div class="wkm-card" role="dialog" aria-modal="true" aria-labelledby="wkmName">
    <div class="wkm-head">
      <div>
        <div class="wkm-kicker">Walk-in enquiry</div>
        <h2 id="wkmName">&nbsp;</h2>
        <div class="wkm-when" id="wkmWhen"></div>
      </div>
      <button type="button" class="wkm-x" id="wkmClose" aria-label="Close">&times;</button>
    </div>
    <div class="wkm-body" id="wkmBody"></div>
    <div class="wkm-foot" id="wkmFoot"></div>
  </div>
</div>
<style>
  .wkm[hidden]{display:none}
  .wkm{position:fixed;inset:0;z-index:1000;background:rgba(15,23,42,.55);display:flex;align-items:center;justify-content:center;padding:16px;backdrop-filter:blur(2px)}
  .wkm-card{background:#fff;border-radius:18px;width:100%;max-width:640px;max-height:92vh;display:flex;flex-direction:column;box-shadow:0 30px 80px -20px rgba(15,23,42,.5);overflow:hidden;animation:wkmIn .18s ease}
  @keyframes wkmIn{from{opacity:0;transform:translateY(10px) scale(.98)}to{opacity:1;transform:none}}
  .wkm-head{display:flex;justify-content:space-between;gap:12px;padding:20px 22px 16px;background:linear-gradient(135deg,#eff6ff,#fff);border-bottom:1px solid #e2e8f0}
  .wkm-kicker{font-size:12px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#2563eb}
  .wkm-head h2{margin:2px 0 2px;font-size:22px;line-height:1.2}
  .wkm-when{font-size:13px;color:var(--muted)}
  .wkm-x{border:0;background:#f1f5f9;width:36px;height:36px;border-radius:50%;font-size:22px;line-height:1;cursor:pointer;color:#475569;flex:none}
  .wkm-x:hover{background:#e2e8f0}
  .wkm-body{padding:6px 22px 8px;overflow:auto}
  .wkm-sec{padding:14px 0;border-bottom:1px solid #f1f5f9}
  .wkm-sec:last-child{border-bottom:0}
  .wkm-sec h3{margin:0 0 10px;font-size:12px;letter-spacing:.07em;text-transform:uppercase;color:#64748b}
  .wkm-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px 20px;margin:0}
  .wkm-grid div{min-width:0}
  .wkm-grid dt{font-size:12.5px;color:#64748b;margin-bottom:2px}
  .wkm-grid dd{margin:0;font-size:15px;font-weight:600;color:#0f172a;word-break:break-word}
  .wkm-grid .full{grid-column:1/-1}
  .wkm-chips{display:flex;flex-wrap:wrap;gap:6px}
  .wkm-chips span{background:#eff6ff;color:#1d4ed8;border-radius:999px;padding:4px 11px;font-size:13px;font-weight:600}
  .wkm-note{margin:0;background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:12px 14px;white-space:pre-wrap;font-size:14.5px;line-height:1.5}
  .wkm-foot{display:flex;flex-wrap:wrap;gap:8px;padding:14px 22px;border-top:1px solid #e2e8f0;background:#f8fafc}
  .wkm-foot a{flex:1 1 auto;text-align:center}
  @media (max-width:560px){.wkm{padding:0;align-items:flex-end}.wkm-card{max-width:none;max-height:94vh;border-radius:18px 18px 0 0}.wkm-grid{grid-template-columns:1fr}}
</style>
<script>
(function(){
  var m=document.getElementById('wkm'),body=document.getElementById('wkmBody'),foot=document.getElementById('wkmFoot'),last=null;
  function esc(s){return String(s==null?'':s).replace(/[&<>"']/g,function(c){return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]})}
  function item(l,v,full){return v?'<div'+(full?' class="full"':'')+'><dt>'+esc(l)+'</dt><dd>'+v+'</dd></div>':''}
  function sec(t,inner){return inner?'<div class="wkm-sec"><h3>'+esc(t)+'</h3>'+inner+'</div>':''}
  function open(d,btn){
    last=btn;
    document.getElementById('wkmName').textContent=d.name||'(no name)';
    document.getElementById('wkmWhen').textContent='Submitted '+d.when+' IST · '+d.ago;
    var contact='<dl class="wkm-grid">'+item('Mobile',d.phone?'<a href="tel:'+esc(d.tel)+'">'+esc(d.phone)+'</a>':'')+item('Email',d.email?'<a href="mailto:'+esc(d.email)+'">'+esc(d.email)+'</a>':'')+'</dl>';
    var enq='<dl class="wkm-grid">'+item('Course enquired',esc(d.course),true)+(d.interest.length?item('Interested in','<div class="wkm-chips">'+d.interest.map(function(i){return '<span>'+esc(i)+'</span>'}).join('')+'</div>',true):'')+'</dl>';
    var about=d.more.length?'<dl class="wkm-grid">'+d.more.map(function(p){return item(p[0],esc(p[1]))}).join('')+'</dl>':'';
    var notes=d.notes?'<p class="wkm-note">'+esc(d.notes)+'</p>':'';
    body.innerHTML=sec('Contact',contact)+sec('Enquiry',enq)+sec('About the student',about)+sec('Their question / note',notes)+sec('Status','<span class="tag '+esc(d.status)+'">'+esc(d.status)+'</span>');
    var f='';
    if(d.tel)f+='<a class="btn btn-sm" href="tel:'+esc(d.tel)+'">Call</a>';
    if(d.wa)f+='<a class="btn-ghost btn-sm" target="_blank" rel="noopener" href="https://wa.me/'+esc(d.wa)+'">WhatsApp</a>';
    if(d.email)f+='<a class="btn-ghost btn-sm" href="mailto:'+esc(d.email)+'">Email</a>';
    f+='<a class="btn-ghost btn-sm" href="/admin/submissions.php?id='+d.id+'">Update status / add notes</a>';
    foot.innerHTML=f;
    m.hidden=false;document.body.style.overflow='hidden';document.getElementById('wkmClose').focus();
  }
  function close(){m.hidden=true;document.body.style.overflow='';if(last)last.focus();}
  [].forEach.call(document.querySelectorAll('.js-details'),function(b){b.addEventListener('click',function(){open(JSON.parse(b.getAttribute('data-d')),b)})});
  document.getElementById('wkmClose').addEventListener('click',close);
  m.addEventListener('click',function(e){if(e.target===m)close()});
  document.addEventListener('keydown',function(e){if(e.key==='Escape'&&!m.hidden)close()});
})();
</script>
<?php if ($canDelete): ?>
<script>
(function(){var all=document.getElementById('selAll'),rows=[].slice.call(document.querySelectorAll('.selRow')),btn=document.getElementById('bulkDel'),cnt=document.getElementById('selCount');
function upd(){var n=rows.filter(function(r){return r.checked}).length;btn.disabled=!n;cnt.textContent=n?n+' selected':'';if(all)all.checked=n&&n===rows.length;}
if(all)all.addEventListener('change',function(){rows.forEach(function(r){r.checked=all.checked});upd();});rows.forEach(function(r){r.addEventListener('change',upd)});})();
</script>
<?php endif; ?>
<?php require __DIR__ . '/inc/_pager.php'; ?>
<?php require __DIR__ . '/inc/footer.php'; ?>
