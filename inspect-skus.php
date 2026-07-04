<?php
/**
 * Temporary SKU Inspector Tool.
 * Visit: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/inspect-skus.php?key=great_wall_secret_998
 */

$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if ( ! file_exists( $wp_load_path ) ) {
	die( 'WordPress load file not found.' );
}

require_once $wp_load_path;

if ( ! isset( $_GET['key'] ) || $_GET['key'] !== 'great_wall_secret_998' ) {
	die( 'Unauthorized access.' );
}

$args = array(
	'post_type'      => array('product', 'product_variation'),
	'posts_per_page' => -1,
	'post_status'    => 'any',
);

$query = new WP_Query( $args );

echo '<h1>WooCommerce SKU Coverage Audit</h1>';
echo '<p>Total products/variations found in DB: <strong>' . $query->found_posts . '</strong></p>';
echo '<hr>';

$empty_skus = array();
$filled_skus = array();

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$id = get_the_ID();
		$product = wc_get_product( $id );
		if ( ! $product ) continue;

		$sku = $product->get_sku();
		$title = get_the_title();
		$type = $product->get_type();
		$status = get_post_status();

		if ( empty( $sku ) ) {
			$empty_skus[] = "ID: {$id} | Name: '{$title}' | Type: {$type} | Status: {$status}";
		} else {
			if ( isset( $filled_skus[$sku] ) ) {
				$filled_skus[$sku][] = "ID: {$id} | Name: '{$title}'";
			} else {
				$filled_skus[$sku] = array( "ID: {$id} | Name: '{$title}'" );
			}
		}
	}
	wp_reset_postdata();
}

echo '<h2>1. Products/Variations with Empty SKUs (' . count($empty_skus) . ')</h2>';
if ( ! empty( $empty_skus ) ) {
	echo '<ul>';
	foreach ( $empty_skus as $item ) {
		echo "<li>{$item}</li>";
	}
	echo '</ul>';
} else {
	echo '<p style="color: green;">None! All items have SKUs.</p>';
}

echo '<hr>';

echo '<h2>2. Duplicate SKUs Found</h2>';
$has_duplicates = false;
echo '<ul>';
foreach ( $filled_skus as $sku => $items ) {
	if ( count( $items ) > 1 ) {
		$has_duplicates = true;
		echo "<li>SKU: <strong>'{$sku}'</strong> is shared by " . count($items) . " products:<ul>";
		foreach ($items as $itm) {
			echo "<li>{$itm}</li>";
		}
		echo "</ul></li>";
	}
}
echo '</ul>';

if ( ! $has_duplicates ) {
	echo '<p style="color: green;">None! All SKUs are unique.</p>';
}
