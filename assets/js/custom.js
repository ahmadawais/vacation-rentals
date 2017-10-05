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

jQuery(document).ready(function($) {

    "use strict";

    if ( typeof propertySubmit !== "undefined" ) {

        var ajaxURL       = propertySubmit.ajaxURL;
        var uploadNonce   = propertySubmit.uploadNonce;
        var fileTypeTitle = propertySubmit.fileTypeTitle;

        /* Apply jquery ui sortable on gallery items */
        $( "#gallery-thumbs-container" ).sortable({
            revert     : 100,
            placeholder: "sortable-placeholder",
            cursor     : "move"
        });

        /* initialize uploader */
        var uploader = new plupload.Uploader({
            browse_button : 'select-images',          // this can be an id of a DOM element or the DOM element itself
            file_data_name: 'inspiry_upload_file',
            container     : 'plupload-container',
            drop_element  : 'drag-and-drop',
            url           : ajaxURL + "?action=ajax_img_upload&nonce=" + uploadNonce,
            filters       : {
                mime_types : [
                    { title : fileTypeTitle, extensions : "jpg,jpeg,gif,png" }
                ],
                max_file_size: '10000kb',
                prevent_duplicates: true
            }
        });
        uploader.init();


        /* Run after adding file */
        uploader.bind('FilesAdded', function(up, files) {
            var html = '';
            var galleryThumb = "";
            plupload.each(files, function(file) {
                galleryThumb += '<div id="holder-' + file.id + '" class="gallery-thumb">' + '' + '</div>';
            });
            document.getElementById('gallery-thumbs-container').innerHTML += galleryThumb;
            up.refresh();
            uploader.start();
        });


        /* Run during upload */
        uploader.bind('UploadProgress', function(up, file) {
            document.getElementById( "holder-" + file.id ).innerHTML = '<span>' + file.percent + "%</span>";
        });


        /* In case of error */
        uploader.bind('Error', function( up, err ) {
            document.getElementById('errors-log').innerHTML += "<br/>" + "Error #" + err.code + ": " + err.message;
        });


        /* If files are uploaded successfully */
        uploader.bind('FileUploaded', function ( up, file, ajax_response ) {
            var response = $.parseJSON( ajax_response.response );

            if ( response.success ) {

                var galleryThumbHtml = '<img src="' + response.url + '" alt="" />' +
                    '<a class="remove-image" data-property-id="' + 0 + '"  data-attachment-id="' + response.attachment_id + '" href="#remove-image" ><i class="fa fa-trash-o"></i></a>' +
                    '<a class="mark-featured" data-property-id="' + 0 + '"  data-attachment-id="' + response.attachment_id + '" href="#mark-featured" ><i class="fa fa-star-o"></i></a>' +
                    '<input type="hidden" class="gallery-image-id" name="gallery_image_ids[]" value="' + response.attachment_id + '"/>' +
                    '<span class="loader"><i class="fa fa-spinner fa-spin"></i></span>';

                document.getElementById( "holder-" + file.id ).innerHTML = galleryThumbHtml;

                bindThumbnailEvents();  // bind click event with newly added gallery thumb
            } else {
                // log response object
                console.log ( response );
            }
        });

        /* Bind thumbnails events with newly added gallery thumbs */
        var bindThumbnailEvents = function () {

            // unbind previous events
            $('a.remove-image').unbind('click');
            $('a.mark-featured').unbind('click');

            // Mark as featured
            $('a.mark-featured').on( 'click', function(event){

                event.preventDefault();

                var $this = $( this );
                var starIcon = $this.find( 'i');

                if ( starIcon.hasClass( 'fa-star-o' ) ) {   // if not already featured

                    $('.gallery-thumb .featured-img-id').remove();      // remove featured image id field from all the gallery thumbs
                    $('.gallery-thumb .mark-featured i').removeClass( 'fa-star').addClass( 'fa-star-o' );   // replace any full star with empty star

                    var $this = $( this );
                    var input = $this.siblings( '.gallery-image-id' );      //  get the gallery image id field in current gallery thumb
                    var featured_input = input.clone().removeClass( 'gallery-image-id' ).addClass( 'featured-img-id' ).attr( 'name', 'featured_image_id' );     // duplicate, remove class, add class and rename to full fill featured image id needs

                    $this.closest( '.gallery-thumb' ).append( featured_input );     // append the cloned ( featured image id ) input to current gallery thumb
                    starIcon.removeClass( 'fa-star-o' ).addClass( 'fa-star' );      // replace empty star with full star

                }

            }); // end of mark as featured click event


            // Remove gallery images
            $('a.remove-image').on( 'click', function(event){

                event.preventDefault();
                var $this = $(this);
                var gallery_thumb = $this.closest('.gallery-thumb');
                var loader = $this.siblings('.loader');

                loader.show();

                var removal_request = $.ajax({
                    url: ajaxURL,
                    type: "POST",
                    data: {
                        property_id : $this.data('property-id'),
                        attachment_id : $this.data('attachment-id'),
                        action : "remove_gallery_image",
                        nonce : uploadNonce
                    },
                    dataType: "html"
                });

                removal_request.done(function( response ) {
                    var result = $.parseJSON( response );
                    if( result.attachment_removed ){
                        gallery_thumb.remove();
                    } else {
                        document.getElementById('errors-log').innerHTML += "<br/>" + "Error : Failed to remove attachment";
                    }
                });

                removal_request.fail(function( jqXHR, textStatus ) {
                    alert( "Request failed: " + textStatus );
                });

            });  // end of remove gallery thumb click event

        };  // end of bind thumbnail events

        bindThumbnailEvents(); // run it first time - required for property edit page

    }   // validate localized data


    /* Google Map */
    var mapField = {};

    (function(){

        var thisMapField = this;

        this.container = null;
        this.canvas = null;
        this.latlng = null;
        this.map = null;
        this.marker = null;
        this.geocoder = null;

        this.init = function($container){
            this.container = $container;
            this.canvas = $container.find('.map-canvas');
            this.initLatLng( 53.346881, -6.258860 );
            this.initMap();
            this.initMarker();
            this.initGeocoder();
            this.initMarkerPosition();
            this.initListeners();
            this.initAutoComplete();
            this.bindHandlers();
        }

        this.initLatLng = function($lat, $lng){
            this.latlng = new window.google.maps.LatLng($lat, $lng);
        }

        this.initMap = function(){
            this.map = new window.google.maps.Map(this.canvas[0], {
                zoom: 8,
                center: this.latlng,
                streetViewControl: 0,
                mapTypeId: window.google.maps.MapTypeId.ROADMAP
            });
        }

        this.initMarker = function(){
            this.marker = new window.google.maps.Marker({position: this.latlng, map: this.map, draggable: true});
        }

        this.initMarkerPosition = function(){
            var coord = this.container.find('.map-coordinate').val();
            var addressField = this.container.find('.goto-address-button').val();
            var l;
            var zoom;

            if (coord){
                l = coord.split( ',' );
                this.marker.setPosition( new window.google.maps.LatLng( l[0], l[1] ) );

                zoom = l.length > 2 ? parseInt( l[2], 10 ) : 15;

                this.map.setCenter(this.marker.position);
                this.map.setZoom(zoom);
            } else if (addressField) {
                this.geocodeAddress(addressField);
            }
        }

        this.initGeocoder = function(){
            this.geocoder = new window.google.maps.Geocoder();
        }

        this.initListeners = function(){
            var that = thisMapField;
            window.google.maps.event.addListener(this.map, 'click', function (event)
            {
                that.marker.setPosition(event.latLng);
                that.updatePositionInput(event.latLng);
            });
            window.google.maps.event.addListener(this.marker, 'drag', function (event)
            {
                that.updatePositionInput(event.latLng);
            });
        }

        this.updatePositionInput = function(latLng){
            this.container.find('.map-coordinate').val(latLng.lat() + ',' + latLng.lng());
        }

        this.geocodeAddress = function(addressField){
            var address = '';
            var fieldList = addressField.split(',');
            var loop;

            for (loop = 0; loop < fieldList.length; loop++)
            {
                address += jQuery('#' + fieldList[loop] ).val();
                if(loop+1 < fieldList.length) {  address += ', '; }
            }

            address = address.replace( /\n/g, ',' );
            address = address.replace( /,,/g, ',' );

            var that = thisMapField;
            this.geocoder.geocode({'address': address}, function (results, status)
            {
                if ( status == window.google.maps.GeocoderStatus.OK )
                {
                    that.updatePositionInput(results[0].geometry.location);
                    that.marker.setPosition(results[0].geometry.location);
                    that.map.setCenter(that.marker.position);
                    that.map.setZoom(15);
                }
            });
        }

        this.initAutoComplete = function(){
            var addressField = this.container.find('.goto-address-button').val();
            if (!addressField) return null;

            var that = thisMapField;
            $('#' + addressField).autocomplete({
                source: function(request, response) {
                    // TODO: add 'region' option
                    that.geocoder.geocode( {'address': request.term }, function(results, status) {
                        response($.map(results, function(item) {
                            return {
                                label: item.formatted_address,
                                value: item.formatted_address,
                                latitude: item.geometry.location.lat(),
                                longitude: item.geometry.location.lng()
                            };
                        }));
                    });
                },
                select: function(event, ui) {
                    that.container.find(".map-coordinate").val(ui.item.latitude + ',' + ui.item.longitude );
                    var location = new window.google.maps.LatLng(ui.item.latitude, ui.item.longitude);
                    that.map.setCenter(location);
                    // Drop the Marker
                    setTimeout(function(){
                        that.marker.setValues({
                            position: location,
                            animation: window.google.maps.Animation.DROP
                        });
                    }, 1500);
                }
            });
        }

        this.bindHandlers = function(){
            var that = thisMapField;
            this.container.find('.goto-address-button').on('click', function() { that.onFindAddressClick($(this)); });
        }

        this.onFindAddressClick = function($that){
            var $this = $that;
            this.geocodeAddress($this.val());
        }

    }).apply( mapField );

    $('.map-wrapper').each(function(){
        mapField.init($(this));
    });


    /* Validate Submit Property Form */
    if( jQuery().validate ){
        $('#submit-property-form').validate({
            rules: {
                bedrooms: {
                    number: true
                },
                bathrooms: {
                    number: true
                },
                garages: {
                    number: true
                },
                price: {
                    number: true
                },
                size: {
                    number: true
                }
            }
        });
    }

    /* Apply jquery ui sortable on additional details */
    $( "#inspiry-additional-details-container" ).sortable({
        revert: 100,
        placeholder: "detail-placeholder",
        handle: ".sort-detail",
        cursor: "move"
    });

    $( '.add-detail' ).on( 'click', function( event ){
        event.preventDefault();
        var newInspiryDetail = '<div class="inspiry-detail inputs clearfix">' +
            '<div class="inspiry-detail-control"><span class="sort-detail fa fa-bars"></span></div>' +
            '<div class="inspiry-detail-title"><input type="text" name="detail-titles[]" /></div>' +
            '<div class="inspiry-detail-value"><input type="text" name="detail-values[]" /></div>' +
            '<div class="inspiry-detail-control"><a class="remove-detail" href="#"><span class="fa fa-times"></span></a></div>' +
            '</div>';

        $( '#inspiry-additional-details-container').append( newInspiryDetail );
        bindAdditionalDetailsEvents();
    });

    function bindAdditionalDetailsEvents(){

        /* Bind click event to remove detail icon button */
        $( '.remove-detail').on( 'click', function( event ){
            event.preventDefault();
            var $this = $( this );
            $this.closest( '.inspiry-detail' ).remove();
        });

    }
    bindAdditionalDetailsEvents();

    /* Check if IE9 - As image upload not works in ie9 */
    var ie = (function(){

        var undef,
            v = 3,
            div = document.createElement('div'),
            all = div.getElementsByTagName('i');

        while (
            div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
                all[0]
            );

        return v > 4 ? v : undef;

    }());

    if ( ie <= 9 ) {
        $('#submit-property-form').before( '<div class="ie9-message"><i class="fa fa-info-circle"></i>&nbsp; <strong>Current browser is not fully supported:</strong> Please update your browser or use a different one to enjoy all features on this page. </div>' );
    }

});

