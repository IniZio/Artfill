<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to Cart Page
 * @author Teamtweaks
 *
 */
class Order_model extends My_Model
{
	/*** To add order ***/
	public function add_order($dataArr=''){
			$this->db->insert(PRODUCT,$dataArr);
	}
	/*** To edit order ***/
	public function edit_order($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(PRODUCT,$dataArr);
	}
	
	/*** To view order ***/
	public function view_order($condition=''){
			return $this->db->get_where(PRODUCT,$condition);
			
	}
	/*** To view order details***/
	public function view_order_details($status,$cond='',$condit=''){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,c.attr_name');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->join(PRODUCT_ATTRIBUTE.' as c' , 'c.id = p.attribute_values','left');			
		$this->db->where('p.status = "'.$status.'"');	
		if($cond!=''){
			$this->db->where($cond);
		}
		if($condit!=''){
			$this->db->where($condit,null,false);
		}
		$this->db->group_by("p.dealCodeNumber"); 
		$this->db->order_by("p.created", "desc"); 
		$PrdList = $this->db->get();
		//echo '<pre>'; print_r($PrdList->result()); die;
		return $PrdList;
	}
	
	public function view_order_details_cancelled($status,$cond='',$condit=''){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,c.attr_name');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->join(PRODUCT_ATTRIBUTE.' as c' , 'c.id = p.attribute_values','left');			
		//$this->db->where('p.status = "'.$status.'"');	
		if($cond!=''){
			$this->db->where($cond);
		}
		if($condit!=''){
			$this->db->where($condit,null,false);
		}
		$this->db->group_by("p.dealCodeNumber"); 
		$this->db->order_by("p.created", "desc"); 
		$PrdList = $this->db->get();
		//echo '<pre>'; print_r($PrdList->result()); die;
		return $PrdList;
	}
	/*** To view order details of cod***/
	public function view_order_cod($payment_type){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,c.attr_name');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->join(PRODUCT_ATTRIBUTE.' as c' , 'c.id = p.attribute_values','left');			
		//$this->db->where('p.status = "'.$status.'"');	
		$this->db->where('p.payment_type = "'.$payment_type.'"');				
		$this->db->group_by("p.dealCodeNumber"); 
		$this->db->order_by("p.created", "desc"); 
		$PrdList = $this->db->get();
		
		//echo '<pre>'; print_r($PrdList->result()); die;
		return $PrdList;
	}
	public function view_order_wiretransfer($payment_type){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,c.attr_name');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->join(PRODUCT_ATTRIBUTE.' as c' , 'c.id = p.attribute_values','left');		
		$this->db->where('p.payment_type = "'.$payment_type.'"');				
		$this->db->group_by("p.dealCodeNumber"); 
		$this->db->order_by("p.created", "desc"); 
		$PrdList = $this->db->get();
		
		//echo '<pre>'; print_r($PrdList->result()); die;
		return $PrdList;
	}
	public function view_order_westernunion($payment_type){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,c.attr_name');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->join(PRODUCT_ATTRIBUTE.' as c' , 'c.id = p.attribute_values','left');		
		$this->db->where('p.payment_type = "'.$payment_type.'"');				
		$this->db->group_by("p.dealCodeNumber"); 
		$this->db->order_by("p.created", "desc"); 
		$PrdList = $this->db->get();
		
		//echo '<pre>'; print_r($PrdList->result()); die;
		return $PrdList;
	}
	/*** To view shop order details***/
	public function view_shop_order_details($status='',$sid='',$order='',$uid='',$from='',$to='',$id=''){
		//echo "asa"; die;
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,c.attr_name');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id','left');
		$this->db->join(PRODUCT_ATTRIBUTE.' as c' , 'c.id = p.attribute_values','left');			
		$this->db->where('p.status = "'.$status.'"');
		$this->db->where('p.payment_type != "COD"');
			
		if($sid !=''){
			$this->db->where('p.sell_id = "'.$sid.'"');
		}
		
		if($order !=''){
			if($order == 'dispute'){
				$this->db->where('p.shipping_status != "Cancelled"');
				$this->db->where('p.received_status = "Requested Cancel"');
			}else{
				$this->db->where('p.shipping_status = "'.$order.'"');
			}
		}
		
		if($uid !=''){
			$this->db->where('p.user_id = "'.$uid.'"');
		}
		
		if($from !='' && $to !=''){
			$this->db->where('p.created >= "'.$from.'"');
			$this->db->where('p.created <= "'.$to.'"');
		}
		
		if($id !=''){
			$this->db->where('p.dealCodeNumber = "'.$id.'"');
		}
		
		$this->db->group_by("p.dealCodeNumber"); 
		$this->db->order_by("p.created", "desc"); 
		$PrdList = $this->db->get();
		//echo $this->db->last_query(); die();
		return $PrdList;
	}
	

	/*** To view shop cod order ***/
	public function view_shop_cod_details($payment_type,$id){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,c.attr_name');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->join(PRODUCT_ATTRIBUTE.' as c' , 'c.id = p.attribute_values','left');			
		$this->db->where('p.payment_type = "'.$payment_type.'"');
		$this->db->where('p.sell_id = "'.$id.'"');				
		$this->db->group_by("p.dealCodeNumber"); 
		$this->db->order_by("p.created", "desc"); 
		$PrdList = $this->db->get();
		#echo $this->db->last_query(); die();
		return $PrdList;
	}
	
	public function view_shop_wiretransfer_details($payment_type,$id){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,c.attr_name');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->join(PRODUCT_ATTRIBUTE.' as c' , 'c.id = p.attribute_values','left');			
		$this->db->where('p.payment_type = "'.$payment_type.'"');
		$this->db->where('p.sell_id = "'.$id.'"');				
		$this->db->group_by("p.dealCodeNumber"); 
		$this->db->order_by("p.created", "desc"); 
		$PrdList = $this->db->get();
		#echo $this->db->last_query(); die();
		return $PrdList;
	//	echo  $PrdList;die;
	}
	
	
	/*** To view user order ***/
	public function view_user_order_details($status){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(USER_PRODUCTS.' as pd' , 'pd.id = p.product_id');		
		$this->db->where('p.status = "'.$status.'"');				
		$this->db->group_by("p.dealCodeNumber"); 
		$this->db->order_by("p.created", "desc"); 
		$PrdList = $this->db->get();
		
		//echo '<pre>'; print_r($PrdList->result()); die;
		return $PrdList;
	}
	/*** To get order details***/
	public function get_order_details($dealCodeNumber){
		$this->db->select('p.dealCodeNumber,p.user_id as buyer_id,p.sell_id as seller_id,buyer.user_name as buyer_name,buyer.thumbnail as buyer_img,buyer.email as buyer_mail,seller.user_name as seller_name,seller.thumbnail as seller_img,seller.email as seller_mail');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as buyer' , 'buyer.id = p.user_id');
		$this->db->join(USERS.' as seller' , 'seller.id = p.sell_id');		
		$this->db->where('p.dealCodeNumber = "'.$dealCodeNumber.'"');
		$this->db->group_by("p.dealCodeNumber"); 
		$orderInfo = $this->db->get();
		return $orderInfo;
	}
