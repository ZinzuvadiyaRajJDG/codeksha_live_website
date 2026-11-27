<?php @include __DIR__ . '/inc/tracker.php'; /* analytics */ ?>
<?php
/**
 * NEW HOME PAGE DESIGN (staging copy at /index-2/ for QA before it replaces index.php).
 * Content = the current home page (index.php). Design = the location pages (assets/loc/styles.css:
 * Bricolage Grotesque / DM Sans / JetBrains Mono, electric blue + black). Extra pieces: assets/home2.css,
 * behaviour: assets/home2.js. Mascot: inc/partials/mascot-walker.php (unchanged).
 *
 * While on /index-2/ it is noindex and canonicalises to "/" so Google never sees a duplicate home page.
 * To go live: copy this file over index.php and set $ck_is_staging = false.
 */
require_once __DIR__ . '/inc/locations.php';
$ck_is_staging = true;

$h = static fn ($s): string => htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
$v = static fn (string $rel): int => (int) @filemtime(__DIR__ . '/' . $rel);

$title = 'IT Training Institute in Rajkot | Codeksha';
$desc  = 'Codeksha is an IT training institute in Rajkot teaching full stack, backend, frontend, Laravel and WordPress in project-based classes.';
$star  = '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.9 7.5.7-5.7 5 1.7 7.4L12 18.3 5.5 22l1.7-7.4L1.5 9.6 9 8.9z"/></svg>';
$stars = str_repeat($star, 5);
$clock = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>';

$nav = [
    ['/',           'Home'],
    ['/about-us/',  'About Us'],
    ['/courses/',   'All Courses'],
    ['/gallery/',   'Gallery'],
    ['/faqs/',      'FAQs'],
    ['/blog/',      'Blog'],
    ['/contact/',   'Contact'],
];

// Hero review slider (same four reviews as the current home page)
$reviews = [
    ['img' => '/Images/review1.webp', 'face' => '/assets/loc/img/harmi.webp',   'name' => 'Harmi',        'role' => 'Backend Trainee @ Codeksha',
     'quote' => "I'm currently taking training from Codeksha and it's been a great experience! The supportive environment helps me stay focused on learning and gaining hands-on exposure to backend fundamentals & APIs."],
    ['img' => '/Images/review2.webp', 'face' => '/assets/loc/img/nensi.webp',   'name' => 'Nensi Patel',  'role' => 'Frontend Engineer @ IT Industry',
     'quote' => "Codeksha stands out as a leading institute in Rajkot for gaining real-world IT industry exposure. I'm proud to be a part of Codeksha, where continuous learning opens doors to hands-on experience."],
    ['img' => '/Images/review3.webp', 'face' => '/assets/loc/img/shivraj.webp', 'name' => 'Shivraj Vala', 'role' => 'Backend Developer @ IT Solutions',
     'quote' => "With a curriculum focused on real-world skills, Codeksha provides students with the practical tools they need to succeed in today's tech industry."],
    ['img' => '/Images/review4.webp', 'face' => '/assets/loc/img/foram.webp',   'name' => 'Foram Joshi',  'role' => 'Full Stack Developer',
     'quote' => 'Every day at Codeksha is a step closer to the future I dream of. The support and exposure here are unmatched. From zero confidence to building real projects, Codeksha helped me grow!'],
];

