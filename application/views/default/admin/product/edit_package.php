<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit PAckage</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					<!-- <li><a href="#tab2">SEO</a></li>-->
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'editcategory_form',  'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/product/EditPack',$attributes) 
					?>
					<div id="tab1">
	 						<ul>
	 							
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="pack_name"> Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="pack_name" id="pack_name" type="text" tabindex="2" class="required large tipTop" title="Please enter the categoryname" value="<?php echo $pack_det->row()->name;?>"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="pack_day"> Days <span class="req">*</span></label>
									<div class="form_input">
										<input name="pack_day" id="pack_day" type="text" tabindex="2" class="required large tipTop" title="Please enter the categoryname" value="<?php echo $pack_det->row()->days;?>"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="pack_amount"> Amount <span class="req">*</span></label>
									<div class="form_input">
										<input name="pack_amount" id="pack_amount" type="text" tabindex="2" class="required large tipTop" title="Please enter the categoryname" value="<?php echo $pack_det->row()->amount;?>"/>
									</div>
								</div>
								</li>
                               
                                
                                	
								
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="7" name="status" id="active_inactive_active" class="active_inactive" <?php if ($pack_det->row()->status == 'Active'){echo 'checked="checked"';}?>  />
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
	                                    <input type="hidden" name="pack_id" value="<?php echo $pack_det->row()->id;?>"/>
    									<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
                       </div>
                    
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>
<script>
$(document).ready(function() {
$("#category_image").change(function(e) {   
	    e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);
        $.ajax({
			beforeSend: function()
 		      {

				 $("#loadedImg").css("display", "block");
      	        document.getElementById("loadedImg").src='images/loader64.gif';
  			  },
            url: 'admin/category/ajax_check_cat_image_size',
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
			$("#loadedImg").css("display", "none");
			  if(data=='Success'){
		      $('#ErrCAtImage').html('Success');
			  } else {
			  $('#ErrCAtImage').html('Upload Image Too Small. Please Upload Image Size More than or Equalto 450 X 450 .');
			  }
		   },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
		
		
});
});
</script>