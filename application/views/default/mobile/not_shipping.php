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
			<div class="app-content">
				<div class="main">
					<div class="app-content-box">
						<h1>Some of your items does not shipped into your address.</h1>
					</div>
				</div>
			</div>			
			<div class="shipping_address">
					<div class="main">
						<?php if($shippingAddress->num_rows()>0){ ?>
						<?php foreach($shippingAddress->result() as $address){ ?>
							<div class="checkout-address">
								<ul>
									<li> <strong> <?php echo $address->full_name; ?> </strong></li>
									<li><?php echo $address->address1; ?> </li>
									<li><?php echo $address->city; ?> </li>
									<li><?php echo $address->state; ?></li>
									<li><?php echo $address->country; ?></li>
									<li><?php echo $address->postal_code; ?></li>
								</ul>
							</div>
						<?php } ?>
						<?php } ?>						
					</div>	
			</div>
			<div class="app-content">
				<div class="main">
					<div class="app-content-box">
						<h1><a href="<?php echo base_url(); ?>mobile/shipping-address" class="change-address" > Change my shipping address</a></h1>
					</div>
				</div>
			</div>			
			<?php $this->output->set_header('refresh:2;url='.base_url().'mobile/payment/shipping-address'); ?>
		</section>
	</body>
</html>
