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
