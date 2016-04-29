<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
$this->load->model('community_news_model');
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/community_news/change_blog_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
                    
						
                        <div style=" line-height:40px;padding:0px 10px;height:39px;">
						                        
							<div class="btn_30_light" style="height: 29px; text-align:left;">
                           
								<a href="admin/community_news/add_post_form"  class="tipTop" original-title="ADD NEW NEWS"><span class="icon add_co"></span><span class="btn_link">Add News</span></a>
							</div>
                          </div>
                          					</div>
                          <div class="widget_top">
                          <span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;"></div>
						
						</div>

					<div class="widget_content">
						<table class="display display_tbl" id="cmscommunity_tbl">
						<thead>
						<tr>
							<th class="center">
								<!--<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">-->
							</th>
							<th class="tip_top" title="Click to sort">
								 User Name
							</th>
 							<th class="tip_top" title="Click to sort">
								 News title
							</th>
							<th class="tip_top" title="Click to sort">
								 Added Date
							</th>
							<th class="tip_top" title="Click to sort">
								 Comments
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
						//print_r($postDetails); die; 
						if (count($postDetails) > 0){
							foreach ($postDetails as $details){
						?>
						<tr>
							<td class="center tr_select ">
								<!--<input name="checkbox_id[]" type="checkbox" value="<?php echo $details['post_id'];?>">-->
							</td>
							<td class="center">
								<?php echo $details['user_name'];?>
							</td>
<!-- 							<td class="center">
							<?php echo $details['post_title'];?>
							</td>
 -->					  <td class="center">
								<?php echo $details['post_title'];?>
							</td>
							<td class="center">
								<?php echo $details['posted_date'];?>
							</td>
							<td class="center">
								 
                                  <?php $postCount = $this->community_news_model->get_posts_comments($details['post_id']); 
								
								 if(count($postCount) > 0){?>
								 <a href="admin/community_news/display_comments/<?php echo $details['post_id'];?>">
                                  View (<?php echo count($postCount); ?>)
								</a>
                                <?php } else {
									echo count($postCount);?>
                                	
                                <?php } ?>
							</td>
							
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $community)){
								$mode = ($details['post_status'] == 'active')?'0':'1';
								$modeView = ($details['post_status'] == 'active')?'Unpublish':'Publish';
								$modeViewDisplay = ($details['post_status'] == 'active')?'Publish':'Unpublish';
								if ($mode == '0'){
							?>
								<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/community_news/change_blog_status/<?php echo $mode;?>/<?php echo $details['post_id'];?>');"><span class="badge_style b_done"><?php echo $modeViewDisplay;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/community_news/change_blog_status/<?php echo $mode;?>/<?php echo $details['post_id'];?>')"><span class="badge_style"><?php echo $modeViewDisplay;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $details['post_status'];?></span>
							<?php }?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $community)){?>
								<span><a class="action-icons c-edit" href="admin/community_news/edit_post_form/<?php echo $details['post_id'];?>" title="Edit">Edit</a></span>
							<?php }?>
                            <span><a class="action-icons c-suspend" href="<?php echo $details['post_id'];?>/news-details" title="View" target="_blank">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $community)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/community_news/delete_blog/<?php echo $details['post_id'];?>')" title="Delete">Delete</a></span>
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
								 User Name
							</th>
<!-- 							<th>
								 Page Title
							</th>
 -->							<th>
								  News title
							</th>
							<th>
								 Added Date
							</th>
							<th class="tip_top" title="Click to sort">
								 Comments
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
<script>
$('#cmscommunity_tbl').dataTable({   
		 "aoColumnDefs": [
							{ "bSortable": false, "aTargets": [ 0 ,6] }
						],
						"aaSorting": [[1, 'asc']],
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