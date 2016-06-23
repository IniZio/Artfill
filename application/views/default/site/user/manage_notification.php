<?php

$this->load->view('site/templates/header');

?>
		<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>

			<div class="add_steps shop-menu-list">

			<div class="main">
			
				<?php $this->load->view('site/user/sidebar');?>
			
			</div>
			
			</div>
<div id="profile_div">
<section class="container">

    	<div class="main">
		
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="view-profile/<?php echo $this->session->userdata['shopsy_session_user_name'];?>" class="a_links"><?php echo $this->session->userdata['shopsy_session_user_name'];?></a></li>
		   <span>&rsaquo;</span>
		   <li><?php echo artfill_lg('lg_manage_notification',' Manage Notification'); ?></li>
        </ul>
        	

            <div class="community_page">            	

                <div class="community_div">

                    <div class="community_right">


						<h2 class="ptit"><?php if($this->lang->line('lg_manage_notification') != '') { echo stripslashes($this->lang->line('lg_manage_notification')); } else echo "Manage Notification"; ?></h2><hr>
							<form action ="save-notification-changes" method="post">	
								<p>
									<b><?php echo artfill_lg('lg_Update_Mails','Update Mails '); ?><b><br>
										  <input type="checkbox" <?php if($userDetails_notify[0]['update_email'] == "Yes" ) echo "checked = 'checked'" ?> value="Yes" id="updates" name="updates"><?php echo artfill_lg('lg_Subscribe_Newsletter','Subscribe Newsletter '); ?> <br>
								</p>
								<hr>
								<p>
									<b><?php echo artfill_lg('lg_wanna_Email_notification_when','I want to get Email notification when'); ?><b><br>
										  <?php
											$noty_arr=array();
											if($userDetails->row()->notification_email !="")
												$noty_arr=explode(',',$userDetails->row()->notification_email);
										  ?>
										  <input type="checkbox" <?php if(in_array('follow',$noty_arr)) echo "checked" ?>  value="follow" id="follow" name ="follow"> <?php echo artfill_lg('lg_Someone_follows_me','Someone follows me'); ?> . <br>
										  <input type="checkbox" <?php if(in_array('msg',$noty_arr)) echo "checked" ?>  value="msg" id="msg" name="msg"><?php echo artfill_lg('lg_Someone_send_me_a_message','Someone send me a message'); ?> .<br>
										  <input type="checkbox" <?php if(in_array('like',$noty_arr)) echo "checked" ?>  value="like" id="like" name="like"> <?php echo artfill_lg('lg_Someone_Favourite_My_Product','Someone Favourite My Product'); ?><br>
										  <input type="checkbox" <?php if(in_array('lik_of_like',$noty_arr)) echo "checked" ?> value="lik_of_like" id="lik_of_like" name="lik_of_like"> <?php echo artfill_lg('lg_Someone_Favourite_a_Product_Which_I_Favourite','Someone Favourite a Product Which I Favourite.'); ?><br>
										  <input type="checkbox" <?php if(in_array('fav_shop_pro',$noty_arr)) echo "checked" ?> value="fav_shop_pro" id="fav_shop_pro" name="fav_shop_pro">  <?php echo artfill_lg('lg_Favourite_Shop_added_a_New_Product','Favourite Shop added a New Product'); ?>.<br>
										  <?php
											if($userDetails->row()->group == "Seller"){
											?>
											<input type="checkbox" <?php if(in_array('fav_shop',$noty_arr)) echo "checked" ?> value="fav_shop" id="fav_shop" name="fav_shop"><?php echo artfill_lg('lg_Somebody_liked_my_Shop','Somebody liked my Shop '); ?> .<br>
										  <?php
											}?>
								</p>
								<input type="submit" value="<?php echo artfill_lg('lg_Save_Changes','Save Changes'); ?>">
							</form>
					</div>

				</div>	

			</div>

		</div>

        





		
 </section>   
 </div>
<!-- Section_start -->



<?php 

$this->load->view('site/templates/footer');

?>

