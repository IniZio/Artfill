<?php 
$this->load->view('site/templates/header');
$this->load->model('product_model');
$this->load->model('user_model');
//echo "<pre>";print_r($languages)->result(); die;
?>

<section class="container">
    	<div class="main">
        	<!--<ul class="bread_crumbs">
            	<li><a href="#">Home</a></li>
                <span>›</span>
                <li><a href="#">Community</a></li>
                <span>›</span>
                <li><a href="#">Teams</a></li>
            </ul>-->
            <div class="community_page">
            	<!--<div class="community_head">
                	<h1>2014 Success Team </h1>
                    
                   
                </div>-->
                <div class="community_div">
                	<div class="community_left">
                    	 <?php $this->load->view('site/user/sidebar');?>          
                       
                        
                    
                     
                     
                                       
                    </div>
                    <div class="community_right" style="margin-left:15px; float:right; width:78%;">
                    	
                        <?php $this->load->view("site/user/settings_tab");?>
                        <form action="update-preferences" method="post" id="preferencesForm" name="preferencesForm">
                           
                    <!--<div class="pass">
                  <div class="heading_account" ><?php if($this->lang->line('user_teasury_mature') != '') { echo stripslashes($this->lang->line('user_teasury_mature')); } else echo 'Treasury Mature Content Filtering'; ?></div>
                  <p class="p_text1"><a href="#"><?php if($this->lang->line('user_learn_more') != '') { echo stripslashes($this->lang->line('user_learn_more')); } else echo 'Learn more'; ?> </a><?php if($this->lang->line('user_about_filter') != '') { echo stripslashes($this->lang->line('user_about_filter')); } else echo 'about content filtering'; ?>.</p>
                  <div class="field_account">
        	        <input name="" type="radio" value=""  style="float:left;"/>
                    <label style=" margin:1px 0 0 3px;" ><b><?php if($this->lang->line('user_fit_mat_cont') != '') { echo stripslashes($this->lang->line('user_fit_mat_cont')); } else echo 'Filter mature content'; ?></b> <?php if($this->lang->line('user_from_tresure_rslts') != '') { echo stripslashes($this->lang->line('user_from_tresure_rslts')); } else echo 'from Treasury results'; ?> </label>
                  </div>
                   <div class="field_account">
        	        <input name="" type="radio" value="" style="float:left;"/>
                    <label style=" margin:1px 0 15px 3px;" ><b><?php if($this->lang->line('user_show_me_every') != '') { echo stripslashes($this->lang->line('user_show_me_every')); } else echo 'Show me everything'; ?></b> <?php if($this->lang->line('user_in_trsure_content') != '') { echo stripslashes($this->lang->line('user_in_trsure_content')); } else echo 'in Treasury results, including mature content'; ?></label>
                  </div>
        
            </div>-->	
            
            		<?php /*<div class="pass">
                  <div class="heading_account" ><?php if($this->lang->line('user_language') != '') { echo stripslashes($this->lang->line('user_language')); } else echo 'Language'; ?></div>
                  <p class="p_text"><?php if($this->lang->line('user_chose_defaul_lang') != '') { echo stripslashes($this->lang->line('user_chose_defaul_lang')); } else echo 'Choose your default language'; ?></p>
                  <ul class="preference_split">
                  
				  
				  <!---  Languages List Loop starts here  -->
				  
				  <?php foreach($languagesList->result() as $langList) {?>
                  <li class="languageLi1 <?php if($languageCode == $langList->lang_code){ echo 'currencyactive';}?>" id="<?php echo 'pref-'.$langList->lang_code;?>"><a><?php echo $langList->name;?></a></li>
                  <?php }?>
                  <!---  Languages List Ends Loop Ends here  -->
                
                  
                  </ul>
                  <!--<div style="float:left; margin:0px; padding:0px;">
                  <p class="p_text"><?php if($this->lang->line('user_view_site_eng') != '') { echo stripslashes($this->lang->line('user_view_site_eng')); } else echo 'View the site in English (US)'; ?>. </p>
                  
                  </div>-->
        
            </div> */ ?>
            
            		<div class="pass" >
                  <div class="heading_account" ><?php if($this->lang->line('user_currency') != '') { echo stripslashes($this->lang->line('user_currency')); } else echo 'Currency'; ?></div>
                  <p class="p_text"><?php if($this->lang->line('user_defaul_curr') != '') { echo stripslashes($this->lang->line('user_defaul_curr')); } else echo 'Choose your default currency'; ?>:</p>
                  <ul class="preference_split" style="border:none;">
                  
                  
                  <!---  Currency List Loop starts here  -->
                  
                  
                 <?php foreach($currencyList->result() as $curList) {?> 
                  <li class="currencyLi1 <?php if($curList->currency_code == $currencyType){ echo 'currencyactive';}?>" id="<?php echo 'pref-'.$curList->currency_code;?>">
                  <span><?php echo $curList->currency_symbol;?> </span>
                  <a><?php //if($this->lang->line('user_us_dollar') != '') { echo stripslashes($this->lang->line('user_us_dollar')); } 
				  echo $curList->currency_name; ?></a>
                  <span style="margin:4px 0 0 0px;"> <?php //if($this->lang->line('user_usd') != '') { echo stripslashes($this->lang->line('user_usd')); } 
				 echo $curList->currency_code; ?></span>
                  </li> 
                  <?php }?>
                  
                  
                  <!---  Currency List Loop ends here  -->
                   </ul>
                 
        
            </div>
            		
                    <!--<div class="pass">
                  <div class="heading_account" ><?php if($this->lang->line('user_region') != '') { echo stripslashes($this->lang->line('user_region')); } else echo 'Region'; ?></div>
                  <p class="p_text"><?php if($this->lang->line('user_set_region_cont') != '') { echo stripslashes($this->lang->line('user_set_region_cont')); } else echo 'Set your region to help us show you custom content from your area'; ?>.</p>
                 
                  
                  <div class="shipping_field" style="margin-bottom:10px;">
        	    <select class="shipping_fiel" style=" margin-left:0px;" name="region">
                <option value="EV" <?php if($regionCode == 'EV'){ echo 'selected="selected"';}?>><?php if($this->lang->line('user_everywhere') != '') { echo stripslashes($this->lang->line('user_everywhere')); } else echo 'Everywhere'; ?></option>
                <optgroup label="___________________"></optgroup>
                   <?php foreach($countryList as $conList) { if($conList->country_code != 'EV'){?>
                     <option value="<?php echo $conList->country_code;?>" <?php if($regionCode == $conList->country_code){ echo 'selected="selected"';}?>><?php echo $conList->name;?></option>
                     <?php }}?>
                    </select>
                  </div>
            </div>-->
            
            		<!--<div class="pass">
                  <div class="heading_account" ><?php if($this->lang->line('user_postal_mail') != '') { echo stripslashes($this->lang->line('user_postal_mail')); } else echo 'Postal Mail'; ?></div>
                 
                  <div class="field_account" style="margin-bottom:10px; margin-left:10px;">
        	        <input name="" type="checkbox" value=""  style="float:left; margin-top:7px;"/>
                    <?php 
						$user_rece_post_mail = str_replace("{SITENAME}",$siteTitle,$this->lang->line('user_rece_post_mail'));
					?>
                    <label style=" margin:3px 0 0 3px;" ><?php if($this->lang->line('user_rece_post_mail') != '') { echo stripslashes($user_rece_post_mail); } else echo 'Receive Postal Mail from '.stripslashes($siteTitle).''; ?></label>
                  </div>
            </div>-->
            
            		<!--<div class="pass">
                  <div class="heading_account" ><?php if($this->lang->line('user_phone_calls') != '') { echo stripslashes($this->lang->line('user_phone_calls')); } else echo 'Phone Calls'; ?></div>
                 
                  <div class="field_account" style="margin-bottom:10px; margin-left:10px;">
        	        <input name="" type="checkbox" value=""  style="float:left; margin-top:7px;"/>
                     <?php 
						$user_rece_post_mail = str_replace("{SITENAME}",$siteTitle,$this->lang->line('user_rece_post_mail'));
					?>
                    <label style=" margin:3px 0 0 3px;" ><?php if($this->lang->line('user_rece_post_mail') != '') { echo stripslashes($user_rece_post_mail); } else echo 'Receive Postal Mail from ' .stripslashes($siteTitle).''; ?></label>
                  </div>
                  
                 
            </div>-->
            
            		  <div class="clear"></div>
         
          	<input type="submit" class="password_btn" value="<?php if($this->lang->line('user_update_preferences') != '') { echo stripslashes($this->lang->line('user_update_preferences')); } else echo 'Update Preferences'; ?>" style=" margin-left:10px; margin-top:1px;" />
                   <input type="hidden" name="currency" id="currency1" value="<?php echo $currencyType;?>" />
                   <input type="hidden" name="language" id="language1" value="<?php echo $langList->lang_code;?>" />  
                </form>
                   </div>
                </div>
            </div>
        </div>
    </section>

<script>
$(document).ready(function(e) {
    $('.currencyLi1').each(function() {
		//
       $(this).click(function(e) {
	   $('.currencyLi1').removeClass('currencyactive');
       var curId1=$(this).attr('id');
	   $('#'+curId1).addClass('currencyactive');
	   var changeCur=curId1.replace("pref-",""); 
	   $('#currency1').val(changeCur);
    });
	  
    });
	
	
	$('.languageLi1').each(function() {
		//
       $(this).click(function(e) {
	   $('.languageLi1').removeClass('currencyactive');
      var langId1=$(this).attr('id'); 
	   $('#'+langId1).addClass('currencyactive');
	   var changeLang=langId1.replace("pref-",""); 
	  // $('#'+langId1).addClass('currencyactive');
	   $('#language1').val(changeLang);
    });
	  
    });
	
	
});

</script>
<?php 
     $this->load->view('site/templates/footer');
?>
