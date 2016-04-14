<?php 
$this->load->view('admin/templates/header.php');

?>

<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Product</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					 <li><a href="#tab2">Category</a></li>
               					 <li><a href="#tab3">Images</a></li>
                					 <li><a href="#tab4">Shipping</a></li>
             					 <!--<li><a href="#tab5">SEO</a></li>-->
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addproduct_form');
						echo form_open('admin',$attributes) ;
/*						$optionsArr = unserialize($product_details->row()->option);
						if (is_array($optionsArr) && count($optionsArr)>0){
							$options = 'available';
							$attNameArr = $optionsArr['attribute_name'];
							$attValArr = $optionsArr['attribute_val'];
							$attWeightArr = $optionsArr['attribute_weight'];
							$attPriceArr = $optionsArr['attribute_price'];
						}else {
*/							$options = '';
//						}
						$list_names = $product_details->row()->list_name;
						$list_names_arr = explode(',', $list_names);
						$list_values = $product_details->row()->list_value;
						$list_values_arr = explode(',', $list_values);
						$imgArr = explode(',', $product_details->row()->image);
					?>
                    
                     <div id="tab1">
						<ul>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="product_name">Product Name </label>
							<div class="form_input">
								<?php 
								if ($product_details->row()->product_name != ''){
									echo $product_details->row()->product_name;
								}else {
									echo 'Not available';
								}
								?>
							</div>
							</div>
							</li>
						
                        	
	 						<li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Description</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->description != ''){
									echo $product_details->row()->description;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>

	 						<li>
								<div class="form_grid_12">
								<label class="field_title" for="description">About This Item</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->made_by != ''){
									if ($product_details->row()->made_by == 1){
									echo 'A Handmade item';
									} else if ($product_details->row()->made_by == 2){
									echo 'A Vintage item';
									} else { 
									echo 'A Craft supply';
									}
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Item Condition</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->product_condition != ''){
									if ($product_details->row()->product_condition == 1){
									echo 'A finished product';
									} else {
									echo 'A supply or tool to make things';
									}
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Item Maked On</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->maked_on != ''){
									echo str_replace(',','-',$product_details->row()->maked_on);
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="quantity">Quantity</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->quantity != ''){
									echo $product_details->row()->quantity;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            
                            <!--<li>
								<div class="form_grid_12">
								<label class="field_title" for="shipping_type">Immediate Shipping</label>
								<div class="form_input">
                                <?php 
									echo $product_details->row()->ship_immediate;
								?>
								</div>
								</div>
							</li>-->
                            <?php if(count($shiptoDetail) != 0) {?>
                           <!-- <li>
								<div class="form_grid_12">
								<label class="field_title" for="shipping_type">Shipping Details</label>
								<div class="form_input">
                                <?php 
								if ($product_details->row()->shipping_cost != ''){
									echo $product_details->row()->shipping_cost;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>-->
                            <?php }?>
                             <li>
								<div class="form_grid_12">
								<label class="field_title" for="taxable_type">Tags</label>
								<div class="form_input">
                                <?php 
								if ($product_details->row()->tag != ''){
									echo $product_details->row()->tag;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
								
							  <li>
								<div class="form_grid_12">
								<label class="field_title" for="sku">Materials</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->materials != ''){
									echo $product_details->row()->materials;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            
                             <!-- <li>
								<div class="form_grid_12">
								<label class="field_title" for="weight">Weight</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->weight != ''){
									echo $product_details->row()->weight;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>-->
                            
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Price</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->price == 0.00){
									echo 'This item using multiple of pricing based on the variations';
								}else {
									echo "$". $product_details->row()->price;
								}
								?>
								</div>
								</div>
							</li>
                            
                            <!-- <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Sale Price</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->sale_price != ''){
									echo $product_details->row()->sale_price;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>-->
                            
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status </label>
									<div class="form_input">
										<?php 
										if ($product_details->row()->status != ''){
											echo $product_details->row()->status;
										}else {
											echo 'Not available';
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/product/display_product_list" class="tipLeft" title="Go to product list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
							</ul>
                     </div>
                      <div id="tab2">
	                      <ul id="AttributeView">
                      
                     <li>
							            <div style="margin:12px;">
								<?php 
								if ($catList->num_rows()>0){
									foreach ($catList->result() as $catRow){
										echo '- '.$catRow->cat_name.'<p></p>';
									}
								}else {
									echo 'Not available';
								}
								?>
						</div>
						</li>
                           <li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/product/display_product_list" class="tipLeft" title="Go to product list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>     
                      </ul>          
                      </div>
                      <div id="tab3">
									<ul>
										<?php 
										if (count($imgArr)>0){
											foreach ($imgArr as $img){
												if ($img != ''){
										?>
										<li style="float: left;">
										<div class="widget_thumb" style="margin-left: 2%;width:100px;height:100px;">
										 	<img width="100px" height="100px" src="<?php echo base_url();?>images/product/thumb/<?php echo $img;?>" />
										</div>
										</li>
										<?php 
												}
											}
										}else {
										?>
										<li>
										<div class="widget_thumb" style="margin-left: 25%;">
										 	<img width="40px" height="40px" src="<?php echo base_url();?>images/product/dummyProductImage.jpg" />
										</div>
										</li>
										<?php }?>
										</ul>
								<ul>
                           <li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/product/display_product_list" class="tipLeft" title="Go to product list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>     
                      </ul>          
                      </div>
                       
                      <div id="tab4">
                      
                      <ul id="AttributeView">
                      
                      <li>
								<div class="form_grid_12">
								<label class="field_title" for="weight">Processing Time</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->ship_duration != ''){
									echo $product_details->row()->ship_duration;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
						</li>
                         <li>
                                <div class="form_grid_12">
                                <label class="field_title" for="weight">ship from</label>
                                <div class="form_input">
                                <?php 
                                if ($product_details->row()->ship_from != ''){
                                    echo $product_details->row()->ship_from;
                                }else {
                                    echo 'Not available';
                                }
                                ?>
                                </div>
                                </div>
                        </li>
                      
                     <li style="padding:0px;">
							            <div>
							            <?php 
						//	            if ($options != '' && is_array($attNameArr) && count($attNameArr)>0){
							            if (count($shiptoDetail)>0){
							            ?>
							            <table class="wtbl_list">
							            	<tr>
							            		<th>Ship to</th>
							            		<th>Cost</th>
                                                <th>Cost with another item</th>
							            	</tr>
							            	<?php //for ($i=0;$i<count($attNameArr);$i++){
							            		
											foreach ($shiptoDetail as $ship){
							            	?>
							            	<tr>
							            		<td><?php echo $ship->ship_name;?></td> 
							            		<td><?php echo"$".round($ship->ship_cost,2);?></td>
                                                <td><?php echo"$". round($ship->ship_other_cost,2);?></td>
							            	</tr>
							            	<?php }?>
							            </table>
							            <?php 	
							            }else {
							            	echo 'ship details not available';
							            }
							            ?>
							            </div>
									<a href="admin/product/display_product_list" class="tipLeft" title="Go to product list"><span class="badge_style b_done">Back</span></a>
                      </li>

                      
                      </ul>
                      
                      </div>
 
                   <!--   <div id="tab5">
                      <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Meta Title</label>
                    <div class="form_input">
                      <?php 
								if ($product_details->row()->meta_title != ''){
									echo $product_details->row()->meta_title;
								}else {
									echo 'Not available';
								}
								?>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                      <?php 
								if ($product_details->row()->meta_keyword != ''){
									echo $product_details->row()->meta_keyword;
								}else {
									echo 'Not available';
								}
								?>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <?php 
								if ($product_details->row()->meta_description != ''){
									echo $product_details->row()->meta_description;
								}else {
									echo 'Not available';
								}
								?>
                    </div>
                  </div>
                </li>
              </ul>
			          <ul><li><div class="form_grid_12">
				<div class="form_input">
					<a href="admin/product/display_product_list" class="tipLeft" title="Go to product list"><span class="badge_style b_done">Back</span></a>
				</div>
			</div></li></ul>
                      </div> -->
                      
            
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