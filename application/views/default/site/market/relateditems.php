<?php 

$this->load->view('site/templates/header');

$this->load->model('user_model');

?>

<section class="container">

    <div class="main">

    <?php if(!empty($popularItems)) { ?>

        <div class="container market">

            <div class="product_box">

                <div class="popular-item-box">

                    <h1>

                        <?php if($this->lang->line('market_popular') != '') { echo stripslashes($this->lang->line('market_popular')); } else echo 'Popular items for'; ?>

                        <strong><span class="linetext"><?php echo $searchTag; ?></span></strong>

                    </h1>

                    <a href="<?php echo base_url().'search/all?item='.$searchTag; ?>"><?php if($this->lang->line('market_seeall') != '') { echo stripslashes($this->lang->line('market_seeall')); } else echo 'See All'; ?></a>

                </div>

                <!--<div class="related-item">

                    <ul class="relatedlist">                        

                        <li><a href="">kjhsdf</a></li>                  

                    </ul>

                </div>-->

                

                <ul class="product_listing">

                <?php for($i=0;$i<count($popularItems); $i++){ $hover=$i+1;?>

                    <li>

                        <div class="product_img">

                        	<div class="product_hide">

                                <div class="product_fav">

                                	<?php if($loginCheck !=''){
										if($popularItems[$i]['user_id']==$loginCheck){ ?>
											<a href="javascript:void(0);" onclick="return ownProductFav();"> 
												<input type="submit" value="" class="hoverfav_icon" />
											</a>
										<?php
										}else{

									$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($popularItems[$i]['id']));

									#print_r($favArr); die;

									if(empty($favArr)){ ?>

									<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($popularItems[$i]['id']); ?>','Fresh',this);">

									<input type="submit" value="" class="hoverfav_icon" />

									</a>

									<?php  } else { ?>                        

									<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($popularItems[$i]['id']); ?>','Old',this);">

									<input type="submit" value="" class="hoverfav_icon1" />

									</a>

									<?php }}} else { ?>

									<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($popularItems[$i]['id']); ?>','Fresh',this);">

									<input type="submit" value="" class="hoverfav_icon" />

									</a>

								   <?php  } ?>

                                	<div class="hoverdrop_icon">

                                        <a href="javascript:hoverView('<?php echo $hover; ?>');"></a>

                                         <div class="hover_lists" id="hoverlist<?php echo $hover; ?>">

                                             <h2><?php if($this->lang->line('user_your_lists') != '') { echo stripslashes($this->lang->line('user_your_lists')); } else echo 'Your Lists'; ?></h2> 

                                                <div class="lists_check">

                                                <?php foreach($userLists as $Lists){ 

                                                $haveListIn = $this->user_model->check_list_products(stripslashes($popularItems[$i]['id']),$Lists['id'])->num_rows();

                                                #echo $haveListIn;

                                                if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}

                                                ?>

                                                <input type="checkbox" class="check_box" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo stripslashes($popularItems[$i]['id']); ?>');" <?php echo $chk; ?> />

                                                <label><?php echo $Lists['name']; ?></label>

                                                <?php } ?>

                                                </div>                                                    

                                                <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="<?php echo $popularItems[$i]['id']; ?>" name="productId" />

                                                        <input type="text" placeholder="<?php if($this->lang->line('user_new_list') != '') { echo stripslashes($this->lang->line('user_new_list')); } else echo 'New list'; ?>" class="list_scroll" name="list" id="creat_list_<?php echo $i; ?>" />

                                                        <input type="submit" value="<?php if($this->lang->line('user_add') != '') { echo stripslashes($this->lang->line('user_add')); } else echo 'Add'; ?>" class="primary-button" onclick="return validate_create_list('<?php echo $i; ?>');" />

                                                    </form>

                                                </div>   

                                         </div>

                                    </div>

                                </div>

                            </div>

                            <?php $Images=explode(',',$popularItems[$i]['image']); ?>

                            <a href="products/<?php echo $popularItems[$i]['seourl'] ?>">

                        		<img src="images/product/<?php echo $Images[0]?>" alt="Product-1" title="Product-1" />

                            </a>

                        </div>

                    	<div class="product_title">

                        	<a href="products/<?php echo $popularItems[$i]['seourl'] ?>"><?php echo $popularItems[$i]['product_name'] ?></a>

                        </div>

                    	<div class="product_maker">

                        	<a href="shop-section/<?php echo $popularItems[$i]['shop_seourl'];?>"><?php echo $popularItems[$i]['shop_name'];?></a>

                        </div>

                        <div class="product_price">

                            <span class="currency_value"><?php echo $currencySymbol; if($popularItems[$i]['price'] != 0.00) { echo $currencyValue*$popularItems[$i]['price']; } else { echo $currencyValue*$popularItems[$i]['pricing']; echo '+'; }?></span>

                            <span class="currency_code"><?php echo $currencyType;?></span>

                        </div>

                    </li>

                <?php } ?>

                </ul>                

            </div>

            <!--<div class="product_box">

            	<span class="related-clothig">Related to <b> clothing</b></span>

                <div class="related-items">

                    <h3>dress lot</h3>

                    <a href="/market/dress_lot?ref=market">See more </a> 

                    <ul>

                        <li><a href="#"><img src="images/11173785393_18175be3bc_z.jpg" /></a></li>

                        <li><a href="#"><img src="images/11173785393_18175be3bc_z.jpg" /></a></li>

                        <li><a href="#"><img src="images/11173785393_18175be3bc_z.jpg" /></a></li>

                        <li><a href="#"><img src="images/11173785393_18175be3bc_z.jpg" /></a></li>

                        <li><a href="#"><img src="images/11173785393_18175be3bc_z.jpg" /></a></li>

                        <li><a href="#"><img src="images/11173785393_18175be3bc_z.jpg" /></a></li>

                        <li><a href="#"><img src="images/11173785393_18175be3bc_z.jpg" /></a></li>

                        <li><a href="#"><img src="images/11173785393_18175be3bc_z.jpg" /></a></li>

                        <li><a href="#"><img src="images/11173785393_18175be3bc_z.jpg" /></a></li>

                    </ul>

                </div>

            </div>-->

            <!--<div class="product_box">

                <div class="cetermarkt">

                    <div class="product_box-container">

                        <h3><b>Want to see more?</b>Browse <?php echo $this->config->item('email_title'); ?> for awesome items.</h3>

                        <ul>

                            <li><img src="images/1.jpg" />

                            <a>Art</a></li>

                            <li><img src="images/1.jpg" />

                            <a>Art</a></li>

                            <li><img src="images/1.jpg" />

                            <a>Art</a></li>

                            <li><img src="images/1.jpg" />

                            <a>Art</a></li>

                            <li><img src="images/1.jpg" />

                            <a>Art</a></li>

                        </ul>

                    </div>

                </div>

            </div>-->

        </div>

    <?php }else { ?>

    <div style="margin:20px 0" class="search-error">

        <h3 class="crumbs"> <?php if($this->lang->line('prod_crumbs') != '') { echo stripslashes($this->lang->line('prod_crumbs')); } else echo 'Oh crumbs'; ?>! </h3>

        <p class="newline">

        <?php if($this->lang->line('market_popular') != '') { echo stripslashes($this->lang->line('market_popular')); } else echo "We couldn't find any popular items for"; ?>

        <span style="font-weight:bold"><?php echo $searchTag;?></span>

        </p>

    </div>

    <?php } ?>

    </div>

</section>







<?php 

$this->load->view('site/templates/footer');

?>

<script>

$(document).ready(function(){

  $(".hoverdrop_icon").click(function(){  

    $("#hoverlist1").toggle();

  });

});   



</script>