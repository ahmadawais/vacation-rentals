<?php
/**
 * View: Rental edit
 *
 * VR rental edit view.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php
/*
 *  Edit Property Form
 */

global $inspiry_options;
$edit_property_id = intval( trim( $_GET['edit_property'] ) );
$target_property = get_post( $edit_property_id );

// check if passed id is a proper property post */
if ( !empty( $target_property ) && ( $target_property->post_type == 'property' ) ) {

    // Check Author
    global $current_user;
    get_currentuserinfo();

    // check if current user is the author of property
    if ( $target_property->post_author == $current_user->ID ) {

        $property_meta = get_post_custom( $target_property->ID );
        ?>
        <form id="submit-property-form" class="submit-form" enctype="multipart/form-data" method="post">


            <div class="row">

                <div class="col-md-6">

                    <div class="form-option">
                        <label for="inspiry_property_title"><?php _e('Property Title', 'inspiry'); ?></label>
                        <input id="inspiry_property_title" name="inspiry_property_title" type="text" class="required" value="<?php echo esc_attr( $target_property->post_title ); ?>" title="<?php _e('* Please provide property title!', 'inspiry'); ?>" autofocus required/>
                    </div>

                    <div class="form-option">
                        <label for="description"><?php _e('Property Description', 'inspiry'); ?></label>
                        <textarea name="description" id="description" cols="30" rows="5"><?php echo esc_textarea( $target_property->post_content ); ?></textarea>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-option">
                        <?php
                        $property_address = "";
                        if ( isset( $property_meta['REAL_HOMES_property_address'] ) && ! empty ( $property_meta['REAL_HOMES_property_address'][0] ) ) {
                            $property_address = $property_meta['REAL_HOMES_property_address'][0];
                        } else {
                            $property_address = $inspiry_options[ 'inspiry_submit_address' ];
                        }

                        $property_location = "";
                        if ( isset( $property_meta['REAL_HOMES_property_location'] ) && ! empty ( $property_meta['REAL_HOMES_property_location'][0] ) ) {
                            $property_location = $property_meta['REAL_HOMES_property_location'][0];
                        } else {
                            $property_location = $inspiry_options[ 'inspiry_submit_location_coordinates' ];
                        }
                        ?>
                        <label for="address"><?php _e('Address', 'inspiry'); ?></label>
                        <input type="text" class="required" name="address" id="address" value="<?php echo esc_attr( $property_address ); ?>" title="<?php _e( '* Please provide a property address!', 'inspiry'); ?>" required/>
                        <div class="map-wrapper">
                            <button class="btn-default goto-address-button" type="button" value="address"><?php _e('Find Address', 'inspiry'); ?></button>
                            <div class="map-canvas"></div>
                            <input type="hidden" name="location" class="map-coordinate" value="<?php echo esc_attr( $property_location ); ?>" />
                        </div>
                    </div>

                </div>

            </div>
            <!-- .row -->

            <div class="row">

                <div class="col-md-4">
                    <div class="form-option">
                        <label for="type"><?php _e('Type', 'inspiry'); ?></label>
                        <select name="type" id="type" class="search-select">
                            <?php inspiry_hierarchical_edit_options( $target_property->ID, 'property-type' ); ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-option">
                        <label for="city"><?php _e('Location', 'inspiry'); ?></label>
                        <select name="city" id="city" class="search-select">
                            <?php inspiry_hierarchical_edit_options( $target_property->ID, 'property-city' ); ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-option">
                        <label for="status"><?php _e('Status', 'inspiry'); ?></label>
                        <select name="status" id="status" class="search-select">
                            <?php inspiry_hierarchical_edit_options( $target_property->ID, 'property-status' ); ?>
                        </select>
                    </div>
                </div>

            </div>
            <!-- .row -->

            <div class="row">

                <div class="col-md-4">
                    <div class="form-option">
                        <label for="bedrooms"><?php _e('Bedrooms', 'inspiry'); ?></label>
                        <input id="bedrooms" name="bedrooms" type="text" value="<?php if( isset( $property_meta['REAL_HOMES_property_bedrooms'] ) ) { echo esc_attr( $property_meta[ 'REAL_HOMES_property_bedrooms' ][0] ); } ?>" title="<?php _e('* Only numbers allowed!', 'inspiry'); ?>"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-option">
                        <label for="bathrooms"><?php _e('Bathrooms', 'inspiry'); ?></label>
                        <input id="bathrooms" name="bathrooms" type="text" value="<?php if( isset( $property_meta['REAL_HOMES_property_bathrooms'] ) ) { echo esc_attr( $property_meta[ 'REAL_HOMES_property_bathrooms' ][0] ); } ?>" title="<?php _e('* Only numbers allowed!', 'inspiry'); ?>"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-option">
                        <label for="garages"><?php _e('Garages', 'inspiry'); ?></label>
                        <input id="garages" name="garages" type="text" value="<?php if( isset( $property_meta['REAL_HOMES_property_garage'] ) ) { echo esc_attr( $property_meta['REAL_HOMES_property_garage'][0] ); } ?>" title="<?php _e('* Only numbers allowed!', 'inspiry'); ?>"/>
                    </div>
                </div>

            </div>
            <!-- .row -->

            <div class="row">

                <div class="col-md-4">
                    <div class="form-option">
                        <label for="price"><?php _e('Sale OR Rent Price', 'inspiry'); ?></label>
                        <input id="price" name="price" type="text" value="<?php if( isset( $property_meta['REAL_HOMES_property_price'] ) ) { echo esc_attr( $property_meta['REAL_HOMES_property_price'][0] ); } ?>" title="<?php _e('* Only numbers allowed!', 'inspiry'); ?>"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-option">
                        <label for="price-postfix"><?php _e('Price Postfix Text', 'inspiry'); ?></label>
                        <input id="price-postfix" name="price-postfix" type="text"  value="<?php if( isset( $property_meta['REAL_HOMES_property_price_postfix'] ) ) { echo esc_attr( $property_meta['REAL_HOMES_property_price_postfix'][0] ); } ?>" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-option">
                        <label for="size"><?php _e( 'Area', 'inspiry' ); ?></label>
                        <input id="size" name="size" type="text" value="<?php if( isset( $property_meta['REAL_HOMES_property_size'] ) ) { echo esc_attr( $property_meta['REAL_HOMES_property_size'][0] ); } ?>" title="<?php _e('* Only numbers allowed!', 'inspiry'); ?>"/>
                    </div>
                </div>

            </div>
            <!-- .row -->

            <div class="row">

                <div class="col-md-4">
                    <div class="form-option">
                        <label for="area-postfix"><?php _e('Area Postfix Text', 'inspiry'); ?></label>
                        <input id="area-postfix" name="area-postfix" type="text"  value="<?php if( isset( $property_meta['REAL_HOMES_property_size_postfix'] ) ) { echo esc_attr( $property_meta['REAL_HOMES_property_size_postfix'][0] ); } ?>" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-option">
                        <label for="property-id"><?php _e('Property ID', 'inspiry'); ?></label>
                        <input id="property-id" name="property-id" type="text"  value="<?php if( isset( $property_meta['REAL_HOMES_property_id'] ) ) { echo esc_attr( $property_meta['REAL_HOMES_property_id'][0] ); } ?>" title="<?php _e('Property ID', 'inspiry'); ?>"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-option">
                        <label for="video-url"><?php _e('Virtual Tour Video URL', 'inspiry'); ?></label>
                        <input id="video-url" name="video-url" type="text" value="<?php if( isset( $property_meta['REAL_HOMES_tour_video_url'] ) ) { echo esc_attr( $property_meta['REAL_HOMES_tour_video_url'][0] ); } ?>" />
                    </div>
                </div>

            </div>
            <!-- .row -->

            <div class="row container-row">

                <div class="col-lg-6">

                    <div class="form-option">
                        <div id="gallery-thumbs-container" class="clearfix">
                            <?php
                            $thumbnail_size = 'thumbnail';
                            $properties_images = rwmb_meta( 'REAL_HOMES_property_images', 'type=plupload_image&size='.$thumbnail_size, $target_property->ID );
                            $featured_image_id = get_post_thumbnail_id( $target_property->ID );
                            if( !empty( $properties_images ) ){
                                foreach( $properties_images as $prop_image_id => $prop_image_meta ) {
                                    $is_featured_image =  ( $featured_image_id == $prop_image_id );
                                    $featured_icon = ( $is_featured_image ) ? 'fa-star' : 'fa-star-o';
                                    echo '<div class="gallery-thumb">';
                                    echo '<img src="'.$prop_image_meta['url'].'" alt="'.$prop_image_meta['title'].'" />';
                                    echo '<a class="remove-image" data-property-id="'.$target_property->ID.'" data-attachment-id="' . $prop_image_id . '" href="#remove-image" ><i class="fa fa-trash-o"></i></a>';
                                    echo '<a class="mark-featured" data-property-id="'.$target_property->ID.'" data-attachment-id="' . $prop_image_id . '" href="#mark-featured" ><i class="fa '. $featured_icon . '"></i></a>';
                                    echo '<span class="loader"><i class="fa fa-spinner fa-spin"></i></span>';
                                    echo '<input type="hidden" class="gallery-image-id" name="gallery_image_ids[]" value="' . $prop_image_id . '"/>';
                                    if ( $is_featured_image ) {
                                        echo '<input type="hidden" class="featured-img-id" name="featured_image_id" value="' . $prop_image_id . '"/>';
                                    }
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                        <div id="drag-and-drop">
                            <div class="drag-drop-msg text-center">
                                <i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;<?php _e('Drag and drop images here', 'inspiry'); ?>
                                <br/>
                                <span class="drag-or"><?php _e('OR', 'inspiry'); ?></span>
                                <br/>
                                <a id="select-images" class="drag-btn btn-default btn-orange" href="javascript:;"><?php _e('Select Images', 'inspiry'); ?></a>
                            </div>
                        </div>

                        <ul class="field-description list-unstyled">
                            <li><span>*</span><?php _e('An image should have minimum width of 850px and minimum height of 600px.', 'inspiry'); ?></li>
                            <li><span>*</span><?php _e('You can mark an image as featured by clicking the star icon, Otherwise first image will be considered featured image.', 'inspiry'); ?></li>
                        </ul>
                        <div id="plupload-container"></div>
                        <div id="errors-log"></div>
                    </div>

                </div>

                <div class="col-lg-6">
                    <div class="form-option">
                        <label class="fancy-title"><?php _e('What to display in agent information box ?', 'inspiry'); ?></label>
                        <ul class="agent-options list-unstyled">

                            <li>
                                <span class="radio-field">
                                    <input id="agent_option_none" type="radio" name="agent_display_option" value="none" <?php if( isset( $property_meta['REAL_HOMES_agent_display_option'] ) && ( $property_meta['REAL_HOMES_agent_display_option'][0] == "none" ) ) { echo "checked"; } ?> />
                                    <label for="agent_option_none"><?php _e('None', 'inspiry'); ?></label>
                                </span>
                                <small><?php _e('( Agent information box will not be displayed )', 'inspiry'); ?></small>
                            </li>

                            <li>
                                <span class="radio-field">
                                    <input id="agent_option_profile" type="radio" name="agent_display_option" value="my_profile_info" <?php if( isset( $property_meta['REAL_HOMES_agent_display_option'] ) && ( $property_meta['REAL_HOMES_agent_display_option'][0] == "my_profile_info" ) ) { echo "checked"; } ?> />
                                    <label for="agent_option_profile"><?php _e('My Profile Information', 'inspiry'); ?></label>
                                </span>
                                <?php
                                if( !empty( $inspiry_options[ 'inspiry_edit_profile_page' ] ) ) {
                                    $edit_profile_url = get_permalink( $inspiry_options[ 'inspiry_edit_profile_page' ] );
                                    if ( !empty( $edit_profile_url ) ) {
                                        ?>
                                        <small>
                                            <a href="<?php echo esc_url( $edit_profile_url ); ?>" target="_blank"><?php _e('( Edit Profile Information )', 'inspiry'); ?></a>
                                        </small>
                                        <?php
                                    }
                                }
                                ?>
                            </li>

                            <li>
                                <span class="radio-field">
                                    <input id="agent_option_agent" type="radio" name="agent_display_option" value="agent_info" <?php if( isset( $property_meta['REAL_HOMES_agent_display_option'] ) && ( $property_meta['REAL_HOMES_agent_display_option'][0] == "agent_info" ) ) { echo "checked"; } ?> />
                                    <label for="agent_option_agent"><?php _e( 'Display Agent Information', 'inspiry' ); ?></label>
                                </span>
                                <select name="agent_id" id="agent-selectbox">
                                    <?php
                                    if ( isset( $property_meta['REAL_HOMES_agents'] ) ) {
                                        inspiry_generate_cpt_options( 'agent', $property_meta['REAL_HOMES_agents'][0] );
                                    } else {
                                        inspiry_generate_cpt_options( 'agent' );
                                    }
                                    ?>
                                </select>
                            </li>

                        </ul>

                    </div>

                    <div class="form-option checkbox-option clearfix">
                        <input id="featured" name="featured" type="checkbox" <?php if( isset( $property_meta['REAL_HOMES_featured'] ) && ( $property_meta['REAL_HOMES_featured'][0] == 1 ) ) { echo 'checked'; } ?> />
                        <label for="featured"><?php _e('Mark this property as featured property', 'inspiry'); ?></label>
                    </div>
                </div>

            </div>
            <!-- .row -->

            <div class="row container-row">

                <div class="col-lg-6">
                    <div class="form-option">
                        <label class="fancy-title"><?php _e('Features', 'inspiry'); ?></label>
                        <ul class="features-checkboxes-wrapper list-unstyled clearfix">
                            <?php
                            // Property Features
                            $property_features = get_the_terms( $target_property->ID, "property-feature" );
                            $property_features_ids = array();
                            if ( !empty( $property_features ) && !is_wp_error( $property_features ) ) {
                                foreach( $property_features as $feature ) {
                                    $property_features_ids[] = $feature->term_id;
                                }
                            }

                            // All Features
                            $all_features = get_terms(
                                array(
                                    "property-feature"
                                ),
                                array(
                                    'orderby'       => 'name',
                                    'order'         => 'ASC',
                                    'hide_empty'    => false,
                                )
                            );

                            if ( !empty( $all_features ) && !is_wp_error( $all_features ) ) {
                                foreach ( $all_features as $feature ) {
                                    echo '<li><span class="option-set">';
                                    if( in_array( $feature->term_id, $property_features_ids ) ){
                                        echo '<input type="checkbox" name="features[]" id="feature-' . $feature->term_id . '" value="' . $feature->term_id . '" checked />';
                                    }else{
                                        echo '<input type="checkbox" name="features[]" id="feature-' . $feature->term_id . '" value="' . $feature->term_id . '" />';
                                    }
                                    echo '<label for="feature-' . $feature->term_id . '">' . $feature->name . '</label>';
                                    echo '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">

                    <div class="form-option">

                        <div class="inspiry-details-wrapper">

                            <label><?php _e( 'Additional Details', 'inspiry' ); ?></label>

                            <div class="inspiry-detail labels clearfix">
                                <div class="inspiry-detail-control">&nbsp;</div>
                                <div class="inspiry-detail-title"><label><?php _e( 'Title','inspiry' ) ?></label></div>
                                <div class="inspiry-detail-value"><label><?php _e( 'Value','inspiry' ); ?></label></div>
                                <div class="inspiry-detail-control">&nbsp;</div>
                            </div>

                            <!-- additional details container -->
                            <div id="inspiry-additional-details-container">

                                <?php
                                // output existing details
                                $additional_details = get_post_meta( $target_property->ID, 'REAL_HOMES_additional_details', true );

                                if( ! empty ( $additional_details ) ) {

                                    foreach( $additional_details as $title => $value ) {
                                        ?>
                                        <div class="inspiry-detail inputs clearfix">
                                            <div class="inspiry-detail-control">
                                                <i class="sort-detail fa fa-bars"></i>
                                            </div>
                                            <div class="inspiry-detail-title">
                                                <input type="text" name="detail-titles[]" value="<?php echo esc_attr( $title ); ?>" />
                                            </div>
                                            <div class="inspiry-detail-value">
                                                <input type="text" name="detail-values[]" value="<?php echo esc_attr( $value ); ?>" />
                                            </div>
                                            <div class="inspiry-detail-control">
                                                <a class="remove-detail" href="#"><i class="fa fa-times"></i></a>
                                            </div>
                                        </div>
                                        <?php
                                    }

                                } else {
                                    ?>
                                    <div class="inspiry-detail inputs clearfix">
                                        <div class="inspiry-detail-control">
                                            <i class="sort-detail fa fa-bars"></i>
                                        </div>
                                        <div class="inspiry-detail-title">
                                            <input type="text" name="detail-titles[]" value="" />
                                        </div>
                                        <div class="inspiry-detail-value">
                                            <input type="text" name="detail-values[]" value="" />
                                        </div>
                                        <div class="inspiry-detail-control">
                                            <a class="remove-detail" href="#"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div><!-- end of additional details container -->

                            <div class="inspiry-detail clearfix">
                                <div class="inspiry-detail-control">&nbsp;</div>
                                <div class="inspiry-detail-control">
                                    <a class="add-detail" href="#"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <!-- .row -->

            <div class="row container-row">

                <div class="col-xs-12">

                    <div class="form-option">
                        <?php wp_nonce_field( 'submit_property', 'property_nonce' ); ?>
                        <input type="hidden" name="action" value="update_property"/>
                        <input type="hidden" name="property_id" value="<?php echo esc_attr( $target_property->ID ); ?>"/>
                        <input type="submit" value="<?php _e('Update Property', 'inspiry'); ?>" class="btn-small btn-orange"/>
                    </div>

                    <div id="message-container"></div>

                </div>
            </div>
            <!-- .row -->

        </form>
        <?php

    } else {
        VR_Functions::vr_message( __( 'Oops','inspiry' ), __( 'It appears that, Provided property does not belong to you!', 'inspiry' ) );
    }

} else {
    VR_Functions::vr_message( __( 'Oops','inspiry' ), __( 'It appears that, Provided property id is invalid!', 'inspiry' ) );
}
