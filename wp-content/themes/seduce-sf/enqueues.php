<?php

// remove storefront hamburger style
wp_dequeue_style('shm-styles');

// add custom hamburger style
function override_storefront_hamburger_styles () {
        // Register my custom stylesheet
        wp_register_style ( 'custom-styles', get_template_directory_uri () . '/assests/css/hamburger-style.css' );
        // Load my custom stylesheet
        wp_enqueue_style ( 'custom-styles' );
}

add_action ( 'wp_enqueue_scripts', 'override_storefront_hamburger_styles' );

// remove storefront stylesheet so as not to clutter chrome dev tools
/*doesn't work at moment*/
wp_dequeue_style('storefront-style');
