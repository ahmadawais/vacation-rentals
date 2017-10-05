<?php
/**
 * Homepage CTA fields
 *
 * CTA related fields.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Homepage_CTA_Fields.
 *
 * Homepage cta fields array class.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Homepage_CTA_Fields' ) ) :

class VR_Homepage_CTA_Fields {

	/**
	 * CTA Fields array.
	 *
	 * @since 1.0.0
	 */
	public function get_fields() {
		// Prefix.
		$prefix = 'vr_homepage_';

		// Return the array.
		return array(
			// Enable/Disable CTA Section.
			array(
				'id'      => "{$prefix}is_cta_section",
				'type'    => 'radio',
				'name'    => __( 'Enable CTA section?', 'VRC' ),
				'std'     => 'yes',
				'options' => array(
					'yes' => __('Yes.', 'VRC'),
					'no'  => __('No.', 'VRC'),
			    ),
			    'columns' => 12,
			    'tab'     => 'cta'
			),

			// CTA Section Title.
			array(
				'id'      => "{$prefix}cta_section_title",
				'type'    => 'text',
				'name'    => __( 'CTA Section Title', 'VRC' ),
				'desc'    => 'Example Value: Call to Action Section',
				'std'     => 'Call to Action Section',
				'columns' => 12,
				'tab'     => 'cta'
			),

			// CTA Section Descripton.
			array(
				'id'      => "{$prefix}cta_section_dsc",
				'type'    => 'wysiwyg',
				'raw'     => true,
				'options' => array(
								'media_buttons' => false,
								// 'teeny'=> true
							 ),
				'name'    => __( 'CTA Section Descripton', 'VRC' ),
				'columns' => 12,
				'tab'     => 'cta'
			),

            // Button Text.
            array(
            	'id'      => "{$prefix}cta_btn_txt",
            	'type'    => 'text',
            	'name'    => __( 'CTA Section Button Text', 'VRC' ),
            	'desc'    => 'Example Value: Read More',
            	'std'     => 'Read More',
            	'columns' => 12,
            	'tab'     => 'cta'
            ),

            // Button URL.
            array(
            	'id'      => "{$prefix}cta_btn_url",
            	'type'    => 'url',
            	'name'    => __( 'CTA Section Button URL', 'VRC' ),
            	'desc'    => 'Example Value: http://Google.com/',
            	'columns' => 12,
            	'tab'     => 'cta'
            ),

			// BG Image.
            array(
				'id'               => "{$prefix}cta_bg_img",
				'type'             => 'image_advanced',

				'name'             => __('CTA Section Background Image', 'VRC'),
				'desc'             => __('Make sure the image is not too small and not too big. Recommended size is 1920px x 450px (Width x Height)', 'VRC'),

				'max_file_uploads' => 1,
				'columns'          => 12,
				'tab'              => 'cta'
            ),

			// Icon Image.
            array(
				'id'               => "{$prefix}cta_icon_img",
				'type'             => 'image_advanced',

				'name'             => __('CTA Section Icon Image', 'VRC'),
				'desc'             => __('Make sure it is not too big. E.g. Recommended size is 50px x 50px (Width x Height)', 'VRC'),

				'max_file_uploads' => 1,
				'columns'          => 12,
				'tab'              => 'cta'
            ),

		); // Fields array ended.
	} // Function ended.


}

endif;
