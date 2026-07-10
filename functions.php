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
	wp_enqueue_style( 'great-wall-styles', get_template_directory_uri() . '/assets/css/style.css', array(), '1.4.0' );

	// Enqueue Remix Icons CDN.
	wp_enqueue_style( 'remix-icons', 'https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css', array(), '4.2.0' );

	// Enqueue main interactive javascript core.
	wp_enqueue_script( 'great-wall-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.4.0', true );

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
				
				// Dynamically fetch a product image from the category if no thumbnail is set
				if ( empty( $t['img'] ) ) {
					$prod_args = array(
						'post_type'      => 'product',
						'posts_per_page' => 1,
						'post_status'    => 'publish',
						'fields'         => 'ids',
						'tax_query'      => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'term_id',
								'terms'    => $t['id'],
							),
						),
					);
					$prod_ids = get_posts( $prod_args );
					if ( ! empty( $prod_ids ) ) {
						$prod_id = $prod_ids[0];
						$prod_thumb_id = get_post_thumbnail_id( $prod_id );
						if ( $prod_thumb_id ) {
							$t['img'] = wp_get_attachment_url( $prod_thumb_id );
						}
					}
				}
				
				// Final static fallback if there are absolutely no products or images in the category
				if ( empty( $t['img'] ) ) {
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
	if ( is_shop() || is_product_category() || is_product_tag() ) {
		$padding = '40px';
	} elseif ( is_product() ) {
		$padding = '95px'; /* Reduced from 140px to align tightly below the header */
	} else {
		$padding = '140px';
	}
	echo '<section class="section" style="padding-top: ' . $padding . ';"><div class="container">';
}

add_action( 'woocommerce_after_main_content', 'great_wall_wrapper_end', 10 );
function great_wall_wrapper_end() {
	echo '</div></section>';
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
    if ( ! is_admin() && is_object( $query ) && method_exists( $query, 'is_main_query' ) && $query->is_main_query() ) {
        // Safe check for product_cat taxonomy using native query variables
        $product_cat = $query->get( 'product_cat' );
        if ( 'chair' === $product_cat || 'chairs' === $product_cat ) {
            global $wpdb;
            $custom_orderby = "CASE 
                WHEN {$wpdb->posts}.post_title LIKE 'OC-%' OR {$wpdb->posts}.post_title LIKE 'OC %' THEN 0 
                ELSE 1 
            END ASC, {$wpdb->posts}.menu_order ASC, {$wpdb->posts}.post_title ASC";
            
            return $custom_orderby;
        }
    }
    return $orderby;
}

/**
 * Customize related products to strictly match the current product's category,
 * or prioritize only other "OC-" chairs if viewing an "OC-" office chair.
 */
add_filter( 'woocommerce_related_products', 'great_wall_custom_related_products', 99, 3 );
function great_wall_custom_related_products( $related_posts, $product_id, $args ) {
    if ( function_exists( 'wc_get_product' ) ) {
        $product = wc_get_product( $product_id );
        if ( ! $product ) {
            return $related_posts;
        }

        $title = $product->get_name();
        
        // If it is an office chair (OC-), query other OC- office chairs directly
        if ( stripos( $title, 'OC-' ) === 0 || stripos( $title, 'OC ' ) === 0 ) {
            global $wpdb;
            $query_ids = $wpdb->get_col( $wpdb->prepare( "
                SELECT ID FROM {$wpdb->posts}
                WHERE post_type = 'product'
                  AND post_status = 'publish'
                  AND ID != %d
                  AND (post_title LIKE 'OC-%%' OR post_title LIKE 'OC %%')
                LIMIT 8
            ", $product_id ) );
            
            if ( ! empty( $query_ids ) ) {
                return array_map( 'intval', $query_ids );
            }
        }
        
        // For other products, fetch products strictly matching the same product categories
        $terms = get_the_terms( $product_id, 'product_cat' );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $term_ids = wp_list_pluck( $terms, 'term_id' );
            
            $query_args = array(
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'posts_per_page' => 8,
                'post__not_in'   => array( $product_id ),
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'term_id',
                        'terms'    => $term_ids,
                        'operator' => 'IN',
                    ),
                ),
                'fields'         => 'ids',
            );
            
            $related_query = new WP_Query( $query_args );
            if ( ! empty( $related_query->posts ) ) {
                return array_map( 'intval', $related_query->posts );
            }
        }
    }
    return $related_posts;
}

