<?php
/**
 * LOGIC: Edit Rental
 *
 * Logical part of the view-edit-rental.
 *
 * @since   1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>


<div class="white-box submit-property-box">

    <?php


    /**
     * VIEW: submit-rental.
     *
     * @since 1.0.0
     */
    if ( file_exists( VRC_DIR . '/assets/rental/frontend/view-submit-rental.php' ) ) {
        require_once( VRC_DIR . '/assets/rental/frontend/view-submit-rental.php' );
    }

    // /*
    //  * Property submit and update stuff.
    //  */
    // if( is_user_logged_in() ) {

    //     if( $invalid_nonce ) {

    //         VR_Functions::message( __( 'Oops', 'VRC' ), __( 'Security check failed!', 'VRC' ) );

    //     } else {

    //         if( $submitted_successfully ) {

    //             VR_Functions::message( __( 'Submitted','VRC' ), __( 'Property successfully submitted.', 'VRC' ) );

    //         } else if( $updated_successfully ) {

    //             VR_Functions::message( __('Updated','VRC'), __('Property updated successfully.', 'VRC' ) );

    //         } else {

    //             if( isset( $_GET['edit_property'] ) && ! empty( $_GET['edit_property'] ) ) { // if passed parameter is properly set to edit property

    //                 /**
    //                  * VIEW: edit-rental.
    //                  *
    //                  * @since 1.0.0
    //                  */
    //                 if ( file_exists( VRC_DIR . '/assets/rental/frontend/view-edit-rental.php' ) ) {
    //                     require_once( VRC_DIR . '/assets/rental/frontend/view-edit-rental.php' );
    //                 }

    //             } else {


    //                 /**
    //                  * VIEW: submit-rental.
    //                  *
    //                  * @since 1.0.0
    //                  */
    //                 if ( file_exists( VRC_DIR . '/assets/rental/frontend/view-submit-rental.php' ) ) {
    //                     require_once( VRC_DIR . '/assets/rental/frontend/view-submit-rental.php' );
    //                 }

    //             }

    //         }

    //     }

    // } else {

    //     VR_Functions::message( __( 'Login Required', 'VRC' ), __( 'You need to login to submit a property!', 'VRC' ) );

    // }

    ?>

</div>
<!-- .submit-property-box -->

