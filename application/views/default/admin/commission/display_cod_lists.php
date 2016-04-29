<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
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
								 Vendor name
							</th>
							<th class="tip_top" title="Click to sort">
								 Vendor email
							</th>
							<th class="tip_top" title="Click to sort">
								COD orders
							</th>
							<th class="tip_top" title="Click to sort">
								COD amount
							</th>
							<th class="tip_top" title="Click to sort">
								COD Earnings
							</th>
							<th class="tip_top" title="Click to sort">
								Received amount
							</th>
							<th class="tip_top" title="Click to sort">
								Balance
							</th>
							<th class="tip_top" title="Click to sort">
								 Update
							</th>
							<th>
								 Options
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
								<?php echo $cod_orders[$row->id];?>
							</td>
							<td class="center">
								<?php echo "$".number_format($cod_amount[$row->id],2,'.',',');?>
							</td>
							<td class="center">
								<?php echo "$".number_format($cod_commision[$row->id],2,'.',','); ?>
							</td>
							<td class="center">
								<?php echo "$".number_format($cod_paid[$row->id],2);?>
							</td>	
							<td class="center">
								<?php 
								$balance_amt=$cod_commision[$row->id]-$cod_paid[$row->id];
								echo number_format($balance_amt,2);
								?>
							</td>								
							<td class="center">
								<?php echo "$";?><input style="width: 30px;margin:5px; border: 1px solid #d8d8d8; background-color: #eee;
 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#ffffff', GradientType=0 );
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, color-stop(20%, #eeeeee), color-stop(80%, #ffffff));
	background-image: -webkit-linear-gradient(top, #eeeeee 20%, #ffffff 80%);
	background-image: -moz-linear-gradient(top, #eeeeee 20%, #ffffff 80%);
	background-image: -o-linear-gradient(top, #eeeeee 20%, #ffffff 80%);
	background-image: -ms-linear-gradient(top, #eeeeee 20%, #ffffff 80%);
	background-image: linear-gradient(top, #eeeeee 20%, #ffffff 80%);" type="text" value="<?php echo $row->refund_amount;?>"/>
								<a class="action-icons c-updat tipTop" href="javascript:void(0);" title="Update" onclick="update_cod(this,'<?php echo $row->id;?>');">Update</a>
							</td>				
							<td class="center">
									<span class="action_link"><a style="border:none; padding:0 !important; " class="p_reject tipTop c-suspend action-icons" href="admin/commission/view_cod_details/<?php echo $row->id;?>" title="View paid details">View</a></span>									
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
							<th>
								Sno
							</th>
							<th>
								 Vendor name
							</th>
							<th>
								 Vendor email
							</th>
							<th>
								COD orders
							</th>
							<th>
								COD amount
							</th>
							<th>
								COD Earnings
							</th>
							<th>
								Received amount
							</th>
							<th>
								Balance
							</th>
							<th>
								 Update
							</th>
							<th>
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