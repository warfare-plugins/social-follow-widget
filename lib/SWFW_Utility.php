<?php

class SWFW_Utility {

	/**
	 * The plugins data stored in wp_options.
	 *
	 * The contents are network counts and a timestamp.
	 * $options = array( 'last_updated' => 3481834, 'pinterest' => 1231, 'facebook' => 3851 );
	 *
	 * Settings are otherwise already managed by the WP_Widget for each instance
	 * of Social_Warfare_Follow_Widget.
	 *
	 * @var array $options
	 *
	 */
	public static $options = array();


	/**
	 * Fetches an option if it exists.
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



	public static function save_follow_counts() {
		$updated = update_option( 'swfw_options', self::$options, true );
		SWFW_Cache::update_cache_timestamp();

		return $updated;
	}


	/**
	 * Retrieves the associative array of plugin options.
	 *
	 * If the options do not exist they are created.
	 *
	 * @since 1.0.0 | 15 JAN 2019 | Created.
	 * @param void
	 * @return array The plugin options from the WP database.
	 *
	 */
	public static function get_options() {
		$options = get_option( 'swfw_options', array() );

		if ( empty( $options ) ) {
			 //Initialize the SWFW options with a timestamp.
			$options = array( 'last_updated' => 0  );
			update_option( 'swfw_options', $options );
		}

		return self::$options = $options;
	}

	/**
	 * Update the local stored value for a network count.
	 *
	 * First update all local values, then store the updated array in the database.
	 *
	 * @param  string $network	The network whose follow count to update.
	 * @param  int    $count  	The value of the count.
	 * @return void
	 *
	 */
	public static function update_network_count( $network, $count ) {
		if ( empty ( self::$options ) ) {
			self::get_options();
		}

		$key = "{$network}_follow_count";

		self::$options[$key] = $count;
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
