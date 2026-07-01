<?php
/**
 * Product quantity input override
 */
defined( 'ABSPATH' ) || exit;

if ( $max_value && $min_value === $max_value ) {
	?>
	<div class="quantity hidden">
		<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
	</div>
	<?php
} else {
	/* translators: %s: Quantity. */
	$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'great-wall-theme' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'great-wall-theme' );
	?>
	<div class="quantity-wrapper">
		<span class="quantity-label"><?php esc_html_e( 'Quantity', 'great-wall-theme' ); ?></span>
		<div class="quantity">
			<?php do_action( 'woocommerce_before_quantity_input_field' ); ?>
			<button type="button" class="qty-btn minus" aria-label="Decrease quantity"><i class="ri-subtract-line"></i></button>
			<input
				type="number"
				id="<?php echo esc_attr( $input_id ); ?>"
				class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
				step="<?php echo esc_attr( $step ); ?>"
				min="<?php echo esc_attr( $min_value ); ?>"
				max="<?php echo esc_attr( $max_value ); ?>"
				name="<?php echo esc_attr( $input_name ); ?>"
				value="<?php echo esc_attr( $input_value ); ?>"
				title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'great-wall-theme' ); ?>"
				size="4"
				placeholder="<?php echo esc_attr( $placeholder ); ?>"
				inputmode="<?php echo esc_attr( $inputmode ); ?>"
				autocomplete="off" />
			<button type="button" class="qty-btn plus" aria-label="Increase quantity"><i class="ri-add-line"></i></button>
			<?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
		</div>
	</div>
	<?php
}
