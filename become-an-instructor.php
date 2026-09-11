<?php @include __DIR__ . '/inc/tracker.php'; /* analytics */ ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Become an Instructor | Teach at Codeksha, Rajkot</title>
    <meta
      name="description"
      content="Share your development skills and teach at Codeksha, a Rajkot IT training institute built around developer-led, project-based courses."
    />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://codeksha.com/become-an-instructor/" />

    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Codeksha" />
    <meta property="og:title" content="Become an Instructor | Teach at Codeksha, Rajkot" />
    <meta property="og:description" content="Share your development skills and teach at Codeksha's Rajkot training centre." />
    <meta property="og:url" content="https://codeksha.com/become-an-instructor/" />
    <meta property="og:image" content="https://codeksha.com/Images/Codeksha-Logo.png" />
    <meta property="og:locale" content="en_IN" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Become an Instructor | Teach at Codeksha, Rajkot" />
    <meta name="twitter:description" content="Share your development skills and teach at Codeksha's Rajkot training centre." />
    <meta name="twitter:image" content="https://codeksha.com/Images/Codeksha-Logo.png" />

    <?php require __DIR__ . '/inc/partials/head.php'; ?>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://codeksha.com/" },
        { "@type": "ListItem", "position": 2, "name": "Become an Instructor", "item": "https://codeksha.com/become-an-instructor/" }
      ]
    }
    </script>
  </head>
  <body>
    <div class="top-banner">
      <p>Brand new Course Package released! Get 10% off your first purchase with code “CK-10OFF”. <a href="#">Find out more!</a></p>
    </div>

    <?php $ck_active = ''; require __DIR__ . '/inc/partials/nav.php'; ?>

    <!-- PAGE HERO -->
    <section class="page-hero">
      <div class="container">
        <p class="breadcrumb"><a href="/">Home</a> / Become an Instructor</p>
        <h1>Become an Instructor &amp; <span>Teach What You Love</span></h1>
        <p>Aspiring coders in Rajkot want to learn from developers like you. Share your skills and help shape the future of tech at Codeksha.</p>
        <div style="margin-top:26px;">
          <a href="#instructor-form" class="hero-enroll-btn" style="display:inline-flex;">
            <span>Teach a Course</span>
            <div class="arrow-btn-circle"><i data-lucide="arrow-right"></i></div>
          </a>
        </div>
      </div>
    </section>

    <!-- WHY TEACH -->
    <section class="courses-page-section">
      <div class="container">
        <div class="info-card-grid" style="grid-template-columns:repeat(3,1fr);">
          <div class="info-card">
            <div class="info-card-icon"><i class="fa-solid fa-handshake"></i></div>
            <h3>Built With Codeksha</h3>
            <p>You bring the expertise, and we help you turn it into a real, structured course for our Rajkot students.</p>
          </div>
          <div class="info-card">
            <div class="info-card-icon"><i class="fa-solid fa-people-group"></i></div>
            <h3>Grow With Our Community</h3>
            <p>Teach alongside other working developers who train students through hands-on, project-based classes.</p>
          </div>
          <div class="info-card">
            <div class="info-card-icon"><i class="fa-solid fa-star"></i></div>
            <h3>Your Expertise Has Value</h3>
            <p>Turn your real-world development experience into a course that helps students build genuine, job-relevant skills.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- HOW TO BECOME AN INSTRUCTOR -->
    <section class="courses-page-section" style="background:#f8fafc;">
      <div class="container">
        <div class="section-header">
          <span class="sub-title">BECOME AN INSTRUCTOR</span>
          <h2>How to Become an <span>Instructor</span></h2>
        </div>
        <div class="info-card-grid">
          <div class="info-card">
            <div class="info-card-icon"><i class="fa-solid fa-calendar-check"></i></div>
            <h3>Teach Around Your Schedule</h3>
            <p>Propose a course and teaching schedule that works alongside your existing development work.</p>
          </div>
          <div class="info-card">
            <div class="info-card-icon"><i class="fa-solid fa-user-group"></i></div>
            <h3>Work Alongside Industry Mentors</h3>
            <p>Join a team of developer-instructors who already teach hands-on, project-based courses at Codeksha.</p>
          </div>
          <div class="info-card">
            <div class="info-card-icon"><i class="fa-solid fa-code"></i></div>
            <h3>Share Real-World Expertise</h3>
            <p>Teach the practical techniques you use on real projects, not just textbook theory.</p>
          </div>
          <div class="info-card">
            <div class="info-card-icon"><i class="fa-solid fa-graduation-cap"></i></div>
            <h3>Be Part of Our Teaching Community</h3>
            <p>Become one of the developer-turned-teachers Codeksha students learn from directly.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- INSTRUCTOR APPLICATION -->
    <section class="instructor-cta-section" id="instructor-form">
      <div class="container">
        <div class="instructor-cta-grid">
          <div class="instructor-cta-copy">
            <span class="sub-title">READY TO TEACH A COURSE?</span>
            <h2>Tell Us About Yourself</h2>
            <p>Millions of aspiring coders want to learn from developers like you. Share your skills and shape the future of tech at Codeksha - send us a message and our team will follow up.</p>
            <div class="instructor-perks-grid">
              <div class="instructor-perk-card">
                <i class="fa-solid fa-chalkboard-user"></i>
                <h4>Classroom-Based</h4>
                <p>Teach on-premise at our Rajkot training centre.</p>
              </div>
              <div class="instructor-perk-card">
                <i class="fa-solid fa-diagram-project"></i>
                <h4>Project-Based</h4>
                <p>Build a course around real, hands-on work.</p>
              </div>
            </div>
          </div>
          <div class="contact-form-card">
            <h3>Instructor Enquiry</h3>
            <form id="instructorForm" method="post" action="/submit" novalidate>
              <?php $ck_form_type = 'instructor'; require __DIR__ . '/inc/form-fields.php'; ?>
              <div class="contact-form-group">
                <label for="instName">Name *</label>
                <input type="text" id="instName" name="name" required maxlength="100" placeholder="Your name" />
              </div>
              <div class="contact-form-group">
                <label for="instEmail">Email *</label>
                <input type="email" id="instEmail" name="email" required maxlength="190" placeholder="you@example.com" />
              </div>
              <div class="contact-form-group">
                <label for="instPhone">Phone number *</label>
                <input type="tel" id="instPhone" name="phone" required inputmode="tel" autocomplete="tel"
                       maxlength="20" minlength="8" pattern="[+0-9()\-\s]{8,20}"
                       placeholder="e.g. +91 98765 43210" />
              </div>
              <div class="contact-form-group">
                <label for="instSubject">What would you like to teach? *</label>
                <input type="text" id="instSubject" name="subject" required maxlength="190" placeholder="e.g. Laravel, Frontend Design" />
              </div>
              <div class="contact-form-group">
                <label for="instMessage">Tell us about your experience *</label>
                <textarea id="instMessage" name="message" required maxlength="4000" placeholder="A little about your background and what you'd like to teach"></textarea>
              </div>
              <button type="submit" class="contact-submit-btn">Send Application</button>
              <p class="contact-form-note" id="instructorFormNote">Thanks - our team will review your application and get in touch.</p>
            </form>
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

        const ckPhoneError = (v) => {
          v = (v || '').trim();
          if (!v) return 'Please enter your phone number.';
          const digits = v.replace(/\D/g, '');
          if (!/^\+?[0-9\s()\-]{8,20}$/.test(v) || digits.length < 8 || digits.length > 15)
            return 'Enter a valid phone number (8-15 digits).';
          if (/^(\d)\1+$/.test(digits)) return 'That does not look like a real phone number.';
          const nat = digits.replace(/^(0091|91|0)/, '');
          const foreign = v.trim().startsWith('+') && !digits.startsWith('91');
          if (!foreign && nat.length === 10 && !/^[6-9]/.test(nat))
            return 'Indian mobile numbers start with 6, 7, 8 or 9.';
          return '';
        };

        const instructorForm = document.getElementById('instructorForm');
        const instructorFormNote = document.getElementById('instructorFormNote');
        const instPhone = document.getElementById('instPhone');
        if (instPhone) {
          instPhone.addEventListener('blur', () => instPhone.setCustomValidity(ckPhoneError(instPhone.value)));
        }
        if (instructorForm && instructorFormNote) {
          instructorForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const pErr = ckPhoneError(instPhone && instPhone.value);
            if (pErr) {
              instructorFormNote.textContent = pErr;
              instructorFormNote.style.color = '#dc2626';
              instructorFormNote.classList.add('show');
              if (instPhone) instPhone.focus();
              return;
            }
            const btn = instructorForm.querySelector('button[type=submit]');
            btn.disabled = true;
            try {
              const res = await fetch('/submit', {
                method: 'POST',
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: new FormData(instructorForm)
              });
              const data = await res.json();
              instructorFormNote.textContent = data.message;
              instructorFormNote.classList.add('show');
              instructorFormNote.style.color = data.ok ? '' : '#dc2626';
              if (data.ok) instructorForm.reset();
            } catch (err) {
              instructorFormNote.textContent = 'Network error - please try again.';
              instructorFormNote.style.color = '#dc2626';
              instructorFormNote.classList.add('show');
            } finally {
              btn.disabled = false;
            }
          });
        }
        if (location.hash === '#sent' && instructorFormNote) instructorFormNote.classList.add('show');
      });
    </script>
  </body>
</html>
