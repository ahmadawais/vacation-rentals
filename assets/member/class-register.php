<?php
/**
 * Class: VR_Register
 *
 * Register class.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Register.
 *
 * VR Membership registeration class.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Register' ) ) :

class VR_Register {

	/**
	 * Register Short.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		/**
		 * Shortcode: `[vr_register]`.
		 *
		 * @since 1.0.0
		 */
		add_shortcode( 'vr_register', function () {

			/**
			 * VIEW: register.
			 *
			 * @since 1.0.0
			 */
			if ( file_exists( VRC_DIR . '/assets/member/view-register.php' ) ) {
			    require_once( VRC_DIR . '/assets/member/view-register.php' );
			}

		} );// annonymous function and action ended.

	} // Function ended.


	/**
	 * AJAX Register.
	 *
	 * @since 1.0.0
	 */
	public function ajax_register() {

		// First check the nonce, if it fails the function will break
        check_ajax_referer( 'vr-ajax-register-nonce', 'vr-secure-register' );

        // Nonce is checked, Get to work
		$info                  = array();
		$info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user( $_POST['register_username'] ) ;
		$info['user_pass']     = sanitize_text_field( $_POST['register_pwd'] );
		$info['user_email']    = sanitize_email( $_POST['register_email'] );

        // Register the user
        $user_register = wp_insert_user( $info );

        if( is_wp_error( $user_register ) ) {

            $error  = $user_register->get_error_codes()	;
            if( in_array( 'empty_user_login', $error ) ) {
                echo json_encode( array(
                    'success' => false,
                    'message' => __( $user_register->get_error_message( 'empty_user_login' ) )
                ) );
            } elseif( in_array( 'existing_user_login', $error ) ) {
                echo json_encode( array(
                    'success' => false,
                    'message' => __( 'This username already exists.', 'VRC' )
                ) );
            } elseif( in_array( 'existing_user_email', $error ) ) {
                echo json_encode( array(
                    'success' => false,
                    'message' => __( 'This email is already registered.', 'VRC' )
                ) );
            }

        } else {

        	/**
        	 * Object: VR_Member class.
        	 *
        	 * @since 1.0.0
        	 */
			$vr_member_object = new VR_Member();
            $vr_member_object->ajax_user_authenticate( $info['user_login'], $info['user_pass'], __( 'Registration', 'VRC' ) );
        }

        die();

	}


} // Class ended.

endif;
