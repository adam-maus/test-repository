<?php
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

/**
 * simple method to encrypt or decrypt a plain text string
 * initialization vector(IV) has to be the same when encrypting and decrypting
 * PHP 5.4.9
 *
 * @author https://naveensnayak.wordpress.com/2013/03/12/simple-php-encrypt-and-decrypt/
 *
 * this is a beginners template for simple encryption decryption
 * before using this in production environments, please read about encryption
 *
 * @param string $action: can be 'encrypt' or 'decrypt'
 * @param string $string: string to encrypt or decrypt
 *
 * @return string
 */
function encrypt_decrypt($action, $string) {
    $output = false;

	$secret = explode("\n", file_get_contents("secret"));
	$secret_key = $secret[0];
	$secret_iv = $secret[1];

    $encrypt_method = "AES-256-CBC";

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

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
