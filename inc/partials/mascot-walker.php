<?php
/**
 * Codeksha mascot: a blue puppet holding a "Codeksha" sign that walks right -> left
 * along the bottom of the section. Click (or tap / Enter) and it does an action:
 * wave -> star jump -> dance -> "book a demo" sign shake, then carries on walking.
 *
 * Markup only. Motion is driven by /assets/mascot.js (every limb is posed per frame,
 * so feet stay planted while walking). Styles: /assets/mascot.css (linked below, so the partial works on any page design).
 * Usage: <?php require __DIR__ . '/inc/partials/mascot-walker.php'; ?>
 */
$ck_mascot_js_v  = (int) @filemtime(__DIR__ . '/../../assets/mascot.js');
$ck_mascot_css_v = (int) @filemtime(__DIR__ . '/../../assets/mascot.css');
?>
<link rel="stylesheet" href="/assets/mascot.css?v=<?= $ck_mascot_css_v ?>">
<div class="ck-mascot-strip" data-ck-mascot>
  <div class="ck-mascot-bubble" role="status" aria-live="polite"></div>
  <button type="button" class="ck-mascot-walker" aria-label="Codeksha mascot: click to say hi">
    <svg class="ck-mascot" viewBox="0 -30 190 154" aria-hidden="true" focusable="false">
      <defs>
        <radialGradient id="ckMascotBody" cx="42%" cy="36%" r="70%">
          <stop offset="0" stop-color="#6E9BFF"/>
          <stop offset=".55" stop-color="#2F6BF0"/>
          <stop offset="1" stop-color="#1D4ED8"/>
        </radialGradient>
        <linearGradient id="ckMascotWood" x1="0" x2="1" y1="0" y2="0">
          <stop offset="0" stop-color="#D99A5B"/>
          <stop offset="1" stop-color="#A9672F"/>
        </linearGradient>
      </defs>

      <ellipse class="ck-mascot-shadow" cx="60" cy="122" rx="30" ry="3.2" fill="#1e3a8a" opacity=".14"/>

      <g data-part="root">
        <!-- legs: hip -> ankle, path rebuilt every frame (knees bend) -->
        <path data-part="legL" d="M52 90 Q50 101 52 112" fill="none" stroke="#1C1917" stroke-width="6" stroke-linecap="round"/>
        <path data-part="legR" d="M68 90 Q66 101 68 112" fill="none" stroke="#1C1917" stroke-width="6" stroke-linecap="round"/>

        <!-- shoes: local origin = ankle -->
        <g data-part="shoeL" transform="translate(52 112)">
          <rect x="-13" y="-3" width="23" height="12" rx="6" fill="#2563EB" stroke="#1C1917" stroke-width="2"/>
          <rect x="-13" y="5" width="23" height="4.5" rx="2.25" fill="#fff" stroke="#1C1917" stroke-width="1.5"/>
          <path d="M-7 1 h7" stroke="#fff" stroke-width="1.6" stroke-linecap="round"/>
        </g>
        <g data-part="shoeR" transform="translate(68 112)">
          <rect x="-10" y="-3" width="23" height="12" rx="6" fill="#2563EB" stroke="#1C1917" stroke-width="2"/>
          <rect x="-10" y="5" width="23" height="4.5" rx="2.25" fill="#fff" stroke="#1C1917" stroke-width="1.5"/>
          <path d="M-4 1 h7" stroke="#fff" stroke-width="1.6" stroke-linecap="round"/>
        </g>

        <g data-part="body">
          <!-- free arm (pivot = shoulder 38,66) -->
          <g data-part="armL">
            <path d="M38 66 L24 80" stroke="#1C1917" stroke-width="6" stroke-linecap="round"/>
            <circle cx="23" cy="81" r="6.5" fill="#fff" stroke="#1C1917" stroke-width="2"/>
          </g>
          <!-- sign arm, drawn behind the body (pivot = shoulder 84,66) -->
          <g data-part="signArm">
            <path d="M80 66 Q102 78 119 71" fill="none" stroke="#1C1917" stroke-width="6" stroke-linecap="round"/>
          </g>

          <polygon points="60.0,16.0 66.0,33.8 78.5,24.0 76.3,39.7 95.5,35.5 82.2,50.0 96.0,56.0 82.2,62.0 94.6,76.0 76.3,72.3 79.0,88.9 66.0,78.2 60.0,97.0 54.0,78.2 41.5,88.0 43.7,72.3 25.4,76.0 37.8,62.0 24.0,56.0 37.8,50.0 24.5,35.5 43.7,39.7 41.0,23.1 54.0,33.8" fill="url(#ckMascotBody)" stroke="#2563EB" stroke-width="13" stroke-linejoin="round"/>

          <!-- face -->
          <ellipse cx="44" cy="63" rx="5.5" ry="3.2" fill="#FF8FA3" opacity=".75"/>
          <ellipse cx="77" cy="63" rx="5.5" ry="3.2" fill="#FF8FA3" opacity=".75"/>
          <g data-part="brows">
            <path d="M46 39 Q51 35.5 56 38" fill="none" stroke="#1C1917" stroke-width="2" stroke-linecap="round"/>
            <path d="M65 37.5 Q70 34.5 75 37.5" fill="none" stroke="#1C1917" stroke-width="2" stroke-linecap="round"/>
          </g>
          <g data-part="eyes">
            <ellipse cx="52" cy="50" rx="6.5" ry="8" fill="#fff"/>
            <ellipse cx="70" cy="50" rx="6.5" ry="8" fill="#fff"/>
            <g data-part="pupils">
              <circle cx="52" cy="50" r="3.8" fill="#1C1917"/>
              <circle cx="70" cy="50" r="3.8" fill="#1C1917"/>
              <circle cx="53.2" cy="48.4" r="1.3" fill="#fff"/>
              <circle cx="71.2" cy="48.4" r="1.3" fill="#fff"/>
            </g>
          </g>
          <g data-part="mouth">
            <path d="M52 62 Q61 75 70 62 Z" fill="#7A1E1E"/>
            <path d="M56 67 Q61 72 66 67 Q61 69.5 56 67Z" fill="#FF8FA3"/>
          </g>

          <!-- sign: stick, board, logo, gripping hand -->
          <g data-part="sign">
            <rect x="119" y="16" width="6" height="82" rx="3" fill="url(#ckMascotWood)"/>
            <rect x="70" y="-26" width="106" height="46" rx="9" fill="#2563EB"/>
            <rect x="74" y="-22" width="98" height="38" rx="6" fill="#fff"/>
            <circle cx="78.5" cy="-17.5" r="1.3" fill="#94A3B8"/>
            <circle cx="167.5" cy="-17.5" r="1.3" fill="#94A3B8"/>
            <circle cx="78.5" cy="11.5" r="1.3" fill="#94A3B8"/>
            <circle cx="167.5" cy="11.5" r="1.3" fill="#94A3B8"/>
            <image href="/Images/Codeksha-Logo.png" x="80" y="-20" width="86" height="34" preserveAspectRatio="xMidYMid meet"/>
            <circle cx="122" cy="71" r="6.5" fill="#fff" stroke="#1C1917" stroke-width="2"/>
          </g>
        </g>
      </g>
    </svg>
  </button>
</div>
<script src="/assets/mascot.js?v=<?= $ck_mascot_js_v ?>" defer></script>
