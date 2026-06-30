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

			<?php foreach ( $related_products as $related_product_id ) : ?>

				<?php
				$post_object = get_post( $related_product_id );

				setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

				$product_obj = wc_get_product( $related_product_id );
				if ( ! $product_obj ) {
					continue;
				}
				$product_image = get_the_post_thumbnail_url( $related_product_id, 'large' );
				if ( ! $product_image ) {
					$gallery_image_ids = $product_obj->get_gallery_image_ids();
					if ( ! empty( $gallery_image_ids ) ) {
						$product_image = wp_get_attachment_image_url( $gallery_image_ids[0], 'large' );
					}
				}
				if ( ! $product_image ) {
					$product_image = get_template_directory_uri() . '/assets/images/designer_chair.webp'; // default fallback
				}
				?>
				<div class="product-card">
					<div class="product-img-wrapper" style="height: 280px; overflow: hidden; position: relative;">
						<?php if ( $product_obj->is_on_sale() ) : ?>
							<span class="product-badge sale">Sale</span>
						<?php endif; ?>
						<img src="<?php echo esc_url( $product_image ); ?>" loading="lazy" alt="<?php echo esc_attr( $product_obj->get_name() ); ?>" class="product-img main-img">
						<div class="product-actions">
							<button class="product-action-btn add-to-cart-trigger" 
									data-id="<?php echo esc_attr( $related_product_id ); ?>" 
									data-title="<?php echo esc_attr( $product_obj->get_name() ); ?>" 
									data-price="<?php echo esc_attr( $product_obj->get_price() ); ?>" 
									data-image="<?php echo esc_url( $product_image ); ?>"
									data-category="Furniture"
									title="Add to Shopping Bag">
								<i class="ri-shopping-bag-line"></i>
							</button>
							<a href="<?php echo esc_url( get_permalink( $related_product_id ) ); ?>" class="product-action-btn" title="View Details"><i class="ri-eye-line"></i></a>
						</div>
					</div>
					<div class="product-info">
						<span class="product-category">Signature Range</span>
						<h3 class="product-title" style="font-size: 0.9rem; margin-bottom: 10px;"><a href="<?php echo esc_url( get_permalink( $related_product_id ) ); ?>"><?php echo esc_html( $product_obj->get_name() ); ?></a></h3>
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
