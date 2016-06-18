<?php
$this->load->view('site/templates/commonheader');
$this->load->view('site/templates/shop_header',$this->data);
?>
<div class="clear"></div>
<section class="container">
	<div class="main">
		<div class="shop_details">         
			<div class="payment_div"></div>	
				<div class="list_div" style="border-radius:5px 5px 0 0; margin:5px 0 0">
					<div class="payment_check">
						<div class="import-list">
							<ul>
								<li class="col-md-3">
									<a href="etsy-import">										
										<h4>
											<img src="images/etsylogo.png" alt="From Etsy" title="From Etsy" />
											<div>From Etsy</div>
										</h4>
									</a>
								</li>
							</ul>
						</div>
					</div>	   
				</div> 
			</form>
		</div>
	</div>
</section>
<?php 
$this->load->view('site/templates/footer',$this->data);
?>