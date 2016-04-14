<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/contactseller/change_contact_seller_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php 
						if ($allPrev == '1' || in_array('2', $contactseller)){
						?>
							<!--<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Enable','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to enable records"><span class="icon active"></span><span class="btn_link">Enable</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Disable','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to disable records"><span class="icon delete_co"></span><span class="btn_link">Disable</span></a>
							</div>-->
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="contactseller_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 Contact Name
							</th>
                            <th class="tip_top" title="Click to sort">
								 Contact Email
							</th>
                            <th class="tip_top" title="Click to sort">
								 Contact Phone
							</th>
                            <th class="tip_top" title="Click to sort">
								 Seller Email
							</th>
                             <th class="tip_top" title="Click to sort">
								 Contact Date / Time
							</th>
							
							<?php if ($allPrev == '1' || in_array('2', $contactseller)){?>
							<th>
								 Action
							</th>
							<?php }?>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($ContactList->num_rows() > 0){
							foreach ($ContactList->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<?php echo $row->name;?>
							</td>
                            <td class="center">
								<?php echo $row->email;?>
							</td>
                            <td class="center">
								<?php echo $row->phone;?>
							</td>
                            <td class="center">
								<?php echo $row->selleremail;?>
							</td>
							 <td class="center">
								<?php echo $row->dateAdded;?>
							</td>
							<?php if ($allPrev == '1' || in_array('0', $contactseller)){?>
							<td class="center">
								<ul class="action_list"><li style="width:100%;"><a class="p_edit tipTop" href="admin/contactseller/view_contactseller_form/<?php echo $row->id;?>" title="View Details">View Details</a></li></ul>
							</td>
							<?php }?>
						</tr>
						<?php 
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 Contact Name
							</th>
                            <th class="tip_top" title="Click to sort">
								 Contact Email
							</th>
                            <th class="tip_top" title="Click to sort">
								 Contact Phone
							</th>
                            <th class="tip_top" title="Click to sort">
								 Seller Email
							</th>
                             <th class="tip_top" title="Click to sort">
								 Contact Date / Time
							</th>
							<?php if ($allPrev == '1' || in_array('2', $contactseller)){?>
							<th>
								 Action
							</th>
							<?php }?>
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