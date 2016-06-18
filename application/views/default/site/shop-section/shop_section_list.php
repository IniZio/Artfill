<?php  
$this->load->view('site/templates/header');
$this->load->model('user_model');
//echo "<pre>";print_r($following_user_list);die;
?>

<?php $footstop = $this->_ci_cached_vars["languageCode"] == "zh_HK" ? "。" : "." ?>

<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;?>footer.css" rel="stylesheet">
<?php  } ?>
<div class="add_shop">
	<div class="main">
		<ul class="add_steps shop-menu-list">
			<li><a href="<?php echo base_url().'shop-section/'.$this->uri->segment(2); ?>"><?php if($this->lang->line('shopsec_shophome') != '') { echo stripslashes($this->lang->line('shopsec_shophome')); } else echo 'Shop home'; ?><span></span></a></li>
			<?php foreach($get_shop_section_list as $shop_section_list_dtls) { 
				/*if($_GET['search_query'] != '')
					{*/
						$shop_link = base_url().'shop-section/'.$this->uri->segment(2).'?section_id='.$shop_section_list_dtls['section_id'];
					/*}else {
						$shop_link = base_url().'shop-section/'.$this->uri->segment(2).'?section_id='.$shop_section_list_dtls['section_id'];
					}*/
				if($shop_section_list_dtls['shop_prod_count'] != 0 && $shop_section_list_dtls['shop_prod_count'] != '') { ?>
					<li><a href="<?php echo $shop_link; ?>"><?php echo stripslashes($shop_section_list_dtls['section_name']); ?></a></li>
		   <?php } } ?>
		</ul>
	</div>
