<?php
ob_start();
//$next = $_GET['next'];
require_once('blog/wp-config.php');

wp_logout();

header('Location:admin');

?>