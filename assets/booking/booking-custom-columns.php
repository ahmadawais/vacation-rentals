<?php
/**
 * Custom Columns
 *
 * Custom Columns for post type `vr_booking`.
 * TODO: Order by date added on. Most recent at the top.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Booking_Custom_Columns.
 *
 * Creates custom columns for post type `vr_booking`.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Booking_Custom_Columns' ) ) :

class VR_Booking_Custom_Columns {

	/**
	 * Register custom columns.
	 *
	 * @since 1.0.0
	 */

	public function register( $defaults ) {

		/**
		 * Register new columns.
		 */
        $new_columns = array(
			"rental_id"     => __( 'Rental Property', 'VRC' ),
			"guest"         => __( 'Guests', 'VRC' ),
			"date_checkin"  => __( 'Checkin Date', 'VRC' ),
			"date_checkout" => __( 'Checkout Date', 'VRC' )
        );

        // Default columns
        // Don't change the variable name.
        $last_columns = array();

        if ( count( $defaults ) > 1 ) {

        	// After 2nd element i.e. `title`, offset 4 last columns to incubate
        	// rental_id, guest, arrival, and departure and then comes the author and the date.
            $last_columns = array_splice( $defaults, 2, 4 ); // TODO: What?

    		// Rename the default columns
			$last_columns[ 'title' ] = __( 'Booking', 'VRC' );
			$last_columns[ 'date' ]  = __( 'Added On', 'VRC' );

        }

        // Merge the new_columns.
        $defaults = array_merge( $defaults, $new_columns );
        $defaults = array_merge( $defaults, $last_columns );

        return $defaults;

	}


	/**
	 * Display custom column.
	 *
	 * @since   1.0.0
	 */
	public function display( $column_name ) {

	    global $post;
	    switch ( $column_name ) {

	        case 'rental_id':
	            $rental_id = get_post_meta( $post->ID, 'vr_booking_rental_id', true );
	            if( ! empty ( $rental_id ) ) {

	            	// Get WP_Post object from the ID.
	            	$rental_post = get_post( $rental_id );

	            	// Rental Post Data.
					$rental_title  = $rental_post->post_title;
					$booking_title = 	'
	            						Booking for: %s
	            							<a href="/wp-admin/post.php?post=%s&action=edit">
	            								 <span class="dashicons dashicons-edit"></span>
	            							</a>
		            				';

					echo sprintf( $booking_title, $rental_title, $rental_id );

	                // echo $rental_id;
	            } else {
	                echo "—";
	            }
	            break;

	        case 'guest':
	            $guest = get_post_meta( $post->ID, 'vr_booking_guests', true );
	            if( ! empty ( $guest ) ) {
	                echo $guest;
	            } else {
	                echo "—";
	            }
	            break;

	        case 'date_checkin':
	            $date_checkin = get_post_meta( $post->ID, 'vr_booking_date_checkin', true );
	            if( ! empty ( $date_checkin ) ) {
	                echo $date_checkin;
	            } else {
	                echo "—";
	            }
	            break;

	        case 'date_checkout':
	            $date_checkout = get_post_meta( $post->ID, 'vr_booking_date_checkout', true );
	            if( ! empty ( $date_checkout ) ) {
	                echo $date_checkout;
	            } else {
	                echo "—";
	            }
	            break;

	        default:
	            break;

	    } // Switch ended.

	} // Function ended.


} // class ended.

endif;
