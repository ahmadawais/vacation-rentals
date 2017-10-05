<?php
/**
 * Class: VR_Login
 *
 * Login class.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Login.
 *
 * VR Membership login class.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Login' ) ) :

class VR_Login {

	/**
	 * Login Shortcode.
	 *
	 * @since 1.0.0
	 */
	public function login() {

		/**
		 * Shortcode: `[vr_login]`.
		 *
		 * @since 1.0.0
		 */
		add_shortcode( 'vr_login', function () {

			/**
			 * VIEW: login.
			 *
			 * @since 1.0.0
			 */
			if ( file_exists( VRC_DIR . '/assets/member/view-login.php' ) ) {
			    require_once( VRC_DIR . '/assets/member/view-login.php' );
			}

		} );// annonymous function and action ended.

	} // Function ended.


	/**
	 * AJAX Login.
	 *
	 * @since 1.0.0
	 */
	public function ajax_login() {

		// First check the nonce, if it fails the function will break
        check_ajax_referer( 'vr-ajax-login-nonce', 'vr-secure-login' );

        // Nonce is checked, get the POST data and sign user on
        $this->ajax_user_authenticate( $_POST['log'], $_POST['pwd'], __( 'Login', 'VRC' ) );

        die();

	}



	/**
	 * AJAX User Authentication.
	 *
	 * This function processes login request and displays a JSON response.
	 *
	 * @param $user_login
     * @param $password
     * @param $login
	 * @since 1.0.0
	 */
	public function ajax_user_authenticate( $user_login, $password, $login ) {

		$info                  = array();
		$info['user_login']    = $user_login;
		$info['user_password'] = $password;
		$info['remember']      = true;

		$user_signon = wp_signon( $info, false );

		if( is_wp_error( $user_signon ) ) {
		    echo json_encode( array(
		        'success' => false,
		        'message' => __( 'Wrong username or password.', 'VRC' ),
		    ) );
		} else {
		    wp_set_current_user( $user_signon->ID );
		    echo json_encode( array(
				'success'  => true,
				'message'  => $login . ' ' . __( 'successful. Redirecting...', 'VRC' ),
				'redirect' => $_POST['redirect_to']
		    ) );
		}

		die();

	}


} // Class ended.

endif;
