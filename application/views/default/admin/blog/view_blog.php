<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View List</h6>
					</div>
					<div class="widget_content">
					<?php 
					//echo '<pre>';
				//	print_r($posts_details); die;
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
						
					?>
	 						<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Post Title :</label>
									<div class="form_input">
										<?php echo $posts_details[0]['post_title'];?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Posted Name :</label>
									<div class="form_input">
										<?php echo $posts_details[0]['user_name'];?>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Business Name :</label>
									<div class="form_input">
										<?php echo $posts_details[0]['seller_businessname'];?>
									</div>
								</div>
								</li>
	 							
<li>
								<div class="form_grid_12">
									<label class="field_title">Post Content :</label>
									<div class="form_input">
										<?php echo $posts_details[0]['post_content'];?>
									</div>
								</div>
								</li>								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/blog/display_blog" class="tipLeft" title="Go to lists"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
								</ul>
							
							
							
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>