</div>
<div id="shop_page_seller">
<section class="container">
	<div class="main">
		<div class="container">
            <ul class="breadcrumb_top">
				<li><a href="#"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo 'Home'; ?></a></li>
				<li>></li>
				<li><?php echo $this->uri->segment(2);?></li>
            </ul>
			<div class="right_side width-full">
				<div class="add_listimg shop-detail shopview_info">
					<span class="gallery-banner"><img height="315" src="<?php echo base_url()."images/store-banner/".stripslashes($get_seller_details['seller_store_image']); ?>"/>
					
					<div class="shop_view_left1">
					<div class="shopview_info profile-info-img">
						 <?php

						$owner_thumnail = 'dummyProductImage.jpg';						

						if ($get_shop_owner_info['thumbnail'] != ''){

							$owner_thumnail = $get_shop_owner_info['thumbnail'];

						}

						else{

							$owner_thumnail = 'profile_pic.png';

						}

						?>

                        <?php if ($get_shop_owner_info['thumbnail'] != ''){ ?>

                        	<a href="view-people/<?php echo stripslashes($get_shop_owner_info['user_name']); ?>"><img  width="120" height="120"  src="images/users/thumb/<?php echo $owner_thumnail;?>" /></a>

                        <?php } else { ?>

                       		 <a href="view-people/<?php echo stripslashes($get_shop_owner_info['user_name']); ?>"><img  width="120" height="120"  src="images/users/thumb/profile_pic.png" /></a>

                        <?php } ?>
                        <a class="names-it" href="view-people/<?php echo stripslashes($get_shop_owner_info['user_name']); ?>"><?php echo stripslashes($get_shop_owner_info['full_name'])." ".stripslashes($get_shop_owner_info['last_name']);?>  </a>
						 <div class="places"> 
							<?php echo stripslashes($get_shop_owner_info['city']);?> 
							<?php if($get_shop_owner_info['country'] != '' && $get_shop_owner_info['country'] != 0) 
								echo " , ".stripslashes($get_shop_owner_info['country']);
							?>
						 </div>
					</div>
				</div>
					
					</span>
					
					
					
					
						<div class="shop-owner-text">
							<ul>
								<li>
								<?php 
									if($this->session->userdata['shopsy_session_user_id'] != '') {
									if($this->session->userdata['shopsy_session_user_id']==$get_shop_owner_info['seller_id']){
								?>
								<a class="contact_shop_owner-popup" href="#ownshop_contact" data-toggle="modal">
									<?php if($this->lang->line('shopsec_contact') != '') { echo stripslashes($this->lang->line('shopsec_contact')); } else echo 'Contact the shop owner'; ?>
								</a>
								<?php } else { ?>
								<a class="contact_shop_owner-popup" href="#contact_shop_owner" data-toggle="modal">
									<?php if($this->lang->line('shopsec_contact') != '') { echo stripslashes($this->lang->line('shopsec_contact')); } else echo 'Contact the shop owner'; ?>
								</a>
								<?php }} else {?>
								<a class="contact_shop_owner-popup" href="login?action=<?php echo current_url(); ?>">
									<?php if($this->lang->line('shopsec_contact') != '') { echo stripslashes($this->lang->line('shopsec_contact')); } else echo 'Contact the shop owner'; ?>
								</a>
								<?php } ?>
							</li>
							<li>	
							<?php if($loginCheck !=''){
							$favArr = $this->product_model->getUserFavoriteShopDetails(stripslashes($get_seller_details['seller_id']));
							if(empty($favArr)){ ?>
							<a class="favorites" href="javascript:void(0);" onclick="return changeShopToFavourite('<?php echo stripslashes($get_seller_details['seller_id']); ?>','Fresh');">
								<input type="submit" value="" class="hoverfav_icon" />
							</a>
							<?php  } else { ?>                        
							<a class="favorites" href="javascript:void(0);" onclick="return changeShopToFavourite('<?php echo stripslashes($get_seller_details['seller_id']); ?>','Old');">
								<input type="submit" value="" class="hoverfav_icon1" />
							</a>
							<?php }} else { ?>
							<form action="login" method="get" id="my_form">
								<input type="hidden" value="<?php echo 'shop-section/'.$this->uri->segment(2);  ?>" name="action" />
								<a class="favorites" onclick="document.getElementById('my_form').submit();" ><input type="submit" value="" class="hoverfav_icon" /></a>
							</form>
							<?php  } ?> 
						</li>
					</ul>
					<ul class="reviews-bg">
						<li>
							<span><?php echo shopsy_lg('lg_reviews','Reviews');?></span>
							<span class="reviews">
                                <div class="stars small" style="width: <?php echo $get_shop_owner_info['shop_ratting']*17.2 ?>px !important;"> </div>
                            </span>
							
						</li>
					</ul>
				</div>
				<div id="shop-detail-info" class="shopview_info">
					<ul>
						<li><a href="<?php echo base_url().'shop-section/'.$this->uri->segment(2); ?>"><?php  echo stripslashes($get_seller_details['shop_title']); ?></a></li>
						<?php
						
							$seller_shoper_id = stripslashes($get_seller_details['seller_id']);
							#echo $seller_shoper_id;die;
							if($loginCheck!=''){
						?>
							<li><a href="javascript:void(0);" onclick="add_delete_follow(<?php if(!(in_array($seller_shoper_id,$following_user_list))) echo "'add_follow' , '".$seller_shoper_id."'"; else echo "'delete_follow' , '".$seller_shoper_id."'"; ?>)"><?php if(!(in_array($seller_shoper_id,$following_user_list))) echo shopsy_lg('lg_follow', 'Follow'); else echo shopsy_lg('lg_following','Following'); ?></a>
						<?php
							}
						?>
						<li><a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/about'; ?>"><?php if($this->lang->line('user_about') != '') { echo stripslashes($this->lang->line('user_about')); } else echo 'About'; ?></a></li>     
						<li class="policies">
							<a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/policy'; ?>"><?php if($this->lang->line('shopsec_policy') != '') { echo stripslashes($this->lang->line('shopsec_policy')); } else echo 'Policies'; ?></a>
						</li>
						<li class="seller_info">
							<a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/seller-information'; ?>"><?php if($this->lang->line('shop_sellerinformation') != '') { echo stripslashes($this->lang->line('shop_sellerinformation')); } else echo 'Seller Information'; ?></a>
						</li> 
						<!--<li><a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/sales'; ?>"><?php echo count($get_seller_sales_qry); ?> <?php if($this->lang->line('shopsec_sales') != '') { echo stripslashes($this->lang->line('shopsec_sales')); } else echo 'sales'; ?></a></li>
						<li><a href="shops/<?php echo $this->uri->segment(2); ?>/favoriters"><?php echo $Shopadmirers; ?> <?php if($this->lang->line('shopsec_admirers') != '') { echo stripslashes($this->lang->line('shopsec_admirers')); } else echo 'admirers'; ?></a></li>
						<li>
							<span class="reviews">
                                <div class="stars small" style="width: <?php echo $get_shop_owner_info['shop_ratting']*17.2 ?>px !important;"> </div>
                            </span>
						</li>-->
					</ul>
					<ul style="float:right;">
					
					<?php if($loginCheck==''){ $att= current_url(); } else{ $att= current_url()."?aff=".$userDetails->row()->affiliateId;}?>
					<li>
					<div class="addthis_toolbox addthis_default_style addthis_32x32_style" addthis:url="<?php echo $att;?>">
						<a href="<?php echo current_url();?>" class="addthis_button_facebook"></a><!--facebook-->
						<a class="addthis_button_twitter"></a>                              <!--twitter-->
					</div>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50ab628f64d148de"></script>
					</li>
					
