<?php
/**
 * Plugin Name: Social Warfare - Follow Widget
 * Plugin URI:  https://warfareplugins.com
 * Description: A plugin to maximize social shares and drive more traffic using the fastest and most intelligent share buttons on the market, calls to action via in-post click-to-tweets, popular posts widgets based on share popularity, link-shortening, Google Analytics and much, much more!
 * Version:     0.0.1
 * Author:      Warfare Plugins
 * Author URI:  https://warfareplugins.com
 * Text Domain: social-warfare-follow-me
 *
 */

defined( 'WPINC' ) || die;

/**
 * Define plugin constants for use throughout the plugin (Version and Directories)
 *
 */
define( 'SWFW_VERSION' , '3.3.92' );
define( 'SWFW_PLUGIN_FILE', __FILE__ );
define( 'SWFW_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'SWFW_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'SWFW_STORE_URL', 'https://warfareplugins.com' );


/**
 * We defer the loadin of this addon to ensure the Social Warfare (core) has
 * been fully loaded prior to instantiatin this plugin. As such, we now have
 * access to the registration functions, the update checker, and the
 * Social_Warfare_Addon class.
 *
 */
add_action('pluins_loaded', 'swfw_initiate_plugin', 20);
function swfw_initiate_plugin() {

	// Load the main Social_Warfare class and fire up the plugin.
	if ( file_exists( SWFW_PLUGIN_DIR . '/lib/Social_Warfare_Follow_Widget.php' ) ) {
		require_once SWFW_PLUGIN_DIR . '/lib/Social_Warfare_Follow_Widget.php';
		new Social_Warfare_Follow_Widget();
	}
	else {
		die("File does not exist.");
	}
}
