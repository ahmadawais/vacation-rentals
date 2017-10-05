<?php
/**
 * Rental Search Initiializer
 *
 * Page: Rental Search.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class: VR_Rental_Search_Meta.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/rental/search/class-vr-rental-search-meta.php' ) ) {
    require_once( VRC_DIR . '/assets/template/rental/search/class-vr-rental-search-meta.php' );
}


/**
 * Actions/Filters for homepage.
 *
 * Classes:
 * 			1. VR_Rental_Search_Meta
 */
if ( class_exists( 'VR_Rental_Search_Meta' ) ) {

	/**
	 * Object: VR_Rental_Search_Meta class.
	 *
	 * @since 1.0.0
	 */
	$vr_page_rental_search_meta_obj = new VR_Rental_Search_Meta();


	// Register homepage meta boxes.
    add_filter( 'rwmb_meta_boxes', array( $vr_page_rental_search_meta_obj, 'register' ) );


} // actions/filters ended.

