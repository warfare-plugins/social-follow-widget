<?php
/**
 * SWFW_Facebook
 *
 * This provides an interface for creating a follow button for Facebook.
 *
 * @package   social-follow-widget
 * @copyright Copyright (c) 2019, Warfare Plugins, LLC
 * @license   GPL-3.0+
 * @since     1.0.0 | 15 DEC 2018 | Created.
 *
 */
class SWFW_Facebook extends SWFW_Follow_Network {


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
			'key' =>  'facebook',
			'name' =>  'Facebook',
			'cta' =>  'Like',
			'follow_description' =>  'Fans',
			'color_primary' =>  '#3A589E',
			'color_accent' =>  '#314E84',
			'url'	=> 'https://facebook.com/swfw_username',
			'needs_authorization' => true
		);

		parent::__construct( $network );

	}


	/**
	 * Facebook-specific request_url.
	 *
	 * @since 1.0.0 | 15 JAN 2019 | Created.
	 * @param void
	 * @return mixed The request URL if credentials exist, else bool `false`.
	 *
	 */
	public function do_api_request() {
		if ( !$this->auth_helper->has_credentials ) {
			die('No facebook credentials to make request.');
			return false;
		}

		$page_access_token = SWP_Credential_Helper::get_token( 'page_access_token' );

		if ( false == $page_access_token ) {
			$this->do_page_token_request();
		}

		require_once __DIR__ . '/../SDKs/Facebook/autoload.php';

			// WorkInProgress
		session_start();

		$fb = new Facebook\Facebook(array(
			'app_id' => '2194481457470892',
			'app_secret' => '8d3ffda53c0fca343a4d0932eb006037',
		));

		try {
		  // $response = $fb->get('/me', $accessToken); // works for $user_access_token
		  $pageID = $this->username;
		  $endpoint = "/$pageID/?fields=fan_count";
		  $pageAccessToken = 'EAAfL3oe9HawBAFmQ0jZAPMJ93qswJaZCiLb97yZCLqQhtvhNZCgmNSKkxiEKTFP0obVBnlDkhfNCJE8hNWswZC2SmLS64BMVc4GZBfWgkHfvWSk5YdEQhBzYFBMhzgfIM67Qa44JV45AczhAt5ZArbLyMzFRHOpmZBKhyyaf7J8Nvk0gjssyx13s1CYhFauXKrjCjcolH1RyJgZDZD';

		  $response = $fb->get($endpoint, $pageAccessToken);
		  $this->response = $response->getGraphNode();

		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			$message = 'Graph returned an error: ' . $e->getMessage();
			error_log($message);
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			$message = 'Facebook SDK returned an error: ' . $e->getMessage();
			error_log($message);
		}
	}

	public function parse_api_response() {

	}


	// Uses the $user_access_token to get the page_access_token.
	// return false or $page_access_token
	protected function do_page_token_request() {
		$endpoint = "{$this->username}?fields=access_token";

		try {
		   $response = $this->client->get($endpoint);
		   $node = $response->getGraphNode();

		   if ( !empty( $node->access_token ) ) {
			   $page_access_token = $node->access_token;
			   SWP_Credential_Helper::store_data( 'facebook', 'page_access_token', $page_access_token );
			   return $page_access_token;
		   }

		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			$message = 'Graph returned an error: ' . $e->getMessage();
			error_log($message);
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			$message = 'Facebook SDK returned an error: ' . $e->getMessage();
			error_log($message);
		}

		return false;
	}
}