/**
 * Remove the redundant WooCommerce "Additional Information" tab
 */
add_filter( 'woocommerce_product_tabs', 'great_wall_rename_description_tab', 98 );
function great_wall_rename_description_tab( $tabs ) {
    // Remove the redundant WooCommerce Additional Information tab
    if ( isset( $tabs['additional_information'] ) ) {
        unset( $tabs['additional_information'] );
    }
    return $tabs;
}

/**
 * Custom query parameter handler to allow adding multiple product IDs to the cart in a single request.
 * e.g., greatwallfurniture.com/?add-to-cart-multiple=123,456
 */
add_action( 'wp_loaded', 'great_wall_add_multiple_to_cart_handler' );
function great_wall_add_multiple_to_cart_handler() {
    if ( isset( $_GET['add-to-cart-multiple'] ) ) {
        $product_ids = explode( ',', $_GET['add-to-cart-multiple'] );
        if ( function_exists( 'WC' ) && ! empty( $product_ids ) ) {
            foreach ( $product_ids as $id ) {
                $id = intval( $id );
                if ( $id > 0 ) {
                    WC()->cart->add_to_cart( $id );
                }
            }
            // Clear checkout messages and redirect straight to the checkout page
            wp_safe_redirect( wc_get_checkout_url() );
            exit;
        }
    }
}

/**
 * Render a dynamic sticky add to cart and buy now bar on product details pages.
 */
add_action( 'wp_footer', 'great_wall_sticky_add_to_cart_bar' );
function great_wall_sticky_add_to_cart_bar() {
    if ( ! is_product() ) {
        return;
    }
    
    $product = wc_get_product( get_the_ID() );
	if ( ! $product ) {
		return;
	}
	
	$price = $product->get_price();
	$price_html = strip_tags( wc_price( $price ) );
	$stock_status = $product->is_in_stock() ? __( 'In stock', 'great-wall-theme' ) : __( 'Out of stock', 'great-wall-theme' );
	?>
	<div class="sticky-bar-global">
		<div class="sticky-bar-content">
			<div class="sticky-bar-info">
				<p class="sticky-bar-title"><?php echo esc_html( $product->get_name() ); ?></p>
				<span class="sticky-bar-meta"><?php echo esc_html( $price_html ); ?> &middot; <?php echo esc_html( $stock_status ); ?></span>
			</div>
			<div class="sticky-bar-btns">
				<button class="sticky-bar-btn-buy" onclick="clickNativeBuy()"><?php esc_html_e( 'Buy now', 'great-wall-theme' ); ?></button>
				<button class="sticky-bar-btn-cart" onclick="clickNativeCart()"><?php esc_html_e( 'Add to cart', 'great-wall-theme' ); ?></button>
			</div>
		</div>
	</div>
	
	<script>
	function clickNativeCart() {
		const btn = document.querySelector('form.cart button.single_add_to_cart_button');
		if (btn) {
			btn.click();
		} else {
			window.location.href = window.location.pathname + '?add-to-cart=<?php echo esc_js( $product->get_id() ); ?>';
		}
	}
	function clickNativeBuy() {
		const btn = document.getElementById('detail-buy-now') || document.querySelector('form.cart .buy-now-theme-btn');
		if (btn) {
			btn.click();
		} else {
			window.location.href = '<?php echo esc_js( home_url( '/' ) ); ?>?add-to-cart-multiple=<?php echo esc_js( $product->get_id() ); ?>';
		}
	}
	
	// Sticky bar is permanently visible on load
	</script>
	<?php
}

/**
 * Render dynamic save percentage badge next to single product price.
 */
