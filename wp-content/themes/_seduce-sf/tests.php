<?php
/* * *****************************************
 *
 * Testing
 *
 * ****************************************** */
//add_action('storefront_header', 'rwk_header_test', 65);
//
//if (!function_exists('rwk_header_test')) {
//
//        function rwk_header_test() {
//                echo '<p>  <font color="#ff0000">Test in child functions.php</font></p>';
//        }
//
//}

if (!function_exists('storefront_header_cart')) {

        /**
         * Display Header Cart
         *
         * @since  1.0.0
         * @uses  storefront_is_woocommerce_activated() check if WooCommerce is activated
         * @return void
         */
        function storefront_header_cart() {
                if (storefront_is_woocommerce_activated()) {
                        if (is_cart()) {
                                $class = 'current-menu-item';
                        } else {
                                $class = '';
                        }
                        ?>
                        <ul id="site-header-cart" class="site-header-cart menu">
                                <li class="<?php echo esc_attr($class); ?>">
                                        <?php storefront_cart_link(); ?>
                                </li>
                                <li>
                                        <?php the_widget('WC_Widget_Cart', 'title='); ?>
                                </li>
                                <li>
                                        <?php // echo '<p>  <font color="#00ff00">Test overriding sf-woo-template-funcs</font></p>'; ?>
                                </li>
                        </ul>
                        <?php
                }
        }

}