<?php /*?>						<li>
							<a href="<?php echo current_url();?>" class="facebook-share-button" data-lang="en" data-count="none">Facebook</a>
						</li>
						
						<li>
							<a href="<?php echo current_url();?>" class="twitter-share-button" data-lang="en" data-count="none"><?php if($this->lang->line('shopsec_tweet') != '') { echo stripslashes($this->lang->line('shopsec_tweet')); } else echo 'Tweet'; ?></a>
						</li>
					<?php */?>						
						
						<li>
                          	<?php 
							if($loginCheck!=''){ 
								if($this->session->userdata['shopsy_session_user_id']==$get_shop_owner_info['seller_id']){?>
							<a title = " Report Shop" class="report-popup" href="#ownshop_report" data-toggle="modal">
								<?php if($this->lang->line('shopsec_report') != '') { echo stripslashes($this->lang->line('shopsec_report')); } else echo 'Report this shop to'; ?> <?php echo $this->config->item('email_title'); ?>
							</a>
									<?php } else {?>
                            <a  title = " Report Shop"  class="report-popup" href="#report_reg" data-toggle="modal">
								<?php if($this->lang->line('shopsec_report') != '') { echo stripslashes($this->lang->line('shopsec_report')); } else echo 'Report this shop to'; ?> <?php echo $this->config->item('email_title'); ?>
							</a>
                            <?php }}else{?> 
                            <form action="login" method="get" id="my_form">
                                <input type="hidden" value="<?php echo 'shop-section/'.$this->uri->segment(2);  ?>" name="action" />
                                <a onclick="document.getElementById('my_form').submit();" ><?php if($this->lang->line('shopsec_report') != '') { echo stripslashes($this->lang->line('shopsec_report')); } else echo 'Report this shop to'; ?> <?php echo $this->config->item('email_title'); ?></a>
                            </form>
                            <?php } ?>
                          </li> 	
					</ul>
				</div>
				<div class="art">
						<ul>
							<li>
								<a <?php if($this->uri->segment(3)=='sales'){?>class="art-active"<?php } ?> href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/sales'; ?>">
									<span class="shop-icon icon-37"></span>
									<span><span><?php echo count($get_seller_sales_qry); ?></span> <?php echo shopsy_lg('lg_sales','Sales');?></span>
								</a>						
							</li>
							<li>
								<a <?php if($this->uri->segment(3)=='favorites'){?>class="art-active"<?php } ?> href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/favorites'; ?>">
									<span class="shop-icon icon-37"></span>
									<span><span><?php echo $Shopadmirers; ?></span> <?php echo shopsy_lg('lg_favorites','Favorites');?>
									</span></span>
								</a>
							</li>
							<li>
								<a <?php if($this->uri->segment(3)==''){?>class="art-active"<?php } ?> href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>">
									<span class="shop-icon icon-37"></span>
									<span><?php echo count($get_shop_selection_products)."   "; ?><?php echo shopsy_lg('lg_products','Products');?></span>
								</a>
							</li>
							<!--<li>
								<a href="">
									<span class="shop-icon icon-37"></span>
									<span><span>6</span> Watched Stores</span>
								</a>
							</li>-->
							<li style="float:right">
								<a <?php if($this->uri->segment(3)=='followings'){?>class="art-active"<?php } ?> href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/followings'; ?>">
									<span class="shop-icon icon-39"></span>
									<span><span><?php echo count($followingUserDetails);?></span>  <?php echo shopsy_lg('lg_follow','Follow');?></span>
								</a>
							</li>
							<li style="float:right">
								<a <?php if($this->uri->segment(3)=='followers'){?>class="art-active"<?php } ?> href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/followers'; ?>">
									<span class="shop-icon icon-38"></span>
									<span><span><?php echo count($followerUserDetails);?></span> <?php echo shopsy_lg('lg_followers','Followers');?></span>
								</a>							
							</li>
						</ul>
					</div>
					
				</div>	
				
				<div class="liner"><div class="imgaddres"></div></div>  
                <?php if($get_shop_owner_info['gift_card'] == 'Yes') {$st='style="display:block"'; } else { $st='style="display:none"'; } ?>
                     <?php  if($this->uri->segment(3) == 'about'){
								$this->load->view('site/shop-section/shop_section_about');
							} else if($this->uri->segment(3) == 'policy'){
								$this->load->view('site/shop-section/shop_section_policy');
							} else if($this->uri->segment(3) == 'seller-information'){
								$this->load->view('site/shop-section/shop_section_seller_information');
							} else if($this->uri->segment(3) == 'reviews'){
								$this->load->view('site/shop-section/shop_section_review');
							} elseif($this->uri->segment(3) == 'favorites'){
								$this->load->view('site/shop-section/shop_section_favorites');
							}elseif($this->uri->segment(3) == 'followers'){
								$this->load->view('site/shop-section/shop_section_followers');
							}elseif($this->uri->segment(3) == 'followings'){
								$this->load->view('site/shop-section/shop_section_followings');
							}else { ?>
               <div class="listings-title">
               <form method="post" name="shop_section_search" id="shop_section_search" action="site/shop_section/shop_section_search_form" autocomplete="off">
                   <input class="text_box" type="text" placeholder="<?php if($this->lang->line('search_shop') != '') { echo stripslashes($this->lang->line('search_shop')); } else echo 'Search in this shop'; ?>" name="search_query" id="search_query" value="<?php echo htmlspecialchars($_GET['search_query']);?>">
                   <input type="hidden" name="current_page_url" id="current_page_url" value="<?php echo current_url().'?';?>" />
                   <!--<input type="text" name="current_page_url" id="current_page_url" value="<?php echo current_url().'?'.$_SERVER['QUERY_STRING'];?>" />-->
                   <input class="subscribe_btn" type="submit" value="<?php if($this->lang->line('seller_srch') != '') { echo stripslashes($this->lang->line('seller_srch')); } else echo 'Search'; ?>">
               </form>
			   <div style=" margin-top: 10px;padding-left: 55px;float: left;">
					<?php 						
						if($get_shop_owner_info['gift_card'] == "Yes"){
					?>
							<b><?php echo shopsy_lg('lg_shop_accpts_giftcards','This Shop Accepts Shopsy Gift Cards.');?><b>
					<?php	}
					?>
					
			   </div>
               <div class="sorting-options">
               <label> <?php if($this->lang->line('seller_sortby') != '') { echo stripslashes($this->lang->line('seller_sortby')); } else echo 'Sort by'; ?>: </label>
                <ul id="menu">
                  <?php
				  		 $get_query_string_vals = $_GET;
						 $shop_selection_query_string_uri = '';
						 foreach($_GET as $query_sting_uri_keys=>$query_sting_uri_vals) {
							if($query_sting_uri_keys != 'page' && $query_sting_uri_keys != 'order'){
								$shop_selection_query_string_uri.= $query_sting_uri_keys."=".$query_sting_uri_vals."&";
							}
						 } 
				  ?>
            <li><a href="javascript:void(0);"><?php if($this->lang->line('shopsec_custom') != '') { echo stripslashes($this->lang->line('shopsec_custom')); } else echo 'Custom'; ?><img src="images/down_arrow.png" /></a>
                <ul style="left: -62px;" class="sub-menu">
                <span class="cursor"></span>
               <?php if($_GET['section_id'] == '') { ?>
               		 <li>
                        <a class="<?php if($_GET['order'] == 'custom') echo 'current_submenu';?>" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'?order=custom&'.rtrim($shop_selection_query_string_uri,'&'); ?>"><?php if($this->lang->line('shopsec_custom') != '') { echo stripslashes($this->lang->line('shopsec_custom')); } else echo 'Custom'; ?></a>
                    </li>
                    <?php } ?>
                    <li>
                        <a class="<?php if($_GET['order'] == 'date_desc') echo 'current_submenu';?>" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'?order=date_desc&'.rtrim($shop_selection_query_string_uri,'&'); ?>"><?php if($this->lang->line('shopsec_recent') != '') { echo stripslashes($this->lang->line('shopsec_recent')); } else echo 'Most Recent'; ?></a>
                    </li>
                    <li>
                        <a class="<?php if($_GET['order'] == 'price_asc') echo 'current_submenu';?>" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'?order=price_asc&'.rtrim($shop_selection_query_string_uri,'&'); ?>"><?php if($this->lang->line('shopsec_lowest') != '') { echo stripslashes($this->lang->line('shopsec_lowest')); } else echo 'Lowest Price'; ?></a>
                    </li>
                    <li>
                        <a class="<?php if($_GET['order'] == 'price_desc') echo 'current_submenu';?>" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'?order=price_desc&'.rtrim($shop_selection_query_string_uri,'&'); ?>"><?php if($this->lang->line('shopsec_highest') != '') { echo stripslashes($this->lang->line('shopsec_highest')); } else echo 'Highest Price'; ?></a>
                    </li>                    
                </ul>
            </li>
    		 <?php
				  		 $get_query_string_vals = $_GET;
						 $shop_selection_query_string_uri = '';
						 foreach($_GET as $query_sting_uri_keys=>$query_sting_uri_vals) {
							if($query_sting_uri_keys != 'view_type'){
								$shop_selection_query_string_uri.= $query_sting_uri_keys."=".$query_sting_uri_vals."&";
							}
						 } 
				  ?>
            </ul>
                <ul class="view-options">
					<?php if($this->uri->segment(3)!=''){ $sales='/'.$this->uri->segment(3);}else{$sales='';} ?>
					<li class="icon1">
						<a class="view_icons selected" data-type="gallery" title="Gallery view" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).$sales.'?view_type=gallery&'.rtrim($shop_selection_query_string_uri,'&'); ?>"></a>
					</li>
					<li class="icon2">
						<a class="view_icons selected" data-type="gallery" title="List view" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).$sales.'?view_type=list&'.rtrim($shop_selection_query_string_uri,'&'); ?>"></a>
					</li>
                </ul>
               </div>
               </div>      
                   <?php 
				   		if($_GET['view_type'] =='gallery' || $_GET['view_type'] ==''){
				  			$this->load->view('site/shop-section/shop_section_product_gallery_style');
						}else if($_GET['view_type'] =='list'){
							$this->load->view('site/shop-section/shop_section_product_list_style');
						}							
					?>
                    <div class="clear"></div>
					<div id="load_ajax_img" style="text-align:center;"> </div>
                    <!--<ul style="width: 55%;" class="page_nav">
						<li>
							<?php echo $pagination_links; ?>
						</li>
                    </ul>  -->
                <?php } ?>
                </div>          
            </div>        
        </div>
    </section>
