<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
$this->load->model('community_model');
$commentsDetails=$commentData->result_array();
//echo '<pre>'; print_r($commentsDetails); die;
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/community_news/change_comments_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $community)){?>
							<?php /*?><div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to publish records"><span class="icon accept_co"></span><span class="btn_link">Publish</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to unpublish records"><span class="icon delete_co"></span><span class="btn_link">Unpublish</span></a>
							</div><?php */?>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $community)){
						?>
							<?php /*?><div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div><?php */?>
						<?php }?>
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
								Team Name
							</th>
 							<th class="tip_top" title="Click to sort">
								 Discussion Title
							</th>
							<th class="tip_top" title="Click to sort">
								 Discussion Threads
							</th>
							<th class="tip_top" title="Click to sort">
								 Post Date
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
						//echo '<pre>';
						//print_r($commentsDetails); die; 
						if (count($commentsDetails) > 0){
							foreach ($commentsDetails as $details){
						?>
						<tr>
							<td class="center tr_select ">
								<!--<input name="checkbox_id[]" type="checkbox" value="<?php echo $details['id'];?>">-->
							</td>
							<td class="center">
								<?php echo $details['teamName'];?>
							</td>
 							<td class="center">
							<?php echo character_limiter(stripslashes($details['post_title']), 30);?>
							</td>
 					  <td class="center">
								<?php  $condition= array('rootId'=>$details['id']); $dissThrd = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition); ?>
                                <?php if($dissThrd->num_rows()>0){ ?> <a href="admin/community/teamdiscussionThreadview/<?php echo $details['id']; ?>">View ( <?php  echo $dissThrd->num_rows(); ?> ) </a><?php } else{  echo $dissThrd->num_rows(); }?>
   
							</td>
							<td class="center">
								<?php echo $details['postDate'];?>
							</td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $community)){
								$mode = ($details['status'] == 'Active')?'0':'1';
								$modeView = ($details['status'] == 'Active')?'Unpublish':'Inactive';
								$modeViewDisplay = ($details['status'] == 'Active')?'Active':'Inactive';
								if ($mode == '0'){
							?>
								<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/community/change_discuss_status/<?php echo $mode;?>/<?php echo $details['id'];?>/<?php echo $details['teamId']; ?>');"><span class="badge_style b_done"><?php echo $modeViewDisplay;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/community/change_discuss_status/<?php echo $mode;?>/<?php echo $details['id'];?>/<?php echo $details['teamId']; ?>')"><span class="badge_style"><?php echo $modeViewDisplay;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $details['status'];?></span>
							<?php }?>
							</td>
							<td class="center">

                            <!--<span><a class="action-icons c-suspend" href="<?php echo $details['comment_post_id'];?>/store-post-comments" title="View" target="_blank">View</a></span>-->
							<?php if ($allPrev == '1' || in_array('3', $community)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/community/delete_discuss/<?php echo $details['id'];?>/<?php echo $details['teamId']; ?>')" title="Delete">Delete</a></span>
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
							<th>
								 Team Name
							</th>
 							<th>
								 Discussion Title
							</th>
 							<th>
								  Discussion Thread
							</th>
							<th>
								 Post Date
							</th>
							<th>
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