<?php 

$this->load->view('site/templates/header');

$this->load->model('product_model');

$this->load->model('user_model');

//echo "<pre>";print_r($userProfileDetails);

?>



<section class="container">

    	<div class="main">

        	

            <div class="community_page">

            	

                <div class="community_div">

                	<div class="community_left">

                    	<?php $this->load->view('site/user/sidebar');?>              

                               

                    </div>

                    <div class="community_right" style="margin-left:15px; float:right; width:78%;">

                    

                        <?php $this->load->view("site/user/settings_tab");?>

                        

                    <h2 class="hed_title_3"><?php if($this->lang->line('user_email_submit_for') != '') { echo stripslashes($this->lang->line('user_email_submit_for')); } else echo "Email settings for"; ?> <?php echo $this->session->userdata['shopsy_session_user_email'];?> </h2>

                    <div class="pass">

                  

                  <div class="heading_account" ><?php if($this->lang->line('user_general_notify') != '') { echo stripslashes($this->lang->line('user_general_notify')); } else echo "General Notifications"; ?></div>

                  <span class="p_text_use"><?php if($this->lang->line('user_email_me_when') != '') { echo stripslashes($this->lang->line('user_email_me_when')); } else echo "Email me when"; ?>...</span>

                  <div class="clear"></div>

                  <div class="bor_use1"></div>

                   <div class="field_account mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_sends_convo') != '') { echo stripslashes($this->lang->line('user_sends_convo')); } else echo "Someone sends me a convo"; ?></label>

                  </div>

                  <div class="field_account mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_i_send_convo') != '') { echo stripslashes($this->lang->line('user_i_send_convo')); } else echo "I send a convo"; ?></label>

                  </div>

                   <div class="field_account mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_somone_foll_me') != '') { echo stripslashes($this->lang->line('user_somone_foll_me')); } else echo "Someone follows me"; ?></label>

                  </div>

                   <div class="field_account mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_my_list_expire') != '') { echo stripslashes($this->lang->line('user_my_list_expire')); } else echo "My listings are about to expire"; ?></label>

                  </div>

                    <span class="p_text_use"><?php if($this->lang->line('user_know_about') != '') { echo stripslashes($this->lang->line('user_know_about')); } else echo "I want to know about..."; ?></span>

                  <div class="clear"></div>

                  <div class="bor_use1"></div>

                   <div class="field_account mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_seller_activity') != '') { echo stripslashes($this->lang->line('user_seller_activity')); } else echo "My seller activity"; ?></label>

                     <div class="clear"></div>

                     <span style="width:100%;"><?php if($this->lang->line('user_receive_act_seller') != '') { echo stripslashes($this->lang->line('user_receive_act_seller')); } else echo "Receive updates related to your shop and activity as a seller."; ?></span>

                     

                  </div>

                   <div class="field_account mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_whats_new_at') != '') { echo stripslashes($this->lang->line('user_whats_new_at')); } else echo "What's new at"; ?> <?php echo stripslashes($siteTitle); ?></label>

                     <div class="clear"></div>

                     <span style="width:100%;"><?php if($this->lang->line('user_receive_act_seller') != '') { echo stripslashes($this->lang->line('user_receive_act_seller')); } else echo "Receive updates related to your shop and activity as a seller."; ?></span>

                     

                  </div>

                   <div class="field_account mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_recom_features') != '') { echo stripslashes($this->lang->line('user_recom_features')); } else echo "Recommended features"; ?></label>

                     <div class="clear"></div>

                     <span style="width:100%;"><?php if($this->lang->line('user_learn_all_improve') != '') { echo stripslashes($this->lang->line('user_learn_all_improve')); } else echo "Learn all about the new improvements and features we are constantly making to make "; ?> <?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_better_markerplace') != '') { echo stripslashes($this->lang->line('user_better_markerplace')); } else echo "a better and stronger marketplace."; ?></span>

                  </div>

                  <div class="field_account mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_improve_myshop') != '') { echo stripslashes($this->lang->line('user_improve_myshop')); } else echo "Tips for improving my shop"; ?></label>

                     <div class="clear"></div>

                     <span style="width:100%;"><?php if($this->lang->line('user_seller_focused') != '') { echo stripslashes($this->lang->line('user_seller_focused')); } else echo "Seller-focused tips and guidance on how to improve your shop."; ?></span>

                  </div>

                   <div class="field_account mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_opport_feedback') != '') { echo stripslashes($this->lang->line('user_opport_feedback')); } else echo "Opportunities to provide feedback to "; ?> <?php echo stripslashes($siteTitle); ?></label>

                     <div class="clear"></div>

                     <span style="width:100%;"><?php if($this->lang->line('user_participate_itms') != '') { echo stripslashes($this->lang->line('user_participate_itms')); } else echo "Participate in item/transaction reviews, surveys, focus groups, usability sessions, and research conducted to help improve your experience on "; ?> <?php echo stripslashes($siteTitle); ?>.</span>

                  </div>

                  <div class="field_account mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_coupons_promo_recom') != '') { echo stripslashes($this->lang->line('user_coupons_promo_recom')); } else echo "Coupons, promotions, and recommendations"; ?></label>

                     <div class="clear"></div>

                     <span style="width:100%;"><?php if($this->lang->line('user_receive_cop_promo_recom') != '') { echo stripslashes($this->lang->line('user_receive_cop_promo_recom')); } else echo "Receive coupons, promotions, and recommendations from "; ?> <?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_shops_u_love') != '') { echo stripslashes($this->lang->line('user_shops_u_love')); } else echo "shops you love."; ?></span>

                  </div>

                </div>

                

                	<div class="pass">

               

                <div class="heading_account" ><?php if($this->lang->line('user_ur_subscribe') != '') { echo stripslashes($this->lang->line('user_ur_subscribe')); } else echo "Your Subscriptions"; ?></div>

                <div class="diss_content" style="background:none;">

                 <p class="p_text_use"><?php if($this->lang->line('user_check_subsc') != '') { echo stripslashes($this->lang->line('user_check_subsc')); } else echo "Check the subscriptions you would like to receive:"; ?></p>

                       

                        <ul class="discussion_use" style="background:none;">

                        <li style="border-bottom:#E6E6E3 solid 1px; width:97%;">

                        <span class="title_view_2"><?php if($this->lang->line('user_shopping') != '') { echo stripslashes($this->lang->line('user_shopping')); } else echo "SHOPPING"; ?> </span>

                        <span class="post_view_2"> <?php if($this->lang->line('user_freqquency') != '') { echo stripslashes($this->lang->line('user_freqquency')); } else echo "FREQUENCY"; ?> </span>

                        </li>

                       

                       <li style="border:none; width:97%;">

                         <div class="view_flow1 mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label><?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_finds') != '') { echo stripslashes($this->lang->line('user_finds')); } else echo "Finds"; ?></label>

                     <span class="text_sort"> 	<?php if($this->lang->line('user_ur_daily') != '') { echo stripslashes($this->lang->line('user_ur_daily')); } else echo "Your daily"; ?> <?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_ur_subscribe') != '') { echo stripslashes($this->lang->line('user_shop_guide')); } else echo "shopping guide"; ?></span>

                      <span class="text_sort_we2"> 	<?php if($this->lang->line('user_daily') != '') { echo stripslashes($this->lang->line('user_daily')); } else echo "Daily"; ?></span>

                      </div>

                       </li>

                       

                         <li style="border:none; width:97%;">

                         <div class="view_flow1 mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label><?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_gifts') != '') { echo stripslashes($this->lang->line('user_gifts')); } else echo "Gifts"; ?></label>

                     <span class="text_sort"><?php if($this->lang->line('user_gift_ideas') != '') { echo stripslashes($this->lang->line('user_gift_ideas')); } else echo "Gift ideas for everyone on your list."; ?></span>

                      <span class="text_sort_we2"> 	<?php if($this->lang->line('user_seasonalay') != '') { echo stripslashes($this->lang->line('user_seasonalay')); } else echo "Seasonally"; ?></span>

                       </div>

                       </li>

                       

                         <li style="border:none; width:97%;">

                         <div class="view_flow1 mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label><?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_fashion') != '') { echo stripslashes($this->lang->line('user_fashion')); } else echo "Fashion"; ?></label>

                     <span class="text_sort"><?php if($this->lang->line('user_hottest_trends') != '') { echo stripslashes($this->lang->line('user_hottest_trends')); } else echo "The hottest style trends on"; ?> <?php echo stripslashes($siteTitle); ?>.</span>

                      <span class="text_sort_we2"> 	<?php if($this->lang->line('user_twice_week') != '') { echo stripslashes($this->lang->line('user_twice_week')); } else echo "Twice a week"; ?></span>

                       </div>

                       </li>

                       

                        <li style="border:none !important; width:97%;">

                         <div class="view_flow1 mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label><?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_weddings') != '') { echo stripslashes($this->lang->line('user_weddings')); } else echo "Weddings"; ?></label>

                     <span class="text_sort"> 	<?php if($this->lang->line('user_handmade_vintage_picks') != '') { echo stripslashes($this->lang->line('user_handmade_vintage_picks')); } else echo "Handmade and vintage picks for brides, grooms and everyone else who loves weddings."; ?></span>

                      <span class="text_sort_we2"> 	<?php if($this->lang->line('user_weekly') != '') { echo stripslashes($this->lang->line('user_weekly')); } else echo "Weekly"; ?></span>

                       </div>

                       </li>

                       

                        <li  style="border-bottom:#E6E6E3 solid 1px; width:97%;">

                        <span class="title_view_2"><?php if($this->lang->line('user_shopping') != '') { echo stripslashes($this->lang->line('user_shopping')); } else echo "SHOPPING"; ?> </span>

                        <span class="post_view_2"> <?php if($this->lang->line('user_freqquency') != '') { echo stripslashes($this->lang->line('user_freqquency')); } else echo "FREQUENCY"; ?> </span>

                        </li>

                       

                        <li style="border:none; width:97%;">

                         <div class="view_flow1 mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label><?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_finds') != '') { echo stripslashes($this->lang->line('user_finds')); } else echo "Finds"; ?></label>

                     <span class="text_sort"> 	<?php if($this->lang->line('user_ur_daily') != '') { echo stripslashes($this->lang->line('user_ur_daily')); } else echo "Your daily"; ?> <?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_shop_guide') != '') { echo stripslashes($this->lang->line('user_shop_guide')); } else echo "shopping guide."; ?></span>

                      <span class="text_sort_we2"> 	<?php if($this->lang->line('user_daily') != '') { echo stripslashes($this->lang->line('user_daily')); } else echo "Daily"; ?></span>

                       </div>

                       </li>

                        <li style="border:none; width:97%;">

                         <div class="view_flow1 mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label><?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_finds') != '') { echo stripslashes($this->lang->line('user_finds')); } else echo "Finds"; ?></label>

                     <span class="text_sort"> <?php if($this->lang->line('user_ur_daily') != '') { echo stripslashes($this->lang->line('user_ur_daily')); } else echo "Your daily"; ?>	 <?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_shop_guide') != '') { echo stripslashes($this->lang->line('user_shop_guide')); } else echo "shopping guide."; ?></span>

                      <span class="text_sort_we2"> 	<?php if($this->lang->line('user_daily') != '') { echo stripslashes($this->lang->line('user_daily')); } else echo "Daily"; ?></span>

                       </div>

                       </li>

                        <li style="border:none; width:97%;">

                         <div class="view_flow1 mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label><?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_finds') != '') { echo stripslashes($this->lang->line('user_finds')); } else echo "Finds"; ?></label>

                     <span class="text_sort"> 	<?php if($this->lang->line('user_ur_daily') != '') { echo stripslashes($this->lang->line('user_ur_daily')); } else echo "Your daily"; ?> <?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_shop_guide') != '') { echo stripslashes($this->lang->line('user_shop_guide')); } else echo "shopping guide."; ?></span>

                      <span class="text_sort_we2"> 	<?php if($this->lang->line('user_daily') != '') { echo stripslashes($this->lang->line('user_daily')); } else echo "Daily"; ?></span>

                       </div>

                       </li>

                        <li style="border:none; width:97%;">

                         <div class="view_flow1 mar_top_use">

        	        <input name="" type="checkbox" value=""  style="float:left;"/>

                     <label><?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_finds') != '') { echo stripslashes($this->lang->line('user_finds')); } else echo "Finds"; ?></label>

                     <span class="text_sort"> 	<?php if($this->lang->line('user_ur_daily') != '') { echo stripslashes($this->lang->line('user_ur_daily')); } else echo "Your daily"; ?> <?php echo stripslashes($siteTitle); ?> <?php if($this->lang->line('user_shop_guide') != '') { echo stripslashes($this->lang->line('user_shop_guide')); } else echo "shopping guide."; ?></span>

                      <span class="text_sort_we2"> 	<?php if($this->lang->line('user_daily') != '') { echo stripslashes($this->lang->line('user_daily')); } else echo "Daily"; ?></span>

                       </div>

                       </li>

                    </ul>

                      </div>  

                      

                     

                      

                        </div>

                        

                    <input type="submit" class="password_btn" value="<?php if($this->lang->line('user_save_settings') != '') { echo stripslashes($this->lang->line('user_save_settings')); } else echo 'Save Settings'; ?>" style=" margin-left:10px; margin-bottom:12px; margin-top:0px; " />   

            

                   </div>

                </div>

            </div>

        </div>

    </section>

    

     <?php 

     $this->load->view('site/templates/footer');

?>