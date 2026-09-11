<?php @include __DIR__ . '/inc/tracker.php'; /* analytics */ ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book a Free Demo Class in Rajkot | Codeksha</title>
    <meta
      name="description"
      content="Book a free demo class at Codeksha's Rajkot training centre. Sit in on a real session, meet the instructor and see how our project-based courses work - no cost, no commitment."
    />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://codeksha.com/book-demo/" />

    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Codeksha" />
    <meta property="og:title" content="Book a Free Demo Class in Rajkot | Codeksha" />
    <meta property="og:description" content="Sit in on a real Codeksha session, meet the instructor and see how our courses work - free, no commitment." />
    <meta property="og:url" content="https://codeksha.com/book-demo/" />
    <meta property="og:image" content="https://codeksha.com/Images/Codeksha-Logo.png" />
    <meta property="og:locale" content="en_IN" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Book a Free Demo Class in Rajkot | Codeksha" />
    <meta name="twitter:description" content="Sit in on a real Codeksha session, meet the instructor and see how our courses work - free, no commitment." />
    <meta name="twitter:image" content="https://codeksha.com/Images/Codeksha-Logo.png" />

    <?php require __DIR__ . '/inc/partials/head.php'; ?>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://codeksha.com/" },
        { "@type": "ListItem", "position": 2, "name": "Book a Free Demo Class", "item": "https://codeksha.com/book-demo/" }
      ]
    }
    </script>
  </head>
  <body>
    <div class="top-banner">
      <p>Brand new Course Package released! Get 10% off your first purchase with code &ldquo;CK-10OFF&rdquo;. <a href="#">Find out more!</a></p>
    </div>

    <?php $ck_active = ''; require __DIR__ . '/inc/partials/nav.php'; ?>

    <!-- PAGE HERO -->
    <section class="page-hero">
      <div class="container">
        <p class="breadcrumb"><a href="/">Home</a> / Book a Free Demo Class</p>
        <h1>Book a <span>Free Demo Class</span></h1>
        <p>Come sit in on a real session at our Rajkot centre. Meet the instructor, see how the project-based teaching works, and ask anything - completely free, with zero commitment to enroll.</p>
      </div>
    </section>

    <!-- DEMO CONTENT -->
    <section class="contact-page-section">
      <div class="container">
        <div class="contact-page-grid">

          <div class="contact-info-block">
            <h2>What to Expect</h2>
            <p>Your free demo is a genuine class, not a sales pitch. You'll get a clear feel for whether Codeksha is the right fit before you decide anything.</p>

            <div class="contact-detail-card">
              <div class="contact-detail-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
              <div>
                <strong>A real, live session</strong>
                <p>Join an actual running batch and see the teaching style first-hand.</p>
              </div>
            </div>
            <div class="contact-detail-card">
              <div class="contact-detail-icon"><i class="fa-solid fa-user-tie"></i></div>
              <div>
                <strong>Meet your instructor</strong>
                <p>Ask a working developer about the course, projects and career paths.</p>
              </div>
            </div>
            <div class="contact-detail-card">
              <div class="contact-detail-icon"><i class="fa-solid fa-map-location-dot"></i></div>
              <div>
                <strong>At our Rajkot centre</strong>
                <p>A-1110, RK Iconic, Near Sheetal Park, 150 Feet Ring Rd, Rajkot.</p>
              </div>
            </div>
            <div class="contact-detail-card">
              <div class="contact-detail-icon"><i class="fa-solid fa-indian-rupee-sign"></i></div>
              <div>
                <strong>Free, no commitment</strong>
                <p>No fee, no obligation to enroll. Prefer to talk first? Call <a href="tel:+916355559016">+91 63555 59016</a>.</p>
              </div>
            </div>
          </div>

          <div class="contact-form-card">
            <h3>Reserve Your Seat</h3>
            <p class="contact-form-subtitle">Takes 30 seconds. We'll confirm your slot by phone or email.</p>
            <form id="demoForm" method="post" action="/submit" novalidate>
              <?php $ck_form_type = 'demo'; require __DIR__ . '/inc/form-fields.php'; ?>
              <div class="contact-form-group">
                <label for="demoName">Full name *</label>
                <input type="text" id="demoName" name="name" required maxlength="100" placeholder="Your name" />
              </div>
              <div class="contact-form-group">
                <label for="demoEmail">Email *</label>
                <input type="email" id="demoEmail" name="email" required maxlength="190" placeholder="you@example.com" />
              </div>
              <div class="contact-form-group">
                <label for="demoPhone">Phone number *</label>
                <input type="tel" id="demoPhone" name="phone" required inputmode="tel" autocomplete="tel"
                       maxlength="20" minlength="8" pattern="[+0-9()\-\s]{8,20}"
                       placeholder="e.g. +91 98765 43210" />
              </div>
              <div class="contact-form-group">
                <label for="demoCourse">Which course? *</label>
                <select id="demoCourse" name="course" required>
                  <option value="" disabled selected>Select a course</option>
                  <option>Full Stack Web Development</option>
                  <option>Frontend Development</option>
                  <option>Backend Development</option>
                  <option>Digital Marketing &amp; SEO</option>
                  <option>WordPress Development</option>
                  <option>AI &amp; Automation</option>
                  <option>Not sure yet - help me choose</option>
                </select>
              </div>
              <div class="contact-form-group">
                <label for="demoPreferred">Preferred time</label>
                <select id="demoPreferred" name="preferred">
                  <option value="" selected>Any time works</option>
                  <option>Weekday morning</option>
                  <option>Weekday afternoon</option>
                  <option>Weekday evening</option>
                  <option>Weekend</option>
                </select>
              </div>
              <div class="contact-form-group">
                <label for="demoMessage">Anything specific you'd like to cover?</label>
                <textarea id="demoMessage" name="message" maxlength="4000" placeholder="Optional - your background, goals, questions..."></textarea>
              </div>
              <button type="submit" class="contact-submit-btn">Book My Free Demo</button>
              <p class="contact-form-note" id="demoFormNote">Thanks - we'll confirm your demo slot by phone or email shortly.</p>
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

        const demoForm = document.getElementById('demoForm');
        const demoFormNote = document.getElementById('demoFormNote');
        const demoPhone = document.getElementById('demoPhone');
        const demoCourse = document.getElementById('demoCourse');
        if (demoPhone) {
          demoPhone.addEventListener('blur', () => demoPhone.setCustomValidity(ckPhoneError(demoPhone.value)));
        }

        // pre-select the course if arriving from a course page (?course=slug)
        const params = new URLSearchParams(location.search);
        const wanted = (params.get('course') || '').toLowerCase();
        if (wanted && demoCourse) {
          [...demoCourse.options].forEach(o => {
            if (o.value && o.value.toLowerCase().replace(/[^a-z]+/g, '-').includes(wanted)) o.selected = true;
          });
        }

        if (demoForm && demoFormNote) {
          demoForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const pErr = ckPhoneError(demoPhone && demoPhone.value);
            if (pErr) {
              demoFormNote.textContent = pErr;
              demoFormNote.style.color = '#dc2626';
              demoFormNote.classList.add('show');
              if (demoPhone) demoPhone.focus();
              return;
            }
            if (demoCourse && !demoCourse.value) {
              demoFormNote.textContent = 'Please choose which course you would like a demo for.';
              demoFormNote.style.color = '#dc2626';
              demoFormNote.classList.add('show');
              demoCourse.focus();
              return;
            }
            const btn = demoForm.querySelector('button[type=submit]');
            btn.disabled = true;
            try {
              const res = await fetch('/submit', {
                method: 'POST',
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: new FormData(demoForm)
              });
              const data = await res.json();
              demoFormNote.textContent = data.message;
              demoFormNote.classList.add('show');
              demoFormNote.style.color = data.ok ? '' : '#dc2626';
              if (data.ok) demoForm.reset();
            } catch (err) {
              demoFormNote.textContent = 'Network error - please try again.';
              demoFormNote.style.color = '#dc2626';
              demoFormNote.classList.add('show');
            } finally {
              btn.disabled = false;
            }
          });
        }
        if (location.hash === '#sent' && demoFormNote) demoFormNote.classList.add('show');
      });
    </script>
  </body>
</html>
