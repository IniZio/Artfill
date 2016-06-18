<?php //echo '<pre>'; print_r($eventsList); die;
$this->load->view('admin/templates/header.php');
extract($privileges); //echo '<pre>'; print_r($eventsList->result()); die;
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/community/change_event_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">	
				<?php if ($allPrev == '1' || in_array('1', $community)){?>
                    <div class="widget_top">				
						<div style="line-height:40px;padding:0px 10px;height:39px;">
							<div class="btn_30_light" style="height: 29px; text-align:left;">                           
					<a href="admin/community/add_event_form"  class="tipTop" original-title="Add New Event"><span class="icon add_co"></span><span class="btn_link">Add Event</span></a>
							</div>
                       </div> 
					</div> 
					<?php } ?>
                    <div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
							<!--<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>-->
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="cms_tbl">
						<thead>
						<tr>
							<th class="center">
								<!--<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">-->
							</th>
                            <th class="tip_top" title="Click to sort">
								Hosted By
							</th>
							<th class="tip_top" title="Click to sort">
								 Event
							</th>
							<th class="tip_top" title="Click to sort">
								 Event Type
							</th>
							<th class="tip_top" title="Click to sort">
								Date
							</th>
							<th class="tip_top" title="Click to sort">
								Time
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
						<?php //echo $eventsList->num_rows(); die;
						if ($eventsList->num_rows() > 0){
							foreach ($eventsList->result() as $row){ 
						?>
						<tr>
							<td class="center tr_select ">
								<!--<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">-->
							</td>
                            <td class="center">
								<?php echo $row->full_name;?>
							</td>
							<td class="center">
								<?php echo $row->eventTitle;?>
							</td>
							<td class="center">
								<?php echo $row->eventType;?>
							</td>
							
							<td class="center">
								 <?php echo $row->eventDate;?>
							</td>
							<td class="center">
								<?php echo $row->eventTime;?>
							</td>
							
							
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $community)){
								$mode = ($row->status == 'Active')?'0':'3';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/community/change_event_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/community/change_event_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo 'Inactive';?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
<!-- 							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $community)){
								$mode = ($row->request_status == 'Approved')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to reject" class="tip_top" href="javascript:confirm_status('admin/seller/change_seller_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->request_status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to approve" class="tip_top" href="javascript:confirm_status('admin/seller/change_seller_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->request_status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php } ?>
							</td>
 -->							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $community)){?>
								<span><a class="action-icons c-edit" href="admin/community/edit_event_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
								<?php /*?><span><a class="action-icons c-suspend" href="admin/community/view_seller/<?php echo $row->id;?>" title="View">View</a></span><?php */?>
							<?php if ($allPrev == '1' || in_array('3', $community)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/community/delete_event/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
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
								<!--<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">-->
							</th>
							<th class="tip_top">
								 Hosted By
							</th>
                            <th class="tip_top">
								Event
							</th>
							<th class="tip_top" >
								 Event Type
							</th>
							
							<th class="tip_top">
								Date
							</th>
							<th class="tip_top">
								Time
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