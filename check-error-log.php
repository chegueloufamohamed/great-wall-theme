<?php
/**
 * Temporary Error Log Inspector.
 * Visit: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/check-error-log.php?key=great_wall_secret_998
 */

$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if ( ! file_exists( $wp_load_path ) ) {
	die( 'WordPress load file not found.' );
}

require_once $wp_load_path;

if ( ! isset( $_GET['key'] ) || $_GET['key'] !== 'great_wall_secret_998' ) {
	die( 'Unauthorized access.' );
}

echo '<h1>PHP Error Log</h1>';

// 1. Check WooCommerce System Status Log
if ( function_exists( 'wc_get_logger' ) ) {
	echo '<h2>WooCommerce Logs:</h2>';
	// Find latest logs
	$log_directory = WC_LOG_DIR;
	$log_files = glob( $log_directory . '*.log' );
	if ( ! empty( $log_files ) ) {
		usort( $log_files, function( $a, $b ) {
			return filemtime( $b ) - filemtime( $a );
		} );
		$latest_log = $log_files[0];
		echo '<p>Latest Log File: <strong>' . basename( $latest_log ) . '</strong></p>';
		$lines = file( $latest_log );
		echo '<pre style="background:#f4f4f4;padding:10px;border:1px solid #ccc;max-height:400px;overflow:auto;">';
		echo htmlspecialchars( implode( "", array_slice( $lines, -30 ) ) );
		echo '</pre>';
	} else {
		echo '<p>No WooCommerce log files found.</p>';
	}
}

// 2. Check WordPress Debug Log
$debug_log_path = WP_CONTENT_DIR . '/debug.log';
echo '<h2>WordPress debug.log:</h2>';
if ( file_exists( $debug_log_path ) ) {
	$lines = file( $debug_log_path );
	echo '<pre style="background:#f4f4f4;padding:10px;border:1px solid #ccc;max-height:400px;overflow:auto;">';
	echo htmlspecialchars( implode( "", array_slice( $lines, -30 ) ) );
	echo '</pre>';
} else {
	echo '<p>WordPress debug.log not found at ' . $debug_log_path . '</p>';
}

// 3. Check PHP ini error log
$ini_log = ini_get( 'error_log' );
echo '<h2>PHP ini error_log:</h2>';
if ( $ini_log && file_exists( $ini_log ) ) {
	$lines = file( $ini_log );
	echo '<pre style="background:#f4f4f4;padding:10px;border:1px solid #ccc;max-height:400px;overflow:auto;">';
	echo htmlspecialchars( implode( "", array_slice( $lines, -30 ) ) );
	echo '</pre>';
} else {
	echo '<p>PHP ini error_log not readable or empty: ' . htmlspecialchars( $ini_log ) . '</p>';
}

// 4. Check Database History for Draft Products (IDs 2458 to 2735) & WP Activity Log (WSAL)
global $wpdb;
echo '<hr><h1>Draft Products History & Audit Log (IDs 2458–2735)</h1>';

$status_counts = $wpdb->get_results( "
	SELECT post_type, post_status, COUNT(*) as cnt, MIN(ID) as min_id, MAX(ID) as max_id, MIN(post_date) as min_date, MAX(post_modified) as max_mod
	FROM {$wpdb->posts}
	WHERE ID BETWEEN 2458 AND 2750
	GROUP BY post_type, post_status
" );
echo '<h2>1. Current Database Status of IDs 2458–2750 in wp_posts:</h2>';
echo '<pre style="background:#f4f4f4;padding:10px;border:1px solid #ccc;">';
print_r( $status_counts );
echo '</pre>';

$between_posts = $wpdb->get_results( "
	SELECT ID, post_author, post_date, post_modified, post_title, post_status, post_type, post_parent
	FROM {$wpdb->posts}
	WHERE ID BETWEEN 2450 AND 2600
	ORDER BY ID ASC
" );
echo '<h2>2. Exact Rows in wp_posts for IDs 2450–2600:</h2>';
echo '<pre style="background:#f4f4f4;padding:10px;border:1px solid #ccc;max-height:400px;overflow:auto;">';
if ( empty( $between_posts ) ) {
	echo "No rows found in range 2458-2591 (they were permanently deleted from wp_posts).";
} else {
	foreach ( $between_posts as $p ) {
		echo sprintf( "ID: %d | Type: %s | Status: %s | Author: %d | Created: %s | Modified: %s | Title: %s\n",
			$p->ID, $p->post_type, $p->post_status, $p->post_author, $p->post_date, $p->post_modified, $p->post_title );
	}
}
echo '</pre>';

// Check if WP Activity Log (WSAL) tables exist and show recent activity
$wsal_table = $wpdb->prefix . 'wsal_occurrences';
$wsal_meta  = $wpdb->prefix . 'wsal_metadata';
if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $wsal_table ) ) === $wsal_table ) {
	echo '<h2>3. WP Activity Log (Audit Trail of Recent Actions):</h2>';
	$events = $wpdb->get_results( "
		SELECT o.id, o.alert_id, o.created_on, o.client_ip, o.user_id, o.username, o.post_id, o.post_type, o.post_status
		FROM {$wsal_table} o
		ORDER BY o.id DESC
		LIMIT 150
	" );
	echo '<pre style="background:#f4f4f4;padding:10px;border:1px solid #ccc;max-height:500px;overflow:auto;">';
	foreach ( $events as $ev ) {
		$time_str = date( 'Y-m-d H:i:s', (int) $ev->created_on );
		$meta_rows = $wpdb->get_results( $wpdb->prepare( "SELECT name, value FROM {$wsal_meta} WHERE occurrence_id = %d", $ev->id ) );
		$meta_summary = array();
		foreach ( $meta_rows as $m ) {
			if ( in_array( $m->name, array( 'PostTitle', 'PostID', 'PostType', 'PostStatus', 'NewStatus', 'OldStatus', 'EditorLinkPost', 'Username', 'CurrentUserID' ), true ) ) {
				$meta_summary[] = $m->name . '=' . $m->value;
			}
		}
		echo sprintf( "[%s UTC] Event #%d | Alert: %d | User: %s (ID:%s) | IP: %s | PostID: %s (%s / %s) | %s\n",
			$time_str, $ev->id, $ev->alert_id, $ev->username, $ev->user_id, $ev->client_ip, $ev->post_id, $ev->post_type, $ev->post_status, implode( ', ', $meta_summary ) );
	}
	echo '</pre>';
}

