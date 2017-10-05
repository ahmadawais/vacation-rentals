<?php
/**
 * The main class of the plugin which handle show, edit, save custom fields (meta data) for terms.
 * @package    Meta Box
 * @subpackage MB Term Meta
 * @author     Tran Ngoc Tuan Anh <rilwis@gmail.com>
 */

/**
 * Class for handling custom fields (meta data) for terms.
 */
class MB_Term_Meta_Box extends RW_Meta_Box {
	/**
	 * Create meta box based on given data
	 *
	 * @param array $meta_box Meta box definition
	 */
	public function __construct( $meta_box ) {
		parent::__construct( $meta_box );
		$this->meta_box['taxonomies'] = (array) $this->meta_box['taxonomies'];

		remove_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		remove_action( 'save_post_post', array( $this, 'save_post' ) );

		// Add meta fields to edit term page
		add_action( 'load-edit-tags.php', array( $this, 'add' ) );
		add_action( 'load-term.php', array( $this, 'add' ) );

		// Save term meta
		foreach ( $this->meta_box['taxonomies'] as $taxonomy ) {
			add_action( "edited_$taxonomy", array( $this, 'save' ) );
		}

		add_action( "rwmb_before_{$this->meta_box['id']}", array( $this, 'show_heading' ) );
	}

	/**
	 * Show heading of the section.
	 */
	public function show_heading() {
		echo '<h2>', esc_html__( $this->meta_box['title'] ), '</h2>';
	}

	/**
	 * Add meta box to term edit form, each meta box is a section.
	 */
	public function add() {
		if ( ! $this->is_edit_screen() ) {
			return;
		}

		// Add meta box
		foreach ( $this->meta_box['taxonomies'] as $taxonomy ) {
			add_action( $taxonomy . '_edit_form', array( $this, 'show' ), 10, 2 );
		}

		// Change field meta.
		add_filter( 'rwmb_field_meta', array( 'MB_Term_Meta_Field', 'meta' ), 10, 3 );
	}

	/**
	 * Enqueue styles for term meta.
	 */
	public function enqueue() {
		if ( ! $this->is_edit_screen() ) {
			return;
		}

		// Backward compatibility
		if ( method_exists( $this, 'admin_enqueue_scripts' ) ) {
			parent::admin_enqueue_scripts();
		} else {
			parent::enqueue();
		}
		list( , $url ) = RWMB_Loader::get_path( dirname( dirname( __FILE__ ) ) );
		wp_enqueue_style( 'mb-term-meta', $url . 'css/style.css', '', '1.0.2' );
	}

	/**
	 * Save meta fields for terms
	 *
	 * @param int $term_id
	 */
	public function save( $term_id ) {
		// Check whether form is submitted properly
		$nonce = (string) filter_input( INPUT_POST, "nonce_{$this->meta_box['id']}" );
		if ( ! wp_verify_nonce( $nonce, "rwmb-save-{$this->meta_box['id']}" ) ) {
			return;
		}

		foreach ( $this->fields as $field ) {
			$name   = $field['id'];
			$single = $field['clone'] || ! $field['multiple'];
			$old    = get_term_meta( $term_id, $name, $single );
			$new    = isset( $_POST[ $name ] ) ? $_POST[ $name ] : ( $single ? '' : array() );

			// Allow field class change the value
			$new = RWMB_Field::call( $field, 'value', $new, $old, 0 );
			$new = RWMB_Field::filter( 'value', $new, $field, $old );

			MB_Term_Meta_Field::save( $new, $old, $term_id, $field );
		}
	}

	/**
	 * Check if term meta is saved.
	 * @return bool
	 */
	public function is_saved() {
		$term_id = self::get_object_id();

		foreach ( $this->fields as $field ) {
			$value = get_term_meta( $term_id, $field['id'], ! $field['multiple'] );
			if (
				( ! $field['multiple'] && '' !== $value )
				|| ( $field['multiple'] && array() !== $value )
			) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Check if we're on the right edit screen.
	 *
	 * @param WP_Screen $screen Screen object. Optional. Use current screen object by default.
	 *
	 * @return bool
	 */
	public function is_edit_screen( $screen = null ) {
		$screen = get_current_screen();

		return
			( 'edit-tags' == $screen->base || 'term' == $screen->base )
			&& in_array( $screen->taxonomy, $this->meta_box['taxonomies'] );
	}

	/**
	 * Get editing term ID.
	 * @return bool|int
	 */
	public static function get_object_id() {
		return isset( $_GET['tag_ID'] ) ? intval( $_GET['tag_ID'] ) : false;
	}
}
