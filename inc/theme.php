<?php
/**
 * Seasonal theme helper. Reads inc/theme-config.php (single ON/OFF switch).
 * When the theme is OFF every function here outputs nothing.
 */

function ck_diwali(): array
{
    static $cfg = null;
    if ($cfg === null) {
        $file = __DIR__ . '/theme-config.php';
        $all  = is_file($file) ? (require $file) : [];
        $cfg  = is_array($all['diwali'] ?? null) ? $all['diwali'] : [];
        $cfg += ['enabled' => false, 'campaign' => 'diwali', 'popup' => []];
        $cfg['popup'] += [
            'delay_seconds' => 10, 'suppress_hours' => 24,
            'headline' => '', 'message' => '', 'offer' => '',
            'primary_label' => 'Explore Courses', 'primary_url' => '/courses/',
            'secondary_label' => 'Book a Free Demo Class', 'secondary_url' => '/book-demo/',
        ];
    }
    return $cfg;
}

function ck_diwali_on(): bool
{
    return !empty(ck_diwali()['enabled']);
}

/** Include a Diwali partial (inc/partials/diwali/<name>.php) only when the theme is ON. */
function ck_diwali_part(string $name): void
{
    if (!ck_diwali_on() || !preg_match('/^[a-z-]+$/', $name)) return;
    $f = __DIR__ . '/partials/diwali/' . $name . '.php';
    if (is_file($f)) require $f;
}

/** Cache-busted URL for a theme asset under /assets/diwali/. */
function ck_diwali_asset(string $file): string
{
    $path = dirname(__DIR__) . '/assets/diwali/' . $file;
    return '/assets/diwali/' . $file . '?v=' . (is_file($path) ? filemtime($path) : '1');
}
