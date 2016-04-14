<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Package</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					 <!--<li><a href="#tab2">SEO</a></li>-->
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addpack_form',  'enctype' => 'multipart/form-data', 'method' => 'Post');
						echo form_open_multipart('admin/product/insertPack',$attributes) 
					
					?>
                    
                  <!--  <form class="form_container left_label" action="admin/category/insertCategory" id="addcategory_form" method="post" enctype="multipart/form-data">-->
                    
                      <div id="tab1">
	 						<ul>
	 							
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="pack_name"> Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="pack_name" id="pack_name" type="text" tabindex="2" class="required large tipTop" title="Please enter the categoryname"/>
									</div>
								</div>
								</li>
                                
                               <li>
								<div class="form_grid_12">
									<label class="field_title " for="Pack_amount"> Amount <span class="req">*</span></label>
									<div class="form_input">
										<input name="Pack_amount" id="Pack_amount" type="text" tabindex="2" class="required large tipTop number" title="Please enter the categoryname"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="Pack_days"> Days <span class="req">*</span></label>
									<div class="form_input">
										<input name="Pack_days" id="Pack_days" type="text" tabindex="2" class="required large tipTop number" title="Please enter the categoryname"/>
									</div>
								</div>
								</li>
								
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="7" name="status" checked="checked" id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">                                    	
										<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
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
$('#addpack_form').validate();
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
			  return true;
			  } else {
			  $('#ErrCAtImage').html('Upload Image Too Small. Please Upload Image Size More than or Equalto 450 X 450 .');
			  return false;
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