<?php
/**
 * Temporary product counter script.
 * Visit: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/count-all-wp-products.php?key=great_wall_secret_998
 */

$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if ( ! file_exists( $wp_load_path ) ) {
	die( 'WordPress load file not found.' );
}

require_once $wp_load_path;

if ( ! isset( $_GET['key'] ) || $_GET['key'] !== 'great_wall_secret_998' ) {
	die( 'Unauthorized access.' );
}

// Query all product posts regardless of status
$args = array(
	'post_type'      => 'product',
	'posts_per_page' => -1,
	'post_status'    => 'any',
);

$query = new WP_Query( $args );

echo '<h1>Live WooCommerce Products Status</h1>';
echo '<p>Total products in database: <strong>' . $query->found_posts . '</strong></p>';

$status_counts = array();
$products_by_status = array();

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$status = get_post_status();
		$status_counts[$status] = isset($status_counts[$status]) ? $status_counts[$status] + 1 : 1;
		$products_by_status[$status][] = get_the_title() . ' (ID: ' . get_the_ID() . ')';
	}
	wp_reset_postdata();
}

echo '<h2>Counts by Status:</h2>';
echo '<ul>';
foreach ($status_counts as $status => $count) {
	echo "<li>Status <strong>{$status}</strong>: {$count} products</li>";
}
echo '</ul>';

echo '<hr>';
echo '<h2>First 50 Products:</h2>';
echo '<ol>';
$count = 0;
foreach ($products_by_status as $status => $list) {
	foreach ($list as $item) {
		if ($count >= 50) break 2;
		echo "<li>[{$status}] {$item}</li>";
		$count++;
	}
}
echo '</ol>';
