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
        $network = array(
			'key' =>  'facebook',
			'name' =>  'Facebook',
			'cta' =>  'Like',
			'follow_description' =>  'Fans',
			'color_primary' =>  '#3A589E',
			'color_accent' =>  '#314E84',
			'url'	=> 'https://facebook.com'
		);


		parent::__construct( $network );
	}
}
