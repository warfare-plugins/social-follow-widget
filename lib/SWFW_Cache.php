<?php

class SWFW_Cache {

	/**
	 * For this addon, we will consider the age limit to be 24 hours.
	 *
	 * @return boolean True iff `last_updated` is less than 24 hours old.
	 *
	 */
	public static function is_cache_fresh() {
		$last_updated = (int) self::get_option( 'last_updated' );
		$current_time =  floor( time() / DAY_IN_SECONDS );

		return $current_time - $last_updated < 24;
	}


	/**
	 * Updates the follow counts in the database and the last_updated timestamp.
	 *
	 * @param  array $counts The ['network_key' => (int) follow_count] data.
	 * @return bool  True iff the counts were updated, else false.
	 * 
	 */
	public static function update_follow_counts( $counts ) {
		$now = time() / DAY_IN_SECONDS;

		SWFW_Utility::update_option( 'last_updated', $now );
		return SWFW_Utility::update_option( 'counts', $counts );
	}
}
