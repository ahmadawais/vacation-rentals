<?php
/**
 * Class for Agent meta boexes
 *
 * Meta boxes for `vr_agent` post type.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'VR_Agent_Meta_Boxes' ) ) :

/**
 * VR_Agent_Meta_Boxes.
 *
 * Class for `vr_agent` meta boxes.
 *
 * @since 1.0.0
 */
class VR_Agent_Meta_Boxes {
	/**
	 * Register meta boxes related to `vr_agent` post type
	 *
	 * @param   array   $meta_boxes
	 * @return  array   $meta_boxes
	 * @since   1.0.0
	 */
	public function register( $meta_boxes ) {

	    $prefix = 'vr_agent_';

	    $meta_boxes[] = array(
			'id'         => 'vr_agent_meta_box_details_id',
			'title'      => __('Contact Details', 'VRC'),
			'post_types' => array( 'vr_agent' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields'     => array(

				// Job Title.
	            array(
	                'id'    => "{$prefix}job_title",
	                'type'  => 'text',
	                'name'  => __( 'Job Title', 'VRC' )
	            ),

	            // Email.
	            array(
	                'id'    => "{$prefix}email",
	                'type'  => 'email',
	                'name'  => __( 'Email Address', 'VRC' ),
	                'desc'  => __( "Agent related messages from contact form on rental details page, will be sent to this email address.", "VRC" )
	            ),

	            // Mobile Number.
	            array(
	                'id'    => "{$prefix}mobile_number",
	                'type'  => 'text',
	                'name'  => __( 'Mobile Number', 'VRC' )
	            ),

	            // Office Number.
	            array(
	                'name'  => __('Office Number', 'VRC'),
	                'id'    => "{$prefix}office_number",
	                'type'  => 'text',
	            ),

	           // Fax Number.
	            array(
	                'id'    => "{$prefix}fax_number",
	                'type'  => 'text',
	                'name'  => __('Fax Number', 'VRC')
	            ),

				// Office Address.
	            array(
	                'id'    => "{$prefix}office_address",
	                'type'  => 'textarea',
	                'name'  => __( 'Office Address', 'VRC' )
	            ),

    			// Message.
                array(
                    'id'    => "{$prefix}summary",
                    'type'  => 'textarea',
                    'name'  => __( 'Profile Summary (Optional)', 'VRC' )
                ),

				// Fb URL.
	            array(
	                'id'    => "{$prefix}fb_url",
	                'type'  => 'url',
	                'name'  => __('Facebook URL', 'VRC')
	            ),

				// Twitter URL.
	            array(
	                'id'    => "{$prefix}twt_url",
	                'type'  => 'url',
	                'name'  => __('Twitter URL', 'VRC')
	            ),

	            // G+ URL.
	            array(
	                'id'    => "{$prefix}gplus_url",
	                'type'  => 'url',
	                'name'  => __('Google Plus URL', 'VRC')
	            ),

	            // LI URL.
	            array(
	                'id'    => "{$prefix}li_url",
	                'type'  => 'text',
	                'name'  => __('LinkedIn URL', 'VRC')
	            ),

	            // Pin URL
	            array(
	                'id'    => "{$prefix}skype_username",
	                'type'  => 'text',
	                'name'  => __('Skype Username', 'VRC'),
	                'desc'  => __('Example Value: myskypeID', 'VRC'),
	            ),

	            // Insta URL
	            array(
	                'id'    => "{$prefix}insta_url",
	                'type'  => 'url',
	                'name'  => __('Instagram URL', 'VRC')
	            ),

	            // Insta URL
	            array(
	                'id'    => "{$prefix}ytube_url",
	                'type'  => 'url',
	                'name'  => __('Youtube URL', 'VRC')
	            )
	        ) // Fields array ended.
	    );// Metboxes array ended.

		$meta_boxes[] = array(
			'id'         => 'vr_agent_meta_box_rental_id',
			'title'      => __('Rental Properties Owner', 'VRC'),
			'post_types' => array( 'vr_agent' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'fields'     => array(
				 // Display the rental of this booking.
				array(
					'id'   => "{$prefix}rental_owner",
					'type' => 'custom_html',
					'callback' => function () {

						global $post;

						// Get the rentals where `vr_rental_the_agent` is this agent.
						// That is get the rentals where this agent is the owner.
						$args = array(
							'post_type'  => 'vr_rental',
							'orderby'    => 'meta_value_num',
							'meta_key'   => 'vr_rental_the_agent',
							'meta_value' => $post->ID
						);

						$the_rentals = new WP_Query( $args );

						echo '<div class="rwmb-field">';

							if ( $the_rentals->have_posts() ) {
								echo '<ol>';
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
								echo "No rental property owned by this agent.";
							}

						echo '</div>';


					} // Callback function ended.

				), // Field ended.

		   ) // Fields array ended.

	    );// Metboxes array ended.

	    return $meta_boxes;

	} // Register function End.

} // Class ended.

endif;
