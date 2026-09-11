<?php @include __DIR__ . '/inc/tracker.php'; /* analytics */ ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IT Courses in Rajkot | Codeksha Course Catalog</title>
    <meta
      name="description"
      content="Browse all IT courses at Codeksha's Rajkot training centre - Full Stack, Backend, Frontend, PHP, Laravel, WordPress, Digital Marketing and more classroom courses."
    />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://codeksha.com/courses/" />

    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Codeksha" />
    <meta property="og:title" content="IT Courses in Rajkot | Codeksha Course Catalog" />
    <meta property="og:description" content="Browse all IT courses at Codeksha's Rajkot training centre - Full Stack, Backend, Frontend, PHP, Laravel, WordPress, Digital Marketing and more." />
    <meta property="og:url" content="https://codeksha.com/courses/" />
    <meta property="og:image" content="https://codeksha.com/Images/Codeksha-Logo.png" />
    <meta property="og:locale" content="en_IN" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="IT Courses in Rajkot | Codeksha Course Catalog" />
    <meta name="twitter:description" content="Browse all IT courses at Codeksha's Rajkot training centre - Full Stack, Backend, Frontend, PHP, Laravel, WordPress, Digital Marketing and more." />
    <meta name="twitter:image" content="https://codeksha.com/Images/Codeksha-Logo.png" />

    <?php require __DIR__ . '/inc/partials/head.php'; ?>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://codeksha.com/" },
        { "@type": "ListItem", "position": 2, "name": "Courses", "item": "https://codeksha.com/courses/" }
      ]
    }
    </script>
  </head>
  <body>
    <div class="top-banner">
      <p>Brand new Course Package released! Get 10% off your first purchase with code “CK-10OFF”. <a href="#">Find out more!</a></p>
    </div>

    <?php $ck_active = 'courses'; require __DIR__ . '/inc/partials/nav.php'; ?>

    <!-- PAGE HERO -->
    <section class="page-hero">
      <div class="container">
        <p class="breadcrumb"><a href="/">Home</a> / Courses</p>
        <h1>IT Courses in <span>Rajkot</span> - Full Course Catalog</h1>
        <p>Classroom, project-based IT courses at Codeksha's Rajkot training centre - taught by working developers. Filter by category to find the right course for you.</p>
      </div>
    </section>

    <!-- COURSES GRID -->
    <section class="courses-page-section">
      <div class="container">
        <div class="courses-filter-bar" id="courseFilterBar">
          <button class="category-filter-pill active" data-filter="all">All Courses</button>
          <button class="category-filter-pill" data-filter="Web Development">Web Development</button>
          <button class="category-filter-pill" data-filter="CMS & Builders">CMS &amp; Builders</button>
          <button class="category-filter-pill" data-filter="Digital Marketing Course">Digital Marketing</button>
          <button class="category-filter-pill" data-filter="AI & Automation">AI &amp; Automation</button>
        </div>

        <div class="courses-static-grid" id="coursesGrid">

          <div class="course-tile" data-category="Web Development">
            <div class="course-tile-icon"><i class="fa-solid fa-layer-group"></i></div>
            <span class="course-tile-cat">Web Development</span>
            <h3>Full Stack Web Development</h3>
            <div class="course-tile-meta">
              <span><i class="fa-solid fa-users"></i> 271 Students</span>
              <span><i class="fa-solid fa-book"></i> 30 lessons</span>
            </div>
            <p>Learn to build complete web applications from frontend to backend.</p>
            <div class="course-tile-footer">
              <span class="course-tile-tag">Beginner</span>
              <a href="/course/full-stack-web-development/" class="course-tile-link">View course &rarr;</a>
            </div>
          </div>

          <div class="course-tile" data-category="Web Development">
            <div class="course-tile-icon"><i class="fa-solid fa-palette"></i></div>
            <span class="course-tile-cat">Web Development</span>
            <h3>Frontend Development</h3>
            <div class="course-tile-meta">
              <span><i class="fa-solid fa-users"></i> 273 Students</span>
              <span><i class="fa-solid fa-book"></i> 30 lessons</span>
            </div>
            <p>Learn how to create modern, responsive and interactive websites.</p>
            <div class="course-tile-footer">
              <span class="course-tile-tag">Beginner</span>
              <a href="/course/frontend-development/" class="course-tile-link">View course &rarr;</a>
            </div>
          </div>

          <div class="course-tile" data-category="Web Development">
            <div class="course-tile-icon"><i class="fa-solid fa-server"></i></div>
            <span class="course-tile-cat">Web Development</span>
            <h3>Backend Development</h3>
            <div class="course-tile-meta">
              <span><i class="fa-solid fa-users"></i> 274 Students</span>
              <span><i class="fa-solid fa-book"></i> 30 lessons</span>
            </div>
            <p>Learn server-side development, databases, APIs and application logic.</p>
            <div class="course-tile-footer">
              <span class="course-tile-tag">Beginner</span>
              <a href="/course/backend-development/" class="course-tile-link">View course &rarr;</a>
            </div>
          </div>

          <div class="course-tile" data-category="Digital Marketing Course">
            <div class="course-tile-icon"><i class="fa-solid fa-bullhorn"></i></div>
            <span class="course-tile-cat">Digital Marketing</span>
            <h3>Digital Marketing &amp; SEO</h3>
            <div class="course-tile-meta">
              <span><i class="fa-solid fa-users"></i> 273 Students</span>
              <span><i class="fa-solid fa-book"></i> 30 lessons</span>
            </div>
            <p>Learn SEO, digital marketing, content, analytics and online growth strategies.</p>
            <div class="course-tile-footer">
              <span class="course-tile-tag">Beginner</span>
              <a href="/course/digital-marketing-seo/" class="course-tile-link">View course &rarr;</a>
            </div>
          </div>

          <div class="course-tile" data-category="CMS & Builders">
            <div class="course-tile-icon"><i class="fa-brands fa-wordpress"></i></div>
            <span class="course-tile-cat">CMS &amp; Builders</span>
            <h3>WordPress Development</h3>
            <div class="course-tile-meta">
              <span><i class="fa-solid fa-users"></i> 273 Students</span>
              <span><i class="fa-solid fa-book"></i> 30 lessons</span>
            </div>
            <p>Learn to build professional websites using WordPress and modern development.</p>
            <div class="course-tile-footer">
              <span class="course-tile-tag">Beginner</span>
              <a href="/course/wordpress-development/" class="course-tile-link">View course &rarr;</a>
            </div>
          </div>

          <div class="course-tile" data-category="AI & Automation">
            <div class="course-tile-icon"><i class="fa-solid fa-robot"></i></div>
            <span class="course-tile-cat">AI &amp; Automation</span>
            <h3>AI &amp; Automation</h3>
            <div class="course-tile-meta">
              <span><i class="fa-solid fa-users"></i> 64 Students</span>
              <span><i class="fa-solid fa-book"></i> 30 lessons</span>
            </div>
            <p>Learn how AI tools &amp; automation are used to improve modern business workflows.</p>
            <div class="course-tile-footer">
              <span class="course-tile-tag">Beginner</span>
              <a href="/course/ai-automation/" class="course-tile-link">View course &rarr;</a>
            </div>
          </div>

        </div>
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

        // Course category filter
        const pills = document.querySelectorAll('#courseFilterBar .category-filter-pill');
        const tiles = document.querySelectorAll('#coursesGrid .course-tile');
        pills.forEach(pill => {
          pill.addEventListener('click', () => {
            pills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
            const filter = pill.getAttribute('data-filter');
            tiles.forEach(tile => {
              tile.style.display = (filter === 'all' || tile.getAttribute('data-category') === filter) ? '' : 'none';
            });
          });
        });
      });
    </script>
  </body>
</html>
