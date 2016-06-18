<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
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
                                <input name="sel_checkbox[]" type="checkbox" value="0" style="float:left; margin:7px 5px 0;"> Add New Category</div>
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
						<div class="cateogryView">
						<?php  echo $categoryView; ?>
						</div>
                        
                        
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