<?php
/**
 * View: Submit Booking
 *
 * VR booking submit-booking view.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>


<div class="white-box user-profile-wrapper">

    <?php

    if( ! is_user_logged_in() ) {

        echo "Login Required! You need to login to be able book a rental!";

    } else {

        // Get user information.
        global $current_user;
        get_currentuserinfo();
        $current_user_meta     = get_user_meta( $current_user->ID );
        $rental_id_for_booking = get_the_ID();

    ?>
        <form
            id      ="vr-submit-booking"
            method  ="post"
            class   ="submit-booking-form"
            enctype ="multipart/form-data" >


            <div class="form-option">

                <div>
                    <label for="vr_booking_date_checkin">
                        <?php _e('Check In:', 'VRC'); ?>
                    </label>

                    <input
                        type  ="text"
                        name  ="vr_booking_date_checkin"
                        id    ="vr_booking_date_checkin"
                    />

                </div>

            </div>

            <div class="form-option">

                <div>
                    <label for="vr_booking_date_checkout">
                        <?php _e('Check Out:', 'VRC'); ?>
                    </label>
                    <input
                        type  ="text"
                        name  ="vr_booking_date_checkout"
                        id    ="vr_booking_date_checkout"
                    />
                </div>

            </div>

            <div class="form-option">

                <div>
                    <label for="vr_booking_guests">
                        <?php _e('Guests:', 'VRC'); ?>
                    </label>
                    <input
                        type  ="number"
                        name  ="vr_booking_guests"
                        id    ="vr_booking_guests"
                        step  ="1"
                    />
                </div>

            </div>

            <div class="form-option">

                <input
                    type  = "submit"
                    name  = "submit_booking"
                    id    = "submit-booking"
                    class = "btn-small btn-orange"
                    value = "<?php _e( 'Submit Booking', 'VRC' ); ?>"
                />

                <img
                    src ="<?php echo VRC_URL; ?>/assets/img/ajax-loader.gif"
                    id  ="ajax-loader"
                    alt ="Loading..."
                />

                <!-- Form Hidden Data -->
                <input
                    type  ="hidden"
                    name  ="action"
                    value ="vr_submit_booking_action"
                />

                <input
                    type  ="hidden"
                    name  ="vr_booking_is_confirmed"
                    value ="<?php
                                // Pending.
                                echo 'pending';

                                // Confirmed.
                                // echo 'confirmed';
                            ?>"
                />

                <input
                    type  ="hidden"
                    name  ="rental_id_for_booking"
                    value ="<?php echo $rental_id_for_booking; ?>"
                />

                <?php wp_nonce_field( 'vr_submit_booking', 'vr_submit_booking_nonce' ); ?>
            </div>

            <p id="form-message"></p>
            <p id="form-bookingid"></p>
            <ul id="form-errors"></ul>

        </form>
        <!-- #vr-submit-booking -->

    <?php } // Else ended. ?>

</div>
<!-- .user-profile-wrapper -->
