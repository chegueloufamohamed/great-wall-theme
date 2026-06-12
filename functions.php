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
		add_theme_support( 'wc-product-gallery-zoom' );
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
	wp_enqueue_style( 'great-wall-styles', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.1' );

	// Enqueue Remix Icons CDN.
	wp_enqueue_style( 'remix-icons', 'https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css', array(), '4.2.0' );

	// Enqueue main interactive javascript core.
	wp_enqueue_script( 'great-wall-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.1', true );

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

add_action( 'woocommerce_before_main_content', 'great_wall_wrapper_start', 10 );
function great_wall_wrapper_start() {
	echo '<section class="section" style="padding-top: 140px;"><div class="container">';
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
