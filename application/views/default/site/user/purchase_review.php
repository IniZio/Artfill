<?php 
$this->load->view('site/templates/header');
$this->load->model('product_model');
$this->load->model('user_model');
//echo "<pre>";print_r($PublicProfile->row()); die;
?>
<style>
</style>
<script src="js/site/jquery-1.9.0.js" type="text/javascript"></script>
<script src="js/jquery.colorbox.js"></script>
<!-- <script src="js/jquery.colorbox-min.js"></script> -->
<link rel="stylesheet" type="text/css" media="all" href="css/default/colorbox.css" />

<!--<link rel="stylesheet" href="css/default/site/shopsy_style.css" type="text/css" media="all" />-->
<link rel="shortcut icon" type="image/x-icon" href="images/logo/<?php echo $this->data["fevicon"] ?>">
<link rel="stylesheet" type="text/css" href="css/default/site/new/colorbox.css" media="all" />


<!-- <script src="'.base_url().'js/html5shiv.js"></script> -->

<style>

#cboxClose {
    background: url("../../images/close_img.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: medium none;
    height: 16px;
    position: absolute;
    right: 0;
    text-indent: -9999px;
    top: 8px;
    width: 20px;
}

#cboxClose:hover {
background: url("../../images/buttons-master.20140130192956.png") no-repeat scroll -31px -1326px rgba(0, 0, 0, 0);
}
</style>

<style>
#cboxContent{background:none !important;}

</style>

<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/default/site/base.css" />
<link rel="stylesheet" href="css/default/site/style-menu.css" />
<script>
    $(document).ready(function(){
        $("#nav-mobile").html($("#nav-main").html());
        $("#nav-trigger span").click(function(){
            if ($("nav#nav-mobile ul").hasClass("expanded")) {
                $("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
                $(this).removeClass("open");
            } else {
                $("nav#nav-mobile ul").addClass("expanded").slideDown(250);
                $(this).addClass("open");
            }
        });
    });
</script>
<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<?php }?>
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
		   <li><?php if($this->lang->line('purchases-review') != '') { echo stripslashes($this->lang->line('purchases-review')); } else echo 'Purchases & Reviews'; ?></li>
        </ul>

  	<div class="">
        <div id="header_menu" class="content-wrap-inner clear ">
            <div class="col col4">
                <h1><?php if($this->lang->line('user_purchases') != '') { echo stripslashes($this->lang->line('user_purchases')); } else echo 'Purchases'; ?></h1>
            </div>

        </div>
	</div>
</div>    
<!-- purchases and Review -->        
</header>
</section>

