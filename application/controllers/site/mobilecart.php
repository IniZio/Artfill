<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Mobilecart extends MY_Controller { 
	public $mobdata = array();
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('mobile_model');		
		$this->load->model('order_model');		
		
		/* $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'shopsymobileapp') === false) {
			show_404();
		} */
				
		if ($_GET['mobileId']=='' && $_POST['mobileId']==''){
			$this->load->view('mobile/error.php',$this->mobdata);
			die;
		}else{
			if(isset($_GET['mobileId'])){
				$mobileId=$_GET['mobileId'];
			}else{
				$mobileId=$_POST['mobileId'];
			}
			$mobileData=$this->mobile_model->get_all_details(MOBILE_PAYMENT,array( 'id' => $mobileId));
			if($mobileData->num_rows()==0){
				$this->load->view('mobile/error.php',$this->mobdata);
				die;
			}else{
			
				define("StripeDetails",$this->config->item('payment_3'));
				define("PesapalDetails",$this->config->item('payment_6'));
				
				$this->mobdata['mobileId']=$mobileData->row()->id;
				$this->mobdata['userId']=$mobileData->row()->userId;
				$this->mobdata['sellerId']=$mobileData->row()->sellerId;
				$this->mobdata['payment']=$mobileData->row()->payment;
				$this->mobdata['UserrandomNo']=$mobileData->row()->UserrandomNo;
				$this->mobdata['shippingAddress']=$mobileData->row()->shippingAddress;
				$this->mobdata['note']=$mobileData->row()->note;
				$commonId = $mobileData->row()->userId;
			if($commonId>0){
			$checkUserPreference=$this->mobile_model->get_all_details(USER,array('id' => $commonId));
			if($checkUserPreference->num_rows()>=1){
				$condition = array('currency_code'=> $checkUserPreference->row()->currency);
				$GlobalUserName=$checkUserPreference->row()->user_name;
			}else{
				$condition = array('currency_code'=>'HKD');
			}
			} else {
			$condition = array('currency_code'=>'HKD');	
			}  		
			$CurrencyVal=$this->product_model->get_all_details(CURRENCY,$condition);
			$this->data["currencySymbol"]=$CurrencyVal->row()->currency_symbol;
			$this->data["currencyCode"]=$CurrencyVal->row()->currency_code;
			$this->data["currencyValue"]=$CurrencyVal->row()->currency_value;
			}
		} 
    }
  
	/** 
	 * 
	 * Loading index page
	 */
	
	public function index(){
		$this->load->view('mobile/home.php',$this->mobdata);
	} 
	
	/** 
	 * 
	 * Loading Shipping address page
	 */
	
	public function shipping_address(){
		$userId=$this->mobdata['userId'];
		$sellerId=$this->mobdata['sellerId'];	
		$this->mobdata['shippingready'] = $this->checkShippingAddress($userId);
		$this->mobdata['shippingAddress'] = $this->mobile_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userId));
		$storeVal="`s.seller_id` as sellerId,`s.seller_businessname` as shopName,`s.seourl` as shopUrl,`u.thumbnail` as sellerImg";
		$this->mobdata['sellerInfo'] = $this->mobile_model->get_shops_details($sellerId,$storeVal);
		$this->mobdata['productList'] = $this->mobile_model->get_paymentProduct($userId,$sellerId);
		$this->load->view('mobile/shipping.php',$this->mobdata);
	} 
	
	/** 
	 * 
	 * Loading add shipping address
	 */
	
	public function add_shipping(){
		$countryVal="`name`";
		$this->mobdata['countryList'] = $this->mobile_model->get_column_details(COUNTRY_LIST,array(),$countryVal);
		$this->load->view('mobile/add_shipping.php',$this->mobdata);
	}
	/** 
	 * 
	 * save shipping address
	 */
	
	public function save_shipping(){			
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
		$this->form_validation->set_rules('address1', 'Street', 'required');
		$this->form_validation->set_rules('address2', 'Apt/Suite/Other', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		$this->form_validation->set_rules('postal_code', 'Zip/Postal Code', 'required');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required');

		if ($this->form_validation->run() == FALSE){
			$countryVal="`name`";
			$this->mobdata['countryList'] = $this->mobile_model->get_column_details(COUNTRY_LIST,array(),$countryVal);
			$this->load->view('mobile/add_shipping.php',$this->mobdata);
		}else{	
			$userId=$this->mobdata['userId'];
			$countryVal="`id`";
			$checkAddrCount = $this->mobile_model->get_column_details(SHIPPING_ADDRESS,array('user_id'=>$userId),$countryVal);
			$primary='No';
			if ($checkAddrCount->num_rows == 0){
				$primary = 'Yes';
			}
			$dataArr = array('user_id'=>$userId,
										'full_name'=>$this->input->post('full_name'),
										'address1'=>$this->input->post('address1'),
										'address2'=>$this->input->post('address2'),
										'city'=>$this->input->post('city'),
										'state'=>$this->input->post('state'),
										'country'=>$this->input->post('country'),
										'postal_code'=>$this->input->post('postal_code'),
										'phone'=>$this->input->post('phone'),
										'primary'=>$primary
										);
			$this->mobile_model->simple_insert(SHIPPING_ADDRESS,$dataArr);
			$shipID = $this->mobile_model->get_last_insert_id();
			$msg=$this->updateShippingAddress($shipID);
			redirect(base_url().'mobile/shipping-address?mobileId='.$this->mobdata['mobileId']);
		}
	}	
	
	/** 
	 * 
	 * Update Shipping Address
	 */
	public function updateShipping($addrId=""){
		if($addrId>0){
			$msg=$this->updateShippingAddress($addrId);
			if($msg=="Error"){
				redirect(base_url().'mobile/shipping-address?mobileId='.$this->mobdata['mobileId']);
			}else{
				$paymtdata = array('shippingAddress' => $addrId);
				$condition =array('id' => $this->mobdata['mobileId']);
				$this->mobile_model->update_details(MOBILE_PAYMENT,$paymtdata,$condition); 
				$this->mobdata['shippingAddress'] = $addrId;
				$this->addPaymentUserCart($addrId);
				if($this->mobdata['payment']=="Credit-Card"){
					redirect(base_url().'mobile/payment-form?mobileId='.$this->mobdata['mobileId']);
				}else if($this->mobdata['payment']=="Paypal"){
					$this->UserPaymentProcess();
				}else if($this->mobdata['payment']=="Stripe"){
				    redirect(base_url().'mobile/payment-form?mobileId='.$this->mobdata['mobileId']);
				}else if($this->mobdata['payment']=="pesapal"){
				   $this->Pesapal();
				}else if($this->mobdata['payment']=="BrainTree"){
				    redirect(base_url().'mobile/payment-form?mobileId='.$this->mobdata['mobileId']);
				}else if($this->mobdata['payment']=="twocheckout"){
				    redirect(base_url().'mobile/payment-form?mobileId='.$this->mobdata['mobileId']);
				}
				
				
			}
		}
	}
	
	/** 
	 * 
	 * Update Shipping Address
	  * param int $addrId
	 */
	public function updateShippingAddress($addrId=""){
		#$addrId = intval($_GET['addrId']);
		$shopId = intval($this->mobdata['sellerId']);
		$userId = intval($this->mobdata['userId']);
		
		if($addrId>0){
			$ChangeAdds=$this->mobile_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userId,'id' => $addrId));
			$this->db->select("*");
			$this->db->where(array("seller_id"=>$shopId,"state_name"=>$ChangeAdds->row()->state));
			$this->db->from(SELLER_TAX);
			$TaxList=$this->db->get();
				
			if($TaxList->row()->tax_amount > 0){
				$taxAmt = $TaxList->row()->tax_amount;
			}else{
				$taxAmt = 0;
			}
			$ProductVal = $this->mobile_model->get_all_details(USER_SHOPPING_CART,array( 'sell_id' => $shopId, 'user_id' => $userId),array(array('field'=>'id','type'=>'Asc')));	$s=0;			
			foreach($ProductVal->result_array() as $prodtVal){	
				$shipCost = $shipCost1 = 0;
				
				$this->db->select("ship_cost,ship_other_cost");
				$this->db->where(array( 'product_id' => $prodtVal['product_id'],'ship_name' => $ChangeAdds->row()->country));	
				$this->db->from(SUB_SHIPPING);
				$this->db->order_by('ship_id','DESC');
				$SubShipVal=$this->db->get();			
				if($SubShipVal->num_rows() > 0){
					if($s==0){
						$shipCost = $SubShipVal->row()->ship_cost;
					}else{
						$shipCost = $SubShipVal->row()->ship_other_cost;
					}

					$newshipCost = number_format( ($prodtVal['quantity'] * $shipCost),2,'.','');
					$conditionShip = array('id' => $prodtVal['id']);
					$dataArrShip = array('product_shipping_cost' => $shipCost,'shipping_cost' => $newshipCost,'shipping'=>'Yes','tax'=>$taxAmt);
					$this->mobile_model->update_details(USER_SHOPPING_CART,$dataArrShip,$conditionShip); 
					$s++;	
				}else{				
					$this->db->select("ship_cost,ship_other_cost");
					$this->db->where(array( 'product_id' => $prodtVal['product_id'],'ship_name' => 'Everywhere Else'));	
					$this->db->from(SUB_SHIPPING);
					$this->db->order_by('ship_id','DESC');
					$SubShipValNew=$this->db->get();
					
					if($SubShipValNew->num_rows() > 0){
						if($s==0){
							$shipCost1 = $SubShipValNew->row()->ship_cost;
						}else{
							$shipCost1 = $SubShipValNew->row()->ship_other_cost;
						}
						$newshipCost1 = number_format( ($prodtVal['quantity'] * $shipCost1),2,'.','');
						$conditionShip1 = array('id' => $prodtVal['id']);
						$dataArrShip1 = array('product_shipping_cost' => $shipCost1,'shipping_cost' => $newshipCost1,'shipping'=>'Yes','tax'=>$taxAmt);	
						
						$this->mobile_model->update_details(USER_SHOPPING_CART,$dataArrShip1,$conditionShip1); 			
						$s++;	
					}else{
						$conditionShip1 = array('id' => $prodtVal['id']);
						$dataArrShip1 = array('product_shipping_cost' => '0.00','shipping_cost' => '0.00','shipping'=>'No','tax'=>'0.00');	
						$this->mobile_model->update_details(USER_SHOPPING_CART,$dataArrShip1,$conditionShip1); 
					}
					
				}
						
			}
			return  "Success";
		}else{
			return "Error";
		}		
	}
	
	/** 
	 * 
	 * Check Shipping
	  * param int $userId
	 */
	public function checkShippingAddress($userId=""){
		$shopId = intval($this->mobdata['sellerId']);
		#$userId = intval($this->mobdata['userId']);		
		if($userId>0){
			$shippingAddress=$this->mobile_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userId));		
			$cartVal="`product_id`";
			$ProductVal = $this->mobile_model->get_column_details(USER_SHOPPING_CART,array( 'sell_id' => $shopId, 'user_id' => $userId),$cartVal);	
			$contry=array();
			$prdShipping=array();		
			if($shippingAddress->num_rows()>0){
				foreach($ProductVal->result() as $prodtVal){								
					$this->db->select("ship_name");
					$this->db->where(array( 'product_id' => $prodtVal->product_id));	
					$this->db->from(SUB_SHIPPING);
					$SubShipVal=$this->db->get();	
					
					$availcontry=array();
					foreach($SubShipVal->result() as $shippingCountry){
						$availcontry[]=$shippingCountry->ship_name;
					}
					$prdShipping[$prodtVal->product_id]=@implode(',',$availcontry);	
				}
							
				foreach($shippingAddress->result() as $shipping){		
					$status=0;
					foreach($ProductVal->result() as $prodtVal){			
						$shipcnty=@explode(',',$prdShipping[$prodtVal->product_id]);
						if(in_array('Everywhere Else',$shipcnty)){
						}else if(in_array($shipping->country,$shipcnty)){
						}else{
							$status++;
						}
					}
					$contry[$shipping->country]=$status;
				}	
			}
			return $contry;
		}	
	}
	
	
	
	
	
	/** 
	 * 
	 * Loading Credit Card Payment Form
	 */
	
	public function credit_card_form(){
		$userId=$this->mobdata['userId'];
		$sellerId=$this->mobdata['sellerId'];		
		$shipVal="`id`";
    	$checkshipping = $this->mobile_model->get_column_details(USER_SHOPPING_CART,array('user_id'=>$userId,'sell_id'=>$sellerId,'shipping'=>'No'),$shipVal);
		
		if($checkshipping->num_rows()==0){
			$storeVal="`s.seller_id` as sellerId,`s.seller_businessname` as shopName,`s.seourl` as shopUrl,`u.thumbnail` as sellerImg";
			$this->mobdata['sellerInfo'] = $this->mobile_model->get_shops_details($sellerId,$storeVal);
			$this->mobdata['SellerDetails'] = $this->mobile_model->get_all_details(SELLER,array('seller_id'=>$this->mobdata['sellerId']));
			$this->load->view('mobile/credit_card_payment.php',$this->mobdata);
		}else{
		
			redirect(base_url().'mobile/not-shipping?mobileId='.$this->mobdata['mobileId']);
		}
	}
	/** 
	 * 
	 * Adding cart into payment
	 * param int $ShipId1
	 */
	
	public function addPaymentUserCart($ShipId1){		
		$userId=$this->mobdata['userId'];
		$sellerId=$this->mobdata['sellerId'];		
		$shipId=$ShipId1;		
		
		
		$this->db->select('a.*,b.city,b.state,b.country,b.postal_code');
		$this->db->from(USER_SHOPPING_CART.' as a');
		$this->db->join(SHIPPING_ADDRESS.' as b' , 'a.user_id = b.user_id and a.user_id = "'.$userId.'" and b.id="'.$shipId.'"');
		$this->db->where("a.sell_id =".$sellerId);
		$AddPayt = $this->mobile_model->db->get();	
		//echo '<pre>'; print_r($AddPayt->result());
		
		if($this->mobdata['UserrandomNo'] != '') {
			$this->mobile_model->commonDelete(USER_PAYMENT, array('dealCodeNumber' => $this->mobdata['UserrandomNo'],'user_id'=>$userId)); 
			$dealCodeNumberUser = $this->mobdata['UserrandomNo'];
		} else {
			$dealCodeNumberUser = time();
		}
		
		
		
		$cartValues=$this->get_cartValues($userId,$sellerId);
		
		foreach ($AddPayt->result() as $result) {		
		
					if($this->input->post('is_gift')==''){
						$ordergift = 0;
					}else{
						$ordergift = 1;
					}				
				$indTotal = number_format($cartValues['SubTotal'],2);
				$sumTotal = number_format($cartValues['Total'],2); 
						 $dataArr = array(
								'product_id' =>$result->product_id,
								'sell_id' =>$result->sell_id,				
								'price' =>$result->price,
								'quantity' =>$result->quantity,
								'indtotal' =>$indTotal,
								'shippingcountry' =>$result->country,
								'shippingid' =>$shipId,
								'shippingstate' =>$result->state,
								'shippingcity' =>$result->city,
								'shippingcost'=>$result->shipping_cost,
								'tax' =>$cartValues['Tax'],
								'product_shipping_cost'=>$result->product_shipping_cost,
								'product_tax_cost' =>$result->product_tax_cost,
								'coupon_id'  =>$result->couponID,
								'discountAmount' =>$cartValues['Discount'],
								'couponCode'  =>$result->couponCode,
								'coupontype' =>$result->coupontype,
								'sumtotal' =>$sumTotal,
								'user_id' =>$result->user_id,
								'created' => date("Y-m-d H:i:s"),
								'dealCodeNumber' =>$dealCodeNumberUser,
								'status' => "Pending",
								'payment_type' =>$this->mobdata['payment'],
								'attribute_values' =>$result->attribute_values,
								'digital_files'=>$result->digital_files,
								'shipping_status' => "Pending",
								'total'  =>$sumTotal,
								'note' => "Payment done by the mobile device", 
								'order_gift' =>$ordergift,
								'device'=>"Mobile",
								'inserttime' =>time());
																	
			$this->mobile_model->simple_insert(USER_PAYMENT,$dataArr);
		}	
		$paymtdata = array('UserrandomNo' => $dealCodeNumberUser);
		$condition =array('id' => $this->mobdata['mobileId']);
		$this->mobile_model->update_details(MOBILE_PAYMENT,$paymtdata,$condition); 
	}
	
	/** 
	 * 
	 * Get User Values for Shop
	 * param int $user_id
	 * param int $sell_id
	 */
	public function get_cartValues($user_id="",$sell_id=""){		
		$this->db->select('*');
		$this->db->from(USER_SHOPPING_CART);
		$this->db->where('user_id = '.$user_id);
		$this->db->where('sell_id = '.$sell_id);
		$paycart	 = $this->db->get();
		$shopCart=array();
		if($paycart->num_rows() > 0 ){
			$UsercartAmt = 0; $UsercartShippingAmt = 0; $UsercartTaxAmt = 0; 
			foreach ($paycart->result() as $row){		
				$UsercartAmt = $UsercartAmt + ($row->price * $row->quantity);
				$UsercartShippingAmt = $UsercartShippingAmt + $row->shipping_cost;
				$UsercartTaxAmt = $UsercartTaxAmt + ($row->product_tax_cost * $row->quantity);
			}	
			$UsercartTotalAmt=$UsercartAmt+$UsercartShippingAmt+$UsercartTaxAmt;
			$discountAmount = $row->discountAmount;
			$UsercartTotalAmt=$UsercartTotalAmt-$discountAmount;
			
			$shopCart=array('SubTotal'=>$UsercartAmt,
												'Shipping'=>$UsercartShippingAmt,
												'Tax'=>$UsercartTaxAmt,
												'Discount'=>floatval($discountAmount),
												'Total'=>$UsercartTotalAmt);
		}
		
		return $shopCart;
	}
	/** 
	 * 
	 * Payment Process using credit card
	 */
	
	public function userPaymentCard(){
		$userId=$this->mobdata['userId'];
		$sellerId=$this->mobdata['sellerId'];
		$shipId=$this->mobdata['shippingAddress'];
		$note =$this->mobdata['note'];
		
		$cartValues=$this->get_cartValues($userId,$sellerId);
		//echo '<pre>'; print_r($cartValues); die;
		$device="Mobile";
		$userVal="`email`";
    	$userInformation = $this->mobile_model->get_column_details(USERS,array('id'=>$userId),$userVal);
				
		define("API_LOGINID",$this->config->item('payment_1'));
		
		//User ID
		$loginUserId = $userId;
		//DealCodeNumber
		$lastFeatureInsertId = $this->mobdata['UserrandomNo'];
		
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->mobile_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));			
			$this->mobile_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
    	
		$condition =array('id' => $loginUserId);		
		$shippingAddress = $this->mobile_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userId,'id'=>$shipId));
		
		$dataArr = array('user_id'=>$loginUserId,
										'full_name'=>$shippingAddress->row()->full_name,
										'address1'=>$shippingAddress->row()->address1,
										'address2'=>$shippingAddress->row()->address2,
										'city'=>$shippingAddress->row()->city,
										'state'=>$shippingAddress->row()->state,
										'country'=>$shippingAddress->row()->country,
										'postal_code'=>$shippingAddress->row()->postal_code,
										'phone'=>$shippingAddress->row()->phone);
		$this->mobile_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
		
		$this->mobile_model->update_details(USER_PAYMENT,array('billingid' => $insID,'device'=>$device,'note'=>$note),array('dealCodeNumber' => $lastFeatureInsertId));
		
	
		//Authorize.net Intergration

		$Auth_Details=unserialize(API_LOGINID); 
		$Auth_Setting_Details=unserialize($Auth_Details['settings']);	
		
		define("AUTHORIZENET_API_LOGIN_ID",$Auth_Setting_Details['Login_ID']);    // Add your API LOGIN ID
		define("AUTHORIZENET_TRANSACTION_KEY",$Auth_Setting_Details['Transaction_Key']); // Add your API transaction key
		define("API_MODE",$Auth_Setting_Details['mode']);
			

		if(API_MODE	=='sandbox'){
			define("AUTHORIZENET_SANDBOX",true);// Set to false to test against production
		}else{
			define("AUTHORIZENET_SANDBOX",false);
		}       
		define("TEST_REQUEST", "FALSE"); 
		require_once './authorize/AuthorizeNet.php';
				
		$transaction = new AuthorizeNetAIM;
		$transaction->setSandbox(AUTHORIZENET_SANDBOX);
		$transaction->setFields(
					array(
					'amount' =>  number_format($cartValues['Total'],2), 
					'card_num' =>  $this->input->post('cardNumber'), 
					'exp_date' => $this->input->post('CCExpDay').'/'.$this->input->post('CCExpMnth'),
					'first_name' => $shippingAddress->row()->full_name,
					'last_name' => '',
					'address' => $shippingAddress->row()->address1,
					'city' => $shippingAddress->row()->city,
					'state' => $shippingAddress->row()->state,
					'country' =>$shippingAddress->row()->country,
					'phone' => $shippingAddress->row()->phone,
					'email' =>  $userInformation->row()->email,
					'card_code' => $this->input->post('creditCardIdentifier'),
					)
				);
				
				//	echo '<pre>'; print_r($transaction);die;			
				$response = $transaction->authorizeAndCapture();
		
			if( $response->approved ){
				redirect('mobile/success/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$response->transaction_id.'?mobileId='.$this->mobdata['mobileId']);
 			}else{		
				redirect('mobile/failed/'.$response->response_reason_text.'?mobileId='.$this->mobdata['mobileId']); 
			}
		
	}
	
	
		public function PaymentCreditAjax(){
		
	 try{
	 
		$userId=$this->mobdata['userId'];
		$sellerId=$this->mobdata['sellerId'];
		$shipId=$this->mobdata['shippingAddress'];
		$note =$this->mobdata['note'];
		$loginUserId = $userId;  //User ID
	    $lastFeatureInsertId = $this->mobdata['UserrandomNo'];
		$cartValues=$this->get_cartValues($userId,$sellerId); //DealCodeNumber
		
		
		$device="Mobile";
		$userVal="`email`";
    	$userInformation = $this->mobile_model->get_column_details(USERS,array('id'=>$userId),$userVal);
		
		
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->mobile_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->mobile_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		
    	
		$condition =array('id' => $loginUserId);		
		$shippingAddress = $this->mobile_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userId,'id'=>$shipId));
		$dataArr = array('user_id'=>$loginUserId,
										'full_name'=>$shippingAddress->row()->full_name,
										'address1'=>$shippingAddress->row()->address1,
										'address2'=>$shippingAddress->row()->address2,
										'city'=>$shippingAddress->row()->city,
										'state'=>$shippingAddress->row()->state,
										'country'=>$shippingAddress->row()->country,
										'postal_code'=>$shippingAddress->row()->postal_code,
										'phone'=>$shippingAddress->row()->phone);
		$this->mobile_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
		
		
		$this->mobile_model->update_details(USER_PAYMENT,array('billingid' => $insID,'device'=>$device,'note'=>$note),array('dealCodeNumber' => $lastFeatureInsertId));
		$amount = number_format($cartValues['Total'],2);
		$Auth_Details=unserialize($this->config->item('payment_5'));
		$Setting_Details = unserialize($Auth_Details['settings']);
		$this->load->library('Braintree');
		
		if ($Setting_Details['mode']=='sandbox'){
			$Environ_mode = 'sandbox';
		}else {
			$Environ_mode = 'production';
		}
		#$Environ_mode = 'sandbox';
		//echo 'in';die;
		Braintree_Configuration::environment($Environ_mode);//sandbox or production
		Braintree_Configuration::merchantId($Setting_Details['MerchantId']);
		Braintree_Configuration::publicKey($Setting_Details['PublicKey']);
		Braintree_Configuration::privateKey($Setting_Details['PrivateKey']);
		#Braintree_Configuration::sslOn();
		$result = Braintree_Transaction::sale(array(
		    'amount' => $amount,
		    'creditCard' => array(				
		        'number' => $this->input->post('cardNumber'),
				'cvv' => $this->input->post('creditCardIdentifier'),
		        'expirationMonth' => $this->input->post('CCExpDay'),
		        'expirationYear' => $this->input->post('CCExpMnth'),
				
        	),
        	'options' => array(
				"submitForSettlement" => true
			)
        ));
		//echo "<pre>";print_r($result);die;
        if ($result->success) {
			redirect('mobile/success/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$result->transaction_id.'?mobileId='.$this->mobdata['mobileId']);
        }else{
			$error_msg = str_replace("-"," ",url_title('Invalid credentials'));
			redirect('mobile/failed/'.$error_msg.'?mobileId='.$this->mobdata['mobileId']); 
			
		}
	 }catch(Exception $e){
			redirect('mobile/failed/'.$e->getMessage().'?mobileId='.$this->mobdata['mobileId']); 
      
	 }
	}
	
	
		public function UserPaymentProcess(){
		
		$paypal_ipn_settings = unserialize($this->config->item('payment_0'));
		$paypalProcess = unserialize($paypal_ipn_settings['settings']); 
		$paypalmode  = $paypalProcess['mode'];
		$paypalEmail = $paypalProcess['merchant_email'];
		
		
		
		$userId=$this->mobdata['userId'];
		$sellerId=$this->mobdata['sellerId'];
		$shipId=$this->mobdata['shippingAddress'];
		$note =$this->mobdata['note'];
		$loginUserId = $userId;  //User ID
	    $lastFeatureInsertId = $this->mobdata['UserrandomNo'];
		$cartValues=$this->get_cartValues($userId,$sellerId); //DealCodeNumber
		
		
		$device="Mobile";
		$userVal="`email`";
    	$userInformation = $this->mobile_model->get_column_details(USERS,array('id'=>$userId),$userVal);
		
		
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->mobile_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->mobile_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		
    	
		$condition =array('id' => $loginUserId);		
		$shippingAddress = $this->mobile_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userId,'id'=>$shipId));
		$dataArr = array('user_id'=>$loginUserId,
										'full_name'=>$shippingAddress->row()->full_name,
										'address1'=>$shippingAddress->row()->address1,
										'address2'=>$shippingAddress->row()->address2,
										'city'=>$shippingAddress->row()->city,
										'state'=>$shippingAddress->row()->state,
										'country'=>$shippingAddress->row()->country,
										'postal_code'=>$shippingAddress->row()->postal_code,
										'phone'=>$shippingAddress->row()->phone);					
		$this->mobile_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
		$this->mobile_model->update_details(USER_PAYMENT,array('billingid' => $insID,'device'=>$device,'note'=>$note),array('dealCodeNumber' => $lastFeatureInsertId));
		
		
		
			/*Paypal integration start */
			$this->load->library('paypal_class');
			
			$item_name = $this->config->item('email_title').' Products';
			
			$totalAmount =  number_format($cartValues['Total'],2);
			
			
			$quantity = 1;
			
			if($paypalmode == 'sandbox'){
				$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
			}else{
				$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
			}
			
			$this->paypal_class->add_field('currency_code', $this->data['currencyType']);
			
			$this->paypal_class->add_field('business',$paypalEmail); // Business Email
			$transaction_id = 1; //my purpose
			$this->paypal_class->add_field('return',base_url().'mobile/success/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$transaction_id.'?mobileId='.$this->mobdata['mobileId']); // Return URL
			
			$this->paypal_class->add_field('cancel_return', base_url().'mobile/failed/failure?mobileId='.$this->mobdata['mobileId']);
			// Cancel URL
			
			$this->paypal_class->add_field('notify_url', base_url().'site/order/ipnpayment'); // Notify url
			
			$this->paypal_class->add_field('custom', 'SellerProduct|'.$loginUserId.'|'.$lastFeatureInsertId); // Custom Values			
			
			$this->paypal_class->add_field('item_name', $item_name); // Product Name
			
			$this->paypal_class->add_field('user_id', $loginUserId);
			
			$this->paypal_class->add_field('quantity', $quantity); // Quantity
			//echo $totalAmount;die;
			  $this->paypal_class->add_field('amount', $totalAmount); // Price
			//$this->paypal_class->add_field('amount', 1); // Price
			
			//echo base_url().'order/sellersuccess/'.$loginUserId.'/'.$lastFeatureInsertId; //die;
			
			$this->paypal_class->submit_paypal_post(); 
						
	}
	
	
	
	/** 
	 * 
	 * Payment submit for Stripe gateway for user
	 *
	 */
	public function UserPaymentCreditStripe(){
		$userId=$this->mobdata['userId'];
		$sellerId=$this->mobdata['sellerId'];
		$shipId=$this->mobdata['shippingAddress'];
		$note =$this->mobdata['note'];
		$loginUserId = $userId;  //User ID
	    $lastFeatureInsertId = $this->mobdata['UserrandomNo'];
		$cartValues=$this->get_cartValues($userId,$sellerId); //DealCodeNumber
		
		
		
		$device="Mobile";
		$userVal="`email`";
    	$userInformation = $this->mobile_model->get_column_details(USERS,array('id'=>$userId),$userVal);
		$email = $userInformation->row()->email;
		
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->mobile_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->mobile_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		
    	
		$condition =array('id' => $loginUserId);		
		$shippingAddress = $this->mobile_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userId,'id'=>$shipId));
		$dataArr = array('user_id'=>$loginUserId,
										'full_name'=>$shippingAddress->row()->full_name,
										'address1'=>$shippingAddress->row()->address1,
										'address2'=>$shippingAddress->row()->address2,
										'city'=>$shippingAddress->row()->city,
										'state'=>$shippingAddress->row()->state,
										'country'=>$shippingAddress->row()->country,
										'postal_code'=>$shippingAddress->row()->postal_code,
										'phone'=>$shippingAddress->row()->phone);
		$this->mobile_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
		
		
		$this->mobile_model->update_details(USER_PAYMENT,array('billingid' => $insID,'device'=>$device,'note'=>$note),array('dealCodeNumber' => $lastFeatureInsertId));
		//$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
			
		//Stripe Intergration
            $token = $this->input->post('stripeToken');
			$StripDetVal=unserialize(StripeDetails); 			
			$StripeVals=unserialize($StripDetVal['settings']);	
			
			
			require_once('./stripe/lib/Stripe.php');

			$secret_key = $StripeVals['secret_key'];
			$publishable_key = $StripeVals['publishable_key'];

			$stripe = array(
				"secret_key"      => $secret_key,
				"publishable_key" => $publishable_key
			);
			//echo '<pre>'; print_r($stripe);die;
            
			Stripe::setApiKey($stripe['secret_key']);

			$token = $this->input->post('stripeToken');
			
			$amounts =  number_format($cartValues['Total'],2);
			
			try {

				// Create a Customer
				$customer = Stripe_Customer::create(array(
					"card" => $token,
					"description" => "Product Purhcase for ".$this->config->item('email_title'),
					"email" => $email)
				);

				// Charge the Customer instead of the card
				Stripe_Charge::create(array(
					"amount" => $amounts, # amount in cents, again
					"currency" => $this->data['currencyType'],
					"customer" => $customer->id)
				);
			
					redirect('mobile/success/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$token.'?mobileId='.$this->mobdata['mobileId']);
			} catch (Exception $e) {    
				$error = $e->getMessage();
				redirect('mobile/failed/'.$error.'?mobileId='.$this->mobdata['mobileId']); 
			}	
				
		
	}
	
	
	  public function Paymenttwocheckout(){
		$userId=$this->mobdata['userId'];
		$sellerId=$this->mobdata['sellerId'];
		$shipId=$this->mobdata['shippingAddress'];
		$note =$this->mobdata['note'];
		$loginUserId = $userId;  //User ID
	    $lastFeatureInsertId = $this->mobdata['UserrandomNo'];
		$cartValues=$this->get_cartValues($userId,$sellerId); //DealCodeNumber
		
		
		$device="Mobile";
		$userVal="`email`";
    	$userInformation = $this->mobile_model->get_column_details(USERS,array('id'=>$userId),$userVal);
		$email = $userInformation->row()->email;
		
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->mobile_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->mobile_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		
    	
		$condition =array('id' => $loginUserId);		
		$shippingAddress = $this->mobile_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userId,'id'=>$shipId));
		$dataArr = array('user_id'=>$loginUserId,
										'full_name'=>$shippingAddress->row()->full_name,
										'address1'=>$shippingAddress->row()->address1,
										'address2'=>$shippingAddress->row()->address2,
										'city'=>$shippingAddress->row()->city,
										'state'=>$shippingAddress->row()->state,
										'country'=>$shippingAddress->row()->country,
										'postal_code'=>$shippingAddress->row()->postal_code,
										'phone'=>$shippingAddress->row()->phone);
		$this->mobile_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
		
		
		$this->mobile_model->update_details(USER_PAYMENT,array('billingid' => $insID,'device'=>$device,'note'=>$note),array('dealCodeNumber' => $lastFeatureInsertId));
		$totalAmount =  number_format($cartValues['Total'],2);
		
		
		$this->load->library('Twocheckout');
		Twocheckout::privateKey($this->input->post('PrivateKey'));
		Twocheckout::sellerId($this->input->post('SellerId'));
		if($this->input->post('Mode') == "sandbox")
			Twocheckout::sandbox(true); 
		else
			Twocheckout::sandbox(false);
		$tokenid=$this->input->post('token');
			//echo $lastFeatureInsertId;die;
		$item_name = $this->config->item('email_title').' Products';
			
		//$totalAmount = $this->input->post('total_price');
			
		$quantity = 1;
		//echo "sadf";
		try {
					
					$charge = Twocheckout_Charge::auth(array(
					"merchantOrderId" => "123",
					"token" =>$tokenid,
					"currency" => $this->data['currencyType'],
					"total" => $totalAmount,
					"billingAddr" => array(
					"name" => 'Testing Tester',
					"addrLine1" => '123 Test St',
					"city" => 'Columbus',
					"state" => 'OH',
					"zipCode" => '43123',
					"country" => 'USA',
					"email" => 'dummy@dummy.com',
					"phoneNumber" => '555-555-5555'
					),
					"shippingAddr" => array(
					"name" => 'Testing Tester',
					"addrLine1" => '123 Test St',
					"city" => 'Columbus',
					"state" => 'OH',
					"zipCode" => '43123',
					"country" => 'USA',
					"email" => 'dummy@dummy.com',
					"phoneNumber" => '555-555-5555'
					)
					), 'array');
						$result=(array)json_decode($charge);
						//echo "<pre>";print_r($result[exception]->errorMsg);
						#echo "<pre>";print_r($result);die;
						
						$rescod=$result['response'];
						if(($rescod->responseCode)=="APPROVED")
						{
							redirect('mobile/success/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$tokenid.'?mobileId='.$this->mobdata['mobileId']);
						}
						else{
							$rescod=$result[exception]->errorMsg;
							redirect('mobile/failed/'.str_replace("-"," ",url_title($rescod)).'?mobileId='.$this->mobdata['mobileId']); 
						}
		} catch (Twocheckout_Error $e) {
			$e->getMessage();
		}
						
	}
	
	
		public function Pesapal(){
		include_once('OAuth.php');
		$PesaDetVal=unserialize(PesapalDetails); 			
		$PesapalVals=unserialize($PesaDetVal['settings']);	
		//User ID
		
		$userId=$this->mobdata['userId'];
		$sellerId=$this->mobdata['sellerId'];
		$shipId=$this->mobdata['shippingAddress'];
		$note =$this->mobdata['note'];
		$loginUserId = $userId;  //User ID
	    $lastFeatureInsertId = $this->mobdata['UserrandomNo'];
		$cartValues=$this->get_cartValues($userId,$sellerId); //DealCodeNumber
		
		
		$device="Mobile";
		$userVal="`email`,`full_name`";
    	$userInformation = $this->mobile_model->get_column_details(USERS,array('id'=>$userId),$userVal);
		$email = $userInformation->row()->email;
		
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->mobile_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->mobile_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		
    	
		$condition =array('id' => $loginUserId);		
		$shippingAddress = $this->mobile_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userId,'id'=>$shipId));
		$full_name =$shippingAddress->row()->full_name;
		$phone = $shippingAddress->row()->phone;
		$dataArr = array('user_id'=>$loginUserId,
										'full_name'=>$shippingAddress->row()->full_name,
										'address1'=>$shippingAddress->row()->address1,
										'address2'=>$shippingAddress->row()->address2,
										'city'=>$shippingAddress->row()->city,
										'state'=>$shippingAddress->row()->state,
										'country'=>$shippingAddress->row()->country,
										'postal_code'=>$shippingAddress->row()->postal_code,
										'phone'=>$shippingAddress->row()->phone);
		$this->mobile_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
		
		
		$this->mobile_model->update_details(USER_PAYMENT,array('billingid' => $insID,'device'=>$device,'note'=>$note),array('dealCodeNumber' => $lastFeatureInsertId));
		
		
		/********************Pesapal Credentials**************/
		$token = $params = NULL;
		$consumer_key = $PesapalVals['consumer_key'];
		$consumer_secret = $PesapalVals['consumer_secret'];
		$signature_method = new OAuthSignatureMethod_HMAC_SHA1();
		if($PesapalVals['mode'] =='sandbox'){
			$iframelink = 'http://demo.pesapal.com/api/PostPesapalDirectOrderV4';
		}else{
			$iframelink = 'https://www.pesapal.com/API/PostPesapalDirectOrderV4';
		}
		/********************Pass Details to Pesapal**************/
		$amount =  number_format($cartValues['Total'],2);
		$desc = "description";
		$type = "MERCHANT";
		$reference = $lastFeatureInsertId;
		$first_name = $full_name;
		$last_name = $first_name;
		$email =     $email;
		$phonenumber = $phone;
		/**************post transaction to pesapal**************/
		$callback_url = base_url().'mobile/pesapal_response?mobileId='.$this->mobdata['mobileId'];
		//$callback_url =  base_url().'mobile/success/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$tokenid.'?mobileId='.$this->mobdata['mobileId'];
		$post_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?><PesapalDirectOrderInfo xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" Amount=\"".$amount."\" Description=\"".$desc."\" Type=\"".$type."\" Reference=\"".$reference."\" FirstName=\"".$first_name."\" LastName=\"".$last_name."\" Email=\"".$email."\" PhoneNumber=\"".$phonenumber."\" xmlns=\"http://www.pesapal.com\" />";
		$post_xml = htmlentities($post_xml);
		$consumer = new OAuthConsumer($consumer_key, $consumer_secret);
		$iframe_src = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $iframelink, $params);
		$iframe_src->set_parameter("oauth_callback", $callback_url);
		$iframe_src->set_parameter("pesapal_request_data", $post_xml);
		$iframe_src->sign_request($signature_method, $consumer, $token);
		$this->data['pesapalView'] = '<iframe src="'.$iframe_src.'" width="100%" height="700px"  scrolling="no" frameBorder="0"><p>Browser unable to load iFrame</p></iframe>';
		$this->load->view('site/checkout/pesapal1.php',$this->data);
	}
	
	public function pesapal_response(){
		$userId=$this->mobdata['userId'];
		$sellerId=$this->mobdata['sellerId'];
		$loginUserId = $userId;  //User ID
	    $lastFeatureInsertId = $this->mobdata['UserrandomNo'];
		$orderId 	= 	$_GET['pesapal_merchant_reference'];
		$trackingId	= 	$_GET['pesapal_transaction_tracking_id'];
		redirect('mobile/success/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$trackingId.'?mobileId='.$this->mobdata['mobileId']);
	}
	
	/** 
	 * 
	 * display shipping notification
	 */
	
	public function not_shipping(){
		$userId=$this->mobdata['userId'];
		$sellerId=$this->mobdata['sellerId'];
		$shipId=$this->mobdata['shippingAddress'];
		$this->mobdata['shippingAddress'] = $this->mobile_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userId,'id'=>$shipId));
		$this->load->view('mobile/not_shipping.php',$this->mobdata);
	}
	
	/** 
	 * 
	 * Loading success payment
	 */
	
	public function pay_success(){
	//print_r( $_REQUEST);die;
		if($this->uri->segment(5)==''){
			$transId = $_REQUEST['txn_id'];
			$Pray_Email = $_REQUEST['payer_email'];
		}else{
			$transId = $this->uri->segment(5);
			$Pray_Email = '';
		}
		
		$payVal="`id`";
		$UserPaymentSuccessCheck = $this->mobile_model->get_column_details(USER_PAYMENT,array( 'user_id' => $this->uri->segment(3), 'dealCodeNumber' => $this->uri->segment(4),'status'=>'Paid'),$payVal);		
		
		if($UserPaymentSuccessCheck->num_rows() == 0){
			$this->mobdata['Confirmation'] = $this->order_model->MobilePaymentSuccess($this->uri->segment(3),$this->uri->segment(4),$transId,$Pray_Email);	
		}
		$this->load->view('mobile/success.php',$this->mobdata);
	}
	
	/** 
	 * 
	 * Loading failed payment
	 */
	
	public function pay_failed(){
		$this->mobdata['errors'] = $this->uri->segment(3);
		$this->load->view('mobile/failed.php',$this->mobdata);
	}
	/** 
	 * 
	 * Connecting back to mobile application
	 */
	
	public function payment_return(){
		$this->mobdata['msg'] = $this->uri->segment(3);
		$this->clearPayData();
		$this->load->view('mobile/payment_return.php',$this->mobdata);
	}
	
	/** 
	 * 
	 *Delete Payment Records
	 */
	
	public function clearPayData(){
		$this->mobile_model->commonDelete(MOBILE_PAYMENT, array('id' => $this->mobdata['mobileId'])); 
	}
	
	public function checkCode(){
	
		$Code = $this->input->post('code');
		$amount = $this->input->post('amount'); 
		$shipamount = $this->input->post('shipamount'); 
		$userId=$this->mobdata['userId'];
		$sellerId=$this->mobdata['sellerId'];
		echo $this->Check_Code_Val($Code,$amount,$shipamount,$sellerId,$userId);
		
		
		if($this->lang->line('copuncode_applied') != '') { $copuncode_applied= stripslashes($this->lang->line('copuncode_applied')); } else { $copuncode_applied = "Coupon Code Applied Successfully"; }
	
	}
	

		
	
	

}

/* End of file user.php */
/* Location: ./application/controllers/site/mobilecart.php */