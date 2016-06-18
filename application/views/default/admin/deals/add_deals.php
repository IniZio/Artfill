<?php
$this->load->view('admin/templates/header.php');
?>
<script>
$(document).ready(function(){
	$('.nxtTab').click(function(){
		var cur = $(this).parent().parent().parent().parent().parent();
		cur.hide();
		cur.next().show();
		var tab = cur.parent().parent().prev();
		tab.find('a.active_tab').removeClass('active_tab').parent().next().find('a').addClass('active_tab');
	});
	$('.prvTab').click(function(){
		var cur = $(this).parent().parent().parent().parent().parent();
		cur.hide();
		cur.prev().show();
		var tab = cur.parent().parent().prev();
		tab.find('a.active_tab').removeClass('active_tab').parent().prev().find('a').addClass('active_tab');
	});
	$('#tab2 input[type="checkbox"]').click(function(){
		var cat = $(this).parent().attr('class');
		var curCat = cat;
		var catPos = '';
		var added = '';
		var curPos = curCat.substring(3);
		var newspan = $(this).parent().prev();
		if($(this).is(':checked')){
			while(cat != 'cat1'){
				cat = newspan.attr('class');
				catPos = cat.substring(3);
				if(cat != curCat && catPos<curPos){
					if (jQuery.inArray(catPos, added.replace(/,\s+/g, ',').split(',')) >= 0) {
					    //Found it!
					}else{
						newspan.find('input[type="checkbox"]').attr('checked','checked');
						added += catPos+',';
					}
				}
				newspan = newspan.prev(); 
			}
		}else{
			var newspan = $(this).parent().next();
			if(newspan.get(0)){
				var cat = newspan.attr('class');
				var catPos = cat.substring(3);
			}
			while(newspan.get(0) && cat != curCat && catPos>curPos){
				newspan.find('input[type="checkbox"]').attr('checked',this.checked);	
				newspan = newspan.next(); 	
				cat = newspan.attr('class');
				catPos = cat.substring(3);
			}
		}
	});
		
});
</script>
<script language="javascript">
function viewAttributes(Val){

	if(Val == 'show'){
		document.getElementById('AttributeView').style.display = 'block';
	}else{
		document.getElementById('AttributeView').style.display = 'none';
	}

}
</script>
<script>
$(document).ready(function(){


	var i = 1;
	
	
	$('#add').click(function() { 
//<!--		$('<div style="float: left; margin: 12px 10px 10px; width:85%;" class="field"><div class="image_text" style="float: left;margin: 5px;margin-right:50px;"><span>Attribute:</span><select name="attribute_name[]" style="width:200px;color:gray;width:206px;" class="chzn-select"><?php //foreach ($atrributeValue->result() as $attrRow){ ?><option value="<?php //echo $attrRow->attribute_name;; ?>"><?php //echo $attrRow->attribute_name; ?></option> <?php //} ?></select></div><div class="attribute_box attrInput" style="float: left;margin: 5px;width: 20%;" ><span>Value :</span><input type="text" style="width:100px;"  name="attribute_val[]" ></div><div class="image_price attrInput" style="float: left;margin: 5px;width: 20%;"><span>Weight :</span><input type="text" style="width:100px;" name="attribute_weight[]" ></div><div class="image_price attrInput" style="float: left;margin: 5px;width: 20%;"><span>Price :</span><input type="text" style="width:100px;" name="attribute_price[]" ></div></div>').fadeIn('slow').appendTo('.inputs');-->
		$('<div style="float: left; margin: 12px 10px 10px; width:85%;" class="field">'+
				'<div class="image_text" style="float: left;margin: 5px;margin-right:50px;">'+
					'<span>List Name:</span>&nbsp;'+
					'<select name="attribute_name[]" onchange="javascript:loadListValues(this)" style="width:200px;color:gray;width:206px;" class="chzn-select">'+
						'<option value="">--Select--</option>'+
						<?php foreach ($atrributeValue->result() as $attrRow){ 
							if (strtolower($attrRow->attribute_name) != 'price'){
						?>
						'<option value="<?php echo $attrRow->id; ?>"><?php echo $attrRow->attribute_name; ?></option>'+
						<?php }} ?>
					 '</select>'+
				'</div>'+
				'<div class="attribute_box attrInput" style="float: left;margin: 5px;" >'+
					 '<span>List Value :</span>&nbsp;'+
					 '<select name="attribute_val[]" style="width:200px;color:gray;width:206px;" class="chzn-select">'+
					 '<option value="">--Select--</option>'+
					 '</select>'+
				'</div>'+
		'</div>').fadeIn('slow').appendTo('.inputs');
		i++;
	});
	
	$('#remove').click(function() {
		$('.field:last').remove();
	});
	
	$('#reset').click(function() {
		$('.field').remove();
		$('#add').show();
		i=0;
	
	
	});
	
	
	var j = 1;
	$('#addAttr').click(function() { 
		$('<div style="float: left; margin: 12px 10px 10px; width:85%;" class="field" id="removefieldAttr'+j+'">'+
				'<div class="image_text" style="float: left;margin: 5px;margin-right:50px;">'+
					'<span style="margin:0 5px 0;">Attribute Type:</span>&nbsp;'+
					'<select name="product_attribute_name[]" style="width:200px;color:gray;width:206px; padding:4px; border:1px solid #D8D8D8;" class="chzn-select">'+
						'<option value="">---------------- Select ----------------</option>'+
						<?php foreach ($PrdattrVal->result() as $prdattrRow){ ?>
						'<option value="<?php echo $prdattrRow->id; ?>"><?php echo $prdattrRow->attr_name; ?></option>'+
						<?php } ?>
					 '</select>'+
				'</div>'+
				'<div class="attribute_box attrInput" style="float: left;margin: 5px; width:410px;" >'+
					 '<span style="margin:8px 7px 0 0; float:left">Attribute Name :</span>&nbsp;'+
					 '<input type="text" name="product_attribute_val[]" style="color:gray; color: #808080; float: left;  width: 250px;" class="chzn-select" />'+
					  '<span><a class="action-icons c-delete" href="javascript:removeAttr('+j+')" title="Delete">Delete</a></span>'+
				'</div>'+
		'</div>').fadeIn('slow').appendTo('.inputss');
		j++;
	});
	
	$('#removeAttr').click(function() {
		$('.field:last').remove();
	});
	
	
	

	var k = 1;
	$('#addShip').click(function() { 
		$('<div style="float: left; margin: 12px 10px 10px; width:85%;" class="fieldShip" id="removefieldShip'+k+'">'+
				'<div class="image_text" style="float: left;margin: 5px;margin-right:50px;">'+
					'<span style="margin:0 5px 0;">Country:</span>&nbsp;'+
					'<select name="ship_country_name[]" class="chzn-select shipselect">'+
						'<option value="">-------- Select --------</option>'+
						<?php foreach ($CntyVal->result() as $CntyRow){ ?>
						'<option value="<?php echo $CntyRow->id.'|'.$CntyRow->seourl; ?>"><?php echo $CntyRow->name; ?></option>'+
						<?php } ?>
					 '</select>'+
				'</div>'+
				'<div class="ShipInput" >'+
					 '<span style="margin:8px 7px 0 0; float:left">Shipping Cost :</span>&nbsp;'+
					 '<input type="text" name="ship_cost_val[]" class="chzn-select shipInputbox" />'+
				'</div>'+
				'<div class="ShipInput">'+
					 '<span style="margin:8px 7px 0 0; float:left">Tax :</span>&nbsp;'+
					 '<input type="text" name="tax_cost_val[]" class="chzn-select shipInputbox" />'+
					 '<span><a class="action-icons c-delete" href="javascript:removeShip('+k+')" title="Delete">Delete</a></span>'+
				'</div>'+
		'</div>').fadeIn('slow').appendTo('.inputship');
		k++;
	});
	
	$('#removeShip').click(function() {
		$('.fieldShip:last').remove();
	});
	
});

