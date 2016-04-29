<?php
$this->load->view('admin/templates/header.php');
extract($privileges); #echo '<pre>'; print_r($ContactList->result());

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
						if ($allPrev == '1' || in_array('2', $contactshopowner)){
						?>
							
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display displaycontact_tbl" id="contactseller_tbl">
						<thead>
						<tr>
							<!--<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>-->
							<th class="tip_top" title="Click to sort">
								 Contact Name
							</th>
                            <th class="tip_top" title="Click to sort">
								 Contact Email
							</th>
                            <th class="tip_top" title="Click to sort">
								 Seller Email
							</th>
                             <th class="tip_top" title="Click to sort">
								 Contact Date / Time
							</th>
							
							
							<th>
								 Action
							</th>
							
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($ContactList->num_rows() > 0){
							foreach ($ContactList->result() as $row){
							
							if($row->username != '' && $row->username != '0' && $row->useremail != '' && $row->useremail != '0' && $row->selleremail != '' && $row->selleremail!='0'){
							
						?>
						<tr>
							<!--<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>-->
							<td class="center">
								<a href="view-people/<?php echo $row->user_url;?>" target="_blank" style="color:blue;"><?php echo $row->username;?></a>
							</td>
                            <td class="center">
								<?php echo $row->useremail;?>								
							</td>
                            <td class="center">
								<a href="view-people/<?php echo $row->seller_url;?>" target="_blank" style="color:blue;"><?php echo $row->selleremail;?></a>
							</td>
							 <td class="center">
								<?php echo $row->dateAdded;?>
							</td>
							
							<td class="center">
							<?php if ($allPrev == '1' || in_array('0', $contactshopowner)){?>
								<span><a class="action-icons c-suspend tipTop" href="admin/contactseller/view_contactseller_form/<?php echo $row->id;?>" title="View">View</a></span>
                                <span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/contactseller/delete_contactseller_info/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
								<?php }?>
							</td>
							
						</tr>
						<?php 
							}
						}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<!--<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>-->
							<th class="tip_top" title="Click to sort">
								 Contact Name
							</th>
                            <th class="tip_top" title="Click to sort">
								 Contact Email
							</th>
                            <th class="tip_top" title="Click to sort">
								 Seller Email
							</th>
                             <th class="tip_top" title="Click to sort">
								 Contact Date / Time
							</th>
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