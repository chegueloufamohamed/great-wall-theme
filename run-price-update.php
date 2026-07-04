<?php
/**
 * Temporary WooCommerce catalog optimizer: Price, Dimensions, SKU, and descriptive Titles updater.
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

// Matched dataset
$updates = array(
  array('wp_id' => 519, 'wp_title' => 'MODEL TG-8', 'new_title' => 'Multi-Purpose Family Steel Cupboard', 'sku' => 'TG-8', 'price' => 250, 'length' => 185, 'width' => 50, 'height' => 60),
  array('wp_id' => 516, 'wp_title' => 'MODEL TGD-1', 'new_title' => 'Professional Steel Filing Cabinet', 'sku' => 'TGD-1', 'price' => 390, 'length' => 183, 'width' => 90, 'height' => 45),
  array('wp_id' => 511, 'wp_title' => 'MODEL TGD-2', 'new_title' => 'Home Steel Storage Cupboard', 'sku' => 'TGD-2', 'price' => 390, 'length' => 183, 'width' => 90, 'height' => 45),
  array('wp_id' => 507, 'wp_title' => 'MODEL TGD-3', 'new_title' => 'Professional Steel Filing Cabinet', 'sku' => 'TGD-3', 'price' => 400, 'length' => 183, 'width' => 90, 'height' => 45),
  array('wp_id' => 503, 'wp_title' => 'MODEL WG-4', 'new_title' => '4-Drawer Steel Storage Cabinet', 'sku' => 'WG-4', 'price' => 400, 'length' => 133, 'width' => 62, 'height' => 45),
  array('wp_id' => 500, 'wp_title' => 'MODEL XG', 'new_title' => 'Modern Wooden Shoe Organizer Rack', 'sku' => 'XG', 'price' => 140, 'length' => 90, 'width' => 60, 'height' => 40),
  array('wp_id' => 496, 'wp_title' => 'MODEL XG-3', 'new_title' => 'Wooden Shoe Storage Cabinet with Doors', 'sku' => 'XG-3', 'price' => 160, 'length' => 90, 'width' => 60, 'height' => 40),
  array('wp_id' => 493, 'wp_title' => 'MODEL LK-3', 'new_title' => 'Heavy Duty Single Metal Bed', 'sku' => 'LK-3', 'price' => 270, 'length' => 190, 'width' => 90, 'height' => 70),
  array('wp_id' => 486, 'wp_title' => 'MODEL TGD-5', 'new_title' => 'Premium Full Glass Storage Cabinet', 'sku' => 'TGD-5', 'price' => 410, 'length' => 183, 'width' => 90, 'height' => 45),
  array('wp_id' => 482, 'wp_title' => 'MODEL ST-2', 'new_title' => 'Modern Wooden Side Table', 'sku' => 'ST-2', 'price' => 140, 'length' => 50, 'width' => 45, 'height' => 45),
  array('wp_id' => 471, 'wp_title' => 'OC-10B-1', 'new_title' => 'Comfortable Ergonomic Office Chair', 'sku' => 'OC-10B', 'price' => 210, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 460, 'wp_title' => 'OC-11B-1', 'new_title' => 'Comfortable Ergonomic Office Chair', 'sku' => 'OC-11B', 'price' => 330, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 451, 'wp_title' => 'OC-23B-1', 'new_title' => 'Ergonomic Mid-Back Office Chair', 'sku' => 'OC-23B', 'price' => 340, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 437, 'wp_title' => 'OC-23C-1', 'new_title' => 'Comfortable Ergonomic Office Chair', 'sku' => 'OC-23C', 'price' => 370, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 427, 'wp_title' => 'OC-45B-1', 'new_title' => 'Comfortable Study Desk Chair', 'sku' => 'OC-45B', 'price' => 230, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 417, 'wp_title' => 'OC-47B-1', 'new_title' => 'Ergonomic Mid-Back Office Chair', 'sku' => 'OC-47B', 'price' => 220, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 405, 'wp_title' => 'OC-50B Black-1', 'new_title' => 'Ergonomic Mid-Back Office Chair', 'sku' => 'OC-50B(BLACK)', 'price' => 290, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 380, 'wp_title' => 'OC-50B Grey-1', 'new_title' => 'Ergonomic Mid-Back Office Chair', 'sku' => 'OC-50B(GREY)', 'price' => 300, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 365, 'wp_title' => 'OC-50C Black-1', 'new_title' => 'Ergonomic High-Back Executive Office Chair', 'sku' => 'OC-50C(BLACK)', 'price' => 300, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 354, 'wp_title' => 'OC-50C Grey-1', 'new_title' => 'Ergonomic High-Back Executive Office Chair', 'sku' => 'OC-50C(GREY)', 'price' => 320, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 323, 'wp_title' => 'OC-70C Black-1', 'new_title' => 'Luxury High-Back Leather Executive Chair', 'sku' => 'OC-70C(BLACK)', 'price' => 720, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 308, 'wp_title' => 'OC-70C Grey-1', 'new_title' => 'Luxury High-Back Leather Executive Chair', 'sku' => 'OC-70C(Grey)', 'price' => 720, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 296, 'wp_title' => 'OC-77C', 'new_title' => 'Premium Pure Leather High-Back Executive Chair', 'sku' => 'OC-77C', 'price' => 480, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 286, 'wp_title' => 'HK-3', 'new_title' => 'Heavy Duty Metal Bunk Bed', 'sku' => 'HK-3', 'price' => 500, 'length' => 190, 'width' => 90, 'height' => 170),
  array('wp_id' => 283, 'wp_title' => 'HK-2', 'new_title' => 'Heavy Duty Metal Bunk Bed', 'sku' => 'HK-2', 'price' => 490, 'length' => 190, 'width' => 90, 'height' => 170),
  array('wp_id' => 282, 'wp_title' => 'HPT-2', 'new_title' => 'Heavy Duty Metal Bunk Bed', 'sku' => 'HPT-2', 'price' => 520, 'length' => 190, 'width' => 90, 'height' => 170),
  array('wp_id' => 279, 'wp_title' => 'FB-1', 'new_title' => 'Metal Family Bunk Bed', 'sku' => 'FB-1', 'price' => 800, 'length' => 190, 'width' => 120, 'height' => 170),
  array('wp_id' => 277, 'wp_title' => 'HK-1', 'new_title' => 'Lightweight Single Metal Bed', 'sku' => 'HK-1', 'price' => 220, 'length' => 190, 'width' => 90, 'height' => 70),
  array('wp_id' => 276, 'wp_title' => 'LK-3', 'new_title' => 'Heavy Duty Single Metal Bed', 'sku' => 'LK-3', 'price' => 270, 'length' => 190, 'width' => 90, 'height' => 70),
  array('wp_id' => 274, 'wp_title' => 'TG-1B', 'new_title' => 'Single Door Industrial Steel Locker', 'sku' => 'TG-1B', 'price' => 160, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 273, 'wp_title' => 'TG-2', 'new_title' => '2-Door Industrial Steel Locker', 'sku' => 'TG-2', 'price' => 170, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 270, 'wp_title' => 'TG-1', 'new_title' => 'Single Door Industrial Steel Locker', 'sku' => 'TG-1', 'price' => 170, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 269, 'wp_title' => 'HTG-1', 'new_title' => 'Single Door Industrial Steel Locker', 'sku' => 'HTG-1', 'price' => 200, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 268, 'wp_title' => 'HTG-2', 'new_title' => '2-Door Industrial Steel Locker', 'sku' => 'HTG-2', 'price' => 210, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 267, 'wp_title' => 'TG-2B', 'new_title' => '2-Door Industrial Steel Locker', 'sku' => 'TG-2B', 'price' => 160, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 266, 'wp_title' => 'TG-3', 'new_title' => '3-Door Industrial Steel Locker', 'sku' => 'TG-3', 'price' => 180, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 265, 'wp_title' => 'TG-4', 'new_title' => '4-Door Industrial Steel Locker', 'sku' => 'TG-4', 'price' => 180, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 264, 'wp_title' => 'TG-6', 'new_title' => '6-Door Industrial Steel Locker', 'sku' => 'TG-6', 'price' => 200, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 263, 'wp_title' => 'TG-8', 'new_title' => 'Multi-Purpose Family Steel Cupboard', 'sku' => 'TG-8', 'price' => 250, 'length' => 185, 'width' => 50, 'height' => 60),
  array('wp_id' => 262, 'wp_title' => 'TGD-1', 'new_title' => 'Professional Steel Filing Cabinet', 'sku' => 'TGD-1', 'price' => 390, 'length' => 183, 'width' => 90, 'height' => 45),
  array('wp_id' => 261, 'wp_title' => 'TGD-2', 'new_title' => 'Home Steel Storage Cupboard', 'sku' => 'TGD-2', 'price' => 390, 'length' => 183, 'width' => 90, 'height' => 45),
  array('wp_id' => 260, 'wp_title' => 'TGD-3', 'new_title' => 'Professional Steel Filing Cabinet', 'sku' => 'TGD-3', 'price' => 400, 'length' => 183, 'width' => 90, 'height' => 45),
  array('wp_id' => 259, 'wp_title' => 'TGD-5', 'new_title' => 'Premium Full Glass Storage Cabinet', 'sku' => 'TGD-5', 'price' => 410, 'length' => 183, 'width' => 90, 'height' => 45),
  array('wp_id' => 258, 'wp_title' => 'WG-2', 'new_title' => '2-Drawer Steel Mobile Pedestal Cabinet', 'sku' => 'WG-2', 'price' => 300, 'length' => 73, 'width' => 62, 'height' => 45),
  array('wp_id' => 257, 'wp_title' => 'WG-4', 'new_title' => '4-Drawer Steel Storage Cabinet', 'sku' => 'WG-4', 'price' => 400, 'length' => 133, 'width' => 62, 'height' => 45),
  array('wp_id' => 256, 'wp_title' => 'WG-3', 'new_title' => '3-Drawer Steel Storage Cabinet', 'sku' => 'WG-3', 'price' => 340, 'length' => 103, 'width' => 62, 'height' => 45),
  array('wp_id' => 255, 'wp_title' => 'XG', 'new_title' => 'Modern Wooden Shoe Organizer Rack', 'sku' => 'XG', 'price' => 140, 'length' => 90, 'width' => 60, 'height' => 40),
  array('wp_id' => 254, 'wp_title' => 'XG-3', 'new_title' => 'Wooden Shoe Storage Cabinet with Doors', 'sku' => 'XG-3', 'price' => 160, 'length' => 90, 'width' => 60, 'height' => 40),
  array('wp_id' => 253, 'wp_title' => 'XG-4', 'new_title' => 'Modern Wooden Shoe Organizer Rack', 'sku' => 'XG', 'price' => 140, 'length' => 90, 'width' => 60, 'height' => 40),
  array('wp_id' => 252, 'wp_title' => 'XG-5', 'new_title' => 'Modern Wooden Shoe Organizer Rack', 'sku' => 'XG', 'price' => 140, 'length' => 90, 'width' => 60, 'height' => 40),
  array('wp_id' => 251, 'wp_title' => 'XG-6', 'new_title' => 'Modern Wooden Shoe Organizer Rack', 'sku' => 'XG', 'price' => 140, 'length' => 90, 'width' => 60, 'height' => 40),
  array('wp_id' => 239, 'wp_title' => 'HW-1', 'new_title' => 'Durable Plastic Folding Table', 'sku' => 'HW-1', 'price' => 120, 'length' => 120, 'width' => 60, 'height' => 75),
  array('wp_id' => 238, 'wp_title' => 'HW-2', 'new_title' => 'Durable Plastic Folding Table', 'sku' => 'HW-2', 'price' => 140, 'length' => 152, 'width' => 70, 'height' => 75),
  array('wp_id' => 237, 'wp_title' => 'HW-3', 'new_title' => 'Durable Plastic Folding Table', 'sku' => 'HW-3', 'price' => 150, 'length' => 180, 'width' => 75, 'height' => 75),
  array('wp_id' => 236, 'wp_title' => 'HW-4', 'new_title' => 'Durable Plastic Folding Table', 'sku' => 'HW-4', 'price' => 120, 'length' => 80, 'width' => 80, 'height' => 75),
  array('wp_id' => 235, 'wp_title' => 'HW-6', 'new_title' => 'Durable Plastic Folding Table', 'sku' => 'HW-6', 'price' => 240, 'length' => 120, 'width' => 75, 'height' => null),
  array('wp_id' => 234, 'wp_title' => 'HW-7', 'new_title' => 'Durable Plastic Folding Table', 'sku' => 'HW-7', 'price' => 340, 'length' => 150, 'width' => 75, 'height' => null),
  array('wp_id' => 230, 'wp_title' => 'FT-10', 'new_title' => 'Portable Folding Utility Table', 'sku' => 'FT-10', 'price' => 180, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 223, 'wp_title' => 'F-38', 'new_title' => 'Premium Guest Folding Bed', 'sku' => 'F-38', 'price' => 310, 'length' => 190, 'width' => 90, 'height' => null),
  array('wp_id' => 220, 'wp_title' => 'HW-5', 'new_title' => 'Plastic Chair', 'sku' => 'HW-5', 'price' => 70, 'length' => 57, 'width' => 46, 'height' => 83),
  array('wp_id' => 219, 'wp_title' => 'CN', 'new_title' => 'Portable Folding Chair', 'sku' => 'CN-', 'price' => 40, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 217, 'wp_title' => 'NS', 'new_title' => 'Portable Folding Stool', 'sku' => 'NS-', 'price' => 30, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 197, 'wp_title' => 'XG-3', 'new_title' => 'Wooden Shoe Storage Cabinet with Doors', 'sku' => 'XG-3', 'price' => 160, 'length' => 90, 'width' => 60, 'height' => 40),
  array('wp_id' => 194, 'wp_title' => 'HK-3', 'new_title' => 'Heavy Duty Metal Bunk Bed', 'sku' => 'HK-3', 'price' => 500, 'length' => 190, 'width' => 90, 'height' => 170),
  array('wp_id' => 188, 'wp_title' => 'HK-2', 'new_title' => 'Heavy Duty Metal Bunk Bed', 'sku' => 'HK-2', 'price' => 490, 'length' => 190, 'width' => 90, 'height' => 170),
  array('wp_id' => 186, 'wp_title' => 'HPT-2', 'new_title' => 'Heavy Duty Metal Bunk Bed', 'sku' => 'HPT-2', 'price' => 520, 'length' => 190, 'width' => 90, 'height' => 170),
  array('wp_id' => 180, 'wp_title' => 'FB-1', 'new_title' => 'Metal Family Bunk Bed', 'sku' => 'FB-1', 'price' => 800, 'length' => 190, 'width' => 120, 'height' => 170),
  array('wp_id' => 176, 'wp_title' => 'HK-1', 'new_title' => 'Lightweight Single Metal Bed', 'sku' => 'HK-1', 'price' => 220, 'length' => 190, 'width' => 90, 'height' => 70),
  array('wp_id' => 174, 'wp_title' => 'LK-3', 'new_title' => 'Heavy Duty Single Metal Bed', 'sku' => 'LK-3', 'price' => 270, 'length' => 190, 'width' => 90, 'height' => 70),
  array('wp_id' => 170, 'wp_title' => 'TG-1B', 'new_title' => 'Single Door Industrial Steel Locker', 'sku' => 'TG-1B', 'price' => 160, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 168, 'wp_title' => 'TG-2', 'new_title' => '2-Door Industrial Steel Locker', 'sku' => 'TG-2', 'price' => 170, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 163, 'wp_title' => 'TG-1', 'new_title' => 'Single Door Industrial Steel Locker', 'sku' => 'TG-1', 'price' => 170, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 162, 'wp_title' => 'HTG-1', 'new_title' => 'Single Door Industrial Steel Locker', 'sku' => 'HTG-1', 'price' => 200, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 160, 'wp_title' => 'HTG-2', 'new_title' => '2-Door Industrial Steel Locker', 'sku' => 'HTG-2', 'price' => 210, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 158, 'wp_title' => 'TG-2B', 'new_title' => '2-Door Industrial Steel Locker', 'sku' => 'TG-2B', 'price' => 160, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 156, 'wp_title' => 'TG-3', 'new_title' => '3-Door Industrial Steel Locker', 'sku' => 'TG-3', 'price' => 180, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 154, 'wp_title' => 'TG-4', 'new_title' => '4-Door Industrial Steel Locker', 'sku' => 'TG-4', 'price' => 180, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 152, 'wp_title' => 'TG-6', 'new_title' => '6-Door Industrial Steel Locker', 'sku' => 'TG-6', 'price' => 200, 'length' => 183, 'width' => 45, 'height' => 40),
  array('wp_id' => 150, 'wp_title' => 'TG-8', 'new_title' => 'Multi-Purpose Family Steel Cupboard', 'sku' => 'TG-8', 'price' => 250, 'length' => 185, 'width' => 50, 'height' => 60),
  array('wp_id' => 148, 'wp_title' => 'TGD-1', 'new_title' => 'Professional Steel Filing Cabinet', 'sku' => 'TGD-1', 'price' => 390, 'length' => 183, 'width' => 90, 'height' => 45),
  array('wp_id' => 147, 'wp_title' => 'TGD-2', 'new_title' => 'Home Steel Storage Cupboard', 'sku' => 'TGD-2', 'price' => 390, 'length' => 183, 'width' => 90, 'height' => 45),
  array('wp_id' => 145, 'wp_title' => 'TGD-3', 'new_title' => 'Professional Steel Filing Cabinet', 'sku' => 'TGD-3', 'price' => 400, 'length' => 183, 'width' => 90, 'height' => 45),
  array('wp_id' => 143, 'wp_title' => 'TGD-5', 'new_title' => 'Premium Full Glass Storage Cabinet', 'sku' => 'TGD-5', 'price' => 410, 'length' => 183, 'width' => 90, 'height' => 45),
  array('wp_id' => 141, 'wp_title' => 'WG-2', 'new_title' => '2-Drawer Steel Mobile Pedestal Cabinet', 'sku' => 'WG-2', 'price' => 300, 'length' => 73, 'width' => 62, 'height' => 45),
  array('wp_id' => 139, 'wp_title' => 'WG-4', 'new_title' => '4-Drawer Steel Storage Cabinet', 'sku' => 'WG-4', 'price' => 400, 'length' => 133, 'width' => 62, 'height' => 45),
  array('wp_id' => 137, 'wp_title' => 'WG-3', 'new_title' => '3-Drawer Steel Storage Cabinet', 'sku' => 'WG-3', 'price' => 340, 'length' => 103, 'width' => 62, 'height' => 45),
  array('wp_id' => 135, 'wp_title' => 'XG', 'new_title' => 'Modern Wooden Shoe Organizer Rack', 'sku' => 'XG', 'price' => 140, 'length' => 90, 'width' => 60, 'height' => 40),
  array('wp_id' => 133, 'wp_title' => 'XG-3', 'new_title' => 'Wooden Shoe Storage Cabinet with Doors', 'sku' => 'XG-3', 'price' => 160, 'length' => 90, 'width' => 60, 'height' => 40),
  array('wp_id' => 131, 'wp_title' => 'XG-4', 'new_title' => 'Modern Wooden Shoe Organizer Rack', 'sku' => 'XG', 'price' => 140, 'length' => 90, 'width' => 60, 'height' => 40),
  array('wp_id' => 129, 'wp_title' => 'XG-5', 'new_title' => 'Modern Wooden Shoe Organizer Rack', 'sku' => 'XG', 'price' => 140, 'length' => 90, 'width' => 60, 'height' => 40),
  array('wp_id' => 127, 'wp_title' => 'XG-6', 'new_title' => 'Modern Wooden Shoe Organizer Rack', 'sku' => 'XG', 'price' => 140, 'length' => 90, 'width' => 60, 'height' => 40),
  array('wp_id' => 103, 'wp_title' => 'HW-1', 'new_title' => 'Durable Plastic Folding Table', 'sku' => 'HW-1', 'price' => 120, 'length' => 120, 'width' => 60, 'height' => 75),
  array('wp_id' => 101, 'wp_title' => 'HW-2', 'new_title' => 'Durable Plastic Folding Table', 'sku' => 'HW-2', 'price' => 140, 'length' => 152, 'width' => 70, 'height' => 75),
  array('wp_id' => 99, 'wp_title' => 'HW-3', 'new_title' => 'Durable Plastic Folding Table', 'sku' => 'HW-3', 'price' => 150, 'length' => 180, 'width' => 75, 'height' => 75),
  array('wp_id' => 97, 'wp_title' => 'HW-4', 'new_title' => 'Durable Plastic Folding Table', 'sku' => 'HW-4', 'price' => 120, 'length' => 80, 'width' => 80, 'height' => 75),
  array('wp_id' => 95, 'wp_title' => 'HW-6', 'new_title' => 'Durable Plastic Folding Table', 'sku' => 'HW-6', 'price' => 240, 'length' => 120, 'width' => 75, 'height' => null),
  array('wp_id' => 93, 'wp_title' => 'HW-7', 'new_title' => 'Durable Plastic Folding Table', 'sku' => 'HW-7', 'price' => 340, 'length' => 150, 'width' => 75, 'height' => null),
  array('wp_id' => 85, 'wp_title' => 'FT-10', 'new_title' => 'Portable Folding Utility Table', 'sku' => 'FT-10', 'price' => 180, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 71, 'wp_title' => 'F-38', 'new_title' => 'Premium Guest Folding Bed', 'sku' => 'F-38', 'price' => 310, 'length' => 190, 'width' => 90, 'height' => null),
  array('wp_id' => 65, 'wp_title' => 'HW-5', 'new_title' => 'Plastic Chair', 'sku' => 'HW-5', 'price' => 70, 'length' => 57, 'width' => 46, 'height' => 83),
  array('wp_id' => 63, 'wp_title' => 'CN', 'new_title' => 'Portable Folding Chair', 'sku' => 'CN-', 'price' => 40, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 59, 'wp_title' => 'NS', 'new_title' => 'Portable Folding Stool', 'sku' => 'NS-', 'price' => 30, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 19, 'wp_title' => 'XG-3', 'new_title' => 'Wooden Shoe Storage Cabinet with Doors', 'sku' => 'XG-3', 'price' => 160, 'length' => 90, 'width' => 60, 'height' => 40)
);

echo '<h1>WooCommerce SKU & descriptive Title Catalog Optimizer Tool</h1>';
echo '<p>Found ' . count( $updates ) . ' pending catalog updates...</p>';
echo '<hr>';

$success_count = 0;
$fail_count = 0;

foreach ( $updates as $update ) {
	$wp_id      = (int) $update['wp_id'];
	$title      = $update['wp_title'];
	$new_title  = $update['new_title'];
	$sku        = $update['sku'];
	$price      = (float) $update['price'];
	$length     = $update['length'];
	$width      = $update['width'];
	$height     = $update['height'];
	
	if ( $price <= 0 ) {
		echo "<p style='color: orange;'>Skipping ID " . $wp_id . " (" . $title . "): Price is zero or invalid.</p>";
		continue;
	}
	
	$product = wc_get_product( $wp_id );
	if ( $product ) {
		// 1. Update WooCommerce pricing meta fields
		$product->set_regular_price( $price );
		$product->set_price( $price );
		$product->set_sale_price( '' ); // Clear sale pricing
		
		// 2. Set descriptive title / name
		$product->set_name( $new_title );
		
		// 3. Set unique item code as SKU
		$product->set_sku( $sku );
		
		// 4. Update WooCommerce dimension meta fields if present
		$dims_info = array();
		if ( null !== $length ) {
			$product->set_length( $length );
			$dims_info[] = "Length: " . $length . "cm";
		}
		if ( null !== $width ) {
			$product->set_width( $width );
			$dims_info[] = "Width: " . $width . "cm";
		}
		if ( null !== $height ) {
			$product->set_height( $height );
			$dims_info[] = "Height: " . $height . "cm";
		}
		
		// Save the product changes
		$product->save();
		
		$dims_str = ! empty( $dims_info ) ? " [Dimensions: " . implode( ", ", $dims_info ) . "]" : "";
		echo "<p style='color: green;'>Updated ID " . $wp_id . " -> SKU: <strong>" . $sku . "</strong>, Name: <strong>" . $new_title . "</strong>, Price: <strong>AED " . $price . "</strong>" . $dims_str . "</p>";
		$success_count++;
	} else {
		echo "<p style='color: red;'>Failed to load product ID " . $wp_id . " (" . $title . ").</p>";
		$fail_count++;
	}
}

echo '<hr>';
echo "<h2>Operation Complete!</h2>";
echo "<p>Successfully optimized: <strong>" . $success_count . "</strong> products.</p>";
echo "<p>Failed: <strong>" . $fail_count . "</strong> products.</p>";
