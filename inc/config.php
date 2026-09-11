<?php
/**
 * Codeksha admin panel / analytics — configuration.
 * Keep this file private (it is denied by .htaccess and should never be committed
 * with real credentials to a public repo).
 */

return [
    // --- Database ---------------------------------------------------------
    //   Local (XAMPP): host 127.0.0.1, user root, empty password.
    //   Live host:     the cPanel DB name / user / password, host usually
    //                  'localhost'.  Note cPanel prefixes names, e.g.
    //                  'codeksh1_admin' / 'codeksh1_dbuser'.
    'db' => [
        'host'    => '127.0.0.1',
        'port'    => 3306,
        'name'    => 'codeksha_admin',
        'user'    => 'root',
        'pass'    => '',
        'charset' => 'utf8mb4',
    ],

    // --- App -----------------------------------------------------------------
    // Random 64-char key used for signing/CSRF salt. Change it once, then leave it.
    'app_key' => 'a3dd3823a0d817d466b5b28fa468b9f44bca4a2c61f0b9089e15c27934956fd0',

    // Absolute URL base of the public site (no trailing slash). Used for links
    // in alert emails. On localhost this is http://codeksha.test
    'site_url' => 'http://codeksha.test',

    // --- Tracking ----------------------------------------------------------
    'tracking' => [
        'enabled'          => true,
        'session_timeout'  => 1800,   // seconds of inactivity that ends a session
        'respect_dnt'      => false,  // honour the browser "Do Not Track" header
        'anonymize_ip'     => false,  // store last octet / segment as 0
        // Optional MaxMind GeoLite2-City.mmdb for city-level geo. Leave '' to
        // fall back to a free best-effort lookup (country only, cached).
        'geoip_mmdb'       => '',     // e.g. 'C:/xampp/htdocs/codeksha/db/GeoLite2-City.mmdb'
    ],

    // --- Admin session security -----------------------------------------
    'admin' => [
        'idle_timeout'      => 1800,   // 30 min inactivity -> logout
        'absolute_timeout'  => 28800,  // 8 h max session life
        'bind_ip'           => false,  // invalidate session if client IP changes (off: mobile-friendly)
        'login_max_fails'   => 8,      // failed logins per IP ...
        'login_window'      => 900,    // ... within this many seconds -> lockout
    ],
];
