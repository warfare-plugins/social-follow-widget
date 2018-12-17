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
		$networks = apply_filters( 'swfw_follow_networks', array() );

		$html .= '<form></form>';
        return $html;
	}

	function generate_widget_HTML( $args, $settings ) {
		$html = '<h1>I am a widget!</h1>';
		$html .= '<pre>widget</pre>';
        return $html;
	}

	/**
    * Handler for saving new settings.
    *
	* By default will always save changed settings.
	* Please override in child class to filter and sanitize data.
    *
    * @since  1.0.0
    * @access public
    * @param  array $new_instance Updated values as input by the user in WP_Widget::form()
    * @param  array $old_instance Previously set values.
    * @return array The new values to store in the database.
    *
    */
	public function update( $new_settings = array(), $old_settings  = array()) {
		if ($new_settings == $old_settings) {
			return false;
		}

		return $new_settings;
	}
}
