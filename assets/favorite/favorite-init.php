<?php
/**
 * Favorite Initializer
 *
 * Favorite Related Files and Classes.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class: `VR_Favorite`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/favorite/class-favorite.php' ) ) {
    require_once( VRC_DIR . '/assets/favorite/class-favorite.php' );
}

/**
 * Methods: `VR_Favorite`.
 *
 * Since plugin class is not accessible in themes.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/favorite/methods-favorite.php' ) ) {
    require_once( VRC_DIR . '/assets/favorite/methods-favorite.php' );
}


/**
 * Actions/Filters for favorite.
 *
 * Classes:
 * 			1. VR_Favorite
 */
if ( class_exists( 'VR_Favorite' ) ) :

	/**
	 * Object: VR_Favorite class.
	 *
	 * @since 1.0.0
	 */
	$vr_favorite_init = new VR_Favorite();

	// Add AJAX data to our custom action which will be in the template.
	add_action( 'vr_add_to_favorites_template', array( $vr_favorite_init, 'build_fav_data' ) );

	// Add to Favorite user meta.
    add_action( 'wp_ajax_add_to_favorites_action', array( $vr_favorite_init, 'add_to_favorites' ) );

    // Remove Favorites from user meta.
    add_action( 'wp_ajax_remove_from_favorites_action', array( $vr_favorite_init, 'remove_from_favorites' ) );


endif;
