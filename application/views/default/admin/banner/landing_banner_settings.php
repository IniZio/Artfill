<?php
$this->load->view('admin/templates/header.php');
?>
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
						echo form_open_multipart('admin/landing_banner/update_banner_settings',$attributes) 
					?>
                    
								<ul>
									<li>
									<div class="form_grid_12">
										<label class="field_title" for="banner_description">Banner description</label>
										<div class="form_input">
											<input name="banner_description" id="banner_description" type="text" tabindex="1" class="large tipTop" value="<?php echo $bannerSettings->row()->banner_description;?>" title="Please enter the banner name"/>
										</div>
									</div>
									</li>
                               </ul>

                                <ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="status">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="">
											
											<span>
											<label class="field_title site_banner_lbl" for="site_banner">Show Only Site Banner </label>
											<input type="radio" tabindex="4" name="status" id="site_banner" <?php if ($bannerSettings->row()->status == 'Active' || $bannerSettings->row()->status == ''){?>checked="checked"<?php }?>  value="Active" class="site_banner"/>
											</span>
											
											<span>
											<label class="field_title shop_banner_lbl" for="shop_banner">Show Shop owners Banner  </label>
											<input type="radio" tabindex="4" name="status" id="shop_banner" value="InActive" <?php if ($bannerSettings->row()->status == 'InActive'){?>checked="checked"<?php }?>  class="shop_banner"/>
											</span>
											
										</div>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="status">Show banner Text </label>
									<div class="form_input">
										<div class="">
											
											<span>
											<label class="field_title site_banner_lbl" for="site_banner_txt">Show </label>
											<input type="radio" tabindex="4" name="show_banner_text" id="site_banner_txt" <?php if ($bannerSettings->row()->show_banner_text == 'Yes' || $bannerSettings->row()->show_banner_text == ''){?>checked="checked"<?php }?>  value="Yes" class="site_banner"/>
											</span>
											
											<span>
											<label class="field_title shop_banner_lbl" for="shop_banner_txt">Don't Show</label>
											<input type="radio" tabindex="4" name="show_banner_text" id="shop_banner_txt" value="No" <?php if ($bannerSettings->row()->show_banner_text == 'No'){?>checked="checked"<?php }?>  class="shop_banner"/>
											</span>
											
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
                              
							 
							 <?php if($bannerSettings->num_rows() > 0){?>
								<input type="hidden" name="banner_row_exist" value="Yes" />
							 <?php }  else {?>
								<input type="hidden" name="banner_row_exist" value="No" />
							 <?php } ?>
							  
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>

<style>
.site_banner{
	float: left;
	margin-right: 6%;
	margin-left: -35px;
}

.site_banner_lbl{
margin-right: 0 !important;
cursor: pointer;
}

.shop_banner{
margin-left: -35px;
}


.shop_banner_lbl{
cursor: pointer;
}

</style>

<script type="text/javascript">
$('#addbanner_form').validate();
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>