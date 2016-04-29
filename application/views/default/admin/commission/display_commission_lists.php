<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$currencySymbol="$";
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
							<div class="btn_30_light" style="height: 29px;">
								<a href="admin/commission/export_csv" class="tipTop" title="Click here to export datas using csv format"><span class="icon accept_co"></span><span class="btn_link">Export CSV</span></a>
							</div>				
							<div class="btn_30_light" style="height: 29px;">
								<a href="admin/commission/paid_vendor" class="tipTop" title="Last Export List to change status paid"><span class="icon accept_co"></span><span class="btn_link">Payment Paid</span></a>
							</div>
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="commission_tbl">
						<thead>
						<tr>
							<th class="tip_top" title="Click to sort">
								Sno
							</th>
							<th class="tip_top" title="Click to sort">
								 Name
							</th>
							<th class="tip_top" title="Click to sort">
								Vendor Email
							</th>
							<th class="tip_top" title="Click to sort">
							orders
							</th>
							<th class="tip_top" title="Click to sort">
								Earnings
							</th>
							<th class="tip_top" title="Click to sort">
								Dispute Amt
							</th>
							<th class="tip_top" title="Click to sort">
								Other Detections 
							</th>
							<th class="tip_top" title="Click to sort">
								 Site Earned 
							</th>
							<th class="tip_top" title="Click to sort">
								 vendor Earned
							</th>
							<th class="tip_top" title="Click to sort">
								 Paid
							</th>
							<th class="tip_top" title="Click to sort">
								 Balance
							</th>
							<th>
								 Option
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($sellerDetails->num_rows() > 0){
							$i=1;
							foreach ($sellerDetails->result() as $row){
						?>
						<tr>
							<td class="center">
								<?php echo $i;?>
							</td>
							<td class="center">
								<?php echo $row->full_name;?>
							</td>
							<td class="center">
								<?php echo $row->email;?>
							</td>
							<td class="center">
								<?php echo $total_orders[$row->id];?>
							</td>
							<td class="center">
								<?php echo $currencySymbol.number_format($total_amount[$row->id],2,'.',',');?>
							</td>
							<td class="center"><?php echo $currencySymbol.number_format($claim_amount[$row->id],2,'.',','); ?></td>
							<td class="center">
								<?php echo $currencySymbol;?><input style="width: 30px;margin:5px; border: 1px solid #d8d8d8; background-color: #eee;
 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#ffffff', GradientType=0 );
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, color-stop(20%, #eeeeee), color-stop(80%, #ffffff));
	background-image: -webkit-linear-gradient(top, #eeeeee 20%, #ffffff 80%);
	background-image: -moz-linear-gradient(top, #eeeeee 20%, #ffffff 80%);
	background-image: -o-linear-gradient(top, #eeeeee 20%, #ffffff 80%);
	background-image: -ms-linear-gradient(top, #eeeeee 20%, #ffffff 80%);
	background-image: linear-gradient(top, #eeeeee 20%, #ffffff 80%);" type="text" value="<?php echo $row->refund_amount;?>"/>
								<a class="action-icons c-updat tipTop" href="javascript:void(0);" title="Update" onclick="update_refund(this,'<?php echo $row->id;?>');">Update</a>
							</td>
							<td class="center">
								<?php echo $currencySymbol.number_format($commission_to_admin[$row->id],2);?>
							</td>
							<td class="center">
								<?php echo $currencySymbol.number_format($amount_to_vendor[$row->id],2);?>
							</td>
							<td class="center">
								<?php echo $currencySymbol.number_format($paid_to[$row->id],2);?>
							</td>
							<td class="center">
								<?php echo $currencySymbol.number_format($paid_to_balance[$row->id],2);?>
							</td>
							<td class="center">
									<span class="action_link"><a style="border:none; padding:0 !important; " class="p_reject tipTop c-suspend action-icons" href="admin/commission/view_paid_details/<?php echo $row->id;?>" title="View paid details">View</a></span>
									<?php #if ($paid_to_balance[$row->id]>0){?>
									<?php if (number_format($paid_to_balance[$row->id],2)>0){?>
									<span class="action_link"><a style="border:none; padding:0 !important; "  class="p_approve tipTop c-paynow action-icons" href="admin/commission/add_pay_form/<?php echo $row->id;?>" title="Pay balance due">Pay now</a></span>
									<?php }?>
									<?php #if ($paid_to_balance[$row->id]>0 && $row->send_req=="Yes"){?>
									<?php if (number_format($paid_to_balance[$row->id],2)>0 && $row->send_req=="Yes"){?>
									<span class="action_link">
									<a style="border:none; padding:0 !important; "  class="" href="admin/commission/add_pay_form/<?php echo $row->id;?>" title="Pay balance due"><span class="badge_style b_pending">Pay now</span></a>
									</span>
									<?php }?>
							</td>
						</tr>
						<?php 
						$i++;
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th >
								Sno
							</th>
							<th>
								 Vendor name
							</th>
							<th>
								 Vendor email
							</th>
							<th>
								Total orders
							</th>
							<th>
								Total Earnings
							</th>
							<th>
								Dispute amount
							</th>
							<th>
								Other Detections
							</th>
							<th>
								 Site Earning
							</th>
							<th>
								 Amount to vendor
							</th>
							<th>
								 Paid
							</th>
							<th>
								 Balance Amt
							</th>
							<th style="width:60px;">
								 Options
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>