add_filter( 'woocommerce_get_price_html', 'great_wall_custom_sale_percentage_badge', 10, 2 );
function great_wall_custom_sale_percentage_badge( $price_html, $product ) {
    if ( is_admin() || ! is_product() ) {
        return $price_html;
    }
    if ( $product->is_on_sale() && $product->get_type() === 'simple' ) {
        $regular_price = $product->get_regular_price();
        $sale_price = $product->get_sale_price();
        if ( $regular_price > 0 ) {
            $percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
            $price_html .= ' <span class="badge-sale">' . sprintf( esc_html__( 'Save %d%%', 'great-wall-theme' ), $percentage ) . '</span>';
        }
    } elseif ( $product->is_on_sale() && $product->get_type() === 'variable' ) {
        $available_variations = $product->get_available_variations();
        $max_percentage = 0;
        foreach ( $available_variations as $variation ) {
            $reg_price = $variation['display_regular_price'];
            $sal_price = $variation['display_price'];
            if ( $reg_price > 0 && $sal_price < $reg_price ) {
                $pct = round( ( ( $reg_price - $sal_price ) / $reg_price ) * 100 );
                if ( $pct > $max_percentage ) {
                    $max_percentage = $pct;
                }
            }
        }
        if ( $max_percentage > 0 ) {
            $price_html .= ' <span class="badge-sale">' . sprintf( esc_html__( 'Save %d%%', 'great-wall-theme' ), $max_percentage ) . '</span>';
        }
    }
    return $price_html;
}

/**
 * Render dynamic Tabby and Tamara installment breakdown calculator tabs.
 */
add_action( 'woocommerce_single_product_summary', 'great_wall_render_bnpl_tabs', 15 );
function great_wall_render_bnpl_tabs() {
    global $product;
    if ( ! $product ) {
        return;
    }
    $price = $product->get_price();
    if ( ! $price || $price <= 0 ) {
        return;
    }
    
    $tabby_installment = number_format( $price / 4, 2 );
    $tamara_installment = number_format( $price / 3, 2 );
    ?>
    <div class="bnpl-container-detail">
        <p class="bnpl-header-title"><?php esc_html_e( 'Pay in installments with', 'great-wall-theme' ); ?></p>
        <div class="bnpl-tabs-detail">
            <div class="bnpl-tab-detail active" data-bnpl="tabby">
                <span class="bnpl-dot-detail tabby-dot"></span>
                <div class="bnpl-tab-meta">
                    <span class="bnpl-tab-name">Tabby</span>
                    <span class="bnpl-tab-sub">4 &times; AED <?php echo esc_html( $tabby_installment ); ?> &mdash; 0% interest</span>
                </div>
            </div>
            <div class="bnpl-tab-detail" data-bnpl="tamara">
                <span class="bnpl-dot-detail tamara-dot"></span>
                <div class="bnpl-tab-meta">
                    <span class="bnpl-tab-name">Tamara</span>
                    <span class="bnpl-tab-sub">3 &times; AED <?php echo esc_html( $tamara_installment ); ?> &mdash; 0% interest</span>
                </div>
            </div>
        </div>
        <div class="bnpl-strip-detail">
            <p id="bnpl-strip-text">Split into <strong class="bnpl-highlight">4 easy payments of AED <span id="bnpl-strip-amount"><?php echo esc_html( $tabby_installment ); ?></span></strong> with <span id="bnpl-strip-provider">Tabby</span> &mdash; zero interest, zero fees.</p>
        </div>
    </div>
    
    <script>
    window.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('.bnpl-tab-detail');
        const amountText = document.getElementById('bnpl-strip-amount');
        const providerText = document.getElementById('bnpl-strip-provider');
        const highlightText = document.querySelector('.bnpl-highlight');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                
                const bnpl = tab.getAttribute('data-bnpl');
                if (bnpl === 'tabby') {
                    amountText.textContent = '<?php echo esc_js( $tabby_installment ); ?>';
                    providerText.textContent = 'Tabby';
                    highlightText.innerHTML = '4 easy payments of AED <?php echo esc_js( $tabby_installment ); ?>';
                } else {
                    amountText.textContent = '<?php echo esc_js( $tamara_installment ); ?>';
                    providerText.textContent = 'Tamara';
                    highlightText.innerHTML = '3 easy payments of AED <?php echo esc_js( $tamara_installment ); ?>';
                }
            });
        });
    });
    </script>
    <?php
}

/**
 * Render premium Trust Badges row right below the cart buttons.
 */
