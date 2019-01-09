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
			'url'	=> 'https://vimeo.com/swfw_username'
		);

		parent::__construct( $network );
	}
}
