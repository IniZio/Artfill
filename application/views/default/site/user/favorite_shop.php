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
			<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Favorite-Shop-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
<div id="fav_shop_list">
<section class="container">

    	<div class="main">

        	

            <div class="community_page">

            

            	<ul id="breadcrumbs" class="clear">

                                    <li>

                                            

                            <a itemprop="url" href="<?php echo base_url();?>"><span itemprop="title"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></span></a>

                            <span class="separator">›</span>            

                                    </li>

                            <li><?php echo stripslashes($userProfileDetails[0]['user_name']);?>'s <?php if($this->lang->line('user_profile') != '') { echo stripslashes($this->lang->line('user_profile')); } else echo "profile"; ?>  </li>

                            <li><?php if($this->lang->line('user_favorites') != '') { echo stripslashes($this->lang->line('user_favorites')); } else echo "Favorites"; ?></li>

                        </ul>

                        

                <div class="community_div">


                    <div class="community_right">

                    	   

                <h1 class="favorite-headline"><?php echo stripslashes($userProfileDetails[0]['user_name']);?>

                	<?php if($this->lang->line('favourites') != '') { echo stripslashes($this->lang->line('favourites')); } else echo "'s Favorites"; ?>

                </h1>

                <?php if($this->session->userdata('shopsy_session_user_name')!=urldecode($this->uri->segment(2,0))){				

				if($userProfileDetails[0]['shop_visibility']=='Private'){

				?>	

                <div style="margin:40px 0 0 0" class="outer_tab1">

                    <div class="outer_tab_2">

                        <div class="tab_content" style="widows:400px;">

                        	<?php if($this->lang->line('fav-private') != '') { echo stripslashes($this->lang->line('fav-private')); } else echo "This member's favourites are private."; ?>

                        </div>

                    </div>

                </div>

                <?php }else{ ?>

                 	<ul class="tab_model">

                                          <a class="linkadd" href="people/<?php echo $userProfileDetails[0]['user_name'];?>/favorites"><li class="TabbedPanelsTab " tabindex="0"><?php if($this->lang->line('user_item_var') != '') { echo stripslashes($this->lang->line('user_item_var')); } else echo "Item"; ?></li></a>

                                          <li class="selected"><?php if($this->lang->line('user_shops') != '') { echo stripslashes($this->lang->line('user_shops')); } else echo "Shops"; ?></li>	

                                          <!--<li><?php if($this->lang->line('user_treasury_lists') != '') { echo stripslashes($this->lang->line('user_treasury_lists')); } else echo "Treasury Lists"; ?></li>-->

                                        </ul>

                	<div class="fav_new_content">

                                          <?php if($currUser['shopsy_session_user_name']==urldecode($this->uri->segment(2,0))){ ?>

                                          <div class="favo_image">
											<a class="" href="#shopFavedit_popup" data-toggle="modal">
												<span class=""></span>
												<?php if($this->lang->line('user_edit') != '') { echo stripslashes($this->lang->line('user_edit')); } else echo "Edit"; ?>
											</a>
										</div>

                                          <?php } ?>

                                          <?php if(!$userFavoriteShops) {?>                                          

                                          	<div style="margin:40px 0 0 0" class="outer_tab1">

                                                <div class="outer_tab_2">

                                                    <div class="tab_content">

                                                        <h1><?php if($this->lang->line('user_no_shop_fav_list') != '') { echo stripslashes($this->lang->line('user_no_shop_fav_list')); } else echo "No shop's in your favorite list"; ?></h1>

                                                    </div>

                                                </div>

                                            </div>

                                          	<?php 

											}

											foreach($userFavoriteShops as $shops){ ?>

                                            <?php 

											if($shops['thumbnail']!='')

											{ $profile_pic='users/thumb/'.$shops['thumbnail']; } 

											else { $profile_pic='default_avat.png';}

											?>

                                          	<ul class="seller-links">                                          

                                                <li style="border: 1px solid #EFEFEF;float: left;    padding:10px 45px 10px 11px;">
												
													<div class="fav-owner">

                                                        <a href="shop-section/<?php echo $shops['seourl']; ?>">

                                                        	<img class="thumbnail" width="35" height="35" src="images/<?php echo $profile_pic; ?>">

                                                        </a>

                                                    </div>

                                                    <a class="fav-item-name" href="shop-section/<?php echo $shops['seourl']; ?>"><?php echo $shops['seller_businessname']; ?> </a>

                                                    

                                                    <div class="fav_min_text">

                                                    	<span><?php if($this->lang->line('user_shop_owner') != '') { echo stripslashes($this->lang->line('user_shop_owner')); } else echo "Shop Owner"; ?></span><br />

                                                       <a href="view-people/<?php echo $shops['user_url']; ?>"><?php echo $shops['seller_firstname']; ?></a>

                                                    </div>

                                                    <span class="close-button"></span>

                                                </li>

                                              	<?php  

													$itemcount=0; $listitems=0;

													for($i=0;$i<count($userFavoriteShopsProducts);$i++)

													{

														if($userFavoriteShopsProducts[$i]['user_id']==$shops['seller_id'] )

														{ 

															if($listitems<4){

																$img=explode(',',$userFavoriteShopsProducts[$i]['image']); 

												?>

                                                <li>

                                                    <a href="products/<?php echo $userFavoriteShopsProducts[$i]['seourl']; ?>">

                                                        <div class="seller-outer">

                                                            <div class="seller-inner">

                                                                <img src="images/product/list-image/<?php echo $img[0]; ?>" width="75" height="75">

                                                            </div>

                                                        </div>

                                                    </a>

                                                </li>

                                                <?php } $itemcount=$itemcount+1; $listitems++; }  }?>

                                                <li>

                                                    <a href="shop-section/<?php echo $shops['seourl']; ?>">

                                                        <div class="seller-outer count-box">

                                                            <div class="seller-inner">

                                                                <span class="count-number"><?php echo $itemcount; ?></span>

                                                                <?php if($this->lang->line('user_items') != '') { echo stripslashes($this->lang->line('user_items')); } else echo "items"; ?>

                                                            </div>

                                                        </div>

                                                    </a>

                                                </li>

                                                <?php  ?>

                                        	</ul>

                                        	<?php } ?>

                                        

                                        

                                            	

                                          </div>

                <?php } }else{?>  

	                <ul class="tab_model">

                                          <a class="linkadd" href="people/<?php echo $userProfileDetails[0]['user_name'];?>/favorites"><li class="TabbedPanelsTab " tabindex="0"><?php if($this->lang->line('user_item_var') != '') { echo stripslashes($this->lang->line('user_item_var')); } else echo "Item"; ?></li></a>

                                          <li class="selected"><?php if($this->lang->line('user_shops') != '') { echo stripslashes($this->lang->line('user_shops')); } else echo "Shops"; ?></li>	

                                          <!--<li><?php if($this->lang->line('user_treasury_lists') != '') { echo stripslashes($this->lang->line('user_treasury_lists')); } else echo "Treasury Lists"; ?></li>-->

                                        </ul>
										 <?php if($currUser['shopsy_session_user_name']==urldecode($this->uri->segment(2,0))){ ?>

                                          <div class="favo_image">
											<a  href="#shopFavedit_popup" data-toggle="modal">
												<span class="edit-icon"></span><?php if($this->lang->line('user_edit') != '') { echo stripslashes($this->lang->line('user_edit')); } else echo "Edit"; ?>
											</a>
										</div>

                                          <?php } ?>

                	<div class="fav_new_content">

                                         

                                          <?php if(!$userFavoriteShops) {?>                                          

                                          	<div style="margin:40px 0 0 0" class="outer_tab1">

                                                <div class="outer_tab_2">

                                                    <div class="tab_content">

                                                        <h1><?php if($this->lang->line('user_no_shop_fav_list') != '') { echo stripslashes($this->lang->line('user_no_shop_fav_list')); } else echo "No shop's in your favorite list"; ?></h1>

                                                    </div>

                                                </div>

                                            </div>

                                          	<?php 

											}

											foreach($userFavoriteShops as $shops){ ?>

                                            <?php 

											if($shops['thumbnail']!='')

											{ $profile_pic='users/thumb/'.$shops['thumbnail']; } 

											else { $profile_pic='default_avat.png';}

											?>

                                          	<ul class="seller-links">                                          

                                                <li style="border: 1px solid #EFEFEF;float: left; padding:11px 10px; width:330px;">
												
													<div class="fav-owner">

                                                        <a href="shop-section/<?php echo $shops['seourl']; ?>">

                                                        	<img class="thumbnail" width="35" height="35" src="images/<?php echo $profile_pic; ?>">

                                                        </a>

                                                    </div>

                                                    <a class="fav-item-name" href="shop-section/<?php echo $shops['seourl']; ?>"><?php echo $shops['seller_businessname']; ?> </a>

                                                   
                                                    <div class="fav_min_text">

                                                    	<span><?php if($this->lang->line('user_shop_owner') != '') { echo stripslashes($this->lang->line('user_shop_owner')); } else echo "Shop Owner"; ?></span><br />

                                                       <a href="view-people/<?php echo $shops['user_url']; ?>"><?php echo $shops['seller_firstname']; ?></a>

                                                    </div>

                                                    <span class="close-button" onclick="return changeShopToFavourite('<?php echo $shops['seller_id']; ?>','Old');"></span>

                                                </li>

                                              	<?php  

													$itemcount=0; $listitems=0;

													for($i=0;$i<count($userFavoriteShopsProducts);$i++)

													{

														if($userFavoriteShopsProducts[$i]['user_id']==$shops['seller_id'] )

														{ 

															if($listitems<4){

																$img=explode(',',$userFavoriteShopsProducts[$i]['image']); 

												?>

                                                <li>

                                                    <a href="products/<?php echo $userFavoriteShopsProducts[$i]['seourl']; ?>">

                                                        <div class="seller-outer">

                                                            <div class="seller-inner">

                                                                <img src="images/product/list-image/<?php echo $img[0]; ?>" width="75" height="75">

                                                            </div>

                                                        </div>

                                                    </a>

                                                </li>

                                                <?php } $itemcount=$itemcount+1; $listitems++; }  }?>

                                                <li>

                                                    <a href="shop-section/<?php echo $shops['seourl']; ?>">

                                                        <div class="seller-outer count-box">

                                                            <div class="seller-inner">

                                                                <span class="count-number"><?php echo $itemcount; ?></span>

                                                                <?php if($this->lang->line('user_items') != '') { echo stripslashes($this->lang->line('user_items')); } else echo "items"; ?>

                                                            </div>

                                                        </div>

                                                    </a>

                                                </li>

                                                <?php  ?>

                                        	</ul>

                                        	<?php } ?>

                                        

                                        

                                            	

                                          </div>                      

                <?php } ?>

                                          

                                          </div>

                

                             <!--     <div id="TabbedPanels1" class="TabbedPanels">

                                       

                                        <ul class="TabbedPanelsTabGroup fav_tab">

                                          <a href="people/<?php echo $userProfileDetails[0]['user_name'];?>/favorites"><li class="TabbedPanelsTab " tabindex="0">Item</li></a>

                                          <li class="TabbedPanelsTab " tabindex="0">Shops</li>	

                                          <li class="TabbedPanelsTab " tabindex="0">Treasury Lists</li>

                                        </ul>

                                        

                                        <div class="TabbedPanelsContentGroup">

                                          <div class="TabbedPanelsContent ">

                                            

                                          </div>

                                          <div class="TabbedPanelsContent">

                                          <?php if($currUser['shopsy_session_user_name']==urldecode($this->uri->segment(2,0))){ ?>

                                          <div class="favo_image"><a class="edit_trigger" href="#"><span class="edit-icon">⚙</span>Edit</a></div>

                                          <?php } ?>

                                          <?php if(!$userFavoriteShops) {?>                                          

                                          	<div style="margin:40px 0 0 0" class="outer_tab1">

                                                <div class="outer_tab_2">

                                                    <div class="tab_content">

                                                        <h1>No shop's in your favorite list</h1>

                                                    </div>

                                                </div>

                                            </div>

                                          	<?php 

											}

											foreach($userFavoriteShops as $shops){ ?>

                                            <?php 

											if($shops['thumbnail']!='')

											{ $profile_pic='users/thumb/'.$shops['thumbnail']; } 

											else { $profile_pic='default_avat.png';}

											?>

                                          	<ul style="margin: 15px 0 0;" class="seller-links">                                          

                                                <li style="border: 1px solid #EFEFEF;float: left;    padding: 20px 10px;">

                                                    <a class="fav-item-name" href="shop-section/<?php echo $shops['seourl']; ?>"><?php echo $shops['seller_businessname']; ?> </a>

                                                    <div class="fav-owner">

                                                        <a href="shop-section/<?php echo $shops['seourl']; ?>">

                                                        	<img class="thumbnail" width="35" height="35" src="images/<?php echo $profile_pic; ?>">

                                                        </a>

                                                    </div>

                                                    <div class="fav_min_text">

                                                    	<span>Shop Owner</span><br />

                                                       <a href="view-people/<?php echo $shops['seller_username']; ?>"><?php echo $shops['seller_firstname']; ?></a>

                                                    </div>

                                                </li>

                                              	<?php  

													$itemcount=0; $listitems=0;

													for($i=0;$i<count($userFavoriteShopsProducts);$i++)

													{

														if($userFavoriteShopsProducts[$i]['user_id']==$shops['seller_id'] )

														{ 

															if($listitems<4){

																$img=explode(',',$userFavoriteShopsProducts[$i]['image']); 

												?>

                                                <li>

                                                    <a href="products/<?php echo $userFavoriteShopsProducts[$i]['seourl']; ?>">

                                                        <div class="seller-outer">

                                                            <div class="seller-inner">

                                                                <img src="images/product/thumb/<?php echo $img[0]; ?>" width="75" height="75">

                                                            </div>

                                                        </div>

                                                    </a>

                                                </li>

                                                <?php } $itemcount=$itemcount+1; $listitems++; }  }?>

                                                <li>

                                                    <a href="shop-section/<?php echo $shops['seourl']; ?>">

                                                        <div class="seller-outer count-box">

                                                            <div class="seller-inner">

                                                                <span class="count-number"><?php echo $itemcount; ?></span>

                                                                items

                                                            </div>

                                                        </div>

                                                    </a>

                                                </li>

                                                <?php  ?>

                                        	</ul>

                                        	<?php } ?>

                                        

                                        

                                            	

                                          </div> 

                                          

                                          

                                          

                                          <div class="TabbedPanelsContent">

                                          <?php if($currUser['shopsy_session_user_name']==urldecode($this->uri->segment(2,0))){ ?>

                                          <div class="favo_image"><a class="edit_trigger" href="#"><span class="edit-icon">⚙</span>Edit</a></div>

                                          <?php } ?>

                                          <div class="outer_tab1">

                                          <div class="outer_tab_2">

                                          <div class="tab_content">

                                          

                                          <h1>Your favorite Treasury lists will live here.</h1>

                                    		<p><a href="#">The Treasury</a>is shopsy's member-curated shopping gallery.</p>

                                          

                                          </div>

                                          

                                          

                                          

                                          </div>

                                          </div>

                                          

                                             

                                             

                                          </div>

                                     <script type="text/javascript">

                                        <!--

                                        var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");

                                        //-->

                                        </script>

                                        

                                        </div>

                                        

                                       <div class="clear"></div>

                                       <!--end of tab panels-->

                                      </div>

                

              

            <div class="clear" style="min-height:250px;"></div>

         

   

                   </div>

                </div>

            </div>

        </div>

    </section>

   </div>

  

