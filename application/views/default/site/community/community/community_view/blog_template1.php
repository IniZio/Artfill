<?php  $this->load->view('site/templates/header.php');
$this->load->model('community_model');
 ?>
 <?php  $this->load->view('site/community/templates/css_js_files.php'); ?>
 <style>
 .right_sideblog{
	 border:none;
 width:100%;
 }</style>
<section class="container">
    	<div class="main">
        <div style="padding:0" class="wrapper">
<?php  $this->load->view('site/community/community/blog_banner.php'); ?>
            <div class="right_sideblog">
            <?php 
			if(!empty($storeBlog)){
			foreach($storeBlog as $details){?>
                 <div class="blog_split">
            	<h2 class="title_blog"><a href="<?php echo stripslashes($details['post_id']); ?>/news-details"> <?php echo stripslashes($details['post_title']); ?></a></h2>
                <ul class=" date_cale">
                <li><img src="images/calender.png" /> <a href="#" ><?php echo date('M d Y',strtotime($details['posted_date'])); ?> &nbsp;|</a> </li>
                 <li><img src="images/chat_ca.png" style="margin-left:0px;" /> <a href="<?php echo stripslashes($details['post_id']); ?>/news-details" ><?php $a = $this->community_model->get_all_comments_front(stripslashes($details['post_id']));
				// print_r($a); die;
				 	echo count($a); ?> <?php if($this->lang->line('com_comments') != '') { echo stripslashes($this->lang->line('com_comments')); } else echo "comments"; ?></a> </li>
                </ul>
               <div class="blog_cms">
                 <p>
                <?php echo character_limiter(stripslashes($details['post_content']), 325); ?>
                </p>
               </div> 
                <a href="<?php echo stripslashes($details['post_id']); ?>/news-details" style="float:right;" class="asubscribe_btn margin_rig"><?php if($this->lang->line('com_more') != '') { echo stripslashes($this->lang->line('com_more')); } else echo "More"; ?></a>  
            </div>	
            <?php } } else{ ?>
              <div class="blog_split">
              <h2 style="text-align:center; color:#F00;"> <?php if($this->lang->line('com_nopostfound') != '') { echo stripslashes($this->lang->line('com_nopostfound')); } else echo "No Post Found"; ?></h2>
              </div>   
              <?php }?>  
            </div>
            <?php echo $paginationLink; ?>
        	
        </div>
</section>
<?php $this->load->view('site/templates/footer.php'); ?>