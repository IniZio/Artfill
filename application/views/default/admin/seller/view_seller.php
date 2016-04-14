<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Seller</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
					?>

	 						<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Seller Name</label>
									<div class="form_input">
										<?php 
										if ($seller_details[0]['full_name'] == ''){
											echo 'Not available';
										}else {
											echo $seller_details[0]['full_name'].' '.$seller_details[0]['last_name'];
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Seller Email</label>
									<div class="form_input">
										<?php 
										if ($seller_details[0]['email'] == ''){
											echo 'Not available';
										}else {
											echo $seller_details[0]['email'];
										}
										?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Seller Store Name</label>
									<div class="form_input">
										<?php 
										if ($seller_details[0]['seller_businessname'] == ''){
											echo 'Not available';
										}else {
											echo $seller_details[0]['seller_businessname'];
										}
										?>
									</div>
								</div>
								</li>
								<!--<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">How long have you been crafting?</label>
									<div class="form_input">
										<?php 
										if ($seller_details[0]['seller_crafting'] == ''){
											echo 'Not available';
										}else {
											echo $seller_details[0]['seller_crafting'];
										}
										?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">What mediums do you work with?</label>
									<div class="form_input">
										<?php 
										if ($seller_details[0]['seller_medium'] == ''){
											echo 'Not available';
										}else {
											echo $seller_details[0]['seller_medium'];
										}
										?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">What kind of items do you make?</label>
									<div class="form_input">
										<?php 
										if ($seller_details[0]['seller_make'] == ''){
											echo 'Not available';
										}else {
											echo $seller_details[0]['seller_make'];
										}
										?>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">producing your products</label>
									<div class="form_input">
										<?php 
										if ($seller_details[0]['seller_product'] == ''){
											echo 'Not available';
										}else {
											echo $seller_details[0]['seller_product'];
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Website</label>
									<div class="form_input">
										<?php 
										if ($seller_details[0]['seller_site'] == ''){
											echo 'Not available';
										}else {
											echo $seller_details[0]['seller_site'];
										}
										?>
									</div>
								</div>
								</li>-->
								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status</label>
									<div class="form_input">
										<?php echo $seller_details[0]['status'];?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/seller/display_seller_<?php if ($seller_details[0]['status']=='Pending'){echo 'requests';}else {echo 'list';}?>" class="tipLeft" title="Go to seller <?php if ($seller_details[0]['status']=='Pending'){echo 'requests';}else {echo 'list';}?>"><span class="badge_style b_done">Back</span></a>
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