<?php  $this->load->view('site/templates/header');  
	$this->load->model('community_model');?>
<?php $TeamName=$this->data['teamsList']->result_array(); //echo '<pre>';print_r($memberList); die; ?>
<!--selection-->
<?php 
if($segMent4!='captain'){
	$teammemberList=$memberList->result_array();
	 }
	$teamcaptainList=$CaptainList->result_array();
	foreach($teammemberList as $teammemList){ $teamMemberIdList[]= $teammemList['id']; }//echo '<pre>';print_r($teammemberList); die; ?>
<section class="container">
    	<div class="main">
       
        <ul class="bread_crumbs">
        	<li> <a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
            <li> <a href="teams" class="a_links"><?php if($this->lang->line('user_team') != '') { echo stripslashes($this->lang->line('user_team')); } else echo "Team"; ?></a></li>
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
                              <a href="#"><img width="90%" src="<?php echo base_url().TEAM_PATH.$TeamName[0]['teamImage']; ?>" alt="<?php echo $TeamName[0]['teamName']; ?>" class="mar" /></a>
                 <?php }else{ ?>   
                              <a href="#"><img src="<?php echo base_url().TEAM_PATH.'no-team-logo.png'; ?>" alt="<?php echo $TeamName[0]['teamName']; ?>" class="mar" style="margin:0 25px 15px !important" /></a>
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
                          	<a class="tage_use" href="teams-search/<?php echo $val; ?>"><?php echo $val; ?></a>
                          <?php } ?>
                          </div>                      
                <!-- Side Menu for Community Satart---------------------->
                <?php  $this->load->view('site/community/templates/team_sidebar');  ?>
                <!-- Side Menu for Community End---------------------->   
                         <div class="side_link">
                         	<ul>
                        	<li><a href="#"><?php if($this->lang->line('com_reportteam') != '') { echo stripslashes($this->lang->line('com_reportteam')); } else echo "Report this team to"; ?>  <?php echo $this->config->item('email_title'); ?></a></li>
                          	<li><a href="#"> <?php if($this->lang->line('com_contactcap') != '') { echo stripslashes($this->lang->line('com_contactcap')); } else echo "Contact the Captain"; ?></a></li>
                        </ul>
                        </div>
                </div>
                <div class="community_right">
                       <div class="diss_content">
                     <?php  if($TeamName[0]['teamCaptainId']==$userId){ ?>
                     <div style="float:right"><a href="create-thread/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl'] ?>"> <?php if($this->lang->line('com_newthread') != '') { echo stripslashes($this->lang->line('com_newthread')); } else echo "Create a new thread"; ?></a> </div>
                     <?php } ?>
                     <?php //echo  '<pre>'; print_r($discussionList); die;
					  $discussionList=$this->data['discussionList']->result_array(); if(count($discussionList) >0){  ?>
                        <h2 style="margin-bottom:10px;"> <?php if($this->lang->line('com_discussions') != '') { echo stripslashes($this->lang->line('com_discussions')); } else echo "Discussions"; ?> </h2>
                        
                        <ul class="discussion_use">
                        <li style="border:none;">
                        <span class="title_view"><?php if($this->lang->line('com_threads') != '') { echo stripslashes($this->lang->line('com_threads')); } else echo "Threads"; ?> </span>
                        <span class="post_view"><?php if($this->lang->line('com_post') != '') { echo stripslashes($this->lang->line('com_post')); } else echo "Post"; ?> </span>
                        <span class="last_view"> <?php if($this->lang->line('com_latestpost') != '') { echo stripslashes($this->lang->line('com_latestpost')); } else echo "Latest Post"; ?>  </span>
                        </li>
                        <?php //echo '<pre>'; print_r($discussionList); die; 
						foreach($discussionList as $discussList) { $condition=array('rootId'=>$discussList['id']);$discusThread=$this->community_model->get_all_TeamDiscussionwithMemberinfo($condition); $DiscusThrd=$discusThread->result_array(); //echo '<pre>'; print_r($DiscusThrd); die; ?>
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
                        <?php  if( $discussList['shopurl']!='') { ?> from <img src="images/flow.png"  /> <a class="sort_link_1" href="shop-section/<?php echo $discussList['seller_bussinesname']; ?>"><?php echo $discussList['seller_businessname']; ?> </a><?php } ?>
                        </p>
                        </div>
                        
                        </div>
                        <span class="post_view_count"><?php $DissCus=$discusThread->num_rows();echo $DissCus+1; ?> </span>
                         <div class="avatar_view">
                        <?php if($DiscusThrd[0]['userImg']!='') { ?>
                         <img src="<?php echo base_url().USERIMAGEPATH.stripslashes($DiscusThrd[0]['userImg']);?>"  width="30px"/>
                        <?php }else{ ?>
                          <img src="<?php echo base_url().USERIMAGEPATH.'profile_pic.png';?>"  width="40px"/>
                        <?php } ?>
                        </div>
                         <div class="avater_split" style="width:177px;">
                        <span><?php echo date('M d, Y',strtotime($DiscusThrd[0]['postDate'])); ?></span>
                         <div class="sub_cut"  style="width:177px;">
                        <p> <?php if($this->lang->line('com_by') != '') { echo stripslashes($this->lang->line('com_by')); } else echo "by"; ?> <a class="sort_link_1" href="view-profile/<?php echo $DiscusThrd[0]['user_name'];  ?>"><?php echo $DiscusThrd[0]['fullName']; ?>  </a>  </p>
                        </div></div>
                       </li>
                        
                         <?php } ?>
                      
                        
                        </ul>
                      <?php } ?>
                        </div>
      			</div>
           </div>
        </div>
        
    
 
	
</section>
<!--selection-->
<?php  $this->load->view('site/templates/footer');  ?>