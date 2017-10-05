<?php
/**
 * Rental Type.
 *
 * Custom taxonomy rental-type for rental post type.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * VR_CT_Rental_Type
 *
 * Class for custom taxonomy `rental-type`.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_CT_Rental_Type' ) ) :

class VR_CT_Rental_Type {

	/**
	 * Custom taxonomy: rental-type
	 */
	public function register() {

	    $labels = array(
			'name'                       => _x( 'Rental Type', 'Taxonomy General Name', 'VRC' ),
			'singular_name'              => _x( 'Rental Type', 'Taxonomy Singular Name', 'VRC' ),
			'menu_name'                  => __( 'Types', 'VRC' ),
			'all_items'                  => __( 'All Rental Types', 'VRC' ),
			'parent_item'                => __( 'Parent Rental Type', 'VRC' ),
			'parent_item_colon'          => __( 'Parent Rental Type:', 'VRC' ),
			'new_item_name'              => __( 'New Rental Type Name', 'VRC' ),
			'add_new_item'               => __( 'Add New Rental Type', 'VRC' ),
			'edit_item'                  => __( 'Edit Rental Type', 'VRC' ),
			'update_item'                => __( 'Update Rental Type', 'VRC' ),
			'view_item'                  => __( 'View Rental Type', 'VRC' ),
			'separate_items_with_commas' => __( 'Separate Rental Types with commas', 'VRC' ),
			'add_or_remove_items'        => __( 'Add or remove Rental Types', 'VRC' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'VRC' ),
			'popular_items'              => __( 'Popular Rental Types', 'VRC' ),
			'search_items'               => __( 'Search Rental Types', 'VRC' ),
			'not_found'                  => __( 'Not Found', 'VRC' ),
	    );

	    $rewrite = array(
	        // 'slug'                       => apply_filters( 'inspiry_rental-type_slug', __( 'rental-type', 'VRC' ) ),
			'slug'         => 'rental-type',
			'with_front'   => true,
			'hierarchical' => true,
	    );

	    $args = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => $rewrite,
	    );

	    register_taxonomy( 'vr_rental-type', array( 'vr_rental' ), $args );

	}
}

endif;

?>
