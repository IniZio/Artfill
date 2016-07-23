<?php 

$this->load->view('site/templates/header');

$this->load->model('product_model');

$this->load->model('user_model');

//echo "<pre>";print_r($userProfileDetails);

?>

<!-- section_start -->

<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
        
        
<div id="profile_div">
<section class="container">

    	<div class="main">
		
        	

            <div class="community_page">

            	

                <div class="community_div">

                	<form action="site/user/cart_add_shipping_address" method="post">  

                    <div class="community_right" style="margin-left:15px; float:left; width:78%;">

                    	   

                    	

                

                		<div class="pass">

                  <div class="heading_account" ><?php if($this->lang->line('user_add_addrs') != '') { echo stripslashes($this->lang->line('user_add_addrs')); } else echo "Add an Address"; ?></div>

                 

                   <div class="shipping_field">

        	         <label > <?php if($this->lang->line('user_country') != '') { echo stripslashes($this->lang->line('user_country')); } else echo "Country"; ?><span style="color:red;">*</span> </label><span id="err_country" style="color:red;"></span>

                     <select class="shipping_fiel" style=" margin-left:0px; width:42%;" name="country" id="country">				

                            <option><?php if($this->lang->line('user_select') != '') { echo stripslashes($this->lang->line('user_select')); } else echo "Select"; ?></option>

                            <?php foreach($country as $c_name){?>

                            <option value="<?php echo $c_name['name']?>"><?php echo $c_name['name']?></option>

                            <?php }?>

                            </select>

                  </div>

        

                 <div class="shipping_field">

        	       <label ><?php if($this->lang->line('user_full_name') != '') { echo stripslashes($this->lang->line('user_full_name')); } else echo "Full Name"; ?><span style="color:red;">*</span> </label><span id="err_name" style="color:red;"></span>

               

                   <input name="name" id="name" type="text" class="shipping_fiel" style="margin:0" />

                </div>

        

         <div class="shipping_field">

        	<label ><?php if($this->lang->line('user_street') != '') { echo stripslashes($this->lang->line('user_street')); } else echo "Street"; ?><span style="color:red;">*</span> </label><span id="err_street" style="color:red;"></span>

            <input type="text" class="shipping_fiel" style="margin:0" id="street" name="address1" />

        </div>

                

             <div class="shipping_field">

        	<label ><?php if($this->lang->line('user_apt_suite_other') != '') { echo stripslashes($this->lang->line('user_apt_suite_other')); } else echo "Apt/Suite/Other"; ?><span style="color:red;">*</span>  </label>

            <input type="text" class="shipping_fiel" style="margin:0" id="aso" name="address2" />

        </div>

         <div class="shipping_field">

        	<label ><?php if($this->lang->line('user_city') != '') { echo stripslashes($this->lang->line('user_city')); } else echo "City"; ?><span style="color:red;">*</span>  </label><span id="err_city" style="color:red;"></span>

            <input type="text" class="shipping_fiel" style="margin:0"  id="city" name="city"/>

        </div>

         <div class="shipping_field">

        	<label ><?php if($this->lang->line('user_state_region') != '') { echo stripslashes($this->lang->line('user_state_region')); } else echo "State / Province / Region"; ?><span style="color:red;">*</span>  </label><span id="err_state" style="color:red;"></span>

            <input type="text" class="shipping_fiel" style="margin:0" id="state" name="state"/>

        </div>

         <div class="shipping_field">

        	<label ><?php if($this->lang->line('user_zip_pcode') != '') { echo stripslashes($this->lang->line('user_zip_pcode')); } else echo "Zip / Postal Code"; ?><span style="color:red;">*</span>  </label><span id="err_postal" style="color:red;"></span>

            <input type="text" class="shipping_fiel" style="margin:0" id="postal" name="postal_code"/>

        </div>

          <div class="shipping_field">

          <label><?php if($this->lang->line('user_phone_no') != '') { echo stripslashes($this->lang->line('user_phone_no')); } else echo "Phone Number"; ?><span style="color:red;">*</span> </label><span id="err_phone" style="color:red;"></span>

          <input class="shipping_fiel" type="text" style="margin:0" name="phone" id="phone" /></div>

    

   <!-- <div class="shipping_field"><label>

      Make as Primary<br>  

    </label><input style="margin: 10px 0 0 0;" type="checkbox" name="primary" value="prim"></div>-->

            	<input type="submit" class="password_btn" value="<?php if($this->lang->line('user_add') != '') { echo stripslashes($this->lang->line('user_add')); } else echo 'Add'; ?>" style=" margin-left:260px;" onclick="return shipping_validation();"/>        

                  

                  

                </div>

            

            		

               

                    

                   </div>

                   </form>

                </div>

            </div>

        </div>

    </section>

	</div>

<!-- section_end -->



<?php  $this->load->view('site/templates/footer'); ?>