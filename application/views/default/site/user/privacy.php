<?php 

$this->load->view('site/templates/header');

$this->load->model('product_model');

$this->load->model('user_model');

//echo "<pre>";print_r($userProfileDetails);

?>

			<div class="add_steps shop-menu-list">

			<div class="main">
			
				<?php $this->load->view('site/user/sidebar');?> 
			
			</div>
			
			</div>

<section class="container">

    	<div class="main">
		
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="view-profile/<?php echo $this->session->userdata['shopsy_session_user_name'];?>" class="a_links"><?php echo $this->session->userdata['shopsy_session_user_name'];?></a></li>
		   <span>&rsaquo;</span>
		   <li><?php if($this->lang->line('privacy_sett') != '') { echo stripslashes($this->lang->line('privacy_sett')); } else echo "Privacy settings"; ?></li>
        </ul>
        	

            <div class="community_page">

            	

                <div class="community_div">

                    <form action="update_privacy" method="post" id="privacy_form">

                    <div class="community_right container">

                    	 

                         <?php $this->load->view("site/user/settings_tab");?>

                           

                    <div class="pass">

                  <div class="heading_account" ><?php if($this->lang->line('user_phone_findability') != '') { echo stripslashes($this->lang->line('user_phone_findability')); } else echo 'Findability'; ?></div>

                  <p class="p_text"><?php if($this->lang->line('user_find_email') != '') { echo stripslashes($this->lang->line('user_find_email')); } else echo 'Do you want others to be able to find you by your email address? Your email address will not be publicly displayed'; ?>.</p>

                  <div class="field_account">

        	        <input name="privacy" value="Yes" <?php if($privacy->row()->privacy == 'Yes'){ echo 'checked="checked"';}?>  type="radio"  style="float:left;"/>

                     <label style=" margin:3px 0 0 3px;" ><?php if($this->lang->line('user_yes') != '') { echo stripslashes($this->lang->line('user_yes')); } else echo 'Yes'; ?></label>

                  </div>

                   <div class="field_account">

        	        <input name="privacy" value="No" <?php if($privacy->row()->privacy == 'No'){ echo 'checked="checked"';}?>  type="radio" style="float:left;"/>

                     <label style=" margin:3px 0 15px 3px;" ><?php if($this->lang->line('user_no') != '') { echo stripslashes($this->lang->line('user_no')); } else echo 'No'; ?></label>

                  </div>

        

                 </div>	

            

            		

             <div class="clear"></div>

         

          	<input type="submit" class="password_btn" value="<?php if($this->lang->line('user_update_pri_set') != '') { echo stripslashes($this->lang->line('user_update_pri_set')); } else echo 'Update Privacy Settings'; ?>" style=" margin-left:10px; margin-top:1px;" />

           

                   </div>

                   </form>

                </div>

            </div>

        </div>

    </section>

  

    <?php 

     $this->load->view('site/templates/footer');

?>