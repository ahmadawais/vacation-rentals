<?php
/**
 * Homepage Testimonial And News
 *
 * Testimonial And News related fields.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Homepage_TandN_Fields.
 *
 * Homepage tandn fields array class.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Homepage_TandN_Fields' ) ) :

class VR_Homepage_TandN_Fields {

	/**
	 * Feature Fields array.
	 *
	 * @since 1.0.0
	 */
	public function get_fields() {
		// Prefix.
		$prefix = 'vr_homepage_';

		// Return the array.
		return array(
			// Enable/Disable Feature Section.
			array(
				'id'      => "{$prefix}is_tandn_section",
				'type'    => 'radio',
				'name'    => __( 'Enable Testimonial And News section?', 'VRC' ),
				'std'     => 'yes',
				'options' => array(
					'yes' => __('Yes.', 'VRC'),
					'no'  => __('No.', 'VRC'),
			    ),
			    'columns' => 12,
			    'tab'     => 'tandn'
			),

			// Testimonial Title.
			array(
				'id'      => "{$prefix}tandn_section_ttml_title",
				'type'    => 'text',
				'name'    => __( 'Testimonial Title', 'VRC' ),
				'desc'    => 'Example Value: Testimonials',
				'std'     => 'Testimonials',
				'columns' => 12,
				'tab'     => 'tandn'
			),

			// Repeatable tandns.
            // Group.
            array(
				'id'         => "{$prefix}group_ttml",
				'type'       => 'group',
				'clone'      => true,
				'sort_clone' => true,
				'tab'        => 'tandn',
				'fields'     => array(
					// Image Icon.
        			array(
						'id'               => "{$prefix}ttml_img",
						'type'             => 'image_advanced',
						'name'             => __( 'Testimonial User Image', 'VRC' ),
						'desc'             => "Add user's image for the testimonial.",
						'std'              => '//placehold.it/100/03a9f5?text=!',
						'columns'          => 6,
						'max_file_uploads' => 1
        			),

        			// Image URL.
        			array(
        				'id'      => "{$prefix}ttml_img_url",
        				'type'    => 'url',
        				'name'    => __( '(OPTIONAL) Testimonial URL LINK', 'VRC' ),
        				'desc'    => 'Example Value: http://Google.com/',
        				'columns' => 6,
        			),

					// Name of the tandn.
					array(
						'id'   => "{$prefix}ttml_name",
						'type' => 'text',
						'name' => __( "Testimonial User's Name", "VRC" ),
						'desc' => 'Example Value: John Doe',
						'columns' => 6
					),

					// Name of the tandn.
					array(
						'id'   => "{$prefix}ttml_user_details",
						'type' => 'text',
						'name' => __( "Testimonial User's Details", "VRC" ),
						'desc' => 'Example Value: CTO at Google',
						'columns' => 6
					),

					// Description of the tandn.
					array(
						'id'      => "{$prefix}ttml_testimonial",
						'type'    => 'textarea',
						'name'    => __( 'Testimonial', 'VRC' ),
						'columns' => 12
					),

        		) // Sub-Fields ended.

            ), // Field Group ended.

            // News Title.
            array(
            	'id'      => "{$prefix}tandn_section_news_title",
            	'type'    => 'text',
            	'name'    => __( 'News Title', 'VRC' ),
            	'desc'    => 'Example Value: News or Blog',
            	'std'     => 'News',
            	'columns' => 12,
            	'tab'     => 'tandn'
            ),

            // Button Text.
            array(
            	'id'      => "{$prefix}tandn_btn_txt",
            	'type'    => 'text',
            	'name'    => __( 'News Button Text', 'VRC' ),
            	'desc'    => 'Example Value: View All News. This button will link to your blog page automatically.',
            	'std'     => 'Read More',
            	'columns' => 12,
            	'tab'     => 'tandn'
            ),
		); // Fields array ended.
	} // Function ended.


}

endif;
