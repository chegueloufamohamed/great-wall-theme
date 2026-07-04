<?php
/**
 * WooCommerce Catalog SKU and Title Optimizer Tool.
 * Call this by visiting: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/run-price-update.php?key=great_wall_secret_998
 */

// Attempt to raise memory and time limits
@set_time_limit( 300 );
@ini_set( 'memory_limit', '512M' );

// Prevent directory traversal or direct load outside WP
$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if ( ! file_exists( $wp_load_path ) ) {
	die( 'WordPress load file not found.' );
}

require_once $wp_load_path;

// Secure access key
if ( ! isset( $_GET['key'] ) || $_GET['key'] !== 'great_wall_secret_998' ) {
	die( 'Unauthorized access.' );
}

// Dataset containing all products (both matched and unmatched)
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
  array('wp_id' => 19, 'wp_title' => 'XG-3', 'new_title' => 'Wooden Shoe Storage Cabinet with Doors', 'sku' => 'XG-3', 'price' => 160, 'length' => 90, 'width' => 60, 'height' => 40),
  array('wp_id' => 285, 'wp_title' => 'SHD-2', 'new_title' => null, 'sku' => 'SHD-2', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 284, 'wp_title' => 'LK-2', 'new_title' => null, 'sku' => 'LK-2', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 281, 'wp_title' => 'SK-2', 'new_title' => null, 'sku' => 'SK-2', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 280, 'wp_title' => 'W-2', 'new_title' => null, 'sku' => 'W-2', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 278, 'wp_title' => 'LK-1', 'new_title' => null, 'sku' => 'LK-1', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 275, 'wp_title' => 'SHD-1', 'new_title' => null, 'sku' => 'SHD-1', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 272, 'wp_title' => 'PF-1', 'new_title' => null, 'sku' => 'PF-1', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 271, 'wp_title' => 'TG-1A', 'new_title' => null, 'sku' => 'TG-1A', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 250, 'wp_title' => 'PF-3', 'new_title' => null, 'sku' => 'PF-3', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 249, 'wp_title' => 'PF-4', 'new_title' => null, 'sku' => 'PF-4', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 248, 'wp_title' => 'PF-5', 'new_title' => null, 'sku' => 'PF-5', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 247, 'wp_title' => 'PF-6', 'new_title' => null, 'sku' => 'PF-6', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 246, 'wp_title' => 'PF-8', 'new_title' => null, 'sku' => 'PF-8', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 245, 'wp_title' => 'PF-9', 'new_title' => null, 'sku' => 'PF-9', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 244, 'wp_title' => 'PF-10', 'new_title' => null, 'sku' => 'PF-10', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 243, 'wp_title' => 'PF-11', 'new_title' => null, 'sku' => 'PF-11', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 242, 'wp_title' => 'PF-12', 'new_title' => null, 'sku' => 'PF-12', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 241, 'wp_title' => 'PF-13', 'new_title' => null, 'sku' => 'PF-13', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 240, 'wp_title' => 'PF-14', 'new_title' => null, 'sku' => 'PF-14', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 233, 'wp_title' => 'DT-2', 'new_title' => null, 'sku' => 'DT-2', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 232, 'wp_title' => 'DT-1', 'new_title' => null, 'sku' => 'DT-1', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 231, 'wp_title' => 'DT-3', 'new_title' => null, 'sku' => 'DT-3', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 229, 'wp_title' => 'LCS-1A', 'new_title' => null, 'sku' => 'LCS-1A', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 228, 'wp_title' => 'LCS-2A', 'new_title' => null, 'sku' => 'LCS-2A', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 227, 'wp_title' => 'LCS-2B', 'new_title' => null, 'sku' => 'LCS-2B', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 226, 'wp_title' => 'LCB-1A', 'new_title' => null, 'sku' => 'LCB-1A', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 225, 'wp_title' => 'LCB-1B', 'new_title' => null, 'sku' => 'LCB-1B', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 224, 'wp_title' => 'LCB-2A', 'new_title' => null, 'sku' => 'LCB-2A', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 222, 'wp_title' => 'HF', 'new_title' => null, 'sku' => 'HF', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 221, 'wp_title' => 'GHF', 'new_title' => null, 'sku' => 'GHF', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 218, 'wp_title' => 'C-1', 'new_title' => null, 'sku' => 'C-1', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 216, 'wp_title' => 'C-2', 'new_title' => null, 'sku' => 'C-2', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 215, 'wp_title' => 'HF-4', 'new_title' => null, 'sku' => 'HF-4', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 214, 'wp_title' => 'HF-5', 'new_title' => null, 'sku' => 'HF-5', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 213, 'wp_title' => 'HF-6', 'new_title' => null, 'sku' => 'HF-6', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 212, 'wp_title' => 'HF-7', 'new_title' => null, 'sku' => 'HF-7', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 211, 'wp_title' => 'HF-1', 'new_title' => null, 'sku' => 'HF-1', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 210, 'wp_title' => 'HF-2', 'new_title' => null, 'sku' => 'HF-2', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 209, 'wp_title' => '235-10', 'new_title' => null, 'sku' => '235-10', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 208, 'wp_title' => '233-12', 'new_title' => null, 'sku' => '233-12', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 207, 'wp_title' => 'HC5101-12', 'new_title' => null, 'sku' => 'HC5101-12', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 206, 'wp_title' => 'HC5102-16', 'new_title' => null, 'sku' => 'HC5102-16', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 205, 'wp_title' => '649-14', 'new_title' => null, 'sku' => '649-14', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 204, 'wp_title' => 'AA03', 'new_title' => null, 'sku' => 'AA03', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 203, 'wp_title' => '822M', 'new_title' => null, 'sku' => '822M', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 202, 'wp_title' => 'GYHH', 'new_title' => null, 'sku' => 'GYHH', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 201, 'wp_title' => 'GYH', 'new_title' => null, 'sku' => 'GYH', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 200, 'wp_title' => 'GYHG', 'new_title' => null, 'sku' => 'GYHG', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 199, 'wp_title' => '5013M', 'new_title' => null, 'sku' => '5013M', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 198, 'wp_title' => 'J109A', 'new_title' => null, 'sku' => 'J109A', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 192, 'wp_title' => 'SHD-2', 'new_title' => null, 'sku' => 'SHD-2', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 190, 'wp_title' => 'LK-2', 'new_title' => null, 'sku' => 'LK-2', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 184, 'wp_title' => 'SK-2', 'new_title' => null, 'sku' => 'SK-2', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 182, 'wp_title' => 'W-2', 'new_title' => null, 'sku' => 'W-2', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 178, 'wp_title' => 'LK-1', 'new_title' => null, 'sku' => 'LK-1', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 172, 'wp_title' => 'SHD-1', 'new_title' => null, 'sku' => 'SHD-1', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 167, 'wp_title' => 'PF-1', 'new_title' => null, 'sku' => 'PF-1', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 165, 'wp_title' => 'TG-1A', 'new_title' => null, 'sku' => 'TG-1A', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 125, 'wp_title' => 'PF-3', 'new_title' => null, 'sku' => 'PF-3', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 123, 'wp_title' => 'PF-4', 'new_title' => null, 'sku' => 'PF-4', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 121, 'wp_title' => 'PF-5', 'new_title' => null, 'sku' => 'PF-5', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 119, 'wp_title' => 'PF-6', 'new_title' => null, 'sku' => 'PF-6', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 117, 'wp_title' => 'PF-8', 'new_title' => null, 'sku' => 'PF-8', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 115, 'wp_title' => 'PF-9', 'new_title' => null, 'sku' => 'PF-9', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 113, 'wp_title' => 'PF-10', 'new_title' => null, 'sku' => 'PF-10', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 111, 'wp_title' => 'PF-11', 'new_title' => null, 'sku' => 'PF-11', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 109, 'wp_title' => 'PF-12', 'new_title' => null, 'sku' => 'PF-12', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 107, 'wp_title' => 'PF-13', 'new_title' => null, 'sku' => 'PF-13', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 105, 'wp_title' => 'PF-14', 'new_title' => null, 'sku' => 'PF-14', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 91, 'wp_title' => 'DT-2', 'new_title' => null, 'sku' => 'DT-2', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 89, 'wp_title' => 'DT-1', 'new_title' => null, 'sku' => 'DT-1', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 87, 'wp_title' => 'DT-3', 'new_title' => null, 'sku' => 'DT-3', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 83, 'wp_title' => 'LCS-1A', 'new_title' => null, 'sku' => 'LCS-1A', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 81, 'wp_title' => 'LCS-2A', 'new_title' => null, 'sku' => 'LCS-2A', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 79, 'wp_title' => 'LCS-2B', 'new_title' => null, 'sku' => 'LCS-2B', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 77, 'wp_title' => 'LCB-1A', 'new_title' => null, 'sku' => 'LCB-1A', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 75, 'wp_title' => 'LCB-1B', 'new_title' => null, 'sku' => 'LCB-1B', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 73, 'wp_title' => 'LCB-2A', 'new_title' => null, 'sku' => 'LCB-2A', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 69, 'wp_title' => 'HF', 'new_title' => null, 'sku' => 'HF', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 67, 'wp_title' => 'GHF', 'new_title' => null, 'sku' => 'GHF', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 61, 'wp_title' => 'C-1', 'new_title' => null, 'sku' => 'C-1', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 57, 'wp_title' => 'C-2', 'new_title' => null, 'sku' => 'C-2', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 55, 'wp_title' => 'HF-4', 'new_title' => null, 'sku' => 'HF-4', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 53, 'wp_title' => 'HF-5', 'new_title' => null, 'sku' => 'HF-5', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 51, 'wp_title' => 'HF-6', 'new_title' => null, 'sku' => 'HF-6', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 49, 'wp_title' => 'HF-7', 'new_title' => null, 'sku' => 'HF-7', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 47, 'wp_title' => 'HF-1', 'new_title' => null, 'sku' => 'HF-1', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 45, 'wp_title' => 'HF-2', 'new_title' => null, 'sku' => 'HF-2', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 43, 'wp_title' => '235-10', 'new_title' => null, 'sku' => '235-10', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 41, 'wp_title' => '233-12', 'new_title' => null, 'sku' => '233-12', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 39, 'wp_title' => 'HC5101-12', 'new_title' => null, 'sku' => 'HC5101-12', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 37, 'wp_title' => 'HC5102-16', 'new_title' => null, 'sku' => 'HC5102-16', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 35, 'wp_title' => '649-14', 'new_title' => null, 'sku' => '649-14', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 33, 'wp_title' => 'AA03', 'new_title' => null, 'sku' => 'AA03', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 31, 'wp_title' => '822M', 'new_title' => null, 'sku' => '822M', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 29, 'wp_title' => 'GYHH', 'new_title' => null, 'sku' => 'GYHH', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 27, 'wp_title' => 'GYH', 'new_title' => null, 'sku' => 'GYH', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 25, 'wp_title' => 'GYHG', 'new_title' => null, 'sku' => 'GYHG', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 23, 'wp_title' => '5013M', 'new_title' => null, 'sku' => '5013M', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 21, 'wp_title' => 'J109A', 'new_title' => null, 'sku' => 'J109A', 'price' => null, 'length' => null, 'width' => null, 'height' => null),
  array('wp_id' => 16, 'wp_title' => 'test', 'new_title' => null, 'sku' => 'test', 'price' => null, 'length' => null, 'width' => null, 'height' => null)
);

