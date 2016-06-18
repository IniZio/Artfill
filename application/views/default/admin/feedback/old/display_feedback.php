<?php

$this->load->view('admin/templates/header.php');

extract($privileges);


//echo '<pre>'; print_r($productFeedbackListsVal); die;

//echo $productFeedbackListsVal[0]->product_name;die;

//echo '<pre>'; print_r(count($productFeedbackListsVal)); die;

?>

<div id="content">

		<div class="grid_container">

			<?php 

				$attributes = array('id' => 'display_form');

				echo form_open('admin/users/change_user_status_global',$attributes) 

			?>

			<div class="grid_12">

				<div class="widget_wrap">

					<div class="widget_top">

						<span class="h_icon blocks_images"></span>

						<h6><?php echo $heading?></h6>


					</div>

					<div class="widget_content">

						<table class="display" id="subscriber_tbl">

						<thead>

						<tr>

							<th class="tip_top" title="Click to sort">

									 User Name

							</th>

							<th class="tip_top" title="Click to sort">

							Email 

							</th>

							<th class="tip_top" title="Click to sort">

								 Comments Subject

							</th>

							<th>

								Commended on

							</th>



							<th>

								 Action

							</th>

						</tr>

						</thead>

						<tbody>

						<?php 

						if ($feedbackLists->num_rows() > 0){

							foreach ($feedbackLists->result() as $row){

							

						?>

						<tr>


							<td class="center">

								<?php echo $row->user_name;?>

							</td>

							<td class="center">

								<?php echo $row->email_id;?>

							</td>

							<td class="center">

							<?php echo character_limiter($row->subject,50);?>



							</td>

							<td class="center">

							<?php echo date('M,d -Y',strtotime($row->post_date));?>

							</td>


							<td class="center">

							<?php if ($allPrev == '1' || in_array('2', $user)){?>

							<!--	<span><a class="action-icons c-edit" href="admin/admin_feedback/edit_product_feedback/<?php echo $row->id;?>" title="Edit">Edit</a></span>-->

							<?php }?>

								<span><a class="action-icons c-suspend" href="admin/admin_feedback/view_feedback/<?php echo $row->id;?>" title="View">View</a></span>

							<?php if ($allPrev == '1' || in_array('3', $user)){?>	

								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/admin_feedback/delete_feedback/<?php echo $row->id;?>')" title="Delete">Delete</a></span>

							<?php }?>

							</td>

						</tr>

						<?php 

							

						} }

						?>

						</tbody>

						<tfoot>

							<tr>

							<th class="tip_top" title="Click to sort">

									 User Name

							</th>

							<th class="tip_top" title="Click to sort">

							Email 

							</th>

							<th class="tip_top" title="Click to sort">

								 Comments Subject

							</th>

							<th>

								Commended on

							</th>

<!-- 							<th class="tip_top" title="Click to sort">

								User Type

							</th>

 -->							


							<th>

								 Action

							</th>

						</tr>

						</tfoot>

						</table>

					</div>

				</div>

			</div>

			<input type="hidden" name="statusMode" id="statusMode"/>

			<input type="hidden" name="SubAdminEmail" id="SubAdminEmail"/>

		</form>	

			

		</div>

		<span class="clear"></span>

	</div>

</div>

<?php 

$this->load->view('admin/templates/footer.php');

?>