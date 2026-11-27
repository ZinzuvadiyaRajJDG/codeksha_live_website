/* Home page (new design) behaviour. Page: index-2.php · styles: /assets/loc/styles.css + /assets/home2.css
   Same interactions as the location pages (/assets/loc/script.js), plus the hero review slider and the
   promo popup. Every block checks its elements first, so a removed section never breaks the rest. */
(function () {
  'use strict';
  var $ = function (s, r) { return (r || document).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };
  var reduce = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- mobile menu ---------- */
  var burger = $('#burger'), menu = $('#mobileMenu'), top = $('#top');
  if (burger && menu && top) {
    var setMenu = function (open) {
      menu.hidden = !open;
      burger.setAttribute('aria-expanded', open);
      burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
      top.classList.toggle('menu-open', open);
    };
    burger.addEventListener('click', function () { setMenu(menu.hidden); });
    $$('a', menu).forEach(function (a) { a.addEventListener('click', function () { setMenu(false); }); });
    addEventListener('resize', function () { if (innerWidth > 1060 && !menu.hidden) setMenu(false); });
  }

  /* ---------- count-up (final values are already in the markup) ---------- */
  if (!reduce && 'IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (es) {
      es.forEach(function (e) {
        if (!e.isIntersecting) return;
        io.unobserve(e.target);
        var el = e.target, end = parseFloat(el.dataset.count), dec = +(el.dataset.dec || 0), t0 = performance.now(), d = 1400;
        var fmt = function (v) { return dec ? v.toFixed(dec) : Math.round(v).toLocaleString('en-IN'); };
        var step = function (t) {
          var p = Math.min(1, (t - t0) / d), k = 1 - Math.pow(1 - p, 3);
          el.textContent = fmt(end * k);
          if (p < 1) requestAnimationFrame(step); else el.textContent = fmt(end);
        };
        requestAnimationFrame(step);
      });
    }, { threshold: 0.6 });
    $$('[data-count]').forEach(function (el) { io.observe(el); });
  }

  /* scroll a rail by one card */
  var by = function (r, dir) {
    var card = Array.prototype.find.call(r.children, function (c) { return !c.hidden; });
    var w = card ? card.getBoundingClientRect().width + 22 : 320;
    r.scrollBy({ left: dir * w, behavior: reduce ? 'auto' : 'smooth' });
  };

  /* ---------- hero: student review slider ---------- */
  var hero = $('#heroReviews');
  if (hero) {
    var slides = $$('.person', hero), quote = $('#heroQuote'), qText = $('blockquote', quote),
        qName = $('.who b', quote), qRole = $('.who small', quote), qImg = $('.who img', quote),
        dotsBox = $('#heroDots'), cur = 0, timer = null;
    var dots = slides.map(function (s, i) {
      var b = document.createElement('button');
      b.type = 'button';
      b.setAttribute('aria-label', 'Show review ' + (i + 1) + ': ' + s.dataset.name);
      b.addEventListener('click', function () { show(i); restart(); });
      dotsBox.appendChild(b);
      return b;
    });
    var show = function (i) {
      cur = (i + slides.length) % slides.length;
      var s = slides[cur];
      slides.forEach(function (x, j) { x.classList.toggle('is-on', j === cur); });
      dots.forEach(function (d, j) { d.setAttribute('aria-current', j === cur); });
      quote.classList.add('is-swapping');
      setTimeout(function () {
        qText.textContent = s.dataset.quote;
        qName.textContent = s.dataset.name;
        qRole.textContent = s.dataset.role;
        qImg.src = s.dataset.face; qImg.alt = s.dataset.name;
        quote.classList.remove('is-swapping');
      }, reduce ? 0 : 300);
    };
    var restart = function () {
      clearInterval(timer);
      if (!reduce) timer = setInterval(function () { if (!document.hidden) show(cur + 1); }, 6000);
    };
    show(0); restart();
    hero.addEventListener('mouseenter', function () { clearInterval(timer); });
    hero.addEventListener('mouseleave', restart);
  }

  /* ---------- course rail: arrows, scrubber, drag, filters ---------- */
  var rail = $('#courseRail'), bar = $('#railBar'), prev = $('#cPrev'), next = $('#cNext'), scrub = $('#scrub');
  if (rail && bar && prev && next && scrub) {
    prev.onclick = function () { by(rail, -1); };
    next.onclick = function () { by(rail, 1); };
    var arrows = function (e) {
      if (e.key === 'ArrowRight') { by(rail, 1); e.preventDefault(); }
      if (e.key === 'ArrowLeft') { by(rail, -1); e.preventDefault(); }
    };
    rail.addEventListener('keydown', arrows);
    scrub.addEventListener('keydown', arrows);
    var upd = function () {
      var max = rail.scrollWidth - rail.clientWidth, vis = Math.min(1, rail.clientWidth / rail.scrollWidth);
      bar.style.width = (vis * 100) + '%';
      bar.style.transform = 'translateX(' + (max > 0 ? (rail.scrollLeft / max) * ((1 - vis) / vis) * 100 : 0) + '%)';
      prev.disabled = rail.scrollLeft < 4;
      next.disabled = rail.scrollLeft > max - 4;
      scrub.setAttribute('aria-valuenow', max > 0 ? Math.round(rail.scrollLeft / max * 100) : 0);
    };
    rail.addEventListener('scroll', upd, { passive: true });
    addEventListener('resize', upd);
    upd();
    var sd = false;
    var seek = function (e) {
      var r = scrub.getBoundingClientRect(), k = Math.max(0, Math.min(1, (e.clientX - r.left) / r.width));
      rail.scrollLeft = k * (rail.scrollWidth - rail.clientWidth);
    };
    scrub.addEventListener('pointerdown', function (e) { sd = true; scrub.setPointerCapture(e.pointerId); rail.style.scrollSnapType = 'none'; seek(e); });
    scrub.addEventListener('pointermove', function (e) { if (sd) seek(e); });
    scrub.addEventListener('pointerup', function () { sd = false; rail.style.scrollSnapType = ''; });
    var dx = null, sl = 0, moved = false;
    rail.addEventListener('pointerdown', function (e) { if (e.pointerType !== 'mouse') return; dx = e.clientX; sl = rail.scrollLeft; moved = false; });
    addEventListener('pointermove', function (e) {
      if (dx === null) return;
      var d = e.clientX - dx;
      if (Math.abs(d) > 5) { moved = true; rail.classList.add('dragging'); }
      if (moved) rail.scrollLeft = sl - d;
    });
    addEventListener('pointerup', function () { if (dx === null) return; dx = null; rail.classList.remove('dragging'); });
    rail.addEventListener('click', function (e) { if (moved) { e.preventDefault(); moved = false; } }, true);
    $$('.cf-chip').forEach(function (ch) {
      ch.addEventListener('click', function () {
        var f = ch.dataset.f, n = 0;
        $$('.cf-chip').forEach(function (x) { var on = x === ch; x.classList.toggle('on', on); x.setAttribute('aria-pressed', on); });
        $$('.course', rail).forEach(function (c) { var s = f === 'all' || c.dataset.cat === f; c.hidden = !s; if (s) n++; });
        var cnt = $('#railCount');
        if (cnt) cnt.textContent = 'Showing ' + n + (n === 1 ? ' course' : ' courses');
        rail.scrollTo({ left: 0 });
        upd();
      });
    });
  }

  /* ---------- flip cards (tap / keyboard) ---------- */
  $$('.flip').forEach(function (f) {
    var b = $('button', f);
    if (b) b.addEventListener('click', function () { f.classList.toggle('flipped'); });
  });

  /* ---------- testimonials ---------- */
  var tr = $('#tRail'), tDots = $('#tDots');
  if (tr && tDots) {
    var cards = $$('.tcard', tr);
    cards.forEach(function (c, i) {
      var b = document.createElement('button');
      b.type = 'button';
      b.setAttribute('aria-label', 'Show testimonial ' + (i + 1));
      b.onclick = function () { tr.scrollTo({ left: c.offsetLeft - tr.offsetLeft - 4, behavior: reduce ? 'auto' : 'smooth' }); };
      tDots.appendChild(b);
    });
    var dset = function () {
      var best = 0, dmin = 1e9;
      cards.forEach(function (c, i) { var d = Math.abs(c.offsetLeft - tr.offsetLeft - 4 - tr.scrollLeft); if (d < dmin) { dmin = d; best = i; } });
      if (tr.scrollLeft + tr.clientWidth >= tr.scrollWidth - 4) best = cards.length - 1;
      $$('button', tDots).forEach(function (b, i) { b.setAttribute('aria-current', i === best); });
    };
    tr.addEventListener('scroll', dset, { passive: true });
    dset();
    var tp = $('#tPrev'), tn = $('#tNext');
    if (tp) tp.onclick = function () { by(tr, -1); };
    if (tn) tn.onclick = function () { by(tr, 1); };
    var auto = !reduce && setInterval(function () {
      if (document.hidden) return;
      var end = tr.scrollLeft + tr.clientWidth >= tr.scrollWidth - 4;
      if (end) tr.scrollTo({ left: 0, behavior: 'smooth' }); else by(tr, 1);
    }, 5000);
    ['pointerdown', 'focusin', 'mouseenter'].forEach(function (ev) {
      tr.addEventListener(ev, function () { clearInterval(auto); auto = null; });
    });
  }

  /* ---------- FAQ: one open at a time ---------- */
  $$('#acc details').forEach(function (d) {
    d.addEventListener('toggle', function () {
      if (d.open) $$('#acc details').forEach(function (o) { if (o !== d) o.open = false; });
    });
  });

  /* ---------- promo popup: same rules as the site-wide one (shown once per visitor) ---------- */
  var overlay = $('#ckPromoOverlay');
  if (overlay) {
    var SEEN_KEY = 'ck_promo_popup_seen_v1';
    var form = $('#ckPromoForm'), phone = $('#ckPromoPhone'), submit = $('#ckPromoSubmit'),
        note = $('#ckPromoNote'), lastFocus = null;
    var open = function () {
      lastFocus = document.activeElement;
      if (note && !(submit && submit.disabled)) { note.className = 'fnote'; note.textContent = ''; }
      overlay.classList.add('active');
      overlay.setAttribute('aria-hidden', 'false');
      document.body.classList.add('promo-lock');
      setTimeout(function () { var x = $('#ckPromoClose'); if (x) x.focus(); }, 50);
    };
    var close = function () {
      overlay.classList.remove('active');
      overlay.setAttribute('aria-hidden', 'true');
      document.body.classList.remove('promo-lock');
      if (lastFocus && lastFocus.focus) lastFocus.focus();
    };
    var seen = function () { try { return localStorage.getItem(SEEN_KEY) === '1'; } catch (e) { return false; } };
    var markSeen = function () { try { localStorage.setItem(SEEN_KEY, '1'); } catch (e) {} };
    if (!seen()) setTimeout(function () { open(); markSeen(); }, 1800);
    $('#ckPromoClose').addEventListener('click', close);
    overlay.addEventListener('click', function (e) { if (e.target === overlay) close(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && overlay.classList.contains('active')) close(); });
    $$('[data-open-promo]').forEach(function (b) { b.addEventListener('click', function (e) { e.preventDefault(); open(); }); });

    if (form) {
      var label = $('span', submit), resetLabel = 'Claim My 10% Off';
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        note.className = 'fnote';
        note.textContent = '';
        if (!phone.checkValidity()) {
          note.textContent = 'Please enter a valid Indian phone number.';
          note.classList.add('err');
          phone.focus();
          return;
        }
        submit.disabled = true;
        label.textContent = 'Sending…';
        fetch('/submit', { method: 'POST', headers: { 'Accept': 'application/json' }, body: new FormData(form) })
          .then(function (r) { return r.json(); })
          .then(function (d) {
            note.textContent = d.message || (d.ok ? 'Thanks!' : 'Something went wrong.');
            note.classList.add(d.ok ? 'ok' : 'err');
            if (d.ok) { form.reset(); setTimeout(close, 2200); }
            else { submit.disabled = false; label.textContent = resetLabel; }
          })
          .catch(function () {
            note.textContent = 'Network error, please try again.';
            note.classList.add('err');
            submit.disabled = false;
            label.textContent = resetLabel;
          });
      });
    }
  }
})();
