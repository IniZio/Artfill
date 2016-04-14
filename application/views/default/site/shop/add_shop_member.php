<?php 
$this->load->view('site/templates/shop_header');
//$checkloginIDarr=$this->session->all_userdata(); echo "<pre>"; print_r($checkloginIDarr);

?>

<script type="text/ecmascript" src="js/site/custom_validation.js" ></script>

<div class="clear"></div>
<section class="container">

    	<div class="main">
		
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links">Your shop</a></li>
		   <span>&rsaquo;</span>
		   <li>Shop billing</li>
        </ul>

        <?php if($SellerValShop->row()->status == 'active'){ ?>

            <div class="shop_details">

            	<span class="shop_title"><?php if($this->lang->line('shop_member') != '') { echo stripslashes($this->lang->line('shop_member')); } else echo 'Membership Plan'; ?>.</span>                

                <div class="list_div1">

                	<div class="list_inner_fields" style="border:none">
					
					<?php if($SellerValShop->row()->membership_status == 0){ $sellpriceVal=0;?>

                    <?php $total_amt = $this->config->item('membership_price'); ?>

                    	<div style="float:left; width:60%; color:#333; margin:0 0 5px; font-size:12px; line-height:normal"><strong><?php if($this->lang->line('shop_member_plan') != '') { echo stripslashes($this->lang->line('shop_member_plan')); } else echo 'Please Activate the your Membership Plan for'; ?></strong></div>


                        <div style="float:left; width:100%; color:#333; font-size:12px; line-height:normal"> <?php if($this->lang->line('shop_costs') != '') { echo stripslashes($this->lang->line('shop_costs')); } else echo 'It costs'; ?>&nbsp; <?php echo $dcurrencySymbol; ?><?php echo number_format($total_amt,2); ?> <?php if($this->lang->line('shop_publish') != '') { echo stripslashes($this->lang->line('shop_publish')); } else echo 'USD to publish a listing. When an item sells, we charge a'; ?> <?php echo $userDetails->commision; if(substr($userDetails->commision,-1) != '%') { echo '%'; }?> <?php if($this->lang->line('shop_transaction') != '') { echo stripslashes($this->lang->line('shop_transaction')); } else echo 'transaction fee on the item price'; ?>. </div>
						
						

                    </div>            

                
					<?php } ?>
                
					<?php if($SellerValShop->row()->membership_status == 1 || $SellerValShop->row()->membership_status == 2){ 
							$sellpriceVal=1;
							?>
					
						<div style="float:left; width:60%; color:#333; margin:0 0 5px; font-size:12px; line-height:normal"><strong>Your Next payment due date: <?php echo $SellerValShop->row()->membership_expiry ?>. </strong>
						</div>	 						
						<div class="clear"></div>
						<?php if($SellerValShop->row()->membership_status == 2){ 
							$sellpriceVal=0; }
							?>
						
					<?php } ?>	
					<?php
						if($sellpriceVal==0){
					 $paypalProcess = unserialize($paypal_ipn_settings['settings']); 		 #echo $paypalProcess['merchant_email']; die;
					 if($paypalProcess['mode'] == 'sandbox'){
					$paypalUrl = "https://www.sandbox.paypal.com/cgi-bin/webscr";
					} else {
					$paypalUrl = "https://www.paypal.com/cgi-bin/webscr";
					}
					
					$paymentName = $this->config->item('email_title')." membership payment.";
					$Memberprice = $this->config->item('membership_price');
					$MemberPlan = $this->config->item('membership_plan');
					$MemberOption = $this->config->item('membership_option');
					
					?>

					<form name="_xclick" action="<?php echo $paypalUrl;?>" method="post">					
										<!-- Identify your business so that you can collect the payments. -->
										<input type="hidden" name="business" value="<?php echo $paypalProcess['merchant_email']; ?>">

										<!-- Specify a Subscribe button. -->
										<input type="hidden" name="cmd" value="_xclick-subscriptions">

										<!-- Identify the subscription. -->
										<input type="hidden" name="item_name" value="<?php echo $paymentName; ?>">
										<input type="hidden" name="item_number" value="1111">

										<input type="hidden" name="image_url" value="<?php echo base_url().'images/logo/'.$this->config->item('logo_image');?>">
										<input type="hidden" name="no_note" value="1">
										<input type="hidden" name="no_shipping" value="1">
											
											<!-- returning function . -->
										<?php $dealCodeNumber=time();?>
											
										<input type="hidden" name="return" value="<?php echo base_url().'subscribe/success/'.$userIdVal.'/'.$dealCodeNumber?>">
										<input type="hidden" name="cancel_return" value="<?php echo base_url().'subscribe/failure';?>">
										<input type="hidden" name="notify_url" value="<?php echo base_url().'subscribe/ipnsubscribepayment';?>">
																				
										<!-- Set the terms of the 1st trial period. -->
										<input type="hidden" name="currency_code" value="<?php echo $dcurrencyType; ?>">
										<!-- <input type="hidden" name="a1" value="0">
										<input type="hidden" name="p1" value="1">
										<input type="hidden" name="t1" value="Y"> -->
										
										<!-- Set the terms of the regular subscription. -->
										<input type="hidden" name="a3" value="<?php echo $Memberprice; ?>">
										<input type="hidden" name="p3" value="<?php echo $MemberOption; ?>">
										<input type="hidden" name="t3" value="<?php echo $MemberPlan; ?>">
										
										<input type="hidden" name="custom" value="<?php echo $userIdVal; ?>">

										<!-- Set recurring payments until canceled. -->
										<input type="hidden" name="src" value="1">

										<!-- Display the payment button. -->
										<input type="image" name="submit" style="border:none;" border="0" src="http://www.paypal.com/en_GB/i/btn/x-click-but20.gif" alt="PayPal - The safer, easier way to pay online">
										<img alt="" border="0" width="1" height="1" src="http://www.paypal.com/en_GB/i/btn/x-click-but20.gif" >
									
					</form>
					<?php } ?>
					</div>
		        </div>
	        </div>
            </div>

         <?php }else{ ?>   

	         <div class="shop_details">

            	<span class="shop_title"><?php if($this->lang->line('shop_activated') != '') { echo stripslashes($this->lang->line('shop_activated')); } else echo 'Your Shop is Not Activated by Admin'; ?>.</span>                

                <div class="list_div1">

                	<div class="list_inner_fields" style="border:none">

                    

                    	<div style="float:left; width:60%; color:#333; margin:0 0 5px; font-size:12px; line-height:normal"><strong><?php if($this->lang->line('shop_contact') != '') { echo stripslashes($this->lang->line('shop_contact')); } else echo 'Please contact admin'; ?> @ <a href="mailto:<?php echo $this->config->item('site_contact_mail'); ?>"><?php echo $this->config->item('site_contact_mail'); ?></a></strong></div>

                        

                    </div>            

                </div>

            </div>

         <?php } ?>

    	</div>
		
		</section>

      
<?php 

$this->load->view('site/templates/footer');

?>

