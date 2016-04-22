<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Casperon
 *
 */

class Checkout extends MY_Controller { 
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('admin_model');		
		$this->load->model('checkout_model');

		
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['countryList'] = $this->checkout_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')));
		define("API_LOGINID",$this->config->item('payment_1'));
		define("StripeDetails",$this->config->item('payment_3'));
		define("TwoCheckoutDetails",$this->config->item('payment_5'));
		define("PesapalDetails",$this->config->item('payment_6'));
    }
    
  
	/**
	 * 
	 * Loading Cart Page
	 */
	
	public function index(){
	 		//print_r($this->input->post());die;
		if ($this->data['loginCheck'] != ''){
			$this->data['meta_title'] = $this->data['heading'] = 'Checkout'; 
		
			$giftpaytype=$this->input->post('gift_payment_value');
				#echo "<pre>";print_r($this->input->post());die;
			if($this->uri->segment(2) == 'gift'){
				$giftpaytype=$this->input->post('gift_payment_value');
				$this->data['CheckoutVal'] = $this->checkout_model->get_all_details(USER_PAYMENT,array('dealCodeNumber'=>$this->session->userdata('UserrandomNo')));
				//echo '<pre>'; print_r($this->data['CheckoutVal']->row()->sell_id); die;
				$this->data['SellerDetails'] = $this->checkout_model->get_all_details(SELLER,array('seller_id'=>$this->data['CheckoutVal']->row()->sell_id));
				$this->data['shipValDetails'] = $this->checkout_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $this->data['CheckoutVal']->row()->shippingid));
				//echo '<pre>'; print_r($this->data['SellerDetails']->result_array()); die;
				//echo '<pre>'; print_r($this->data['shipValDetails']->result_array()); die;
				//$this->data['checkoutViewResults'] = $this->checkout_model->mani_checkout_total($this->data['common_user_id']);

/* debug output
$file = fopen("/home/llfmcjqa/phpdebug.txt", "w");
fwrite($file, $this->admin_model->getAdminSettings()->row()->buyer_commission);
fclose($file);
die();
*/
	
				$this->data['UserCheckoutResults'] = $this->checkout_model->mani_user_checkout_total($this->data['common_user_id'], $this->data['CheckoutVal']->row()->payment_type);				
				$this->data['GiftViewTotal'] = $this->checkout_model->mani_gift_total($this->data['common_user_id']);				
				//$this->data['SubCribViewTotal'] = $this->checkout_model->mani_subcribe_total($this->data['common_user_id']);							
				//echo '<pre>'; print_r($this->data['UserCheckoutResults']); die;
				$this->data['discountQuery'] = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array('user_id'=>$this->data['common_user_id']));
				$this->data['countryList'] = $this->checkout_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')));
				$this->load->view('site/checkout/'.$giftpaytype.'.php',$this->data);
			}else{
				$this->data['CheckoutVal'] = $this->checkout_model->get_all_details(USER_PAYMENT,array('dealCodeNumber'=>$this->session->userdata('UserrandomNo')));
//				echo '<pre>'; print_r($this->data['CheckoutVal']->result()); die;
				$this->data['SellerDetails'] = $this->checkout_model->get_all_details(SELLER,array('seller_id'=>$this->data['CheckoutVal']->row()->sell_id));
				$this->data['shipValDetails'] = $this->checkout_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $this->data['CheckoutVal']->row()->shippingid));
				//echo '<pre>'; print_r($this->data['SellerDetails']->result_array()); die;
				//echo '<pre>'; print_r($this->data['shipValDetails']->result_array()); die;
				//$this->data['checkoutViewResults'] = $this->checkout_model->mani_checkout_total($this->data['common_user_id']);	
				$this->data['UserCheckoutResults'] = $this->checkout_model->mani_user_checkout_total($this->data['common_user_id'], $this->data['CheckoutVal']->row()->payment_type);				
				$this->data['GiftViewTotal'] = $this->checkout_model->mani_gift_total($this->data['common_user_id']);				
                                if($this->data['CheckoutVal']->row()->payment_type == 'payon'){
                                    $this->load->library('payon');
                                    $UsercheckAmt = @explode('|',$this->data['UserCheckoutResults']);
                                    $this->data['payon'] = $this->payon->get_checkout_id_script(number_format($UsercheckAmt[3] * $this->data['currencyValue'],2,'.',''));
                                }                                
				//$this->data['SubCribViewTotal'] = $this->checkout_model->mani_subcribe_total($this->data['common_user_id']);							
				//echo '<pre>'; print_r($this->data['UserCheckoutResults']); die;
				$this->data['discountQuery'] = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array('user_id'=>$this->data['common_user_id']));
				$this->data['countryList'] = $this->checkout_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')));	
				//$this->data['buyer_commission'] = $this->admin_model->getAdminSettings()->row()->buyer_commission;
				$this->load->view('site/checkout/checkout.php',$this->data);
			}
		}else{
			redirect('login');
		}	
	}
	
	
	/** 
	 * 
	 * Reedem Gift code Check function 
	 *
	 */	
	public function ReedemCheckCode(){
		
		$Code = $this->input->post('code');
		$amount = $this->input->post('amount'); 
		$shipamount = $this->input->post('shipamount'); 
		$taxamount = $this->input->post('taxamount'); 
		$discountamount = $this->input->post('discountamount'); 
		$giftdiscountamount = $this->input->post('giftdiscountamount'); 
		$cartlessamount = $this->input->post('cartlessamount'); 						
				
		
		echo $this->checkout_model->Gift_Check_Code_Val($Code,$amount,$shipamount,$taxamount,$discountamount,$giftdiscountamount,$cartlessamount,$this->data['common_user_id']);
		$this->setErrorMessage('success','Gift Card Applied Successfully');

		return;
	
	}
	
	/** 
	 * 
	 * Gift Card Code Remove function
	 *
	 */
	public function ReedemcheckCodeRemove(){
		$this->checkout_model->Gift_Code_Val_Remove($this->data['common_user_id']);
		$this->setErrorMessage('success','Gift Card Removed Successfully');
		return;
	}
	
	/** 
	 * 
	 * Payment sumit for two checkout gateway for user
	 *
	 */
   public function Paymenttwocheckout(){
			//echo "asdfasdf";
         /*  $shipValID = $this->checkout_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $this->input->post('shipping_id')));
		  $twocheckoutDetVal=unserialize(TwoCheckoutDetails); 			
		  $twocheckoutVals=unserialize($twocheckoutDetVal['settings']);
		  $loginUserId = $this->checkLogin('U');
		  $lastFeatureInsertId = $this->session->userdata('UserrandomNo');
		
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->checkout_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		
    	
		$condition =array('id' => $loginUserId);
		$dataArr = array('user_id'=>$loginUserId,'full_name'=>$this->input->post('full_name'),'address1'=>$this->input->post('address'),'address2'=>$this->input->post('address2'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postal_code'),'phone'=>$this->input->post('phone_no'));
		$this->checkout_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
       
        $this->checkout_model->update_details(USER_PAYMENT,array('billingid' => $insID,'sumtotal'=>number_format($this->input->post('total_price'),2,'.','')),array('dealCodeNumber' => $lastFeatureInsertId));
		$this->load->library('twocheckout_class');
		$item_name = $this->config->item('email_title').' Products';
		
		$totalAmount = $this->input->post('total_price')*$this->data['currencyValue'];
		//User ID
		$loginUserId = $this->checkLogin('U');
		//DealCodeNumber
           

		$quantity = 1;
			
		if(strtoupper($twocheckoutVals['mode']) == 'SANDBOX'){
			$this->twocheckout_class->twocheckout_url = 'https://sandbox.2checkout.com/checkout/purchase';   
		}else{
			$this->twocheckout_class->twocheckout_url = 'https://www.2checkout.com/checkot/purchase';     
        }
			
		$this->twocheckout_class->add_field('currency', $this->data['currencyType']);
		$this->twocheckout_class->add_field('mode','2CO');
		$this->twocheckout_class->add_field('sid',$twocheckoutVals['Merchant_ID']);
			
	     if(strtoupper($twocheckoutVals['mode']) == 'SANDBOX') $this->twocheckout_class->add_field("demo", "Y");
		
		 $this->twocheckout_class->add_field('x_receipt_link_url',base_url().'order/twocheckoutsuccess/'.$loginUserId.'/'.$lastFeatureInsertId); 
			
	        

		    //products, shipping...
			$this->twocheckout_class->add_field("merchant_order_id", $loginUserId."_".$lastFeatureInsertId);
		    $this->twocheckout_class->add_field("li_0_type", "product");
		    $this->twocheckout_class->add_field("li_0_name", $item_name);
		    $this->twocheckout_class->add_field("li_0_product_id", "12");
		    $this->twocheckout_class->add_field("li_0_price", $totalAmount);
		    $this->twocheckout_class->add_field("li_0_quantity", $quantity);
		    $this->twocheckout_class->add_field("li_0_tangible", "Y");
		    
		    //shipping can enter all details using seperate child after li
		    $this->twocheckout_class->add_field("li_1_type", "shipping");
		    $this->twocheckout_class->add_field("li_1_name", "manual");
		    $this->twocheckout_class->add_field("li_1_price", "0");			
				
							
			
			
			//$this->twocheckout_class->add_field('custom', 'Product|'.$loginUserId.'|'.$lastFeatureInsertId); 
			$this->twocheckout_class->add_field('card_holder_name', $this->input->post('full_name')); 
			$this->twocheckout_class->add_field('street_address', $this->input->post('address')); 
			$this->twocheckout_class->add_field('street_address2', $loginUserId);			
			$this->twocheckout_class->add_field('city', $this->input->post('city')); 
			$this->twocheckout_class->add_field('state', $this->input->post('state')); 
			$this->twocheckout_class->add_field('country', $this->input->post('country')); 
			$this->twocheckout_class->add_field('zip', $this->input->post('postal_code'));
			$this->twocheckout_class->add_field('email', $quantity); 
			$this->twocheckout_class->add_field('phone', $this->input->post('phone_no'));
			$this->twocheckout_class->add_field('phone_extension', ''); 

		    $this->twocheckout_class->add_field('ship_name', $shipValID->row()->full_name);
			$this->twocheckout_class->add_field('ship_street_address', $shipValID->row()->address1); 
			$this->twocheckout_class->add_field('ship_street_address2', $shipValID->row()->address2);
			$this->twocheckout_class->add_field('ship_city',  $shipValID->row()->city);
			$this->twocheckout_class->add_field('ship_state', $shipValID->row()->state); 
			$this->twocheckout_class->add_field('ship_zip', $shipValID->row()->postal_code);
			$this->twocheckout_class->add_field('ship_country', $shipValID->row()->country);
            $this->twocheckout_class->submit_twocheckout_post(); 
		 */	
			  #echo "<pre>";print_r($this->input->post());die;
		$loginUserId = $this->checkLogin('U');
		$lastFeatureInsertId = $this->session->userdata('UserrandomNo');
		$excludeArr = array('Mode','PublishableKey','SellerId','PrivateKey','cart_price','reedemcode','cardType','cart_less_price','ship_price','tax_price','discount_price','gift_discount_price','creditvalue','card_name','shipping_id','email','ccNo','expMonth','expYear','cvv','total_price','CreditSubmit','token','full_name');
		$dataArr = array();
		$condition =array('id' => $this->checkLogin('U'));
		$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
		$dataArr = array('user_id'=>$loginUserId,'full_name'=>$this->input->post('full_name'),'address1'=>$this->input->post('address'),'address2'=>$this->input->post('address2'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postal_code'),'phone'=>$this->input->post('phone_no'));
		$this->checkout_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
		$this->checkout_model->update_details(USER_PAYMENT,array('billingid' => $insID,'sumtotal'=>number_format($this->input->post('total_price'),2,'.','')),array('dealCodeNumber' => $lastFeatureInsertId));
		$this->load->library('Twocheckout');
		Twocheckout::privateKey($this->input->post('PrivateKey'));
		Twocheckout::sellerId($this->input->post('SellerId'));
		if($this->input->post('Mode') == "sandbox")
			Twocheckout::sandbox(true); 
		else
			Twocheckout::sandbox(false);
		$tokenid=$this->input->post('token');
		//echo $tokenid;die;
		
			//echo $lastFeatureInsertId;die;
		$item_name = $this->config->item('email_title').' Products';
			
		$totalAmount = $this->input->post('total_price');
			
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
							redirect('order/sellersuccess/'.$loginUserId.'/'.$lastFeatureInsertId);
						}
						else{
							$rescod=$result[exception]->errorMsg;
						
							redirect('order/failure/'.str_replace("-"," ",url_title($rescod)));
						}
		} catch (Twocheckout_Error $e) {
			$e->getMessage();
		}
						
	}
	public function Paymenttwocheckout_feature()
	{
		#echo "<pre>";print_r($this->input->post());die;		
		$this->load->library('Twocheckout');
		Twocheckout::privateKey($this->input->post('PrivateKey'));
		Twocheckout::sellerId($this->input->post('SellerId'));
		if($this->input->post('Mode') == "sandbox")
			Twocheckout::sandbox(true); 
		else
			Twocheckout::sandbox(false);
		$tokenid=$this->input->post('token');
		//echo $tokenid;die;
		$loginUserId = $this->checkLogin('U');
			
			//echo $lastFeatureInsertId;die;
		$item_name = "feature product payment";
			
		$totalAmount = $this->input->post('cart_price')*$this->data['currencyValue'];
			
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
					"email" => 'testingtester@2co.com',
					"phoneNumber" => '555-555-5555'
					),
					"shippingAddr" => array(
					"name" => 'Testing Tester',
					"addrLine1" => '123 Test St',
					"city" => 'Columbus',
					"state" => 'OH',
					"zipCode" => '43123',
					"country" => 'USA',
					"email" => 'testingtester@dummy.com',
					"phoneNumber" => '555-555-5555'
					)
					), 'array');
						$result=(array)json_decode($charge);
						#echo "<pre>";print_r($result[exception]->errorMsg);
						#echo "<pre>";print_r($result['response']);#die;
						
						//$rescod=$result['response'];
						if(($result['response']->responseCode)=="APPROVED")
						{
							#echo "asdf";
							$dataArr=array(
									'pack_id'=>$this->input->post('packid'),
									'user_id'=>$this->checkLogin('U'),
									'amount'=>$this->input->post('cart_price'),
									'expire_date'=>$this->input->post('expire'),
									'product_seo'=>$this->input->post('product_seourl'),
									'start_date'=>$this->input->post('start_date'),
									'page'=>$this->input->post('page')
									);
							#echo "<pre>";print_r($dataArr);#die;
							$sql=$this->checkout_model->update_details(PRODUCT,array('product_featured'=>'Yes','feature_expire'=>$this->input->post('expire')),array('seourl'=>trim($this->input->post('product_seourl'))));
							#echo "<br>".$this->db->last_query();
							$sql=$this->checkout_model->simple_insert(FEATURE_PRODUCT,$dataArr);
								#echo $this->db->last_query();
							$this->setErrorMessage('success',"Product Successfully Featured");	
							redirect('shop/managelistings');
						}
						else{
							$rescod=$result[exception]->errorMsg;
							$this->setErrorMessage('error',str_replace("-"," ",url_title($rescod)));						
							redirect('shop/managelistings');
						}
		} catch (Twocheckout_Error $e) {
			$e->getMessage();
		}
	}

	
 public function PaymenttwocheckoutGift(){
          
         /*  $shipValID = $this->checkout_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $this->input->post('shipping_id')));
		  $twocheckoutDetVal=unserialize(TwoCheckoutDetails); 			
		  $twocheckoutVals=unserialize($twocheckoutDetVal['settings']);
		  $loginUserId = $this->checkLogin('U');
		  $lastFeatureInsertId = $this->session->userdata('UserrandomNo');
		
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->checkout_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		
    	
		$condition =array('id' => $loginUserId);
		$dataArr = array('user_id'=>$loginUserId,'full_name'=>$this->input->post('full_name'),'address1'=>$this->input->post('address'),'address2'=>$this->input->post('address2'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postal_code'),'phone'=>$this->input->post('phone_no'));
		$this->checkout_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
       
        $this->checkout_model->update_details(USER_PAYMENT,array('billingid' => $insID,'sumtotal'=>number_format($this->input->post('total_price'),2,'.','')),array('dealCodeNumber' => $lastFeatureInsertId));
		$this->load->library('twocheckout_class');
		$item_name = $this->config->item('email_title').' Products';
		
		$totalAmount = $this->input->post('total_price')*$this->data['currencyValue'];
		//User ID
		$loginUserId = $this->checkLogin('U');
		//DealCodeNumber
           

		$quantity = 1;
			
		if(strtoupper($twocheckoutVals['mode']) == 'SANDBOX'){
			$this->twocheckout_class->twocheckout_url = 'https://sandbox.2checkout.com/checkout/purchase';   
		}else{
			$this->twocheckout_class->twocheckout_url = 'https://www.2checkout.com/checkot/purchase';     
        }
			
		$this->twocheckout_class->add_field('currency', $this->data['currencyType']);
		$this->twocheckout_class->add_field('mode','2CO');
		$this->twocheckout_class->add_field('sid',$twocheckoutVals['Merchant_ID']);
			
	     if(strtoupper($twocheckoutVals['mode']) == 'SANDBOX') $this->twocheckout_class->add_field("demo", "Y");
		
		 $this->twocheckout_class->add_field('x_receipt_link_url',base_url().'order/twocheckoutsuccess/'.$loginUserId.'/'.$lastFeatureInsertId); 
			
	        

		    //products, shipping...
			$this->twocheckout_class->add_field("merchant_order_id", $loginUserId."_".$lastFeatureInsertId);
		    $this->twocheckout_class->add_field("li_0_type", "product");
		    $this->twocheckout_class->add_field("li_0_name", $item_name);
		    $this->twocheckout_class->add_field("li_0_product_id", "12");
		    $this->twocheckout_class->add_field("li_0_price", $totalAmount);
		    $this->twocheckout_class->add_field("li_0_quantity", $quantity);
		    $this->twocheckout_class->add_field("li_0_tangible", "Y");
		    
		    //shipping can enter all details using seperate child after li
		    $this->twocheckout_class->add_field("li_1_type", "shipping");
		    $this->twocheckout_class->add_field("li_1_name", "manual");
		    $this->twocheckout_class->add_field("li_1_price", "0");			
				
							
			
			
			//$this->twocheckout_class->add_field('custom', 'Product|'.$loginUserId.'|'.$lastFeatureInsertId); 
			$this->twocheckout_class->add_field('card_holder_name', $this->input->post('full_name')); 
			$this->twocheckout_class->add_field('street_address', $this->input->post('address')); 
			$this->twocheckout_class->add_field('street_address2', $loginUserId);			
			$this->twocheckout_class->add_field('city', $this->input->post('city')); 
			$this->twocheckout_class->add_field('state', $this->input->post('state')); 
			$this->twocheckout_class->add_field('country', $this->input->post('country')); 
			$this->twocheckout_class->add_field('zip', $this->input->post('postal_code'));
			$this->twocheckout_class->add_field('email', $quantity); 
			$this->twocheckout_class->add_field('phone', $this->input->post('phone_no'));
			$this->twocheckout_class->add_field('phone_extension', ''); 

		    $this->twocheckout_class->add_field('ship_name', $shipValID->row()->full_name);
			$this->twocheckout_class->add_field('ship_street_address', $shipValID->row()->address1); 
			$this->twocheckout_class->add_field('ship_street_address2', $shipValID->row()->address2);
			$this->twocheckout_class->add_field('ship_city',  $shipValID->row()->city);
			$this->twocheckout_class->add_field('ship_state', $shipValID->row()->state); 
			$this->twocheckout_class->add_field('ship_zip', $shipValID->row()->postal_code);
			$this->twocheckout_class->add_field('ship_country', $shipValID->row()->country);
            $this->twocheckout_class->submit_twocheckout_post(); 
		 */	
			 # echo "<pre>";print_r($this->input->post());die;
		$excludeArr = array('creditvalue','card_name','shipping_id','email','ccNo','expMonth','expYear','cvv','total_price','CreditSubmit','token',"full_name");
		$dataArr = array();
		$condition =array('id' => $this->checkLogin('U'));
		$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
		$this->load->library('Twocheckout');
		Twocheckout::privateKey($this->input->post('PrivateKey'));
		Twocheckout::sellerId($this->input->post('SellerId'));
		if($this->input->post('Mode') == "sandbox")
			Twocheckout::sandbox(true); 
		else
			Twocheckout::sandbox(false);
		$tokenid=$this->input->post('token');
		//echo $tokenid;die;
		$loginUserId = $this->checkLogin('U');
			$lastFeatureInsertId = $this->session->userdata('UserrandomNo');
			//echo $lastFeatureInsertId;die;
		$item_name = $this->config->item('email_title').' Products';
			
		$totalAmount = $this->input->post('total_price');
			
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
					"email" => 'testingtester@2co.com',
					"phoneNumber" => '555-555-5555'
					),
					"shippingAddr" => array(
					"name" => 'Testing Tester',
					"addrLine1" => '123 Test St',
					"city" => 'Columbus',
					"state" => 'OH',
					"zipCode" => '43123',
					"country" => 'USA',
					"email" => 'testingtester@2co.com',
					"phoneNumber" => '555-555-5555'
					)
					), 'array');
						$result=(array)json_decode($charge);
						//echo "<pre>";print_r($result[exception]->errorMsg);
						#echo "<pre>";print_r($result);die;
						
						$rescod=$result['response'];
						if(($rescod->responseCode)=="APPROVED")
						{
							redirect('order/giftsuccess/'.$loginUserId.'/'.$lastFeatureInsertId);
						}
						else{
							$rescod=$result[exception]->errorMsg;
						
							redirect('order/failure/'.str_replace("-"," ",url_title($rescod)));
						}
		} catch (Twocheckout_Error $e) {
			$e->getMessage();
		}
						
	}

	
	/** 
	 * 
	 * Payment submit for paypal gateway for user
	 *
	 */
	public function PaymentProcess(){
	
		$excludeArr = array('paypalmode','paypalEmail','total_price','PaypalSubmit');
    	$dataArr = array();
    	$condition =array('id' => $this->checkLogin('U'));
		$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
	
		
		//echo '<pre>';print_r($_POST); die;
	
			/*Paypal integration start */
			$this->load->library('paypal_class');
			
			$item_name = $this->config->item('email_title').' Products';
			
			$totalAmount = number_format($this->input->post('total_price')*$this->data['currencyValue'],2);
			//User ID
			$loginUserId = $this->checkLogin('U');
			//DealCodeNumber
			$lastFeatureInsertId = $this->session->userdata('randomNo');
			
			$quantity = 1;
			
			if($this->input->post('paypalmode') == 'sandbox'){
				$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
			}else{
				$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
			}
			
			$this->paypal_class->add_field('currency_code', $this->data['currencyType']);
			
			$this->paypal_class->add_field('business',$this->input->post('paypalEmail')); // Business Email
			
			$this->paypal_class->add_field('return',base_url().'order/success/'.$loginUserId.'/'.$lastFeatureInsertId); // Return URL
			
			$this->paypal_class->add_field('cancel_return', base_url().'order/failure'); // Cancel URL
			
			$this->paypal_class->add_field('notify_url', base_url().'site/order/ipnpayment'); // Notify url
			
			$this->paypal_class->add_field('custom', 'Product|'.$loginUserId.'|'.$lastFeatureInsertId); // Custom Values			
			
			$this->paypal_class->add_field('item_name', $item_name); // Product Name
			
			$this->paypal_class->add_field('user_id', $loginUserId);
			
			$this->paypal_class->add_field('quantity', $quantity); // Quantity
			//echo $totalAmount;die;
			  $this->paypal_class->add_field('amount', $totalAmount); // Price
			//$this->paypal_class->add_field('amount', 1); // Price
			
			//echo base_url().'order/success/'.$loginUserId.'/'.$lastFeatureInsertId; die;
			
			$this->paypal_class->submit_paypal_post(); 
						
	}
	
	/** 
	 * 
	 * Payment submit for Authorize.net gateway for user
	 *
	 */
	public function PaymentCredit(){
	
		$excludeArr = array('creditvalue','shipping_id','cardType','email','cardNumber','CCExpDay','CCExpMnth','creditCardIdentifier','total_price','CreditSubmit','full_name');
    	$dataArr = array();
    	$condition =array('id' => $this->checkLogin('U'));
		$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
	
		//User ID
			$loginUserId = $this->checkLogin('U');
		//DealCodeNumber
			$lastFeatureInsertId = $this->session->userdata('randomNo');
		
		if($this->input->post('creditvalue')=='authorize'){	
			//Authorize.net Intergration

			$Auth_Details=unserialize(API_LOGINID); 
			$Auth_Setting_Details=unserialize($Auth_Details['settings']);	

			error_reporting(-1);
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
					'amount' =>  $this->input->post('total_price'), 
					'card_num' =>  $this->input->post('cardNumber'), 
					'exp_date' => $this->input->post('CCExpDay').'/'.$this->input->post('CCExpMnth'),
					'first_name' => $this->input->post('full_name'),
					'last_name' => '',
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'country' => $this->input->post('country'),
					'phone' => $this->input->post('phone_no'),
					'email' =>  $this->input->post('email'),
					'card_code' => $this->input->post('creditCardIdentifier'),
					)
				);
				$response = $transaction->authorizeAndCapture();
		
			if( $response->approved ){
				//$moveShoppingDataToPayment = $this->ibrandshopping_model->moveShoppingDataToPayment(); 
				//redirect('site/shopcart/returnpage/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$response->transaction_id);
				redirect('order/success/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$response->transaction_id);
 			}else{		
				//redirect('site/shopcart/cancel?failmsg='.$response->response_reason_text); 
				redirect('order/failure/'.$response->response_reason_text); 
			}

		}else if($this->input->post('creditvalue')=='paypaldodirect'){	
			
			$shipValID = $this->checkout_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $this->input->post('shipping_id')));	
			//echo '<pre>';print_r($shipValID->row()); die;
		
			$PaypalDodirect = unserialize($this->data['paypal_credit_card_settings']['settings']);
			$dodirects = array(
				'Sandbox' => $PaypalDodirect['mode'], 			// Sandbox / testing mode option.
				'APIUsername' =>$PaypalDodirect['Paypal_API_Username'], 	// PayPal API username of the API caller
				'APIPassword' => $PaypalDodirect['paypal_api_password'], 	// PayPal API password of the API caller
				'APISignature' => $PaypalDodirect['paypal_api_Signature'], 	// PayPal API signature of the API caller
				'APISubject' => '', 									// PayPal API subject (email address of 3rd party user that has granted API permission for your app)
				'APIVersion' => '85.0'		// API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
			);
			
			// Show Errors
			if($dodirects['Sandbox']){
				error_reporting(E_ALL ^ (E_NOTICE) );
				ini_set('display_errors', '1');
			}
			
		
			$this->load->library('Paypal_pro', $dodirects);	
		
			$DPFields = array(
							'paymentaction' => '', 						// How you want to obtain payment.  Authorization indidicates the payment is a basic auth subject to settlement with Auth & Capture.  Sale indicates that this is a final sale for which you are requesting payment.  Default is Sale.
							'ipaddress' => $this->input->ip_address(), 							// Required.  IP address of the payer's browser.
							'returnfmfdetails' => '1'				// Flag to determine whether you want the results returned by FMF.  1 or 0.  Default is 0.
						);
						
						
		$CCDetails = array(
							'creditcardtype' => $this->input->post('cardType'), 					// Required. Type of credit card.  Visa, MasterCard, Discover, Amex, Maestro, Solo.  If Maestro or Solo, the currency code must be GBP.  In addition, either start date or issue number must be specified.
							'acct' => $this->input->post('cardNumber'), 								// Required.  Credit card number.  No spaces or punctuation.  
							'expdate' => $this->input->post('CCExpDay').$this->input->post('CCExpMnth'), 	// Required.  Credit card expiration date.  Format is MMYYYY
							'cvv2' => $this->input->post('creditCardIdentifier'), 				// Requirements determined by your PayPal account settings.  Security digits for credit card.
							'startdate' => '', 							// Month and year that Maestro or Solo card was issued.  MMYYYY
							'issuenumber' => ''							// Issue number of Maestro or Solo card.  Two numeric digits max.
						);
						
		$PayerInfo = array(
							'email' => $this->input->post('email'), 	// Email address of payer.
							'payerid' => '', 							// Unique PayPal customer ID for payer.
							'payerstatus' => '', 	// Status of payer.  Values are verified or unverified
							'business' => '' 		
												// Payer's business name.
						);
						
		$PayerName = array(
							'salutation' => 'Mr.', 						// Payer's salutation.  20 char max.
							'firstname' => $this->input->post('full_name'), 							// Payer's first name.  25 char max.
							'middlename' => '', 						// Payer's middle name.  25 char max.
							'lastname' => '', 							// Payer's last name.  25 char max.
							'suffix' => ''								// Payer's suffix.  12 char max.
						);

