<?php
/**
 * Method Get Rental
 *
 * Methods for VR_Get_Rental class.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get an object of VR_Get_Rental class.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'vr_get_rental_obj' ) ) {
	function vr_get_rental_obj( $the_rental_ID ) {
		// Bails if no ID.
		if ( ! $the_rental_ID ){
			return 'No Rental ID provided!';
		}

		return new VR_Get_Rental( $the_rental_ID );
	}
}
