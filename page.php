<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
        <?php the_title(); ?>
      </h1>
      <div class="breadcrumbs" style="display: flex; justify-content: center; gap: 8px; font-size: 0.85rem; color: var(--color-accent-light);">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <span>/</span>
        <span><?php the_title(); ?></span>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       DYNAMIC PAGE BODY CONTENT
       ========================================================================== -->
  <section class="section">
    <div class="container">
      <div class="page-content-wrapper" style="max-width: 900px; margin: 0 auto; line-height: 1.8; font-size: 1.05rem;">
        
        <?php
        while ( have_posts() ) :
          the_post();

          the_content();

          // If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;

        endwhile; // End of the loop.
        ?>

      </div>
    </div>
  </section>

<?php
get_footer();
