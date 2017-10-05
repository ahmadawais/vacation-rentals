<?php
/**
 * Customizer Initilizer
 *
 * Registers everything related to customizer.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Sanitization.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/plugin/category-images/customizer/sanitization.php' ) ) {
    require_once( VRC_DIR . '/assets/plugin/category-images/customizer/sanitization.php' );
}

/**
 * Customizer Section: Cat/Term.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/plugin/category-images/customizer/section/cat-term.php' ) ) {
    require_once( VRC_DIR . '/assets/plugin/category-images/customizer/section/cat-term.php' );
}
