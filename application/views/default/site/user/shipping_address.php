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
			    <li><?php if($this->lang->line('shipping_add') != '') { echo stripslashes($this->lang->line('shipping_add')); } else echo "Shipping addresses"; ?></li>
			</ul>
			
            <div class="community_page">

                <div class="community_div">

                    <div class="community_right container">

						<?php $this->load->view("site/user/settings_tab");?>

                        <?php if(!empty($shipping_address)){?>

                        <div class="pass">

                            <div class="heading_account" ><?php if($this->lang->line('user_your_addrs') != '') { echo stripslashes($this->lang->line('user_your_addrs')); } else echo 'Your Addresses'; ?></div>

                            <div class="opt_des" style="float:left;">

                              <ul class="ship_add">

                                <?php foreach($shipping_address as $details){?>

                                

                                <li>

                                <h2><?php echo $details['full_name']?></h2>

                                <p> <?php echo $details['address1']?>, <?php echo $details['address2']?> </p>

                                <p><?php echo $details['city']?>, <?php echo $details['state']?> <?php echo $details['postal_code']?></p>

                                <p><?php echo $details['country']?></p>

                                <input type="submit" class="button_se" value="<?php if($this->lang->line('user_remove') != '') { echo stripslashes($this->lang->line('user_remove')); } else echo 'Remove'; ?>" style=" margin-top:10px; margin-left:0px" onclick="window.location.href='site/user/remove_shipping_address/<?php echo $details['id']; ?>'"/>   

                                </li>

                                <?php }?>

                                                 

                              </ul>

                         

                          </div>

                        </div>

                        <?php }?>

                        <div class="pass">

                        <div class="heading_account" ><?php if($this->lang->line('user_add_addrs') != '') { echo stripslashes($this->lang->line('user_add_addrs')); } else echo 'Add an Address'; ?></div>

                        <form action="site/user/add_shipping_address" id="add_shipping" method="post">  

                            <div class="shipping_field">

                            <label > <?php if($this->lang->line('user_country') != '') { echo stripslashes($this->lang->line('user_country')); } else echo 'Country'; ?> 
							<span style="color:red;" class="req">*</span>
							</label><span id="err_country" style="color:red;"></span>

                            <select class="shipping_fiel" style=" margin-left:0px; width:42%;" name="country" id="country">				

                            <option><?php if($this->lang->line('user_select') != '') { echo stripslashes($this->lang->line('user_select')); } else echo 'Select'; ?></option>

                            <?php foreach($country as $c_name){?>

                            <option value="<?php echo $c_name['name']; ?>"><?php echo $c_name['name']; ?></option>

                            <?php }?>

                            </select>

                          	</div>        

                            <div class="shipping_field">

                               <label ><?php if($this->lang->line('user_full_name') != '') { echo stripslashes($this->lang->line('user_full_name')); } else echo 'Full Name'; ?>
							   <span style="color:red;" class="req">*</span>
							   </label><span id="err_name" style="color:red;"></span>

                           

                               <input type="text" class="shipping_fiel" style="margin:0" id="name" name="full_name"/>

                            </div>        

                            <div class="shipping_field">

                                <label ><?php if($this->lang->line('user_street') != '') { echo stripslashes($this->lang->line('user_street')); } else echo 'Street'; ?>
								<span style="color:red;" class="req">*</span>
								</label>
								<span id="err_street" style="color:red;"></span>

                                <input type="text" class="shipping_fiel" style="margin:0" id="street" name="address1"/>

                            </div>                

                            <div class="shipping_field">

                                <label ><?php if($this->lang->line('user_apt_suite_other') != '') { echo stripslashes($this->lang->line('user_apt_suite_other')); } else echo 'Apt/Suite/Other'; ?> <span style="color:red;" class="req">*</span> </label>

                                <input type="text" class="shipping_fiel" style="margin:0" id="aso" name="address2"/>

                            </div>

                            <div class="shipping_field">

                                <label ><?php if($this->lang->line('user_city') != '') { echo stripslashes($this->lang->line('user_city')); } else echo 'City'; ?>  <span style="color:red;" class="req">*</span></label><span id="err_city" style="color:red;"></span>

                                <input type="text" class="shipping_fiel" style="margin:0" id="city" name="city"/>

                            </div>

                            <div class="shipping_field">

                                <label ><?php if($this->lang->line('user_state_region') != '') { echo stripslashes($this->lang->line('user_state_region')); } else echo 'State / Province / Region'; ?> <span style="color:red;" class="req">*</span> </label><span id="err_state" style="color:red;"></span>

                                <input type="text" class="shipping_fiel" style="margin:0" id="state" name="state"/>

                            </div>

                            <div class="shipping_field">

                                <label ><?php if($this->lang->line('user_zip_pcode') != '') { echo stripslashes($this->lang->line('user_zip_pcode')); } else echo 'Zip / Postal Code'; ?> <span style="color:red;" class="req">*</span> </label><span id="err_postal" style="color:red;"></span>

                                <input type="text" class="shipping_fiel" style="margin:0" id="postal" name="postal_code"/>

                            </div> 

                            <div class="shipping_field">

                                <label><?php if($this->lang->line('user_phone_no') != '') { echo stripslashes($this->lang->line('user_phone_no')); } else echo 'Phone Number'; ?> <span style="color:red;" class="req">*</span></label>

                                <span id="err_phone" style="color:red;"></span>

                                <input id="phone" class="required shipping_fiel number" type="text" name="phone" style="margin:0" />

                            </div>

                            <input type="submit" class="password_btn" value="<?php if($this->lang->line('user_add') != '') { echo stripslashes($this->lang->line('user_add')); } else echo 'Add'; ?>" style=" margin-left:260px;" onclick="return shipping_validation();"/>      

                        </form>

                    </div>  

                	</div>

            	</div>

            </div>

        </div>

    </section>
<script>
//$('#add_shipping').validate();
</script>
<?php  $this->load->view('site/templates/footer'); ?>