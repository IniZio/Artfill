<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Category</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					 <li><a href="#tab2">SEO</a></li>
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addcategory_form',  'enctype' => 'multipart/form-data', 'method' => 'Post');
						echo form_open_multipart('admin/category/insertCategory',$attributes) 
					?>
                    
                  <!--  <form class="form_container left_label" action="admin/category/insertCategory" id="addcategory_form" method="post" enctype="multipart/form-data">-->
                    
                      <div id="tab1">
	 						<ul>
	 							
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="category_name">Category Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="category_name" id="category_name" type="text" tabindex="2" class="required large tipTop" title="Please enter the categoryname"/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="category_name">Category Image </label>
									<div class="form_input">
										<input name="category_image" id="category_image" type="file" tabindex="2" class="large tipTop" title="Please upload category image"/>
                                        <img src="" id="loadedImg" style="widows:25px; height:25px; display:none;" />
                                        <div class="error" style="background:white;" id="ErrCAtImage">Note: Image Upload size 450 X 450 Pixels</div>
									</div>
								</div>
								</li>
								
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status </label>
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
                                    	<input type="hidden" name="cat_id" id="cat_id" value="<?php echo $Category_id; ?>"  />
										<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
									</div>
								</div>
								</li>
							</ul>
                       </div>
                      <div id="tab2">
              <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Meta Title</label>
                    <div class="form_input">
                      <input name="meta_title" id="meta_title" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                      <textarea name="meta_keyword" id="meta_keyword"  tabindex="2" class="large tipTop" title="Please enter the page meta keyword"></textarea>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"></textarea>
                    </div>
                  </div>
                </li>
              </ul>
             <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
				</div>
			</div></li></ul>
			</div>
                            
						</form>
					</div>
				</div>
			</div>
			
<!-- 			
<?php if($languagesList->num_rows() > 0 ) {?>
<div class="grid_12">
<div class="widget_wrap">
<ul id="sidenav" class="accordion_mnu collapsible">

<?php foreach($languagesList->result() as $lang){ if($lang->name != 'English'){?>
<li>
		<a style="margin: 0px 0px 0 0px; href="#">
		<div class="widget_top">
				<span class="h_icon list"></span>
				<h6><?php echo $lang->name;?></h6>
		</div>
		</a>
				<ul class="acitem" style="display: none;">
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addcategory_form_'.$lang->lang_code.'',  'enctype' => 'multipart/form-data', 'method' => 'Post');
						echo form_open_multipart('admin/category/insertCategory',$attributes) 
					
					?>				
	 						<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="category_name">Category Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="category_name" id="category_name<?php echo "_".$lang->lang_code; ?>" type="text" tabindex="2" class="required large tipTop" title="Please enter the categoryname" value=""/>
									</div>
								</div>
								</li>
                                
								<li>
				                  <div class="form_grid_12">
				                    <label class="field_title" for="meta_title">Meta Title</label>
				                    <div class="form_input">
				                      <input name="meta_title" id="meta_title<?php echo "_".$lang->lang_code; ?>" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title" value=""/>
				                    </div>
				                  </div>
				                </li>
				                <li>
				                  <div class="form_grid_12">
				                    <label class="field_title" for="meta_tag">Meta Keyword</label>
				                    <div class="form_input">
				                      <textarea style="width: 97%;" name="meta_keyword" id="meta_keyword<?php echo "_".$lang->lang_code; ?>"  tabindex="2" class="large tipTop" title="Please enter the page meta keyword"></textarea>
				                    </div>
				                  </div>
				                </li>
				                <li>
				                  <div class="form_grid_12">
				                    <label class="field_title" for="meta_description">Meta Description</label>
				                    <div class="form_input">
				                      <textarea style="width: 97%;" name="meta_description" id="meta_description<?php echo "_".$lang->lang_code; ?>" tabindex="3" class="large tipTop" title="Please enter the meta description"></textarea>
				                    </div>
				                  </div>
				                </li>
				              </ul>

				             <ul><li><div class="form_grid_12">
								<div class="form_input">
									<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
								</div>
							</div></li></ul>
						</form>
						</div>
				</ul>
</li>
<?php }}?>

</ul>
</div>
</div>			
		
<?php }?>	
			
			
-->
			
			
			
			
			
			
			
			
			
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