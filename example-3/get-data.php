<?php
// To test this page with caching, go to: http://localhost:6081/<directory>/get-data.php
// To test this page without caching, go to: http://localhost/<directory>/get-data.php

include_once("lib.php");

cache_control(-1, "public");

// Retrieve userid=1

$token = encrypt_decrypt("encrypt", "1-" . (time() + 10000));
echo "Printing non-cached results from UserID = 1<br />";
print_r(curlCall("http://localhost:6081/test-varnish/example-3/return-data.php?token=" . $token));
echo "<br />";

sleep(1);

echo "Printing cached results from UserID = 1<br />";
print_r(curlCall("http://localhost:6081/test-varnish/example-3/return-data.php?token=" . $token));
echo "<br />";

sleep(1);

echo "Printing cached results from UserID = 1<br />";
print_r(curlCall("http://localhost:6081/test-varnish/example-3/return-data.php?token=" . $token));
echo "<br />";

// Retrieve userid=2

$token = encrypt_decrypt("encrypt", "2-" . (time() + 10000));

echo "Printing non-cached results from UserID = 2<br />";
print_r(curlCall("http://localhost:6081/test-varnish/example-3/return-data.php?token=" . $token));
echo "<br />";

sleep(1);

echo "Printing cached results from UserID = 2<br />";
print_r(curlCall("http://localhost:6081/test-varnish/example-3/return-data.php?token=" . $token));
echo "<br />";

sleep(1);

echo "Printing cached results from UserID = 2<br />";
print_r(curlCall("http://localhost:6081/test-varnish/example-3/return-data.php?token=" . $token));
echo "<br />";
