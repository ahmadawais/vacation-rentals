<?php
/**
 * Frontend Rental Iniatializer
 *
 * Responsible for frontend
 * 		1. Rental Submission.
 * 		2. Rental Editing.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class: VR_Edit_Rental.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/rental/frontend/class-edit-rental.php' ) ) {
    require_once( VRC_DIR . '/assets/rental/frontend/class-edit-rental.php' );
}


/**
 * Actions/Filters for membership.
 *
 * Class:
 * 			1. VR_Edit_Rental
 */
if ( class_exists( 'VR_Edit_Rental' ) ) {

	/**
	 * Object: VR_Edit_Rental class.
	 *
	 * @since 1.0.0
	 */
	$vr_edit_rental_init = new VR_Edit_Rental();

	// Register the shortcode [vr_rental_frontend]
	add_action( 'init', array( $vr_edit_rental_init, 'vr_rental_frontend' ) ) ;


	// Edit Profile only for logged in user.
	add_action( 'wp_ajax_add_property', array( $vr_edit_rental_init, 'add_rental' ) );



}
