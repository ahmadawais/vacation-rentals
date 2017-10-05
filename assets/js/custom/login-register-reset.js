/**
 * Login Register Reset JS
 *
 * Login Register Reset JS for memberships stuff.
 *
 * @since 	1.0.0
 * @package VRC
 */

jQuery( function( $ ) {

		// TODO: Future Feature.
		// $( '.vr_open_login_form' ).on( 'click', function() {
		// 	$( '.vr_login_section' ).toggle( 'slow' );
		// 	$( '.vr_register_section' ).slideUp( 'slow' );
		// 	$( '.vr_reset_section' ).slideUp( 'slow' );
		// });

		// $( '.vr_open_register_form' ).on( 'click', function() {
		// 	$( '.vr_register_section' ).toggle( 'slow' );
		// 	$( '.vr_login_section' ).slideUp( 'slow' );
		// 	$( '.vr_reset_section' ).slideUp( 'slow' );
		// });

		// $( '.vr_open_reset_form' ).on( 'click', function() {
		// 	$( '.vr_reset_section' ).toggle( 'slow' );
		// 	$( '.vr_login_section' ).slideUp( 'slow' );
		// 	$( '.vr_register_section' ).slideUp( 'slow' );

		// });


	    /**
	     * AJAX Login Form Handling.
	     *
	     * @since 1.0.0
	     */
	    var loginButton     = $('#login-button'),
			loginAjaxLoader = $('#login-loader'),
			loginError      = $("#login-error" ),
			loginMessage    = $('#login-message');

			// No loader to begin with.
            loginAjaxLoader.fadeOut(); // TODO: WHY?

	    var loginOptions = {
	        beforeSubmit: function () {
	            loginButton.attr('disabled', 'disabled');
	            loginAjaxLoader.removeClass( 'vr_dn' );
	            loginAjaxLoader.fadeIn('fast');
	            loginMessage.fadeOut('fast');
	            loginError.fadeOut('fast');
	        },
	        success: function ( ajax_response, statusText, xhr, $form ) {
	            var response = $.parseJSON( ajax_response );
	            loginAjaxLoader.fadeOut('fast');
	            loginButton.removeAttr('disabled');
	            if ( response.success ) {
	                loginMessage.removeClass( 'vr_dn' );
	                loginMessage.html( response.message ).fadeIn('fast');
	                document.location.href = response.redirect;
	            } else {
	                loginError.removeClass( 'vr_dn' );
	                loginError.html( response.message ).fadeIn('fast');
	            }
	        }
	    };

	    $('#login-form').validate({
	        submitHandler: function ( form ) {
	            $(form).ajaxSubmit( loginOptions );
	        }
	    });


	    /**
	     * AJAX Registeration Form Handling.
	     *
	     * @since 1.0.0
	     */
	    var registerButton     = $('#register-button'),
			registerAjaxLoader = $('#register-loader'),
			registerError      = $("#register-error" ),
			registerMessage    = $('#register-message');

            registerAjaxLoader.fadeOut('fast'); // TODO: WHY?


	    var registerOptions = {
	        beforeSubmit: function () {
	            registerButton.attr('disabled', 'disabled');
	            registerAjaxLoader.removeClass( 'vr_dn' );
	            registerAjaxLoader.fadeIn('fast');
	            registerMessage.fadeOut('fast');
	            registerError.fadeOut('fast');
	        },
	        success: function (ajax_response, statusText, xhr, $form) {
	            var response = $.parseJSON( ajax_response );
	            registerAjaxLoader.fadeOut('fast');
	            registerButton.removeAttr('disabled');
	            if ( response.success ) {
	                registerMessage.removeClass( 'vr_dn' );
	                registerMessage.html( response.message ).fadeIn('fast');
	                document.location.href = response.redirect;
	            } else {
	                registerError.removeClass( 'vr_dn' );
	                registerError.html( response.message ).fadeIn('fast');
	            }
	        }
	    };

	    $('#register-form').validate({
	        rules: {
	            register_username: {
	                required: true
	            },
	            register_email: {
	                required: true,
	                email: true
	            },
	            register_pwd: {
	                required: true
	            },
	            register_pwd2: {
	                equalTo: "#register_pwd"
	            }
	        },
	        submitHandler: function ( form ) {
	            $(form).ajaxSubmit( registerOptions );
	        }
	    });


	    /**
	     * AJAX Reset pass Form Handling.
	     *
	     * @since 1.0.0
	     */
	    var forgotButton     = $('#forgot-button'),
			forgotAjaxLoader = $('#forgot-loader'),
			forgotError      = $("#forgot-error" ),
			forgotMessage    = $('#forgot-message');

            forgotAjaxLoader.fadeOut('fast'); // TODO: WHY?
            forgotMessage.fadeOut('fast');
            forgotError.fadeOut('fast');


	    var forgotOptions = {
	        beforeSubmit: function () {
	            forgotButton.attr('disabled', 'disabled');

	            forgotAjaxLoader.removeClass( 'vr_dn' );
	            forgotAjaxLoader.fadeIn('fast');
	            forgotMessage.fadeOut('fast');
	            forgotError.fadeOut('fast');
	        },
	        success: function (ajax_response, statusText, xhr, $form) {
	            var response = $.parseJSON( ajax_response );
	            forgotAjaxLoader.fadeOut('fast');
	            forgotButton.removeAttr('disabled');
	            if ( response.success ) {
	                forgotMessage.removeClass( 'vr_dn' );
	                forgotMessage.html( response.message ).fadeIn('fast');
	                $form.resetForm();
	            } else {
	                forgotError.removeClass( 'vr_dn' );
	                forgotError.html( response.message ).fadeIn('fast');
	            }
	        }
	    };

	    $('#forgot-form').validate({
	        submitHandler: function ( form ) {
	            $(form).ajaxSubmit( forgotOptions );
	        }
	    });

} ); // EOF.
