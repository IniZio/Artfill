<?php
ini_set('max_execution_time',1200);
ini_set('memory_limit','512M');
//echo phpinfo();die;
define('SITE_COMMON_DEFINE','shopsy-');

$dir = "js/site/";
$files = glob($dir."*.js");
foreach ($files as $file) { 
	unset($fileChk);
	$fileChk = explode('salpal-',$file); 
	if(count($fileChk)>1) {
		$file.$newFile = str_replace('salpal-',SITE_COMMON_DEFINE,$file);
		rename($file,$newFile);
	}
}
die;
?>