<?php 
$this->load->view('site/templates/header.php');
define("paypaldetail",$this->config->item('payment_0'));
$paypaldet=unserialize(paypaldetail); 			
$paypalVals=unserialize($paypaldet['settings']);
define("Authorize",$this->config->item('payment_1'));
$Authorizedet=unserialize(Authorize); 			
$AuthorizeVals=unserialize($Authorizedet['settings']);
define("Stripe",$this->config->item('payment_3'));
$Stripedet=unserialize(Stripe); 			
$StripeVals=unserialize($Stripedet['settings']);
define("Checkout",$this->config->item('payment_4'));
$Checkoutdet=unserialize(Checkout); 			
$CheckoutVals=unserialize($Checkoutdet['settings']);
define("Braintree",$this->config->item('payment_0'));
$Braintreedet=unserialize(Braintree); 			
$BraintreedetVals=unserialize($Braintreedet['settings']);
define("Pesapal",$this->config->item('payment_0'));
$Pesapaldet=unserialize(Pesapal); 			
$PesapalVals=unserialize($Pesapaldet['settings']);
?>



<link href="css/default/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" media="screen">

<section>
  <div class="main">
		<div class="container" style="margin:0">      
			  <div class="cart_items">
						<div class="conversation_container">
							<h2 class="conversation_headline" style="color: #9E612F;"><?php echo shopsy_lg('lg_pick your package','Pick your package.');?></h2>
							<form action="site/cart/proceed2pay"   method="post" id="pay_pack">
								<div class="table-new-1">
								<table class="table-new-2" style="margin-top:44px;">
									<thead style="color: darkgoldenrod;">
									<tr>
										
										<td width="50px"><?php echo shopsy_lg('lg_name','Name');?></td>
										<td width="50px"><?php echo shopsy_lg('lg_days','Days');?></td>
										<td width="50px"><?Php echo shopsy_lg('lg_amount','Amount');?></td>
									</tr>
									</thead>
									<tbody>
									<?php
										$pages=array();
								
										if( count($product_feature) > 0) {
											$pages= array_column($product_feature,'page');
										}
										foreach($feature_list as $fl){
									?>
											<tr>
												<td width="50px"><input type="radio" name="pack_id" id="pack_id" value="<?php echo $fl->id;?>">
												<?php echo $fl->name;?></td>
												<td width="50px"><?php echo $fl->days;?></td>
												<td width="50px"><?php echo number_format($fl->amount * $currencyValue,2);?></td>
											</tr>
									<?php
										}
									?>
										
									</tbody>									
								</table><br>
									<table style="margin-left: 235px;"><tr>
											<td><b><?php echo shopsy_lg('lg_startdate','start date');?></b></td>
											<td><input name="eventDate" id="eventDate" type="text" tabindex="6" class="required small tipTop" title="Please select the date" value=""/></td>
										</tr></table>
									<br><table style="margin-left: 235px;"><tr><td><b><?php echo shopsy_lg('lg_page','page');?></b></td><?php if(!(in_array('home',$pages))){?><td width="306px"> <input type="radio" class="required small tipTop" title="Please select the Page"  name="Page" id="Page" value="home"><?php echo shopsy_lg('lg_homepage','Home page');?></td><?php } ?></tr>
										 <tr><td></td><?php if(!(in_array('search',$pages))){?><td><input type="radio" class="required small tipTop" title="Please select the Page"  name="Page" id="Page" value="search"><?php echo shopsy_lg('lg_searchpage','Search page');?></td><?php } ?></tr>
										  <tr><td></td><?php if(!(in_array('product detail',$pages))){?><td><input type="radio" class="required small tipTop" title="Please select the Page"  name="Page" id="Page" value="product detail"><?php echo shopsy_lg('lg_product_detailpage','Product Detail page');?></td><?php } ?></tr></table>
									
									<div class="pay-package" style="margin-top:-237px" >
									<ul>
										<?php $paypalVals['status'] == "Enable"?>
											<li><input type="radio" name="gateway" id="gateway" value="paypal"><?php echo shopsy_lg('lg_paypal','Paypal');?></li>
										<?php $AuthorizeVals['status'] == "Enable"?>
											<li><input type="radio" name="gateway" id="gateway" value="Authorize"><?php echo shopsy_lg('lg_creditcard','Credit Card');?></li>
										<?php $StripeVals['status'] == "Enable"?>
											<li><input type="radio" name="gateway" id="gateway" value="stripe"><?php echo shopsy_lg('lg_stripe','Stripe');?></li>
										<?php $CheckoutVals['status'] == "Enable"?>
											<li><input type="radio" name="gateway" id="gateway" value="checkout"><?php echo shopsy_lg('lg_2checkout','2Checkout');?></li>
										<?php $BraintreedetVals['status'] == "Enable"?>
											<li><input type="radio" name="gateway" id="gateway" value="braintree"><?php echo shopsy_lg('lg_braintree','Braintree');?></li>
										<?php $PesapalVals['status'] == "Enable"?>
											<li><input type="radio" name="gateway" id="gateway" value="pesapal"><?php echo shopsy_lg('lg_pesapal','Pesapal');?></li>
									</ul>
								</div>
								</div>
								
								<input type="hidden" id="product_seourl" name="product_seourl" value="<?php echo $p_seo; ?>">							
								
								<div class="modal-footer footer_tab_footer">
										<div class="btn-group">
												<input type="submit" class="btn btn-default submit_btn" onclick="return validationform();" id="submit_pay" value="<?php echo shopsy_lg('lg_makepay','Make Pay');?>">
												<input type="submit" class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel" value="<?php echo shopsy_lg('lg_cancel','Cancel');?>">
										</div>
								</div>	
								
							</form>
						</div>
					
			  </div>
		</div>
  </div>
 </section>
 
<a href="#feature_list" id="btn_popup" data-toggle="modal"></a>
<div id='feature_list' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				 <div style='background:#fff;'>  
					<div class="conversation" style="width: 340px; margin-left: 191px; margin-top: 171px;">
						<div class="conversation_container">
							<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;"> <?php echo shopsy_lg('lg_pls select payment method&package','Please select Payment method and Package');?> </h2>													
							
								<div class="modal-footer footer_tab_footer">
										<div class="btn-group">												
												<input type="submit" class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel" value="<?php echo shopsy_lg('lg_ok','Okay');?>">
										</div>
								</div>	
							
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>	
<script>
	function validationform(){
		var packid = $("input[name='pack_id']").is(":checked");
		var payment = $("input[name='gateway']:checked").val();
		//alert(packid);return false;
		//alert(document.getElementById("gateway").checked);
		if($("input[name='pack_id']").is(":checked") && $("input[name='gateway']").is(":checked")){
			return true;			
		}
		else{
			$('#btn_popup').trigger('click');
			return false;
		}
	}
</script>
 <script src="js/datepicker.js"></script>

<script>
var j= jQuery.noConflict();
  j(function() {
    j( "#eventDate" ).datepicker();

 });
  </script>
  <script type="text/javascript">
$(document).ready(function(){
	$('#dateRangePicker').datepicker({
		todayBtn: "linked",
		clearBtn: true,
		autoclose: true,
		todayHighlight: true, 
		format: 'dd/mm/yyyy',
		beforeShow: function (input, inst) {
			setTimeout(function () {
            inst.dpDiv.css({
					top: 100,
					left: 200
				});
			}, 0);
		}
	});

});
</script>
<style>
.datepicker{z-index:9999 !important;}
</style>
<?php $this->load->view('site/templates/footer'); ?>