<?php
/**
 * Rental Destination
 *
 * Custom taxonomy `rental-destination`.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Rental_Destination
 *
 * Custom taxonomy `rental-destination`.
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'VR_Rental_Destination' ) ) :
class VR_Rental_Destination {
	/**
	 * Custom Taxonomy: `rental-destination`.
	 */
	public function register() {
		// Labels.
	    $labels = array(
	        'name'                       => _x( 'Rental Destination', 'Taxonomy General Name', 'VRC' ),
	        'singular_name'              => _x( 'Rental Destination', 'Taxonomy Singular Name', 'VRC' ),
	        'menu_name'                  => __( 'Destination', 'VRC' ),
	        'all_items'                  => __( 'All Rental Destinations', 'VRC' ),
	        'parent_item'                => __( 'Parent Rental Destination', 'VRC' ),
	        'parent_item_colon'          => __( 'Parent Rental Destination:', 'VRC' ),
	        'new_item_name'              => __( 'New Rental Destination Name', 'VRC' ),
	        'add_new_item'               => __( 'Add New Rental Destination', 'VRC' ),
	        'edit_item'                  => __( 'Edit Rental Destination', 'VRC' ),
	        'update_item'                => __( 'Update Rental Destination', 'VRC' ),
	        'view_item'                  => __( 'View Rental Destination', 'VRC' ),
	        'separate_items_with_commas' => __( 'Separate Rental Destinations with commas', 'VRC' ),
	        'add_or_remove_items'        => __( 'Add or remove Rental Destinations', 'VRC' ),
	        'choose_from_most_used'      => __( 'Choose from the most used', 'VRC' ),
	        'popular_items'              => __( 'Popular Rental Destinations', 'VRC' ),
	        'search_items'               => __( 'Search Rental Destinations', 'VRC' ),
	        'not_found'                  => __( 'Not Found', 'VRC' )
	    );

	    $rewrite = array(
			// 'slug'         => apply_filters( 'inspiry_property_city_slug', __( 'property-city', 'VRC' ) ),
			'slug'         => 'rental-destination',
			'with_front'   => true,
			'hierarchical' => true
	    );

	    $args = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_in_menu'      => 'vr_rental',
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => $rewrite
	    );

	    register_taxonomy( 'vr_rental-destination', array( 'vr_rental' ), $args );
	}
}
endif;
