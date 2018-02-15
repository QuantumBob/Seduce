<?php

add_filter ( 'storefront_menu_toggle_text', 'rwk_storefront_menu_toggle_text' );

function rwk_storefront_menu_toggle_text ( $text ) {
        $text = __ ( '' );
        return $text;
}

if ( ! function_exists ( 'storefront_handheld_footer_bar' ) ) {

        /**
         * Display a menu intended for use on hand held devices
         *
         * @since 2.0.0
         */
        function storefront_handheld_footer_bar () {
                $links = array (
                    'my-account' => array (
                        'priority' => 10,
                        'callback' => 'storefront_handheld_footer_bar_account_link',
                    ),
                    'search' => array (
                        'priority' => 20,
                        'callback' => 'storefront_handheld_footer_bar_search',
                    ),
                    'cart' => array (
                        'priority' => 30,
                        'callback' => 'storefront_handheld_footer_bar_cart_link',
                    ),
                    'menu' => array (
                        'priority' => 40,
                        'callback' => 'storefront_handheld_footer_bar_menu_link',
                    ),
                );

                if ( wc_get_page_id ( 'myaccount' ) === -1 ) {
                        unset ( $links[ 'my-account' ] );
                }

                if ( wc_get_page_id ( 'cart' ) === -1 ) {
                        unset ( $links[ 'cart' ] );
                }

                $links = apply_filters ( 'storefront_handheld_footer_bar_links', $links );

                ?>
                <div class="storefront-handheld-footer-bar">
                        <ul class="columns-<?php echo count ( $links ); ?>">
                                        <?php foreach ( $links as $key => $link ) : ?>
                                        <li class="<?php echo esc_attr ( $key ); ?>">
                                                <?php

                                                if ( $link[ 'callback' ] ) {
                                                        call_user_func ( $link[ 'callback' ], $key, $link );
                                                }

                                                ?>
                                        </li>
                <?php endforeach; ?>
                        </ul>
                </div>
                <?php

        }

}

if ( ! function_exists ( 'storefront_handheld_footer_bar_menu_link' ) ) {

        /**
         * The menu callback function for the hand held footer bar
         *
         * @since 2.0.0
         */
        function storefront_handheld_footer_bar_menu_link () {

                ?>

                <button id="footer_hamburger" class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><span></span></button>

                <?php

        }

}

if ( ! function_exists ( 'storefront_primary_navigation' ) ) {

        /**
         * Display Primary Navigation
         *
         * @since  1.0.0
         * @return void
         */
        function storefront_primary_navigation () {

                ?>
                <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e ( 'Primary Navigation', 'storefront' ); ?>">

                        <?php

                        wp_nav_menu (
                                array (
                                    'theme_location' => 'primary',
                                    'container_class' => 'primary-navigation',
                                )
                        );

                        ?>

                <?php

                wp_nav_menu (
                        array (
                            'theme_location' => 'handheld',
                            'container_class' => 'handheld-navigation',
                        )
                );

                ?>
                </nav><!-- #site-navigation -->
                <?php

        }

}

