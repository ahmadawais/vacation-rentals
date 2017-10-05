<?php
/**
 * Class: VR_Edit_Rental
 *
 * Edit rental from frontend class.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Edit_Rental.
 *
 * Edit rental from frontend class.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Edit_Rental' ) ) :

class VR_Edit_Rental {

	/**
	 * Shortcode.
	 *
	 * @since 1.0.0
	 */
	public function vr_rental_frontend() {

		/**
		 * Shortcode: `[vr_rental_frontend]`.
		 *
		 * @since 1.0.0
		 */
		add_shortcode( 'vr_rental_frontend', function () {

			/**
			 * LOGIC: edit-rental.
             *
             * It includes the view as per the logic.
			 *
			 * @since 1.0.0
			 */
			if ( file_exists( VRC_DIR . '/assets/rental/frontend/logic-edit-rental.php' ) ) {
			    require_once( VRC_DIR . '/assets/rental/frontend/logic-edit-rental.php' );
			}

		} );// annonymous function and action ended.

	} // Function ended.


	/**
	 * Update Rental.
	 *
	 * @since 1.0.0
	 */
	public function add_rental() {

		global $inspiry_options;
		$invalid_nonce          = false;
		$submitted_successfully = false;
		$updated_successfully   = false;

		// Check if action field is set and user is logged in.
		// if( isset( $_POST['action'] ) && is_user_logged_in() ) { // TODO: why? Means if there is a form with action on the page.
		if( is_user_logged_in() ) {

		    /* the nonce */
		    if( wp_verify_nonce( $_POST['property_nonce'], 'submit_property' ) ) {

		        // Start with basic array
		        $new_property = array(
		            'post_type'	    =>	'property'
		        );

		        // Title
		        if( isset ( $_POST['inspiry_property_title'] ) && ! empty ( $_POST['inspiry_property_title'] ) ) {
		            $new_property['post_title']	= sanitize_text_field( $_POST['inspiry_property_title'] );
		        }

		        // Description
		        if( isset ( $_POST['description'] ) && ! empty ( $_POST['description'] ) ) {
		            $new_property['post_content'] = wp_kses_post( $_POST['description'] );
		        }

		        // Author
		        global $current_user;
		        get_currentuserinfo();
		        $new_property['post_author'] = $current_user->ID;


		        /* check the type of action */
		        $action = $_POST['action'];
		        $property_id = 0;

		        if( $action == "add_property" ) {

		            $default_submit_status = $inspiry_options[ 'inspiry_default_submit_status' ];
		            if( !empty( $default_submit_status ) ) {
		                $new_property['post_status'] = $default_submit_status;
		            } else {
		                $new_property['post_status'] = 'pending';
		            }
		            $property_id = wp_insert_post( $new_property ); // Insert Property and get Property ID
		            if( $property_id > 0 ){
		                $submitted_successfully = true;
		                do_action( 'wp_insert_post', 'wp_insert_post' ); // Post the Post
		            }
		        } elseif( $action == "update_property" ) {
		            $new_property['ID'] = intval( $_POST['property_id'] );
		            $property_id = wp_update_post( $new_property ); // Update Property and get Property ID
		            if( $property_id > 0 ){
		                $updated_successfully = true;
		            }
		        }

		        /*
		         * Added / Updates ( In any case there should be a valid property id )
		         */
		        if( $property_id > 0 ) {

		            // Attach Property Type with Newly Created Property
		            if( isset( $_POST['type'] ) && ( $_POST['type'] != "-1" ) ) {
		                wp_set_object_terms( $property_id, intval( $_POST['type'] ), 'property-type' );
		            }

		            // Attach Property City with Newly Created Property
		            if( isset( $_POST['city'] ) && ( $_POST['city'] != "-1" ) ) {
		                wp_set_object_terms( $property_id, intval( $_POST['city'] ), 'property-city' );
		            }

		            // Attach Property Status with Newly Created Property
		            if( isset( $_POST['status'] ) && ( $_POST['status'] != "-1" ) ) {
		                wp_set_object_terms( $property_id, intval( $_POST['status'] ), 'property-status' );
		            }

		            // Attach Property Features with Newly Created Property
		            if( isset( $_POST['features'] ) ) {
		                if( ! empty( $_POST['features'] ) && is_array( $_POST['features'] ) ) {
		                    $property_features = array();
		                    foreach( $_POST['features'] as $property_feature_id ) {
		                        $property_features[] = intval( $property_feature_id );
		                    }
		                    wp_set_object_terms( $property_id , $property_features, 'property-feature' );
		                }
		            }

		            // Attach Price Post Meta
		            if( isset ( $_POST['price'] ) && !empty ( $_POST['price'] ) ) {
		                update_post_meta( $property_id, 'REAL_HOMES_property_price', sanitize_text_field( $_POST['price'] ) );

		                if( isset ( $_POST['price-postfix'] ) && ! empty ( $_POST['price-postfix'] ) ) {
		                    update_post_meta( $property_id, 'REAL_HOMES_property_price_postfix', sanitize_text_field( $_POST['price-postfix'] ) );
		                }
		            }


		            // Attach Size Post Meta
		            if( isset ( $_POST['size'] ) && !empty ( $_POST['size'] ) ) {
		                update_post_meta($property_id, 'REAL_HOMES_property_size', sanitize_text_field ( $_POST['size'] ) );

		                if( isset ( $_POST['area-postfix'] ) && !empty ( $_POST['area-postfix'] ) ) {
		                    update_post_meta( $property_id, 'REAL_HOMES_property_size_postfix', sanitize_text_field( $_POST['area-postfix'] ) );
		                }
		            }


		            // Attach Bedrooms Post Meta
		            if( isset ( $_POST['bedrooms'] ) && !empty ( $_POST['bedrooms'] ) ) {
		                update_post_meta( $property_id, 'REAL_HOMES_property_bedrooms', floatval( $_POST['bedrooms'] ) );
		            }

		            // Attach Bathrooms Post Meta
		            if( isset ( $_POST['bathrooms'] ) && !empty ( $_POST['bathrooms'] ) ) {
		                update_post_meta( $property_id, 'REAL_HOMES_property_bathrooms', floatval( $_POST['bathrooms'] ) );
		            }

		            // Attach Garages Post Meta
		            if( isset ( $_POST['garages'] ) && !empty ( $_POST['garages'] ) ) {
		                update_post_meta( $property_id, 'REAL_HOMES_property_garage', floatval( $_POST['garages'] ) );
		            }

		            // Attach Address Post Meta
		            if( isset ( $_POST['address'] ) && !empty ( $_POST['address'] ) ) {
		                update_post_meta( $property_id, 'REAL_HOMES_property_address', sanitize_text_field( $_POST['address'] ) );
		            }

		            // Attach Address Post Meta
		            if( isset ( $_POST['location'] ) && !empty ( $_POST['location'] ) ) {
		                update_post_meta( $property_id, 'REAL_HOMES_property_location', $_POST['location'] );
		            }

		            // Agent Display Option
		            if( isset ( $_POST['agent_display_option'] ) && ! empty ( $_POST['agent_display_option'] ) ) {
		                update_post_meta( $property_id, 'REAL_HOMES_agent_display_option', $_POST['agent_display_option']);
		                if( ( $_POST['agent_display_option'] == "agent_info" ) && isset( $_POST['agent_id'] ) ) {
		                    update_post_meta( $property_id, 'REAL_HOMES_agents', $_POST['agent_id'] );
		                }
		            }

		            // Attach Property ID Post Meta
		            if( isset ( $_POST['property-id'] ) && !empty ( $_POST['property-id'] ) ) {
		                update_post_meta( $property_id, 'REAL_HOMES_property_id', sanitize_text_field( $_POST['property-id'] ) );
		            }

		            // Attach Virtual Tour Video URL Post Meta
		            if( isset ( $_POST['video-url'] ) && !empty ( $_POST['video-url'] ) ) {
		                update_post_meta( $property_id, 'REAL_HOMES_tour_video_url', esc_url_raw( $_POST['video-url'] ) );
		            }

		            // Attach additional details with property
		            if( isset( $_POST['detail-titles'] ) && isset( $_POST['detail-values'] ) ) {

		                $additional_details_titles = $_POST['detail-titles'];
		                $additional_details_values = $_POST['detail-values'];

		                $titles_count = count ( $additional_details_titles );
		                $values_count = count ( $additional_details_values );

		                // to skip empty values on submission
		                if( $titles_count == 1 && $values_count == 1 && empty ( $additional_details_titles[0] ) && empty ( $additional_details_values[0] ) ) {
		                    // do nothing and let it go
		                } else {

		                    if( !empty( $additional_details_titles ) && !empty( $additional_details_values ) ) {
		                        $additional_details = array_combine( $additional_details_titles, $additional_details_values );
		                        update_post_meta( $property_id, 'REAL_HOMES_additional_details', $additional_details );
		                    }

		                }
		            }

		            // Attach Property as Featured Post Meta
		            $featured = ( isset( $_POST['featured'] ) ) ? 1 : 0 ;
		            if( $featured ) {
		                update_post_meta( $property_id, 'REAL_HOMES_featured', $featured );
		            }

		            // Tour video image - in case of update
		            $tour_video_image = "";
		            $tour_video_image_id = 0;
		            if( $action == "update_property" ) {
		                $tour_video_image_id = get_post_meta( $property_id, 'REAL_HOMES_tour_video_image', true );
		                if( ! empty ( $tour_video_image_id ) ) {
		                    $tour_video_image_src = wp_get_attachment_image_src( $tour_video_image_id, 'property-detail-video-image' );
		                    $tour_video_image = $tour_video_image_src[0];
		                }
		            }

		            // if property is being updated, clean up the old meta information related to images
		            if( $action == "update_property" ){
		                delete_post_meta( $property_id, 'REAL_HOMES_property_images' );
		                delete_post_meta( $property_id, '_thumbnail_id' );
		            }

		            // Attach gallery images with newly created property
		            if( isset( $_POST['gallery_image_ids'] ) ) {
		                if( ! empty ( $_POST['gallery_image_ids'] ) && is_array ( $_POST['gallery_image_ids'] ) ) {
		                    $gallery_image_ids = array();
		                    foreach ( $_POST['gallery_image_ids'] as $gallery_image_id ) {
		                        $gallery_image_ids[] = intval( $gallery_image_id );
		                        add_post_meta( $property_id, 'REAL_HOMES_property_images', $gallery_image_id );
		                    }
		                    if( isset( $_POST['featured_image_id'] ) ) {
		                        $featured_image_id = intval( $_POST['featured_image_id'] );
		                        if( in_array( $featured_image_id, $gallery_image_ids ) ) {     // validate featured image id
		                            update_post_meta ( $property_id, '_thumbnail_id', $featured_image_id );

		                            /* if video url is provided but there is no video image then use featured image as video image */
		                            if( empty( $tour_video_image ) && !empty( $_POST['video-url'] ) ) {
		                                update_post_meta( $property_id, 'REAL_HOMES_tour_video_image', $featured_image_id );
		                            }
		                        }
		                    } elseif( !empty ( $gallery_image_ids ) ) {
		                        update_post_meta ( $property_id, '_thumbnail_id', $gallery_image_ids[0] );
		                    }
		                }
		            }


		            if( "add_property" == $_POST['action'] ) {

		                /*
		                 * inspiry_submit_notice function is hooked here
		                 */
		                do_action( 'inspiry_after_property_submit', $property_id  );

		            } elseif( "update_property" == $_POST['action'] ) {

		                /*
		                 * no default theme function is hooked here for now
		                 */
		                do_action( 'inspiry_after_property_update', $property_id );

		            }

		            // redirect to my properties page
		            if( !empty( $inspiry_options[ 'inspiry_my_properties_page' ]  ) ) {
		                $my_properties_url = get_permalink( $inspiry_options[ 'inspiry_my_properties_page' ] );
		                if( !empty( $my_properties_url ) ) {
		                    $separator = ( parse_url( $my_properties_url, PHP_URL_QUERY ) == NULL ) ? '?' : '&';
		                    $parameter = ( $updated_successfully ) ? 'property-updated=true' : 'property-added=true';
		                    wp_redirect( $my_properties_url . $separator . $parameter );
		                }
		            }

		        }

		    } else {
		        $invalid_nonce = true;
		    }
		} // if ended.

	} // Function ended.


} // Class ended.

endif;
