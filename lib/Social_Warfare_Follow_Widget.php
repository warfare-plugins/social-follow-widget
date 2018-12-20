<?php
if ( !class_exists( 'Social_Warfare_Addon' ) ) {
	return;
}

class Social_Warfare_Follow_Widget extends Social_Warfare_Addon {

    public function __construct() {
		$this->name          = 'Social Warfare - Follow Me';
        $this->key           = 'social-follow-widget';
        $this->core_required = '3.5.0';
        $this->product_id    = 63157; // @TODO this is the Pro product id, SWFW needs its own.
        $this->version       = SWFW_VERSION;
        $this->filepath      = SWFW_PLUGIN_FILE;

		parent::__construct();

		if ($this->is_registered) {
			$this->init();
		}
	}

	public function init() {
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
		new SWFW_Follow_Widget();
	}

	public function load_assets() {
		wp_enqueue_style( 'swfw-style', SWFW_PLUGIN_URL . '/style.css' );
	}

	public function init_networks() {
		$networks = array(
			'Facebook',
			'Pinterest',
			'Reddit',
			'Twitter',
		    'Tumblr'
		);

		$this->load_files( '/lib/networks/', $networks, true );
	}

	/**
	 * Loads an array of related files.
	 *
	 * @param  string   $path  The relative path to the files home.
	 * @param  array    $files The name of the files (classes), no vendor prefix.
	 * @return none     The files are loaded into memory.
	 *
	 */
	private function load_files( $path, $files, $instantiate = false ) {
		foreach( $files as $file ) {
			//* Add the vendor prefix to the file name.
			$class = "SWFW_" . $file;
			require_once SWFW_PLUGIN_DIR . $path . $class . '.php';

			if ( $instantiate ) {
				new $class();
			}
		}
	}
}
