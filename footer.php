  <!-- ==========================================================================
       GLOBAL PREMIUM DARK FOOTER
       ========================================================================== -->
  <footer class="footer">
    <div class="container">
      <div class="grid footer-grid">
        
        <!-- Column 1: Brand & Socials -->
        <div class="footer-about">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
            <img src="https://greatwallfurniture.com/wp-content/uploads/2026/06/Footer-Logo.png" alt="<?php bloginfo( 'name' ); ?>" style="max-height: 48px; width: auto; display: block;">
          </a>
          <p class="footer-desc">Curating premium contemporary and minimalist wooden & upholstered masterpieces. Bringing high-end design showroom standards directly to Dubai.</p>
          <div class="social-links">
            <a href="https://www.facebook.com/profile.php?id=61590594036730" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
            <a href="https://www.instagram.com/greatwallfurnitures?igsh=MTU5a3RjNGhvYjk1Yg==" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
            <a href="https://www.tiktok.com/@greatwall.furnitures.com" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="TikTok"><i class="ri-tiktok-fill"></i></a>
          </div>
        </div>

        <!-- Column 2: Navigation 1 -->
        <div>
          <h4 class="footer-title">Collections</h4>
          <?php
          $footer_menu_1 = great_wall_get_menu_items( 'footer-menu-1' );
          if ( $footer_menu_1 ) {
            ?>
            <ul class="footer-links">
              <?php foreach ( $footer_menu_1 as $item ) : ?>
                <li><a href="<?php echo esc_url( $item->url ); ?>" class="footer-link"><?php echo esc_html( $item->title ); ?></a></li>
              <?php endforeach; ?>
            </ul>
            <?php
          } else {
            ?>
            <ul class="footer-links">
              <li><a href="<?php echo esc_url( home_url( '/shop/?cat=living' ) ); ?>" class="footer-link">Living Room</a></li>
              <li><a href="<?php echo esc_url( home_url( '/shop/?cat=bedroom' ) ); ?>" class="footer-link">Bedroom Suite</a></li>
              <li><a href="<?php echo esc_url( home_url( '/shop/?cat=dining' ) ); ?>" class="footer-link">Dining Hall</a></li>
              <li><a href="<?php echo esc_url( home_url( '/shop/?cat=accents' ) ); ?>" class="footer-link">Designer Armchairs</a></li>
              <li><a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="footer-link">Bespoke Workshop</a></li>
            </ul>
            <?php
          }
          ?>
        </div>

        <!-- Column 3: Navigation 2 -->
        <div>
          <h4 class="footer-title">Showroom</h4>
          <?php
          $footer_menu_2 = great_wall_get_menu_items( 'footer-menu-2' );
          if ( $footer_menu_2 ) {
            ?>
            <ul class="footer-links">
              <?php foreach ( $footer_menu_2 as $item ) : ?>
                <li><a href="<?php echo esc_url( $item->url ); ?>" class="footer-link"><?php echo esc_html( $item->title ); ?></a></li>
              <?php endforeach; ?>
            </ul>
            <?php
          } else {
            ?>
            <ul class="footer-links">
              <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="footer-link">Our Heritage</a></li>
              <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="footer-link">Ras Al Khor Showroom</a></li>
              <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="footer-link">Schedule Consult</a></li>
              <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="footer-link">Material Care</a></li>
              <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="footer-link">FAQs</a></li>
            </ul>
            <?php
          }
          ?>
        </div>

        <!-- Column 4: Contact & Newsletter Form -->
        <div>
          <h4 class="footer-title">Contact Showroom</h4>
          <div class="footer-contact-info" style="margin-bottom: 25px;">
            <div class="footer-contact-item">
              <i class="ri-map-pin-line"></i>
              <span>Showroom 4, Ras Al Khor Industrial 2,<br>Dubai, United Arab Emirates</span>
            </div>
            <div class="footer-contact-item">
              <i class="ri-phone-line"></i>
              <span>+971 4 320 2921</span>
            </div>
            <div class="footer-contact-item">
              <i class="ri-mail-line"></i>
              <span>info@greatwallfurniture.com</span>
            </div>
          </div>

          <p class="footer-newsletter-text">Subscribe for preview collections & luxury interior tips.</p>
          <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Subscribed successfully!');">
            <input type="email" placeholder="<?php esc_attr_e( 'Your Email Address', 'great-wall-theme' ); ?>" class="newsletter-input" required>
            <button type="submit" class="newsletter-submit" aria-label="<?php esc_attr_e( 'Submit', 'great-wall-theme' ); ?>"><i class="ri-arrow-right-line"></i></button>
          </form>
        </div>

      </div>

      <!-- Footer Bottom Copyrights -->
      <div class="footer-bottom">
        <p>&copy; <?php echo date( 'Y' ); ?> Great Wall Furnitures Trading LLC. All rights reserved. Designed for Dubai Luxury Living.</p>
        <div class="footer-bottom-links">
          <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="footer-bottom-link">Privacy Policy</a>
          <a href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>" class="footer-bottom-link">Terms & Conditions</a>
          <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="footer-bottom-link">Contact Us</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- ==========================================================================
       DYNAMICS: DRAWERS OVERLAY & ACTIVE SLIDING PANELS
       ========================================================================== -->
  <div class="drawer-overlay"></div>

  <!-- Shopping Bag Cart Drawer -->
  <div class="drawer" id="cart-drawer">
    <div class="mobile-drawer-handle drawer-close" aria-label="<?php esc_attr_e( 'Close Shopping Bag', 'great-wall-theme' ); ?>"></div>
    <div class="drawer-header">
      <h3 class="drawer-title"><?php esc_html_e( 'Shopping Bag', 'great-wall-theme' ); ?></h3>
      <button class="drawer-close" aria-label="<?php esc_attr_e( 'Close Shopping Bag', 'great-wall-theme' ); ?>"><i class="ri-close-line"></i></button>
    </div>
    
    <div class="cart-items">
      <?php
      if ( class_exists( 'WooCommerce' ) ) {
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
      } else {
        ?>
        <div class="empty-cart-message" style="text-align: center; padding: 40px 20px; color: var(--color-muted);">
          <p style="margin-bottom: 20px;">Your shopping bag is empty.</p>
          <a href="#" class="btn btn-primary drawer-close" style="display: inline-block;"><span>View Collections</span></a>
        </div>
        <?php
      }
      ?>
    </div>

    <div class="cart-footer">
      <div class="cart-totals">
        <span>Order Subtotal</span>
        <span class="cart-subtotal-val">
          <?php 
          if ( class_exists( 'WooCommerce' ) ) {
            echo WC()->cart->get_cart_subtotal();
          } else {
            echo 'AED 0';
          }
          ?>
        </span>
      </div>
      <div class="cart-buttons">
        <button class="btn btn-primary" onclick="window.location.href='<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_checkout_url() ) : esc_url( home_url( '/checkout/' ) ); ?>'"><span>Secure Checkout</span></button>
        <a href="#" class="btn btn-secondary drawer-close" style="text-align: center;">Continue Shopping</a>
      </div>
    </div>
  </div>

  <!-- Mobile Drawer Menu Panel -->
  <div class="drawer mobile-menu-drawer" id="mobile-menu-drawer">
    <div class="mobile-drawer-handle drawer-close" aria-label="<?php esc_attr_e( 'Close Menu', 'great-wall-theme' ); ?>"></div>
    <div class="drawer-header" style="display: none !important;">
      <h3 class="drawer-title">Navigation</h3>
      <button class="drawer-close" aria-label="<?php esc_attr_e( 'Close Menu', 'great-wall-theme' ); ?>"><i class="ri-close-line"></i></button>
    </div>
    <div class="mobile-nav">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-nav-link <?php echo is_front_page() ? 'text-accent' : ''; ?>">Home</a>
      
      <!-- Mobile Shop Dropdown (Accordion) -->
      <div class="mobile-nav-item-dropdown">
        <a href="#" class="mobile-nav-link mobile-dropdown-trigger">
          Shop <i class="ri-add-line dropdown-icon"></i>
        </a>
        <div class="mobile-dropdown-content">
          
          <div class="mobile-dropdown-section">
            <span class="mobile-section-title">Office Furniture</span>
            <a href="<?php echo esc_url( home_url( '/product-category/desks/' ) ); ?>">Office Desks</a>
            <a href="<?php echo esc_url( home_url( '/product-category/office-chairs/' ) ); ?>">Office Chairs</a>
            <a href="<?php echo esc_url( home_url( '/product-category/commercial-chairs/' ) ); ?>">Commercial Chairs</a>
            <a href="<?php echo esc_url( home_url( '/product-category/office-furniture/' ) ); ?>">Office Systems</a>
            <a href="<?php echo esc_url( home_url( '/product-category/reception-lounge-set/' ) ); ?>">Reception Lounge</a>
          </div>
          
          <div class="mobile-dropdown-section">
            <span class="mobile-section-title">Steel Furniture</span>
            <a href="<?php echo esc_url( home_url( '/product-category/cabinet/' ) ); ?>">Cabinets & Lockers</a>
            <a href="<?php echo esc_url( home_url( '/product-category/shelves/' ) ); ?>">Shelves & Racks</a>
            <a href="<?php echo esc_url( home_url( '/product-category/shoerack/' ) ); ?>">Wooden Shoe Racks</a>
          </div>
          
          <div class="mobile-dropdown-section">
            <span class="mobile-section-title">Accommodation</span>
            <a href="<?php echo esc_url( home_url( '/product-category/bunk-beds/' ) ); ?>">Metal Bunk Beds</a>
            <a href="<?php echo esc_url( home_url( '/product-category/single-beds/' ) ); ?>">Single Metal Beds</a>
          </div>
          
          <div class="mobile-dropdown-section">
            <span class="mobile-section-title">Tables & Dining</span>
            <a href="<?php echo esc_url( home_url( '/product-category/dinning-tables/' ) ); ?>">Dining Tables</a>
            <a href="<?php echo esc_url( home_url( '/product-category/table/' ) ); ?>">Folding Tables</a>
          </div>
          
          <div class="mobile-dropdown-section">
            <span class="mobile-section-title">Utility & Racks</span>
            <a href="<?php echo esc_url( home_url( '/product-category/partition-stands/' ) ); ?>">Foldable Divider</a>
            <a href="<?php echo esc_url( home_url( '/product-category/hanger-stands/' ) ); ?>">Hanger Stands</a>
            <a href="<?php echo esc_url( home_url( '/product-category/air-cooler/' ) ); ?>">Air Coolers</a>
          </div>

        </div>
      </div>

      <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="mobile-nav-link <?php echo is_page( 'about' ) ? 'text-accent' : ''; ?>">Our Story</a>
      <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="mobile-nav-link <?php echo is_page( 'contact' ) ? 'text-accent' : ''; ?>">Showroom</a>
      
      <!-- Mobile Drawer Social Media Links -->
      <div class="mobile-nav-socials">
        <a href="https://www.facebook.com/profile.php?id=61590594036730" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
        <a href="https://www.instagram.com/greatwallfurnitures?igsh=MTU5a3RjNGhvYjk1Yg==" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
        <a href="https://www.tiktok.com/@greatwall.furnitures.com" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="ri-tiktok-fill"></i></a>
      </div>
    </div>
  </div>

  <!-- Search Drawer Panel -->
  <div class="drawer" id="search-drawer">
    <div class="mobile-drawer-handle drawer-close" aria-label="<?php esc_attr_e( 'Close Search', 'great-wall-theme' ); ?>"></div>
    <div class="drawer-header">
      <h3 class="drawer-title"><?php esc_html_e( 'Search Products', 'great-wall-theme' ); ?></h3>
      <button class="drawer-close" aria-label="<?php esc_attr_e( 'Close Search', 'great-wall-theme' ); ?>"><i class="ri-close-line"></i></button>
    </div>
    
    <div class="drawer-search-content" style="padding: 30px; overflow-y: auto; max-height: calc(100vh - 90px);">
      <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="search-input-wrapper" style="position: relative; margin-bottom: 20px;">
          <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search products...', 'placeholder', 'great-wall-theme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'great-wall-theme' ); ?>" style="width: 100%; padding: 12px 40px 12px 16px; border: 1px solid rgba(0,0,0,0.1); border-radius: 4px; font-family: inherit; font-size: 0.95rem; outline: none; background: rgba(0,0,0,0.02);" />
          <input type="hidden" name="post_type" value="product" />
          <button type="submit" class="search-submit-btn" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; font-size: 1.2rem; cursor: pointer; color: var(--color-accent, #c5a880);"><i class="ri-search-line"></i></button>
        </div>
      </form>
      <p style="font-size: 0.8rem; color: rgba(0,0,0,0.5); text-align: center; margin-bottom: 30px;">Press Enter to search, or click the search icon.</p>

      <!-- Search Drawer Collections Grid -->
      <div class="search-drawer-collections" style="margin-top: 20px; transition: opacity 0.3s ease;">
        <h4 style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #1C1C1E; margin-bottom: 20px; text-align: left;">Explore Collections</h4>
        
        <div class="search-collections-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px 15px; padding-bottom: 30px;">
          <!-- 1. Bunk Beds -->
          <div class="rls-cat-item" onclick="window.location.href='<?php echo esc_url( home_url( '/product-category/bunk-beds/' ) ); ?>'">
            <div class="rls-cat-img-box">
              <img loading="lazy" src="https://greatwallfurniture.com/wp-content/uploads/2026/08/Bunk-Beds.webp" alt="Bunk Beds" />
            </div>
            <h4 class="rls-cat-label">Bunk Beds</h4>
          </div>

          <!-- 2. Cabinet -->
          <div class="rls-cat-item" onclick="window.location.href='<?php echo esc_url( home_url( '/product-category/cabinet/' ) ); ?>'">
            <div class="rls-cat-img-box">
              <img loading="lazy" src="https://greatwallfurniture.com/wp-content/uploads/2026/08/Cabinet.webp" alt="Cabinet" />
            </div>
            <h4 class="rls-cat-label">Cabinet</h4>
          </div>

          <!-- 3. Office Chairs -->
          <div class="rls-cat-item" onclick="window.location.href='<?php echo esc_url( home_url( '/product-category/office-chairs/' ) ); ?>'">
            <div class="rls-cat-img-box">
              <img loading="lazy" src="https://greatwallfurniture.com/wp-content/uploads/2026/08/Office-Chairs.webp" alt="Office Chairs" />
            </div>
            <h4 class="rls-cat-label">Office Chairs</h4>
          </div>

          <!-- 4. Commercial Chairs -->
          <div class="rls-cat-item" onclick="window.location.href='<?php echo esc_url( home_url( '/product-category/commercial-chairs/' ) ); ?>'">
            <div class="rls-cat-img-box">
              <img loading="lazy" src="https://greatwallfurniture.com/wp-content/uploads/2026/08/Commercial-Chairs.webp" alt="Commercial Chairs" />
            </div>
            <h4 class="rls-cat-label">Commercial Chairs</h4>
          </div>

          <!-- 5. Dining Tables -->
          <div class="rls-cat-item" onclick="window.location.href='<?php echo esc_url( home_url( '/product-category/dinning-tables/' ) ); ?>'">
            <div class="rls-cat-img-box">
              <img loading="lazy" src="https://greatwallfurniture.com/wp-content/uploads/2026/08/Dinning-Tables.webp" alt="Dining Tables" />
            </div>
            <h4 class="rls-cat-label">Dining Tables</h4>
          </div>

          <!-- 6. Foldable Room Divider -->
          <div class="rls-cat-item" onclick="window.location.href='<?php echo esc_url( home_url( '/product-category/partition-stands/' ) ); ?>'">
            <div class="rls-cat-img-box">
              <img loading="lazy" src="https://greatwallfurniture.com/wp-content/uploads/2026/08/Room-Divider.webp" alt="Foldable Room Divider" />
            </div>
            <h4 class="rls-cat-label">Foldable Room Divider</h4>
          </div>

          <!-- 7. Office Furniture -->
          <div class="rls-cat-item" onclick="window.location.href='<?php echo esc_url( home_url( '/product-category/office-furniture/' ) ); ?>'">
            <div class="rls-cat-img-box">
              <img loading="lazy" src="https://greatwallfurniture.com/wp-content/uploads/2026/08/Desks.webp" alt="Office Furniture" />
            </div>
            <h4 class="rls-cat-label">Office Furniture</h4>
          </div>

          <!-- 8. Reception Lounge Set -->
          <div class="rls-cat-item" onclick="window.location.href='<?php echo esc_url( home_url( '/product-category/reception-lounge-set/' ) ); ?>'">
            <div class="rls-cat-img-box">
              <img loading="lazy" src="https://greatwallfurniture.com/wp-content/uploads/2026/08/Reception-Lounge.webp" alt="Reception Lounge Set" />
            </div>
            <h4 class="rls-cat-label">Reception Lounge Set</h4>
          </div>

          <!-- 9. Shelves -->
          <div class="rls-cat-item" onclick="window.location.href='<?php echo esc_url( home_url( '/product-category/shelves/' ) ); ?>'">
            <div class="rls-cat-img-box">
              <img loading="lazy" src="https://greatwallfurniture.com/wp-content/uploads/2026/08/Shelves.webp" alt="Shelves" />
            </div>
            <h4 class="rls-cat-label">Shelves</h4>
          </div>

          <!-- 10. Sofa -->
          <div class="rls-cat-item" onclick="window.location.href='<?php echo esc_url( home_url( '/product-category/sofa/' ) ); ?>'">
            <div class="rls-cat-img-box">
              <img loading="lazy" src="https://greatwallfurniture.com/wp-content/uploads/2026/08/Sofa.webp" alt="Sofa" />
            </div>
            <h4 class="rls-cat-label">Sofa</h4>
          </div>

          <!-- 11. Single Beds -->
          <div class="rls-cat-item" onclick="window.location.href='<?php echo esc_url( home_url( '/product-category/single-beds/' ) ); ?>'">
            <div class="rls-cat-img-box">
              <img loading="lazy" src="https://greatwallfurniture.com/wp-content/uploads/2026/08/Single-Beds.webp" alt="Single Beds" />
            </div>
            <h4 class="rls-cat-label">Single Beds</h4>
          </div>

          <!-- 12. Table -->
          <div class="rls-cat-item" onclick="window.location.href='<?php echo esc_url( home_url( '/product-category/table/' ) ); ?>'">
            <div class="rls-cat-img-box">
              <img loading="lazy" src="https://greatwallfurniture.com/wp-content/uploads/2026/08/Table.webp" alt="Table" />
            </div>
            <h4 class="rls-cat-label">Table</h4>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('#search-drawer .search-field');
        const collectionsGrid = document.querySelector('.search-drawer-collections');
        if (searchInput && collectionsGrid) {
          searchInput.addEventListener('input', function() {
            if (searchInput.value.trim().length > 0) {
              collectionsGrid.style.opacity = '0';
              setTimeout(() => {
                if (searchInput.value.trim().length > 0) {
                  collectionsGrid.style.display = 'none';
                }
              }, 300);
            } else {
              collectionsGrid.style.display = 'block';
              setTimeout(() => {
                collectionsGrid.style.opacity = '1';
              }, 10);
            }
          });
        }
      });
    </script>
  </div>

  <!-- Wishlist Drawer Panel -->
  <div class="drawer" id="wishlist-drawer">
    <div class="mobile-drawer-handle drawer-close" aria-label="<?php esc_attr_e( 'Close Wishlist', 'great-wall-theme' ); ?>"></div>
    <div class="drawer-header">
      <h3 class="drawer-title"><?php esc_html_e( 'My Wishlist', 'great-wall-theme' ); ?></h3>
      <button class="drawer-close" aria-label="<?php esc_attr_e( 'Close Wishlist', 'great-wall-theme' ); ?>"><i class="ri-close-line"></i></button>
    </div>
    
    <div class="wishlist-drawer-content">
      <div class="wishlist-items" id="wishlist-items-container">
        <!-- Rendered dynamically by javascript -->
      </div>
      <div class="wishlist-empty-state" id="wishlist-empty-msg" style="text-align: center; padding: 40px 20px; display: none;">
        <i class="ri-heart-line" style="font-size: 2.5rem; color: var(--color-accent, #c5a880); opacity: 0.5; display: block; margin-bottom: 15px;"></i>
        <p style="color: var(--color-muted); margin-bottom: 20px;">Your wishlist is empty.</p>
        <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="btn btn-primary drawer-close" style="display: inline-block;"><span>Go To Shop</span></a>
      </div>
    </div>
  </div>

  <!-- Floating WhatsApp Chat Button -->
  <a href="https://wa.me/971582176351" class="floating-whatsapp-btn" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Chat with us on WhatsApp', 'great-wall-theme' ); ?>">
    <img src="https://greatwallfurniture.com/wp-content/uploads/2026/07/whatsapp.webp" alt="WhatsApp">
  </a>

  <!-- Global Floating Back to Top Button -->
  <button class="floating-back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'});" aria-label="<?php esc_attr_e( 'Scroll to top', 'great-wall-theme' ); ?>">
    <span class="back-to-top-text"><?php esc_html_e( 'Back To Top', 'great-wall-theme' ); ?></span>
    <i class="ri-arrow-up-line"></i>
  </button>

<?php if ( is_product() ) : ?>
<script>
window.addEventListener('load', function() {
  setTimeout(function() {
    var report = [];
    var addReport = function(selector) {
      var el = document.querySelector(selector);
      if (!el) {
        report.push(selector + ": NOT FOUND");
        return;
      }
      var rect = el.getBoundingClientRect();
      var styles = window.getComputedStyle(el);
      report.push(selector + " -> " +
        "top: " + rect.top + ", " +
        "left: " + rect.left + ", " +
        "height: " + rect.height + ", " +
        "width: " + rect.width + ", " +
        "position: " + styles.position + ", " +
        "offsetParent: " + (el.offsetParent ? el.offsetParent.className + ' (' + el.offsetParent.tagName + ')' : 'NONE')
      );
    };
    addReport('body');
    addReport('.site-header-wrapper');
    addReport('.header');
    addReport('section.section');
    addReport('.product');
    addReport('.woocommerce-product-gallery');
    addReport('.woocommerce-product-gallery__wrapper');
    addReport('.woocommerce-breadcrumb');
    addReport('.single-wishlist-btn');
    
    var data = report.join("\n");
    fetch('/?save_diagnostics=' + encodeURIComponent(data));
  }, 1000);
});
</script>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
