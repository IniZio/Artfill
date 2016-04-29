<?php  $this->load->view('site/templates/header.php'); ?>
<section class="container">
	
    	<div class="main">
        <div class="wrapper">
        <ul class="vertical_link">
        	<li> <a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <li> <a href="javascript:void(0);" class="a_links"><?php if($this->lang->line('com_viewpost') != '') { echo stripslashes($this->lang->line('com_viewpost')); } else echo "View Post"; ?></a></li>
        </ul>
     <div class="clear"></div>
     <div class="hole_content">
      <div class="heading"><?php if($this->lang->line('com_newpost') != '') { echo stripslashes($this->lang->line('com_newpost')); } else echo "New Post"; ?></div>
        	<?php  $this->load->view('site/community/community/community_control/blog_leftside.php'); ?>
            <div class="right_split">
           
            <div class="new_post_content">
            <span class="store_heading"><?php if($this->lang->line('user_title') != '') { echo stripslashes($this->lang->line('user_title')); } else echo "Title"; ?> :</span>
            	<?php echo stripslashes($postViewData[0]['post_title']);?>
             <span id="post_title_warn" class="redfont"></span>
            <span class="store_heading"><?php if($this->lang->line('com_postcontent') != '') { echo stripslashes($this->lang->line('com_postcontent')); } else echo "Post Content"; ?> </span>
            <div class="post_view">
           <?php echo stripslashes($postViewData[0]['post_content']);?> 
           <!-- <img src="images/post.png" />-->
           </div>
           <div class="field_view_use">
          <span ><?php if($this->lang->line('com_dateadded') != '') { echo stripslashes($this->lang->line('com_dateadded')); } else echo "Date Added"; ?> </span>
          <?php echo ucfirst(stripslashes($postViewData[0]['posted_date']));?> 
        </div>
             <div class="field_view_use">
          <span><?php if($this->lang->line('com_author') != '') { echo stripslashes($this->lang->line('com_author')); } else echo "Author"; ?></span>
           <?php echo ucfirst(stripslashes($postViewData[0]['user_name']));?> 
        </div>
          <div class="field_view_use">
          <span><?php if($this->lang->line('com_metatitle') != '') { echo stripslashes($this->lang->line('com_metatitle')); } else echo "Meta Title"; ?></span>
           <?php echo ucfirst(stripslashes($postViewData[0]['seo_title']));?> 
        </div>
        <div class="field_view_use">
          <span><?php if($this->lang->line('com_metakeyword') != '') { echo stripslashes($this->lang->line('com_metakeyword')); } else echo "Meta Keyword"; ?></span>
           <?php echo ucfirst(stripslashes($postViewData[0]['seo_keyword']));?> 
        </div>
        <div class="field_view_use">
          <span ><?php if($this->lang->line('com_metadescription') != '') { echo stripslashes($this->lang->line('com_metadescription')); } else echo "Meta Description"; ?> </span>
          <?php echo ucfirst(stripslashes($postViewData[0]['seo_description']));?> 
        </div>
         <input type="button" value="<?php if($this->lang->line('com_back') != '') { echo stripslashes($this->lang->line('com_back')); } else echo "Back"; ?>" class="draft_btn" name="post_back" id="post_back">
            	</div>
                              
              </div>
            </div>
            </div>
        </div>
     </div>
</section>
<!--selection-->
<?php $this->load->view('site/templates/footer.php'); ?>