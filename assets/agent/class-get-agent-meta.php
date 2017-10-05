<?php
/**
 * Get Agent Meta
 *
 * Gets agent related meta.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Get_Agent_Meta.
 *
 * Get class for the agent meta.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Get_Agent_Meta' ) ) :

class VR_Get_Agent_Meta {

	/**
	 * The Agent_Meta ID.
	 *
	 * @var 	int
	 * @since 	1.0.0
	 */
	 public $the_agent_ID;


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
	 * Checks the agent ID and assigns
	 * the meta data to $the_meta_data.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $the_agent_ID = NULL ) {
		// Check if there is $the_agent_ID.
		if ( ! $the_agent_ID ) {
			$the_agent_ID = get_the_ID();
		} else {
			$the_agent_ID = intval( $the_agent_ID );
		}

		// Assign values to the class variables.
		if ( $the_agent_ID > 0 ) {
			$this->the_agent_ID = $the_agent_ID;
			$this->the_meta_data = get_post_custom( $the_agent_ID );
		}
	}


	/**
	 * Get Agent_Meta: Meta.
	 *
	 * Gets the agent meta_value if passed
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
	 * Get Agent_Meta.
	 *
	 * Gets the agent meta for provided meta key.
	 *
	 * @since 1.0.0
	 */
	public function get_agent_meta( $meta_key ) {
		// Returns false if ID is not present.
		if ( ! $this->the_agent_ID ) {
		    return false;
		}

		// General.
		return $this->get_meta( $meta_key );
	}


} // class `VR_Get_Agent_Meta`  ended.

endif;



/**
 * METHOD: Get an object of VR_Get_Agent_Meta class.
 *
 * Add for themes to recognize the class and help
 * instantiate an object without any hooks.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'vr_get_agent_meta_obj' ) ) {
	function vr_get_agent_meta_obj( $the_agent_ID ) {
		// Bails if no ID.
		if ( ! $the_agent_ID ){
			return 'No Agent ID provided!';
		}

		return new VR_Get_Agent_Meta( $the_agent_ID );
	}
}
