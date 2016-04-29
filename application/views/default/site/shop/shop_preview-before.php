<?php  //echo $selectSeller_details[0]['gift_card']; die; ?>
<?php 
$this->load->view('site/templates/shop_header'); #$checkloginIDarr=$this->session->all_userdata(); echo "<pre>"; print_r($checkloginIDarr);
?>
<?php $shop_name=trim(stripslashes($selectSeller_details[0]['seller_businessname'])); $seourl=$selectSeller_details[0]['seourl'] ?>
		<!--<div class="shop_preview">
        	<div class="main">
            	<p>Complete all four steps above to open your shop! </p>
                <span><a href="#">Let's get started by picking a shop name.</a></span>
             </div>   
        </div>-->
		
		

<div class="clear"></div>
<section class="container">

		<div class="main">
		
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
        </ul>
		
        	<div  class="shop_view">
            	<div class="shop_view_left">
                	<?php if($shop_section_count==0){ ?>
                	<div class="shopview_info">
                    	<a href="shops/<?php echo $seourl; ?>/sections/All"><?php if($this->lang->line('shop_shopsections') != '') { echo stripslashes($this->lang->line('shop_shopsections')); } else echo 'Add shop sections'; ?></a>
                    </div>
                    <?php } else { ?>
                    <div class="shopview_info" style=" background:#E9E9E9;">
                    	<p style="font-size:12px; float:left;"><strong><?php if($this->lang->line('shopsec_shop') != '') { echo stripslashes($this->lang->line('shopsec_shop')); } else echo 'Shop Sections'; ?></strong></p>
                        <a href="shops/<?php echo $seourl; ?>/sections/All" style="float:left; margin:0 0 0 10px"><?php if($this->lang->line('user_edit') != '') { echo stripslashes($this->lang->line('user_edit')); } else echo 'Edit'; ?></a>
                        <div style="float:left; width:100%; margin:5px 0" >
                            <ul>                        
                                <li>
                                <a href="shop/sell"><?php if($this->lang->line('shopsec_shophome') != '') { echo stripslashes($this->lang->line('shopsec_shophome')); } else echo 'Shop home'; ?><span> <?php echo count($product); ?> <?php if($this->lang->line('shop_items') != '') { echo stripslashes($this->lang->line('shop_items')); } else echo 'items'; ?></span></a>
                                </li>
                                <?php foreach($shop_section_details as $section) {  
                                $shop_link = base_url().'shops/'.$seourl.'/Preview/'.$section['section_id'];
                                if($section['shop_prod_count']>0){
                                ?>
                            	<li>
                                    <a href="<?php echo $shop_link; ?>">
                                    <?php echo stripslashes($section['section_name']); ?><span>&nbsp;<?php echo stripslashes($section['shop_prod_count']); ?></span>
                                    </a>
                                </li>
                               <?php } } ?>
                        	</ul>
                    	</div>
                    
                    </div>
                    <?php } ?>
                    
                    <!--- Shop Owner section Starts---->
						<?php 
                        if($selectUser_details[0]['thumbnail']!="" && $selectUser_details[0]['full_name']!="" && $selectUser_details[0]['city']!="")
                        { 
                        echo '<div class="shopview_info" style=" background:#E9E9E9;">';
                        } 
                        else 
                        { 
                        echo '<div class="shopview_info">'; 
                        } 
                        ?>
                    	<?php if($selectUser_details[0]['thumbnail']!=""){ $Pro_pic=$selectUser_details[0]['thumbnail']; }else { $Pro_pic='profile_pic.png';} ?>
                    	<p style="font-size:12px; float:left;"><strong><?php if($this->lang->line('user_shop_owner') != '') { echo stripslashes($this->lang->line('user_shop_owner')); } else echo 'Shop Owner'; ?></strong></p>
                        <a href="shops/<?php echo $seourl; ?>/profile" style="float:left; margin:0 0 0 10px"><?php if($this->lang->line('user_edit') != '') { echo stripslashes($this->lang->line('user_edit')); } else echo 'Edit'; ?></a>
                        <div style="float:left; width:100%; margin:5px 0" >
                        	<a href="shop/sell" style="float:left"><img src="images/users/thumb/<?php echo $Pro_pic; ?>" width="50" height="50" /></a>
                            <?php if($selectUser_details[0]['thumbnail']==""){ ?>
                            <a href="shops/<?php echo $seourl; ?>/profile" style="float:left; margin:8px 0 0 10px; width:50%; line-height:normal; font-size:12px;"><?php if($this->lang->line('shop_addpropict') != '') { echo stripslashes($this->lang->line('shop_addpropict')); } else echo 'Add profile picture'; ?></a>
                            <?php } ?>
                        </div>
                        <a href="shop/sell" style="float:left; font-size:12px; color:#664fa6; width:100%; font-weight:bold"><?php echo $selectUser_details[0]['full_name']; ?></a>
                        <?php 
						if($selectUser_details[0]['city']!=""){ 
						echo '<span style="float:left; font-size:11px; color:#666; font-weight:normal; margin:0; line-height: 11px;">'.$selectUser_details[0]['city'].'</span>'; } else{ 
						?>
                        <a href="shops/<?php echo $seourl; ?>/profile" style="float:left; font-size:11px; color:664fa6; font-weight:normal; margin:5px 0"><?php if($this->lang->line('shop_location') != '') { echo stripslashes($this->lang->line('shop_location')); } else echo 'Add location'; ?></a>
                        <?php } ?>
                    </div>
                    <!---  Shop Owner section Ends---->
                    
                    
                    <!--- Shop Policy section Starts---->
                    <?php if($selectSeller_details[0]['welcome_message']!="" && $selectSeller_details[0]['payment_policy']!="" && $selectSeller_details[0]['shipping_policy']!="" && $selectSeller_details[0]['refund_policy']!="" && $selectSeller_details[0]['additional_information']!="" && $selectSeller_details[0]['seller_information']!="" ){ ?>
                    
                    <div id="shop-info" class="shopview_info" style=" background:#E9E9E9;">
                    	<p style="font-size:12px; float:left;"><strong><?php if($this->lang->line('shopsec_shopinfo') != '') { echo stripslashes($this->lang->line('shopsec_shopinfo')); } else echo 'Shop Info'; ?></strong></p>
                        <a href="policies/<?php echo $seourl; ?>/shop-policy" style="float:left; margin:0 0 0 10px"><?php if($this->lang->line('user_edit') != '') { echo stripslashes($this->lang->line('user_edit')); } else echo 'Edit'; ?></a>
                    	<ul>
                            <li class="shopname">
                                <a href="shop/sell"><span class="shop-icon">&nbsp;&nbsp;&nbsp;&nbsp;</span><?php echo $shop_name; ?></a>
                                <div style="font-size:11px;"><?php if($this->lang->line('shopsec_openedon') != '') { echo stripslashes($this->lang->line('shopsec_openedon')); } else echo 'Opened on'; ?> <?php echo substr($selectSeller_details[0]['created'],0,10); ?></div>
                            </li>
                            <li class="policies">
                                <a href="policies/<?php echo $seourl; ?>/shop-policy"><?php if($this->lang->line('shopsec_policy') != '') { echo stripslashes($this->lang->line('shopsec_policy')); } else echo 'Policies'; ?></a>
                            </li>
                    
                            <li class="seller_info">
                                    <a href="policies/<?php echo $seourl; ?>/Seller-Information"><?php if($this->lang->line('shop_sellerinformation') != '') { echo stripslashes($this->lang->line('shop_sellerinformation')); } else echo 'Seller Information'; ?></a>
                            </li>                        
                        </ul>
                    </div>
                    
                    <?php } else { ?>
                    
                    <div class="shopview_info">
                    	<a href="policies/<?php echo $seourl; ?>/shop-policy"><?php if($this->lang->line('shop_shoppolicy') != '') { echo stripslashes($this->lang->line('shop_shoppolicy')); } else echo 'Add shop policies'; ?></a>
                    </div>
                    <?php } ?>
                    
                <?php if($Paidproduct->num_rows()>0){ ?>
                <div class="shopview_info">
                	<a href="promote-shop"><?php if($this->lang->line('shop_mainimg') != '') { echo stripslashes($this->lang->line('shop_mainimg')); } else echo 'Your Main Image'; ?></a>
                </div>
                <div class="shopview_info">
                	<a href="shop/reviews"><?php if($this->lang->line('shop_shopreview') != '') { echo stripslashes($this->lang->line('shop_shopreview')); } else echo 'Shop Reviews'; ?></a>
                </div>
                <div class="shopview_info">
                	<a href="shops/<?php echo $selectSeller_details[0]['seourl']; ?>/coupon-code"><?php if($this->lang->line('shop_nav_coupon') != '') { echo stripslashes($this->lang->line('shop_nav_coupon')); } else echo 'Coupon Codes'; ?></a>
                </div>
                <div class="shopview_info">
                	<a href="shops/<?php echo $selectSeller_details[0]['seourl']; ?>/contact-user"><?php if($this->lang->line('shop_nav_user_contact') != '') { echo stripslashes($this->lang->line('shop_nav_user_contact')); } else echo 'User Contacts'; ?></a>
                </div>
                <div class="shopview_info">
                	<a href="shops/<?php echo $selectSeller_details[0]['seourl']; ?>/shop-transaction"><?php if($this->lang->line('shop_nav_shop_trans') != '') { echo stripslashes($this->lang->line('shop_nav_shop_trans')); } else echo 'Transaction'; ?></a>
                </div>
                <div class="shopview_info">
                	<a href="shops/<?php echo $selectSeller_details[0]['seourl']; ?>/shop-orders"><?php if($this->lang->line('shop_nav_shop_orders') != '') { echo stripslashes($this->lang->line('shop_nav_shop_orders')); } else echo 'Orders'; ?></a>
                </div>
				<div class="shopview_info">
                	<a href="shops/<?php echo $selectSeller_details[0]['seourl']; ?>/commision-tracking"><?php if($this->lang->line('shop_nav_earn_list') != '') { echo stripslashes($this->lang->line('shop_nav_earn_list')); } else echo 'Earnings List'; ?></a>
                </div>
				<div class="shopview_info">
                	<a href="shops/<?php echo $selectSeller_details[0]['seourl']; ?>/withdraw-req"><?php if($this->lang->line('shop_nav_with_request') != '') { echo stripslashes($this->lang->line('shop_nav_with_request')); } else echo 'Withdrawal Request'; ?>
					</a>
                </div>
				<div class="shopview_info">
                	<a href="shops/<?php echo $selectSeller_details[0]['seourl']; ?>/shop-cod"><?php if($this->lang->line('shop_nav_shop_cod') != '') { echo stripslashes($this->lang->line('shop_nav_shop_cod')); } else echo 'Cash on Delivery Orders'; ?></a>
                </div>
				<div class="shopview_info">
                	<a href="shops/<?php echo $selectSeller_details[0]['seourl']; ?>/tax-list">
					<?php if($this->lang->line('shop_nav_shop_tax') != '') { echo stripslashes($this->lang->line('shop_nav_shop_tax')); } else echo 'Your Tax'; ?></a>
                </div>
                <div class="shopview_info">
                	<label><?php if($this->lang->line('shop_accept') != '') { echo stripslashes($this->lang->line('shop_accept')); } else echo 'Accept gift cards'; ?>?</label><input  name="giftcardcheck" id="giftcardcheck"  type="checkbox" <?php if($selectSeller_details[0]['gift_card'] == 'Yes') { echo 'checked="checked"'; } ?>  />
                </div>
                <?php } ?>
                
                
                    <!--- Shop Policy section End---->

                </div>
                <div class="shop_view_right">                
                	                   
                    	<?php if($selectSeller_details[0]['seller_store_image']!=""){ ?>  
                        <div class="shopview_info W96" style="text-align:center; margin-bottom:0; background:#E9E9E9;">    
                          <a href="appearance/<?php echo $seourl; ?>/banner" class="inline-edit-link" style="font-size:12px; font-weight:bold;"><?php if($this->lang->line('user_edit') != '') { echo stripslashes($this->lang->line('user_edit')); } else echo 'Edit'; ?></a>            	
                            <a href="shop/sell">
                                <img src="images/store-banner/<?php echo $selectSeller_details[0]['seller_store_image']; ?>" width="760px" height="100px">
                            </a>
                        </div>
                        <?php } else { ?> 
                        <a href="appearance/<?php echo $seourl; ?>/banner"> 
                        <div class="shopview_info W96" style="text-align:center; height:100px; margin-bottom:0;">                       
                        <p style="margin:35px 0 0px;"><?php if($this->lang->line('shop_addbanner') != '') { echo stripslashes($this->lang->line('shop_addbanner')); } else echo 'Add shop banner'; ?></p>
                        </div>
                        </a>
                        <?php } ?>
                    	
                    
                    <div class="shop_name1">
                    	<div class="shop_name1_left">
                        	<?php  if(stripslashes($selectSeller_details[0]['seller_businessname'])!=""){ ?>
                            <table>
                            <tr><td>
                            <a href="shop/sell" style="font-size:14px; font-weight:bold; line-height:24px; float:left;  text-decoration:none;">
								<?php  echo stripslashes($selectSeller_details[0]['seller_businessname']); ?>
                            </a></td><td>
                            <a href="shop/name" style="font-size:12px; font-weight:bold; line-height:24px;  float:left; width:50%;"><?php if($this->lang->line('user_edit') != '') { echo stripslashes($this->lang->line('user_edit')); } else echo 'Edit'; ?></a>
                            </td></tr>
                            </table>
                            <?php }	else { ?>
                            <a href="shop/name" style="font-size:14px; font-weight:bold; line-height:24px;float:left; width:50%;"><?php if($this->lang->line('shop_addshopnam') != '') { echo stripslashes($this->lang->line('shop_addshopnam')); } else echo 'Add Shop Name'; ?></a>
                            <?php } ?>
                            <?php if(trim($selectSeller_details[0]['shop_title'])!=""){ ?>
                            <table>
                            <tr><td>
                            <span style="font-size:12px; line-height:24px;   float:left;  text-decoration:none;">
								<?php  echo stripslashes($selectSeller_details[0]['shop_title']); ?>
                            </span></td><td>
                            <a href="appearance/<?php echo $seourl; ?>/shop-title" style="font-size:10px; font-weight:bold; margin:0px 0 0px 10px; float:left; width:50%;"><?php if($this->lang->line('user_edit') != '') { echo stripslashes($this->lang->line('user_edit')); } else echo 'Edit'; ?></a>
                            </td></tr>
                            </table>
                            <?php }	else { ?>
    	                    <a href="appearance/<?php echo $seourl; ?>/shop-title" style="font-size:12px; font-weight:normal; margin:0 0 10px 20px; float:left; line-height:normal"><?php if($this->lang->line('shop_addshoptitle') != '') { echo stripslashes($this->lang->line('shop_addshoptitle')); } else echo 'Add Shop title'; ?></a><?php } ?>
                        </div>    
                       <?php /* <div class="shop_name1_right">
                        	<a href="appearance/<?php echo $seourl; ?>/social-connections">
                            	<span style="float:left; margin:3px 0 0"><?php if($this->lang->line('shop_getsocial') != '') { echo stripslashes($this->lang->line('shop_getsocial')); } else echo 'Get social'; ?></span>
                                <img src="images/fb.png"  style="margin:5px 4px 0; float:left"/>
                                <img src="images/tweet.png"  style="margin:5px 0 0; float:left"/>
                            </a>
                        </div> */ ?>
                    </div>
                    
                    <?php if(trim($selectSeller_details[0]['shop_announcement'])!=""){ ?>
                    	<div class="shop_name2" style="background:#E9E9E9;">
                        <a href="appearance/<?php echo $seourl; ?>/shop-announcement" class="inline-edit-link1" style="font-size:9px; font-weight:bold;"><?php if($this->lang->line('user_edit') != '') { echo stripslashes($this->lang->line('user_edit')); } else echo 'Edit'; ?></a>
                    	<span style="float:left; margin:5px 0 5px 18px;"><?php echo $selectSeller_details[0]['shop_announcement']; ?></span>
                        </div>
                    <?php } else {?>
                    	<div class="shop_name2">
                    	<a href="appearance/<?php echo $seourl; ?>/shop-announcement" style="float:left; margin:5px 0 5px 18px"><?php if($this->lang->line('shop_addshopannoun') != '') { echo stripslashes($this->lang->line('shop_addshopannoun')); } else echo 'Add shop announcement'; ?></a>
                        </div>
                    <?php } ?>
                    
                    
                    
                    <div class="shop_name2" id="giftcardstatus" <?php if($selectSeller_details[0]['gift_card'] == 'Yes') { echo 'style="display:block"'; } else { echo 'style="display:none"'; }?>>
                    	<div class="shop-giftcard-callout clear">
                            <p>
                            <span class="gc-icon" style="float:left"></span>
                           &nbsp;<img src="images/gift1.png" /> <span><?php if($this->lang->line('shopsec_accepts') != '') { echo stripslashes($this->lang->line('shopsec_accepts')); } else echo 'This shop accepts'; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('giftcard_cards') != '') { echo stripslashes($this->lang->line('giftcard_cards')); } else echo 'Gift Cards'; ?>.</span>
                            </p>
                        </div>
                   </div>
                        
                        
                        
                    <div class="list_wrap">
                    	<?php  if($this->uri->segment(2) == 'sell')
							{
								$this->load->view('site/shop/shop_listings');
							} else  if($this->uri->segment(2) == 'reviews')
							{
								$this->load->view('site/shop/shop_reviews');
							}else{
								$this->load->view('site/shop/shop_listings');
							}
						?>
                    </div>
                </div>
            </div>
         
       
        </section>
