<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>

<style>
	ul.tsc_pagination { margin:4px 0; padding:0px; height:100%; overflow:hidden; font:12px 'Tahoma'; list-style-type:none; float:right; }
	ul.tsc_pagination li { float:left; margin:0px; padding:0px; margin-left:5px; }

	ul.tsc_pagination li a { color:black; display:block; text-decoration:none; padding:7px 10px 7px 10px; }


	ul.tsc_paginationA li a { color:#FFFFFF; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; }

	ul.tsc_paginationA01 li a { color:#474747; border:solid 1px #B6B6B6; padding:6px 9px 6px 9px; background:#E6E6E6; background:-moz-linear-gradient(top, #FFFFFF 1px, #F3F3F3 1px, #E6E6E6); background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #FFFFFF), color-stop(0.02, #F3F3F3), color-stop(1, #E6E6E6)); }
	ul.tsc_paginationA01 li:hover a,
	ul.tsc_paginationA01 li.current a { background:#FFFFFF; }
</style>
<script>
$(document).ready(function(){
	$(".page_title").hide();
});
</script>

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
						<select id="stats" >
							<option value="admin/users/display_user_list">Total users(<?php echo $UsersCount;?>)</option>
							<option <?php if($_GET['status'] == 'active'){ ?>selected<?php }?> value="admin/users/display_user_list?status=active">Active Users (<?php echo $activeCount;?>)</option>
							<option <?php if($_GET['status'] == 'inactive'){ ?>selected<?php }?> value="admin/users/display_user_list?status=inactive">InActive Users (<?php echo $inactiveCount;?>)</option>
							<option <?php if($_GET['status'] == 'deleted'){ ?>selected<?php }?> value="admin/users/display_user_list?status=deleted">Deleted (<?php echo $deletedCount;?>)</option>
						</select>
					<?php 	/* <div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $user)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $user)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?> */?>
						</div>
					</div>
					<div class="widget_content">
						<?php echo $paginationLink; ?>
						<table class="display" id="">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort" style="width:85px !important">
								 Full Name
							</th>
							<th class="tip_top" title="Click to sort">
								 User Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Email
							</th>
							<th style="width:90px !important">
								Thumbnail
							</th>
<!-- 							<th class="tip_top" title="Click to sort">
								User Type
							</th>
 -->							<th class="tip_top" title="Click to sort">
								Last Login Date
							</th>
							<th class="tip_top" title="Click to sort" style="width:100px !important">
								Last Login IP
							</th>
							<th class="tip_top" title="Click to sort" style="width:100px !important">
								Last Login Using
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
						if ($usersList->num_rows() > 0){
							foreach ($usersList->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<?php echo $row->full_name;?>
							</td>
							<td class="center">
								<?php echo $row->user_name;?>
							</td>
							<td class="center">
								<?php echo $row->email;?>
							</td>
							<td class="center">
							<div class="widget_thumb">
							<?php if ($row->thumbnail != ''){?>
								 <img width="40px" height="40px" src="<?php echo base_url();?>images/users/<?php echo $row->thumbnail;?>" />
							<?php }else {?>
								 <img width="40px" height="40px" src="<?php echo base_url();?>images/users/user-thumb1.png" />
							<?php }?>
							</div>
							</td>
<!-- 							<td class="center">
								<?php //if ($row->group == 'User'){?>
								<span class="badge_style b_high"><?php //echo $row->group;?></span>
								<?php //}else {?>
								<span class="badge_style b_away"><?php //echo 'User / '.$row->group;?></span>
								<?php //}?>
							</td>
 -->							<td class="center">
								 <?php echo $row->last_login_date;?>
							</td>
							<td class="center">
								<?php echo $row->last_login_ip;?>
							</td>
							<td class="center">
								<?php echo $row->loginUserType;?>
							</td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $user)){
								if($row->status == 'Active'){
									$mode = 0;
								}elseif($row->status == 'Inactive'){
									$mode = 1;
								}else{
									$mode = 2;
								}
									
								//$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/users/change_user_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else if ($mode == '1'){ 	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/users/change_user_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}else{ ?>
									<span class="badge_style"><?php echo $row->status;?></span>
								<?php }
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $user)){?>
								<span><a class="action-icons c-edit" href="admin/users/edit_user_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/users/view_user/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $user)){?>	
	                            <?php if($row->status != 'Deleted'){ if($row->id != '1'){ ?>
                                
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/users/delete_user/<?php echo $row->id;?>/<?php echo $row->group;?>')" title="Delete">Delete</a></span>
							<?php }}}?>
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
								 Full Name
							</th>
							<th>
								 User Name
							</th>
							<th>
								 Email
							</th>
							<th>
								Thumbnail
							</th>
<!-- 							<th>
								User Type
							</th>
 -->							<th>
								Last Login Date
							</th>
							<th>
								Last Login IP
							</th>
							<th>
								Last Login Using
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