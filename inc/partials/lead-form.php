<?php
/**
 * Short lead-capture form (name + Indian phone) that posts to /submit as an "enquiry".
 * Set before including:  $lf_course (course name), $lf_id (unique id prefix),
 * optional $lf_title / $lf_sub.  The script below is output once per page.
 */
$lf_course = $lf_course ?? 'Course enquiry';
$lf_id     = $lf_id ?? 'lf1';
$lf_title  = $lf_title ?? 'Get Syllabus, Fees &amp; a Free Demo';
$lf_sub    = $lf_sub ?? 'Leave your number and our counsellor will call you back. No spam, no pressure.';
?>
<div class="lead-card">
  <div class="lead-card-head">
    <span class="lead-badge"><i class="fa-solid fa-headset"></i> Free counselling</span>
    <h3><?= $lf_title ?></h3>
    <p><?= $lf_sub ?></p>
  </div>
  <form class="lead-form" data-lead-form novalidate>
    <?php $ck_form_type = 'enquiry'; require __DIR__ . '/../form-fields.php'; ?>
    <input type="hidden" name="course" value="<?= htmlspecialchars($lf_course, ENT_QUOTES) ?>">
    <div class="contact-form-group">
      <label for="<?= $lf_id ?>Name">Your name *</label>
      <input type="text" id="<?= $lf_id ?>Name" name="name" required maxlength="100" autocomplete="name" placeholder="Your name" />
    </div>
    <div class="contact-form-group">
      <label for="<?= $lf_id ?>Phone">Mobile number *</label>
      <input type="tel" id="<?= $lf_id ?>Phone" name="phone" required inputmode="tel" autocomplete="tel"
             maxlength="20" minlength="8" placeholder="e.g. +91 98765 43210" />
    </div>
    <button type="submit" class="lead-submit"><span>Call Me Back</span><i class="fa-solid fa-phone-volume"></i></button>
    <p class="lead-note" role="status"></p>
    <p class="lead-or">or call us now: <a href="tel:+916355559016">+91 63555 59016</a></p>
  </form>
</div>
<?php if (empty($GLOBALS['ck_lead_js_done'])): $GLOBALS['ck_lead_js_done'] = true; ?>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const phoneError = (v) => {
      v = (v || '').trim();
      if (!v) return 'Please enter your mobile number.';
      const digits = v.replace(/\D/g, '');
      if (!/^\+?[0-9\s()\-]{8,20}$/.test(v) || digits.length < 8 || digits.length > 15)
        return 'Enter a valid phone number (8-15 digits).';
      if (/^(\d)\1+$/.test(digits)) return 'That does not look like a real phone number.';
      const nat = digits.replace(/^(0091|91|0)/, '');
      const foreign = v.startsWith('+') && !digits.startsWith('91');
      if (!foreign && nat.length === 10 && !/^[6-9]/.test(nat))
        return 'Indian mobile numbers start with 6, 7, 8 or 9.';
      return '';
    };
    document.querySelectorAll('form[data-lead-form]').forEach((form) => {
      const note = form.querySelector('.lead-note');
      const btn = form.querySelector('.lead-submit');
      const label = btn.querySelector('span');
      const show = (msg, cls) => { note.textContent = msg; note.className = 'lead-note show ' + cls; };
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = form.elements['name'].value.trim();
        const err = phoneError(form.elements['phone'].value);
        if (name.length < 2) { show('Please enter your name.', 'error'); form.elements['name'].focus(); return; }
        if (err) { show(err, 'error'); form.elements['phone'].focus(); return; }
        btn.disabled = true; label.textContent = 'Sending...';
        fetch('/submit', { method: 'POST', headers: { 'Accept': 'application/json' }, body: new FormData(form) })
          .then((r) => r.json())
          .then((d) => {
            show(d.message || (d.ok ? 'Thanks!' : 'Something went wrong.'), d.ok ? 'success' : 'error');
            if (d.ok) { form.reset(); label.textContent = 'Request Sent'; }
            else { btn.disabled = false; label.textContent = 'Call Me Back'; }
          })
          .catch(() => { show('Network error. Please try again.', 'error'); btn.disabled = false; label.textContent = 'Call Me Back'; });
      });
    });
  });
</script>
<?php endif; ?>
