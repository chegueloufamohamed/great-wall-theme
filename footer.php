  <!-- ==========================================================================
       GLOBAL PREMIUM DARK FOOTER
       ========================================================================== -->
  <footer class="footer">
    <div class="container">
      <div class="grid footer-grid">
        
        <!-- Column 1: Brand & Socials -->
        <div class="footer-about">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
            <div class="logo-icon"></div>
            Great Wall<span>Furniture</span>
          </a>
          <p class="footer-desc">Curating premium contemporary and minimalist wooden & upholstered masterpieces. Bringing high-end design showroom standards directly to Dubai.</p>
          <div class="social-links">
            <a href="https://www.instagram.com/greatwallfurnitures/" target="_blank" class="social-link" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
            <a href="https://www.tiktok.com/@greatwall.furnitures.com" target="_blank" class="social-link" aria-label="TikTok"><i class="ri-tiktok-fill"></i></a>
            <a href="#" class="social-link" aria-label="Pinterest"><i class="ri-pinterest-line"></i></a>
            <a href="#" class="social-link" aria-label="LinkedIn"><i class="ri-linkedin-fill"></i></a>
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
              <span>info@greatwallfurnitures.com</span>
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
    <div class="drawer-header">
      <h3 class="drawer-title">Navigation</h3>
      <button class="drawer-close" aria-label="<?php esc_attr_e( 'Close Menu', 'great-wall-theme' ); ?>"><i class="ri-close-line"></i></button>
    </div>
    <div class="mobile-nav">
      <?php
      $primary_menu_items = great_wall_get_menu_items( 'primary-menu' );
      if ( $primary_menu_items ) {
        foreach ( $primary_menu_items as $item ) {
          $active_class = great_wall_is_menu_item_active( $item ) ? 'text-accent' : '';
          ?>
          <a href="<?php echo esc_url( $item->url ); ?>" class="mobile-nav-link <?php echo esc_attr( $active_class ); ?>"><?php echo esc_html( $item->title ); ?></a>
          <?php
        }
      } else {
        ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-nav-link text-accent">Home</a>
        <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="mobile-nav-link">Collections</a>
        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="mobile-nav-link">Our Story</a>
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="mobile-nav-link">Showroom Consult</a>
        <?php
      }
      ?>
    </div>
  </div>
  <!-- Global Floating Back to Top Button -->
  <button class="floating-back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'});" aria-label="<?php esc_attr_e( 'Scroll to top', 'great-wall-theme' ); ?>">
    <i class="ri-arrow-up-line"></i>
  </button>

<?php wp_footer(); ?>
</body>
</html>
