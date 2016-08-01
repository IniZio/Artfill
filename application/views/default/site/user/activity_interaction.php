<?php 

$this->load->view('site/templates/header');

$this->load->model('user_model');

?>

<section class="container">

    <div class="main">     

        <div class="container">

            <div class="top_list">

            <a class="title-head2-bold" href="home">

            	<?php if($this->lang->line('your-feed') != '') { echo stripslashes($this->lang->line('your-feed')); } else echo "Your Feed"; ?>

            </a>

                <ul style="width:auto;" class="listtypename">

                    <li class="first_list2">

                    	<a class="top_first_line " href="<?php echo base_url().'activity'; ?>">

                        	<?php if($this->lang->line('user_following') != '') { echo stripslashes($this->lang->line('user_following')); } else echo "Following"; ?>

                        </a>

                    </li>

					<li class="first_list4">

                    	<a class="top_first_line " href="<?php echo base_url().'activity/pickup'; ?>">

                        	<?php echo "地鐵交收";?>

                        </a>

                    </li>
					
                    <li class="first_list first_list_seleted">

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

                            	<?php if($this->lang->line('user_following') != '') { echo stripslashes($this->lang->line('user_following')); } else echo "Following"; ?>

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
         		<?php if(count($userfollowersDetails)>1){ ?>
                <ul class="interactions">
                	<?php foreach($userfollowersDetails as $follUsers){ if($follUsers->user_name != ''){ ?>
                    <li>
                    	<div class="interactions_inner">
                    		<span class="interactions-icon"></span>
                            <p>
                                <a class="" rel="" href="view-profile/<?php echo $follUsers->user_name; ?>"><?php echo $follUsers->full_name; ?></a>
                                <?php if($this->lang->line('started') != '') { echo stripslashes($this->lang->line('started')); } else echo "started following you."; ?>
                            </p>
                    	</div>
                    	<br />
                        <?php if($follUsers->thumbnail!=''){ $profile_pic='users/thumb/'.$follUsers->thumbnail; } else { $profile_pic='default_avat.png';}?>
                        <span style="float:left; width:100%; padding: 0 0 10px 30px;">     
                    		<img src="images/<?php echo $profile_pic; ?>" />
                    	</span>
                    </li>
                    <?php } }?>
                </ul>
                <?php }else{ ?>
                <ul class="interactions">
                    <li>
                        <div class="your-shopfeed">
                            <h1><?php if($this->lang->line('activity') != '') { echo stripslashes($this->lang->line('activity')); } else echo "Darn, there's no activity yet."; ?>..</h1>
                            <p><?php if($this->lang->line('follows') != '') { echo stripslashes($this->lang->line('follows')); } else echo "No one follows you."; ?></p>
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

