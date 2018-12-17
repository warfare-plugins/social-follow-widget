<?php
if (!class_exists( 'SWP_Widget' ) ) {
	return;
}

class SWFW_Follow_Widget extends SWP_Widget {
	function __construct() {
		$this->args = array(
			'key' => strtolower( __CLASS__ ),
			'name'	=> 'Social Warfare: Follow Widget',
		);

		parent::__construct( $this->args );
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
