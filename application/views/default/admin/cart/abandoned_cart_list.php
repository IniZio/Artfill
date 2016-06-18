<?php 
$this->load->view('admin/templates/header.php');
extract($privileges);  

#echo "<pre>";print_r($sellersList->result());die;
?> 
<script>
$(document).ready(function(){
	$(".page_title").hide();
});
</script>

<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/cart/change_cart_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						
						
					
						
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php 
						if ($allPrev == '1' || in_array('3', $cart)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
						<div class="widget_content">
						<table class="display display_tbl" id="display_cart_abandoned">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
                            <th class="tip_top" title="Click to sort">
								 User Name
							</th>
							<th class="tip_top" title="Click to sort">
								Email
							</th>
                            <th class="tip_top" title="Click to sort">
								Product Count		
							</th>
							<!--<th class="tip_top" title="Click to sort">
								 Transaction ID
							</th>-->
							<th class="tip_top" title="Click to sort">
								Cart Date
							</th>
                            
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($cart_list->num_rows() > 0){
							foreach ($cart_list->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
                            <td class="center">
								<?php if($row->full_name != "" ){ echo $row->full_name;} else { echo "Guest";}?>
							</td>
							<td class="center">
								<?php if( $row->email != "" ){ echo $row->email;} else { echo $row->user_id;}?>
							</td>
   							
							
							<td class="center">
								 <?php echo $row->countc;?>
							</td>							
							<td class="center">
								<?php echo $row->created;?>
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

		echo  anchor_popup("admin/cart/view_cart_detail/".$row->user_id."", '<span class="action-icons c-suspend tipTop" title="View Invoice" style="cursor:pointer;"></span>', $atts); ?>
<!--<a href="discussion/<?php echo $row->dealCodeNumber; ?>" target="_blank"><span class="action-icons c-suspend tipTop" style="cursor:pointer;" original-title="Discussion"></span></a>-->
						<?php if($row->email != "" ){ ?>
								<a title= "sent mail" href="javascript:confirm_delete('admin/cart/sent_notification/<?php echo $row->user_id;?>/<?php echo $row->email;?>')"><image src="images/site/activity.png" /></a>
							<?php }?>
							<?php if ($allPrev == '1' || in_array('3', $product)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/cart/delete_cart_product/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
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
                            	 User Name
                            </th>
							<th>
								 User Email
                            </th>
							<th>
								Product Count		
							</th>
							<!--<th>
								Transaction ID
							</th>-->
                            <th>
                            	Cart Date
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

	$('#display_cart_abandoned').dataTable({   
		"aoColumnDefs": [
		                 { "bSortable": false, "aTargets": [ 0,5 ] }
		                 ],
		                 "aaSorting": [[4, 'asc']],
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