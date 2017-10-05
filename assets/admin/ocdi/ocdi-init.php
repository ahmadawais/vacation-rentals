;<?php
/**
 * OCDI Init
 *
 * One Click Demo Import Initializer.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Demos OCDI.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'vrc_demos_ocdi' ) ) {
	// Add the filter.
	add_filter( 'pt-ocdi/import_files', 'vrc_demos_ocdi' );

	/**
	 * Functions vrc_demos_ocdi
	 *
	 * @return array
	 * @since  1.0.0
	 */
	function vrc_demos_ocdi() {
		// Return the array.
		return array(
			array(
				'import_file_name'           => 'Demo 01',
				'categories'                 => array( 'General', 'Popular' ),
				'import_file_url'            => 'https://gist.github.com/ahmadawais/d270f51015485860a05985786e156124/raw/a72fcfc0fb7431c5ef78cd027cb8f24bd5ef6489/demo1_content.xml',
				'import_widget_file_url'     => 'https://gist.githubusercontent.com/ahmadawais/d270f51015485860a05985786e156124/raw/a72fcfc0fb7431c5ef78cd027cb8f24bd5ef6489/demo1_widgets.json',
				'import_customizer_file_url' => 'https://gist.github.com/ahmadawais/d270f51015485860a05985786e156124/raw/a72fcfc0fb7431c5ef78cd027cb8f24bd5ef6489/demo1_customizer.dat',
				'import_preview_image_url'   => 'https://i.imgur.com/oTOk38U.jpg',
				'import_notice'              => __( 'After you import this demo, you will have to setup the menu, homepage, and theme.', 'VRC' ),
			),
			array(
				'import_file_name'           => 'Demo 02',
				'categories'                 => array( 'General', 'Popular' ),
				'import_file_url'            => VRC_DIR . '/assets/admin/ocdi/demo2/demo-content.xml',
				'import_widget_file_url'     => VRC_DIR . '/assets/admin/ocdi/demo2/widgets.json',
				'import_customizer_file_url' => VRC_DIR . '/assets/admin/ocdi/demo2/customizer.dat',
				'import_preview_image_url'   => 'https://i.imgur.com/oTOk38U.jpg',
				'import_notice'              => __( 'After you import this demo, you will have to setup the menu, homepage, and theme.', 'VRC' ),
			),
		);
	} // End function.
} // End if().
