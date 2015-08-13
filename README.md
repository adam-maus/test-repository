# Testing Varnish #
Version 1.0.0

## Overview ##
Test scripts for experimenting with Varnish Caching server with PHP. This assumes that the Varnish server has already been set up. 

## Varnish ##
https://www.varnish-cache.org/

For instructions to set up Varnish, you can use: 
- https://www.digitalocean.com/community/tutorials/how-to-install-wordpress-nginx-php-and-varnish-on-ubuntu-12-04
- http://www.sitepoint.com/getting-started-with-varnish/

## Examples ##
- example-1: Sends basic public cache control headers for 10 seconds.
- example-2: Tests caching for JSON-encoded user data
	- more information can be found at: https://www.varnish-cache.org/trac/wiki/VCLExampleCachingLoggedInUsers
- example-3: Tests caching using by passing encrypted userid and expiration date in the querystring using OpenSSL
- example-4: Tests caching with logging using varnishncsa
