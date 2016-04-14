<!---

========================================================================================================================

-  SMS OTP verification   popup   starts  
- This includes popup html , css , jquery 
- Just copy and paste this code in your shop preview file ( paste anywhere in this file )  : View/site/shop/shop_preview.php 
- Developer Suresh Kumar R

========================================================================================================================
---->	

		
<!-------------        SMS OTP verification   popup   starts  ----------->	
<?php  if($selectUser_details[0]['mobile_verification'] == 'No' && $this->config->item('twilio_status') == 'Active'){  ?>
   
   <script>
		
		$(document).ready(function () {    
			$('#otpLink').trigger('click');
		});

		function sendOtp(otp_number){
			var phone_code=$('#phone_code').val();
			var otp_phone=$('#phone_number').val();
			if(phone_code == ''){
				$('#otpNumErr').html('<p  class="error" style="background: none repeat scroll 0 0 #fff; margin: 10px 0 0;">Please enter mobile code number</p>');
			} else if(otp_phone == ''){
				$('#otpNumErr').html('<p  class="error" style="background: none repeat scroll 0 0 #fff; margin: 10px 0 0;">Please enter phone number</p>');
			} else {
				$('#otpNumErr').html('');
				$('#sms_loader').css('display','inline-block');
				$.ajax({
								type: 'POST',   
								url: baseURL+'site/sms_twilio/send_otp',
								dataType: "json",
								data:{"otp_phone":otp_phone,"phone_code":phone_code},
									success:function(response){ 
										if(response != 'error'){ 
											$('#otp_send_btn').val('Resend OTP');							
											$('#otpNumErr').html('<p  style="background: none repeat scroll 0 0 #fff; margin: 10px 0 0; color:green;">OTP has been sent to your phone number</p>').fadeOut(5000);
											if($('#otp_mode').val() == 'sandbox'){
												$("#temp_otp").html('<p  style=" margin: 10px 0 0;">OTP is in demo mode, only the registed mobile number will receive OTP code, For other number use this '+response+'</p>'); 
											}
										} else{	
											$('#otpNumErr').html('<p  class="error" style="background: none repeat scroll 0 0 #fff; margin: 10px 0 0;">OTP failed to send, please try again.</p>').fadeOut(5000);
										}
										$('#sms_loader').css('display','none');
									}
				});
			}	

		}
		
		function verifyOtp(){ 
			var phone_code=$('#phone_code').val();
			var otp_phone=$('#phone_number').val();
			if(phone_code == ''){
				$('#otpNumErr').html('<p  class="error" style="background: none repeat scroll 0 0 #fff; margin: 10px 0 0;">Please enter mobile code number</p>');
				return false;
			} else if(otp_phone == ''){
				$('#otpNumErr').html('<p  class="error" style="background: none repeat scroll 0 0 #fff; margin: 10px 0 0;">Please enter phone number</p>');
				return false;
			} else if($("#otp_code").val() == ''){ 
				$("#otp_code").css('border-color','red');
				return false;
			}
		}
   </script>
   <style>
		.otpcontainer {
			background-color: #6CB3E6;
			color:#darkslategray;
			height: 350px;
			border: medium solid;
		}
		.otpcontainer h4{
			background-color: #f2853d;
			border: 1px solid #ccc;
			padding: 12px;
			text-align: center;
			margin-top: 0;
		}
		
		.mobileverify {
			text-align:center;
			padding: 12px;
			/* margin-top: 2%; */
			border-top: medium solid;
		}
		
		.otpcontainer input{
			color:#000;
			margin: 1%;
		}
		
		.mobilenumber{
			text-align:center;
			margin-top: 8%;
		}
		.otpcontainer label {
			font-weight: bold;
			padding: 5px;
			font-size: 15px;
		}
		.otpbtn{
			background: none repeat scroll 0 0 orange;
			color: #fff !important;
			font-weight: bold;
		}
		
		.close_otp {
			background: none repeat scroll 0 0 #000;
			border: 2px solid #fff;
			border-radius: 41px;
			color: #fff;
			float: right;
			font-size: 18px;
			line-height: 1;
			margin-right: -15px;
			margin-top: -15px;
			padding: 7px;
			text-align: center;
			text-shadow: 0 1px 0 #fff;
		}
   </style>
   <a href="#optpoup" data-toggle="modal" id="otpLink"></a>
   
    <div id='optpoup' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<a  href="#javascript:void(0);" class="close_otp" data-dismiss="modal" >X</a>
				 <form name="mobile_verifcation" action="site/sms_twilio/confirm_mobile_verification" onsubmit="return verifyOtp();" method="post">
					 <div class="otpcontainer">
						<h4><b><?php echo shopsy_lg('lg_verify_mob_no','Please Verify Your Mobile Number');?></b></h4>
						<div class="mobilenumber">
							<label><?php echo shopsy_lg('lg_mob_no','Mobile Number:');?></label>
							<input type="text" name="phone_code" id="phone_code" style="width:12%;" value="" placeholder="<?php echo shopsy_lg('lg_code','Code...');?>"/>   
							<input type="text" name="phone_number" id="phone_number" placeholder="<?php echo shopsy_lg('lg_mob_no','Mobile Number:');?>" value="<?php echo $selectUser_details[0]['phone_no']; ?>" />  
							<input type="button" value="<?php echo shopsy_lg('lg_send_OTP','Send OTP');?>" class="otpbtn" id="otp_send_btn" onclick="return sendOtp();" />
							<span style="display:none;" id="sms_loader"><img src="images/indicator.gif"  /></span>
							<span id="otpNumErr"><p></p></span>
							<span id="temp_otp" style="color: blue;"><p></p></span>
							<input type="hidden" id="otp_mode" value="<?php echo $this->config->item('twilio_account_type');?>"/>
						</div>
						<div class="mobileverify">
							<label><?php echo shopsy_lg('lg_enter_OTP','Enter OTP :');?></label>
							<input type="text" name="otp_code" id="otp_code" style="width:25%;" placeholder="<?php echo shopsy_lg('lg_enter_OTP','Enter OTP :');?>" />   
							<input type="Submit" value="<?php echo shopsy_lg('lg_submit','Submit');?>" class="otpbtn" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>      
   
  
   
 <?php  }  ?>
 <!-------------        SMS OTP verification   popup   ends  ----------->	