/*********************************************** Payment Success Cart********************************************************/	
	public function UserPaymentPesapal($userid='', $transId = '',$payerMail = '', $randomId=''){
		
		$paymtdata = array(
				'UserrandomNo' => $randomId,
				'shopsy_session_user_id' => $userid,
		);
		$this->session->set_userdata($paymtdata);
		$CoupRes = $this->order_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'couponID >' => 0));
		$couponID = $CoupRes->row()->couponID;
		$couponAmont = $CoupRes->row()->discountAmount;
		$couponType = $CoupRes->row()->coupontype;	
		
		$GiftCoupRes = $this->order_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'giftcouponID >' => 0));
		$GiftcouponID = $GiftCoupRes->row()->giftcouponID;
		$GiftcouponAmont = $GiftCoupRes->row()->giftdiscountAmount;
		$GiftcouponType = $GiftCoupRes->row()->giftcoupontype;		

		// Update Coupon
		if($couponID != 0) {
				$SelCoup = $this->order_model->get_all_details(COUPONCARDS,array( 'id' => $couponID));
				$CountValue = $SelCoup->row()->purchase_count + 1;
				$condition = array( 'id' => $couponID);
				$dataArr = array('purchase_count' => $CountValue);
				$this->order_model->update_details(COUPONCARDS,$dataArr,$condition);
		}
		
		if($GiftcouponID !=0){
				$SelGift = $this->order_model->get_all_details(GIFTCARDS,array( 'id' => $GiftcouponID));
				$GiftCountValue = $SelGift->row()->used_amount + $GiftcouponAmont;
				$condition = array( 'id' => $GiftcouponID);
				$dataArr = array('used_amount' => $GiftCountValue);
				$this->order_model->update_details(GIFTCARDS,$dataArr,$condition);
				if($SelGift->row()->price_value <= $GiftCountValue ){
					
					$condition1 = array( 'id' => $GiftcouponID);
					$dataArr1 = array('card_status' => 'redeemed');
					$this->order_model->update_details(GIFTCARDS,$dataArr1,$condition1);
				}
			
			}

		//Update Payment Table	
			$condition1 = array( 'user_id' => $userid, 'dealCodeNumber' => $randomId);
			if($payerMail != ''){
				$dataArr1 = array('status' => 'Paid','shipping_status' => 'Processed', 'paypal_transaction_id' => $transId, 'payer_email' => $payerMail, 'payment_type'=>'Pesapal');			
			}else{
			
				$dataArr1 = array('status' => 'Paid','shipping_status' => 'Processed', 'paypal_transaction_id' => $transId, 'payment_type'=>'Pesapal');
			}
			
			$this->order_model->update_details(USER_PAYMENT,$dataArr1,$condition1);
			
			$actArr = array('activity'=>"order",
				'activity_id'=>$randomId,
				'user_id'	=>$userid,
				'activity_ip'=>$this->input->ip_address(),
				'created'=>date("Y-m-d H:i:s"));
			$this->user_model->simple_insert(NOTIFICATIONS,$actArr);	
		//Update Quantity
			$SelQty = $this->order_model->get_all_details(USER_PAYMENT,array( 'user_id' => $userid, 'dealCodeNumber' => $randomId));
			foreach($SelQty->result() as $updPrdRow){
				$SelPrd = $this->order_model->get_all_details(PRODUCT,array( 'id' => $updPrdRow->product_id ));
				$PrdCount = $SelPrd->row()->purchasedCount + $updPrdRow->quantity;
				$productCount = $SelPrd->row()->quantity - $updPrdRow->quantity;
				$condition2 = array( 'id' => $updPrdRow->product_id );
				$dataArr2 = array('purchasedCount' => $PrdCount,'quantity'=>$productCount);
				//$this->order_model->update_details(PRODUCT,$dataArr2,$condition2);
				
				
				$this->order_model->update_details(PRODUCT_EN,$dataArr2,$condition2);
				
				$languages = $this->order_model->get_languages_list();
				foreach($languages as $lang){
					$ln = $lang['lang_code'];
					$table = PRODUCT_EN;
					$ln_table = $table."_".$ln;
					$this->order_model->update_details($ln_table,$dataArr2,$condition2);
				}
				
				
				
			}
			//Send Mail to User
		$this->db->select('p.*,u.email,u.full_name,u.address,u.address2,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.image,pd.id as PrdID');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
		$PrdList = $this->db->get();
		
		$this->db->select('email,user_name');
		$this->db->from(USERS);
		$this->db->where('id = "'.$PrdList->row()->sell_id.'" ');
		$SellList = $this->db->get();
		
		$this->SendMailUSersPayment($PrdList,$SellList);
		
		//Empty Cart Info
		$condition3 = array('user_id' => $userid,'sell_id' => $PrdList->row()->sell_id);
		$this->order_model->commonDelete(USER_SHOPPING_CART,$condition3);
		
		$paymtdata = array(	'UserrandomNo' => '');
		$this->session->set_userdata($paymtdata);	
		
		echo 'Success';
	}
	public function UserPaymenttwocheckoutSuccess($userid='', $transId = '',$payerMail = '', $randomId=''){
		
		$paymtdata = array(
				'UserrandomNo' => $randomId,
				'shopsy_session_user_id' => $userid,
		);

	
		$this->session->set_userdata($paymtdata);
		
		$CoupRes = $this->order_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'couponID >' => 0));
		$couponID = $CoupRes->row()->couponID;
		$couponAmont = $CoupRes->row()->discountAmount;
		$couponType = $CoupRes->row()->coupontype;	
		
		
		$GiftCoupRes = $this->order_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'giftcouponID >' => 0));
		$GiftcouponID = $GiftCoupRes->row()->giftcouponID;
		$GiftcouponAmont = $GiftCoupRes->row()->giftdiscountAmount;
		$GiftcouponType = $GiftCoupRes->row()->giftcoupontype;		

	
		// Update Coupon
		if($couponID != 0) {
				$SelCoup = $this->order_model->get_all_details(COUPONCARDS,array( 'id' => $couponID));
				$CountValue = $SelCoup->row()->purchase_count + 1;
				$condition = array( 'id' => $couponID);
				$dataArr = array('purchase_count' => $CountValue);
				$this->order_model->update_details(COUPONCARDS,$dataArr,$condition);
		}
		
		if($GiftcouponID !=0){
				$SelGift = $this->order_model->get_all_details(GIFTCARDS,array( 'id' => $GiftcouponID));
				$GiftCountValue = $SelGift->row()->used_amount + $GiftcouponAmont;
				$condition = array( 'id' => $GiftcouponID);
				$dataArr = array('used_amount' => $GiftCountValue);
				$this->order_model->update_details(GIFTCARDS,$dataArr,$condition);
				if($SelGift->row()->price_value <= $GiftCountValue ){
					
					$condition1 = array( 'id' => $GiftcouponID);
					$dataArr1 = array('card_status' => 'redeemed');
					$this->order_model->update_details(GIFTCARDS,$dataArr1,$condition1);
				}
			
			}

		//Update Payment Table	
			$condition1 = array( 'user_id' => $userid, 'dealCodeNumber' => $randomId);
			if($payerMail != ''){
				$dataArr1 = array('status' => 'Paid','shipping_status' => 'Processed', 'twocheckout_transcation_id' => $transId, 'payer_email' => $payerMail);			
			}else{
			
				$dataArr1 = array('status' => 'Paid','shipping_status' => 'Processed', 'twocheckout_transcation_id' => $transId);
			}
			
			$this->order_model->update_details(USER_PAYMENT,$dataArr1,$condition1);
			
			$actArr = array('activity'=>"order",
									'activity_id'=>$randomId,
									'user_id'	=>$userid,
									'activity_ip'=>$this->input->ip_address(),
									'created'=>date("Y-m-d H:i:s"));
			$this->user_model->simple_insert(NOTIFICATIONS,$actArr);	

		//Update Quantity
			$SelQty = $this->order_model->get_all_details(USER_PAYMENT,array( 'user_id' => $userid, 'dealCodeNumber' => $randomId));

			foreach($SelQty->result() as $updPrdRow){
			
				$SelPrd = $this->order_model->get_all_details(PRODUCT,array( 'id' => $updPrdRow->product_id ));
				$PrdCount = $SelPrd->row()->purchasedCount + $updPrdRow->quantity;
				$productCount = $SelPrd->row()->quantity - $updPrdRow->quantity;
				$condition2 = array( 'id' => $updPrdRow->product_id );
				$dataArr2 = array('purchasedCount' => $PrdCount,'quantity'=>$productCount);
				//$this->order_model->update_details(PRODUCT,$dataArr2,$condition2);
				
				$this->order_model->update_details(PRODUCT_EN,$dataArr2,$condition2);
				
				$languages = $this->order_model->get_languages_list();
				foreach($languages as $lang){
					$ln = $lang['lang_code'];
					$table = PRODUCT_EN;
					$ln_table = $table."_".$ln;
					$this->order_model->update_details($ln_table,$dataArr2,$condition2);
				}
				
				
			}
			
			
			//Send Mail to User
			
		$this->db->select('p.*,u.email,u.full_name,u.address,u.address2,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.image,pd.id as PrdID');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
		$PrdList = $this->db->get();
		
		
		
		$this->db->select('email,user_name');
		$this->db->from(USERS);
		$this->db->where('id = "'.$PrdList->row()->sell_id.'" ');
		$SellList = $this->db->get();
		
		$this->SendMailUSersPayment($PrdList,$SellList);
		
		//Empty Cart Info
		$condition3 = array('user_id' => $userid,'sell_id' => $PrdList->row()->sell_id);
		$this->order_model->commonDelete(USER_SHOPPING_CART,$condition3);
		
		$paymtdata = array(	'UserrandomNo' => '');
		$this->session->set_userdata($paymtdata);	
		
		echo 'Success';
	}
	/*** To update order detail after payment success ***/
	
	public function PaymentSuccess($userid='', $randomId='' ,$transId = '', $payerMail = '', $userCredits=''){
		
		$paymtdata = array(
				'randomNo' => $randomId,
				'shopsy_session_user_id' => $userid,
		);
		$this->session->set_userdata($paymtdata);

		$CoupRes = $this->order_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid, 'couponID >' => 0));
		
		$couponID = $CoupRes->row()->couponID;
		$couponAmont = $CoupRes->row()->discountAmount;
		$couponType = $CoupRes->row()->coupontype;		
	
		// Update Coupon
		if($couponID != 0) {
			if($couponType == 'Gift'){
				$SelGift = $this->order_model->get_all_details(GIFTCARDS,array( 'id' => $couponID));

				$GiftCountValue = $SelGift->row()->used_amount + $couponAmont;
				$condition = array( 'id' => $couponID);
				$dataArr = array('used_amount' => $GiftCountValue);
				$this->order_model->update_details(GIFTCARDS,$dataArr,$condition);
				if($SelGift->row()->price_value <= $GiftCountValue ){
					
					$condition1 = array( 'id' => $couponID);
					$dataArr1 = array('card_status' => 'redeemed');
					$this->order_model->update_details(GIFTCARDS,$dataArr1,$condition1);
				}
			
			}else{
				$SelCoup = $this->order_model->get_all_details(COUPONCARDS,array( 'id' => $couponID));
				$CountValue = $SelCoup->row()->purchase_count + 1;
				$condition = array( 'id' => $couponID);
				$dataArr = array('purchase_count' => $CountValue);
				$this->order_model->update_details(COUPONCARDS,$dataArr,$condition);
			}
		}
			
		//Update Payment Table	
		
			$condition1 = array( 'user_id' => $userid, 'dealCodeNumber' => $randomId);
			if($payerMail != ''){
				$dataArr1 = array('status' => 'Paid','shipping_status' => 'Processed', 'paypal_transaction_id' => $transId, 'payer_email' => $payerMail,'payment_type' => 'Paypal');			
			}else{
				$dataArr1 = array('status' => 'Paid','shipping_status' => 'Processed', 'paypal_transaction_id' => $transId, 'payment_type' => 'Credit Cart' );
			}
		
		$this->order_model->update_details(PAYMENT,$dataArr1,$condition1);
			

		//Update Quantity
			$SelQty = $this->order_model->get_all_details(PAYMENT,array( 'user_id' => $userid, 'dealCodeNumber' => $randomId));

			foreach($SelQty->result() as $updPrdRow){
			
				$SelPrd = $this->order_model->get_all_details(PRODUCT,array( 'id' => $updPrdRow->product_id ));
				$PrdCount = $SelPrd->row()->purchasedCount + $updPrdRow->quantity;
				$productCount = $SelPrd->row()->quantity - $updPrdRow->quantity;
				$condition2 = array( 'id' => $updPrdRow->product_id );
				$dataArr2 = array('purchasedCount' => $PrdCount,'quantity'=>$productCount);
				//$this->order_model->update_details(PRODUCT,$dataArr2,$condition2);
				
				$this->order_model->update_details(PRODUCT_EN,$dataArr2,$condition2);
				
				$languages = $this->order_model->get_languages_list();
				foreach($languages as $lang){
					$ln = $lang['lang_code'];
					$table = PRODUCT_EN;
					$ln_table = $table."_".$ln;
					$this->order_model->update_details($ln_table,$dataArr2,$condition2);
				}
				
				
			}
			
			
			//Send Mail to User
			
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.image,pd.id as PrdID,pAr.attr_name');
		$this->db->from(PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = p.attribute_values','left');
		$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
		$PrdList = $this->db->get();
		
		$this->db->select('p.sell_id,u.email');
		$this->db->from(PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.sell_id = u.id');
		$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
		$this->db->group_by("p.sell_id"); 	
		$SellList = $this->db->get();
		
		$this->SendMailUSers($PrdList,$SellList);
				
		
			//Empty Cart Info
			$condition3 = array('user_id' => $userid);
			$this->order_model->commonDelete(SHOPPING_CART,$condition3);
			
		$paymtdata = array(	'randomNo' => '');
		$this->session->set_userdata($paymtdata);	
		
		echo 'Success';
	}
	
/*********************************************** Payment Success Seller Cart********************************************************/	
	
	public function UserPaymentSuccess($userid='', $randomId='' ,$transId = '', $payerMail = '', $userCredits=''){
		$paymtdata = array(
				'UserrandomNo' => $randomId,
				'shopsy_session_user_id' => $userid,
		);
		$this->session->set_userdata($paymtdata);
		
		$CoupRes = $this->order_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'couponID >' => 0));
		$couponID = $CoupRes->row()->couponID;
		$couponAmont = $CoupRes->row()->discountAmount;
		$couponType = $CoupRes->row()->coupontype;	
		
		
		$GiftCoupRes = $this->order_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'giftcouponID >' => 0));
		$GiftcouponID = $GiftCoupRes->row()->giftcouponID;
		$GiftcouponAmont = $GiftCoupRes->row()->giftdiscountAmount;
		$GiftcouponType = $GiftCoupRes->row()->giftcoupontype;		

	
		// Update Coupon
		if($couponID != 0) {
				$SelCoup = $this->order_model->get_all_details(COUPONCARDS,array( 'id' => $couponID));
				$CountValue = $SelCoup->row()->purchase_count + 1;
				$condition = array( 'id' => $couponID);
				$dataArr = array('purchase_count' => $CountValue);
				$this->order_model->update_details(COUPONCARDS,$dataArr,$condition);
		}
		
		if($GiftcouponID !=0){
				$SelGift = $this->order_model->get_all_details(GIFTCARDS,array( 'id' => $GiftcouponID));
				$GiftCountValue = $SelGift->row()->used_amount + $GiftcouponAmont;
				$condition = array( 'id' => $GiftcouponID);
				$dataArr = array('used_amount' => $GiftCountValue);
				$this->order_model->update_details(GIFTCARDS,$dataArr,$condition);
				if($SelGift->row()->price_value <= $GiftCountValue ){
					
					$condition1 = array( 'id' => $GiftcouponID);
					$dataArr1 = array('card_status' => 'redeemed');
					$this->order_model->update_details(GIFTCARDS,$dataArr1,$condition1);
				}
			
			}

		//Update Payment Table	
		
			$order_info = $this->order_model->get_all_details(USER_PAYMENT,array( 'user_id' => $userid, 'dealCodeNumber' => $randomId));
			$shipping_status = 'Delivered';
			foreach($order_info->result() as $userCartItems){
				if($userCartItems->digital_files == ''){
					$shipping_status = 'Processed'; break;
				}
			}
		
			if($userCredits == 'userCredits'){
				//update credits
				$user = $this->order_model->get_all_details(USERS,array( 'id' => $this->checkLogin('U')));
				$credit = $user->row()->credits;
				$total = $order_info->row()->total;
				$newCredit = $credit - $total;
				
				$this->order_model->update_Details(USERS,array( 'credits' => $newCredit),array( 'id' => $this->checkLogin('U')));
				
				$condition1 = array( 'user_id' => $userid, 'dealCodeNumber' => $randomId);
				$dataArr1 = array('status' => 'Paid','shipping_status' => 'Processed','payer_email' => $payerMail,'payment_type' => 'userCredits');
				
			}else{
				$condition1 = array( 'user_id' => $userid, 'dealCodeNumber' => $randomId);
				if($payerMail != ''){
					$dataArr1 = array('status' => 'Paid','shipping_status' => $shipping_status, 'paypal_transaction_id' => $transId, 'payer_email' => $payerMail);			
				}else{
					$dataArr1 = array('status' => 'Paid','shipping_status' => $shipping_status, 'paypal_transaction_id' => $transId);
				}
			}
			$this->order_model->update_details(USER_PAYMENT,$dataArr1,$condition1);
			
			
			$actArr = array('activity'=>"order",
									'activity_id'=>$randomId,
									'user_id'	=>$userid,
									'activity_ip'=>$this->input->ip_address(),
									'created'=>date("Y-m-d H:i:s"));
			$this->user_model->simple_insert(NOTIFICATIONS,$actArr);	

		//Update Quantity
			$SelQty = $this->order_model->get_all_details(USER_PAYMENT,array( 'user_id' => $userid, 'dealCodeNumber' => $randomId));
			foreach($SelQty->result() as $updPrdRow){					
				$SelPrd = $this->order_model->get_all_details(PRODUCT,array( 'id' => $updPrdRow->product_id ));
				$PrdCount = $SelPrd->row()->purchasedCount + $updPrdRow->quantity;
				if($updPrdRow->digital_files == ''){
					$productCount = $SelPrd->row()->quantity - $updPrdRow->quantity;
				} else {
					$productCount = $SelPrd->row()->quantity;
				}
				$condition2 = array( 'id' => $updPrdRow->product_id );
				$dataArr2 = array('purchasedCount' => $PrdCount,'quantity'=>$productCount);
				//$this->order_model->update_details(PRODUCT,$dataArr2,$condition2);	

				$this->order_model->update_details(PRODUCT_EN,$dataArr2,$condition2);
				
				$languages = $this->order_model->get_languages_list();
				foreach($languages as $lang){
					$ln = $lang['lang_code'];
					$table = PRODUCT_EN;
					$ln_table = $table."_".$ln;
					$this->order_model->update_details($ln_table,$dataArr2,$condition2);
				}
				
				
			}
			
			
			//Send Mail to User
			
		$this->db->select('p.*,u.email,u.full_name,u.address,u.address2,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.image,pd.id as PrdID');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
		$PrdList = $this->db->get();
		
		
		
		$this->db->select('email,user_name');
		$this->db->from(USERS);
		$this->db->where('id = "'.$PrdList->row()->sell_id.'" ');
		$SellList = $this->db->get();
		
		$this->db->select('user_name');
		$this->db->from(USERS);
		$this->db->where('id = "'.$PrdList->row()->user_id.'" ');
		$UserInfos = $this->db->get();
		/*Push Message Starts*/
		$message=$UserInfos->row()->user_name.' made an order in your shop on '.$this->config->item('email_title');
		$type='order';
		$this->order_model->sendPushNotification($PrdList->row()->sell_id,$message,$type,array($randomId,$PrdList->row()->user_id));
		/*Push Message Ends*/
		
		$this->SendMailUSersPayment($PrdList,$SellList);
		
		//Empty Cart Info
		$condition3 = array('user_id' => $userid,'sell_id' => $PrdList->row()->sell_id);
		$this->order_model->commonDelete(USER_SHOPPING_CART,$condition3);
		
		$paymtdata = array(	'UserrandomNo' => '');
		$this->session->set_userdata($paymtdata);	
		
		echo 'Success';
	}
	
