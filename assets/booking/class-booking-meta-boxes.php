<?php
/**
 * Class for Booking meta boexes
 *
 * Meta boxes for `vr_booking` post type.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Booking_Meta_Boxes.
 *
 * Class for `vr_booking` meta boxes.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Booking_Meta_Boxes' ) ) :

class VR_Booking_Meta_Boxes {


	/**
	 * Register meta boxes related to `vr_booking` post type
	 *
	 * @param   array   $meta_boxes
	 * @return  array   $meta_boxes
	 * @since   1.0.0
	 */
	public function register( $meta_boxes ) {

	    $prefix = 'vr_booking_';


	    // Meta box: The Booked Rental.
	    $meta_boxes[] = array(

			'id'       => 'vr_booking_meta_box_the_rental_id',
			'title'    => __( 'Booked Rental Property', 'VRC' ),
			'pages'    => array( 'vr_booking' ),
			'context'  => 'normal',
			'priority' => 'high',
			'fields'   => array(

				 // Display the rental of this booking.
				array(
					'id'   => "{$prefix}the_rental_display",
					'type' => 'custom_html',

					'callback' => function (){
						global $post;

						// Get the ID of rental from this booking's meta.
						$rental_id = get_post_meta( $post->ID, 'vr_booking_rental_id', true );



						if ( $rental_id != 0 ) {

							// Automatically set the rental ID in `vr_booking_the_rental`
		 					// so that user can see which rental property belongs to the booking.
							update_post_meta( $post->ID, 'vr_booking_the_rental', $rental_id );

						} else {

							// Get the rental ID value manually.
							$rental_id = get_post_meta( $post->ID, 'vr_booking_the_rental', true );

							// Update the rentail_id as well.
							update_post_meta( $post->ID, 'vr_booking_rental_id', $rental_id );
						}

						if ( $rental_id != 0 ) {


							// Get WP_Post object from the ID.
							$rental_post = get_post( $rental_id );

							// Rental Post Data.
							$rental_title         = $rental_post->post_title;
							$rental_img           = get_the_post_thumbnail( $rental_id, 'thumbnail' );
							$rental_agent_id      = get_post_meta( $rental_id, 'vr_rental_the_agent', true );
							$rental_price_postfix = get_post_meta( $rental_id, 'vr_rental_price_postfix', true );

							// Price and format.
							$rental_price         = get_post_meta( $rental_id, 'vr_rental_price', true );
							$vr_price_currency    = VR_Functions::rental_price_currency( $rental_price );

							// Output.
							$vr_output_title = '
											<h3>%s:
												<a href="/wp-admin/post.php?post=%s&action=edit">
													 %s
												</a>
											</h3>
										';

							$vr_output_img = '%s';
							$vr_output_price = '<span>Price: %s %s</span>';

							$rental_title = sprintf( $vr_output_title, 'Rental', $rental_id, $rental_title );
							$rental_img   = sprintf( $vr_output_img, $rental_img );
							$rental_price = sprintf( $vr_output_price, $vr_price_currency , $rental_price_postfix );

							if ( 0 != $rental_agent_id ) {
								// Rental The Agent.
								$rental_the_agent  = get_post( $rental_agent_id );
								$rental_agent_name = $rental_the_agent->post_title;
								$rental_agent = sprintf( $vr_output_title, 'Agent', $rental_agent_id, $rental_agent_name );
							} else {
								$rental_agent = '<div class="rwmb-field">No Agent selected!</div>';
							} // if/else ended.

							// Build Output.
							?>
							<div class="vr_booking">
								<div class="vr_booking__img">
									<?php echo $rental_img; ?>
								</div>
								<div class="vr_booking__data">
									<?php
										echo $rental_title;
										echo $rental_price;
										echo $rental_agent;
									?>
								</div>
							</div>

						<?php

						} else {
							echo '<div class="rwmb-field">No rental property selected!</div>';
						} // if/else ended.

					} // Callback annonymous funtion ended.

				), // field ended.

			) // fields array ended.

	    ); // meta_boxes array ended.



	    // Meta box: Confirmation.
	    $meta_boxes[] = array(
			'id'       => 'vr_booking_meta_box_confirmation_id',
			'title'    => __( 'Booking', 'VRC' ),
			'pages'    => array( 'vr_booking' ),
			'context'  => 'normal',
			'priority' => 'high',
			'fields'   => array(

				// Booking Confirmation.
	            array(
					'id'      => "{$prefix}is_confirmed",
					'type'    => 'radio',
					'name'    => __( 'Confirmation:', 'VRC' ),
					'std' => '0',
					'options' => array(
						'pending' => __( 'Pending.', 'VRC' ),
						'confirmed' => __( 'Confirmed.', 'VRC' ),
	                )
	            ),

	            // Select the rental.
	            array(
					'id'          => "{$prefix}the_rental",
					'type'        => 'post',
					'post_type'   => 'vr_rental',
					'field_type'  => 'select_advanced',
					'name'        => __( 'The Rental', 'VRC' ),
					'placeholder' => __( 'Selected Rental.', 'VRC' ),
					'desc'        => __( 'This value cannot be changed once it is set either manually or automatically. <a target="_blank" href="/wp-admin/post-new.php?post_type=vr_rental">Add a new RENTAL!</a>', 'VRC' ),
					// Query arguments (optional). No settings means get all published posts.
					'query_args'  => array(
						'post_status'    => 'publish',
						'posts_per_page' => - 1,
					)
				)
	        ) // fields array ended.
	    ); // meta_boxes array ended.

	    // Meta box: Details.
	    $meta_boxes[] = array(
			'id'       => 'vr_booking_meta_box_details_id',
			'title'    => __( 'Booking Information', 'VRC' ),
			'pages'    => array( 'vr_booking' ),
			'context'  => 'normal',
			'priority' => 'high',
			'fields'   => array(

				// Arrival Date.
	            array(
					'id'      => "{$prefix}date_checkin",
					'type'    => 'date',
					'name'    => __( 'Checkin Date', 'VRC' ),
					'columns' => 6,
					// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
					'js_options' => array(
						'dateFormat'      => __( 'yy-mm-dd', 'VRC' ),
						'appendText'      => __( ' (Year-Month-Day) ', 'VRC' ),
						'autoSize'        => true,
						'numberOfMonths'  => 2,
						'showButtonPanel' => false
					)
	            ),

	            // Departure Date.
	            array(
					'id'      => "{$prefix}date_checkout",
					'type'    => 'date',
					'name'    => __( 'Checkout Date', 'VRC' ),
					'columns' => 6,
					// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
					'js_options' => array(
						'dateFormat'      => __( 'yy-mm-dd', 'VRC' ),
						'appendText'      => __( ' (Year-Month-Day) ', 'VRC' ),
						'autoSize'        => true,
						'numberOfMonths'  => 2,
						'showButtonPanel' => false
					)
	            ),

				// Guests.
				array(
					'id'   => "{$prefix}guests",
					'type' => 'number',
					'name' => __( 'Guests', 'VRC' ),
					'desc' => __( 'Example Value: 2', 'VRC' ),
					'std'     => "",
					'columns' => 6
				),

				// Rental ID.
				array(
					'id'   => "{$prefix}rental_id",
					'type' => 'hidden',
					'name' => __( 'Rental ID', 'VRC' ),
					'desc' => __( 'Example Value: 2', 'VRC' ),
					'std'     => "",
					'columns' => 6
				),

				// Name.
				array(
					'id'   => "{$prefix}name",
					'type' => 'text',
					'name' => __( 'Name', 'VRC' ),
					'desc' => __( 'Booked By, E.g. John', 'VRC' ),
					'std'     => "",
					'columns' => 6
				),

				// Email ID.
				array(
					'id'   => "{$prefix}email",
					'type' => 'email',
					'name' => __( 'Email ID', 'VRC' ),
					'desc' => __( 'Example Value: john@gmail.com', 'VRC' ),
					'std'     => "",
					'columns' => 6
				),

				// Private Notes.
	            array(
					'id'      => "{$prefix}private_note",
					'type'    => 'textarea',
					'name'    => __( 'Private Note', 'VRC' ),
					'desc'    => __( 'Keep a private note about this rental booking. This field will not be displayed anywhere else.', 'VRC' ),
					'std'     => "",
					'columns' => 12,
					'tab'     => 'misc'
	            )
	        ) // fields array ended.
	    ); // second meta_boxes array ended.

	    // Return metaboxes array.
	    return $meta_boxes;
	} // Register function End.
} // Class ended.
endif;
