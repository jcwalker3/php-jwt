<?php
require __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\{JWT as JWT};

$key = "example_key";
$token = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */
$jwt = JWT::getInstance()->encode($token, $key);
$decoded = JWT::getInstance()->decode($jwt, $key, array('HS256'));

print_r($decoded);

/*
 NOTE: This will now be an object instead of an associative array. To get
 an associative array, you will need to cast it as such:
*/

$decoded_array = (array) $decoded;

/**
 * You can add a leeway to account for when there is a clock skew times between
 * the signing and verifying servers. It is recommended that this leeway should
 * not be bigger than a few minutes.
 *
 * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
 */
JWT::getInstance()->leeway = 60; // $leeway in seconds
$decoded = JWT::getInstance()->decode($jwt, $key, array('HS256'));

print_r($decoded);

$original = 'abc';
$msg = JWT::getInstance()->encode($original, 'my_key');
$decoded = JWT::getInstance()->decode($msg, 'my_key', array('HS256'));
print 'Original: '.$original."\n";
print 'Message: '.$msg."\n";
print 'Decoded: '.$decoded."\n\n";

$msg = 'eyJhbGciOiAiSFMyNTYiLCAidHlwIjogIkpXVCJ9.Iio6aHR0cDovL2FwcGxpY2F0aW9uL2NsaWNreT9ibGFoPTEuMjMmZi5vbz00NTYgQUMwMDAgMTIzIg.E_U8X2YpMT5K1cEiT_3-IvBYfrdIFIeVYeOqre_Z5Cg';
$decoded = JWT::getInstance()->decode($msg, 'my_key', array('HS256'));

print "Original: *:http://application/clicky?blah=1.23&f.oo=456 AC000 123\n";
print 'Message: '.$msg."\n";
print 'Decoded: '.$decoded."\n\n";
?>