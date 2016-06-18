<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(-1);
class Usps {
	
function filterServiceName($serviceName){
    $serviceNameKey = str_replace("&lt;sup&gt;&amp;reg;&lt;/sup&gt;", "", $serviceName);
    $serviceNameKey = str_replace("&lt;sup&gt;&amp;trade;&lt;/sup&gt;", "", $serviceNameKey);
    $serviceNameKey = str_replace("&lt;sup&gt;&#8482;&lt;/sup&gt;", "", $serviceNameKey);
    $serviceNameKey = str_replace("&lt;sup&gt;&#174;&lt;/sup&gt;", "", $serviceNameKey);
    $serviceNameKey = str_replace("l&lt;sup&gt;&#174;&lt;/sup&gt;", "", $serviceNameKey);

    return $serviceNameKey;
}
function removeDay($serviceName){

        $serviceName = str_replace(array(' 1-Day',' 2-Day',' 3-Day',' Military',' DPO'), '', $serviceName);

        return $serviceName;
}

function USPSParcelRate($weight,$dest_zip,$shipper_shipfrom,$pack_size,$user_name ,$servicecode) {


// ========== CHANGE THESE VALUES TO MATCH YOUR OWN ===========

$userName = $user_name; // Your USPS Username
$orig_zip = $shipper_shipfrom; // Zipcode you are shipping FROM

// =============== DON'T CHANGE BELOW THIS LINE ===============

//echo "hhh".$servicecode;
$url = "http://Production.ShippingAPIs.com/ShippingAPI.dll";
$ch = curl_init();

// set the target url
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

// parameters to post
curl_setopt($ch, CURLOPT_POST, 1);

$data = "API=RateV4&XML=<RateV4Request USERID=\"$userName\"><Package ID=\"1ST\"><Service>ALL</Service><FirstClassMailType>PARCEL</FirstClassMailType><ZipOrigination>$orig_zip</ZipOrigination><ZipDestination>$dest_zip</ZipDestination><Pounds>$weight</Pounds><Ounces>0</Ounces><Container/><Size>$pack_size</Size><Machinable>FALSE</Machinable></Package> </RateV4Request>";


/* $data="API=IntlRateV2&XML=<IntlRateV2Request USERID="909ZIMPE2238">
  <Revision>2</Revision>
  <RateClientType>008</RateClientType>

  <Package>
    <Pounds>15</Pounds>
    <Ounces>0</Ounces>
    <Machinable>True</Machinable>
    <MailType>Package</MailType>
    <GXG>
      <POBoxFlag>Y</POBoxFlag>
      <GiftFlag>Y</GiftFlag>
    </GXG>
    <ValueOfContents>200</ValueOfContents>
    <Country>Australia</Country>
    <Container>RECTANGULAR</Container>
    <Size>LARGE</Size>
    <Width>10</Width>
    <Length>15</Length>
    <Height>10</Height>
    <Girth>0</Girth>
    <OriginZip>18701</OriginZip>
    <CommercialFlag>N</CommercialFlag>
    <AcceptanceDateTime>2014-01-22T13:15:00-06:00</AcceptanceDateTime>
    <DestinationPostalCode>2046</DestinationPostalCode>
         <RatePriceType>B</RatePriceType>

    <RatePaymentType>3</RatePaymentType>

  </Package>
  
</IntlRateV2Request>"; */



// send the POST values to USPS
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

$result=curl_exec ($ch);

//echo "<pre>"; print_r($result); die;

$data = strstr($result, '<?');
// echo '<!-- '. $data. ' -->'; // Uncomment to show XML in comments
 /* Customized For getting Service name and Price as array*/
 $ship_postage = '';
 $servicesNotConfigurated = array();
 $document_xml = new DomDocument; // Instanciation d'un DOMDocument
 $new_xml = $data;
 $document_xml->loadXML($new_xml); // On charge
 $matchingNodes =  $document_xml->getElementsByTagName("Postage");
// print_r($matchingNodes);
if ($matchingNodes != NULL) {
			for ($i = 0; $i < $matchingNodes->length; $i++) {
				$currNode 		= $matchingNodes->item($i);
				$serviceName 	= $currNode->getElementsByTagName("MailService");
				$serviceName 	= $serviceName->item(0);
                $serviceNameKey = $this->filterServiceName($serviceName->nodeValue);
                $serviceNameKey = $this->removeDay($serviceNameKey);

				
					if (!isset($ship_postage[$serviceNameKey])) {
						$ship_postage[$serviceNameKey] ['rate'] = 0;
					}
					$this_rate = $currNode->getElementsByTagName("Rate");
					$this_rate = $this_rate->item(0);
					$this_rate = $this_rate->nodeValue;
					$ship_postage[$serviceNameKey] ['rate'] = $this_rate;
						
				
			}
		echo "<pre/>";
		print_r($ship_postage);
		}
 /* Customized */
 
$xml_parser = xml_parser_create();
xml_parse_into_struct($xml_parser, $data, $vals, $index);
xml_parser_free($xml_parser);
$params = array();
$level = array();
foreach ($vals as $xml_elem) {
    if ($xml_elem['type'] == 'open') {
        if (array_key_exists('attributes',$xml_elem)) {
            list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);
        } else {
        $level[$xml_elem['level']] = $xml_elem['tag'];
        }
    }
    if ($xml_elem['type'] == 'complete') {
    $start_level = 1;
    $php_stmt = '$params';
    while($start_level < $xml_elem['level']) {
        $php_stmt .= '[$level['.$start_level.']]';
        $start_level++;
    }
    $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
    eval($php_stmt);
    }
}
curl_close($ch);
echo '<pre>'; print_r($params); echo'</pre>'; // Uncomment to see xml tags

$DomesticServices[0] ="Priority Mail Express 1-Day";
$DomesticServices[1]="Priority Mail Express 1-Day Hold For Pickup";
$DomesticServices[2]="Priority Mail Express 1-Day Flat Rate Boxes";
$DomesticServices[3]="Priority Mail Express 1-Day Flat Rate Boxes Hold For Pickup";
$DomesticServices[4]="Priority Mail Express 1-Day Flat Rate Envelope";
$DomesticServices[5]="Priority Mail Express 1-Day Flat Rate Envelope Hold For Pickup";
$DomesticServices[6]="Priority Mail Express 1-Day Legal Flat Rate Envelope";
$DomesticServices[7]="Priority Mail Express 1-Day Legal Flat Rate Envelope Hold For Pickup";
$DomesticServices[8]="Priority Mail Express 1-Day Padded Flat Rate Envelope";
$DomesticServices[9]="Priority Mail Express 1-Day Padded Flat Rate Envelope Hold For Pickup";
$DomesticServices[10]="Priority Mail 1-Day";
$DomesticServices[11]="Priority Mail 1-Day Large Flat Rate Box";
$DomesticServices[12]="Priority Mail 1-Day Medium Flat Rate Box";
$DomesticServices[13]="Priority Mail 1-Day Small Flat Rate Box";
$DomesticServices[14]="Priority Mail 1-Day Flat Rate Envelope";
$DomesticServices[15]="Priority Mail 1-Day Legal Flat Rate Envelope";
$DomesticServices[16]="Priority Mail 1-Day Padded Flat Rate Envelope";
$DomesticServices[17]="Priority Mail 1-Day Gift Card Flat Rate Envelope";
$DomesticServices[18]="Priority Mail 1-Day Small Flat Rate Envelope";
$DomesticServices[19]="Priority Mail 1-Day Window Flat Rate Envelope";
$DomesticServices[20]="First-Class Mail Postcards";
$DomesticServices[21]="First-Class Mail Large Postcards";
$DomesticServices[24]="Standard Post";
$DomesticServices[25]="Media Mail";
$DomesticServices[26]="Library Mail";

$UniversarlServices[0]="Global Express Guaranteed (GXG)**";
$UniversarlServices[1]="Global Express Guaranteed Non-Document Rectangular";
$UniversarlServices[2]="Global Express Guaranteed Non-Document Non-Rectangular";
$UniversarlServices[3]="USPS GXG Envelopes**";
$UniversarlServices[4]="Express Mail International";
$UniversarlServices[5]="Express Mail International Flat Rate Envelope";
$UniversarlServices[6]="Express Mail International Legal Flat Rate Envelope";
$UniversarlServices[7]="Priority Mail International";
$UniversarlServices[8]="Priority Mail International Large Flat Rate Box";
$UniversarlServices[9]="Priority Mail International Medium Flat Rate Box";
$UniversarlServices[10]="Priority Mail International Small Flat Rate Box**";
$UniversarlServices[11]="Priority Mail International DVD Flat Rate Box**";
$UniversarlServices[12]="Priority Mail International Large Video Flat Rate Box**";
$UniversarlServices[13]="Priority Mail International Flat Rate Envelope**";
$UniversarlServices[14]="Priority Mail International Legal Flat Rate Envelope**";
$UniversarlServices[15]="Priority Mail International Padded Flat Rate Envelope**";
$UniversarlServices[16]="Priority Mail International Gift Card Flat Rate Envelope**";
$UniversarlServices[17]="Priority Mail International Small Flat Rate Envelope**";
$UniversarlServices[18]="Priority Mail International Window Flat Rate Envelope**";
$UniversarlServices[19]="First-Class Mail International Package**";
$UniversarlServices[20]="First-Class Mail International Large Envelope**";


