<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Location</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					 
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open('admin/currency/insertEditcurrency',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_name">Currency Name <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="currency_name" style=" width:295px" id="currency_name" value="<?php echo $currency_details->row()->currency_name;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the currency name"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="iso_code2">Currency Code <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="currency_code" style=" width:295px" id="currency_code" value="<?php echo $currency_details->row()->currency_code;?>" type="text" tabindex="1" class="tipTop" title="Please enter the iso_code2"/>
									</div>
								</div>
								</li>
                               
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_tax">Currency Symbol <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="currency_symbol" style=" width:295px" id="currency_symbol" value="<?php echo $currency_details->row()->currency_symbol;?>" type="text" tabindex="1" class=" tipTop" title="Please enter the currency shipping cost"/>
									</div>
								</div>
								</li>
                                
                                 
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_value">Currency Value <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="currency_value" style=" width:295px" id="currency_value" value="<?php echo $currency_details->row()->currency_value;?>" type="text" tabindex="1" class=" tipTop" title="Please enter the currency shipping cost"/>
									</div>
								</div>
								</li>
                              <li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="publish_unpublish">
											<input type="checkbox" tabindex="11" name="status" <?php if ($currency_details->row()->status == 'Active'){ echo 'checked="checked"';}?> id="publish_unpublish_publish" class="publish_unpublish"/>
										</div>
									</div>
								</div>
								</li>
                               
								<input type="hidden" name="id" value="<?php echo $currency_details->row()->id;?>"/>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
                        </div>
                        
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