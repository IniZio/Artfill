<div class="cms_page">
	<div class="fav_new_content">
	<?php
		if($UserfollowDetails->row()->followers!=''){ 
			$followersArr = explode(',', stripslashes(ltrim($UserfollowDetails->row()->followers,',')));
		}else{
			$followersArr=array();
		}
		if(empty($followersArr)){?>
		<div style="margin:40px 0 0 0" class="outer_tab1">
			<div class="outer_tab_2">
				<div class="tab_content">
					<h1><?php if($this->lang->line('user_no_one_foll') != '') { echo stripslashes($this->lang->line('user_no_one_foll')); } else echo "No one's following you yet"; ?></h1>
				</div>
			</div>
		</div>
	<?php } else { ?>
			<?php 
			for($i=0;$i<count($followersArr);$i++){
				foreach($followerUserDetails as $followingUser){
					for($i=0;$i<count($followersArr);$i++){
						if($followingUser['id']==$followersArr[$i]){
							#echo "<pre>";print_r($followingUser); print_r($followingUserfavDetails[$followersArr[$i]]); die;												
							if($followingUser['thumbnail']!=''){ $profile_pic='users/thumb/'.$followingUser['thumbnail']; } else { $profile_pic='default_avat.png';}?>
							<ul style="margin: 35px 0 0; display:block !important" class="seller-links">
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
											$followingListArr = explode(',', $UserfollowDetails->row()->following);

											}
										if (in_array($followingUser['id'], $followingListArr)){	?>
                                        <label class="follow_nam" onclick='add_delete_follow("delete_follow","<?php echo stripslashes($followingUser['id']);?>");'><?php if($this->lang->line('user_following') != '') { echo stripslashes($this->lang->line('user_following')); } else echo "Following"; ?></label>
                                        <?php } if (!in_array($followingUser['id'], $followingListArr)) { ?>
                                        <label class="follow_nam" onclick='add_delete_follow("add_follow","<?php echo stripslashes($followingUser['id']);?>");'><?php if($this->lang->line('user_follow') != '') { echo stripslashes($this->lang->line('user_follow')); } else echo "Follow"; ?></label>
                                        <?php } }?>
								</li>
                                    <?php if($followingUser['favorites_visibility']=='Public'){?>
                                    <?php if(count($followerUserfavProdDetails[$followersArr[$i]])>3){$cond=4;}else{$cond=count($followerUserfavProdDetails[$followersArr[$i]]);} ?>
                                    <?php  for($l=0;$l<$cond;$l++) {
										$img=explode(',',$followerUserfavProdDetails[$followersArr[$i]][$l]['image']); ?>
								<li>
									<a href="products/<?php echo $followerUserfavProdDetails[$followersArr[$i]][$l]['pseourl']; ?>">
										<div class="seller-outer">
											<div class="seller-inner">
												<img src="images/product/list-image/<?php echo $img[0]; ?>" width="75" height="75">
											</div>
										</div>
									</a>
								</li>
								   	<?php }  ?>                                   
								<li>
									<a href="people/<?php echo stripslashes($followingUser['user_name']); ?>/favorites">
										<div class="seller-outer count-box">
											<div class="seller-inner">
												<span class="count-number"><?php echo $followingUserfavDetails[$followersArr[$i]]->num_rows; ?></span>
												<?php if($this->lang->line('user_favorites') != '') { echo stripslashes($this->lang->line('user_favorites')); } else echo "favorites"; ?>
											</div>
										</div>
									</a>
								</li>
								<?php } else{ ?>
								<li>
									<div>
                                       <p style="margin: 30px 0px 0px 40px;">
											<span class="lock_img"></span>
											<a href="view-people/<?php echo stripslashes($followingUser['user_name']); ?>"><?php echo stripslashes($followingUser['full_name']); ?>'s</a>
											<?php if($this->lang->line('user_fav_r_pvt') != '') { echo stripslashes($this->lang->line('user_fav_r_pvt')); } else echo "favorites are private"; ?>.
										</p>
									</div>
								</li>
								<?php } ?>
							</ul>   
					<?php } } }?>
			<?php } } ?>   
	</div>       
</div>