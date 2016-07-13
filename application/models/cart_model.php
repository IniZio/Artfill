<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to Cart Page
 * @author Teamtweaks
 *
 */
class Cart_model extends My_Model
{
	/**
	* function to add value to cart
	* Param Array new data to add
	*/
	public function add_cart($dataArr=''){
			$this->db->insert(PRODUCT,$dataArr);
	}
	/**
	* function to edit cart
	* Param Array new data to add
	* Param String condition 
	*/
	public function edit_cart($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(PRODUCT,$dataArr);
	}
	/**
	* function to view cart
	* Param String condition 
	*/
	public function view_cart($condition=''){
			return $this->db->get_where(PRODUCT,$condition);
			
	}
		
	/******************** Cart Page View Function  ********************/
	public function mani_cart_view($userid=''){
		//print_r($this->session);die;
		$countryList = $this->cart_model->get_all_details(COUNTRY_LIST,array());
		//echo "<pre>"; print_r($countryList); die;
		$cart_page_url = $this->uri->segment(1);
		
		$MainShipCost = 0;
		$MainTaxCost = 0; $cartQty = 0; $usercartQty = 0;
		
		$paypalDetailsVal = unserialize(PaypalIDDetails);
		$authorizeDetailsVal = unserialize(API_LOGINIDDetails);
		$payAdptDetailsVal = unserialize(API_PayuDetails);
		$StripeDetailsVAl = unserialize(StripeDetails);
        $twocheckoutDetailsVal = unserialize(TwoCheckoutDetails);
		$braintreeDetailsVal = unserialize(BrainTree);
		$pesapalDetail = unserialize(PesapalDetails);
	    $WiretransferDetails = unserialize(WiretransferDetails);
		$Western_union_details=unserialize(Western_union_details);
		//print_r($payAdptDetailsVal);die;
	 // print_r($WiretransferDetails);die;
                //$payonDetail = unserialize(Pay_On);
		
		
		$PaypalVal = unserialize($paypalDetailsVal['settings']);
		$AuthorizesVal = unserialize($authorizeDetailsVal['settings']);
		$paypalAdptVal = unserialize($payAdptDetailsVal['settings']);
		$StripeVal = unserialize($StripeDetailsVAl['settings']);
		$twocheckoutvalue = unserialize($twocheckoutDetailsVal['settings']);
		$braintreevalue = unserialize($braintreeDetailsVal['settings']);
		$pesapalValue = unserialize($pesapalDetail['settings']);
		$wiretransferval=unserialize($WiretransferDetails['settings']);
		$westernunionval=unserialize($Western_union_details['settings']);
		//$payonValue = unserialize($payonDetail['settings']);
//	print_r($paypalAdptVal);die;

		$shipVal = $this->cart_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userid));
		//echo '<pre>'; print_r($shipVal->result());
		///echo $this->db->last_query();die;
		/******************** If Shipping address is not empty, update the shipping,tax values in cart,usercart,subscribe Function  ********************/		
			
		
		
		
		/*if($shipVal -> num_rows() >0 ){
		
			$shipValID = $this->cart_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userid, 'primary' => 'Yes'));				
			$ShipCostVal = $this->cart_model->get_all_details(COUNTRY_LIST,array( 'country_code' => $shipValID->row()->country));
			
			$MainShipCost = $ShipCostVal->row()->shipping_cost;
			$MainTaxCost = $ShipCostVal->row()->shipping_tax;
			$dataArr2 = array('shipping_cost' => $MainShipCost, 'tax' => $MainTaxCost);
			$dataArr = array('shipping_id' => $shipValID->row()->id,'shipping_cost' => $MainShipCost, 'tax' => $MainTaxCost);
			$condition = array('user_id' => $userid);
														
			$this->cart_model->update_details(FANCYYBOX_TEMP,$dataArr,$condition);
			$this->cart_model->update_details(SHOPPING_CART,$dataArr2,$condition); 
			$this->cart_model->update_details(USER_SHOPPING_CART,$dataArr2,$condition); 
			
		}*/
		
		
		$GiftValue = ''; $CartValue = ''; $SubscribValue = '';	 $UserCartValue = '';

		$giftSet = $this->cart_model->get_all_details(GIFTCARDS_SETTINGS,array( 'id' => '1'));
		$giftRes = $this->cart_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));

		$SubcribRes = $this->minicart_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));	
		
		$this->db->select('a.*,b.product_name,b.max_quantity as mqty,b.seourl,b.image,b.id as prdid,b.price as orgprice');
		$this->db->from(SHOPPING_CART.' as a');
		$this->db->join(PRODUCT.' as b' , 'b.id = a.product_id');
		//$this->db->join(PRODUCT_ATTRIBUTE.' as c' , 'c.id = a.attribute_values','left');		
		$this->db->where('a.user_id = '.$userid);
		$cartVal = $this->db->get();
		
		
		
		$this->db->select('sell_id');
		$this->db->from(USER_SHOPPING_CART);
		$this->db->where('user_id = '.$userid);
		$this->db->group_by("sell_id");
		$UsercartSellVal = $this->db->get();
		
		/*****************Get Shipping Methods*********************/
		$where = array('status'=>'Active');
		$this->db->select('*');
		$this->db->from(SHIPPIN_METHODS);
		$this->db->where($where);
		$shippingMD = $this->db->get();
		
		#echo '<pre>'; print_r($shippingMD->result()); die;
		
		/*Start Language Translation*/
		$cart_orderForm = af_lg('cart_orderform','Order from');
		$cart_giftCard = af_lg('giftcard_cards','Gift Cards');
		$cart_recip = af_lg('cart_recipient', 'Recipient');
		$cart_from = af_lg('user_from', 'From');
		$cart_msg = af_lg('cart_message', 'Message');
		$cart_editgiftCard = af_lg('cart_editgc','Edit gift card');
		$cart_remove = af_lg('user_remove','Remove');
		$cart_delInfo = af_lg('cart_delinfo','Delivery Info');
		$cart_sendTo = af_lg('cart_sendto', 'Send to');
		$cart_ofGiftcard = af_lg('cart_ofgiftcard', 'of Gift Card');
		$cart_howyoupay = af_lg('cart_howtopay','How You will Pay');
		$cart_orderTotal = af_lg('cart_ordertot', 'Order total');
		$cart_prodCheckout = af_lg('cart_proceed', 'Proceed to checkout');
		$cart_anothgiftCard = af_lg('cart_anothergc', 'Add another gift card');
		$cart_prod = af_lg('prod_product', 'Product');
		$cart_price = af_lg('giftcard_price', 'Price');
		$cart_quantity = af_lg('shop_quantity', 'Quantity');
		$cart_Total = af_lg('cart_total', '總額');
		$cart_shipTo = af_lg('cart_shipto','Ship to');
		$cart_chose = af_lg('cart_choose', 'Choose Your Shipping Address');
		$cart_delAddr = af_lg('cart_deladdr', 'Delete this address');
		$cart_addAddr = af_lg('cart_addaddr', 'Add new shipping address');
		$cart_Order = af_lg('cart_order','Order');
		$cart_itemTot = af_lg('cart_itemtot', 'Item total');
		$cart_shiping = af_lg('shopsec_shipping', 'Shipping');
		$cart_Tax = af_lg('cart_tax','Tax');
		$cartBuyerCommission = af_lg('cart_buyer_commission', 'Buyer commission');
		$cartGatewayCommission = af_lg('cart_gateway_commission', 'Gateway commission');
		$cartGatewayStatic = af_lg('cart_gateway_static','Gateway static');
		$cart_orderForm = af_lg('cart_orderform', 'Order from');
		$cart_Merchant = af_lg('cart_merchant','Merchant');
		$cart_retailPrice = af_lg('cart_retailprice', 'retail price');
		$cart_readyShip = af_lg('cart_readytoship','Ready to ship');
		$cart_makeOrder = af_lg('cart_makeorder', 'Make to Order');
		$cart_shipAddr = af_lg('cart_shipaddr','Choose Your Shipping Address');
		$cart_coupCode = af_lg('cart_couponcode', 'Coupon Codes');
		$cart_hvCoupcode = af_lg('cart_hvcoupcode', 'Have a coupon code');
		$cart_Apply = af_lg('cart_apply', 'Apply');
		$cart_Discount = af_lg('cart_discount', 'Discount');
		$cart_contPay = af_lg('cart_paycont', 'Continue to Payment');
		$cart_conOwner = af_lg('cart_conowner', 'Contact shop owner');
		$cart_notShipto = af_lg('cart_notshipto','This item does not ship to');
		$cart_noteTo = af_lg('cart_noteto', 'Note to');
		$cart_Optional = af_lg('cart_optional', 'Optional');
		$cart_compOrder = af_lg('cart_completeorder', 'You can enter any info needed to complete your order or write a note to the shop');
		$cart_appCoupcode = af_lg('cart_applycouponcode', 'Apply shop coupon code');
		$cart_appusercredits = af_lg('cart_applyuserCredits', 'Apply User Credits');
		$cart_Coupcode = af_lg('cart_couponcod','copuncode');
		$cart_itemDetails = af_lg('shop_itemdetails','Item Details');
		$cart_item = af_lg('shop_item', '產品');
		$cart_itemsCart = af_lg('cart_itemscart', '手作在你的購物車');
		$cart_keepShop = af_lg('cart_keepshop','Keep Shopping');
		$cart_cartEmpty = af_lg('cart_cartempty','Your Shopping Cart is Empty');
		$cart_shopCartEmpty = af_lg('cart_shopcartempty', 'Shopping Cart Empty');
		$cart_awesomeSales = af_lg('cart_awesomesales', 'Don`t miss out on awesome sales right here on');
		$cart_fillCart = af_lg('cart_fillcart','Let`s fill that cart, shall we?');
		$cart_urShopCart = af_lg('cart_urshopcart', 'Your Shopping Cart');
		$Move_to_favorite = af_lg('move_to_favorite_cart', 'Add To favorite');
		$Remove_from_favorites = af_lg('remove_from_favorites_cart','從我的最愛刪除');
		$pickup = af_lg('local_collection', '本地接收');

		/*End Language Translation*/
		
		//$resultCart = $cartVal->result_array();
		/****************************** Gift Card Displays **************************************/
		if($giftRes -> num_rows() > 0 ){ 
			$giftAmt = 0; $g=-1;
			$GiftValue.= '<div id="UserCartTable_'.$selId.'" style="display:block;padding-top:30px;">
			<form method="post" name="giftSubmit" id="giftSubmit" class="continue_payment" enctype="multipart/form-data" action="checkout/gift">
			 			<div class="cart_items">
                	<h2>
                    	<span class="shop-name">'.$cart_orderForm.'<span class="shop-name1"><a href="gift-cards">'.ucwords($this->config->item('email_title').' '.$cart_giftCard).'</a></span></span>
                        <span class="cart_icons"><a href="javascript:giftcardCartRemove('.$userid.','.$g.')" cid="66577"" class="close-btn"></a>
                        </span>
                    </h2>
					<div class="cart_details">
                    	<div class="product_info">
					';
			    
				foreach ($giftRes->result() as $giftRow){
					
				$curdate = date('Y-m-d');
				if($giftRow->image!=''){
					$newImgpath = GIFTPATH.$giftRow->image;			
				}else{
					$newImgpath = GIFTPATH.'default-gift-card.jpg';
				}
				$send_mail=($giftRow->recipient_mail!='')? $giftRow->recipient_mail : $giftRow->sender_mail;
			
			$GiftValue.='<div id="UsercartdivId_'.$g.'">
		
						<div class="cart_top">
                            	<div class="cart_top_left">
                                	<a href="gift-cards/'.$giftRow->id.'"><img src="'.$newImgpath.'" alt="'.$giftRow->image.'"></a>
									<div class="clear"></div>
                                </div>
								
                                <div style="padding:0 10px"  class="cart_top_right">
								
								<div class="gift-outer-wrap">
                                	<a href="gift-cards/'.$giftRow->id.'" class="cartitem_name gift-sender-title">'.$this->data['currencySymbol'].number_format(($giftRow->price_value * $this->data['currencyValue']),2).' '.$this->data['currencyType'].' '.$cart_ofGiftcard.'</a>
									<div class="cartitem_detail">
										<table width="100%" border="0" cellpadding="6" cellspacing="0" class="table_property_use">
											<tr><td width="50%">'.$cart_recip.'</td><td>'.$cart_from.'</td></tr>
											<tr><td width="50%">'.$giftRow->recipient_name.'</td><td>'.$giftRow->sender_name.'</td></tr>
											<tr><td width="50%">'.$cart_msg.'</td><td>'.$giftRow->description.'</td></tr>
										</table>   
										<ul class="cartitem_links">
										<li><a href="gift-cards/'.$giftRow->id.'">'.$cart_editgiftCard.'</a></li>
										<li><a href="javascript:delete_gift('.$giftRow->id.','.$g.')">'.$cart_remove.'</a></li>
                                    </ul>                                     
										<div class="clear"></div>
									</div>
									
									</div>
									
									<div class="gift-sender">
									<label class="ship_to" style="margin:10px 0 0">'.$cart_delInfo.'</label>
									<label style="margin:10px 0 0">'.$cart_sendTo.'</label><br>
									<label style="margin:10px 0 0">'.$send_mail.'</label>
									</div>
									
							
							 	</div>
							</div>
						</div>
						';
				$giftAmt = $giftAmt + $giftRow->price_value;
				$g++;
			}
			
			$GiftValue.= '</div>
							<div class="order_summary">
								<div class="clear"></div>
								<label class="ship_to" style="margin:10px 0 0">'.$cart_howyoupay.'</label><ul>';
								
		   if($paypalDetailsVal['status']=='Enable'){
				if($PaypalVal['merchant_email']!=''){
					$GiftValue.='<li><input type="radio"  name="gift_payment_value" value="paypal" ><img src="images/facebook22.png" /></li>';	
				}
			} 
			if($authorizeDetailsVal['status']=='Enable'){
				if($AuthorizesVal['Login_ID']!='' && $AuthorizesVal['Transaction_Key']!=''){
					$GiftValue.='<li><input type="radio"  name="gift_payment_value" value="Credit_Card" ><img src="images/social_icon.png" /></li>';
				}
			}

			if($twocheckoutDetailsVal['status']=='Enable'){
			
					$GiftValue.='<li><input type="radio"  name="gift_payment_value" value="twocheckout" ><img width="70px" src="images/twocheckout.png" /></li>';
				
			}
				if($StripeDetailsVAl['status']=='Enable'){
			
				if($StripeVal['secret_key']!='' && $StripeVal['publishable_key']!=''){
					$GiftValue.='<li><input type="radio"  name="gift_payment_value" value="Stripe" ><label><span class=" "><img src="images/stripe.png" /></span></label></li>';
					
				}
			
			}
			
				if($pesapalDetail['status']=='Enable'){
					if($pesapalValue['consumer_key']!='' && $pesapalValue['consumer_secret']!=''){
						$GiftValue.='<li><input type="radio"  name="gift_payment_value" value="pesapal" ><label><span class=" "><img src="images/pesapal.jpg" /></label></li>';
						
					}
					}
					if($braintreeDetailsVal['status']=='Enable'){
						if($braintreevalue['PrivateKey']!='' && $braintreevalue['CSE_Key']!=''){
							$GiftValue.='<li><input type="radio"  name="gift_payment_value" value="BrainTree" ><img width="100px" src="images/braintree.jpg" /></li></ul>';
						}
					}
					if($WiretransferDetails['status']=='Enable'){
						
							$GiftValue.='<li><input type="radio"  name="gift_payment_value" value="wire_transfer" ><img width="100px" src="images/wire_transfer.jpg" /></li></ul>';
						} 
					if($Western_union_details['status']=='Enable'){
						
							$GiftValue.='<li><input type="radio"  name="gift_payment_value" value="western_union" ><img width="100px" src="images/western_union.jpg" /></li></ul>';
						} 
/*				if($payonDetail['status']=='Enable'){
					if($payonValue['user_ID']!='' && $payonValue['password']!='' && $payonValue['entity_ID']!=''){
						$GiftValue.='<li><input type="radio"  name="gift_payment_value" value="payon" ><label><img src="images/payon_logo.svg" /></label></li>';
						
					}
					} */                                       
				
				
		
		
		
								
							$GiftValue.='<span id="GiftCartErr"></span>
								<table class="summary_detail">
									<tbody>
										<tr>
											<td><strong>'.$cart_orderTotal.'</strong></td>
											<td class="txt_right"><strong>'.$this->data['currencySymbol'].number_format(($giftAmt * $this->data['currencyValue']),2).' '.$this->data['currencyType'].'</strong></td>
										</tr>
									</tbody>
								</table>   
								<input name="gift_cards_amount" id="gift_cards_amount" value="'.number_format($giftAmt,2,'.','').'" type="hidden">                         
								<input type="button" class="checkout_btn" name="cartPayment" id="button-submit-merchant" value="'.$cart_prodCheckout.'" onclick="javascript:giftcardprocess();" />
								<div class="clear"></div><br>
								<a href="gift-cards">'.$cart_anothgiftCard.'</a>
							</div>
							</div>
							</form>
							</div>';
		}

		
		/****************************** Subscribe Card Displays **************************************/
		if($SubcribRes -> num_rows() > 0 ){ 
			
			$SubscribValue.= '<div id="SubscribeCartTable" style="display:block;">
			<form method="post" name="SubscribeSubmit" id="SubscribeSubmit" class="continue_payment" enctype="multipart/form-data" action="site/cart/Subscribecheckout">
				<div class="cart-payment-wrap cart-note"><span class="cart-payment-top"><b></b></span><div class="table-cart-wrap"><table class="table-cart">
			<thead><tr><th width="51%" colspan="2" class="product">'.$cart_prod.'</th><th width="18%">'.$cart_price.'</th><th width="15%">'.$cart_quantity.'</th><th width="21%">'.$cart_Total.'</th></tr></thead></table>
				';	
			$SubscribAmt = 0; $subcribSAmt = 0; $subcribTAmt = 0; $SubgrantAmt = 0; 
			
			foreach ($SubcribRes->result() as $SubcribRow){
				$SubscribValue.= '<div id="SubscribId_'.$s.'" style="display:block;"><table class="table-cart"><tbody><tr class="first">
					<td rowspan="2" class="thumnail"><img src="'.FANCYBOXPATH.$SubcribRow->image.'" alt="'.$SubcribRow->name.'"><a href="javascript:delete_subscribe('.$SubcribRow->id.','.$s.')" class="remove_gift_card" cid="66577">'.$cart_remove.'</a></td>
					<td class="title"><a href=""><b>'.$SubcribRow->name.'</b></a><br></td>
					<td class="price">'.$this->data['currencySymbol'].number_format($SubcribRow->price,2,'.','').'</td>
					<td class="price">1</td>
					<td class="total">'.$this->data['currencySymbol'].number_format($SubcribRow->price,2,'.','').'</td>
				</tr>
				</tbody></table></div>';
				$SubscribAmt = $SubscribAmt + $SubcribRow->price;
				$s++;
			}
			
				$subcribSAmt = $MainShipCost;
				$subcribTAmt = ($SubscribAmt * 0.01 * $MainTaxCost);
				$SubgrantAmt = $SubscribAmt + $subcribSAmt + $subcribTAmt ;
		

		$SubscribValue.= '</div>
			 <div class="cart-payment" id="merchant-cart-payment">
		    <input type="hidden">
		    <span class="bg-cart-payment"></span>
		    <dl class="cart-payment-ship">
		      <dt>'.$cart_shipTo.'</dt>
		      <dd>
			<select id="address-cart" class="select-round select-shipping-addr" onchange="SubscribeChangeAddress(this.value);">
				  <option value="" id="address-select">'.$cart_chose.'</option>
			';
			
			foreach ($shipVal->result() as $Shiprow){
			if($Shiprow->primary == 'Yes'){ $optionsValues = 'selected="selected"'; 
			$ChooseVal = $Shiprow->full_name.'<br>'.$Shiprow->address1.'<br>'.$Shiprow->city.' '.$Shiprow->state.' '.$Shiprow->postal_code.'<br>'.$Shiprow->country.'<br>'.$Shiprow->phone; $ship_id =$Shiprow->id;  }else{ $optionsValues ='';}
			$SubscribValue.='<option '.$optionsValues.' value="'.$Shiprow->id.'" l1="'.$Shiprow->full_name.'" l2="'.$Shiprow->address1.'" l3="'.$Shiprow->city.' '.$Shiprow->state.' '.$Shiprow->postal_code.'" l4="'.$Shiprow->country.'" l5="'.$Shiprow->phone.'">'.$Shiprow->full_name.'</option>';
			}  
			
			$cls="";
			if($ChooseVal != "" )
				$cls="default_addr";
			
			//print_r($ChooseVal);die;
			//$tax_amt= 
		$SubscribValue.='</select>
			<input type="hidden" name="SubShip_address_val" id="SubShip_address_val" value="'.$ship_id.'" />
			
			<p class="'.$cls.'"><span id="SubChg_Add_Val">'.$ChooseVal.'</span></p>
			<span style="color:#FF0000;" id="Ship_Sub_err"></span>
			<a href="javascript:void(0);" class="delete_addr" onclick="shipping_cart_address_delete();">'.$cart_delAddr.'</a>
			
			<a href="settings/shipping" class="add_addr add_" onclick="shipping_address_cart();">'.$cart_addAddr.'</a>

		      </dd>
			</dl>

			   <dl class="cart-payment-order">
		      <dt>'.$cart_Order.'</dt>
		      <dd>
			<ul>
			  <li class="first">
			    <span class="order-payment-type">'.$cart_itemTot.'</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="SubCartAmt">'.number_format($SubscribAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			  <li>
			    <span class="order-payment-type">'.$cart_shiping.'</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="SubCartSAmt">'.number_format($subcribSAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			  <li>
			    <span class="order-payment-type">'.$cart_Tax.' (<span id="SubTamt">'.$MainTaxCost.'</span>%) of '.$this->data['currencySymbol'].$SubscribAmt.'</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="SubCartTAmt">'.number_format($subcribTAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li></ul>';
			 
			 $SubscribValue.='
			  <ul>
			 <li class="total">
			    <span class="order-payment-type"><b>'.$cart_Total.'</b></span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="SubCartGAmt">'.number_format($SubgrantAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			</ul>
		      </dd>
	              
		    </dl>
			
		    <input name="user_id" value="'.$userid.'" type="hidden">
			<input name="subcrib_amount" id="subcrib_amount" value="'.number_format($SubscribAmt,2,'.','').'" type="hidden">
			<input name="subcrib_ship_amount" id="subcrib_ship_amount" value="'.number_format($subcribSAmt,2,'.','').'" type="hidden">
			<input name="subcrib_tax_amount" id="subcrib_tax_amount" value="'.number_format($subcribTAmt,2,'.','').'" type="hidden">
			<input name="subcrib_total_amount" id="subcrib_total_amount" value="'.number_format($SubgrantAmt,2,'.','').'" type="hidden">
		    <input type="submit" class="btn" name="SubscribePayment" id="button-submit-merchant" value="'.$cart_contPay.'" />
		    
		  </div>
		</div>
	</form></div>';
		}
		
		
		/****************************** Cart Displays **************************************/
		

		if($cartVal -> num_rows() > 0 ){
			$CartValue.='<div id="CartTable" style="display:block;">
			<h2 class="title_use" style="width:98%;"> '.$cart_orderForm.' <b>'.$this->config->item('email_title').' '.$cart_Merchant.'</b></h2>
			<div class="cart_full"><div class="cart_payment">
			<form method="post" name="cartSubmit" id="cartSubmit" class="continue_payment" enctype="multipart/form-data" action="site/cart/cartcheckout">
       		
			
        <table width="700" border="0" cellpadding="0" cellspacing="0" class="table_property_use">
  <tr>
    <th class="product_head" width="51%">'.$cart_prod.'</th>
    <th class="product_head">'.$cart_price.'</th>
    <th class="product_head">'.$cart_quantity.'</th>
    <th class="product_head">'.$cart_Total.'</th>
  </tr></table>
       ';
		$cartAmt = 0; $cartShippingAmt = 0; $cartTaxAmt = 0; 
		$s=0;
		foreach ($cartVal->result() as $CartRow){
			//echo '<pre>';print_r($CartRow);
			$curdate = date('Y-m-d');
			$newImg = @explode(',',$CartRow->image);
			if($newImg[0]!=''){
				$newImgpath = PRODUCTPATHTHUMB.$newImg[0];			
			}else{
				$newImgpath = PRODUCTPATH.'dummyProductImage.jpg';
			}
			
		$CartValue.='<div id="cartdivId_'.$s.'">
		<table width="700" border="0" cellpadding="0" cellspacing="0" class="table_property_use">
		
		
		<tr>
    <td width="50%">
    <div class="inside_property">
    <div class="img_split">

		<img src="'.$newImgpath.'" alt="'.$CartRow->product_name.'" width="172">
        <div class=" clear"></div>
        <a href="javascript:void(0);" onclick="javascript:delete_cart('.$CartRow->id.','.$s.')" class="remove_item">'.$cart_remove.'</a>
    </div>
    <p><a href="shop/'.$CartRow->user_id.'/'.$CartRow->seourl.'"><b>'.$CartRow->product_name.'</b></a></p>';
			if($CartRow->attribute_values!=''){
			$CartValue.='<p class="new_rateuse">'.str_replace('|-|',', ',$CartRow->attribute_values).'</p>';
			}
    
    $CartValue.='<p class="new_rateuse">'.$this->data['currencySymbol'].$CartRow->orgprice.' '.$cart_retailPrice.'</p> <!--<span class="new_rateuse">13% off </span>-->
  
    <p class="new_rateuse">'.$cart_shiping.': ';
			if($CartRow->ship_immediate == 'true'){
				$CartValue.=$cart_readyShip;
			}else{
				$CartValue.=$cart_makeOrder;
			}	
			
			$CartValue.='</p>
    
    </div>
    </td>
    <td valign="middle"><p class="text_des">'.$this->data['currencySymbol'].$CartRow->price.'</p></td>
    <td valign="middle"><p class="text_des"><select name="quantity'.$s.'" id="quantity'.$s.'" class="accent_drop" style="width:60px;" data-mqty="'.$CartRow->mqty.'" onchange="javascript:update_cart('.$CartRow->id.','.$s.')">';
				for($p=1;$p<=$CartRow->mqty;$p++){
					if($CartRow->quantity == $p){ $SelVal='selected="selected"'; }else{ $SelVal='';}
					$CartValue.='<option '.$SelVal.' value="'.$p.'"  >'.$p.'</option>';
				}
			$CartValue.='</select></p></td>
    <td><p class="text_des">'.$this->data['currencySymbol'].'<span id="IndTotalVal'.$s.'">'.$CartRow->indtotal.'</span></p></td>
  </tr>
</table></div>';
				$cartAmt = $cartAmt + (($CartRow->product_shipping_cost + $CartRow->price + ($CartRow->price * 0.01 * $CartRow->product_tax_cost))  * $CartRow->quantity);
				$cartShippingAmt = $cartShippingAmt + ($CartRow->product_shipping_cost * $CartRow->quantity);
				$cartTaxAmt = $cartTaxAmt + ($CartRow->product_tax_cost * $CartRow->quantity);
				$cartQty = $cartQty + $CartRow->quantity;
				$s++;
			}
			$cartSAmt = $MainShipCost;
			$cartTAmt = ($cartAmt * 0.01 * $MainTaxCost);
			$grantAmt = $cartAmt + $cartSAmt + $cartTAmt ;
			
  $CartValue.='
 </div>
 	
 			<div class="right_cart">
  <table border="0" cellpadding="0" cellspacing="0" class="table_property_use">
  <tr>
    <th class="product_head">&nbsp;</th>
    
  </tr>
  <tr>
    <td width="40%">
    <div class="ship_content">
    <span>'.$cart_shipTo.'</span>
    <div class="clear"></div>
     <select id="address-cart" class="accent_drop" onchange="CartChangeAddress(this.value);">
				  <option value="">'.$cart_shipAddr.'</option>
			';
			
			foreach ($shipVal->result() as $Shiprow){
			if($Shiprow->primary == 'Yes'){ $optionsValues = 'selected="selected"'; $ChooseVal = $Shiprow->full_name.'<br>'.$Shiprow->address1.'<br>'.$Shiprow->city.' '.$Shiprow->state.' '.$Shiprow->postal_code.'<br>'.$Shiprow->country.'<br>'.$Shiprow->phone; $ship_id =$Shiprow->id;  }else{ $optionsValues ='';}
			$CartValue.='<option '.$optionsValues.' value="'.$Shiprow->id.'" l1="'.$Shiprow->full_name.'" l2="'.$Shiprow->address1.'" l3="'.$Shiprow->city.' '.$Shiprow->state.' '.$Shiprow->postal_code.'" l4="'.$Shiprow->country.'" l5="'.$Shiprow->phone.'">'.$Shiprow->full_name.'</option>';
			}  
			  
			$cls="";
			if($ChooseVal != "" )
				$cls="default_addr";
				//print_r($ChooseVal);die;
		$CartValue.='</select>
			<input type="hidden" name="Ship_address_val" id="Ship_address_val" value="'.$ship_id.'" />
			
			<p class="'.$cls.'"><span id="Chg_Add_Val">'.$ChooseVal.'</span></p>
			<span style="color:#FF0000;" id="Ship_err"></span>';
			
			if($this->checkLogin(U)!=''){
			$CartValue.='<a href="javascript:void(0);"  onclick="shipping_cart_address_delete();">'.$cart_delAddr.'</a>
			<a href="site/user_settings/display_shippings/'.$cart_page_url.'" onclick="shipping_address_cart();">'.$cart_addAddr.'</a>';	
			}else{
			$CartValue.='<a href="javascript:void(0);" onclick="shipping_address_login();">'.$cart_addAddr.'</a>';	
			}
			if($shippingMD->num_rows() >0){
				foreach($shippingMD->result() as $_shippingMD){
					if($UserCartRow->ship_type == $_shippingMD->name){
						$check = 'checked="checked"';
					}else{
						$check = '';
					}
					$UserCartValue.= '<div style="padding:5px;"><input onclick="shipping_rate_calc(this.value,'.$selId.')" type="radio" name="payment_method" '.$check.' value="'.$_shippingMD->name.'"> '.$_shippingMD->name.'</br></div>';
				}
				}
			
			$CartValue.='</div>
 
 <div class="clear"></div>
 <div class="border_use"></div>';

   
  if($disAmt>0){
			$CartValue.='<div class="coupon_code">
 <span>'.$cart_coupCode.'</span>
 <div class="clear"></div>
 
	<input id="is_coupon" name="is_coupon" class="coupon" placeholder="'.$cart_hvCoupcode.'?" readonly="readonly" type="text" value="'.$discountQuery->row()->couponCode.'">
	<input type="button"  id="CheckCodeButton" class="coupon_btn" onclick="javascript:checkRemove();" value="'.$cart_remove.'" style="cursor:pointer;" />

  </div>
			';
		    }else{
			$CartValue.='<div class="coupon_code">
 <span>'.$cart_coupCode.'</span>
 <div class="clear"></div>
 
	<input id="is_coupon" name="is_coupon" class="coupon" placeholder="'.$cart_hvCoupcode.'?" type="text">
	<input type="button"   id="CheckCodeButton" class="coupon_btn" onclick="javascript:checkCode();" value="'.$cart_Apply.'" style="cursor:pointer;" />

  </div>';
		    }

$CartValue.='  
 <div class="clear"></div>
<span id="CouponErr" style="color:#FF0000;"></span>
 <div class="border_use"></div>
 <div class="clear"></div>
 <div class="order_details_con">
 <p style="margin-left:15px;"><b>'.$cart_Order.'</b></p>
 <ul>
 	<li>'.$cart_itemTot.'</li>
	<li><strong>'.$this->data['currencySymbol'].'<span id="CartAmt">'.number_format($cartAmt,2,'.','').'</span></strong> '.$this->data['currencyType'].'</li>
 
	<li>'.$cart_shiping.'</li>
	<li><strong>'.$this->data['currencySymbol'].'<span id="CartSAmt">'.number_format($cartSAmt,2,'.','').'</span></strong> '.$this->data['currencyType'].'</li>
			  
	<li>'.$cart_Tax.' (<span id="carTamt">'.$MainTaxCost.'</span>%) of '.$this->data['currencySymbol'].'<span id="CartAmtDup">'.$cartAmt.'</span></li>
	<li><strong>'.$this->data['currencySymbol'].'<span id="CartTAmt">'.number_format($cartTAmt,2,'.','').'</span></strong> '.$this->data['currencyType'].'</li>
 </ul>';
	if($disAmt >0){
		$grantAmt = $grantAmt - $disAmt;
		$CartValue.='<div class="clear"></div><div id="disAmtValDiv"><ul>
		<li>'.$Discount.'</li>
		<li><strong>'.$this->data['currencySymbol'].'<span id="disAmtVal">'.number_format($disAmt,2,'.','').'</span></strong> '.$this->data['currencyType'].'</li>
		<ul></div>';
	}else{
		$CartValue.='<div class="clear"></div><div id="disAmtValDiv" style="display:none;"><ul>
		<li>'.$Discount.'</li>
		<li><strong>'.$this->data['currencySymbol'].'<span id="disAmtVal">'.number_format($disAmt,2,'.','').'</span></strong> '.$this->data['currencyType'].'</li>
		</ul></div>';
	}
	
	$CartValue.='<div class="clear"></div><ul>
		<li><b>'.$cart_Total.'</b></li>
		<li><strong>'.$this->data['currencySymbol'].'<span id="CartGAmt">'.number_format($grantAmt,2,'.','').'</span></strong> '.$this->data['currencyType'].'</li>
		</ul>
		      </div>
<div class="clear"></div>
			
		    <input name="user_id" value="'.$userid.'" type="hidden">
			<input name="cart_amount" id="cart_amount" value="'.number_format($cartAmt,2,'.','').'" type="hidden">
			<input name="cart_ship_amount" id="cart_ship_amount" value="'.number_format($cartSAmt,2,'.','').'" type="hidden">
			<input name="cart_tax_amount" id="cart_tax_amount" value="'.number_format($cartTAmt,2,'.','').'" type="hidden">
			<input name="cart_tax_Value" id="cart_tax_Value" value="'.number_format($MainTaxCost,2,'.','').'" type="hidden">
			<input name="cart_total_amount" id="cart_total_amount" value="'.number_format($grantAmt,2,'.','').'" type="hidden">
			<input name="discount_Amt" id="discount_Amt" value="'.number_format($disAmt,2,'.','').'" type="hidden">
			<input name="buyercommission_amount" id="buyercommission_amount" value="'.number_format($artfillBuyerCommission,2,'.','').'" type="hidden">';
			if($disAmt>0){
			$CartValue.='<input name="CouponCode" id="CouponCode" value="'.$discountQuery->row()->couponCode.'" type="hidden">
			<input name="Coupon_id" id="Coupon_id" value="'.$discountQuery->row()->couponID.'" type="hidden">
			<input name="couponType" id="couponType" value="'.$discountQuery->row()->coupontype.'" type="hidden">';
			}else{
			$CartValue.='<input name="CouponCode" id="CouponCode" value="" type="hidden">
			<input name="Coupon_id" id="Coupon_id" value="0" type="hidden">
			<input name="couponType" id="couponType" value="" type="hidden">';
			}
		    $CartValue.='
		    <input type="submit" class="payment_btn" name="cartPayment" id="button-submit-merchant" value="'.$cart_contPay.'" />
		   
    </td>
    
  </tr>
</table>
 
 </div>
 			
			</div></form>
			</div>';
		}
		
		/****************************** User Cart Displays **************************************/
		if($UsercartSellVal -> num_rows() > 0 ){
		$g=0; $UsercartQty = 0;	 $s=0;
		foreach ($UsercartSellVal->result() as $UserSellRow){
			$this->ajaxUserShoppingCart($userid);
			
			$this->db->select('a.*,b.product_name,b.seourl,b.image,b.id as prdid,b.sale_price as orgprice,b.user_id as shop_ids,b.quantity as mqty,c.paypal_email,b.seller_product_id,c.user_name,d.seller_businessname,d.Paypal_merchant_email,d.seourl as shopurl,d.PayPal_mode,d.PayPal_email,d.authorize_mode,d.authorize_key,d.authorize_id,d.payment_mode,b.status as product_status,b.pickup_option as prod_pickup');

			$this->db->from(USER_SHOPPING_CART.' as a');
			$this->db->join(PRODUCT.' as b' , 'b.id = a.product_id');
			$this->db->join(USERS.' as c' , 'c.id = a.sell_id');
			$this->db->join(SELLER.' as d' , 'd.seller_id = c.id');
			//$this->db->join(SELLER_TAX.' as st','st.seller_id = d.seller_id','left');
			$this->db->where('a.user_id = '.$userid.' and c.id='.$UserSellRow->sell_id);		
			$UsercartVal = $this->db->get();
			$selId = $UserSellRow->sell_id;
			//echo $this->db->last_query();
			//echo "<pre>";print_r($UsercartVal->result());die;
			$digital_item = 'Yes';
			foreach($UsercartVal->result() as $userCartItems){
				if($userCartItems->digital_files == ''){
					$digital_item = 'No';
					break;
				}
			}                       
                        
			$this->db->select("cod_available");
			$this->db->where(array("id"=>$selId));
			$this->db->from(USERS);
			$codOption=$this->db->get();
			
			/*$this->db->select("cod_available");
			$this->db->where(array("id"=>$selId));
			$this->db->from(USERS);
			$codOption=$this->db->get();*/
			$cod=$codOption->result_array();
			
			$this->db->select("payment_mode");
			$this->db->where(array("seller_id"=>$selId));
			$this->db->from(SELLER);
			$sellerCod=$this->db->get();
			$sellCod=$sellerCod->result_array();
            $sellcodoption=explode(",",$sellCod[0]["payment_mode"]);
			//print_r($sellcodoption);die;
			

			$favShopArr = $this->product_model->getUserFavoriteShopDetails(stripslashes($selId));

			if(empty($favShopArr)){ 
				$ShopfavVal="changeShopToFavourite('".$selId."','Fresh')";
				$shopFaVclass="fav1-btn";
			} else {
				$ShopfavVal="changeShopToFavourite('".$selId."','Old')";
				$shopFaVclass="fav1-btn2";				
 			} 
			
		/* 	if($UsercartVal->row()->tax_amount > 0){
				 $UsercartVal->row()->tax_amount;
			}else{
				$MainTaxCost = 0;
			}  */
			$MainTaxCost=0;
			
			$ship_id=$this->session->userdata('shopId-'.$selId);
			//echo "ship_id". $ship_id;
			if($ship_id != ""){
				$this->db->select('*');
				$this->db->from(SHIPPING_ADDRESS);
				$this->db->where('id',$ship_id);
				$ship_address=$this->db->get();
				$country=$ship_address->row()->country;
				$state=$ship_address->row()->state;
				
				$condition = 'state_name = "'.$state.'" AND country_name = "'.$country.'"';
				if($state == "")
					$condition ='country_name = "'.$country.'"';
				//echo "$UserSellRow->shop_ids". $UserSellRow->shop_ids;
				$this->db->select('*');
				$this->db->from(SELLER_TAX);
				$this->db->where($condition);
				$this->db->where('seller_id',$UsercartVal->row()->shop_ids);
				$tax=$this->db->get();
				//echo $this->db->last_query();
				//print_r($tax);die;
				if($tax->row()->tax_amount > 0){
					$MainTaxCost= $tax->row()->tax_amount;
				} 
			}
			
			$this->db->select('discountAmount,couponID,couponCode,coupontype');
			$this->db->from(USER_SHOPPING_CART);
			$this->db->where('user_id = '.$userid.' and sell_id = '.$selId);
			$discountQuery = $this->db->get();

			$disAmt = $discountQuery->row()->discountAmount;				

			$UserCartValue.='<div id="UserCartTable_'.$selId.'" class="s-cart-bl" style="padding-top:30px">
				<div class="s-cart-bl-header">
                	<h2>
                    	 '.$cart_orderForm.' 
						<a href="shop-section/'.$UsercartVal->row()->shopurl.'">'.ucwords($UsercartVal->row()->seller_businessname).'</a>
                        <span class="cart_icons">';
						if($this->checkLogin('U')!=''){
							$UserCartValue.='<a href="javascript:void(0);" id="cart_fav" class="'.$shopFaVclass.'" onclick="'.$ShopfavVal.'"></a>';
						}
						$UserCartValue.='<a href="javascript:void(0);" class="close-btn" onclick="sellerCartdelete('.$selId.');"></a>
                        </span>
                    </h2>
				</div>

				<form method="post" name="cartSubmit" id="cartSubmit" class="continue_payment" enctype="multipart/form-data" action="site/cart/usercartcheckout">
				<div class="order-wrapper card_for_temp">
                    <div class="order-wrapper-left col-md-9 card_for_temp">';
						$UsercartAmt = 0; $UsercartShippingAmt = 0; $UsercartTaxAmt = 0;  $UserCartPaymentShow = $UserCartShow = 0;
						foreach ($UsercartVal->result() as $UserCartRow){
							$curdate = date('Y-m-d');
							$UsernewImg = @explode(',',$UserCartRow->image);
							if($UsernewImg[0]!=''){
								$newImgpath = PRODUCTPATHTHUMB.$UsernewImg[0];			
							}else{
								$newImgpath = PRODUCTPATH.'dummyProductImage.jpg';
							}
							$favPrdArr = $this->product_model->getUserFavoriteProductDetails($UserCartRow->prdid);
							if(empty($favPrdArr)){ 
								$PrdFavArr = "changeProductToFavourite('".$UserCartRow->prdid."','Fresh',this)"; 
								$PrdFavTxt=$Move_to_favorite;
							} else {
								$PrdFavArr = "changeProductToFavourite('".$UserCartRow->prdid."','Old',this)";
								$PrdFavTxt=$Remove_from_favorites;
							} 
							$UserCartValue.='<div class="s-item-details" id="UsercartdivId_'.$g.'">
															<a href="products/'.$UserCartRow->seourl.'" class="s-item-details-img">
																<img src="'.$newImgpath.'" alt="item">
															</a>
															<div class="s-item-details-right col-md-8">
																<h3>
																	<a href="products/'.$UserCartRow->seourl.'"> '.$UserCartRow->product_name.'</a>';
																	if($UserCartRow->attribute_values!=''){
																		$UserCartValue.='<br>'.$UserCartRow->attribute_values.'';
																	}
																$UserCartValue.='</h3>
																<div class="s-quality">';
																	
															if($UserCartRow->mqty>0 && $digital_item == 'No'){
																if($UserCartRow->digital_files == ''){
																	$UserCartValue.='<label>'.$cart_quantity.' : </label>
																	<select name="userquantity'.$g.'" id="userquantity'.$g.'" data-mqty="'.$UserCartRow->mqty.'" onchange="javascript:update_cart_user('.$UserCartRow->id.','.$g.','.$selId.')">';
																		for($sp=1;$sp<=$UserCartRow->mqty;$sp++){
																			if($UserCartRow->quantity == $sp){ $SelVal='selected="selected"'; }else{ $SelVal='';}
																			$UserCartValue.='<option '.$SelVal.' value="'.$sp.'"  >'.$sp.'</option>';
																		}
																	$UserCartValue.='</select><br/>';
																}
															if($UserCartRow->product_status!='Publish'){
																$UserCartValue.='<div class="error_message">Item Currently Unavailable, please contact shop owner.</div>';
																	$UserCartShow = 1;							
															}
																
															} else {
																if($digital_item == 'No'){										
																	$UserCartValue.='<div class="error_message">此貨品缺貨，請聯絡店主。</div>';
																	$UserCartShow = 1;											
																}
															}																
																if($digital_item == 'No'){
																	$UserCartValue.='<span> 
																	'.$this->data['currencySymbol'].number_format(($UserCartRow->price * $this->data['currencyValue']),2,'.','').' '.$this->data['currencyType'].' + '.$this->data['currencySymbol'].number_format(($UserCartRow->product_shipping_cost * $this->data['currencyValue']),2,'.','').' '.$this->data['currencyType'].' '.$cart_shiping.' 
																	</span>';
																}else{
																	$UserCartValue.='<span>'.$this->data['currencySymbol'].number_format(($UserCartRow->price * $this->data['currencyValue']),2,'.','').' '.$this->data['currencyType'];										
																}	
																
																	$UserCartValue.='<span id="UserIndTotalVal'.$g.'_'.$selId.'" >'.
																		af_lg('cart_total','total').' : '.$this->data['currencySymbol'].number_format(((($UserCartRow->price * $UserCartRow->quantity)+ $UserCartRow->shipping_cost) * $this->data['currencyValue']),2,'.','').' '.$this->data['currencyType'].'
																	</span>
																</div>';																
																$UserCartValue.='<ul class="s-actions">';
																if($this->checkLogin('U')!=''){
																	$UserCartValue.='<li><a class="fav_change" href="javascript:void(0);" onclick="'.$PrdFavArr .'">'.$PrdFavTxt.'</a></li>';
																	if($selId!=1){
																		$UserCartValue.='<li><a href="javascript:void(0);" onclick="contactshopowner('.$selId.','.$UserCartRow->prdid.');">'.$cart_conOwner.'</a><a class="reg-popup2 cboxElement"></a></li>';
																	}
																}	
																$UserCartValue.='<li><a href="javascript:void(0);" onclick="javascript:delete_cart_user('.$UserCartRow->id.','.$g.','.$selId.')">'.$cart_remove.'</a></li>';
																//echo $this->session->userdata('shopId-'.$selId)."".$digital_item;#die;
																if($this->session->userdata('shopId-'.$selId)!='' && $digital_item=='No'){
																	//echo $UserCartRow->shipping;die;
																   if($UserCartRow->shipping == 'No'){
																		$UserCartValue.='<li class="error_message" style="display:block;">'.$cart_notShipto.' '.$this->session->userdata('ShopCountry-'.$selId).'.</li>';
																		$UserCartShow = 1;
																   }else{
																	   // $UserCartValue.='<li class="error_message" style="display:none;">'.$cart_notShipto.' '.$this->session->userdata('ShopCountry-'.$selId).'.</li>';
																   }
																}
$UserCartValue.='
</ul></div>';
/*
if($UserCartRow->prod_pickup == 'delivery-collecion'){
	$UserCartValue.='<span style="float:left; width:150px; font-weight:bold;">'.af_lg('pickup','Pickup').': delivery or collection</span>';
}else{
	$UserCartValue.='<span style="float:left; width:150px; font-weight:bold;">'.af_lg('pickup','Pickup').':'.$UserCartRow->prod_pickup.' Only</span>';
}
*/
$UserCartValue.='</div>';
																		
																$UsercartAmt = $UsercartAmt + ($UserCartRow->price * $UserCartRow->quantity);
																$UsercartShippingAmt = $UsercartShippingAmt + $UserCartRow->shipping_cost;
																$UsercartTaxAmt = $UsercartTaxAmt + ($UserCartRow->product_tax_cost * $UserCartRow->quantity);
																$UsercartQty = $UsercartQty + $UserCartRow->quantity;
																$g++;
															}
						$buyerCommission = $this->admin_model->getAdminSettings()->row()->buyer_commission * 1.00;
		
						$UsercartSAmt = $UsercartShippingAmt;
						$UsercartTAmt = ($UsercartAmt * 0.01 * $MainTaxCost);
						$artfillBuyerCommission = (($UsercartAmt + $UsercartSAmt + $UsercartTAmt) * 0.01 * $buyerCommission);
						$UsergrantAmt = $UsercartAmt + $UsercartSAmt + $UsercartTAmt + $artfillBuyerCommission;

							$UserCartValue.='<div class="s-opninon-box">
																<label>'.$cart_noteTo.' '.$UsercartVal->row()->seller_businessname.' '.$cart_Optional.'</label>
																<textarea name="note" data-id="cart-note" placeholder="'.$cart_compOrder.'"></textarea>
															</div>
														</div>
														
<div class="col-md-3 order-summay">';
if($digital_item == 'No'){
$pickupArr = array();
$collection = array();
foreach($UsercartVal->result() as $_Usercart){
	$pickupArr []= $_Usercart->pickup_option;
	$collection []= $_Usercart->prod_collection;
}
if((in_array('collection', $pickupArr)) && (in_array('delivery', $pickupArr))){
	
}elseif(in_array('collection', $pickupArr)){
	if(in_array('Yes', $collection)){
		$pcollect = 'checked';
	}else{
		$pcollect = '';
	}
	$UserCartValue.='<div class="local-pick"><input disabled="disabled" class="local-pickup" onclick="localPickup(this,'.$selId.');" type="checkbox" value="'.$pcollect.'" name="pickup_opt" '.$pcollect.' checked><input type="hidden" value="'.$pcollect.'" name="pickup_option"><img src="images/pickup.png"/>'.$pickup.'</div>';
}elseif(in_array('delivery', $pickupArr)){
	$UserCartValue.='<p class="ship_to">'.$cart_shipTo.'</p>
	<select id="address-cart" class="ship_to" onchange="UserCartChangeAddress(this.value,'.$selId.');">
	<option value="" id="address-select">'.$cart_chose.'</option>';
	foreach ($shipVal->result() as $Shiprow){
		if($Shiprow->id == $this->session->userdata('shopId-'.$selId)){ 
			$optionsValues = 'selected="selected"'; 
			$ChooseVal = $Shiprow->full_name.'<br>'.$Shiprow->address1.
			$Shiprow->address2.'<br>'.$Shiprow->city.', '.$Shiprow->state.', '.$Shiprow->postal_code.'<br>'.$Shiprow->phone.'<br>'.$Shiprow->country; $ship_id =$Shiprow->id;  
		}else{ 
			$optionsValues ='';
		}
		$UserCartValue.='<option '.$optionsValues.' value="'.$Shiprow->id.'" l1="'.$Shiprow->full_name.'" l2="'.$Shiprow->address_location.'" l3="'.$Shiprow->phone.'">'.$Shiprow->full_name.'</option>';
	}
	$UserCartValue.='</select>
	<p class="default_addr"><span id="Chg_Add_Val_'.$selId.'">'.$ChooseVal.'</span></p>
	<span style="color:#FF0000;" id="User_Ship_err_'.$selId.'"></span>
	<a href="settings/cart-shipping-address" class="add_addr add_" onclick="shipping_address_cart();">'.$cart_addAddr.'</a>';
}else{
	if(in_array('Yes', $collection)){
		$pcollect = 'checked';
		$style ='style="display:none"';
	}else{
		$pcollect = '';
		$style ='style="display:block"';
	}
	//$UserCartValue.='<div class="local-pick"><input class="local-pickup" display="none" onclick="localPickup(this,'.$selId.');" type="checkbox" value="'.$pcollect.'" name="pickup_option" '.$pcollect.'><img src="images/pickup.png"/>'.$pickup.'</div>';
	$UserCartValue.='<div class="mtr-pick"><input class="mtr-pickup" type="radio" name="pickup_mtr" checked />Pickup at MTR station</div>';
	$UserCartValue.='<p '.$style.' class="ship_to" checked="checked">'.$cart_shipTo.'</p>
	<select '.$style.' id="address-cart" class="ship_to" onchange="UserCartChangeAddress(this.value,'.$selId.');">
	<option value="" id="address-select">'.$cart_chose.'</option>';
	foreach ($shipVal->result() as $Shiprow){
		if($Shiprow->id == $this->session->userdata('shopId-'.$selId)){ 
			$optionsValues = 'selected="selected"'; 
			$ChooseVal = $Shiprow->full_name.'<br>'.$Shiprow->address1.
			$Shiprow->address2.'<br>'.$Shiprow->city.', '.$Shiprow->state.', '.$Shiprow->postal_code.'<br>'.$Shiprow->phone.'<br>'.$Shiprow->country; $ship_id =$Shiprow->id;  
		}else{ 
			$optionsValues ='';
		}
		$UserCartValue.='<option '.$optionsValues.' value="'.$Shiprow->id.'" l1="'.$Shiprow->full_name.'" l2="'.$Shiprow->address_location.'" l3="'.$Shiprow->phone.'">'.$Shiprow->full_name.'</option>';
	}
	$UserCartValue.='</select><p '.$style.'  class="default_addr"><span id="Chg_Add_Val_'.$selId.'">'.$ChooseVal.'</span></p><span style="color:#FF0000;" id="User_Ship_err_'.$selId.'"></span><a  '.$style.' href="settings/cart-shipping-address" class="add_addr add_" onclick="shipping_address_cart();">'.$cart_addAddr.'</a>';
}
}
if($this->session->userdata('shopId-'.$selId)!='' && $digital_item=='No'){
	if($UserCartRow->shipping == 'No'){
		$UserCartValue.='<li class="error_message" style="display:block;">'.$cart_notShipto.' '.$this->session->userdata('ShopCountry-'.$selId).'.</li>';
		$UserCartShow = 1;
	}else{
		$UserCartValue.='<li class="error_message" style="display:none;">'.$cart_notShipto.' '.$this->session->userdata('ShopCountry-'.$selId).'.</li>';
	}
}
					$UserCartValue.='<input type="hidden" name="Ship_address_val" id="User_Ship_address_val_'.$selId.'" value="'.$ship_id.'" />
						<input type="hidden" name="digital_item" value="'.$digital_item.'" />
						<div class="order-payment">
							<h4>'.$cart_howyoupay.'</h4>
							<ul class="payment-option">';
							$payment_method = explode(',',$UserCartRow->payment_mode);
		if($payAdptDetailsVal['status']=='Enable' && $paypalAdptVal['merchant_email']!='' && in_array('PayPal Adaptive',$payment_method) && $UserCartRow->Paypal_merchant_email != "" ){
			
				$UserCartValue.='<li><input type="radio"  name="payment_value" value="Paypal Adaptive" checked /><label><span class="paypal-plus-cards"><img src="images/facebook22.png" /></span></label></li>';	
				$UserCartPaymentShow = 1;
			
		}else{
			if($paypalDetailsVal['status']=='Enable'){
				if($PaypalVal['merchant_email']!=''){
					$paypalRate = $this->admin_model->getAdminSettings()->row()->paypal_rate;
					$paypalStatic = $this->admin_model->getAdminSettings()->row()->paypal_static;
					$UserCartValue.='<li><input type="radio" onclick="changeGateway('.$selId.','.$paypalRate.','.$paypalStatic.','.$UsergrantAmt.')"   name="payment_value" value="Paypal" checked ><label><span class="paypal-plus-cards">paypal</span></label></li>';	
					$UserCartPaymentShow = 1;
				}
			}			
			if($authorizeDetailsVal['status']=='Enable'){
				if($AuthorizesVal['Login_ID']!='' && $AuthorizesVal['Transaction_Key']!=''){
					$UserCartValue.='<li><input type="radio"  name="payment_value" value="Credit-Card" ><label><span class="cc-icons ">Credit Card</span></label></li>';
					$UserCartPaymentShow = 1;
				}
			}
			if($twocheckoutDetailsVal['status']=='Enable'){
				
					$UserCartValue.='<li><input type="radio"  name="payment_value" value="twocheckout" ><img width="100px" src="images/twocheckout.png" /></li>';
				
				
			}
			
			if($StripeDetailsVAl['status']=='Enable'){
			
				if($StripeVal['secret_key']!='' && $StripeVal['publishable_key']!=''){
					$UserCartValue.='<li><input type="radio"  name="payment_value" value="Stripe" ><label><span class=" "><img src="images/stripe.png" /></span></label></li>';
					$UserCartPaymentShow = 1;
				}
			
			}
			
				if($pesapalDetail['status']=='Enable'){
					if($pesapalValue['consumer_key']!='' && $pesapalValue['consumer_secret']!=''){
						$UserCartValue.='<li><input type="radio"  name="payment_value" value="pesapal" ><label><span class=" "><img src="images/pesapal.jpg" /></label></li>';
						$UserCartPaymentShow = 1;
					}
					}
				if($braintreeDetailsVal['status']=='Enable'){
						if($braintreevalue['PrivateKey']!='' && $braintreevalue['CSE_Key']!=''){
							$UserCartValue.='<li><input type="radio"  name="payment_value" value="BrainTree" ><img width="100px" src="images/braintree.jpg" /></li>';
						}
					}
					
				if($WiretransferDetails['status']=='Enable'&& in_array('wire_transfer',$sellcodoption)){
						
							$UserCartValue.='<li><input type="radio"  name="payment_value" value="wire_transfer" ><img width="100px" src="images/wire_transfer.jpg" /></li>';
						
					}  
				if($Western_union_details['status']=='Enable'&&in_array('western_union',$sellcodoption)){
						
							$UserCartValue.='<li><input type="radio"  name="payment_value" value="western_union" ><img width="100px" src="images/western_union.jpg" /></li>';
						
					}  
/*				if($payonDetail['status']=='Enable'){
					if($payonValue['user_ID']!='' && $payonValue['password']!='' && $payonValue['entity_ID']!=''){
						$UserCartValue.='<li><input type="radio"  name="payment_value" value="payon" ><img src="images/payon_logo.svg" width="100px" /></li>';
						$UserCartPaymentShow = 1;
					}
					} */                                       
				
				
			}				
			if($PayuDetailsVal['status']=='Enable'&&in_array('Payu',$sellcodoption))   //	payu_mode 	payu_merchant_id 	payu_salt
			{
				$UserCartValue.='<li><input type="radio"  name="payment_value" value="Payu" ><label><span class=" "><img src="images/payu-logo.png" /></span></label></li>';
				$UserCartPaymentShow = 1;
			}
							
						//	$sellcodoption=array_flip($sellcodoption);
							if($digital_item == 'No'){
								//$UserCartValue.='<li><input type="radio"  name="payment_value" value="COD" ><label><span class=" "><img src="images/cod.png" /></span></label></li>';
								//if($cod[0]['cod_available']=='Yes' && in_array('COD',$sellcodoption)){								
								if($this->config->item('cod_payment')=="Yes" && in_array('COD',$sellcodoption)){								
									$UserCartValue.='<li><input type="radio"  name="payment_value" value="COD" ><label><span class=" "><img src="images/cod.png" /></span></label></li>';
									$UserCartPaymentShow = 1;
								}
							}

							////Add user Credits
							$this->db->select("credits");
							$this->db->where(array("id"=>$userid));
							$this->db->from(USERS);
							$credits = $this->db->get();
							$currCredit = $credits->row()->credits;			
							$UserCartValue.='
									
									</ul>
									<!--<a href="javascript:void(0);" id="shopcoupon'.$selId.'" onclick="apply_coupon_code('.$selId.');">'.$cart_appCoupcode.'</a>-->
									<div class="clear"></div>';
						
						if($disAmt>0){

							$UserCartValue.='<div class="copun_apply" id="Coupon_apply_'.$selId.'" style="display:block;">
												<span id="CouponErr_'.$selId.'" style="color:#FF0000;"></span>
												<label>'.$copuncode.'</label>
												<input id="is_coupon_'.$selId.'" name="is_coupon" class="coupon-search" placeholder="'.$cart_hvCoupcode.'?" readonly="readonly" type="text" value="'.$discountQuery->row()->couponCode.'">
												<input type="button"  id="CheckCodeButton" class="keep_btn" onclick="javascript:checkRemove('.$selId.');" value="'.$cart_remove.'" style="cursor:pointer;" />
											</div>';
						}else{
							$UserCartValue.='<div class="copun_apply" id="Coupon_apply_'.$selId.'" style="display:block;">
												<span id="CouponErr_'.$selId.'" style="color:#FF0000;"></span>
												<label>'.$cart_coupCode.'</label>
												<input id="is_coupon_'.$selId.'" name="is_coupon" class="coupon" placeholder="'.$cart_hvCoupcode.'?" type="text">
												<input type="button" id="CheckCodeButton" class="keep_btn" onclick="javascript:checkCode('.$selId.');" value="'.$cart_Apply.'" style="cursor:pointer;" />
											</div>';
						}
						$UserCartValue.='<table width="100%" class="payment-total" id="payment-total">
                            	<tbody>
                                	<tr>
                                    	<td class="txt_right col-md-7">'.$cart_item.'</td>
                                        <td>'.$this->data['currencySymbol'].'<span id="UserCartAmt_'.$selId.'">'.number_format($UsercartAmt * $this->data['currencyValue'],2,'.','').'</span> '.$this->data['currencyType'].'</td>
                                    </tr>
                                    <tr>
                                    	<td>'.$cart_shiping.'</td>
                                        <td class="txt_right">'.$this->data['currencySymbol'].'<span id="UserCartSAmt_'.$selId.'">'.number_format($UsercartSAmt * $this->data['currencyValue'],2,'.','').'</span></b> '.$this->data['currencyType'].'</td>
                                    </tr>
                                    <tr>									
                                    	<td>'.$cart_Tax.' (<span id="UsercarTamt_'.$selId.'">'.$MainTaxCost.'</span>%) of '.$this->data['currencySymbol'].'<span id="UserCartAmtDup_'.$selId.'">'.$UsercartAmt * $this->data['currencyValue'].'</span></td>
                                        <td class="txt_right">'.$this->data['currencySymbol'].'<span id="UserCartTAmt_'.$selId.'">'.number_format($UsercartTAmt * $this->data['currencyValue'],2,'.','').'</span></b> '.$this->data['currencyType'].'</td>
                                    </tr>
                                    <tr>									
                                    	<td>'.$cartBuyerCommission.' (<span id="UsercarTamt_'.$selId.'">'.$buyerCommission.'</span>%) of '.$this->data['currencySymbol'].'<span id="UserCartAmtDup_'.$selId.'">'.$UsercartAmt * $this->data['currencyValue'].'</span></td>
                                        <td class="txt_right">'.$this->data['currencySymbol'].'<span id="UserCartTAmt_'.$selId.'">'.number_format($artfillBuyerCommission * $this->data['currencyValue'],2,'.','').'</span></b> '.$this->data['currencyType'].'</td>
                                    </tr>';
									
									if($disAmt >0){
										$UsergrantAmt = $UsergrantAmt - $disAmt;
										$UserCartValue.='<tr>
																		<td>'.$cart_Discount.'</td>
																		<td class="txt_right">'.$this->data['currencySymbol'].'<span id="disAmtVal'.$selId.'">'.number_format($disAmt * $this->data['currencyValue'],2,'.','').'</span> '.$this->data['currencyType'].'</td>
																	</tr>';
									}

								$UserCartValue.='<tr class="divider">
																<td colspan="2"></td>
															</tr>
															<tr class="grand-total">
																<td>'.$cart_orderTotal.'</td>
																<td class="monetary"> <strong>'.$this->data['currencySymbol'].'<span id="UserCartGAmt_'.$selId.'">'.number_format($UsergrantAmt * $this->data['currencyValue'],2,'.','').'</span></b> '.$this->data['currencyType'].'</strong> </td>
															</tr>
                                    <tr>									
                                    	<td>'.$cartGatewayCommission.' (<span id="gatewayRate_'.$selId.'">'.'0'.'</span>%) of '.$this->data['currencySymbol'].'<span id="UserCartAmtDup_'.$selId.'">'.number_format($UsergrantAmt * $this->data['currencyValue'],2,'.','').'</span> + '.$cartGatewayStatic.' '.$this->data['currencySymbol'].'<span id="gatewayStatic_'.$selId.'"></span></td>
                                        <td class="txt_right">'.$this->data['currencySymbol'].'<span id="gatewayAmt_'.$selId.'">0.00</span></b> '.$this->data['currencyType'].'</td>
                                    </tr>
<script>
changeGateway('.$selId.','.$paypalRate.','.$paypalStatic.','.$UsergrantAmt.');
</script>
														</tbody>
								</table>
		    <input name="user_id" value="'.$userid.'" type="hidden">
			 <input name="sell_id" value="'.$selId.'" type="hidden">
			<input name="user_cart_amount" id="user_cart_amount_'.$selId.'" value="'.number_format($UsercartAmt,2,'.','').'" type="hidden">
			<input name="user_cart_ship_amount" id="user_cart_ship_amount_'.$selId.'" value="'.number_format($UsercartSAmt,2,'.','').'" type="hidden">
			<input name="user_cart_tax_amount" id="user_cart_tax_amount_'.$selId.'" value="'.number_format($UsercartTAmt,2,'.','').'" type="hidden">
			<input name="user_cart_tax_Value" id="user_cart_tax_Value_'.$selId.'" value="'.number_format($MainTaxCost,2,'.','').'" type="hidden">
			<input name="user_cart_total_amount" id="user_cart_total_amount_'.$selId.'" value="'.number_format($UsergrantAmt,2,'.','').'" type="hidden">
			<input name="user_discount_Amt" id="user_discount_Amt_'.$selId.'" value="'.number_format($disAmt,2,'.','').'" type="hidden">
			<input name="user_buyercommission_amount" id="user_buyercommission_amount_'.$selId.'" value="'.number_format($artfillBuyerCommission,2,'.','').'" type="hidden">';
			if($disAmt>0){
				$UserCartValue.='<input name="CouponCode" id="CouponCode" value="'.$discountQuery->row()->couponCode.'" type="hidden">
				<input name="Coupon_id" id="Coupon_id" value="'.$discountQuery->row()->couponID.'" type="hidden">
				<input name="couponType" id="couponType" value="'.$discountQuery->row()->coupontype.'" type="hidden">';
			}else{
				$UserCartValue.='<input name="CouponCode" id="CouponCode" value="" type="hidden">
				<input name="Coupon_id" id="Coupon_id" value="0" type="hidden">
				<input name="couponType" id="couponType" value="" type="hidden">';
			}
			if($UserCartShow == 0 && $UserCartPaymentShow == 1){
				$UserCartValue.='<input type="submit" class="order-submit btn-transaction" name="cartPayment" id="button-submit-merchant" value="'.$cart_prodCheckout.'"/>';
			}else{
				$UserCartValue.='<input type="submit" class="order-submit btn-transaction" style="padding:6px; width:214px" name="cartPayment" id="button-submit-merchant" value="'.$cart_prodCheckout.'" disabled="disabled"/>';

			}
		    $UserCartValue.='</div>
									</div>
								</div>
							</form>
					</div>';
		}

		}
		
		$countVal = $giftRes -> num_rows() + $cartQty + $UsercartQty + $SubcribRes -> num_rows();
		$cartListItems=$this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		
		//$countVal = $cartListItems->num_rows();
		//
		if ($this->agent->is_referral()){
	       $urlRefe = $this->agent->referrer();
   		}
		if($countVal > 0 ){
			$CartDisp = '
			
			<div class="">
               	<!-- <h1><span id="Shop_id_count">'.$countVal.'</span> '.$cart_itemsCart.' </h1>
            	<a href="home" class=" search-bt col-md-6 col-xs-4 op-bt s-cart-button">'.$cart_keepShop.'</a> -->
				
			
   
				
         	</div>
			
				'.$GiftValue.$SubscribValue.$CartValue.$UserCartValue.'
			
			 <div class="cart_items" id="EmptyCart" style="display:none;">
                	<h2>
                    	<span class="shop-name"><span class="shop-name1">'.$cart_cartEmpty.'</span></span>
                        <span class="cart_icons">
                            <!--<a href="#" class="close-btn"></a>-->
                        </span>
                    </h2>
					 <div class="cart_details">
					 <div  class="empty-alert card_for_temp" >
					<p style="text-align:center;"><img src="images/site/shopping_empty.jpg" alt="'.$cart_shopCartEmpty.'"></p>
					<p style="text-align:center;"><b></b></p>
					<p style="text-align:center;">'.$cart_awesomeSales.' '.ucwords($this->config->item('email_title')).'. '.$cart_fillCart.'</p>
				</div>
					 </div>
			</div>		
			
			';
		}else{
			$CartDisp = '
			<div class="">
               	<h1> '.$cart_urShopCart.' </h1>
            	<a href="home" class="search-bt col-md-6 col-xs-4 op-bt s-cart-button">'.$cart_keepShop.'</a>
         	</div>
			<div class="cart_items" id="EmptyCart" style="display:block;">
                	<h2>
                    	<span class="shop-name"><span class="shop-name1">'.$cart_cartEmpty.'</span></span>
                        <span class="cart_icons">
                            <!--<a href="#" class="close-btn"></a>-->
                        </span>
                    </h2>
					 <div class="cart_details">
					 <div  class="empty-alert card_for_temp" >
					<p style="text-align:center;"><img src="images/site/shopping_empty.jpg" alt="'.$cart_shopCartEmpty.'"></p>
					<p style="text-align:center;"><b></b></p>
					<p style="text-align:center;">'.$cart_awesomeSales.' '.ucwords($this->config->item('email_title')).'. '.$cart_fillCart.'</p>
				</div>
					 </div>
			</div>';
				
		}
		
		return $CartDisp;

	}
	
	/****************************Abandon list by sophia*****************************************/
	public function get_abandon_list()
	{
		$this->db->select('c.*,count("c.*") as countc,u.email,u.full_name');
		$this->db->from(USER_SHOPPING_CART.' as c');
		$this->db->join(USER.' as u ','c.user_id=u.id','left');
		$this->db->group_by('c.user_id');
		$this->db->order_by('c.created','asc');
		$res= $this->db->get();
		//echo "<pre>";print_r($res->result());die;
		return $res;
		 
	}
	public function get_cart_values($user_id)
	{
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.image,pd.id as PrdID,pAr.attr_name');
		$this->db->from(USER_SHOPPING_CART.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id','left');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id','left');		
		$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = p.attribute_values','left');				
		$this->db->where('p.user_id = "'.$user_id.'"');
		$PrdList = $this->db->get();
		return $PrdList;
	
	}
	
	/******************** Main Gift Count Function  ********************/
	public function mani_gift_total($userid=''){
	
		$cartMiniMainCount = 0; $UsercartMiniMainCount = 0;
		$SubcribRes = $this->cart_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));
		$cartVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$UsercartValTotl = $this->cart_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid));
		$giftRes = $this->cart_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
		
		$giftAmt = 0;
		if($giftRes -> num_rows() > 0 ){ 
			
			foreach ($giftRes->result() as $giftRow){
				$giftAmt = $giftAmt + $giftRow->price_value;
			}

		}
		if($cartVal -> num_rows() > 0 ){ 
			foreach ($cartVal->result() as $CartRow){
				$cartMiniMainCount = $cartMiniMainCount + $CartRow->quantity;
			}
		}
		
		if($UsercartValTotl -> num_rows() > 0 ){ 
			foreach ($UsercartValTotl->result() as $UserValCartRow){
				$UsercartMiniMainCount = $UsercartMiniMainCount + $UserValCartRow->quantity;
			}
		}
		
		$countVal = $giftRes -> num_rows() + $SubcribRes -> num_rows() + $cartMiniMainCount + $UsercartMiniMainCount ;
		
		return number_format($giftAmt,2,'.','').'|'.$countVal;

	}
	
	/******************** Main Subscribe Count Function  ********************/
	public function mani_subcribe_total($userid=''){
		
		$giftRes = $this->cart_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
		$cartVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$SubcribRes = $this->cart_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));
		$UsercartValTotl = $this->cart_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid));
		$SubcribAmt = 0; $SubcribSAmt = 0; $SubcribTAmt = 0; $SubcribTotalAmt = 0; $cartMiniMainCount = 0; $UsercartMiniMainCount = 0;
		
		if($SubcribRes -> num_rows() > 0 ){ 
			
			foreach ($SubcribRes->result() as $SubscribRow){
				$SubcribAmt = $SubcribAmt + $SubscribRow->price;
			}
			$SubcribSAmt = $SubcribRes->row()->shipping_cost;
			$SubcribTAmt = $SubcribAmt * 0.01 * $SubcribRes->row()->tax;
			$SubcribTotalAmt = $SubcribAmt + $SubcribSAmt + $SubcribTAmt ;
			
		}
		
		if($cartVal -> num_rows() > 0 ){ 
			foreach ($cartVal->result() as $CartRow){
				$cartMiniMainCount = $cartMiniMainCount + $CartRow->quantity;
			}
		}
		
		if($UsercartValTotl -> num_rows() > 0 ){ 
			foreach ($UsercartValTotl->result() as $UserValCartRow){
				$UsercartMiniMainCount = $UsercartMiniMainCount + $UserValCartRow->quantity;
			}
		}
		
		$countVal = $SubcribRes -> num_rows() + $giftRes -> num_rows() + $cartMiniMainCount + $UsercartMiniMainCount ;
		
		return number_format($SubcribAmt,2,'.','').'|'.number_format($SubcribSAmt,2,'.','').'|'.number_format($SubcribTAmt,2,'.','').'|'.number_format($SubcribTotalAmt,2,'.','').'|'.$countVal;

	}
	
	/******************** Main cart Count Function  ********************/
	public function mani_cart_total($userid=''){
		
		$giftRes = $this->cart_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
		$cartVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$SubcribRes = $this->cart_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));
		$UsercartValTotl = $this->cart_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid));
		$cartAmt = 0; $cartShippingAmt = 0; $cartTaxAmt = 0; $cartMiniMainCount = 0; $UsercartMiniMainCount = 0;

		if($cartVal -> num_rows() > 0 ){ 
			foreach ($cartVal->result() as $CartRow){
				$cartAmt = $cartAmt + (($CartRow->product_shipping_cost +  ($CartRow->product_tax_cost * 0.01 * $CartRow->price ) + $CartRow->price)  * $CartRow->quantity);
				
				$cartMiniMainCount = $cartMiniMainCount + $CartRow->quantity;
				
			}
			$cartSAmt = $cartVal->row()->shipping_cost;
			$cartTAmt = $cartAmt * 0.01 * $cartVal->row()->tax;
			$grantAmt = $cartAmt + $cartSAmt + $cartTAmt ;
			
		}
		
		if($UsercartValTotl -> num_rows() > 0 ){ 
			foreach ($UsercartValTotl->result() as $UserValCartRow){
				$UsercartMiniMainCount = $UsercartMiniMainCount + $UserValCartRow->quantity;
			}
		}
		
		$countVal = $giftRes -> num_rows() + $SubcribRes -> num_rows() + $cartMiniMainCount + $UsercartMiniMainCount;
		
		$this->db->select('discountAmount');
		$this->db->from(SHOPPING_CART);
		$this->db->where('user_id = '.$userid);
		$query = $this->db->get();
		
		if($query->row()->discountAmount !=''){
			$grantAmt = $grantAmt - $query->row()->discountAmount;
		}
		
		return number_format($cartAmt,2,'.','').'|'.number_format($cartSAmt,2,'.','').'|'.number_format($cartTAmt,2,'.','').'|'.number_format($grantAmt,2,'.','').'|'.$countVal.'|'.number_format($query->row()->discountAmount,2,'.','');

	}
	
	/******************** Main User Cart Count Function  ********************/
	public function mani_user_cart_total($userid='',$sellerId=''){
		
		$giftRes = $this->cart_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
		$cartVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$SubcribRes = $this->cart_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));
		$UsercartValTotl = $this->cart_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid));
		
		$UsercartVal = $this->cart_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid,'sell_id'=>$sellerId));
		
		$cartMiniMainCount = 0;
		$UsercartAmt = 0; $UsercartShippingAmt = 0; $UsercartTaxAmt = 0; $UsercartMiniMainCount = 0;

		if($cartVal -> num_rows() > 0 ){ 
			foreach ($cartVal->result() as $CartRow){
				$cartMiniMainCount = $cartMiniMainCount + $CartRow->quantity;
			}
		}
		
		if($UsercartValTotl -> num_rows() > 0 ){ 
			foreach ($UsercartValTotl->result() as $UserValCartRow){
				$UsercartMiniMainCount = $UsercartMiniMainCount + $UserValCartRow->quantity;
			}
		}
		
		if($UsercartVal -> num_rows() > 0 ){ 
			foreach ($UsercartVal->result() as $UserCartRow){
				$UsercartAmt = $UsercartAmt + ( $UserCartRow->price * $UserCartRow->quantity);
			}
			$UsercartSAmt = $UsercartVal->row()->shipping_cost;
			$UsercartTAmt = $UsercartAmt * 0.01 * $UsercartVal->row()->tax;
			$UsergrantAmt = $UsercartAmt + $UsercartSAmt + $UsercartTAmt ;
			
		}
		
		
		
		$countVal = $giftRes -> num_rows() + $SubcribRes -> num_rows() + $cartMiniMainCount + $UsercartMiniMainCount;
		
		
		
		return number_format($UsercartAmt,2,'.','').'|'.number_format($UsercartSAmt,2,'.','').'|'.number_format($UsercartTAmt,2,'.','').'|'.number_format($UsergrantAmt,2,'.','').'|'.$countVal;

	}
	
	/******************** Main cart Coupon Function  ********************/
	public function mani_cart_coupon_sucess($userid=''){
		
		$cartVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$cartAmt = 0; $cartShippingAmt = 0; $cartTaxAmt = 0;

		if($cartVal -> num_rows() > 0 ){ 
			$k=0;
			foreach ($cartVal->result() as $CartRow){
				$cartAmt = $cartAmt + (($CartRow->product_shipping_cost +  ($CartRow->product_tax_cost * 0.01 * $CartRow->price ) + $CartRow->price)  * $CartRow->quantity);
				$newCartInd[] = $CartRow->indtotal;
				$k = $k + 1;
			}
			$cartSAmt = $cartVal->row()->shipping_cost;
			$cartTAmt = $cartAmt * 0.01 * $cartVal->row()->tax;
			$grantAmt = $cartAmt + $cartSAmt + $cartTAmt ;
			
		}
		
		$this->db->select('discountAmount');
		$this->db->from(SHOPPING_CART);
		$this->db->where('user_id = '.$userid);
		$query = $this->db->get();
		$newAmtsValues = @implode('|',$newCartInd);
		
		if($query->row()->discountAmount !=''){
			$grantAmt = $grantAmt - $query->row()->discountAmount;
		}
		
		return number_format($cartAmt,2,'.','').'|'.number_format($cartSAmt,2,'.','').'|'.number_format($cartTAmt,2,'.','').'|'.number_format($grantAmt,2,'.','').'|'.number_format($query->row()->discountAmount,2,'.','').'|'.$k.'|'.$newAmtsValues;

	}
	
	public function view_cart_details($condition = ''){
		$select_qry = "select p.*,u.full_name,u.user_name,u.thumbnail from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id ".$condition;
		$cartList = $this->ExecuteQuery($select_qry);
		return $cartList;
			
	}
	
	public function view_atrribute_details(){
		$select_qry = "select * from ".ATTRIBUTE." where status='Active'";
		return $attList = $this->ExecuteQuery($select_qry);
	
	}
	
	/******************** Coupon code cart Function  ********************/
	public function Check_Code_Val($Code = '',$amount = '',$shipamount = '', $sellerId = '', $userid = ''){
	
		
		$code = $Code;
		$amount = $amount;
		$amountOrg = $amount;
		$ship_amount = $shipamount;
		$sellerId = $sellerId;

		$CoupRes = $this->cart_model->get_all_details(COUPONCARDS,array( 'code' => $code, 'card_status' => 'not used', 'sell_id' => $sellerId,'status'=>'Active'));
		$ShopArr = $this->cart_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'sell_id' => $sellerId));
		$excludeArr = array('code','amount','shipamount');

		//echo '<pre>'; print_r($CoupRes->result_array()); die;
		if($CoupRes->num_rows() > 0){
			
			//$PayVal = $this->cart_model->get_all_details(PAYMENT,array( 'user_id' => $userid, 'coupon_id' => $CoupRes->row()->id));
			
			//if($PayVal->num_rows() == 0){
			
			
				if($ShopArr->row()->couponID == 0){

				if($CoupRes->row()->quantity > $CoupRes->row()->purchase_count){

					$today = getdate();
					$tomorrow = mktime(0,0,0,date("m"),date("d"),date("Y"));
					$currDate = date("Y-d-m", $tomorrow);
					$couponExpDate = $CoupRes->row()->dateto;

					$curVal = ($couponExpDate < date('Y-m-d'));
					if($curVal != '') {
						echo '5';
						exit();
					} 
					
					$couponStartDate = $CoupRes->row()->datefrom; 
 					$curVal = ($couponStartDate > date('Y-m-d'));
					if($curVal != '') {
						echo '9';
						exit();
					} 

						
					

						if($CoupRes->row()->price_type == 2){
								
							$percentage = $CoupRes->row()->price_value;
							$discount = ($percentage * 0.01) * $amount; 
							$totalAmt = number_format($amount-$discount,2,'.',''); 
									
							$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Cart',
											'is_coupon_used' => 'Yes',
											'total' => $totalAmt);
									$condition =array('user_id' => $userid, 'sell_id' => $sellerId);

									$this->cart_model->update_details(USER_SHOPPING_CART,$dataArr,$condition); 
									
									/*foreach($ShopArr->result() as $shopRow){
							
										$amountOrg = $shopRow->indtotal;									
										$discount = ($percentage * 0.01) * $amountOrg; 
										$IndAmt = number_format($amountOrg - $discount,2,'.',''); 
	
										$dataArr = array('indtotal' => $IndAmt);
										$condition =array('id' => $shopRow->id);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
									}*/
									
									echo 'Success|'.$CoupRes->row()->id;
									exit();
								
								}elseif($CoupRes->row()->price_type == 1){
								
									$discount = $CoupRes->row()->price_value;
									if($amount > $discount){									
										$amountOrg = number_format($amount-$discount,2,'.','');
										$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Cart',
											'is_coupon_used' => 'Yes',
											'total' => $amountOrg);
										$condition =array('user_id' => $userid);
										$this->cart_model->update_details(USER_SHOPPING_CART,$dataArr,$condition); 
										/*$newDisAmt = ($discount / $ShopArr->num_rows());
									foreach($ShopArr->result() as $shopRow){
										$amountOrg = $shopRow->indtotal;									
										$IndAmt = number_format($amountOrg - $newDisAmt,2,'.',''); 
										$dataArr = array('indtotal' => $IndAmt);
										$condition =array('id' => $shopRow->id);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
									}
*/
										
										echo 'Success|'.$CoupRes->row()->id;
										exit();

									}else{
										echo '7';
										exit();
									}								
								}
								
					
					
				} else {
					echo '6';
					exit();
				}
				}else{
					echo '2';
					exit();
				}
	
			
			
			/*}else{
				echo '2';
				exit();
			}*/
		
		
		
		}else{
			echo '1';
			exit();
		}

	}
	
	/******************** Coupon Code remove funciton   ********************/
	public function Check_Code_Val_Remove($userid = '',$sellerId = ''){
	
		$excludeArr = array('code');
	
						$dataArr = array('discountAmount' => 0, 
											'couponID' => 0,
											'couponCode' => '',
											'coupontype' => '',
											'is_coupon_used' => 'No');
						$condition =array('user_id' => $userid,'sell_id'=>$sellerId);
						$this->cart_model->update_details(USER_SHOPPING_CART,$dataArr,$condition); 
						return;

		

	}
	
	
	/******************** Coupon code cart Function  ********************/
	public function Check_Code_Val_giftcard($Code = '',$amount = '',$shipamount = '', $sellerId = '', $userid = ''){
	
		$code = $Code;
		$amount = $amount;
		$amountOrg = $amount;
		$ship_amount = $shipamount;
		$sellerId = $sellerId;

		$CoupRes = $this->cart_model->get_all_details(COUPONCARDS,array( 'code' => $code, 'card_status' => 'not used', 'status' => 'Active'));
		$ShopArr = $this->cart_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'sell_id' => $sellerId));
		$excludeArr = array('code','amount','shipamount');

		
		if($CoupRes->num_rows() > 0){

			$PayVal = $this->cart_model->get_all_details(PAYMENT,array( 'user_id' => $userid, 'coupon_id' => $CoupRes->row()->id));
			
			if($PayVal->num_rows() == 0){
			
				if($ShopArr->row()->couponID == 0){

				if($CoupRes->row()->quantity > $CoupRes->row()->purchase_count){

					$today = getdate();
					$tomorrow = mktime(0,0,0,date("m"),date("d"),date("Y"));
					$currDate = date("Y-d-m", $tomorrow);
					$couponExpDate = $CoupRes->row()->dateto; 

					$curVal = (strtotime($couponExpDate.' 23:59:59') < time());
					if($curVal != '') {
						echo '5';
						exit();
					} 

						
					if($CoupRes->row()->coupon_type == "shipping") {
						$totalamt = number_format($amount - $ship_amount,2,'.','');
						$discount ='0';
						
						$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Free Shipping',
											'is_coupon_used' => 'Yes',
											'shipping_cost' => 0,
											'total' => $totalamt);
						$condition =array('user_id' => $userid);
						$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
						echo 'Success|'.$CoupRes->row()->id.'|Shipping';
						exit();

			
					} elseif($CoupRes->row()->coupon_type == "category") {
							$newAmt = $amount;
						$catAry = @explode(',',$CoupRes->row()->category_id);
						foreach($ShopArr->result() as $shopRow){
							$shopCatArr = '';

							$shopCatArr = @explode(',',$shopRow->cate_id);
							
							$combArr = array_merge($catAry, $shopCatArr);
							$combArr1 = array_unique($combArr);
							if(count($combArr) != count($combArr1)){
							
								if($CoupRes->row()->price_type == 2){
									$percentage = $CoupRes->row()->price_value;
									$amountOrg = $shopRow->indtotal;									
									$discount = ($percentage * 0.01) * $amountOrg; 
									$IndAmt = number_format($amountOrg-$discount,2,'.','');
									$TotalAmt = $newAmt = number_format($newAmt - $discount,2,'.','');
									$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Category',
											'is_coupon_used' => 'Yes',
											'indtotal' => $IndAmt);
									$condition =array('id' => $shopRow->id);
									$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
									
									$dataArr1 = array('total' => $TotalAmt);
									$condition1 =array('user_id' => $userid);
									$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr1,$condition1); 

									
								}elseif($CoupRes->row()->price_type == 1){
								
									$discount = $CoupRes->row()->price_value;
									$amountOrg = $shopRow->indtotal;
									if($amountOrg > $discount){									
										$amountOrg = number_format($amountOrg-$discount,2,'.','');
										$TotalAmt = $newAmt = number_format($newAmt - $discount,2,'.','');
										$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Category',
											'is_coupon_used' => 'Yes',
											'indtotal' => $amountOrg);
										$condition =array('id' => $shopRow->id);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
										$dataArr1 = array('total' => $TotalAmt);
										$condition1 =array('user_id' => $userid);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr1,$condition1); 										
									}else{
										echo '7';
										exit();
									}								
								}
							}
						}
						echo 'Success|'.$CoupRes->row()->id.'|Category';
						exit();
			
					} elseif($CoupRes->row()->coupon_type== "product") {
						$PrdArr = @explode(',',$CoupRes->row()->product_id);
						$newAmt = $amount;
						foreach($ShopArr->result() as $shopRow){

							$shopPrd = $shopRow->product_id;
							
							if(in_array($shopPrd,$PrdArr)==1){
							
								if($CoupRes->row()->price_type == 2){
									
									$percentage = $CoupRes->row()->price_value;
									$amountOrg = $shopRow->indtotal;									
									$discount = ($percentage * 0.01) * $amountOrg; 
									$IndAmt = number_format($amountOrg - $discount,2,'.',''); 
									$TotalAmt = $newAmt = number_format($newAmt - $discount,2,'.','');
									$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Product',
											'is_coupon_used' => 'Yes',
											'indtotal' => $IndAmt);
									$condition =array('id' => $shopRow->id);
									
									$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
									$dataArr1 = array('total' => $TotalAmt);
									$condition1 =array('user_id' => $userid);
									$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr1,$condition1); 	

								}elseif($CoupRes->row()->price_type == 1){
								
									$discount = $CoupRes->row()->price_value;
									$amountOrg = $shopRow->indtotal;
									if($amountOrg > $discount){									
										$newDisAmt = number_format($amountOrg - $discount,2,'.','');
										$TotalAmt = $newAmt = number_format($newAmt - $discount,2,'.','');
										$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Product',
											'is_coupon_used' => 'Yes',
											'indtotal' => $newDisAmt);
										
										$condition =array('id' => $shopRow->id);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
										$dataArr1 = array('total' => $TotalAmt);
										$condition1 =array('user_id' => $userid);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr1,$condition1); 	
		
									}else{
										echo '7';
										exit();
									}								
								}
							}
						}
						echo 'Success|'.$CoupRes->row()->id.'|Product';
						exit();

					}else{

						if($CoupRes->row()->price_type == 2){
								
									$percentage = $CoupRes->row()->price_value;
									$discount = ($percentage * 0.01) * $amount; 
									$totalAmt = number_format($amount-$discount,2,'.',''); 
									
									$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Cart',
											'is_coupon_used' => 'Yes',
											'total' => $totalAmt);
									$condition =array('user_id' => $userid);

									$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
									
									/*foreach($ShopArr->result() as $shopRow){
							
										$amountOrg = $shopRow->indtotal;									
										$discount = ($percentage * 0.01) * $amountOrg; 
										$IndAmt = number_format($amountOrg - $discount,2,'.',''); 
	
										$dataArr = array('indtotal' => $IndAmt);
										$condition =array('id' => $shopRow->id);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
									}*/
									
									echo 'Success|'.$CoupRes->row()->id;
									exit();
								
								}elseif($CoupRes->row()->price_type == 1){
								
									$discount = $CoupRes->row()->price_value;
									if($amount > $discount){									
										$amountOrg = number_format($amount-$discount,2,'.','');
										$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Cart',
											'is_coupon_used' => 'Yes',
											'total' => $amountOrg);
										$condition =array('user_id' => $userid);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
										/*$newDisAmt = ($discount / $ShopArr->num_rows());
									foreach($ShopArr->result() as $shopRow){
										$amountOrg = $shopRow->indtotal;									
										$IndAmt = number_format($amountOrg - $newDisAmt,2,'.',''); 
										$dataArr = array('indtotal' => $IndAmt);
										$condition =array('id' => $shopRow->id);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
									}
*/
										
										echo 'Success|'.$CoupRes->row()->id;
										exit();

									}else{
										echo '7';
										exit();
									}								
								}
								
					}
				} else {
					echo '6';
					exit();
				}
				}else{
					echo '2';
					exit();
				}
	
			
			}else{
				echo '2';
				exit();
			}
		
		
		}elseif($GiftRes->num_rows() > 0){ 
		
			$curGiftVal = (strtotime($GiftRes->row()->expiry_date) < time());
			if($curGiftVal != '') {
					echo '8';
					exit();
			} 
			
			if($GiftRes->row()->price_value > $GiftRes->row()->used_amount){
				
				$NewGiftAmt = $GiftRes->row()->price_value - $GiftRes->row()->used_amount;
				if($amount > $NewGiftAmt){
					$amountOrg = $amountOrg - $NewGiftAmt;
					
						$dataArr = array('discountAmount' => $NewGiftAmt, 
											'couponID' => $GiftRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Gift',
											'is_coupon_used' => 'Yes',
											'total' => $totalamt);
						$condition =array('user_id' => $userid);
						$this->cart_model->update_details(SHOPPING_CART,$dataArr,$condition); 
						
						
						/*$newDisAmt = ($NewGiftAmt / $ShopArr->num_rows());
						foreach($ShopArr->result() as $shopRow){
								$amountOrg = $shopRow->indtotal;									
								$IndAmt = number_format($amountOrg - $newDisAmt,2,'.',''); 
								$dataArr = array('indtotal' => $IndAmt);
								$condition =array('id' => $shopRow->id);
								$this->cart_model->update_details(SHOPPING_CART,$dataArr,$condition); 
						}*/
					
				}else{
					$dataArr = array('discountAmount' => $amountOrg, 
											'couponID' => $GiftRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Gift',
											'is_coupon_used' => 'Yes',
											'total' => '0');
						$condition =array('user_id' => $userid);
						$this->cart_model->update_details(SHOPPING_CART,$dataArr,$condition); 
						
						/*$newDisAmt = ($NewGiftAmt / $ShopArr->num_rows());
						foreach($ShopArr->result() as $shopRow){
								$amountOrg = $shopRow->indtotal;									
								$IndAmt = number_format($amountOrg - $newDisAmt,2,'.',''); 
								$dataArr = array('indtotal' => '0');
								$condition =array('id' => $shopRow->id);
								$this->cart_model->update_details(SHOPPING_CART,$dataArr,$condition); 
						}*/
				}
				
				echo 'Success|'.$GiftRes->row()->id.'|Gift';
				exit();
			
			}else{
					echo '2';
					exit();
			}
		
		}else{
			echo '1';
			exit();
		}

	}
	
	
	/******************** Add shopping cart product transfer to  payment table Function  ********************/
	public function addPaymentCart($userid = ''){
	
	
		$this->db->select('a.*,b.city,b.state,b.country,b.postal_code');
		$this->db->from(SHOPPING_CART.' as a');
		$this->db->join(SHIPPING_ADDRESS.' as b' , 'a.user_id = b.user_id and a.user_id = "'.$userid.'" and b.id="'.$this->input->post('Ship_address_val').'"');
		$AddPayt = $this->db->get();
		
		
		if($this->session->userdata('randomNo') != '') {
			$delete = 'delete from '.PAYMENT.' where dealCodeNumber = "'.$this->session->userdata('randomNo').'" and user_id = "'.$userid.'" ';
			$this->ExecuteQuery($delete, 'delete');
			$dealCodeNumber = $this->session->userdata('randomNo');
		} else {
			$dealCodeNumber = time();
		}
		
		$insertIds = array();
		foreach ($AddPayt->result() as $result) {
					
					if($this->input->post('is_gift')==''){
						$ordergift = 0;
					}else{
						$ordergift = 1;
					}
					
				$sumTotal = number_format((($result->price + $result->product_shipping_cost + ($result->product_tax_cost * 0.01 * $result->price)) * $result->quantity ),2,'.','');
					
						$insert = ' insert into '.PAYMENT.' set 
								product_id = "'.$result->product_id.'",
								sell_id = "'.$result->sell_id.'",								
								price = "'.$result->price.'",
								quantity = "'.$result->quantity.'",
								indtotal = "'.$result->indtotal.'",
								shippingcountry = "'.$result->country.'",
								shippingid = "'.$this->input->post('Ship_address_val').'",
								shippingstate = "'.$result->state.'",
								shippingcity = "'.$result->city.'",
								shippingcost = "'.$this->input->post('cart_ship_amount').'",
								tax = "'.$this->input->post('cart_tax_amount').'",
								product_shipping_cost = "'.$result->product_shipping_cost.'",
								product_tax_cost = "'.$result->product_tax_cost.'",																												
								coupon_id  = "'.$result->couponID.'",
								discountAmount = "'.$this->input->post('discount_Amt').'",
								buyercommission_amount = "'.$this->input->post('buyercommission_amount').'",
								couponCode  = "'.$result->couponCode.'",
								coupontype = "'.$result->coupontype.'",
								sumtotal = "'.$sumTotal.'",
								user_id = "'.$result->user_id.'",
								created = now(),
								dealCodeNumber = "'.$dealCodeNumber.'",
								status = "Pending",
								payment_type = "",
								attribute_values = "'.$result->attribute_values.'",
								shipping_status = "Pending",
								total  = "'.$this->input->post('cart_total_amount').'", 
								note = "'.$this->input->post('note').'", 
								order_gift = "'.$ordergift.'", 
								inserttime = "'.time().'"';
									
						$insertIds[] = $this->cart_model->ExecuteQuery($insert, 'insert');
		}
					
						$paymtdata = array(
								'randomNo' => $dealCodeNumber,
								'randomIds' => $insertIds,
							);
						$this->session->set_userdata($paymtdata);
						
						return $insertIds;	
	}
	
	/******************** Add user shopping cart product transfer to  user payment table Function  ********************/
	public function addPaymentUserCart($userid = '',$currencyValue = ''){
		if($this->input->post('digital_item') == 'No') {
			if($this->input->post('pickup_option') =='checked'){
				$this->db->select('a.*'); 
				$this->db->from(USER_SHOPPING_CART.' as a');
				$this->db->where("a.user_id =".$userid);
				$this->db->where("a.sell_id =".$this->input->post('sell_id'));
				$AddPayt = $this->db->get();
				/* echo $this->db->last_query();
				die; */
			}else{
				$this->db->select('a.*,b.city,b.state,b.country,b.postal_code');
				$this->db->from(USER_SHOPPING_CART.' as a');
				$this->db->join(SHIPPING_ADDRESS.' as b' , 'a.user_id = b.user_id and a.user_id = "'.$userid.'" and b.id="'.$this->input->post('Ship_address_val').'"');
				$this->db->where("a.sell_id =".$this->input->post('sell_id'));
				$AddPayt = $this->db->get();
			}
		}elseif($this->input->post('digital_item') == 'Yes') {
			$this->db->select('a.*'); 
			$this->db->from(USER_SHOPPING_CART.' as a');
			#$this->db->join(SHIPPING_ADDRESS.' as b' , 'a.user_id = b.user_id and a.user_id = "'.$userid.'" and b.id="'.$this->input->post('Ship_address_val').'"','left');
			$this->db->where("a.user_id =".$userid);
			$this->db->where("a.sell_id =".$this->input->post('sell_id'));
			$AddPayt = $this->db->get();
		}else{	
			$this->db->select('a.*,b.city,b.state,b.country,b.postal_code');
			$this->db->from(USER_SHOPPING_CART.' as a');
			$this->db->join(SHIPPING_ADDRESS.' as b' , 'a.user_id = b.user_id and a.user_id = "'.$userid.'" and b.id="'.$this->input->post('Ship_address_val').'"');
			$this->db->where("a.sell_id =".$this->input->post('sell_id'));
			$AddPayt = $this->db->get();
		}		
		#echo $this->db->last_query(); 
		#echo '<pre>'; print_r($AddPayt->result()); die;
		
		if($this->session->userdata('UserrandomNo') != '') {

			$delete = 'delete from '.USER_PAYMENT.' where dealCodeNumber = "'.$this->session->userdata('UserrandomNo').'" and user_id = "'.$userid.'" ';
			$this->ExecuteQuery($delete, 'delete');
			$this->session->set_userdata('UserrandomNo', time());
			$dealCodeNumberUser = $this->session->userdata('UserrandomNo');
		} else {
			$dealCodeNumberUser = time();
		}
		// echo $lastFeatureInsertId = $this->session->userdata('UserrandomNo');die;

		$insertIds = array();
		foreach ($AddPayt->result() as $result) {
					if($this->input->post('is_gift')==''){
						$ordergift = 0;
					}else{
						$ordergift = 1;
					}
				
				$indTotal = $this->input->post('user_cart_amount');	
				$sumTotal = $this->input->post('user_cart_total_amount');
				$qury="select commision from ".USERS." where id= ".$result->sell_id;
				$commission=$this->ExecuteQuery($qury)->row()->commision;
				//echo $sumTotal;
				//echo $currencyValue;die;
				//echo $this->db->last_query();
				//print_r($commission->row()->commision);die;
				$admin_commission= $currencyValue*($sumTotal * (0.01 * $commission));
				//echo $admin_commission;die;
						$insert = ' insert into '.USER_PAYMENT.' set 
								product_id = "'.$result->product_id.'",
								sell_id = "'.$result->sell_id.'",								
								price = "'.$result->price.'",
								quantity = "'.$result->quantity.'",
								indtotal = "'.$indTotal.'",
								shippingcountry = "'.$result->country.'",
								shippingid = "'.$this->input->post('Ship_address_val').'",
								shippingstate = "'.$result->state.'",
								shippingcity = "'.$result->city.'",
								shippingcost = "'.$result->shipping_cost.'",
								tax = "'.$this->input->post('user_cart_tax_amount').'",
								product_shipping_cost = "'.$result->product_shipping_cost.'",
								product_tax_cost = "'.$result->product_tax_cost.'",																												
								coupon_id  = "'.$result->couponID.'",
								discountAmount = "'.$this->input->post('user_discount_Amt').'",
								buyercommission_amount = "'.$this->input->post('user_buyercommission_amount').'",
								couponCode  = "'.$result->couponCode.'",
								coupontype = "'.$result->coupontype.'",
								sumtotal = "'.$sumTotal.'",
								user_id = "'.$result->user_id.'",
								created = "'.date('Y-m-d H:i:s').'",
								dealCodeNumber = "'.$dealCodeNumberUser.'",
								status = "Pending",
								payment_type = "'.$this->input->post('payment_value').'",
								attribute_values = "'.$result->attribute_values.'",
								digital_files="'.$result->digital_files.'",
								shipping_status = "Pending",
								total  = "'.$this->input->post('user_cart_total_amount').'", 
								note = "'.$this->input->post('note').'", 
								order_gift = "'.$ordergift.'",
								admin_commission= "'.$admin_commission.'",
								inserttime = "'.time().'"';
									
						$insertIds[] = $this->cart_model->ExecuteQuery($insert, 'insert');
		}
		

						$paymtdata = array(
								'UserrandomNo' => $dealCodeNumberUser,
								'UserrandomIds' => $insertIds,
							);
						$this->session->set_userdata($paymtdata);
						
						return $insertIds;	
	}
	
	/******************** Add payment to subscribe table Function  ********************/
	public function addPaymentSubscribe($userid = ''){

		if($this->session->userdata('InvoiceNo') != '') {
			$InvoiceNo = $this->session->userdata('InvoiceNo');
		} else {
			$InvoiceNo = time();
		}
		
		$paymtdata = array(	'InvoiceNo' => $InvoiceNo);
		$this->session->set_userdata($paymtdata);
		
		$dataArr = array('invoice_no' => $InvoiceNo,
						'shipping_id' => $this->input->post('SubShip_address_val'),
						'shipping_cost' => $this->input->post('subcrib_ship_amount'),
						'tax' => $this->input->post('subcrib_tax_amount'),
						'total' => $this->input->post('subcrib_total_amount'),																		
							);
		$condition =array('user_id' => $userid);
		$this->cart_model->update_details(FANCYYBOX_TEMP,$dataArr,$condition); 
		
		
		return;
		
	}
	/******************** Neighbours Id  ********************/
	public function relatedPurchases($userid = ''){
		$this->db->select('other.user_id as neighbourId,product.id as productId');
		$this->db->from(USER_SHOPPING_CART.' as us');
		$this->db->join(USER_PAYMENT.' as other' , 'other.product_id = us.product_id','left');
		$this->db->join(PRODUCT.' as product' , 'other.product_id = product.id');	
		$this->db->where('us.user_id ='.$userid);
		$this->db->group_by('other.user_id');
		$resultVal= $this->db->get();
		#echo $this->db->last_query(); die;
		return $resultVal->result();
	}
	/** 
	* function to change User address in cart
	* Param int shopID 
	*/
	public function ajaxUserChangeAddressCart($shop_id){
		$shopId = 'shopId-'.$shop_id;
		$shopNewID = $this->session->userdata($shopId);
		
		if($shopNewID !=''){
			$shopCounty = 'ShopCountry-'.$shop_id;
			$shopCnty = $this->session->userdata($shopCounty);
		
			
			$ChangeAdds =  $this->cart_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $this->data['common_user_id'],'id' => $shopNewID));
			
			$this->db->select("*");
			$this->db->where(array("seller_id"=>$shop_id,"state_name"=>$ChangeAdds->row()->state));
			$this->db->from(SELLER_TAX);
			$TaxList=$this->db->get();
			
			if($TaxList->row()->tax_amount > 0){
				$taxAmt = $TaxList->row()->tax_amount;
			}else{
				$taxAmt = 0;
			}
			
			$ProductVal = $this->cart_model->get_all_details(USER_SHOPPING_CART,array( 'sell_id' => $shop_id, 'user_id' => $this->data['common_user_id']),array(array('field'=>'id','type'=>'DESC')));	
			
			//echo '<pre>'.$shopCnty; print_r($ProductVal->result());die;
			
			$s=0;
		
			foreach($ProductVal->result_array() as $prodtVal){	$shipCost = $shipCost1 = 0;
				$SubShipVal = $this->cart_model->get_all_details(SUB_SHIPPING,array( 'product_id' => $prodtVal['product_id'],'ship_name' => $ChangeAdds->row()->country), array(array('field'=>'sid','type'=>'Desc')));
				#echo '<br>'.$this->db->last_query();
				#echo '<pre>'; print_r($SubShipVal->result_array()); 
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
					//echo $this->db->last_query();
					$s++;	
				}else{
					$SubShipValNew = $this->cart_model->get_all_details(SUB_SHIPPING,array( 'product_id' => $prodtVal['product_id'],'ship_name' => 'Everywhere Else'), array(array('field'=>'sid','type'=>'Desc')));
					#echo '<br>'.$this->db->last_query();
					#echo '<pre>'; print_r($SubShipValNew->result_array()); 
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
						#echo '<br>'.$this->db->last_query();
					
					}
				
				}
					
			}
			
		}
	}
	
	/** 
	* 
	* User Ajax Change address for cart page function  
	*
	**/	
	public function ajaxUserShoppingCart($userid=''){
		if($userid != ''){
			$this->db->select('sell_id');
			$this->db->from(USER_SHOPPING_CART);
			$this->db->where(array('user_id'=>$userid));
			$this->db->group_by('sell_id');		
			$UsercartVal = $this->db->get();
			
			if($UsercartVal->num_rows()>0){
				foreach($UsercartVal->result() as $cVal){
					$seller_id=$cVal->sell_id;
					$shopId = 'shopId-'.$seller_id;
					$add_id=$this->session->userdata($shopId);
					if($add_id!=''){
						$ChangeAdds =  $this->cart_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $this->data['common_user_id'],'id' => $add_id));
						$shopCounty = 'ShopCountry-'.$seller_id;
						$this->session->unset_userdata($shopCounty, '');
						$this->session->set_userdata($shopCounty,$ChangeAdds->row()->country);
						
						$this->db->select("*");
						$this->db->where(array("seller_id"=>$seller_id,"state_name"=>$ChangeAdds->row()->state));
						$this->db->from(SELLER_TAX);
						$TaxList=$this->db->get();
						if($TaxList->row()->tax_amount > 0){
							$taxAmt = $TaxList->row()->tax_amount;
						}else{
							$taxAmt = 0;
						}
						
						$ProductVal = $this->cart_model->get_all_details(USER_SHOPPING_CART,array( 'sell_id' => $seller_id, 'user_id' => $this->data['common_user_id']),array(array('field'=>'id','type'=>'Asc')));				
						$s=0;
						
						
						foreach($ProductVal->result_array() as $prodtVal){
							$shipCost = $shipCost1 = 0;
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
								$this->cart_model->update_details(USER_SHOPPING_CART,$dataArrShip,$conditionShip); 
								$s++;	
							}else{
								$SubShipValNew = $this->cart_model->get_all_details(SUB_SHIPPING,array( 'product_id' => $prodtVal['product_id'],'ship_name' => 'Everywhere Else'), array(array('field'=>'ship_id','type'=>'Desc')));
								if($SubShipValNew->num_rows() > 0){
									if($s==0){
										$shipCost1 = $SubShipValNew->row()->ship_cost;
									}else{
										$shipCost1 = $SubShipValNew->row()->ship_other_cost;
									}
									$newshipCost1 = number_format( ($prodtVal['quantity'] * $shipCost1),2,'.','');
									$conditionShip1 = array('id' => $prodtVal['id']);
									$dataArrShip1 = array('product_shipping_cost' => $shipCost1,'shipping_cost' => $newshipCost1,'shipping'=>'Yes','tax'=>$taxAmt);	
									$this->cart_model->update_details(USER_SHOPPING_CART,$dataArrShip1,$conditionShip1); 
									$s++;	
								}else{
										$conditionShip1 = array('id' => $prodtVal['id']);
										$dataArrShip1 = array('product_shipping_cost' => '0.00','shipping_cost' => '0.00','shipping'=>'No','tax'=>'0.00');	
										$this->cart_model->update_details(USER_SHOPPING_CART,$dataArrShip1,$conditionShip1); 
								}
							}	
						}
					}
				}
			}	
		}
	}
	
}


?>