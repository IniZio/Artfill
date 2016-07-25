<?php 
$this->load->view('site/templates/header');
?>


<?php 
if($CurrUserImg != ''){
	$user_pic='users/thumb/'.$CurrUserImg; 													
}else{ 
	$user_pic='default_avat.png';
} 												
?>

 <?php if($showShopHead == 0){ ?>
<div class="add_shop">
  <div class="main" style="width:100%;">
	
	<!--<div id="flip">Menu</div>-->
	<div id="nav-trigger">
            <!--<span>Menu</span>-->
    </div>
	<nav id="nav-main">
    <ul id="panel" class="add_steps" style="background:none; box-shadow:none;">
      
      
      
      <li <?php if ($this->uri->segment(3) == 'banner' || $this->uri->segment(2)== 'name'){ ?> class="side_active" <?php } ?> >
      <a title="<?php echo af_lg('lg_Choose_Your_Shop_Name','Choose Your Shop Name');?>" 
      <?php if($selectSellershop_details[0]['seourl'] !=''){?>
      href="appearance/<?php echo $selectSellershop_details[0]['seourl']; ?>/banner" 
      <?php }else{?>
      href="shop/name"
      <?php }?>
      class="<?php if($this->uri->segment(2)=='name'){ echo 'shop_active_tab';} ?> ">
      <div class="name-inner"><?php if($this->lang->line('shopsec_shopinfo') != '') { echo stripslashes($this->lang->line('shopsec_shopinfo')); } else echo 'Shop Info'; ?><span class="complete-indicator"></span></div>
      </a>
      </li>
        
        
      <li <?php if ($this->uri->segment(3) == 'sections'){ ?> class="side_active" <?php } ?>  >
		<?php if($selectSellershop_details[0]['seller_businessname'] != '') { ?>
			<a href="shops/<?php echo $selectSellershop_details[0]['seller_businessname'];?>/sections/All">
				<div class="name-inner"><?php if($this->lang->line('shopsec_shopsec') != '') { echo stripslashes($this->lang->line('shopsec_shopsec')); } else echo 'Shop Section'; ?><span class="complete-indicator"></span></div>
			</a>
		<?php } ?>	
	 </li>
	 
      <li <?php if ($this->uri->segment(2) == 'listitem'){ ?> class="side_active" <?php } ?>>
        <?php if($selectSellershop_details[0]['seller_businessname'] != '') { ?>
        	<a title="<?php echo af_lg('lg_What_going_to_sell_Add_edit_listings','What are you going to sell? Add and edit listings here.');?>" href="shop/listitem" class="<?php if($this->uri->segment(2)=='listitem'){ echo 'shop_active_tab';} ?> "> 
			<div class="name-inner"><?php if($this->lang->line('add_items') != '') { echo stripslashes($this->lang->line('add_items')); } else echo 'Add Items'; ?></div></a>
        <?php } else { ?>
        	<a class="shop_active" ><div class="name-inner"><?php if($this->lang->line('add_items') != '') { echo stripslashes($this->lang->line('add_items')); } else echo 'Add Items'; ?></div></a>
         <?php } ?>
      </li>
<?php echo count($shopProduc); ?>
		 <li <?php if ($this->uri->segment(2) == 'managelistings'){ ?> class="side_active" <?php } ?> >
		 
      <?php if($selectSellershop_details[0]['seourl'] !=''){?>
          <?php if(count($shopProduc)!= 0) { ?>
        	<a title="<?php echo af_lg('lg_Manage_listings','Manage your listings here.');?>" href="shop/managelistings" class="<?php if($this->uri->segment(2)=='managelistings' || $this->uri->segment(1)=='edit-product'){ echo 'shop_active_tab';} ?>"> 
				<div class="name-inner"><?php echo '管理產品'; ?></div>
			</a>
        <?php } else { ?>
        	<a class="shop_active"  >
				<div class="name-inner">管理產品</div>
			</a>
         <?php } ?>
	  <?php }else{ ?>
        	<a class="shop_active"  >
				<div class="name-inner">管理產品</div>
			</a>
	  <?php } ?>
        </li>
		<!--
      <li <?php if ($this->uri->segment(1) == 'shop' && ($this->uri->segment(2) == 'payment' || $this->uri->segment(2) == 'billing')){ ?> class="side_active" <?php } ?> ><a style="padding:0px !important;" href="javascript:void(0)"><div class="name-inner"><?php if($this->lang->line('payment_settings') != '') { echo stripslashes($this->lang->line('payment_settings')); } else echo 'Payment Settings'; ?><b class="caret" style="position: static;"></b></div></a>
	
		<ul class="add_shop_drop_down">
		   <li>
		        <?php if(count($shopProduc)!= 0) { ?>
		        <a title="<?php echo af_lg('lg_Choose_your_shop_payment','Choose your shop payment methods.');?>" href="shop/payment" class="<?php if($this->uri->segment(2)=='payment'){ echo 'shop_active_tab';} ?>  " ><div class="name-inner"><?php if($this->lang->line('comm_getpaid') != '') { echo stripslashes($this->lang->line('comm_getpaid')); } else echo 'Get Paid'; ?></div></a>
		        <?php } else{ ?>
		         <a class=""><div class="name-inner"><?php if($this->lang->line('comm_getpaid') != '') { echo stripslashes($this->lang->line('comm_getpaid')); } else echo 'Get Paid'; ?></div></a>
				 <?php } ?>
			</li>
			
			<?php if($loginCheck != 1){ ?>
			<li>
		        <?php if($selectSellershop_details[0]['payment_mode']!= '') { ?>
		        	<a title="<?php echo af_lg('lg_Enter_the_credit_card_to_pay','Enter the credit card you want to use to pay your bill.');?>" href="shop/billing" class="<?php if($this->uri->segment(2)=='billing'){ echo 'shop_active_tab';} ?> "> <div class="name-inner"><?php if($this->lang->line('comm_billing') != '') { echo stripslashes($this->lang->line('comm_billing')); } else echo 'Billing'; ?></div></a>
		        <?php } else { ?>
					<a class=""> <div class="name-inner"><?php if($this->lang->line('comm_billing') != '') { echo stripslashes($this->lang->line('comm_billing')); } else echo 'Billing'; ?></div></a>
		        <?php } ?>
		       
		     </li>
		     <?php }?>   
		        
		</ul>
   	</li>     
        -->
        
                
        <?php if($loginCheck != 1){ ?>
      	
        <?php if($curruserGroup=='Seller'){ ?>
        
        <!--<li <?php if ($this->uri->segment(3) == 'coupon-code'){ ?> class="side_active" <?php } ?>><a href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/coupon-code"><div class="name-inner"><?php if($this->lang->line('cart_couponcode') != '') { echo stripslashes($this->lang->line('cart_couponcode')); } else echo 'Coupon Codes'; ?> </div></a></li>-->
		
		<!--<li <?php if ($this->uri->segment(3) == 'tax-list'){ ?> class="side_active" <?php } ?>><a href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/tax-list"><div class="name-inner"><?php if($this->lang->line('shop_nav_shop_tax') != '') { echo stripslashes($this->lang->line('shop_nav_shop_tax')); } else echo 'Your Tax'; ?></div></a></li>-->
		
                <li <?php if ($this->uri->segment(3) == 'contact-user'){ ?> class="side_active" <?php } ?> ><a href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/contact-user"><div class="name-inner"><?php if($this->lang->line('shop_nav_user_contact') != '') { echo stripslashes($this->lang->line('shop_nav_user_contact')); } else echo 'User Contacts'; ?></div></a></li>
		
		<li <?php if ($this->uri->segment(3) == 'shop-orders'){ ?> class="side_active" <?php } ?>><a href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders"><div class="name-inner"><?php if($this->lang->line('shop_nav_shop_orders') != '') { echo stripslashes($this->lang->line('shop_nav_shop_orders')); } else echo 'Orders'; ?> <b class="caret" style="position: static;"></b> </div></a>
		
		<ul class="add_shop_drop_down">
			<?php $shop_id = $loginCheck;?>
			<?php //echo $loginCheck;?>
			
			<?php $this->load->model('order_model'); ?>
			
			<?php $processedorder = $this->order_model->view_shop_order_details('Paid',$shop_id,'Processed'); ?>
			   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=Processed" class="" ><div class="name-inner"><?php echo af_lg('lg_processed','Processed');?> (<?php echo $processedorder->num_rows();?>)</div></a></li>
			<?php $shippedorder = $this->order_model->view_shop_order_details('Paid',$shop_id,'Shipped'); ?>   
            <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=Shipped" class="" ><div class="name-inner"><?php echo af_lg('lg_shipped','Shipped');?>(<?php echo $shippedorder->num_rows();?>)</div></a></li>
			<?php $deliveredorder = $this->order_model->view_shop_order_details('Paid',$shop_id,'Delivered'); ?>
			   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=Delivered" class="" ><div class="name-inner"><?php echo af_lg('lg_delivered','Delivered');?> (<?php echo $deliveredorder->num_rows();?>)</div></a></li>
			<?php $cancelledorder = $this->order_model->view_shop_order_details('Paid',$shop_id,'Cancelled'); ?>
			   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=Cancelled" class="" ><div class="name-inner"><?php echo af_lg('lg_cancelled','Cancelled');?> (<?php echo $cancelledorder->num_rows();?>)</div></a></li>
			<?php $returnorder = $this->order_model->view_shop_order_details('Paid',$shop_id,'dispute'); ?>  
			   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=dispute" class="" ><div class="name-inner"><?php echo af_lg('lg_returnreplace','Return / Replace');?> (<?php echo $returnorder->num_rows();?>)</div></a></li>
			<?php $codorder = $this->order_model->view_shop_cod_details('COD',$shop_id); ?>   
			   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=cod" class="" ><div class="name-inner"><?php echo af_lg('lg_cod','Cash on Delivery');?> (<?php echo $codorder->num_rows();?>)</div></a></li>
			   <?php $wiretransferorder = $this->order_model->view_shop_cod_details('wire_transfer',$shop_id); ?>   
			   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=wiretransfer" class="" ><div class="name-inner"><?php echo af_lg('lg_wiretransfer','Wire Transfer');?>(<?php echo $wiretransferorder->num_rows();?>)</div></a></li>
			    <?php $westernunionorder = $this->order_model->view_shop_cod_details('western_union',$shop_id); ?>   
			   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=westernunion" class="" ><div class="name-inner"><?php echo af_lg('lg_westernunion','Western Union');?>(<?php echo $westernunionorder->num_rows();?>)</div></a></li>
		</ul>
		
		</li>
		
		<li><a style="padding:0px !important;" href="javascript:void(0)"><div class="name-inner"><?php if($this->lang->line('com_more') != '') { echo stripslashes($this->lang->line('com_more')); } else echo 'More'; ?><b class="caret" style="position: static;"></b></div></a>
		
			<ul class="add_shop_drop_down">
					<li><a href="promote-shop"><?php if($this->lang->line('shop_mainimg') != '') { echo stripslashes($this->lang->line('shop_mainimg')); } else echo 'Your Main Image'; ?></a></li>
					
					<li><a href="shop/reviews"><?php if($this->lang->line('shopsec_reviews') != '') { echo stripslashes($this->lang->line('shopsec_reviews')); } else echo 'Reviews'; ?></a></li>
					
					<li><a href="shops/<?php echo $selectSeller_details[0]['seourl']; ?>/shop-transaction"><?php if($this->lang->line('shop_nav_shop_trans') != '') { echo stripslashes($this->lang->line('shop_nav_shop_trans')); } else echo 'Transaction'; ?></a></li>
					
					<!--<li><a href="shops/<?php echo $selectSeller_details[0]['seourl']; ?>/shop-orders"><?php if($this->lang->line('shop_nav_shop_orders') != '') { echo stripslashes($this->lang->line('shop_nav_shop_orders')); } else echo 'Orders'; ?></a></li>-->
					
					<li><a href="shops/<?php echo $selectSeller_details[0]['seourl']; ?>/commision-tracking"><?php if($this->lang->line('shop_nav_earn_list') != '') { echo stripslashes($this->lang->line('shop_nav_earn_list')); } else echo 'Earnings List'; ?></a></li>
					
					<li><a href="shops/<?php echo $selectSeller_details[0]['seourl']; ?>/withdraw-req"><?php if($this->lang->line('shop_nav_with_request') != '') { echo stripslashes($this->lang->line('shop_nav_with_request')); } else echo 'Withdrawal Request'; ?>
					</a></li>
					
					
					<?php if(count($selectSeller_details) == 1){ ?>
					
						<?php if($this->config->item('zendesk_status') == 'Active'){?>
						<li>
							<a href="zendesk-tickets"><?php if($this->lang->line('zendesk_support') != '') { echo stripslashes($this->lang->line('zendesk_support')); } else echo 'Zendesk Support'; ?></a>
						</li>
						<?php } ?>
						 <?php if($this->config->item('fresh_desk')=='Active'){ ?>
						<li>
							<a href="freshdesk-tickets">
							<?php if($this->lang->line('shop_nav_seller_support') != '') { echo stripslashes($this->lang->line('shop_nav_seller_support')); } else echo 'Freshdesk Support'; ?></a>
						</li>
						<?php } ?>
					
					<?php } ?>
					
					<li>
						<a href="import-items">
							<?php if($this->lang->line('shop_nav_seller_import') != '') { echo stripslashes($this->lang->line('shop_nav_seller_import')); } else echo 'Import Listings'; ?>
						</a>
					</li>
						
			</ul>

		
		</li>
		<?php }?>
     
    <?php /*?>  <li  class="preview "><a class="" title="Preview your shop page." href="shop/sell" >
        <div class="name-inner" ><?php if($this->lang->line('comm_preview') != '') { echo stripslashes($this->lang->line('comm_preview')); } else echo 'Preview'; ?></div>
        </a></li>
        <?php */}else{ /*?>
        <li  class="step_4">
        	<a title="Preview your shop page." href="shop/sell" class="" <?php if($this->uri->segment(2)=='sell'){ echo 'style="background-position:-540px -88px !important"';} ?>>
        <div class="name-inner"><?php if($this->lang->line('comm_preview') != '') { echo stripslashes($this->lang->line('comm_preview')); } else echo 'Preview'; ?></div>
        </a></li>
        <?php */} ?>
      
    </ul>
  </nav>
        <nav id="nav-mobile"></nav>
  </div>
</div>
<?php } ?>
<script>
function hideErrDiv(arg) {
    document.getElementById(arg).style.display = 'none';
}
</script> 
<script src="js/site/main.js" type="text/javascript"></script>
<div style='display:none'>
  <div id='inline' style='background:#F5F5F1; border-radius:5px'> 
  <div style="padding: 20px 30px; border-radius:5px 5px 0 0" class="global-header"><h2 style="color: #555555;"><?php if($this->lang->line('comm_welcome') != '') { echo stripslashes($this->lang->line('comm_welcome')); } else echo 'Welcome to our Global Community of Sellers!'; ?></h2></div>
   <div style="background:#fff; border-radius:0 0 5px 5px" class="global-section glob-sugession">
   <p><?php if($this->lang->line('comm_shopsybuyers') != '') { echo stripslashes($this->lang->line('comm_shopsybuyers')); } else echo 'Reach shopsy Buyers, I already sell full time'; ?></p>
   <p><?php if($this->lang->line('comm_quitmyday') != '') { echo stripslashes($this->lang->line('comm_quitmyday')); } else echo 'Quit my day job to sell full time'; ?></p>
    <p><?php if($this->lang->line('comm_sparetime') != '') { echo stripslashes($this->lang->line('comm_sparetime')); } else echo 'Sell in my spare time'; ?></p>
     <p><?php if($this->lang->line('comm_other') != '') { echo stripslashes($this->lang->line('comm_other')); } else echo 'other'; ?></p><input type="text" placeholder="<?php if($this->lang->line('comm_other') != '') { echo stripslashes($this->lang->line('comm_other')); } else echo 'other'; ?>"></div>
    
    
  </div>
</div>


<?php

	#echo $this->session->userdata['shopsy_session_user_confirm'];die;
	if($this->session->userdata['shopsy_session_user_confirm'] == 'No') { 
	  			  $this->load->view('site/templates/mail_confirmation');
    }

?>


<style>

#{
	position:absolute;
	border:1px solid #333;
	background:#333333;
	padding:2px 5px;
	color:#FFFFFF;
	display:none;
    
    top:40px;
	border-radius: 3px;
	width:200px;
	float:left;
	padding: 3px 6px;
	
	font-size: 13px;
	z-index:9999;
    font-weight: normal;
}




</style>
