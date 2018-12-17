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
 * @since 3.0.0 | 05 APR 2018 | Created
 *
 */
class SWFW_Follow_Network {
	/**
	 * SWP_Debug_Trait provides useful tool like error handling.
	 *
	 */
	// use SWP_Debug_Trait;


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
	 * The generated html for the button
	 *
	 * After the first time the HTML is generated, we will store it in this variable
	 * so that when it is needed for the second or third panel on the page, the render
	 * html method will not have to make all the computations again.
	 *
	 * The html will be stored in an array indexed by post ID's. For example $this->html[27]
	 * will contain the HTML for this button that was generated for post with 27 as ID.
	 *
	 * @var array
	 *
	 */
	public $html_store = array();


	/**
	 * The Base URL for followin a user on this network
	 *
	 * This will allow us to generate the follow link for networks that only use just
	 * one URL parameter, the URL to the post. This way we can use a boilerplate method
	 * for generating the follow links here in the parent class and will only have to
	 * overwrite that method in child classes that absolutely need it.
	 *
	 * @var string
	 *
	 */
	public $base_follow_url = '';

    /**
     * Whether or not to show the share count for this network.
     *
     * @var boolean $show_shares;
     */
    public $show_shares = false;

	public function __construct( $args ) {
		global $swfw_networks;

		//* $args must have keys and values for each of these.
		$required = array( 'key', 'name', 'cta', 'url' );

		foreach( $args as $key => $value ) {
			//* Show that we included $key.
			$index = array_search( $key, $required);

			if ( is_numeric( $index ) ) {
				unset($required[$index]);
			}

			$this->$key = $value;
		}

		// If all the required fields were not provided, we'll send a message and bail.
		if ( count( $required ) > 0 ) {
			error_log("SWFW_Follow_Network requires these keys when constructing, which you are missing: ");

			foreach ( $required as $required_key ) {
				error_log( $required_key );
			}

			return;
		}

		$swfw_networks[] = $this;
	}

	function generate_url() {
		return str_replace( 'swfw_username', $this->username, $this->url);
	}

	function is_active() {
		return !empty( $this->username );
	}

	/**
	 * A method to add this network object to the globally accessible array.
	 *
	 * @since  3.0.0 | 06 APR 2018 | Created
	 * @param  none
	 * @return none
	 * @access public
	 *
	 */
	public function add_to_global() {


	}

	/**
	 * A function to run when the object is instantiated.
	 *
	 * @since  3.0.0 | 06 APR 2018 | Created
	 * @param  none
	 * @return none
	 * @access public
	 *
	 */
	public function init_social_network() {

	}


	/**
	 * A method for providing the object with a name.
	 *
	 * @since 3.0.0 | 05 APR 2018 | Created
	 * @param string $value The name of the object.
	 * @return object $this Allows chaining of methods.
	 * @access public
	 *
	 */
	public function set_name( $value ) {

    }


	/**
	 * A method for updating this network's default property.
	 *
	 * @since 3.0.0 | 05 APR 2018 | Created
	 * @param bool $value The default status of the network.
	 * @return object $this Allows chaining of methods.
	 * @access public
	 *
	 */
	public function set_default( $value ) {

	}


	/**
	 * A method for updating this network's key property.
	 *
	 * @since 3.0.0 | 05 APR 2018 | Created
	 * @param string $value The key for the network.
	 * @return object $this Allows chaining of methods.
	 * @access public
	 *
	 */
	public function set_key( $value ) {

	}


	/**
	 * A method for updating this network's premium property.
	 *
	 * @since 3.0.0 | 05 APR 2018 | Created
	 * @param string $value A string corresponding to the key of the dependant premium addon.
	 * @return object $this Allows chaining of methods.
	 * @access public
	 *
	 */
	public function set_premium( $value ) {

	}


	/**
	 * A method to return the 'active' status of this network.
	 *
	 * @since 3.0.0 | 06 APR 2018 | Created
	 * @param none
	 * @return bool
	 * @access public
	 *
	 */
	// is_active func


	/**
	 * A method to set the 'active' status of this network.
	 *
	 * @since 3.0.0 | 06 APR 2018 | Created
	 * @param none
	 * @return none
	 * @access public
	 *
	 */
	public function set_active_state() {

	}


	/**
	 * A method to save the generated HTML. This allows us to not have to
	 * run all of the computations every time. Instead, just reuse the HTML
	 * that was rendered by the method the first time it was created.
	 *
	 * @since  3.0.0 | 06 APR 2018 | Created
	 * @param  string  $html     The string of HTML to save in this property.
	 * @param  int     $post_id  The ID of the post that this belongs to.
	 * @return none
	 * @access public
	 *
	 */
	public function save_html( $html , $post_id ) {

	}

