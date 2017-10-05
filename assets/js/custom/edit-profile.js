/**
 * Edit Profile JS
 *
 * Edit wser profile relate JS.
 *
 * @since   1.0.0
 * @package VRC
 */
jQuery(document).ready(function($) {

    "use strict";

    if ( typeof editProfile !== "undefined" ) {

        var ajaxURL       = editProfile.ajaxURL;
        var uploadNonce   = editProfile.uploadNonce;
        var fileTypeTitle = editProfile.fileTypeTitle;

        /**
         * Validate Edit Profile Form.
         *
         * @since 1.0.0
         */
        if ( jQuery().validate && jQuery().ajaxSubmit ) {

            var form_loader      = $('#ajax-loader');
            var form_message     = $('#form-message');
            var errors_container = $( '#form-errors' );

            // No loader to begin with.
            form_loader.fadeOut();


            // Edit User Profile Form.
            var edit_form_options = {
                url         : editProfile.ajaxURL,
                type        : 'post',
                dataType    : 'json',
                timeout     : 30000,
                beforeSubmit: function( formData, jqForm, options ){
                    form_loader.removeClass( 'vr_dn' );
                    form_loader.fadeIn();
                    form_message.empty().fadeOut();
                    errors_container.empty().fadeOut();
                },
                success: function( response, status, xhr, $form ){
                    form_loader.fadeOut();
                    if ( response.success ) {
                        form_message.removeClass( 'vr_dn' );
                        form_message.html( response.message).fadeIn();
                    } else {
                        for ( var i=0; i < response.errors.length; i++ ) {
                            errors_container.append( '<li>' + response.errors[i] + '</li>' );
                        }
                        errors_container.removeClass( 'vr_dn' );
                        errors_container.fadeIn();
                    }
                }
            };

            $( '#inspiry-edit-user' ).validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    pass2: {
                        equalTo: "#pass1"
                    }
                },
                submitHandler: function( form ) {
                    $( form ).ajaxSubmit( edit_form_options );
                }
            });
        }

        /**
         * Initialize uploader.
         *
         * @since 1.0.0
         */
        var uploader = new plupload.Uploader({

            // This can be an id of a DOM element or the DOM element itself.
            browse_button  : 'select-profile-image',

             // Used in `upload_profile_image()` Line# 262.
            file_data_name : 'vr_upload_file_name',
            container      : 'plupload-container',
            multi_selection: false,

            // This action is used for `add_action` in `member-init.php`.
            url            : ajaxURL + "?action=vr_profile_image_upload&nonce=" + uploadNonce,
            filters: {
                mime_types : [
                    { title : fileTypeTitle, extensions : "jpg,jpeg,gif,png" }
                ],
                max_file_size: '2000kb',
                prevent_duplicates: true
            }
        });
        uploader.init();


        /**
         * Run after adding file.
         *
         * @since 1.0.0
         */
        uploader.bind('FilesAdded', function(up, files) {
            var html = '';
            var profileThumb = "";
            plupload.each(files, function(file) {
                profileThumb += '<div id="holder-' + file.id + '" class="profile-thumb">' + '' + '</div>';
            });
            document.getElementById('user-profile-img').innerHTML = profileThumb;
            up.refresh();
            uploader.start();
        });


        /**
         * Run during upload.
         *
         * @since 1.0.0
         */
        uploader.bind('UploadProgress', function(up, file) {
            document.getElementById( "holder-" + file.id ).innerHTML = '<span>' + file.percent + "%</span>";
        });


        /**
         * In case of error.
         *
         * @since 1.0.0
         */
        uploader.bind('Error', function( up, err ) {
            document.getElementById('errors-log').innerHTML += "<br/>" + "Error #" + err.code + ": " + err.message;
        });


        /**
         * If files are uploaded successfully.
         *
         * @since 1.0.0
         */
        uploader.bind('FileUploaded', function ( up, file, ajax_response ) {
            var response = $.parseJSON( ajax_response.response );

            if ( response.success ) {

                var profileThumbHTML = '<img src="' + response.url + '" alt="" />' +
                    '<input type="hidden" class="profile-image-id" name="profile-image-id" value="' + response.attachment_id + '"/>';

                document.getElementById( "holder-" + file.id ).innerHTML = profileThumbHTML;

            } else {
                // log response object
                console.log ( response );
            }
        });

        $('#remove-profile-image').on( 'click', function(event){
            event.preventDefault();
            document.getElementById('user-profile-img').innerHTML = '<div class="profile-thumb"></div>';
        });

        /* Check if IE9 - As image upload does not works in ie9 */
        var ie = ( function() {

            var undef,
                v   = 3,
                div = document.createElement('div'),
                all = div.getElementsByTagName('i');

            while (
                div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
                    all[0]
                );

            return v > 4 ? v : undef;

        } () );

        if ( ie <= 9 ) {
            $('#inspiry-edit-user').before( '<div class="ie9-message"><i class="fa fa-info-circle"></i>&nbsp; <strong>Current browser is not fully supported:</strong> Please update your browser or use a different one to enjoy all features on this page. </div>' );
        }

    }   // validate localized data.

});