<section class="container">
<!-- header_end -->
<!-- section_start -->
<div class="purchase_review container community_right">    	
     <!-- <div class="main">     -->
    <div>
     
            	<div class="all-purchase-search">
        		<div class="col-md-7 top_list"> <!-- style="width: 75%;margin: 0px;"> -->
                <ul style="width:auto;" class="listtypename">
                    <li class="first_list1 <?php if(!$this->uri->segment(2) && !isset($_GET['query'])){echo 'first_list first_list_seleted';}?>">
                        <a class="top_first_line" href="purchase-review"><?php if($this->lang->line('user_all_purchases') != '') { echo stripslashes($this->lang->line('user_all_purchases')); } else echo 'All Purchases'; ?> <?php if(!$this->uri->segment(2) && !isset($_GET['query'])){echo count($purchaseProducts);} ?></a>
                    </li>
                    <?php if(isset($_GET['query'])){?>
                    <li class="first_list1 <?php if(isset($_GET['query'])){echo 'first_list first_list_seleted';}?>">
                        <a class="top_first_line" ><?php if($this->lang->line('search_result') != '') { echo stripslashes($this->lang->line('search_result')); } else echo 'Search Results'; ?> <?php if(isset($_GET['query'])){ echo count($purchaseProducts);} ?></a>
                    </li>
                    <?php } ?>
                    
					
					<li class="first_list2 <?php if($this->uri->segment(2)=='cod'){echo 'first_list first_list_seleted';}?>">
                        <a class="top_first_line" href="purchases/cod"><?php if($this->lang->line('shop_withdraw_cod') != '') { echo stripslashes($this->lang->line('shop_withdraw_cod')); } else echo 'Cash on Delivery'; ?> <?php if($this->uri->segment(2)=='cod' && count($purchaseProducts)>0){ echo count($purchaseProducts); }?></a>
                    </li>
					
					<li class="first_list2 <?php if($this->uri->segment(2)=='wiretransfer'){echo 'first_list first_list_seleted';}?>">
                        <a class="top_first_line" href="purchases/wiretransfer"><?php if($this->lang->line('wire_transfer_delivery') != '') { echo stripslashes($this->lang->line('wire_transfer_delivery')); } else echo 'Wire Transfer Delivery'; ?> <?php if($this->uri->segment(2)=='wiretransfer' && count($purchaseProducts)>0){ echo count($purchaseProducts); }?></a>
                    </li>
					<li class="first_list2 <?php if($this->uri->segment(2)=='westernunion'){echo 'first_list first_list_seleted';}?>">
                        <a class="top_first_line" href="purchases/westernunion"><?php if($this->lang->line('western_union_delivery') != '') { echo stripslashes($this->lang->line('western_union_delivery')); } else echo 'Western Union Delivery'; ?> <?php if($this->uri->segment(2)=='westernunion' && count($purchaseProducts)>0){ echo count($purchaseProducts); }?></a>
                    </li>
					
					<!--<li class="first_list2 <?php if($this->uri->segment(2)=='canceled'){echo 'first_list first_list_seleted';}?>">
                        <a class="top_first_line" href="purchases/canceled"><?php if($this->lang->line('purchases_canceld') != '') { echo stripslashes($this->lang->line('purchases_canceld')); } else echo 'canceled';?> <?php if($this->uri->segment(2)=='canceled'){ echo count($purchaseProducts); }?></a>
                    </li>
                    <li class="first_list2 <?php if($this->uri->segment(2)=='processing'){echo 'first_list first_list_seleted';}?>">
                        <a class="top_first_line" href="purchases/processing">Processing <?php if($this->uri->segment(2)=='processing'){ echo count($purchaseProducts); }?></a>
                    </li>
                    <li class="first_list3 <?php if($this->uri->segment(2)=='received'){echo 'first_list first_list_seleted';}?>">
                        <a class="top_first_line" href="purchases/received">Received <?php if($this->uri->segment(2)=='received'){ echo count($purchaseProducts); }?></a>
                    </li>
                    <li class="first_list4 <?php if($this->uri->segment(2)=='canceled'){echo 'first_list first_list_seleted';}?>">
                        <a class="top_first_line" href="purchases/canceled">Canceled <?php if($this->uri->segment(2)=='canceled'){ echo count($purchaseProducts); }?></a>
                    </li> -->
					
                </ul>
      			</div>
                    
                    <div class="col-md-5 purchase-search" style="float:inherit">
                        <div class="review-search-bar">
                        <form method="get" action="purchase-review">
                        	<input type="text" placeholder="<?php if($this->lang->line('user_ord_no') != '') { echo stripslashes($this->lang->line('user_ord_no')); } else echo 'Order Number'; ?>" name="query" id="query" value="<?php echo $this->input->get('query'); ?>" />
                        </form>
                        </div>
                    </div>
                </div>
     
     
		<section style="background:#f2efe8">
