<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Cart extends MY_Controller { 
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('cart_model');
		$this->load->model('admin_model');
		$this->load->library('user_agent');
		$this->data['loginCheck'] = $this->checkLogin('U');
		//$this->data['MiniCartViewSet'] = $this->cart_model->mini_cart_view($this->data['common_user_id']); 
		
		define("PaypalIDDetails",$this->config->item('payment_0'));
		define("API_LOGINIDDetails",$this->config->item('payment_1'));
		define("API_PayuDetails",$this->config->item('payment_2'));
		define("StripeDetails",$this->config->item('payment_3'));
		define("TwoCheckoutDetails",$this->config->item('payment_4'));
		define("BrainTree",$this->config->item('payment_5'));
		define("PesapalDetails",$this->config->item('payment_6'));
		//define("PaypalAdaptDetails",$this->config->item('payment_6'));
	    //define("Pay_On",$this->config->item('payment_7'));
		define("WiretransferDetails",$this->config->item('payment_7'));
		define("Western_union_details",$this->config->item('payment_8'));
		//print_r(Western_union_details);die;
    }
    
  
	/**
	 * 
	 * Loading Cart Page
	 */
	
	public function index(){
		//if ($this->data['loginCheck'] != ''){
			$uid=$this->session->userdata['shopsy_session_user_id'];
			$this->data['user_id'] = $uid;
			$this->data['buyer_commission'] = $this->admin_model->getAdminSettings()->row()->buyer_commission;
			$this->data['meta_title'] = $this->data['heading'] = 'Cart'; 
			$this->data['cartViewResults'] = $this->cart_model->mani_cart_view($this->data['common_user_id']);
			$this->data['relatedPersons'] =$relatedPersons= $this->cart_model->relatedPurchases($this->data['common_user_id']);
			$relatedPurchasesPrd = array();
			foreach($relatedPersons as $neighbours){
				$relatedPurchasesPrd[$neighbours->neighbourId]=$this->product_model->get_all_details(USER_PAYMENT,array('user_id'=>$neighbours->neighbourId))->result_array();
			}
			foreach($relatedPurchasesPrd as $neighboursprd){
				foreach($neighboursprd as $products){
					$condition = " where p.status='Publish' and p.id=".$products['product_id']." or p.status='Publish' and p.id=".$products['product_id']." group by p.id order by p.created desc";
				$relatedPurchases[]=$this->product_model->view_product_details($condition)->row();
				}
			}
			/*Remove the duplication products*/
			$newPrdArr[]=$relatedPurchases[0]->id;
			$newrelatedPurchases[$relatedPurchases[0]->id]=$relatedPurchases[0];
			$j=0;$l=1;
			for($k=1;$k<count($relatedPurchases);$k++){
				if(!in_array($relatedPurchases[$k]->id,$newPrdArr)){
					$j++;$l++;
					$newPrdArr[]=$relatedPurchases[$k]->id;
					$newrelatedPurchases[$relatedPurchases[$k]->id]=$relatedPurchases[$k];
				}
			}
			 
			foreach($relatedPersons as $neighbours){
				unset($newrelatedPurchases[$neighbours->productId]);
			}
			if(!empty($relatedPersons))
			$this->data['relatedPurchases'] = $newrelatedPurchases;
			
		 	$this->load->view('site/cart/cart.php',$this->data);
		/*}else{
			redirect('login');
		}*/	
	} 
	public function makeFeatrue()
	{
		//print_r($this->input->post());die;
		$this->data['p_seo']=$this->uri->segment(4);
		#echo $this->data['p_seo'];die;
		$this->data['product_feature']=$this->product_model->get_all_details(FEATURE_PRODUCT,array('product_seo'=>$this->data['p_seo']))->result_array();
		$this->data['feature_list']=$this->product_model->get_all_details(FEATURE_PACK,array('status'=>'Active'))->result();
		$this->load->view('site/cart/pay_feature',$this->data);
	}
	public function proceed2pay(){	
		//echo "<pre>";print_r($this->input->post());die;
		$this->data['p_seo']=$this->input->post('product_seourl');
		$packagedet=$this->product_model->get_all_details(FEATURE_PACK,array('id'=>$this->input->post('pack_id')));			
		$expire= date('Y-m-d', strtotime($this->input->post('eventDate').' +'.$packagedet->row()->days.'day'));			
		$no_slots=0;
		if($this->input->post('Page') == 'home'){
			$slot_dates=$this->product_model->get_feature_poducts(date("Y-m-d", strtotime($this->input->post('eventDate'))),$expire);
			$no_slots= $slot_dates->num_rows();
		}
	/* 	echo $this->db->last_query();
		echo "<pre>";print_r($slot_dates->result());
		echo $no_slots;die; */
		if($no_slots < 3 ){
			$this->data['packid']=$this->input->post('pack_id');
			$this->data['gateway']=$this->input->post('gateway');
			$this->data['Page']=$this->input->post('Page');
			$this->data['eventDate']=$this->input->post('eventDate');
			
			if($this->data['packid'] != "" && $this->data['gateway'] != "" && $this->data['Page'] != "" && $this->data['eventDate'] != ""  ){
				$package_det=$this->product_model->get_all_details(FEATURE_PACK,array('id'=>$this->data['packid']));
				$this->data['product_seourl']=$this->input->post('product_seourl');
				//echo $this->db->last_query();die;
				
				$this->data['countryList'] = $this->product_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')));
				$this->data['amount']=$package_det->row()->amount;
				$this->data['days']=$days=$package_det->row()->days." days";
				$this->data['end_day1']= date('Y-m-d',strtotime($days));
				#echo "<br>".$this->data['end_day1'];die;
				$this->load->view('site/checkout/pay_feature',$this->data);
			}else{
				$this->setErrorMessage('error','Please Select the required field');
				redirect('site/cart/makeFeatrue/'.$this->data['p_seo']);
			}
		}else{
			$this->setErrorMessage('error','Slot Not Available');
			redirect('site/cart/makeFeatrue/'.$this->data['p_seo']);
		}
		
	}
	public function proceed2unfeature(){
		$seo=$this->input->post('product_seourl');
		$this->product_model->update_details(PRODUCT,array('product_featured'=>'No'),array('seourl'=>$seo));
		$this->product_model->commonDelete(FEATURE_PRODUCT,array('product_seo'=>$seo));		
		$this->setErrorMessage('success','Product Successfully Unfeatured');
		redirect('shop/managelistings');
	}
	/** 
	 * 
	 * Insert the product to cart
	 *
	 */
	public function insertEditCart(){
	
		$excludeArr = array('addtocart');
		$dataArrVal = array();
		foreach($this->input->post() as $key => $val){
			if(!(in_array($key,$excludeArr))){
				$dataArrVal[$key] = trim(addslashes($val));
			}
		}

		$datestring = "%Y-%m-%d 23:59:59";
		$code = $this->get_rand_str('10');
		$exp_days = $this->config->item('cart_expiry_days');

		$dataArry_data = array('expiry_date' => mdate($datestring,strtotime($exp_days.' days')), 'code' => $code,'user_id' => $this->data['common_user_id']);
		$dataArr = array_merge($dataArrVal,$dataArry_data);
		
		$condition ='';
		
		$this->cart_model->commonInsertUpdate(GIFTCARDS_TEMP,'insert',$excludeArr,$dataArr,$condition);
		
		if ($this->checkLogin('U') != ''){
		if($this->lang->line('giftcart_added') != '') { $giftcart_added= stripslashes($this->lang->line('giftcart_added')); } else { $giftcart_added = "Giftcard Added You Cart successfully"; }
			$this->setErrorMessage('success',$giftcart_added);
			redirect('gift-cards');
	 	}else{
			redirect('login');
		}
	}
	
	/** 
	 * 
	 * Product add to Cart function 
	 *
	 */
	public function cartadd(){
		
		$excludeArr = array('addtocart','attr_color','mqty','attribute_values');
		$dataArrVal = array();
		$mqty = $this->input->post('mqty');
		foreach($this->input->post() as $key => $val){
			if(!(in_array($key,$excludeArr))){
				$dataArrVal[$key] = trim(addslashes($val));
			}
		}

		$datestring = date('Y-m-d H:i:s',now());
		$indTotal = ( $this->input->post('price') + $this->input->post('product_shipping_cost') + ($this->input->post('price') * 0.01 * $this->input->post('product_tax_cost')) ) * $this->input->post('quantity');
		if($this->input->post('attribute_values') != ''){
			$attVals = @implode('|-|',$this->input->post('attribute_values'));
		}else{
			$attVals = '';
		}
		$dataArry_data = array('created' => $datestring, 'user_id' => $this->data['common_user_id'], 'indtotal' => $indTotal, 'total' => $indTotal, 'attribute_values' => $attVals);
		$dataArr = array_merge($dataArrVal,$dataArry_data);
		
		$condition ='';
		
		
		$this->data['productVal'] = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $this->data['common_user_id'],'product_id' => $this->input->post('product_id'),'attribute_values' => $attVals));	
		
		//echo '<pre>'; print_r($this->data['productVal']); die;
		
		if($this->data['productVal']->num_rows > 0){
			$newQty = $this->data['productVal']->row()->quantity + $this->input->post('quantity');
			if ($newQty <= $mqty){
				$indTotal = ( $this->input->post('price') + $this->input->post('product_shipping_cost') + ($this->input->post('price') * 0.01 * $this->input->post('product_tax_cost')) ) * $newQty ; 
				$dataArr = array('quantity' => $newQty, 'indtotal' => $indTotal, 'total' => $indTotal);
				$condition =array('id' => $this->data['productVal']->row()->id);
				$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
			}else{
				echo 'Error|'.$this->data['productVal']->row()->quantity; die;
			}
		}else{
			$this->cart_model->commonInsertUpdate(SHOPPING_CART,'insert',$excludeArr,$dataArr,$condition);
		}
		
		
		echo 'Success|'.$this->cart_model->mini_cart_view($this->data['common_user_id']); 
		
			
	}
	
	/** 
	 * 
	 * User product add to Cart function
	 *
	 */
	
	public function usercartadd(){
	#print_r($this->input->post()); #die;
	
		$digital_files = $this->input->post('digital_files');
		$excludeArr = array('mqty');
		$dataArrVal = array();
		$mqty = $this->input->post('mqty');
		foreach($this->input->post() as $key => $val){
			if(!(in_array($key,$excludeArr))){
				$dataArrVal[$key] = trim(addslashes($val));
			}
		}
		$collection = $this->cart_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $this->data['common_user_id']));
		if($collection->num_rows()>0){
			foreach($collection->result() as $_collection){
				$data = array('prod_collection'=>'No');
				$this->cart_model->update_details(USER_SHOPPING_CART,$data,array('id'=>$_collection->id));
			}
		}
		$datestring = date('Y-m-d H:i:s',now());
		$indTotal = ( $this->input->post('price') * $this->input->post('quantity') );
		$pickup = $this->input->post('pickup_option');
		if($pickup =='collection'){
			$shippadd = 'Yes';
		}else{
			$shippadd = 'No';
		}
			$order_type = 'Normal';
		$auction_id = $this->input->post('auction_id');
		$datestring = date('Y-m-d H:i:s',now());
		$dataArry_data = array('created' => $datestring, 'user_id' => $this->data['common_user_id'], 'indtotal' => $indTotal, 'total' => $indTotal,'pickup_option'=>$pickup,'prod_collection'=>'No','shipping'=> $shippadd,'order_type' => $order_type,'auction_id' => $auction_id);
		$dataArr = array_merge($dataArrVal,$dataArry_data);
		$condition ='';
		//echo"<pre>";print_r($dataArr);die;
		
		
		$this->data['productVal'] = $this->cart_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $this->data['common_user_id'],'product_id' => $this->input->post('product_id'),'attribute_values' => $this->input->post('attribute_values')));	
		
		if($this->data['productVal']->num_rows > 0){
			
			if($digital_files==''){
				$newQty = $this->data['productVal']->row()->quantity + $this->input->post('quantity');
				if ($newQty <= $mqty){
					$indTotal = $this->input->post('price') * $newQty ; 
					#echo $indTotal;
					$dataArr = array('quantity' => $newQty, 'indtotal' => $indTotal, 'total' => $indTotal);
					$condition =array('id' => $this->data['productVal']->row()->id);
					$this->cart_model->update_details(USER_SHOPPING_CART,$dataArr,$condition); 
					#echo $this->db->last_query();die;
				}else{
					echo 'Error|'.$this->data['productVal']->row()->quantity; die;
				} 	
			}else{
				echo 'Error|Digital Product Already added in your cart.'; die;
			}			
			
		}else{
                    
			$this->cart_model->simple_insert(USER_SHOPPING_CART,$dataArr);
			
		}
		$CheckCollOnly = $this->cart_model->get_all_details(USER_SHOPPING_CART,array('user_id'=>$this->data['common_user_id']));
		$CollOnly = array();
		if($CheckCollOnly->num_rows()>0){
			foreach($CheckCollOnly->result() as $Collection){
				$CollOnly []= $Collection->pickup_option;
			}
		}
		if((in_array('delivery-collecion', $CollOnly)) && (in_array('collection', $CollOnly))){
			$dataArrShip = array('product_shipping_cost' => 0,'shipping_cost' => 0,'shipping'=>'Yes','tax'=>0,'prod_collection'=> 'Yes');
		}elseif(in_array('delivery', $CollOnly)){
			$dataArrShip = array('shipping'=>'No','tax'=>0);
		}elseif((in_array('delivery-collecion', $CollOnly)) && (in_array('delivery', $CollOnly))){
			$dataArrShip = array('shipping'=>'No','tax'=>0);
		}elseif((!in_array('delivery-collecion', $CollOnly)) && (!in_array('delivery', $CollOnly))){
			$dataArrShip = array('product_shipping_cost' => 0,'shipping_cost' => 0,'shipping'=>'Yes','tax'=>0,'prod_collection'=> 'Yes');
		}else{
			$dataArrShip = array('shipping'=>'No','tax'=>0);
		}
		$this->cart_model->update_details(USER_SHOPPING_CART,$dataArrShip,array('user_id'=>$this->data['common_user_id']));
		//if ( $this->checkLogin('U')!= ''){
			echo 'Success|'.$this->cart_model->mini_cart_view($this->data['common_user_id']); 
		//}else{
		//	echo 'login|lgoin';
		//}	
	}
	
	
	/** 
	 * 
	 * Cart Ajax Update function
	 *
	 */
	public function ajaxUpdate(){
		$excludeArr = array('id','qty','updval');
	
		$productVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $this->data['common_user_id'],'id' => $this->input->post('updval')));	
		
		$newQty = $this->input->post('qty');
		$indTotal = ( $productVal->row()->price + $productVal->row()->product_shipping_cost + ($productVal->row()->price * 0.01 * $productVal->row()->product_tax_cost) ) * $newQty ;
			
		$dataArr = array('quantity' => $newQty, 'indtotal' => $indTotal, 'total' => $indTotal);
		$condition =array('id' => $productVal->row()->id);
		$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition);
		
		echo number_format($indTotal,2,'.','').'|'.$this->data['CartVal'] = $this->cart_model->mani_cart_total($this->data['common_user_id']); 
		
		return;
	}
	
	/** 
	 * 
	 * User Cart Ajax Update function
	 *
	 */
	public function ajaxUserUpdate(){
		$excludeArr = array('id','qty','updval','selid');
		
		$productVal = $this->cart_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $this->data['common_user_id'],'id' => $this->input->post('updval')));	
		
		$newQty = $this->input->post('qty');
		$indTotal = $productVal->row()->price * $newQty ;
		$shipcost = $productVal->row()->product_shipping_cost * $newQty ;
			
		$dataArr = array('quantity' => $newQty, 'indtotal' => $indTotal, 'shipping_cost' => $shipcost, 'total' => $indTotal);
		$condition =array('id' => $productVal->row()->id);
		$this->cart_model->update_details(USER_SHOPPING_CART,$dataArr,$condition);
		
		echo number_format($indTotal,2,'.','').'|'.$this->data['CartVal'] = $this->cart_model->mani_user_cart_total($this->data['common_user_id'],$this->input->post('selid')); 
		
		return;
	}
	
	/** 
	 * 
	 * Cart Ajax Delete function
	 *
	 */
	public function ajaxDelete(){
	
		$delt_id = $this->input->post('curval'); 
		$CondID = $this->input->post('cart'); 
		if($CondID =='gift'){		
			$this->db->delete(GIFTCARDS_TEMP, array('id' => $delt_id)); 
			echo $this->data['GiftVal'] = $this->cart_model->mani_gift_total($this->data['common_user_id']);
		}elseif($CondID =='subscribe'){		
			$this->db->delete(FANCYYBOX_TEMP, array('id' => $delt_id)); 
			echo $this->data['SubscribeVal'] = $this->cart_model->mani_subcribe_total($this->data['common_user_id']);			
		}elseif($CondID == 'cart'){
			$this->db->delete(SHOPPING_CART, array('id' => $delt_id)); 
			echo $this->data['CartVal'] = $this->cart_model->mani_cart_total($this->data['common_user_id']);
		}elseif($CondID == 'usercart'){
			$seller_id = $this->input->post('sellId');
			$this->db->delete(USER_SHOPPING_CART, array('id' => $delt_id,'order_type'=>'Normal')); 
			
			$shopId = 'shopId-'.$seller_id;
			$this->session->unset_userdata($shopId, '');
			$shopCounty = 'ShopCountry-'.$seller_id;
			$this->session->unset_userdata($shopCounty, '');
			$this->cart_model->Check_Code_Val_Remove($this->data['common_user_id'],$seller_id);
			
		    $remove_product=addslashes(af_lg('lg_remove product from cart','Product Removed From Your Cart successfully')); 
			 
			$this->setErrorMessage('success',$remove_product);	
			
			echo $this->data['UserCartVal'] = $this->cart_model->mani_user_cart_total($this->data['common_user_id'],$seller_id);
		}

		return;
	}
	
	/** 
	 * 
	 * Coupon code Check function
	 *
	 */
	public function checkCode(){
	
		$Code = $this->input->post('code');
		//echo $Code;die;
		$amount = $this->input->post('amount'); 
		$shipamount = $this->input->post('shipamount'); 
		$sellerId = $this->input->post('seller_id'); 
		
		echo $this->cart_model->Check_Code_Val($Code,$amount,$shipamount,$sellerId,$this->data['common_user_id']);
		if($this->lang->line('copuncode_applied') != '') { $copuncode_applied= stripslashes($this->lang->line('copuncode_applied')); } else { $copuncode_applied = "Coupon Code Applied Successfully"; }
		
		$this->setErrorMessage('success',$copuncode_applied);

		return;
	
	}
	
	/** 
	 * 
	 * Contact Shop Owner Check product popup function
	 *
	 */
	public function contactshopowner(){
	
		$productid = $this->input->post('product_id'); 
		$sellerId = $this->input->post('seller_id'); 
		
		$productVal = $this->cart_model->get_all_details(PRODUCT,array( 'id' => $productid));	
		$sellerVal = $this->cart_model->get_all_details(USERS,array( 'id' => $sellerId));
		$sellerBusinessVal = $this->cart_model->get_all_details(SELLER,array( 'seller_id' => $sellerId));	
		$UserVal = $this->cart_model->get_all_details(USERS,array( 'id' => $this->data['common_user_id']));	
		
		
		if($UserVal->row()->thumbnail !=''){
			$srcVal = 'images/users/'.$UserVal->row()->thumbnail;
		}else{
			$srcVal = 'images/default_avat.png';
		}
		
		
		$popupVal = '<form name="contactshopowener" id="contactshopowener" method="post" action="site/cart/cartcontactshopowner">
			<div class="conversation">
				<div class="conversation_container">
					<h2 class="conversation_headline">New conversation with '.ucfirst($sellerVal->row()->full_name).' from '.ucfirst($sellerBusinessVal->row()->seller_businessname).'</h2>
					<div class="conversation_thumb"><img width="75" height="75" src="'.$srcVal.'"></div>
					<div class="conversation_right">
					
						<input class="conversation-subject" type="text" name="subject" placeholder="Subject" value="'.$productVal->row()->product_name.'">
						<textarea class="conversation-textarea" rows="11" name="message_text" placeholder="Message text">Listing: '.base_url().'products/'.$productVal->row()->seourl.'</textarea>
						<input type="hidden" name="productid" id="productid" value="'.$productVal->row()->id.'" >
						<input type="hidden" name="productname" id="productname" value="'.$productVal->row()->product_name.'" >
						<input type="hidden" name="username" id="username" value="'.$UserVal->row()->full_name.'" >
						<input type="hidden" name="useremail" id="useremail" value="'.$UserVal->row()->email.'" >
						<input type="hidden" name="userid" id="userid" value="'.$UserVal->row()->id.'" >
						<input type="hidden" name="selleremail" id="selleremail" value="'.$sellerVal->row()->email.'" >
						<input type="hidden" name="sellerid" id="sellerid" value="'.$sellerVal->row()->id.'" >
						<input type="hidden" name="subject_name" id="subject_name" value="New conversation with '.ucfirst($sellerVal->row()->full_name).' from '.ucfirst($sellerBusinessVal->row()->seller_businessname).'">
		
  				</div> 
    			</div>
				<div class="modal-footer footer_tab_footer">
							<div class="btn-group">
									<input class="submit_btn" type="submit" value="send" />
									<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel">Cancel</a>
							</div>
					</div>	
			    </div>	</form>		';
		echo $popupVal;		
		
		return;
	
	}
	
	/** 
	 * 
	 * Contact Shop Owner send mail function 
	 *
	 */
	public function cartcontactshopowner(){
		
		$dataArr = array('username'=>$this->input->post('username'),'useremail'=>$this->input->post('useremail'),'user_id'=>$this->input->post('userid'),'selleremail'=>$this->input->post('selleremail'),'sellerid'=>$this->input->post('sellerid'),'product_id'=>$this->input->post('productid'),'product_name'=>$this->input->post('productname'),'description'=>$this->input->post('message_text'));
		$this->cart_model->simple_insert(CONTACTSELLER,$dataArr);
		
		$tid=time();
		
		$dataArry = array('sender_email'=>$this->input->post('useremail'),'sender_id'=>$this->input->post('userid'),'receiver_email'=>$this->input->post('selleremail'),'receiver_id'=>$this->input->post('sellerid'),'subject'=>$this->input->post('subject'),'message'=>$this->input->post('message_text'),'dataAdded'=>date('Y-m-d H:i:s'),'tid'=>$tid);
		$this->user_model->simple_insert(CONTACTPEOPLE,$dataArry);
		
		$actArr = array('activity'=>"message",
								'activity_id'=>$this->input->post('sellerid'),
								'user_id'	=>$this->input->post('userid'),
								'activity_ip'=>$this->input->ip_address(),
								'created'=>date("Y-m-d H:i:s"),
								'comment_id'=>$tid);
		$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
		
		
		$productName = $this->input->post('productname');
		$userrname = $this->input->post('username');
		$description = $this->input->post('message_text');
		$email = $this->input->post('selleremail');
		
		$newsid='15';
		$template_values=$this->cart_model->get_newsletter_template_details($newsid);
		
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
		extract($adminnewstemplateArr);
		//$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
		
		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		
		$message .= '</body>
			</html>';
		
		if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->data['siteContactMail'];
			$sender_name=$this->data['siteTitle'];
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}

		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$email,
							'subject_message'=>$template_values['news_subject'],
							'body_messages'=>$message
							);
		//echo '<pre>'; print_r($email_values); die;
		$email_send_to_common = $this->cart_model->common_email_send($email_values);
		
		
		
		 if($this->lang->line('shop_owner_mail_sent') != '') { $shop_owner_mail_sent = stripslashes($this->lang->line('shop_owner_mail_sent')); } else { $shop_owner_mail_sent = 'Contact Shop Owner Mail Sent Successfully.'; }
		
		$this->setErrorMessage('success',$shop_owner_mail_sent);
		redirect('cart');
			
	}
	
	/** 
	 * 
	 * Coupon Code Remove function 
	 *
	 */
	public function checkCodeRemove(){
		$sellerId = $this->input->post('seller_id');
		$this->cart_model->Check_Code_Val_Remove($this->data['common_user_id'],$sellerId);
		echo $this->data['CartVal'] = $this->cart_model->mani_cart_coupon_sucess($this->data['common_user_id']); 
		if($this->lang->line('copuncode_remove') != '') { $copuncode_remove= stripslashes($this->lang->line('copuncode_remove')); } else { $copuncode_remove = "Coupon Code Removed Successfully"; }
		$this->setErrorMessage('success',$copuncode_remove);
		return;
	
	}
	
	/** 
	 * 
	 * Sellect Cart Remove function
	 *
	 */
	public function SellerCartRemove(){
		$sellerId = $this->input->post('seller_id');
		
		$shopId = 'shopId-'.$sellerId;
		$this->session->unset_userdata($shopId, '');
		$shopCounty = 'ShopCountry-'.$sellerId;
		$this->session->unset_userdata($shopCounty, '');
		
		$this->db->delete(USER_SHOPPING_CART, array('sell_id' => $sellerId));
	
if($this->lang->line('product_remove_from_cart') != '') { $product_remove_from_cart= stripslashes($this->lang->line('product_remove_from_cart')); } else { $product_remove_from_cart = "Shop Product Removed From Your Cart Successfully"; }	
		$this->setErrorMessage('success',$product_remove_from_cart);
		return;	
	}
	
	/** 
	 * 
	 * Sellect Gift Cart Remove function
	 *
	 */
	public function giftcardCartRemove(){
		$sellerId = $this->input->post('user_id');
		
		$this->db->delete(GIFTCARDS_TEMP, array('user_id' => $sellerId)); 
		if($this->lang->line('gift_card_removed') != '') { $gift_card_removed= stripslashes($this->lang->line('gift_card_removed')); } else { $gift_card_removed = "GiftCard Removed Your Cart Successfully"; }
		$this->setErrorMessage('success',$gift_card_removed);
		return;
	
	}
	
	/** 
	 * 
	 * Coupon Code Success function
	 *
	 */
	public function checkCodeSuccess(){
		echo $this->data['CartVal'] = $this->cart_model->mani_cart_coupon_sucess($this->data['common_user_id']); 
	}
	
	/** 
	 * 
	 * Ajax Change address for cart page function  
	 *
	 */
	public function ajaxChangeAddress(){

		if($this->input->post('add_id') != ''){
			$ChangeAdds =  $this->cart_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $this->data['common_user_id'],'id' => $this->input->post('add_id')));
			
			$ShipCostVal = $this->cart_model->get_all_details(COUNTRY_LIST,array( 'country_code' => $ChangeAdds->row()->country));	
			$MainShipCost = number_format($ShipCostVal->row()->shipping_cost,2,'.','');
			$MainTaxCost = number_format(($this->input->post('amt') * 0.01 * $ShipCostVal->row()->shipping_tax),2,'.','');
			$TotalAmts = number_format(( ($this->input->post('amt') + $MainShipCost + $MainTaxCost) - $this->input->post('disamt')),2,'.','');
			
			$condition = array('user_id' => $this->data['common_user_id']);
			$dataArr2 = array('shipping_cost' => $MainShipCost, 'tax' => $ShipCostVal->row()->shipping_tax);
			$this->cart_model->update_details(SHOPPING_CART,$dataArr2,$condition); 
			
			echo $Chg_Adds = $MainShipCost.'|'.$MainTaxCost.'|'.$ShipCostVal->row()->shipping_tax.'|'.$TotalAmts.'|'.$ChangeAdds -> row() -> full_name.'<br>'.$ChangeAdds -> row() -> address1.'<br>'.$ChangeAdds -> row() -> city.' '.$ChangeAdds -> row() -> state.' '.$ChangeAdds -> row() -> postal_code.'<br>'.$ChangeAdds -> row() -> country.'<br>'.$ChangeAdds -> row() -> phone;		
			
		}else{
			echo '0';
		}
	}

	/** 
	 * 
	 * User Ajax Change address for cart page function  
	 *
	 */	
	public function ajaxUserChangeAddress(){
		
		#echo '<pre>'; print_r($_POST); die;

		if($this->input->post('add_id') != ''){
			$shopId = 'shopId-'.$this->input->post('seller_id');
			//print_r($this->input->post('add_id'));
			$this->session->unset_userdata($shopId, '');
			$this->session->set_userdata($shopId,$this->input->post('add_id'));
			$ChangeAdds =  $this->cart_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $this->data['common_user_id'],'id' => $this->input->post('add_id')));
			
			$shopCounty = 'ShopCountry-'.$this->input->post('seller_id');
			$this->session->unset_userdata($shopCounty, '');
			$this->session->set_userdata($shopCounty,$ChangeAdds->row()->country);
			#print_r($shopCounty);die;
			$this->db->select("*");
			$this->db->where(array("seller_id"=>$this->input->post('seller_id'),"state_name"=>$ChangeAdds->row()->state));
			$this->db->from(SELLER_TAX);
			$TaxList=$this->db->get();
			
			//echo $this->db->last_query();die;
			//echo '<pre>'; print_r($TaxList->result());die;
			if($TaxList->row()->tax_amount > 0){
				$ths->data['taxAmt'] = $TaxList->row()->tax_amount;
			}else{
				$ths->data['taxAmt'] = 0;
			}
			
		$ProductVal = $this->cart_model->get_all_details(USER_SHOPPING_CART,array( 'sell_id' => $this->input->post('seller_id'), 'user_id' => $this->data['common_user_id']),array(array('field'=>'id','type'=>'Asc')));	
		
		$s=0;
		foreach($ProductVal->result_array() as $prodtVal){	$shipCost = $shipCost1 = 0;
			$SubShipVal = $this->cart_model->get_all_details(SUB_SHIPPING,array( 'product_id' => $prodtVal['product_id'],'ship_name' => $ChangeAdds->row()->country), array(array('field'=>'ship_id','type'=>'Desc')));
			if($SubShipVal->num_rows() > 0){
				if($s==0){
					$shipCost = $SubShipVal->row()->ship_cost;
				}else{
					$shipCost = $SubShipVal->row()->ship_other_cost;
				}

				$newshipCost = number_format( ($prodtVal['quantity'] * $shipCost),2,'.','');
				$conditionShip = array('id' => $prodtVal['id']);
				$dataArrShip = array('product_shipping_cost' => $shipCost,'shipping_cost' => $newshipCost,'shipping'=>'Yes','tax'=>$taxAmt);
				//echo '<pre>Ord'; print_r($dataArrShip);
				$this->cart_model->update_details(USER_SHOPPING_CART,$dataArrShip,$conditionShip); 
				
				$s++;	
			}else{
				$SubShipValNew = $this->cart_model->get_all_details(SUB_SHIPPING,array( 'product_id' => $prodtVal['product_id'],'ship_name' => 'Everywhere Else'), array(array('field'=>'ship_id','type'=>'Desc')));
				//echo '<pre>'; print_r($SubShipValNew->result_array()); 
				if($SubShipValNew->num_rows() > 0){
					if($s==0){
						$shipCost1 = $SubShipValNew->row()->ship_cost;
					}else{
						$shipCost1 = $SubShipValNew->row()->ship_other_cost;
					}
					$newshipCost1 = number_format( ($prodtVal['quantity'] * $shipCost1),2,'.','');
					$conditionShip1 = array('id' => $prodtVal['id']);
					$dataArrShip1 = array('product_shipping_cost' => $shipCost1,'shipping_cost' => $newshipCost1,'shipping'=>'Yes','tax'=>$taxAmt);	
					//echo '<pre>Every'; print_r($dataArrShip1);
					$this->cart_model->update_details(USER_SHOPPING_CART,$dataArrShip1,$conditionShip1); 
					//echo $this->db->last_query();
					$s++;	
				}else{
						
						$conditionShip1 = array('id' => $prodtVal['id']);
						$dataArrShip1 = array('product_shipping_cost' => '0.00','shipping_cost' => '0.00','shipping'=>'No','tax'=>'0.00');	
						//echo '<pre>Every'; print_r($dataArrShip1);
						$this->cart_model->update_details(USER_SHOPPING_CART,$dataArrShip1,$conditionShip1); 
				}
				
			}
					
		}
			//echo '<pre>'; print_r($ProductVal->result_array()); die;
				//foreach($ProductVal->result_array() as $prodtVal){
		/*$SubShipVal = $this->cart_model->get_all_details(SUB_SHIPPING,array( 'product_id' => $ProductVal->row()->product_id), array(array('field'=>'ship_id','type'=>'Desc')));
			//echo '<pre>'; print_r($SubShipVal->result_array()); die;
				
				$shipCost = $shipOtherCost = 0;
				if($SubShipVal->num_rows() > 0){
					if($SubShipVal->row()->ship_id == '232'){
						$shipCost = $SubShipVal->row()->ship_cost;
						$shipOtherCost = $SubShipVal->row()->ship_other_cost;
					}else{
						$shipCost = $shipOtherCost = 'No-Shipping';
					}
					foreach($SubShipVal->result_array() as $shipSubVal){
						if($ChangeAdds->row()->country == $shipSubVal['ship_name']){
							$shipCost = $SubShipVal->row()->ship_cost;
							$shipOtherCost = $SubShipVal->row()->ship_other_cost;
						}
					}
				}
			//}
			
			if($shipCost > 0){
				//echo '<pre>'; print_r($ProductVal->result_array());
				foreach($ProductVal->result_array() as $prodtVal){
					if($ProductVal->row()->id == $prodtVal['id']){
						$newshipCost = number_format($prodtVal['quantity'] * $shipCost,2,'.','');
						$conditionShip = array('id' => $prodtVal['id']);
						$dataArrShip = array('product_shipping_cost' => $shipCost,'shipping_cost' => $newshipCost,'shipping'=>'Yes');
						$this->cart_model->update_details(USER_SHOPPING_CART,$dataArrShip,$conditionShip); 
						//echo $this->db->last_query();
					}else{
						$newshipCost = number_format($prodtVal['quantity'] * $shipOtherCost,2,'.','');
						$conditionShip = array('id' => $prodtVal['id']);
						$dataArrShip = array('product_shipping_cost' => $shipOtherCost,'shipping_cost' => $newshipCost,'shipping'=>'Yes' );
						$this->cart_model->update_details(USER_SHOPPING_CART,$dataArrShip,$conditionShip); 
						//echo $this->db->last_query();					
					}
				}
			}*/
			
			/*$ShipCostVal = $this->cart_model->get_all_details(COUNTRY_LIST,array( 'country_code' => $ChangeAdds->row()->country));	
			$MainShipCost = number_format($ShipCostVal->row()->shipping_cost,2,'.','');
			$MainTaxCost = number_format(($this->input->post('amt') * 0.01 * $ShipCostVal->row()->shipping_tax),2,'.','');
			$TotalAmts = number_format(($this->input->post('amt') + $MainShipCost + $MainTaxCost),2,'.','');
			
			$condition = array('user_id' => $this->data['common_user_id']);
			$dataArr2 = array('shipping_cost' => $MainShipCost, 'tax' => $ShipCostVal->row()->shipping_tax);
			$this->cart_model->update_details(USER_SHOPPING_CART,$dataArr2,$condition); */
			
			//echo $Chg_Adds = $MainShipCost.'|'.$MainTaxCost.'|'.$ShipCostVal->row()->shipping_tax.'|'.$TotalAmts.'|'.$ChangeAdds -> row() -> full_name.'<br>'.$ChangeAdds -> row() -> address1.'<br>'.$ChangeAdds -> row() -> city.' '.$ChangeAdds -> row() -> state.' '.$ChangeAdds -> row() -> postal_code.'<br>'.$ChangeAdds -> row() -> country.'<br>'.$ChangeAdds -> row() -> phone;		
			echo '1';
		}else{
			echo '0';
		}
	}
	
	
	/** 
	 * 
	 * Ajax Subscribe address for cart page function
	 *
	 */	
	public function ajaxSubscribeAddress(){

		if($this->input->post('add_id') != ''){
			$ChangeAdds =  $this->cart_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $this->data['common_user_id'],'id' => $this->input->post('add_id')));
			
			$ShipCostVal = $this->cart_model->get_all_details(COUNTRY_LIST,array( 'country_code' => $ChangeAdds->row()->country));	
			$MainShipCost = number_format($ShipCostVal->row()->shipping_cost,2,'.','');
			$MainTaxCost = number_format(($this->input->post('amt') * 0.01 * $ShipCostVal->row()->shipping_tax),2,'.','');
			$TotalAmts = number_format(($this->input->post('amt') + $MainShipCost + $MainTaxCost),2,'.','');
			
			
			echo $Chg_Adds = $MainShipCost.'|'.$MainTaxCost.'|'.$ShipCostVal->row()->shipping_tax.'|'.$TotalAmts.'|'.$ChangeAdds -> row() -> full_name.'<br>'.$ChangeAdds -> row() -> address1.'<br>'.$ChangeAdds -> row() -> city.' '.$ChangeAdds -> row() -> state.' '.$ChangeAdds -> row() -> postal_code.'<br>'.$ChangeAdds -> row() -> country.'<br>'.$ChangeAdds -> row() -> phone;		
			
			
		}else{
			echo '0';
		}
	}
	
	/** 
	 * 
	 * Ajax Delete address for cart page function
	 *
	 */	
	public function ajaxDeleteAddress(){
    	if ($this->checkLogin('U')==''){
    		redirect('login');
    	}else {
    		$delID = $this->input->post('del_ID'); 
    		$checkAddrCount = $this->cart_model->get_all_details(SHIPPING_ADDRESS,array('id' => $delID ,'primary'=>'Yes' ));
			
    		if ($checkAddrCount->num_rows == 0){
    			$this->cart_model->commonDelete(SHIPPING_ADDRESS,array('id' => $delID));
				echo '0';
    		}else{
				echo '1';
			}
    	}
    }
		
	/** 
	 * 
	 * Ajax Delete address for user shipping address page
	 *
	 */
	public function ajaxDeleteAddress_account(){
		$delID = $this->uri->segment(4);

		
    	if ($this->checkLogin('U')==''){
    		redirect('login');
    	}else {
    		$checkAddrCount = $this->cart_model->get_all_details(SHIPPING_ADDRESS,array('id' => $delID ,'primary'=>'Yes' ));
			
    		if ($checkAddrCount->num_rows == 0){
    			$this->cart_model->commonDelete(SHIPPING_ADDRESS,array('id' => $delID));
				//$str = $this->db->last_query();
				//echo '0';
				if($this->lang->line('shipp_add_del') != '') { $shipp_add_del= stripslashes($this->lang->line('shipp_add_del')); } else { $shipp_add_del = "Shipping address deleted successfully"; }
				$this->setErrorMessage('success',$shipp_add_del);	
				  redirect('settings/shipping');
    		}else{
						//echo '1';
						if($this->lang->line('default_add_dnt_del') != '') { $default_add_dnt_del= stripslashes($this->lang->line('default_add_dnt_del')); } else { $default_add_dnt_del = "Default address don`t be deleted."; }
					$this->setErrorMessage('error',$default_add_dnt_del);	
				  redirect('settings/shipping');
				
			}
    	}
    }
	
	/** 
	 * 
	 * Shipping address Insert for cart page function  
	 *
	 */	
	public function insert_shipping_address(){
    	if ($this->checkLogin('U')==''){
    		redirect('login');
    	}else {
    		$is_default = $this->input->post('set_default');
    		if ($is_default == ''){
    			$primary = 'No';
    		}else{
    			$primary = 'Yes';
    		}
    		$checkAddrCount = $this->cart_model->get_all_details(SHIPPING_ADDRESS,array('user_id'=>$this->checkLogin('U')));
    		if ($checkAddrCount->num_rows == 0){
    			$primary = 'Yes';
    		}
    		$excludeArr = array('ship_id','set_default');
    		$dataArr = array('primary'=>$primary);
    		
    		
    			$this->cart_model->commonInsertUpdate(SHIPPING_ADDRESS,'insert',$excludeArr,$dataArr,$condition);
    			$shipID = $this->cart_model->get_last_insert_id();
    			if($this->lang->line('add_shipping_add_succ') != '') { $add_shipping_add_succ= stripslashes($this->lang->line('add_shipping_add_succ')); } else { $add_shipping_add_succ = "Shipping address added successfully"; }
    			$this->setErrorMessage('success',$add_shipping_add_succ);
    		
    		if ($primary == 'Yes'){
	    		$condition = array('id !='=>$shipID,'user_id'=>$this->checkLogin('U'));
    			$dataArr = array('primary'=>'No');
    			$this->cart_model->update_details(SHIPPING_ADDRESS,$dataArr,$condition);
    		}
    		redirect('cart');
    	}
    }
	
	/** 
	 * 
	 * Cart Checkout function  
	 *
	 */	
	public function cartcheckout(){
		if($this->input->post('Ship_address_val') !=''){
		
			$userid = $this->checkLogin('U');
			$this->cart_model->addPaymentCart($userid);
			redirect("checkout/cart");
		}else{
			if($this->lang->line('add_shipping_add') != '') { $add_shipping_add= stripslashes($this->lang->line('add_shipping_add')); } else { $add_shipping_add = "Please Add the Shipping address"; }
			$this->setErrorMessage('error',$add_shipping_add);		
			redirect("cart");
		}	
	}
	
	/** 
	 * 
	 * User Cart Checkout function
	 *
	 */		
	public function usercartcheckout(){
if ($this->checkLogin('U')==''){
$this->setErrorMessage('error', 'Login Required');
redirect("login");
}

		$sellerId = $this->input->post('sell_id');
		// $quantity = $this->input->post('userquantity0');
		$userid = $this->checkLogin('U');
		if($this->input->post('digital_item') == 'No'){

			$cartDetails = $this->cart_model->get_all_details(USER_SHOPPING_CART,array('sell_id' => $sellerId, 'user_id' => $userid));
			$checkArr = array();
			foreach($cartDetails->result() as $_collection){
				$checkArr []= $_collection->pickup_option;
			}
			if((in_array('collection', $checkArr)) && (in_array('delivery', $checkArr))){
				$this->setErrorMessage('error','You cannot have a mix of Delivery Only and Collection Only products from the same store in a basket');		
				redirect("cart");
			}elseif($this->input->post('pickup_option') == 'checked'){
				if($this->input->post('payment_value')!=''){
					$this->cart_model->addPaymentUserCart($userid,$this->data['currencyValue']);
					redirect("checkout/sellercart");
				}else{
					$this->setErrorMessage('error','Please Select the Payment Method');		
					redirect("cart");
				}
			}
			elseif ($this->input->post('pickup_station')!= ''){
				if($this->input->post('payment_value')!=''){
					$this->cart_model->addPaymentUserCart($userid,$this->data['currencyValue']);
          			// push notification of item pickup
					if ($cartDetails->num_rows() > 0){						
						$checkArr = array();
						foreach($cartDetails->result() as $_collection){

							$pid = $_collection->product_id;
							$pickup_time = $_collection->pickup_date;
							$actArr = array(
								'activity_name'	=>	'pickup item',
								'activity_id'	=>  $pid,	
								'user_id'		=>	$this->checkLogin('U'),
								'activity_time'		=>time(),
								'activity_ip'	=>	$this->input->ip_address()
							);
							$checkProductStatus = $this->user_model->get_all_details(USER_ACTIVITY,array('activity_id'=>$pid,'user_id'=>$this->checkLogin('U')));
							if ($checkProductStatus->num_rows() < 1){
							$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
							}
							else
							{
								$this->user_model->commonDelete(USER_ACTIVITY,array('activity_id'=>$pid,'user_id'=>$this->checkLogin('U')));
								$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
							}
							
							$this->user_model->commonDelete(NOTIFICATIONS,array('activity'=>'pickup item','activity_id'=>$pid,'user_id'=>$this->checkLogin('U')));
							$this->user_model->commonDelete(NOTIFICATIONS,array('activity'=>'cancel pickup item','activity_id'=>$pid,'user_id'=>$this->checkLogin('U')));
							$actArr = array('activity'=>'pickup item',
													'activity_id'=>$pid,
													'user_id'	=>$userid,
													'activity_ip'=>$this->input->ip_address(),
													'created'=>date("Y-m-d H:i:s"));
							$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
							
							// $dataArr = array('likes'=>$likes);
							// $condition = array('id'=>$pid);
							// $this->user_model->update_details(PRODUCT,$dataArr,$condition);					
							$returnStr['status_code'] = 1;
							$shopid = $sellerId;

							/*Push Message Starts*/
							$message=$this->session->userdata('shopsy_session_user_name').' want to pick up your item on '.$this->config->item('email_title');
							$type='pickup item';
							$this->sendPushNotification($shopid,$message,$type,array($pid));

							$message='You will pick up your item on '.$this->config->item('email_title');
							$type='pickup item';
							$this->sendPushNotification($this->checkLogin('U'),$message,$type,array($pid));
							/*Push Message Ends*/	
							// $sent_email=$this->user_model->get_all_details(users,array('id'=>$shopid));//,'like'=>'yes'));
							// $noty_email_arr=explode(',',$sent_email->row()->notification_email);
							// if(in_array('like',$noty_email_arr)){													
							// 	$full_name=$sent_email->row()->full_name;
							// 	#echo "<pre>";print_r($this->data['userdetails']);die;
							// 	$user_name=$this->data['userdetails']->row()->full_name;
							// 	$product_seo=$productdetails->row()->seourl;
								
							// 	$newsid='29';
								
							// 	$template_values=$this->user_model->get_newsletter_template_details($newsid);

							// 	$adminnewstemplatearr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'meta_title'=>$this->config->item('meta_title'));
							// 	extract($adminnewstemplatearr);
							// 	$subject = 'from: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
							// 	$message .= '<!doctype html>
							// 		<html>
							// 		<head>
							// 		<meta http-equiv="content-type" content="text/html; charset=utf-8">
							// 		<meta name="viewport" content="width=device-width"/>
							// 		<title>'.$template_values['news_subject'].'</title>
							// 		<body>';
							// 	include('./newsletter/registeration'.$newsid.'.php');	
								
							// 	$message .= '</body>
							// 		</html>';
									

							// 	if($template_values['sender_name']=='' && $template_values['sender_email']==''){
							// 		$sender_email=$this->config->item('site_contact_mail');
									
							// 		$sender_name=$this->config->item('email_title');
							// 	}else{
							// 		$sender_name=$template_values['sender_name'];
							// 		$sender_email=$template_values['sender_email'];
							// 	}
							// 	$email_values = array('mail_type'=>'html',
							// 						'from_mail_id'=>$sender_email,
							// 						'mail_name'=>$sender_name,
							// 						'to_mail_id'=>$sent_email->row()->email,
							// 						'subject_message'=>'favourite',
							// 						'body_messages'=>$message
							// 					);
													
							// 	//echo '<pre>'; print_r($email_values); die;

							// 	$email_send_to_common = $this->product_model->common_email_send($email_values);#die;
							// }

						}
					}
					redirect("checkout/sellercart");
				}else{
					$this->setErrorMessage('error','Please Select the Payment Method');		
					redirect("cart");
				}
			}elseif($this->input->post('Ship_address_val') !='' ){
				if($this->input->post('payment_value')!=''){  
					$userid = $this->checkLogin('U');
					$this->cart_model->addPaymentUserCart($userid,$this->data['currencyValue']);
					$shopid="shopId-".$this->input->post('sell_id');
					$this->session->set_userdata($shopid,"");
					redirect("checkout/sellercart");
				}else{
					if($this->lang->line('sel_payment_method') != '') {
						$sel_payment_method= stripslashes($this->lang->line('sel_payment_method'));
					} else { 
						$sel_payment_method = "Please Select the Payment Method"; 
					}
					$this->setErrorMessage('error',$sel_payment_method);
					redirect("cart");
				}
			}else{			
				if($this->lang->line('add_shipping_add') != '') { $add_shipping_add= stripslashes($this->lang->line('add_shipping_add')); } else { $add_shipping_add = "Please Add the Shipping address"; }
				$this->setErrorMessage('error',$add_shipping_add);	
				redirect("cart");
			}
		}else{
			if($this->input->post('payment_value')!=''){  
				$userid = $this->checkLogin('U');
				$this->data['sell_id']=$this->input->post('sell_id');
				$this->cart_model->addPaymentUserCart($userid,$this->data['currencyValue']);
				redirect("checkout/sellercart");
			}else{
				if($this->lang->line('sel_payment_method') != '') { $sel_payment_method= stripslashes($this->lang->line('sel_payment_method')); } else { $sel_payment_method = "Please Select the Payment Method"; }
				$this->setErrorMessage('error',$sel_payment_method);		
				redirect("cart");
			}
		}
		
	}
	
	/** 
	 * 
	 * Subscribe Checkout function
	 *
	 */	
	public function Subscribecheckout(){
		if($this->input->post('SubShip_address_val') !=''){
			$userid = $this->checkLogin('U');
			$this->cart_model->addPaymentSubscribe($userid);
			redirect("checkout/subscribe");
		}else{
		 if($this->lang->line('add_shipping_add') != '') { $add_shipping_add= stripslashes($this->lang->line('add_shipping_add')); } else { $add_shipping_add = "Please Add the Shipping address"; }
			$this->setErrorMessage('error',$add_shipping_add);		
			redirect("cart");
		}	
	}
	public function localpickup(){
		$value =  $this->input->post('value');
		$sellerId = $this->input->post('seller_id');
		$userId = $this->data['common_user_id'];
		$ProductVal = $this->cart_model->get_all_details(USER_SHOPPING_CART,array( 'sell_id' => $sellerId, 'user_id' => $userId),array(array('field'=>'id','type'=>'Asc')));
		if($ProductVal->num_rows()>0){
			foreach($ProductVal->result_array() as $prodtVal){
				$shipCost = 0;
				$newshipCost = 0;
				$conditionShip = array('id' => $prodtVal['id']);
				if($value == 'Yes'){
					$dataArrShip = array('product_shipping_cost' => 0,'shipping_cost' => $newshipCost,'shipping'=>'Yes','tax'=>0,'prod_collection'=> $value);
				}else{
					$shopId = 'shopId-'.$sellerId;
					$this->session->unset_userdata($shopId,'');
					$dataArrShip = array('product_shipping_cost' => 0,'shipping_cost' => $newshipCost,'shipping'=>'No','tax'=>0,'prod_collection'=> $value);
				}
			 $this->cart_model->update_details(USER_SHOPPING_CART,$dataArrShip,$conditionShip);
			}
			$returnArr['success'] = 'success';
		}else{
			$returnArr['error'] = 'error';
		}
		
		echo json_encode($returnArr);
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/site/user.php */
