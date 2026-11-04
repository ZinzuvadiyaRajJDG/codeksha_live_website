<?php
/**
 * Location (student-catchment) pages, rendered by gujarat.php with the design in assets/loc/
 * (taken from demo_location/). One row per page. The array KEY is the URL path:
 *   /web-development-course-wankaner/   ->  'web-development-course-wankaner'
 *
 * Wording rule: pages say "for students from <Town>", never "in <Town>" (classes are at the Rajkot centre).
 * 'km' is a ROUGH road distance from Rajkot, kept for planning only. It is NOT shown on the pages.
 * Rows with 'index' => true are indexable (index, follow) and listed in the sitemap; set false to make a page noindex,follow.
 * until enquiries from that town justify them (flip the flag to publish).
 *
 * 'focus' picks the page's course/keyword set from $CK_FOCUS below.
 */
require_once __DIR__ . '/loc-courses.php';

$CK_FOCUS = [
    'general' => [
        'course' => 'full-stack-web-development', 'tab' => 'web', 'h1' => 'IT Training', 'teacher' => 'real developers',
        'primary' => 'IT training for students from {T}',
        'sec' => ['IT courses for {T} students', 'web development course for students from {T}', 'digital marketing course for students from {T}', 'coding classes for students from {T}'],
        'chips' => null, 'curr_h2' => 'Web development and <em>full stack</em> training.',
    ],
    'web' => [
        'course' => 'frontend-development', 'tab' => 'web', 'h1' => 'Web Development Course', 'teacher' => 'real developers',
        'primary' => 'web development course for students from {T}',
        'sec' => ['frontend development course for students from {T}', 'JavaScript course for students from {T}', 'coding classes for students from {T}'],
        'chips' => ['HTML/CSS', 'JavaScript', 'Bootstrap', 'Responsive design', 'Frontend'], 'curr_h2' => 'Web development and <em>frontend</em> training.',
    ],
    'fullstack' => [
        'course' => 'full-stack-web-development', 'tab' => 'web', 'h1' => 'Full Stack Development Course', 'teacher' => 'real developers',
        'primary' => 'full stack development course for students from {T}',
        'sec' => ['web development course for students from {T}', 'MERN stack course for students from {T}', 'coding classes for students from {T}'],
        'chips' => ['HTML/CSS', 'JavaScript', 'React', 'Node.js', 'PHP', 'MySQL'], 'curr_h2' => 'Full stack development <em>training</em>.',
    ],
    'dm' => [
        'course' => 'digital-marketing-seo', 'tab' => 'dm', 'h1' => 'Digital Marketing Course', 'teacher' => 'experienced professionals',
        'primary' => 'digital marketing course for students from {T}',
        'sec' => ['SEO course for students from {T}', 'Google Ads course for students from {T}', 'social media marketing course for students from {T}'],
        'chips' => ['SEO', 'Google Ads', 'Analytics', 'Social media', 'Content marketing'], 'curr_h2' => 'Digital marketing and <em>SEO</em> training.',
    ],
    'graphic' => [
        'course' => 'graphic-design', 'tab' => 'ds', 'h1' => 'Graphic Design Course', 'teacher' => 'experienced professionals',
        'primary' => 'graphic design course for students from {T}',
        'sec' => ['UI UX design course for students from {T}', 'Photoshop and Illustrator course for students from {T}', 'design classes for students from {T}'],
        'chips' => ['Photoshop', 'Illustrator', 'CorelDRAW', 'Canva', 'Branding'], 'curr_h2' => 'Graphic design <em>training</em>.',
    ],
    'uiux' => [
        'course' => 'ui-ux-design', 'tab' => 'ds', 'h1' => 'UI UX Design Course', 'teacher' => 'experienced professionals',
        'primary' => 'UI UX design course for students from {T}',
        'sec' => ['Figma course for students from {T}', 'web design course for students from {T}', 'design classes for students from {T}'],
        'chips' => ['Figma', 'Wireframes', 'Prototypes', 'User research', 'Design systems'], 'curr_h2' => 'UI UX design <em>training</em>.',
    ],
    'wp' => [
        'course' => 'wordpress-development', 'tab' => 'cms', 'h1' => 'WordPress Development Course', 'teacher' => 'real developers',
        'primary' => 'WordPress course for students from {T}',
        'sec' => ['WordPress development course for students from {T}', 'website development course for students from {T}', 'coding classes for students from {T}'],
        'chips' => ['WordPress', 'Themes', 'Plugins', 'WooCommerce', 'Customization'], 'curr_h2' => 'WordPress development <em>training</em>.',
    ],
    'ai' => [
        'course' => 'ai-automation', 'tab' => 'ai', 'h1' => 'AI and Automation Course', 'teacher' => 'real developers',
        'primary' => 'AI automation course for students from {T}',
        'sec' => ['n8n course for students from {T}', 'prompt engineering course for students from {T}', 'IT courses for {T} students'],
        'chips' => ['ChatGPT', 'Prompt engineering', 'n8n', 'Make', 'Zapier'], 'curr_h2' => 'AI and automation <em>training</em>.',
    ],
];

