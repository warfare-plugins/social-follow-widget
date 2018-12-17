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
    public function __construct() {
		$this->key = 'pinterest';
		$this->name = 'Pinterest';
		$this->cta = 'Follow';
		$this->follow_description = 'Followers';
		$this->color_primary = '#CC2029';
		$this->color_accent = '#AB1F25';

		parent::__construct();

        $this->base_follow_url = 'https://pinterest.com/' . $this->follow_query;
	}
}
