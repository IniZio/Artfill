<?php $this->load->view('site/templates/header.php');?>
<script type="text/javascript" src="js/SpryTabbedPanels.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<link rel="stylesheet" type="text/css" href="css/default/elastislide.css" />
<link rel="stylesheet" type="text/css" href="css/default/style.css" />
<script>
$(document).ready(function(){

  $(".currency-effect").click(function(){

    $(".dropdown-box").toggle();

  });

});

</script>
<script type="text/javascript">

$(document).ready(function() {

var classHighlight = 'selected';

var $thumbs = $('.test').click(function(e) {

    e.preventDefault();

    $thumbs.removeClass(classHighlight);

    $(this).addClass(classHighlight);

});

});

</script>



<style type="text/css">

.highlight {

    background-color: cyan;

    font-weight: bold;

}

</style>


        

        

        	<noscript>

			<style>

				.es-carousel ul{

					display:block;

				}

			</style>

		</noscript>

        

        

        


<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
        
        



<!-- section_start -->


			<div class="add_steps shop-menu-list">

			<div class="main">
			
				 <ul>

					<li tabindex="0" id="friend"><a class="tab_text"href="<?php echo base_url();?>gift-cards"> <?php if($this->lang->line('gift_emailfrinend') != '') { echo stripslashes($this->lang->line('gift_emailfrinend')); } else echo "Email to a friend"; ?> </a></li>

					<li tabindex="0" id="print"><a class="tab_text" href="<?php echo base_url();?>gift-cards/print-at-home"> <?php if($this->lang->line('gift_printathome') != '') { echo stripslashes($this->lang->line('gift_printathome')); } else echo "Print at home"; ?> </a></li>

				</ul>
		  
			</div>
			
			</div>