	$ServiceNamesIndex[0] = "Priority Mail Express";
	$ServiceNamesIndex[1] = "Priority Mail Express Hold For Pickup";
	$ServiceNamesIndex[2] = "Priority Mail Express Flat Rate Boxes";
	$ServiceNamesIndex[3] = "Priority Mail Express Flat Rate Boxes Hold For Pickup";
	$ServiceNamesIndex[4] = "Priority Mail Express Flat Rate Envelope";
	$ServiceNamesIndex[5] = "Priority Mail Express Flat Rate Envelope Hold For Pickup";
	$ServiceNamesIndex[6] = "Priority Mail Express Sunday/Holiday Delivery Flat Rate Envelope";
	$ServiceNamesIndex[7] = "Priority Mail Express Legal Flat Rate Envelope";
	$ServiceNamesIndex[8] = "Priority Mail Express Legal Flat Rate Envelope Hold For Pickup";
	$ServiceNamesIndex[9] = "Priority Mail Express Padded Flat Rate Envelope Hold For Pickup";
	$ServiceNamesIndex[10] = "Priority Mail Express Padded Flat Rate Envelope";
	$ServiceNamesIndex[11] = "Priority Mail Express Sunday/Holiday Delivery Legal Flat Rate Envelope";
	$ServiceNamesIndex[12] = "Priority Mail";
	$ServiceNamesIndex[13] = "Priority Mail Large Flat Rate Box";
	$ServiceNamesIndex[14] = "Priority Mail Medium Flat Rate Box";
	$ServiceNamesIndex[15] = "Priority Mail Small Flat Rate Box";
	$ServiceNamesIndex[16] = "Priority Mail Flat Rate Envelope";
	$ServiceNamesIndex[17] = "Priority Mail Legal Flat Rate Envelope";
	$ServiceNamesIndex[18] = "Priority Mail Padded Flat Rate Envelope";
	$ServiceNamesIndex[19] = "Priority Mail Small Flat Rate Envelope";
	$ServiceNamesIndex[20] = "Priority Mail Sunday/Holiday Delivery Flat Rate Envelope";
	$ServiceNamesIndex[21] = "Priority Mail Legal Flat Rate Envelope";
	$ServiceNamesIndex[22] = "Priority Mail Legal Flat Rate Envelope Hold For Pickup";
	$ServiceNamesIndex[23] = "Priority Mail Sunday/Holiday Delivery Legal Flat Rate Envelope";
	$ServiceNamesIndex[24] = "Standard Post";
	$ServiceNamesIndex[25] = "Media Mail";
	$ServiceNamesIndex[26] = "Library Mail";
	$ServiceNamesIndex[27] = "First-Class Mail Large Envelope";
	$ServiceNamesIndex[28] = "First-Class Mail Letter";
	$ServiceNamesIndex[29] = "First-Class Mail Parcel";
	$ServiceNamesIndex[30] = "First-Class Mail Postcards";
	$ServiceNamesIndex[31] = "First-Class Mail Large Postcards";
	$ServiceNamesIndex[32] = "First-Class Mail Package Service Hold For Pickup";
	$ServiceNamesIndex[33] = "First-Class Mail Package Service";


//find the Price

