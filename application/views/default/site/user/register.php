<?php if (is_file('google-login-mats/index.php'))
{
	require_once 'google-login-mats/index.php';
}
#echo $authUrl;die;
//echo $this->session->userdata('rUrl');

if($this->session->userdata('rUrl') != ''){
	$reUrl = $this->session->userdata('rUrl');
	$this->session->unset_userdata('rUrl');
	redirect ($reUrl);
}

if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
	echo $oauth_provider; exit;
    if ($oauth_provider == 'twitter') {
        header("Location: login-twitter.php");
    } 
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
    width: 98%;
}
</style>

<?php $this->load->view('site/templates/header'); ?>

<section class="container">

    <div class="main">
	
	<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>           
		   <span>&rsaquo;</span>
		   <li>Register user</li>
        </ul>
	

        <div class="sign_in_container">

            <div class="sign_in_form">

                <div class="sign_in_form-inner">

                    <div class="sign_head">

                        <div class="sign_text">

                         <?php 	$user_sign_into = str_replace("{SITENAME}",$siteTitle,$this->lang->line('user_sign_into')); ?>  

            

                        	<h2><?php if($this->lang->line('user_sign_into') != '') { echo stripslashes($user_sign_into); } else echo 'Create an '.stripslashes($siteTitle).' account and start shopping'; ?></h2>

                        </div>

                        <div class="sign_div"><a id="fbsignin"  href="login"> <?php if($this->lang->line('user_signin') != '') { echo stripslashes($this->lang->line('user_signin')); } else echo 'Sign In'; ?></a></div>

                    </div>

                    <div class="register_container">
                        <div class="popup_tab_content">
                        	<?php if($this->config->item('facebook_app_id') != '' && $this->config->item('facebook_app_secret') != '') { ?> 
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
							<?php } ?>	
							<?php /* if ($this->config->item('consumer_key') != '' && $this->config->item('consumer_secret') != '') { ?>      	 
								<div class="fb_div">
									<a href="<?php echo base_url(); ?>site/invitefriend/twitter_login"><img src="images/twitter_login.png" alt="twitter"></a>
								</div>
							<?php } */ ?>
										
                        	<p class="sign-register-text">                            
                            <?php $user_wo_ur_permis = str_replace("{SITENAME}",$siteTitle,$this->lang->line('user_wo_ur_permis')); ?> 
                            	<?php /* if($this->lang->line('user_wo_ur_permis') != '') { echo stripslashes($user_wo_ur_permis); } else echo 'Signing up will allow your friends to find you on '.stripslashes($siteTitle).". We'll never post without your permission"; */ ?>. 
                            </p>
                            <div class="or_div">
                            	<span><?php if($this->lang->line('user_or') != '') { echo stripslashes($this->lang->line('user_or')); } else echo 'OR'; ?></span>
                            </div>
							
							
							
							
                            <form  method="post" onSubmit="return register_user(this);">
								  <input type='hidden' value="<?php echo $this->input->get('action');  ?>" name="next_url" id="next_url"/>
                                <div class="popup_login">

                                    <label><?php if($this->lang->line('user_fname') != '') { echo stripslashes($this->lang->line('user_fname')); } else echo 'First Name'; ?></label>

                                    <input type="text" class="search" style="margin:0" name="fullname" id="fullname"/>

                                    <span class="error" id="fullnameErr"></span>

                                </div>

                                <div class="popup_login">

                                    <label><?php if($this->lang->line('user_lname') != '') { echo stripslashes($this->lang->line('user_lname')); } else echo 'Last Name'; ?></label>

                                    <input type="text" class="search" style="margin:0" name="lastname" id="lastname"/>

                                    <span class="error" id="lastnameErr"></span>

                                </div>

                                <div class="popup_login">

                                    <input type="radio" style="float:left" name="gender" value="Male" checked/><span class="gen_check"><?php if($this->lang->line('user_male') != '') { echo stripslashes($this->lang->line('user_male')); } else echo 'Male'; ?></span>

                                    <input type="radio" style="float:left" name="gender" value="Female"/><span class="gen_check"><?php if($this->lang->line('user_female') != '') { echo stripslashes($this->lang->line('user_female')); } else echo 'Female'; ?></span>

                                    <input type="radio" style="float:left" name="gender" value="Unspecified"/><span class="gen_check"><?php if($this->lang->line('user_rather_not_say') != '') { echo stripslashes($this->lang->line('user_rather_not_say')); } else echo 'Rather not say'; ?></span>

                                </div>

                                <div class="div_line mtop"></div>

                                <div class="popup_login">

                                    <label><?php if($this->lang->line('user_email') != '') { echo stripslashes($this->lang->line('user_email')); } else echo 'Email'; ?></label>

                                    <input type="text" class="search" style="margin:0" name ="email" id = "email"/>

                                    <span class="error" id="emailErr"></span> 

                                </div>

                                <div class="popup_login">

                                    <label><?php if($this->lang->line('user_password') != '') { echo stripslashes($this->lang->line('user_password')); } else echo 'Password'; ?></label>

                                    <input type="password" class="search" style="margin:0" name ="pwd" id = "pwd"/>

                                    <span class="error" id="user_passwordErr"></span>   

                                </div>

                                <div class="popup_login">

                                    <label><?php if($this->lang->line('user_confrm_pwd') != '') { echo stripslashes($this->lang->line('user_confrm_pwd')); } else echo 'Confirm Password'; ?></label>

                                    <input type="password" class="search" style="margin:0" name="Confirmpwd" id="Confirmpwd"/>

                                    <span class="error" id="user_ConfirmpasswordErr"></span>   

                                </div>

                                <div class="popup_login">

                                    <label><?php if($this->lang->line('user_uname') != '') { echo stripslashes($this->lang->line('user_uname')); } else echo 'Username'; ?></label>

                                    <input type="text" class="search" style="margin:0" name="username" id="username" />

                                    <span class="error" id="usernameErr"></span>

                                </div>

                                <div class="div_line mtop"></div>
