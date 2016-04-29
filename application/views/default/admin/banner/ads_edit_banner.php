<?php
$this->load->view('admin/templates/header.php');
?>
<script type="text/javascript">
function adtype(){
		$('#bannerImages').show();
		$('#bannerScript').hide();
		$('#ads_type').val('Image');
		$('#ad_type_change').css('background-color','yellow'); 
		$('#ad_type_changes').css('background-color','gray'); 
		
		
}
function adtypes(){

	
	$('#bannerImages').hide();
	$('#bannerScript').show();
	$('#ads_type').val('Script');
	$('#ad_type_changes').css('background-color','yellow'); 
	$('#ad_type_change').css('background-color','gray'); 
}

</script>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6><?php echo $heading;?></h6>
						<?php if($ads_details->row()->ad_type == 'Image') { ?>
						<label class="top_label">
						<input type="button" name="ad_type_change" style="background-color:yellow;" id="ad_type_change" value="Image" onclick="return adtype();"></label>
						<label class="top_labels">
						<input type="button" name="ad_type_change" id="ad_type_changes" value="Script" onclick="return adtypes();"></label>
						<?php } else {?>
						<label class="top_label">
						<input type="button" name="ad_type_change" id="ad_type_change" value="Image" onclick="return adtype();"></label>
						<label class="top_labels">
						<input type="button" name="ad_type_change" style="background-color:yellow;" id="ad_type_changes" value="Script" onclick="return adtypes();"></label>
						<?php } ?>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addbanner_form',  'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/banner/updateAds',$attributes) 
					?>
                    
	 						<ul>
	 							
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="name">Ad Area</label>
									<div class="form_input">
										<input name="name" id="name" type="text" tabindex="1" class="large tipTop" value="<?php echo $ads_details->row()->ad_area;?>" title="Please enter the Ad Area"/>
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
                           <ul id="bannerImages" <?php if($ads_details->row()->ad_type == 'Image') { echo 'style="display:block;"';}else{ echo 'style="display:none;"';}?>> 
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="banner_image">Ad Image </label>
									<div class="form_input">
										<input name="ad_image1" id="banner_image" type="file" tabindex="3" class="large tipTop" title="Please upload banner image"/>
										<span class="input_instruction green">Image Size 230 x 60 pixel For Side Bar & Image Size 970 x 90 pixel for Footer</span>
									</div>
									<div class="form_input">
										<img src="<?php echo base_url();?>images/adsimage/<?php echo $ads_details->row()->ad_image;?>" width="200"/>
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
								 <ul id="bannerScript" <?php if($ads_details->row()->ad_type == 'Script') { echo 'style="display:block;"';}else{ echo 'style="display:none;"';}?>> 
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="banner_image">Ad Script </label>
									<div class="form_input">
										<input name="ad_script" id="banner_image" type="text" tabindex="3" class="large tipTop" 
										 value="<?php echo $ads_details->row()->ad_path;?>" title="Please Enter Script here"/>
										 
										 <>
										<span class="input_instruction green">Image Size 230 x 60 pixel For Side Bar & Image Size 970 x 90 pixel for Footer</span>
									</div>
									<?php /* <div class="form_input">
										<img src="<?php echo base_url();?>images/<?php echo $ads_details->row()->ad_path;?>" width="200"/>
									</div> */ ?>
								</div>
								</li>
								</ul>
                                <ul id="bannertexts" <?php #if($banner_details->row()->banner_option == 'html') { echo 'style="display:block;"';}else{ echo 'style="display:none;"';}?>>
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
											<input type="checkbox" tabindex="4" name="status" <?php if ($ads_details->row()->status == 'Publish'){?>checked="checked"<?php }?> id="publish_unpublish_publish" class="publish_unpublish"/>
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
              <input type="hidden" name="ads_id" value="<?php echo $ads_details->row()->id;?>" />
			  <input type="hidden" id="ads_type" name="ads_type" value="<?php echo $ads_details->row()->ad_type; ?>" />
                            
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
<style>
.top_label{
color:white;
margin-left:25%;

}
.top_labels{
color:white;
margin-left:10%;

}

</style>
<?php 
$this->load->view('admin/templates/footer.php');
?>