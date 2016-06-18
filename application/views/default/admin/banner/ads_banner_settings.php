<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/banner/',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('1', $banner)){?>
                        
							<!--<div class="btn_30_light" style="height: 29px; text-align:left;">
								<a href="admin/banner/add_banner_form" class="tipTop" title="Click here to Add New Banner"><span class="icon add_co"></span><span class="btn_link">Add New</span></a>
							</div>-->
                            

						<?php } ?>
						<?php /*if ($allPrev == '1' || in_array('2', $banner)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Publish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to publish records"><span class="icon accept_co"></span><span class="btn_link">Publish</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Unpublish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to unpublish records"><span class="icon delete_co"></span><span class="btn_link">Unpublish</span></a>
							</div>
						<?php 
						}*/
						/*if ($allPrev == '1' || in_array('3', $banner)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }*/?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="banner_tbl">
						<thead>
						<tr>
							<!--<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>-->
							<th class="tip_top" title="Click to sort">
								Ad Area
							</th>
							<th class="tip_top" title="Click to sort">
								Source type
							</th>
							<th>
								 Ad Image
							</th>
							<?php /*?><th class="tip_top" title="Click to sort">
								 Banner Link
							</th><?php */?>
							<th class="tip_top" title="Click to sort">
								Status
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($adSetting->num_rows() > 0){
							foreach ($adSetting->result() as $row){
						?>
						<tr>
							<!--<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>-->
							<td class="center">
								<?php echo $row->ad_area;?>
							</td>
							<td class="center">
								<?php echo $row->ad_type;?>
							</td>
							<td class="center">
							<?php if($row->ad_type=='Image') { ?>
								<img src="images/adsimage/<?php echo $row->ad_image;?>" width="100"/>
								<?php } else { ?>
								
								<?php echo "Its a Script Image will be called Directly"; } ?>
								</td>
							<?php /*?><td class="center">
								<?php echo $row->link;?>
							</td><?php */?>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $banner)){
							$mode = ($row->status == 'Publish')?'0':'1';
							if ($mode == '0'){
							 ?>
							<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/banner/change_ads_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php } else { ?>
							<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/banner/change_ads_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php }  } ?>
							<?php 
							#if ($allPrev == '1' || in_array('2', $banner)){
								#$mode = ($row->status == 'Publish')?'0':'1';
								#if ($mode == '0'){
							?>
								<!--<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/banner/change_ads_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								#}else {	
							?>
								<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/banner/change_banner_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								#}
							#}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php #}?>-->
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $banner)){?>
								<span><a class="action-icons c-edit" href="admin/banner/edit_ads/<?php echo $row->id;?>" title="Edit">Edit</a></span>
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
							<!--<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>-->
							<th>
								Ad Area
							</th>
							<th>
								Source Type 
							</th>
							<th>
								 Ad Image
							</th>
							<?php /*?><th>
								 Banner Link
							</th><?php */?>
							<th>
								Status
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