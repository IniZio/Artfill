<?php $this->load->view('site/templates/header'); $segmentArr=$this->uri->segment_array();   ?>


 
<!--<script type="text/javascript" src="a_data/jquery.js"></script>-->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/default/site/themes-smoothness-jquery-ui.css" />
<!--<script type="text/javascript" src="a_data/jquery-ui.js"></script>-->
<script type="text/javascript" src="js/currency/jquery.formatCurrency-1.4.0.js"></script>
<link rel="stylesheet" type="text/css" href="a_data/jquery-ui.css">  
<script type="text/javascript" src="js/front/freewall.js"></script>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Search-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;?>footer.css" rel="stylesheet">
<?php } ?>
<link href='//fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/default/site/base.css" />
<link rel="stylesheet" href="css/default/site/style-menu.css" />





<style>
.color-filter li{ 
	display:inline-block;
	width:25px;
	height:25px;
	border-radius:4px;
} 

.color-filter li a {
  display: block;
  font-weight: bold;
  margin: 0 8px;
  padding: 5px;
  border-radius: 4px;
  width: 25px;
  height: 25px;
}  

.list-inline-item span img {
	width: inherit;
  	height: inherit;
 } 
</style>
<?php $c_url=current_url();  
								 if($this->uri->segment(1) != ''){
								$lnk=$this->uri->segment(1);
								}
								if($this->uri->segment(2) != ''){
								$lnk.='/'.$this->uri->segment(2);
								} 
								if($this->uri->segment(3) != ''){
								$lnk.='/'.$this->uri->segment(3);
								} 
								if($this->uri->segment(4) != ''){
								$lnk2=$lnk.'/'.$this->uri->segment(4);
								} else { $lnk2=$lnk; } 
								
								if($this->input->get('item') != ''){
								$s_key='item='.$this->input->get('item');;
								}else { $s_key ='';}
								
								if($this->input->get('gift_cards') == 'on'){
								    $s_gift='&gift_cards='.$gift;
								}else { $s_gift ='';}
								
								if($this->input->get('min_price') != ''){
								$minVal=preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->get('min_price'));
									 $min_price='&min_price='.preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->get('min_price'));
								} else { $minVal=''; $min_price=''; }
								
								
								if($this->input->get('max_price') != ''){
								$maxVal=preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->get('max_price'));
									 $max_price='&max_price='.preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->get('max_price'));
									// echo $max_price;die;
								} else { $maxVal=''; $max_price=''; }  
		                     
							 
								if($this->input->get('location') != ''){
								    $location='&location='.$this->input->get('location');
									$locVal=$this->input->get('location');
								}else { $location =''; $locVal='';}  
							   
							   
							   if($this->input->get('shipto') != ''){
								    $shipto='&shipto='.$this->input->get('shipto');
									$shipVal=$this->input->get('shipto');
								}else { $shipto =''; $shipVal='';} 
							   
							   if($this->input->get('order') != ''){
							   $order='&order='.$this->input->get('order');
							   $orderVal=$this->input->get('order');
							   } else {$order=''; $orderVal='';}

							   if($this->input->get('color') != ''){
							   	$color='&color='.$this->input->get('color');
                                                                $color_temp = $color;
							   	$colorVal=$this->input->get('color');
							   } else {$color=''; $colorVal='';}
                                                           
							   if($this->input->get('product_type') != ''){
							   	$product_type='&product_type='.$this->input->get('product_type');
							   	$product_typeVal=$this->input->get('product_type');
							   } else {$product_type=''; $product_typeVal='';}                                                           
							  
							   ?>



<script>
var $j = jQuery.noConflict();
$j(window).load(function(){

 $j(function () {
var minPrice =  <?php echo $min_base_price;?>,
         maxPrice = <?php echo $max_base_price;?>,
         $jfilter_lists = $j("#filters ul"),
         $jfilter_checkboxes = $j("#filters :checkbox"),
         $jitems = $j("#container li.element");
//$filter_checkboxes.click(filterSystem);

$j('#slider-container').slider({

 range: true,
 min: minPrice,
 max: maxPrice,
 <?php if($minVal != '' && $maxVal !=''){?>
 values: [<?php echo $minVal;?>, <?php echo $maxVal;?>],
 <?php } else {?>
  values: [minPrice, maxPrice],
 <?php } ?>
 slide: function (event, ui) {  
//alert(minVal);
 //$("#amount").val("<?php echo $currencySymbol ?>" + ui.values[0] + " - <?php echo $currencySymbol ?>" + ui.values[1]);
  $j("#minPriceVal").val(ui.values[0]);
  $j("#maxPriceVal").val(ui.values[1]);
  $j("#minPriceDisp").html(ui.values[0]);
  $j("#maxPriceDisp").html(ui.values[1]);
 minPrice = ui.values[0];
 maxPrice = ui.values[1];
 $j('#slider-container').mouseout(function(){
  $j('#priceFilterForm').submit();
  });
// filterSystem();

 }	 
 }); 


// $("#amount").val("<?php echo $currencySymbol ?>"+minPrice + " - <?php echo $currencySymbol ?>"+ maxPrice);
 $j("#minPriceVal").val(minPrice);
  $j("#maxPriceVal").val(maxPrice);
  $("#minPriceDisp").html(ui.values[0]);
  $("#maxPriceDisp").html(ui.values[1]);
 });
});

</script>

