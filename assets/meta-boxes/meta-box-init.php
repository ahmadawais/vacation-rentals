<?php
/**
 * Metabox Initializer
 *
 * Initializes MetaBox plugin and extensions.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Embedded metabox plugin.
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'RW_Meta_Box' ) ) {

	/**
	 * Path Definitions.
	 */
	// define( 'RWMB_DIR', VRC_DIR . '/assets/meta-boxes/meta-box/' );
	// define( 'RWMB_URL', VRC_URL . '/assets/meta-boxes/meta-box/' );

	/**
	 * Main `meta-box` plugin.
	 *
	 * @since 1.0.0
	 */
	if ( file_exists( VRC_DIR . '/assets/meta-boxes/meta-box/meta-box.php' ) ) {
	    require_once( VRC_DIR . '/assets/meta-boxes/meta-box/meta-box.php' );
	}

}


/**
 * Meta Box Plugin Extensions.
 *
 * @since 1.0.0
 */

// Columns extension.
if ( ! class_exists( 'MB_Columns' ) ) {
	if ( file_exists( VRC_DIR . '/assets/meta-boxes/metabox-extensions/meta-box-columns/meta-box-columns.php' ) ) {
	    require_once( VRC_DIR . '/assets/meta-boxes/metabox-extensions/meta-box-columns/meta-box-columns.php' );
	}
}

// Show Hide extension.
if ( ! class_exists( 'MB_Show_Hide' ) ) {
	if ( file_exists( VRC_DIR . '/assets/meta-boxes/metabox-extensions/meta-box-show-hide/meta-box-show-hide.php' ) ) {
	    require_once( VRC_DIR . '/assets/meta-boxes/metabox-extensions/meta-box-show-hide/meta-box-show-hide.php' );
	}
}

// Tabs extension.
if ( ! class_exists( 'MB_Tabs' ) ) {
	if ( file_exists( VRC_DIR . '/assets/meta-boxes/metabox-extensions/meta-box-tabs/meta-box-tabs.php' ) ) {
	    require_once( VRC_DIR . '/assets/meta-boxes/metabox-extensions/meta-box-tabs/meta-box-tabs.php' );
	}
}

// Groups extension.
if ( ! class_exists( 'RWMB_Group' ) ) {
	if ( file_exists( VRC_DIR . '/assets/meta-boxes/metabox-extensions/meta-box-group/meta-box-group.php' ) ) {
	    require_once( VRC_DIR . '/assets/meta-boxes/metabox-extensions/meta-box-group/meta-box-group.php' );
	}
}

// Term Meta extension.
if ( ! class_exists( 'MB_Term_Meta_Box' ) ) {
	if ( file_exists( VRC_DIR . '/assets/meta-boxes/metabox-extensions/mb-term-meta/mb-term-meta.php' ) ) {
	    require_once( VRC_DIR . '/assets/meta-boxes/metabox-extensions/mb-term-meta/mb-term-meta.php' );
	}
}

/**
 * Class: VR_Meta_Boxes.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/meta-boxes/class-meta-boxes.php' ) ) {
    require_once( VRC_DIR . '/assets/meta-boxes/class-meta-boxes.php' );
}


/**
 * Actions/Filters.
 */

// Deactivate Meta Box Plugin if present.
if ( class_exists( 'VR_Meta_Boxes' ) ) {

	/**
	 * Object: VR_Metaboxes class.
	 *
	 * @since 1.0.0
	 */
	$vr_meta_boxes = new VR_Meta_Boxes();

	// Disable meta-box plugin.
	add_action( 'init', array( $vr_meta_boxes, 'disable_metabox_plugin' ) );


}
