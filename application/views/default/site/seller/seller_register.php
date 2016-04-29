<?php 

$this->load->view('site/templates/header');

$user_row = $UserVal->result_array(); 

?>

<section>

	

    	<div class="main">

        <div class="wrapper">

        <ul class="vertical_link">

        	<li> <a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('header_home') != '') { echo stripslashes($this->lang->line('header_home')); } else echo "Home"; ?></a></li>

            <li> <a href="javascript:void(0);" class="a_links"><?php if($this->lang->line('arti_seller_application') != '') { echo stripslashes($this->lang->line('arti_seller_application')); } else echo "Artizanz Seller Application"; ?></a></li>

        </ul>

        <div class="blog_setup">

       <div class="heading" style="font-size:16px;"><?php if($this->lang->line('seller_applications') != '') { echo stripslashes($this->lang->line('seller_applications')); } else echo "Seller Applications"; ?></div>

       <h2 class="title_use"><?php if($this->lang->line('handmade_artisans') != '') { echo stripslashes($this->lang->line('handmade_artisans')); } else echo "Join the elite of handmade artisans"; ?></h2>

       <p class="text_value"><?php if($this->lang->line('welcome_artizanz') != '') { echo stripslashes($this->lang->line('welcome_artizanz')); } else echo "Welcome to"; echo $this->config->item('email_title'); "We are currently building our platform and are looking for the best in handmade artisans.  Put in your application to get your storefront reserved today.Like us on Facebook or follow us on Twitter for the latest updates."; ?></p>

       

<!--<p class="share_tex" style="margin-left:15px; margin-top:6px;"><?php if($this->lang->line('seller_share_on') != '') { echo stripslashes($this->lang->line('seller_share_on')); } else echo "Share on"; ?></p>--> 



 <div class="share_link" style="width:90%; margin:10px 0 2px 15px;">

	<p class="share_tex" style="margin-top:8px;" ><?php if($this->lang->line('seller_share') != '') { echo stripslashes($this->lang->line('seller_share')); } else echo 'Share On'; ?> :</p> 



  <?php   $values_val = base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>



<!-- AddThis Button BEGIN -->

<div class='addthis_toolbox' addthis:url="<?php echo $values_val; ?>">

<div class='custom_images'>

<a class='addthis_button_facebook'><img src="images/facebook.png" alt="facebook" title="facebook" /></a>

<a class='addthis_button_twitter'><img src="images/tw.png" alt="twitter" title="twitter" /></a>

<a class='addthis_button_google'><img src="images/google.png" alt="google+" title="google+" /></a>

<a class='addthis_button_pinterest_share'><img src="images/pay.png" alt="pinterest" title="pinterest" /></a>

</div>

</div>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50ab628f64d148de"></script>        

 	</div>

        

        

        



<!-- AddThis Button END -->

        

        

        <!----------------------- Social share start---------------------->

<?php /*?><div style="float:left; width:90%; margin:10px 0 2px 15px;">

                            	<!--<label style="font-size:13px;">Share this items: </label>-->

                                <p class="share_tex" >Share On :</p> 

                                <a href="javascript:void(0);"  onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>'),'facebook-share-dialog','width=626,height=436'); return false;">

                                <img src="images/fa.png" style="float:left; margin:0px 5px 0 5px;" /></a>

                                <a href="javascript:void(0);" onclick="window.open('https://twitter.com/share','twitter-share-button','width=626,height=436'); return false;" class="twitter-share-buttn" data-url="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>" ><img src="images/twea.png" style="float:left; margin:0px 5px 0 5px;" /></a>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

                              <!-- <a href="#"><img src="images/twi.png" style="float:left; margin:3px 5px 0 5px;" /></a>-->

                               <?php  $fileImage = @explode(',',$productVal[0]['image']); 

		 $imageName =  $fileImage[0];

		// echo base_url().PRODUCTPATH.$imageName;die;

		if (file_exists(PRODUCTPATH.$imageName)) {

		 

			 $imageName =  base_url().PRODUCTPATH.$imageName;

		} else {		 

			 $imageName =  base_url()."images/logo/".$logo;

		}

                 ?>

      

                      <a href="javascript:void(0);" onclick="window.open('https://plus.google.com/share?url=<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>','google-share-button','width=626,height=436'); return false;"><img src="images/gog.png"  style="float:left; margin:0px 5px 0 5px;" /></a>

                      

                             

                            <a href="http://www.pinterest.com/pin/create/button/?url=<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>&media=<?php echo $imageName; ?>&description=<?php echo stripslashes($productVal[0]['description']); ?> " data-pin-do="buttonPin">

                            <!--<img src="images/pay.png" style="float:left; margin:3px 5px 0 5px;" />

        <img src="<?php echo base_url();?>images/pay.png" />-->

         

    </a>

                         

                       <script type="text/javascript">

(function(d){

    var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');

    p.type = 'text/javascript';

    p.async = true;

    p.src = '//assets.pinterest.com/js/pinit.js';

    f.parentNode.insertBefore(p, f);

}(document));

</script>

                              

                           <!--  <a href="javascript:void(0);" onclick="window.open('http://www.pinterest.com/pin/create/button/?url=<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>','pint-share-button','width=626,height=436'); return false;"><img src="images/pay.png"  style="float:left; margin:3px 5px 0 5px;" /></a>     

                                

<!-- Please call pinit.js only once per page -->

<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>-->

                             <!-- Place this tag where you want the share button to render. -->



                             </div><?php */?>