<div id="profile_div">
<section class="container">

  <div class="main">
  
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="view-profile/<?php echo $this->session->userdata['shopsy_session_user_name'];?>" class="a_links"><?php echo $this->session->userdata['shopsy_session_user_name'];?></a></li>
		    <span>&rsaquo;</span>
           <li><?php if($this->lang->line('giftcard_cards') != '') { echo stripslashes($this->lang->line('giftcard_cards')); } else echo "Gift cards"; ?></li>
        </ul>
        </ul>
		

    <div class="giftcard-shop community_right">
	
		
	
		<div class="col-lg-12 giftcard-shop-main">
		
			<div class="col-lg-6 giftcard-shop-left">
			
			
			
						<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	

							<div class="rg-image-wrapper">

								{{if itemsCount > 1}}

									

								{{/if}}

								<div class="rg-image"></div>

								<div class="rg-loading"></div>

								<div class="rg-caption-wrapper">

									<div class="rg-caption" style="display:none;">

										<p></p>

									</div>

								</div>

							</div>

						</script>
			
				                    <div id="rg-gallery" class="rg-gallery">

                        <div class="rg-thumbs">

                            <!-- Elastislide Carousel Thumbnail Viewer -->

                            <div class="es-carousel-wrapper">

                                <div class="es-nav">

                                    <span class="es-nav-prev"><?php if($this->lang->line('gift_previous') != '') { echo stripslashes($this->lang->line('gift_previous')); } else echo "Previous"; ?></span>

                                    <span class="es-nav-next"><?php if($this->lang->line('gift_next') != '') { echo stripslashes($this->lang->line('gift_next')); } else echo "Next"; ?></span>

                                </div>

                                <div class="es-carousel">

                                <?php if($giftCard->image!=""){ ?>  

                                    <ul>

                                       <?php  $giftImage=@explode(',',rtrim($giftcardDetails[0]->image,','));                                     

                                        foreach($giftImage as $img){

                                        ?>

                                        <?php if($giftCard->image==$img){ ?> 

                                        <li data-img="<?php echo $img; ?>" <?php if($giftCard->image==$img){echo 'class="selected"';} ?>>

                                        <a href="#">

                                        <img src="images/giftcards/thumb/<?php echo $giftCard->image; ?>" data-large="images/giftcards/album/<?php echo $giftCard->image; ?>" alt="<?php echo $giftCard->image; ?>"  />

                                        </a>

                                        </li>                              

                                        <?php } } foreach($giftImage as $img){ if($giftCard->image!=$img){?>

                                        <li data-img="<?php echo $img; ?>" <?php if($giftCard->image==$img){echo 'class="selected"';} ?>>

                                        <a href="#">

                                        <img src="images/giftcards/thumb/<?php echo $img; ?>" data-large="images/giftcards/album/<?php echo $img; ?>" alt="<?php echo $img; ?>"  />

                                        </a>

                                        </li>

                                        <?php }} ?>

                                    </ul>

                                <?php }else{ ?>

                                	<ul>

                                       <?php  $giftImage=@explode(',',rtrim($giftcardDetails[0]->image,','));                                     

                                        foreach($giftImage as $img){

                                        ?>

                                                                              

                                        <li data-img="<?php echo $img; ?>" <?php if($giftCard->image==$img){echo 'class="selected"';} ?>>

                                        <a href="#">

                                        <img src="images/giftcards/thumb/<?php echo $img; ?>" data-large="images/giftcards/album/<?php echo $img; ?>" alt="<?php echo $img; ?>"  />

                                        </a>

                                        </li>

                                        <?php } ?>

                                    </ul>

                                <?php } ?>

                                </div>

                            </div>

                            <!-- End Elastislide Carousel Thumbnail Viewer -->

                        </div><!-- rg-thumbs -->

                    </div><!-- rg-gallery -->
				
			
			</div>
			
			
			<div class="col-lg-6 giftcard-shop-right">
			<?php echo form_open_multipart('site/giftcard/insertEditGiftcard',$attributes); ?>
				
		
				                  <div class="addresbar">

                    <div class="first_name">

                      <label class="to"> <?php if($this->lang->line('user_to') != '') { echo stripslashes($this->lang->line('user_to')); } else echo "To"; ?> </label>

                      <input type="text" value="<?php echo $giftCard->recipient_name; ?>" name="recipient_name" id="recipient_name1" placeholder="<?php if($this->lang->line('gc_name') != '') { echo stripslashes($this->lang->line('gc_name')); } else echo "Recipient's name"; ?>">

                      <span class="error recipient_name1Err" id="recipient_name1Err"></span>

                    </div>

                    <div class="last_name">

                      <label class="from"> <?php if($this->lang->line('user_from') != '') { echo stripslashes($this->lang->line('user_from')); } else echo "From"; ?> </label>

                      <input type="text"  value="<?php if($giftCard->sender_name==''){echo $this->session->userdata('shopsy_session_full_name');}else{echo $giftCard->sender_name;} ?>" name="sender_name" id="sender_name1" placeholder="<?php if($this->lang->line('gc_yourname') != '') { echo stripslashes($this->lang->line('gc_yourname')); } else echo "Your name"; ?>">

                      <span class="error" id="sender_name1Err"></span>

                    </div>

                    <div class="text__area">

                      <label> <?php if($this->lang->line('gift_addnote') != '') { echo stripslashes($this->lang->line('gift_addnote')); } else echo "Add a note (optional)"; ?><span style="float:right" id="maxtext_notify1">500</span> </label>

                      <textarea rows="6" placeholder="<?php if($this->lang->line('gc_personalnote') != '') { echo stripslashes($this->lang->line('gc_personalnote')); } else echo "Add a personal note or suggest some unique items"; ?>!" name="description" id="description1" maxlength="500"><?php echo $giftCard->description; ?></textarea>

                    </div>

                  </div>
				  
				  
				  
				                  <div class="currency_conv">

                  

                  

                  <div class="currency_head"> <span class="amount"><?php if($this->lang->line('gift_anamount') != '') { echo stripslashes($this->lang->line('gift_anamount')); } else echo "Choose an amount"; ?></span>

               <?php      /* <p class="currency-effect" id="cur-close" href="javascript:void(0);"><?php if($this->lang->line('gift_anothercurrency') != '') { echo stripslashes($this->lang->line('gift_anothercurrency')); } else echo "Looking for another currency?"; ?></p> */ ?>

                    <div class="dropdown-box"> 

                    	<span class="arrow9"></span>

                      	<ul>

                            <li class="selected">

                            <?php foreach($currencyList->result() as $cList){?>

                            <li  class=" <?php if($cList->currency_code == $currencyType){echo 'selected';}?>" id="<?php echo $cList->currency_code.'-'.$cList->currency_symbol.'-'.$cList->currency_value;?>" onclick="return changeCurrency(this);">

                              <label title="<?php echo $cList->currency_code;?>" > 

                              <span ><?php echo $cList->currency_symbol;?></span> 

                              <span ><?php echo $cList->currency_code;?></span>

                               </label> 

                            </li>

                            <?php }?>

                      	</ul>

                    </div>

                  </div>

                  

                  <!--<div class="currency_address">

                    <p>A US billing address is required to purchase a gift card in USD.<a href="#"> Learn more.</a></p>

                  </div>-->

                  <ul class="curency_button">

                  	<?php  $giftPrice=@explode(',',$giftcardDetails[0]->amounts);                                     

					foreach($giftPrice as $Price){

					?>

                    <li class="test <?php if($giftCard->price_value==$Price){ echo 'selected';}?>">

                      <label id="<?php echo $Price;?>" class="pah_priceList">

                          <span class="dolar-symbol">$</span> 

                          <span class="dolar-value" data-orgprice="<?php echo $Price;?>"><?php echo $Price;?></span> 

                          <span class="dolar-code">USD</span>

                      </label>

                    </li>     

                    <?php } ?>     

                  </ul>

                  <input type="hidden" name="price_value" id="price_value1" value="<?php echo $giftCard->price_value; ?>" /> 

                  <span class="error priceErr" id="priceErr1"></span>

                  <div class="gn_bg">

                     <button  class="cart_button" type="submit" <?php if ($loginCheck==''){echo 'require_login="true"';}?> onclick="return add_gift_card1();"> <span class="text-cart"><?php if($this->lang->line('shop_addtocart') != '') { echo stripslashes($this->lang->line('shop_addtocart')); } else echo "Add to Cart"; ?></span> <span class="spinner-cart"></span> </button>

                  </div>

          

                </div>
				
				  

				
				
			
			</div>
		
		
		</div>
		
		<div class="col-lg-12 giftcard-shop-main">
		
			        <div class="foot_text"> <span><?php if($this->lang->line('gift_giftcard') != '') { echo stripslashes($this->lang->line('gift_giftcard')); } else echo "View our Gift Card"; ?> <a href="pages/terms-conditions"><?php if($this->lang->line('user_touse') != '') { echo stripslashes($this->lang->line('user_touse')); } else echo "Terms of Use"; ?>.</a> </span>

                    <label><?php if($this->lang->line('gift_interestedgift') != '') { echo stripslashes($this->lang->line('gift_interestedgift')); } else echo "Interested in making a large gift card purchase for corporate or bulk gifting? Please contact"; ?><a href="mailto:<?php echo $this->config->item('site_contact_mail'); ?>"> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('gift_support') != '') { echo stripslashes($this->lang->line('gift_support')); } else echo "Support"; ?>. </a></label>

                  </div>
				  
	    </div>

      <div class="tab-content">

        <div id="TabbedPanels1" class="TabbedPanels">

          <!--<ul class="TabbedPanelsTabGroup newtb">

            <li class="TabbedPanelsTab " tabindex="0" id="friend"><a class="tab_text" href="javascript:void(0);"> <?php if($this->lang->line('gift_emailfrinend') != '') { echo stripslashes($this->lang->line('gift_emailfrinend')); } else echo "Email to a friend"; ?> </a></li>

            <li class="TabbedPanelsTab " tabindex="0" id="print"><a class="tab_text"  href="javascript:void(0);"> <?php if($this->lang->line('gift_printathome') != '') { echo stripslashes($this->lang->line('gift_printathome')); } else echo "Print at home"; ?> </a></li>

          </ul>-->



   

            	<?php 

				#$attributes = array('class' => 'form_container left_label', 'id' => 'giftcard_form', 'method' => 'post' ,  'enctype' => 'multipart/form-data');

				

				?>

                <div class="content">



                </div>

                <input type="hidden" name="image" id="image" value="<?php echo $giftCard->image; ?>" />



              </form>



            

            



            	<?php 

				echo form_open_multipart('site/giftcard/insertEditGiftcard',$attributes) 

				?>

                <input type="hidden" name="sender_mail" id="sender_mail1" value="<?php if($giftCard->sender_mail==''){echo $this->session->userdata('shopsy_session_user_email');}else{echo $giftCard->sender_mail;} ?>" />

                <input type="hidden" name="id" id="id" value="<?php echo $giftCard->id; ?>" />

                <input type="hidden" name="image" id="image" value="" />

                <input type="hidden" name="recipient_mail" id="recipient_mail" value="" />


              </form>



          <!--end of tab panels--> 



      </div>

    </div>

  </div>

</section>
</div>
<!-- section_end -->





<script>



function changeCurrency(val){

var commonVal=val.id;



$('.selected').each(function() {

$(this).removeClass('selected');

});



$('#'+commonVal).addClass('selected');





var cur_arr = commonVal.split('-');

var currencyCode=cur_arr[0];

var currencySymbol=cur_arr[1];

$('.dolar-symbol').html(currencySymbol);

$('.dolar-code').html(currencyCode);



$('.dolar-value').each(function() {

	var x=$(this).data("orgprice");

    $(this).html(x*cur_arr[2]);

});





$('#cur-close').trigger('click');







}







</script>





            

<script type="text/ecmascript">

<?php if($giftCard->image=='' && $giftCard->id!=''){?>

	$('#print').trigger('click');

<?php } ?>

</script>            

<?php $this->load->view('site/templates/footer'); ?>

