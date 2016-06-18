<?php
$username = $_GET['un'];
$pwd = $_GET['pw'];
$email = $_GET['em'];
$pg = $_GET['pg'];

require_once('blog/wp-config.php');
//Check user details
$user = get_userdatabylogin( $username );
if($pwd!=''){
	$user_pass = wp_update_user( array( 'ID' => $user->ID, 'user_pass' => $pwd ) );
	if($pg == 1){
		header('Location:settings/my-account/'.$username);
	}else{
		header('Location:login');	
	}
}elseif($email!=''){
	$user_pass = wp_update_user( array( 'ID' => $user->ID, 'user_email' => $email ) );
	header('Location:login');
}
?>