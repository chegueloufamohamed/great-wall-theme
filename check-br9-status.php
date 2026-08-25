<?php
/**
 * Temporary WooCommerce product checker script.
 * Call this by visiting: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/check-br9-status.php?key=great_wall_secret_998
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

echo '<h1>BR-9 Product Check Tool</h1>';
echo '<hr>';

// Query all statuses (publish, draft, private, pending, trash)
$args = array(
	'status' => array( 'publish', 'draft', 'private', 'pending', 'trash' ),
	'limit'  => -1,
);
$products = wc_get_products( $args );

echo '<h3>Matching Products:</h3>';
echo '<ul>';

$found_count = 0;

foreach ( $products as $product ) {
	$title = $product->get_name();
	$sku   = $product->get_sku();
	
	// Check if title or SKU contains BR-9
	if ( stripos( $title, 'BR-9' ) !== false || stripos( $sku, 'BR-9' ) !== false ) {
		$wp_id = $product->get_id();
		$status = $product->get_status();
		$price = $product->get_price();
		$categories = wp_get_post_terms( $wp_id, 'product_cat', array( 'fields' => 'names' ) );
		
		echo "<li>";
		echo "<strong>Name:</strong> " . esc_html( $title ) . "<br>";
		echo "<strong>ID:</strong> " . $wp_id . "<br>";
		echo "<strong>SKU:</strong> '" . esc_html( str_replace("\n", '\n', $sku) ) . "'<br>";
		echo "<strong>Status:</strong> <span style='color: " . ( $status === 'publish' ? 'green' : 'red' ) . "; font-weight: bold;'>" . esc_html( $status ) . "</span><br>";
		echo "<strong>Price:</strong> " . esc_html( $price ) . "<br>";
		echo "<strong>Categories:</strong> " . esc_html( implode( ', ', $categories ) ) . "<br>";
		echo "</li><br>";
		$found_count++;
	}
}

echo '</ul>';
echo '<hr>';
echo "<p>Total matching products found in database: <strong>" . $found_count . "</strong></p>";
