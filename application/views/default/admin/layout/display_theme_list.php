<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
 
?>

<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/newsletter/change_newsletter_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading;?></h6>
						<!--<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $newsletter)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $newsletter)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>-->
						
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
													<div style="height: 29px;" class="btn_30_light">
								<a class="tipTop" href="<?php echo base_url();?>admin/layout/add_new_theme" original-title="Click here To add New Theme"><span class="icon accept_co"></span><span class="btn_link">Add New Theme</span></a>
							</div>
							
						</div>
					</div>
					
					
					
					<div class="widget_content">
					
					
						<ul class="theme-setting-main" id="themetable">
							<li>
							
								<div class="theme-setting-top">
							
								<span class="white-opacity"></span>
							
								<div class="theme-img"><img src="images/theme-1.jpg" /></div>
								
								<div class="theme-setting">
								
									<a  class="tip_top" href="javascript:default_restore('admin/layout/restore_default');"><span class="badge_style b_done">Restore Default</span></a>
																
								
								</div>
								
							</div>
						</li>
						<?php 
						if ($theme_list->num_rows() > 0){
							foreach ($theme_list->result() as $row){
						?>
							
						
							<li>
							
								<div class="theme-setting-top">
							
								<span class="white-opacity"></span>
							
								<div class="theme-img"><img src="images/theme-1.jpg" /></div>
								
								<div class="theme-setting">
								
									<?php 
										if ($allPrev == '1' || in_array('2', $user)){
											if($row->status == 'Active'){
												$mode = 0;
											}elseif($row->status == 'Inactive'){
												$mode = 1;
											}else{
												$mode = 2;
											}
												
											//$mode = ($row->status == 'Active')?'0':'1';
											if ($mode == '0'){
										?>
											<a  class="tip_top" href="javascript:confirm_status('admin/layout/change_user_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
										<?php
											}else if ($mode == '1'){ 	
										?>
											<a  class="tip_top" href="javascript:confirm_status('admin/layout/change_user_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
										<?php 
											}else{ ?>
												<span class="badge_style"><?php echo $row->status;?></span>
											<?php }
										}else {
										?>
										<span class="badge_style b_done"><?php echo $row->status;?></span>
										<?php }?>
								
								
								
								</div>
								
							</div>
								
								<div class="theme-setting-bottom">
								
									<h1><?php echo $row->theme_name;?></h1>
									
									<div class="theme-setting-bottom-btn">
									
										<?php if ($allPrev == '1' || in_array('2', $user)){?>
										<span><a class="action-icons c-edit" href="admin/layout/edit_theme_name/<?php echo $row->id;?>" title="Theme Name Edit">Edit</a></span>
									
										<span><a class="action-icons c-edit" href="admin/layout/display_theme_layout/<?php echo $row->id;?>" title="Theme Edit">Edit</a></span>
										
										<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/layout/delete_layout/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
										<?php }?>
									
									</div>
								
								</div>
							
							</li>
							
							<?php 
							}
						}
						?>
						
						</ul>
					
					
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