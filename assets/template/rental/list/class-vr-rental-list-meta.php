<?php
/**
 * Class VR_Rental_List_Meta
 *
 * Class for page rental list meta.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Make sure class doesn't exist before.
if ( ! class_exists( 'VR_Rental_List_Meta' ) ) :

	/**
	 * VR_Rental_List_Meta.
	 *
	 * Class for page rental list meta.
	 *
	 * @since 1.0.0
	 */
	class VR_Rental_List_Meta {
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
		 * Destination array.
		 *
		 * @var 	array
		 * @since 	1.0.0
		 */
		public $destination_array = array();

		/**
		 * Feature array.
		 *
		 * @var 	array
		 * @since 	1.0.0
		 */
		public $feature_array = array();

		/**
		 * Type array.
		 *
		 * @var 	array
		 * @since 	1.0.0
		 */
		public $type_array = array();

		// /**
		//  * Constructor.
		//  *
		//  * @since 1.0.0
		//  */
		// public function __construct() {
		// 	$this->destination_array = $this
		// }

		/**
		 * Get Taxonomy Terms Array.
		 *
		 * Gets tax terms on plugins loaded so that get_terms can work.
		 *
		 * @since 1.0.1
		 */
		public function get_tax_terms_array() {
			// Taxonomy Terms array.
			if ( function_exists( 'vr_get_function_obj' ) ) {
				// Get the VR_Functions object.
				$this->vr_function_obj = vr_get_function_obj();

				// Destination.
				$this->vr_function_obj->get_terms_array( 'vr_rental-destination', $this->destination_array );

				// Feature.
				$this->vr_function_obj->get_terms_array( 'vr_rental-feature', $this->feature_array );

				// Type.
				$this->vr_function_obj->get_terms_array( 'vr_rental-type', $this->type_array );

				// Uncomment to debug.
				// echo '<pre>' . var_dump( $this->destination_array ) . '</pre>';
				// echo '<pre>' . var_dump( $this->feature_array ) . '</pre>';
				// echo '<pre>' . var_dump( $this->type_array ) . '</pre>';
				// exit();
			} // End if().
		} // End function.

		/**
		 * Register meta boxes related to `page-rental-list`.
		 *
		 * @param   array   $meta_boxes
		 * @return  array   $meta_boxes
		 * @since   1.0.0
		 */
		public function register( $meta_boxes ) {

			if ( function_exists( 'vr_get_function_obj' ) ) {
				// Get the VR_Functions object.
				$this->vr_function_obj = vr_get_function_obj();

				// Destination.
				$this->vr_function_obj->get_terms_array( 'category', $tax_terms );
			} // End if().

			// Prefix.
			$prefix = 'vr_rental_list_';

			// Summary.
			$meta_boxes[]  = array(
				'id'         => 'vr_rental_list_metabox_summary_id',
				'title'      => __('Summary', 'VRC'),
				'post_types' => array( 'page' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'show'       => array(
					// List of page templates (used for page only). Array. Optional.
					// Page template file name. (if in the root)
					'template'   => array( 'page-rental-list.php' ),
				),
				'fields'     => array(
		            // Header BG Image.
		            array(
						'id'               => "{$prefix}header_bg_image",
						'type'             => 'image_advanced',
						'name'             => __('Header Background Image', 'VRC'),
						'desc'             => __( 'Make sure the image is not too small and not too big. Recommended size is 1920px x 450px (Width x Height).', 'VRC' ),
						'max_file_uploads' => 1,
		            ),
					// Summary.
					array(
						'id'      => "{$prefix}summary",
						'type'    => 'textarea',
						// 'type'    => 'wysiwyg',
						// 'raw'     => true,
						// 'options' => array(
						// 				'media_buttons' => false,
						// 				'teeny'=> true
						// 			 ),
						'name'    => __( 'Descripton', 'VRC' )
					),
				)
			);

			// Rental List.
			$meta_boxes[]  = array(
				'id'         => 'vr_rental_list_metabox_list_id',
				'title'      => __('Rental List', 'VRC'),
				'post_types' => array( 'page' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'show'       => array(
					// List of page templates (used for page only). Array. Optional.
					// Page template file name. (if in the root)
					'template'   => array( 'page-rental-list.php' ),
				),
				'fields'     => array(
					// Per page rentals.
					array(
						'id'   => "{$prefix}per_page",
						'name' => __( 'Number of Rentals Per Page', 'VRC' ),
						'type' => 'number',
						'step' => 1,
						'min'  => 3,
						'std'  => 6
					),

					// Order by.
					array(
						'id'          => "{$prefix}orderby",
						'name'        => __( 'Order Rentals By', 'VRC' ),
						'type'        => 'select',
						'options'     => array(
							'date_desc'     => __( 'Date Recent to Old', 'VRC' ),
							'date_asc'      => __( 'Date Old to Recent', 'VRC' ),
							'price_asc'     => __( 'Price Low to High', 'VRC' ),
							'price_desc'    => __( 'Price High to Low', 'VRC' ),
						),
						'multiple'    => false,
						'std'         => 'date_desc'
					),

					// Min beds.
					array(
						'id'   => "{$prefix}min_beds",
						'name' => __( 'Minimum Beds', 'VRC' ),
						'type' => 'number',
						'step' => 1,
						'min'  => 0,
						'std'  => 0
					),

					// Min baths.
					array(
						'id'   => "{$prefix}min_baths",
					    'name'  => __( 'Minimum Baths', 'VRC' ),
					    'type'  => 'number',
					    'step'  => 1,
					    'min'   => 0,
					    'std'   => 0
					),

					// Min baths.
					array(
						'id'   => "{$prefix}min_guests",
					    'name'  => __( 'Minimum Guests', 'VRC' ),
					    'type'  => 'number',
					    'step'  => 1,
					    'min'   => 0,
					    'std'   => 0
					),

					// Min price.
					array(
						'id'   => "{$prefix}min_price",
					    'name'  => __( 'Minimum Price', 'VRC' ),
					    'type'  => 'number',
					    'min'   => 0,
					    'std'   => 0
					),

					// Max price.
					array(
						'id'   => "{$prefix}max_price",
					    'name'  => __( 'Maximum Price', 'VRC' ),
					    'type'  => 'number',
					    'min'   => 0,
					),

					// Destination.
					array(
						'id'              => "{$prefix}destination",
						'name'            => __( 'Destinations', 'VRC' ),
						'desc'            => __( 'Press & hold ⌘ Command (on Mac) or CTRL (on Windows) to select multiple destinations.', 'VRC' ),
						'type'            => 'select',
						'options'         => $this->destination_array,
						// 'options'      => $tax_terms,
						'multiple'        => true,
						'select_all_none' => true,
					),

					// Feature.
					array(
						'id'              => "{$prefix}feature",
						'name'            => __( 'Features', 'VRC' ),
						'desc'            => __( 'Press & hold ⌘ Command (on Mac) or CTRL (on Windows) to select multiple features.', 'VRC' ),
						'type'            => 'select',
						'options'         => $this->feature_array,
						'multiple'        => true,
						'select_all_none' => true,
					),

					// Type.
					array(
						'id'              => "{$prefix}type",
						'name'            => __( 'Types', 'VRC' ),
						'desc'            => __( 'Press & hold ⌘ Command (on Mac) or CTRL (on Windows) to select multiple types.', 'VRC' ),
						'type'            => 'select',
						'options'         => $this->type_array,
						'multiple'        => true,
						'select_all_none' => true,
					)
				)
			);

			// Uncomment to debug. Prints the tax term arrays.
			// echo '<pre>' . var_dump( $meta_boxes[10]['fields'][7]['options'] ) . '</pre>';
			// echo '<pre>' . var_dump( $meta_boxes[10]['fields'][8]['options'] ) . '</pre>';
			// echo '<pre>' . var_dump( $meta_boxes[10]['fields'][9]['options'] ) . '</pre>';
			// exit();
			// Return.
			return $meta_boxes;
		} // register() ended.

	}

endif;