// Courses (same six cards as the current home page)
$courses = [
    ['cat' => 'web', 'catName' => 'Web Development', 'img' => '/Images/courses/full-stack-web-development.webp', 'w' => 723, 'h' => 508, 'name' => 'Full Stack Web Development', 'dur' => '5 months', 'url' => '/course/full-stack-web-development/',
     'desc' => 'HTML, CSS, Bootstrap, JavaScript, PHP, MySQL, a framework of your choice, DevOps and a live capstone.'],
    ['cat' => 'web', 'catName' => 'Web Development', 'img' => '/Images/courses/frontend-development.webp', 'w' => 723, 'h' => 508, 'name' => 'Frontend Development with CMS', 'dur' => '3 months', 'url' => '/course/frontend-development/',
     'desc' => 'HTML, CSS, Bootstrap, JavaScript, GitHub and one CMS: WordPress, Shopify, Webflow or Wix.'],
    ['cat' => 'web', 'catName' => 'Web Development', 'img' => '/Images/courses/javascript.webp', 'w' => 723, 'h' => 508, 'name' => 'JavaScript', 'dur' => '3 months', 'url' => '/course/javascript/',
     'desc' => 'ES6+, DOM and events, Fetch API and JSON, form validation, jQuery, Ajax and GitHub.'],
    ['cat' => 'web', 'catName' => 'Web Development', 'img' => '/Images/courses/backend-development.webp', 'w' => 723, 'h' => 508, 'name' => 'Backend Development', 'dur' => '4 months', 'url' => '/course/backend-development/',
     'desc' => 'PHP, MySQL, Laravel, CodeIgniter or Node.js, REST APIs, security, CI/CD and Docker basics.'],
    ['cat' => 'web', 'catName' => 'Web Development', 'img' => '/Images/courses/mongodb.webp', 'w' => 723, 'h' => 508, 'name' => 'MongoDB', 'dur' => '12 lessons', 'url' => '/course/mongodb/',
     'desc' => 'NoSQL database design, CRUD operations and aggregation pipelines with MongoDB.'],
    ['cat' => 'dm', 'catName' => 'Digital Marketing', 'img' => '/Images/courses/digital-marketing-seo.webp', 'w' => 723, 'h' => 508, 'name' => 'Digital Marketing Pro (SEO + Paid Ads)', 'dur' => '4 months', 'url' => '/course/digital-marketing-seo/',
     'desc' => 'Basic and advanced SEO, Canva and AI ad creatives, Meta Ads, Google Ads and ChatGPT Ads.'],
    ['cat' => 'dm', 'catName' => 'Digital Marketing', 'img' => '/Images/courses/google-ads.webp', 'w' => 723, 'h' => 508, 'name' => 'Google Ads', 'dur' => '3 months', 'url' => '/course/google-ads/',
     'desc' => 'Search, Display, Performance Max and YouTube campaigns, tracking, testing and reporting.'],
    ['cat' => 'dm', 'catName' => 'Digital Marketing', 'img' => '/Images/courses/seo.webp', 'w' => 723, 'h' => 508, 'name' => 'SEO Foundation (Basic)', 'dur' => '3 months', 'url' => '/course/seo/',
     'desc' => 'Keyword research, on-page, technical, off-page and local SEO, SEO tools and a live-site audit.'],
    ['cat' => 'dm', 'catName' => 'Digital Marketing', 'img' => '/Images/courses/advanced-seo-ai-search.webp', 'w' => 723, 'h' => 508, 'name' => 'Advanced SEO & AI Search', 'dur' => '3 months', 'url' => '/course/advanced-seo-ai-search/',
     'desc' => 'Content, technical, schema and ecommerce SEO, audits, AI SEO, GEO, AEO and SEO automation.'],
    ['cat' => 'dm', 'catName' => 'Digital Marketing', 'img' => '/Images/courses/social-media-marketing.webp', 'w' => 723, 'h' => 508, 'name' => 'Social Media Marketing', 'dur' => '3 months', 'url' => '/course/social-media-marketing/',
     'desc' => 'Canva and AI ad creatives, Meta Ads, audiences, retargeting and reporting.'],
    ['cat' => 'cms', 'catName' => 'CMS &amp; Builders', 'img' => '/Images/courses/wordpress-development.webp', 'w' => 723, 'h' => 508, 'name' => 'WordPress Development', 'dur' => '3 months', 'url' => '/course/wordpress-development/',
     'desc' => 'Theme setup, page builders, plugins, forms, speed and on-page SEO, and site launch.'],
    ['cat' => 'ai', 'catName' => 'AI &amp; Automation', 'img' => '/Images/courses/ai-automation.webp', 'w' => 723, 'h' => 508, 'name' => 'AI Automation & AI Agents', 'dur' => '3 months', 'url' => '/course/ai-automation/',
     'desc' => 'AI tools, prompt engineering, n8n, Zapier and Make.com workflows, AI agents and business automation.'],
    ['cat' => 'ai', 'catName' => 'AI &amp; Automation', 'img' => '/Images/courses/prompt-engineering.webp', 'w' => 723, 'h' => 508, 'name' => 'Prompt Engineering', 'dur' => '3 months', 'url' => '/course/prompt-engineering/',
     'desc' => 'ChatGPT, Claude and Gemini, prompt engineering, context files, custom AI skills and MCP.'],
    ['cat' => 'ai', 'catName' => 'AI &amp; Automation', 'img' => '/Images/courses/n8n-automation.webp', 'w' => 723, 'h' => 508, 'name' => 'n8n Automation', 'dur' => '3 months', 'url' => '/course/n8n-automation/',
     'desc' => 'n8n, Zapier and Make.com workflows, APIs and webhooks, business automations, self-hosting.'],
    ['cat' => 'design', 'catName' => 'Design', 'img' => '/Images/courses/ui-ux-design.webp', 'w' => 723, 'h' => 508, 'name' => 'UI/UX Design', 'dur' => '3 months', 'url' => '/course/ui-ux-design/',
     'desc' => 'UX basics, Figma prototyping and design systems, Claude Design and a portfolio.'],
    ['cat' => 'design', 'catName' => 'Design', 'img' => '/Images/courses/graphic-design.webp', 'w' => 723, 'h' => 508, 'name' => 'Graphic Design', 'dur' => '3 months', 'url' => '/course/graphic-design/',
     'desc' => 'Design basics, Canva, Photoshop, Illustrator and a brand identity kit.'],
    ['cat' => 'design', 'catName' => 'Design', 'img' => '/Images/courses/graphic-design-ui-ux.webp', 'w' => 723, 'h' => 508, 'name' => 'Graphic Design & UI/UX', 'dur' => '3 months', 'url' => '/course/graphic-design-ui-ux/',
     'desc' => 'Design basics, Canva, Photoshop, Illustrator, branding, Figma and Claude Design.'],
];
$catCount = array_count_values(array_column($courses, 'cat'));

