<?php
/** XML sitemap — served at /sitemap.xml (see .htaccess). Auto-lists every page. */
require __DIR__ . '/inc/site-urls.php';

header('Content-Type: application/xml; charset=UTF-8');
header('X-Robots-Tag: noindex');

$base = ck_site_base();
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach (ck_site_urls() as [$loc, $priority, $changefreq, $lastmod]) {
    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($base . $loc, ENT_XML1) . "</loc>\n";
    echo "    <lastmod>{$lastmod}</lastmod>\n";
    echo "    <changefreq>{$changefreq}</changefreq>\n";
    echo "    <priority>{$priority}</priority>\n";
    echo "  </url>\n";
}
echo "</urlset>\n";
