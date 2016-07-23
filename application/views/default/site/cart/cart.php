<?php $this->load->view('site/templates/header.php');	?>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Cart-page.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Empty-Cart-page.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>footer.css" rel="stylesheet">
<?php }?>
<?php //ARTFILL ?>
<script>
	var changeGateway = function(selID, cartRate, cartStatic ,cartAmt){
		rate = '#' + 'gatewayRate_' + selID;
		amt = '#' + 'gatewayAmt_' + selID;
		static = '#' + 'gatewayStatic_' + selID;
		$(rate).html(cartRate.toFixed(0));
		$(static).html(cartStatic.toFixed(2));
		$(amt).html((cartAmt * cartRate * 0.01 + cartStatic).toFixed(2));
	}
</script>
<script type="text/javascript" src="js/site/timepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/site/timepicker/jquery.timepicker.js"></script>
<link rel="stylesheet" media="screen" type="text/css" href="css/default/site/timepicker/bootstrap-datepicker.css" />
<link rel="stylesheet" media="screen" type="text/css" href="css/default/site/timepicker/jquery.timepicker.css"/>

<div id="cart_div">
	<section class="container">
		<div class="s-cart">
			<!-- Cart Content Starts-->
				<?php echo $cartViewResults; ?>
				<!-- Cart Content Ends-->
				<!-- Related Itrem Starts-->
			<?php if(!empty($relatedPurchases)){ ?>
				<h1><?php echo af_lg('cart_like', '你可能對此感興趣... ');?> </h1>
				<ul class="suggestion-list">					 
							<?php $count=0; foreach($relatedPurchases as $relatedItems){ $count++; ?>
										<?php if(!empty($relatedItems->product_name)){ ?>
											<li class="suggestion col-md-4">																					
												<div class="listing-details"> 												
													<?php $imgA=@explode(',',$relatedItems->image); ?>
													<a href="<?php echo base_url().'products/'.$relatedItems->seourl; ?>">
														<img alt="<?php echo $imgA[0];?>" src="<?php echo PRODUCTPATHTHUMB.$imgA[0];?>">
													</a>
													<div class="listing-text">												
														<div class="title">
															<a href="<?php echo base_url().'products/'.$relatedItems->seourl; ?>">
																<?php echo character_limiter($relatedItems->product_name,20); ?>
															</a>
														</div>
														<div class="shop-name">By 
															<a href="<?php echo base_url().'shop-section/'.$relatedItems->seller_businessname; ?>"><?php echo character_limiter($relatedItems->seller_businessname,20); ?></a>
														</div>
													</div>
												</div>
												<div class="cart-tools">
													<div class="price"> 
														<?php echo $currencySymbol; ?>
															<?php  if($relatedItems->price != 0.00) { 
																			echo round($currencyValue*$relatedItems->price,2); 
																		} else { 
																			echo round($currencyValue*$relatedItems->pricing,2); echo '+'; 
																		}?> 
														<?php echo $currencyType;?> 
													</div>
													<a class="btn-transaction order-submit cart-btn" href="<?php echo base_url().'products/'.$relatedItems->seourl; ?>"> <?php echo af_lg('cart_detail', 'Detail'); ?> </a>
												</div>
											</li>
										<?php } ?>
							<?php if($count==6)break; } ?> 
						
				</ul>
			<?php } ?>
			<!-- Related Item Ends-->
		</div>
	</section>
</div>
<style>
.error_message {
    background-color: #fedfdf;
	color: #333;
}
</style>
<a href="#contact_shop_owner_pop" id="contact_shop_owner_link" data-toggle="modal"></a>

	<div id='contact_shop_owner_pop' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="contact_shopowner_content">
			
			
			</div>
		</div>
	</div>
	<script>


$(function($) {
							
						var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
				$('.date').datepicker({				
                    'format': 'm/d/yyyy',
                    'autoclose': true,
					 minDate: 0,
						 startDate: today 
					
                });

				
                $('.time').timepicker({
                    'showDuration': false,
                    'timeFormat': 'g:ia',
                    'minTime': '10:00am',
                    'maxTime': '6:00pm',
					 'forceRoundTime': true,
					 'disableTimeRanges':  [['<?php echo $GetAllExtrasCharge[0]->time_frame_from; ?>', '<?php echo $GetAllExtrasCharge[0]->time_frame_to; ?>']]

                });	

  });

// 				$("#pickup_date").change(function(){
// 					var nowDate = new Date();
// var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
// var minTime = '10:00am';
//       				if (document.getElementById('pickup_date').value <= today) minTime = nowDate;
//       				$('.time').timepicker('option', 'minTime', minTime);	
// 				});
function localPickup(evt,sid){
	var ischeckedvalue = $(evt).prop('checked');
	if(ischeckedvalue == true){
		var value = 'Yes';
		$(evt).parent().parent().find('.default_addr').css('display','none');
		$(evt).parent().parent().find('.ship_to').css('display','none');
		$(evt).parent().parent().find('.add_addr').css('display','none');
	}else{
		var value = 'No';
		$(evt).parent().parent().find('.default_addr').css('display','block');
		$(evt).parent().parent().find('.ship_to').css('display','block');
		$(evt).parent().parent().find('.add_addr').css('display','block');
	}
	
	var url = '<?php echo base_url()?>site/cart/localpickup';
	$.post(url,{'value':value,'seller_id':sid},function(json){
		if(json.success =='success'){
			// window.location.reload();
		}else{
			console.log('error Location collection');
		}
	},"json");
	// return false;
}
</script>


<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<?php $this->load->view('site/templates/footer'); ?>