<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6><?php echo $heading; ?></h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open('admin/contactseller/display_contact_seller',$attributes); 
						
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="mode">Contact Name <span class="req">*</span></label>
									<div class="form_input">
										<div class="live_sandbox">
											<?php echo $contact_seller_status->row()->username;?> 
										</div>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="mode">Contact Email Address <span class="req">*</span></label>
									<div class="form_input">
										<div class="live_sandbox">
											<?php echo $contact_seller_status->row()->useremail;?> 
										</div>
									</div>
								</div>
								</li>
                               
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="mode">Contact Queries <span class="req">*</span></label>
									<div class="form_input">
										<div class="live_sandbox">
											<?php echo $contact_seller_status->row()->description;?> 
										</div>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="mode">Seller Email Adderss <span class="req">*</span></label>
									<div class="form_input">
										<div class="live_sandbox">
											<?php echo $contact_seller_status->row()->selleremail;?> 
										</div>
									</div>
								</div>
								</li>

								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Back</span></button>
									</div>
								</div>
								</li>
							</ul>
							<input type="hidden" name="gateway_id" value="<?php echo $contact_seller_status->row()->id;?>"/>
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