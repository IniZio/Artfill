<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Slider</h6>
						<div id="widget_tab">
			             
			            </div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
					?>
					<div id="tab1">
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title"> Image</label>
									<div class="form_input">
									<?php if ( $sliders_list->row()->image == ''){?>
										<img src="<?php echo base_url();?>images/sliders/slider_thumb1.png" width="100px"/>
									<?php }else {?>
										<img src="<?php echo base_url();?>images/sliders/<?php echo $sliders_list->row()->image;?>" width="100px"/>
									<?php }?>
									</div>
								</div>
								</li>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title">Title :</label>
									<div class="form_input">
										<?php echo $sliders_list->row()->title;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Description:</label>
									<div class="form_input">
										<?php echo $sliders_list->row()->description;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Link :</label>
									<div class="form_input">
										<?php echo $sliders_list->row()->link?>
									</div>
								</div>
								</li>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title">status</label>
									<div class="form_input">
										<?php echo $sliders_list->row()->status;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Created_date</label>
									<div class="form_input">
										<?php echo $sliders_list->row()->created_date;?>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/sliders/display_sliderslist" class="tipLeft" title="Go to sliders list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
								</ul>
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