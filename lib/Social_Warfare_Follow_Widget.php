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
			array(
				'key' => 'tumblr',
				'name' => 'Tumblr',
				'cta' => 'Like',
				'follow_description'	=> 'Fans',
				'color_primary' => '#39475D',
				'color_accent' => '#27313F',
				'url'	=> 'https://tumblr.com'
			),
			array(
				'key' => 'pinterest',
				'name' => 'Pinterst',
				'cta' => 'Follow',
				'follow_description'	=> 'Followers',
				'color_primary' => '#CC2029',
				'color_accent' => '#CC#AB1F25',
				'url'	=> 'https://pinterest.com'
			),
			array(
				'key' => 'twitter',
				'name' => 'Twitter',
				'cta' => 'Follow',
				'follow_description'	=> 'Followers',
				'color_primary' => '#429BD5',
				'color_accent' => '#3C87B2',
				'url'	=> 'https://twitter.com'
			),
			array(
				'key' => 'reddit',
				'name' => 'Reddit',
				'cta' => 'Follow',
				'follow_description'	=> 'Followers',
				'color_primary' => '#EF4A23',
				'color_accent' => '#D33F27',
				'url'	=> 'https://reddit.com'
			)
		);

        //* duplicate dummy networks for now to fill out the container.
		$networks = array_merge( $networks, $networks);
		// $networks = array_merge( $networks, $networks);


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
