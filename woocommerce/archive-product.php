<?php
/**
 * Custom WooCommerce Archive Product Template
 *
 * @package great-wall-theme
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked great_wall_shop_hero_banner - 9
 * @hooked great_wall_wrapper_start - 10
 */
do_action( 'woocommerce_before_main_content' );
?>

<div class="shop-layout">
	<!-- Left Sidebar Filters -->
	<aside class="shop-sidebar">
		<?php get_template_part( 'template-parts/shop', 'filters' ); ?>
	</aside>

	<!-- Right Shop Main Content -->
	<div class="shop-main-content">
		<?php
		// Output WooCommerce notices (e.g. success messages) at the top of the grid
		if ( function_exists( 'woocommerce_output_all_notices' ) ) {
			woocommerce_output_all_notices();
		}

		if ( woocommerce_product_loop() ) {
			?>
			<div class="shop-toolbar-header">
				<div class="shop-toolbar-left">
					<div class="view-mode-selector">
						<button class="view-mode-btn grid-mode active" aria-label="Grid View"><i class="ri-grid-fill"></i></button>
						<button class="view-mode-btn list-mode" aria-label="List View"><i class="ri-list-check"></i></button>
					</div>
					<?php woocommerce_result_count(); ?>
				</div>
				<div class="shop-toolbar-right">
					<?php woocommerce_catalog_ordering(); ?>
				</div>
			</div>

			<?php
			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();

			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action( 'woocommerce_no_products_found' );
		}
		?>
	</div>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked great_wall_wrapper_end - 10
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