/*********************************************** Payment Success Seller product********************************************************/	
	public function UserPaymentProductSuccess($userid='', $totAmt = '', $transId = '', $payerMail = '',$pay_type = ''){
		
	
		$paymtdata = array(
				'shopsy_session_user_id' => $userid,
		);
		$this->session->set_userdata($paymtdata);

		//Update Payment Table	
			$condition1 = array( 'user_id' => $userid,'status'=>'UnPublish','pay_status' => 'Pending');
			if($payerMail != ''){
					$dataArr1 = array('pay_status' => 'Paid','status' => 'Publish', 'pay_amount' => $totAmt, 'pay_date' => date('Y-m-d H:i:s'), 'txn_id' => $transId, 'pay_type' => 'Paypal');			
			}else{
                            if($pay_type == ''){
								$dataArr1 = array('pay_status' => 'Paid','status' => 'Publish', 'pay_amount' => $totAmt, 'pay_date' => date('Y-m-d H:i:s'), 'txn_id' => $transId, 'pay_type' => 'Creditcard');	
                            }else{
                                $dataArr1 = array('pay_status' => 'Paid','status' => 'Publish', 'pay_amount' => $totAmt, 'pay_date' => date('Y-m-d H:i:s'), 'txn_id' => $transId, 'pay_type' => $pay_type);	
                            }
			}
			#print_r($dataArr1);die;
			//$this->order_model->update_details(PRODUCT,$dataArr1,$condition1);
			
			$this->order_model->update_details(PRODUCT_EN,$dataArr1,$condition1);
			
			$languages = $this->order_model->get_languages_list();
			foreach($languages as $lang){
				$ln = $lang['lang_code'];
				$table = PRODUCT_EN;
				$ln_table = $table."_".$ln;
				$this->order_model->update_details($ln_table,$dataArr1,$condition1);
			}
			
			//echo $this->db->last_query(); die;

		//Send Mail to User
			
		/*$this->db->select('p.*,u.email,u.full_name,u.address,u.address2,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.image,pd.id as PrdID');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
		$PrdList = $this->db->get();
		
		$this->db->select('email,user_name');
		$this->db->from(USERS);
		$this->db->where('id = "'.$PrdList->row()->sell_id.'" ');
		$SellList = $this->db->get();
		
		$this->SendMailUSersPayment($PrdList,$SellList);*/
		
		
		echo 'Success';
	}	

	
	
/********************************************** Payment Gift Success ****************************************************/
	
	public function PaymentGiftSuccess($userid='' ,$transId = '', $payerMail = ''){
		
	
		$paymtdata = array(
				'shopsy_session_user_id' => $userid,
		);
		
		$this->session->set_userdata($paymtdata);
		$GiftTemp = $this->order_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
	
		
		foreach($GiftTemp->result() as $GiftRows){
		
			
			$dataArr = array();
			foreach($GiftRows as $key => $val){
				if(!(in_array($key,'id'))){
					$dataArr[$key] = trim(addslashes($val));
				}
			}		
			unset($dataArr['payment_status']);
			
			$condition ='';
			
			$dataArr1=array();
			if($payerMail != ''){
				$dataArr1 = array('payment_status' => 'Paid', 'paypal_transaction_id' => $transId, 'payer_email' => $payerMail,'payment_type' => 'Paypal');			
			}else{			
				$dataArr1 = array('payment_status' => 'Paid', 'paypal_transaction_id' => $transId, 'payment_type' => 'Credit Cart' );
			}
			
			$gift_arr=array_merge($dataArr,$dataArr1);
			$this->order_model->simple_insert(GIFTCARDS,$gift_arr);		
		}
		
		
			/* $condition1 = array( 'user_id' => $userid);
			if($payerMail != ''){
				$dataArr1 = array('payment_status' => 'Paid', 'paypal_transaction_id' => $transId, 'payer_email' => $payerMail,'payment_type' => 'Paypal');			
			}else{
			
				$dataArr1 = array('payment_status' => 'Paid', 'paypal_transaction_id' => $transId, 'payment_type' => 'Credit Cart' );
			}
			
			$this->order_model->update_details(GIFTCARDS,$dataArr1,$condition1); */
		
		//Send Mail to User
			$GiftTempVal = $this->order_model->get_all_details(GIFTCARDS,array( 'user_id' => $userid));
			$this->SendMailUSersGift($GiftTempVal);
				
		//Empty Gift cart Temp Info
			$condition3 = array('user_id' => $userid);
			$this->order_model->commonDelete(GIFTCARDS_TEMP,$condition3);
			
		echo 'Success';
	}
	
	
	/********************************************** Payment Subscribe Success ****************************************************/
	
	public function PaymentSubscribeSuccess($userid='' ,$transId = ''){
		
	
		$paymtdata = array(
				'shopsy_session_user_id' => $userid,
		);
		
		$this->session->set_userdata($paymtdata);
		
		$FancyboxTemp = $this->order_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));
	
		
		foreach($FancyboxTemp->result() as $FancyboxRow){
		
			
			$dataArr = array();
			foreach($FancyboxRow as $key => $val){
				if($key !='id'){
					$dataArr[$key] = trim(addslashes($val));
				}
			}
			$condition ='';
			$this->order_model->simple_insert(FANCYYBOX_USES,$dataArr);
		}
		
		
			$condition1 = array( 'user_id' => $userid);
			$dataArr1 = array('status' => 'Paid', 'trans_id' => $transId, 'payment_type' => 'Credit Cart' );
			
			$this->order_model->update_details(FANCYYBOX_USES,$dataArr1,$condition1);
			
		//Update Quantity
			foreach($FancyboxTemp->result() as $updPrdRow){
			
				$SelPrd = $this->order_model->get_all_details(FANCYYBOX,array( 'id' => $updPrdRow->fancybox_id ));
				$PrdCount = $SelPrd->row()->purchased + $updPrdRow->quantity;
				$condition2 = array( 'id' => $updPrdRow->fancybox_id );
				$dataArr2 = array('purchased' => $PrdCount);
				$this->order_model->update_details(FANCYYBOX,$dataArr2,$condition2);
			}
			
		
		//Send Mail to User
		
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city');
		$this->db->from(FANCYYBOX_USES.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->where('p.user_id = "'.$userid.'" and p.status="Paid"');
		$SubcribTempVal = $this->db->get();
		
		$this->SendMailUSersSubscribe($SubcribTempVal);
		
		//Empty Gift cart Temp Info
			$condition3 = array('user_id' => $userid);
			$this->order_model->commonDelete(FANCYYBOX_TEMP,$condition3);
			
		echo 'Success';
	}
	
	/********************************************** Send Mail to User***********************************************/
	public function SendMailUSers($PrdList,$SellList){
	
	//echo '<pre>';print_r($SellList->result()); die;
	
	$shipAddRess = $this->order_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $PrdList->row()->shippingid ));
	
	$subject = 'From: '.$this->config->item('email_title').' Product :: Order Confirmation';
	$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>Product Order Confirmation</title>
<body>
<div style="width:1012px;background:#FFFFFF; margin:0 auto;">
<div style="width:100%;background:#454B56; float:left; margin:0 auto;">
    <div style="padding:20px 0 10px 15px;float:left; width:50%;"><a href="'.base_url().'" target="_blank" id="logo"><img src="'.base_url().'images/logo/'.$this->data['logo'].'" alt="'.$this->data['WebsiteTitle'].'" title="'.$this->data['WebsiteTitle'].'" width="100"></a></div>
	
