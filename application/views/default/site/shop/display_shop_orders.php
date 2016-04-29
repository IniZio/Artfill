<?php 
$this->load->view('site/templates/shop_header');
$this->load->model('user_model');
//echo $orderDetails[0]->TotalAmt
$total_earnings =$currencyValue*($orderDetails[0]->TotalAmt-($disputeDetail[0]->dispute + $admin_commission[0]->admin_commission)-$user_details->row()->refund_amount); 
?>
<script type="text/javascript" src="js/site/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" href="css/default/jquery.ptTimeSelect.css" type="text/css" />
<script language="javascript" src="js/jquery.ptTimeSelect.js"></script>
<link href="css/default/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="js/1.8.24-jquery-ui.js"></script>
<script type="text/javascript">
var j=jQuery.noConflict();


j(document).ready(function(){
		
	j("#eventDate").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true  }).val();
	//j("#orderfrom").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true , maxDate: new Date() }).val();
	

	j( "#orderfrom" ).datepicker({ 
		dateFormat: "yy-mm-dd" ,
		changeYear: true,
		changeMonth: true,
		autoclose: true,
		startDate: new Date(),
		onClose: function(selectedDate) {
	        j("#orderto").datepicker("option", "minDate", selectedDate);
	    }
	}).on('changeDate', function (e) {
        j('#orderto').datepicker({ autoclose: true}).datepicker('setStartDate', e.date).focus();
	});
	
	
	j("#orderto").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true  }).val();
	
	//$("#dateto").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true   }).val()
	//$("#datefrom").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true  }).val();
});
</script>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<?php } ?>
<style>
.table-header th {
    text-align: center;
    height: 39px;
    vertical-align: middle;
}

</style>

<div class="clear"></div>
<div id="shop_page_seller">
<section class="container">

