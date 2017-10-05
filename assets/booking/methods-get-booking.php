<?php
/**
 * Method Get Booking
 *
 * Methods for VR_Get_Booking class.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get an object of VR_Get_Booking class.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'vr_get_booking_obj' ) ) {
	function vr_get_booking_obj( $the_booking_ID ) {
		// Bails if no ID.
		if ( ! $the_booking_ID ){
			return 'No Booking ID provided!';
		}

		return new VR_Get_Booking( $the_booking_ID );
	}
}
