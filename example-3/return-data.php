<?php
// To test this page with caching, go to: http://localhost:6081/<directory>/return-data.php
// To test this page without caching, go to: http://localhost/<directory>/return-data.php

include_once("lib.php");

cache_control(10, "private");

/**
 * Determine which user id they are trying to access and return a JSON object of the data
 */
if (!isset($_GET["token"])) {
	die("Invalid token");
}
$token = $_GET["token"];
$data = encrypt_decrypt("decrypt", $token);

if (!$data) {
	die("Invalid token");
}

// TODO: Add validation

$pieces = explode("-", $data);
$userid = $pieces[0];
$expirationTime = $pieces[1];

if (time() > $expirationTime) {
	die("Token expired, please reauthenticate");
}

$user = new \StdClass;
$user->last_modified = getGMT(time());

if ($userid == 1) {
	$user->userid = 1;
	$user->username = "bill";
	
} else if ($userid == 2) {
	$user->userid = 2;
	$user->username = "steve";
	
} else {
	die("Invalid token");
}

header("Content-type: application/json");
echo json_encode($user);
