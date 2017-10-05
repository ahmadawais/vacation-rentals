<?php
/**
 * Rental Class File
 *
 * Main class for all rental related classes.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Rental Class.
 *
 * Class that handles all things rental.
 *
 * Methods:
 * 			1. Rentals - Deals with all the rentals related stuff.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Rental' ) ) :

class VR_Rental {
	/**
	 * VR Rentals Object.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	public $rental;

	/**
	 * Rental Type Object.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	public $rental_type;

	/**
	 * Rental Destination Object.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	public $rental_destination;

	/**
	 * Rental Features Object.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	public $rental_feature;


	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->rental                = new VR_CPT_Rental();
		$this->rental_type           = new VR_CT_Rental_Type();
		$this->rental_destination    = new VR_Rental_Destination();
		$this->rental_feature        = new VR_Rental_Feature();
	}

	/**
	 * Create Rental.
	 *
	 * Custom Post type: `vr_rental`
	 *
	 * @since  1.0.0
	 */
	public function create_rental() {
		$this->rental->register();
	}

	/**
	 * Fake Rental Content.
	 *
	 * @since 1.0.0
	 */
	public function fake_rental_content() {
		$this->rental->fake_content();
	}

	/**
	 * Create CT Rental Type.
	 *
	 * @since 1.0.0
	 */
	public function create_rental_type() {
		$this->rental_type->register();
	}

	/**
	 * Create CT Rental Destination.
	 *
	 * @since 1.0.0
	 */
	public function create_rental_destination() {
		$this->rental_destination->register();
	}

	/**
	 * Create CT Rental Feature.
	 *
	 * @since 1.0.0
	 */
	public function create_rental_feature() {
		$this->rental_feature->register();
	}

	/**
	 * Insert Dummy Terms for Rental Feature.
	 *
	 * @since 1.0.1
	 */
	public function insert_dummy_features() {
		$this->rental_feature->insert_dummy_terms();
	}
}
endif;
