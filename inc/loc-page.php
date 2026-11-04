<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($desc) ?>">
<meta name="robots" content="<?= $indexable ? 'index, follow' : 'noindex, follow' ?>">
<link rel="canonical" href="<?= e($BASE . $path) ?>">
<link rel="icon" type="image/png" href="/Images/fevicon.png">
<link rel="apple-touch-icon" href="/Images/fevicon.png">
<meta property="og:type" content="website"><meta property="og:site_name" content="Codeksha">
<meta property="og:title" content="<?= e($title) ?>"><meta property="og:description" content="<?= e($desc) ?>">
<meta property="og:url" content="<?= e($BASE . $path) ?>"><meta property="og:image" content="<?= e($BASE) ?>/Images/Codeksha-Logo.png"><meta property="og:locale" content="en_IN">
<meta name="twitter:card" content="summary_large_image"><meta name="twitter:title" content="<?= e($title) ?>"><meta name="twitter:description" content="<?= e($desc) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&family=JetBrains+Mono:wght@500;700&display=swap">
<link rel="stylesheet" href="/assets/loc/styles.css?v=1">

<?php foreach ($ldBlocks as $ld): ?>
<script type="application/ld+json"><?= json_encode($ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php endforeach; ?>
<!-- Microsoft Clarity (same tag as the rest of the site) -->
<script type="text/javascript">(function(c,l,a,r,i,t,y){c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);})(window,document,"clarity","script","yelup4ouat");</script>
</head>
<body>
<header class="top" id="top">
  <div class="wrap">
    <nav class="nav" aria-label="Main">
      <a href="/" class="logo" aria-label="Codeksha home"><img src="/assets/loc/img/codeksha-logo.png" alt="Codeksha" width="102" height="40"></a>
      <ul class="nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="/about-us/">About</a></li>
        <li><a href="#courses">Courses</a></li>
        <li><a href="#categories">Categories</a></li>
        <li><a href="#mentors">Mentors</a></li>
        <li><a href="#stories">Reviews</a></li>
        <li><a href="#faq">FAQs</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
      <div class="nav-cta">
        <a href="#contact" class="btn btn-blue">Book a Free Demo <span class="arr">→</span></a>
        <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false" aria-controls="mobileMenu"><span></span></button>
      </div>
    </nav>
    <div class="mobile-menu" id="mobileMenu" hidden>
      <ul>
        <li><a href="/">Home <span>→</span></a></li>
        <li><a href="/about-us/">About <span>→</span></a></li>
        <li><a href="#courses">Courses <span>→</span></a></li>
        <li><a href="#categories">Categories <span>→</span></a></li>
        <li><a href="#mentors">Mentors <span>→</span></a></li>
        <li><a href="#stories">Reviews <span>→</span></a></li>
        <li><a href="#faq">FAQs <span>→</span></a></li>
        <li><a href="#contact">Contact <span>→</span></a></li>
      </ul>
      <a href="#contact" class="btn btn-blue">Book a Free Demo <span class="arr">→</span></a>
    </div>
  </div>
</header>

<main>
<!-- ============ 02 HERO ============ -->
<section class="hero" id="home">
  <div class="wrap hero-grid">
    <div class="hero-copy">
      <span class="hero-badge"><b><?= e(strtoupper($T)) ?> STUDENTS</b> Taught by developers with 5+ years of IT experience</span>
      <h1 style="font-size:clamp(2.5rem,5.4vw,4.7rem)"><?= e($H1_LEAD) ?> for Students from <span class="pill"><?= e($T) ?></span> at Codeksha <span class="scribble">Rajkot.<svg viewBox="0 0 300 20" preserveAspectRatio="none" aria-hidden="true"><path d="M2 14 C 60 2, 120 2, 160 10 S 250 18, 298 6" fill="none" stroke="#1766FF" stroke-width="5" stroke-linecap="round"/></svg></span></h1>
      <p class="hero-sub"><?= e($HERO_SUB) ?></p>
      <div class="hero-ctas">
        <a href="#contact" class="btn btn-blue">Book a Free Demo <span class="arr">→</span></a>
        <a href="#courses" class="btn btn-line">Explore Courses</a>
      </div>
      <div class="proof">
        <div class="stars" aria-label="Rated 4.85 out of 5">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.9 7.5.7-5.7 5 1.7 7.4L12 18.3 5.5 22l1.7-7.4L1.5 9.6 9 8.9z"/></svg><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.9 7.5.7-5.7 5 1.7 7.4L12 18.3 5.5 22l1.7-7.4L1.5 9.6 9 8.9z"/></svg><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.9 7.5.7-5.7 5 1.7 7.4L12 18.3 5.5 22l1.7-7.4L1.5 9.6 9 8.9z"/></svg><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.9 7.5.7-5.7 5 1.7 7.4L12 18.3 5.5 22l1.7-7.4L1.5 9.6 9 8.9z"/></svg><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.9 7.5.7-5.7 5 1.7 7.4L12 18.3 5.5 22l1.7-7.4L1.5 9.6 9 8.9z"/></svg>
        </div>
        <p class="proof-txt"><b>4.85</b> rating · <b>10,000+</b> students trained</p>
      </div>
      <div class="chips" aria-label="What you'll learn">
        <span class="chip">HTML/CSS</span><span class="chip">JavaScript</span><span class="chip">PHP</span><span class="chip">Laravel</span><span class="chip">WordPress</span><span class="chip">APIs</span><span class="chip">SEO</span><span class="chip">AI tools</span>
      </div>
    </div>

    <div class="hero-visual">
      <div class="hero-panel">
        <span class="bigtag" aria-hidden="true">&lt;/&gt;</span>
        <img class="person" src="/assets/loc/img/student-thumbs-up.webp" alt="Smiling Codeksha student giving two thumbs up" width="1536" height="1024" fetchpriority="high">
      </div>
      <div class="float f1">
        <div class="row"><span>Developer mode</span><span>100%</span></div>
        <div class="meter"><i></i></div>
        <small>Skill fuel: live projects loaded</small>
      </div>
      <div class="float f2" aria-hidden="true">
        <div><span class="p">~/my-first-app $</span> git push</div>
        <div>✓ build passed</div>
        <div><span class="ok">deployed</span> live project</div>
      </div>
      <div class="float f3"><span class="dot"></span> Live class · Rajkot centre</div>
    </div>
  </div>
</section>

<div class="ticker-zone" aria-hidden="true">
  <div class="ticker"><div class="track">
    <span>Full Stack Web Development</span><span>Frontend Development</span><span>Backend Development</span><span>Laravel</span><span>WordPress Development</span><span>Digital Marketing &amp; SEO</span><span>AI &amp; Automation</span>
    <span>Full Stack Web Development</span><span>Frontend Development</span><span>Backend Development</span><span>Laravel</span><span>WordPress Development</span><span>Digital Marketing &amp; SEO</span><span>AI &amp; Automation</span>
  </div></div>
  <div class="ticker alt"><div class="track">
    <span>Learn by doing</span><span>Small classes</span><span>Live projects</span><span>No entrance exam</span><span>Certificate on completion</span><span>Beginner friendly</span>
    <span>Learn by doing</span><span>Small classes</span><span>Live projects</span><span>No entrance exam</span><span>Certificate on completion</span><span>Beginner friendly</span>
  </div></div>
