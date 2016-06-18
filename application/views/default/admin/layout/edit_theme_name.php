<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">

<?php 

#echo "<pre>";

#print_r($theme_name);

?>
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Theme Name</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'adduser_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/layout/update_theme_data',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="full_name">Theme Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="theme_name" id="full_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the Theme name"  value="<?php echo $theme_name->row()->theme_name;?>"/>
									</div>
								</div>
								</li>
								
								<!--<li>
								<div class="form_grid_12">
									<label class="field_title" for="group">Group <span class="req">*</span></label>
									<div class="form_input">
										<div class="user_seller">
											<input type="checkbox" tabindex="3" name="group" checked="checked" id="User_Seller_User" class="User_Seller"/>
										</div>
									</div>
								</div>
								</li>-->
                                
								
								<li>
		<input type="hidden" value="<?php echo $theme_name->row()->id;?>" name="id">
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="9"><span>Submit</span></button>
									</div>
								</div>
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>