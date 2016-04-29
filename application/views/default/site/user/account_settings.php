<?php 
$this->load->view('site/templates/header');
$this->load->model('product_model');
$this->load->model('user_model');
//echo "<pre>";print_r($userProfileDetails);
?>
<!-- section_start -->
		<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
			<div class="add_steps shop-menu-list">

			<div class="main">
				 
				 <?php $this->load->view('site/user/sidebar');?>  
			
			</div>
			
			</div>

<div id="profile_div">
<section class="container">
    	<div class="main">
		
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="view-profile/<?php echo $this->uri->segment(3);?>" class="a_links"><?php echo $this->uri->segment(3);?></a></li>
		    <span>&rsaquo;</span>
           <li><?php if($this->lang->line('acc_settings') != '') { echo stripslashes($this->lang->line('acc_settings')); } else echo "Account settings"; ?></li>
        </ul>
		
            <div class="community_page">
                <div class="community_div">

                    <div class="community_right">
                   
                    <?php $this->load->view("site/user/settings_tab");?>
                    	   
                    <div class="acc_full">
                <div class="section">
                <div class="heading_account" ><?php if($this->lang->line('user_about_us') != '') { echo stripslashes($this->lang->line('user_about_us')); } else echo "About us"; ?></div>
                <div class="account_info">
                <h2 style="text-align:left !important;"><?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?></h2>
                <p><?php echo $userProfileDetails->row()->full_name." ".$userProfileDetails->row()->last_name;?> <a href="public-profile"> <?php if($this->lang->line('user_edit_profile') != '') { echo stripslashes($this->lang->line('user_edit_profile')); } else echo "edit profile"; ?> </a></p>
                </div>
                <div class="account_info">
                <h2 style="text-align:left !important;"><?php if($this->lang->line('user_user_name') != '') { echo stripslashes($this->lang->line('user_user_name')); } else echo "Username"; ?></h2>
                <p><?php echo $userProfileDetails->row()->user_name;?><span style="margin-left:5px; font-family:11px; color:#bcbcbc"><?php if($this->lang->line('user_cannot_changed') != '') { echo stripslashes($this->lang->line('user_cannot_changed')); } else echo "cannot be changed"; ?></span></p>
                </div>
                <div class="account_info">
                <h2 style="text-align:left !important;"> <?php if($this->lang->line('user_member_since') != '') { echo stripslashes($this->lang->line('user_member_since')); } else echo "Member since"; ?></h2>
                <p style=" margin-bottom:28px;"><?php echo date("F d Y",strtotime($userProfileDetails->row()->created));?></span></p>
                </div>
                
                </div>
                 <?php /*?><div class="section" style="margin-right:0px;height:205px">
                <div class="heading_account" ><?php if($this->lang->line('user_connected_accounts') != '') { echo stripslashes($this->lang->line('user_connected_accounts')); } else echo "Connected Accounts"; ?></div>
                <div class="account_info">
                <img src="images/fa.jpg" /><a style="margin:10px 0 0 10px; float:left;"><?php if($this->lang->line('user_connect_facebook') != '') { echo stripslashes($this->lang->line('user_connect_facebook')); } else echo "Connect with Facebook"; ?></a>
                </div>
                <div class="clear"></div>
                <div class=" bor_str"></div>
                <div class="account_info">
                 <img src="images/twit.jpg" /><a style="margin:10px 0 0 10px; float:left;"><?php if($this->lang->line('user_connect_twitter') != '') { echo stripslashes($this->lang->line('user_connect_twitter')); } else echo "Connect with Twitter"; ?></a>
                </div>
                <div class="clear"></div>
                <div class=" bor_str"></div>
                <div class="account_info">
               <?php 
					$user_allow_frnds_site = str_replace("{SITENAME}",$siteTitle,$this->lang->line('user_allow_frnds_site'));
				?>  
                <p style="font-size:11px; color:#999999; margin-bottom:35px;"><?php if($this->lang->line('user_allow_frnds_site') != '') { echo stripslashes($user_allow_frnds_site); } else echo "Connecting to Facebook will allow your friends to find you on ".$siteTitle."."; ?>  </p>
                </div>
                
                </div><?php */?>
               
                </div>	
                <?php if($loginCheck!=1){?>
                     <form method="post" action="site/user/change_password" onsubmit="return password_validation();">
                     	<div class="pass pass-1">
                  <div class="heading_account" ><?php if($this->lang->line('user_password') != '') { echo stripslashes($this->lang->line('user_password')); } else echo "Password"; ?></div>
                  <div class="field_account">
        	         <label ><?php if($this->lang->line('user_email_or_uname') != '') { echo stripslashes($this->lang->line('user_email_or_uname')); } else echo "Email or Username"; ?> </label><p style="color:#F00; float:left;">*</p><span style="color:#F00;"  id="err_pass_email"></span>
                     <input type="text" class="search" style="margin:0" id="pass_email" name="pass_email"/>
                  </div>
        
                 <div class="field_account">
        	       <label ><?php if($this->lang->line('user_password') != '') { echo stripslashes($this->lang->line('user_password')); } else echo "Password"; ?></label><p style="color:#F00; float:left;">*</p> <span style="color:#F00;"  id="err_pass_password"></span>
                   <div class="clear"></div>
                   <input type="Password" class="search" style="margin:0" id="pass_password" name="pass_password"/>
                </div>
        
         <div class="field_account">
        	<label ><?php if($this->lang->line('user_cnfrm_pwd') != '') { echo stripslashes($this->lang->line('user_cnfrm_pwd')); } else echo "Confirm New Password"; ?></label><p style="color:#F00; float:left;">*</p> <span style="color:#F00;"  id="err_pass_confirm_password"></span>
            <input type="Password" class="search" style="margin:0" id="pass_confirm_password" name="pass_confirm_password"/>
        </div>
           <div class="clear"></div>
         
          	<input type="submit" class="password_btn" value="<?php if($this->lang->line('user_changepwd') != '') { echo stripslashes($this->lang->line('user_changepwd')); } else echo "Change Password"; ?>" style=" margin-left:10px;" />
        
                 
                 </div>
         </form>        
         		<?php } ?>
                 
                 			<div class="pass pass-1">
                  <div class="heading_account" ><?php if($this->lang->line('user_email') != '') { echo stripslashes($this->lang->line('user_email')); } else echo "Email"; ?></div>
                  
                 <div class="account_info">
               		 <h2> <?php if($this->lang->line('user_current_email') != '') { echo stripslashes($this->lang->line('user_current_email')); } else echo "Current email"; ?></h2>
               		 <p><?php echo $userProfileDetails->row()->email;?> </p>
                </div>
                
                 <div class="account_info">
               		 <h2> <?php if($this->lang->line('user_status') != '') { echo stripslashes($this->lang->line('user_status')); } else echo "Status"; ?></h2>
               		 <p><?php if($userProfileDetails->row()->is_verified=="Yes")
					 			{ ?><?php if($this->lang->line('user_confirmed') != '') { echo stripslashes($this->lang->line('user_confirmed')); } else echo "Confirmed"; ?><?php }
					 			else
								{?> <?php if($this->lang->line('user_not_confirmed') != '') { echo stripslashes($this->lang->line('user_not_confirmed')); } else echo "Not yet confirmed"; ?><?php }
					 
					 ?></p>
                </div>
                
                <div class="clear">
                </div>
                 <?php if($loginCheck!=1){?>
            <form method="post" action="site/user/change_email_confirm" onsubmit="return email_validation();">    
                 <div class=" bor_str_2"></div>
                 <!--<h2 class="hed_title"><?php if($this->lang->line('user_new_email') != '') { echo stripslashes($this->lang->line('user_new_email')); } else echo "New Email"; ?></h2>-->
                 <div class="field_account">
        	         <label ><?php if($this->lang->line('user_new_email') != '') { echo stripslashes($this->lang->line('user_new_email')); } else echo "New Email"; ?> </label><p style="color:#F00; float:left;">*</p><span style="color:#F00;"  id="err_email_email"></span>
                     <input type="text" class="search" style="margin:0" name="email_email" id="email_email"/>
                  </div>
        
                 <div class="field_account">
        	       <label ><?php if($this->lang->line('user_cnfrm_new_email') != '') { echo stripslashes($this->lang->line('user_cnfrm_new_email')); } else echo "Confirm New Email"; ?></label><p style="color:#F00; float:left;">*</p><span style="color:#F00;"  id="err_email_confirm_email"></span>
                   <div class="clear"></div>
                   <input type="text" class="search" style="margin:0" name="email_confirm_email" id="email_confirm_email"/>
                </div>
        <?php 
					$user_site_pwd = str_replace("{SITENAME}",$siteTitle,$this->lang->line('user_site_pwd'));
				?> 
         <div class="field_account">
        	<label ><?php if($this->lang->line('user_site_pwd') != '') { echo stripslashes($user_site_pwd); } else echo "Your ".$siteTitle." Password"; ?></label><p style="color:#F00; float:left;">*</p><span style="color:#F00;"  id="err_email_password"></span>
            <input type="Password" class="search" style="margin:0" id="email_password" name="email_password"/>
        </div>
         <div class="clear"></div>
         
          	<input type="submit" class="password_btn" value="<?php if($this->lang->line('user_changemail') != '') { echo stripslashes($this->lang->line('user_changemail')); } else echo "Change email"; ?>" style=" margin-left:10px;" /><p  class="side_tex"><label ><?php if($this->lang->line('user_email_wont_chng') != '') { echo stripslashes($this->lang->line('user_email_wont_chng')); } else echo "Your email address will not change until you confirm it via email."; ?></label></p>
        
           </div>
           
           </form>
           
           						<div class="pass pass-1">
                  <div class="heading_account" ><?php if($this->lang->line('user_close_accnt') != '') { echo stripslashes($this->lang->line('user_close_accnt')); } else echo "Close Your Account"; ?> </div>
                   <h2 class="hed_title_2"><?php if($this->lang->line('user_what_happen') != '') { echo stripslashes($this->lang->line('user_what_happen')); } else echo "What happens when you close your Account?"; ?> </h2>
                    <div class="account_info">
                     <?php 
					$user_wont_appear_pfile = str_replace("{SITENAME}",$siteTitle,$this->lang->line('user_wont_appear_pfile'));
				?>
                    
               		 <h2 style="font-size:12px; color:##333333; font-weight:bold;"> <?php if($this->lang->line('user_wont_appear_pfile') != '') { echo stripslashes($user_wont_appear_pfile); } else echo "Your profile, shop and listings won't appear anywhere on ".$siteTitle."."; ?></h2>
               		 <p><?php if($this->lang->line('user_not_avail_pfile') != '') { echo stripslashes($this->lang->line('user_not_avail_pfile')); } else echo "People who try to view your profile, shop or one of your shop's listings will see a message that the page is not available."; ?> </p>
                </div>
                
                <div class="account_info">
               		 <h2 style="font-size:12px;color:##333333; font-weight:bold;"><?php if($this->lang->line('user_non_dlvry_closed') != '') { echo stripslashes($this->lang->line('user_non_dlvry_closed')); } else echo "Non-delivery cases you have opened will be closed."; ?></h2>
               		 <p><?php if($this->lang->line('user_report_nd_cases') != '') { echo stripslashes($this->lang->line('user_report_nd_cases')); } else echo "Reported non-delivery cases for an items you never received from a shop will no longer be active."; ?>  </p>
                </div>
                 <div class="account_info">
               		 <h2 style="font-size:12px;color:##333333; font-weight:bold;"><?php if($this->lang->line('user_reopen_accnt_any') != '') { echo stripslashes($this->lang->line('user_reopen_accnt_any')); } else echo "You can reopen your account any time."; ?></h2>
               		
                     <?php 
					$user_reopen_acc_url = str_replace("{WEBSITEURL}",base_url(),$this->lang->line('user_reopen_acc_url'));
				?>
                    
                     <p><?php if($this->lang->line('user_reopen_acc_url') != '') { echo stripslashes($user_reopen_acc_url); } else echo "If you want to reopen your account, simply sign in to ".base_url()." when you want to return. You can also"; ?> 
                       <?php 
					$user_cont_site_support = str_replace("{SITENAME}",$siteTitle,$this->lang->line('user_cont_site_support'));
				?>
                     <a href="pages/contact-us"><?php if($this->lang->line('user_cont_site_support') != '') { echo stripslashes($user_cont_site_support); } else echo "contact ".stripslashes($siteTitle)." support"; ?></a> 
					 
					 <?php if($this->lang->line('user_reopen_remain_inact') != '') { echo stripslashes($this->lang->line('user_reopen_remain_inact')); } else echo "to help you reopen your account. No one will be able to use your username, and your account settings will remain intact."; ?> </p>
                </div>
                
                  <div class="clear"></div>
         
          	<input type="button" class="password_btn" value="<?php if($this->lang->line('user_closeacct') != '') { echo stripslashes($this->lang->line('user_closeacct')); } else echo "Close account"; ?>" style=" margin-left:10px;" onclick="deactivateUser()"/>
                 
                 </div>
                   	  
                    <?php } ?>    
                       
                        
                     
                     
                     
                     
                    
                   </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- section_end -->

