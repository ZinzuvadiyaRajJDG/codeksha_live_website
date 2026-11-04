<?php
/**
 * Location (student-catchment) pages, e.g. /it-training-morbi/, /web-development-course-wankaner/
 *
 * Design: assets/loc/ (from demo_location/). Template: inc/loc-page.php (generated). Data: inc/locations.php.
 * Honesty rule: Codeksha's classes are in Rajkot. Pages say "for students from <Town>", never "in <Town>",
 * and never claim a local branch, address or phone number.
 */
@include __DIR__ . '/inc/tracker.php'; /* analytics */
require_once __DIR__ . '/inc/locations.php';

$loc = strtolower(preg_replace('/[^a-z0-9-]/', '', (string) ($_GET['loc'] ?? '')));
if ($loc === '' || !isset($CK_LOC[$loc])) {
    http_response_code(404);
    header('Content-Type: text/html; charset=utf-8');
    echo '<!doctype html><meta charset="utf-8"><meta name="robots" content="noindex"><title>Page not found | Codeksha</title>'
       . '<p style="font-family:sans-serif;padding:40px">Page not found. <a href="/">Go to the Codeksha home page</a>.</p>';
    exit;
}
$rec = $CK_LOC[$loc];

function e($s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}

$BASE = 'https://codeksha.com';
$ADDRESS = 'A-1110, RK Iconic, Near Sheetal Park, 150 Feet Ring Rd, Rajkot, Gujarat 360006';
$T = $rec['name'];
$path = '/' . $loc . '/';
$F = $CK_FOCUS[$rec['focus']];
$general = $rec['focus'] === 'general';
$CUR = $CK_COURSES[$F['course']];
$fill = static fn (string $s): string => str_replace('{T}', $T, $s);
$ucf = static fn (string $s): string => mb_strtoupper(mb_substr($s, 0, 1)) . mb_substr($s, 1);

// ---- keyword slots -------------------------------------------------------------------
// PRIMARY: 5-10 uses. K0..K3: 3-5 uses each. General pages: K0..K3 are the four secondaries.
// Course pages: SHARED ("IT training for students from <T> at Codeksha Rajkot") is the shared keyword; K1..K3 are the course secondaries.
$PRIMARY = $fill($F['primary']);
$sec = array_map($fill, $F['sec']);
if ($general) {
    [$K0, $K1, $K2, $K3] = $sec;
    $SHARED = $PRIMARY;
} else {
    $SHARED = 'IT training for students from ' . $T . ' at Codeksha Rajkot';
    $K0 = $SHARED;
    [$K1, $K2, $K3] = $sec;
}
$TEACHER = $F['teacher'];
$COURSE = $CUR['name'];

$H1_LEAD = $F['h1'];
$title = $H1_LEAD . ' for Students from ' . $T . ' | Codeksha Rajkot';
$indexable = ck_loc_indexable($rec);

if ($general) {
    $desc = 'From ' . $T . '? Explore Full Stack, Web Development and Digital Marketing courses at Codeksha\'s Rajkot centre. Learn through live projects. Book a demo.';
    $HERO_SUB = 'Learn from real developers with 5+ years of experience in the IT sector. Project-based courses in Full Stack, Frontend, Backend, Laravel and WordPress at Codeksha, Rajkot. Here is how ' . $PRIMARY . ' works and how to get started.';
    $LEDE_COURSES = 'Our ' . $K0 . ' are live, beginner-friendly programmes in Rajkot with a real project built in. Our ' . $K1 . ', ' . $K2 . ' and ' . $K3 . ' all follow the same live, project-based approach.';
    $PANEL_WEB = 'From the first HTML tag to a deployed app with a database behind it. ' . $ucf($K3) . ' follow the full request-to-response journey, with a developer at your side.';
    $PANEL_DM = 'Learn how websites get found and grow. The ' . $K2 . ' covers SEO, content and analytics, practised on real pages.';
} else {
    $desc = 'IT training for students from ' . $T . ' at Codeksha Rajkot: ' . $COURSE . ' with live projects. Book a free demo.';
    $HERO_SUB = 'Join the ' . $COURSE . ' at Codeksha, Rajkot, taught by ' . $TEACHER . ' with 5+ years of experience in the IT sector. Project-based, beginner friendly, with a certificate on completion. Here is how ' . $PRIMARY . ' works and how to get started.';
    $LEDE_COURSES = 'Our IT courses for ' . $T . ' students are live, beginner-friendly programmes in Rajkot with a real project built in. Our ' . $K1 . ', ' . $K2 . ' and ' . $K3 . ' all follow the same live, project-based approach.';
    $PANEL_WEB = 'From the first HTML tag to a deployed app with a database behind it. Learn the full request-to-response journey, with a developer at your side.';
    $PANEL_DM = 'Learn how websites get found and grow. SEO, content, analytics and online growth strategies, practised on real pages.';
}
$HELP_LINE = 'A great start for any ' . ($general ? $K1 : $PRIMARY) . '.';
$CONSULT_LINE = 'Ask about our ' . $K2 . ' or any other course.';
$VISIT_LINE = 'Looking for ' . $K3 . '? Come and see how a class works.';
$CUR_H2 = $F['curr_h2'];

