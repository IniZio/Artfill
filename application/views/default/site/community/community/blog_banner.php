
        <ul class="bread_crumbs">
        	<li> <a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
            <li> <a href="community" class="a_links"><?php if($this->lang->line('user_community') != '') { echo stripslashes($this->lang->line('user_community')); } else echo "Community"; ?></a></li>
           <span>&rsaquo;</span>
            <?php if($this->uri->segment('2')!='') { ?>
             <li> <a href="community-newslist" class="a_links"><?php if($this->lang->line('com_communitynews') != '') { echo stripslashes($this->lang->line('com_communitynews')); } else echo "Community News"; ?></a></li>
             <span>&rsaquo;</span>
            <li> <a href="javascript:void(0);" class="a_links"><?php  echo stripslashes($getPostDetails[0]['post_title']); ?></a></li>
            
            <?php }else{ ?>
             <li> <a href="javascript:void(0);" class="a_links"><?php if($this->lang->line('com_communitynews') != '') { echo stripslashes($this->lang->line('com_communitynews')); } else echo "Community News"; ?></a></li>
             <?php } ?>
        </ul>
        
