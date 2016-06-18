<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $this->config->item('email_title'); ?></title>
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/default/mobile/app-style.css" type="text/css" media="all" />
	</head>
	<body>
		<section>
			<div class="app-shipping">
				<div class="main">
					<ul class="app-shipping-level level-1">		
						<li class="active">Shipping</li>
						<li>Payment</li>
						<li>Review</li>
					</ul>
				</div>
			</div>
			<div class="shipping_contact">
					<div class="main">
						<div class="contact-icon">
							<a>
								<?php
								if($sellerInfo->row()->sellerImg!=""){
									$sellerImage='images/users/thumb/'.$sellerInfo->row()->sellerImg;
								}else{
									$sellerImage='images/users/thumb/profile_pic.png';
								}
								?>
								<img src="<?php echo base_url().$sellerImage; ?>" alt="<?php echo base_url().$sellerImage; ?>" title="<?php echo $sellerInfo->row()->shopName; ?>" />
							</a>
						</div>
						<div class="contact-text"> 
						<span>Order From</span> 
						<strong><?php echo $sellerInfo->row()->shopName; ?></strong> 
						</div>
					</div>	
			</div>
			<div class="shipping_contact">
					<div class="main">
						<h2>Product List</h2>
						<?php foreach($productList->result() as $product){ ?>
						<div class="contact-icon">
							<a>
								<?php
									$img=@explode(',',$product->image);
									$prdImage='images/product/mb/'.$img[0];
								?>
								<img src="<?php echo base_url().$prdImage; ?>" alt="<?php echo base_url().$prdImage; ?>" title="<?php echo $sellerInfo->row()->shopName; ?>" />
							</a>
						</div>
						<div class="contact-text"> 
							<span><?php echo $product->product_name; ?></span> 
							<strong>Qty: <?php echo $product->quantity; ?></strong> 
						</div>
						<?php } ?>
					</div>	
			</div>
			<div class="shipping_address">
					<div class="main">
						<?php if($shippingAddress->num_rows()>0){ ?>
						<h2>Choose a Shipping Address</h2>
						<?php foreach($shippingAddress->result() as $address){ ?>
						<?php 
						if($shippingready[$address->country]==0){
							$href="href=".base_url()."mobile/change-shipping-address/".$address->id.'?mobileId='.$mobileId;
							$cls="";
							$msg="";
						}else{		
							$href="";
							$cls="disable";
							$msg="Some of your items does not shipped into this address.";
						}
						?>
						<a  <?php echo $href; ?> class="shipping-addr <?php echo $cls; ?>">
							<div class="checkout-address">
								<ul>
									<li> <strong> <?php echo $address->full_name; ?> </strong></li>
									<li><?php echo $address->address1; ?> </li>
									<li><?php echo $address->city; ?> </li>
									<li><?php echo $address->state; ?></li>
									<li><?php echo $address->country; ?></li>
									<li><?php echo $address->postal_code; ?></li>
								</ul>
								<lable class="shipping-error"><?php echo $msg ?></lable>
							</div>
						</a>
						<?php } ?>
						<?php } ?>
						<div class="checkout-address-added"> 
							<a href="<?php echo base_url().'mobile/add-shipping-address?mobileId='.$mobileId; ?>">
								<img src="<?php echo base_url(); ?>css/default/mobile/images/added.png" alt="Added" title="Added" />
							</a> 
						</div>
					</div>	
			</div>
		</section>
	</body>
</html>