<div class="clear"></div>
                                <p class="sign-check-text">								

								 <span style=" color: #999999;font-size: 11px;margin: 12px 45px 5px;">

                                 <input type="checkbox" name="privacychecking" id="privacychecking"  checked="checked"/>

								 <?php if($this->lang->line('user_by_clk_rster') != '') { echo stripslashes($this->lang->line('user_by_clk_rster')); } else echo 'By clicking Register, you confirm that you accept our '; ?>

                                    <a href="pages/terms-conditions"><?php if($this->lang->line('user_touse') != '') { echo stripslashes($this->lang->line('user_touse')); } else echo 'Terms of Use'; ?></a> <?php if($this->lang->line('user_and') != '') { echo stripslashes($this->lang->line('user_and')); } else echo 'and'; ?><a href="pages/privacy-policy"> <?php if($this->lang->line('user_privacy_policy') != '') { echo stripslashes($this->lang->line('user_privacy_policy')); } else echo 'Privacy Policy'; ?></a></span>

                                    <br />

                                    <span class="error" id="PrivacyErr"></span>

                                </p>
								
                                <div style="width:100%;margin: 0 0 0 45px; font-size:12px" class="popup_login">

                                 <input type="checkbox" name="subscription" id="subscription" style="display:none;" />

                                 <?php 	/*$user_i_want_rcive = str_replace("{SITENAME}",$siteTitle,$this->lang->line('user_i_want_rcive')); ?>  

                                    <?php if($this->lang->line('user_i_want_rcive') != '') { echo stripslashes($user_i_want_rcive); } else echo 'I want to receive '.stripslashes($siteTitle)." Finds, a daily email of fresh trends and editors' picks.";*/ ?>

                                </div>

                                <div class="popup_login" style="margin-bottom:15px">

                                    <input type="submit" class="submit_btn" value="<?php if($this->lang->line('user_register') != '') { echo stripslashes($this->lang->line('user_register')); } else echo 'Register'; ?>" />

                                    <span id="loadErr"></span>

                                </div>

                            </form>

                        </div>

                    </div>     

                </div>    

            </div>

        </div>

    </div>

</section>

<?php 

$this->load->view('site/templates/footer');

?>



 