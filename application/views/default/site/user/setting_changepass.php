<?php 

$this->load->view('site/templates/header');

$this->load->model('product_model');

?>

<!-- section_start -->

	<section class="container">

    	<div class="main">

        	<ul class="bread_crumbs">

            	<li><a href="#"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo 'Home'; ?></a></li>

                <span>›</span>

                <li><a href="#"><?php if($this->lang->line('user_community') != '') { echo stripslashes($this->lang->line('user_community')); } else echo 'Community'; ?></a></li>

                <span>›</span>

                <li><a href="#"><?php if($this->lang->line('user_teams') != '') { echo stripslashes($this->lang->line('user_teams')); } else echo 'Teams'; ?></a></li>

            </ul>

            <div class="community_page">

            	<div class="community_head">

                	<h1><?php if($this->lang->line('success_team') != '') { echo stripslashes($this->lang->line('success_team')); } else echo '2014 Success Team'; ?></h1>

                    

                   

                </div>

                <div class="community_div">

                	<div class="community_left">

                    	<div class="side_bar">

                         

                          

                         

                    		<ul>

                        		<li><a href="#"><?php if($this->lang->line('purchases-review') != '') { echo stripslashes($this->lang->line('purchases-review')); } else echo 'Purchases & Reviews'; ?></a></li>

                                <li><a href="#"><?php if($this->lang->line('user_pub_profile') != '') { echo stripslashes($this->lang->line('user_pub_profile')); } else echo 'Public Profile'; ?></a></li>

                                 <li class="side_active"><a href="#"><?php if($this->lang->line('user_settings') != '') { echo stripslashes($this->lang->line('user_settings')); } else echo 'Settings'; ?></a></li>

                                 <li><a href="#"><?php if($this->lang->line('user_apps') != '') { echo stripslashes($this->lang->line('user_apps')); } else echo 'Apps'; ?></a></li>

                                 <li><a href="#"><?php if($this->lang->line('user_prototypes') != '') { echo stripslashes($this->lang->line('user_prototypes')); } else echo 'Prototypes'; ?></a></li>

                                 <li><a href="#"><?php if($this->lang->line('sign_out') != '') { echo stripslashes($this->lang->line('sign_out')); } else echo 'Sign Out'; ?></a></li>

                                 

                             

                               <!-- <li class="side_active"><a href="#">Teams</a></li>-->

                        	</ul>

                        </div>       

                       

                        

                    

                     

                     

                                       

                    </div>

                    <div class="community_right" style="margin-left:15px; float:right; width:78%;">

                    	   

                    <div class="acc_full">

                <div class="section">

                <div class="heading_account" ><?php if($this->lang->line('user_about_us') != '') { echo stripslashes($this->lang->line('user_about_us')); } else echo 'About us'; ?></div>

                <div class="account_info">

                <h2><?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo 'Name'; ?></h2>

                <p>karthik selvaraj <a href="#"> edit profile </a></p>

                </div>

                <div class="account_info">

                <h2>Username</h2>

                <p>karthik2<span style="margin-left:5px; font-family:11px; color:#bcbcbc">cannot be changed</span></p>

                </div>

                <div class="account_info">

                <h2> Member since</h2>

                <p style=" margin-bottom:28px;">November  <span style="margin-left:5px;">  13, 2013</span></p>

                </div>

                

                </div>

                 <div class="section"  style="margin-right:0px;height:205px">

                <div class="heading_account" >Connected Accounts</div>

                <div class="account_info">

                <img src="images/fa.jpg" /><a href="#" style="margin:10px 0 0 10px; float:left;">Connect with Facebook</a>

                </div>

                <div class="clear"></div>

                <div class=" bor_str"></div>

                <div class="account_info">

                 <img src="images/twit.jpg" /><a href="#" style="margin:10px 0 0 10px; float:left;">Connect with Twitter</a>

                </div>

                <div class="clear"></div>

                <div class=" bor_str"></div>

                <div class="account_info">

               

                <p style="font-size:11px; color:#999999; margin-bottom:35px;">Connecting to Facebook will allow your friends to find you on <?php echo $this->config->item('email_title'); ?>.  </p>

                </div>

                

                </div>

               

                </div>	

                     

                     	<div class="pass">

                  <div class="heading_account" >Password</div>

                  <div class="field_account">

        	         <label >Email or Username</label><!--<span style="color:#F00; " class="with_field">*</span>-->

                     <input type="text" class="search" style="margin:0" />

                  </div>

        

                 <div class="field_account">

        	       <label >Password</label>

                   <div class="clear"></div>

                   <input type="Password" class="search" style="margin:0" />

                </div>

        

         <div class="field_account">

        	<label >Confirm New Password</label>

            <input type="Password" class="search" style="margin:0" />

        </div>

           <div class="clear"></div>

         

          	<input type="submit" class="password_btn" value="Change Password" style=" margin-left:10px;" />

        

                 

                 </div>

                 

                 

                 			<div class="pass">

                  <div class="heading_account" >Email</div>

                  

                 <div class="account_info">

               		 <h2> Current email</h2>

               		 <p>karthik@teamtweaks.com </p>

                </div>

                

                 <div class="account_info">

               		 <h2> Status</h2>

               		 <p>confirmed </p>

                </div>

                

                <div class="clear"></div>

                

                

                 <div class=" bor_str_2"></div>

                 <h2 class="hed_title">New Email</h2>

                 <div class="field_account">

        	         <label >Email or Username</label>

                     <input type="text" class="search" style="margin:0" />

                  </div>

        

                 <div class="field_account">

        	       <label >Confirm New Email</label>

                   <div class="clear"></div>

                   <input type="text" class="search" style="margin:0" />

                </div>

        

         <div class="field_account">

        	<label >Your <?php echo $this->config->item('email_title'); ?> Password</label>

            <input type="Password" class="search" style="margin:0" />

        </div>

         <div class="clear"></div>

         

          	<input type="submit" class="password_btn" value="Change email" style=" margin-left:10px;" /><p  class="side_tex">Your email address will not change until you confirm it via email.</p>

        

           </div>

           

           						<div class="pass">

                  <div class="heading_account" >Close Your Account </div>

                   <h2 class="hed_title_2">What happens when you close your Account? </h2>

                    <div class="account_info">

               		 <h2 style="font-size:12px; color:##333333; font-weight:bold;"> Your profile, shop and listings won't appear anywhere on Artizanz.</h2>

               		 <p>People who try to view your profile, shop or one of your shop's listings will see a message that the page is not available. </p>

                </div>

                

                <div class="account_info">

               		 <h2 style="font-size:12px;color:##333333; font-weight:bold;">Non-delivery cases you have opened will be closed.</h2>

               		 <p>Reported non-delivery cases for an items you never received from a shop will no longer be active.  </p>

                </div>

                 <div class="account_info">

               		 <h2 style="font-size:12px;color:##333333; font-weight:bold;">You can reopen your account any time.</h2>

               		 <p>If you want to reopen your account, simply sign in to Artizanz.com when you want to return. You can also <a href="#">contact Artizanz support</a> to help you reopen your account. No one will be able to use your username, and your account settings will remain intact. </p>

                </div>

                

                  <div class="clear"></div>

         

          	<input type="submit" class="password_btn" value="Close account" style=" margin-left:10px;" />

                 

                 </div>

                   	  

                        

                       

                        

                     

                     

                     

                     

                    

                   </div>

                </div>

            </div>

        </div>

    </section>

<!-- section_end -->

<?php 

     $this->load->view('site/templates/footer');

?>