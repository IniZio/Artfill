<?php
ob_start();
$username = $_GET['un'];
$rolechange = $_GET['roles'];

require_once('blog/wp-config.php');
//Check user details
$user = get_userdatabylogin( $username );

//echo '<pre>'; print_r($user); die;
if($rolechange == 'Author'){
	// Remove role
	$user->remove_role( 'subscriber' );
	// Add role
	$user->add_role( 'author' );
}else{
	// Remove role
	$user->remove_role( 'author' );
	// Add role
	$user->add_role( 'subscriber' );
}

header('Location:admin/shop/display_shop');

?>