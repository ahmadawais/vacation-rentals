<?php
/**
 * Shortcode: [vr_point]
 *
 * Point Shortcode for Booking Widget.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Point Shortcode.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'vr_shortcode_point' ) ) {
	add_action( 'init', 'vr_shortcode_point' );
	function vr_shortcode_point() {
		// Add the [vr_point] shortcode.
		add_shortcode( 'vr_point', function(  $atts, $content = '' ) {
			return '<div class="vr_wFeature"><span class="vr-check-mark"></span> <p>' . $content . '<p></div>';
		} );
	}
}
