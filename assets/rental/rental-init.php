<?php
/**
 * Rentals data initializer
 *
 * Initializes everything related to `rental` post type.
 *
 * @since   1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Admin/Renatals.
 *
 * Rentals related files.
 *
 * @since 1.0.0
 */

// Custom Post Type: `vr_rental`.
if ( file_exists( VRC_DIR . '/assets/rental/cpt-rental.php' ) ) {
	require_once( VRC_DIR . '/assets/rental/cpt-rental.php' );
}

// Custom Taxonomy: `rental-type`.
if ( file_exists( VRC_DIR . '/assets/rental/ct-rental-type.php' ) ) {
	require_once( VRC_DIR . '/assets/rental/ct-rental-type.php' );
}

// Custom Taxonomy: `rental-destination`.
if ( file_exists( VRC_DIR . '/assets/rental/ct-rental-destination.php' ) ) {
	require_once( VRC_DIR . '/assets/rental/ct-rental-destination.php' );
}

// Custom Taxonomy: `rental-feature`.
if ( file_exists( VRC_DIR . '/assets/rental/ct-rental-feature.php' ) ) {
	require_once( VRC_DIR . '/assets/rental/ct-rental-feature.php' );
}

// Custom columns for `rental` post type.
if ( file_exists( VRC_DIR . '/assets/rental/rental-custom-columns.php' ) ) {
	require_once( VRC_DIR . '/assets/rental/rental-custom-columns.php' );
}


/**
 * Class: VR_Rental.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/rental/class-rental.php' ) ) {
	require_once( VRC_DIR . '/assets/rental/class-rental.php' );
}


/**
 * Class: VR_Rental_Meta_Boxes.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/rental/class-rental-meta-boxes.php' ) ) {
	require_once( VRC_DIR . '/assets/rental/class-rental-meta-boxes.php' );
}


/**
 * Class: VR_Get_Rental.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/rental/class-get-rental.php' ) ) {
	require_once( VRC_DIR . '/assets/rental/class-get-rental.php' );
}


/**
 * Methods: For class `VR_Get_Rental`.
 *
 * Since plugin class is not accessible in themes.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/rental/methods-get-rental.php' ) ) {
	require_once( VRC_DIR . '/assets/rental/methods-get-rental.php' );
}


/**
 * Frontend Rental Iniatializer.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/rental/frontend/frontend-init.php' ) ) {
	require_once( VRC_DIR . '/assets/rental/frontend/frontend-init.php' );
}

/**
 * Rental Destination Meta.
 *
 * @since 1.0.1
 */
if ( file_exists( VRC_DIR . '/assets/rental/class-destination-meta-boxes.php' ) ) {
	require_once( VRC_DIR . '/assets/rental/class-destination-meta-boxes.php' );
}

/**
 * Actions/Filters for rental.
 *
 * Classes:
 *        1. VR_Rental
 *        2. VR_Rental_Custom_Columns
 *        3. VR_Rental_Meta_Boxes
 */
if ( class_exists( 'VR_Rental' ) ) {
	// Object: VR_Rental class.
	$vr_rental_init = new VR_Rental();

	// Create rental post type.
	add_action( 'init', array( $vr_rental_init, 'create_rental' ), 0 );

	// Create fake rental content.
	// add_action( 'init', array( $vr_rental_init, 'fake_rental_content' ) );

	// Create rental-destination CT.
	add_action( 'init', array( $vr_rental_init, 'create_rental_destination' ), 0 );

	// Create rental-type CT.
	add_action( 'init', array( $vr_rental_init, 'create_rental_type' ), 0 );

	// Create rental-feature CT.
	add_action( 'init', array( $vr_rental_init, 'create_rental_feature' ), 0 );

	// Insert dummy rental-feature.
	// add_action( 'init', array( $vr_rental_init, 'insert_dummy_features' ), 11 );
}

// Custom columns.
if ( class_exists( 'VR_Rental_Custom_Columns' ) ) {
	// Object: VR_Rental_Custom_Columns class.
	$vr_rental_custom_columns = new VR_Rental_Custom_Columns();

	// Rental Custom Columns Registered
	add_filter( 'manage_edit-vr_rental_columns', array( $vr_rental_custom_columns, 'register' ) ) ;

	// Rental Custom Columns Display custom stuff
	add_action( 'manage_vr_rental_posts_custom_column', array( $vr_rental_custom_columns, 'display' ) ) ;

	// Sortable Columns.
	add_filter( 'manage_edit-vr_rental_sortable_columns', array( $vr_rental_custom_columns, 'sortable_price' ) );

	// Sort Price by numbers.
	add_action( 'load-edit.php', array( $vr_rental_custom_columns, 'sort_it' ) );

	// Add CT Filters in the admin and convert ID to term titles.
	add_action('restrict_manage_posts', array( $vr_rental_custom_columns, 'filter_rentals_by_taxonomies' ) );
	add_filter('parse_query', array( $vr_rental_custom_columns, 'convert_id_to_term_in_query' ) );
}

// Meta boxes.
if ( class_exists( 'VR_Rental_Meta_Boxes' ) ) {
	// Object: VR_Rental_Metaboxes class.
	$vr_rental_meta_boxes = new VR_Rental_Meta_Boxes();

	// Register rental meta boxes.
	add_filter( 'rwmb_meta_boxes', array( $vr_rental_meta_boxes, 'register' ) );
}

// Destination Class.
if ( class_exists( 'VR_Destination_Meta_Boxes' ) ) {
	// Object: VR_Rental_Metaboxes class.
	$vr_destination_meta_boxes = new VR_Destination_Meta_Boxes();

	// Register rental meta boxes.
	add_filter( 'rwmb_meta_boxes', array( $vr_destination_meta_boxes, 'register' ) );
}
