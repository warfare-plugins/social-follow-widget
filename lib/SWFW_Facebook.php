<?php

/**
 * SWFW_Facebook
 *
 * This provides an interface for creating a follow button for Facebook.
 *
 * @package   social-follow-widget
 * @copyright Copyright (c) 2019, Warfare Plugins, LLC
 * @license   GPL-3.0+
 * @since     1.0.0 | Created
 *
 */

class SWFW_Facebook extends SWFW_Follow_Network {
    public function __construct() {
		$this->key = 'facebook';
		$this->name = 'Facebook';
		$this->cta = 'Like';
		$this->follow_description = 'Fans';
		$this->color_primary = '#3A589E';
		$this->color_accent = '#314E84';

		parent::__construct();

        $this->base_follow_url = 'https://facebook.com/' . $this->follow_id;

	}

    public function render_HTML() {

	}
}
