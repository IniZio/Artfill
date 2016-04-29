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
						<h1>required info from the mobile app</h1>
						<form method="post" action="<?php echo base_url(); ?>mobile/shipping-address">
						<ul>
							<li><input type="text" class="input-scroll" placeholder="UserId" name="userId"></input></li>
							<li><input type="text" class="input-scroll" placeholder="SellerId" name="sellerId"></input></li>
							<input type="hidden" class="input-scroll" placeholder="mobileId" name="mobileId" value ="2"></input>
							<li>
								<select name="payment_value">
									<option value="">Select Payment</option>
									<option value="Paypal">Paypal</option>
									<option value="Credit-Card">Credit Card</option>
									<option value="Stripe">Stripe</option>
									<option value="twocheckout">Twocheckout</option>
									<option value="pesapal">Pesapal</option>
									<option value="BrainTree">BrainTree</option>
								</select>
							</li>
							<li class="last"><input type="submit" class="input-submit-btn" value="Continue" ></input></li>
						</ul>
						</form>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>
