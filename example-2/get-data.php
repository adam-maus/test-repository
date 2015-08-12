<?php
// To test this page with caching, go to: http://localhost:6081/<directory>/get-data.php
// To test this page without caching, go to: http://localhost/<directory>/get-data.php

/**
 * Makes a curl call to $url and returns the result
 * 
 * @param string $url: The url to call
 * @param int $user_id: The user_id to use
 * 
 * @return string
 *
 * @since 1.0.0
 */
function curlCall($url) {
	// Init a curl connection to our cached data
	$c = curl_init();

	curl_setopt($c, CURLOPT_URL, $url);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($c, CURLOPT_HEADER, false); 

	// Execute the curl
	$result = curl_exec($c);

	// Close the connection
	curl_close($c);
	
	return $result;
}

/*
 * Start the program
 */

echo "Printing non-cached results from UserID = 1<br />";
print_r(curlCall("http://localhost:6081/test-varnish/example-2/return-data.php?userid=1"));
echo "<br />";

sleep(1);

echo "Printing cached results from UserID = 1<br />";
print_r(curlCall("http://localhost:6081/test-varnish/example-2/return-data.php?userid=1"));
echo "<br />";

sleep(1);

echo "Printing cached results from UserID = 1<br />";
print_r(curlCall("http://localhost:6081/test-varnish/example-2/return-data.php?userid=1"));
echo "<br />";

echo "Printing non-cached results from UserID = 2<br />";
print_r(curlCall("http://localhost:6081/test-varnish/example-2/return-data.php?userid=2"));
echo "<br />";

sleep(1);

echo "Printing cached results from UserID = 2<br />";
print_r(curlCall("http://localhost:6081/test-varnish/example-2/return-data.php?userid=2"));
echo "<br />";

sleep(1);

echo "Printing cached results from UserID = 2<br />";
print_r(curlCall("http://localhost:6081/test-varnish/example-2/return-data.php?userid=2"));
echo "<br />";
