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
	wp_enqueue_style( 'great-wall-styles', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0' );

	// Enqueue Remix Icons CDN.
	wp_enqueue_style( 'remix-icons', 'https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css', array(), '4.2.0' );

	// Enqueue main interactive javascript core.
	wp_enqueue_script( 'great-wall-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'great_wall_scripts' );

/**
 * Defer non-critical enqueued scripts for performance.
 */
function great_wall_defer_scripts( $tag, $handle, $src ) {
	if ( 'great-wall-js' === $handle ) {
		return '<script src="' . esc_url( $src ) . '" defer id="' . esc_attr( $handle ) . '-js"></script>' . "\n";
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'great_wall_defer_scripts', 10, 3 );

/**
 * Filter WooCommerce Cart count update dynamically via AJAX
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'great_wall_cart_count_fragments' );
	function great_wall_cart_count_fragments( $fragments ) {
		ob_start();
		?>
		<span class="cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
		<?php
		$fragments['span.cart-count'] = ob_get_clean();
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
