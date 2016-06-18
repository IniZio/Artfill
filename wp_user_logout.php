<?php
$next = $_GET['next'];
require_once('blog/wp-config.php');

wp_logout();

if ($next!=''){
	header('Location:'.$next);
}else {
	header('Location:home');
}
?>