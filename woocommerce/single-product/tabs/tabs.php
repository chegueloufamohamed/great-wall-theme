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
    
    <!-- 2. Specifications Section (Additional Information) -->
    <?php
    $has_weight = $product->has_weight();
    $has_dimensions = $product->has_dimensions();
    $attributes = $product->get_attributes();
    $has_attributes = false;
    foreach ( $attributes as $attr ) {
        if ( $attr->get_visible() ) {
            $has_attributes = true;
            break;
        }
    }
    
    if ( $has_weight || $has_dimensions || $has_attributes ) : ?>
        <div class="product-section-block section-specifications">
            <h2 class="product-section-title"><?php esc_html_e( 'Specifications', 'great-wall-theme' ); ?></h2>
            <div class="product-section-content">
                <div class="product-specs-table-wrapper" style="overflow-x: auto; border: 1.5px solid var(--border-color, #e5e0d8); border-radius: 14px; background: #ffffff; padding: 24px; box-shadow: var(--shadow-sm);">
                    <table class="product-specs-table" style="width: 100%; border-collapse: collapse; font-family: var(--font-sans, sans-serif); font-size: 0.95rem; color: var(--color-primary, #2e2a25);">
                        <tbody>
                            <?php
                            $bg_alt = false;
                            
                            // Weight
                            if ( $has_weight ) {
                                $bg_color = $bg_alt ? 'background-color: #faf9f6;' : 'background-color: #ffffff;';
                                echo '<tr style="' . $bg_color . '">';
                                echo '<td style="padding: 14px 18px; font-weight: 700; border-bottom: 1px solid var(--border-color, #e5e0d8); width: 220px; text-transform: uppercase; font-size: 0.78rem; letter-spacing: 0.05em; border-right: 1px solid var(--border-color, #e5e0d8);">' . esc_html__( 'Weight', 'great-wall-theme' ) . '</td>';
                                echo '<td style="padding: 14px 18px; border-bottom: 1px solid var(--border-color, #e5e0d8); color: var(--color-secondary, #555);">' . esc_html( $product->get_weight() ) . ' ' . esc_html( get_option( 'woocommerce_weight_unit' ) ) . '</td>';
                                echo '</tr>';
                                $bg_alt = ! $bg_alt;
                            }
                            
                            // Dimensions
                            if ( $has_dimensions ) {
                                $bg_color = $bg_alt ? 'background-color: #faf9f6;' : 'background-color: #ffffff;';
                                echo '<tr style="' . $bg_color . '">';
                                echo '<td style="padding: 14px 18px; font-weight: 700; border-bottom: 1px solid var(--border-color, #e5e0d8); width: 220px; text-transform: uppercase; font-size: 0.78rem; letter-spacing: 0.05em; border-right: 1px solid var(--border-color, #e5e0d8);">' . esc_html__( 'Dimensions', 'great-wall-theme' ) . '</td>';
                                echo '<td style="padding: 14px 18px; border-bottom: 1px solid var(--border-color, #e5e0d8); color: var(--color-secondary, #555);">' . esc_html( $product->get_length() ) . ' &times; ' . esc_html( $product->get_width() ) . ' &times; ' . esc_html( $product->get_height() ) . ' ' . esc_html( get_option( 'woocommerce_dimension_unit' ) ) . '</td>';
                                echo '</tr>';
                                $bg_alt = ! $bg_alt;
                            }
                            
                            // Custom Attributes
                            foreach ( $attributes as $attribute ) {
                                if ( $attribute->get_visible() ) {
                                    $name = wc_attribute_label( $attribute->get_name() );
                                    $val = '';
                                    if ( $attribute->is_taxonomy() ) {
                                        $terms = $attribute->get_terms();
                                        $values = array();
                                        foreach ( $terms as $term ) {
                                            $values[] = $term->name;
                                        }
                                        $val = implode( ', ', $values );
                                    } else {
                                        $val = implode( ', ', $attribute->get_options() );
                                    }
                                    
                                    $bg_color = $bg_alt ? 'background-color: #faf9f6;' : 'background-color: #ffffff;';
                                    echo '<tr style="' . $bg_color . '">';
                                    echo '<td style="padding: 14px 18px; font-weight: 700; border-bottom: 1px solid var(--border-color, #e5e0d8); width: 220px; text-transform: uppercase; font-size: 0.78rem; letter-spacing: 0.05em; border-right: 1px solid var(--border-color, #e5e0d8);">' . esc_html( $name ) . '</td>';
                                    echo '<td style="padding: 14px 18px; border-bottom: 1px solid var(--border-color, #e5e0d8); color: var(--color-secondary, #555);">' . esc_html( $val ) . '</td>';
                                    echo '</tr>';
                                    $bg_alt = ! $bg_alt;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="section-divider-stacked"></div>
    <?php endif; ?>
    
    <!-- 3. Reviews Section -->
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
