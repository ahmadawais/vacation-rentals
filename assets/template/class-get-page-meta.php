<?php
/**
 * Get Page Meta
 *
 * Gets page related meta.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Get_Page_Meta.
 *
 * Get class for the page meta.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Get_Page_Meta' ) ) :

class VR_Get_Page_Meta {

	/**
	 * The Page_Meta ID.
	 *
	 * @var 	int
	 * @since 	1.0.0
	 */
	 public $the_page_ID;


	/**
	 * The Meta Data.
	 *
	 * @var 	array
	 * @since 	1.0.0
	 */
	public $the_meta_data;


	/**
	 * Constructor.
	 *
	 * Checks the page ID and assigns
	 * the meta data to $the_meta_data.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $the_page_ID = NULL ) {
		// Check if there is $the_page_ID.
		if ( ! $the_page_ID ) {
			$the_page_ID = get_the_ID();
		} else {
			$the_page_ID = intval( $the_page_ID );
		}

		// Assign values to the class variables.
		if ( $the_page_ID > 0 ) {
			$this->the_page_ID = $the_page_ID;
			$this->the_meta_data = get_post_custom( $the_page_ID );
		}
	}


	/**
	 * Get Page_Meta: Meta.
	 *
	 * Gets the page meta_value if passed
	 * a meta_key through argument.
	 *
	 * @since 1.0.0
	 */
	public function get_meta( $meta_key, $return_array = FALSE ) {
		// Solves undefined index problem.
		$the_meta = isset( $this->the_meta_data[ $meta_key ] ) ? $this->the_meta_data[ $meta_key ] : false;

		// Array or not?
		if ( is_array( $the_meta ) ) {
			// Check 0th element of array
			// If meta is set then return value else return false.
			if ( isset( $the_meta[0] ) && false == $return_array ) {
				// Returns the value of meta.
				return $the_meta[0];
			} elseif ( isset( $the_meta[0] ) && true == $return_array ){
				// Returns the value of meta.
				return $the_meta;
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
	 * Get Page_Meta: ID.
	 *
	 * @since 1.0.0
	 */
	public function get_ID() {
		return $this->$the_page_ID;
	}


	/**
	 * Get Page_Meta.
	 *
	 * Gets the page meta for provided meta key.
	 *
	 * @since 1.0.0
	 */
	public function get_page_meta( $meta_key, $maybe_unserialize = FALSE, $is_image = FALSE, $is_string_to_array = FALSE, $is_return_array = FALSE ) {
		// Returns false if ID is not present.
		if ( ! $this->the_page_ID ) {
		    return false;
		}

		// If maybe_unserialize is true.
		if ( true == $maybe_unserialize ) {
			return maybe_unserialize( $this->get_meta( $meta_key ) );
		}

		// If image then return URL.
		if ( true == $is_image ) {
			return wp_get_attachment_url( $this->get_meta( $meta_key ) );
		}

		// If string to array by exploding `,` is true.
		if ( true == $is_string_to_array ) {
			// Comma separated string values.
			$the_string = $this->get_meta( $meta_key );
			// Conversion to an array.
			if ( $the_string ) {
			    // Explode at `,` comma.
			    $the_array = explode( ',', $the_string );

			    // Don't return and empty array return false if array is empty.
			    $the_array_filtered = array_filter( $the_array );
			    $the_array = ( ! empty( $the_array_filtered ) ) ? $the_array_filtered : false;

			    // Returns the array.
			    return $the_array;
			}
			// Returns false if no value in the string.
			return false;
		}

		if ( true == $is_return_array ) {
			// return the array.
			return $this->get_meta( $meta_key, $is_return_array );
		}

		// General.
		return $this->get_meta( $meta_key );
	}


} // class `VR_Get_Page_Meta`  ended.

endif;



/**
 * METHOD: Get an object of VR_Get_Page_Meta class.
 *
 * Add for themes to recognize the class and help
 * instantiate an object without any hooks.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'vr_get_page_meta_obj' ) ) {
	function vr_get_page_meta_obj( $the_page_ID ) {
		// Bails if no ID.
		if ( ! $the_page_ID ){
			return 'No Page ID provided!';
		}

		return new VR_Get_Page_Meta( $the_page_ID );
	}
}
