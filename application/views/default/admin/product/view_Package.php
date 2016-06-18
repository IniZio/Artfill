<?php
$this->load->view('admin/templates/header.php');
?>
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
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title">Package Name</label>
									<div class="form_input">
										<?php echo $pack_det->row()->name;?>
									</div>
								</div>
								</li>
                                
                                
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Number of Days</label>
									<div class="form_input">
										<?php echo $pack_det->row()->days;?>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Amount</label>
									<div class="form_input">
										<?php echo $pack_det->row()->amount;?>
									</div>
								</div>
								</li>
                                
                              <li>
								<div class="form_grid_12">
									<label class="field_title">Status</label>
									<div class="form_input">
										<?php echo $pack_det->row()->status;?>
									</div>
								</div>
								</li>
                                
								
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/product/display_FeaturePackage_list" class="tipLeft" title="Go to Category list"><span class="badge_style b_done">Back</span></a>
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