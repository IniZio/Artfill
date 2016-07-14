			<?php $urlArr =  $this->uri->segment_array(); ?>

			<?php $userProfileDetails=$userProfileDetails->result_array(); ?>

<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="css/default/site/style-menu.css" />
    
<!-- js -->
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<script>
    $(document).ready(function(){
        $("#nav-mobile").html($("#nav-main").html());
        $("#nav-trigger span").click(function(){
            if ($("nav#nav-mobile ul").hasClass("expanded")) {
                $("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
                $(this).removeClass("open");
            } else {
                $("nav#nav-mobile ul").addClass("expanded").slideDown(250);
                $(this).addClass("open");
            }
        });
    });
</script>
	<div id="nav-trigger">
        <span>Menu</span>
    </div>
	<nav id="nav-main">
				<?php if($userProfileDetails[0]['id'] == $loginCheck){?>
                    <ul id="panel" class="add_steps" style="background:none; box-shadow:none;">

                       

                        <li <?php if ($urlArr[sizeof($urlArr)]==urldecode($this->uri->segment(2,0))){ echo 'class="side_active"';  }?>>

                        	<a href="view-people/<?php echo stripslashes($userProfileDetails[0]['user_name']);?>" ><?php if($this->lang->line('user_profile') != '') { echo stripslashes($this->lang->line('user_profile')); } else echo 'Profile'; ?></a>

                        </li>

                        <li <?php if (in_array('favorites', $urlArr) || in_array('shop', $urlArr)|| in_array('treasury', $urlArr)){ echo 'class="side_active"';  }?>>

                        	<a href="people/<?php echo stripslashes($userProfileDetails[0]['user_name']);?>/favorites"><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?></a>

                        </li>
						<li <?php if (in_array('invite-friends', $urlArr)){ echo 'class="side_active"';  }?>>
                        	<a href="settings/invite-friends"><?php if($this->lang->line('lg_invite_ friend') != '') { echo stripslashes($this->lang->line('lg_invite_ friend')); } else echo 'Invite Friend'; ?></a>

                        </li>

                        <li <?php if (in_array('followers', $urlArr) || in_array('following', $urlArr)){ echo 'class="side_active"';  }?>>

                        	<a href="people/<?php echo stripslashes($userProfileDetails[0]['user_name']);?>/followers"><?php if($this->lang->line('user_followers') != '') { echo stripslashes($this->lang->line('user_followers')); } else echo 'Followers'; ?> <?php if($userProfileDetails[0]['followers_count']>0){ echo ': '.$userProfileDetails[0]['followers_count']; } ?></a>

                        </li>                        

                         <li>

                        <?php 

						if($loginCheck!=''){ 

							if($this->session->userdata['shopsy_session_user_confirm'] == 'No') { 

								 $classN='contact-popup2';

						   	}else{

								$classN='contact-popup';

							}

						}

						?> 

                        <?php 
						
										if($this->session->userdata['shopsy_session_user_name'] == $userProfileDetails[0]['user_name']) {?>

							<?php if($this->session->userdata['shopsy_session_user_confirm'] == 'No') { ?>

                            <li <?php if (in_array('conversations', $urlArr) || in_array('conversations', $urlArr)){ echo 'class="side_active"';  }?>>

                                <a class="contact-popup2" href="javascript:void(0);"><?php echo af_lg('lg_conversations','Conversation');?></a>

                            </li>

                            <?php }else{ ?>

                            <li <?php if (in_array('conversations', $urlArr) || in_array('conversations', $urlArr)){ echo 'class="side_active"';  }?>>

                                <a href="people/<?php echo stripslashes($userProfileDetails[0]['user_name']);?>/conversations"><?php echo af_lg('lg_conversations','Conversation');?></a></a>

                            </li>

                            <?php } ?>

                        <?php }else{ ?>

                        	<a  class="<?php echo $classN; ?>" href="<?php if($loginCheck!=''){echo '#';}else{ echo 'login'; }?>"><?php if($this->lang->line('user_contact') != '') { echo stripslashes($this->lang->line('user_contact')); } else echo 'Contact'; ?></a>

                         <?php } ?>

                        </li>
						<?php }?>

                    </ul>

  </nav>
        <nav id="nav-mobile"></nav>

                

                

                

                

                

                

	<div style='display:none'>

        <div id='contact_reg' style='background:#fff;'>  

            <div style="width:96.7%" class="conversation">

                <div style="padding:20px; width:94.5%;" class="conversation_container">

                    <h2 class="conversation_headline"><?php if($this->lang->line('new_conversation') != '') { echo stripslashes($this->lang->line('new_conversation')); } else echo 'New conversation with'; ?><?php echo ucfirst($userProfileDetails[0]['full_name']); ?></h2>

                    <div class="conversation_thumb">

                        <img width="75" height="75" src="images/<?php echo $profile_pic; ?>">

                    </div>

                    <div class="conversation_right">

                        <form name="contactpeople" id="contactpeople" method="post" action="site/user/contactpeople" onsubmit="return contactsCheck();">

                            <input class="conversation-subject" type="text" name="subject" id="subject" placeholder="Subject" >

                            <textarea class="conversation-textarea" rows="11" name="message_text" id="message_text" placeholder="<?php if($this->lang->line('user_msgtxt') != '') { echo stripslashes($this->lang->line('user_msgtxt')); } else echo 'Message text'; ?>"></textarea>

                            <input type="hidden" name="sender_email" id="sender_email" value="<?php echo $this->session->userdata['shopsy_session_user_email']; ?>" >

                            <input type="hidden" name="sender_id" id="sender_id" value="<?php echo $this->session->userdata['shopsy_session_user_id']; ?>" >

                            <input type="hidden" name="receiver_email" id="receiver_email" value="<?php echo $userProfileDetails[0]['email']; ?>" >

                            <input type="hidden" name="receiver_id" id="receiver_id" value="<?php echo $userProfileDetails[0]['id']; ?>" >

                            <input type="hidden" name="current_user" value="<?php echo $userProfileDetails[0]['user_name']; ?>" >

                            <input class="subscribe_btn" type="submit" value="send" style="height: auto; padding: 7px 10px; margin: 10px 0 7px 20px; font-weight: bold;">

                            <span class="error" id="ErrPUP"></span>

                        </form>		

                    </div> 

                </div>

            </div>

        </div>

	</div>         

                  

    <div style='display:none'>

        <div id='contact_reg2' style=' background: none repeat scroll 0 0 rgba(0, 0, 0, 0.3); border-radius:8px; padding:15px'>

            <div style="background:#fff;border-radius:8px;"> 

                <div class="contact_reg-header">

                    <h2><?php if($this->lang->line('confirm_acct') != '') { echo stripslashes($this->lang->line('confirm_acct')); } else echo 'Hold on! You still need to confirm your account.'; ?></h2>

                    <div class="contact_reg-body">

                        <p><?php if($this->lang->line('confirmation_email') != '') { echo stripslashes($this->lang->line('confirmation_email')); } else echo "We'll resend your confirmation email to"; ?> <?php echo $this->session->userdata['shopsy_session_user_email'];?>.</p>

                    </div>

                </div>

                <div class="contact_reg-footer">

                    <span><input class="resending" type="button" value="<?php if($this->lang->line('user_cancel') != '') { echo stripslashes($this->lang->line('user_cancel')); } else echo "Cancel"; ?>" onclick="javascript:$('#cboxClose').trigger('click');"></span> 

                    <span><input class="resending" type="submit" value="<?php if($this->lang->line('prod_resend') != '') { echo stripslashes($this->lang->line('prod_resend')); } else echo "Resend Email"; ?>" onClick="return resendConfirmationPopUp('<?php echo $this->session->userdata['shopsy_session_user_email'];?>');"></span>

                </div>

            </div>         

        </div>

    </div>       

                

                

                

                

                

                

                

                





<script>

$(document).ready(function(){



		$(".cboxClose1").click(function(){

			$("#cboxOverlay,#colorbox").hide();

			});

		

			//$(".contact-popup").colorbox({width:"765", height:"auto", inline:true, href:"#contact_reg"});

	    	//$(".contact-popup2").colorbox({width:"448px", height:"auto", inline:true, href:"#contact_reg2"});

		

			//Example of preserving a JavaScript event for inline calls.

			$("#onLoad").click(function(){ 

				$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");

				return false;

			});



});

</script>





<style>



#cboxLoadedContent{background:none;}





#cboxClose {  right: 15px;

    text-indent: -9999px;

    top: 11px;}

</style>