<?php // echo("<pre>"); print_r($product_list->result());die;
      
      if(count($product_list) > 0) { ?>
<div id="product_search_div">
<section class="container">
    
  		<div id="content">
        	<div class="purchase_review product-search-main">
            	<div class="content-wrap-inner1">
                	
					
                        <div id="secondary" class="standardized_filters">
                        	<div id="search-filters" class="secondary-liner">
                            	<ul class="filter marketplaces">
                                	<li class="input-group side-selected side-1 <?php if(in_array('all',$segmentArr)) { echo 'selected';}?>">
                                    <a href="<?php if(in_array('all',$segmentArr)) { echo 'javascript: void(0);';} else {?>search/all<?php echo '?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$color;  }?>"><?php if($this->lang->line('shop_allitems') != '') { echo stripslashes($this->lang->line('shop_allitems')); } else echo "All Items"; ?></a></li>
                                    <li class="input-group <?php if(in_array('handmade',$segmentArr)) { echo 'selected';}?>">
                                    <a href="<?php if(in_array('handmade',$segmentArr)) { echo 'javascript: void(0);';} else {?>search/handmade<?php echo '?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$color; }?>"><?php if($this->lang->line('shop_handmad') != '') { echo stripslashes($this->lang->line('shop_handmad')); } else echo "Handmade"; ?></a></li>
                                    <li class="input-group <?php if(in_array('vintage',$segmentArr)) { echo 'selected';}?>">
                                    <a href="<?php if(in_array('vintage',$segmentArr)) { echo 'javascript: void(0);';} else {?>search/vintage<?php echo '?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$color; }?>"><?php if($this->lang->line('shop_vint') != '') { echo stripslashes($this->lang->line('shop_vint')); } else echo "Vintage"; ?></a></li>
                                    <li class="input-group <?php if(in_array('supplies',$segmentArr)) { echo 'selected';}?>">
                                    <a href="<?php if(in_array('supplies',$segmentArr)) { echo 'javascript: void(0);';} else {?>search/supplies<?php echo '?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$color; }?>"><?php if($this->lang->line('shop_supplies') != '') { echo stripslashes($this->lang->line('shop_supplies')); } else echo "Craft Supplies"; ?></a></li>
                                </ul>
                                <ul class="filter categories">
                                
                                <?php if($cats1 == 'No') {
								  foreach ($this->data['mainCategories']->result() as $row){
							if ($row->cat_name != ''){ //$commentData = $this->category_model->get_all_counts($row->id,''); //if($commentData[0]['disp']>0){
                      	?>
                        <li <?php $selStatus1=explode('-',$this->uri->segment(count($segmentArr))); if($row->id == $selStatus1[0]) { echo 'class="selected"';} ?>>
                        
                        <a href="<?php if($row->id == $selStatus1[0]){ echo 'javascript:void(0);';} else { echo $lnk.'/'; echo $row->id;?>-<?php echo $row->seourl;?><?php echo '?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$color; }?>"><?php echo $row->cat_name;?>
                        </a>
                        
                        
                      </li>
                      <?php 
                      	//}
						}
                      } }  else if($cats2 == 'No') {  ?>
                      
                    <li><a href="<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/';  echo '?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$color;?>"><?php if($this->lang->line('prod_allcate') != '') { echo stripslashes($this->lang->line('prod_allcate')); } else echo 'All Categories'; ?></a></li>        
                    <li class="<?php if($cat1->id.'-'.$cat1->seourl == $this->uri->segment(count($segmentArr))) { echo 'selected';} ?>">
                    <a href="<?php if($cat1->id.'-'.$cat1->seourl == $this->uri->segment(count($segmentArr))) { echo 'javascript:void(0);';} else {?>search/<?php echo $this->uri->segment(2).'/'; echo $cat1->id.'-'.$cat1->seourl; echo '?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$color; }?>"><?php echo $cat1->cat_name;?></a> </li>
                          
                      <ul style="padding: 1px 0 0 10px !important" class="filter categories">    
       
                                <?php 
								  foreach ($cats1->result() as $row){
							if ($row->cat_name != ''){ 
							//$commentData = $this->category_model->get_all_counts($row->id,''); if($commentData[0]['disp']>0){
                      	?>
                        <li <?php $selStatus=explode('-',$this->uri->segment(3)); if($row->id == $selStatus[0]) { echo 'class="selected"';} ?>>
                        <a href="<?php if($row->id == $selStatus[0]){ echo 'javascript:void(0);'; } else { echo $lnk.'/'; echo $row->id;?>-<?php echo $row->seourl;?><?php echo '?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$color; }?>"><?php echo $row->cat_name;?></a>
                      </li>
                      <?php 
                      	//}
						}
                      } }  else {  ?>
                              
                    <li><a href="<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/';  echo '?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$color;?>"><?php if($this->lang->line('prod_allcate') != '') { echo stripslashes($this->lang->line('prod_allcate')); } else echo 'All Categories'; ?></a> </li>        
                     <li class="<?php if($cat1->id.'-'.$cat1->seourl == $this->uri->segment(count($segmentArr))) { echo 'selected';} ?>">
                     <a href="<?php if($cat1->id.'-'.$cat1->seourl == $this->uri->segment(count($segmentArr))) { echo 'javascript:void(0);';} else {?>search/<?php echo $this->uri->segment(2).'/'; echo $cat1->id.'-'.$cat1->seourl; echo '?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$color; }?>"><?php echo $cat1->cat_name;?></a> </li>
                     
               <li class="<?php if($cat2->id.'-'.$cat2->seourl == $this->uri->segment(count($segmentArr))) { echo 'selected';} ?>" style="padding: 1px 0 0 12px !important"> 
               <a href="<?php if($cat2->id.'-'.$cat2->seourl == $this->uri->segment(count($segmentArr))) { echo 'javascript:void(0);';} else { echo $lnk.'/'; echo $cat2->id.'-'.$cat2->seourl; echo '?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$color;}?>"><?php echo $cat2->cat_name;?></a></li>
                          
                      <ul style="padding: 1px 0 0 22px !important" class="filter categories">    
                                
                                <?php 
								  foreach ($cats2->result() as $row){
							if ($row->cat_name != ''){ 
							//$commentData = $this->category_model->get_all_counts($row->id,''); if($commentData[0]['disp']>0){
                      	?>
                        <li <?php $selStatus=explode('-',$this->uri->segment(count($segmentArr))); if($row->id == $selStatus[0]) { echo 'class="selected"';} ?>>
                        <a href="<?php  if($row->id == $selStatus[0]){ echo 'javascript:void(0);';} else {  echo $lnk.'/';if($this->uri->segment(4) != ''){ echo $this->uri->segment(4).'/';} echo $row->id;?>-<?php echo $row->seourl;?><?php echo '?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$color;}?>"><?php echo $row->cat_name;?></a>
                      </li>
                      <?php 
                      	//}
						}
                      } }?>
                                
                                </ul>
                                </ul>   
                                </ul>
								
									<!--------- Price Filter with Slider starts --->
													
                                    <ul id="facet-price" class="filter first">
                                	<ul class="price-input">
                                    	<li class="changeable selected"><?php echo shopsy_lg('lg_price','Price');?></li>
										<li class="price-slider-max">
													<?php if($minVal != '' && $maxVal !=''){?>
													  <span style="float:left; margin-left: 2%;" class="currency" ><?php echo $currencySymbol; ?><span id="minPriceDisp" ><?php echo trim(number_format(($minVal*$currencyValue),0));?></span></span> 
													  <span style="float:right; margin-right: 2%;" class="currency"><?php echo $currencySymbol ?><span id="maxPriceDisp"><?php echo number_format(($maxVal*$currencyValue),0);?></span></span>
													  <?php } else {?>
													    <span style="float:left; margin-left: 2%;" class="currency"><?php echo $currencySymbol; ?><span id="minPriceDisp" ><?php echo number_format(($min_base_price*$currencyValue),0);?></span></span> 
														<span style="float:right; margin-right: 2%;" class="currency"><?php echo $currencySymbol; ?><span id="maxPriceDisp"><?php echo number_format(($max_base_price*$currencyValue),0);?></span></span>
													  <?php } ?>
													
													<div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="slider-container" style="margin-bottom: 10%;">
														<p align="center" style="margin-top:10px;">
															<input type="hidden" value="" id="amount" style="background-color: #f9f9f9;border: none;text-align: center;">
														</p>
														<div style="left: 0%; " class="ui-slider-range ui-widget-header"></div>
													</div> 
														<div class="rating_slider">
													  <span class="minus_img"></span>
													  <div id="slider-range"></div>
														<span class="plus_img"></span>
													  </div>
													<span>
													
													<form method="get" action="<?php echo current_url(); ?>" id="priceFilterForm">
														<?php if($searchKey != ''){ ?>
														<input type="hidden" name="item" value="<?php echo $searchKey;?>" /> <?php  }?>
														<input type="hidden" id="minPriceVal" value="<?php echo $minVal;?>" name="min_price" class="text" />
														<input type="hidden" id="maxPriceVal" value="<?php echo $maxVal;?>" name="max_price" class="text" />										
														<?php if($gift != ''){ ?>
														<input type="hidden" name="gift_cards" value="<?php echo $gift;?>" /> <?php  }?>
														<?php if($locVal != ''){ ?>
														<input type="hidden" name="location" value="<?php echo $locVal;?>" /> <?php  }?>
														<?php if($shipVal != ''){ ?>
														<input type="hidden" name="shipto" value="<?php echo $shipVal;?>" /> <?php  }?>
														 <?php if($this->input->get('order') != ''){ ?>
														<input type="hidden" name="order" value="<?php echo $orderVal;?>" /> <?php  }?>
														<?php if($this->input->get('color') != ''){ ?>
														<input type="hidden" name="order" value="<?php echo $colorVal;?>" /> <?php  }?>
													<?php	/* <input class="lnk btn btn-primary" type="submit" title="Show Now" value="Show Now" id="priceRangeButton" /> */ ?>
													</form>
										</li>	
										
										
                                    </ul>
                                </ul>
                                
<!--------- Color Filter with Slider starts --->                                
                                 <ul id="facet-price" class="filter first">
                                	<ul class="price-input">
                                    	<li class="changeable selected"><?php echo shopsy_lg('lg_color','Color') ?></li>
                                    </ul>
                                </ul>
                                
								<ul class="color-filter">
								
								<?php if(count($colorfilter) > 0){
								foreach($colorfilter as $color){?>

								<li class="list-inline-item">
									<a href="<?php  echo $c_url.'?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.'&color='.$color.'';?>" style="background-color: <?php echo $color;?>;">
									<span><img src="images/white_tick.png" style="<?php if($_GET['color'] == $color){?>display:block<?php }else { ?>display:none<?php  } ?>;"></span>
									</a>
								</li>

								<?php }}?>
									
								</ul>
								
								
<!-- 								<ul class="color-filter">
												<?php if(count($colorfilter) > 0){
												foreach($colorfilter as $color){?>
													<li style="background-color:<?php echo $color;?>">
													<a href="<?php  echo $c_url.'?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.'&color='.$color.'';?>">
													<span><img src="images/white_tick.png"></span></a>
													</li>
												<?php }
												}?>
								</ul> -->
								
							
								<!-- <ul class="color-filter">
								<li class="list-inline-item">
										<a href="#" class="swatch" style="background-color: #F40B32;">
										<span> <img src="images/white_tick.png"></span>
										</a>
								</li>
								</ul> -->
                                
<!--------- Color Filter with Slider ends--->   
                                
                                
                                
                               <ul class="filter shop-in">
                                	<li class="input-group <?php if($this->input->get('location') == '') { echo 'selected';}?>" id="locationbox"><a href="<?php echo $lnk2.'?'.$s_key.$s_gift.$min_price.$max_price;?>"><?php if($this->lang->line('prod_anyshop') != '') { echo stripslashes($this->lang->line('prod_anyshop')); } else echo 'Any Shop Location'; ?></a></li>
                                <?php /*if($locVal == '') {?>    <li class="changeable" id="shop-location-display">
                                    	<a href="<?php echo $lnk2.'?'.$s_key.$s_gift.$min_price.$max_price.$shipto;?>"><?php if($this->lang->line('prod_anyloc') != '') { echo stripslashes($this->lang->line('prod_anyloc')); } else echo 'Any Location'; ?></a> 
                                         <a href="javascript:void(0);" id="change_location" class="change-link"><?php if($this->lang->line('prod_change') != '') { echo stripslashes($this->lang->line('prod_change')); } else echo 'Change'; ?></a>
                                         <?php } else {*/?>
                                       <form action="<?php echo current_url();?>" method="get">
                                        <input style="width:155px" type="text" id="" value="<?php echo $locVal;?>" name="location" class="location-change">
                                        <span class="button-small button-small-grey">
                                        <span><input style="width:30px;padding: 7px 0;margin: 0;" type="submit" title="OK" value="►" id="locchangeButton">
                                        </span></span>
                                        <?php if($searchKey != ''){ ?>
                                    <input type="hidden" name="item" value="<?php echo $searchKey;?>" /> <?php  }?>
                                        <?php if($this->input->get('gift_cards') == 'on'){ ?> 
                                    <input type="hidden" name="gift_cards" value="<?php echo $gift;?>" /> <?php  }?>
                                     <?php if($minVal != ''){ ?> 
                                    <input type="hidden" name="min_price" value="<?php echo $minVal;?>" /> <?php  }?>
                                         <?php if($maxVal != ''){ ?>
                                    <input type="hidden" name="max_price" value="<?php echo $maxVal;?>" /> <?php  }?>
                                    <?php if($this->input->get('shipto') != ''){ ?>
                                    <input type="hidden" name="shipto" value="<?php echo $shipVal;?>" /> <?php  }?>
                                     <?php if($this->input->get('order') != ''){ ?>
                                    <input type="hidden" name="order" value="<?php echo $orderVal;?>" /> <?php  }?>
                                     <?php if($this->input->get('color') != ''){ ?>
                                    <input type="hidden" name="order" value="<?php echo $colorVal;?>" /> <?php  }?>
                                       </form>
                                    </li>   
                                  <?php //}?>
                                </ul> 
                               <ul class="filter shop-in">
                               <li class="input-group <?php if($this->input->get('shipto') == '') { echo 'selected';}?>" id="shiptobox"><a href="<?php echo $lnk2.'?'.$s_key.$s_gift.$min_price.$max_price.$location;?>"><?php if($this->lang->line('prod_anywhere') != '') { echo stripslashes($this->lang->line('prod_anywhere')); } else echo 'Ships Anywhere'; ?></a></li>
                                <?php /*if($shipVal == '') {?>  
                                  <li class="changeable" id="ship-to-change">
                                    	<a href="<?php echo $lnk2.'?'.$s_key.$s_gift.$min_price.$max_price.$location;?>"><?php if($this->lang->line('prod_anywere') != '') { echo stripslashes($this->lang->line('prod_anywere')); } else echo 'Anywhere'; ?></a> 
                                         <a href="javascript:void(0);" id="change_shipto" class="change-link"><?php if($this->lang->line('prod_change') != '') { echo stripslashes($this->lang->line('prod_change')); } else echo 'Change'; ?></a>
                                         <?php } else {*/?>
                                       <form action="<?php echo current_url();?>" method="get"> 
                                       <div class="shiping-region">
                                      <select  name="shipto" onchange="this.form.submit()" id="shipto">
                                       <option value=""><?php if($this->lang->line('prod_choose') != '') { echo stripslashes($this->lang->line('prod_choose')); } else echo 'Choose country'; ?>...  </option>
                                       <optgroup label="————————">
                                       <?php foreach($countryList as $c_list) { ?>
										   
										    <option value="<?php echo $c_list->id;?>" <?php if($this->input->get('shipto') == $c_list->id){echo 'selected="selected"';}?>><?php echo $c_list->name; ?></option>
                                            <?php }?>
                                          </optgroup>
                                       </select>
                                           </div>
                                        <?php if($searchKey != ''){ ?>
                                    <input type="hidden" name="item" value="<?php echo $searchKey;?>" /> <?php  }?>
                                        <?php if($this->input->get('gift_cards') == 'on'){ ?> 
                                    <input type="hidden" name="gift_cards" value="<?php echo $gift;?>" /> <?php  }?>
                                     <?php if($minVal != ''){ ?> 
                                    <input type="hidden" name="min_price" value="<?php echo $minVal;?>" /> <?php  }?>
                                         <?php if($maxVal != ''){ ?>
                                    <input type="hidden" name="max_price" value="<?php echo $maxVal;?>" /> <?php  }?>
                                    <?php if($locVal != ''){ ?>
                                    <input type="hidden" name="location" value="<?php echo $locVal;?>" /> <?php  }?>
                                        <?php if($this->input->get('order') != ''){ ?>
                                    <input type="hidden" name="order" value="<?php echo $orderVal;?>" /> <?php  }?>
                                        <?php if($this->input->get('color') != ''){ ?>
                                    <input type="hidden" name="order" value="<?php echo $colorVal;?>" /> <?php  }?>
                                       
                                       </form>
                                    </li>   
                                	<?php //}?>
                                </ul>
                               <?php if($this->config->item('deal_of_day') == 'Yes'){ ?>
                                <ul class="filter shop-in">
                                    <li class="input-group selected" id="shiptobox"><?php //echo shopsy_lg('lg_product_type','Product Type') 
												echo shopsy_lg('lg_deal_of_the_day','Deal Of The Day');
												?></li>
                                    
                                  
                                    
                                    <?php i?><a href="<?php  echo $c_url.'?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$colorVal.'&dealday=today';?>"><p style="margin: 5px 5px 5px 15px;"> <?php echo shopsy_lg('lg_todays_deal','Todays Deals');?> </p></a><?php  ?>
                                    <?php  ?><a href="<?php  echo $c_url.'?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$colorVal.'&dealday=upcoming';?>"><p style="margin: 5px 5px 5px 15px;"><?php echo shopsy_lg('lg_upcoming_deals','Upcoming Deals');?> </p></a><?php  ?>
                                </ul>
                                <?php } ?>
                            </div>
                        </div>
                   
					
					
                
                    	<div id="primary">
                        	<div id="search-header">
                            	
                                
                                
                                
                                	<ul class="search-restrictions">
                                    <?php
									if($this->uri->segment(3) != ''){
                                        echo '<h1 class="summary"><li>'.$cat1->cat_name.'</h1>';
									}
									if($this->uri->segment(4) != ''){
                                        echo '<h1 class="summary"><li>'.$cat2->cat_name.'</h1>';
									}
										
										if($searchKey != ''){?>
                                    <h1 class="summary"><li><?php echo $searchKey;?><li></h1>
                                    <?php }?>
                                    	<li> <?php echo $countTitle;?></li>
                                        
                                    </ul>
                                    
                                    
                               
                     <div id="sort_header">
                         <div class="sort-options no-views btn-secondary">
                            <label><?php if($this->lang->line('seller_sortby') != '') { echo stripslashes($this->lang->line('seller_sortby')); } else echo "Sort by"; ?>:</label>
                            <ul id="menu">
                                <li><a href="javascript:void(0);" id="order">
								
								<?php 
								if($this->input->get('order') == 'date_desc'){
								     echo shopsy_lg('shopsec_recent','Most Recent'); $recentAct='active';
								}  else if($this->input->get('order') == 'most_relevant') { 
									 echo shopsy_lg('seller_relevancy','Relevancy'); $relevanttAct='active';
								} else if($this->input->get('order') == 'price_desc'){
								     echo shopsy_lg('lg_highest price','Highest Price'); $priceHigh='active';
								} else if($this->input->get('order') == 'price_asc'){
									 echo shopsy_lg('lg_lowest price','Lowest Price'); $priceLow='active';
								}
								
								?>
								
                                <img src="images/down_arrow.png"></a>
                                    <ul class="sub-menu">
                                    <span class="cursor"></span>
                                    <li><a href="<?php  echo $c_url.'?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.'&order=date_desc';?>" id="Relevancy" class="<?php echo $recentAct;?>"><?php if($this->lang->line('shopsec_recent') != '') { echo stripslashes($this->lang->line('shopsec_recent')); } else echo "Most Recent"; ?></a></li>
                                    
                                    
                                    <li><a href="<?php  echo $c_url.'?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.'&order=most_relevant';?>" id="Alphabetical" class="<?php echo $relevanttAct;?>"><?php if($this->lang->line('seller_relevancy') != '') { echo stripslashes($this->lang->line('seller_relevancy')); } else echo "Relevancy"; ?></a></li>
                                     <li><a href="<?php  echo $c_url.'?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.'&order=price_desc';?>" id="Highest" class="<?php echo $priceHigh;?>"><?php echo shopsy_lg('lg_highest price','Highest Price');?></a></li>
                                    <li><a href="<?php  echo $c_url.'?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.'&order=price_asc';?>" id="Lowest" class="<?php echo $priceLow;?>"><?php echo shopsy_lg('lg_lowest price','Lowest Price');?></a></li>
                                </li>
                             </ul>
                                
                            </div>
                        </div>
                                
   
                            
                                <ul class="shiping-list">
                                <?php if($gift != '') { ?>
                                <li><span><?php if($this->lang->line('prod_accepts') != '') { echo stripslashes($this->lang->line('prod_accepts')); } else echo "Accepts"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('giftcard_cards') != '') { echo stripslashes($this->lang->line('giftcard_cards')); } else echo "Gift Cards"; ?></span><a href="<?php echo $c_url.'?'.$s_key.$min_price.$max_price.$location.$shipto;?>">x</a></li>
                                <?php }?>
                                
                          			<?php 
										if($minVal != '' || $maxVal != '') {  
									  	if($maxVal == '' && $minVal != '') {  
									  	echo '<li>'
									?>
									<?php if($this->lang->line('prod_atleast') != '') { echo stripslashes($this->lang->line('prod_atleast')); } else echo "At least"; ?>
                                    <?php 
										echo $currencySymbol.number_format(($minVal*$currencyValue),0).'<span class="currency-code">'.$currencyType.'</span><a href="'.$c_url.'?'.$s_key.$s_gift.$location.$shipto.$order.$color.'">x</a></li>';
										} else if($minVal == '' && $maxVal != '') {
										echo '<li>'
									?>
                                    <?php if($this->lang->line('prod_atmost') != '') { echo stripslashes($this->lang->line('prod_atmost')); } else echo "At most"; ?>
                                    <?php 
										echo $currencySymbol.number_format(($maxVal*$currencyValue),0).'<span class="currency-code">'.$currencyType.'</span><a href="'.$c_url.'?'.$s_key.$s_gift.$location.$shipto.$order.$color.'">x</a></li>';
										} else { 
										 echo '<li> '.$currencySymbol.number_format(($minVal*$currencyValue),0).'–'.$currencySymbol.''.number_format(($maxVal*$currencyValue),0).'<span class="currency-code">'.$currencyType.'</span></span>
									  	<a href="'.$c_url.'?'.$s_key.$s_gift.$location.$shipto.$order.$color.'">x</a></li>';
										} } ?>
                                
                                   	<?php 
								   		if($locVal != '') { 
                                  		echo '<li>'
									?>	
									<?php if($this->lang->line('prod_itemsin') != '') { echo stripslashes($this->lang->line('prod_itemsin')); } else echo "Items in"; ?>
                                    <?php echo '<span class="currency-code">'.$locVal.'</span>
								  	<a href="'.$c_url.'?'.$s_key.$s_gift.$min_price.$max_price.$shipto.$order.$color.'">x</a></li>';
                                	} ?>
                                	<?php 
										if($shipVal != '') { 
										foreach($countryList as $c_list){  
										if($c_list->id == $shipVal){ 
									  	echo '<li>'
									?>	
                                    <?php if($this->lang->line('prod_shipsto') != '') { echo stripslashes($this->lang->line('prod_shipsto')); } else echo "Ships to"; ?>
                                    <?php echo '<span class="currency-code">'.$c_list->name.'</span>
									  <a href="'.$c_url.'?'.$s_key.$s_gift.$min_price.$max_price.$location.$order.$color.'">x</a></li>';
									}
								}
                                }?>
                                   
                                </ul>
                            
                                
                            </div>
							
							<div id="freewall" class="free-wall" style="margin-bottom: 51px;"> 
							
                            <div id="tiles">
                        
                        	<?php    $productsDetail=$product_list;
                        	
				
				if(!empty($productsDetail)){ $i=0;
				foreach($productsDetail as $proddetails){
					#echo $i;
                  	$imgSplit = explode(",",$proddetails['image']); 
					$shopDet = $this->product_model->get_business_name($proddetails['user_id']);
									
			?>
            	 <div class="brick">     
                    <div class="brick-hover">
                                <div class="product_hide">                                    
                                    <div class="product_fav">                             
										<?php if($loginCheck !=''){ ?>
										<?php if($proddetails['user_id']==$loginCheck){ ?>
										<a href="javascript:void(0);" onclick="return ownProductFav();">
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
										<?php
										}else{
                                        $favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($proddetails['id']));
                                        #print_r($favArr); die;
                                        if(empty($favArr)){ ?>
                                        <a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($proddetails['id']); ?>','Fresh',this);">
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                        <?php  } else { ?>                        
                                        <a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($proddetails['id']); ?>','Old',this);">
                                            <input type="submit" value="" class="hoverfav_icon1" />
                                        </a>
                                        <?php }}} else { ?>
                                        <a href="login" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                        <?php  } ?> 
                                    </div>  
                                     
                                    <div class="hoverdrop_icon">
                                    	<a href="javascript:hoverView('<?php echo $i; ?>');">  </a>
                                        	<div class="hover_lists" id="hoverlist<?php echo $i; ?>">
                                               	<h2><?php if($this->lang->line('user_your_lists') != '') { echo stripslashes($this->lang->line('user_your_lists')); } else echo "Your Lists"; ?></h2>
                                                <div class="lists_check">
                                                	<?php foreach($userLists as $Lists){ 
													$haveListIn = $this->user_model->check_list_products(stripslashes($proddetails['id']),$Lists['id'])->num_rows();
													#echo $haveListIn;
													if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}
													?>
                                                    <input type="checkbox" class="check_box" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo stripslashes($proddetails['id']); ?>');" <?php echo $chk; ?> />
                                                    <label><?php echo $Lists['name']; ?></label>
                                                    <?php } ?>
                                                     <?php if(!empty($userRegistry)){ 
														$haveRegisryIn = $this->user_model->check_registry_products($proddetails['id'],$userRegistry->user_id)->num_rows();
														if($haveRegisryIn>0){$chk='checked="checked"';}else{ $chk='';}
													?>
													<input type="checkbox" class="check_box" onclick="return manageRegisrtyProduct('<?php echo $userRegistry->user_id; ?>','<?php echo $proddetails['id']; ?>');" <?php echo $chk; ?> />
													<label><span class="registry_icon"></span><?php if($this->lang->line('prod_wedding') != '') { echo stripslashes($this->lang->line('prod_wedding')); } else echo "Wedding Registry"; ?></label>
													<?php }  ?>
                                                    </div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="site/user/add_list">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="<?php echo $proddetails['id']; ?>" name="productId" />
                                                        <input type="text" placeholder="<?php if($this->lang->line('user_new_list') != '') { echo stripslashes($this->lang->line('user_new_list')); } else echo "New list"; ?>" class="list_scroll" name="list" id="creat_list_<?php echo $i; ?>" />
                                                        <input type="submit" value="<?php if($this->lang->line('user_add') != '') { echo stripslashes($this->lang->line('user_add')); } else echo "Add"; ?>" class="primary-button" onclick="return validate_create_list('<?php echo $i; ?>');" />
                                                    </form>
                                                </div>
                                        	</div>
                                    	
                                   	</div>  
                               </div>
                      
                        <a href="products/<?php echo $proddetails['seourl'];?>">
                            <img  src="<?php if(!empty($imgSplit[0])){ ?>images/product/thumb/<?php echo stripslashes($imgSplit[0]); } else { echo "images/dummyProductImage.jpg";  }?>" 
                              alt="<?php echo stripslashes($proddetails['product_name']);?>" title="<?php echo stripslashes($proddetails['product_name']);?>" width="100%" />
                        </a>
			<?php 
			  $starttime=$proddetails['deal_date']." ".$proddetails['deal_time_from'];
		  $endatedeal=$proddetails['deal_date_to']." ".$proddetails['deal_time_to'];
		 
		  
		  if($this->config->item('deal_of_day')=='Yes')
		  {
			//print_r($proddetails);die;
		// echo "enddeal". $endatedeal .">=".date("Y-m-d H:i:s");
		  
		  if($proddetails['action']=='DOD' && $proddetails['discount']!=0 && date('Y-m-d H:i',strtotime($starttime)) <= (date('Y-m-d H:i')) && date('Y-m-d H:i',strtotime($endatedeal)) >= (date('Y-m-d H:i'))) {
		  
		
		  ?>
		<div class="offer-tag">
									<p class="off-price"><?php echo $proddetails['discount']; ?>% 0ff</p>
								</div>
								
	     <?php }} ?>
                    </div>
                     <?php  if($this->config->item('deal_of_day')=='Yes')
		  { 
		  
		  if($proddetails['action']=='DOD' && $proddetails['discount']!=0 && date('Y-m-d H:i',strtotime($starttime)) <= date('Y-m-d H:i') && date('Y-m-d H:i',strtotime($endatedeal)) >= (date('Y-m-d H:i')) ) {
		  ?>
		  
		  <?php  
		  
		  $style="style='text-decoration:line-through;'";
		  $endatedeal=$proddetails['deal_date_to']." ".$proddetails['deal_time_to'];
		  
		  
		  $offer=($proddetails['discount']/100)*$proddetails['price'];
		  #echo $offer;
		  $enddeal=date('Y-m-d H:i:s',strtotime($endatedeal));
		  ?>
		  <!--<div data-countdown="<?php echo $enddeal; ?>" >
		  </div>-->
		  <?php } }
		  else
		  {
		  $style='';
		  $offer=0;
		  }
		  ?>                     
                    <div class="info">
						<h3><?php echo $proddetails['product_name']?></h3>
						<span class="cat-name"><a href="shop-section/<?php echo $shopDet->row()->shop_seourl; ?>"><?php echo $shopDet->row()->shop_name?></a></span>
						
						 <span class="cat-name cat-price">
					<?php if($proddetails['price'] != 0.00) {?>
						<?php if($proddetails['action']=='DOD' && $this->config->item('deal_of_day')=='Yes' && date('Y-m-d H:i',strtotime($starttime)) <= date('Y-m-d H:i') && date('Y-m-d H:i',strtotime($endatedeal)) >= (date('Y-m-d H:i'))){?>
                        <span class="currency_value" style="text-decoration:line-through;"><?php echo $currencySymbol; echo number_format($currencyValue*$proddetails['price'],2)?></span>
						<span class="currency_value" ><?php echo $currencySymbol; echo number_format($currencyValue*$proddetails['price']-$offer,2)?></span>
						<?php }else{?>
						 <span class="currency_value" ><?php echo $currencySymbol; echo number_format($currencyValue*$proddetails['price'],2)?></span>
						<?php }?>
                        <span class="currency_code"><?php echo $currencyType;?></span>
                        <?php } else { ?> 
                        <span class="currency_value"><?php echo $currencySymbol; echo number_format($currencyValue*$proddetails['base_price'],2); echo '+';?></span>
                        <span class="currency_code"><?php echo $currencyType;?></span>
                        <?php }?>
                    </span>
						
						</div>
                    
                   
                            
                </div> 
			<?php  
			
			$i++;	} 	}  else { echo '<h2>' ?><?php if($this->lang->line('prod_search') != '') { echo stripslashes($this->lang->line('prod_search')); } else echo "No Products Found In Your Search"; ?>.<?php '</h2>'; }
				
				
			?>
						
						 <?php echo $paginationDisplay;?>
                        </div>
						


