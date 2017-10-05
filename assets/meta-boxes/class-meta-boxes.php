<?php
/**
 * Metaboxes Class
 *
 * Metaboxes main class.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Meta_Boxes.
 *
 * Class that handles metaboxes.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Meta_Boxes' ) ) :

class VR_Meta_Boxes {

	/**
	 * Disable Metabox plugin if present.
	 *
	 * @since 1.0.0
	 */
	public function disable_metabox_plugin() {

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'meta-box/meta-box.php' ) ) {
			deactivate_plugins( 'meta-box/meta-box.php' );
			add_action( 'admin_notices', array( $this, 'disable_notice' ) );
		}

	}


	/**
	 * Disable Notice.
	 *
	 * @since 1.0.0
	 */
	public function disable_notice() {

		?>
			<div class="update-nag notice is-dismissible">
				<p><strong><?php _e( 'Meta Box plugin has been deactivated!', 'VRC' ); ?></strong></p>
				<p><?php _e( 'This plugin is a part of VRCore now.', 'VRC' ); ?></p>
				<p><em><?php _e( 'So, You should safely remove it from your plugins.', 'VRC' ); ?></em></p>
			</div>
		<?php

	}

}

endif;
