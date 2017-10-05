<?php
/**
 * Class VR_Rental_Search_Meta
 *
 * Class for page rental search meta.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'VR_Rental_Search_Meta' ) ) :

/**
 * VR_Rental_Search_Meta.
 *
 * Class for page rental search meta.
 *
 * @since 1.0.0
 */
class VR_Rental_Search_Meta {
	/**
	 * Metaboxes.
	 *
	 * @var 	array
	 * @since 	1.0.0
	 */
	public $meta_boxes = array();

	/**
	 * VR_Functions object.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	public $vr_function_obj;


	/**
	 * Register meta boxes related to `page-rental-search.php`.
	 *
	 * @param   array   $meta_boxes
	 * @return  array   $meta_boxes
	 * @since   1.0.0
	 */
	public function register( $meta_boxes ) {
		// Prefix.
		$prefix = 'vr_rental_search_';


		// Summary.
		$meta_boxes[]  = array(
			'id'         => 'vr_rental_search_metabox_desc_id',
			'title'      => __('Summary', 'VRC'),
			'post_types' => array( 'page' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'show'       => array(
				// Search of page templates (used for page only). Array. Optional.
				// Page template file name. (if in the root)
				'template'   => array( 'page-rental-search.php' ),
			),
			'fields'     => array(
				// Summary.
				array(
					'id'   => "{$prefix}desc",
					'type' => 'textarea',
					'name' => __( 'Descripton', 'VRC' ),
					'std'  => __( 'Find the best bread and breakfast place.', 'VRC')
				),

				// Sort by text.
				array(
					'id'   => "{$prefix}sortby",
					'type' => 'text',
					'name' => __( 'Sortby Text', 'VRC' ),
					'std'  => __( 'Sort By', 'VRC')
				),
			)
		);


		// Rental Search.
		$meta_boxes[]  = array(
			'id'         => 'vr_rental_search_metabox_search_id',
			'title'      => __('Rental Search', 'VRC'),
			'post_types' => array( 'page' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'show'       => array(
				// Search of page templates (used for page only). Array. Optional.
				// Page template file name. (if in the root)
				'template'   => array( 'page-rental-search.php' ),
			),
			'fields'     => array(
				// Hide Map.
				array(
					'id'   => "{$prefix}hide_map",
					'type' => 'checkbox',
					'std'  => '0',
					'name' => __( 'Hide Map?', 'VRC' ),
					'desc' => __( 'Check to hide Map on this search page?', 'VRC' ),
				),

				// Hide Destination.
				array(
					'id'   => "{$prefix}hide_destination",
					'type' => 'checkbox',
					'std'  => '0',
					'name' => __( 'Hide Destination?', 'VRC' ),
					'desc' => __( 'Check to hide Destination on this search page?', 'VRC' ),
				),

				// Hide Type.
				array(
					'id'   => "{$prefix}hide_type",
					'type' => 'checkbox',
					'std'  => '0',
					'name' => __( 'Hide Type?', 'VRC' ),
					'desc' => __( 'Check to hide Type on this search page?', 'VRC' ),
				),

				// Hide Feature.
				array(
					'id'   => "{$prefix}hide_feature",
					'type' => 'checkbox',
					'std'  => '0',
					'name' => __( 'Hide Feature?', 'VRC' ),
					'desc' => __( 'Check to hide Feature on this search page?', 'VRC' ),
				),

				// Hide Check In & Check Out.
				array(
					'id'   => "{$prefix}hide_check_in_out",
					'type' => 'checkbox',
					'std'  => '0',
					'name' => __( 'Hide Check In & Check Out?', 'VRC' ),
					'desc' => __( 'Check to hide Check In & Check Out on this search page?', 'VRC' ),
				),

				// Hide Description.
				array(
					'id'   => "{$prefix}hide_desc",
					'type' => 'checkbox',
					'std'  => '0',
					'name' => __( 'Hide Description?', 'VRC' ),
					'desc' => __( 'Check to hide Description? on this search page?', 'VRC' ),
				),

				// Hide Sorting.
				array(
					'id'   => "{$prefix}hide_sorting",
					'type' => 'checkbox',
					'std'  => '0',
					'name' => __( 'Hide Sorting?', 'VRC' ),
					'desc' => __( 'Check to hide Sorting? on this search page?', 'VRC' ),
				),

			) // fields ended.
		);

		// Return.
		return $meta_boxes;
	} // register() ended.

}

endif;

