<?php $this->load->model('user_model');
			
$currentUrl = $this->uri->segment(2,0); $currentPage = $this->uri->segment(3,0);
if($currentUrl==''){$currentUrl = 'dashboard';} if($currentPage==''){$currentPage = 'dashboard';}
?>
<div id="left_bar" >
	<div id="sidebar">
		<div id="secondary_nav">
			<ul id="sidenav" class="accordion_mnu collapsible">
				<li><a href="<?php echo base_url();?>admin/dashboard/admin_dashboard" <?php if($currentUrl=='dashboard'){ echo 'class="active"';} ?>><span class="nav_icon computer_imac"></span> Dashboard</a></li>
				<li><h6 style="margin: 10px 0;padding-left:10px; font-size:13px; font-weight:bold;color:#333; text-transform:uppercase; ">Managements</h6></li>
                
				<?php extract($privileges); 
				if(!$demoserverChk){ if ($this->session->userdata('shopsy_session_admin_mode') =='admin' || $allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='adminlogin'){ echo 'class="active"';} ?>><span class="nav_icon admin_user"></span> Admin<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='adminlogin' || $currentUrl=='sitemapcreate'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/adminlogin/display_admin_list" <?php if($currentPage=='display_admin_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Admin Users</a></li>
					<li><a href="admin/adminlogin/change_admin_password_form" <?php if($currentPage=='change_admin_password_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Change Password</a></li>
					<li><a href="admin/adminlogin/admin_global_settings_form" <?php if($currentPage=='admin_global_settings_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Settings</a></li>
                    <li><a href="admin/adminlogin/admin_smtp_settings" <?php if($currentPage=='admin_smtp_settings'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>SMTP Settings</a></li>
                    <li><a href="admin/sitemapcreate" <?php if($currentUrl=='sitemapcreate'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Sitemap Creation</a></li>
<li><a href="admin/buyer_commission/change_buyer_commission_form" <?php if($currentUrl=='edit_buyer_commission'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Buyer commission</a></li>
				</ul>
				</li>
				<li><a href="#" <?php if($currentUrl=='subadmin'){ echo 'class="active"';} ?>><span class="nav_icon user"></span> Subadmin<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='subadmin'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/subadmin/display_sub_admin" <?php if($currentPage=='display_sub_admin'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Subadmin List</a></li>
					<li><a href="admin/subadmin/featurekey_list" <?php if($currentPage=='featurekey_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Featurekey List</a></li>
					<li><a href="admin/subadmin/add_sub_admin_form" <?php if($currentPage=='add_sub_admin_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New Subadmin</a></li>
				</ul>
				</li>
				<?php }}else{
				 ?>
				<li><a href="#" <?php if($currentUrl=='adminlogin'){ echo 'class="active"';} ?>><span class="nav_icon admin_user"></span> Admin<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='adminlogin' || $currentUrl=='sitemapcreate'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/adminlogin/display_admin_list" <?php if($currentPage=='display_admin_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Admin Users</a></li>
					<li><a href="admin/adminlogin/change_admin_password_form" <?php if($currentPage=='change_admin_password_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Change Password</a></li>
					<li><a href="admin/adminlogin/admin_global_settings_form" <?php if($currentPage=='admin_global_settings_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Settings</a></li>
                    <li><a href="admin/adminlogin/admin_smtp_settings" <?php if($currentPage=='admin_smtp_settings'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>SMTP Settings</a></li>
                    <li><a href="admin/sitemapcreate" <?php if($currentUrl=='sitemapcreate'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Sitemap Creation</a></li>
					
					
				</ul>
				</li>
				<li><a href="#" <?php if($currentUrl=='subadmin'){ echo 'class="active"';} ?>><span class="nav_icon user"></span> Subadmin<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='subadmin'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/subadmin/display_sub_admin" <?php if($currentPage=='display_sub_admin'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Subadmin List</a></li>
					<li><a href="admin/subadmin/add_sub_admin_form" <?php if($currentPage=='add_sub_admin_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New Subadmin</a></li>
				</ul>
				</li>
				<?php } if ((isset($user) && is_array($user)) && in_array('0', $user) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='users'){ echo 'class="active"';} ?>><span class="nav_icon users"></span> Users<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='users'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/users/display_user_dashboard" <?php if($currentPage=='display_user_dashboard'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>
					<li><a href="admin/users/display_user_list" <?php if($currentPage=='display_user_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Users List</a></li>
					<?php if ($allPrev == '1' || in_array('1', $user)){?>
					<li><a href="admin/users/add_user_form" <?php if($currentPage=='add_user_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New User</a></li>
					<!--<li><a href="admin/users/login_through" <?php if($currentPage=='add_user_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>User Login</a></li>-->
					<?php }?>
				</ul>
				</li>
                
				<?php } if ((isset($seller) && is_array($seller)) && in_array('0', $seller) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='seller' || $currentUrl=='commission'){ echo 'class="active"';} ?>><span class="nav_icon users_2"></span> Sellers<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='seller' || $currentUrl=='commission'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/seller/display_seller_dashboard" <?php if($currentPage=='display_seller_dashboard'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>
					<li><a href="admin/seller/display_seller_list" <?php if($currentPage=='display_seller_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Seller List</a></li>
					<!--<li><a href="admin/seller/display_seller_requests" <?php if($currentPage=='display_seller_requests'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Seller Requests</a></li>-->
					<?php  if($paypal_adaptive_settings['status']=='Enable'){ ?>
					<li><a href="admin/commission/display_commission_lists_adaptive" <?php if($currentPage=='display_commission_lists_adaptive'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Site Earnings</a></li>
					<?php }else{ ?>
					<li><a href="admin/commission/display_commission_lists" <?php if($currentPage=='display_commission_lists'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Site Earnings</a></li>
					<?php } ?>
					<li><a href="admin/commission/display_cod_lists" <?php if($currentPage=='display_cod_lists'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>COD Earnings</a></li>
				</ul>
				</li>
                
                <?php } if ((isset($shop) && is_array($shop)) && in_array('0', $shop) || $allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='shop'){ echo 'class="active"';} ?>><span class="nav_icon documents"></span> Shop Details<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='shop'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
				 <li><a href="admin/shop/display_shop" <?php if($currentPage=='display_shop'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>List of Shops</a></li>
				</ul>
				</li>
                
				<?php } if ((isset($category) && is_array($category)) && in_array('0', $category) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='caetgory' || $currentPage=='display_category_list' || $currentPage=='display_banner_list' || $currentPage=='add_banner_form' || $currentPage=='edit_banner_form'){ echo 'class="active"';} ?>><span class="nav_icon category_sl"></span> Category<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='caetgory' || $currentPage=='display_category_list' || $currentPage=='display_banner_list' || $currentPage=='add_banner_form' || $currentPage=='edit_banner_form'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/category/display_category_list" <?php if($currentPage=='display_category_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Category List</a></li>
					
				</ul>
				</li>
                
                <?php } if ((isset($product) && is_array($product)) && in_array('0', $product) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='product' || $currentUrl=='comments'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Product<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='product' || $currentUrl=='comments'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/product/display_product_list" <?php if($currentPage=='display_product_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Product List</a></li>
					<li><a href="admin/product/recent_product_list" <?php if($currentPage=='recent_product_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Recent Product List</a></li>
					<?php /*?><li><a href="admin/product/display_user_product_list" <?php if($currentPage=='display_user_product_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>User Product List</a></li><?php */?>
                   <!-- <li><a href="admin/comments/view_product_comments" <?php if($currentPage=='view_product_comments'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Product Comments List</a></li>-->
					<?php if ($allPrev == '1' || in_array('1', $product)){?>
					<li><a href="shop/admin-listitem" <?php if($currentPage=='add_product_form'){ echo 'class="active"';} ?> target="_blank"><span class="list-icon">&nbsp;</span>Add New Product</a></li>
                    
					<?php }?>
                    <li><a href="admin/product/product_recycle_form" <?php if($currentPage=='product_recycle_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Deleted Product List</a></li>
                    
				</ul>
				</li>
				 <?php }?>
                
                
                <?php if ((isset($featuresettings) && is_array($featuresettings)) && in_array('0', $featuresettings) || $allPrev == '1'){?>
					<li><a href="#" <?php if($currentUrl=='feature' || $currentPage=='display_FeaturePackage_list'  || $currentPage=='add_feature_package' || $currentPage=='edit_Feature_package'){ echo 'class="active"';} ?>><span class="nav_icon category_sl"></span>Feature Package<span class="up_down_arrow">&nbsp;</span></a>
					<ul class="acitem" <?php if($currentUrl=='feature' || $currentPage=='display_FeaturePackage_list' || $currentPage=='add_feature_package' || $currentPage=='edit_Feature_package'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
						<li><a href="admin/product/display_FeaturePackage_list" <?php if($currentPage=='display_FeaturePackage_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Feature Package List</a></li>
						<li><a href="admin/product/add_feature_package" <?php if($currentPage=='add_feature_package'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Feature Package </a></li>
					</ul>
				</li>
                <?php }
                /*if ((isset($affiliatesettings) && is_array($affiliatesettings)) && in_array('0', $affiliatesettings) || $allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='affiliate') {echo 'class="active"';} ?>><span class="nav_icon documents"></span>Affiliate Settings<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='affiliate'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
				 <li><a href="admin/affiliate/affiliate_settings" <?php if($currentPage=='affiliate_settings'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Settings</a></li>
				 <li><a href="admin/affiliate/pending_credits" <?php if($currentPage=='pending_credits'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Pending Credits</a></li>
				</ul>
				</li>
				<?php } ?>
                
                <?php /*} if ((isset($fancyybox) && is_array($fancyybox)) && in_array('0', $fancyybox) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='fancyybox'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Fancyy Box<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='fancyybox'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
	                <li><a href="admin/fancyybox/display_fancybox_dashboard" <?php if($currentPage=='display_fancybox_dashboard'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>
                    <li><a href="admin/fancyybox/fancybox_list" <?php if($currentPage=='fancybox_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Subscribed Fanccybox</a></li>
					<li><a href="admin/fancyybox/display_fancyybox" <?php if($currentPage=='display_fancyybox'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Fancyy Box List</a></li>
					<?php if ($allPrev == '1' || in_array('1', $fancyybox)){?>
					<li><a href="admin/fancyybox/add_fancyybox_form" <?php if($currentPage=='add_fancyybox_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New Fancyy Box</a></li>
					<?php }?>
				</ul>
				</li>
                
                <?php*/ if ((isset($order) && is_array($order)) && in_array('0', $order) || $allPrev == '1'){ ?>
                <li><a href="#" <?php if($currentUrl=='order' || $this->uri->segment(1,0)=='order-review'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Orders<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='order' || $this->uri->segment(1,0)=='order-review'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/order/display_order_paid" <?php if($currentPage=='display_order_paid'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Paid Payment</a></li>
					<li><a href="admin/order/display_order_pending" <?php if($currentPage=='display_order_pending'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Failed Payment</a></li>
                    <li><a href="admin/order/display_order_cod" <?php if($currentPage=='display_order_cod'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Cash On Delivery Payment</a></li>
					<li><a href="admin/order/display_order_wiretransfer" <?php if($currentPage=='display_order_wiretransfer'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Wire Transfer Payment</a></li>
					<li><a href="admin/order/display_order_westernunion" <?php if($currentPage=='display_order_westernunion'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Western Union Payment</a></li>
                    <li><a href="admin/order/display_cancelRequested" <?php if($currentPage=='display_cancelRequested'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Request for Cancel</a></li>
				</ul>
				
				</li>
                <?php if($this->config->item('deal_of_day')=='Yes'){
					if ((isset($deal) && is_array($deal)) && in_array('0', $deal) || $allPrev == '1'){ 
				?>
                <li><a href="#" <?php if($currentUrl=='deals' || $currentUrl=='comments'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span>Deals<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='deals' || $currentUrl=='comments'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
				 
				<li><a href="admin/deals/display_deal_lists" <?php if($currentPage=='display_deal_lists'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Deal of the day list</a></li>
				
				<li><a href="shop/admin-listitem" <?php if($currentPage=='add_deal_form'){ echo 'class="active"';} ?> target="_blank"><span class="list-icon">&nbsp;</span>Add deal</a></li>

				</ul>
				</li>
				<?php }}?>
               <?php /*?> <?php }if ((isset($userorder) && is_array($userorder)) && in_array('0', $userorder) || $allPrev == '1'){ ?>
                <li><a href="#" <?php if($currentUrl=='userorder'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> User Orders<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='userorder'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/userorder/display_user_order_paid" <?php if($currentPage=='display_user_order_paid'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Paid Payment</a></li>
					<li><a href="admin/userorder/display_user_order_pending" <?php if($currentPage=='display_user_order_pending'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Failed Payment</a></li>
				</ul>
				</li><?php */?>
                                
                <?php /*} if ((isset($attribute) && is_array($attribute)) && in_array('0', $attribute) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='attribute'){ echo 'class="active"';} ?>><span class="nav_icon cog_3"></span> List<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='attribute'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/attribute/display_attribute_list" <?php if($currentPage=='display_attribute_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Lists</a></li>
					<li><a href="admin/attribute/display_list_values" <?php if($currentPage=='display_list_values'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>List Values</a></li>
					<?php if ($allPrev == '1' || in_array('1', $attribute)){?>
                    <li><a href="admin/attribute/add_attribute_form" <?php if($currentPage=='add_attribute_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New List</a></li>
                    <li><a href="admin/attribute/add_list_value_form" <?php if($currentPage=='add_list_value_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add List Value</a></li>
					<?php }?>
				</ul>
				</li> */ ?>
               <?php }
                 if ((isset($cart) && is_array($cart)) && in_array('0', $cart) || $allPrev == '1'){ ?>
                            <li><a href="#" <?php if($currentUrl=='cart'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span>Abandoned Cart<span class="up_down_arrow">&nbsp;</span></a>				
               					<ul class="acitem" <?php if($currentUrl=='cart'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
               						<li><a href="admin/cart/abandon_cart_list" <?php if($currentPage=='abandon_cart_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Cart List</a></li>
								</ul>
							</li>
               	<?php }
               
               if ((isset($disputemgmt) && is_array($disputemgmt)) && in_array('0', $disputemgmt) || $allPrev == '1'){ ?>
                               <li><a href="#" <?php if($currentUrl=='claim'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span>Dispute Management<span class="up_down_arrow">&nbsp;</span></a>				
               					<ul class="acitem" <?php if($currentUrl=='claim'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
               						<li><a href="admin/claim/display_claim_list" <?php if($currentPage=='display_claim'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Dispute List</a></li>
               						<?php /*if ($allPrev == '1' || in_array('1', $disputemgmt)){?>
               						<!--<li><a href="admin/currency/add_currency_form" <?php if($currentPage=='add_currency_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Currency</a></li>-->
               						<?php }*/?>                 
               					</ul>
               				</li>
               				
               				 <li><a href="#" <?php if($currentUrl=='subscriber'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span>Subscriber Management<span class="up_down_arrow">&nbsp;</span></a>				
               					<ul class="acitem" <?php if($currentUrl=='subscriber'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
               						<li><a href="admin/subscriber/constantcontact" <?php if($currentPage=='constantcontact'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Constant contact</a></li>
               						
               						<li><a href="admin/subscriber/mailchimp" <?php if($currentPage=='mailchimp'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Mailchimp Settings</a></li>
               						<li><a href="admin/subscriber/zohocrm" <?php if($currentPage=='zohocrm'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Zohocrm Settings</a></li>
               						             
               					</ul>
               				</li>
               				
			<?php }
               
               
			     if((isset($community) && is_array($community)) && in_array('0', $community) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='community' || $currentUrl=='community_news'){ echo 'class="active"';} ?>><span class="nav_icon users_2"></span> Community<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='community' || $currentUrl=='community_news'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/community/display_events_dashboard" <?php if($currentPage=='display_events_dashboard' || $currentPage=='add_event_form' || $currentPage=='edit_event_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Events</a></li>
                    <li><a href="admin/community/display_teams_dashboard" <?php if($currentPage=='display_teams_dashboard' || $currentPage=='add_team_form' || $currentPage=='edit_team_form' ){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Teams</a></li>

                <li><a href="admin/community_news/display_blog" <?php if($currentPage=='display_blog'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Community News</a></li></ul>
				</li>
                 
				 <?php } if ((isset($communitybanner) && is_array($communitybanner)) && in_array('0', $communitybanner) || $allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentPage=='display_banner' || $currentPage=='add_banner'){ echo 'class="active"';} ?>><span class="nav_icon computer_imac"></span>Community Banner<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='banner'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
				 <li><a href="admin/banner/display_banner" <?php if($currentPage=='display_banner'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>View banner</a></li>
				 		 
					<?php if ($allPrev == '1' || in_array('1', $communitybanner)){?>
				 <li><a href="admin/banner/add_banner" <?php if($currentPage=='add_banner'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add banner</a></li>
					<?php } ?>
				</ul>
				</li>
				
				 <?php } /*if((isset($banner) && is_array($banner)) && in_array('0', $banner) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='landing_banner'){ echo 'class="active"';} ?>><span class="nav_icon users_2"></span> Site Banner<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='banner' || $currentUrl=='landing_banner'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					
					 <li><a href="admin/landing_banner/banner_settings_from" <?php if($currentPage=='banner_settings_from' || $currentPage=='landingadd_banner'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Banner settings</a></li>
					
                    <li><a href="admin/landing_banner/landingdisplay_banner" <?php if($currentPage=='landingdisplay_banner' || $currentPage=='landingadd_banner'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>View banner</a></li>
               <?php
			    $condition=array();
				$bannerList = $this->user_model->get_all_details(LANDING_BANNER,$condition)->row();
                if(empty($bannerList)){
 				?>
                    <li><a href="admin/landing_banner/landingadd_banner" <?php if($currentPage=='display_blog'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>ADD Banner</a></li>
				<?php }?>
				</ul>
				</li>
				
				
				<?php }*/  if ((isset($sliders) && is_array($sliders)) && in_array('0', $sliders) || $allPrev == '1'){ ?>
				<li>
					<a href="admin/sliders/display_sliderslist" <?php if($currentUrl=='sliders'){ echo 'class="active"';} ?>>
						<span class="nav_icon image"></span>Sliders
						<span class="up_down_arrow">&nbsp;</span>
					</a>
					<ul class="acitem" <?php if($currentUrl=='sliders'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
						<li>
							<a href="admin/sliders/display_sliderslist" <?php if(($currentPage=='display_sliderslist' || $currentPage=='edit_slider' || $currentPage=='view_slider') && $currentUrl=='sliders'){ echo 'class="active"';} ?>>
								<span class="list-icon">&nbsp;</span> All Sliders List
							</a>
						</li>
						<?php if ($allPrev == '1' || in_array('1', $sliders)){?>
						<li>
							<a href="admin/sliders/add_slider_form"" <?php if($currentPage=='add_slider' && $currentUrl=='sliders'){ echo 'class="active"';} ?>>
								<span class="list-icon">&nbsp;</span>Add New Slider
							</a>
						</li> 
						<?php } ?>
					</ul>
				</li> 
				
					<?php } if ((isset($ipmsg) && is_array($ipmsg)) && in_array('0', $ipmsg) || $allPrev == '1'){ ?>
				<li>
					<a href="admin/ipwhitelist/display_all_ipwhitelisters" <?php if($currentUrl=='ipwhitelist'){ echo 'class="active"';} ?>>
						<span class="nav_icon computer_imac"></span>IP White List
						<span class="up_down_arrow">&nbsp;</span>
					</a>
					<ul class="acitem" <?php if($currentUrl=='ipwhitelist'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
						<li>
							<a href="admin/ipwhitelist/display_all_ipwhitelisters" <?php if(($currentPage=='display_sliderslist' && $currentUrl=='ipwhitelist')){ echo 'class="active"';} ?>>
								<span class="list-icon">&nbsp;</span> All IP address White List
							</a>
						</li>
						<?php if ($allPrev == '1' || in_array('1', $ipmsg)){?>
						<li>
							<a href="admin/ipwhitelist/add_ipaddress_form"" <?php if($currentPage=='add_new_ipwhitelister'&& $currentUrl=='ipwhitelist' ){ echo 'class="active"';} ?>>
								<span class="list-icon">&nbsp;</span>Add New IP address
							</a>
						</li> 
						<?php } ?>
					</ul>
				</li> 
							
                
                 <?php } if ((isset($variations) && is_array($variations)) && in_array('0', $variations) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='productattribute'){ echo 'class="active"';} ?>><span class="nav_icon computer_imac"></span> Variations<span class="up_down_arrow">&nbsp;</span></a>
				  <ul class="acitem" <?php if($currentUrl=='productattribute'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/productattribute/display_product_attribute_list" <?php if($currentPage=='display_product_attribute_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Variations List</a></li>
					<?php if ($allPrev == '1' || in_array('1', $variations)){?>
                   <li><a href="admin/productattribute/add_product_attribute_form" <?php if($currentPage=='add_product_attribute_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Variation</a></li>
                  <!--   <li><a href="admin/category/display_banner_list" <?php if($currentPage=='display_banner_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Banner List</a></li>-->
					<?php }?>
				</ul>
				</li>
                
                
                
                
				<?php  } if ((isset($couponcards) && is_array($couponcards)) && in_array('0', $couponcards) || $allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='couponcards'){ echo 'class="active"';} ?>><span class="nav_icon record"></span> Coupon Codes<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='couponcards'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/couponcards/display_couponcards" <?php if($currentPage=='display_couponcards'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Coupon code List</a></li>
					<?php if ($allPrev == '1' || in_array('1', $couponcards)){?>
					<?php /*?><li><a href="admin/couponcards/add_couponcard_form" <?php if($currentPage=='add_couponcard_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Coupon code</a></li><?php */?>
					<?php }?>
				</ul>
				</li>
                
                
				<?php  } if ((isset($giftcards) && is_array($giftcards)) && in_array('0', $giftcards) || $allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='giftcards'){ echo 'class="active"';} ?>><span class="nav_icon image_1"></span> Gift Cards<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='giftcards'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/giftcards/display_giftcards_dashboard" <?php if($currentPage=='display_giftcards_dashboard'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>
					<?php if ($allPrev == '1' || in_array('1', $giftcards)){?>
					<li><a href="admin/giftcards/edit_giftcards_settings" <?php if($currentPage=='edit_giftcards_settings'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Settings</a></li>
					<li><a href="admin/giftcards/display_giftcards" <?php if($currentPage=='display_giftcards'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Gift Cards List</a></li>
					<?php }?>
				</ul>
				</li>
                <?php } if ((isset($newsletter) && is_array($newsletter)) && in_array('0', $newsletter) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='newsletter'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span> Newsletter Template<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='newsletter'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/newsletter/display_subscribers_list" <?php if($currentPage=='display_subscribers_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Subscription List</a></li>					
					<li><a href="admin/newsletter/display_newsletter" <?php if($currentPage=='display_newsletter'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Email Template List</a></li>
                    <li><a href="admin/newsletter/add_newsletter" <?php if($currentPage=='add_newsletter'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Email Template</a></li>					
				</ul>
				</li>
				
                <?php } /* if ((isset($newsletter) && is_array($newsletter)) && in_array('0', $newsletter) || $allPrev == '1'){ */  ?>
				<!--<li><a href="#" <?php if($currentUrl=='newsletter'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span> Newsletter Template<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='newsletter'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/newsletter/display_subscribers_list" <?php if($currentPage=='display_subscribers_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Subscription List</a></li>
					<?php if ($allPrev == '1' || in_array('1', $newsletter)){?>
					<li><a href="admin/newsletter/display_newsletter" <?php if($currentPage=='display_newsletter'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Email Template List</a></li>
                    <li><a href="admin/newsletter/add_newsletter" <?php if($currentPage=='add_newsletter'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Email Template</a></li>
					<?php }?>
				</ul>
				</li>-->

				<?php /*} if ((isset($location) && is_array($location)) && in_array('0', $location) || $allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='location'){ echo 'class="active"';} ?>><span class="nav_icon globe"></span> Location & Tax<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='location'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/location/display_location_list" <?php if($currentPage=='display_location_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Location List</a></li>
                    <?php if ($allPrev == '1' || in_array('1', $location)){?>
                    <li><a href="admin/location/add_location_form" <?php if($currentPage=='add_location_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Country</a></li>
                    <?php }?>
					
                     <?php  ?>
                     <li><a href="admin/location/display_country_list" <?php if($currentPage=='display_country_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Country List</a></li>
					<?php  ?>
					<li><a href="admin/location/add_tax_form" <?php if($currentPage=='add_tax_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add State</a></li>
				</ul>
				</li>  
                <?php }*/ if ((isset($currency) && is_array($currency)) && in_array('0', $currency) || $allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='currency'){ echo 'class="active"';} ?>><span class="nav_icon globe"></span> Currency<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='currency'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/currency/display_currency_list" <?php if($currentPage=='display_currency_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Currency List</a></li>
                    <?php if ($allPrev == '1' || in_array('1', $currency)){?>
                    <li><a href="admin/currency/add_currency_form" <?php if($currentPage=='add_currency_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Currency</a></li>
                    <?php }?>
                 
				</ul>
				</li>  
                <li><a href="#" <?php if($currentUrl=='layout'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span>Layout<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='layout'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<!--<li><a href="admin/newsletter/display_subscribers_list" <?php if($currentPage=='display_subscribers_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Subscription List</a></li>-->					
					
                    <li><a href="admin/layout/display_theme_list" <?php if($currentPage=='display_theme_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Theme List</a></li>
                 <!--<li><a href="admin/layout/display_theme_layout" <?php if($currentPage=='display_theme_layout'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Theme Layout</a></li>-->				
				</ul>
				</li>
                
                <?php } if ((isset($complaints) && is_array($complaints)) && in_array('0', $complaints) || $allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='spam'){ echo 'class="active"';} ?>><span class="nav_icon dropbox"></span>Complaints<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='spam'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/spam/spam_product_List" <?php if($currentPage=='spam_product_List' || $currentPage=='view_product_spam' || $currentPage=='view_product_spam_reply'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Product Complaints List</a></li>
                   <li><a href="admin/spam/spam_shop_List" <?php if($currentPage=='spam_shop_List' || $currentPage=='view_shop_spam' || $currentPage=='view_shop_spam_reply'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Shop Complaints List</a></li>
                   
				</ul>
				</li>
                
                
                
				<?php } if ((isset($cms) && is_array($cms)) && in_array('0', $cms) || $allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='cms'){ echo 'class="active"';} ?>><span class="nav_icon documents"></span> Pages<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='cms'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
				 <li><a href="admin/cms/display_cms" <?php if($currentPage=='display_cms'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>List of pages</a></li>
					<?php if ($allPrev == '1' || in_array('1', $cms)){?>
				 <li><a href="admin/cms/add_cms_form" <?php if($currentPage=='add_cms_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Main Page</a></li>
				<li><a href="admin/cms/add_subpage_form" <?php if($currentPage=='add_subpage_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Sub Page</a></li>
					<?php }?>
				</ul>
				</li>
       
				<?php }if ((isset($paygateway) && is_array($paygateway)) && in_array('0', $paygateway) || $allPrev == '1'){ ?>
				<li><a href="admin/paygateway/display_gateway" <?php if($currentUrl=='paygateway'){ echo 'class="active"';} ?>><span class="nav_icon shopping_cart_2"></span> Payment Gateway</a></li>
                		
				 <?php }if ((isset($contactshopowner) && is_array($contactshopowner)) && in_array('0', $contactshopowner) || $allPrev == '1'){ ?>
				 <li><a href="#" <?php if($currentUrl=='contactseller'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span>Contacts<span class="up_down_arrow">&nbsp;</span></a>
				
                <ul class="acitem" <?php if($currentUrl=='contactseller'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
				 
				<li><a href="admin/contactseller/display_contact_seller" <?php if($currentPage=='display_contact_seller'  ||  $currentPage=='view_contactseller_form'){ echo 'class="active"';} ?>><span class="list-icon"></span>Contact Shop Owner</a></li>
				<li><a href="admin/contactseller/display_askquestion_seller" <?php if($currentPage=='display_askquestion_seller' ||  $currentPage=='view_askquestion_form'){ echo 'class="active"';} ?>><span class="list-icon"></span> Ask Question</a></li>
				</ul>
				</li>
				<?php /*?><li><a href="admin/contactuser/display_contact_user" <?php if($currentUrl=='contactuser'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span> Contact Seller Mgmt</a></li><?php */?>		
              
                <?php }if ((isset($feedback) && is_array($feedback)) && in_array('0', $feedback) || $allPrev == '1'){ ?>
                <li><a href="#" <?php if($currentUrl=='admin_feedback'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span>Reviews<span class="up_down_arrow">&nbsp;</span></a>
				
                <ul class="acitem" <?php if($currentUrl=='admin_feedback'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<?php ?><!--<li><a href="admin/newsletter/display_subscribers_list" <?php if($currentPage=='display_subscribers_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Subscription List</a></li>--><?php ?>
					<?php if ($allPrev == '1' || in_array('1', $feedback)){?>
					<li><a href="admin/admin_feedback/display_product_feedback" <?php if($currentPage=='display_product_feedback' || $currentPage=='view_product_feedback'){ echo 'class="active"';} ?>><span class="list-icon"></span> Product Feedback</a></li>
                    <li><a href="admin/admin_feedback/display_feedback_report" <?php if($currentPage=='display_feedback_report' || $currentPage=='view_feedback_report'){ echo 'class="active"';} ?>><span class="list-icon"></span>Shop Feedback Report</a></li>
                   <!--<li><a href="admin/admin_feedback/display_shop_feedback" <?php if($currentUrl=='admin_feedback'){ echo 'class="active"';} ?>><span class="nav_icon shopping_cart_2"></span> Shop Feedback</a></li>-->
					<?php }?>
				</ul>
				</li>
                                
				<?php }if ((isset($multilang) && is_array($multilang)) && in_array('0', $multilang) || $allPrev == '1'){ ?>
				 
                <li><a href="admin/multilanguage" <?php if($currentUrl=='multilanguage'){ echo 'class="active"';} ?>><span class="nav_icon cog_3"></span> Language Management</a></li>
				<?php }?>
                
                             
              <?php  /*  if ((isset($userexcelexport) && is_array($userexcelexport)) && in_array('0', $userexcelexport) || $allPrev == '1'){ ?>
                <li><a href="#" <?php if($currentUrl=='admin_export'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span>Export Management<span class="up_down_arrow">&nbsp;</span></a>
				
                <ul class="acitem" <?php if($currentUrl=='admin_export'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					
					<?php if ($allPrev == '1'){?>
					<li><a href="admin/admin_export/user_export" <?php if($currentPage=='user_export'){ echo 'class="active"';} ?>><span class="list-icon"></span> User Export</a></li>
                    
                  
					<?php }?>
				</ul>
				</li>
                                
				<?php } */ ?>
				
			</ul>
		</div>
	</div>
</div>


