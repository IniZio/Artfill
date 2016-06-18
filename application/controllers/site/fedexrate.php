<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * CI-FedEx Library
 *
 */

class Fedexrate extends MY_Controller {

	private $addressLines = array();
	private $city;
	private $state;
	private $zip;
	private $company;
	private $streetAccuracy = 'medium';
	private $directionalAccuracy = 'loose';
	private $companyNameAccuracy = 'loose';
	private $path_to_wsdl = "application/libraries/fedex/wsdl/RateService_v13.wsdl"; 
	
	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation','fedex'));		
		$this->load->model(array('product_model','user_model','order_model','shipping_model'));
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->CI =& get_instance();
        $this->CI->load->config('fedex');
	}
	public function Fedexshippingrate(){
		$shipid = $this->input->post('shippingid');
		$value =  $this->input->post('value');
		$sellerId = $this->input->post('seller_id');
		$userId = $this->data['common_user_id'];
		$reponse = "error";
		if($shipid !=''){
		$request = $this->buildRequest($shipid, $value, $sellerId, $userId);
		$reponse = $this->sendRequest($request, $shipid, $value, $sellerId, $userId);
		}
		if($reponse == 'success'){
			echo '1'; 
		}else{
			echo '0';
		}
	}
	
	public function buildRequest($shipid='', $value='', $sellerId='', $userId=''){
		$ProductVal = $this->shipping_model->get_all_details(USER_SHOPPING_CART,array( 'sell_id' => $sellerId, 'user_id' => $userId),array(array('field'=>'id','type'=>'Asc')));
		
		$ChangeAdds =  $this->shipping_model->get_all_details(SHIPPING_ADDRESS,array('user_id'=>$userId,'id' => $shipid));
		$sellerDetails = $this->shipping_model->get_all_details(USERS, array('id'=> $sellerId));
		$usercountrycode = $this->shipping_model->get_all_details(COUNTRY_LIST, array('name'=>$ChangeAdds->row()->country));
		$sellercountrycode = $this->shipping_model->get_all_details(COUNTRY_LIST, array('name'=>$sellerDetails->row()->country));
		$weight=0;
		foreach($ProductVal->result_array() as $_ProductVal){
			$pid = $_ProductVal['product_id'];
			$product = $this->shipping_model->get_all_details(PRODUCT, array('id'=>$pid));
			if($product->num_rows()==1){
				$weight = $weight + ($product->row()->ship_weight);
			}
		}
		if($this->CI->config->item('allowed_methods') =='GROUND_HOME_DELIVERY'){
			$residential = 'true';
		}else{
			$residential = 'false';
		}
		/***********************API Credentials for FedEx***********************/
		$request['WebAuthenticationDetail'] = array('UserCredential' =>
        	array('Key' => $this->CI->config->item('APIKey'), 'Password' => $this->CI->config->item('APIPassword')));
		$request['ClientDetail'] = array('AccountNumber' => $this->CI->config->item('APIAccountNumber'), 'MeterNumber' => $this->CI->config->item('APIMeterNumber'));
		$request['TransactionDetail'] = array('CustomerTransactionId' => ' *** Rate Available Services Request v13 using PHP ***');
		$request['Version'] = array('ServiceId' => 'crs', 'Major' => '13', 'Intermediate' => '0', 'Minor' => '0');
		$request['ReturnTransitAndCommit'] = true;
		/******************************Get Details from Config***********************/
		$request['RequestedShipment']['DropoffType'] = $this->CI->config->item('dropoff'); 
		$request['RequestedShipment']['ShipTimestamp'] = date('c');
		$request['RequestedShipment']['ServiceType'] = $this->CI->config->item('allowed_methods'); 
		$request['RequestedShipment']['PackagingType'] = $this->CI->config->item('pakaging'); 
		/**************************Get Shipper & Recipient Details*******************/
		$request['RequestedShipment']['Shipper'] = 
					array('Address' => array('StreetLines' => array($ChangeAdds->row()->address1),
											  'City' => $ChangeAdds->row()->city,
											  'PostalCode' => $ChangeAdds->row()->postal_code,
											  'CountryCode' => $usercountrycode->row()->country_code));
			$request['RequestedShipment']['Recipient'] = 
					array(	'Address' => array('StreetLines' => array($sellerDetails->row()->address),
												'City' => $sellerDetails->row()->city,
												'PostalCode' => $sellerDetails->row()->postal_code,
												'CountryCode' => $sellercountrycode->row()->country_code,
												'Residential' => $residential));
		$request['RequestedShipment']['RateRequestTypes'] = 'LIST'; 
		$request['RequestedShipment']['PackageCount'] = $ProductVal->num_rows();
		$request['RequestedShipment']['RequestedPackageLineItems'] = array(
			'0' => array('SequenceNumber' => 1,
			'GroupPackageCount' => 1,'Weight' => array('Value' => $weight,'Units' => $this->CI->config->item('weight_units'))));
		return $request;
	}
	
	public function sendRequest($request, $shipid='', $value='', $sellerId='', $userId=''){
				/***********************Call API Request to FedEx**************************/
			
		ini_set("soap.wsdl_cache_enabled", "0");
		$client = new SoapClient($this->path_to_wsdl, array('trace' => 1)); 	
		try {
		    $response = $client ->getRates($request);
		
		    if ($response -> HighestSeverity != 'FAILURE' && $response -> HighestSeverity != 'ERROR'){
				$rateReply = $response -> RateReplyDetails;
				$serviceType = $rateReply -> ServiceType;
				$amount = number_format($rateReply->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount,2,".",",");
				if(array_key_exists('DeliveryTimestamp',$rateReply)){
					$deliveryDate= $rateReply->DeliveryTimestamp;
				}else if(array_key_exists('TransitTime',$rateReply)){
					$deliveryDate= $rateReply->TransitTime;
				}else {
					$deliveryDate='';
				}
				/*********************Tax Amount Calculation***********************/
				$ProductVal = $this->shipping_model->get_all_details(USER_SHOPPING_CART,array( 'sell_id' => $sellerId, 'user_id' => $userId),array(array('field'=>'id','type'=>'Asc')));
				$ChangeAdds =  $this->shipping_model->get_all_details(SHIPPING_ADDRESS,array('user_id'=>$userId,'id' => $shipid));
				$this->db->select("*");
				$this->db->where(array("seller_id"=>$this->input->post('seller_id'),"state_name"=>$ChangeAdds->row()->state));
				$this->db->from(SELLER_TAX);
				$TaxList=$this->db->get();
				if($TaxList->row()->tax_amount > 0){
					$taxAmt = $TaxList->row()->tax_amount;
				}else{
					$taxAmt = 0;
				}
				/****************Update Fedex Amount to Shoppingcart*****************/
				foreach($ProductVal->result_array() as $prodtVal){
					$product = $this->shipping_model->get_all_details(PRODUCT, array('id'=>$pid));
					$shipCost = $shipCost1 = 0;
					$newshipCost = number_format(($prodtVal['quantity'] * $amount),2,'.','');
					$conditionShip = array('id' => $prodtVal['id']);
					$dataArrShip = array('product_shipping_cost' => $amount,'shipping_cost' => $newshipCost,'shipping'=>'Yes','tax'=>$taxAmt,'ship_type'=> $value);
					$this->shipping_model->update_details(USER_SHOPPING_CART,$dataArrShip,$conditionShip);
				}
				$returnarr = "success";
    		}else{	
			
				$returnarr = "error";
		    } 
		}catch(SoapFault $exception){
			$returnarr = "error";
		}
		return $returnarr;
	}

}