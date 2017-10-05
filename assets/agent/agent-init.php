<?php
/**
 * Agent Initializer
 *
 * Real Estate agents or owners related.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Admin/Agent.
 *
 * Agent related files.
 *
 * @since 1.0.0
 */

// Custom Post Type: `vr_agent`.
if ( file_exists( VRC_DIR . '/assets/agent/cpt-agent.php' ) ) {
    require_once( VRC_DIR . '/assets/agent/cpt-agent.php' );
}

/**
 * Class: `VR_Agent`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/agent/class-agent.php' ) ) {
    require_once( VRC_DIR . '/assets/agent/class-agent.php' );
}

/**
 * Class: `VR_Agent_Meta_Boxes`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/agent/class-agent-meta-boxes.php' ) ) {
    require_once( VRC_DIR . '/assets/agent/class-agent-meta-boxes.php' );
}

/**
 * Class: `VR_Agent_Custom_Columns`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/agent/agent-custom-columns.php' ) ) {
    require_once( VRC_DIR . '/assets/agent/agent-custom-columns.php' );
}

/**
 * Class: `VR_Get_Agent_Meta`.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/agent/class-get-agent-meta.php' ) ) {
    require_once( VRC_DIR . '/assets/agent/class-get-agent-meta.php' );
}

/**
 * Actions/Filters for agent.
 *
 * Classes:
 * 			1. VR_Agent
 * 			2. VR_Agent_Custom_Columns
 * 			3. VR_Agent_Meta_Boxes
 */
if ( class_exists( 'VR_Agent' ) ) {
	/**
	 * Object: VR_Agent class.
	 *
	 * @since 1.0.0
	 */
	$vr_agent_init = new VR_Agent();


	// Create agent post type
	add_action( 'init', array( $vr_agent_init, 'create_agent' ) );

	// Create fake agent content.
	// add_action( 'init', array( $vr_agent_init, 'fake_agent_content' ) );
}

if ( class_exists( 'VR_Agent_Custom_Columns' ) ) {
	/**
	 * Object: VR_Agent_Custom_Columns class.
	 *
	 * @since 1.0.0
	 */
	$vr_agent_custom_columns = new VR_Agent_Custom_Columns();

	// Agent Custom Columns Registered
	add_filter( 'manage_edit-vr_agent_columns', array( $vr_agent_custom_columns, 'register' ) ) ;

	// Agent Custom Columns Display custom stuff
	add_action( 'manage_vr_agent_posts_custom_column', array( $vr_agent_custom_columns, 'display' ) ) ;
}

if ( class_exists( 'VR_Agent_Meta_Boxes' ) ) {
	/**
	 * Object: VR_Agent_Metaboxes class.
	 *
	 * @since 1.0.0
	 */
	$vr_agent_meta_boxes = new VR_Agent_Meta_Boxes();

	// Register agent meta boxes.
    add_filter( 'rwmb_meta_boxes', array( $vr_agent_meta_boxes, 'register' ) );
}
