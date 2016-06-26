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
<link rel="stylesheet" href="dist/ladda.min.css"><link rel="stylesheet" href="dist/ladda.min.css">
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
					<?php echo af_lg('X', 'X'); ?>
					</a>
				</span>
				<img src="./images/popup_logo.png" style="text-align:center;" />
				<div style="clear:both;"></div>
				<div style="margin-left:10px;;margin-right:auto;">
				<!-- demonstrate using af_lg function, might fail though -->
				<span><h4><?php echo af_lg('lg_login_with_local_ac','以Artfill 帳戶登入'); ?></h4></span>
				<div style="clear:both;"></div>
				<form method="post" action="" class="frm clearfix" onSubmit="return loginVal(this);">
					
					
					<div class="popup_login">
					<!--<label><?php echo af_lg('user_email_or_uname',"Email or Username"); ?></label><span style="color:#F00;" class="redFont" id="emailAddr_Warn"></span> -->
					<input type="text" class="search" maxlength="25" name="emailAddr" id="emailAddr" placeholder="帳號/電郵" />
					</div> 
					<div class="popup_login">
					<!--<label><?php echo af_lg('user_password', "Password"); ?></label><span style="color:#F00;" maxlength="12" class="redFont" id="password_Warn"></span>  -->
					<input type="password" class="search" name="password" id="password" placeholder="密碼" />
					</div>
					<div class="popup_login">
					<input  style="margin: 0px 5px 0px 0px;" type="checkbox" name="stay_signed_in" value="yes" checked/><?php echo af_lg('stay_sign',"Stay Signed in"); ?>
					</div>
					<div class="popup_login" style="margin-bottom:15px">
					<!-- <input type="submit" class="submit_btn"  value="<?php echo af_lg('user_signin', "Sign In"); ?>" /> -->
					<button id="some" type="submit" class="ladda-button" data-color="green" data-style="expand-right" data-size="s"><span class="ladda-label">Submit</span></button>
					<span id="loginloadErr" style="display:none;padding: 12px;color:red"></span>									 									 
					</div>
				</form>
									
					<a href="forgot-password" style="font-size: 12px; width:100%;"><?php echo af_lg('user_fgt_pwd',"忘記密碼"); ?></a> | 
					<a href="register" style="font-size: 12px; width:100%;"><?php echo af_lg('user_register',"新會員註冊"); ?></a>
					
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
					<a class="btn btn-default btn-circle" href="javascript:void(0);" data-dismiss="modal">
					<?php echo af_lg('X', 'X'); ?>
					</a>
				</span>
				<img src="./images/popup_logo.png" style="text-align:center;" />
				<div style="clear:both;"></div>
				
				<div style="margin-left:10px;;margin-right:auto;">
				<span><h4>註冊個人帳號</h4></span>
				<div style="clear:both;"></div>
				
				
									<form  method="post" action="" class="frm clearfix" onSubmit="return register_user(this);">
										<div class="popup_login">
											<input type="text" class="search" maxlength="25" name="fullname" id="fullname" placeholder="名字(不多於25字元)" />
										</div>
										<div class="popup_login">
											<input type="text" class="search" maxlength="25" name="lastname" id="lastname" placeholder="姓氏(不多於25字元)"/>
										</div>
										<div class="popup_login">
											<input type="radio" style="float:left;margin: 6px 6px 0 2px;" name="gender" value="Male" checked/><span class="gen_check"><?php echo af_lg('user_male', "Male"); ?></span>
											<input type="radio" style="float:left;margin: 6px 6px 0 12px;" name="gender" value="Female"/><span class="gen_check"><?php echo af_lg('user_female',"Female"); ?></span>
											<input type="radio" style="float:left;margin: 6px 6px 0 12px;" name="gender" value="Unspecified"/><span class="gen_check"><?php echo af_lg('user_rather_not_say', "Rather not say"); ?></span>
										</div>
										<div class="popup_login">
											<input type="text" class="search" style="margin:0" name="email" id="email" placeholder="使用者電郵"/>
										</div>
										<div class="popup_login">
											<input type="password" class="search" maxlength="12" style="margin:0" name="pwd" id="pwd" placeholder="密碼(6-12字元)"/>
										</div>
										<div class="popup_login">
											<input type="password" class="search" maxlength="12" style="margin:0" name="Confirmpwd" id="Confirmpwd" placeholder="確認密碼"/>
										</div>
										
										<div class="popup_login">
												<span style="color:#F00;" class="redFont" id="usernameErr"></span> 
												 <input type="text" class="search" style="margin:0" name="username" id="username" maxlength="25" placeholder="用戶名稱(不多於25字元)*"/>
										</div>
										<p style="font-size:12px;  margin: 5px 0 4px 42px; color:#666; width:auto; float:left">								
										  <span style=" color: #999999;font-size: 11px;margin: 12px 0 5px;"> 
										  <input type="checkbox" name="privacychecking" id="privacychecking"  checked/> 
										  <?php echo af_lg('user_by_clk_rster',"By clicking Register, you confirm that you accept our"); ?> 
											<a href="terms" target="_blank"><?php echo af_lg('user_touse', "Terms of Use"); ?></a> <?php echo af_lg('user_and', "and"); ?><a href="privacy" target="_blank"> <?php echo af_lg('user_privacy_policy', "Privacy Policy"); ?></a></span>
											<br />
											
											 <input type="checkbox" name="subscription" id="subscription" style="display:none;" />
											  <?php /*echo af_lg('land_toreceive') != '') { echo stripslashes($this->lang->line('land_toreceive')); } else echo "I want to receive"; ?> <?php echo $this->config->item('email_title'); ?> <?php echo af_lg('land_anemailnews') != '') { echo stripslashes($this->lang->line('land_anemailnews')); } else echo "Finds, an email newsletter of fresh trends and editors' picks";*/ ?>
											<span class="error" id="PrivacyErr"></span>
										</p>
										
										<div class="popup_login" style="margin-bottom:15px">
										<span id="loadErr" style="color:red"></span><br/>
											<input type="submit" class="submit_btn" value="<?php echo af_lg('user_register', "Register"); ?>"/>
											
										</div>
									</form>
				
				
				</div>
				</div>
			</div>
		</div>
	</div>				
</div>

<?php }?>
<script src="dist/spin.min.js"></script> 
<script src="dist/ladda.min.js"></script> 