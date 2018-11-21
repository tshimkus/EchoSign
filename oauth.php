<?php
	require_once('credentials.php');
	
	$url = 'https://secure.na2.echosign.com/public/oauth'; //change if necessary
	
	// Enter your scope variables here, space delimited, as defined in your application settings
	$scope = 'agreement_write:self agreement_send:self widget_write:self library_write:self';
	
	$data = array(
		'redirect_uri' => REDIRECT_URI, 
		'response_type' => "code",
		'client_id' => CLIENT_ID,
		'scope' => $scope
	);
	
	$query = http_build_query($data, '', '&');

	echo('<a href="' . $url . '?' . $query . '">Authorize app</a>'); // follow this link to authorize app
?>