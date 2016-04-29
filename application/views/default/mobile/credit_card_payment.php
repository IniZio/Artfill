<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $this->config->item('email_title'); ?> - Payment Credit Card</title>
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/default/mobile/app-style.css" type="text/css" media="all" />
		<script type="text/javascript" src="<?php echo base_url().'js/site/jquery-1.7.1.min.js'?>"></script> 
		<script src="<?php echo base_url().'js/front/jquery.raty.min.js';?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'js/site/jquery-1.9.0.js';?>"></script>

	</head>
	<body>
		<section>
			<div class="app-shipping">
				<div class="main">
					<ul class="app-shipping-level level-2">		
						<li>Shipping</li>
						<li class="active">Payment</li>
						<li>Review</li>
					</ul>
				</div>
			</div>
			<div class="shipping_contact">
					<div class="main">
						<div class="contact-icon">
							<a>
								<?php
								if($sellerInfo->row()->sellerImg!=""){
									$sellerImage='images/users/thumb/'.$sellerInfo->row()->sellerImg;
								}else{
									$sellerImage='images/users/thumb/profile_pic.png';
								}
								?>
								<img src="<?php echo base_url().$sellerImage; ?>" alt="<?php echo base_url().$sellerImage; ?>" title="<?php echo $sellerInfo->row()->shopName; ?>" />
							</a>
						</div>
						<div class="contact-text"> 
						<span>Order From</span> 
						<strong><?php echo $sellerInfo->row()->shopName; ?></strong> 
						</div>
					</div>	
			</div>
			<?php if($payment == 'Credit-Card') { ?>
			<div class="shipping_address">
				<div class="main">		
					<div class="app-content-box">
						<h1>Add a new credit card<a class="close_btn" href="<?php echo base_url(); ?>mobile/shipping-address?mobileId=<?php echo $mobileId; ?>"></a></h1>
						<?php 
						$url ="";
						if($payment == 'Credit-Card') { 
						$url =  base_url().'mobile/userPaymentCard?mobileId='.$mobileId;
						} else if($payment == 'Stripe'){
						$url = base_url().'mobile/UserPaymentCreditStripe?mobileId='.$mobileId;
						} 
						?>
						<form name="PaymentCard" id="PaymentCard" method="post" enctype="multipart/form-data" action="<?php echo $url;?>"
						>
						<ul>
							<li><input type="text" class="input-scroll-3" placeholder="Card number" id="cardNumber" name="cardNumber" maxlength="16" size="16"></input></li>
							<li><label>Expiration</label> 
								<?php $Sel ='selected="selected"';  ?>
								<select id="CCExpDay" name="CCExpDay" class="input-scroll-2">
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
								<select id="CCExpMnth" name="CCExpMnth" class="input-scroll-2"> 
									<?php for($i=date('Y');$i< (date('Y') + 30);$i++){ ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</li>
							<li><input type="password" class="input-scroll" placeholder="Security Code" id="creditCardIdentifier" name="creditCardIdentifier"></input></li>
							<li><input type="text" class="input-scroll" placeholder="Name on Card" name="full_name" id="full_name"></input></li>
							<input type="hidden" class="input-scroll" value="<?php echo $mobileId; ?>" name="mobileId" id="mobileId"></input>
							<li class="last"><input type="submit" class="input-submit-btn" value="Use This Card" onClick="return validatecard();"></input></li>
						</ul>
						</form>
					</div>
				</div>	
			</div>
			<?php } else if($payment == 'Stripe'){
			$StripeValDet = unserialize(StripeDetails); 
			$StripeVal = unserialize($StripeValDet['settings']);?>
			   <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

			<script type="text/javascript">
				// This identifies your website in the createToken call below
				Stripe.setPublishableKey('<?php echo $StripeVal['publishable_key']; ?>');
				// ...
			</script>
					<div class="shipping_address" id="StripePay">
				<div class="main">		
					<div class="app-content-box">
						<h1>Add a new credit card<a class="close_btn" href="<?php echo base_url(); ?>mobile/shipping-address?mobileId=<?php echo $mobileId; ?>"></a></h1>
						<?php 
						$url ="";
						if($payment == 'Credit-Card') { 
						$url =  base_url().'mobile/userPaymentCard?mobileId='.$mobileId;
						} else if($payment == 'Stripe'){
						$url = base_url().'mobile/UserPaymentCreditStripe?mobileId='.$mobileId; 
						} 
						?>
						<form  name="UserPaymentStripeForm" id="UserPaymentStripeForm" method="post" enctype="multipart/form-data" action="<?php echo $url;?>"
						>
						<input type="hidden" name="stripe_mode" id="stripe_mode" value="<?php echo $StripeVal['mode']; ?>"  />
						<input type="hidden" name="stripe_key" id="stripe_key" value="<?php echo $StripeVal['secret_key']; ?>"  />
						<input type="hidden" name="stripe_publish_key" id="stripe_publish_key" value="<?php echo $StripeVal['publishable_key']; ?>"  />
						<ul>
						
						<span class="payment-errors" style="color:#FF0000;"></span>
							<li><input type="text" class="input-scroll-3" placeholder="Card number" id="cardNumber" data-stripe="number" name="cardNumber" maxlength="16" size="16"></input></li>
							<li><label>Expiration</label> 
								<?php $Sel ='selected="selected"';  ?>
								<select data-stripe="exp-month" id="CCExpDay" name="CCExpDay" class="input-scroll-2">
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
								<select id="CCExpMnth" data-stripe="exp-year" name="CCExpMnth" class="input-scroll-2"> 
									<?php for($i=date('Y');$i< (date('Y') + 30);$i++){ ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</li>
							<li><input type="password" class="input-scroll" placeholder="Security Code" id="creditCardIdentifier" name="creditCardIdentifier" data-stripe="cvc" ></input></li>
							<li><input type="text" class="input-scroll" placeholder="Name on Card" name="full_name" id="full_name"></input></li>
							<input type="hidden" class="input-scroll" value="<?php echo $mobileId; ?>" name="mobileId" id="mobileId"></input>
							<li class="last"><input type="submit" class="input-submit-btn" value="Use This Card" onClick="return validatecard();"></input></li>
						</ul>
						</form>
<script>
						jQuery(function($) {
	//$("#UserPaymentStripeForm").validate();
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
				</div>	
			</div>
			
			
			<?php } if($payment == 'twocheckout'){ ?>
			
			  <script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
            <script>$(document).ready(function(){ //alert("validate");
				//$("#twocheckout").validate();
				//$.validator.addMethod("ValidZipCode", function( value, element ) {  var result = this.optional(element) || value.length >= 3;
				//if (!result) { return false; }else{ return true; }}, "Please Enter the Correct ZipCode");
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
							if (data.errorCode === 200) {tokenRequest();} else {alert(data.errorMsg);}
						};
						var tokenRequest = function() {
							
							// Setup token request arguments
							var args = {
									sellerId: $("#SellerId").val(),
									publishableKey: $("#PublishableKey").val(),
									ccNo: $("#cardNumber").val(),
									cvv: $("#creditCardIdentifier").val(),
									expMonth: $("#CCExpDay").val(),
									expYear: $("#CCExpMnth").val()
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
				<div class="shipping_address">
				<div class="main">		
					<div class="app-content-box">
						<h1>Add a new credit card<a class="close_btn" href="<?php echo base_url(); ?>mobile/shipping-address?mobileId=<?php echo $mobileId; ?>"></a></h1>
						<?php 
						$url ="";
						if($payment == 'Credit-Card') { 
						$url =  base_url().'mobile/userPaymentCard?mobileId='.$mobileId;
						} else if($payment == 'twocheckout'){
						$url = base_url().'mobile/Paymenttwocheckout?mobileId='.$mobileId; 
						} 
						?>
						<form  name="twocheckout" id="twocheckout" class="twocheckout" method="post" enctype="multipart/form-data" action="<?php echo $url;?>"
						>
						<input id="token" name="token" type="hidden" value="">
						<input id="Mode" name="Mode" type="hidden" value="<?php echo $twocheckoutvalue['mode'];?>">
						<input id="PublishableKey" name="PublishableKey" type="hidden" value="<?php echo $twocheckoutvalue['publishableKey'];?>">
						<input id="SellerId" name="SellerId" type="hidden" value="<?php echo $twocheckoutvalue['sellerId'];?>">
						<input id="PrivateKey" name="PrivateKey" type="hidden" value="<?php echo $twocheckoutvalue['privateKey'];?>">
						<ul>
						
						<span class="payment-errors" style="color:#FF0000;"></span>
							<li><input type="text" class="input-scroll-3" placeholder="Card number" id="cardNumber" name="cardNumber" maxlength="16" size="16"></input></li>
							<li><label>Expiration</label> 
								<?php $Sel ='selected="selected"';  ?>
								<select id="CCExpDay" name="CCExpDay" class="input-scroll-2">
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
								<select id="CCExpMnth" name="CCExpMnth" class="input-scroll-2"> 
									<?php for($i=date('Y');$i< (date('Y') + 30);$i++){ ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</li>
							<li><input type="password" class="input-scroll" placeholder="Security Code" id="creditCardIdentifier" name="creditCardIdentifier"></input></li>
							<li><input type="text" class="input-scroll" placeholder="Name on Card" name="full_name" id="full_name"></input></li>
							<input type="hidden" class="input-scroll" value="<?php echo $mobileId; ?>" name="mobileId" id="mobileId"></input>
							<li class="last"><input type="submit" class="input-submit-btn" value="Use This Card" onClick="return validatecard();"></input></li>
						</ul>
						</form>

					</div>
				</div>	
			</div>
		<?php } if($payment == 'BrainTree'){ ?>
		 <?php 
				$Auth_Details=unserialize($this->config->item('payment_5'));
				$Setting_Details = unserialize($Auth_Details['settings']);
			?>
			<div class="shipping_address" id="Brain_Tree" >
				<div class="main">		
					<div class="app-content-box">
						<h1>Add a new credit card<a class="close_btn" href="<?php echo base_url(); ?>mobile/shipping-address?mobileId=<?php echo $mobileId; ?>"></a></h1>
						<?php 
						//print_r($SellerDetails->row()->authorize_mode);die;
						$url ="";
						if($payment == 'Credit-Card') { 
						$url =  base_url().'mobile/userPaymentCard?mobileId='.$mobileId;
						} else if($payment == 'BrainTree'){
						$url = base_url().'mobile/PaymentCreditAjax?mobileId='.$mobileId; 
						} 
						?>
						<form  name="BrainTreeForm" id="BrainTreeForm" class="twocheckout" method="post" enctype="multipart/form-data" action="<?php echo $url;?>"
						>
						<input type="hidden" name="authorize_mode" id="authorize_mode" value="<?php echo $SellerDetails->row()->authorize_mode; ?>"  />
						<input type="hidden" name="authorize_id" id="authorize_id" value="<?php echo $SellerDetails->row()->authorize_id; ?>"  />
						<input type="hidden" name="authorize_key" id="authorize_key" value="<?php echo $SellerDetails->row()->authorize_key; ?>"  />
						<ul>
						
						<span class="payment-errors" style="color:#FF0000;"></span>
							<li><input type="text" class="input-scroll-3" placeholder="Card number" id="cardNumber" name="cardNumber" maxlength="16" size="16"></input></li>
							<li><label>Expiration</label> 
								<?php $Sel ='selected="selected"';  ?>
								<select id="CCExpDay" name="CCExpDay" class="input-scroll-2">
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
								<select id="CCExpMnth" name="CCExpMnth" class="input-scroll-2"> 
									<?php for($i=date('Y');$i< (date('Y') + 30);$i++){ ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</li>
							<li><input type="password" class="input-scroll" placeholder="Security Code" id="creditCardIdentifier" name="creditCardIdentifier"></input></li>
							<li><input type="text" class="input-scroll" placeholder="Name on Card" name="full_name" id="full_name"></input></li>
							<input type="hidden" class="input-scroll" value="<?php echo $mobileId; ?>" name="mobileId" id="mobileId"></input>
							<li class="last"><input type="submit" class="input-submit-btn" value="Use This Card" onClick="return validatecard();"></input></li>
						</ul>
						</form>

					</div>
				</div>	
			</div>
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

<?PHP }?>
		</section>
		<script type="text/javascript">
		function validatecard(){
			var cardNumber=document.getElementById("cardNumber").value.trim();
			var CCExpDay=document.getElementById("CCExpDay").value.trim();
			var CCExpMnth=document.getElementById("CCExpMnth").value.trim();
			var creditCardIdentifier=document.getElementById("creditCardIdentifier").value.trim();
			var full_name=document.getElementById("full_name").value.trim();
			
			document.getElementById("cardNumber").classList.remove("txt-error");
			document.getElementById("CCExpDay").classList.remove("txt-error");
			document.getElementById("CCExpMnth").classList.remove("txt-error");
			document.getElementById("creditCardIdentifier").classList.remove("txt-error");
			document.getElementById("full_name").classList.remove("txt-error");
			
			var status=0;
			if(cardNumber=="" || isNaN(cardNumber)){
				document.getElementById("cardNumber").classList.add("txt-error");
				status++;
			}
			if(CCExpDay==""){
				document.getElementById("CCExpDay").classList.add("txt-error");
				status++;
			}
			if(CCExpMnth==""){
				document.getElementById("CCExpMnth").classList.add("txt-error");
				status++;
			}
			if(creditCardIdentifier==""){
				document.getElementById("creditCardIdentifier").classList.add("txt-error");
				status++;
			}
			if(full_name==""){
				document.getElementById("full_name").classList.add("txt-error");
				status++;
			}
			if(status!=0){
				return false;
			}
		}
		</script>
	</body>
</html>
