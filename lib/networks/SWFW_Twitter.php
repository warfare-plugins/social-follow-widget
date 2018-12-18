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
    public function __construct() {
		$network = array(
			'key' => 'twitter',
			'name' => 'Twitter',
			'cta' => 'Follow',
			'follow_description' => 'Followers',
			'color_primary' => '#429BD5',
			'color_accent' => '#3C87B2',
			'url'	=> 'https://twitter.com/'
		);

		parent::__construct( $network );
	}
}
