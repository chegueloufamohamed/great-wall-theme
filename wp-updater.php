<?php
/**
 * Generic Product Database Updater API
 */

// Secure with token check
if ( ! isset( $_POST['token'] ) || $_POST['token'] !== 'greatwall_secret_9988' ) {
    header( 'HTTP/1.1 403 Forbidden' );
    die( 'Access Denied.' );
}

// Check required inputs
if ( empty( $_POST['sku'] ) || empty( $_POST['description'] ) || empty( $_POST['specs'] ) ) {
    header( 'HTTP/1.1 400 Bad Request' );
    die( 'Error: Missing required parameters (sku, description, specs).' );
}

// Bootstrap WordPress
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';

if ( ! function_exists( 'wc_get_product_id_by_sku' ) ) {
    die( "Error: WooCommerce is not loaded." );
}

$sku = sanitize_text_field( $_POST['sku'] );
$product_id = wc_get_product_id_by_sku( $sku );

if ( ! $product_id ) {
    die( "Error: Product with SKU {$sku} not found." );
}

// Update the Description (wp_kses_post or direct update since we trust this source)
$update_post = array(
    'ID'           => $product_id,
    'post_content' => $_POST['description'],
);

$post_updated = wp_update_post( $update_post, true );

if ( is_wp_error( $post_updated ) ) {
    die( "Error updating product description: " . $post_updated->get_error_message() );
}

// Update the Specifications Meta
update_post_meta( $product_id, '_product_specs', $_POST['specs'] );

echo "SUCCESS: Product SKU {$sku} (ID {$product_id}) description and specifications updated successfully!";
