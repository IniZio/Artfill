<?php
$this->load->view('admin/templates/header.php');
?>

<link href="css/default/attribute/jquery.tagit.css" rel="stylesheet" type="text/css">
     <link href="css/default/attribute/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
   
    <script src="js/attribute/tag-it.js" type="text/javascript" charset="utf-8"></script>
<script>
        $(function(){
            var sampleTags = [];
            $('#singleFieldTags').tagit({
                availableTags: sampleTags,
                // This will make Tag-it submit a single form value, as a comma-delimited field.
                singleField: true,
                singleFieldNode: $('#attr_options')
            });

        });
    </script>


<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Attribute</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'edituser_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/productattribute/EditAttribute',$attributes) 
					?>
	 			
                <ul>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">Attribute Name <span class="req">*</span></label>
							<div class="form_input">
								<input name="attr_name" id="attr_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the attribute name" value="<?php echo $attribute_details->row()->attr_name;?>"/> 
							</div>
							</div>
							</li>
                            
                            
                            <li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">You need scaling options?</label>
							<div class="form_input">
							<input type="radio" name="scaling_options" value="Yes" id="scaling_options" <?php if($attribute_details->row()->scaling_option == 'Yes') { echo 'checked="checked"'; }?> style="float:none;"/>
                            <label for="scaling_options"  style="float:none;">Yes</label>
                            <input type="radio"  name="scaling_options" value="No" <?php if($attribute_details->row()->scaling_option == 'No') { echo 'checked="checked"'; }?> id="scaling_options1"  style="float:none;" />
                            <label for="scaling_options1"  style="float:none;">No</label>
                              <span> &nbsp; &nbsp; &nbsp; &nbsp; <b>Example:</b> &nbsp; Cm,Mm,L,Ml,inches,pounds,Grams,etc...</span>  
							</div>
							</div>
							</li>
                            
                            
                            <li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">Attribute Options </label>
							
                            
                            
                            <input name="attr_options" type="hidden" value="<?php echo $attribute_details->row()->attr_options;?>" id="attr_options"> <!-- only disabled for demonstration purposes -->
           
                   <ul id="singleFieldTags"></ul>
                            
<!--<textarea name="attr_options" id="attr_options" style="width:370px;" class="required large tipTop"  tabindex="2" title="Please enter attribute options">
<?php echo $attribute_details->row()->attr_options;?></textarea>
                      -->
								
							
							</div>
							</li>

								<li>
								<div class="form_grid_12">
									<div class="form_input">
								<input type="hidden" name="attribute_id" value="<?php echo $attribute_details->row()->id;?>"/>                                    
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
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