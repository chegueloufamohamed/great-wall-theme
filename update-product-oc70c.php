<?php
/**
 * Product Description and Specs Database Updater Utility for OC-70C(BLACK)
 */

// Secure with a simple token check
if ( ! isset( $_GET['token'] ) || $_GET['token'] !== 'greatwall_secret_9988' ) {
    header( 'HTTP/1.1 403 Forbidden' );
    die( 'Access Denied.' );
}

// Bootstrap WordPress
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';

if ( ! function_exists( 'wc_get_product_id_by_sku' ) ) {
    die( "Error: WooCommerce is not loaded." );
}

$sku = 'OC-70C(BLACK)';
$product_id = wc_get_product_id_by_sku( $sku );

if ( ! $product_id ) {
    die( "Error: Product with SKU {$sku} not found." );
}

// 1. Prepare Description (HTML format)
$description = '<p>Command your workspace with the ultimate statement of comfort and prestige—the <strong>OC-70C Luxury High-Back Leather Executive Chair</strong>. Designed for directors, executives, and long working hours, this premium chair combines executive aesthetics with ergonomic support and a retractable footrest for unmatched relaxation.</p>

<h3>Key Features:</h3>
<ul>
    <li><strong>Double-Padded Segmented Design:</strong> Thickly padded headrest, backrest, and seat cushion layers conform to your body, offering cloud-like comfort and posture support.</li>
    <li><strong>Retractable Footrest:</strong> Easily pull out the padded under-seat footrest to recline and rest during breaks, transforming your office chair into a personal lounger.</li>
    <li><strong>Ergonomic Chrome Armrests:</strong> Contoured chrome armrests with padded black leather inserts provide comfortable resting support for your arms and shoulders.</li>
    <li><strong>Smooth Reclining & Height Adjustment:</strong> Fine-tune your seating with pneumatic height adjustment and a reclining tilt lock mechanism that lets you recline comfortably up to 135 degrees.</li>
    <li><strong>Polished Chrome 5-Star Base:</strong> The heavy-duty steel base features a brilliant chrome finish, supporting up to 150kg while ensuring stable 360-degree rotation.</li>
    <li><strong>Hooded Easy-Glide Casters:</strong> Dual-wheel casters slide smoothly on both carpeted and hard floors, allowing quiet and effortless mobility.</li>
</ul>';

// 2. Prepare Specifications (Raw colon-separated format)
$specs = 'Model: OC-70C(BLACK)
Type: High-Back Executive Chair
Upholstery Material: Premium PU Leather
Cushioning: Double-Layer High-Density Foam
Armrests: Ergonomic Chrome Armrests with Leather Padding
Base: Heavy-Duty 5-Star Chrome Steel Base
Castors: 360° Swivel Hooded Dual-Wheel Casters
Recline: Tilt & Recline Lock Mechanism (up to 135°)
Footrest: Padded Retractable/Pull-Out Footrest
Max Load Capacity: 150 kg
Color: Black Leather & Chrome
Ideal For: Executive Offices, Boardrooms, Long-Hour Study';

// 3. Update the Product Post
$update_post = array(
    'ID'           => $product_id,
    'post_content' => $description,
);

$post_updated = wp_update_post( $update_post, true );

if ( is_wp_error( $post_updated ) ) {
    die( "Error updating product description: " . $post_updated->get_error_message() );
}

// 4. Update the Specifications Meta
update_post_meta( $product_id, '_product_specs', $specs );

echo "SUCCESS: Product SKU {$sku} (ID {$product_id}) description and specifications updated successfully!";
