<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<link rel="stylesheet" type="text/css" media="all" href="css/default/colorbox.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/default/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>

<?php //echo "<pre>"; print_r($orderList->result()); die;?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/order/change_order_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						
						<select id="stats" >
							<option value="admin/order/display_order_paid">Total Orders(<?php echo $tot_orders;?>)</option>
							<option <?php if($_GET['status'] == 'Shipped'){ ?>selected<?php }?> value="admin/order/display_order_paid?status=Shipped">Shipped Orders (<?php echo $shipped;?>)</option>
							<option <?php if($_GET['status'] == 'Processed'){ ?>selected<?php }?> value="admin/order/display_order_paid?status=Processed">Processed Orders (<?php echo $processed; ?>)</option>
							<option <?php if($_GET['status'] == 'Delivered'){ ?>selected<?php }?> value="admin/order/display_order_paid?status=Delivered">Delivered Orders (<?php echo $delivered; ?>)</option>
							<option <?php if($_GET['status'] == 'Cancelled'){ ?>selected<?php }?> value="admin/order/display_order_paid?status=Cancelled">Cancelled Orders (<?php echo $cancelled; ?>)</option>
						</select>
						
						<span style="padding: 30px;font-size: 16px;color: white;">
							Order Amt :  Total (<?php echo $currencySymbol;?><?php echo $order_amount;?>) | 
							Today (<?php echo $currencySymbol;?><?php echo $today_amount;?>) | 
							This Month (<?php echo $currencySymbol;?><?php echo $month_amount;?>)
						</span>
					</div>
					
					