$paths = [
    ['/courses/#web-development',          'Web Development'],
    ['/courses/#cms-builders',             'CMS &amp; Builders'],
    ['/courses/#digital-marketing-course', 'Digital Marketing'],
    ['/courses/#ai-automation',            'AI &amp; Automation'],
    ['/courses/#design',                   'Design'],
];

$premium = [
    ['Who will be teaching these courses?', 'Not typical teachers: you’ll be learning from actual industry developers who work on real client projects daily.'],
    ['Will I work on real-time projects?', 'Yes! Every course includes hands-on live project assignments and real-world code reviews.'],
    ['Do I get internship opportunities?', 'Top performers earn recognized internship completion certificates and live project experience.'],
    ['Is there a community to connect with?', 'Access our developer Discord community to ask questions, share code, and network with mentors.'],
];

$highlights = [
    ['On premise classroom Training', 'Real-Time Learning, Real-World Environment'],
    ['Developer Turned Teachers', 'Taught by Doers, Not Just Talkers'],
    ['Live Project Exposure', 'Work on Real Projects, Not Just Assignments'],
];

$testimonials = [
    ['/assets/loc/img/harmi.webp',   'Harmi',   'Backend Trainee @ Codeksha',       'Codeksha is a great place to grow and learn. The team is supportive, the environment is positive, and the leadership truly values your efforts. Highly recommend it for anyone looking to build a strong career in the digital space.'],
    ['/assets/loc/img/mathan.webp',  'Mathan',  'Backend Trainee',                  "I'm currently taking training from Codeksha and it's been a great experience so far. The supportive, politics-free environment helps me stay focused on learning and doing quality work. I'm gaining hands-on exposure to backend fundamentals like APIs, databases, and server-side logic - a perfect place to start my tech journey!"],
    ['/assets/loc/img/nensi.webp',   'Nensi',   'Frontend Engineer @ IT Industry',  "Codeksha stands out as a leading institute in Rajkot for gaining real-world IT industry exposure. I'm proud to be a part of Codeksha, where continuous learning opens doors to hands-on, practical experience."],
    ['/assets/loc/img/shivraj.webp', 'Shivraj', 'Backend Developer @ IT Solutions', "With a curriculum focused on real-world skills, Codeksha provides students with the tools they need to succeed in today's tech industry."],
    ['/assets/loc/img/foram.webp',   'Foram',   'Full Stack Developer',             'Every day at Codeksha is a step closer to the future I dream of. The support and exposure here are unmatched. From zero confidence to building real projects, Codeksha helped me grow into someone ready to face the tech world.'],
];

$faqs = [
    ['Which IT courses does Codeksha offer in Rajkot?', 'Codeksha offers classroom courses in Full Stack Development, Backend Programming, Frontend Design, Laravel and WordPress & CMS Tools at our Rajkot training centre.'],
    ['Is the training classroom-based or online?', 'Codeksha runs on-premise classroom training at our Rajkot location, so you learn in a real-world training environment alongside other students.'],
    ['Who teaches the courses at Codeksha?', 'Courses are taught by developers who work on real client projects, not traditional classroom teachers, so you learn current, practical techniques from people actively building software.'],
    ['Does Codeksha provide live-project training?', 'Yes. Every course includes hands-on, live project assignments alongside classroom instruction, so you apply what you learn to real-world scenarios rather than isolated exercises.'],
    ['Is Codeksha suitable for beginners?', 'Yes. Our Full Stack Development, Backend Programming, Frontend Design, Laravel and WordPress & CMS Tools courses are all offered at a beginner level, with no entrance exam required.'],
    ['Is Laravel and WordPress training available in Rajkot?', 'Yes, both are taught as dedicated courses at our Rajkot centre: a Laravel course covering PHP-based web application development, and a WordPress & CMS Tools course covering theme customisation and WooCommerce store setup.'],
    ['Where is Codeksha located?', 'Codeksha is located at A-1110, RK Iconic, Near Sheetal Park, 150 Feet Ring Rd, Rajkot, Gujarat 360006. You can reach us at +91 6355559016 or info@codeksha.com.'],
];