/**
 * JavaScript Related to Favorites
 *
 * @since 1.0.0
 * @package VRC
 */
( function( $ ) {
    "use strict";

    // console.log( 'Outside if' );

    /**
     * Add to favorites.
     *
     * @since  1.0.0
     */
    if ( typeof favoriteData !== "undefined" ) {

        // console.log( 'Inside if' );

        $( '.vr_add_to_favorites' ).on( 'click', function( e ) {

            // console.log( 'Clicked Heart!' );

            // No click. Nada.
            e.preventDefault();

            // This element.
            var $this = $( this );
            // console.log($this)

            // The Rental ID.
            var the_rental_id_fav_custom = $this.data( 'rentalid' )
            // console.log( "Custom rental ID:", the_rental_id_fav_custom);

            // User ID who favorited.
            var the_user_id_fav = favoriteData.userID;
            // console.log( "User ID:", the_user_id_fav);

            // User ID who favorited.
            var the_rental_id_fav = favoriteData.rentalID;
            // console.log( "Rental ID:", the_rental_id_fav);


            if ( ! $this.hasClass( 'vr_hearted' ) ) {

                // var star = $this.find( 'i' );
                // var favoriteTitle = $this.find( 'span' );

                var addToFavorite = $.ajax({
                    url: favoriteData.ajaxURL,
                    method: "POST",
                    data: {
                        user_id  : the_user_id_fav,
                        rental_id: the_rental_id_fav_custom,
                        action   : favoriteData.action
                    },
                    dataType: "json",
                    // beforeSend: function( xhr ) {
                    //     star.addClass('fa-spin');
                    // }
                });
                // console.log('POST req sent. the ID was ', the_rental_id_fav_custom);


                addToFavorite.done( function( response ) {
                    // star.removeClass('fa-spin');
                    if ( response.success ) {
                        // console.log('Success');
                        $this.addClass( 'vr_hearted vr_hearted_single' );
                        // star.removeClass( 'fa-star-o').addClass( 'fa-star' );
                        // favoriteTitle.removeClass( 'failed' );
                        // favoriteTitle.html( response.message );
                    } else {
                        var msg = response.message;
                        // console.log('Failed', msg);
                        // favoriteTitle.addClass('failed');
                        // favoriteTitle.html( response.message );
                    }
                });

                addToFavorite.fail( function( jqXHR, textStatus ) {
                    // console.log('Request Failed');
                    // alert( "Request Failed: " + textStatus );
                });
            }

            // console.log('Already favorited!')
        });

    } else {
        // console.log( 'The typeof favoriteData is undefined.' );
    }


    /**
     * Remove from favorites.
     *
     * @since  1.0.0
     */
    $( '.vr_remove_from_favorites' ).on( 'click', function( event ) {

        // console.log('Clicked Remove!')

        // No click. Nada.
        event.preventDefault();

        // This element.
        var $this = $( this );
        // console.log($this)

        // AJAX URL.
        var ajaxURL = $this.attr( 'href' );

        // Rental ID.
        var the_rental_id_fav_remove = $this.data( 'rentalid' );

        var rental_card = $this.closest('.vr_list');
        // console.log('Card:', rental_card);
        // var loader = $this.siblings('.loader');

        var removeFromFavorites = $.ajax({
            url: ajaxURL,
            type: "POST",
            data: {
                rental_id : the_rental_id_fav_remove,
                action : "remove_from_favorites_action"
            },
            dataType: "json",
            beforeSend: function( xhr ) {
                $this.hide();
                // loader.css('display', 'block');
            }
        });

        // console.log('POST req sent. the ID was ', the_rental_id_fav_remove);

        removeFromFavorites.done( function( response ) {
            if ( response.success ) {
                // console.log('Removed!')
                rental_card.remove();
            } else {
                // console.log('Not Removed!')
                loader.hide();
                // alert( response.message );
            }
        });

        removeFromFavorites.fail( function( jqXHR, textStatus ) {
            // console.log('Request failed')
            // alert( "Request Failed: " + textStatus );
        });

    });

})(jQuery);

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

