<?php 
$this->load->view('admin/templates/header.php');
$this->load->model('seller_model');
extract($privileges);
?>
<script>
function change_featured_shop(val) {
		var shopid=val.id;
		var fstatus=$("#"+shopid).is(':checked') ? 1 : 0;  
		$.get('site/shop/change_featuredShop_ajax?shop_id='+shopid+'&fstatus='+fstatus, function(data) {
		});
}
</script>
<script>
$(document).ready(function(){
	$(".page_title").hide();
});
</script>

<style>
	ul.tsc_pagination { margin:4px 0; padding:0px; height:100%; overflow:hidden; font:12px 'Tahoma'; list-style-type:none; float:right; }
	ul.tsc_pagination li { float:left; margin:0px; padding:0px; margin-left:5px; }

	ul.tsc_pagination li a { color:black; display:block; text-decoration:none; padding:7px 10px 7px 10px; }


	ul.tsc_paginationA li a { color:#FFFFFF; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; }

	ul.tsc_paginationA01 li a { color:#474747; border:solid 1px #B6B6B6; padding:6px 9px 6px 9px; background:#E6E6E6; background:-moz-linear-gradient(top, #FFFFFF 1px, #F3F3F3 1px, #E6E6E6); background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #FFFFFF), color-stop(0.02, #F3F3F3), color-stop(1, #E6E6E6)); }
	ul.tsc_paginationA01 li:hover a,
	ul.tsc_paginationA01 li.current a { background:#FFFFFF; }
</style>

<div id="content">
		<div class="grid_container">
		
		<div style="display:none;">
		<a href="admin/shop/display_shop"><div class="grid_6" style="width:20%;">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"><span style="display: none;"></span><canvas width="16" height="16"></canvas></span>
						<h6>Total</h6>
					</div>
					<div class="widget_content">
						<div class="stat_block">
							<h4><?php echo $shopCount;?></h4>
						</div>
					</div>
				</div>
			</div></a>
			
			<a href="admin/shop/display_shop?status=active"><div class="grid_6" style="width:20%;">
				<div class="widget_wrap">
					<div class="widget_top" <?php if($_GET['status'] == 'active'){ ?> style="background:#BE3B0A none repeat scroll 0 0" <?php }?>>
						<span class="h_icon graph"><span style="display: none;"></span><canvas width="16" height="16"></canvas></span>
						<h6>Active</h6>
					</div>
					<div class="widget_content">
						<div class="stat_block">
							<h4><?php echo $activeCount;?></h4>
						</div>
					</div>
				</div>
			</div>
			</a>
			
			<a href="admin/shop/display_shop?status=inactive"><div class="grid_6" style="width:20%;">
				<div class="widget_wrap">
					<div class="widget_top" <?php if($_GET['status'] == 'inactive'){ ?> style="background:#BE3B0A none repeat scroll 0 0" <?php }?>>
						<span class="h_icon graph"><span style="display: none;"></span><canvas width="16" height="16"></canvas></span>
						<h6>InActive</h6>
					</div>
					<div class="widget_content">
						<div class="stat_block">
							<h4><?php echo $inactiveCount;?></h4>
						</div>
					</div>
				</div>
			</div></a>
			
			<a href="admin/shop/display_shop?status=waiting"><div class="grid_6" style="width:auto;">
				<div class="widget_wrap">
					<div class="widget_top" <?php if($_GET['status'] == 'waiting'){ ?> style="background:#BE3B0A none repeat scroll 0 0" <?php }?>>
						<span class="h_icon graph"><span style="display: none;"></span><canvas width="16" height="16"></canvas></span>
						<h6>Waiting for approval</h6>
					</div>
					<div class="widget_content">
						<div class="stat_block">
							<h4><?php echo $waitingCount;?></h4>
						</div>
					</div>
				</div>
			</div></a>
			
<!-- 	<a href="admin/shop/display_shop?status=deleted"><div class="grid_6" style="width:20%;">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"><span style="display: none;"></span><canvas width="16" height="16"></canvas></span>
						<h6>Deleted</h6>
					</div>
					<div class="widget_content">
						<div class="stat_block">
							<h4><?php echo $deletedCount;?></h4>
						</div>
					</div>
				</div>
			</div></a> -->
	</div>		
			
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/shop/change_shop_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						
						<select id="stats" >
							<option value="admin/shop/display_shop">Total shops (<?php echo $shopCount;?>)</option>
							<option <?php if($_GET['status'] == 'active'){ ?>selected<?php }?> value="admin/shop/display_shop?status=active">Active shops (<?php echo $activeCount;?>)</option>
							<option <?php if($_GET['status'] == 'inactive'){ ?>selected<?php }?> value="admin/shop/display_shop?status=inactive">InActive shops (<?php echo $inactiveCount;?>)</option>
							<option <?php if($_GET['status'] == 'waiting'){ ?>selected<?php }?> value="admin/shop/display_shop?status=waiting">Waiting For Approval (<?php echo $waitingCount;?>)</option>
						</select>
						
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $shop)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to publish records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to unpublish records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $shop)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<?php echo $paginationLink; ?>
						<table class="display display_tbl" id="">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 Shop Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Featured Shop
							</th>
							<th class="tip_top" title="Click to sort">
								 Owner Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Created Date
							</th>
							<th class="tip_top" title="Click to sort">
								 Shop Payments
							</th>	
							<th class="tip_top" title="Click to sort" >
								Feature Shop
							</th>
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
						//echo '<pre>';
						//print_r($shopDetails); die; 
						if (count($shopDetails) > 0){
							foreach ($shopDetails as $details){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $details['id'];?>">
							</td>
							<td class="center">
								<?php htmlspecialchars(strip_tags($details['seller_businessname']));?>
							</td>
                            
                            
							<td class="center">
							<input type="checkbox" id="<?php echo $details['seller_id'];?>" name="featured_shop" <?php if($details['featured_shop'] == 'Yes') { echo 'checked="checked"';}?> onchange="return change_featured_shop(this);" >
							</td>
                            
                            
 			  <td class="center">
								<?php echo $details['seller_firstname'];?>
							</td>
							<td class="center">
								<?php echo date("d-m-Y",strtotime($details['created']));?>
							</td>
							<td class="center">
                            	<?php if($details['status']=='active' && $details['seller_id'] != 1){ ?>
                                <?php $query="SELECT id  FROM ".PRODUCT." WHERE pay_status='Paid' and user_id='".$details['seller_id']."' group by pay_date"; 
								
								#echo '<pre>'; echo $this->db->last_query(); 
									$result=$this->seller_model->ExecuteQuery($query); ?>
                                <a title="Click to view" class="tip_top" href="admin/shop/view_shop_transaction/<?php echo $details['seller_id'];?>">View Transactions (<?php echo $result->num_rows(); ?>)</a>
                                <?php }elseif($details['status']=='inactive'){ ?>
                                <a>No Transactions</a>
                                <?php } ?>
                            </td><td class = "center">
								<?php if ($allPrev == '1' || in_array('2', $shop)){
								$mode = ($details['featured_shop'] == 'Yes')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to Unfeature" class="tip_top" href="javascript:confirm_status('admin/shop/change_featuredShop_ajax?shop_id=<?php echo $details['seller_id']; ?>&fstatus=0');"><span class="badge_style b_done">Feature</span></a>
							<?php
								}else {	 
							?>
								<a title="Click to Feature" class="tip_top" href="javascript:confirm_status('admin/shop/change_featuredShop_ajax?shop_id=<?php echo $details['seller_id']; ?>&fstatus=1');"><span class="badge_style">Unfeature</span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->seller_promote;?></span>
							<?php }?>
								<!--<input type="checkbox" id="<?php echo $details['seller_id'];?>" name="featured_shop" <?php if($details['featured_shop'] == 'Yes') { echo 'checked="checked"';}?> onchange="return change_featured_shop(this);" >-->
							</td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $shop)){
								$mode = ($details['status'] == 'active')?'0':'1';
								$modeView = ($details['status'] == 'active')?'inactive':'active';
								$modeViewDisplay = ($details['status'] == 'active')?'active':'Inactive';
								
								
								if($details['status'] == 'waiting'){
									$mode = '1';
									$modeView = 'active';
									$modeViewDisplay = 'waiting';
								}
								
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/shop/change_shop_status/<?php echo $mode;?>/<?php echo $details['id'];?>');"><span class="badge_style b_done"><?php echo $modeViewDisplay;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/shop/change_shop_status/<?php echo $mode;?>/<?php echo $details['id'];?>')"><span class="badge_style"><?php echo $modeViewDisplay;?></span></a>
							<?php 
								}
							}else {
								if($details['status']=='active'){
							?>
							<span class="badge_style b_done"><?php echo $details['status'];?></span>
                            <?php }elseif($details['status']=='inactive'){ ?>
                            <span class="badge_style"><?php echo $details['status'];?></span>
                            <?php }elseif($details['status']=='waiting'){ ?>
                            <span class="badge_style"><?php echo $details['status'];?></span>
							<?php } }?>
							</td>
							<td class="center">
							
                            <span><a class="action-icons c-suspend" href="admin/shop/view_shop/<?php echo $details['id'].'-'.$details['seller_id'];?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $shop)){ if($details['id'] != '1'){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/shop/delete_shop/<?php echo $details['id'];?>')" title="Delete">Delete</a></span>
							<?php }}?>
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
							<th>
								Shop Name
							</th>
						<th class="tip_top" title="Click to sort">
								 Featured Shop
							</th>
							<th>
								  Owner Name
							</th>
							<th>
								 Created Date
							</th>
							<th class="tip_top" title="Click to sort">
								 Shop Payments
							</th>
							<th>
								Status
							</th>
							<th>
								 Action
							</th>
						</tr>
						</tfoot>
						</table>
						<?php echo $paginationLink; ?>
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
<script>
 $(document).ready(function(){
    $("#stats").change(function () {
    	window.location.href = this.options[this.selectedIndex].value;
        });
  });
 </script>
<?php 
$this->load->view('admin/templates/footer.php');
?>
