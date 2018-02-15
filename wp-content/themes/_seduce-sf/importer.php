<?php

/**
 *
 * Custom data fields
 *
 * */
// Display Fields
add_action('woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields');
//add_action('woocommerce_product_options_advanced', 'woo_add_custom_advanced_fields');
//add_action( 'woocommerce_variable_product_bulk_edit_actions', 'woo_add_custom_variable_fields' );
// Save Fields
//add_action('woocommerce_process_product_meta', 'woo_add_custom_fields_save');

function woo_add_custom_advanced_fields() {

        global $woocommerce, $post;

        echo '<div class="options_group">';

        // Custom fields will be created here...

        woocommerce_wp_text_input(
                array(
                    'id' => '_htmldesc',
                    'label' => __('Description HTML', 'woocommerce'),
                    'placeholder' => '<br>',
                    'desc_tip' => 'true',
                    'description' => __('HTML formatted description', 'woocommerce')
                )
        );

        echo '</div>';
}

function woo_add_custom_variable_fields() {

        global $woocommerce, $post;

        echo '<div class="options_group">';

        // Custom fields will be created here...

        woocommerce_wp_text_input(
                array(
                    'id' => '_test_variable',
                    'label' => __('Test Variable', 'woocommerce'),
                    'placeholder' => 'test',
                    'desc_tip' => 'true',
                    'description' => __('Testing...', 'woocommerce')
        ));
        echo '</div>';
}

function woo_add_custom_general_fields() {

        global $woocommerce, $post;

        echo '<div class="options_group">';

        // Custom fields will be created here...

        woocommerce_wp_text_input(array(
            'id' => '_trade_price',
            'label' => __('Trade Price', 'woocommerce') . ' (' . get_woocommerce_currency_symbol() . ')',
            'placeholder' => '',
            'desc_tip' => 'true',
            'description' => __('The trade price from the supplier', 'woocommerce'),
            'data_type' => 'price',
        ));

        woocommerce_wp_text_input(array(
            'id' => '_material',
            'label' => __('Material', 'woocommerce'),
            'placeholder' => 'Material',
            'desc_tip' => 'true',
            'description' => __('The material that most of the item is made from', 'woocommerce')
        ));

        // woocommerce_wp_text_input(
        //     array(
        //         'id'          => '_brand',
        //         'label'       => __( 'Brand', 'woocommerce' ),
        //         'placeholder' => 'Brand',
        //         'desc_tip'    => 'true',
        //         'description' => __( 'The company that makes the item', 'woocommerce' )
        //     )
        // );

        echo '</div>';
}

function woo_add_custom_fields_save($post_id) {

        $woocommerce_material_field = $_POST['_material'];
        if (!empty($woocommerce_material_field))
                update_post_meta($post_id, '_material', esc_attr($woocommerce_material_field));

        $woocommerce_trade_field = $_POST['_trade_price'];
        if (!empty($woocommerce_trade_field))
                update_post_meta($post_id, '_trade_price', esc_attr($woocommerce_trade_field));

        // $woocommerce_brand_field = $_POST['_brand'];
        // if( !empty( $woocommerce_brand_field ) )
        //   update_post_meta( $post_id, '_brand', esc_attr( $woocommerce_brand_field ) );
//    $woocommerce_htlmdesc_field = $_POST['_htmldesc'];
//    if (!empty($woocommerce_htlmdesc_field))
//        update_post_meta($post_id, '_htmldesc', esc_attr($woocommerce_htlmdesc_field));
}

/* * ******************************************************
 *
 * Custom data import
 *
 * ********************************************************
 *
 * Register the 'Custom Column' column in the importer.
 *
 * @param array $options
 * @return array $options
 */
function add_columns_to_importer($options) {

        // column slug => column name
        $options['_trade_price'] = 'Trade Price';
        $options['_material'] = 'Material';
        $options['_brand'] = 'Brand';

        return $options;
}

