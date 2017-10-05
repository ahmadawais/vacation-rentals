<?php
/**
 * Scripts.
 *
 * All the enqueued scripts.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * VR_Scripts.
 *
 * VR Scripts Class.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Scripts' ) ) :

class VR_Scripts {

		/**
		 * Scripts.
		 *
		 * Static public function. Object has no access to it
		 * and a call from an object can lead to a Fatal error
		 * in $this context.
		 *
	     * TODO: has_shortcode() check or page checks.
		 *
		 * @since 1.0.0
		 */
		public static function scripts() {

	    	if ( ! is_admin() ) :

	    		// Enqueue jQuery.
	    		wp_enqueue_script('jquery');


	    		// jQuery Form Plugin.
	    		// Usage: member
	    		wp_enqueue_script(
	    		    'vr_form',
	    		    VRC_URL . '/assets/js/vendor/jquery.form.js',
	    		    array( 'jquery' ),
	    		    '3.51.0',
	    		    true
	    		);


	    		// Bootstrap: `modal.js`.
	    		// Usage: member
	    		wp_enqueue_script(
	    		    'vr_modal',
	    		    VRC_URL . '/assets/js/vendor/modal.js',
	    		    array( 'jquery' ),
	    		    '3.3.4',
	    		    true
	    		);


	    		// jQuery Validation Plugin.
	    		// Usage: member
	    		wp_enqueue_script(
	    		    'vr_validate',
	    		    VRC_URL . '/assets/js/vendor/jquery.validate.min.js',
	    		    array( 'jquery' ),
	    		    '1.13.1',
	    		    true
	    		);


	    		// login-register-reset.js.
	    		// Usage: member
	    		wp_enqueue_script(
	    		    'vr_member_customJS',
	    		    VRC_URL . '/assets/js/custom/login-register-reset.js',
	    		    array( 'jquery', 'vr_form', 'vr_modal', 'vr_validate' ),
	    		    VRC_VERSION,
	    		    true
	    		);


	    		// Needed for Profile Image.
	    		// Usage: member
	            wp_enqueue_script( 'plupload' );


	    		// Edit Profile JS.
	    		// Usage: member
	    		wp_enqueue_script(
	    		    'vr_edit_profileJS',
	    		    VRC_URL . '/assets/js/custom/edit-profile.js',
	    		    array( 'jquery', 'plupload' ),
	    		    VRC_VERSION,
	    		    true
	    		);

	    		$edit_profile_data = array(
					'ajaxURL'       => admin_url( 'admin-ajax.php' ),
					'uploadNonce'   => wp_create_nonce ( 'vr_allow_upload_profile_image' ),
					'fileTypeTitle' => __( 'Valid file formats.', 'VRC' ),
	    		);

	    		wp_localize_script( 'vr_edit_profileJS', 'editProfile', $edit_profile_data );



	    		// Submit Booking JS.
	    		// Usage: booking
	    		wp_enqueue_script( 'jquery-ui-datepicker' );

	    		// DatePicker CSS.
	    		wp_enqueue_style(
	    		    'jquery_ui_datepicker_css',
	    		    VRC_URL . '/assets/meta-boxes/meta-box/css/jqueryui/jquery.ui.datepicker.css',
	    		    // array( 'jquery', 'jquery-ui-datepicker' ),
	    		    '1.0.0',
	    		    'all'
	    		);
	    		wp_enqueue_script(
	    		    'vr_submit_bookingJS',
	    		    VRC_URL . '/assets/js/custom/submit-booking.js',
	    		    array( 'jquery', 'plupload', 'jquery-ui-datepicker' ),
	    		    VRC_VERSION,
	    		    true
	    		);

	    		$submit_booking_data = array(
					'ajaxURL'       => admin_url( 'admin-ajax.php' ),
					'uploadNonce'   => wp_create_nonce ( 'vr_allow_submit_booking_image' ),
					'fileTypeTitle' => __( 'Valid file formats.', 'VRC' ),
	    		);

	    		wp_localize_script( 'vr_submit_bookingJS', 'submitBooking', $submit_booking_data );



	    		// Submit Post JS.
	    		// Usage: member
	    		wp_enqueue_script(
	    		    'vr_submit_postJS',
	    		    VRC_URL . '/assets/js/custom/submit-post.js',
	    		    array( 'jquery', 'plupload' ),
	    		    VRC_VERSION,
	    		    true
	    		);

	    		$submit_post_data = array(
					'ajaxURL'       => admin_url( 'admin-ajax.php' ),
					'uploadNonce'   => wp_create_nonce ( 'vr_allow_submit_post_image' ),
					'fileTypeTitle' => __( 'Valid file formats.', 'VRC' ),
	    		);

	    		wp_localize_script( 'vr_submit_postJS', 'submitPost', $submit_post_data );


	    		// Rental Submit/Edit
	    		// if ( is_page_template( 'page-templates/submit-property.php' ) ) {
	    		//

	    	// 	    wp_enqueue_script( 'plupload' );
	    	// 	    wp_enqueue_script( 'jquery-ui-core' );
	    	// 	    wp_enqueue_script( 'jquery-ui-autocomplete' );
	    	// 	    wp_enqueue_script( 'jquery-ui-sortable' );


	    	// 	    wp_enqueue_script(
	    	// 	        'inspiry-property-submit',
	    	// 	        VRC_URL . '/assets/js/custom/edit-rental.js',
	    	// 	        array( 'jquery', 'plupload', 'jquery-ui-sortable' ),
	    	// 	        VRC_VERSION,
	    	// 	        true
	    	// 	    );

	    	// 	    $property_submit_data = array(
						// 'ajaxURL'       => admin_url( 'admin-ajax.php' ),
						// 'uploadNonce'   => wp_create_nonce ( 'inspiry_allow_upload' ),
						// 'fileTypeTitle' => __( 'Valid file formats', 'VRC' ),
	    	// 	    );
	    	// 	    wp_localize_script( 'inspiry-property-submit', 'propertySubmit', $property_submit_data );

	    		// }

	    		// Favorite.js.
	    		wp_enqueue_script(
	    		    'vrc_favoriteJS',
	    		    VRC_URL . '/assets/js/custom/favorite.js',
	    		    array( 'jquery' ),
	    		    VRC_VERSION,
	    		    true
	    		);


			endif;

		} // Function ended.


} // Class ended.

endif;



/**
 * Actions/Filters related to VR_Scripts class.
 *
 * @since 1.0.0
 */
if ( class_exists( 'VR_Scripts' ) ) :

	/**
	 * Enqueue scripts.
	 *
	 * Static function `scripts`, Object has no access to it,
	 * a call from an object can lead to a Fatal error in $this
	 * context So, calling it via the classname.
	 *
	 * @since 1.0.0
	 */
	add_action( 'wp_enqueue_scripts', array( 'VR_Scripts' , 'scripts' ) );


endif;
