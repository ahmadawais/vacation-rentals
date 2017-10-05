<?php
/**
 * Loader for term meta
 * @package    Meta Box
 * @subpackage MB Term Meta
 * @author     Tran Ngoc Tuan Anh <rilwis@gmail.com>
 */

/**
 * Loader class
 */
class MB_Term_Meta_Loader {
	/**
	 * Meta boxes for terms only.
	 * Use static variable to be accessible outside the class (in MB Rest API plugin).
	 * @var array
	 */
	public static $meta_boxes = array();

	/**
	 * Run hooks to get meta boxes for terms and initialize them.
	 */
	public function init() {
		add_filter( 'rwmb_meta_boxes', array( $this, 'filter' ), 999 );

		/**
		 * Initialize meta boxes for term.
		 * 'rwmb_meta_boxes' runs at priority 10, we use priority 20 to make sure self::$meta_boxes is set.
		 * @see mb_term_meta_filter()
		 */
		add_action( 'admin_init', array( $this, 'register' ), 20 );
	}

	/**
	 * Filter meta boxes to get only meta boxes for terms and remove them from posts.
	 *
	 * @param array $meta_boxes
	 *
	 * @return array
	 */
	public function filter( $meta_boxes ) {
		foreach ( $meta_boxes as $k => $meta_box ) {
			if ( isset( $meta_box['taxonomies'] ) ) {
				self::$meta_boxes[] = $meta_box;
				unset( $meta_boxes[ $k ] );
			}
		}

		return $meta_boxes;
	}

	/**
	 * Register meta boxes for term, each meta box is a section
	 */
	public function register() {
		foreach ( self::$meta_boxes as $meta_box ) {
			new MB_Term_Meta_Box( $meta_box );
		}
	}
}
