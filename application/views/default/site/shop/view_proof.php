<?php 
$this->load->view('site/templates/shop_header'); 
?>
<section class="container">
	<div class="main">
		<div class="shop_details"> 
		<?php if($proof->num_rows() >0){?>
			<label>Message:</label>
			<p><?php echo $proof->row()->comment;?></p>
			<label>Proof:</label>
			<img src="images/paymentproof/<?php echo $proof->row()->proof;?>"/>
		<?php } ?>
		</div>
	</div>
</section>
<?php $this->load->view('site/templates/footer'); ?>