<?php 
$this->load->view('site/templates/header');
$this->load->model('product_model');
$this->load->model('user_model');
//echo "<pre>";print_r($PublicProfile->row()); die;
?>

<!-- css -->
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/default/site/base.css" />
<link rel="stylesheet" href="css/default/site/style-menu.css" />
    <?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<?php } ?>
<div class="add_steps shop-menu-list">

			<div class="main">
				<div id="nav-trigger">
					<span>Menu</span>
				</div>
				<nav id="nav-main">
					<ul id="panel" class="add_steps" style="background:none; box-shadow:none;">
				
					 <li>
	                    <a href="purchase-review"> <?php if($this->lang->line('user_purchases') != '') { echo stripslashes($this->lang->line('user_purchases')); } else echo 'Purchases'; ?> </a>
	                 </li>
	                 
	                <li>
	                     <a href="settings/my-account/<?=$this->session->userdata['shopsy_session_user_name']?>"> <?php if($this->lang->line('user_settings') != '') { echo stripslashes($this->lang->line('user_settings')); } else echo 'Settings'; ?></a>
	                </li>
	                
	                 <li>
	                     <a href="settings/giftcards"> <?php if($this->lang->line('giftcard_cards') != '') { echo stripslashes($this->lang->line('giftcard_cards')); } else echo 'Gift Cards'; ?></a>
	                </li>             
	                
	                <li>
	                     <a href="public-profile"><?php if($this->lang->line('user_pub_profile') != '') { echo stripslashes($this->lang->line('user_pub_profile')); } else echo 'Public Profile'; ?></a>
	                </li>
					</ul>
				</nav>
        	<nav id="nav-mobile"></nav>
			</div>
			
			</div>
			</div>
<div id="profile_div">
<section class="browse-head">

<div class="container">

<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="view-profile/<?php echo $this->session->userdata['shopsy_session_user_name'];?>" class="a_links"><?php echo $this->session->userdata['shopsy_session_user_name'];?></a></li>
		   <span>&rsaquo;</span>
		   <li><?php if($this->lang->line('lg_disputes') != '') { echo stripslashes($this->lang->line('lg_disputes')); } else echo 'Disputes'; ?></li>
</ul>

<div class="">
        <div id="header_menu" class="content-wrap-inner clear ">
            <div class="col col4">
                <h1><?php if($this->lang->line('lg_disputes') != '') { echo stripslashes($this->lang->line('lg_disputes')); } else echo 'Disputes'; ?></h1>
            </div>

        </div>
	</div>
</div>    
</header>
</section>

<section class="container">

<div class="purchase_review container community_right">    	
     <div class="main"> 
	   <div class="feedback-container">
	      <ul class="nav nav-tabs" role="tablist">
	        
	        <li role="presentation" class="active"><a href="#seller" aria-controls="seller" role="tab" data-toggle="tab"><?php echo shopsy_lg('lg_to_you','To You');?></a></li>
	        <li role="presentation"><a href="#buyer" aria-controls="buyer" role="tab" data-toggle="tab"><?php echo shopsy_lg('lg_your_cases','Your Cases');?></a></li>
	        
			<!--<li role="presentation"><a href="#all-fbk" aria-controls="all-fbk" role="tab" data-toggle="tab">All Feedbacks</a></li> -->
	        <!--<li role="presentation"><a href="#fbk-left" aria-controls="fbk-left" role="tab" data-toggle="tab">Feedback left for others</a></li>-->
	      </ul>
      
