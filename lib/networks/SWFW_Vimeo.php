<?php

/**
 * SWFW_Vimeo
 *
 * This provides an interface for creating a follow button for Vimeo.
 *
 * @package   social-follow-widget
 * @copyright Copyright (c) 2019, Warfare Plugins, LLC
 * @license   GPL-3.0+
 * @since     1.0.0 | Created
 *
 */
class SWFW_Vimeo extends SWFW_Follow_Network {


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
			'key' => 'vimeo',
			'name' => 'Vimeo',
			'cta' => 'Follow',
			'follow_description' => 'Followers',
			'color_primary' => '#1ab7ea',
			'color_accent' => '#162221',
			'url'	=> 'https://vimeo.com/swfw_username',
			'needs_authorization' => true
		);

		parent::__construct( $network );
	}


	/**
	 * Vimeo-specific request_url.
	 *
	 * Since Vimeo requies Authentication headers, we will go ahead and
	 * immediately make the request here. The returned value indicates
	 * whether or not the response had a body.
	 *
	 * @since 1.0.0 | 15 JAN 2019 | Created.
	 * @param void
	 * @return void;
	 *
	 */
	public function do_api_request() {
		$access_token = $this->auth_helper->get_access_token();

		if ( empty ( $this->username ) ) {
			return false;
		}

		if ( false == $access_token ) {
			return false;
		}

		$url = "https://api.vimeo.com/users/{$this->username}/followers";
		$headers = array('Content-Type: application/json' , "Authorization: Bearer $access_token" );
		$this->response = SWP_CURL::file_get_contents_curl( $url, $headers );
		error_log('Response for Vimeo with username ' . $this->username . ': ' . var_export( $this->response, 1));
	}


	/**
	 * Vimeo-specific response handling.
	 *
	 * @since 1.0.0 | 15 JAN 2019 | Created.
	 * @param void
	 * @return int The follow count provided by Vimeo, or 0.
	 *
	 */
	public function parse_api_response() {
		if ( empty( $this->response ) ) {
			return "000";
		}

		$this->response = json_decode( $this->response );

		if ( empty( $this->response->total ) ) {
			return "00000";
		}

		return (int) $this->response->total;
	}
}
