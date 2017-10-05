<?php
/**
 * Custom Columns
 *
 * Custom Columns for post type `vr_partner`.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Partner_Custom_Columns.
 *
 * Creates custom columns for post type `vr_partner`.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Partner_Custom_Columns' ) ) :

class VR_Partner_Custom_Columns {

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
			"thumb" => __( 'Logo', 'VRC' ),
			"url"   => __( 'URL', 'VRC' )
        );

        // Default columns
        // Don't change the variable name.
        $last_columns = array();

        if ( count( $defaults ) > 1 ) {

        	// After 2nd element i.e. `title`, offset 3 last columns to incubate
        	// thumb, email and mobile and then comes the date.
            $last_columns = array_splice( $defaults, 2, 2 ); // TODO: What?

    		// Rename the default columns
			$last_columns[ 'title' ] = __( 'Partner', 'VRC' );
			$last_columns[ 'date' ]  = __( 'Added On', 'VRC' );

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
	            	<?php the_post_thumbnail( array( 130, 130 ) );?>
	            <?php
	            else:
	                echo "—";

	            endif;
	            break;

	        case 'url':

	            $url = get_post_meta( $post->ID, 'vr_partner_url', true );
	            if( ! empty ( $url ) ) {
	                echo $url;
	            } else {
	                echo "—";
	            }
	            break;



	        default:
	            break;

	    } // Switch ended.

	} // Function ended.


} // class ended.

endif;
