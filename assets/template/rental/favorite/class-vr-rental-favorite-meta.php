<?php
/**
 * Class VR_Rental_Favorite_Meta
 *
 * Class for page rental fav meta.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Rental_Favorite_Meta.
 *
 * Class for page rental fav meta.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Rental_Favorite_Meta' ) ) :

class VR_Rental_Favorite_Meta {
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
	 * Register meta boxes related to `page-user-favorites.php`.
	 *
	 * @param   array   $meta_boxes
	 * @return  array   $meta_boxes
	 * @since   1.0.0
	 */
	public function register( $meta_boxes ) {
		// Prefix.
		$prefix = 'vr_rental_fav_';


		// Summary.
		$meta_boxes[]  = array(
			'id'         => 'vr_rental_fav_metabox_desc_id',
			'title'      => __('Summary', 'VRC'),
			'post_types' => array( 'page' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'show'       => array(
				// Favorite of page templates (used for page only). Array. Optional.
				// Page template file name. (if in the root)
				'template'   => array( 'page-user-favorites.php' ),
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
					'id'   => "{$prefix}desc",
					'type' => 'textarea',
					'name' => __( 'Descripton', 'VRC' ),
					'std'  => __( 'Explore your favorite vacation rentals.', 'VRC')
				)
			)
		);

		// Return.
		return $meta_boxes;
	} // register() ended.

}

endif;

