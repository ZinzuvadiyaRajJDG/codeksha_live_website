<?php /* Shared site footer — included by every public page. */ ?>
    <footer class="site-footer">
      <div class="footer-top">
        <div class="container">
          <h2 class="section-title">Sign up to receive our latest updates</h2>
          <hr class="divider" />
          <div class="footer-grid">
            <div class="footer-col">
              <h3>Get in touch</h3>
              <ul class="contact-info">
                <li>
                  <div class="icon-box-white"><i class="fa-solid fa-phone"></i></div>
                  <div><span class="label">Call us directly?</span><p><a href="tel:+916355559016">+91 6355559016</a></p></div>
                </li>
                <li>
                  <div class="icon-box-white"><i class="fa-solid fa-location-dot"></i></div>
                  <div><span class="label">Address</span><p><a href="https://www.google.com/maps/place/Just+Digital+Gurus/@22.3177299,70.7642141,17z" target="_blank" rel="noopener noreferrer">A-1110, RK Iconic, Near Sheetal Park,<br />150 Feet Ring Rd, Rajkot, Gujarat,<br />360006 India</a></p></div>
                </li>
                <li>
                  <div class="icon-box-white"><i class="fa-regular fa-envelope"></i></div>
                  <div><span class="label">Email</span><p><a href="mailto:info@codeksha.com">info@codeksha.com</a></p></div>
                </li>
              </ul>
            </div>
            <div class="footer-col">
              <h3>Need some help?</h3>
              <ul class="footer-links">
                <li><a href="/faqs/">FAQs</a></li>
                <li><a href="/contact/">Contact</a></li>
                <li><a href="/book-demo/">Book a Free Demo</a></li>
              </ul>
            </div>
            <div class="footer-col">
              <h3>Quick Links</h3>
              <ul class="footer-links">
                <li><a href="/about-us/">About Codeksha</a></li>
                <li><a href="/courses/">All Courses</a></li>
                <li><a href="/gallery/">Gallery</a></li>
                <li><a href="/blog/">Blog</a></li>
              </ul>
            </div>
            <div class="footer-col">
              <h3>Follow us</h3>
              <ul class="social-links">
                <li><a href="https://www.instagram.com/codeksha_official" target="_blank" rel="noopener noreferrer"><span class="social-icon insta-icon"><i class="fa-brands fa-instagram"></i></span>Instagram</a></li>
                <li><a href="https://www.linkedin.com/company/codeksha/" target="_blank" rel="noopener noreferrer"><span class="social-icon linkedin-icon"><i class="fa-brands fa-linkedin-in"></i></span>Linkedin</a></li>
                <li><a href="https://x.com/TeamCodeksha" target="_blank" rel="noopener noreferrer"><span class="social-icon twitter-icon"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></span>Twitter</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="container bottom-container">
          <a href="/" class="logo"><img src="/Images/Codeksha-Logo.png" alt="Codeksha" class="footer-logo-img" loading="lazy" width="1432" height="564"></a>
          <ul class="legal-links">
            <li><a href="/terms-of-use/">Terms of use</a></li>
            <li><a href="/policy/">Privacy policy</a></li>
            <li><a href="/policy/">Refund policy</a></li>
          </ul>
          <p class="copyright">&copy; 2026 Codeksha. All rights reserved.</p>
        </div>
      </div>
    </footer>

    <!-- PROMO POPUP — shown once per visitor site-wide (localStorage-gated) -->
    <div class="promo-popup-overlay" id="ckPromoOverlay">
      <div class="promo-popup" role="dialog" aria-modal="true" aria-labelledby="ckPromoTitle">
        <button type="button" class="promo-popup-close" id="ckPromoClose" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="promo-popup-head">
          <span class="promo-popup-badge"><i class="fa-solid fa-gift"></i> New Course Package</span>
          <h3 id="ckPromoTitle">Get 10% off your first course</h3>
          <p>Use code <strong>CK-10OFF</strong> — or leave your number and we'll call you back with the details.</p>
        </div>
        <div class="promo-popup-body">
          <a href="tel:+916355559016" class="promo-popup-call-btn">
            <i class="fa-solid fa-phone"></i> Call Us: +91 63555 59016
          </a>
          <div class="promo-popup-divider"><span>or request a callback</span></div>
          <form id="ckPromoForm" novalidate>
            <?php $ck_form_type = 'popup'; require __DIR__ . '/../form-fields.php'; ?>
            <div class="contact-form-group">
              <label for="ckPromoPhone">Your phone number</label>
              <input type="tel" id="ckPromoPhone" name="phone" required inputmode="tel" autocomplete="tel"
                     maxlength="20" minlength="8" pattern="[+0-9()\-\s]{8,20}"
                     placeholder="e.g. +91 98765 43210" />
            </div>
            <button type="submit" class="promo-popup-submit" id="ckPromoSubmit">
              <span>Claim My 10% Off</span>
              <i data-lucide="arrow-right"></i>
            </button>
            <p class="promo-popup-note" id="ckPromoNote" role="status"></p>
          </form>
        </div>
      </div>
    </div>

    <script>
      (function () {
        var SEEN_KEY = 'ck_promo_popup_seen_v1';
        var overlay = document.getElementById('ckPromoOverlay');
        if (!overlay) return;

        var closeBtn = document.getElementById('ckPromoClose');
        var form = document.getElementById('ckPromoForm');
        var phoneInput = document.getElementById('ckPromoPhone');
        var submitBtn = document.getElementById('ckPromoSubmit');
        var note = document.getElementById('ckPromoNote');

        function openPopup() {
          overlay.classList.add('active');
          document.body.classList.add('promo-popup-lock');
          if (window.lucide) lucide.createIcons();
        }
        function closePopup() {
          overlay.classList.remove('active');
          document.body.classList.remove('promo-popup-lock');
        }
        function markSeen() {
          try { localStorage.setItem(SEEN_KEY, '1'); } catch (e) {}
        }
        function hasBeenSeen() {
          try { return localStorage.getItem(SEEN_KEY) === '1'; } catch (e) { return false; }
        }

        if (!hasBeenSeen()) {
          window.setTimeout(function () {
            openPopup();
            markSeen();
          }, 1800);
        }

        closeBtn.addEventListener('click', closePopup);
        overlay.addEventListener('click', function (e) {
          if (e.target === overlay) closePopup();
        });
        document.addEventListener('keydown', function (e) {
          if (e.key === 'Escape' && overlay.classList.contains('active')) closePopup();
        });

        // Manually reopen it from the sitewide top banner link.
        document.querySelectorAll('.top-banner a').forEach(function (a) {
          a.addEventListener('click', function (e) {
            e.preventDefault();
            openPopup();
          });
        });

        if (form) {
          form.addEventListener('submit', function (e) {
            e.preventDefault();
            note.className = 'promo-popup-note';
            note.textContent = '';

            if (!phoneInput.checkValidity()) {
              note.textContent = 'Please enter a valid Indian phone number.';
              note.classList.add('error');
              phoneInput.focus();
              return;
            }

            submitBtn.disabled = true;
            submitBtn.querySelector('span').textContent = 'Sending…';

            fetch('/submit', {
              method: 'POST',
              headers: { 'Accept': 'application/json' },
              body: new FormData(form),
            })
              .then(function (res) { return res.json(); })
              .then(function (data) {
                note.textContent = data.message || (data.ok ? 'Thanks!' : 'Something went wrong.');
                note.classList.add(data.ok ? 'success' : 'error');
                if (data.ok) {
                  form.reset();
                  window.setTimeout(closePopup, 2200);
                } else {
                  submitBtn.disabled = false;
                  submitBtn.querySelector('span').textContent = 'Claim My 10% Off';
                }
              })
              .catch(function () {
                note.textContent = 'Network error — please try again.';
                note.classList.add('error');
                submitBtn.disabled = false;
                submitBtn.querySelector('span').textContent = 'Claim My 10% Off';
              });
          });
        }
      })();
    </script>
