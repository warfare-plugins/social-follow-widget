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
	}
}
