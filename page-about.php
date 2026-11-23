<?php
/**
 * Template Name: Our Story
 * The template for displaying the Our Story / About page (slug: about)
 *
 * @package great-wall-theme
 */

get_header();
?>

  <!-- ==========================================================================
       DYNAMIC PAGE HEADER BANNER
       ========================================================================== -->
  <section class="page-banner" style="background-color: var(--bg-dark); color: #FFFFFF; padding: 140px 0 80px; text-align: center;">
    <div class="container">
      <h1 class="page-banner-title" style="font-family: var(--font-serif); font-size: 3rem; font-weight: 300; margin-bottom: 12px;">
        <?php esc_html_e( 'Our Story', 'great-wall-theme' ); ?>
      </h1>
      <div class="breadcrumbs" style="display: flex; justify-content: center; gap: 8px; font-size: 0.85rem; color: var(--color-accent-light);">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'great-wall-theme' ); ?></a>
        <span>/</span>
        <span><?php esc_html_e( 'Our Story', 'great-wall-theme' ); ?></span>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       OUR STORY BODY CONTENT
       ========================================================================== -->
  <section class="section" style="padding: 80px 0; background-color: var(--bg-primary, #FAF8F5);">
    <div class="container">
      <div class="page-content-wrapper" style="max-width: 920px; margin: 0 auto; background: #FFFFFF; padding: 50px 55px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); border: 1px solid rgba(230, 223, 213, 0.8); line-height: 1.85; font-size: 1.06rem; color: var(--color-primary, #1E1C19);">
        <p style="margin-bottom: 24px;">
          Great Wall Furnitures Trading LLC was founded in 2005 and specializes in furniture import and export trading in Dubai, UAE. The company has registered two brands in the UAE (<strong>PILOTEER</strong> and <strong>MOMENT</strong>). Its main products are divided into three categories: residential furniture, office furniture, and labor camp series products.
        </p>

        <p style="margin-bottom: 24px;">
          After more than 20 years of continuous development and improvement, the company has continued to launch new products and expand its business. It now has a well-established and independent operating system that provides customers with comprehensive services and professional support at every stage—from pre-sale ordering to goods transportation and assembly, and through to after-sales service. The company has a large warehouse to ensure an ample supply of stored goods; it has more than ten vehicles and a team of dozens of staff, ensuring that the entire service process—from product inquiry and order confirmation to timely delivery, installation, and after-sales service—is completed efficiently. At present, the company holds a considerable share of the UAE furniture market and enjoys high recognition in the furniture industry. It also maintains ongoing and close business relationships with customers in several neighboring Gulf countries.
        </p>

        <p style="margin-bottom: 24px;">
          In 2018, the company established a branch in the Sultanate of Oman, with its own showroom and large warehouse. The company's headquarters is located in Tianjin, China, and it owns two self-operated furniture factories, enabling effective and reasonable control of quality and cost. The company has a professional foreign trade team and very stable partner manufacturers across the country, which can meet customers' diverse procurement needs. The company is committed to providing customers with diversified products at the best value for money.
        </p>

        <p style="margin-bottom: 0;">
          Through unremitting efforts, the company has established close and lasting cooperative relationships with dozens of large multinational groups and enterprises in the UAE. We sincerely thank our new and old customers for their trust and support of Great Wall Furnitures Trading LLC! The company will continue to uphold the principles of &ldquo;integrity-based, service-first, win-win cooperation, and high cost-effectiveness,&rdquo; providing customers with all-round, multi-dimensional shopping services and ensuring a quality shopping experience.
        </p>
      </div>
    </div>
  </section>

  <style>
    @media (max-width: 768px) {
      .page-content-wrapper {
        padding: 32px 24px !important;
        font-size: 1rem !important;
      }
    }
  </style>

<?php
get_footer();
