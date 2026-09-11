<?php
require __DIR__ . '/inc/bootstrap.php';
require_login();
require __DIR__ . '/inc/stats.php';
$db = admin_db();

/* ---------------- detail view ---------------- */
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $v = $db->prepare('SELECT * FROM visitors WHERE id=?');
    $v->execute([$id]);
    $vis = $v->fetch();
    if (!$vis) { http_response_code(404); exit('Visitor not found'); }

    $sessions = $db->prepare('SELECT * FROM sessions WHERE visitor_id=? ORDER BY started_at DESC');
    $sessions->execute([$id]);
    $sessions = $sessions->fetchAll();

    $pv = $db->prepare('SELECT * FROM pageviews WHERE visitor_id=? ORDER BY created_at DESC LIMIT 500');
    $pv->execute([$id]);
    $pvBySession = [];
    foreach ($pv as $row) $pvBySession[$row['session_id']][] = $row;

    $ev = $db->prepare('SELECT * FROM events WHERE visitor_id=? ORDER BY created_at DESC LIMIT 500');
    $ev->execute([$id]);
    $evBySession = [];
    foreach ($ev as $row) $evBySession[$row['session_id']][] = $row;

    $subs = $db->prepare('SELECT id,form_type,created_at,status FROM form_submissions WHERE visitor_id=? ORDER BY created_at DESC');
    $subs->execute([$id]);
    $subs = $subs->fetchAll();

    $PAGE_TITLE = 'Visitor #' . $id;
    $ACTIVE = 'visitors';
    require __DIR__ . '/inc/header.php';
    ?>
    <p class="crumb"><a href="/admin/visitors.php">&larr; All visitors</a></p>

    <div class="grid-2">
      <div class="panel"><div class="panel-head"><h2>Profile</h2>
        <?php if ($vis['is_bot']): ?><span class="tag bot">bot</span><?php endif; ?></div>
        <div class="panel-body"><dl class="kv">
          <dt>Visitor ID</dt><dd><?= h($vis['uid']) ?></dd>
          <dt>First seen</dt><dd><?= h($vis['first_seen']) ?></dd>
          <dt>Last seen</dt><dd><?= h($vis['last_seen']) ?> &nbsp;<span class="tag"><?= h(fmt_ago($vis['last_seen'])) ?></span></dd>
          <dt>Visits / views</dt><dd><?= (int)$vis['visits'] ?> visits · <?= (int)$vis['pageviews'] ?> page views</dd>
          <dt>Location</dt><dd><?= h(trim(($vis['city'] ? $vis['city'] . ', ' : '') . ($vis['region'] ? $vis['region'] . ', ' : '') . $vis['country'], ', ')) ?: '—' ?></dd>
          <dt>IP</dt><dd><?= h($vis['ip'] ?: '—') ?></dd>
          <dt>Device</dt><dd><?= h(ucfirst($vis['device_type'] ?: '?')) ?> · <?= h($vis['browser']) ?> <?= h($vis['browser_version']) ?> · <?= h($vis['os']) ?></dd>
          <dt>Screen</dt><dd><?= $vis['screen_w'] ? h($vis['screen_w'] . '×' . $vis['screen_h']) : '—' ?></dd>
          <dt>User agent</dt><dd style="font-size:12px"><?= h($vis['ua']) ?></dd>
        </dl></div>
      </div>

      <div class="panel"><div class="panel-head"><h2>Acquisition (first visit)</h2></div>
        <div class="panel-body"><dl class="kv">
          <dt>Landing page</dt><dd><?= h($vis['first_landing'] ?: '—') ?></dd>
          <dt>Referrer</dt><dd><?= h($vis['first_referrer'] ?: '(direct / none)') ?></dd>
          <dt>UTM source</dt><dd><?= h($vis['first_utm_source'] ?: '—') ?></dd>
          <dt>UTM medium</dt><dd><?= h($vis['first_utm_medium'] ?: '—') ?></dd>
          <dt>UTM campaign</dt><dd><?= h($vis['first_utm_campaign'] ?: '—') ?></dd>
          <dt>Form submissions</dt><dd>
            <?php if ($subs): foreach ($subs as $s): ?>
              <a href="/admin/submissions.php?id=<?= (int)$s['id'] ?>"><?= h($s['form_type']) ?></a>
              <span class="tag <?= h($s['status']) ?>"><?= h($s['status']) ?></span><br>
            <?php endforeach; else: ?>—<?php endif; ?>
          </dd>
        </dl></div>
      </div>
    </div>

    <div class="panel">
      <div class="panel-head"><h2>Full journey — <?= count($sessions) ?> session(s)</h2></div>
      <div class="panel-body">
        <?php foreach ($sessions as $s):
            $items = [];
            foreach ($pvBySession[$s['id']] ?? [] as $p) $items[] = ['ts' => $p['created_at'], 'kind' => 'pv', 'row' => $p];
            foreach ($evBySession[$s['id']] ?? [] as $e) $items[] = ['ts' => $e['created_at'], 'kind' => 'ev', 'row' => $e];
            usort($items, fn($a, $b) => strcmp($a['ts'], $b['ts']));
        ?>
        <div style="margin-bottom:22px">
          <h3 style="font-size:14px;margin-bottom:4px">
            <a href="/admin/sessions.php?id=<?= (int)$s['id'] ?>">Session <?= h(substr($s['sid'], 0, 8)) ?></a>
            <span class="tag" style="text-transform:capitalize"><?= h($s['channel'] ?: 'direct') ?></span>
          </h3>
          <p class="t-meta" style="margin:0 0 10px">
            <?= h($s['started_at']) ?> · <?= h(fmt_dur($s['duration_sec'])) ?> · <?= (int)$s['pageviews'] ?> views · <?= (int)$s['events'] ?> events
            <?= $s['referrer_host'] ? ' · from ' . h($s['referrer_host']) : '' ?>
          </p>
          <ul class="timeline">
            <?php foreach ($items as $it): $r = $it['row']; ?>
              <li>
                <?php if ($it['kind'] === 'pv'): ?>
                  <strong><?= h($r['path']) ?></strong><?= $r['query'] ? h('?' . $r['query']) : '' ?>
                  <div class="t-meta"><?= h(substr($r['created_at'], 11, 8)) ?>
                    <?= $r['time_on_page_sec'] !== null ? ' · ' . (int)$r['time_on_page_sec'] . 's on page' : '' ?>
                    <?= $r['max_scroll_pct'] !== null ? ' · scrolled ' . (int)$r['max_scroll_pct'] . '%' : '' ?>
                  </div>
                <?php else: ?>
                  <span class="tag"><?= h($r['type']) ?></span> <?= h($r['label']) ?>
                  <?= $r['detail'] ? '<span class="t-meta"> — ' . h($r['detail']) . '</span>' : '' ?>
                  <div class="t-meta"><?= h(substr($r['created_at'], 11, 8)) ?> · <?= h($r['path']) ?></div>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
            <?php if (!$items): ?><li class="t-meta">No detailed activity recorded.</li><?php endif; ?>
          </ul>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php
    require __DIR__ . '/inc/footer.php';
    exit;
}

