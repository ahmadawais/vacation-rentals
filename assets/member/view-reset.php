<?php
/**
 * View: Forget File
 *
 * VR membership forget view.
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
    'reset',
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
    $name         = ( empty( $first_name ) ) ? $user_login : $first_name;
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

    <form id="forgot-form" class="vr_forgot_form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" enctype="multipart/form-data">

        <div class="vr_form__element">
            <label class="login-form-label" for="reset_username_or_email"><?php _e( 'Username or Email', 'VRC' ); ?><span>*</span></label>
            <input id="reset_username_or_email" name="reset_username_or_email" type="text" class="login-form-input login-form-input-common required"
                   title="<?php _e( '* Provide a valid username or email!', 'VRC' ); ?>"
                   placeholder="<?php _e( 'Username or Email', 'VRC' ); ?>" />
        </div>

        <div class="vr_form__element  vr_btn vr_btn--block ">
            <input type="submit" id="forgot-button" name="user-submit" class="vr_btn--primary vr_btn--homePad" value="<?php _e( 'Reset Password', 'VRC' ); ?>">
            <input type="hidden" name="action" value="vr_ajax_reset" />
            <input type="hidden" name="user-cookie" value="1" />
            <?php wp_nonce_field( 'vr-ajax-forgot-nonce', 'vr-secure-reset' ); ?>
            <div class="text-center">
                <div id="forgot-message" class="modal-message vr_notice vr_notice--success vr_dn"></div>
                <div id="forgot-error" class="modal-error vr_notice vr_notice--error vr_dn"></div>
                <img id="forgot-loader" class="modal-loader vr_dn" src="<?php echo VRC_URL; ?>/assets/img/ajax-loader.gif" alt="Working...">
            </div>
        </div>

    </form>

    <div class="clearfix clear">

        <?php if( get_option( 'users_can_register' ) ) : ?>

            <div class="vr_form__element">
                <span class="vr_btn ">
                    <a
                        href="<?php echo $vr_page_links['login']; ?>"
                        class="vr_btn--secondary vr_btn--homePad vr_open_login_form"
                    >
                        <?php _e( 'Login', 'VRC' ); ?>
                    </a>
                </span>

                <span class="vr_btn">
                    <a
                        href="<?php echo $vr_page_links['register']; ?>"
                        class="vr_btn--secondary vr_btn--homePad vr_open_register_form"
                    >
                        <?php _e( 'Register', 'VRC' ); ?>
                    </a>
                </span>

            </div>
        <?php endif; ?>

    </div>

</div>

<?php } // if/else ended. ?>
