<?php
/**
 * Temporary Category Inspector (JSON).
 * Visit: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/inspect-categories.php?key=great_wall_secret_998
 */

$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if ( ! file_exists( $wp_load_path ) ) {
	die( json_encode( array( 'error' => 'WordPress load file not found.' ) ) );
}

require_once $wp_load_path;

if ( ! isset( $_GET['key'] ) || $_GET['key'] !== 'great_wall_secret_998' ) {
	die( json_encode( array( 'error' => 'Unauthorized access.' ) ) );
}

$categories = get_terms( array(
	'taxonomy'   => 'product_cat',
	'hide_empty' => false,
) );

$output = array();
foreach ( $categories as $cat ) {
	$output[] = array(
		'id'    => $cat->term_id,
		'name'  => $cat->name,
		'slug'  => $cat->slug,
		'count' => $cat->count
	);
}

header('Content-Type: application/json');
echo json_encode( $output, JSON_PRETTY_PRINT );
