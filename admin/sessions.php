<?php
require __DIR__ . '/inc/bootstrap.php';
require_login();
require __DIR__ . '/inc/stats.php';
$db = admin_db();

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $s = $db->prepare('SELECT * FROM sessions WHERE id=?');
    $s->execute([$id]);
    $sess = $s->fetch();
    if (!$sess) { http_response_code(404); exit('Not found'); }
    $pv = $db->prepare('SELECT * FROM pageviews WHERE session_id=? ORDER BY created_at');
    $pv->execute([$id]);
    $pv = $pv->fetchAll();
    $ev = $db->prepare('SELECT * FROM events WHERE session_id=? ORDER BY created_at');
    $ev->execute([$id]);
    $ev = $ev->fetchAll();
    $items = [];
    foreach ($pv as $r) $items[] = ['ts' => $r['created_at'], 'k' => 'pv', 'r' => $r];
    foreach ($ev as $r) $items[] = ['ts' => $r['created_at'], 'k' => 'ev', 'r' => $r];
    usort($items, fn($a, $b) => strcmp($a['ts'], $b['ts']));

    $PAGE_TITLE = 'Session ' . substr($sess['sid'], 0, 8);
    $ACTIVE = 'sessions';
    require __DIR__ . '/inc/header.php'; ?>
    <p class="crumb"><a href="/admin/sessions.php">&larr; All sessions</a> ·
       <a href="/admin/visitors.php?id=<?= (int)$sess['visitor_id'] ?>">Visitor profile</a></p>
    <div class="panel"><div class="panel-body"><dl class="kv">
      <dt>Started</dt><dd><?= h($sess['started_at']) ?></dd>
      <dt>Duration</dt><dd><?= h(fmt_dur($sess['duration_sec'])) ?></dd>
      <dt>Pages / events</dt><dd><?= (int)$sess['pageviews'] ?> / <?= (int)$sess['events'] ?></dd>
      <dt>Channel</dt><dd style="text-transform:capitalize"><?= h($sess['channel'] ?: 'direct') ?></dd>
      <dt>Referrer</dt><dd><?= h($sess['referrer'] ?: '(direct)') ?></dd>
      <dt>UTM</dt><dd><?= h(trim(implode(' / ', array_filter([$sess['utm_source'], $sess['utm_medium'], $sess['utm_campaign']])), ' /')) ?: '—' ?></dd>
      <dt>Entry / exit</dt><dd><?= h($sess['entry_path']) ?> &rarr; <?= h($sess['exit_path'] ?: $sess['entry_path']) ?></dd>
      <dt>Bounce</dt><dd><?= $sess['is_bounce'] ? 'Yes' : 'No' ?></dd>
    </dl></div></div>
    <div class="panel"><div class="panel-head"><h2>Timeline</h2></div><div class="panel-body">
      <ul class="timeline">
      <?php foreach ($items as $it): $r = $it['r']; ?>
        <li>
        <?php if ($it['k'] === 'pv'): ?>
          <strong><?= h($r['path']) ?></strong>
          <div class="t-meta"><?= h(substr($r['created_at'], 11, 8)) ?>
          <?= $r['time_on_page_sec'] !== null ? ' · ' . (int)$r['time_on_page_sec'] . 's' : '' ?>
          <?= $r['max_scroll_pct'] !== null ? ' · ' . (int)$r['max_scroll_pct'] . '% scroll' : '' ?>
          <?= $r['viewport_w'] ? ' · ' . (int)$r['viewport_w'] . '×' . (int)$r['viewport_h'] : '' ?></div>
        <?php else: ?>
          <span class="tag"><?= h($r['type']) ?></span> <?= h($r['label']) ?>
          <?= $r['detail'] ? ' <span class="t-meta">— ' . h($r['detail']) . '</span>' : '' ?>
          <div class="t-meta"><?= h(substr($r['created_at'], 11, 8)) ?> · <?= h($r['path']) ?></div>
        <?php endif; ?>
        </li>
      <?php endforeach; ?>
      </ul>
    </div></div>
    <?php require __DIR__ . '/inc/footer.php'; exit;
}

$page = pg_int('p', 1, 1, 100000);
$per = 40;
$incBot = isset($_GET['bots']);
$ch = q_str('channel', 24);
$w = ['1=1']; $args = [];
if (!$incBot) $w[] = 's.is_bot=0 AND s.excluded=0';
if ($ch !== '') { $w[] = 's.channel=?'; $args[] = $ch; }
$where = implode(' AND ', $w);

$cs = $db->prepare("SELECT COUNT(*) FROM sessions s WHERE $where");
$cs->execute($args);
$total = (int) $cs->fetchColumn();
$pages = max(1, (int) ceil($total / $per));
$page = min($page, $pages);
$rows = $db->prepare("SELECT s.* FROM sessions s WHERE $where ORDER BY s.started_at DESC LIMIT $per OFFSET " . (($page - 1) * $per));
$rows->execute($args);
$rows = $rows->fetchAll();

$PAGE_TITLE = 'Sessions';
$ACTIVE = 'sessions';
require __DIR__ . '/inc/header.php';
?>
<form class="filters" method="get">
  <select name="channel">
    <option value="">All channels</option>
    <?php foreach (['direct', 'organic', 'social', 'referral', 'paid', 'email'] as $c): ?>
      <option value="<?= $c ?>" <?= $ch === $c ? 'selected' : '' ?>><?= ucfirst($c) ?></option>
    <?php endforeach; ?>
  </select>
  <label style="font-weight:500"><input type="checkbox" name="bots" value="1" <?= $incBot ? 'checked' : '' ?>> include bots</label>
  <button class="btn btn-sm">Filter</button>
  <a class="btn-ghost btn-sm" href="/admin/export.php?type=sessions&<?= h($_SERVER['QUERY_STRING'] ?? '') ?>">Export CSV</a>
  <span style="margin-left:auto;color:var(--muted)"><?= number_format($total) ?> sessions</span>
</form>
<div class="panel"><div class="table-wrap"><table class="data">
  <thead><tr><th>Started</th><th>Visitor</th><th>Entry</th><th>Channel</th><th>Referrer</th><th>Pages</th><th>Duration</th><th>Bounce</th></tr></thead>
  <tbody>
  <?php foreach ($rows as $r): ?>
    <tr>
      <td><a href="?id=<?= (int)$r['id'] ?>"><?= h($r['started_at']) ?></a></td>
      <td><a href="/admin/visitors.php?id=<?= (int)$r['visitor_id'] ?>">#<?= (int)$r['visitor_id'] ?></a></td>
      <td class="wrap"><?= h($r['entry_path']) ?></td>
      <td style="text-transform:capitalize"><?= h($r['channel'] ?: 'direct') ?></td>
      <td><?= h($r['referrer_host'] ?: '—') ?></td>
      <td><?= (int)$r['pageviews'] ?></td>
      <td><?= h(fmt_dur($r['duration_sec'])) ?></td>
      <td><?= $r['is_bounce'] ? '<span class="tag">yes</span>' : 'no' ?></td>
    </tr>
  <?php endforeach; ?>
  <?php if (!$rows): ?><tr><td colspan="8" class="empty">No sessions.</td></tr><?php endif; ?>
  </tbody>
</table></div></div>
<?php require __DIR__ . '/inc/_pager.php'; ?>
<?php require __DIR__ . '/inc/footer.php'; ?>
