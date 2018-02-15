<?php

remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper',       42 );
remove_action( 'storefront_header', 'storefront_primary_navigation',               50 );
remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper_close', 68 );

add_action('seduce_sf_nav', 'storefront_primary_navigation_wrapper', 0);
add_action('seduce_sf_nav', 'storefront_primary_navigation', 10);
add_action('seduce_sf_nav', 'storefront_primary_navigation_wrapper_close', 20);

remove_action('storefront_header', 'storefront_secondary_navigation', 30);
remove_action('storefront_header', 'storefront_product_search', 40);
remove_action('storefront_header', 'storefront_header_cart', 60);

add_action('storefront_header', 'storefront_product_search', 30);
add_action('storefront_header', 'storefront_secondary_navigation', 40);
add_action('storefront_header', 'storefront_header_cart', 60);

remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );