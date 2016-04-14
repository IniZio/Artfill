<?php
ob_start();
$username = $_GET['un'];
$pwd = $_GET['pw'];
$pg = $_GET['pg'];

require_once('blog/wp-config.php');
//Check user details
$user = get_userdatabylogin( $username );


$user_pass = wp_update_user( array( 'ID' => $user->ID, 'user_pass' => $pwd ) );


if($pg == 1){
	header('Location:admin/adminlogin/change_admin_password_form');
}else{
	header('Location:admin');	
}



?>