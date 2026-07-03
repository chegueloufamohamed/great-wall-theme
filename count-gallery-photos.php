<?php
/**
 * Temporary gallery counter script.
 * Visit: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/count-gallery-photos.php?key=great_wall_secret_998
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
	'post_type'      => 'product',
	'posts_per_page' => -1,
	'post_status'    => 'publish',
);

$query = new WP_Query( $args );

$zero_photos = 0;
$one_photo = 0;
$multi_photos = 0;

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$product = wc_get_product( get_the_ID() );
		if ( ! $product ) continue;

		$featured_id = $product->get_image_id();
		$gallery_ids = $product->get_gallery_image_ids();

		$total_images = 0;
		if ( ! empty( $featured_id ) ) {
			$total_images += 1;
		}
		if ( ! empty( $gallery_ids ) && is_array( $gallery_ids ) ) {
			$total_images += count( $gallery_ids );
		}

		if ( $total_images == 0 ) {
			$zero_photos++;
		} elseif ( $total_images == 1 ) {
			$one_photo++;
		} else {
			$multi_photos++;
		}
	}
	wp_reset_postdata();
}

echo "Total published products: " . $query->found_posts . "\n";
echo "Zero photos: " . $zero_photos . "\n";
echo "Exactly one photo: " . $one_photo . "\n";
echo "Multiple photos: " . $multi_photos . "\n";
