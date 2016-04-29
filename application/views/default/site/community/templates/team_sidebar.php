 <?php /*?><div class="side_panel">
                        	<h2>Sign up for the <?php echo $this->config->item('email_title'); ?> Success Newsletter</h2>
                            <input type="button" class="subscribe_btn" value="Subscribe">
                            <p style="margin:5px 0 0"><a href="#">See our other newsletters</a></p>
                        </div><?php */?>  
 <div class="side_link">
                     <ul>
                     		<?php /*?><li><a href="pages/your-threads">Your Threads</a></li><?php */?>
                            <li><a href="pages/what-are-teams"><?php if($this->lang->line('com_whatteams') != '') { echo stripslashes($this->lang->line('com_whatteams')); } else echo "What are Teams?"; ?></a></li>
                            <li><a href="pages/fellowship-program"><?php if($this->lang->line('com_program') != '') { echo stripslashes($this->lang->line('com_program')); } else echo "Fellowship Program"; ?></a></li>
                            <li><a href="pages/community-guidelines"><?php if($this->lang->line('com_guidelines') != '') { echo stripslashes($this->lang->line('com_guidelines')); } else echo "Community Guidelines"; ?></a></li>
                      </ul>
                    </div>