<?php
/**
 * Temporary price updater bootstrap script.
 * Call this by visiting: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/run-price-update.php?key=great_wall_secret_998
 */

// Prevent directory traversal or direct load outside WP
$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if ( ! file_exists( $wp_load_path ) ) {
	die( 'WordPress load file not found at: ' . $wp_load_path );
}

require_once $wp_load_path;

// Secure access key
if ( ! isset( $_GET['key'] ) || $_GET['key'] !== 'great_wall_secret_998' ) {
	die( 'Unauthorized access.' );
}

// Matched prices dataset
$updates = array(
  array('wp_id' => 519, 'wp_title' => 'MODEL TG-8', 'excel_item' => 'TG-8', 'price' => 250, 'excel_row' => 34),
  array('wp_id' => 516, 'wp_title' => 'MODEL TGD-1', 'excel_item' => 'TGD-1', 'price' => 390, 'excel_row' => 30),
  array('wp_id' => 511, 'wp_title' => 'MODEL TGD-2', 'excel_item' => 'TGD-2', 'price' => 390, 'excel_row' => 31),
  array('wp_id' => 507, 'wp_title' => 'MODEL TGD-3', 'excel_item' => 'TGD-3', 'price' => 400, 'excel_row' => 32),
  array('wp_id' => 503, 'wp_title' => 'MODEL WG-4', 'excel_item' => 'WG-4', 'price' => 400, 'excel_row' => 38),
  array('wp_id' => 500, 'wp_title' => 'MODEL XG', 'excel_item' => 'XG', 'price' => 140, 'excel_row' => 39),
  array('wp_id' => 496, 'wp_title' => 'MODEL XG-3', 'excel_item' => 'XG-3', 'price' => 160, 'excel_row' => 40),
  array('wp_id' => 493, 'wp_title' => 'MODEL LK-3', 'excel_item' => 'LK-3', 'price' => 270, 'excel_row' => 15),
  array('wp_id' => 486, 'wp_title' => 'MODEL TGD-5', 'excel_item' => 'TGD-5', 'price' => 410, 'excel_row' => 33),
  array('wp_id' => 482, 'wp_title' => 'MODEL ST-2', 'excel_item' => 'ST-2', 'price' => 140, 'excel_row' => 35),
  array('wp_id' => 471, 'wp_title' => 'OC-10B-1', 'excel_item' => 'OC-10B', 'price' => 210, 'excel_row' => 140),
  array('wp_id' => 460, 'wp_title' => 'OC-11B-1', 'excel_item' => 'OC-11B', 'price' => 330, 'excel_row' => 142),
  array('wp_id' => 451, 'wp_title' => 'OC-23B-1', 'excel_item' => 'OC-23B', 'price' => 340, 'excel_row' => 144),
  array('wp_id' => 437, 'wp_title' => 'OC-23C-1', 'excel_item' => 'OC-23C', 'price' => 370, 'excel_row' => 145),
  array('wp_id' => 427, 'wp_title' => 'OC-45B-1', 'excel_item' => 'OC-45B', 'price' => 230, 'excel_row' => 161),
  array('wp_id' => 417, 'wp_title' => 'OC-47B-1', 'excel_item' => 'OC-47B', 'price' => 220, 'excel_row' => 164),
  array('wp_id' => 405, 'wp_title' => 'OC-50B Black-1', 'excel_item' => 'OC-50B(BLACK)', 'price' => 290, 'excel_row' => 168),
  array('wp_id' => 380, 'wp_title' => 'OC-50B Grey-1', 'excel_item' => 'OC-50B(GREY)', 'price' => 300, 'excel_row' => 170),
  array('wp_id' => 365, 'wp_title' => 'OC-50C Black-1', 'excel_item' => 'OC-50C(BLACK)', 'price' => 300, 'excel_row' => 169),
  array('wp_id' => 354, 'wp_title' => 'OC-50C Grey-1', 'excel_item' => 'OC-50C(GREY)', 'price' => 320, 'excel_row' => 171),
  array('wp_id' => 323, 'wp_title' => 'OC-70C Black-1', 'excel_item' => 'OC-70C(BLACK)', 'price' => 720, 'excel_row' => 178),
  array('wp_id' => 308, 'wp_title' => 'OC-70C Grey-1', 'excel_item' => 'OC-70C(Grey)', 'price' => 720, 'excel_row' => 179),
  array('wp_id' => 296, 'wp_title' => 'OC-77C', 'excel_item' => 'OC-77C', 'price' => 480, 'excel_row' => 187),
  array('wp_id' => 286, 'wp_title' => 'HK-3', 'excel_item' => 'HK-3', 'price' => 500, 'excel_row' => 8),
  array('wp_id' => 283, 'wp_title' => 'HK-2', 'excel_item' => 'HK-2', 'price' => 490, 'excel_row' => 7),
  array('wp_id' => 282, 'wp_title' => 'HPT-2', 'excel_item' => 'HPT-2', 'price' => 520, 'excel_row' => 9),
  array('wp_id' => 279, 'wp_title' => 'FB-1', 'excel_item' => 'FB-1', 'price' => 800, 'excel_row' => 12),
  array('wp_id' => 277, 'wp_title' => 'HK-1', 'excel_item' => 'HK-1', 'price' => 220, 'excel_row' => 13),
  array('wp_id' => 276, 'wp_title' => 'LK-3', 'excel_item' => 'LK-3', 'price' => 270, 'excel_row' => 15),
  array('wp_id' => 274, 'wp_title' => 'TG-1B', 'excel_item' => 'TG-1B', 'price' => 160, 'excel_row' => 22),
  array('wp_id' => 273, 'wp_title' => 'TG-2', 'excel_item' => 'TG-2', 'price' => 170, 'excel_row' => 24),
  array('wp_id' => 270, 'wp_title' => 'TG-1', 'excel_item' => 'TG-1', 'price' => 170, 'excel_row' => 21),
  array('wp_id' => 269, 'wp_title' => 'HTG-1', 'excel_item' => 'HTG-1', 'price' => 200, 'excel_row' => 23),
  array('wp_id' => 268, 'wp_title' => 'HTG-2', 'excel_item' => 'HTG-2', 'price' => 210, 'excel_row' => 26),
  array('wp_id' => 267, 'wp_title' => 'TG-2B', 'excel_item' => 'TG-2B', 'price' => 160, 'excel_row' => 25),
  array('wp_id' => 266, 'wp_title' => 'TG-3', 'excel_item' => 'TG-3', 'price' => 180, 'excel_row' => 27),
  array('wp_id' => 265, 'wp_title' => 'TG-4', 'excel_item' => 'TG-4', 'price' => 180, 'excel_row' => 28),
  array('wp_id' => 264, 'wp_title' => 'TG-6', 'excel_item' => 'TG-6', 'price' => 200, 'excel_row' => 29),
  array('wp_id' => 263, 'wp_title' => 'TG-8', 'excel_item' => 'TG-8', 'price' => 250, 'excel_row' => 34),
  array('wp_id' => 262, 'wp_title' => 'TGD-1', 'excel_item' => 'TGD-1', 'price' => 390, 'excel_row' => 30),
  array('wp_id' => 261, 'wp_title' => 'TGD-2', 'excel_item' => 'TGD-2', 'price' => 390, 'excel_row' => 31),
  array('wp_id' => 260, 'wp_title' => 'TGD-3', 'excel_item' => 'TGD-3', 'price' => 400, 'excel_row' => 32),
  array('wp_id' => 259, 'wp_title' => 'TGD-5', 'excel_item' => 'TGD-5', 'price' => 410, 'excel_row' => 33),
  array('wp_id' => 258, 'wp_title' => 'WG-2', 'excel_item' => 'WG-2', 'price' => 300, 'excel_row' => 36),
  array('wp_id' => 257, 'wp_title' => 'WG-4', 'excel_item' => 'WG-4', 'price' => 400, 'excel_row' => 38),
  array('wp_id' => 256, 'wp_title' => 'WG-3', 'excel_item' => 'WG-3', 'price' => 340, 'excel_row' => 37),
  array('wp_id' => 255, 'wp_title' => 'XG', 'excel_item' => 'XG', 'price' => 140, 'excel_row' => 39),
  array('wp_id' => 254, 'wp_title' => 'XG-3', 'excel_item' => 'XG-3', 'price' => 160, 'excel_row' => 40),
  array('wp_id' => 253, 'wp_title' => 'XG-4', 'excel_item' => 'XG', 'price' => 140, 'excel_row' => 39),
  array('wp_id' => 252, 'wp_title' => 'XG-5', 'excel_item' => 'XG', 'price' => 140, 'excel_row' => 39),
  array('wp_id' => 251, 'wp_title' => 'XG-6', 'excel_item' => 'XG', 'price' => 140, 'excel_row' => 39),
  array('wp_id' => 239, 'wp_title' => 'HW-1', 'excel_item' => 'HW-1', 'price' => 120, 'excel_row' => 65),
  array('wp_id' => 238, 'wp_title' => 'HW-2', 'excel_item' => 'HW-2', 'price' => 140, 'excel_row' => 66),
  array('wp_id' => 237, 'wp_title' => 'HW-3', 'excel_item' => 'HW-3', 'price' => 150, 'excel_row' => 67),
  array('wp_id' => 236, 'wp_title' => 'HW-4', 'excel_item' => 'HW-4', 'price' => 120, 'excel_row' => 68),
  array('wp_id' => 235, 'wp_title' => 'HW-6', 'excel_item' => 'HW-6', 'price' => 240, 'excel_row' => 70),
  array('wp_id' => 234, 'wp_title' => 'HW-7', 'excel_item' => 'HW-7', 'price' => 340, 'excel_row' => 71),
  array('wp_id' => 230, 'wp_title' => 'FT-10', 'excel_item' => 'FT-10', 'price' => 180, 'excel_row' => 90),
  array('wp_id' => 223, 'wp_title' => 'F-38', 'excel_item' => 'F-38', 'price' => 310, 'excel_row' => 3),
  array('wp_id' => 220, 'wp_title' => 'HW-5', 'excel_item' => 'HW-5', 'price' => 70, 'excel_row' => 69),
  array('wp_id' => 219, 'wp_title' => 'CN', 'excel_item' => 'CN-', 'price' => 40, 'excel_row' => 63),
  array('wp_id' => 217, 'wp_title' => 'NS', 'excel_item' => 'NS-', 'price' => 30, 'excel_row' => 64),
  array('wp_id' => 197, 'wp_title' => 'XG-3', 'excel_item' => 'XG-3', 'price' => 160, 'excel_row' => 40),
  array('wp_id' => 194, 'wp_title' => 'HK-3', 'excel_item' => 'HK-3', 'price' => 500, 'excel_row' => 8),
  array('wp_id' => 188, 'wp_title' => 'HK-2', 'excel_item' => 'HK-2', 'price' => 490, 'excel_row' => 7),
  array('wp_id' => 186, 'wp_title' => 'HPT-2', 'excel_item' => 'HPT-2', 'price' => 520, 'excel_row' => 9),
  array('wp_id' => 180, 'wp_title' => 'FB-1', 'excel_item' => 'FB-1', 'price' => 800, 'excel_row' => 12),
  array('wp_id' => 176, 'wp_title' => 'HK-1', 'excel_item' => 'HK-1', 'price' => 220, 'excel_row' => 13),
  array('wp_id' => 174, 'wp_title' => 'LK-3', 'excel_item' => 'LK-3', 'price' => 270, 'excel_row' => 15),
  array('wp_id' => 170, 'wp_title' => 'TG-1B', 'excel_item' => 'TG-1B', 'price' => 160, 'excel_row' => 22),
  array('wp_id' => 168, 'wp_title' => 'TG-2', 'excel_item' => 'TG-2', 'price' => 170, 'excel_row' => 24),
  array('wp_id' => 163, 'wp_title' => 'TG-1', 'excel_item' => 'TG-1', 'price' => 170, 'excel_row' => 21),
  array('wp_id' => 162, 'wp_title' => 'HTG-1', 'excel_item' => 'HTG-1', 'price' => 200, 'excel_row' => 23),
  array('wp_id' => 160, 'wp_title' => 'HTG-2', 'excel_item' => 'HTG-2', 'price' => 210, 'excel_row' => 26),
  array('wp_id' => 158, 'wp_title' => 'TG-2B', 'excel_item' => 'TG-2B', 'price' => 160, 'excel_row' => 25),
  array('wp_id' => 156, 'wp_title' => 'TG-3', 'excel_item' => 'TG-3', 'price' => 180, 'excel_row' => 27),
  array('wp_id' => 154, 'wp_title' => 'TG-4', 'excel_item' => 'TG-4', 'price' => 180, 'excel_row' => 28),
  array('wp_id' => 152, 'wp_title' => 'TG-6', 'excel_item' => 'TG-6', 'price' => 200, 'excel_row' => 29),
  array('wp_id' => 150, 'wp_title' => 'TG-8', 'excel_item' => 'TG-8', 'price' => 250, 'excel_row' => 34),
  array('wp_id' => 148, 'wp_title' => 'TGD-1', 'excel_item' => 'TGD-1', 'price' => 390, 'excel_row' => 30),
  array('wp_id' => 147, 'wp_title' => 'TGD-2', 'excel_item' => 'TGD-2', 'price' => 390, 'excel_row' => 31),
  array('wp_id' => 145, 'wp_title' => 'TGD-3', 'excel_item' => 'TGD-3', 'price' => 400, 'excel_row' => 32),
  array('wp_id' => 143, 'wp_title' => 'TGD-5', 'excel_item' => 'TGD-5', 'price' => 410, 'excel_row' => 33),
  array('wp_id' => 141, 'wp_title' => 'WG-2', 'excel_item' => 'WG-2', 'price' => 300, 'excel_row' => 36),
  array('wp_id' => 139, 'wp_title' => 'WG-4', 'excel_item' => 'WG-4', 'price' => 400, 'excel_row' => 38),
  array('wp_id' => 137, 'wp_title' => 'WG-3', 'excel_item' => 'WG-3', 'price' => 340, 'excel_row' => 37),
  array('wp_id' => 135, 'wp_title' => 'XG', 'excel_item' => 'XG', 'price' => 140, 'excel_row' => 39),
  array('wp_id' => 133, 'wp_title' => 'XG-3', 'excel_item' => 'XG-3', 'price' => 160, 'excel_row' => 40),
  array('wp_id' => 131, 'wp_title' => 'XG-4', 'excel_item' => 'XG', 'price' => 140, 'excel_row' => 39),
  array('wp_id' => 129, 'wp_title' => 'XG-5', 'excel_item' => 'XG', 'price' => 140, 'excel_row' => 39),
  array('wp_id' => 127, 'wp_title' => 'XG-6', 'excel_item' => 'XG', 'price' => 140, 'excel_row' => 39),
  array('wp_id' => 103, 'wp_title' => 'HW-1', 'excel_item' => 'HW-1', 'price' => 120, 'excel_row' => 65),
  array('wp_id' => 101, 'wp_title' => 'HW-2', 'excel_item' => 'HW-2', 'price' => 140, 'excel_row' => 66),
  array('wp_id' => 99, 'wp_title' => 'HW-3', 'excel_item' => 'HW-3', 'price' => 150, 'excel_row' => 67),
  array('wp_id' => 97, 'wp_title' => 'HW-4', 'excel_item' => 'HW-4', 'price' => 120, 'excel_row' => 68),
  array('wp_id' => 95, 'wp_title' => 'HW-6', 'excel_item' => 'HW-6', 'price' => 240, 'excel_row' => 70),
  array('wp_id' => 93, 'wp_title' => 'HW-7', 'excel_item' => 'HW-7', 'price' => 340, 'excel_row' => 71),
  array('wp_id' => 85, 'wp_title' => 'FT-10', 'excel_item' => 'FT-10', 'price' => 180, 'excel_row' => 90),
  array('wp_id' => 71, 'wp_title' => 'F-38', 'excel_item' => 'F-38', 'price' => 310, 'excel_row' => 3),
  array('wp_id' => 65, 'wp_title' => 'HW-5', 'excel_item' => 'HW-5', 'price' => 70, 'excel_row' => 69),
  array('wp_id' => 63, 'wp_title' => 'CN', 'excel_item' => 'CN-', 'price' => 40, 'excel_row' => 63),
  array('wp_id' => 59, 'wp_title' => 'NS', 'excel_item' => 'NS-', 'price' => 30, 'excel_row' => 64),
  array('wp_id' => 19, 'wp_title' => 'XG-3', 'excel_item' => 'XG-3', 'price' => 160, 'excel_row' => 40)
);

