<?php 
$this->load->view('site/templates/header');
$this->load->model('product_model');
$this->load->model('user_model');
//echo "<pre>";print_r($PublicProfile->row()); die;
?>


<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
<!--[if lt IE 9]>
<script src="'.base_url().'js/html5shiv.js"></script>
-->


			
			<div class="add_steps shop-menu-list">

			<div class="main">
				 
				 <?php $this->load->view('site/user/sidebar');?>  
			
			</div>
			
			</div>

			
			

<div id="profile_div">			

<section class="container">
  	
     <div class="main"> 
<!-- feedback-container start -->
   <div class="feedback-container">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        
        <li role="presentation" class="active"><a href="#seller" aria-controls="seller" role="tab" data-toggle="tab"><?php echo af_lg('lg_order_fb','Order Feedbacks');?></a></li>
        <li role="presentation"><a href="#buyer" aria-controls="buyer" role="tab" data-toggle="tab"><?php echo af_lg('lg_purchase_fb','Purchase Feedbacks');?></a></li>
        
        <li role="presentation"><a href="#all-fbk" aria-controls="all-fbk" role="tab" data-toggle="tab"><?php echo af_lg('lg_all_fb','All Feedbacks');?></a></li>
        <!--<li role="presentation"><a href="#fbk-left" aria-controls="fbk-left" role="tab" data-toggle="tab">Feedback left for others</a></li>-->
      </ul>
      <div class="receive-fbk">
       
       <!-- <span class="bid-count">Bid Reactions (last 12 Months): <strong>0</strong></span>-->
      </div>
       <div class="period-choose hole_content">
        <label><?php echo af_lg('lg_period','Period:');?> </label>
        <select id="stats">
            <option value="site/product/reviews" ><?php echo af_lg('lg_all','All');?></option>
            <option <?php if(isset($_GET['month']) && $_GET['month'] == '12' ){ echo "selected"; }?> value="site/product/reviews?month=12" ><?php echo af_lg('lg_12_months','12 Months');?></option>
            <option <?php if(isset($_GET['month']) && $_GET['month'] == '6' ){ echo "selected"; }?> value="site/product/reviews?month=6"><?php echo af_lg('lg_6_months','6 Months');?></option>
            <option <?php if(isset($_GET['month']) && $_GET['month'] == '3' ){ echo "selected"; }?> value="site/product/reviews?month=3"><?php echo af_lg('lg_3_months','3 Months');?></option>
        </select>
      </div>
      <!-- Tab panes -->
      <div class="tab-content fbk-tbl hole_content">
	   
        <div role="tabpanel" class="tab-pane active" id="seller">
			<span class="recv-fbk"><strong><?php echo $user_review->num_rows();?></strong> <?php echo af_lg('lg_fb_received','Feedback(s)  Received');?></span>
			<?php if($user_review->num_rows() != 0){?>
		   <table class="table" id="property_table">
                <thead class="fbk-thead">
                  <tr>
					<th><?php echo af_lg('lg_title','Title');?></th>
                    <th><?php echo af_lg('lg_feedback','Feedback');?></th>
					<th><?php echo af_lg('lg_from_user','From User');?></th>
                    <th><?php echo af_lg('lg_rating','Rating');?></th>
                    <th><?php echo af_lg('lg_when','When');?></th>
                  </tr>
                </thead>
                <tbody>
				<?php
					
						foreach($user_review->result() as $user_rev){
							$date1=strtotime($user_rev->dateAdded);
							$ts1=timespan($date1);
							
							
						
				?>
						  <tr >
							<td>
								<div class="fbk-list">
									<p class="fbk-cnt"><?php echo $user_rev->title; ?></p>
									
								</div>
							</td>
							<td>
								<div class="fbk-list">
									<a  href="javascript:void(0);" onclick="makeReview(<?php echo $user_rev->voter_id.','.$user_rev->seller_product_id.','.$user_rev->deal_code; ?>);">	<p class="fbk-cnt"><?php echo $user_rev->description; ?></p></a>
									
								</div>
							</td>
							<td>
								<a href="view-people/<?php echo $user_rev->user_name;?>"> <?php echo $user_rev->full_name; ?></a>						
								
								
							</td>
							<td>
								 <span class="reviews"><div class="stars small" style="width: <?php  echo $user_rev->rating*17.2;?>px !important;"> </div></span>
								
							</td>
							<td>
								<p><?php echo $ts1." ago";?></p>
							</td>
						  </tr>                
                 <?php
						
					}
				 ?>
                </tbody>
            </table>
			<?php }
			?>

        </div>
        <div role="tabpanel" class="tab-pane" id="buyer">
			<span class="recv-fbk"><strong><?php echo $my_review->num_rows();?></strong><?php echo af_lg('lg_fb_sent','Feedback(s) Sent');?></span>
			<?php if($my_review->num_rows() !=0){?>
		   <table class="table" id="property_table">
                <thead class="fbk-thead">
                  <tr>
					<th><?php echo af_lg('lg_title','Title');?></th>
                    <th><?php echo af_lg('lg_feedback','Feedback');?></th>
				    <th><?php echo af_lg('lg_rating','Rating');?></th>
                    <th><?php echo af_lg('lg_product','Product');?></th>
                    <th><?php echo af_lg('lg_when','When');?></t
                  </tr>
                </thead>
                <tbody>
				<?php					
						foreach($my_review->result() as $user_rev){		
							$date1=strtotime($user_rev->dateAdded);
							$ts2=date('Y-m-d');
							$ts1=timespan($date1);
							
				?>
					
                  <tr >
                    <td>
                        <div class="fbk-list">
                           <?php echo $user_rev->title; ?></p>
                            <span></span>
                        </div>
                    </td>
					<td>
                        <div class="fbk-list">
                            <a  href="javascript:void(0);" onclick="makeReview(<?php echo $user_rev->voter_id.','.$user_rev->seller_product_id.','.$user_rev->deal_code; ?>);"><p class="fbk-cnt"> <p class="fbk-cnt"><?php echo $user_rev->description; ?></p></a>
                           
                        </div>
                    </td>
                   <td>
											
						 <span class="reviews"><div class="stars small" style="width: <?php  echo $user_rev->rating*17.2;?>px !important;"> </div></span>		
					</td>
					<td>
						<a href="products/<?php echo $user_rev->seourl;?>"> <?php echo $user_rev->product_name; ?></a>						
								
					</td>
                    <td>
                        <p><?php echo $ts1." ago";?></p>
                    </td>
                  </tr>
				  <?php }
				  ?>        
                </tbody>
            </table>
			<?php }?>
        </div>
        <div role="tabpanel" class="tab-pane" id="all-fbk">
           <span class="recv-fbk"><strong><?php echo $all_feedback->num_rows();?></strong> <?php echo af_lg('lg_fb','Feedback(s)');?></span>
			<?php if($all_feedback->num_rows() !=0){
					
			?>
		   <table class="table" id="property_table">
                <thead class="fbk-thead">
                  <tr>
					<th><?php echo af_lg('lg_title','Title');?></th>
                    <th><?php echo af_lg('lg_feedback','Feedback');?></th>
				    <th><?php echo af_lg('lg_rating','Rating');?></th>
                    <th><?php echo af_lg('lg_name','Name');?></th>
                    <th><?php echo af_lg('lg_when','When');?></th>
                  </tr>
                </thead>
                <tbody>
				<?php					
						foreach($all_feedback->result() as $user_rev){

							$date1=strtotime($user_rev->dateAdded);
							$ts2=date('Y-m-d');
							$ts1=timespan($date1);
				?>
					
                  <tr >
                    <td>
                        <div class="fbk-list">
                          <p class="fbk-cnt"><?php echo $user_rev->title; ?></p>
                            <span></span>
                        </div>
                    </td>
					<td>
                        <div class="fbk-list">
                           <a  href="javascript:void(0);" onclick="makeReview(<?php echo $user_rev->voter_id.','.$user_rev->seller_product_id.','.$user_rev->deal_code; ?>);">  <p class="fbk-cnt"><?php echo $user_rev->description; ?></p></a>
                           
                        </div>
                    </td>
                   <td>
											
						 <span class="reviews"><div class="stars small" style="width: <?php  echo $user_rev->rating*17.2;?>px !important;"> </div></span>		
					</td>
					<td>
						<a href="products/<?php echo $user_rev->seourl;?>"> <?php echo $user_rev->product_name; ?></a>						
								
					</td>
                    <td>
                        <p><?php echo $ts1;?></p>
                    </td>
                  </tr>
				  <?php }
				  ?>        
                </tbody>
            </table>
			<?php }?>
        </div>
        
      </div>
    </div>
<!-- feedback-container end-->



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
					<h2 class="conversation_headline"><?php echo af_lg('lg_sry_msg','We are sorry to see that you have to Cancel this item. Tell us why and we will improve');?></h2>
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
					<li><input type="radio" name="reason" value=""><?php echo af_lg('lg_products_reordere','Products reoredered');?></li>
					<li><input type="radio" name="reason" value=""><?php echo af_lg('lg_products_misplaced','Products misplaced');?></li>
					<li><input type="radio" name="reason" value=""><?php echo af_lg('lg_pro_order_without','Products ordered without');?></li>
					<li><input type="radio" name="reason" value=""><?php echo af_lg('lg_pro_not_req','Products not required');?></li>
					</ul>
					
					
					
  				</div> 				
					<div class="modal-footer footer_tab_footer" style="width: 100%; ">
						<div class="btn-group">
							<input class="submit_btn" type="submit" value="send">
								<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php echo af_lg('lg_cancel','Cancel');?></a>
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