</div>

<!-- ============ 03 LOCATION FACTS ============ -->
<section class="section" id="location" style="padding-top:clamp(48px,7vw,88px)">
  <div class="wrap">
    <div class="stats-head reveal">
      <span class="eyebrow">Students from <?= e($T) ?></span>
      <h2 class="h-sec">Start your IT career at <em>Codeksha</em>.</h2>
      <p class="lede">Our training centre is at <?= e($ADDRESS) ?>. <?= e($ucf($SHARED)) ?> means live, project-based courses there, taught by developers with 5+ years of IT experience.</p>
    </div>
    <div class="stats reveal">
      <div class="stat"><span class="mono">// since day one</span><div class="stat-num"><span data-count="10">10</span><sup>+</sup></div><p class="stat-lab">Years of experience training developers</p></div>
      <div class="stat"><span class="mono">// and counting</span><div class="stat-num"><span data-count="10000" data-fmt="k">10,000</span><sup>+</sup></div><p class="stat-lab">Students trained at Codeksha</p></div>
      <div class="stat"><span class="mono">// out of 5</span><div class="stat-num"><span data-count="4.85" data-dec="2">4.85</span><sup>★</sup></div><p class="stat-lab">Average rating from our learners</p></div>
      <div class="stat certified"><span class="mono">// on completion</span>
        <div class="seal" aria-hidden="true"><svg viewBox="0 0 100 100"><defs><path id="circ" d="M50,50 m-38,0 a38,38 0 1,1 76,0 a38,38 0 1,1 -76,0"/></defs><g class="ring"><text font-family="JetBrains Mono, monospace" font-size="9.5" font-weight="700" fill="#7fa9ff" letter-spacing="2.2"><textPath href="#circ">CODEKSHA · SKILL · CERTIFIED · </textPath></text></g><circle cx="50" cy="50" r="24" fill="#1766FF"/><path d="M39 50l7 7 15-15" fill="none" stroke="#fff" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <p class="stat-lab"><b style="color:#fff;font-family:var(--f-display);font-size:1.4rem;display:block;line-height:1.1">Codeksha Skill Certified</b>A certificate when you complete your course</p></div>
    </div>
  </div>
</section>

<!-- ============ 04 TRUST ============ -->
<section style="padding-bottom:clamp(72px,10vw,128px)">
  <div class="wrap">
    <div class="trust reveal">
      <div>
        <span class="eyebrow" style="color:#7fa9ff">Why students from <?= e($T) ?> trust us</span>
        <h2 style="margin-top:16px">Real developers. Real code. <em>Real</em> projects.</h2>
        <p class="lede">Codeksha is an IT training centre in Rajkot, not another video library. Learning at Codeksha means learning from developers with 5+ years of experience in the IT sector, who build software for clients.</p>
        <ul class="trust-list">
          <li>Taught by developers with 5+ years of IT experience</li>
          <li>Live project in every course</li>
          <li>Small classes, personal attention</li>
          <li>No entrance exam needed</li>
          <li>Demo class for selected courses</li>
          <li>Installments on selected courses</li>
        </ul>
      </div>
      <div class="coupon">
        <span class="eyebrow">First purchase offer</span>
        <div class="big">10<span>%</span> off</div>
        <p style="color:var(--ink-soft)">Use this code on your first course enrolment.</p>
        <div class="code-row"><code id="coupon">CK-10OFF</code><button type="button" id="copyBtn">Copy code</button></div>
        <small>Ask at the centre for current batch dates.</small>
      </div>
    </div>
  </div>
</section>

<!-- ============ 04b BEST INSTITUTE ============ -->
<section class="section" id="why-codeksha" style="padding-top:0">
  <div class="wrap">
    <div class="cat-wrap reveal" style="background:var(--paper)">
      <span class="eyebrow">Best IT training institute for <?= e($T) ?> students</span>
      <h2 class="h-sec" style="margin-top:16px">Why choose Codeksha for <em>practical IT training</em>?</h2>
      <div class="cat-panel" style="margin-top:32px">
        <div class="cat-copy">
          <h3>Learn from real developers</h3>
          <p><?= e(ucfirst($PRIMARY)) ?> at Codeksha is built around one idea: you learn from developers who work in the IT sector every day, and you build real projects while you learn.</p>
          <ul class="cat-list"><li>Trainers with 5+ years in IT <span>Real developers</span></li><li>Live project in every course <span>Real work</span></li><li>Beginner friendly <span>No entrance exam</span></li><li>Flexible batch timings <span>Student friendly</span></li><li>Certificate on completion <span>Skill Certified</span></li></ul>
        </div>
        <div class="terminal"><div class="term-bar"><i></i><i></i><i></i><span>codeksha-lab — your path</span></div>
          <div class="term-body"><span class="c"># from first class to first project</span><span><span class="k">choose</span> → your course</span><span><span class="k">learn</span> → from real developers</span><span><span class="k">build</span> → <span class="s">live project</span></span><span><span class="k">certificate</span> → skill certified</span><span>career: starting<span class="caret"></span></span></div></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ 05 COURSES ============ -->
