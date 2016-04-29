<div class="cms_page">

                  <div class="cms_heading">

                  

                  <h1>

                    <span class="cms_text"><?php echo $get_seller_details['seller_businessname']; ?>'</span>

                    <?php if($this->lang->line('shopsec_policies') != '') { echo stripslashes($this->lang->line('shopsec_policies')); } else echo 'Shop Policies'; ?>

                    </h1>

                  </div>

                  

                  <div class="cms_sub">

                  <span><?php if($this->lang->line('shopsec_welcome') != '') { echo stripslashes($this->lang->line('shopsec_welcome')); } else echo 'welcome'; ?></span>

                &emsp;<?php echo stripslashes($get_seller_details['welcome_message']);?>                  

                  </div>

                   <div class="cms_sub">

                  <span><?php if($this->lang->line('shopsec_payment') != '') { echo stripslashes($this->lang->line('shopsec_payment')); } else echo 'Payment'; ?></span>

                  &emsp;<?php echo stripslashes($get_seller_details['payment_policy']);?>

                  

                  </div>       

                          

                  <div class="cms_sub">

                  <span><?php if($this->lang->line('shopsec_shipping') != '') { echo stripslashes($this->lang->line('shopsec_shipping')); } else echo 'Shipping'; ?></span>

                  &emsp;<?php echo stripslashes($get_seller_details['shipping_policy']);?>

                  

                  </div>  

                                 

                          <div class="cms_sub">

                  <span><?php if($this->lang->line('shopsec_refunds') != '') { echo stripslashes($this->lang->line('shopsec_refunds')); } else echo 'Refunds and Exchanges'; ?></span>

                &emsp;<?php echo stripslashes($get_seller_details['refund_policy']);?>

                  

                  </div>     

                 <?php if($get_seller_details['lastupdated'] != '') { ?>      

                 	<i><?php if($this->lang->line('shopsec_updated') != '') { echo stripslashes($this->lang->line('shopsec_updated')); } else echo 'Last Updated'; ?> <?php echo date("M d, Y",strtotime($get_seller_details['lastupdated'])); ?>               </i><br />

                 <?php } ?>

                <!-- <i>Last Updated April 1, 2014</i>-->

                  </div>