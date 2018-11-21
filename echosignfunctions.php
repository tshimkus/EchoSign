<?php

	require_once('credentials.php');

	
	// Get OAuth token (refresh token valid for 60 days or until revoked)
	function getAuthToken() {
		
		$params = array(
			'refresh_token' => REFRESH_TOKEN,
			'client_id' => CLIENT_ID,
			'client_secret' => CLIENT_SECRET,
			'grant_type' => 'refresh_token'
		);
		
		$query = http_build_query($params, '', '&');
		
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST'
			)
		);
		
		$url = API_URL . 'oauth/refresh?' . $query;
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$access_token = json_decode($result)->access_token;
	
		return $access_token;
	}

	
	// Send agreement from library
	function sendAgreement($signer_email) {
	
		$agreement_id = 'WHiuUBCAABAA_Fake-DOcuMENt_ID-m9ms0CBJCH'; // libraryDocumentID
	
	
		$requestbody = array(
			"fileInfos" => array(
				array(
					"libraryDocumentId" => $agreement_id
				)
			),
			"name" => "NPL Subscriber Agreement",
			"participantSetsInfo" => array(
				array(
					"memberInfos" => array(
						array(
							"email" => $signer_email
						)
					),
					"order" => 1,
					"role" => "SIGNER"
				)
			),
			"signatureType" => "ESIGN",
			"state" => "IN_PROCESS"
		);

		$options = array(
			'http' => array(
				'header'  => "Authorization: Bearer " . getAuthToken() . "\r\n" .
							 "Content-type: application/json\r\n",
				'method'  => 'POST',
				'content' => json_encode($requestbody)
			)
		);

		$url = API_URL . 'api/rest/v6/agreements';
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);

		return $result;
	}
?>