<section class="section" id="courses" style="background:var(--blue-mist);border-radius:var(--r-xl) var(--r-xl) 0 0">
  <div class="wrap">
    <div class="sec-head reveal">
      <div>
        <span class="eyebrow">Explore our most in-demand courses</span>
        <h2 class="h-sec">IT courses available for <em><?= e($T) ?></em> students.</h2>
        <p class="lede"><?= e($LEDE_COURSES) ?></p>
      </div>
      <div class="car-nav">
        <button class="car-btn" id="cPrev" aria-label="Previous courses"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M15 5l-7 7 7 7"/></svg></button>
        <button class="car-btn is-fill" id="cNext" aria-label="Next courses"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M9 5l7 7-7 7"/></svg></button>
      </div>
    </div>
    <div class="cf-chips" role="toolbar" aria-label="Filter courses by category">
      <button type="button" class="cf-chip on" data-f="all" aria-pressed="true">All courses <b>15</b></button>
      <button type="button" class="cf-chip" data-f="web" aria-pressed="false">Web Development <b>5</b></button>
      <button type="button" class="cf-chip" data-f="dm" aria-pressed="false">Digital Marketing <b>4</b></button>
      <button type="button" class="cf-chip" data-f="cms" aria-pressed="false">CMS &amp; Builders <b>1</b></button>
      <button type="button" class="cf-chip" data-f="ai" aria-pressed="false">AI &amp; Automation <b>3</b></button>
      <button type="button" class="cf-chip" data-f="design" aria-pressed="false">Design <b>2</b></button>
    </div>
  </div>
  <div class="rail-shell">
    <div class="rail" id="courseRail" tabindex="0" aria-label="All Codeksha courses, scroll horizontally">
      <article class="course" data-cat="web">
        <figure class="c-media"><img src="/assets/loc/img/track-fullstack.jpg" alt="Codeksha Full Stack Development 3D avatar" width="666" height="450" loading="eager" decoding="async"><span class="c-flag">Flagship</span></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">Web Development</span><span class="c-num">01/15</span></div>
          <h3>Full Stack Web Development</h3>
          <p class="c-desc">Build complete web applications, from the frontend to the backend.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>30 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5M16 4.8a3.5 3.5 0 010 6.4M18 14.8c1.8.7 3 2.4 3.5 5.2"/></svg>271 students</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/full-stack-web-development/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
      <article class="course" data-cat="web">
        <figure class="c-media"><img src="/assets/loc/img/track-frontend.jpg" alt="Codeksha Frontend Design 3D avatar" width="666" height="450" loading="eager" decoding="async"><span class="c-flag">Flagship</span></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">Web Development</span><span class="c-num">02/15</span></div>
          <h3>Frontend Development</h3>
          <p class="c-desc">Create modern, responsive and interactive websites.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>30 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5M16 4.8a3.5 3.5 0 010 6.4M18 14.8c1.8.7 3 2.4 3.5 5.2"/></svg>273 students</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/frontend-development/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
      <article class="course" data-cat="web">
        <figure class="c-media"><img src="/assets/loc/img/track-frontend.jpg" alt="Codeksha Frontend Design 3D avatar" width="666" height="450" loading="eager" decoding="async"></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">Web Development</span><span class="c-num">03/15</span></div>
          <h3>JavaScript</h3>
          <p class="c-desc">Core JS, DOM manipulation, ES6+, async programming and API calls.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>16 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5M16 4.8a3.5 3.5 0 010 6.4M18 14.8c1.8.7 3 2.4 3.5 5.2"/></svg>63 students</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/javascript/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
      <article class="course" data-cat="web">
        <figure class="c-media"><img src="/assets/loc/img/track-backend.jpg" alt="Codeksha Backend Development 3D avatar" width="666" height="450" loading="eager" decoding="async"><span class="c-flag">Flagship</span></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">Web Development</span><span class="c-num">04/15</span></div>
          <h3>Backend Development</h3>
          <p class="c-desc">Server-side development, databases, APIs and application logic.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>30 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5M16 4.8a3.5 3.5 0 010 6.4M18 14.8c1.8.7 3 2.4 3.5 5.2"/></svg>274 students</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/backend-development/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
      <article class="course" data-cat="web">
        <figure class="c-media"><img src="/assets/loc/img/track-backend.jpg" alt="Codeksha Backend Development 3D avatar" width="666" height="450" loading="lazy" decoding="async"></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">Web Development</span><span class="c-num">05/15</span></div>
          <h3>MongoDB</h3>
          <p class="c-desc">NoSQL database design, CRUD operations and aggregation pipelines.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>12 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5M16 4.8a3.5 3.5 0 010 6.4M18 14.8c1.8.7 3 2.4 3.5 5.2"/></svg>34 students</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/mongodb/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
      <article class="course" data-cat="dm">
        <figure class="c-media"><img src="/assets/loc/img/track-marketing.jpg" alt="Codeksha Digital Marketing 3D avatar" width="666" height="450" loading="lazy" decoding="async"><span class="c-flag">Flagship</span></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">Digital Marketing</span><span class="c-num">06/15</span></div>
          <h3>Digital Marketing &amp; SEO</h3>
          <p class="c-desc">SEO, digital marketing, content, analytics and online growth strategies.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>30 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5M16 4.8a3.5 3.5 0 010 6.4M18 14.8c1.8.7 3 2.4 3.5 5.2"/></svg>273 students</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/digital-marketing-seo/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
      <article class="course" data-cat="dm">
        <figure class="c-media"><img src="/assets/loc/img/track-marketing.jpg" alt="Codeksha Digital Marketing 3D avatar" width="666" height="450" loading="lazy" decoding="async"></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">Digital Marketing</span><span class="c-num">07/15</span></div>
          <h3>Google Ads</h3>
          <p class="c-desc">Plan and optimise Search, Display and Performance Max campaigns.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>12 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5M16 4.8a3.5 3.5 0 010 6.4M18 14.8c1.8.7 3 2.4 3.5 5.2"/></svg>47 students</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/google-ads/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
      <article class="course" data-cat="dm">
        <figure class="c-media"><img src="/assets/loc/img/track-marketing.jpg" alt="Codeksha Digital Marketing 3D avatar" width="666" height="450" loading="lazy" decoding="async"></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">Digital Marketing</span><span class="c-num">08/15</span></div>
          <h3>SEO</h3>
          <p class="c-desc">On-page, technical and off-page SEO for higher Google rankings.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>12 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5M16 4.8a3.5 3.5 0 010 6.4M18 14.8c1.8.7 3 2.4 3.5 5.2"/></svg>52 students</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/seo/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
      <article class="course" data-cat="dm">
        <figure class="c-media"><img src="/assets/loc/img/track-marketing.jpg" alt="Codeksha Digital Marketing 3D avatar" width="666" height="450" loading="lazy" decoding="async"></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">Digital Marketing</span><span class="c-num">09/15</span></div>
          <h3>Social Media Marketing</h3>
          <p class="c-desc">Paid and organic campaigns across social platforms.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>12 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5M16 4.8a3.5 3.5 0 010 6.4M18 14.8c1.8.7 3 2.4 3.5 5.2"/></svg>39 students</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/social-media-marketing/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
      <article class="course" data-cat="cms">
        <figure class="c-media"><img src="/assets/loc/img/track-wordpress.jpg" alt="Codeksha WordPress & CMS Tools 3D avatar" width="666" height="450" loading="lazy" decoding="async"><span class="c-flag">Flagship</span></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">CMS &amp; Builders</span><span class="c-num">10/15</span></div>
          <h3>WordPress Development</h3>
          <p class="c-desc">Build professional websites with WordPress and modern development.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>30 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5M16 4.8a3.5 3.5 0 010 6.4M18 14.8c1.8.7 3 2.4 3.5 5.2"/></svg>273 students</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/wordpress-development/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
      <article class="course" data-cat="ai">
        <figure class="c-media"><img src="/assets/loc/img/track-ai.webp" alt="Codeksha AI & Automation 3D avatar" width="1526" height="1030" loading="lazy" decoding="async"><span class="c-flag">Flagship</span></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">AI &amp; Automation</span><span class="c-num">11/15</span></div>
          <h3>AI &amp; Automation</h3>
          <p class="c-desc">How AI tools and automation improve modern business workflows.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>30 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5M16 4.8a3.5 3.5 0 010 6.4M18 14.8c1.8.7 3 2.4 3.5 5.2"/></svg>64 students</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/ai-automation/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
      <article class="course" data-cat="ai">
        <figure class="c-media"><img src="/assets/loc/img/track-ai.webp" alt="Codeksha AI & Automation 3D avatar" width="1526" height="1030" loading="lazy" decoding="async"></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">AI &amp; Automation</span><span class="c-num">12/15</span></div>
          <h3>Prompt Engineering</h3>
          <p class="c-desc">Write effective prompts for ChatGPT, Claude and Gemini.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>12 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5M16 4.8a3.5 3.5 0 010 6.4M18 14.8c1.8.7 3 2.4 3.5 5.2"/></svg>58 students</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/prompt-engineering/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
      <article class="course" data-cat="ai">
        <figure class="c-media"><img src="/assets/loc/img/track-ai.webp" alt="Codeksha AI & Automation 3D avatar" width="1526" height="1030" loading="lazy" decoding="async"></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">AI &amp; Automation</span><span class="c-num">13/15</span></div>
          <h3>n8n Automation</h3>
          <p class="c-desc">No-code workflows that connect your apps and remove manual work.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>12 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.5 3.4-5.5 6.5-5.5s5.7 2 6.5 5.5M16 4.8a3.5 3.5 0 010 6.4M18 14.8c1.8.7 3 2.4 3.5 5.2"/></svg>41 students</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/n8n-automation/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
      <article class="course" data-cat="design">
        <figure class="c-media"><img src="/assets/loc/img/track-frontend.jpg" alt="Codeksha Frontend Design 3D avatar" width="666" height="450" loading="lazy" decoding="async"></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">Design</span><span class="c-num">14/15</span></div>
          <h3>UI/UX Design</h3>
          <p class="c-desc">User research, wireframes, Figma prototyping and design systems.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>24 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>12 weeks</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/ui-ux-design/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
      <article class="course" data-cat="design">
        <figure class="c-media"><img src="/assets/loc/img/track-frontend.jpg" alt="Codeksha Frontend Design 3D avatar" width="666" height="450" loading="lazy" decoding="async"></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat">Design</span><span class="c-num">15/15</span></div>
          <h3>Graphic Design</h3>
          <p class="c-desc">Photoshop, Illustrator, CorelDRAW and Canva, with branding and print projects.</p>
          <div class="c-meta"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M8 9h8M8 13h5"/></svg>24 lessons</span><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>12 weeks</span><span class="lvl">Beginner · Live class</span></div>
          <a href="/course/graphic-design/" class="btn btn-dark c-btn">View Details <span class="arr">→</span></a>
        </div>
      </article>
    </div>
  </div>
  <div class="wrap">
    <div class="rail-foot">
      <span class="mono" id="railCount">Showing 15 courses</span>
      <div class="scrub" id="scrub" role="scrollbar" aria-controls="courseRail" aria-orientation="horizontal" aria-label="Course scrollbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" tabindex="0"><i id="railBar"></i></div>
      <span class="mono rail-hint">Drag, swipe or use ← →</span>
    </div>
  </div>