// ---- FAQs (unique per focus; real course facts) ---------------------------------------
$trainers = $general || $TEACHER === 'real developers'
    ? 'Real developers with 5+ years of experience in the IT sector, who work on real client projects. You can speak with an instructor before you enrol.'
    : 'Experienced professionals with 5+ years in the IT sector, who work on real client projects. You can speak with an instructor before you enrol.';
$faqs = [];
$faqs[] = ['Where are Codeksha\'s classes held?', 'All classes are held at our Rajkot centre: ' . $ADDRESS . '. You can visit before you enrol.'];
$faqs[] = ['How can students from ' . $T . ' join Codeksha?', 'Call us or book a free demo class on our website, choose your course with our team, and visit the Rajkot centre to see a class before you enrol.'];
if ($general) {
    $faqs[] = ['What is ' . $PRIMARY . ' like in practice?', 'It means live, project-based courses at our Rajkot centre, taught by developers with 5+ years of IT experience. Students choose a course first, then book a demo class. A ' . $K1 . ', a ' . $K2 . ' and ' . $K3 . ' are the usual starting points.'];
    $faqs[] = ['Which course should I choose as a student from ' . $T . '?', 'For a ' . $K1 . ', start with Full Stack or Frontend Development. For a ' . $K2 . ', start with Digital Marketing & SEO, SEO or Google Ads. For ' . $K3 . ', JavaScript is the usual first step. A short call with our team will help you pick.'];
} else {
    $faqs[] = ['What is ' . $SHARED . ' like in practice?', 'It means live, project-based courses at our Rajkot centre, taught by ' . $TEACHER . ' with 5+ years of IT experience. Most students from ' . $T . ' start with a ' . $PRIMARY . ', then add a ' . $K1 . ' or ' . $K2 . '. Others begin with ' . $K3 . '.'];
    $faqs[] = ['What will I learn in the ' . $COURSE . ' at Codeksha?', 'Over ' . $CUR['weeks'] . ' weeks (' . $CUR['lessons'] . ' lessons) you will cover: ' . implode('; ', array_slice($CUR['learn'], 0, 6)) . '.'];
    $faqs[] = ['Which course should I choose as a student from ' . $T . '?', 'If you want a ' . $PRIMARY . ', start with the ' . $COURSE . '. If you are still deciding, a short call with our team will help you compare the ' . $K1 . ', ' . $K2 . ' and ' . $K3 . '.'];
}
$faqs[] = ['Can I attend a demo class before I join?', 'Yes. You can book a free demo class on our website and see how classes work at the Rajkot centre before you decide.'];
$faqs[] = ['Is the training online?', 'Our training is held in person at our Rajkot centre, with working professionals. This website does not list online batches.'];
$faqs[] = ['What does ' . $PRIMARY . ' cost?', 'Fees depend on the course. Our team shares current fees and batch timings by phone, so call us or book a demo and we will explain the options.'];
$faqs[] = ['Who can join Codeksha courses?', 'Anyone. Whether you are a college student, a fresher or someone looking to upskill in tech, ' . ($general ? 'our ' . $K0 . ' are' : $SHARED . ' is') . ' built for learners at any starting point.'];
$faqs[] = ['Can I join while studying in college?', 'Yes. Class timings are flexible and student-friendly, so ' . ($general ? 'our ' . $K0 . ' fit' : $SHARED . ' fits') . ' around your college schedule.'];
$faqs[] = ['Do I need prior experience?', 'No. Our courses are suitable for beginners and build your skills step by step. There is no entrance exam.'];
$faqs[] = ['Who are the trainers?', $trainers];
$faqs[] = ['Do I get a certificate?', 'Yes. You receive a certificate on successful completion of your course.'];
$faqs[] = ['Can I pay in installments?', 'Installment plans are available for certain courses. We accept cash, debit and credit cards, and bank transfers. Refund requests are accepted within the first 7 days under our refund policy.'];

