<?php
/* Decorations inside the hero: marigold garland, floating golden particles, and a row of lit diyas.
   Everything is aria-hidden, non-interactive and positioned so it never covers hero text. */
$dw_diya = '<svg class="dw-diya" viewBox="0 0 64 56" width="44" height="38" aria-hidden="true" focusable="false">'
    . '<path d="M4 28 Q32 62 60 28 Q32 36 4 28z" fill="#b8570f"/>'
    . '<ellipse cx="32" cy="28" rx="28" ry="6" fill="#f6b25b"/><ellipse cx="32" cy="28" rx="22" ry="4" fill="#7a2f06"/>'
    . '<g class="dw-flame"><path d="M32 3 C40 13 42 21 32 28 C22 21 24 13 32 3z" fill="#ffd166"/>'
    . '<path d="M32 12 C36 18 37 22 32 27 C27 22 28 18 32 12z" fill="#ff8a00"/></g></svg>';
?>
        <div class="dw-garland" aria-hidden="true"></div>
        <div class="dw-particles" aria-hidden="true">
<?php for ($dw_i = 0; $dw_i < 14; $dw_i++): ?>
          <span style="--x:<?= 4 + $dw_i * 7 ?>%;--s:<?= 3 + ($dw_i % 4) ?>px;--d:<?= 9 + ($dw_i * 5) % 7 ?>s;--delay:-<?= ($dw_i * 3) % 11 ?>s"></span>
<?php endfor; ?>
        </div>
        <div class="dw-diya-row" aria-hidden="true">
<?php for ($dw_i = 0; $dw_i < 9; $dw_i++) echo '          ', $dw_diya, "\n"; ?>
        </div>
