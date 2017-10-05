<?php
/**
 * Class: `VR_Agent`
 *
 * Agent related classes are intialized here.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Agent.
 *
 * Agent related classes.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Agent' ) ) :

class VR_Agent {

	/**
	 * CPT: Agent.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	public $agent;


	/**
	* Constructor.
	*/
	public function __construct() {

		$this->agent = new VR_CPT_Agent();

	}


	/**
	 * Create Agent.
	 *
	 * Custom Post type: `vr_agent`
	 *
	 * @since  1.0.0
	 */
	public function create_agent() {
		$this->agent->register();
	}


	/**
	 * Fake Agent Content.
	 *
	 * @since 1.0.0
	 */
	public function fake_agent_content() {
		$this->agent->fake_content();
	}


}

endif;
