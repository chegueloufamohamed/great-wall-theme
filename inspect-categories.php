<?php
/**
 * Temporary Category Inspector.
 * Visit: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/inspect-categories.php?key=great_wall_secret_998
 */

$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if ( ! file_exists( $wp_load_path ) ) {
	die( 'WordPress load file not found.' );
}

require_once $wp_load_path;

if ( ! isset( $_GET['key'] ) || $_GET['key'] !== 'great_wall_secret_998' ) {
	die( 'Unauthorized access.' );
}

$categories = get_terms( array(
	'taxonomy'   => 'product_cat',
	'hide_empty' => false,
) );

echo '<h1>WooCommerce Product Categories</h1>';
echo '<ul>';
foreach ( $categories as $cat ) {
	echo "<li>ID: <strong>{$cat->term_id}</strong> | Name: '<strong>{$cat->name}</strong>' | Slug: '{$cat->slug}' | Count: {$cat->count}</li>";
}
echo '</ul>';
