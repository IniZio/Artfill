<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Slider</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'edituser_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/sliders/insertEditslider',$attributes) 
					?>
	 						<ul>
	 							<li>
									<div class="form_grid_12">
									<label class="field_title" for="title">Title <span class="req">*</span></label>
									<div class="form_input">
										<input name="title" id="title" type="text" tabindex="2" class="required large tipTop" title="Please enter the slider title" value="<?php echo $sliders_list->row()->title;?>"/>
									</div>
								</div>
								</li>
								 	<li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Description<span class="req">*</span></label>
								<div class="form_input">
								<input name="description" id="description" type="text" tabindex="2" style="width:370px;" class="required large tipTop " title="Please enter the slider description" value="<?php echo $sliders_list->row()->description;?>"/>
								</div>
								</div>
							</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="image">Image <span class="req">*</span></label>
									<div class="form_input">
										<input name="image" id="slider_image" type="file" tabindex="3" class="large tipTop" title="Please upload slider image"/>
										
										<img src="" id="loadedImg" style="widows:25px; height:25px; display:none;" />
										<div class="error" id="ErrCAtImage">Note: Image Upload Size 1400 x 400 pixel</div>
									</div>
									<div class="form_input">
										<img src="<?php echo base_url();?>images/sliders/<?php echo $sliders_list->row()->image;?>" width="200"/>
									</div>
								</div>
								</li>
								<li>
									<div class="form_grid_12">
									<label class="field_title" for="title">Link </label>
									<div class="form_input">
										<input name="link" id="link" type="text" tabindex="4" class=" large tipTop" title="Please enter the slider link" value="<?php echo $sliders_list->row()->link;?>"/>
									</div>
								</div>
								</li>
								
								<li>
									<div class="form_grid_12">
									<label class="field_title" for="name">Status </label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" name="status" <?php if ($sliders_list->row()->status == 'Active'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
									<input type="hidden" name="id" value="<?php echo $sliders_list->row()->id;?>"/>
								</li>
								
								
								
								
								
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
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
<script>
$(document).ready(function() {
$("#slider_image").change(function(e) {   
	    e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);
        $.ajax({
			beforeSend: function()
 		      {
				   $("#loadedImg").css("display", "block");
      	        document.getElementById("loadedImg").src='images/loader64.gif';
  			  },
            url: 'admin/sliders/ajax_check_slider_image_size',
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
			$("#loadedImg").css("display", "none");
			  if(data=='Success'){
		      $('#ErrCAtImage').html('Success');
			  return true;
			  } else {
			  $('#slider_image').val('');
			  $('#ErrCAtImage').html('Upload Image Too Small. Please Upload Image Size More than or Equalto 1400 X 400 .');
			  return false;
			  }
		   },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
		
		
});
});
</script>