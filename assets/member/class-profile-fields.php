<?php
/**
 * Class: VR_Profile_Fields
 *
 * Extra profile fields for users.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Profile_Fields.
 *
 * VR Membership Extra profile fields for users.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Profile_Fields' ) ) :

class VR_Profile_Fields {

	/**
	 * Extra profile fields.
     *
     *
	 * @access static no need for objects.
	 * @since 1.0.0
	 */
	public static function extra_fields( $user_contact_methods ) {


        $user_contact_methods[ 'job_title' ]       = __( 'Job Title', 'VRC' );
        $user_contact_methods[ 'mobile_number' ]   = __( 'Mobile Number', 'VRC' );
        $user_contact_methods[ 'office_number' ]   = __( 'Office Number', 'VRC' );
        $user_contact_methods[ 'fax_number' ]      = __( 'Fax Number', 'VRC' );
        $user_contact_methods[ 'office_address' ]  = __( 'Office Address', 'VRC' );
        $user_contact_methods[ 'facebook_url' ]    = __( 'Facebook URL', 'VRC' );
        $user_contact_methods[ 'twitter_url' ]     = __( 'Twitter URL', 'VRC' );
        $user_contact_methods[ 'google_plus_url' ] = __( 'Google Plus URL', 'VRC' );
        $user_contact_methods[ 'linkedin_url' ]    = __( 'LinkedIn URL', 'VRC' );
        $user_contact_methods[ 'pinterest_url' ]   = __( 'Pinterest URL', 'VRC' );
        $user_contact_methods[ 'instagram_url' ]   = __( 'Instagram URL', 'VRC' );

        return $user_contact_methods;


	} // Function ended.


} // Class ended.

endif;
