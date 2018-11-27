<?php

class SWFW_Follow_Container {

	/**
	 * The fully qualified HTML to produce this node.
	 * @var [type]
	 */
	public $html;

	public function __construct() {
		add_filter('the_content', array( $this, 'render_html') );
	}

	/**
     * Instantiates the HTML for the follow container.
     *
     * @since 3.5.0 | 26 NOV 2018 | Created.
     * @see $this->close_container()
     * @return void
     */
    public function open_container() {
		$message = "Follow us on social media!";

		$this->html  = "<div class='swfw-follow-container-wrap'>";
			$this->html .= "<p class='swfw-container-message'>$message</p>";
			$this->html .= "<div class='swfw-follow-container irregular'>";
	}

	private function update_html( $network ) {
		$this->html .= $network->render_html;
	}

    /**
     * Appends each network's HTML to the container's markup.
     *
     * @since 3.5.0 | 26 NOV 2018 | Created.
     * @return void
     */
	public function fill_container() {
		global $swfw_networks;

		foreach( $swfw_networks as $network ) {
			$this->html .= $network->render_html();
		}
	}

	public function close_container() {
        $this->html .= '</div></div>';
	}

	/**
     * Closes the opening div for the follow container.
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
