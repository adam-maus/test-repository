<?php
// To test this page with caching, go to: http://localhost:6081/<directory>/return-data.php
// To test this page without caching, go to: http://localhost/<directory>/return-data.php

/**
 * Return a time object as a GMDate
 * 
 * @param time $now: The time to use
 * 
 * @return string
 *
 * @since 1.0.0
 */
function getGMT( $now = null ) {
     return gmdate( 'D, d M Y H:i:s', ( $now == null ) ? time() : $now );
}

/**
 * Update the cache headers for the page
 * 
 * @param int $maxAge: The number of seconds
 * @param string $privacy: The privacy of the cache
 * 
 * @return null
 *
 * @since 1.0.0
 */
function cache_control($maxAge = -1, $privacy = "public") {
	header("Cache-Control: " . $privacy . ",max-age=" . $maxAge);
	header("Expires: " . (getGMT(time() + $maxAge)));
	header("Last-Modified: " . getGMT());
}

cache_control(10, "public");

/**
 * Determine which user id they are trying to access and return a JSON object of the data
 */

$user = new \StdClass;
$user->last_modified = getGMT(time());

if (isset($_GET["userid"]) && $_GET["userid"] == 1) {
	$user->userid = 1;
	$user->username = "bill";
	
	
} else if (isset($_GET["userid"]) && $_GET["userid"] == 2) {
	$user->userid = 2;
	$user->username = "steve";
	
} else {
	die("Invalid userid");
}

header("Content-type: application/json");
echo json_encode($user);
