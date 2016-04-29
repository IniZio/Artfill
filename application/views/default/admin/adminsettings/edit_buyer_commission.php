<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit buyer commission</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'registrationForm');
						echo form_open('admin/buyer_commission/change_buyer_commission',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="buyer_commission">Buyer commission <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="buyer_commission" style=" width:295px" id="buyer_commission" value="<?php echo $buyer_commission_value ;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the buyer commission value"/>%
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="paypal_rate">Paypal Rate <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="paypal_rate" style=" width:295px" id="paypal_rate" value="<?php echo $this->data['paypal_rate_value'] ;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the paypal rate"/>%
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="paypal_static">Paypal Static <span class="req">*</span></label>
									<div class="form_input">
                                    $<input name="paypal_static" style=" width:295px" id="paypal_static" value="<?php echo $paypal_static_value ;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the paypal static"/>
									</div>
								</div>
								</li>
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