<?php if($userPurchase->num_rows()==0) {?>
			<div id="bowse-items"class="col10">
            <?php 
					$user_browse_awesome = str_replace("{SITENAME}",$siteTitle,$this->lang->line('user_browse_awesome'));
			?>  
            
            
       		<h3><b><?php if($this->lang->line('user_no_purch_no_prob') != '') { echo stripslashes($this->lang->line('user_no_purch_no_prob')); } else echo 'No Purchases? No Problem'; ?>!</b> <?php if($this->lang->line('user_browse_awesome') != '') { echo stripslashes($user_browse_awesome); } else echo 'Browse '.stripslashes($siteTitle).' for awesome items.'; ?></h3>
           	<ul class="browse-links">
             		<?php $count=0; foreach ($this->data['mainCategories']->result() as $row){ 
							if ($row->cat_name != '' && $row->image != ''){ 
							$commentData = $this->category_model->get_all_counts($row->id,''); 
							if($commentData[0]['disp']>0){ $count++;
                     ?>
                      <li>
                        <a href="category-list/<?php echo $row->id;?>-<?php echo $row->seourl;?>">
                            <div class="browse-image-tag">
                            <img src="images/category/<?php echo $row->image; ?>" width="130" height="130" alt="<?php echo $row->cat_name;?>">
                            <h4><?php echo $row->cat_name;?></h4>
                            </div>
                        </a>
                      </li>
                    <?php 
							if($count==5){break;}
							}
						}						
                    }
                    ?>
                </ul>	
       
       		</div>
<?php } else if($userPurchase->num_rows()>0) { //echo "<pre>"; print_r($purchaseProducts); die;?> 
        	<div class="property_page">
            <?php foreach($purchaseProducts as $Purchase) { ?>
            	<div class="" style="margin:0">                
                <div class="property_right">
                    <div class="property_header">
					
						<div class="order_side-left">
                        <span class="order_text"><?php if($this->lang->line('user_ord_no') != '') { echo stripslashes($this->lang->line('user_ord_no')); } else echo 'Order Number'; ?>: <label class="order_text-number"><?php echo $Purchase->dealCodeNumber; ?></label></span> 
						
						<span><span class="trans_text"><?php if($this->lang->line('user_txn_time') != '') { echo stripslashes($this->lang->line('user_txn_time')); } else echo 'Transaction Time'; ?> <label class="tranr_text-number"><?php echo date('Y-m-d H:i A',$Purchase->inserttime); ?></label></span></span>
											
                        </div>
						
						<div class="order_side-right1">
											
                    	
                        <a class="names-it" href="shop-section/<?php echo $Purchase->shop_seo; ?>"><span class="newimages"></span><?php echo $Purchase->shopname; ?></a>
						<p> <?php if($this->lang->line('user_purch_from') != '') { echo stripslashes($this->lang->line('user_purch_from')); } else echo 'Purchase from'; ?></p>
                        <span class="date-no"><?php echo af_lg('lg_on','ON');?> <?php $datestring ="%M %d,%Y "; $time = $Purchase->inserttime; echo mdate($datestring,$time); ?></span>
						
						</div>
						
                    </div> 
                <div class="property-section">
                <?php if($Purchase->thumbnail!=''){ $profile_pic='users/thumb/'.$Purchase->thumbnail; } else { $profile_pic='default_avat.png';}?>
                    <div class="property_section_top">
                        <img src="images/<?php echo $profile_pic; ?>" />                                          
                    </div>
					
					<div class="property_section_top_right">
					
						<h2><a href="products/<?php echo $Purchase->productSeourl; ?>"><?php echo $Purchase->product_name;?></a></h2>
						
						 <h4>
							<?php if($this->lang->line('user_from') != '') { echo stripslashes($this->lang->line('user_from')); } else echo 'From'; ?> <?php echo $Purchase->ship_from; ?>
							<!-- <a class="hover_content" > -->
							<a><?php if($this->lang->line('user_to') != '') { echo stripslashes($this->lang->line('user_to')); } else echo 'to'; ?> <?php echo $Purchase->shippingcountry; ?><div class="hover_lin">
							<!-- <span><?php echo $Purchase->shippingcity; ?></span>
							<span><?php echo $Purchase->shippingstate; ?></span>
							<span><?php echo $Purchase->shippingcountry; ?></span>
							<span class="blak-arrow"></span> -->
						</div></a>
						
						</h4>
						
						<h3 style="display:block;"><span class="dolar-value"><?php echo $currencySymbol; ?> <?php echo number_format($currencyValue * $Purchase->total,2);?></span><span class="dolar-id currencyType"><?php echo $currencyType; ?></span></h3>
						<h5 style="display:block;"><?php if($this->lang->line('included_buyercommission') != '') { echo stripslashes($this->lang->line('included_buyercommission')); } else echo 'Included buyer commission'; ?>:<span class="dolar-value"><?php echo $currencySymbol; ?> <?php echo number_format($currencyValue * $Purchase->buyercommission_amount,2);?></span><span class="dolar-id currencyType"><?php echo $currencyType; ?></span></h5>
						<h3><span class="dolar-value" style="color:red"><i><?php echo $Purchase->cancelledMessage; ?></i></span></h3>

						<?php //if($purchasestatus!='Cancelled'){ ?>
						<?php if($Purchase->shipping_status != 'Cancelled'){ ?>
	                        <span class="amt_text paid">
	                        <!--<?php if($this->lang->line('user_status') != '') { echo stripslashes($this->lang->line('user_status')); } else echo 'Status'; ?> :--> 
	                        <label class="amt_text-number">
	                        	<?php if($Purchase->status == "Paid"){ if($this->lang->line('paid') != '') { echo stripslashes($this->lang->line('paid')); } else echo 'Paid'; }else{ if($this->lang->line('pending') != '') { echo stripslashes($this->lang->line('pending')); } else echo 'Pending'; } ?>
	                        </label>
	                        </span>
                        <?php } ?>
						
						<?php //if($purchasestatus =='Cancelled'){ ?>
						<?php if($Purchase->shipping_status =='Cancelled'){ ?>
	                        <span class="amt_text pending">
	                        	<!--<?php if($this->lang->line('user_status') != '') { echo stripslashes($this->lang->line('user_status')); } else echo 'Status'; ?> :--> 
	                        	<label class="amt_text-number">
	                        	<?php if($this->lang->line('lg_order_cancelled') != '') { echo stripslashes($this->lang->line('lg_order_cancelled')); } else echo 'OrderCancelled';  ?>
	                        	</label>
	                        </span>
						<?php }?>
						
						 <?php /*if($purchasestatus!='Cancelled'){ ?>
                        <span class="amt_text pending"><!--<?php if($this->lang->line('user_status') != '') { echo stripslashes($this->lang->line('user_status')); } else echo 'Status'; ?> :--> <label class="amt_text-number"><?php if($Purchase->status == "Paid"){ if($this->lang->line('paid') != '') { echo stripslashes($this->lang->line('paid')); } else echo 'Paid'; }else{ if($this->lang->line('pending') != '') { echo stripslashes($this->lang->line('pending')); } else echo 'Pending'; } ?></label></span>
                        <?php } */?>
					
					</div>
					
					<div class="property_section_top_left">
					
					<?php if($Purchase->shipping_status != 'Processed' && $Purchase->shipping_status != 'Shipped' && $Purchase->shipping_status != 'Cancelled'){?>
					<ul class="reviews-bg" style="width: 100%;">
						<li>
							<span onClick="makeReview('<?php echo $Purchase->user_id; ?>','<?php echo $Purchase->product_id; ?>','<?php echo $Purchase->dealCodeNumber; ?>')" class="rev-popup" >Reviews</span><br>
							
							<div style="display:none;">
							<div id="inline_reg1" style=""></div>
							</div>
							
<!--  					<span class="reviews">
                            <div style="width: 51.6px !important;" class="stars small"></div>
                            </span>-->
                            <span onClick="makeReview('<?php echo $Purchase->user_id; ?>','<?php echo $Purchase->product_id; ?>','<?php echo $Purchase->dealCodeNumber; ?>')">
								
								<?php $ratting_value = round($Purchase->starrating);?>
								
								<?php if($ratting_value == 0){?>
											<label class="inactivestar"></label>
											<label class="inactivestar"></label>
											<label class="inactivestar"></label>
											<label class="inactivestar"></label>
											<label class="inactivestar"></label>
								<?php }else{?>
								<?php //$ratting_value=round($Purchase->starrating);
										for($i=1;$i<=5;$i++) { ?> 
					            			<label <?php if($i<=$ratting_value){?>class="star-active"<?php }else{ ?>class="star-inactive" <?php }?>></label>
								<?php }?>
								<?php }?>
								
                             </span>
							
						</li>
						<?php if($this->uri->segment(2)=='wiretransfer' || $this->uri->segment(2)=='westernunion'){?>
						<li>
							<a onclick="showProofOrder('<?php echo $Purchase->payment_type; ?>','<?php echo $Purchase->seller_email; ?>','<?php echo $Purchase->sell_id; ?>','<?php echo $Purchase->dealCodeNumber; ?>','<?php echo $Purchase->shopname; ?>','<?php echo $Purchase->shipping_status; ?>','<?php echo $Purchase->total; ?>','true')" >Submit proof</a>
						</li>
								
						<?php } ?>		
					</ul>
					<?php }?>
					
				
					</div>
                        
                        <div class="order_side-right">
						
						
						<div class="pro-boder"></div>
						
						<div class="progress-bar-box">
						
						
						<?php if($Purchase->shipping_status == 'Processed' || $Purchase->shipping_status == 'Shipped' || $Purchase->shipping_status == 'Delivered'){ 
							$circlestatus = "done";
						}else{
							$circlestatus = "cancel";
                    	}?>
						
						
							<div class="circle firstcircle <?php echo $circlestatus;?> <?php if($Purchase->shipping_status == 'Processed'){ echo "active"; }?>">
						
								<div class="label"></div>
								<div class="title-1">Order Received</div>
							
							</div>
							
							<div class="circle <?php echo $circlestatus;?> <?php if($Purchase->shipping_status == 'Shipped'){ echo "active"; }?>">
							
								<div class="label"></div>
								<div class="title-1">Shipped</div>
								<?php if($Purchase->shipping_status == 'Shipped'){ 
									if($Purchase->estDate!='' && $Purchase->estDate!='0000-00-00'){?>
									<span>EST : <?php echo $Purchase->estDate;?></span>	
									<?php } }?>
							</div>
							
							<div class="circle seccircle <?php echo $circlestatus;?> <?php if($Purchase->shipping_status == 'Delivered'){ echo "active"; }?>">
							
								<div class="label"></div>
								<div class="title-1">Delivered</div>
							
							</div>
						
						</div>
						
						

						
						
						<ul class="purchase-contact">
						
							<li>
							<?php if($purchasestatus=='Cancelled'){ ?>
								<a href="delete-order/<?php echo $Purchase->dealCodeNumber; ?>"><?php if($this->lang->line('user_delete') != '') { echo stripslashes($this->lang->line('user_delete')); } else echo 'Delete this order'; ?></a>
							<?php } ?></li>
							
							
							<?php if($purchasestatus!='Cancelled'){ ?>
							<li style="display:none;">
								 <a class="shop-bbtn" onclick="contacttheshop('<?php echo $this->session->userdata('shopsy_session_user_id'); ?>','<?php echo $Purchase->dealCodeNumber; ?>');" href="javascript:void(0);"><?php if($this->lang->line('user_cont_shop') != '') { echo stripslashes($this->lang->line('user_cont_shop')); } else echo 'Contact the Shop'; ?></a>
							</li>
							
							<li>
<!--						<a class="receipt-bbtn" href="view-order/<?php echo $Purchase->user_id; ?>/<?php echo $Purchase->dealCodeNumber; ?>" target="_blank"><?php if($this->lang->line('user_view_receipt') != '') { echo stripslashes($this->lang->line('user_view_receipt')); } else echo 'View Receipt'; ?></a>-->
							
							<a class="receipt-bbtn" href="view-order-pre/<?php echo $Purchase->user_id; ?>/<?php echo $Purchase->dealCodeNumber; ?>"><?php if($this->lang->line('lg_order_details') != '') { echo stripslashes($this->lang->line('lg_order_details')); } else echo 'Order Details'; ?></a>
							</li>
							
							<?php } ?>
							
							
							<?php /*if($Purchase->received_status != 'Not Received yet' || ($Purchase->shipping_status != 'Processed' && $Purchase->shipping_status != 'Shipped' && $Purchase->shipping_status != 'Delivered')){ }else{?> style="display:none;" <?php }*/?>
							
							
							<?php if($Purchase->received_status == 'Requested Cancel'){?>
							<?php if($Purchase->shipping_status == 'Delivered' || $Purchase->shipping_status == 'ReShipment' || $Purchase->shipping_status == 'Refund'){ ?>
							<li>
								<a target="_blank" class="discussion-bbtn" href="discussion/<?php echo $Purchase->dealCodeNumber; ?>"><?php if($this->lang->line('user_view_discussion') != '') { echo stripslashes($this->lang->line('user_view_discussion')); } else echo 'View Discussion'; ?></a>
							</li>
							<?php }?>
							<?php }?>
							
							
							<?php if($Purchase->received_status == 'Requested Cancel') { //echo $Purchase->shipping_status;?>
							<li>
								<?php if($Purchase->shipping_status != 'Cancelled'  ){?>
									 <?php if($Purchase->shipping_status == 'ReShipment'){?>  
										<a class="cancel-bbtn"><?php if($this->lang->line('lg_reshipment') != '') { echo stripslashes($this->lang->line('lg_reshipment')); } else echo 'Reshipment'; ?></a>								 
									 <?php }elseif($Purchase->shipping_status == 'Refund'){?>
									 	<a class="cancel-bbtn"><?php if($this->lang->line('lg_refund') != '') { echo stripslashes($this->lang->line('lg_refund')); } else echo 'Refund'; ?></a>
									 <?php }elseif($Purchase->shipping_status == 'Processed'){?>
											<a class="cancel-bbtn"><?php if($this->lang->line('lg_requested_refund') != '') { echo stripslashes($this->lang->line('lg_requested_refund')); } else echo 'Requested Refund'; ?></a>
									<?php }elseif($Purchase->shipping_status == 'Delivered'){?>
											<a class="cancel-bbtn"><?php if($this->lang->line('lg_requested_return_replace') != '') { echo stripslashes($this->lang->line('lg_requested_return_replace')); } else echo 'Requested Return / Replace'; ?></a>
									<?php }?>
								<?php }?>
							</li>

							<?php }else if($Purchase->shipping_status == 'Processed'){?>
								<li>
									<a class="cancel-bbtn"  onclick="showCancelOrder('<?php echo $Purchase->seller_email; ?>','<?php echo $Purchase->sell_id; ?>','<?php echo $Purchase->dealCodeNumber; ?>','<?php echo $Purchase->shopname; ?>','<?php echo $Purchase->shipping_status; ?>','<?php echo $Purchase->total; ?>','false')" ><?php if($this->lang->line('lg_cancel_order') != '') { echo stripslashes($this->lang->line('lg_cancel_order')); } else echo 'Cancel Order'; ?></a>
								</li>
							<?php }elseif($Purchase->shipping_status == 'Delivered'){?>
								<li>
									<a class="cancel-bbtn"  onclick="showCancelOrder('<?php echo $Purchase->seller_email; ?>','<?php echo $Purchase->sell_id; ?>','<?php echo $Purchase->dealCodeNumber; ?>','<?php echo $Purchase->shopname; ?>','<?php echo $Purchase->shipping_status; ?>','<?php echo $Purchase->total; ?>','true')" ><?php if($this->lang->line('lg_return_replace') != '') { echo stripslashes($this->lang->line('lg_return_replace')); } else echo 'Return / Replace'; ?></a>
								</li>
							<?php }?>
						</ul>
						
						</div>
									
                </div>
                </div>    
                        		     
            	</div>
            <?php } ?>
        	</div>
<?php } ?>        
		</section> 
	</div> 
