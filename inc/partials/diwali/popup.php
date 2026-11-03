<?php
/* Diwali promotional popup. Behaviour lives in /assets/diwali/diwali.js (10s delay, 24h suppression). */
$dw = ck_diwali();
$pp = $dw['popup'];
$h  = static fn(string $s): string => htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
?>
    <div class="dw-popup" id="dwPopup" hidden
         data-delay="<?= (int) $pp['delay_seconds'] ?>" data-hours="<?= (int) $pp['suppress_hours'] ?>"
         data-key="ck_diwali_popup_dismissed_<?= $h(preg_replace('/[^a-z0-9_-]/i', '', $dw['campaign'])) ?>">
      <div class="dw-popup-card" role="dialog" aria-modal="true" aria-labelledby="dwPopupTitle" aria-describedby="dwPopupText" tabindex="-1">
        <button type="button" class="dw-popup-close" id="dwPopupClose" aria-label="Close Diwali offer">
          <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false"><path d="M5 5l14 14M19 5L5 19" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" fill="none"/></svg>
        </button>
        <div class="dw-popup-scroll">
        <div class="dw-popup-art">
          <img src="/Images/diwali/diwali-popup-art-sm.webp"
               srcset="/Images/diwali/diwali-popup-art-sm.webp 480w, /Images/diwali/diwali-popup-art.webp 960w"
               sizes="(max-width: 560px) 92vw, 520px" alt="" width="960" height="540" decoding="async" />
          <span class="dw-popup-badge">Diwali Special</span>
        </div>
        <div class="dw-popup-body">
          <h2 id="dwPopupTitle"><?= $h($pp['headline']) ?></h2>
          <p id="dwPopupText"><?= $h($pp['message']) ?></p>
<?php if ($pp['offer'] !== ''): ?>
          <p class="dw-popup-offer"><?= $h($pp['offer']) ?></p>
<?php endif; ?>
          <div class="dw-popup-actions">
            <a class="dw-btn dw-btn-primary" href="<?= $h($pp['primary_url']) ?>" data-dw-cta><?= $h($pp['primary_label']) ?></a>
            <a class="dw-btn dw-btn-ghost" href="<?= $h($pp['secondary_url']) ?>" data-dw-cta><?= $h($pp['secondary_label']) ?></a>
          </div>
          <button type="button" class="dw-popup-later" id="dwPopupLater">Maybe later</button>
        </div>
        </div>
      </div>
    </div>
    <script src="<?= ck_diwali_asset('diwali.js') ?>" defer></script>
