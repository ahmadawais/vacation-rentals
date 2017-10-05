<?php
/**
 * Class for Partner meta boexes
 *
 * Meta boxes for `vr_partner` post type.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Partner_Meta_Boxes.
 *
 * Class for `vr_partner` meta boxes.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Partner_Meta_Boxes' ) ) :

class VR_Partner_Meta_Boxes {


	/**
	 * Register meta boxes related to `vr_partner` post type
	 *
	 * @param   array   $meta_boxes
	 * @return  array   $meta_boxes
	 * @since   1.0.0
	 */
	public function register( $meta_boxes ) {

	    $prefix = 'vr_partner_';

	    $meta_boxes[] = array(
			'id'       => 'vr_partner_meta_box_details_id',
			'title'    => __('Partner Information', 'VRC'),
			'pages'    => array( 'vr_partner' ),
			'context'  => 'normal',
			'priority' => 'high',
			'fields'   => array(
	            array(
					'id'   => "{$prefix}url",
					'type' => 'url',

					'name' => __('Website URL', 'VRC'),
					'desc' => __('Provide partner website URL. Example Value: http://Google.com (Must have http://)', 'VRC')
	            )
	        )
	    );

	    return $meta_boxes;

	} // Register function End.

} // Class ended.

endif;
