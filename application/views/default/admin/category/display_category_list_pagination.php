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
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/category/change_category_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<div style=" line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('1', $category)){?>
                        
							<div class="btn_30_light" style="height: 29px; text-align:left;">
                           
								<div style=" float:left; margin:0 15px 0 0; line-height:28px; padding:0; color:#FFF; font-family:'OpenSansRegular';" >
                                <input name="checkbox_id[]" type="checkbox" value="0" style="float:left; margin:7px 5px 0;"> Add New Category</div>
								<a href="javascript:void(0)" onclick="return checkBoxCategory();" class="tipTop" title="Select any checkbox and click here to Add Category or Add Subcategory"><span class="icon add_co"></span><span class="btn_link">Add New</span></a>
							</div>
                            

						<?php } ?>
						</div>
					</div>
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $category)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $category)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
					<?php echo $paginationLink; ?>	
						<div class="cateogryView">
						<?php  echo $categoryView; ?>
						</div>
                    <?php echo $paginationLink; ?>    
                        
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
            <input type="hidden" name="SubAdminEmail" id="SubAdminEmail"/>
            <input type="hidden" name="checkboxID" id="checkboxID" />
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<script>
function showCategoryView(val){
	$('#ShowSub_'+val).show();
	$('#ShowCat_'+val).attr('class','dropdown-up');
	$('#ShowCat_'+val).attr('onClick','javascript:showCategoryHide('+val+')');
	$('#ShowCat_'+val).attr('title','ShowUp');
}

function showCategoryHide(val){
	$('#ShowSub_'+val).hide();
	$('#ShowCat_'+val).attr('class','dropdown-button');
	$('#ShowCat_'+val).attr('onClick','javascript:showCategoryView('+val+')');
	$('#ShowCat_'+val).attr('title','ShowDown');
}

</script>


<?php 
$this->load->view('admin/templates/footer.php');
?>