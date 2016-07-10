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
           <li><a href="view-profile/<?php echo $this->uri->segment(3);?>" class="a_links"><?php echo $this->session->userdata['shopsy_session_user_name'];?></a></li>
		    <span>&rsaquo;</span>
           <li><?php if($this->lang->line('credit_card') != '') { echo stripslashes($this->lang->line('credit_card')); } else echo "Credit cards"; ?></li>
        </ul>	

            <div class="community_page">
            	

                <div class="community_div">

                    <div class="community_right container">
                    	   

                               <?php $this->load->view("site/user/settings_tab");?>


                     <?php if($CardsDetails->num_rows() > 0){?>

                        <div class="pass">

                            <div class="heading_account" ><?php if($this->lang->line('user_your_addrs') != '') { echo stripslashes($this->lang->line('user_your_addrs')); } else echo "Your Addresses"; ?></div>

                            <div class="opt_des" style="float:left;">

                           

                               

                                

                               

                                <b><?php if($this->lang->line('user_credit_card') != '') { echo stripslashes($this->lang->line('user_credit_card')); } else echo "Credit Card"; ?>:</b><label> &nbsp; <?php echo $CardsDetails->row()->card_type?></label><br />

                                <b> <?php if($this->lang->line('user_crdit_card_no') != '') { echo stripslashes($this->lang->line('user_crdit_card_no')); } else echo "Credit Card Number"; ?>:</b><label> &nbsp;<?php echo $CardsDetails->row()->card_number?></label><br />

                                <b><?php if($this->lang->line('user_cvv') != '') { echo stripslashes($this->lang->line('user_cvv')); } else echo "CVV"; ?>:</b><label> &nbsp;xxx</label><br />

                                <b><?php if($this->lang->line('user_exp_date') != '') { echo stripslashes($this->lang->line('user_exp_date')); } else echo "Expiry Date"; ?>:</b><label> &nbsp;<?php echo $CardsDetails->row()->exp_month?>-<?php echo $CardsDetails->row()->exp_year?></label><br />

                                <input type="submit" class="button_se" value="<?php if($this->lang->line('user_remove') != '') { echo stripslashes($this->lang->line('user_remove')); } else echo 'Remove'; ?>" style=" margin-top:10px; margin-left:0px" onclick="window.location.href='site/user/remove_creadit_card/<?php echo $details['id']?>'"/>   

                               

                                                 

                             

                          </div>

                        </div>

                        <?php } else {?>

                     

                     

                      <script>$(document).ready(function(){	$("#creditcartprocess").validate(); });</script>

                     <form name="creditcartprocess" id="creditcartprocess" action="site/user/add_credit_cards" method="post">     

                   <div class="pass">

                  <div class="heading_account" ><?php if($this->lang->line('user_credt_cards') != '') { echo stripslashes($this->lang->line('user_credt_cards')); } else echo "Credit Cards"; ?></div>

                  <div class="opt_des">

                  <h2 style="font-size:14px; font-family: sans-serif; font-weight:bold;"><?php if($this->lang->line('user_no_saved_cards') != '') { echo stripslashes($this->lang->line('user_no_saved_cards')); } else echo "You don't have any saved credit cards on file"; ?></h2>

                  </div>

                   <div class="credit_field">

                    

        	<label ><?php if($this->lang->line('user_crdit_card_no') != '') { echo stripslashes($this->lang->line('user_crdit_card_no')); } else echo "Credit Card Number"; ?></label>

            <input type="text" class="search required" name="card_number" style="margin:0" />

                   </div>

        

                   <!--<div class="credit_field">

        	<label >Name</label>

            <input type="text" name="card_name" id="card_name" class="search required" style="margin:0" />

                   </div>-->

        

         <div class="credit_field">

         	    <label ><?php if($this->lang->line('user_credit_card') != '') { echo stripslashes($this->lang->line('user_credit_card')); } else echo "Credit Card"; ?> </label>

        	    <select class="shipping_fiel required" id="card_type" name="card_type" style=" margin-left:0px; width:81%;">

                     <option value=""><?php if($this->lang->line('user_select_card') != '') { echo stripslashes($this->lang->line('user_select_card')); } else echo "Select your card"; ?></option>

                     <option value="American Express"><?php if($this->lang->line('user_amrican_exp') != '') { echo stripslashes($this->lang->line('user_amrican_exp')); } else echo "American Express"; ?></option>

                     <option value="Visa"><?php if($this->lang->line('user_visa') != '') { echo stripslashes($this->lang->line('user_visa')); } else echo "Visa"; ?></option>

                     <option value="Master Card"><?php if($this->lang->line('user_master_card') != '') { echo stripslashes($this->lang->line('user_master_card')); } else echo "Master Card"; ?></option>

                     <option value="Discover"><?php if($this->lang->line('user_discover') != '') { echo stripslashes($this->lang->line('user_discover')); } else echo "Discover"; ?></option>

                    </select>

         </div>

         <div class="credit_field">

         	    <label ><?php if($this->lang->line('user_exp_date') != '') { echo stripslashes($this->lang->line('user_exp_date')); } else echo "Expiry Date"; ?></label>

                <?php $Sel ='selected="selected"';  ?>

                    <select class="shipping_fiel required" id="expiry_month" name="expiry_month" style=" margin-left:0px; width:30%;">												

                    <option value="01" <?php if(date('m')=='01'){ echo $Sel;} ?>>01</option>

                    <option value="02" <?php if(date('m')=='02'){ echo $Sel;} ?>>02</option>

                    <option value="03" <?php if(date('m')=='03'){ echo $Sel;} ?>>03</option>

                    <option value="04" <?php if(date('m')=='04'){ echo $Sel;} ?>>04</option>

                    <option value="05" <?php if(date('m')=='05'){ echo $Sel;} ?>>05</option>

                    <option value="06" <?php if(date('m')=='06'){ echo $Sel;} ?>>06</option>

                    <option value="07" <?php if(date('m')=='07'){ echo $Sel;} ?>>07</option>

                    <option value="08" <?php if(date('m')=='08'){ echo $Sel;} ?>>08</option>

                    <option value="09" <?php if(date('m')=='09'){ echo $Sel;} ?>>09</option>

                    <option value="10" <?php if(date('m')=='10'){ echo $Sel;} ?>>10</option>

                    <option value="11" <?php if(date('m')=='11'){ echo $Sel;} ?>>11</option>

                    <option value="12" <?php if(date('m')=='12'){ echo $Sel;} ?>>12</option>

                </select>

                <select class="shipping_fiel required" name="expiry_year" id="expiry_year" style=" margin-left:0px; width:30%;">

					<?php for($i=date('Y');$i< (date('Y') + 30);$i++){ ?>	

                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                    <?php } ?>    

                </select>

         </div>

         <div class="credit_field">

        	<label ><?php if($this->lang->line('user_cvv') != '') { echo stripslashes($this->lang->line('user_cvv')); } else echo "CVV"; ?></label>

            <input type="text" id="cvv" name="cvv" class="search required" style="margin:0" />

         </div>

                 

             <div class="clear"></div>

         

          	<input type="submit" class="password_btn" value="<?php if($this->lang->line('user_submit') != '') { echo stripslashes($this->lang->line('user_submit')); } else echo 'Submit'; ?>" style=" margin-left:10px; margin-top:1px;" />

                 

                </div>	

            

                   </form>

                   <?php }?>

                   </div>

                </div>

            </div>

        </div>

    </section>

  <script type="text/javascript" src="js/site/jquery.validate.js"></script>

  

<?php $this->load->view('site/templates/footer'); ?>

