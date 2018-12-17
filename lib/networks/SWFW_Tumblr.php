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
    public function __construct() {
		$network = array(
			'key' => 'tumblr',
			'name' => 'Tumblr',
			'cta' => 'Follow',
			'follow_description' => 'Followers',
			'color_primary' => '#39475D',
			'color_accent' => '#27313F',
			'url'	=> 'https://tumblr.com'
		);

		parent::__construct( $network );
	}
}