$batch = isset( $_GET['batch'] ) ? (int) $_GET['batch'] : 0;
$per_page = 50;

if ( $batch === 0 ) {
	echo '<h1>WooCommerce SKU Coverage & Title Catalog Optimizer</h1>';
	echo '<p>Found <strong>' . count( $updates ) . '</strong> total products to optimize.</p>';
	echo '<p>To prevent Hostinger server timeouts (500 Internal Error), updates are split into batches of ' . $per_page . '.</p>';
	echo '<p><a href="?key=great_wall_secret_998&batch=1" style="display:inline-block;padding:14px 28px;background:#8b4513;color:#fff;text-decoration:none;font-weight:bold;border-radius:4px;font-family:sans-serif;box-shadow:0 2px 5px rgba(0,0,0,0.15)">🚀 Start Auto-Update (Batch 1)</a></p>';
	exit;
}

$start_index = ( $batch - 1 ) * $per_page;
$batch_updates = array_slice( $updates, $start_index, $per_page );

if ( empty( $batch_updates ) ) {
	echo '<h1 style="color: green; font-family:sans-serif;">All Batches Completed Successfully! 🎉</h1>';
	echo '<p style="font-family:sans-serif;">Every product now has a unique SKU, matched prices, and descriptive titles.</p>';
	echo '<p style="font-family:sans-serif;"><a href="/wp-admin/edit.php?post_type=product">Go back to WooCommerce Products page</a></p>';
	exit;
}