</div>			
<!--END OF LOGO-->
    
 <!--start of deal-->
    <div style="width:970px;background:#FFFFFF;float:left; padding:20px; border:1px solid #454B56; ">
    
	<div style=" float:right; width:35%; margin-bottom:20px; margin-right:7px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
			  <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Id</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$PrdList->row()->dealCodeNumber.'</span></td>
              </tr>
              <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Date</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.date("F j, Y g:i a",strtotime($PrdList->row()->created)).'</span></td>
              </tr>
			 
              </table>
        	</div>
		
    <div style="float:left; width:100%;">
	
    <div style="width:49%; float:left; border:1px solid #cccccc; margin-right:10px;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.8%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305;">Shipping Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($shipAddRess->row()->full_name).'</td></tr>
                    <tr><td>Address</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address1).'</td></tr>
					<tr><td>Address 2</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($shipAddRess->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($shipAddRess->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($shipAddRess->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($shipAddRess->row()->postal_code).'</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($shipAddRess->row()->phone).'</td></tr>
            	</table>
            </div>
     </div>
    
    <div style="width:49%; float:left; border:1px solid #cccccc;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.7%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305;">Billing Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($PrdList->row()->full_name).'</td></tr>
                    <tr><td>Address</td><td>:</td><td>'.stripslashes($PrdList->row()->address).'</td></tr>
					<tr><td>Address 2</td><td>:</td><td>'.stripslashes($PrdList->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($PrdList->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($PrdList->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($PrdList->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($PrdList->row()->postal_code).'</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($PrdList->row()->phone_no).'</td></tr>
            	</table>
            </div>
    </div>
</div> 
	   
<div style="float:left; width:100%; margin-right:3%; margin-top:10px; font-size:14px; font-weight:normal; line-height:28px;  font-family:Arial, Helvetica, sans-serif; color:#000; overflow:hidden;">   
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    	<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece; width:99.5%;">
        <tr bgcolor="#f3f3f3">
        	<td width="17%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Bag Items</span></td>
            <td width="43%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Name</span></td>
            <td width="12%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Qty</span></td>
            <td width="14%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Unit Price</span></td>
            <td width="15%" style="text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Sub Total</span></td>
         </tr>';	   
			
$disTotal =0; $grantTotal = 0;
foreach ($PrdList->result() as $cartRow) { $InvImg = @explode(',',$cartRow->image); 
$unitPrice = ($cartRow->price*(0.01*$cartRow->product_tax_cost))+$cartRow->product_shipping_cost+$cartRow->price; 
$uTot = $unitPrice*$cartRow->quantity;
if($cartRow->attr_name != ''){ $atr = '<br>'.$cartRow->attr_name; }elseif($catRow->attribute_values !=''){$atr = '<br>'.$cartRow->attribute_values;}else{ $atr = '';}
$message.='<tr>
            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="'.base_url().PRODUCTPATHTHUMB.$InvImg[0].'" alt="'.stripslashes($cartRow->product_name).'" width="70" /></span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->product_name).$atr.'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.strtoupper($cartRow->quantity).'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($unitPrice,2,'.','').'</span></td>
            <td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($uTot,2,'.','').'</span></td>
        </tr>';
	$grantTotal = $grantTotal + $uTot;
}
	$private_total = $grantTotal - $PrdList->row()->discountAmount;
	$private_total = $private_total + $PrdList->row()->tax  + $PrdList->row()->shippingcost;
				 
$message.='</table></td> </tr><tr><td colspan="3"><table border="0" cellspacing="0" cellpadding="0" style=" margin:10px 0px; width:99.5%;"><tr>
			<td width="460" valign="top" >';
			if($PrdList->row()->note !=''){
$message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"><tr>
                <td width="87" ><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Note:</span></td>
               
            </tr>
			<tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">'.stripslashes($PrdList->row()->note).'</span></td>
            </tr></table>';
			}
			
			if($PrdList->row()->order_gift == 1){
$message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"  style="margin-top:10px;"><tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:16px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">This Order is a gift</span></td>
            </tr></table>';
			}
			
$message.='</td>
            <td width="174" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
            <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Sub Total</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($grantTotal,'2','.','').'</span></td>
            </tr>
			<tr>
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Discount Amount</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->discountAmount,'2','.','').'</span></td>
            </tr>
		<tr bgcolor="#f3f3f3">
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Cost</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->shippingcost,2,'.','').'</span></td>
              </tr>
			  <tr>
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Tax</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->tax ,2,'.','').'</span></td>
              </tr>
			  <tr bgcolor="#f3f3f3">
                <td width="87" style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
                <td width="31"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($private_total,'2','.','').'</span></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        </tr>
    </table>
        </div>
        
        <!--end of left--> 
		<div style="width:50%; float:left;">
            	<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:38px; "><span>'.stripslashes($PrdList->row()->full_name).'</span>,thank you for your purchase.</div>
               <ul style="width:100%; margin:10px 0px 0px 0px; padding:0; list-style:none; float:left; font-size:12px; font-weight:normal; line-height:19px; font-family:Arial, Helvetica, sans-serif; color:#000;">
                    <li>If you have any concerns please contact us.</li>
                    <li>Email: <span>'.stripslashes($this->data['siteContactMail']).' </span></li>
               </ul>
        	</div>
            
            <div style="width:27.4%; margin-right:5px; float:right;">
            
           
            </div>
        
        <div style="clear:both"></div>
        
    </div>
    </div></body></html>';	
		//echo $message;
		//echo '<br>'.$PrdList->row()->email;

		
		if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->config->item('site_contact_mail');
			$sender_name=$this->config->item('email_title');
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}

		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$PrdList->row()->email,
							'cc_mail_id'=>$this->config->item('site_contact_mail'),
							'subject_message'=>$subject,
							'body_messages'=>$message
							);
		$email_send_to_common = $this->product_model->common_email_send($email_values);
		
		
		
		
		//echo $this->email->print_debugger(); die; 
		
		/**********************************************seller Product Confirmation Mail Sent ************************************************/
		
		foreach($SellList->result() as $sellRow){
		
		//echo '<pre>';print_r($sellRow->email);
		$message1 = '';
		$subject1 = 'From: Your '.$this->config->item('email_title').'  Product :: Order Confirmation';
	$message1 = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>Product Order Confirmation</title>
<body>
<div style="width:1012px;background:#FFFFFF; margin:0 auto;">
<div style="width:100%;background:#454B56; float:left; margin:0 auto;">
    <div style="padding:20px 0 10px 15px;float:left; width:50%;"><a href="'.base_url().'" target="_blank" id="logo"><img src="'.base_url().'images/logo/'.$this->data['logo'].'" alt="'.$this->data['WebsiteTitle'].'" title="'.$this->data['WebsiteTitle'].'" width="100"></a></div>
	
</div>			
<!--END OF LOGO-->
    
 <!--start of deal-->
    <div style="width:970px;background:#FFFFFF;float:left; padding:20px; border:1px solid #454B56; ">
    
	<div style=" float:right; width:35%; margin-bottom:20px; margin-right:7px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
			  <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Id</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$PrdList->row()->dealCodeNumber.'</span></td>
              </tr>
              <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Date</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.date("F j, Y g:i a",strtotime($PrdList->row()->created)).'</span></td>
              </tr>
			 
              </table>
        	</div>
		
    <div style="float:left; width:100%;">
	
    <div style="width:49%; float:left; border:1px solid #cccccc; margin-right:10px;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.8%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305;">Shipping Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($shipAddRess->row()->full_name).'</td></tr>
                    <tr><td>Address</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address1).'</td></tr>
					<tr><td>Address 2</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($shipAddRess->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($shipAddRess->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($shipAddRess->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($shipAddRess->row()->postal_code).'</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($shipAddRess->row()->phone).'</td></tr>
            	</table>
            </div>
     </div>
    
    <div style="width:49%; float:left; border:1px solid #cccccc;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.7%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305;">Billing Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($PrdList->row()->full_name).'</td></tr>
                    <tr><td>Address</td><td>:</td><td>'.stripslashes($PrdList->row()->address).'</td></tr>
					<tr><td>Address 2</td><td>:</td><td>'.stripslashes($PrdList->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($PrdList->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($PrdList->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($PrdList->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($PrdList->row()->postal_code).'</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($PrdList->row()->phone_no).'</td></tr>
            	</table>
            </div>
    </div>
</div> 
	   
<div style="float:left; width:100%; margin-right:3%; margin-top:10px; font-size:14px; font-weight:normal; line-height:28px;  font-family:Arial, Helvetica, sans-serif; color:#000; overflow:hidden;">   
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    	<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece; width:99.5%;">
        <tr bgcolor="#f3f3f3">
        	<td width="17%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Bag Items</span></td>
            <td width="43%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Name</span></td>
            <td width="12%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Qty</span></td>
            <td width="14%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Unit Price</span></td>
            <td width="15%" style="text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Sub Total</span></td>
         </tr>';	   
			
$disTotal =0; $grantTotal = 0;
foreach ($PrdList->result() as $cartRow) { 
if($cartRow->sell_id == $sellRow->sell_id ){

$InvImg = @explode(',',$cartRow->image); 
$unitPrice = ($cartRow->price*(0.01*$cartRow->product_tax_cost))+$cartRow->product_shipping_cost+$cartRow->price; 
$uTot = $unitPrice*$cartRow->quantity;
if($cartRow->attr_name != ''){ $atr = '<br>'.$cartRow->attr_name; }elseif($catRow->attribute_values !=''){$atr = '<br>'.$cartRow->attribute_values;}else{ $atr = '';}
$message1.='<tr>
            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="'.base_url().PRODUCTPATHTHUMB.$InvImg[0].'" alt="'.stripslashes($cartRow->product_name).'" width="70" /></span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->product_name).$atr.'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.strtoupper($cartRow->quantity).'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($unitPrice,2,'.','').'</span></td>
            <td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($uTot,2,'.','').'</span></td>
        </tr>';
	$grantTotal = $grantTotal + $uTot;
} }
				 
$message1.='</table></td> </tr><tr><td colspan="3"><table border="0" cellspacing="0" cellpadding="0" style=" margin:10px 0px; width:99.5%;"><tr>
			<td width="460" valign="top" >';
			if($PrdList->row()->note !=''){
$message1.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"><tr>
                <td width="87" ><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Note:</span></td>
               
            </tr>
			<tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">'.stripslashes($PrdList->row()->note).'</span></td>
            </tr></table>';
			}
			
			if($PrdList->row()->order_gift == 1){
$message1.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"  style="margin-top:10px;"><tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:16px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">This Order is a gift</span></td>
            </tr></table>';
			}
			
$message1.='</td>
            <td width="174" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
             <tr bgcolor="#f3f3f3">
                <td width="87" style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
                <td width="31"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($grantTotal,'2','.','').'</span></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        </tr>
    </table>
        </div>
        
        <!--end of left--> 
		<div style="width:50%; float:left;">
            	<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:38px; "><span>'.stripslashes($PrdList->row()->full_name).'</span>,thank you for your purchase.</div>
               <ul style="width:100%; margin:10px 0px 0px 0px; padding:0; list-style:none; float:left; font-size:12px; font-weight:normal; line-height:19px; font-family:Arial, Helvetica, sans-serif; color:#000;">
                    <li>If you have any concerns please contact us.</li>
                    <li>Email: <span>'.stripslashes($this->data['siteContactMail']).' </span></li>
               </ul>
        	</div>
            
            <div style="width:27.4%; margin-right:5px; float:right;">
            
           
            </div>
        
        <div style="clear:both"></div>
        
    </div>
    </div></body></html>';	
	
		
		$email_values1 = array('mail_type'=>'html',
							'from_mail_id'=>$this->config->item('site_contact_mail'),
							'mail_name'=>$this->config->item('email_title'),
							'to_mail_id'=>$sellRow->email,
							'subject_message'=>$subject1,
							'body_messages'=>$message1
							);
						
		$email_send_to_common = $this->product_model->common_email_send($email_values1);
		
	}

	
		return;
	}
	
	
	/********************************************** Send Mail to User to user***********************************************/
	public function SendMailUSersPayment($PrdList,$SellList){
	
	//echo '<pre>';print_r($PrdList->result());
	//echo '<pre>';print_r($SellList->result()); 
	
	$shipAddRess = $this->order_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $PrdList->row()->shippingid ));
	$BillAddRess = $this->order_model->get_all_details(BILLING_ADDRESS,array( 'id' => $PrdList->row()->billingid ));
	
	$enc_dealCodeNumber=strtr($this->encrypt->encode($PrdList->row()->dealCodeNumber), '+/=', '-.~');
	$enc_user_id=strtr($this->encrypt->encode($PrdList->row()->user_id), '+/=', '-.~');
	
	$digital_item = 'Yes';
	foreach($PrdList->result() as $userCartItems){
		if($userCartItems->digital_files == ''){
			$digital_item = 'No';
			break;
		}
	}
	
	
	$subject = 'From: '.$this->config->item('email_title').' Product :: Order Confirmation';
	$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>Product Order Confirmation</title>
<body>
<div style="width:1012px;background:#FFFFFF; margin:0 auto;">
<div style="width:100%;background:#454B56; float:left; margin:0 auto;">
    <div style="padding:20px 0 10px 15px;float:left; width:50%;"><a href="'.base_url().'" target="_blank" id="logo"><img src="'.base_url().'images/logo/'.$this->data['logo'].'" alt="'.$this->data['WebsiteTitle'].'" title="'.$this->data['WebsiteTitle'].'" width="100"></a></div>
	
