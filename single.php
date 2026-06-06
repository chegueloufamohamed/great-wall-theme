<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package great-wall-theme
 */

get_header();
?>

  <!-- ==========================================================================
       SINGLE POST HEADER BANNER
       ========================================================================== -->
  <section class="page-banner" style="background-color: var(--bg-dark); color: #FFFFFF; padding: 140px 0 80px; text-align: center;">
    <div class="container">
      <span class="section-subtitle" style="color: var(--color-accent); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.15em; display: block; margin-bottom: 12px;">
        <?php the_category( ', ' ); ?>
      </span>
      <h1 class="page-banner-title" style="font-family: var(--font-serif); font-size: 2.8rem; font-weight: 300; margin-bottom: 15px; max-width: 800px; margin-left: auto; margin-right: auto; line-height: 1.2;">
        <?php the_title(); ?>
      </h1>
      <div style="font-size: 0.85rem; color: var(--color-muted); display: flex; justify-content: center; gap: 20px;">
        <span>Published: <?php echo get_the_date(); ?></span>
        <span>By: <?php the_author(); ?></span>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       SINGLE POST MAIN CONTENT
       ========================================================================== -->
  <section class="section">
    <div class="container">
      <article id="post-<?php the_ID(); ?>" <?php post_class( 'page-content-wrapper' ); ?> style="max-width: 800px; margin: 0 auto; line-height: 1.8; font-size: 1.05rem;">
        
        <?php if ( has_post_thumbnail() ) : ?>
          <div class="post-featured-image-wrapper" style="border-radius: var(--border-radius-lg); overflow: hidden; margin-bottom: 40px; border: 1px solid var(--border-color); max-height: 500px;">
            <?php the_post_thumbnail( 'large', array( 'style' => 'width:100%; height:100%; object-fit:cover;' ) ); ?>
          </div>
        <?php endif; ?>

        <div class="entry-content">
          <?php
          while ( have_posts() ) :
            the_post();

            the_content();

          endwhile; // End of the loop.
          ?>
        </div>

        <div class="post-navigation-links" style="display: flex; justify-content: space-between; border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); padding: 24px 0; margin: 50px 0;">
          <div><?php previous_post_link( '%link', '<i class="ri-arrow-left-line"></i> Previous Post' ); ?></div>
          <div><?php next_post_link( '%link', 'Next Post <i class="ri-arrow-right-line"></i>' ); ?></div>
        </div>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;
        ?>

      </article>
    </div>
  </section>

<?php
get_footer();
