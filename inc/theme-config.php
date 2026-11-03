<?php
/**
 * SEASONAL THEME SETTINGS  (the one place to switch the Diwali campaign ON or OFF)
 *
 *   Set the 'enabled' line below to  true   = Diwali theme + Diwali popup ON  (shipped default)
 *                                     false  = site renders exactly as the original; nothing Diwali is output
 *
 * Only the homepage (index.php) uses the theme. See THEME-TOGGLE.md.
 * This file lives in /inc, which Apache blocks from public access.
 */
return [
    'diwali' => [
        'enabled' => true,

        // Campaign id. Change it (e.g. diwali-2027) to make every visitor eligible for the popup again.
        'campaign' => 'diwali-2026',

        'popup' => [
            'delay_seconds'  => 10,   // wait this long after the page loads
            'suppress_hours' => 24,   // hide again for this long after the visitor dismisses it

            'headline' => 'Light Up Your Career This Diwali',
            'message'  => "Wishing you and your family a bright and prosperous Diwali from all of us at Codeksha. Start the festive season by exploring our classroom, project-based IT courses in Rajkot.",
            // Mirrors the offer already shown in the homepage top banner. Set to '' to hide this line.
            'offer'    => 'Get 10% off your first purchase with code CK-10OFF.',

            // CTA destinations (real site pages). Change here if the campaign page changes.
            'primary_label'   => 'Explore Courses',
            'primary_url'     => '/courses/',
            'secondary_label' => 'Book a Free Demo Class',
            'secondary_url'   => '/book-demo/',
        ],
    ],
];
