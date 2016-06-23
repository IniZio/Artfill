<?php 
$this->load->view('site/templates/header.php');
?>
<?php // echo 'test:'; echo $this->data['buyer_commission'] ?>
<?php if ($CheckoutVal->row()->payment_type == 'payon') { 
    echo '<script async src="'.$payon['script_url'].'"></script>';
    echo '	<script>
	    var wpwlOptions = {
	        style: "plain"
	    }
	</script>	';
} ?>
<link rel="stylesheet" media="all" type="text/css" href="css/default/site/developer.css">
<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
<div id="profile_div">  
<section>
  <div class="main">
    <div class="container" style="margin:0">
      
      <div class="cart_items">
        <h2>
          <?php if($this->lang->line('cart_pay_mthd') != '') { echo stripslashes($this->lang->line('cart_pay_mthd')); } else echo "Payment Method"; ?>
        </h2>
        <div class="clear"></div>
        <div class="cart-list chept2">
          <?php 
		  $paypalProcess = unserialize($paypal_ipn_settings['settings']); 
		  $StripeValDet = unserialize(StripeDetails); 
		  $StripeVal = unserialize($StripeValDet['settings']);
		  
		   if($this->uri->segment(2)=='cart' || $this->uri->segment(2)=='gift' || $this->uri->segment(2)=='sellercart' ){ ?>
          <ol class="cart-order-depth" style="position:relative;">
            <?php 
        $payMethodCount = 1;
        ?>
			<?php if ($CheckoutVal->row()->payment_type == 'pesapal'){?>
				<li class="depth2" id="dep2" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:pesapal();" class="current">
				<?php if($this->lang->line('checkout_pesapal') != '') { echo stripslashes($this->lang->line('checkout_pesapal')); } else echo "PesaPal"; ?>
				</a></li>
            <?php } if ($CheckoutVal->row()->payment_type == 'Paypal Adaptive'){?>
            <li class="depth1 current" id="dep1" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:paypal();" class="current">
              <?php if($this->lang->line('checkout_paypaladaptive') != '') { echo stripslashes($this->lang->line('checkout_paypaladaptive')); } else echo "Paypal Adaptive"; ?>
              </a></li>
            <?php 
            } if ($CheckoutVal->row()->payment_type == 'Paypal'){?>
            <li class="depth1 current" id="dep1" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:paypal();" class="current">
              <?php if($this->lang->line('checkout_paypal') != '') { echo stripslashes($this->lang->line('checkout_paypal')); } else echo "Paypal"; ?>
              </a></li>
            <?php $payMethodCount++; }

		 if ($CheckoutVal->row()->payment_type == 'Credit-Card'){?>
            <li class="depth2" id="dep2" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:creditcard();">
              <?php if($this->lang->line('checkout_credit_card') != '') { echo stripslashes($this->lang->line('checkout_credit_card')); } else echo "Credit Card"; ?>
              </a></li>
            <?php 
        
        }
		 if ($CheckoutVal->row()->payment_type == 'COD'){?>
            <li class="depth2" id="dep2" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:creditcard();">
              <?php if($this->lang->line('shop_withdraw_cod') != '') { echo stripslashes($this->lang->line('shop_withdraw_cod')); } else echo "Cash on Delivery"; ?>
              </a></li>
            <?php 
        
        }
		if ($CheckoutVal->row()->payment_type == 'Stripe'){?>
            <li class="depth2" id="dep2" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:stripe();">
              <?php if($this->lang->line('checkout_credit_stripe') != '') { echo stripslashes($this->lang->line('checkout_credit_stripe')); } else echo "Stripe"; ?>
              </a></li>
            <?php 
        
        }

         if ($CheckoutVal->row()->payment_type == 'twocheckout'){?>
            <li class="depth2" id="dep2" style="background:none;"><span><?php echo $payMethodCount;?>
            </span><a onclick="javascript:twocheckout();">
              <?php if($this->lang->line('checkout_twochecout') != '') { echo stripslashes($this->lang->line('checkout_twocheckout')); } else echo "Two Checkout"; ?>
              </a></li>
            <?php 
        
        }
		 if ($CheckoutVal->row()->payment_type == 'Payu'){?>
            <li class="depth2" id="dep2" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:creditcard();">
              <?php if($this->lang->line('checkout_payu') != '') { echo stripslashes($this->lang->line('checkout_payu')); } else echo "Payu"; ?>
              </a></li>
            <?php 
        
        }
		
		if ($this->input->post('gift_payment_value') == 'Paypal'){?>
            <li class="depth1 current" id="dep1" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:paypal();" class="current">
              <?php if($this->lang->line('checkout_paypal') != '') { echo stripslashes($this->lang->line('checkout_paypal')); } else echo "Paypal"; ?>
              </a></li>
            <?php 
        $payMethodCount++;
        }
		
		if($this->input->post('gift_payment_value') == 'Credit-Card'){?>
            <li class="depth2" id="dep2" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:creditcard();">
              <?php if($this->lang->line('checkout_credit_card') != '') { echo stripslashes($this->lang->line('checkout_credit_card')); } else echo "Credit Card"; ?>
              </a></li>
       <?php }
       
       if ($CheckoutVal->row()->payment_type == 'userCredits'){?>
                   	<li class="depth1 current" id="dep1" style="background:none; width:250px;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:paypal();" class="current">
                    <?php echo artfill_lg('lg_usercredits','User Credits');?>
                     </a></li>
               <?php 
               }
	    ?>
          </ol>
          <?php } ?>
          <div class="clear"></div>
          <?php if($this->uri->segment(2)=='sellercart' ){
			
			
			$UsercheckAmt = @explode('|',$UserCheckoutResults);
			#echo '<pre>'; print_r($UsercheckAmt[3]);die;
			 if($UsercheckAmt[3] > 0){
			#echo "in 2st if";
        
        if (($CheckoutVal->row()->payment_type == 'twocheckout') || ($this->input->post('gift_payment_value') == 'twocheckout')){ ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="PayuPay"> 
		  <script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
            <script>$(document).ready(function(){ //alert("validate");
				$("#twocheckout").validate();
				
				$.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
				
				
				$.validator.addMethod("ValidZipCode", function( value, element ) {  var result = this.optional(element) || value.length >= 3;
				if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);
					 var successCallback = function(data) {
								//alert("success");
								var myForm = document.getElementById('twocheckout');
								// Set the token as the value for the token input
								myForm.token.value = data.response.token.token;
								//alert(data.response.token.token);
								// IMPORTANT: Here we call `submit()` on the form element directly instead of using jQuery to prevent and infinite token request loop.
								myForm.submit();
							};
								var errorCallback = function(data) {
							//alert("error");
							if (data.errorCode === 200) {tokenRequest();} else {alert(data.errorMsg);}
						};
						var tokenRequest = function() {
							
							// Setup token request arguments
							var args = {
									sellerId: $("#SellerId").val(),
									publishableKey: $("#PublishableKey").val(),
									ccNo: $("#ccNo").val(),
									cvv: $("#cvv").val(),
									expMonth: $("#expMonth").val(),
									expYear: $("#expYear").val()
							};
							//alert(args);	
							
							var $form = $('#twocheckout');
							if($form.find('label.error:visible').length==0){							
								TCO.requestToken(successCallback, errorCallback, args);
							}
						};
					var mode=$("#Mode").val();
					TCO.loadPubKey(mode); 
					//
					$(".twocheckout").submit(function(e) {
						//alert("dfsgsdfg");
						//alert(mode);
						tokenRequest();			
						return false;			
					});
			});
		 
        </script>

				<?php
					$twocheckoutDetailsVal = unserialize($this->config->item('payment_4'));
					$twocheckoutvalue = unserialize($twocheckoutDetailsVal['settings']);
					//echo "<pre>";print_r($twocheckoutvalue);
//echo "mode";print_r($twocheckoutvalue['sellerId']);die;
				?>
		
            
            <form name="twocheckout" class="twocheckout" id="twocheckout" method="post" enctype="multipart/form-data" action="site/checkout/Paymenttwocheckout"  autocomplete="off">
				<input id="token" name="token" type="hidden" value="">
				<input id="Mode" name="Mode" type="hidden" value="<?php echo$twocheckoutvalue['mode'];?>">
				<input id="PublishableKey" name="PublishableKey" type="hidden" value="<?php echo $twocheckoutvalue['publishableKey'];?>">
				<input id="SellerId" name="SellerId" type="hidden" value="<?php echo $twocheckoutvalue['sellerId'];?>">
				<input id="PrivateKey" name="PrivateKey" type="hidden" value="<?php echo $twocheckoutvalue['privateKey'];?>">
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt class="payment-card"><b>
                      <?php if($this->lang->line('checkout_cc_info') != '') { echo stripslashes($this->lang->line('checkout_cc_info')); } else echo "Credit Card Information"; ?>
                      </b> <span>
                      <?php if($this->lang->line('checkout_visa_mster') != '') { echo stripslashes($this->lang->line('checkout_visa_mster')); } else echo "Visa, MasterCard, Discover or American Express"; ?>
                      </span></dt>
                    <!--<dd class="comment"><b>*</b>  = <?php if($this->lang->line('checkout_mand_fields') != '') { echo stripslashes($this->lang->line('checkout_mand_fields')); } else echo "Mandatory fields"; ?></dd>-->
                    <div class="clear"></div>
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $shipValDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
                      <label for="payment-card-number">
                        <?php if($this->lang->line('checkout_card_no') != '') { echo stripslashes($this->lang->line('checkout_card_no')); } else echo "Card Number"; ?>
                        <b>*</b></label>
                      <input id="ccNo" name="ccNo" autocomplete="off" class="required" maxlength="16" size="16" type="text" />
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_enter_cardno') != '') { echo stripslashes($this->lang->line('checkout_enter_cardno')); } else echo "Please enter valid card number"; ?>.</p><?php */?>
                    </dd>
                    <dd>
                      <label for="payment-card-number">
                        <?php if($this->lang->line('checkout_card_type') != '') { echo stripslashes($this->lang->line('checkout_card_type')); } else echo "Card Type"; ?>
                        <b>*</b></label>
                      <select id="cardType" name="cardType" class="select-round select-white select-country selectBox required">
                        <option value="Visa"><?php if($this->lang->line('user_visa') != '') { echo stripslashes($this->lang->line('user_visa')); } else echo 'Visa'; ?></option>
                        <option value="Amex"><?php if($this->lang->line('user_amrican_exp') != '') { echo stripslashes($this->lang->line('user_amrican_exp')); } else echo 'American Express'; ?></option>
                        <option value="MasterCard"><?php if($this->lang->line('user_master_card') != '') { echo stripslashes($this->lang->line('user_master_card')); } else echo 'Master Card'; ?></option>
                        <option value="Discover"><?php if($this->lang->line('user_discover') != '') { echo stripslashes($this->lang->line('user_discover')); } else echo 'Discover'; ?></option>
                      </select>
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_select_card') != '') { echo stripslashes($this->lang->line('checkout_select_card')); } else echo "Please select card"; ?>.</p><?php */?>
                    </dd>
                    <!--<dd class="select-card">
                                    <label for="payment-card-type1" class="payment-card-type1"></label> 
                                    <label for="payment-card-type2" class="payment-card-type2"></label>
                                    <label for="payment-card-type3" class="payment-card-type3"></label>
                                    <label for="payment-card-type4" class="payment-card-type4"></label>
                                    <p class="error">Please select card.</p>
                                </dd>-->
                    
                    <dd>
                      <label for="payment-card-expiration">
                        <?php if($this->lang->line('checkout_exp_date') != '') { echo stripslashes($this->lang->line('checkout_exp_date')); } else echo "Expiration Date"; ?>
                        <b>*</b></label>
                      <?php $Sel ='selected="selected"';  ?>
                      <select id="expMonth" name="expMonth" class="select-round select-white select-date selectBox required">
                        <option value="01" <?php if(date('m')=='01'){ echo $Sel;} ?>>01</option>
                        <option value="02" <?php if(date('m')=='02'){ echo $Sel;} ?>>02</option>
                        <option value="03" <?php if(date('m')=='03'){ echo $Sel;} ?>>03</option>
                        <option value="04" <?php if(date('m')=='04'){ echo $Sel;} ?>>04</option>
                        <option value="05" <?php if(date('m')=='05'){ echo $Sel;} ?>>05</option>
                        <option value="06" <?php if(date('m')=='06'){ echo $Sel;} ?>>06</option>
                        <option value="07" <?php if(date('m')=='07'){ echo $Sel;} ?>>07</option>
                        <option value="08" <?php if(date('m')=='08'){ echo $Sel;} ?>>08</option>
                        <option value="09" <?php if(date('m')=='09'){ echo $Sel;} ?>>09</option>
                        <option value="10" <?php if(date('m')=='10'){ echo $Sel;} ?>>10</option>
                        <option value="11" <?php if(date('m')=='11'){ echo $Sel;} ?>>11</option>
                        <option value="12" <?php if(date('m')=='12'){ echo $Sel;} ?>>12</option>
                      </select>
                      <select id="expYear" name="expYear" class="select-round select-white select-date selectBox required">
                        <?php for($i=date('Y');$i< (date('Y') + 30);$i++){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="cvv">
                        <?php if($this->lang->line('checkout_security_code') != '') { echo stripslashes($this->lang->line('checkout_security_code')); } else echo "Security Code"; ?>
                      </label>
                      <input style="width:63px;" id="cvv" autocomplete="off" name="cvv" class="input-code required number" type="password">
                      <!--<a href="#" class="tooltip" onClick="$('.card-back').show(); return false;"><?php if($this->lang->line('checkout_what_this') != '') { echo stripslashes($this->lang->line('checkout_what_this')); } else echo "What is this?"; ?></a>-->
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_enter_sc') != '') { echo stripslashes($this->lang->line('checkout_enter_sc')); } else echo "Please enter security code"; ?>.</p><?php */?>
                      <dl class="card-back">
                        <dt>
                          <?php /*if($this->lang->line('checkout_cvc_cvs') != '') { echo stripslashes($this->lang->line('checkout_cvc_cvs')); } else echo "Security Code (CVC or CVS)";*/ ?>
                        </dt>
                        <dd> <!--<img src="images/card-back.gif" alt="">-->
                          <?php /*if($this->lang->line('checkout_last_three') != '') { echo stripslashes($this->lang->line('checkout_last_three')); } else echo "Last three digits on the back of your card is the CVC or CVV number"; ?>.<br>&nbsp;<br><?php if($this->lang->line('checkout_for_ameri') != '') { echo stripslashes($this->lang->line('checkout_for_ameri')); } else echo "For American Express there is a four digit code on the front";*/ ?>
                          . <a href="#" onClick="$('.card-back').hide();return false;" title="Close"></a> </dd>
                      </dl>
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>
                      <?php if($this->lang->line('shop_billing_address') != '') { echo stripslashes($this->lang->line('shop_billing_address')); } else echo "Billing Address"; ?>
                      </b> <span>
                      <?php if($this->lang->line('shop_enter_billing_address') != '') { echo stripslashes($this->lang->line('shop_enter_billing_address')); } else echo "Enter your billing address"; ?>
                      </span></dt>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $shipValDetails->row()->address1; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $shipValDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $shipValDetails->row()->city; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b>*</b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $shipValDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
                        <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $shipValDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $shipValDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $shipValDetails->row()->phone; ?>">
                    </dd>
                  </dl>
                  <!--p class="payment-save-check">
                            <input type="checkbox" id="payment-save-card"  />

                            <label for="payment-save-card">Save your credit card details for any future orders</label>
                            <span class="error">Please check saving your credit card.</span>
                        </p-->
                  
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure  Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">

                            <dt>Ship to</dt>
                            <dd>
                                <p><br /><br />  </p>
                            </dd>
                        </dl-->
                  
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { echo stripslashes($this->lang->line('checkout_order')); } else echo "Order"; ?>
                    </dt>
                    <dd class="amount_detail2">
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
							  <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b> TESTArtfill
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
 
 
                  <?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>

                    <?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Reddem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>                    </div>
                    <?php }} ?>

                    
                    
                    
                </div>

                <input id="cart_price" name="cart_price" value="<?php echo number_format($UsercheckAmt[0],2,'.',''); ?>" type="hidden">
                
               <!-- <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="Enter your redeem code" readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>-->
                
		        <input id="ship_price" name="ship_price" value="<?php echo number_format($UsercheckAmt[1],2,'.',''); ?>" type="hidden">
                <input id="tax_price" name="tax_price" value="<?php echo number_format($UsercheckAmt[2],2,'.',''); ?>" type="hidden">
                <input id="discount_price" name="discount_price" value="<?php echo number_format($UsercheckAmt[5],2,'.',''); ?>" type="hidden">
                <input id="gift_discount_price" name="gift_discount_price" value="<?php echo number_format($UsercheckAmt[6],2,'.',''); ?>" type="hidden">
                <input id="cart_less_price" name="cart_less_price" value="<?php echo number_format($UsercheckAmt[7],2,'.',''); ?>" type="hidden">
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden"  />
                <input type="hidden" name="shipping_id" id="shipping_id" value="<?php echo $shipValDetails->row()->id; ?>" />
                <input id="email" name="email" value="<?php echo $this->session->userdata('shopsy_session_user_email'); ?>" type="hidden">
                <?php //if ($authorize_net_settings['status'] == 'Enable'){ ?>
                <input type="hidden" name="creditvalue" id="creditvalue" value="authorize" />
                <?php //}elseif($paypal_credit_card_settings['status'] == 'Enable'){ ?>
               <?php /*?> <input type="hidden" name="creditvalue" id="creditvalue" value="paypaldodirect" /><?php */?>
                <?php //} ?>
                <input name="CreditSubmit" id="CreditSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
            
          <?php }
			
			 if ($CheckoutVal->row()->payment_type == 'Payu'){ ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="PayuPay"> 
            <script>$(document).ready(function(){	$("#UserPaymentUForm").validate();
					$.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
				
					$.validator.addMethod("ValidZipCode", function( value, element ) {	var result = this.optional(element) || value.length >= 3;
					if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);});
		   	</script>
            <form name="UserPaymentPayUForm" id="UserPaymentUForm" method="post" enctype="multipart/form-data" action="site/checkout/UserPaymentPayuProcess"  autocomplete="off">
              <?php /*?><input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $SellerDetails->row()->PayPal_mode; ?>"  />
              <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $SellerDetails->row()->PayPal_email; ?>"  /><?php */?>
              <?php $sell=$SellerDetails->result_array(); ?>
              <input type="hidden" name="payumode" id="payumode" value="<?php echo $sell[0]['payu_mode']; ?>"  />
                <input type="hidden" name="seller_id" id="seller_id" value="<?php echo $sell[0]['seller_id']; ?>"  />
              <input type="hidden" name="payuEmail" id="payuEmail" value="<?php echo $sell[0]['payu_email']; ?>"  />
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt class="chekout_heading"><b>
                      <?php if($this->lang->line('shop_billing') != '') { echo stripslashes($this->lang->line('shop_billing')); } else echo "Billing Address"; ?>
                      </b> <small>
                     <?php if($this->lang->line('shop_enter_billing_address') != '') { echo stripslashes($this->lang->line('shop_enter_billing_address')); } else echo "Enter your billing address"; ?>
                      </small></dt>
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $shipValDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $shipValDetails->row()->address1; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $shipValDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $shipValDetails->row()->city; ?>">
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>&nbsp;</b> <small>&nbsp;</small></dt>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b>*</b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $shipValDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
                        <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $shipValDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $shipValDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $shipValDetails->row()->phone; ?>">
                    </dd>
                  </dl>
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">

                        <dt>Ship to</dt>
                        <dd>
                            <p><br /><br />  </p>
                        </dd>
                    </dl-->
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { 
					       echo stripslashes($this->lang->line('checkout_order')); 
						 } 
						 else echo "Order"; ?>
                    </dt>
                    <dd>
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                  	<?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
						
			
					<?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left"placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
                    <?php }} ?>                    
                </div>

                <input id="cart_price" name="cart_price" value="<?php echo number_format($UsercheckAmt[0],2,'.',''); ?>" type="hidden">
		        <input id="ship_price" name="ship_price" value="<?php echo number_format($UsercheckAmt[1],2,'.',''); ?>" type="hidden">
                <input id="tax_price" name="tax_price" value="<?php echo number_format($UsercheckAmt[2],2,'.',''); ?>" type="hidden">
                <input id="discount_price" name="discount_price" value="<?php echo number_format($UsercheckAmt[5],2,'.',''); ?>" type="hidden">
                <input id="gift_discount_price" name="gift_discount_price" value="<?php echo number_format($UsercheckAmt[6],2,'.',''); ?>" type="hidden">
                <input id="cart_less_price" name="cart_less_price" value="<?php echo number_format($UsercheckAmt[7],2,'.',''); ?>" type="hidden">
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden">
                <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                <input name="PayuSubmit" id="PayuSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
         
          <?php }
		  
			if($CheckoutVal->row()->payment_type == 'pesapal'){?>
			<div class="cart-payment-wrap card-payment new-card-payment" id="PaypalPay"> 
            <script>$(document).ready(function(){	$("#UserPaymentPaypalAdptForm").validate();
					$.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
				
					$.validator.addMethod("ValidZipCode", function( value, element ) {	var result = this.optional(element) || value.length >= 3;
					if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);});
		   	</script>
            <form name="pesapalform" id="pesapalform" method="post" enctype="multipart/form-data" action="site/checkout/Pesapal"  autocomplete="off">
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt class="chekout_heading"><b>
                      <?php if($this->lang->line('shop_billing_address') != '') { echo stripslashes($this->lang->line('shop_billing_address')); } else echo "Billing Address"; ?>
                      </b> <small>
                      <?php if($this->lang->line('shop_enter_billing_address') != '') { echo stripslashes($this->lang->line('shop_enter_billing_address')); } else echo "Enter your billing address"; ?>
                      </small></dt>
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $shipValDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $shipValDetails->row()->address1; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $shipValDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $shipValDetails->row()->city; ?>">
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>&nbsp;</b> <small>&nbsp;</small></dt>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b>*</b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $shipValDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
                        <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $shipValDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $shipValDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $shipValDetails->row()->phone; ?>">
                    </dd>
                  </dl>
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { 
					       echo stripslashes($this->lang->line('checkout_order')); 
						 } 
						 else echo "Order"; ?>
                    </dt>
                    <dd>
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                  	<?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>"  readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
						
			
					<?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
                    <?php }} ?>                    
                </div>
				
				<input type="hidden" name="seller_id" id="seller_id" value="<?php echo $CheckoutVal->row()->sell_id; ?>" >
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden">
                <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                <input name="PaypalSubmit" id="PaypalSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />  
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
			<?php }
				#echo $CheckoutVal->row()->payment_type ;die;
			 if ($CheckoutVal->row()->payment_type == 'BrainTree'){ ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="Brain_Tree"> 
           <?php 
				$Auth_Details=unserialize($this->config->item('payment_5'));
				$Setting_Details = unserialize($Auth_Details['settings']);
			?>
			<script>$(document).ready(function(){	$("#BrainTreeForm").validate();
					  $.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
				
					  $.validator.addMethod("ValidZipCode", function( value, element ) {
								var result = this.optional(element) || value.length >= 3;
												if (!result) {
													return false;
												}
												else{
												return true;
												}
							}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);
					  
					   });</script>
           <form name="BrainTreeForm" id="BrainTreeForm" method="post" enctype="multipart/form-data" action="site/checkout/PaymentCreditAjax" autocomplete="off">
              <input type="hidden" name="authorize_mode" id="authorize_mode" value="<?php echo $SellerDetails->row()->authorize_mode; ?>"  />
              <input type="hidden" name="authorize_id" id="authorize_id" value="<?php echo $SellerDetails->row()->authorize_id; ?>"  />
              <input type="hidden" name="authorize_key" id="authorize_key" value="<?php echo $SellerDetails->row()->authorize_key; ?>"  />
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt class="payment-card"><b>
                      <?php if($this->lang->line('checkout_cc_info') != '') { echo stripslashes($this->lang->line('checkout_cc_info')); } else echo "Credit Card Information"; ?>
                      </b> <span>
                      <?php if($this->lang->line('checkout_visa_mster') != '') { echo stripslashes($this->lang->line('checkout_visa_mster')); } else echo "Visa, MasterCard, Discover or American Express"; ?>
                      </span></dt>
                    <!--<dd class="comment"><b>*</b>  = <?php if($this->lang->line('checkout_mand_fields') != '') { echo stripslashes($this->lang->line('checkout_mand_fields')); } else echo "Mandatory fields"; ?></dd>-->
                    <div class="clear"></div>
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $shipValDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
                      <label for="payment-card-number">
                        <?php if($this->lang->line('checkout_card_no') != '') { echo stripslashes($this->lang->line('checkout_card_no')); } else echo "Card Number"; ?>
                        <b>*</b></label>
                      <input id="cardNumber" name="cardNumber" autocomplete="off" class="required number" maxlength="16" size="16" type="text" />
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_enter_cardno') != '') { echo stripslashes($this->lang->line('checkout_enter_cardno')); } else echo "Please enter valid card number"; ?>.</p><?php */?>
                    </dd>
                    <dd>
                      <label for="payment-card-number">
                        <?php if($this->lang->line('checkout_card_type') != '') { echo stripslashes($this->lang->line('checkout_card_type')); } else echo "Card Type"; ?>
                        <b>*</b></label>
                      <select id="cardType" name="cardType" class="select-round select-white select-country selectBox required">
                        <option value="Visa"><?php if($this->lang->line('user_visa') != '') { echo stripslashes($this->lang->line('user_visa')); } else echo 'Visa'; ?></option>
                        <option value="Amex"><?php if($this->lang->line('user_amrican_exp') != '') { echo stripslashes($this->lang->line('user_amrican_exp')); } else echo 'American Express'; ?></option>
                        <option value="MasterCard"><?php if($this->lang->line('user_master_card') != '') { echo stripslashes($this->lang->line('user_master_card')); } else echo 'Master Card'; ?></option>
                        <option value="Discover"><?php if($this->lang->line('user_discover') != '') { echo stripslashes($this->lang->line('user_discover')); } else echo 'Discover'; ?></option>
                      </select>
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_select_card') != '') { echo stripslashes($this->lang->line('checkout_select_card')); } else echo "Please select card"; ?>.</p><?php */?>
                    </dd>
                    <!--<dd class="select-card">
                                    <label for="payment-card-type1" class="payment-card-type1"></label> 
                                    <label for="payment-card-type2" class="payment-card-type2"></label>
                                    <label for="payment-card-type3" class="payment-card-type3"></label>
                                    <label for="payment-card-type4" class="payment-card-type4"></label>
                                    <p class="error">Please select card.</p>
                                </dd>-->
                    
                    <dd>
                      <label for="payment-card-expiration">
                        <?php if($this->lang->line('checkout_exp_date') != '') { echo stripslashes($this->lang->line('checkout_exp_date')); } else echo "Expiration Date"; ?>
                        <b>*</b></label>
                      <?php $Sel ='selected="selected"';  ?>
                      <select id="CCExpDay" name="CCExpDay" class="select-round select-white select-date selectBox required">
                        <option value="01" <?php if(date('m')=='01'){ echo $Sel;} ?>>01</option>
                        <option value="02" <?php if(date('m')=='02'){ echo $Sel;} ?>>02</option>
                        <option value="03" <?php if(date('m')=='03'){ echo $Sel;} ?>>03</option>
                        <option value="04" <?php if(date('m')=='04'){ echo $Sel;} ?>>04</option>
                        <option value="05" <?php if(date('m')=='05'){ echo $Sel;} ?>>05</option>
                        <option value="06" <?php if(date('m')=='06'){ echo $Sel;} ?>>06</option>
                        <option value="07" <?php if(date('m')=='07'){ echo $Sel;} ?>>07</option>
                        <option value="08" <?php if(date('m')=='08'){ echo $Sel;} ?>>08</option>
                        <option value="09" <?php if(date('m')=='09'){ echo $Sel;} ?>>09</option>
                        <option value="10" <?php if(date('m')=='10'){ echo $Sel;} ?>>10</option>
                        <option value="11" <?php if(date('m')=='11'){ echo $Sel;} ?>>11</option>
                        <option value="12" <?php if(date('m')=='12'){ echo $Sel;} ?>>12</option>
                      </select>
                      <select id="CCExpMnth" name="CCExpMnth" class="select-round select-white select-date selectBox required">
                        <?php for($i=date('Y');$i< (date('Y') + 30);$i++){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-card-security">
                        <?php if($this->lang->line('checkout_security_code') != '') { echo stripslashes($this->lang->line('checkout_security_code')); } else echo "Security Code"; ?>
                      </label>
                      <input style="width:63px;" id="payment-card-security" autocomplete="off" name="creditCardIdentifier" class="input-code required number" type="password">
                      <!--<a href="#" class="tooltip" onClick="$('.card-back').show(); return false;"><?php if($this->lang->line('checkout_what_this') != '') { echo stripslashes($this->lang->line('checkout_what_this')); } else echo "What is this?"; ?></a>-->
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_enter_sc') != '') { echo stripslashes($this->lang->line('checkout_enter_sc')); } else echo "Please enter security code"; ?>.</p><?php */?>
                      <dl class="card-back">
                        <dt>
                          <?php /*if($this->lang->line('checkout_cvc_cvs') != '') { echo stripslashes($this->lang->line('checkout_cvc_cvs')); } else echo "Security Code (CVC or CVS)";*/ ?>
                        </dt>
                        <dd> <!--<img src="images/card-back.gif" alt="">-->
                          <?php /*if($this->lang->line('checkout_last_three') != '') { echo stripslashes($this->lang->line('checkout_last_three')); } else echo "Last three digits on the back of your card is the CVC or CVV number"; ?>.<br>&nbsp;<br><?php if($this->lang->line('checkout_for_ameri') != '') { echo stripslashes($this->lang->line('checkout_for_ameri')); } else echo "For American Express there is a four digit code on the front";*/ ?>
                          . <a href="#" onClick="$('.card-back').hide();return false;" title="Close"></a> </dd>
                      </dl>
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>
                      <?php if($this->lang->line('shop_billing_address') != '') { echo stripslashes($this->lang->line('shop_billing_address')); } else echo "Billing Address"; ?>
                      </b> <span>
                      <?php if($this->lang->line('shop_enter_billing_address') != '') { echo stripslashes($this->lang->line('shop_enter_billing_address')); } else echo "Enter your billing address"; ?>
                      </span></dt>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $shipValDetails->row()->address1; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $shipValDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $shipValDetails->row()->city; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b>*</b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $shipValDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
                        <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $shipValDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $shipValDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $shipValDetails->row()->phone; ?>">
                    </dd>
                  </dl>
                  <!--p class="payment-save-check">
                            <input type="checkbox" id="payment-save-card"  />

                            <label for="payment-save-card">Save your credit card details for any future orders</label>
                            <span class="error">Please check saving your credit card.</span>
                        </p-->
                  
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">

                            <dt>Ship to</dt>
                            <dd>
                                <p><br /><br />  </p>
                            </dd>
                        </dl-->
                  
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { echo stripslashes($this->lang->line('checkout_order')); } else echo "Order"; ?>
                    </dt>
                    <dd class="amount_detail2">
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
							  <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                  
                  <?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>"  readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
						
			
					<?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>                    </div>
                    <?php }} ?>
                    
                    
                    
                    
                </div>

                <input id="cart_price" name="cart_price" value="<?php echo number_format($UsercheckAmt[0],2,'.',''); ?>" type="hidden">
		        <input id="ship_price" name="ship_price" value="<?php echo number_format($UsercheckAmt[1],2,'.',''); ?>" type="hidden">
                <input id="tax_price" name="tax_price" value="<?php echo number_format($UsercheckAmt[2],2,'.',''); ?>" type="hidden">
                <input id="discount_price" name="discount_price" value="<?php echo number_format($UsercheckAmt[5],2,'.',''); ?>" type="hidden">
                <input id="gift_discount_price" name="gift_discount_price" value="<?php echo number_format($UsercheckAmt[6],2,'.',''); ?>" type="hidden">
                <input id="cart_less_price" name="cart_less_price" value="<?php echo number_format($UsercheckAmt[7],2,'.',''); ?>" type="hidden">
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden"  />
                <input type="hidden" name="shipping_id" id="shipping_id" value="<?php echo $shipValDetails->row()->id; ?>" />
                <input id="email" name="email" value="<?php echo $this->session->userdata('shopsy_session_user_email'); ?>" type="hidden">
                <?php //if ($authorize_net_settings['status'] == 'Enable'){ ?>
                <input type="hidden" name="creditvalue" id="creditvalue" value="authorize" />
                <?php //}elseif($paypal_credit_card_settings['status'] == 'Enable'){ ?>
               <?php /*?> <input type="hidden" name="creditvalue" id="creditvalue" value="paypaldodirect" /><?php */?>

			   <?php //} ?>
                <input name="CreditSubmit" id="CreditSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
          <?php } 
     	 
		   if ($CheckoutVal->row()->payment_type == 'wire_transfer'){
		   ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="wiretransfer"> 
            
            <form name="UserPaymentwiretransferForm" id="UserPaymentwiretransferForm" method="post" enctype="multipart/form-data" action= "site/checkout/UserPaymentOnWireTransfer" autocomplete="off">
             
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt class="chekout_heading"><b>
                      <?php if($this->lang->line('SELLER DETAILS') != '') { echo stripslashes($this->lang->line('SELLER DETAILS')); } else echo "SELLER DETAILS"; ?>
                      </b> 
					 <br>
					  <?php $sell=$SellerDetails->result_array(); ?>
					  
					  <?php echo ($sell[0]['wiretransfer_details']);?>
                
                    
                     </dl>
                 
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">

                        <dt>Ship to</dt>
                        <dd>
                            <p><br /><br />  </p>
                        </dd>
                    </dl-->
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { 
					       echo stripslashes($this->lang->line('checkout_order')); 
						 } 
						 else echo "Order"; ?>
                    </dt>
                    <dd>
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                  	<?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>"  readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
						
			
					<?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
                    <?php }} ?>                    
                </div>

                <input id="cart_price" name="cart_price" value="<?php echo number_format($UsercheckAmt[0],2,'.',''); ?>" type="hidden">
		        <input id="ship_price" name="ship_price" value="<?php echo number_format($UsercheckAmt[1],2,'.',''); ?>" type="hidden">
                <input id="tax_price" name="tax_price" value="<?php echo number_format($UsercheckAmt[2],2,'.',''); ?>" type="hidden">
                <input id="discount_price" name="discount_price" value="<?php echo number_format($UsercheckAmt[5],2,'.',''); ?>" type="hidden">
                <input id="gift_discount_price" name="gift_discount_price" value="<?php echo number_format($UsercheckAmt[6],2,'.',''); ?>" type="hidden">
                <input id="cart_less_price" name="cart_less_price" value="<?php echo number_format($UsercheckAmt[7],2,'.',''); ?>" type="hidden">
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden">
				
                <input id="email" name="email" value="<?php echo $this->session->userdata['shopsy_session_user_email']; ?>" type="hidden">
				
                <input name="CodSubmit" id="CodSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete the Process"; ?>" style="cursor:pointer;"  />
                
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
          <?php 
		  }
		  if ($CheckoutVal->row()->payment_type == 'western_union'){
		   ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="westernunion"> 
            
            <form name="UserPaymentwesternunionForm" id="UserPaymentwesternunionForm" method="post" enctype="multipart/form-data" action= "site/checkout/UserPaymentOnwesternunion" autocomplete="off">
             
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt class="chekout_heading"><b>
                      <?php if($this->lang->line('SELLER DETAILS') != '') { echo stripslashes($this->lang->line('SELLER DETAILS')); } else echo "SELLER DETAILS"; ?>
                      </b> 
					 <br>
					  <?php $sell=$SellerDetails->result_array(); ?>
					  
					  <?php echo ($sell[0]['westernunion_details']);?>
                
                    
                     </dl>
                 
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">

                        <dt>Ship to</dt>
                        <dd>
                            <p><br /><br />  </p>
                        </dd>
                    </dl-->
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { 
					       echo stripslashes($this->lang->line('checkout_order')); 
						 } 
						 else echo "Order"; ?>
                    </dt>
                    <dd>
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                  	<?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>"  readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
						
			
					<?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
                    <?php }} ?>                    
                </div>

                <input id="cart_price" name="cart_price" value="<?php echo number_format($UsercheckAmt[0],2,'.',''); ?>" type="hidden">
		        <input id="ship_price" name="ship_price" value="<?php echo number_format($UsercheckAmt[1],2,'.',''); ?>" type="hidden">
                <input id="tax_price" name="tax_price" value="<?php echo number_format($UsercheckAmt[2],2,'.',''); ?>" type="hidden">
                <input id="discount_price" name="discount_price" value="<?php echo number_format($UsercheckAmt[5],2,'.',''); ?>" type="hidden">
                <input id="gift_discount_price" name="gift_discount_price" value="<?php echo number_format($UsercheckAmt[6],2,'.',''); ?>" type="hidden">
                <input id="cart_less_price" name="cart_less_price" value="<?php echo number_format($UsercheckAmt[7],2,'.',''); ?>" type="hidden">
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden">
				
                <input id="email" name="email" value="<?php echo $this->session->userdata['shopsy_session_user_email']; ?>" type="hidden">
				
                <input name="CodSubmit" id="CodSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete the Process"; ?>" style="cursor:pointer;"  />
                
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
          <?php 
		  }
		  
			
			 if ($CheckoutVal->row()->payment_type == 'Payu'){ ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="PayuPay"> 
            <script>$(document).ready(function(){	$("#UserPaymentUForm").validate();
					$.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
				
					$.validator.addMethod("ValidZipCode", function( value, element ) {	var result = this.optional(element) || value.length >= 3;
					if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);});
		   	</script>
            <form name="UserPaymentPayUForm" id="UserPaymentUForm" method="post" enctype="multipart/form-data" action="site/checkout/UserPaymentPayuProcess"  autocomplete="off">
              <?php /*?><input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $SellerDetails->row()->PayPal_mode; ?>"  />
              <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $SellerDetails->row()->PayPal_email; ?>"  /><?php */?>
              <?php $sell=$SellerDetails->result_array(); ?>
              <input type="hidden" name="payumode" id="payumode" value="<?php echo $sell[0]['payu_mode']; ?>"  />
                <input type="hidden" name="seller_id" id="seller_id" value="<?php echo $sell[0]['seller_id']; ?>"  />
              <input type="hidden" name="payuEmail" id="payuEmail" value="<?php echo $sell[0]['payu_email']; ?>"  />
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt class="chekout_heading"><b>
                      <?php if($this->lang->line('shop_billing') != '') { echo stripslashes($this->lang->line('shop_billing')); } else echo "Billing Address"; ?>
                      </b> <small>
                     <?php if($this->lang->line('shop_enter_billing_address') != '') { echo stripslashes($this->lang->line('shop_enter_billing_address')); } else echo "Enter your billing address"; ?>
                      </small></dt>
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $shipValDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $shipValDetails->row()->address1; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $shipValDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $shipValDetails->row()->city; ?>">
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>&nbsp;</b> <small>&nbsp;</small></dt>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b>*</b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $shipValDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
                        <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $shipValDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $shipValDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $shipValDetails->row()->phone; ?>">
                    </dd>
                  </dl>
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">

                        <dt>Ship to</dt>
                        <dd>
                            <p><br /><br />  </p>
                        </dd>
                    </dl-->
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { 
					       echo stripslashes($this->lang->line('checkout_order')); 
						 } 
						 else echo "Order"; ?>
                    </dt>
                    <dd>
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                  	<?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>"  readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
						
			
					<?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
                    <?php }} ?>                    
                </div>

                <input id="cart_price" name="cart_price" value="<?php echo number_format($UsercheckAmt[0],2,'.',''); ?>" type="hidden">
		        <input id="ship_price" name="ship_price" value="<?php echo number_format($UsercheckAmt[1],2,'.',''); ?>" type="hidden">
                <input id="tax_price" name="tax_price" value="<?php echo number_format($UsercheckAmt[2],2,'.',''); ?>" type="hidden">
                <input id="discount_price" name="discount_price" value="<?php echo number_format($UsercheckAmt[5],2,'.',''); ?>" type="hidden">
                <input id="gift_discount_price" name="gift_discount_price" value="<?php echo number_format($UsercheckAmt[6],2,'.',''); ?>" type="hidden">
                <input id="cart_less_price" name="cart_less_price" value="<?php echo number_format($UsercheckAmt[7],2,'.',''); ?>" type="hidden">
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden">
                <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                <input name="PayuSubmit" id="PayuSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
          <?php } 
			 if ($CheckoutVal->row()->payment_type == 'Paypal Adaptive'){ ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="PaypalPay"> 
            <script>$(document).ready(function(){	$("#UserPaymentPaypalAdptForm").validate();
					$.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
				
					$.validator.addMethod("ValidZipCode", function( value, element ) {	var result = this.optional(element) || value.length >= 3;
					if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);});
		   	</script>
            <form name="UserPaymentPaypalAdptForm" id="UserPaymentPaypalAdptForm" method="post" enctype="multipart/form-data" action="site/checkout/UserPaymentProcessAdaptive"  autocomplete="off">
              <?php /*?><input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $SellerDetails->row()->PayPal_mode; ?>"  />
              <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $SellerDetails->row()->PayPal_email; ?>"  /><?php */?>
              
              <input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $paypalProcess['mode']; ?>"  />
              <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $paypalProcess['merchant_email']; ?>"  />
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt class="chekout_heading"><b>
                      <?php if($this->lang->line('shop_billing_address') != '') { echo stripslashes($this->lang->line('shop_billing_address')); } else echo "Billing Address"; ?>
                      </b> <small>
                      <?php if($this->lang->line('shop_enter_billing_address') != '') { echo stripslashes($this->lang->line('shop_enter_billing_address')); } else echo "Enter your billing address"; ?>
                      </small></dt>
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $shipValDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $shipValDetails->row()->address1; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $shipValDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $shipValDetails->row()->city; ?>">
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>&nbsp;</b> <small>&nbsp;</small></dt>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b>*</b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $shipValDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
                        <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $shipValDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $shipValDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $shipValDetails->row()->phone; ?>">
                    </dd>
                  </dl>
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">

                        <dt>Ship to</dt>
                        <dd>
                            <p><br /><br />  </p>
                        </dd>
                    </dl-->
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { 
					       echo stripslashes($this->lang->line('checkout_order')); 
						 } 
						 else echo "Order"; ?>
                    </dt>
                    <dd>
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                  	<?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>"  readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
						
			
					<?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
                    <?php }} ?>                    
                </div>
				
				<input type="hidden" name="seller_id" id="seller_id" value="<?php echo $CheckoutVal->row()->sell_id; ?>" >
                <input id="cart_price" name="cart_price" value="<?php echo number_format($UsercheckAmt[0],2,'.',''); ?>" type="hidden">
		        <input id="ship_price" name="ship_price" value="<?php echo number_format($UsercheckAmt[1],2,'.',''); ?>" type="hidden">
                <input id="tax_price" name="tax_price" value="<?php echo number_format($UsercheckAmt[2],2,'.',''); ?>" type="hidden">
                <input id="discount_price" name="discount_price" value="<?php echo number_format($UsercheckAmt[5],2,'.',''); ?>" type="hidden">
                <input id="gift_discount_price" name="gift_discount_price" value="<?php echo number_format($UsercheckAmt[6],2,'.',''); ?>" type="hidden">
                <input id="cart_less_price" name="cart_less_price" value="<?php echo number_format($UsercheckAmt[7],2,'.',''); ?>" type="hidden">
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden">
                <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                <input name="PaypalSubmit" id="PaypalSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
          <?php } 
		 
			
			 if ($CheckoutVal->row()->payment_type == 'Payu'){ ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="PayuPay"> 
            <script>$(document).ready(function(){	$("#UserPaymentUForm").validate();
					$.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
				
					$.validator.addMethod("ValidZipCode", function( value, element ) {	var result = this.optional(element) || value.length >= 3;
					if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);});
		   	</script>
            <form name="UserPaymentPayUForm" id="UserPaymentUForm" method="post" enctype="multipart/form-data" action="site/checkout/UserPaymentPayuProcess"  autocomplete="off">
              <?php /*?><input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $SellerDetails->row()->PayPal_mode; ?>"  />
              <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $SellerDetails->row()->PayPal_email; ?>"  /><?php */?>
              <?php $sell=$SellerDetails->result_array(); ?>
              <input type="hidden" name="payumode" id="payumode" value="<?php echo $sell[0]['payu_mode']; ?>"  />
                <input type="hidden" name="seller_id" id="seller_id" value="<?php echo $sell[0]['seller_id']; ?>"  />
              <input type="hidden" name="payuEmail" id="payuEmail" value="<?php echo $sell[0]['payu_email']; ?>"  />
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt class="chekout_heading"><b>
                      <?php if($this->lang->line('shop_billing') != '') { echo stripslashes($this->lang->line('shop_billing')); } else echo "Billing Address"; ?>
                      </b> <small>
                     <?php if($this->lang->line('shop_enter_billing_address') != '') { echo stripslashes($this->lang->line('shop_enter_billing_address')); } else echo "Enter your billing address"; ?>
                      </small></dt>
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $shipValDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $shipValDetails->row()->address1; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $shipValDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $shipValDetails->row()->city; ?>">
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>&nbsp;</b> <small>&nbsp;</small></dt>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b>*</b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $shipValDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
                        <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $shipValDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $shipValDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $shipValDetails->row()->phone; ?>">
                    </dd>
                  </dl>
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">

                        <dt>Ship to</dt>
                        <dd>
                            <p><br /><br />  </p>
                        </dd>
                    </dl-->
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { 
					       echo stripslashes($this->lang->line('checkout_order')); 
						 } 
						 else echo "Order"; ?>
                    </dt>
                    <dd>
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                  	<?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left"placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>"  readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
						
			
					<?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
                    <?php }} ?>                    
                </div>

                <input id="cart_price" name="cart_price" value="<?php echo number_format($UsercheckAmt[0],2,'.',''); ?>" type="hidden">
		        <input id="ship_price" name="ship_price" value="<?php echo number_format($UsercheckAmt[1],2,'.',''); ?>" type="hidden">
                <input id="tax_price" name="tax_price" value="<?php echo number_format($UsercheckAmt[2],2,'.',''); ?>" type="hidden">
                <input id="discount_price" name="discount_price" value="<?php echo number_format($UsercheckAmt[5],2,'.',''); ?>" type="hidden">
                <input id="gift_discount_price" name="gift_discount_price" value="<?php echo number_format($UsercheckAmt[6],2,'.',''); ?>" type="hidden">
                <input id="cart_less_price" name="cart_less_price" value="<?php echo number_format($UsercheckAmt[7],2,'.',''); ?>" type="hidden">
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden">
                <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                <input name="PayuSubmit" id="PayuSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
         <?php } 
			 if ($CheckoutVal->row()->payment_type == 'Paypal Adaptive1'){ ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="PaypalPay"> 
            <script>$(document).ready(function(){	$("#UserPaymentPaypalAdptForm").validate();
					$.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
				
					$.validator.addMethod("ValidZipCode", function( value, element ) {	var result = this.optional(element) || value.length >= 3;
					if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);});
		   	</script>
            <form name="UserPaymentPaypalAdptForm" id="UserPaymentPaypalAdptForm" method="post" enctype="multipart/form-data" action="site/checkout/UserPaymentProcessAdaptive"  autocomplete="off">
              <?php /*?><input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $SellerDetails->row()->PayPal_mode; ?>"  />
              <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $SellerDetails->row()->PayPal_email; ?>"  /><?php */?>
              
              <input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $paypalProcess['mode']; ?>"  />
              <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $paypalProcess['merchant_email']; ?>"  />
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt class="chekout_heading"><b>
                      <?php if($this->lang->line('shop_billing_address') != '') { echo stripslashes($this->lang->line('shop_billing_address')); } else echo "Billing Address"; ?>
                      </b> <small>
                      <?php if($this->lang->line('shop_enter_billing_address') != '') { echo stripslashes($this->lang->line('shop_enter_billing_address')); } else echo "Enter your billing address"; ?>
                      </small></dt>
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $shipValDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $shipValDetails->row()->address1; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $shipValDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $shipValDetails->row()->city; ?>">
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>&nbsp;</b> <small>&nbsp;</small></dt>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b>*</b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $shipValDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
                        <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $shipValDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $shipValDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $shipValDetails->row()->phone; ?>">
                    </dd>
                  </dl>
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">

                        <dt>Ship to</dt>
                        <dd>
                            <p><br /><br />  </p>
                        </dd>
                    </dl-->
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { 
					       echo stripslashes($this->lang->line('checkout_order')); 
						 } 
						 else echo "Order"; ?>
                    </dt>
                    <dd>
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                  	<?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>"  readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
						
			
					<?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
                    <?php }} ?>                    
                </div>
				
				<input type="hidden" name="seller_id" id="seller_id" value="<?php echo $CheckoutVal->row()->sell_id; ?>" >
                <input id="cart_price" name="cart_price" value="<?php echo number_format($UsercheckAmt[0],2,'.',''); ?>" type="hidden">
		        <input id="ship_price" name="ship_price" value="<?php echo number_format($UsercheckAmt[1],2,'.',''); ?>" type="hidden">
                <input id="tax_price" name="tax_price" value="<?php echo number_format($UsercheckAmt[2],2,'.',''); ?>" type="hidden">
                <input id="discount_price" name="discount_price" value="<?php echo number_format($UsercheckAmt[5],2,'.',''); ?>" type="hidden">
                <input id="gift_discount_price" name="gift_discount_price" value="<?php echo number_format($UsercheckAmt[6],2,'.',''); ?>" type="hidden">
                <input id="cart_less_price" name="cart_less_price" value="<?php echo number_format($UsercheckAmt[7],2,'.',''); ?>" type="hidden">
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden">
                <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                <input name="PaypalSubmit" id="PaypalSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
          <?php } 
		 	
			 if ($CheckoutVal->row()->payment_type == 'Paypal'){ ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="PaypalPay"> 
            <script>$(document).ready(function(){	$("#UserPaymentPaypalForm").validate();
					$.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }},<?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
				
					$.validator.addMethod("ValidZipCode", function( value, element ) {	var result = this.optional(element) || value.length >= 6;
					if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);});
		   	</script>
            <form name="UserPaymentPaypalForm" id="UserPaymentPaypalForm" method="post" enctype="multipart/form-data" action="site/checkout/UserPaymentProcess"  autocomplete="off">
              <?php /*?><input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $SellerDetails->row()->PayPal_mode; ?>"  />
              <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $SellerDetails->row()->PayPal_email; ?>"  /><?php */?>
              
              <input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $paypalProcess['mode']; ?>"  />
              <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $paypalProcess['merchant_email']; ?>"  />
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt class="chekout_heading"><b>
                      <?php if($this->lang->line('shop_billing_address') != '') { echo stripslashes($this->lang->line('shop_billing_address')); } else echo "Billing Address"; ?>
                      </b> <small>
                      <?php if($this->lang->line('shop_enter_billing_address') != '') { echo stripslashes($this->lang->line('shop_enter_billing_address')); } else echo "Enter your billing address"; ?>
                      </small></dt>
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $shipValDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $shipValDetails->row()->address1; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $shipValDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $shipValDetails->row()->city; ?>">
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>&nbsp;</b> <small>&nbsp;</small></dt>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b>*</b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $shipValDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
                        <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $shipValDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $shipValDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $shipValDetails->row()->phone; ?>">
                    </dd>
                  </dl>
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">

                        <dt>Ship to</dt>
                        <dd>
                            <p><br /><br />  </p>
                        </dd>
                    </dl-->
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { 
					       echo stripslashes($this->lang->line('checkout_order')); 
						 } 
						 else echo "Order"; ?>
                    </dt>
                    <dd>
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>

                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('cart_buyer_commission') != '') { echo stripslashes($this->lang->line('cart_buyer_commission')); } else echo "Buyer commission"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[8] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>

                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('cart_gateway_commission') != '') { echo stripslashes($this->lang->line('cart_gateway_commission')); } else echo "Gateway commission"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[9] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>

                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                  	<?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>"  readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
						
			
					<?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
                    <?php }} ?>                    
                </div>

                <input id="cart_price" name="cart_price" value="<?php echo number_format($UsercheckAmt[0],2,'.',''); ?>" type="hidden">
		        <input id="ship_price" name="ship_price" value="<?php echo number_format($UsercheckAmt[1],2,'.',''); ?>" type="hidden">
                <input id="tax_price" name="tax_price" value="<?php echo number_format($UsercheckAmt[2],2,'.',''); ?>" type="hidden">
                <input id="discount_price" name="discount_price" value="<?php echo number_format($UsercheckAmt[5],2,'.',''); ?>" type="hidden">
                <input id="gift_discount_price" name="gift_discount_price" value="<?php echo number_format($UsercheckAmt[6],2,'.',''); ?>" type="hidden">
                <input id="cart_less_price" name="cart_less_price" value="<?php echo number_format($UsercheckAmt[7],2,'.',''); ?>" type="hidden">
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden">
                <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                <input name="PaypalSubmit" id="PaypalSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
          <?php }
		  
		  if ($CheckoutVal->row()->payment_type == 'Credit-Card'){ ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="CreditCardPay"> 
            <script>$(document).ready(function(){	$("#UserPaymentCreditForm").validate();
					$.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }},<?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
				
				$.validator.addMethod("ValidZipCode", function( value, element ) { var result = this.optional(element) || value.length >= 3;
					if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);});
			</script>
            <form name="UserPaymentCreditForm" id="UserPaymentCreditForm" method="post" enctype="multipart/form-data" action="site/checkout/UserPaymentCredit" autocomplete="off">
              <input type="hidden" name="authorize_mode" id="authorize_mode" value="<?php echo $SellerDetails->row()->authorize_mode; ?>"  />
              <input type="hidden" name="authorize_id" id="authorize_id" value="<?php echo $SellerDetails->row()->authorize_id; ?>"  />
              <input type="hidden" name="authorize_key" id="authorize_key" value="<?php echo $SellerDetails->row()->authorize_key; ?>"  />
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt class="payment-card"><b>
                      <?php if($this->lang->line('checkout_cc_info') != '') { echo stripslashes($this->lang->line('checkout_cc_info')); } else echo "Credit Card Information"; ?>
                      </b> <span>
                      <?php if($this->lang->line('checkout_visa_mster') != '') { echo stripslashes($this->lang->line('checkout_visa_mster')); } else echo "Visa, MasterCard, Discover or American Express"; ?>
                      </span></dt>
                    <!--<dd class="comment"><b>*</b>  = <?php if($this->lang->line('checkout_mand_fields') != '') { echo stripslashes($this->lang->line('checkout_mand_fields')); } else echo "Mandatory fields"; ?></dd>-->
                    <div class="clear"></div>
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $shipValDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
                      <label for="payment-card-number">
                        <?php if($this->lang->line('checkout_card_no') != '') { echo stripslashes($this->lang->line('checkout_card_no')); } else echo "Card Number"; ?>
                        <b>*</b></label>
                      <input id="cardNumber" name="cardNumber" autocomplete="off" class="required" maxlength="16" size="16" type="text" />
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_enter_cardno') != '') { echo stripslashes($this->lang->line('checkout_enter_cardno')); } else echo "Please enter valid card number"; ?>.</p><?php */?>
                    </dd>
                    <dd>
                      <label for="payment-card-number">
                        <?php if($this->lang->line('checkout_card_type') != '') { echo stripslashes($this->lang->line('checkout_card_type')); } else echo "Card Type"; ?>
                        <b>*</b></label>
                      <select id="cardType" name="cardType" class="select-round select-white select-country selectBox required">
                        <option value="Visa"><?php if($this->lang->line('user_visa') != '') { echo stripslashes($this->lang->line('user_visa')); } else echo 'Visa'; ?></option>
                        <option value="Amex"><?php if($this->lang->line('user_amrican_exp') != '') { echo stripslashes($this->lang->line('user_amrican_exp')); } else echo 'American Express'; ?></option>
                        <option value="MasterCard"><?php if($this->lang->line('user_master_card') != '') { echo stripslashes($this->lang->line('user_master_card')); } else echo 'Master Card'; ?></option>
                        <option value="Discover"><?php if($this->lang->line('user_discover') != '') { echo stripslashes($this->lang->line('user_discover')); } else echo 'Discover'; ?></option>
                      </select>
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_select_card') != '') { echo stripslashes($this->lang->line('checkout_select_card')); } else echo "Please select card"; ?>.</p><?php */?>
                    </dd>
                    <!--<dd class="select-card">
                                    <label for="payment-card-type1" class="payment-card-type1"></label> 
                                    <label for="payment-card-type2" class="payment-card-type2"></label>
                                    <label for="payment-card-type3" class="payment-card-type3"></label>
                                    <label for="payment-card-type4" class="payment-card-type4"></label>
                                    <p class="error">Please select card.</p>
                                </dd>-->
                    
                    <dd>
                      <label for="payment-card-expiration">
                        <?php if($this->lang->line('checkout_exp_date') != '') { echo stripslashes($this->lang->line('checkout_exp_date')); } else echo "Expiration Date"; ?>
                        <b>*</b></label>
                      <?php $Sel ='selected="selected"';  ?>
                      <select id="CCExpDay" name="CCExpDay" class="select-round select-white select-date selectBox required">
                        <option value="01" <?php if(date('m')=='01'){ echo $Sel;} ?>>01</option>
                        <option value="02" <?php if(date('m')=='02'){ echo $Sel;} ?>>02</option>
                        <option value="03" <?php if(date('m')=='03'){ echo $Sel;} ?>>03</option>
                        <option value="04" <?php if(date('m')=='04'){ echo $Sel;} ?>>04</option>
                        <option value="05" <?php if(date('m')=='05'){ echo $Sel;} ?>>05</option>
                        <option value="06" <?php if(date('m')=='06'){ echo $Sel;} ?>>06</option>
                        <option value="07" <?php if(date('m')=='07'){ echo $Sel;} ?>>07</option>
                        <option value="08" <?php if(date('m')=='08'){ echo $Sel;} ?>>08</option>
                        <option value="09" <?php if(date('m')=='09'){ echo $Sel;} ?>>09</option>
                        <option value="10" <?php if(date('m')=='10'){ echo $Sel;} ?>>10</option>
                        <option value="11" <?php if(date('m')=='11'){ echo $Sel;} ?>>11</option>
                        <option value="12" <?php if(date('m')=='12'){ echo $Sel;} ?>>12</option>
                      </select>
                      <select id="CCExpMnth" name="CCExpMnth" class="select-round select-white select-date selectBox required">
                        <?php for($i=date('Y');$i< (date('Y') + 30);$i++){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-card-security">
                        <?php if($this->lang->line('checkout_security_code') != '') { echo stripslashes($this->lang->line('checkout_security_code')); } else echo "Security Code"; ?>
                      </label>
                      <input style="width:63px;" id="payment-card-security" autocomplete="off" name="creditCardIdentifier" class="input-code required number" type="password">
                      <!--<a href="#" class="tooltip" onClick="$('.card-back').show(); return false;"><?php if($this->lang->line('checkout_what_this') != '') { echo stripslashes($this->lang->line('checkout_what_this')); } else echo "What is this?"; ?></a>-->
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_enter_sc') != '') { echo stripslashes($this->lang->line('checkout_enter_sc')); } else echo "Please enter security code"; ?>.</p><?php */?>
                      <dl class="card-back">
                        <dt>
                          <?php /*if($this->lang->line('checkout_cvc_cvs') != '') { echo stripslashes($this->lang->line('checkout_cvc_cvs')); } else echo "Security Code (CVC or CVS)";*/ ?>
                        </dt>
                        <dd> <!--<img src="images/card-back.gif" alt="">-->
                          <?php /*if($this->lang->line('checkout_last_three') != '') { echo stripslashes($this->lang->line('checkout_last_three')); } else echo "Last three digits on the back of your card is the CVC or CVV number"; ?>.<br>&nbsp;<br><?php if($this->lang->line('checkout_for_ameri') != '') { echo stripslashes($this->lang->line('checkout_for_ameri')); } else echo "For American Express there is a four digit code on the front";*/ ?>
                          . <a href="#" onClick="$('.card-back').hide();return false;" title="Close"></a> </dd>
                      </dl>
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>
                      <?php if($this->lang->line('shop_billing_address') != '') { echo stripslashes($this->lang->line('shop_billing_address')); } else echo "Billing Address"; ?>
                      </b> <span>
                      <?php if($this->lang->line('shop_enter_billing_address') != '') { echo stripslashes($this->lang->line('shop_enter_billing_address')); } else echo "Enter your billing address"; ?>
                      </span></dt>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $shipValDetails->row()->address1; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $shipValDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $shipValDetails->row()->city; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b>*</b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $shipValDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
                        <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $shipValDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $shipValDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $shipValDetails->row()->phone; ?>">
                    </dd>
                  </dl>
                  <!--p class="payment-save-check">
                            <input type="checkbox" id="payment-save-card"  />

                            <label for="payment-save-card">Save your credit card details for any future orders</label>
                            <span class="error">Please check saving your credit card.</span>
                        </p-->
                  
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">

                            <dt>Ship to</dt>
                            <dd>
                                <p><br /><br />  </p>
                            </dd>
                        </dl-->
                  
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { echo stripslashes($this->lang->line('checkout_order')); } else echo "Order"; ?>
                    </dt>
                    <dd class="amount_detail2">
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
							  <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                  
                  <?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>"  readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
						
			
					<?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>                    </div>
                    <?php }} ?>
                    
                    
                    
                    
                </div>

                <input id="cart_price" name="cart_price" value="<?php echo number_format($UsercheckAmt[0],2,'.',''); ?>" type="hidden">
		        <input id="ship_price" name="ship_price" value="<?php echo number_format($UsercheckAmt[1],2,'.',''); ?>" type="hidden">
                <input id="tax_price" name="tax_price" value="<?php echo number_format($UsercheckAmt[2],2,'.',''); ?>" type="hidden">
                <input id="discount_price" name="discount_price" value="<?php echo number_format($UsercheckAmt[5],2,'.',''); ?>" type="hidden">
                <input id="gift_discount_price" name="gift_discount_price" value="<?php echo number_format($UsercheckAmt[6],2,'.',''); ?>" type="hidden">
                <input id="cart_less_price" name="cart_less_price" value="<?php echo number_format($UsercheckAmt[7],2,'.',''); ?>" type="hidden">
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden"  />
                <input type="hidden" name="shipping_id" id="shipping_id" value="<?php echo $shipValDetails->row()->id; ?>" />
                <input id="email" name="email" value="<?php echo $this->session->userdata('shopsy_session_user_email'); ?>" type="hidden">
                <?php //if ($authorize_net_settings['status'] == 'Enable'){ ?>
                <input type="hidden" name="creditvalue" id="creditvalue" value="authorize" />
                <?php //}elseif($paypal_credit_card_settings['status'] == 'Enable'){ ?>
               <?php /*?> <input type="hidden" name="creditvalue" id="creditvalue" value="paypaldodirect" /><?php */?>
                <?php //} ?>
                <input name="CreditSubmit" id="CreditSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
          <?php }
		  
		  if ($CheckoutVal->row()->payment_type == 'Stripe'){ ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="StripePay"> 
            <script>
				</script>
			<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

			<script type="text/javascript">
				// This identifies your website in the createToken call below
				Stripe.setPublishableKey('<?php echo $StripeVal['publishable_key']; ?>');
				// ...
			</script>
            <form  name="UserPaymentStripeForm" id="UserPaymentStripeForm" method="post" enctype="multipart/form-data" action="site/checkout/UserPaymentCreditStripe" autocomplete="off">
              <input type="hidden" name="stripe_mode" id="stripe_mode" value="<?php echo $StripeVal['mode']; ?>"  />
              <input type="hidden" name="stripe_key" id="stripe_key" value="<?php echo $StripeVal['secret_key']; ?>"  />
              <input type="hidden" name="stripe_publish_key" id="stripe_publish_key" value="<?php echo $StripeVal['publishable_key']; ?>"  />
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt class="payment-card"><b>
                      <?php if($this->lang->line('checkout_cc_info') != '') { echo stripslashes($this->lang->line('checkout_cc_info')); } else echo "Credit Card Information"; ?>
                      </b> <span>
                      <?php if($this->lang->line('checkout_visa_mster') != '') { echo stripslashes($this->lang->line('checkout_visa_mster')); } else echo "Visa, MasterCard, Discover or American Express"; ?>
                      </span></dt>
                    <!--<dd class="comment"><b>*</b>  = <?php if($this->lang->line('checkout_mand_fields') != '') { echo stripslashes($this->lang->line('checkout_mand_fields')); } else echo "Mandatory fields"; ?></dd>-->
                    <div class="clear"></div>
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $shipValDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
					<span class="payment-errors" style="color:#FF0000;"></span>
                      <label for="payment-card-number" >
                        <?php if($this->lang->line('checkout_card_no') != '') { echo stripslashes($this->lang->line('checkout_card_no')); } else echo "Card Number"; ?>
                        <b>*</b></label>
                      <input id="cardNumber" name="cardNumber" autocomplete="off" class="required" maxlength="16" size="16" type="text" data-stripe="number" />
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_enter_cardno') != '') { echo stripslashes($this->lang->line('checkout_enter_cardno')); } else echo "Please enter valid card number"; ?>.</p><?php */?>
                    </dd>
                    <dd>
                      <label for="payment-card-number">
                        <?php if($this->lang->line('checkout_card_type') != '') { echo stripslashes($this->lang->line('checkout_card_type')); } else echo "Card Type"; ?>
                        <b>*</b></label>
                      <select id="cardType" name="cardType" class="select-round select-white select-country selectBox required">
                        <option value="Visa"><?php if($this->lang->line('user_visa') != '') { echo stripslashes($this->lang->line('user_visa')); } else echo 'Visa'; ?></option>
                        <option value="Amex"><?php if($this->lang->line('user_amrican_exp') != '') { echo stripslashes($this->lang->line('user_amrican_exp')); } else echo 'American Express'; ?></option>
                        <option value="MasterCard"><?php if($this->lang->line('user_master_card') != '') { echo stripslashes($this->lang->line('user_master_card')); } else echo 'Master Card'; ?></option>
                        <option value="Discover"><?php if($this->lang->line('user_discover') != '') { echo stripslashes($this->lang->line('user_discover')); } else echo 'Discover'; ?></option>
                      </select>
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_select_card') != '') { echo stripslashes($this->lang->line('checkout_select_card')); } else echo "Please select card"; ?>.</p><?php */?>
                    </dd>
                    <!--<dd class="select-card">
                                    <label for="payment-card-type1" class="payment-card-type1"></label> 
                                    <label for="payment-card-type2" class="payment-card-type2"></label>
                                    <label for="payment-card-type3" class="payment-card-type3"></label>
                                    <label for="payment-card-type4" class="payment-card-type4"></label>
                                    <p class="error">Please select card.</p>
                                </dd>-->
                    
                    <dd>
                      <label for="payment-card-expiration">
                        <?php if($this->lang->line('checkout_exp_date') != '') { echo stripslashes($this->lang->line('checkout_exp_date')); } else echo "Expiration Date"; ?>
                        <b>*</b></label>
                      <?php $Sel ='selected="selected"';  ?>
                      <select id="CCExpDay" name="CCExpDay" class="select-round select-white select-date selectBox required" data-stripe="exp-month">
                        <option value="01" <?php if(date('m')=='01'){ echo $Sel;} ?>>01</option>
                        <option value="02" <?php if(date('m')=='02'){ echo $Sel;} ?>>02</option>
                        <option value="03" <?php if(date('m')=='03'){ echo $Sel;} ?>>03</option>
                        <option value="04" <?php if(date('m')=='04'){ echo $Sel;} ?>>04</option>
                        <option value="05" <?php if(date('m')=='05'){ echo $Sel;} ?>>05</option>
                        <option value="06" <?php if(date('m')=='06'){ echo $Sel;} ?>>06</option>
                        <option value="07" <?php if(date('m')=='07'){ echo $Sel;} ?>>07</option>
                        <option value="08" <?php if(date('m')=='08'){ echo $Sel;} ?>>08</option>
                        <option value="09" <?php if(date('m')=='09'){ echo $Sel;} ?>>09</option>
                        <option value="10" <?php if(date('m')=='10'){ echo $Sel;} ?>>10</option>
                        <option value="11" <?php if(date('m')=='11'){ echo $Sel;} ?>>11</option>
                        <option value="12" <?php if(date('m')=='12'){ echo $Sel;} ?>>12</option>
                      </select>
                      <select id="CCExpMnth" name="CCExpMnth" class="select-round select-white select-date selectBox required" data-stripe="exp-year">
                        <?php for($i=date('Y');$i< (date('Y') + 30);$i++){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-card-security">
                        <?php if($this->lang->line('checkout_security_code') != '') { echo stripslashes($this->lang->line('checkout_security_code')); } else echo "Security Code"; ?>
                      </label>
                      <input style="width:63px;" id="payment-card-security" autocomplete="off" name="creditCardIdentifier" class="input-code required number" type="password" data-stripe="cvc">
                      <!--<a href="#" class="tooltip" onClick="$('.card-back').show(); return false;"><?php if($this->lang->line('checkout_what_this') != '') { echo stripslashes($this->lang->line('checkout_what_this')); } else echo "What is this?"; ?></a>-->
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_enter_sc') != '') { echo stripslashes($this->lang->line('checkout_enter_sc')); } else echo "Please enter security code"; ?>.</p><?php */?>
                      <dl class="card-back">
                        <dt>
                          <?php /*if($this->lang->line('checkout_cvc_cvs') != '') { echo stripslashes($this->lang->line('checkout_cvc_cvs')); } else echo "Security Code (CVC or CVS)";*/ ?>
                        </dt>
                        <dd> <!--<img src="images/card-back.gif" alt="">-->
                          <?php /*if($this->lang->line('checkout_last_three') != '') { echo stripslashes($this->lang->line('checkout_last_three')); } else echo "Last three digits on the back of your card is the CVC or CVV number"; ?>.<br>&nbsp;<br><?php if($this->lang->line('checkout_for_ameri') != '') { echo stripslashes($this->lang->line('checkout_for_ameri')); } else echo "For American Express there is a four digit code on the front";*/ ?>
                          . <a href="#" onClick="$('.card-back').hide();return false;" title="Close"></a> </dd>
                      </dl>
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>
                      <?php if($this->lang->line('shop_billing_address') != '') { echo stripslashes($this->lang->line('shop_billing_address')); } else echo "Billing Address"; ?>
                      </b> <span>
                      <?php if($this->lang->line('shop_enter_billing_address') != '') { echo stripslashes($this->lang->line('shop_enter_billing_address')); } else echo "Enter your billing address"; ?>
                      </span></dt>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $shipValDetails->row()->address1; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $shipValDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $shipValDetails->row()->city; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b>*</b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $shipValDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
                        <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $shipValDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $shipValDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $shipValDetails->row()->phone; ?>">
                    </dd>
                  </dl>
                  <!--p class="payment-save-check">
                            <input type="checkbox" id="payment-save-card"  />

                            <label for="payment-save-card">Save your credit card details for any future orders</label>
                            <span class="error">Please check saving your credit card.</span>
                        </p-->
                  
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">

                            <dt>Ship to</dt>
                            <dd>
                                <p><br /><br />  </p>
                            </dd>
                        </dl-->
                  
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { echo stripslashes($this->lang->line('checkout_order')); } else echo "Order"; ?>
                    </dt>
                    <dd class="amount_detail2">
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
							  <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                  
                  <?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left"placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>"  readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
						
			
					<?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>                    </div>
                    <?php }} ?>
                    
                    
                    
                    
                </div>

                <input id="cart_price" name="cart_price" value="<?php echo number_format($UsercheckAmt[0],2,'.',''); ?>" type="hidden">
		        <input id="ship_price" name="ship_price" value="<?php echo number_format($UsercheckAmt[1],2,'.',''); ?>" type="hidden">
                <input id="tax_price" name="tax_price" value="<?php echo number_format($UsercheckAmt[2],2,'.',''); ?>" type="hidden">
                <input id="discount_price" name="discount_price" value="<?php echo number_format($UsercheckAmt[5],2,'.',''); ?>" type="hidden">
                <input id="gift_discount_price" name="gift_discount_price" value="<?php echo number_format($UsercheckAmt[6],2,'.',''); ?>" type="hidden">
                <input id="cart_less_price" name="cart_less_price" value="<?php echo number_format($UsercheckAmt[7],2,'.',''); ?>" type="hidden">
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden"  />
                <input type="hidden" name="shipping_id" id="shipping_id" value="<?php echo $shipValDetails->row()->id; ?>" />
                <input id="email" name="email" value="<?php echo $this->session->userdata('shopsy_session_user_email'); ?>" type="hidden">
                <?php //if ($authorize_net_settings['status'] == 'Enable'){ ?>
                <input type="hidden" name="creditvalue" id="creditvalue" value="authorize" />
                <?php //}elseif($paypal_credit_card_settings['status'] == 'Enable'){ ?>
               <?php /*?> <input type="hidden" name="creditvalue" id="creditvalue" value="paypaldodirect" /><?php */?>
                <?php //} ?>
                <input name="CreditSubmit" id="CreditSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
			<script>
