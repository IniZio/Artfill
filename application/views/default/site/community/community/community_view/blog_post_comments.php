<?php  $this->load->view('site/templates/header.php');
$this->load->model('community_model');
 ?>
 <?php  $this->load->view('site/community/templates/css_js_files.php'); ?>
<style>
.error{
color:#FF0000!important;
margin-top:10px!important;
}

.right_sideblog .blog_split {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    border-radius: 5px;
    float: left;
    margin: 0;
    padding: 13px;
    width: 97%;
}

.avatar_store {
    border: 1px solid #DCDCEC;
    border-radius: 5px;
    float: left;
    margin: 10px 0;
    padding: 0;
}
</style>

<section class="container">
	
    	<div class="main">
        <div style="padding:0" class="wrapper">
<?php  $this->load->view('site/community/community/blog_banner.php'); ?>
        
        
        <div style="margin-top:20px" class="left_split">
            <div class="avatar_store">
           		<h2><?php echo ucfirst(stripslashes($getPostDetails[0]['user_name']));?></h2> 
                <?php if($getPostDetails[0]['thumbnail']!=''){ ?>
                <a href="view-people/<?php echo $getPostDetails[0]['user_name'];?>"><img src="<?php echo base_url().USERIMAGEPATH.stripslashes($getPostDetails[0]['thumbnail']);?>" width="90px" height="90px"  alt="<?php echo ucfirst(stripslashes($storeBlog[0]['user_name']));?>" /></a>
                <?php }else{ ?>
                 <a href="view-people/<?php echo $getPostDetails[0]['user_name']; ?>"><img src="<?php echo base_url().USERIMAGEPATH.'profile_pic.png';?>" width="90px" height="90px" alt="<?php echo ucfirst(stripslashes($getPostDetails[0]['user_name']));?>" /></a>
                <?php } ?>
                <div class="clear"></div>
                <span><a href="#"></a> </span>
            </div>
            <div class="clear"></div>
     </div>
            <div class="right_sideblog" style="margin-right:0px;margin-top:30px; margin-left:16px;">
                <div class="blog_split">
            	<h2 class="title_blog"> <?php echo stripslashes($getPostDetails[0]['post_title']); ?></h2>
                
                <ul class=" date_cale" style="width:63%">
                <li><img src="images/calender.png" /> &nbsp;&nbsp;<?php echo date('M d Y',strtotime($getPostDetails[0]['posted_date'])); ?> &nbsp;&nbsp;&nbsp;| </li>
                 <li><img src="images/chat_ca.png" style="margin-left:0px;" />&nbsp; <!--<a href="#" >--><?php $a = $this->community_model->get_all_comments_front(stripslashes($getPostDetails[0]['post_id']));
				// print_r($a); die;
				 	echo count($a); ?> <?php if($this->lang->line('com_comments') != '') { echo stripslashes($this->lang->line('com_comments')); } else echo "comments"; ?><!--</a>--> </li>
                </ul>
                <?php if($getPostDetails[0]['post_image']!=''){ ?>
                 <div class="slider_left" style="margin:30px;"><img src="<?php echo base_url().COMMUNITY_NEWS_PATH.$getPostDetails[0]['post_image']; ?>" /></div>
                <?php  } ?>
               <div class="blog_cms">
               <!-- <img src="images/blogimg1.png" />-->
                 <p>
                <?php echo stripslashes($getPostDetails[0]['post_content']); ?>
                </p>
               </div>
            </div>
             <div class="blog_split">
             <h2 class="title_blog_tit"><?php if($this->lang->line('com_comments') != '') { echo stripslashes($this->lang->line('com_comments')); } else echo "comments"; ?></h2>
              <ul class="blog_list_main" style="width:94%; margin-left:10px;">
           <?php if(!empty($getPostComments)){ foreach($getPostComments as $details){ ?>
                                <li>
                                	<div class="team_img_cc" style="text-align:center;">
									<a href="view-people/<?php echo $details['user_name']; ?>">
                                    <?php if($details['thumbnail']!=''){ ?>
                                    <img src="<?php echo base_url().USERIMAGEPATH.stripslashes($details['thumbnail']);?>" alt="<?php echo ucfirst(stripslashes($details['user_name']));?>" />
                                    <?php }else{ ?>
                                   <img src="<?php echo base_url().USERIMAGEPATH.'profile_pic.png';?>" alt="<?php echo ucfirst(stripslashes($details['user_name']));?>" />  
                                    <?php } ?>  </a>
                                    <h3 style="margin-top:07px;"><?php echo $details['user_name']; ?></h3>
                                    </div>
                                    <div style="float:right"><img style="float:left" src="images/calender.png" />&nbsp;<span><?php echo date('M d Y H:i:s',strtotime($details['comment_date'])); ?></span></div>
                                    <div class="blog_cc">
                                    	<h2><?php echo stripslashes($details['comments_title']);?></h2>
                                        <p><?php echo stripslashes($details['comment_body']);?></p>
                                    </div>
                                </li>
                        <?php }} else{?>
                        <li><?php if($this->lang->line('com_nocommentsfound') != '') { echo stripslashes($this->lang->line('com_nocommentsfound')); } else echo "No Comments Found"; ?>!!</li>   
                        <?php } ?>     
                            </ul> 
             </div>
            
              <div class="clear"></div>
              
                      <div class="blog_pages_num">
                       <?php echo $paginationLink; ?>
                
                       
                      </div>
