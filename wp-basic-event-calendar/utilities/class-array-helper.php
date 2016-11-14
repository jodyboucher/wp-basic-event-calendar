<?php

namespace JodyBoucher\Wordpress\BasicEventCalendar;

if ( ! class_exists( 'Array_Helper' ) ) {
	/**
	 * Class ArrayHelper
	 *
	 * Some basic array helper routines
	 *
	 * @since      1.0.0
	 */
	class Array_Helper {
		/**
		 * Checks if the given key or index exists in the array
		 *
		 * @since      1.0.0
		 *
		 * @param mixed $key   Value to check.
		 * @param array $array An array with keys to check.
		 *
		 * @return bool
		 */
		public static function key_exists( $key, $array ) {
			return isset( $array[ $key ] ) || array_key_exists( $key, $array );
		}

		/**
		 * Gets the value of the given key in the array, or default if key does not exist
		 *
		 * @since      1.0.0
		 *
		 * @param mixed $key     The key of the value to obtain.
		 * @param array $array   The array to obtain value form.
		 * @param mixed $default The value to obtain if key does not exist.
		 *
		 * @return mixed The value associated with key, otherwise default.
		 */
		public static function get_value_or_default( $key, $array, $default ) {
			return self::key_exists( $key, $array ) ? $array[ $key ] : $default;
		}
	}
}