/**
 * Submit Booking JS
 *
 * Submit booking related JS.
 *
 * @since   1.0.0
 * @package VRC
 */
( function($) {
  jQuery(document).ready(function($) {

      "use strict";

      /**
       * jQuery DatePicker.
       *
       * @since  1.0.0
       */
      $(function() {
          $( "#vr_booking_date_checkin" ).datepicker({
            defaultDate: "+1w",
            dateFormat:'yy-mm-dd',
            numberOfMonths: 1,
            'autoSize':true,
            onClose: function( selectedDate ) {
              $( "#vr_booking_date_checkout" ).datepicker( "option", "minDate", selectedDate );
            }
          });
          $( "#vr_booking_date_checkout" ).datepicker({
            defaultDate: "+1w",
            dateFormat:'yy-mm-dd',
            numberOfMonths: 1,
            'autoSize':true,
            onClose: function( selectedDate ) {
              $( "#vr_booking_date_checkin" ).datepicker( "option", "maxDate", selectedDate );
            }
          });

        });


      /**
       * AJAX Handler & Validator.
       *
       * Uses jQuery Form and Validate Plugins.
       *
       * @since  1.0.0
       */
      if ( typeof submitBooking !== "undefined" ) {

          var ajaxURL       = submitBooking.ajaxURL;
          var uploadNonce   = submitBooking.uploadNonce;
          var fileTypeTitle = submitBooking.fileTypeTitle;

          /**
           * Validate Submit Booking Form.
           *
           * @since 1.0.0
           */
          if ( jQuery().validate && jQuery().ajaxSubmit ) {

              var form_loader      = $( '#ajax-loader' );
              var form_message     = $( '#form-message' );
              var form_bookingid   = $( '#form-bookingid' );
              var errors_container = $( '#form-errors' );

              // No loader vr_booking_date_checkout begin with.
              form_loader.fadeOut();


              // Submit Booking Form.
              var submit_booking_form_options = {
                  url         : submitBooking.ajaxURL,
                  type        : 'post',
                  dataType    : 'json',
                  timeout     : 30000,
                  beforeSubmit: function( formData, jqForm, options ){
                      form_loader.removeClass( 'vr_dn' );
                      form_loader.fadeIn();
                      form_message.empty().fadeOut();
                      errors_container.empty().fadeOut();

                      // console.log( formData );
                  },
                  success: function( response, status, xhr, $form ){

                      // console.log( response );

                      form_loader.fadeOut();
                      if ( response.success ) {
                          // Reset the form.
                          document.getElementById('vr-submit-booking').reset();
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
              }; // submit_booking_form_options ended.

              $( '#vr-submit-booking' ).validate({
                  rules: {
                      booking_title: {
                          required: false
                      }
                  },
                  submitHandler: function( form ) {
                      $( form ).ajaxSubmit( submit_booking_form_options );
                  }
              });
          } // Validate Submit Booking Form ended.

      } else {
        console.log('typeof submitBooking is undefined');
      }// AJAX Handler & Validator ended.

  });
} ) ( jQuery );


/**
 * Submit Post JS
 *
 * Submit post related JS.
 *
 * @since   1.0.0
 * @package VRC
 */
jQuery(document).ready(function($) {

    "use strict";

    if ( typeof submitPost !== "undefined" ) {

        var ajaxURL       = submitPost.ajaxURL;
        var uploadNonce   = submitPost.uploadNonce;
        var fileTypeTitle = submitPost.fileTypeTitle;

        /**
         * Validate Submit Post Form.
         *
         * @since 1.0.0
         */
        if ( jQuery().validate && jQuery().ajaxSubmit ) {

            var form_loader      = $( '#ajax-loader' );
            var form_message     = $( '#form-message' );
            var form_postid    = $( '#form-postid' );
            var errors_container = $( '#form-errors' );

            // No loader to begin with.
            form_loader.fadeOut();


            // Submit Post Form.
            var submit_post_form_options = {
                url         : submitPost.ajaxURL,
                type        : 'post',
                dataType    : 'json',
                timeout     : 30000,
                beforeSubmit: function( formData, jqForm, options ){
                    form_loader.fadeIn();
                    form_message.empty().fadeOut();
                    errors_container.empty().fadeOut();
                },
                success: function( response, status, xhr, $form ){
                    form_loader.fadeOut();
                    if ( response.success ) {
                        form_message.html( response.message).fadeIn();
                        form_postid.html( response.the_submit_post_id).fadeIn();
                    } else {
                        for ( var i=0; i < response.errors.length; i++ ) {
                            errors_container.append( '<li>' + response.errors[i] + '</li>' );
                        }
                        errors_container.fadeIn();
                    }
                }
            };

            $( '#vr-submit-post' ).validate({
                rules: {
                    post_title: {
                        required: true
                    }
                },
                submitHandler: function( form ) {
                    $( form ).ajaxSubmit( submit_post_form_options );
                }
            });
        }

        // /**
        //  * Initialize uploader.
        //  *
        //  * @since 1.0.0
        //  */
        // var uploader = new plupload.Uploader({

        //     // This can be an id of a DOM element or the DOM element itself.
        //     browse_button  : 'select-profile-image',

        //      // Used in `upload_profile_image()` Line# 262.
        //     file_data_name : 'vr_upload_file_name',
        //     container      : 'plupload-container',
        //     multi_selection: false,

        //     // This action is used for `add_action` in `member-init.php`.
        //     url            : ajaxURL + "?action=vr_profile_image_upload&nonce=" + uploadNonce,
        //     filters: {
        //         mime_types : [
        //             { title : fileTypeTitle, extensions : "jpg,jpeg,gif,png" }
        //         ],
        //         max_file_size: '2000kb',
        //         prevent_duplicates: true
        //     }
        // });
        // uploader.init();


        // /**
        //  * Run after adding file.
        //  *
        //  * @since 1.0.0
        //  */
        // uploader.bind('FilesAdded', function(up, files) {
        //     var html = '';
        //     var profileThumb = "";
        //     plupload.each(files, function(file) {
        //         profileThumb += '<div id="holder-' + file.id + '" class="profile-thumb">' + '' + '</div>';
        //     });
        //     document.getElementById('user-profile-img').innerHTML = profileThumb;
        //     up.refresh();
        //     uploader.start();
        // });


        // *
        //  * Run during upload.
        //  *
        //  * @since 1.0.0

        // uploader.bind('UploadProgress', function(up, file) {
        //     document.getElementById( "holder-" + file.id ).innerHTML = '<span>' + file.percent + "%</span>";
        // });


        // /**
        //  * In case of error.
        //  *
        //  * @since 1.0.0
        //  */
        // uploader.bind('Error', function( up, err ) {
        //     document.getElementById('errors-log').innerHTML += "<br/>" + "Error #" + err.code + ": " + err.message;
        // });


        // /**
        //  * If files are uploaded successfully.
        //  *
        //  * @since 1.0.0
        //  */
        // uploader.bind('FileUploaded', function ( up, file, ajax_response ) {
        //     var response = $.parseJSON( ajax_response.response );

        //     if ( response.success ) {

        //         var profileThumbHTML = '<img src="' + response.url + '" alt="" />' +
        //             '<input type="hidden" class="profile-image-id" name="profile-image-id" value="' + response.attachment_id + '"/>';

        //         document.getElementById( "holder-" + file.id ).innerHTML = profileThumbHTML;

        //     } else {
        //         // log response object
        //         console.log ( response );
        //     }
        // });

        // $('#remove-profile-image').on( 'click', function(event){
        //     event.preventDefault();
        //     document.getElementById('user-profile-img').innerHTML = '<div class="profile-thumb"></div>';
        // });

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