</section>

<!-- ============ 06 CATEGORIES ============ -->
<section class="section" id="categories" style="background:var(--blue-mist);padding-top:0">
  <div class="wrap">
    <div class="cat-wrap reveal" style="background:var(--paper)">
      <span class="eyebrow">Course categories</span>
      <h2 class="h-sec" style="margin-top:16px">Choose your <em>path</em>.</h2>
      <div class="cat-tabs" role="tablist" aria-label="Course categories">
        <button class="cat-tab" role="tab" id="tab-web" aria-controls="p-web" aria-selected="true"><span class="n">01</span>Web Development</button>
        <button class="cat-tab" role="tab" id="tab-cms" aria-controls="p-cms" aria-selected="false" tabindex="-1"><span class="n">02</span>CMS &amp; Builders</button>
        <button class="cat-tab" role="tab" id="tab-dm" aria-controls="p-dm" aria-selected="false" tabindex="-1"><span class="n">03</span>Digital Marketing</button>
        <button class="cat-tab" role="tab" id="tab-ai" aria-controls="p-ai" aria-selected="false" tabindex="-1"><span class="n">04</span>AI &amp; Automation</button>
        <button class="cat-tab" role="tab" id="tab-ds" aria-controls="p-ds" aria-selected="false" tabindex="-1"><span class="n">05</span>Design</button>
      </div>

      <div class="cat-panel" role="tabpanel" id="p-web" aria-labelledby="tab-web">
        <div class="cat-copy">
          <h3>Web Development and Full Stack Training</h3>
          <p><?= e($PANEL_WEB) ?></p>
          <ul class="cat-list"><li>Full Stack Web Development <span>271 students</span></li><li>Frontend Development <span>273 students</span></li><li>Backend Development <span>274 students</span></li><li>Laravel <span>PHP web apps</span></li></ul>
        </div>
        <div class="terminal"><div class="term-bar"><i></i><i></i><i></i><span>codeksha-lab — web</span></div>
          <div class="term-body"><span class="c"># your path, step by step</span><span><span class="k">html</span> → <span class="k">css</span> → <span class="k">javascript</span></span><span><span class="k">php</span> → <span class="k">laravel</span> → <span class="k">mysql</span></span><span><span class="k">rest api</span> → <span class="s">live project</span></span><span class="c"># status</span><span>job-ready skills: compiling<span class="caret"></span></span></div></div>
      </div>
      <div class="cat-panel" role="tabpanel" id="p-cms" aria-labelledby="tab-cms" hidden>
        <div class="cat-copy">
          <h3>CMS &amp; Builders</h3>
          <p>Build professional websites businesses can manage themselves. Customise themes, set up WooCommerce stores, and ship real client-style sites.</p>
          <ul class="cat-list"><li>WordPress Development <span>273 students</span></li><li>Theme customization <span>WordPress</span></li><li>WooCommerce setup <span>Online stores</span></li></ul>
        </div>
        <div class="terminal"><div class="term-bar"><i></i><i></i><i></i><span>codeksha-lab — cms</span></div>
          <div class="term-body"><span class="c"># build a site a client can actually use</span><span><span class="k">wordpress</span> install → theme setup</span><span><span class="k">customize</span> → pages, menus, forms</span><span><span class="k">woocommerce</span> → <span class="s">products live</span></span><span>handover ready<span class="caret"></span></span></div></div>
      </div>
      <div class="cat-panel" role="tabpanel" id="p-dm" aria-labelledby="tab-dm" hidden>
        <div class="cat-copy">
          <h3>Digital Marketing and SEO Training</h3>
          <p><?= e($PANEL_DM) ?></p>
          <ul class="cat-list"><li>Digital Marketing &amp; SEO <span>273 students</span></li><li>Content &amp; analytics <span>Growth strategy</span></li></ul>
        </div>
        <div class="terminal"><div class="term-bar"><i></i><i></i><i></i><span>codeksha-lab — growth</span></div>
          <div class="term-body"><span class="c"># from page one to page one</span><span><span class="k">keyword research</span> → on-page seo</span><span><span class="k">content</span> → <span class="k">analytics</span></span><span><span class="k">report</span> → <span class="s">growth plan</span></span><span>ranking<span class="caret"></span></span></div></div>
      </div>
      <div class="cat-panel" role="tabpanel" id="p-ai" aria-labelledby="tab-ai" hidden>
        <div class="cat-copy">
          <h3>AI &amp; Automation</h3>
          <p>See how AI tools and automation improve modern business workflows, and learn to put them to work on repetitive tasks.</p>
          <ul class="cat-list"><li>AI &amp; Automation <span>64 students</span></li><li>Workflow automation <span>Business use</span></li></ul>
        </div>
        <div class="terminal"><div class="term-bar"><i></i><i></i><i></i><span>codeksha-lab — ai</span></div>
          <div class="term-body"><span class="c"># let the machine do the busywork</span><span><span class="k">ai tools</span> → prompts that work</span><span><span class="k">automation</span> → connected workflows</span><span><span class="s">hours saved</span></span><span>automating<span class="caret"></span></span></div></div>
      </div>
      <div class="cat-panel" role="tabpanel" id="p-ds" aria-labelledby="tab-ds" hidden>
        <div class="cat-copy">
          <h3>Design</h3>
          <p>Interfaces people enjoy using. Learn layout, responsiveness and interaction as part of building modern, responsive websites.</p>
          <ul class="cat-list"><li>Frontend Design <span>Responsive UI</span></li><li>Frontend Development <span>273 students</span></li></ul>
        </div>
        <div class="terminal"><div class="term-bar"><i></i><i></i><i></i><span>codeksha-lab — design</span></div>
          <div class="term-body"><span class="c"># pixels with a purpose</span><span><span class="k">layout</span> → <span class="k">typography</span></span><span><span class="k">responsive</span> → mobile first</span><span><span class="k">interaction</span> → <span class="s">polished UI</span></span><span>rendering<span class="caret"></span></span></div></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ 06b CURRICULUM ============ -->
