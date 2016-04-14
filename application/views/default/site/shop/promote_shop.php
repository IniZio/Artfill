<?php  
//die;
$this->load->view('site/templates/shop_header');

?>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<?php } ?>
<div class="clear"></div>
<div id="shop_page_seller">
<section class="container">

        <div class="main">
		
		
		
		<ul class="bread_crumbs">
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
		   <span>&rsaquo;</span>
		    <li><?php if($this->lang->line('Promote_your_shop') != '') { echo stripslashes($this->lang->line('Promote_your_shop')); } else echo 'Promote your shop'; ?></li>
        </ul>

            <div class="new_prof">            

                <div class="community_page">            	

                    <div class="community_right">

                        <div class="split_prefile">

                            <h2><?php if($this->lang->line('shop_banner') != '') { echo stripslashes($this->lang->line('shop_banner')); } else echo 'This Banner Shows in'; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('shop_mainpage') != '') { echo stripslashes($this->lang->line('shop_mainpage')); } else echo 'Main Page'; ?>. </h2>

                            <div class="clear"></div>

                        </div>

                        <form action="site/shop/insertShopBanner" method="post" enctype="multipart/form-data" id="banner_form" name="banner_form"> 

                            <div class="pass">

                                <div class="profile_field" id="banner_div">

                                    <label ><?php if($this->lang->line('shop_bann') != '') { echo stripslashes($this->lang->line('shop_bann')); } else echo 'Banner'; ?> </label>     

   <div class="input-change"><div><input type="button" onclick="document.getElementById('banner_img').click()" value="<?php if($this->lang->line('choose_file') != '') { echo stripslashes($this->lang->line('choose_file')); } else echo 'Choose File'; ?> ..." /><b id="no_file_selected"><?php if($this->lang->line('no_file_selected') != '') { echo stripslashes($this->lang->line('no_file_selected')); } else echo 'No File Selected'; ?> </b></div></div> 									
                                    <input type="file" class="shipping_fiel" style="margin:10px 0 0 10px" id="banner_img" name="image"/> <br />

                                   <img id="loadedImgPromote" src="images/loader64.gif" style="widows:25px; height:25px; display:none" />

                                   

                                    <label id="ErrImage" class="img-size"><?php if($this->lang->line('shop_imgsize') != '') { echo stripslashes($this->lang->line('shop_imgsize')); } else echo 'Image Size 1400 x 400 pixel'; ?></label>

                            	</div>

                                <div class="clear"></div>

                                <div class="profile_bor"></div>

                                <div class="bannerselection">                                	

                                    <input type="hidden" name="seller_businessname" value="<?php echo stripslashes($Seller_details[0]['seller_businessname']); ?>"/>

                                    <input type="hidden" name="seller_id" value="<?php echo stripslashes($Seller_details[0]['seller_id']); ?>"/>

                                    <?php if($Seller_details[0]['seller_banner']!=''){ ?>

                                		<img src="images/banner/<?php echo $Seller_details[0]['seller_banner']; ?>" />

                                    <?php } ?>

                                </div>

                            </div>

                            <div class="clear"></div>

                            <?php if($Seller_details[0]['seller_banner']!=''){ ?>

	                       		<input type="submit" class="password_btn" value="<?php if($this->lang->line('shop_changebanner') != '') { echo stripslashes($this->lang->line('shop_changebanner')); } else echo 'Change Banner'; ?>" style=" margin-left:10px; margin-top:1px;" />

                            <?php } else{ ?>

                           	<input type="submit" class="password_btn" value="<?php if($this->lang->line('shop_promote') != '') { echo stripslashes($this->lang->line('shop_promote')); } else echo 'Promote'; ?>" style=" margin-left:10px; margin-top:1px;" />                           

                            <?php } ?>

                            <input type="hidden" name="shop-banner" value="main-banner-img" />  

                    	</form>

                    </div>

                    </div>

            </div>

        </div>

    </section> 	 	
</div>
<script type="text/javascript">

$(document).ready(function(){
$('#banner_img').on('change',function(){         
$('#no_file_selected').text(this.value);                           
                            });
});    
</script>

<?php 

$this->load->view('site/templates/footer');

?>