//'x_amount'				=> ,
	//			'x_email'				=> $this->input->post('email'),
						
		$BillingAddress = array(
								'street' => $this->input->post('address'), 						// Required.  First street address.
								'street2' => '', 						// Second street address.
								'city' => $this->input->post('city'), 							// Required.  Name of City.
								'state' => $this->input->post('state'), 							// Required. Name of State or Province.
								'countrycode' => $this->input->post('country'), 					// Required.  Country code.
								'zip' => $this->input->post('postal_code'), 							// Required.  Postal code of payer.
								'phonenum' => $this->input->post('phone_no') 						// Phone Number of payer.  20 char max.
							);
							
		$ShippingAddress = array(
								'shiptoname' => $shipValID->row()->full_name,		// Required if shipping is included.  Person's name associated with this address.  32 char max.
								'shiptostreet' => $shipValID->row()->address1,		// Required if shipping is included.  First street address.  100 char max.
								'shiptostreet2' => $shipValID->row()->address2,  	// Second street address.  100 char max.
								'shiptocity' => $shipValID->row()->city,			// Required if shipping is included.  Name of city.  40 char max.
								'shiptostate' => $shipValID->row()->state,			// Required if shipping is included.  Name of state or province.  40 char max.
								'shiptozip' => $shipValID->row()->postal_code, 		// Required if shipping is included.  Postal code of shipping address.  20 char max.
								'shiptocountry' => $shipValID->row()->country, 		// Required if shipping is included.  Country code of shipping address.  2 char max.
								'shiptophonenum' => $shipValID->row()->phone		// Phone number for shipping address.  20 char max.
								);
							
		$PaymentDetails = array(
								'amt' => $this->input->post('total_price')*$this->data['currencyValue'], 							// Required.  Total amount of order, including shipping, handling, and tax.  
								'currencycode' => $this->data['currencyType'], 					// Required.  Three-letter currency code.  Default is USD.
								'itemamt' => '', 						// Required if you include itemized cart details. (L_AMTn, etc.)  Subtotal of items not including S&H, or tax.
								'shippingamt' => '', 					// Total shipping costs for the order.  If you specify shippingamt, you must also specify itemamt.
								'insuranceamt' => '', 					// Total shipping insurance costs for this order.  
								'shipdiscamt' => '', 					// Shipping discount for the order, specified as a negative number.
								'handlingamt' => '', 					// Total handling costs for the order.  If you specify handlingamt, you must also specify itemamt.
								'taxamt' => '', 						// Required if you specify itemized cart tax details. Sum of tax for all items on the order.  Total sales tax. 
								'desc' => '', 							// Description of the order the customer is purchasing.  127 char max.
								'custom' => '', 						// Free-form field for your own use.  256 char max.
								'invnum' => '', 						// Your own invoice or tracking number
								'buttonsource' => '', 					// An ID code for use by 3rd party apps to identify transactions.
								'notifyurl' => '', 						// URL for receiving Instant Payment Notifications.  This overrides what your profile is set to use.
								'recurring' => ''						// Flag to indicate a recurring transaction.  Value should be Y for recurring, or anything other than Y if it's not recurring.  To pass Y here, you must have an established billing agreement with the buyer.
							);
		
		// For order items you populate a nested array with multiple $Item arrays.  
		// Normally you'll be looping through cart items to populate the $Item array
		// Then push it into the $OrderItems array at the end of each loop for an entire 
		// collection of all items in $OrderItems.
				
		$OrderItems = array();
			
		$Item	 = array(
							'l_name' => '', 						// Item Name.  127 char max.
							'l_desc' => '', 						// Item description.  127 char max.
							'l_amt' => '', 							// Cost of individual item.
							'l_number' => '', 						// Item Number.  127 char max.
							'l_qty' => '', 							// Item quantity.  Must be any positive integer.  
							'l_taxamt' => '', 						// Item's sales tax amount.
							'l_ebayitemnumber' => '', 				// eBay auction number of item.
							'l_ebayitemauctiontxnid' => '', 		// eBay transaction ID of purchased item.
							'l_ebayitemorderid' => '' 				// eBay order ID for the item.
					);
		
		array_push($OrderItems, $Item);
		
		$Secure3D = array(
						  'authstatus3d' => '', 
						  'mpivendor3ds' => '', 
						  'cavv' => '', 
						  'eci3ds' => '', 
						  'xid' => ''
						  );
						  
		$PayPalRequestData = array(
								'DPFields' => $DPFields, 
								'CCDetails' => $CCDetails, 
								'PayerInfo' => $PayerInfo, 
								'PayerName' => $PayerName, 
								'BillingAddress' => $BillingAddress, 
								'ShippingAddress' => $ShippingAddress, 
								'PaymentDetails' => $PaymentDetails, 
								'OrderItems' => $OrderItems, 
								'Secure3D' => $Secure3D
							);
							
		$PayPalResult = $this->paypal_pro->DoDirectPayment($PayPalRequestData);
		
	
		
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])){
			$errors = array('Errors'=>$PayPalResult['ERRORS']);
			//$this->load->view('paypal_error',$errors);
			$newerrors = $errors['Errors'][0]['L_LONGMESSAGE'];
			redirect('order/failure/'.$newerrors); 
		}else{
			// Successful call.  Load view or whatever you need to do here.	
			redirect('order/success/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$PayPalResult['TRANSACTIONID']);
		}
			
			
		}
	
	}
	
	
	/** 
	 * 
	 * Payment submit for paypal creditcard gateway for user
	 *
	 */
	public function UserPaymentProcess(){
		
		//User ID
		$loginUserId = $this->checkLogin('U');
		//DealCodeNumber
		$lastFeatureInsertId = $this->session->userdata('UserrandomNo');
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->checkout_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		
		$excludeArr = array('paypalmode','paypalEmail','total_price','PaypalSubmit');
    	
		
		
		$condition =array('id' => $loginUserId);
		$dataArr = array('user_id'=>$loginUserId,'full_name'=>$this->input->post('full_name'),'address1'=>$this->input->post('address'),'address2'=>$this->input->post('address2'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postal_code'),'phone'=>$this->input->post('phone_no'));
		$this->checkout_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
		
		$this->checkout_model->update_details(USER_PAYMENT,array('billingid' => $insID),array('dealCodeNumber' => $lastFeatureInsertId));
		
		//$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
	
		
			/*Paypal integration start */
			$this->load->library('paypal_class');
			
			$item_name = $this->config->item('email_title').' Products';
			
			$totalAmount = number_format($this->input->post('total_price')*$this->data['currencyValue'],2);
			
			
			$quantity = 1;
			
			if($this->input->post('paypalmode') == 'sandbox'){
				$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
			}else{
				$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
			}

			// temporarily set all paypal url to sandbox
			$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
			
			$this->paypal_class->add_field('currency_code', $this->data['currencyType']);
			
			$this->paypal_class->add_field('business',$this->input->post('paypalEmail')); // Business Email
			
			$this->paypal_class->add_field('return',base_url().'order/sellersuccess/'.$loginUserId.'/'.$lastFeatureInsertId); // Return URL
			
			$this->paypal_class->add_field('cancel_return', base_url().'order/failure'); // Cancel URL
			
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
	public function UserPaymentProcess_feature(){
		
		//User ID
		$loginUserId = $this->checkLogin('U'); 	
		
		
		
			/*Paypal integration start */
			$this->load->library('paypal_class');
			
			$item_name = 'Feature Product payment';
			
			$totalAmount = number_format($this->input->post('cart_price')*$this->data['currencyValue'],2);
			define("paypaldetail",$this->config->item('payment_0'));				  
			$paypaldet=unserialize(paypaldetail); 			
			$paypalVals=unserialize($paypaldet['settings']);
			#echo "<pre>";print_r($paypalVals);
			$quantity = 1;
			$expireday=$this->input->post('expire');
			$packid=$this->input->post('packid');
			$amount=$this->input->post('cart_price');
			$product_seo=$this->input->post('product_seourl');
			$start_date=$this->input->post('start_date');
			$page=$this->input->post('page');
			#echo $paypalVals['merchant_email'];die;
			if($paypalVals['mode'] == 'sandbox'){
				$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
			}else{
				$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
			}
			
			$this->paypal_class->add_field('currency_code', $this->data['currencyType']);
			
			$this->paypal_class->add_field('business',$paypalVals['merchant_email']); // Business Email
			
			$this->paypal_class->add_field('return',base_url().'feature_success/'.$expireday.'/'.$packid.'/'.$amount.'/'.$product_seo.'/'.$start_date.'/'.$page); // Return URL
			
			$this->paypal_class->add_field('cancel_return', base_url().'site/checkout/feature_failure'); // Cancel URL
			
			#$this->paypal_class->add_field('notify_url', base_url().'site/checkout/feature_ipnpayment'); // Notify url
			
			#$this->paypal_class->add_field('custom', 'SellerProduct|'.$loginUserId.'|'.$lastFeatureInsertId); // Custom Values			
			
			$this->paypal_class->add_field('item_name', $item_name); // Product Name
			
			$this->paypal_class->add_field('user_id', $loginUserId);
			
			$this->paypal_class->add_field('quantity', $quantity); // Quantity
			//echo $totalAmount;die;
			  $this->paypal_class->add_field('amount', $totalAmount); // Price
			//$this->paypal_class->add_field('amount', 1); // Price
			
			//echo base_url().'order/sellersuccess/'.$loginUserId.'/'.$lastFeatureInsertId; //die;
			
			$this->paypal_class->submit_paypal_post(); 
						
	}
	public function feature_success(){
	
		$dataArr=array(
					'pack_id'=>$this->uri->segment(3),
					'user_id'=>$this->checkLogin('U'),
					'amount'=>$this->uri->segment(4),
					'expire_date'=>$this->uri->segment(2),
					'product_seo'=>$this->uri->segment(5),
					'start_date'=>$this->uri->segment(6),
					'page'=>$this->uri->segment(7),
				);		
		$sql=$this->checkout_model->update_details(PRODUCT,array('product_featured'=>'Yes','feature_expire'=>$this->uri->segment(2)),array('seourl'=>trim($this->uri->segment(5))));
		$sql=$this->checkout_model->simple_insert(FEATURE_PRODUCT,$dataArr);
		$this->setErrorMessage('success',"Product Successfully Featured");	
		redirect('shop/managelistings');
	}
	public function feature_failure()
	{
		$this->setErrorMessage('error',"Invalid credentials");	
		redirect('shop/managelistings');	
	}
	public function feature_ipnpayment(){

		mysql_query('CREATE TABLE IF NOT EXISTS '.TRANSACTIONS.' ( `id` int(11) NOT NULL AUTO_INCREMENT,`payment_cycle` varchar(255) NOT NULL,`txn_type` varchar(255) NOT NULL, `last_name` varchar(255) NOT NULL,`next_payment_date` varchar(255) NOT NULL, `residence_country` varchar(255) NOT NULL, `initial_payment_amount` varchar(255) NOT NULL, `currency_code` varchar(255) NOT NULL, `time_created` varchar(255) NOT NULL, `verify_sign` varchar(750) NOT NULL, `period_type` varchar(255) NOT NULL, `payer_status` varchar(255) NOT NULL, `test_ipn` varchar(255) NOT NULL, `tax` varchar(255) NOT NULL, `payer_email` varchar(255) NOT NULL, `first_name` varchar(255) NOT NULL, `receiver_email` varchar(255) NOT NULL, `payer_id` varchar(255) NOT NULL, `product_type` varchar(255) NOT NULL, `shipping` varchar(255) NOT NULL, `amount_per_cycle` varchar(255) NOT NULL, `profile_status` varchar(255) NOT NULL, `charset` varchar(255) NOT NULL, `notify_version` varchar(255) NOT NULL, `amount` varchar(255) NOT NULL, `outstanding_balance` varchar(255) NOT NULL, `recurring_payment_id` varchar(255) NOT NULL, `product_name` varchar(255) NOT NULL,`custom_values` varchar(255) NOT NULL, `ipn_track_id` varchar(255) NOT NULL, `tran_date` datetime NOT NULL, PRIMARY KEY (`id`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;');

		mysql_query("insert into ".TRANSACTIONS." set  payment_cycle='".$_REQUEST['payment_cycle']."', txn_type='".$_REQUEST['txn_type']."', last_name='".$_REQUEST['last_name']."',
next_payment_date='".$_REQUEST['next_payment_date']."', residence_country='".$_REQUEST['residence_country']."', initial_payment_amount='".$_REQUEST['initial_payment_amount']."',
currency_code='".$_REQUEST['currency_code']."', time_created='".$_REQUEST['time_created']."', verify_sign='".$_REQUEST['verify_sign']."', period_type= '".$_REQUEST['period_type']."', payer_status='".$_REQUEST['payer_status']."', test_ipn='".$_REQUEST['test_ipn']."', tax='".$_REQUEST['tax']."', payer_email='".$_REQUEST['payer_email']."', first_name='".$_REQUEST['first_name']."', receiver_email='".$_REQUEST['receiver_email']."', payer_id='".$_REQUEST['payer_id']."', product_type='".$_REQUEST['product_type']."', shipping='".$_REQUEST['shipping']."', amount_per_cycle='".$_REQUEST['amount_per_cycle']."', profile_status='".$_REQUEST['profile_status']."', charset='".$_REQUEST['charset']."',
notify_version='".$_REQUEST['notify_version']."', amount='".$_REQUEST['amount']."', outstanding_balance='".$_REQUEST['payment_status']."', recurring_payment_id='".$_REQUEST['txn_id']."', product_name='".$_REQUEST['product_name']."', custom_values ='".$_REQUEST['custom']."', ipn_track_id='".$_REQUEST['ipn_track_id']."', tran_date=NOW()");
		
		
			
			
	}
	/** 
	 * 
	 * Payment submit for Authorize.net gateway for user
	 *
	 */
	public function UserPaymentCredit(){
		//echo '<pre>'; print_r($_POST); die;
		//User ID
			$loginUserId = $this->checkLogin('U');
		//DealCodeNumber
			$lastFeatureInsertId = $this->session->userdata('UserrandomNo');
		
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->checkout_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		//error_reporting(-1);
		$excludeArr = array('authorize_mode','authorize_id','authorize_key','creditvalue','shipping_id','cardType','email','cardNumber','CCExpDay','CCExpMnth','creditCardIdentifier','total_price','CreditSubmit','full_name');
    	
		$condition =array('id' => $loginUserId);
		$dataArr = array('user_id'=>$loginUserId,'full_name'=>$this->input->post('full_name'),'address1'=>$this->input->post('address'),'address2'=>$this->input->post('address2'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postal_code'),'phone'=>$this->input->post('phone_no'));
		$this->checkout_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
		

		$this->checkout_model->update_details(USER_PAYMENT,array('billingid' => $insID),array('dealCodeNumber' => $lastFeatureInsertId));
		
		$getUSDvalue=$this->checkout_model->get_all_details(CURRENCY,array('currency_code' => 'HKD'));

		if($getUSDvalue->num_rows() >0){
			$total_amount=$this->input->post('total_price')*$getUSDvalue->row()->currency_value;
		} else{
		$usd_currency_need=addslashes(shopsy_lg('Sorry!_Authorize_payment_need_USD_currency','Sorry! Authorize payment need USD currency value.'));
			$this->setErrorMessage('error',$usd_currency_need);
			redirect('cart');
		}
		
		//$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
			
			//Authorize.net Intergration

			$Auth_Details=unserialize(API_LOGINID); 
			$Auth_Setting_Details=unserialize($Auth_Details['settings']);	

			error_reporting(-1);
			define("AUTHORIZENET_API_LOGIN_ID",$Auth_Setting_Details['Login_ID']);    // Add your API LOGIN ID
			define("AUTHORIZENET_TRANSACTION_KEY",$Auth_Setting_Details['Transaction_Key']); // Add your API transaction key
			define("API_MODE",$Auth_Setting_Details['mode']);

			//error_reporting(-1);
			//define("AUTHORIZENET_API_LOGIN_ID",$this->input->post('authorize_id'));    // Add your API LOGIN ID
			//define("AUTHORIZENET_TRANSACTION_KEY",$this->input->post('authorize_key')); // Add your API transaction key
			//define("API_MODE",$this->input->post('authorize_mode'));

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
					'amount' =>  $total_amount, 
					'card_num' =>  $this->input->post('cardNumber'), 
					'exp_date' => $this->input->post('CCExpDay').'/'.$this->input->post('CCExpMnth'),
					'first_name' => $this->input->post('full_name'),
					'last_name' => '',
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'country' => $this->input->post('country'),
					'phone' => $this->input->post('phone_no'),
					'email' =>  $this->input->post('email'),
					'card_code' => $this->input->post('creditCardIdentifier'),
					)
				);
				
							
				$response = $transaction->authorizeAndCapture();
		
			if( $response->approved ){
				
				//$moveShoppingDataToPayment = $this->ibrandshopping_model->moveShoppingDataToPayment(); 
				//redirect('site/shopcart/returnpage/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$response->transaction_id);
				redirect('order/sellersuccess/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$response->transaction_id);
 			}else{		
				//redirect('site/shopcart/cancel?failmsg='.$response->response_reason_text); 
				redirect('order/failure/'.$response->response_reason_text); 
			}

		
	
	}
	public function UserPaymentCredit_feature(){
		#echo '<pre>'; print_r($_POST);
		//User ID
			$loginUserId = $this->checkLogin('U');	
				
			//Authorize.net Intergration

			$Auth_Details=unserialize(API_LOGINID); 
			$Auth_Setting_Details=unserialize($Auth_Details['settings']);	

			error_reporting(-1);
			define("AUTHORIZENET_API_LOGIN_ID",$Auth_Setting_Details['Login_ID']);    // Add your API LOGIN ID
			define("AUTHORIZENET_TRANSACTION_KEY",$Auth_Setting_Details['Transaction_Key']); // Add your API transaction key
			define("API_MODE",$Auth_Setting_Details['mode']);

			//error_reporting(-1);
			//define("AUTHORIZENET_API_LOGIN_ID",$this->input->post('authorize_id'));    // Add your API LOGIN ID
			//define("AUTHORIZENET_TRANSACTION_KEY",$this->input->post('authorize_key')); // Add your API transaction key
			//define("API_MODE",$this->input->post('authorize_mode'));

				if(API_MODE	=='sandbox'){
					define("AUTHORIZENET_SANDBOX",true);// Set to false to test against production
				}else{
					define("AUTHORIZENET_SANDBOX",false);
				}       
				define("TEST_REQUEST", "FALSE"); 
				require_once './authorize/AuthorizeNet.php';
				$totalAmount = $this->input->post('cart_price')*$this->data['currencyValue'];
				$transaction = new AuthorizeNetAIM;
				$transaction->setSandbox(AUTHORIZENET_SANDBOX);
				$transaction->setFields(
					array(
					'amount' => $totalAmount ,
					'card_num' =>  $this->input->post('cardNumber'), 
					'exp_date' => $this->input->post('CCExpDay').'/'.$this->input->post('CCExpMnth'),
					'first_name' => $this->input->post('full_name'),
					'last_name' => '',
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'country' => $this->input->post('country'),
					'phone' => $this->input->post('phone_no'),
					'email' =>  $this->input->post('email'),
					'card_code' => $this->input->post('creditCardIdentifier'),
					)
				);
				
							
				$response = $transaction->authorizeAndCapture();
		
			if( $response->approved ){
				
				$dataArr=array(
							'pack_id'=>$this->input->post('packid'),
							'user_id'=>$this->checkLogin('U'),
							'amount'=>$this->input->post('cart_price'),
							'expire_date'=>$this->input->post('expire'),
							'product_seo'=>$this->input->post('product_seourl')
						);
				$sql=$this->checkout_model->update_details(PRODUCT,array('product_featured'=>'Yes','feature_expire'=>$this->input->post('expire')),array('seourl'=>trim($this->input->post('product_seourl'))));
				$sql=$this->checkout_model->simple_insert(FEATURE_PRODUCT,$dataArr);
				$this->setErrorMessage('success',"Product Successfully Featured");	
				redirect('shop/managelistings');
 			}else{		
				$this->setErrorMessage('error',$response->response_reason_text);	
				redirect('shop/managelistings'); 
			}

		
	
	}
	
	/** 
	 * 
	 * Payment submit for Stripe gateway for user
	 *
	 */
	public function UserPaymentCreditStripe(){
		//echo '<pre>'; print_r($_POST);die;
		//User ID
			$loginUserId = $this->checkLogin('U');
		//DealCodeNumber
			$lastFeatureInsertId = $this->session->userdata('UserrandomNo');
		
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->checkout_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		//error_reporting(-1);
		$excludeArr = array('authorize_mode','authorize_id','authorize_key','creditvalue','shipping_id','cardType','email','cardNumber','CCExpDay','CCExpMnth','creditCardIdentifier','total_price','CreditSubmit','full_name');
    	
		$condition =array('id' => $loginUserId);
		$dataArr = array('user_id'=>$loginUserId,'full_name'=>$this->input->post('full_name'),'address1'=>$this->input->post('address'),'address2'=>$this->input->post('address2'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postal_code'),'phone'=>$this->input->post('phone_no'));
		$this->checkout_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();


		$this->checkout_model->update_details(USER_PAYMENT,array('billingid' => $insID,'sumtotal'=>number_format($this->input->post('total_price'),2,'.','')),array('dealCodeNumber' => $lastFeatureInsertId));
		
		
		//$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
			
		//Stripe Intergration

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
			
			$amounts = $this->input->post('total_price')*$this->data['currencyValue'] * 100;
			
			try {

				// Create a Customer
				$customer = Stripe_Customer::create(array(
					"card" => $token,
					"description" => "Product Purhcase for ".$this->config->item('email_title'),
					"email" => $this->input->post('email'))
				);

				// Charge the Customer instead of the card
				Stripe_Charge::create(array(
					"amount" => $amounts, # amount in cents, again
					"currency" => $this->data['currencyType'],
					"customer" => $customer->id)
				);
			
					redirect('order/sellersuccess/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$token);
			} catch (Exception $e) {    
				$error = $e->getMessage();
				redirect('order/failure/'.$error); 
			}	
				
		
	}
	public function UserPaymentCreditStripe_feature()
	{
		#echo "<pre>";print_r($this->input->post());die;
		$loginUserId = $this->checkLogin('U');	
			
		//Stripe Intergration
							
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
			
			$amounts = $this->input->post('cart_price')*$this->data['currencyValue'] * 100;
			
			try {

				// Create a Customer
				$customer = Stripe_Customer::create(array(
					"card" => $token,
					"description" => "Product Purhcase for ".$this->config->item('email_title'),
					"email" => $this->input->post('email'))
				);

				// Charge the Customer instead of the card
				Stripe_Charge::create(array(
					"amount" =>$amounts, # amount in cents, again
					"currency" => $this->data['currencyType'],
					"customer" => $customer->id)
				);
			
				$dataArr=array(
									'pack_id'=>$this->input->post('packid'),
									'user_id'=>$this->checkLogin('U'),
									'amount'=>$this->input->post('cart_price'),
									'expire_date'=>$this->input->post('expire'),
									'product_seo'=>$this->input->post('product_seourl'),
									'start_date'=>$this->input->post('start_date'),
									'page'=>$this->input->post('page')
									
									);
							#echo "<pre>";print_r($dataArr);#die;
							$sql=$this->checkout_model->update_details(PRODUCT,array('product_featured'=>'Yes','feature_expire'=>$this->input->post('expire')),array('seourl'=>trim($this->input->post('product_seourl'))));
							#echo "<br>".$this->db->last_query();
							$sql=$this->checkout_model->simple_insert(FEATURE_PRODUCT,$dataArr);
								#echo $this->db->last_query();
							$this->setErrorMessage('success',"Product Successfully Featured");	
							redirect('shop/managelistings');
			} catch (Exception $e) {    
				$error = $e->getMessage();
				$this->setErrorMessage('error',$error);	
				redirect('shop/managelistings');
				
			}	
	}
	public function UserPaymentCreditStripe1(){
		//echo '<pre>'; print_r($_POST);die;
		//User ID
			$loginUserId = $this->checkLogin('U');
		//DealCodeNumber
			$lastFeatureInsertId = $this->session->userdata('UserrandomNo');
		
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->checkout_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		//error_reporting(-1);
		$excludeArr = array('authorize_mode','authorize_id','authorize_key','creditvalue','shipping_id','cardType','email','cardNumber','CCExpDay','CCExpMnth','creditCardIdentifier','total_price','CreditSubmit','full_name');
    	
		$condition =array('id' => $loginUserId);
		$dataArr = array('user_id'=>$loginUserId,'full_name'=>$this->input->post('full_name'),'address1'=>$this->input->post('address'),'address2'=>$this->input->post('address2'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postal_code'),'phone'=>$this->input->post('phone_no'));
		$this->checkout_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();


		$this->checkout_model->update_details(USER_PAYMENT,array('billingid' => $insID,'sumtotal'=>number_format($this->input->post('total_price'),2,'.','')),array('dealCodeNumber' => $lastFeatureInsertId));
		
		
		//$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
			
		//Stripe Intergration

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
			
			$amounts = $this->input->post('total_price')*$this->data['currencyValue'] * 100;
			
			try {

				// Create a Customer
				$customer = Stripe_Customer::create(array(
					"card" => $token,
					"description" => "Product Purhcase for ".$this->config->item('email_title'),
					"email" => $this->input->post('email'))
				);

				// Charge the Customer instead of the card
				Stripe_Charge::create(array(
					"amount" => $amounts, # amount in cents, again
					"currency" => $this->data['currencyType'],
					"customer" => $customer->id)
				);
			
					redirect('order/giftsuccess/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$token);
			} catch (Exception $e) {    
				$error = $e->getMessage();
				redirect('order/failure/'.$error); 
			}	
				
		
	}
	
	
	/** 
	 * 
	 * Payment submit for paypal Adaptive gateway for user
	 *
	 */
	public function UserPaymentProcessAdaptive(){
		
			
		//User ID
		$loginUserId = $this->checkLogin('U');
		//DealCodeNumber
		$lastFeatureInsertId = $this->session->userdata('UserrandomNo');
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->checkout_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		
		$excludeArr = array('paypalmode','paypalEmail','total_price','PaypalSubmit','commision','seller_id');
    	
		
		
		$condition =array('id' => $loginUserId);
		$dataArr = array('user_id'=>$loginUserId,'full_name'=>$this->input->post('full_name'),'address1'=>$this->input->post('address'),'address2'=>$this->input->post('address2'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postal_code'),'phone'=>$this->input->post('phone_no'));
		$this->checkout_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
		
		
		$Query = 'select Paypal_merchant_email from '.SELLER.' where seller_id = '.$this->input->post('seller_id');
		$get_details = $this->checkout_model->ExecuteQuery($Query);
		
		$Query = 'select commision from '.USERS.' where id = '.$this->input->post('seller_id');
		$get_User_details = $this->checkout_model->ExecuteQuery($Query);
		#echo '<pre>'; print_r($get_User_details->result());
		
		$newAmount = $this->input->post('total_price');
		$comm_Percent = $get_User_details->row()->commision;
		$adm_amt = number_format($newAmount * 0.01 * $comm_Percent,2,'.','');
		$sell_amt = number_format($newAmount - $adm_amt,2,'.','');
		
		$newPayArr = array('billingid' => $insID,'seller_amount'=>$sell_amt,'admin_amount'=>$adm_amt,'admin_comm_percent'=>$comm_Percent,'sumtotal'=>number_format($newAmount,2,'.',''),'shopTotal'=>$newAmount);
		#echo '<pre>'; print_r($newPayArr);die;
		$this->checkout_model->update_details(USER_PAYMENT,$newPayArr,array('dealCodeNumber' => $lastFeatureInsertId));
		
		
		/*Paypal Adaptive integration start */
			
			$this->config->load('paypal');
			$config = array(
				'Sandbox' => $this->config->item('Sandbox'), 			// Sandbox / testing mode option.
				'APIUsername' => $this->config->item('APIUsername'), 	// PayPal API username of the API caller
				'APIPassword' => $this->config->item('APIPassword'), 	// PayPal API password of the API caller
				'APISignature' => $this->config->item('APISignature'), 	// PayPal API signature of the API caller
				'APISubject' => '', 									// PayPal API subject (email address of 3rd party user that has granted API permission for your app)
				'APIVersion' => $this->config->item('APIVersion'), 		// API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
				'DeviceID' => $this->config->item('DeviceID'), 
				'ApplicationID' => $this->config->item('ApplicationID'), 
				'DeveloperEmailAccount' => $this->config->item('DeveloperEmailAccount')
			);
		
			//echo '<pre>'; print_r($config);die;
			$this->load->library('paypal/Paypal_adaptive', $config);
		
			$item_name = $this->config->item('email_title').' Products';
			
			//$curreny_type = $this->data['currencyType'];
			$curreny_type = $this->data['currencyType'];			
			
			//echo '<br>'.$adminCommision;echo '<br>'.$sellerAmt;echo '<br>'.$curreny_type;
			
			$redriect = 'order/sellersuccess/'.$loginUserId.'/'.$lastFeatureInsertId.'/paypal';

		$PayRequestFields = array(
			'ActionType' => 'PAY', 		// Required.  Whether the request pays the receiver or whether the request is set up to create a payment request, but not fulfill the payment until the ExecutePayment is called.  Values are:  PAY, CREATE, PAY_PRIMARY
			'CancelURL' => site_url('order/failure/pay_cancel'), 	// Required.  The URL to which the sender's browser is redirected if the sender cancels the approval for the payment after logging in to paypal.com.  1024 char max.
			'CurrencyCode' => $curreny_type, 			// Required.  3 character currency code.
			'FeesPayer' => 'EACHRECEIVER', 				// The payer of the fees.  Values are:  SENDER, PRIMARYRECEIVER, EACHRECEIVER, SECONDARYONLY
			// 'IPNNotificationURL' => site_url('paypal_ipn.php'), 				// The URL to which you want all IPN messages for this payment to be sent.  1024 char max.
			'IPNNotificationURL' => base_url().'site/order/ipnpayment?paytype=adaptive&uid='.$loginUserId.'&dealcode='.$lastFeatureInsertId, 
			'Memo' => '', 								// A note associated with the payment (text, not HTML).  1000 char max
			'Pin' => '', 								// The sener's personal id number, which was specified when the sender signed up for the preapproval
			'PreapprovalKey' => '', 					// The key associated with a preapproval for this payment.  The preapproval is required if this is a preapproved payment.  
			'ReturnURL' => site_url($redriect), 		// Required.  The URL to which the sener's browser is redirected after approvaing a payment on paypal.com.  1024 char max.
			'ReverseAllParallelPaymentsOnError' => '', 	// Whether to reverse paralel payments if an error occurs with a payment.  Values are:  TRUE, FALSE
			'SenderEmail' => '', 						// Sender's email address.  127 char max.
			'TrackingID' => $lastFeatureInsertId		// Unique ID that you specify to track the payment.  127 char max.
			);
		$ClientDetailsFields = array(
			'CustomerID' => '', 							// Your ID for the sender  127 char max.
			'CustomerType' => '', 							// Your ID of the type of customer.  127 char max.
			'GeoLocation' => '', 							// Sender's geographic location
			'Model' => '', 									// A sub-identification of the application.  127 char max.
			'PartnerName' => ''								// Your organization's name or ID
			);	
		$FundingTypes = array('ECHECK', 'BALANCE', 'CREDITCARD');
		$Receivers = array();
		if($adm_amt > 0 ){
			$Receiver = array(
				'Amount' => $adm_amt, 						// Required.  Amount to be paid to the receiver.
				'Email' => $this->input->post('paypalEmail'), 	// Receiver's email address. 127 char max.
				'InvoiceID' => '', 								// The invoice number for the payment.  127 char max.
				'PaymentType' => 'SERVICE', 					// $this->input->post('paypalEmail')Transaction type.  Values are:  GOODS, SERVICE, PERSONAL, CASHADVANCE, DIGITALGOODS
				'PaymentSubType' => '', 						// The transaction subtype for the payment.
				'Phone' => array('CountryCode' => '', 'PhoneNumber' => '', 'Extension' => ''), // Receiver's phone number.   Numbers only.
				'Primary' => 'FALSE'								// Whether this receiver is the primary receiver.  Values are boolean:  TRUE, FALSE
				);
			array_push($Receivers,$Receiver);
		}
			echo 'check'.$sell_amt,$get_details->row()->Paypal_merchant_email;
		
		$Receiver = array(
				'Amount' => $sell_amt, 									// Required.  Amount to be paid to the receiver.
				'Email' => $get_details->row()->Paypal_merchant_email,				// 'vinubuyer2@gmail.com', Receiver's email address. 127 char max.
				'InvoiceID' => '', 											// The invoice number for the payment.  127 char max.
				'PaymentType' => 'SERVICE', 								// Transaction type.  Values are:  GOODS, SERVICE, PERSONAL, CASHADVANCE, DIGITALGOODS
				'PaymentSubType' => '', 									// The transaction subtype for the payment.
				'Phone' => array('CountryCode' => '', 'PhoneNumber' => '', 'Extension' => ''), // Receiver's phone number.   Numbers only.
				'Primary' => 'false'										// Whether this receiver is the primary receiver.  Values are boolean:  TRUE, FALSE
				);
			array_push($Receivers,$Receiver);
		
		$SenderIdentifierFields = array(
			'UseCredentials' => ''						// If TRUE, use credentials to identify the sender.  Default is false.
			);
		$AccountIdentifierFields = array(
			'Email' => '', 								// Sender's email address.  127 char max.
			'Phone' => array('CountryCode' => '', 'PhoneNumber' => '', 'Extension' => '')								// Sender's phone number.  Numbers only.
			);
		$PayPalRequestData = array(
			'PayRequestFields' => $PayRequestFields, 
			'ClientDetailsFields' => $ClientDetailsFields, 
			'FundingTypes' => $FundingTypes, 
			'Receivers' => $Receivers, 
			'SenderIdentifierFields' => $SenderIdentifierFields, 
			'AccountIdentifierFields' => $AccountIdentifierFields
		);		
		
		#echo '<pre>'; print_r($PayPalRequestData);
		$PayPalResult = $this->paypal_adaptive->Pay($PayPalRequestData);
		#echo '<pre>'; print_r($PayPalResult); die;		
		
		if(!$this->paypal_adaptive->APICallSuccessful($PayPalResult['Ack'])){
			//echo "<pre>"; print_r($PayPalResult['Errors']); die;
			redirect('order/failure/'.urlencode($PayPalResult['Errors'][0]['Message']));
		}else{
		
			$corelatId = $PayPalResult['CorrelationID'];
			$paykey = $PayPalResult['PayKey'];
						
			$condition =array('user_id' => $loginUserId,'dealCodeNumber'=>$lastFeatureInsertId);
			$this->checkout_model->update_details(USER_PAYMENT,array('pay_key_id'=>$paykey,'correlation_id'=>$corelatId),$condition); 
			
			header('Location: '.$PayPalResult['RedirectURL']);
			exit();
		}
		
	}
	
	
	/** 
	 * 
	 * Payment submit for paypal gateway for giftcard
	 *
	 */
	public function PaymentProcessGift(){
	
		$excludeArr = array('paypalmode','paypalEmail','total_price','PaypalSubmit');
    	$dataArr = array();
    	$condition =array('id' => $this->checkLogin('U'));
		$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
	
			/*Paypal integration start */
			$this->load->library('paypal_class');
			
			$item_name = $this->config->item('email_title').' Gifts';
			
			#$totalAmount = $this->input->post('total_price')*$this->data['currencyValue'];        
			$totalAmount = $this->input->post('total_price');
			//User ID
			$loginUserId = $this->checkLogin('U');
			
			$quantity = 1;
			
			if($this->input->post('paypalmode') == 'sandbox'){
				$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
			}else{
				$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
			}
			
			$this->paypal_class->add_field('currency_code', $this->data['currencyType']);
			
			$this->paypal_class->add_field('business',$this->input->post('paypalEmail')); // Business Email
			
			$this->paypal_class->add_field('return',base_url().'order/giftsuccess/'.$loginUserId); // Return URL
			
			$this->paypal_class->add_field('cancel_return', base_url().'order/failure'); // Cancel URL
			
			$this->paypal_class->add_field('notify_url', base_url().'site/order/ipnpayment'); // Notify url
			
			$this->paypal_class->add_field('custom', 'Gift|'.$loginUserId); // Custom Values			
			
			$this->paypal_class->add_field('item_name', $item_name); // Product Name
			
			$this->paypal_class->add_field('user_id', $loginUserId);
			
			$this->paypal_class->add_field('quantity', $quantity); // Quantity
			//echo $totalAmount;die;
			  $this->paypal_class->add_field('amount', $totalAmount); // Price
			//$this->paypal_class->add_field('amount', 1); // Price
			//echo base_url().'order/giftsuccess/'.$loginUserId; die;
			
			$this->paypal_class->submit_paypal_post(); 
			
						
	}
	
	/** 
	 * 
	 * Payment submit for Authorize.net gateway for giftcard
	 *
	 */
	public function PaymentCreditGift(){
	
		
		$excludeArr = array('creditvalue','cardType','email','cardNumber','CCExpDay','CCExpMnth','creditCardIdentifier','total_price','CreditSubmit','full_name');
    	$dataArr = array();
    	$condition =array('id' => $this->checkLogin('U'));
		$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
	
		//User ID
		$loginUserId = $this->checkLogin('U');
		
		$Auth_Details=unserialize(API_LOGINID); 
		$Auth_Setting_Details=unserialize($Auth_Details['settings']);	
		
		//echo '<pre>'; print_r($_POST); die;	
			//echo '<pre>'; print_r($Auth_Setting_Details); die;
		error_reporting(-1);
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
					'amount' =>  $this->input->post('total_price'), 
					'card_num' =>  $this->input->post('cardNumber'), 
					'exp_date' => $this->input->post('CCExpDay').'/'.$this->input->post('CCExpMnth'),
					'first_name' => $this->input->post('full_name'),
					'last_name' => '',
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'country' => $this->input->post('country'),
					'phone' => $this->input->post('phone_no'),
					'email' =>  $this->input->post('email'),
					'card_code' => $this->input->post('creditCardIdentifier'),
					)
				);
				//echo '<pre>'; print_r($transaction); 
				$response = $transaction->authorizeAndCapture();
				//echo '<pre>'; print_r($response); die;
				
		
			if( $response->approved ){
				//$moveShoppingDataToPayment = $this->ibrandshopping_model->moveShoppingDataToPayment(); 
				redirect('order/giftsuccess/'.$loginUserId.'/'.$response->transaction_id);
 			}else{		
				//redirect('site/shopcart/cancel?failmsg='.$response->response_reason_text); 
				//echo $response->response_reason_text; die;
				redirect('order/failure/'.$response->response_reason_text); 
			}
	
	}

	
	/** 
	 * 
	 * Payment submit for authorize.net subscribtion gateway for giftcard
	 *
	 */
	public function PaymentCreditSubscribe(){
	
	
		$excludeArr = array('email','cardNumber','CCExpDay','CCExpMnth','creditCardIdentifier','total_price','CreditSubscribeSubmit','invoiceNumber');
    	$dataArr = array();
    	$condition =array('id' => $this->checkLogin('U'));
		$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
		
		//Authorize.net Intergration
		$this->load->library('authorize_arb');
		
		// Start with a create object
		$this->authorize_arb->startData('create');
		
		// Locally-defined reference ID (can't be longer than 20 chars)
		$refId = substr(md5( microtime() . 'ref' ), 0, 20);
		$this->authorize_arb->addData('refId', $refId);
		
		// Data must be in this specific order
		// For full list of possible data, refer to the documentation:
		// http://www.authorize.net/support/ARB_guide.pdf
		
		
		$subscription_data = array(
			'name' => $this->config->item('email_title').' Subscription',
			'paymentSchedule' => array(
				'interval' => array(
					'length' => 1,
					'unit' => 'months',
					),
				'startDate' => date('Y-m-d'),
				'totalOccurrences' => 9999,
				'trialOccurrences' => 0,
				),
			'amount' => $this->config->item('total_price'),
			'trialAmount' => 0.00,
			'payment' => array(
				'creditCard' => array(
					'cardNumber' => $this->input->post('cardNumber'),
					'expirationDate' => $this->input->post('CCExpMnth').'-'.$this->input->post('CCExpDay'),
					'cardCode' => $this->input->post('creditCardIdentifier'),
					),
				),
			'order' => array(
				'invoiceNumber' => $this->config->item('invoiceNumber'),
				'description' =>  $this->config->item('email_title').' Subscription',
				),
			'customer' => array(
				'id' => $this->checkLogin('U'),
				'email' => $this->config->item('email'),
				'phoneNumber' => $this->config->item('phone_no'),
				),
			'billTo' => array(
				'firstName' => $this->config->item('full_name'),
				'lastName' => '',
				'address' => $this->config->item('address'),
				'city' => $this->config->item('city'),
				'state' => $this->config->item('state'),
				'zip' => $this->config->item('postal_code'),
				'country' => $this->config->item('country'),
				),
			);
			
		$this->authorize_arb->addData('subscription', $subscription_data);
		
		// Send request
		if( $this->authorize_arb->send() ){
			//echo '<h1>Success! ID: ' . $this->authorize_arb->getId() . '</h1>';
			redirect('order/subscribesuccess/'.$loginUserId.'/'.$this->authorize_arb->getId());
		}else{
			//echo '<h1>Epic Fail!</h1>';
			//echo '<p>' . $this->authorize_arb->getError() . '</p>';
			redirect('order/failure'); 
		}
		
		// Show debug data
		//$this->authorize_arb->debug();
		
	}
	
	
	/** 
	 * 
	 * Payment Balance Zero Using Gift 
	 *
	 */
	public function PaymentGiftFree(){
		
		//User ID
		$loginUserId = $this->checkLogin('U');
			//DealCodeNumber
		$lastFeatureInsertId = $this->session->userdata('UserrandomNo');
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->checkout_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		
		
		$condition =array('id' => $loginUserId);
		$dataArr = array('user_id'=>$loginUserId,'full_name'=>$this->input->post('full_name'),'address1'=>$this->input->post('address'),'address2'=>$this->input->post('address2'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postal_code'),'phone'=>$this->input->post('phone_no'));
		$this->checkout_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
		
		$this->checkout_model->update_details(USER_PAYMENT,array('billingid' => $insID),array('dealCodeNumber' => $lastFeatureInsertId));
		
		$item_name = $this->config->item('email_title').' Products';
			
		$totalAmount = $this->input->post('total_price')*$this->data['currencyValue'];
			
		redirect('order/successgift/'.$loginUserId.'/'.$lastFeatureInsertId); // Return URL
						
	}
	
	/** 
	 * 
	 * Product Payment by creditcard by shop product add 
	 *
	 */
	public function ProductPaymentCredit(){
		
		#echo '<pre>'; print_r($this->input->post());die;
		//error_reporting(-1);
		$excludeArr = array('creditvalue','shipping_id','cardType','email','cardNumber','CCExpYear','CCExpMnth','creditCardIdentifier','total_price','CreditSubmit','wallet_payment','full_name');
    	
		//User ID
		$loginUserId = $this->checkLogin('U');

		$condition =array('id' => $loginUserId);
		$dataArr = array('address'=>$this->input->post('street'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postalcode'),'phone_no'=>$this->input->post('phone'));
		
		//echo '<pre>'; print_r($dataArr); die;
		
		$this->checkout_model->update_details(USERS,$dataArr,$condition);
		#$this->input->post('total_amt');
		
		$getUSDvalue=$this->checkout_model->get_all_details(CURRENCY,array('currency_code' => $this->data['currencyType']));
		
		if(isset($_POST['wallet_payment'])){
			$total_amount = $this->input->post('total_amt');
		}else{
			if($getUSDvalue->num_rows() >0){
				$total_amount = number_format($this->input->post('total_amt')*$getUSDvalue->row()->currency_value,2);
			} else{
				$this->setErrorMessage('error','Sorry! Authorize payment need '.$this->data['currencyType'].' currency value.');
				redirect('cart');
			}
		}
			
			//Authorize.net Intergration

			$Auth_Details=unserialize(API_LOGINID); 
			$Auth_Setting_Details=unserialize($Auth_Details['settings']);	
			//echo '<pre>'; print_r($Auth_Setting_Details);
			error_reporting(-1);
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
					'amount' =>  $total_amount, 
					'card_num' =>  $this->input->post('cardNumber'), 
					'exp_date' => $this->input->post('CCExpMnth').'/'.$this->input->post('CCExpYear'),
					'first_name' => $this->input->post('full_name'),
					'last_name' => '',
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'country' => $this->input->post('country'),
					'phone' => $this->input->post('phone'),
					'email' =>  $this->input->post('email'),
					'card_code' => $this->input->post('creditCardIdentifier'),
					)
				);
				
				$response = $transaction->authorizeAndCapture();
				//echo '<pre>'; print_r($response); die;
			if( $response->approved ){
				//$moveShoppingDataToPayment = $this->ibrandshopping_model->moveShoppingDataToPayment(); 
				//redirect('site/shopcart/returnpage/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$response->transaction_id);
				
				if(isset($_POST['wallet_payment'])){
					
// 					$seller = $this->checkout_model->get_all_details(SELLER,array("seller_id"=>$loginUserId))->result_array();
// 					$wallet = $seller[0]['wallet_amount'] + $_POST['wallet_payment']; 
// 					$this->checkout_model->update_details(SELLER,array('wallet_amount'=>$wallet),array('seller_id' => $loginUserId));
					
					$seller = $this->checkout_model->get_all_details(USERS,array("id"=>$loginUserId))->result_array();
					$wallet_amount =  $_POST['wallet_payment'] / $this->data['currencyValue'];
					$wallet = $seller[0]['credits'] + $wallet_amount;
					$this->checkout_model->update_details(USERS,array('credits'=>$wallet),array("id"=>$loginUserId));
					
					redirect("order/confirmation/product");
				}
				else{
					//$this->paypal_class->add_field('return',base_url().'order/productsuccess/'.$totalAmount.'/'.$loginUserId.'/Paypal');
					redirect('order/productsuccess/'.$this->input->post('total_amt').'/'.$loginUserId.'/'.$response->transaction_id);
				}
				
 			}else{		
				//redirect('site/shopcart/cancel?failmsg='.$response->response_reason_text); 
				redirect('order/productfailure/'.$response->response_reason_text); 
			}
	
	}
	
	/** 
	 * 
	 * Product Payment by paypal by shop product add 
	 *
	 */
	public function ProductPaymentPaypal(){
		
		
		//echo '<pre>'; print_r($_POST); die;
		
		$excludeArr = array('paypalmode','paypalEmail','total_price','PaypalSubmit','wallet_payment');
    	
		$loginUserId = $this->checkLogin('U');
		
		
			/*Paypal integration start */
			$this->load->library('paypal_class');
			
			$item_name = $this->config->item('email_title').' Products';
			
			#$totalAmount = $this->input->post('total_amt');
			
			if(isset($_POST['wallet_payment'])){
				$totalAmount = $this->input->post('total_amt');
			}else{
				$totalAmount = number_format($this->input->post('total_amt')*$this->data['currencyValue'],2);
			}
			
			$quantity = 1;
			
			if($this->input->post('paypalmode') == 'sandbox'){
				$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
			}else{
				$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
			}
			
			$this->paypal_class->add_field('currency_code', $this->data['currencyType']);
			
			$this->paypal_class->add_field('business',$this->input->post('paypalEmail')); // Business Email
			
			
			if(isset($_POST['wallet_payment'])){ 
					
				$this->paypal_class->add_field('return',base_url().'order/wallet_payment/'.$totalAmount.'/'.$loginUserId); // Return URL
						
				$this->paypal_class->add_field('cancel_return', base_url().'order/productfailure'); // Cancel URL
				
			}else{
			
				$this->paypal_class->add_field('return',base_url().'order/productsuccess/'.$totalAmount.'/'.$loginUserId); // Return URL
				
				$this->paypal_class->add_field('cancel_return', base_url().'order/productfailure'); // Cancel URL
			}
			
			
			$this->paypal_class->add_field('notify_url', base_url().'site/order/ipnpayment'); // Notify url
			
			$this->paypal_class->add_field('custom', 'SellerProductPayment|'.$loginUserId.'|'.$lastFeatureInsertId.'|'.$totalAmount); // Custom Values			
			
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
	 * Cash on Delivery Method is in process
	 *
	 */
	
	function UserPaymentOnDelivery()
	{
		//User ID
		$loginUserId = $this->checkLogin('U');
		//DealCodeNumber
		$lastFeatureInsertId = $this->session->userdata('UserrandomNo');
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->checkout_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		
		$excludeArr = array('codmode','codEmail','total_price','CodSubmit');

		$condition =array('id' => $loginUserId);
		$dataArr = array('user_id'=>$loginUserId,'full_name'=>$this->input->post('full_name'),'address1'=>$this->input->post('address'),'address2'=>$this->input->post('address2'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postal_code'),'phone'=>$this->input->post('phone_no'));
		$this->checkout_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
		
		$this->checkout_model->update_details(USER_PAYMENT,array('billingid' => $insID),array('dealCodeNumber' => $lastFeatureInsertId));
		
		//$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
	
		
		
			
			$item_name = $this->config->item('email_title').' Products';
			
			$totalAmount = $this->input->post('total_price')*$this->data['currencyValue'];
				
		       redirect('order/codsuccess/'.$loginUserId.'/'.$lastFeatureInsertId); // Return URL
	}
	/***Wire Transfer payment starts****/

	
	function UserPaymentOnwiretransfer()
	{
		//User ID
		$loginUserId = $this->checkLogin('U');
		//DealCodeNumber
		$lastFeatureInsertId = $this->session->userdata('UserrandomNo');
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->checkout_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		
		
				
		       redirect('order/wiretransfersuccess/'.$loginUserId.'/'.$lastFeatureInsertId); // Return URL
		}
		
function UserPaymentOnwesternunion()
	{
		//User ID
		$loginUserId = $this->checkLogin('U');
		//DealCodeNumber
		$lastFeatureInsertId = $this->session->userdata('UserrandomNo');
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->checkout_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		
		
				
		       redirect('order/westernunionsuccess/'.$loginUserId.'/'.$lastFeatureInsertId); // Return URL
			
	
	
        
	}
	
	
  
	
	
	/**
	 *
	 * Payment paid for payu payment gateway for user
	 *
	 */
	public function UserPaymentOnUserCredits(){
		
		//echo "<pre>"; print_r($this->input->post()); die;

		$loginUserId = $this->checkLogin('U');
		$lastFeatureInsertId = $this->session->userdata('UserrandomNo');
		
//update address
		$condition =array('id' => $loginUserId);
		$dataArr = array('address'=>$this->input->post('street'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postalcode'),'phone_no'=>$this->input->post('phone'));
		$this->checkout_model->update_details(USERS,$dataArr,$condition);

//update redeem
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->checkout_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
///update bill		
		$condition =array('id' => $loginUserId);
		$billArr = array('user_id'=>$loginUserId,'full_name'=>$this->input->post('full_name'),'address1'=>$this->input->post('address'),'address2'=>$this->input->post('address2'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postal_code'),'phone'=>$this->input->post('phone_no'));
		$this->checkout_model->simple_insert(BILLING_ADDRESS,$billArr);
		$insID = $this->db->insert_id();
		
		$this->checkout_model->update_details(USER_PAYMENT,array('billingid' => $insID),array('dealCodeNumber' => $lastFeatureInsertId));

		
		redirect('order/userCreditsuccess/'.$loginUserId.'/'.$lastFeatureInsertId); // Return URL
		
	}
	
	
	/** 
	 * 
	 * Payment paid for payu payment gateway for user
	 *
	 */
	public function UserPaymentPayuProcess(){
		
		//User ID
		$loginUserId = $this->checkLogin('U');
		//DealCodeNumber
		$lastFeatureInsertId = $this->session->userdata('UserrandomNo');
		
		if($this->input->post('reedemcode')!=''){
			$giftIDVal = $this->checkout_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $loginUserId));
			$this->checkout_model->update_details(USER_PAYMENT,array( 'giftdiscountAmount' => $giftIDVal->row()->giftdiscountAmount,'gift_coupon_used' => $giftIDVal->row()->gift_coupon_used,'giftcouponID' => $giftIDVal->row()->giftcouponID,'giftcouponcode' => $giftIDVal->row()->giftcouponcode,'giftcoupontype' => $giftIDVal->row()->giftcoupontype),array( 'dealCodeNumber' => $lastFeatureInsertId));
		}
		
		$excludeArr = array('payumode','payuEmail','total_price','PayuSubmit');
    	
		
		
		$condition =array('id' => $loginUserId);
		$dataArr = array('user_id'=>$loginUserId,'full_name'=>$this->input->post('full_name'),'address1'=>$this->input->post('address'),'address2'=>$this->input->post('address2'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postal_code'),'phone'=>$this->input->post('phone_no'));
		$this->checkout_model->simple_insert(BILLING_ADDRESS,$dataArr);
		$insID = $this->db->insert_id();
		
		$this->checkout_model->update_details(USER_PAYMENT,array('billingid' => $insID),array('dealCodeNumber' => $lastFeatureInsertId));
		
		//$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
	
		
			/*Paypal integration start */
			$this->load->library('payU');
			
			$item_name = $this->config->item('email_title').' Products';
			
			$totalAmount = $this->input->post('total_price')*$this->data['currencyValue'];
			
			
			$quantity = 1;
			$payu=NULL;
			if(strtolower($this->input->post('payumode')) == 'sandbox')
			{
				echo $this->input->post('payUmode');
        		$payu=new payU("test");
			}
		  else
		  {
		        $payu=new payU();
                echo "udhay"; 
		  }
			    $payu->set_transid();
				$array1=array();
                 $array1['firstname']=$this->session->userdata['shopsy_session_user_email'];
	                $array1['amount']=ceil($totalAmount); 
	                $array1['surl']=base_url().'order/payusuccess/'.$loginUserId.'/'.$lastFeatureInsertId; // Return URL
			        $array1['curl']=base_url().'order/failure'; // Cancel URL
			        $array1['furl']=base_url().'site/order/ipnpayment'; // Notify url
					$array1['productinfo']='Item Name , '.$item_name." Quantity,".$quantity;
					$array1['email']=$this->config->item('email_title');
					
							
			       $seller=$this->checkout_model->get_all_details(SELLER,array("seller_id"=>$this->input->post("seller_id")));
				   $seller=$seller->result_array();
				 
				   $payu->set_secretvalues($seller[0]["payu_merchant_id"],$seller[0]["payu_salt"]);
				   $payu->set_transid();
				   $payu->add_fields($array1);
	   
	        
	   $payu->create_hash();
	   $payu->submit_payuform();
	   
			
						
	}
        public function payon_return(){
            $this->load->library('payon');
            $loginUserId = $this->checkLogin('U');
            $lastFeatureInsertId = $this->session->userdata('UserrandomNo');            
            if($this->input->post('id') != ''){
                $response = $this->payon->getPaymentStatus($this->input->post('id'));
                if(substr($response["result"]["code"], 0, 3) === "000"){
                    redirect('order/payonsuccess/'.$loginUserId.'/'.$lastFeatureInsertId.'/?txn_id='.$response['resultDetails']['ConnectorTxID1']); // Return URL
                }else{
                    redirect('order/payonfailiure/'.urlencode($response['result']['description'])); // Return URL
                }
            }else{
                $response = $this->payon->getPaymentStatus($this->input->get('id'));
                if(substr($response["result"]["code"], 0, 3) === "000"){
                    redirect('order/payonsuccess/'.$loginUserId.'/'.$lastFeatureInsertId.'/?txn_id='.$response['resultDetails']['ConnectorTxID1']); // Return URL
                }else{
                    redirect('order/payonfailiure/'.urlencode($response['result']['description'])); // Return URL
                }
            }
        }
}

/* End of file checkout.php */
/* Location: ./application/controllers/site/checkout.php */