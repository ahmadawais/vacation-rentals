<?php
/**
 * Custom Columns
 *
 * Custom Columns for post type `rental`.
 * TODO: Order by date added on. Most recent at the top. Try https://www.smashingmagazine.com/2013/12/modifying-admin-post-lists-in-wordpress/
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Rental_Custom_Columns.
 *
 * Creates custom columns for post type `rental`.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Rental_Custom_Columns' ) ) :

class VR_Rental_Custom_Columns {

	/**
	 * Register custom columns.
	 *
	 * @since 1.0.0
	 */

	public function register( $defaults ) {


		/**
		 * Register new columns.
		 */
        $new_columns = array(
			"thumb"    => __( 'Picture', 'VRC' ),
			"customid" => __( 'Custom ID', 'VRC' ),
			"price"    => __( 'Price', 'VRC')
        );

        // Default columns
        // Don't change the variable name.
        $last_columns = array();

        if ( count( $defaults ) > 5 ) {

        	// Unset the comments column.
        	unset( $defaults['comments'] );

        	// After 3rd element i.e. author, offset 3 last columns i.e. type, destination and date.
        	// so, that thumb, customid and price could be added in between them.
            $last_columns = array_splice( $defaults, 3, 3 ); // TODO: What?

    		// Rename the default columns
			$last_columns[ 'title' ]                          = __( 'Rentals', 'VRC' );
			$last_columns[ 'taxonomy-vr_rental-type' ]        = __( 'Types', 'VRC' );
			$last_columns[ 'taxonomy-vr_rental-destination' ] = __( 'Destination', 'VRC' );
    		// $last_columns[ 'taxonomy-rental-feature' ]  = __( 'Features', 'VRC' );

        }

        // Merge the new_columns.
        $defaults = array_merge( $defaults, $new_columns );
        $defaults = array_merge( $defaults, $last_columns );

        return $defaults;

	}


	/**
	 * Display custom column.
	 *
	 * @since   1.0.0
	 */
	public function display( $column_name ) {

	    global $post;
	    switch ( $column_name ) {

	        case 'thumb':

	            if ( has_post_thumbnail ( $post->ID ) ) : ?>
		            <a 	href="<?php the_permalink(); ?>" target="_blank">
		            	<?php the_post_thumbnail( array( 130, 130 ) );?>
		            </a>
	            <?php
	            else:
	                // _e ( 'No Featured Image.', 'VRC' );
	                echo "—";

	            endif;
	            break;


	        case 'customid':

	            $rental_id = get_post_meta ( $post->ID, 'vr_rental_id', true );
	            if( ! empty ( $rental_id ) ) {
	                echo $rental_id;
	            } else {
	                // _e ( 'ID Not Available.', 'VRC' );
	                echo "—";
	            }
	            break;


	        case 'price':

	            $rental_price = get_post_meta ( $post->ID, 'vr_rental_price', true );
	            if ( !empty ( $rental_price ) ) {
	                $price_amount = doubleval( $rental_price );
	                $price_postfix = get_post_meta ( $post->ID, 'vr_rental_price_postfix', true );
	                // echo Inspiry_Property::format_price( $price_amount, $price_postfix );
	                echo $price_amount . ' ' . $price_postfix;
	            } else {
	                // _e ( 'Price Not Available.', 'VRC' );
	                echo "—";
	            }
	            break;


	        default:
	            break;
	    }
	}


	/**
	 * Sortable Columns.
	 *
	 * @since 1.0.0
	 */
	public function sortable_price( $columns ) {

			$columns['price'] = 'price';
			return $columns;

	}


	/**
	 * Only run our customization on the 'edit.php' page in the admin.
	 *
	 * @since 1.0.0
	 */
	function sort_it() {
		add_filter( 'request', array( $this, 'sort_price_by_num' ) );
	}


	/**
	 * Sort Price by numbers value.
	 *
	 * @since 1.0.0
	 */
	public function sort_price_by_num( $vars ) {

		/* Check if we're viewing the 'movie' post type. */
		if ( isset( $vars['post_type'] ) && 'vr_rental' == $vars['post_type'] ) {

			/* Check if 'orderby' is set to 'duration'. */
			if ( isset( $vars['orderby'] ) && 'price' == $vars['orderby'] ) {

				/* Merge the query vars with our custom variables. */
				$vars = array_merge(
					$vars,
					array(
						'meta_key' => 'vr_rental_price',
						'orderby'  => 'meta_value_num'
					)
				);
			}
		}

		return $vars;

	}


	/**
	 * Filter in admin.
	 *
	 * Display a custom taxonomy dropdown filter in admin.
	 *
	 * @since 1.0.0
	 */
	function filter_rentals_by_taxonomies() {
		global $typenow; // to check the post type
		$post_type = 'vr_rental';
		$taxonomies  = array( 'vr_rental-type', 'vr_rental-destination', 'vr_rental-feature' );

		foreach( $taxonomies as $taxonomy ) {


			if ( $typenow == $post_type ) {

				$selected      = isset( $_GET[ $taxonomy ] ) ? $_GET[ $taxonomy ] : '';
				$info_taxonomy = get_taxonomy( $taxonomy );
				wp_dropdown_categories( array(
					'show_option_all' => __( "Show All {$info_taxonomy->label}" ),
					'taxonomy'        => $taxonomy,
					'name'            => $taxonomy,
					'orderby'         => 'name',
					'selected'        => $selected,
					'show_count'      => true,
					'hide_empty'      => true,
				) );

			} // if ended.

		} // foreach ended.

	} // function ended.


	/**
	 * Convert ID to term Title.
	 *
	 * @since 1.0.0
	 */
	function convert_id_to_term_in_query( $query ) {
		global $pagenow;
		$post_type = 'vr_rental';
		$taxonomies  = array( 'vr_rental-type', 'vr_rental-destination', 'vr_rental-feature' );

		foreach( $taxonomies as $taxonomy ) {

			$q_vars    = &$query->query_vars;
			if ( $pagenow == 'edit.php'
					&& isset( $q_vars['post_type'] )
					&& $q_vars['post_type'] == $post_type
					&& isset( $q_vars[ $taxonomy ] )
					&& is_numeric( $q_vars[ $taxonomy ] )
					&& $q_vars[ $taxonomy ] != 0 ) {

				$term = get_term_by( 'id', $q_vars[ $taxonomy ], $taxonomy );
				$q_vars[ $taxonomy ] = $term->slug;

			} // if ended.

		} // foreach ended.

	} // function ended.

} // class ended.

endif;
