<?php
/**
 * Class: `VR_Partner`
 *
 * Partner related classes are intialized here.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Partner.
 *
 * Partner related classes.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Partner' ) ) :

class VR_Partner {

	/**
	 * CPT: Partner.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	public $partner;


	/**
	* Constructor.
	*/
	public function __construct() {

		$this->partner = new VR_CPT_Partner();

	}


	/**
	 * Create Partner.
	 *
	 * Custom Post type: `vr_partner`
	 *
	 * @since  1.0.0
	 */
	public function create_partner() {
		$this->partner->register();
	}


	/**
	 * Fake Partner Content.
	 *
	 * @since 1.0.0
	 */
	public function fake_partner_content() {
		$this->partner->fake_content();
	}


}

endif;