/* ---------------- list view ---------------- */
$page = pg_int('p', 1, 1, 100000);
$per  = 40;
$type = $_GET['type'] ?? 'all';   // all | new | returning
$incBot = isset($_GET['bots']);
$search = q_str('q');

$w = ['1=1'];
$args = [];
if (!$incBot) { $w[] = 'v.is_bot=0 AND v.excluded=0'; }
if ($type === 'new')       { $w[] = 'v.visits=1'; }
if ($type === 'returning') { $w[] = 'v.visits>1'; }
if ($search !== '') {
    $w[] = '(v.uid=? OR v.ip=? OR v.city LIKE ? OR v.country=? OR v.first_referrer_host LIKE ?)';
    array_push($args, $search, $search, "%$search%", strtoupper(substr($search, 0, 2)), "%$search%");
}
$where = implode(' AND ', $w);

$total = (function () use ($db, $where, $args) {
    $s = $db->prepare("SELECT COUNT(*) FROM visitors v WHERE $where");
    $s->execute($args);
    return (int) $s->fetchColumn();
})();
$pages = max(1, (int) ceil($total / $per));
$page = min($page, $pages);

$rows = $db->prepare("SELECT v.* FROM visitors v WHERE $where ORDER BY v.last_seen DESC LIMIT $per OFFSET " . (($page - 1) * $per));
$rows->execute($args);
$rows = $rows->fetchAll();

$PAGE_TITLE = 'Visitors';
$ACTIVE = 'visitors';
require __DIR__ . '/inc/header.php';
?>
<form class="filters" method="get">
  <input type="search" name="q" placeholder="Search UID / IP / city / country" value="<?= h($search) ?>" style="min-width:240px">
  <select name="type">
    <?php foreach (['all' => 'All visitors', 'new' => 'New only', 'returning' => 'Returning only'] as $k => $t): ?>
      <option value="<?= $k ?>" <?= $type === $k ? 'selected' : '' ?>><?= $t ?></option>
    <?php endforeach; ?>
  </select>
  <label style="font-weight:500"><input type="checkbox" name="bots" value="1" <?= $incBot ? 'checked' : '' ?>> include bots</label>
  <button class="btn btn-sm">Filter</button>
  <a class="btn-ghost btn-sm" href="/admin/export.php?type=visitors&<?= h($_SERVER['QUERY_STRING'] ?? '') ?>">Export CSV</a>
  <span style="margin-left:auto;color:var(--muted)"><?= number_format($total) ?> visitors</span>
</form>

<div class="panel"><div class="table-wrap"><table class="data">
  <thead><tr><th>Visitor</th><th>Location</th><th>Device</th><th>Source</th><th>Visits</th><th>Views</th><th>Last seen</th></tr></thead>
  <tbody>
  <?php foreach ($rows as $r): ?>
    <tr>
      <td><a href="?id=<?= (int)$r['id'] ?>"><?= h(substr($r['uid'], 0, 8)) ?></a>
        <?= $r['visits'] == 1 ? '<span class="tag new">new</span>' : '' ?>
        <?= $r['is_bot'] ? '<span class="tag bot">bot</span>' : '' ?></td>
      <td><?= h(trim(($r['city'] ? $r['city'] . ', ' : '') . $r['country'], ', ')) ?: '—' ?></td>
      <td><?= h(ucfirst($r['device_type'] ?: '?')) ?> · <?= h($r['browser'] ?: '?') ?></td>
      <td><?= h($r['first_referrer_host'] ?: ($r['first_utm_source'] ?: '(direct)')) ?></td>
      <td><?= (int)$r['visits'] ?></td>
      <td><?= (int)$r['pageviews'] ?></td>
      <td><?= h(fmt_ago($r['last_seen'])) ?></td>
    </tr>
  <?php endforeach; ?>
  <?php if (!$rows): ?><tr><td colspan="7" class="empty">No visitors match.</td></tr><?php endif; ?>
  </tbody>
</table></div></div>

<?php require __DIR__ . '/inc/_pager.php'; ?>
<?php require __DIR__ . '/inc/footer.php'; ?>
