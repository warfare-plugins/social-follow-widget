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

	function generate_form_title( $title = "Follow me on social media" ) {
		$wp_id = $this->get_field_id( 'title' );
		$wp_name = $this->get_field_name( 'title');

		return
<<<TITLE
<div class="swfw-input-field">
	<label for={$wp_id}>Widget Title</label>
	<input type="text" id="$wp_id" name="$wp_name" value="$title" placeholder="$title" />
</div>
TITLE;
	}

	function generate_shape_select($selection) {
		$wp_id = $this->get_field_id( 'shape' );
		$wp_name = $this->get_field_name( 'shape');

		$options =
<<<OPTIONS
	<option value='square'>Square</option>
    <option value='rectangle'>Rectangle</option>
	<option value='irregular'>Irregular</option>
OPTIONS;

		return
<<<SELECT
<div class="swfw-input-field">
	<label for={$wp_id}>Button Shape</label>
	<select id="$wp_id" name="$wp_name" value="$title">
        $options
	</select>
</div>
SELECT;
	}

	function generate_form_HTML( $settings = array() ) {
		$networks = apply_filters( 'swfw_follow_networks', array() );

		$html .= $this->generate_form_title($settings['title']);
		$html .= $this->generate_shape_select($settings['shape']);

		foreach( $networks as $network ) {
			$key = $network->key . '_username';
			$wp_id = $this->get_field_id( $key );
			$wp_name = $this->get_field_name( $key );
			$value = isset( $settings[$key]) ? $settings[$key] : '';
		    $field =
	//* (Must be left-aligned). EOT syntax is lame but useful.
<<<FIELD
<div class="swfw-follow-field">
    <div class="swfw-follow-field-icon"><i class="sw swp_{$network->key}_icon"></i></div>
    <label for="$wp_id">$network->name</label>
	<input id="$wp_id" name="$wp_name" type="text" placeholder="Username" value="$value"/>
</div>
FIELD;
	         $html .= $field;
		}

        return $html;
	}

	function generate_widget_title( $title ) {
		return "<h1>$title</h1>";
	}

	/**
    * Builds the widget, including data passed in from `register_sidebar`
    *
    * @since  1.0.0
    * @access public
    * @param  array $args     Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
    *                         These arguments are passed in from the `register_sidebar()` function.
	* @param  array $instance The settings for the particular instance of the widget.
    * @return string $html    The html to be echoed by the parent class.
    */
	function generate_widget_HTML( $settings ) {
		$shape = $settings['shape'];
		$html = "<div class='swfw-follow-container $shape'>";

		$networks = apply_filters( 'swfw_follow_networks', array() );
		$buttons = '';

		foreach($networks as $network) {
            $buttons .= $network->generate_frontend_HTML( $shape );
		}

		$html .= $buttons;
        return $html .= "</div>";
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
	    return $new_settings;
	}
}