<script src="js/jquery.colorbox.js"></script>

<script>

$(document).ready(function(){



		$(".cboxClose1").click(function(){

			$("#cboxOverlay,#colorbox").hide();

			});

		

			$(".edit_trigger").colorbox({width:"470px", height:"auto", inline:true, href:"#inline_reg11"});

						

		

		//Example of preserving a JavaScript event for inline calls.

			$("#onLoad").click(function(){ 

				$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");

				return false;

			});



});



function openItem(){

			$("#openitem").colorbox({width:"470px", height:"auto", inline:true, href:"#inline_reg11"});

}



</script>

    <div id='shopFavedit_popup' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="site/user/update_user_favorite_shop_staus"  method="post">
					<input type="hidden" name="uid" id="uid" value="<?php echo $this->session->userdata('shopsy_session_user_id'); ?>"  />

				    <div style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0.4); padding:10px ;float:left; width: 85%;"> 

				        <div style="background:#fff ; border-radius:5px 5px 0 0">

							<h2 class="edit_popup_header">
							<?php if($this->lang->line('user_edit_list') != '') { echo stripslashes($this->lang->line('user_edit_list')); } else echo 'Edit List'; ?>
						  </h2> 
							<div class="edit_popup_section">

								<span><?php if($this->lang->line('user_who_can_list') != '') { echo stripslashes($this->lang->line('user_who_can_list')); } else echo 'Who can see this list'; ?>?</span>

								<div class="radio-popup">

									<input  class="radio" type="radio" value="public" name="privacy_level" <?php if($userProfileDetails[0]['shop_visibility']=="Public"){ echo 'checked="checked"';} ?>></input>

									<label class="editpop-label">

										<?php if($this->lang->line('any-fav') != '') { echo stripslashes($this->lang->line('any-fav')); } else echo "Anyone can see my favorite shops"; ?>

									</label>

								</div>

								<div class="radio-popup">

									<input  class="radio" type="radio" value="private" name="privacy_level" <?php if($userProfileDetails[0]['shop_visibility']=="Private"){ echo 'checked="checked"';} ?>></input>

									<label class="editpop-label">

										<?php if($this->lang->line('my-fav') != '') { echo stripslashes($this->lang->line('my-fav')); } else echo "Only I can see my favorite shops"; ?>

									</label>

								</div>

					         </div>  
							<div class="modal-footer footer_tab_footer">
								<div class="btn-group">
										<input class="submit_btn" type="submit" value="<?php if($this->lang->line('user_save') != '') { echo stripslashes($this->lang->line('user_save')); } else echo 'Save'; ?>" ></input>
										<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php echo shopsy_lg('lg_cancel','Cancel');?></a>
								</div>
								</div>
							</div>								
				        </div>
					</div>
				</form>
			</div>
		</div>	
    </div>

<style>

#cboxLoadedContent{background:none;}



.edit_popup_footer{ width: 90.6%;

}





#cboxClose {    right: 12px;  top: 10px;}





</style>

 <?php 

$this->load->view('site/templates/footer');

?>

