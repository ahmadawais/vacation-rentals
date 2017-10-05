<?php
/**
 * Rental Favorite Initiializer
 *
 * Page: Rental Favorite.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class: VR_Rental_Favorite_Meta.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/rental/favorite/class-vr-rental-favorite-meta.php' ) ) {
    require_once( VRC_DIR . '/assets/template/rental/favorite/class-vr-rental-favorite-meta.php' );
}


/**
 * Actions/Filters for homepage.
 *
 * Classes:
 * 			1. VR_Rental_Favorite_Meta
 */
if ( class_exists( 'VR_Rental_Favorite_Meta' ) ) {

	/**
	 * Object: VR_Rental_Favorite_Meta class.
	 *
	 * @since 1.0.0
	 */
	$vr_page_rental_favorite_meta_obj = new VR_Rental_Favorite_Meta();


	// Register homepage meta boxes.
    add_filter( 'rwmb_meta_boxes', array( $vr_page_rental_favorite_meta_obj, 'register' ) );


} // actions/filters ended.

