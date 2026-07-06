<?php
/**
 * WooCommerce Catalog Importer: Creates missing catalog products as Drafts.
 * Call this by visiting: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/run-new-products-import.php?key=great_wall_secret_998
 */

@set_time_limit( 300 );
@ini_set( 'memory_limit', '512M' );

$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if ( ! file_exists( $wp_load_path ) ) {
	die( 'WordPress load file not found.' );
}

require_once $wp_load_path;

if ( ! isset( $_GET['key'] ) || $_GET['key'] !== 'great_wall_secret_998' ) {
	die( 'Unauthorized access.' );
}

$new_products = array(
  array('sku' => 'BD-1', 'title' => 'Heavy Duty Metal Bunk Bed', 'price' => 450.0, 'category_id' => 27, 'length' => 190, 'width' => 75, 'height' => 170),
  array('sku' => 'HK-4', 'title' => 'Heavy Duty Metal Bunk Bed', 'price' => 450.0, 'category_id' => 27, 'length' => 190, 'width' => 75, 'height' => 170),
  array('sku' => 'GD-1', 'title' => 'Heavy Duty Metal Bunk Bed', 'price' => 470.0, 'category_id' => 27, 'length' => 190, 'width' => 90, 'height' => 170),
  array('sku' => 'BD-2', 'title' => 'Heavy Duty Military Bunk Bed', 'price' => 570.0, 'category_id' => 27, 'length' => 190, 'width' => 90, 'height' => 170),
  array('sku' => 'BD-3', 'title' => 'Heavy Duty Military Bunk Bed', 'price' => 600.0, 'category_id' => 27, 'length' => 190, 'width' => 90, 'height' => 170),
  array('sku' => 'BS-1', 'title' => 'Standard Single Metal Bed', 'price' => 240.0, 'category_id' => 21, 'length' => 190, 'width' => 90, 'height' => 70),
  array('sku' => 'BS-5', 'title' => 'Ultra Heavy Duty Single Metal Bed', 'price' => 290.0, 'category_id' => 21, 'length' => 190, 'width' => 90, 'height' => 70),
  array('sku' => 'WB-3C', 'title' => 'Premium Wooden King Bed', 'price' => 310.0, 'category_id' => 21, 'length' => 190, 'width' => 150, 'height' => null),
  array('sku' => 'WB-5', 'title' => 'Premium Wooden Bunk Bed', 'price' => 800.0, 'category_id' => 27, 'length' => 190, 'width' => 90, 'height' => 180),
  array('sku' => 'WB-4B', 'title' => 'Premium Wooden Queen Bed', 'price' => 670.0, 'category_id' => 21, 'length' => 190, 'width' => 150, 'height' => null),
  array('sku' => 'WB-4C', 'title' => 'Premium Wooden King Bed', 'price' => 750.0, 'category_id' => 21, 'length' => 190, 'width' => 180, 'height' => null),
  array('sku' => 'XG-7', 'title' => 'Open Wooden Shoe Organizer Rack', 'price' => 140.0, 'category_id' => 16, 'length' => 90, 'width' => 80, 'height' => 35),
  array('sku' => 'XG-8A', 'title' => 'Modern Wooden Shoe Organizer Rack', 'price' => 490.0, 'category_id' => 16, 'length' => 800, 'width' => 345, 'height' => 950),
  array('sku' => 'XG-8B', 'title' => 'Modern Wooden Shoe Organizer Rack', 'price' => 600.0, 'category_id' => 16, 'length' => 1000, 'width' => 345, 'height' => 950),
  array('sku' => 'XG-8C', 'title' => 'Modern Wooden Shoe Organizer Rack', 'price' => 670.0, 'category_id' => 16, 'length' => 1200, 'width' => 345, 'height' => 950),
  array('sku' => 'XG-9', 'title' => 'Modern Wooden Shoe Organizer Rack', 'price' => 70.0, 'category_id' => 16, 'length' => 63, 'width' => 25, 'height' => 73),
  array('sku' => 'XG-10', 'title' => 'Modern Wooden Shoe Organizer Rack', 'price' => 490.0, 'category_id' => 16, 'length' => 120, 'width' => 40, 'height' => 92),
  array('sku' => 'XG-11', 'title' => 'Modern Wooden Shoe Organizer Rack', 'price' => 150.0, 'category_id' => 16, 'length' => 80, 'width' => 35, 'height' => 95),
  array('sku' => 'PF，1-14', 'title' => 'Foldable Wooden Room Divider Partition', 'price' => 160.0, 'category_id' => 25, 'length' => 180, 'width' => 200, 'height' => null),
  array('sku' => 'NT-1', 'title' => 'Portable Folding Utility Table', 'price' => 90.0, 'category_id' => 23, 'length' => 40, 'width' => 60, 'height' => 50),
  array('sku' => 'NT-2', 'title' => 'Portable Folding Utility Table', 'price' => 100.0, 'category_id' => 23, 'length' => 60, 'width' => 60, 'height' => 75),
  array('sku' => 'NT-3', 'title' => 'Portable Folding Utility Table', 'price' => 110.0, 'category_id' => 23, 'length' => 60, 'width' => 80, 'height' => 75),
  array('sku' => 'NT-4', 'title' => 'Portable Folding Utility Table', 'price' => 130.0, 'category_id' => 23, 'length' => 80, 'width' => 80, 'height' => 75),
  array('sku' => 'NT-5', 'title' => 'Portable Folding Utility Table', 'price' => 160.0, 'category_id' => 23, 'length' => 70, 'width' => 110, 'height' => 75),
  array('sku' => 'NT-7A', 'title' => 'Modern Wooden Utility Table', 'price' => 190.0, 'category_id' => 23, 'length' => 60, 'width' => 60, 'height' => 75),
  array('sku' => 'NT-7C', 'title' => 'Modern Wooden Utility Table', 'price' => 260.0, 'category_id' => 23, 'length' => 80, 'width' => 80, 'height' => 75),
  array('sku' => 'NT-7D', 'title' => 'Modern Wooden Utility Table', 'price' => 300.0, 'category_id' => 23, 'length' => 120, 'width' => 60, 'height' => 75),
  array('sku' => 'NT-7F', 'title' => 'Modern Wooden Utility Table', 'price' => 350.0, 'category_id' => 23, 'length' => 120, 'width' => 80, 'height' => 75),
  array('sku' => 'NT-7G', 'title' => 'Modern Wooden Utility Table', 'price' => 400.0, 'category_id' => 23, 'length' => 140, 'width' => 80, 'height' => 75),
  array('sku' => 'NT-8', 'title' => 'Modern Wooden Utility Table', 'price' => 200.0, 'category_id' => 23, 'length' => 120, 'width' => 60, 'height' => 75),
  array('sku' => 'NT-9', 'title' => 'Modern Wooden Utility Table', 'price' => 200.0, 'category_id' => 23, 'length' => 120, 'width' => 60, 'height' => 120),
  array('sku' => 'NT-10', 'title' => 'Modern Wooden Utility Table', 'price' => 270.0, 'category_id' => 23, 'length' => 120, 'width' => 48, 'height' => 75),
  array('sku' => 'NT-11', 'title' => 'Modern Wooden Utility Table', 'price' => 200.0, 'category_id' => 23, 'length' => 80, 'width' => 48, 'height' => 140),
  array('sku' => 'HW-8', 'title' => 'Durable Plastic Folding Table', 'price' => 500.0, 'category_id' => 23, 'length' => 180, 'width' => 75, 'height' => null),
  array('sku' => 'HF-8', 'title' => 'Heavy Duty Clothes Drying Rack', 'price' => 150.0, 'category_id' => 19, 'length' => 110, 'width' => 150, 'height' => 60),
  array('sku' => 'HF-9*3', 'title' => 'Folding 3-Step Safety Ladder', 'price' => 70.0, 'category_id' => 15, 'length' => 39, 'width' => 57, 'height' => 77),
  array('sku' => 'HF-9*4', 'title' => 'Folding 4-Step Safety Ladder', 'price' => 90.0, 'category_id' => 15, 'length' => 39, 'width' => 70, 'height' => 99),
  array('sku' => 'DT-1A', 'title' => 'Elegant Dining Table Set with 4 Chairs', 'price' => 390.0, 'category_id' => 20, 'length' => 110, 'width' => null, 'height' => null),
  array('sku' => 'DT-2A', 'title' => 'Elegant Dining Table Set with 4 Chairs', 'price' => 500.0, 'category_id' => 20, 'length' => 120, 'width' => null, 'height' => null),
  array('sku' => 'DT-3B', 'title' => 'Elegant Dining Table Set with 6 Chairs', 'price' => 670.0, 'category_id' => 20, 'length' => 160, 'width' => null, 'height' => null),
  array('sku' => 'DT-11', 'title' => 'Elegant 4-Seater Dining Table', 'price' => 999.0, 'category_id' => 24, 'length' => 150, 'width' => 90, 'height' => 75),
  array('sku' => 'DT-12', 'title' => 'Elegant 6-Seater Dining Table', 'price' => 900.0, 'category_id' => 24, 'length' => 180, 'width' => 90, 'height' => 75),
  array('sku' => 'DT-17', 'title' => '5-Seater Tea Coffee Table Set', 'price' => 4170.0, 'category_id' => 23, 'length' => 200, 'width' => 80, 'height' => 75),
  array('sku' => 'DT-18', 'title' => 'Elegant 4-Seater Dining Table', 'price' => 320.0, 'category_id' => 24, 'length' => 130, 'width' => 80, 'height' => 75),
  array('sku' => 'DT-19', 'title' => 'Elegant 4-Seater Dining Table', 'price' => 400.0, 'category_id' => 24, 'length' => 120, 'width' => 60, 'height' => 75),
  array('sku' => 'DT-19A', 'title' => 'Elegant 6-Seater Dining Table', 'price' => 570.0, 'category_id' => 24, 'length' => 160, 'width' => 70, 'height' => 75),
  array('sku' => '06Z', 'title' => 'Standing Coat Hanger Rack', 'price' => 70.0, 'category_id' => 19, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => '06F', 'title' => 'Standing Coat Hanger Rack', 'price' => 70.0, 'category_id' => 19, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => '08Z', 'title' => 'Standing Coat Hanger Rack', 'price' => 100.0, 'category_id' => 19, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => '8040Z', 'title' => 'Standing Coat Hanger Rack', 'price' => 70.0, 'category_id' => 19, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => '8040F', 'title' => 'Standing Coat Hanger Rack', 'price' => 70.0, 'category_id' => 19, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'FT-11', 'title' => 'Portable Folding Utility Table', 'price' => 240.0, 'category_id' => 23, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'FT-12', 'title' => 'Portable Folding Utility Table', 'price' => 270.0, 'category_id' => 23, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'C-12', 'title' => 'Elegant Dining Room Chair', 'price' => 250.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'C-14', 'title' => 'Elegant Dining Room Chair', 'price' => 250.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'C-15', 'title' => 'Elegant Dining Room Chair', 'price' => 240.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'C-16', 'title' => 'Elegant Dining Room Chair', 'price' => 60.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'C-17', 'title' => 'Elegant Dining Room Chair', 'price' => 300.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'C-20', 'title' => 'Elegant Dining Room Chair', 'price' => 290.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'C-21', 'title' => 'Elegant Dining Room Chair', 'price' => 290.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'C-22', 'title' => 'Elegant Dining Room Chair', 'price' => 170.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'C-23', 'title' => 'Elegant Dining Room Chair', 'price' => 230.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'C-24', 'title' => 'Elegant Dining Room Chair', 'price' => 200.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'C-25', 'title' => 'Elegant Dining Room Chair', 'price' => 300.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'RT-6B(white)', 'title' => 'Modern Round Wooden Table', 'price' => 200.0, 'category_id' => 23, 'length' => 70, 'width' => 70, 'height' => null),
  array('sku' => 'RT-7A(
White)', 'title' => 'Modern Round Wooden Table', 'price' => 190.0, 'category_id' => 23, 'length' => 60, 'width' => 70, 'height' => null),
  array('sku' => 'RT-7C(
White)', 'title' => 'Modern Round Wooden Table', 'price' => 260.0, 'category_id' => 23, 'length' => 80, 'width' => 70, 'height' => null),
  array('sku' => 'RT-7D(
White)', 'title' => 'Modern Round Wooden Table', 'price' => 500.0, 'category_id' => 23, 'length' => 120, 'width' => 70, 'height' => null),
  array('sku' => 'RT-8A', 'title' => 'Elegant Round Dining Table', 'price' => 1340.0, 'category_id' => 24, 'length' => 1, 'width' => null, 'height' => null),
  array('sku' => 'RT-8C', 'title' => 'Elegant Round Dining Table', 'price' => 2500.0, 'category_id' => 24, 'length' => 1, 'width' => null, 'height' => null),
  array('sku' => 'RT-8D', 'title' => 'Elegant Round Dining Table', 'price' => 3920.0, 'category_id' => 24, 'length' => 2, 'width' => null, 'height' => null),
  array('sku' => 'RT-8F', 'title' => 'Elegant Round Dining Table', 'price' => 4500.0, 'category_id' => 24, 'length' => 2, 'width' => null, 'height' => null),
  array('sku' => 'RT-9B', 'title' => 'Modern Round Wooden Table', 'price' => 200.0, 'category_id' => 23, 'length' => 70, 'width' => 70, 'height' => null),
  array('sku' => 'RT-10', 'title' => 'Modern Round Wooden Table', 'price' => 470.0, 'category_id' => 23, 'length' => 150, 'width' => 74, 'height' => null),
  array('sku' => 'RT-10A', 'title' => 'Modern Round Wooden Table', 'price' => 550.0, 'category_id' => 23, 'length' => 180, 'width' => 74, 'height' => null),
  array('sku' => 'RT-13A', 'title' => 'Modern Round Wooden Table', 'price' => 370.0, 'category_id' => 23, 'length' => 60, 'width' => 74, 'height' => null),
  array('sku' => 'RT-13B', 'title' => 'Modern Round Wooden Table', 'price' => 400.0, 'category_id' => 23, 'length' => 70, 'width' => 74, 'height' => null),
  array('sku' => 'RT-13C', 'title' => 'Modern Round Wooden Table', 'price' => 440.0, 'category_id' => 23, 'length' => 80, 'width' => 74, 'height' => null),
  array('sku' => 'RT-14B', 'title' => 'Modern Round Wooden Table', 'price' => 260.0, 'category_id' => 23, 'length' => 80, 'width' => 75, 'height' => null),
  array('sku' => 'RT-14D', 'title' => 'Modern Round Wooden Table', 'price' => 450.0, 'category_id' => 23, 'length' => 120, 'width' => 70, 'height' => null),
  array('sku' => 'RB-3', 'title' => 'Tempered Glass Top Office Table', 'price' => 300.0, 'category_id' => 23, 'length' => 100, 'width' => null, 'height' => null),
  array('sku' => 'RB-3A', 'title' => 'Tempered Glass Top Office Table', 'price' => 340.0, 'category_id' => 23, 'length' => 120, 'width' => null, 'height' => null),
  array('sku' => 'CT-1A(brown)', 'title' => 'Modern Living Room Coffee Table', 'price' => 200.0, 'category_id' => 23, 'length' => 60, 'width' => 60, 'height' => null),
  array('sku' => 'CT-1B(brown)', 'title' => 'Modern Living Room Coffee Table', 'price' => 250.0, 'category_id' => 23, 'length' => 60, 'width' => 120, 'height' => null),
  array('sku' => 'CT-1A(yellow)', 'title' => 'Modern Living Room Coffee Table', 'price' => 200.0, 'category_id' => 23, 'length' => 60, 'width' => 60, 'height' => null),
  array('sku' => 'CT-1B(yellow)', 'title' => 'Modern Living Room Coffee Table', 'price' => 250.0, 'category_id' => 23, 'length' => 60, 'width' => 120, 'height' => null),
  array('sku' => 'CT-2A', 'title' => 'Modern Living Room Coffee Table', 'price' => 230.0, 'category_id' => 23, 'length' => 60, 'width' => 60, 'height' => 49),
  array('sku' => 'CT-2B', 'title' => 'Modern Living Room Coffee Table', 'price' => 270.0, 'category_id' => 23, 'length' => 120, 'width' => 60, 'height' => 49),
  array('sku' => 'CT-7', 'title' => 'Modern Living Room Coffee Table', 'price' => 550.0, 'category_id' => 23, 'length' => 80, 'width' => 80, 'height' => 45),
  array('sku' => 'CT-9A', 'title' => 'Modern Living Room Coffee Table', 'price' => 550.0, 'category_id' => 23, 'length' => 60, 'width' => 600, 'height' => 43),
  array('sku' => 'CT-9B', 'title' => 'Modern Living Room Coffee Table', 'price' => 870.0, 'category_id' => 23, 'length' => 120, 'width' => 60, 'height' => 43),
  array('sku' => 'CT-10B', 'title' => 'Modern Living Room Coffee Table', 'price' => 450.0, 'category_id' => 23, 'length' => 120, 'width' => 60, 'height' => 45),
  array('sku' => 'CT-11B', 'title' => 'Modern Living Room Coffee Table', 'price' => 3170.0, 'category_id' => 23, 'length' => 1500, 'width' => 800, 'height' => 460),
  array('sku' => 'CT-12A', 'title' => 'Modern Living Room Coffee Table', 'price' => 200.0, 'category_id' => 23, 'length' => 60, 'width' => 60, 'height' => 49),
  array('sku' => 'CT-12B', 'title' => 'Modern Living Room Coffee Table', 'price' => 470.0, 'category_id' => 23, 'length' => 120, 'width' => 60, 'height' => 49),
  array('sku' => 'CT-13A', 'title' => 'Modern Living Room Coffee Table', 'price' => 490.0, 'category_id' => 23, 'length' => 60, 'width' => 60, 'height' => 45),
  array('sku' => 'CT-13B', 'title' => 'Modern Living Room Coffee Table', 'price' => 670.0, 'category_id' => 23, 'length' => 120, 'width' => 60, 'height' => 45),
  array('sku' => 'CT-14A', 'title' => 'Modern Living Room Coffee Table', 'price' => 220.0, 'category_id' => 23, 'length' => 60, 'width' => 60, 'height' => 49),
  array('sku' => 'CT-14B', 'title' => 'Modern Living Room Coffee Table', 'price' => 390.0, 'category_id' => 23, 'length' => 120, 'width' => 60, 'height' => 49),
  array('sku' => 'OC-10A', 'title' => 'Comfortable Office Visitor Chair', 'price' => 200.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-10C', 'title' => 'Modern Living Room Coffee Table', 'price' => 230.0, 'category_id' => 23, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-16C', 'title' => 'Comfortable Ergonomic Office Chair', 'price' => 450.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-25A', 'title' => 'Comfortable Office Visitor Chair', 'price' => 310.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-28A(brown）', 'title' => 'Comfortable Office Visitor Chair', 'price' => 500.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-28B(brown）', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 500.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-28C(brown）', 'title' => 'Comfortable Ergonomic Office Chair', 'price' => 550.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-28A(grey)', 'title' => 'Comfortable Office Visitor Chair', 'price' => 500.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-28B(grey)', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 500.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-28C(grey)', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 550.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-30A', 'title' => 'Comfortable Office Visitor Chair', 'price' => 210.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-30B', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 240.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-30C', 'title' => 'Comfortable Ergonomic Office Chair', 'price' => 250.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-42C', 'title' => 'Comfortable Ergonomic Office Chair', 'price' => 310.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-44B（black）', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 290.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-44B（green）', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 300.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-44C（black）', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 320.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-44C（green）', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 330.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-46C', 'title' => 'Comfortable Ergonomic Office Chair', 'price' => 380.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-47A', 'title' => 'Comfortable Office Visitor Chair', 'price' => 200.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-48A', 'title' => 'Leather Office Visitor Chair', 'price' => 1140.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-48B', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 1400.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-48C', 'title' => 'Leather High-Back Executive Chair', 'price' => 1450.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-55A', 'title' => 'Comfortable Office Visitor Chair', 'price' => 150.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-59B', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 470.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-63C', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 380.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-67A', 'title' => 'Comfortable Office Visitor Chair', 'price' => 120.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-69C(grey)', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 330.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-69C(black）', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 320.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-71A
(grey)', 'title' => 'Comfortable Office Visitor Chair', 'price' => 210.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-71A
(black)', 'title' => 'Comfortable Office Visitor Chair', 'price' => 200.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-71B
(black)', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 310.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-71B
(grey)', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 310.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-75A', 'title' => 'Premium Pure Leather Office Visitor Chair', 'price' => 970.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-75B', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 1140.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-75C', 'title' => 'Premium Pure Leather High-Back Executive Chair', 'price' => 1220.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-79C', 'title' => 'Leather High-Back Executive Chair', 'price' => 520.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-81B(BLACK)', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 320.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-86A(Black）', 'title' => 'Comfortable Office Visitor Chair', 'price' => 400.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-86B(Black）', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 460.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-86C(Black）', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 500.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-86A(Grey）', 'title' => 'Comfortable Office Visitor Chair', 'price' => 430.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-86B(Grey）', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 500.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-86C(Grey）', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 510.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-87A', 'title' => 'Comfortable Office Visitor Chair', 'price' => 250.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-87B', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 260.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-87C', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 280.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-88B', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 270.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-88C', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 300.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-89A', 'title' => 'Comfortable Office Visitor Chair', 'price' => 250.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-89B', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 260.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-89C', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 290.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-90C', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 390.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-91C', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 500.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-92C
(black)', 'title' => 'Premium Ergonomic Desk Chair', 'price' => 1250.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-92C
(grey)', 'title' => 'Premium Ergonomic Desk Chair', 'price' => 1350.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-93A', 'title' => 'Comfortable Office Visitor Chair', 'price' => 870.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-93B', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 1100.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-93C', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 1200.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-94C(BLACK)', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 1000.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-94C(BROWN)', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 1000.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-95A', 'title' => 'Comfortable Office Visitor Chair', 'price' => 810.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-95B', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 970.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-95C', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 1000.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-96C', 'title' => 'High-Back Executive Office Chair with Footrest', 'price' => 370.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-97C', 'title' => 'Luxury High-Back Leather Executive Chair', 'price' => 1040.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-98C', 'title' => 'Luxury High-Back Leather Executive Chair', 'price' => 970.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-99C', 'title' => 'Luxury High-Back Leather Executive Chair', 'price' => 1000.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-100C(BLACK)', 'title' => 'Ergonomic High-Back Mesh Office Chair', 'price' => 520.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-100C(GREY)', 'title' => 'Ergonomic High-Back Mesh Office Chair', 'price' => 540.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-101C', 'title' => 'Luxury High-Back Leather Executive Chair', 'price' => 570.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-102A', 'title' => 'Comfortable Office Visitor Chair', 'price' => 320.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-102B', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 350.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-102C', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 430.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-103C', 'title' => 'Ergonomic High-Back Mesh Office Chair', 'price' => 320.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-104C', 'title' => 'Luxury High-Back Leather Executive Chair', 'price' => 870.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-105A', 'title' => 'Comfortable Office Visitor Chair', 'price' => 200.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-105B', 'title' => 'Ergonomic Mid-Back Office Chair', 'price' => 200.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OC-105C', 'title' => 'Ergonomic High-Back Executive Office Chair', 'price' => 230.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'OB-1', 'title' => 'Modern Office Executive Desk', 'price' => 840.0, 'category_id' => 17, 'length' => 160, 'width' => 75, 'height' => 75),
  array('sku' => 'OB-1A', 'title' => 'Modern Office Executive Desk', 'price' => 670.0, 'category_id' => 17, 'length' => 140, 'width' => 60, 'height' => 75),
  array('sku' => 'OB-3A', 'title' => 'Modern Office Executive Desk', 'price' => 1100.0, 'category_id' => 17, 'length' => 1600, 'width' => 800, 'height' => 750),
  array('sku' => 'OB-3B', 'title' => 'Modern Office Executive Desk', 'price' => 1170.0, 'category_id' => 17, 'length' => 1800, 'width' => 850, 'height' => 750),
  array('sku' => 'OB-3', 'title' => 'Modern Office Executive Desk', 'price' => 1270.0, 'category_id' => 17, 'length' => 200, 'width' => 90, 'height' => 75),
  array('sku' => 'OB-5', 'title' => 'Modern Office Executive Desk', 'price' => 2070.0, 'category_id' => 17, 'length' => 240, 'width' => 100, 'height' => 75),
  array('sku' => 'OB-7', 'title' => 'Modern Office Executive Desk', 'price' => 1640.0, 'category_id' => 17, 'length' => 160, 'width' => 75, 'height' => 75),
  array('sku' => 'OB-7A', 'title' => 'Modern Office Executive Desk', 'price' => 1670.0, 'category_id' => 17, 'length' => 180, 'width' => 80, 'height' => 75),
  array('sku' => 'OB-7B', 'title' => 'Modern Office Executive Desk', 'price' => 1750.0, 'category_id' => 17, 'length' => 200, 'width' => 90, 'height' => 75),
  array('sku' => 'OB-8', 'title' => 'Modern Office Executive Desk', 'price' => 2570.0, 'category_id' => 17, 'length' => 240, 'width' => 100, 'height' => 75),
  array('sku' => 'OB-10', 'title' => 'Modern Office Executive Desk', 'price' => 1250.0, 'category_id' => 17, 'length' => 140, 'width' => 70, 'height' => 75),
  array('sku' => 'OB-10A', 'title' => 'Modern Office Executive Desk', 'price' => 1290.0, 'category_id' => 17, 'length' => 160, 'width' => 75, 'height' => 75),
  array('sku' => 'OB-10B', 'title' => 'Modern Office Executive Desk', 'price' => 1340.0, 'category_id' => 17, 'length' => 180, 'width' => 80, 'height' => 75),
  array('sku' => 'OB-10C', 'title' => 'Modern Office Executive Desk', 'price' => 1420.0, 'category_id' => 17, 'length' => 200, 'width' => 90, 'height' => 75),
  array('sku' => 'OB-11', 'title' => 'Modern Office Executive Desk', 'price' => 1700.0, 'category_id' => 17, 'length' => 220, 'width' => 90, 'height' => 75),
  array('sku' => 'OB-11A', 'title' => 'Modern Office Executive Desk', 'price' => 1870.0, 'category_id' => 17, 'length' => 240, 'width' => 100, 'height' => 75),
  array('sku' => 'OB-13A', 'title' => 'Modern Office Executive Desk', 'price' => 1100.0, 'category_id' => 17, 'length' => 1400, 'width' => 600, 'height' => 750),
  array('sku' => 'OB-13B', 'title' => 'Modern Office Executive Desk', 'price' => 1170.0, 'category_id' => 17, 'length' => 1600, 'width' => 750, 'height' => 750),
  array('sku' => 'OB-13C', 'title' => 'Modern Office Executive Desk', 'price' => 1220.0, 'category_id' => 17, 'length' => 1800, 'width' => 800, 'height' => 750),
  array('sku' => 'OB-13D', 'title' => 'Modern Office Executive Desk', 'price' => 1340.0, 'category_id' => 17, 'length' => 2000, 'width' => 800, 'height' => 750),
  array('sku' => 'OB-14', 'title' => 'Modern Office Executive Desk', 'price' => 4250.0, 'category_id' => 17, 'length' => 2000, 'width' => 1950, 'height' => 750),
  array('sku' => 'OB-14A', 'title' => 'Modern Office Executive Desk', 'price' => 5100.0, 'category_id' => 17, 'length' => 2400, 'width' => 2000, 'height' => 750),
  array('sku' => 'OB-15', 'title' => 'Modern Office Executive Desk', 'price' => 4470.0, 'category_id' => 17, 'length' => 2400, 'width' => 2000, 'height' => 760),
  array('sku' => 'OB-15A', 'title' => 'Modern Office Executive Desk', 'price' => 6000.0, 'category_id' => 17, 'length' => 2800, 'width' => 2400, 'height' => 760),
  array('sku' => 'OB-17B', 'title' => 'Adjustable Height Sit-Stand Office Desk', 'price' => 2500.0, 'category_id' => 17, 'length' => 1800, 'width' => 800, 'height' => 750),
  array('sku' => 'OB-18B', 'title' => 'Modern Office Executive Desk', 'price' => 1300.0, 'category_id' => 17, 'length' => 1600, 'width' => 1600, 'height' => 750),
  array('sku' => 'OB-18C', 'title' => 'Modern Office Executive Desk', 'price' => 1400.0, 'category_id' => 17, 'length' => 1800, 'width' => 1600, 'height' => 750),
  array('sku' => 'OB-18D', 'title' => 'Modern Office Executive Desk', 'price' => 1500.0, 'category_id' => 17, 'length' => 2000, 'width' => 1600, 'height' => 750),
  array('sku' => 'OB-19A', 'title' => 'Modern Office Executive Desk', 'price' => 1620.0, 'category_id' => 17, 'length' => 1800, 'width' => 1600, 'height' => 750),
  array('sku' => 'OB-19B', 'title' => 'Modern Office Executive Desk', 'price' => 1740.0, 'category_id' => 17, 'length' => 2200, 'width' => 1600, 'height' => 750),
  array('sku' => 'OB-19C', 'title' => 'Modern Office Executive Desk', 'price' => 1840.0, 'category_id' => 17, 'length' => 2600, 'width' => 1800, 'height' => 750),
  array('sku' => 'OB-20A', 'title' => 'Modern Office Executive Desk', 'price' => 6420.0, 'category_id' => 17, 'length' => 2400, 'width' => 2000, 'height' => 750),
  array('sku' => 'OB-20B', 'title' => 'Modern Office Executive Desk', 'price' => 7100.0, 'category_id' => 17, 'length' => 2800, 'width' => 2150, 'height' => 750),
  array('sku' => 'OB-21A', 'title' => 'Modern Office Executive Desk', 'price' => 1640.0, 'category_id' => 17, 'length' => 1600, 'width' => 800, 'height' => 750),
  array('sku' => 'OB-21B', 'title' => 'Modern Office Executive Desk', 'price' => 1750.0, 'category_id' => 17, 'length' => 1800, 'width' => 800, 'height' => 750),
  array('sku' => 'OB-21C', 'title' => 'Modern Office Executive Desk', 'price' => 1920.0, 'category_id' => 17, 'length' => 2000, 'width' => 800, 'height' => 750),
  array('sku' => 'OB-22(L/R)', 'title' => 'Modern Office Executive Desk', 'price' => 2600.0, 'category_id' => 17, 'length' => 2400, 'width' => 900, 'height' => 760),
  array('sku' => 'OT-1', 'title' => 'Modern Office Executive Desk', 'price' => 400.0, 'category_id' => 17, 'length' => 120, 'width' => 60, 'height' => 75),
  array('sku' => 'OT-1A', 'title' => 'Modern Office Executive Desk', 'price' => 450.0, 'category_id' => 17, 'length' => 140, 'width' => 70, 'height' => 75),
  array('sku' => 'OT-4', 'title' => 'Modern Office Executive Desk', 'price' => 470.0, 'category_id' => 17, 'length' => 1200, 'width' => 600, 'height' => 750),
  array('sku' => 'OT-4A', 'title' => 'Modern Office Executive Desk', 'price' => 510.0, 'category_id' => 17, 'length' => 1400, 'width' => 600, 'height' => 750),
  array('sku' => 'OT-5', 'title' => 'Modern Office Executive Desk', 'price' => 430.0, 'category_id' => 17, 'length' => 1200, 'width' => 600, 'height' => 750),
  array('sku' => 'OT-5A', 'title' => 'Modern Office Executive Desk', 'price' => 490.0, 'category_id' => 17, 'length' => 1400, 'width' => 600, 'height' => 750),
  array('sku' => 'OT-6', 'title' => 'Modern Office Executive Desk', 'price' => 560.0, 'category_id' => 17, 'length' => 1200, 'width' => 600, 'height' => 750),
  array('sku' => 'OT-6A', 'title' => 'Modern Office Executive Desk', 'price' => 620.0, 'category_id' => 17, 'length' => 1400, 'width' => 600, 'height' => 750),
  array('sku' => 'OT-10', 'title' => 'Multi-Purpose Training Room Table', 'price' => 340.0, 'category_id' => 23, 'length' => 120, 'width' => 50, 'height' => 75),
  array('sku' => 'OT-11', 'title' => 'Modern Office Executive Desk', 'price' => 470.0, 'category_id' => 17, 'length' => 1000, 'width' => 600, 'height' => 750),
  array('sku' => 'OT-11A', 'title' => 'Modern Office Executive Desk', 'price' => 470.0, 'category_id' => 17, 'length' => 1200, 'width' => 600, 'height' => 750),
  array('sku' => 'OT-11B', 'title' => 'Modern Office Executive Desk', 'price' => 510.0, 'category_id' => 17, 'length' => 1400, 'width' => 600, 'height' => 750),
  array('sku' => 'OT-12', 'title' => 'Modern Office Executive Desk', 'price' => 400.0, 'category_id' => 17, 'length' => 1200, 'width' => 600, 'height' => 750),
  array('sku' => 'OT-12A', 'title' => 'Modern Office Executive Desk', 'price' => 450.0, 'category_id' => 17, 'length' => 1400, 'width' => 600, 'height' => 750),
  array('sku' => 'OS-2*2', 'title' => 'Modern Office Workstation Desk', 'price' => 640.0, 'category_id' => 17, 'length' => 120, 'width' => 120, 'height' => 75),
  array('sku' => 'OS-3*1', 'title' => 'L-Shaped Corner Workstation Desk', 'price' => 560.0, 'category_id' => 17, 'length' => 150, 'width' => 100, 'height' => 110),
  array('sku' => 'OS-3*2', 'title' => 'Modern Office Workstation Desk', 'price' => 750.0, 'category_id' => 17, 'length' => 150, 'width' => 120, 'height' => 75),
  array('sku' => 'OS-4*4', 'title' => 'Modern Office Workstation Desk', 'price' => 1070.0, 'category_id' => 17, 'length' => 240, 'width' => 120, 'height' => 75),
  array('sku' => 'OS-6*4', 'title' => 'Modern Office Workstation Desk', 'price' => 550.0, 'category_id' => 17, 'length' => 240, 'width' => 120, 'height' => 75),
  array('sku' => 'BOARD 40CM', 'title' => 'Model BOARD 40CM', 'price' => 70.0, 'category_id' => 15, 'length' => 120, 'width' => 40, 'height' => null),
  array('sku' => 'OS-7*2', 'title' => 'Modern Office Workstation Desk', 'price' => 300.0, 'category_id' => 17, 'length' => 80, 'width' => 100, 'height' => 75),
  array('sku' => 'OS-7A*4', 'title' => 'Modern Office Workstation Desk', 'price' => 520.0, 'category_id' => 17, 'length' => 160, 'width' => 100, 'height' => 75),
  array('sku' => 'OS-7B', 'title' => 'Modern Office Workstation Desk', 'price' => 250.0, 'category_id' => 17, 'length' => 120, 'width' => 60, 'height' => 75),
  array('sku' => 'OS-7C', 'title' => 'Modern Office Workstation Desk', 'price' => 210.0, 'category_id' => 17, 'length' => 100, 'width' => 50, 'height' => 75),
  array('sku' => 'OS-7D', 'title' => 'Modern Office Workstation Desk', 'price' => 340.0, 'category_id' => 17, 'length' => 140, 'width' => 70, 'height' => 75),
  array('sku' => 'OS-8*2', 'title' => 'Modern Office Workstation Desk', 'price' => 860.0, 'category_id' => 17, 'length' => 120, 'width' => 120, 'height' => 106),
  array('sku' => 'OS-8A*2', 'title' => 'Modern Office Workstation Desk', 'price' => 740.0, 'category_id' => 17, 'length' => 120, 'width' => 120, 'height' => 106),
  array('sku' => 'OS-10', 'title' => 'Modern Office Workstation Desk', 'price' => 750.0, 'category_id' => 17, 'length' => 120, 'width' => 60, 'height' => 110),
  array('sku' => 'OS-11', 'title' => 'Office Workstation Desk with Drawers', 'price' => 750.0, 'category_id' => 17, 'length' => 120, 'width' => 60, 'height' => 110),
  array('sku' => 'OS-11A', 'title' => 'L-Shaped Corner Workstation Desk', 'price' => 1000.0, 'category_id' => 17, 'length' => 1200, 'width' => 1400, 'height' => 1100),
  array('sku' => 'OS-11B', 'title' => 'L-Shaped Corner Workstation Desk', 'price' => 1000.0, 'category_id' => 17, 'length' => 1700, 'width' => 1400, 'height' => 1100),
  array('sku' => 'OS-12', 'title' => 'Office Workstation Desk with Drawers', 'price' => 750.0, 'category_id' => 17, 'length' => 120, 'width' => 60, 'height' => 110),
  array('sku' => 'OS-13*2', 'title' => 'Modern Office Workstation Desk', 'price' => 1040.0, 'category_id' => 17, 'length' => 1200, 'width' => 1200, 'height' => 1050),
  array('sku' => 'OS-13A*2', 'title' => 'Modern Office Workstation Desk', 'price' => 920.0, 'category_id' => 17, 'length' => 1200, 'width' => 1200, 'height' => 1050),
  array('sku' => 'OS-14*1', 'title' => 'Professional Accountant Workstation Desk', 'price' => 1100.0, 'category_id' => 17, 'length' => 1500, 'width' => 1200, 'height' => 1200),
  array('sku' => 'OS-15*2', 'title' => 'Modern Office Workstation Desk', 'price' => 1200.0, 'category_id' => 17, 'length' => 1400, 'width' => 1200, 'height' => 1050),
  array('sku' => 'OS-16*4', 'title' => 'Modern Office Workstation Desk', 'price' => 1750.0, 'category_id' => 17, 'length' => 2800, 'width' => 1200, 'height' => 1050),
  array('sku' => 'OS-17*2', 'title' => 'Modern Wooden Utility Table', 'price' => 750.0, 'category_id' => 17, 'length' => 120, 'width' => 120, 'height' => 106),
  array('sku' => 'OS-17A*2', 'title' => 'Modern Wooden Utility Table', 'price' => 690.0, 'category_id' => 17, 'length' => 120, 'width' => 120, 'height' => 106),
  array('sku' => 'OS-18*4', 'title' => 'Modern Office Workstation Desk', 'price' => 940.0, 'category_id' => 17, 'length' => 240, 'width' => 120, 'height' => 75),
  array('sku' => 'OS-19', 'title' => 'Modern Office Workstation Desk', 'price' => 1100.0, 'category_id' => 17, 'length' => 120, 'width' => 120, 'height' => 106),
  array('sku' => 'OS-19A', 'title' => 'Modern Office Workstation Desk', 'price' => 1000.0, 'category_id' => 17, 'length' => 120, 'width' => 120, 'height' => 106),
  array('sku' => 'BR-1', 'title' => 'Book Rack', 'price' => 490.0, 'category_id' => 15, 'length' => 135, 'width' => 80, 'height' => 30),
  array('sku' => 'BR-1A', 'title' => 'Book Rack', 'price' => 450.0, 'category_id' => 15, 'length' => 135, 'width' => 80, 'height' => 30),
  array('sku' => 'BR-2', 'title' => 'Book Rack', 'price' => 700.0, 'category_id' => 15, 'length' => 200, 'width' => 80, 'height' => 40),
  array('sku' => 'BR-3
(coffee)', 'title' => '3-Drawer Storage Pedestal Cabinet', 'price' => 250.0, 'category_id' => 26, 'length' => 60, 'width' => 40, 'height' => 40),
  array('sku' => 'BR-3
(white)', 'title' => '3-Drawer Storage Pedestal Cabinet', 'price' => 250.0, 'category_id' => 26, 'length' => 60, 'width' => 40, 'height' => 40),
  array('sku' => 'BR-6', 'title' => 'Book Rack', 'price' => 870.0, 'category_id' => 15, 'length' => 120, 'width' => 40, 'height' => 80),
  array('sku' => 'BR-7', 'title' => 'Book Rack', 'price' => 2120.0, 'category_id' => 15, 'length' => 240, 'width' => 40, 'height' => 200),
  array('sku' => 'BR-9
(Light)', 'title' => 'Book Rack', 'price' => 840.0, 'category_id' => 15, 'length' => 80, 'width' => 40, 'height' => 200),
  array('sku' => 'BR-9
(Black)', 'title' => 'Book Rack', 'price' => 840.0, 'category_id' => 15, 'length' => 80, 'width' => 40, 'height' => 200),
  array('sku' => 'BR-9
(White)', 'title' => 'Book Rack', 'price' => 840.0, 'category_id' => 15, 'length' => 80, 'width' => 40, 'height' => 200),
  array('sku' => 'BR-9
(coffee)', 'title' => 'Book Rack', 'price' => 840.0, 'category_id' => 15, 'length' => 80, 'width' => 40, 'height' => 200),
  array('sku' => 'BR-9
(Walnut)', 'title' => 'Book Rack', 'price' => 840.0, 'category_id' => 15, 'length' => 80, 'width' => 40, 'height' => 200),
  array('sku' => 'BR-9
(YHT)', 'title' => 'Book Rack', 'price' => 840.0, 'category_id' => 15, 'length' => 80, 'width' => 40, 'height' => 200),
  array('sku' => 'BR-10', 'title' => 'Book Rack', 'price' => 2250.0, 'category_id' => 15, 'length' => 2400, 'width' => 400, 'height' => 2000),
  array('sku' => 'BR-11(brown)', 'title' => 'Book Rack', 'price' => 1170.0, 'category_id' => 15, 'length' => 1200, 'width' => 400, 'height' => 2000),
  array('sku' => 'BR-11(white)', 'title' => 'Book Rack', 'price' => 1170.0, 'category_id' => 15, 'length' => 1200, 'width' => 400, 'height' => 2000),
  array('sku' => 'BR-13B', 'title' => 'Modern Wooden Utility Table', 'price' => 1050.0, 'category_id' => 23, 'length' => 100, 'width' => 60, 'height' => 160),
  array('sku' => 'BR-15', 'title' => 'Book Rack', 'price' => 470.0, 'category_id' => 15, 'length' => 800, 'width' => 400, 'height' => 1200),
  array('sku' => 'BR-16', 'title' => 'Book Rack', 'price' => 1840.0, 'category_id' => 15, 'length' => 2000, 'width' => 400, 'height' => 2000),
  array('sku' => 'BR-17A', 'title' => 'Modern Wooden Utility Table', 'price' => 1340.0, 'category_id' => 23, 'length' => 1200, 'width' => 600, 'height' => 1050),
  array('sku' => 'BR-19', 'title' => 'Book Rack', 'price' => 1840.0, 'category_id' => 15, 'length' => 1600, 'width' => 400, 'height' => 825),
  array('sku' => 'BR-20', 'title' => 'Book Rack', 'price' => 3420.0, 'category_id' => 15, 'length' => 2400, 'width' => 400, 'height' => 2000),
  array('sku' => 'BR-21', 'title' => 'Book Rack', 'price' => 1300.0, 'category_id' => 15, 'length' => 1600, 'width' => 400, 'height' => 800),
  array('sku' => 'BR-22', 'title' => 'Book Rack', 'price' => 3420.0, 'category_id' => 15, 'length' => 2400, 'width' => 400, 'height' => 2000),
  array('sku' => 'BR-25', 'title' => 'Modern Wooden Utility Table', 'price' => 1300.0, 'category_id' => 23, 'length' => 2000, 'width' => 600, 'height' => 1100),
  array('sku' => 'BR-26', 'title' => 'Book Rack', 'price' => 450.0, 'category_id' => 15, 'length' => 800, 'width' => 400, 'height' => 1200),
  array('sku' => 'BR-27', 'title' => 'Book Rack', 'price' => 1840.0, 'category_id' => 15, 'length' => 2400, 'width' => 400, 'height' => 2000),
  array('sku' => 'BR-28', 'title' => 'Book Rack', 'price' => 4100.0, 'category_id' => 15, 'length' => 2400, 'width' => 400, 'height' => 1950),
  array('sku' => 'BR-30', 'title' => 'Book Rack', 'price' => 870.0, 'category_id' => 15, 'length' => 80, 'width' => 40, 'height' => 200),
  array('sku' => 'BR-31', 'title' => 'Book Rack', 'price' => 1170.0, 'category_id' => 15, 'length' => 1200, 'width' => 400, 'height' => 2000),
  array('sku' => 'BR-32', 'title' => 'Book Rack', 'price' => 2100.0, 'category_id' => 15, 'length' => 2000, 'width' => 400, 'height' => 2000),
  array('sku' => 'BR-33', 'title' => 'Book Rack', 'price' => 2500.0, 'category_id' => 15, 'length' => 2400, 'width' => 400, 'height' => 2000),
  array('sku' => 'BR-35', 'title' => 'Book Rack', 'price' => 370.0, 'category_id' => 15, 'length' => 800, 'width' => 400, 'height' => 800),
  array('sku' => 'BR-35A', 'title' => 'Book Rack', 'price' => 500.0, 'category_id' => 15, 'length' => 1200, 'width' => 400, 'height' => 800),
  array('sku' => 'OM-4', 'title' => 'Professional Meeting Conference Table', 'price' => 1550.0, 'category_id' => 17, 'length' => 240, 'width' => 120, 'height' => 75),
  array('sku' => 'OM-4A', 'title' => 'Professional Meeting Conference Table', 'price' => 2670.0, 'category_id' => 17, 'length' => 300, 'width' => 150, 'height' => 75),
  array('sku' => 'OM-4B', 'title' => 'Professional Meeting Conference Table', 'price' => 3200.0, 'category_id' => 17, 'length' => 360, 'width' => 150, 'height' => 75),
  array('sku' => 'OM-4C', 'title' => 'Professional Meeting Conference Table', 'price' => 4250.0, 'category_id' => 17, 'length' => 480, 'width' => 150, 'height' => 75),
  array('sku' => 'OM-5', 'title' => 'Professional Meeting Conference Table', 'price' => 1550.0, 'category_id' => 17, 'length' => 240, 'width' => 120, 'height' => 75),
  array('sku' => 'OM-5A', 'title' => 'Professional Meeting Conference Table', 'price' => 2670.0, 'category_id' => 17, 'length' => 300, 'width' => 150, 'height' => 75),
  array('sku' => 'OM-5B', 'title' => 'Professional Meeting Conference Table', 'price' => 3200.0, 'category_id' => 17, 'length' => 360, 'width' => 150, 'height' => 75),
  array('sku' => 'OM-5C', 'title' => 'Professional Meeting Conference Table', 'price' => 4250.0, 'category_id' => 17, 'length' => 480, 'width' => 150, 'height' => 75),
  array('sku' => 'OM-6', 'title' => 'Professional Meeting Conference Table', 'price' => 640.0, 'category_id' => 17, 'length' => 200, 'width' => 100, 'height' => 75),
  array('sku' => 'OM-7', 'title' => 'Professional Meeting Conference Table', 'price' => 2670.0, 'category_id' => 17, 'length' => 3000, 'width' => 1500, 'height' => 750),
  array('sku' => 'OM-7A', 'title' => 'Professional Meeting Conference Table', 'price' => 3200.0, 'category_id' => 17, 'length' => 3600, 'width' => 1500, 'height' => 750),
  array('sku' => 'OM-7B', 'title' => 'Professional Meeting Conference Table', 'price' => 3800.0, 'category_id' => 17, 'length' => 4200, 'width' => 1500, 'height' => 750),
  array('sku' => 'OM-7C', 'title' => 'Professional Meeting Conference Table', 'price' => 4250.0, 'category_id' => 17, 'length' => 4800, 'width' => 1500, 'height' => 750),
  array('sku' => 'OM-9', 'title' => 'Professional Meeting Conference Table', 'price' => 6500.0, 'category_id' => 17, 'length' => 3200, 'width' => 1200, 'height' => 750),
  array('sku' => 'OM-10', 'title' => 'Professional Meeting Conference Table', 'price' => 7900.0, 'category_id' => 17, 'length' => 3600, 'width' => 1400, 'height' => 760),
  array('sku' => 'OM-10A', 'title' => 'Professional Meeting Conference Table', 'price' => 10000.0, 'category_id' => 17, 'length' => 4800, 'width' => 1500, 'height' => 760),
  array('sku' => 'OM-11A', 'title' => 'Professional Meeting Conference Table', 'price' => 1300.0, 'category_id' => 17, 'length' => 200, 'width' => 120, 'height' => 75),
  array('sku' => 'OM-11B', 'title' => 'Professional Meeting Conference Table', 'price' => 1370.0, 'category_id' => 17, 'length' => 240, 'width' => 120, 'height' => 75),
  array('sku' => 'OM-12', 'title' => 'Professional Meeting Conference Table', 'price' => 590.0, 'category_id' => 17, 'length' => 180, 'width' => 90, 'height' => 75),
  array('sku' => 'SOFA-1*1', 'title' => 'Luxury Single Seater Sofa Armchair', 'price' => 620.0, 'category_id' => 15, 'length' => 60, 'width' => 70, 'height' => 63),
  array('sku' => 'SOFA-1*2', 'title' => 'Luxury 2-Seater Loveseat Sofa', 'price' => 920.0, 'category_id' => 15, 'length' => 116, 'width' => 70, 'height' => 63),
  array('sku' => 'SOFA-1*3', 'title' => 'Luxury 3-Seater Sofa', 'price' => 1150.0, 'category_id' => 15, 'length' => 168, 'width' => 70, 'height' => 63),
  array('sku' => 'SOFA-5*1', 'title' => 'Luxury Single Seater Sofa Armchair', 'price' => 1350.0, 'category_id' => 15, 'length' => 1000, 'width' => 900, 'height' => 850),
  array('sku' => 'SOFA-5*2', 'title' => 'Luxury 2-Seater Loveseat Sofa', 'price' => 2100.0, 'category_id' => 15, 'length' => 1500, 'width' => 900, 'height' => 850),
  array('sku' => 'SOFA-5*3', 'title' => 'Luxury 3-Seater Sofa', 'price' => 2720.0, 'category_id' => 15, 'length' => 2000, 'width' => 900, 'height' => 850),
  array('sku' => 'SOFA-
7*1', 'title' => 'Luxury Single Seater Sofa Armchair', 'price' => 650.0, 'category_id' => 15, 'length' => 79, 'width' => 75, 'height' => 86),
  array('sku' => 'SOFA-7*2', 'title' => 'Luxury 2-Seater Loveseat Sofa', 'price' => 1000.0, 'category_id' => 15, 'length' => 133, 'width' => 75, 'height' => 86),
  array('sku' => 'SOFA-
7*3', 'title' => 'Luxury 3-Seater Sofa', 'price' => 1270.0, 'category_id' => 15, 'length' => 183, 'width' => 75, 'height' => 86),
  array('sku' => 'SOFA-10*1', 'title' => 'Luxury Single Seater Sofa Armchair', 'price' => 1270.0, 'category_id' => 15, 'length' => 110, 'width' => 90, 'height' => 80),
  array('sku' => 'SOFA-10*3', 'title' => 'Luxury 3-Seater Sofa', 'price' => 2170.0, 'category_id' => 15, 'length' => 210, 'width' => 90, 'height' => 80),
  array('sku' => 'SOFA-11*1', 'title' => 'Luxury Single Seater Sofa Armchair', 'price' => 870.0, 'category_id' => 15, 'length' => 74, 'width' => 74, 'height' => 73),
  array('sku' => 'SOFA-11*2', 'title' => 'Luxury 2-Seater Loveseat Sofa', 'price' => 1370.0, 'category_id' => 15, 'length' => 125, 'width' => 74, 'height' => 73),
  array('sku' => 'SOFA-11*3', 'title' => 'Luxury 3-Seater Sofa', 'price' => 1750.0, 'category_id' => 15, 'length' => 174, 'width' => 74, 'height' => 73),
  array('sku' => 'SOFA-12*1', 'title' => 'Luxury Single Seater Sofa Armchair', 'price' => 1120.0, 'category_id' => 15, 'length' => 115, 'width' => 85, 'height' => 86),
  array('sku' => 'SOFA-12*2', 'title' => 'Luxury 2-Seater Loveseat Sofa', 'price' => 1800.0, 'category_id' => 15, 'length' => 165, 'width' => 85, 'height' => 86),
  array('sku' => 'SOFA-12*3', 'title' => 'Luxury 3-Seater Sofa', 'price' => 2170.0, 'category_id' => 15, 'length' => 215, 'width' => 85, 'height' => 86),
  array('sku' => 'SOFA-13*1', 'title' => 'Luxury Single Seater Sofa Armchair', 'price' => 920.0, 'category_id' => 15, 'length' => 810, 'width' => 760, 'height' => 780),
  array('sku' => 'SOFA-13*3', 'title' => 'Luxury 3-Seater Sofa', 'price' => 1720.0, 'category_id' => 15, 'length' => 1830, 'width' => 760, 'height' => 780),
  array('sku' => 'SOFA-14*1', 'title' => 'Luxury Single Seater Sofa Armchair', 'price' => 1100.0, 'category_id' => 15, 'length' => 1170, 'width' => 870, 'height' => 780),
  array('sku' => 'SOFA-14*3', 'title' => 'Luxury 3-Seater Sofa', 'price' => 1900.0, 'category_id' => 15, 'length' => 2170, 'width' => 870, 'height' => 780),
  array('sku' => 'TG - LOCK', 'title' => 'Model TG - LOCK', 'price' => 10.0, 'category_id' => 26, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'TGD - LOCK', 'title' => 'Model TGD - LOCK', 'price' => 20.0, 'category_id' => 26, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'SM-7', 'title' => 'Premium Orthopedic Medical Mattress', 'price' => 55.0, 'category_id' => 15, 'length' => 190, 'width' => 90, 'height' => 7),
  array('sku' => 'SM-10', 'title' => 'Premium Orthopedic Medical Mattress', 'price' => 70.0, 'category_id' => 15, 'length' => 190, 'width' => 90, 'height' => 10),
  array('sku' => 'SM-10A', 'title' => 'Premium Orthopedic Medical Mattress', 'price' => 110.0, 'category_id' => 15, 'length' => 190, 'width' => 120, 'height' => 10),
  array('sku' => 'SM-10B', 'title' => 'Premium Orthopedic Medical Mattress', 'price' => 140.0, 'category_id' => 15, 'length' => 190, 'width' => 150, 'height' => 10),
  array('sku' => 'SM-12A', 'title' => 'Premium Orthopedic Medical Mattress', 'price' => 135.0, 'category_id' => 15, 'length' => 190, 'width' => 120, 'height' => 12),
  array('sku' => 'SM-12B', 'title' => 'Premium Orthopedic Medical Mattress', 'price' => 170.0, 'category_id' => 15, 'length' => 190, 'width' => 150, 'height' => 12),
  array('sku' => 'SM-15A', 'title' => 'Premium Orthopedic Medical Mattress', 'price' => 170.0, 'category_id' => 15, 'length' => 190, 'width' => 120, 'height' => 15),
  array('sku' => 'SM-15B', 'title' => 'Premium Orthopedic Medical Mattress', 'price' => 215.0, 'category_id' => 15, 'length' => 190, 'width' => 150, 'height' => 15),
  array('sku' => 'SM-15C', 'title' => 'Premium Orthopedic Medical Mattress', 'price' => 0.0, 'category_id' => 15, 'length' => 190, 'width' => 180, 'height' => 15),
  array('sku' => 'SM-15C-A', 'title' => 'Premium Orthopedic Medical Mattress', 'price' => 265.0, 'category_id' => 15, 'length' => 200, 'width' => 180, 'height' => 15),
  array('sku' => 'SM-20C', 'title' => 'Premium Orthopedic Medical Mattress', 'price' => 350.0, 'category_id' => 15, 'length' => 200, 'width' => 180, 'height' => 20),
  array('sku' => 'lotus stool', 'title' => 'Durable Plastic Stool', 'price' => 10.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'wave chair', 'title' => 'Plastic Chair', 'price' => 20.0, 'category_id' => 20, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'Wc 7002', 'title' => 'Double Door Wardrobe Cabinet', 'price' => 4.0, 'category_id' => 26, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'MH-0001', 'title' => 'Modern Office Executive Desk', 'price' => 135.0, 'category_id' => 17, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'star bed sheet', 'title' => 'Model star bed sheet', 'price' => 42.0, 'category_id' => 15, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'samari pillow', 'title' => 'Soft Orthopedic Pillow (800g)', 'price' => 9.0, 'category_id' => 15, 'length' => null, 'width' => null, 'height' => null),
  array('sku' => 'MH-5150', 'title' => 'Premium Wooden Queen Bed', 'price' => 640.0, 'category_id' => 21, 'length' => 190, 'width' => 150, 'height' => null),
  array('sku' => 'HG-302', 'title' => 'Model HG-302', 'price' => 45.0, 'category_id' => 15, 'length' => null, 'width' => null, 'height' => null)
);

$batch = isset( $_GET['batch'] ) ? (int) $_GET['batch'] : 0;
$per_page = 40; // 40 products per batch is safe and fast

if ( $batch === 0 ) {
	echo '<h1>WooCommerce Catalog Batch Importer</h1>';
	echo '<p>Found <strong>' . count( $new_products ) . '</strong> new products to import from the Excel list.</p>';
	echo '<p>To avoid timeouts, the import is split into batches of ' . $per_page . '. Products are created as <strong>Drafts</strong> so you can review them and upload images.</p>';
	echo '<p><a href="?key=great_wall_secret_998&batch=1" style="display:inline-block;padding:14px 28px;background:#2b6cb0;color:#fff;text-decoration:none;font-weight:bold;border-radius:4px;font-family:sans-serif;box-shadow:0 2px 5px rgba(0,0,0,0.15)">🚀 Start Import (Batch 1)</a></p>';
	exit;
}

$start_index = ( $batch - 1 ) * $per_page;
$batch_items = array_slice( $new_products, $start_index, $per_page );

if ( empty( $batch_items ) ) {
	echo '<h1 style="color: green; font-family:sans-serif;">Import Completed Successfully! 🎉</h1>';
	echo '<p style="font-family:sans-serif;">All missing products have been successfully created as Drafts in WooCommerce.</p>';
	echo '<p style="font-family:sans-serif;"><a href="/wp-admin/edit.php?post_status=draft&post_type=product">Go to WooCommerce Draft Products page to edit them</a></p>';
	exit;
}

echo '<h1 style="font-family:sans-serif;">Importing Batch ' . $batch . ' (' . ( $start_index + 1 ) . ' to ' . ( $start_index + count( $batch_items ) ) . ' of ' . count( $new_products ) . ')...</h1>';
echo '<hr>';

$success_count = 0;
$skipped_count = 0;
$fail_count = 0;

foreach ( $batch_items as $item ) {
	$sku         = $item['sku'];
	$title       = $item['title'];
	$price       = (float) $item['price'];
	$category_id = (int) $item['category_id'];
	$length      = $item['length'];
	$width       = $item['width'];
	$height      = $item['height'];
	
	try {
		// Double-check if product already exists by SKU to prevent duplicate creations
		$existing_id = wc_get_product_id_by_sku( $sku );
		if ( $existing_id ) {
			echo "<p style='color: orange; font-family:sans-serif;'>[SKIPPED] Product with SKU <strong>" . $sku . "</strong> already exists (ID: " . $existing_id . ").</p>";
			$skipped_count++;
			continue;
		}
		
		// Create new product object
		$product = new WC_Product_Simple();
		
		// Set WooCommerce properties
		$product->set_name( $title );
		$product->set_sku( $sku );
		$product->set_status( 'draft' ); // Draft status lets user review and add photos before publishing
		$product->set_manage_stock( false );
		$product->set_stock_status( 'instock' );
		
		if ( $price > 0 ) {
			$product->set_regular_price( $price );
			$product->set_price( $price );
		}
		
		// Set Category
		$product->set_category_ids( array( $category_id ) );
		
		// Set Dimensions if available
		if ( null !== $length ) {
			$product->set_length( $length );
		}
		if ( null !== $width ) {
			$product->set_width( $width );
		}
		if ( null !== $height ) {
			$product->set_height( $height );
		}
		
		// Save to DB
		$product->save();
		
		echo "<p style='color: green; font-family:sans-serif;'>[CREATED] Created Draft: <strong>" . $title . "</strong> | SKU: <strong>" . $sku . "</strong> | Category ID: " . $category_id . " | Price: AED " . $price . "</p>";
		$success_count++;
	} catch ( Exception $e ) {
		echo "<p style='color: red; font-family:sans-serif;'>[ERROR] Failed to create product " . $title . " (SKU: " . $sku . "): " . $e->getMessage() . "</p>";
		$fail_count++;
	}
}

$next_batch = $batch + 1;
$next_url = "?key=great_wall_secret_998&batch=" . $next_batch;

echo '<hr>';
echo '<h3 style="font-family:sans-serif;color:#333;">Batch ' . $batch . ' Complete</h3>';
echo '<p style="font-family:sans-serif;font-size:1.2rem;color:#0066cc;font-weight:bold;">Redirecting automatically to Batch ' . $next_batch . ' in 3 seconds...</p>';
echo '<meta http-equiv="refresh" content="3;url=' . $next_url . '">';
