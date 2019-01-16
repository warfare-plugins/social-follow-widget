<?php

/**
 * SWFW_Tumblr
 *
 * This provides an interface for creating a follow button for Pinterst.
 *
 * @package   social-follow-widget
 * @copyright Copyright (c) 2019, Warfare Plugins, LLC
 * @license   GPL-3.0+
 * @since     1.0.0 | Created
 *
 */
class SWFW_Tumblr extends SWFW_Follow_Network {


	/**
	 * Applies network-specific data to the SWFW_Follow_Network
	 *
	 * @since 1.0.0 | 03 DEC 2018 | Created.
	 * @see SWFW_Follow_Network
	 * @param void
	 * @return void
	 *
	 */
	public function __construct() {
		$network = array(
			'key' => 'tumblr',
			'name' => 'Tumblr',
			'cta' => 'Follow',
			'follow_description' => 'Followers',
			'color_primary' => '#39475D',
			'color_accent' => '#27313F',
			'url'	=> 'https://swfw_username.tumblr.com',
			'needs_authorization' => true

		);

		parent::__construct( $network );
		// $x = SWP_Credential_Helper::get_token( 'tumblr', 'client_token' );
		// die(var_dump($x));
	}


	/**
	 * Pinterest-specific request_url.
	 *
	 * @since 1.0.0 | 15 JAN 2019 | Created.
	 * @param void
	 * @return mixed The request URL if credenetials exist, else bool `false`.
	 *
	 */
	public function get_api_link() {
		$access_token = $this->auth_helper->get_access_token();
		if ( false == $access_token ) {
			return false;
		}

		// Only pass in `id` for the fields parameter to reduce their SQL query.
		return 'https://api.tumblr.com/v2/blog/'.$this->username.'/followers';
	}


	/**
	 * Pinterest-specific response handling.
	 *
	 * @since 1.0.0 | 15 JAN 2019 | Created.
	 * @param void
	 * @return int The follow count provided by Pinterest, or 0.
	 *
	 */
	public function parse_api_response() {
		if ( empty( $this->response ) ) {
			return 0;
		}

		$this->response = json_decode( $this->response );

		if ( $this->response->meta != 'OK' ) {
			return 0;
		}

		return count( $this->response->data );
	}

}
