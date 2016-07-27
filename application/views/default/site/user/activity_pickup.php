<?php 

$this->load->view('site/templates/header');

$this->load->model('user_model');

?>


<section class="container">

    <div class="main">     

        <div class="container">

            <div class="top_list">

            <a class="title-head2-bold">
            	     地鐵交收
            </a>

                <ul style="width:auto;" class="listtypename">

                    <li class="first_list4">

                    	<a class="top_first_line " href="<?php echo base_url().'activity'; ?>">

                        	<?php if($this->lang->line('user_following') != '') { echo stripslashes($this->lang->line('user_following')); } else echo "Following"; ?>

                        </a>

                    </li>
					
					<li class="first_list first_list_seleted">

                    	<a class="top_first_line " href="<?php echo base_url().'activity/pickup'; ?>">

                        	<?php echo "地鐵交收";?>

                        </a>

                    </li>

                    <li class="first_list2">

                    	<a class="top_first_line" href="<?php echo base_url().'activity/interaction'; ?>">

                            <?php if($this->lang->line('interactions') != '') { echo stripslashes($this->lang->line('interactions')); } else echo "Interactions"; ?>

                        </a>

                    </li>
					<?php if($selectSellershop_details[0]['seller_businessname'] != ''){ ?>
                    <li class="first_list3">

                    	<a class="top_first_line" href="<?php echo base_url().'activity/shop'; ?>">

                        	<?php if($this->lang->line('you-shop') != '') { echo stripslashes($this->lang->line('you-shop')); } else echo "You Shop"; ?>

                        </a>

                    </li>
					<?php } ?>
                </ul>

            </div>

        </div>

    </div>

    

    <div class="favorite favorite_box">

        <div class="main">    

            <div class="clear">&nbsp;</div>       

            <div id="activities">
            <!-- <?php print_r ($isBuyerPickupActivities); ?> -->

            	<?php if(!empty($isBuyerPickupActivities)){ ?>

                <ul class="activity-list" id="activity-list activity-list-1">

                <?php $hover=0; $s=0;$l=1; foreach($isBuyerPickupActivities as $actBuyPick){ ?>

                <?php if($s<3 && $l<4){ $cls="small"; $s++; } else if($s>2 && $l<4){ $cls="large"; $l++;} else {$s=0;$l=1;}?>

                <?php 

				$userProfileDetails= $this->user_model->get_all_details(USERS,array('id'=>$actBuyPick['user_id']))->result_array();

				if($actBuyPick['activity_name']=='pickup item') { 

				$hover++;

					$productDetail = $this->user_model->get_all_details(PRODUCT,array('id'=>$actBuyPick['activity_id']))->row();

					#echo "<pre>"; print_r($productDetail); die;

					$imgArr=explode(',',$productDetail->image);

				?>

                <?php if(!empty($userProfileDetails)) { ?>
                    <li class="activity small-wid <?php echo $cls; ?>">

                        <div class="activity-desc">

                            <div class="activity-avatar trigger-action-toolbox" data-source="hp_tastemaker">

                                <a href="view-profile/<?php echo $userProfileDetails[0]['user_name']; ?>" >

                                	<?php if($userProfileDetails[0]['thumbnail']!=''){ $profile_pic='users/thumb/'.$userProfileDetails[0]['thumbnail']; } else { $profile_pic='default_avat.png';}?>

                                    <img width="75" height="75" src="images/<?php echo $profile_pic; ?>">

                                </a>

                            </div>
						
                            <p class="activity-name">

                               <?php if($userProfileDetails[0]['id']!=$loginCheck){ echo $userProfileDetails[0]['user_name']; } else { echo '您';} ?>
									
                               		<!-- <?php if(!empty($favArr)) { if($this->lang->line('favorited') != '') { echo stripslashes($this->lang->line('favorited')); } else echo "favorited"; }  else { if($this->lang->line('unfavorited') != '') { echo stripslashes($this->lang->line('unfavorited')); } else echo "Unfavorited";} ?> -->
                                    將於
                                     <?php $pickup_station= $this->activity_model->get_all_details(PICKUP_STATION, array('id'=>$actBuyPick['activity_location']))->result_array();
                                     $station_name = $pickup_station['station']; echo $station_name?>

                                    接收

                               <a class="member-name" href="products/<?php echo $productDetail->seourl; ?>"> <?php if($this->lang->line('user_thisitem') != '') { echo stripslashes($this->lang->line('user_thisitem')); } else echo "this item"; ?>.<?php #echo str_replace("item","this item",$actBuyPick['activity_name']); ?>.</a>

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

                                        //$favArr = $this->product_model->getUserFavoriteProductDetails($productDetail->id);
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

                                            <h2><?php echo af_lg('lg_your_list','Your Lists');?></h2> 

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
                    <?php } ?>

                <?php } }?>

                </ul>

                <?php } else { ?>

                <ul class="interactions">

                    <li>

                        <div class="your-shopfeed">

                            <h1><?php if($this->lang->line('activity') != '') { echo stripslashes($this->lang->line('activity')); } else echo "Darn, there's no activity yet."; ?></h1>                            

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

