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

		$this->defaults = array(
			'title' => 'Follow me on social media'
		);

		parent::__construct( $key, $name, $widget );
	}

	function generate_form_HTML( $settings, $html = '' ) {
		$networks = apply_filters( 'swfw_follow_networks', array() );

		foreach( $networks as $network ) {
			$name = "swp_{$network->key}_follow_username";
			$value = isset($settings[$name]) ? $settings[$name] : '';
		    $html .= $network->generate_backend_HTML( $name, $value );
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
	    $updated_settings = array_merge($old_settings, $new_settings);
		return $new_settings;
		if ($updated_settings == $old_settings) {
			return $old_settings;
		}

		return $updated_settings;
	}
}