<!-- <script>
$(window).load(function(){

  $(function () {
		
		var minPrice =  <?php echo $min_base_price;?>,
          maxPrice = <?php echo $max_base_price;?>,
          $filter_lists = $("#filters ul"),
          $filter_checkboxes = $("#filters :checkbox"),
          $items = $("#container li.element");
		//$filter_checkboxes.click(filterSystem);
				
				$('#slider-container').slider({
					
				  range: true,
				  min: minPrice,
				  max: maxPrice,
				  <?php if($minVal != '' && $maxVal !=''){?>
				  values: [<?php echo $minVal;?>, <?php echo $maxVal;?>],
				  <?php } else {?>
				   values: [minPrice, maxPrice],
				  <?php } ?>
				  slide: function (event, ui) {  
						//alert(event);
						//alert(ui);
					  //$("#amount").val("<?php echo $currencySymbol ?>" + ui.values[0] + " - <?php echo $currencySymbol ?>" + ui.values[1]);
					  var minPriceDisp = Number('<?php echo $currencyValue; ?>')*(Number(ui.values[0]));
					  var maxPriceDisp = Number('<?php echo $currencyValue; ?>')*(Number(ui.values[1]));

					   $("#minPriceVal").val(ui.values[0]);
					   $("#maxPriceVal").val(ui.values[1]);
					   $("#minPriceDisp").html(minPriceDisp);
					   $("#maxPriceDisp").html(maxPriceDisp);
					   
					   $('#minPriceDisp').formatCurrency();
						$('#maxPriceDisp').formatCurrency();
					   
					  minPrice = ui.values[0];
					  maxPrice = ui.values[1];
					  $('#slider-container').mouseout(function(){
					   $('#priceFilterForm').submit();
					   });
					 // filterSystem();
					
				  }		  
			  }); 
					
		
	 // $("#amount").val("<?php echo $currencySymbol ?>"+minPrice + " - <?php echo $currencySymbol ?>"+ maxPrice);
	  $("#minPriceVal").val(minPrice);
	   $("#maxPriceVal").val(maxPrice);
	   $("#minPriceDisp").html(ui.values[0]);
	   $("#maxPriceDisp").html(ui.values[1]);
	    $('#minPriceDisp').formatCurrency();
		 $('#maxPriceDisp').formatCurrency();
  });
});

