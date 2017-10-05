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