	return $ship_postage[$ServiceNamesIndex[$servicecode]]['rate'] ;
	exit;

/*
Express Mail
Express Mail Hold For Pickup
Express Mail Flat Rate Boxes
Express Mail Flat Rate Boxes Hold For Pickup
Express Mail Flat Rate Envelope
Express Mail Flat Rate Envelope Hold For Pickup
Express Mail Legal Flat Rate Envelope
Express Mail Legal Flat Rate Envelope Hold For Pickup
Express Mail Padded Flat Rate Envelope
Express Mail Padded Flat Rate Envelope Hold For Pickup
Priority Mail
Priority Mail Large Flat Rate Box
Priority Mail Medium Flat Rate Box
Priority Mail Small Flat Rate Box
Priority Mail Flat Rate Envelope
Priority Mail Legal Flat Rate Envelope
Priority Mail Padded Flat Rate Envelope
Priority Mail Gift Card Flat Rate Envelope
Priority Mail Small Flat Rate Envelope
Priority Mail Window Flat Rate Envelope
Parcel Post
Media Mail
Library Mail

Express Mail
Express Mail Hold For Pickup
Express Mail Flat Rate Boxes
Express Mail Flat Rate Boxes Hold For Pickup
Express Mail Flat Rate Envelope
Express Mail Flat Rate Envelope Hold For Pickup
Express Mail Legal Flat Rate Envelope
Express Mail Legal Flat Rate Envelope Hold For Pickup
Express Mail Padded Flat Rate Envelope
Express Mail Padded Flat Rate Envelope Hold For Pickup
Priority Mail<br/>Priority Mail Large Flat Rate Box
Priority Mail Medium Flat Rate Box
Priority Mail Small Flat Rate Box
Priority Mail Flat Rate Envelope
Priority Mail Legal Flat Rate Envelope
Priority Mail Padded Flat Rate Envelope
Priority Mail Gift Card Flat Rate Envelope
Priority Mail Small Flat Rate Envelope
Priority Mail Window Flat Rate Envelope
Parcel Post
Media Mail<br/>Library 

echo "<pre/>";
print_r($params);
*/
// if(UNIVERSAL_USPS_SERVICE == 1)
// 	$serviceName = $UniversarlServices[$servicecode];
// else
// 	$serviceName = $DomesticServices[$servicecode];

//$serviceName = $UniversarlServices[$servicecode];
$serviceName = $ServiceNamesIndex[$servicecode];
	
	foreach($params as $kesService=>$valServices){
		
		//print_r($valServices);
		foreach($valServices as $keyScode=>$vaScode){
			foreach($vaScode as $innerkey=>$valinner){
				$service_name = preg_replace("(<([a-z]+)>.*?</\\1>)is","",html_entity_decode($valinner['MAILSERVICE']));		
				//trim(str_replace("&lt;sup&gt;&amp;reg;&lt;/sup&gt;","",$valinner['MAILSERVICE']));
				//echo "<br/>".$service_name."==".$valinner['RATE'];
				if(strtolower(trim($service_name)) == strtolower(trim($serviceName))){
					
					return $valinner['RATE'];
					exit;
				}
				//echo "<br/>NNNN".strtolower($service_name)." == ".strtolower(trim($serviceName));
			}
		}
	}

//return $params['RATEV3RESPONSE']['1ST'][$servicecode]['RATE'];
return $params['RATEV3RESPONSE']['1ST'][$servicecode]['RATE'];
}
}
?>