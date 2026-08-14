<?php
/**
 * Script to automatically map and set uploaded WooCommerce Category Thumbnail IDs.
 * Access via: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/sync-category-thumbnails.php?run=1
 */

// Load WordPress core manually
require_once('../../../wp-load.php');

if ( ! isset( $_GET['run'] ) || $_GET['run'] !== '1' ) {
    die('Forbidden.');
}

// Ensure the user is logged in as administrator
if ( ! current_user_can('manage_options') ) {
    die('Unauthorized access. Please log in as an administrator first.');
}

$mappings = array(
    'desks' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Collection-Deks.webp',
    'office-chairs' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Office-Chairs.webp',
    'commercial-chairs' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Commercial-Chairs.webp',
    'cabinet' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Cabinet.webp',
    'bunk-beds' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Bunk-Beds.webp',
    'single-beds' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Single-Beds.webp',
    'table' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Table.webp',
    'dinning-tables' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Dinning-Tables.webp',
    'shelves' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Shelves.webp',
    'partition-stands' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Room-Divider.webp',
    'office-furniture' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Desks.webp',
    'chairs' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Collection-Chair.webp',
    'storage-cabinet' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Collection-Book-Shelf.webp',
    'sofa' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Sofa.webp',
    'reception-lounge-set' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Reception-Lounge.webp',
    'office-storage' => 'https://greatwallfurniture.com/wp-content/uploads/2026/08/Cabinet.webp'
);

echo "<h2>Starting WooCommerce Category Thumbnail Sync...</h2>";

foreach ( $mappings as $slug => $url ) {
    $term = get_term_by( 'slug', $slug, 'product_cat' );
    if ( ! $term ) {
        echo "❌ Category slug <strong>'$slug'</strong> not found in database.<br>";
        continue;
    }
    
    $attachment_id = attachment_url_to_postid( $url );
    if ( ! $attachment_id ) {
        global $wpdb;
        $file_basename = basename( $url );
        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attached_file' AND meta_value LIKE %s", '%' . $wpdb->esc_like( $file_basename ) ) );
    }
    
    if ( $attachment_id ) {
        update_term_meta( $term->term_id, 'thumbnail_id', $attachment_id );
        echo "✅ Category <strong>'$slug'</strong> successfully linked to Attachment ID: $attachment_id.<br>";
    } else {
        echo "⚠️ Could not locate attachment in media library for URL: <code>$url</code><br>";
    }
}

echo "<h3>Sync Complete!</h3>";
