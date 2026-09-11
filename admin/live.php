<?php
require __DIR__ . '/inc/bootstrap.php';
require_login();
$PAGE_TITLE = 'Live';
$ACTIVE = 'live';
require __DIR__ . '/inc/header.php';
?>
<div class="cards">
  <div class="card stat"><div class="label">Active visitors (5 min)</div><div class="value" id="lvCount">–</div></div>
  <div class="card stat"><div class="label">Page views (15 min)</div><div class="value" id="lvPv">–</div></div>
  <div class="card stat"><div class="label">Updated</div><div class="value" style="font-size:20px" id="lvTime">–</div></div>
</div>
<div class="grid-2">
  <div class="panel"><div class="panel-head"><h2>Who's on the site now</h2></div>
    <div class="table-wrap"><table class="data">
      <thead><tr><th>Visitor</th><th>Page</th><th>Location</th><th>Device</th><th>Channel</th><th>Last hit</th></tr></thead>
      <tbody id="lvRows"><tr><td colspan="6" class="empty">Loading…</td></tr></tbody>
    </table></div>
  </div>
  <div class="panel"><div class="panel-head"><h2>Recent interactions</h2></div>
    <div class="table-wrap"><table class="data">
      <thead><tr><th>Type</th><th>Label</th><th>Page</th><th>Time</th></tr></thead>
      <tbody id="lvEvents"><tr><td colspan="4" class="empty">Loading…</td></tr></tbody>
    </table></div>
  </div>
</div>
<?php
$PAGE_SCRIPT = <<<'JS'
const esc = s => String(s ?? '').replace(/[&<>"]/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c]));
async function poll(){
  try{
    const r = await fetch('/admin/live-data.php', {headers:{'Accept':'application/json'}});
    if(!r.ok) throw 0;
    const d = await r.json();
    lvCount.textContent = d.count;
    lvPv.textContent = d.pv15;
    lvTime.textContent = d.now;
    lvRows.innerHTML = d.active.length ? d.active.map(a=>`<tr>
      <td><a href="/admin/visitors.php?id=${a.visitor_id}">#${a.visitor_id}</a></td>
      <td>${esc(a.path)}</td>
      <td>${esc([a.city,a.country].filter(Boolean).join(', ')||'—')}</td>
      <td>${esc((a.device_type||'?')+' · '+(a.browser||''))}</td>
      <td style="text-transform:capitalize">${esc(a.channel||'direct')}</td>
      <td>${esc(a.last_at.substr(11,8))}</td></tr>`).join('') : '<tr><td colspan="6" class="empty">Nobody active right now.</td></tr>';
    lvEvents.innerHTML = d.events.length ? d.events.map(e=>`<tr>
      <td><span class="tag">${esc(e.type)}</span></td><td>${esc(e.label)}</td>
      <td>${esc(e.path)}</td><td>${esc(e.created_at.substr(11,8))}</td></tr>`).join('') : '<tr><td colspan="4" class="empty">No recent interactions.</td></tr>';
  }catch(e){ lvTime.textContent = 'reconnecting…'; }
}
poll(); setInterval(poll, 10000);
JS;
require __DIR__ . '/inc/footer.php';
