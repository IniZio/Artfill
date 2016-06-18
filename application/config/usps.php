<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

include './commonsettings/shopsy_shipping_settings.php';
$shippingSettings = unserialize($config['shipping_1']);
$ups = unserialize($shippingSettings['settings']);
if($shippingSettings['sandbox'] =='Yes'){
	$sandbox = "TRUE";
}else{
	$sandbox = "FALSE";
}
$config['USPSSandbox'] = $sandbox;
$config['USPSUsername'] = $config['Sandbox'] ? $ups['user_name'] : $ups['user_name'];
$config['USPSPassword'] = $config['Sandbox'] ? $ups['password'] : $ups['password'];
$config['USPSAccountNumber'] = $config['Sandbox'] ? $ups['account_number'] : $ups['account_number'];
$config['USPSAccessNumber'] = $config['Sandbox'] ? $ups['access_number'] : $ups['access_number'];
$config['USPSpakaging'] = $ups['pakaging'];
$config['USPS_allowed_methods'] = $ups['allowed_methods'];
$config['USPS_weight_units'] = $ups['weight_units'];
?>