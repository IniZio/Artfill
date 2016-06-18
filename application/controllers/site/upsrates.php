<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Upsrates extends MY_Controller { 

	private  $Package_types = array(
        'CP' => 'YOUR_PACKAGING',
        '30' => 'UPS_PALLET',
        '10' => 'UPS_10_KG_BOX',
        '25' => 'UPS_25_KG_BOX',
        '08' => 'UPS_TUPE',
        '11' => 'UPS_LETTER',
        '12' => 'UPS_PAK',
        '13' => 'UPS_EXPRESS_BOX_SMALL',
        '14' => 'UPS_EXPRESS_BOX_MEDIUM',
        '54' => 'UPS_EXPRESS_BOX_LARGE'
    );
	
	
	  protected  $service_codes = array(
		'01'    => 'UPS_EXPRESS',
		'02'    => 'UPS_EXPEDITED',
		'03'    => 'UPS_GROUND',
		'1DA'   => 'UPS_NEXT_DAY_AIR',
		'11'    => 'UPS_STANDARD',
		'12'    => 'UPS_3_DAY_SELECT',
		'13'    => 'UPS_SAVER',
		'1DP'    => 'UPS_NEXT_DAY_AIR_SAVER',
		'54'    => 'UPS_WORLDWIDE_EXPRESS_PLUS',
		'59'    => 'UPS_2_DAY_AIR_AM',
		'65'    => 'UPS_NEXT_DAY_AIR_EARLY_AM',
		'82'    => 'UPS_TODAY_STANDARD',
		'83'    => 'UPS_TODAY_DEDICATED_COURRIER',
		'84'    => 'UPS_TODAY_INTERCITY',
		'85'    => 'UPS_TODAY_EXPRESS',
		'86'    => 'UPS_TODAY_EXPRESS_SAVER',
		'308'   => 'UPS_FREIGHT_LTL',
		'309'   => 'UPS_FREIGHT_LTL_GUARANTEED',
		'310'   => 'UPS_FREIGHT_LTL_URGENT',
		'TDCB'  => 'UPS_TRADE_DIRECT_CROSS_BORDER',
		'TDA'   => 'UPS_TRADE_DIRECT_AIR',
		'TDO'   => 'UPS_TRADE_DIRECT_OCEAN',
    );
    
	 private $weight_uom = array(
    	'LBS' => 'LB',
    	'KGS' => 'KG',
    );
	
	private  $shipping_types = array(
        '01' => 'UPS Next Day Air',
        '02' => 'UPS Second Day Air',
        '03' => 'UPS Ground',
        '07' => 'UPS Worldwide Express',
        '08' => 'UPS Worldwide Expedited',
        '11' => 'UPS Standard',
        '12' => 'UPS Three-Day Select',
        '13' => 'Next Day Air Saver',
        '14' => 'UPS Next Day Air Early AM',
        '54' => 'UPS Worldwide Express Plus',
        '59' => 'UPS Second Day Air AM',
        '65' => 'UPS Saver'
    );


	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('product_model','seller_model','user_model','order_model','shipping_model'));
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->CI =& get_instance();
        $this->CI->load->config('ups');
    } 
	
	
	function get_service_codes($type) {
    	$type = (string) $type;
	    foreach($this->service_codes as $code => $service_code)
	    	{
		    	if($service_code == $type)
		    	{
			    	return $code;
		    	}
	    	}
			return '02';
    	
    }
	
	
	function get_package_type($type) {
    	$type = (string) $type;
	    foreach($this->Package_types as $code => $Package_types)
	    	{
		    	if($Package_types == $type)
		    	{
			    	return $code;
		    	}
	    	}
			return '02';
    	
    }
	
	function get_weight_uom($type) {
    	$type = (string) $type;
	    foreach($this->weight_uom as $code => $weight_uoms)
	    	{
		    	if($weight_uoms == $type)
		    	{
			    	return $code;
		    	}
	    	}
			return 'LBS';
    	
    }
	
	public function getUpsProperty($var){
		if($var == 'check') return true;
		if($var == 'account_number') return $this->CI->config->item('UPSSandbox');
		if($var == 'access_number') return $this->CI->config->item('UPSAccessNumber');
		if($var == 'username') return $this->CI->config->item('UPSUsername');
		if($var == 'password') return $this->CI->config->item('UPSPassword');
		if($var == 'PackageType') return $this->CI->config->item('UPSpakaging');
		if($var == 'ServiceType') return $this->CI->config->item('UPS_allowed_methods');
		if($var == 'Units') return $this->CI->config->item('UPS_weight_units');
		if($var == 'UserId') return $this->CI->config->item('UPS_user_id');
	}
	
	
	
	
		public function UPSshippingrate(){
		$shipid = $this->input->post('shippingid');
		$value =  $this->input->post('value');
		$sellerId = $this->input->post('seller_id');
		$userId = $this->data['common_user_id'];
		//$shipid = 1;
		//$value =  'Usps';
		//$sellerId = 3;
		//$userId = 2;
		if($shipid != ''){
			$ProductVal = $this->shipping_model->get_all_details(USER_SHOPPING_CART,array( 'sell_id' => $sellerId, 'user_id' => $userId),array(array('field'=>'id','type'=>'Asc')));
			
			$ChangeAdds =  $this->shipping_model->get_all_details(SHIPPING_ADDRESS ,array('user_id'=>$userId,'id' => $shipid));
			
			$sellerDetails = $this->shipping_model->get_all_details(USERS, array('id'=> $sellerId));
			$usercountrycode = $this->shipping_model->get_all_details(COUNTRY_LIST, array('name'=>$ChangeAdds->row()->country));
			$sellercountrycode = $this->shipping_model->get_all_details(COUNTRY_LIST, array('name'=>$sellerDetails->row()->country));
			$weight=0;
		    
			foreach($ProductVal->result_array() as $_ProductVal){
				$pid = $_ProductVal['product_id'];
				$product = $this->shipping_model->get_all_details(PRODUCT, array('id'=>$pid));
				
				if($product->num_rows()==1){
					$weight = $weight + $product->row()->ship_weight;
				}
			}
			
		
				
		/*	$path_to_wsdl = "RateService_v9.wsdl";
			ini_set("soap.wsdl_cache_enabled", "0");
			$client = new SoapClient($path_to_wsdl, array('trace' => 1));*/
			
			
			
			
			$ups_details['user'] = $this->getUpsProperty('username');
			$ups_details['accessNumber'] = $this->getUpsProperty('access_number');
			$ups_details['pass'] = $this->getUpsProperty('password');
			if ($ups_details['user']!= '') {
			
			
				$this->load->library('ups/ups',$ups_details);
			
				$this->ups->setTemplatePath('./ups/xml/');
				$this->ups->setTestingMode(1); // Change this to 0 for production
				$upsObject['upsObj'] = $this->ups;
				
				$this->load->library('ups/upsRate',$upsObject);
				 
				
				$this->upsrate->shipper(array('name' => $ChangeAdds->row()->user_name,
							 'phone' => $ChangeAdds->row()->phone_no, 
							 'shipperNumber' => $this->getUpsProperty('account_number'), 
							 'address1' => $ChangeAdds->row()->address1, 
							 'address2' => '', 
							 'address3' => '', 
							 'city' => $ChangeAdds->row()->city, 
							 'state' => $ChangeAdds->row()->state, 
							 'postalCode' =>$ChangeAdds->row()->postal_code, 
							 'country' => $usercountrycode->row()->country_code));
							
			$this->upsrate->shipTo(array('companyName' => $sellerDetails->row()->user_name, 
							'attentionName' => $sellerDetails->row()->user_name, 
							'phone' => $sellerDetails->row()->phone_no, 
							'address1' => $sellerDetails->row()->address, 
							'address2' => '', 
							'address3' => '', 
							'city' => $sellerDetails->row()->city, 
							'state' =>  $sellerDetails->row()->state, 
							'postalCode' => $sellerDetails->row()->postal_code, 
							'countryCode' =>$sellercountrycode->row()->country_code));
							 $this->upsrate->request(array('Shop' => true));
							
							
							
							
							
			$this->upsrate->package(array('description' => 'my description', 
									'weight' => $weight,
									'code' =>  $this->get_package_type($this->getUpsProperty('PackageType')),
									'length' => $ProductVal->num_rows(),
									'weight_uom'=>$this->get_weight_uom($this->getUpsProperty('Units')),
									'country_code'=> $sellercountrycode->row()->country_code,
									));
									
				

									
        //'LBS' => 'Pounds',
    	//'KGS' => 'Kilograms',	
		
			$this->upsrate->shipment(array('description' => 'my description','serviceType' => $this->get_service_codes($this->getUpsProperty('ServiceType'))));
			try{
			
			$rateFromUPS = $this->upsrate->sendRateRequest();
			 //echo htmlspecialchars($this->upsrate->xmlSent);
			$amount =$rateFromUPS;
			}catch(Execption $exception) {
				//$exception->faultcode
				//$exception->faultstring 
				print_r($exception);die;
			}
		  
		  
		  print_r($rateFromUPS);die;
							 
			/*********************Tax Amount Calculation***********************/
			$this->db->select("*");
			$this->db->where(array("seller_id"=>$this->input->post('seller_id'),"state_name"=>$ChangeAdds->row()->state));
			$this->db->from(SELLER_TAX);
			$TaxList=$this->db->get();
			if($TaxList->row()->tax_amount > 0){
				$taxAmt = $TaxList->row()->tax_amount;
			}else{
				$taxAmt = 0;
			}
			foreach($ProductVal->result_array() as $prodtVal){	
				$shipCost = $shipCost1 = 0;
				$newshipCost = number_format(($prodtVal['quantity'] * $amount),2,'.','');
				$conditionShip = array('id' => $prodtVal['id']);
				$dataArrShip = array('product_shipping_cost' => $amount,'shipping_cost' => $newshipCost,'shipping'=>'Yes','tax'=>$taxAmt,'ship_type'=> $value);
				$this->shipping_model->update_details(USER_SHOPPING_CART,$dataArrShip,$conditionShip);
			}
			echo '1';
		}else{
			echo '0';
		}
		}else{
		echo '0';
		}
	}
}
//'Dimensions' =>array('Length' => 10,'Width' => 10,'Height' => 3,'Units' => 'IN')
/* End of file shipping.php */
/* Location: ./application/controllers/site/shipping.php */