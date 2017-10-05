<?php
/**
 * Rental Destination related metaboxes
 *
 * Metaboxes for `vr_rental-destination` taxonomy.
 *
 * @since 	1.0.1
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'VR_Destination_Meta_Boxes' ) ) :

/**
 * VR_Destination_Meta_Boxes.
 *
 * Rental related metaboxes class.
 *
 * @since 1.0.1
 */
class VR_Destination_Meta_Boxes {

	/**
	 * Register meta boxes related to `vr_rental-destination` taxonomy.
	 *
	 * @since   1.0.1
	 *
	 * @param 	array   $meta_boxes Metaboxes array.
	 * @return  array   $meta_boxes
	 */
	public function register( $meta_boxes ) {
		// TODO: Recommended image dimensions.
	    $prefix = 'vr_destination_';

	    $meta_boxes[] = array(
			'id'         => 'vr_destination_meta_box_extra_id',
			'title'      => __('Destination Extra Settings', 'VRC'),

			'taxonomies' => 'vr_rental-destination', // List of taxonomies. Array or string

			// 'context'    => 'normal',
			// 'priority'   => 'high',

			'fields'    => array(
				array(
					'id'          => "{$prefix}order",
					'type'        => 'number',
					'name'        => __( 'Order', 'VRC' ),
					'desc'        => __('Homepage Destination Order. Lower value has more priority i.e. 10 order will get displayed before 20 order.', 'VRC'),
					'step'        => 'any',
					'min'         => 0,
					'std'         => 1000,
				),
	        ) // Fields ended.
	    ); // Metboxes array ended.

	    return $meta_boxes;
	} // Register function End.
} // Class end.
endif;
