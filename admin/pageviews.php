<?php
require __DIR__ . '/inc/bootstrap.php';
require_login();
require __DIR__ . '/inc/stats.php';
$db = admin_db();

$page = pg_int('p', 1, 1, 100000);
$per = 50;
$path = q_str('path', 512);
$incBot = isset($_GET['bots']);
$days = range_days();

$w = ['pv.created_at >= ?'];
$args = [st_since($days)];
if (!$incBot) $w[] = 'pv.is_bot=0 AND pv.excluded=0';
if ($path !== '') { $w[] = 'pv.path=?'; $args[] = $path; }
$where = implode(' AND ', $w);

$cs = $db->prepare("SELECT COUNT(*) FROM pageviews pv WHERE $where");
$cs->execute($args);
$total = (int) $cs->fetchColumn();
$pages = max(1, (int) ceil($total / $per));
$page = min($page, $pages);

$rows = $db->prepare("SELECT pv.* FROM pageviews pv WHERE $where ORDER BY pv.created_at DESC LIMIT $per OFFSET " . (($page - 1) * $per));
$rows->execute($args);
$rows = $rows->fetchAll();

// summary by path for the window
$summary = $db->prepare("SELECT path, COUNT(*) views, COUNT(DISTINCT visitor_id) visitors,
        ROUND(AVG(time_on_page_sec)) avg_time, ROUND(AVG(max_scroll_pct)) avg_scroll
        FROM pageviews pv WHERE $where GROUP BY path ORDER BY views DESC LIMIT 100");
$summary->execute($args);
$summary = $summary->fetchAll();

$PAGE_TITLE = 'Page Views';
$ACTIVE = 'pageviews';
require __DIR__ . '/inc/header.php';
?>
<form class="filters" method="get">
  <input type="search" name="path" placeholder="Filter by exact path e.g. /courses/" value="<?= h($path) ?>" style="min-width:240px">
  <select name="range">
    <?php foreach (['7' => '7 days', '28' => '28 days', '90' => '90 days'] as $v => $t): ?>
      <option value="<?= $v ?>" <?= (string)$days === $v ? 'selected' : '' ?>><?= $t ?></option>
    <?php endforeach; ?>
  </select>
  <label style="font-weight:500"><input type="checkbox" name="bots" value="1" <?= $incBot ? 'checked' : '' ?>> include bots</label>
  <button class="btn btn-sm">Filter</button>
  <a class="btn-ghost btn-sm" href="/admin/export.php?type=pageviews&<?= h($_SERVER['QUERY_STRING'] ?? '') ?>">Export CSV</a>
</form>

<div class="panel"><div class="panel-head"><h2>By page (last <?= $days ?> days)</h2></div>
<div class="table-wrap"><table class="data">
  <thead><tr><th>Path</th><th>Views</th><th>Visitors</th><th>Avg time</th><th>Avg scroll</th></tr></thead>
  <tbody>
  <?php foreach ($summary as $r): ?>
    <tr><td class="wrap"><a href="?path=<?= urlencode($r['path']) ?>&range=<?= $days ?>"><?= h($r['path']) ?></a></td>
      <td><?= number_format($r['views']) ?></td><td><?= number_format($r['visitors']) ?></td>
      <td><?= $r['avg_time'] !== null ? (int)$r['avg_time'] . 's' : '—' ?></td>
      <td><?= $r['avg_scroll'] !== null ? (int)$r['avg_scroll'] . '%' : '—' ?></td></tr>
  <?php endforeach; ?>
  <?php if (!$summary): ?><tr><td colspan="5" class="empty">No page views in range.</td></tr><?php endif; ?>
  </tbody>
</table></div></div>

<div class="panel"><div class="panel-head"><h2>Individual page views</h2><span style="color:var(--muted);font-size:13px"><?= number_format($total) ?> rows</span></div>
<div class="table-wrap"><table class="data">
  <thead><tr><th>Time</th><th>Path</th><th>Visitor</th><th>Referrer</th><th>Time on page</th><th>Scroll</th><th>Entry</th></tr></thead>
  <tbody>
  <?php foreach ($rows as $r): ?>
    <tr><td><?= h($r['created_at']) ?></td>
      <td class="wrap"><?= h($r['path']) ?><?= $r['query'] ? h('?' . $r['query']) : '' ?></td>
      <td><a href="/admin/visitors.php?id=<?= (int)$r['visitor_id'] ?>">#<?= (int)$r['visitor_id'] ?></a></td>
      <td><?= h(ck_host($r['referrer']) ?: '—') ?></td>
      <td><?= $r['time_on_page_sec'] !== null ? (int)$r['time_on_page_sec'] . 's' : '—' ?></td>
      <td><?= $r['max_scroll_pct'] !== null ? (int)$r['max_scroll_pct'] . '%' : '—' ?></td>
      <td><?= $r['is_entry'] ? 'yes' : '' ?></td></tr>
  <?php endforeach; ?>
  <?php if (!$rows): ?><tr><td colspan="7" class="empty">No page views.</td></tr><?php endif; ?>
  </tbody>
</table></div></div>
<?php require __DIR__ . '/inc/_pager.php'; ?>
<?php require __DIR__ . '/inc/footer.php'; ?>
