/* Codeksha conversion events -> GTM dataLayer.
   generate_lead   successful POST /submit (any form); form_type = contact | demo | popup | enquiry | instructor
   phone_click     tel: links
   whatsapp_click  wa.me / api.whatsapp.com / whatsapp:// links
   email_click     mailto: links
   GTM forwards these to GA4 (see the "GA4 - Conversion events" tag). */
(function () {
  var dl = (window.dataLayer = window.dataLayer || []);
  function push(o) { try { dl.push(o); } catch (e) {} }

  // ---- form submissions: every form posts to /submit via fetch() ----
  if (window.fetch) {
    var orig = window.fetch;
    window.fetch = function (input, init) {
      var p = orig.apply(this, arguments);
      try {
        var url = typeof input === 'string' ? input : (input && input.url) || '';
        var method = ((init && init.method) || (input && input.method) || 'GET').toUpperCase();
        if (method === 'POST' && /\/submit(\?|$)/.test(url)) {
          var body = init && init.body, type = 'contact', course = '';
          if (body && typeof body.get === 'function') {
            type = body.get('form_type') || 'contact';
            course = body.get('course') || '';
          }
          p.then(function (res) {
            return res.clone().json().then(function (d) {
              if (d && d.ok) push({ event: 'generate_lead', form_type: type, lead_course: course, page_path: location.pathname });
            });
          }).catch(function () {});
        }
      } catch (e) {}
      return p;
    };
  }

  // ---- phone / WhatsApp / email clicks ----
  document.addEventListener('click', function (e) {
    var a = e.target && e.target.closest ? e.target.closest('a[href]') : null;
    if (!a) return;
    var href = a.getAttribute('href') || '', name = '';
    if (/^tel:/i.test(href)) name = 'phone_click';
    else if (/^mailto:/i.test(href)) name = 'email_click';
    else if (/^(https?:)?\/\/(wa\.me|api\.whatsapp\.com|web\.whatsapp\.com|chat\.whatsapp\.com)|^whatsapp:/i.test(href)) name = 'whatsapp_click';
    if (name) push({ event: name, link_url: href.replace(/^(tel:|mailto:)/i, ''), page_path: location.pathname });
  }, true);
})();
