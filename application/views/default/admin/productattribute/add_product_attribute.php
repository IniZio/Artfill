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
						<h6>Add New Attribute</h6>
                        
					</div>
					<div class="widget_content">
					<?php 
						$productattributes = array('class' => 'form_container left_label', 'id' => 'addattribute_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/productattribute/insertAttribute',$productattributes) 
					?>
                    
						<ul>
	
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">Attribute Name <span class="req">*</span></label>
							<div class="form_input">
								<input name="attr_name" id="attr_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the attribute name"/>
                                
							</div>
							</div>
							</li>
                            
                            
                            
                            
                            <li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">You need scaling options?</label>
							<div class="form_input">
							<input type="radio" name="scaling_options" value="Yes" id="scaling_options"  style="float:none;"/>
                            <label for="scaling_options"  style="float:none;">Yes</label>
                            <input type="radio"  name="scaling_options" value="No" id="scaling_options1"  style="float:none;" checked="checked"/>
                            <label for="scaling_options1"  style="float:none;">No</label>
                              <span> &nbsp; &nbsp; &nbsp; &nbsp; <b>Example:</b> &nbsp; Cm,Mm,L,Ml,inches,pounds,Grams,etc...</span>  
							</div>
							</div>
							</li>
                            
                            
                            
                            <li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">Attribute Options</label>
							
                            
                            
                            
	 			<!-- <textarea name="attr_options" id="attr_options" style="width:370px;" class="required large tipTop"  tabindex="2" title="Please enter attribute options"></textarea>-->
                 <input name="attr_options" type="hidden" id="attr_options"> <!-- only disabled for demonstration purposes -->
           
                   <ul id="singleFieldTags"></ul>
                      

							
							</div>
							</li>
						
                        	
							<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="11" name="status" checked="checked" id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="9"><span>Submit</span></button>
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