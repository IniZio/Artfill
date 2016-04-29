<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<link rel="stylesheet" type="text/css" media="all" href="css/default/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/product/change_product_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						
						
						<select id="stats">
							<option value="admin/product/display_product_list">Total products(<?php echo $total_prod; ?>)</option>
							<option <?php if(isset($_GET['status']) && $_GET['status'] == 'Publish' ){ echo "selected"; }?> value="admin/product/display_product_list?status=Publish">Published products (<?php echo $publish_prod;?>)</option>
							<option <?php if(isset($_GET['status']) && $_GET['status'] == 'UnPublish'){ ?>selected<?php }?> value="admin/product/display_product_list?status=UnPublish">UnPublished products (<?php echo $unpublish;?>)</option>	
							<option <?php if(isset($_GET['status']) && $_GET['status'] == 'deleted'){ ?>selected<?php }?> value="admin/product/display_product_list?status=deleted">Deleted products (<?php echo $deleted;?>)</option>
							<option <?php if(isset($_GET['featured']) && $_GET['featured'] == 'yes'){ ?>selected<?php }?> value="admin/product/display_product_list?featured=yes">Featured products (<?php echo $fcount;?>)</option>
<!-- 						<option <?php if(isset($_GET['status']) && $_GET['status'] == 'waiting'){ ?>selected<?php }?> value="admin/product/display_product_list?status=waiting">Products sold(<?php echo $prod_sold;?>)</option> -->
<!-- 						<option <?php if(isset($_GET['status']) && $_GET['status'] == 'waiting'){ ?>selected<?php }?> value="admin/product/display_product_list?status=waiting">Purchased amount (<?php echo $currencySymbol;?><?php echo $prod_pur; ?>)</option>-->
						</select>
						
						
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $product)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Publish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to publish records"><span class="icon accept_co"></span><span class="btn_link">Publish</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('UnPublish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to unpublish records"><span class="icon delete_co"></span><span class="btn_link">UnPublish</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $product)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<div class="product-search">
							<select name="filter_search" class="filter-search" id="filterValue">
								<option value="">-----------Search By----------</option>
								<option value="name" <?php if($this->input->get('fvalue') =='name'){?>selected <?php }?>>Name</option>
								<option value="price" <?php if($this->input->get('fvalue') =='price'){?>selected <?php }?>>Price</option>
								<option value="created" <?php if($this->input->get('fvalue') =='created'){?>selected <?php }?>>Created By</option>
								<option value="qty" <?php if($this->input->get('fvalue') =='qty'){?>selected <?php }?>>Quantity</option>
								<option value="status" <?php if($this->input->get('fvalue') =='status'){?>selected <?php }?>>Status</option>
							</select>
							<input type="text" name="search_value" value="<?php echo $this->input->get('svalue');?>" placeholder="Search" class="search" id="searchValue" <?php if($this->input->get('svalue') == ''){?>style="display:none;" <?php } ?>>
							
							<select name="search_value" class="searchselect" id="priceValue" <?php if($this->input->get('pvalue') == ''){?>style="display:none;" <?php } ?>>
								<option value="">-------Select Price--------</option>
								<option value="0-100" <?php if($this->input->get('pvalue') == '0-100'){?>selected <?php } ?>>0 to 100</option>
								<option value="100-1000" <?php if($this->input->get('pvalue') == '100-1000'){?>selected <?php } ?>>100 to 1000</option>
								<option value="1000-5000" <?php if($this->input->get('pvalue') == '1000-5000'){?>selected <?php } ?>>1000 to 5000</option>
								<option value="5000" <?php if($this->input->get('pvalue') == '5000'){?>selected <?php } ?>>above 5000</option>
							</select>
							
							<select name="search_value" class="searchselect" id="qtyValue" <?php if($this->input->get('qvalue') == ''){?>style="display:none;" <?php } ?>>
								<option value="">-------Select Quantity--------</option>
								<option value="0-10" <?php if($this->input->get('qvalue') == '0-10'){?>selected <?php } ?>>0 to 10</option>
								<option value="10-50" <?php if($this->input->get('qvalue') == '10-50'){?>selected <?php } ?>>10 to 50</option>
								<option value="50-100" <?php if($this->input->get('qvalue') == '50-100'){?>selected <?php } ?>>50 to 100</option>
								<option value="100" <?php if($this->input->get('qvalue') == '100'){?>selected <?php } ?>>above 100</option>
							</select>
							
							<select name="search_value" class="searchselect" id="statusValue" <?php if($this->input->get('stvalue') == ''){?>style="display:none;" <?php } ?>>
								<option value="">-------Select Status--------</option>
								<option value="Publish" <?php if($this->input->get('stvalue') == 'Publish'){?>selected <?php } ?>>Publish</option>
								<option value="Unpublish" <?php if($this->input->get('stvalue') == 'Unpublish'){?>selected <?php } ?>>Unpublish</option>
							</select>
							
							<input name="search_value" id="createdValue" type="text" class="search" value="<?php echo $this->input->get('fromDate');?>" <?php if($this->input->get('fromDate') == ''){?>style="display:none;" <?php } ?>/>
							
							<input name="search_value1" id="createdValue1" type="text" class="search" value="<?php echo $this->input->get('toDate');?>" <?php if($this->input->get('toDate') == ''){?>style="display:none;" <?php } ?>/>
							
							<input type="button" id="search-product" class="search-product" value="search"/>
						</div>
						<?php echo $paginationLink; ?>
					
						<table class="display display_tbl" id="">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="center" style="width:300px !important">
								Feature Product
							</th>
							<th class="tip_top" style="width:300px !important">
								 Product Name
							</th>
							<th class="tip_top">
								 Image
							</th>
							<th style="width:60px !important">
								Price
							</th>
							<th class="tip_top" style="width:80px !important">
								Added By
							</th>
							<th class="tip_top" style="width:80px !important">
								Quantity
							</th>
