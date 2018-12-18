<?php

/**
 * SWFW_Reddit
 *
 * This provides an interface for creating a follow button for Reddit.
 *
 * @package   social-follow-widget
 * @copyright Copyright (c) 2019, Warfare Plugins, LLC
 * @license   GPL-3.0+
 * @since     1.0.0 | Created
 *
 */

class SWFW_Reddit extends SWFW_Follow_Network {
    public function __construct() {
		$network = array(
			'key' => 'reddit',
			'name' => 'Reddit',
			'cta' => 'Follow',
			'follow_description' => 'Followers',
			'color_primary' => '#EF4A23',
			'color_accent' => '#D33F27',
			'url'	=> 'https://reddit.com/user/swfw_username'
		);

		parent::__construct( $network );
	}
}
