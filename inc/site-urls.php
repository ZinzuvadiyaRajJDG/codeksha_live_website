<?php
/**
 * Canonical list of public URLs, used by sitemap.php / llms.php.
 * Course + blog pages are auto-discovered from the filesystem, so new posts
 * appear automatically. Returns rows: [loc, priority, changefreq, lastmod].
 */

function ck_site_base(): string
{
    // Prefer a real public domain from inc/config.php (site_url); this keeps
    // the sitemap / robots / llms in agreement with the page canonicals.
    $cfgFile = __DIR__ . '/config.php';
    if (is_file($cfgFile)) {
        $cfg = require $cfgFile;
        $u = rtrim((string) ($cfg['site_url'] ?? ''), '/');
        if ($u && !preg_match('/\.(test|local|localhost)(:\d+)?$|localhost/i', $u)) {
            return $u;
        }
    }
    // Fall back to the current request host (local dev / not yet configured).
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https'
        || (($_SERVER['SERVER_PORT'] ?? '') === '443');
    $host = preg_replace('/[^a-z0-9.\-:]/i', '', $_SERVER['HTTP_HOST'] ?? 'codeksha.com');
    return ($https ? 'https' : 'http') . '://' . $host;
}

function ck_site_urls(): array
{
    $root = dirname(__DIR__);
    $mtime = function (string $rel) use ($root): string {
        $f = $root . '/' . $rel;
        return date('Y-m-d', is_file($f) ? (int) filemtime($f) : time());
    };

    $rows = [
        ['/',                      '1.0', 'weekly',  $mtime('index.php')],
        ['/courses/',              '0.9', 'weekly',  $mtime('courses.php')],
        ['/book-demo/',            '0.8', 'monthly', $mtime('book-demo.php')],
        ['/it-training-rajkot/',   '0.7', 'monthly', $mtime('it-training-rajkot.php')],
        ['/blog/',                 '0.7', 'weekly',  $mtime('blog.php')],
        ['/about-us/',             '0.8', 'monthly', $mtime('about-us.php')],
        ['/gallery/',              '0.5', 'monthly', $mtime('gallery.php')],
        ['/faqs/',                 '0.5', 'monthly', $mtime('faqs.php')],
        ['/contact/',              '0.5', 'yearly',  $mtime('contact.php')],
        ['/become-an-instructor/', '0.4', 'yearly',  $mtime('become-an-instructor.php')],
        ['/terms-of-use/',         '0.2', 'yearly',  $mtime('terms-of-use.php')],
        ['/policy/',               '0.2', 'yearly',  $mtime('policy.php')],
    ];

    foreach (glob($root . '/course/*.php') as $f) {
        $slug = basename($f, '.php');
        $rows[] = ['/course/' . $slug . '/', '0.8', 'monthly', date('Y-m-d', (int) filemtime($f))];
    }
    foreach (glob($root . '/blog/*.php') as $f) {
        $slug = basename($f, '.php');
        $rows[] = ['/blog/' . $slug . '/', '0.6', 'monthly', date('Y-m-d', (int) filemtime($f))];
    }

    return $rows;
}
