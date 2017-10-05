<?php
/**
 * Customizer Initializer
 *
 * Customizer related stuff.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Section: Member.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/customizer/section/vr_section_member.php' ) ) {
    require_once( VRC_DIR . '/assets/customizer/section/vr_section_member.php' );
}
