<?php
/**
 * WPOSA Settings
 *
 * WP OOP Settings API.
 *
 * @since 	1.0.0
 * @package WP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class `VR_Settings`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/settings/class-vr-settings.php' ) ) {
    require_once( VRC_DIR . '/assets/settings/class-vr-settings.php' );
}


/**
 * Class `VR_Get_Settings`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/settings/class-vr-get-settings.php' ) ) {
    require_once( VRC_DIR . '/assets/settings/class-vr-get-settings.php' );
}


/**
 * Actions/Filters
 *
 * Related to all settings API.
 *
 * @since  1.0.0
 */
if ( class_exists( 'VR_Settings' ) ) {
	/**
	 * Object Instantiation.
	 *
	 * Object for the class `VR_Settings`.
	 */
	$vr_settings_obj = new VR_Settings();

    // Section: General Settings.
    $vr_settings_obj->add_section(
    	array(
			'id'    => 'vr_general_settings',
			'title' => __( 'General Settings', 'VRC' ),
			'desc' => __( 'General settings related to Vacation Rentals plugin.', 'VRC' ),
		)
    );

	// Field: currency_symbol.
	$vr_settings_obj->add_field(
		'vr_general_settings',
		array(
			'id'      => 'currency_symbol',
			'type'    => 'text',
			'name'    => __( 'Currency Symbol', 'VRC' ),
			'desc'    => __( 'Example: $', 'VRC' ),
			'default' => '$'
		)
	);

	// Field: currency_position.
	$vr_settings_obj->add_field(
		'vr_general_settings',
		array(
			'id'      => 'currency_position',
			'type'    => 'select',
			'name'    => __( 'Currency Symbol Position', 'VRC' ),
			'desc'    => __( 'Default: Before', 'VRC' ),
			'default' => 'before',
			'options' => array(
				'before' => 'Before (E.g. $10)',
				'after'  => 'After (E.g. 10$)'
			)
		)
	);


	// Field: thousand_separator.
	$vr_settings_obj->add_field(
		'vr_general_settings',
		array(
			'id'      => 'thousand_separator',
			'type'    => 'text',
			'name'    => __( 'Thousand Separator', 'VRC' ),
			'desc'    => __( 'Default: , (Comma) | Example: $100,000', 'VRC' ),
			'default' => ','
		)
	);

	// Field: decimal_separator.
	$vr_settings_obj->add_field(
		'vr_general_settings',
		array(
			'id'      => 'decimal_separator',
			'type'    => 'text',
			'name'    => __( 'Decimal Separator', 'VRC' ),
			'desc'    => __( 'Default: . (Period) | Example: $100.00', 'VRC' ),
			'default' => '.'
		)
	);

	// Field: no_of_decimals.
	$vr_settings_obj->add_field(
		'vr_general_settings',
		array(
			'id'      => 'no_of_decimals',
			'type'    => 'number',
			'name'    => __( 'Number of Decimals', 'VRC' ),
			'desc'    => __( "Default: 0 | Leave as is if you don't know what it is.", 'VRC' ),
			'default' => '0'
		)
	);

	// Field: empty_price_text.
	$vr_settings_obj->add_field(
		'vr_general_settings',
		array(
			'id'      => 'empty_price_text',
			'type'    => 'text',
			'name'    => __( 'Empty Price Text', 'VRC' ),
			'desc'    => __( 'Example: On Call | Will be displayed if no price is present.', 'VRC' ),
			'default' => 'On Call'
		)
	);


} // if ended.
