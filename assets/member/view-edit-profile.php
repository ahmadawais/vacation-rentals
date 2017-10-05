<?php
/**
 * View: Edit Profile File
 *
 * VR membership edit-profile view.
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

    if( ! is_user_logged_in() ) { ?>

        <div class="vr_404__wrap">
            <p class="vr_notice vr_notice--error"><?php _e( 'Login required! You need to login to be able edit your profile!', 'VR' ); ?></p>

            <?php do_shortcode( '[vr_login]' ); ?>
        </div>

    <?php } else {

        // Get user information.
        global $current_user;
        get_currentuserinfo();
        $current_user_meta = get_user_meta( $current_user->ID );

        ?>
        <form id="inspiry-edit-user" class="submit-form" enctype="multipart/form-data" method="post">

            <div class="row">

                <div class="col-md-6">
                    <div class="vr_form__element user-profile-img-wrapper clearfix">

                        <div id="user-profile-img">
                            <div class="profile-thumb">
                                <?php
                                if( isset( $current_user_meta['profile_image_id'] ) ) {
                                    $profile_image_id = intval( $current_user_meta['profile_image_id'][0] );
                                    if ( $profile_image_id ) {
                                        echo wp_get_attachment_image( $profile_image_id, 'inspiry-agent-thumbnail', false, array( 'class' => 'img-responsive' ) );
                                        echo '<input type="hidden" class="profile-image-id" name="profile-image-id" value="' . $profile_image_id .'"/>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <!-- #user-profile-img -->

                        <div class="profile-img-controls">

                            <ul class="vr_notice vr_notice--info">
                                <li><?php _e( 'Profile image should have minimum width and height of 220px.', 'VRC' ); ?></li>
                                <li><?php _e( 'Make sure to save changes after uploading the new image.', 'VRC' ); ?></li>
                            </ul>

                            <div class="vr_btn vr_btn">
                                <a id="select-profile-image" class="vr_btn--secondary vr_btn--homePad" href="javascript:;">
                                    <i class="fa fa-picture-o"></i><?php _e( 'Change', 'VRC' ); ?>
                                </a>
                            </div>
                            <!-- /.vr_btn -->

                            <div class="vr_btn vr_btn">
                                <a id="remove-profile-image" class="vr_btn--secondary vr_btn--homePad" href="#remove-profile-image">
                                    <i class="fa fa-trash-o"></i><?php _e( 'Remove', 'VRC' ); ?>
                                </a>
                            </div>
                            <!-- /.vr_btn -->



                            <div id="errors-log" class=""></div>
                            <div id="plupload-container"></div>

                        </div>
                        <!-- .profile-img-controls -->

                    </div>
                    <!-- .user-profile-img-wrapper -->
                </div>

                <div class="col-md-6">
                    <div class="vr_form__element">
                        <label for="description"><?php _e('Biographical Information', 'VRC') ?></label>
                        <textarea name="description" id="description" rows="5" cols="30"><?php if( isset( $current_user_meta['description'] ) ) { echo esc_textarea( $current_user_meta['description'][0] ); } ?></textarea>
                    </div>
                </div>

            </div>
            <!-- .row -->

            <div class="row">

                <div class="col-md-4">
                    <div class="vr_form__element">
                        <label for="first-name"><?php _e('First Name', 'VRC'); ?></label>
                        <input class="valid required" name="first-name" type="text" id="first-name" value="<?php if( isset( $current_user_meta['first_name'] ) ) { echo esc_attr( $current_user_meta['first_name'][0] ); } ?>" autofocus />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="vr_form__element">
                        <label for="last-name"><?php _e('Last Name', 'VRC'); ?></label>
                        <input class="required" name="last-name" type="text" id="last-name" value="<?php if( isset( $current_user_meta['last_name'] ) ) {  echo esc_attr( $current_user_meta['last_name'][0] ); } ?>" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="vr_form__element">
                        <label for="display-name"><?php _e('Display Name', 'VRC'); ?> *</label>
                        <input class="required" name="display-name" type="text" id="display-name" value="<?php echo esc_attr( $current_user->display_name ); ?>" required />
                    </div>
                </div>

            </div>
            <!-- .row -->

            <div class="row">

                <div class="col-md-4">
                    <div class="vr_form__element">
                        <label for="email"><?php _e('Email', 'VRC'); ?> *</label>
                        <input class="email required" name="email" type="email" id="email" value="<?php echo esc_attr( $current_user->user_email ); ?>" required/>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="vr_form__element">
                        <label for="mobile-number"><?php _e('Mobile Number', 'VRC'); ?></label>
                        <input class="digits" name="mobile-number" type="text" id="mobile-number" value="<?php if( isset( $current_user_meta['mobile_number'] ) ) { echo esc_attr( $current_user_meta['mobile_number'][0] ); } ?>" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="vr_form__element">
                        <label for="office-number"><?php _e('Office Number', 'VRC'); ?></label>
                        <input class="digits" name="office-number" type="text" id="office-number" value="<?php if( isset( $current_user_meta['office_number'] ) ) { echo esc_attr( $current_user_meta['office_number'][0] ); } ?>" />
                    </div>
                </div>


            </div>
            <!-- .row -->

            <div class="row">

                <div class="col-md-4">
                    <div class="vr_form__element">
                        <label for="fax-number"><?php _e('Fax Number', 'VRC'); ?></label>
                        <input class="digits" name="fax-number" type="text" id="fax-number" value="<?php if( isset( $current_user_meta['fax_number'] ) ) { echo esc_attr( $current_user_meta['fax_number'][0] ); } ?>" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="vr_form__element">
                        <label for="facebook-url"><?php _e('Facebook URL', 'VRC'); ?></label>
                        <input class="url" name="facebook-url" type="text" id="facebook-url" value="<?php if( isset( $current_user_meta['facebook_url'] ) ) { echo esc_url( $current_user_meta['facebook_url'][0] ); } ?>" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="vr_form__element">
                        <label for="twitter-url"><?php _e('Twitter URL', 'VRC'); ?></label>
                        <input class="url" name="twitter-url" type="text" id="twitter-url" value="<?php if( isset( $current_user_meta['twitter_url'] ) ) { echo esc_url( $current_user_meta['twitter_url'][0] ); } ?>" />
                    </div>
                </div>


            </div>
            <!-- .row -->

            <div class="row">

                <div class="col-md-4">
                    <div class="vr_form__element">
                        <label for="google-plus-url"><?php _e('Google Plus URL', 'VRC'); ?></label>
                        <input class="url" name="google-plus-url" type="text" id="google-plus-url" value="<?php if( isset( $current_user_meta['google_plus_url'] ) ) { echo esc_url( $current_user_meta['google_plus_url'][0] ); } ?>" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="vr_form__element">
                        <label for="linkedin-url"><?php _e('LinkedIn URL', 'VRC'); ?></label>
                        <input class="url" name="linkedin-url" type="text" id="linkedin-url" value="<?php if( isset( $current_user_meta['linkedin_url'] ) ) { echo esc_url( $current_user_meta['linkedin_url'][0] ); } ?>" />
                    </div>
                </div>


            </div>
            <!-- .row -->

            <!-- TODO: add instagram and pinterest -->

            <div class="row">

                <div class="col-md-4">
                    <div class="vr_form__element">
                        <label for="pass1"><?php _e( 'Password', 'VRC' ); ?>
                            <small><?php _e( '( Fill it only when you want to change )', 'VRC' ); ?></small>
                        </label>
                        <input name="pass1" type="password" id="pass1">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="vr_form__element">
                        <label for="pass2"><?php _e('Confirm Password', 'VRC'); ?></label>
                        <input name="pass2" type="password" id="pass2" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="vr_form__element">
                        <?php
                        //action hook for plugin and extra fields
                        // do_action( 'edit_user_profile', $current_user );

                        // WordPress Nonce for Security Check
                        wp_nonce_field( 'vr_update_profile', 'vr_update_profile_nonce' );
                        ?>
                        <input type="hidden" name="action" value="vr_update_profile_action" />
                    </div>
                </div>

            </div>
            <!-- .row -->

            <div class="vr_form__element vr_btn vr_btn--block">
                <input type="submit" id="update-user" name="update-user" class="vr_btn--secondary vr_btn--homePad" value="<?php _e( 'Save Changes', 'VRC' ); ?>">
                <img src="<?php echo VRC_URL; ?>/assets/img/ajax-loader.gif" id="ajax-loader" alt="Loading..." class="vr_dn"/>
            </div>

            <p id="form-message" class="vr_notice vr_notice--success vr_dn"></p>
            <ul id="form-errors" class="vr_notice vr_notice--error vr_dn"></ul>

        </form>
        <!-- #inspiry-edit-user -->
        <?php

        } // Else ended.

    ?>

</div>
<!-- .user-profile-wrapper -->
