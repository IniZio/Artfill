<?php $this->load->view('site/templates/header'); ?>
<?php 
if (is_file('google-login-mats/index.php')) {
	require_once 'google-login-mats/index.php';
}
//echo $authUrl;die;
//echo $this->session->userdata('rUrl');
if($this->session->userdata('rUrl') != '')
{
	$reUrl = $this->session->userdata('rUrl');
	$this->session->unset_userdata('rUrl');
	redirect ($reUrl);
}
?>
<section class="container">

    <div class="main">
	
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li>Login</li>		   
        </ul>

        <div class="sign_in_container">

        	<div class="sign_in_form">

                <div class="sign_in_form-inner">

                    <div class="sign_head">

                        <div class="sign_text">

                            <h2><?php if($this->lang->line('sign_into') != '') { echo stripslashes($this->lang->line('sign_into')); } else echo 'Sign into'; ?> <?php echo $this->config->item('email_title'); ?></h2>
							<?php if($this->input->get('action') != ''){?>
								<span style="margin-left: 17%;"> ( OR ) <br> </span>
								<span><a href="register?action=<?php echo $this->input->get('action');?>"><b>Create Account</b></a></span>
							<?php }?>

                        </div>
</div>
                        <?php /*if($this->config->item('facebook_app_id') != '' && $this->config->item('facebook_app_secret') != '') { ?> 
                           <div class="fb_div">
								<a style="margin:0" id="fbsignin" class="" href="<?php echo base_url().'facebooklogin'; ?>">
									<img src="images/facebook_login.png" alt="facebook">
								</a>
							</div>
							<?php } ?>
							
							<?php if($this->config->item('google_client_id') != '' && $this->config->item('google_redirect_url') != '' && $this->config->item('google_client_secret') != '') { ?>
								<div class="fb_div">
									<a class="" onclick="window.location.href='<?php echo $authUrl; ?>'"><img src="images/google_login.png" alt="google"></a>
								</div>	
							<?php }*/ ?>	
							<?php /* if ($this->config->item('consumer_key') != '' && $this->config->item('consumer_secret') != '') { ?>      	 
								<div class="fb_div">
									<a href="<?php echo base_url(); ?>site/invitefriend/twitter_login"><img src="images/twitter_login.png" alt="twitter"></a>
								</div>
							<?php } */ ?>
							<!--
							<div class="or_div">
                            	<span><?php if($this->lang->line('user_or') != '') { echo stripslashes($this->lang->line('user_or')); } else echo 'OR'; ?></span>
                            </div>
							-->
                	
					<div style="padding-left:10px;">
                    <form method="post" action="site/user/login_user" class="frm clearfix" onsubmit="return loginVal();">

                    <input type='hidden' value="<?php echo $this->input->get('action');  ?>" name="next_url"/>

                    <div class="popup_login">

                        <label><?php if($this->lang->line('user_email_or_uname') != '') { echo stripslashes($this->lang->line('user_email_or_uname')); } else echo 'Email or Username'; ?></label> 

                        <input type="text" class="search" style="margin:0" name="emailAddr" onkeyup="" id="emailAddr"/>

                        <span class="error" id="emailAddr_Warn"></span>

                    </div>

                    <div class="popup_login">

                        <label><?php if($this->lang->line('user_password') != '') { echo stripslashes($this->lang->line('user_password')); } else echo 'Password'; ?></label>

                        <input type="password" class="search" style="margin:0" name="password" id="password"/>

                        <span class="error" id="password_Warn"></span>

                    </div>

                    <div class="popup_login">

                        <input type="checkbox" name="stay_signed_in" value="yes" checked/><?php if($this->lang->line('stay_sign') != '') { echo stripslashes($this->lang->line('stay_sign')); } else echo 'Stay Signed in'; ?>

                    </div>

                    <div class="popup_login" style="margin-bottom:15px">

                        <input type="submit" class="submit_btn" value="Sign In" />

                        <span id="loginloadErr"></span>

                    </div>

                    </form>

                	<div class="div_line"></div>

                    <a href="forgot-password" class="forgot-link"><?php if($this->lang->line('user_fgt_pwd') != '') { echo stripslashes($this->lang->line('user_fgt_pwd')); } else echo 'Forgot your password?'; ?></a> 

                    <!--<a href="#" style="float:left;font-size: 12px; width:100%;    line-height: 13px; margin:0 0 0px 50px;">Forgot your username or email?</a>-->

                    <a href="reopen-account" class="forgot-link"><?php if($this->lang->line('user_reopen_ur_acc') != '') { echo stripslashes($this->lang->line('user_reopen_ur_acc')); } else echo 'Reopen your account'; ?>?</a>

					</div>
                </div>

        	</div>

        </div>

    </div>

</section>

<script type="text/javascript">
function loginVal(){
	$('#loginloadErr').html('<img src="images/indicator.gif" alt="Loading...">');
	var emailAddr = $("#emailAddr").val();
	var password = $("#password").val();
	$("#emailAddr_Warn").html('');
	$("#password_Warn").html('');
	$("#emailAddr_Warn").hide();
	$("#password_Warn").hide();	
	//if(!IsEmail(emailAddr)){
		if(emailAddr==''){
		$("#emailAddr_Warn").show();
		$("#emailAddr_Warn").html(lg_required_field);
		$('#loginloadErr').html('');
		return false;
	}else if(password==''){
		$("#password_Warn").show();
		$("#password_Warn").html(lg_required_field);
		$('#loginloadErr').html('');
		return false;
		
	}
}
function hideErrDiv(arg) {
	 $("#"+arg).hide("slow");
}

</script>


<?php 

$this->load->view('site/templates/footer');

?>



 