<?php
/**
 * WooCommerce Sidebar Filters Template Part
 *
 * @package great-wall-theme
 */

defined( 'ABSPATH' ) || exit;

// Get current query states
$current_min = isset( $_GET['min_price'] ) ? intval( $_GET['min_price'] ) : 0;
$current_max = isset( $_GET['max_price'] ) ? intval( $_GET['max_price'] ) : 15000;
$active_color = isset( $_GET['filter_color'] ) ? sanitize_text_field( $_GET['filter_color'] ) : '';
$active_tag = isset( $_GET['product_tag'] ) ? sanitize_text_field( $_GET['product_tag'] ) : '';
$active_brand = isset( $_GET['filter_brand'] ) ? sanitize_text_field( $_GET['filter_brand'] ) : '';

$shop_page_url = function_exists( 'wc_get_page_id' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop/' );
?>

<div class="shop-filters-container">
	
	<!-- 1. CATEGORIES -->
	<div class="filter-widget widget_categories">
		<h3 class="filter-widget-title"><?php esc_html_e( 'CATEGORIES', 'great-wall-theme' ); ?></h3>
		<ul class="filter-list categories-list">
			<li class="<?php echo ( ! is_product_category() && ! isset( $_GET['cat'] ) ) ? 'active' : ''; ?>">
				<a href="<?php echo esc_url( $shop_page_url ); ?>"><?php esc_html_e( 'All Products', 'great-wall-theme' ); ?></a>
			</li>
			<?php
			$categories = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => false,
				'parent'     => 0,
			) );

			$has_categories = false;
			if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
				foreach ( $categories as $cat ) {
					if ( 'uncategorized' === $cat->slug ) {
						continue;
					}
					$has_categories = true;
					
					// Get subcategories of this parent category dynamically
					$sub_cats = get_terms( array(
						'taxonomy'   => 'product_cat',
						'hide_empty' => false,
						'parent'     => $cat->term_id,
					) );
					
					$has_sub = ( ! is_wp_error( $sub_cats ) && ! empty( $sub_cats ) );
					
					// Determine if the parent or any child is active
					$is_parent_active = is_product_category( $cat->slug ) || ( isset( $_GET['cat'] ) && $_GET['cat'] === $cat->slug );
					
					$is_child_active = false;
					if ( $has_sub ) {
						foreach ( $sub_cats as $sub ) {
							if ( is_product_category( $sub->slug ) || ( isset( $_GET['cat'] ) && $_GET['cat'] === $sub->slug ) ) {
								$is_child_active = true;
								break;
							}
						}
					}
					
					$parent_class = '';
					if ( $is_parent_active ) {
						$parent_class = 'active';
					} elseif ( $is_child_active ) {
						$parent_class = 'active-parent';
					}
					
					$li_class = trim( 'parent-cat-item ' . ( $has_sub ? 'has-children ' : '' ) . $parent_class );
					
					echo '<li class="' . esc_attr( $li_class ) . '">';
					echo '<div class="parent-link-row">';
					echo '<a href="' . esc_url( get_term_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a>';
					if ( $has_sub ) {
						$toggle_icon = ( $is_parent_active || $is_child_active ) ? 'ri-arrow-down-s-line' : 'ri-arrow-right-s-line';
						echo '<span class="sub-toggle"><i class="' . esc_attr( $toggle_icon ) . '"></i></span>';
					}
					echo '</div>';
					
					if ( $has_sub ) {
						$style = ( $is_parent_active || $is_child_active ) ? 'display: block;' : 'display: none;';
						echo '<ul class="sub-list" style="' . $style . '">';
						foreach ( $sub_cats as $sub ) {
							$is_sub_active = is_product_category( $sub->slug ) || ( isset( $_GET['cat'] ) && $_GET['cat'] === $sub->slug );
							$sub_class = $is_sub_active ? 'active' : '';
							echo '<li class="' . esc_attr( $sub_class ) . '">';
							echo '<a href="' . esc_url( get_term_link( $sub ) ) . '">' . esc_html( $sub->name ) . '</a>';
							echo '</li>';
						}
						echo '</ul>';
					}
					echo '</li>';
				}
			}

			// Mock Fallbacks if WooCommerce categories are empty or not created yet
			if ( ! $has_categories ) {
				$mock_cats = array(
					array( 'name' => 'Coffee Tables', 'slug' => 'living' ),
					array( 'name' => 'TV Stands', 'slug' => 'living' ),
					array( 'name' => 'Mattresses', 'slug' => 'bedroom' ),
					array( 'name' => 'Nightstands', 'slug' => 'bedroom' ),
					array( 'name' => 'Desks', 'slug' => 'accents' ),
					array( 'name' => 'Office Chairs', 'slug' => 'accents' ),
					array( 'name' => 'Dining Chairs', 'slug' => 'dining' ),
					array( 'name' => 'Bar Stools', 'slug' => 'dining' ),
					array( 'name' => 'Bookshelves', 'slug' => 'living' ),
					array( 'name' => 'Cabinets', 'slug' => 'bedroom' ),
				);

				foreach ( $mock_cats as $mc ) {
					$is_active = ( isset( $_GET['cat'] ) && $_GET['cat'] === $mc['slug'] );
					$active_class = $is_active ? 'active' : '';
					echo '<li class="' . esc_attr( $active_class ) . '">';
					echo '<a href="' . esc_url( add_query_arg( 'cat', $mc['slug'], $shop_page_url ) ) . '">' . esc_html( $mc['name'] ) . '</a>';
					echo '</li>';
				}
			}
			?>
		</ul>
	</div>

	<!-- 2. PRICE FILTER -->
	<div class="filter-widget widget_price_filter">
		<h3 class="filter-widget-title"><?php esc_html_e( 'PRICE', 'great-wall-theme' ); ?></h3>
		<div class="price-slider-widget-container">
			<div class="price-slider-inputs-wrapper">
				<div class="price-slider-track-bar"></div>
				<input type="range" class="price-slider-min-input" min="0" max="15000" step="100" value="<?php echo esc_attr( $current_min ); ?>" aria-label="Min Price">
				<input type="range" class="price-slider-max-input" min="0" max="15000" step="100" value="<?php echo esc_attr( $current_max ); ?>" aria-label="Max Price">
			</div>
			<div class="price-slider-output-info">
				<span class="price-range-label">
					Price: <span class="price-val-min">AED <?php echo esc_html( number_format( $current_min ) ); ?></span> - <span class="price-val-max">AED <?php echo esc_html( number_format( $current_max ) ); ?></span>
				</span>
				<button type="button" class="btn-trigger-price-filter" onclick="applyPriceFilter()"><?php esc_html_e( 'Filter', 'great-wall-theme' ); ?></button>
			</div>
		</div>
	</div>

	<!-- 3. COLOR FILTER -->
	<div class="filter-widget widget_color_filter">
		<h3 class="filter-widget-title"><?php esc_html_e( 'COLOR', 'great-wall-theme' ); ?></h3>
		<div class="color-swatch-list">
			<?php
			$colors = get_terms( array(
				'taxonomy'   => 'pa_color',
				'hide_empty' => false,
			) );

			$has_colors = false;
			if ( ! is_wp_error( $colors ) && ! empty( $colors ) ) {
				foreach ( $colors as $color ) {
					$has_colors = true;
					// Get color value (hex) stored in term meta if exists, or fallback
					$hex = get_term_meta( $color->term_id, 'color_hex', true );
					if ( empty( $hex ) ) {
						$hex = '#8E8E93'; // Muted grey default
					}
					$is_active = ( $active_color === $color->slug );
					$active_class = $is_active ? 'active' : '';
					
					// URL generator
					$color_url = $is_active ? remove_query_arg( 'filter_color' ) : add_query_arg( 'filter_color', $color->slug );
					
					echo '<a href="' . esc_url( $color_url ) . '" class="color-filter-swatch ' . esc_attr( $active_class ) . '" style="background-color: ' . esc_attr( $hex ) . ';" title="' . esc_attr( $color->name ) . '" data-color="' . esc_attr( $color->slug ) . '"></a>';
				}
			}

			// Mock colors fallback matching screenshot design
			if ( ! $has_colors ) {
				$mock_colors = array(
					array( 'name' => 'Black', 'slug' => 'black', 'hex' => '#1C1C1E' ),
					array( 'name' => 'Grey', 'slug' => 'grey', 'hex' => '#8E8E93' ),
					array( 'name' => 'White', 'slug' => 'white', 'hex' => '#FFFFFF' ),
					array( 'name' => 'Teal/Blue', 'slug' => 'teal', 'hex' => '#1A1F3C' ),
					array( 'name' => 'Gold/Oak', 'slug' => 'gold', 'hex' => '#D4B28C' ),
				);

				foreach ( $mock_colors as $mc ) {
					$is_active = ( $active_color === $mc['slug'] );
					$active_class = $is_active ? 'active' : '';
					$color_url = $is_active ? remove_query_arg( 'filter_color' ) : add_query_arg( 'filter_color', $mc['slug'] );
					$border_style = ( '#FFFFFF' === $mc['hex'] ) ? 'border: 1px solid #D1D1D6;' : '';
					
					echo '<a href="' . esc_url( $color_url ) . '" class="color-filter-swatch ' . esc_attr( $active_class ) . '" style="background-color: ' . esc_attr( $mc['hex'] ) . '; ' . esc_attr( $border_style ) . '" title="' . esc_attr( $mc['name'] ) . '" data-color="' . esc_attr( $mc['slug'] ) . '"></a>';
				}
			}
			?>
		</div>
	</div>

	<!-- 4. TAG FILTER -->
	<div class="filter-widget widget_tag_filter">
		<h3 class="filter-widget-title"><?php esc_html_e( 'TAG', 'great-wall-theme' ); ?></h3>
		<div class="tag-pill-list">
			<?php
			$tags = get_terms( array(
				'taxonomy'   => 'product_tag',
				'hide_empty' => false,
				'number'     => 12,
			) );

			$has_tags = false;
			if ( ! is_wp_error( $tags ) && ! empty( $tags ) ) {
				foreach ( $tags as $tag ) {
					$has_tags = true;
					$is_active = ( $active_tag === $tag->slug );
					$active_class = $is_active ? 'active' : '';
					$tag_url = $is_active ? remove_query_arg( 'product_tag' ) : add_query_arg( 'product_tag', $tag->slug );
					echo '<a href="' . esc_url( $tag_url ) . '" class="tag-pill-btn ' . esc_attr( $active_class ) . '" data-tag="' . esc_attr( $tag->slug ) . '">' . esc_html( $tag->name ) . '</a>';
				}
			}

			// Mock tags fallback
			if ( ! $has_tags ) {
				$mock_tags = array(
					array( 'name' => 'Hot', 'slug' => 'hot' ),
					array( 'name' => 'Innovation', 'slug' => 'innovation' ),
					array( 'name' => 'Lifestyle', 'slug' => 'lifestyle' ),
					array( 'name' => 'Quality', 'slug' => 'quality' ),
					array( 'name' => 'Solutions', 'slug' => 'solutions' ),
					array( 'name' => 'Sustainability', 'slug' => 'sustainability' ),
				);

				foreach ( $mock_tags as $mt ) {
					$is_active = ( $active_tag === $mt['slug'] );
					$active_class = $is_active ? 'active' : '';
					$tag_url = $is_active ? remove_query_arg( 'product_tag' ) : add_query_arg( 'product_tag', $mt['slug'] );
					echo '<a href="' . esc_url( $tag_url ) . '" class="tag-pill-btn ' . esc_attr( $active_class ) . '" data-tag="' . esc_attr( $mt['slug'] ) . '">' . esc_html( $mt['name'] ) . '</a>';
				}
			}
			?>
		</div>
	</div>

	<!-- 5. BRAND FILTER -->
	<div class="filter-widget widget_brand_filter">
		<h3 class="filter-widget-title"><?php esc_html_e( 'BRAND', 'great-wall-theme' ); ?></h3>
		<ul class="filter-list brand-list">
			<?php
			// Brands can be custom attributes pa_brand
			$brands = get_terms( array(
				'taxonomy'   => 'pa_brand',
				'hide_empty' => false,
			) );

			$has_brands = false;
			if ( ! is_wp_error( $brands ) && ! empty( $brands ) ) {
				foreach ( $brands as $brand ) {
					$has_brands = true;
					$is_active = ( $active_brand === $brand->slug );
					$active_class = $is_active ? 'active' : '';
					$brand_url = $is_active ? remove_query_arg( 'filter_brand' ) : add_query_arg( 'filter_brand', $brand->slug );
					echo '<li class="' . esc_attr( $active_class ) . '">';
					echo '<a href="' . esc_url( brand_url ) . '">' . esc_html( $brand->name ) . '</a>';
					echo '</li>';
				}
			}

			// Mock brands fallback matching screenshot
			if ( ! $has_brands ) {
				$mock_brands = array(
					array( 'name' => 'EcoSphere', 'slug' => 'ecosphere' ),
					array( 'name' => 'HorizonEdge', 'slug' => 'horizonedge' ),
					array( 'name' => 'VertexCore', 'slug' => 'vertexcore' ),
					array( 'name' => 'Moduva Selection', 'slug' => 'moduva' ),
				);

				foreach ( $mock_brands as $mb ) {
					$is_active = ( $active_brand === $mb['slug'] );
					$active_class = $is_active ? 'active' : '';
					$brand_url = $is_active ? remove_query_arg( 'filter_brand' ) : add_query_arg( 'filter_brand', $mb['slug'] );
					echo '<li class="' . esc_attr( $active_class ) . '">';
					echo '<a href="' . esc_url( $brand_url ) . '">' . esc_html( $mb['name'] ) . '</a>';
					echo '</li>';
				}
			}
			?>
		</ul>
	</div>

</div>

<script>
function applyPriceFilter() {
	const minVal = document.querySelector('.price-slider-min-input').value;
	const maxVal = document.querySelector('.price-slider-max-input').value;
	
	const currentUrl = new URL(window.location.href);
	currentUrl.searchParams.set('min_price', minVal);
	currentUrl.searchParams.set('max_price', maxVal);
	
	window.location.href = currentUrl.toString();
}
</script>
