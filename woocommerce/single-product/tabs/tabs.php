<?php
/**
 * Single Product Tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="product-tabs-outer-container" style="max-width: 1000px; margin: 0 auto; padding: 0 20px;">
	
	<!-- 1. Render Standalone Reviews Section at the top (before the Description/Specs tabs) -->
	<?php if ( comments_open() ) : ?>
		<div class="product-reviews-standalone-section" style="margin-bottom: 50px; text-align: center;">
			<?php comments_template(); ?>
		</div>
	<?php endif;

	/**
	 * Filter tabs and allow third parties to add their own.
	 *
	 * Each tab is an array containing title, callback and priority.
	 *
	 * @see woocommerce_default_product_tabs()
	 */
	$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

	if ( ! empty( $product_tabs ) ) : ?>

		<div class="woocommerce-tabs wc-tabs-wrapper" style="text-align: center !important;">
			<ul class="tabs wc-tabs" role="tablist">
				<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
					<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
						<a href="#tab-<?php echo esc_attr( $key ); ?>">
							<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-product_specifications">
					<?php
					if ( isset( $product_tab['callback'] ) ) {
						call_user_func( $product_tab['callback'], $key, $product_tab );
					}
					?>
				</div>
			<?php endforeach; ?>

			<?php do_action( 'woocommerce_product_after_tabs' ); ?>
		</div>

	<?php endif; ?>
</div>
