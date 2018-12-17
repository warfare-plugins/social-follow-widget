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
		$this->key = 'reddit';
		$this->name = 'Reddit';
		$this->cta = 'Follow';
		$this->follow_description = 'Followers';
		$this->color_primary = '#EF4A23';
		$this->color_accent = '#D33F27';

		parent::__construct();

        $this->base_follow_url = 'https://Reddit.com/' . $this->follow_query;
	}
}
