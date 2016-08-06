<!-- css -->
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

<!--<link rel="stylesheet" href="css/default/site/style-menu.css" />-->
    
<!-- js -->
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<script>
    /*$(document).ready(function(){
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
    });*/
</script>
<!--
<div id="nav-trigger">
					<span>Menu</span>
				</div>-->
				<nav id="nav-main">
					<ul id="panel" class="add_steps" style="background:none; box-shadow:none;">

    <li <?php if($this->uri->segment(1)=='view-people'){ echo 'class="side_active"';  }?>>

       	<a href="view-people/<?php echo $this->session->userdata['shopsy_session_user_name'];?>" ><i class="ic-credit"></i><?php if($this->lang->line('user_profile') != '') { echo stripslashes($this->lang->line('user_profile')); } else echo 'Profile'; ?></a>

    </li>
	<?php if($this->uri->segment(1)!='view-people' || $this->uri->segment(2) == $this->session->userdata['shopsy_session_user_name'] ){ ?>
    <li <?php if($this->uri->segment(1)=='purchase-review'){ echo 'class="side_active"';  }?>>

       	<a href="purchase-review" ><i class="ic-credit"></i>交易紀錄</a>

    </li>
					
    <li <?php if($this->uri->segment(1) == 'public-profile'){ echo 'class="side_active"'; } ?>>

    	<a href="public-profile"><?php if($this->lang->line('user_pub_profile') != '') { echo "編輯個人檔案"; } else echo "Public Profile"; ?></a>

        </li>

    <li <?php if($this->uri->segment(2) == 'my-account' && $this->uri->segment(2) != 'giftcards'){ echo 'class="side_active"'; } ?>>

    	<a href="<?php echo 'settings/my-account/'.$this->session->userdata['shopsy_session_user_name'];?>">

			<?php if($this->lang->line('user_settings') != '') { echo "帳戶設置"; } else echo "Settings"; ?>

        </a>

     </li>
<!--
    <li <?php if($this->uri->segment(2) == 'giftcards'){ echo 'class="side_active"'; } ?>>

    	<a href="settings/giftcards">

        	<?php if($this->lang->line('giftcard_cards') != '') { echo stripslashes($this->lang->line('giftcard_cards')); } else echo "Gift Cards"; ?>

        </a>

    </li>
-->
   <?php /*  <!--<li <?php if($this->uri->segment(1) == 'apps'){ echo 'class="side_active"'; } ?>><a href="javascript: void(0);"> Apps</a></li>--> 

    <!--<li <?php if($this->uri->segment(1) == 'prototypes'){ echo 'class="side_active"'; } ?>><a href="prototypes"> Prototypes</a></li>--> */?>

    <!-- <li <?php if($this->uri->segment(1)=='manage-community'){ echo 'class="active"';} ?>>

    	<a href="manage-community" ><i class="ic-credit"></i>

        	<?php if($this->lang->line('user_community') != '') { echo stripslashes($this->lang->line('user_community')); } else echo "Community"; ?>

        </a>

    </li> -->
	<li <?php if($this->uri->segment(1)=='manage-notification'){ echo 'class="side_active"';} ?>>

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
	
	
    <li <?php if($this->uri->segment(3)=='followers'){ echo 'class="side_active"';  }?>>

        <a href="people/<?php echo $this->session->userdata['shopsy_session_user_name'];?>/followers"><i class="ic-credit"></i><?php if($this->lang->line('user_followers') != '') { echo stripslashes($this->lang->line('user_followers')); } else echo 'Followers'; ?></a>

    </li>      
	

    <li <?php if($this->uri->segment(3)=='favorites'){ echo 'class="side_active"';  }?>>

       	<a href="people/<?php echo $this->session->userdata['shopsy_session_user_name'];?>/favorites"><i class="ic-credit"></i><?php if($this->lang->line('user_favorite') != '') { echo stripslashes($this->lang->line('user_favorite')); } else echo 'Favorite'; ?></a>

    </li>
	
	<!--
	<li <?php if($this->uri->segment(1)=='reviews'){ echo 'class="side_active"';} ?>>

    	<a href="reviews" ><i class="ic-credit"></i>
        	<?php echo "意見回饋"; ?>


        </a>

    </li>
	-->
	<!--
	 <li <?php if($this->uri->segment(2) == 'invite-friends' ){ echo 'class="side_active"';} ?>>

    	<a href="settings/invite-friends" ><i class="ic-credit"></i>
        	<?php if($this->lang->line('lg_user_invite') != '') { echo "邀請朋友"; } else echo "Invite Friends"; ?>


        </a>

    </li>
	-->
		
	<?php	}
	?>

    
	<?php } ?>

    

    <!-- <li class="side_active"><a href="#">Teams</a></li>-->

  </ul>

</nav>
				
				<!--<nav id="nav-mobile"></nav>-->