<?php //print_r($orderList->result()) ; die;?>

     <div class="main">    			

     
		 <ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
		   <span>&rsaquo;</span>
		   <li><?php if($this->lang->line('Shop_orders') != '') { echo stripslashes($this->lang->line('Shop_orders')); } else echo 'Shop orders'; ?></li>
         </ul>

  
                <?php
					if (count($orderList) > 0){						
				?>
				<div class="section community_right">
						<div class="heading_account"><?php if($this->lang->line('delivered_orders') != '') { echo stripslashes($this->lang->line('delivered_orders')); } else echo 'Delivered Orders'; ?></div>
						<div class="account_info">
							<h1 style="text-align:center !important;"><?php echo $orderDetails[0]->orders; ?></h1>
						</div>             
					</div>
					
					<div class="section community_right">
						<div class="heading_account"><?php if($this->lang->line('total_earnings') != '') { echo stripslashes($this->lang->line('total_earnings')); } else echo 'Total Earnings'; ?> <?php echo $currencySymbol;?></div>
						<div class="account_info">
							<h1 style="text-align:center !important;">
								<?php  echo number_format($total_earnings,2); ?> 
							</h1>
							
						</div>             
					</div>
					
					<div class="section community_right">
						<div class="heading_account"><?php if($this->lang->line('withdrawal_earnings') != '') { echo stripslashes($this->lang->line('withdrawal_earnings')); } else echo 'Withdrawal Earnings'; ?> <?php echo $currencySymbol;?></div>
						<div class="account_info">
							<h1 style="text-align:center !important;">
								<?php echo number_format($currencyValue*$paidDetails[0]->totalPaid,2);?>
							</h1>
						</div>             
					</div>
					
					<div class="section community_right">
						<div class="heading_account"><?php if($this->lang->line('balance_earnings') != '') { echo stripslashes($this->lang->line('balance_earnings')); } else echo 'Balance Earnings'; ?> <?php echo $currencySymbol;?></div>
						<div class="account_info">
							<h1 style="text-align:center !important;">
								<?php 
									//echo $total_earnings."   ".number_format($currencyValue*$paidDetails[0]->totalPaid,2);
									$balance_amt= $total_earnings - $currencyValue*$paidDetails[0]->totalPaid; 									
								?>
								<?php echo number_format($balance_amt,2);?>
							</h1>
							<h2 style="text-align:center !important;margin-top: -11px;"><?php echo shopsy_lg('lg_to_ear-withdar_earning','(Total Earnings - Withdrawal Earnings)');?>
							
							
							</h2>
						</div>             
					</div>
					<?php /*
					<div class="section">
						<div class="heading_account">Site Earnings</div>
						<div class="account_info">
							<h1 style="text-align:center !important;"><?php echo $user_details->row()->commision; ?> %</h1>
						</div>             
					</div>
					*/ ?>
					
<div class="purchase_review container community_right">     					
				
			<div class="all-purchase-search">
        		<div class="top_list" style="width: 90%;margin: 0px 0px 10px 10px;">
                <ul style="width:auto;" class="listtypename">
					
				   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders" class="" ><div class="name-inner"><?php echo shopsy_lg('lg_all','All');?> <span class="suborder"><?php if($_GET['order']=='' && $orderList->num_rows > 0){ echo $orderList->num_rows; }?></span> </div></a></li>
				   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=Processed" class="" ><div class="name-inner"><?php echo shopsy_lg('lg_processed','Processed');?> <span class="suborder"><?php if($_GET['order']=='Processed' && $orderList->num_rows >0){ echo $orderList->num_rows; }?></span> </div></a></li>
				   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=Shipped" class="" ><div class="name-inner"><?php echo shopsy_lg('lg_shipped','Shipped');?> <span class="suborder"><?php if($_GET['order']=='Shipped' && $orderList->num_rows >0){ echo $orderList->num_rows; }?></span></div></a></li>
				   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=Delivered" class="" ><div class="name-inner"><?php echo shopsy_lg('lg_deliverd','Delivered');?> <span class="suborder"><?php if($_GET['order']=='Delivered' && $orderList->num_rows >0){ echo $orderList->num_rows; }?></span></div></a></li>
				   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=Cancelled" class="" ><div class="name-inner"><?php echo shopsy_lg('lg_cancelled','Cancelled');?> <span class="suborder"><?php if($_GET['order']=='Cancelled' && $orderList->num_rows >0){ echo $orderList->num_rows; }?></span></div></a></li>
				   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=dispute" class="" ><div class="name-inner"><?php echo shopsy_lg('lg_retorrep','Return / Replace ');?> <span class="suborder"><?php if($_GET['order']=='dispute' && $orderList->num_rows >0){ echo $orderList->num_rows; }?></span></div></a></li>
				   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=cod" class="" ><div class="name-inner"><?php echo shopsy_lg('lg_cod','Cash on Delivery');?> <span class="suborder"><?php if($_GET['order']=='cod' && $orderList->num_rows > 0){ echo $orderList->num_rows; }?></span></div></a></li>
				   <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=wiretransfer" class="" ><div class="name-inner"><?php echo shopsy_lg('lg_wiretransfer','Wire Transfer');?> <span class="suborder"><?php if($_GET['order']=='wiretransfer' && $orderList->num_rows > 0){ echo $orderList->num_rows; }?></span></div></a></li>
					 <li><a title="" href="shops/<?php echo $selectSellershop_details[0]['seourl']; ?>/shop-orders?order=westernunion" class="" ><div class="name-inner"><?php echo shopsy_lg('lg_westernunion','Western Union');?> <span class="suborder"><?php if($_GET['order']=='westernunion' && $orderList->num_rows > 0){ echo $orderList->num_rows; }?></span></div></a></li>
            
                   
                </ul>
      			</div>
                    
<!--                     <div class="purchase-search"> -->
<!--                         <div class="review-search-bar"> -->
<!--                         <form method="get" action="purchase-review">
                        	<input type="text" placeholder="<?php if($this->lang->line('user_ord_no') != '') { echo stripslashes($this->lang->line('user_ord_no')); } else echo 'Order Number'; ?>" name="query" id="query" value="<?php echo $this->input->get('query'); ?>" />
<!--                         </form> -->
<!--                         </div> -->
<!--                     </div> -->
                </div>	
				
				
			<div style="width: 100%;text-align: center;padding-bottom: 20px;margin-top:20px;">
						<input type="text" id="transaction" name="transaction"placeholder="<?php echo shopsy_lg('lg_trensacid','Transaction Id');?>"value="<?php if(isset($_GET['id'])){ echo $_GET['id'];}?>" title="Transaction ID"/>
						<input type="text" id="orderfrom" name="orderfrom" placeholder="<?php echo shopsy_lg('lg_orderfrom','Order from');?>" title="Order from" value="<?php if(isset($_GET['from'])){ echo $_GET['from'];}?>" />
						<input type="text" id="orderto" name="orderto" title="Order to"  placeholder="<?php echo shopsy_lg('lg_orderto','Order to');?>" value="<?php if(isset($_GET['to'])){ echo $_GET['to'];}?>" />
						<input type="button" class="search-bt" id="search" name="search" value="<?php echo shopsy_lg('lg_search','search');?>" onclick="search_Orders()"/>
			</div>
			
                <form class="tab_form_list" style="width: 100%;">
					<?php if($orderList->num_rows() >0) { ?>
                     <table id="order_table_view" class="tab_form_list_table" align="center" width="100">
                        <thead>     
                            <tr class="table-header">
                            	<th>#</th>
                               <th><span><?php if($this->lang->line('user_email') != '') { echo stripslashes($this->lang->line('user_email')); } else echo 'User Email'; ?></span></th>
                                <th><span><?php if($this->lang->line('payment_date') != '') { echo stripslashes($this->lang->line('payment_date')); } else echo 'Payment Date'; ?></span></th>        
                                <th><span><?php if($this->lang->line('transaction_id') != '') { echo stripslashes($this->lang->line('transaction_id')); } else echo 'Tranaction ID'; ?></span></th>        
                                <th><span><?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo 'Total'; ?></span></th>  
                                <th><span><?php if($this->lang->line('payment_type') != '') { echo stripslashes($this->lang->line('payment_type')); } else echo 'Payment Type'; ?></span></th>  
                                <th><span><?php if($this->lang->line('shop_status') != '') { echo stripslashes($this->lang->line('shop_status')); } else echo 'Status'; ?></span></th>     
                                <th><span><?php if($this->lang->line('transaction_action') != '') { echo stripslashes($this->lang->line('transaction_action')); } else echo 'Action'; ?></span></th> 
                            </tr>
                        </thead>
                        <tbody align="center">   
							
                        <?php 
					
						
						$i=0; foreach ($orderList->result() as $row){ $i++; ?>          
                            <tr style="height: 50px;">      
                            	<td><?php echo $i; ?></td>                      
                                <td><?php echo $row->email;?></td>        
                                <td><?php echo $row->created;?></td>        
                                <td><?php echo $row->dealCodeNumber;?></td>
                                <td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$row->total,2);?></td>
                                <td><?php echo $row->payment_type;?></td>
                                <td>
                                
                                <span style="color:red;"><?php if($row->received_status == 'Requested Cancel' && $row->shipping_status !="Cancelled"){ 
                                	//echo $row->shipping_status;
                                	if($row->shipping_status == 'Refund'){
                                		if($this->lang->line('lg_refund') != '') {echo stripslashes($this->lang->line('lg_refund')); } else echo 'Refund';
                                	}else{
                                		if($this->lang->line('lg_requested_refund') != '') {echo stripslashes($this->lang->line('lg_requested_refund')); } else echo 'Requested Refund';
                                	}

                                }?></span>
                                <span style="color:red;"><?php if($row->shipping_status == "Cancelled"){ echo $row->shipping_status;}?></span>
                                
                                <?php if($row->received_status != 'Requested Cancel'){?>
                                <select id="<?php echo $row->id; ?>" class="changeShipstatusShopCustom" data-val-id="<?php echo $row->dealCodeNumber;?>">
                                    <!--<option <?php if($row->shipping_status=="Pending"){ echo 'selected="selected"'; } ?>>Pending</option>-->
                                    <option <?php if($row->shipping_status=="Processed"){ echo 'selected="selected"'; } ?>><?php if($this->lang->line('Processed') != '') { echo stripslashes($this->lang->line('Processed')); } else echo 'Processed'; ?></option>
                                    <option <?php if($row->shipping_status=="Shipped"){ echo 'selected="selected"'; } ?>><?php if($this->lang->line('shipped') != '') { echo stripslashes($this->lang->line('shipped')); } else echo 'Shipped'; ?></option>
                                    <option <?php if($row->shipping_status=="Delivered"){ echo 'selected="selected"'; } ?>><?php if($this->lang->line('delivered') != '') { echo stripslashes($this->lang->line('delivered')); } else echo 'Delivered'; ?></option>
                                    <option <?php if($row->shipping_status=="Cancelled"){ echo 'selected="selected"'; } ?>><?php if($this->lang->line('cancelled') != '') { echo stripslashes($this->lang->line('cancelled')); } else echo 'Cancelled'; ?></option>
                                </select>
                                
								<?php }?>
								</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/<?php echo $row->user_id; ?>/<?php echo $row->dealCodeNumber; ?>" target="_blank" title="View"><?php if($this->lang->line('transaction_view') != '') { echo stripslashes($this->lang->line('transaction_view')); } else echo 'View'; ?></a> -->
                                <a href="view-order-pre/<?php echo $row->user_id; ?>/<?php echo $row->dealCodeNumber; ?>" target="_blank" title="View"><?php if($this->lang->line('transaction_view') != '') { echo stripslashes($this->lang->line('transaction_view')); } else echo 'View'; ?></a>
                                <br />
								
								
								<?php if($row->received_status == 'Requested Cancel'){?>	
									<?php if($row->shipping_status == 'Delivered'){ ?>
										<a href="discussion/<?php echo $row->dealCodeNumber; ?>" title="View Discussion"><?php if($this->lang->line('user_view_discussion') != '') { echo stripslashes($this->lang->line('user_view_discussion')); } else echo 'View Discussion'; ?> </a>
									<?php }?>
								<?php }?>
								<?php if($row->payment_type =='wire_transfer' || $row->payment_type =='western_union'){?>
								<?php $proof = $this->user_model->get_all_details(PROOF,array('dealcodenumber'=>$row->dealCodeNumber));?>
								<?php //echo $this->db->last_query();?>
									<?php if($proof->num_rows()==1){?>
										<a target="_blank" href="view-proof/<?php echo $proof->row()->dealcodenumber?>"><?php echo shopsy_lg('lg_viewproof','View Proof');?></a>
									<?php }?>
								<?php } ?>
                                </td>
                            </tr>
                            
                            
                        <?php } 
						?>
						
						
                        </tbody>
                     </table>  
<?php } else { 
						echo shopsy_lg('lg_no transact_found','No Transaction Found...');
						}			?>		 
                 </form>
                 
