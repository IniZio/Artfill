<?php $this->load->view('site/templates/header');  ?>
<!-- Second, add the Timer and Easing plugins -->
<!-- Third, add the GalleryView Javascript and CSS files -->
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.0b2.js"></script>-->

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
		
function validatNews(){
var EmaNews=$("#awf_field-57520717").val();
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 if(EmaNews!='' && regex.test(EmaNews)){
 $("#errMsg").css('display','none');
 $("#af-form-wrapper").submit();
 }else{
	$("#af-form-wrapper").submit(function(e){
		$("#errMsg").css('display','block');
        e.preventDefault();
		$(this).unbind('submit').submit()
    });
 	return false;
 }}
</script>
<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
<!-- section_start -->
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
           <li><a class="a_links" href="<?php echo base_url().'community'; ?>"><?php if($this->lang->line('user_community') != '') { echo stripslashes($this->lang->line('user_community')); } else echo "Community"; ?></a></li>
            <span>&rsaquo;</span>
            <li><?php if($first_segment=='events'){ ?><a><?php if($this->lang->line('comm_events') != '') { echo stripslashes($this->lang->line('comm_events')); } else echo "Events"; ?></a><?php } ?></li>
            </ul>
            <div class="community_page">
            	<div class="community_head">
                	<h1><?php if($this->lang->line('comm_events') != '') { echo stripslashes($this->lang->line('comm_events')); } else echo "Events"; ?></h1>
                    <span><?php if($this->lang->line('com_makedate') != '') { echo stripslashes($this->lang->line('com_makedate')); } else echo "Make a date with"; ?> <?php echo $this->config->item('email_title'); ?>.</span>
                </div>
                <div class="community_div">

                    <div class="community_right">
                    	<div style="float:left; width:100%;">
                        	<div class="row_left">
                            	<div class="panel_inner">
                               	<p><?php if($this->lang->line('com_connectwith') != '') { echo stripslashes($this->lang->line('com_connectwith')); } else echo "Connect with the"; ?>  <a href="community"><?php if($this->lang->line('com_inperson') != '') { echo stripslashes($this->lang->line('com_inperson')); } else echo "in person"; ?></a> - <?php if($this->lang->line('com_findus') != '') { echo stripslashes($this->lang->line('com_findus')); } else echo "find us at the"; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('com_labsan') != '') { echo stripslashes($this->lang->line('com_labsan')); } else echo "Labs or an"; ?> <?php if($this->lang->line('com_event') != '') { echo stripslashes($this->lang->line('com_event')); } else echo "event"; ?> <?php if($this->lang->line('com_nearyou') != '') { echo stripslashes($this->lang->line('com_nearyou')); } else echo "near you"; ?>.</p>
                                   <?php /*?> <p>No matter where you are, join us in our <a href="#">Online Labs.</a></p><?php */?>
                                </div>                                
                            </div>
                             <div class="row_left-left">
                            	<?php /*?><div class="panel_inner" style="width:84%; min-height:115px">
                                	<h1 style="font-size:12px; color:#333; border-bottom:1px solid #DEDEDB; font-weight:bold; margin-bottom: 8px; padding: 0 0 8px;">Sign up for event news</h1>
                                    <p style="color: #666666; font-size: 12px; margin:0 0 4px">Crafty projects and events from the <?php echo $this->config->item('email_title'); ?> Labs in Brooklyn.</p>
                                    <input type="button" value="Sign Up" class="subscribe_btn" />
                                </div><?php */?>
                                <div class="panel_inner" style="width:84%">
                                <?php $com_craftyprojects = str_replace("{SITENAME}",$siteTitle,$this->lang->line('user_wo_ur_permis')); ?>
                                <b><?php if($this->lang->line('com_eventnews') != '') { echo stripslashes($this->lang->line('com_eventnews')); } else echo "Sign up for event news"; ?></b><p style="font-size: 12px;">
								
								<?php if($this->lang->line('com_craftyprojects') != '') { echo stripslashes($com_craftyprojects); } else echo "Crafty projects and events from ".stripslashes($siteTitle); ?>
								</p>
                                <?php
									if(!empty($this->session->userdata['shopsy_session_user_name'])){
										if($sel_qry->num_rows() == 0){
								?>
											<a class="asubscribe_btn" style="margin-top:0px; color:#fff; font-weight:normal; font-size:13px" href="site/user/subscribeUserEvent"><?php if($this->lang->line('com_signup') != '') { echo stripslashes($this->lang->line('com_signup')); } else echo "Sign up"; ?></a>
                                <?php }
								}else{?>
                                <a class="asubscribe_btn" style="margin-top:0px; color:#fff; font-weight:normal; font-size:13px" href="register"><?php if($this->lang->line('com_signup') != '') { echo stripslashes($this->lang->line('com_signup')); } else echo "Sign up"; ?></a>
                                <?php }?>
                                <!--  	<h1 style="font-size:12px; color:#333; border-bottom:1px solid #DEDEDB; font-weight:bold; margin-bottom: 8px; padding: 0 0 8px;"><?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('com_elsewhere') != '') { echo stripslashes($this->lang->line('com_elsewhere')); } else echo "Elsewhere"; ?></h1>
                                    <ul class="social">
                                    	<li style="background:url(images/fb.png) no-repeat"><a href="<?php echo $this->config->item('twitter_link');?>" target="_blank"><?php if($this->lang->line('comm_twitter') != '') { echo stripslashes($this->lang->line('comm_twitter')); } else echo "Twitter"; ?></a></li>
                                        <li style="background:url(images/tweet.png) no-repeat"><a href="<?php echo $this->config->item('facebook_link');?>" target="_blank"><?php if($this->lang->line('comm_facebook') != '') { echo stripslashes($this->lang->line('comm_facebook')); } else echo "Facebook"; ?></a></li>
                                    </ul>-->    
                                </div>
                            </div>
                        </div>
                        <div class="special_event">
                        	<span class="spl_head"><?php if($this->lang->line('com_specialevents') != '') { echo stripslashes($this->lang->line('com_specialevents')); } else echo "Special Events"; ?></span>
                             <?php if ($spleventsList->num_rows() > 1){ if($spleventsList->num_rows() > 2){ ?>
                            <div class="next_1"><img src="images/right_arrow.png" alt="next" /></div>
                            <div class="prev_1"><img src="images/left_arrow.png" alt="prev" /></div>  
                            <?php } ?>
                            <div class="slider_1">
                                <ul>
							<?php foreach($spleventsList->result() as $row){  ?>
                                    <li>
                                    <div class="special_event_left">
                                        <img src="<?php echo base_url().EVENT_PATH.stripslashes($row->imagePath); ?>" />
                                    </div>
                                    <div class="special_event_right">
                            	<div class="event_head"><?php echo $row->eventTitle; ?></div>
                                <p><?php echo character_limiter(stripslashes($row->eventDescription), 40); ?></p>
                                <?php if($row->eventLink!=''){ ?>
                                <?php if($row->eventButtonName!=''){ ?>
                                <a href="<?php echo $row->eventLink; ?>" target="_blank" class="asubscribe_btn" style="margin-top:0px;"><?php echo $row->eventButtonName; ?></a>
                                <?php }else{ ?>
                                <a href="<?php echo $row->eventLink; ?>" target="_blank" style="margin-top:0px;" class="asubscribe_btn"><?php if($this->lang->line('shop_readmore') != '') { echo stripslashes($this->lang->line('shop_readmore')); } else echo "Read More"; ?></a>
                                <?php } ?>
                                <?php } ?>
                                <div class="clear"></div>
                                <p style="font-size:11px; margin:5px;"><?php if($this->lang->line('com_photoby') != '') { echo stripslashes($this->lang->line('com_photoby')); } else echo "Photo by"; ?> 
								<a href="view-profile/<?php echo $row->user_name; ?>"><?php echo $row->full_name; ?> </a></p>
                                </div>
                               </li>
                               
                             <?php   } ?>
                                </ul>
                            </div>
                            <?php }else{ ?>                          
							<?php foreach($spleventsList->result() as $row){  ?>
                                    <div class="special_event_left">
                                        <img src="<?php echo base_url().EVENT_PATH.stripslashes($row->imagePath); ?>" />
                                    </div>
                                    <div class="special_event_right">
                            	<div class="event_head"><?php echo $row->eventTitle; ?></div>
                                <p><?php echo character_limiter(stripslashes($row->eventDescription), 200); ?></p>
                                <?php if($row->eventLink!=''){ ?>
                                <?php if($row->eventButtonName!=''){ ?>
                                <a href="<?php echo $row->eventLink; ?>" target="_blank" class="asubscribe_btn" style="margin-top:0px;"><?php echo $row->eventButtonName; ?></a>
                                <?php }else{ ?>
                                <a href="<?php echo $row->eventLink; ?>" target="_blank" style="margin-top:0px;" class="asubscribe_btn"><?php if($this->lang->line('shop_readmore') != '') { echo stripslashes($this->lang->line('shop_readmore')); } else echo "Read More"; ?></a>
                                <?php } ?>
                                <?php } ?>
                                <div class="clear"></div>
                                <p style="font-size:11px; margin:5px;"><?php if($this->lang->line('com_photoby') != '') { echo stripslashes($this->lang->line('com_photoby')); } else echo "Photo by"; ?> <a href="#"><?php echo $row->full_name; ?> </a></p>
                                </div>
                                 
                             <?php   } ?>
                            <?php }?>
                        	  
                        </div>
                        <div class="special_event">
                        	<span class="spl_head"><?php if($this->lang->line('com_eventcalendar') != '') { echo stripslashes($this->lang->line('com_eventcalendar')); } else echo "Event Calendar"; ?></span>
                            <div class="event_list_main">
                               <?php #echo '<pre>'; print_r($eventsList->result());
							   if ($eventsList->num_rows() > 0){
							foreach ($eventsList->result() as $row){  ?>
                            	<ul class="event_list">
                            		<li>
                                		<div class="event_list_left">
                                        	<p><?php echo date('M Y',strtotime($row->eventDate));?></p>
                                        </div>
                                        <div class="event_list_right">
                                        	<div class="event_list_left1">
                                            	<div class="event_date"> <?php echo date('M d',strtotime($row->eventDate));?></div>
                                                <div class="event_time"><?php echo $row->eventTime;?></div>
                              				<?php if($row->eventLocation!='') { ?> <div class="event_location">  <a    target="_blank" href="http://maps.google.com/maps?q=<?php echo $row->eventLocation; ?>"><?php echo $row->eventLocation; ?></a></div> <?php } ?>
                                                <div class="event_host">  <?php if($this->lang->line('com_hostedby') != '') { echo stripslashes($this->lang->line('com_hostedby')); } else echo "Hosted by"; ?> 
												<a href="view-profile/<?php echo $row->user_name; ?>"><?php echo $row->full_name; ?> </a></div>
                                            </div>
                                            <div class="event_list_right1">
                                            	<span><?php echo $row->eventTitle;?></span>
                                                <p><?php  echo  $row->eventDescription;?></p>
                                                <?php if($row->eventLink!=''){ ?>
                                                <?php if($row->eventButtonName!=''){ ?>
                                                	<a href="<?php echo $row->eventLink; ?>" class="asubscribe_btn" target="_blank" ><?php echo $row->eventButtonName; ?></a>
                                                <?php }else{ ?>
                                                	<a href="<?php echo $row->eventLink; ?>" class="asubscribe_btn" target="_blank" ><?php if($this->lang->line('shop_readmore') != '') { echo stripslashes($this->lang->line('shop_readmore')); } else echo "Read More"; ?></a>
                                                <?php } } ?>
                                            </div>
                                        </div>
                               		</li>
                            	</ul>
                            <?php } }else if ($spleventsList->num_rows() == 0) {?>
                            <div style="color: red; text-align:center; margin-top: 50px;"><?php if($this->lang->line('shopsec_results') != '') { echo stripslashes($this->lang->line('shopsec_results')); } else echo "Results Not Found"; ?></div>
                            <?php } ?>
                            	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- section_end -->
<?php $this->load->view('site/templates/footer');  ?>