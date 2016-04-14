<?php  $this->load->view('site/templates/header.php');
		$this->load->model('order_model');
?>

<?php #echo "<pre>"; print_r($ViewList); die; ?>

<script src="js/site/jquery-1.9.0.js" type="text/javascript"></script>
<script src="js/jquery.colorbox.js"></script>
<link rel="stylesheet" href="css/default/site/shopsy_style.css" type="text/css" media="all" />
<link rel="shortcut icon" type="image/x-icon" href="images/logo/'.$this->data["fevicon"].'">
<link rel="stylesheet" type="text/css" href="css/default/site/new/colorbox.css" media="all" />


<link rel="stylesheet" type="text/css" media="all" href="css/default/colorbox.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/default/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>

<script type="text/javascript" src="js/site/add_shop_listitems.js"></script>
<script type="text/javascript">
function show_attach() {
	document.getElementById('attach_shw').style.display="block";
}
</script>

<section class="container">

<?php if($this->lang->line('u-') != '') { $u= stripslashes($this->lang->line('u-')); } else{ $u= 'You - '; }?>

<?php if($this->lang->line('just_now') != '') { $just_now= stripslashes($this->lang->line('just_now')); } else{ $just_now= ' just now'; }?>

<?php if($this->lang->line('days_ago') != '') { $days_ago= stripslashes($this->lang->line('days_ago')); } else{ $days_ago= '  days ago'; }?>

<?php if($this->lang->line('hours_ago') != '') { $hours_ago= stripslashes($this->lang->line('hours_ago')); } else{ $hours_ago= ' hours ago'; }?>

<?php if($this->lang->line('mins_ago') != '') { $mins_ago= stripslashes($this->lang->line('mins_ago')); } else{ $mins_ago= ' mins ago'; }?>

