<?php 

$this->load->view('site/templates/shop_header');//$checkloginIDarr=$this->session->all_userdata(); echo "<pre>"; print_r($checkloginIDarr);

?>

<script type="text/ecmascript" src="js/site/custom_validation.js" ></script>


<div class="clear"></div>
<section class="container">

    	<div class="main">
		
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
		   <span>&rsaquo;</span>
		   <li>Shop policies</li>
        </ul>

            <div style="margin-top:20px" class="manage-listing-heading">

            <h1> <?php if($this->lang->line('shopsec_policies') != '') { echo stripslashes($this->lang->line('shopsec_policies')); } else echo 'Shop Policies'; ?> </h1>

            <p> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('shop_encourages') != '') { echo stripslashes($this->lang->line('shop_encourages')); } else echo 'encourages all shops to post policies to help shoppers make informed purchases'; ?>. </p>

            </div>

            

            <form id="policies" class="shop-form-policies" method="post" action="site/shop/shop_policy_setting">

            <div class="shop-form-section">

            <div class="shop-form-section-inner">

            

              

             <div class="shop_member">

            <label class="label-text"> <?php if($this->lang->line('shop_welcomemsg') != '') { echo stripslashes($this->lang->line('shop_welcomemsg')); } else echo 'Welcome Message'; ?>  </label>

            <textarea id="welcome_message" class="message121" rows="4" name="welcome_message" style="overflow: hidden; height: 81px;"><?php echo $selectSeller_details[0]['welcome_message']; ?></textarea>

            <p class="inline-message"><?php if($this->lang->line('shop_generalinfo') != '') { echo stripslashes($this->lang->line('shop_generalinfo')); } else echo 'General information, philosophy, etc'; ?>.</p>

            </div>

            

            <hr>

            

            <div class="shop_member">

            <label class="label-text"> <?php if($this->lang->line('shop_payment') != '') { echo stripslashes($this->lang->line('shop_payment')); } else echo 'Payment Policy'; ?> </label>

            <textarea id="payment_policy" class="message121" rows="4" name="payment_policy" style="overflow: hidden; height: 81px;"><?php echo $selectSeller_details[0]['payment_policy']; ?></textarea>

            <p class="inline-message"><?php if($this->lang->line('shop_paymentmethods') != '') { echo stripslashes($this->lang->line('shop_paymentmethods')); } else echo 'Payment methods, terms, deadlines, taxes, cancellation policy, etc'; ?>.</p>

            </div>

            

            <hr>

            

            

             <div class="shop_member">

            <label class="label-text"> <?php if($this->lang->line('shop_shipping') != '') { echo stripslashes($this->lang->line('shop_shipping')); } else echo 'Shipping Policy'; ?> </label>

            <textarea id="shipping_policy" class="message121" rows="4" name="shipping_policy" style="overflow: hidden; height: 81px;"><?php echo $selectSeller_details[0]['shipping_policy']; ?></textarea>

            <p class="inline-message"><?php if($this->lang->line('shop_shippingmethods') != '') { echo stripslashes($this->lang->line('shop_shippingmethods')); } else echo 'Shipping methods, upgrades, deadlines, insurance, confirmation, international customs, etc'; ?>.</p>

            </div>

            

            <hr>

            

            

            

             <div class="shop_member">

            <label class="label-text"> <?php if($this->lang->line('shop_refund') != '') { echo stripslashes($this->lang->line('shop_refund')); } else echo 'Refund Policy'; ?> </label>

            <textarea id="refund_policy" class="message121" rows="4" name="refund_policy" style="overflow: hidden; height: 81px;"><?php echo $selectSeller_details[0]['refund_policy']; ?></textarea>

            <p class="inline-message"><?php if($this->lang->line('shop_eligibleitems') != '') { echo stripslashes($this->lang->line('shop_eligibleitems')); } else echo 'Terms, eligible items, damages, losses, etc'; ?>.</p>

            </div>

            

            <hr>

            

            

            

             <div class="shop_member">

            <label class="label-text"> <?php if($this->lang->line('shop_additionalinfo') != '') { echo stripslashes($this->lang->line('shop_additionalinfo')); } else echo 'Additional Information'; ?>  </label>

            <textarea id="additional_information" class="message121" rows="4" name="additional_information" style="overflow: hidden; height: 81px;"><?php echo $selectSeller_details[0]['additional_information']; ?></textarea>

            <p class="inline-message"><?php if($this->lang->line('shop_additionalpolicies') != '') { echo stripslashes($this->lang->line('shop_additionalpolicies')); } else echo 'Additional policies, FAQs, custom orders, wholesale & consignment, guarantees, etc'; ?>.</p>

            </div>

            

            <hr>

            

            

            

             <div class="shop_member">

            <label class="label-text"><?php if($this->lang->line('shop_sellerinformation') != '') { echo stripslashes($this->lang->line('shop_sellerinformation')); } else echo 'Seller Information'; ?> </label>

            <textarea id="seller_information" class="message121" rows="4" name="seller_information" style="overflow: hidden; height: 81px;"><?php echo $selectSeller_details[0]['seller_information']; ?></textarea>

            <p class="inline-message"><?php if($this->lang->line('shop_somecountries') != '') { echo stripslashes($this->lang->line('shop_somecountries')); } else echo 'Some countries require seller information such as your name, physical address, contact email address and, where applicable, tax identification number. See this FAQ for more information'; ?>. </p>

            </div>

            

           

       

            </div></div>

            <span class="button-large">

            <span>

            <input type="submit" value="<?php if($this->lang->line('user_save') != '') { echo stripslashes($this->lang->line('user_save')); } else echo 'Save'; ?>" />

            </span>

            </span>

            

            

           </form> 

        </div>

    </section> 	

 


<?php 

$this->load->view('site/templates/footer');

?>

