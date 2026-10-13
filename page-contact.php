<?php
/**
 * Template Name: Contact Us & Showroom
 * The template for displaying the Contact Us page (slug: contact)
 *
 * @package great-wall-theme
 */

get_header();
?>

  <!-- ==========================================================================
       DYNAMIC CONTACT PAGE BANNER
       ========================================================================== -->
  <section class="page-banner" style="background-color: var(--bg-dark, #1C1C1E); color: #FFFFFF; padding: 140px 0 80px; text-align: center;">
    <div class="container">
      <span class="section-subtitle" style="color: var(--color-accent, #c5a880); display: block; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 10px;">
        <?php esc_html_e( 'Get In Touch', 'great-wall-theme' ); ?>
      </span>
      <h1 class="page-banner-title" style="font-family: var(--font-serif, 'Cormorant Garamond', serif); font-size: 3.2rem; font-weight: 300; margin-bottom: 15px; color: #FFFFFF;">
        <?php esc_html_e( 'Contact Our Showroom', 'great-wall-theme' ); ?>
      </h1>
      <div class="breadcrumbs" style="display: flex; justify-content: center; gap: 8px; font-size: 0.85rem; color: var(--color-accent-light, #DFC5A0);">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: inherit; text-decoration: none;">Home</a>
        <span>/</span>
        <span>Contact Us</span>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       CONTACT & SHOWROOM DETAILS
       ========================================================================== -->
  <section class="section contact-page-section" style="padding: 80px 0; background-color: var(--bg-page, #FAF9F5);">
    <div class="container">
      <div class="contact-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: start;">
        
        <!-- Left Column: Information Cards -->
        <div class="contact-info-column" data-scroll>
          <div class="contact-card" style="background: #FFFFFF; border-radius: 20px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 30px; border: 1px solid rgba(0,0,0,0.04);">
            <span class="section-subtitle" style="color: var(--color-accent, #c5a880); display: block; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; margin-bottom: 8px;">
              <?php esc_html_e( 'Visit Our Dubai Showroom', 'great-wall-theme' ); ?>
            </span>
            <h2 style="font-family: var(--font-serif, 'Cormorant Garamond', serif); font-size: 2.2rem; color: var(--color-primary, #1C1C1E); margin-bottom: 15px; font-weight: 400;">
              <?php esc_html_e( 'Experience Luxury Furniture In Person', 'great-wall-theme' ); ?>
            </h2>
            <p style="color: #6E6D7A; line-height: 1.7; margin-bottom: 30px;">
              <?php esc_html_e( 'Our consultants and designers are available at our Dubai Furniture Market showroom to guide you through executive office furniture, partitions, modern workstations, and custom dimension drafting.', 'great-wall-theme' ); ?>
            </p>

            <!-- Showroom Address -->
            <div style="display: flex; gap: 16px; margin-bottom: 24px; align-items: flex-start;">
              <div style="width: 44px; height: 44px; border-radius: 50%; background: #F6F3EE; color: var(--color-accent, #c5a880); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                <i class="ri-map-pin-2-line"></i>
              </div>
              <div>
                <strong style="display: block; font-size: 0.82rem; text-transform: uppercase; color: #8E8E93; letter-spacing: 0.08em; margin-bottom: 4px;">Showroom Address</strong>
                <span style="font-size: 1.05rem; color: #1C1C1E; font-weight: 600; line-height: 1.5;">Gate 3, Shop 15+16, Dubai Furniture Market,<br>Nad Al Sheba 3, Dubai, United Arab Emirates</span>
              </div>
            </div>

            <!-- Phone Numbers -->
            <div style="display: flex; gap: 16px; margin-bottom: 24px; align-items: flex-start;">
              <div style="width: 44px; height: 44px; border-radius: 50%; background: #F6F3EE; color: var(--color-accent, #c5a880); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                <i class="ri-phone-line"></i>
              </div>
              <div style="flex: 1;">
                <strong style="display: block; font-size: 0.82rem; text-transform: uppercase; color: #8E8E93; letter-spacing: 0.08em; margin-bottom: 6px;">Contact Numbers</strong>
                
                <!-- English Number -->
                <div style="display: flex; justify-content: space-between; align-items: center; background: #FAF9F6; padding: 12px 14px; border-radius: 12px; margin-bottom: 10px; border: 1px solid rgba(0,0,0,0.04);">
                  <div>
                    <span style="font-size: 0.78rem; font-weight: 700; color: #2E7D32; background: #E8F5E9; padding: 2px 8px; border-radius: 6px; margin-right: 6px;">English</span>
                    <strong style="font-size: 0.95rem; color: #1C1C1E;">+971 58 217 6351</strong>
                  </div>
                  <div style="display: flex; gap: 6px;">
                    <a href="tel:+971582176351" style="background: #1C1C1E; color: #FFFFFF; padding: 6px 12px; border-radius: 6px; font-size: 0.78rem; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                      <i class="ri-phone-line"></i> Call
                    </a>
                    <a href="https://wa.me/971582176351?text=Hello%20Great%20Wall%20Furniture,%20I%20would%20like%20to%20inquire%20about%20your%20products" target="_blank" rel="noopener noreferrer" style="background: #25D366; color: #FFFFFF; padding: 6px 12px; border-radius: 6px; font-size: 0.78rem; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                      <i class="ri-whatsapp-line"></i> WhatsApp
                    </a>
                  </div>
                </div>

                <!-- Chinese Number -->
                <div style="display: flex; justify-content: space-between; align-items: center; background: #FAF9F6; padding: 12px 14px; border-radius: 12px; border: 1px solid rgba(0,0,0,0.04);">
                  <div>
                    <span style="font-size: 0.78rem; font-weight: 700; color: #C62828; background: #FFEBEE; padding: 2px 8px; border-radius: 6px; margin-right: 6px;">Chinese / 中文</span>
                    <strong style="font-size: 0.95rem; color: #1C1C1E;">+971 52 398 2539</strong>
                  </div>
                  <div style="display: flex; gap: 6px;">
                    <a href="tel:+971523982539" style="background: #1C1C1E; color: #FFFFFF; padding: 6px 12px; border-radius: 6px; font-size: 0.78rem; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                      <i class="ri-phone-line"></i> Call
                    </a>
                    <a href="https://wa.me/971523982539?text=您好，我想咨询长城家具产品" target="_blank" rel="noopener noreferrer" style="background: #25D366; color: #FFFFFF; padding: 6px 12px; border-radius: 6px; font-size: 0.78rem; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                      <i class="ri-whatsapp-line"></i> WhatsApp
                    </a>
                  </div>
                </div>

              </div>
            </div>

            <!-- Email Address -->
            <div style="display: flex; gap: 16px; margin-bottom: 24px; align-items: flex-start;">
              <div style="width: 44px; height: 44px; border-radius: 50%; background: #F6F3EE; color: var(--color-accent, #c5a880); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                <i class="ri-mail-line"></i>
              </div>
              <div>
                <strong style="display: block; font-size: 0.82rem; text-transform: uppercase; color: #8E8E93; letter-spacing: 0.08em; margin-bottom: 4px;">Email Support</strong>
                <a href="mailto:info@greatwallfurnitures.com" style="font-size: 1.05rem; color: #1C1C1E; font-weight: 600; text-decoration: none;">info@greatwallfurnitures.com</a>
              </div>
            </div>

            <!-- Showroom Hours -->
            <div style="display: flex; gap: 16px; align-items: flex-start;">
              <div style="width: 44px; height: 44px; border-radius: 50%; background: #F6F3EE; color: var(--color-accent, #c5a880); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                <i class="ri-time-line"></i>
              </div>
              <div>
                <strong style="display: block; font-size: 0.82rem; text-transform: uppercase; color: #8E8E93; letter-spacing: 0.08em; margin-bottom: 4px;">Showroom Hours</strong>
                <div style="color: #1C1C1E; font-size: 0.95rem;">
                  <div>Saturday – Thursday: <strong>9:00 AM – 8:00 PM</strong></div>
                  <div style="margin-top: 3px;">Friday: <strong>2:00 PM – 8:00 PM</strong></div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Right Column: Interactive Map -->
        <div class="contact-map-column" data-scroll>
          <div style="background: #FFFFFF; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.04); height: 100%;">
            <div style="padding: 24px 28px; border-bottom: 1px solid rgba(0,0,0,0.06); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
              <div>
                <h3 style="margin: 0; font-size: 1.25rem; font-weight: 700; color: #1C1C1E;">Dubai Furniture Market Location</h3>
                <span style="font-size: 0.85rem; color: #8E8E93;">Nad Al Sheba 3, Gate 3, Shop 15+16</span>
              </div>
              <a href="https://maps.google.com/?q=Dubai+Furniture+Market+Nad+Al+Sheba+3+Dubai" target="_blank" rel="noopener noreferrer" style="background: #F6F3EE; color: #1C1C1E; padding: 8px 16px; border-radius: 20px; font-size: 0.82rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                <i class="ri-direction-line"></i> Get Directions
              </a>
            </div>
            <iframe 
              src="https://maps.google.com/maps?q=Dubai+Furniture+Market+Nad+Al+Sheba+3+Dubai&t=&z=15&ie=UTF8&iwloc=&output=embed" 
              style="width: 100%; height: 500px; border: 0; display: block;" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade"
              title="<?php esc_attr_e( 'Google Maps Location of Great Wall Furniture Showroom Dubai', 'great-wall-theme' ); ?>">
            </iframe>
          </div>
        </div>

      </div>
    </div>
  </section>

  <style>
    @media (max-width: 900px) {
      .contact-grid {
        grid-template-columns: 1fr !important;
        gap: 30px !important;
      }
    }
  </style>

<?php
get_footer();