</div>                 
        		<?php }else{ ?>
                <div class=" warning-error">
                    <h3>
                        <span style="margin:0 0 0 3px; color:#000; font-weight:bold">  <?php if($this->lang->line('no_shop_transaction') != '') { echo stripslashes($this->lang->line('no_shop_transaction')); } else echo 'No Transaction in your Shop yet.'; ?>  </span>
                    </h3>
                </div>
                <?php } ?>
        </div>
        
        <input type="hidden" id="sellerurl" value="<?php echo $selectSellershop_details[0]['seourl'];?>"/>
        <input type="hidden" id="orderType" value="<?php if(isset($_GET['order'])){ echo $_GET['order'];}?>"/>
 
        
 </section>

</div>
<a href="#shipped_container" id="show_orderPopup" data-toggle="modal"></a>

<div class="modal fade language-popup" id='shipped_container' role="dialog" aria-hidden="true" style="display:none">
		<div class="modal-dialog">
			<div class="modal-content">
				
			<div id='cancel_order_popup' style='background:#fff;'>
			<div class="conversation">
			<div class="conversation_container">
					
				
				<form method="post" action="site/shop/shoporder_update">
				<span id="edd" style="display:none;"><?php echo shopsy_lg('lg_est_deliverydate','Estimed Delivery Date:');?><input name="eventDate" id="eventDate" type="text" tabindex="6" class="required small tipTop" title="Please select the date" value=""/><br></span>
				<span id="sid" style="display:none;"><?php echo shopsy_lg('lg_shipid','Shipping Id : ');?> <input type="text" name="trackingId" id="trackingId"><br></span>
				<span><?php echo shopsy_lg('lg_comment','Comment :');?><textarea name="shippingMessage" style="z-index:99999999"></textarea><br></span>
				<input type="hidden" name="shipping_status" id="shipping_status" value=""/>
				<input type="hidden" name="dealCodeNumber" id="dealCodeNumber" value=""/>

			
			<div class="modal-footer footer_tab_footer" style="width: 100%; ">
						<div class="btn-group">
							<input class="submit_btn" type="submit" value="submit">
								<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php echo shopsy_lg('lg_cancel','Cancel');?></a>
						</div>
			</div>	
			</form>
			
			
			</div>
			</div>
			</div>	
			
		</div>
	</div>
