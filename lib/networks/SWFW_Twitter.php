<?php

/**
 * SWFW_Twitter
 *
 * This provides an interface for creating a follow button for Twitter.
 *
 * @package   social-follow-widget
 * @copyright Copyright (c) 2019, Warfare Plugins, LLC
 * @license   GPL-3.0+
 * @since     1.0.0 | Created
 *
 */
class SWFW_Twitter extends SWFW_Follow_Network {


	/**
	 * Applies network-specific data to the SWFW_Follow_Network
	 *
	 * @since 1.0.0 | 03 DEC 2018 | Created.
	 * @see SWFW_Follow_Network
	 * @param void
	 * @return void
	 */
	public function __construct() {
		$network = array(
			'key' => 'twitter',
			'name' => 'Twitter',
			'cta' => 'Follow',
			'follow_description' => 'Followers',
			'color_primary' => '#429BD5',
			'color_accent' => '#3C87B2',
			'url'	=> 'https://twitter.com/swfw_username',
			'needs_authorization' => true
		);

		/**
		 * Debug code.
		 * Uncomment to delete the twitter tokens.
		 */
		// SWP_Credential_Helper::delete_token('twitter');
		// SWP_Credential_Helper::delete_token('twitter', 'access_secret');
		// die('Deleted!');

		parent::__construct( $network );

		/**
		 * Debug code.
		 * Uncomment to run the API request.
		 */
		// $this->test();
		// die;

	}


	/**
	 * Testing out the Twitter SDK.
	 * @see /lib/SDKs/Twitter/TwitterAPIExchange.php
	 * or https://github.com/J7mbo/twitter-api-php
	 */
	public function test() {
		ini_set('display_errors', 1);
		require_once __DIR__ . '/../SDKs/Twitter/TwitterAPIExchange.php';

		/**
		 * These keys are about to get committed to github.
		 * We can regenerate new ones when it works.
		 *
		 */
		$swp_token = 'e9s2lOAMBpOmxegN3PNoSSUmm';
		$swp_secret = 'Zj8nksxoC2lITOim7XWMZDI6wWviQHmhldB5ZlcfUmAIfd9Yc5';
		$access_token = SWP_Credential_Helper::get_token('twitter');
		$access_secret = SWP_Credential_Helper::get_token('twitter', 'access_secret');


		$settings = array(
			'oauth_access_token' => $swp_token,
			'oauth_access_token_secret' => $swp_secret,
			'consumer_key' => $access_token,
			'consumer_secret' => $access_secret
		);

		$twitter = new TwitterAPIExchange($settings);


		/** Perform a GET request and echo the response **/
		/** Note: Set the GET field BEFORE calling buildOauth(); **/
		$url = 'https://api.twitter.com/1.1/followers/ids';
		$requestMethod = 'GET';
		$twitter = new TwitterAPIExchange($settings);
		echo $twitter->setGetfield($getfield)
					 ->buildOauth($url, $requestMethod)
					 ->performRequest();

	}


	/**
	 * Twitter-specific request_url.
	 *
	 * Since Twitter requies Authentication headers, we will go ahead and
	 * immediately make the request here. The returned value indicates
	 * whether or not the response had a body.
	 *
	 * @since 1.0.0 | 15 JAN 2019 | Created.
	 * @param void
	 * @return mixed True if a response was received, else false.
	 *
	 */
	public function get_api_link() {
		require_once __DIR__ . '/../SDKs/Twitter/autoload.php';

// OLD KEYS
	   $swp_token = 'QcnQ0AFCuhsPPUHrrs3dOYRcP';
	   $swp_secret = 'FLX7TbylCISQAgQac4N0rRuIKtcNr157loUT9OVVWYa6SQ6fCz';
	   $access_token = SWP_Credential_Helper::get_token('twitter');
	   $access_secret = SWP_Credential_Helper::get_token('twitter', 'access_secret');

		// echo '<br/>$swp_token: '.$swp_token.PHP_EOL;
		// echo '<br/>$swp_secret: '.$swp_secret.PHP_EOL;
		// echo '<br/>$access_token: '.$access_token.PHP_EOL;
		// echo '<br/>$access_secret: '.$access_secret.PHP_EOL;


		$connection = new \Abraham\TwitterOAuth\TwitterOAuth( $swp_token, $swp_secret, $access_token, $access_secret );
		// $followers = $connection->get('followers/ids');
		$credentials = $connection->get('account/verify_credentials');
		die(var_dump($credentials));

		die('<br/>Creds'.var_dump($credentials));


		$url = "https://api.twitter.com/1.1/followers/ids";
		$headers = array('Content-Type: application/json' , "Authorization: Bearer $access_token" );
		$this->response = SWP_CURL::file_get_contents_curl( $url, $headers );

		return (bool) $this->response;
	}


	/**
	 * Twitter-specific response handling.
	 *
	 * @since 1.0.0 | 15 JAN 2019 | Created.
	 * @param void
	 * @return int The follow count provided by Twitter, or 0.
	 *
	 */
	public function parse_api_response() {
		if ( empty( $this->response ) ) {
			return 0;
		}

		$this->response = json_decode( $this->$response );

		die(var_dump(' response: ', $this->response));
	}
}