</div>
</section>


</div>

	<a href="#contact_shop_popup_container" id="purchase_shop_contact" data-toggle="modal"></a>	
	<a href="#cancel_order_container" id="cancel_order" class="cancelOrder" data-toggle="modal"></a>
	
	<a href="#Submit_proof_container" id="Submit_proof" class="submitproof" data-toggle="modal"></a>
	
	<div class="modal language-popup" id='contact_shop_popup_container' tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div id='contact_shop_popup' style='background:#fff;'>		
  

				</div>
			</div>
		</div>
	</div>

	<div class="modal language-popup" id='cancel_order_container' tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div id='cancel_order_popup' style='background:#fff;'>		
  					
  					<form name="cancel_orderform" id="cancel_orderform" method="post" action="site/order/cancelOrder" >
					<div class="conversation">
					<div class="conversation_container">
					<h2 class="conversation_headline">We are sorry to see that you have to Cancel this item. Tell us why and we'll improve</h2>
					<!-- <div class="conversation_thumb">
					<?php if($CurrUserImg != ''){ $user_pic='users/thumb/'.$CurrUserImg; }
							else{ $user_pic='default_avat.png';} 
					?>
					<img width="75" height="75" src="images/<?php echo $user_pic;?>">
					</div> -->
												
					<div class="conversation_right">
					
