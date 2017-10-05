<?php
/**
 * Class: VR_Submit_Booking
 *
 * Reset class.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Submit_Booking.
 *
 * VR Membership booking class.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Submit_Booking' ) ) :

class VR_Submit_Booking {

	/**
	 * Shortcode.
	 *
	 * @since 1.0.0
	 */
	public function vr_submit_booking() {

		/**
		 * Shortcode: `[vr_submit_booking]`.
		 *
		 * @since 1.0.0
		 */
		add_shortcode( 'vr_submit_booking', function () {

			/**
			 * VIEW: Submit booking.
			 *
			 * @since 1.0.0
			 */
			if ( file_exists( VRC_DIR . '/assets/booking/view-submit-booking.php' ) ) {
			    require_once( VRC_DIR . '/assets/booking/view-submit-booking.php' );
			}

		} );// annonymous function and action ended.

	} // Function ended.


	/**
	 * Submit Booking Function.
	 *
	 * @since 1.0.0
	 */
	public function submit() {

        // Errors array.
        $errors = array();

        // Get user info.
        global $current_user;
        get_currentuserinfo();

		// Verify the nonce.
        if( wp_verify_nonce( $_POST['vr_submit_booking_nonce'], 'vr_submit_booking' ) ) {

            // Let's set the booking title.
            $booking_title = VR_Booking::booking_title();


            // Check In date via `vr_booking_date_checkin`.
            if ( ! empty( $_POST['vr_booking_date_checkin'] ) ) {

                $user_vr_booking_date_checkin = sanitize_text_field( $_POST['vr_booking_date_checkin'] );

            } else {

                $errors[] = __( 'ERROR!', 'VRC' );
                $errors[] = __( 'Check In date cannot be empty', 'VRC' );

            }

            // Check Out date via `vr_booking_date_checkout`.
            if ( ! empty( $_POST['vr_booking_date_checkout'] ) ) {

                $user_vr_booking_date_checkout = sanitize_text_field( $_POST['vr_booking_date_checkout'] );

            } else {

                $errors[] = __( 'ERROR!', 'VRC' );
                $errors[] = __( 'Check out date cannot be empty', 'VRC' );

            }

            // Guest via `vr_booking_guests`.
            if ( ! empty( $_POST['vr_booking_guests'] ) ) {

                $user_vr_booking_guests = intval( $_POST['vr_booking_guests'] );

            } else {

                $errors[] = __( 'ERROR!', 'VRC' );
                $errors[] = __( 'Guests cannot be empty', 'VRC' );

            }


            // Guest via `rental_id_for_booking`.
            if ( ! empty( $_POST['rental_id_for_booking'] ) ) {

                $user_rental_id_for_booking = intval( $_POST['rental_id_for_booking'] );

            } else {

                $errors[] = __( 'ERROR!', 'VRC' );
                $errors[] = __( 'Rental ID cannot be empty. Refresh the page and try again.', 'VRC' );

            }


            // Booking Status `vr_booking_is_confirmed`.
            if ( ! empty( $_POST['vr_booking_is_confirmed'] ) ) {

                $user_vr_booking_is_confirmed = sanitize_text_field( $_POST['vr_booking_is_confirmed'] );

            }

            // Rental Booking User's Name.
            $vr_booking_name = $current_user->first_name . ' ' . $current_user->last_name . ' (' . $current_user->user_login . ')';


            // If everything is fine.
            if ( count( $errors ) == 0 ) {

                $meta_array = array(
                    'vr_booking_date_checkin'  => $user_vr_booking_date_checkin,
                    'vr_booking_date_checkout' => $user_vr_booking_date_checkout,
                    'vr_booking_guests'        => $user_vr_booking_guests,
                    'vr_booking_rental_id'     => $user_rental_id_for_booking,
                    'vr_booking_name'          => $vr_booking_name,
                    'vr_booking_email'         => $current_user->user_email,
                    'vr_booking_is_confirmed'  => $user_vr_booking_is_confirmed
                    );

                $submitted_booking = array(
                    'post_title'   => $booking_title,
                    'post_status'  => 'pending', // publish|pending|draft.
                    'post_type'    => 'vr_booking',
                    'post_author'  => $current_user->ID,
                    'meta_input'   => $meta_array,
                );

                $output_message = __( 'Submited! <br/> Your booking is now awaiting confirmation!', 'VRC' );

                // Insert the booking into the database.
                // wp_insert_booking( $submitted_booking );
                // Or insert the booking and get the ID.
                $booking_id = wp_insert_post( $submitted_booking );
                // $the_submit_booking_id = ( $booking_id ) ? $booking_id : 'Unable to find the booking ID.';

                $response = array(
                    'success'            => true,
                    'message'            => $output_message
                    // 'the_submit_booking_id' => $the_submit_booking_id // Sends the booking ID.
                );
                echo json_encode( $response );
                die;

            } else {

                // In case of errors.
                $response = array(
                    'success' => false,
                    'errors'  => $errors
                );

                echo json_encode( $response );
                die;
            }


        } else {

            $errors[] = __( 'ERROR!', 'VRC' );
            $errors[] = __( 'Security check failed!', 'VRC' );

        } // if/else nonce ended.

        // In case of errors.
        $response = array(
			'success' => false,
			'errors'  => $errors
        );

        echo json_encode( $response );
    	die;

	} // submit function ended.


} // Class ended.

endif;
