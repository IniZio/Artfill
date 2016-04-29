<!-- css -->
<link href='//fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/default/site/base.css" />
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
					<ul id="panel" class="add_steps" style="background:none; box-shadow:none;">

    <li <?php if($this->uri->segment(1) == 'public-profile'){ echo 'class="side_active"'; } ?>>

    	<a href="public-profile"><?php if($this->lang->line('user_pub_profile') != '') { echo stripslashes($this->lang->line('user_pub_profile')); } else echo "Public Profile"; ?></a>

        </li>

    <li <?php if($this->uri->segment(2) == 'my-account' && $this->uri->segment(2) != 'giftcards'){ echo 'class="side_active"'; } ?>>

    	<a href="<?php echo 'settings/my-account/'.$this->session->userdata['shopsy_session_user_name'];?>">

			<?php if($this->lang->line('user_settings') != '') { echo stripslashes($this->lang->line('user_settings')); } else echo "Settings"; ?>

        </a>

     </li>

    <li <?php if($this->uri->segment(2) == 'giftcards'){ echo 'class="side_active"'; } ?>>

    	<a href="settings/giftcards">

        	<?php if($this->lang->line('giftcard_cards') != '') { echo stripslashes($this->lang->line('giftcard_cards')); } else echo "Gift Cards"; ?>

        </a>

    </li>

   <?php /*  <!--<li <?php if($this->uri->segment(1) == 'apps'){ echo 'class="side_active"'; } ?>><a href="javascript: void(0);"> Apps</a></li>--> 

    <!--<li <?php if($this->uri->segment(1) == 'prototypes'){ echo 'class="side_active"'; } ?>><a href="prototypes"> Prototypes</a></li>--> */?>

    <li <?php if($this->uri->segment(1)=='manage-community'){ echo 'class="active"';} ?>>

    	<a href="manage-community" ><i class="ic-credit"></i>

        	<?php if($this->lang->line('user_community') != '') { echo stripslashes($this->lang->line('user_community')); } else echo "Community"; ?>

        </a>

    </li>
	<li <?php if($this->uri->segment(1)=='manage-notification'){ echo 'class="active"';} ?>>

    	<a href="manage-notification" ><i class="ic-credit"></i>
        	<?php if($this->lang->line('lg_user_notification') != '') { echo stripslashes($this->lang->line('lg_user_notification')); } else echo "Notification Settings"; ?>


        </a>

    </li>
	<?php
		if($this->session->userdata['shopsy_session_user_name'] !=""){
	?>
		<li <?php if($this->uri->segment(3)=='conversations'){ echo 'class="side_active"';} ?>>

    	<a href="people/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>/conversations" ><i class="ic-credit"></i>
        	<?php if($this->lang->line('lg_user_conversation') != '') { echo stripslashes($this->lang->line('lg_user_conversation')); } else echo "Conversations"; ?>


        </a>

    </li>
	<li <?php if($this->uri->segment(2) == 'invite-friends' ){ echo 'class="side_active"';} ?>>

    	<a href="settings/invite-friends" ><i class="ic-credit"></i>
        	<?php if($this->lang->line('lg_user_invite') != '') { echo stripslashes($this->lang->line('lg_user_invite')); } else echo "Invite Friends"; ?>


        </a>

    </li>
		
	<?php	}
	?>

    <?php if($this->session->userdata['FBlogout']==''){ ?>

                        <li><a href="logout"><?php if($this->lang->line('sign_out') != '') { echo stripslashes($this->lang->line('sign_out')); } else echo 'Sign Out'; ?></a></li>

                        <?php }else{ ?>

                        <li><a href="<?php echo $this->session->userdata['FBlogout']; ?>"><?php if($this->lang->line('sign_out') != '') { echo stripslashes($this->lang->line('sign_out')); } else echo 'Sign Out'; ?></a></li>

                        <?php } ?>

    

    <!-- <li class="side_active"><a href="#">Teams</a></li>-->

  </ul>

</nav>
				
				<nav id="nav-mobile"></nav>

