<?php
/**
 * Rental Features
 *
 * Custom taxonomy: `rental-features`.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Rental_Feature.
 *
 * Custom taxonomy: `rental-features`.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Rental_Feature' ) ) :
	class VR_Rental_Feature {
		/**
		 * Custom taxonomy: `rental-features`.
		 *
		 * @since 1.0.0
		 */
		public function register() {

			$labels = array(
				'name'                       => _x( 'Rental Features', 'Taxonomy General Name', 'VRC' ),
				'singular_name'              => _x( 'Rental Feature', 'Taxonomy Singular Name', 'VRC' ),
				'menu_name'                  => __( 'Features', 'VRC' ),
				'all_items'                  => __( 'All Rental Features', 'VRC' ),
				'parent_item'                => __( 'Parent Rental Feature', 'VRC' ),
				'parent_item_colon'          => __( 'Parent Rental Feature:', 'VRC' ),
				'new_item_name'              => __( 'New Rental Feature Name', 'VRC' ),
				'add_new_item'               => __( 'Add New Rental Feature', 'VRC' ),
				'edit_item'                  => __( 'Edit Rental Feature', 'VRC' ),
				'update_item'                => __( 'Update Rental Feature', 'VRC' ),
				'view_item'                  => __( 'View Rental Feature', 'VRC' ),
				'separate_items_with_commas' => __( 'Separate Rental Features with commas', 'VRC' ),
				'add_or_remove_items'        => __( 'Add or remove Rental Features', 'VRC' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'VRC' ),
				'popular_items'              => __( 'Popular Rental Features', 'VRC' ),
				'search_items'               => __( 'Search Rental Features', 'VRC' ),
				'not_found'                  => __( 'Not Found', 'VRC' ),
			);

			$rewrite = array(
				// 'slug'         => apply_filters( 'inspiry_rental_feature_slug', __( 'rental-feature', 'VRC' ) ),
				'slug'         => 'rental-feature',
				'with_front'   => true,
				'hierarchical' => true,
			);

			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => false,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
				'rewrite'                    => $rewrite,
			);
			// Register the tax.
			register_taxonomy( 'vr_rental-feature', array( 'vr_rental' ), $args );
		}

		/**
		 * Insert Terms via array.
		 *
		 * @since  1.0.1
		 */
		public	function insert_dummy_terms() {
			// Array of terms.
			$terms_arr = array (
				'Kitchen',
				'Internet',
				'Smoking Allowed',
				'TV',
				'Elevator in Building',
				'Indoor Fireplace',
				'Heating',
				'Essentials',
				'Doorman',
				'Pool',
				'Washer',
				'Hot Tub',
				'Dryer',
				'Gym',
				'Free Parking on Premises',
				'Wireless ',
				'Internet',
				'Pets Allowed',
				'Family/Kid Friendly',
				'Phone (booth/lines)',
				'Projector(s)',
				'Bar / Restaurant',
				'Air Conditioner',
				'Scanner / Printer',
			);

			foreach ( $terms_arr as $term ) {
				// Array $args.
				$args = array(
					'description' => 'Add as many features as you want and then connect them with any rentals. You can also add icons to each new rental feature.',
				);

				// Insert the term.
				wp_insert_term( $term, 'vr_rental-feature', $args );
			} // End foreach.
		} // End funciotn.

	}
endif;
