<?php
/**
 * Removed `:` so that it doesn't get recognivrced as a plugin JIC.
 *
 * Plugin Name Categories Images
 * Plugin URI http://vrcahlan.net/blog/2012/06/categories-images/.
 * Description Categories Images Plugin allow you to add an image to category or any custom term.
 * Author Muhammad Said El Zahlan
 * Version 2.5.3
 * Author URI http://vrcahlan.net/.
 * Domain Path /languages
 * Text Domain categories-images
 *
 * @package VRC
 */

/**
 * Customizer Init.
 *
 * @since 1.0.0
 */
if ( file_exists( VRC_DIR . '/assets/plugin/category-images/customizer/customizer-init.php' ) ) {
    require_once( VRC_DIR . '/assets/plugin/category-images/customizer/customizer-init.php' );
}

// Get the default image..
$vr_default_cat_term_img = get_theme_mod( 'vr_cat_term_img', VRC_URL . '/assets/plugin/category-images/assets/img/placeholder.png' );

add_action( 'admin_init', 'vr_init' );
function vr_init() {
	$vr_taxonomies = get_taxonomies();
	if ( is_array( $vr_taxonomies ) ) {
		$vr_ci_options = get_option( 'vr_ci_options' );
		if ( empty( $vr_ci_options['excluded_taxonomies'] ) )
			$vr_ci_options['excluded_taxonomies'] = array();

	    foreach ( $vr_taxonomies as $vr_taxonomy ) {
			if ( in_array( $vr_taxonomy, $vr_ci_options['excluded_taxonomies'] ) )
				continue;
	        add_action( $vr_taxonomy.'_add_form_fields', 'vr_add_texonomy_field' );
			add_action( $vr_taxonomy.'_edit_form_fields', 'vr_edit_texonomy_field' );
			add_filter(  'manage_edit-' . $vr_taxonomy . '_columns', 'vr_taxonomy_columns'  );
			add_filter(  'manage_' . $vr_taxonomy . '_custom_column', 'vr_taxonomy_column', 10, 3  );
	    }
	}
}

