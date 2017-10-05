<?php
/**
 * Homepage Initializer
 *
 * Homepage template meta.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Class: `VR_Homepage_Meta_Boxes`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/homepage/class-homepage-meta-boxes.php' ) ) {
    require_once( VRC_DIR . '/assets/template/homepage/class-homepage-meta-boxes.php' );
}


/**
 * Class: `VR_Homepage_BookingForm_Fields`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/homepage/class-bookingform-fields.php' ) ) {
    require_once( VRC_DIR . '/assets/template/homepage/class-bookingform-fields.php' );
}


/**
 * Class: `VR_Homepage_Feature_Fields`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/homepage/class-feature-fields.php' ) ) {
    require_once( VRC_DIR . '/assets/template/homepage/class-feature-fields.php' );
}


/**
 * Class: `VR_Homepage_CTA_Fields`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/homepage/class-cta-fields.php' ) ) {
    require_once( VRC_DIR . '/assets/template/homepage/class-cta-fields.php' );
}

/**
 * Class: `VR_Homepage_Destination_Fields`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/homepage/class-destination-fields.php' ) ) {
    require_once( VRC_DIR . '/assets/template/homepage/class-destination-fields.php' );
}

/**
 * Class: `VR_Homepage_Steps_Fields`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/homepage/class-steps-fields.php' ) ) {
    require_once( VRC_DIR . '/assets/template/homepage/class-steps-fields.php' );
}

/**
 * Class: `VR_Homepage_FRentals_Fields`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/homepage/class-frentals-fields.php' ) ) {
    require_once( VRC_DIR . '/assets/template/homepage/class-frentals-fields.php' );
}

/**
 * Class: `VR_Homepage_TandN_Fields`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/homepage/class-tandn-fields.php' ) ) {
    require_once( VRC_DIR . '/assets/template/homepage/class-tandn-fields.php' );
}

/**
 * Class: `VR_Homepage_FCTA_Fields`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/homepage/class-fcta-fields.php' ) ) {
    // require_once( VRC_DIR . '/assets/template/homepage/class-fcta-fields.php' );
}


/**
 * Actions/Filters for homepage.
 *
 * Classes:
 * 			1. VR_Homepage_Meta_Boxes
 */
if ( class_exists( 'VR_Homepage_Meta_Boxes' ) ) {

	/**
	 * Object: VR_Homepage_Meta_Boxes class.
	 *
	 * @since 1.0.0
	 */
	$vr_homepage_meta_boxes_init = new VR_Homepage_Meta_Boxes();


	// Register homepage meta boxes.
    add_filter( 'rwmb_meta_boxes', array( $vr_homepage_meta_boxes_init, 'register' ) );


} // actions/filters ended.

