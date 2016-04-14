<?php 

$this->load->view('site/templates/shop_header'); 

?>

<?php 

#echo "<pre>"; print_r($added_item_details); echo "<pre>"; print_r($variations_one);echo "<pre>";print_r($variations_two);

#echo "<pre>"; print_r($variations_one_values);echo "<pre>";print_r($variations_two_values);

?>
<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>


<script type="text/javascript" src="js/site/add_shop_listitems.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="css/default/site/jquery.galleryview-3.0-dev.css"/>

	<link rel="stylesheet" href="css/default/demo.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/default/flexslider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/default/lightbox.css">
	  <script defer src="js/jquery.flexslider.js"></script>
<link rel="stylesheet" type="text/css" href="css/default/jquery.ad-gallery.css">
<script type="text/javascript" src="js/jquery.ad-gallery.js"></script>

<script type="text/javascript" src="js/site/jquery.countdown.js"></script>

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

  

function closeWin() {

    window.close();

}

  

  </script>

  

  <script type="text/javascript" src="js/lightbox.js"></script>

<div class="clear"></div>
<section class="container">

    	<div class="main">

        	<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
		   <span>&rsaquo;</span>
		   <li><?php if($this->lang->line('list_preview') != '') { echo stripslashes($this->lang->line('list_preview')); } else echo 'List item preview'; ?></li>
        </ul>

            

         <?php if($this->uri->segment(1)!='admin-preview'){ ?> 

        <div id="seller-content" class="content-wrap-inner-blank col12 clear">

            <div id="user2" class="type type3">

                <div class="model clear">

                    <a href="javascript:void(0);"><img width="75" height="75" src="images/site/default_avatar_75px.png"></a>

                </div>

                <div class="company-head">

                    <div><a href="javascript:void(0);"><span><?php  echo stripslashes($selectedSeller_details[0]['seller_businessname']); ?></span></a></div>

                    <div id="favorite-button" class="favorite clear">

                        <div class="favorite">

                            <a class="favorite-button-container overlay-trigger" ><span class="icon"></span>

                            <span class="favorite-text"><?php if($this->lang->line('shop_favshop') != '') { echo stripslashes($this->lang->line('shop_favshop')); } else echo 'Favorite Shop'; ?></span>

                            </a>

                        </div>

                    </div>

                

                </div>

            </div>

        </div>   

        <?php } ?>

        <div class="innerwrap">

        <div id="preview-header" class="content-wrap-inner-blank clear">

        	<div class="preview-form">

                <div class="message-list">

                    <h2> <?php if($this->lang->line('shop_savelisting') != '') { echo stripslashes($this->lang->line('shop_savelisting')); } else echo 'Save your listing. It will be available to shoppers when you open your shop'; ?>. </h2>

                    <h3> <?php if($this->lang->line('shop_minute') != '') { echo stripslashes($this->lang->line('shop_minute')); } else echo 'Take a minute to make sure your item details are correct'; ?>. </h3>

                </div>

          

              <!--<form class="listing-preview">-->

              <?php if($this->uri->segment(1)=='admin-preview'){ ?>

              <a href="admin/product/display_product_list"  class="secondary-button"><?php if($this->lang->line('user_save') != '') { echo stripslashes($this->lang->line('user_save')); } else echo 'Save'; ?></a>

              <?php }else{ ?>

              <a href="shop/sell" class="secondary-button"><?php if($this->lang->line('shop_savecontinue') != '') { echo stripslashes($this->lang->line('shop_savecontinue')); } else echo 'Save & Continue'; ?></a>

              <?php } ?>

                  

                  <a href="edit-product/<?php echo $added_item_details['0']['seourl']; ?>" class="secondary-button"><?php if($this->lang->line('user_edit') != '') { echo stripslashes($this->lang->line('user_edit')); } else echo 'Edit'; ?></a>

                  <!--<button class="secondary-button" value="Save & Continue" type="submit">Save & Continue</button>

                  <button class="secondary-button" value="Edit" type="submit" onclick="edit-product/<?php echo $added_item_details['seourl']; ?>">Edit</button>-->

             <!-- </form>-->

          	</div>

          

          <form id="listing-image" class="listing-images">

          <div class="instructions"><div class="warning-message">

            <!--<p>

            Sorry, but the image is too small to crop. Click

            <strong>Edit</strong>

            and choose/upload a new photo.

            </p>-->

            </div></div>

            

            <div class="crop-image2">

                <div class="croped">

              

                    <div class="image-detail">

                    	<?php $imageArr=explode(',',$added_item_details['0']['image']); ?>

                        <img class="display-image" src="images/product/<?php echo $imageArr[0]; ?>"></div>

                        <div class="content-detail">

                            <div class="listing-title">

                                <div class="headline"><?php echo $added_item_details['0']['product_name']; ?>. </div>

                                <div class="new-user"><?php  echo stripslashes($selectedSeller_details[0]['seller_businessname']); ?></div>

                            </div>

                            <div class="listing-price">

                                <span class="dolar"><?php echo $currencySymbol;?></span>

                                <span class="dolar-value"><?php if($added_item_details['0']['price']!=0){ echo number_format($currencyValue*$added_item_details['0']['price'],2);}else { echo number_format($currencyValue*$variations_one_values[0]['pricing'],2); echo '+';} ?></span>

                                <span class="dolar-id"><?php echo $currencyType;?></span>

                            </div>

                        </div>

                    </div>

                    <!--<div class="btn-block">

                        <div class="action-button">

                            <button class="secondary-button photo-12" disabled="" nme="mode_adjust">Adjust Photo</button>

                        </div>

                    </div>-->

                </div>

            

          </form>

      </div>          

  	</div>                

        <div id="preview_page">

        	<div class="content-tab-page">

                	<div class="detail_main">
						<div class="col-md-7 col-xs-12">
                    	<div class="col col7 W570 width60">

                        	<div class="fav-msg">

                            	<div class="fav-left">

                                	<div class="fav-btn">

                                        <a href="javascript:void(0);">

                                            <span class="fav-icon"></span>

                                            <span class="status-txt"><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?></span>

                                        </a>

                                    </div>

                                </div>

                                <div class="fav-right">

                                	<h2><?php if($this->lang->line('shop_like') != '') { echo stripslashes($this->lang->line('shop_like')); } else echo 'Like this item'; ?>?</h2><?php if($this->lang->line('shop_revisit') != '') { echo stripslashes($this->lang->line('shop_revisit')); } else echo 'Add it to your favorites to revisit it later'; ?>.         

                                </div>

                            </div>

                            <?php /* <div id="gallery" class="flexslider">
								  <ul class="slides">
									<?php $imageArr=explode(',',$added_item_details[0]['image']); ?>
									<?php $imgCount=count($imageArr);
										for($i=0;$i<$imgCount;$i++){ ?>                
										<li data-thumb="images/product/list-image/<?php echo $imageArr[$i]; ?>"><a rel="example2" href="images/product/org-image/<?php echo $imageArr[$i]; ?>" data-lightbox="example-set">
												<img src="images/product/<?php echo $imageArr[$i]; ?>" class="image0">
											</a></li>   
										<?php } ?> 
								  </ul>
							</div> */ ?>
							<div id="gallery" class="flexslider">
								<ul class="slides">
								<?php 
									$imageArr=explode(',',$added_item_details[0]['image']);
									$imgCount=count($imageArr);
									for($i=0;$i<$imgCount;$i++){ 
								?>
									<li data-thumb="<?php echo PRODUCTPATHTHUMB.$imageArr[$i]; ?>">
										<a rel="example2" href="<?php echo 'images/product/org-image/'. $imageArr[$i];  ?>" data-lightbox="example-set">
											<img src="<?php echo PRODUCTPATH. $imageArr[$i]; ?>" class="image0">
										</a>
									</li>   
								<?php 
									}
								?> 
								</ul>
							</div>

                            	<div class="tab-content">

                                  	<div id="TabbedPanels1" class="TabbedPanels">

                                       

                                        <ul class="TabbedPanelsTabGroup tab-bottom">

                                          <li class="TabbedPanelsTab" id="show_description_preview" onclick="return show_description_preview();">
										  <?php if($this->lang->line('shop_itemdetails') != '') { echo stripslashes($this->lang->line('shop_itemdetails')); } else echo 'Item Details'; ?></li>

                                          <li class="TabbedPanelsTab" id="show_ship_policy_preview"  onclick="return show_ship_policy_preview();" style="background:rgb(236, 233, 233);">
										  <?php if($this->lang->line('shop_shippingpolicy') != '') { echo stripslashes($this->lang->line('shop_shippingpolicy')); } else echo 'Shipping & Policies'; ?></li>

                                        </ul>

                                        

                                        <div class="TabbedPanelsContentGroup">

                                          <div class="TabbedPanelsContent " id="dec_container" style=" width: 90%;">

                                                <?php echo $added_item_details['0']['description']; ?>

                                          </div>

                                          <div class="TabbedPanelsContent" id="ship_policy_container" style="display: none;  width: 90%;">

                                          	<div id="shipping-tab" >

                                            	<?php if($added_item_details['0']['ship_duration']!=''){ ?>

                                                <h4 class="ship-days"> <?php if($this->lang->line('shop_shipin') != '') { echo stripslashes($this->lang->line('shop_shipin')); } else echo 'Ready to ship in'; ?> <?php echo $added_item_details['0']['ship_duration']; ?></h4>

                                                <?php } ?>
												<div class="top-table">
                                                <table class="list-table shipping">

                                                    <thead class="tabbled">

                                                        <tr class="column-headers">

                                                            <th class="shipping-destination"><?php if($this->lang->line('shop_shipto') != '') { echo stripslashes($this->lang->line('shop_shipto')); } else echo 'Ship To'; ?></th>

                                                            <th class="shipping-first-price"><?php if($this->lang->line('shop_cost') != '') { echo stripslashes($this->lang->line('shop_cost')); } else echo 'Cost'; ?></th>

                                                            <th class="shipping-amount"><?php if($this->lang->line('shop_anotheritem') != '') { echo stripslashes($this->lang->line('shop_anotheritem')); } else echo 'With another item'; ?></th>

                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                        <?php foreach($shipping_details as $shippingVals){ ?>

                                                                <tr>

                                                                    <td class="shipping-area"><?php echo $shippingVals['ship_name']; ?></td>

                                                                    <td class="shipping-value">

                                                                        <span class="dolar-symbol"><?php echo $currencySymbol;?></span>

                                                                        <span class="dolar-value"><?php echo number_format($currencyValue*$shippingVals['ship_cost'],2); ?></span>

                                                                        <span class="dolar-code"><?php echo $currencyType;?></span>

                                                                    </td>

                                                                    <td class="shipping-value">

                                                                        <span class="dolar-symbol"><?php echo $currencySymbol;?></span>

                                                                        <span class="dolar-value"><?php echo number_format($currencyValue*$shippingVals['ship_other_cost'],2); ?></span>

                                                                        <span class="dolar-code"><?php echo $currencyType;?></span>

                                                                    </td>

                                                                </tr>

                                                         <?php } ?> 

                                                   </tbody>

                                               </table>

                                               </div>

                                               <table class="list-table shipping table-new">

                                                    <thead class="tabbled">

                                                        <tr class="column-headers">

                                                            <th class="shipping-destination"><?php if($this->lang->line('shopsec_policy') != '') { echo stripslashes($this->lang->line('shopsec_policy')); } else echo 'Policies'; ?></th>

                                                            <th class="shipping-amount"></th>

                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                    	<?php if($selectedSeller_details[0]['payment_policy']!="") { ?>

                                                            <tr class="column-headers">

                                                                <td class="shipping-destination"><?php if($this->lang->line('shopsec_payment') != '') { echo stripslashes($this->lang->line('shopsec_payment')); } else echo 'Payment'; ?></td>

                                                                <td class="shipping-amount"><?php echo $selectedSeller_details[0]['payment_policy']; ?></td>

                                                            </tr>

                                                        <?php } ?>

                                                        <?php if($selectedSeller_details[0]['shipping_policy']!="") { ?>

                                                            <tr class="column-headers">

                                                                <td class="shipping-destination"><?php if($this->lang->line('shopsec_shipping') != '') { echo stripslashes($this->lang->line('shopsec_shipping')); } else echo 'Shipping'; ?></td>

                                                                <td class="shipping-amount"><?php echo $selectedSeller_details[0]['shipping_policy']; ?></td>

                                                            </tr>

                                                        <?php } ?>

                                                        <?php if($selectedSeller_details[0]['refund_policy']!="") { ?>

                                                            <tr class="column-headers">

                                                                <td class="shipping-destination"><?php if($this->lang->line('shopsec_refunds') != '') { echo stripslashes($this->lang->line('shopsec_refunds')); } else echo 'Refunds and Exchanges'; ?></td>

                                                                <td class="shipping-amount"><?php echo $selectedSeller_details[0]['refund_policy']; ?></td>

                                                            </tr>

                                                        <?php } ?>

                                                        <?php if($selectedSeller_details[0]['additional_information']!="") { ?>

                                                            <tr class="column-headers">

                                                                <td class="shipping-destination"><?php if($this->lang->line('shop_additional') != '') { echo stripslashes($this->lang->line('shop_additional')); } else echo 'Additional Policies and FAQs'; ?></td>

                                                                <td class="shipping-amount"><?php echo $selectedSeller_details[0]['additional_information']; ?></td>

                                                            </tr>

                                                        <?php } ?>

                                                        <?php if($selectedSeller_details[0]['seller_information']!="") { ?>

                                                            <tr class="column-headers">

                                                                <td class="shipping-destination"><?php if($this->lang->line('shop_sellerinformation') != '') { echo stripslashes($this->lang->line('shop_sellerinformation')); } else echo 'Seller Information'; ?></td>

                                                                <td class="shipping-amount"><?php echo $selectedSeller_details[0]['seller_information']; ?></td>

                                                            </tr>

                                                        <?php } ?>

                                                   </tbody>

                                               </table>

                                               

                                               

                                               

                                               

                                          	</div>

                                          </div>                                          

                                     	<script type="text/javascript">

                                       

                                        </script>

                                        

                                        </div>

                                        

                                       <div class="clear"></div>

                                       <!--end of tab panels-->

                                    </div>

                            	</div>

                        </div>
						</div>
						<div class="col-md-5 col-xs-12">
                        <div class="detail_right">

                        	<div class="detail_right_inner">

                            	<h1><?php echo $added_item_details['0']['product_name']; ?></h1>

                                <div class="price_left">

																																
																																 <?php  
		if($this->config->item('deal_of_day')=='Yes')
		  { 
		  
		  
		  $starttime=$added_item_details[0]['deal_date']." ".$added_item_details[0]['deal_time_from'];
		  
		  
		
		  if($added_item_details[0]['action']=='DOD' && $added_item_details[0]['discount']!=0 && date('Y-m-d H:i',strtotime($starttime)) <=date('Y-m-d H:i')) {
		  ?>
		  
		  <?php  date('Y-m-d H:i');
		  
		  $style="style='text-decoration:line-through;'";
		  $endatedeal=$added_item_details[0]['deal_date_to']." ".$added_item_details[0]['deal_time_to'];
		  
		  
		  if($added_item_details[0]['price']!=0){ 
							$price_tot=$added_item_details[0]['price'];
						}else {
							$price_tot=$variations_one_values[0]['pricing'].'+';
						}
				 $orignalamount=$price_tot;	
		  
		  $offer=($added_item_details[0]['discount']/100)*$price_tot;
		  $enddeal=date('Y-m-d H:i:s',strtotime($endatedeal));
	     $price_tot=$price_tot-$offer;
		 
		
		  ?>
		  <div data-countdown="<?php echo $enddeal; ?>" >
		  </div>
		  <?php } 
		  else
		  {
		  $style='';
		  $offer=0;
		   if($added_item_details[0]['price']!=0){ 
							$price_tot=$added_item_details[0]['price'];
						}else {
							$price_tot=$variations_one_values[0]['pricing'].'+';
						}
						$orignalamount=$price_tot;	
		  }
		  
		  }
		  
		  ?>
                                		<span <?php echo $style;?>> <?php echo $currencySymbol;?><?php if($added_item_details['0']['price']!=0){ echo number_format($currencyValue*$orignalamount,2);}else { echo number_format($currencyValue*$orignalamount,2); echo '+';} ?> <a href="javascript:void(0);"> <?php echo $currencyType;?> </a></span>

									
									<?php  if($added_item_details[0]['action']=='DOD' && $added_item_details[0]['discount']!=0 && date('Y-m-d H:i',strtotime($starttime)) <=date('Y-m-d H:i')) {
		  ?>
									<span > <?php echo $currencySymbol;?><?php if($added_item_details['0']['price']!=0){ echo number_format($currencyValue*$price_tot,2);}else { echo number_format($currencyValue*$price_tot,2); echo '+';} ?> <a href="javascript:void(0);"> <?php echo $currencyType;?> </a></span>
 <?php }?>
                                </div>

                                <div class="ask-qust" style="float:right; margin:10px 0"><button class="web-btn"><?php if($this->lang->line('shop_askquestion') != '') { echo stripslashes($this->lang->line('shop_askquestion')); } else echo 'Ask a Question'; ?></button></div>

                                <div class="price_left">

                                	<label style="float:left; width:100%"><?php if($this->lang->line('shop_quantity') != '') { echo stripslashes($this->lang->line('shop_quantity')); } else echo 'Quantity'; ?></label>

                                    <select>

                                    <?php for($i=1;$i<=$added_item_details['0']['quantity'];$i++) { echo '<option>'.$i.'</option>'; } ?>

                                    </select>

                                </div>

                                <?php if($variations_one!=''){ ?>

                                <div class="price_left">

                                	<label style="float:left; width:100%"><?php echo $variations_one; ?></label>

                                    <select>

                                    <option value="" selected="selected"><?php if($this->lang->line('user_select') != '') { echo stripslashes($this->lang->line('user_select')); } else echo 'Select'; ?> <?php echo $variations_one; ?></option>

                                    <?php 

									for($i=0;$i<count($variations_one_values);$i++) 

									{ 	

										$val=$variations_one_values[$i]['attr_value'];

										if($variations_one_values[$i]['pricing']){

											$val=$variations_one_values[$i]['attr_value'].' [$'.$variations_one_values[$i]['pricing'].']';

										}

											if($variations_one_values[$i]['stock_status']==0){

												$stock='disabled="disabled"';

												$val.=' - out of stock';

											}

											else{

												$stock='';

											}

										

										echo '<option '.$stock.' >'.$val.'</option>'; 

									} 

									?>

                                    </select>

                                </div>

                                <?php } ?>

                                <?php if($variations_two!=''){ ?>

                                <div class="price_left">

                                	<label style="float:left; width:100%"><?php echo $variations_two; ?></label>

                                    <select>

                                    <option value="" selected="selected"><?php if($this->lang->line('user_select') != '') { echo stripslashes($this->lang->line('user_select')); } else echo 'Select'; ?> <?php echo $variations_two; ?></option>

                                    <?php 

									for($i=0;$i<count($variations_two_values);$i++) 

									{ 

										$val1=$variations_two_values[$i]['attr_value'];

										if($variations_two_values[$i]['pricing']){											

											$val1=$variations_two_values[$i]['attr_value'].' [$'.$variations_two_values[$i]['pricing'].']';

										}

											if($variations_two_values[$i]['stock_status']==0){

												$stock1='disabled="disabled"';

												$val1.=' - out of stock';

											}

											else{

												$stock1='';

											}

										

										echo '<option '.$stock1.'>'.$val1.'</option>'; } 

									?>

                                    </select>

                                </div>

                                <?php } ?>

                                <ul class="properties">

                                	<h3><?php if($this->lang->line('shop_overview') != '') { echo stripslashes($this->lang->line('shop_overview')); } else echo 'Overview'; ?></h3>

                                	<li>

										<?php 

                                            //if($added_item_details['0']['made_by']==1){ echo 'Handmade';}else

											//if($added_item_details['0']['made_by']==2){ echo 'Vintage';}else if($added_item_details['0']['made_by']==3){ echo 'Vintage Handmade';}

											if($added_item_details['0']['made_by']==1){ if($this->lang->line('shop_handmad') != '') { echo stripslashes($this->lang->line('shop_handmad')); } else echo 'Handmade';}else

                                            if($added_item_details['0']['made_by']==2){ if($this->lang->line('shop_vint') != '') { echo stripslashes($this->lang->line('shop_vint')); } else echo 'Vintage';}else if($added_item_details['0']['made_by']==3){ if($this->lang->line('shop_vintagehandmade') != '') { echo stripslashes($this->lang->line('shop_vintagehandmade')); } else echo 'Vintage Handmade';} 

                                        ?> 

                                        <?php if($this->lang->line('user_item_var') != '') { echo stripslashes($this->lang->line('user_item_var')); } else echo 'Item'; ?>

                                    </li>

                                    <?php if($added_item_details['0']['materials']!=''){ ?><li><?php if($this->lang->line('shop_materials') != '') { echo stripslashes($this->lang->line('shop_materials')); } else echo 'Materials'; ?>:<?php $material=explode(',',$added_item_details[0]['materials']); foreach($material as $materialList){ echo $materialList.', ';}?></li><?php } ?>

                                    <!--<li>Feedback: <a href="#">30 reviews</a></li>-->

                                    <li><?php if($this->lang->line('shop_ships') != '') { echo stripslashes($this->lang->line('shop_ships')); } else echo 'Ships'; ?> <?php if(strpos($added_item_details['0']['ship_details'],'Everywhere Else') != false){ echo 'worldwide';} ?> <?php if($this->lang->line('shop_from') != '') { echo stripslashes($this->lang->line('shop_from')); } else echo 'from'; ?> <?php echo $added_item_details['0']['ship_from']; ?></li>

                                </ul>

                                <!--<div class="pay-method">

                                	<span class="gift-icon"></span>

                                	<label>This shop accepts <?php echo $this->config->item('email_title'); ?> Gift Cards</label>

                                </div>-->

                            </div>

                            <button class="btn-transaction" disabled="disabled"><?php if($this->lang->line('shop_addtocart') != '') { echo stripslashes($this->lang->line('shop_addtocart')); } else echo 'Add to Cart'; ?></button>

                        </div>
						</div>
						
						<div class="col-md-5 col-xs-12">
                        <div class="detail_right" style="margin:25px 0 10px 20px; background:#f2efe8">

                        	<div class="detail_right_inner">

                            	<div class="fav-btn" style="margin:0">

                                        <a href="javascript:void(0);">

                                            <span class="fav-icon"></span>

                                            <span class="status-txt"><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?></span>

                                        </a>

                                    </div>

                                    <!--<img src="images/fb_count.png" style="float:left" />-->

                                    <div class="fav-btn" style="margin:0">

                                        <a href="javascript:void(0);">

                                            <span class="eq-icon"></span>

                                            <span class="status-txt"><?php if($this->lang->line('shop_addto') != '') { echo stripslashes($this->lang->line('shop_addto')); } else echo 'Add to'; ?></span>

                                            <span class="down-icon"></span>

                                        </a>

                                    </div>

                            </div>

                            <img src="images/plugin.png" style="float:left; margin:10px 0 0" />

                        </div>
						</div>
                        

                    </div>

                </div>

        </div>                

        </div>

        

        

        

        

        

        <div class="main detail-relate">

    <div class="related-item">

    	<?php if($added_item_details[0]['tag']!=''){ ?>

        <h2><?php if($this->lang->line('shop_relateditem') != '') { echo stripslashes($this->lang->line('shop_relateditem')); } else echo 'Related to this Item'; ?></h2>

        <ul class="relatedlist">

        	<?php $Related=explode(',',$added_item_details[0]['tag']) ?>

            <?php foreach($Related as $tag){?>

        	<li><a><?php echo $tag; ?></a></li> 

            <?php } ?>                                  

        </ul>

        <?php } ?>

        

    </div>

