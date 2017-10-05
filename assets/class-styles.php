<?php
/**
 * Styles.
 *
 * All the enqueued styles.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'VR_Styles' ) ) :

/**
 * VR_Styles.
 *
 * VR Styles Class.
 *
 * @since 1.0.0
 */
class VR_Styles {

		/**
		 * Styles.
		 *
		 * Static public function. Object has no access to it
		 * and a call from an object can lead to a Fatal error
		 * in $this context.
		 *
		 * @since 1.0.0
		 */
		public static function styles() {

	    	if ( is_admin() ) {
				// Admin Styles.
				wp_enqueue_style(
					'vr-admin',
					VRC_URL . '/assets/css/style.css',
					array(),
					VRC_VERSION,
					'all'
				);
	    	}

		} // Function ended.


} // Class ended.

endif;



/**
 * Actions/Filters related to VR_Styles class.
 *
 * @since 1.0.0
 */
if ( class_exists( 'VR_Styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * Static function `styles`, Object has no access to it,
	 * a call from an object can lead to a Fatal error in $this
	 * context So, calling it via the classname.
	 *
	 * @since 1.0.0
	 */
	add_action( 'admin_enqueue_scripts', array( 'VR_Styles', 'styles' ) );


endif;
