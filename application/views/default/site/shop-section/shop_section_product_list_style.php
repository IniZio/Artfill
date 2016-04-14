<?php if(!empty($get_shop_selection_products)) { ?>   

<ul class="team_list_main">

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

    <li>

    <div class="team_img2">

    <a href="products/<?php echo $shop_section_products['seourl']?>">

    <img src="<?php echo PRODUCTPATHTHUMB.$img; ?>" title="<?php echo stripslashes($shop_section_products['product_name']); ?>" alt="<?php echo stripslashes($shop_section_products['product_name']); ?>">

    </a>

    </div>

    <div  style="width:49%"  class="team_info">

    <a href="products/<?php echo $shop_section_products['seourl']?>">

      <p><?php echo stripslashes($shop_section_products['product_name']); ?></p>

    </a>

    <span class="shoppingname"><a href="<?php echo base_url().'shop-section/'.$this->uri->segment(2); ?>"><?php echo stripslashes($get_seller_details['seller_businessname']); ?></a></span>

    </div>

    <div class="team_member2">

    <p>

   <?php echo $shop_section_products['view_count']?> <?php if($this->lang->line('shopsec_views') != '') { echo stripslashes($this->lang->line('shopsec_views')); } else echo 'views'; ?>

    </p>

   

    </div>

     <div class="team_member2">

    <p>

    

    <?php 

		

		/*$seconds = strtotime(date('Y-m-d H:m:s')) - strtotime($shop_section_products['created']);

		 

		echo "<br>". $days    = floor($seconds / 86400);

		echo "<br>".$hours   = floor(($seconds - ($days * 86400)) / 3600);

		echo "<br>".$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);

		echo "<br>".$seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));echo "<br>";*/

	?>

    

    <a style="color:#000" href="#"><?php echo date("d M, Y", strtotime($shop_section_products['created'])); ?></a>

    </p>

   

    </div>

    

    <div style="width:12%" class="team_member2">

    <p>

   <div class="product_img">

            

                <div style="margin:20px 0" class="product_hide">

                                    	<div class="product_fav">

                                            <?php if($loginCheck !=''){?>
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

													<label><span class="registry_icon"></span><?php if($this->lang->line('prod_wedding') != '') { echo stripslashes($this->lang->line('prod_wedding')); } else echo 'Wedding Registry'; ?></label>

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


    <a style="color: #664fa6;font-size: 13px;  padding: 0 0 70px; font-weight: bold;" href="#"> <?php echo $currencySymbol;?>

		 

        <?php if($shop_section_products['price'] != 0.00) { ?>

			<?php echo number_format($currencyValue*$shop_section_products['price'],2); ?><?php echo $currencyType;?> 

		<?php } else { ?>

        <?php echo number_format($currencyValue*$attribute_price_values[$shop_section_products['id']],2); ?>+<?php echo $currencyType;?> 

        <?php } ?>

			</a></div></p>

    </div>

    </li>

    <?php } ?>                

</ul>

<?php } else { ?>

    <div style="color:red; text-align:center;margin-top: 120px;font-weight: bold;"><?php if($this->lang->line('shopsec_results') != '') { echo stripslashes($this->lang->line('shopsec_results')); } else echo 'Results Not Found'; ?></div>

<?php } ?>

<div class="clear"></div>
<?php echo $paginationDisplay; ?>
<script type="text/javascript">
var loading = true;
$(window).scroll(function(){
	if(loading==true){
		if(($(document).scrollTop()+$(window).height())>($(document).height()-1)){			
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
						console.log($html);
						$(document).find('.landing-btn-more').remove();						
						$(document).find('.team_list_main').append($html.find('.team_list_main').html());						
						$(document).find('.team_list_main').after($html.find('.landing-btn-more'));
						//wall.fitWidth();
						//setTimeout(function(){wall.fitWidth();},10);
						
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