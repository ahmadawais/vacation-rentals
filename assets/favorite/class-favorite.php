<?php
/**
 * Class: `VR_Favorite`
 *
 * Favorite related class.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class: VR_Favorite.
 *
 * Favorite related classes.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Favorite' ) ) :

class VR_Favorite {

	/**
	 * Builds AJAX Data.
	 *
	 * Builds AJAX data for favoriting a post
	 * The do_action for this is inside the template.
	 *
	 * @since 1.0.0
	 */
	public static function build_fav_data() {
	    if ( ! is_admin() && is_user_logged_in() ) {
			// Sets User ID of Favoriter.
			$the_rental_fav_id = get_the_ID();

			// Sets User ID of Favoriter.
			$the_user_fav_id   = get_current_user_id();

	        // Combine all data into one array.
	        $add_to_favorite_data = array(
				'ajaxURL'  => admin_url( 'admin-ajax.php' ),
				'userID'   => $the_user_fav_id,
				'rentalID' => $the_rental_fav_id,

				// this will be used in WP AJAX
				// action i.e. `wp_ajax_add_to_favorites`
				// and in JS file.
				'action'   => 'add_to_favorites_action',
	        );
	        // Localize the data.
	        wp_localize_script( 'vrc_favoriteJS', 'favoriteData', $add_to_favorite_data );
	    }
	} // build_fav_data ended.


	/**
	 * (Optional) Template Favorite.
	 *
	 * We will hook the `build_fav_data`
	 * function to this action.
	 *
	 * @since 1.0.0
	 */
	public static function template_favorite() {
		// The build function.
		do_action( 'vr_add_to_favorites_template' );
	}


	/**
	 * Already Favorited.
	 *
	 * @since 1.0.0
	 */
	public static function is_favorited( $user_id, $rental_id ) {

		// The rentals array.
		$user_favorites_array  = get_user_meta( $user_id, 'favorite_rentals' );

		if ( is_array( $user_favorites_array ) ) {
			// Return true if the current rental is in user's favorites
			if ( in_array( $rental_id, $user_favorites_array ) ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}

	} // is_favorited ended.


	/**
	 * Add To Favorite.
	 *
	 * Add a property id into favorite
	 * properties meta of the user.
	 *
	 * @since 1.0.0
	 */
	public function add_to_favorites() {
		// Check the POST data.
        if ( isset( $_POST['rental_id'] ) && isset( $_POST['user_id'] ) ) {

			$user_id   = intval( $_POST['user_id'] );
			$rental_id = intval( $_POST['rental_id'] );

            if ( $rental_id > 0 && $user_id > 0 ) {

                if ( add_user_meta( $user_id,'favorite_rentals', $rental_id ) ) {
                    echo wp_json_encode( array(
                        'success' => true,
                        'message' => __( 'Added to Favorites', 'VRC' )
                    ));
                    die;
                } else {
                    echo wp_json_encode( array(
                        'success' => false,
                        'message' => __( 'Failed', 'VRC' )
                    ));
                    die;
                }
            }
        }

        // If User ID or Rental ID was not set.
        echo wp_json_encode( array(
            'success' => false,
            'message' => __( 'Invalid parameters', 'VRC' )
        ));
        die;

	} // add_to_favorites ended.



	/**
	 * Remove Favorite.
	 *
	 * Remove a rental from favorites
	 * rentals of the current user.
	 *
	 * @since  1.0.0
	 */
    public function remove_from_favorites() {
		// Check the POST data.
        if ( isset( $_POST['rental_id'] ) && is_user_logged_in() ) {

        	// Rental ID.
            $rental_id = intval( $_POST['rental_id'] );

            if ( $rental_id > 0 ) {
                if ( delete_user_meta( get_current_user_id(), 'favorite_rentals', $rental_id ) ) {
                    echo wp_json_encode( array(
                        'success' => true
                    ));
                    die;
                } else {
                    echo wp_json_encode( array(
                        'success' => false,
                        'message' => __( 'Failed to remove!', 'VRC' )
                    ));
                    die;
                }
            }
        }

        echo wp_json_encode( array(
            'success' => false,
            'message' => __( 'Invalid parameters!', 'VRC' )
        ));
        die;

    } // remove_from_favorites ended.


} // class VR_Favorite() ended.

endif;
