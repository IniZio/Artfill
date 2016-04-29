<?php
$this->load->view('admin/templates/header.php');
?>
<script type="text/javascript">
function imagefunctions(val){ 
	if(val == 'image'){
		$('#advertisingImages').show();
		$('#advertisingtexts').hide();
	}else{
		$('#advertisingImages').hide();
		$('#advertisingtexts').show();
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
						$attributes = array('class' => 'form_container left_label', 'id' => 'addadvertising_form',  'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/advertising/editAdvertising',$attributes) 
					?>
                    
	 						<ul>
	 							
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="name">Advertising Name <span class="req">*</span></label>
									<div class="form_input">
									<input name="name" id="name" type="text" tabindex="1" class="large tipTop required" value="<?php echo $advertisingDetail->row()->name;?>" title="Please enter the Advertising name"/>
									</div>
								</div>
								</li>
                                
                         <li>
								<div class="form_grid_12">
									<label class="field_title" for="advertising_option">Advertising Option </label>
									<div class="form_input">
										<input name="advertising_option" type="radio" tabindex="2" class=" tipTop" value="image" title="Please Select to upload image" <?php if($advertisingDetail->row()->advertising_option == 'image') { echo 'checked="checked"';}?> onclick="javascript:imagefunctions('image');" > Image  &nbsp; <input name="advertising_option" type="radio" tabindex="2" class="tipTop" value="script" title="Please Select to Script" <?php if($advertisingDetail->row()->advertising_option == 'script') { echo 'checked="checked"';}?> onclick="javascript:imagefunctions('script');"> Script
									</div>
								</div>
								</li>
								
								<li>
									<div class="form_grid_12">
										<label class="field_title" for="advertising_option">Advertising Area </label>
										<div class="form_input">
											<input name="advertising_area" checked="checked" type="radio" tabindex="2" class=" tipTop" value="side" title="Please Select to upload image"  <?php if($advertisingDetail->row()->advertising_area == 'side') { echo 'checked="checked"';}?> /> Side  &nbsp; 
											<input name="advertising_area" type="radio" tabindex="2" class="tipTop" value="bottom" title="Please Select to Html" <?php if($advertisingDetail->row()->advertising_area == 'bottom') { echo 'checked="checked"';}?> /> Bottom
										</div>
									</div>
								</li> 
                               </ul>
							   
                           <ul id="advertisingImages" style="display:<?php if($advertisingDetail->row()->advertising_option == 'image') { echo 'block';}else{echo 'none';}?>";>
                              
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="advertising_image">Advertising Image <span class="req">*</span></label>
									<div class="form_input">
										<input name="advertising_image" id="advertising_image" type="file" tabindex="3" class="large tipTop" title="Please upload Advertising image"/>
										<input type="hidden" id="valid_img_size" name="img_size"/>
										<image id="loadedImg" src="images/indicator.gif" style="display:none;" />
									</div> <br />
									<div class="form_input">
										<img src="<?php echo base_url();?>images/advertising/<?php echo $advertisingDetail->row()->image;?>" width="200"/>
										<span class="input_instruction green">( Advertising Size :For Side Area maximum width is 180px & For Bottom Area minimum width 970px )</span>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="link">Advertising Link <span class="req">*</span></label>
									<div class="form_input">
										<input name="link" id="link" type="text" tabindex="3" class="large tipTop required" value="<?php echo $advertisingDetail->row()->link;?>" title="Please enter the Advertising link"/>
										
									</div>
								</div>
								</li>
						</ul>
								
						<ul>	
						<li id="advertisingtexts" style="display:<?php if($advertisingDetail->row()->advertising_option == 'script') { echo 'block';}else{echo 'none';}?>";>
							<div class="form_grid_12">
								<label class="field_title" for="advertising_content">Advertising Script <span class="req">*</span></label>
								<div class="form_input"> 		
									<textarea name="advertising_content" id="advertising_content" type="file" tabindex="2" class="large tipTop required" title="Please enter bannder holder contact information" placeholder="Enter the details about this ad owner." style="width: 370px; height: 62px;"><?php echo $advertisingDetail->row()->advertising_content;?></textarea>
									<span class="input_instruction green">( Advertising Size :For Side Area maximum width is 180px & For Bottom Area minimum width 970px )</span>
									</div>
							</div>
						</li>
								
								

	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="status">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="publish_unpublish">
											<input type="checkbox" tabindex="4" name="status" <?php if ($advertisingDetail->row()->status == 'Publish'){?>checked="checked"<?php }?> id="publish_unpublish_publish" class="publish_unpublish"/>
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
							<input type="hidden" name="advertising_id" value="<?php echo $advertisingDetail->row()->id;?>" />
                            
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<script type="text/javascript">
$('#addadvertising_form').validate();
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>