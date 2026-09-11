<?php @include __DIR__ . '/inc/tracker.php'; /* analytics */ ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Codeksha | IT Training Institute in Rajkot</title>
    <meta
      name="description"
      content="Contact Codeksha for course enquiries, demo classes or admissions. Call, email or visit our Rajkot training centre, Monday to Saturday."
    />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://codeksha.com/contact/" />

    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Codeksha" />
    <meta property="og:title" content="Contact Codeksha | IT Training Institute in Rajkot" />
    <meta property="og:description" content="Got a question about our courses? Reach Codeksha by phone, email, or visit our Rajkot training centre." />
    <meta property="og:url" content="https://codeksha.com/contact/" />
    <meta property="og:image" content="https://codeksha.com/Images/Codeksha-Logo.png" />
    <meta property="og:locale" content="en_IN" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Contact Codeksha | IT Training Institute in Rajkot" />
    <meta name="twitter:description" content="Got a question about our courses? Reach Codeksha by phone, email, or visit our Rajkot training centre." />
    <meta name="twitter:image" content="https://codeksha.com/Images/Codeksha-Logo.png" />

    <?php require __DIR__ . '/inc/partials/head.php'; ?>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://codeksha.com/" },
        { "@type": "ListItem", "position": 2, "name": "Contact", "item": "https://codeksha.com/contact/" }
      ]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ContactPage",
      "name": "Contact Codeksha",
      "url": "https://codeksha.com/contact/",
      "about": {
        "@type": "EducationalOrganization",
        "name": "Codeksha",
        "telephone": "+91-6355559016",
        "email": "info@codeksha.com"
      }
    }
    </script>
  </head>
  <body>
    <div class="top-banner">
      <p>Brand new Course Package released! Get 10% off your first purchase with code “CK-10OFF”. <a href="#">Find out more!</a></p>
    </div>

    <?php $ck_active = 'contact'; require __DIR__ . '/inc/partials/nav.php'; ?>

    <!-- PAGE HERO -->
    <section class="page-hero">
      <div class="container">
        <p class="breadcrumb"><a href="/">Home</a> / Contact</p>
        <h1>Talk to Us, <span>Future Coder</span></h1>
        <p>Got a question, idea, or just want to say hey? We're all ears - reach Codeksha's Rajkot training centre below.</p>
      </div>
    </section>

    <!-- CONTACT CONTENT -->
    <section class="contact-page-section">
      <div class="container">
        <div class="contact-page-grid">

          <div class="contact-info-block">
            <h2>We're Here to Help</h2>
            <p>Got questions about our developer-led coding courses, or need help choosing between programs? Our team can guide you through course selection, enrollment and getting started with live, project-based training.</p>

            <div class="contact-detail-card">
              <div class="contact-detail-icon"><i class="fa-regular fa-clock"></i></div>
              <div>
                <strong>Hours</strong>
                <p>Available Monday to Saturday, 8 AM – 7 PM (India Standard Time)</p>
              </div>
            </div>

            <div class="contact-detail-card">
              <div class="contact-detail-icon"><i class="fa-solid fa-phone"></i></div>
              <div>
                <strong>Call Us</strong>
                <p><a href="tel:+916355559016">+91 63555 59016</a></p>
              </div>
            </div>

            <div class="contact-detail-card">
              <div class="contact-detail-icon"><i class="fa-solid fa-location-dot"></i></div>
              <div>
                <strong>Our Office Location</strong>
                <p>Codeksha - A-1110, RK Iconic, Near Sheetal Park,<br>150 Feet Ring Rd, Rajkot, Gujarat,<br>360006 India</p>
              </div>
            </div>

            <div class="contact-detail-card">
              <div class="contact-detail-icon"><i class="fa-regular fa-envelope"></i></div>
              <div>
                <strong>Email Us</strong>
                <p><a href="mailto:info@codeksha.com">info@codeksha.com</a></p>
              </div>
            </div>
          </div>

          <div class="contact-form-card">
            <h3>Get In Touch</h3>
            <form id="contactForm" method="post" action="/submit" novalidate>
              <?php $ck_form_type = 'contact'; require __DIR__ . '/inc/form-fields.php'; ?>
              <div class="contact-form-group">
                <label for="contactName">Name *</label>
                <input type="text" id="contactName" name="name" required maxlength="100" placeholder="Your name" />
              </div>
              <div class="contact-form-group">
                <label for="contactEmail">Email *</label>
                <input type="email" id="contactEmail" name="email" required maxlength="190" placeholder="you@example.com" />
              </div>
              <div class="contact-form-group">
                <label for="contactPhone">Phone number *</label>
                <input type="tel" id="contactPhone" name="phone" required inputmode="tel" autocomplete="tel"
                       maxlength="20" minlength="8" pattern="[+0-9()\-\s]{8,20}"
                       placeholder="e.g. +91 98765 43210" />
              </div>
              <div class="contact-form-group">
                <label for="contactQuestion">Question *</label>
                <textarea id="contactQuestion" name="question" required maxlength="4000" placeholder="What would you like to know?"></textarea>
              </div>
              <button type="submit" class="contact-submit-btn">Send Message</button>
              <p class="contact-form-note" id="contactFormNote">Thanks - we'll get back to you shortly.</p>
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

        const contactForm = document.getElementById('contactForm');
        const contactFormNote = document.getElementById('contactFormNote');
        const contactPhone = document.getElementById('contactPhone');
        if (contactPhone) {
          contactPhone.addEventListener('blur', () => {
            contactPhone.setCustomValidity(ckPhoneError(contactPhone.value));
          });
        }
        if (contactForm && contactFormNote) {
          contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const pErr = ckPhoneError(contactPhone && contactPhone.value);
            if (pErr) {
              contactFormNote.textContent = pErr;
              contactFormNote.style.color = '#dc2626';
              contactFormNote.classList.add('show');
              if (contactPhone) contactPhone.focus();
              return;
            }
            const btn = contactForm.querySelector('button[type=submit]');
            btn.disabled = true;
            try {
              const res = await fetch('/submit', {
                method: 'POST',
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: new FormData(contactForm)
              });
              const data = await res.json();
              contactFormNote.textContent = data.message;
              contactFormNote.classList.add('show');
              contactFormNote.style.color = data.ok ? '' : '#dc2626';
              if (data.ok) contactForm.reset();
            } catch (err) {
              contactFormNote.textContent = 'Network error - please try again.';
              contactFormNote.style.color = '#dc2626';
              contactFormNote.classList.add('show');
            } finally {
              btn.disabled = false;
            }
          });
        }
        if (location.hash === '#sent' && contactFormNote) contactFormNote.classList.add('show');
      });
    </script>
  </body>
</html>
