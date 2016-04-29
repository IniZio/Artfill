<?php 
      $this->load->model('community_model'); 
	 // $blogTotal = $this->community_model->get_all_posts();
?>
<div class="left_split">
          <div class="avatar_store">
        		<div class="about_view">
                <h2 class="title_blog"><?php if($this->lang->line('com_recentblogpost') != '') { echo stripslashes($this->lang->line('com_recentblogpost')); } else echo "Recent blog post"; ?></h2>
                 <div class="border_style_1"></div>
                <div class="clear"></div>
                <?php 
						
				if(count($blogTotal) > 5){
					 $a = '5';
				}else{
					$a = count($blogTotal);
					}
					?>
				<?php 
				$j = 0;
				for($i=1;$i<=$a;$i++){
				?>             
                <div class="blog_split_inside">
                 <img src="<?php echo base_url();?>images/users/<?php echo stripslashes($blogTotal[$j]['thumbnail']);?>" alt="<?php echo ucfirst(stripslashes($blogTotal[$j]['user_name']));?>" />
                <h2><a href="javascript:void();"><?php echo stripslashes($blogTotal[$j]['post_title']);?> </a></h2>
                <p><?php echo date('F-Y',strtotime($blogTotal[$j]['posted_date'])); ?></p>
                </div>
                <?php $j++;} ?>

            </div>
        </div>
          <div class="avatar_store">
        		<div class="about_view">
                <h2 class="title_blog"><?php if($this->lang->line('com_archive') != '') { echo stripslashes($this->lang->line('com_archive')); } else echo "Archive"; ?></h2>
                 <div class="border_style_1"></div>
                <div class="clear"></div>
                <ul class="archive">
                <li>
                <a <?php if($this->uri->segment('2') == strtolower(url_title(date('F Y', strtotime('-1 month'))))){?> class="active" <?php }?> href="store-blog-archive/<?php echo  strtolower(url_title(date('F Y', strtotime('-1 month')))); ?>"><?php echo  date('F Y', strtotime('-1 month')); ?></a>
                </li>
                 <li>
                <a  <?php if($this->uri->segment('2') == strtolower(url_title(date('F Y', strtotime('-2 month'))))){?> class="active" <?php }?> href="store-blog-archive/<?php echo strtolower(url_title(date('F Y', strtotime('-2 month')))); ?>"><?php echo date('F Y', strtotime('-2 month')); ?></a>
                </li>
                 <li>
                <a  <?php if($this->uri->segment('2') == strtolower(url_title(date('F Y', strtotime('-3 month'))))){?> class="active" <?php }?> href="store-blog-archive/<?php echo strtolower(url_title(date('F Y', strtotime('-3 month')))); ?>"><?php echo date('F Y', strtotime('-3 month')); ?></a>
                </li>
                 <li>
                <a  <?php if($this->uri->segment('2') == strtolower(url_title(date('F Y', strtotime('-4 month'))))){?> class="active" <?php }?> href="store-blog-archive/<?php echo strtolower(url_title(date('F Y', strtotime('-4 month')))); ?>"><?php echo date('F Y', strtotime('-4 month')); ?></a>
                </li>
                 <li>
                <a  <?php if($this->uri->segment('2') == strtolower(url_title(date('F Y', strtotime('-5 month'))))){?> class="active" <?php }?> href="store-blog-archive/<?php echo strtolower(url_title(date('F Y', strtotime('-5 month')))); ?>"><?php echo date('F Y', strtotime('-5 month')); ?></a>
                </li>
                <li>
                <a  <?php if($this->uri->segment('2') == strtolower(url_title(date('F Y', strtotime('-6 month'))))){?> class="active" <?php }?> href="store-blog-archive/<?php echo strtolower(url_title(date('F Y', strtotime('-6 month')))); ?>"><?php echo date('F Y', strtotime('-6 month')); ?></a>
                </li>
                </ul>
            </div>
        </div>
     </div>