<!--                             <th class="tip_top" title="Click to sort">
								comments
							</th>
 -->							<th class="tip_top">
								Status
							</th>
							<th class="tip_top">
								Created On
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($productList->num_rows() > 0){
							foreach ($productList->result() as $row){
								$img = 'dummyProductImage.jpg';
								$imgArr = explode(',', $row->image);
								if (count($imgArr)>0){
									foreach ($imgArr as $imgRow){
										if ($imgRow != ''){
											$img = $imgRow;
											break;
										}
									}
								}
						?>
						<tr>
							<td class="center tr_select ">
								<input  id="product_id" type="hidden" value="<?php echo $row->id;?>">
								<input  id="product_name" type="hidden" value="<?php echo $row->product_name;?>">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
								<td class="center">
							<a style="position:relative;"  class=<?php if($row->status != 'Publish') {echo "not-active";}?>   href="javascript:void(0)" id="<?php echo $row->id;?>" name="product_featured" onclick ="change_featured_product(this);" ><span class="badge_style b_done">Feature</span></a>
							<!--<input type="checkbox" style="position:relative;"  id="<?php echo $row->id;?>" name="product_featured" <?php if($row->product_featured == "Yes") { echo 'checked="checked"';}?> onchange="return change_featured_product(this);" >-->
							</td>	
							<td class="center">
								<?php echo $row->product_name;?>
							</td>
							<td class="center">
						 		<div class="widget_thumb" style="margin-left: 25%;">
								 <img width="40px" height="40px" src="<?php echo PRODUCTPATHTHUMB.$img;?>" />
								</div>
							</td>
							<td class="center">
								<?php echo $row->base_price;?>
							</td>
							<td class="center">
							
							   <select class="chzn-select required sellername"  tabindex="-1" name="seller_name" style="width: 275px; display: none;" >
		                      		<option value=""></option>
		                      		<?php foreach ($seller_detail->result() as $row1){?>
		                      		<option value="<?php echo $row1->id;?>" <?php if($row1->user_name == $row->user_name){ echo 'selected="selected"';}?>><?php echo '<b>'.$row1->full_name.'</b> ('.$row1->user_name.')';?></option>
		                      		<?php }?>
		                      </select>
							<?php /*?><td class="center">
								<?php 
								if ($row->user_name != ''){
									echo '<b>'.$row->full_name.'</b> ('.$row->user_name.')';
								}else {
									echo 'Admin';
								}
								?>
							</td><?php */?>
							<td class="center">
								 <?php echo $row->quantity;?>
							</td>
<!--                            <td class="center">
								 <a href="admin/comments/view_product_comments/<?php echo $row->seller_product_id;?>"></a><?php echo $row->comment_count;?>
							</td>
-->							<td class="center">
							 <?php if($row->pay_status =='Pending'){;?>
								<span class="badge_style "><?php echo $row->status;?></span>
                              <?php }else{ ?>  
							<?php 
							if ($allPrev == '1' || in_array('2', $product)){
								$mode = ($row->status == 'Publish')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/product/change_product_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/product/change_product_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }}?>
							</td>
							<td class="center">
								<?php echo $row->created;?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $product)){?>
								<span><a class="action-icons c-edit" href="admin-edit-product/<?php echo $row->seourl;?>" target="_blank" title="Edit">Edit</a></span>
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/product/view_product/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $product)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/product/delete_product/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php }?>
							<?php if ($allPrev == '1' || in_array('2', $product)){?>
								<span><a class="action-icons c-copy" href="admin-copy-control/<?php echo $row->seourl;?>" target="_blank" title="Copy">Copy</a></span>
							<?php }?>
							</td>
						</tr>
						<?php 
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th>
							Feature Product
							</th>
							<th>
								 Product Name
							</th>
							<th>
								 Image
							</th>
							<th>
								Price
							</th>
							<th>
								Added By
							</th>
							<th>
								Quantity
							</th>
