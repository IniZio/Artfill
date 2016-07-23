<?php 

$this->load->view('site/templates/header');

$this->load->model('user_model');

//echo "<pre>";print_r($viewprofile->row());

//echo $viewprofile->row()->full_name;die;

?>
<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Favorite-page.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
<div id="fav_list_tag">
<section class="container">

	<div class="main">  
	
	<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="view-profile/<?php echo $this->uri->segment(2);?>" class="a_links"><?php echo $this->uri->segment(2);?></a></li>
		    <span>&rsaquo;</span>
           <li><?php echo af_lg('lg_fav_list','Favorites list');?></li>
        </ul>

	<div class="avatar_menu">

    <?php if($userProfileDetails[0]['thumbnail']!=''){ $profile_pic='users/thumb/'.$userProfileDetails[0]['thumbnail']; } else { $profile_pic='default_avat.png';}?>

        <a class="owner-fava" href="javascript:void(0);">

        <img class="fav-avatar" width="75" height="75" alt="avatar" src="images/<?php echo $profile_pic; ?>">

        </a>

        <span><?php echo stripslashes($userProfileDetails[0]['user_name']); ?></span>

        <ul class="owner-fav">

        	<li>

                <a href="people/<?php echo stripslashes($userProfileDetails[0]['user_name']); ?>/followers">

                    <span class="fav-number"><?php echo stripslashes($userProfileDetails[0]['followers_count']); ?></span>

                    <span class="fav-name"> <?php if($this->lang->line('user_followers') != '') { echo stripslashes($this->lang->line('user_followers')); } else echo "Followers"; ?> </span>

                </a>

            </li>

            

            <li>

                <a href="people/<?php echo stripslashes($userProfileDetails[0]['user_name']); ?>/following">

                    <span class="fav-number"><?php echo stripslashes($userProfileDetails[0]['following_count']); ?></span>

                    <span class="fav-name"> <?php if($this->lang->line('user_following') != '') { echo stripslashes($this->lang->line('user_following')); } else echo "Following"; ?> </span>

                </a>

            </li>

         

    	</ul>

    </div>

    </div>

	<div style="float:left; width:100%;" class="favorite favorite_box1">

		<div class="main">    

      		<div class="top_list" style="width:95%;">

                <a class="title-head2" href="<?php echo current_url();?>"> <?php echo stripslashes($userProfileDetails[0]['user_name']); ?>'s <?php if($this->lang->line('user_favotites') != '') { echo stripslashes($this->lang->line('user_favotites')); } else echo "Favorites"; ?> </a>

                <form method="get">

                <input name="a" id="a" class="input-forms" type="text" value="" placeholder="<?php if($this->lang->line('user_search_avail') != '') { echo stripslashes($this->lang->line('user_search_avail')); } else echo 'Search available items'; ?>">

                <span class="search-icon">🔎</span>

                </form>

                <ul style="width:auto;" class="listtypename">

                    <li class="first_list first_list_seleted">

                        <a class="top_first_line " href="people/<?php echo $userProfileDetails[0]['user_name'];?>/favorites"> <?php if($this->lang->line('user_list_ites') != '') { echo stripslashes($this->lang->line('user_list_ites')); } else echo "Items"; ?> </a>

                    </li>

                    <li class="first_list2">

                        <a class="top_first_line" href="people/<?php echo $userProfileDetails[0]['user_name'];?>/favorites/shop"> <?php if($this->lang->line('user_list_shop') != '') { echo stripslashes($this->lang->line('user_list_shop')); } else echo "Shop"; ?> </a>

                    </li>

                    <!--<li class="first_list3">

                        <a class="top_first_line" href="people/<?php echo $userProfileDetails[0]['user_name'];?>/favorites/treasuries/"> <?php if($this->lang->line('user_treasuries') != '') { echo stripslashes($this->lang->line('user_treasuries')); } else echo "Treasuries"; ?> </a>

                    </li>-->

                </ul>

      		</div> 

            <?php if(!$_GET['a']){ ?>

            <ul class="collection_fav">

                <li>

                   <a href="people/<?php echo $userProfileDetails[0]['user_name'];?>/favorites/items-i-love" class="fav_list_img">

                       <div class="image_collection">

                       <?php if(count($userFavoriteItems)>3){$cond=4;}else{$cond=count($userFavoriteItems);} ?>

                       		<?php for($i=0;$i<$cond;$i++) {

								$img=explode(',',$userFavoriteItems[$i]['image']); 

							?>

                           <img src="images/product/thumb/<?php echo $img[0]; ?>" alt="<?php echo $userFavoriteItems[$i]['product_name']; ?>"/>

                           <?php } if($cond<=4){ for($i=$cond;$i<4;$i++) { ?>

                            <div class="empty-area"></div>

                            <?php } } ?>

                           <div class="fav_num"><span> <?php echo count($userFavoriteItems); ?> </span></div>

                       </div>

                       <div class="fav-detail">

                           <h3>

                            <span class="fav-text"><?php if($this->lang->line('user_itmes_i_love') != '') { echo stripslashes($this->lang->line('user_itmes_i_love')); } else echo "Items I Love"; ?></span>

                           </h3>

                           <p class="fav-item"> <?php echo count($userFavoriteItems); ?> <?php if($this->lang->line('user_items') != '') { echo stripslashes($this->lang->line('user_items')); } else echo "items"; ?> </p>

                           <span class="fav-arrow"></span>

                       </div>       

                   </a>

                </li>
                     
           		<?php foreach($userListDetails as $List){ 
				$prdids =array_filter(explode(',',$List['product_id'])); 
				if($List['product_count'] > 0 && count($prdids)> 0){?>

                <li>

                    <a href="people/<?php echo $userProfileDetails[0]['user_name'];?>/favorites/list/<?php echo $List['id'].'-'.$List['name']; ?>" class="fav_list_img">

                        <div class="image_collection">

                        	<?php if($List['product_count']>3){$cond=4;}else{$cond=$List['product_count'];} ?>

                       		<?php 

								$prd=array_filter(explode(',',$List['product_id'])); 

								for($j=0;$j<$cond && $prd[$j] !='';$j++) {

									$haveListIn = $this->user_model->get_list_products(stripslashes($prd[$j]),$List['id'])->result_array();

									#echo "<pre>";  echo $haveListIn[0]['image'];

									$img=explode(',',$haveListIn[0]['image']); 

							?>

                           <img src="images/product/thumb/<?php echo $img[0]; ?>" />

                           <?php } if($List['product_count']<=4){ for($i=$List['product_count'];$i<4;$i++) { ?>

                            <div class="empty-area"></div>

                            <?php } } ?>

                            <div class="fav_num"><span> <?php if($List['product_count']>0)echo $List['product_count'];else echo "EMPTY"; ?> </span></div>

                        </div>

                        <div class="fav-detail">

                            <h3>

                                <span class="fav-text"><?php echo $List['name']; ?></span>

                            </h3>

                            <p class="fav-item"> <?php echo $List['product_count']; ?> <?php if($this->lang->line('user_items') != '') { echo stripslashes($this->lang->line('user_items')); } else echo "items"; ?> </p>

                            <span class="fav-arrow"></span>

                        </div>

                   </a>

                </li>

                <?php }} ?>

                

                <?php if($currUser['shopsy_session_user_name']==urldecode($this->uri->segment(2,0))){ ?>

                <li>

                    <a class="fav-link" href="javascript:void(0);" id="list_create">

                        <span class="plus-icon">+</span>

                        <p><?php if($this->lang->line('user_create_new_list') != '') { echo stripslashes($this->lang->line('user_create_new_list')); } else echo "Create New List"; ?></p>

                    </a>

                    <div class="fav-link" id="create_list" style="display:none;">

                    	<a id="list_close">X</a>

                    	<form method="post" action="site/user/add_list">

                        	<p><?php if($this->lang->line('user_careate_a_list') != '') { echo stripslashes($this->lang->line('user_careate_a_list')); } else echo "Create a List"; ?></p>

                        	<input type="text" name="list" id="list" placeholder="<?php if($this->lang->line('user_list_name') != '') { echo stripslashes($this->lang->line('user_list_name')); } else echo 'List name'; ?>" />

                            <input type="submit" class="primary-button" value="<?php if($this->lang->line('user_create') != '') { echo stripslashes($this->lang->line('user_create')); } else echo 'Create'; ?>" />

                        </form>

                    </div>

                </li>

                <?php } ?>

            </ul>

            <?php } else if($_GET['a']) { ?>

            <div class="product_box">

                        <ul class="product_listing">

                        	<?php $i=1;  foreach($searchtProducts as $products){ $img=explode(',',$products['image']);?>

                        	<li>

                            	<div class="product_img">

                                	<div class="product_hide">

                                    	<div class="product_fav">

                                            <?php if($loginCheck !=''){ ?>
											
											<?php if($products['user_id']==$loginCheck){ ?>
											<a href="javascript:void(0);" onclick="return ownProductFav();">
												<input type="submit" value="" class="hoverfav_icon" />
											</a>
											<?php
											}else{

											$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($products['id']));

											#print_r($favArr); die;

											if(empty($favArr)){ ?>

											<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($products['id']); ?>','Fresh',this);">

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											<?php  } else { ?>                        

											<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($products['id']); ?>','Old',this);">

												<input type="submit" value="" class="hoverfav_icon1" />

											</a>

											<?php }} } else { ?>

											<a href="#" class="reg-popup" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											<?php  } ?>                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('<?php echo $i; ?>');">  </a>

                                        	<div class="hover_lists" id="hoverlist<?php echo $i; ?>">

                                               	<h2><?php if($this->lang->line('user_your_lists') != '') { echo stripslashes($this->lang->line('user_your_lists')); } else echo "Your Lists"; ?></h2>

                                                <div class="lists_check">

                                                	<?php foreach($userLists as $Lists){ 

													$haveListIn = $this->user_model->check_list_products(stripslashes($products['id']),$Lists['id'])->num_rows();

													#echo $haveListIn;

													if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}

													?>

                                                    <input type="checkbox" class="check_box" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo stripslashes($products['id']); ?>');" <?php echo $chk; ?> />

                                                    <label><?php echo $Lists['name']; ?></label>

                                                    <?php } ?>

                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="<?php echo $products['id']; ?>" name="productId" />

                                                        <input type="text" placeholder="<?php if($this->lang->line('user_new_list') != '') { echo stripslashes($this->lang->line('user_new_list')); } else echo 'New list'; ?>" class="list_scroll" name="list" id="creat_list_<?php echo $i; ?>" />

                                                        <input type="submit" value="<?php if($this->lang->line('user_add') != '') { echo stripslashes($this->lang->line('user_add')); } else echo 'Add'; ?>" class="primary-button" onclick="return validate_create_list('<?php echo $i; ?>');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                                    <a href="products/<?php echo $products['seourl']?>">

                                    <img src="images/product/<?php echo $img[0]; ?>" alt="Product-1" title="Product-1" />

                                    </a>

                                </div>

                                <div class="product_title"><a href="products/<?php echo $products['seourl']?>"><?php echo $products['product_name']?></a></div>

                                <div class="product_maker"><a href="shop-section/<?php echo $products['shop_seourl']?>"><?php echo $products['shop_name']?></a></div>

                                <div class="product_price">

                                <?php if($products['price'] != 0.00) {?>

                                <span class="currency_value">$<?php echo $products['price']?></span>

                                <span class="currency_code">USD</span>

                                <?php } else { ?> 

                                <span class="currency_value">$<?php echo $products['pricing'].'+';?></span>

                                <span class="currency_code">USD</span>

                                <?php }?>

                                </div>

                            </li>

                            <?php $i++;  } ?>                            

                        </ul>

                    </div>

            <?php } ?>

            

       	</div> 

    </div>

</section>
</div>
<?php 

$this->load->view('site/templates/footer');

?>