$ld = [
    [
        '@context' => 'https://schema.org', '@type' => 'EducationalOrganization', 'name' => 'Codeksha',
        'url' => 'https://codeksha.com/', 'logo' => 'https://codeksha.com/Images/Codeksha-Logo.png',
        'email' => 'info@codeksha.com', 'telephone' => '+91-6355559016',
        'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'A-1110, RK Iconic, Near Sheetal Park, 150 Feet Ring Rd',
                      'addressLocality' => 'Rajkot', 'addressRegion' => 'Gujarat', 'postalCode' => '360006', 'addressCountry' => 'IN'],
        'sameAs' => ['https://www.instagram.com/codeksha_official', 'https://www.linkedin.com/company/codeksha/', 'https://x.com/TeamCodeksha'],
    ],
    ['@context' => 'https://schema.org', '@type' => 'WebSite', 'name' => 'Codeksha', 'url' => 'https://codeksha.com/'],
    [
        '@context' => 'https://schema.org', '@type' => 'FAQPage',
        'mainEntity' => array_map(static fn ($f) => ['@type' => 'Question', 'name' => $f[0],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]]], $faqs),
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require __DIR__ . '/inc/partials/gtm-head.php'; ?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title><?= $h($title) ?></title>
<meta name="description" content="<?= $h($desc) ?>">
<meta name="robots" content="<?= $ck_is_staging ? 'noindex, follow' : 'index, follow' ?>">
<link rel="canonical" href="https://codeksha.com/">
<link rel="icon" type="image/png" href="/Images/fevicon.png">
<link rel="apple-touch-icon" href="/Images/fevicon.png">
<meta property="og:type" content="website"><meta property="og:site_name" content="Codeksha">
<meta property="og:title" content="<?= $h($title) ?>"><meta property="og:description" content="<?= $h($desc) ?>">
<meta property="og:url" content="https://codeksha.com/"><meta property="og:image" content="https://codeksha.com/Images/Codeksha-Logo.png"><meta property="og:locale" content="en_IN">
<meta name="twitter:card" content="summary_large_image"><meta name="twitter:title" content="<?= $h($title) ?>"><meta name="twitter:description" content="<?= $h($desc) ?>"><meta name="twitter:image" content="https://codeksha.com/Images/Codeksha-Logo.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&family=JetBrains+Mono:wght@500;700&display=swap">
<link rel="stylesheet" href="/assets/loc/styles.css?v=<?= $v('assets/loc/styles.css') ?>">
<link rel="stylesheet" href="/assets/home2.css?v=<?= $v('assets/home2.css') ?>">
<link rel="preload" as="image" href="/Images/review1.webp" fetchpriority="high">
<?php foreach ($ld as $block): ?>
<script type="application/ld+json"><?= json_encode($block, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php endforeach; ?>
<!-- Microsoft Clarity (same tag as the rest of the site) -->
<script type="text/javascript">(function(c,l,a,r,i,t,y){c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);})(window,document,"clarity","script","yelup4ouat");</script>
</head>
<body>
<?php require __DIR__ . '/inc/partials/gtm-body.php'; ?>

<!-- ============ ANNOUNCEMENT ============ -->
<div class="announce">
  <div class="wrap">
    <span>Brand new Course Package released! Get 10% off your first purchase with code <code>CK-10OFF</code>.</span>
    <button type="button" data-open-promo>Find out more!</button>
  </div>
</div>

<!-- ============ HEADER ============ -->
<header class="top" id="top">
  <div class="wrap">
    <nav class="nav" aria-label="Main">
      <a href="/" class="logo" aria-label="Codeksha home"><img src="/assets/loc/img/codeksha-logo.png" alt="Codeksha" width="102" height="40"></a>
      <ul class="nav-links">
        <?php foreach ($nav as $i => [$href, $label]): ?>
        <li><a href="<?= $href ?>"<?= $i === 0 ? ' aria-current="page"' : '' ?>><?= $label ?></a></li>
        <?php endforeach; ?>
      </ul>
      <div class="nav-cta">
        <a href="/book-demo/" class="btn btn-blue">Book a Free Demo <span class="arr">→</span></a>
        <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false" aria-controls="mobileMenu"><span></span></button>
      </div>
    </nav>
    <div class="mobile-menu" id="mobileMenu" hidden>
      <ul>
        <?php foreach ($nav as [$href, $label]): ?>
        <li><a href="<?= $href ?>"><?= $label ?> <span>→</span></a></li>
        <?php endforeach; ?>
      </ul>
      <a href="/book-demo/" class="btn btn-blue">Book a Free Demo <span class="arr">→</span></a>
    </div>
  </div>
</header>