<!-- 							<th>
								Comments
							</th>
 -->							<th>
								Status
							</th>
							<th>
								Created On
							</th>
							<th>
								Action
							</th>
						</tr>
						
						</tfoot>
						
						</table>

						<?php echo $paginationLink; ?>
		
						
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
			<input type="hidden" name="SubAdminEmail" id="SubAdminEmail"/>
		</form>	
			
		
			
			
			
			
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<div id="cal_div" style="display:none;top:0; height:40px;width:500px;">
	<div id='calender' class="modal fade in language-popup" style="display:none;top:0; " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				 <div style='background:#fff;'>  
					<div class="conversation" style="width: 340px; margin-left: 60px;">
						<div class="conversation_container">
							<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;"> Pick The Package And Date </h2>													
								<div id="feature_cbox">
								</div>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>	
</div>


<style>
ul.tsc_pagination { margin:4px 0; padding:0px; height:100%; overflow:hidden; font:12px 'Tahoma'; list-style-type:none; float:right; }
ul.tsc_pagination li { float:left; margin:0px; padding:0px; margin-left:5px; }

ul.tsc_pagination li a { color:black; display:block; text-decoration:none; padding:7px 10px 7px 10px; }


ul.tsc_paginationA li a { color:#FFFFFF; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; }

ul.tsc_paginationA01 li a { color:#474747; border:solid 1px #B6B6B6; padding:6px 9px 6px 9px; background:#E6E6E6; background:-moz-linear-gradient(top, #FFFFFF 1px, #F3F3F3 1px, #E6E6E6); background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #FFFFFF), color-stop(0.02, #F3F3F3), color-stop(1, #E6E6E6)); }
ul.tsc_paginationA01 li:hover a,
ul.tsc_paginationA01 li.current a { background:#FFFFFF; }

.product-search{float: left; margin: 15px; width: 73%;}
.product-search .search{float:left; width:27%; margin-left: 10px; height:28px; padding-left:7px; border-radius: 3px; border:2px solid #ccc;}
.product-search .searchselect{float:left; width:27%; margin-left: 10px; height:34px; padding-left:7px; border-radius: 3px; border:2px solid #ccc;}
.product-search .filter-search {float:left;height: 34px;width: 24%; border-radius: 3px; border:2px solid #ccc;} 
.product-search .search-product{float:left; background: #e0761a none repeat scroll 0 0; border: medium none; border-radius: 5px; color: #fff; height: 34px; margin-left: 10px; width: 15%; cursor:pointer;}
</style>
<script src="js/datepicker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#createdValue").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#createdValue1").datepicker({ dateFormat: 'yy-mm-dd' });
	$(".page_title").hide();
	$("#search-product").on("click", function(){
		var svalue = '';
		var filterValue = $('#filterValue option:selected').val();
		var searchValue = $('#searchValue').val();
		var priceValue = $('#priceValue option:selected').val();
		var qtyValue = $('#qtyValue option:selected').val();
		var statusValue = $('#statusValue option:selected').val();
		var createdValue = $('#createdValue').val();
		var createdValue1 = $('#createdValue1').val();
		if(filterValue ==''){
			$('#filterValue').css('border-color', '#E0761A');
			return false;
		}else{
			$('#filterValue').css('border-color', '#ccc');
		}
		if($('#searchValue').css('display') =='block'){
			if(searchValue ==''){
				$('#searchValue').css('border-color', '#E0761A');
				return false;
			}else{
				$('#searchValue').css('border-color', '#ccc');
				var allvalue = "?svalue="+searchValue;
			}
		}else if($('#priceValue').css('display') =='block'){
			if(priceValue ==''){
				$('#priceValue').css('border-color', '#E0761A');
				return false;
			}else{
				$('#priceValue').css('border-color', '#ccc');
				var allvalue = "?pvalue="+priceValue;
			}
		}else if($('#qtyValue').css('display') =='block'){
			if(qtyValue ==''){
				$('#qtyValue').css('border-color', '#E0761A');
				return false;
			}else{
				$('#qtyValue').css('border-color', '#ccc');
				var allvalue = "?qvalue="+qtyValue;
			}
		}else if($('#statusValue').css('display') =='block'){
			if(statusValue ==''){
				$('#statusValue').css('border-color', '#E0761A');
				return false;
			}else{
				$('#statusValue').css('border-color', '#ccc');
				var allvalue = "?stvalue="+statusValue;
			}
		}else if($('#createdValue').css('display') =='block' && $('#createdValue1').css('display') =='block'){
			if(createdValue ==''){
				$('#createdValue').css('border-color', '#E0761A');
				return false;
			}else{
				$('#createdValue').css('border-color', '#ccc');
			}
			if(createdValue1 ==''){
				$('#createdValue1').css('border-color', '#E0761A');
				return false;
			}else{
				$('#createdValue1').css('border-color', '#ccc');	
			}
			var allvalue = "?fromDate="+createdValue+"&toDate="+createdValue1;
		}
		var QuertString = allvalue+"&fvalue="+filterValue;
		//alert(QuertString);
		window.location.href= BaseURL+"admin/product/display_product_list/"+QuertString;
	});
	$('#filterValue').on("change",function(){
		var filterValue = $('#filterValue option:selected').val();
		if(filterValue ==''){
			$('#searchValue').css('display', 'none');
			$('#priceValue').css('display', 'none');
			$('#createdValue').css('display', 'none');
			$('#createdValue1').css('display', 'none');
			$('#qtyValue').css('display', 'none');
			$('#statusValue').css('display', 'none');
		}
		if(filterValue =='name'){
			$('#searchValue').css('display', 'block');
			$('#priceValue').css('display', 'none');
			$('#createdValue').css('display', 'none');
			$('#createdValue1').css('display', 'none');
			$('#qtyValue').css('display', 'none');
			$('#statusValue').css('display', 'none');
		}
		if(filterValue =='price'){
			$('#searchValue').css('display', 'none');
			$('#priceValue').css('display', 'block');
			$('#createdValue').css('display', 'none');
			$('#createdValue1').css('display', 'none');
			$('#qtyValue').css('display', 'none');
			$('#statusValue').css('display', 'none');
		}
		if(filterValue =='created'){
			$('#searchValue').css('display', 'none');
			$('#priceValue').css('display', 'none');
			$('#createdValue').css('display', 'block');
			$('#createdValue1').css('display', 'block');
			$('#qtyValue').css('display', 'none');
			$('#statusValue').css('display', 'none');
		}
		if(filterValue =='qty'){
			$('#searchValue').css('display', 'none');
			$('#priceValue').css('display', 'none');
			$('#createdValue').css('display', 'none');
			$('#createdValue1').css('display', 'none');
			$('#qtyValue').css('display', 'block');
			$('#statusValue').css('display', 'none');
		}
		if(filterValue =='status'){
			$('#searchValue').css('display', 'none');
			$('#priceValue').css('display', 'none');
			$('#createdValue').css('display', 'none');
			$('#createdValue1').css('display', 'none');
			$('#qtyValue').css('display', 'none');
			$('#statusValue').css('display', 'block');
		}
	});
	$(".sellername").change(function(){
		var r =confirm("Are you sure you want to change the seller name");
		var user_id=$(this).val();
		var product_id=$(this).parent().parent().find('#product_id').val();
		var product_name=$(this).parent().parent().find('#product_name').val();
		if(r == true){
			$.ajax({
				type: 'POST',
				url: 'admin/product/change_seller',
				data:{user_id : user_id,product_id:product_id,product_name:product_name},
				dataType: 'json',
				success: function(response){
					if(response.status_code == 1){
						alert('Product owner changed');
					}
				}
			});
		}
	});
	$("#stats").change(function(){
    	window.location.href = this.options[this.selectedIndex].value;
	});
});
</script>
<script>
function change_featured_product(val) {
	var productid=val.id;
	$.ajax({
		type: 'POST',
		url: baseURL+'admin/product/get_feature_contents',
		data:{'pid':productid},
		dataType: 'html',
		success: function(data) 
		{
		
			$('#feature_cbox').html('');	//alert(data);
			$('#feature_cbox').append(data);	//alert(data);
		}
	});
	$('#calender').css('display','block');
	$('#featured_product_id').val(productid);
	$.colorbox({
	href:'#calender',inline:true});
	$('html, body').animate({
         scrollTop: 0
    });
}


</script>
<style>
.not-active {
 pointer-events: none;
 cursor: default;
}
</style>
<?php 
$this->load->view('admin/templates/footer.php');
?>