<?php

	require_once('credentials.php');

	$authorization_code = $_GET['code'];
	$api_access_point = $_GET['api_access_point'];
	if(!$authorization_code || !$api_access_point){
		die('something went wrong!');
	}

	$data = array(
		'client_id' => CLIENT_ID,
		'client_secret' => CLIENT_SECRET,
		'redirect_uri' => REDIRECT_URI,
		'code' => $authorization_code,
		'grant_type' => 'authorization_code'
	);
	$params = http_build_query($data);
 
 
	$url = API_URL . 'oauth/token?' . $params;
 
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST'
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);

	$access_token = json_decode($result)->access_token;
	$refresh_token = json_decode($result)->refresh_token;

	echo("<p>Copy these values into <b>credentials.php</b></p>");
	echo("<p><b>api access point:</b> $api_access_point</p>");
	echo("<p><b>access token:</b> $access_token</p>");
	echo("<p><b>refresh token:</b> $refresh_token</p><br/><br/>");
	echo("<p>After copying these tokens into <b>credentials.php</b> you will be authorized to make API calls from <b>echosignfunctions.php</b> for 60 days or until revoked.</p>");
?>