<section class="section" id="curriculum" style="padding-top:0">
  <div class="wrap faq">
    <div class="faq-side">
      <div>
        <span class="eyebrow">Course curriculum</span>
        <h2 class="h-sec" style="margin-top:16px"><?= $CUR_H2 ?></h2>
      </div>
      <div class="faq-help"><b><?= e($CUR['weeks']) ?> weeks · <?= e($CUR['lessons']) ?> lessons · Beginner</b><span>Live, instructor-led sessions with flexible, student-friendly batch timings and a certificate of completion. <?= e($HELP_LINE) ?></span></div>
    </div>
    <div class="acc" id="accCurriculum">
      <?php foreach ($CUR['steps'] as $i => $st):
          $parts = explode(':', $st[1], 2);
          if (count($parts) === 2) { $head = trim($parts[0]); $body = trim($parts[1]); }
          else { $head = trim(explode(',', $st[1])[0]); $body = trim($st[1]); }
          $label = trim($st[0] . ' · ' . $head, ' ·'); ?>
      <details<?= $i === 0 ? ' open' : '' ?>><summary><?= e($label) ?><span class="pm" aria-hidden="true"></span></summary><p class="ans"><?= e(rtrim(ucfirst($body), '.')) ?>.</p></details>
      <?php endforeach; ?>
      <details><summary>Who can join?<span class="pm" aria-hidden="true"></span></summary><p class="ans">Who it is for: <?= e(implode('; ', $CUR['who'])) ?>. What you need: <?= e(implode('; ', $CUR['req'])) ?>.</p></details>
    </div>
  </div>
</section>

<!-- ============ 07 WHY ============ -->
<section class="section">
  <div class="wrap why">
    <div class="why-visual reveal">
      <img class="person" src="/assets/loc/img/student-ok.webp" alt="Codeksha student making an OK sign" width="1536" height="1024" loading="lazy">
      <div class="float why-badge"><b>Skills: compiled</b><span>0 errors · 0 warnings</span></div>
    </div>
    <div class="why-copy">
      <span class="eyebrow">Why choose Codeksha</span>
      <h2 class="h-sec">Your brain on <em>Codeksha</em>.</h2>
      <p class="lede">Flip the switch and compare. The difference is who teaches you and what you build.</p>
      <div class="toggle on" id="whyToggle" role="group" aria-label="Compare">
        <span class="knob" aria-hidden="true"></span>
        <button type="button" aria-pressed="false" data-v="other">Typical coaching</button>
        <button type="button" aria-pressed="true" data-v="us">Codeksha</button>
      </div>
      <ul class="why-list is-us" id="whyList" aria-live="polite"></ul>
    </div>
  </div>
</section>

<!-- ============ 08 HOW ============ -->
<section class="section" style="padding-top:0">
  <div class="wrap how">
    <div class="how-stick">
      <span class="eyebrow">How it works</span>
      <h2 class="h-sec">How students from <?= e($T) ?> can attend <em>classes in Rajkot</em>.</h2>
      <div class="how-img"><img src="/assets/loc/img/student-pointing.webp" alt="Student pointing toward the learning steps" width="1536" height="1024" loading="lazy"></div>
    </div>
    <ol class="steps">
      <li class="step reveal"><span class="lv">01</span><div class="step-card"><span class="mono">Level 1</span><h3>Choose your course</h3><p>Talk to our team, visit the centre, or try a demo class. We help you pick the track that fits your goal.</p></div></li>
      <li class="step reveal"><span class="lv">02</span><div class="step-card"><span class="mono">Level 2</span><h3>Visit the centre</h3><p>Ask our team for the current batch timings, then pick a day to visit our Rajkot centre or book a free demo class. You can meet the trainers and see a class before you enrol.</p></div></li>
      <li class="step reveal"><span class="lv">03</span><div class="step-card"><span class="mono">Level 3</span><h3>Learn from working developers</h3><p>Your trainers are developers with 5+ years of experience in the IT sector. They write code for real clients, and every course includes live project assignments. You learn how things are done in the industry, not just in the textbook.</p></div></li>
      <li class="step reveal"><span class="lv">04</span><div class="step-card"><span class="mono">Level 4</span><h3>Build practical skills</h3><p>Learn by doing, in small classes with personal attention, until the skills stick.</p></div></li>
      <li class="step boss reveal"><span class="lv">05</span><div class="step-card"><span class="mono">Boss level</span><h3>Prepare for your IT career</h3><p>Finish with a certificate, a portfolio of real work, and the confidence to step into the industry.</p></div></li>
    </ol>
  </div>
</section>

