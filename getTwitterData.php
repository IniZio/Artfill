<?php
ob_start();
require("twitter/twitter/twitteroauth.php");
require 'config/twconfig.php';	
#require 'config/functions.php';
session_start();
#include_once('config.php');
if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
    $twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
    $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
    $_SESSION['access_token'] = $access_token;
    $user_info = $twitteroauth->get('account/verify_credentials');
?>
<?php   
   /*echo '<pre>';
    print_r($user_info);
    echo '</pre><br/>'; die;*/
    if (isset($user_info->error)) {
        // Something's wrong, go back to square 1  
        header('Location: login-twitter.php');
    } else {
	   $twitter_otoken=$_SESSION['oauth_token'];
	   $twitter_otoken_secret=$_SESSION['oauth_token_secret'];
	   $email='';
        $uid = $user_info->id;
        $username = $user_info->name;
		$user_img = str_replace('_normal', '100',$user_info->profile_image_url);

		global $db;
		if(empty($user_Name)){
			if(!empty($userdata)) {
				session_start();
				$_SESSION['id'] = $userdata['id'];
				$_SESSION['oauth_id'] = $uid;
				$_SESSION['username'] = $userdata['username'];
				$_SESSION['email'] = $userdata['email'];
				$_SESSION['user_img'] = $user_img;
				$_SESSION['oauth_provider'] = $userdata['oauth_provider'];
				#header("Location: home_twitter.php?loginApi=twitter");
				header("location:site/landing");
			} else {
				#redirect('register');
				$http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'? "https://" : "http://";
				$url = $http . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
				$some_variable = $http . $_SERVER["SERVER_NAME"] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['REQUEST_URI'], "/")+1);
				header("location:".$some_variable.'login');
			}			
		}
    }
} else {
    // Something's missing, go back to square 1
    header('Location: login-twitter.php');
}
?>
