<?php
/**
 * Member Class File
 *
 * Main class for all membership related classes.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Member Class.
 *
 * Class that handles all things membership.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Member' ) ) :

class VR_Member {

	/**
	 * VR_Login Object.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	public $login;


	/**
	 * VR_Register Object.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	public $register;


	/**
	 * VR_Reset Object.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	public $reset;


	/**
	 * VR_Edit_Profile Object.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	public $edit_profile;


	/**
	 * VR_Submit_Post Object.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	public $submit_post;


	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->login        = new VR_Login();
		$this->register     = new VR_Register();
		$this->reset        = new VR_Reset();
		$this->edit_profile = new VR_Edit_Profile();
		$this->submit_post  = new VR_Submit_Post();

	}


	/**
	 * Login.
	 *
	 * Shortcode: `[vr_login]`
	 *
	 * @since  1.0.0
	 */
	public function login() {
		$this->login->login();
	}


	/**
	 * AJAX Login.
	 *
	 * @since  1.0.0
	 */
	public function ajax_login() {
		$this->login->ajax_login();
	}


	/**
	 * AJAX User Authentication.
	 *
	 * @since  1.0.0
	 */
	public function ajax_user_authenticate( $user_login, $password, $login ) {
		$this->login->ajax_user_authenticate( $user_login, $password, $login );
	}


	/**
	 * Register.
	 *
	 * Shortcode: `[vr_register]`
	 *
	 * @since  1.0.0
	 */
	public function register() {
		$this->register->register();
	}


	/**
	 * AJAX Register.
	 *
	 * @since  1.0.0
	 */
	public function ajax_register() {
		$this->register->ajax_register();
	}


	/**
	 * Reset.
	 *
	 * Shortcode: `[vr_reset]`
	 *
	 * @since  1.0.0
	 */
	public function reset() {
		$this->reset->reset();
	}


	/**
	 * AJAX Reset.
	 *
	 * @since  1.0.0
	 */
	public function ajax_reset() {
		$this->reset->ajax_reset();
	}


	/**
	 * Edit Profile.
	 *
	 * Shortcode: `[vr_edit_profile]`.
	 *
	 * @since  1.0.0
	 */
	public function edit_profile() {
		$this->edit_profile->edit_profile();
	}


	/**
	 * Edit Profile Update.
	 *
	 * @since  1.0.0
	 */
	public function update() {
		$this->edit_profile->update_profile();
	}


	/**
	 * Upload Profile Image.
	 *
	 * @since  1.0.0
	 */
	public function upload_profile_image() {
		$this->edit_profile->upload_profile_image();
	}


	/**
	 * Get Profile Image URL.
	 *
	 * @since  1.0.0
	 */
	public function get_profile_image_url() {
		$this->edit_profile->get_profile_image_url();
	}


	/**
	 * Shortcode for Submit Post.
	 *
	 * Shortcode: `[vr_submit_post]`.
	 *
	 * @since  1.0.0
	 */
	public function submit_post() {
		$this->submit_post->vr_submit_post();
	}

	/**
	 * Submit Post.
	 *
	 * @since  1.0.0
	 */
	public function submit() {
		$this->submit_post->submit();
	}


} // Class ended.

endif;
