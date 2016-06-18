<?php

$this->load->view('site/templates/header');

?>

<!-- <link rel="stylesheet" type="text/css" media="all" href="css/default/site/<?php echo SITE_COMMON_DEFINE ?>timeline.css"/> -->

<style type="text/css" media="screen">





#edit-details {

    color: #FF3333;

    font-size: 11px;

}

.option-area select.option {

    border: 1px solid #D1D3D9;

    border-radius: 3px 3px 3px 3px;

    box-shadow: 1px 1px 1px #EEEEEE;

    height: 22px;

    margin: 5px 0 12px;

}

a.selectBox.option {

    margin: 5px 0 10px;

    padding: 3px 0;

}

a.selectBox.option .selectBox-label {

    font: inherit !important;

    padding-left: 10px;



}



</style>







 <!-- Section_start -->

<div class="lang-en wider no-subnav thing signed-out winOS">



<div id="container-wrapper">

	<div class="container ">

	<?php 

	if ($fancyboxDetail->num_rows()==1){

		$img = 'dummyProductImage.jpg';

		$imgArr = explode(',', $fancyboxDetail->row()->image);

		if (count($imgArr)>0){

			foreach ($imgArr as $imgRow){

				if ($imgRow != ''){

					$img = $pimg = $imgRow;

					break;

				}

			}

		}

		$fancyClass = 'fancy';

		$fancyText = LIKE_BUTTON;

		if (count($likedProducts)>0 && $likedProducts->num_rows()>0){

			foreach ($likedProducts->result() as $likeProRow){

				if ($likeProRow->product_id == $fancyboxDetail->row()->id){

					$fancyClass = 'fancyd';$fancyText = LIKED_BUTTON;break;

				}

			}

		}

	?>	



				<div class="wrapper-content right-sidebar">

			<div id="content">

				<div class="figure-row first">

					<div class="figure-product figure-640 big">

						

						<figure>

							<span class="wrapper-fig-image">

								<span class="fig-image"><img src="<?php echo base_url();?>images/fancyybox/<?php echo $img;?>" alt="<?php echo $fancyboxDetail->row()->name;?>" height="640" width="640"></span>

							</span>

                            

                            <figcaption><?php echo $fancyboxDetail->row()->name;?></figcaption>

						    

                        </figure>

						

						<br class="hidden">

						

						<p>by <?php echo $siteTitle;?></p>

						



						<br class="hidden">

<!-- 						

						<a href="#" item_img_url="images/fancyybox/<?php echo $img;?>" tid="<?php echo $fancyboxDetail->row()->id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?>><span><i></i></span><?php echo $fancyText;?></a>

 -->						



					</div>

					<!-- / figure-product figure-640 -->

				</div>

				<!-- / figure-row -->



<!--                 <section class="comments comments-list comments-list-new">

                    

                    <button id="btn-viewall-comments" class="toggle">View all 28 comments <i></i></button>

					<button id="toggle-comments" class="toggle"><span>View all 28 comments</span> <i></i></button>

                    

					<!-- template for normal comments -->

					

					<!-- template for reported comments -->

					

<!--					<ol user_id="">

						

						<li class="loading"><span>Loading...</span></li>

					</ol>

					<ol user_id="">

						

						

						<li class="comment">

							<a class="milestone" id="comment-1866615"></a>

							<span class="vcard"><a href="#" class="url"><img src="images/product/comment-icon-5.jpg" alt="" class="photo"><span class="fn nickname">elkhazak</span></a></span>

							<p class="c-text"><a href="#">@yahiaoui_minou</a> i'll do it if u do it i promise also ;)</p>

							

                            

						</li>

						

						

						

						<li class="comment">

							<a class="milestone" id="comment-1866645"></a>

							<span class="vcard"><a href="#" class="url"><img src="images/product/comment-icon-4.jpg" alt="" class="photo"><span class="fn nickname">apichna90</span></a></span>

							<p class="c-text"><a href="#">@elkhazak</a></p>

							

                            

						</li>

						

						

					</ol>

					



				</section>

				<!-- / comments -->

				<?php 

				if ($relatedProductsArr->num_rows()>0){

				?>

				<div class="might-fancy">

					<h3><?php if($this->lang->line('com_mightalso') != '') { echo stripslashes($this->lang->line('com_mightalso')); } else echo "You might also"; ?> <?php echo LIKE_BUTTON;?>...</h3>

					<div style="height: 259px;" class="figure-row fancy-suggestions anim">

					<?php 

					$limitCount = 0;

					foreach ($relatedProductsArr->result() as $relatedRow){

						if ($limitCount<3){

							$limitCount++;

						$img = 'dummyProductImage.jpg';

						$imgArr = explode(',', $relatedRow->image);

						if (count($imgArr)>0){

							foreach ($imgArr as $imgRow){

								if ($imgRow != ''){

									$img = $imgRow;

									break;

								}

							}

						}

					?>

							<div class="figure-product figure-200">

								<a href="<?php echo base_url();?>fancybox/<?php echo $relatedRow->id;?>/<?php echo url_title($relatedRow->name,'-');?>">

								<figure>

								<span class="wrapper-fig-image">

									<span class="fig-image">

										<img style="width: 200px; height: 200px;" src="<?php echo base_url();?>images/fancyybox/<?php echo $img;?>">

									</span>

								</span>

								<figcaption><?php echo $relatedRow->name;?></figcaption>

								</figure>

								</a>

								<br class="hidden">

<!-- 								<a href="#" item_img_url="images/fancyybox/<?php echo $img;?>" tid="<?php echo $relatedRow->id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?>><span><i></i></span><?php echo $fancyText;?></a>

 -->							</div>

					<?php 

					}}

					?>

							</div>

				</div>

				<?php }?>

				

			</div>

            

			<!-- / content -->



			<aside id="sidebar">

          

				<section class="thing-section gift-section">

					

                    <h3><?php echo $fancyboxDetail->row()->name;?></h3>



					<div class="thing-description">

					<?php 

					$short_des = word_limiter($fancyboxDetail->row()->excerpt,25);

					if ($short_des == ''){

						$short_des = word_limiter($fancyboxDetail->row()->description,25);

					}

					?>	

						<p><?php echo $short_des;?> <a href="<?php echo 'fancybox/'.$fancyboxDetail->row()->id.'/'.url_title($fancyboxDetail->row()->name);?>"><?php if($this->lang->line('fancy_more') != '') { echo stripslashes($this->lang->line('fancy_more')); } else echo "more"; ?></a></p>

						

					</div>



					<ul class="figure-list after">

					

						<?php 

						$limitCount = 0;

						$imgArr = explode(',', $fancyboxDetail->row()->image);

						if (count($imgArr)>0){

							foreach ($imgArr as $imgRow){

								if ($limitCount>5)break;

								if ($imgRow != '' && $imgRow != $pimg){

									$limitCount++;

						?>

						  <li><a href="<?php echo base_url();?>images/fancyybox/<?php echo $imgRow;?>" data-bigger="<?php echo base_url();?>images/fancyybox/<?php echo $imgRow;?>" style="background-image:url(<?php echo base_url();?>images/fancyybox/<?php echo $imgRow;?>)"></a></li>

						<?php 

								}

							}

						}

						?>

					</ul>

                                        

					<p class="prices">

						<strong class="price"><?php echo $currencySymbol;?><span><?php echo $fancyboxDetail->row()->price;?></span></strong> <?php echo $currencyType;?><br>

						

					</p>

					

					<div class="option-area">

					<?php 

/*					$attributes = unserialize($productDetails->row()->option);

					if (is_array($attributes) && count($attributes)>0 && isset($attributes['attribute_name']) && is_array($attributes['attribute_name'])){

						$attrArr = array();

						$attrKeyArr = array();

						foreach ($attributes['attribute_name'] as $key=>$val){

							if (!in_array($val, $attrArr)){

								array_push($attrArr, $val);

								$attrKeyArr[$val] = $key;

							}else {

								$attrKeyArr[$val] .= ','.$key;

							}

						}

						

						foreach ($attrArr as $attOption){

					?>	

							<label for="option1"><?php echo $attOption;?></label>

							<select style="display: block;visibility:visible;" data-price="0" name="<?php echo 'attr_'.$attOption;?>" id="<?php echo 'attr_'.$attOption;?>" class="option select-white selectBox">

								<option weight="" value="0" >Select</option>

							<?php 

							$attOptions = explode(',', $attrKeyArr[$attOption]);

							if (count($attOptions)>0){

								foreach ($attOptions as $attOptionVal){

							?>

								<option weight="<?php echo $attributes['attribute_weight'][$attOptionVal];?>" value="<?php echo $attributes['attribute_price'][$attOptionVal];?>" ><?php echo $attributes['attribute_val'][$attOptionVal];?></option>

							<?php 

								}

							}

							?>

							</select>

					<?php 

						}

					}

*/					



?>

					

					</div>

                    

				<input type="hidden" class="option number" name="name" id="name" value="<?php echo $fancyboxDetail->row()->name;?>"/>		

				<input type="hidden" class="option number" name="price" id="price" value="<?php echo $fancyboxDetail->row()->price;?>"/>	

                <input type="hidden" class="option number" name="fancybox_id" id="fancybox_id" value="<?php echo $fancyboxDetail->row()->id;?>">

                <input type="hidden" class="option number" name="user_id" id="user_id" value="<?php echo $common_user_id;?>">                

                <input type="hidden" class="option number" name="cateory_id" id="cateory_id" value="<?php echo $fancyboxDetail->row()->category_id;?>">

                <input type="hidden" class="option number" name="image" id="image" value="<?php echo $imgArr[0];?>">

                <input type="hidden" class="option number" name="shipping_cost" id="shipping_cost" value="<?php echo $fancyboxDetail->row()->shipping_cost;?>"> 

                <input type="hidden" class="option number" name="tax" id="tax" value="<?php echo $fancyboxDetail->row()->tax;?>">

                <input type="hidden" class="option number" name="seourl" id="seourl" value="<?php echo $fancyboxDetail->row()->seourl;?>">



				<input type="button" class="greencart add_to_cart" <?php if ($loginCheck==''){echo 'require_login="true"';}?> name="subscribe" id="subscribe" value="<?php if($this->lang->line('fancy_subscirbe') != '') { echo stripslashes($this->lang->line('fancy_subscirbe')); } else echo "Subscribe"; ?>" onclick="javascript:ajax_add_cart_subcribe();" />

                



					

					

					<hr>

                    

					<ul class="thing-info">

<?php 

	$img = 'dummyProductImage.jpg';

		$imgArr = explode(',', $fancyboxDetail->row()->image);

		if (count($imgArr)>0){

			foreach ($imgArr as $imgRow){

				if ($imgRow != ''){

					$img = $pimg = $imgRow;

					break;

				}

			}

		}

		$ownClass = '';

		if ($loginCheck != ''){

			$ownArr = explode(',', $userDetails->row()->own_products);

			if (in_array($fancyboxDetail->row()->id, $ownArr)){

				$ownClass = 'own-selected';

			}

		}

?>

						<li><a href="fancybox/<?php echo $fancyboxDetail->row()->id;?>/<?php echo url_title($fancyboxDetail->row()->name,'-');?>" id="show-someone" class="show" uid="<?php echo $loginCheck;?>" tid="<?php echo $fancyboxDetail->row()->id;?>" tname="<?php echo $fancyboxDetail->row()->name;?>" tuser="<?php if ($fancyboxDetail->row()->user_id != '0'){echo $fancyboxDetail->row()->full_name;}else {echo 'administrator';}?>" data-timage="<?php //echo base_url();?>images/fancyybox/<?php echo $img;?>" price="<?php echo $fancyboxDetail->row()->price;?>" reacts="<?php echo $fancyboxDetail->row()->likes;?>" username="<?php if ($loginCheck != ''){if (count($userDetails)>0){echo $userDetails->row()->user_name;}}?>" action="buy" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i></i>Share</a></li>

<!-- 						<li><a href="#" onclick="" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" class="list" id="show-add-to-list"><i></i>Add to list</a></li>

						<li><a href="#" tid="<?php echo $fancyboxDetail->row()->id;?>" class="<?php if (count($userDetails)>0){if ($fancyboxDetail->row()->id == $userDetails->row()->feature_product){ echo 'feature-selected';}else {echo 'feature';}}else {echo 'feature';}?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" tid="<?php echo $fancyboxDetail->row()->id;?>"><i></i>Feature on my profile </a></li>

						<li><a href="#" class="own <?php echo $ownClass;?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" tid="<?php echo $fancyboxDetail->row()->id;?>"><i></i>I own it</a></li>

						<li><a href="#" class="color"><i></i>Find similar colors</a></li>

 -->                        



                    </ul>

<!--                     

					<a href="#" class="report-link" <?php if ($loginCheck==''){?>require_login="true"<?php }?>><i class="ic-report"></i>Report</a>

 -->					<hr>

					

					

					

				</section>

          

				<!-- / thing-section -->

				<hr>

			</aside>

			<!-- / sidebar -->

		</div>

		<!-- / wrapper-content -->

<?php 

     $this->load->view('site/templates/footer_menu');

     ?>

		

		<a href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>



	</div>

	<?php 

	}else {

	?>

	<p><?php if($this->lang->line('fancy_prod_unavail') != '') { echo stripslashes($this->lang->line('fancy_prod_unavail')); } else echo "This product details not available"; ?></p>

	<?php }?>

	<!-- / container -->

