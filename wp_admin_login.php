<?php
	$username = $_GET['un'];
	require_once('blog/wp-config.php');
	if ( !is_user_logged_in() ) {
		$user = get_userdatabylogin( $username );
		$user_id = $user->ID;
		wp_set_current_user( $user_id, $user_login );
		wp_set_auth_cookie( $user_id );
		do_action( 'wp_login', $user_login );
	}
	header('Location:admin/dashboard');
?>