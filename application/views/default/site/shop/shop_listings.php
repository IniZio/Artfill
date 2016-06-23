<link rel="stylesheet" href="css/default/front/main.css">
 <script type="text/javascript" src="js/front/freewall.js"></script>


<?php if(count($shopDetail) > 0){?> <div style="text-align: center;padding: 0px 0px 12px 0px;"><h4><?php echo af_lg('lg_published','Published Products');?></h4></div><?php }?>


 <div id="freewall" class="free-wall" style="margin-bottom: 51px;"> 
 
 
					<div id="tiles">                       	

                            <?php for($i=0;$i<count($shopDetail);$i++){  
							$imgArr=explode(',',$shopDetail[$i]['image']); 
							?>

                             <div class="brick">  
                            <?php if(//$shopDetail[$i]['pay_status']=='Paid' && 
                            		$shopDetail[$i]['status']=='Publish'){ 
                            	//echo '<a href="products/'.$shopDetail[$i]['seourl'].'">';
                            	echo '<a href="edit-product/'.$shopDetail[$i]['seourl'].'">';
                             }?>

                            	<div class="brick-hover">

                                	<img src="images/product/thumb/<?php echo $imgArr[0]; ?>"  />
																																		<?php  
									 $style='';
		  $offer=0;
		if($this->config->item('deal_of_day')=='Yes')
		  { 
		  
		  
		  $starttime=$shopDetail[$i]['deal_date']." ".$shopDetail[$i]['deal_time_from'];
		  $enddeal=$shopDetail[$i]['deal_date_to']." ".$shopDetail[$i]['deal_time_to'];
		  
		  
		
		  if($shopDetail[$i]['action']=='DOD' && $shopDetail[$i]['discount']!=0 && date('Y-m-d H:i',strtotime($starttime)) <=date('Y-m-d H:i') && date('Y-m-d H:i',strtotime($enddeal)) >=date('Y-m-d H:i')) {
		  ?>
		  <div class="offer-tag" >
									<p class="off-price"><?php echo $shopDetail[$i]['discount']; ?>% 0ff</p>
								</div>
		  
		  <?php }}?>

                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline"><?php echo $shopDetail[$i]['product_name']; ?><?php $footstop = $this->_ci_cached_vars["languageCode"] == "zh_HK" ? "。" : "." ?> </div>

                                    </div>
									
									<div class="product_maker"><?php  echo stripslashes($selectSeller_details[0]['seller_businessname']); ?></div>

                                    <?php  
									 $style='';
		  $offer=0;
		if($this->config->item('deal_of_day')=='Yes')
		  { 
		  
		  
		  $starttime=$shopDetail[$i]['deal_date']." ".$shopDetail[$i]['deal_time_from'];
		   $enddeal=$shopDetail[$i]['deal_date_to']." ".$shopDetail[$i]['deal_time_to'];
		  
		
		  if($shopDetail[$i]['action']=='DOD' && $shopDetail[$i]['discount']!=0 && date('Y-m-d H:i',strtotime($starttime)) <=date('Y-m-d H:i') && date('Y-m-d H:i',strtotime($enddeal)) >=date('Y-m-d H:i') ) {
		  ?>
		  
		  <?php  date('Y-m-d H:i');
		  
		  $style="style='text-decoration:line-through;'";
		  $endatedeal=$shopDetail[$i]['deal_date_to']." ".$shopDetail[$i]['deal_time_to'];
		  
		  
		  if($shopDetail[$i]['price']!=0){ 
							$price_tot=$shopDetail[$i]['price'];
							$orignal_price = $shopDetail[$i]['price'];	
							$orignalamount = number_format($orignal_price,2);
						}else {
							$price_tot=$shopDetail[$i]['pricing'].'+';
							$orignal_price = $shopDetail[$i]['price'];	
							$orignalamount = $price_tot;
						}
				
		  
		  $offer=($shopDetail[$i]['discount']/100)*$price_tot;
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
		  
		   if($shopDetail[$i]['price']!=0){ 
							$price_tot=$shopDetail[$i]['price'];
							$orignal_price = $shopDetail[$i]['price'];	
							$orignalamount = number_format($orignal_price,2);
						}else {
							$price_tot=$shopDetail[$i]['pricing'].'+';
							$orignal_price = $shopDetail[$i]['price'];	
							$orignalamount = $price_tot;
						}
						//$orignalamount=$price_tot;	
		  }
		  }
		 
		   
		  ?>			
                                    <div class="product_price">
                                        

                                        <?php if($shopDetail[$i]['price'] != 0.00) { $price=$currencyValue*$shopDetail[$i]['price']; } else { $price=$currencyValue*$shopDetail[$i]['pricing']; echo '+';  }
										?>

                                        <span class="currency_value" <?php  echo $style;?>><span><?php echo $currencySymbol;?></span> <?php echo number_format($price,2); ?></span>
                                        <span class="currency_code"> <?php echo $currencyType;?></span>
										<?php if($shopDetail[$i]['action']=='DOD' && $shopDetail[$i]['discount']!=0 && date('Y-m-d H:i',strtotime($starttime)) <=date('Y-m-d H:i')) {
		  ?>
		 <span class="dolar-value"><?php echo number_format($orignal_price,2); ?></span>

                                        <span class="currency_code"><?php echo $currencyType;?></span>
		
<?php }?>									
                                    </div>

                                </div>

                            <?php if(//$shopDetail[$i]['pay_status']=='Paid' && 
                            		$shopDetail[$i]['status']=='Publish'){ echo '</a>'; } ?>

                            </div>

                            <?php } ?>

                             <div class="brick">  

                            	<a class="listing-thumb" href="shop/listitem">

                                	<span class="button_add"></span><?php if($this->lang->line('shop_listyouritem') != '') { echo stripslashes($this->lang->line('shop_listyouritem')); } else echo 'List your item'; ?>

                                </a>

                            </div>
							
							
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
									});
									setTimeout(function(){ wall.fitWidth(); }, 1000);

						</script> 

                        </div>
						
						</div>

