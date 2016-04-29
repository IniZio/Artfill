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
					<div class="widget_content" style="">
					<?php 
				//	echo '<pre>';
				//	print_r($shop_details); die;
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
						
					?>
	 						<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Shop Name :</label>
									<div class="form_input">
										<?php echo $shop_details[0]['seller_businessname'];?>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Created :</label>
									<div class="form_input">
										<?php echo $shop_details[0]['created'];?>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Last modified :</label>
									<div class="form_input">
										<?php if($shop_details[0]['lastupdated'] != '') { echo $shop_details[0]['lastupdated']; } else { echo 'No Recent Modification';}?>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Seller Email :</label>
									<div class="form_input">
										<?php echo $shop_details[0]['seller_email'];?>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Seller FirstName :</label>
									<div class="form_input">
										<?php echo $shop_details[0]['seller_firstname'];?>
									</div>
								</div>
								</li>
	 							
                               <li>
								<div class="form_grid_12">
									<label class="field_title">Total Products :</label>
									<div class="form_input">
										<?php echo $active_count->num_rows()+$inactive_count->num_rows();?>
									</div>
								</div>
								</li>	
                               <li>
								<div class="form_grid_12">
									<label class="field_title">Published Products :</label>
									<div class="form_input">
										<?php echo $active_count->num_rows();?>
									</div>
								</div>
								</li>	
                                <li>
								<div class="form_grid_12">
									<label class="field_title">UnPublished Products :</label>
									<div class="form_input">
										<?php echo $inactive_count->num_rows();?>
									</div>
								</div>
								</li>	
                                
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Featured Shop :</label>
									<div class="form_input">
										<?php echo $shop_details[0]['featured_shop'];?>
									</div>
								</div>
								</li>	
                                
                                					
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/shop/display_shop" class="tipLeft" title="Go to lists"><span class="badge_style b_done">Back</span></a>
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