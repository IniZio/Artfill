<?php $this->load->view('site/templates/header'); ?>

<!-- section_start -->
    <script type="text/javascript">

		$(document).ready(function() {

			$('.slidewrap').carousel({

				slider: '.slider',

				slide: 'li',

				nextSlide: '.next',

				prevSlide: '.prev',

				speed: 1000 // ms.

			});

		});



</script>





<link rel="stylesheet" type="text/css" media="all" href="css/default/colorbox.css"/>

<link rel="stylesheet" type="text/css" media="all" href="css/default/jquery.ad-gallery.css"/>

<link rel="stylesheet" type="text/css" media="all" href="css/default/shopsy_style.css"/>

<link rel="stylesheet" type="text/css" media="all" href="css/default/account_master.css">

<link rel="stylesheet" type="text/css" media="all" href="css/default/jquery.galleryview-3.0-dev.css"/>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>

<script src="js/plugin.js" type="text/javascript"></script>

<script src="js/jquery.ad-gallery.js" type="text/javascript"></script>

<script src="js/SpryTabbedPanels.js" type="text/javascript"></script>

<script type="text/javascript">

  $(function() {

   

    var galleries = $('.ad-gallery').adGallery();

    $('#switch-effect').change(

      function() {

        galleries[0].settings.effect = $(this).val();

        return false;

      }

    );

    $('#toggle-slideshow').click(

      function() {

        galleries[0].slideshow.toggle();

        return false;

      }

    );

    $('#toggle-description').click(

      function() {

        if(!galleries[0].settings.description_wrapper) {

          galleries[0].settings.description_wrapper = $('#descriptions');

        } else {

          galleries[0].settings.description_wrapper = false;

        }

        return false;

      }

    );

  });

  </script>