</div>



</div>



<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filesjquery_zoomer.js" type="text/javascript"></script>

<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>selectbox.js"></script>

<script type="text/javascript" src="js/site/thing_page.js"></script>

<script type="text/javascript">

function increaseQty(){

	var oldQty = $('#quantity').val();

	if(oldQty-oldQty != 0){

		oldQty = 0;

	}

	if(oldQty<0){

		oldQty = 0;

	}

	oldQty++;

	$('#quantity').val(oldQty);

	$('#popup-sale-quantity').val(oldQty);

}

function decreaseQty(){

	var oldQty = $('#quantity').val();

	if(oldQty-oldQty != 0){

		oldQty = 1;

	}

	if(oldQty<0){

		oldQty = 1;

	}

	if(oldQty>1){

		oldQty--;

	}

	if(oldQty<1){

		oldQty = 1;

	}

	$('#quantity').val(oldQty);

	$('#popup-sale-quantity').val(oldQty);

}

function changeAttrPrice(attr){

	var sale_price = $('#original_sale_price').val();

//	var old_price = $('#attr_'+attr).data('price');

	var attr_price = $('#attr_'+attr).val();

	if(attr_price == 0){

		attr_price = sale_price;

	}

//	var new_price = (parseInt(sale_price)-parseInt(old_price))+parseInt(attr_price);

//	$('#price').val(new_price);

	$('#price').val(attr_price);

//	$('#attr_'+attr).data('price',attr_price);

//	$('p.prices').find('span').text(new_price);

	$('p.prices').find('span').text(attr_price);

}

function changeAttrPricePopup(attr){

	var sale_price = $('#original_sale_price').val();

//	var old_price = $('#attr_'+attr).data('price');

	var attr_price = $('.attr_'+attr).val();

	if(attr_price == 0){

		attr_price = sale_price;

	}

//	var new_price = (parseInt(sale_price)-parseInt(old_price))+parseInt(attr_price);

//	$('#price').val(new_price);

	$('#price').val(attr_price);

//	$('#attr_'+attr).data('price',attr_price);

//	$('p.prices').find('span').text(new_price);

	$('p.prices').find('span').text(attr_price);

	$('p.price').find('span.popup_price').text(attr_price);

}

function changeAttrArr(attr){

	var attr_val = $('#attr_'+attr+' :selected').text();

	var attrStr = $('#attribute_values').val();

	var attrArr = attrStr.split("|");

	

	if(attrArr == ''){

		attrArr = new Array();

	}

	attrArr[attr] = attr_val;

//	$('#attribute_values').val(attrArr[]);

}

</script>

<?php

$this->load->view('site/templates/footer');

?>