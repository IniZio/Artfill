<?php  $this->load->view('site/templates/header');  
	$this->load->model('community_model');?>
<?php $TeamName=$this->data['teamsList']->result_array();  ?>
<!--selection-->

<?php 
	$teammemberList=$memberList->result_array();
	$teamcaptainList=$CaptainList->result_array(); 
	foreach($teammemberList as $teammemList){ $teamMemberIdList[]= $teammemList['id']; }
	//echo $userId.'<pre>';print_r($teamMemberIdList); die; ?>
<section class="container">	
    	<div class="main">
       
        <ul class="bread_crumbs">
        	<li> <a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
               <span>&rsaquo;</span>
            <li> <a href="teams" class="a_links"><?php if($this->lang->line('user_teams') != '') { echo stripslashes($this->lang->line('user_teams')); } else echo "Teams"; ?></a></li>
               <span>&rsaquo;</span>
            <li> <a href="javascript:void(0);" class="a_links"><?php echo $TeamName[0]['teamName']; ?></a></li>
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
             		      <a href="team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>"><img src="<?php echo base_url().TEAM_PATH.'no-team-logo.png'; ?>" alt="<?php echo $TeamName[0]['teamName']; ?>" class="mar" style="margin:0 12px 15px !important" /></a>
             <?php } ?>    
                 <?php if(count($teamMemberIdList)> 0 && in_array($userId,$teamMemberIdList)){ ?>  
                 <a href="leave-team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>" class="asubscribe_btn"  style="margin:2px 2px 10px 45px; padding:5px 10px"><?php if($this->lang->line('com_leaveteam') != '') { echo stripslashes($this->lang->line('com_leaveteam')); } else echo "Leave this team"; ?></a>
                <?php }elseif($teamcaptainList[0]['id']==$userId){ ?> 
                 <a class="asubscribe_btn"  style="margin:2px 2px 10px 45px; padding:5px 10px"><?php if($this->lang->line('com_yourteam') != '') { echo stripslashes($this->lang->line('com_yourteam')); } else echo "Your Team"; ?></a>
				<?php }else{ ?><a href="join-team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>" class="asubscribe_btn"  style="margin:2px 2px 10px 45px; padding:5px 10px"><?php if($this->lang->line('com_jointhisteam') != '') { echo stripslashes($this->lang->line('com_jointhisteam')); } else echo "Join this team"; ?></a>
                <?php } ?>
                <!-- Side Menu for Community Satart---------------------->
                	<?php  $this->load->view('site/community/templates/community_menu');  ?>
                <!-- Side Menu for Community End---------------------->    
      <ul>
      <li style="padding:8px 0px 8px 8px; width:96%; color:#666666"><?php if($this->lang->line('com_founded') != '') { echo stripslashes($this->lang->line('com_founded')); } else echo "Founded"; ?> <?php echo date('M d Y', strtotime($TeamName[0]['teamAddDate'])); ?></li>
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
                     <!--<div class="side_link">
                     <ul>
                        	<li><a href="#"><?php if($this->lang->line('com_reportteam') != '') { echo stripslashes($this->lang->line('com_reportteam')); } else echo "Report this team to"; ?>  <?php echo $this->config->item('email_title'); ?></a></li>
                          	<li><a href="#"> <?php if($this->lang->line('com_contactcap') != '') { echo stripslashes($this->lang->line('com_contactcap')); } else echo "Contact the Captain"; ?></a></li>
                        </ul>
                    </div>-->
            </div>
            <div class="community_right" style="margin-left:15px; float:right; width:78%;">
            	<div class="about_item">
                        <div class="abt_split">
                        <h2><?php if($this->lang->line('com_aboutteam') != '') { echo stripslashes($this->lang->line('com_aboutteam')); } else echo "About this team"; ?> </h2>
                        <p><?php echo $TeamName[0]['teamShortdescription']; ?></p>
