<?php
if ( !class_exists( 'Social_Warfare_Addon' ) ) {
	return;
}

class Social_Warfare_Follow_Widget extends Social_Warfare_Addon {

    public function __construct() {
		global $swfw_networks;
		
		$swfw_networks = array();

		$this->load_files( '/lib/', array( 'Follow_Network' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'load_assets' ) );
		$this->init_networks();
	}

	function load_assets() {
		wp_enqueue_style( 'swfw-style', SWFW_PLUGIN_URL . '/style.css' );
	}

	function init_networks() {
		$networks = array(
			array(
				'key'	=> 'facebook',
				'name'	=> 'Facebook',
				'cta'	=> 'Like',
				'color_primary'	=> '#3A589E',
				'color_accent'	=> '#314E84',
				'url'	=> 'xxx.com'
			),
			array(
				'key' => 'tumblr',
				'name' => 'Tumblr',
				'cta' => 'Like',
				'color_primary' => '#39475D',
				'color_accent' => '#27313F',
				'url'	=> 'yyy.com'
			),
			array(
				'key' => 'pinterest',
				'name' => 'Pinterst',
				'cta' => 'Follow',
				'color_primary' => '#CC2029',
				'color_accent' => '#CC#AB1F25',
				'url'	=> 'zzz.com'
			)
		);

		foreach( $networks as $network ) {
			new SWFW_Follow_Network( $network );
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
