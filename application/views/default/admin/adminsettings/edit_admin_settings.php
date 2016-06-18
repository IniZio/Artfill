<?php
$this->load->view('admin/templates/header.php');
?>

<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_wrap tabby">
          <div class="widget_top"> <span class="h_icon list"></span>
            <h6>Global Site Configuration</h6>
            <div id="widget_tab">
              <ul>
                <li><a href="#tab1" class="active_tab">Admin Settings</a></li>
                <li><a href="#tab2">Social Media Settings</a></li>
                <li><a href="#tab3">Google Webmaster & SEO</a></li>
                <li><a href="#tab4">Site Settings</a></li>
				<li><a href="#tab5">Footer Widget</a></li>
				<li><a href="#tab6">API</a></li>
              </ul>
            </div>
          </div>
          <div class="widget_content">
            <?php 
				$attributes = array('class' => 'form_container left_label ajaxsubmit', 'id' => 'settings_form', 'enctype' => 'multipart/form-data');
				echo form_open_multipart('admin/adminlogin/admin_global_settings',$attributes) 
			?>
			<input type="hidden" name="form_mode" value="main_settings"/>
            <div id="tab1">
              <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="admin_name">Admin Name <span class="req">*</span></label>
                    <div class="form_input">
                      <input name="admin_name" value="<?php echo $admin_settings->row()->admin_name;?>" id="admin_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the admin username"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="email">Email Address <span class="req">*</span></label>
                    <div class="form_input">
                      <input name="email" id="email" type="text" value="<?php echo $admin_settings->row()->email;?>" tabindex="2" class="required large tipTop" title="Please enter the admin email address"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="site_contact_mail">Site Contact Email</label>
                    <div class="form_input">
                      <input name="site_contact_mail" id="site_contact_mail" value="<?php echo $admin_settings->row()->site_contact_mail;?>" type="text" tabindex="3" class="large tipTop" title="Please enter the site contact email"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="email_title">Site Name</label>
                    <div class="form_input">
                      <input name="email_title" id="email_title" type="text" value="<?php echo $admin_settings->row()->email_title;?>" tabindex="4" class="large tipTop" title="Please enter the email title"/>
                    </div>
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="email_title">Selling payment per product <span class="req">*</span></label>
                    <div class="form_input"><?php echo $dcurrencySymbol; ?>
                      <input name="product_cost" id="product_cost" type="text" value="<?php echo $admin_settings->row()->product_cost;?>" tabindex="4" class="required large tipTop" title="Please enter the product cost"/> <span> <b><?php echo $dcurrencyType; ?></b></span>
                     </div>
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="email_title">transaction commission %<span class="req">*</span></label>
                    <div class="form_input">
                      <input name="product_commission" id="product_commission" type="text" value="<?php echo $admin_settings->row()->product_commission; ?>" tabindex="4" class="required large tipTop" title="Please enter the product commission"/><span> <b>%</b></span>
                     </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="email_title">buyer commission %<span class="req">*</span></label>
                    <div class="form_input">
                      <input name="buyer_commission" id="buyer_commission" type="text" value="<?php echo $admin_settings->row()->buyer_commission; ?>" tabindex="4" class="required large tipTop" title="Please enter the buyer commission"/><span> <b>%</b></span>
                     </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="logo_image">Logo</label>
                    <div class="form_input">
                      <input name="logo_image" id="logo_image" type="file" tabindex="5" class="large tipTop" title="Please Choose the logo image"/>
                    </div>
                    <div class="form_input"><img src="<?php echo base_url();?>images/logo/<?php echo $admin_settings->row()->logo_image;?>" width="100px"/></div>
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="logo_image">Landing Page Logo</label>
                    <div class="form_input">
                      <input name="landing_logo_image" id="landing_logo_image" type="file" tabindex="5" class="large tipTop" title="Please Choose the Landing logo image"/>
                    </div>
                    <div class="form_input"><img src="<?php echo base_url();?>images/logo/<?php echo $admin_settings->row()->like_text;?>" width="100px"/></div>
                  </div>
                </li>
                
                
               
                
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="fevicon_image">Favicon</label>
                    <div class="form_input">
                      <input name="fevicon_image" id="fevicon_image" type="file" tabindex="6" class="large tipTop" title="Please Choose the fevicon image"/>
                    </div>
                    <div class="form_input"><img src="<?php echo base_url();?>images/logo/<?php echo $admin_settings->row()->fevicon_image;?>" width="50px"/></div>
                  </div>
                </li>
              <?php   /*  <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="email_title">banner description<span class="req">*</span></label>
                    <div class="form_input">
                      <input name="banner_description" id="banner_description" type="text" value="<?php echo $admin_settings->row()->banner_description;?>" tabindex="4" class="required large tipTop" title="Please enter the product banner description"/>
                     </div>
                  </div>
                </li> */ ?>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="footer_content">Footer Content</label>
                    <div class="form_input">
                      <input name="footer_content" id="footer_content" type="text" value="<?php echo htmlentities($admin_settings->row()->footer_content);?>" tabindex="7" class="large tipTop" title="Please enter the footer copyright content"/>
                    </div>
                  </div>
                </li>
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="app_store_link">APP STORE LINK</label>
                    <div class="form_input">
                      <input name="app_store_link" id="app_store_link" type="text" value="<?php echo htmlentities($admin_settings->row()->app_store_link);?>" tabindex="7" class="large tipTop" title="Please enter the footer copyright content"/>
                    </div>
                  </div>
                </li>
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="play_store_link">GOOGLE PLAY LINK</label>
                    <div class="form_input">
                      <input name="play_store_link" id="play_store_link" type="text" value="<?php echo htmlentities($admin_settings->row()->play_store_link);?>" tabindex="7" class="large tipTop" title="Please enter the footer copyright content"/>
                    </div>
                  </div>
                </li>
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="footer_content">Mega Menu Enable</label>
                    <div class="form_input">
                      <input name="mega_menu" id="mega_menu" type="radio" value="Yes" title="Mega Menu Available " <?php if($admin_settings->row()->mega_menu=='Yes'){ echo 'checked="checked"';}?> /> Yes
					<input name="mega_menu" id="mega_menu" type="radio" value="No" title="Mega Menu Not Available " <?php if($admin_settings->row()->mega_menu=='No'){ echo 'checked="checked"';}?>/> No
					</div>
                  </div>
                </li>
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="footer_content">Landing Page Featured Products</label>
                    <div class="form_input">
                      <input name="featured_prod" id="featured_prod" type="radio" value="active" title="featured products Available" <?php if($admin_settings->row()->featured_prod=='active'){ echo 'checked="checked"';}?> /> Active
					<input name="featured_prod" id="featured_prod" type="radio" value="inactive" title="featured products Unavailable " <?php if($admin_settings->row()->featured_prod=='inactive'){ echo 'checked="checked"';}?>/> Inactive
					</div>
                  </div>
                </li>
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="footer_content">Landing Page Testimonial Banner</label>
                    <div class="form_input">
                      <input name="testimonial" id="testimonial" type="radio" value="active" title="Testimonial Banner Available" <?php if($admin_settings->row()->testimonial=='active'){ echo 'checked="checked"';}?> /> Active
					<input name="testimonial" id="testimonial" type="radio" value="inactive" title="Testimonial Banner Unavailable " <?php if($admin_settings->row()->testimonial=='inactive'){ echo 'checked="checked"';}?>/> Inactive
					</div>
                  </div>
                </li>
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="footer_content">Landing Page Featured Shop</label>
                    <div class="form_input">
                      <input name="featured_shop" id="featured_shop" type="radio" value="active" title="Featured Shop Available" <?php if($admin_settings->row()->featured_shop=='active'){ echo 'checked="checked"';}?> /> Active
					<input name="featured_shop" id="featured_shop" type="radio" value="inactive" title="Featured Shop Unavailable " <?php if($admin_settings->row()->featured_shop=='inactive'){ echo 'checked="checked"';}?>/> Inactive
					</div>
                  </div>
                </li>
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="footer_content">Landing Page Top Seller</label>
                    <div class="form_input">
                      <input name="top_seller" id="top_seller" type="radio" value="active" title="Top Seller Available" <?php if($admin_settings->row()->top_seller=='active'){ echo 'checked="checked"';}?> /> Active
					<input name="top_seller" id="top_seller" type="radio" value="inactive" title="Top Seller Unavailable " <?php if($admin_settings->row()->top_seller=='inactive'){ echo 'checked="checked"';}?>/> Inactive
					</div>
                  </div>
                </li>
				
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="footer_content">Landing Page Recent products</label>
                    <div class="form_input">
                      <input name="recent_prod" id="recent_prod" type="radio" value="active" title="Recent products Available" <?php if($admin_settings->row()->recent_prod=='active'){ echo 'checked="checked"';}?> /> Active
					<input name="recent_prod" id="recent_prod" type="radio" value="inactive" title="Recent products Unavailable " <?php if($admin_settings->row()->recent_prod=='inactive'){ echo 'checked="checked"';}?>/> Inactive
					</div>
                  </div>
                </li>
				
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="footer_content">Cod Available</label>
                    <div class="form_input">
                      <input name="cod_payment" id="cod_payment1" type="radio" value="Yes" title="Cod Available " <?php if($admin_settings->row()->cod_payment=='Yes'){ echo 'checked="checked"';}?> /> Yes
					<input name="cod_payment" id="cod_payment2" type="radio" value="No" title="Cod Not Available " <?php if($admin_settings->row()->cod_payment=='No'){ echo 'checked="checked"';}?>/> No
					</div>
                  </div>
                </li>
				  <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="footer_content">Deal of the Day</label>
                    <div class="form_input">
                      <input name="deal_of_day" id="deal_day1" type="radio" value="Yes" title="Cod Available " <?php if($admin_settings->row()->deal_of_day=='Yes'){ echo 'checked="checked"';}?> /> Yes
					<input name="deal_of_day" id="deal_day2" type="radio" value="No" title="Cod Not Available " <?php if($admin_settings->row()->deal_of_day=='No'){ echo 'checked="checked"';}?>/> No
					</div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="unlike_text">Site Image</label>
                    <div class="form_input">
                    	<input name="site_image" id="site_image" type="file" tabindex="8" class="large tipTop" title="Please Choose the Site image"/>
                      <span id="showImgErr" style="display:none;color:#FF0000;"></span>
                    </div>
                    
                    <div class="form_input"><img id="loadedImg" src="<?php echo base_url();?>images/logo/<?php echo $admin_settings->row()->unlike_text;?>" width="100px"/></div>
                  </div>
                </li>
              </ul>
            <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
				</div>
			</div></li></ul>
			</div>
            </form>
             <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'settings_form');
				echo form_open('admin/adminlogin/admin_global_settings',$attributes) 
			?>
			<input type="hidden" name="form_mode" value="social"/>
            <div id="tab2">
            
              <ul>
              <?php /*?><div class="form_grid_12">
              <label class="error">Note: To create google api refer this   <a href="http://www.saaraan.com/2012/10/creating-google-oauth-api-key" target="_blank">Reference Link</a>  </label>
              </div><?php */?>
              <div class="form_grid_12">              
              <label class="error">Note: To create Facebook api click below url, click Apps then Create New App <a href="https://developers.facebook.com/" target="_blank">Facebook Link</a>  </label>
              </div>
              <?php /*?> <div class="form_grid_12">              
              <label  class="error">Note: To create Twitter api refer this <a href="https://dev.twitter.com/discussions/631" target="_blank">Reference Link</a>  </label>
              </div><?php */?>
              <div class="form_grid_12">
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="facebook_link">Facebook Link</label>
                    <div class="form_input">
                      <input name="facebook_link" id="facebook_link" type="text" value="<?php echo $admin_settings->row()->facebook_link;?>" tabindex="10" class="large tipTop" title="Please enter the site facebook url"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="twitter_link">Twitter Link</label>
                    <div class="form_input">
                      <input name="twitter_link" id="twitter_link" type="text" tabindex="11" value="<?php echo $admin_settings->row()->twitter_link;?>" class="large tipTop" title="Please enter the site twitter url"/>
                    </div>
                  </div>
                </li>
				
				  <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="pinterest_link">Pinterest Link</label>
                    <div class="form_input">
                      <input name="pinterest" id="pinterest" type="text" tabindex="11" value="<?php echo $admin_settings->row()->pinterest;?>" class="large tipTop" title="Please enter the site pinterest url"/>
                    </div>
                  </div>
                </li>
                 <?php /*  <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_invite_client_id">Google Invite Client id </label>
                    <div class="form_input">
                      <input name="google_invite_client_id" id="google_invite_client_id" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_invite_client_id;?>" class="large tipTop" title="Please enter the google invite client id"/>
                    </div>
                  </div>
                </li>
				
				  <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_invite_client_secret_id">Google Invite Client secret id</label>
                    <div class="form_input">
                      <input name="google_invite_client_secret_id" id="google_invite_client_secret_id" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_invite_client_secret_id;?>" class="large tipTop" title="Please enter google invite client secret id"/>
                    </div>
                  </div>
                </li>
				
				
				  <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_invite_developer_key">Google Invite Developer Key</label>
                    <div class="form_input">
                      <input name="google_invite_developer_key" id="google_invite_developer_key" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_invite_developer_key;?>" class="large tipTop" title="Please enter the google  invite developer key"/>
                    </div>
                  </div>
                </li>
				
				
				  <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_invite_developer_key">Google Invite Redirect Url</label>
                    <div class="form_input">
                      <input name="google_invite_redirect_url" id="google_invite_redirect_url" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_invite_redirect_url;?>" class="large tipTop" title="Please enter the google  invite rediect url"/>
                    </div>
                  </div>
                </li>
				
				  <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_invite_application_name">Google Invite Application Name </label>
                    <div class="form_input">
                      <input name="google_invite_application_name" id="google_invite_application_name" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_invite_application_name;?>" class="large tipTop" title="Please enter the google application name"/>
                    </div>
                  </div>
                </li>
		       
                <?php /*?><li>
                  <div class="form_grid_12">
                    <label class="field_title" for="facebook_link">Flickr Link</label>
                    <div class="form_input">
                      <input name="linkedin_link" id="linkedin_link" type="text" value="<?php echo $admin_settings->row()->linkedin_link;?>" tabindex="10" class="large tipTop" title="Please enter the site facebook url"/>
                    </div>
                  </div>
                </li>            
                
                 <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_client_id">Google Client Id</label>
                    <div class="form_input">
                      <input name="google_client_id" id="google_client_id" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_client_id;?>" class="large tipTop" title="Please enter the google client id"/>
                    </div>
                  </div>
                </li>
                
                 <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_redirect_url">Google Redirect Url</label>
                    <div class="form_input">
                      <input name="google_redirect_url" id="google_redirect_url" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_redirect_url;?>" class="large tipTop" title="Please enter the google redirect url"/>
                      <label class="error">Note: For Google Redirect Url Copy This Url and Paste It. - <?php echo base_url();?>googlelogin/googleRedirect </label>
                    </div>
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_client_secret">Google Secret Key</label>
                    <div class="form_input">
                      <input name="google_client_secret" id="google_client_secret" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_client_secret;?>" class="large tipTop" title="Please enter the google secret key"/>
                    </div>
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_developer_key">Google Developer Key</label>
                    <div class="form_input">
                      <input name="google_developer_key" id="google_developer_key" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_developer_key;?>" class="large tipTop" title="Please enter the google developer key"/>
                    </div>
                  </div>
                </li><?php */?>
                
                
                
                 <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="facebook_app_id">Facebook App ID</label>
                    <div class="form_input">
                      <input name="facebook_app_id" id="facebook_app_id" type="text" tabindex="11" value="<?php echo $admin_settings->row()->facebook_app_id;?>" class="large tipTop" title="Please enter the facebook app id"/>
                    </div>
                  </div>
                </li>
                
               <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="facebook_app_secret">Facebook App Secret</label>
                    <div class="form_input">
                      <input name="facebook_app_secret" id="facebook_app_secret" type="text" tabindex="11" value="<?php echo $admin_settings->row()->facebook_app_secret;?>" class="large tipTop" title="Please enter the facebook app secret"/>
                    </div>
                  </div>
                </li>
				
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_client_id">Google Client Id</label>
                    <div class="form_input">
                      <input name="google_client_id" id="google_client_id" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_client_id;?>" class="large tipTop" title="Please enter the google client id"/>
                    </div>
                  </div>
                </li>
                
                 <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_redirect_url">Google Redirect Url</label>
                    <div class="form_input">
                      <input name="google_redirect_url" id="google_redirect_url" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_redirect_url;?>" class="large tipTop" title="Please enter the google redirect url"/>
                      <label class="error">Note: For Google Redirect Url Copy This Url and Paste It. - <?php echo base_url();?>googlelogin/googleRedirect </label>
                    </div>
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_client_secret">Google Secret Key</label>
                    <div class="form_input">
                      <input name="google_client_secret" id="google_client_secret" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_client_secret;?>" class="large tipTop" title="Please enter the google secret key"/>
                    </div>
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_developer_key">Google Developer Key</label>
                    <div class="form_input">
                      <input name="google_developer_key" id="google_developer_key" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_developer_key;?>" class="large tipTop" title="Please enter the google developer key"/>
                    </div>
                  </div>
                </li>
				
				<!--<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="consumer_key">Twitter Consumer Key</label>
                    <div class="form_input">
                      <input name="consumer_key" id="consumer_key" type="text" tabindex="11" value="<?php echo $admin_settings->row()->consumer_key;?>" class="large tipTop" title="Please enter the twitter consumer key"/>
                       <label class="error">Note: For Twitter Callback URL Copy This Url and Paste It.  - <?php echo base_url();?>twtest/callback </label>
                    </div>                   
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="consumer_secret">Twitter Secret Key</label>
                    <div class="form_input">
                      <input name="consumer_secret" id="consumer_secret" type="text" tabindex="11" value="<?php echo $admin_settings->row()->consumer_secret;?>" class="large tipTop" title="Please enter the twitter secret key"/>
                    </div>
                  </div>
                </li>-->
				
			<?php /*
		  <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="facebook_inivte_api_id">Facebook Invite App ID </label>
                    <div class="form_input">
                      <input name="facebook_inivte_api_id" id="facebook_inivte_api_id" type="text" tabindex="11" value="<?php echo $admin_settings->row()->facebook_inivte_api_id;?>" class="large tipTop" title="Please enter the facebook app id"/>
                    </div>
                  </div>
                </li>                
                <?php */ ?>
                
              </ul>
             <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
				</div>
			</div></li></ul>
			</div>
            </form>
             <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'settings_form');
				echo form_open('admin/adminlogin/admin_global_settings',$attributes) 
			?>
			<input type="hidden" name="form_mode" value="seo"/>
            <div id="tab3">
              <ul>
               <li>
                  <h3>Search Engine Information</h3>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Meta Title</label>
                    <div class="form_input">
                      <input name="meta_title" id="meta_title" type="text" value="<?php echo $admin_settings->row()->meta_title;?>" tabindex="1" class="large tipTop" title="Please enter the site meta title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_keyword">Meta Keyword</label>
                    <div class="form_input">
                      <input name="meta_keyword" id="meta_keyword" type="text" value="<?php echo $admin_settings->row()->meta_keyword;?>" tabindex="2" class="large tipTop" title="Please enter the site meta keyword"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" class="" cols="70" rows="5" tabindex="3"><?php echo $admin_settings->row()->meta_description;?></textarea>
                    </div>
                  </div>
                </li>
                <li>
                  <h3>Google Webmaster Info</h3>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_verification_code">Google Analytics Code</label>
                    <div class="form_input">
                      <textarea name="google_verification_code" class="input_grow tipTop" title="Copy google analytics code and paste here" cols="70" rows="5" tabindex="4"><?php echo $admin_settings->row()->google_verification_code;?></textarea>
                      <br />
                      <span>For Examples:
                      <pre><?php echo htmlspecialchars('<script type="text/javascript>

  var _gaq = _gaq || [];
  _gaq.push([_setAccount, UA-XXXXX-Y]);
  _gaq.push([_trackPageview]);

  (function() {
    var ga = document.createElement(script); ga.type = text/javascript; ga.async = true;
    ga.src = (https: == document.location.protocol ? https://ssl : http://www) + .google-analytics.com/ga.js;
    var s = document.getElementsByTagName(script)[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>'); ?></pre>
                      </span> </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_keyword">Google HTML Meta Verification Code</label>
                    <div class="form_input">
                      <input name="google_verification" id="google_verification" value="<?php echo str_replace('"', "'",$admin_settings->row()->google_verification);?>" type="text" tabindex="5" class="large tipTop" title="Google HTMl Verification Code. Eg: <meta name='google-site-verification' content='XXXXX'>"/>
                      <span><br />
                      Google Webmaster Verification using Meta tag. <br />For more reference: <a href="https://support.google.com/webmasters/answer/35638#3" target="_blank">https://support.google.com/webmasters/answer/35638#3</a></span></div>
                  </div>
                </li>
              </ul>
              <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
				</div>
			</div></li></ul>
            </div>
             </form>
             <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'settings_form');
				echo form_open('admin/adminlogin/admin_global_settings',$attributes) 
			?>
			<input type="hidden" name="form_mode" value="seo"/>           
			<div id="tab4">
              <ul>
               <li>
                  <h3>Site Settings</h3>
                </li>
				<?php /*
                       <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Country Filter Enable </label>
                    <div class="form_input">
                      <input type="radio" id="countryall1" <?php  if($admin_settings->row()->allCountry=="Yes") { ?> checked="checked" <?php } ?>  value="Yes" name="allCountry"  />  <label for="countryall1" >Yes</label><br/>
                      <input type="radio" id="countryall2"  <?php  if($admin_settings->row()->allCountry=="No") { ?> checked="checked" <?php } ?> value="No" name="allCountry"  />  <label for="countryall1" >No</label><br/>
                     
                    </div>
                    </div>
                   </li>
				   */ ?>
                <li >
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Site Publish</label>
                    <div class="form_input">
                      <input name="publish" id="publish1"  type="radio" <?php if($admin_settings->row()->publish=="Production"){ echo "checked"; } ?> value="Production" tabindex="1" class="tipTop" title="Please select"/><label for="publish1">Production</label><input name="publish" <?php if($admin_settings->row()->publish=="Development"){ echo "checked"; } ?>  id="publish2" type="radio" value="Development" tabindex="1" class="tipTop" title="Please select"/><label for="publish2">Development</label>
                    </div>
                  </div>
                </li>
                <li id="dev_mode" style="height:170px; display:none;" >
                  <div class="form_grid_12">
                  
                    <label class="field_title" for="meta_keyword">Mode of Development</label>
                    <div class="form_input">
                        <div class="choose_mode" id="mode1" style="float:left;width:150px;height:140px;">
                        <label for="d_mode1"><img style="width:140px;height:140px;" src="uploaded/under-maintenance.jpg"/></label><input name="d_mode" id="d_mode1" type="radio" <?php if($admin_settings->row()->d_mode=="undermaintain"){ echo "checked";  } ?>  value="undermaintain" tabindex="1" class="large tipTop" title="Please select"/><label for="d_mode1">Under Maintainance</label>
                        </div>
                        <div class="choose_mode" style="float:left;width:140px;height:150px;" id="mode2">
                        <label for="d_mode2"><img style="width:140px;height:140px;" src="uploaded/coming-soon.jpg"/></label>
                        <input name="d_mode" id="d_mode2" type="radio"  <?php if($admin_settings->row()->d_mode=="comingsoon"){ echo "checked"; } ?>  value="comingsoon" tabindex="1" class="large tipTop" title="Please select"/><label for="d_mode2">Coming Soon</label>
                        </div>
                        <div class="choose_mode" style="float:left;width:140px;height:150px;"  id="mode3">
                        <label for="d_mode3"><img style="width:140px;height:140px;" src="uploaded/UnderConstruction.jpg"/></label>
                          <input name="d_mode" id="d_mode3" type="radio"  <?php if($admin_settings->row()->d_mode=="underconstruction"){ echo "checked"; } ?> value="underconstruction" tabindex="1" class="large tipTop" title="Please select"/><label for="d_mode3">Under Construction</label>
                          </div>
                          <div class="choose_mode" style="float:left;width:150px;height:140px;" id="mode4">
                          <label for="d_mode4"><img style="width:140px;height:140px;" src="uploaded/shortlyarrival.jpg"/></label>
                        <input name="d_mode" id="d_mode4" type="radio"  <?php if($admin_settings->row()->d_mode=="shortlyarrival"){ echo "checked"; } ?> value="shortlyarrival" tabindex="1" class="large tipTop" title="Please select"/><label for="d_mode4">Shortly Arrival</label>
                        </div><br/>
                    </div>
                  </div>
                </li>
				 <li>
                  <h3>Product Membership</h3>
                </li>
				<li >
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Membership For product</label>
                    <div class="form_input">
                      <input name="membership" id="membership"  type="radio" <?php if($admin_settings->row()->membership=="Yes"){ echo "checked"; } ?> value="Yes" tabindex="1" class="tipTop" title="Please select the Membership"/><label for="publish1">Yes</label><input name="membership" <?php if($admin_settings->row()->membership=="No"){ echo "checked"; } ?>  id="publish2" type="radio" value="No" tabindex="1" class="tipTop" title="Please select the membership"/><label for="publish2">No</label>
                    </div>
                  </div>
                </li>
				
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Membership Plan</label>
                    <div class="form_input">
						 <select class="chzn-select required" name="membership_plan" tabindex="1" style="width: 375px; display: none;" data-placeholder="Select Membership Plan">
                      		<option value=""></option>
                      		<option value="Y" <?php if($admin_settings->row()->membership_plan=="Y"){ echo "selected='selected'"; } ?>>Yearly</option>
							<option value="M" <?php if($admin_settings->row()->membership_plan=="M"){ echo "selected='selected'"; } ?>>Monthly</option>
							<option value="W" <?php if($admin_settings->row()->membership_plan=="W"){ echo "selected='selected'"; } ?>>Weakly</option>
							<option value="D" <?php if($admin_settings->row()->membership_plan=="D"){ echo "selected='selected'"; } ?>>Daily</option>
                      </select>	
                    </div>
                  </div>
                </li>
				<li >
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Membership Recurrsion</label>
                    <div class="form_input">
                      <input name="membership_option" id="membership_option"  type="text" value="<?php echo $admin_settings->row()->membership_option; ?>" class="small tipTop" title="Please Enter the Membership Recurrsion"/>
					  <label class="error">Note: Only give the inputs on number. Eg: 1 or 2 or ...</label>
                    </div>
                  </div>
                </li>
				<li >
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Membership Price</label>
                    <div class="form_input">
                      <input name="membership_price" id="membership_price"  type="text" value="<?php echo $admin_settings->row()->membership_price; ?>" class="small tipTop" title="Please Enter the Membership Price"/><?php echo $dcurrencySymbol; ?> (<?php echo $dcurrencyType; ?>)
					  
                    </div>
                  </div>
                </li>
             
              </ul>
              <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
				</div>
			</div></li></ul>
            </div>
            </form>
             <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'settings_form');
				echo form_open('admin/adminlogin/admin_global_settings',$attributes) 
			?>
			<input type="hidden" name="form_mode" value="seo"/>			
			<div id="tab5">
				<ul>
					<li>
						<h3>Footer Widget </h3>
					</li>
				</ul>
				<ul>
				
					<div class="form_grid_12">
						<li>
							<div class="form_grid_12">
								<label class="field_title" for="footer_widget1">Footer Widget 1</label>
								<div class="form_input">
										<textarea name="footer_widget1" id="footer_widget1"   tabindex="1" style="width:370px;" class="required large tipTop mceEditor" title="Footer Widget 1"><?php echo $admin_settings->row()->footer_widget1; ?></textarea>
								</div>

								<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
								</div>
							</div>
						</li>
            </form>
             <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'settings_form');
				echo form_open('admin/adminlogin/admin_global_settings',$attributes) 
			?>
			<input type="hidden" name="form_mode" value="seo"/>	
						<li>
							<div class="form_grid_12">
								<label class="field_title" for="footer_widget2">Footer Widget 2</label>
								<div class="form_input">
										<textarea name="footer_widget2" id="footer_widget2" tabindex="2" style="width:370px;" class="required large tipTop mceEditor" title="Footer Widget 2"><?php echo $admin_settings->row()->footer_widget2; ?></textarea>
								</div>

								<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
								</div>
							</div>
						</li>
            </form>
             <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'settings_form');
				echo form_open('admin/adminlogin/admin_global_settings',$attributes) 
			?>
			<input type="hidden" name="form_mode" value="seo"/>	
						<li>
							<div class="form_grid_12">
								<label class="field_title" for="footer_widget3">Footer Widget 3</label>
								<div class="form_input">
										<textarea name="footer_widget3" id="footer_widget3" tabindex="3" style="width:370px;" class="required large tipTop mceEditor" title="Footer Widget 3"><?php echo $admin_settings->row()->footer_widget3; ?></textarea>
								</div>

								<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
								</div>
							</div>
						</li>
            </form>
             <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'settings_form');
				echo form_open('admin/adminlogin/admin_global_settings',$attributes) 
			?>
			<input type="hidden" name="form_mode" value="seo"/>	
						<li>
							<div class="form_grid_12">
								<label class="field_title" for="footer_widget4">Footer Widget 4</label>
								<div class="form_input">
										<textarea name="footer_widget4" id="footer_widget4" tabindex="4" style="width:370px;" class="required large tipTop mceEditor" title="Footer Widget 4"><?php echo $admin_settings->row()->footer_widget4; ?></textarea>
								</div>

								<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
								</div>
							</div>
						</li>
            </form>
             <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'settings_form');
				echo form_open('admin/adminlogin/admin_global_settings',$attributes) 
			?>
			<input type="hidden" name="form_mode" value="seo"/>	
						<li>
							<div class="form_grid_12">
								<label class="field_title" for="Landing_widget1">Landing Before Footer</label>
								<div class="form_input">
										<textarea name="landing_widget1" id="landing_widget1" tabindex="4" style="width:370px;" class="required large tipTop mceEditor" title="Landing Widget 1"><?php echo $admin_settings->row()->landing_widget1; ?></textarea>
								</div>

								<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
								</div>
							</div>
						</li>
            </form>
             <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'settings_form');
				echo form_open('admin/adminlogin/admin_global_settings',$attributes) 
			?>
			<input type="hidden" name="form_mode" value="seo"/>	
						<li>
							<div class="form_grid_12">
								<label class="field_title" for="Landing_widget1">Shop Index Page</label>
								<div class="form_input">
										<textarea name="shop_index_page" id="shop_index_page" tabindex="4" style="width:370px;" class="required large tipTop mceEditor" title="Shop Index Page"><?php echo $admin_settings->row()->shop_index_page; ?></textarea>
								</div>
								<div class="form_input">
									<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
								</div>
							</div>
						</li>
					</div>
				</ul>
				<ul>
					<li>
						<div class="form_grid_12">

						</div>
					</li>
				</ul>
            </div>
            </form>
			
			<!----------------------------------        Zendesk API settings      ------------------------------->
			<div id="tab6">
			
			 <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'settings_form');
				echo form_open('admin/adminlogin/admin_global_settings',$attributes) 
			?>
			<input type="hidden" name="form_mode" value="api"/>
			
				<ul>
					<li>
						<h3>API Settings</h3>
					</li>
				</ul>
				<ul>
					<div class="form_grid_12">
						<li>
							<div class="form_grid_12">
								<h2>Zendesk API Settings</h2>
							</div>
						</li>
						<li>
							<div class="form_grid_12">
								<label class="field_title" for="zendesk_status">Zendesk Status</label>
								<div class="form_input">
										   
										    <input name="zendesk_status" id="zendesk_status1"  type="radio" <?php if($admin_settings->row()->zendesk_status=="Active"){ echo "checked"; } ?> value="Active" tabindex="1" class="tipTop" title="Please select"/>
											<label for="zendesk_status1">Active</label>
											<input name="zendesk_status" <?php if($admin_settings->row()->zendesk_status=="InActive"){ echo "checked"; } ?>  id="zendesk_status2" type="radio" value="InActive" tabindex="1" class="tipTop" title="Please select"/>
											<label for="zendesk_status2">In Active</label>
										   
								</div>
							</div>
						</li>
						<li>
							<div class="form_grid_12">
								<label class="field_title" for="zendesk_subdomain_name">Sub Domain Name</label>
								<div class="form_input">
										   <input name="zendesk_subdomain_name" id="zendesk_subdomain_name"  type="text" value="<?php echo $admin_settings->row()->zendesk_subdomain_name; ?>" class="large tipTop" title="Please Enter the sub domain name of zendesk"/>
								</div>
							</div>
						</li>
						<li>
							<div class="form_grid_12">
								<label class="field_title" for="zendesk_api">API Key (Token)</label>
								<div class="form_input">
										  <input name="zendesk_api" id="zendesk_api"  type="text" value="<?php echo $admin_settings->row()->zendesk_api; ?>" class="large tipTop" title="Please Enter the Zendesk API Key"/>
								</div>
							</div>
						</li>
						<li>
							<div class="form_grid_12">
								<label class="field_title" for="footer_widget4">Email </label>
								<div class="form_input">
										<input name="zendesk_email" id="zendesk_email"  type="text" value="<?php echo $admin_settings->row()->zendesk_email; ?>" class="large tipTop" title="Please Enter the Email of zendesk account"/>
								</div>
							</div>
						</li>
						
						
						<!--------       Twilio Sms Gateway  starts        ---------->
						
						<li>
					<h3>Twilo SMS API</h3>
                </li>
				
				
				<li>
					<div class="form_grid_12">
						<label class="field_title" for="zendesk_status">SMS API Status</label>
						<div class="form_input">
							<input name="twilio_status" id="twilio_status1"  type="radio" <?php if($admin_settings->row()->twilio_status=="Active"){ echo "checked"; } ?> value="Active" tabindex="1" class="tipTop" title="Please select"/>
							<label for="twilio_status1">Active</label>
							<input name="twilio_status" <?php if($admin_settings->row()->twilio_status=="InActive"){ echo "checked"; } ?>  id="twilio_status2" type="radio" value="InActive" tabindex="1" class="tipTop" title="Please select"/>
							<label for="twilio_status2">In Active</label>   
						</div>
					</div>
				</li>
				
				
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="twilio_account_type">Account Type</label>
					  <div class="form_input">
                      <input name="twilio_account_type" id="twilio_account_live" type="radio" <?php if($admin_settings->row()->twilio_account_type=="prod"){ echo "checked"; } ?> value="prod" tabindex="1" class= "tipTop" title="Please enter the twilio account type"/>
					  <label for="twilio_account_live">LIVE</label>
					  <input name="twilio_account_type" <?php if($admin_settings->row()->twilio_account_type=="sandbox"){ echo "checked"; } ?>  id="twilio_account_test" type="radio" value="sandbox" tabindex="1" class=" tipTop" title="Please enter the twilio account type"/>
					  <label for="twilio_account_test">TEST</label>
					</div>
                  </div>
                </li>

				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="twilio_account_sid">Account SID</label>
                    <div class="form_input">
                      <input name="twilio_account_sid" id="twilio_account_sid" type="text" value="<?php echo $admin_settings->row()->twilio_account_sid;?>" tabindex="10" class="large tipTop required" title="Please enter the twilio account sid"/>
                    </div>
                  </div>
                </li>
				
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="twilio_auth_token">Auth Token</label>
                    <div class="form_input">
                      <input name="twilio_auth_token" id="twilio_auth_token" type="text" value="<?php echo $admin_settings->row()->twilio_auth_token;?>" tabindex="10" class="large tipTop required" title="Please enter the twilio auth token"/>
                    </div>
                  </div>
                </li>
				
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="twilio_number">Number</label>
                    <div class="form_input">
                      <input name="twilio_number" id="twilio_number" type="text" value="<?php echo $admin_settings->row()->twilio_number;?>" tabindex="10" class="large tipTop required" title="Please enter the twilio number"/>
                    </div>
                  </div>
                </li>
				
					<li>
					<h3>FreshDesk API</h3>
                </li>
				
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="footer_content">FreshDesk status</label>
                    <div class="form_input">
                      <input name="fresh_desk" id="fresh_desk1" type="radio" value="Active" title="Fresh Desk Active" <?php if($admin_settings->row()->fresh_desk=='Active'){ echo 'checked="checked"';}?> /> Active
					<input name="fresh_desk" id="fresh_desk2" type="radio" value="InActive" title="Fresh Desk InActive" <?php if($admin_settings->row()->fresh_desk=='InActive'){ echo 'checked="checked"';}?>/> InActive
					</div>
                  </div>
				  
                </li>
				 <li id="appid_fresh" class="freshdesk">
                  <div class="form_grid_12">
                    <label class="field_title" for="footer_content">FreshDesk Key</label>
                    <div class="form_input">
                      <input name="fresh_desk_key" id="fresh_desk_key" type="text" value="<?php echo htmlentities($admin_settings->row()->fresh_desk_key);?>" tabindex="7" class="large tipTop" title="Please enter the Fresh desk Key"/>
                    </div>
                  </div>
                </li>
				<li class="freshdesk">
                  <div class="form_grid_12">
                    <label class="field_title" for="footer_content">FreshDesk  Link</label>
                    <div class="form_input">
                      <input name="fresh_desk_link" id="fresh_desk_link" type="text" value="<?php echo htmlentities($admin_settings->row()->fresh_desk_link);?>" tabindex="7" class="large tipTop" title="Please enter the Fresh desk  Link"/>
                    </div>
                  </div>
                </li>		
				
				<li class="freshdesk">
                  <div class="form_grid_12">
                    <label class="field_title" for="footer_content">FreshDesk  Email</label>
                    <div class="form_input">
                      <input name="fresh_desk_email" id="fresh_desk_email" type="text" value="<?php echo htmlentities($admin_settings->row()->fresh_desk_email);?>" tabindex="7" class="large tipTop" title="Please enter the Freshdesk  email"/>
                    </div>
                  </div>
                </li>		
						
						
						
					</div>
				</ul>
				<ul>
					<li>
						<div class="form_grid_12">
							<div class="form_input">
								<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
							</div>
						</div>
					</li>
				</ul>
            </div>
			
			
			
			
			
          </div>
        </div>
      </div>
    </div>
  </div>
  <span class="clear"></span> </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
