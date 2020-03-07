<?php
/**
 * Plugin Name: Vacation Rentals Core
 * Plugin URI: https://AhmadAwais.com/
 * Description: Add vacation rentals to your WordPress site with membership, agents, partners, search, and frontend booking features.
 * Author: Author: TheDevCouple (Awais & Maedah)
 * Author URI: https://AhmadAwais.com/
 * Text Domain: VR
 * Version: 1.1.1
 * License: GPL v2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package VRC
 *
 * GitHub Plugin URI: https://github.com/WPTie/VRCore/
 * GitHub Branch: master
 */

/*
	Copyright 2015-2020 WPTie ( email: support at wptie.com )

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	( at your option ) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define global constants
 *
 * @package VRC
 * @since 0.0.1
 */

// VRC Version.
if ( ! defined( 'VRC_VERSION' ) ) {
	define( 'VRC_VERSION', '1.0.0' );
}

// VRC Name.
if ( ! defined( 'VRC_NAME' ) ) {
	define( 'VRC_NAME', trim( dirname( plugin_basename( __FILE__ ) ), '/' ) );
}

// VRC Dir.
if ( ! defined( 'VRC_DIR' ) ) {
	define( 'VRC_DIR', WP_PLUGIN_DIR . '/' . VRC_NAME );
}

// VRC URL.
if ( ! defined( 'VRC_URL' ) ) {
	define( 'VRC_URL', WP_PLUGIN_URL . '/' . VRC_NAME );
}

/**
 * Load Text Domain.
 *
 * @since 0.0.8
 */
function vr_load_plugin_textdomain() {
	load_plugin_textdomain( 'VRC', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

// Add the function when `plugins_loaded`.
add_action( 'plugins_loaded', 'vr_load_plugin_textdomain' );

/**
 * Main File.
 */
require_once VRC_DIR . '/assets/vrc-init.php';
