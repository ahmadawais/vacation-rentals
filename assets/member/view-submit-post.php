<?php
/**
 * View: Post File
 *
 * VR membership submit-post view.
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

    if( ! is_user_logged_in() ) {?>

        <div class="vr_404__wrap">
            <h2><?php _e( 'Login Required!', 'VR' ); ?></h2>
            <p class="vr_notice vr_notice--error"><?php _e( 'You need to login to be able to submit post!', 'VR' ); ?></p>

            <?php do_shortcode( '[vr_login]' ); ?>
        </div>

    <?php } else { ?>

        <form
            id      ="vr-submit-post"
            method  ="post"
            class   ="submit-form"
            enctype ="multipart/form-data" >


            <div class="form-option">

                <label for="post-title">
                    <?php _e('Post Title', 'VRC'); ?>
                </label>

                <input
                    type        = "text"
                    name        = "post_title"
                    id          = "post-title"
                    class       = "valid required"
                    placeholder = "Enter the title..."
                    autofocus
                />

            </div>

            <div class="form-option">

                <label for="post-content">
                    <?php _e('Post Content', 'VRC'); ?>
                </label>


                <textarea
                    name         = "post_content"
                    id           = "post-content"
                    class        = "valid"
                    rows         = "5"
                    cols         = "30"
                    aria-invalid = "false"
                    placeholder  = "Enter the content..."
                    >
                </textarea>

            </div>


            <!-- Form Hidden Data -->
            <div class="form-option">

                <input
                    type  = "submit"
                    name  = "submit_post"
                    id    = "submit-post"
                    class = "btn-small btn-orange"
                    value = "<?php _e( 'Submit Post', 'VRC' ); ?>"
                />

                <img
                    src ="<?php echo VRC_URL; ?>/assets/img/ajax-loader.gif"
                    id  ="ajax-loader"
                    alt ="Loading..."
                />

                <input
                    type  ="hidden"
                    name  ="action"
                    value ="vr_submit_post_action"
                />

                <?php wp_nonce_field( 'vr_submit_post', 'vr_submit_post_nonce' ); ?>
            </div>

            <p id="form-message"></p>
            <p id="form-postid"></p>
            <ul id="form-errors"></ul>

        </form>
        <!-- #vr-submit-post -->

    <?php } // Else ended. ?>

</div>
<!-- .user-profile-wrapper -->
