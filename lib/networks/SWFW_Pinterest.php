<?php

/**
 * SWFW_Pinterest
 *
 * This provides an interface for creating a follow button for Pinterst.
 *
 * @package   social-follow-widget
 * @copyright Copyright (c) 2019, Warfare Plugins, LLC
 * @license   GPL-3.0+
 * @since     1.0.0 | Created
 *
 */
class SWFW_Pinterest extends SWFW_Follow_Network {


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
			'key' => 'pinterest',
			'name' => 'Pinterest',
			'cta' => 'Follow',
			'follow_description' => 'Followers',
			'color_primary' => '#CC2029',
			'color_accent' => '#AB1F25',
			'url'	=> 'https://pinterest.com/swfw_username',
			'needs_authorization' => true
		);

		parent::__construct( $network );
	}

	public function get_count_request_url() {
		$access_token = $this->auth_helper->get_access_token();
		if ( false == $access_token ) {
			return false;
		}

		// Only pass in `id` for the fields parameter to reduce their SQL query.
		return 'https://api.pinterest.com/v1/me/followers/?access_token='.$access_token.'&fields=id';
	}

	public function parse_request() {
		if ( empty( $this->response ) ) {
			return false;
		}

		if ( empty( $this->response->data || !is_array( $this->response->data) ) ) {
			return false;
		}

		return count( $this->response->data );
	}
}
