<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/advertising/change_advertising_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
					</div>
					<div class="widget_content">
						<label class="error green">Note: Last Added or Modified Ad will be Used to display.</label>
						<table class="display display_tbl" id="advertising_tbl">
						<thead>
						<tr>
							<th  width=20%; class="tip_top" title="Click to sort">
								 Advertising Type
							</th>		
							<th class="tip_top" title="Click to sort">
								 Advertising Name
							</th>	
							<th class="tip_top" title="Click to sort">
								 Advertising Area
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
						<?php 
						if ($advertisingList->num_rows() > 0){
							foreach ($advertisingList->result() as $row){
						?>
						<tr>
							<td class="center">
								<?php echo $row->advertising_option;?>
							</td>
							<td class="center">
								<?php echo $row->name;?>
							</td>
							<td class="center">
								<?php echo $row->advertising_area;?>
							</td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $advertising)){
								$mode = ($row->status == 'Publish')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/advertising/change_advertising_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/advertising/change_advertising_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<td class="center">
							
							<?php if ($allPrev == '1' || in_array('2', $banner)){?>
								<span><a class="action-icons c-edit" href="admin/advertising/edit_advertising/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php } ?>
							<span><a class="action-icons c-suspend" href="admin/advertising/view_advertising/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $banner)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/advertising/delete_advertising/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php }  ?>
							</td>
						</tr>
						<?php 
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th class="tip_top">
								 Advertising Type
							</th>
							<th class="tip_top">
								 Advertising Name
							</th>
							<th class="tip_top">
								 Advertising Area
							</th>
							<th class="tip_top">
								Status
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
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>