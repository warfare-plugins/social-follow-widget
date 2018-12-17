<?php
if ( !class_exists( 'Social_Warfare_Addon' ) ) {
	return;
}

class Social_Warfare_Follow_Widget extends Social_Warfare_Addon {

    public function __construct() {
		global $swfw_networks;

		$swfw_networks = array();

		$files = array(
			'Follow_Network',
			'Follow_Container',
			'Follow_Widget'
		);

		$this->load_files( '/lib/', $files );

		add_action( 'wp_enqueue_scripts', array( $this, 'load_assets' ) );
		$this->init_networks();
		// new SWFW_Follow_Container();
		new SWFW_Follow_Widget();
	}

	function load_assets() {
		wp_enqueue_style( 'swfw-style', SWFW_PLUGIN_URL . '/style.css' );
	}

	function init_networks() {
		$networks = array(
			'Facebook',
			'Pinterest',
			'Reddit',
			'Twitter',
		    'Tumblr'
		);


		foreach( $networks as $network ) {
			$this->load_files( '/lib/networks', $networks );
		}
	}

	/**
	 * Loads an array of related files.
	 *
	 * @param  string   $path  The relative path to the files home.
	 * @param  array    $files The name of the files (classes), no vendor prefix.
	 * @return none     The files are loaded into memory.
	 *
	 */
	private function load_files( $path, $files ) {
		foreach( $files as $file ) {
			//* Add the vendor prefix to the file name.
			$file = "SWFW_" . $file;
			require_once SWFW_PLUGIN_DIR . $path . $file . '.php';
		}
	}
}