<!-- ============ 09 MENTORS ============ -->
<section class="section dark" id="mentors" style="border-radius:var(--r-xl)">
  <div class="wrap">
    <div class="sec-head reveal">
      <div>
        <span class="eyebrow">Meet the mentors</span>
        <h2 class="h-sec">The developers behind the <em style="color:#7fa9ff">whiteboard</em>.</h2>
        <p class="lede">Our trainers are developers with 5+ years of experience in the IT sector who still work on client projects. Each track is led by someone who does that work every day.</p>
      </div>
      <a href="#contact" class="btn btn-white">Meet them at the centre <span class="arr">→</span></a>
    </div>
    <div class="m-grid reveal" aria-label="Course track mentors">
      <figure class="m-tile"><img src="/assets/loc/img/track-fullstack.jpg" alt="Codeksha Full Stack Development mentor avatar" width="666" height="450" loading="eager" decoding="async"><figcaption><span class="mono">// track</span>Full Stack Development</figcaption></figure>
      <figure class="m-tile"><img src="/assets/loc/img/track-frontend.jpg" alt="Codeksha Frontend Design mentor avatar" width="666" height="450" loading="eager" decoding="async"><figcaption><span class="mono">// track</span>Frontend Design</figcaption></figure>
      <figure class="m-tile"><img src="/assets/loc/img/track-backend.jpg" alt="Codeksha Backend Development mentor avatar" width="666" height="450" loading="eager" decoding="async"><figcaption><span class="mono">// track</span>Backend Development</figcaption></figure>
      <figure class="m-tile"><img src="/assets/loc/img/track-marketing.jpg" alt="Codeksha Digital Marketing mentor avatar" width="666" height="450" loading="eager" decoding="async"><figcaption><span class="mono">// track</span>Digital Marketing</figcaption></figure>
      <figure class="m-tile"><img src="/assets/loc/img/track-wordpress.jpg" alt="Codeksha WordPress & CMS Tools mentor avatar" width="666" height="450" loading="eager" decoding="async"><figcaption><span class="mono">// track</span>WordPress &amp; CMS Tools</figcaption></figure>
      <figure class="m-tile"><img src="/assets/loc/img/track-ai.webp" alt="Codeksha AI & Automation mentor avatar" width="1526" height="1030" loading="eager" decoding="async"><figcaption><span class="mono">// track</span>AI &amp; Automation</figcaption></figure>
    </div>
    <div class="mentor-cap"><span>// Full Stack · Frontend · Backend · Digital Marketing · WordPress · AI</span><span>Want to speak to an instructor first? Visit the centre.</span></div>
    <div class="mentor-facts">
      <div class="flip"><div class="flip-in">
        <div class="face front"><span class="mono">// who</span><h3>Developer-turned-teachers</h3><span class="hint">Hover or tap to flip</span></div>
        <div class="face back"><span class="mono">// superpower</span><p>They teach from experience on live client work, so the examples in class are the problems you will meet on the job.</p></div>
      </div><button type="button" aria-label="Flip card: Developer-turned-teachers"></button></div>
      <div class="flip"><div class="flip-in">
        <div class="face front"><span class="mono">// how</span><h3>Learning by doing</h3><span class="hint">Hover or tap to flip</span></div>
        <div class="face back"><span class="mono">// superpower</span><p>Real projects and case studies replace long lectures. You write code in every session.</p></div>
      </div><button type="button" aria-label="Flip card: Learning by doing"></button></div>
      <div class="flip"><div class="flip-in">
        <div class="face front"><span class="mono">// where</span><h3>Small classes in Rajkot</h3><span class="hint">Hover or tap to flip</span></div>
        <div class="face back"><span class="mono">// superpower</span><p>Small batches mean personal attention. Ask questions, get unstuck, and keep moving.</p></div>
      </div><button type="button" aria-label="Flip card: Small classes in Rajkot"></button></div>
    </div>
  </div>
</section>

<!-- ============ 10 TESTIMONIALS ============ -->
<section class="section" id="stories">
  <div class="wrap">
    <div class="sec-head reveal">
      <div>
        <span class="eyebrow">Students say</span>
        <h2 class="h-sec">From “zero confidence” to <em>real projects</em>.</h2>
      </div>
    </div>
    <div class="t-grid">
      <aside class="score reveal">
        <div>
          <div class="stars" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.9 7.5.7-5.7 5 1.7 7.4L12 18.3 5.5 22l1.7-7.4L1.5 9.6 9 8.9z"/></svg><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.9 7.5.7-5.7 5 1.7 7.4L12 18.3 5.5 22l1.7-7.4L1.5 9.6 9 8.9z"/></svg><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.9 7.5.7-5.7 5 1.7 7.4L12 18.3 5.5 22l1.7-7.4L1.5 9.6 9 8.9z"/></svg><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.9 7.5.7-5.7 5 1.7 7.4L12 18.3 5.5 22l1.7-7.4L1.5 9.6 9 8.9z"/></svg><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.9 7.5.7-5.7 5 1.7 7.4L12 18.3 5.5 22l1.7-7.4L1.5 9.6 9 8.9z"/></svg></div>
          <div class="n" style="margin-top:14px">4.85</div>
          <p>Overall rating from 10,000+ students trained.</p>
        </div>
        <div class="faces"><img src="/assets/loc/img/harmi.webp" alt="" width="60" height="60"><img src="/assets/loc/img/mathan.webp" alt="" width="60" height="60"><img src="/assets/loc/img/nensi.webp" alt="" width="60" height="60"><img src="/assets/loc/img/shivraj.webp" alt="" width="60" height="60"><img src="/assets/loc/img/foram.webp" alt="" width="60" height="60"></div>
      </aside>
      <div style="min-width:0">
        <div class="t-rail" id="tRail" tabindex="0" aria-label="Student testimonials">
          <figure class="tcard" style="margin:0"><blockquote>Codeksha is a great place to grow. The team is supportive and the leadership genuinely values the effort students put in.</blockquote><figcaption class="who"><img src="/assets/loc/img/harmi.webp" alt="Harmi" width="60" height="60"><div><b>Harmi</b><small>Backend Trainee @ Codeksha</small></div></figcaption></figure>
          <figure class="tcard" style="margin:0"><blockquote>A supportive, politics-free environment. I got hands-on exposure to APIs, databases and server-side logic during my backend training.</blockquote><figcaption class="who"><img src="/assets/loc/img/mathan.webp" alt="Mathan" width="60" height="60"><div><b>Mathan</b><small>Backend Trainee</small></div></figcaption></figure>
          <figure class="tcard" style="margin:0"><blockquote>One of the leading institutes in Rajkot for real-world IT exposure. Continuous learning here turns into practical experience.</blockquote><figcaption class="who"><img src="/assets/loc/img/nensi.webp" alt="Nensi Patel" width="60" height="60"><div><b>Nensi Patel</b><small>Frontend Engineer @ IT Industry</small></div></figcaption></figure>
          <figure class="tcard" style="margin:0"><blockquote>The curriculum is focused on real-world skills, which gives students the tools they need to succeed in today’s tech industry.</blockquote><figcaption class="who"><img src="/assets/loc/img/shivraj.webp" alt="Shivraj Vala" width="60" height="60"><div><b>Shivraj Vala</b><small>Backend Developer @ IT Solutions</small></div></figcaption></figure>
          <figure class="tcard" style="margin:0"><blockquote>I started with zero confidence. With the support and exposure at Codeksha, I ended up building real projects.</blockquote><figcaption class="who"><img src="/assets/loc/img/foram.webp" alt="Foram Joshi" width="60" height="60"><div><b>Foram Joshi</b><small>Full Stack Developer</small></div></figcaption></figure>
        </div>
        <div class="t-ctrl">
          <div class="dots" id="tDots"></div>
          <div class="car-nav">
            <button class="car-btn" id="tPrev" aria-label="Previous testimonial"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M15 5l-7 7 7 7"/></svg></button>
            <button class="car-btn" id="tNext" aria-label="Next testimonial"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M9 5l7 7-7 7"/></svg></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if ($nearbyLinks !== ''): ?>
