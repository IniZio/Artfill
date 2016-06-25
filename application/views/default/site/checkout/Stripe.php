<?php 
$this->load->view('site/templates/header.php');

?>

<link rel="stylesheet" media="all" type="text/css" href="css/default/site/developer.css">
<section>
  <div class="main">
    <div class="container">
      
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
            <li class="depth1 current" id="dep1" style="background:none;"><span>3</span><a onclick="javascript:paypal();" class="current">
              <?php if($this->lang->line('checkout_stripe') != '') { echo stripslashes($this->lang->line('checkout_stripe')); } else echo "Stripe"; ?>
              </a></li>
          </ol>
          <?php } ?>
          <div class="clear"></div>
			<div class="cart-payment-wrap card-payment new-card-payment" id="StripePay"> 
            <script>$(document).ready(function(){	
					</script>
			<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

			<script type="text/javascript">
				// This identifies your website in the createToken call below
				Stripe.setPublishableKey('<?php echo $StripeVal['publishable_key']; ?>');
				// ...
			</script>
            <form name="UserPaymentStripeForm" id="UserPaymentStripeForm" method="post" enctype="multipart/form-data" action="site/checkout/UserPaymentCreditStripe1" autocomplete="off">
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
                      <input id="phone_no" name="phone_no" type="text" class="required" value="<?php echo $shipValDetails->row()->phone; ?>">
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
                <?php //if ($authorize_net_settings['status'] == 'Enable'){ ?>
                <input type="hidden" name="creditvalue" id="creditvalue" value="stripe" />
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

    Stripe.createToken($form, stripeResponseHandler);

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
		   </div>
		</div>
	</div>
 </div>
</section>
<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<?php $this->load->view('site/templates/footer'); ?>