</div>			
<!--END OF LOGO-->
    
 <!--start of deal-->
    <div style="width:970px;background:#FFFFFF;float:left; padding:20px; border:1px solid #454B56; ">
    
	<div style=" float:right; width:35%; margin-bottom:20px; margin-right:7px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
			  <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Id</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$PrdList->row()->dealCodeNumber.'</span></td>
              </tr>
              <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Date</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.date("F j, Y g:i a",strtotime($PrdList->row()->created)).'</span></td>
              </tr>
			 
              </table>
        	</div>
		
    <div style="float:left; width:100%;">';
	if($shipAddRess->row()->full_name!=''){
		$message.='<div style="width:49%; float:left; border:1px solid #cccccc; margin-right:10px;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.8%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305;">Shipping Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($shipAddRess->row()->full_name).'</td></tr>
                    <tr><td>Address</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address1).'</td></tr>
					<tr><td>Address 2</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($shipAddRess->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($shipAddRess->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($shipAddRess->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($shipAddRess->row()->postal_code).'</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($shipAddRess->row()->phone).'</td></tr>
            	</table>
            </div>
     </div>';
	}else{        
		$message.='<div style="width:49%; float:left; margin-right:10px;">&nbsp;</div>';
	}
	$message.='
    
    
    <div style="width:49%; float:left; border:1px solid #cccccc;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.7%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305;">Billing Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($BillAddRess->row()->full_name).'</td></tr>
                    <tr><td>Address</td><td>:</td><td>'.stripslashes($BillAddRess->row()->address1).'</td></tr>
					<tr><td>Address 2</td><td>:</td><td>'.stripslashes($BillAddRess->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($BillAddRess->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($BillAddRess->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($BillAddRess->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($BillAddRess->row()->postal_code).'</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($BillAddRess->row()->phone).'</td></tr>
            	</table>
            </div>
    </div>
</div> 
	   
<div style="float:left; width:100%; margin-right:3%; margin-top:10px; font-size:14px; font-weight:normal; line-height:28px;  font-family:Arial, Helvetica, sans-serif; color:#000; overflow:hidden;">   
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    	<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece; width:99.5%;">
        <tr bgcolor="#f3f3f3">
        	<td width="17%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Bag Items</span></td>
            <td width="43%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Name</span></td>';
             if($digital_item == 'No'){			
				$message.='<td width="12%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Qty</span></td>';
			}
            $message.='<td width="14%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Unit Price</span></td>
            <td width="15%" style="text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Sub Total</span></td>
         </tr>';	   
			
$disTotal =0; $giftdisTotal =0;  $shipCost = $grantTotal = 0; $digiDownload=0;
foreach ($PrdList->result() as $cartRow) { 

$InvImg = @explode(',',$cartRow->image); 
$unitPrice = $cartRow->price; 
$uTot = $unitPrice*$cartRow->quantity;
if($cartRow->attribute_values != ''){ $atr = '<br>'.$cartRow->attribute_values; }elseif($catRow->attribute_values !=''){$atr = '<br>'.$cartRow->attribute_values; }else{ $atr = '';}
if($cartRow->digital_files != ''){ $digiDownload++; }
$message.='<tr>
            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="'.base_url().PRODUCTPATHTHUMB.$InvImg[0].'" alt="'.stripslashes($cartRow->product_name).'" width="70" /></span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->product_name).$atr.'</span></td>';
             if($digital_item == 'No'){			
				$message.='<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.strtoupper($cartRow->quantity).'</span></td>';			
			}
            $message.='<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($unitPrice * $this->data['currencyValue'],2,'.','').'</span></td>
            <td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($uTot * $this->data['currencyValue'],2,'.','').'</span></td>
        </tr>';
	$grantTotal = $grantTotal + $uTot;
	$shipCost = $shipCost + $cartRow->shippingcost;
}
	$private_total = $grantTotal - $PrdList->row()->discountAmount;
	$private_total = $private_total - $PrdList->row()->giftdiscountAmount; 
	$private_total = $private_total + $PrdList->row()->tax + $shipCost;
				 
$message.='</table></td> </tr><tr><td colspan="3"><table border="0" cellspacing="0" cellpadding="0" style=" margin:10px 0px; width:99.5%;"><tr>
			<td width="460" valign="top" >';

if($PrdList->row()->note !=''){
	$message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"><tr>
                <td width="87" ><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Note:</span></td>
               
            </tr>
			<tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">'.stripslashes($PrdList->row()->note).'</span></td>
            </tr></table>';
}
			
if($PrdList->row()->order_gift == 1){
	$message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"  style="margin-top:10px;"><tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:16px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">This Order is a gift</span></td>
            </tr></table>';
}
			
$message.='</td>
            <td width="174" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
            <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Sub Total</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($grantTotal * $this->data['currencyValue'],'2','.','').'</span></td>
            </tr>';
if($PrdList->row()->discountAmount > 0){			
	$message.='<tr>
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Coupon Discount</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->discountAmount * $this->data['currencyValue'],'2','.','').'</span></td>
            </tr>';
}
if($PrdList->row()->giftdiscountAmount > 0){			
	$message.='<tr>
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Gift Discount</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->giftdiscountAmount * $this->data['currencyValue'],'2','.','').'</span></td>
            </tr>';
}			
if($shipCost > 0){
	$message.='<tr bgcolor="#f3f3f3">
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Cost</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($shipCost * $this->data['currencyValue'],2,'.','').'</span></td>
              </tr>';
}			  
if($PrdList->row()->tax > 0){			  
	$message.='<tr>
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Tax</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->tax * $this->data['currencyValue'] ,2,'.','').'</span></td>
              </tr>';
}			  
$message.='<tr bgcolor="#f3f3f3">
                <td width="87" style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
                <td width="31"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($private_total * $this->data['currencyValue'],'2','.','').'</span></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        </tr>
    </table>
        </div>
        
        <!--end of left--> 
		<div style="width:50%; float:left;">';
		if($digiDownload>0){
				$message.='<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:38px; ">'.$digiDownload.' Products are having the digital files in this order, Click <span><a href="'.base_url().'digital-files/'.$enc_user_id.'/'.$enc_dealCodeNumber.'"> here</a> </span>to download these.</div>';
		}
            	$message.='<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:38px; "><span>'.stripslashes($PrdList->row()->full_name).'</span>,thank you for your purchase.</div>
               <ul style="width:100%; margin:10px 0px 0px 0px; padding:0; list-style:none; float:left; font-size:12px; font-weight:normal; line-height:19px; font-family:Arial, Helvetica, sans-serif; color:#000;">
                    <li>If you have any concerns please contact us.</li>
                    <li>Email: <span>'.stripslashes($SellList->row()->email).' </span></li>
               </ul>
        	</div>
            
            <div style="width:27.4%; margin-right:5px; float:right;">
            
           
            </div>
        
        <div style="clear:both"></div>
        
    </div>
    </div></body></html>';	
		//echo $message;
		//echo '<br>'.$PrdList->row()->email;

		$sender_email=$SellList->row()->email;
		$sender_name=$SellList->row()->user_name;
		
		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$PrdList->row()->email,
							'cc_mail_id'=>$SellList->row()->email,
							'bcc_mail_id'=>$this->config->item('site_contact_mail'),
							'subject_message'=>$subject,
							'body_messages'=>$message
							);
		//echo '<pre>'; print_r($email_values); die;
		
		//$email_send_to_common = $this->order_model->common_email_send($email_values);
		
		return;
	
	}

	/********************************************** Send Mail to Gift***********************************************/	
	public function SendMailUSersGift($GiftRowsVals){

		//echo '<pre>';print_r($GiftRowsVals);	
	foreach($GiftRowsVals->result() as $GiftVals){
	

	
		$subject = 'From: '.$this->config->item('email_title').' Gift Card';

		$message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>Gift Card</title>
			</head>
			<body marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
			<table width="640" border="0" cellspacing="0" cellpadding="0" bgcolor="#7da2c1">
			<tr>
			<td style="padding:40px;">
			<table width="610" border="0" cellpadding="0" cellspacing="0" style="border:#1d4567 1px solid; font-family:Arial, Helvetica, sans-serif;">
				<tr>
				<td>
				<a href="'.base_url().'"><img src="'.base_url().'images/logo/'.$this->data['logo'].'" alt="'.$this->config->item('meta_title').'" style="margin:15px 5px 0; padding:0px; border:none;"></a>
				</td>
				</tr>
				<tr>
				<td valign="top" style="background-color:#FFFFFF;">
				<table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
					<tr>
					<td colspan="2">
					<h3 style="padding:10px 15px; margin:0px; color:#0d487a;">Gift Card for '.ucfirst($this->config->item('email_title')).'</h3>
					</td>
					</tr>
				</table>';
               
				
				$usrDetails = $this->order_model->get_all_details(USERS,array( 'id' => $GiftVals->user_id ));
				

                $message.='	<div style="display:inline-block; float:left; width:100%;">

					<table width="100%" border="0" cellpadding="0" cellspacing="0" style="  font-size:12px; padding-left:15px; font-family:Verdana, Arial, Helvetica, sans-serif;">
                    <tr>
                      <td width="225" style="color:#000000;"><strong>Sender name </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($usrDetails->row()->full_name).'</td>
                    </tr>
                   
                    <tr>
                      <td style="color:#000000;"><strong>Sender Email</strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($usrDetails->row()->email).'</td>
                    </tr>
                   
                    <tr>
                      <td style="color:#000000;"><strong>Gift Code</strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($GiftVals->code).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>Gift Card Amount </strong></td>
                      <td>:</td>';
                     /*  <td style="color:#000000; font-weight:bold;">'.stripslashes($GiftVals->price_value).'</td> */
					  $message.='<td style="color:#000000; font-weight:bold;">'.$this->data['currencySymbol'].number_format($GiftVals->price_value * $this->data['currencyValue'],'2').'</td>
					  
					
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>Gift Card Expired on </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($GiftVals->expiry_date).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>Description</strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($GiftVals->description).'</td>
                    </tr>
                   
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><b>Support Team</b></td>
                    </tr>
                    <tr>
                      <td style="font-size:16px; font-weight:bold; color:#935435;"><strong> '.$this->config->item('email_title').' Team</strong></td>
                    </tr>
                  </table>
</div>

         </div>				
				
					<table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">	
							<tr>
								<td width="50%" valign="top" style="font-size:12px; padding:10px 15px;">
									
								</td>
								<td width="50%" valign="top" style="font-size:12px; padding:10px 15px;">
									<p>
										
									</p>
									<p>
										
									</p>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
			</body>
			</html>';
	
		
		if($GiftVals->recipient_mail != ''){
		
			$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$this->config->item('site_contact_mail'),
							'mail_name'=>$this->config->item('email_title'),
							'to_mail_id'=>$GiftVals->recipient_mail,
							'cc_mail_id'=>$this->config->item('site_contact_mail'),
							'subject_message'=>$subject,
							'body_messages'=>$message
							);
			$email_send_to_common = $this->product_model->common_email_send($email_values);
		}
		
		
		
	}	
		//echo $this->email->print_debugger(); die; 
		return;
	
	}
	
	/********************************************** Send Mail to Subscribe***********************************************/	
	public function SendMailUSersSubscribe($PrdList){

		$subject = 'From: '.$this->config->item('email_title').' Subscription';

		$message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>Gift Card</title>
			</head>
			<body marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
			<table width="640" border="0" cellspacing="0" cellpadding="0" bgcolor="#7da2c1">
			<tr>
			<td style="padding:40px;">
			<table width="610" border="0" cellpadding="0" cellspacing="0" style="border:#1d4567 1px solid; font-family:Arial, Helvetica, sans-serif;">
				<tr>
				<td>
				<a href="'.base_url().'"><img src="'.base_url().'images/logo/'.$this->data['logo'].'" alt="'.$this->config->item('meta_title').'" style="margin:15px 5px 0; padding:0px; border:none;"></a>
				</td>
				</tr>
				<tr>
				<td valign="top" style="background-color:#FFFFFF;">
				<table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
					<tr>
					<td colspan="2">
					<h3 style="padding:10px 15px; margin:0px; color:#0d487a;">Subscription for '.ucfirst($this->config->item('email_title')).'</h3>
					</td>
					</tr>
				</table>';
               
				
                $message.= '<table width="611" border="0" cellpadding="0" cellspacing="0"><tr>
                		    <th width="37%" align="left">Product Title</th>
		                    <th width="30%">Quantity</th>
        		            <th width="33%">Amount</th>
                			</tr>';
                $grantTotal = 0;
                foreach ($PrdList->result() as $cartRow) { 

                $message.= '
                <tr style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#292881; padding: 0px 4px 0px 5px;">
                  <td width="38%">'.stripslashes($cartRow->name).'</td>
                  <td width="23%" align="center">'.strtoupper($cartRow->quantity).'</td>
                  <td width="28%" align="center">'.$this->data['currencySymbol'].$cartRow->indtotal.'</td>
                </tr>
                ';
                	$grantTotal = $grantTotal + $cartRow->indtotal;
                }
                $private_total = $grantTotal;
                $private_total = $private_total + ($private_total * $cartRow->tax * 0.01) + $PrdList->row()->shippingcost;
                $message.='
                <tr>
                  <td>&nbsp;</td>
                </tr>
                ';

                $message.='
                <tr>
                  <td width="30%">&nbsp;</td>
                  <td width="30%" style="font-size:14px; font-weight:bold; color:#000000;"  > Subscription Date</td>
                  <td width="40%" align="left" style="font-size:12px; font-weight:bold; color:#000000;">'.date("F j, Y, g:i a",strtotime($PrdList->row()->created)).'</td>
                </tr>';
				
				$shipAddRess = $this->order_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $PrdList->row()->shippingid ));
				

                $message.='<tr>
                  <td width="30%">&nbsp;</td>
                  <td width="30%" style="font-size:14px; font-weight:bold; color:#000000;" > Tax</td>
                  <td width="40%" align="left" style="font-size:12px; font-weight:bold; color:#000000;">$ '.$PrdList->row()->tax.' </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td width="20%" style="font-size:14px; font-weight:bold; color:#000000;" > Total </td>
                  <td width="28%" align="left" style="font-size:18px; font-weight:bold; color:#000000;">$ '.number_format($private_total+$tax, 2, '.', ' ').'</td>
                </tr>
				</table>
				
