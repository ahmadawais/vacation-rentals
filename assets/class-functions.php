<?php
/**
 * Functions
 *
 * Base usable functions.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'VR_Functions' ) ) :

/**
 * VR_Functions.
 *
 * VR Base Functions.
 *
 * @since 1.0.0
 */
class VR_Functions {

	/**
	 * Outputs given message.
	 *
	 * @param string $heading
	 * @param string $message
	 */
	public static function message( $heading = '', $message = '' ) {

		echo '<div class="message">';
		if ( !empty( $heading ) ) {
			echo '<h3>' . $heading . '</h3>';
		}
		if ( !empty( $message ) ) {
			echo '<p>' . $message . '</p>';
		}
		echo '</div>';
	}

	/**
	 * Delete all posts.
	 *
	 * Manual unit testing.
	 *
	 * @since 1.0.0
	 */
	public static function delete_posts( $post_type = NULL, $post_status = 'draft' ) {
		$args = array(
			'post_type'   => $post_type,
			'post_status' => $post_status
			);
		$posts = get_posts( $args );
		foreach( $posts as $post ) {
		 wp_delete_post( $post->ID, true);
		}
	}

	/**
	 * Get terms array for Rental List Meta.
	 *
	 * Returns terms array for a given taxonomy
	 * containing key(slug) value(name) pair.
	 *
	 * @param string $tax_name
	 * @param variable that is returned $terms_array
	 * @since 1.0.0
	 * @since 1.0.1 WP 4.5.0 breaking changes addressed.
	 */
	public static function get_terms_array( $tax_name, &$terms_array ) {
		// Changed the function signature so that the $args array can be provided as the first parameter.
		// Introduced 'meta_key' and 'meta_value' parameters. Introduced the ability to order results by metadata.
		// @link https://developer.wordpress.org/reference/functions/get_terms/

		// Get WP Version.
		global $wp_version;

		// PHP Version Compare.
		// @link http://php.net/manual/en/function.version-compare.php
		// if WP ver is >= 4.5.0.
		if ( version_compare( $wp_version, '4.5.0', '>=' ) ) {
			$tax_terms = get_terms( array (
				'taxonomy'   => $tax_name,
				'hide_empty' => false,
			) );
		} else {
			// else WP ver less than 4.5.0.
			$tax_terms = get_terms( $tax_name, array (
				'hide_empty' => false,
			) );
		}
		// Add term children.
		VR_Functions::add_term_children( 0, $tax_terms, $terms_array );
	}

	/**
	 * Add term children to array.
	 *
	 * A recursive function to add children terms to given array.
	 *
	 * @param   int $parent_id
	 * @param   array $tax_terms
	 * @param   array variable $terms_array
	 * @param   string $prefix
	 * @since   1.0.0
	 */
	public static function add_term_children( $parent_id, $tax_terms, &$terms_array, $prefix = '' ) {
		if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ) {
			foreach ( $tax_terms as $term ) {
				if ( $parent_id == $term->parent ) {
					$terms_array[ $term->slug ] = $prefix . $term->name;
					VR_Functions::add_term_children( $term->term_id, $tax_terms, $terms_array, $prefix . '- ' );
				} // End if().
			} // End forwach().
		} // End if().
	} // End function.

	/**
	 * Rental Price & Currency Formantted.
	 *
	 * Get Formatted Rental Price with Currency.
	 *
	 * @param int $price Price of rental.
	 * @since 1.0.0
	 */
	public static function rental_price_currency( $price = 0 ) {
		if ( function_exists( 'vr_get_settings_obj' ) ) {
			// Instantiate the VR_Get_Page_Meta object.
			$vr_get_settings_obj = vr_get_settings_obj();

			// Get settings.
			$currency_symbol    = '<span style="font-size:80%;">' . $vr_get_settings_obj->currency_symbol . '</span>';
			$currency_position  = $vr_get_settings_obj->currency_position;
			$thousand_separator = $vr_get_settings_obj->thousand_separator;
			$decimal_separator  = $vr_get_settings_obj->decimal_separator;
			$no_of_decimals     = $vr_get_settings_obj->no_of_decimals;
			$empty_price_text   = $vr_get_settings_obj->empty_price_text;

			// Get price.
			$vr_get_price          = $price;
			$vr_get_price          = ( isset( $vr_get_price ) && false != $vr_get_price )
										? $vr_get_price : $empty_price_text;

			// Format the price.
			if ( $empty_price_text != $vr_get_price ) {
				// Formatted price.
				$vr_formatted_price = number_format( $vr_get_price, $no_of_decimals, $decimal_separator, $thousand_separator );

				// Where to add the currency.
				if ( 'before' == $currency_position ) {
					$vr_price_currency = $currency_symbol . $vr_formatted_price;
				} else {
					$vr_price_currency = $vr_formatted_price . $currency_symbol;
				}
			} else {
				$vr_price_currency = $empty_price_text;
			}
		} // if ended.

		// Return the formatted price & currecny.
		return $vr_price_currency;
	}

} // Class ended.

endif;


/**
 * METHOD: Get an object of VR_Functions class.
 *
 * Add for themes to recognize the class and help
 * instantiate an object without any hooks.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'vr_get_function_obj' ) ) {
	function vr_get_function_obj() {
		return new VR_Functions();
	}
}

// // Admin menu.
// add_action( 'admin_menu', 'vr_menu_new' );
// function vr_menu_new() {
//     add_menu_page( 'Page', 'Menu', 'manage_options', 'vr_menu_new', '', '', 3.005 );
// }