<!-- <div class="period-choose">
        <label>Period: </label>
        <select id="stats">
            <option value="site/product/reviews" >All</option>
            <option <?php if(isset($_GET['month']) && $_GET['month'] == '12' ){ echo "selected"; }?> value="site/product/reviews?month=12" >12 Months</option>
            <option <?php if(isset($_GET['month']) && $_GET['month'] == '6' ){ echo "selected"; }?> value="site/product/reviews?month=6">6 Months</option>
            <option <?php if(isset($_GET['month']) && $_GET['month'] == '3' ){ echo "selected"; }?> value="site/product/reviews?month=3">3 Months</option>
        </select>
      </div>
 -->
 
       
      <!-- Tab panes -->
      <div class="tab-content fbk-tbl community_right">
	   
        <div role="tabpanel" class="tab-pane active" id="seller">
			   <form class="tab_form_list">
					<?php if($orderListtoYou->num_rows() >0) { ?>
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
					
						
						$i=0; foreach ($orderListtoYou->result() as $row){ $i++; ?>          
                            <tr>      
                            	<td><?php echo $i; ?></td>                      
                                <td><?php echo $row->email;?></td>        
                                <td><?php echo $row->created;?></td>        
                                <td><?php echo $row->dealCodeNumber;?></td>
                                <td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$row->total,2);?></td>
                                <td><?php echo $row->payment_type;?></td>
                                <td>
                                
                                <span style="color:red;"><?php if($row->received_status == 'Requested Cancel' && $row->shipping_status !="Cancelled"){ 
                                	//echo $row->received_status;
                                	if($this->lang->line('lg_requested_refund') != '') {echo stripslashes($this->lang->line('lg_requested_refund')); } else echo 'Requested Refund';

                                	
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
                                <a href="site/shop/vieworder/<?php echo $row->user_id; ?>/<?php echo $row->dealCodeNumber; ?>" target="_blank" title="View"><?php if($this->lang->line('transaction_view') != '') { echo stripslashes($this->lang->line('transaction_view')); } else echo 'View'; ?></a>
                                <br />
								<a href="discussion/<?php echo $row->dealCodeNumber; ?>" title="View Discussion"><?php if($this->lang->line('user_view_discussion') != '') { echo stripslashes($this->lang->line('user_view_discussion')); } else echo 'View Discussion'; ?> </a>
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
        
        
        
        
        
        
        <div role="tabpanel" class="tab-pane" id="buyer">
			<form class="tab_form_list">
					<?php if($orderListbyYou->num_rows() >0) { ?>
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
					
						
						$i=0; foreach ($orderListbyYou->result() as $row){ $i++; ?>          
                            <tr>      
                            	<td><?php echo $i; ?></td>                      
                                <td><?php echo $row->email;?></td>        
                                <td><?php echo $row->created;?></td>        
                                <td><?php echo $row->dealCodeNumber;?></td>
                                <td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$row->total,2);?></td>
                                <td><?php echo $row->payment_type;?></td>
                                <td>
                                
                                <span style="color:red;"><?php if($row->received_status == 'Requested Cancel' && $row->shipping_status !="Cancelled"){ 
                                	//echo $row->received_status;
                                	if($this->lang->line('lg_requested_refund') != '') {echo stripslashes($this->lang->line('lg_requested_refund')); } else echo 'Requested Refund';

                                	
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
                                <a href="site/shop/vieworder/<?php echo $row->user_id; ?>/<?php echo $row->dealCodeNumber; ?>" target="_blank" title="View"><?php if($this->lang->line('transaction_view') != '') { echo stripslashes($this->lang->line('transaction_view')); } else echo 'View'; ?></a>
                                <br />
								<a href="discussion/<?php echo $row->dealCodeNumber; ?>" title="View Discussion"><?php if($this->lang->line('user_view_discussion') != '') { echo stripslashes($this->lang->line('user_view_discussion')); } else echo 'View Discussion'; ?> </a>
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
        <div role="tabpanel" class="tab-pane" id="all-fbk">
           
        </div>
        
      </div>
    </div>
<!-- feedback-container end-->



</div> 
</div>
</section>
</div>
	<div style="display:none;"><div id="inline_reg1"></div></div>
	<a href="#contact_shop_popup_container" id="purchase_shop_contact" data-toggle="modal"></a>
	<a href="#cancel_order_container" id="cancel_order" data-toggle="modal"></a>
	
	<div class="modal fade in language-popup" id='contact_shop_popup_container' tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div id='contact_shop_popup' style='background:#fff;'>		
  

				</div>
			</div>
		</div>
	</div>

	<div class="modal fade in language-popup" id='cancel_order_container' tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div id='cancel_order_popup' style='background:#fff;'>		
  					
  					<form name="cancel_orderform" id="cancel_orderform" method="post" action="site/order/cancelOrder">
					<div class="conversation">
					<div class="conversation_container">
					<h2 class="conversation_headline"><?php echo shopsy_lg('lg_sry_cancelling_item','We are sorry to see that you have to Cancel this item. Tell us why and we will improve');?></h2>
					<div class="conversation_thumb">
					<?php if($CurrUserImg != ''){ $user_pic='users/thumb/'.$CurrUserImg; }
							else{ $user_pic='default_avat.png';} 
					?>
					<img width="75" height="75" src="images/<?php echo $user_pic;?>">
					</div>
												
					<div class="conversation_right">
					
<!-- 				<input class="conversation-subject" type="text" name="subject" placeholder="Subject" value="Re: Order #1439537778 on Aug 14,2015 ">  -->
					
	    			<textarea class="conversation-textarea" rows="11" name="message_text" placeholder="Message text"></textarea>
					
					<!--
					<div>
					Required:
					<select id="cancel_type" name="cancel_type" >
					<option value="Need refund">Need refund</option>
					<option value="Need reshipment">Need reshipment</option>
					</select>
					</div>
					-->
					
					<ul>
					<li><input type="radio" name="reason" value=""><?php echo shopsy_lg('lg_products_reordered','Products reoredered');?></li>
					<li><input type="radio" name="reason" value=""><?php echo shopsy_lg('lg_products_misplaced','Products misplaced');?></li>
					<li><input type="radio" name="reason" value=""><?php echo shopsy_lg('lg_products_reorderdwithout','Products ordered without');?></li>
					<li><input type="radio" name="reason" value=""><?php echo shopsy_lg('products_not_required','Products not required');?></li>
					</ul>
					
					
  				</div> 				
					<div class="modal-footer footer_tab_footer" style="width: 100%; ">
						<div class="btn-group">
							<input class="submit_btn" type="submit" value="send">
								<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php echo shopsy_lg('lg_cancel','Cancel');?></a>
						</div>
					</div>	
				
    			</div>
			    </div>
				
				
				</form>

				</div>
			</div>
		</div>
	</div>
	
<script>
function showCancelOrder(){
	//alert("asssassss");
	//$('#cancel_order_popup').html("");
	$('#cancel_order').trigger('click');	
}
</script>

<?php 
     $this->load->view('site/templates/footer');
?>


<script>
 $(document).ready(function(){
    $("#stats").change(function () {
    	window.location.href = this.options[this.selectedIndex].value;
        });
  });
 </script>