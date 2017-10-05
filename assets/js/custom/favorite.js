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
