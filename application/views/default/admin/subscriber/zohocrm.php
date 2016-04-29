<?php
$this->load->view('admin/templates/header.php');
if (is_file('./zohocrm_settings.php'))
{
	include('./zohocrm_settings.php');
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
						echo form_open('admin/subscriber/save_zohocrm',$attributes) 
					?>
	 						<ul>
									
									<li>
                                      <div class="form_grid_12">
                                        <label class="field_title" for="zoho_email">ZOHO CRM Email Id</label>
                                        <div class="form_input">
                                          <input name="zoho_email" id="zoho_email" type="text" tabindex="1" class="large tipTop required " title="Please enter the  Zoho CRM email id"/>
                                        </div>
                                      </div>
                                    </li>
									<li>
                                      <div class="form_grid_12">
                                        <label class="field_title" for="zoho_pwd">ZOHO CRM Password</label>
                                        <div class="form_input">
                                          <input name="zoho_pwd" id="zoho_pwd" type="password" tabindex="1" class="large tipTop required" title="Please enter the  Password"/>
                                        </div>
                                      </div>
                                    </li>
									<li>
                                      <div class="form_grid_12" >                                      
                                        <div class="form_input">
                                          <a type="submit"class="btn_small btn_blue"  onclick="ajax_getAPIKey();"/><span>click here</span> </a>to get API Key
                                        </div>
                                      </div>
                                    </li>
									
									<li class="submit_li" style="display:none;">
                                      <div class="form_grid_12">
                                        <label class="field_title" for="zoho_api_key">Api Key</label>
                                        <div class="form_input">
                                          <input name="zoho_api_key" readonly value="<?php echo $config['zoho_api_key'];?>" id="zoho_api_key" type="text" tabindex="1" class="large tipTop" title="Please enter the  api key"/>
                                        </div>
                                      </div>
                                    </li>
                                    
                                  <?php /*?>  <li>
                                      <div class="form_grid_12">
                                        <label class="field_title" for="list_id">List Id</label>
                                        <div class="form_input">
                                          <input name="list_id" value="<?php echo $config['list_id'];?>" id="list_id" type="text" tabindex="1" class="large tipTop" title="Please enter the  list id"/>
                                        </div>
                                      </div>
                                    </li>*/?>
                                   <li class="submit_li" style="display:none;">
								<div class="form_grid_12">
									<label class="field_title" for="status">Status </label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="radio" name="zoho_status" <?php if ($config['zoho_status'] == 'Yes'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive" value="Yes"/>Yes &nbsp; <input type="radio" name="zoho_status" <?php if ($config['zoho_status'] == 'No'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive" value="No"/> No
										</div>
									</div>
								</div> 
								
								<li class="submit_li" style="display:none;">
								<div class="form_grid_12">
								
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue"><span>Finish Set up</span></button>
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
<script>

</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>
            