<div style="display:inline-block; float:left; width:100%; font-size:12px;">
	<div style="display:inline-block; float:left; width:50%;">

	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr style="border:1px solid #7DA2C1;">
                      <td style=" font:bold 14px/34px Arial, Helvetica, sans-serif;	color:#000;	background:#7DA2C1; border-bottom:1px solid #b6b3b3;">Billing Details</td>
                    </tr>
                  </table>
               
               
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-left:15px; font-family:Verdana, Arial, Helvetica, sans-serif;">
                    <tr>
                      <td width="100" style="color:#000000;"><strong>Full name </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($PrdList->row()->full_name).'</td>
                    </tr>
                   
                    <tr>
                      <td style="color:#000000;"><strong>Address</strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($PrdList->row()->address).'</td>
                    </tr>
                   
                    <tr>
                      <td style="color:#000000;"><strong>Country</strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($PrdList->row()->country).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>State</strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($PrdList->row()->state).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>City </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($PrdList->row()->city).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>postal code </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($PrdList->row()->postal_code).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>Phone </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($PrdList->row()->phone_no).'</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><b>Support Team</b></td>
                    </tr>
                    <tr>
                      <td style="font-size:16px; font-weight:bold; color:#935435;"><strong> '.$this->config->item('email_title').' Team</strong></td>
                    </tr>
                  </table>
</div>
<div style="display:inline-block; float:left; width:50%;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr style="border:1px solid #b6b3b3;">
                      <td style=" font:bold 14px/34px Arial, Helvetica, sans-serif;	color:#000;	background:#7DA2C1; border-bottom:1px solid #b6b3b3;">Shipping Details</td>
                    </tr>
                  </table>
               
               
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-left:15px; font-family:Verdana, Arial, Helvetica, sans-serif;">
                    <tr>
                      <td width="120" style="color:#000000;"><strong>Full name </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($shipAddRess->row()->full_name).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>Address</strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($shipAddRess->row()->address1).'</td>
                    </tr>
                   
                    <tr>
                      <td style="color:#000000;"><strong>Country</strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($shipAddRess->row()->country).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>State/province </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($shipAddRess->row()->state).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>City </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($shipAddRess->row()->city).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>Zip/postal code </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($shipAddRess->row()->postal_code).'</td>
                    </tr>
                    <tr>
                      <td style="color:#000000;"><strong>Phone </strong></td>
                      <td>:</td>
                      <td style="color:#000000; font-weight:bold;">'.stripslashes($shipAddRess->row()->phone).'</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
</div>
</div>
         </div>				
				
					<table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">	
							<tr>
								<td width="50%" valign="top" style="font-size:12px; padding:10px 15px;">
									
								</td>
								<td width="50%" valign="top" style="font-size:12px; padding:10px 15px;">
									<p>
										
									</p>
									<p>
										
									</p>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
			</body>
			</html>';
		echo $message;
		
		
		
		
		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$this->config->item('site_contact_mail'),
							'mail_name'=>$this->config->item('email_title'),
							'to_mail_id'=>$PrdList->row()->email,
							'cc_mail_id'=>$this->config->item('site_contact_mail'),
							'subject_message'=>$subject,
							'body_messages'=>$message
							);
		$email_send_to_common = $this->product_model->common_email_send($email_values);
		
		
	
		return; 
	
	}
	
	public function order_discussion_init($randomId='',$user_id=''){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.seourl as prdurl,pd.image,pd.id as PrdID,pAr.attr_name');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = p.attribute_values','left');				
		$this->db->where('p.dealCodeNumber ="'.$randomId.'"');
		if($user_id!=''){
			$this->db->where('p.user_id',$user_id);
		}
		$PrdList = $this->db->get();
		###echo $this->db->last_query(); die;
		return $PrdList;	
	}
	
	/********************************************** View Orders ***********************************************/
	
	public function view_orders($userid,$randomId){  
	
	$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.image,pd.id as PrdID,pAr.attr_name');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id','left');		
		$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = p.attribute_values','left');				
		$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
		$PrdList = $this->db->get();
	
	$shipAddRess = $this->order_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $PrdList->row()->shippingid ));
	$BillAddRess = $this->order_model->get_all_details(BILLING_ADDRESS,array( 'id' => $PrdList->row()->billingid ));
	
	
	#echo '<pre>'; print_r($PrdList->result()); die;
	$digital_item = 'Yes';
	foreach($PrdList->result() as $userCartItems){
		if($userCartItems->digital_files == ''){
			$digital_item = 'No';
			break;
		}
	}
	
	$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>View Invoice</title>
<body>
<div style="width:1012px;background:#FFFFFF; margin:0 auto;">
<div style="width:100%;background:#454B56; float:left; margin:0 auto;">
    <div style="padding:20px 0 10px 15px;float:left; width:50%;"><a href="'.base_url().'" target="_blank" id="logo"><img src="'.base_url().'images/logo/'.$this->data['logo'].'" alt="'.$this->data['WebsiteTitle'].'" title="'.$this->data['WebsiteTitle'].'" width="100"></a></div>
	
</div>			
<!--END OF LOGO-->
    
 <!--start of deal-->
    <div style="width:970px;background:#FFFFFF;float:left; padding:20px; border:1px solid #454B56; ">
    
	<div style=" float:right; width:35%; margin-bottom:20px; margin-right:7px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
			  <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Id</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$PrdList->row()->dealCodeNumber.'</span></td>
              </tr>
              <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Date</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.date("F j, Y g:i a",strtotime($PrdList->row()->created)).'</span></td>
              </tr>
			 
              </table>
        	</div>
		
    <div style="float:left; width:100%;">';
	
	if($shipAddRess->row()->full_name!=''){
		$message.='<div style="width:49%; float:left; border:1px solid #cccccc; margin-right:10px;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.8%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305;">Shipping Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($shipAddRess->row()->full_name).'</td></tr>
                    <tr><td>Address</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address1).'</td></tr>
					<tr><td>Address 2</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($shipAddRess->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($shipAddRess->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($shipAddRess->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($shipAddRess->row()->postal_code).'</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($shipAddRess->row()->phone).'</td></tr>
            	</table>
            </div>
     </div>';
	}else{
		$message.='<div style="width:49%; float:left; margin-right:10px;">&nbsp;</div>';
	}
	$message.='<div style="width:49%; float:left; border:1px solid #cccccc;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.7%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305;">Billing Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($BillAddRess->row()->full_name).'</td></tr>
                    <tr><td>Address</td><td>:</td><td>'.stripslashes($BillAddRess->row()->address1).'</td></tr>
					<tr><td>Address 2</td><td>:</td><td>'.stripslashes($BillAddRess->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($BillAddRess->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($BillAddRess->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($BillAddRess->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($BillAddRess->row()->postal_code).'</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($BillAddRess->row()->phone).'</td></tr>
            	</table>
            </div>
    </div>
</div>
	   
<div style="float:left; width:100%; margin-right:3%; margin-top:10px; font-size:14px; font-weight:normal; line-height:28px;  font-family:Arial, Helvetica, sans-serif; color:#000; overflow:hidden;">   
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    	<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece; width:99.5%;">
        <tr bgcolor="#f3f3f3">
        	<td width="17%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Bag Items</span></td>
            <td width="43%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Name</span></td>';
			if($digital_item == 'No'){			
				$message.='<td width="12%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Qty</span></td>';
			}
            $message.='<td width="14%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Unit Price</span></td>
            <td width="15%" style="text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Sub Total</span></td>
         </tr>';	   
			
$disTotal =0; $shipCost = $grantTotal = 0;
foreach ($PrdList->result() as $cartRow) { $InvImg = @explode(',',$cartRow->image); 
$unitPrice = $cartRow->price; 
$uTot = $unitPrice*$cartRow->quantity;
if($cartRow->attribute_values != ''){ $atr = '<br>'.$cartRow->attribute_values; }elseif($catRow->attribute_values !=''){$atr = '<br>'.$cartRow->attribute_values; }else{ $atr = '';}
$message.='<tr>
            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="'.base_url().PRODUCTPATHTHUMB.$InvImg[0].'" alt="'.stripslashes($cartRow->product_name).'" width="70" /></span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->product_name).$atr.'</span></td>';
			
			if($digital_item == 'No'){			
				$message.='<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.strtoupper($cartRow->quantity).'</span></td>';			
			}
            $message.='<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($unitPrice * $this->data['currencyValue'],2).'</span></td>
            <td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($uTot * $this->data['currencyValue'],2).'</span></td>
        </tr>';
	$grantTotal = $grantTotal + $uTot;
	$shipCost = $shipCost + $cartRow->shippingcost;
}
	$private_total = $grantTotal - $PrdList->row()->discountAmount;
	$private_total = $private_total - $PrdList->row()->giftdiscountAmount;
	$private_total = $private_total + $PrdList->row()->tax + $shipCost;
				 
$message.='</table></td> </tr><tr><td colspan="3"><table border="0" cellspacing="0" cellpadding="0" style=" margin:10px 0px; width:99.5%;"><tr>
			<td width="460" valign="top" >';
			if($PrdList->row()->note !=''){
$message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"><tr>
                <td width="87" ><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Note:</span></td>
               
            </tr>
			<tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">'.stripslashes($PrdList->row()->note).'</span></td>
            </tr></table>';
			}
			
			if($PrdList->row()->order_gift == 1){
$message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"  style="margin-top:10px;"><tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:16px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">This Order is a gift</span></td>
            </tr></table>';
			}
			
$message.='</td>
            <td width="174" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
            <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Sub Total</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($grantTotal * $this->data['currencyValue'],'2').'</span></td>
            </tr>';
			
			if($PrdList->row()->discountAmount !='0.00'){
			$message.='<tr>
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Coupon Discount</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->discountAmount * $this->data['currencyValue'],'2').'</span></td>
            </tr>';
			}
			
			if($PrdList->row()->giftdiscountAmount !='0.00'){
			$message.='<tr>
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Gift Discount</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->giftdiscountAmount * $this->data['currencyValue'],'2').'</span></td>
            </tr>';
			}
			
		$message.='<tr bgcolor="#f3f3f3">            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Cost</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($shipCost * $this->data['currencyValue'],2).'</span></td>
              </tr>
			  <tr>
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Tax</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->tax * $this->data['currencyValue'],2).'</span></td>
              </tr>
			  <tr bgcolor="#f3f3f3">
                <td width="87" style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
                <td width="31"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($private_total * $this->data['currencyValue'],'2').'</span></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        </tr>
    </table>
        </div>
        
        <!--end of left--> 
		<div style="width:50%; float:left;">
            	<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:38px; "><span>'.stripslashes($PrdList->row()->full_name).'</span>,thank you for your purchase.</div>
               <ul style="width:100%; margin:10px 0px 0px 0px; padding:0; list-style:none; float:left; font-size:12px; font-weight:normal; line-height:19px; font-family:Arial, Helvetica, sans-serif; color:#000;">
                    <li>If you have any concerns please contact us.</li>
                    <li>Email: <span>'.stripslashes($this->data['siteContactMail']).' </span></li>
               </ul>
        	</div>
            
            <div style="width:27.4%; margin-right:5px; float:right;">
            
           
            </div>
        
        <div style="clear:both"></div>
        
    </div>
    </div></body></html>';	
		return $message;
	}	
	/*** To view user order ***/
	public function view_user_orders($userid,$randomId){
	
	$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.image,pd.id as PrdID,s.user_name as seller_name,s.email as seller_email');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(USERS.' as s' , 'p.sell_id = s.id');
		$this->db->join(USER_PRODUCTS.' as pd' , 'pd.id = p.product_id');		
		$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
		$PrdList = $this->db->get();
		
		$shipAddRess = $this->order_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $PrdList->row()->shippingid ));
	$BillAddRess = $this->order_model->get_all_details(BILLING_ADDRESS,array( 'id' => $PrdList->row()->billingid ));
	
	$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>View Invoice</title>
