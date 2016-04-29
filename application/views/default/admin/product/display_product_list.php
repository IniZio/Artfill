<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
error_reporting(-1);
?>

<link rel="stylesheet" type="text/css" media="all" href="css/default/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
<script>
$(document).ready(function(){
	$(".page_title").hide();
});
</script>
<link rel="stylesheet" type="text/css" media="all" href="css/default/colorbox.css" />

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
							<option value="admin/product/recent_product_list">Recent products</option>
						</select>

						
						
						
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $product)){?>
							<div class="btn_30_light" style="height: 29px;">
								<?php /*<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Promote','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to Promoted records"><span class="icon accept_co"></span><span class="btn_link">Promote</span></a>
								
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Unpromote','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to Unpromoteded records"><span class="icon accept_co"></span><span class="btn_link">Unpromote</span></a>*/?>
								
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Yes','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to Featured records"><span class="icon accept_co"></span><span class="btn_link">Featured</span></a>
								
									<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('No','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to Unfeatured records"><span class="icon accept_co"></span><span class="btn_link">Unfeatured</span></a>
									
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
					
					<div style="display:none;">
					<div class="activities_s" style="width:100px;">
					<a href="admin/product/display_product_list">
						<div class="block_label">
							<div class="clear"></div>
									Total Products<span style="font-size:18px;"><?php echo $total_prod; ?></span>
							</div>
							</a>
					</div>
					
					<div class="activities_s" style="width:100px;">
						<a href="admin/product/display_product_list?status=Publish"><div class="block_label">
							<div class="clear"></div>
									Published Products<span style="font-size:18px;"><?php echo $publish_prod;?></span>
							</div></a>
					</div>
					<div class="activities_s" style="width:100px;">
						<a href="admin/product/display_product_list?status=UnPublish"><div class="block_label">
							<div class="clear"></div>
									UnPublished Products<span style="font-size:18px;"><?php echo $unpublish;?></span>
							</div></a>
					</div>
					<div class="activities_s" style="width:100px;">
						<a href="admin/product/display_product_list?status=deleted"><div class="block_label">
							<div class="clear"></div>	
									Deleted Products<span style="font-size:18px;"><?php echo $deleted;?></span>
							</div></a>
					</div>
					<div class="activities_s" style="width:100px;">
						<a href="admin/product/display_product_list?featured=Yes"><div class="block_label">
							<div class="clear"></div>
									Featured Products<span style="font-size:18px;"><?php echo $fcount; ?></span>
							</div></a>
					</div>
					<div class="activities_s" style="width:100px;">
						<div class="block_label">
							<div class="clear"></div>
									Products Sold<span style="font-size:18px;"><?php echo $prod_sold;?></span>
							</div>
					</div>
					<div class="activities_s" style="width:100px;">
						<div class="block_label">
							<div class="clear"></div>
									Purchased Amount<span style="font-size:18px;"><?php echo $currencySymbol;?><?php echo $prod_pur; ?></span>
							</div>
					</div>
						<?php /* <div class="activities_s" style="width:100px;">
						<a href="admin/product/display_product_list?promo=Unpromote"> <div class="block_label">
							<div class="clear"></div>
									Promoted Products<span style="font-size:18px;"><?php echo $promo_prod;?></span>
							</div></a>
						</div>	*/ ?>
					</div>		
					<div class="widget_content">
						<table class="display display_tbl" id="display_product_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="center" style="width:300px !important">
								Feature Product
							</th>
							<th class="tip_top" title="Click to sort" style="width:300px !important">
								 Product Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Image
							</th>
							<th style="width:60px !important">
								Price
							</th>
							<th class="tip_top" title="Click to sort" style="width:80px !important">
								Added By
							</th>
							<th class="tip_top" title="Click to sort" style="width:80px !important">
								Quantity
							</th>
							
							
							
<!--                             <th class="tip_top" title="Click to sort">
								comments
							</th>
 -->							<th class="tip_top" title="Click to sort">
								Status
							</th>
							<th class="tip_top" title="Click to sort">
								Created On
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php //echo("<pre>"); print_r($productList->result());die;
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
						<input  id="product_id" type="hidden" value="<?php echo $row->id;?>">
						
						<input  id="product_name" type="hidden" value="<?php echo $row->product_name;?>">
							<td class="center tr_select ">
								<input name="checkbox_id[]"  type="checkbox" value="<?php echo $row->id;?>">
							</td>
							
							<td class="center">
							<a style="position:relative;" class=<?php if($row->status != 'Publish') {echo "not-active";}?>  href="javascript:void(0)" id="<?php echo $row->id;?>" name="product_featured" onclick ="change_featured_product(this);" ><span class="badge_style b_done">Feature</span></a>
							<!--<input type="checkbox" style="position:relative;"  id="<?php echo $row->id;?>" name="product_featured" <?php if($row->product_featured == "Yes") { echo 'checked="checked"';}?> onchange="return change_featured_product(this);" >-->
							</td>					
							
							<?php /* <td class="center" >
							
							<?php
							$mode = ($row->product_featured == 'Yes')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to unfeatured" class="tip_top" href="javascript:confirm_status('admin/product/change_product_feature/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->product_featured;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to featured" class="tip_top" href="javascript:confirm_status('admin/product/change_product_feature/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->product_featured;?></span></a>
							<?php 
								}
								?>
							</td> */?>
							
							
							
							<td class="center" >
								<?php echo $row->product_name;?>
							</td>
							<td class="center">
						 		<div class="widget_thumb" style="margin-left: 25%;">
								 <img width="40px" height="40px" src="<?php echo base_url();?>images/product/thumb/<?php echo $img;?>" />
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
					  
					  
					  
								<?php /*
								if ($row->user_name != ''){
									echo '<b>'.$row->full_name.'</b> ('.$row->user_name.')';
								}else {
									echo 'Admin';
								}
								*/ ?>
							</td>
							<td class="center">
								 <?php echo $row->quantity;?>
							</td>
							
													
<!--                            <td class="center">
								 <a href="admin/comments/view_product_comments/<?php echo $row->seller_product_id;?>"></a><?php echo $row->comment_count;?>
							</td>
-->							<td class="center">
							 <?php if($row->pay_status == 'Pending'){
										if($this->config->item('product_cost') != 0){	
											if($row->status == 'UnPublish'){
										?>
											<span class="badge_style "><?php echo $row->status;?></span>
                              <?php 	}
										else{?>
											<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/product/change_product_status/1/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
								<?php		}
										
							  ?>
							 <?php }else{
										if ($allPrev == '1' || in_array('2', $product)){
											$mode = ($row->status == 'Publish')?'0':'1';
											if ($mode == '0'){
										?>
											<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/product/change_product_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
										<?php
											}else{	
										?>
											<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/product/change_product_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
										<?php 
											}
										}else {
										?>
											<span class="badge_style b_done"><?php echo $row->status;?></span>
										<?php }
										}
										
										}else{ 
											if ($allPrev == '1' || in_array('2', $product)){
												$mode = ($row->status == 'Publish')?'0':'1';
												if ($mode == '0'){
											?>
												<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/product/change_product_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
											<?php
												}else{	
											?>
												<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/product/change_product_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
											<?php 
												}
											}else {
											?>
											<span class="badge_style b_done"><?php echo $row->status;?></span>
											<?php }
											}?>
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
								<span><a class="action-icons c-copy" href="admin-copy-product/<?php echo $row->seourl;?>" target="_blank" title="Copy">Copy</a></span>
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



<script>$(document).ready(function(){$("#featured_date").validate(); });</script>
<script type="text/javascript">

$(document).ready(function()
{
$(".sellername").change(function () {
var r =confirm("Are you sure you want to change the seller name");

var user_id=$(this).val();
var product_id=$(this).parent().parent().find('#product_id').val();
var product_name=$(this).parent().parent().find('#product_name').val();

if (r == true) {

$.ajax({
type: 'POST',
				url: 'admin/product/change_seller',
				data:{user_id : user_id,product_id:product_id,product_name:product_name},
				dataType: 'json',
				success: function(response) 
				{
				if(response.statuse_code == 1)
    			{
					alert('Product owner changed');
				}
				
				}
});
}
});
});

	
</script>
<script src="js/datepicker.js"></script>

<script>
  $(function() {
    $( "#eventDate" ).datepicker();

 });
  </script>
  
<script>
/* function change_featured_product(val) {


		var productid=val.id;
		alert(productid);
		var fstatus=$("#"+productid).is(':checked') ? 1 : 0; 
		if(fstatus == 1){
			$('#calender').css('display','block');
			$('#featured_product_id').val(productid);
			//document.getElementById('featured_product_id').value=productid;
			$('#fstatus').val(fstatus);
			$.colorbox({
			href:'#calender',inline:true});
			  $('html, body').animate({
                        scrollTop: 0
                    });
			
			
		}else{
			//alert("asdf");return false;
			$.get('admin/product/change_featuredproduct_ajax?featured_product_id='+productid+'&fstatus='+fstatus, function(data) {
				return false;alert("Featured product status changed successfully");
			});
		}
} */
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
<script>
 $(document).ready(function(){
    $("#stats").change(function () {
    	window.location.href = this.options[this.selectedIndex].value;
        });
  });
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

