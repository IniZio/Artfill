<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<script>
function change_featured_shop(val) {
		var shopid=val.id;
		var fstatus=$("#"+shopid).is(':checked') ? 1 : 0;  
		$.get('site/shop/change_featuredShop_ajax?shop_id='+shopid+'&fstatus='+fstatus, function(data) {
		});
}
</script>

<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/shop/asd',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<!--<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $shop)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to publish records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to unpublish records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $shop)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>-->
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="sellertrans_tbl">
						<thead>
						<tr>
							<!--<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>-->
							<th class="tip_top" title="Click to sort">
								 Transaction Mode
							</th>
							<th class="tip_top" title="Click to sort">
								Transaction Date
							</th>
							<th class="tip_top" title="Click to sort">
								 Transaction Amount
							</th>
							<th class="tip_top" title="Click to sort">
								 Number of Products
							</th>
							<!--<th class="tip_top" title="Click to sort">
								 Shop Payments
							</th>
							<th class="tip_top" title="Click to sort">
								Status
							</th>-->
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php
						//echo '<pre>';
						//print_r($shopDetails); die; 
						if (count($shop_trans_details) > 0){
							foreach ($shop_trans_details as $details){
						?>
						<tr>
							<!--<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $details['id'];?>">
							</td>-->
							<td class="center">
								<?php echo $details['pay_type'];?>
							</td>
                            
                            
							<td class="center"> 
							<?php echo $details['pay_date'];?>
							</td>
                            
                            
 			  				<td class="center">
								<?php echo $details['pay_amount'];?>
							</td>
							<td class="center">
								<?php echo $details['totPrd']; ?>
							</td>
							<!--<td class="center">
                                <a title="Click to view" class="tip_top" href="admin/shop/view_shop_transaction/<?php echo $details['seller_id'];?>">View Transactions</a>
                            </td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $shop)){
								$mode = ($details['status'] == 'active')?'0':'1';
								$modeView = ($details['status'] == 'active')?'inactive':'active';
								$modeViewDisplay = ($details['status'] == 'active')?'active':'Inactive';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/shop/change_shop_status/<?php echo $mode;?>/<?php echo $details['id'];?>');"><span class="badge_style b_done"><?php echo $modeViewDisplay;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/shop/change_shop_status/<?php echo $mode;?>/<?php echo $details['id'];?>')"><span class="badge_style"><?php echo $modeViewDisplay;?></span></a>
							<?php 
								}
							}else {
								if($details['status']=='active'){
							?>
							<span class="badge_style b_done"><?php echo $details['status'];?></span>
                            <?php }elseif($details['status']=='inactive'){ ?>
                            <span class="badge_style"><?php echo $details['status'];?></span>
							<?php } }?>
							</td>-->
							<td class="center">
							
                            <span><a class="action-icons c-suspend" href="admin/shop/view_shop_trans/<?php echo strtotime($details['pay_date']).'/'.$details['user_id'];?>" title="View">View</a></span>
							<?php # if ($allPrev == '1' || in_array('3', $shop)){ if($details['id'] != '1'){?>	
								<!--<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/shop/delete_shop/<?php echo $details['id'];?>')" title="Delete">Delete</a></span>-->
							<?php #}}?>
							</td>
						</tr>
						<?php 
							}
						} 
						?>
						</tbody>
						<tfoot>
						<tr>
							<!--<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>-->
							<th class="tip_top" title="Click to sort">
								 Transaction Mode
							</th>
							<th class="tip_top" title="Click to sort">
								Transaction Date
							</th>
							<th class="tip_top" title="Click to sort">
								 Transaction Amount
							</th>
							<th class="tip_top" title="Click to sort">
								 Number of Products
							</th>
							<!--<th class="tip_top" title="Click to sort">
								 Shop Payments
							</th>
							<th class="tip_top" title="Click to sort">
								Status
							</th>-->
							<th>
								 Action
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
			<input type="hidden" name="SubAdminEmail" id="SubAdminEmail"/>
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>
