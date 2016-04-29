 
 
 <script type="text/javascript" src="js/front/freewall.js"></script>
 
 
 <div class="product_box">     

 	<?php if(!empty($get_shop_selection_products)) { ?>               

    <div id="freewall" class="free-wall" style="margin-bottom: 51px;"> 
	
	<div id="tiles">

    	<?php $i=0; foreach($get_shop_selection_products as $shop_section_products) { 

		$i++;

		$img = 'dummyProductImage.jpg';

		$imgArr = explode(',', $shop_section_products['image']);

		if (count($imgArr)>0){

			foreach ($imgArr as $imgRow){

				if ($imgRow != ''){

					$img = $pimg = $imgRow;

					break;

				}

			}

		}

		?>

            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            <?php if($loginCheck !=''){ ?>
											<?php if($shop_section_products['user_id']==$loginCheck){ ?>
											<a href="javascript:void(0);" onclick="return ownProductFav();">
												<input type="submit" value="" class="hoverfav_icon" />
											</a>
											<?php
											}else{

											$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($shop_section_products['id']));

											#print_r($favArr); die;

											if(empty($favArr)){ ?>

											<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($shop_section_products['id']); ?>','Fresh',this);">

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											<?php  } else { ?>                        

											<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($shop_section_products['id']); ?>','Old',this);">

												<input type="submit" value="" class="hoverfav_icon1" />

											</a>

											<?php }}} else { ?>

											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											<?php  } ?>                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('<?php echo $i; ?>');">  </a>

                                        	<div class="hover_lists" id="hoverlist<?php echo $i; ?>">

                                               	<h2><?php if($this->lang->line('user_your_lists') != '') { echo stripslashes($this->lang->line('user_your_lists')); } else echo 'Your Lists'; ?></h2>

                                                <div class="lists_check">

                                                	<?php foreach($userLists as $Lists){ 

													$haveListIn = $this->user_model->check_list_products(stripslashes($shop_section_products['id']),$Lists['id'])->num_rows();

													#echo $haveListIn;

													if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}

													?>

                                                    <input type="checkbox" class="check_box" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo stripslashes($shop_section_products['id']); ?>');" <?php echo $chk; ?> />

                                                    <label><?php echo $Lists['name']; ?></label>

                                                    <?php } ?>

                                                    <?php if(!empty($userRegistry)){ 

														$haveRegisryIn = $this->user_model->check_registry_products($shop_section_products['id'],$userRegistry->user_id)->num_rows();

														if($haveRegisryIn>0){$chk='checked="checked"';}else{ $chk='';}

													?>

													<input type="checkbox" class="check_box" onclick="return manageRegisrtyProduct('<?php echo $userRegistry->user_id; ?>','<?php echo $shop_section_products['id']; ?>');" <?php echo $chk; ?> />

													<label><span class="registry_icon"></span>Wedding Registry</label>

													<?php }  ?>

                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="<?php echo $shop_section_products['id']; ?>" name="productId" />

                                                        <input type="text" placeholder="<?php if($this->lang->line('user_new_list') != '') { echo stripslashes($this->lang->line('user_new_list')); } else echo 'New list'; ?>" class="list_scroll" name="list" id="creat_list_<?php echo $i; ?>" />

                                                        <input type="submit" value="<?php if($this->lang->line('user_add') != '') { echo stripslashes($this->lang->line('user_add')); } else echo 'Add'; ?>" class="primary-button" onclick="return validate_create_list('<?php echo $i; ?>');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/<?php echo $shop_section_products['seourl']?>">   <img src="<?php echo PRODUCTPATHTHUMB.$img; ?>" alt="<?php echo stripslashes($shop_section_products['product_name']); ?>" title="<?php echo stripslashes($shop_section_products['product_name']); ?>" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/<?php echo $shop_section_products['seourl']?>"><?php echo stripslashes($shop_section_products['product_name']); ?></a></div>

                

                <div class="product_maker"><a href="<?php echo base_url().'shop-section/'.$this->uri->segment(2); ?>"><?php echo stripslashes($get_seller_details['seller_businessname']); ?></a></div>

            

                <div class="product_price">

                <?php if($shop_section_products['price'] != 0.00) { ?>

                    <span class="currency_value"><?php echo $currencySymbol;?><?php echo number_format($currencyValue*$shop_section_products['price'],2); ?></span>

                    <span class="currency_code"><?php echo $currencyType;?></span>

                <?php } else { ?>

                	<span class="currency_value"><?php echo $currencySymbol;?><?php echo number_format($currencyValue*$attribute_price_values[$shop_section_products['id']],2); ?>+</span>

                    <span class="currency_code"><?php echo $currencyType;?></span>

                <?php } ?> 

                    

      

                    

                

                </div>
				<?php echo $paginationDisplay; ?>
				</div>

            

            </div>

        <?php } ?>

    </div>

    <?php } else { ?>

    	<div style="color:red; text-align:center;margin-top: 120px;font-weight: bold;"><?php if($this->lang->line('shopsec_results') != '') { echo stripslashes($this->lang->line('shopsec_results')); } else echo 'Results Not Found'; ?></div>

    <?php } ?>
	
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

<script type="text/javascript">
var loading = true;
$(window).scroll(function(){
	if(loading==true){
		if(($(document).scrollTop()+$(window).height())>($(document).height()-1)){
			//alert("asdfasdf");
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
						$("#load_ajax_img img:last-child").remove()
						loading = true;
						
					}
				});
			} 
		}
	}
});

</script>