<!-- ============ 10a NEARBY TOWNS ============ -->
<section class="section" id="nearby" style="padding-top:0">
  <div class="wrap">
    <div class="sec-head reveal"><div><span class="eyebrow">More from Codeksha</span><h2 class="h-sec">Students from <em>nearby towns</em>.</h2></div></div>
    <div class="chips"><?= $nearbyLinks ?></div>
  </div>
</section>
<?php endif; ?>

<!-- ============ 10b VISIT ============ -->
<section class="section" id="visit" style="padding-top:0">
  <div class="wrap">
    <div class="cat-wrap reveal" style="background:var(--paper)">
      <span class="eyebrow">Visit Codeksha</span>
      <h2 class="h-sec" style="margin-top:16px">Meet the team at our <em>Rajkot</em> centre.</h2>
      <div class="cat-panel" style="margin-top:32px">
        <div class="cat-copy">
          <h3>Codeksha, Rajkot</h3>
          <p><b><?= e($ADDRESS) ?></b></p>
          <p>Visit the centre, meet the trainers and see a class before you enrol. Students from <?= e($T) ?> are always welcome. <?= e($VISIT_LINE) ?></p>
          <ul class="cat-list"><li>Phone <span>+91 63555 59016</span></li><li>Email <span>info@codeksha.com</span></li><li>Hours <span>Mon–Sat, 8 AM – 7 PM</span></li></ul>
          <div class="panel-actions"><a href="https://www.google.com/maps/search/?api=1&amp;query=22.3177299,70.7642141" target="_blank" rel="noopener" class="btn btn-blue">Get directions <span class="arr">→</span></a><a href="tel:+916355559016" class="btn btn-line">Call us</a></div>
        </div>
        <div class="terminal"><div class="term-bar"><i></i><i></i><i></i><span>codeksha-lab — find us</span></div>
          <div class="term-body"><span class="c"># where to find us</span><span><span class="k">city</span> → Rajkot, Gujarat</span><span><span class="k">near</span> → Sheetal Park</span><span><span class="k">road</span> → 150 Feet Ring Rd</span><span><span class="k">building</span> → <span class="s">RK Iconic, A-1110</span></span><span>see you soon<span class="caret"></span></span></div></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ 11 FAQ ============ -->
<section class="section" id="faq" style="padding-top:0">
  <div class="wrap faq">
    <div class="faq-side">
      <div>
        <span class="eyebrow">FAQs</span>
        <h2 class="h-sec" style="margin-top:16px">Questions? We’ve got <em>answers</em>.</h2>
      </div>
      <div class="faq-img"><img src="/assets/loc/img/student-thinking.webp" alt="Student thinking with hand on chin" width="1024" height="1536" loading="lazy"></div>
      <div class="faq-help"><b>Still deciding?</b><span>Our team helps you choose a course before you enrol. Mon–Sat, 8 AM to 7 PM.</span></div>
    </div>
    <div class="acc" id="acc">
      <?php foreach ($faqs as $i => $f): ?>
      <details<?= $i === 0 ? ' open' : '' ?>><summary><?= e($f[0]) ?><span class="pm" aria-hidden="true"></span></summary><p class="ans"><?= e($f[1]) ?></p></details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 11b CONSULTATION FORM ============ -->
<section class="section" id="consult" style="padding-top:0">
  <div class="wrap">
    <div class="consult reveal">
      <div class="consult-copy">
        <span class="eyebrow">Book a free consultation</span>
        <h2 class="h-sec">Talk to our team about <em>your course</em>.</h2>
        <p class="lede">Leave your number and a counsellor will call you back about courses, fees, batch timings and a free demo class. <?= e($CONSULT_LINE) ?></p>
        <div class="tool-chips"><span class="chip">Free demo class</span><span class="chip">Course fees</span><span class="chip">Batch timings</span><span class="chip">Syllabus</span></div>
      </div>
      <form class="consult-form" id="consultForm" novalidate>
        <?php $ck_form_type = 'enquiry'; require __DIR__ . '/form-fields.php'; ?>
        <h3>Request a call back</h3>
        <label>Your name *<input type="text" name="name" required maxlength="100" autocomplete="name" placeholder="Your name"></label>
        <label>Mobile number *<input type="tel" name="phone" required inputmode="tel" autocomplete="tel" maxlength="20" minlength="8" placeholder="e.g. +91 98765 43210"></label>
        <label>Course you are interested in<select name="course">
          <option>Full Stack Web Development</option><option>Frontend Development</option><option>Backend Development</option><option>Digital Marketing &amp; SEO</option>
          <option>WordPress Development</option><option>AI &amp; Automation</option><option>UI/UX Design</option><option>Graphic Design</option><option>Not sure yet - help me choose</option>
        </select></label>
        <button type="submit" class="btn btn-blue" id="consultBtn"><span>Call Me Back</span> <span class="arr">→</span></button>
        <p class="fnote" id="consultNote" role="status"></p>
        <p class="fsmall">Or call us now: <a href="tel:+916355559016">+91 63555 59016</a></p>
      </form>
    </div>
  </div>
