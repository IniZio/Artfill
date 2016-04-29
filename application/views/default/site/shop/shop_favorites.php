<?php 

$this->load->view('site/templates/header'); 

#echo "<pre>"; print_r($productDetails->row()); die;

?>

<div class="clear"></div>
<section class="container">

    <div class="main">

    	<ul class="breadcrumb_top">

            <li><a href="<?php base_url; ?>"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo 'Home'; ?></a></li>

            <li>></li>

            <li><a href="<?php base_url; echo 'shop-section/'.$shopInfo[0]['seourl']; ?>"><?php echo $shopInfo[0]['seller_businessname'] ?></a></li>

            <li>></li>

            <li><?php if($this->lang->line('shop_favoriters') != '') { echo stripslashes($this->lang->line('shop_favoriters')); } else echo 'Favoriters'; ?></li>

        </ul>

        <div class="listing-favorite">

        	<h2><?php if($this->lang->line('shop_favoritedthis') != '') { echo stripslashes($this->lang->line('shop_favoritedthis')); } else echo 'Who favorited this'; ?>? <span style="color:#000; font-weight:bold"><?php echo count($favoritersUserfavProdDetails); ?> <?php if($this->lang->line('shop_admire') != '') { echo stripslashes($this->lang->line('shop_admire')); } else echo 'people admire this shop'; ?></span></h2>

            <div class="listing-favorite-left">

                <div class="listing-favorite-left-container">

                	<?php if($shopInfo[0]['thumbnail']!=''){ $profile_pic='users/thumb/'.$shopInfo[0]['thumbnail']; } else { $profile_pic='default_avat.png';}?>

                    <a href="shop-section/<?php echo $shopInfo[0]['seourl']; ?>"><img style="width:100px" src="images/<?php echo $profile_pic; ?>" /></a>

                    <p><a href="shop-section/<?php echo $shopInfo[0]['seourl']; ?>"><?php echo $shopInfo[0]['seller_businessname'] ?></a></p>

                    <p ><?php echo $shopInfo[0]['shop_title']; ?></p>

                </div>

                <div class="listing-favorite-left-botttom">

                	

                    <div class="fav-btn" style="margin:0">

                    <?php if($loginCheck !=''){

					$favArr = $this->product_model->getUserFavoriteShopDetails($shopInfo[0]['seller_id']);

					#print_r($favArr); die;

					if(empty($favArr)){ ?>

					<a href="javascript:void(0);" onclick="return changeShopToFavourite('<?php echo $shopInfo[0]['seller_id'] ?>','Fresh');">

					<span class="fav-icon"></span>

					<span class="status-txt"><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?></span>

					</a>

					<?php  } else { ?>                        

					<a href="javascript:void(0);" onclick="return changeShopToFavourite('<?php echo $shopInfo[0]['seller_id'] ?>','Old');">

					<span class="fav-icon-sel"></span>

					<span class="status-txt"><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?></span>

					</a>

					<?php }} else { ?>

                    <form action="login" method="get" id="my_form">

                        <input type="hidden" value="<?php echo 'shops/'.$shopInfo[0]['seourl'].'/favoriters'; ?>" name="action" />

                        <a onclick="document.getElementById('my_form').submit();"><span class="fav-icon"></span><span class="status-txt"><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?></span></a>

                    </form>

					<?php  } ?>

                    </div>

                    

                </div>

            </div>

            <div class="listing-favorite-right">

            	<?php 

				if(empty($favUserList))

				{

				?>

                <div style="margin:40px 0 0 0" class="outer_tab1">

                    <div class="outer_tab_2">

                        <div class="tab_content">

                        <h1><?php if($this->lang->line('shop_nooneadmire') != '') { echo stripslashes($this->lang->line('shop_nooneadmire')); } else echo "No one's admire this shop"; ?> </h1>

                        </div>

                    </div>

                </div>

                <?php } else { ?>

                <?php #echo print_r($favUserList);

				for($i=0;$i<count($favUserList);$i++){

					foreach($favoritersUserfavProdDetails as $favoritersUser){

						for($i=0;$i<count($favUserList);$i++){

							if($favoritersUser[$i]['user_id']==$favUserList[$i]['user_id']){

								#echo $favoritersUser[$i]['user_id']; echo '/',$favUserList[$i]['user_id'];

								#echo "<pre>"; print_r($favoritersUserfavDetails); die;

					#echo "<pre>";print_r($favoritersUser); print_r($favoritersUserfavDetails[$favUserList[$i]['user_id']]); die;												

				?>

                <?php if($favUserList[$i]['thumbnail']!=''){ $profile_pic='users/thumb/'.$favUserList[$i]['thumbnail']; } else { $profile_pic='default_avat.png';}?>

                <ul class="seller-links" style="margin: 15px 0px 0px; ">                

                    <li style="border: 1px solid #EFEFEF;float: left;   min-width: 302px;  padding: 15px 10px;">

                        <a href="view-profile/<?php echo $favUserList[$i]['user_name']; ?>"><img src="images/<?php echo $profile_pic; ?>" class="folower_img"> </a>

                        <h6 class="follow-name"><a href="view-profile/<?php echo $favUserList[$i]['user_name']; ?>"><?php echo $favUserList[$i]['full_name']; ?></a></h6>

                        <span class="follow-num"><?php if($this->lang->line('user_followers') != '') { echo stripslashes($this->lang->line('user_followers')); } else echo "Followers"; ?>:<?php echo $favUserList[$i]['followers_count']; ?></span>

                        

                        <?php $followingListArr=array(); if($favUserList[$i]['id']!=$this->session->userdata['shopsy_session_user_id']){

						if(!empty($this->session->userdata['shopsy_session_user_name'])){

							$followingListArr = explode(',', ltrim($favUserList[$i]['followers'],','));

						}	

						#echo "<pre>"; print_r($followingListArr); die;

						if(!empty($followingListArr)){

						if (in_array($this->session->userdata['shopsy_session_user_id'], $followingListArr)){	

						?>

                        <label class="follow_nam" onclick='add_delete_follow("delete_follow","<?php echo $favUserList[$i]['id'];?>");'><?php if($this->lang->line('user_following') != '') { echo stripslashes($this->lang->line('user_following')); } else echo "Following"; ?></label>

                        <?php } if (!in_array($this->session->userdata['shopsy_session_user_id'], $followingListArr)) { ?>

                        <label class="follow_nam" onclick='add_delete_follow("add_follow","<?php echo $favUserList[$i]['id'];?>");'><?php if($this->lang->line('user_follow') != '') { echo stripslashes($this->lang->line('user_follow')); } else echo "Follow"; ?></label>

                        <?php } }else{?>

                        <label class="follow_nam" onclick="javascript:alert('Login Required');"><?php if($this->lang->line('user_follow') != '') { echo stripslashes($this->lang->line('user_follow')); } else echo "Follow"; ?></label>

                        <?php } } ?>

                    </li>

                    <?php #echo count($followingUserfavProdDetails[$followersArr[$i]]);

					if($favUserList[$i]['favorites_visibility']=='Public'){

					?>

                    <?php if(count($favoritersUserfavProdDetails[$favUserList[$i]['user_id']])>3){$cond=4;}else{$cond=count($favoritersUserfavProdDetails[$favUserList[$i]['user_id']]);} ?>

                    <?php  for($l=0;$l<$cond;$l++) {

					$img=explode(',',$favoritersUserfavProdDetails[$favUserList[$i]['user_id']][$l]['image']); 

					?>

                    <li>

                        <a href="products/<?php echo $favoritersUserfavProdDetails[$favUserList[$i]['user_id']][$l]['pseourl']; ?>">

                            <div class="seller-outer">

                                <div class="seller-inner">

                                	<img src="images/product/thumb/<?php echo $img[0]; ?>" width="75" height="75">

                                </div>

                            </div>

                        </a>

                    </li>

					<?php }   ?>

                    <li>

                        <a href="people/<?php echo $favUserList[$i]['user_name']; ?>/favorites">

                            <div class="seller-outer count-box">

                                <div class="seller-inner">

                                    <span class="count-number"><?php echo $favoritersUserfavDetails[$favUserList[$i]['user_id']]->num_rows; ?></span>

                                    <?php if($this->lang->line('user_favorites') != '') { echo stripslashes($this->lang->line('user_favorites')); } else echo 'Favorites'; ?>

                                </div>

                            </div>

                        </a>

                    </li>

                    <?php } else{ ?>

                    <li>

                	<div >

                   <p style="margin: 30px 0px 0px 40px;">

                    <span class="lock_img"></span>

                    <a href="view-profile/<?php echo $favUserList[$i]['user_name']; ?>"><?php echo $favUserList[$i]['full_name']; ?>'s</a>

                    <?php if($this->lang->line('user_fav_r_pvt') != '') { echo stripslashes($this->lang->line('user_fav_r_pvt')); } else echo "favorites are private"; ?>.

                    </p>

                	</div>

            		</li>

                    <?php } ?>

                </ul>

                <?php

								}

							}

						}

					}

				?>

                <?php } ?>

            </div>

        </div>

    </div>

</section>

<?php 

     $this->load->view('site/templates/footer');

?>