<?php if ($loginCheck != ''){?>
 <script src="javascript/jquery-1.9.0.js"></script>
<script src="js/jquery.validate.js"></script>
<script>
 $(document).ready(function(){	
 	 $("#commentForm").validate();
 });
 </script>
 
 				<form name="commentForm" method="post" enctype="multipart/form-data" id="commentForm" action="site/community/commentAddValues">                     
                 <div class="pass" style="width:97%; margin-left:12px;">
                  <div class="heading_account" ><?php if($this->lang->line('com_postcmnts') != '') { echo stripslashes($this->lang->line('com_postcmnts')); } else echo "Post Comments"; ?></div>
                  <div class="field_account">
        	         <!--<label >Comment Title</label><span style="color:#F00; " class="with_field">*</span>-->
                     <!--<input type="text" class="search required" style="margin:0" name="comments_title" id="comments_title" />-->
                     <input type="hidden" value="<?php echo $this->uri->segment('1');?>" name="comment_post_id" id="comment_post_id" />
                      <input type="hidden" value="<?php echo $userId; ?>" name="seller_business" id="seller_business" />
                     <input type="hidden" value="<?php echo stripslashes($getPostDetails[0]['posted_user_id']); ?>" name="comment_owner_id" id="comment_owner_id" />
                  </div>
        
                 <div class="field_account">
        	       <label ><?php if($this->lang->line('com_comments') != '') { echo stripslashes($this->lang->line('com_comments')); } else echo "Comments"; ?></label><span style="color:#F00; "class="with_field">*</span>
                   <div class="clear"></div>
                   <textarea class="search required" name="comment_body" id="comment_body" style="height:100px; margin-left:0px; width:350px" ></textarea>
                </div>
        
         
          
            <div class="login_use" style="margin-left:10px;">
        	<div style="border: 1px solid #CCCCCC;color: #000000; float: left; font-size: 2em;font-style: oblique;font-weight: bold; height: 2em; line-height: 2em;text-align: center; text-decoration: line-through; width: 45%;">
                                <?php $random_values = substr(number_format(time() * rand(),0,'',''),0,4); $random_values1 = substr(number_format(time() * rand(),0,'',''),0,4); ?>
                                 <span style="color: #000000;float:left; text-align:right;text-decoration: line-through; width: 49%; transform: rotate(12deg);"><?php echo $random_values; ?></span><span style="color: #000000;float: left; text-align:left;text-decoration: line-through; width: 49%; transform: rotate(-12deg);"><?php echo $random_values1; ?></span></div>
            <input type="hidden"  id="captcha_original" value="<?php echo $random_values.$random_values1; ?>" />
        </div>
        				<div class="field_account">
       
        	<label><?php if($this->lang->line('com_captchaenter') != '') { echo stripslashes($this->lang->line('com_captchaenter')); } else echo 'Enter the Captcha'; ?></label><span style="color:#F00; "class="with_field">*</span>
            <div class="clear"></div>
            <input type="text" class="search" id = "captcha" style="margin-left:0px; width:80%"   equalto="#captcha_original" /><span style="color:#F00;" class="redFont" id="user_captchaErr"></span>    
        </div>
         <div class="clear"></div>
         
          	<input type="submit" class="subscribe_btn" value="<?php if($this->lang->line('user_submit') != '') { echo stripslashes($this->lang->line('user_submit')); } else echo "Submit"; ?>" style=" margin:10px; " />
                 </div>   
                </form>
              <?php } ?>
            <!--rightsplit-->
            </div>
        </div>
        
    
 
	
</section>
<?php $this->load->view('site/templates/footer.php'); ?>