<!-- 				<input class="conversation-subject" type="text" name="subject" placeholder="Subject" value="Re: Order #1439537778 on Aug 14,2015 ">  -->
					
	    			<textarea class="conversation-textarea" rows="11" name="message_text" id="message_text" placeholder="Message text"></textarea>
					
					<!--
					<div>
					Required:
					<select id="cancel_type" name="cancel_type" >
					<option value="Need refund">Need refund</option>
					<option value="Need reshipment">Need reshipment</option>
					</select>
					</div>
					-->
					
					<ul id="reason_delivered" style="display:none;">
						<span id="resonError1" class="resonaddError">Please Select your reason</span>
						<li><input type="radio" name="reason" value="Wrong Product received">Wrong Product received</li>
						<li><input type="radio" name="reason" value="Partial Products Recieved/Freebies missed">Partial Products Recieved/Freebies missed</li>
						<li><input type="radio" name="reason" value="Damaged Product Recieved">Damaged Product Recieved</li>
						<li><input type="radio" name="reason" value="Faulty or Defective product recieved">Faulty or Defective product recieved</li>
						<li><input type="radio" name="reason" value="Used OR Open Seal Product Recieved">Used OR Open Seal Product Recieved</li>
					</ul>
					<ul id="reason_processed" style="display:none;">
						<span id="resonError" class="resonaddError">Please Select your reason</span>
						<li><input type="radio" name="reason" value="Products reoredered">Products reoredered</li>
						<li><input type="radio" name="reason" value="Products misplaced">Products misplaced</li>
						<li><input type="radio" name="reason" value="Products ordered without">Products ordered without</li>
					</ul>
					
					<input type="hidden" name="username" id="user_name" value="<?php echo $PublicProfile->row()->full_name;?>">
					<input type="hidden" name="useremail" id="user_email" value="<?php echo $PublicProfile->row()->email;?>">
					<input type="hidden" name="userid" id="user_id" value="<?php echo $PublicProfile->row()->id;?>">
					<input type="hidden" name="sellername" id="seller_name" value="">
					<input type="hidden" name="selleremail" id="seller_email" value="">
					<input type="hidden" name="sellerid" id="seller_id" value="">
					<input type="hidden" name="dealcode_number" id="dealcodeNumber" value="">
					<input type="hidden" name="grand_total" id="grand_total" value="">
					<input type="hidden" name="open_dispute" id="open_dispute" value="">
					
  				</div> 				
					<div class="modal-footer footer_tab_footer" style="width: 100%; ">
						<div class="btn-group">
							<span id="loginloadErr" style="padding: 12px;display:none;"><img src="images/indicator.gif" alt="Loading..."></span>
							<input class="submit_btn" type="button" onclick="javscript:Open_dispute()" value="submit">
								<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel">Cancel</a>
						</div>
					</div>	
				
    			</div>
			    </div>
				
				</form>

				</div>
			</div>
		</div>
	</div>
	
	
	
	<div class="modal language-popup" id='Submit_proof_container' tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div id='cancel_order_popup' style='background:#fff;'>		
  					
  					<form name="submit_proof_form" id="submit_proof_form" method="post" action="site/order/submit_proof" enctype="multipart/form-data" onsubmit="return validate_proof();">
					<div class="conversation">
					<div class="conversation_container">
					<h2 class="conversation_headline">Submit Your proof here.</h2>
												
					<div class="conversation_right">
					
	    			<textarea class="conversation-textarea" rows="11" name="comment" id="prf_message_text" placeholder="Message text"></textarea>
					
					<input type="file" name="proof" id="prooffile"/> 
					
					<input type="hidden" name="buyer_name" id="prf_user_name" value="<?php echo $PublicProfile->row()->full_name;?>">
					<input type="hidden" name="buyer_email" id="prf_user_email" value="<?php echo $PublicProfile->row()->email;?>">
					<input type="hidden" name="buyer_id" id="prf_user_id" value="<?php echo $PublicProfile->row()->id;?>">
					<input type="hidden" name="seller_name" id="prf_seller_name" value="">
					<input type="hidden" name="seller_email" id="prf_seller_email" value="">
					<input type="hidden" name="seller_id" id="prf_seller_id" value="">
					<input type="hidden" name="dealcodenumber" id="prf_dealcodeNumber" value="">
					<input type="hidden" name="payment_type" id="prf_payment_type" value="">
