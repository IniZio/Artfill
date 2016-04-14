<?php
ob_start();
$username = $_GET['un'];

require_once('blog/wp-config.php'); 
require_once('blog/wp-admin/includes/user.php'); 
$user = get_userdatabylogin( $username );
wp_delete_user( $user->ID);
	
header('Location:admin/users/display_user_list');
?>