<?php
/**
 * Homepage Steps fields
 *
 * Steps related fields.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Homepage_Steps_Fields.
 *
 * Homepage steps fields array class.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Homepage_Steps_Fields' ) ) :

class VR_Homepage_Steps_Fields {

	/**
	 * Steps Fields array.
	 *
	 * @since 1.0.0
	 */
	public function get_fields() {
		// Prefix.
		$prefix = 'vr_homepage_';

		// Return the array.
		return array(
			// Enable/Disable Steps Section.
			array(
				'id'      => "{$prefix}is_steps_section",
				'type'    => 'radio',
				'name'    => __( 'Enable Steps section?', 'VRC' ),
				'std'     => 'yes',
				'options' => array(
					'yes' => __('Yes.', 'VRC'),
					'no'  => __('No.', 'VRC'),
			    ),
			    'columns' => 12,
			    'tab'     => 'steps'
			),

			// Enable/Disable Steps Section BG.
			array(
				'id'      => "{$prefix}is_steps_bg",
				'type'    => 'radio',
				'name'    => __( 'Enable Steps section background (arrow passing through the steps)?', 'VRC' ),
				'desc'    => __( 'Looks good if you have 3 steps only!', 'VRC' ),
				'std'     => 'yes',
				'options' => array(
					'yes' => __('Yes.', 'VRC'),
					'no'  => __('No.', 'VRC'),
			    ),
			    'columns' => 12,
			    'tab'     => 'steps'
			),

			// Steps Section Title.
			array(
				'id'      => "{$prefix}steps_section_title",
				'type'    => 'text',
				'name'    => __( 'Steps Section Title', 'VRC' ),
				'desc'    => 'Example Value: Steps',
				'std'     => 'No Steps Section Title Added',
				'columns' => 12,
				'tab'     => 'steps'
			),

			// Steps Section Descripton.
			array(
				'id'      => "{$prefix}steps_section_dsc",
				'type'    => 'wysiwyg',
				'raw'     => true,
				'options' => array(
								'media_buttons' => false,
								// 'teeny'=> true
							 ),
				'name'    => __( 'Steps Section Descripton', 'VRC' ),
				'std'     => 'No Steps section description added!',
				'columns' => 12,
				'tab'     => 'steps'
			),

			// Repeatable steps.
            // Group.
            array(
				'id'         => "{$prefix}group_steps",
				'type'       => 'group',
				'clone'      => true,
				'sort_clone' => true,
				'tab'        => 'steps',
				'fields'     => array(
					// Image Icon.
        			array(
						'id'               => "{$prefix}step_img",
						'type'             => 'image_advanced',
						'name'             => __( 'Step Icon', 'VRC' ),
						'desc'             => "Add step's Icon image.",
						'std'              => '//placehold.it/100/03a9f5?text=!',
						'columns'          => 3,
						'max_file_uploads' => 1,
        			),

					// Name of the steps.
					array(
						'id'   => "{$prefix}step_name",
						'type' => 'text',
						'name' => __( 'Step Name', 'VRC' ),
						'desc' => 'Example Value: Quality',
						'columns' => 3,
					),

					// Description of the steps.
					array(
						'id'      => "{$prefix}step_dsc",
						'type'    => 'textarea',
						'name'    => __( 'Step Descriptoin', 'VRC' ),
						'columns' => 6,
					),

        		) // Sub-Fields ended.

            ), // Field Group ended.

            // Button Text.
            array(
            	'id'      => "{$prefix}steps_btn_txt",
            	'type'    => 'text',
            	'name'    => __( 'Steps Section Button Text', 'VRC' ),
            	'desc'    => 'Example Value: Read More',
            	'std'     => 'Read More',
            	'columns' => 12,
            	'tab'     => 'steps'
            ),

            // Button URL.
            array(
            	'id'      => "{$prefix}steps_btn_url",
            	'type'    => 'url',
            	'name'    => __( 'Steps Section Button URL', 'VRC' ),
            	'desc'    => 'Example Value: http://Google.com/',
            	'columns' => 12,
            	'tab'     => 'steps'
            ),
		); // Fields array ended.
	} // Function ended.


}

endif;
