<?php
/**
 * Great Wall Furniture functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package great-wall-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'great_wall_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function great_wall_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'great-wall-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, WordPress will provide it.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Register Navigation Menus.
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary Glassmorphic Header Navigation', 'great-wall-theme' ),
				'footer-menu-1' => esc_html__( 'Footer Collections Menu', 'great-wall-theme' ),
				'footer-menu-2' => esc_html__( 'Footer Showroom Menu', 'great-wall-theme' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for Custom Logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 80,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Declare Support for WooCommerce.
		add_theme_support( 'woocommerce' );
		// add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
endif;
add_action( 'after_setup_theme', 'great_wall_setup' );

/**
 * Enqueue scripts and styles.
 */
function great_wall_scripts() {
	// Enqueue Google Fonts directly.
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap', array(), null );

	// Enqueue main design system stylesheet directly (bypasses parent style.css @import chain).
	wp_enqueue_style( 'great-wall-styles', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.8' );

	// Enqueue Remix Icons CDN.
	wp_enqueue_style( 'remix-icons', 'https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css', array(), '4.2.0' );

	// Enqueue main interactive javascript core.
	wp_enqueue_script( 'great-wall-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.8', true );

	wp_localize_script( 'great-wall-js', 'greatWallThemeParams', array(
		'checkout_url'   => function_exists( 'wc_get_checkout_url' ) ? wc_get_checkout_url() : home_url( '/checkout/' ),
		'is_woocommerce' => class_exists( 'WooCommerce' )
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'great_wall_scripts' );

/**
 * Defer non-critical enqueued scripts for performance.
 */
function great_wall_defer_scripts( $tag, $handle = '', $src = '' ) {
	if ( 'great-wall-js' === $handle ) {
		return '<script src="' . esc_url( $src ) . '" defer id="' . esc_attr( $handle ) . '-js"></script>' . "\n";
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'great_wall_defer_scripts', 10, 3 );

/**
 * Filter WooCommerce Cart fragments to update cart badge, drawer items, and subtotal via AJAX
 */
if ( class_exists( 'WooCommerce' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'great_wall_cart_fragments' );
	function great_wall_cart_fragments( $fragments ) {
		// 1. Cart Count Badge
		ob_start();
		?>
		<span class="cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
		<?php
		$fragments['span.cart-count'] = ob_get_clean();

		// 2. Cart Drawer Items
		ob_start();
		?>
		<div class="cart-items">
			<?php
			$cart_items = WC()->cart->get_cart();
			if ( ! empty( $cart_items ) ) {
				foreach ( $cart_items as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) {
						$product_permalink = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
						$thumbnail         = $_product->get_image();
						$product_name      = $_product->get_name();
						$product_subtotal  = WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] );
						?>
						<div class="cart-item" data-cart-key="<?php echo esc_attr( $cart_item_key ); ?>">
							<div class="cart-item-img">
								<?php if ( ! $product_permalink ) : ?>
									<?php echo $thumbnail; ?>
								<?php else : ?>
									<a href="<?php echo esc_url( $product_permalink ); ?>">
										<?php echo $thumbnail; ?>
									</a>
								<?php endif; ?>
							</div>
							<div class="cart-item-details">
								<div class="cart-item-title-row">
									<div class="cart-item-title">
										<?php if ( ! $product_permalink ) : ?>
											<?php echo esc_html( $product_name ); ?>
										<?php else : ?>
											<a href="<?php echo esc_url( $product_permalink ); ?>">
												<?php echo esc_html( $product_name ); ?>
											</a>
										<?php endif; ?>
									</div>
								</div>
								<div class="cart-item-bottom">
									<div class="cart-item-quantity">
										<span>Qty: <?php echo esc_html( $cart_item['quantity'] ); ?></span>
									</div>
									<div class="cart-item-price"><?php echo $product_subtotal; ?></div>
									<a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>" class="cart-item-remove-wc" data-cart-key="<?php echo esc_attr( $cart_item_key ); ?>">Remove</a>
								</div>
							</div>
						</div>
						<?php
					}
				}
			} else {
				?>
				<div class="empty-cart-message" style="text-align: center; padding: 40px 20px; color: var(--color-muted);">
					<p style="margin-bottom: 20px;">Your shopping bag is empty.</p>
					<a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="btn btn-primary drawer-close" style="display: inline-block;"><span>View Collections</span></a>
				</div>
				<?php
			}
			?>
		</div>
		<?php
		$fragments['div.cart-items'] = ob_get_clean();

		// 3. Subtotal Val
		ob_start();
		?>
		<span class="cart-subtotal-val"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
		<?php
		$fragments['span.cart-subtotal-val'] = ob_get_clean();

		return $fragments;
	}
}

/**
 * Customize WooCommerce product archive loops wrappers
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Disable default WooCommerce loop titles and descriptions
add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

add_action( 'woocommerce_before_main_content', 'great_wall_shop_hero_banner', 9 );
function great_wall_shop_hero_banner() {
	if ( is_shop() || is_product_category() || is_product_tag() ) {
		// Set title to 'Explore Our Products' as requested by the user
		$title = 'Explore Our Products';
		$desc = '';

		// Get category thumbnail
		$thumbnail_url = '';
		if ( is_product_category() ) {
			$cat = get_queried_object();
			$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
			if ( $thumbnail_id ) {
				$thumbnail_url = wp_get_attachment_url( $thumbnail_id );
			}
		}
		if ( empty( $thumbnail_url ) ) {
			$thumbnail_url = get_template_directory_uri() . '/assets/images/dining_room.webp';
		}
		// Query top-level categories for the circular selector
		$cat_args = array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => false,
			'parent'     => 0,
		);
		$terms = get_terms( $cat_args );
		$terms_list = array();
		if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				if ( 'uncategorized' !== $term->slug ) {
					$terms_list[] = array(
						'name'   => $term->name,
						'slug'   => $term->slug,
						'link'   => get_term_link( $term ),
						'img'    => '',
						'id'     => $term->term_id,
						'active' => is_product_category( $term->slug )
					);
				}
			}
		}
		
		// If empty, let's load mock categories matching the screenshot design
		if ( empty( $terms_list ) ) {
			$mock_cats = array(
				array( 'name' => 'Coffee Tables', 'slug' => 'living', 'img' => 'sofa_isolated.webp' ),
				array( 'name' => 'Mattresses', 'slug' => 'bedroom', 'img' => 'luxury_bed.webp' ),
				array( 'name' => 'Wardrobes', 'slug' => 'bedroom', 'img' => 'timber_dresser.webp' ),
				array( 'name' => 'Dressers', 'slug' => 'bedroom', 'img' => 'table_lamp.webp' ),
				array( 'name' => 'Bar Stools', 'slug' => 'dining', 'img' => 'box_round_stool.webp' ),
				array( 'name' => 'Shelving Units', 'slug' => 'living', 'img' => 'designer_chair.webp' ),
			);
			foreach ( $mock_cats as $mc ) {
				$terms_list[] = array(
					'name'   => $mc['name'],
					'slug'   => $mc['slug'],
					'link'   => home_url( '/shop/?cat=' . $mc['slug'] ),
					'img'    => get_template_directory_uri() . '/assets/images/' . $mc['img'],
					'id'     => 0,
					'active' => false
				);
			}
		} else {
			// Populate images for actual categories
			foreach ( $terms_list as &$t ) {
				$term_thumb_id = get_term_meta( $t['id'], 'thumbnail_id', true );
				if ( $term_thumb_id ) {
					$t['img'] = wp_get_attachment_url( $term_thumb_id );
				}
				if ( empty( $t['img'] ) ) {
					// Fallback based on name
					$name_l = strtolower( $t['name'] );
					if ( strpos( $name_l, 'living' ) !== false ) {
						$t['img'] = get_template_directory_uri() . '/assets/images/hero_sofa.webp';
					} elseif ( strpos( $name_l, 'bedroom' ) !== false ) {
						$t['img'] = get_template_directory_uri() . '/assets/images/luxury_bed.webp';
					} elseif ( strpos( $name_l, 'dining' ) !== false ) {
						$t['img'] = get_template_directory_uri() . '/assets/images/dining_room.webp';
					} elseif ( strpos( $name_l, 'accent' ) !== false || strpos( $name_l, 'chair' ) !== false ) {
						$t['img'] = get_template_directory_uri() . '/assets/images/designer_chair.webp';
					} else {
						$t['img'] = get_template_directory_uri() . '/assets/images/sofa_isolated.webp';
					}
				}
			}
			unset( $t );
		}

		// Perform slider page grouping (6 items per page, back-filling the last slide from previous slide items if needed)
		$chunks = array();
		$total_items = count( $terms_list );
		if ( $total_items > 0 ) {
			if ( $total_items <= 6 ) {
				$chunks[] = $terms_list;
			} else {
				$num_slides = ceil( $total_items / 6 );
				for ( $i = 0; $i < $num_slides; $i++ ) {
					if ( $i < $num_slides - 1 ) {
						$chunks[] = array_slice( $terms_list, $i * 6, 6 );
					} else {
						// For the last slide, if it has fewer than 6 items, slice the last 6 items of the array
						$start_idx = $total_items - 6;
						if ( $start_idx < 0 ) {
							$start_idx = 0;
						}
						$chunks[] = array_slice( $terms_list, $start_idx, 6 );
					}
				}
			}
		}
		?>
		<section class="shop-hero-banner" style="background-image: linear-gradient(rgba(30, 28, 25, 0.65), rgba(30, 28, 25, 0.65)), url('<?php echo esc_url( $thumbnail_url ); ?>');">
			<div class="container" style="position: relative; z-index: 5;">
				<h1 class="shop-hero-title"><?php echo esc_html( $title ); ?></h1>
				<?php if ( ! empty( $desc ) ) : ?>
					<div class="shop-hero-desc"><?php echo wp_kses_post( $desc ); ?></div>
				<?php endif; ?>
				<div class="breadcrumbs shop-hero-breadcrumbs">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
					<span>/</span>
					<span><?php echo esc_html( $title ); ?></span>
				</div>
				<?php 
				if ( ! empty( $chunks ) ) : 
					?>
					<div class="shop-categories-slider-container">
						<button class="shop-cat-slider-arrow prev-btn" aria-label="Previous Slide">
							<i class="ri-arrow-left-s-line"></i>
						</button>
						
						<div class="shop-categories-slider-viewport">
							<div class="shop-categories-slider-inner">
								<?php foreach ( $chunks as $index => $chunk ) : ?>
									<div class="shop-categories-slide <?php echo 0 === $index ? 'active' : ''; ?>">
										<?php foreach ( $chunk as $term_item ) : ?>
											<a href="<?php echo esc_url( $term_item['link'] ); ?>" class="hero-category-item <?php echo $term_item['active'] ? 'active' : ''; ?>">
												<div class="hero-category-circle">
													<img src="<?php echo esc_url( $term_item['img'] ); ?>" alt="<?php echo esc_attr( $term_item['name'] ); ?>">
												</div>
												<span class="hero-category-label"><?php echo esc_html( $term_item['name'] ); ?></span>
											</a>
										<?php endforeach; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						
						<button class="shop-cat-slider-arrow next-btn" aria-label="Next Slide">
							<i class="ri-arrow-right-s-line"></i>
						</button>
					</div>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}
}

add_action( 'woocommerce_before_main_content', 'great_wall_wrapper_start', 10 );
function great_wall_wrapper_start() {
	$padding = ( is_shop() || is_product_category() || is_product_tag() ) ? '40px' : '140px';
	echo '<section class="section" style="padding-top: ' . $padding . ';"><div class="container">';
}

add_action( 'woocommerce_after_main_content', 'great_wall_wrapper_end', 10 );
function great_wall_wrapper_end() {
	echo '</div></section>';
}

/**
 * Fallback WooCommerce Product Filters for Prototype / Temporary Display
 */
// 1. Force products to be purchasable (even without price)
add_filter( 'woocommerce_is_purchasable', '__return_true' );

// 2. Fallback price if empty (so they display Add to Cart button and fallback price)
add_filter( 'woocommerce_product_get_price', 'great_wall_fallback_price', 10, 2 );
add_filter( 'woocommerce_product_get_regular_price', 'great_wall_fallback_price', 10, 2 );
function great_wall_fallback_price( $price, $product ) {
	if ( '' === $price || false === $price || null === $price ) {
		return '2999'; // Temporary fallback price
	}
	return $price;
}

// 3. Fallback short description if empty
add_filter( 'woocommerce_short_description', 'great_wall_fallback_short_description', 10, 1 );
function great_wall_fallback_short_description( $post_excerpt ) {
	if ( empty( trim( $post_excerpt ) ) ) {
		return 'Experience the peak of contemporary craftsmanship. Hand-tailored from premium materials, this architectural piece brings quiet luxury and clean, minimalist lines to any modern space in Dubai. Custom dimensions and veneers available upon request.';
	}
	return $post_excerpt;
}

// 4. Fallback main content (description) if empty
add_filter( 'the_content', 'great_wall_fallback_content', 10, 1 );
function great_wall_fallback_content( $content ) {
	if ( is_singular( 'product' ) && empty( trim( $content ) ) ) {
		return '<h3>Design & Craftsmanship</h3><p>Every line and detail of this piece has been carefully considered to create a sense of harmony and understated elegance. Built with premium materials selected for their durability and natural beauty, it serves as a functional art piece in your home.</p><h3>Specifications</h3><ul><li>Premium grade materials and structure</li><li>Hand-finished with natural protective oils</li><li>Custom dimensions and materials available upon consultation with our showroom team</li></ul>';
	}
	return $content;
}

/**
 * Programmatically provision standard theme pages with premium luxury content if they do not exist
 */
add_action( 'init', 'great_wall_provision_pages' );
function great_wall_provision_pages() {
	if ( ! is_admin() ) {
		return;
	}

	$pages_to_create = array(
		'about' => array(
			'title'   => 'Our Story',
			'content' => '<h2>Our Heritage</h2><p>Founded on a passion for fine craftsmanship and architectural lines, Great Wall Furniture brings modern minimalist wood and upholstered masterpieces to Dubai. We partner with skilled artisans to select premium materials, ensuring every piece serves as a durable, functional art piece for your home.</p><h2>Bespoke Quality</h2><p>Every joint, finish, and detail is meticulously refined in our workshop. We invite you to explore our showroom and collaborate with our designers on custom dimensions and finishes tailored to your interior design vision.</p>',
		),
		'contact' => array(
			'title'   => 'Contact Us',
			'content' => '<h2>Visit Our Showroom</h2><p>Experience the quality of our materials and construction in person. Our design consultants are available to help you select or customize the perfect pieces for your space.</p><p><strong>Address:</strong> Showroom 4, Ras Al Khor Industrial 2, Dubai, United Arab Emirates</p><p><strong>Phone:</strong> +971 4 320 2921</p><p><strong>Email:</strong> info@greatwallfurniture.com</p><h2>Book a Consultation</h2><p>Please contact our showroom team to schedule a private walkthrough or custom furniture consultation.</p>',
		),
		'privacy-policy' => array(
			'title'   => 'Privacy Policy',
			'content' => '<h2>Privacy Policy</h2><p>At Great Wall Furniture, we respect your privacy and protect your personal data. This privacy policy explains how we collect, use, and safeguard your information when you visit our website or showroom in Dubai.</p><h2>Data We Collect</h2><p>We collect contact information (name, email, phone) and delivery addresses when you request showroom consultations, subscribe to our newsletters, or place orders. We do not sell or share your data with third parties.</p>',
		),
		'terms-conditions' => array(
			'title'   => 'Terms and Conditions',
			'content' => '<h2>Terms and Conditions</h2><p>Welcome to Great Wall Furniture. By accessing our website or purchasing our products, you agree to comply with our terms of service.</p><h2>Custom Orders</h2><p>All custom-dimension and customized veneer orders require a 50% deposit before construction begins at our Dubai workshop. Delivery timelines are estimates and subject to material availability.</p>',
		),
	);

	foreach ( $pages_to_create as $slug => $page_data ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) {
			$new_page = array(
				'post_title'   => $page_data['title'],
				'post_content' => $page_data['content'],
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_name'    => $slug,
			);
			wp_insert_post( $new_page );
		}
	}
}

