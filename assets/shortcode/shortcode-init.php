<?php
/**
 * Shortcode Initializer
 *
 * Theme related shortcodes.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Point Shortcode for Booking Widget.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/shortcode/vr_point.php' ) ) {
    require_once( VRC_DIR . '/assets/shortcode/vr_point.php' );
}