</script> -->
						
						
						
						<script type="text/javascript">
									var wall = new freewall("#freewall");
									wall.reset({
										selector: '.brick',
										animate: true,
										cellW: 230,
										cellH: 'auto',
										onResize: function() {
											wall.fitWidth();
										}
									});
									
									wall.container.find('.brick img').load(function() {
										wall.fitWidth();
										setTimeout(function(){wall.fitWidth();},100);
									});
									setTimeout(function(){ wall.fitWidth(); }, 100);

						</script> 
                       
						</div>
						<div id="load_ajax_img" style="text-align: center;"></div>
                        </div>
						
						
                    </div>
						
						
						
						</div>
            </div>
        </div>
    
    
    </section>
	</div>
<?php } else { ?>
				<div id="product_search_div">
                <section style="background:#fff; border-bottom:1px solid #ccc;">
                       <div class="main">
                        <div style="margin:20px 0" class="search-error">
                        <h3 class="crumbs"> <?php if($this->lang->line('prod_crumbs') != '') { echo stripslashes($this->lang->line('prod_crumbs')); } else echo 'Oh crumbs'; ?>! </h3>
                        <p class="newline">
                        <?php if($this->lang->line('prod_results') != '') { echo stripslashes($this->lang->line('prod_results')); } else echo "We couldn't find any results for"; ?>
                        <span style="font-weight:bold"><?php echo $searchKey;?></span>
                        </p>
                            
                           </div> 
                           <?php if($this->input->get('gift_cards') == 'on' || $minVal != '' || $maxVal != '' || $locVal != '' || $shipVal != '') {?>
                           <div style="margin:20px 0" class="search-error">
                            <h3 class="crumbs"> <?php if($this->lang->line('prod_remove') != '') { echo stripslashes($this->lang->line('prod_remove')); } else echo "TRY REMOVING SOME FILTERS"; ?>! </h3>
                            <ul class="relatedlist">     
                                <?php if($this->input->get('gift_cards') == 'on') { ?>
                                <li><span><?php if($this->lang->line('prod_accepts') != '') { echo stripslashes($this->lang->line('prod_accepts')); } else echo "Accepts"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('giftcard_cards') != '') { echo stripslashes($this->lang->line('giftcard_cards')); } else echo "Gift Cards"; ?></span><a href="<?php echo $c_url.'?'.$s_key.$min_price.$max_price.$location.$shipto;?>">x</a></li>
                                <?php }?>
                                
                               <?php if($minVal != '' || $maxVal != '')   {  
									 if($maxVal == '' && $minVal != ''){ 
									 
								      echo '<li>'?>
                               <?php if($this->lang->line('prod_atleast') != '') { echo stripslashes($this->lang->line('prod_atleast')); } else echo "At least"; ?> 
                               <?php echo $currencySymbol.$minVal.'<span class="currency-code"> '.$currencyType.'</span></span>
									  <a href="'.$c_url.'?'.$s_key.$s_gift.$location.$shipto.$order.$color.'">x</a></li>';
									  }  else if($minVal == '' && $maxVal != ''){
									  
									   echo '<li>' ?> 
                               <?php if($this->lang->line('prod_atmost') != '') { echo stripslashes($this->lang->line('prod_atmost')); } else echo "At most"; ?> 
                               <?php echo $currencySymbol.$maxVal.'<span class="currency-code"> '.$currencyType.'</span></span>
									  <a href="'.$c_url.'?'.$s_key.$s_gift.$location.$shipto.$order.$color.'">x</a></li>';
								     } else {
								  
									  echo '<li> '.$currencySymbol.$minVal.'–'.$currencySymbol.''.$maxVal.'<span class="currency-code">'.$currencyType.'</span></span>
									  <a href="'.$c_url.'?'.$s_key.$s_gift.$location.$shipto.$order.$color.'">x</a></li>';
                                }  }?>
                                
                                 <?php if($locVal != '') { 
                                  echo '<li>' ?>
                                  <?php if($this->lang->line('prod_itemsin') != '') { echo stripslashes($this->lang->line('prod_itemsin')); } else echo "Items in"; ?> 
                                  <?php echo '<span class="currency-code">'.$locVal.'</span>
								  <a href="'.$c_url.'?'.$s_key.$s_gift.$min_price.$max_price.$shipto.$order.$color.'">x</a></li>';
                                }?>
                                <?php if($shipVal != '') { 
									foreach($countryList as $c_list){  
										if($c_list->id == $shipVal){
										  echo '<li>' ?>
                                			<?php if($this->lang->line('prod_shipsto') != '') { echo stripslashes($this->lang->line('prod_shipsto')); } else echo "Ships to"; ?> 
                                			<?php echo '<span class="currency-code">'.$c_list->name.'</span>
										  <a href="'.$c_url.'?'.$s_key.$s_gift.$min_price.$max_price.$location.$order.$color.'">x</a></li>';
										}
									}
                                }?>
                                
                                <?php if($colorVal != '') { 
                                  echo '<li>' ?>
                                  color 
                                  <?php echo '<span class="currency-code">'.$colorVal.'</span>
								  <a href="'.$c_url.'?'.$s_key.$s_gift.$location.$min_price.$max_price.$shipto.$order.'">x</a></li>';
                                }?>
                                
                             </ul>
                             </div>
                             <?php }?>
                       </div> 
                </section>
			</div>
