<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Currency</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
					?>
	 						<ul>
                            	<li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_name">Currency Name <span class="req">*</span></label>
									<div class="form_input">
                                    <?php echo $currency_details->row()->currency_name;?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_type">Currency Code<span class="req">*</span></label>
									<div class="form_input">
                                   <?php echo $currency_details->row()->currency_code;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_symbol">Currency Symbol<span class="req">*</span></label>
									<div class="form_input">
                                    <?php echo $currency_details->row()->currency_symbol;?>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="country_tax">Country Value<span class="req">*</span></label>
									<div class="form_input">
                                   <?php echo $currency_details->row()->currency_value;?>
									</div>
								</div>
								</li>
                            <!--    
	 							<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Meta Title</label>
                    <div class="form_input">
                      <?php echo $currency_details->row()->meta_title;?>
                    </div>
                  </div>
                </li>
                				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                     <?php echo $currency_details->row()->meta_keyword;?>
                    </div>
                  </div>
                </li>
                				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <?php echo $currency_details->row()->meta_description;?>
                    </div>
                  </div>
                </li>
								-->
								
	 							
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/currency/display_currency_list" class="tipLeft" title="Go to currency list"><span class="badge_style b_done">Back</span></a>
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