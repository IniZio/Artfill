<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/seller/change_seller_status_global',$attributes) 
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
						<table class="display display_tbl" id="seller_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th>
								 Full Name
							</th>
							<th>
								 Email
							</th>
							<th>
								Thumbnail
							</th>
							
							<th>
								Website
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
						if ($sellerRequests->num_rows() > 0){
							
							foreach ($sellerRequests->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->sellerTblid;?>">
							</td>
							<td class="center">
								<?php echo $row->full_name;?>
							</td>
							<td class="center">
								<?php echo $row->email;?>
							</td>
							<td class="center">
							<div class="widget_thumb">
							<?php if ($row->thumbnail != ''){?>
								 <img width="40px" height="40px" src="<?php echo base_url();?>images/users/<?php echo $row->thumbnail;?>" />
							<?php }else {?>
								 <img width="40px" height="40px" src="<?php echo base_url();?>images/users/user-thumb1.png" />
							<?php }?>
							</div>
							</td>
							
							<td class="center">
								<?php echo $row->web_url;?>
							</td>
							<td class="center">
							<span class="badge_style b_pending"><?php echo $row->request_status;?></span>
							</td>
						<td class="center">
                        
							<?php if ($allPrev == '1' || in_array('2', $seller)){?>
								<span class="action_link"><a class="p_approve tipTop" href="admin/seller/change_seller_request/1/<?php echo $row->sellerTblid;?>/<?php echo $row->id;?>" title="Approve">Approve</a></span>
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/seller/view_seller/<?php echo $row->id;?>" title="View">View</a></span>

							<?php if ($allPrev == '1' || in_array('3', $seller)){?>	
								<span class="action_link"><a class="p_del tipTop" href="admin/seller/change_seller_request/0/<?php echo $row->id;?>/<?php echo $row->sellerTblid;?>" title="Delete">Delete</a></span>
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
								 Full Name
							</th>
							<th>
								 Email
							</th>
							<th>
								Thumbnail
							</th>
							
							<th>
								Website
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
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>