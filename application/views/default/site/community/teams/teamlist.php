<?php  $this->load->view('site/templates/header');  ?>
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
function validatNews(){
var EmaNews=$("#awf_field-57520717").val();
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 if(EmaNews!='' && regex.test(EmaNews)){
  $("#errMsg").css('display','none');
 $("#af-form-wrapper").submit();
 
 }else{
 	 $("#errMsg").css('display','block');
	$("#af-form-wrapper").submit(function(e){
        e.preventDefault();
		 $(this).unbind('submit').submit()
    });
 	return false;
 }
}
</script>
<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
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
            	<li> <a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
                   <span>&rsaquo;</span>
                   <li><a class="a_links" href="<?php echo base_url().'community'; ?>"><?php if($this->lang->line('user_community') != '') { echo stripslashes($this->lang->line('user_community')); } else echo "Community"; ?></a></li>
            <span>&rsaquo;</span>
            	<li><a><?php if($this->lang->line('user_teams') != '') { echo stripslashes($this->lang->line('user_teams')); } else echo "Teams"; ?></a></li>
            </ul>
            <div class="community_page">
            	<div class="community_head">
                	<h1><?php if($this->lang->line('com_allteams') != '') { echo stripslashes($this->lang->line('com_allteams')); } else echo "All Teams"; ?></h1>
                    <span><?php if($this->lang->line('com_peoplemeet') != '') { echo stripslashes($this->lang->line('com_peoplemeet')); } else echo "Meet people with common interests and collaborate"; ?>.</span>
                    <?php if($this->data['userId']!=''){ ?>
                    <a href="add-team" class="asubscribe_btn" style="float:right"><?php if($this->lang->line('com_createteam') != '') { echo stripslashes($this->lang->line('com_createteam')); } else echo "Create a Team"; ?></a><?php } ?>
                </div>
                <div class="community_div">
         
                    <div class="community_right">
                    <div class="search_bar" style="margin-top:0px;  padding: 5px 5px 8px; width:100%;">
                   		 <form name="teamSearch" id="teamSearch" action="site/community/teamSearch" enctype="multipart/form-data" method="post">
                        	<input type="text" value="" name="searcKeys" placeholder="<?php if($this->lang->line('com_searchteams') != '') { echo stripslashes($this->lang->line('com_searchteams')); } else echo "Search in Teams"; ?>" class="search" style="width:35%; margin-left:0; margin-right:5px;" />
                            <input type="submit" value="<?php if($this->lang->line('land_search') != '') { echo stripslashes($this->lang->line('land_search')); } else echo "Search"; ?>" style="margin:0" class="subscribe_btn">
                        </form>
                            <?php /*?><div class="most_recent">
                            	<label>Sort by: </label>
                                <a href="#" class="sort_link" style="background:url(images/arrow.png) no-repeat right; padding:0px 14px 0px 0px">Most Recent</a>
                                <!--<ul class="sort_list">
                                	<li><a href="#">Relevancy</a></li>
                                    <li><a href="#">Most Recent</a></li>
                                    <li><a href="#">Most Recent</a></li>
                                </ul>-->
                            </div><?php */?>                            
                        </div>    
                        <?php /*?><ul class="team_list_main">
                            	<li>
                                	<div class="team_img"><img src="images/tt.jpg" /></div>
                                    <div class="team_info">
                                    	<a href="#"><h2>Gaining more admirers and connecting</h2></a>
                                        <p>This is a closed team for only immediate friends and family that sell through <?php echo $this->config->item('email_title'); ?>. </p>
                                    </div>
                                    <div class="team_member">
                                    	<p><a href="#" style="color:#808080">3 members</a></p>
                                        <a href="#"><img src="images/1.jpg" /></a>
                                        
                                    </div>
                                </li>
                                <li>
                                	<div class="team_img"><img src="images/2.jpg" /></div>
                                    <div class="team_info">
                                    	<a href="#"><h2>Karma Club</h2></a>
                                        <p>What goes around comes around! This team is to help each other get sales, views and favorites! Let's go the extra mile for each other!  </p>
                                    </div>
                                    <div class="team_member">
                                    	<p><a href="#" style="color:#808080">1 members</a></p>
                                        <a href="#"><img src="images/iusa_75x75.5293802.jpg" /></a>
                                      
                                    </div>
                                </li>
                                <li>
                                	<div class="team_img"><img src="images/iga_170x100.18767_au6a.jpg" /></div>
                                    <div class="team_info">
                                    	<a href="#"><h2>2014 Success Team</h2></a>
                                        <p>This team is for those that want to take their shop to the next level and make 2014 their most successful year! </p>
                                    </div>
                                    <div class="team_member">
                                    	<p><a href="#" style="color:#808080">3 members</a></p>
                                        <a href="#"><img src="images/iusa_75x75.5293802.jpg" /></a>
                                        <a href="#"><img src="images/iusa_75x75.5293802.jpg" /></a>
                                        <a href="#"><img src="images/iusa_75x75.5293802.jpg" /></a>
                                    </div>
                                </li>
                                <li>
                                	<div class="team_img"><img src="images/iga_170x100.18767_au6a.jpg" /></div>
                                    <div class="team_info">
                                    	<a href="#"><h2>Promotion and Sales!</h2></a>
                                        <p>This team is for anyone looking to be featured in a treasury or wanting to promote their items on discussions! </p>
                                    </div>
                                    <div class="team_member">
                                    	<p><a href="#" style="color:#808080">3 members</a></p>
                                        <a href="#"><img src="images/iusa_75x75.5293802.jpg" /></a>
                                        <a href="#"><img src="images/iusa_75x75.5293802.jpg" /></a>
                                        <a href="#"><img src="images/iusa_75x75.5293802.jpg" /></a>
                                    </div>
                                </li>
                            </ul><?php */?>     
                            <?php if(!empty($UserteamsList) > 0) {  ?>
                        <h2> <?php if($this->lang->line('com_yourteams') != '') { echo stripslashes($this->lang->line('com_yourteams')); } else echo "Your Teams"; ?></h2>
                        <ul class="team_list_main">
                            	<?php foreach($UserteamsList as $team_list_details) {  ?>
                                
                                <li>
                                <?php if($team_list_details['teamImage']!=''){ ?>
                                	<div class="team_img"><img src="<?php echo base_url().TEAM_PATH.stripslashes($team_list_details['teamImage']);?>" /></div>
                                 <?php }else{ ?>
                                	<div class="team_img"><img src="<?php echo base_url().TEAM_PATH.'no-team-logo.png';?>" /></div>
                                 <?php } ?>
                                    <div class="team_info">
                                    	<a href="team/<?php echo $team_list_details['id'].'/'.$team_list_details['teamSeourl']; ?>"><h2><?php echo stripslashes($team_list_details['teamName']);?></h2></a><p><?php echo character_limiter(stripslashes($team_list_details['teamShortdescription']),100);?></p>
                                       
                                    </div>
                                    <?php $member_condition1=array('teamId'=>$team_list_details['id']);
			
			$memberList= $this->community_model->get_all_Teammemberinfo($member_condition1);  ?>
            	
                	<div class="team_member">
                                    	<p><a href="team-members/<?php echo $team_list_details['id'].'/'.$team_list_details['teamSeourl']; ?>" style="color:#808080"><?php echo $memberList->num_rows(); ?> <?php if($this->lang->line('com_members') != '') { echo stripslashes($this->lang->line('com_members')); } else echo "members"; ?></a></p>
                                        <?php $i=0; foreach($memberList->result_array() as $memList){ ?>
                                        <?php if($i<3){ if($memList['thumbnail']!=''){ ?>
                                            <a href="team-members/<?php echo $team_list_details['id'].'/'.$team_list_details['teamSeourl']; ?>"><img src="<?php echo base_url().USERIMAGEPATH.stripslashes($memList['thumbnail']); ?>" /></a>
                                         <?php }else{ ?>
                                         	<a href="team-members/<?php echo $team_list_details['id'].'/'.$team_list_details['teamSeourl']; ?>"><img src="<?php echo base_url().USERIMAGEPATH.'profile_pic.png'; ?>" /></a>
                                         <?php  } } } ?>
                                    </div>
                                    
                                </li>
                                <?php } ?>
                            </ul>                       
            			<?php }  ?>
                        <?php if(!empty($teamsList) > 0) {  ?>
                         <h2> <?php if($this->lang->line('com_activeteams') != '') { echo stripslashes($this->lang->line('com_activeteams')); } else echo "Active Teams"; ?></h2>
                        <ul class="team_list_main">
                            	<?php foreach($teamsList as $team_list_details) {  ?>
                                
                                <li>
                                <?php if($team_list_details['teamImage']!=''){ ?>
                                	<div class="team_img"><img src="<?php echo base_url().TEAM_PATH.stripslashes($team_list_details['teamImage']);?>" /></div>
                                 <?php }else{ ?>
                                	<div class="team_img"><img src="<?php echo base_url().TEAM_PATH.'no-team-logo.png';?>" /></div>
                                 <?php } ?>
                                    <div class="team_info">
                                    	<a href="team/<?php echo $team_list_details['id'].'/'.$team_list_details['teamSeourl']; ?>"><h2><?php echo stripslashes($team_list_details['teamName']);?></h2></a>   <p><?php echo character_limiter(stripslashes($team_list_details['teamShortdescription']),100);?></p>   
                                    </div>
                                    <?php $member_condition1=array('teamId'=>$team_list_details['id']);
			$memberList= $this->community_model->get_all_Teammemberinfo($member_condition1);  ?>
                	<div class="team_member">
                                    	<p><a href="team-members/<?php echo $team_list_details['id'].'/'.$team_list_details['teamSeourl']; ?>" style="color:#808080"><?php echo $memberList->num_rows(); ?> <?php if($this->lang->line('com_members') != '') { echo stripslashes($this->lang->line('com_members')); } else echo "members"; ?></a></p>
                                        <?php $i=0; foreach($memberList->result_array() as $memList){ ?>
                                        <?php if($i<3){ if($memList['thumbnail']!=''){ ?>
                                            <a href="team-members/<?php echo $team_list_details['id'].'/'.$team_list_details['teamSeourl']; ?>"><img src="<?php echo base_url().USERIMAGEPATH.stripslashes($memList['thumbnail']); ?>" /></a>
                                         <?php }else{ ?>
                                         	<a href="team-members/<?php echo $team_list_details['id'].'/'.$team_list_details['teamSeourl']; ?>"><img src="<?php echo base_url().USERIMAGEPATH.'profile_pic.png'; ?>" /></a>
                                         <?php  } } } ?>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>      

						
							
            			<?php } else if(count($UserteamsList)<=0) { ?>
                        <div style="color: red; text-align:center; margin-top: 141px; font-size:16px"><?php if($this->lang->line('shopsec_results_not_found') != '') { echo stripslashes($this->lang->line('shopsec_results_not_found')); } else echo "Team(s) Not Available"; ?></div>
                        <?php } ?>    

						
						
                    </div>
					
		
					
                </div>
            </div>
        </div>
    </section>
</div>
<!-- section_end -->
<?php  $this->load->view('site/templates/footer');  ?>