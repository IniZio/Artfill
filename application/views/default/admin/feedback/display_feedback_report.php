<?php
$this->load->view('admin/templates/header.php');
extract($privileges);

$reportFeedbackLists= $this->data['GetreportFeedbackLists']->result();
#$productFeedbackListsValImage= $this->data['productFeedbackLists']->result_array();

//echo '<pre>'; print_r($productFeedbackListsVal); die;
//echo $productFeedbackListsVal[0]->product_name;die;
//echo '<pre>'; print_r(count($productFeedbackListsVal)); die;
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/users/change_user_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<!--<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $user)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onClick="return checkBoxValidationAdmin('Active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onClick="return checkBoxValidationAdmin('Inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $user)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onClick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>-->
					</div>
					<div class="widget_content">
						<table class="display" id="subscriber_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
									 Reporter Name
							</th>
							<th class="tip_top" title="Click to sort">
							 Shop Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Product Image
							</th>
							<th>
								Reviewer Name
							</th>
							<th class="tip_top" title="Click to sort">
								Review Status
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if (count($reportFeedbackLists) > 0){
							foreach ($reportFeedbackLists as $row){
							 if($row->reporter_id!=''){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<a href="view-people/<?php echo $row->shopownerName;?>" target="_blank" style="color:blue;"><?php echo $row->shopownerName;?></a>
							</td>
							<td class="center">
								<a href="shop-section/<?php echo $row->shop_url;?>" target="_blank" style="color:blue;"><?php echo $row->shop_name;?></a>
							</td>
							<td class="center">
							<div class="widget_thumb">
							<a href="products/<?php echo $row->seourl;?>" target="_blank" style="color:blue;">
								<?php if ($row->image != ''){   
								 $img_arr = explode(",",$row->image); ?>
									 <img width="40px" height="40px" src="<?php echo base_url();?>images/product/thumb/<?php echo $img_arr[0]; ?>" />
								<?php }else {?>
									 <img width="40px" height="40px" src="<?php echo base_url();?>images/noimage.jpg" />
								<?php }?>
							</a>	
							</div>	
							</td>
							<td class="center">
							<a href="view-people/<?php echo $row->reviewer_name;?>" target="_blank" style="color:blue;"><?php echo $row->reviewer_name;?></a>
							</td>						
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $user)){
								$mode = ($row->review_status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/admin_feedback/change_product_feedback_status/<?php echo $mode;?>/<?php echo $row->review_id;?>');"><span class="badge_style b_done"><?php echo $row->review_status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/admin_feedback/change_product_feedback_status/<?php echo $mode;?>/<?php echo $row->review_id;?>')"><span class="badge_style"><?php echo $row->review_status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->review_status;?></span>
							<?php }?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $user)){?>
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/admin_feedback/view_feedback_report/<?php echo $row->review_id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $user)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/admin_feedback/delete_product_feedback/<?php echo $row->review_id;?>')" title="Delete">Delete</a></span>
							<?php }?>
							</td>
						</tr>
						<?php 
							}
						} }
						?>
						</tbody>
						<tfoot>
							<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
									 Reporter Name
							</th>
							<th class="tip_top" title="Click to sort">
							 Shop Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Product Image
							</th>
							<th>
								Reviewer Name
							</th>
							<th class="tip_top" title="Click to sort">
								Review Status
							</th>
							<th>
								 Action
							</th>
						</tr>
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