/**
 * Helper to retrieve WordPress navigation menu items for a specific theme location.
 * Verifies that the menu exists and contains items.
 *
 * @param string $location Theme location slug.
 * @return array|false Array of menu items, or false if not assigned or empty.
 */
function great_wall_get_menu_items( $location ) {
	if ( ! has_nav_menu( $location ) ) {
		return false;
	}
	$locations = get_nav_menu_locations();
	if ( ! isset( $locations[ $location ] ) ) {
		return false;
	}
	$menu = wp_get_nav_menu_object( $locations[ $location ] );
	if ( ! $menu ) {
		return false;
	}
	$menu_items = wp_get_nav_menu_items( $menu->term_id );
	if ( empty( $menu_items ) ) {
		return false;
	}

	// Add active/current class context in-place if function exists
	if ( function_exists( '_wp_menu_item_classes_by_context' ) ) {
		_wp_menu_item_classes_by_context( $menu_items );
	}

	return $menu_items;
}

/**
 * Determine if a menu item is currently active.
 *
 * @param object $item Menu item post object.
 * @return bool True if active, false otherwise.
 */
function great_wall_is_menu_item_active( $item ) {
	global $wp;

	// Check if WP core navigation class indicates current/parent/ancestor
	if ( ! empty( $item->classes ) && is_array( $item->classes ) ) {
		$active_classes = array(
			'current-menu-item',
			'current-menu-parent',
			'current-menu-ancestor',
			'current_page_item',
		);
		foreach ( $active_classes as $class ) {
			if ( in_array( $class, $item->classes ) ) {
				return true;
			}
		}
	}

	// Fallback check against the current request URL
	$current_url = home_url( add_query_arg( array(), $wp->request ) );
	$current_url = rtrim( $current_url, '/' ) . '/';
	$item_url    = rtrim( $item->url, '/' ) . '/';

	if ( $current_url === $item_url ) {
		return true;
	}

	return false;
}