	/**
	 * Show Share Counts?
	 *
	 * A method to determine whether or not share counts need to be shown
	 * while rendering the HTML for this network's button.
	 *
	 * @since  3.0.0 | 06 APR 2018 | Created
	 * @param  array $array The array of data from the buttons panel.
	 * @return bool
	 * @access public
	 * @TODO Make it accept two parameters, both arrays, $options and $share_counts.
	 *
	 */
	public function is_share_count_shown( $array ) {

	}


	/**
	 * Create the HTML to display the share button
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $network_counts Associative array of 'network_key' => 'count_value'
	 * @return array $array The modified array which will now contain the html for this button
	 * @todo   Eliminate the array
	 *
	 */
	public function render_HTML() {
		// $this->set_active_state($options);
		if ( !$this->is_active() ) {
			// return '';
		}

		$style = 'rectangle';
		// what we want instead:  $style = SWFW_Utility::get_option('button_style');
		$network = $this->key;
		$network_icon = "<i class='sw swp_{$this->key}_icon'></i>";
		$count = number_format(rand(100, 300000));
		$cta = $this->cta;

        $icon_html = "<div class='swfw-network-icon'>$network_icon</div>";
		$count_html = "<div class='swfw-count'>$count</div>";
		$cta_html = "<div class='swfw-cta'>$cta</div>";
		$cta_button_html = '';

		if ( $style == 'rectangle' ) {
			$cta_html = "";
			$count_html = "<div class='swfw-count'>$count $this->follow_description</div>";
			$_cta_button = "<div class='swfw-cta-button'>$cta</div>";
		}

		if ( $style == 'irregular' ) {
			//* Just rearrange the order of elements. Is there a cleaner way to do this?
			$move_node = $cta_html;
			$cta_html = $count_html;
			$count_html = $move_node;
		}

        //* EOT syntax is lame but useful
		$button =
<<<BUTTON
<div class="swfw-follow-button $this->key" data-network="$this->key" color="$this->color_primary" data-accent-color="$this->color_accent">
	$icon_html
	<div class="swfw-text">
    	$count_html
		$cta_html
	</div>
	$cta_button_html
</div>
BUTTON;

		return $button;
	}


	/**
	 *
	 * Returns a boolean indicateding whether or not to display share counts.
	 *
	 * @since  3.0.0 | 18 APR 2018 | Created
	 * @since  3.3.0 | 24 AUG 2018 | Removed use of $options, calls SWP::Utility instead.
	 *
	 * @param  array $share_counts The array of share counts
	 * @param  array $options  DEPRECATED The array of options from the button panel object.
	 *
	 * @return bool  True if share counts should be displayed, else false.
	 *
	 */
	public function are_shares_shown( $share_counts , $options = array()) {

	}


	/**
	 * A method for processing URL's.
	 *
	 * This is designed to process the URL that is being shared onto the social
	 * platorms. It takes care of encoding, UTM parameters, link shortening, etc.
	 *
	 * @since  3.0.0 | 06 APR 2018 | Created
	 * @param  array $array  The array of data from the buttons panel.
	 * @return string        The processed URL.
	 *
	 */
	public function get_shareable_permalink( $post_data ) {
	}


	/**
	 * Generate the share link
	 *
	 * This is the link that is being clicked on which will open up the share
	 * dialogue. Thie method is only used for networks that use this exact same pattern.
	 * For anything that accepts more than just the post permalink as a URL parameter,
	 * those networks will have to overwrite this method with their own custom method
	 * in their respective child classes.
	 *
	 * @since  3.0.0 | 08 APR 2018 | Created
	 * @param  array $array The array of information passed in from the buttons panel.
	 * @return string The generated link
	 * @access public
	 *
	 */
	public function generate_share_link( $post_data ) {

	}


	/**
	 * Generate the API Share Count Request URL
	 *
	 * For most social networks, the api link is unique and this method will need to be
	 * overwritten in their respective child classes. However, for any networks that do
	 * not support share counts, having the method here in the parent class will allow
	 * us to simply use this one without have to write a new one in each child class.
	 *
	 * @since  3.0.0 | 08 APR 2018 | Created
	 * @access public
	 * @param  string $url The permalink of the page or post for which to fetch share counts
	 * @return string $request_url The complete URL to be used to access share counts via the API
	 *
	 */
	public function get_api_link( $url ) {

	}


	/**
	 * Parse the response to get the share count
	 *
	 * For most social networks, parsing of the API response needs to be a unique method
	 * that is declared in each network's child class. However, we are including it here
	 * for all networks that do not support share counts at all. If a network does not
	 * support share count fetching, then it can just use the method defined here in the
	 * parent class.
	 *
	 * @since  3.0.0 | 08 APR 2018 | Created
	 * @access public
	 * @param  string $response The raw response returned from the API request
	 * @return int $total_activity The number of shares reported from the API
	 *
	 */
	public function parse_api_response( $response ) {

	}

}
