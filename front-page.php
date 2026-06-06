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

  <!-- ==========================================================================
       HERO CAROUSEL SECTION
       ========================================================================== -->
  <section class="hero">
    <div class="hero-slider">
      
      <!-- Slide 1: Signature Sofa -->
      <div class="hero-slide active">
        <div class="hero-bg">
          <img src="<?php echo esc_url( $assets_uri . 'hero_sofa.png' ); ?>" alt="<?php esc_attr_e( 'Signature Sofa Living Room Collection', 'great-wall-theme' ); ?>">
        </div>
        <div class="container">
          <div class="hero-content">
            <span class="subtitle">The Living Room Collection</span>
            <h1>The Art of Architectural Living</h1>
            <p>Immerse yourself in clean lines, premium bouclé textures, and solid walnut craftsmanship. Hand-crafted statement pieces tailored for refined Dubai residences.</p>
            <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="btn btn-primary"><span>Explore Collection</span></a>
          </div>
        </div>
      </div>
      
      <!-- Slide 2: Luxury Bedroom -->
      <div class="hero-slide">
        <div class="hero-bg">
          <img src="<?php echo esc_url( $assets_uri . 'luxury_bed.png' ); ?>" alt="<?php esc_attr_e( 'Luxury Master Bedroom Suite', 'great-wall-theme' ); ?>">
        </div>
        <div class="container">
          <div class="hero-content">
            <span class="subtitle">The Bedroom Sanctuary</span>
            <h1>Serene Spaces & Quiet Luxury</h1>
            <p>Elevate your personal space into an oasis of calm. Discover king beds upholstered in refined velvets and custom dark oak storage modules.</p>
            <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="btn btn-primary"><span>Discover Bedding</span></a>
          </div>
        </div>
      </div>
      
      <!-- Slide 3: Dining Room -->
      <div class="hero-slide">
        <div class="hero-bg">
          <img src="<?php echo esc_url( $assets_uri . 'dining_room.png' ); ?>" alt="<?php esc_attr_e( 'Luxurious Marble Dining Setup', 'great-wall-theme' ); ?>">
        </div>
        <div class="container">
          <div class="hero-content">
            <span class="subtitle">The Dining Collection</span>
            <h1>Curate Elegant Gathering Places</h1>
            <p>Host unforgettable evenings around custom-carved black marble tabletops paired with brushed champagne-bronze dining chairs.</p>
            <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="btn btn-primary"><span>View Dining Tables</span></a>
          </div>
        </div>
      </div>
      
    </div>

    <!-- Slider Navigations -->
    <div class="hero-dots"></div>
    <div class="hero-controls">
      <button class="hero-control-btn hero-control-prev" aria-label="Previous Slide"><i class="ri-arrow-left-s-line"></i></button>
      <button class="hero-control-btn hero-control-next" aria-label="Next Slide"><i class="ri-arrow-right-s-line"></i></button>
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
      
      <div class="grid categories-grid">
        <!-- Card 1: Living -->
        <div class="category-card" data-scroll class="delay-100" onclick="window.location.href='<?php echo esc_url( home_url( '/shop/?cat=living' ) ); ?>'">
          <div class="category-img">
            <img src="<?php echo esc_url( $assets_uri . 'hero_sofa.png' ); ?>" alt="Living Room Category">
          </div>
          <div class="category-overlay">
            <h3 class="category-title">Living Room</h3>
            <span class="category-count">Explore Designs</span>
          </div>
        </div>
        
        <!-- Card 2: Bedroom -->
        <div class="category-card" data-scroll class="delay-200" onclick="window.location.href='<?php echo esc_url( home_url( '/shop/?cat=bedroom' ) ); ?>'">
          <div class="category-img">
            <img src="<?php echo esc_url( $assets_uri . 'luxury_bed.png' ); ?>" alt="Bedroom Category">
          </div>
          <div class="category-overlay">
            <h3 class="category-title">Bedroom</h3>
            <span class="category-count">Serene Concepts</span>
          </div>
        </div>
        
        <!-- Card 3: Dining -->
        <div class="category-card" data-scroll class="delay-300" onclick="window.location.href='<?php echo esc_url( home_url( '/shop/?cat=dining' ) ); ?>'">
          <div class="category-img">
            <img src="<?php echo esc_url( $assets_uri . 'dining_room.png' ); ?>" alt="Dining Category">
          </div>
          <div class="category-overlay">
            <h3 class="category-title">Dining Room</h3>
            <span class="category-count">Gathering Sets</span>
          </div>
        </div>
        
        <!-- Card 4: Accent Armchairs -->
        <div class="category-card" data-scroll class="delay-400" onclick="window.location.href='<?php echo esc_url( home_url( '/shop/?cat=accents' ) ); ?>'">
          <div class="category-img">
            <img src="<?php echo esc_url( $assets_uri . 'designer_chair.png' ); ?>" alt="Armchair Category">
          </div>
          <div class="category-overlay">
            <h3 class="category-title">Accent Armchairs</h3>
            <span class="category-count">Statement Seating</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       ASYMMETRIC PROMOTIONAL GRID SECTION (Sale event and feature cards)
       ========================================================================== -->
  <section class="section promo-grid-section" style="padding-bottom: 60px;">
    <div class="container">
      <div class="promo-grid-layout">
        
        <!-- Left large panel: Furniture Sale Event -->
        <div class="promo-left-panel" data-scroll>
          <div class="promo-left-img-wrapper">
            <img src="<?php echo esc_url( $assets_uri . 'pillows_stack.png' ); ?>" alt="Furniture Sale Event Stack">
          </div>
          <div>
            <h3 class="promo-card-title">Furniture Sale Event</h3>
            <p class="promo-card-desc">Join us for our Furniture Sale Event to find great deals on a wide range of stylish, high-quality furniture.</p>
          </div>
        </div>

        <!-- Right stacked panel -->
        <div class="promo-right-panel">
          
          <!-- Top row: 2 small squares -->
          <div class="promo-right-row-1">
            <!-- Top-left small card -->
            <div class="promo-right-card-small" data-scroll class="delay-100">
              <div class="promo-small-img-wrapper">
                <img src="<?php echo esc_url( $assets_uri . 'designer_chair.png' ); ?>" alt="Up to 30% Off Armchair">
              </div>
              <div>
                <h3 class="promo-card-title" style="font-size: 1.25rem; margin-bottom: 8px;">Up to 30% Off</h3>
                <p class="promo-card-desc" style="font-size: 0.82rem;">Our exclusive offer of up to 30% off on select furniture pieces!</p>
              </div>
            </div>
            <!-- Top-right small card -->
            <div class="promo-right-card-small color-tint-2" data-scroll class="delay-200">
              <div class="promo-small-img-wrapper">
                <img src="<?php echo esc_url( $assets_uri . 'timber_dresser.png' ); ?>" alt="Smart Bedside Cabinet Table">
              </div>
              <div>
                <h3 class="promo-card-title" style="font-size: 1.25rem; margin-bottom: 8px;">Smart Furniture</h3>
                <p class="promo-card-desc" style="font-size: 0.82rem;">Perfectly tailored to your modern lifestyle.</p>
              </div>
            </div>
          </div>

          <!-- Bottom row: 1 wide rectangle card -->
          <div class="promo-right-card-wide" data-scroll class="delay-300">
            <div class="promo-wide-img-wrapper">
              <img src="<?php echo esc_url( $assets_uri . 'sofa_isolated.png' ); ?>" alt="Modern Teal Couch Sofa">
            </div>
            <div>
              <h3 class="promo-card-title" style="font-size: 1.35rem; margin-bottom: 8px;">Refresh Your Interiors</h3>
              <p class="promo-card-desc" style="font-size: 0.85rem;">Breathe new life into your home with our curated collection designed to refresh your interiors.</p>
            </div>
          </div>

        </div>

      </div>
    </div>
  </section>

  <!-- ==========================================================================
       3D REVOLVING SHOWCASE CAROUSEL (Phase 17)
       ========================================================================== -->
  <div class="fc3-outer">
    <div class="fc3-frame">
      <div class="fc3-section">

        <div class="fc3-header">
          <span class="fc3-eyebrow"><span class="fc3-dot"></span><?php esc_html_e( 'Our Collection', 'great-wall-theme' ); ?></span>
          <h2 class="fc3-title"><?php echo wp_kses( __( 'Design Masterpieces <em>in Motion</em>', 'great-wall-theme' ), array( 'em' => array() ) ); ?></h2>
          <p class="fc3-desc"><?php esc_html_e( 'Explore our signature handcrafted furniture collections rotating from every angle.', 'great-wall-theme' ); ?></p>
        </div>

        <div class="fc3-scene">
          <div class="fc3-ring" style="--n:14">
            <div class="fc3-card" style="--i:0"><img src="<?php echo esc_url( $assets_uri . 'designer_chair.png' ); ?>" alt="<?php esc_attr_e( 'Aura Bouclé Accent Armchair', 'great-wall-theme' ); ?>"></div>
            <div class="fc3-card" style="--i:1"><img src="<?php echo esc_url( $assets_uri . 'hero_sofa.png' ); ?>" alt="<?php esc_attr_e( 'Hale Minimalist Bouclé Sofa', 'great-wall-theme' ); ?>"></div>
            <div class="fc3-card" style="--i:2"><img src="<?php echo esc_url( $assets_uri . 'luxury_bed.png' ); ?>" alt="<?php esc_attr_e( 'Sora Velvet Upholstered King Bed', 'great-wall-theme' ); ?>"></div>
            <div class="fc3-card" style="--i:3"><img src="<?php echo esc_url( $assets_uri . 'dining_room.png' ); ?>" alt="<?php esc_attr_e( 'Stella Black Marble Dining Table', 'great-wall-theme' ); ?>"></div>
            <div class="fc3-card" style="--i:4"><img src="<?php echo esc_url( $assets_uri . 'sofa_isolated.png' ); ?>" alt="<?php esc_attr_e( '3-Seater Sofa Set', 'great-wall-theme' ); ?>"></div>
            <div class="fc3-card" style="--i:5"><img src="<?php echo esc_url( $assets_uri . 'blue_chair_isolated.png' ); ?>" alt="<?php esc_attr_e( 'Accent Chair with Gold Frame', 'great-wall-theme' ); ?>"></div>
            <div class="fc3-card" style="--i:6"><img src="<?php echo esc_url( $assets_uri . 'baby_chair_isolated.png' ); ?>" alt="<?php esc_attr_e( 'Baby Chair', 'great-wall-theme' ); ?>"></div>
            <div class="fc3-card" style="--i:7"><img src="<?php echo esc_url( $assets_uri . 'box_round_stool.png' ); ?>" alt="<?php esc_attr_e( 'Box Round Sofa Seat', 'great-wall-theme' ); ?>"></div>
            <div class="fc3-card" style="--i:8"><img src="<?php echo esc_url( $assets_uri . 'carved_vase.png' ); ?>" alt="<?php esc_attr_e( 'Carved Vase', 'great-wall-theme' ); ?>"></div>
            <div class="fc3-card" style="--i:9"><img src="<?php echo esc_url( $assets_uri . 'table_lamp.png' ); ?>" alt="<?php esc_attr_e( 'Table Lamp', 'great-wall-theme' ); ?>"></div>
            <div class="fc3-card" style="--i:10"><img src="<?php echo esc_url( $assets_uri . 'timber_dresser.png' ); ?>" alt="<?php esc_attr_e( 'Timber Dresser', 'great-wall-theme' ); ?>"></div>
            <div class="fc3-card" style="--i:11"><img src="<?php echo esc_url( $assets_uri . 'pillows_stack.png' ); ?>" alt="<?php esc_attr_e( 'Pillows Stack', 'great-wall-theme' ); ?>"></div>
            <div class="fc3-card" style="--i:12"><img src="<?php echo esc_url( $assets_uri . 'designer_chair_h.png' ); ?>" alt="<?php esc_attr_e( 'Aura Accent Armchair Olive', 'great-wall-theme' ); ?>"></div>
            <div class="fc3-card" style="--i:13"><img src="<?php echo esc_url( $assets_uri . 'hero_sofa.png' ); ?>" alt="<?php esc_attr_e( 'Hale Minimalist Bouclé Sofa', 'great-wall-theme' ); ?>"></div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- ==========================================================================
       MOST POPULAR PRODUCTS SECTION (Dynamic swatches & isolated items matching screenshot)
       ========================================================================== -->
  <section class="section popular-products-section">
    <div class="container">
      <div class="popular-products-title-wrapper" data-scroll>
        <h2 class="popular-products-title">Most Popular Products</h2>
        <button class="floating-back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'});" aria-label="Scroll to top"><i class="ri-arrow-up-line"></i></button>
      </div>

      <!-- Row 1: 5 Columns -->
      <div class="grid popular-grid" style="margin-bottom: 40px;">
        
        <!-- Product 1 -->
        <div class="popular-card" data-scroll class="delay-100">
          <div class="popular-img-box">
            <img src="<?php echo esc_url( $assets_uri . 'sofa_isolated.png' ); ?>" alt="3-Seater sofa set">
          </div>
          <h3 class="popular-card-title">3-Seater sofa set</h3>
          <div class="popular-card-price">From AED 3,000.00</div>
          <div class="popular-swatches">
            <span class="popular-swatch-dot active" style="background-color: #8E8E93;" title="Slate Grey"></span>
            <span class="popular-swatch-dot" style="background-color: #1C1C1E;" title="Charcoal Black"></span>
          </div>
        </div>

        <!-- Product 2 -->
        <div class="popular-card" data-scroll class="delay-200">
          <div class="popular-img-box">
            <img src="<?php echo esc_url( $assets_uri . 'blue_chair_isolated.png' ); ?>" alt="Accent Chair with Gold Frame">
          </div>
          <h3 class="popular-card-title">Accent Chair with Gold Frame</h3>
          <div class="popular-card-price">AED 4,700.00</div>
          <div class="popular-swatches">
            <span class="popular-swatch-dot active" style="background-color: #1A1F3C;" title="Royal Navy"></span>
            <span class="popular-swatch-dot" style="background-color: #A09E9B;" title="Brushed Silver"></span>
          </div>
        </div>

        <!-- Product 3 -->
        <div class="popular-card" data-scroll class="delay-300">
          <div class="popular-img-box">
            <img src="<?php echo esc_url( $assets_uri . 'baby_chair_isolated.png' ); ?>" alt="Baby chair">
          </div>
          <h3 class="popular-card-title">Baby chair</h3>
          <div class="popular-card-price">AED 2,500.00</div>
          <div class="popular-swatches">
            <span class="popular-swatch-dot active" style="background-color: #D4B28C;" title="Natural Beech"></span>
            <span class="popular-swatch-dot" style="background-color: #8D5B4C;" title="Warm Chestnut"></span>
          </div>
        </div>

        <!-- Product 4 -->
        <div class="popular-card" data-scroll class="delay-400">
          <div class="popular-img-box">
            <img src="<?php echo esc_url( $assets_uri . 'box_round_stool.png' ); ?>" alt="Box round sofa seat">
          </div>
          <h3 class="popular-card-title">Box round sofa seat</h3>
          <div class="popular-card-price">AED 55.00</div>
          <div class="popular-swatches">
            <span class="popular-swatch-dot active" style="background-color: #B5D2E1;" title="Soft Azure"></span>
            <span class="popular-swatch-dot" style="background-color: #8DA98F;" title="Sage Green"></span>
            <span class="popular-swatch-dot" style="background-color: #5C554E;" title="Charcoal"></span>
            <span class="popular-swatch-dot" style="background-color: #705B54;" title="Muted Brown"></span>
          </div>
        </div>

        <!-- Product 5 -->
        <div class="popular-card" data-scroll class="delay-400">
          <div class="popular-img-box">
            <img src="<?php echo esc_url( $assets_uri . 'cushion_chair.png' ); ?>" alt="Chair with Cushioned Seat">
          </div>
          <h3 class="popular-card-title">Chair with Cushioned Seat</h3>
          <div class="popular-card-price">AED 5,400.00</div>
          <div class="popular-swatches">
            <span class="popular-swatch-dot active" style="background-color: #F5E6C9;" title="Warm Cream"></span>
            <span class="popular-swatch-dot" style="background-color: #BCD3E6;" title="Linen Blue"></span>
          </div>
        </div>

      </div>

      <!-- Row 2: 5 Columns -->
      <div class="grid popular-grid">
        
        <!-- Product 6 -->
        <div class="popular-card" data-scroll class="delay-100">
          <div class="popular-img-box">
            <img src="<?php echo esc_url( $assets_uri . 'luxury_bed.png' ); ?>" alt="Minimalist Kid's Bed">
          </div>
          <h3 class="popular-card-title">Minimalist Kid's Bed</h3>
          <div class="popular-card-price">AED 3,200.00</div>
          <div class="popular-swatches">
            <span class="popular-swatch-dot active" style="background-color: #A3C9A8;" title="Mint Green"></span>
            <span class="popular-swatch-dot" style="background-color: #F3ECE3;" title="Light White"></span>
          </div>
        </div>

        <!-- Product 7 -->
        <div class="popular-card" data-scroll class="delay-200">
          <div class="popular-img-box">
            <img src="<?php echo esc_url( $assets_uri . 'dining_room.png' ); ?>" alt="Round Coffee Table">
          </div>
          <h3 class="popular-card-title">Round Coffee Table</h3>
          <div class="popular-card-price">AED 1,100.00</div>
          <div class="popular-swatches">
            <span class="popular-swatch-dot active" style="background-color: #D2A87E;" title="Natural Oak"></span>
            <span class="popular-swatch-dot" style="background-color: #4A3E3D;" title="Dark Oak"></span>
          </div>
        </div>

        <!-- Product 8 (Badge UNIQUE) -->
        <div class="popular-card" data-scroll class="delay-300">
          <div class="popular-img-box">
            <span class="popular-badge-pill">UNIQUE</span>
            <img src="<?php echo esc_url( $assets_uri . 'timber_dresser.png' ); ?>" alt="Modern Timber Dresser">
          </div>
          <h3 class="popular-card-title">Modern Timber Dresser</h3>
          <div class="popular-card-price">AED 4,900.00</div>
          <div class="popular-swatches">
            <span class="popular-swatch-dot active" style="background-color: #E2B27E;" title="Honey Beech"></span>
            <span class="popular-swatch-dot" style="background-color: #1C1C1E;" title="Ebonized Black"></span>
          </div>
        </div>

        <!-- Product 9 -->
        <div class="popular-card" data-scroll class="delay-400">
          <div class="popular-img-box">
            <img src="<?php echo esc_url( $assets_uri . 'table_lamp.png' ); ?>" alt="Artisanal Table Lamp">
          </div>
          <h3 class="popular-card-title">Artisanal Table Lamp</h3>
          <div class="popular-card-price">AED 180.00</div>
          <div class="popular-swatches">
            <span class="popular-swatch-dot active" style="background-color: #F3ECE3;" title="Sand White"></span>
            <span class="popular-swatch-dot" style="background-color: #A68E77;" title="Muted Oak"></span>
          </div>
        </div>

        <!-- Product 10 -->
        <div class="popular-card" data-scroll class="delay-400">
          <div class="popular-img-box">
            <img src="<?php echo esc_url( $assets_uri . 'carved_vase.png' ); ?>" alt="Ceramic Carved Vase">
          </div>
          <h3 class="popular-card-title">Ceramic Carved Vase</h3>
          <div class="popular-card-price">AED 220.00</div>
          <div class="popular-swatches">
            <span class="popular-swatch-dot active" style="background-color: #E6B6B5;" title="Soft Rose"></span>
            <span class="popular-swatch-dot" style="background-color: #BCD3E6;" title="Sky Blue"></span>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- ==========================================================================
       CURATED SHOWROOM EXPERIENCE SECTION (Second asymmetric promo grid with header)
       ========================================================================== -->
  <section class="section promo-grid-section bg-light-accent" style="padding-top: 80px; padding-bottom: 80px; background-color: var(--bg-light-accent);">
    <div class="container">
      <div class="section-title-wrapper text-center" style="margin-bottom: 50px;" data-scroll>
        <span class="section-subtitle"><?php esc_html_e( 'Exquisite Spaces', 'great-wall-theme' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'The Curated Showroom Experience', 'great-wall-theme' ); ?></h2>
        <p class="section-desc" style="max-width: 650px; margin: 15px auto 0; color: var(--color-secondary); font-size: 1rem; line-height: 1.6;">
          <?php esc_html_e( 'Explore our designer-curated settings, blending minimalist structural integrity with the warm textiles of high-end contemporary living.', 'great-wall-theme' ); ?>
        </p>
      </div>

      <div class="promo-grid-layout">
        
        <!-- Left large panel: Bespoke Bedroom Sanctuary -->
        <div class="promo-left-panel" style="background-color: #ECE7E1;" data-scroll>
          <div class="promo-left-img-wrapper">
            <img src="<?php echo esc_url( $assets_uri . 'luxury_bed.png' ); ?>" alt="<?php esc_attr_e( 'Bespoke Bedroom Sanctuary', 'great-wall-theme' ); ?>">
          </div>
          <div>
            <h3 class="promo-card-title"><?php esc_html_e( 'Bespoke Bedroom Sanctuary', 'great-wall-theme' ); ?></h3>
            <p class="promo-card-desc"><?php esc_html_e( 'Indulge in absolute comfort with our premium, bespoke bed frames designed for deep, restorative sleep.', 'great-wall-theme' ); ?></p>
          </div>
        </div>

        <!-- Right stacked panel -->
        <div class="promo-right-panel">
          
          <!-- Top row: 2 small squares -->
          <div class="promo-right-row-1">
            <!-- Top-left small card -->
            <div class="promo-right-card-small" style="background-color: #E3E9EB;" data-scroll class="delay-100">
              <div class="promo-small-img-wrapper">
                <img src="<?php echo esc_url( $assets_uri . 'blue_chair_isolated.png' ); ?>" alt="<?php esc_attr_e( 'Aegean Bouclé Armchair', 'great-wall-theme' ); ?>">
              </div>
              <div>
                <h3 class="promo-card-title" style="font-size: 1.25rem; margin-bottom: 8px;"><?php esc_html_e( 'Aegean Bouclé', 'great-wall-theme' ); ?></h3>
                <p class="promo-card-desc" style="font-size: 0.82rem;"><?php esc_html_e( 'Add a striking pop of texture and deep sea tone to your living space.', 'great-wall-theme' ); ?></p>
              </div>
            </div>
            <!-- Top-right small card -->
            <div class="promo-right-card-small" style="background-color: #F0EAE1;" data-scroll class="delay-200">
              <div class="promo-small-img-wrapper">
                <img src="<?php echo esc_url( $assets_uri . 'table_lamp.png' ); ?>" alt="<?php esc_attr_e( 'Artisanal Sculptural Lighting', 'great-wall-theme' ); ?>">
              </div>
              <div>
                <h3 class="promo-card-title" style="font-size: 1.25rem; margin-bottom: 8px;"><?php esc_html_e( 'Bespoke Lighting', 'great-wall-theme' ); ?></h3>
                <p class="promo-card-desc" style="font-size: 0.82rem;"><?php esc_html_e( 'Warm, ambient lighting options to complete your cozy home interior.', 'great-wall-theme' ); ?></p>
              </div>
            </div>
          </div>

          <!-- Bottom row: 1 wide rectangle card -->
          <div class="promo-right-card-wide" style="background-color: #EAE6DF;" data-scroll class="delay-300">
            <div class="promo-wide-img-wrapper">
              <img src="<?php echo esc_url( $assets_uri . 'cushion_chair.png' ); ?>" alt="<?php esc_attr_e( 'The Lounger Collection', 'great-wall-theme' ); ?>">
            </div>
            <div>
              <h3 class="promo-card-title" style="font-size: 1.35rem; margin-bottom: 8px;"><?php esc_html_e( 'The Lounger Collection', 'great-wall-theme' ); ?></h3>
              <p class="promo-card-desc" style="font-size: 0.85rem;"><?php esc_html_e( 'Ergonomically crafted statement chairs that balance soft cushioning with minimalist timber frames.', 'great-wall-theme' ); ?></p>
            </div>
          </div>

        </div>

      </div>
    </div>
  </section>

    </div>
  </section>

  <!-- ==========================================================================
       FEATURED INTERACTIVE PRODUCT SECTION (Velvet Sleek Lounge Chair customizer)
       ========================================================================== -->
  <section class="section featured-product-section" style="padding-top: 80px; padding-bottom: 80px; background-color: var(--bg-primary); border-top: 1px solid var(--border-color);">
    <div class="container">
      <div class="section-title-wrapper text-center" style="margin-bottom: 50px;" data-scroll>
        <span class="section-subtitle"><?php esc_html_e( 'Showroom Spotlight', 'great-wall-theme' ); ?></span>
        <h2 class="section-title"><?php esc_html_e( 'Featured Masterpiece', 'great-wall-theme' ); ?></h2>
      </div>

      <div class="detail-grid" style="align-items: center;">
        
        <!-- Left Column: Gallery Carousel -->
        <div class="product-gallery">
          <div class="gallery-thumbs">
            <div class="gallery-thumb active" onclick="changeFeaturedImage('<?php echo esc_url( $assets_uri . 'designer_chair.png' ); ?>', this)">
              <img src="<?php echo esc_url( $assets_uri . 'designer_chair.png' ); ?>" alt="Velvet Lounge Chair View 1">
            </div>
            <div class="gallery-thumb" onclick="changeFeaturedImage('<?php echo esc_url( $assets_uri . 'designer_chair_h.png' ); ?>', this)">
              <img src="<?php echo esc_url( $assets_uri . 'designer_chair_h.png' ); ?>" alt="Velvet Lounge Chair View 2">
            </div>
            <div class="gallery-thumb" onclick="changeFeaturedImage('<?php echo esc_url( $assets_uri . 'blue_chair_isolated.png' ); ?>', this)">
              <img src="<?php echo esc_url( $assets_uri . 'blue_chair_isolated.png' ); ?>" alt="Velvet Lounge Chair View 3">
            </div>
            <div class="gallery-thumb" onclick="changeFeaturedImage('<?php echo esc_url( $assets_uri . 'cushion_chair.png' ); ?>', this)">
              <img src="<?php echo esc_url( $assets_uri . 'cushion_chair.png' ); ?>" alt="Velvet Lounge Chair View 4">
            </div>
          </div>
          
          <div class="gallery-main">
            <!-- Crown Badge in Top Right -->
            <span class="gallery-crown-badge"><i class="ri-vip-crown-fill"></i></span>
            
            <!-- Gallery Navigation Arrows -->
            <button class="gallery-nav-btn prev-btn" onclick="prevFeaturedGalleryImage()" aria-label="Previous Image"><i class="ri-arrow-left-s-line"></i></button>
            <img src="<?php echo esc_url( $assets_uri . 'designer_chair.png' ); ?>" id="featured-product-main-img" alt="Velvet Sleek Lounge Chair Main View">
            <button class="gallery-nav-btn next-btn" onclick="nextFeaturedGalleryImage()" aria-label="Next Image"><i class="ri-arrow-right-s-line"></i></button>
          </div>
        </div>
        
        <!-- Right Column: Specs and Cart Trigger -->
        <div class="product-detail-info">
          <h1 class="detail-title" style="font-size: 2.2rem; margin-bottom: 10px;"><?php esc_html_e( 'Velvet Sleek Lounge Chair', 'great-wall-theme' ); ?></h1>
          
          <div class="detail-price" id="featured-price-text" style="font-size: 1.8rem; font-weight: 500; color: var(--color-accent); margin-bottom: 20px;">AED 2,899</div>
          
          <p class="detail-desc" style="margin-bottom: 25px;"><?php esc_html_e( 'In our showroom haven, every curve resonates with the power to inspire, soothe, and elevate. Immerse yourself in premium comfort where minimalist structural walnut base and plush upholstery weave details of elegance.', 'great-wall-theme' ); ?></p>
          
          <!-- Product Custom Options -->
          <div class="options-group" style="margin-bottom: 20px;">
            <span class="option-label" style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 10px; display: block;"><?php esc_html_e( 'Select color:', 'great-wall-theme' ); ?> <span id="featured-color-name" style="text-transform: none; font-weight: 500; color: var(--color-secondary);"><?php esc_html_e( 'Gray', 'great-wall-theme' ); ?></span></span>
            <div style="display: flex; gap: 12px; align-items: center;">
              <!-- Circle swatches matching user screenshot -->
              <span class="featured-swatch active" style="background-color: #8E8E93; width: 28px; height: 28px; border-radius: 50%; display: inline-block; cursor: pointer; border: 2px solid #FFFFFF; box-shadow: 0 0 0 1.5px var(--color-primary);" data-color="Gray" data-price="2899" data-img="<?php echo esc_url( $assets_uri . 'designer_chair.png' ); ?>" onclick="selectFeaturedColor(this)"></span>
              <span class="featured-swatch" style="background-color: #1C1C1E; width: 28px; height: 28px; border-radius: 50%; display: inline-block; cursor: pointer; border: 2px solid #FFFFFF; box-shadow: 0 0 0 1px rgba(0,0,0,0.1);" data-color="Charcoal Black" data-price="3199" data-img="<?php echo esc_url( $assets_uri . 'designer_chair_h.png' ); ?>" onclick="selectFeaturedColor(this)"></span>
              <span class="featured-swatch" style="background-color: #BCD3E6; width: 28px; height: 28px; border-radius: 50%; display: inline-block; cursor: pointer; border: 2px solid #FFFFFF; box-shadow: 0 0 0 1px rgba(0,0,0,0.1);" data-color="Aegean Blue" data-price="3499" data-img="<?php echo esc_url( $assets_uri . 'blue_chair_isolated.png' ); ?>" onclick="selectFeaturedColor(this)"></span>
            </div>
          </div>
          
          <div class="options-group" style="margin-bottom: 20px;">
            <span class="option-label" style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 10px; display: block;"><?php esc_html_e( 'Backrest type:', 'great-wall-theme' ); ?></span>
            <div style="display: flex; gap: 10px;">
              <button class="wood-option active" style="border: 1px solid var(--color-primary); border-radius: 6px; padding: 10px 20px; background-color: transparent; font-weight: 600; cursor: pointer; font-family: var(--font-sans); color: var(--color-primary);"><?php esc_html_e( 'Upholstered', 'great-wall-theme' ); ?></button>
            </div>
          </div>

          <div class="options-group" style="margin-bottom: 25px;">
            <span class="option-label" style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 10px; display: block;"><?php esc_html_e( 'Material:', 'great-wall-theme' ); ?></span>
            <div style="display: flex; gap: 10px;">
              <button class="wood-option active" style="border: 1px solid var(--color-primary); border-radius: 6px; padding: 10px 20px; background-color: transparent; font-weight: 600; cursor: pointer; font-family: var(--font-sans); color: var(--color-primary);"><?php esc_html_e( 'Velvet', 'great-wall-theme' ); ?></button>
            </div>
          </div>
          
          <!-- Actions -->
          <div class="purchase-actions" style="flex-direction: column; align-items: stretch; gap: 15px; border-top: none; padding-top: 0; margin-top: 25px;">
            <div style="display: flex; gap: 15px; align-items: center; width: 100%;">
              <div class="qty-selector">
                <button class="qty-select-btn" onclick="adjustFeaturedQty(-1)">-</button>
                <input type="text" value="1" id="featured-product-qty" class="qty-select-input" readonly>
                <button class="qty-select-btn" onclick="adjustFeaturedQty(1)">+</button>
              </div>
              
              <button class="btn btn-primary btn-add-to-cart" id="featured-add-to-cart"
                      style="border-radius: 30px; height: 50px; background-color: var(--color-primary); color: #FFFFFF; font-weight: 600; flex: 1; border: none; font-size: 0.95rem; cursor: pointer;"
                      data-id="prod-velvet-sleek-chair" 
                      data-title="Velvet Sleek Lounge Chair" 
                      data-price="2899" 
                      data-image="<?php echo esc_url( $assets_uri . 'designer_chair.png' ); ?>"
                      data-category="Accent Seating">
                <span><?php esc_html_e( 'Add to cart', 'great-wall-theme' ); ?></span>
              </button>
            </div>
            
            <button class="btn-buy-shop" style="border-radius: 30px; height: 50px; background-color: #5A31F4; color: #FFFFFF; font-weight: 600; width: 100%; border: none; display: flex; align-items: center; justify-content: center; gap: 6px; cursor: pointer; font-size: 0.95rem;">
              <span><?php esc_html_e( 'Buy with', 'great-wall-theme' ); ?></span>
              <svg width="60" height="20" viewBox="0 0 46 15" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle;">
                <path d="M7.74 12.18c0 1.98-1.48 2.82-3.48 2.82-2.14 0-3.32-.98-3.32-2.82v-1.92h1.76v1.88c0 1.02.58 1.42 1.56 1.42.94 0 1.62-.4 1.62-1.34 0-2.02-3.26-1.92-3.26-4.6 0-1.8 1.34-2.82 3.22-2.82 1.94 0 3.1.94 3.1 2.82v1.4h-1.74v-1.36c0-1.04-.54-1.4-1.36-1.4-.92 0-1.36.42-1.36 1.3 0 1.94 3.26 1.92 3.26 4.54v1.88zm8.68-7.38v2.74c0 1-.58 1.42-1.58 1.42-.96 0-1.54-.42-1.54-1.42V4.8h-1.76v5.22c0 1.92 1.28 2.82 3.3 2.82 2.06 0 3.34-.9 3.34-2.82V4.8h-1.76zm9.32 5.06c0 1.42-.88 2.32-2.22 2.32s-2.22-.9-2.22-2.32V7.12c0-1.42.88-2.32 2.22-2.32s2.22.9 2.22 2.32v2.74zm1.76-2.74c0-2.3-1.62-3.92-3.98-3.92s-3.98 1.62-3.98 3.92v2.74c0 2.3 1.62 3.92 3.98 3.92s3.98-1.62 3.98-3.92V7.12zm10.1 2.1c0 1.44-.88 2.32-2.22 2.32s-2.22-.88-2.22-2.32V4.8h-1.76v9.74h1.76v-2.18c.56.5 1.28.78 2.22.78 2.36 0 3.98-1.62 3.98-3.92V7.12c0-2.3-1.62-3.92-3.98-3.92-1 0-1.7.3-2.22.78v-1.5h-1.76v9.74" fill="#FFFFFF"/>
              </svg>
            </button>
            
            <a href="#" style="text-align: center; font-size: 0.82rem; color: var(--color-secondary); text-decoration: underline; display: block; margin-top: 5px;"><?php esc_html_e( 'More payment options', 'great-wall-theme' ); ?></a>
          </div>
        </div>
        
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       SPLIT PROMOTIONAL BLOCK / BANNER
       ========================================================================== -->
  <section class="section promo-block" data-scroll>
    <div class="promo-grid">
      <div class="promo-content">
        <span class="section-subtitle" style="color: var(--color-accent-hover);">Bespoke Creations</span>
        <h2 class="promo-title">Hand-Crafted In Dubai.<br>Designed For Eternity.</h2>
        <p class="promo-desc">Our dedicated workshop in Ras Al Khor combines ancient carpentry traditions with sharp contemporary shapes. Every piece can be customized by width, veneer type, and upholstery grade to blend seamlessly into your architectural concept.</p>
        <div>
          <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-accent">Request Custom Design</a>
        </div>
      </div>
      <div class="promo-img">
        <img src="<?php echo esc_url( $assets_uri . 'dining_room.png' ); ?>" alt="Artisanal Furniture Construction Details">
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
        <div class="feature-card" data-scroll class="delay-100">
          <div class="feature-icon-wrapper"><i class="ri-award-line"></i></div>
          <h3 class="feature-title">Refined Materials</h3>
          <p class="feature-desc">We import Italian marble blocks, sustainable French oak veneers, and Belgian bouclé to ensure unmatched sensory luxury.</p>
        </div>
        
        <!-- Pillar 2 -->
        <div class="feature-card" data-scroll class="delay-200">
          <div class="feature-icon-wrapper"><i class="ri-hand-heart-line"></i></div>
          <h3 class="feature-title">Dubai Craftsmanship</h3>
          <p class="feature-desc">Each piece is cut, assembled, and finished by highly accomplished master carpenters locally in Ras Al Khor.</p>
        </div>
        
        <!-- Pillar 3 -->
        <div class="feature-card" data-scroll class="delay-300">
          <div class="feature-icon-wrapper"><i class="ri-equalizer-line"></i></div>
          <h3 class="feature-title">Bespoke Scaling</h3>
          <p class="feature-desc">Need a table or sofa in custom dimensions? Our designers will draft CAD plans tailored specifically to your home.</p>
        </div>
        
        <!-- Pillar 4 -->
        <div class="feature-card" data-scroll class="delay-400">
          <div class="feature-icon-wrapper"><i class="ri-truck-line"></i></div>
          <h3 class="feature-title">Premium Delivery</h3>
          <p class="feature-desc">Enjoy full-service white-glove transport and precise in-home installation across all seven Emirates.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       SHOWROOM EVENTS & WORKSHOPS SECTION
       ========================================================================== -->
  <section class="section events-section" id="events-section">
    <div class="container">
      <div class="events-grid">
        <!-- Event Card 1: Summer Furniture Sale -->
        <div class="event-card corner-type-1" data-scroll>
          <div class="event-content">
            <h3 class="event-title"><?php esc_html_e( 'Summer Furniture Sale', 'great-wall-theme' ); ?></h3>
            <p class="event-desc"><?php esc_html_e( 'Discover amazing discounts on premium furniture collections. Limited time offers on sofas, tables, and decor items.', 'great-wall-theme' ); ?></p>
            <div class="event-meta">
              <span class="event-pill"><?php esc_html_e( '01 May', 'great-wall-theme' ); ?></span>
              <span class="event-pill"><?php esc_html_e( '10PM', 'great-wall-theme' ); ?></span>
            </div>
            <a href="#" class="event-link"><?php esc_html_e( 'Read more', 'great-wall-theme' ); ?></a>
          </div>
          <div class="event-img-wrapper arch-left">
            <img src="<?php echo esc_url( $assets_uri . 'dining_room.png' ); ?>" alt="<?php esc_attr_e( 'Summer Furniture Sale', 'great-wall-theme' ); ?>">
          </div>
        </div>

        <!-- Event Card 2: New Collection Launch -->
        <div class="event-card corner-type-2" data-scroll>
          <div class="event-img-wrapper arch-right">
            <img src="<?php echo esc_url( $assets_uri . 'timber_dresser.png' ); ?>" alt="<?php esc_attr_e( 'New Collection Launch', 'great-wall-theme' ); ?>">
          </div>
          <div class="event-content">
            <h3 class="event-title"><?php esc_html_e( 'New Collection Launch', 'great-wall-theme' ); ?></h3>
            <p class="event-desc"><?php esc_html_e( 'Explore our latest modern furniture designs. Contemporary pieces crafted with sustainable materials and innovative styling techniques.', 'great-wall-theme' ); ?></p>
            <div class="event-meta">
              <span class="event-pill"><?php esc_html_e( '23 Jun', 'great-wall-theme' ); ?></span>
              <span class="event-pill"><?php esc_html_e( '4PM', 'great-wall-theme' ); ?></span>
            </div>
            <a href="#" class="event-link"><?php esc_html_e( 'Read more', 'great-wall-theme' ); ?></a>
          </div>
        </div>

        <!-- Event Card 3: Home Design Workshop -->
        <div class="event-card corner-type-2" data-scroll>
          <div class="event-content">
            <h3 class="event-title"><?php esc_html_e( 'Home Design Workshop', 'great-wall-theme' ); ?></h3>
            <p class="event-desc"><?php esc_html_e( 'Learn interior design tips from professional experts. Interactive session covering color schemes, space planning, and furniture selection.', 'great-wall-theme' ); ?></p>
            <div class="event-meta">
              <span class="event-pill"><?php esc_html_e( '01 Jan', 'great-wall-theme' ); ?></span>
              <span class="event-pill"><?php esc_html_e( '10PM', 'great-wall-theme' ); ?></span>
            </div>
            <a href="#" class="event-link"><?php esc_html_e( 'Read more', 'great-wall-theme' ); ?></a>
          </div>
          <div class="event-img-wrapper arch-left">
            <img src="<?php echo esc_url( $assets_uri . 'luxury_bed.png' ); ?>" alt="<?php esc_attr_e( 'Home Design Workshop', 'great-wall-theme' ); ?>">
          </div>
        </div>

        <!-- Event Card 4: Showroom Grand Opening -->
        <div class="event-card corner-type-1" data-scroll>
          <div class="event-img-wrapper arch-right">
            <img src="<?php echo esc_url( $assets_uri . 'table_lamp.png' ); ?>" alt="<?php esc_attr_e( 'Showroom Grand Opening', 'great-wall-theme' ); ?>">
          </div>
          <div class="event-content">
            <h3 class="event-title"><?php esc_html_e( 'Showroom Grand Opening', 'great-wall-theme' ); ?></h3>
            <p class="event-desc"><?php esc_html_e( 'Visit our new flagship location featuring exclusive furniture displays. Experience our complete collections in beautifully designed room settings.', 'great-wall-theme' ); ?></p>
            <div class="event-meta">
              <span class="event-pill"><?php esc_html_e( '23 Jul', 'great-wall-theme' ); ?></span>
              <span class="event-pill"><?php esc_html_e( '2PM', 'great-wall-theme' ); ?></span>
            </div>
            <a href="#" class="event-link"><?php esc_html_e( 'Read more', 'great-wall-theme' ); ?></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       SCROLL-DRIVEN STICKY CABINET SHOWCASE (Phase 10)
       ========================================================================== -->
  <section class="sticky-scroll-section">
    <!-- Viewport Triggers -->
    <div class="scroll-trigger" id="story-trigger-1"></div>
    <div class="scroll-trigger" id="story-trigger-2"></div>
    
    <div class="sticky-container">
      <div class="container sticky-scroll-grid">
        <!-- Left Side: Content Panels -->
        <div class="scroll-content-wrapper">
          <!-- Slide 1 Panel -->
          <div class="scroll-content-panel active" id="story-content-1">
            <div class="mobile-story-image">
              <img src="<?php echo esc_url( $assets_uri . 'timber_dresser.png' ); ?>" alt="<?php esc_attr_e( 'Modern Home Solutions', 'great-wall-theme' ); ?>">
            </div>
            <span class="scroll-cursive"><?php esc_html_e( 'Quality meets style perfectly', 'great-wall-theme' ); ?></span>
            <h2 class="scroll-title"><?php esc_html_e( 'Transform Your Home with Premium Furniture Collections Designed for Modern Living...', 'great-wall-theme' ); ?></h2>
            <h4 class="scroll-subtitle"><?php esc_html_e( 'Modern Home Solutions', 'great-wall-theme' ); ?></h4>
            <p class="scroll-desc"><?php esc_html_e( 'Elevate your interior with sophisticated furniture designed for contemporary lifestyles. Each piece combines functionality and style to create the perfect living environment.', 'great-wall-theme' ); ?></p>
          </div>
          
          <!-- Slide 2 Panel -->
          <div class="scroll-content-panel" id="story-content-2">
            <div class="mobile-story-image">
              <img src="<?php echo esc_url( $assets_uri . 'luxury_bed.png' ); ?>" alt="<?php esc_attr_e( 'Bespoke Bedroom Sanctuary', 'great-wall-theme' ); ?>">
            </div>
            <span class="scroll-cursive"><?php esc_html_e( 'Crafted for ultimate comfort', 'great-wall-theme' ); ?></span>
            <h2 class="scroll-title"><?php esc_html_e( 'Experience Unmatched Comfort & Elegance in Every Crafted Detail...', 'great-wall-theme' ); ?></h2>
            <h4 class="scroll-subtitle"><?php esc_html_e( 'Bespoke Bedroom Sanctuary', 'great-wall-theme' ); ?></h4>
            <p class="scroll-desc"><?php esc_html_e( 'Indulge in the luxury of meticulously tailored details and premium finishes. Our curated bedroom spaces are designed to provide a serene, peaceful escape from the bustling city.', 'great-wall-theme' ); ?></p>
          </div>
        </div>
        
        <!-- Right Side: Sticky Visual Capsule Frame -->
        <div class="scroll-visual-wrapper">
          <div class="visual-glow"></div>
          <div class="capsule-frame">
            <img src="<?php echo esc_url( $assets_uri . 'timber_dresser.png' ); ?>" alt="<?php esc_attr_e( 'Modern Home Solutions', 'great-wall-theme' ); ?>" class="capsule-img active" id="story-img-1">
            <img src="<?php echo esc_url( $assets_uri . 'luxury_bed.png' ); ?>" alt="<?php esc_attr_e( 'Bespoke Bedroom Sanctuary', 'great-wall-theme' ); ?>" class="capsule-img" id="story-img-2">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       CURATED ASYMMETRIC TABLE GRID SHOWCASE (Phase 11)
       ========================================================================== -->
  <section class="section tables-collection-section" id="tables-collection-section">
    <div class="container">
      <div class="tables-grid">
        <!-- Bistro Side Table (Col 1) -->
        <div class="table-card table-col-1" data-scroll>
          <div class="table-img-wrapper bistro-frame">
            <img src="<?php echo esc_url( $assets_uri . 'designer_chair.png' ); ?>" alt="<?php esc_attr_e( 'Bistro Side Table', 'great-wall-theme' ); ?>">
          </div>
          <div class="table-info">
            <h3 class="table-title"><?php esc_html_e( 'Bistro Side Table', 'great-wall-theme' ); ?></h3>
            <p class="table-desc"><?php esc_html_e( 'Solid teak top with dark inlay. Food-safe finish. Metal base.', 'great-wall-theme' ); ?></p>
          </div>
        </div>

        <!-- Metropole Coffee Table (Col 2) -->
        <div class="table-card table-col-2" data-scroll>
          <div class="table-img-wrapper metropole-frame">
            <img src="<?php echo esc_url( $assets_uri . 'dining_room.png' ); ?>" alt="<?php esc_attr_e( 'Metropole Coffee Table', 'great-wall-theme' ); ?>">
          </div>
          <div class="table-info">
            <h3 class="table-title"><?php esc_html_e( 'Metropole Coffee Table', 'great-wall-theme' ); ?></h3>
            <p class="table-desc"><?php esc_html_e( 'Reclaimed teak and black metal. Boomerang-style legs.', 'great-wall-theme' ); ?></p>
          </div>
        </div>

        <!-- Atlas Round Table (Col 3) -->
        <div class="table-card table-col-3" data-scroll>
          <div class="table-img-wrapper atlas-frame">
            <img src="<?php echo esc_url( $assets_uri . 'hero_sofa.png' ); ?>" alt="<?php esc_attr_e( 'Atlas Round Table', 'great-wall-theme' ); ?>">
          </div>
          <div class="table-info">
            <h3 class="table-title"><?php esc_html_e( 'Atlas Round Table', 'great-wall-theme' ); ?></h3>
            <p class="table-desc"><?php esc_html_e( 'Round teak top. Natural wood grain. Modern metal base.', 'great-wall-theme' ); ?></p>
          </div>
        </div>

        <!-- Cosmo Table Set (Col 4) -->
        <div class="table-card table-col-4" data-scroll>
          <div class="table-img-wrapper cosmo-frame">
            <img src="<?php echo esc_url( $assets_uri . 'carved_vase.png' ); ?>" alt="<?php esc_attr_e( 'Cosmo Table Set', 'great-wall-theme' ); ?>">
          </div>
          <div class="table-info">
            <h3 class="table-title"><?php esc_html_e( 'Cosmo Table Set', 'great-wall-theme' ); ?></h3>
            <p class="table-desc"><?php esc_html_e( 'Set of two. Reclaimed teak tops. Slim black frames.', 'great-wall-theme' ); ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       CURTAIN-SLIDE PARALLAX WATERMARK SHOWCASE (Phase 12)
       ========================================================================== -->
  <section class="section curtain-slider-section">
    <!-- Huge background watermark text -->
    <div class="watermark-container">
      <div class="watermark-text watermark-top" id="watermark-top"><?php esc_html_e( 'Interior', 'great-wall-theme' ); ?></div>
      <div class="watermark-text watermark-bottom" id="watermark-bottom"><?php esc_html_e( 'Designers', 'great-wall-theme' ); ?></div>
    </div>
    
    <!-- Central Image Slider -->
    <div class="curtain-slider-container">
      <div class="curtain-image-wrapper">
        <div class="curtain-slide active" id="curtain-slide-1">
          <img src="<?php echo esc_url( $assets_uri . 'cushion_chair.png' ); ?>" alt="<?php esc_attr_e( 'Showroom Interior Design Slide 1', 'great-wall-theme' ); ?>">
        </div>
        <div class="curtain-slide" id="curtain-slide-2">
          <img src="<?php echo esc_url( $assets_uri . 'dining_room.png' ); ?>" alt="<?php esc_attr_e( 'Showroom Interior Design Slide 2', 'great-wall-theme' ); ?>">
        </div>
        <div class="curtain-slide" id="curtain-slide-3">
          <img src="<?php echo esc_url( $assets_uri . 'luxury_bed.png' ); ?>" alt="<?php esc_attr_e( 'Showroom Interior Design Slide 3', 'great-wall-theme' ); ?>">
        </div>
        <div class="curtain-slide" id="curtain-slide-4">
          <img src="<?php echo esc_url( $assets_uri . 'timber_dresser.png' ); ?>" alt="<?php esc_attr_e( 'Showroom Interior Design Slide 4', 'great-wall-theme' ); ?>">
        </div>
        <div class="curtain-slide" id="curtain-slide-5">
          <img src="<?php echo esc_url( $assets_uri . 'hero_sofa.png' ); ?>" alt="<?php esc_attr_e( 'Showroom Interior Design Slide 5', 'great-wall-theme' ); ?>">
        </div>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       INTERACTIVE HOVER CURTAIN SHOWCASE (Phase 13)
       ========================================================================== -->
  <section class="section hover-showcase-section">
    <div class="hover-showcase-container">
      <!-- Left Floating Image Screen (For items 2 and 4) -->
      <div class="hover-image-display side-left">
        <!-- Image corresponding to Item 2: BEDROOM DESIGNS -->
        <img src="<?php echo esc_url( $assets_uri . 'luxury_bed.png' ); ?>" alt="<?php esc_attr_e( 'Bedroom Designs', 'great-wall-theme' ); ?>" class="showcase-img active">
        <!-- Image corresponding to Item 4: OFFICE INTERIOR -->
        <img src="<?php echo esc_url( $assets_uri . 'timber_dresser.png' ); ?>" alt="<?php esc_attr_e( 'Office Interior', 'great-wall-theme' ); ?>" class="showcase-img">
      </div>

      <!-- Center Text Menu List -->
      <div class="hover-text-list">
        <!-- Item 1: APARTMENT QI (Odd -> right image 0) -->
        <div class="hover-showcase-item">
          <span class="hover-showcase-text"><?php esc_html_e( 'Apartment Qi', 'great-wall-theme' ); ?></span>
          <div class="mobile-hover-image">
            <img src="<?php echo esc_url( $assets_uri . 'dining_room.png' ); ?>" alt="<?php esc_attr_e( 'Apartment Qi', 'great-wall-theme' ); ?>">
          </div>
        </div>

        <!-- Item 2: BEDROOM DESIGNS (Even -> left image 0) -->
        <div class="hover-showcase-item">
          <span class="hover-showcase-text"><?php esc_html_e( 'Bedroom Designs', 'great-wall-theme' ); ?></span>
          <div class="mobile-hover-image">
            <img src="<?php echo esc_url( $assets_uri . 'luxury_bed.png' ); ?>" alt="<?php esc_attr_e( 'Bedroom Designs', 'great-wall-theme' ); ?>">
          </div>
        </div>

        <!-- Item 3: LIVING ROOMS (Odd -> right image 1) -->
        <div class="hover-showcase-item">
          <span class="hover-showcase-text"><?php esc_html_e( 'Living Rooms', 'great-wall-theme' ); ?></span>
          <div class="mobile-hover-image">
            <img src="<?php echo esc_url( $assets_uri . 'hero_sofa.png' ); ?>" alt="<?php esc_attr_e( 'Living Rooms', 'great-wall-theme' ); ?>">
          </div>
        </div>

        <!-- Item 4: OFFICE INTERIOR (Even -> left image 1) -->
        <div class="hover-showcase-item">
          <span class="hover-showcase-text"><?php esc_html_e( 'Office Interior', 'great-wall-theme' ); ?></span>
          <div class="mobile-hover-image">
            <img src="<?php echo esc_url( $assets_uri . 'timber_dresser.png' ); ?>" alt="<?php esc_attr_e( 'Office Interior', 'great-wall-theme' ); ?>">
          </div>
        </div>
      </div>

      <!-- Right Floating Image Screen (For items 1 and 3) -->
      <div class="hover-image-display side-right">
        <!-- Image corresponding to Item 1: APARTMENT QI -->
        <img src="<?php echo esc_url( $assets_uri . 'dining_room.png' ); ?>" alt="<?php esc_attr_e( 'Apartment Qi', 'great-wall-theme' ); ?>" class="showcase-img active">
        <!-- Image corresponding to Item 3: LIVING ROOMS -->
        <img src="<?php echo esc_url( $assets_uri . 'hero_sofa.png' ); ?>" alt="<?php esc_attr_e( 'Living Rooms', 'great-wall-theme' ); ?>" class="showcase-img">
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
                <div class="showroom-info-text"><?php esc_html_e( 'info@greatwallfurnitures.com', 'great-wall-theme' ); ?></div>
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
  <div class="product-card" data-scroll class="delay-100">
    <div class="product-img-wrapper">
      <span class="product-badge">New Arrival</span>
      <img src="<?php echo esc_url( $assets_uri . 'designer_chair.png' ); ?>" alt="Aura Bouclé Accent Armchair" class="product-img main-img">
      <img src="<?php echo esc_url( $assets_uri . 'designer_chair_h.png' ); ?>" alt="Aura Bouclé Accent Armchair Olive" class="product-img hover-img">
      <div class="product-actions">
        <button class="product-action-btn add-to-cart-trigger" 
                data-id="prod-aura-chair" 
                data-title="Aura Bouclé Accent Armchair" 
                data-price="2899" 
                data-image="<?php echo esc_url( $assets_uri . 'designer_chair.png' ); ?>"
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
  <div class="product-card" data-scroll class="delay-200">
    <div class="product-img-wrapper">
      <span class="product-badge">Featured</span>
      <img src="<?php echo esc_url( $assets_uri . 'hero_sofa.png' ); ?>" alt="Hale Minimalist Bouclé Sofa" class="product-img main-img">
      <div class="product-actions">
        <button class="product-action-btn add-to-cart-trigger" 
                data-id="prod-hale-sofa" 
                data-title="Hale Minimalist Bouclé Sofa" 
                data-price="8999" 
                data-image="<?php echo esc_url( $assets_uri . 'hero_sofa.png' ); ?>"
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
  <div class="product-card" data-scroll class="delay-300">
    <div class="product-img-wrapper">
      <img src="<?php echo esc_url( $assets_uri . 'luxury_bed.png' ); ?>" alt="Sora Velvet Upholstered King Bed" class="product-img main-img">
      <div class="product-actions">
        <button class="product-action-btn add-to-cart-trigger" 
                data-id="prod-sora-bed" 
                data-title="Sora Velvet Upholstered King Bed" 
                data-price="6499" 
                data-image="<?php echo esc_url( $assets_uri . 'luxury_bed.png' ); ?>"
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
  <div class="product-card" data-scroll class="delay-400">
    <div class="product-img-wrapper">
      <span class="product-badge sale">Special Order</span>
      <img src="<?php echo esc_url( $assets_uri . 'dining_room.png' ); ?>" alt="Stella Black Marble Dining Table" class="product-img main-img">
      <div class="product-actions">
        <button class="product-action-btn add-to-cart-trigger" 
                data-id="prod-stella-dining" 
                data-title="Stella Black Marble Dining Table" 
                data-price="11499" 
                data-image="<?php echo esc_url( $assets_uri . 'dining_room.png' ); ?>"
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
      '<?php echo esc_url( $assets_uri . "designer_chair.png" ); ?>',
      '<?php echo esc_url( $assets_uri . "designer_chair_h.png" ); ?>',
      '<?php echo esc_url( $assets_uri . "blue_chair_isolated.png" ); ?>',
      '<?php echo esc_url( $assets_uri . "cushion_chair.png" ); ?>'
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
        addCartBtn.setAttribute('data-title', `Velvet Sleek Lounge Chair (${color})`);
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

