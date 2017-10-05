<?php
/**
 * CPT Booking Class
 *
 * Class for CPT booking.
 *
 * @since 1.0.0
 * @package VRC
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'VR_CPT_Booking' ) ) :

	class VR_CPT_Booking {

		/**
		 * Post Type: booking.
		 *
		 * @since 1.0.0
		 */
		public function register() {

			$labels = array(
				'name'               => _x( 'Bookings', 'Post Type General Name', 'VRC' ),
				'singular_name'      => _x( 'Booking', 'Post Type Singular Name', 'VRC' ),
				'menu_name'          => __( 'Bookings', 'VRC' ),
				'name_admin_bar'     => __( 'Booking', 'VRC' ),
				'parent_item_colon'  => __( 'Parent Booking:', 'VRC' ),
				'all_items'          => __( 'Bookings', 'VRC' ),
				'add_new_item'       => __( 'Add New Booking', 'VRC' ),
				'add_new'            => __( 'Add New', 'VRC' ),
				'new_item'           => __( 'New Booking', 'VRC' ),
				'edit_item'          => __( 'Edit Booking', 'VRC' ),
				'update_item'        => __( 'Update Booking', 'VRC' ),
				'view_item'          => __( 'View Booking', 'VRC' ),
				'search_items'       => __( 'Search Booking', 'VRC' ),
				'not_found'          => __( 'Not found', 'VRC' ),
				'not_found_in_trash' => __( 'Not found in Trash', 'VRC' )
				);

			$rewrite = array(
				// 'slug'    => apply_filters( 'vr_booking_slug', __( 'booking', 'VRC' ) ),
				'slug'       => 'booking',
				'with_front' => true,
				'pages'      => true,
				'feeds'      => true
				);

			$args = array(
				'label'               => __( 'booking', 'VRC' ),
				'description'         => __( 'Bookings', 'VRC' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'author' ),
				'hierarchical'        => true,
				'public'              => false, // Mark true when build it.
				'show_ui'             => true,
				// 'show_in_menu'        => 'vacation_rentals',
				'show_in_menu'        => false,
				// 'menu_position'       => 5,
				'menu_icon'           => 'dashicons-calendar-alt',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => false,
				'can_export'          => true,
				// 'publicly_queryable'  => true, // TODO Future Feature
				// 'exclude_from_search' => false,
				// 'has_archive'         => true,
				'exclude_from_search' => true,
				'has_archive'         => false,
				'publicly_queryable'  => false,
				'rewrite'             => $rewrite,
				'capability_type'     => 'post'
				);

			register_post_type( 'vr_booking', $args );

		}


		/**
		 * Create Fake Content.
		 *
		 * @since  1.0.0
		 */
		function fake_content() {

			// Check if fake content created, if not create 10 fake posts for 'vr_booking' post type.
			if( get_option( 'vr_created_fake_content_booking' ) ) { return; }

			$i = 0;
			while( $i < 11 ) {
				// Generate a random number with 8 length.
				$uniqueid_length = 8;
				$uniqueid = crypt( uniqid( rand(), 1 ) );
				$uniqueid = strip_tags( stripslashes( $uniqueid ) );
				$uniqueid = str_replace( ".","",$uniqueid );
				$uniqueid = strrev( str_replace( "/","",$uniqueid ) );
				$uniqueid = substr( $uniqueid, 0, $uniqueid_length );
				$uniqueid = strtoupper( $uniqueid );

				// Format the title.
				$title = 'Booking: #' . $uniqueid . ' - ' . date( 'd-m-Y' );
				$post = array( 'post_title' => $title );
				$post['post_type'] = 'vr_booking';
				$post['post_status'] = 'publish';
				$new_post = wp_insert_post( $post );
				$i++;
			}
			update_option( 'vr_created_fake_content_booking', true );

		 } // Funtion ended.


		/**
		 * Booking Post Title.
		 *
		 * @since 1.0.0
		 */
		public function set_booking_title() {

			global $post;

			// Select the post type.
			if( get_post_type() != 'vr_booking' || $post->post_status != 'auto-draft' )
				return;

			// Generate a random number with 8 length.
			$uniqueid_length = 8;
			$uniqueid = crypt( uniqid( rand(), 1 ) );
			$uniqueid = strip_tags( stripslashes( $uniqueid ) );
			$uniqueid = str_replace( ".","",$uniqueid );
			$uniqueid = strrev( str_replace( "/","",$uniqueid ) );
			$uniqueid = substr( $uniqueid, 0, $uniqueid_length );
			$uniqueid = strtoupper( $uniqueid );

			// Format the title.
			$title = 'Booking: #' . $uniqueid . ' - ' . date( 'Y-m-d' );

			?>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$("#title").val("<?php echo $title; ?>");
					$("#title").prop("readonly", true); // Don't allow author/editor to adjust the title.

					// Change th Publish button text.
					$("#publish").html('Save');
					$("#publish").val('Save');
				});
			</script>
			<?php

		} // function ended.


	} // Class ended.

endif;