<!----------------------- Social share end---------------------->

        

        <div class="clear"></div>

 <h2 class="title_use" style="margin-bottom:12px;"><?php if($this->lang->line('seller_applications') != '') { echo stripslashes($this->lang->line('seller_applications')); } else echo "Seller Application"; ?></h2>

 <div class="clear"></div>

             <form method="post" enctype="multipart/form-data" action="site/seller/seller_signup" onsubmit="return validateSeller_Signup();" class="frm clearfix"><input type='hidden' />

             

             <input type="hidden" name="pagename" id="pagename" value="<?php echo $product_id = $this->uri->segment(1); ?>" />



 <div class="full_viewcon">

    

    	<!--<div class="fb_div"><a href="#"><img src="images/sign_fb.png" /></a></div>

        <div class="clear"></div>

        <div class="or_div">

        	<span>OR</span>

        </div>-->

      <input type="hidden" class="search width_field_1" style="margin:0" name="seller_id" value="<?php echo $this->session->userdata('shopsy_session_user_id') ?>" />



        <div class="split_sellpage">

        <div class="popup_login width_field">

        	<label> <?php if($this->lang->line('seller_business_name') != '') { echo stripslashes($this->lang->line('seller_business_name')); } else echo "Business Name"; ?><span style="color:#F00;">*</span><span style="color:#F00;" class="redFont" id="seller_businessname_Err"></span></label>

            <input type="text" class="search width_field_1" style="margin:0" name="seller_businessname"  id="seller_businessname" value="<?php echo $sellerVal[0]['seller_businessname']; ?>"  />

        </div>

        

         <div class="popup_login width_field">

        	<label><?php if($this->lang->line('seller_user_name') != '') { echo stripslashes($this->lang->line('seller_user_name')); } else echo "Email or Username"; ?><span style="color:#F00;">*</span></label>

            <input type="text" class="search width_field_1" style="margin:0" name="seller_email" id="seller_email" value="<?php echo $this->session->userdata('shopsy_session_user_email') ?>" readonly="readonly"/>

        </div>

         <div class="popup_login width_field">

        	<label><?php if($this->lang->line('seller_crafting') != '') { echo stripslashes($this->lang->line('seller_crafting')); } else echo "How long have you been crafting?"; ?><span style="color:#F00;">*</span><span style="color:#F00;" class="redFont" id="seller_crafting_Err"></span></label>

            <input type="text" class="search width_field_1" name="seller_crafting" id="seller_crafting" style="margin:0" value="<?php echo $sellerVal[0]['seller_crafting']; ?>"  />

        </div>

        

         <div class="popup_login width_field" >

        	<label><?php if($this->lang->line('seller_product_desc') != '') { echo stripslashes($this->lang->line('seller_product_desc')); } else echo "What is your process for producing your products? Please explain from beginning to end of projects."; ?><span style="color:#F00;">*</span><span style="color:#F00;" class="redFont" id="seller_product_Err"></span></label>

           

            <textarea class="search width_field_1" name="seller_product" id="seller_product" style="margin-left:0px; width:53% !important; height:40%;"><?php echo $sellerVal[0]['seller_product']; ?> </textarea>

        </div>

        

        

        </div>

           <div class="split_sellpage">

         <div class="popup_login width_field">

        	<label><?php if($this->lang->line('seller_owner_name') != '') { echo stripslashes($this->lang->line('seller_owner_name')); } else echo "Business Owner's Name"; ?><span style="color:#F00;">*</span></label>

            <input type="text" class="search width_field_2" placeholder="<?php if($this->lang->line('seller_fname') != '') { echo stripslashes($this->lang->line('seller_fname')); } else echo "First name"; ?>"  name="seller_firstname" style="margin:0" value="<?php echo $this->session->userdata('shopsy_session_user_name') ?>" readonly="readonly" />

            <input type="text" class="search width_field_2" style="margin:0" name="seller_lastname" placeholder="<?php if($this->lang->line('seller_lname') != '') { echo stripslashes($this->lang->line('seller_lname')); } else echo "Last name"; ?>"  readonly="readonly" value="<?php echo $user_row[0]['last_name']; ?>"  />

        </div>

       

        <div class="popup_login width_field" >

        	<label><?php if($this->lang->line('seller_medium') != '') { echo stripslashes($this->lang->line('seller_medium')); } else echo "What mediums do you work with?"; ?><span style="color:#F00;">*</span></label>

            <!--<input type="password" class="search width_field_1" style="margin:0" />-->

            <select class="search width_field_1" style="margin-left:0px; width:58% !important;" name="seller_medium" >

            <?php foreach($CatogoryVal->result_array() as $catVal){ ?>

            	<option value="<?php echo $catVal['seourl']; ?>" <?php if($sellerVal[0]['seller_medium'] == $catVal['seourl']){ echo 'selected="selected"';} ?> ><?php echo $catVal['cat_name']; ?></option>

             <?php } ?>   

                <option><?php if($this->lang->line('seller_photography') != '') { echo stripslashes($this->lang->line('seller_photography')); } else echo 'Photography'; ?></option>

             </select>

        </div>

        

        

       

       

        

         <div class="popup_login width_field">

        	<label><?php if($this->lang->line('seller_kind') != '') { echo stripslashes($this->lang->line('seller_kind')); } else echo "What kind of items do you make?"; ?><span style="color:#F00;">*</span><span style="color:#F00;" class="redFont" id="seller_make_Err"></span></label>

           

            <textarea class="search width_field_1" style="margin-left:0px; width:54% !important; height:40%;" name="seller_make" id="seller_make"><?php echo $sellerVal[0]['seller_make']; ?> </textarea>

        </div>

        

         <div class="popup_login width_field">

        	<label><?php if($this->lang->line('seller_site_url') != '') { echo stripslashes($this->lang->line('seller_site_url')); } else echo "Do you currently have an open e-commerce shop?

