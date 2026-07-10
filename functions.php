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
endwhile; // Note: functions.php used endwhile or endif? It's if ( ! function_exists( 'great_wall_setup' ) ) : so it's endif;
