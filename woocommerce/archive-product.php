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

		$queried_obj = get_queried_object();
		$is_parent_chair = ( is_product_category() && isset( $queried_obj->slug ) && 'chair' === $queried_obj->slug );

		if ( $is_parent_chair ) {
			// Render subcategories separately: Office Chairs then Commercial Chairs
			$children = get_terms( array(
				'taxonomy'   => 'product_cat',
				'parent'     => $queried_obj->term_id,
				'hide_empty' => false,
			) );
			
			if ( ! is_wp_error( $children ) && ! empty( $children ) ) {
				// Reorder children to make sure Office Chairs shows first, then Commercial Chairs
				usort( $children, function( $a, $b ) {
					if ( strpos( $a->slug, 'office' ) !== false ) {
						return -1;
					}
					if ( strpos( $b->slug, 'office' ) !== false ) {
						return 1;
					}
					return 0;
				} );
				
				foreach ( $children as $child ) {
					// Custom loop rendering for each subcategory
					echo '<div class="subcategory-section" style="margin-bottom: 60px;">';
					echo '<h2 class="subcategory-title" style="font-family: \'Cormorant Garamond\', serif; font-size: 2.4rem; font-weight: 500; border-bottom: 1px solid #e5e0d8; padding-bottom: 16px; margin-bottom: 24px; color: #2e2a25; text-transform: capitalize;">' . esc_html( $child->name ) . '</h2>';
					
					// Product Query
					$args = array(
						'post_type'      => 'product',
						'posts_per_page' => -1,
						'post_status'    => 'publish',
						'tax_query'      => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'term_id',
								'terms'    => $child->term_id,
							),
						),
					);
					
					$sub_query = new WP_Query( $args );
					
					if ( $sub_query->have_posts() ) {
						$posts_arr = $sub_query->posts;
						
						if ( strpos( $child->slug, 'office' ) !== false ) {
							// Custom sorting order requested by user:
							// 1. Premium Pure Leather High-Back Executive Chair (oc-77c)
							// 2. Luxury High-Back Leather Executive Chair (oc-70c-black-1, oc-70c-grey-1)
							// 3. J109A (j109a-2)
							// 4. GYHH (gyhh-2)
							// 5. GYHG (gyhg-2)
							// 6. GYH (gyh-2)
							// 7. Ergonomic Mid-Back Office Chair (oc-23b-1, oc-47b-1, oc-50b-black-1, oc-50b-grey-1)
							$order_slugs = array(
								'oc-77c'          => 1,
								'oc-70c-black-1'  => 2,
								'oc-70c-grey-1'   => 3,
								'j109a-2'         => 4,
								'gyhh-2'          => 5,
								'gyhg-2'          => 6,
								'gyh-2'           => 7,
								'oc-23b-1'        => 8,
								'oc-47b-1'        => 9,
								'oc-50b-black-1'  => 10,
								'oc-50b-grey-1'   => 11
							);
							
							usort( $posts_arr, function( $a, $b ) use ( $order_slugs ) {
								$slug_a = $a->post_name;
								$slug_b = $b->post_name;
								
								$rank_a = isset( $order_slugs[ $slug_a ] ) ? $order_slugs[ $slug_a ] : 99;
								$rank_b = isset( $order_slugs[ $slug_b ] ) ? $order_slugs[ $slug_b ] : 99;
								
								if ( $rank_a === $rank_b ) {
									return strcmp( $a->post_title, $b->post_title );
								}
								return $rank_a - $rank_b;
							} );
						}
						
						woocommerce_product_loop_start();
						
						global $post;
						foreach ( $posts_arr as $post_item ) {
							$post = $post_item;
							setup_postdata( $post );
							
							do_action( 'woocommerce_shop_loop' );
							wc_get_template_part( 'content', 'product' );
						}
						
						wp_reset_postdata();
						
						woocommerce_product_loop_end();
					} else {
						echo '<p style="font-family: \'Plus Jakarta Sans\', sans-serif; color: #76726c; font-style: italic;">No products found in this section.</p>';
					}
					
					echo '</div>';
				}
			} else {
				echo '<p style="font-family: \'Plus Jakarta Sans\', sans-serif; color: #76726c; font-style: italic;">No subcategories found.</p>';
			}
		} else {
			// Default WooCommerce loop for all other categories and shop page
			if ( woocommerce_product_loop() ) {
				?>
				<div class="shop-toolbar-header">
					<div class="shop-toolbar-left">
						<div class="view-mode-selector">
							<button class="view-mode-btn grid-mode active" aria-label="Grid View"><i class="ri-grid-fill"></i></button>
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
