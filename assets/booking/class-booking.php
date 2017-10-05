<?php
/**
 * Class: `VR_Booking`
 *
 * Booking related classes are intialized here.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Booking.
 *
 * Booking related classes.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Booking' ) ) :

class VR_Booking {

	/**
	 * CPT: Booking.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	public $booking;


	/**
	 * Submit Booking.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	public $submit_booking;


	/**
	* Constructor.
	*/
	public function __construct() {

		$this->booking        = new VR_CPT_Booking();
		$this->submit_booking = new VR_Submit_Booking();

	}


	/**
	 * Create Booking.
	 *
	 * Custom Post type: `vr_booking`
	 *
	 * @since  1.0.0
	 */
	public function create_booking() {
		$this->booking->register();
	}


	/**
	 * Fake Booking Content.
	 *
	 * @since 1.0.0
	 */
	public function fake_booking_content() {
		$this->booking->fake_content();
	}


	/**
	 * Generate the booking title.
	 *
	 * @since 1.0.0
	 */
	public function generate_title() {
		$this->booking->set_booking_title();
	}


	/**
	 * Shortcode for Submit Booking.
	 *
	 * Shortcode: `[vr_submit_booking]`.
	 *
	 * @since  1.0.0
	 */
	public function submit_booking() {
		$this->submit_booking->vr_submit_booking();
	}

	/**
	 * Submit Booking.
	 *
	 * @since  1.0.0
	 */
	public function submit() {
		$this->submit_booking->submit();
	}


	/**
	 * Swap `Published` with `Confirmed`.
	 *
	 * @since 1.0.0
	 */
	public function published_to_confirmed( $views ) {

	    $views['all'] = str_replace( 'All ', 'All Bookings', $views['all'] );

	    if( isset( $views['publish'] ) ){
	        $views['publish'] = str_replace( 'Published ', 'Confirmed ', $views['publish'] );
	    }

        // unset( $views['draft'] );

	    return $views;
	}


	/**
	 * Generate Unique Title.
	 *
	 * @since 1.0.0
	 */
	public static function booking_title() {

		// Generate a random number with 8 length.
		$id_length = 8;
		$uniqueid  = crypt( uniqid( rand(), 1 ) );
		$uniqueid  = strip_tags( stripslashes( $uniqueid ) );
		$uniqueid  = str_replace( ".","",$uniqueid );
		$uniqueid  = strrev( str_replace( "/","",$uniqueid ) );
		$uniqueid  = substr( $uniqueid, 0, $id_length );
		$uniqueid  = strtoupper( $uniqueid );

		// Format the title.
		$title = 'Booking: #' . $uniqueid . ' - ' . date( 'd-m-Y' );

		// Return the title.
		return $title;

	}


	/**
	 * Booking Confirmation Email.
	 *
	 * Sends email on Booking Confirmation
	 * in this format:
	 * 		1. From: 	SiteName <admin@email.com>
	 * 		2. To: 		Name <booking@email.com>
	 * 		3. Cc: 		DisplayName <CurrentUser@email.com>
	 *
	 * @since 1.0.0
	 */
	public function booking_confirmation_email( $post_ID, $post, $update ) {
			// Bail if auto-save.
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			// Bail if not published, already published or wrong CPT.
			$post_status = get_post_status();
		    if ( 'publish' !== $post_status || 'vr_booking' !== get_post_type( $post ) ) {
		        return;
		    }

			// Get the meta.
			if ( function_exists( 'vr_get_booking_meta_obj' ) ) {
				// Build the object.
				$booking_obj = vr_get_booking_meta_obj( $post->ID );

				// Get Booking email.
				$booking_email      = $booking_obj->get_email();
				$booking_email      = ( isset( $booking_email ) && false != $booking_email )
				                    ? $booking_email : '';

				// Name of the booking holder.
				$name      = $booking_obj->get_name();
				$name      = ( isset( $name ) && false != $name )
				                    ? $name : '';

				// Booking Email.
				$emails[] = $name  .' <' . $booking_email . '>';

				// Check in date.
				$check_in      = $booking_obj->get_date_checkin();
				$check_in      = ( isset( $check_in ) && false != $check_in )
				                    ? $check_in : 'Not Mentioned';

				// Check out date.
				$check_out      = $booking_obj->get_date_checkout();
				$check_out      = ( isset( $check_out ) && false != $check_out )
				                    ? $check_out : 'Not Mentioned';

                // Check out date.
                $rental_id      = $booking_obj->get_the_rental();
                $rental_id      = ( isset( $rental_id ) && false != $rental_id )
                                    ? $rental_id : false;

                // Is Confirmed.
                $booking_status      = $booking_obj->get_is_confirmed();
                $booking_status      = ( isset( $booking_status ) && false != $booking_status )
                                    ? $booking_status : false;

                // Guests.
                $guests      = $booking_obj->get_guests();
                $guests      = ( isset( $guests ) && false != $guests )
                                    ? $guests : 'Not defined';

				if ( false != $rental_id ) {
					// Rental Title.
					$rental_title = get_the_title( $rental_id );
					$rental_title = isset( $rental_title ) ? $rental_title : 'No Title Found';

					// Rental Permalink.
					$rental_permalink = get_permalink( $rental_id );
					$rental_permalink = isset( $rental_permalink ) ? $rental_permalink : get_bloginfo( 'wpurl' );
				}

			} // Get Meta ended.

			// Bail if booking is not confirmed.
			if ( $booking_status != 'confirmed' ) {
				return;
			}


			// Site Name.
			$site_name = get_bloginfo( 'name' );

			// Site URL.
			$site_url = get_bloginfo( 'wpurl' );

			// Admin Email.
			$admin_email = get_bloginfo( 'admin_email' );

			// From Email.
			$from_email = 'From: '. $site_name . ' <'. $admin_email .'>';

		    // Cc: Current user's email.
			$current_user    = wp_get_current_user();
			$cc_current_user = 'Cc: ' . $current_user->display_name . ' <' . $current_user->user_email . '>';

			// Building the email Headers.
			$headers[] = $from_email;
			$headers[] = $cc_current_user;
			$headers[] = 'Content-Type: text/html; charset=UTF-8';

			// Email Subject.
			$subject = 'Your Booking Confirmation!';

			// HTML Email Body.
			$html_body  = '<div>';
			$html_body .= 'Your booking has been confirmed!';
			$html_body .= '</br>';
			$html_body .= '<strong>Booking #</strong>: %s';
			$html_body .= '</br>';
			$html_body .= '<strong>Rental</strong>: %s (%s)';
			$html_body .= '</br>';
			$html_body .= '<strong>Check In</strong>: %s';
			$html_body .= '</br>';
			$html_body .= '<strong>Check Out</strong>: %s';
			$html_body .= '</br>';
			$html_body .= '<strong>Name</strong>: %s';
			$html_body .= '</br>';
			$html_body .= '<strong>Booking Email</strong>: %s';
			$html_body .= '</br>';
			$html_body .= '<strong>Guests</strong>: %s';
			$html_body .= '</br>';
			$html_body .= 'This email was sent from %s (%s)';
			$html_body .= '</div>';

			// Body.
			$body    = sprintf(
				$html_body,
		        get_the_title( $post ),
		        $rental_title,
		        $rental_permalink,
		        $check_in,
		        $check_out,
		        $name,
		        $booking_email,
		        $guests,
		        $site_name,
		        $site_url
		    );


		    wp_mail( $emails, $subject, $body, $headers );

	} // booking_confirmation_email ended.

} // Class ended.

endif;
