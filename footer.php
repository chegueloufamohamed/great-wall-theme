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
            <a href="#" class="social-link" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
            <a href="#" class="social-link" aria-label="Pinterest"><i class="ri-pinterest-line"></i></a>
            <a href="#" class="social-link" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
            <a href="#" class="social-link" aria-label="LinkedIn"><i class="ri-linkedin-fill"></i></a>
          </div>
        </div>

        <!-- Column 2: Navigation 1 -->
        <div>
          <h4 class="footer-title">Collections</h4>
          <?php
          if ( has_nav_menu( 'footer-menu-1' ) ) {
            wp_nav_menu(
              array(
                'theme_location' => 'footer-menu-1',
                'container'      => false,
                'menu_class'     => 'footer-links',
              )
            );
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
          if ( has_nav_menu( 'footer-menu-2' ) ) {
            wp_nav_menu(
              array(
                'theme_location' => 'footer-menu-2',
                'container'      => false,
                'menu_class'     => 'footer-links',
              )
            );
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
          <a href="#" class="footer-bottom-link">Privacy Policy</a>
          <a href="#" class="footer-bottom-link">Terms & Conditions</a>
          <a href="#" class="footer-bottom-link">Sitemap</a>
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
      <!-- High-fidelity script handles frontend mock cart and WC triggers -->
      <?php if ( class_exists( 'WooCommerce' ) && ! WC()->cart->is_empty() ) : ?>
        <!-- WooCommerce mini-cart loop can be rendered here dynamically -->
      <?php endif; ?>
    </div>

    <div class="cart-footer">
      <div class="cart-totals">
        <span>Order Subtotal</span>
        <span class="cart-subtotal-val">AED 0</span>
      </div>
      <div class="cart-buttons">
        <button class="btn btn-primary" onclick="window.location.href='<?php echo esc_url( wc_get_checkout_url() ); ?>'"><span>Secure Checkout</span></button>
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
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-nav-link text-accent">Home</a>
      <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="mobile-nav-link">Collections</a>
      <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="mobile-nav-link">Our Story</a>
      <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="mobile-nav-link">Showroom Consult</a>
    </div>
  </div>

<?php wp_footer(); ?>
</body>
</html>
