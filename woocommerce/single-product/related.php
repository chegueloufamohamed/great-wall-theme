<?php
/**
 * Related Products override template
 *
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$current_product_id = get_the_ID();
$terms = get_the_terms( $current_product_id, 'product_cat' );
$active_core_key = '';
$active_cat_name = '';

$core_categories = array(
	'chairs'          => array( 'slug' => 'chairs', 'name' => 'Chairs' ),
	'desks'           => array( 'slug' => 'desks', 'name' => 'Desks' ),
	'storage-cabinet' => array( 'slug' => 'storage-cabinet', 'name' => 'Storage Cabinet' ),
	'sofa'            => array( 'slug' => 'sofa', 'name' => 'Sofa' )
);

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
	foreach ( $terms as $term ) {
		$slug = strtolower( $term->slug );
		if ( strpos( $slug, 'chair' ) !== false ) {
			$active_core_key = 'chairs';
			$active_cat_name = $term->name;
			break;
		} elseif ( strpos( $slug, 'desk' ) !== false ) {
			$active_core_key = 'desks';
			$active_cat_name = $term->name;
			break;
		} elseif ( strpos( $slug, 'storage' ) !== false || strpos( $slug, 'cabinet' ) !== false ) {
			$active_core_key = 'storage-cabinet';
			$active_cat_name = $term->name;
			break;
		} elseif ( strpos( $slug, 'sofa' ) !== false ) {
			$active_core_key = 'sofa';
			$active_cat_name = $term->name;
			break;
		}
	}
	
	if ( empty( $active_core_key ) ) {
		foreach ( $terms as $term ) {
			if ( 'uncategorized' !== $term->slug ) {
				$active_core_key = $term->slug;
				$active_cat_name = $term->name;
				break;
			}
		}
	}
}

// Build the ordered category sequence (current category first, then remaining three core categories)
$ordered_categories = array();

if ( ! empty( $active_core_key ) ) {
	$ordered_categories[] = array(
		'slug'  => $active_core_key,
		'name'  => $active_cat_name,
		'title' => sprintf( esc_html__( 'Explore More %s', 'great-wall-theme' ), $active_cat_name )
	);
	
	$order_list = array( 'chairs', 'desks', 'storage-cabinet', 'sofa' );
	foreach ( $order_list as $key ) {
		if ( $key === $active_core_key || ( 'chairs' === $key && strpos( $active_core_key, 'chair' ) !== false ) || ( 'desks' === $key && strpos( $active_core_key, 'desk' ) !== false ) ) {
			continue;
		}
		$ordered_categories[] = array(
			'slug'  => $core_categories[ $key ]['slug'],
			'name'  => $core_categories[ $key ]['name'],
			'title' => sprintf( esc_html__( 'Complete The Look: %s', 'great-wall-theme' ), $core_categories[ $key ]['name'] )
		);
	}
} else {
	$ordered_categories[] = array( 'slug' => 'chairs', 'name' => 'Chairs', 'title' => 'Explore More Chairs' );
	$ordered_categories[] = array( 'slug' => 'desks', 'name' => 'Desks', 'title' => 'Complete The Look: Desks' );
	$ordered_categories[] = array( 'slug' => 'storage-cabinet', 'name' => 'Storage Cabinet', 'title' => 'Complete The Look: Storage Cabinet' );
	$ordered_categories[] = array( 'slug' => 'sofa', 'name' => 'Sofa', 'title' => 'Complete The Look: Sofa' );
}

$collections = array();
foreach ( $ordered_categories as $oc ) {
	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => 6,
		'post__not_in'   => array( $current_product_id ),
		'tax_query'      => array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $oc['slug'],
			),
		),
		'orderby'        => 'date',
		'order'          => 'DESC',
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		$collections[] = array(
			'title' => $oc['title'],
			'query' => $query,
		);
	}
}

if ( ! empty( $collections ) ) : ?>

	<section class="related products" style="margin-top: 80px;">

		<div class="section-title-wrapper" style="margin-bottom: 50px; text-align: center;">
			<h2 style="font-size: 2.2rem; font-family: var(--font-serif); font-weight: 400; color: #000; letter-spacing: -0.02em;"><?php esc_html_e( 'You may also like', 'great-wall-theme' ); ?></h2>
		</div>

		<?php foreach ( $collections as $collection ) : ?>
			<div class="related-collection-block" style="margin-bottom: 60px;">
				<h3 class="collection-slider-title" style="font-size: 0.95rem; font-family: var(--font-sans); font-weight: 700; color: #8c8476; margin-bottom: 25px; letter-spacing: 0.08em; text-transform: uppercase;">
					<?php echo esc_html( $collection['title'] ); ?>
				</h3>
				
				<div class="related-collection-slider">
					<?php 
					while ( $collection['query']->have_posts() ) : 
						$collection['query']->the_post();
						global $product;
						if ( ! $product ) {
							continue;
						}
						
						$product_image = '';
						$hover_image = '';
						
						$image_id = $product->get_image_id();
						if ( $image_id ) {
							$product_image = wp_get_attachment_image_url( $image_id, 'large' );
						}
						
						if ( ! $product_image && $product->is_type( 'variable' ) ) {
							$variation_ids = $product->get_children();
							foreach ( $variation_ids as $var_id ) {
								$variation = wc_get_product( $var_id );
								if ( $variation && $variation->get_image_id() ) {
									$product_image = wp_get_attachment_image_url( $variation->get_image_id(), 'large' );
									break;
								}
							}
						}
						
						$gallery_image_ids = $product->get_gallery_image_ids();
						if ( $product_image ) {
							if ( ! empty( $gallery_image_ids ) ) {
								$hover_image = wp_get_attachment_image_url( $gallery_image_ids[0], 'large' );
							}
						} else {
							if ( ! empty( $gallery_image_ids ) ) {
								$product_image = wp_get_attachment_image_url( $gallery_image_ids[0], 'large' );
								if ( count( $gallery_image_ids ) > 1 ) {
									$hover_image = wp_get_attachment_image_url( $gallery_image_ids[1], 'large' );
								}
							} else {
								$product_image = wc_placeholder_img_src();
							}
						}

						$cat_ids = $product->get_category_ids();
						$cat_label = 'Signature Range';
						if ( ! empty( $cat_ids ) ) {
							$term = get_term_by( 'id', $cat_ids[0], 'product_cat' );
							if ( $term ) {
								$cat_label = $term->name;
							}
						}
						?>
						<div class="product-card">
							<div class="product-img-wrapper" style="position: relative; overflow: hidden;">
								<?php
								$rel_name = esc_js( $product->get_name() );
								$rel_price = esc_js( strip_tags( $product->get_price_html() ) );
								$rel_img = $image_id ? esc_url( wp_get_attachment_image_url( $image_id, 'thumbnail' ) ) : esc_url( wc_placeholder_img_src( 'thumbnail' ) );
								$rel_link = esc_url( get_permalink() );
								?>
								<button type="button" class="btn-wishlist-toggle card-wishlist-btn" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>" data-product-name="<?php echo esc_attr( $rel_name ); ?>" data-product-price="<?php echo esc_attr( $rel_price ); ?>" data-product-img="<?php echo esc_attr( $rel_img ); ?>" data-product-link="<?php echo esc_attr( $rel_link ); ?>" title="<?php esc_attr_e( 'Add to Wishlist', 'great-wall-theme' ); ?>">
									<i class="ri-heart-line wishlist-icon"></i>
								</button>
								<img src="<?php echo esc_url( $product_image ); ?>" loading="lazy" alt="<?php echo esc_attr( $product->get_name() ); ?>" class="product-img main-img">
								<?php if ( ! empty( $hover_image ) ) : ?>
									<img src="<?php echo esc_url( $hover_image ); ?>" loading="lazy" alt="<?php echo esc_attr( $product->get_name() ); ?>" class="product-img hover-img">
								<?php endif; ?>
								<div class="product-actions">
									<button class="product-action-btn add-to-cart-trigger" 
											data-id="<?php echo esc_attr( $product->get_id() ); ?>" 
											data-title="<?php echo esc_attr( $product->get_name() ); ?>" 
											data-price="<?php echo esc_attr( $product->get_price() ); ?>" 
											data-image="<?php echo esc_url( $product_image ); ?>"
											data-category="<?php echo esc_attr( $cat_label ); ?>"
											title="Add to Shopping Bag">
										<i class="ri-shopping-bag-line"></i>
									</button>
									<a href="<?php echo esc_url( get_permalink() ); ?>" class="product-action-btn" title="View Details"><i class="ri-eye-line"></i></a>
								</div>
							</div>
							<div class="product-info">
								<span class="product-category"><?php echo esc_html( $cat_label ); ?></span>
								<h3 class="product-title" style="font-size: 0.9rem; margin-bottom: 10px;"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( $product->get_name() ); ?></a></h3>
								<div class="product-meta">
									<div class="product-price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
								</div>
								<div class="card-free-shipping-badge" data-tooltip="For Dubai • Sharjah • Ajman">
									<i class="ri-truck-fill"></i>
									<span><?php esc_html_e( 'Free Shipping and Fixing', 'great-wall-theme' ); ?></span>
								</div>
							</div>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
		<?php endforeach; ?>

	</section>

<?php endif; ?>
