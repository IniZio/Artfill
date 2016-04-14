<?php
$this->load->view('admin/templates/header.php');
?>
<script src="js/jquery.validate.js"></script>
<script>$(document).ready(function(){$("#addbanner_form").validate(); });</script>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6><?php echo $heading;?></h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addbanner_form',  'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/banner/insertBanner',$attributes) 
					?>
                    
	 						<ul>
	 							
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="name">Shop Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="name" id="name" type="text" tabindex="1" class="large tipTop required" title="Please enter the banner name"/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="banner_image">Banner Image <span class="req">*</span></label>
									<div class="form_input">
										<input name="banner_image" id="banner_image" type="file" tabindex="2" class="large tipTop required" title="Please upload banner image"/>
										<span class="input_instruction green">Image Size 650 x 450 pixel</span>
									</div>
								</div>
								</li>
								
								<?php /*?><li>
								<div class="form_grid_12">
									<label class="field_title" for="link">Banner Link <span class="req">*</span></label>
									<div class="form_input">
										<input name="link" id="link" type="text" tabindex="3" class="large tipTop required" title="Please enter the banner link"/>
									</div>
								</div>
								</li><?php */?>
								
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="status">Status </label>
									<div class="form_input">
										<div class="publish_unpublish">
											<input type="checkbox" tabindex="4" name="status" checked="checked" id="publish_unpublish_publish" class="publish_unpublish"/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="5"><span>Submit</span></button>
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
<script type="text/javascript">
$('#addbanner_form').validate();
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>