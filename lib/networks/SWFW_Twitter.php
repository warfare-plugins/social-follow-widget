<?php

/**
 * SWFW_Twitter
 *
 * This provides an interface for creating a follow button for Twitter.
 *
 * @package   social-follow-widget
 * @copyright Copyright (c) 2019, Warfare Plugins, LLC
 * @license   GPL-3.0+
 * @since     1.0.0 | Created
 *
 */
class SWFW_Twitter extends SWFW_Follow_Network {


	/**
	 * Applies network-specific data to the SWFW_Follow_Network
	 *
	 * @since 1.0.0 | 03 DEC 2018 | Created.
	 * @see SWFW_Follow_Network
	 * @param void
	 * @return void
	 */
	public function __construct() {
		$network = array(
			'key' => 'twitter',
			'name' => 'Twitter',
			'cta' => 'Follow',
			'follow_description' => 'Followers',
			'color_primary' => '#429BD5',
			'color_accent' => '#3C87B2',
			'url'	=> 'https://twitter.com/swfw_username',
			'needs_authorization' => true
		);

		parent::__construct( $network );
	}


	/**
	 * Twitter-specific request_url.
	 *
	 * Since Twitter requies Authentication headers, we will go ahead and
	 * immediately make the request here. The returned value indicates
	 * whether or not the response had a body.
	 *
	 * @since 1.0.0 | 15 JAN 2019 | Created.
	 * @param void
	 * @return mixed True if a response was received, else false.
	 *
	 */
	public function do_api_request() {
		require_once __DIR__ . '/../SDKs/Twitter/autoload.php';

		$swp_api_key = '';
		$swp_api_secret = '';

		$consumer_access_token = SWP_Credential_Helper::get_token('twitter');
		$consumer_secret = SWP_Credential_Helper::get_token('twitter', 'access_secret');

		$connection = new Abraham\TwitterOAuth\TwitterOAuth($swp_api_key, $swp_api_secret, $consumer_access_token, $consumer_secret);
		$cursor = -1; // See note below
		$params = array( 'screen_name' => $this->username, 'cursor' => $cursor );
		$response = $connection->get('followers/ids', $params);

		if ( isset( $response->errors ) ) {
			return false;
		}

		if ( is_array( $response->ids ) ) {
			$this->follow_count += count( $response->ids);
		}

		/**
		 * Max pagination is 5000. If a 'next_cursor' field exists, use that to
		 * continue reading followers. Providing $cursor = -1 tells Twitter that
		 * we are prepared to use a cursor for pagination.
		 *
		 * When there are no more pages, 'next_cursor' == 0.
		 *
		 */
		while ( !empty( $next_cursor ) && $response->next_cursor != 0 ) {

			$params['cursor'] = $response->next_cursor;

			$response = $connection->get('followers/ids', $params);

			if ( is_array( $response->ids) ) {
				$this->follow_count += count( $response->ids);
			}
		}
	}


	/**
	 * Twitter-specific response handling.
	 *
	 * @since 1.0.0 | 15 JAN 2019 | Created.
	 * @param void
	 * @return int The follow count provided by Twitter, or 0.
	 *
	 */
	public function parse_api_response() {
		if ( empty( $this->follow_count ) ) {
			return 0;
		}

		return $this->follow_count;
	}
}
