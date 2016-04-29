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
						<h1>Enter a New Address<a class="close_btn" href="<?php echo base_url(); ?>mobile/shipping-address?mobileId=<?php echo $mobileId; ?>"></a></h1>
						<div class="txt-error"><?php echo validation_errors(); ?></div>
						<form method="POST" action="<?php echo base_url(); ?>mobile/add-cart-shipping-address">
						<ul>
							<li>							
								<select class="input-scroll" name="country" id="country">				
									<option value="">Select Country</option>
									<?php foreach($countryList->result() as $c_name){?>
									<option value="<?php echo $c_name->name; ?>" <?php if(set_value('country')==$c_name->name){ ?>selected="selected"<?php } ?>>
										<?php echo $c_name->name; ?>
									</option>
									<?php }?>
								</select>
							</li>
							<li><input type="text" class="input-scroll" placeholder="Full Name" id="name" name="full_name" value="<?php echo set_value('full_name'); ?>"></input></li>
							<li><input type="text" class="input-scroll" placeholder="Street" id="street" name="address1" value="<?php echo set_value('address1'); ?>"></input></li>
							<li><input type="text" class="input-scroll" placeholder="Apt/Suite/Other" id="aso" name="address2" value="<?php echo set_value('address2'); ?>"></input></li>
							<li><input type="text" class="input-scroll" placeholder="City" id="city" name="city" value="<?php echo set_value('city'); ?>"></input></li>
							<li><input type="text" class="input-scroll" placeholder="State/Province/Region" id="state" name="state" value="<?php echo set_value('state'); ?>"></input></li>
							<li><input type="text" class="input-scroll" placeholder="Zip/Postal Code"  id="postal" name="postal_code" value="<?php echo set_value('postal_code'); ?>"></input></li>
							<li><input type="text" class="input-scroll" placeholder="Phone Number"  id="phone" name="phone" value="<?php echo set_value('phone'); ?>"></input></li>
							<input type="hidden" class="input-scroll" id="mobileId" name="mobileId" value="<?php echo $mobileId; ?>"></input>
							<li class="last"><input type="submit" class="input-submit-btn" value="Save" onClick="return validateaddress();" ></input></li>
						</ul>
						</form>
					</div>
				</div>
			</div>
		</section>
		<script type="text/javascript">
		function validateaddress(){
			var country=document.getElementById("country").value.trim();
			var name=document.getElementById("name").value.trim();
			var street=document.getElementById("street").value.trim();
			var city=document.getElementById("city").value.trim();
			var state=document.getElementById("state").value.trim();
			var postal=document.getElementById("postal").value.trim();
			var phone=document.getElementById("phone").value.trim();
			
			document.getElementById("country").classList.remove("txt-error");
			document.getElementById("name").classList.remove("txt-error");
			document.getElementById("street").classList.remove("txt-error");
			document.getElementById("city").classList.remove("txt-error");
			document.getElementById("state").classList.remove("txt-error");
			document.getElementById("postal").classList.remove("txt-error");
			document.getElementById("phone").classList.remove("txt-error");
			
			var status=0;
			if(country==""){
				document.getElementById("country").classList.add("txt-error");
				status++;
			}
			if(name==""){
				document.getElementById("name").classList.add("txt-error");
				status++;
			}
			if(street==""){
				document.getElementById("street").classList.add("txt-error");
				status++;
			}
			if(city==""){
				document.getElementById("city").classList.add("txt-error");
				status++;
			}
			if(state==""){
				document.getElementById("state").classList.add("txt-error");
				status++;
			}
			if(postal==""){
				document.getElementById("postal").classList.add("txt-error");
				status++;
			}
			if(phone==""){
				document.getElementById("phone").classList.add("txt-error");
				status++;
			}
			if(status!=0){
				return false;
			} 
		}
		</script>
	</body>
</html>
