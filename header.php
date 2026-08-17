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
              
              <?php
              // Fetch all non-empty product categories (excluding uncategorized)
              $all_cats = get_terms( array(
                  'taxonomy'   => 'product_cat',
                  'hide_empty' => true,
                  'exclude'    => array( get_option( 'default_product_cat' ) ),
              ) );

              // Define our 5 columns and their associated category slugs
              $columns = array(
                  'office-furniture' => array(
                      'title' => 'Office Furniture',
                      'cats'  => array(),
                  ),
                  'steel-furniture' => array(
                      'title' => 'Steel Furniture',
                      'cats'  => array(),
                  ),
                  'accommodation' => array(
                      'title' => 'Accommodation',
                      'cats'  => array(),
                  ),
                  'tables-dining' => array(
                      'title' => 'Tables & Dining',
                      'cats'  => array(),
                  ),
                  'living-divider' => array(
                      'title' => 'Living & Divider',
                      'cats'  => array(),
                  ),
              );

              // Map categories to columns
              if ( ! empty( $all_cats ) && ! is_wp_error( $all_cats ) ) {
                  foreach ( $all_cats as $cat ) {
                      // Skip office-storage and chairs parent categories
                      if ( in_array( $cat->slug, array( 'office-storage', 'chairs' ) ) ) {
                          continue;
                      }
                      // Find which column this category belongs to by checking parent categories or its own slug
                      $assigned_col = '';
                      
                      // 1. Check parent hierarchy
                      $ancestors = get_ancestors( $cat->term_id, 'product_cat' );
                      if ( ! empty( $ancestors ) ) {
                          foreach ( $ancestors as $ancestor_id ) {
                              $ancestor = get_term( $ancestor_id, 'product_cat' );
                              if ( $ancestor && isset( $columns[ $ancestor->slug ] ) ) {
                                  $assigned_col = $ancestor->slug;
                                  break;
                              }
                          }
                      }
                      
                      // 2. If no parent matches, try mapping by category slug or parent slug matching
                      if ( ! $assigned_col ) {
                          $slug = $cat->slug;
                           if ( in_array( $slug, array( 'desks', 'workstations', 'storage-cabinet', 'drawer-cabinet', 'office-chairs', 'commercial-chairs', 'reception-lounge-set', 'office-furniture', 'conference-tables', 'conference-table' ) ) ) {
                               $assigned_col = 'office-furniture';
                           } elseif ( in_array( $slug, array( 'cabinet', 'shelves', 'steel-furniture' ) ) ) {
                               $assigned_col = 'steel-furniture';
                           } elseif ( in_array( $slug, array( 'bunk-beds', 'single-beds', 'accommodation', 'bed-frames', 'bed-frame', 'hanger', 'hangers', 'coat-hanger', 'court-hanger' ) ) ) {
                               $assigned_col = 'accommodation';
                           } elseif ( in_array( $slug, array( 'dinning-tables', 'table', 'tables-dining', 'coffee-tables', 'coffee-table', 'folding-tables', 'folding-table' ) ) ) {
                               $assigned_col = 'tables-dining';
                           } elseif ( in_array( $slug, array( 'sofa', 'partition-stands', 'living-divider' ) ) ) {
                               $assigned_col = 'living-divider';
                           }
                      }
                      
                      // Assign if a column is matched
                      if ( $assigned_col ) {
                          $columns[ $assigned_col ]['cats'][] = $cat;
                      }
                  }
              }

              // Column 1: OFFICE FURNITURE (with dynamic subgroups)
              ?>
              <div class="mega-menu-col">
                <h4 class="mega-menu-title"><?php echo esc_html( $columns['office-furniture']['title'] ); ?></h4>
                
                <div class="mega-menu-group-box">
                  <?php
                  $office_cats = $columns['office-furniture']['cats'];
                  
                  // Define subgroups
                  $subgroups = array(
                      'desks' => array(
                          'title' => 'Desks & Workstations',
                          'cats'  => array(),
                      ),
                      'storage' => array(
                          'title' => 'Office Storage',
                          'cats'  => array(),
                      ),
                      'chairs' => array(
                          'title' => 'Chairs',
                          'cats'  => array(),
                      ),
                      'sofa' => array(
                          'title' => 'Sofa',
                          'cats'  => array(),
                      ),
                      'other' => array(
                          'title' => 'Other Office',
                          'cats'  => array(),
                      ),
                  );
                  
                  // Distribute to subgroups
                  foreach ( $office_cats as $cat ) {
                      $slug = $cat->slug;
                      if ( strpos( $slug, 'desk' ) !== false || strpos( $slug, 'workstation' ) !== false || strpos( $slug, 'conference' ) !== false ) {
                          $subgroups['desks']['cats'][] = $cat;
                      } elseif ( strpos( $slug, 'cabinet' ) !== false || strpos( $slug, 'storage' ) !== false || strpos( $slug, 'drawer' ) !== false || strpos( $slug, 'locker' ) !== false || strpos( $slug, 'safe' ) !== false ) {
                          $subgroups['storage']['cats'][] = $cat;
                      } elseif ( strpos( $slug, 'chair' ) !== false || strpos( $slug, 'seating' ) !== false || strpos( $slug, 'stool' ) !== false ) {
                          $subgroups['chairs']['cats'][] = $cat;
                      } elseif ( strpos( $slug, 'sofa' ) !== false || strpos( $slug, 'lounge' ) !== false || strpos( $slug, 'reception' ) !== false ) {
                          $subgroups['sofa']['cats'][] = $cat;
                      } else {
                          // Exclude the parent 'office-furniture' category itself from showing as a duplicate child item inside the box
                          if ( $slug !== 'office-furniture' ) {
                              $subgroups['other']['cats'][] = $cat;
                          }
                      }
                  }
                  
                  // Render subgroups
                  foreach ( $subgroups as $sub_key => $subgroup ) {
                      if ( empty( $subgroup['cats'] ) ) {
                          continue;
                      }
                      ?>
                      <div class="mega-menu-subgroup">
                        <h5 class="mega-menu-subtitle"><?php echo esc_html( $subgroup['title'] ); ?></h5>
                        <ul class="mega-menu-sublist">
                          <?php foreach ( $subgroup['cats'] as $cat ) : 
                              $term_link = get_term_link( $cat );
                              $label = $cat->name;
                              if ( $sub_key === 'desks' && strcasecmp( $label, 'Office Desks' ) === 0 ) {
                                  $label = 'Desks';
                              }
                              ?>
                              <li>
                                <a href="<?php echo esc_url( $term_link ); ?>">
                                  <?php echo esc_html( $label ); ?>
                                  <?php
                                  if ( $cat->slug === 'workstations' ) {
                                      echo '<span class="mega-badge badge-new">New</span>';
                                  } elseif ( $cat->slug === 'office-chairs' ) {
                                      echo '<span class="mega-badge badge-popular">Popular</span>';
                                  }
                                  ?>
                                </a>
                              </li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                      <?php
                  }
                  ?>
                </div>
              </div>

              <?php
              // Columns 2, 3, 4, 5: Single list boxes
              foreach ( array( 'steel-furniture', 'accommodation', 'tables-dining', 'living-divider' ) as $col_key ) : 
                  $col = $columns[ $col_key ];
                  ?>
                  <div class="mega-menu-col">
                    <h4 class="mega-menu-title"><?php echo esc_html( $col['title'] ); ?></h4>
                    <ul class="mega-menu-list">
                      <?php
                      if ( ! empty( $col['cats'] ) ) {
                          foreach ( $col['cats'] as $cat ) {
                              $term_link = get_term_link( $cat );
                              if ( $cat->slug === $col_key ) {
                                  continue;
                              }
                              $label = $cat->name;
                              ?>
                              <li>
                                <a href="<?php echo esc_url( $term_link ); ?>">
                                  <?php echo esc_html( $label ); ?>
                                  <?php
                                  if ( $cat->slug === 'cabinet' ) {
                                      echo '<span class="mega-badge badge-hot">Hot</span>';
                                  }
                                  ?>
                                </a>
                              </li>
                              <?php
                          }
                      } else {
                          echo '<li><span style="font-size: 0.8rem; color: var(--color-muted);">' . esc_html__( 'No categories', 'great-wall-theme' ) . '</span></li>';
                      }
                      ?>
                    </ul>
                  </div>
              <?php endforeach; ?>

            </div>
            
            <div class="mega-menu-footer" style="margin-top: 24px; padding-top: 0; display: flex; justify-content: center; width: 100%;">
              <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="mega-menu-view-all">
                <span><?php esc_html_e( 'View All Products', 'great-wall-theme' ); ?></span>
                <i class="ri-arrow-right-line" style="font-size: 1rem; line-height: 1;"></i>
              </a>
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
        <div class="header-action-icons">
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
        </div>
        
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