<!-- 					<input type="hidden" name="grand_total" id="prf_grand_total" value=""> -->
<!-- 					<input type="hidden" name="open_dispute" id="prf_open_dispute" value=""> -->
					
  				</div> 				
					<div class="modal-footer footer_tab_footer" style="width: 100%; ">
						<div class="btn-group">
							<input class="submit_btn" type="submit" value="submit">
								<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel">Cancel</a>
						</div>
					</div>	
				
    			</div>
			    </div>
				
				
				</form>

				</div>
			</div>
		</div>
	</div>
	
<script type="text/javascript">
function showCancelOrder(smail,sid,deal,seller,shipstatus,total,open){
	if(shipstatus == 'Delivered') {
		$("#reason_delivered").show();
		$("#reason_processed").hide();
	}else{
		$("#reason_processed").show();
		$("#reason_delivered").hide();
	}
	$("#open_dispute").val(open);
	$("#grand_total").val(total);
	$("#seller_email").val(smail);
	$("#seller_id").val(sid);
	$("#dealcodeNumber").val(deal);
	$("#seller_name").val(seller);
	$( "#cancel_order")[0].click();
}

function showProofOrder(payType,smail,sid,deal,seller,shipstatus,total,open){
	$("#prf_seller_email").val(smail);
	$("#prf_seller_id").val(sid);
	$("#prf_dealcodeNumber").val(deal);
	$("#prf_seller_name").val(seller);
	$("#prf_payment_type").val(payType);
	$("#Submit_proof")[0].click();
}


