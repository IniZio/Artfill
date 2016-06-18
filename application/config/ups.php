<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

include './commonsettings/shopsy_shipping_settings.php';
$shippingSettings = unserialize($config['shipping_2']);
$ups = unserialize($shippingSettings['settings']);
if($shippingSettings['sandbox'] =='Yes'){
	$sandbox = "TRUE";
}else{
	$sandbox = "FALSE";
}
$config['UPSSandbox'] = $sandbox;
$config['UPSUsername'] = $config['Sandbox'] ? $ups['user_name'] : $ups['user_name'];
$config['UPSPassword'] = $config['Sandbox'] ? $ups['password'] : $ups['password'];
$config['UPSAccountNumber'] = $config['Sandbox'] ? $ups['account_number'] : $ups['account_number'];
$config['UPSAccessNumber'] = $config['Sandbox'] ? $ups['access_number'] : $ups['access_number'];
$config['UPSpakaging'] = $ups['pakaging'];
$config['UPS_allowed_methods'] = $ups['allowed_methods'];
$config['UPS_weight_units'] = $ups['weight_units'];
?>