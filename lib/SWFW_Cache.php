<?php

class SWFW_Cache {


	/**
	 * True iff the follow counts are less than 24 hours old.
	 *
	 * Since all follow networks use the same cache timesamp, we can have one
	 * universal $is_fresh field to direct all follow networks.
	 * @var boolean $is_fresh
	 *
	 */
	static $is_fresh;

	/**
	 * For this addon we will consider the age limit to be 24 hours.
	 *
	 * @return boolean True iff `last_updated` is less than 24 hours old.
	 *
	 */
	public static function is_cache_fresh() {

		if ( isset( self::$is_fresh ) ) {
			return self::$is_fresh;
		}

		$last_updated = (int) SWFW_Utility::get_option( 'last_updated' );
		$current_time =  floor( time() / DAY_IN_SECONDS );

		self::$is_fresh = $current_time - $last_updated < 24;
		return self::$is_fresh;
	}


	/**
	 * Updates the follow counts in the database and the last_updated timestamp.
	 *
	 * @param  array $counts The ['network_key' => (int) follow_count] data.
	 * @return bool  True iff the counts were updated, else false.
	 *
	 */
	public static function update_cache_timestamp( ) {
		$now = time() / DAY_IN_SECONDS;

		return SWFW_Utility::update_option( 'last_updated', $now );
	}
}
