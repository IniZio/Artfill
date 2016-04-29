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
<script src="js/jquery.validate.js"></script>
<script>$(document).ready(function(){$("#addadvertising_form").validate(); });</script>
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
						echo form_open_multipart('admin/advertising/insertAdvertising',$attributes) 
					?>
                    
	 						<ul>		
								<li>
									<div class="form_grid_12">
										<label class="field_title" for="name">Advertising Name <span class="req">*</span></label>
										<div class="form_input">
											<input name="name" id="name" type="text"  tabindex="1" class="large tipTop required" title="Please enter the Advertising name"/>
										</div>
									</div>
								</li>
                                
								<li>
									<div class="form_grid_12">
										<label class="field_title" for="advertising_option">Advertising Option </label>
										<div class="form_input">
											<input name="advertising_option" checked="checked" type="radio" tabindex="2" class=" tipTop" value="image" title="Please Select to upload image"  onclick="javascript:imagefunctions('image');" > Image  &nbsp; 
											<input name="advertising_option" type="radio" tabindex="2" class="tipTop" value="script" title="Please Select to Html"  onclick="javascript:imagefunctions('script');"> Script
										</div>
									</div>
								</li> 
								
								<li>
									<div class="form_grid_12">
										<label class="field_title" for="advertising_option">Advertising Area </label>
										<div class="form_input">
											<input name="advertising_area" checked="checked" type="radio" tabindex="2" class=" tipTop" value="side" title="Please Select to upload image"   /> Side  &nbsp; 
											<input name="advertising_area" type="radio" tabindex="2" class="tipTop" value="bottom" title="Please Select to Html"  /> Bottom
										</div>
									</div>
								</li> 
								<ul id="advertisingImages">
									<form id="adBannerForm" method="post">
										<li>
											<div class="form_grid_12">
												<label class="field_title" for="advertising_image">Advertising Image <span class="req">*</span></label>
												<div class="form_input alertmsg" id="img_container" onclick="return alertMsgImg();">
													<input name="advertising_image"  id="advertising_image" type="file" tabindex="2" class="large tipTop required" title="Please upload Advertising image"/>
													<image id="loadedImg" src="images/indicator.gif" style="display:none;" />
													<span class="input_instruction green">( Advertising Image Size : For Side Area maximum width is 180px & For Bottom Area minimum width 970px)</span>
													<span class="input_instruction green" id="img_size"></span>
												</div>
											</div>
										</li>
										<li>
											<div class="form_grid_12">
												<label class="field_title" for="link">Advertising Link <span class="req">*</span></label>
												<div class="form_input">
													<input name="link" id="link" type="text" tabindex="3" class="large tipTop required" title="Please enter the Advertising link"/>
													
												</div>
											</div>
										</li>
									<input type="hidden" id="valid_img_size" name="img_size" />
									</form>
								</ul>
								
								
							
                            <li id="advertisingtexts" style="display:none;">
								<div class="form_grid_12">
									<label class="field_title" for="advertising_content">Advertising Script <span class="req">*</span></label>
									<div class="form_input">
                                    	<textarea name="advertising_content" id="advertising_content" tabindex="3" rows="5" cols="40" class="large tipTop required" title="Please enter the Advertising Script" style="width: 370px; height: 62px;"></textarea>
										<span class="input_instruction green">( Advertising Size :For Side Area maximum width is 180px & For Bottom Area minimum width 970px)</span>
									</div>
								</div>
							</li>
								
								
								
								
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
$('#addadvertising_form').validate();
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>