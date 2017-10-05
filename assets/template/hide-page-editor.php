<?php
/**
 * Hide Page Editor in Admin
 *
 * For certain pages, editor is not required,
 * this file helps hide the editor on such pages.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Hide Editor on Homepage Template.
 *
 * @since 1.0.0
 */
add_action('admin_head', 'vr_hide_homepage_editor');
if ( ! function_exists( 'vr_hide_homepage_editor' ) ) {
	function vr_hide_homepage_editor() {
		// Get the pagenow.
		global $pagenow;

		// Bail if post.php
	    if( ! ( 'post.php' == $pagenow ) ) {
			return;
		}

		// Get the Post ID.
		$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];

		// Bail if no post_id.
		if( ! isset( $post_id ) ) {
			return;
		}

		// Hide the editor on a page with a homepage template.
		$template_filename = get_post_meta( $post_id, '_wp_page_template', true );

		// Remove the editor.
		if( $template_filename == 'page-homepage.php'
			|| $template_filename == 'page-login.php'
			|| $template_filename == 'page-reset.php'
			|| $template_filename == 'page-register.php'
			|| $template_filename == 'page-rental-list.php'
			|| $template_filename == 'page-rental-search.php'
			|| $template_filename == 'page-user-favorites.php'
			|| $template_filename == 'page-edit-profile.php' ) {
			remove_post_type_support('page', 'editor');
		}
	} // vr_hide_homepage_editor() ended.
} // function_exists() ended.
