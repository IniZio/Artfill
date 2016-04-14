<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	function get_geolocation($ip) {

		// $ip="12.215.42.191";    // for united states
	  	//  $ip="212.58.246.104";  // for England   
        // $ip="203.8.183.255";    //  for Australia
		//  $ip= "14.101.255.255"; //  for Japan
		// $ip= "220.255.1.178";   //  for Singapore
		// $ip="46.36.194.191";  // for Malaysia 
		// 
		
		$ips=explode(".",$ip);
	   	$ips=$ips[0];

	  	if($ips=="127"||$ips=="192"){ 
			$ip="14.139.161.3";  // chennai
	  	}
	 
		include("src/geoip.inc");
		$country="";
		$gi = geoip_open("src/GeoIP.dat", GEOIP_STANDARD);

		$code=geoip_country_code_by_addr($gi, $ip);
		$country=geoip_country_name_by_addr($gi, $ip);
	
		geoip_close($gi);

		$arr=array();

		if($country!=""){
		    $arr[]=$code;
			$arr[]=$country;
	  	}	
	  	return $arr;
    }
