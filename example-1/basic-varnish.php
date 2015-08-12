<?php
// To test this page with caching, go to: http://localhost:6081/<directory>/basic-varnish.php
// To test this page without caching, go to: http://localhost/<directory>/basic-varnish.php

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
?>
<html>
<head>
</head>
<body> 
<?php
print getGMT() . "<br />";
var_dump(apache_request_headers());
?> 
</body>
</html>
