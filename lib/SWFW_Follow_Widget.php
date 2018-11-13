<?php
if ( class_exists( 'SWFW_Follow_Widget' ) ) {
	exit;
}

if ( !class_exists ( 'Social_Warfare_Addon' ) ) {
	throw new Exception( "Please install the latest version of Social Warfare before activating Follow Widget.");
}

class SWFW_Follow_Widget extends Social_Warfare_Addon {
    public function __construct() {
		die("laoding");
		$this->load_files( '/lib/', array( 'SWFW_Follow_Network' ) );

		$this->init_networks();
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

		array_map( $networks, 'SWFW_Follow_Network');
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
			$file = "SWFM_" . $file;
			require_once SWFW_PLUGIN_DIR . $path . $file . '.php';
		}
	}
}
