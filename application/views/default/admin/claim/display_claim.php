<?php
$this->load->view('admin/templates/header.php');
extract($privileges); 
?>

<?php //print_r($claimList->result()); die;?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/location/change_location_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<!--<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $disputemgmt)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $disputemgmt)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>-->
					</div>
					<div class="widget_content">
						<table class="display" id="claim_tbl_view">
						<thead>
						<tr>
							<th>
								S.No
							</th>
							<th class="tip_top" title="Click to sort">
								Buyer Name
							</th>
                            <th class="center" title="Click to sort">
                           		Seller Name
							</th>
							
							<th class="center" title="Click to sort">
                           		OrderId
							</th>
							
							<th class="center" title="Click to sort">
                           		Amount
							</th>
							
							<th class="center" title="Click to sort">
                           		Date
							</th>
							
                            <th>
								Status
							</th>
							<th>
								Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 							
							if ($claimList->num_rows() > 0){
							$i=1;
							foreach ($claimList->result() as $row){							
						?>
						<tr>
							<td class="center tr_select"><?php echo $i; ?></td>
							<td class="center  tr_select">
								<a href="view-people/<?php echo $row->buyername;?>" target="_blank" style="color:blue;"><?php echo $row->buyer_name;?></a>
							</td>
							<td class="center tr_select ">
								<a href="view-people/<?php echo $row->sellername;?>" target="_blank" style="color:blue;"><?php echo $row->seller_name;?></a>
							</td>
							<td class="center tr_select ">
							<?php echo $row->orderid; ?>
							</td>
							<td class="center tr_select ">
							<?php echo $row->total_amount; ?>
							</td>
							<td class="center tr_select ">
							<?php echo $row->post_time; ?>
							</td>
							
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $disputemgmt)){
								$mode = ($row->claim_status == 'Opened')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to closed" class="tip_top" href="javascript:confirm_status('admin/claim/change_claim_status/<?php echo $mode;?>/<?php echo $row->claimid;?>');"><span class="badge_style b_done"><?php echo $row->claim_status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to opened" class="tip_top" href="javascript:confirm_status('admin/claim/change_claim_status/<?php echo $mode;?>/<?php echo $row->claimid;?>')"><span class="badge_style"><?php echo $row->claim_status;?></span></a>
							<?php 
								}
							} else {
							?>
							<span class="badge_style b_done"><?php echo $row->claim_status;?></span>
							<?php } ?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $disputemgmt)){?>
								<!--<span><a class="action-icons c-edit" href="admin/currency/edit_currency_form/<?php echo $row->orderid; ?>" title="Edit">Edit</a></span>-->
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/claim/view_claim_info/<?php echo $row->orderid; ?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $disputemgmt)){
							
							if($row->claim_status!='claim_status'){
							
							?>                          
							<!--<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/currency/delete_currency/<?php echo $row->orderid;?>')" title="Delete">Delete</a></span>-->
							<?php } }?>
							</td>
						</tr>
						<?php 
							$i++; }
						 ?>
						<?php } ?>
						</tbody>
						<tfoot>
						<tr>
							<th>S.No</th>
							<th>
								 Buyer Name
							</th>
							<th>
								 Seller Name
							</th>
							<th class="center" title="Click to sort">
                           		OrderId
							</th>
							
							<th class="center" title="Click to sort">
                           		Amount
							</th>
							
							<th class="center" title="Click to sort">
                           		Date
							</th>
                            <th>
								 Status
							</th>
							<th>
								 Action
							</th>
						</tr></tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<script>
$('#claim_tbl_view').dataTable({
// 		"aoColumnDefs": [
// 							{ "bSortable": false, "aTargets": [ 0,4] }
// 						],
// 						"aaSorting": [[1, 'asc']],
 		"sPaginationType": "full_numbers",
		"iDisplayLength": 50,
		"oLanguage": {
	        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
	    },
		 "sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
		 
		});
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>