function Open_dispute(){

	//e.preventDefault();
	$("#loginloadErr").show();

	var postcmt = $("#message_text").val();
	var buyerid = $("#user_id").val();
	var sellerid = $("#seller_id").val();
	var grand_total = $("#grand_total").val();
	var orderid = $("#dealcodeNumber").val();
	var post_dispute = 'Open a Dispute';
	var callmode = 'ajax';
	
	if(postcmt ==''){
		$('#message_text').css('border-color','red');
		//alert("ssassa");
		return false;
	}else if(!$("input[name='reason']").is(':checked')){
		if($("#open_dispute").val() == 'true'){
			$('#resonError1').removeClass('resonaddError');
			$('#resonError1').addClass('resonErrors');
		}else{
			$('#resonError').removeClass('resonaddError');
			$('#resonError').addClass('resonErrors');
		}
		return false;
	}else{
		$('#message_text').css('border-color','#E6E6E6');
		if($("#open_dispute").val() == 'true'){
			$('#resonError1').addClass('resonaddError');
			$('#resonError1').removeClass('resonErrors');
		}else{
			$('#resonError').addClass('resonaddError');
			$('#resonError').removeClass('resonErrors');
		}
		//return true;
	}
	
	if($("#open_dispute").val() == 'true'){
			$.ajax({
			type:'post',
				url	: baseURL+'site/order/dispute_attachment_common',
			data:{'postcmt':postcmt,'buyerid':buyerid,'sellerid':sellerid,'grand_total':grand_total,'orderid':orderid,'post_dispute':post_dispute,'callmode':callmode},
				complete:function(){
				//return true;
					//$("#loginloadErr").hide();
					$("#cancel_orderform").submit();
				
				}
		});
	}else{
				//$("#loginloadErr").hide();
				$("#cancel_orderform").submit();
	}
	

}
function validate_proof(){
	var messTxt = $('#prf_message_text').val();
	var file = $('#prooffile').val();
	if(messTxt ==''){
		$('#prf_message_text').css('border-color','red');
		return false;
	}else if(file ==''){
		$('#prooffile').css('border-color','red');
		return false;
	}else{
		$('#prf_message_text').css('border-color','#E6E6E6');
		$('#prooffile').css('border-color','#E6E6E6');
		return true;
	}
}
</script>
<style>
.resonaddError{display:none;}
.resonErrors{display:block;color:red;}
</style>
<?php 
     $this->load->view('site/templates/footer');
?>