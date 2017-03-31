<?php
require("userInfo.php");

if (isset($_POST['username']) && isset($_POST['password'])
{
	login();
}

function login()
{
	$url = 'http://vm344f.se.rit.edu/API/API.php?team=general&function=login';
	$myvars = 'username=' . $_POST['username'] . '&password=' . $_POST['password'];
	
	$ch = curl_init( $url );
	
	curl_setopt( $ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $ch, CURLOPT_HEADER, 0);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec( $ch );
	$valid = json_decode($response);
	
	if ($valid)
	{
		$_SESSION['loggedin'] = true;
		$GLOBALS['userInfo'] = $valid;
	}
}

?>