<?php
/**
 * Methods for Favorite
 *
 * Theme methods for favorite.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Instantiate the Favorite.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'vr_favorite' ) ) {
	function vr_favorite(){
		VR_Favorite::template_favorite();
	}
}


/**
 * Is favorited.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'vr_is_favorited' ) ) {
	function vr_is_favorited( $the_current_user_id, $rental_id ) {
		// If favorited return true.
		if ( VR_Favorite::is_favorited( $the_current_user_id, $rental_id ) ) {
			return true;
		} else {
			return false;
		}
	}
}


/**
 * If favorited then add class.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'vr_favorited_class' ) ) {
	function vr_favorited_class( $the_current_user_id, $rental_id ) {
		// If favorited then add class.
		if ( VR_Favorite::is_favorited( $the_current_user_id, $rental_id ) ) {
			return "vr_hearted vr_hearted_single";
		}
	}
}


/**
 * Dump Function.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'vr_dump' ) ) {
	function vr_dump() {

		echo VR_THEME_DIR;

	}
}
