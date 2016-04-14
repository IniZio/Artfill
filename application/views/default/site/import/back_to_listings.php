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
							<h4>
								Please wait this page will be redirect within 10 seconds. or click
								<a href="<?php echo base_url().'shop/managelistings'; ?>">here</a>.
							</h4>
							<?php $this->output->set_header('refresh:10;url='.base_url().'shop/managelistings'); 	 ?>
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