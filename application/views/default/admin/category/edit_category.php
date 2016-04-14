<?php
$this->load->view('admin/templates/header.php');
?>
<style>
.langli{
    height: 39px;
    border-bottom: #e1e1e1 1px solid;
    background: #424242;
}
</style>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Category</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					 <li><a href="#tab2">SEO</a></li>
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'editcategory_form',  'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/category/EditCategory',$attributes) 
					?>
					<div id="tab1">
	 						<ul>
	 							
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="category_name">Category Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="category_name" id="category_name" type="text" tabindex="2" class="required large tipTop" title="Please enter the categoryname" value="<?php echo $category_details->row()->cat_name;?>"/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="category_name">Category Image </label>
									<div class="form_input">
										<input name="category_image" id="category_image" type="file" tabindex="2" class="large tipTop" title="Please upload category image"/>
                                       <img src="" id="loadedImg" style="widows:25px; height:25px; display:none;" />
                                        <div class="error" id="ErrCAtImage">Note: Image Upload size 450 X 450 Pixels</div>
									</div>
								</div>
								</li>
                                
                                	<?php if($category_details->row()->image !=''){?>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="category_name">&nbsp; </label>
									<div class="form_input">
                                    	<img src="<?php echo CATEGORY_PATH.$category_details->row()->image;?>" alt="<?php echo $category_details->row()->cat_name;?>" width="100" />

									</div>
								</div>
								</li>
                                
                                <?php }?>
								
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="7" name="status" id="active_inactive_active" class="active_inactive" <?php if ($category_details->row()->status == 'Active'){echo 'checked="checked"';}?>  />
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Mega Menu <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="radio" tabindex="7" name="sub_mega_menu" id="sub_mega_menu" <?php if($category_details->row()->sub_mega_menu == "Yes"){ echo "Checked"; }?> value="Yes"> Yes
											<input type="radio" tabindex="7" name="sub_mega_menu" id="sub_mega_menu" <?php if($category_details->row()->sub_mega_menu == "No"){ echo "Checked"; }?> value="No"> No
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
	                                    <input type="hidden" id="category_id" name="category_id" value="<?php echo $category_details->row()->id;?>"/>
    									<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
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
                      <input name="meta_title" id="meta_title" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title" value="<?php echo $category_details->row()->seo_title;?>"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                      <textarea name="meta_keyword" id="meta_keyword"  tabindex="2" class="large tipTop" title="Please enter the page meta keyword"><?php echo $category_details->row()->seo_keyword;?></textarea>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"><?php echo $category_details->row()->seo_description;?></textarea>
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
			
			
			
<?php if($languagesList->num_rows() > 0 ) {?>
<div class="grid_12">
<div class="widget_wrap">
<ul id="language_cat" class="accordion_mnu collapsible">

<?php foreach($languagesList->result() as $lang){ if($lang->name != 'English'){?>
<li>
		<a style="margin: 0px 0px 0 0px; href="#">
		<div class="widget_top" onclick="getCatLang(this,'<?php echo $lang->lang_code;?>')">
				<span class="h_icon list"></span>
				<h6><?php echo $lang->name;?></h6>
		</div>
		</a>
				<ul class="acitem" style="display: none;">
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'editcategory_form_'.$lang->lang_code.'',  'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/category/EditCategory',$attributes) 
					?>					
	 						<ul>
	 							
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="category_name">Category Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="category_name" id="category_name<?php echo "_".$lang->lang_code; ?>" type="text" tabindex="2" class="required large tipTop" title="Please enter the categoryname" value="<?php echo $category_details->row()->cat_name;?>"/>
									</div>
								</div>
								</li>
                                
								<li>
				                  <div class="form_grid_12">
				                    <label class="field_title" for="meta_title">Meta Title</label>
				                    <div class="form_input">
				                      <input name="meta_title" id="meta_title<?php echo "_".$lang->lang_code; ?>" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title" value="<?php echo $category_details->row()->seo_title;?>"/>
				                    </div>
				                  </div>
				                </li>
				                <li>
				                  <div class="form_grid_12">
				                    <label class="field_title" for="meta_tag">Meta Keyword</label>
				                    <div class="form_input">
				                      <textarea style="width: 97%;" name="meta_keyword" id="meta_keyword<?php echo "_".$lang->lang_code; ?>"  tabindex="2" class="large tipTop" title="Please enter the page meta keyword"><?php echo $category_details->row()->seo_keyword;?></textarea>
				                    </div>
				                  </div>
				                </li>
				                <li>
				                  <div class="form_grid_12">
				                    <label class="field_title" for="meta_description">Meta Description</label>
				                    <div class="form_input">
				                      <textarea style="width: 97%;" name="meta_description" id="meta_description<?php echo "_".$lang->lang_code; ?>" tabindex="3" class="large tipTop" title="Please enter the meta description"><?php echo $category_details->row()->seo_description;?></textarea>
				                    </div>
				                  </div>
				                </li>
				              </ul>
				              
				              <input type="hidden" id="category_id" name="category_id" value="<?php echo $category_details->row()->id;?>"/>
				              <input type="hidden" name="lang_code" value="<?php echo $lang->lang_code; ?>"/>
				              
				             <ul><li><div class="form_grid_12">
								<div class="form_input">
									<button type="button" onclick="updateCatLang(this,'<?php echo $lang->lang_code;?>')" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
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

function getCatLang(evt,ln){
	var id = $("#category_id").val();
	$.ajax({
		type:'post',
		url:baseURL+'admin/category/getCatLangData',
		data:{'ln':ln,'id':id},
		dataType:"json",
		success: function (json) {
				$("#category_name_"+ln).val(json.cat_name);
				$("#meta_title_"+ln).val(json.seo_title);
				$("#meta_keyword_"+ln).val(json.seo_keyword);
				$("#meta_description_"+ln).val(json.seo_description);
		}
	});
}


function updateCatLang(evt,ln){
	var id = $("#category_id").val();
	var cat_name = $("#category_name_"+ln).val();
	var seo_title = $("#meta_title_"+ln).val();
	var seo_keyword = $("#meta_keyword_"+ln).val();
	var seo_description = $("#meta_description_"+ln).val();
	
	$.ajax({
		type:'post',
		url:baseURL+'admin/category/updateCatLangData',
		data:{'ln':ln,'id':id,'cat_name':cat_name,'seo_title':seo_title,'seo_keyword':seo_keyword,'seo_description':seo_description},
		dataType:"json",
		success: function () {
			window.location.reload();
		}
	});
}
</script>