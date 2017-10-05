<?php
/**
 * CPT `vr_partner`
 *
 * Custom post type for Clients or Partners Logo Showcase.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_CPT_Partner.
 *
 * CPT `vr_partner`.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_CPT_Partner' ) ) :

class VR_CPT_Partner {

	/**
	 * CPT Regist.
	 *
	 * @since 1.0.0
	 */
	public function register() {

       $labels = array(
           'name'                => _x( 'Partners', 'Post Type General Name', 'inspiry-real-estate' ),
           'singular_name'       => _x( 'Partner', 'Post Type Singular Name', 'inspiry-real-estate' ),
           'menu_name'           => __( 'Partners', 'inspiry-real-estate' ),
           'name_admin_bar'      => __( 'Partner', 'inspiry-real-estate' ),
           'parent_item_colon'   => __( 'Parent Partner:', 'inspiry-real-estate' ),
           'all_items'           => __( 'Partners', 'inspiry-real-estate' ),
           'add_new_item'        => __( 'Add New Partner', 'inspiry-real-estate' ),
           'add_new'             => __( 'Add New', 'inspiry-real-estate' ),
           'new_item'            => __( 'New Partner', 'inspiry-real-estate' ),
           'edit_item'           => __( 'Edit Partners', 'inspiry-real-estate' ),
           'update_item'         => __( 'Update Partner', 'inspiry-real-estate' ),
           'view_item'           => __( 'View Partner', 'inspiry-real-estate' ),
           'search_items'        => __( 'Search Partner', 'inspiry-real-estate' ),
           'not_found'           => __( 'Not found', 'inspiry-real-estate' ),
           'not_found_in_trash'  => __( 'Not found in Trash', 'inspiry-real-estate' ),
       );

       $args = array(
           'label'               => __( 'Partners', 'inspiry-real-estate' ),
           'description'         => __( 'Partners', 'inspiry-real-estate' ),
           'labels'              => $labels,
           'supports'            => array( 'title', 'thumbnail', ),
           'hierarchical'        => false,
           'public'              => false,
           'show_ui'             => true,
           // 'show_in_menu'        => 'vacation_rentals',
           'show_in_menu'        => false,
           // 'menu_position'       => 5,
           'menu_icon'           => 'dashicons-groups',
           'show_in_admin_bar'   => false,
           'can_export'          => true,
           'has_archive'         => false,
           'rewrite'             => false,
           'capability_type'     => 'post',
       );

       register_post_type( 'vr_partner', $args );

	} // Functions ended.


	/**
	 * Create Fake Content.
	 *
	 * @since  1.0.0
	 */
	public function fake_content() {

       // Check if fake content created, if not create 10 fake posts for 'vr_partner' post type.
       if( get_option( 'vr_created_fake_content_partners' ) ) { return; }

       $i = 0;
       while( $i < 11 ) {
           $post = array( 'post_title' => 'Partner ' . $i );
           $post['post_content'] = '<p>Testing some amazing agent content here...</p>';
           $post['post_type'] = 'vr_partner';
           $post['post_status'] = 'publish';
           $new_post = wp_insert_post( $post );
           $i++;
       }
       update_option( 'vr_created_fake_content_partners', true );

   } // Function ended.


} // Class ended.

endif;
