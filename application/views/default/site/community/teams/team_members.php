<?php  $this->load->view('site/templates/header');  
	$this->load->model('community_model');?>
<?php $TeamName=$this->data['teamsList']->result_array(); //echo '<pre>';print_r($memberList->result_array()); die; ?>
<!--selection-->
<?php 
$teamMemberIdList = array();
if($segMent4!='captain'){
	$teammemberList=$memberList->result_array();
	foreach($teammemberList as $teammemList){ $teamMemberIdList[]= $teammemList['id']; }
	 }else{
	 	foreach($memberList->result_array() as $teammemList){ $teamMemberIdList[]= $teammemList['id']; }
	 }
	 
	$teamcaptainList=$CaptainList->result_array();
	//echo '<pre>';print_r($teammemberList); die; ?>
<section class="container">
	
    	<div class="main">
        <ul class="bread_crumbs">
        	<li> <a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
            <li> <a href="teams" class="a_links"><?php if($this->lang->line('user_teams') != '') { echo stripslashes($this->lang->line('user_teams')); } else echo "Teams"; ?></a></li>
            <span>&rsaquo;</span>
             <li> <a href="team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>" class="a_links"><?php echo $TeamName[0]['teamName']; ?></a></li>
             <span>&rsaquo;</span>
             <li> <a href="javascript:void(0);" class="a_links"><?php if($this->lang->line('com_members') != '') { echo stripslashes($this->lang->line('com_members')); } else echo "Members"; ?></a></li>
        </ul>
       
        <div class="clear"></div>
        <div class="community_page">
        	<div class="community_head">
             <h1><?php echo $TeamName[0]['teamName']; ?></h1>
                    
                </div> 
                 <div class="community_div">    
                    <div class="community_left">
                    <div class="side_bar" style="width:97%;">
                    <?php if($TeamName[0]['teamImage']!=''){ //echo $TeamName[0]['teamImage']; die; ?>
                                  <a href="team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>"><img width="90%" src="<?php echo base_url().TEAM_PATH.$TeamName[0]['teamImage']; ?>" alt="<?php echo $TeamName[0]['teamName']; ?>" class="mar" /></a>
                     <?php }else{ ?>   
                                  <a href="team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>"><img src="<?php echo base_url().TEAM_PATH.'no-team-logo.png'; ?>" alt="<?php echo $TeamName[0]['teamName']; ?>" class="mar" style="margin:0 25px 15px !important" /></a>
                     <?php } ?>          
                                     <?php if(in_array($userId,$teamMemberIdList)){ ?>  
                 <a href="leave-team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>" class="asubscribe_btn"  style="margin:2px 2px 10px 45px; padding:5px 10px"><?php if($this->lang->line('com_leaveteam') != '') { echo stripslashes($this->lang->line('com_leaveteam')); } else echo "Leave this team"; ?></a>
                <?php }elseif($teamcaptainList[0]['id']==$userId){ ?> 
                 <a class="asubscribe_btn"  style="margin:2px 2px 10px 45px; padding:5px 10px"><?php if($this->lang->line('com_yourteam') != '') { echo stripslashes($this->lang->line('com_yourteam')); } else echo "Your Team"; ?></a>
				<?php }else{ ?><a href="join-team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>" class="asubscribe_btn"  style="margin:2px 2px 10px 45px; padding:5px 10px"><?php if($this->lang->line('com_jointhisteam') != '') { echo stripslashes($this->lang->line('com_jointhisteam')); } else echo "Join this team"; ?></a>
                <?php } ?>
                                     <!-- Side Menu for Community Satart---------------------->
                            <?php  $this->load->view('site/community/templates/community_menu');  ?>
                        <!-- Side Menu for Community End---------------------->    
                                </div>
                                <div class="clear"></div>
                       
                           <div class="clear"></div>
                           <div class="middle_margin"></div>
                           <div class="side_link">
                              <h2 style="border:none;"><?php if($this->lang->line('shop_tags') != '') { echo stripslashes($this->lang->line('shop_tags')); } else echo "Tags"; ?></h2>
                              <?php $tagTeam=explode(",",$TeamName[0]['teamTags']);  ?>
                              <?php foreach($tagTeam as $key => $val){ ?>
                              <a  class="tage_use" href="teams-search/<?php echo $val; ?>"><?php echo $val; ?></a>
                              <?php } ?>
                              
                              </div>
                          
                 <!-- Side Menu for Community Satart---------------------->
                <?php  $this->load->view('site/community/templates/team_sidebar');  ?>
                <!-- Side Menu for Community End---------------------->   
                             <div class="side_link">
                             <ul>
                                    <li><a href="#"> <?php if($this->lang->line('com_reportteam') != '') { echo stripslashes($this->lang->line('com_reportteam')); } else echo "Report this team to"; ?> <?php echo $this->config->item('email_title'); ?></a></li>
                                    <li><a href="#"> <?php if($this->lang->line('com_contactcap') != '') { echo stripslashes($this->lang->line('com_contactcap')); } else echo "Contact the Captain"; ?></a></li>
                                </ul>
                            
                            </div>
                           
                    </div>
                    <div class="right_split">
                                <div class="community_right">
                                  <div class=" member_view" style="margin-top:0px;">
                               <h2><?php if($this->lang->line('com_members') != '') { echo stripslashes($this->lang->line('com_members')); } else echo "Members"; ?></h2><a href="team-members/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>/all" class="sort_link_1"><?php if($this->lang->line('com_viewall') != '') { echo stripslashes($this->lang->line('com_viewall')); } else echo "View All"; ?></a> <span> (<?php echo $memberList->num_rows()+$CaptainList->num_rows(); ?>)</span><a href="team-members/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>/captain" class="sort_link_1"><?php if($this->lang->line('com_viewcaptain') != '') { echo stripslashes($this->lang->line('com_viewcaptain')); } else echo "View Captain"; ?></a><span> (<?php echo $CaptainList->num_rows(); ?>)</span>
                             <div class="sort-by" style="float:right;">
                              <span style="font-size:12px;"><?php if($this->lang->line('com_sortby') != '') { echo stripslashes($this->lang->line('com_sortby')); } else echo "Sort by"; ?></span><a href="team-members/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>/last-update" <?php if($segMent4=='last-update'){ ?> class="line_active"  <?php } ?>style="font-size:12px;"><?php if($this->lang->line('shopsec_updated') != '') { echo stripslashes($this->lang->line('shopsec_updated')); } else echo "Last Updated"; ?></a> | <a href="team-members/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>/name" <?php if($segMent4=='name'){ ?> class="line_active" <?php } ?> style="font-size:12px;">  <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?></a>
                             </div>
                             <div class="clear"></div>
                               <ul class="member_use">
                               <?php if(count($teamcaptainList)>0){ ?>
                                <li>
                                <div class="mem_avatar">
                                <?php if($teamcaptainList[0]['thumbnail']!='') { ?>
                                 <img src="<?php echo base_url().USERIMAGEPATH.stripslashes($teamcaptainList[0]['thumbnail']);?>"  width="60px"/>
                                <?php }else{ ?>
                                  <img src="<?php echo base_url().USERIMAGEPATH.'profile_pic.png';?>"  width="60px"/>
                                <?php } ?>
                                </div>
                               <h2 class="member-title">
                               <a href="view-profile/<?php echo $teamcaptainList[0]['user_name']; ?>"  class="sort_link_1" style="font-size:12px;"><?php  echo $teamcaptainList[0]['full_name']?> (Captain)</a>
                               </h2>
                               <?php if( $teamcaptainList[0]['shopurl']!='') { ?>
                               <div style="float:left "><img src="images/flow.png" style="margin-top:0px; float:left;" /><a class="sort_link_mem" href="shop-section/<?php echo $teamcaptainList[0]['shopurl']; ?>"  style="width:100%;"><?php echo $teamcaptainList[0]['seller_businessname']; ?> </a>
                               </div>
                               <?php } ?>
                               <span> <?php echo $teamcaptainList[0]['city']?> </span>
                               </li>
                               <?php } ?>
                                <?php if(count($teammemberList)>0){ ?>
                                <?php foreach($teammemberList as $member){ ?>
                               <li>
                                <div class="mem_avatar">
                                  <?php if($member['thumbnail']!='') { ?>
                                 <img src="<?php echo base_url().USERIMAGEPATH.stripslashes($member['thumbnail']);?>"  width="60px"/>
                                <?php }else{ ?>
                                  <img src="<?php echo base_url().USERIMAGEPATH.'profile_pic.png';?>"  width="60px"/>
                                <?php } ?>
                                </div>
                               <h2 class="member-title">
                               <a href="view-profile/<?php echo $member['user_name']; ?>"  class="sort_link_1" style="font-size:12px;"><?php echo $member['full_name']; ?> </a>
                               </h2>
                                <?php if( $member['shopurl']!='') { ?>
                               <div style="float:left;">
                               <img src="images/flow.png" style="margin-top:0px; float:left;" /><a class="sort_link_mem" href="store/<?php echo $member['id'].'-'.$member['shopurl']; ?>"  style="width:100%;"><?php echo $member['seller_businessname']; ?> </a>
                               </div>
                               <?php } ?>
                               <span> <?php echo $member['city'] ?> </span>
                               </li>
                               <?php } } ?>
                               </ul>
                           
                               </div>
                               </div>
                            
                            
                    <!--rightsplit-->
                    </div>
                  </div>
       </div>
        </div>
        
    
 
	
</section>
<!--selection-->
<?php  $this->load->view('site/templates/footer');  ?>