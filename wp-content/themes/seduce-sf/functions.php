<?php

/**
 * Storefront engine room
 *
 * @package storefront
 */
/**
 * Includes files
 * Comment out tests.php when we don't need it
 */
require_once 'enqueues.php';
//require_once 'tests.php';
//require_once 'importer.php';
require_once 'hamburger_menu.php';

/**
 * Assign the Storefront version to a variable
 */
$theme = wp_get_theme ( 'storefront' );
$storefront_version = $theme[ 'Version' ];

/**
 * turns off the side bar on the main shop page only
 * @param type $is_active_sidebar boolean from is_active_sidebar filter
 * @param type $index sidebar name or id
 * @return boolean false to not use the sidebar
 */
function rwk_remove_sidebar ( $is_active_sidebar, $index ) {
        if ( $index !== "sidebar-1" ) {
                return $is_active_sidebar;
        }

        if ( ! is_shop () ) {
                return $is_active_sidebar;
        }

        return false;
}

add_filter ( 'is_active_sidebar', 'rwk_remove_sidebar', 10, 2 );

/**
 * swap out the default storefront navigation.js for custom one
 * custom file allows mobile menu to function from the footer bar
 */
function rwk_change_navigation_script () {
        wp_dequeue_script ( 'storefront-navigation' );
        wp_enqueue_script ( 'seduce-sf-navigation', get_stylesheet_directory_uri () . '/assets/js/navigation.js', array ( 'jquery' ) );
}

add_action ( 'wp_enqueue_scripts', 'rwk_change_navigation_script', 100 );



