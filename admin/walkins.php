<?php
/** Walk-in inquiries: the answers from /walk-in-enquiry/ (form_type "walkin") in one readable table. */
require __DIR__ . '/inc/bootstrap.php';
require_login();
require __DIR__ . '/inc/stats.php';
$db = admin_db();

// Call-status options (slug => label). The slug is what gets stored in extra_json.
$CALL = [
    'initial'       => 'Initial call done',
    'followup'      => 'Follow-up done',
    'waiting'       => 'Waiting for response',
    'noreceive'     => 'Not receiving call',
    'notuseful'     => 'Not useful',
    'notinterested' => 'Not interested anymore',
];
$canEdit = !is_role('viewer');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'call_status') {
    header('Content-Type: application/json');
    csrf_verify();
    $fail = function (int $code, string $msg) { http_response_code($code); echo json_encode(['ok' => false, 'message' => $msg]); exit; };
    if (!$canEdit) $fail(403, 'Read-only account.');
    $id = (int) ($_POST['id'] ?? 0);
    $slug = (string) ($_POST['call_status'] ?? '');
    if ($slug !== '' && !isset($CALL[$slug])) $fail(422, 'Unknown status.');
    $s = $db->prepare("SELECT extra_json FROM form_submissions WHERE id=? AND form_type='walkin'");
    $s->execute([$id]);
    $row = $s->fetch();
    if (!$row) $fail(404, 'Not found.');
    $x = json_decode((string) $row['extra_json'], true) ?: [];
    if ($slug === '') {
        unset($x['call_status'], $x['call_at'], $x['call_by']);
    } else {
        $x['call_status'] = $slug;
        $x['call_at'] = date('Y-m-d H:i:s');
        $x['call_by'] = (string) ($_SESSION['uname'] ?? '');
    }
    $db->prepare('UPDATE form_submissions SET extra_json=? WHERE id=?')->execute([json_encode($x, JSON_UNESCAPED_UNICODE), $id]);
    admin_log('walkin_call_status', "#$id -> " . ($slug ?: 'not called'));
    echo json_encode(['ok' => true, 'slug' => $slug, 'at' => $slug ? fmt_ist($x['call_at']) : '', 'by' => $x['call_by'] ?? '']);
    exit;
}

$flash = isset($_GET['deleted']) ? (int) $_GET['deleted'] . ' inquiry(ies) deleted.' : '';
$call = q_str('call', 16);
$course = q_str('course', 190);
$search = q_str('q');
$w = ["form_type='walkin'"]; $args = [];
$CS_SQL = "JSON_UNQUOTE(JSON_EXTRACT(extra_json,'$.call_status'))";
if ($call === 'none') { $w[] = "JSON_EXTRACT(extra_json,'$.call_status') IS NULL"; }
elseif (isset($CALL[$call])) { $w[] = "$CS_SQL=?"; $args[] = $call; }
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
$new   = (int) $db->query("SELECT COUNT(*) FROM form_submissions WHERE form_type='walkin' AND JSON_EXTRACT(extra_json,'$.call_status') IS NULL")->fetchColumn();
$courses = $db->query("SELECT field1, COUNT(*) c FROM form_submissions WHERE form_type='walkin' AND field1 IS NOT NULL AND field1<>'' GROUP BY field1 ORDER BY c DESC")->fetchAll();
$counts = [];
foreach ($db->query("SELECT COALESCE(JSON_UNQUOTE(JSON_EXTRACT(extra_json,'$.call_status')),'none') s, COUNT(*) c FROM form_submissions WHERE form_type='walkin' GROUP BY s") as $r) $counts[$r['s']] = $r['c'];
$canDelete = is_role('admin');

$PAGE_TITLE = 'Walk-in Inquiries';
$ACTIVE = 'walkins';
require __DIR__ . '/inc/header.php';
?>
<?php if ($flash): ?><div class="flash ok"><?= h($flash) ?></div><?php endif; ?>

