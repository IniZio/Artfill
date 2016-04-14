<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/blog/change_comments_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $cms)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to publish records"><span class="icon accept_co"></span><span class="btn_link">Publish</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to unpublish records"><span class="icon delete_co"></span><span class="btn_link">Unpublish</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $cms)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="cms_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 Post Title
							</th>
 							<th class="tip_top" title="Click to sort">
								 Comment title
							</th>
							<th class="tip_top" title="Click to sort">
								 Comments Description
							</th>
							<th class="tip_top" title="Click to sort">
								 Comments Date
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
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $details['comment_id'];?>">
							</td>
							<td class="center">
								<?php echo $details['post_title'];?>
							</td>
 							<td class="center">
							<?php echo $details['comments_title'];?>
							</td>
 					  <td class="center">
								<?php echo $details['comment_body'];?>
							</td>
							<td class="center">
								<?php echo $details['comment_date'];?>
							</td>
							
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $blog)){
								$mode = ($details['comment_status'] == 'active')?'0':'1';
								$modeView = ($details['comment_status'] == 'active')?'Unpublish':'Publish';
								$modeViewDisplay = ($details['comment_status'] == 'active')?'Publish':'Unpublish';
								if ($mode == '0'){
							?>
								<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/blog/change_comment_status/<?php echo $mode;?>/<?php echo $details['comment_id'];?>/<?php echo $details['comment_post_id']; ?>');"><span class="badge_style b_done"><?php echo $modeViewDisplay;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/blog/change_comment_status/<?php echo $mode;?>/<?php echo $details['comment_id'];?>/<?php echo $details['comment_post_id']; ?>')"><span class="badge_style"><?php echo $modeViewDisplay;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $details['comment_status'];?></span>
							<?php }?>
							</td>
							<td class="center">
                          <?php if($details['comment_status'] == 'active'){?>
                            <span><a class="action-icons c-suspend" href="<?php echo $details['comment_post_id'];?>/store-post-comments" title="View" target="_blank">View</a></span>
                            <?php } ?>
							<?php if ($allPrev == '1' || in_array('3', $blog)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/blog/delete_comments/<?php echo $details['comment_id'];?>/<?php echo $details['comment_post_id']; ?>')" title="Delete">Delete</a></span>
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
								 Post Title
							</th>
 							<th>
								 Comment title
							</th>
 							<th>
								  Comment Description
							</th>
							<th>
								 Comment Date
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