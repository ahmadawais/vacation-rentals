<?php
/**
 * Handle field actions for terms
 * @package    Meta Box
 * @subpackage MB Term Meta
 */

/**
 * Field class.
 */
class MB_Term_Meta_Field {
	/**
	 * Get field meta value
	 *
	 * @param mixed $meta Meta value
	 * @param array $field Field parameters
	 * @param bool $saved Is meta box saved?
	 *
	 * @return mixed
	 */
	public static function meta( $meta, $field, $saved ) {
		$term_id = MB_Term_Meta_Box::get_object_id();

		$single = $field['clone'] || ! $field['multiple'];
		$meta   = get_term_meta( $term_id, $field['id'], $single );

		// For taxonomy advanced: ignore "multiple" as values are saved in 1 row
		if ( 'taxonomy_advanced' == $field['type'] ) {
			$meta = get_term_meta( $term_id, $field['id'], true );
			$meta = wp_parse_id_list( $meta );
			$meta = array_filter( $meta );
		}

		// Use $field['std'] only when the meta box hasn't been saved (i.e. the first time we run)
		$meta = ( ! $saved && '' === $meta || array() === $meta ) ? $field['std'] : $meta;

		// Escape attributes
		$meta = RWMB_Field::call( $field, 'esc_meta', $meta );

		// Make sure meta value is an array for clonable and multiple fields
		if ( $field['clone'] || $field['multiple'] ) {
			if ( empty( $meta ) || ! is_array( $meta ) ) {
				/**
				 * Note: if field is clonable, $meta must be an array with values
				 * so that the foreach loop in self::show() runs properly
				 * @see self::show()
				 */
				$meta = $field['clone'] ? array( '' ) : array();
			}
		}

		return $meta;
	}

	/**
	 * Save meta value.
	 *
	 * @param $new
	 * @param $old
	 * @param $term_id
	 * @param $field
	 */
	public static function save( $new, $old, $term_id, $field ) {
		$name = $field['id'];

		// Taxonomy advanced field: ignore "multiple" as values are saved in 1 row
		if ( 'taxonomy_advanced' == $field['type'] ) {
			$field['multiple'] = false;
		}

		// Media fields: remove term meta to save order.
		if ( in_array( $field['type'], array(
			'media',
			'file_advanced',
			'file_upload',
			'image_advanced',
			'image_upload',
		) ) ) {
			$old = array();
			delete_term_meta( $term_id, $name );
		}

		// Remove term meta if it's empty
		if ( '' === $new || array() === $new ) {
			delete_term_meta( $term_id, $name );

			return;
		}

		// If field is cloneable, value is saved as a single entry in the database
		if ( $field['clone'] ) {
			$new = (array) $new;
			foreach ( $new as $k => $v ) {
				if ( '' === $v ) {
					unset( $new[ $k ] );
				}
			}
			update_term_meta( $term_id, $name, $new );

			return;
		}

		// If field is multiple, value is saved as multiple entries in the database (WordPress behaviour)
		if ( $field['multiple'] ) {
			foreach ( $new as $new_value ) {
				if ( ! in_array( $new_value, $old ) ) {
					add_term_meta( $term_id, $name, $new_value, false );
				}
			}
			foreach ( $old as $old_value ) {
				if ( ! in_array( $old_value, $new ) ) {
					delete_term_meta( $term_id, $name, $old_value );
				}
			}

			return;
		}

		// Default: just update term meta
		update_term_meta( $term_id, $name, $new );
	}
}
