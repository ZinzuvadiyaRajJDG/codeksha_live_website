<?php @include __DIR__ . '/inc/tracker.php'; /* analytics */ ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gallery | Codeksha - Training in Action, Rajkot</title>
    <meta
      name="description"
      content="See Codeksha's classroom training, workshops and student life in Rajkot - real photos from our IT training centre."
    />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://codeksha.com/gallery/" />

    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Codeksha" />
    <meta property="og:title" content="Gallery | Codeksha - Training in Action, Rajkot" />
    <meta property="og:description" content="See Codeksha's classroom training, workshops and student life in Rajkot." />
    <meta property="og:url" content="https://codeksha.com/gallery/" />
    <meta property="og:image" content="https://codeksha.com/Images/Codeksha-Logo.png" />
    <meta property="og:locale" content="en_IN" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Gallery | Codeksha - Training in Action, Rajkot" />
    <meta name="twitter:description" content="See Codeksha's classroom training, workshops and student life in Rajkot." />
    <meta name="twitter:image" content="https://codeksha.com/Images/Codeksha-Logo.png" />

    <?php require __DIR__ . '/inc/partials/head.php'; ?>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://codeksha.com/" },
        { "@type": "ListItem", "position": 2, "name": "Gallery", "item": "https://codeksha.com/gallery/" }
      ]
    }
    </script>
  </head>
  <body>
    <div class="top-banner">
      <p>Brand new Course Package released! Get 10% off your first purchase with code “CK-10OFF”. <a href="#">Find out more!</a></p>
    </div>

    <?php $ck_active = 'gallery'; require __DIR__ . '/inc/partials/nav.php'; ?>

    <!-- PAGE HERO -->
    <section class="page-hero">
      <div class="container">
        <p class="breadcrumb"><a href="/">Home</a> / Gallery</p>
        <h1>Explore Our <span>Education Gallery</span></h1>
        <p>A look inside Codeksha's classroom training, workshops and student life in Rajkot.</p>
      </div>
    </section>

    <!-- GALLERY GRID -->
    <section class="gallery-section">
      <div class="container">
        <div class="gallery-grid">
          <div class="gallery-item">
            <img src="/Images/gallery/gallery_image_1.jpeg" alt="Codeksha training session in Rajkot" loading="lazy">
            <div class="gallery-item-overlay"><span>Classroom Training</span></div>
          </div>
          <div class="gallery-item">
            <img src="/Images/gallery/gallery_image_2.jpeg" alt="Students at a Codeksha workshop" loading="lazy">
            <div class="gallery-item-overlay"><span>Hands-On Workshop</span></div>
          </div>
          <div class="gallery-item">
            <img src="/Images/gallery/gallery_image_3.jpeg" alt="Codeksha students working on live projects" loading="lazy">
            <div class="gallery-item-overlay"><span>Live Project Work</span></div>
          </div>
          <div class="gallery-item">
            <img src="/Images/gallery/gallery_image_4.png" alt="Instructor-led session at Codeksha" loading="lazy">
            <div class="gallery-item-overlay"><span>Instructor-Led Session</span></div>
          </div>
          <div class="gallery-item">
            <img src="/Images/gallery/gallery_image_5.jpg" alt="Codeksha training centre in Rajkot" loading="lazy">
            <div class="gallery-item-overlay"><span>At Our Rajkot Centre</span></div>
          </div>
          <div class="gallery-item">
            <img src="/Images/gallery/gallery_image_6.jpg" alt="Codeksha students during a coding class" loading="lazy">
            <div class="gallery-item-overlay"><span>Coding Class</span></div>
          </div>
          <div class="gallery-item">
            <img src="/Images/gallery/gallery_image_7.jpg" alt="Team collaboration at Codeksha" loading="lazy">
            <div class="gallery-item-overlay"><span>Team Collaboration</span></div>
          </div>
          <div class="gallery-item">
            <img src="/Images/gallery/gallery_image_8.jpg" alt="Codeksha mentorship session" loading="lazy">
            <div class="gallery-item-overlay"><span>Mentorship</span></div>
          </div>
          <div class="gallery-item">
            <img src="/Images/gallery/gallery_image_9.jpeg" alt="Codeksha students presenting their work" loading="lazy">
            <div class="gallery-item-overlay"><span>Project Presentations</span></div>
          </div>
          <div class="gallery-item">
            <img src="/Images/gallery/gallery_image_10.jpeg" alt="Codeksha workshop and events" loading="lazy">
            <div class="gallery-item-overlay"><span>Workshops &amp; Events</span></div>
          </div>
        </div>
        <p style="text-align:center; margin-top:40px; font-size:14px; color:#94a3b8;">More photos from our workshops and events are added regularly.</p>
      </div>
    </section>

    <!-- FOOTER -->
    <?php require __DIR__ . '/inc/partials/site-footer.php'; ?>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        if (window.lucide) lucide.createIcons();
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const navLinks = document.getElementById('navLinks');
        const navOverlay = document.getElementById('navOverlay');
        if (hamburgerBtn && navLinks) {
          const toggleMenu = () => {
            const isActive = navLinks.classList.toggle('active');
            if (navOverlay) navOverlay.classList.toggle('active', isActive);
            const icon = hamburgerBtn.querySelector('i');
            if (icon) icon.className = isActive ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
          };
          hamburgerBtn.addEventListener('click', toggleMenu);
          if (navOverlay) navOverlay.addEventListener('click', toggleMenu);
          navLinks.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
            if (navLinks.classList.contains('active')) toggleMenu();
          }));
        }
      });
    </script>
  </body>
</html>
