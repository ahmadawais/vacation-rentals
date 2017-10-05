<?php
/**
 * VR Get Settings
 *
 * Class to get settings.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Get_Settings.
 *
 * Get settings class.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Get_Settings' ) ) :

class VR_Get_Settings {
	/**
	 * Settings Section Array.
	 *
	 * @var 	array
	 * @since 	1.0.0
	 */
	public $vr_settings;

	/**
	 * currency_symbol.
	 *
	 * @var 	string
	 * @since 	1.0.0
	 */
	public $currency_symbol;

	/**
	 * currency_position.
	 *
	 * @var 	string
	 * @since 	1.0.0
	 */
	public $currency_position;

	/**
	 * thousand_separator.
	 *
	 * @var 	string
	 * @since 	1.0.0
	 */
	public $thousand_separator;

	/**
	 * decimal_separator.
	 *
	 * @var 	string
	 * @since 	1.0.0
	 */
	public $decimal_separator;

	/**
	 * no_of_decimals.
	 *
	 * @var 	int
	 * @since 	1.0.0
	 */
	public $no_of_decimals;

	/**
	 * empty_price_text.
	 *
	 * @var 	string
	 * @since 	1.0.0
	 */
	public $empty_price_text;


	/**
	 * Construct.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Initialize settings.
		$this->vr_settings        = get_option( 'vr_general_settings' );
		$this->vr_settings        = isset( $this->vr_settings ) && is_array( $this->vr_settings ) ? $this->vr_settings : false;

		// Assign currency_symbol.
		$this->currency_symbol    = $this->vr_settings['currency_symbol'];
		$this->currency_symbol    = isset( $this->currency_symbol ) ? $this->currency_symbol : '$';

		// Assign currency_position.
		$this->currency_position  = $this->vr_settings['currency_position'];
		$this->currency_position  = isset( $this->currency_position ) ? $this->currency_position : 'before';

		// Assign thousand_separator.
		$this->thousand_separator = $this->vr_settings['thousand_separator'];
		$this->thousand_separator = isset( $this->thousand_separator ) ? $this->thousand_separator : ',';

		// Assign decimal_separator.
		$this->decimal_separator  = $this->vr_settings['decimal_separator'];
		$this->decimal_separator  = isset( $this->decimal_separator ) ? $this->decimal_separator : '.';

		// Assign no_of_decimals.
		$this->no_of_decimals     = absint( $this->vr_settings['no_of_decimals'] );
		$this->no_of_decimals     = isset( $this->no_of_decimals ) ? $this->no_of_decimals : 0;

		// Assign empty_price_text.
		$this->empty_price_text   = $this->vr_settings['empty_price_text'];
		$this->empty_price_text   = isset( $this->empty_price_text ) ? $this->empty_price_text : 'On Call';
	}

}

endif;


/**
 * METHOD: Get an object of VR_Get_Settings class.
 *
 * Add for themes to recognize the class and help
 * instantiate an object without any hooks.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'vr_get_settings_obj' ) ) {
	function vr_get_settings_obj() {
		return new VR_Get_Settings();
	}
}

