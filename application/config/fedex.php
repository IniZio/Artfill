<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

include './commonsettings/shopsy_shipping_settings.php';
$shippingSettings = unserialize($config['shipping_0']);
$fedex = unserialize($shippingSettings['settings']);
if($shippingSettings['sandbox'] =='Yes'){
	$sandbox = "TRUE";
}else{
	$sandbox = "FALSE";
}
$config['Sandbox'] = $sandbox;
$config['EndPoint'] = $config['Sandbox'] ? 'https://wsbeta.fedex.com:443/web-services' : 'Product End Point Here';
$config['APIKey'] = $config['Sandbox'] ? $fedex['key'] : $fedex['key'];
$config['APIPassword'] = $config['Sandbox'] ? $fedex['password'] : $fedex['password'];
$config['APIAccountNumber'] = $config['Sandbox'] ? $fedex['account_number'] : $fedex['account_number'];
$config['APIMeterNumber'] = $config['Sandbox'] ? $fedex['meter'] : $fedex['meter'];
$config['pakaging'] = $fedex['pakaging'];
$config['dropoff'] = $fedex['dropoff'];
$config['allowed_methods'] = $fedex['allowed_methods'];
$config['package_detail'] = $fedex['package_detail'];
$config['weight_units'] = $fedex['weight_units'];
?>