</div>

 
<?php /*?> 
 
<div style="display: none;">
<div id="alert">
	<form method="post" action="site/shop/shoporder_update">
		<span id="edd" style="display:none;">Estimed Delivery Date:<input name="eventDate" id="eventDate" type="text" tabindex="6" class="required small tipTop" title="Please select the date" value=""/><br></span>
		<span id="sid" style="display:none;">Shipping Id : <input type="text" name="trackingId" id="trackingId"><br></span>
		<span>Comment : <textarea name="shippingMessage"></textarea><br></span>
		<input type="submit" value="Go"/>
		<input type="hidden" name="shipping_status" id="shipping_status" value=""/>
		<input type="hidden" name="dealCodeNumber" id="dealCodeNumber" value=""/>
	</form>
</div>
</div> 
<?php */?> 
<script>
$(document).ready(function(){
	$(".changeShipstatusShopCustom").change(function(){
		var dealCodeNumber=$(this).attr('data-val-id');
		var shipping_status=$(this).val();
		var con = confirm('Whether you want to continue this action?');
		if (con) {
			$("#dealCodeNumber").val(dealCodeNumber);
			$("#shipping_status").val(shipping_status);
			if(shipping_status == 'Shipped'){
				$("#edd").show();
				$("#sid").show();
			}else{
				$("#edd").hide();
				$("#sid").hide();
			}	
			$('#show_orderPopup')[0].click();	
		} else {
				return false;
		}
		$('html, body').animate({
	        scrollTop: 0
	    });
	});	
});
</script>
<script type="text/javascript">
//jQuery.noConflict();				
function search_Orders(){
	var shop = $("#sellerurl").val();
	var from = $("#orderfrom").val();
	var to = $("#orderto").val();
	var id = $("#transaction").val();
	//var order = $("#orderType").val();
	if(id !=''){
		window.location.href= "shops/"+shop+"/shop-orders?id="+id+"";
	}else{
		if((from == '' && to != '') || (from != '' && to == '')){
			alert(lg_Selec_both_fromand_todate);
			return false;
		}
		window.location.href= "shops/"+shop+"/shop-orders?from="+from+"&to="+to+"&id="+id+"";
				
	}
		//window.location.href= "shops/"+shop+"/shop-orders?from="+from+"&to="+to+"&id="+id+"&order="+order+"";
}
</script> 

<style type="text/css">
.section {
    height: 128px;
    width: 24%;
}
.section:first-child {
	margin-left:0px;
}
.heading_account{
	text-align: center;
}
</style>

<?php $this->load->view('site/templates/footer'); ?>