<?php
require __DIR__ . '/inc/bootstrap.php';
require_login();
require __DIR__ . '/inc/stats.php';
$db = admin_db();

$page = pg_int('p', 1, 1, 100000);
$per = 50;
$type = q_str('type', 32);
$incBot = isset($_GET['bots']);
$days = range_days();

$w = ['e.created_at >= ?'];
$args = [st_since($days)];
if (!$incBot) $w[] = 'e.is_bot=0 AND e.excluded=0';
if ($type !== '') { $w[] = 'e.type=?'; $args[] = $type; }
$where = implode(' AND ', $w);

$cs = $db->prepare("SELECT COUNT(*) FROM events e WHERE $where");
$cs->execute($args);
$total = (int) $cs->fetchColumn();
$pages = max(1, (int) ceil($total / $per));
$page = min($page, $pages);

$rows = $db->prepare("SELECT e.* FROM events e WHERE $where ORDER BY e.created_at DESC LIMIT $per OFFSET " . (($page - 1) * $per));
$rows->execute($args);
$rows = $rows->fetchAll();

$byType = $db->prepare("SELECT type, COUNT(*) c FROM events e WHERE $where GROUP BY type ORDER BY c DESC");
$byType->execute($args);
$byType = $byType->fetchAll();

$topCta = $db->prepare("SELECT label, COUNT(*) c FROM events e WHERE $where AND e.type IN ('cta','click')
                        AND label<>'' GROUP BY label ORDER BY c DESC LIMIT 15");
$topCta->execute($args);
$topCta = $topCta->fetchAll();

$PAGE_TITLE = 'Interactions';
$ACTIVE = 'events';
require __DIR__ . '/inc/header.php';
?>
<form class="filters" method="get">
  <select name="type">
    <option value="">All types</option>
    <?php foreach (['cta', 'click', 'outbound', 'tel', 'mailto', 'download', 'form_start', 'form_submit', 'form_abandon', 'scroll_milestone'] as $t): ?>
      <option value="<?= $t ?>" <?= $type === $t ? 'selected' : '' ?>><?= $t ?></option>
    <?php endforeach; ?>
  </select>
  <select name="range">
    <?php foreach (['7' => '7 days', '28' => '28 days', '90' => '90 days'] as $v => $t): ?>
      <option value="<?= $v ?>" <?= (string)$days === $v ? 'selected' : '' ?>><?= $t ?></option>
    <?php endforeach; ?>
  </select>
  <label style="font-weight:500"><input type="checkbox" name="bots" value="1" <?= $incBot ? 'checked' : '' ?>> include bots</label>
  <button class="btn btn-sm">Filter</button>
  <a class="btn-ghost btn-sm" href="/admin/export.php?type=events&<?= h($_SERVER['QUERY_STRING'] ?? '') ?>">Export CSV</a>
</form>

<div class="grid-2">
  <div class="panel"><div class="panel-head"><h2>By type</h2></div><div class="table-wrap"><table class="data"><tbody>
    <?php foreach ($byType as $r): ?><tr><td><?= h($r['type']) ?></td><td><?= number_format($r['c']) ?></td></tr><?php endforeach; ?>
    <?php if (!$byType): ?><tr><td class="empty">No events yet</td></tr><?php endif; ?>
  </tbody></table></div></div>
  <div class="panel"><div class="panel-head"><h2>Most clicked</h2></div><div class="table-wrap"><table class="data"><tbody>
    <?php foreach ($topCta as $r): ?><tr><td class="wrap"><?= h($r['label']) ?></td><td><?= number_format($r['c']) ?></td></tr><?php endforeach; ?>
    <?php if (!$topCta): ?><tr><td class="empty">No clicks yet</td></tr><?php endif; ?>
  </tbody></table></div></div>
</div>

<div class="panel"><div class="panel-head"><h2>Event log</h2><span style="color:var(--muted);font-size:13px"><?= number_format($total) ?> rows</span></div>
<div class="table-wrap"><table class="data">
  <thead><tr><th>Time</th><th>Type</th><th>Label</th><th>Detail</th><th>Page</th><th>Visitor</th></tr></thead>
  <tbody>
  <?php foreach ($rows as $r): ?>
    <tr><td><?= h($r['created_at']) ?></td><td><span class="tag"><?= h($r['type']) ?></span></td>
      <td class="wrap"><?= h($r['label']) ?></td><td class="wrap"><?= h($r['detail']) ?></td>
      <td><?= h($r['path']) ?></td>
      <td><a href="/admin/visitors.php?id=<?= (int)$r['visitor_id'] ?>">#<?= (int)$r['visitor_id'] ?></a></td></tr>
  <?php endforeach; ?>
  <?php if (!$rows): ?><tr><td colspan="6" class="empty">No interactions recorded.</td></tr><?php endif; ?>
  </tbody>
</table></div></div>
<?php require __DIR__ . '/inc/_pager.php'; ?>
<?php require __DIR__ . '/inc/footer.php'; ?>
