<!DOCTYPE html>
<html>
<head>
	<title>here</title>
</head>
<body>
<h1>fgdfgggggggggg</h1>
	<?php

$sites = "http://www.broadcastsolutions.com.au/
http://www.kvm.com.au/
http://www.ambertech.com.au/";

$sites = preg_split('/\r\n|\r|\n/', $sites);


echo "
<style>
img {float: left; margin: 15px; }
</style>
";

foreach($sites as $site) 
{
	//cache it
	if ( !$image = apc_fetch( "thumbnail:".$site ) ) 
	{ 
		$image = file_get_contents("https://www.googleapis.com/pagespeedonline/v1/runPagespeed?url=$site&screenshot=true");
		$image = json_decode($image, true); 
		
		//echo "<pre>"; print_r($image); die; 
		
		$image = $image['screenshot']['data'];
		apc_add("thumbnail:".$site, $image, 2400); 
	}

	
	$image = str_replace(array('_','-'),array('/','+'),$image); 
	
	echo "<img src=\"data:image/jpeg;base64,".$image."\" border='1' />";
	

}

?>

<?php } ?>
</body>
</html>