add_action( 'woocommerce_single_product_summary', 'great_wall_render_trust_badges', 35 );
function great_wall_render_trust_badges() {
    ?>
    <div class="product-trust-badges-row">
        <div class="trust-badge-item">
            <i class="ri-truck-line"></i>
            <span><?php esc_html_e( 'Free UAE delivery', 'great-wall-theme' ); ?></span>
        </div>
        <div class="trust-badge-item">
            <i class="ri-refresh-line"></i>
            <span><?php esc_html_e( '14-day returns', 'great-wall-theme' ); ?></span>
        </div>
        <div class="trust-badge-item">
            <i class="ri-shield-check-line"></i>
            <span><?php esc_html_e( '2-year warranty', 'great-wall-theme' ); ?></span>
        </div>
    </div>
    <?php
}

/**
 * Filter the product short description to dynamically remove the Specifications lines.
 */
add_filter( 'woocommerce_short_description', 'great_wall_remove_specs_from_short_desc', 99 );
function great_wall_remove_specs_from_short_desc( $post_excerpt ) {
    if ( is_admin() || ! is_product() ) {
        return $post_excerpt;
    }
    
    // If the short description contains specifications tags or keywords, replace it entirely with the fallback description
    if ( strpos( $post_excerpt, 'product-specifications' ) !== false || 
         strpos( $post_excerpt, 'Specifications' ) !== false || 
         strpos( $post_excerpt, 'Dimensions:' ) !== false ||
         strpos( $post_excerpt, 'Weight:' ) !== false ) {
        
        return '<p>Experience the peak of contemporary craftsmanship. Hand-tailored from premium materials, this architectural piece brings quiet luxury and clean, minimalist lines to any modern space in Dubai.</p>';
    }
    
    return $post_excerpt;
}

/**
 * Remove brackets from all product titles globally on the front-end.
 */
add_filter( 'the_title', 'great_wall_strip_parentheses_from_title', 10, 2 );
function great_wall_strip_parentheses_from_title( $title, $id = null ) {
    if ( ! is_admin() && $id && get_post_type( $id ) === 'product' ) {
        return str_replace( array( '(', ')' ), '', $title );
    }
    return $title;
}

/**
 * Move WooCommerce breadcrumbs inside the single product summary column right above the title.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 4 );

/**
 * Remove the product name from the end of the breadcrumb trail.
 */
add_filter( 'woocommerce_get_breadcrumb', 'great_wall_remove_product_title_from_breadcrumbs', 10, 2 );
function great_wall_remove_product_title_from_breadcrumbs( $crumbs, $breadcrumb ) {
    if ( is_product() && ! empty( $crumbs ) ) {
        array_pop( $crumbs );
    }
    return $crumbs;
}

/**
 * Force UAE Dirham currency symbol to render in English (AED) instead of Arabic (د.إ) with appropriate spacing.
 */
add_filter( 'woocommerce_currency_symbol', 'great_wall_force_aed_currency_symbol', 99, 2 );
function great_wall_force_aed_currency_symbol( $currency_symbol, $currency ) {
    if ( $currency === 'AED' ) {
        $pos = get_option( 'woocommerce_currency_pos' );
        if ( $pos === 'left' || $pos === 'left_space' ) {
            return 'AED ';
        } else {
            return ' AED';
        }
    }
    return $currency_symbol;
}

/**
 * Move WooCommerce single product tabs (Reviews & Specifications) outside the 2-column grid
 * so they render as a separate centered full-width section below the product columns.
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_after_single_product', 'woocommerce_output_product_data_tabs', 5 );

/**
 * Move WooCommerce single product Related Products and Upsells outside the 2-column grid
 * and render them below the Reviews/Specs section (at priority 20 and 15).
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 15 );

/**
 * Enable autoplay/slideshow for WooCommerce product gallery Flexslider.
 * Slides automatically unless hovered (on desktop) or touched/interacted.
 */
add_filter( 'woocommerce_single_product_carousel_options', 'great_wall_custom_carousel_options', 99 );
function great_wall_custom_carousel_options( $options ) {
	$options['slideshow']      = true;  // Enable automatic sliding
	$options['slideshowSpeed'] = 3500;  // Time between slides in milliseconds (3.5 seconds)
	$options['animationSpeed'] = 600;   // Transition duration (0.6 seconds)
	$options['pauseOnHover']   = true;  // Pause slideshow when mouse hovers over it
	return $options;
}