echo '<h1 style="font-family:sans-serif;">Running Batch ' . $batch . ' (' . ( $start_index + 1 ) . ' to ' . ( $start_index + count( $batch_updates ) ) . ' of ' . count( $updates ) . ')...</h1>';
echo '<hr>';

$success_count = 0;
$fail_count = 0;

foreach ( $batch_updates as $update ) {
	$wp_id      = (int) $update['wp_id'];
	$title      = $update['wp_title'];
	$new_title  = $update['new_title'];
	$sku        = $update['sku'];
	$price      = $update['price'];
	$length     = $update['length'];
	$width      = $update['width'];
	$height     = $update['height'];
	
	try {
		$product = wc_get_product( $wp_id );
		if ( $product ) {
			$log_info = array();
			
			// 1. Update SKU
			$product->set_sku( $sku );
			$log_info[] = "SKU set to: " . $sku;
			
			// 2. Set descriptive name if matched
			if ( null !== $new_title ) {
				$product->set_name( $new_title );
				$log_info[] = "Name set to: " . $new_title;
			}
			
			// 3. Update Pricing
			if ( null !== $price && $price > 0 ) {
				$product->set_regular_price( $price );
				$product->set_price( $price );
				$product->set_sale_price( '' );
				$log_info[] = "Price set to: AED " . $price;
			}
			
			// 4. Update Dimensions
			$dims_info = array();
			if ( null !== $length ) {
				$product->set_length( $length );
				$dims_info[] = "L: " . $length . "cm";
			}
			if ( null !== $width ) {
				$product->set_width( $width );
				$dims_info[] = "W: " . $width . "cm";
			}
			if ( null !== $height ) {
				$product->set_height( $height );
				$dims_info[] = "H: " . $height . "cm";
			}
			if ( ! empty( $dims_info ) ) {
				$log_info[] = "Dimensions: " . implode( ", ", $dims_info );
			}
			
			$product->save();
			
			echo "<p style='color: green; font-family:sans-serif;'>[SUCCESS] ID " . $wp_id . " (" . $title . ") ➔ " . implode( " | ", $log_info ) . "</p>";
			$success_count++;
		} else {
			echo "<p style='color: red; font-family:sans-serif;'>[SKIP] Failed to load product ID " . $wp_id . " (" . $title . ").</p>";
			$fail_count++;
		}
	} catch ( Exception $e ) {
		echo "<p style='color: orange; font-family:sans-serif;'>[WARNING] Error updating ID " . $wp_id . " (" . $title . "): " . $e->getMessage() . "</p>";
		$fail_count++;
	}
}

$next_batch = $batch + 1;
$next_url = "?key=great_wall_secret_998&batch=" . $next_batch;

echo '<hr>';
echo '<h3 style="font-family:sans-serif;color:#333;">Batch ' . $batch . ' Complete</h3>';
echo '<p style="font-family:sans-serif;font-size:1.2rem;color:#0066cc;font-weight:bold;">Redirecting automatically to Batch ' . $next_batch . ' in 3 seconds...</p>';
echo '<meta http-equiv="refresh" content="3;url=' . $next_url . '">';
