<?php
ob_start();
$username = $_GET['un'];
$pwd = $_GET['pd'];
$email = $_GET['em'];
$next = $_GET['next'];

require_once('blog/wp-config.php');



// Create the new user
$user_id = wp_create_user( $username, $pwd, $email );
// Get current user object
$user = get_user_by( 'id', $user_id );

// Remove role
//$user->remove_role( 'subscriber' );
// Add role
//$user->add_role( 'editor' );

if ( !is_user_logged_in() ) {
	$user = get_userdatabylogin( $username );
	$user_id = $user->ID;
	wp_set_current_user( $user_id, $user_login );
	wp_set_auth_cookie( $user_id );
	do_action( 'wp_login', $user_login );
}

if ($next!=''){
	header('Location:'.$next);
}else {
	header('Location:home');
}

?>