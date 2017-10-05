<?php
/**
 * Class: VR_Submit_Post
 *
 * Reset class.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Submit_Post.
 *
 * VR Membership post class.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Submit_Post' ) ) :

class VR_Submit_Post {

	/**
	 * Shortcode.
	 *
	 * @since 1.0.0
	 */
	public function vr_submit_post() {

		/**
		 * Shortcode: `[vr_submit_post]`.
		 *
		 * @since 1.0.0
		 */
		add_shortcode( 'vr_submit_post', function () {

			/**
			 * VIEW: Submit post.
			 *
			 * @since 1.0.0
			 */
			if ( file_exists( VRC_DIR . '/assets/member/view-submit-post.php' ) ) {
			    require_once( VRC_DIR . '/assets/member/view-submit-post.php' );
			}

		} );// annonymous function and action ended.

	} // Function ended.


	/**
	 * Submit Post Function.
	 *
	 * @since 1.0.0
	 */
	public function submit() {


        // Errors array.
        $errors = array();



		// Verify the nonce.
        if( wp_verify_nonce( $_POST['vr_submit_post_nonce'], 'vr_submit_post' ) ) {

            // Get post title via `post-title`.
            if ( ! empty( $_POST['post_title'] ) ) {
                $post_title = sanitize_text_field( $_POST['post_title'] );
            } else {
                $errors[] = __( 'Post Title is required!', 'VRC' );
            }


            // Get post content via `post-content`.
            if ( ! empty( $_POST['post_content'] ) ) {
                $post_content = sanitize_text_field( $_POST['post_content'] );
            }

            // if everything is fine
            if ( count( $errors ) == 0 ) {

                if( current_user_can( 'manage_options' ) ) {

                    $submitted_post = array(
                        'post_title'    => $post_title,
                        'post_content'  => $post_content,
                        'post_status'   => 'publish'
                    );

                    $output_message = __( 'Yay! Your post was successfully published!', 'VRC' );

                } else {

                    $submitted_post = array(
                        'post_title'    => $post_title,
                        'post_content'  => $post_content,
                        'post_status'   => 'pending'
                    );

                    $output_message = __( 'Yay! Your post was successfully submitted! Awaiting moderation!', 'VRC' );

                }


                // Insert the post into the database.
                // wp_insert_post( $submitted_post );
                // Or insert the post and get the ID.
                $post_id = wp_insert_post( $submitted_post );
                // $the_submit_post_id = ( $post_id ) ? $post_id : 'Unable to find the post ID.';

                $response = array(
                    'success'            => true,
                    'message'            => $output_message
                    // 'the_submit_post_id' => $the_submit_post_id // Sends the post ID.
                );
                echo json_encode( $response );
                die;
            }

        } else {

            $errors[] = __( 'Security check failed!', 'VRC' );

        } // if/else nonce ended.

        // In case of errors.
        $response = array(
			'success' => false,
			'errors'  => $errors
        );

        echo json_encode( $response );
    	die;

	} // submit function ended.


	/**
	 * Upload Profile Image.
	 *
	 * @since 1.0.0
	 */
	public function upload_profile_image() {

        // Verify Nonce
        $nonce = $_REQUEST['nonce'];
        if ( ! wp_verify_nonce( $nonce, 'vr_allow_upload_profile_image' ) ) {
            $ajax_response = array(
				'success' => false ,
				'reason'  => __( 'Security check failed!', 'VRC' )
            );
            echo json_encode( $ajax_response );
            die;
        }

        $submitted_file = $_FILES['vr_upload_file_name'];

        // Handle PHP uploads in WordPress, sanitizing file names, checking extensions for mime type,
        // and moving the file to the appropriate directory within the uploads directory.
        $uploaded_image = wp_handle_upload( $submitted_file, array( 'test_form' => false ) ); // TODO: What?

        if ( isset( $uploaded_image['file'] ) ) {

        	// File's name.
            $file_name = basename( $submitted_file['name'] );

            // Retrieve the file type from the file name.
            $file_type = wp_check_filetype( $uploaded_image['file'] );

            // Prepare an array of post data for the attachment.
            $attachment_details = array(
                'guid'           => $uploaded_image['url'],
                'post_mime_type' => $file_type['type'],
                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file_name ) ), // TODO: What?
                'post_content'   => '',
                'post_status'    => 'inherit'
            );

            // This function inserts an attachment into the media library.
            $attach_id = wp_insert_attachment( $attachment_details, $uploaded_image['file'] );

            // This function generates metadata for an image attachment. It also creates a thumbnail
            // and other intermediate sizes of the image attachment based on the sizes defined.
            $attach_data = wp_generate_attachment_metadata( $attach_id, $uploaded_image['file'] );

            // Update metadata for an attachment.
            wp_update_attachment_metadata( $attach_id, $attach_data );

            // Returns escaped URL.
            $thumbnail_url = $this->get_profile_image_url( $attach_data );

            $ajax_response = array(
				'success'       => true,
				'url'           => $thumbnail_url,
				'attachment_id' => $attach_id
            );
            echo json_encode( $ajax_response );
            die;

        } else {
            $ajax_response = array(
				'success' => false,
				'reason'  => __( 'Image upload failed!', 'VRC' )
            );
            echo json_encode( $ajax_response );
            die;
        }

	} // Function ended.


	/**
	 * Get profile image URL.
	 *
	 * Get thumbnail URL based on attachment data.
	 *
	 * @param 	$attach_data
	 * @return 	string
	 * @since 	1.0.0
	 */
	public function get_profile_image_url( $attach_data ) {

		// TODO: What?
		$upload_dir       = wp_upload_dir();
		$image_path_array = explode( '/', $attach_data['file'] );
		$image_path_array = array_slice( $image_path_array, 0, count( $image_path_array ) - 1 );
		$image_path       = implode( '/', $image_path_array );
		$thumbnail_name   = null;

	    // TODO: Image sizes.
	    if ( isset( $attach_data['sizes']['inspiry-agent-thumbnail'] ) ) {
	        $thumbnail_name     =   $attach_data['sizes']['inspiry-agent-thumbnail']['file'];
	    } else {
	        $thumbnail_name     =   $attach_data['sizes']['thumbnail']['file'];
	    }
	    return esc_url( $upload_dir['baseurl'] . '/' . $image_path . '/' . $thumbnail_name );

	} // Function ended.


} // Class ended.

endif;
