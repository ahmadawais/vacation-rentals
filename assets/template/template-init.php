<?php
/**
 * Template initializer.
 *
 * Initializes the templates.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class: VR_Get_Page_Meta.
 *
 * Method: `vr_get_page_meta_obj()`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/class-get-page-meta.php' ) ) {
    require_once( VRC_DIR . '/assets/template/class-get-page-meta.php' );
}


/**
 * Hide Page Editor.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/hide-page-editor.php' ) ) {
    require_once( VRC_DIR . '/assets/template/hide-page-editor.php' );
}

/**
 * Tempalte: Homepage initializer.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/homepage/homepage-init.php' ) ) {
    require_once( VRC_DIR . '/assets/template/homepage/homepage-init.php' );
}


/**
 * Tempalte: Rental List initializer.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/rental/list/list-init.php' ) ) {
    require_once( VRC_DIR . '/assets/template/rental/list/list-init.php' );
}


/**
 * Tempalte: Rental Search initializer.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/rental/search/search-init.php' ) ) {
    require_once( VRC_DIR . '/assets/template/rental/search/search-init.php' );
}


/**
 * Tempalte: Rental Favorite initializer.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/template/rental/favorite/favorite-init.php' ) ) {
    require_once( VRC_DIR . '/assets/template/rental/favorite/favorite-init.php' );
}
