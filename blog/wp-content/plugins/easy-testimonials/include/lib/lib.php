<?php
include("etkg.php");

function isValidKey(){
	$email = get_option('easy_t_registered_name');
	$webaddress = get_option('easy_t_registered_url');
	$key = get_option('easy_t_registered_key');
	
	$keygen = new ETKG();
	$computedKey = $keygen->computeKey($webaddress, $email);

	if ($key == $computedKey) {
		return true;
	} else {
		$plugin = "easy-testimonials-pro/easy-testimonials-pro.php";
		
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		
		if(is_plugin_active($plugin)){
			return true;
		}
		else {
			return false;
		}
	}
}

function isValidMSKey(){
	$plugin = "easy-testimonials-pro/easy-testimonials-pro.php";
	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
	if(is_plugin_active($plugin)){
		return true;
	}
	else {
		return false;
	}
}
?>