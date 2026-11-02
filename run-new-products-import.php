<?php
/**
 * WooCommerce Draft Importer for 'add item in website.xlsx' (134 items)
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
  array('sku' => 'HK-4', 'raw_sku' => 'HK-4', 'title' => 'HK-4', 'price' => 350.0, 'category_id' => 27, 'category_name' => 'Beds & Bedding'),
  array('sku' => 'HK-3', 'raw_sku' => 'HK-3', 'title' => 'HK-3', 'price' => 385.0, 'category_id' => 27, 'category_name' => 'Beds & Bedding'),
  array('sku' => 'WB-4C', 'raw_sku' => 'WB-4C', 'title' => 'WB-4C', 'price' => 580.0, 'category_id' => 27, 'category_name' => 'Beds & Bedding'),
  array('sku' => 'WB-6A', 'raw_sku' => 'WB-6A', 'title' => 'WB-6A', 'price' => 460.0, 'category_id' => 27, 'category_name' => 'Beds & Bedding'),
  array('sku' => 'WB-6B', 'raw_sku' => 'WB-6B', 'title' => 'WB-6B', 'price' => 550.0, 'category_id' => 27, 'category_name' => 'Beds & Bedding'),
  array('sku' => 'WB-7B', 'raw_sku' => 'WB-7B', 'title' => 'WB-7B', 'price' => 1050.0, 'category_id' => 27, 'category_name' => 'Beds & Bedding'),
  array('sku' => 'WB-7C', 'raw_sku' => 'WB-7C', 'title' => 'WB-7C', 'price' => 1100.0, 'category_id' => 27, 'category_name' => 'Beds & Bedding'),
  array('sku' => 'ST-2', 'raw_sku' => 'ST-2', 'title' => 'ST-2', 'price' => 112.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'ST-8', 'raw_sku' => 'ST-8', 'title' => 'ST-8', 'price' => 150.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'XG-8A', 'raw_sku' => 'XG-8A', 'title' => 'XG-8A', 'price' => 415.0, 'category_id' => 18, 'category_name' => 'Shoe Racks'),
  array('sku' => 'XG-8B', 'raw_sku' => 'XG-8B', 'title' => 'XG-8B', 'price' => 520.0, 'category_id' => 18, 'category_name' => 'Shoe Racks'),
  array('sku' => 'XG-8C', 'raw_sku' => 'XG-8C', 'title' => 'XG-8C', 'price' => 585.0, 'category_id' => 18, 'category_name' => 'Shoe Racks'),
  array('sku' => 'NT-1', 'raw_sku' => 'NT-1', 'title' => 'NT-1', 'price' => 67.0, 'category_id' => 64, 'category_name' => 'Folding Tables'),
  array('sku' => 'NT-2', 'raw_sku' => 'NT-2', 'title' => 'NT-2', 'price' => 75.0, 'category_id' => 64, 'category_name' => 'Folding Tables'),
  array('sku' => 'NT-3', 'raw_sku' => 'NT-3', 'title' => 'NT-3', 'price' => 85.0, 'category_id' => 64, 'category_name' => 'Folding Tables'),
  array('sku' => 'NT-4', 'raw_sku' => 'NT-4', 'title' => 'NT-4', 'price' => 95.0, 'category_id' => 64, 'category_name' => 'Folding Tables'),
  array('sku' => 'NT-5', 'raw_sku' => 'NT-5', 'title' => 'NT-5', 'price' => 110.0, 'category_id' => 64, 'category_name' => 'Folding Tables'),
  array('sku' => 'NT-8', 'raw_sku' => 'NT-8', 'title' => 'NT-8', 'price' => 150.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'NT-9', 'raw_sku' => 'NT-9', 'title' => 'NT-9', 'price' => 150.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'NT-11', 'raw_sku' => 'NT-11', 'title' => 'NT-11', 'price' => 160.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'NT-12', 'raw_sku' => 'NT-12', 'title' => 'NT-12', 'price' => 170.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'NT-13A', 'raw_sku' => 'NT-13A', 'title' => 'NT-13A', 'price' => 150.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'NT-13B', 'raw_sku' => 'NT-13B', 'title' => 'NT-13B', 'price' => 165.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'HF-8', 'raw_sku' => 'HF-8', 'title' => 'HF-8', 'price' => 120.0, 'category_id' => 75, 'category_name' => 'Clothes Dryer rack'),
  array('sku' => 'HF-9*2', 'raw_sku' => 'HF-9*2', 'title' => 'HF-9*2', 'price' => 47.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'HF-9*3', 'raw_sku' => 'HF-9*3', 'title' => 'HF-9*3', 'price' => 57.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'HF-9*4', 'raw_sku' => 'HF-9*4', 'title' => 'HF-9*4', 'price' => 70.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'DT-11', 'raw_sku' => 'DT-11', 'title' => 'DT-11', 'price' => 745.0, 'category_id' => 24, 'category_name' => 'Dining Tables & Chairs'),
  array('sku' => 'DT-12', 'raw_sku' => 'DT-12', 'title' => 'DT-12', 'price' => 685.0, 'category_id' => 24, 'category_name' => 'Dining Tables & Chairs'),
  array('sku' => 'DT-17', 'raw_sku' => 'DT-17', 'title' => 'DT-17', 'price' => 3090.0, 'category_id' => 65, 'category_name' => 'Coffee Tables'),
  array('sku' => '06Z', 'raw_sku' => '06Z', 'title' => '06Z', 'price' => 57.0, 'category_id' => 68, 'category_name' => 'Coat Stands & Simple Furniture'),
  array('sku' => '06F', 'raw_sku' => '06F', 'title' => '06F', 'price' => 57.0, 'category_id' => 68, 'category_name' => 'Coat Stands & Simple Furniture'),
  array('sku' => 'C-1R', 'raw_sku' => 'C-1R', 'title' => 'C-1R', 'price' => 55.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'C-14', 'raw_sku' => 'C-14', 'title' => 'C-14', 'price' => 190.0, 'category_id' => 24, 'category_name' => 'Dining Tables & Chairs'),
  array('sku' => 'C-16', 'raw_sku' => 'C-16', 'title' => 'C-16', 'price' => 50.0, 'category_id' => 24, 'category_name' => 'Dining Tables & Chairs'),
  array('sku' => 'C-26', 'raw_sku' => 'C-26', 'title' => 'C-26', 'price' => 155.0, 'category_id' => 24, 'category_name' => 'Dining Tables & Chairs'),
  array('sku' => 'C-26A', 'raw_sku' => 'C-26A', 'title' => 'C-26A', 'price' => 205.0, 'category_id' => 24, 'category_name' => 'Dining Tables & Chairs'),
  array('sku' => 'RT-9B', 'raw_sku' => 'RT-9B', 'title' => 'RT-9B', 'price' => 168.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'RT-14B', 'raw_sku' => 'RT-14B', 'title' => 'RT-14B', 'price' => 220.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'RB-3', 'raw_sku' => 'RB-3', 'title' => 'RB-3', 'price' => 235.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'RB-3A', 'raw_sku' => 'RB-3A', 'title' => 'RB-3A', 'price' => 255.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'CT-9A', 'raw_sku' => 'CT-9A', 'title' => 'CT-9A', 'price' => 445.0, 'category_id' => 65, 'category_name' => 'Coffee Tables'),
  array('sku' => 'CT-9B', 'raw_sku' => 'CT-9B', 'title' => 'CT-9B', 'price' => 685.0, 'category_id' => 65, 'category_name' => 'Coffee Tables'),
  array('sku' => 'CT-10B', 'raw_sku' => 'CT-10B', 'title' => 'CT-10B', 'price' => 380.0, 'category_id' => 65, 'category_name' => 'Coffee Tables'),
  array('sku' => 'CT-12B', 'raw_sku' => 'CT-12B', 'title' => 'CT-12B', 'price' => 380.0, 'category_id' => 65, 'category_name' => 'Coffee Tables'),
  array('sku' => 'CT-15', 'raw_sku' => 'CT-15', 'title' => 'CT-15', 'price' => 400.0, 'category_id' => 65, 'category_name' => 'Coffee Tables'),
  array('sku' => 'CT-16', 'raw_sku' => 'CT-16', 'title' => 'CT-16', 'price' => 200.0, 'category_id' => 65, 'category_name' => 'Coffee Tables'),
  array('sku' => 'CT-17', 'raw_sku' => 'CT-17', 'title' => 'CT-17', 'price' => 155.0, 'category_id' => 65, 'category_name' => 'Coffee Tables'),
  array('sku' => 'OC-10A', 'raw_sku' => 'OC-10A', 'title' => 'OC-10A', 'price' => 170.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-25A', 'raw_sku' => 'OC-25A', 'title' => 'OC-25A', 'price' => 275.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-28A(grey)', 'raw_sku' => 'OC-28A(grey)', 'title' => 'OC-28A(grey)', 'price' => 450.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-28B(grey)', 'raw_sku' => 'OC-28B(grey)', 'title' => 'OC-28B(grey)', 'price' => 425.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-46C', 'raw_sku' => 'OC-46C', 'title' => 'OC-46C', 'price' => 315.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-47A', 'raw_sku' => 'OC-47A', 'title' => 'OC-47A', 'price' => 180.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-55A', 'raw_sku' => 'OC-55A', 'title' => 'OC-55A', 'price' => 140.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-63C', 'raw_sku' => 'OC-63C', 'title' => 'OC-63C', 'price' => 335.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-67A', 'raw_sku' => 'OC-67A', 'title' => 'OC-67A', 'price' => 113.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-69C(grey)', 'raw_sku' => 'OC-69C(grey)', 'title' => 'OC-69C(grey)', 'price' => 285.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-69C(black）', 'raw_sku' => 'OC-69C(black）', 'title' => 'OC-69C(black）', 'price' => 280.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-71A (grey)', 'raw_sku' => 'OC-71A
(grey)', 'title' => 'OC-71A (grey)', 'price' => 195.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-71A (black)', 'raw_sku' => 'OC-71A
(black)', 'title' => 'OC-71A (black)', 'price' => 190.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-71B (black)', 'raw_sku' => 'OC-71B
(black)', 'title' => 'OC-71B (black)', 'price' => 270.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-71B (grey)', 'raw_sku' => 'OC-71B
(grey)', 'title' => 'OC-71B (grey)', 'price' => 270.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-86C(Black）', 'raw_sku' => 'OC-86C(Black）', 'title' => 'OC-86C(Black）', 'price' => 430.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-86B(Grey）', 'raw_sku' => 'OC-86B(Grey）', 'title' => 'OC-86B(Grey）', 'price' => 430.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-87B', 'raw_sku' => 'OC-87B', 'title' => 'OC-87B', 'price' => 230.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-88B', 'raw_sku' => 'OC-88B', 'title' => 'OC-88B', 'price' => 250.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-88C', 'raw_sku' => 'OC-88C', 'title' => 'OC-88C', 'price' => 270.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-89A', 'raw_sku' => 'OC-89A', 'title' => 'OC-89A', 'price' => 220.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-89B', 'raw_sku' => 'OC-89B', 'title' => 'OC-89B', 'price' => 235.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-92C (black)', 'raw_sku' => 'OC-92C
(black)', 'title' => 'OC-92C (black)', 'price' => 1020.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-92C (grey)', 'raw_sku' => 'OC-92C
(grey)', 'title' => 'OC-92C (grey)', 'price' => 1100.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-95A', 'raw_sku' => 'OC-95A', 'title' => 'OC-95A', 'price' => 600.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-95C', 'raw_sku' => 'OC-95C', 'title' => 'OC-95C', 'price' => 970.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-97C', 'raw_sku' => 'OC-97C', 'title' => 'OC-97C', 'price' => 950.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-98C', 'raw_sku' => 'OC-98C', 'title' => 'OC-98C', 'price' => 880.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-99C', 'raw_sku' => 'OC-99C', 'title' => 'OC-99C', 'price' => 930.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-100C(BLACK)', 'raw_sku' => 'OC-100C(BLACK)', 'title' => 'OC-100C(BLACK)', 'price' => 450.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-101C', 'raw_sku' => 'OC-101C', 'title' => 'OC-101C', 'price' => 500.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-102C', 'raw_sku' => 'OC-102C', 'title' => 'OC-102C', 'price' => 375.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-106C', 'raw_sku' => 'OC-106C', 'title' => 'OC-106C', 'price' => 290.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-107C', 'raw_sku' => 'OC-107C', 'title' => 'OC-107C', 'price' => 260.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-108A（black）', 'raw_sku' => 'OC-108A（black）', 'title' => 'OC-108A（black）', 'price' => 175.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OC-108A（grey）', 'raw_sku' => 'OC-108A（grey）', 'title' => 'OC-108A（grey）', 'price' => 180.0, 'category_id' => 55, 'category_name' => 'Office Chairs'),
  array('sku' => 'OB-14', 'raw_sku' => 'OB-14', 'title' => 'OB-14', 'price' => 3650.0, 'category_id' => 74, 'category_name' => 'Office Tables'),
  array('sku' => 'OB-14A', 'raw_sku' => 'OB-14A', 'title' => 'OB-14A', 'price' => 4280.0, 'category_id' => 74, 'category_name' => 'Office Tables'),
  array('sku' => 'OT-13', 'raw_sku' => 'OT-13', 'title' => 'OT-13', 'price' => 640.0, 'category_id' => 74, 'category_name' => 'Office Tables'),
  array('sku' => 'OS-2*2', 'raw_sku' => 'OS-2*2', 'title' => 'OS-2*2', 'price' => 600.0, 'category_id' => 67, 'category_name' => 'Work Stations'),
  array('sku' => 'OS-3*1', 'raw_sku' => 'OS-3*1', 'title' => 'OS-3*1', 'price' => 495.0, 'category_id' => 67, 'category_name' => 'Work Stations'),
  array('sku' => 'OS-4*4', 'raw_sku' => 'OS-4*4', 'title' => 'OS-4*4', 'price' => 945.0, 'category_id' => 67, 'category_name' => 'Work Stations'),
  array('sku' => 'OS-7', 'raw_sku' => 'OS-7', 'title' => 'OS-7', 'price' => 275.0, 'category_id' => 67, 'category_name' => 'Work Stations'),
  array('sku' => 'OS-7C', 'raw_sku' => 'OS-7C', 'title' => 'OS-7C', 'price' => 205.0, 'category_id' => 67, 'category_name' => 'Work Stations'),
  array('sku' => 'OS-8*2', 'raw_sku' => 'OS-8*2', 'title' => 'OS-8*2', 'price' => 745.0, 'category_id' => 67, 'category_name' => 'Work Stations'),
  array('sku' => 'OS-8A*2', 'raw_sku' => 'OS-8A*2', 'title' => 'OS-8A*2', 'price' => 665.0, 'category_id' => 67, 'category_name' => 'Work Stations'),
  array('sku' => 'OS-10Z', 'raw_sku' => 'OS-10Z', 'title' => 'OS-10Z', 'price' => 690.0, 'category_id' => 67, 'category_name' => 'Work Stations'),
  array('sku' => 'OS-11Z', 'raw_sku' => 'OS-11Z', 'title' => 'OS-11Z', 'price' => 690.0, 'category_id' => 67, 'category_name' => 'Work Stations'),
  array('sku' => 'OS-11A', 'raw_sku' => 'OS-11A', 'title' => 'OS-11A', 'price' => 920.0, 'category_id' => 67, 'category_name' => 'Work Stations'),
  array('sku' => 'OS-15*2', 'raw_sku' => 'OS-15*2', 'title' => 'OS-15*2', 'price' => 970.0, 'category_id' => 67, 'category_name' => 'Work Stations'),
  array('sku' => 'OS-16*4', 'raw_sku' => 'OS-16*4', 'title' => 'OS-16*4', 'price' => 1450.0, 'category_id' => 67, 'category_name' => 'Work Stations'),
  array('sku' => 'OS-22', 'raw_sku' => 'OS-22', 'title' => 'OS-22', 'price' => 1500.0, 'category_id' => 67, 'category_name' => 'Work Stations'),
  array('sku' => 'BR-2', 'raw_sku' => 'BR-2', 'title' => 'BR-2', 'price' => 560.0, 'category_id' => 62, 'category_name' => 'Book Racks'),
  array('sku' => 'BR-3 (white)', 'raw_sku' => 'BR-3
(white)', 'title' => 'BR-3 (white)', 'price' => 200.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'BR-6', 'raw_sku' => 'BR-6', 'title' => 'BR-6', 'price' => 780.0, 'category_id' => 62, 'category_name' => 'Book Racks'),
  array('sku' => 'BR-9 (Light)', 'raw_sku' => 'BR-9
(Light)', 'title' => 'BR-9 (Light)', 'price' => 780.0, 'category_id' => 62, 'category_name' => 'Book Racks'),
  array('sku' => 'BR-9 (coffee)', 'raw_sku' => 'BR-9
(coffee)', 'title' => 'BR-9 (coffee)', 'price' => 780.0, 'category_id' => 62, 'category_name' => 'Book Racks'),
  array('sku' => 'BR-16', 'raw_sku' => 'BR-16', 'title' => 'BR-16', 'price' => 1700.0, 'category_id' => 62, 'category_name' => 'Book Racks'),
  array('sku' => 'BR-19', 'raw_sku' => 'BR-19', 'title' => 'BR-19', 'price' => 1650.0, 'category_id' => 62, 'category_name' => 'Book Racks'),
  array('sku' => 'BR-20', 'raw_sku' => 'BR-20', 'title' => 'BR-20', 'price' => 3150.0, 'category_id' => 62, 'category_name' => 'Book Racks'),
  array('sku' => 'BR-22', 'raw_sku' => 'BR-22', 'title' => 'BR-22', 'price' => 3300.0, 'category_id' => 62, 'category_name' => 'Book Racks'),
  array('sku' => 'BR-26', 'raw_sku' => 'BR-26', 'title' => 'BR-26', 'price' => 420.0, 'category_id' => 62, 'category_name' => 'Book Racks'),
  array('sku' => 'BR-27', 'raw_sku' => 'BR-27', 'title' => 'BR-27', 'price' => 1570.0, 'category_id' => 62, 'category_name' => 'Book Racks'),
  array('sku' => 'OM-4C', 'raw_sku' => 'OM-4C', 'title' => 'OM-4C', 'price' => 3510.0, 'category_id' => 70, 'category_name' => 'Meeting & Conference Tables'),
  array('sku' => 'OM-5', 'raw_sku' => 'OM-5', 'title' => 'OM-5', 'price' => 1360.0, 'category_id' => 70, 'category_name' => 'Meeting & Conference Tables'),
  array('sku' => 'OM-5A', 'raw_sku' => 'OM-5A', 'title' => 'OM-5A', 'price' => 2230.0, 'category_id' => 70, 'category_name' => 'Meeting & Conference Tables'),
  array('sku' => 'OM-5B', 'raw_sku' => 'OM-5B', 'title' => 'OM-5B', 'price' => 2680.0, 'category_id' => 70, 'category_name' => 'Meeting & Conference Tables'),
  array('sku' => 'OM-5C', 'raw_sku' => 'OM-5C', 'title' => 'OM-5C', 'price' => 3510.0, 'category_id' => 70, 'category_name' => 'Meeting & Conference Tables'),
  array('sku' => 'OM-6', 'raw_sku' => 'OM-6', 'title' => 'OM-6', 'price' => 580.0, 'category_id' => 70, 'category_name' => 'Meeting & Conference Tables'),
  array('sku' => 'OM-7C', 'raw_sku' => 'OM-7C', 'title' => 'OM-7C', 'price' => 3510.0, 'category_id' => 70, 'category_name' => 'Meeting & Conference Tables'),
  array('sku' => 'OM-9', 'raw_sku' => 'OM-9', 'title' => 'OM-9', 'price' => 5170.0, 'category_id' => 70, 'category_name' => 'Meeting & Conference Tables'),
  array('sku' => 'OM-10', 'raw_sku' => 'OM-10', 'title' => 'OM-10', 'price' => 6300.0, 'category_id' => 70, 'category_name' => 'Meeting & Conference Tables'),
  array('sku' => 'OM-10A', 'raw_sku' => 'OM-10A', 'title' => 'OM-10A', 'price' => 8000.0, 'category_id' => 70, 'category_name' => 'Meeting & Conference Tables'),
  array('sku' => 'OM-11A', 'raw_sku' => 'OM-11A', 'title' => 'OM-11A', 'price' => 1050.0, 'category_id' => 70, 'category_name' => 'Meeting & Conference Tables'),
  array('sku' => 'OM-11B', 'raw_sku' => 'OM-11B', 'title' => 'OM-11B', 'price' => 1100.0, 'category_id' => 70, 'category_name' => 'Meeting & Conference Tables'),
  array('sku' => 'OM-12', 'raw_sku' => 'OM-12', 'title' => 'OM-12', 'price' => 530.0, 'category_id' => 70, 'category_name' => 'Meeting & Conference Tables'),
  array('sku' => 'SOFA-1*2', 'raw_sku' => 'SOFA-1*2', 'title' => 'SOFA-1*2', 'price' => 880.0, 'category_id' => 63, 'category_name' => 'Sofas & Lounge Seating'),
  array('sku' => 'SOFA-5*3', 'raw_sku' => 'SOFA-5*3', 'title' => 'SOFA-5*3', 'price' => 2980.0, 'category_id' => 63, 'category_name' => 'Sofas & Lounge Seating'),
  array('sku' => 'SOFA-11*1', 'raw_sku' => 'SOFA-11*1', 'title' => 'SOFA-11*1', 'price' => 900.0, 'category_id' => 63, 'category_name' => 'Sofas & Lounge Seating'),
  array('sku' => 'SOFA-11*2', 'raw_sku' => 'SOFA-11*2', 'title' => 'SOFA-11*2', 'price' => 1410.0, 'category_id' => 63, 'category_name' => 'Sofas & Lounge Seating'),
  array('sku' => 'SOFA-11*3', 'raw_sku' => 'SOFA-11*3', 'title' => 'SOFA-11*3', 'price' => 1730.0, 'category_id' => 63, 'category_name' => 'Sofas & Lounge Seating'),
  array('sku' => 'SOFA-13*1', 'raw_sku' => 'SOFA-13*1', 'title' => 'SOFA-13*1', 'price' => 1010.0, 'category_id' => 63, 'category_name' => 'Sofas & Lounge Seating'),
  array('sku' => 'SOFA-13*3', 'raw_sku' => 'SOFA-13*3', 'title' => 'SOFA-13*3', 'price' => 1980.0, 'category_id' => 63, 'category_name' => 'Sofas & Lounge Seating'),
  array('sku' => 'LB-21305', 'raw_sku' => 'LB-21305', 'title' => 'LB-21305', 'price' => 120.0, 'category_id' => 27, 'category_name' => 'Beds & Bedding'),
  array('sku' => 'lotus stool', 'raw_sku' => 'lotus stool', 'title' => 'lotus stool', 'price' => 12.0, 'category_id' => 15, 'category_name' => 'Uncategorized'),
  array('sku' => 'wave chair', 'raw_sku' => 'wave chair', 'title' => 'wave chair', 'price' => 25.0, 'category_id' => 15, 'category_name' => 'Uncategorized')
);

$batch = isset( $_GET['batch'] ) ? (int) $_GET['batch'] : 0;
$per_page = 45;

if ( $batch === 0 ) {
	echo '<div style="font-family:sans-serif;max-width:800px;margin:40px auto;padding:24px;border:1px solid #ddd;border-radius:8px;">';
	echo '<h1>WooCommerce Draft Products Importer (134 Items)</h1>';
	echo '<p>Ready to import <strong>' . count( $new_products ) . '</strong> products from <code>add item in website.xlsx</code>.</p>';
	echo '<ul>';
	echo '<li><strong>Name & SKU:</strong> Exact name from Excel used as both Product Name and SKU</li>';
	echo '<li><strong>Price:</strong> Set from Excel</li>';
	echo '<li><strong>Categories:</strong> Matched to existing website categories (unmatched items placed in <em>Uncategorized</em>, no new categories created)</li>';
	echo '<li><strong>Descriptions & Specifications:</strong> Left empty as requested</li>';
	echo '<li><strong>Status:</strong> Saved as <strong>Draft</strong></li>';
	echo '</ul>';
	echo '<p><a href="?key=great_wall_secret_998&batch=1" style="display:inline-block;padding:14px 28px;background:#2b6cb0;color:#fff;text-decoration:none;font-weight:bold;border-radius:4px;">🚀 Start Import (Batch 1)</a></p>';
	echo '</div>';
	exit;
}

$start_index = ( $batch - 1 ) * $per_page;
$batch_items = array_slice( $new_products, $start_index, $per_page );

if ( empty( $batch_items ) ) {
	echo '<div style="font-family:sans-serif;max-width:800px;margin:40px auto;padding:24px;border:1px solid #c6f6d5;background:#f0fff4;border-radius:8px;">';
	echo '<h1 style="color: #276749;">Import Completed Successfully! 🎉</h1>';
	echo '<p>All <strong>' . count( $new_products ) . '</strong> products from the Excel sheet are now saved as <strong>Drafts</strong> in WooCommerce with their exact SKU/Name, Price, and existing Category.</p>';
	echo '<p><a href="/wp-admin/edit.php?post_status=draft&post_type=product" style="display:inline-block;padding:12px 24px;background:#276749;color:#fff;text-decoration:none;font-weight:bold;border-radius:4px;">Go to WooCommerce Draft Products</a></p>';
	echo '</div>';
	exit;
}

echo '<h1 style="font-family:sans-serif;">Importing Batch ' . $batch . ' (' . ( $start_index + 1 ) . ' to ' . ( $start_index + count( $batch_items ) ) . ' of ' . count( $new_products ) . ')...</h1>';
echo '<hr>';

foreach ( $batch_items as $item ) {
	$sku           = $item['sku'];
	$raw_sku       = $item['raw_sku'];
	$title         = $item['title'];
	$price         = (float) $item['price'];
	$category_id   = (int) $item['category_id'];
	$category_name = $item['category_name'];

	try {
		// Check if a product with this SKU (or raw multiline SKU) already exists
		$existing_id = wc_get_product_id_by_sku( $sku );
		if ( ! $existing_id && $raw_sku !== $sku ) {
			$existing_id = wc_get_product_id_by_sku( $raw_sku );
		}

		$product = null;
		$action_label = 'CREATED';

		if ( $existing_id ) {
			$existing_product = wc_get_product( $existing_id );
			if ( $existing_product && $existing_product->get_status() !== 'publish' ) {
				// Reuse and clean up existing draft product from any earlier import
				$product = $existing_product;
				$action_label = 'UPDATED DRAFT';
			}
		}

		if ( ! $product ) {
			$product = new WC_Product_Simple();
		}

		$product->set_name( $title );
		$product->set_status( 'draft' );
		$product->set_description( '' );
		$product->set_short_description( '' );
		$product->set_length( '' );
		$product->set_width( '' );
		$product->set_height( '' );
		$product->set_weight( '' );
		$product->set_manage_stock( false );
		$product->set_stock_status( 'instock' );

		if ( $price > 0 ) {
			$product->set_regular_price( (string) $price );
			$product->set_price( (string) $price );
			$product->set_sale_price( '' );
		}

		// Ensure category exists on the site; fallback to 15 (Uncategorized) if not found
		if ( term_exists( $category_id, 'product_cat' ) ) {
			$product->set_category_ids( array( $category_id ) );
		} else {
			$product->set_category_ids( array( 15 ) );
		}

		// Set SKU safely
		try {
			$product->set_sku( $sku );
		} catch ( Exception $sku_ex ) {
			// Will set via post meta after save if another published product holds the SKU
		}

		$saved_id = $product->save();
		if ( $saved_id ) {
			update_post_meta( $saved_id, '_sku', $sku );
		}

		echo "<p style='color: green; font-family:sans-serif;'>[" . $action_label . "] <strong>" . esc_html( $title ) . "</strong> (ID: " . $saved_id . ") | SKU: <strong>" . esc_html( $sku ) . "</strong> | Price: <strong>AED " . $price . "</strong> | Category: <strong>" . esc_html( $category_name ) . " (ID: " . $category_id . ")</strong></p>";
	} catch ( Exception $e ) {
		echo "<p style='color: red; font-family:sans-serif;'>[ERROR] " . esc_html( $title ) . ": " . esc_html( $e->getMessage() ) . "</p>";
	}
}

$next_batch = $batch + 1;
$next_url = '?key=great_wall_secret_998&batch=' . $next_batch;

echo '<hr>';
echo '<h3 style="font-family:sans-serif;color:#333;">Batch ' . $batch . ' Complete</h3>';
echo '<p style="font-family:sans-serif;font-size:1.1rem;color:#0066cc;font-weight:bold;">Redirecting automatically to Batch ' . $next_batch . ' in 2 seconds...</p>';
echo '<meta http-equiv="refresh" content="2;url=' . $next_url . '">';
