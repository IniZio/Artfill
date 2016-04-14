<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>

<link rel="stylesheet" type="text/css" href="a_data/jquery-ui.css">
<style>
.btn_30_light .datepicker, .btn_30_light #pay_status, .btn_30_light #driver_status {
  border: 1px solid #d8d8d8;
  color: #444444;
  font-family: "OpenSansRegular";
  font-size: 12px;
  padding: 10px 2px 10px 10px;
  width: 200px;
  display: inline-block;
}
table tr,td,th{
font-size:90%!important;
}
</style>
<?php 

if(isset($mindiscount))
{
$mindiscount=$mindiscount;
}
else{
$mindiscount=0;
}

if(isset($maxdiscount))
{
$maxdiscount=$maxdiscount;
}
else{
$maxdiscount=100;
}

if(isset($minprice))
{
$minprice=$minprice;
}
else{
$minprice=0;
}

if(isset($maxprice))
{
$maxprice=$maxprice;
}
else{
$maxprice=$minmax[0]['maxprice'];
}
?>
<script type="text/javascript">
$(function() {




    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: <?php echo $minmax[0]['maxprice'];?>,
      values: [<?php echo $minprice;?>,<?php echo $maxprice;?>],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
	  
	  
	  $( "#discount-range" ).slider({
      range: true,
      min: 0,
      max: 100,
      values: [<?php echo $mindiscount;?>,<?php echo $maxdiscount;?>],
      slide: function( event, ui ) {
        $( "#discount" ).val(ui.values[ 0 ] + "% -" + ui.values[ 1 ] + "%");
      }
    });
    $( "#discount" ).val(  $( "#discount-range" ).slider( "values", 0 ) +
      "% -" + $( "#discount-range" ).slider( "values", 1 ) +"%");
  });
</script>
<div id="content">
		<div class="grid_container">
			
			<form action='<?php echo base_url();?>admin/deals/display_deal_lists' method="post">
			
		<div style="float: right; margin: 18px 15px 2px 20px; width:90%; position:static; margin-top:25px" class="btn_30_light">
		
		
		<input type="text" class="datepicker" 
		
		value="<?php if(isset($checkin)) echo $checkin;?>" name="checkin" id="checkin" placeholder="Start date" style="width:150px!important;">
		<input type="text" class="datepicker" value="<?php if(isset($checkout)) echo $checkout;?>" name="checkout" id="checkout" placeholder="End date"
		
		style="width:150px!important;"
		>

		
		
		
		

	<div class="search-float-sec" style="float:right">
	<div class="search-ctg">
	
<input type="submit" value="search"  class="btn_small btn_blue" name='submit'>
</div>

</div>
<!--<div style="float:right;width:300px;">
		 <label for="amount">Price:</label>
<input id="amount" type="text" readonly="" style="border:0; color:#f6931f; font-weight:bold;width:120px;" name="amount">
    
         <div id="slider-range" style="width:90%;"></div>
		</div>-->
		
		<div style="float:right;width:500px;">
		 <label for="discount">Discount:</label>
<input id="discount" type="text" readonly="" style="border:0; color:#f6931f; font-weight:bold;width:90px;" name="discount">
    
         <div id="discount-range" style="width:70%;"></div>
		</div>
</div>
			
	</form>		
			
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/product/change_product_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
				
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="subadmin_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort" style="width:300px !important">
								 Product Name
							</th>
							
							<th style="width:60px !important">
								Deal from Date/To date
							</th>
							
							<th style="width:60px !important">
								Deal Time : from / to
							</th>
							
								<th style="width:60px !important">
								Discount
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
 -->						<th class="tip_top" title="Click to sort">
								Status
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
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<?php echo $row->product_name;?>
							</td>
							
							<td class="center">
								 <?php echo date('d-M-Y',strtotime($row->deal_date));?>/<?php echo date('d-M-Y',strtotime($row->deal_date_to));?>
							</td>
							
							<td class="center">
								 <?php echo date('h:i A',strtotime($row->deal_time_from));?>	/ <?php echo date('h:i A',strtotime($row->deal_time_to));?>
							</td>
							
							<td class="center">
									<?php echo $row->discount;?>%
							</td>
							
                            <?php if($row->price != 0.00) {?>
							<td class="center">
								<?php echo $row->price;?>
							</td>
                            <?php } else {?>
                            <td class="center">
								<?php echo $row->pricing.'+';?>
							</td>
                            <?php }?>
							<td class="center">
								<?php 
								if ($row->user_name != ''){
									echo '<b>'.$row->full_name.'</b> ('.$row->user_name.')';
								}else {
									echo 'Admin';
								}
								?>
							</td>
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
								<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/deals/change_deals_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/deals/change_deals_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }}?>
							</td>
							
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $product)){?>
								<span><a class="action-icons c-edit" href="edit-product/<?php echo $row->seourl;?>" target="_blank" title="Edit">Edit</a></span>
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/deals/view_deals/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $product)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/deals/delete_deals/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
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
								 Product Name
							</th>
							
							
							<th style="width:200px;">
								Deals date
							</th>
							
							<th style="width:150px;">
								Deal Time : from / to
							</th>
							
							<th>
								Discount
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
<?php 
$this->load->view('admin/templates/footer.php');
?>
<!-- Script for timepicker -->	
	<script type="text/javascript" src="js/timepicker/jquery.timepicker.js"></script>
	<script type="text/javascript" src="js/timepicker/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="js/timepicker/site.js"></script>
    <script type="text/javascript" src="js/timepicker/jquery.timepicker.min.js"></script>
<!-- Script for timepicker -->	

<!-- css for timepicker -->	
  <link rel="stylesheet" type="text/css" href="css/default/timepicker/bootstrap-datepicker.css" />
  <link rel="stylesheet" type="text/css" href="css/default/timepicker/site.css" />
  <link rel="stylesheet" type="text/css" href="css/default/timepicker/jquery.timepicker.css" />