/**
 * Custom sorting for "Chair" category archive page:
 * Show products starting with "OC-" first, and all other chairs below them.
 */
add_filter( 'posts_orderby', 'great_wall_sort_chairs_category', 99, 2 );
function great_wall_sort_chairs_category( $orderby, $query ) {
    if ( ! is_admin() && $query->is_main_query() && ( is_product_category( 'chair' ) || is_product_category( 'chairs' ) ) ) {
        global $wpdb;
        $custom_orderby = "CASE 
            WHEN {$wpdb->posts}.post_title LIKE 'OC-%' OR {$wpdb->posts}.post_title LIKE 'OC %' THEN 0 
            ELSE 1 
        END ASC, {$wpdb->posts}.menu_order ASC, {$wpdb->posts}.post_title ASC";
        
        return $custom_orderby;
    }
    return $orderby;
}

/**
 * Customize related products:
 * If the current product name starts with "OC-", make sure it only displays other "OC-" office chairs.
 */
add_filter( 'woocommerce_related_products', 'great_wall_related_office_chairs', 99, 3 );
function great_wall_related_office_chairs( $related_posts, $product_id, $args ) {
    $product = wc_get_product( $product_id );
    if ( ! $product ) {
        return $related_posts;
    }
    
    $title = $product->get_name();
    if ( stripos( $title, 'OC-' ) === 0 || stripos( $title, 'OC ' ) === 0 ) {
        global $wpdb;
        $query_ids = $wpdb->get_col( "
            SELECT ID FROM {$wpdb->posts}
            WHERE post_type = 'product'
              AND post_status = 'publish'
              AND ID != {$product_id}
              AND (post_title LIKE 'OC-%' OR post_title LIKE 'OC %')
            LIMIT 4
        " );
        
        if ( ! empty( $query_ids ) ) {
            return array_map( 'intval', $query_ids );
        }
    }
    return $related_posts;
}

