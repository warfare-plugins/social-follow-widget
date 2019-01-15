<?php

/**
 * SWFW_Facebook
 *
 * This provides an interface for creating a follow button for Facebook.
 *
 * @package   social-follow-widget
 * @copyright Copyright (c) 2019, Warfare Plugins, LLC
 * @license   GPL-3.0+
 * @since     1.0.0 | Created
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
		$this->get_count_request_url();
	}


	/**
	 * [get_count_request_url description]
	 * @return [type] [description]
	 */
	public function get_count_request_url() {
		if ( !$this->auth_helper->has_credentials ) {
			return false;
		}

		require_once __DIR__ . '/../SDKs/Facebook/autoload.php';

		// $endpoint = "/{$this->username}/fan_count";
		$app_id = '2194481457470892';
		$app_secret = base64_decode('OGQzZmZkYTUzYzBmY2EzNDNhNGQwOTMyZWIwMDYwMzc=');
		$endpoint = "/{$this->username}/locations";

		$access_token1 = $this->auth_helper->get_access_token();
		$access_token2 = $app_id.'|'.$this->auth_helper->get_access_token();
		$access_token3 = $app_id.'|'.$app_secret;

		$fb = new Facebook\Facebook(array(
			'app_id' => $app_id,
			'app_secret' => $app_secret,
			'default_graph_version' => 'v3.20',
		));

		try {

		  // Returns a `Facebook\FacebookResponse` object
		  $response = $fb->get('/'. $app_id.'/permissions', $access_token3 );
		  // $response = $fb->get('/', $access_token3);
		  echo 'Response from facebook: <pre>';
		  die(var_dump($response));

		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		$graphNode = $response->getGraphNode();
		/* handle the result */

		return '';
	}
}
