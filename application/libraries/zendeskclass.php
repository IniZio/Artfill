<?php
/**
  * A minimal Zendesk API PHP implementation
  *@author Sureshkumar R.
  *@company Casperon
**/
class zendeskclass
{
	/**
	 * API Constructor. If set to test automatically, will return an Exception if the ping API call fails
	 *
	 * @param string $apiKey API Key.
	 * @param string $user Username on Zendesk.
	 * @param string $subDomain Your subdomain on zendesk, without https:// nor trailling dot.
	 * @param string $suffix .json by default.
	 * @param bool $test=true Whether to test API connectivity on creation.
	 */
	public $api_key=null;
	public $user=null;
	public $base=null;
	public $suffix='.json'; 
	public function __construct($zendesk){	
		$this->_ci =& get_instance();	
		
		$this->api_key = $zendesk['api_key'];
		$this->user    = $zendesk['user'];
		$this->base    = 'https://'.$zendesk['subDomain'].'.zendesk.com/api/v2';		
		$test=false; 
		if(isset($zendesk['suffix'])){
			$this->suffix  = $zendesk['suffix'];
		}

		if ($test === true && !$this->test()){
			throw new Exception('Cannot connect or authentice with the Zendesk API');
		}
	}
	
	/**
	 * Perform an API call.
	 *
	 * @param string $url='/tickets' Endpoint URL. Will automatically add the suffix you set if necessary (both '/tickets.json' and '/tickets' are valid)
	 * @param array $json=array() An associative array of parameters
	 * @param string $action Action to perform POST/GET/PUT
	 *
	 * @return mixed Automatically decodes JSON responses. If the response is not JSON, the response is returned as is
	 */
	public function  call($url, $json, $action)
	{ 
		if (substr_count($url, $this->suffix) == 0){
			$url .= '.json';
		}
		
		$json = json_encode($json);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt($ch, CURLOPT_URL, $this->base.$url);
		curl_setopt($ch, CURLOPT_USERPWD, $this->user."/token:".$this->api_key);
		switch($action){
			case "POST":
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
				break;
			case "GET":
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				break;
			case "PUT":
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
				curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			default:
				break;
		}
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);


		$output = curl_exec($ch); 
		curl_close($ch);
		$decoded = json_decode($output);
		return $decoded;
		#return is_null($decoded) ? $output : $decoded;
	}

	
	/**
	 * Tests the API using /users/ping
	 *
	 * @return bool Whether connection and authentication were successful
	 */
	
}