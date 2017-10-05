<?php
/**
 * Rental related metaboxes
 *
 * Metaboxes for `vr_rental` post type.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'VR_Rental_Meta_Boxes' ) ) :

/**
 * VR_Rental_Meta_Boxes.
 *
 * Rental related metaboxes class.
 *
 * @since 1.0.0
 */
class VR_Rental_Meta_Boxes {

	/**
	 * Register meta boxes related to `rental` post type.
	 *
	 * TODO: Needs major refactoring!
	 *
	 * @param 	array   $meta_boxes Metaboxes array.
	 * @return  array   $meta_boxes
	 * @since   1.0.0
	 */
	public function register( $meta_boxes ) {
		// TODO: Recommended image dimensions.
	    $prefix = 'vr_rental_';

	    $meta_boxes[] = array(
			'id'         => 'vr_rental_meta_box_details_id',
			'title'      => __( 'Rental Details', 'VRC' ),

			'post_types' => array( 'vr_rental' ),

			'context'    => 'normal',
			'priority'   => 'high',

			/**
			 * TABS.
			 */
			'tabs'  => array(
	            'details' => array(
					'label' => __( 'Basic Information', 'VRC' ),
					'icon'  => 'dashicons-admin-home',
	            ),
	            'gallery' => array(
					'label' => __( 'Gallery Images', 'VRC' ),
					'icon'  => 'dashicons-format-gallery',
	            ),
	            'video' => array(
					'label' => __( 'Rental Video', 'VRC' ),
					'icon'  => 'dashicons-format-video',
	            ),
	            // TODO: Future Feature
				// 'amenities' => array(
				//	'label' => __( 'Additional Amenities', 'VRC' ),
				// 	'icon'  => 'dashicons-palmtree'
				//  ),
	            'agent' => array(
					'label' => __( 'Agent Information', 'VRC' ),
					'icon'  => 'dashicons-businessman',
	            ),
				// 'booking' => array(
				// 'label' => __( 'Booking Information', 'VRC' ),
				// 'icon'  => 'dashicons-calendar',
				// ),
	            'misc' => array(
					'label' => __( 'Miscellaneous Settings', 'VRC' ),
					'icon'  => 'dashicons-lightbulb',
	            )
	        ),
			'tab_style' => 'left',
			'fields'    => array(

	        	/**
	        	 * Tab: `details`
	        	 * 		Basic Information
	        	 *
	        	 * @since 1.0.0
	        	 */

				// Price.
				array(

					'id'      => "{$prefix}price", // use double quotes with {$prefix}
					'type'    => 'number',

					'name'    => __( 'Rent Price:  (Digits Only)', 'VRC' ),
					'desc'    => __( 'Example Value: 450', 'VRC' ),

					'std'     => "",

					'columns' => 6,
					'tab'     => 'details'
				),


				//  Price Postfix.
				array(
					'id'      => "{$prefix}price_postfix",
					'type'    => 'text',

					'name'    => __( 'Price Postfix', 'VRC' ),
					'desc'    => __( 'Example Value: Per Night', 'VRC' ),

					'std'     => "Per Night",
					'columns' => 6,
					'tab'     => 'details'
				),


				// Bedrooms.
				array(
					'id'      => "{$prefix}bedrooms",
					'type'    => 'number',

					'name'    => __( 'Bedrooms', 'VRC' ),
					'desc'    => __( 'Example Value: 4', 'VRC' ),

					'std'     => "",
					'columns' => 6,
					'tab'     => 'details'
				),


				// Bathrooms.
				array(
					'id'      => "{$prefix}bathrooms",
					'type'    => 'number',

					'name'    => __( 'Bathrooms', 'VRC' ),
					'desc'    => __( 'Example Value: 2', 'VRC' ),

					'std'     => "",
					'columns' => 6,
					'tab'     => 'details'
				),


				// Guests.
				array(
					'id'      => "{$prefix}guests",
					'type'    => 'number',

					'name'    => __( 'Guests', 'VRC' ),
					'desc'    => __( 'Example Value: 2', 'VRC' ),

					'std'     => "",
					'columns' => 6,
					'tab'     => 'details'
				),


				// Rental ID.
				array(
					'id'      => "{$prefix}customid",
					'type'    => 'text',

					'name'    => __( 'Rental ID', 'VRC' ),
					'desc'    => __( 'Optional: It will help you search a rental directly.', 'VRC' ),

					'std'     => "",
					'columns' => 6,
					'tab'     => 'details'
				),



				// Address on Google Maps.
				array(
					'id'      => "{$prefix}address",
					'type'    => 'text',

					'name'    => __( 'Rental Address', 'VRC' ),
					'desc'    => __( 'Leaving it empty will hide the google map on rental detail page.', 'VRC' ),

					// 'std'  => 'Miami, FL, USA',
					'columns' => 12,
					'tab'     => 'details'
				),


				// Google Maps.
				array(
					'id'            => "{$prefix}location",
					'type'          => 'map',

					'name'          => __( 'Rental Location at Google Map*', 'VRC' ),
					'desc'          => __( 'Drag the google map marker to point your rental location. You can also use the address field above to search for your rental.', 'VRC' ),

					// 'std'        => '25.761680,-80.191790,14',   // 'latitude,longitude[,zoom]' (zoom is optional)
					'style'         => 'width: 95%; height: 400px',

					'address_field' => "{$prefix}address",
					'columns'       => 12,
					'tab'           => 'details',
					'api_key'       => 'AIzaSyC6-3I3Kkns3Qjav-Ph2TdXQT-jrQxYe3s',
				),


				/**
				 * Tab: `gallery`
				 * 		Gallery Images
				 *
				 * @since 1.0.0
				 */

				// Gallery Images.
	            array(
					'id'               => "{$prefix}images",
					'type'             => 'image_advanced',

					'name'             => __( 'Rental Gallery/Slider Images', 'VRC' ),
					'desc'             => __( 'Recommended image size is at least 1440px x 725px (width x height).', 'VRC' ),

					'max_file_uploads' => 48,
					'columns'          => 12,
					'tab'              => 'gallery'
	            ),


	            /**
	             * Tab: `video`
	             * 		Rental Video
	             *
	             * @since 1.0.0
	             */

	            // Rental Video.
	            array(
					'id'      => "{$prefix}tour_video_url",
					'type'    => 'text',

					'name'    => __( 'Virtual Tour Video URL', 'VRC' ),
					'desc'    => __( 'Provide virtual tour video URL. YouTube, Vimeo, SWF File and MOV File are supported.', 'VRC' ),

					'columns' => 12,
					'tab'     => 'video'
	            ),



	            // Video Image.
	            array(
					'id'               => "{$prefix}tour_video_image",
					'type'             => 'image_advanced',

					'name'             => __( 'Virtual Tour Video Image', 'VRC' ),
					'desc'             => __( 'Recommended image size is at least 730px x 400px (width x height).', 'VRC' ),

					'max_file_uploads' => 1,
					'columns'          => 12,
					'tab'              => 'video'
	            ),


                /**
                 * Tab: `amenities`
                 * 		Additional Amenities
                 *
                 * @since 1.0.0
                 */

                // TODO: Future Feature

                // Group.
     //            array(
					// 'id'         => "{$prefix}group_amenities",
					// 'type'       => 'group',

					// 'clone'      => true,
					// // 'sort_clone' => true,

					// 'tab'        => 'amenities',
					// 'fields'     => array(

     //        			// Name of the amenity.
     //        			array(
					// 		'id'   => "{$prefix}group_amenities_name",
					// 		'type' => 'text',

					// 		'name' => __( 'Name', 'rwmb' ),
					// 		'desc' => 'Example Value: Pool',

					// 		'columns' => 6
     //        			),

					// 	// Image Icon.
     //        			array(
					// 		'id'               => "{$prefix}group_amenities_img",
					// 		'type'             => 'image_advanced',

					// 		'name'             => __( 'Icon Image', 'rwmb' ),
					// 		'desc'             => "Add amenity's Icon image.",

					// 		'columns'          => 6,
					// 		'max_file_uploads' => 1
     //        			)

     //        		) // Sub-Fields ended.

     //            ), // Field Group ended.


                /**
	             * Tab: `agent`
	             * 		Agent Information
	             *
	             * @since 1.0.0
	             */

	            // TODO: Future feature. Dispaly Agents or Not.
	    //         array(
					// 'id'      => "{$prefix}agent_display_option",
					// 'type'    => 'radio',

					// 'name'    => __( 'What should be displayed in the Agent Information box?', 'VRC' ),

					// 'std'     => 'none',
					// 'options' => array(
					// 	'my_profile_info' => __( 'Author of this rental.', 'VRC' ),
					// 	'agent_info'      => __( 'Agent Information. ( Select the agent below )', 'VRC' ),
					// 	'none'            => __( 'Nothing. ( Hide information box )', 'VRC' ),
	    //             ),
					// 'columns' => 12,
					// 'tab'     => 'agent'
	    //         ),


                // Divider.
        //         array(
    				// 'id'      => "{$prefix}agent_divider", // Not used, but needed.
    				// 'type'    => 'divider',
    				// 'columns' => 12,
    				// 'tab'     => 'agent'
        //         ),


	            // Select the agent.
	       //      array(
				    // 'id'      => "{$prefix}the_agent",
				    // 'type'    => 'select_advanced',

				    // 'name'    => __( 'Agent', 'VRC' ),

				    // 'options' => $agent_array,
				    // 'columns' => 12,
				    // 'tab'     => 'agent'
	       //      ),

	            // Select the agent.
				array(
					'id'          => "{$prefix}the_agent",
					'type'        => 'post',

					'post_type'   => 'vr_agent',
					'field_type'  => 'select_advanced',

					'name'        => __( 'Select the Agent', 'VRC' ),
					'desc'        => __( 'To display the list of agents, you should add agents here. <a target="_blank" href="/wp-admin/post-new.php?post_type=vr_agent">Add a new AGENT!</a>', 'VRC' ),
					'placeholder' => __( 'Select the agent', 'VRC' ),

					// Query arguments (optional). No settings means get all published posts.
					'query_args'  => array(
						'post_status'    => 'publish',
						'posts_per_page' => - 1,
					),

					'columns' => 12,
				    'tab'     => 'agent',
				),


	            /**
	             * Tab: `booking`
	             * 		Booking Information
	             *
	             * @since 1.0.0
	             */

	            // Booked or not.
	    //         array(
					// 'id'      => "{$prefix}is_booked",
					// 'type'    => 'radio',

					// 'name'    => __( 'Is this property booked?', 'VRC' ),

					// 'std'     => 'none',
					// 'options' => array(
					// 	'0' => __( 'Not Booked.', 'VRC' ),
					// 	'1' => __( 'Booked. (Select the booking below)', 'VRC' ),
	    //             ),
					// 'columns' => 12,
					// 'tab'     => 'booking'
	    //         ),



	            // Select the booking.
	       //      array(
				    // 'id'      => "{$prefix}bookings",
				    // 'type'    => 'select_advanced',

				    // 'name'    => __( 'Select the Booking ', 'VRC' ),
				    // 'desc'    => __( 'Select only if the rental is booked.', 'VRC' ),

				    // 'options' => $booking_array,
				    // 'columns' => 12,
				    // 'tab'     => 'booking'
	       //      ),
	       //
	            // Select the booking.
				// array(
				// 	'id'          => "{$prefix}the_booking",
				// 	'type'        => 'post',

				// 	'post_type'   => 'vr_booking',
				// 	'field_type'  => 'select_advanced',

				// 	'name'        => __( 'Select the Booking', 'VRC' ),
				// 	'desc'        => __( 'To display the list of bookings, you should have some bookings added. <a target="_blank" href="/wp-admin/post-new.php?post_type=vr_booking">Add a new BOOKING!</a>', 'VRC' ),
				// 	'placeholder' => __( 'Select a booking', 'VRC' ),

				// 	// Query arguments (optional). No settings means get all published posts.
				// 	'query_args'  => array(
				// 		'post_status'    => 'publish',
				// 		'posts_per_page' => - 1,
				// 	),

				// 	'columns' => 12,
				//     'tab'     => 'booking'
				// ),


	            /**
	             * Tab: `misc`
	             * 		Miscellaneous
	             *
	             * @since 1.0.0
	             */


                // Homepage Slider
                array(
    				'id'      => "{$prefix}is_add_in_slider",
    				'type'    => 'radio',

    				'name'    => __( 'Do you want to add this rental in the Homepage Slider?', 'VRC' ),
    				'desc'    => __( 'Remember you need set a `Featured Image` for this rental from the right sidebar.', 'VRC' ),

    				'std'     => '0',
    				'options' => array(
    					'1' => __( 'Yes ', 'VRC' ),
    					'0' => __( 'No', 'VRC' )
                    ),

    				'columns' => 12,
	            	'tab'     => 'misc'
                ),


	            // Featured rental.
	            array(
					'id'      => "{$prefix}is_featured",
					'type'    => 'radio',

					'name'    => __( 'Mark this rental as featured?', 'VRC' ),
    				'desc'    => __( 'Remember you need set a `Featured Image` for this rental from the right sidebar.', 'VRC' ),

					'std'     => 0,
					'options' => array(
						'1' => __( 'Yes ', 'VRC' ),
						'0' => __( 'No', 'VRC' )
	                ),

					'columns' => 12,
					'tab'     => 'misc'
	            ),

				// TODO: Future Attachments.
				//         array(
				// 'id'        => "{$prefix}attachments",
				// 'type'      => 'file_advanced',

				// 'name'      => __( 'Attachments', 'VRC' ),
				// 'desc'      => __( 'You can attach PDF files, Map images OR other documents to provide further details related to this rental property.', 'VRC' ),

				// 'mime_type' => '',
				// 'columns'   => 12,
				// 'tab'       => 'misc'
				//         ),

	            // Private Notes.
	            array(
					'id'      => "{$prefix}private_note",
					'type'    => 'textarea',

					'name'    => __( 'Private Note', 'VRC' ),
					'desc'    => __( 'Keep a private note about this rental rental. This field will not be displayed anywhere else.', 'VRC' ),

					'std'     => "",
					'columns' => 12,
					'tab'     => 'misc'
	            ),

	        ) // Fields ended.

	    ); // Metboxes array ended.

		$meta_boxes[] = array(
			'id'         => 'vr_rental_meta_box_booking_id',
			'title'      => __( 'Bookings for this Rental', 'VRC' ),

			'post_types' => array( 'vr_rental' ),

			'context'    => 'normal',
			'priority'   => 'high',

			'fields'     => array(

				// Display the rental of this booking.
				array(
					'id'   => "{$prefix}bookings_list",
					'type' => 'custom_html',
					'callback' => function () {
						global $post;

						// Get the bookings where `vr_booking_rental_id` is this rental property.
						// That is get the bookings for this rental property.
						$args = array(
							'post_type'  => 'vr_booking',
							'orderby'    => 'meta_value_num',
							'meta_key'   => 'vr_booking_rental_id',
							'meta_value' => $post->ID
						);

						$the_rentals = new WP_Query( $args );

						echo '<div class="rwmb-field">';

							echo '<p>';
								_e( 'All the bookings added for this rental are displayed below (Both confirmed and not confirmed bookings). ', 'VRC' );
							echo '</p>';

							if ( $the_rentals->have_posts() ) {
								echo '<ol class="vr_booking__ol">';
								while ( $the_rentals->have_posts() ) {
									$the_rentals->the_post();

									// Frontend link.
									// $li_format = '<li><a href="%s"> %s </a></li>';
									// echo sprintf( $li_format, get_the_permalink() , get_the_title() );

									// Backend link.
									$li_format = '<li><a href="/wp-admin/post.php?post=%s&action=edit"> %s </a></li>';
									echo sprintf( $li_format, get_the_id() , get_the_title() );
								}
								echo '</ol>';
							} else {
								echo "No bookings for this rental property.";
							}

						echo '</div>';


					} // Callback function ended.

				), // Field ended.

		   ) // Fields array ended.

	    );// Metboxes array ended.

	    return $meta_boxes;

	} // Register function End.

} // Class end.

endif;
