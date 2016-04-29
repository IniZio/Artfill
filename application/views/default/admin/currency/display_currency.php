<?php
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
						<h6><?php echo $heading?></h6>
						<!--<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $location)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $location)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>-->
					</div>
					<div class="widget_content">
						<table class="display" id="action_tbl_view">
						<thead>
						<tr>
							
							<th class="tip_top" title="Click to sort">
								 Currency Name
							</th>
							<th class="center">
                            Symbol
							</th>
                            <th class="center" title="Click to sort">
                            Currency Code
							</th>
                            <th class="center" title="Click to sort">
								Currency Value
							</th> 
                            
                            <th>
								Status
							</th>
                             <th>
								Default Currency
							</th>
							<th>
								Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($currencyList->num_rows() > 0){
							foreach ($currencyList->result() as $row){
						?>
						<tr>
							
							<td class="center  tr_select">
								<?php echo $row->currency_name;?>
							</td>
							<td class="center tr_select ">
                                <?php echo html_entity_decode($row->currency_symbol);?>
							</td>
                            <td class="center tr_select ">
                                <?php echo $row->currency_code;?>
							</td>
                             <td class="center tr_select ">
                                <?php echo $row->currency_value;?>
							</td>
                           
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $currency)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/currency/change_currency_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/currency/change_currency_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
                            
                            
                            
                            
                            <td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $currency)){
								$mode = ($row->default_currency == 'Yes')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Change to No" class="tip_top" href="javascript:confirm_status('admin/currency/change_currency_default/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->default_currency;?></span></a>
							<?php
								}else {	
							?>
								<a title="Change to Yes" class="tip_top" href="javascript:confirm_status('admin/currency/change_currency_default/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->default_currency;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->default_currency;?></span>
							<?php }?>
							</td>
                            
                            
                            
                            
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $currency)){?>
								<span><a class="action-icons c-edit" href="admin/currency/edit_currency_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/currency/view_currency/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $currency)){
							
							if($row->status!='1'){
							
							
							?>
                            	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/currency/delete_currency/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
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
							
							<th>
								 Currency Name
							</th>
							<th class="center">
								Symbol
							</th>
							<th>
								 Currency Code
							</th>
                            
                            <th>
								 Currency Value
							</th>
                            <th>
								 Status
							</th>
                            <th>
								Default Currency
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