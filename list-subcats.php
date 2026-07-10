<?php
/**
 * Subcategory Slug Finder.
 * Visit: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/list-subcats.php?key=great_wall_secret_998
 */

$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if ( ! file_exists( $wp_load_path ) ) {
	die( 'WordPress load file not found.' );
}

require_once $wp_load_path;

if ( ! isset( $_GET['key'] ) || $_GET['key'] !== 'great_wall_secret_998' ) {
	die( 'Unauthorized access.' );
}

$parent = get_term_by( 'slug', 'chair', 'product_cat' );
if ( ! $parent ) {
	die( 'Parent category "chair" not found.' );
}

$children = get_terms( array(
	'taxonomy'   => 'product_cat',
	'parent'     => $parent->term_id,
	'hide_empty' => false,
) );

echo '<h1>Child Categories of Chair (ID: ' . $parent->term_id . ')</h1>';
echo '<ul>';
foreach ( $children as $child ) {
	echo "<li>ID: <strong>{$child->term_id}</strong> | Name: '<strong>{$child->name}</strong>' | Slug: '<strong>{$child->slug}</strong>' | Count: {$child->count}</li>";
}
echo '</ul>';
