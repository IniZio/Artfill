<?php  $this->load->view('site/templates/header');  
	$this->load->model('community_model');?>
<?php
 $TeamName=$this->data['teamsList']->result_array();
 $discussionOrg=$this->data['discussionOrg']->result_array();
 $discussionResponse=$this->data['discussionResponse']->result_array();
 //echo '<pre>'; print_r($TeamName); die;
 ?>
 <script src="js/jquery.validate.js"></script>
<script>$(document).ready(function(){$("#addnewdiscussion_form").validate(); });</script>
<!--selection-->
<style>
.post_orginal{
margin-left:50px;
margin-top:50px;}
.error{
color:#FF0000!important;
margin-top:10px!important;
}
</style>
<section class="container">
    	<div class="main">
       
        <ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
            <li><a href="teams" class="a_links"><?php if($this->lang->line('user_team') != '') { echo stripslashes($this->lang->line('user_team')); } else echo "Team"; ?></a></li>
            <span>&rsaquo;</span>
            <li><a href="team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl'];?>" class="a_links"><?php echo $TeamName[0]['teamName']; ?></a></li>
            <span>&rsaquo;</span>
            <li><a href="javascript:void(0);" class="a_links"><?php if($this->lang->line('com_newthread') != '') { echo stripslashes($this->lang->line('com_newthread')); } else echo "New Thread"; ?></a></li>
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
                          <a href="team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl'];?>"><img width="90%" src="<?php echo base_url().TEAM_PATH.$TeamName[0]['teamImage']; ?>" alt="<?php echo $TeamName[0]['teamName']; ?>" class="mar" /></a>
             <?php }else{ ?>   
             		      <a href="team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl'];?>"><img src="<?php echo base_url().TEAM_PATH.'no-team-logo.png'; ?>" alt="<?php echo $TeamName[0]['teamName']; ?>" class="mar" style="margin:0 12px 15px !important" /></a>
             <?php } ?>          
                           <a href="join-team/<?php echo $TeamName[0]['id'].'/'.$TeamName[0]['teamSeourl']; ?>" class="asubscribe_btn"  style="margin:2px 2px 10px 45px; padding:5px 10px;"><?php if($this->lang->line('com_jointhisteam') != '') { echo stripslashes($this->lang->line('com_jointhisteam')); } else echo "Join this team"; ?></a>   
                    
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
                        	<li><a href="mailto:<?php echo $this->config->item('email');?>"> <?php if($this->lang->line('com_reportteam') != '') { echo stripslashes($this->lang->line('com_reportteam')); } else echo "Report this team to"; ?> <?php echo $this->config->item('email_title'); ?></a></li>
                          	<li><a href="mailto:<?php echo $cptnmail;?>"> <?php if($this->lang->line('com_contactcap') != '') { echo stripslashes($this->lang->line('com_contactcap')); } else echo "Contact the Captain"; ?></a></li>
                        </ul>
                    
                    </div>
                   
            </div>
            <div class="community_right"  style="margin-left:15px; width:77%;">
            
               
                        <div class="post_orginal">
                        <form name="addnewdiscussion_form" method="post" enctype="multipart/form-data" id="addnewdiscussion_form" action="site/community/AddnewDiscussion">                     
               
                      <div class="heading_account" ><?php if($this->lang->line('com_newthread') != '') { echo stripslashes($this->lang->line('com_newthread')); } else echo "New Thread"; ?></div>
                      <div class="field_account">
                         <label ><?php if($this->lang->line('com_threadtitle') != '') { echo stripslashes($this->lang->line('com_threadtitle')); } else echo "Thread Title"; ?></label><span style="color:#F00; " class="with_field">*</span>
                         <input type="text" class="search required" style="margin:0" name="post_title" id="post_title" />
                         <input type="hidden" value="<?php echo $this->uri->segment('2');?>" name="teamId" id="teamId" />
                          <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />
                         <input type="hidden" value="Original" name="postType" id="postType" />
                         <input type="hidden" value="0" name="rootId" id="rootId" />
                      </div>
            
                     <div class="field_account">
                       <label ><?php if($this->lang->line('com_comments') != '') { echo stripslashes($this->lang->line('com_comments')); } else echo "Comments"; ?></label><span style="color:#F00; "class="with_field">*</span>
                       <div class="clear"></div>
                       <textarea class="search required" name="post" id="post" style="height:125px; margin-left:0px; width:450px" ></textarea>
                    </div>
            
              <div class="login_use" style="margin-left:10px;">
        	<div style="border: 1px solid #CCCCCC;color: #000000; float: left; font-size: 2em;font-style: oblique;font-weight: bold; height: 2em; line-height: 2em;text-align: center; text-decoration: line-through; width: 45%; margin-top:20px;">
                                <?php $random_values = substr(number_format(time() * rand(),0,'',''),0,4); $random_values1 = substr(number_format(time() * rand(),0,'',''),0,4); ?>
                                 <span style="color: #000000;float:left; text-align:right;text-decoration: line-through; width: 49%; transform: rotate(12deg);"><?php echo $random_values; ?></span><span style="color: #000000;float: left; text-align:left;text-decoration: line-through; width: 49%; transform: rotate(-12deg);"><?php echo $random_values1; ?></span></div>
            <input type="hidden"  id="captcha_original" value="<?php echo $random_values.$random_values1; ?>" />
        </div>
        				<div class="field_account">
       
        	<label><?php if($this->lang->line('com_captchaenter') != '') { echo stripslashes($this->lang->line('com_captchaenter')); } else echo "Enter the Captcha"; ?></label><span style="color:#F00; "class="with_field">*</span>
            <input type="text" class="search" id = "captcha" style="margin:0"   equalto="#captcha_original" /><span style="color:#F00;" class="redFont" id="user_captchaErr"></span>    
        </div>
               <div class="clear"></div>
             
          	<input type="submit" class="subscribe_btn" value="<?php if($this->lang->line('user_submit') != '') { echo stripslashes($this->lang->line('user_submit')); } else echo "Submit"; ?>" style=" margin-left:10px;" />
                
                </form>
                        
                        
                        
                        
                        
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