$ldBlocks = [
    [
        '@context' => 'https://schema.org', '@type' => 'EducationalOrganization', 'name' => 'Codeksha', 'url' => $BASE . '/',
        'logo' => $BASE . '/Images/Codeksha-Logo.png', 'email' => 'info@codeksha.com', 'telephone' => '+91-6355559016',
        'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'A-1110, RK Iconic, Near Sheetal Park, 150 Feet Ring Rd', 'addressLocality' => 'Rajkot', 'addressRegion' => 'Gujarat', 'postalCode' => '360006', 'addressCountry' => 'IN'],
    ],
    [
        '@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $BASE . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => $H1_LEAD . ' for Students from ' . $T, 'item' => $BASE . $path],
        ],
    ],
    ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array_map(static fn ($f) => [
        '@type' => 'Question', 'name' => $f[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]],
    ], $faqs)],
];

// ---- links to every location page (shown in the footer) -------------------------------
$footLinks = [];
foreach ($CK_LOC as $k => $r) {
    $footLinks[] = ['/' . $k . '/', $CK_FOCUS[$r['focus']]['h1'] . ' for Students from ' . $r['name']];
}
$nearbyLinks = ''; // the old chip band above the footer is replaced by the footer block

// ---- render the template, then adapt it to this page's course focus --------------------
header('Content-Type: text/html; charset=utf-8');
if (!$indexable) {
    header('X-Robots-Tag: noindex, follow');
}
ob_start();
require __DIR__ . '/inc/loc-page.php';
$html = ob_get_clean();

// hero chips
if (!empty($F['chips'])) {
    $chips = '';
    foreach ($F['chips'] as $c) {
        $chips .= '<span class="chip">' . e($c) . '</span>';
    }
    $html = preg_replace('#(<div class="chips" aria-label="What you\'ll learn">).*?(</div>)#s', '$1' . str_replace('$', '\\$', $chips) . '$2', $html, 1);
}
// H1 size for the longer course headings
if (!$general) {
    $html = str_replace('<h1 style="font-size:clamp(2.5rem,5.4vw,4.7rem)">', '<h1 style="font-size:clamp(2.2rem,4.5vw,3.9rem)">', $html);
}
// put this page's course first in the carousel, renumber the cards
if (preg_match('#(<div class="rail" id="courseRail"[^>]*>)(.*?)(</div>\s*</div>\s*<div class="wrap">\s*<div class="rail-foot">)#s', $html, $m)
    && preg_match_all('#<article class="course".*?</article>#s', $m[2], $cards)) {
    $cards = $cards[0];
    usort($cards, static function ($a, $b) use ($F) {
        $fa = strpos($a, 'href="/course/' . $F['course'] . '/"') !== false ? 0 : 1;
        $fb = strpos($b, 'href="/course/' . $F['course'] . '/"') !== false ? 0 : 1;
        return $fa <=> $fb;
    });
    $n = count($cards);
    foreach ($cards as $i => $c) {
        $cards[$i] = preg_replace('#<span class="c-num">\d+/\d+</span>#', '<span class="c-num">' . sprintf('%02d/%d', $i + 1, $n) . '</span>', $c, 1);
    }
    $html = str_replace($m[2], "\n      " . implode("\n      ", $cards) . "\n    ", $html);
}
// open the category tab that matches this course
foreach (['web', 'cms', 'dm', 'ai', 'ds'] as $id) {
    $on = $id === $F['tab'];
    $html = preg_replace('#(<button class="cat-tab" role="tab" id="tab-' . $id . '" aria-controls="p-' . $id . '" aria-selected=")(?:true|false)(")(?: tabindex="-1")?#',
        '${1}' . ($on ? 'true' : 'false') . '${2}' . ($on ? '' : ' tabindex="-1"'), $html, 1);
    $html = preg_replace('#(<div class="cat-panel" role="tabpanel" id="p-' . $id . '" aria-labelledby="tab-' . $id . '")(?: hidden)?>#',
        '${1}' . ($on ? '' : ' hidden') . '>', $html, 1);
}
echo $html;
