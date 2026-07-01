<?php
/**
 * Custom Single Product Stacked Sections (Replaces Tabs).
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;
?>
<div class="product-stacked-sections-wrapper">
    
    <!-- 1. Reviews Section (Top) -->
    <div class="product-section-block section-reviews">
        <div class="product-section-content">
            <?php 
            if ( comments_open() ) {
                comments_template(); 
            }
            ?>
        </div>
    </div>
    
    <div class="section-divider-stacked"></div>
    
    <!-- 2. Specifications Section (Bottom) -->
    <?php 
    $description = get_the_content();
    if ( ! empty( trim( $description ) ) ) : ?>
        <div class="product-section-block section-specifications">
            <h2 class="product-section-title"><?php esc_html_e( 'Specifications', 'great-wall-theme' ); ?></h2>
            <div class="product-section-content section-specifications-content">
                <?php 
                $content = apply_filters( 'the_content', get_the_content() );
                // Strip duplicate leading "Specifications" headers typed in the post editor
                $content = preg_replace( '/^\s*<p>\s*(?:<strong>)?\s*Specifications\s*:?\s*(?:<\/strong>)?\s*:?\s*<\/p>/i', '', $content );
                $content = preg_replace( '/^\s*(?:<strong>)?\s*Specifications\s*:?\s*(?:<\/strong>)?\s*:?\s*/i', '', $content );
                echo $content;
                ?>
            </div>
        </div>
    <?php endif; ?>
    
</div>
