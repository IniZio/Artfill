
<?php 
$this->load->view('site/templates/header');
$this->load->model('product_model');
$this->load->model('user_model');
?>
		<div class="add_steps shop-menu-list">
			<div class="main">
				<?php $this->load->view('site/user/sidebar');?> 
			</div>
		</div>
<div id="seller_div">
<section class="container">
    <div class="main">
        <div class="community_page">
            <ul id="breadcrumbs" class="clear">
                <li>
                    <a itemprop="url" href="<?php echo base_url();?>"><span itemprop="title"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo 'Home'; ?></span></a>
                    <span class="separator">›</span>            
                </li>
                <li> <?php echo $viewprofile->row()->full_name." ".$viewprofile->row()->last_name;?><?php if($this->lang->line('user_profiles') != '') { echo stripslashes($this->lang->line('user_profiles')); } else echo "'s profile"; ?>  </li>

            </ul>

            <div class="community_div">


                <div class="community_right" style="float:left">

                    <div class="split_prefile">

                        <h2><?php echo $viewprofile->row()->full_name." ".$viewprofile->row()->last_name;?><?php if($this->lang->line('user_profiles') != '') { echo stripslashes($this->lang->line('user_profiles')); } else echo "'s profile"; ?></h2>
						
						<!--<a href="#" class="follow-new"><div class="search-bt col-md-6 col-xs-4 op-bt">Follow</div></a>-->

                        <?php if($viewprofile->row()->id==$this->session->userdata['shopsy_session_user_id']){?>

                        <a href="public-profile" class="button_view" ><?php if($this->lang->line('edit_profile') != '') { echo stripslashes($this->lang->line('edit_profile')); } else echo "Edit Profile"; ?></a><?php }?>

                        <div class="clear"></div>

                        <div class="close_content">

                        </div>

                    </div>

                    <div class="primary">                        

                        <div class="primary-left">

                            <div class="section">

                                <div id="bio" class="profile-module clear about_liv ">

                                    <div>

                                        <h3><?php if($this->lang->line('user_about') != '') { echo stripslashes($this->lang->line('user_about')); } else echo "About"; ?></h3>

                                        <p class="wrap"> <?php echo $viewprofile->row()->about;?></p>

                                        <ul class="extra wrap">

                                            <li><?php echo $viewprofile->row()->gender;?></li>

                                            <li><?php if($this->lang->line('user_joined') != '') { echo stripslashes($this->lang->line('user_joined')); } else echo "Joined"; ?>&nbsp;<?php echo date("F d Y",strtotime($viewprofile->row()->created));?></li>

                                        </ul>

                                    </div>

                                        <?php if($viewprofile->row()->favorite_materials!=''){?>

                                        <h3><?php if($this->lang->line('fav_material') != '') { echo stripslashes($this->lang->line('fav_material')); } else echo "Favorite materials"; ?></h3>

                                        <br>

                                        <?php 

										$favMeterials=@explode(',',$viewprofile->row()->favorite_materials); 

										if(!empty($favMeterials)){

											foreach($favMeterials as $fM){

										?>

                                        <a href="search/all?item=<?php echo $fM; ?>"><?php echo $fM; ?></a>,

                                        <?php } } } ?>

                                    </div>

                                </div>  

                             <?php if(!empty($ownProduct)){ ?>

                     		<div class="section border_blu">                  

                                <div id="bio" class="profile-module clear shop_live ">

                                    <div>

                                    	<?php if($loginCheck==$ownShop[0]['seller_id']){ $shopMore='shop/sell';}else{$shopMore='shop-section/'.$ownShop[0]['seourl'];} ?>

                                    	<h3>

                                        	<?php if($this->lang->line('user_list_shop') != '') { echo stripslashes($this->lang->line('user_list_shop')); } else echo "Shop"; ?>

                                        </h3>

                                        <a class="more" href="<?php echo $shopMore; ?>">

                                        	<?php if($this->lang->line('see_more') != '') { echo stripslashes($this->lang->line('see_more')); } else echo "See more"; ?>

                                        </a> 

                                    </div>

                                    <ul class="recent_list">

                                    	<?php $pC=0; foreach($ownProduct as $product){ $pC++; ?>

                                        <li>

                                            <a href="products/<?php echo $product['seourl']; ?>">

                                            	<?php $imgArr=@explode(',',$product['image']); ?>

                                            	<img title="<?php echo $product['product_name']; ?>" alt="<?php echo $product['product_name']; ?>" src="images/product/list-image/<?php echo $imgArr[0]; ?>">

                                            </a>

                                        </li>

                                        <?php if($pC==12)break; } ?>

                                   </ul>

                                </div>            

  							</div>

                            <?php } ?>                                  

                        </div> 

                        <div class="primary-right">

                        	<?php if(!empty($userFavoriteItems)){ ?>

                            <div class="section">                                

                                <div id="bio" class="profile-module clear favorits_live ">

                                    <div>

                                        <h3><?php if($this->lang->line('user_fav_items') != '') { echo stripslashes($this->lang->line('user_fav_items')); } else echo "Favorite items"; ?></h3><a class="more" href="people/<?php echo $viewprofile->row()->user_name;?>/favorites"> <?php if($this->lang->line('see_more') != '') { echo stripslashes($this->lang->line('see_more')); } else echo "See more"; ?> </a> 

                                    </div>

                                    <?php if(!empty($userFavoriteItems)){ ?>

                                    <ul class="seller-links">

                                           <a href="people/<?php echo $viewprofile->row()->user_name;?>/favorites/items-i-love">

                                           	<span class="items_text"><?php if($this->lang->line('user_itmes_i_love') != '') { echo stripslashes($this->lang->line('user_itmes_i_love')); } else echo "Items I Love"; ?></span>

                                           </a>

                                           <?php $ilu=0; foreach($userFavoriteItems as $favItems){ $ilu++; ?>

                                            <li>

                                                <a href="products/<?php echo $favItems['seourl']; ?>">

                                                    <div class="seller-outer">

                                                        <div class="seller-inner">

                                                        <?php $imgArr=@explode(',',$favItems['image']); ?>

                                                        	<img src="images/product/<?php echo $imgArr[0]; ?>" alt="<?php echo $favItems['product_name']; ?>" title="<?php echo $favItems['product_name']; ?>">

                                                        </div>

                                                    </div>

                                                </a>

                                            </li>

                                            <?php if($ilu==3)break; } ?>

                                            <li>

                                                <a href="people/<?php echo $viewprofile->row()->user_name;?>/favorites/items-i-love">

                                                    <div class="seller-outer count-box">

                                                        <div class="seller-inner">

                                                            <span class="count-number"><?php echo count($userFavoriteItems); ?></span>

                                                            <?php if($this->lang->line('user_items') != '') { echo stripslashes($this->lang->line('user_items')); } else echo "items"; ?>

                                                        </div>

                                                    </div>

                                                </a>

                                            </li>

                                    </ul>

                                    <?php } ?>

                                    <?php if(!empty($userListDetails)){ $favListC=0; foreach($userListDetails as $favList){ if($favList['privacy']!='Private' && $favList['product_count'] > 0){ $favListC++; ?>

                                    <ul class="seller-links" style="margin: 15px 0 0;">

                                           <a href="people/<?php echo $viewprofile->row()->user_name;?>/favorites/list/<?php echo $favList['id'].'-'.$favList['name']; ?>">

                                           	<span class="items_text"><?php echo $favList['name']; ?></span>

                                           </a>

                                           <?php if($favList['product_count']>2){$cond=3;}else{$cond=$favList['product_count'];} ?>

                                           <?php 

												$prdArr=explode(',',$favList['product_id']); 

												for($j=0;$j<$cond && $prdArr[$j] !='';$j++) {

													$haveListIn = $this->user_model->get_list_products(stripslashes($prdArr[$j]),$favList['id'])->result_array();

													$prdimgList=explode(',',$haveListIn[0]['image']); 

											?>

                                            <li>

                                                <a href="products/<?php echo $haveListIn[0]['seourl']; ?>">

                                                    <div class="seller-outer">

                                                        <div class="seller-inner">

                                                        

                                                        	<img src="images/product/list-image/<?php echo $prdimgList[0]; ?>" alt="<?php echo $haveListIn[0]['product_name']; ?>" title="<?php echo $haveListIn[0]['product_name']; ?>">

                                                        </div>

                                                    </div>

                                                </a>

                                            </li>

                                            <?php } ?>

                                            <li>

                                                <a href="people/<?php echo $viewprofile->row()->user_name;?>/favorites/list/<?php echo $favList['id'].'-'.$favList['name']; ?>">

                                                    <div class="seller-outer count-box">

                                                        <div class="seller-inner">

                                                            <span class="count-number"><?php echo $favList['product_count']; ?></span>

                                                            <?php if($this->lang->line('user_items') != '') { echo stripslashes($this->lang->line('user_items')); } else echo "items"; ?>

                                                        </div>

                                                    </div>

                                                </a>

                                            </li>

                                    </ul>

                                    <?php if($favListC==2)break; } } } ?>

                                </div>     

                            </div>

                            <?php } ?>

                            <?php if(!empty($userFavoriteShops)){ ?>

                            <div class="section">                                                        

                                <div id="bio" class="profile-module clear fav_shop_live ">

                                    <div>

                                        <h3><?php if($this->lang->line('user_fav_shops') != '') { echo stripslashes($this->lang->line('user_fav_shops')); } else echo "Favorite shops"; ?></h3><a class="more" href="people/<?php echo $viewprofile->row()->user_name;?>/favorites/shop"> <?php if($this->lang->line('see_more') != '') { echo stripslashes($this->lang->line('see_more')); } else echo "See more"; ?> </a> 

                                    </div>

                                    <?php $fshop=0; foreach($userFavoriteShops as $favShop){ $fshop++; ?>

                                    <ul class="seller-links" style="margin: 15px 0 0;">

                                       	<a href="shop-section/<?php echo $favShop['seourl']; ?>"><span class="items_text"><?php echo $favShop['seller_businessname']; ?></span> </a>

                                         <?php $fshopPrd=0; foreach($userFavoriteShopsProducts[$favShop['seller_id']] as $favShopPrd){ $fshopPrd++; ?>

                                        <li>

                                            <a href="products/<?php echo $favShopPrd['seourl']; ?>">

                                                <div class="seller-outer">

                                                    <div class="seller-inner">

                                                    <?php $imgArr=@explode(',',$favShopPrd['image']); ?>

                                                    	<img src="images/product/list-image/<?php echo $imgArr[0]; ?>" alt="<?php echo $favShopPrd['product_name']; ?>" title="<?php echo $favShopPrd['product_name']; ?>">

                                                    </div>

                                                </div>

                                            </a>

                                        </li>

                                        <?php if($fshopPrd==3)break; } ?>

                                        <li>

                                            <a href="shop-section/<?php echo $favShop['seourl']; ?>">

                                                <div class="seller-outer count-box">

                                                    <div class="seller-inner">

                                                        <span class="count-number"><?php echo count($userFavoriteShopsProducts[$favShop['seller_id']]); ?></span>

                                                        <?php if($this->lang->line('user_items') != '') { echo stripslashes($this->lang->line('user_items')); } else echo "items"; ?>

                                                    </div>

                                                </div>

                                            </a>

                                        </li>

                                	</ul> 

                                    <?php if($fshop==3)break; } ?>

                                </div>                                            

                            </div>

                            <?php } ?>

  						</div>   

                  		</div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
</div>
<?php 

$this->load->view('site/templates/footer');

?>

