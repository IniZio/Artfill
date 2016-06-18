<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
	<div id="content">
		
		
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/product/change_feature_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' ){?>
							<div class="btn_30_light" style="height: 29px;">
								
									
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to Active Package"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to Inactive Package"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1'){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					
					<div class="widget_content">
						<table class="display display_tbl" id="package_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort" style="width:300px !important">
								Name
							</th>
							
							
							
							<th class="tip_top" title="Click to sort" style="width:300px !important">
								 Days
							</th>
							<th class="tip_top" title="Click to sort">
								 Amount
							</th>
							
							<th class="tip_top" title="Click to sort">
								Status
							</th>							
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php #echo "<pre>"; print_r($feature_pack->result());die;
						if ($feature_pack->num_rows() > 0){
							foreach ($feature_pack->result() as $row){								
						?>
						<tr>
						<input  id="pack_id" type="hidden" value="<?php echo $row->id;?>">
						
						<input  id="pack_name" type="hidden" value="<?php echo $row->name;?>">
							<td class="center tr_select ">
								<input name="checkbox_id[]"  type="checkbox" value="<?php echo $row->id;?>">
							</td>	
							<td class="center" >
								<?php echo $row->name;?>
							</td>
							
							<td class="center">
								<?php echo $row->days;?>
							</td>	
							<td class="center">
								<?php echo $row->amount; ?>
							</td>
							<td class="center">							 
							<?php 
							if ($allPrev == '1'){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to Inactive" class="tip_top" href="javascript:confirm_status('admin/product/change_pack_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to Active" class="tip_top" href="javascript:confirm_status('admin/product/change_pack_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
						
							<td class="center">
							<?php if ($allPrev == '1'){?>
								<span><a class="action-icons c-edit" href="admin/product/edit_pack/<?php echo $row->id;?>" target="_blank" title="Edit">Edit</a></span>
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/product/view_pack/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1'){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/product/delete_pack/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php }?>
							
							
							</td>
						</tr>
						<?php 
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th>
								  Name
							</th>
							
							<th>
								Days
							</th>
							<th>
								Amount
							</th>
							<th>
								status
							</th>
						
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
	<script>
	$('#package_tbl').dataTable({   
		 "aoColumnDefs": [
							{ "bSortable": false, "aTargets": [0,5 ] }
						],
						"aaSorting": [[0, 'asc']],
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