$CK_LOC = [
    // key (= URL path)                         name             district          region        km   focus       index
    'it-training-morbi'                  => ['name' => 'Morbi',         'district' => 'Morbi',         'region' => 'Saurashtra', 'km' => 65,  'focus' => 'general',   'index' => true],
    'it-training-gondal'                 => ['name' => 'Gondal',        'district' => 'Rajkot',        'region' => 'Saurashtra', 'km' => 40,  'focus' => 'general',   'index' => true],
    'it-training-jamnagar'               => ['name' => 'Jamnagar',      'district' => 'Jamnagar',      'region' => 'Saurashtra', 'km' => 90,  'focus' => 'general',   'index' => true], // publish after the Jamnagar-batches claim on About/Contact is confirmed
    'it-training-junagadh'               => ['name' => 'Junagadh',      'district' => 'Junagadh',      'region' => 'Saurashtra', 'km' => 100, 'focus' => 'general',   'index' => true],
    'web-development-course-wankaner'    => ['name' => 'Wankaner',      'district' => 'Morbi',         'region' => 'Saurashtra', 'km' => 40,  'focus' => 'web',       'index' => true],
    'full-stack-development-course-jetpur' => ['name' => 'Jetpur',      'district' => 'Rajkot',        'region' => 'Saurashtra', 'km' => 65,  'focus' => 'fullstack', 'index' => true],
    'digital-marketing-course-jasdan'    => ['name' => 'Jasdan',        'district' => 'Rajkot',        'region' => 'Saurashtra', 'km' => 55,  'focus' => 'dm',        'index' => true],
    'digital-marketing-course-surendranagar' => ['name' => 'Surendranagar', 'district' => 'Surendranagar', 'region' => 'Saurashtra', 'km' => 100, 'focus' => 'dm',   'index' => true],
    'graphic-design-course-dhoraji'      => ['name' => 'Dhoraji',       'district' => 'Rajkot',        'region' => 'Saurashtra', 'km' => 75,  'focus' => 'graphic',   'index' => true],
    'ui-ux-design-course-upleta'         => ['name' => 'Upleta',        'district' => 'Rajkot',        'region' => 'Saurashtra', 'km' => 95,  'focus' => 'uiux',      'index' => true],
    'wordpress-development-course-botad' => ['name' => 'Botad',         'district' => 'Botad',         'region' => 'Saurashtra', 'km' => 105, 'focus' => 'wp',        'index' => true],
    'ai-automation-course-limbdi'        => ['name' => 'Limbdi',        'district' => 'Surendranagar', 'region' => 'Saurashtra', 'km' => 95,  'focus' => 'ai',        'index' => true],
];

function ck_loc_indexable(array $rec): bool
{
    return !empty($rec['index']);
}
