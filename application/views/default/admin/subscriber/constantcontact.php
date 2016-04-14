<?php
$this->load->view('admin/templates/header.php');
if (is_file('./constantcontact_settings.php'))
{
	include('./constantcontact_settings.php');
}
?>

<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
       
          <div class="widget_top"> <span class="h_icon list"></span>
            <h6><?php echo $heading?></h6>
            </div>
            <div class="widget_content">
            
            <?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'regitstraion_form');
						echo form_open('admin/subscriber/save_constantcontact',$attributes) 
					?>
	 						<ul>
								<li>
                                      <div class="form_grid_12">
                                        <label class="field_title" for="constantcontact_api_key">Api Key</label>
                                        <div class="form_input">
                                          <input name="constantcontact_api_key" value="<?php echo $config['constantcontact_api_key'];?>" id="api_key" type="text" tabindex="1" class="large tipTop" title="Please enter the  api key"/>
                                        </div>
                                      </div>
                                    </li>
                                    
                                   <li>
                                      <div class="form_grid_12">
                                        <label class="field_title" for="constantcontact_access_token">Access Token</label>
                                        <div class="form_input">
                                          <input name="constantcontact_access_token" value="<?php echo $config['constantcontact_access_token'];?>" id="access_token" type="text" tabindex="1" class="large tipTop" title="Please enter the  access token"/>
                                        </div>
                                      </div>
                                    </li>
                                    
                                    
                                    <li>
                                      <div class="form_grid_12">
                                        <label class="field_title" for="constantcontact_list_name">List Name</label>
                                        <div class="form_input">
                                          <input name="constantcontact_list_name" value="<?php echo $config['constantcontact_list_name'];?>" id="access_token" type="text" tabindex="1" class="large tipTop" title="Please enter the  access token"/>
                                        </div>
                                      </div>
                                    </li>
                                    
                                    
                                    <li>
								<div class="form_grid_12">
									<label class="field_title" for="constantcontact_status">Status </label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="radio" name="constantcontact_status" <?php if ($config['constantcontact_status'] == 'Yes'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive" value="Yes"/>Yes &nbsp; <input type="radio" name="constantcontact_status" <?php if ($config['constantcontact_status'] == 'No'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive" value="No"/> No
										</div>
									</div>
								</div> 
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue"><span>Save</span></button>
									</div>
								</div>
								</li>
							</ul>
						</form>
					</div>
				
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>
            
