<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $this->config->item('email_title'); ?> - <?php echo $pageDetails->row()->meta_title; ?></title>
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/default/mobile/app-style.css" type="text/css" media="all" />
	</head>
	<body>
		<section>
			<div class="shipping_address">
					<div class="main">		
						<div class="app-content-box">
						<h1><?php echo $pageDetails->row()->page_title; ?></h1>
						<div class="payment-success">
						<?php 
						if ($pageDetails->num_rows()>0){
							echo $pageDetails->row()->description;
						}
						?>				
						</div>
					</div>			
					</div>	
			</div>
		</section>
	</body>
</html>
