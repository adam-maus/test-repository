<?php
// To test the caching, go to: http://localhost:6081/basic-varnish.php
cache_control(10, "public");

function getGMT( $now = null ) {
     return gmdate( 'D, d M Y H:i:s', ( $now == null ) ? time() : $now );
}

function cache_control($maxAge = -1, $privacy = "public") {
	header("Cache-Control: " . $privacy . ",max-age=" . $maxAge);
	header("Expires: " . (getGMT(time() + $maxAge)));
}
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
