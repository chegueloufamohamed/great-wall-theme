<?php
/**
 * Temporary WooCommerce product status updater script.
 * Call this by visiting: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/draft-no-price-products.php?key=great_wall_secret_998
 */

// Prevent directory traversal or direct load outside WP
$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if ( ! file_exists( $wp_load_path ) ) {
	die( 'WordPress load file not found at: ' . $wp_load_path );
}

require_once $wp_load_path;

// Secure access key
if ( ! isset( $_GET['key'] ) || $_GET['key'] !== 'great_wall_secret_998' ) {
	die( 'Unauthorized access.' );
}

echo '<h1>WooCommerce Draft No-Price Products Tool</h1>';
echo '<p>Scanning products...</p>';
echo '<hr>';

// Get all currently published and private products
$args = array(
	'status' => array( 'publish', 'private' ),
	'limit'  => -1,
);
$products = wc_get_products( $args );

echo '<p>Checking ' . count( $products ) . ' products...</p>';
echo '<ul>';

$success_count = 0;

foreach ( $products as $product ) {
	$price = $product->get_price();
	
	// Check if the price is empty, null, or zero/negative
	if ( $price === '' || $price === null || ( is_numeric( $price ) && (float) $price <= 0 ) ) {
		$wp_id = $product->get_id();
		$title = $product->get_name();
		
		// Set status to draft
		$product->set_status( 'draft' );
		$product->save();
		
		echo "<li style='color: orange;'>Drafted: <strong>" . esc_html( $title ) . "</strong> (ID: " . $wp_id . ") - Price is empty or invalid (" . esc_html( $price ) . ")</li>";
		$success_count++;
	}
}

echo '</ul>';
echo '<hr>';
echo "<h2>Operation Complete!</h2>";
echo "<p>Successfully drafted: <strong>" . $success_count . "</strong> products.</p>";
