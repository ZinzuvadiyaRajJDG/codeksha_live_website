/*!
 * Codeksha cookie consent banner (bottom-left).
 * Choices are stored in the `ck_consent` cookie so the server-side tracker
 * reads them too:  "all" = analytics on,  "essential" = analytics off.
 */
(function () {
  var COOKIE = 'ck_consent';

  function getCookie(n) {
    return document.cookie.split('; ').reduce(function (r, c) {
      var p = c.split('=');
      return p[0] === n ? decodeURIComponent(p[1]) : r;
    }, '');
  }
  function setCookie(n, v, days) {
    var d = new Date();
    d.setTime(d.getTime() + days * 864e5);
    var secure = location.protocol === 'https:' ? ';Secure' : '';
    document.cookie = n + '=' + encodeURIComponent(v) + ';expires=' + d.toUTCString() + ';path=/;SameSite=Lax' + secure;
  }
  function expire(n) {
    document.cookie = n + '=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
  }

  var choice = getCookie(COOKIE);
  try { if (!choice && localStorage.getItem(COOKIE)) choice = localStorage.getItem(COOKIE); } catch (e) {}
  if (choice === 'all' || choice === 'essential') return;

  var css = ''
    + '.ck-cc{position:fixed;left:20px;bottom:20px;z-index:2147483000;width:360px;max-width:calc(100vw - 32px);'
    + 'background:#fff;color:#334155;border:1px solid #e2e8f0;border-radius:18px;'
    + 'box-shadow:0 24px 60px -18px rgba(15,23,42,.35),0 8px 20px -12px rgba(15,23,42,.2);'
    + 'font-family:Urbanist,Inter,system-ui,Segoe UI,sans-serif;padding:20px 20px 18px;'
    + 'transform:translateY(24px);opacity:0;transition:transform .45s cubic-bezier(.16,1,.3,1),opacity .45s}'
    + '.ck-cc.in{transform:none;opacity:1}'
    + '.ck-cc__ic{width:44px;height:44px;border-radius:12px;background:#eff4ff;display:flex;align-items:center;justify-content:center;margin-bottom:12px}'
    + '.ck-cc__ic svg{width:26px;height:26px;color:#2563eb}'
    + '.ck-cc h4{margin:0 0 6px;font-size:16px;font-weight:800;color:#0f172a;font-family:Urbanist,sans-serif}'
    + '.ck-cc p{margin:0 0 15px;font-size:13px;line-height:1.55;color:#64748b}'
    + '.ck-cc p a{color:#2563eb;font-weight:600;text-decoration:none}'
    + '.ck-cc__row{display:flex;gap:10px}'
    + '.ck-cc__row button{flex:1;border:0;border-radius:10px;padding:11px 12px;font:inherit;font-size:13.5px;font-weight:700;cursor:pointer;transition:.15s}'
    + '.ck-cc__acc{background:#2563eb;color:#fff}.ck-cc__acc:hover{background:#1d4ed8}'
    + '.ck-cc__rej{background:#f1f5f9;color:#475569}.ck-cc__rej:hover{background:#e2e8f0}'
    + '@media(max-width:520px){.ck-cc{left:12px;right:12px;bottom:12px;width:auto}}'
    + '@media(prefers-color-scheme:dark){.ck-cc{background:#0f172a;border-color:#1e293b;color:#cbd5e1}'
    + '.ck-cc h4{color:#f8fafc}.ck-cc p{color:#94a3b8}.ck-cc__ic{background:#1e293b}'
    + '.ck-cc__rej{background:#1e293b;color:#cbd5e1}.ck-cc__rej:hover{background:#334155}}';

  var style = document.createElement('style');
  style.textContent = css;
  document.head.appendChild(style);

  var box = document.createElement('div');
  box.className = 'ck-cc';
  box.setAttribute('role', 'dialog');
  box.setAttribute('aria-label', 'Cookie consent');
  box.innerHTML =
    '<div class="ck-cc__ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">'
    + '<path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"/>'
    + '<path d="M8.5 8.5v.01"/><path d="M16 15.5v.01"/><path d="M12 12v.01"/><path d="M11 17v.01"/><path d="M7 14v.01"/></svg></div>'
    + '<h4>Your privacy, your choice</h4>'
    + '<p>We use our own cookies to see how visitors use this site so we can make it better. '
    + 'No third-party or advertising trackers. <a href="/policy/">Learn more</a>.</p>'
    + '<div class="ck-cc__row">'
    + '<button type="button" class="ck-cc__rej" data-v="essential">Reject</button>'
    + '<button type="button" class="ck-cc__acc" data-v="all">Accept all</button>'
    + '</div>';

  function decide(v) {
    setCookie(COOKIE, v, 365);
    try { localStorage.setItem(COOKIE, v); } catch (e) {}
    if (v === 'essential') { expire('ck_vid'); expire('ck_sid'); }
    box.classList.remove('in');
    setTimeout(function () { box.remove(); style.remove(); }, 450);
  }
  box.querySelectorAll('button').forEach(function (b) {
    b.addEventListener('click', function () { decide(b.getAttribute('data-v')); });
  });

  function mount() {
    (document.body || document.documentElement).appendChild(box);
    requestAnimationFrame(function () { requestAnimationFrame(function () { box.classList.add('in'); }); });
  }
  if (document.body) mount();
  else document.addEventListener('DOMContentLoaded', mount);
})();
