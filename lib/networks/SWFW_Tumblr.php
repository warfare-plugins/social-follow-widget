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
		$this->key = 'tumblr';
		$this->name = 'Tumblr';
		$this->cta = 'Follow';
		$this->follow_description = 'Followers';
		$this->color_primary = '#39475D';
		$this->color_accent = '#27313F';

		parent::__construct();

        $this->base_follow_url = 'https://tumblr.com/' . $this->follow_query;
	}
}