<?php if(count($Unpublished) > 0){?></div>
<div class="list_wrap">
<div style="text-align: center;padding: 0px 0px 12px 0px;"><h4><?php echo af_lg('lg_unpublished_pro','Unpublished Products');?></h4></div>					
					<ul class="list_wrap_items">                        	

                            <?php for($i=0;$i<count($Unpublished);$i++){  

							$imgArr=explode(',',$Unpublished[$i]['image']); 

							?>

                            <li>
                            <?php //if($Unpublished[$i]['pay_status']=='Paid' && $Unpublished[$i]['status']=='Publish'){ echo '<a href="products/'.$Unpublished[$i]['seourl'].'">'; }?>
                            <a href="edit-product/<?php echo $Unpublished[$i]['seourl'];?>">	

                            	<div class="image-detail" style="background:#FFF;">

                                	<img src="images/product/thumb/<?php echo $imgArr[0]; ?>"  />
																																		<?php  
									 $style='';
		  $offer=0;
		if($this->config->item('deal_of_day')=='Yes')
		  { 
		  
		  
		  $starttime=$Unpublished[$i]['deal_date']." ".$Unpublished[$i]['deal_time_from'];
		   $enddeal=$shopDetail[$i]['deal_date_to']." ".$shopDetail[$i]['deal_time_to'];
		  
		
		  if($Unpublished[$i]['action']=='DOD' && $Unpublished[$i]['discount']!=0 && date('Y-m-d H:i',strtotime($starttime)) <=date('Y-m-d H:i') && date('Y-m-d H:i',strtotime($enddeal)) >=date('Y-m-d H:i') ) {
		  ?>
		  <div class="offer-tag" >
									<p class="off-price"><?php echo $Unpublished[$i]['discount']; ?>% 0ff</p>
								</div>
		  
		  <?php }}?>

                                </div>

                                <div class="content-detail">

                                    <div class="listing-title">

                                        <div class="headline"><?php echo $Unpublished[$i]['product_name']; ?><?php $footstop = $this->_ci_cached_vars["languageCode"] == "zh_HK" ? "。" : "." ?> </div>

                                        <div class="new-user"><?php  echo stripslashes($selectSeller_details[0]['seller_businessname']); ?></div>

                                    </div>

                                    <?php  
									 $style='';
		  $offer=0;
		if($this->config->item('deal_of_day')=='Yes')
		  { 
		  
		  
		  $starttime=$Unpublished[$i]['deal_date']." ".$Unpublished[$i]['deal_time_from'];
		   $enddeal=$shopDetail[$i]['deal_date_to']." ".$shopDetail[$i]['deal_time_to'];
		  
		
		  if($Unpublished[$i]['action']=='DOD' && $Unpublished[$i]['discount']!=0 && date('Y-m-d H:i',strtotime($starttime)) <=date('Y-m-d H:i') && date('Y-m-d H:i',strtotime($enddeal)) >=date('Y-m-d H:i')) {
		  ?>
		  
		  <?php  date('Y-m-d H:i');
		  
		  $style="style='text-decoration:line-through;'";
		  $endatedeal=$Unpublished[$i]['deal_date_to']." ".$Unpublished[$i]['deal_time_to'];
		  
		  
		  if($Unpublished[$i]['price']!=0){ 
							$price_tot=$Unpublished[$i]['price'];
							$orignal_price = $Unpublished[$i]['price'];	
							$orignalamount = number_format($orignal_price,2);
						}else {
							$price_tot=$Unpublished[$i]['pricing'].'+';
							$orignal_price = $Unpublished[$i]['price'];	
							$orignalamount = $price_tot;
						}
				
		  
		  $offer=($Unpublished[$i]['discount']/100)*$price_tot;
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
		  
		   if($Unpublished[$i]['price']!=0){ 
							$price_tot=$Unpublished[$i]['price'];
							$orignal_price = $Unpublished[$i]['price'];	
							$orignalamount = number_format($orignal_price,2);
						}else {
							$price_tot=$Unpublished[$i]['pricing'].'+';
							$orignal_price = $Unpublished[$i]['price'];	
							$orignalamount = $price_tot;
						}
						//$orignalamount=$price_tot;	
		  }
		  }
		 
		   
		  ?>			
                                    <div class="listing-price">
                                        <span class="dolar"><?php echo $currencySymbol;?></span>

                                        <?php if($Unpublished[$i]['price'] != 0.00) { $price=$currencyValue*$Unpublished[$i]['price']; } else { $price=$currencyValue*$Unpublished[$i]['pricing']; echo '+';  }
										?>

                                        <span class="dolar-value" <?php  echo $style;?>><?php echo number_format($price,2); ?></span>
                                        <span class="dolar-id currencyType"><?php echo $currencyType;?></span>
										<?php if($Unpublished[$i]['action']=='DOD' && $Unpublished[$i]['discount']!=0 && date('Y-m-d H:i',strtotime($starttime)) <=date('Y-m-d H:i')) {
		  ?>
		 <span class="dolar-value"><?php echo number_format($orignal_price,2); ?></span>

                                        <span class="dolar-id currencyType"> <?php echo $currencyType;?></span>
		
<?php }?>									
                                    </div>

                                </div>

                            <?php //if($Unpublished[$i]['pay_status']=='Paid' && $Unpublished[$i]['status']=='Publish'){ echo '</a>'; } ?>
                            </a>

                            </li>

                            <?php } ?>

<!--                       <li>

                            	<a class="listing-thumb" href="shop/listitem">

                                	<span class="button_add"></span><?php if($this->lang->line('shop_listyouritem') != '') { echo stripslashes($this->lang->line('shop_listyouritem')); } else echo 'List your item'; ?>

                                </a>

                            </li>
 -->                            

                        </ul>
<?php }?>