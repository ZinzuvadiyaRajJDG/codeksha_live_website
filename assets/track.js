/*!
 * Codeksha first-party tracker (beacon side).
 * The server already logged this page view; this script enriches it with
 * screen size, engaged time, scroll depth and interaction events.
 */
(function () {
  var CK = window.__CK;
  if (!CK || !CK.sid) return;
  // respect an explicit "reject" from the cookie banner
  if (/(^|;\s*)ck_consent=essential(;|$)/.test(document.cookie)) return;

  var endpoint = CK.ep || '/track/collect.php';

  function send(obj) {
    obj.sid = CK.sid; obj.vid = CK.vid; obj.pvid = CK.pvid;
    var body = JSON.stringify(obj);
    try {
      if (navigator.sendBeacon) {
        navigator.sendBeacon(endpoint, new Blob([body], { type: 'text/plain' }));
        return;
      }
    } catch (e) {}
    try {
      fetch(endpoint, { method: 'POST', body: body, keepalive: true, headers: { 'Content-Type': 'text/plain' } });
    } catch (e) {}
  }

  /* ---- 1. enrich: screen + viewport ---------------------------------- */
  send({
    t: 'enrich',
    sw: screen.width, sh: screen.height,
    vw: window.innerWidth, vh: window.innerHeight,
    title: document.title
  });

  /* ---- 2. engaged time + scroll depth ------------------------------- */
  var start = Date.now();
  var engaged = 0;
  var lastTick = start;
  var maxScroll = 0;
  var active = true;

  function measureScroll() {
    var doc = document.documentElement;
    var full = doc.scrollHeight - window.innerHeight;
    var pct = full > 0 ? Math.round((window.scrollY / full) * 100) : 100;
    if (pct > maxScroll) maxScroll = Math.min(100, pct);
  }
  window.addEventListener('scroll', measureScroll, { passive: true });
  measureScroll();

  function tick() {
    var now = Date.now();
    if (active && !document.hidden) engaged += (now - lastTick) / 1000;
    lastTick = now;
  }
  setInterval(tick, 1000);

  ['mousemove', 'keydown', 'touchstart', 'click', 'scroll'].forEach(function (ev) {
    window.addEventListener(ev, function () { active = true; }, { passive: true });
  });
  var idleTimer;
  ['mousemove', 'keydown', 'touchstart', 'scroll'].forEach(function (ev) {
    window.addEventListener(ev, function () {
      clearTimeout(idleTimer);
      idleTimer = setTimeout(function () { active = false; }, 30000);
    }, { passive: true });
  });

  var scrollMilestones = { 25: 0, 50: 0, 75: 0, 100: 0 };
  setInterval(function () {
    Object.keys(scrollMilestones).forEach(function (m) {
      if (!scrollMilestones[m] && maxScroll >= m) {
        scrollMilestones[m] = 1;
        send({ t: 'event', type: 'scroll_milestone', label: m + '%', path: location.pathname });
      }
    });
  }, 2000);

  function flush() {
    tick();
    send({ t: 'pv_update', top: Math.round(engaged), scr: maxScroll });
  }
  document.addEventListener('visibilitychange', function () { if (document.hidden) flush(); });
  window.addEventListener('pagehide', flush);
  window.addEventListener('beforeunload', flush);
  setInterval(flush, 15000); // periodic, survives crashes / long sessions

  /* ---- 3. interaction events --------------------------------------- */
  var ctaWords = /enroll|book|demo|apply|get started|contact|call|whatsapp|download|view course|view detail|see the full/i;

  function describe(el) {
    var t = (el.innerText || el.textContent || '').trim().replace(/\s+/g, ' ').slice(0, 120);
    if (!t && el.getAttribute('aria-label')) t = el.getAttribute('aria-label');
    return t;
  }

  document.addEventListener('click', function (e) {
    var a = e.target.closest && e.target.closest('a, button');
    if (!a) return;
    var label = describe(a);
    var href = a.getAttribute('href') || '';
    var type = 'click';
    var detail = href;

    if (a.tagName === 'A' && href) {
      if (/^tel:/i.test(href)) type = 'tel';
      else if (/^mailto:/i.test(href)) type = 'mailto';
      else if (/^https?:\/\//i.test(href) && href.indexOf(location.host) === -1) type = 'outbound';
      else if (/\.(pdf|zip|docx?|xlsx?|pptx?)($|\?)/i.test(href)) type = 'download';
    }
    if (type === 'click' && ctaWords.test(label)) type = 'cta';

    send({ t: 'event', type: type, label: label, detail: detail, path: location.pathname });
  }, true);

  /* ---- 4. form start / abandon / submit ---------------------------- */
  document.querySelectorAll('form').forEach(function (form) {
    var started = false, submitted = false, lastField = '';
    form.addEventListener('focusin', function (e) {
      if (e.target.name) lastField = e.target.name;
      if (!started) {
        started = true;
        send({ t: 'event', type: 'form_start', label: form.id || 'form', path: location.pathname });
      }
    });
    form.addEventListener('submit', function () {
      submitted = true;
      send({ t: 'event', type: 'form_submit', label: form.id || 'form', path: location.pathname });
    });
    window.addEventListener('pagehide', function () {
      if (started && !submitted) {
        send({ t: 'event', type: 'form_abandon', label: form.id || 'form', detail: 'last field: ' + lastField, path: location.pathname });
      }
    });
  });
})();