add_filter('woocommerce_csv_product_import_mapping_options', 'add_columns_to_importer');
/**
 * Add automatic mapping support for custom columns.
 * This will automatically select the correct mapping for columns named 'Custom Column' or 'custom column'.
 *
 * @param array $columns
 * @return array $columns
 */
function add_column_to_mapping_screen($columns) {

        // potential column name => column slug
        $columns['Trade Price'] = '_trade_price';
        $columns['Trade price'] = '_trade_price';
        $columns['trade price'] = '_trade_price';

        $columns['Material'] = '_material';
        $columns['material'] = '_material';

        $columns['Brand'] = '_brand';
        $columns['brand'] = '_brand';

        return $columns;
}

add_filter('woocommerce_csv_product_import_mapping_default_columns', 'add_column_to_mapping_screen');
/**
 * Process the data read from the CSV file.
 * This just saves the value in meta data, but you can do anything you want here with the data.
 *
 * @param WC_Product $object - Product being imported or updated.
 * @param array $data - CSV data read for the product.
 * @return WC_Product $object
 */
function process_import($object, $data) {

        if (!empty($data['_trade_price'])) {
                $object->update_meta_data('_trade_price', $data['_trade_price']);
        }
        if (!empty($data['_material'])) {
                $object->update_meta_data('_material', $data['_material']);
        }
        if (!empty($data['_brand'])) {
                $object->update_meta_data('_brand', $data['_brand']);
        }

        return $object;
}

add_filter('woocommerce_product_import_pre_insert_product_object', 'process_import', 10, 2);

/* * ***************************
 *
 * Custom data export
 *
 * *****************************
 *
 * Add the custom column to the exporter and the exporter column menu.
 *
 * @param array $columns
 * @return array $columns
 */
function add_export_column($columns) {

        // column slug => column name
        $columns['_trade_price'] = 'Trade Price';
        $columns['_material'] = 'Material';
        // $columns['_brand'] = 'Brand';

        return $columns;
}

add_filter('woocommerce_product_export_column_names', 'add_export_column');
add_filter('woocommerce_product_export_product_default_columns', 'add_export_column');
/**
 * Provide the data to be exported for one item in the column.
 *
 * @param mixed $value (default: '')
 * @param WC_Product $product
 * @return mixed $value - Should be in a format that can be output into a text file (string, numeric, etc).
 */
/* Export trade price data */
function add_export_data_trade_price($value, $product) {

        $post_ID = $product->get_id();
        if (!$post_ID) {
                $value = -1;
                return $value;
        }
        $value = get_post_meta($post_ID, '_trade_price', true);
        return $value;
}

/* Export material data */
function add_export_data_material($value, $product) {

        $post_ID = $product->get_id();
        if (!$post_ID) {
                $value = -1;
                return $value;
        }
        $value = get_post_meta($post_ID, '_material', true);
        return $value;
}

/* Export brand data */
// function add_export_data_brand( $value, $product ) {
//
//   $post_ID = $product->get_id();
//   if ( !$post_ID ){
//     $value = -1;
//     return $value;
//   }
//   $value = get_post_meta( $post_ID, '_brand', true );
//   return $value;
// }
// Filter you want to hook into will be: 'woocommerce_product_export_product_column_{$column_slug}'.
add_filter('woocommerce_product_export_product_column__trade_price', 'add_export_data_trade_price', 10, 2);
add_filter('woocommerce_product_export_product_column__material', 'add_export_data_material', 10, 2);
// add_filter( 'woocommerce_product_export_product_column__brand', 'add_export_data_brand', 10, 2 );

/* Add to additional info  tab
  <?php   echo get_post_meta( $post->ID, '_material', true );?>
  <?php do_action( 'woocommerce_product_additional_information', $product ); ?> */

// add_action('woocommerce_single_product_summary', 'rwk_get_product_brand', 45);

function rwk_get_product_brand_list($product_id, $sep = ', ', $before = '', $after = '') {
        return get_the_term_list($product_id, '_brand', $before, $sep, $after);
}