If so please provide link."; ?> </label>



<div class="clear"></div>

            <input type="text" class="search width_field_1" style="margin:0"  name="seller_site"  id="seller_site" value="<?php echo $sellerVal[0]['seller_site']; ?>" />

            <div class="clear"></div>

            <span  class="note_aling"><?php if($this->lang->line('seller_note') != '') { echo stripslashes($this->lang->line('seller_note')); } else echo 'Note : http'; ?>://</span>

        </div>

        

         

        </div>

         <div class="clear"></div>

          <div class="popup_login" style="width:98%; margin-left:12px; ">

          <label style="width:91%; line-height:20px;"><?php if($this->lang->line('seller_desc_txt') != '') { echo stripslashes($this->lang->line('seller_desc_txt')); } else echo "Will you be able to submit photos of you hand making an item for handmade authentication? I will provide you with a NDA (Non Disclosure Agreement), which means that I will not be able to show them to anyone or speak of them."; ?><span style="color:#F00;">*</span><span style="color:#F00;" class="redFont" id="seller_nda_Err"></span></label>

          <div class="clear"></div>



            <input type="checkbox" class="check_box" style="margin:0 5px 0 0px; float:left;" id="seller_nda" name="seller_nda" value="yes" <?php if($sellerVal[0]['seller_nda'] == 'yes') { ?> checked="checked" <?php } ?> />

            <label style="width:91%;"><?php if($this->lang->line('user_yes') != '') { echo stripslashes($this->lang->line('user_yes')); } else echo 'Yes'; ?></label>

          <div class="clear"></div>

            

        </div>

        <div class="clear"></div>

        <div class="popup_login" style="width:98%;  margin-left:12px; ">

          <label style="width:91%; line-height:20px;"><?php if($this->lang->line('seller_desc_txt1') != '') { echo stripslashes($this->lang->line('seller_desc_txt1')); } else echo "I have read the seller information page and understand the strict standards that come with selling on Artizanz. I understand that these are not the complete Terms of Use, but that I will be provided with a copy of the Terms of Use before I would be obligated to make any subscription payments, and would have the option to opt out, with no obligation to pay anything, once the Terms of Use are provided to me."; ?><span style="color:#F00;">*</span><span style="color:#F00;" class="redFont" id="seller_agreement_Err"></span></label>

          <div class="clear"></div>

        	

            <input type="checkbox" class="check_box" style="margin:0 5px 0 0px; float:left;" id="seller_agreement" name="seller_agreement" value="yes" <?php if($sellerVal[0]['seller_agreement'] == 'yes') { ?> checked="checked" <?php } ?> />

            <label style="width:91%;"><?php if($this->lang->line('user_yes') != '') { echo stripslashes($this->lang->line('user_yes')); } else echo 'Yes'; ?></label>

          <div class="clear"></div>

            

        </div>

         

          	<input type="submit" class="submit_1" value="<?php if($this->lang->line('user_submit') != '') { echo stripslashes($this->lang->line('user_submit')); } else echo 'Submit'; ?>" style=" margin-left:12px;"  />

             <div class="clear"></div>

        

          

          

    </div>

        	

     </form>  

		</div>

	</div>

</div>

        

    

 

	

</section>

<script src="js/vaidation.jquery.js"></script>

<script src="js/validation.js"></script>

<?php 



$this->load->view('site/templates/footer');

?>