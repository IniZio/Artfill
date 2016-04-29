<?php

$this->load->view('admin/templates/header.php');

?>

<div id="content">

		<div class="grid_container">

			<div class="grid_12">

				<div class="widget_wrap">

					<div class="widget_top">

						<span class="h_icon list"></span>

						<h6>View User feedback</h6>

						
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

									<label class="field_title">User Name</label>

									<div class="form_input">

										<?php echo $feedDetail->row()->user_name; ?>

									</div>

								</div>

								</li>

								<li>

								<div class="form_grid_12">

									<label class="field_title">Subject</label>

									<div class="form_input">

										<?php echo $feedDetail->row()->subject; ?>

									</div>

								</div>

								</li>

								<li>

								<div class="form_grid_12">

									<label class="field_title">Comments</label>

									<div class="form_input">

										<?php echo $feedDetail->row()->message; ?>

									</div>

								</div>

								</li>

	 							<li>

								<div class="form_grid_12">

									<label class="field_title">Commended On</label>

									<div class="form_input">

								
										<?php echo date('M,d -Y',strtotime($feedDetail->row()->post_date));?>

									</div>

								</div>

								</li>

                               


								

								<li>

								<div class="form_grid_12">

									<div class="form_input">

										<a href="admin/admin_feedback/display_feedback" class="tipLeft" title="Go to users list"><span class="badge_style b_done">Back</span></a>

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