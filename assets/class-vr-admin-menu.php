<?php
/**
 * Class for custom admin menu
 *
 * Custom VR admin menu.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'VR_Admin_Menu' ) ) :

/**
 * VR_Admin_Menu.
 *
 * Custom Admin Menu for VR.
 *
 * @since 1.0.0
 */
class VR_Admin_Menu {
	/**
	 * Tabs.
	 *
	 * @var 	string
	 * @since 	1.0.0
	 */
	public $tab;

	/**
	 * Cap for admin menu.
	 *
	 * @var 	string
	 * @since 	1.0.0
	 */
	public $menu_capability = 'manage_options';


	/**
	 * LP_Admin_Menu Construct.
	 *
	 * Adds the menu and custom tabs.
	 *
	 * @since 1.0.0
	 */
	function __construct() {
		// Admin menu.
		add_action( 'admin_menu', array( $this, 'vr_menu' ), 11 );

		// The vr_rental tabs.
		add_action( 'all_admin_notices', array( $this, 'vr_rental_custom_tabs' ) );

		// Current menu when clicked on a tab.
		add_action( 'admin_footer', array( $this, 'open_menu' ) );
	}

	/**
	 * Register VR Menu.
	 *
	 * Custom menu for VR.
	 *
	 * @param string   $page_title Menu data attribute.
	 * @param string   $menu_title Menu data attribute.
	 * @param string   $capability Menu data attribute.
	 * @param string   $menu_slug Menu data attribute.
	 * @param callable $function = '' Menu data attribute.
	 * @param string   $icon_url = '' Menu data attribute.
	 * @param int      $position = null Menu data attribute.
	 * @since 1.0.0
	 */
	public function vr_menu() {
		// Add menu page.
		add_menu_page(
			__( 'Vacation Rentals', 'VRC' ),
			__( 'Vacation Rentals', 'VRC' ),
			$this->menu_capability,
			'vacation_rentals',
			'',
			'dashicons-building',
			'3.08'
		);

		// Add all sub menus.
		$sub_menus = array(
			'addnew' => array(
				'vacation_rentals',
				__( 'Add New Rental', 'VRC' ),
				__( '→  Add New', 'VRC' ),
				'manage_options',
				'post-new.php?post_type=vr_rental',
			),
			'destinations' => array(
				'vacation_rentals',
				__( 'Destinations', 'VRC' ),
				__( '⇲  Destinations', 'VRC' ),
				'manage_options',
				'edit-tags.php?taxonomy=vr_rental-destination&post_type=vr_rental',
			),
			'feautres' => array(
				'vacation_rentals',
				__( 'Features', 'VRC' ),
				__( '⦿  Features', 'VRC' ),
				'manage_options',
				'edit-tags.php?taxonomy=vr_rental-feature&post_type=vr_rental',
			),
			'types' => array(
				'vacation_rentals',
				__( 'Types', 'VRC' ),
				__( '♆  Types', 'VRC' ),
				'manage_options',
				'edit-tags.php?taxonomy=vr_rental-type&post_type=vr_rental',
			),
			'bookings' => array(
				'vacation_rentals',
				__( 'Bookings', 'VRC' ),
				__( '⎃  Bookings', 'VRC' ),
				'manage_options',
				'edit.php?post_type=vr_booking',
			),
			'agents' => array(
				'vacation_rentals',
				__( 'Agents', 'VRC' ),
				__( '⑆  Agents', 'VRC' ),
				'manage_options',
				'edit.php?post_type=vr_agent',
			),
			// TODO.
			// 'partners' => array(
			// 	'vacation_rentals',
			// 	__( 'Partners', 'VRC' ),
			// 	__( '⌭  Partners', 'VRC' ),
			// 	'manage_options',
			// 	'edit.php?post_type=vr_partner',
			// ),
		);

		// Third-party can add more sub_menus.
		$sub_menu = apply_filters( 'vr_sub_menus', $sub_menus );

		/**
		 * Add Submenu.
		 *
		 * @param string $parent_slug
		 * @param string $page_title
		 * @param string $menu_title
		 * @param string $capability
		 * @param string $menu_slug
		 * @param callable $function = ''
		 * @since  1.0.0
		 */
		if ( $sub_menu ) {
			foreach ( $sub_menus as $sub_menu ) {
				call_user_func_array( 'add_submenu_page', $sub_menu );
			}
		}

	}


