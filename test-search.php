<?php
/**
 * Temporary search debugger script.
 * Call this by visiting: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/test-search.php?key=great_wall_secret_998&s=OB-10
 */

$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if ( ! file_exists( $wp_load_path ) ) {
	die( 'WordPress load file not found at: ' . $wp_load_path );
}

require_once $wp_load_path;

if ( ! isset( $_GET['key'] ) || $_GET['key'] !== 'great_wall_secret_998' ) {
	die( 'Unauthorized access.' );
}

$s = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : 'OB-10';

echo '<h1>Search Debugger</h1>';
echo '<p>Searching for: <strong>' . esc_html($s) . '</strong></p>';
echo '<hr>';

// Run WP_Query for products with search term
$args = array(
	'post_type'      => 'product',
	's'              => $s,
	'posts_per_page' => -1,
	'post_status'    => 'publish'
);

$query = new WP_Query( $args );

echo '<h3>Generated Search Terms:</h3>';
echo '<pre>';
print_r( $query->get( 'search_terms' ) );
echo '</pre>';
echo '<hr>';

echo '<h3>Query SQL:</h3>';
echo '<pre>' . esc_html( $query->request ) . '</pre>';
echo '<hr>';

echo '<h3>Matching Products Found (' . $query->found_posts . '):</h3>';
echo '<ul>';
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$product = wc_get_product( get_the_ID() );
		echo '<li>';
		echo '<strong>Name:</strong> ' . esc_html( get_the_title() ) . '<br>';
		echo '<strong>ID:</strong> ' . get_the_ID() . '<br>';
		echo '<strong>SKU:</strong> ' . esc_html( $product->get_sku() ) . '<br>';
		echo '<strong>Catalog Visibility:</strong> ' . esc_html( $product->get_catalog_visibility() ) . '<br>';
		echo '<strong>Status:</strong> ' . esc_html( get_post_status() ) . '<br>';
		echo '</li><br>';
	}
	wp_reset_postdata();
} else {
	echo '<li>No products found.</li>';
}
echo '</ul>';
