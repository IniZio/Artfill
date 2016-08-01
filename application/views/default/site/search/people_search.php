<?php 

$this->load->view('site/templates/header');

$this->load->model('user_model');

?>

<section class="container">

    <div class="main">

        <div class="container">

            <ul class="breadcrumb_top">

                <li><a href="#"><?php if($this->lang->line('header_home') != '') { echo stripslashes($this->lang->line('header_home')); } else echo "Home"; ?></a></li>

                <li>></li>

                <li><?php if($this->lang->line('seller_search') != '') { echo stripslashes($this->lang->line('seller_search')); } else echo 'People Search Results'; ?></li>

            </ul>

            <div class="search-people">

                <div class="left_side">

                    <div style="width:85%" class="email_subscribe">

                        <h2 style="border-bottom:1px solid #DEDEDB"><?php if($this->lang->line('seller_filter') != '') { echo stripslashes($this->lang->line('seller_filter')); } else echo 'Filter your search'; ?></h2>

                        <div class="art">

                            <ul>

                                <li><?php if(isset($_GET['group'])){ if($_GET['group']!=0){ ?>

									<a id="Everyone">

										<?php if($this->lang->line('prod_everyone') != '') { echo stripslashes($this->lang->line('prod_everyone')); } else echo "Everyone"; ?></a>

                                    <?php }else{ ?>

                                    	<?php if($this->lang->line('prod_everyone') != '') { echo stripslashes($this->lang->line('prod_everyone')); } else echo "Everyone"; ?>

									<?php  } }else{ ?>

                                    <a id="Everyone"><?php if($this->lang->line('prod_everyone') != '') { echo stripslashes($this->lang->line('prod_everyone')); } else echo "Everyone"; ?></a>

									<?php }?></li>

                                <li><?php if(isset($_GET['group'])){ if($_GET['group']!=1){ ?> 

                                	<a id="Seller"><?php if($this->lang->line('seller_owners') != '') { echo stripslashes($this->lang->line('seller_owners')); } else echo "Shop Owners"; ?></a>

                                    <?php }else{ ?><?php if($this->lang->line('seller_owners') != '') { echo stripslashes($this->lang->line('seller_owners')); } else echo "Shop Owners"; ?>

                                    <?php } }else{ ?>

                                    <a id="Seller"><?php if($this->lang->line('seller_owners') != '') { echo stripslashes($this->lang->line('seller_owners')); } else echo "Shop Owners"; ?></a>

                                    <?php } ?></li>

                                <li><?php if(isset($_GET['group'])){ if($_GET['group']!=2){ ?>

                                	<a id="User"><?php if($this->lang->line('prod_owners') != '') { echo stripslashes($this->lang->line('prod_owners')); } else echo "Non-Shop Owners"; ?></a>

                                    <?php }else{ ?> <?php if($this->lang->line('prod_owners') != '') { echo stripslashes($this->lang->line('prod_owners')); } else echo "Non-Shop Owners"; ?>

                                    <?php } }else{ ?> 

                                    <a id="User"><?php if($this->lang->line('prod_owners') != '') { echo stripslashes($this->lang->line('prod_owners')); } else echo "Non-Shop Owners"; ?></a>

                                    <?php }?></li>

                            </ul>

                        </div>

                    </div>   

                </div>

            

                <div class="right_side">

                	<?php if($start==0){ ?>

                    <div class="treasury-headline">

                    	<h3 class="search_headline"><?php echo $found; ?> <?php if($this->lang->line('seller_people') != '') { echo stripslashes($this->lang->line('seller_people')); } else echo "people found for"; ?> <span class="search_name"><?php echo strip_tags($search_query); ?></span></h3>

                    </div>

                    <?php } ?>

                    <div class="shop_search">

                        <div class="listings-title">

                        	<form action="find/people" method="get">

                                <input class="text_box" type="text" placeholder="<?php if($this->lang->line('seller_searchshop') != '') { echo stripslashes($this->lang->line('seller_searchshop')); } else echo "Search in this shop"; ?>" name="search_query" value="<?php echo htmlspecialchars($search_query); ?>" id="search_key" />

                                <input type="hidden" name="order" value="<?php if(isset($_GET['order'])){ echo $_GET['order'];}else{ echo 0; } ?>" id="order" />

                                <input type="hidden" name="group" value="<?php if(isset($_GET['group'])){ echo $_GET['group'];}else{ echo 0; } ?>" id="group"/>

                                <input class="subscribe_btn" type="submit" value="<?php if($this->lang->line('seller_srch') != '') { echo stripslashes($this->lang->line('seller_srch')); } else echo "Search"; ?>">

                            </form>

                            <div class="sorting-options">

                                <label> <?php if($this->lang->line('seller_sortby') != '') { echo stripslashes($this->lang->line('seller_sortby')); } else echo "Sort by"; ?>: </label>

                                <ul id="menu">

                                    <li>

                                        <a id="order">

										<?php if(isset($_GET['order'])){ if($_GET['order']==0) {echo 'Alphabetical';}else{ echo 'Relevancy'; } } else { echo 'Relevancy';}?>

                                        <img src="images/down_arrow.png">

                                        </a>

                                        <ul class="sub-menu">

                                            <span class="cursor"></span>

                                            <li><a id="Relevancy" <?php if(isset($_GET['order'])){ if($_GET['order']==1){echo 'class="active"';} }else{echo 'class="active"';}?>><?php if($this->lang->line('seller_relevancy') != '') { echo stripslashes($this->lang->line('seller_relevancy')); } else echo "Relevancy"; ?></a></li>

                                            <li><a id="Alphabetical" <?php if(isset($_GET['order'])){ if($_GET['order']==0) {echo 'class="active"';} }?>><?php if($this->lang->line('seller_alphabetical') != '') { echo stripslashes($this->lang->line('seller_alphabetical')); } else echo "Alphabetical"; ?></a></li>

                                        </ul>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>     

                    <?php if($start==0){ ?>

                    <?php if(!empty($userList)){ ?>

                    <?php 

						for($i=0;$i<count($userList);$i++){

							foreach($userList as $userList){

					?>

                    <?php #if($this->session->userdata['shopsy_session_user_id']!=$userList->id){ ?>

                    <?php if($userList->thumbnail!=''){ $profile_pic='users/thumb/'.$userList->thumbnail; } else { $profile_pic='default_avat.png';}?>

                    <ul style="margin: 10px 0 0; display:block !important" class="seller-links">

                     <li style="border: 1px solid rgb(239, 239, 239); float: left; width: 331px; margin: 0px 3px 0px 0px; padding: 14px 0px 15px 10px;">

                            <a href="view-people/<?php echo stripslashes($userList->user_name); ?>">

                            	<img class="folower_img" src="images/<?php echo $profile_pic; ?>" /> 

                            </a>

                            <h6 class="follow-name">

                            	<a href="view-people/<?php echo stripslashes($userList->user_name); ?>"><?php echo stripslashes($userList->full_name); ?></a>

                            </h6>

                            <span class="follow-num"><?php if($this->lang->line('user_followers') != '') { echo stripslashes($this->lang->line('user_followers')); } else echo "Followers"; ?>:<?php echo stripslashes($userList->followers_count); ?></span>

                            <?php if($this->session->userdata['shopsy_session_user_id']!=''){ ?>

                            <?php if($userList->id!=$this->session->userdata['shopsy_session_user_id']){

								if(!empty($this->session->userdata['shopsy_session_user_name'])){

									$followingListArr = explode(',', $userList->followers);

								}

                            	#echo "<pre>"; print_r($followingListArr);	

                            	if (in_array($this->session->userdata['shopsy_session_user_id'], $followingListArr)){	

                            ?>

                            	<label class="follow_nam" onclick='add_delete_follow("delete_follow","<?php echo stripslashes($userList->id);?>");'><?php if($this->lang->line('user_following') != '') { echo stripslashes($this->lang->line('user_following')); } else echo "Following"; ?></label>

                            <?php } if (!in_array($this->session->userdata['shopsy_session_user_id'], $followingListArr)) { ?>

                            	<label class="follow_nam" onclick='add_delete_follow("add_follow","<?php echo stripslashes($userList->id);?>");'><?php if($this->lang->line('user_follow') != '') { echo stripslashes($this->lang->line('user_follow')); } else echo "Follow"; ?></label>

                            <?php } }?>

                            <?php } ?>

                        </li>

                        <?php if($userList->favorites_visibility=='Public'){?>

                        

                        <?php if(count($UserfavProdDetails[$userList->id])>3){$cond=4;}else{$cond=count($UserfavProdDetails[$userList->id]);} ?>

                        <?php if($cond<4){ for($l=4-$cond;$l>0;$l--) { ?>

                        <li>

                        	<div class="seller-outer" style="background-color: rgb(255, 255, 255); padding: 2px; height: 77px; width: 74px;">

<div style="background: none repeat scroll 0% 0% rgb(245, 245, 241); height: 77px;"></div>

</div>

                        </li>

                        <?php } } ?>

                        <?php for($l=0;$l<$cond;$l++) {

						$img=explode(',',$UserfavProdDetails[$userList->id][$l]['image']); 

						?>

                        <li>

                            <a href="products/<?php echo $UserfavProdDetails[$userList->id][$l]['pseourl']; ?>">

                                <div class="seller-outer">

                                    <div class="seller-inner">

                                    	<img src="images/product/list-image/<?php echo $img[0]; ?>" width="75" height="75">

                                    </div>

                                </div>

                            </a>

                        </li>

						<?php }?>

                        <li>

                            <a href="people/<?php echo stripslashes($userList->user_name); ?>/favorites">

                                <div class="seller-outer count-box">

                                    <div class="seller-inner">

                                        <span class="count-number"><?php echo $UserfavDetails[$userList->id]->num_rows; ?></span><?php if($this->lang->line('user_favorites') != '') { echo stripslashes($this->lang->line('user_favorites')); } else echo 'Favorites'; ?>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <?php } else{ ?>

                        <li>

                        

                        

                       <div class="seller-outer" style="background-color: rgb(255, 255, 255); padding: 2px; width: 408px; height: 74px; margin-top: 3px;">

<div style="background: none repeat scroll 0% 0% rgb(245, 245, 241); height: 74px;"><p style="padding: 28px 0px 0px 110px;">

                                    <span class="lock_img"></span>

                                    <a href="view-people/<?php echo stripslashes($userList->user_name); ?>"><?php echo stripslashes($userList->full_name); ?><?php if($this->lang->line('seller_s') != '') { echo stripslashes($this->lang->line('seller_s')); } else echo "'s"; ?></a>

                                    <?php if($this->lang->line('user_fav_r_pvt') != '') { echo stripslashes($this->lang->line('user_fav_r_pvt')); } else echo "favorites are private"; ?>.

                                </p></div>

</div>

                        

                         

            			</li>

                        <?php } ?>

                    </ul>

                    <?php } } } else{ ?>

                    <div style="margin:40px 0 0 0" class="outer_tab1">

                        <div class="outer_tab_2">

                            <div class="tab_content">

                            	<h1><?php if($this->lang->line('seller_noresult') != '') { echo stripslashes($this->lang->line('seller_noresult')); } else echo "No Result Found"; ?>.</h1>

                            </div>

                        </div>

                    </div>

                    <?php } }?>

                </div>

            	<div class="clear"></div>                

            </div>

        </div>

    </div>

</section>

<script>

$(document).ready(function(e) {

    $('#Everyone').click(function(e) {

        path='find/people?search_query='+$('#search_key').val()+'&order='+$('#order').val()+'&group=0';

		window.location = BaseURL+path;

    });

	$('#Seller').click(function(e) {

        path='find/people?search_query='+$('#search_key').val()+'&order='+$('#order').val()+'&group=1';

		window.location = BaseURL+path;

    });

	$('#User').click(function(e) {

        path='find/people?search_query='+$('#search_key').val()+'&order='+$('#order').val()+'&group=2';

		window.location = BaseURL+path;

    });

	$('#Alphabetical').click(function(e) {

        path='find/people?search_query='+$('#search_key').val()+'&order=0&group='+$('#group').val()+'';

		window.location = BaseURL+path;

    });

	$('#Relevancy').click(function(e) {

        path='find/people?search_query='+$('#search_key').val()+'&order=1&group='+$('#group').val()+'';

		window.location = BaseURL+path;

    });

});

</script>

<?php 

$this->load->view('site/templates/footer');

?>

