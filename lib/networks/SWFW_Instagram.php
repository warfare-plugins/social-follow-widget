<?php

/**
 * SWFW_Instagram
 *
 * This provides an interface for creating a follow button for Instagram.
 *
 * @package   social-follow-widget
 * @copyright Copyright (c) 2019, Warfare Plugins, LLC
 * @license   GPL-3.0+
 * @since     1.0.0 | Created
 *
 */
class SWFW_Instagram extends SWFW_Follow_Network {


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
			'key' => 'instagram',
			'name' => 'Instagram',
			'cta' => 'Follow',
			'follow_description' => 'Followers',
			'color_primary' => '#5851db',
			'color_accent' => '#c13584',
			'url'	=> 'https://instagram.com/swfw_username',
			'needs_authorization' => true
		);

		parent::__construct( $network );
		die(var_dump(SWP_Credential_Helper::get_access_token('instagram')));
	}


	/**
	 * Instagram-specific request_url.
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
		return 'https://api.instagram.com/v1/users/self/?access_token='.$access_token;
	}


	/**
	 * Instagram-specific response handling.
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

		if ( empty ( $this->response->data ) || empty( $this->response->data->counts ) ) {
			return 0;
		}

		if ( empty( $this->response->data->counts->followed_by ) ) {
			return false;
		}

		return $this->response->data->counts->followed_by;
	}
}
