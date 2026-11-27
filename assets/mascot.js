/*!
 * Codeksha mascot walker. Markup: inc/partials/mascot-walker.php, styles: .ck-mascot-* in style.css
 *
 * Every limb is posed per frame from a gait cycle (no CSS keyframes), so it walks like a person:
 *  - each foot is planted for 60% of the cycle and slides back at exactly the walking speed,
 *    so it never skates on the ground; the other 40% it lifts and swings forward;
 *  - knees bend when the leg is short (swing), heel lifts at push-off, toe lifts before landing;
 *  - the body is lowest when both feet are down and highest over the standing leg,
 *    leans into the walk and sways over whichever foot carries the weight;
 *  - the free arm swings against its leg, the sign arm sways a little.
 * Hover / keyboard focus: stops and looks at you. Click / tap / Enter: wave -> star jump -> dance ->
 * "book a demo" sign shake (one per click), then it carries on walking.
 */
(function () {
  'use strict';

  var strip = document.querySelector('[data-ck-mascot]');
  if (!strip || strip.getAttribute('data-ck-ready')) return;
  strip.setAttribute('data-ck-ready', '1');

  var walker = strip.querySelector('.ck-mascot-walker');
  var bubble = strip.querySelector('.ck-mascot-bubble');
  var svg = walker && walker.querySelector('svg');
  if (!svg || !bubble) return;

  function part(n) { return svg.querySelector('[data-part="' + n + '"]'); }
  var el = {
    root: part('root'), body: part('body'), legL: part('legL'), legR: part('legR'),
    shoeL: part('shoeL'), shoeR: part('shoeR'), armL: part('armL'), signArm: part('signArm'),
    sign: part('sign'), eyes: part('eyes'), pupils: part('pupils'), mouth: part('mouth'),
    brows: part('brows'), shadow: svg.querySelector('.ck-mascot-shadow')
  };

  var armPath = el.armL.querySelector('path'), armHand = el.armL.querySelector('circle');

  var mq = window.matchMedia ? window.matchMedia('(prefers-reduced-motion: reduce)') : null;
  function reduced() { return !!(mq && mq.matches); }

  /* ---------- rig constants (SVG user units, viewBox 0 -30 190 154) ---------- */
  var VB_W = 190;
  var HIP_X = 60, HIP_HALF = 8, HIP_Y = 90;     // hips at 52 / 68
  var ANKLE_Y = 112, LEG_LEN = 25;              // standing leg is 22 long -> slight knee
  var STRIDE = 26, LIFT = 7, CYCLE = 0.95, STANCE = 0.6;
  var SPEED = STRIDE / (STANCE * CYCLE);        // units/s: planted foot moves back exactly this fast
  var TAU = Math.PI * 2;

  var KEYS = ['bob', 'rot', 'jy', 'sx', 'sy', 'fLx', 'fLy', 'fLt', 'fRx', 'fRy', 'fRt',
              'armL', 'sign', 'px', 'py', 'mouth', 'brow', 'knee'];

  function basePose() {
    return { bob: 0, rot: 0, jy: 0, sx: 1, sy: 1, fLx: -1, fLy: 0, fLt: 0, fRx: 1, fRy: 0, fRt: 0,
             armL: 0, sign: 0, px: 0, py: 1, mouth: 0, brow: 0, knee: 0.5 };
  }

  /* one foot over a gait cycle p in [0,1): x relative to its hip (negative = ahead, we walk left) */
  function foot(p) {
    if (p < STANCE) {                                   // planted: linear, so no sliding
      return { x: -STRIDE / 2 + STRIDE * (p / STANCE), y: 0, t: 0 };
    }
    var s = (p - STANCE) / (1 - STANCE), e = s * s * (3 - 2 * s);
    return {
      x: STRIDE / 2 - STRIDE * e,
      y: -LIFT * Math.sin(Math.PI * s),
      t: -12 * Math.sin(TAU * s)                        // heel up at push-off, toe up before landing
    };
  }

  function walkPose(p) {
    var o = basePose(), a = foot(p), b = foot((p + 0.5) % 1);
    o.fLx = a.x; o.fLy = a.y; o.fLt = a.t;
    o.fRx = b.x; o.fRy = b.y; o.fRt = b.t;
    o.bob = -2.4 * (0.5 + 0.5 * Math.cos(2 * TAU * (p - 0.3)));  // high over the standing leg
    o.rot = -2 - 2 * Math.sin(TAU * (p - 0.05));                  // lean in + sway over weight
    o.armL = 4 - 18 * Math.cos(TAU * p);                          // opposite to the same-side leg
    o.sign = 3 * Math.cos(TAU * p);
    o.px = -4.5; o.py = 1;                                        // looks where it is going
    o.knee = 1;
    return o;
  }

  function idlePose(t) {
    var o = basePose(), br = 0.5 + 0.5 * Math.sin(TAU * t / 1.8);
    o.bob = -0.9 * br;
    o.armL = 3 * br;
    o.sign = -1 * br;
    return o;
  }

  /* ---------- click actions ---------- */
  var ACTIONS = [
    {
      name: 'wave', dur: 2.4, linger: 1.2,
      msg: 'Hi there! 👋 Welcome to <b>Codeksha</b>',
      pose: function (t) {
        var o = idlePose(t);
        o.armL = 88 + 14 * Math.sin(TAU * 2.4 * t);       // hand up beside the head, waving
        o.rot = 4 * Math.sin(TAU * 0.6 * t);
        o.mouth = 0.6; o.brow = -1.5; o.py = 0;
        return o;
      }
    },
    {
      name: 'jump', dur: 1.6, linger: 1.2,
      msg: 'Let’s build something awesome! 🚀',
      pose: function (t) {
        var o = idlePose(t), u, v;
        o.mouth = 1; o.brow = -2; o.py = 0;
        if (t < 0.28) {                                   // crouch
          u = t / 0.28;
          o.sy = 1 - 0.13 * u; o.sx = 1 + 0.08 * u; o.armL = -28; o.sign = 4; o.bob = 0;
          o.fLx = -3; o.fRx = 3; o.mouth = 0.4;
        } else if (t < 0.9) {                             // star jump
          u = (t - 0.28) / 0.62;
          o.jy = -38 * Math.sin(Math.PI * u);
          o.sy = 1.06; o.sx = 0.96;
          o.armL = 95; o.sign = -12;
          o.fLx = -9; o.fRx = 9; o.fLy = -3; o.fRy = -3; o.fLt = -10; o.fRt = 10;
        } else if (t < 1.12) {                            // land
          v = (t - 0.9) / 0.22;
          o.sy = 1 - 0.13 * Math.sin(Math.PI * v); o.sx = 1 + 0.08 * Math.sin(Math.PI * v);
          o.armL = 35; o.fLx = -3; o.fRx = 3;
        } else {
          o.armL = 20;
        }
        return o;
      }
    },
    {
      name: 'dance', dur: 2.6, linger: 1.2,
      msg: 'Learning to code is more fun together 🎶',
      pose: function (t) {
        var o = idlePose(t), w = TAU * t / 0.65, s = Math.sin(w);
        o.rot = 9 * s;
        o.bob = -2.5 * Math.abs(s);
        o.fLx = -3; o.fRx = 3;
        o.fLy = -6 * Math.max(0, s); o.fRy = -6 * Math.max(0, -s);   // lift the unweighted foot
        o.fLt = -8 * Math.max(0, s); o.fRt = 8 * Math.max(0, -s);
        o.armL = 60 + 35 * Math.sin(2 * w);
        o.sign = 7 * Math.sin(w + 0.6);
        o.px = 3 * s; o.py = 0; o.mouth = 1; o.brow = -1;
        return o;
      }
    },
    {
      name: 'sign', dur: 3.2, linger: 4,
      msg: 'Want a free demo class? <a href="/book-demo/">Book now →</a>',
      pose: function (t) {
        var o = idlePose(t);
        o.sign = -10 + 4 * Math.sin(TAU * 3 * t);          // lift the board and shake it
        o.jy = -5 * Math.abs(Math.sin(TAU * 1.5 * t));
        o.armL = 78 + 20 * Math.sin(TAU * 2 * t);
        o.px = 3; o.py = -2; o.mouth = 0.8; o.brow = -1.5;
        return o;
      }
    }
  ];

  /* ---------- state ---------- */
  var st = {
    x: null, phase: 0, t: 0, mode: '', modeT: 0,
    hover: false, focus: false,
    action: null, actT: 0, next: 0,
    blinkAt: 2 + Math.random() * 3, blinkT: -1,
    bubbleOn: false, bubbleHideAt: Infinity, bubbleTrackUntil: 0, overBubble: false,
    hinted: false, extMin: 16, extMax: 179, extTop: -26
  };
  var pose = basePose();
  var stripW = 0, walkerW = 0, walkerH = 0, k = 1, bw = 0, bh = 0;

  function measure() {
    stripW = strip.clientWidth;
    walkerW = walker.offsetWidth;
    walkerH = walker.offsetHeight;
    k = walkerW / VB_W;
    if (st.x === null) st.x = stripW * 0.72;           // visible straight away on load
    if (reduced()) st.x = Math.max(0, stripW - walkerW - stripW * 0.06);
    else if (st.x > stripW + 20) st.x = stripW;
    if (st.bubbleOn) { bw = bubble.offsetWidth; bh = bubble.offsetHeight; }
  }

  /* ---------- speech bubble ---------- */
  function showBubble(html, hideAt) {
    bubble.innerHTML = html;
    bubble.classList.add('is-on');
    st.bubbleOn = true;
    st.bubbleHideAt = hideAt;
    bw = bubble.offsetWidth; bh = bubble.offsetHeight;
    placeBubble();
  }
  function hideBubble() {
    bubble.classList.remove('is-on');
    st.bubbleOn = false;
    st.bubbleHideAt = Infinity;
    st.bubbleTrackUntil = st.t + 0.3;                  // keep following while it fades
  }
  function placeBubble() {
    var gap = 6, x = st.x;
    var bodyLeft = x + st.extMin * k;                  // real extents of the current pose
    var signRight = x + st.extMax * k;
    var side, left, bottom, tail;
    if (bodyLeft - gap - bw >= 4) {
      side = 'left'; left = bodyLeft - gap - bw; bottom = walkerH * 0.42;
    } else if (signRight + gap + bw <= stripW - 4) {
      side = 'right'; left = signRight + gap; bottom = walkerH * 0.5;
    } else {
      side = 'top';
      left = Math.min(Math.max(x + walkerW * 0.32 - bw / 2, 4), Math.max(4, stripW - bw - 4));
      bottom = walkerH + 8 + Math.max(0, -30 - st.extTop) * k;
    }
    tail = Math.min(Math.max(x + walkerW * 0.32 - left, 16), bw - 16);
    bubble.setAttribute('data-side', side);
    bubble.style.bottom = bottom.toFixed(1) + 'px';
    bubble.style.transform = 'translate3d(' + left.toFixed(1) + 'px,0,0)';
    bubble.style.setProperty('--tail-x', tail.toFixed(1) + 'px');
  }

  /* ---------- render ---------- */
  function n(v) { return Math.round(v * 100) / 100; }

  function legPath(hx, hy, ax, ay, knee) {
    var dx = ax - hx, dy = ay - hy, d = Math.sqrt(dx * dx + dy * dy) || 1;
    var slack = Math.max(0, LEG_LEN - d) * 1.15 * knee;
    var mx = (hx + ax) / 2 + (-dy / d) * slack;        // knee bends forward (walking direction)
    var my = (hy + ay) / 2 + (dx / d) * slack;
    return 'M' + n(hx) + ' ' + n(hy) + 'Q' + n(mx) + ' ' + n(my) + ' ' + n(ax) + ' ' + n(ay);
  }

  function turn(x, y, deg, cx, cy) {
    var a = deg * Math.PI / 180, c = Math.cos(a), s = Math.sin(a);
    return [cx + (x - cx) * c - (y - cy) * s, cy + (x - cx) * s + (y - cy) * c];
  }
  var BOARD = [[70, -26], [176, -26], [70, 20], [176, 20]];

  /* how far the current pose reaches left / right / up (SVG units), so the bubble never covers it */
  function extents(p, handX, handY) {
    var minX = 1e9, maxX = -1e9, top = 1e9, pts = [[16, 56], [handX - 7, handY]], i, q;
    for (i = 0; i < BOARD.length; i++) pts.push(turn(BOARD[i][0], BOARD[i][1], p.sign, 84, 66));
    for (i = 0; i < pts.length; i++) {
      q = turn(pts[i][0], pts[i][1] + p.bob, p.rot, 60, 90 + p.bob);
      var x = 60 + (q[0] - 60) * p.sx, y = 121.5 + (q[1] - 121.5) * p.sy + p.jy;
      if (x < minX) minX = x;
      if (x > maxX) maxX = x;
      if (y < top) top = y;
    }
    st.extMin = minX; st.extMax = maxX + 3; st.extTop = top;
  }

  function render(blink) {
    var p = pose, r = p.rot * Math.PI / 180, c = Math.cos(r), s = Math.sin(r);
    var hy = HIP_Y + p.bob;
    var hLx = HIP_X - HIP_HALF * c, hLy = hy - HIP_HALF * s;
    var hRx = HIP_X + HIP_HALF * c, hRy = hy + HIP_HALF * s;
    var aLx = 52 + p.fLx, aLy = ANKLE_Y + p.fLy;
    var aRx = 68 + p.fRx, aRy = ANKLE_Y + p.fRy;

    el.root.setAttribute('transform',
      'translate(0 ' + n(p.jy) + ') translate(60 121.5) scale(' + n(p.sx) + ' ' + n(p.sy) + ') translate(-60 -121.5)');
    el.body.setAttribute('transform', 'translate(0 ' + n(p.bob) + ') rotate(' + n(p.rot) + ' 60 90)');
    el.legL.setAttribute('d', legPath(hLx, hLy, aLx, aLy, p.knee));
    el.legR.setAttribute('d', legPath(hRx, hRy, aRx, aRy, p.knee));
    el.shoeL.setAttribute('transform', 'translate(' + n(aLx) + ' ' + n(aLy) + ') rotate(' + n(p.fLt) + ' 0 6)');
    el.shoeR.setAttribute('transform', 'translate(' + n(aRx) + ' ' + n(aRy) + ') rotate(' + n(p.fRt) + ' 0 6)');
    // free arm: aimed by angle, stretches when raised so the hand clears the body
    var th = p.armL * Math.PI / 180, ct = Math.cos(th), stt = Math.sin(th);
    var len = 21.2 * (1 + 0.9 * Math.min(1, Math.max(0, (p.armL - 15) / 55)));
    var hx = 38 + len * 0.7071 * (-ct - stt), hy2 = 66 + len * 0.7071 * (ct - stt);
    armPath.setAttribute('d', 'M38 66L' + n(hx) + ' ' + n(hy2));
    armHand.setAttribute('cx', n(hx));
    armHand.setAttribute('cy', n(hy2));
    extents(p, hx, hy2);
    var sg = 'rotate(' + n(p.sign) + ' 84 66)';
    el.signArm.setAttribute('transform', sg);
    el.sign.setAttribute('transform', sg);
    el.pupils.setAttribute('transform', 'translate(' + n(p.px) + ' ' + n(p.py) + ')');
    el.eyes.setAttribute('transform', 'translate(0 50) scale(1 ' + n(blink) + ') translate(0 -50)');
    el.mouth.setAttribute('transform',
      'translate(61 62) scale(' + n(1 + 0.15 * p.mouth) + ' ' + n(1 + 0.45 * p.mouth) + ') translate(-61 -62)');
    el.brows.setAttribute('transform', 'translate(0 ' + n(p.brow) + ')');
    var sh = Math.max(0.45, 1 + p.jy / 70);
    el.shadow.setAttribute('transform', 'translate(60 122) scale(' + n(sh) + ' 1) translate(-60 -122)');
    el.shadow.setAttribute('opacity', n(0.14 * sh));

    walker.style.transform = 'translate3d(' + st.x.toFixed(1) + 'px,0,0)';
  }

  /* ---------- loop ---------- */
  var running = false, last = 0, onScreen = true;

  function frame(now) {
    if (!running) return;
    var dt = Math.min(0.05, Math.max(0, (now - last) / 1000));
    last = now;
    st.t += dt;

    var mode = st.action ? 'act' : ((st.hover || st.focus || reduced()) ? 'idle' : 'walk');
    if (mode !== st.mode) {
      if (mode === 'walk') st.phase = 0;               // start from double support
      st.mode = mode; st.modeT = 0;
    }
    st.modeT += dt;

    var target;
    if (mode === 'act') {
      st.actT += dt;
      target = (reduced() ? ACTIONS[0] : st.action).pose(st.actT);
      if (st.actT >= st.action.dur) {
        st.bubbleHideAt = st.t + st.action.linger;
        st.action = null;
      }
    } else if (mode === 'idle') {
      target = idlePose(st.t);
    } else {
      st.phase = (st.phase + dt / CYCLE) % 1;
      st.x -= SPEED * k * dt;
      if (st.x < -walkerW - 10) st.x = stripW + 10;    // walked off the left, come back on the right
      target = walkPose(st.phase);
    }

    // ease into new poses; once walking has settled, follow the gait exactly (keeps feet planted)
    var a = (mode === 'walk' && st.modeT > 0.35) ? 1 : 1 - Math.exp(-dt * 16);
    for (var i = 0; i < KEYS.length; i++) {
      var key = KEYS[i];
      pose[key] += (target[key] - pose[key]) * a;
    }

    // blink every few seconds
    var blink = 1;
    if (st.blinkT < 0 && st.t >= st.blinkAt) st.blinkT = 0;
    if (st.blinkT >= 0) {
      st.blinkT += dt;
      var bt = st.blinkT;
      blink = bt < 0.07 ? 1 - 0.9 * (bt / 0.07) : (bt < 0.14 ? 0.1 + 0.9 * ((bt - 0.07) / 0.07) : 1);
      if (bt >= 0.14) { st.blinkT = -1; st.blinkAt = st.t + 2.5 + Math.random() * 3.5; }
    }

    // one-time "click me" hint so touch users discover it
    if (!st.hinted && st.t > 6 && !st.action && !st.bubbleOn) {
      st.hinted = true;
      var seen = false;
      try { seen = sessionStorage.getItem('ckMascotHint') === '1'; sessionStorage.setItem('ckMascotHint', '1'); } catch (e) {}
      if (!seen) showBubble('Psst… click me! 👆', st.t + 3);
    }

    if (st.bubbleOn && st.t >= st.bubbleHideAt && !st.overBubble && !bubble.contains(document.activeElement)) {
      hideBubble();
    }

    render(blink);
    if (st.bubbleOn || st.t < st.bubbleTrackUntil) placeBubble();
    requestAnimationFrame(frame);
  }

  function start() {
    if (running || !onScreen || document.hidden) return;
    running = true;
    last = performance.now();
    requestAnimationFrame(frame);
  }
  function stop() { running = false; }

  /* ---------- events ---------- */
  walker.addEventListener('click', function () {
    if (st.action) return;
    var A = ACTIONS[st.next % ACTIONS.length];
    st.next++;
    st.action = A; st.actT = 0;
    st.hinted = true;
    showBubble(A.msg, Infinity);
    start();
  });
  walker.addEventListener('pointerenter', function (e) { if (e.pointerType === 'mouse') st.hover = true; });
  walker.addEventListener('pointerleave', function () { st.hover = false; });
  walker.addEventListener('focus', function () {
    var fv = true;
    try { fv = walker.matches(':focus-visible'); } catch (e) {}
    st.focus = fv;                                      // keyboard users can stop it to read / press it
  });
  walker.addEventListener('blur', function () { st.focus = false; });
  bubble.addEventListener('pointerenter', function () { st.overBubble = true; });
  bubble.addEventListener('pointerleave', function () { st.overBubble = false; });

  var resizeQueued = false;
  window.addEventListener('resize', function () {
    if (resizeQueued) return;
    resizeQueued = true;
    requestAnimationFrame(function () { resizeQueued = false; measure(); });
  });
  if (mq) {
    var onMq = function () { measure(); };
    if (mq.addEventListener) mq.addEventListener('change', onMq); else if (mq.addListener) mq.addListener(onMq);
  }
  document.addEventListener('visibilitychange', function () { if (document.hidden) stop(); else start(); });
  if ('IntersectionObserver' in window) {
    new IntersectionObserver(function (entries) {
      onScreen = entries[0].isIntersecting;
      if (onScreen) start(); else stop();
    }, { rootMargin: '100px' }).observe(strip);
  }

  strip.classList.add('is-ready');
  measure();
  render(1);
  start();
})();
