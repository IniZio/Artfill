<div id="primary">
                        	
							<div id="freewall" class="free-wall" style="margin-bottom: 51px;"> 
							
                            <div id="tiles">
                        
                        	<?php    $productsDetail=$product_list->result_array();
                        	
				
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
			
			$i++;	} 	} 
				
				
			?>
						
						 <?php echo $paginationDisplay;?>
                        </div>
					
                       
						