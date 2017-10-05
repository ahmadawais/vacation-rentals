<?php
/**
 * Section `vr_section_member`
 *
 * Membership related settings.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * vr_section_member.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'vr_section_member' ) ) {
	add_action( 'customize_register', 'vr_section_member' );
	function vr_section_member( $wp_customize ) {
		// Be safe.
		if ( ! isset( $wp_customize ) ) {
			return;
		}

		// Section: Member.
		$wp_customize->add_section( 'vr_section_member', array(
			'priority'       => 35,
			'panel'          => 'vr_panel_options',
			'title'          => __( 'Membership', 'VRC' ),
			'description'    => __( 'Membership related settings', 'VRC' ),
			'capability'     => 'edit_theme_options',
		) );

		/**
		 * Array of pages.
		 *
		 * Array for multiple similar settings and controls.
		 *
		 * @since  1.0.0
		 */
		$vr_pages_array = array(
			'login'    => 'Login',
			'register' => 'Register',
			'reset'    => 'Reset'
		);

		// Loop through the array to add settings/controls.
		foreach ( $vr_pages_array as $page => $name ) {
			// Setting: $page.
			$wp_customize->add_setting( 'vr_page_' . $page, array(
				'type'                 => 'option',
				'default'              => false,
				'transport'            => 'refresh', // refresh or postMessage
				'capability'           => 'edit_theme_options',
				// 'sanitize_callback'    => 'vr_sanitize_select',
			) );

			// Control: $page.
			$wp_customize->add_control( 'vr_page_' . $page, array(
				'label'       => __( 'Select the ' . $name . ' page', 'VRC' ),
				'description' => __( 'Add a new page with `' . $name . ' VR` page template and select it here.', 'VRC' ),
				'section'     => 'vr_section_member',
				'type'        => 'dropdown-pages',
			) );
		} // foreach() ended.

	}
}
