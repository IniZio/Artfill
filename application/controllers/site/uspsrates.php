<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Uspsrates extends MY_Controller { 

	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('product_model','user_model','order_model','shipping_model'));
		$this->data['loginCheck'] = $this->checkLogin('U');
		
		$this->load->library('usps');
		$this->load->library('USPSFirstClassServiceStandards');
		$this->load->library('USPSRate');
		$this->CI =& get_instance();
        $this->CI->load->config('usps');
	}

	
	public function getUpsProperty($var){
		if($var == 'check') return true;
		if($var == 'account_number') return $this->CI->config->item('USPSSandbox');
		if($var == 'access_number') return $this->CI->config->item('USPSAccessNumber');
		if($var == 'username') return $this->CI->config->item('USPSUsername');
		if($var == 'password') return $this->CI->config->item('USPSPassword');
		if($var == 'PackageType') return $this->CI->config->item('USPSpakaging');
		if($var == 'ServiceType') return $this->CI->config->item('USPS_allowed_methods');
		if($var == 'Units') return $this->CI->config->item('USPS_weight_units');
		if($var == 'UserId') return $this->CI->config->item('USPS_user_id');
	}
	public function getservice($var){
		if($var == 'SERVICE_FIRST_CLASS'){
			return USPSRatePackage::SERVICE_FIRST_CLASS;
		}else if($var == 'SERVICE_FIRST_CLASS_COMMERCIAL'){
			return USPSRatePackage::SERVICE_FIRST_CLASS_COMMERCIAL;
		}else if($var == 'SERVICE_FIRST_CLASS_HFP_COMMERCIAL'){
			return USPSRatePackage::SERVICE_FIRST_CLASS_HFP_COMMERCIAL;
		}else if($var == 'SERVICE_PRIORITY'){
			return USPSRatePackage::SERVICE_PRIORITY;
		}else if($var == 'SERVICE_PRIORITY_COMMERCIAL'){
			return USPSRatePackage::SERVICE_PRIORITY_COMMERCIAL;
		}else if($var == 'SERVICE_PRIORITY_HFP_COMMERCIAL'){
			return USPSRatePackage::SERVICE_PRIORITY_HFP_COMMERCIAL;
		}else if($var == 'SERVICE_EXPRESS'){
			return USPSRatePackage::SERVICE_EXPRESS;
		}else if($var == 'SERVICE_EXPRESS_COMMERCIAL'){
			return USPSRatePackage::SERVICE_EXPRESS_COMMERCIAL;
		}else if($var == 'SERVICE_EXPRESS_SH'){
			return USPSRatePackage::SERVICE_EXPRESS_SH;
		}else if($var == 'SERVICE_EXPRESS_SH_COMMERCIAL'){
			return USPSRatePackage::SERVICE_EXPRESS_SH_COMMERCIAL;
		}else if($var == 'SERVICE_EXPRESS_HFP'){
			return USPSRatePackage::SERVICE_EXPRESS_HFP;
		}else if($var == 'SERVICE_EXPRESS_HFP_COMMERCIAL'){
			return USPSRatePackage::SERVICE_EXPRESS_HFP_COMMERCIAL;
		}else if($var == 'SERVICE_PARCEL'){
			return USPSRatePackage::SERVICE_PARCEL;
		}else if($var == 'SERVICE_MEDIA'){
			return USPSRatePackage::SERVICE_MEDIA;
		}else if($var == 'SERVICE_LIBRARY'){
			return USPSRatePackage::SERVICE_LIBRARY;
		}else if($var == 'SERVICE_ALL'){
			return USPSRatePackage::SERVICE_ALL;
		}else if($var == 'SERVICE_ONLINE'){
			return USPSRatePackage::SERVICE_ONLINE;
		}else if($var == 'MAIL_TYPE_LETTER'){
			return USPSRatePackage::MAIL_TYPE_LETTER;
		}else if($var == 'MAIL_TYPE_FLAT'){
			return USPSRatePackage::MAIL_TYPE_FLAT;
		}else if($var == 'MAIL_TYPE_PARCEL'){
			return USPSRatePackage::MAIL_TYPE_PARCEL;
		}else if($var == 'MAIL_TYPE_POSTCARD'){
			return USPSRatePackage::MAIL_TYPE_POSTCARD;
		}else if($var == 'MAIL_TYPE_PACKAGE_SERVICE'){
			return USPSRatePackage::MAIL_TYPE_PACKAGE_SERVICE;
		}else if($var == 'CONTAINER_VARIABLE'){
			return USPSRatePackage::CONTAINER_VARIABLE;
		}else if($var == 'CONTAINER_FLAT_RATE_ENVELOPE'){
			return USPSRatePackage::CONTAINER_FLAT_RATE_ENVELOPE;
		}else if($var == 'CONTAINER_PADDED_FLAT_RATE_ENVELOPE'){
			return USPSRatePackage::CONTAINER_PADDED_FLAT_RATE_ENVELOPE;
		}else if($var == 'CONTAINER_LEGAL_FLAT_RATE_ENVELOPE'){
			return USPSRatePackage::CONTAINER_LEGAL_FLAT_RATE_ENVELOPE;
		}else if($var == 'CONTAINER_SM_FLAT_RATE_ENVELOPE'){
			return USPSRatePackage::CONTAINER_SM_FLAT_RATE_ENVELOPE;
		}else if($var == 'CONTAINER_WINDOW_FLAT_RATE_ENVELOPE'){
			return USPSRatePackage::CONTAINER_WINDOW_FLAT_RATE_ENVELOPE;
		}else if($var == 'CONTAINER_GIFT_CARD_FLAT_RATE_ENVELOPE'){
			return USPSRatePackage::CONTAINER_GIFT_CARD_FLAT_RATE_ENVELOPE;
		}else if($var == 'CONTAINER_FLAT_RATE_BOX'){
			return USPSRatePackage::CONTAINER_FLAT_RATE_BOX;
		}else if($var == 'CONTAINER_SM_FLAT_RATE_BOX'){
			return USPSRatePackage::CONTAINER_SM_FLAT_RATE_BOX;
		}else if($var == 'CONTAINER_MD_FLAT_RATE_BOX'){
			return USPSRatePackage::CONTAINER_MD_FLAT_RATE_BOX;
		}else if($var == 'CONTAINER_LG_FLAT_RATE_BOX'){
			return USPSRatePackage::CONTAINER_LG_FLAT_RATE_BOX;
		}else if($var == 'CONTAINER_REGIONALRATEBOXA'){
			return USPSRatePackage::CONTAINER_REGIONALRATEBOXA;
		}else if($var == 'CONTAINER_REGIONALRATEBOXB'){
			return USPSRatePackage::CONTAINER_REGIONALRATEBOXB;
		}else if($var == 'CONTAINER_REGIONALRATEBOXC'){
			return USPSRatePackage::CONTAINER_REGIONALRATEBOXC;
		}else if($var == 'CONTAINER_RECTANGULAR'){
			return USPSRatePackage::CONTAINER_RECTANGULAR;
		}else if($var == 'CONTAINER_NONRECTANGULAR'){
			return USPSRatePackage::CONTAINER_NONRECTANGULAR;
		}else{
			return USPSRatePackage::SERVICE_FIRST_CLASS;
		}
	}
	
	public function USPSshippingrate(){
		$shipid = $this->input->post('shippingid');
		$value =  $this->input->post('value');
		$sellerId = $this->input->post('seller_id');
		$userId = $this->data['common_user_id'];
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
			$usps_details['user_id'] = $this->getUpsProperty('username');
			if ($usps_details['user_id']!= '') {	  
		  //909ZIMPE2238
			$username =$this->getUpsProperty('username');
			$rate = new USPSRate($username);
			$rate->setTestMode(FALSE);
		
			$package_type = $this->getUpsProperty('PackageType');
			$ServiceType = $this->getUpsProperty('ServiceType');
			$containerType = $this->getUpsProperty('Units');
		
			$package = new USPSRatePackage;	
			
			
			// First type method
			$first = 1; // RateV4 calculation
			//$first = 2; // IntlRateV2 calculation
			if($first == 1){
				$package->setService($this->getservice($package_type));
				$package->setFirstClassMailType($this->getservice($ServiceType));
				//$package->setZipOrigination($sellerDetails->row()->postal_code);
				$package->setZipOrigination(91601);
				$package->setZipDestination(91730);
				//$package->setPounds($weight);
				$package->setPounds(0);
				$package->setOunces(9.3);
				$package->setContainer($this->getservice($containerType));
				$package->setSize(USPSRatePackage::SIZE_REGULAR);
				$package->setField('Machinable', true); 
				//$package->setInternationalCall(true);
				//$package->setField('PackageID','0');
			}else{
				$package->setPounds(0);
				$package->setOunces(4.6);
				$package->setField('Machinable', true); 
				$package->setField('MailType', 'PACKAGE');
				$package->ArraysetField('GXG','POBoxFlag','Y');
				$package->ArraysetField('GXG','GiftFlag','Y');
				//$package->setField('POBoxFlag','Y');
				//$package->setField('GiftFlag','Y');
				$package->setField('ValueOfContents',200);
				$package->setField('Country','INDIA');
				$package->setField('Country',$ChangeAdds->row()->country);
				$package->setField('Container','RECTANGULAR');
				//$package->setContainer($this->getservice($containerType));
				$package->setField('Size','REGULAR'); 
				$package->setField('width',0);
				$package->setField('Length',5);
				//$package->setField('Length',$ProductVal->num_rows());
				$package->setField('Height',0);
				$package->setField('Girth',0);
		
				//$package->setField('POBoxFlag','Y');
				$package->setField('OriginZip',91601);
				//$package->setField('OriginZip',$sellerDetails->row()->postal_code);
				$package->setField('CommercialFlag','N');
				$package->setField('AcceptanceDateTime','2015-09-22T13:15:00-06:00');
				$package->setField('DestinationPostalCode',91730);
				$package->setField('DestinationPostalCode',$ChangeAdds->row()->postal_code);
				$package->setField('RatePriceType','B');
				$package->setField('RatePaymentType',3);
				//$package->setField('ExtraService',22201);
				//$package->setField('ExtraServices','');
				//$package->setInternationalCall(true);
			}
			
						
			
			
			
			$rate->addPackage($package);
			$rate->getRate();		
			//print_r($rate->getRate());
 		   //print_r(json_encode($rate->getArrayResponse()));die;
	      // print_r($rate->getErrorMessage());die;
			$shiparr = $rate->getArrayResponse();
 		
 		// Was the call successful
 		if($rate->isSuccess()) {
		
 		} else {
 				echo '0';die;
				//echo 'Error: ' . $rate->getErrorMessage();
 		}
 		if($first == 1){	
		$amount = $shiparr['RateV4Response']['Package']['Postage']['Rate'];
		}else{
		$totalcount = count($shiparr['IntlRateV2Response']['Package']['Service']);
		$amount = $shiparr['IntlRateV2Response']['Package']['Service'][$totalcount-1]['Postage'];
		}
	  // print_r($amount );die;
							 
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