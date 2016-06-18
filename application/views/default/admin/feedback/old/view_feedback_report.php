<?php
$this->load->view('admin/templates/header.php');
$feedbackList = $this->data['GetproductFeedbackLists']->result_array();
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Feedback</h6>
						<div id="widget_tab">
			              <ul>
			                <li><a href="#tab1" class="active_tab">Details</a></li>
			             
			              </ul>
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
									<label class="field_title">Reviewer Name</label>
									<div class="form_input">
										<?php echo $feedbackList[0]['reviewer_name']; ?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Reporter Name</label>
									<div class="form_input">
										<?php echo $feedbackList[0]['shopownerName']; ?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Shop Name</label>
									<div class="form_input">
										<?php echo $feedbackList[0]['shop_name']; ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Product Name</label>
									<div class="form_input">
										<?php echo  $feedbackList[0]['product_name'];?>
									</div>
								</div>
								</li>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title">Review Message</label>
									<div class="form_input">
										<?php echo  $feedbackList[0]['review_content'];?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Report Message</label>
									<div class="form_input">
										<?php echo  $feedbackList[0]['report_message'];?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Rating</label>
									<div class="form_input">
							<div class="ratingstar-<?php echo trim(round(stripslashes( $feedbackList[0]['rating'])));?>" id="rating-pos">  </div>
									</div>
								</div>                                   <div class="clear"></div>

								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title">Product Image</label>
									<div class="form_input">
                                	<?php if ($feedbackList[0]['image'] != ''){   
							 $img_arr = explode(",",$feedbackList[0]['image']); ?>
								 <img src="<?php echo base_url();?>images/product/thumb/<?php echo $img_arr[0]; ?>" />
							<?php }else {?>
								 <img width="40px" height="40px" src="<?php echo base_url();?>images/noimage.jpg" />
							<?php }?>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Reported On</label>
									<div class="form_input">
										<?php echo $feedbackList[0]['report_time'];?>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/admin_feedback/display_feedback_report" class="tipLeft" title="Go to users list"><span class="badge_style b_done">Back</span></a>
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