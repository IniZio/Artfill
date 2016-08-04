<?php 

$this->load->view('site/templates/shop_header');
//$checkloginIDarr=$this->session->all_userdata(); echo "<pre>"; print_r($checkloginIDarr);

?>


 
<div class="clear"></div>
<div id="shop_page_seller">
<section class="container">

    	<div class="main">
		
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
          <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
		   <span>&rsaquo;</span>
		   <li><?php if($this->lang->line('Shop_billing') != '') { echo stripslashes($this->lang->line('Shop_billing')); } else echo 'Shop billing'; ?></li>
        </ul>

        <?php if($SellerValShop->row()->status == 'active'){ ?>

            <div class="shop_details">

            	<span class="shop_title"><?php if($this->lang->line('shop_choose') != '') { echo stripslashes($this->lang->line('shop_choose')); } else echo 'Choose how you want to pay your bill'; ?>.</span>                

                <div class="list_div1">

                	<div class="list_inner_fields" style="border:none">

	                    <?php $total_amt = $products_in_pay*$sellingPayment->row()->product_cost?>
 						
 						<input type="hidden" value="<?php echo $total_amt;?>" id="total_amount" name="total_amount"/>
                    	<div style="float:left; width:60%; color:#333; margin:0 0 5px; font-size:15px; line-height:normal"><strong><?php if($this->lang->line('shop_fees') != '') { echo stripslashes($this->lang->line('shop_fees')); } else echo 'Fees and Paying Your Bill'; ?></strong></div>

                        <div style="float:left; width:100%; color:#333; font-size:15px; line-height:normal; padding: 10px 10px 10px 4px; "> <?php if($this->lang->line('shop_costs') != '') { echo stripslashes($this->lang->line('shop_costs')); } else echo 'It costs'; ?> <?php echo $currencySymbol; ?><?php echo number_format($total_amt * $this->data['currencyValue'],2); ?> <?php if($this->lang->line('shop_publish') != '') { echo stripslashes($this->lang->line('shop_publish')); } else echo 'USD to publish a listing. When an item sells, we charge a'; ?> <?php echo $sellingPayment->row()->product_commission; if(substr($sellingPayment->row()->product_commission,-1) != '%') { echo '%'; }?> <?php if($this->lang->line('shop_transaction') != '') { echo stripslashes($this->lang->line('shop_transaction')); } else echo 'transaction fee on the item price'; ?>. <!--<a href="javascript: void(0);" class="decro">Learn about fees.</a>-->
                        <br>
                        <?php if($this->lang->line('shop_statement') != '') { echo stripslashes($this->lang->line('shop_statement')); } else echo 'At the end of each month, we add up your fees and email you a monthly statement'; ?>. </div>
                        
                        
                        <div style="float:left; width:100%; color:#333; font-size:12px; line-height:normal">
	                        <input type="button" onclick="Show_payment_options(this)" class="save_btn" value="<?php echo af_lg('lg_makepay','Make Pay');?>" id="pay_you_bill">
                        </div>
                        
                       <div id="paywallet" style="margin-top: 75px;padding-top: 50px;text-align: center;"></div>
                        
                       <div><span id="pay_ur_err" style="color:red;"></span></div>
                       <div id="wallet_div" style="display:none; float:left; width:100%; color:#333; font-size:12px; line-height:normal; padding: 10px 0px 0px 0px;">
                        	<span>
                        	<?php echo af_lg('lg_ur_current_amt','Your Current Wallet Amount is');?> <?php echo $currencySymbol; ?> <?php echo number_format($userDetails->credits * $this->data['currencyValue'],2); ?>
                        	<input type="hidden" id="curr_wallAmt" value="<?php echo $userDetails->credits;?>"/>
                        	
                        	<br><?php echo af_lg('lg_enter_amt','Enter your recharge amount here and continue payment');?>
                        	<input style="margin-left: 20px;" type="text" name="wallet_amount" id="wallet_amount"/>
                        	<input style="float: none;" type="button" class="save_btn" onclick="Show_wallet_payment_options(this)" value="<?php echo af_lg('lg_continue','Continue');?>" id="continue_recharge_wallet">
                        	<span id="pay_wa_err" style="color:red;"></span>
                        	
                        	</span>
                        	
                       </div>
                    </div>            
                </div>
                
               <div id="payment_options" style="display:none;"> 
				<?php //if($total_amt>0){ ?>  
                <p><?php if($this->lang->line('shop_creditcard') != '') { echo stripslashes($this->lang->line('shop_creditcard')); } else echo 'Enter the credit card you want to use to pay your bill'; ?>.</p>  

                <form name="PaymentCreditForm" id="PaymentCreditForm" method="post" enctype="multipart/form-data" action="site/checkout/ProductPaymentCredit" autocomplete="off">

                <div class="list_div" style="border-radius:5px 5px 0 0;">          

                    <p style="font-size:12px; font-weight:bold; color:#666666; text-transform:uppercase"><?php if($this->lang->line('shop_information') != '') { echo stripslashes($this->lang->line('shop_information')); } else echo 'Credit Card Information'; ?></p>

                    <div class="cardinfo_div">

                    	<div><label><?php if($this->lang->line('shop_number') != '') { echo stripslashes($this->lang->line('shop_number')); } else echo 'Card Number'; ?></label> <span>*</span></div>

                        <input type="text" class="payment_txt" name="cardNumber" id="card_number"  onblur="checkUsername(this.id);" value="<?php echo $CardsDetails->card_number; ?>">

                        <span id="card_number_err" class="errors_msg"></span>

                    </div>

                    <div class="cardinfo_div">

                    	<div><label><?php if($this->lang->line('shop_expiry') != '') { echo stripslashes($this->lang->line('shop_expiry')); } else echo 'Expiry Month'; ?></label> <span>*</span></div>

                        <div style="width:auto;">

							<?php $Sel='selected="selected"'; ?>

                            <select style="padding:6px;"  name="CCExpMnth" id="exp_month"  onChange="checkUsername(this.id);">

                                <option value="01" <?php if($CardsDetails->exp_month==''){ if(date('m')=='01'){ echo $Sel;}}else if($CardsDetails->exp_month==01){ echo $Sel;} ?>>01 - January</option>

                                <option value="02" <?php if($CardsDetails->exp_month==''){ if(date('m')=='02'){ echo $Sel;}}else if($CardsDetails->exp_month==02){ echo $Sel;} ?>>02 - February</option>

                                <option value="03" <?php if($CardsDetails->exp_month==''){ if(date('m')=='03'){ echo $Sel;}}else if($CardsDetails->exp_month==03){ echo $Sel;} ?>>03 - March</option>

                                <option value="04" <?php if($CardsDetails->exp_month==''){ if(date('m')=='04'){ echo $Sel;}}else if($CardsDetails->exp_month==04){ echo $Sel;} ?>>04 - April</option>

                                <option value="05" <?php if($CardsDetails->exp_month==''){ if(date('m')=='05'){ echo $Sel;}}else if($CardsDetails->exp_month==05){ echo $Sel;} ?>>05 - May</option>

                                <option value="06" <?php if($CardsDetails->exp_month==''){ if(date('m')=='06'){ echo $Sel;}}else if($CardsDetails->exp_month==06){ echo $Sel;} ?>>06 - June</option>

                                <option value="07" <?php if($CardsDetails->exp_month==''){ if(date('m')=='07'){ echo $Sel;}}else if($CardsDetails->exp_month==07){ echo $Sel;} ?>>07 - July</option>

                                <option value="08" <?php if($CardsDetails->exp_month==''){ if(date('m')=='08'){ echo $Sel;}}else if($CardsDetails->exp_month==08){ echo $Sel;} ?>>08 - August</option>

                                <option value="09" <?php if($CardsDetails->exp_month==''){ if(date('m')=='09'){ echo $Sel;}}else if($CardsDetails->exp_month==09){ echo $Sel;} ?>>09 - September</option>

                                <option value="10" <?php if($CardsDetails->exp_month==''){ if(date('m')=='10'){ echo $Sel;}}else if($CardsDetails->exp_month==10){ echo $Sel;} ?>>10 - October</option>

                                <option value="11" <?php if($CardsDetails->exp_month==''){ if(date('m')=='11'){ echo $Sel;}}else if($CardsDetails->exp_month==11){ echo $Sel;} ?>>11 - November</option>

                                <option value="12" <?php if($CardsDetails->exp_month==''){ if(date('m')=='12'){ echo $Sel;}}else if($CardsDetails->exp_month==12){ echo $Sel;} ?>>12 - December</option>

                            </select>

                            <select style="padding:6px;"  name="CCExpYear" id="exp_year" onChange="checkUsername(this.id);">

                                <?php for($i=date('Y');$i< (date('Y') + 15);$i++){ ?>	

                                <option value="<?php echo $i; ?>" <?php if($CardsDetails->exp_year==$i){echo 'selected="selected"'; } ?>><?php echo $i; ?></option>

                                <?php } ?>  

                            </select>

                        </div>

                        <span class="errors_msg" id="exp_err"></span>

                    </div>

                    <div class="cardinfo_div">

                    	<div><label ><?php if($this->lang->line('user_cvv') != '') { echo stripslashes($this->lang->line('user_cvv')); } else echo 'CVV'; ?></label> <span>*</span></div>

                        <input type="password" style="width:60px" class="payment_txt" name="creditCardIdentifier" id="cvv_number"  onblur="checkUsername(this.id);" maxlength="4" value="<?php echo $CardsDetails->security_code; ?>">

                        <span id="cvv_number_err"  class="errors_msg"></span>

                    </div>

                    <div class="cardinfo_div">

                    	<div><label ><?php if($this->lang->line('shop_namecard') != '') { echo stripslashes($this->lang->line('shop_namecard')); } else echo 'Name of the Card'; ?></label><span>*</span></div>

                        <!--<input type="text" class="payment_txt" name="name" id="name"  onblur="checkUsername(this.id);" value="">-->

                        <select id="name" class="payment_txt required"  name="cardType" onblur="checkUsername(this.id);">

                            <option value=""><?php if($this->lang->line('user_select_card') != '') { echo stripslashes($this->lang->line('user_select_card')); } else echo 'Select your card'; ?></option>

                            <option value="American Express" <?php if($CardsDetails->card_type=="American Express"){echo 'selected="selected"'; } ?>><?php if($this->lang->line('user_amrican_exp') != '') { echo stripslashes($this->lang->line('user_amrican_exp')); } else echo 'American Express'; ?></option>

                            <option value="Visa" <?php if($CardsDetails->card_type=="Visa"){echo 'selected="selected"'; } ?>><?php if($this->lang->line('user_visa') != '') { echo stripslashes($this->lang->line('user_visa')); } else echo 'Visa'; ?></option>

                            <option value="Master Card" <?php if($CardsDetails->card_type=="Master Card"){echo 'selected="selected"'; } ?>><?php if($this->lang->line('user_master_card') != '') { echo stripslashes($this->lang->line('user_master_card')); } else echo 'Master Card'; ?></option>

                            <option value="Discover" <?php if($CardsDetails->card_type=="Discover"){echo 'selected="selected"'; } ?>><?php if($this->lang->line('user_discover') != '') { echo stripslashes($this->lang->line('user_discover')); } else echo 'Discover'; ?></option>

                        </select>

                        <span id="name_err" class="errors_msg"></span>

                    </div>

                    

                    <div class="line"></div>

                    

                    <p style="font-size:12px; font-weight:bold;  color:#666666; text-transform:uppercase"><?php if($this->lang->line('shop_billing') != '') { echo stripslashes($this->lang->line('shop_billing')); } else echo 'Billing Address'; ?></p>

                    <div class="cardinfo_div">

                    	<div><label><?php if($this->lang->line('user_country') != '') { echo stripslashes($this->lang->line('user_country')); } else echo 'Country'; ?></label><span >*</span></div>

                        <div><select style="width:303px; padding:6px;" name="country" id="country" onChange="checkUsername(this.id);">

                        	<option value=""><?php if($this->lang->line('shop_country') != '') { echo stripslashes($this->lang->line('shop_country')); } else echo 'Select Country'; ?></option>

                            <?php 

								foreach($countryList as $country) 

								{

							?>

								<option value="<?php echo $country->name; ?>" <?php if($userDetails->country==$country->name){ echo 'selected="selected"';} ?> ><?php echo $country->name; ?></option>

							<?php

								}	

							?>

                        </select><span id="country_err"  class="errors_msg"></span></div>

                    </div>

                    <div class="cardinfo_div">

                    	<div><label><?php if($this->lang->line('user_street') != '') { echo stripslashes($this->lang->line('user_street')); } else echo 'Street'; ?></label><span >*</span></div>

                        <input type="text" class="payment_txt" name="street" id="street"  onblur="checkUsername(this.id);" value="<?php echo $userDetails->address; ?>">

                        <span id="street_err" class="errors_msg"></span>

                    </div>

                    <div class="cardinfo_div">

                    	<div><label><?php if($this->lang->line('user_apt_suite_other') != '') { echo stripslashes($this->lang->line('user_apt_suite_other')); } else echo 'Apt/Suite/Other'; ?></label></div>

                        <input type="text" class="payment_txt" value="<?php echo $userDetails->address2; ?>">

                    </div>

                    <div class="cardinfo_div">

                    	<div><label><?php if($this->lang->line('user_city') != '') { echo stripslashes($this->lang->line('user_city')); } else echo 'City'; ?></label><span >*</span></div>

                        <input type="text" class="payment_txt" name="city" id="city"  onblur="checkUsername(this.id);" value="<?php echo $userDetails->city; ?>">

                        <span id="city_err" class="errors_msg"></span>

                    </div>

                    <div class="cardinfo_div">

                    	<div><label><?php if($this->lang->line('user_state_region') != '') { echo stripslashes($this->lang->line('user_state_region')); } else echo 'State / Province / Region'; ?></label><span >*</span></div>

                        <input type="text" class="payment_txt" name="state" id="state"  onblur="checkUsername(this.id);" value="<?php echo $userDetails->state; ?>">

                        <span id="state_err" class="errors_msg"></span>

                    </div>

                    <div class="cardinfo_div">

                    	<div><label><?php if($this->lang->line('user_zip_pcode') != '') { echo stripslashes($this->lang->line('user_zip_pcode')); } else echo 'Zip / Postal Code'; ?></label><span >*</span></div>

                        <input type="text" class="payment_txt" name="postalcode" id="postalcode"  onblur="checkUsername(this.id);"  value="<?php echo $userDetails->postal_code; ?>">

                        <span id="postalcode_err" class="errors_msg"></span>

                    </div>

                    <div class="cardinfo_div">

                    	<div><label ><?php if($this->lang->line('user_phone_no') != '') { echo stripslashes($this->lang->line('user_phone_no')); } else echo 'Phone Number'; ?></label><span >*</span></div>

                        <input type="text" class="payment_txt" name="phone" id="phone"  onblur="checkUsername(this.id);" value="<?php echo $userDetails->phone_no; ?>">

                        <span id="phone_err" class="errors_msg"></span>

                    </div>

                    <div class="line"></div>

                </div>   

                       

                	<div class="payment_btn">

                	<p style="color:#666666; margin:0 0 10px"><?php if($this->lang->line('shop_validating') != '') { echo stripslashes($this->lang->line('shop_validating')); } else echo 'By validating your card, you confirm that you accept our'; ?> <a href="pages/terms-conditions"><?php if($this->lang->line('user_touse') != '') { echo stripslashes($this->lang->line('user_touse')); } else echo 'Terms of Use'; ?>.</a> </p>

                    	<input type="submit" class="btn_save" value="<?php if($this->lang->line('user_validcard') != '') { echo stripslashes($this->lang->line('user_validcard')); } else echo 'Validate Card'; ?>" style="width:150px; padding:8px 0;" id="validate_card" onclick="return billing_validation('credit')"/>

                    </div>

                    <input type="hidden" name="full_name" value="<?php echo $userDetails->full_name; ?>"  />

                    <input type="hidden" name="email" value="<?php echo $userDetails->email; ?>"  />

                    <input type="hidden" id="total_amt_credit" name="total_amt" value="<?php echo number_format($total_amt,2); ?>"  />

                    <input type="hidden" value="<?php echo $total_amt;?>" name="total_payment" id="total_payment" />

                     </form>
					<?php //} ?>
                     <?php //if($total_amt>0){ 
                     	$paypalProcess = unserialize($paypal_ipn_settings['settings']);  ?>    

                     <form name="PaymentPaypalForm" id="PaymentPaypalForm" method="post" enctype="multipart/form-data" action="site/checkout/ProductPaymentPaypal" autocomplete="off">

                    <p><?php if($this->lang->line('shop_paypal') != '') { echo stripslashes($this->lang->line('shop_paypal')); } else echo 'Or use PayPal for billing'; ?>.</p>

                    <div class="list_div">

                    	<p style="margin:0 0 10px"><?php if($this->lang->line('shop_authorize') != '') { echo stripslashes($this->lang->line('shop_authorize')); } else echo 'You authorize your PayPal account to pay your'; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('shop_confirm') != '') { echo stripslashes($this->lang->line('shop_confirm')); } else echo 'bill and confirm that you accept our'; ?> <a href="pages/terms-conditions"><?php if($this->lang->line('user_touse') != '') { echo stripslashes($this->lang->line('user_touse')); } else echo 'Terms of Use'; ?>.</a> </p>



                        <input type="submit" class="btn_save" value="<?php if($this->lang->line('shop_account') != '') { echo stripslashes($this->lang->line('shop_account')); } else echo 'Authorize PayPal Account'; ?>" style="padding:8px 0;" id="validate_card" />

					<input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $paypalProcess['mode']; ?>"  />

	              <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $paypalProcess['merchant_email']; ?>"  />

                        <input type="hidden" name="email" value="<?php echo $userDetails->email; ?>"  />

                     <input type="hidden" id="total_amt_paypal"  name="total_amt" value="<?php echo number_format($total_amt,2); ?>"  />

                     <input type="hidden" value="<?php echo $total_amt;?>" name="total_payment" id="total_payment1" />

                    </div>

                    </form>

                      <?php //} ?>



            </div>
            
            
            </div>
            
            

         <?php }else{ ?>   

	         <div class="shop_details">

            	<span class="shop_title"><?php if($this->lang->line('shop_activated') != '') { echo stripslashes($this->lang->line('shop_activated')); } else echo 'Your Shop is Not Activated by Admin'; ?>.</span>                

                <div class="list_div1">

                	<div class="list_inner_fields" style="border:none">

                    

                    	<div style="float:left; width:60%; color:#333; margin:0 0 5px; font-size:12px; line-height:normal"><strong><?php if($this->lang->line('shop_contact') != '') { echo stripslashes($this->lang->line('shop_contact')); } else echo 'Please contact admin'; ?> @ <a href="mailto:<?php echo $this->config->item('site_contact_mail'); ?>"><?php echo $this->config->item('site_contact_mail'); ?></a></strong></div>

                        

                    </div>            

                </div>

            </div>

         <?php } ?>

    	</div>
		
		</section>
	</div>
