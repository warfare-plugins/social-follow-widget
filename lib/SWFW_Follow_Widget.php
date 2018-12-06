<?php
if (!class_exists( 'SWP_Maybe_Widget' ) ) {
	return;
}

// class SWFW_Follow_Widget extends SWP_Maybe_Widget {
class SWFW_Follow_Widget extends WP_Widget {
	function __construct() {
		$args = array(
			'key' => 'social_warfare_follow_widget',
			'name'	=> 'Social Warfare Follow Widget',
		);

		// parent::__construct( $args );
		parent::__construct( false, $name = 'FINDERR22' );

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
