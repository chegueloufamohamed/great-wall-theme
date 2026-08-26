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

		// Predefined order of category sections requested by the user
		$preferred_order = array(
			'desks', 'workstations', 'storage-cabinet', 'drawer-cabinet', 'cabinet', 'steel-storage', 'steel-storage-and-lockers',
			'office-chairs', 'commercial-chairs', 'sofa', 'bed-frames', 'bunk-beds', 'court-hanger', 'hanger-stands', 'hanger', 'hangers',
			'partition-stands', 'foldable-room-divider', 'reception-lounge-set', 'shelves', 'single-beds', 'coffee-tables', 'coffee-table',
			'conference-tables', 'conference-table', 'dinning-tables', 'dining-tables', 'folding-tables', 'folding-table'
		);

		// Helper function to build custom query args with active filters
		if ( ! function_exists( 'great_wall_get_filtered_product_query_args' ) ) {
			function great_wall_get_filtered_product_query_args( $cat_slug ) {
				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => -1,
					'post_status'    => 'publish',
					'tax_query'      => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'slug',
							'terms'    => $cat_slug,
						),
					),
					'meta_query'     => array(
						'relation' => 'AND',
					),
				);

				// 1. Price Filters
				$min_price = isset( $_GET['min_price'] ) ? intval( $_GET['min_price'] ) : 0;
				$max_price = isset( $_GET['max_price'] ) ? intval( $_GET['max_price'] ) : 999999;
				if ( $min_price > 0 || $max_price < 999999 ) {
					$args['meta_query'][] = array(
						'key'     => '_price',
						'value'   => array( $min_price, $max_price ),
						'compare' => 'BETWEEN',
						'type'    => 'NUMERIC',
					);
				}

				// 2. Attribute Color Filters
				if ( isset( $_GET['filter_color'] ) ) {
					$color = sanitize_text_field( $_GET['filter_color'] );
					$args['tax_query'][] = array(
						'taxonomy' => 'pa_color',
						'field'    => 'slug',
						'terms'    => $color,
					);
				}

				// 3. Search query
				if ( isset( $_GET['s'] ) ) {
					$args['s'] = sanitize_text_field( $_GET['s'] );
				}

				// 4. Ordering
				$orderby_value = isset( $_GET['orderby'] ) ? sanitize_text_field( $_GET['orderby'] ) : 'menu_order';
				if ( 'price' === $orderby_value ) {
					$args['orderby']  = 'meta_value_num';
					$args['meta_key'] = '_price';
					$args['order']    = 'ASC';
				} elseif ( 'price-desc' === $orderby_value ) {
					$args['orderby']  = 'meta_value_num';
					$args['meta_key'] = '_price';
					$args['order']    = 'DESC';
				} elseif ( 'date' === $orderby_value ) {
					$args['orderby']  = 'date';
					$args['order']    = 'DESC';
				} elseif ( 'popularity' === $orderby_value ) {
					$args['orderby']  = 'meta_value_num';
					$args['meta_key'] = 'total_sales';
					$args['order']    = 'DESC';
				} elseif ( 'rating' === $orderby_value ) {
					$args['orderby']  = 'meta_value_num';
					$args['meta_key'] = '_wc_average_rating';
					$args['order']    = 'DESC';
				} else {
					$args['orderby']  = 'menu_order title';
					$args['order']    = 'ASC';
				}

				return $args;
			}
		}

		// Helper to sort chair products consistently in custom order
		if ( ! function_exists( 'great_wall_sort_chair_products_if_needed' ) ) {
			function great_wall_sort_chair_products_if_needed( $posts_arr, $cat_slug ) {
				if ( 'chairs' === $cat_slug || 'office-chairs' === $cat_slug || 'chair' === $cat_slug ) {
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
				return $posts_arr;
			}
		}

		// Recursive helper to expand any parent categories to their leaf subcategories
		if ( ! function_exists( 'great_wall_get_leaf_categories' ) ) {
			function great_wall_get_leaf_categories( $term_id, &$leaf_slugs = array() ) {
				$children = get_term_children( $term_id, 'product_cat' );
				if ( empty( $children ) || is_wp_error( $children ) ) {
					$term = get_term( $term_id, 'product_cat' );
					if ( $term && ! is_wp_error( $term ) ) {
						$leaf_slugs[] = $term->slug;
					}
				} else {
					$child_terms = get_terms( array(
						'taxonomy'   => 'product_cat',
						'include'    => $children,
						'hide_empty' => true,
					) );
					if ( ! empty( $child_terms ) && ! is_wp_error( $child_terms ) ) {
						foreach ( $child_terms as $ct ) {
							$sub_children = get_term_children( $ct->term_id, 'product_cat' );
							if ( empty( $sub_children ) || is_wp_error( $sub_children ) ) {
								$leaf_slugs[] = $ct->slug;
							} else {
								great_wall_get_leaf_categories( $ct->term_id, $leaf_slugs );
							}
						}
					}
				}
				return array_unique( $leaf_slugs );
			}
		}

		$queried_obj = get_queried_object();
		$is_parent_chair = ( is_product_category() && isset( $queried_obj->slug ) && ( 'chair' === $queried_obj->slug || 'chairs' === $queried_obj->slug ) );

		// Parse selected categories from URL parameter or query object
		$selected_cat_slugs = array();
		if ( is_product_category() ) {
			if ( isset( $queried_obj->slug ) ) {
				$selected_cat_slugs[] = $queried_obj->slug;
			}
		}
		if ( isset( $_GET['cat'] ) ) {
			$url_cats = explode( ',', sanitize_text_field( $_GET['cat'] ) );
			foreach ( $url_cats as $uc ) {
				$uc = trim( $uc );
				if ( ! empty( $uc ) && ! in_array( $uc, $selected_cat_slugs ) ) {
					$selected_cat_slugs[] = $uc;
				}
			}
		}

		// If no specific categories are selected, and it's not a search or tag archive page, treat as "All Products" and display all categories in sorted order
		$is_search = is_search();
		$is_tag = is_product_tag();
		$is_all_products = ( empty( $selected_cat_slugs ) && ! $is_search && ! $is_tag );

		if ( $is_all_products ) {
			$selected_cat_slugs = $preferred_order;
			
			// Dynamically retrieve all other active product categories and append them
			$other_cats = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
			) );
			if ( ! is_wp_error( $other_cats ) && ! empty( $other_cats ) ) {
				foreach ( $other_cats as $oc ) {
					if ( ! in_array( $oc->slug, $selected_cat_slugs ) && 'office-furniture' !== $oc->slug && 'uncategorized' !== $oc->slug ) {
						$selected_cat_slugs[] = $oc->slug;
					}
				}
			}
		}

		// Expand parent categories to their leaf subcategories dynamically
		$expanded_cat_slugs = array();
		foreach ( $selected_cat_slugs as $cat_slug ) {
			$term = get_term_by( 'slug', $cat_slug, 'product_cat' );
			if ( $term ) {
				$children = get_term_children( $term->term_id, 'product_cat' );
				if ( ! empty( $children ) && ! is_wp_error( $children ) ) {
					$leaves = great_wall_get_leaf_categories( $term->term_id );
					if ( ! empty( $leaves ) ) {
						foreach ( $leaves as $leaf_slug ) {
							$expanded_cat_slugs[] = $leaf_slug;
						}
					}
				} else {
					$expanded_cat_slugs[] = $cat_slug;
				}
			} else {
				$expanded_cat_slugs[] = $cat_slug;
			}
		}
		$selected_cat_slugs = array_unique( $expanded_cat_slugs );

		// Sort all selected categories in the preferred order
		usort( $selected_cat_slugs, function( $a, $b ) use ( $preferred_order ) {
			$pos_a = array_search( $a, $preferred_order );
			$pos_b = array_search( $b, $preferred_order );
			
			$pos_a = ( false !== $pos_a ) ? $pos_a : 999;
			$pos_b = ( false !== $pos_b ) ? $pos_b : 999;
			
			if ( $pos_a === $pos_b ) {
				return strcmp( $a, $b );
			}
			return $pos_a - $pos_b;
		} );

		if ( ! empty( $selected_cat_slugs ) ) {
			// Render toolbar header at the top of the main shop catalog listing
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
			}

			// Render selected categories as individual scrollable sections
			foreach ( $selected_cat_slugs as $cat_slug ) {
				$term = get_term_by( 'slug', $cat_slug, 'product_cat' );
				if ( ! $term ) {
					continue;
				}

				// Product Query for this category
				$args = great_wall_get_filtered_product_query_args( $cat_slug );
				$cat_query = new WP_Query( $args );

				// Determine if we should show an empty section message
				$show_empty = ( ! $is_all_products && count( $selected_cat_slugs ) === 1 );

				if ( $cat_query->have_posts() || $show_empty ) {
					echo '<div class="category-scroll-section" style="margin-bottom: 60px;">';
					echo '<h2 class="subcategory-title" style="font-family: \'Cormorant Garamond\', serif; font-size: 2.4rem; font-weight: 500; border-bottom: 1px solid #e5e0d8; padding-bottom: 16px; margin-bottom: 24px; color: #2e2a25; text-transform: capitalize;">' . esc_html( $term->name ) . '</h2>';

					if ( $cat_query->have_posts() ) {
						$posts_arr = $cat_query->posts;
						$posts_arr = great_wall_sort_chair_products_if_needed( $posts_arr, $cat_slug );

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
			}
		} elseif ( $is_parent_chair ) {
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
