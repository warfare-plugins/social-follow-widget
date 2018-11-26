<?php

class SWFW_Follow_Container {

	/**
	 * The fully qualified HTML to produce this node.
	 * @var [type]
	 */
	public $html;

	public function __construct() {

	}

	/**
     * Instantiates the HTML for the follow container.
     *
     * @since 3.5.0 | 26 NOV 2018 | Created.
     * @see $this->close_container()
     * @return void
     */
    public function open_container() {
        $this->html = '<div class="swfw-follow-container">';
	}

    /**
     * Appends each network's HTML to the container's markup.
     *
     * @since 3.5.0 | 26 NOV 2018 | Created.
     * @return void
     */
	public function fill_container() {

	}

	public function close_container() {
        $this->html .= '</div>';
	}

	/**
     * Closes the opening div for the follow container.
     *
     * @since 3.5.0 | 26 NOV 2018 | Created.
     * @see $this->open_container()
     * @return void
     */
	public function render_html() {
		return $this->html;
	}
}