<input type="hidden" name="sell_id" id="sell_id" value="<?php echo $selectSeller_details[0]['seller_id']?>">


<script>
$(document).ready(function(){
  $("#giftcardcheck").click(function(){ 
    var Gstatus=$("#giftcardcheck").is(':checked') ? 1 : 0; 
	var sell_id=$("#sell_id").val();  
		$.get('site/shop/ajax_gift_card_status?sell_id='+sell_id+'&status='+Gstatus, function(data) { 
		});
		if(Gstatus == 1){
		$('#giftcardstatus').css('display','block');
		} else {
		$('#giftcardstatus').css('display','none');
		}
  });
});  
</script>
	<a href="#shop_review_popup" class="contact-popup" id="review_popup_link"  data-toggle="modal"></a>
	
    <div id='shop_review_popup' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div id='reportReview'>
					        
				</div>
			</div>
		</div>
	</div>          
 <script src="js/jquery.colorbox.js"></script>
<script>
$(document).ready(function(){

		$(".cboxClose1").click(function(){
			$("#cboxOverlay,#colorbox").hide();
			});
		//Example of preserving a JavaScript event for inline calls.
			$("#onLoad").click(function(){ 
				$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});

});
</script>


<style>

#cboxLoadedContent{background:none;
}

</style>

<?php 
$this->load->view('site/templates/footer');
?>