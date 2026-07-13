<?php
/**
 * Product Description and Specs Database Updater Utility
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

$sku = 'OC-45B';
$product_id = wc_get_product_id_by_sku( $sku );

if ( ! $product_id ) {
    die( "Error: Product with SKU {$sku} not found." );
}

// 1. Prepare Description (HTML format)
$description = '<p>Elevate your training rooms, classrooms, and seminar spaces with the <strong>OC-45B Comfortable Study Desk Chair</strong>. Designed with students, trainees, and professionals in mind, this multi-functional chair integrates a space-saving writing tablet, offering a complete workstation solution without the need for large desks.</p>

<h3>Key Features:</h3>
<ul>
    <li><strong>Foldable Writing Tablet:</strong> The sturdy, textured black plastic writing tablet rotates smoothly and folds down vertically when not in use, offering flexible desk-free study and writing convenience.</li>
    <li><strong>Ergonomic Breathable Mesh Back:</strong> The high-tension mesh backrest promotes continuous airflow, keeping users cool, focused, and comfortable during long lectures or exams.</li>
    <li><strong>Padded Fabric Seat Cushion:</strong> Upholstered in premium, wear-resistant black fabric, the thick-cushioned seat provides excellent pressure relief and support.</li>
    <li><strong>Heavy-Duty Chrome Frame:</strong> Engineered with a durable chrome-plated steel 4-leg frame, providing exceptional structural stability, rust resistance, and a modern aesthetic.</li>
    <li><strong>Floor Protection:</strong> Protective non-slip plastic footpads on each leg prevent scratching and scuffing on hard floors while reducing noise.</li>
    <li><strong>Space-Saving Design:</strong> Lightweight and easy to move, making it perfect for dynamic classroom configurations, university halls, corporate training spaces, and home study rooms.</li>
</ul>';

// 2. Prepare Specifications (Raw colon-separated format)
$specs = 'Model: OC-45B
Type: Training & Seminar Chair
Backrest Material: High-Tension Breathable Mesh
Seat Material: Padded Cushion with Premium Fabric Cover
Frame Material: Chrome-Plated Steel
Leg Type: 4-Leg Stationary Frame
Armrests: Integrated T-Armrests
Writing Tablet: Rotatable & Foldable Textured Plastic Tablet
Footpads: Non-slip Floor Protectors
Color: Black & Chrome
Ideal For: Classrooms, Training Rooms, Seminars, Home Study';

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
