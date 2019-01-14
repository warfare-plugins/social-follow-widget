<?php
/**
 * This creates the opening and closing HTML for the follow container.
 *
 * It calls on each individual SWFW_Follow_Network's render_html() to
 * fill the container with buttons.
 *
 */
class SWFW_Follow_Container {


	/**
	 * The fully qualified HTML to produce this node.
	 * @var [type]
	 */
	public $html;


	/**
	 * Applys a WordPress hook for the_content.
	 *
	 * @since 1.0.0 | 03 DEC 2018 | Created.
	 * @hook filter | the_content | Origin WP Core.
	 * @return void
	 *
	 */
	public function __construct() {
		add_filter('the_content', array( $this, 'render_html') );
	}


	/**
	 * Instantiates the HTML for the follow container.
	 *
	 * @since 3.5.0 | 26 NOV 2018 | Created.
	 * @see $this->close_container()
	 * @return void
	 *
	 */
	public function open_container() {
		$message = "Follow us on social media!";
		$style = 'block';

		$this->html  = "<div class='swfw-follow-container-wrap'>";
			$this->html .= "<p class='swfw-container-message'>$message</p>";
			$this->html .= "<div class='swfw-follow-container $style'>";
	}


	/**
	 * Adds HTML to $this->html.
	 *
	 * @since 1.0.0 | 03 DEC 2018 | Created.
	 * @param string $network The fully qualified social Follow Button HTML.
	 * @return void
	 *
	 */
	private function update_html( $network ) {
		$this->html .= $network->render_html;
	}


	/**
	 * Appends each network's HTML to the container's markup.
	 *
	 * global $swfw_networks originates from
	 * Social_Warfare_Follow_Widget->init().
	 * We expect it to be an array of SWFW_Follow_Network objects.
	 *
	 * @since 1.0.0 | 26 NOV 2018 | Created.
	 * @return void
	 *
	 */
	public function fill_container() {
		global $swfw_networks;

		foreach( $swfw_networks as $network ) {
			$this->html .= $network->render_html();
		}
	}


	/**
	 * Finished the HTML for the Follow Container.
	 *
	 * After this is called, the string stored in $this->html is
	 * fully qualified and ready for display.
	 *
	 * @since 1.0.0 | 26 NOV 2018 | Created.
	 * @see $this->open_container()
	 * @return void
	 *
	 */
	public function close_container() {
		$this->html .= '</div></div>';
	}


	/**
	 * Builds the HTML to display the Follow Container.
	 *
	 * @since 3.5.0 | 26 NOV 2018 | Created.
	 * @see $this->open_container()
	 * @return void
	 */
	public function render_html( $the_content ) {
		$this->open_container();
		$this->fill_container();
		$this->close_container();

		return $this->html . $the_content;
	}
}
