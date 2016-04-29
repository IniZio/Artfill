<?php $userProfileDetails=$userProfileDetails->result_array(); ?>

<?php

$this->load->view('site/templates/header');

$this->load->model('user_model');

?>

<script src="js/jquery.colorbox.js"></script>

			<div class="add_steps shop-menu-list">

			<div class="main">
			
				  <?php $this->load->view('site/user/profile_sidebar'); ?>
		  
			</div>
			
			</div>

<section class="container">

    <div class="main">

        <div class="container">

            <ul class="breadcrumb_top">

                <li><a href="<?php echo base_url();?>"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>

                <li>></li>

                <li><?php echo stripslashes($userProfileDetails[0]['user_name']);?>'s <?php if($this->lang->line('user_profile') != '') { echo stripslashes($this->lang->line('user_profile')); } else echo "profile"; ?></li>

                <li><?php echo shopsy_lg('user_following','Following');?></li>

            </ul>


            <div class="right_side">

            	<ul class="tab_model">

                	<li><a href="people/<?php echo stripslashes($userProfileDetails[0]['user_name']);?>/followers"><?php if($this->lang->line('user_followers') != '') { echo stripslashes($this->lang->line('user_followers')); } else echo "Followers"; ?></a></li>

                    <li class="selected"><a href="people/<?php echo stripslashes($userProfileDetails[0]['user_name']);?>/following"><?php if($this->lang->line('user_following') != '') { echo stripslashes($this->lang->line('user_following')); } else echo "Following"; ?></a></li>

                    <?php if ($userProfileDetails[0]['id']== $this->session->userdata['shopsy_session_user_id']){ ?>

                    <!--<li><a href="friends"><?php if($this->lang->line('user_find_ur_fnds') != '') { echo stripslashes($this->lang->line('user_find_ur_fnds')); } else echo 'Find your Friends'; ?></a></li>--><?php } ?>

                </ul>

                <div class="fav_new_content">

                	 <?php 

									if($userProfileDetails[0]['following']!=''){

									$followingArr = explode(',', stripslashes(ltrim($userProfileDetails[0]['following'],',')));

									}

									else{

										$followingArr=array();

									}

									if(empty($followingArr))

									{

								?>

                                <div class="outer_tab1">

                                    <div class="outer_tab_2">

                                        <div class="tab_content">

                                            <h1><?php if($this->lang->line('lg_user_discover_gt_itms') != '') { echo stripslashes($this->lang->line('lg_user_discover_gt_itms')); } else echo 'Discover great items. Follow someone whose taste you like.'; ?></h1>

                                        </div>

                                    </div>

                                </div>

                                <?php } else { ?>

                                <?php 

									for($i=0;$i<count($followingArr);$i++)

									{

										foreach($followingUserDetails as $followingUser){

											for($i=0;$i<count($followingArr);$i++){

												if($followingUser['id']==$followingArr[$i]){												

								?>

                                <?php if($followingUser['thumbnail']!=''){ $profile_pic='users/thumb/'.$followingUser['thumbnail']; } else { $profile_pic='default_avat.png';}?>

                                <ul style="margin: 15px 0 0; display:block !important" class="seller-links">

                                    <li style="border: 1px solid #EFEFEF;float: left;   min-width: 268px;  padding: 15px 10px;">

                                        <a href="view-people/<?php echo stripslashes($followingUser['user_name']); ?>">

                                        	<img class="folower_img" src="images/<?php echo $profile_pic; ?>" /> 

                                        </a>

                                        <h6 class="follow-name">

                                        <a href="view-people/<?php echo stripslashes($followingUser['user_name']); ?>"><?php echo stripslashes($followingUser['full_name']); ?></a>

                                        </h6>

                                        <span class="follow-num"><?php if($this->lang->line('user_followers') != '') { echo stripslashes($this->lang->line('user_followers')); } else echo "Followers"; ?>:<?php echo stripslashes($followingUser['followers_count']); ?></span>

                                        <?php if($followingUser['id']!=$this->session->userdata['shopsy_session_user_id']){

											if(!empty($this->session->userdata['shopsy_session_user_name'])){

											$followingListArr = explode(',', $userProfileDetails[0]['following']);

											}	

										if (in_array($followingUser['id'], $followingListArr)){	

										?>

                                        <label class="follow_nam" onclick='add_delete_follow("delete_follow","<?php echo stripslashes($followingUser['id']);?>");'><?php if($this->lang->line('user_following') != '') { echo stripslashes($this->lang->line('user_following')); } else echo "Following"; ?></label>

                                        <?php } if (!in_array($followingUser['id'], $followingListArr)) { ?>

                                        <label class="follow_nam" onclick='add_delete_follow("add_follow","<?php echo stripslashes($followingUser['id']);?>");'><?php if($this->lang->line('user_follow') != '') { echo stripslashes($this->lang->line('user_follow')); } else echo "Follow"; ?></label>

                                        <?php } }?>

                                    </li>

                                    <?php if($followingUser['favorites_visibility']=='Public'){?>

                                    <?php if(count($followingUserfavProdDetails[$followingArr[$i]])>3){$cond=4;}else{$cond=count($followingUserfavProdDetails[$followingArr[$i]]);} ?>

                                    <?php for($l=0;$l<$cond;$l++) {

										$img=explode(',',$followingUserfavProdDetails[$followingArr[$i]][$l]['image']); 

									?>

                                    <li>

                                        <a href="products/<?php echo $followingUserfavProdDetails[$followingArr[$i]][$l]['pseourl']; ?>">

                                            <div class="seller-outer">

                                                <div class="seller-inner">

                                                    <img src="images/product/list-image/<?php echo $img[0]; ?>" width="75" height="75">

                                                </div>

                                            </div>

                                        </a>

                                    </li>

								   	<?php }   ?>                                    

                                    <li>

                                        <a href="people/<?php echo stripslashes($followingUser['user_name']); ?>/favorites">

                                            <div class="seller-outer count-box">

                                                <div class="seller-inner">

                                                    <span class="count-number"><?php echo $followingUserfavDetails[$followingArr[$i]]->num_rows; ?></span>

                                                    <?php if($this->lang->line('user_favorites') != '') { echo stripslashes($this->lang->line('user_favorites')); } else echo "favorites"; ?>

                                                </div>

                                            </div>

                                        </a>

                                    </li>

                                    <?php } else{ ?>

                                    <li>

                						<div >

                                     <p style="margin: 30px 0px 0px 40px;">

                                        <span class="lock_img"></span>

                                        <a href="view-people/<?php echo stripslashes($followingUser['user_name']); ?>"><?php echo stripslashes($followingUser['full_name']); ?>'s</a>

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

								?>   

                                <?php } } ?> 

                </div>

            </div>

        </div>

    </div>

    

    </div>

</section>

<script type="text/javascript">

		$(document).ready(function() {

			$('.slidewrap').carousel({

				slider: '.slider',

				slide: 'li',

				nextSlide: '.next',

				prevSlide: '.prev',

				speed: 1000 // ms.

			});

		});



</script>

<script type="text/javascript">



function hoverView(val){



	if($('#hoverlist'+val).css('display')=='block'){

		$('#hoverlist'+val).hide('');	

	}else{

		$('#hoverlist'+val).show('');

	}

	

		

}



</script>

<script type="text/javascript" src="js/jcarousellite_1.0.1.pack.js"></script>



<script type="text/javascript">

		$(function() {

    		$(".slider_2").jCarouselLite({

        		btnNext: ".next_2",

        		btnPrev: ".prev_2",

				auto: false,

    			speed: 1000,

        		visible: 2

    		});

		});

		



</script>



<?php 

$this->load->view('site/templates/footer');

?>

