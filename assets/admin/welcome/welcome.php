<?php
/**
 * Weclome Page Class
 *
 * @since 0.0.1
 * @package VRC
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


add_action( 'admin_init', 'aa_welcome_screen_do_activation_redirect' );
function aa_welcome_screen_do_activation_redirect() {
  // Bail if no activation redirect
    if ( ! get_transient( '_welcome_redirect' ) ) {
    return;
  }

  // Delete the redirect transient
  delete_transient( '_welcome_redirect' );

  // Bail if activating from network, or bulk
  if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
    return;
  }

  // Redirect to Welcome page
  wp_safe_redirect( add_query_arg( array( 'page' => 'aa_welcome_page' ), admin_url( 'tools.php' ) ) );

}

add_action('admin_menu', 'aa_welcome_screen_pages');
function aa_welcome_screen_pages() {
	add_submenu_page(
		'tools.php',
		'VRC_PLUGIN',
		'Welcome',
		'read',
		'aa_welcome_page',
		'aa_welcome_screen_content' );
}

function aa_welcome_screen_content() {

	// Welcome Page
	if (file_exists( VRC_DIR . '/assets/admin/inc/welcome/welcome_page.php') ) {
	   require_once( VRC_DIR . '/assets/admin/inc/welcome/welcome_page.php' );
	}
}


// add_action( 'admin_head', 'welcome_screen_remove_menus' );

// function welcome_screen_remove_menus() {
//     remove_submenu_page( 'index.php', 'welcome-screen-about' );
// }
//