	/**
	 * Tabs for `vr_rental`.
	 *
	 * Tabbed Custom Rentals Menu.
	 *
	 * @since 1.0.0
	 */
	public function vr_rental_custom_tabs() {
		// Bail if not admin.
		if ( ! is_admin() ) {
			return;
		}

		// Tabs for `vr_rental` CPT.
		$vr_rental_tabs = apply_filters(
			'vr_rentals_tabs',
			array(
				// Rentals.
				10 => array(
					'name' => __( 'Rentals', 'VRC' ),
					'id'   => 'edit-vr_rental', // Via Screen ID reference.
					'link' => 'edit.php?post_type=vr_rental',
				),

				// Destination.
				20 => array(
					'name' => __( 'Destinations', 'VRC' ),
					'id'   => 'edit-vr_rental-destination', // Via Screen ID reference.
					'link' => 'edit-tags.php?taxonomy=vr_rental-destination&post_type=vr_rental',
				),

				// Features.
				30 => array(
					'name' => __( 'Features', 'VRC' ),
					'id'   => 'edit-vr_rental-feature', // Via Screen ID reference.
					'link' => 'edit-tags.php?taxonomy=vr_rental-feature&post_type=vr_rental',
				),

				// Types.
				40 => array(
					'name' => __( 'Types', 'VRC' ),
					'id'   => 'edit-vr_rental-type', // Via Screen ID reference.
					'link' => 'edit-tags.php?taxonomy=vr_rental-type&post_type=vr_rental',
				)

			)
		);

		// Sort the keys.
		ksort( $vr_rental_tabs );

		// Array with keys from $vr_rental_tabs.
		$tabs = array();
		foreach ( $vr_rental_tabs as $key => $value ) {
			// Adds keys to $tabs.
			array_push( $tabs, $key );
		}

		// Show tabs at these pages.
		$pages = apply_filters(
			'vr_rental_tabs_on_pages',
			array( 'edit-vr_rental', 'edit-vr_rental-destination', 'edit-vr_rental-feature', 'edit-vr_rental-type' )
			// The // array( 'edit-vr_rental', 'edit-vr_rental-destination', 'edit-vr_rental-feature', 'edit-vr_rental-type', 'vr_rental' ) the.
		);

		// Build the array.
		$vr_rental_tabs_on_page = array();
		foreach ( $pages as $page ) {
			$vr_rental_tabs_on_page[ $page ] = $tabs;
		}

		// Get the current screen ID.
		$current_page_id = get_current_screen()->id;

		// Get Current user.
		$current_user    = wp_get_current_user();

		// Bail if current user isn't admin.
		if ( ! in_array( 'administrator', $current_user->roles ) ) {
			return;
		}

		// If current page has tabs.
		if ( ! empty( $vr_rental_tabs_on_page[ $current_page_id ] ) && count( $vr_rental_tabs_on_page[ $current_page_id ] ) ) {

			// Heading for VR.
			echo '<h1 class="vr-heading-1">' . __( 'Vacation Rentals', 'VRC' ) . ' <span> v' . VRC_VERSION . '</span></h1>';

			// Default admin tab wrapper via wp-admin/about.php page.
			echo '<h2 class="nav-tab-wrapper vr-nav-tab-wrapper">';

			// Build each tab and current openned tab.
			foreach ( $vr_rental_tabs_on_page[ $current_page_id ] as $admin_tab_id ) {

				$class = ( $vr_rental_tabs[ $admin_tab_id ]['id'] == $current_page_id ) ? 'nav-tab nav-tab-active' : 'nav-tab';
				echo '<a href="' . admin_url( $vr_rental_tabs[ $admin_tab_id ]['link'] ) . '" class="' . $class . ' nav-tab-' . $vr_rental_tabs[ $admin_tab_id ]['id'] . '">' . $vr_rental_tabs[ $admin_tab_id ]['name'] . '</a>';
			}
			echo '</h2>';
		}
	} // This ended.


	/**
	 * WP menu open.
	 *
	 * Open VR menu when clicked on a tab.
	 *
	 * @since 1.0.0
	 */
	public function open_menu() {
		// Get Current Screen.
		$screen = get_current_screen();

		$menu_arr = [
						'vr_rental',
						'edit-vr_rental',
						'vr_booking',
						'edit-vr_booking',
						'vr_agent',
						'edit-vr_agent',
						'vr_partner',
						'edit-vr_partner',
						'vr_rental-destination',
						'edit-vr_rental-destination',
						'vr_rental-type',
						'edit-vr_rental-type',
						'vr_rental-feature',
						'edit-vr_rental-feature',
						'vacation-rentals_page_vacation_rentals_settings',
					];

		// Check if the current screen's ID has any of the above menu array items.
		if ( in_array( $screen->id, $menu_arr ) ) { ?>
			<script type="text/javascript">
					jQuery("body").removeClass("sticky-menu");
					jQuery("#toplevel_page_vacation_rentals").addClass('wp-has-current-submenu wp-menu-open').removeClass('wp-not-current-submenu');
					jQuery("#toplevel_page_vacation_rentals > a").addClass('wp-has-current-submenu wp-menu-open').removeClass('wp-not-current-submenu');
					// jQuery("#toplevel_page_vacation_rentals .wp-first-item").addClass('current');

			<?php
				if ( isset( $_GET['taxonomy'] ) && ( 'vr_rental-destination' ==  $_GET['taxonomy'] ) ) {
					echo 'jQuery("#toplevel_page_vacation_rentals ul li:nth-child(4)").addClass("current");';
				}
				if ( isset( $_GET['taxonomy'] ) && ( 'vr_rental-feature' ==  $_GET['taxonomy'] ) ) {
					echo 'jQuery("#toplevel_page_vacation_rentals ul li:nth-child(5)").addClass("current");';
				}
				if ( isset( $_GET['taxonomy'] ) && ( 'vr_rental-type' ==  $_GET['taxonomy'] ) ) {
					echo 'jQuery("#toplevel_page_vacation_rentals ul li:nth-child(6)").addClass("current");';
				}
			?>
				jQuery(window).load(function ($) {
				});
			</script>
			<?php
		}
	}
} // class ended.

endif;

// Initiate the class.
return new VR_Admin_Menu();
