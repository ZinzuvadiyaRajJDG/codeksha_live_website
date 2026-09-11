<?php
require __DIR__ . '/inc/bootstrap.php';
require_login();
maybe_cleanup();
require __DIR__ . '/inc/stats.php';

$days = range_days();
$k = st_kpis($days);
$daily = st_daily($days);

$topPages = st_top("SELECT path, COUNT(*) c FROM pageviews WHERE is_bot=0 AND excluded=0 AND created_at>=?
                    GROUP BY path ORDER BY c DESC", [st_since($days)]);
$topRef = st_top("SELECT COALESCE(NULLIF(referrer_host,''),'(direct)') host, COUNT(*) c FROM sessions
                  WHERE is_bot=0 AND excluded=0 AND started_at>=? GROUP BY host ORDER BY c DESC", [st_since($days)]);
$channels = st_top("SELECT COALESCE(channel,'direct') ch, COUNT(*) c FROM sessions
                    WHERE is_bot=0 AND excluded=0 AND started_at>=? GROUP BY ch ORDER BY c DESC", [st_since($days)], 10);
$countries = st_top("SELECT COALESCE(NULLIF(country,''),'??') cc, COUNT(*) c FROM visitors
                     WHERE is_bot=0 AND excluded=0 AND last_seen>=? GROUP BY cc ORDER BY c DESC", [st_since($days)]);
$devices = st_top("SELECT COALESCE(device_type,'?') d, COUNT(*) c FROM sessions
                   WHERE is_bot=0 AND excluded=0 AND started_at>=? GROUP BY d ORDER BY c DESC", [st_since($days)], 5);
$recentSubs = st_top("SELECT id,form_type,name,email,field1,status,created_at FROM form_submissions
                      ORDER BY created_at DESC", [], 6);
$leads = ['contact' => 0, 'demo' => 0, 'instructor' => 0];
$lq = admin_db()->prepare("SELECT form_type, COUNT(*) c FROM form_submissions WHERE created_at >= ? GROUP BY form_type");
$lq->execute([st_since($days)]);
foreach ($lq as $r) { $leads[$r['form_type']] = (int) $r['c']; }
$leadsNew = (int) admin_db()->query("SELECT COUNT(*) FROM form_submissions WHERE status='new'")->fetchColumn();
$maxPage = max(1, ...array_column($topPages ?: [['c' => 1]], 'c'));

$PAGE_TITLE = 'Dashboard';
$ACTIVE = 'dashboard';
$USE_CHARTJS = true;
require __DIR__ . '/inc/header.php';

function kpi($label, $val, $d, $suffix = '') {
    [$cls, $txt] = $d;
    echo '<div class="card stat"><div class="label">' . h($label) . '</div>'
       . '<div class="value">' . h($val) . $suffix . '</div>'
       . '<div class="delta ' . $cls . '">' . h($txt) . ' vs prev</div></div>';
}
?>
<div class="filters">
  <form method="get" style="display:flex;gap:8px;align-items:center">
    <label>Range</label>
    <select name="range" onchange="this.form.submit()">
      <?php foreach (['7' => 'Last 7 days', '28' => 'Last 28 days', '90' => 'Last 90 days', '365' => 'Last 12 months'] as $v => $t): ?>
        <option value="<?= $v ?>" <?= (string)$days === $v ? 'selected' : '' ?>><?= $t ?></option>
      <?php endforeach; ?>
    </select>
  </form>
  <span style="margin-left:auto"><span class="dot"></span><a href="/admin/live.php"><?= st_live_count() ?> active now</a></span>
</div>

<div class="cards">
  <?php
  kpi('New visitors', number_format($k['cur']['new']), st_delta($k['cur']['new'], $k['prev']['new']));
  kpi('All visitors', number_format($k['cur']['visitors']), st_delta($k['cur']['visitors'], $k['prev']['visitors']));
  kpi('Sessions', number_format($k['cur']['sessions']), st_delta($k['cur']['sessions'], $k['prev']['sessions']));
  kpi('Page views', number_format($k['cur']['pageviews']), st_delta($k['cur']['pageviews'], $k['prev']['pageviews']));
  kpi('Avg. session', fmt_dur($k['cur']['avgdur']), st_delta($k['cur']['avgdur'], $k['prev']['avgdur']));
  kpi('Bounce rate', round($k['cur']['bounce']) . '%', st_delta($k['prev']['bounce'], $k['cur']['bounce']));
  ?>
</div>

<div class="panel">
  <div class="panel-head"><h2>Leads (last <?= $days ?> days)</h2>
    <a class="btn-ghost btn-sm" href="/admin/submissions.php">Open inbox<?= $leadsNew ? ' · ' . $leadsNew . ' new' : '' ?></a></div>
  <div class="panel-body" style="display:flex;gap:32px;flex-wrap:wrap">
    <div><div class="stat"><div class="label">Demo bookings</div>
      <div class="value"><a href="/admin/submissions.php?ftype=demo" style="text-decoration:none"><?= number_format($leads['demo']) ?></a></div></div></div>
    <div><div class="stat"><div class="label">Contact enquiries</div>
      <div class="value"><a href="/admin/submissions.php?ftype=contact" style="text-decoration:none"><?= number_format($leads['contact']) ?></a></div></div></div>
    <div><div class="stat"><div class="label">Instructor applications</div>
      <div class="value"><a href="/admin/submissions.php?ftype=instructor" style="text-decoration:none"><?= number_format($leads['instructor']) ?></a></div></div></div>
  </div>
</div>

<div class="panel">
  <div class="panel-head"><h2>New vs returning visitors</h2></div>
  <div class="panel-body"><div class="chart-box"><canvas id="visChart"></canvas></div></div>
</div>

<div class="grid-2">
  <div class="panel">
    <div class="panel-head"><h2>Top pages</h2><a class="btn-ghost btn-sm" href="/admin/pageviews.php">All</a></div>
    <div class="table-wrap"><table class="data"><tbody>
      <?php foreach ($topPages as $r): ?>
      <tr><td class="wrap"><a href="/admin/pageviews.php?path=<?= urlencode($r['path']) ?>"><?= h($r['path']) ?></a></td>
        <td style="width:45%"><span class="mini-bar" style="width:<?= round($r['c'] / $maxPage * 100) ?>%"></span> <?= number_format($r['c']) ?></td></tr>
      <?php endforeach; ?>
      <?php if (!$topPages): ?><tr><td class="empty">No data yet</td></tr><?php endif; ?>
    </tbody></table></div>
  </div>

  <div class="panel">
    <div class="panel-head"><h2>Top referrers</h2></div>
    <div class="table-wrap"><table class="data"><tbody>
      <?php foreach ($topRef as $r): ?>
        <tr><td class="wrap"><?= h($r['host']) ?></td><td><?= number_format($r['c']) ?></td></tr>
      <?php endforeach; ?>
      <?php if (!$topRef): ?><tr><td class="empty">No data yet</td></tr><?php endif; ?>
    </tbody></table></div>
  </div>

  <div class="panel">
    <div class="panel-head"><h2>Channels</h2></div>
    <div class="table-wrap"><table class="data"><tbody>
      <?php foreach ($channels as $r): ?>
        <tr><td style="text-transform:capitalize"><?= h($r['ch']) ?></td><td><?= number_format($r['c']) ?></td></tr>
      <?php endforeach; ?>
      <?php if (!$channels): ?><tr><td class="empty">No data yet</td></tr><?php endif; ?>
    </tbody></table></div>
  </div>

  <div class="panel">
    <div class="panel-head"><h2>Devices</h2></div>
    <div class="table-wrap"><table class="data"><tbody>
      <?php foreach ($devices as $r): ?>
        <tr><td style="text-transform:capitalize"><?= h($r['d']) ?></td><td><?= number_format($r['c']) ?></td></tr>
      <?php endforeach; ?>
      <?php if (!$devices): ?><tr><td class="empty">No data yet</td></tr><?php endif; ?>
    </tbody></table></div>
  </div>

  <div class="panel">
    <div class="panel-head"><h2>Top countries</h2></div>
    <div class="table-wrap"><table class="data"><tbody>
      <?php foreach ($countries as $r): ?>
        <tr><td><?= h($r['cc']) ?></td><td><?= number_format($r['c']) ?></td></tr>
      <?php endforeach; ?>
      <?php if (!$countries): ?><tr><td class="empty">No data yet</td></tr><?php endif; ?>
    </tbody></table></div>
  </div>

  <div class="panel">
    <div class="panel-head"><h2>Latest form submissions</h2><a class="btn-ghost btn-sm" href="/admin/submissions.php">All</a></div>
    <div class="table-wrap"><table class="data"><tbody>
      <?php foreach ($recentSubs as $r): ?>
        <tr>
          <td><a href="/admin/submissions.php?id=<?= (int)$r['id'] ?>"><?= h($r['name'] ?: $r['email']) ?></a></td>
          <td><?= h($r['form_type']) ?></td>
          <td><span class="tag <?= h($r['status']) ?>"><?= h($r['status']) ?></span></td>
          <td><?= h(fmt_ago($r['created_at'])) ?></td>
        </tr>
      <?php endforeach; ?>
      <?php if (!$recentSubs): ?><tr><td class="empty">No submissions yet</td></tr><?php endif; ?>
    </tbody></table></div>
  </div>
</div>

<?php
$PAGE_SCRIPT = 'const D=' . json_encode($daily) . ';'
. 'new Chart(document.getElementById("visChart"),{type:"line",data:{labels:D.labels,'
. 'datasets:[{label:"New",data:D.new,borderColor:"#2563eb",backgroundColor:"rgba(37,99,235,.12)",fill:true,tension:.3},'
. '{label:"Returning",data:D.ret,borderColor:"#16a34a",backgroundColor:"rgba(22,163,74,.10)",fill:true,tension:.3}]},'
. 'options:{maintainAspectRatio:false,plugins:{legend:{position:"bottom"}},scales:{y:{beginAtZero:true,ticks:{precision:0}}}}});';
require __DIR__ . '/inc/footer.php';