<script type="text/javascript">

function password_validation(){ 
$("#err_pass_email").html('');
$("#err_pass_password").html('');
$("#err_pass_confirm_password").html('');
var emailAddr = $("#pass_email").val();
var password = $("#pass_password").val();
var confirm_password = $("#pass_confirm_password").val();
if(emailAddr==''){
$("#err_pass_email").html(lg_enter_email_orusername);
return false;
}else if(password==''){
$("#err_pass_password").html(lg_required_field);
return false;
}else if(password!=confirm_password){
$("#err_pass_confirm_password").html(lg_password_mismatch);
return false;
}
}
function hideErrDiv(arg) {
	 $("#"+arg).hide("slow");
}


function email_validation(){ 
$("#err_email_email").html('');
$("#err_email_password").html('');
$("#err_email_confirm_email").html('');
var emailAddr = $("#email_email").val();
var password = $("#email_password").val();
var confirm_email = $("#email_confirm_email").val();
if(!IsEmail(emailAddr)){
$("#err_email_email").html(lg_enter_valid_email);
return false;
}else if(emailAddr=="<?php echo $this->session->userdata['shopsy_session_user_email'];?>"){
$("#err_email_email").html(lg_enter_new_email);
return false;
}
else if(emailAddr!=confirm_email){
$("#err_email_confirm_email").html(lg_emailmisssmatch);
return false;
}else if(password==''){
$("#err_email_password").html(lg_required_field);
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