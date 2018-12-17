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
		$this->key = 'twitter';
		$this->name = 'Twitter';
		$this->cta = 'Follow';
		$this->follow_description = 'Followers';
		$this->color_primary = '#429BD5';
		$this->color_accent = '#3C87B2';

		parent::__construct();

        $this->base_follow_url = 'https://twitter.com/' . $this->follow_query;

	}
}
