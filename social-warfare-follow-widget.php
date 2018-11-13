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
define( 'SWFM_VERSION' , '3.3.92' );
define( 'SWFM_PLUGIN_FILE', __FILE__ );
define( 'SWFM_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'SWFM_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'SWFM_STORE_URL', 'https://warfareplugins.com' );


// Load the main Social_Warfare class and fire up the plugin.
if ( file_exists( SWFM_PLUGIN_DIR . '/lib/SWFW_Follow_Widget.php' ) ) {
	require_once SWFM_PLUGIN_DIR . '/lib/SWFW_Follow_Widget.php';
}
else {
	die("File does not exist.");
}
// new SWFW_Follow_Widget();
