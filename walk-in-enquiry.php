<?php @include __DIR__ . '/inc/tracker.php'; /* analytics */ ?>
<?php
// Walk-in enquiry form: students fill this when they visit the Rajkot office.
// Saved as form_type "walkin" via /submit (see inc/form-handler.php) and listed in /admin/submissions.php.
$courses = [
    'Web Development' => ['Full Stack Web Development', 'Frontend Development', 'Backend Development', 'JavaScript', 'MongoDB', 'WordPress Development'],
    'Digital Marketing' => ['Digital Marketing & SEO', 'SEO', 'Google Ads', 'Social Media Marketing'],
    'Design' => ['UI/UX Design', 'Graphic Design'],
    'AI & Automation' => ['AI & Automation', 'n8n Automation', 'Prompt Engineering'],
];
$interests = ['Web Development', 'Digital Marketing', 'Design (UI/UX & Graphic)', 'AI & Automation', 'Not sure yet'];
$statuses  = ['School student', 'College student', 'Graduate', 'Working professional', 'Business owner', 'Other'];
$goals     = ['Get a job', 'Freelancing', 'Start my own business', 'Upgrade my skills', 'Learn as a hobby'];
$starts    = ['Immediately', 'Within 1 month', '1-3 months', 'Just exploring'];
$batches   = ['Morning', 'Afternoon', 'Evening', 'Weekend', 'Flexible'];
$sources   = ['Google search', 'Instagram', 'Facebook', 'YouTube', 'Friend / family', 'Passing by the office', 'Other'];
$h = static fn($s) => htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
$chips = static function (string $name, array $opts, string $type = 'radio', bool $req = false) use ($h) {
    foreach ($opts as $i => $o) {
        $id = 'wk-' . preg_replace('/[^a-z]+/', '', $name) . $i;
        echo '<label class="wk-chip" for="' . $id . '"><input type="' . $type . '" id="' . $id . '" name="' . $name . ($type === 'checkbox' ? '[]' : '') . '" value="' . $h($o) . '"' . ($req && $i === 0 ? ' required' : '') . '><span>' . $h($o) . '</span></label>';
    }
};
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Walk-in Enquiry Form | Codeksha Rajkot</title>
    <meta name="description" content="Visiting Codeksha's Rajkot office? Fill in this short form so our counsellor can help you faster." />
    <meta name="robots" content="noindex, nofollow" />
    <link rel="canonical" href="https://codeksha.com/walk-in-enquiry/" />
    <meta name="theme-color" content="#2563eb" />

    <?php require __DIR__ . '/inc/partials/head.php'; ?>

    <style>
      .wk-body { margin: 0; min-height: 100vh; background: #f1f5f9; font-family: 'Urbanist', system-ui, sans-serif; color: #1a202c; -webkit-text-size-adjust: 100%; }
      .wk-top { background: #fff; border-bottom: 1px solid #e2e8f0; }
      .wk-top-in { max-width: 720px; margin: 0 auto; padding: 14px 20px; display: flex; align-items: center; justify-content: space-between; gap: 14px; }
      .wk-top img { height: 38px; width: auto; display: block; }
      .wk-top a.wk-call { font-size: 14px; font-weight: 700; color: #2563eb; text-decoration: none; white-space: nowrap; }
      .wk-wrap { max-width: 720px; margin: 0 auto; padding: 26px 16px 48px; }
      .wk-intro h1 { font-size: clamp(26px, 6vw, 34px); line-height: 1.15; font-weight: 800; margin: 0 0 8px; }
      .wk-intro h1 span { color: #2563eb; }
      .wk-intro p { margin: 0 0 20px; color: #475569; font-size: 16px; line-height: 1.5; }
      .wk-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 22px 18px 20px; box-shadow: 0 1px 2px rgba(15,23,42,.04), 0 24px 48px -28px rgba(15,23,42,.22); }
      @media (min-width: 600px) { .wk-card { padding: 30px 32px 28px; } .wk-wrap { padding-top: 40px; } }

      .wk-steps { display: flex; gap: 8px; margin-bottom: 6px; }
      .wk-steps i { flex: 1; height: 6px; border-radius: 6px; background: #e2e8f0; transition: background .25s; }
      .wk-steps i.on { background: #2563eb; }
      .wk-stepname { font-size: 13px; font-weight: 700; color: #64748b; margin: 0 0 18px; letter-spacing: .02em; }
      .wk-stepname b { color: #2563eb; }

      .wk-step { display: none; }
      .wk-step.on { display: block; animation: wkin .25s ease; }
      @keyframes wkin { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: none; } }
      .wk-step h2 { font-size: 21px; font-weight: 800; margin: 0 0 4px; }
      .wk-sub { margin: 0 0 18px; color: #64748b; font-size: 14.5px; }

      .wk-f { margin-bottom: 18px; }
      .wk-f > label, .wk-f > .wk-lbl { display: block; font-size: 14.5px; font-weight: 700; color: #1e293b; margin-bottom: 7px; }
      .wk-f small { font-weight: 500; color: #64748b; }
      .wk-f input[type=text], .wk-f input[type=email], .wk-f input[type=tel], .wk-f select, .wk-f textarea {
        width: 100%; box-sizing: border-box; min-height: 52px; padding: 13px 16px; border: 1.5px solid #cbd5e1; border-radius: 12px;
        font: inherit; font-size: 16px; /* 16px stops iOS zooming in on focus */ color: #1a202c; background: #fff; transition: border-color .2s, box-shadow .2s; }
      .wk-f textarea { min-height: 96px; resize: vertical; }
      .wk-f input:focus, .wk-f select:focus, .wk-f textarea:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 4px rgba(37,99,235,.14); }
      .wk-f select { -webkit-appearance: none; appearance: none; padding-right: 46px; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E") no-repeat right 14px center; }
      .wk-f.bad input, .wk-f.bad select, .wk-f.bad textarea { border-color: #dc2626; }
      .wk-f.bad .wk-chips .wk-chip span { border-color: #fca5a5; }
      .wk-err { display: none; color: #dc2626; font-size: 13.5px; font-weight: 600; margin-top: 6px; }
      .wk-f.bad .wk-err { display: block; }

      .wk-chips { display: flex; flex-wrap: wrap; gap: 9px; }
      .wk-chip { position: relative; cursor: pointer; }
      .wk-chip input { position: absolute; opacity: 0; inset: 0; width: 100%; height: 100%; margin: 0; cursor: pointer; }
      .wk-chip span { display: inline-flex; align-items: center; min-height: 46px; padding: 10px 16px; border: 1.5px solid #cbd5e1; border-radius: 999px; font-size: 15px; font-weight: 600; color: #334155; background: #fff; transition: all .15s; user-select: none; }
      .wk-chip:hover span { border-color: #94a3b8; }
      .wk-chip input:checked + span { background: #2563eb; border-color: #2563eb; color: #fff; }
      .wk-chip input:focus-visible + span { box-shadow: 0 0 0 4px rgba(37,99,235,.25); }

      .wk-consent { display: flex; gap: 12px; align-items: flex-start; padding: 14px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; cursor: pointer; font-size: 14.5px; line-height: 1.45; color: #334155; }
      .wk-consent input { width: 22px; height: 22px; flex: none; margin: 1px 0 0; accent-color: #2563eb; }
      .wk-f.bad .wk-consent { border-color: #dc2626; }

      .wk-nav { display: flex; gap: 12px; margin-top: 24px; }
      .wk-btn { flex: 1; min-height: 54px; border: 0; border-radius: 14px; font: inherit; font-size: 17px; font-weight: 800; cursor: pointer; transition: transform .1s, background .2s; }
      .wk-btn:active { transform: scale(.98); }
      .wk-btn.pri { background: #2563eb; color: #fff; }
      .wk-btn.pri:hover { background: #1d4ed8; }
      .wk-btn.pri:disabled { opacity: .65; cursor: wait; }
      .wk-btn.sec { flex: 0 0 auto; padding: 0 22px; background: #fff; color: #334155; border: 1.5px solid #cbd5e1; }
      .wk-note { margin-top: 14px; font-size: 14px; font-weight: 600; color: #dc2626; display: none; text-align: center; }
      .wk-note.show { display: block; }

      .wk-done { display: none; text-align: center; padding: 18px 4px 6px; }
      .wk-done.on { display: block; animation: wkin .3s ease; }
      .wk-tick { width: 76px; height: 76px; border-radius: 50%; background: #dcfce7; color: #16a34a; display: inline-flex; align-items: center; justify-content: center; font-size: 36px; margin-bottom: 14px; }
      .wk-done h2 { font-size: 26px; font-weight: 800; margin: 0 0 8px; }
      .wk-done p { color: #475569; font-size: 16.5px; line-height: 1.5; margin: 0 0 22px; }
      .wk-foot { text-align: center; margin-top: 22px; font-size: 13.5px; color: #64748b; line-height: 1.6; }
      .wk-foot a { color: #2563eb; font-weight: 700; text-decoration: none; }
      .wk-hp { position: absolute; left: -9999px; }
      @media (prefers-reduced-motion: reduce) { .wk-step.on, .wk-done.on { animation: none; } }
    </style>
  </head>
  <body class="wk-body">
<?php require __DIR__ . '/inc/partials/gtm-body.php'; ?>
    <header class="wk-top">
      <div class="wk-top-in">
        <a href="/" aria-label="Codeksha home"><img src="/Images/Codeksha-Logo.png" alt="Codeksha" width="1432" height="564"></a>
        <a class="wk-call" href="tel:+916355559016"><i class="fa-solid fa-phone"></i> +91 63555 59016</a>
      </div>
    </header>

    <main class="wk-wrap">
      <div class="wk-intro">
        <h1>Welcome to <span>Codeksha</span> &#128075;</h1>
        <p>Thanks for visiting our Rajkot office. Fill in this quick form (about a minute) so our counsellor can guide you better.</p>
      </div>

      <div class="wk-card">
        <form id="wkForm" method="post" action="/submit" novalidate autocomplete="on">
          <?php $ck_form_type = 'walkin'; require __DIR__ . '/inc/form-fields.php'; ?>

          <div id="wkFlow">
            <div class="wk-steps" aria-hidden="true"><i class="on"></i><i></i><i></i></div>
            <p class="wk-stepname" id="wkStepName">Step <b>1</b> of 3 &middot; About you</p>

            <!-- STEP 1 -->
            <section class="wk-step on" data-step="1">
              <h2>Let's start with you</h2>
              <p class="wk-sub">So we can find you when it's your turn.</p>
              <div class="wk-f" data-req>
                <label for="wkName">Full name</label>
                <input type="text" id="wkName" name="name" maxlength="100" autocomplete="name" placeholder="e.g. Riya Patel" enterkeyhint="next">
                <div class="wk-err">Please enter your full name.</div>
              </div>
              <div class="wk-f" data-req>
                <label for="wkPhone">Mobile number</label>
                <input type="tel" id="wkPhone" name="phone" maxlength="20" inputmode="tel" autocomplete="tel" placeholder="e.g. 98765 43210" enterkeyhint="next">
                <div class="wk-err" id="wkPhoneErr">Please enter your mobile number.</div>
              </div>
              <div class="wk-f" data-req>
                <label for="wkEmail">Email address</label>
                <input type="email" id="wkEmail" name="email" maxlength="190" inputmode="email" autocomplete="email" placeholder="you@example.com" enterkeyhint="next">
                <div class="wk-err">Please enter a valid email address.</div>
              </div>
              <div class="wk-f" data-req data-group="status">
                <span class="wk-lbl" id="lblStatus">I am currently a&hellip;</span>
                <div class="wk-chips" role="radiogroup" aria-labelledby="lblStatus"><?php $chips('status', $statuses); ?></div>
                <div class="wk-err">Please pick one.</div>
              </div>
              <div class="wk-f">
                <label for="wkQual">Qualification / college <small>(optional)</small></label>
                <input type="text" id="wkQual" name="qualification" maxlength="150" placeholder="e.g. BCA, 2nd year, RK University">
              </div>
              <div class="wk-f">
                <label for="wkCity">City / area <small>(optional)</small></label>
                <input type="text" id="wkCity" name="city" maxlength="100" autocomplete="address-level2" placeholder="e.g. Rajkot, Morbi, Gondal">
              </div>
            </section>

            <!-- STEP 2 -->
            <section class="wk-step" data-step="2">
              <h2>What would you like to learn?</h2>
              <p class="wk-sub">Pick anything that interests you. You can choose more than one.</p>
              <div class="wk-f" data-req data-group="interest">
                <span class="wk-lbl" id="lblInterest">Areas you are interested in</span>
                <div class="wk-chips" aria-labelledby="lblInterest"><?php $chips('interest', $interests, 'checkbox'); ?></div>
                <div class="wk-err">Please choose at least one.</div>
              </div>
              <div class="wk-f" data-req>
                <label for="wkCourse">Which course are you enquiring about?</label>
                <select id="wkCourse" name="course">
                  <option value="" selected disabled>Select a course</option>
                  <?php foreach ($courses as $group => $list): ?>
                    <optgroup label="<?= $h($group) ?>"><?php foreach ($list as $c): ?><option><?= $h($c) ?></option><?php endforeach; ?></optgroup>
                  <?php endforeach; ?>
                  <option>Not sure yet - need guidance</option>
                </select>
                <div class="wk-err">Please select a course.</div>
              </div>
              <div class="wk-f">
                <span class="wk-lbl" id="lblGoal">What is your goal? <small>(optional)</small></span>
                <div class="wk-chips" role="radiogroup" aria-labelledby="lblGoal"><?php $chips('goal', $goals); ?></div>
              </div>
            </section>

            <!-- STEP 3 -->
            <section class="wk-step" data-step="3">
              <h2>Almost done</h2>
              <p class="wk-sub">A few last details help us plan your batch.</p>
              <div class="wk-f">
                <span class="wk-lbl" id="lblStart">When do you want to start? <small>(optional)</small></span>
                <div class="wk-chips" role="radiogroup" aria-labelledby="lblStart"><?php $chips('start', $starts); ?></div>
              </div>
              <div class="wk-f">
                <span class="wk-lbl" id="lblBatch">Preferred batch time <small>(optional)</small></span>
                <div class="wk-chips" role="radiogroup" aria-labelledby="lblBatch"><?php $chips('batch', $batches); ?></div>
              </div>
              <div class="wk-f">
                <span class="wk-lbl" id="lblSource">How did you hear about us? <small>(optional)</small></span>
                <div class="wk-chips" role="radiogroup" aria-labelledby="lblSource"><?php $chips('source', $sources); ?></div>
              </div>
              <div class="wk-f">
                <label for="wkMsg">Anything else you'd like to ask? <small>(optional)</small></label>
                <textarea id="wkMsg" name="message" maxlength="4000" placeholder="Fees, timings, placements, anything&hellip;"></textarea>
              </div>
              <div class="wk-f" data-req data-group="consent">
                <label class="wk-consent" for="wkConsent">
                  <input type="checkbox" id="wkConsent" name="consent" value="1">
                  <span>I agree that Codeksha may contact me by phone, WhatsApp or email about courses. We never share your details.</span>
                </label>
                <div class="wk-err">Please tick this box so we can contact you.</div>
              </div>
            </section>

            <div class="wk-nav">
              <button type="button" class="wk-btn sec" id="wkBack" hidden>Back</button>
              <button type="button" class="wk-btn pri" id="wkNext">Continue</button>
              <button type="submit" class="wk-btn pri" id="wkSubmit" hidden>Submit</button>
            </div>
            <p class="wk-note" id="wkNote" role="alert"></p>
          </div>

          <div class="wk-done" id="wkDone" role="status" aria-live="polite">
            <div class="wk-tick"><i class="fa-solid fa-check"></i></div>
            <h2 id="wkDoneTitle">Thank you!</h2>
            <p>Your details are saved. Please take a seat &mdash; our counsellor will be with you shortly.</p>
            <button type="button" class="wk-btn sec" id="wkAgain" style="width:100%">Submit another response</button>
          </div>
        </form>
      </div>

      <p class="wk-foot">Codeksha &middot; A-1110, RK Iconic, Near Sheetal Park, 150 Feet Ring Rd, Rajkot<br>
        <a href="tel:+916355559016">+91 63555 59016</a> &middot; <a href="mailto:info@codeksha.com">info@codeksha.com</a></p>
    </main>

    <script>
      (function () {
        var form = document.getElementById('wkForm');
        var steps = [].slice.call(form.querySelectorAll('.wk-step'));
        var bars = form.querySelectorAll('.wk-steps i');
        var names = ['About you', 'Your interest', 'Final details'];
        var cur = 0;
        var $ = function (id) { return document.getElementById(id); };
        var back = $('wkBack'), next = $('wkNext'), submit = $('wkSubmit'), note = $('wkNote');

        function phoneError(v) {
          v = (v || '').trim();
          if (!v) return 'Please enter your mobile number.';
          var digits = v.replace(/\D/g, '');
          if (!/^\+?[0-9\s()\-]{8,20}$/.test(v) || digits.length < 8 || digits.length > 15) return 'Enter a valid mobile number (8-15 digits).';
          if (/^(\d)\1+$/.test(digits)) return 'That does not look like a real phone number.';
          var nat = digits.replace(/^(0091|91|0)/, '');
          var foreign = v.charAt(0) === '+' && digits.indexOf('91') !== 0;
          if (!foreign && nat.length === 10 && !/^[6-9]/.test(nat)) return 'Indian mobile numbers start with 6, 7, 8 or 9.';
          return '';
        }

        function setBad(box, bad, msg) {
          box.classList.toggle('bad', bad);
          if (bad && msg) { var e = box.querySelector('.wk-err'); if (e) e.textContent = msg; }
        }
        function validStep(i) {
          var ok = true, first = null;
          [].forEach.call(steps[i].querySelectorAll('.wk-f[data-req]'), function (box) {
            var bad = false, msg = '';
            var g = box.getAttribute('data-group');
            if (g === 'status') bad = !form.querySelector('input[name=status]:checked');
            else if (g === 'interest') bad = !form.querySelector('input[name="interest[]"]:checked');
            else if (g === 'consent') bad = !$('wkConsent').checked;
            else {
              var el = box.querySelector('input,select');
              var v = (el.value || '').trim();
              if (el.id === 'wkName') bad = v.length < 2;
              else if (el.id === 'wkPhone') { msg = phoneError(v); bad = !!msg; }
              else if (el.id === 'wkEmail') bad = !/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v);
              else bad = !v;
            }
            setBad(box, bad, msg);
            if (bad) { ok = false; if (!first) first = box; }
          });
          if (first) {
            first.scrollIntoView({ behavior: 'smooth', block: 'center' });
            var f = first.querySelector('input:not([type=radio]):not([type=checkbox]),select');
            if (f) f.focus({ preventScroll: true });
          }
          return ok;
        }
        function show(i) {
          cur = i;
          steps.forEach(function (s, n) { s.classList.toggle('on', n === i); });
          [].forEach.call(bars, function (b, n) { b.classList.toggle('on', n <= i); });
          $('wkStepName').innerHTML = 'Step <b>' + (i + 1) + '</b> of 3 &middot; ' + names[i];
          back.hidden = i === 0;
          next.hidden = i === steps.length - 1;
          submit.hidden = i !== steps.length - 1;
          note.classList.remove('show');
          window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        next.addEventListener('click', function () { if (validStep(cur)) show(cur + 1); });
        back.addEventListener('click', function () { if (cur > 0) show(cur - 1); });
        // Enter key moves forward instead of submitting early
        form.addEventListener('keydown', function (e) {
          if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA' && cur < steps.length - 1) { e.preventDefault(); next.click(); }
        });
        // clear red state as the visitor fixes a field
        form.addEventListener('input', function (e) { var b = e.target.closest('.wk-f'); if (b) b.classList.remove('bad'); });
        form.addEventListener('change', function (e) { var b = e.target.closest('.wk-f'); if (b) b.classList.remove('bad'); });

        form.addEventListener('submit', function (e) {
          e.preventDefault();
          for (var i = 0; i < steps.length; i++) { if (!validStep(i)) { show(i); validStep(i); return; } }
          submit.disabled = true; submit.textContent = 'Sending...';
          fetch('/submit', { method: 'POST', headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }, body: new FormData(form) })
            .then(function (r) { return r.json(); })
            .then(function (d) {
              if (d && d.ok) {
                var first = ($('wkName').value || '').trim().split(/\s+/)[0];
                $('wkDoneTitle').textContent = first ? 'Thank you, ' + first + '!' : 'Thank you!';
                $('wkFlow').style.display = 'none';
                $('wkDone').classList.add('on');
                window.scrollTo({ top: 0, behavior: 'smooth' });
                setTimeout(function () { if ($('wkDone').classList.contains('on')) location.reload(); }, 60000); // ready for the next student
              } else {
                note.textContent = (d && d.message) || 'Something went wrong. Please try again.';
                note.classList.add('show');
              }
            })
            .catch(function () { note.textContent = 'Network error. Please check your connection and try again.'; note.classList.add('show'); })
            .then(function () { submit.disabled = false; submit.textContent = 'Submit'; });
        });
        $('wkAgain').addEventListener('click', function () { location.reload(); });

        // the anti-spam token expires after 2 hours: refresh an untouched form so a tablet left open keeps working
        setTimeout(function () { if (!$('wkName').value && cur === 0) location.reload(); }, 90 * 60 * 1000);
        if (window.lucide) lucide.createIcons();
      })();
    </script>
  </body>
</html>
