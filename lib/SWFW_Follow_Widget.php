<?php
if (!class_exists( 'SWP_Maybe_Widget' ) ) {
	return;
}

class SWFW_Follow_Widget extends SWP_Maybe_Widget {
	function __construct() {
		$this->args = array(
			'key' => strtolower( __CLASS__ ),
			'name'	=> 'Social Warfare: Follow Widget',
		);

		add_action('widgets_init', array( $this, 'register_self') );

		parent::__construct( $this->args );
	}

	function register_self() {
		register_widget( __CLASS__ );
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
