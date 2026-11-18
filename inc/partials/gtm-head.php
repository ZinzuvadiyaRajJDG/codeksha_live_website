<?php
/* Google Tag Manager (head part). Container ID lives here only; GA4 is configured inside GTM.
   Not loaded when the visitor rejected non-essential cookies in the consent banner. */
if (($_COOKIE['ck_consent'] ?? '') !== 'essential'):
?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-P83GZKCT');</script>
    <!-- End Google Tag Manager -->
    <script src="/assets/events.js?v=<?= (int) @filemtime(__DIR__ . "/../../assets/events.js") ?>" defer></script>
<?php endif; ?>
