<?php
if (!class_exists( 'SWP_Widget' ) ) {
	return;
}

class SWFW_Follow_Widget extends SWP_Widget {
	function __construct() {
		$key = strtolower( __CLASS__ );
		$name = 'Social Follow by Warfare Plugins';

		$widget = array(
			'classname' => $key,
			'description' => 'Increase follower growth for your favorite social networks.',
		);

		parent::__construct( $key, $name, $widget );
	}

	function defaults() {
		$defaults = array();



		return [

		];
	}

	function generate_form_HTML( $settings ) {
		$networks = apply_filters( 'swfw_follow_networks', array() );
        $html = '';



		foreach( $networks as $network ) {
			$key = $key = "swp_{$this->key}_follow_username";
			$value = isset($settings[$key]) ? $settings[$key] : '';
		    $html .= $network->generate_backend_HTML( $value );
		}
        return $html;
	}

	function generate_widget_HTML( $args, $settings ) {
		$html = '<h1>I am a widget!</h1>';
		$networks = apply_filters( 'swfw_follow_networks', array() );

		foreach( $networks as $network ) {
		    $html .= $network->generate_frontend_HTML();
		}

        return $html;
	}

	/**
	* Inhereted from WP_Widget.
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
		error_log('new settings');
		error_log(var_export($new_settings, 1));
		error_log('old_settings');
		error_log(var_export($old_settings, 1));
		if ($new_settings == $old_settings) {
			return false;
		}

		return $new_settings;
	}
}
