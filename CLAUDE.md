# Codeksha site — structure notes

Static-style PHP site (no framework). XAMPP locally at `http://codeksha.test`,
deployed to a cPanel subdomain. Clean URLs via `.htaccess` (`/about-us/` -> `about-us.php`,
`/course/<slug>/` -> `course/<slug>.php`, `/blog/<slug>/` -> `blog/<slug>.php`).

## Every public page has this shape

```php
<?php @include __DIR__ . '/inc/tracker.php'; /* analytics */ ?>   <-- line 1, always
<!doctype html>
<html lang="en">
  <head>
    <meta charset / viewport / title / description / canonical / og / twitter />   <-- page-specific SEO
    <?php require __DIR__ . '/inc/partials/head.php'; ?>            <-- shared CSS/fonts/favicon/Clarity
    <script type="application/ld+json"> … </script>                <-- page-specific schema
  </head>
  <body>
    <div class="top-banner"> … </div>
    <?php $ck_active = 'home'; require __DIR__ . '/inc/partials/nav.php'; ?>   <-- shared nav
    …page content…
    <?php require __DIR__ . '/inc/partials/site-footer.php'; ?>     <-- shared footer
    <script> …page-specific JS (nav toggle, lucide, forms, sliders)… </script>
  </body>
</html>
```

For pages in `course/` and `blog/`, the include paths are `__DIR__ . '/../inc/…'`.

## Shared partials — edit these once, applies to all pages

| File | Contains |
|---|---|
| `inc/partials/head.php` | Font Awesome, lucide, Google Fonts, `/style.css`, favicon links, **Microsoft Clarity** tag |
| `inc/partials/nav.php`  | top navbar + mobile overlay. Set `$ck_active` before requiring: `home` / `about` / `courses` / `gallery` / `faqs` / `blog` / `contact` / `''` |
| `inc/partials/site-footer.php` | the whole `<footer class="site-footer">` |
| `inc/tracker.php` | first-party analytics — see `SETUP-ADMIN.md` |

## Adding a new page

Copy an existing page of the same type. Keep line 1 (tracker) and the three
`require … partials/…` lines. Change only the `<head>` SEO block, the JSON-LD
schema, `$ck_active`, the body, and the trailing page JS. Add the new URL to the
site by nothing else — `inc/site-urls.php` auto-discovers `course/` and `blog/`
pages for the sitemap; add hand-listed pages there.

## Admin panel & analytics

See `SETUP-ADMIN.md`. Admin at `/admin/`, its own layout in `admin/inc/header.php`
/ `footer.php` (separate from the public partials).
