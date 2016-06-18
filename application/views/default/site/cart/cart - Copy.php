<?php $this->load->view('site/templates/header.php');	?>
	<section class="container">
		<div class="s-cart">
			<!-- Cart Content Starts-->
				<?php echo $cartViewResults; ?>
				<!-- Cart Content Ends-->
				<!-- Related Itrem Starts-->
			<?php if(!empty($relatedPurchases)){ ?>
				<h1><?php if($this->lang->line('cart_like') != '') { echo stripslashes($this->lang->line('cart_like')); } else echo 'You might also like… ';?> </h1>
	
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
															<a href="<?php echo base_url().'shop-section/'.$relatedItems->shop_seourl; ?>"><?php echo character_limiter($relatedItems->shop_name,20); ?></a>
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
													<a class="btn-transaction order-submit cart-btn" href="<?php echo base_url().'products/'.$relatedItems->seourl; ?>"> <?php if($this->lang->line('cart_detail') != '') { echo stripslashes($this->lang->line('cart_detail')); } else echo 'Detail'; ?> </a>
												</div>
											</li>
										<?php } ?>
							<?php if($count==6)break; } ?> 
						
				</ul>
			<?php } ?>
			<!-- Related Itrem Ends-->
		</div>
	</section>
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



<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<?php $this->load->view('site/templates/footer'); ?>