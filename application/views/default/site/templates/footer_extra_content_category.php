<?php /* <div id="footer-divider">
            
            <ul class="footer-menus">
            <li class="blocker"> <?php if($this->lang->line('user_follow') != '') { echo stripslashes($this->lang->line('user_follow')); } else echo 'Follow'; ?> <?php echo $this->config->item('email_title'); ?> </li>
            <li><a class="icons1" href="<?php echo $this->config->item('facebook_link'); ?>" target="_blank"><?php if($this->lang->line('comm_facebook') != '') { echo stripslashes($this->lang->line('comm_facebook')); } else echo 'facebook'; ?></a></li>
            <li><a class="icons3" href="<?php echo $this->config->item('twitter_link'); ?>" target="_blank"><?php if($this->lang->line('comm_twitter') != '') { echo stripslashes($this->lang->line('comm_twitter')); } else echo 'Twitter'; ?></a></li>
            <li><a class="icons4" href="<?php echo $this->config->item('pinterest'); ?>" target="_blank"><?php if($this->lang->line('comm_pininterest') != '') { echo stripslashes($this->lang->line('comm_pininterest')); } else echo 'Pintrest'; ?></a></li>
            </ul>
			<ul class="footer-menus">
                 <li class="blocker"><?php if($this->lang->line('comm_browse') != '') { echo stripslashes($this->lang->line('comm_browse')); } else echo 'Browse'; ?> <?php echo $this->config->item('email_title'); ?></li>
            </ul>
            <ul id="inner-page-ul" class="col col8 col-last">
            		
            <?php  foreach ($this->data['mainCategories']->result() as $row){
							if ($row->cat_name != ''){ $commentData = $this->category_model->get_all_counts($row->id,''); if($commentData[0]['disp']>0){
                      	?>
                        <li class="col col2 ">
                        <a href="category-list/<?php echo $row->id;?>-<?php echo $row->seourl;?>"><?php echo $row->cat_name;?></a>
                      </li>
                      <?php 
                      	}}
                      }
                      ?>
         </ul>
            
</div> */ ?>
        