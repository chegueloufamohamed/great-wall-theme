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
  <div class="site-header-wrapper">
    <!-- Premium Announcement/Top Bar -->
    <div class="top-bar">
      <div class="top-bar-content">
        <div class="top-bar-slider">
          <div class="top-bar-slide">FREE SHIPPING FOR ORDERS OVER AED 1000</div>
          <div class="top-bar-slide">DELIVERY WITHIN 2-4 BUSINESS DAYS IN UAE</div>
        </div>
      </div>
    </div>
    
    <header class="header transparent">
    <div class="header-container">
      
      <!-- Brand Logo -->
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
        <img src="https://greatwallfurniture.com/wp-content/uploads/2026/06/Logo-White.png" alt="<?php bloginfo( 'name' ); ?>" style="max-height: 48px; width: auto; display: block;">
      </a>
      
      <!-- Hardcoded Premium Navigation Menu with Mega Dropdown -->
      <nav class="nav-menu">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link <?php echo is_front_page() ? 'active' : ''; ?>">
          <span class="nav-text-original">Home</span>
          <span class="nav-text-hover">Home</span>
        </a>
        
        <!-- Shop Dropdown Container -->
        <div class="nav-item-dropdown">
          <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="nav-link has-dropdown <?php echo is_post_type_archive( 'product' ) || is_tax( 'product_cat' ) ? 'active' : ''; ?>">
            <span class="nav-text-original">Shop <i class="ri-arrow-down-s-line dropdown-arrow"></i></span>
            <span class="nav-text-hover">Shop <i class="ri-arrow-down-s-line dropdown-arrow"></i></span>
          </a>
          
          <!-- Mega Menu Panel -->
          <div class="mega-menu-panel">
            <div class="mega-menu-grid">
              
              <!-- Column 1: OFFICE SEATING -->
              <div class="mega-menu-col">
                <h4 class="mega-menu-title">Office Seating</h4>
                <ul class="mega-menu-list">
                  <li><a href="<?php echo esc_url( home_url( '/product-category/office-chairs/' ) ); ?>">Office Chairs <span class="mega-badge badge-popular">Popular</span></a></li>
                  <li><a href="<?php echo esc_url( home_url( '/product-category/commercial-chairs/' ) ); ?>">Commercial Chairs</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/product-category/office-furniture/' ) ); ?>">Office Systems</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/product-category/reception-lounge-set/' ) ); ?>">Reception Lounge <span class="mega-badge badge-new">New</span></a></li>
                </ul>
              </div>

              <!-- Column 2: STEEL FURNITURE -->
              <div class="mega-menu-col">
                <h4 class="mega-menu-title">Steel Furniture</h4>
                <ul class="mega-menu-list">
                  <li><a href="<?php echo esc_url( home_url( '/product-category/cabinet/' ) ); ?>">Cabinets & Lockers <span class="mega-badge badge-hot">Hot</span></a></li>
                  <li><a href="<?php echo esc_url( home_url( '/product-category/shelves/' ) ); ?>">Shelves & Racks</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/product-category/shoerack/' ) ); ?>">Wooden Shoe Racks</a></li>
                </ul>
              </div>

              <!-- Column 3: BEDS & ACCOMMODATION -->
              <div class="mega-menu-col">
                <h4 class="mega-menu-title">Accommodation</h4>
                <ul class="mega-menu-list">
                  <li><a href="<?php echo esc_url( home_url( '/product-category/bunk-beds/' ) ); ?>">Metal Bunk Beds</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/product-category/single-beds/' ) ); ?>">Single Metal Beds</a></li>
                </ul>
              </div>

              <!-- Column 4: TABLES & DINING -->
              <div class="mega-menu-col">
                <h4 class="mega-menu-title">Tables & Dining</h4>
                <ul class="mega-menu-list">
                  <li><a href="<?php echo esc_url( home_url( '/product-category/dinning-tables/' ) ); ?>">Dining Tables</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/product-category/table/' ) ); ?>">Folding Tables</a></li>
                </ul>
              </div>

              <!-- Column 5: UTILITY & SYSTEMS -->
              <div class="mega-menu-col">
                <h4 class="mega-menu-title">Utility & Racks</h4>
                <ul class="mega-menu-list">
                  <li><a href="<?php echo esc_url( home_url( '/product-category/partition-stands/' ) ); ?>">Foldable Divider</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/product-category/hanger-stands/' ) ); ?>">Hanger Stands</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/product-category/air-cooler/' ) ); ?>">Air Coolers</a></li>
                </ul>
              </div>

            </div>
          </div>
        </div>
        
        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="nav-link <?php echo is_page( 'about' ) ? 'active' : ''; ?>">
          <span class="nav-text-original">Our Story</span>
          <span class="nav-text-hover">Our Story</span>
        </a>
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="nav-link <?php echo is_page( 'contact' ) ? 'active' : ''; ?>">
          <span class="nav-text-original">Showroom</span>
          <span class="nav-text-hover">Showroom</span>
        </a>
      </nav>
      
      <!-- Header Action Triggers -->
      <div class="header-actions">
        <?php
        if ( function_exists( 'pll_the_languages' ) ) {
          $languages = pll_the_languages( array( 'raw' => 1, 'hide_if_no_translation' => 0, 'hide_current' => 0 ) );
          if ( ! empty( $languages ) ) {
            ?>
            <div class="lang-switcher">
              <?php
              $langs_out = array();
              foreach ( $languages as $lang ) {
                $active_class = $lang['current_lang'] ? 'active' : '';
                $display_name = strtoupper( $lang['slug'] );
                if ( $display_name === 'ZH' ) { $display_name = '中文'; }
                elseif ( $display_name === 'AR' ) { $display_name = 'العربية'; }
                
                $langs_out[] = '<a href="' . esc_url( $lang['url'] ) . '" class="lang-link ' . esc_attr( $active_class ) . '">' . esc_html( $display_name ) . '</a>';
              }
              echo implode( '<span class="lang-separator">|</span>', $langs_out );
              ?>
            </div>
            <?php
          }
        }
        ?>
        <button class="action-btn search-trigger" title="<?php esc_attr_e( 'Search Products', 'great-wall-theme' ); ?>"><i class="ri-search-line"></i></button>
        
        <!-- Call Header Link -->
        <a href="tel:+97143202921" class="action-btn call-header-btn" title="<?php esc_attr_e( 'Call Us', 'great-wall-theme' ); ?>">
          <i class="ri-phone-line"></i>
        </a>

        <!-- Wishlist Header Trigger -->
        <button class="action-btn wishlist-trigger" title="<?php esc_attr_e( 'Open Wishlist', 'great-wall-theme' ); ?>">
          <i class="ri-heart-line wishlist-header-icon"></i>
          <span class="wishlist-count" style="display: none;">0</span>
        </button>
        
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
          <span class="custom-hamburger">
            <span class="bar bar-top"></span>
            <span class="bar bar-middle"></span>
            <span class="bar bar-bottom"></span>
          </span>
        </button>
      </div>
    </div>
  </header>
</div>
