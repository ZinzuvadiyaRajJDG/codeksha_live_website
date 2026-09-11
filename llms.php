<?php
/** llms.txt (https://llmstxt.org) — served at /llms.txt (see .htaccess). */
require __DIR__ . '/inc/site-urls.php';

header('Content-Type: text/plain; charset=UTF-8');
$base = ck_site_base();
$root = __DIR__;

/** Pull a readable title from a page's <title> tag. */
$title = function (string $file) use ($root): string {
    $html = @file_get_contents($root . '/' . $file, false, null, 0, 2048) ?: '';
    if (preg_match('/<title>(.*?)<\/title>/is', $html, $m)) {
        $t = html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5);
        $t = preg_replace('/\s*[|\x{2013}\x{2014}].*$/u', '', $t);   // drop " | ..." / " – ..."
        $t = preg_replace('/\s+Course\s+in\s+Rajkot$/i', '', $t);
        return trim($t);
    }
    return ucwords(str_replace('-', ' ', pathinfo($file, PATHINFO_FILENAME)));
};

echo "# Codeksha\n\n";
echo "> Codeksha is an IT training institute in Rajkot, Gujarat (India) offering "
   . "classroom, project-based courses taught by working developers - full stack, "
   . "frontend, backend, WordPress, digital marketing & SEO, and AI & automation.\n\n";
echo "All training is on-premise at the Rajkot centre. Every course includes live "
   . "project work. Free demo classes are available with no commitment.\n\n";

echo "## Courses\n\n";
foreach (glob($root . '/course/*.php') as $f) {
    $slug = basename($f, '.php');
    echo "- [" . $title('course/' . $slug . '.php') . "]({$base}/course/{$slug}/)\n";
}
echo "- [All courses]({$base}/courses/): full catalogue with categories\n\n";

echo "## Key pages\n\n";
echo "- [Book a free demo class]({$base}/book-demo/): reserve a seat in a live session\n";
echo "- [IT training in Rajkot]({$base}/it-training-rajkot/): overview of the institute and approach\n";
echo "- [About Codeksha]({$base}/about-us/): who we are and how we teach\n";
echo "- [Gallery]({$base}/gallery/): photos from the training centre\n";
echo "- [FAQs]({$base}/faqs/): common questions about courses, fees and admissions\n";
echo "- [Contact]({$base}/contact/): phone, email and address\n\n";

echo "## Guides & articles\n\n";
foreach (glob($root . '/blog/*.php') as $f) {
    $slug = basename($f, '.php');
    echo "- [" . $title('blog/' . $slug . '.php') . "]({$base}/blog/{$slug}/)\n";
}
echo "\n";

echo "## Contact\n\n";
echo "- Address: A-1110, RK Iconic, Near Sheetal Park, 150 Feet Ring Rd, Rajkot, Gujarat 360006, India\n";
echo "- Phone: +91 63555 59016\n";
echo "- Email: info@codeksha.com\n";
