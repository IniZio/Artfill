<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
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
						
						<span style="padding: 30px;font-size: 16px;color: white;">
						Total Orders (<?php echo $orderList->num_rows();?>)
						</span>
						
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="cancelorders_tbl">
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
                            <select id="<?php echo $i; ?>" class="changeShipstatusrefund" data-val-id="<?php echo $row->dealCodeNumber;?>">
                                <!-- <option <?php if($row->shipping_status=="Processed"){ echo 'selected="selected"'; } ?> value="Processed" >Processed</option>\ -->
                                <option selected value="NotRefunded">Not Refunded</option>
                                <option value="Cancelled">Refunded</option>
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
			<input type="hidden" name="refund_message" id="refund_message"/>
		</div>
		<span class="clear"></span>
	</div>
</div>

<div style="display: none;">
<div id="alert" >
	<form method="post" action="admin/order/order_update_text">
<!-- 		<input type="text" name="refund_msg"/> -->
		<textarea style="width: 400px;height: 100px;" name="refund_msg"></textarea><br>
		<input type="submit" value="Go"/>
		<input type="hidden" name="shipping_status" id="shipping_status" value=""/>
		<input type="hidden" name="dealCodeNumber" id="dealCodeNumber" value=""/>
	</form>
</div>
</div>

<script>
$(document).ready(function(){				
$(".changeShipstatusrefund").change(function(){
	
	var dealCodeNumber=$(this).attr('data-val-id');
	var shipping_status=$(this).val();
	
// 					$("#shipping_status").val(shipping_status);
// 					$("#dealCodeNumber").val(dealCodeNumber);
					
// 					if(shipping_status == 'Cancelled'){
// 						$.colorbox({width:"360px", height:"auto",overflow:"auto", open:true, inline:true, href:"#alert"});
// 					}else{
// 						 	$.ajax({
// 							type:'post',
// 							url	: baseURL+'admin/order/order_update_text',
// 							dataType: 'html',			
// 							data:{'dealCodeNumber':dealCodeNumber,'shipping_status':shipping_status},
// 							success: function(response){
// 								window.location.reload();
// 								/*if(response== 'Success'){
// 									window.location.reload();
// 								}*/
// 							}
// 							});
// 					}



					$.confirm({
				 		'title'		: 'Confirmation',
				 		'message'	: 'Whether you want to continue this action?',
				 		'buttons'	: {
				 			'Yes'	: {
				 				'class'	: 'yes',
				 				'action': function(){

				 					$("#shipping_status").val(shipping_status);
									$("#dealCodeNumber").val(dealCodeNumber);

									$.colorbox({width:"500px", height:"200px",overflow:"auto", open:true, inline:true, href:"#alert"});

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

					
});	
});


$('#cancelorders_tbl').dataTable({
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