<script>
	$('#get_pay').click(function(){
			//alert("asdf");
			var card_number=$('#card_number').val();
			var creditCardIdentifier=$('#cvv_number').val();
			console.log(card_number);
			console.log(creditCardIdentifier);
			if(card_number == ""){
				('#card_number').removeClass('payment_txt');
				('#card_number').addClass('payment_txt error');
				//alert("sdfgsfd");
				return false;
			}else if(creditCardIdentifier = ""){
				('#cvv_number').removeClass('payment_txt');
				('#cvv_number').addClass('payment_txt error');
				return false;
			}
			else{
				return true;
			}
		});


	function Show_payment_options(evt){

// 		alert("asas");
		$('#wallet_div').hide();
		$('#wallet_payment').remove();
		$('#wallet_payment1').remove();

		amount = parseInt($("#total_amount").val());
		
		$("#total_payment").val(amount);
		$("#total_payment1").val(amount);

		var n = amount.toFixed(2)
		
// 		alert(amount);
// 		alert(n);
		
		$("#total_amt_credit").val(n);
		$("#total_amt_paypal").val(n);
		
		
		if($("#total_payment").val() > 0){
			$("#payment_options").show();
		}else{
			$("#pay_ur_err").html('Yor amount is'+ $("#total_payment").val() +'');
			$("#payment_options").hide();
		}

	}

	function Show_wallet_payment_options(evt){

		//$("#payment_options").hide();
		$("#pay_wa_err").html('');
		var wallet_amount = $("#wallet_amount").val();
		wallet = parseInt(wallet_amount);


		
		if( wallet <= 0 || wallet == '' ){
			$("#pay_wa_err").html(lg_pls_enter_valid_amt);
			return false;
		}else if(isNaN(wallet)){
			$("#pay_wa_err").html(lg_pls_enter_valid_amt);
			return false;
		}else{

			$("#total_payment").val(wallet);
			$("#total_payment").append('<input type="hidden" value="'+wallet+'" name="wallet_payment" id="wallet_payment" />');
			
			$("#total_payment1").val(wallet)
			$("#total_payment1").append('<input type="hidden" value="'+wallet+'" name="wallet_payment" id="wallet_payment1" />');
			
			var n = wallet.toFixed(2)
			$("#total_amt_credit").val(n);
			$("#total_amt_paypal").val(n);

			$("#payment_options").show();

		}
	}



	
</script>




      
<?php 

$this->load->view('site/templates/footer');

?>
<script type="text/ecmascript" src="js/site/custom_validation.js" ></script>