<main>
<!-- ============ HERO ============ -->
<section class="hero" id="home">
  <div class="wrap hero-grid">
    <div class="hero-copy">
      <span class="hero-badge"><b>SKILL CERTIFIED</b> 10+ Years of Experience</span>
      <h1 class="h2-title">Learn From <span class="pill">Real Developers</span> at Codeksha's IT Training Institute in <span class="scribble">Rajkot<svg viewBox="0 0 300 20" preserveAspectRatio="none" aria-hidden="true"><path d="M2 14 C 60 2, 120 2, 160 10 S 250 18, 298 6" fill="none" stroke="#1766FF" stroke-width="5" stroke-linecap="round"/></svg></span></h1>
      <p class="hero-sub">Classroom, project-based courses in Full Stack Development, Backend Programming, Frontend Design, Laravel and WordPress - taught by working developers, not traditional teachers.</p>
      <div class="hero-ctas">
        <a href="#courses" class="btn btn-blue">Enroll Now <span class="arr">→</span></a>
        <a href="/book-demo/" class="btn btn-line">Book a Free Demo</a>
      </div>
      <div class="proof">
        <div class="stars" aria-label="Rated 4.85 out of 5"><?= $stars ?></div>
        <p class="proof-txt"><b>4.85</b> rating · <mark class="hl">15+ Real Developers</mark> will teach you</p>
      </div>
      <div class="chips" aria-label="Courses">
        <span class="chip">Full Stack</span><span class="chip">Backend</span><span class="chip">Frontend</span><span class="chip">Laravel</span><span class="chip">WordPress</span>
      </div>
    </div>

    <div class="hero-visual" id="heroReviews">
      <div class="hero-panel">
        <span class="bigtag" aria-hidden="true">&lt;/&gt;</span>
        <?php foreach ($reviews as $i => $r): ?>
        <img class="person<?= $i === 0 ? ' is-on' : '' ?>" src="<?= $r['img'] ?>" alt="<?= $h($r['name']) ?> - Codeksha Review <?= $i + 1 ?>" width="1536" height="1024"
             <?= $i === 0 ? 'fetchpriority="high"' : 'loading="lazy"' ?> decoding="async"
             data-name="<?= $h($r['name']) ?>" data-role="<?= $h($r['role']) ?>" data-face="<?= $r['face'] ?>" data-quote="<?= $h($r['quote']) ?>">
        <?php endforeach; ?>
        <div class="h2-dots" id="heroDots" aria-label="Choose a review"></div>
      </div>
      <figure class="float h2-quote" id="heroQuote" aria-live="polite" style="margin:0">
        <blockquote><?= $h($reviews[0]['quote']) ?></blockquote>
        <figcaption class="who"><img src="<?= $reviews[0]['face'] ?>" alt="<?= $h($reviews[0]['name']) ?>" width="60" height="60"><div><b><?= $h($reviews[0]['name']) ?></b><small><?= $h($reviews[0]['role']) ?></small></div></figcaption>
      </figure>
      <div class="float f3 h2-live"><span class="dot"></span> Live class · Rajkot centre</div>
    </div>
  </div>
  <?php require __DIR__ . '/inc/partials/mascot-walker.php'; ?>
</section>

<div class="ticker-zone" aria-hidden="true">
  <div class="ticker"><div class="track">
    <?php for ($k = 0; $k < 2; $k++): foreach ($courses as $c): ?><span><?= $h($c['name']) ?></span><?php endforeach; endfor; ?>
  </div></div>
  <div class="ticker alt"><div class="track">
    <?php for ($k = 0; $k < 2; $k++): ?><span>Skill Boosters</span><span>Career Tracks</span><span>Internship Certificates</span><span>On premise classroom training</span><span>Developer turned teachers</span><span>Live project exposure</span><?php endfor; ?>
  </div></div>
</div>

<!-- ============ NUMBERS + FEATURES ============ -->
<section class="section" id="about" style="padding-top:clamp(48px,7vw,88px)">
  <div class="wrap">
    <div class="stats-head reveal">
      <span class="eyebrow">Trust</span>
      <h2 class="h-sec"><mark class="hl">15+ Real Developers</mark> will teach you at Codeksha.</h2>
    </div>
    <div class="stats reveal">
      <div class="stat"><span class="mono">// experience</span><div class="stat-num"><span data-count="10">10</span><sup>+</sup></div><p class="stat-lab">Years of Experience</p></div>
      <div class="stat"><span class="mono">// your teachers</span><div class="stat-num"><span data-count="15">15</span><sup>+</sup></div><p class="stat-lab"><mark class="hl">Real Developers</mark> will teach you</p></div>
      <div class="stat"><span class="mono">// out of 5</span><div class="stat-num"><span data-count="4.85" data-dec="2">4.85</span><sup>★</sup></div><p class="stat-lab">Student rating</p></div>
      <div class="stat certified"><span class="mono">// on completion</span>
        <div class="seal" aria-hidden="true"><svg viewBox="0 0 100 100"><defs><path id="circ" d="M50,50 m-38,0 a38,38 0 1,1 76,0 a38,38 0 1,1 -76,0"/></defs><g class="ring"><text font-family="JetBrains Mono, monospace" font-size="9.5" font-weight="700" fill="#7fa9ff" letter-spacing="2.2"><textPath href="#circ">CODEKSHA · SKILL · CERTIFIED · </textPath></text></g><circle cx="50" cy="50" r="24" fill="#1766FF"/><path d="M39 50l7 7 15-15" fill="none" stroke="#fff" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <p class="stat-lab"><b style="color:#fff;font-family:var(--f-display);font-size:1.4rem;display:block;line-height:1.1">Codeksha</b>Skill Certified</p></div>
    </div>

    <div class="feat-grid">
      <div class="step-card reveal">
        <span class="feat-ic" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L4 14h7l-1 8 9-12h-7z"/></svg></span>
        <span class="mono">// 01</span><h3>Skill Boosters</h3><p>Learn hands-on, at your own pace - guided by real developers.</p>
      </div>
      <div class="step-card reveal">
        <span class="feat-ic" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l6-6 4 4 8-8"/><path d="M15 7h6v6"/></svg></span>
        <span class="mono">// 02</span><h3>Career Tracks</h3><p>Level up with focused, real-world training paths built for tech careers.</p>
      </div>
      <div class="step-card reveal">
        <span class="feat-ic" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="9" r="6"/><path d="M8.5 14.5L7 22l5-3 5 3-1.5-7.5"/></svg></span>
        <span class="mono">// 03</span><h3>Internship Certificates</h3><p>Earn recognized proof of practical skills through live project work.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ COURSES ============ -->
