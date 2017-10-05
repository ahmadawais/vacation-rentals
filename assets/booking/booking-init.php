<?php
/**
 * Booking Initializer
 *
 * Booking Related Files and Classes.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Admin/Booking.
 *
 * Booking related files.
 *
 * @since 1.0.0
 */

// Custom Post Type: `vr_booking`.
if ( file_exists( VRC_DIR . '/assets/booking/cpt-booking.php' ) ) {
    require_once( VRC_DIR . '/assets/booking/cpt-booking.php' );
}


/**
 * Class: `VR_Booking`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/booking/class-booking.php' ) ) {
    require_once( VRC_DIR . '/assets/booking/class-booking.php' );
}


/**
 * Class: `VR_Booking_Meta_Boxes`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/booking/class-booking-meta-boxes.php' ) ) {
    require_once( VRC_DIR . '/assets/booking/class-booking-meta-boxes.php' );
}


/**
 * Class: `VR_Booking_Custom_Columns`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/booking/booking-custom-columns.php' ) ) {
    require_once( VRC_DIR . '/assets/booking/booking-custom-columns.php' );
}


/**
 * Class: VR_Submit_Booking.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/booking/class-submit-booking.php' ) ) {
    require_once( VRC_DIR . '/assets/booking/class-submit-booking.php' );
}


/**
 * Class: VR_Get_Booking.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/booking/class-get-booking.php' ) ) {
    require_once( VRC_DIR . '/assets/booking/class-get-booking.php' );
}


/**
 * Methods: For class `VR_Get_Booking`.
 *
 * Since plugin class is not accessible in themes.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/booking/methods-get-booking.php' ) ) {
    require_once( VRC_DIR . '/assets/booking/methods-get-booking.php' );
}


/**
 * Actions/Filters for booking.
 *
 * Classes:
 * 			1. VR_Booking
 * 			2. VR_Booking_Custom_Columns
 * 			3. VR_Booking_Meta_Boxes
 */
if ( class_exists( 'VR_Booking' ) ) {

	/**
	 * Object: VR_Booking class.
	 *
	 * @since 1.0.0
	 */
	$vr_booking_init = new VR_Booking();


	// Create booking post type
	add_action( 'init', array( $vr_booking_init, 'create_booking' ) );

	// Create fake booking content.
	// add_action( 'init', array( $vr_booking_init, 'fake_booking_content' ) );

	// Generate and Set the booking title.
	add_action( 'edit_form_after_title', array( $vr_booking_init, 'generate_title' ) );

	// Register the shortcode [vr_submit_booking]
	add_action( 'init', array( $vr_booking_init, 'submit_booking' ) );

	// Submit a booking for logged in user.
	add_action( 'wp_ajax_vr_submit_booking_action', array( $vr_booking_init, 'submit' ) );

	// Swap status bar at the top `Published` with `Confirmed`.
	add_filter( "views_edit-vr_booking",  array( $vr_booking_init, 'published_to_confirmed' ) );

	// Send booking confirmation email.
	// add_action( 'transition_post_status',  array( $vr_booking_init, 'booking_confirmation_email' ), 10, 3 );
	add_action( 'save_post',  array( $vr_booking_init, 'booking_confirmation_email' ), 10, 3 );
	// add_action( 'updated_postmeta',  array( $vr_booking_init, 'booking_confirmation_email' ) );

}


if ( class_exists( 'VR_Booking_Custom_Columns' ) ) {


	/**
	 * Object: VR_Booking_Custom_Columns class.
	 *
	 * @since 1.0.0
	 */
	$vr_booking_custom_columns = new VR_Booking_Custom_Columns();

	// Booking Custom Columns Registered.
	add_filter( 'manage_edit-vr_booking_columns', array( $vr_booking_custom_columns, 'register' ) ) ;

	// Booking Custom Columns Display custom stuff.
	add_action( 'manage_vr_booking_posts_custom_column', array( $vr_booking_custom_columns, 'display' ) ) ;

}



if ( class_exists( 'VR_Booking_Meta_Boxes' ) ) {


	/**
	 * Object: VR_Booking_Metaboxes class.
	 *
	 * @since 1.0.0
	 */
	$vr_booking_meta_boxes = new VR_Booking_Meta_Boxes();

	// Register booking meta boxes.
    add_filter( 'rwmb_meta_boxes', array( $vr_booking_meta_boxes, 'register' ) );

}


