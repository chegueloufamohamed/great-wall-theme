<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package great-wall-theme
 */

get_header();
?>

  <!-- ==========================================================================
       FALLBACK INDEX HEADER BANNER
       ========================================================================== -->
  <section class="page-banner" style="background-color: var(--bg-dark); color: #FFFFFF; padding: 140px 0 80px; text-align: center;">
    <div class="container">
      <h1 class="page-banner-title" style="font-family: var(--font-serif); font-size: 3rem; font-weight: 300; margin-bottom: 12px;">
        <?php bloginfo( 'name' ); ?>
      </h1>
      <p style="color: var(--color-accent-light); font-size: 1rem; font-weight: 300;">
        <?php bloginfo( 'description' ); ?>
      </p>
    </div>
  </section>

  <!-- ==========================================================================
       FALLBACK POSTS LOOP LIST
       ========================================================================== -->
  <section class="section">
    <div class="container">
      <div style="max-width: 900px; margin: 0 auto;">
        
        <?php
        if ( have_posts() ) :

          /* Start the Loop */
          while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="margin-bottom: 60px; padding-bottom: 60px; border-bottom: 1px solid var(--border-color);">
              <header class="entry-header" style="margin-bottom: 20px;">
                <span class="product-category" style="margin-bottom: 8px; display: inline-block;"><?php the_category( ', ' ); ?></span>
                <h2 style="font-family: var(--font-serif); font-size: 2.2rem; font-weight: 400;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div style="font-size: 0.85rem; color: var(--color-muted); margin-top: 8px;">
                  <span>Published: <?php echo get_the_date(); ?></span>
                </div>
              </header>

              <?php if ( has_post_thumbnail() ) : ?>
                <div style="border-radius: var(--border-radius-md); overflow: hidden; margin-bottom: 25px; border: 1px solid var(--border-color); max-height: 400px;">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'large', array( 'style' => 'width:100%; height:100%; object-fit:cover;' ) ); ?>
                  </a>
                </div>
              <?php endif; ?>

              <div class="entry-summary" style="line-height: 1.7; color: var(--color-secondary); font-size: 1rem;">
                <?php the_excerpt(); ?>
              </div>

              <div style="margin-top: 25px;">
                <a href="<?php the_permalink(); ?>" class="btn btn-secondary" style="padding: 10px 24px; font-size: 0.75rem;">Read Masterpiece</a>
              </div>
            </article>
            <?php
          endwhile;

          the_posts_navigation(
            array(
              'prev_text' => esc_html__( 'Older Entries', 'great-wall-theme' ),
              'next_text' => esc_html__( 'Newer Entries', 'great-wall-theme' ),
            )
          );

        else :
          ?>
          <div style="text-align: center; padding: 60px 0; color: var(--color-secondary);">
            <i class="ri-error-warning-line" style="font-size: 3rem; color: var(--color-accent); margin-bottom: 20px; display: inline-block;"></i>
            <h3>No entries discovered.</h3>
            <p style="margin-top: 8px;">Check back later for fresh showroom journals and timber care advice.</p>
          </div>
          <?php
        endif;
        ?>

      </div>
    </div>
  </section>

<?php
get_footer();
