<?php
/**
 * Class: VR_Edit_Profile
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
 * VR_Edit_Profile.
 *
 * VR Membership edit_profile class.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Edit_Profile' ) ) :

class VR_Edit_Profile {

	/**
	 * Shortcode.
	 *
	 * @since 1.0.0
	 */
	public function edit_profile() {

		/**
		 * Shortcode: `[vr_edit_profile]`.
		 *
		 * @since 1.0.0
		 */
		add_shortcode( 'vr_edit_profile', function () {

			/**
			 * VIEW: edit_profile.
			 *
			 * @since 1.0.0
			 */
			if ( file_exists( VRC_DIR . '/assets/member/view-edit-profile.php' ) ) {
			    require_once( VRC_DIR . '/assets/member/view-edit-profile.php' );
			}

		} );// annonymous function and action ended.

	} // Function ended.


    /**
     * Set Profile Field.
     *
     * If there is $data, then save its value in
     * user's meta $key, otherwise empty the $key's
     * value.
     *
     * @param  string   $key    | meta key.
     * @param  string   $data   | $_POST['stuff']
     * @param  int      $user   | $current_user->ID
     * @since  1.0.0
     */
    public function set_profile_field( $key, $data, $user ) {

        if ( ! empty( $data ) ) {

            if ( $key == 'facebook_url'
                || $key == 'twitter_url'
                || $key == 'google_plus_url_url'
                || $key == 'linkedin_url_url' ) {

                $value = esc_url_raw( sanitize_text_field( $data ) );

            } elseif( $key == 'profile_image_id' ) {

                $value = intval( $data );

            } else {

                $value = sanitize_text_field( $data );

            }

            update_user_meta( $user, $key, $value );

        } else {

            // if user wants to delete the value.
            delete_user_meta( $user, $key );

        } // if/else ended.

    } // function ended.

    /**
     * Set All Fields.
     *
     * Takes an fields_array and sets the fields value.
     *
     * @param array $fields_array   | array of meta keys and user input data.
     * @since 1.0.0
     */
    public function set_all_fields( $fields_array, $user ) {

        foreach ( $fields_array as $key => $data ) {
            $this->set_profile_field( $key, $data, $user );
        }

    }

	/**
	 * Update Profile.
	 *
	 * @since 1.0.0
	 */
	public function update_profile() {

        // Get user info.
        global $current_user;
        get_currentuserinfo();

        $user_id = $current_user->ID;

        // Errors array.
        $errors = array();

		// Verify the nonce.
        if( wp_verify_nonce( $_POST['vr_update_profile_nonce'], 'vr_update_profile' ) ) {

            // Update profile image via `profile-image-id`.

            /**
             * Setting all the fields.
             *
             * Array of meta keys and user input data.
             * Santizable inputs only.
             *
             * @since 1.0.0
             */
            $fields_array = array(
                'first_name'       => $_POST['first-name'],
                'last_name'        => $_POST['last-name'],
                'description'      => $_POST['description'],
                'mobile_number'    => $_POST['mobile-number'],
                'office_number'    => $_POST['office-number'],
                'fax_number'       => $_POST['fax-number'],
                'facebook_url'     => $_POST['facebook-url'],
                'twitter_url'      => $_POST['twitter-url'],
                'google_plus_url'  => $_POST['google-plus-url'],
                'linkedin_url'     => $_POST['linkedin-url'],
                'profile_image_id' => $_POST['profile-image-id']

                );

            $check_errors = $this->set_all_fields( $fields_array, $user_id );




            // if ( ! empty( $_POST['profile-image-id'] ) ) {
            //     $profile_image_id = intval( $_POST['profile-image-id'] );
            //     update_user_meta( $user_id, 'profile_image_id', $profile_image_id );
            // } else {
            //     delete_user_meta( $user_id, 'profile_image_id' );
            // }
            // Update user description.
            // if ( ! empty( $_POST['description'] ) ) {
            //     $user_description = sanitize_text_field( $_POST['description'] );
            //     update_user_meta( $user_id, 'description', $user_description );
            // } else {
            //     delete_user_meta( $user_id, 'description' );
            // }

            // Update mobile number.
            // if ( ! empty( $_POST['mobile-number'] ) ) {
            //     $user_mobile_number = sanitize_text_field( $_POST['mobile-number'] );
            //     update_user_meta( $user_id, 'mobile_number', $user_mobile_number );
            // } else {
            //     delete_user_meta( $user_id, 'mobile_number' );
            // }

            // Update office number.
            // if ( ! empty( $_POST['office-number'] ) ) {
            //     $user_office_number = sanitize_text_field( $_POST['office-number'] );
            //     update_user_meta( $user_id, 'office_number', $user_office_number );
            // } else {
            //     delete_user_meta( $user_id, 'office_number' );
            // }

            // Update fax number.
            // if ( ! empty( $_POST['fax-number'] ) ) {
            //     $user_fax_number = sanitize_text_field( $_POST['fax-number'] );
            //     update_user_meta( $user_id, 'fax_number', $user_fax_number );
            // } else {
            //     delete_user_meta( $user_id, 'fax_number' );
            // }

            // Update facebook url.
            // if ( ! empty( $_POST['facebook-url'] ) ) {
            //     $facebook_url = esc_url_raw( sanitize_text_field( $_POST['facebook-url'] ) );
            //     update_user_meta( $user_id, 'facebook_url', $facebook_url );
            // } else {
            //     delete_user_meta( $user_id, 'facebook_url' );
            // }

            // Update twitter url.
            // if ( ! empty( $_POST['twitter-url'] ) ) {
            //     $twitter_url = esc_url_raw( sanitize_text_field( $_POST['twitter-url'] ) );
            //     update_user_meta( $user_id, 'twitter_url', $twitter_url );
            // } else {
            //     delete_user_meta( $user_id, 'twitter_url' );
            // }

            // Update google plus url.
            // if ( ! empty( $_POST['google-plus-url'] ) ) {
            //     $google_plus_url = esc_url_raw( sanitize_text_field( $_POST['google-plus-url'] ) );
            //     update_user_meta( $user_id, 'google_plus_url', $google_plus_url );
            // } else {
            //     delete_user_meta( $user_id, 'google_plus_url' );
            // }

            // Update linkedIn url.
            // if ( ! empty( $_POST['linkedin-url'] ) ) {
            //     $linkedin_url = esc_url_raw( sanitize_text_field( $_POST['linkedin-url'] ) );
            //     update_user_meta( $user_id, 'linkedin_url', $linkedin_url );
            // } else {
            //     delete_user_meta( $user_id, 'linkedin_url' );
            // }

            // todo: add instagram and pin


            // Update display name.
            if ( ! empty( $_POST['display-name'] ) ) {
                $user_display_name = sanitize_text_field( $_POST['display-name'] );
                $return = wp_update_user( array(
                    'ID'           => $user_id,
                    'display_name' => $user_display_name
                ) );
                if ( is_wp_error( $return ) ) {
                    $errors[] = $return->get_error_message();
                }
            }

            // Update user email.
            if ( ! empty( $_POST['email'] ) ){
                $user_email = is_email( sanitize_email ( $_POST['email'] ) );
                if ( ! $user_email )
                    $errors[] = __( 'Provided email address is invalid.', 'VRC' );
                else {
                    // email_exists returns a user id if a user exists against it.
                    $email_exists = email_exists( $user_email );
                    if( $email_exists ) {
                        if( $email_exists != $user_id ){
                            $errors[] = __('Provided email is already in use by another user. Try a different one.', 'VRC');
                        } else {
                            // no need to update the email as it is already current user's email.
                        }
                    } else {
                        $return = wp_update_user( array ('ID' => $user_id, 'user_email' => $user_email ) );
                        if ( is_wp_error( $return ) ) {
                            $errors[] = $return->get_error_message();
                        } // if ended.
                    } // else ended.
                } // else ended.
            } // if ended.

            // Update user password
            if ( ! empty($_POST['pass1'] ) && ! empty( $_POST['pass2'] ) ) {
                if ( $_POST['pass1'] == $_POST['pass2'] ) {
                    $return = wp_update_user( array(
						'ID'        => $user_id,
						'user_pass' => $_POST['pass1']
                    ) );
                    if ( is_wp_error( $return ) ) {
                        $errors[] = $return->get_error_message();
                    }
                } else {
                    $errors[] = __('The passwords you entered do not match.  Your password is not updated.', 'VRC');
                }
            }

            // If everything is fine.
            if ( count( $errors ) == 0 ) {

                //action hook for plugins and extra fields saving
                // do_action( 'edit_user_profile_update', $user_id );

                $response = array(
                    'success' => true,
                    'message' => __( 'Submitted! <br/> Your profile information was successfully updated!', 'VRC' ),
                );
                echo json_encode( $response );
                die;
            }

        } else {
            $errors[] = __('Security check failed!', 'VRC');
        } // if nonce ended.

        // In case of errors
        $response = array(
			'success' => false,
			'errors'  => $errors
        );

        echo json_encode( $response );
    	die;


	} // update_profile function ended.


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