<div class="kpis" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:12px;margin-bottom:16px">
  <?php foreach ([['Today', $today], ['Last 7 days', $week], ['Not called yet', $new], ['All time', $all]] as [$lbl, $val]): ?>
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
  <select name="call"><option value="">Any call status</option>
    <option value="none" <?= $call === 'none' ? 'selected' : '' ?>>Not called yet (<?= (int) ($counts['none'] ?? 0) ?>)</option>
    <?php foreach ($CALL as $slug => $label): ?>
      <option value="<?= $slug ?>" <?= $call === $slug ? 'selected' : '' ?>><?= h($label) ?> (<?= (int) ($counts[$slug] ?? 0) ?>)</option>
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
    onclick="return confirm('Delete the selected inquiries permanently? This cannot be undone.')">Delete selected</button>
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
    <th>Date &amp; time (IST)</th><th>Name</th><th>Phone</th><th>Email</th><th>Course</th><th>Call status</th><th style="text-align:right">Actions</th>
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
          'call' => $x['call_status'] ?? '', 'call_at' => !empty($x['call_at']) ? fmt_ist($x['call_at']) : '', 'call_by' => $x['call_by'] ?? '',
      ];
      $json = json_encode($detail, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>
    <tr>
      <?php if ($canDelete): ?><td><input type="checkbox" class="selRow" name="ids[]" value="<?= (int) $r['id'] ?>" aria-label="Select #<?= (int) $r['id'] ?>"></td><?php endif; ?>
      <td style="white-space:nowrap"><strong style="font-weight:600"><?= h(date('d M Y', strtotime($r['created_at']))) ?></strong><br><small style="color:var(--muted)"><?= h(date('h:i A', strtotime($r['created_at']))) ?> &middot; <?= h(fmt_ago($r['created_at'])) ?></small></td>
      <td><strong><?= h($r['name']) ?></strong></td>
      <td style="white-space:nowrap"><?php if ($tel): ?><a href="tel:<?= h($tel) ?>"><?= h($r['phone']) ?></a><?php else: ?>&mdash;<?php endif; ?></td>
      <td><?= $r['email'] ? '<a href="mailto:' . h($r['email']) . '">' . h($r['email']) . '</a>' : '&mdash;' ?></td>
      <td><?= h($r['field1'] ?: '—') ?></td>
      <td><select class="cs cs-<?= h($x['call_status'] ?? 'none') ?>" data-id="<?= (int) $r['id'] ?>" aria-label="Call status for <?= h($r['name']) ?>" <?= $canEdit ? '' : 'disabled' ?>>
        <option value="">Not called yet</option>
        <?php foreach ($CALL as $slug => $label): ?><option value="<?= $slug ?>" <?= ($x['call_status'] ?? '') === $slug ? 'selected' : '' ?>><?= h($label) ?></option><?php endforeach; ?>
      </select></td>
      <td style="white-space:nowrap;text-align:right">
        <button type="button" class="btn btn-sm js-details" data-d="<?= h($json) ?>">Details</button>
        <?php if ($canDelete): ?><button class="btn btn-sm btn-danger" name="action" value="delete_one" type="submit"
          onclick="document.getElementById('delId').value=<?= (int) $r['id'] ?>; return confirm('Delete this inquiry permanently?')">Delete</button><?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
  <?php if (!$rows): ?><tr><td colspan="<?= $cols ?>" class="empty">No walk-in inquiries yet. Share the form: <a href="/walk-in-enquiry/" target="_blank" rel="noopener">/walk-in-enquiry/</a></td></tr><?php endif; ?>
  </tbody>
</table></div></div>
</form>

<!-- details popup -->
<div class="wkm" id="wkm" hidden>
  <div class="wkm-card" role="dialog" aria-modal="true" aria-labelledby="wkmName">
    <div class="wkm-head">
      <div>
        <div class="wkm-kicker">Walk-in inquiry</div>
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
  .cs{-webkit-appearance:none;appearance:none;border:1.5px solid;border-radius:999px;padding:6px 30px 6px 13px;font:inherit;font-size:12.5px;font-weight:700;cursor:pointer;max-width:200px;
      background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23475569' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
      background-repeat:no-repeat;background-position:right 11px center;transition:box-shadow .2s}
  .cs:disabled{opacity:.7;cursor:default}
  .cs-saved{box-shadow:0 0 0 3px rgba(34,197,94,.45)}
  .cs-lg{font-size:14.5px;padding:10px 38px 10px 16px;max-width:none;width:100%}
  .cs-none{background-color:#f1f5f9;color:#475569;border-color:#cbd5e1}
  .cs-initial{background-color:#dbeafe;color:#1d4ed8;border-color:#93c5fd}
  .cs-followup{background-color:#e0e7ff;color:#4338ca;border-color:#a5b4fc}
  .cs-waiting{background-color:#fef3c7;color:#b45309;border-color:#fcd34d}
  .cs-noreceive{background-color:#ffedd5;color:#c2410c;border-color:#fdba74}
  .cs-notuseful{background-color:#e5e7eb;color:#374151;border-color:#d1d5db}
  .cs-notinterested{background-color:#fee2e2;color:#b91c1c;border-color:#fca5a5}
  .wkm-callmeta{margin-top:8px;font-size:12.5px;color:#64748b}
  .wkm-foot a{flex:1 1 auto;text-align:center}
  .wkm-ic{display:inline-flex;align-items:center;justify-content:center;gap:8px}
  .wkm-ic svg{width:16px;height:16px;flex:none}
  .wkm-wa svg{color:#25d366}
  @media (max-width:560px){.wkm{padding:0;align-items:flex-end}.wkm-card{max-width:none;max-height:94vh;border-radius:18px 18px 0 0}.wkm-grid{grid-template-columns:1fr}}
</style>
<script>
(function(){
  var m=document.getElementById('wkm'),body=document.getElementById('wkmBody'),foot=document.getElementById('wkmFoot'),last=null,cur=null;
  var CALL=<?= json_encode($CALL) ?>,TOKEN=<?= json_encode(csrf_token()) ?>,CAN=<?= $canEdit ? 'true' : 'false' ?>,DATA={};
  function save(sel,done){
    var fd=new FormData();fd.append('_csrf',TOKEN);fd.append('action','call_status');fd.append('id',sel.getAttribute('data-id'));fd.append('call_status',sel.value);
    sel.disabled=true;
    fetch(location.pathname,{method:'POST',headers:{Accept:'application/json'},body:fd}).then(function(r){return r.json()}).then(function(j){
      if(!j.ok)throw 0;sel.disabled=false;done(j);
    }).catch(function(){sel.disabled=false;alert('Could not save the call status. Please reload the page and try again.');});
  }
  function paint(sel,slug){sel.className=sel.className.replace(/cs-(none|initial|followup|waiting|noreceive|notuseful|notinterested)/,'cs-'+(slug||'none'));}
  function applyStatus(id,slug,j){
    var d=DATA[id];if(d){d.call=slug;d.call_at=j.at;d.call_by=j.by;}
    var row=document.querySelector('select.cs[data-id="'+id+'"]:not(.cs-lg)');if(row){row.value=slug;paint(row,slug);row.classList.add('cs-saved');setTimeout(function(){row.classList.remove('cs-saved')},1200);}
  }
  [].forEach.call(document.querySelectorAll('select.cs'),function(sel){sel.addEventListener('change',function(){
    var slug=sel.value;paint(sel,slug);save(sel,function(j){applyStatus(sel.getAttribute('data-id'),slug,j)});
  })});
  body.addEventListener('change',function(e){var sel=e.target;if(sel.id!=='wkmCall')return;var slug=sel.value;paint(sel,slug);
    save(sel,function(j){applyStatus(sel.getAttribute('data-id'),slug,j);var meta=body.querySelector('.wkm-callmeta');if(meta)meta.remove();
      if(slug)sel.insertAdjacentHTML('afterend','<div class="wkm-callmeta">Updated '+esc(j.at)+(j.by?' by '+esc(j.by):'')+'</div>');});});
  function esc(s){return String(s==null?'':s).replace(/[&<>"']/g,function(c){return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]})}
  function item(l,v,full){return v?'<div'+(full?' class="full"':'')+'><dt>'+esc(l)+'</dt><dd>'+v+'</dd></div>':''}
  function sec(t,inner){return inner?'<div class="wkm-sec"><h3>'+esc(t)+'</h3>'+inner+'</div>':''}
  function callBox(d){
    var o='<option value="">Not called yet</option>';
    Object.keys(CALL).forEach(function(k){o+='<option value="'+k+'"'+(d.call===k?' selected':'')+'>'+esc(CALL[k])+'</option>'});
    var meta=d.call&&d.call_at?'<div class="wkm-callmeta">Updated '+esc(d.call_at)+(d.call_by?' by '+esc(d.call_by):'')+'</div>':'';
    return '<select class="cs cs-'+(d.call||'none')+' cs-lg" id="wkmCall" data-id="'+d.id+'"'+(CAN?'':' disabled')+'>'+o+'</select>'+meta;
  }
  function open(d,btn){
    last=btn;cur=d;
    document.getElementById('wkmName').textContent=d.name||'(no name)';
    document.getElementById('wkmWhen').textContent='Submitted '+d.when+' IST · '+d.ago;
    var contact='<dl class="wkm-grid">'+item('Mobile',d.phone?'<a href="tel:'+esc(d.tel)+'">'+esc(d.phone)+'</a>':'')+item('Email',d.email?'<a href="mailto:'+esc(d.email)+'">'+esc(d.email)+'</a>':'')+'</dl>';
    var enq='<dl class="wkm-grid">'+item('Course inquired',esc(d.course),true)+(d.interest.length?item('Interested in','<div class="wkm-chips">'+d.interest.map(function(i){return '<span>'+esc(i)+'</span>'}).join('')+'</div>',true):'')+'</dl>';
    var about=d.more.length?'<dl class="wkm-grid">'+d.more.map(function(p){return item(p[0],esc(p[1]))}).join('')+'</dl>':'';
    var notes=d.notes?'<p class="wkm-note">'+esc(d.notes)+'</p>':'';
    body.innerHTML=sec('Contact',contact)+sec('Inquiry',enq)+sec('About the student',about)+sec('Their question / note',notes)+sec('Call status',callBox(d));
    var ic={
      call:'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
      wa:'<svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.17-.3-.02-.46.13-.61.14-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.03-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.7.63.71.23 1.36.2 1.87.12.57-.08 1.76-.72 2-1.41.25-.7.25-1.29.17-1.41-.07-.12-.27-.2-.57-.35zM12.05 21.5h-.01a9.45 9.45 0 0 1-4.82-1.32l-.35-.2-3.58.94.96-3.5-.23-.36a9.43 9.43 0 0 1-1.45-5.04c0-5.22 4.25-9.47 9.48-9.47 2.53 0 4.9.99 6.69 2.78a9.4 9.4 0 0 1 2.77 6.7c0 5.23-4.25 9.47-9.46 9.47zM20.05 3.93A11.3 11.3 0 0 0 12.05.5C5.8.5.72 5.58.72 11.83c0 2 .52 3.95 1.51 5.67L.63 23.5l6.14-1.61a11.3 11.3 0 0 0 5.28 1.34h.01c6.25 0 11.33-5.08 11.33-11.33 0-3.03-1.18-5.87-3.34-8.01z"/></svg>',
      mail:'<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/></svg>'
    };
    var f='';
    if(d.tel)f+='<a class="btn btn-sm wkm-ic" href="tel:'+esc(d.tel)+'">'+ic.call+'Call</a>';
    if(d.wa)f+='<a class="btn-ghost btn-sm wkm-ic wkm-wa" target="_blank" rel="noopener" href="https://wa.me/'+esc(d.wa)+'">'+ic.wa+'WhatsApp</a>';
    if(d.email)f+='<a class="btn-ghost btn-sm wkm-ic" href="mailto:'+esc(d.email)+'">'+ic.mail+'Email</a>';
    foot.innerHTML=f;
    m.hidden=false;document.body.style.overflow='hidden';document.getElementById('wkmClose').focus();
  }
  function close(){m.hidden=true;document.body.style.overflow='';if(last)last.focus();}
  [].forEach.call(document.querySelectorAll('.js-details'),function(b){var d=JSON.parse(b.getAttribute('data-d'));DATA[d.id]=d;b.addEventListener('click',function(){open(DATA[d.id],b)})});
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