</div>
	<div id='report_reg' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div style='background:#fff;'>  
					<form action="spam-report" name="span-form" method="post" onsubmit="return validate_spamreport();">
						<div class="conversation" style="width: 86%;">
							<div class="conversation_container">
								<a href="javascript:void(0);" onclick="javascript:$('#report-cancel').trigger('click');">X</a>
								<h5 class="reportspan-head"><?php if($this->lang->line('shopsec_spam') != '') { echo stripslashes($this->lang->line('shopsec_spam')); } else echo 'Report Spam'; ?></h5>
								<br /><br />

								<p style="margin:0 0 0 5px;">

								<a target="_blank" href="pages/intellectual-property-policy"><?php if($this->lang->line('shopsec_property') != '') { echo stripslashes($this->lang->line('shopsec_property')); } else { echo 'This is my intellectual property'; } ?><?php echo $footstop ?></a><br />

								<a target="_blank" href="pages/report-a-problem"> <?php if($this->lang->line('shopsec_ordered') != '') { echo stripslashes($this->lang->line('shopsec_ordered')); } else echo 'I ordered this item and have not received it'; ?><?php echo $footstop ?></a>
								</p>
								<ul> 
									<li>
										<input type="radio" value="The item may not comply with <?php echo $this->config->item('email_title'); ?>'\''s handmade guidelines" name="spam_title" class="spamchk">
										<label> <?php if($this->lang->line('shopsec_comply') != '') { echo stripslashes($this->lang->line('shopsec_comply')); } else echo 'The item may not comply with'; ?> <a target="_blank" href="pages/guidelines"><?php echo $this->config->item('email_title'); ?><?php if($this->lang->line('shopsec_guidelines') != '') { echo stripslashes($this->lang->line('shopsec_guidelines')); } else echo "'s handmade guidelines"; ?></a><?php echo $footstop ?></label>
									</li>
									<li>
										<input  type="radio" value="The item may not be vintage" name="spam_title" class="spamchk">
										<label> <?php if($this->lang->line('shopsec_maynot') != '') { echo stripslashes($this->lang->line('shopsec_maynot')); } else echo "The item may not be"; ?> <a target="_blank" href="pages/guidelines"><?php if($this->lang->line('shopsec_vintage') != '') { echo stripslashes($this->lang->line('shopsec_vintage')); } else echo 'vintage'; ?></a> <?php if($this->lang->line('shopsec_years') != '') { echo stripslashes($this->lang->line('shopsec_years')); } else echo "(20+ years old)"; ?><?php echo $footstop ?></label>
									</li>
									<li>
										<input  type="radio" value="The item is not a supply for crafting or shipping" name="spam_title" class="spamchk">
										<label> <?php if($this->lang->line('shopsec_itemnot') != '') { echo stripslashes($this->lang->line('shopsec_itemnot')); } else echo "The item is not a"; ?> <a target="_blank" href="pages/guidelines"><?php if($this->lang->line('shopsec_supply') != '') { echo stripslashes($this->lang->line('shopsec_supply')); } else echo "supply for crafting or shipping"; ?></a><?php echo $footstop ?></label>
									</li>
									<li>
										<input type="radio" value="The item may be prohibited on <?php echo $this->config->item('email_title'); ?>." name="spam_title" class="spamchk">
										<label > 
