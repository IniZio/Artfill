<?php 

$this->load->view('site/templates/header');

$this->load->model('user_model');

?>

<script src="js/site/jquery_ajax.js"> </script>

<script src="js/site/scrolling_javascript.js"> </script>

<script>

$(document).ready(function() {

	$('#activities').scrollPagination({

		nop     : 5, // The number of posts per scroll to be loaded

		offset  : 10, // Initial offset, begins at 0 in this case

		error   : '', // When the user reaches the end this is the message that is

		                            // displayed. You can change this if you want.

		path   : 'site/user/ajax_activity_shop',

		delay   : 500, // When you scroll down the posts will load after a delayed amount of time.

		               // This is mainly for usability concerns. You can alter this as you see fit

		scroll  : true // The main bit, if set to false posts will not load as the user scrolls. 

		               // but will still load if the user clicks.		

	});	

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

</style>

<section class="container">

    <div class="main">     

        <div class="container">

            <div class="top_list">

            <a class="title-head2-bold" href="home">

            	<?php if($this->lang->line('your-feed') != '') { echo stripslashes($this->lang->line('your-feed')); } else echo "Your Feed"; ?>

            </a>

                <ul style="width:auto;" class="listtypename">

                    <li class="first_list3">

                    	<a class="top_first_line " href="<?php echo base_url().'activity'; ?>">

                        	<?php if($this->lang->line('user_following') != '') { echo stripslashes($this->lang->line('user_following')); } else echo "Following"; ?>

                        </a>

                    </li>

                    <li class="first_list2">

                    	<a class="top_first_line" href="<?php echo base_url().'activity/interaction'; ?>"> 

                        	<?php if($this->lang->line('interactions') != '') { echo stripslashes($this->lang->line('interactions')); } else echo "Interactions"; ?>

                        </a>

                    </li>

                    <li class="first_list first_list_seleted">

                    	<a class="top_first_line" href="<?php echo base_url().'activity/shop'; ?>"> 

                        	<?php if($this->lang->line('you-shop') != '') { echo stripslashes($this->lang->line('you-shop')); } else echo "You Shop"; ?>

                        </a>

                    </li>

                </ul>

                <ul class="owner-activity">

                    <li>

                        <a href="people/<?php echo stripslashes($userProfileDetails[0]['user_name']); ?>/followers">

                            <span class="fav-number"><?php echo stripslashes($userProfileDetails[0]['followers_count']); ?></span>

                            <span class="fav-name">

                            	<?php if($this->lang->line('user_followers') != '') { echo stripslashes($this->lang->line('user_followers')); } else echo "Followers"; ?>

                            </span>

                        </a>

                    </li>

                    <li>

                        <a href="people/<?php echo stripslashes($userProfileDetails[0]['user_name']); ?>/following">

                            <span class="fav-number"><?php echo stripslashes($userProfileDetails[0]['following_count']); ?></span>

                            <span class="fav-name"> 

                            	<?php if($this->lang->line('user_followers') != '') { echo stripslashes($this->lang->line('user_followers')); } else echo "Followers"; ?>

                            </span>

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </div>

    

    <div class="favorite favorite_box">

        <div class="main">    

            <div class="clear">&nbsp;</div>       

            <div id="activities">

                <?php if(!empty($myshopactivity)){ ?>     

                <ul id="activity-list">

                <?php $hover=0; $s=0;$l=1; foreach($myshopactivity as $actFav){ ?>

                <?php if($s<3 && $l<4){ $cls="small"; $s++; } else if($s>2 && $l<4){ $cls="large"; $l++;} else {$s=0;$l=1;}?>

                <?php 

				$userProfileDetails= $this->user_model->get_all_details(USERS,array('id'=>$actFav['user_id']))->result_array();

				if($actFav['activity_name']=='Unfavorite item' || $actFav['activity_name']=='favorite item') { 

				$hover++;

					$productDetail = $this->user_model->get_all_details(PRODUCT,array('id'=>$actFav['activity_id']))->row();

					#echo "<pre>"; print_r($productDetail); die;

					$imgArr=explode(',',$productDetail->image);

				?>

                    <li class="activity small-wid <?php echo $cls; ?>">

                        <div class="activity-desc">

                            <div class="activity-avatar trigger-action-toolbox" data-source="hp_tastemaker">

                                <a href="view-profile/<?php echo $userProfileDetails[0]['user_name']; ?>" >

                                	<?php if($userProfileDetails[0]['thumbnail']!=''){ $profile_pic='users/thumb/'.$userProfileDetails[0]['thumbnail']; } else { $profile_pic='default_avat.png';}?>

                                    <img width="75" height="75" src="images/<?php echo $profile_pic; ?>">

                                </a>

                            </div>

                            <p class="activity-name">

                               <?php if($userProfileDetails[0]['id']!=$loginCheck){ echo $userProfileDetails[0]['user_name']; } else { echo 'You';} ?>

                               		<?php if($this->lang->line('favorited') != '') { echo stripslashes($this->lang->line('favorited')); } else echo "favorited"; ?>

                               <a class="member-name" href="products/<?php echo $productDetail->seourl; ?>"> your item.<?php #echo str_replace("item","this item",$actFav['activity_name']); ?>.</a>

                            </p>

                        </div>

                        <div class="activity-favorites  full-wid">

                            <a href="products/<?php echo $productDetail->seourl; ?>" class="activity-full">

                                <img alt="<?php echo $productDetail->product_name; ?>" src="images/product/<?php echo $imgArr[0]; ?>">

                            </a>

                        </div>

                        <div class="story-info clear">

                            <div class="product-dtl"><?php echo $productDetail->product_name; ?></div>

                            <div class="product_fv">

                            	<?php if($loginCheck !=''){ ?>
								<?php if($productDetail->user_id==$loginCheck){ ?>
											<a href="javascript:void(0);" onclick="return ownProductFav();">
												<input type="submit" value="" class="hoverfav_icon" />
											</a>
											<?php
											}else{

                                        $favArr = $this->product_model->getUserFavoriteProductDetails($productDetail->id);

                                        #print_r($favArr); die;

                                        if(empty($favArr)){ ?>

                                        <a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo $productDetail->id; ?>','Fresh',this);">

                                            <input type="submit" value="" class="hoverfav_icon" />

                                        </a>

                                        <?php  } else { ?>                        

                                        <a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo $productDetail->id; ?>','Old',this);">

                                            <input type="submit" value="" class="hoverfav_icon1" />

                                        </a>

                                        <?php }}} else { ?>

                                        <a href="login" class="reg-popup" >

                                            <input type="submit" value="" class="hoverfav_icon" />

                                        </a>

                                <?php  } ?> 

                                <div class="hoverdrop2_icon">

                                    <a href="javascript:hoverView('<?php echo $hover; ?>');">

                                        <div class="hover_lists" id="hoverlist<?php echo $hover; ?>">

                                            <h2><?php if($this->lang->line('user_your_lists') != '') { echo stripslashes($this->lang->line('user_your_lists')); } else echo "Your Lists"; ?></h2> 

                                            <div class="lists_check">

                                            <?php foreach($userLists as $Lists){ 

                                            $haveListIn = $this->user_model->check_list_products(stripslashes($productDetail->id),$Lists['id'])->num_rows();

                                            if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}

                                            ?>

                                            <input type="checkbox" class="check_box" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo $productDetail->id; ?>');" <?php echo $chk; ?> />

                                            <label><?php echo $Lists['name']; ?></label>

                                            <?php } ?>

                                            </div>                                                    

                                            <div class="new_list">

                                                <form method="post" action="site/user/add_list">

                                                    <input type="hidden" value="1" name="ddl" />

                                                    <input type="hidden" value="<?php echo $productDetail->id; ?>" name="productId" />

                                                    <input type="text" placeholder="<?php if($this->lang->line('user_new_list') != '') { echo stripslashes($this->lang->line('user_new_list')); } else echo 'New list'; ?>" class="list_scroll" name="list" id="creat_list_<?php echo $hover; ?>" />

                                                    <input type="submit" value="<?php if($this->lang->line('user_add') != '') { echo stripslashes($this->lang->line('user_add')); } else echo 'Add'; ?>" class="primary-button" onclick="return validate_create_list('<?php echo $hover; ?>');" />

                                                </form>

                                            </div>   

                                        </div>

                                    </a>

                                </div>

                            </div>	

                        </div>

                    </li> 

                <?php }else if($actFav['activity_name']=='Unfavorite shop' || $actFav['activity_name']=='favorite shop') {  ?>                

                <?php 

					$shopproductDetail = $this->user_model->getfavshops_activity($actFav['activity_id'])->result_array();

				?>

                <li class="activity <?php echo $cls; ?>">

                    <div class="activity-desc">

                        <div class="activity-avatar trigger-action-toolbox" data-source="hp_tastemaker">

                            <a href="view-profile/<?php echo $userProfileDetails[0]['user_name']; ?>" >

                                	<?php if($userProfileDetails[0]['thumbnail']!=''){ $profile_pic='users/thumb/'.$userProfileDetails[0]['thumbnail']; } else { $profile_pic='default_avat.png';}?>

                                    <img width="75" height="75" src="images/<?php echo $profile_pic; ?>">

                                </a>

                        </div>

                        <p class="activity-name">

                            <?php if($userProfileDetails[0]['id']!=$loginCheck){ echo $userProfileDetails[0]['user_name']; } else { echo 'You';} ?>

                            	<?php if($this->lang->line('favorited') != '') { echo stripslashes($this->lang->line('favorited')); } else echo "favorited"; ?>

                            <a class="member-name" href="shop-section/<?php echo $shopproductDetail[0]['shopurl']; ?>"> your shop.<?php #echo str_replace("shop","this shop",$actFav['activity_name']); ?></a> 

                        </p>

                    </div>

                    <div class="activity-favorites">

                    	<?php if(count($shopproductDetail)<4){$count=count($shopproductDetail); } else{ $count=4; } for($i=0;$i<$count;$i++){ ?>

                            <a href="shop-section/<?php echo $shopproductDetail[0]['shopurl']; ?>" class="favorite">

                            	<?php $imgArr=explode(',',$shopproductDetail[$i]['image']); ?>

                                <img  width="170" height="135" alt="<?php echo $shopproductDetail[$i]['product_name']; ?>" src="images/product/<?php echo $imgArr[0]; ?>">

                            </a>                        

                        <?php } ?>

                        <?php if($count!=4) {for($j=4-$count;$j<$count;$j++){ ?>

                            <a class="favorite">

                            </a>                        

                        <?php } } ?>

                    </div>

                    <div class="activity-link clear">

                        <div class="activeright">

                            <span class="newimages"></span>

                            <p class="line-type">

								<?php if($this->lang->line('shop') != '') { echo stripslashes($this->lang->line('shop')); } else echo "SHOP"; ?>

                            </p>

                            <p><a class="name_line" href="shop-section/<?php echo $shopproductDetail[0]['shopurl']; ?>"><?php echo $shopproductDetail[0]['shopname']; ?></a></p>

                        </div>

                        <?php if($loginCheck !=''){

                        $favArr = $this->product_model->getUserFavoriteShopDetails($actFav['activity_id']);

                        #print_r($favArr); die;

                        if(empty($favArr)){ ?>

                        <a href="javascript:void(0);" onclick="return changeShopToFavourite('<?php echo $actFav['activity_id']; ?>','Fresh');">

						<input type="submit" value="" class="hoverfav_icon">

                        </a>

                        <?php  } else { ?>                        

                        <a href="javascript:void(0);" onclick="return changeShopToFavourite('<?php echo $actFav['activity_id']; ?>','Old');">

                        <input type="submit" value="" class="hoverfav_icon1">

                        </a>

                        <?php }} else { ?>                                        

                        <input type="submit" value="" class="hoverfav_icon">

                        <?php  } ?> 

                    </div>

                </li>

                <?php } }?>

                </ul>     

                <?php }else { ?>

                <ul class="interactions">

                    <li>

                        <div class="your-shopfeed">

                            <h1><?php if($this->lang->line('activity') != '') { echo stripslashes($this->lang->line('activity')); } else echo "Darn, there's no activity yet."; ?></h1>

                            <p><?php if($this->lang->line('more-visible') != '') { echo stripslashes($this->lang->line('more-visible')); } else echo "The more active your shop, the more visible it is to buyers."; ?></p>

                            <p>

                            	<?php if($this->lang->line('check-out') != '') { echo stripslashes($this->lang->line('check-out')); } else echo "Check out"; ?>

                            	<a href="javascript:void(0);">

                                <?php if($this->lang->line('seller') != '') { echo stripslashes($this->lang->line('seller')); } else echo "seller central"; ?>

                                </a>

                                <?php if($this->lang->line('improving') != '') { echo stripslashes($this->lang->line('improving')); } else echo "for tips on improving your"; ?>

								<?php echo $this->config->item('email_title'); ?>

                                <?php if($this->lang->line('business') != '') { echo stripslashes($this->lang->line('business')); } else echo "business."; ?>

                                </p>

                        </div>

                    </li>

                </ul>

                <?php } ?>

            </div>    

        </div> 

    </div>

</section>

<?php 

$this->load->view('site/templates/footer');

?>

