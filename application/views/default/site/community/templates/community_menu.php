<?php 
$first_segment = $this->uri->segment(1);
$second_segment = $this->uri->segment(2);
$third_segment = $this->uri->segment(3); ?>

           <ul>
              
                <li <?php if($first_segment=='community'){ ?> class="side_active"<?php } ?>><a href="community"><?php if($this->lang->line('user_community') != '') { echo stripslashes($this->lang->line('user_community')); } else echo "Community"; ?></a></li>
                <li <?php if($first_segment=='events'){ ?> class="side_active"<?php } ?>><a href="events"><?php if($this->lang->line('comm_events') != '') { echo stripslashes($this->lang->line('comm_events')); } else echo "Events"; ?></a></li>
               	<li <?php if($first_segment=='teams' || $first_segment=='team'){ ?> class="side_active"<?php } ?>><a href="teams"> <?php if($this->lang->line('user_teams') != '') { echo stripslashes($this->lang->line('user_teams')); } else echo "Teams"; ?></a></li>
          </ul>