<?php if($this->_ci_cached_vars["languageCode"] == "zh_HK"){ ?>
<?php if($this->lang->line('shopsec_itemmay') != '') { echo stripslashes($this->lang->line('shopsec_itemmay')); } else echo "The item may be"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('shop_on') != '') { echo stripslashes($this->lang->line('shop_on')); } else echo "on"; ?> <a target="_blank" href="pages/prohibited-items"><?php if($this->lang->line('prod_prohibited') != '') { echo stripslashes($this->lang->line('prod_prohibited')); } else echo "prohibited"; ?></a><?php echo $footstop ?>

<?php }else{ ?>

<?php if($this->lang->line('shopsec_itemmay') != '') { echo stripslashes($this->lang->line('shopsec_itemmay')); } else echo "The item may be"; ?> <a target="_blank" href="pages/prohibited-items"><?php if($this->lang->line('prod_prohibited') != '') { echo stripslashes($this->lang->line('prod_prohibited')); } else echo "prohibited"; ?></a> <?php if($this->lang->line('shop_on') != '') { echo stripslashes($this->lang->line('shop_on')); } else echo "on"; ?> <?php echo $this->config->item('email_title'); ?><?php echo $footstop ?>

<?php } ?>
</label>
									</li>
									<li>
										<input  type="radio" value="The listing is not labeled as mature content." name="spam_title"  class="spamchk">
										<label><?php if($this->lang->line('shopsec_labeled') != '') { echo stripslashes($this->lang->line('shopsec_labeled')); } else echo "The listing is not labeled as"; ?> <a target="_blank" href="pages/guidelines"><?php if($this->lang->line('prod_content') != '') { echo stripslashes($this->lang->line('prod_content')); } else echo "mature content"; ?></a><?php echo $footstop ?></label>
									</li>
									<input type="hidden" name="p_id" value="" id="p_id" />
									<input type="hidden" name="s_id" value="<?php echo $get_shop_owner_info['seller_id']; ?>" id="s_id" />
									<input type="hidden" name="p_seourl" value="" id="p_seourl" />
									<input type="hidden" name="s_seourl" value="<?php echo $this->uri->segment(2); ?>" id="s_seourl" />
								</ul>
								<textarea name="complaint" placeholder="<?php if($this->lang->line('shopsec_violates') != '') { echo stripslashes($this->lang->line('shopsec_violates')); } else echo "Please explain why this item violates"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('shopsec_policy') != '') { echo stripslashes($this->lang->line('shopsec_policy')); } else echo "Policies"; ?><?php echo $footstop ?>"  id="spam_text"></textarea>
								<center><span class="error" id="spamErr"></span></center>
							</div>				
							<div class="modal-footer footer_tab_footer">
								<div class="btn-group">
										<input class="submit_btn" type="submit" value="<?php if($this->lang->line('shopsec_spam') != '') { echo stripslashes($this->lang->line('shopsec_spam')); } else echo "Report Spam"; ?>" />
										<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php echo shopsy_lg('lg_cancel','Cancel');?></a>
								</div>
							</div>	
						</div>

					</form>
			    </div>
			</div>
		</div>
    </div>

    
	<div id='contact_shop_owner' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div  style='background:#fff;'>  
					<div class="conversation" style="width: 91%;">
						<form name="contactshopowener" id="contactshopowener" method="post" action="site/user/purchasecontactshopowner">
							<div class="conversation_container">
								<h2 class="conversation_headline"><?php if($this->lang->line('new_conversation') != '') { echo stripslashes($this->lang->line('new_conversation')); } else echo "New conversation with"; ?> <?php echo stripslashes($get_shop_owner_info['full_name'])." ".stripslashes($get_shop_owner_info['last_name']);?> <?php if($this->lang->line('shop_from') != '') { echo stripslashes($this->lang->line('shop_from')); } else echo "from"; ?> <?php echo stripslashes($get_seller_details['seller_businessname']); ?></h2>

								<div class="conversation_thumb">
									<img width="75" height="75" src="images/users/thumb/<?php echo $owner_thumnail;?>">
								</div>
								<div class="conversation_right">
									
									<input type="hidden" name="productseourl" id="productseourl" value="<?php echo $added_item_details[0]['seourl']; ?>" >
										<input class="conversation-subject" type="text" name="subject" id="subject" placeholder=<?php echo shopsy_lg('lg_subject','Subject');?> />
										<textarea class="conversation-textarea" rows="11" name="message_text" id="message_text" placeholder="<?php if($this->lang->line('user_msg_txt') != '') { echo stripslashes($this->lang->line('user_msg_txt')); } else echo "Message text"; ?>"></textarea>
										<input type="hidden" name="username" id="username" value="<?php echo $this->session->userdata['shopsy_session_user_name']; ?>" >
										<input type="hidden" name="useremail" id="useremail" value="<?php echo $this->session->userdata['shopsy_session_user_email']; ?>" >
										<input type="hidden" name="userid" id="userid" value="<?php echo $this->session->userdata['shopsy_session_user_id']; ?>" >
										<input type="hidden" name="selleremail" id="selleremail" value="<?php echo $get_seller_details['seller_email']; ?>" >
										<input type="hidden" name="sellerid" id="sellerid" value="<?php echo $get_seller_details['seller_id']; ?>" >
										<input type="hidden" name="dealcode_number" id="dealcode_number" value="" >
										<input type="hidden" name="subject_name" id="subject_name" value="<?php if($this->lang->line('new_conversation') != '') { echo stripslashes($this->lang->line('new_conversation')); } else echo "New conversation with"; ?> <?php echo stripslashes($get_shop_owner_info['full_name'])." ".stripslashes($get_shop_owner_info['last_name']);?> from <?php echo stripslashes($get_seller_details['seller_businessname']); ?>">									
								</div> 
							</div>										
							<div class="modal-footer footer_tab_footer">
								<div id="contact_popupErr" style="color:red;"></div>
								<div class="btn-group">
										<input class="submit_btn" type="submit" value="<?php if($this->lang->line('user_send') != '') { echo stripslashes($this->lang->line('user_send')); } else echo "send"; ?>" onclick="return validat_popup_send();" />
										<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php if($this->lang->line('user_cancel') != '') { echo stripslashes($this->lang->line('user_cancel')); } else echo 'Cancel'; ?></a>
								</div>
							</div>	
						</form>
					</div>
				</div>
			</div>
		</div>	
	</div>
	
	
    <div id='announce_more_popup' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			    <div style='background:#fff;'>  
					 <div class="conversation" style="margin-top: 25%;">
						<div class="conversation_container">
							<div style=" padding: 25px 10px; width: 95.8%;" class="popup-body">
								 <?php echo strip_tags(stripslashes($get_seller_details['shop_announcement'])); ?>
							</div>
						
							<div class="modal-footer footer_tab_footer">
								<div class="btn-group"><a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php if($this->lang->line('shopsec_close') != '') { echo stripslashes($this->lang->line('shopsec_close')); } else echo 'Close'; ?></a></div>
							</div>	
						</div>	
					</div>  
			    </div>
			 </div>
		</div>
	</div>
	<div id='ownshop_contact' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				 <div style='background:#fff;'>  
					<div class="conversation" style="width: 340px; margin-left: 191px; margin-top: 171px;">
						<div class="conversation_container">
							<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;"> <?php if($this->lang->line('cant_contact_ur_shop') != '') { echo stripslashes($this->lang->line('cant_contact_ur_shop')); } else echo 'Whoa!You can\'t contact your own shop.'; ?>  </h2>
							<div class="modal-footer footer_tab_footer">
									<div class="btn-group">
											<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php if($this->lang->line('land_okay') != '') { echo stripslashes($this->lang->line('land_okay')); } else echo 'Okay'; ?></a>
									</div>
							</div>		
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>	

	<div id='ownshop_report' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				 <div style='background:#fff;'>  
					<div class="conversation" style="width: 340px; margin-left: 191px; margin-top: 171px;">
						<div class="conversation_container">
							<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;"> <?php if($this->lang->line('cant_report_ur_shop') != '') { echo stripslashes($this->lang->line('cant_report_ur_shop')); } else echo 'Whoa!You can\'t report your own shop.'; ?>
							 </h2>
							<div class="modal-footer footer_tab_footer">
									<div class="btn-group">
											<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php if($this->lang->line('land_okay') != '') { echo stripslashes($this->lang->line('land_okay')); } else echo 'Okay'; ?></a>
									</div>
							</div>		
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>	
<style>
#shop-detail-info ul li.seller_info{border-right: 1px solid #c8c9cd;}

.reviews-bg {
  background: rgba(255, 255, 255, 0.82);
  display: inline-block;
  padding: 0 0 0 15px;
  width: 95%;
  margin-top: 6px!important;
}
</style>	


<?php $this->load->view('site/templates/footer');?>

