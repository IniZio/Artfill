<?php
$this->load->view('admin/templates/header.php');
?>
<script src="js/jquery.validate.js"></script>
<script>$(document).ready(function(){$("#addbanner_form").validate(); });</script>
<script type="text/javascript">
function imagefunctions(val){
	if(val == 'image'){
		$('#bannerImages').show();
		$('#bannertexts').hide();
	}else{
		$('#bannerImages').hide();
		$('#bannertexts').show();
	}
}
</script>
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
						echo form_open_multipart('admin/landing_banner/landingeditbanner',$attributes) 
					?>
                    
	 						<ul>
	 							
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="name">Banner Name </label>
									<div class="form_input">
										<input name="name" id="name" type="text" tabindex="1" class="large tipTop required" value="<?php echo $banner_details->row()->name;?>" title="Please enter the banner name"/>
									</div>
								</div>
								</li>
                                
                                <?php /*?><li>
								<div class="form_grid_12">
									<label class="field_title" for="name">Banner Option </label>
									<div class="form_input">
										<input name="banner_option" type="radio" tabindex="2" class=" tipTop" value="image" title="Please Select to upload image" <?php if($banner_details->row()->banner_option == 'image') { echo 'checked="checked"';}?> onclick="javascript:imagefunctions('image');" > Image  &nbsp; <input name="banner_option" type="radio" tabindex="2" class="tipTop" value="html" title="Please Select to Html" <?php if($banner_details->row()->banner_option == 'html') { echo 'checked="checked"';}?> onclick="javascript:imagefunctions('html');"> Html
									</div>
								</div>
								</li><?php */?>
                               </ul>
                           <ul id="bannerImages" <?php if($banner_details->row()->banner_option == 'image') { echo 'style="display:block;"';}else{ echo 'style="display:none;"';}?>> 
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="banner_image">Banner Image <span class="req">*</span></label>
									<div class="form_input">
										<input name="banner_image" id="banner_image" type="file" tabindex="3" class="large tipTop" title="Please upload banner image"/>
										<!--<span class="input_instruction green">Image Size 1400 x 400 pixel</span>-->
										<img src="" id="loadedImg" style="widows:25px; height:25px; display:none;" />
										<div class="error" id="ErrCAtImage">Note: Image Upload Size 1400 x 400 pixel</div>
									</div>
									<div class="form_input">
										<img src="<?php echo base_url();?>images/landingbanner/<?php echo $banner_details->row()->image;?>" width="200"/>
									</div>
								</div>
								</li>
								
								<?php /*?><li>
								<div class="form_grid_12">
									<label class="field_title" for="link">Banner Link </label>
									<div class="form_input">
										<input name="link" id="link" type="text" tabindex="3" class="large tipTop" value="<?php echo $banner_details->row()->link;?>" title="Please enter the banner link"/>
									</div>
								</div>
								</li><?php */?>
                                </ul>
                                <ul id="bannertexts" <?php if($banner_details->row()->banner_option == 'html') { echo 'style="display:block;"';}else{ echo 'style="display:none;"';}?>>
                                <?php /*?><li>
								<div class="form_grid_12">
									<label class="field_title" for="link">Slider Text </label>
									<div class="form_input">
                                    	<textarea name="banner_text" id="banner_text" tabindex="3" rows="5" cols="40" class="large tipTop" title="Please enter the banner html"><?php echo $banner_details->row()->banner_text;?></textarea>
									</div>
								</div>
								</li><?php */?>
								</ul>
                                <ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="status">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="publish_unpublish">
											<input type="checkbox" tabindex="4" name="status" <?php if ($banner_details->row()->status == 'Publish'){?>checked="checked"<?php }?> id="publish_unpublish_publish" class="publish_unpublish"/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="5"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
              <input type="hidden" name="banner_id" value="<?php echo $banner_details->row()->id;?>" />
                            
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

<script>
$(document).ready(function() {
$("#banner_image").change(function(e) {   
	    e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);
        $.ajax({
			beforeSend: function()
 		      {
				   $("#loadedImg").css("display", "block");
      	        document.getElementById("loadedImg").src='images/loader64.gif';
  			  },
            url: 'admin/landing_banner/ajax_check_banner_image_size',
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
			  $('#banner_image').val('');
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