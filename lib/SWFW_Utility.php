<?php

class SWFW_Utility {

	/**
	 * The plugins data stored in wp_options.
	 *
	 * The contents are network counts and a timestamp.
	 *
	 * Settings are otherwise already managed by the WP_Widget for each instance
	 * of Social_Warfare_Follow_Widget.
	 *
	 * @var array $options
	 */
	public static $options = array();
	public static $instance;

	public function __construct() {

	}


	/**
	 * Fetches a optionsd item, if it exists.
	 *
	 * @param  string $key The target data.
	 * @return mixed The value if it exists, else bool `false`.
	 *
	 */
	public static function get_option( $key ) {
		if ( empty ( self::$options ) ) {
			self::get_options();
		}

		if ( isset( $options[$key] ) ) {
			return $options[$key];
		}

		return false;
	}


	/**
	 * Retrieves the associative array of plugin options.
	 *
	 * If the options do not exist, they are created.
	 *
	 * @since 1.0.0 | 15 JAN 2019 | Created.
	 * @param void
	 * @return array The plugin options from the WP database.
	 *
	 */
	public static function get_options() {
		$options = get_option( 'swfw_options', array() );

		if ( empty( $options ) ) {
			/**
			 * Initialize the SWFW options with a timestamp.
			 *
			 */
			$options = array( 'last_updated' => 0 );
			update_option( 'swfw_options', $options );
		}

		return self::$options = $options;
	}


	/**
	 * Updates a optionsd item.
	 *
	 * @param  string $key The target data.
	 * @return mixed The value if it exists, else bool `false`.
	 *
	 */
	public static function update_option( $key, $value ) {
		if ( empty ( self::$options ) ) {
			self::get_options();
		}

		self::$options[$key] = $value;

		return update_option( 'swfw_options', self::$options, true );
	}

}