echo '<h1>WooCommerce Price Updater Tool</h1>';
echo '<p>Found ' . count( $updates ) . ' pending product updates...</p>';
echo '<hr>';

$success_count = 0;
$fail_count = 0;

foreach ( $updates as $update ) {
	$wp_id      = (int) $update['wp_id'];
	$title      = $update['wp_title'];
	$item_code  = $update['excel_item'];
	$price      = (float) $update['price'];
	
	if ( $price <= 0 ) {
		echo "<p style='color: orange;'>Skipping ID " . $wp_id . " (" . $title . "): Price is zero or invalid.</p>";
		continue;
	}
	
	$product = wc_get_product( $wp_id );
	if ( $product ) {
		// Update WooCommerce pricing meta fields
		$product->set_regular_price( $price );
		$product->set_price( $price );
		
		// Clear sale price to make sure the cash price is active
		$product->set_sale_price( '' );
		
		// Save the product changes
		$product->save();
		
		echo "<p style='color: green;'>Updated ID " . $wp_id . " (" . $title . ") -> Code: <strong>" . $item_code . "</strong>, Price: <strong>AED " . $price . "</strong></p>";
		$success_count++;
	} else {
		echo "<p style='color: red;'>Failed to load product ID " . $wp_id . " (" . $title . ").</p>";
		$fail_count++;
	}
}

echo '<hr>';
echo "<h2>Operation Complete!</h2>";
echo "<p>Successfully updated: <strong>" . $success_count . "</strong> products.</p>";
echo "<p>Failed: <strong>" . $fail_count . "</strong> products.</p>";