/* if($("#fresh_desk1").attr("checked")=="checked"){
		$('.freshdesk').css('display','block');
	}else{
		$('.freshdesk').css('display','none');
	}
	
	 $("#admin_setting_submit").click(function () {
		e.preventDefault();	
		if($("#fresh_desk1").attr("checked")=="checked"){
			if($('#fresh_desk_link').val()=''){
				alert('Please Enter Fresh Desk Link');
				return false;
			}else if($('#fresh_desk_key').val()=''){
				alert('Please Enter Fresh Desk Api Key');
				return false;
			}else{
				return true;
			}
		}
	 
	 });
	 
	 
	 $("#fresh_desk1").change(function () {
			if($("#fresh_desk1").attr("checked")=="checked"){
				$('.freshdesk').css('display','block');
			}
	 });
	$("#fresh_desk2").change(function () {
		if($("#fresh_desk2").attr("checked")=="checked"){
			$('.freshdesk').css('display','none');
		}
	});
 */
if($("#publish1").attr("checked")=="checked")
 {
  $("#d_mode1").attr("checked",false);$("#d_mode2").attr("checked",false);$("#d_mode3").attr("checked",true);$("#d_mode4").attr("checked",false);
  $("li#dev_mode").hide();
  
 }
 $("#publish1").click(function()
  {
    $("#d_mode1").attr("checked",false);$("#d_mode2").attr("checked",false);$("#d_mode3").attr("checked",false);$("#d_mode4").attr("checked",false);
  $("li#dev_mode").hide();
	
  } );
 
  $("#publish2").click(function()
  {
  //$("#d_mode3").attr("checked",true);
   
    //$("li#dev_mode").show();
	
  } );


	$("#site_image").change(function(e) {
	
			e.preventDefault();	
			var formData = new FormData($(this).parents('form')[0]);
			$.ajax({
				url: 'admin/adminlogin/ajax_chk_images',
				type: 'POST',            
				success: function (data) {
					var arr = data.split('|');
					if(arr[0]=='Success'){
					  document.getElementById("loadedImg").src=arr[1];
					  $("#showImgErr").hide();
					}else{
						$("#site_image").val('');
						$("#showImgErr").html(arr[1]); 
						$("#showImgErr").show();
						//$("#showImgErr").delay('5000').fadeOut();
					}
				},
				data: formData,
				cache: false,
				contentType: false,
				processData: false
			});
			return false;
	});
});


tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
    editor_selector : 'footer_widget1',
      style_formats : [
                {title : 'Bold text', inline : 'b'},
                {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
                {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
                {title : 'Example 1', inline : 'span', classes : 'example1'},
                {title : 'Example 2', inline : 'span', classes : 'example2'},
                {title : 'Table styles'},
                {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
            ],
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    plugins: "pagebreak,fullscreen,media,advimage,paste,searchreplace,advlink",
    theme_advanced_buttons1 : "save_button,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,styleselect",
    theme_advanced_buttons2 : "bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,|,anchor,|,image,|,cleanup,|,help,|,code",
    theme_advanced_buttons3 : "hr,removeformat,|,visualaid,|,sub,sup,|,charmap",
});


</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>