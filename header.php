<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- ==========================================================================
       GLOBAL GLASSMORPHIC HEADER
       ========================================================================== -->
  <header class="header transparent">
    <div class="header-container">
      
      <!-- Brand Logo Customizer Synch -->
      <?php
      if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
        the_custom_logo();
      } else {
        ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
          <div class="logo-icon"></div>
          Great Wall<span>Furniture</span>
        </a>
        <?php
      }
      ?>
      
      <!-- Dynamic WordPress Navigation with Hardcoded Showroom Fallback -->
      <nav class="nav-menu">
        <?php
        if ( has_nav_menu( 'primary-menu' ) ) {
          wp_nav_menu(
            array(
              'theme_location' => 'primary-menu',
              'container'      => false,
              'items_wrap'     => '%3$s',
              'fallback_cb'    => false,
            )
          );
        } else {
          ?>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link <?php echo is_front_page() ? 'active' : ''; ?>">Home</a>
          <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="nav-link <?php echo is_post_type_archive( 'product' ) || is_tax( 'product_cat' ) ? 'active' : ''; ?>">Collections</a>
          <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="nav-link <?php echo is_page( 'about' ) ? 'active' : ''; ?>">Our Story</a>
          <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="nav-link <?php echo is_page( 'contact' ) ? 'active' : ''; ?>">Showroom</a>
          <?php
        }
        ?>
      </nav>
      
      <!-- Header Action Triggers -->
      <div class="header-actions">
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="action-btn" title="<?php esc_attr_e( 'Search Showroom', 'great-wall-theme' ); ?>"><i class="ri-search-line"></i></a>
        
        <button class="action-btn cart-trigger" title="<?php esc_attr_e( 'Open Shopping Bag', 'great-wall-theme' ); ?>">
          <i class="ri-shopping-bag-line"></i>
          <!-- Show WooCommerce active cart contents dynamically if active -->
          <span class="cart-count">
            <?php 
            if ( class_exists( 'WooCommerce' ) ) {
              echo esc_html( WC()->cart->get_cart_contents_count() );
            } else {
              echo '0';
            }
            ?>
          </span>
        </button>
        
        <button class="action-btn menu-toggle menu-toggle-trigger" title="<?php esc_attr_e( 'Open Menu', 'great-wall-theme' ); ?>">
          <i class="ri-menu-line"></i>
        </button>
      </div>
    </div>
  </header>
