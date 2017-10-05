<?php
/**
 * Fetured Rentals fields
 *
 * FRentals related fields.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Homepage_FRentals_Fields.
 *
 * Homepage frentals fields array class.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Homepage_FRentals_Fields' ) ) :

class VR_Homepage_FRentals_Fields {

	/**
	 * FRentals Fields array.
	 *
	 * @since 1.0.0
	 */
	public function get_fields() {
		// Prefix.
		$prefix = 'vr_homepage_';

		// Return the array.
		return array(
			// Enable/Disable FRentals Section.
			array(
				'id'      => "{$prefix}is_frentals_section",
				'type'    => 'radio',
				'name'    => __( 'Enable Fetured Rentals section?', 'VRC' ),
				'std'     => 'yes',
				'options' => array(
					'yes' => __('Yes.', 'VRC'),
					'no'  => __('No.', 'VRC'),
			    ),
			    'columns' => 12,
			    'tab'     => 'frentals'
			),

			// FRentals Section Title.
			array(
				'id'      => "{$prefix}frentals_section_title",
				'type'    => 'text',
				'name'    => __( 'Featured Rentals Section Title', 'VRC' ),
				'desc'    => 'Example Value: Featured Rentals',
				'std'     => 'Featured Rentals',
				'columns' => 12,
				'tab'     => 'frentals'
			),

			// FRentals Section Descripton.
			array(
				'id'      => "{$prefix}frentals_section_dsc",
				'type'    => 'wysiwyg',
				'raw'     => true,
				'options' => array(
								'media_buttons' => false,
								// 'teeny'=> true
							 ),
				'name'    => __( 'Featured Rentals Section Descripton', 'VRC' ),
				'std'     => 'No Featured Rentals section description added!',
				'columns' => 12,
				'tab'     => 'frentals'
			),

            array(
				'id'          => "{$prefix}no_of_frentals",
				'name'        => __( 'Select Number of Featured Rentals to be displayed', 'VRC' ),
				'type'        => 'select',
				'options'     => array(
					'2' => __( '2 - Two Featured Rentals', 'VRC' ),
					'4' => __( '4 - Four Featured Rentals', 'VRC' ),
					'6' => __( '6 - Six Featured Rentals', 'VRC' ),
					'8' => __( '8 - Eight Featured Rentals', 'VRC' ),
					'10' => __( '10 - Ten Featured Rentals', 'VRC' ),
				),
				// Default selected value
				'std'         => '2',
				// Placeholder
				'placeholder' => __( 'Select # of rentals', 'VRC' ),
            	'tab'     => 'frentals'
			)
		); // Fields array ended.
	} // Function ended.


}

endif;