function vr_add_style() {
	echo '<style type="text/css" media="screen">
		th.column-thumb {width:60px;}
		.form-field img.taxonomy-image {border:1px solid #eee;max-width:300px;max-height:300px;}
		.inline-edit-row fieldset .thumb label span.title {width:48px;height:48px;border:1px solid #eee;display:inline-block;}
		.column-thumb span {width:48px;height:48px;border:1px solid #eee;display:inline-block;}
		.inline-edit-row fieldset .thumb img,.column-thumb img {width:48px;height:48px;}
	</style>';
}

// add image field in add form.
function vr_add_texonomy_field() {
	if ( get_bloginfo( 'version' ) >= 3.5 )
		wp_enqueue_media();
	else {
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'thickbox' );
	}

	echo '<div class="form-field">
		<label for="taxonomy_image">' . __( 'Image', 'categories-images' ) . '</label>
		<input type="text" name="taxonomy_image" id="taxonomy_image" value="" />
		<br />
		<button class="vr_upload_image_button button">' . __( 'Upload/Add image', 'categories-images' ) . '</button>
		<p class="description">Make sure the image is not too small and not too big. Recommended size for [Rental Desitnations/Categories/Tags is 1920px x 450px (Width x Height)] and for [Rental Features/Types is 32px x 32px (Width x Height)].</p>
	</div>'.vr_script();
}

// add image field in edit form.
function vr_edit_texonomy_field( $taxonomy ) {
	// Get the default image..
	$vr_default_cat_term_img = get_theme_mod( 'vr_cat_term_img', VRC_URL . '/assets/plugin/category-images/assets/img/placeholder.png' );


	if ( get_bloginfo( 'version' ) >= 3.5 )
		wp_enqueue_media();
	else {
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'thickbox' );
	}

	if ( vr_taxonomy_image_url(  $taxonomy->term_id, NULL, TRUE  ) == $vr_default_cat_term_img )
		$image_url = "";
	else
		$image_url = vr_taxonomy_image_url(  $taxonomy->term_id, NULL, TRUE  );
	echo '<tr class="form-field">
		<th scope="row" valign="top"><label for="taxonomy_image">' . __( 'Image', 'categories-images' ) . '</label></th>
		<td><img class="taxonomy-image" src="' . vr_taxonomy_image_url(  $taxonomy->term_id, 'medium', TRUE  ) . '"/><br/><input type="text" name="taxonomy_image" id="taxonomy_image" value="'.$image_url.'" /><br />
		<button class="vr_upload_image_button button">' . __( 'Upload/Add image', 'categories-images' ) . '</button>
		<button class="vr_remove_image_button button">' . __( 'Remove image', 'categories-images' ) . '</button>
		<p class="description">Make sure the image is not too small and not too big. Recommended size for [Rental Desitnations/Categories/Tags is 1920px x 450px (Width x Height)] and for [Rental Features/Types is 32px x 32px (Width x Height)].</p>
		</td>
	</tr>'.vr_script();
}

// upload using wordpress upload.
function vr_script() {
	// Get the default image..
	$vr_default_cat_term_img = get_theme_mod( 'vr_cat_term_img', VRC_URL . '/assets/plugin/category-images/assets/img/placeholder.png' );

	return '<script type="text/javascript">
	    jQuery( document ).ready( function( $ ) {
			var wordpress_ver = "'.get_bloginfo( "version" ).'", upload_button;
			$( ".vr_upload_image_button" ).click( function( event ) {
				upload_button = $( this );
				var frame;
				if ( wordpress_ver >= "3.5" ) {
					event.preventDefault();
					if ( frame ) {
						frame.open();
						return;
					}
					frame = wp.media();
					frame.on(  "select", function() {
						// Grab the selected attachment..
						var attachment = frame.state().get( "selection" ).first();
						frame.close();
						if ( upload_button.parent().prev().children().hasClass( "tax_list" ) ) {
							upload_button.parent().prev().children().val( attachment.attributes.url );
							upload_button.parent().prev().prev().children().attr( "src", attachment.attributes.url );
						}
						else
							$( "#taxonomy_image" ).val( attachment.attributes.url );
					} );
					frame.open();
				}
				else {
					tb_show( "", "media-upload.php?type=image&amp;TB_iframe=true" );
					return false;
				}
			} );

			$( ".vr_remove_image_button" ).click( function() {
				$( ".taxonomy-image" ).attr( "src", "'. $vr_default_cat_term_img .'" );
				$( "#taxonomy_image" ).val( "" );
				$( this ).parent().siblings( ".title" ).children( "img" ).attr( "src","' . $vr_default_cat_term_img . '" );
				$( ".inline-edit-col :input[name=\'taxonomy_image\']" ).val( "" );
				return false;
			} );

			if ( wordpress_ver < "3.5" ) {
				window.send_to_editor = function( html ) {
					imgurl = $( "img",html ).attr( "src" );
					if ( upload_button.parent().prev().children().hasClass( "tax_list" ) ) {
						upload_button.parent().prev().children().val( imgurl );
						upload_button.parent().prev().prev().children().attr( "src", imgurl );
					}
					else
						$( "#taxonomy_image" ).val( imgurl );
					tb_remove();
				}
			}

			$( ".editinline" ).click( function() {
			    var tax_id = $( this ).parents( "tr" ).attr( "id" ).substr( 4 );
			    var thumb = $( "#tag-"+tax_id+" .thumb img" ).attr( "src" );

				if ( thumb != "' . $vr_default_cat_term_img . '" ) {
					$( ".inline-edit-col :input[name=\'taxonomy_image\']" ).val( thumb );
				} else {
					$( ".inline-edit-col :input[name=\'taxonomy_image\']" ).val( "" );
				}

				$( ".inline-edit-col .title img" ).attr( "src",thumb );
			} );
	    } );
	</script>';
}

// save our taxonomy image while edit or save term.
add_action( 'edit_term','vr_save_taxonomy_image' );
add_action( 'create_term','vr_save_taxonomy_image' );
function vr_save_taxonomy_image( $term_id ) {
    if ( isset( $_POST['taxonomy_image'] ) ) {
        update_option( 'vr_taxonomy_image' . $term_id, $_POST['taxonomy_image'], NULL );
    }
}

// get attachment ID by image url.
function vr_get_attachment_id_by_url( $image_src ) {
    global $wpdb;
    $query = $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid = %s", $image_src );
    $id = $wpdb->get_var( $query );
    return ( ! empty( $id ) ) ? $id : NULL;
}

// get taxonomy image url for the given term_id ( Place holder image by default ).
function vr_taxonomy_image_url( $term_id = NULL, $size = 'full', $return_placeholder = FALSE ) {
	// Get the default image..
	$vr_default_cat_term_img = get_theme_mod( 'vr_cat_term_img', VRC_URL . '/assets/plugin/category-images/assets/img/placeholder.png' );

	if ( !$term_id ) {
		if ( is_category() )
			$term_id = get_query_var( 'cat' );
		elseif ( is_tag() )
			$term_id = get_query_var( 'tag_id' );
		elseif ( is_tax() ) {
			$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$term_id = $current_term->term_id;
		}
	}

    $taxonomy_image_url = get_option( 'vr_taxonomy_image'.$term_id );
    if ( ! empty( $taxonomy_image_url ) ) {
	    $attachment_id = vr_get_attachment_id_by_url( $taxonomy_image_url );
	    if ( ! empty( $attachment_id ) ) {
	    	$taxonomy_image_url = wp_get_attachment_image_src( $attachment_id, $size );
		    $taxonomy_image_url = $taxonomy_image_url[0];
	    }
	}

    if ( $return_placeholder )
		return ( $taxonomy_image_url != '' ) ? $taxonomy_image_url : $vr_default_cat_term_img;
	else
		return $taxonomy_image_url;
}

function vr_quick_edit_custom_box( $column_name, $screen, $name ) {
	if ( $column_name == 'thumb' )
		echo '<fieldset>
		<div class="thumb inline-edit-col">
			<label>
				<span class="title"><img src="" alt="Thumbnail"/></span>
				<span class="input-text-wrap"><input type="text" name="taxonomy_image" value="" class="tax_list" /></span>
				<span class="input-text-wrap">
					<button class="vr_upload_image_button button">' . __( 'Upload/Add image', 'categories-images' ) . '</button>
					<button class="vr_remove_image_button button">' . __( 'Remove image', 'categories-images' ) . '</button>
					<p class="description">Make sure the image is not too small and not too big. Recommended size for [Rental Desitnations/Categories/Tags is 1920px x 450px (Width x Height)] and for [Rental Features/Types is 32px x 32px (Width x Height)].</p>
				</span>
			</label>
		</div>
	</fieldset>';
}

/**
 * Thumbnail column added to category admin.
 *
 * @access public
 * @param mixed $columns
 * @return void
 */
function vr_taxonomy_columns(  $columns  ) {
	$new_columns = array();
	// $new_columns['cb'] = $columns['cb'];.
	$new_columns['thumb'] = __( 'Image', 'categories-images' );

	// unset(  $columns['cb']  );.

	return array_merge(  $new_columns, $columns  );
}

/**
 * Thumbnail column value added to category admin.
 *
 * @access public
 * @param mixed $columns
 * @param mixed $column
 * @param mixed $id
 * @return void
 */
function vr_taxonomy_column(  $columns, $column, $id  ) {
	if (  $column == 'thumb'  )
		$columns = '<span><img src="' . vr_taxonomy_image_url( $id, 'thumbnail', TRUE ) . '" alt="' . __( 'Thumbnail', 'categories-images' ) . '" class="wp-post-image" /></span>';

	return $columns;
}

// Change 'insert into post' to 'use this image'.
function vr_change_insert_button_text( $safe_text, $text ) {
    return str_replace( "Insert into Post", "Use this image", $text );
}

// Style the image in category list.
if (  strpos(  $_SERVER['SCRIPT_NAME'], 'edit-tags.php'  ) > 0  ) {
	add_action(  'admin_head', 'vr_add_style'  );
	add_action( 'quick_edit_custom_box', 'vr_quick_edit_custom_box', 10, 3 );
	add_filter( "attribute_escape", "vr_change_insert_button_text", 10, 2 );
}

// New menu submenu for plugin options in Settings menu.
add_action( 'admin_menu', 'vr_options_menu' );
function vr_options_menu() {
	add_options_page( __( 'Categories Images settings', 'categories-images' ), __( 'Categories Images', 'categories-images' ), 'manage_options', 'zci-options', 'vr_ci_options' );
	add_action( 'admin_init', 'vr_register_settings' );
}

// Register plugin settings.
function vr_register_settings() {
	register_setting( 'vr_ci_options', 'vr_ci_options', 'vr_options_validate' );
	add_settings_section( 'vr_ci_settings', __( 'Categories Images settings', 'categories-images' ), 'vr_section_text', 'zci-options' );
	add_settings_field( 'vr_excluded_taxonomies', __( 'Excluded Taxonomies', 'categories-images' ), 'vr_excluded_taxonomies', 'zci-options', 'vr_ci_settings' );
}

// Settings section description.
function vr_section_text() {
	echo '<p>'.__( 'Please select the taxonomies you want to exclude it from Categories Images plugin', 'categories-images' ).'</p>';
}

// Excluded taxonomies checkboxs.
function vr_excluded_taxonomies() {
	$options = get_option( 'vr_ci_options' );
	$disabled_taxonomies = array( 'nav_menu', 'link_category', 'post_format' );
	foreach ( get_taxonomies() as $tax ) : if ( in_array( $tax, $disabled_taxonomies ) ) continue; ?>
		<input type="checkbox" name="vr_ci_options[excluded_taxonomies][<?php echo $tax ?>]" value="<?php echo $tax ?>" <?php checked( isset( $options['excluded_taxonomies'][$tax] ) ); ?> /> <?php echo $tax ;?><br />
	<?php endforeach;
}

// Validating options.
function vr_options_validate( $input ) {
	return $input;
}

// Plugin option page.
function vr_ci_options() {
	if ( !current_user_can( 'manage_options' ) )
		wp_die( __(  'You do not have sufficient permissions to access this page.', 'categories-images' ) );
		$options = get_option( 'vr_ci_options' );
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php _e( 'Categories Images', 'categories-images' ); ?></h2>
		<form method="post" action="options.php">
			<?php settings_fields( 'vr_ci_options' ); ?>
			<?php do_settings_sections( 'zci-options' ); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
}

// display taxonomy image for the given term_id.
function vr_taxonomy_image( $term_id = NULL, $size = 'full', $attr = NULL, $echo = TRUE ) {
	if ( !$term_id ) {
		if ( is_category() )
			$term_id = get_query_var( 'cat' );
		elseif ( is_tag() )
			$term_id = get_query_var( 'tag_id' );
		elseif ( is_tax() ) {
			$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$term_id = $current_term->term_id;
		}
	}

    $taxonomy_image_url = get_option( 'vr_taxonomy_image'.$term_id );
    if ( ! empty( $taxonomy_image_url ) ) {
	    $attachment_id = vr_get_attachment_id_by_url( $taxonomy_image_url );
	    if ( ! empty( $attachment_id ) )
	    	$taxonomy_image = wp_get_attachment_image( $attachment_id, $size, FALSE, $attr );
	    else {
	    	$image_attr = '';
	    	if ( is_array( $attr ) ) {
	    		if ( ! empty( $attr['class'] ) )
	    			$image_attr .= ' class="'.$attr['class'].'" ';
	    		if ( ! empty( $attr['alt'] ) )
	    			$image_attr .= ' alt="'.$attr['alt'].'" ';
	    		if ( ! empty( $attr['width'] ) )
	    			$image_attr .= ' width="'.$attr['width'].'" ';
	    		if ( ! empty( $attr['height'] ) )
	    			$image_attr .= ' height="'.$attr['height'].'" ';
	    		if ( ! empty( $attr['title'] ) )
	    			$image_attr .= ' title="'.$attr['title'].'" ';
	    	}
	    	$taxonomy_image = '<img src="'.$taxonomy_image_url.'" '.$image_attr.'/>';
	    }
	}

	if ( $echo )
		echo $taxonomy_image;
	else
		return $taxonomy_image;
}
