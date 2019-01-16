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
		$this->get_api_link();
		$this->parse_api_response();
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
	public function get_api_link() {
		$access_token = $this->auth_helper->get_access_token();

		if ( empty ( $access_token ) ) {
			// die('no toke');
			return false;
		}

		// $client_key = 'QcnQ0AFCuhsPPUHrrs3dOYRcP';
		// $client_secret = 'FLX7TbylCISQAgQac4N0rRuIKtcNr157loUT9OVVWYa6SQ6fCz';

		$url = "https://api.twitter.com/1.1/followers/ids.json";
		$headers = array('Content-Type: application/json' , "Authorization: Bearer $access_token" );
		$this->response = SWP_CURL::file_get_contents_curl( $url, $headers );

		return (bool) $this->response;
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
		if ( empty( $this->response ) ) {
			return 0;
		}

		$this->response = json_decode( $this->$response );

		die(var_dump(' response: ', $this->response));
	}
}
