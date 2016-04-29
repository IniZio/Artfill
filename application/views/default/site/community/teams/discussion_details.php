<?php  $this->load->view('site/templates/header');  
	$this->load->model('community_model');  ?>
<?php
 $TeamName=$this->data['teamsList']->result_array(); #echo $userId.'<pre>';print_r($TeamName); die;
 $discussionOrg=$this->data['discussionOrg']->result_array();
 $discussionResponse=$this->data['discussionResponse']->result_array();
 $memberList=$this->data['memberList']->result_array();
 $captainList=$this->data['captainList']->result_array();
 foreach($memberList as $teammemList){ $teamMemberIdList[]= $teammemList['id']; }
 ?>
  <script src="js/jquery.validate.js"></script>
<script>$(document).ready(function(){$("#addnewdiscussion_form").validate(); });</script>
<style>
.error{
color:#FF0000!important;
margin-top:10px!important;
}
</style>
<!--selection-->
<section class="container">
	
    	<div class="main">
       
        <ul class="bread_crumbs">
        	<li> <a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
            <li> <a href="teams" class="a_links"><?php if($this->lang->line('user_team') != '') { echo stripslashes($this->lang->line('user_team')); } else echo "Team"; ?></a></li>
            <span>&rsaquo;</span>
            <li> <a href="team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>" class="a_links"><?php echo $TeamName[0]['teamName']; ?></a></li>
            <span>&rsaquo;</span>
            <li> <a href="javascript:void(0);" class="a_links"><?php if($this->lang->line('com_threads') != '') { echo stripslashes($this->lang->line('com_threads')); } else echo "Threads"; ?></a></li>
        </ul>
       
        <div class="clear"></div>
        <div class="community_page">
        <div class="community_head">
                	<h1><?php echo $TeamName[0]['teamName']; ?></h1>
         </div>
     <div class="community_div">
        	<div class="community_left">
            <div class="side_bar" style="width:97%;">
            <?php if($TeamName[0]['teamImage']!=''){ ?>
                          <a href="team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>"><img width="90%" src="<?php echo base_url().TEAM_PATH.$TeamName[0]['teamImage']; ?>" alt="<?php echo $TeamName[0]['teamName']; ?>" class="mar" /></a>
             <?php }else{ ?>   
             		      <a href="<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>"><img src="<?php echo base_url().TEAM_PATH.'no-team-logo.png'; ?>" alt="<?php echo $TeamName[0]['teamName']; ?>" class="mar" style="margin:0 12px 15px !important" /></a>
             <?php } ?>          
                           <?php if(is_array($teamMemberIdList) && in_array($userId,$teamMemberIdList)){ ?>  
                 <a href="leave-team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>" class="asubscribe_btn"  style="margin:2px 2px 10px 45px; padding:5px 10px"><?php if($this->lang->line('com_leaveteam') != '') { echo stripslashes($this->lang->line('com_leaveteam')); } else echo "Leave this team"; ?></a>
                <?php }elseif($captainList[0]['id']==$userId){ ?>
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
            <div class="community_right" style="margin-left:15px; width:78%;">
            <?php $i=0; foreach($memberList as $memList){ if($userId==$memList['userId'] && $i==0 && $memList['memberType']!='Captain'){ ?>
             <div class="search_bar" style="margin-top:0px;  padding: 5px 0px 8px 10px; width:100%;">
                        	
                            <div class="most_recent" style="width:100%;">
                            
                             <label> <?php if($this->lang->line('com_fromthisteam') != '') { echo stripslashes($this->lang->line('com_fromthisteam')); } else echo "If you want leave from this team"; ?> <a href="leave-team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>" class="sort_link"><?php if($this->lang->line('com_clickhere') != '') { echo stripslashes($this->lang->line('com_clickhere')); } else echo "click here"; ?></a>. </label>
							
                         </div>                            
                        </div> 
             <?php $i=1; }else { ?>  <?php } } ?> 
             <?php if($userId==''){ ?>
             <div class="search_bar" style="margin-top:0px;  padding: 5px 0px 8px 10px; width:100%;">
                        	
                            <div class="most_recent" style="width:100%;">
                            
                             <label> <?php if($this->lang->line('com_youmust') != '') { echo stripslashes($this->lang->line('com_youmust')); } else echo "You must"; ?>   <a href="join-team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>" class="sort_link"> <?php if($this->lang->line('com_jointhisteam') != '') { echo stripslashes($this->lang->line('com_jointhisteam')); } else echo "join this team"; ?> </a><?php if($this->lang->line('com_beforediscussion') != '') { echo stripslashes($this->lang->line('com_beforediscussion')); } else echo "before you can participate in this discussion"; ?>. </label>
                         </div>                            
                        </div> 
             <?php } ?>
                        <div class="post_orginal">
                        <h2><?php if($this->lang->line('com_originalpost') != '') { echo stripslashes($this->lang->line('com_originalpost')); } else echo "Original Post"; ?></h2>
                        <div class="form_post_view">
                        
                        <?php if($discussionOrg[0]['userImg']!='') { ?>
                        <a> <img src="<?php echo base_url().USERIMAGEPATH.stripslashes($discussionOrg[0]['userImg']);?>"  width="60px"/></a>
                        <?php }else{ ?>
                         <a> <img src="<?php echo base_url().USERIMAGEPATH.'profile_pic.png';?>"  width="60px"/></a>
                        <?php } ?>
                       
                       <?php /*?> <div class="content_arrow"></div><?php */?>
                        <div class="content_view">
                         <div class="comment-arrowing"></div>
                        <p><a href="view-profile/<?php echo $discussionOrg[0]['user_name'];  ?>" class="sort_link"><?php echo $discussionOrg[0]['fullName']; ?></a> <?php if($this->lang->line('com_says') != '') { echo stripslashes($this->lang->line('com_says')); } else echo "says"; ?></p>
						<h2><?php echo $discussionOrg[0]['post_title']; ?></h2>
                    	<p><?php echo $discussionOrg[0]['post']; ?></p>
                        </div>
                        <div class="clear"></div>
                        <?php if(count($discussionResponse)>0) { ?>
                        <h2><?php if($this->lang->line('com_responses') != '') { echo stripslashes($this->lang->line('com_responses')); } else echo "Responses"; ?></h2>
                           <?php foreach($discussionResponse as $responseList){ if($responseList['status']=='Active'){ ?>
                           <div class="community_responce">
                        <?php if($responseList['userImg']!='') { ?>
                        <a> <img src="<?php echo base_url().USERIMAGEPATH.stripslashes($responseList['userImg']);?>"  width="60px"/></a>
                        <?php }else{ ?>
                         <a> <img src="<?php echo base_url().USERIMAGEPATH.'profile_pic.png';?>"  width="60px"/></a>
                        <?php } ?>
                    
                      <?php /*?>  <div class="content_arrow"></div> <?php */?>
                        <div class="content_view">
                        <div class="comment-arrowing"></div>
                       <p> <a href="view-profile/<?php echo $responseList['user_name']; ?>" class="sort_link"> <?php echo $responseList['fullName']; ?> </a>  <?php if($this->lang->line('com_says') != '') { echo stripslashes($this->lang->line('com_says')); } else echo "says"; ?></p>

<h2><?php echo $responseList['post_title']; ?></h2>

<p><?php echo $responseList['post']; ?></p>


<p><?php if($this->lang->line('com_postedat') != '') { echo stripslashes($this->lang->line('com_postedat')); } else echo "Posted at"; ?> <a><?php echo date('h:i A M d, Y',strtotime($responseList['postDate'])); ?></a> - <?php if($this->lang->line('com_reportthispost') != '') { echo stripslashes($this->lang->line('com_reportthispost')); } else echo "Report this post "; ?></p>
                        
                        
                        
                        </div>
                        <?php } } ?>
                        <?php } ?>
                        </div>
                        </div>
                        
<?php 
	
	$vals = array(
    'word'	=> $this->input->cookie("captcha_org"),
    'img_path'	=> './captcha/',
    'img_url'	=> base_url().'/captcha/',
    'font_path'	=> './fonts/OpenSans-Regular-webfont.ttf',
    'img_width'	=> 260,
    'img_height' => 50,
    'expiration' => 7200
    ); 
	//$cap = create_captcha($vals); 
#echo $this->input->cookie("captcha_org").'**************';

?>                     


					  <?php $i=0; foreach($memberList as $memList){ if($userId==$memList['userId'] && $i==0 || $discussionOrg[0]['userId']==$userId && $i==0){ $i=1;  ?>
                        <div class="post_orginal">
                    <form name="addnewdiscussion_form" method="post" enctype="multipart/form-data" id="addnewdiscussion_form" action="site/community/teamdiscussionComment">                      <div class="heading_account" style="margin-top:25px;" ><?php if($this->lang->line('com_postcomment') != '') { echo stripslashes($this->lang->line('com_postcomment')); } else echo "Post Comment"; ?></div>
                              <div class="field_account">
                                 <!--<label >Thread Title</label><span style="color:#F00; " class="with_field">*</span>
                                 <input type="text" class="search required" style="margin:0" name="post_title" id="post_title" />-->
                                 <input type="hidden" value="<?php echo $this->uri->segment('2');?>" name="teamId" id="teamId" />
                                  <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />
                                 <input type="hidden" value="Responses" name="postType" id="postType" />
                                 <input type="hidden" value="<?php echo $this->uri->segment('4'); ?>" name="rootId" id="rootId" />
                              </div>
                    
                             <div class="field_account">
                               <label ><?php if($this->lang->line('com_comments') != '') { echo stripslashes($this->lang->line('com_comments')); } else echo "Comments"; ?></label><span style="color:#F00; "class="with_field">*</span>
                               <div class="clear"></div>
                               <textarea class="search required" name="post" id="post" style="height:100px; margin-left:0px; width:450px" ></textarea>
                            </div>
                    	 <div class="login_use" style="margin-left:10px;">
							 <div >
							<?php echo $cap['image']; ?> 
							</div>
						 
								<?php /* <div style="border: 1px solid #CCCCCC;color: #000000; float: left; font-size: 2em;font-style: oblique;font-weight: bold; height: 2em; line-height: 2em;text-align: center; text-decoration: line-through; width: 45%; margin-top:20px;">
                                <?php $random_values = substr(number_format(time() * rand(),0,'',''),0,4); $random_values1 = substr(number_format(time() * rand(),0,'',''),0,4); ?>
                                 <span style="color: #000000;float:left; text-align:right;text-decoration: line-through;  transform: rotate(12deg); margin-left:60px;"><?php echo $random_values; ?></span><span style="color: #000000;float: left; text-align:left;text-decoration: line-through; transform: rotate(-12deg);"><?php echo $random_values1; ?></span></div> */ ?>
						<input type="hidden"  id="captcha_original" value="<?php echo $randomString; ?>" />
        </div>
        				<div class="field_account">
       
        	<label><?php if($this->lang->line('com_captchaenter') != '') { echo stripslashes($this->lang->line('com_captchaenter')); } else echo "Enter the Captcha"; ?></label>
			<span style="color:#F00; "class="with_field">*</span>
            <input type="text" class="search" id = "captcha" style="margin-left:1px;"   equalto="#captcha_original" />
			<span style="color:#F00;" class="redFont" id="user_captchaErr"></span>      
        </div>
		
		
		
		
		
		
                     
                       <div class="clear"></div>
                     
                    <input type="submit" class="subscribe_btn" value="<?php if($this->lang->line('user_submit') != '') { echo stripslashes($this->lang->line('user_submit')); } else echo "Submit"; ?>" style=" margin-left:10px;" />
                
                </form>
                        
                        
                        
                        
                        
                        </div>
                        <?php  } } ?>
                        
                        </div>        
                   
                       <!--<div class="side_pane_right">
                        	<p>This discussion is public</p>
                            <input type="button" class="mark_btn" value="Mark">
                           
                        </div>-->
                    
                    
            <!--rightsplit-->
            </div>
        </div>
            </div>
        </div>
        
    
 
	
</section>
<!--selection-->
<?php  $this->load->view('site/templates/footer');  ?>