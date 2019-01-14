<?php


/**
 * SWP_Follow_Network
 *
 * This is the class that is used for adding new social networks to the
 * buttons which can be selected on the options page and rendered in the
 * panel of buttons.
 *
 * @package   SocialWarfare\Functions\Social-Networks
 * @copyright Copyright (c) 2018, Warfare Plugins, LLC
 * @license   GPL-3.0+
 * @since 1.0.0 | 05 APR 2018 | Created
 *
 */
class SWFW_Follow_Network {


	/**
	 * SWP_Debug_Trait provides useful tool like error handling.
	 *
	 */
	use SWP_Debug_Trait;


	/**
	 * The display name of the social network
	 *
	 * This is the 'pretty name' that users will see. It should generally
	 * reflect the official name of the network according to the way that
	 * network is publicly branded.
	 *
	 * @var string
	 *
	 */
	public $name = '';


	/**
	 * The call to action text.
	 *
	 * This is the text that will appear on the button whenever it is
	 * hovered over. For example, Facebook says "share" and Google Plus
	 * says "+1".
	 *
	 * @var string
	 *
	 */
	public $cta = '';


	/**
	 * The snake_case name of the social network
	 *
	 * This is 'ugly name' of the network. This a snake_case key used for
	 * the purpose of eliminating spaces so that we can save things in the
	 * database and other such cool things.
	 *
	 * @var string
	 *
	 */
	public $key = '';


	/**
	 * The active status of this network
	 *
	 * If the user has this network activated on the options page, then this
	 * property will be set to true. If not, it will be set to false.
	 *
	 * @var bool
	 *
	 */
	public $active = false;


	/**
	 * The URL for following a user on this network.
	 *
	 * This will allow us to generate the follow link for networks that only use just
	 * one URL parameter, the URL to the post. This way we can use a boilerplate method
	 * for generating the follow links here in the parent class and will only have to
	 * overwrite that method in child classes that absolutely need it.
	 *
	 * @var string
	 *
	 */
	public $url = '';


	/**
	 * Whether or not to show the share count for this network.
	 *
	 * @var boolean $show_shares;
	 */
	public $show_shares = false;


	/**
	 * An instance of SWP_Auth_Controller for this network.
	 * @var object SWP_Auth_Controller
	 */
	public $auth_helper = null;

	/**
	 * Whether or not this network should request an oAuth access_token.
	 * @var bool $needs_authorization
	 */
	public $needs_authorization = false;


	/**
	 * Apply network arguments to create $this.
	 *
	 * To verify that all of the $required keys are provided,
	 * we we remove it from the array once it is found.
	 * If any items remain in the array, this Network does not meet our
	 * requirements to be built.
	 *
	 * @since 1.0.0 | 26 NOV 2018 | Created.
	 * @hook filter `swfw_follow_networks` | Array of SWFW_Follow_Network objects | applied in
	 * @return void
	 *
	 */
	public function __construct( $args ) {
		global $swfw_networks;

		$required = array( 'key', 'name', 'cta', 'url' );
		foreach( $args as $key => $value ) {
			$index = array_search( $key, $required );
			if ( is_numeric( $index ) ) {
				unset($required[$index]);
			}

			$this->$key = $value;
		}

		$this->network = $this->key;

		$this->establish_count();
		$this->establish_username();
		$this->establish_auth_helper();

		if ( count( $required ) > 0 ) {
			/**
			 *  If all the required fields were not provided, we'll send a message and bail.
			 *
			 */
			error_log("SWFW_Follow_Network requires these keys when constructing, which you are missing: ");
			foreach ( $required as $required_key ) {
				error_log( $required_key );
			}
			return;
		}

		add_filter( 'swfw_follow_networks', array( $this, 'register_self' ) );
	}


	/**
	 * A temporary helper until we get the real count.
	 */
	protected function establish_count() {
		if (!isset($this->count)) {
			$this->count = number_format(rand(100, 300000)) . '*';
		}
	}


	/**
	 * Fetches the stored username from the database, if it exists.
	 *
	 * Since there can be any number of copies of the same widget,
	 * we'll have to check each instance for the networks it uses.
	 *
	 * @since 3.5.0 | 03 JAN 2018 | Created.
	 * @param void
	 * @return bool True iff the username exists, else false.
	 *
	 */
	protected function establish_username() {
		$widgets = SWFW_Follow_Widget::get_widgets();

		foreach( $widgets as $key => $settings ) {
			if ( !empty( $settings[$this->key . '_username'] ) ) {
				return $this->username = $settings[$this->key . '_username' ];
			}
		}

		return false;
	}


	protected function establish_auth_helper() {
		if ( !class_exists( 'SWP_Auth_Helper' ) ) {
			/**
			 * This should not be reached, but is a safety mechanism.
			 */
			return;
		}

		/**
		 * There are no features for this network that require authorization.
		 */
		if ( false == $this->$needs_authorization ) {
			return;
		}

		$instance = new SWP_Auth_Helper( $this->network );
		add_filter( 'swp_authorizations', array( $instance, 'add_to_authorizations' ) );

		return $this->auth_helper = $instance;
	}


