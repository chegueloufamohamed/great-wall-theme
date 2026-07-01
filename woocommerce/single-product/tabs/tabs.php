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
    
    <!-- 1. Description Section -->
    <?php 
    $description = get_the_content();
    if ( ! empty( trim( $description ) ) ) : ?>
        <div class="product-section-block section-description">
            <h2 class="product-section-title"><?php esc_html_e( 'Description', 'great-wall-theme' ); ?></h2>
            <div class="product-section-content">
                <?php the_content(); ?>
            </div>
        </div>
        <div class="section-divider-stacked"></div>
    <?php endif; ?>
    
    <!-- 2. Reviews Section -->
    <div class="product-section-block section-reviews">
        <div class="product-section-content">
            <?php 
            if ( comments_open() ) {
                comments_template(); 
            }
            ?>
        </div>
    </div>
    
</div>