<section class="section" id="courses" style="background:var(--blue-mist);border-radius:var(--r-xl) var(--r-xl) 0 0">
  <div class="wrap">
    <div class="sec-head reveal">
      <div>
        <span class="eyebrow">Our courses</span>
        <h2 class="h-sec">Explore <em>top courses</em>.</h2>
      </div>
      <div class="car-nav">
        <button class="car-btn" id="cPrev" aria-label="Previous courses"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M15 5l-7 7 7 7"/></svg></button>
        <button class="car-btn is-fill" id="cNext" aria-label="Next courses"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M9 5l7 7-7 7"/></svg></button>
      </div>
    </div>
    <div class="cf-chips" role="toolbar" aria-label="Filter courses by category">
      <button type="button" class="cf-chip on" data-f="all" aria-pressed="true">All courses <b><?= count($courses) ?></b></button>
      <button type="button" class="cf-chip" data-f="web" aria-pressed="false">Web Development <b><?= $catCount['web'] ?? 0 ?></b></button>
      <button type="button" class="cf-chip" data-f="dm" aria-pressed="false">Digital Marketing <b><?= $catCount['dm'] ?? 0 ?></b></button>
      <button type="button" class="cf-chip" data-f="cms" aria-pressed="false">CMS &amp; Builders <b><?= $catCount['cms'] ?? 0 ?></b></button>
      <button type="button" class="cf-chip" data-f="ai" aria-pressed="false">AI &amp; Automation <b><?= $catCount['ai'] ?? 0 ?></b></button>
      <button type="button" class="cf-chip" data-f="design" aria-pressed="false">Design <b><?= $catCount['design'] ?? 0 ?></b></button>
    </div>
  </div>
  <div class="rail-shell">
    <div class="rail" id="courseRail" tabindex="0" aria-label="Codeksha courses, scroll horizontally">
      <?php foreach ($courses as $i => $c): ?>
      <article class="course" data-cat="<?= $c['cat'] ?>">
        <figure class="c-media"><img src="<?= $c['img'] ?>" alt="<?= $h($c['name']) ?>" width="<?= $c['w'] ?>" height="<?= $c['h'] ?>" loading="lazy" decoding="async"></figure>
        <div class="c-body">
          <div class="c-row"><span class="c-cat"><?= $c['catName'] ?></span><span class="c-num"><?= sprintf('%02d/%02d', $i + 1, count($courses)) ?></span></div>
          <h3><?= $h($c['name']) ?></h3>
          <p class="c-desc"><?= $h($c['desc']) ?></p>
          <div class="c-meta"><span><?= $clock ?><?= $c['dur'] ?></span><span class="lvl">Beginner · Live class</span></div>
          <a href="<?= $c['url'] ?>" class="btn btn-dark c-btn">View Detail <span class="arr">→</span></a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="wrap">
    <div class="rail-foot">
      <span class="mono" id="railCount">Showing <?= count($courses) ?> courses</span>
      <div class="scrub" id="scrub" role="scrollbar" aria-controls="courseRail" aria-orientation="horizontal" aria-label="Course scrollbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" tabindex="0"><i id="railBar"></i></div>
      <a href="/courses/" class="btn btn-dark">View All Courses <span class="arr">→</span></a>
    </div>
  </div>
</section>

<!-- ============ CATEGORIES ============ -->
<section class="section" id="categories" style="background:var(--blue-mist);padding-top:0">
  <div class="wrap">
    <div class="cat-wrap reveal" style="background:var(--paper)">
      <span class="eyebrow">Choose your path</span>
      <h2 class="h-sec" style="margin-top:16px">Courses Categories Built for Today’s <em>Digital World</em>.</h2>
      <div class="path-grid">
        <?php foreach ($paths as $i => [$href, $label]): ?>
        <a class="path" href="<?= $href ?>"><span class="n"><?= sprintf('%02d', $i + 1) ?></span><b><?= $label ?></b><span class="go" aria-hidden="true">→</span></a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ PREMIUM LEARNING ============ -->
<section class="section">
  <div class="wrap why">
    <div class="faq-img reveal"><img src="/Images/question.webp" alt="Codeksha Real Developer Mentor" width="1024" height="1536" loading="lazy" decoding="async"></div>
    <div class="why-copy">
      <span class="eyebrow">Premium learning</span>
      <h2 class="h-sec">A modern way to learn, guided by <em>real devs</em>.</h2>
      <p class="lede">Build skills with Codeksha.</p>
      <ul class="why-list is-us">
        <?php foreach ($premium as [$q, $a]): ?>
        <li><span class="ic" aria-hidden="true">?</span><div><b><?= $h($q) ?></b><p><?= $h($a) ?></p></div></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- ============ HIGHLIGHTS ============ -->
