<?php
/**
 * Related Products override template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related products" style="margin-top: 80px;">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Complete The Architectural Look', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<div class="section-title-wrapper" style="margin-bottom: 40px;">
				<h2 style="font-size: 1.8rem; font-family: var(--font-serif); font-weight: 400;"><?php echo esc_html( $heading ); ?></h2>
			</div>
		<?php endif; ?>
		
		<div class="grid products-grid">

			<?php foreach ( $related_products as $related_product_item ) : ?>

				<?php
				$related_actual_id = is_object( $related_product_item ) ? $related_product_item->get_id() : $related_product_item;
				$post_object = get_post( $related_actual_id );

				setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

				$product_obj = wc_get_product( $related_actual_id );
				if ( ! $product_obj ) {
					continue;
				}
				$product_image = '';
				$hover_image = '';
				
				// 1. Check if product has a featured image
				$image_id = $product_obj->get_image_id();
				if ( $image_id ) {
					$product_image = wp_get_attachment_image_url( $image_id, 'large' );
				}
				
				// 2. If it is a variable product and has no featured image, check variation images
				if ( ! $product_image && $product_obj->is_type( 'variable' ) ) {
					$variation_ids = $product_obj->get_children();
					foreach ( $variation_ids as $var_id ) {
						$variation = wc_get_product( $var_id );
						if ( $variation && $variation->get_image_id() ) {
							$product_image = wp_get_attachment_image_url( $variation->get_image_id(), 'large' );
							break;
						}
					}
				}
				
				// 3. Check gallery images
				$gallery_image_ids = $product_obj->get_gallery_image_ids();
				if ( $product_image ) {
					// Hover image is the first gallery image if available
					if ( ! empty( $gallery_image_ids ) ) {
						$hover_image = wp_get_attachment_image_url( $gallery_image_ids[0], 'large' );
					}
				} else {
					// Fallback to first gallery image as main image, second as hover
					if ( ! empty( $gallery_image_ids ) ) {
						$product_image = wp_get_attachment_image_url( $gallery_image_ids[0], 'large' );
						if ( count( $gallery_image_ids ) > 1 ) {
							$hover_image = wp_get_attachment_image_url( $gallery_image_ids[1], 'large' );
						}
					} else {
						// Fallback to placeholder
						$product_image = wc_placeholder_img_src();
					}
				}

				// Get the product's actual primary category name natively
				$cat_ids = $product_obj->get_category_ids();
				$cat_label = 'Signature Range';
				if ( ! empty( $cat_ids ) ) {
					$term = get_term_by( 'id', $cat_ids[0], 'product_cat' );
					if ( $term ) {
						$cat_label = $term->name;
					}
				}
				?>
				<div class="product-card">
					<div class="product-img-wrapper" style="height: 280px; overflow: hidden; position: relative;">
						<?php if ( $product_obj->is_on_sale() ) : ?>
							<span class="product-badge sale">Sale</span>
						<?php endif; ?>
						<img src="<?php echo esc_url( $product_image ); ?>" loading="lazy" alt="<?php echo esc_attr( $product_obj->get_name() ); ?>" class="product-img main-img">
						<?php if ( ! empty( $hover_image ) ) : ?>
							<img src="<?php echo esc_url( $hover_image ); ?>" loading="lazy" alt="<?php echo esc_attr( $product_obj->get_name() ); ?>" class="product-img hover-img">
						<?php endif; ?>
						<div class="product-actions">
							<button class="product-action-btn add-to-cart-trigger" 
									data-id="<?php echo esc_attr( $related_actual_id ); ?>" 
									data-title="<?php echo esc_attr( $product_obj->get_name() ); ?>" 
									data-price="<?php echo esc_attr( $product_obj->get_price() ); ?>" 
									data-image="<?php echo esc_url( $product_image ); ?>"
									data-category="<?php echo esc_attr( $cat_label ); ?>"
									title="Add to Shopping Bag">
								<i class="ri-shopping-bag-line"></i>
							</button>
							<a href="<?php echo esc_url( get_permalink( $related_actual_id ) ); ?>" class="product-action-btn" title="View Details"><i class="ri-eye-line"></i></a>
						</div>
					</div>
					<div class="product-info">
						<span class="product-category"><?php echo esc_html( $cat_label ); ?></span>
						<h3 class="product-title" style="font-size: 0.9rem; margin-bottom: 10px;"><a href="<?php echo esc_url( get_permalink( $related_actual_id ) ); ?>"><?php echo esc_html( $product_obj->get_name() ); ?></a></h3>
						<div class="product-meta">
							<div class="product-price"><?php echo wp_kses_post( $product_obj->get_price_html() ); ?></div>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
			
		</div>

	</section>
	<?php
endif;

wp_reset_postdata();
