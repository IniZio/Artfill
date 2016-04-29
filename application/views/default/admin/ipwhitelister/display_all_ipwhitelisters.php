<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/ipwhitelist/change_ip_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<?php if ($allPrev == '1' || in_array('3', $sliders)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
					</div>
					<div class="widget_content">
						<table class="display" id="sliders_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
							 IP ADDRESS
							</th>
							
							
							<th>
							Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($white_listers->num_rows() > 0){
							foreach ($white_listers->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<?php echo $row->ip_address;?>
							</td>
							
							
						
						
							<td class="center">
							
								
							<?php if ($allPrev == '1' || in_array('1', $ipmsg)){?>
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/ipwhitelist/delete_ipaddress/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php }?>
							</td>
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
							 IP ADDRESS
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