</div>

        

        

        <div  class="main"> 

          <?php 

			/******Load the footer category list for this shop preview page*********/

			$this->load->view('site/templates/footer_extra_content_category');

			

			?>      

                

         </div>   

        

        

    </section>		

<style>
	span.label{
	color:#000;
	}
	.quant-input .arrows {
		height: 100%;
		position: absolute;
		right: -100;
		top: -4;
		z-index: 2;
	}
	.arrows .arrow {
		box-sizing: border-box;
		cursor: pointer;
		display: block;
		margin-left:10px;
		text-align: center;
		width: 40px;
	}
	#zoom{
		position: fixed !important;
		z-index: 9999 !important;
		 top: 50px !important;
	}
	</style>

	<script type="text/javascript">

    $(document).ready(function(){
 
        $('[data-toggle="tooltip"]').tooltip(); 

$('[data-countdown]').each(function() {
   var $this = $(this), finalDate = $(this).data('countdown');
   $this.countdown(finalDate, function(event) {
     $this.html(event.strftime('%D days %H:%M:%S'));
   });
 });		

    });

    </script>

    <script type="text/javascript">

    $(document).ready(function(){

        $('[data-toggle="tooltip"]').tooltip();   

    });

    </script>
	
	<script type="text/javascript">
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });

 </script>

<?php 

$this->load->view('site/templates/footer');

?>