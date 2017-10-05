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
