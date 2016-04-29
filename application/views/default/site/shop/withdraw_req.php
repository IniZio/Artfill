<?php 
$this->load->view('site/templates/shop_header'); 
/* echo $currencyValue."<br>";
echo $orderDetails[0]->TotalAmt."<br>";
echo $orderDetails1[0]->TotalAmt."<br>";
echo $disputeDetail[0]->TotalAmt."<br>";
echo $claim_amt[0]->TotalAmt."<br>";
echo $user_details->row()->refund_amount;die; */
$total_earnings =$currencyValue*($orderDetails[0]->TotalAmt-($orderDetails1[0]->TotalAmt-$disputeDetail[0]->TotalAmt)-$claim_amt[0]->TotalAmt-$user_details->row()->refund_amount); 
#echo $total_earnings;die;
?>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<?php } ?>
<div class="clear"></div>
<div id="shop_page_seller">
<section class="container">

    <div class="main">    	
		<div class="shop_details">
				<div class="shop_name_save community_right" style="width:100%; padding: 30px 10px; margin-bottom: 0;">
					<table class="table_req">
						<thead>
							<tr>
								<th colspan="3" class="heading_account"> <?php if($this->lang->line('shop_withdraw_order') != '') { echo stripslashes($this->lang->line('shop_withdraw_order')); } else echo 'Orders'; ?> </th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><b><?php if($this->lang->line('shop_withdraw_tot_order') != '') { echo stripslashes($this->lang->line('shop_withdraw_tot_order')); } else echo 'Total Orders'; ?></b></td><td>:</td>
								<td><?php echo $orderDetails[0]->orders; ?></td>
							</tr>
							<tr>
								<td><b><?php if($this->lang->line('shop_withdraw_tot_earnings') != '') { echo stripslashes($this->lang->line('shop_withdraw_tot_earnings')); } else echo 'Total Earnings'; ?></b></td><td>:</td>
								<td><?php echo $currencySymbol;?> <?php echo number_format($total_earnings,2);?> </td>
							</tr>
							<tr>
								<td><b><?php if($this->lang->line('shop_withdraw_earnings') != '') { echo stripslashes($this->lang->line('shop_withdraw_earnings')); } else echo 'Withdrawal Earnings'; ?></b></td><td>:</td>
								<td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$paidDetails[0]->totalPaid,2);?></td>
							</tr>
							<tr>
								<td><b><?php if($this->lang->line('shop_withdraw_bal_earnings') != '') { echo stripslashes($this->lang->line('shop_withdraw_bal_earnings')); } else echo 'Balance Earnings'; ?></b></td><td>:</td>
								<td><?php echo $currencySymbol;?> 
								<?php 
										$balance_amt= $total_earnings- $currencyValue* $paidDetails[0]->totalPaid; 									
									?>
									<?php echo  number_format($balance_amt,2);?>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="table_req" style="display:none;">
						<thead>
							<tr>
								<th colspan="3" class="heading_account"> <?php if($this->lang->line('shop_withdraw_cod') != '') { echo stripslashes($this->lang->line('shop_withdraw_cod')); } else echo 'Cash On Delivery'; ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><b><?php if($this->lang->line('shop_withdraw_tot_order') != '') { echo stripslashes($this->lang->line('shop_withdraw_tot_order')); } else echo 'Total Orders'; ?></b></td><td>:</td>
								<td><?php echo $codorder[0]->orders; ?></td>
							</tr>
							<tr>
								<td><b><?php if($this->lang->line('shop_withdraw_tot_earnings') != '') { echo stripslashes($this->lang->line('shop_withdraw_tot_earnings')); } else echo 'Total Earnings'; ?></b></td><td>:</td>
								<td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$codorder[0]->TotalAmt,2);?> </td>
							</tr>
						</tbody>
					</table>
                </div>
				<?php if($balance_amt>0){ ?>
				<form action="site/shop/send_withdraw" method="post">
					<div class="shop_name_save community_right">
					<label><?php if($this->lang->line('lg_shop_withdraw_enter_amount') != '') { echo stripslashes($this->lang->line('lg_shop_withdraw_enter_amount')); } else echo 'Enter the withdraw amount to request'; ?> </label>
					
					<input type="text" name="withdraw_amt" id="withdraw_amt" class="checkout_txt" style="width:100px; height:27px"/>
					<input type="hidden" id="balance_amt" name="balance_amt" value="<?php echo $balance_amt; ?>">
					</div>
					<input id="save-btn" class="save_btn" type="submit" value="<?php if($this->lang->line('lg_shop_withdraw_send_req') != '') { echo stripslashes($this->lang->line('lg_shop_withdraw_send_req')); } else echo 'Send Request'; ?>" onclick="return withdrawVal();">
				</form>
				<?php } ?>
		</div>
    </div>
</section>
</div>
<style type="text/css">
.table_req{
	width:400px !imporatant;
	float:left;
	padding:0px 100px 0px 100px;
}
.table_req td{
	padding:0px 15px;
}
</style>
<script type="text/javascript">
function withdrawVal(){
	var regExp ="^\\d+(\\.\\d+)?$";
	var withdraw_amt=$("#withdraw_amt").val().trim();
	if(withdraw_amt=="" || withdraw_amt==null || isNaN(withdraw_amt) ||  withdraw_amt<=0){
		$("#withdraw_amt").addClass('errors');
		return false;
	}else{
		$("#withdraw_amt").removeClass('errors');
		return true;
	}
}
</script>
<?php $this->load->view('site/templates/footer'); ?>