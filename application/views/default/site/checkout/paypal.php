<?php 
$this->load->view('site/templates/header.php');

?>

<link rel="stylesheet" media="all" type="text/css" href="css/default/site/developer.css">
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
            <li class="depth1 current" id="dep1" style="background:none;"><span>1</span><a onclick="javascript:paypal();" class="current">
              <?php if($this->lang->line('checkout_paypal') != '') { echo stripslashes($this->lang->line('checkout_paypal')); } else echo "Paypal"; ?>
              </a></li>
          </ol>
          <?php } ?>
          <div class="clear"></div>
		   <div class="cart-payment-wrap card-payment new-card-payment" id="PaypalPay" > 
            <script>$(document).ready(function(){	$("#PaymentGiftPaypalForm").validate();
					  
					  $.validator.addMethod("ValidZipCode", function( value, element ) {
								var result = this.optional(element) || value.length >= 3;
												if (!result) {
													return false;
												}
												else{
												return true;
												}
							}, "Please Enter the Correct ZipCode");
					  
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
                      <input id="phone_no" name="phone_no" type="text" class="required" value="<?php echo $userDetails->row()->phone_no; ?>">
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
		 </div>
		</div>
	</div>
 </div>
</section>
<script type="text/javascript" src="js/site/jquery.validate.js"></script>

<script src="https://js.braintreegateway.com/v1/braintree.js"></script>
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
				if($(this).val() == ''){
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
        	    console.log(data);//return false;
        	    if(data.substr(0,5)=='order'){
	        	  	window.location = baseURL+data;
        	    }else{
	        	  	window.location = baseURL+'order/failure/Invalid credentials';
        	    }
        	});
		}
    };
	braintree.onSubmitEncryptForm('BrainTreeForm', ajax_submit);
</script>
<?php $this->load->view('site/templates/footer'); ?>
