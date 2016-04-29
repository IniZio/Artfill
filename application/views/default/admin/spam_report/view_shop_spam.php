<?php  //echo '<pre>'; print_r($spamList->result()); die;
$this->load->view('admin/templates/header.php'); 
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/location/change_location_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6>Complaints About "<?php echo $spamList->row()->shop_name;?>"</h6>
						<!--<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $complaints)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $complaints)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0);" onclick="return checkBoxValidationAdmin('Delete');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>   -->
						</div>
					</div>
					<div class="widget_content">
						<table class="display" id="action_tbl_view">
						<thead>
						<tr>
	                        <!--<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>-->
							
							<th class="tip_top" title="Click to sort">
								Spam Title
							</th>
							<th class="center" title="Click to sort">
                           Owner Name
							</th>
                            <!--<th class="center" title="Click to sort">
                            Shop Name
							</th>-->
                            <th>
								Reported User
							</th>
                            <th>
								Complaint Date
							</th>
							<th>
								Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($spamList->num_rows() > 0){
							foreach ($spamList->result() as $row){
						?>
						<tr>
							<!--<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>-->
							<td class="center  tr_select">
								<?php echo $row->spam_title;?>
							</td>
							<td class="center tr_select ">
                                <?php echo $row->seller_name;?>
							</td>
                            <!--<td class="center tr_select ">
                               <a href="shop-section/<?php echo $row->shop_seourl;?>" title="view this shop" target="_blank"> <?php echo $row->shop_name;?></a>
							</td>-->
							<td class="center">
                            <?php echo $row->reporter_name;?>
							</td>
                            <td class="center">
                            <?php echo $row->complaint_date;?>
							</td>
							<td class="center">
							<!--<?php if ($allPrev == '1' || in_array('2', $complaints)){?>
								<span><a class="action-icons c-edit" href="admin/complaints/edit_complaints_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>-->
								<span><a class="action-icons c-suspend" href="admin/spam/view_shop_spam_reply/<?php echo $row->spam_id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $complaints)){
							
							if($row->status!='Active'){
							
							?>
                            	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/spam/delete_shop_spam_record/<?php echo $row->spam_id;?>/<?php echo $this->uri->segment(4);?>')" title="Delete">Delete</a></span>
							<?php } }?>
							</td>
						</tr>
						<?php 
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
                         <!--<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							-->
							<th>
								 Spam Title
							</th>
							<th class="center">
								Owner Name
							</th>
							<!--<th>
								Shop Name
							</th>-->
                            <th>
								Reported User
							</th>
                            <th>
							Complaint Date
							</th>
							<th>
								 Action
							</th>
						</tr></tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>