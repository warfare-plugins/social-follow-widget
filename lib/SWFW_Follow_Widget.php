<?php

class SWFW_Follow_Widget extends SWP_Maybe_Widget {
	function __construct() {
		$this->key = 'social_warfare_follow_widget';

		$args = array(
			'name'	=> 'Social Warfare Follow Widget'
		);

		parent::__construct();
	}

	function generate_form_HTML( $settings ) {
		$html = '<h1>I am a form!</h1>';
		$html .= '<form></form>';
        return $html;
	}

	function generate_widget_HTML( $args, $settings ) {
		$html = '<h1>I am a widget!</h1>';
		$html .= '<pre>widget</pre>';
        return $html;
	}
}
