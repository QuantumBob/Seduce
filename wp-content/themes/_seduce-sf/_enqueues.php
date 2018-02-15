<?php

/**
 * Enqueue the parent theme
 * */
//function my_theme_enqueue_styles() {
//
//        $parent_style = 'storefront-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
//
//        wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
//        wp_enqueue_style('storefront-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style), wp_get_theme()->get('Version')
//        );
//}
//
//add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

/**
 * swap out the default storefront navigation.js for custom one
 * custom file allows mobile menu to function from the footer bar
 */
function rwk_change_navigation_script() {
        wp_dequeue_script('storefront-navigation');
        wp_enqueue_script('seduce-sf-navigation', get_stylesheet_directory_uri() . '/assets/js/navigation.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'rwk_change_navigation_script', 100);