	/**
	 * Adds $this to the array of other used Network objects.
	 *
	 * @since  1.0.0 | 06 APR 2018 | Created
	 * @hook   filter| swp_follow_networks | Applied in SWFW_Follow_Widget
	 * @param  array $networks All of the created Social Follow Network classes.
	 * @return array $networks With `$this` network in the array.
	 * @access public
	 *
	 */
	public function register_self( $networks ) {
		return array_merge( $networks, array( $this ) );
	}


	/**
	 * Replaces the placeholder text 'swfw_username' with the actual username.
	 *
	 * @since  1.0.0 | 03 DEC 2018 | Created
	 * @hook   filter| swp_follow_networks | Applied in SWFW_Follow_Widget
	 * @param void
	 * @return string A URL which goes to the 'Follow' page for this network.
	 *
	 */
	function generate_url() {
		return str_replace( 'swfw_username', $this->username, $this->url);
	}


	/**
	 * Indicates that this Network is used if a username is provided.
	 *
	 * @since  1.0.0 | 03 DEC 2018 | Created
	 * @param void
	 * @return bool True if this network has a username in the DB, else false.
	 *
	 */
	function is_active() {
		return !empty( $this->username );
	}


	/**
	 * A controller for generating button html.
	 *
	 * This will read the user's options, and the apply the appropriate
	 * callback method to generate a button of a particular shape.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $network_counts Associative array of 'network_key' => 'count_value'
	 * @return array $array The modified array which will now contain the html for this button
	 * @todo   Eliminate the array
	 *
	 */
	function generate_frontend_HTML( $shape ) {
		if ( !$this->is_active() ) {
			return '';
		}

		$generate = "generate_" . $shape . "_HTML";
		return $this->$generate();
	}


	/**
	 * Renders Square button HTML.
	 *
	 * @since  1.0.0 | 03 DEC 2018 | Created
	 * @access private | This is the only class that should ever render follow button HTML.
	 * @param void
	 * @return string Fully qualified HTML for a Square follow button.
	 * @TODO This needs an <a> tag!!!!
	 *
	 */
	private function generate_square_HTML( ) {
		$background = "background-color: $this->color_primary";
		$border = "border: 1px solid $this->color_accent";

		return
<<<BUTTON
<a target="_blank" href="{$this->generate_url()}">
	<div class="swfw-follow-button square $this->key" style="$border; $background">
		<div class='swfw-network-icon'>
			<i class='sw swp_{$this->key}_icon'></i>
		</div>

		<div class="swfw-text">
			<span class='swfw-count'>$this->count</span>
			<span class='swfw-cta'>$this->cta</span>
		</div>
	</div>
</a>
BUTTON;
	}


	/**
	 * Renders Rectangle button HTML.
	 *
	 * @since  1.0.0 | 03 DEC 2018 | Created
	 * @access private | This is the only class that should ever render follow button HTML.
	 * @param void
	 * @return string Fully qualified HTML for a Square follow button.
	 *
	 */
	private function generate_rectangle_HTML( ) {
		// what we want instead:  $style = SWFW_Utility::get_option('button_style');
		$background = "background-color: $this->color_primary";
		$border = "border: 1px solid $this->color_accent";

		return
<<<BUTTON
<div class="swfw-follow-button rectangle $this->key" style="$background; $border">
	<div class='swfw-network-icon'>
		<i class='sw swp_{$this->key}_icon'></i>
	</div>

	<div class="swfw-text">
		<p class='swfw-count' style='margin: 0'>$this->count $this->follow_description</p>
	</div>

	<div class='swfw-cta-button'>
		<a target="_blank" href="{$this->generate_url()}">$this->cta</a>
	</div>
</div>
BUTTON;
	}


	/**
	 * Renders Irregular button HTML.
	 *
	 * @since  1.0.0 | 03 DEC 2018 | Created
	 * @access private | This is the only class that should ever render follow button HTML.
	 * @param void
	 * @return string Fully qualified HTML for an Irregular follow button.
	 *
	 */
	public function generate_irregular_HTML( ) {
		$background = "background-color: $this->color_primary";
		$border = "border: 1px solid $this->color_accent";

		return
<<<BUTTON
<a target="_blank" href="{$this->generate_url()}">
	<div class="swfw-follow-button irregular $this->key" style="$background; $border">
		<div class='swfw-network-icon'>
			<i class='sw swp_{$this->key}_icon'></i>
		</div>

		<div class="swfw-text">
			<span class='swfw-cta'>$this->cta</span>
			<span class='swfw-count'>$this->count</span>
		</div>
	</div>
</a>
BUTTON;
	}
}