jQuery(function($) {
	$("#UserPaymentStripeForm").validate();
  $('#UserPaymentStripeForm').submit(function(event) {
    var $form = $(this);

    // Disable the submit button to prevent repeated clicks
    $form.find('button').prop('disabled', true);
	if($form.find('label.error:visible').length==0){
		Stripe.createToken($form, stripeResponseHandler);
	}
    // Prevent the form from submitting with the default action
    return false;
  });
});

var stripeResponseHandler = function(status, response) {
  var $form = $('#UserPaymentStripeForm');

  if (response.error) {
	// Show the errors on the form
    $form.find('.payment-errors').text(response.error.message);
    $form.find('button').prop('disabled', false);
  } else {
    // token contains id, last4, and card type
    var token = response.id;
    // Insert the token into the form so it gets submitted to the server
    $form.append($('<input type="hidden" name="stripeToken" />').val(token));
    // and submit
    $form.get(0).submit();
  }
};

</script>
          </div>
          <?php }
		  
		  if ($CheckoutVal->row()->payment_type == 'COD'){  
		   ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="COD"> 
            <script>$(document).ready(function(){	$("#UserPaymentCodForm").validate();
					$.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
				
					$.validator.addMethod("ValidZipCode", function( value, element ) {	var result = this.optional(element) || value.length >= 3;
					if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);});
		   	</script>
            <form name="UserPaymentCodForm" id="UserPaymentCodForm" method="post" enctype="multipart/form-data" action="site/checkout/UserPaymentOnDelivery"  autocomplete="off">
              <?php /*?><input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $SellerDetails->row()->PayPal_mode; ?>"  />
              <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $SellerDetails->row()->PayPal_email; ?>"  /><?php */?>
              
              <input type="hidden" name="codmode" id="codmode" value="COD"  />
              <input type="hidden" name="codEmail" id="codEmail" value="<?php echo $paypalProcess['merchant_email']; ?>"  />
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt class="chekout_heading"><b>
                      <?php if($this->lang->line('checkout_billing_addr') != '') { echo stripslashes($this->lang->line('checkout_billing_addr')); } else echo "Billing Address"; ?>
                      </b> <small>
                     <?php if($this->lang->line('enter_yr_shipping_add') != '') { echo stripslashes($this->lang->line('enter_yr_shipping_add')); } else echo "Enter your Billing address"; ?> 
                      </small></dt>
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $shipValDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $shipValDetails->row()->address1; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $shipValDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $shipValDetails->row()->city; ?>">
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>&nbsp;</b> <small>&nbsp;</small></dt>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b>*</b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $shipValDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
                        <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $shipValDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $shipValDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $shipValDetails->row()->phone; ?>">
                    </dd>
                  </dl>
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">

                        <dt>Ship to</dt>
                        <dd>
                            <p><br /><br />  </p>
                        </dd>
                    </dl-->
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { 
					       echo stripslashes($this->lang->line('checkout_order')); 
						 } 
						 else echo "Order"; ?>
                    </dt>
                    <dd>
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                  	<?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>"  readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
						
			
					<?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
                    <?php }} ?>                    
                </div>

                <input id="cart_price" name="cart_price" value="<?php echo number_format($UsercheckAmt[0],2,'.',''); ?>" type="hidden">
		        <input id="ship_price" name="ship_price" value="<?php echo number_format($UsercheckAmt[1],2,'.',''); ?>" type="hidden">
                <input id="tax_price" name="tax_price" value="<?php echo number_format($UsercheckAmt[2],2,'.',''); ?>" type="hidden">
                <input id="discount_price" name="discount_price" value="<?php echo number_format($UsercheckAmt[5],2,'.',''); ?>" type="hidden">
                <input id="gift_discount_price" name="gift_discount_price" value="<?php echo number_format($UsercheckAmt[6],2,'.',''); ?>" type="hidden">
                <input id="cart_less_price" name="cart_less_price" value="<?php echo number_format($UsercheckAmt[7],2,'.',''); ?>" type="hidden">
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden">
				
                <input id="email" name="email" value="<?php echo $this->session->userdata['shopsy_session_user_email']; ?>" type="hidden">
				
                <input name="CodSubmit" id="CodSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete the Process"; ?>" style="cursor:pointer;"  />
                
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
          <?php 
		  }
		  
		  if ($CheckoutVal->row()->payment_type == 'userCredits'){
		  	?>
		            <div class="cart-payment-wrap card-payment new-card-payment" id="userCredits"> 
		              <script>$(document).ready(function(){	$("#UserPaymentCodForm").validate();
		  					$.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
				
							$.validator.addMethod("ValidZipCode", function( value, element ) {	var result = this.optional(element) || value.length >= 3;
		  					if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);});
		  		   	</script>
		              <form name="userCreditsForm" id="userCreditsForm" method="post" enctype="multipart/form-data" action="site/checkout/UserPaymentOnUserCredits"  autocomplete="off">
		                <?php /*?><input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $SellerDetails->row()->PayPal_mode; ?>"  />
		                <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $SellerDetails->row()->PayPal_email; ?>"  /><?php */?>
		                <div id="complete-payment">
		                  <div class="hotel-booking-left">
		                    <dl class="payment-personal">
		                      <dt class="chekout_heading"><b>
		                        <?php if($this->lang->line('checkout_billing_addr') != '') { echo stripslashes($this->lang->line('checkout_billing_addr')); } else echo "Billing Address"; ?>
		                        </b> <small>
		                       <?php if($this->lang->line('enter_yr_shipping_add') != '') { echo stripslashes($this->lang->line('enter_yr_shipping_add')); } else echo "Enter your Billing address"; ?> 
		                        </small></dt>
		                      <dd>
		                        <label for="payment-personal-name-fst">
		                          <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
		                          <b>*</b></label>
		                        <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $shipValDetails->row()->full_name; ?>" />
		                      </dd>
		                      <dd>
		                        <label for="payment-adds-1">
		                          <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
		                          <b>*</b></label>
		                        <input id="address" name="address" type="text" class="required" value="<?php echo $shipValDetails->row()->address1; ?>">
		                      </dd>
		                      <dd>
		                        <label for="payment-adds-1">
		                          <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
		                          2</label>
		                        <input id="address2" name="address2" type="text" class="" value="<?php echo $shipValDetails->row()->address2; ?>">
		                      </dd>
		                      <dd>
		                        <label for="payment-city">
		                          <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
		                          <b>*</b></label>
		                        <input id="city" name="city" type="text" class="required" value="<?php echo $shipValDetails->row()->city; ?>">
		                      </dd>
		                    </dl>
		                    <dl class="payment-card">
		                      <dt><b>&nbsp;</b> <small>&nbsp;</small></dt>
		                      <dd>
		                        <label for="payment-state">
		                          <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
		                          <b>*</b></label>
		                        <input id="state" name="state" type="text" class="required" value="<?php echo $shipValDetails->row()->state; ?>">
		                      </dd>
		                      <dd>
		                        <label for="payment-state">
		                          <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
		                          <b>*</b></label>
		                        <select id="country" name="country" class="select-round select-white select-country selectBox required">
		                          <option value="">--------------------
		                          <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
		                          --------------------</option>
		                          <?php foreach($countryList->result() as $cntyRow){ ?>
		                          <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $shipValDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
		                          <?php } ?>
		                        </select>
		                      </dd>
		                      <dd>
		                        <label for="payment-zipcode">
		                          <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
		                          <b>*</b></label>
		                        <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $shipValDetails->row()->postal_code; ?>">
		                      </dd>
		                      <dd>
		                        <label for="payment-phone">
		                          <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
		                          <b>*</b></label>
		                        <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $shipValDetails->row()->phone; ?>">
		                      </dd>
		                    </dl>

		                  </div>
		                  <div class="cart-payment"> 
		                    <!--dl class="cart-payment-ship">
		  
		                          <dt>Ship to</dt>
		                          <dd>
		                              <p><br /><br />  </p>
		                          </dd>
		                      </dl-->
		                    <dl class="cart-payment-order">
		                      <dt>
		                        <?php if($this->lang->line('checkout_order') != '') { 
		  					       echo stripslashes($this->lang->line('checkout_order')); 
		  						 } 
		  						 else echo "Order"; ?>
		                      </dt>
		                      <dd>
		                        <ul>
		                          <li class="first"> <span class="order-payment-type">
		                            <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
		                            </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
		                          <li> <span class="order-payment-type">
		                            <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
		                            </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
		                          <li> <span class="order-payment-type">
		                            <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
		                            </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
		                          <?php if($UsercheckAmt[5] > 0){ ?>
		                          <li> <span class="order-payment-type">
		                            <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
		                            </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
		                          <?php } ?>
		                          <?php if($UsercheckAmt[6] > 0){ ?>
		                          <li> <span class="order-payment-type">
		                            <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
		                            </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
		                          <?php } ?>
		                          <li class="total"> <span class="order-payment-type"><b>
		                            <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
		                            </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
		                        </ul>
		                      </dd>
		                    </dl>
		                    
		                    	<?php if($SellerDetails->row()->gift_card=='Yes'){ 
		  						if($UsercheckAmt[6] > 0){ ?>
		                          <div style=" margin: 40px 14px 20px;" class="checkout_header">
		                          <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
		                          <span id="ReedemErr" style="color:#FF0000;"></span>
		                          <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
		                          <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
		                          <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
		                      </div>

		  					<?php }else{ ?>
		                      <div style=" margin: 40px 14px 20px;" class="checkout_header">
		                          <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
		                          <span id="ReedemErr" style="color:#FF0000;"></span>
		                          <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
		                          <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
		                          <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
		                      </div>
		                      <?php }} ?>
		                      
			                    <?php if($userDetails->row()->fb_discountvalue != 0 || $userDetails->row()->fb_purchase_count){?>
			  					<div style=" margin: 40px 14px 20px;" class="checkout_header">
			                    <?php if($userDetails->row()->fb_discounttype == 'Flat'){?>
			                    <?php echo "You have flat $".$userDetails->row()->fb_discountvalue." discount for first ".$userDetails->row()->fb_purchase_count." purchase" ?>
			                    <?php }else{?>
			                    <?php echo "You have ".$userDetails->row()->fb_discountvalue." percentage discount for first ".$userDetails->row()->fb_purchase_count." purchase" ?>
			                    <?php }?>
			                    </div>
			  					<?php }?>

		                  </div>
		  
		  				

							<input id="cart_price" name="cart_price" value="<?php echo number_format($UsercheckAmt[0],2,'.',''); ?>" type="hidden">
							<input id="ship_price" name="ship_price" value="<?php echo number_format($UsercheckAmt[1],2,'.',''); ?>" type="hidden">
		                  <input id="tax_price" name="tax_price" value="<?php echo number_format($UsercheckAmt[2],2,'.',''); ?>" type="hidden">
		                  <input id="discount_price" name="discount_price" value="<?php echo number_format($UsercheckAmt[5],2,'.',''); ?>" type="hidden">
		                  <input id="gift_discount_price" name="gift_discount_price" value="<?php echo number_format($UsercheckAmt[6],2,'.',''); ?>" type="hidden">
		                  <input id="cart_less_price" name="cart_less_price" value="<?php echo number_format($UsercheckAmt[7],2,'.',''); ?>" type="hidden">
		                  <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3],2,'.',''); ?>" type="hidden">
		                  <input id="email" name="email" value="<?php echo $this->session->userdata['shopsy_session_user_email']; ?>" type="hidden">
		  				
						<input name="userCreditSubmit" id="userCreditSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
		                  
		                  <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
		                  
		                  <div class="card-payment-foot">
		                    <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
		                    &amp;
		                    <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
		                    .</div>
		                </div>
		              </form>
		            </div>
		            <?php 
		  		  }
                                  
                  if ($CheckoutVal->row()->payment_type == 'payon') { ?>
                    <div class="cart-payment-wrap card-payment new-card-payment" id="payon"> 
                    <div id="complete-payment">
                      <div class="hotel-booking-left">                          
                       <form name="payonform" class="paymentWidgets" id="payonform" method="POST" action="<?php echo base_url(); ?>site/checkout/payon_return"  autocomplete="off">
                           VISA MASTER AMEX
                       </form>
                      </div>
<div class="cart-payment"> 
		                    <!--dl class="cart-payment-ship">
		  
		                          <dt>Ship to</dt>
		                          <dd>
		                              <p><br /><br />  </p>
		                          </dd>
		                      </dl-->
		                    <dl class="cart-payment-order">
		                      <dt>
		                        <?php if($this->lang->line('checkout_order') != '') { 
		  					       echo stripslashes($this->lang->line('checkout_order')); 
		  						 } 
		  						 else echo "Order"; ?>
		                      </dt>
		                      <dd>
		                        <ul>
		                          <li class="first"> <span class="order-payment-type">
		                            <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
		                            </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
		                          <li> <span class="order-payment-type">
		                            <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
		                            </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
		                          <li> <span class="order-payment-type">
		                            <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
		                            </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
		                          <?php if($UsercheckAmt[5] > 0){ ?>
		                          <li> <span class="order-payment-type">
		                            <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
		                            </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
		                          <?php } ?>
		                          <?php if($UsercheckAmt[6] > 0){ ?>
		                          <li> <span class="order-payment-type">
		                            <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
		                            </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
		                          <?php } ?>
		                          <li class="total"> <span class="order-payment-type"><b>
		                            <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
		                            </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
		                        </ul>
		                      </dd>
		                    </dl>
		                    
		                    	<?php if($SellerDetails->row()->gift_card=='Yes'){ 
		  						if($UsercheckAmt[6] > 0){ ?>
		                          <div style=" margin: 40px 14px 20px;" class="checkout_header">
		                          <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
		                          <span id="ReedemErr" style="color:#FF0000;"></span>
		                          <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left" placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>"  readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
		                          <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
		                          <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
		                      </div>

		  					<?php }else{ ?>
		                      <div style=" margin: 40px 14px 20px;" class="checkout_header">
		                          <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
		                          <span id="ReedemErr" style="color:#FF0000;"></span>
		                          <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left"placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
		                          <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
		                          <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
		                      </div>
		                      <?php }} ?>
		                      
			                    <?php if($userDetails->row()->fb_discountvalue != 0 || $userDetails->row()->fb_purchase_count){?>
			  					<div style=" margin: 40px 14px 20px;" class="checkout_header">
			                    <?php if($userDetails->row()->fb_discounttype == 'Flat'){?>
			                    <?php echo "You have flat $".$userDetails->row()->fb_discountvalue." discount for first ".$userDetails->row()->fb_purchase_count." purchase" ?>
			                    <?php }else{?>
			                    <?php echo "You have ".$userDetails->row()->fb_discountvalue." percentage discount for first ".$userDetails->row()->fb_purchase_count." purchase" ?>
			                    <?php }?>
			                    </div>
			  					<?php }?>

		                  </div>  
                        <div class="card-payment-foot"></div>
                    </div>
                    </div>
                 <?php }            
		  ?>
		  
          <div class="cart-payment-wrap card-payment new-card-payment" id="otherPay" style="display:none;">
            <div id="complete-payment">
              <div class="hotel-booking-left" style="width:100%;text-align:center;padding-top:50px;min-height: 100px;"> <img src="images/site/payment.jpg"/>
                <p style="font-size:17px;margin-top:25px;">"
                  <?php if($this->lang->line('checkout_req_merchang') != '') { echo stripslashes($this->lang->line('checkout_req_merchang')); } else echo "Will be configured on request during setup of the script . Requires merchant account creation and customization"; ?>
                  "</p>
              </div>
            </div>
          </div>
          <?php  }else{ ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="PaypalPay" style="display:block;"> 
            <script>$(document).ready(function(){	$("#PaymentPaypalForm").validate();
					 $.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }},<?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
				 
					  $.validator.addMethod("ValidZipCode", function( value, element ) {
								var result = this.optional(element) || value.length >= 3;
												if (!result) {
													return false;
												}
												else{
												return true;
												}
							}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);
					  
					   });</script>
            <form name="PaymentPaypalForm" id="PaymentPaypalForm" method="post" enctype="multipart/form-data" action="site/checkout/PaymentGiftFree" autocomplete="off">
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt><b>
                      <?php if($this->lang->line('checkout_billing_addr') != '') { echo stripslashes($this->lang->line('checkout_billing_addr')); } else echo "Billing Address"; ?>
                      </b> <small>
                     <?php if($this->lang->line('shop_enter_billing_address') != '') { echo stripslashes($this->lang->line('shop_enter_billing_address')); } else echo "Enter your billing address"; ?>
                      </small></dt>
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $shipValDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $shipValDetails->row()->address1; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $shipValDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $shipValDetails->row()->city; ?>">
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>&nbsp;</b> <small>&nbsp;</small></dt>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b></b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $shipValDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state"><?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?> <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $shipValDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $shipValDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $shipValDetails->row()->phone; ?>">
                    </dd>
                  </dl>
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment">
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { 
					       echo stripslashes($this->lang->line('checkout_order')); 
						 } 
						 else echo "Order"; ?>
                    </dt>
                    <dd>
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[0] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[1] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[2] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php if($UsercheckAmt[5] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo "Coupon Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[5] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <?php if($UsercheckAmt[6] > 0){ ?>
                        <li> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo "Gift Discount"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[6] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <?php } ?>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                  	<?php if($SellerDetails->row()->gift_card=='Yes'){ 
						if($UsercheckAmt[6] > 0){ ?>
                        <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left"placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>"  readonly="readonly" value="<?php echo $discountQuery->row()->giftcouponcode; ?>">
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="Remove" onclick="reedemGiftcardRemove();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
						
			
					<?php }else{ ?>
                    <div style=" margin: 40px 14px 20px;" class="checkout_header">
                        <h3><?php if($this->lang->line('checkout_reedem') != '') { echo stripslashes($this->lang->line('checkout_reedem')); } else echo "Reedem an"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('checkout_giftcard') != '') { echo stripslashes($this->lang->line('checkout_giftcard')); } else echo "Gift Card"; ?></h3>
                        <span id="ReedemErr" style="color:#FF0000;"></span>
                        <input type="text" name="reedemcode" id="reedemcode" class="checkout_txt left"placeholder="<?php if($this->lang->line('enter_redeem_code') != '') { echo stripslashes($this->lang->line('enter_redeem_code')); } else echo "Enter your redeem code"; ?>" >
                        <input type="button" style="width:160px; margin:10px 0 0 52px; width:auto; font-size:13px; font-weight:normal" class="checkout_btn" value="<?php if($this->lang->line('redeem_now') != '') { echo stripslashes($this->lang->line('redeem_now')); } else echo "Redeem Now"; ?>" onclick="reedemGiftcard();">
                        <span id="reedemLoad" style="display:none;" ><img src="images/ajax_loader_blue.gif" alt="Loading..." style="margin-top:20px" /></span>
                    </div>
                    <?php }} ?>                    
                
                </div>
                <input id="total_price" name="total_price" value="<?php echo number_format($UsercheckAmt[3] * $currencyValue,2,'.',''); ?>" type="hidden">
                <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                <input name="PaypalSubmit" id="PaypalSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_purchas') != '') { echo stripslashes($this->lang->line('checkout_comp_purchas')); } else echo "Complete Purchase"; ?>" style="cursor:pointer;"  />
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
          <?php }
		 
		 	}elseif($this->uri->segment(2)=='gift'){
				 ?>
          <div class="cart-payment-wrap card-payment new-card-payment" id="PaypalPay" style="display:<?php if ($this->input->post('gift_payment_value') == 'Paypal'){echo 'block';}else {echo 'none';}?>;"> 
            <script>$(document).ready(function(){	$("#PaymentGiftPaypalForm").validate();
					  
					$.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }}, <?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
									
					$.validator.addMethod("ValidZipCode", function( value, element ) {
								var result = this.optional(element) || value.length >= 3;
												if (!result) {
													return false;
												}
												else{
												return true;
												}
							}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);
					  
					   });</script>
            <form name="PaymentGiftPaypalForm" id="PaymentGiftPaypalForm" method="post" enctype="multipart/form-data" action="site/checkout/PaymentProcessGift"  autocomplete="off">
              <input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $paypalProcess['mode']; ?>"  />
              <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $paypalProcess['merchant_email']; ?>"  />
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-personal">
                    <dt><b>
                      <?php if($this->lang->line('checkout_billing_addr') != '') { echo stripslashes($this->lang->line('checkout_billing_addr')); } else echo "Billing Address"; ?>
                      </b> <small>
                    <?php if($this->lang->line('shop_enter_billing_address') != '') { echo stripslashes($this->lang->line('shop_enter_billing_address')); } else echo "Enter your billing address"; ?>
                      </small></dt>
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $userDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $userDetails->row()->address; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $userDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $userDetails->row()->city; ?>">
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>&nbsp;</b> <small>&nbsp;</small></dt>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b>*</b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $userDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
                        <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $userDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $userDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $userDetails->row()->phone_no; ?>">
                    </dd>
                  </dl>
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">
	
									<dt>Ship to</dt>
									<dd>
										<p><br /><br />  </p>
									</dd>
								</dl-->
                  <dl class="cart-payment-order">
                    <dt><?php if($this->lang->line('checkout_order') != '') { echo stripslashes($this->lang->line('checkout_order')); } else echo "Order"; ?></dt>
                    <dd>
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($GiftViewTotal * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($GiftViewTotal * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                </div>
                <input id="total_price" name="total_price" value="<?php echo number_format($GiftViewTotal * $currencyValue,2,'.',''); ?>" type="hidden">
                <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                <input name="PaypalSubmit" id="PaypalSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
          <div class="cart-payment-wrap card-payment new-card-payment" id="CreditCardPay" style="display:<?php if ($this->input->post('gift_payment_value') == 'Credit-Card'){echo 'block';}else {echo 'none';}?>;"> 
            <script>$(document).ready(function(){	$("#PaymentGiftCreditForm").validate();
					  
					  $.validator.addMethod("ValidZipCode", function( value, element ) {
								var result = this.optional(element) || value.length >= 3;
												if (!result) {
													return false;
												}
												else{
												return true;
												}
							}, <?php echo artfill_lg('lg_enter_correct_pincode','Please Enter the Correct ZipCode');?>);
					  
					   });
					   $.validator.addMethod("Validphno", function( value, element ) {  var result = this.optional(element) || value.length >= 8;
				if (!result) { return false; }else{ return true; }},<?php echo artfill_lg('lg_enter_correct_phno','Please Enter the Correct ZipCode');?>);
				</script>
            <form name="PaymentGiftCreditForm" id="PaymentGiftCreditForm" method="post" enctype="multipart/form-data" action="site/checkout/PaymentCreditGift" autocomplete="off">
              <div id="complete-payment">
                <div class="hotel-booking-left">
                  <dl class="payment-card">
                    <dt><b>
                      <?php if($this->lang->line('checkout_cc_info') != '') { echo stripslashes($this->lang->line('checkout_cc_info')); } else echo "Credit Card Information"; ?>
                      </b> <span>
                      <?php if($this->lang->line('checkout_visa_mster') != '') { echo stripslashes($this->lang->line('checkout_visa_mster')); } else echo "Visa, MasterCard, Discover or American Express"; ?>
                      </span></dt>
                    <!--<dd class="comment"><b>*</b>  = <?php if($this->lang->line('checkout_mand_fields') != '') { echo stripslashes($this->lang->line('checkout_mand_fields')); } else echo "Mandatory fields"; ?></dd>-->
                    <dd>
                      <label for="payment-personal-name-fst">
                        <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?>
                        <b>*</b></label>
                      <input name="full_name" id="full_name" type="text" class="required" value="<?php echo $userDetails->row()->full_name; ?>" />
                    </dd>
                    <dd>
                      <label for="payment-card-number">
                        <?php if($this->lang->line('checkout_card_no') != '') { echo stripslashes($this->lang->line('checkout_card_no')); } else echo "Card Number"; ?>
                        <b>*</b></label>
                      <input id="cardNumber" name="cardNumber" autocomplete="off" class="required number" maxlength="16" size="16" type="text" />
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_enter_cardno') != '') { echo stripslashes($this->lang->line('checkout_enter_cardno')); } else echo "Please enter valid card number"; ?>.</p><?php */?>
                    </dd>
                    <dd>
                      <label for="payment-card-number">
                        <?php if($this->lang->line('checkout_card_type') != '') { echo stripslashes($this->lang->line('checkout_card_type')); } else echo "Card Type"; ?>
                        <b>*</b></label>
                      <select id="cardType" name="cardType" class="select-round select-white select-country selectBox required">
                        <option value="Amex"><?php if($this->lang->line('user_amrican_exp') != '') { echo stripslashes($this->lang->line('user_amrican_exp')); } else echo 'American Express'; ?></option>
                        <option value="Visa"><?php if($this->lang->line('user_visa') != '') { echo stripslashes($this->lang->line('user_visa')); } else echo 'Visa'; ?></option>
                        <option value="MasterCard"><?php if($this->lang->line('user_master_card') != '') { echo stripslashes($this->lang->line('user_master_card')); } else echo 'Master Card'; ?></option>
                        <option value="Discover"><?php if($this->lang->line('user_discover') != '') { echo stripslashes($this->lang->line('user_discover')); } else echo 'Discover'; ?></option>
                      </select>
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_select_card') != '') { echo stripslashes($this->lang->line('checkout_select_card')); } else echo "Please select card"; ?>.</p><?php */?>
                    </dd>
                    <!--                                        <dd class="select-card">
                                            <label for="payment-card-type1" class="payment-card-type1"></label> 
											<label for="payment-card-type2" class="payment-card-type2"></label>
											<label for="payment-card-type3" class="payment-card-type3"></label>
											<label for="payment-card-type4" class="payment-card-type4"></label>
                                            <p class="error">Please select card.</p>
										</dd>
-->
                    <dd>
                      <label for="payment-card-expiration">
                        <?php if($this->lang->line('checkout_exp_date') != '') { echo stripslashes($this->lang->line('checkout_exp_date')); } else echo "Expiration Date"; ?>
                        <b>*</b></label>
                      <?php $Sel ='selected="selected"';  ?>
                      <select id="CCExpDay" name="CCExpDay" class="select-round select-white select-date selectBox required">
                        <option value="01" <?php if(date('m')=='01'){ echo $Sel;} ?>>01</option>
                        <option value="02" <?php if(date('m')=='02'){ echo $Sel;} ?>>02</option>
                        <option value="03" <?php if(date('m')=='03'){ echo $Sel;} ?>>03</option>
                        <option value="04" <?php if(date('m')=='04'){ echo $Sel;} ?>>04</option>
                        <option value="05" <?php if(date('m')=='05'){ echo $Sel;} ?>>05</option>
                        <option value="06" <?php if(date('m')=='06'){ echo $Sel;} ?>>06</option>
                        <option value="07" <?php if(date('m')=='07'){ echo $Sel;} ?>>07</option>
                        <option value="08" <?php if(date('m')=='08'){ echo $Sel;} ?>>08</option>
                        <option value="09" <?php if(date('m')=='09'){ echo $Sel;} ?>>09</option>
                        <option value="10" <?php if(date('m')=='10'){ echo $Sel;} ?>>10</option>
                        <option value="11" <?php if(date('m')=='11'){ echo $Sel;} ?>>11</option>
                        <option value="12" <?php if(date('m')=='12'){ echo $Sel;} ?>>12</option>
                      </select>
                      <select id="CCExpMnth" name="CCExpMnth" class="select-round select-white select-date selectBox required">
                        <?php for($i=date('Y');$i< (date('Y') + 30);$i++){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-card-security">
                        <?php if($this->lang->line('checkout_security_code') != '') { echo stripslashes($this->lang->line('checkout_security_code')); } else echo "Security Code"; ?>
                      </label>
                      <input style="width:63px;" id="payment-card-security" autocomplete="off"  name="creditCardIdentifier" class="input-code required number" type="password">
                      <?php /*?><a href="#" class="tooltip" onClick="$('.card-back').show();return false;">
                      <?php if($this->lang->line('checkout_what_this') != '') { echo stripslashes($this->lang->line('checkout_what_this')); } else echo "What is this?"; ?>
                      </a><?php */?>
                      <?php /*?><p class="error"><?php if($this->lang->line('checkout_enter_sc') != '') { echo stripslashes($this->lang->line('checkout_enter_sc')); } else echo "Please enter security code"; ?>.</p><?php */?>
                      <dl class="card-back">
                        <dt>
                          <?php /*if($this->lang->line('checkout_cvc_cvs') != '') { echo stripslashes($this->lang->line('checkout_cvc_cvs')); } else echo "Security Code (CVC or CVS)";*/ ?>
                        </dt>
                        <dd> <!--<img src="images/card-back.gif" alt="">-->
                          <?php /*if($this->lang->line('checkout_last_three') != '') { echo stripslashes($this->lang->line('checkout_last_three')); } else echo "Last three digits on the back of your card is the CVC or CVV number"; ?>.<br>&nbsp;<br><?php if($this->lang->line('checkout_for_ameri') != '') { echo stripslashes($this->lang->line('checkout_for_ameri')); } else echo "For American Express there is a four digit code on the front";*/ ?>
                          . <a href="#" onClick="$('.card-back').hide();return false;" title="Close"></a> </dd>
                      </dl>
                    </dd>
                  </dl>
                  <dl class="payment-card">
                    <dt><b>
                      <?php if($this->lang->line('checkout_billing_addr') != '') { echo stripslashes($this->lang->line('checkout_billing_addr')); } else echo "Billing Address"; ?>
                      </b> <span>
                    <?php if($this->lang->line('shop_enter_billing_address') != '') { echo stripslashes($this->lang->line('shop_enter_billing_address')); } else echo "Enter your billing address"; ?>
                      </span></dt>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        <b>*</b></label>
                      <input id="address" name="address" type="text" class="required" value="<?php echo $userDetails->row()->address; ?>">
                    </dd>
                    <dd>
                      <label for="payment-adds-1">
                        <?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?>
                        2</label>
                      <input id="address2" name="address2" type="text" class="" value="<?php echo $userDetails->row()->address2; ?>">
                    </dd>
                    <dd>
                      <label for="payment-city">
                        <?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?>
                        <b>*</b></label>
                      <input id="city" name="city" type="text" class="required" value="<?php echo $userDetails->row()->city; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?>
                        <b>*</b></label>
                      <input id="state" name="state" type="text" class="required" value="<?php echo $userDetails->row()->state; ?>">
                    </dd>
                    <dd>
                      <label for="payment-state">
                        <?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?>
                        <b>*</b></label>
                      <select id="country" name="country" class="select-round select-white select-country selectBox required">
                        <option value="">--------------------
                        <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?>
                        --------------------</option>
                        <?php foreach($countryList->result() as $cntyRow){ ?>
                        <option value="<?php echo $cntyRow->name; ?>" <?php if($cntyRow->name == $userDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                        <?php } ?>
                      </select>
                    </dd>
                    <dd>
                      <label for="payment-zipcode">
                        <?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?>
                        <b>*</b></label>
                      <input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $userDetails->row()->postal_code; ?>">
                    </dd>
                    <dd>
                      <label for="payment-phone">
                        <?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?>
                        <b>*</b></label>
                      <input id="phone_no" name="phone_no" type="text" class="required Validphno number" value="<?php echo $userDetails->row()->phone_no; ?>">
                    </dd>
                  </dl>
                  <!--p class="payment-save-check">
									<input type="checkbox" id="payment-save-card"  />
	
									<label for="payment-save-card">Save your credit card details for any future orders</label>
									<span class="error">Please check saving your credit card.</span>
								</p-->
                  
                  <div class="hotel-booking-noti"><big>
                    <?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?>
                    </big>
                    <?php /*if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;*/?>
                  </div>
                </div>
                <div class="cart-payment"> 
                  <!--dl class="cart-payment-ship">
	
									<dt>Ship to</dt>
									<dd>
										<p><br /><br />  </p>
									</dd>
								</dl-->
                  
                  <dl class="cart-payment-order">
                    <dt>
                      <?php if($this->lang->line('checkout_order') != '') { echo stripslashes($this->lang->line('checkout_order')); } else echo "Order"; ?>
                    </dt>
                    <dd>
                      <ul>
                        <li class="first"> <span class="order-payment-type">
                          <?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?>
                          </span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($GiftViewTotal * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                        <li class="total"> <span class="order-payment-type"><b>
                          <?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?>
                          </b></span> <span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($GiftViewTotal * $currencyValue,2,'.',''); ?></b> <?php echo $currencyType;?></span> </li>
                      </ul>
                    </dd>
                  </dl>
                </div>
                <input id="total_price" name="total_price" value="<?php echo number_format($GiftViewTotal * $currencyValue,2,'.',''); ?>" type="hidden">
                <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                <?php /*if ($authorize_net_settings['status'] == 'Enable'){*/ ?>
                <input type="hidden" name="creditvalue" id="creditvalue" value="authorize" />
                <?php /*}elseif($paypal_credit_card_settings['status'] == 'Enable'){ ?>
                <input type="hidden" name="creditvalue" id="creditvalue" value="paypaldodirect" />
                <?php }*/ ?>
                <input name="CreditSubmit" id="CreditSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                
                <!--<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>-->
                <div class="card-payment-foot">
                  <?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?>
                  &amp;
                  <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>
                  .</div>
              </div>
            </form>
          </div>
          <?php 
			}
        ?>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<script type="text/javascript" src="js/site/jquery.validate.js"></script>

 <script type="text/javascript" src="https://js.braintreegateway.com/v1/braintree.js"></script>
<script>
	var braintree = Braintree.create("<?php echo $Setting_Details['CSE_Key'];?>");
    braintree.onSubmitEncryptForm('BrainTreeForm');

   var ajax_submit = function (e) {
		//alert("alert");
        form = $('#BrainTreeForm');
        e.preventDefault();
        var err = 0;
        form.find('input, select').each(function(){
            if($(this).hasClass('required')){
				/* if(!(IsNumeric('#cardNumber'.val())){
					consloe.log("asdf");
					err++;
					alert($(this).prev('label').text()+' Must be a number');
					return false;
				} */if($(this).val() == ''){
					err++;
					alert($(this).prev('label').text()+' required');
					$(this).focus();
					return false;
				}else{
					if($(this).hasClass('number')){
						if(($(this).val()-$(this).val()) != 0){
							err++;
							alert($(this).prev('label').text()+' must be a number');
							$(this).focus();
							return false;
						}
					}
				}
            }
		});
		if(err==0){
			//alert("alert");
	        $("#CreditSubmit").attr("disabled", "disabled").css('opacity',0.2);
    	    $.post(form.attr('action'), form.serialize(), function (data) {
        	    console.log(data);
					var str=data;
					var path=str.replace("ok<pre>", "");
					//alert(baseURL+path);
	        	  	window.location = baseURL+path;
        	   
        	});
		}
    };
	braintree.onSubmitEncryptForm('BrainTreeForm', ajax_submit); 

</script>
<?php $this->load->view('site/templates/footer'); ?>