<?php
/**
 * Category/Term Section
 *
 * Section for Category and Terms customization.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Customize function.
if ( ! function_exists( 'vr_customize_cat_term' ) ) {
	// Customize Register action.
	add_action( 'customize_register', 'vr_customize_cat_term' );

	/**
	 * Customize: Cat/Term Section.
	 *
	 * Customizer register function for Cat/Term Section
	 *
	 * @param  object $wp_customize WP_Customize Instance of the WP_Customize_Manager class.
	 * @since  1.0.0
	 */
	function vr_customize_cat_term( $wp_customize ) {
		// Section: Category/Term.
		$wp_customize->add_section( 'vr_section_cat_term', array(
			'priority'       => 39,
			'panel'          => 'vr_panel_options',
			'title'          => __( 'Category/Term', 'VRC' ),
			'description'    => __( 'Category or Term related settings', 'VRC' ),
			'capability'     => 'edit_theme_options',
		) );

		// Setting: Cat/Term Image.
		$wp_customize->add_setting( 'vr_cat_term_img', array(
			'type'                 => 'theme_mod',
			'default'              => VRC_URL . '/assets/plugin/category-images/assets/img/placeholder.png',
			'transport'            => 'refresh', // Options: refresh or postMessage.
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'vr_sanitize_ci_img',
		) );

		// Control: Cat/Term Image.
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'vr_cat_term_img',
			array(
				'label'      => __( 'Upload a default image for category/term!', 'VRC' ),
				'section'    => 'vr_section_cat_term',
				'settings'   => 'vr_cat_term_img',
			)
		) );
	}
}