</section>
<script>
(function(){
  var form=document.getElementById('consultForm'); if(!form) return;
  var note=document.getElementById('consultNote'), btn=document.getElementById('consultBtn'), label=btn.querySelector('span');
  var town=<?= json_encode($T) ?>;
  function phoneError(v){v=(v||'').trim();if(!v)return 'Please enter your mobile number.';var d=v.replace(/\D/g,'');
    if(!/^\+?[0-9\s()\-]{8,20}$/.test(v)||d.length<8||d.length>15)return 'Enter a valid phone number (8-15 digits).';
    if(/^(\d)\1+$/.test(d))return 'That does not look like a real phone number.';
    var nat=d.replace(/^(0091|91|0)/,''),foreign=v.charAt(0)==='+'&&d.indexOf('91')!==0;
    if(!foreign&&nat.length===10&&!/^[6-9]/.test(nat))return 'Indian mobile numbers start with 6, 7, 8 or 9.';return '';}
  function show(m,c){note.textContent=m;note.className='fnote '+c;}
  form.addEventListener('submit',function(e){
    e.preventDefault();
    var name=form.elements['name'].value.trim(), err=phoneError(form.elements['phone'].value);
    if(name.length<2){show('Please enter your name.','err');form.elements['name'].focus();return;}
    if(err){show(err,'err');form.elements['phone'].focus();return;}
    btn.disabled=true; label.textContent='Sending...';
    var fd=new FormData(form); fd.set('course', fd.get('course')+' (student from '+town+')');
    fetch('/submit',{method:'POST',headers:{'Accept':'application/json'},body:fd})
      .then(function(r){return r.json();})
      .then(function(d){show(d.message||(d.ok?'Thanks!':'Something went wrong.'),d.ok?'ok':'err');
        if(d.ok){form.reset();label.textContent='Request Sent';}else{btn.disabled=false;label.textContent='Call Me Back';}})
      .catch(function(){show('Network error. Please try again.','err');btn.disabled=false;label.textContent='Call Me Back';});
  });
})();
</script>

<!-- ============ 12 FINAL CTA ============ -->
<section id="contact">
  <div class="wrap">
    <div class="cta reveal">
      <div class="cta-copy">
        <span class="eyebrow" style="color:#fff">Book a free demo</span>
        <h2>Your Future in Tech Starts <span>Here.</span></h2>
        <p>Learn practical skills, build real projects, and take the next step towards your IT career with Codeksha.</p>
        <div class="cta-ctas">
          <a href="/book-demo/" class="btn btn-white">Book a Free Demo <span class="arr">→</span></a>
          <a href="#courses" class="btn btn-line">Explore Courses</a>
        </div>
        <div class="callrow"><span>Call us <b>+91 63555 59016</b></span><span>Email <b>info@codeksha.com</b></span></div>
      </div>
      <div class="cta-img"><img src="/assets/loc/img/student-call.webp" alt="Student making a call-me gesture" width="1536" height="1024" loading="lazy"></div>
    </div>
  </div>
</section>
</main>

<!-- ============ 13 FOOTER ============ -->
<footer>
  <div class="wrap foot">
    <div class="foot-top">
      <div class="foot-brand">
        <span class="logo-chip"><img src="/assets/loc/img/codeksha-logo.png" alt="Codeksha" width="112" height="44"></span>
        <p>Project-based IT training in Rajkot, taught by developers who work on real client projects.</p>
        <div class="socials">
          <a href="https://www.instagram.com/codeksha_official" target="_blank" rel="noopener" aria-label="Codeksha on Instagram"><svg viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.8.1 3.3.1 4.8 1.7 4.9 4.9.1 1.3.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 3.2-1.7 4.8-4.9 4.9-1.3.1-1.6.1-4.8.1s-3.6 0-4.8-.1c-3.3-.1-4.8-1.7-4.9-4.9C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.8C2.4 3.9 3.9 2.4 7.2 2.3 8.4 2.2 8.8 2.2 12 2.2zm0 4.7a5.1 5.1 0 100 10.2 5.1 5.1 0 000-10.2zm0 8.4a3.3 3.3 0 110-6.6 3.3 3.3 0 010 6.6zm5.3-9.8a1.2 1.2 0 100 2.4 1.2 1.2 0 000-2.4z"/></svg></a>
          <a href="https://www.linkedin.com/company/codeksha/" target="_blank" rel="noopener" aria-label="Codeksha on LinkedIn"><svg viewBox="0 0 24 24"><path d="M4.98 3.5a2.5 2.5 0 11-.01 5 2.5 2.5 0 01.01-5zM3 9h4v12H3zM9 9h3.8v1.7h.1c.5-1 1.8-2 3.8-2 4 0 4.8 2.6 4.8 6.1V21h-4v-5.4c0-1.3 0-3-1.8-3s-2.1 1.4-2.1 2.9V21H9z"/></svg></a>
          <a href="https://x.com/TeamCodeksha" target="_blank" rel="noopener" aria-label="Codeksha on X"><svg viewBox="0 0 24 24"><path d="M17.8 3h3.1l-6.8 7.7L22 21h-6.2l-4.9-6.3L5.3 21H2.2l7.2-8.3L2 3h6.4l4.4 5.8zm-1.1 16.2h1.7L7.4 4.7H5.6z"/></svg></a>
        </div>
      </div>
      <div>
        <h4>Quick links</h4>
        <ul><li><a href="/about-us/">About Codeksha</a></li><li><a href="#courses">All Courses</a></li><li><a href="#categories">Categories</a></li><li><a href="#stories">Student Reviews</a></li><li><a href="/faqs/">FAQs</a></li><li><a href="#contact">Book a Free Demo</a></li></ul>
      </div>
      <div>
        <h4>Courses</h4>
        <ul><li><a href="/course/full-stack-web-development/">Full Stack Development</a></li><li><a href="/course/frontend-development/">Frontend Development</a></li><li><a href="/course/backend-development/">Backend Development</a></li><li><a href="/course/wordpress-development/">WordPress Development</a></li><li><a href="/course/digital-marketing-seo/">Digital Marketing &amp; SEO</a></li><li><a href="/course/ai-automation/">AI &amp; Automation</a></li></ul>
      </div>
      <div>
        <h4>Visit the centre</h4>
        <ul class="contact-list">
          <li>Address<b>A-1110, RK Iconic, Near Sheetal Park, 150 Feet Ring Rd, Rajkot, Gujarat 360006, India</b></li>
          <li>Phone<b>+91 63555 59016</b></li>
          <li>Email<b>info@codeksha.com</b></li>
          <li>Hours<b>Mon–Sat, 8 AM – 7 PM</b></li>
        </ul>
      </div>
    </div>
    <div class="foot-towns">
      <h4>Students from nearby towns</h4>
      <ul>
        <?php foreach ($footLinks as $fl): ?>
        <li><a href="<?= e($fl[0]) ?>"><?= e($fl[1]) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="giant" aria-hidden="true">Codeksha<span>.</span></div>
    <div class="foot-bot">
      <span>© 2026 Codeksha. All rights reserved.</span>
      <nav aria-label="Legal"><a href="/terms-of-use/">Terms of use</a><a href="/policy/">Privacy policy</a><a href="/policy/">Refund policy</a></nav>
    </div>
  </div>
</footer>

<div class="toast" id="toast" role="status" aria-live="polite"></div>

<script src="/assets/loc/script.js?v=1" defer></script>
</body>
</html>
