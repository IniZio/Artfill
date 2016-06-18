<?php $FriendsEmailAddress=$FriendsEmailAddress;

  ?>

<?php 
$this->load->view('site/templates/header');  
?>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/invite.css"/>

<section>
    <div class="main">

        <div class="container">
		
		
            <ul class="breadcrumb_top">
                <li><a href="<?php echo base_url();?>"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
                <li>></li>
                <li>Invite friends</li>

            </ul>
			<div class="left_side">   
	
                <?php $this->load->view('site/user/sidebar'); ?>
            </div>


		<div class="right_side">
		
		 <div class="split_prefile">
                        <h2>Invite Your Friends</h2>
                        <div class="clear"></div>
                        <div class="close_content">
                        </div>
                    </div>
		<form action ="site/invite_friends/invite_send_mail" type="get" onSubmit="return InviteFrnd();">
		
					<input type="submit" name= "submit" id="submit" value = "Invite and Follow" class="join_invites_submit"> 			   
						<br><br><br><br><br>
			<?php foreach($FriendsEmailAddress as $FriendsEmailAddressLists){ ?>
			 <div class="following_box"><div style="width: 340px;" class="follow_block">
				<div class="follow_details">
						<div class="contact_input_div"><div class="follow_name">
						
						<input type="checkbox" value="<?php echo $FriendsEmailAddressLists; ?>" class="join_input simple" id="emailID" name="emailID[]"><?php echo $FriendsEmailAddressLists; ?>
						
						</div>
						</div></div></div></div>
			<?php }?>

			<input type="hidden" name="MyemailAddressOrg" id ="MyemailAddressOrg"  value="<?php echo $MyemailAddressOrg; ?>">
			<input type="hidden" name="MyNameTitleOrg" id ="MyNameTitleOrg"  value="<?php echo $MyNameTitleOrg; ?>">


            <div></div></div> </div>
		</form>
			</div>
		</div>
    </div>
 </div>
  
</section>



<script type="text/javascript">

function InviteFrnd(){

var atLeastOneIsChecked1= $('input[name="emailID[]"]:checked').length;

if(atLeastOneIsChecked1==0){

	alert('choose atlest one');

		return false;

}

}
 
	
	</script>

<?php 
$this->load->view('site/templates/footer');
?>


 