<?php /*?>					
					<div class="activities_s" style="width:100px;">
						<a href="admin/order/display_order_paid?status=All"><div class="block_label">
							<div class="clear"></div>
									Total Orders (<?php echo $tot_orders;?>)
							</div></a>
					</div>
					<div class="activities_s" style="width:100px;">
						<a href="admin/order/display_order_paid?status=Shipped"><div class="block_label">
							<div class="clear"></div>
									Shipped Orders (<?php echo $shipped; ?>)
							</div></a>
					</div>
					<div class="activities_s" style="width:100px;">
						<a href="admin/order/display_order_paid?status=Processed"><div class="block_label">
							<div class="clear"></div>
									Processed Orders (<?php echo $processed; ?>)
							</div></a>
					</div>		
					<div class="activities_s" style="width:100px;">
						<a href="admin/order/display_order_paid?status=Delivered"><div class="block_label">
							<div class="clear"></div>
									Delivered Orders (<?php echo $delivered; ?>)
							</div></a>
					</div>		
					<div class="activities_s" style="width:100px;">
						<a href="admin/order/display_order_paid?status=Cancelled"><div class="block_label">
							<div class="clear"></div>
									Cancelled Orders (<?php echo $cancelled; ?>)
							</div></a>
					</div>
						<div class="activities_s" style="width:100px;">
						<div class="block_label">
							<div class="clear"></div>
									Order Amount (<?php echo $currencySymbol;?><?php echo $order_amount;?>)
							</div>
					</div>
<?php */?>					
					
					<div class="widget_content">
						<table class="display display_tbl" id="paid_orders">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
                            <th class="tip_top" title="Click to sort">
								 Order Id
							</th>
							<th class="tip_top" title="Click to sort">
								 User Email
							</th>
                            <th class="tip_top" title="Click to sort">
								 Payment Date		
							</th>
							<!--<th class="tip_top" title="Click to sort">
								 Transaction ID
							</th>-->
							<th class="tip_top" title="Click to sort">
								Total
							</th>
                            <th class="tip_top" title="Click to sort">
                            	Payment Type
                            </th>
                            
   							<th class="tip_top" title="Click to sort">
								Status
							</th>

							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($orderList->num_rows() > 0){
							foreach ($orderList->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
                            <td class="center">
								<?php echo $row->dealCodeNumber;?>
							</td>
							<td class="center">
								<?php echo $row->email;?>
							</td>
   							<td class="center">
								<?php echo $row->created;?>
							</td>

							<!--<td class="center">
								<?php echo $row->dealCodeNumber;?>
							</td>-->
							<td class="center">
								 <?php echo $row->total;?>
							</td>
							<td class="center">
								 <?php echo $row->payment_type;?>
							</td>
							<td class="center">
							<!--<span class="badge_style b_done"><?php echo $row->status;?></span>-->
                            
                            <select id="<?php echo $i; ?>" class="changeShipstatusShipped" data-val-id="<?php echo $row->dealCodeNumber;?>" >
                            	<!--<option <?php if($row->shipping_status=="Pending"){ echo 'selected="selected"'; } ?>>Pending</option>-->
                                <option <?php if($row->shipping_status=="Processed"){ echo 'selected="selected"'; } ?> value="Processed">Processed</option>
                                <option <?php if($row->shipping_status=="Shipped"){ echo 'selected="selected"'; } ?> value="Shipped">Shipped</option>
                                <option <?php if($row->shipping_status=="Delivered"){ echo 'selected="selected"'; } ?> value="Delivered">Delivered</option>
                                <option <?php if($row->shipping_status=="Cancelled"){ echo 'selected="selected"'; } ?> value="Cancelled">Cancelled</option>
                            </select>
                            
							</td>
							<td class="center">
	                            <!--<div id="Plusopen<?php echo $row->id;?>" style="display:block;"><img src="images/details_open.png" onclick="vieworders('<?php echo $row->dealCodeNumber; ?>');" /></div>
                                <div id="Plusclose<?php echo $row->id;?>" style="display:none;"><img src="images/details_close.png" onclick="viewcloseorders();" /></div>-->
                           		<!--<a href="order-review/<?php echo $row->dealCodeNumber;?>" class="tipTop" title="View Comments"><span class="action-icons c-suspend" style="cursor:pointer;"></span></a>-->
<?php $atts = array(
              'width'      => '1100',
              'height'     => '700',
              'scrollbars' => '1',
            );

echo  anchor_popup("admin/order/view_order/".$row->user_id."/".$row->dealCodeNumber."", '<span class="action-icons c-suspend tipTop" title="View Invoice" style="cursor:pointer;"></span>', $atts); ?>
<a href="discussion/<?php echo $row->dealCodeNumber; ?>" target="_blank"><span class="action-icons c-suspend tipTop" style="cursor:pointer;" original-title="Discussion"></span></a>



								
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
                            	Order Id
                            </th>
							<th>
								 User Email
                            </th>
							<th>
								 Payment Date
							</th>
							<!--<th>
								Transaction ID
							</th>-->
                            <th>
                            	Total
                            </th>
                            <th>
                            	Payment Date
                            </th>
                            <th>
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



<div style="display: none;">
<div id="alert">
	<form method="post" action="admin/order/order_update_text">
		<span id="edd" style="display:none;">Estimed Delivery Date:<input style="margin: 40px 0px 16px 25px;" name="eventDate" id="eventDate" type="text" tabindex="6" class="required small tipTop" title="Please select the date" value=""/><br></span>
		<span id="sid" style="display:none;">Shipping Id : <input style="margin: 0px 0px 20px 79px; width: 262px;" type="text" name="trackingId" id="trackingId"><br></span>
		<span>Comment : <textarea name="shippingMessage" style="width: 345px; height: 100px;" ></textarea><br></span>
		<input style="float: right;margin: 23px;width: 70px;" type="submit" value="Go"/>
		<input type="hidden" name="shipping_status" id="shipping_status" value=""/>
		<input type="hidden" name="dealCodeNumber" id="dealCodeNumber" value=""/>
	</form>
</div>
</div>

<script>
window.onload = function(){
	
	new JsDatePick({
		useMode:2,
		target:"eventDate",
		limitToToday:false,
		dateFormat:"%Y-%m-%d"
		/*selectedDate:{				This is an example of what the full configuration offers.
			day:5,						For full documentation about these settings please see the full version of the code.
			month:9,
			year:2006
		},
		yearsRange:[1978,2020],
		limitToToday:false,
		cellColorScheme:"beige",
		dateFormat:"%m-%d-%Y",
		imgPath:"img/",
		weekStartDay:1*/
	});
};


$(document).ready(function(){
$(".changeShipstatusShipped").change(function(){

	var dealCodeNumber=$(this).attr('data-val-id');
	var shipping_status=$(this).val();
	
		
	$.confirm({
 		'title'		: 'Confirmation',
 		'message'	: 'Whether you want to continue this action?',
 		'buttons'	: {
 			'Yes'	: {
 				'class'	: 'yes',
 				'action': function(){

 					$("#dealCodeNumber").val(dealCodeNumber);
 					$("#shipping_status").val(shipping_status);

 					if(shipping_status == 'Shipped'){
 						$("#edd").show();
 						$("#sid").show();
 					}else{
 						$("#edd").hide();
 						$("#sid").hide();
 					}	

 					//show_orderPopup
 					
 					$.colorbox({width:"500px", height:"300px",overflow:"auto", open:true, inline:true, href:"#alert"});

//  					else{
//  						 	$.ajax({
//  							type:'post',
//  							url	: baseURL+'admin/order/order_update_text',
//  							dataType: 'html',			
//  							data:{'dealCodeNumber':dealCodeNumber,'shipping_status':shipping_status},
//  							success: function(response){
//  								window.location.reload();
//  								/*if(response== 'Success'){
//  									window.location.reload();
//  								}*/
//  							}
//  							});
//  					}

 				}
 			},
 			'No'	: {
 				'class'	: 'no',
 				'action': function(){

 	 				return false;
 				}	// Nothing to do in this case. You can as well omit the action property.
 			}
 		}
 	});

 	
	$('html, body').animate({
        scrollTop: 0
    });
	
});	
});
</script>


<script>
 $(document).ready(function(){
    $("#stats").change(function () {
    	window.location.href = this.options[this.selectedIndex].value;
        });
  });


 $('#paid_orders').dataTable({
		"aoColumnDefs": [
							{ "bSortable": false, "aTargets": [ 0,4] }
						],
						"aaSorting": [[3, 'desc']],
		"sPaginationType": "full_numbers",
		"iDisplayLength": 50,
		"oLanguage": {
	        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
	    },
		 "sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
		 
		}); 
 </script>


<?php 
$this->load->view('admin/templates/footer.php');
?>