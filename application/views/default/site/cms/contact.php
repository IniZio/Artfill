  <section class="container">
    	<div class="main">
		<ul class="bread_crumbs">

        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>

            <span>&rsaquo;</span>

           <li><?php echo $pageDetails->row()->page_title; ?></li>

              </ul>
		
		
		
            <div class="contact-page">
            	<div class="col50">

            <div class="shop_title_abt"><?php echo $pageDetails->row()->page_title; ?></div>

            <div class="inner-container-cms">  <?php 

            	if ($pageDetails->num_rows()>0){

            		echo $pageDetails->row()->description;

            	}

            	?>				
				
			<?php #if($this->uri->segment(2) == 'contact-us' && $this->session->userdata['shopsy_session_user_name'] != ''){?>
			<script src="js/jquery.validate.js"></script>    
			<script>$(document).ready(function(){$("#feedBackform").validate(); });</script>

		</div>

		</div>
		<div class="col50">
				<div class="shop_title_abt"><?php if($this->lang->line('feedback') != '') { echo stripslashes($this->lang->line('feedback')); } else echo "Send Your Feedback"; ?> </div>
				
				<form  method="post" action="site/market/submitfeedBackform" id="feedBackform">

                       <ul class="popup_login">	
                     <li>							
						<label><p><?php if($this->lang->line('com_username') != '') { echo stripslashes($this->lang->line('com_username')); } else echo "User Name"; ?></p><span style="color:#F00;" class="redFont" id="user_nameErr">*</span></label>          								 
						<input type="text" class="search required" style="margin:0" name="user_name" id="user_name"/>						
						</li>
						  <li>
						<label><p><?php if($this->lang->line('disp_usr_cont_email') != '') { echo stripslashes($this->lang->line('disp_usr_cont_email')); } else echo "Email"; ?></p><span style="color:#F00;" class="redFont" id="user_emailErr">*</span></label>          								 
						<input type="text" class="search email required" style="margin:0" name="user_email" id="user_email"/>						
						</li>
						  <li>
						<label><p><?php if($this->lang->line('user_subject') != '') { echo stripslashes($this->lang->line('user_subject')); } else echo "Subject"; ?></p><span style="color:#F00;" class="redFont" id="msg_subjectErr">*</span></label>          								 
						<input type="text" class="search required" style="margin:0" name="msg_subject" id="msg_subject"/>						
						</li>
						
						  <li><label><p><?php if($this->lang->line('com_comments') != '') { echo stripslashes($this->lang->line('com_comments')); } else echo "Comments"; ?></p><span style="color:#F00;" class="redFont" id="msg_contentErr">*</span></label>          								 
						<textarea type="text" class="search required" style="margin:0" name="msg_content" id="msg_content"></textarea>				
						</li>															
					</ul>
					
					<div class="popup_login">
						<input type="submit" value="<?php if($this->lang->line('user_submit') != '') { echo stripslashes($this->lang->line('user_submit')); } else echo "Submit"; ?>" class="btn-primary subscribe-link" />
					</div>		
				</form>
			<?php #}?>	
				

            </div></div>

        </div>

    </section>