<?php }?>

<script>
$(document).ready(function(e) {
    $('#change_location').click(function(){
	$('#shop-location-display').html('<form action="<?php echo addslashes(current_url());?>" method="get"> <input style="width:155px" type="text" id="" value="<?php echo $locVal;?>" name="location" class="location-change"><span class="button-small button-small-grey"><span><input style="width:30px;padding: 7px 0;margin: 0;" type="submit" title="OK" value="►" id="locchangeButton"></span></span><?php if($searchKey != ''){ ?><input type="hidden" name="item" value="<?php echo $searchKey;?>" /> <?php  }?><?php if($gift != ''){ ?> <input type="hidden" name="gift_cards" value="<?php echo $gift;?>" /> <?php  }?><?php if($minVal != ''){ ?><input type="hidden" name="min_price" value="<?php echo $minVal;?>" /> <?php  }?><?php if($maxVal != ''){ ?><input type="hidden" name="max_price" value="<?php echo $maxVal;?>" /><?php  }?><?php if($shipVal != ''){ ?><input type="hidden" name="shipto" value="<?php echo $shipVal;?>" /><?php  }?></form>');
	});
});



$(document).ready(function(e) {
    $('#change_shipto').click(function(){
	$('#ship-to-change').html('<form action="<?php echo addslashes(current_url());?>" method="get"><div class="shiping-region"><select name="shipto" onchange="this.form.submit()" id="shipto"><option value="">Choose country...</option><optgroup label="————————"><?php foreach($countryList as $c_list){?><option value="<?php echo $c_list->id;?>"><?php echo $c_list->name;?></option><?php }?></optgroup></select></div><?php if($searchKey != ''){ ?><input type="hidden" name="item" value="<?php echo $searchKey;?>" /><?php }?><?php if($gift != ''){ ?><input type="hidden" name="gift_cards" value="<?php echo $gift;?>" /><?php }?><?php if($minVal != ''){ ?><input type="hidden" name="min_price" value="<?php echo $minVal;?>" /><?php  }?><?php if($maxVal != ''){ ?><input type="hidden" name="max_price" value="<?php echo $maxVal;?>" /><?php  }?><?php if($locVal != ''){ ?><input type="hidden" name="location" value="<?php echo $locVal;?>" /><?php  }?></form>');
	});
});
</script><!--
<script src="js/site/scrolling_javascript.js"> </script>
<script>

