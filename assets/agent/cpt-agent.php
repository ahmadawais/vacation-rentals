<?php
/**
 * CPT: `vr_agent`
 *
 * Custom Post Type: `vr_agent`.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_CPT_Agent.
 *
 * CPT: VR Agent.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_CPT_Agent' ) ) :

class VR_CPT_Agent {

	/**
	 * CPT: `vr_agent` register.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		$labels = array(
		    'name'                => _x( 'Agents', 'Post Type General Name', 'inspiry-real-estate' ),
		    'singular_name'       => _x( 'Agent', 'Post Type Singular Name', 'inspiry-real-estate' ),
		    'menu_name'           => __( 'Agents', 'inspiry-real-estate' ),
		    'name_admin_bar'      => __( 'Agent', 'inspiry-real-estate' ),
		    'parent_item_colon'   => __( 'Parent Agent:', 'inspiry-real-estate' ),
		    'all_items'           => __( 'Agents', 'inspiry-real-estate' ),
		    'add_new_item'        => __( 'Add New Agent', 'inspiry-real-estate' ),
		    'add_new'             => __( 'Add New', 'inspiry-real-estate' ),
		    'new_item'            => __( 'New Agent', 'inspiry-real-estate' ),
		    'edit_item'           => __( 'Edit Agent', 'inspiry-real-estate' ),
		    'update_item'         => __( 'Update Agent', 'inspiry-real-estate' ),
		    'view_item'           => __( 'View Agent', 'inspiry-real-estate' ),
		    'search_items'        => __( 'Search Agent', 'inspiry-real-estate' ),
		    'not_found'           => __( 'Not found', 'inspiry-real-estate' ),
		    'not_found_in_trash'  => __( 'Not found in Trash', 'inspiry-real-estate' ),
		);

		$rewrite = array(
		    // 'slug'                => apply_filters( 'inspiry_agent_slug', __( 'agent', 'inspiry-real-estate' ) ),
		    'slug'                => 'agent',
		    'with_front'          => true,
		    'pages'               => true,
		    'feeds'               => false,
		);

		$args = array(
		    'label'               => __( 'agent', 'inspiry-real-estate' ),
		    'description'         => __( 'Real Estate Agent', 'inspiry-real-estate' ),
		    'labels'              => $labels,
		    'supports'            => array( 'title', 'thumbnail' ),
		    'hierarchical'        => false, // Just like `post`.
		    'public'              => true,
		    'show_ui'             => true,
			// 'show_in_menu'        => 'vacation_rentals',
		    'show_in_menu'        => false,
		    // 'menu_position'       => 5,
		    'menu_icon'           => 'dashicons-businessman',
		    'show_in_admin_bar'   => true,
		    'show_in_nav_menus'   => true,
		    'can_export'          => true,
		    'has_archive'         => false,
		    'exclude_from_search' => true,
		    'publicly_queryable'  => true,
		    'rewrite'             => $rewrite,
		    'capability_type'     => 'post',
		);

		register_post_type( 'vr_agent', $args );

	} // Regist function ended.

	/**
	 * Create Fake Content.
	 *
	 * @since  1.0.0
	 */
	public function fake_content() {

       // Check if fake content created, if not create 10 fake posts for 'vr_agent' post type.
       if( get_option( 'vr_created_fake_content_agent' ) ) { return; }

       $i = 0;
       while( $i < 11 ) {
           $post = array( 'post_title' => 'Agent ' . $i );
           $post['post_content'] = '<p>Testing some amazing agent content here...</p>';
           $post['post_type'] = 'vr_agent';
           $post['post_status'] = 'publish';
           $new_post = wp_insert_post( $post );
           $i++;
       }
       update_option( 'vr_created_fake_content_agent', true );

   }


	} // Class ended.

endif;
