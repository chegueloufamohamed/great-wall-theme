<?php
/**
 * The template for displaying the custom homepage
 *
 * @package great-wall-theme
 */

get_header();

// Get the assets base URI
$assets_uri = get_template_directory_uri() . '/assets/images/';
?>

  <style id="hero-custom-desktop-framing">
    @media (min-width: 769px) {
      section.hero {
        position: relative !important;
        height: auto !important;
        padding-top: 155px !important;
        padding-bottom: 30px !important;
        padding-left: 50px !important;
        padding-right: 50px !important;
        box-sizing: border-box !important;
        background-color: #FFFFFF !important;
      }

      body.admin-bar section.hero {
        padding-top: 185px !important;
      }

      section.hero .hero-slider {
        width: 100% !important;
        max-width: 980px !important;
        aspect-ratio: 16 / 9 !important;
        height: auto !important;
        margin: 0 auto !important;
        border-radius: 20px !important;
        overflow: hidden !important;
        box-shadow: 0 12px 36px rgba(0, 0, 0, 0.08) !important;
      }

      section.hero .hero-slide,
      section.hero .hero-bg,
      section.hero #hero-bg-video {
        width: 100% !important;
        height: 100% !important;
        object-fit: contain !important;
        border-radius: 20px !important;
        overflow: hidden !important;
      }
    }
  </style>

  <!-- ==========================================================================
       HERO CAROUSEL SECTION
       ========================================================================== -->
  <section class="hero">
    <div class="hero-slider">
      
      <!-- Single active hero slide with background video -->
      <div class="hero-slide active">
        <div class="hero-bg">
          <video id="hero-bg-video" autoplay loop muted playsinline poster="<?php echo esc_url( $assets_uri . 'hero_sofa.webp' ); ?>" style="width: 100%; height: 100%; object-fit: contain; position: absolute; top: 0; left: 0;">
            <!-- Source will be dynamically appended here via inline JavaScript based on user screen size -->
          </video>
          <script>
            (function() {
              var video = document.getElementById('hero-bg-video');
              if (video) {
                var desktopSrc = 'https://greatwallfurniture.com/wp-content/uploads/2026/09/website-banner-1.mp4';
                var mobileSrc = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Grate-Wall-Website-Bunner-V.mp4';
                var source = document.createElement('source');
                if (window.innerWidth <= 768) {
                  source.setAttribute('src', mobileSrc);
                } else {
                  source.setAttribute('src', desktopSrc);
                }
                source.setAttribute('type', 'video/mp4');
                video.appendChild(source);
              }
            })();
          </script>
        </div>

      </div>
      
    </div>
  <!-- ==========================================================================
       HERO BRAND MESSAGING, CATEGORY SHORTCUTS & CTA SECTION
       ========================================================================== -->
  <section class="section brand-hero-intro-section" style="padding-top: 50px; padding-bottom: 60px; background-color: #FFFFFF;">
    <div class="container" style="max-width: 1140px; margin: 0 auto; text-align: center;">
      
      <!-- Brand & Key Messaging -->
      <div class="brand-intro-content" style="max-width: 820px; margin: 0 auto 40px auto;" data-scroll>
        <span class="brand-badge-tag" style="display: inline-block; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 0.8rem; font-weight: 800; color: #C5A880; text-transform: uppercase; letter-spacing: 0.18em; margin-bottom: 14px; background: rgba(197, 168, 128, 0.12); padding: 6px 16px; border-radius: 30px;">
          <?php esc_html_e( 'Bespoke Craftsmanship & Luxury Living', 'great-wall-theme' ); ?>
        </span>
        <h1 class="brand-intro-title" style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 800; color: #1C1C1E; letter-spacing: -0.02em; line-height: 1.25; margin-bottom: 18px;">
          <?php esc_html_e( 'Elevate Your Interior with Mastercrafted Furniture Built for Distinction', 'great-wall-theme' ); ?>
        </h1>
        <p class="brand-intro-desc" style="font-family: var(--font-sans); font-size: 1.1rem; color: #5C5954; line-height: 1.7; margin: 0 auto 32px auto; max-width: 720px;">
          <?php esc_html_e( 'From executive corporate offices to luxury residential settings, Great Wall Furniture combines premium materials, local Dubai craftsmanship, and custom dimensions tailored across all seven Emirates.', 'great-wall-theme' ); ?>
        </p>

        <!-- CTA Action Buttons -->
        <div class="brand-cta-buttons" style="display: flex; gap: 16px; justify-content: center; align-items: center; flex-wrap: wrap;">
          <a href="https://wa.me/971506548778?text=Hello%20Great%20Wall%20Furniture,%20I%20would%20like%20to%20request%20a%20quote" target="_blank" rel="noopener" class="btn btn-primary cta-quote-btn" style="background-color: #1C1C1E; color: #FFFFFF; font-weight: 700; padding: 14px 32px; border-radius: 40px; font-size: 1rem; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s ease; box-shadow: 0 10px 25px rgba(0,0,0,0.12);">
            <i class="ri-chat-quote-line" style="font-size: 1.2rem;"></i>
            <span><?php esc_html_e( 'Request a Quote', 'great-wall-theme' ); ?></span>
          </a>
          <a href="#showroom-section" class="btn btn-secondary cta-contact-btn" style="background-color: transparent; color: #1C1C1E; font-weight: 700; padding: 14px 32px; border-radius: 40px; font-size: 1rem; text-decoration: none; border: 2px solid #1C1C1E; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s ease;">
            <i class="ri-map-pin-line" style="font-size: 1.2rem;"></i>
            <span><?php esc_html_e( 'Contact Us', 'great-wall-theme' ); ?></span>
          </a>
        </div>
      </div>

      <!-- Main Product Category Shortcuts -->
      <div class="brand-category-shortcuts" style="border-top: 1px solid rgba(0, 0, 0, 0.08); padding-top: 35px;" data-scroll>
        <span class="shortcuts-label" style="display: block; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 0.78rem; font-weight: 800; color: #8E8E93; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 20px;">
          <?php esc_html_e( 'Explore Main Product Categories', 'great-wall-theme' ); ?>
        </span>
        <div class="shortcuts-grid" style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; align-items: center;">
          <a href="<?php echo esc_url( home_url( '/product-category/desks/' ) ); ?>" class="shortcut-pill" style="display: inline-flex; align-items: center; gap: 10px; background-color: #F8F7F5; color: #1C1C1E; font-weight: 700; font-size: 0.92rem; padding: 12px 22px; border-radius: 30px; text-decoration: none; border: 1px solid rgba(0,0,0,0.06); transition: all 0.25s ease;">
            <i class="ri-computer-line" style="color: #C5A880; font-size: 1.1rem;"></i>
            <span><?php esc_html_e( 'Desks & Workstations', 'great-wall-theme' ); ?></span>
          </a>
          <a href="<?php echo esc_url( home_url( '/product-category/office-chairs/' ) ); ?>" class="shortcut-pill" style="display: inline-flex; align-items: center; gap: 10px; background-color: #F8F7F5; color: #1C1C1E; font-weight: 700; font-size: 0.92rem; padding: 12px 22px; border-radius: 30px; text-decoration: none; border: 1px solid rgba(0,0,0,0.06); transition: all 0.25s ease;">
            <i class="ri-armchair-line" style="color: #C5A880; font-size: 1.1rem;"></i>
            <span><?php esc_html_e( 'Office & Executive Chairs', 'great-wall-theme' ); ?></span>
          </a>
          <a href="<?php echo esc_url( home_url( '/product-category/storage-cabinet/' ) ); ?>" class="shortcut-pill" style="display: inline-flex; align-items: center; gap: 10px; background-color: #F8F7F5; color: #1C1C1E; font-weight: 700; font-size: 0.92rem; padding: 12px 22px; border-radius: 30px; text-decoration: none; border: 1px solid rgba(0,0,0,0.06); transition: all 0.25s ease;">
            <i class="ri-archive-drawer-line" style="color: #C5A880; font-size: 1.1rem;"></i>
            <span><?php esc_html_e( 'Storage & Lockers', 'great-wall-theme' ); ?></span>
          </a>
          <a href="<?php echo esc_url( home_url( '/product-category/sofa/' ) ); ?>" class="shortcut-pill" style="display: inline-flex; align-items: center; gap: 10px; background-color: #F8F7F5; color: #1C1C1E; font-weight: 700; font-size: 0.92rem; padding: 12px 22px; border-radius: 30px; text-decoration: none; border: 1px solid rgba(0,0,0,0.06); transition: all 0.25s ease;">
            <i class="ri-sofa-line" style="color: #C5A880; font-size: 1.1rem;"></i>
            <span><?php esc_html_e( 'Sofas & Loungers', 'great-wall-theme' ); ?></span>
          </a>
          <a href="<?php echo esc_url( home_url( '/product-category/bunk-beds/' ) ); ?>" class="shortcut-pill" style="display: inline-flex; align-items: center; gap: 10px; background-color: #F8F7F5; color: #1C1C1E; font-weight: 700; font-size: 0.92rem; padding: 12px 22px; border-radius: 30px; text-decoration: none; border: 1px solid rgba(0,0,0,0.06); transition: all 0.25s ease;">
            <i class="ri-hotel-bed-line" style="color: #C5A880; font-size: 1.1rem;"></i>
            <span><?php esc_html_e( 'Beds & Accommodation', 'great-wall-theme' ); ?></span>
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- ==========================================================================
       COLLECTION CATEGORIES GRID
       ========================================================================== -->
  <section class="section">
    <div class="container">
      <div class="section-title-wrapper text-center" data-scroll>
        <span class="section-subtitle">Exquisite Hand-Crafted Ranges</span>
        <h2 class="section-title">Shop By Room Collection</h2>
      </div>
      <?php
      if ( ! function_exists( 'great_wall_get_category_image_with_fallback' ) ) {
          function great_wall_get_category_image_with_fallback( $slug, $default_fallback ) {
              $term = get_term_by( 'slug', $slug, 'product_cat' );
              if ( $term ) {
                  $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
                  if ( $thumbnail_id ) {
                      $img_url = wp_get_attachment_url( $thumbnail_id );
                      if ( $img_url ) {
                          return $img_url;
                      }
                  }
              }
              return $default_fallback;
          }
      }

      if ( ! function_exists( 'great_wall_get_collection_image_url' ) ) {
          function great_wall_get_collection_image_url( $slugs ) {
              if ( ! is_array( $slugs ) ) {
                  $slugs = array( $slugs );
              }
              
              foreach ( $slugs as $slug ) {
                  $term = get_term_by( 'slug', $slug, 'product_cat' );
                  if ( ! $term ) {
                      continue;
                  }
                  
                  // 1. Try WooCommerce category thumbnail
                  $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
                  if ( $thumbnail_id ) {
                      $img_url = wp_get_attachment_url( $thumbnail_id );
                      if ( $img_url ) {
                          return $img_url;
                      }
                  }
                  
                  // 2. Try first product in this category
                  $args = array(
                      'post_type'      => 'product',
                      'posts_per_page' => 1,
                      'tax_query'      => array(
                          array(
                              'taxonomy' => 'product_cat',
                              'field'    => 'slug',
                              'terms'    => $slug,
                          ),
                      ),
                  );
                  $query = new WP_Query( $args );
                  if ( $query->have_posts() ) {
                      $query->the_post();
                      $image_id = get_post_thumbnail_id();
                      wp_reset_postdata();
                      if ( $image_id ) {
                          $img_url = wp_get_attachment_url( $image_id );
                          if ( $img_url ) {
                              return $img_url;
                          }
                      }
                  }
              }
              
              // Fallback to high-quality default uploads
              $first_slug = $slugs[0];
              if ( 'desks' === $first_slug ) {
                  return 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Collection-Deks.webp';
              } elseif ( 'chairs' === $first_slug || 'chair' === $first_slug || 'office-chairs' === $first_slug ) {
                  return 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Collection-Chair.webp';
              } elseif ( 'storage-cabinet' === $first_slug || 'cabinet' === $first_slug ) {
                  return 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Collection-Book-Shelf.webp';
              } elseif ( 'sofa' === $first_slug ) {
                  return 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Collection-Sofa.webp';
              }
              
              return wc_placeholder_img_src();
          }
      }

      $desk_img = great_wall_get_collection_image_url( 'desks' );
      $chair_img = great_wall_get_collection_image_url( array( 'chairs', 'office-chairs' ) );
      $storage_img = great_wall_get_collection_image_url( 'storage-cabinet' );
      $sofa_img = great_wall_get_collection_image_url( 'sofa' );

      $desks_cat = get_term_by( 'slug', 'desks', 'product_cat' );
      $desks_link = $desks_cat ? get_term_link( $desks_cat ) : home_url( '/product-category/desks/' );

      $chairs_cat = get_term_by( 'slug', 'chairs', 'product_cat' ) ?: get_term_by( 'slug', 'office-chairs', 'product_cat' );
      $chairs_link = $chairs_cat ? get_term_link( $chairs_cat ) : home_url( '/product-category/office-chairs/' );

      $storage_cat = get_term_by( 'slug', 'storage-cabinet', 'product_cat' ) ?: get_term_by( 'slug', 'cabinet', 'product_cat' );
      $storage_link = $storage_cat ? get_term_link( $storage_cat ) : home_url( '/product-category/storage-cabinet/' );

      $sofa_cat = get_term_by( 'slug', 'sofa', 'product_cat' );
      $sofa_link = $sofa_cat ? get_term_link( $sofa_cat ) : home_url( '/product-category/sofa/' );
      ?>
      
      <div class="grid categories-grid">
        <!-- Card 1: Desks -->
        <a href="<?php echo esc_url( $desks_link ); ?>" class="category-card delay-100" data-scroll>
          <div class="category-img">
            <img loading="lazy" src="<?php echo esc_url( $desk_img ); ?>" alt="Desks Category">
          </div>
          <div class="category-overlay">
            <h3 class="category-title">Desks</h3>
            <span class="category-count">Executive Workspaces</span>
          </div>
        </a>
        
        <!-- Card 2: Chairs -->
        <a href="<?php echo esc_url( $chairs_link ); ?>" class="category-card delay-200" data-scroll>
          <div class="category-img">
            <img loading="lazy" src="<?php echo esc_url( $chair_img ); ?>" alt="Chairs Category">
          </div>
          <div class="category-overlay">
            <h3 class="category-title">Chairs</h3>
            <span class="category-count">Ergonomic Office Seating</span>
          </div>
        </a>
        
        <!-- Card 3: Storage Cabinet -->
        <a href="<?php echo esc_url( $storage_link ); ?>" class="category-card delay-300" data-scroll>
          <div class="category-img">
            <img loading="lazy" src="<?php echo esc_url( $storage_img ); ?>" alt="Storage Cabinet Category">
          </div>
          <div class="category-overlay">
            <h3 class="category-title">Storage Cabinet</h3>
            <span class="category-count">Cabinets & Lockers</span>
          </div>
        </a>
        
        <!-- Card 4: Sofa -->
        <a href="<?php echo esc_url( $sofa_link ); ?>" class="category-card delay-400" data-scroll>
          <div class="category-img">
            <img loading="lazy" src="<?php echo esc_url( $sofa_img ); ?>" alt="Sofa Category">
          </div>
          <div class="category-overlay">
            <h3 class="category-title">Sofa</h3>
            <span class="category-count">Premium Lounge Comfort</span>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       SHOP BY ROOM COLLECTION - EXTENDED BANNER & CATEGORY GRID SECTION
       ========================================================================== -->
  <section class="section category-extended-section" style="padding-top: 0; padding-bottom: 80px;">
    <div class="container">
      
      <!-- Part 1: Top 3 Large Banners -->
      <div class="rls-banners-row" style="margin-bottom: 50px;">
        <!-- Banner 1: Steel Furniture -->
        <a href="<?php echo esc_url( add_query_arg( 'cat', 'cabinet,single-beds,bunk-beds', home_url( '/shop/' ) ) ); ?>" class="rls-banner-card banner-steel">
          <div class="rls-banner-img">
            <img loading="lazy" src="<?php echo esc_url( great_wall_get_category_image_with_fallback( 'cabinet', 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Steel-Furniture.webp' ) ); ?>" alt="Steel Furniture Banner">
          </div>
          <div class="rls-banner-overlay">
            <h3 class="rls-banner-title">Steel Furniture</h3>
            <span class="rls-banner-btn btn-white">Shop This</span>
          </div>
        </a>

        <!-- Banner 2: Office Furniture -->
        <a href="<?php echo esc_url( home_url( '/product-category/office-furniture/' ) ); ?>" class="rls-banner-card banner-office">
          <div class="rls-banner-img">
            <img loading="lazy" src="<?php echo esc_url( great_wall_get_category_image_with_fallback( 'office-furniture', 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Office-Furniture.webp' ) ); ?>" alt="Office Furniture Banner">
          </div>
          <div class="rls-banner-overlay">
            <h3 class="rls-banner-title">Office Furniture</h3>
            <span class="rls-banner-btn btn-pink">Shop Online</span>
          </div>
        </a>

        <!-- Banner 3: Staff Accommodation -->
        <a href="<?php echo esc_url( home_url( '/product-category/bunk-beds/' ) ); ?>" class="rls-banner-card banner-staff">
          <div class="rls-banner-img">
            <img loading="lazy" src="<?php echo esc_url( great_wall_get_category_image_with_fallback( 'bunk-beds', 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Staff-Accomodation.webp' ) ); ?>" alt="Staff Accommodation Banner">
          </div>
          <div class="rls-banner-overlay">
            <h3 class="rls-banner-title">Staff Accommodation</h3>
            <span class="rls-banner-btn btn-black">Shop Online</span>
          </div>
        </a>
      </div>

      <!-- Part 2: 12 Categories Grid -->
      <div class="rls-category-grid-12">
        <?php
        $cats = get_terms( array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
            'exclude'    => array( get_option( 'default_product_cat' ) ), // Exclude Uncategorized
        ) );

        if ( ! empty( $cats ) && ! is_wp_error( $cats ) ) {
            // 1. Filter out parent categories with children
            $filtered_cats = array();
            foreach ( $cats as $cat ) {
                $children = get_term_children( $cat->term_id, 'product_cat' );
                if ( empty( $children ) || is_wp_error( $children ) ) {
                    $filtered_cats[] = $cat;
                }
            }

            // 2. Sort by the exact custom order
            $ordered_slugs = array(
                'desks',
                'workstations',
                'storage-cabinet',
                'drawer-cabinet',
                'cabinet',
                'steel-storage',
                'steel-storage-and-lockers',
                'office-chairs',
                'commercial-chairs',
                'sofa',
                'bed-frames',
                'bunk-beds',
                'court-hanger',
                'hanger-stands',
                'hanger',
                'hangers',
                'partition-stands',
                'foldable-room-divider',
                'reception-lounge-set',
                'shelves',
                'single-beds',
                'coffee-tables',
                'coffee-table',
                'conference-tables',
                'conference-table',
                'dinning-tables',
                'dining-tables',
                'folding-tables',
                'folding-table'
            );

            usort( $filtered_cats, function( $a, $b ) use ( $ordered_slugs ) {
                $pos_a = array_search( $a->slug, $ordered_slugs );
                $pos_b = array_search( $b->slug, $ordered_slugs );
                
                $pos_a = ( $pos_a === false ) ? 999 : $pos_a;
                $pos_b = ( $pos_b === false ) ? 999 : $pos_b;
                
                return $pos_a - $pos_b;
            } );

            foreach ( $filtered_cats as $cat ) {
                $term_link = get_term_link( $cat );
                if ( is_wp_error( $term_link ) ) {
                    continue;
                }
                
                // Get WooCommerce category thumbnail
                $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                $image_url = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id ) : '';
                
                // Fallback mappings to high-quality images based on slug
                if ( ! $image_url ) {
                    $slug = $cat->slug;
                    if ( $slug === 'bunk-beds' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Bunk-Beds.webp';
                    } elseif ( $slug === 'cabinet' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Cabinet.webp';
                    } elseif ( $slug === 'office-chairs' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Office-Chairs.webp';
                    } elseif ( $slug === 'commercial-chairs' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Commercial-Chairs.webp';
                    } elseif ( $slug === 'dinning-tables' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Dinning-Tables.webp';
                    } elseif ( $slug === 'partition-stands' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Room-Divider.webp';
                    } elseif ( $slug === 'office-furniture' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Desks.webp';
                    } elseif ( $slug === 'reception-lounge-set' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Reception-Lounge.webp';
                    } elseif ( $slug === 'shelves' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Shelves.webp';
                    } elseif ( $slug === 'sofa' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Sofa.webp';
                    } elseif ( $slug === 'single-beds' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Single-Beds.webp';
                    } elseif ( $slug === 'table' || $slug === 'folding-tables' || $slug === 'folding-table' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Table.webp';
                    } elseif ( $slug === 'bed-frames' || $slug === 'bed-frame' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Bed-Frames.webp';
                    } elseif ( $slug === 'coffee-tables' || $slug === 'coffee-table' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Coffee-Tables.webp';
                    } elseif ( $slug === 'workstations' || $slug === 'workstation' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Workstations.webp';
                    } elseif ( $slug === 'conference-tables' || $slug === 'conference-table' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Conference-Tables.webp';
                    } elseif ( $slug === 'drawer-cabinet' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Drawer-Cabinet.webp';
                    } elseif ( $slug === 'hanger' || $slug === 'hangers' || $slug === 'coat-hanger' || $slug === 'court-hanger' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Hanger.webp';
                    } elseif ( $slug === 'desks' || $slug === 'desk' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Desks-1.webp';
                    } elseif ( $slug === 'storage-cabinet' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Storage-Cabinet.webp';
                    } elseif ( $slug === 'steel-storage' ) {
                        $image_url = 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Cabinet.webp';
                    } else {
                        // Safe fallback placeholder
                        $image_url = function_exists( 'wc_placeholder_img_src' ) ? wc_placeholder_img_src() : '';
                    }
                }
                ?>
                <a href="<?php echo esc_url( $term_link ); ?>" class="rls-cat-item">
                  <div class="rls-cat-img-box">
                    <img loading="lazy" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $cat->name ); ?>">
                  </div>
                  <h4 class="rls-cat-label"><?php echo esc_html( $cat->name ); ?></h4>
                </a>
                <?php
            }
        }
        ?>
      </div>

    </div>
  </section>



  <!-- ==========================================================================
       WHY CHOOSE US / VALUE PROPOSITIONS
       ========================================================================== -->
  <section class="section">
    <div class="container">
      <div class="section-title-wrapper text-center" data-scroll>
        <span class="section-subtitle">The Great Wall Standard</span>
        <h2 class="section-title">The Showroom Pillars</h2>
      </div>

      <div class="grid features-grid">
        <!-- Pillar 1 -->
        <div class="feature-card delay-100" data-scroll>
          <div class="feature-icon-wrapper"><i class="ri-award-line"></i></div>
          <h3 class="feature-title">Refined Materials</h3>
          <p class="feature-desc">We import Italian marble blocks, sustainable French oak veneers, and Belgian bouclé to ensure unmatched sensory luxury.</p>
        </div>
        
        <!-- Pillar 2 -->
        <div class="feature-card delay-200" data-scroll>
          <div class="feature-icon-wrapper"><i class="ri-hand-heart-line"></i></div>
          <h3 class="feature-title">Dubai Craftsmanship</h3>
          <p class="feature-desc">Each piece is cut, assembled, and finished by highly accomplished master carpenters locally in Ras Al Khor.</p>
        </div>
        
        <!-- Pillar 3 -->
        <div class="feature-card delay-300" data-scroll>
          <div class="feature-icon-wrapper"><i class="ri-equalizer-line"></i></div>
          <h3 class="feature-title">Bespoke Scaling</h3>
          <p class="feature-desc">Need a table or sofa in custom dimensions? Our designers will draft CAD plans tailored specifically to your home.</p>
        </div>
        
        <!-- Pillar 4 -->
        <div class="feature-card delay-400" data-scroll>
          <div class="feature-icon-wrapper"><i class="ri-truck-line"></i></div>
          <h3 class="feature-title">Premium Delivery</h3>
          <p class="feature-desc">Enjoy full-service white-glove transport and precise in-home installation across all seven Emirates.</p>
        </div>
      </div>
    </div>
  </section>









  <!-- ==========================================================================
       REVIEWS & CLIENT TESTIMONIALS SECTION (Carousel + Write a Review Modal)
       ========================================================================== -->
  <section class="section reviews-section">
    <div class="container">
      <div class="section-title-wrapper text-center" style="margin-bottom: 50px;" data-scroll>
        <span class="section-subtitle"><?php esc_html_e( 'Testimonials', 'great-wall-theme' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'What Our Clients Say', 'great-wall-theme' ); ?></h2>
      </div>

      <div class="reviews-carousel-wrapper">
        <!-- Circular Black Navigation Arrows -->
        <button class="reviews-nav-btn prev-btn" id="reviews-prev" aria-label="<?php esc_attr_e( 'Previous Review', 'great-wall-theme' ); ?>"><i class="ri-arrow-left-s-line"></i></button>
        
        <div class="reviews-track-container">
          <div class="reviews-track" id="reviews-track">
            <!-- Review Card 1 -->
            <div class="review-card">
              <div class="review-stars">
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
              </div>
              <p class="review-body">"Awesome! The level of customer service is excellent. All the time! On the first attempt, correct or modify! I'm so happy 😊"</p>
              <h4 class="review-author"><?php esc_html_e( 'JetLife Vacations', 'great-wall-theme' ); ?></h4>
            </div>

            <!-- Review Card 2 -->
            <div class="review-card">
              <div class="review-stars">
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
              </div>
              <p class="review-body">"Supper fast help with changing the theme! like it ! the theme is also very nice! We are looking forward to relaunch our store."</p>
              <h4 class="review-author"><?php esc_html_e( 'KANNOBA', 'great-wall-theme' ); ?></h4>
            </div>

            <!-- Review Card 3 -->
            <div class="review-card">
              <div class="review-stars">
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
              </div>
              <p class="review-body">"Great and beautiful theme, with light-speed Customer Service and Developer team response for customization."</p>
              <h4 class="review-author"><?php esc_html_e( 'Jaco TV Shopping', 'great-wall-theme' ); ?></h4>
            </div>

            <!-- Review Card 4 -->
            <div class="review-card">
              <div class="review-stars">
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
              </div>
              <p class="review-body">"I recommend Yuva because their customer service is top notch if you have any issues. They solve the problem."</p>
              <h4 class="review-author"><?php esc_html_e( 'Japanese Suki', 'great-wall-theme' ); ?></h4>
            </div>
          </div>
        </div>

        <button class="reviews-nav-btn next-btn" id="reviews-next" aria-label="<?php esc_attr_e( 'Next Review', 'great-wall-theme' ); ?>"><i class="ri-arrow-right-s-line"></i></button>
      </div>

      <div class="text-center" style="margin-top: 40px;" data-scroll>
        <button class="btn btn-primary" style="border-radius: 30px; padding: 12px 30px; height: auto;" onclick="openReviewModal()"><?php esc_html_e( 'Share Your Experience', 'great-wall-theme' ); ?></button>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       SHOWROOM LOCATION & GOOGLE MAP SECTION (Phase 14)
       ========================================================================== -->
  <section class="section showroom-section">
    <div class="container">
      <div class="showroom-grid">
        <!-- Left Column: Showroom details -->
        <div class="showroom-info-col" data-scroll>
          <div class="showroom-title-wrapper">
            <span class="section-subtitle"><?php esc_html_e( 'Find Our Showroom', 'great-wall-theme' ); ?></span>
            <h2 class="showroom-title"><?php esc_html_e( 'Visit Our Dubai Showroom Floors', 'great-wall-theme' ); ?></h2>
            <p style="color: var(--color-secondary); font-size: 1.05rem; line-height: 1.6; margin-top: 15px;"><?php esc_html_e( 'Experience the beauty of custom craftsmanship in person. Speak with our expert designers and explore our curated material finishes and wood selection.', 'great-wall-theme' ); ?></p>
          </div>

          <div class="showroom-details-box">
            <!-- Item 1: Address -->
            <div class="showroom-info-block">
              <div class="showroom-icon-frame"><i class="ri-map-pin-line"></i></div>
              <div>
                <div class="showroom-info-label"><?php esc_html_e( 'Address', 'great-wall-theme' ); ?></div>
                <div class="showroom-info-text"><?php esc_html_e( 'Showroom 4, Ras Al Khor Industrial 2, Dubai, United Arab Emirates', 'great-wall-theme' ); ?></div>
              </div>
            </div>

            <!-- Item 2: Telephone -->
            <div class="showroom-info-block">
              <div class="showroom-icon-frame"><i class="ri-phone-line"></i></div>
              <div>
                <div class="showroom-info-label"><?php esc_html_e( 'Telephone', 'great-wall-theme' ); ?></div>
                <div class="showroom-info-text"><?php esc_html_e( '+971 4 320 2921', 'great-wall-theme' ); ?></div>
              </div>
            </div>

            <!-- Item 3: Email -->
            <div class="showroom-info-block">
              <div class="showroom-icon-frame"><i class="ri-mail-line"></i></div>
              <div>
                <div class="showroom-info-label"><?php esc_html_e( 'Email Support', 'great-wall-theme' ); ?></div>
                <div class="showroom-info-text"><?php esc_html_e( 'info@greatwallfurniture.com', 'great-wall-theme' ); ?></div>
              </div>
            </div>
          </div>

          <!-- Opening Hours Sub-box -->
          <div class="showroom-hours-box">
            <h3 class="showroom-hours-title"><?php esc_html_e( 'Showroom Hours', 'great-wall-theme' ); ?></h3>
            <div class="showroom-hours-row">
              <span><?php esc_html_e( 'Saturday - Thursday', 'great-wall-theme' ); ?></span>
              <span class="showroom-hours-val"><?php esc_html_e( '9:00 AM - 8:00 PM', 'great-wall-theme' ); ?></span>
            </div>
            <div class="showroom-hours-row">
              <span><?php esc_html_e( 'Friday', 'great-wall-theme' ); ?></span>
              <span class="showroom-hours-val"><?php esc_html_e( '2:00 PM - 8:00 PM', 'great-wall-theme' ); ?></span>
            </div>
          </div>
        </div>

        <!-- Right Column: Google Map Embed iframe -->
        <div class="showroom-map-col" data-scroll>
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3610.8407842600277!2d55.352431!3d25.1748249!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f6630f5555555%3A0x6b81ef1246197be0!2sShowroom%204%2C%20Ras%20Al%20Khor%20Industrial%20Area%20-%202%20-%20Dubai!5e0!3m2!1sen!2sae!4v1717282000000!5m2!1sen!2sae" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            title="<?php esc_attr_e( 'Google Maps Location of Great Wall Furniture Showroom Dubai', 'great-wall-theme' ); ?>">
          </iframe>
        </div>
      </div>
    </div>
  </section>

  <!-- Write a Review Modal -->
  <div class="review-modal" id="review-modal">
    <div class="review-modal-content">
      <button class="review-modal-close" onclick="closeReviewModal()"><i class="ri-close-line"></i></button>
      <h3 style="font-family: var(--font-serif); font-size: 1.8rem; margin-bottom: 10px; color: var(--color-primary);"><?php esc_html_e( 'Write a Review', 'great-wall-theme' ); ?></h3>
      <p style="font-size: 0.9rem; color: var(--color-secondary); margin-bottom: 25px;"><?php esc_html_e( 'Tell us about your experience with Great Wall Furniture showroom.', 'great-wall-theme' ); ?></p>
      
      <form id="add-review-form" onsubmit="submitReviewForm(event)">
        <div style="margin-bottom: 20px;">
          <label style="display: block; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 8px; color: var(--color-primary);"><?php esc_html_e( 'Select Stars:', 'great-wall-theme' ); ?></label>
          <div class="rating-select" id="rating-select-stars">
            <span class="rating-star-btn active" data-value="1" onclick="setRatingValue(1)"><i class="ri-star-fill"></i></span>
            <span class="rating-star-btn active" data-value="2" onclick="setRatingValue(2)"><i class="ri-star-fill"></i></span>
            <span class="rating-star-btn active" data-value="3" onclick="setRatingValue(3)"><i class="ri-star-fill"></i></span>
            <span class="rating-star-btn active" data-value="4" onclick="setRatingValue(4)"><i class="ri-star-fill"></i></span>
            <span class="rating-star-btn active" data-value="5" onclick="setRatingValue(5)"><i class="ri-star-fill"></i></span>
          </div>
          <input type="hidden" name="rating" id="review-rating-value" value="5">
        </div>

        <div style="margin-bottom: 20px;">
          <label for="review-author-input" style="display: block; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 8px; color: var(--color-primary);"><?php esc_html_e( 'Your Name / Company:', 'great-wall-theme' ); ?></label>
          <input type="text" id="review-author-input" required placeholder="e.g. John Doe" style="width: 100%; border: 1px solid var(--border-color); padding: 12px; border-radius: 6px; font-family: var(--font-sans); color: var(--color-primary); font-size: 0.95rem;">
        </div>

        <div style="margin-bottom: 25px;">
          <label for="review-body-input" style="display: block; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 8px; color: var(--color-primary);"><?php esc_html_e( 'Your Review Description:', 'great-wall-theme' ); ?></label>
          <textarea id="review-body-input" required placeholder="<?php esc_attr_e( 'Describe your experience with our showroom services or custom furniture craftsmanship...', 'great-wall-theme' ); ?>" style="width: 100%; border: 1px solid var(--border-color); padding: 12px; border-radius: 6px; font-family: var(--font-sans); color: var(--color-primary); font-size: 0.95rem; height: 100px; resize: none;"></textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: 30px; height: 50px; font-weight: 600;"><?php esc_html_e( 'Submit Review', 'great-wall-theme' ); ?></button>
      </form>
    </div>
  </div>