<div class="clear"></div>
<section class="container">

    

    	<div class="main">

        

        	<div class="container">            

            	<div class="seller-wrapper">

                	<div class="col5 col">

                    	<div class="seller-img">

                        	<a href="#"><img src="images/nfmb.jpg" /></a>

                        </div>

                        <div class="seller-name">

                        	<a href="#"><?php if($this->lang->line('shop_pencils') != '') { echo stripslashes($this->lang->line('shop_pencils')); } else echo 'POPCULTUREPENCILS'; ?></a>

                        </div>

                        <div class="fav-btn">

                        	<a href="#">

                            	<span class="fav-icon"></span>

                                <span class="status-txt"><?php if($this->lang->line('shop_favshop') != '') { echo stripslashes($this->lang->line('shop_favshop')); } else echo 'Favorite Shop'; ?></span>

                            </a>

                        </div>

                    </div>

                    <div class="col7 col shop-listings" style="float:right">

                    	<ul class="seller-links">

                        	<li>

                            	<a href="#">

                                	<div class="seller-outer">

                                    	<div class="seller-inner">

                                        	<img src="images/e0tt.jpg" />

                                        </div>

                                    </div>

                                </a>

                            </li>

                            <li>

                            	<a href="#">

                                	<div class="seller-outer">

                                    	<div class="seller-inner">

                                        	<img src="images/e0tt.jpg" />

                                        </div>

                                    </div>

                                </a>

                            </li>

                            <li>

                            	<a href="#">

                                	<div class="seller-outer">

                                    	<div class="seller-inner">

                                        	<img src="images/e0tt.jpg" />

                                        </div>

                                    </div>

                                </a>

                            </li>

                            <li>

                            	<a href="#">

                                	<div class="seller-outer">

                                    	<div class="seller-inner">

                                        	<img src="images/e0tt.jpg" />

                                        </div>

                                    </div>

                                </a>

                            </li>

                            <li>

                            	<a href="#">

                                	<div class="seller-outer">

                                    	<div class="seller-inner">

                                        	<img src="images/e0tt.jpg" />

                                        </div>

                                    </div>

                                </a>

                            </li>

                            <li>

                            	<a href="#">

                                	<div class="seller-outer count-box">

                                    	<div class="seller-inner">

                                        	<span class="count-number">33</span><?php if($this->lang->line('user_list_ites') != '') { echo stripslashes($this->lang->line('user_list_ites')); } else echo 'Items'; ?>

                                        </div>

                                    </div>

                                </a>

                            </li>

                        </ul>

                    </div>

                </div>      

                <div class="content-inner">

                	<div class="detail_main">

                    	<div class="col col7 W570">

                        	<div class="fav-msg">

                            	<div class="fav-left">

                                	<div class="fav-btn">

                                        <a href="#">

                                            <span class="fav-icon"></span>

                                            <span class="status-txt"><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?></span>

                                        </a>

                                    </div>

                                </div>

                                <div class="fav-right">

                                	<h2><?php if($this->lang->line('shop_like') != '') { echo stripslashes($this->lang->line('shop_like')); } else echo 'Like this item'; ?>?</h2><?php if($this->lang->line('shop_revisit') != '') { echo stripslashes($this->lang->line('shop_revisit')); } else echo 'Add it to your favorites to revisit it later'; ?>.         

                                </div>

                            </div>

                      <div class="image-slider">

                            	<div id="gallery" class="ad-gallery">

                                      <div class="ad-image-wrapper">

                                      </div>

                                      <div class="ad-controls">

                                      </div>

                                      <div class="ad-nav">

                                        <div class="ad-thumbs">

                                          <ul class="ad-thumb-list">

                               

                                            	<?php  $fileImage = @explode(',',$productVal[0]['image']);

						foreach($fileImage as $Imgs){ if($Imgs !=''){ ?>

            	<li><a href="<?php echo PRODUCTPATH.$Imgs; ?>" ><img src="<?php echo PRODUCTPATH.$Imgs; ?>" class="image13" /></a></li>

                <?php }} ?>

                                          </ul>

                                        </div>

                                      </div>

                                    </div>

                            </div>

                            <div class="tab-content">

                                  <div id="TabbedPanels1" class="TabbedPanels">

                                       

                                        <ul class="TabbedPanelsTabGroup">

                                          <li class="TabbedPanelsTab " tabindex="0">Item Details</li>

                                          <li class="TabbedPanelsTab " tabindex="0"><img src="images/star.png" />(30)</li>	

                                          <li class="TabbedPanelsTab " tabindex="0">Shipping & Policies</li>

                                        </ul>

                                        

                                        <div class="TabbedPanelsContentGroup">

                                          <div class="TabbedPanelsContent ">

                                                Sweet notebook inspired by the hit show Breaking Bad featuring a picture of Walter White AKA Heisenberg with the text 'RECIPES' printed beneath.<br />A5<br />18 stapled blank white pages (36 both sides)<br />Notebooks made in the UK have been hand-bound my Pop Culture Pencils using blank white cartridge paper and printed kraft paper cover. 

                                          </div>

                                          <div class="TabbedPanelsContent">

                                            	<div class="reviews">

                                                	<div class="review-row">

                                                    	<div class="col col2" style="text-align:center">

                                                        	<div>

                                                            	<a href="#"><img src="images/default_avat.png" height="45" width="45" /></a>

                                                                <p>Reviewed by<br /><a href="#">melanie bulhon</a></p>

                                                            </div>

                                                        </div>

                                                        <div class="col review-right">

                                                        	<div class="rating"><img src="images/star.png" /></div>

                                                        	<p class="feedback-info">Nov 15, 2013</p>

                                                            <p class="feedback-txt">Looks just like the picture! Adorable. I needed a bit of a rush shipment to have this on time to give as a wedding present and the store accommodated me. Thank you!</p>

                                                            <a href="#" class="review-img"><img src="images/il_75x75.225641373.jpg" /></a>

                                                            <a href="#" class="review-title">Flying Piggy When Pigs Fly Pig with Wings Wooden Pig Sign</a>

                                                        </div>

                                                    </div>

                                                    <div class="review-row">

                                                    	<div class="col col2" style="text-align:center">

                                                        	<div>

                                                            	<a href="#"><img src="images/default_avat.png" height="45" width="45" /></a>

                                                                <p>Reviewed by<br /><a href="#">melanie bulhon</a></p>

                                                            </div>

                                                        </div>

                                                        <div class="col review-right">

                                                        	<div class="rating"><img src="images/star.png" /></div>

                                                        	<p class="feedback-info">Nov 15, 2013</p>

                                                            <p class="feedback-txt">Looks just like the picture! Adorable. I needed a bit of a rush shipment to have this on time to give as a wedding present and the store accommodated me. Thank you!</p>

                                                            <a href="#" class="review-img"><img src="images/il_75x75.225641373.jpg" /></a>

                                                            <a href="#" class="review-title">Flying Piggy When Pigs Fly Pig with Wings Wooden Pig Sign</a>

                                                        </div>

                                                    </div>

                                                    <div class="review-row">

                                                    	<div class="col col2" style="text-align:center">

                                                        	<div>

                                                            	<a href="#"><img src="images/default_avat.png" height="45" width="45" /></a>

                                                                <p>Reviewed by<br /><a href="#">melanie bulhon</a></p>

                                                            </div>

                                                        </div>

                                                        <div class="col review-right">

                                                        	<div class="rating"><img src="images/star.png" /></div>

                                                        	<p class="feedback-info">Nov 15, 2013</p>

                                                            <p class="feedback-txt">Looks just like the picture! Adorable. I needed a bit of a rush shipment to have this on time to give as a wedding present and the store accommodated me. Thank you!</p>

                                                            <a href="#" class="review-img"><img src="images/il_75x75.225641373.jpg" /></a>

                                                            <a href="#" class="review-title">Flying Piggy When Pigs Fly Pig with Wings Wooden Pig Sign</a>

                                                        </div>

                                                    </div>

                                                    <div class="review-row">

                                                    	<div class="col col2" style="text-align:center">

                                                        	<div>

                                                            	<a href="#"><img src="images/default_avat.png" height="45" width="45" /></a>

                                                                <p>Reviewed by<br /><a href="#">melanie bulhon</a></p>

                                                            </div>

                                                        </div>

                                                        <div class="col review-right">

                                                        	<div class="rating"><img src="images/star.png" /></div>

                                                        	<p class="feedback-info">Nov 15, 2013</p>

                                                            <p class="feedback-txt">Looks just like the picture! Adorable. I needed a bit of a rush shipment to have this on time to give as a wedding present and the store accommodated me. Thank you!</p>

                                                            <a href="#" class="review-img"><img src="images/il_75x75.225641373.jpg" /></a>

                                                            <a href="#" class="review-title">Flying Piggy When Pigs Fly Pig with Wings Wooden Pig Sign</a>

                                                        </div>

                                                    </div>

                                                </div>

                                          </div> 

                                          <div class="TabbedPanelsContent">

                                            <h4>Payment Methods</h4>

                                            <div style="float:left; width:100%; margin-bottom:15px;">

                                            	<img src="images/paypal.png" /><?php echo $this->config->item('email_title'); ?> Giftccards

                                            </div>

                                             <h4>Ready to ship in 1 business day </h4>

                                             <table width="100%" cellpadding="0" cellspacing="0" border="0" class="tab-table">

                                             	<tr>

                                                	<td width="50%"><strong>Ship To</strong></td>

                                                    <td width="20%"><strong>Cost</strong></td>

                                                    <td width="25%"><strong>With Another Item</strong></td>

                                                </tr>

                                                <tr>

                                                	<td width="50%">United Kingdom</td>

                                                    <td width="20%"> $2.48 USD </td>

                                                    <td width="25%"> $0.83 USD </td>

                                                </tr>

                                                <tr>

                                                	<td width="50%">United Kingdom</td>

                                                    <td width="20%"> $2.48 USD </td>

                                                    <td width="25%"> $0.83 USD </td>

                                                </tr>

                                             </table>

                                          </div>

                                     <script type="text/javascript">

                                        <!--

                                        var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");

                                        //-->

                                        </script>

                                        

                                        </div>

                                        

                                       <div class="clear"></div>

                                       <!--end of tab panels-->

                                      </div>

                            </div>

                        </div>

                        <div class="detail_right">

                        	<div class="detail_right_inner">

                            	<h1><?php echo '<pre>'; print_r($productVal);  ?></h1>

                                <div class="price_left">

                                	<span> $10.75 <a href="#"> USD </a></span>

                                </div>

                                <div style="float:right; margin:10px 0"><button class="web-btn">Ask a Question</button></div>

                                <div class="price_left">

                                	<label style="float:left; width:100%">Quantity</label>

                                    <select>

                                    	<option>1</option>

                                        <option>2</option>

                                        <option>3</option>

                                    </select>

                                </div>

                                <ul class="properties">

                                	<h3>Overview</h3>

                                	<li>Handmade item</li>

                                    <li>Material: paper</li>

                                    <li>Feedback: <a href="#">30 reviews</a></li>

                                    <li>Ships worldwide from Glasgow, United Kingdom</li>

                                </ul>

                                <div class="pay-method">

                                	<span class="gift-icon"></span>

                                	<label>This shop accepts <?php echo $this->config->item('email_title'); ?> Gift Cards</label>

                                </div>

                            </div>

                            <button class="btn-transaction">Add to Cart</button>

                        </div>

                        <div class="detail_right" style="margin:25px 0 10px 20px; background:#f2efe8">

                        	<div class="detail_right_inner">

                            	<div class="fav-btn" style="margin:0">

                                        <a href="#">

                                            <span class="fav-icon"></span>

                                            <span class="status-txt">Favorite</span>

                                        </a>

                                    </div>

                                    <img src="images/fb_count.png" style="float:left" />

                                    <div class="fav-btn" style="margin:0">

                                        <a href="#">

                                            <span class="eq-icon"></span>

                                            <span class="status-txt">Add to</span>

                                            <span class="down-icon"></span>

                                        </a>

                                    </div>

                            </div>

                            <img src="images/plugin.png" style="float:left; margin:10px 0 0" />

                        </div>

                        <div class="detail_right">

                        	<div class="detail_right_inner">

                            	<div class="shop-info">

                                	<div class="shop-img">

                                    	<a href="#"><img src="images/iusa.jpg" /></a>

                                    </div>

                                    <div class="shop-name">

                                    <a href="#">SlippinSouthern</a>

                                    </div>

                                    <span class="ship-label"><span>in</span> United States</span>

                                </div>

                                <ul class="product_listing1">

                                	<li>

                            

                            	<div class="product_img"><a href="#">

                                

                                	<div class="product_hide">

                                    

                                    	<div class="product_fav">

                                        

                                        	<input type="submit" value="" class="hoverfav_icon" />

                                            

                                            <div class="hoverdrop_icon">

                                            

                                            <a href="javascript:hoverView('1');"> </a>

                                            

                                            

                                            	<div class="hover_lists" id="hoverlist1">

                                                

                                                	<h2>Your Lists</h2>

                                                    

                                                    <div class="lists_check">

                                                    

                                                    	<input type="checkbox" value="" class="check_box" />

                                                        

                                                        <label>John</label>

                                                    

                                                    </div>

                                                    

                                                    <div class="new_list">

                                                    

                                                    	<input type="text" placeholder="New list" class="list_scroll" />

                                                    

                                                    

                                                    </div>

                                                

                                                </div>

                                            

                                            

                                            

                                            </div>

                                        	

                                        </div>

                                    

                                    </div>

                                    

                                <img src="images/product-1.jpg" alt="Product-1" title="Product-1" /></a></div>

                                

                                <div class="product_title"><a href="#">O Tannenbaum - Vintage Christmas Tree Fine Art Photography Print - Hol...</a></div>

                                

                                

                            

                            	<div class="product_price left">

                                

                                	<span class="currency_value">$14.00</span>

                                    

                                    <span class="currency_code">USD</span>

                                

                                </div>

                            

                            </li>

                            

                            		<li>

                            

                            	<div class="product_img"><a href="#"><img src="images/product-2.jpg" alt="Product-2" title="Product-2" /></a></div>

                                

                                <div class="product_title"><a href="#">Vintage brass deer doe fawn</a></div>

                                

                            

                            	<div class="product_price left">

                                

                                	<span class="currency_value">$30.00</span>

                                    

                                    <span class="currency_code">USD</span>

                                

                                </div>

                            

                            </li>

                                    

                                    <li>

                                    

                                        <div class="product_img"><a href="#"><img src="images/product-3.jpg" alt="Product-3" title="Product-3" /></a></div>

                                        

                                        <div class="product_title"><a href="#">Cowl neck blouse</a></div>

                                        

                                    

                                        <div class="product_price left">

                                        

                                            <span class="currency_value">$140.00</span>

                                            

                                            <span class="currency_code">USD</span>

                                        

                                        </div>

                                    

                                    </li>

                                    

                                    <li>

                                    

                                        <div class="product_img"><a href="#"><img src="images/product-4.jpg" alt="Product-4" title="Product-4" /></a></div>

                                        

                                        <div class="product_title"><a href="#">Leather Bag, Women's Purse, Tribal Clutch</a></div>

                                        

                                    

                                        <div class="product_price left">

                                        

                                            <span class="currency_value">$139.00</span>

                                            

                                            <span class="currency_code">USD</span>

                                        

                                        </div>

                                    

                                    </li>

                                    

                                    <li>

                                    

                                        <div class="product_img"><a href="#"><img src="images/product-5.jpg" alt="Product-5" title="Product-5" /></a></div>

                                        

                                        <div class="product_title"><a href="#">O Tannenbaum - Vintage Christmas Tree Fine Art Photography Print - Hol...</a></div>

                                        

                                    

                                        <div class="product_price left">

                                        

                                            <span class="currency_value">$14.00</span>

                                            

                                            <span class="currency_code">USD</span>

                                        

                                        </div>

                                    

                                    </li>

                                    

                                    <li>

                                    

                                        <div class="product_img"><a href="#"><img src="images/product-6.jpg" alt="Product-6" title="Product-6" /></a></div>

                                        

                                        <div class="product_title"><a href="#">O Tannenbaum - Vintage Christmas Tree Fine Art Photography Print - Hol...</a></div>

                                        

                                    

                                        <div class="product_price left">

                                        

                                            <span class="currency_value">$14.00</span>

                                            

                                            <span class="currency_code">USD</span>

                                        

                                        </div>

                                    

                                    </li>

                            

		                           

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>      

            </div>

        

        

        </div>

    

    </section>



<!-- section_end -->





<!-- footer_start -->



<?php $this->load->view('site/templates/footer'); ?>

	

<!-- footer_end -->





