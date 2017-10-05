<?php
/**
 * Membership Initializer
 *
 * Responsible for membership related stuff.
 * 		1. Registration.
 * 		2. Login.
 * 		3. Forgot your password.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class: VR_Member.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/member/class-member.php' ) ) {
    require_once( VRC_DIR . '/assets/member/class-member.php' );
}


/**
 * Class: VR_Login.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/member/class-login.php' ) ) {
    require_once( VRC_DIR . '/assets/member/class-login.php' );
}


/**
 * Class: VR_Register.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/member/class-register.php' ) ) {
    require_once( VRC_DIR . '/assets/member/class-register.php' );
}


/**
 * Class: VR_Reset.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/member/class-reset.php' ) ) {
    require_once( VRC_DIR . '/assets/member/class-reset.php' );
}


/**
 * Class: VR_Edit_Profile.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/member/class-edit-profile.php' ) ) {
    require_once( VRC_DIR . '/assets/member/class-edit-profile.php' );
}


/**
 * Class: VR_Profile_Fields.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/member/class-profile-fields.php' ) ) {
    require_once( VRC_DIR . '/assets/member/class-profile-fields.php' );
}


/**
 * Class: VR_Submit_Post.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/member/class-submit-post.php' ) ) {
    require_once( VRC_DIR . '/assets/member/class-submit-post.php' );
}


/**
 * Actions/Filters for membership.
 *
 * Classes:
 * 			1. VR_Member
 */
if ( class_exists( 'VR_Member' ) ) {

	/**
	 * Object: VR_Member class.
	 *
	 * @since 1.0.0
	 */
	$vr_member_init = new VR_Member();

	// Register the shortcode [vr_login]
	add_action( 'init', array( $vr_member_init, 'login' ) );

	// Enable the user with no privileges to request ajax login
	add_action( 'wp_ajax_nopriv_vr_ajax_login', array( $vr_member_init, 'ajax_login' ) );


	// Register the shortcode [vr_register]
	add_action( 'init', array( $vr_member_init, 'register' ) );

	// Enable the user with no privileges to request ajax register
	add_action( 'wp_ajax_nopriv_vr_ajax_register', array( $vr_member_init, 'ajax_register' ) );


	// Register the shortcode [vr_reset]
	add_action( 'init', array( $vr_member_init, 'reset' ) );

	// Enable the user with no privileges to request ajax password reset
	add_action( 'wp_ajax_nopriv_vr_ajax_reset', array( $vr_member_init, 'ajax_reset' ) );


	// Register the shortcode [vr_edit_profile]
	add_action( 'init', array( $vr_member_init, 'edit_profile' ) );

	if ( class_exists( 'VR_Profile_Fields') ) {
		// Extra User Profile Fields.
	    add_filter( 'user_contactmethods', array( 'VR_Profile_Fields', 'extra_fields' ) );
	}
	// Edit Profile only for logged in user.
	add_action( 'wp_ajax_vr_update_profile_action', array( $vr_member_init, 'update' ) );

	// Upload profile image.
	// Action: `vr_profile_image_upload` line#65 `edit-profile.js`.
    add_action( 'wp_ajax_vr_profile_image_upload', array( $vr_member_init, 'upload_profile_image' ) );


	// Register the shortcode [vr_submit_post]
	add_action( 'init', array( $vr_member_init, 'submit_post' ) );

	// Submit a post for logged in user.
	add_action( 'wp_ajax_vr_submit_post_action', array( $vr_member_init, 'submit' ) );

}