<!--<a href="#" class="link_textuse">Read More</a>-->
                        
                        
                        </div>
                        <div class="abt_split" style="border:none;">
                        <h2><?php if($this->lang->line('com_whocan') != '') { echo stripslashes($this->lang->line('com_whocan')); } else echo "Who can join?"; ?></h2>
                        <p><?php echo $TeamName[0]['teamRules']; ?></p>
                        </div>
                     </div>
                     
                     <div class="diss_content">
                     <?php  if($TeamName[0]['teamCaptainId']==$userId){ ?>
                     <div style="float:right"><a href="create-thread/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl'] ?>"> <?php if($this->lang->line('com_newthread') != '') { echo stripslashes($this->lang->line('com_newthread')); } else echo "Create a new thread"; ?></a> </div>
                     <?php } ?>
                     <?php #echo  '<pre>'; print_r($discussionList); die;
					  $discussionList=$this->data['discussionList']->result_array(); if(count($discussionList) >0){  ?>
                        <h2><a href="discussions/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl'] ?>" > <?php if($this->lang->line('com_discussions') != '') { echo stripslashes($this->lang->line('com_discussions')); } else echo "Discussions"; ?></a> </h2>
                        <ul class="discussion_use">
                        <li style="border:none;">
                        <span class="title_view"><?php if($this->lang->line('com_threads') != '') { echo stripslashes($this->lang->line('com_threads')); } else echo "Threads"; ?> </span>
                        <span class="post_view"><?php if($this->lang->line('com_post') != '') { echo stripslashes($this->lang->line('com_post')); } else echo "Post"; ?> </span>
                        <span class="last_view"> <?php if($this->lang->line('com_latestpost') != '') { echo stripslashes($this->lang->line('com_latestpost')); } else echo "Latest Post"; ?>  </span>
                        </li>
                        <?php //echo '<pre>'; print_r($discussionList); die; 
						$i=0; foreach($discussionList as $discussList) { $condition=array('rootId'=>$discussList['id']);$discusThread=$this->community_model->get_all_TeamDiscussionwithMemberinfo($condition); $DiscusThrd=$discusThread->result_array(); #echo '<pre>'; print_r($discussionList); die; ?>
                        <?php if($i<12){ ?>
                        <li>
                        <div class="avatar_view">
                       <?php if($discussList['userImg']!='') { ?>
                         <img src="<?php echo base_url().USERIMAGEPATH.stripslashes($discussList['userImg']);?>"  width="30px"/>
                        <?php }else{ ?>
                          <img src="<?php echo base_url().USERIMAGEPATH.'profile_pic.png';?>"  width="40px"/>
                        <?php } ?>
                        </div>
                        <div class="avater_split">
                        <span><a href="discuss/<?php echo $segMent2.'/'.$segMent3.'/'.$discussList['id']; ?>" class="sort_link_1" ><?php echo $discussList['post_title']; ?></a></span>
                         <div class="sub_cut">
                        <p> by <a class="sort_link_1" href="view-profile/<?php echo $discussList['user_name']; ?>"><?php echo $discussList['fullName']; ?></a>
                        <?php  if( $discussList['shopurl']!='') { ?> from <img src="images/flow.png"  /> <a class="sort_link_1" href="shop-section/<?php echo $discussList['id'].'-'.$discussList['seller_bussinesname']; ?>"><?php echo $discussList['seller_businessname']; ?> </a><?php } ?>
                        </p>
                        </div>
                        
                        </div>
                        <span class="post_view_count"><?php $DissCus=$discusThread->num_rows();echo $DissCus+1; ?> </span>
                         <div class="avatar_view">
                        
						<?php if($discusThread->num_rows() > 0){?>
						
						<?php if($DiscusThrd[0]['userImg']!='') { ?>
                         <img src="<?php echo base_url().USERIMAGEPATH.stripslashes($DiscusThrd[0]['userImg']);?>"  width="30px"/>
                        <?php }else {  ?>
                          <img src="<?php echo base_url().USERIMAGEPATH.'profile_pic.png';?>"  width="40px"/>
                        <?php } ?>
                        </div>
                         <div class="avater_split" style="width:177px;">
                        <span><?php echo date('M d, Y',strtotime($DiscusThrd[0]['postDate'])); ?></span>
                         <div class="sub_cut"  style="width:177px;">
                        <p><?php if($this->lang->line('com_by') != '') { echo stripslashes($this->lang->line('com_by')); } else echo "by"; ?> <a class="sort_link_1" href="view-profile/<?php echo $DiscusThrd[0]['user_name']; ?>" ><?php echo $DiscusThrd[0]['fullName'] ?>  </a>  </p>
						
						<?php } else {?>
						
						<?php if($discussList['userImg']!='') { ?>
                         <img src="<?php echo base_url().USERIMAGEPATH.stripslashes($discussList['userImg']);?>"  width="30px"/>
                        <?php }else {  ?>
                          <img src="<?php echo base_url().USERIMAGEPATH.'profile_pic.png';?>"  width="40px"/>
                        <?php } ?>
                        </div>
                         <div class="avater_split" style="width:177px;">
                        <span><?php echo date('M d, Y',strtotime($discussList['postDate'])); ?></span>
                         <div class="sub_cut"  style="width:177px;">
                        <p><?php if($this->lang->line('com_by') != '') { echo stripslashes($this->lang->line('com_by')); } else echo "by"; ?> <a class="sort_link_1" href="view-profile/<?php echo $discussList['user_name']; ?>" ><?php echo $discussList['fullName'] ?>  </a>  </p>
						
						
						<?php }?>
						
                        </div></div>
                       </li>
                         <?php }$i++;} ?>
                      
                        
                        </ul>
                      <?php } ?>
                        </div>
                        <div class=" member_view">
                       <h2><?php if($this->lang->line('com_members') != '') { echo stripslashes($this->lang->line('com_members')); } else echo "Members"; ?></h2><a href="team-members/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>/all" class="sort_link_1"><?php if($this->lang->line('com_viewall') != '') { echo stripslashes($this->lang->line('com_viewall')); } else echo "View All"; ?></a> <span> (<?php echo $memberList->num_rows()+$CaptainList->num_rows(); ?>)</span><a href="team-members/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>/captain" class="sort_link_1"><?php if($this->lang->line('com_viewcaptain') != '') { echo stripslashes($this->lang->line('com_viewcaptain')); } else echo "View Captain"; ?></a><span> (<?php echo $CaptainList->num_rows(); ?>)</span>
                     <div class="sort-by" style="float:right; margin-right:12px;">
                      <span style="font-size:12px;"><?php if($this->lang->line('com_sortby') != '') { echo stripslashes($this->lang->line('com_sortby')); } else echo "Sort by"; ?></span><a href="team-members/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>/last-update" <?php if($segMent4=='last-update'){ ?> class="sort_link_1" <?php } ?>style="font-size:12px;"><?php if($this->lang->line('shopsec_updated') != '') { echo stripslashes($this->lang->line('shopsec_updated')); } else echo "Last Updated"; ?></a> | <a href="team-members/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>/name" <?php if($segMent4=='name'){ ?> class="sort_link_1" <?php } ?> style="font-size:12px;"> <?php if($this->lang->line('user_name') != '') { echo stripslashes($this->lang->line('user_name')); } else echo "Name"; ?></a>
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
                       <a href="view-profile/<?php echo $teamcaptainList[0]['user_name']; ?>"  class="sort_link_1" style="font-size:12px;"><?php  echo $teamcaptainList[0]['full_name']?> (<?php if($this->lang->line('com_Captain') != '') { echo stripslashes($this->lang->line('com_Captain')); } else echo "Captain"; ?>)</a>
                       </h2>
                       <?php if( $teamcaptainList[0]['shopurl']!='') { ?>
                       <div style="float:left; "><img src="images/flow.png" style="margin-top:0px; float:left;" /><a class="sort_link_mem" href="shop-section/<?php echo $teamcaptainList[0]['seller_businessname']; ?>"  style="width:100%;"><?php echo $teamcaptainList[0]['seller_businessname']; ?> </a>
                       </div>
                       <?php } ?>
                       <span> <?php echo $teamcaptainList[0]['city']?> </span>
                       </li>
                       <?php } ?>
                        <?php if(count($teammemberList)>0){ ?>
                        <?php $i=0; foreach($teammemberList as $member){ if($i<12){  ?>
                       <li>
                        <div class="mem_avatar">
                          <?php if($member['thumbnail']!='') { ?>
                          <img src="<?php echo base_url().USERIMAGEPATH.stripslashes($member['thumbnail']);?>"  width="60px"/>
                        <?php }else{ ?>
                          <img src="<?php echo base_url().USERIMAGEPATH.'profile_pic.png';?>"  width="60px"/>
                        <?php } ?>
                        </div>
                       <h2 class="member-title">
                       <a href="view-profile/<?php echo $member['user_name']; ?>"  class="sort_link_1" style="font-size:12px;"><?php echo $member['full_name'] ?> </a>
                       </h2>
                        <?php if( $member['shopurl']!='') { ?>
                       <div style="float:left;  "><img src="images/flow.png" style="margin-top:0px; float:left;" /><a class="sort_link_mem" href="shop-section/<?php echo $member['seller_businessname']; ?>"  style="width:100%;"><?php echo $member['seller_businessname']; ?> </a>
                       </div>
                       <?php } ?>
                       <span> <?php echo $member['city'] ?> </span>
                       </li>
                       <?php }  $i++;} } ?>
                       </ul>
                       <?php if(count($teammemberList)>12) { ?>
                       <a class="bott_link" href="team-members/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>" ><?php if($this->lang->line('com_seeall') != '') { echo stripslashes($this->lang->line('com_seeall')); } else echo "See All"; ?> </a>
                       <?php } ?>
                       </div>
                    
                    
            <!--rightsplit-->
            </div>
            </div>
        </div>
        
    
 
	
</section>
<!--selection-->
<?php  $this->load->view('site/templates/footer');  ?>