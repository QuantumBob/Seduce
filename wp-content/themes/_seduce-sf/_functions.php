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
require_once 'tests.php';
require_once 'importer.php';
require_once 'hamburger_menu.php';

/**
 * Assign the Storefront version to a var
 */
$theme = wp_get_theme('storefront');
$storefront_version = $theme['Version'];
//add_action('get_header', 'remove_storefront_sidebar');
//function remove_storefront_sidebar() {
//        if (is_shop()) {
//                remove_action('storefront_sidebar', 'storefront_get_sidebar', 10);
//        }
//}

function rwk_remove_sidebar($is_active_sidebar, $index) {
        if ($index !== "sidebar-1") {
                return $is_active_sidebar;
        }

        if (!is_shop()) {
                return $is_active_sidebar;
        }
        
        return false;
}

add_filter('is_active_sidebar', 'rwk_remove_sidebar', 10, 2);
