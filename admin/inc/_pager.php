<?php
/** Shared pager. Expects $page, $pages in scope. Preserves other query params. */
if (($pages ?? 1) < 2) return;
$qs = $_GET;
$link = function ($p) use ($qs) {
    $qs['p'] = $p;
    return '?' . http_build_query($qs);
};
?>
<div class="pager">
  <?php if ($page > 1): ?><a href="<?= h($link($page - 1)) ?>">&larr; Prev</a><?php endif; ?>
  <?php
  $lo = max(1, $page - 3);
  $hi = min($pages, $page + 3);
  if ($lo > 1) echo '<a href="' . h($link(1)) . '">1</a><span>…</span>';
  for ($i = $lo; $i <= $hi; $i++) {
      echo $i === $page
          ? '<span class="cur">' . $i . '</span>'
          : '<a href="' . h($link($i)) . '">' . $i . '</a>';
  }
  if ($hi < $pages) echo '<span>…</span><a href="' . h($link($pages)) . '">' . $pages . '</a>';
  ?>
  <?php if ($page < $pages): ?><a href="<?= h($link($page + 1)) ?>">Next &rarr;</a><?php endif; ?>
</div>
