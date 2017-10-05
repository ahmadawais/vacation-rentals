<?php
/**
 * Partner Initializer
 *
 * Partner Related Files and Classes.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Admin/Partner.
 *
 * Partner related files.
 *
 * @since 1.0.0
 */

// Custom Post Type: `vr_partner`.
if ( file_exists( VRC_DIR . '/assets/partner/cpt-partner.php' ) ) {
    require_once( VRC_DIR . '/assets/partner/cpt-partner.php' );
}


/**
 * Class: `VR_Partner`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/partner/class-partner.php' ) ) {
    require_once( VRC_DIR . '/assets/partner/class-partner.php' );
}


/**
 * Class: `VR_Partner_Meta_Boxes`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/partner/class-partner-meta-boxes.php' ) ) {
    require_once( VRC_DIR . '/assets/partner/class-partner-meta-boxes.php' );
}


/**
 * Class: `VR_Partner_Custom_Columns`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/partner/partner-custom-columns.php' ) ) {
    require_once( VRC_DIR . '/assets/partner/partner-custom-columns.php' );
}


/**
 * Actions/Filters for partner.
 *
 * Classes:
 * 			1. VR_Partner
 * 			2. VR_Partner_Custom_Columns
 * 			3. VR_Partner_Meta_Boxes
 */
if ( class_exists( 'VR_Partner' ) ) {

	/**
	 * Object: VR_Partner class.
	 *
	 * @since 1.0.0
	 */
	$vr_partner_init = new VR_Partner();


	// Create partner post type
	add_action( 'init', array( $vr_partner_init, 'create_partner' ) );

	// Create fake partner content.
	add_action( 'init', array( $vr_partner_init, 'fake_partner_content' ) );

}


if ( class_exists( 'VR_Partner_Custom_Columns' ) ) {


	/**
	 * Object: VR_Partner_Custom_Columns class.
	 *
	 * @since 1.0.0
	 */
	$vr_partner_custom_columns = new VR_Partner_Custom_Columns();

	// Rental Custom Columns Registered
	add_filter( 'manage_edit-vr_partner_columns', array( $vr_partner_custom_columns, 'register' ) ) ;

	// Rental Custom Columns Display custom stuff
	add_action( 'manage_vr_partner_posts_custom_column', array( $vr_partner_custom_columns, 'display' ) ) ;

}



if ( class_exists( 'VR_Partner_Meta_Boxes' ) ) {


	/**
	 * Object: VR_Partner_Metaboxes class.
	 *
	 * @since 1.0.0
	 */
	$vr_partner_meta_boxes = new VR_Partner_Meta_Boxes();

	// Register partner meta boxes.
    add_filter( 'rwmb_meta_boxes', array( $vr_partner_meta_boxes, 'register' ) );

}


