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
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        { "@type": "Question", "name": "Where is Codeksha's coding class located in Rajkot?", "acceptedAnswer": { "@type": "Answer", "text": "Our Rajkot training centre is at A-1110, RK Iconic, Near Sheetal Park, 150 Feet Ring Rd, Rajkot, Gujarat 360006. We also run classroom batches in Jamnagar." } },
        { "@type": "Question", "name": "What are your office hours?", "acceptedAnswer": { "@type": "Answer", "text": "You can call or visit us Monday to Saturday, 8 AM to 7 PM (India Standard Time). Send a message any time and we will reply during office hours." } },
        { "@type": "Question", "name": "Can I attend a demo class before enrolling?", "acceptedAnswer": { "@type": "Answer", "text": "Yes. Book a free demo class, sit in on a real session, meet the instructor and see how our project-based training works before you decide." } },
        { "@type": "Question", "name": "I am a beginner. Which course should I start with?", "acceptedAnswer": { "@type": "Answer", "text": "Most of our courses start from the basics. Tell us your background and goals through the form or call us, and our team will suggest a starting point, such as Frontend Development, Full Stack Web Development or Digital Marketing." } },
        { "@type": "Question", "name": "Can I join while studying in college or working?", "acceptedAnswer": { "@type": "Answer", "text": "Yes. Batch timings are flexible and student-friendly, so you can fit classes around college or a job." } }
      ]
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

    <!-- WAYS TO REACH US -->
    <section class="highlights-section">
      <div class="container">
        <div class="section-header">
          <span class="sub-title">GET IN TOUCH</span>
          <h2>Computer &amp; Coding Classes in Rajkot: <span>How to Reach Us</span></h2>
          <p style="max-width:720px;margin:12px auto 0;color:#64748b;line-height:1.7;">Looking for coding classes or an IT training institute in Rajkot? Codeksha is a developer-led training centre where you learn web development, digital marketing and AI in live, project-based classes. Here are the quickest ways to talk to us.</p>
        </div>
        <div class="info-card-grid cols-3">
          <div class="info-card">
            <div class="info-card-icon"><i class="fa-solid fa-location-dot"></i></div>
            <h3>Visit Our Rajkot Centre</h3>
            <p>Drop in at A-1110, RK Iconic, Near Sheetal Park, 150 Feet Ring Rd, Rajkot, Monday to Saturday, 8 AM to 7 PM. Walk through the classroom and meet the team in person.</p>
          </div>
          <div class="info-card">
            <div class="info-card-icon"><i class="fa-solid fa-phone"></i></div>
            <h3>Call or Email Us</h3>
            <p>Call <a href="tel:+916355559016" style="color:#2563eb;font-weight:600;">+91 63555 59016</a> or write to <a href="mailto:info@codeksha.com" style="color:#2563eb;font-weight:600;">info@codeksha.com</a> for course details, batch timings and admissions.</p>
          </div>
          <div class="info-card">
            <div class="info-card-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
            <h3>Try a Free Demo Class</h3>
            <p>Not sure which course fits you? <a href="/book-demo/" style="color:#2563eb;font-weight:600;">Book a free demo class</a>, sit in on a real session and meet your instructor before you enrol.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- COURSES TO ASK ABOUT -->
    <section class="courses-page-section" style="background:#ffffff;">
      <div class="container">
        <div class="section-header">
          <span class="sub-title">COURSE ENQUIRIES</span>
          <h2>Which course would you like to <span>ask about?</span></h2>
        </div>
        <div class="learn-card" style="max-width:900px;margin:0 auto;">
          <ul class="learn-checklist">
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/full-stack-web-development/">Full Stack Web Development course in Rajkot</a></span></li>
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/frontend-development/">Frontend Development course in Rajkot</a></span></li>
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/backend-development/">Backend Development course in Rajkot</a></span></li>
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/digital-marketing-seo/">Digital Marketing &amp; SEO course in Rajkot</a></span></li>
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/wordpress-development/">WordPress Development course in Rajkot</a></span></li>
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/ai-automation/">AI &amp; Automation course in Rajkot</a></span></li>
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/javascript/">JavaScript course in Rajkot</a></span></li>
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/mongodb/">MongoDB course in Rajkot</a></span></li>
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/seo/">SEO course in Rajkot</a></span></li>
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/google-ads/">Google Ads course in Rajkot</a></span></li>
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/social-media-marketing/">Social Media Marketing course in Rajkot</a></span></li>
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/prompt-engineering/">Prompt Engineering course in Rajkot</a></span></li>
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/n8n-automation/">n8n Automation course in Rajkot</a></span></li>
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/ui-ux-design/">UI/UX Design course in Rajkot</a></span></li>
              <li><i class="fa-solid fa-circle-check"></i> <span><a href="/course/graphic-design/">Graphic Design course in Rajkot</a></span></li>
          </ul>
        </div>
        <p style="text-align:center;margin-top:20px;color:#64748b;">Want the full list? See all <a href="/courses/" style="color:#2563eb;font-weight:600;">IT courses in Rajkot</a> or learn more <a href="/about-us/" style="color:#2563eb;font-weight:600;">about Codeksha</a>.</p>
      </div>
    </section>

    <!-- CONTACT FAQ -->
    <section class="courses-page-section" style="background:#f8fafc;">
      <div class="container">
        <div class="section-header">
          <span class="sub-title">QUICK ANSWERS</span>
          <h2>Contact &amp; admission <span>FAQs</span></h2>
        </div>
        <div class="faq-list" style="max-width:860px;margin:0 auto;">
          <div class="faq-item active">
            <button class="faq-question"><span>Where is Codeksha's coding class located in Rajkot?</span><i class="fa-solid fa-minus icon"></i></button>
            <div class="faq-answer"><p>Our Rajkot training centre is at A-1110, RK Iconic, Near Sheetal Park, 150 Feet Ring Rd, Rajkot, Gujarat 360006. We also run classroom batches in Jamnagar.</p></div>
          </div>
          <div class="faq-item">
            <button class="faq-question"><span>What are your office hours?</span><i class="fa-solid fa-plus icon"></i></button>
            <div class="faq-answer"><p>You can call or visit us Monday to Saturday, 8 AM to 7 PM (India Standard Time). Send a message any time and we will reply during office hours.</p></div>
          </div>
          <div class="faq-item">
            <button class="faq-question"><span>Can I attend a demo class before enrolling?</span><i class="fa-solid fa-plus icon"></i></button>
            <div class="faq-answer"><p>Yes. Book a free demo class, sit in on a real session, meet the instructor and see how our project-based training works before you decide.</p></div>
          </div>
          <div class="faq-item">
            <button class="faq-question"><span>I am a beginner. Which course should I start with?</span><i class="fa-solid fa-plus icon"></i></button>
            <div class="faq-answer"><p>Most of our courses start from the basics. Tell us your background and goals through the form or call us, and our team will suggest a starting point, such as Frontend Development, Full Stack Web Development or Digital Marketing.</p></div>
          </div>
          <div class="faq-item">
            <button class="faq-question"><span>Can I join while studying in college or working?</span><i class="fa-solid fa-plus icon"></i></button>
            <div class="faq-answer"><p>Yes. Batch timings are flexible and student-friendly, so you can fit classes around college or a job.</p></div>
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
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const faqItems = document.querySelectorAll('.faq-item');
        const setFaqHeight = (item) => {
          const answer = item.querySelector('.faq-answer');
          if (answer) answer.style.maxHeight = item.classList.contains('active') ? answer.scrollHeight + 30 + 'px' : '0px';
        };
        faqItems.forEach(item => {
          const q = item.querySelector('.faq-question');
          if (!q) return;
          q.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            faqItems.forEach(o => {
              o.classList.remove('active');
              const ic = o.querySelector('.icon'); if (ic) ic.className = 'fa-solid fa-plus icon';
              setFaqHeight(o);
            });
            if (!isActive) {
              item.classList.add('active');
              const ic = item.querySelector('.icon'); if (ic) ic.className = 'fa-solid fa-minus icon';
              setFaqHeight(item);
            }
          });
        });
        setFaqHeight(document.querySelector('.faq-item.active') || faqItems[0]);
      });
    </script>
  </body>
</html>
