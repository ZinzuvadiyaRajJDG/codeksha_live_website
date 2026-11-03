/* Codeksha Diwali popup: opens once after the configured delay, and stays away for the
   configured number of hours once the visitor dismisses it (or clicks one of its CTAs). */
(function () {
  'use strict';

  var root = document.getElementById('dwPopup');
  if (!root || root.getAttribute('data-dw-init')) return;   // never initialise twice
  root.setAttribute('data-dw-init', '1');

  var card = root.querySelector('.dw-popup-card');
  var closeBtn = document.getElementById('dwPopupClose');
  var laterBtn = document.getElementById('dwPopupLater');
  var delayMs = (parseFloat(root.getAttribute('data-delay')) || 10) * 1000;
  var windowMs = (parseFloat(root.getAttribute('data-hours')) || 24) * 3600 * 1000;
  var key = root.getAttribute('data-key') || 'ck_diwali_popup_dismissed';

  var dismissedThisPage = false;   // also covers browsers where storage is unavailable
  var isOpen = false;
  var lastFocus = null;
  var prevOverflow = '';
  var inerted = [];

  function readStamp() {
    try {
      var v = window.localStorage.getItem(key);
      var n = v ? parseInt(v, 10) : NaN;
      return isFinite(n) ? n : null;
    } catch (e) { return null; }
  }

  function writeStamp() {
    dismissedThisPage = true;
    try { window.localStorage.setItem(key, String(Date.now())); } catch (e) { /* storage unavailable */ }
  }

  function suppressed() {
    if (dismissedThisPage) return true;
    var t = readStamp();
    if (t === null) return false;
    var age = Date.now() - t;
    return age >= 0 && age < windowMs;   // a timestamp in the future (clock change) is ignored
  }

  function focusables() {
    var nodes = card.querySelectorAll('a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])');
    return Array.prototype.filter.call(nodes, function (el) { return el.offsetParent !== null; });
  }

  function onKeydown(e) {
    if (e.key === 'Escape' || e.key === 'Esc') {
      e.preventDefault();
      close(true);
      return;
    }
    if (e.key !== 'Tab') return;
    var f = focusables();
    if (!f.length) { e.preventDefault(); return; }
    var first = f[0], last = f[f.length - 1];
    if (e.shiftKey && (document.activeElement === first || document.activeElement === card)) {
      e.preventDefault(); last.focus();
    } else if (!e.shiftKey && document.activeElement === last) {
      e.preventDefault(); first.focus();
    }
  }

  function setBackgroundInert(on) {
    if (on) {
      Array.prototype.forEach.call(document.body.children, function (el) {
        if (el === root || el.tagName === 'SCRIPT' || el.tagName === 'NOSCRIPT') return;
        if ('inert' in el && !el.inert) { el.inert = true; inerted.push(el); }
      });
    } else {
      inerted.forEach(function (el) { el.inert = false; });
      inerted = [];
    }
  }

  function open() {
    if (isOpen || suppressed()) return;
    isOpen = true;
    lastFocus = document.activeElement;
    root.hidden = false;
    prevOverflow = document.body.style.overflow;
    document.body.style.overflow = 'hidden';
    document.body.classList.add('dw-popup-open');
    setBackgroundInert(true);
    document.addEventListener('keydown', onKeydown, true);
    window.requestAnimationFrame(function () { root.classList.add('is-open'); });
    (closeBtn || card).focus();
  }

  // record = true when the visitor made an explicit choice (close, Maybe later, Escape, backdrop)
  function close(record) {
    if (!isOpen) return;
    isOpen = false;
    if (record) writeStamp();
    document.removeEventListener('keydown', onKeydown, true);
    root.classList.remove('is-open');
    root.hidden = true;
    document.body.style.overflow = prevOverflow;
    document.body.classList.remove('dw-popup-open');
    setBackgroundInert(false);
    if (lastFocus && document.contains(lastFocus) && typeof lastFocus.focus === 'function') {
      try { lastFocus.focus(); } catch (e) { /* ignore */ }
    }
  }

  closeBtn.addEventListener('click', function () { close(true); });
  if (laterBtn) laterBtn.addEventListener('click', function () { close(true); });
  root.addEventListener('mousedown', function (e) { if (e.target === root) close(true); });
  Array.prototype.forEach.call(root.querySelectorAll('[data-dw-cta]'), function (a) {
    a.addEventListener('click', function () { writeStamp(); });   // clicking a CTA is an explicit choice too
  });

  function schedule() {
    if (suppressed()) return;
    window.setTimeout(open, delayMs);
  }
  if (document.readyState === 'complete') schedule();
  else window.addEventListener('load', schedule, { once: true });
})();
