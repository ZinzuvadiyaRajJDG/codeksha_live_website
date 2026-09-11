<?php
/* Shared top navigation. Set $ck_active before requiring:
   'home' | 'about' | 'courses' | 'gallery' | 'faqs' | 'blog' | 'contact' | '' */
$ck_active = $ck_active ?? '';
$ck_nav = [
    'home'    => ['/',            'Home'],
    'about'   => ['/about-us/',   'About Us'],
    'courses' => ['/courses/',    'All Courses'],
    'gallery' => ['/gallery/',    'Gallery'],
    'faqs'    => ['/faqs/',       'FAQs'],
    'blog'    => ['/blog/',       'Blog'],
    'contact' => ['/contact/',    'Contact'],
];
?>
    <header class="navbar">
      <div class="container nav-container">
        <a href="/" class="logo">
          <img src="/Images/Codeksha-Logo.png" alt="Codeksha" class="nav-logo-img" width="1432" height="564">
        </a>
        <nav>
          <ul class="nav-links" id="navLinks">
<?php foreach ($ck_nav as $ck_k => [$ck_href, $ck_label]): ?>
            <li><a href="<?= $ck_href ?>"<?= $ck_k === $ck_active ? ' class="active"' : '' ?>><?= $ck_label ?></a></li>
<?php endforeach; ?>
          </ul>
        </nav>
        <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle Navigation Menu">
          <i data-lucide="menu"></i>
        </button>
      </div>
    </header>
    <div class="nav-overlay" id="navOverlay"></div>
