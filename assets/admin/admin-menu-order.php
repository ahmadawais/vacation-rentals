<?php
/**
 * Admin Menu Order
 *
 * WP-Admin Post Type Order for menus.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Menu_Order.
 *
 * WP Menu Order.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Menu_Order' ) ) :

class VR_Menu_Order {

	/**
	 * Menu Order.
	 *
	 * @since 1.0.0
	 */
	public function menu_order( $menu_ord ) {

	    if ( ! $menu_ord ) return true;
	    return array(
	        'index.php', // Dashboard.

	        'separator1',

	        'edit.php?post_type=vr_rental', // Rental.
	        'edit.php?post_type=vr_booking', // Booking.
	        'edit.php?post_type=vr_agent', // Agent.
	        'edit.php?post_type=vr_partner', // Partner.

	        'separator2',

	        'edit.php', // Posts.
	        'edit.php?post_type=page', // Pages.

	        'separator-last',

	        'upload.php', // Media.
	        'edit-comments.php', // Comments.
	        'themes.php', // Appearance.
	        'plugins.php', // Plugins.
	        'users.php', // Users.
	        'tools.php', // Tools.
	        'options-general.php', // Settings.

	    );

	} // Function ended.

} // Class ended.

endif;



if ( class_exists( 'VR_Menu_Order' ) ) {


	/**
	 * Object: VR_Menu_Order class.
	 *
	 * @since 1.0.0
	 */
	$vr_menu_order = new VR_Menu_Order();

	// Activate custom_menu_order.
	add_filter('custom_menu_order', array( $vr_menu_order, 'menu_order' ) );
	add_filter('menu_order', array( $vr_menu_order, 'menu_order' ) );

}