<div style="background:none repeat scroll 0 0 #FFFFFF;border-bottom:1px solid #DDDDDD;border-top:1px solid #DDDDDD;padding: 20px 0;" class="add_shop">

  <div class="main">
	<h2 style="margin: 10px;  font-size: 19px; display:inline-block;"><?php if($this->lang->line('user_view_discussion') != '') { echo stripslashes($this->lang->line('user_view_discussion')); } else echo 'View Discussion'; ?> <i><?php echo "#".$claimstatus->row()->id; ?></i></h2> 
	<table class="tab_form_list_table tab_form_list_table-2 top-table" style="float:right; text-align:right; width:auto;">
            <tr>
              <td><strong>
                <?php if($this->lang->line('discussion_order_id') != '') { echo stripslashes($this->lang->line('discussion_order_id')); } else echo 'Order Id'; ?>
                </strong></td>
              <td><?php echo $ViewList->row()->dealCodeNumber; ?></td>
            </tr>
            <tr>
              <td><strong>
                <?php if($this->lang->line('discussion_order_date') != '') { echo stripslashes($this->lang->line('discussion_order_date')); } else echo 'Order Date'; ?>
                </strong></td>
              <td><?php echo $ViewList->row()->created; ?></td>
            </tr>
            <tr>
              <td><strong>
                <?php if($this->lang->line('lg_order_status') != '') { echo stripslashes($this->lang->line('lg_order_status')); } else echo 'Order Status'; ?>
                </strong></td>
              <td><?php echo $ViewList->row()->shipping_status; ?></td>
            </tr>
          </table>
	<div class="view-table-discussion">
    <table class="tab_form_list_table tab_form_list_table-1" style="padding:none;">
      <thead >
        <tr class="table-header">
          <th class="date-wid" style="width:50px;"><?php if($this->lang->line('discussion_bag_items') != '') { echo stripslashes($this->lang->line('discussion_bag_items')); } else echo 'Bag Items'; ?></th>
          <th align="center" style="width:150px;"><?php if($this->lang->line('discussion_product_name') != '') { echo stripslashes($this->lang->line('discussion_product_name')); } else echo 'Product Name'; ?>
            <span class="sort-arrow"></span></th>
          <th class="price-wid"><span>
            <?php if($this->lang->line('discussion_qty') != '') { echo stripslashes($this->lang->line('discussion_qty')); } else echo 'Qty'; ?>
            </span></th>
          <th class="list-wid" style="width: 85px;"><span>
            <?php if($this->lang->line('discussion_unit_price') != '') { echo stripslashes($this->lang->line('discussion_unit_price')); } else echo 'Unit Price'; ?>
            </span></th>
          <th class="date-wid"><?php if($this->lang->line('discussion_sub_total') != '') { echo stripslashes($this->lang->line('discussion_sub_total')); } else echo 'Sub Total'; ?>
            <span class="sort-arrow"></span></th>
        </tr>
      </thead>
      <tbody >
        <?php foreach($ViewList->result() as $product){ ?>
        <?php $imgArr=explode(',',$product->image); ?>
        <tr class="row-1 odd">
          <td class="colsli" style="text-align:center;"><div class="colsli"> 
		  <!-- <a class="list-image12" title="<?php echo $product->product_name; ?>" style="float:none;border:none;"> --> 
		  <a href="products/<?php echo $product->prdurl;?>"><img  alt="<?php echo $product->product_name; ?>" src="images/product/list-image/<?php echo $imgArr[0]; ?>"> </a> </div></td>          <td class="colsli"><a href="products/<?php echo $product->prdurl;?>"><?php echo $product->product_name; ?></a><br />
            <?php echo $product->attribute_values; ?></td>
          <td class="colsli"><?php echo $product->quantity; ?></td>
          <td class="colsli"><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$product->price,2); ?></td>
          <td class="colsli"><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*($product->price*$product->quantity),2); ?></td>
        </tr>
        <?php $subtotal=$subtotal+($product->price*$product->quantity); $shipcost=$shipcost+$product->shippingcost;} ?>
      </tbody>
    </table>
	</div>
    <table class="tab_form_list_table tab_form_list_table-2" style="padding:none;">
      <tr>
	  
		<td>
			<div class="pro-boder" style="padding-top: 45px; width:550px;"></div>
		
			<div class="progress-bar-box" style="top:30px; width:100%;">
						
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
		
		</td>
        
        <td class="view-discussion-tab" align="right" style="float:right; background:#F2F2F2;"><table class="tab_form_list_table tab_form_list_table-2">
            <tr>
              <td><strong>
                <?php if($this->lang->line('discussion_sub_total') != '') { echo stripslashes($this->lang->line('discussion_sub_total')); } else echo 'Sub Total'; ?>
                </strong></td>
              <td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$subtotal,2); ?></td>
            </tr>
            <tr>
              <td><strong>
                <?php if($this->lang->line('checkout_coupon_discount') != '') { echo stripslashes($this->lang->line('checkout_coupon_discount')); } else echo 'Coupon Discount'; ?>
                </strong></td>
              <td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$ViewList->row()->discountAmount,2); ?></td>
            </tr>
            <tr>
              <td><strong>
                <?php if($this->lang->line('checkout_gift_discount') != '') { echo stripslashes($this->lang->line('checkout_gift_discount')); } else echo 'Gift Discount'; ?>
                </strong></td>
              <td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$ViewList->row()->giftdiscountAmount,2); ?></td>
            </tr>
            <tr>
              <td><strong>
                <?php if($this->lang->line('discussion_shipping_cost') != '') { echo stripslashes($this->lang->line('discussion_shipping_cost')); } else echo 'Shipping Cost'; ?>
                </strong></td>
              <td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$shipcost,2); ?></td>
            </tr>
            <tr>
              <td><strong>
                <?php if($this->lang->line('discussion_shipping_tax') != '') { echo stripslashes($this->lang->line('discussion_shipping_tax')); } else echo 'Shipping Tax'; ?>
                </strong></td>
              <td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$ViewList->row()->tax,2); ?></td>
            </tr>
            <tr>
              <td><strong>
                <?php if($this->lang->line('discussion_grand_total') != '') { echo stripslashes($this->lang->line('discussion_grand_total')); } else echo 'Grand Total'; ?>
                </strong></td>
              <td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$ViewList->row()->total,2); ?></td>
			  <input type="hidden" name="grand_total" id="grand_total" value="<?php echo number_format($currencyValue*$ViewList->row()->total,2); ?>" />
            </tr>
          </table></td>
      </tr>
    </table>
    <input type="hidden" id="buyerid" value="<?php echo $ViewList->row()->user_id; ?>" />
    <input type="hidden" id="sellerid" value="<?php echo $ViewList->row()->sell_id; ?>" />
    <p class="discussion-title">
      <?php if($this->lang->line('discussion_board') != '') { echo stripslashes($this->lang->line('discussion_board')); } else echo 'Discussion Board'; ?>
      <span id="totalCmt">(<?php echo $ordercomments->num_rows; ?>)</span></p>
    <div class="post_comment_display">
      <table width="100%" id="comments">
        <?php if($ordercomments->num_rows()>0){?>
        <?php foreach($ordercomments->result() as $comments){ ?>
        <?php
							$posterinfo=$this->order_model->get_all_details(USERS,array('id'=>$comments->posted_id));
							if($posterinfo->row()->thumbnail!=''){
								$post_img=$posterinfo->row()->thumbnail;
							}else{
								$post_img='profile_pic.png';
							}
							/*time frame*/
							$datediff = time()-strtotime($comments->post_time); 
							$diffdate=floor($datediff/(60*60*24));
							if($diffdate!=0){
								if($diffdate<4){
									$cmtTime =$diffdate.$days_ago;
								}else{
									$cmtTime =date('m/d/y',strtotime($comments->post_time));
								}
							}else{
								if(floor($datediff/(60*60))<1){
									if(floor($datediff/(60))>0){
										$cmtTime =floor($datediff/(60)).$mins_ago;
									}else{
										$cmtTime ='just now';
									}
								}else{
									$cmtTime= floor($datediff/(60*60)).$hours_ago;
								}
							}
							if($comments->posted_id==$loginCheck){
								$post_by='You - '.$posterinfo->row()->user_name;
							}else{
								$post_by=$comments->posted_by.' - '.$posterinfo->row()->user_name;
							}
							
						?>
        <tr class="postCMT">
          <td class="post_img"><a href="view-people/<?php echo $posterinfo->row()->user_name; ?>"> <img src="images/users/thumb/<?php echo $post_img; ?>" alt="<?php echo $post_img; ?>" class="post_imgthumb" /> </a> </td>
          <td class="post_msg" width="95%">
          	<p class="post_by"><a href="view-people/<?php echo $posterinfo->row()->user_name; ?>"><strong>	<?php echo ucfirst($post_by); ?></strong></a>
          <span class="cmtTime"><?php echo $cmtTime; ?></span></p>
            <p class="post_message"><?php echo $comments->post_message; ?></p>
			<?php if($comments->image!='') { ?>
				<p style="margin: 0 0 0 26px;">					
					<?php  
						$dispute_string=substr($comments->image,0,-1);
						$dispute_img=explode(',',$dispute_string);
						$count_img=count($dispute_img);
						for($i=0;$i<$count_img;$i++){
					?>
						<a href="images/dispute_images/<?php echo $dispute_img[$i]; ?>" target="_blank"><img src="images/dispute_images/<?php echo $dispute_img[$i]; ?>" style="width:60px;">&nbsp;&nbsp; </a>
					<?php } ?>					
				</p>
			<?php } ?>
            
			</td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr class="post">
          <td class="post_img"><?php if($this->lang->line('discussion_no_discussion') != '') { echo stripslashes($this->lang->line('discussion_no_discussion')); } else echo 'No Discussion Available'; ?></td>
        </tr>
        <?php } ?>
      </table>
    </div>
	
	<?php if($claimstatus->row()->status!='Closed') { ?> 
		
		<form <?php if($ViewList->row()->shipping_status == 'Cancelled'){?>style="display:none;"<?php }?> name="dispute_attachment" id="attach_image" method="post" action="site/order/dispute_attachment_common" onsubmit="return message_validation();">
		<div class="post_textarea">
			<textarea style="width:500px;height:70px;border:1px #dadada solid;  padding: 5px;" id="postcmt" name="postcmt" placeholder="<?php if($this->lang->line('discussion_your_discussion_here') != '') { echo stripslashes($this->lang->line('discussion_your_discussion_here')); } else echo 'Your Discussion Here'; ?>"></textarea>
			<br>
			
			<?php if($segmentidd->num_rows !=0 ) { ?>
				<!--<a href="javascript:void(0);" onclick="return show_attach();">Attachment</a>-->
				
				<?php if( ($ViewList->row()->shipping_status != 'Processed' || $ViewList->row()->shipping_status != 'Shipped') && $ViewList->row()->received_status != 'Not received yet') {?>
					Attachments :<a class="attachment-btn" href="javascript:void(0);" onClick="return dis_val_attach('file_wrapper')"><?php if($this->lang->line('comm_browse') != '') { echo stripslashes($this->lang->line('comm_browse')); } else echo 'Browse'; ?></a>
				<?php }?>
				
			<?php } ?>	
									
				<input type="hidden" id="buyerid" name="buyerid" value="<?php echo $ViewList->row()->user_id; ?>" />
				<input type="hidden" id="sellerid" name="sellerid" value="<?php echo $ViewList->row()->sell_id; ?>" />
				<input type="hidden" name="grand_total" id="grand_total" value="<?php echo number_format($currencyValue*$ViewList->row()->total,2); ?>" />
				<input type="hidden" name="orderid" id="orderid" value="<?php echo $ViewList->row()->dealCodeNumber; ?>">
			
		    <br />

				<div class="list_inner_fields" id="file_wrapper" style="display:none;">
					<label>Images</label>
					<div class="list_inner_right">                        	
						<!--<input type="button" class="addfile_button" value="Add file" />-->
						<label for="file_upload_attach" style="width:25px;" class="addfile_button"><?php echo 'Add'; ?></label>
						<img src="images/loading.gif" id="loadedFile" style="display:none"> </img>
						<input type="file" id="file_upload_attach" name="file_upload_attach" style="display:none;">
						<table width="100%" class="inner_table" border="0" align="center" cellpadding="0" cellspacing="0" id="DigiFiles">     
							<tr id="didgitd" style="display:none;">
							<td style="display:none;">
									<p id="Digi_Files_1"></p>
									<input type="hidden" value="" class="DigiFiles" name="DigiFiles[]">
									<a class="close_icon left" href="javascript:void(0)" style="margin:7px 0 0 5px" id=""></a>
							</td>
							
							</tr>
							<tr style="display:none;">

								<td width="70%"> 
									&nbsp;
									<p id="Digi_Files_1"></p>
									<input type="hidden" value="" class="DigiFiles" name="DigiFiles[]">
								</td>
								<td width="30%">
									<a class="close_icon left" href="javascript:void(0)" style="margin:7px 0 0 5px" id=""></a>
								</td>
							</tr>
						</table>
						<span class="list_div_note list_rightalign"> <?php if($this->lang->line('shop_addupto') != '') { echo stripslashes($this->lang->line('shop_addupto')); } else echo 'Add up to'; ?> <span id="filecount">5</span> <?php if($this->lang->line('file_to_this_post') != '') { echo stripslashes($this->lang->line('file_to_this_post')); } else echo 'files to this post'; ?></span>                            
					</div>
				</div>
				
				
			<?php if($segmentidd->num_rows==0 && $ViewList->row()->user_id==$loginCheck) { ?>	
			<!-- 	<input class="post_comment" type="submit" name="post_dispute" value="<?php if($this->lang->line('open_dispute') != '') { echo stripslashes($this->lang->line('open_dispute')); } else echo 'Open a Dispute'; ?>" /> -->
			<?php } //id="postclaim" ?>
				
			<?php if($segmentidd->num_rows!=0) { ?>
				<?php if( ($ViewList->row()->shipping_status != 'Processed' || $ViewList->row()->shipping_status != 'Shipped') && $ViewList->row()->received_status != 'Not received yet') {?>	
					<input class="post_comment" type="submit" name="post_dispute" value="<?php if($this->lang->line('solved_dispute') != '') { echo stripslashes($this->lang->line('solved_dispute')); } else echo 'Solved Dispute'; ?>" />
				<?php }?>
			<?php } ?>	
			
			<input class="post_comment" style="margin-left:10px;" type="submit" name="post_dispute" value="<?php if($this->lang->line('post') != '') { echo stripslashes($this->lang->line('post')); } else echo 'Post'; ?>" />
			
			<a href="purchase-review"><input class="post_comment" style="margin-left:10px; margin-top:0px;" type="button" name="post_dispute" value="<?php if($this->lang->line('view_usr_msg_back') != '') { echo stripslashes($this->lang->line('view_usr_msg_back')); } else echo 'Back'; ?>" /></a>		
			
			<br><br>
			
			
			<div <?php if($ViewList->row()->shipping_status == 'Processed' && $ViewList->row()->received_status == 'Not received yet') {?> style="display:none"; <?php }?> >
			
			<?php //if($ViewList->row()->shipping_status == 'Delivered' || $ViewList->row()->shipping_status == 'requestProduct') {?>

			<?php if($ViewList->row()->user_id==$loginCheck){?>
			
				<span style="float: left;margin-top: 0px;padding: 3px 7px 0 0; color: #000;">Your status: </span>
				<span class="cancel-bbtn1"><?php echo $ViewList->row()->received_status; ?></span>
				
			<?php }else{?>
			
				<?php if($ViewList->row()->received_status == 'Requested Cancel' && $ViewList->row()->shipping_status == 'Processed'){?>
						<div>
							<p>Kindly approve the transaction has not been processed</p> 
							<p>Buyer Comment 	:<?php echo $ViewList->row()->cancelMessage;?></p>
							<p>Reason			:<?php echo $ViewList->row()->cancelReason;?></p>
							<input type="button" value="approve" onclick="update_order()">
						</div>
						<br>
						<br>
					
				<?php }else if($ViewList->row()->shipping_status == 'Approved for Refund'){?>
				
				<span style="float: left;margin-top:0px;padding: 0px 7px 0px 0px;">Your status: </span>
				<span class="cancel-bbtn1"><?php echo $ViewList->row()->shipping_status; ?></span>
				
			<?php }else{ ?>
				<span style="float: left;margin-top:0px;padding: 0px 7px 0px 0px;">Your status: </span>
				
				<?php if($ViewList->row()->shipping_status == 'ReShipment' || $ViewList->row()->shipping_status == 'Refund' ){ ?>
					<span class="cancel-bbtn1"><?php echo $ViewList->row()->shipping_status; ?></span>
				<?php }?>
				
				<?php if($ViewList->row()->shipping_status != 'ReShipment' && $ViewList->row()->shipping_status != 'Refund' ){ ?>
				<select style="margin-left:0px; width:14em;background: #4CA5C1 !important;border: 1px solid gray !important;" id="post_refund" class="cancel-bbtn1"  name="post_refund">
				<option value="">Select</option>
				
				<option <?php if($ViewList->row()->shipping_status == 'ReShipment'){ echo "selected";} ?> value="ReShipment">Re-Shipment</option>
				<option <?php if($ViewList->row()->shipping_status == 'Refund'){ echo "selected";} ?> value="Refund">Refund</option>
				
				</select> 
				<?php }?>
				
				<?php }?>
				
				
			<?php }?>
			
			


			<?php if($ViewList->row()->user_id == $loginCheck){?>
				<span style="float: left;margin-top: 0px;padding: 0px 7px 0px 20px; color: #000;">Seller status: </span>
				<span class="order-canncel" style="float: left;margin-top: 0px;padding: 0 10px;"><?php echo $ViewList->row()->shipping_status; ?></span>
				
				<br>
				<br>
				<div class="edt" <?php if($ViewList->row()->shipping_status == 'ReShipment'){ ?> style="display:block;" <?php }else{ ?> style="display:none;"  <?php }?>>
					<?php if($ViewList->row()->reshipmentDate == '0000-00-00' || $ViewList->row()->reshipId == '' ){ ?>
						Estimed Delivery Date : <input name="reshipDate" id="reshipDate" type="text" tabindex="6" class="required small tipTop" title="Please select the date" value=""/>
						<br>Shipping Id : <input name="reshipId" id="reshipId" type="text" tabindex="6" class="required small tipTop" title="reshipId" value=""/>
						<input style="display:block;" class="post_comment" style="margin-left:10px;" type="submit" name="post_dispute" value="<?php if($this->lang->line('lg_submit') != '') { echo stripslashes($this->lang->line('lg_submit')); } else echo 'Submit'; ?>" />
					<?php }else{?>
					
						<?php if($ViewList->row()->reshipmentDate != '0000-00-00'){ ?>
							Estimed Delivery Date : <?php echo $ViewList->row()->reshipmentDate;?>
							<?php if($ViewList->row()->reshipId != ''){ ?> Shipping Id: <?php echo $ViewList->row()->reshipId;?> <?php }?>
						<?php }?>
					
					<?php }?>
				</div>
				
			<?php }else{?>
				<span style="float: left;margin-top: 0px;padding: 0px 7px 0px 20px;">Buyer status: </span>
				<span style="float: left;margin-top: 0px;padding: 0px 7px 0px 20px;">
				
				<?php if($ViewList->row()->received_status == 'Requested Cancel'){
						if($this->lang->line('lg_requested_refund') != '') {echo stripslashes($this->lang->line('lg_requested_refund')); } else echo 'Requested Refund';
				} else {?>
				<?php echo $ViewList->row()->received_status; }?>
				
				</span>
				<br>
				<br>
				<div class="edt" <?php if( $ViewList->row()->shipping_status != 'ReShipment'){?> style="display:none;"<?php }?>">
					<?php if($ViewList->row()->reshipmentDate != '0000-00-00'){ ?>
						Estimed Delivery Date : <?php echo $ViewList->row()->reshipmentDate;?>
						<?php if($ViewList->row()->reshipId != ''){ ?> Shipping Id: <?php echo $ViewList->row()->reshipId;?> <?php }?>
					<?php }?>
					
				<input class="post_comment" type="submit" value="Reship a new product" name="post_dispute"/>
					
				</div>
				
			<?php }?>
			
			<?php //}?>
			
			
			<input id="last_submit" style="display:none;" class="post_comment" style="margin-left:10px;" type="submit" name="post_dispute" value="<?php if($this->lang->line('lg_submit') != '') { echo stripslashes($this->lang->line('lg_submit')); } else echo 'Submit'; ?>" />
			
			</div>
			
			
			</div>
			<input type="hidden" name="callmode" id="callmode" value="php"/>
  			</form>
		
			
			<img src="images/ajax_loader_blue.gif" alt="Posting..." id="postLoading" style="display:none;" class="postLoading" />		
		<?php } ?>		
	</div>
</div>
</section>

<!-- <div style="display: none;">
<!-- <div id="shipdate"> -->
<!-- 	<form method="post" action="admin/order/order_update_text"> -->
<!-- 		Estimed Delivery Date:<input name="eventDate" id="eventDate" type="text" tabindex="6" class="required small tipTop" title="Please select the date" value=""/> -->
<!-- 		<input type="submit" value="Go"/> -->
<!-- 		<input type="hidden" name="shipping_status" id="shipping_status" value="Shipped"/> -->
<!-- 		<input type="hidden" name="dealCodeNumber" id="dealCodeNumber"/> -->
<!-- 	</form> -->
<!-- </div> -->
<!-- </div> -->


<script>

window.onload = function(){
	
	new JsDatePick({
		useMode:2,
		//target:"eventDate",
		target:"reshipDate",
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

				
function sub() {
	document.getElementById('post_message').value = document.getElementById('postcmt').value
}

function dis_val_attach(val){	
	document.getElementById(val).style.display="block";	
}

function post_refund(evt){
	//alert("sas");
	alert($("#evt").val());
}


$("#post_refund").change(function() {
	$("#last_submit").show();
	return false;
});

$(".close_icon").click(function() {
	alert(this.id);
});


function removeDigiFiles(evt){
	//alert("asa");
	$filecount = parseInt($('#filecount').html());
	
	$('#filecount').html($filecount + 1);
	$(evt).parent().remove();
	
}

/*
$("#post_refund").change(function() {

	status = $(this).val();

//	if(status == 'Need refund' || status == 'Need reshipment' || status == 'Requested for Product' || status == 'Product Returned' || status == 'ReceivedRet Product' || status == 'ReShipped' || status == 'Refunded' || status == 'Cancel refund' || status == 'Cancel reshipment'){
	if(status == 'ReShipment' || status == 'Refund'){

			document.getElementById('postcmt').value = document.getElementById('postcmt').value  + " "+  $(this).val();

// 			if(status == 'Product Returned'){
// 				$.colorbox({width:"360px", height:"auto",overflow:"auto", open:true, inline:true, href:"#shipdate"});
// 			}
//			return false;

			if(status == 'ReShipment'){
				$("#attach_image").submit();
			}
			
			//$("#attach_image").submit();
			
		}else{

			var dealCodeNumber=$("#orderid").val();

			if(status == 'Processed' || status == 'Shipped' || status == 'Delivered' ){
				var shipping_status = status;
				var received_status = '';
			}else{
				var shipping_status = '';
				var received_status = status;
			}

			$.ajax({
				type:'post',
				url	: baseURL+'site/shop/shoporder_update',
				dataType: 'html',			
				data:{'dealCodeNumber':dealCodeNumber,'shipping_status':shipping_status,'received_status':received_status},
				success: function(response){
					window.location.reload();
				}
			});

		}
	
//	}

 })
 */


function update_order(){
	alert("sasas");

	var dealCodeNumber = $("#orderid").val();
	var shipping_status = 'Approved for Refund';
	
	 $.ajax({
		type:'post',
		url	: baseURL+'site/shop/shoporder_update',
		dataType: 'html',			
		data:{'dealCodeNumber':dealCodeNumber,'shipping_status':shipping_status},
		success: function(response){
			window.location.reload();
		}
	});

}
	
</script>

<?php $this->load->view('site/templates/footer'); ?>