<section class="section dark" id="highlights" style="border-radius:var(--r-xl)">
  <div class="wrap">
    <div class="sec-head reveal">
      <div>
        <span class="eyebrow">Why Codeksha</span>
        <h2 class="h-sec">Taught by doers, not just <em style="color:#7fa9ff">talkers</em>.</h2>
      </div>
      <a href="/book-demo/" class="btn btn-white">Book a Free Demo <span class="arr">→</span></a>
    </div>
    <div class="mentor-facts" style="margin-top:0">
      <?php foreach ($highlights as $i => [$t, $s]): ?>
      <div class="flip"><div class="flip-in">
        <div class="face front"><span class="mono">// <?= sprintf('%02d', $i + 1) ?></span><h3><?= $h($t) ?></h3><span class="hint">Hover or tap to flip</span></div>
        <div class="face back"><span class="mono">// <?= sprintf('%02d', $i + 1) ?></span><p style="font-family:var(--f-display);font-size:1.5rem;font-weight:700;line-height:1.15"><?= $h($s) ?></p></div>
      </div><button type="button" aria-label="Flip card: <?= $h($t) ?>"></button></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ TESTIMONIALS ============ -->
<section class="section" id="stories">
  <div class="wrap">
    <div class="sec-head reveal">
      <div>
        <span class="eyebrow">Students say</span>
        <h2 class="h-sec">Satisfaction is <em>always present</em>.</h2>
      </div>
    </div>
    <div class="t-grid">
      <aside class="score reveal">
        <div>
          <div class="stars" aria-hidden="true"><?= $stars ?></div>
          <div class="n" style="margin-top:14px">4.85</div>
          <p class="trust-line" style="margin-top:10px"><mark class="hl hl-dark">15+ Real Developers</mark> will teach you at Codeksha</p>
        </div>
        <div class="faces"><?php foreach ($testimonials as $t): ?><img src="<?= $t[0] ?>" alt="" width="60" height="60" loading="lazy"><?php endforeach; ?></div>
      </aside>
      <div style="min-width:0">
        <div class="t-rail" id="tRail" tabindex="0" aria-label="Student testimonials">
          <?php foreach ($testimonials as $t): ?>
          <figure class="tcard" style="margin:0"><blockquote><?= $h($t[3]) ?></blockquote><figcaption class="who"><img src="<?= $t[0] ?>" alt="<?= $h($t[1]) ?>" width="60" height="60" loading="lazy"><div><b><?= $h($t[1]) ?></b><small><?= $h($t[2]) ?></small></div></figcaption></figure>
          <?php endforeach; ?>
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

<!-- ============ FAQ ============ -->
<section class="section" id="faq" style="padding-top:0">
  <div class="wrap faq">
    <div class="faq-side">
      <div>
        <span class="eyebrow">FAQs</span>
        <h2 class="h-sec" style="margin-top:16px">Frequently Asked <em>Questions</em>.</h2>
      </div>
      <div class="how-img"><img src="/assets/loc/img/student-pointing.webp" alt="Codeksha student pointing to the questions" width="1536" height="1024" loading="lazy" decoding="async"></div>
      <div class="faq-help"><b>Still have a question?</b><span>Call <a href="tel:+916355559016" style="color:var(--blue);font-weight:700">+91 63555 59016</a> or email <a href="mailto:info@codeksha.com" style="color:var(--blue);font-weight:700">info@codeksha.com</a>.</span></div>
    </div>
    <div class="acc" id="acc">
      <?php foreach ($faqs as $i => [$q, $a]): ?>
      <details<?= $i === 0 ? ' open' : '' ?>><summary><?= $h($q) ?><span class="pm" aria-hidden="true"></span></summary><p class="ans"><?= $h($a) ?></p></details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section id="contact">
  <div class="wrap">
    <div class="cta reveal">
      <div class="cta-copy">
        <span class="eyebrow" style="color:#fff">Codeksha Course</span>
        <h2>Not just tutorials, real training that <span>shapes you.</span></h2>
        <div class="cta-ctas">
          <a href="/book-demo/" class="btn btn-white">Book a Free Demo <span class="arr">→</span></a>
          <a href="/courses/" class="btn btn-line">Explore Courses</a>
        </div>
        <div class="callrow"><span>Call us <b>+91 63555 59016</b></span><span>Email <b>info@codeksha.com</b></span></div>
      </div>
      <div class="cta-img"><img src="/assets/loc/img/student-call.webp" alt="Student making a call-me gesture" width="1536" height="1024" loading="lazy"></div>
    </div>
  </div>
</section>
</main>

