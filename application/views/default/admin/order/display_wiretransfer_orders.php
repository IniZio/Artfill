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
						<table class="display display_tbl" id="cod_tbl">
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
							<th>
								Total
							</th>
                            <th>
                            	Payment Type
                            </th>
                           
   							<th class="tip_top" title="Click to sort">
								Shipping Status
							</th>
							<th class="tip_top" title="Click to sort">
								Payment Status
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

						<!--	<td class="center">
								<?php echo $row->dealCodeNumber;?>
							</td>-->
							<td class="center">
								 <?php echo $row->total;?>
							</td>
							<td class="center">
								 <?php echo $row->payment_type;?>
							</td>
                          
							<td class="center">
							<?php if($row->shipping_status =='Cancelled' || $row->shipping_status =='Pending'){?>
								<span class="badge_style b_pending"><?php echo $row->shipping_status;?></span>
							<?php } elseif($row->shipping_status =='Delivered'){?>
								<span class="badge_style"><?php echo $row->shipping_status;?></span>
							<?php } else{?>
								<span class="badge_style b_done"><?php echo $row->shipping_status;?></span>
							<?php } ?>
							</td>
							<td class="center">
								<select id="<?php echo $i; ?>" class="changePaymentStatusOrder1" data-val-id="<?php echo $row->dealCodeNumber;?>">
									<option value="Paid" <?php if($row->status=="Paid"){ echo 'selected="selected"'; } ?> <?php if($row->shipping_status =='Cancelled'){?> disabled <?php } ?>>Paid</option>
									<option value="Pending" <?php if($row->status=="Pending"){ echo 'selected="selected"'; } ?>>Pending</option>
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
								Shipping Status
							</th>
							<th>
								Payment Status
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

<script>
$('#cod_tbl').dataTable({
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