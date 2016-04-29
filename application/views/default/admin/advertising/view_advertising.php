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
                                    <label class="field_title" for="country_id">Advertising Option</label>
                                    <div class="form_input">
                                      <?php echo $advertisingDetail->row()->advertising_option;?>
                                    </div>
                                  </div>
                                </li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="state_name">Advertising Name</label>
									<div class="form_input">
                                    <?php echo $advertisingDetail->row()->name;?>
									</div>
								</div>
								</li>
								  <li>
								<div class="form_grid_12">
									<label class="field_title" for="state_name">Advertising Area</label>
									<div class="form_input">
                                    <?php echo $advertisingDetail->row()->advertising_area;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="state_code">Advertising Image</label>
									<div class="form_input">
									<?php 
										if($advertisingDetail->row()->image != '') {
									?>
										<img src="images/advertising/<?php echo $advertisingDetail->row()->image;?>" width="200px" />
									<?php 
										} else{
										echo 'Not Available';
										}
									?>
									</div>
								</div>
								</li>
								<li>
								  <div class="form_grid_12">
									<label class="field_title" for="meta_title">Advertising Link</label>
									<div class="form_input">
									 <?php if($advertisingDetail->row()->link != '') {echo $advertisingDetail->row()->link;} else{
									echo 'Not Available';
									}?>
									</div>
								  </div>
								</li>
								
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="state_tax">Advertising Script</label>
									<div class="form_input">
                                    <?php if($advertisingDetail->row()->advertising_content != '') {echo $advertisingDetail->row()->advertising_content;} else{
									echo 'Not Available';
									}?>
									</div>
								</div>
								</li>
                                
	 							

								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/advertising/display_advertising" class="tipLeft" title="Go to ad banners list"><span class="badge_style b_done">Back</span></a>
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