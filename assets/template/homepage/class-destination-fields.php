<?php
/**
 * Homepage Destination fields
 *
 * Destination related fields.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'VR_Homepage_Destination_Fields' ) ) :

/**
 * VR_Homepage_Destination_Fields.
 *
 * Homepage destination fields array class.
 *
 * @since 1.0.0
 */
class VR_Homepage_Destination_Fields {

	/**
	 * Destination Fields array.
	 *
	 * @since 1.0.0
	 */
	public function get_fields() {
		// Prefix.
		$prefix = 'vr_homepage_';

		// Return the array.
		return array(
			// Enable/Disable Destination Section.
			array(
				'id'      => "{$prefix}is_destination_section",
				'type'    => 'radio',
				'name'    => __( 'Enable Destination section?', 'VRC' ),
				'std'     => 'yes',
				'options' => array(
					'yes' => __('Yes.', 'VRC'),
					'no'  => __('No.', 'VRC'),
			    ),
			    'columns' => 12,
			    'tab'     => 'destination'
			),

			// Destination Section Title.
			array(
				'id'      => "{$prefix}destination_section_title",
				'type'    => 'text',
				'name'    => __( 'Destination Section Title', 'VRC' ),
				'desc'    => __( 'Example Value: Popular Destinations', 'VRC' ),
				'std'     => __( 'Popular Destinations', 'VRC' ),
				'columns' => 12,
				'tab'     => 'destination'
			),

			// Destination Section Descripton.
			array(
				'id'      => "{$prefix}destination_section_dsc",
				'type'    => 'wysiwyg',
				'raw'     => true,
				'options' => array(
								'media_buttons' => false,
								// 'teeny'=> true
							 ),
				'name'    => __( 'Destination Section Descripton', 'VRC' ),
				'columns' => 12,
				'tab'     => 'destination'
			),

			// Select Popular Destionat #1.
			array(
				'id'                   => "{$prefix}the_destinations",
				'type'                 => 'taxonomy_advanced',
				'name'                 => __( 'Select Popular Destinations', 'VRC' ),
				'desc'                 => 'Note: Looks best when 4 or 7 destinations are selected.',
				// Taxonomy name.
				'taxonomy'             => 'vr_rental-destination',

				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional.
				'field_type'           => 'checkbox_list',

				'sort_clone'           => true,

				// Additional arguments for get_terms() function. Optional.
				'query_args'           => array(
					'hide_empty' => false,
					// TODO: It works but user needs to set a value otherwise nothing shows up. Defualt ain't working.
					// 'orderby'    => 'meta_value', // 'name', 'slug', 'term_group', 'term_id', 'id', 'description'
					// 'meta_key'   => 'vr_destination_order',
				),
				'columns'              => 12,
				'tab'                  => 'destination'
			),

			array(
				'id'      => "{$prefix}destination_note_for_images",
				'type'    => 'custom_html',
				'columns' => 12,
				'tab'     => 'destination',
				// HTML content.
				'std'     => '<p style="padding: 1rem;background: #f1f1f1;">
								If no destinations are being displayed, then you need to add a few destinations via <a href="/wp-admin/edit-tags.php?taxonomy=vr_rental-destination&post_type=vr_rental" target="_blank">Destinations Page</a>.
								(Make sure you have added feature images to the destinations you selected above).
							</p>
							<p style="padding: 1rem;background: #f1f1f1;">
								To reorder how destinations get displayed on the homepage, edit a <a href="/wp-admin/edit-tags.php?taxonomy=vr_rental-destination&post_type=vr_rental" target="_blank">Destination</a> to add order.
								(Lower value has more priority i.e. 10 order will get displayed before 20 order).
							</p>
							',
			), // Field ended.
		); // Fields array ended.
	} // Function ended.


}

endif;
