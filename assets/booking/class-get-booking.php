<?php
/**
 * Get The Booking
 *
 * Gets vr_booking related meta.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Get_Booking.
 *
 * Get class for the vr_booking post_type.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Get_Booking' ) ) :

class VR_Get_Booking {

	/**
	 * The Booking ID.
	 *
	 * @var 	int
	 * @since 	1.0.0
	 */
	 public $the_booking_ID;


	/**
	 * The Meta Data.
	 *
	 * @var 	array
	 * @since 	1.0.0
	 */
	public $the_meta_data;


	/**
	 * Meta Keys.
	 *
	 * @var 	array
	 * @since 	1.0.0
	 */
	private $meta_keys = array(
		// Metabox      : Booking
		'is_confirmed'  => 'vr_booking_is_confirmed',
		'the_rental'    => 'vr_booking_the_rental',

		// Metabox      : Booking Information
		'date_checkin'  => 'vr_booking_date_checkin',
		'date_checkout' => 'vr_booking_date_checkout',
		'guests'        => 'vr_booking_guests',
		'rental_id'     => 'vr_booking_rental_id',
		'name'          => 'vr_booking_name',
		'email'         => 'vr_booking_email',
		'private_note'  => 'vr_booking_private_note'
	);


	/**
	 * Constructor.
	 *
	 * Checks the booking ID and assigns
	 * the meta data to $the_meta_data.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $the_booking_ID = NULL ) {
		// Check if there is $the_booking_ID.
		if ( ! $the_booking_ID ) {
			$the_booking_ID = get_the_ID();
		} else {
			$the_booking_ID = intval( $the_booking_ID );
		}

		// Assign values to the class variables.
		if ( $the_booking_ID > 0 ) {
			$this->the_booking_ID = $the_booking_ID;
			$this->the_meta_data = get_post_custom( $the_booking_ID );
		}
	}


	/**
	 * Get Booking: Meta.
	 *
	 * Gets the booking meta_value if passed
	 * a meta_key through argument.
	 *
	 * @since 1.0.0
	 */
	public function get_meta( $meta_key ) {
		// Solves undefined index problem.
		$the_meta = isset( $this->the_meta_data[ $meta_key ] ) ? $this->the_meta_data[ $meta_key ] : false;

		// Array or not?
		if ( isset( $the_meta ) && is_array( $the_meta ) ) {
			// Check 0th element of array
			// If meta is set then return value else return false.
			if ( isset( $the_meta[0] ) ) {
				// Returns the value of meta.
				return $the_meta[0];
			} else {
			    return false;
			}
		} else {
			// If meta is set then return value else return false.
			if ( isset( $the_meta ) ) {
				// Returns the value of meta.
				return $the_meta[0];
			} else {
			    return false;
			}
		}
	} // get_meta() ended.


	/**
	 * Get Booking: ID.
	 *
	 * @since 1.0.0
	 */
	public function get_ID() {
		return $this->$the_booking_ID;
	}


	/**
	 * Get Booking: Is Confirmed.
	 *
	 * Returns (string)
	 * 		1. pending
	 * 		2. confirmed
	 * 		OR
	 * 		3. false
	 *
	 * @since 1.0.0
	 */
	public function get_is_confirmed() {
		// Returns false if ID is not present.
		if ( ! $this->the_booking_ID ) {
		    return false;
		}
		return $this->get_meta( $this->meta_keys['is_confirmed'] );
	}


	/**
	 * Get Booking: the_rental.
	 *
	 * @since 1.0.0
	 */
	public function get_the_rental() {
		// Returns false if ID is not present.
		if ( ! $this->the_booking_ID ) {
		    return false;
		}
		return $this->get_meta( $this->meta_keys['the_rental'] );
	}


	/**
	 * Get Booking: date_checkin.
	 *
	 * @since 1.0.0
	 */
	public function get_date_checkin() {
		// Returns false if ID is not present.
		if ( ! $this->the_booking_ID ) {
		    return false;
		}
		return $this->get_meta( $this->meta_keys['date_checkin'] );
	}


	/**
	 * Get Booking: date_checkout.
	 *
	 * @since 1.0.0
	 */
	public function get_date_checkout() {
		// Returns false if ID is not present.
		if ( ! $this->the_booking_ID ) {
		    return false;
		}
		return $this->get_meta( $this->meta_keys['date_checkout'] );
	}


	/**
	 * Get Booking: guests.
	 *
	 * @since 1.0.0
	 */
	public function get_guests() {
		// Returns false if ID is not present.
		if ( ! $this->the_booking_ID ) {
		    return false;
		}
		return $this->get_meta( $this->meta_keys['guests'] );
	}


	/**
	 * Get Booking: rental_id.
	 *
	 * @since 1.0.0
	 */
	public function get_rental_id() {
		// Returns false if ID is not present.
		if ( ! $this->the_booking_ID ) {
		    return false;
		}
		return $this->get_meta( $this->meta_keys['rental_id'] );
	}


	/**
	 * Get Booking: name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		// Returns false if ID is not present.
		if ( ! $this->the_booking_ID ) {
		    return false;
		}
		return $this->get_meta( $this->meta_keys['name'] );
	}


	/**
	 * Get Booking: email.
	 *
	 * @since 1.0.0
	 */
	public function get_email() {
		// Returns false if ID is not present.
		if ( ! $this->the_booking_ID ) {
		    return false;
		}
		return $this->get_meta( $this->meta_keys['email'] );
	}

	/**
	 * Get Booking: private_note.
	 *
	 * @since 1.0.0
	 */
	public function get_private_note() {
		// Returns false if ID is not present.
		if ( ! $this->the_booking_ID ) {
		    return false;
		}
		return $this->get_meta( $this->meta_keys['private_note'] );
	}



} // class `VR_Get_Booking`  ended.

endif;


/**
 * METHOD: Get an object of VR_Get_Booking class.
 *
 * Add for themes to recognize the class and help
 * instantiate an object without any hooks.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'vr_get_booking_meta_obj' ) ) {
	function vr_get_booking_meta_obj( $the_booking_ID ) {
		// Bails if no ID.
		if ( ! $the_booking_ID ){
			return 'No Booking ID provided!';
		}

		return new VR_Get_Booking( $the_booking_ID );
	}
}
