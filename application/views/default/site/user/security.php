<?php 

$this->load->view('site/templates/header');

$this->load->model('product_model');

$this->load->model('user_model');

//echo "<pre>";print_r($userProfileDetails);

?>



<section class="container">

    	<div class="main">

        	

            <div class="community_page">

            	

                <div class="community_div">

                	<div class="community_left">

                    	 <?php $this->load->view('site/user/sidebar');?>        

                                     

                    </div>

                    <div class="community_right" style="margin-left:15px; float:right; width:78%;">

                    	   

                           <?php $this->load->view("site/user/settings_tab");?>

                           

                    <div class="pass">

                  <div class="heading_account" ><?php if($this->lang->line('user_sec_settins') != '') { echo stripslashes($this->lang->line('user_sec_settins')); } else echo "Security Settings"; ?></div>

                  	<div class="opt_des">

                    	<div class="title_dies">

                        	<h2><?php if($this->lang->line('user_full_site_ssl') != '') { echo stripslashes($this->lang->line('user_full_site_ssl')); } else echo 'Full-site SSL'; ?></h2>

                            <p><?php if($this->lang->line('user_brwose_over_http') != '') { echo stripslashes($this->lang->line('user_brwose_over_http')); } else echo "Browse Artizanzs over HTTPS only"; ?>. <a href="#"><?php if($this->lang->line('user_learn_more') != '') { echo stripslashes($this->lang->line('user_learn_more')); } else echo "Learn more"; ?>.</a></p>

                        </div>

                        <div class="status_no">

                        <span><?php if($this->lang->line('user_on') != '') { echo stripslashes($this->lang->line('user_on')); } else echo "On"; ?></span>

                        </div>

                    <input type="submit" class="button_se button_seact" value="<?php if($this->lang->line('user_disable') != '') { echo stripslashes($this->lang->line('user_disable')); } else echo "Disable"; ?>" style=" margin-left:0px; margin-top:1px;" />

                    </div>

                    

                       	<div class="opt_des">

                    	<div class="title_dies">

                        	<h2><?php if($this->lang->line('user_two_factor_authentic') != '') { echo stripslashes($this->lang->line('user_two_factor_authentic')); } else echo "Two-Factor Authentication"; ?></h2>

                            <p><?php if($this->lang->line('user_twofact_signin') != '') { echo stripslashes($this->lang->line('user_twofact_signin')); } else echo "Two-factor authentication requires you to enter an extra security code when you sign in"; ?>.<a href="#"> <?php if($this->lang->line('user_learn_more') != '') { echo stripslashes($this->lang->line('user_learn_more')); } else echo 'Learn more'; ?>.</a></p>

                        </div>

                        <div class="status_no">

                        <span style="color:#666;"><?php if($this->lang->line('user_off') != '') { echo stripslashes($this->lang->line('user_off')); } else echo 'Off'; ?></span>

                        </div>

                    <input type="submit" class="button_se" value="<?php if($this->lang->line('user_enable') != '') { echo stripslashes($this->lang->line('user_enable')); } else echo "Enable"; ?>" style=" margin-left:0px; margin-top:1px;" />

                    </div>

                    

                       	<div class="opt_des">

                    	<div class="title_dies">

                        	<h2><?php if($this->lang->line('user_full_site_ssl') != '') { echo stripslashes($this->lang->line('user_full_site_ssl')); } else echo "Full-site SSL"; ?></h2>

                            <p><?php if($this->lang->line('user_brwose_over_http') != '') { echo stripslashes($this->lang->line('user_brwose_over_http')); } else echo 'Browse Artizanzs over HTTPS only'; ?>. <a href="#"><?php if($this->lang->line('user_learn_more') != '') { echo stripslashes($this->lang->line('user_learn_more')); } else echo 'Learn more'; ?>.</a></p>

                        </div>

                        <div class="status_no">

                        <span style="color:#666;"><?php if($this->lang->line('user_off') != '') { echo stripslashes($this->lang->line('user_off')); } else echo "Off"; ?></span>

                        </div>

                      <input type="submit" class="button_se" value="<?php if($this->lang->line('user_enable') != '') { echo stripslashes($this->lang->line('user_enable')); } else echo 'Enable'; ?>" style=" margin-left:0px; margin-top:1px;" />

                    </div>

                    

                       	<div class="opt_des">

                    	<div class="title_dies">

                        	<h2><?php if($this->lang->line('user_full_site_ssl') != '') { echo stripslashes($this->lang->line('user_full_site_ssl')); } else echo 'Full-site SSL'; ?></h2>

                            <p><?php if($this->lang->line('user_brwose_over_http') != '') { echo stripslashes($this->lang->line('user_brwose_over_http')); } else echo 'Browse Artizanzs over HTTPS only'; ?>. <a href="#"><?php if($this->lang->line('user_learn_more') != '') { echo stripslashes($this->lang->line('user_learn_more')); } else echo 'Learn more'; ?>.</a></p>

                        </div>

                        <div class="status_no">

                        <span style="color:#666;"><?php if($this->lang->line('user_off') != '') { echo stripslashes($this->lang->line('user_off')); } else echo 'Off'; ?></span>

                        </div>

                     <input type="submit" class="button_se" value="<?php if($this->lang->line('user_enable') != '') { echo stripslashes($this->lang->line('user_enable')); } else echo 'Enable'; ?>" style=" margin-left:0px; margin-top:1px;" />

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