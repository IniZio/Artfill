<?php  $this->load->view('site/templates/header');  ?>
<!-- Second, add the Timer and Easing plugins -->
<script type="text/javascript" src="js/jquery.timers-1.2.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<!-- Third, add the GalleryView Javascript and CSS files -->
<script type="text/javascript" src="js/jquery.galleryview-3.0-dev.js"></script>
<link type="text/css" rel="stylesheet" href="css/default/jquery.galleryview-3.0-dev.css" />
<script type="text/javascript">
	$(function(){
		<?php if(!empty($bannerList)){ ?>
		$('#myGallery').galleryView();
	<?php } ?>	
	});
</script>
<script type="text/javascript" src="js/jcarousellite_1.0.1.pack.js"></script>
<script type="text/javascript">
		$(function() {
    		$(".slider_1").jCarouselLite({
        		btnNext: ".next_1",
        		btnPrev: ".prev_1",
				auto: false,
    			speed: 1000,
        		visible: 2
    		});
		});
</script>
		<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
<!---------Selection----------->

<div class="add_steps shop-menu-list">

	<div class="main">
	
			
				<!-- Side Menu for Community Satart---------------------->
							<?php  $this->load->view('site/community/templates/community_menu');  ?>
                        <!-- Side Menu for Community End---------------------->    
			
			</div>
			
			</div>
<div id="profile_div">
<section class="container">



    	<div class="main">
			
		
		
        	<ul class="bread_crumbs">
            	<?php 
$first_segment = $this->uri->segment(1);
$second_segment = $this->uri->segment(2);
$third_segment = $this->uri->segment(3); ?>
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><?php if($first_segment=='community'){ ?><a class="a_links"><?php if($this->lang->line('user_community') != '') { echo stripslashes($this->lang->line('user_community')); } else echo "Community"; ?></a><?php } ?></li>
              </ul>
            <div class="community_page">
            	<div class="community_head">
                	<h1><?php if($this->lang->line('user_community') != '') { echo stripslashes($this->lang->line('user_community')); } else echo "Community"; ?></h1>
                    <span><?php if($this->lang->line('com_connectshopsyans') != '') { echo stripslashes($this->lang->line('com_connectshopsyans')); } else echo "Connect with fellow shopsyans"; ?>.</span>
                </div>
                <div class="community_div">
                
                    <div class="community_right">
                    	<div style="float:left; width:100%;">
                        	<div class="row_left">
                            	<div class="panel_inner">
                                	<p><?php if($this->lang->line('com_marketplace') != '') { echo stripslashes($this->lang->line('com_marketplace')); } else echo "is more than a marketplace: we're a community of artists, creators, collectors, thinkers and doers"; ?> </p>
                                    
                                    <a href="teams"><?php if($this->lang->line('com_joinateam') != '') { echo stripslashes($this->lang->line('com_joinateam')); } else echo "Join a team"; ?></a><p>&nbsp;/&nbsp;</p><a href="events"><?php if($this->lang->line('com_eventinarea') != '') { echo stripslashes($this->lang->line('com_eventinarea')); } else echo "Attend an event in your area"; ?></a>.
                                    
                                </div>                                
                            </div>
                            <div class="row_left-left">
                            	<div class="panel_inner" style="width:84%">
                                	<h1 style="font-size:12px; color:#333; border-bottom:1px solid #DEDEDB; font-weight:bold; margin-bottom: 8px; padding: 0 0 8px;"><?php echo $this->config->item('email_title'); ?> 
									<?php if($this->lang->line('com_elsewhere') != '') { echo stripslashes($this->lang->line('com_elsewhere')); } else echo "Elsewhere"; ?></h1>
                                    <ul class="social">
                                    	<li style="background:url(images/tweet.png) no-repeat"><a href="<?php echo $this->config->item('twitter_link');?>" target="_blank"> <?php if($this->lang->line('comm_twitter') != '') { echo stripslashes($this->lang->line('comm_twitter')); } else echo "Twitter"; ?></a></li>
                                        <li style="background:url(images/fb.png) no-repeat"><a href="<?php echo $this->config->item('facebook_link');?>" target="_blank"> <?php if($this->lang->line('comm_facebook') != '') { echo stripslashes($this->lang->line('comm_facebook')); } else echo "Facebook"; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
						<?php if(count($bannerList) >0){ ?>
                        <div class="comm_slider">
                        	<span style="color:#333333; font-size:12px; font-weight:bold"><?php if($this->lang->line('com_fromlabs') != '') { echo stripslashes($this->lang->line('com_fromlabs')); } else echo "From the Labs"; ?></span>
                          <!--  <a href="<?php echo $this->config->item('linkedin_link');?>" target="_blank"><?php if($this->lang->line('see_more') != '') { echo stripslashes($this->lang->line('see_more')); } else echo "See more"; ?></a>-->
                        	<ul id="myGallery">
                              <?php foreach($bannerList as $imageList){ ?>
                            	<li><img src="<?php echo base_url().BANNERPATH.$imageList['image']; ?>" alt="<?php echo $imageList['name']; ?>" title="<?php echo $imageList['name']; ?>" /></li>
                                <?php } ?>
                            </ul>
                        </div>
						<?php }?>
                        <div class="story_slider">
	                        <span style="color:#333333; font-size:12px; float:left; margin-top:10px; font-weight:bold"><?php if($this->lang->line('com_communitystories') != '') { echo stripslashes($this->lang->line('com_communitystories')); } else echo "Community Stories"; ?></span>
                            <a href="community-newslist" style="float:left; margin:10px 0 0 10px;"><?php if($this->lang->line('see_more') != '') { echo stripslashes($this->lang->line('see_more')); } else echo "See more"; ?></a>
                            <div class="next_1"><img src="images/right_arrow.png" alt="next" /></div>
                            <div class="prev_1"><img src="images/left_arrow.png" alt="prev" /></div>                
<?php #echo '<pre>'; print_r($storeBlog); ?>							
                        	<div class="slider_1">
                                <ul>
                                 <?php 
								 foreach($storeBlog as $newList){ ?>
                                    <li>
                                    	<div class="slider_left">
                                        <?php if($newList['post_image']!=''){ ?>
                                        <img src="<?php echo base_url().COMMUNITY_NEWS_PATH_THUMB.$newList['post_image']; ?>" />
                                        <?php }else{ ?>
                                         <img src="<?php echo base_url().COMMUNITY_NEWS_PATH_THUMB.'no-image.jpg'; ?>" />
                                        <?php } ?>
                                        </div>
                                        <div class="slider_right">
                                        		<a href="<?php echo $newList['post_id'].'/news-details'; ?>" ><?php echo character_limiter(strip_tags($newList['post_title']),30); ?> </a><br />
                                            <p class="prot_tex" ><?php echo character_limiter(strip_tags($newList['post_content']),100); ?> </p>
											<a href="view-profile/<?php echo $newList['user_name']; ?>" style="margin:5px 0 0"><?php echo $newList['user_name']; ?></a>
											
                                            <a href="<?php echo $newList['post_id'].'/news-details'; ?>" style="margin:5px 0 0"><?php if($this->lang->line('land_read') != '') { echo stripslashes($this->lang->line('land_read')); } else echo "Read the post"; ?></a>
											
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!--selection-->

<?php  $this->load->view('site/templates/footer');  ?>