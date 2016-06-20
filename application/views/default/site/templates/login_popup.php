<?php

if (is_file('google-login-mats/index.php')){
	require_once 'google-login-mats/index.php';
}

//echo $authUrl;die;
//echo $this->session->userdata('rUrl');

if($this->session->userdata('rUrl') != ''){
	$reUrl = $this->session->userdata('rUrl');
	$this->session->unset_userdata('rUrl');
	redirect ($reUrl);
}
?>
<style>
.popup_google  {
    background: url("images/fb1.png") no-repeat scroll 25px 6px #ff6a6f;
    border: 1px solid #c4c4c4;
    color: #fff;
    cursor: pointer;
    float: left;
    font-family: opensansbold;
    padding: 12px 0;
    font-size: 14px;
    width: 229px;
}
</style>
<style>
.popup_login{
	margin-left:0px;
}
</style>
<?php if($this->uri->segment(1) != 'login' && $this->session->userdata('shopsy_session_user_id') == ''){?> 

<div id="signin" class="modal sign-popup in" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="tabbable-panel">
			<div style="margin:5px;border: 2px dashed #8adbd4; border-radius:5px;">
				<span style="float:right;">
					<a class="btn btn-default " href="javascript:void(0);" data-dismiss="modal">
					<?php if($this->lang->line('X') != '') { echo stripslashes($this->lang->line('X')); } else echo 'X'; ?>
					</a>
				</span>
				<img src="./images/popup_logo.png" style="text-align:center;" />
				<div style="clear:both;"></div>
				<div style="margin-left:10px;;margin-right:auto;">
				<span><h4>以Artfill 帳號登入</h4></span>
				<div style="clear:both;"></div>
				<form method="post" action="site/user/login_user" class="frm clearfix" onSubmit="return loginVal();">
					
					
					<div class="popup_login">
					<!--<label><?php if($this->lang->line('user_email_or_uname') != '') { echo stripslashes($this->lang->line('user_email_or_uname')); } else echo "Email or Username"; ?></label><span style="color:#F00;" class="redFont" id="emailAddr_Warn"></span> -->
					<input type="text" class="search" name="emailAddr" id="emailAddr" placeholder="帳號" />
					</div> 
					<div class="popup_login">
					<!--<label><?php if($this->lang->line('user_password') != '') { echo stripslashes($this->lang->line('user_password')); } else echo "Password"; ?></label><span style="color:#F00;" class="redFont" id="password_Warn"></span>  -->
					<input type="password" class="search" name="password" id="password" placeholder="密碼" />
					</div>
					<div class="popup_login">
					<input  style="margin: 0px 5px 0px 0px;" type="checkbox" name="stay_signed_in" value="yes" checked/><?php if($this->lang->line('stay_sign') != '') { echo stripslashes($this->lang->line('stay_sign')); } else echo "Stay Signed in"; ?>
					</div>
					<div class="popup_login" style="margin-bottom:15px">
					<input type="submit" class="submit_btn" value="<?php if($this->lang->line('user_signin') != '') { echo stripslashes($this->lang->line('user_signin')); } else echo "Sign In"; ?>" />
					<span id="loginloadErr" style="display:none;padding: 12px;"><img src="images/indicator.gif" alt="Loading..."></span>									 									 
					</div>
				</form>
									
					<a href="forgot-password" style="font-size: 12px; width:100%;">忘記密碼?<?php //if($this->lang->line('user_fgt_pwd') != '') { echo stripslashes($this->lang->line('user_fgt_pwd')); } else echo "Forgot your password?"; ?></a>
					<a href="register" style="font-size: 12px; width:100%;">新會員註冊<?php //if($this->lang->line('land_reopenacc') != '') { echo stripslashes($this->lang->line('land_reopenacc')); } else echo "Reopen your account?"; ?></a>
					
				</div>
				</div>
			</div>
		</div>
	</div>				
</div>



<div id="signup" class="modal sign-popup in" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="tabbable-panel">
			<div style="margin:5px;border: 2px dashed #8adbd4; border-radius:5px;">
				<span style="float:right;">
					<a class="btn btn-default " href="javascript:void(0);" data-dismiss="modal">
					<?php if($this->lang->line('X') != '') { echo stripslashes($this->lang->line('X')); } else echo 'X'; ?>
					</a>
				</span>
				<img src="./images/popup_logo.png" style="text-align:center;" />
				<div style="clear:both;"></div>
				
				<div style="margin-left:10px;;margin-right:auto;">
				<span><h4>註冊個人帳號</h4></span>
				<div style="clear:both;"></div>
				
				
									<form  method="post" action="" class="frm clearfix" onSubmit="return register_user(this);">
										<div class="popup_login">
											<input type="text" class="search" name="fullname" id="fullname" placeholder="名字(不多於25字元)" />
										</div>
										<div class="popup_login">
											<input type="text" class="search" name="lastname" id="lastname" placeholder="姓氏(不多於25字元)"/>
										</div>
										<div class="popup_login">
											<input type="radio" style="float:left;margin: 6px 6px 0 2px;" name="gender" value="Male" checked/><span class="gen_check"><?php if($this->lang->line('user_male') != '') { echo stripslashes($this->lang->line('user_male')); } else echo "Male"; ?></span>
											<input type="radio" style="float:left;margin: 6px 6px 0 12px;" name="gender" value="Female"/><span class="gen_check"><?php if($this->lang->line('user_female') != '') { echo stripslashes($this->lang->line('user_female')); } else echo "Female"; ?></span>
											<input type="radio" style="float:left;margin: 6px 6px 0 12px;" name="gender" value="Unspecified"/><span class="gen_check"><?php if($this->lang->line('user_rather_not_say') != '') { echo stripslashes($this->lang->line('user_rather_not_say')); } else echo "Rather not say"; ?></span>
										</div>
										<div class="popup_login">
											<input type="text" class="search" style="margin:0" name="email" id="email" placeholder="使用者電郵"/>
										</div>
										<div class="popup_login">
											<input type="password" class="search" style="margin:0" name="pwd" id="pwd" placeholder="密碼(6-12字元)"/>
										</div>
										<div class="popup_login">
											<input type="password" class="search" style="margin:0" name="Confirmpwd" id="Confirmpwd" placeholder="確認密碼"/>
										</div>
										
										<div class="popup_login">
												<span style="color:#F00;" class="redFont" id="usernameErr"></span> 
												 <input type="text" class="search" style="margin:0" name="username" id="username" placeholder="用戶名稱(不多於25字元)*"/>
										</div>
										<p style="font-size:12px;  margin: 5px 0 4px 42px; color:#666; width:auto; float:left">								
										  <span style=" color: #999999;font-size: 11px;margin: 12px 0 5px;"> 
										  <input type="checkbox" name="privacychecking" id="privacychecking"  checked/> 
										  <?php if($this->lang->line('user_by_clk_rster') != '') { echo stripslashes($this->lang->line('user_by_clk_rster')); } else echo "By clicking Register, you confirm that you accept our"; ?> 
											<a href="terms" target="_blank"><?php if($this->lang->line('user_touse') != '') { echo stripslashes($this->lang->line('user_touse')); } else echo "Terms of Use"; ?></a> <?php if($this->lang->line('user_and') != '') { echo stripslashes($this->lang->line('user_and')); } else echo "and"; ?><a href="privacy" target="_blank"> <?php if($this->lang->line('user_privacy_policy') != '') { echo stripslashes($this->lang->line('user_privacy_policy')); } else echo "Privacy Policy"; ?></a></span>
											<br />
											
											 <input type="checkbox" name="subscription" id="subscription" style="display:none;" />
											  <?php /*if($this->lang->line('land_toreceive') != '') { echo stripslashes($this->lang->line('land_toreceive')); } else echo "I want to receive"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('land_anemailnews') != '') { echo stripslashes($this->lang->line('land_anemailnews')); } else echo "Finds, an email newsletter of fresh trends and editors' picks";*/ ?>
											<span class="error" id="PrivacyErr"></span>
										</p>
										
										<div class="popup_login" style="margin-bottom:15px">
										<span id="loadErr" style="color:red"></span><br/>
											<input type="submit" class="submit_btn" value="<?php if($this->lang->line('user_register') != '') { echo stripslashes($this->lang->line('user_register')); } else echo "Register"; ?>"/>
											
										</div>
									</form>
				
				
				</div>
				</div>
			</div>
		</div>
	</div>				
</div>



<script type="text/javascript">
function loginVal(){ 
	// $('#loginloadErr').show();
	$("#emailAddr_Warn").html('');
	$("#password_Warn").html('');
	
	var emailAddr = $("#emailAddr").val();
	var password = $("#password").val();
	
	if(emailAddr.length==0){
	$("#emailAddr_Warn").html(lg_required_field);
	// $('#loginloadErr').hide();
	$('#loginloadErr').html(lg_required_field);
	$('#loginloadErr').show();
	return false;
	}else if(password==''){
	$("#password_Warn").html(lg_required_field);
	$("#loginloadErr").html(lg_required_field);
	$('#loginloadErr').show();
	return false;
	}
	//return false;
}
</script>


<?php }?>