<?php
/**
 * Homepage FCTA fields
 *
 * FCTA related fields.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Homepage_FCTA_Fields.
 *
 * Homepage cta fields array class.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Homepage_FCTA_Fields' ) ) :

class VR_Homepage_FCTA_Fields {

	/**
	 * FCTA Fields array.
	 *
	 * @since 1.0.0
	 */
	public function get_fields() {
		// Prefix.
		$prefix = 'vr_homepage_';

		// Return the array.
		return array(
			// Enable/Disable FCTA Section.
			array(
				'id'      => "{$prefix}is_fcta_section",
				'type'    => 'radio',
				'name'    => __( 'Enable Footer CTA section?', 'VRC' ),
				'std'     => 'yes',
				'options' => array(
					'yes' => __('Yes.', 'VRC'),
					'no'  => __('No.', 'VRC'),
			    ),
			    'columns' => 12,
			    'tab'     => 'fcta'
			),

			// FCTA Section Title.
			array(
				'id'      => "{$prefix}fcta_section_title",
				'type'    => 'text',
				'name'    => __( 'Footer CTA Section Title', 'VRC' ),
				'desc'    => 'Example Value: Call to Action Section',
				'std'     => 'Call to Action Section',
				'columns' => 12,
				'tab'     => 'fcta'
			),

			// FCTA Section Descripton.
			array(
				'id'      => "{$prefix}fcta_section_dsc",
				'type'    => 'wysiwyg',
				'raw'     => true,
				'options' => array(
								'media_buttons' => false,
								// 'teeny'=> true
							 ),
				'name'    => __( 'Footer CTA Section Descripton', 'VRC' ),
				'columns' => 12,
				'tab'     => 'fcta'
			),

            // Button Text.
            array(
            	'id'      => "{$prefix}fcta_btn_txt",
            	'type'    => 'text',
            	'name'    => __( 'Footer CTA Section Button Text', 'VRC' ),
            	'desc'    => 'Example Value: Read More',
            	'std'     => 'Read More',
            	'columns' => 12,
            	'tab'     => 'fcta'
            ),

            // Button URL.
            array(
            	'id'      => "{$prefix}fcta_btn_url",
            	'type'    => 'url',
            	'name'    => __( 'Footer CTA Section Button URL', 'VRC' ),
            	'desc'    => 'Example Value: http://Google.com/',
            	'columns' => 12,
            	'tab'     => 'fcta'
            ),

			// BG Image.
            array(
				'id'               => "{$prefix}fcta_bg_img",
				'type'             => 'image_advanced',

				'name'             => __('Footer CTA Section Background Image', 'VRC'),
				'desc'             => __('Make sure the image is not too small and not too big.', 'VRC'),

				'max_file_uploads' => 1,
				'columns'          => 12,
				'tab'              => 'fcta'
            ),

		); // Fields array ended.
	} // Function ended.


}

endif;
