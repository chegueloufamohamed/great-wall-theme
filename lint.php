<?php
/**
 * Standalone PHP Linter.
 * Visit: https://greatwallfurniture.com/wp-content/themes/great-wall-theme/lint.php
 */

$file = 'functions.php';
if ( ! file_exists( $file ) ) {
	die( 'functions.php not found.' );
}

$output = shell_exec( 'php -l ' . escapeshellarg( $file ) . ' 2>&1' );
echo '<h1>PHP Syntax Check for functions.php</h1>';
echo '<pre style="background:#f4f4f4;padding:15px;border:1px solid #ccc;">';
echo htmlspecialchars( $output );
echo '</pre>';
