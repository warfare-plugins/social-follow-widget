<?php
/**
 * Requres parent class provided by Social Warfare Core.
 *
 */
if (!class_exists( 'SWP_Widget' ) ) {
	return;
}


class SWFW_Follow_Widget extends SWP_Widget {


	/**
	 * Instantiates a WordPress Widget by providing $this data to SWP_Widget.
	 *
	 * @since 1.0.0 | 03 DEC 2018 | Created.
	 * @see social-warfare\lib\widgets\SWP_Widget::__construct()
	 * @param none
	 * @return void
	 *
	 */
	function __construct() {
		$key = strtolower( __CLASS__ );
		$name = 'Social Follow by Warfare Plugins';
		$widget = array(
			'classname' => $key,
			'description' => 'Increase follower growth for your favorite social networks.',
		);

		parent::__construct( $key, $name, $widget );
	}


	/**
	 * Fetches all instances of this widget.
	 *
	 * Since there can be any number of copies of the same widget,
	 * we'll have to check each instance for the networks it uses.
	 *
	 * @since 3.5.0 | 10 JAN 2018 | Created.
	 * @param void
	 * @return array List of all the user-created widgets for the site.
	 *
	 */
	public static function get_widgets() {
		$widgets = get_option( 'widget_swfw_follow_widget', array());

		foreach( $widgets as $key => $settings ) {
			// This is a wordress field, not a widget.
			if ( '_multiwidget' == $key ) {
				continue;
			}

			if ( is_numeric( $key ) ) {
				// This is an instance of a SWFW_Widget. Keep it in $widgets.
			}
			else {
				// Remove the non-widget from $widgets.
				unset($widgets[$key]);
			}
		}

		return $widgets;
	}


	/**
	 * Creates an input[type=text] which corresponds to the widget's display title.
	 *
	 * @since 1.0.0 | 03 DEC 2018 | Created.
	 * @param string $title The display title for the widget.
	 * @return string Fully qualified HTML to render the input.
	 *
	 */
	function generate_title_input( $title ) {
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


	/**
	 * Creates an input[type=select] which corresponds to the button shape.
	 *
	 * @since 1.0.0 | 03 DEC 2018 | Created.
	 * @param string $selection The currently selected button shape.
	 *                          One of ['square', 'block', 'buttons']
	 * @return string Fully qualified HTML to render the select.
	 *
	 */
	function generate_shape_select($selection) {
		$wp_id = $this->get_field_id( 'shape' );
		$wp_name = $this->get_field_name( 'shape' );

		$opts = array(
			'square'	=> 'Square',
			'block'	=> 'Block',
			'buttons'	=> 'Buttons'
		);

		$options_html = '';
		foreach($opts as $key => $name) {
			$selected = selected($selection, $key, false);
			$options_html .= "<option value='$key' $selected>$name</option>";
		}

		return
<<<SELECT
<div class="swfw-input-field">
	<label for={$wp_id}>Button Shape</label>
	<select id="$wp_id" name="$wp_name" value="$selection">
		$options_html
	</select>
</div>
SELECT;
	}

	/**
	 * Generates the backend display <form>.
	 *
	 * @since 1.0.0 | 03 DEC 2018 | Created.
	 * @param array $settings The settings as previously saved.
	 * @return string Fully qualified HTML to render the form.
	 *
	 */
	function generate_form_HTML( $settings ) {
		$networks = apply_filters( 'swfw_follow_networks', array() );
		$defaults = array(
			'title'	=> 'Follow me on social media',
			'shape'	=> 'square'
		);

		foreach($defaults as $key => $default) {
			if ( !isset( $settings[$key] ) ) {
				$settings[$key] = $default;
			}
		}

		$html = $this->generate_title_input($settings['title']);
		$html .= $this->generate_shape_select($settings['shape']);

		foreach( $networks as $network ) {
			$key = $network->key . '_username';
			$wp_id = $this->get_field_id( $key );
			$wp_name = $this->get_field_name( $key );
			$value = isset( $settings[$key]) ? $settings[$key] : '';
			$placeholder = isset( $this->placeholder ) ? $this->placeholder : 'Username';
			$field =
<<<FIELD
<div class="swfw-follow-field">
	<div class="swfw-follow-field-icon">{$network->icon_svg}</div>
	<label for="$wp_id">$network->name</label>
	<input id="$wp_id" name="$wp_name" type="text" placeholder="$placeholder" value="$value"/>
</div>
FIELD;
			 $html .= $field;
		}

		return $html;
	}

	/**
	 * Creates the frontend display title. Required by parent::widget().
	 *
	 * @since 1.0.0 | 03 DEC 2018 | Created.
	 * @param string $title The display title for the widget.
	 * @return string Fully qualified HTML for the display title.
	 *
	 */
	function generate_widget_title( $title ) {
		return "<h4>$title</h4>";
	}


	/**
	* Builds the front end display, including data passed in from `register_sidebar`
	*
	* `register_sidebar` could be called by the theme and pass in more data.
	*  This extra data is applied in parent::widget().
	*
	* @since  1.0.0 | 03 DEC 2018 | Created.
	* @access public
	* @hook   filter | swfw_follow_networks | Array of SWFW_Follow_Network objects.
	* @param  array $settings The settings as input & saved in the backend.
	* @return string $html Fully qualified HTML to display a Social Follow Widget.
	*
	*/
	function generate_widget_HTML( $settings ) {
		$shape = $settings['shape'];
		$html = "<div class='swfw-follow-container $shape'>";

		$networks = apply_filters( 'swfw_follow_networks', array() );
		$buttons = '';

		foreach($networks as $network) {
			if ( false == $network->is_active() ) {
				continue;
			}

			$key = $network->key.'_username';
			$buttons .= $network->generate_frontend_HTML( $shape );
		}

		$html .= $buttons;
		return $html .= "</div>";
	}


	/**
	* Inhereted from WP_Widget. Handler for saving new settings.
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
	public function update( $new_settings, $old_settings ) {
		foreach ($new_settings as $key => $value) {
			$new_settings[$key] = esc_html( $value );
		}

		return $new_settings;
	}
}
