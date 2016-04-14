<?php
ob_start();
$username = $_GET['un'];
$pwd = $_GET['pw'];
$email = $_GET['em'];

require_once('blog/wp-config.php');
//Check user details
$user = get_userdatabylogin( $username );
if($pwd!=''){
	$user_pass = wp_update_user( array( 'ID' => $user->ID, 'user_pass' => $pwd ) );
}elseif($email!=''){
	$user_pass = wp_update_user( array( 'ID' => $user->ID, 'user_email' => $email ) );
}
?>