<body>
<div style="width:1012px;background:#FFFFFF; margin:0 auto;">
<div style="width:100%;background:#454B56; float:left; margin:0 auto;">
    <div style="padding:20px 0 10px 15px;float:left; width:50%;"><a href="'.base_url().'" target="_blank" id="logo"><img src="'.base_url().'images/logo/'.$this->data['logo'].'" alt="'.$this->data['WebsiteTitle'].'" title="'.$this->data['WebsiteTitle'].'" width="100"></a></div>
	
</div>			
<!--END OF LOGO-->
    
 <!--start of deal-->
    <div style="width:970px;background:#FFFFFF;float:left; padding:20px; border:1px solid #454B56; ">
    
	<div style=" float:right; width:35%; margin-bottom:20px; margin-right:7px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
			  <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Id</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$PrdList->row()->dealCodeNumber.'</span></td>
              </tr>
              <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Date</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.date("F j, Y g:i a",strtotime($PrdList->row()->created)).'</span></td>
              </tr>
			 
              </table>
        	</div>
		
    <div style="float:left; width:100%;">
	
    <div style="width:49%; float:left; border:1px solid #cccccc; margin-right:10px;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.8%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305;">Shipping Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($shipAddRess->row()->full_name).'</td></tr>
                    <tr><td>Address</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address1).'</td></tr>
					<tr><td>Address 2</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($shipAddRess->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($shipAddRess->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($shipAddRess->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($shipAddRess->row()->postal_code).'</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($shipAddRess->row()->phone).'</td></tr>
            	</table>
            </div>
     </div>
   
   <div style="width:49%; float:left; border:1px solid #cccccc;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.7%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305;">Billing Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($BillAddRess->row()->full_name).'</td></tr>
                    <tr><td>Address</td><td>:</td><td>'.stripslashes($BillAddRess->row()->address1).'</td></tr>
					<tr><td>Address 2</td><td>:</td><td>'.stripslashes($BillAddRess->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($BillAddRess->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($BillAddRess->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($BillAddRess->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($BillAddRess->row()->postal_code).'</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($BillAddRess->row()->phone).'</td></tr>
            	</table>
            </div>
    </div>
</div>
	   
<div style="float:left; width:100%; margin-right:3%; margin-top:10px; font-size:14px; font-weight:normal; line-height:28px;  font-family:Arial, Helvetica, sans-serif; color:#000; overflow:hidden;">   
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    	<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece; width:99.5%;">
        <tr bgcolor="#f3f3f3">
        	<td width="17%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Bag Items</span></td>
            <td width="43%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Name</span></td>
            <td width="12%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Qty</span></td>
            <td width="14%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Unit Price</span></td>
            <td width="15%" style="text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Sub Total</span></td>
         </tr>';	   
			
$disTotal =0; $grantTotal = 0;
foreach ($PrdList->result() as $cartRow) { $InvImg = @explode(',',$cartRow->image); 
$unitPrice = ($cartRow->price*(0.01*$cartRow->product_tax_cost))+$cartRow->product_shipping_cost+$cartRow->price; 
$uTot = $unitPrice*$cartRow->quantity;
if($cartRow->attr_name != ''){ $atr = '<br>'.$cartRow->attr_name;}elseif($catRow->attribute_values !=''){$atr = '<br>'.$cartRow->attribute_values;  }else{ $atr = '';}
$message.='<tr>
            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="'.base_url().PRODUCTPATHTHUMB.$InvImg[0].'" alt="'.stripslashes($cartRow->product_name).'" width="70" /></span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->product_name).$atr.'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.strtoupper($cartRow->quantity).'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($unitPrice,2,'.','').'</span></td>
            <td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($uTot,2,'.','').'</span></td>
        </tr>';
	$grantTotal = $grantTotal + $uTot;
}
	$private_total = $grantTotal - $PrdList->row()->discountAmount;
	$private_total = $private_total - $PrdList->row()->giftdiscountAmount;	
	$private_total = $private_total + $PrdList->row()->tax  + $PrdList->row()->shippingcost;
				 
$message.='</table></td> </tr><tr><td colspan="3"><table border="0" cellspacing="0" cellpadding="0" style=" margin:10px 0px; width:99.5%;"><tr>
			<td width="460" valign="top" >';
			if($PrdList->row()->note !=''){
$message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"><tr>
                <td width="87" ><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Note:</span></td>
               
            </tr>
			<tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">'.stripslashes($PrdList->row()->note).'</span></td>
            </tr></table>';
			}
			
			if($PrdList->row()->order_gift == 1){
$message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"  style="margin-top:10px;"><tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:16px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">This Order is a gift</span></td>
            </tr></table>';
			}
			
$message.='</td>
            <td width="174" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
            <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Sub Total</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($grantTotal,'2','.','').'</span></td>
            </tr>';
			
			if($PrdList->row()->discountAmount !='0.00'){
			$message.='<tr>
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Coupon Discount</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->discountAmount,'2','.','').'</span></td>
            </tr>';
			}
			if($PrdList->row()->giftdiscountAmount !='0.00'){
			$message.='<tr>
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Gift Discount</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->giftdiscountAmount,'2','.','').'</span></td>
            </tr>';
			}
		$message.='<tr bgcolor="#f3f3f3">
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Cost</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->shippingcost,2,'.','').'</span></td>
              </tr>
			  <tr>
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Tax</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->tax ,2,'.','').'</span></td>
              </tr>
			  <tr bgcolor="#f3f3f3">
                <td width="87" style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
                <td width="31"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($private_total,'2','.','').'</span></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        </tr>
    </table>
        </div>
        
        <!--end of left--> 
		<div style="width:50%; float:left;">
            	<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:38px; "><span>'.stripslashes($PrdList->row()->full_name).'</span>,thank you for your purchase.</div>
               <ul style="width:100%; margin:10px 0px 0px 0px; padding:0; list-style:none; float:left; font-size:12px; font-weight:normal; line-height:19px; font-family:Arial, Helvetica, sans-serif; color:#000;">
                    <li>If you have any concerns please contact us.</li>
                    <li>Email: <span>'.stripslashes($PrdList->row()->seller_email).' </span></li>
               </ul>
        	</div>
            
            <div style="width:27.4%; margin-right:5px; float:right;">
            
           
            </div>
        
        <div style="clear:both"></div>
        
    </div>
    </div></body></html>';	
		return $message;
	}	
	/// ****** Cod Payment and email starts *****/////

	public function UserPaymentCOD($userid='', $randomId='' ,$transId = '', $payerMail = ''){
		
		$paymtdata = array(
				'UserrandomNo' => $randomId,
				'shopsy_session_user_id' => $userid,
		);
		$this->session->set_userdata($paymtdata);
		
		$CoupRes = $this->order_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'couponID >' => 0));
		$couponID = $CoupRes->row()->couponID;
		$couponAmont = $CoupRes->row()->discountAmount;
		$couponType = $CoupRes->row()->coupontype;	
		
		
		$GiftCoupRes = $this->order_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'giftcouponID >' => 0));
		$GiftcouponID = $GiftCoupRes->row()->giftcouponID;
		$GiftcouponAmont = $GiftCoupRes->row()->giftdiscountAmount;
		$GiftcouponType = $GiftCoupRes->row()->giftcoupontype;		

	
		// Update Coupon
		if($couponID != 0) {
				$SelCoup = $this->order_model->get_all_details(COUPONCARDS,array( 'id' => $couponID));
				$CountValue = $SelCoup->row()->purchase_count + 1;
				$condition = array( 'id' => $couponID);
				$dataArr = array('purchase_count' => $CountValue);
				$this->order_model->update_details(COUPONCARDS,$dataArr,$condition);
		}
		
		if($GiftcouponID !=0){
				$SelGift = $this->order_model->get_all_details(GIFTCARDS,array( 'id' => $GiftcouponID));
				$GiftCountValue = $SelGift->row()->used_amount + $GiftcouponAmont;
				$condition = array( 'id' => $GiftcouponID);
				$dataArr = array('used_amount' => $GiftCountValue);
				$this->order_model->update_details(GIFTCARDS,$dataArr,$condition);
				if($SelGift->row()->price_value <= $GiftCountValue ){
					
					$condition1 = array( 'id' => $GiftcouponID);
					$dataArr1 = array('card_status' => 'redeemed');
					$this->order_model->update_details(GIFTCARDS,$dataArr1,$condition1);
				}
			
			}

		//Update Payment Table	
			$condition1 = array( 'user_id' => $userid, 'dealCodeNumber' => $randomId);
			if($payerMail != ''){
				$dataArr1 = array('status' => 'Pending','shipping_status' => 'Processed', 'paypal_transaction_id' => $transId, 'payer_email' => $payerMail);			
			}else{
			
				$dataArr1 = array('status' => 'Pending','shipping_status' => 'Processed', 'paypal_transaction_id' => $transId);
			}
			
			$this->order_model->update_details(USER_PAYMENT,$dataArr1,$condition1);
			
			
			$actArr = array('activity'=>"order",
									'activity_id'=>$randomId,
									'user_id'	=>$userid,
									'activity_ip'=>$this->input->ip_address(),
									'created'=>date("Y-m-d H:i:s"));
			$this->user_model->simple_insert(NOTIFICATIONS,$actArr);	

		//Update Quantity
			$SelQty = $this->order_model->get_all_details(USER_PAYMENT,array( 'user_id' => $userid, 'dealCodeNumber' => $randomId));

			foreach($SelQty->result() as $updPrdRow){
			
				$SelPrd = $this->order_model->get_all_details(PRODUCT,array( 'id' => $updPrdRow->product_id ));
				$PrdCount = $SelPrd->row()->purchasedCount + $updPrdRow->quantity;
				$productCount = $SelPrd->row()->quantity - $updPrdRow->quantity;
				$condition2 = array( 'id' => $updPrdRow->product_id );
				$dataArr2 = array('purchasedCount' => $PrdCount,'quantity'=>$productCount);
				//$this->order_model->update_details(PRODUCT,$dataArr2,$condition2);
				
				$this->order_model->update_details(PRODUCT_EN,$dataArr2,$condition2);
				
				$languages = $this->order_model->get_languages_list();
				foreach($languages as $lang){
					$ln = $lang['lang_code'];
					$table = PRODUCT_EN;
					$ln_table = $table."_".$ln;
					$this->order_model->update_details($ln_table,$dataArr2,$condition2);
				}
				
			}
			
			
			//Send Mail to User
			
		$this->db->select('p.*,u.email,u.full_name,u.address,u.address2,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.image,pd.id as PrdID');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
		$PrdList = $this->db->get();
		
		
		
		$this->db->select('email,user_name');
		$this->db->from(USERS);
		$this->db->where('id = "'.$PrdList->row()->sell_id.'" ');
		$SellList = $this->db->get();
		
		$this->db->select('user_name');
		$this->db->from(USERS);
		$this->db->where('id = "'.$PrdList->row()->user_id.'" ');
		$UserInfos = $this->db->get();
		/*Push Message Starts*/
		$message=$UserInfos->row()->user_name.' made an order in your shop on '.$this->config->item('email_title');
		$type='order';
		$this->order_model->sendPushNotification($PrdList->row()->sell_id,$message,$type,array($randomId,$PrdList->row()->user_id));
		/*Push Message Ends*/
		
		$this->SendMailUSersPayment($PrdList,$SellList);
		
		//Empty Cart Info
		$condition3 = array('user_id' => $userid,'sell_id' => $PrdList->row()->sell_id);
		$this->order_model->commonDelete(USER_SHOPPING_CART,$condition3);
		
		$paymtdata = array(	'UserrandomNo' => '');
		$this->session->set_userdata($paymtdata);	
		
		echo 'Pending';
	}
	
	
	
	/// ****** Cod Payment and email ends *****/////
	
	
	// Pay U Success Starts
	public function UserPaymentPayuSuccess($userid='', $randomId='' ,$transId = '', $payerMail = ''){
		
		$paymtdata = array(
				'UserrandomNo' => $randomId,
				'shopsy_session_user_id' => $userid,
		);
		$this->session->set_userdata($paymtdata);
		
		$CoupRes = $this->order_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'couponID >' => 0));
		$couponID = $CoupRes->row()->couponID;
		$couponAmont = $CoupRes->row()->discountAmount;
		$couponType = $CoupRes->row()->coupontype;	
		
		
		$GiftCoupRes = $this->order_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'giftcouponID >' => 0));
		$GiftcouponID = $GiftCoupRes->row()->giftcouponID;
		$GiftcouponAmont = $GiftCoupRes->row()->giftdiscountAmount;
		$GiftcouponType = $GiftCoupRes->row()->giftcoupontype;		

	
		// Update Coupon
		if($couponID != 0) {
				$SelCoup = $this->order_model->get_all_details(COUPONCARDS,array( 'id' => $couponID));
				$CountValue = $SelCoup->row()->purchase_count + 1;
				$condition = array( 'id' => $couponID);
				$dataArr = array('purchase_count' => $CountValue);
				$this->order_model->update_details(COUPONCARDS,$dataArr,$condition);
		}
		
		if($GiftcouponID !=0){
				$SelGift = $this->order_model->get_all_details(GIFTCARDS,array( 'id' => $GiftcouponID));
				$GiftCountValue = $SelGift->row()->used_amount + $GiftcouponAmont;
				$condition = array( 'id' => $GiftcouponID);
				$dataArr = array('used_amount' => $GiftCountValue);
				$this->order_model->update_details(GIFTCARDS,$dataArr,$condition);
				if($SelGift->row()->price_value <= $GiftCountValue ){
					
					$condition1 = array( 'id' => $GiftcouponID);
					$dataArr1 = array('card_status' => 'redeemed');
					$this->order_model->update_details(GIFTCARDS,$dataArr1,$condition1);
				}
			
			}

		//Update Payment Table	
			$condition1 = array( 'user_id' => $userid, 'dealCodeNumber' => $randomId);
			if($payerMail != ''){
				$dataArr1 = array('status' => 'Paid','shipping_status' => 'Processed', 'payu_transcation_id' => $transId, 'payer_email' => $payerMail);			
			}else{
			
				$dataArr1 = array('status' => 'Paid','shipping_status' => 'Processed', 'payu_transcation_id' => $transId);
			}
			
			$this->order_model->update_details(USER_PAYMENT,$dataArr1,$condition1);
			
			$actArr = array('activity'=>"order",
									'activity_id'=>$randomId,
									'user_id'	=>$userid,
									'activity_ip'=>$this->input->ip_address(),
									'created'=>date("Y-m-d H:i:s"));
			$this->user_model->simple_insert(NOTIFICATIONS,$actArr);	

		//Update Quantity
			$SelQty = $this->order_model->get_all_details(USER_PAYMENT,array( 'user_id' => $userid, 'dealCodeNumber' => $randomId));

			foreach($SelQty->result() as $updPrdRow){
			
				$SelPrd = $this->order_model->get_all_details(PRODUCT,array( 'id' => $updPrdRow->product_id ));
				$PrdCount = $SelPrd->row()->purchasedCount + $updPrdRow->quantity;
				$productCount = $SelPrd->row()->quantity - $updPrdRow->quantity;
				$condition2 = array( 'id' => $updPrdRow->product_id );
				$dataArr2 = array('purchasedCount' => $PrdCount,'quantity'=>$productCount);
				//$this->order_model->update_details(PRODUCT,$dataArr2,$condition2);
				
				$this->order_model->update_details(PRODUCT_EN,$dataArr2,$condition2);
				
				$languages = $this->order_model->get_languages_list();
				foreach($languages as $lang){
					$ln = $lang['lang_code'];
					$table = PRODUCT_EN;
					$ln_table = $table."_".$ln;
					$this->order_model->update_details($ln_table,$dataArr2,$condition2);
				}
			}
			
			
			//Send Mail to User
			
		$this->db->select('p.*,u.email,u.full_name,u.address,u.address2,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.image,pd.id as PrdID');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
		$PrdList = $this->db->get();
		
		
		
		$this->db->select('email,user_name');
		$this->db->from(USERS);
		$this->db->where('id = "'.$PrdList->row()->sell_id.'" ');
		$SellList = $this->db->get();
		
		$this->db->select('user_name');
		$this->db->from(USERS);
		$this->db->where('id = "'.$PrdList->row()->user_id.'" ');
		$UserInfos = $this->db->get();
		/*Push Message Starts*/
		$message=$UserInfos->row()->user_name.' made an order in your shop on '.$this->config->item('email_title');
		$type='order';
		$this->order_model->sendPushNotification($PrdList->row()->sell_id,$message,$type,array($randomId,$PrdList->row()->user_id));
		/*Push Message Ends*/
		
		$this->SendMailUSersPayment($PrdList,$SellList);
		
		//Empty Cart Info
		$condition3 = array('user_id' => $userid,'sell_id' => $PrdList->row()->sell_id);
		$this->order_model->commonDelete(USER_SHOPPING_CART,$condition3);
		
		$paymtdata = array(	'UserrandomNo' => '');
		$this->session->set_userdata($paymtdata);	
		
		echo 'Success';
	}
		// Pay U Success Ends
	public function MobilePaymentSuccess($userid='', $randomId='' ,$transId = '', $payerMail = ''){
		
		
		$CoupRes = $this->order_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'couponID >' => 0));
		$couponID = $CoupRes->row()->couponID;
		$couponAmont = $CoupRes->row()->discountAmount;
		$couponType = $CoupRes->row()->coupontype;	
		
		
		$GiftCoupRes = $this->order_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'giftcouponID >' => 0));
		$GiftcouponID = $GiftCoupRes->row()->giftcouponID;
		$GiftcouponAmont = $GiftCoupRes->row()->giftdiscountAmount;
		$GiftcouponType = $GiftCoupRes->row()->giftcoupontype;		

	
		// Update Coupon
		if($couponID != 0) {
				$SelCoup = $this->order_model->get_all_details(COUPONCARDS,array( 'id' => $couponID));
				$CountValue = $SelCoup->row()->purchase_count + 1;
				$condition = array( 'id' => $couponID);
				$dataArr = array('purchase_count' => $CountValue);
				$this->order_model->update_details(COUPONCARDS,$dataArr,$condition);
		}
		
		if($GiftcouponID !=0){
				$SelGift = $this->order_model->get_all_details(GIFTCARDS,array( 'id' => $GiftcouponID));
				$GiftCountValue = $SelGift->row()->used_amount + $GiftcouponAmont;
				$condition = array( 'id' => $GiftcouponID);
				$dataArr = array('used_amount' => $GiftCountValue);
				$this->order_model->update_details(GIFTCARDS,$dataArr,$condition);
				if($SelGift->row()->price_value <= $GiftCountValue ){
					
					$condition1 = array( 'id' => $GiftcouponID);
					$dataArr1 = array('card_status' => 'redeemed');
					$this->order_model->update_details(GIFTCARDS,$dataArr1,$condition1);
				}
			
			}

		//Update Payment Table	
			$condition1 = array( 'user_id' => $userid, 'dealCodeNumber' => $randomId);
			if($payerMail != ''){
				$dataArr1 = array('status' => 'Paid','shipping_status' => 'Processed', 'paypal_transaction_id' => $transId, 'payer_email' => $payerMail);			
			}else{
			
				$dataArr1 = array('status' => 'Paid','shipping_status' => 'Processed', 'paypal_transaction_id' => $transId);
			}
			
			$this->order_model->update_details(USER_PAYMENT,$dataArr1,$condition1);
			$actArr = array('activity'=>"order",
									'activity_id'=>$randomId,
									'user_id'	=>$userid,
									'activity_ip'=>$this->input->ip_address(),
									'created'=>date("Y-m-d H:i:s"));
			$this->user_model->simple_insert(NOTIFICATIONS,$actArr);	

		//Update Quantity
			$SelQty = $this->order_model->get_all_details(USER_PAYMENT,array( 'user_id' => $userid, 'dealCodeNumber' => $randomId));

			foreach($SelQty->result() as $updPrdRow){
			
				$SelPrd = $this->order_model->get_all_details(PRODUCT,array( 'id' => $updPrdRow->product_id ));
				$PrdCount = $SelPrd->row()->purchasedCount + $updPrdRow->quantity;
				$productCount = $SelPrd->row()->quantity - $updPrdRow->quantity;
				$condition2 = array( 'id' => $updPrdRow->product_id );
				$dataArr2 = array('purchasedCount' => $PrdCount,'quantity'=>$productCount);
				//$this->order_model->update_details(PRODUCT,$dataArr2,$condition2);
				
				$this->order_model->update_details(PRODUCT_EN,$dataArr2,$condition2);
				
				$languages = $this->order_model->get_languages_list();
				foreach($languages as $lang){
					$ln = $lang['lang_code'];
					$table = PRODUCT_EN;
					$ln_table = $table."_".$ln;
					$this->order_model->update_details($ln_table,$dataArr2,$condition2);
				}
			}
			
			
			//Send Mail to User
			
		$this->db->select('p.*,u.email,u.full_name,u.address,u.address2,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.image,pd.id as PrdID');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
		$PrdList = $this->db->get();
		
		
		$this->db->select('email,user_name');
		$this->db->from(USERS);
		$this->db->where('id = "'.$PrdList->row()->sell_id.'" ');
		$SellList = $this->db->get();
		
		$this->db->select('user_name');
		$this->db->from(USERS);
		$this->db->where('id = "'.$PrdList->row()->user_id.'" ');
		$UserInfos = $this->db->get();
		/*Push Message Starts*/
		$message=$UserInfos->row()->user_name.' made an order in your shop on '.$this->config->item('email_title');
		$type='order';
	
		$this->order_model->sendPushNotification($PrdList->row()->sell_id,$message,$type,array($randomId,$PrdList->row()->user_id));
		/*Push Message Ends*/
		
		$this->SendMailUSersPayment($PrdList,$SellList);
		
		//Empty Cart Info
		$condition3 = array('user_id' => $userid,'sell_id' => $PrdList->row()->sell_id);
		$this->order_model->commonDelete(USER_SHOPPING_CART,$condition3);
		
		return 'Success';
	}
}

?>