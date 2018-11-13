<?php
if ( class_exists( 'SWFW_Follow_Widget' ) ) {
	exit;
}

class SWFW_Follow_Widget {

    public function __construct() {
		$this->load_files( '/lib/', array( 'SWFW_Follow_Network' ) );
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
