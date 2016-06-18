<?php
require 'config-shopsy/databaseValues.php';
require("twitter/twitter/twitteroauth.php");
require 'config/twconfig.php';
#require 'config/functions.php';

session_start();

$http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'? "https://" : "http://";
$url = $http . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
$some_variable = $http . $_SERVER["SERVER_NAME"] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['REQUEST_URI'], "/")+1);
#echo YOUR_CONSUMER_KEY; die;

$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
#$twitteroauth = new TwitterOAuth($row['consumer_key'], $row['consumer_secret']);
// Requesting authentication tokens, the parameter is the URL we will be redirected to

$request_token = $twitteroauth->getRequestToken($some_variable.'getTwitterData.php');
#$request_token = $twitteroauth->getRequestToken('http://192.168.1.253/sivaprakash/shopsy-package/responsive/getTwitterData.php');
#echo base_url();
#print_r($request_token); exit;

// Saving them into the session

$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

// If everything goes well..
if ($twitteroauth->http_code == 200) {
    // Let's generate the URL and redirect
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
    header('Location: ' . $url);
} else {
    // It's a bad idea to kill the script, but we've got to know when there's an error.
    die('Something wrong happened.');
}
?>