<!-- ============ FOOTER ============ -->
<footer>
  <div class="wrap foot">
    <div class="foot-top">
      <div class="foot-brand">
        <span class="logo-chip"><img src="/assets/loc/img/codeksha-logo.png" alt="Codeksha" width="112" height="44" loading="lazy"></span>
        <p>Project-based IT training in Rajkot, taught by developers who work on real client projects.</p>
        <div class="socials">
          <a href="https://www.instagram.com/codeksha_official" target="_blank" rel="noopener noreferrer" aria-label="Codeksha on Instagram"><svg viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.8.1 3.3.1 4.8 1.7 4.9 4.9.1 1.3.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 3.2-1.7 4.8-4.9 4.9-1.3.1-1.6.1-4.8.1s-3.6 0-4.8-.1c-3.3-.1-4.8-1.7-4.9-4.9C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.8C2.4 3.9 3.9 2.4 7.2 2.3 8.4 2.2 8.8 2.2 12 2.2zm0 4.7a5.1 5.1 0 100 10.2 5.1 5.1 0 000-10.2zm0 8.4a3.3 3.3 0 110-6.6 3.3 3.3 0 010 6.6zm5.3-9.8a1.2 1.2 0 100 2.4 1.2 1.2 0 000-2.4z"/></svg></a>
          <a href="https://www.linkedin.com/company/codeksha/" target="_blank" rel="noopener noreferrer" aria-label="Codeksha on LinkedIn"><svg viewBox="0 0 24 24"><path d="M4.98 3.5a2.5 2.5 0 11-.01 5 2.5 2.5 0 01.01-5zM3 9h4v12H3zM9 9h3.8v1.7h.1c.5-1 1.8-2 3.8-2 4 0 4.8 2.6 4.8 6.1V21h-4v-5.4c0-1.3 0-3-1.8-3s-2.1 1.4-2.1 2.9V21H9z"/></svg></a>
          <a href="https://x.com/TeamCodeksha" target="_blank" rel="noopener noreferrer" aria-label="Codeksha on X"><svg viewBox="0 0 24 24"><path d="M17.8 3h3.1l-6.8 7.7L22 21h-6.2l-4.9-6.3L5.3 21H2.2l7.2-8.3L2 3h6.4l4.4 5.8zm-1.1 16.2h1.7L7.4 4.7H5.6z"/></svg></a>
        </div>
      </div>
      <div>
        <h4>Need some help?</h4>
        <ul><li><a href="/faqs/">FAQs</a></li><li><a href="/contact/">Contact</a></li><li><a href="/book-demo/">Book a Free Demo</a></li></ul>
      </div>
      <div>
        <h4>Quick links</h4>
        <ul><li><a href="/about-us/">About Codeksha</a></li><li><a href="/courses/">All Courses</a></li><li><a href="/gallery/">Gallery</a></li><li><a href="/blog/">Blog</a></li></ul>
      </div>
      <div>
        <h4>Get in touch</h4>
        <ul class="contact-list">
          <li>Address<b><a href="https://www.google.com/maps/place/Just+Digital+Gurus/@22.3177299,70.7642141,17z" target="_blank" rel="noopener noreferrer" style="color:inherit">A-1110, RK Iconic, Near Sheetal Park, 150 Feet Ring Rd, Rajkot, Gujarat, 360006 India</a></b></li>
          <li>Call us directly<b><a href="tel:+916355559016" style="color:inherit">+91 6355559016</a></b></li>
          <li>Email<b><a href="mailto:info@codeksha.com" style="color:inherit">info@codeksha.com</a></b></li>
        </ul>
      </div>
    </div>
    <div class="foot-towns">
      <h4>Students from nearby towns</h4>
      <ul>
        <?php foreach ($CK_LOC as $k => $r): ?>
        <li><a href="/<?= $h($k) ?>/"><?= $h($CK_FOCUS[$r['focus']]['h1'] . ' for Students from ' . $r['name']) ?></a></li>
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

<!-- ============ PROMO POPUP (shown once per visitor, same storage key as the rest of the site) ============ -->
<div class="promo" id="ckPromoOverlay" aria-hidden="true">
  <div class="promo-card" role="dialog" aria-modal="true" aria-labelledby="ckPromoTitle">
    <button type="button" class="promo-x" id="ckPromoClose" aria-label="Close">×</button>
    <div class="promo-head">
      <span class="eyebrow">New Course Package</span>
      <h3 id="ckPromoTitle">Get 10% off your first course</h3>
      <p>Use code <strong>CK-10OFF</strong>, or leave your number and we'll call you back with the details.</p>
    </div>
    <div class="promo-body">
      <a href="tel:+916355559016" class="btn btn-dark">Call Us: +91 63555 59016</a>
      <div class="promo-or">or request a callback</div>
      <form id="ckPromoForm" novalidate style="display:grid;gap:14px">
        <?php $ck_form_type = 'popup'; require __DIR__ . '/inc/form-fields.php'; ?>
        <label for="ckPromoPhone">Your phone number
          <input type="tel" id="ckPromoPhone" name="phone" required inputmode="tel" autocomplete="tel" maxlength="20" minlength="8" pattern="[+0-9()\-\s]{8,20}" placeholder="e.g. +91 98765 43210">
        </label>
        <button type="submit" class="btn btn-blue" id="ckPromoSubmit"><span>Claim My 10% Off</span> <span class="arr">→</span></button>
        <p class="fnote" id="ckPromoNote" role="status"></p>
      </form>
    </div>
  </div>
</div>

<script src="/assets/home2.js?v=<?= $v('assets/home2.js') ?>" defer></script>
</body>
</html>