function removeShip(val){
	$('#removefieldShip'+val).remove();
}

function removeAttr(val){
	$('#removefieldAttr'+val).remove();
}
</script>

<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Deal</h6>		
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					 <li><a href="#tab2">Category</a></li>
               					 <li><a href="#tab3">Images</a></li>
               					<!-- <li><a href="#tab4">List</a></li>-->
                                 <li><a href="#tab5">Atrribute</a></li>
                                 <li><a href="#tab6">Shipping & Tax</a></li>
               					 <li><a href="#tab7">SEO</a></li>
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addproduct_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/deals/insertEditDeal',$attributes) 
					?>
                    
                     <div id="tab1">
						<ul>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="product_name">Product Name <span class="req">*</span></label>
							<div class="form_input">
								<input name="product_name" id="product_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the product name"/>
							</div>
							</div>
							</li>
						
                        	
	 						<li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Description<span class="req">*</span></label>
								<div class="form_input">
								<textarea name="description" id="description" tabindex="2" style="width:370px;" class="required large tipTop mceEditor" title="Please enter the product description"></textarea>
								</div>
								</div>
							</li>

	 						<li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Excerpt</label>
								<div class="form_input">
								<textarea name="excerpt" id="excerpt" tabindex="3" style="width:370px;" class="large tipTop" title="Please enter the product Excerpt"></textarea>
								</div>
								</div>
							</li>
                            
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="shipping">Shipping<span class="req">*</span></label>
								<div class="form_input">
								<textarea name="shipping" id="shipping" tabindex="2" style="width:370px;" class="required large tipTop mceEditor" title="Please enter the shipping description"></textarea>
								</div>
								</div>
							</li>
                            
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="quantity">Quantity<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="quantity" id="quantity" tabindex="4" class="required large tipTop" title="Please enter the product quantity" />
								</div>
								</div>
							</li>
                            
                             <li>
								<div class="form_grid_12">
								<label class="field_title" for="quantity">Maximum Quantity purchase at a time<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="max_quantity" id="max_quantity" tabindex="4" class="required large tipTop" title="Please enter the Maximum purchase  quantity" value="1" />
								</div>
								</div>
							</li>
                            
                             <li>
								<div class="form_grid_12">
								<label class="field_title" for="shipping_cost"><?php echo $this->config->item('email_title'); ?> Giftccards</label>
								<div class="form_input">
								<input type="radio" name="ship_immediate" value="true" />Yes&nbsp;&nbsp;&nbsp;
								<input type="radio" name="ship_immediate" value="false" checked="checked" />No
								</div>
								</div>
							</li>
                            
                             <!--<li>
								<div class="form_grid_12">
								<label class="field_title" for="shipping_cost">Shipping cost</label>
								<div class="form_input">
                                <input type="text" name="shipping_cost" id="shipping_cost" tabindex="4" class="required large tipTop" title="Please enter the product shipping cost" />
								</div>
								</div>
							</li>
                            
                             <li>
								<div class="form_grid_12">
								<label class="field_title" for="tax_cost">Tax</label>
								<div class="form_input">
                                <input type="text" name="tax_cost" id="tax_cost" tabindex="4" class="required large tipTop" title="Please enter the product tax" />
								</div>
								</div>
							</li>-->
								
							  <li>
								<div class="form_grid_12">
								<label class="field_title" for="sku">SKU</label>
								<div class="form_input">
								<input type="text" name="sku" id="sku" tabindex="7" class="large tipTop" title="Please enter the product sku" />
								</div>
								</div>
							</li>
                            
                              <li>
								<div class="form_grid_12">
								<label class="field_title" for="weight">Weight</label>
								<div class="form_input">
								<input type="text" name="weight" id="weight" tabindex="8" class="large tipTop" title="Please enter the product weight" />
								</div>
								</div>
							</li>
                            
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Price<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="price" id="price" tabindex="9" class="required large tipTop" title="Please enter the product price" />
								</div>
								</div>
							</li>
                            
                             <li>
								<div class="form_grid_12">
								<label class="field_title" for="sale_price">Sale Price<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="sale_price" id="sale_price" tabindex="10" class="required large tipTop" title="Please enter the product sale price" />
								</div>
								</div>
							</li>
                            
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="publish_unpublish">
											<input type="checkbox" tabindex="11" name="status" checked="checked" id="publish_unpublish_publish" class="publish_unpublish"/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
									</div>
								</div>
								</li>
							</ul>
                     </div>
                      <div id="tab2">
	                      <div class="cateogryView">
						<?php  echo $categoryView; ?>
						</div>
                        <ul style="float:left;"><li style="padding-left:0px;width:100%;">
						<div class="form_grid_12">
						<div class="form_input" style="margin:0px;width:100%;">
                        <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                        <input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                        </div>
                        </div>
                        </li></ul>
                      </div>
                      <div id="tab3">
                      <ul>
	                      <li>
								<div class="form_grid_12">
									<label class="field_title" for="product_image">Product Image</label>
									<div class="form_input">
										<input name="product_image[]" id="product_image" type="file" tabindex="7" class="large multi tipTop" title="Please select product image"/><span class="input_instruction green">You Can Upload Multiple Images</span>
									</div>
								</div>
								</li>
                           <li>
								<div class="form_grid_12">
									<div class="form_input">
										<input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
										<input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
									</div>
								</div>
								</li>     
                      </ul>          
                      </div>
                      <!--<div id="tab4">
                      
                      <ul id="AttributeView">
                      
                     <li>
									<div class="inputs" style="float: left;width:100%; border:1px dashed #1DB3F0;">
							            <div style="margin:12px;">
							            	<div class="btn_30_blue">
												<a href="javascript:void(0)" id="add" class="tipTop" title="Add new attribute">
													<span class="icon add_co"></span>
													<span class="btn_link">Add</span>
												</a>
											</div>
								            <div class="btn_30_blue">
												<a href="javascript:void(0)" id="remove" class="tipTop" title="Remove last attribute">
													<span class="icon cross_co"></span>
													<span class="btn_link">Remove</span>
												</a>
											</div>
							            </div>
							        </div>
									
						<div class="form_grid_12">
						<div class="form_input" style="margin:0px;width:100%;">
                        <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                        <input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                        </div>
                        </div>
                       
                      </li>

                      
                      </ul>
                      
                      </div>-->
                      
                      <div id="tab5">
                      
                      <ul id="AttributeView">
                        <li>
							<div class="inputss" style="float: left;width:100%; border:1px dashed #333; margin:0 0 15px;">
								<div style="margin:12px;">
							    	<div class="btn_30_blue">
										<a href="javascript:void(0)" id="addAttr" class="tipTop" title="Add new attribute">
											<span class="icon add_co"></span>
											<span class="btn_link">Add</span>
										</a>
									</div>
								    <div class="btn_30_blue">
										<a href="javascript:void(0)" id="removeAttr" class="tipTop" title="Remove last attribute">
											<span class="icon cross_co"></span>
											<span class="btn_link">Remove</span>
										</a>
									</div>
								</div>
						    </div>
									
						<div class="form_grid_12">
						<div class="form_input" style="margin:0px;width:100%;">
                        <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                        <input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                        </div>
                        </div>
                       
                      </li>

                      
                      </ul>
                      
                      </div>
                      <div id="tab6">
                      	
                      
                      <ul id="AttributeView">
                        <li>
							<div class="inputship" style="float: left;width:100%; border:1px dashed #333; margin:0 0 15px;">
								<div style="margin:12px;">
							    	<div class="btn_30_blue">
										<a href="javascript:void(0)" id="addShip" class="tipTop" title="Add new attribute">
											<span class="icon add_co"></span>
											<span class="btn_link">Add</span>
										</a>
									</div>
								    <div class="btn_30_blue">
										<a href="javascript:void(0)" id="removeShip" class="tipTop" title="Remove last attribute">
											<span class="icon cross_co"></span>
											<span class="btn_link">Remove</span>
										</a>
									</div>
								</div>
						    </div>
									
						<div class="form_grid_12">
						<div class="form_input" style="margin:0px;width:100%;">
                        <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                        <input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                        </div>
                        </div>
                       
                      </li>

                      
                      </ul>
                      
                      </div>
                      <div id="tab7">
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
					<input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
					<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
				</div>
			</div></li></ul>
                      </div>
                      
                    <input type="hidden" name="userID" value="<?php if ($loginID != ''){echo $loginID;}else {echo '0';}?>"/>  
            
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