<?php
/**
 * Helper function to render gorgeous placeholder products if WC is empty or inactive
 */
function great_wall_render_fallback_products( $assets_uri ) {
  ?>
  <!-- Product 1 -->
  <div class="product-card delay-100" data-scroll>
    <div class="product-img-wrapper">
      <span class="product-badge">New Arrival</span>
      <img loading="lazy" src="<?php echo esc_url( $assets_uri . 'designer_chair.webp' ); ?>" alt="Aura Bouclé Accent Armchair" class="product-img main-img">
      <img loading="lazy" src="<?php echo esc_url( $assets_uri . 'designer_chair_h.webp' ); ?>" alt="Aura Bouclé Accent Armchair Olive" class="product-img hover-img">
      <div class="product-actions">
        <button class="product-action-btn add-to-cart-trigger" 
                data-id="prod-aura-chair" 
                data-title="Aura Bouclé Accent Armchair" 
                data-price="2899" 
                data-image="<?php echo esc_url( $assets_uri . 'designer_chair.webp' ); ?>"
                data-category="Accent Seating"
                title="Add to Shopping Bag">
          <i class="ri-shopping-bag-line"></i>
        </button>
        <a href="<?php echo esc_url( home_url( '/product/aura-chair/' ) ); ?>" class="product-action-btn" title="View Details"><i class="ri-eye-line"></i></a>
      </div>
    </div>
    <div class="product-info">
      <span class="product-category">Accent Seating</span>
      <h3 class="product-title"><a href="<?php echo esc_url( home_url( '/product/aura-chair/' ) ); ?>">Aura Bouclé Accent Armchair</a></h3>
      <div class="product-meta">
        <div class="product-price">AED 2,899</div>
        <div class="product-rating">
          <i class="ri-star-fill"></i>
          <span>5.0</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Product 2 -->
  <div class="product-card delay-200" data-scroll>
    <div class="product-img-wrapper">
      <span class="product-badge">Featured</span>
      <img loading="lazy" src="<?php echo esc_url( $assets_uri . 'hero_sofa.webp' ); ?>" alt="Hale Minimalist Bouclé Sofa" class="product-img main-img">
      <div class="product-actions">
        <button class="product-action-btn add-to-cart-trigger" 
                data-id="prod-hale-sofa" 
                data-title="Hale Minimalist Bouclé Sofa" 
                data-price="8999" 
                data-image="<?php echo esc_url( $assets_uri . 'hero_sofa.webp' ); ?>"
                data-category="Living Room"
                title="Add to Shopping Bag">
          <i class="ri-shopping-bag-line"></i>
        </button>
        <a href="<?php echo esc_url( home_url( '/product/hale-sofa/' ) ); ?>" class="product-action-btn" title="View Details"><i class="ri-eye-line"></i></a>
      </div>
    </div>
    <div class="product-info">
      <span class="product-category">Living Room</span>
      <h3 class="product-title"><a href="<?php echo esc_url( home_url( '/product/hale-sofa/' ) ); ?>">Hale Minimalist Bouclé Sofa</a></h3>
      <div class="product-meta">
        <div class="product-price">AED 8,999</div>
        <div class="product-rating">
          <i class="ri-star-fill"></i>
          <span>4.5</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Product 3 -->
  <div class="product-card delay-300" data-scroll>
    <div class="product-img-wrapper">
      <img loading="lazy" src="<?php echo esc_url( $assets_uri . 'luxury_bed.webp' ); ?>" alt="Sora Velvet Upholstered King Bed" class="product-img main-img">
      <div class="product-actions">
        <button class="product-action-btn add-to-cart-trigger" 
                data-id="prod-sora-bed" 
                data-title="Sora Velvet Upholstered King Bed" 
                data-price="6499" 
                data-image="<?php echo esc_url( $assets_uri . 'luxury_bed.webp' ); ?>"
                data-category="Bedroom"
                title="Add to Shopping Bag">
          <i class="ri-shopping-bag-line"></i>
        </button>
        <a href="<?php echo esc_url( home_url( '/product/sora-bed/' ) ); ?>" class="product-action-btn" title="View Details"><i class="ri-eye-line"></i></a>
      </div>
    </div>
    <div class="product-info">
      <span class="product-category">Bedroom</span>
      <h3 class="product-title"><a href="<?php echo esc_url( home_url( '/product/sora-bed/' ) ); ?>">Sora Velvet Upholstered King Bed</a></h3>
      <div class="product-meta">
        <div class="product-price">AED 6,499</div>
        <div class="product-rating">
          <i class="ri-star-fill"></i>
          <span>5.0</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Product 4 -->
  <div class="product-card delay-400" data-scroll>
    <div class="product-img-wrapper">
      <span class="product-badge sale">Special Order</span>
      <img loading="lazy" src="<?php echo esc_url( $assets_uri . 'dining_room.webp' ); ?>" alt="Stella Black Marble Dining Table" class="product-img main-img">
      <div class="product-actions">
        <button class="product-action-btn add-to-cart-trigger" 
                data-id="prod-stella-dining" 
                data-title="Stella Black Marble Dining Table" 
                data-price="11499" 
                data-image="<?php echo esc_url( $assets_uri . 'dining_room.webp' ); ?>"
                data-category="Dining"
                title="Add to Shopping Bag">
          <i class="ri-shopping-bag-line"></i>
        </button>
        <a href="<?php echo esc_url( home_url( '/product/stella-dining/' ) ); ?>" class="product-action-btn" title="View Details"><i class="ri-eye-line"></i></a>
      </div>
    </div>
    <div class="product-info">
      <span class="product-category">Dining Room</span>
      <h3 class="product-title"><a href="<?php echo esc_url( home_url( '/product/stella-dining/' ) ); ?>">Stella Black Marble Dining Table</a></h3>
      <div class="product-meta">
        <div class="product-price">AED 11,499</div>
        <div class="product-rating">
          <i class="ri-star-fill"></i>
          <span>5.0</span>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

  <!-- Featured Product Customizer & Reviews Carousel script logic -->
  <script>
    // --- Featured Product Gallery ---
    const featuredGalleryImages = [
      'https://greatwallfurniture.com/wp-content/uploads/2026/07/C-17-1.webp',
      'https://greatwallfurniture.com/wp-content/uploads/2026/07/C-17-2.webp',
      'https://greatwallfurniture.com/wp-content/uploads/2026/07/C-17-3.webp',
      'https://greatwallfurniture.com/wp-content/uploads/2026/07/C-17-4.webp'
    ];
    let currentFeaturedIndex = 0;

    function updateFeaturedGallery() {
      const mainImg = document.getElementById('featured-product-main-img');
      if (mainImg) {
        mainImg.src = featuredGalleryImages[currentFeaturedIndex];
      }
      
      const thumbs = document.querySelectorAll('.featured-product-section .gallery-thumb');
      thumbs.forEach((t, idx) => {
        if (idx === currentFeaturedIndex) {
          t.classList.add('active');
        } else {
          t.classList.remove('active');
        }
      });
    }

    function prevFeaturedGalleryImage() {
      currentFeaturedIndex = (currentFeaturedIndex - 1 + featuredGalleryImages.length) % featuredGalleryImages.length;
      updateFeaturedGallery();
    }

    function nextFeaturedGalleryImage() {
      currentFeaturedIndex = (currentFeaturedIndex + 1) % featuredGalleryImages.length;
      updateFeaturedGallery();
    }

    function changeFeaturedImage(src, element) {
      const mainImg = document.getElementById('featured-product-main-img');
      if (mainImg) {
        mainImg.src = src;
      }
      
      const thumbs = document.querySelectorAll('.featured-product-section .gallery-thumb');
      thumbs.forEach(t => t.classList.remove('active'));
      element.classList.add('active');
      
      const idx = featuredGalleryImages.indexOf(src);
      if (idx !== -1) {
        currentFeaturedIndex = idx;
      }
    }

    function selectFeaturedColor(element) {
      const color = element.getAttribute('data-color');
      const price = parseFloat(element.getAttribute('data-price'));
      const imgSrc = element.getAttribute('data-img');
      
      // Update swatches active classes
      const swatches = document.querySelectorAll('.featured-swatch');
      swatches.forEach(s => {
        s.classList.remove('active');
        s.style.boxShadow = '0 0 0 1px rgba(0,0,0,0.1)';
      });
      element.classList.add('active');
      element.style.boxShadow = '0 0 0 1.5px var(--color-primary)';
      
      // Update color label
      const colorLabel = document.getElementById('featured-color-name');
      if (colorLabel) colorLabel.textContent = color;
      
      // Update price text
      const priceText = document.getElementById('featured-price-text');
      if (priceText) priceText.textContent = `AED ${price.toLocaleString()}`;
      
      // Switch image
      const matchingThumb = Array.from(document.querySelectorAll('.featured-product-section .gallery-thumb img'))
        .find(img => img.getAttribute('src') === imgSrc);
      if (matchingThumb) {
        changeFeaturedImage(imgSrc, matchingThumb.parentElement);
      } else {
        const mainImg = document.getElementById('featured-product-main-img');
        if (mainImg) mainImg.src = imgSrc;
      }
      
      // Update Add to Cart Button metadata
      const addCartBtn = document.getElementById('featured-add-to-cart');
      if (addCartBtn) {
        addCartBtn.setAttribute('data-price', price);
        addCartBtn.setAttribute('data-title', `Premium Velvet Tufted Accent Chair (${color})`);
        addCartBtn.setAttribute('data-image', imgSrc);
      }
    }

    function adjustFeaturedQty(val) {
      const input = document.getElementById('featured-product-qty');
      if (input) {
        let currentVal = parseInt(input.value);
        currentVal += val;
        if (currentVal < 1) currentVal = 1;
        input.value = currentVal;
      }
    }

    // --- Reviews Carousel ---
    let currentReviewIndex = 0;
    
    function slideReviews(direction) {
      const track = document.getElementById('reviews-track');
      if (!track) return;
      const cards = track.querySelectorAll('.review-card');
      if (cards.length === 0) return;
      
      const cardWidth = cards[0].getBoundingClientRect().width + 24; // card width + gap
      const containerWidth = track.parentElement.getBoundingClientRect().width;
      const totalWidth = cards.length * cardWidth;
      const maxScroll = totalWidth - containerWidth - 24;
      
      if (direction === 'next') {
        const nextOffset = (currentReviewIndex + 1) * cardWidth;
        if (nextOffset <= maxScroll + 50) {
          currentReviewIndex++;
        } else {
          currentReviewIndex = 0; // loop
        }
      } else {
        if (currentReviewIndex > 0) {
          currentReviewIndex--;
        } else {
          currentReviewIndex = Math.max(0, Math.floor(maxScroll / cardWidth));
        }
      }
      track.style.transform = `translateX(-${currentReviewIndex * cardWidth}px)`;
    }

    // --- Modal Open/Close & Submit Reviews ---
    function openReviewModal() {
      const modal = document.getElementById('review-modal');
      if (modal) modal.classList.add('open');
    }

    function closeReviewModal() {
      const modal = document.getElementById('review-modal');
      if (modal) modal.classList.remove('open');
    }

    function setRatingValue(val) {
      document.getElementById('review-rating-value').value = val;
      const stars = document.querySelectorAll('#rating-select-stars .rating-star-btn');
      stars.forEach((star, idx) => {
        if (idx < val) {
          star.classList.add('active');
        } else {
          star.classList.remove('active');
        }
      });
    }

    function submitReviewForm(event) {
      event.preventDefault();
      const name = document.getElementById('review-author-input').value.trim();
      const body = document.getElementById('review-body-input').value.trim();
      const rating = parseInt(document.getElementById('review-rating-value').value);
      
      if (!name || !body) return;

      const newReview = { name, body, rating };
      
      // Save in localStorage
      let localReviews = JSON.parse(localStorage.getItem('great_wall_reviews') || '[]');
      localReviews.unshift(newReview);
      localStorage.setItem('great_wall_reviews', JSON.stringify(localReviews));
      
      // Add card dynamically
      addReviewCardToDOM(newReview, true);
      
      // Reset form
      document.getElementById('add-review-form').reset();
      setRatingValue(5);
      
      // Close
      closeReviewModal();
      
      alert('Thank you for sharing your experience! Your review has been added to our homepage.');
      
      // Go to start
      const track = document.getElementById('reviews-track');
      if (track) {
        track.style.transform = `translateX(0px)`;
        currentReviewIndex = 0;
      }
    }

    function addReviewCardToDOM(review, prepend = false) {
      const track = document.getElementById('reviews-track');
      if (!track) return;

      const card = document.createElement('div');
      card.className = 'review-card';
      
      let starsHTML = '';
      for (let i = 0; i < 5; i++) {
        if (i < review.rating) {
          starsHTML += '<i class="ri-star-fill"></i>';
        } else {
          starsHTML += '<i class="ri-star-line" style="color: #E2E8F0;"></i>';
        }
      }

      card.innerHTML = `
        <div class="review-stars">${starsHTML}</div>
        <p class="review-body">"${review.body}"</p>
        <h4 class="review-author">${review.name}</h4>
      `;

      if (prepend) {
        track.insertBefore(card, track.firstChild);
      } else {
        track.appendChild(card);
      }
    }

    function loadCustomReviews() {
      const localReviews = JSON.parse(localStorage.getItem('great_wall_reviews') || '[]');
      localReviews.forEach(review => {
        addReviewCardToDOM(review, true);
      });
    }

    document.addEventListener('DOMContentLoaded', () => {
      const prevBtn = document.getElementById('reviews-prev');
      const nextBtn = document.getElementById('reviews-next');
      if (prevBtn) prevBtn.addEventListener('click', () => slideReviews('prev'));
      if (nextBtn) nextBtn.addEventListener('click', () => slideReviews('next'));
      
      loadCustomReviews();
      
      window.addEventListener('resize', () => {
        const track = document.getElementById('reviews-track');
        if (track) {
          track.style.transform = `translateX(0px)`;
          currentReviewIndex = 0;
        }
      });
    });
  </script>

<?php
get_footer();

