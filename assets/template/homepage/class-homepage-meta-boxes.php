<?php
/**
 * Class for Homepage meta boexes
 *
 * Meta boxes for homepage template.
 *
 * @since 	1.0.0
 * @package VRC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * VR_Homepage_Meta_Boxes.
 *
 * Class for `vr_homepage` meta boxes.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'VR_Homepage_Meta_Boxes' ) ) :

class VR_Homepage_Meta_Boxes {
	/**
	 * Booking form fields.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	private $bookingform_fields_array;

	/**
	 * Feature Fields.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	private $feature_fields;

	/**
	 * CTA Fields.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	private $cta_fields;

	/**
	 * Destination Fields.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	private $destination_fields;

	/**
	 * Steps Fields.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	private $steps_fields;

	/**
	 * Featured Rentals Fields.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	private $frentals_fields;

	/**
	 * Testimonial and News Fields.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	private $tandn_fields;

	/**
	 * FCTA Fields.
	 *
	 * @var 	object
	 * @since 	1.0.0
	 */
	// private $fcta_fields;


	/**
	 * Constructor.
	 *
	 * Gets the metabox classes and assigns
	 * a local var to them.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Booking Form.
		$this->bookingform_fields_array = new VR_Homepage_BookingForm_Fields();

		// Features.
		$this->feature_fields           = new VR_Homepage_Feature_Fields();

		// CTA.
		$this->cta_fields               = new VR_Homepage_CTA_Fields();

		// Destination.
		$this->destination_fields       = new VR_Homepage_Destination_Fields();

		// Steps.
		$this->steps_fields             = new VR_Homepage_Steps_Fields();

		// Featured Rentals.
		$this->frentals_fields          = new VR_Homepage_FRentals_Fields();

		// TandN Rentals.
		$this->tandn_fields             = new VR_Homepage_TandN_Fields();

		// FCTA Rentals.
		// $this->fcta_fields              = new VR_Homepage_FCTA_Fields();
	}



	/**
	 * Register meta boxes related to homepage template
	 *
	 * @param   array   $meta_boxes
	 * @return  array   $meta_boxes
	 * @since   1.0.0
	 */
	public function register( $meta_boxes ) {
		// Now inside the metabox classes.
	    // $prefix = 'vr_homepage_';

		// Booking Form.
		$vr_booking_fields     = $this->bookingform_fields_array->get_fields();

		// Feature Form.
		$vr_feature_fields     = $this->feature_fields->get_fields();

		// CTA Form.
		$vr_cta_fields         = $this->cta_fields->get_fields();

		// Destination Form.
		$vr_destination_fields = $this->destination_fields->get_fields();

		// Steps Form.
		$vr_steps_fields       = $this->steps_fields->get_fields();

		// FRentals Form.
		$vr_frentals_fields    = $this->frentals_fields->get_fields();

		// TandN Form.
		$vr_tandn_fields       = $this->tandn_fields->get_fields();

		// FCTA Form.
		// $vr_fcta_fields       = $this->fcta_fields->get_fields();


		// Temporary array to be merged later.
	    $vr_tmp_array = array(
			$vr_booking_fields,
			$vr_feature_fields,
			$vr_cta_fields,
			$vr_destination_fields,
			$vr_steps_fields,
			$vr_frentals_fields,
			$vr_tandn_fields,
			// $vr_fcta_fields,
	    );

	    // Fields array.
	    $vr_homepage_fields = array();

	    // Merge all arrays with $vr_homepage_fields array.
	    foreach ( $vr_tmp_array as $field_array ) {
		    $vr_homepage_fields = array_merge( $vr_homepage_fields, $field_array );
	    }

	    // For Debugging.
	    // $debug_var = $vr_homepage_fields;
	    // echo "<pre>";
	    // var_dump( $debug_var );
	    // echo "</pre>";
	    // exit();


		// Main metabox
	    $meta_boxes[] = array(
			'id'          => 'vr_homepage_meta_box_id',
			'title'       => __('Page Settings', 'VRC'),
			'post_types'  => array( 'page' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'tabs'        => array(
				'bookingform' => array(
					'label' => __('Booking Form', 'VRC'),
					'icon'  => 'dashicons-admin-home'
				),
				'feature'     => array(
					'label' => __('Feature Section', 'VRC'),
					'icon'  => 'dashicons-format-gallery'
				),
				'cta'     => array(
					'label' => __('CTA Section', 'VRC'),
					'icon'  => 'dashicons-format-gallery'
				),
				'destination'     => array(
					'label' => __('Destination Section', 'VRC'),
					'icon'  => 'dashicons-format-gallery'
				),
				'steps'     => array(
					'label' => __('Steps Section', 'VRC'),
					'icon'  => 'dashicons-format-gallery'
				),
				'frentals'     => array(
					'label' => __('Featured Rentals Section', 'VRC'),
					'icon'  => 'dashicons-format-gallery'
				),
				'tandn'     => array(
					'label' => __('Testimonial & News Section', 'VRC'),
					'icon'  => 'dashicons-format-gallery'
				),
				// 'fcta'     => array(
				// 	'label' => __('Footer CTA Section', 'VRC'),
				// 	'icon'  => 'dashicons-format-gallery'
				// )
			),
			'tab_style'   => 'left',
			'show'        => array(
				// List of page templates (used for page only). Array. Optional.
				// Page template file name. (if in the root)
				'template'    => array( 'page-homepage.php' ),
			),
			'fields'      => $vr_homepage_fields
		); // Metbox ended.

	    return $meta_boxes;

	} // Register function End.

} // Class ended.

endif;
