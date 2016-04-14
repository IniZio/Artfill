<?php 
    include('Zoho.php');
    $zoho = new Zoho();
    //$auth = '7c4c01b759b7f846b51e2c79e36dc573';
	$auth = $config['zoho_api_key'];
    $result = $zoho->postData($auth, $fullname,$lastname, $email,'adresse','by','postr','Danmark','Some comment');
    return $result;
 ?>