$(document).ready(function() {

		$('#search_results').scrollPagination({
		
		//alert('site/product/ajax_search_product/<?php echo str_replace(base_url(),'',$c_url).'?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$color; ?>');
			nop     : 10, // The number of posts per scroll to be loaded
			offset  : 6, // Initial offset, begins at 0 in this case
			error   : '', // When the user reaches the end this is the message that is
		                            // displayed. You can change this if you want.
			path   : 'site/product/ajax_search_product/<?php echo str_replace(base_url(),'',$c_url).'?'.$s_key.$s_gift.$min_price.$max_price.$location.$shipto.$order.$color; ?>',
			delay   : 200, // When you scroll down the posts will load after a delayed amount of time.
		               // This is mainly for usability concerns. You can alter this as you see fit
			scroll  : false // The main bit, if set to false posts will not load as the user scrolls. 
		               // but will still load if the user clicks.		
		});	
	
});

</script> -->
<script type="text/javascript">
var loading = true;
$(window).scroll(function(){
	if(loading==true){
		if(($(document).scrollTop()+$(window).height())>($(document).height()-200)){
			//wall.fitWidth();
			$url = $(document).find('.landing-btn-more').attr('href');
			console.log($url);
			if($url){
				loading = false;
				$(document).find('#load_ajax_img').append('<img id="theImg" src="<?php echo base_url(); ?>images/loader64.gif" />');
				$.ajax({
					type : 'get',
					url : $url,
					dataType : 'html',
					success : function(html){
						
						$html = $($.trim(html));
						//console.log($html);
						$(document).find('.landing-btn-more').remove();
						$(document).find('#tiles').append($html.find('#tiles').html());
						$(document).find('#tiles').after($html.find('.landing-btn-more'));
						wall.fitWidth();
						setTimeout(function(){wall.fitWidth();},100);
						
					},
					error : function(a,b,c){
						console.log(c);
					},
					complete : function(){
						$("#load_ajax_img img:last-child").remove();
						loading = true;
						
					}
				});
			}
		}
	}
});

</script>




<style>
.loading-bar {
	border: 1px solid #DDDDDD;
    border-radius: 5px;
    box-shadow: 0 -45px 30px -40px rgba(0, 0, 0, 0.05) inset;
    clear: both;
    cursor: pointer;
    display: block;
    float: none;
    font-family: "museo-sans",sans-serif;
    font-size: 2em;
    font-weight: bold;
    margin: 20px 0px 20px 0;
    padding: 10px 0px;
    position: relative;
    text-align: center;
    width: 100%;
}
.loading-bar:hover {
	box-shadow: inset 0px 45px 30px -40px rgba(0, 0, 0, 0.05);
}
.standardized_filters {
    float: left;
    width: 30%;
}
.product-search-page {
    float: left;
    width: 70%;
}
.product-search-page .product_listing li {
    height: 220px;
    margin: 0 0 24px 25px;
    width: 208px;
}
</style>    




<?php $this->load->view('site/templates/footer'); ?>