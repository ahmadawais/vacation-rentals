<?php
/**
 * View: Registration
 *
 * VR membership registration view.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Array of pages.
 *
 * Array for multiple similar settings and controls.
 *
 * @since  1.0.0
 */
$vr_pages_array = array(
    'login',
    'register',
    'reset'
);

// Save page links here.
$vr_page_links = array();

// Looping through.
foreach ( $vr_pages_array as $page ) {
    $vr_page = get_option( 'vr_page_' . $page );
    $vr_page_links[ $page ] = isset( $vr_page ) && '' != $vr_page && false != $vr_page
                                ? get_permalink( $vr_page ) : '/';
}

/**
 * Display a message if user is already logged in.
 */
if ( is_user_logged_in() ) {

    $current_user = wp_get_current_user();
    $first_name   = esc_html( $current_user->user_firstname );
    $user_login   = esc_html( $current_user->user_login );
    $name = ( empty( $first_name ) ) ? $user_login : $first_name;
    ?>

    <div>

        <h3><?php _e( 'Hey, ' . $name . '!', 'VRC' ); ?></h3>

        <p class="message">
            <?php
                _e( 'You are already logged in. ', 'VRC' );
                _e( 'Go to the <a href="/">Homepage!</a> or <a href="' . wp_logout_url( home_url() ) . '">Logout!</a>', 'VRC' );
            ?>
        </p>
        <!-- /.message -->

    </div>

    <?php

} else {

?>

<div class="form-wrapper">

    <form id="register-form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" enctype="multipart/form-data">

        <div class="vr_form__element">
            <label class="login-form-label" for="register_username"><?php _e( 'Username', 'VRC' ); ?><span>*</span></label>
            <input id="register_username" name="register_username" type="text" class="login-form-input login-form-input-common"
                   title="<?php _e( '* Please enter a valid username.', 'VRC' ); ?>"
                   placeholder="<?php _e( 'Username', 'VRC' ); ?>" />
        </div>

        <div class="vr_form__element">
            <label class="login-form-label" for="register_email"><?php _e( 'Email', 'VRC' ); ?><span>*</span></label>
            <input id="register_email" name="register_email" type="text" class="login-form-input login-form-input-common"
                   title="<?php _e( '* Please provide valid email address!', 'VRC' ); ?>"
                   placeholder="<?php _e( 'Email', 'VRC' ); ?>" />
        </div>

        <div class="vr_form__element">
            <label class="login-form-label" for="register_pwd"><?php _e( 'Password', 'VRC' ); ?></label>
            <input id="register_pwd" name="register_pwd" type="password" class="login-form-input login-form-input-common"
                   title="<?php _e( '* Provide your password', 'VRC' ); ?>"
                   placeholder="<?php _e( 'Password', 'VRC' ); ?>" />
        </div>

        <div class="vr_form__element">
            <label class="login-form-label" for="register_pwd2"><?php _e( 'Confirm Password', 'VRC' ); ?></label>
            <input id="register_pwd2" name="register_pwd2" type="password" class="login-form-input login-form-input-common"
                   title="<?php _e( '* Password should be same as above', 'VRC' ); ?>"
                   placeholder="<?php _e( 'Confirm Password', 'VRC' ); ?>" />
        </div>

        <div class="vr_form__element  vr_btn vr_btn--block">
            <input type="submit" id="register-button" name="user-submit" class="vr_btn--primary vr_btn--homePad" value="<?php _e( 'Register', 'VRC' ); ?>" />
            <input type="hidden" name="action" value="vr_ajax_register" />
            <?php  // nonce for security
            wp_nonce_field( 'vr-ajax-register-nonce', 'vr-secure-register' );

            if ( is_page() || is_single() ) {
                ?><input type="hidden" name="redirect_to" value="<?php wp_reset_postdata(); global $post; the_permalink( $post->ID ); ?>" /><?php
            } else {
                ?><input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" /><?php
            }

            ?>
            <div class="text-center">
                <div id="register-message" class="modal-message vr_notice vr_notice--success vr_dn"></div>
                <div id="register-error" class="modal-error vr_notice vr_notice--error vr_dn"></div>
                <img id="register-loader" class="modal-loader" src="<?php echo VRC_URL; ?>/assets/img/ajax-loader.gif" alt="Working...">
            </div>
        </div>

    </form>

    <div class="vr_form__element">
        <span class="vr_btn">
            <a
                href="<?php echo $vr_page_links['login']; ?>"
                class="vr_btn--secondary vr_btn--homePad vr_open_login_form"
            >
                <?php _e( 'Login', 'VRC' ); ?>
            </a>
        </span>
        <span class="vr_btn">
            <a
                href="<?php echo $vr_page_links['reset']; ?>"
                class="vr_btn--secondary vr_btn--homePad vr_open_reset_form"
            >
                <?php _e( 'Forgot Password?', 'VRC' ); ?>
            </a>
        </span>

    </div>

</div>

<?php } // if/else ended. ?>
