<?php
/** robots.txt — served at /robots.txt (see .htaccess). */
require __DIR__ . '/inc/site-urls.php';

header('Content-Type: text/plain; charset=UTF-8');
$base = ck_site_base();
?>
User-agent: *
Allow: /
Disallow: /admin/
Disallow: /inc/
Disallow: /db/
Disallow: /track/
Disallow: /submit
Disallow: /get-path

Sitemap: <?= $base ?>/sitemap.xml
