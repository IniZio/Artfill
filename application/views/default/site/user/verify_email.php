<?php 

$this->load->view('site/templates/header');

?>

<section class="container">

	<div  class="main">

    	<div class="container">

			<div class="resending-sucess">

            	<h3><?php if($this->lang->line('verify_email') != '') { echo stripslashes($this->lang->line('verify_email')); } else echo 'Thanks, your confirmation email is on its way.'; ?></h3>

                <p><?php if($this->lang->line('acct_confirmed') != '') { echo stripslashes($this->lang->line('acct_confirmed')); } else echo 'Once your account is confirmed, you can'; ?> <a href="view-profile/<?php echo $this->session->userdata['shopsy_session_user_name'];?>"><?php if($this->lang->line('click_here') != '') { echo stripslashes($this->lang->line('click_here')); } else echo 'click here to continue'; ?></a>.</p>

            </div>

            <div>

                <div class="conformation-email">

                    <h4 style="color:#d35701; padding:4px 0; margin:0"><?php if($this->lang->line('send_mail') != '') { echo stripslashes($this->lang->line('send_mail')); } else echo 'Send confirmation email'; ?>: </h4>

                    <p class="current-email" style="float: left; margin: 0px 20px 0px 0px;"><?php if($this->lang->line('current_mail') != '') { echo stripslashes($this->lang->line('current_mail')); } else echo 'Your current email address is'; ?>: <?php echo $this->session->userdata['shopsy_session_user_email'];?> (<a href="settings/my-account/<?php echo $this->session->userdata['shopsy_session_user_name'];?>"><?php if($this->lang->line('prod_change') != '') { echo stripslashes($this->lang->line('prod_change')); } else echo 'Change'; ?></a>)</p>

                    <input type="button" class="resending password_btn" onClick="return resendConfirmationPopUp('<?php echo $this->session->userdata['shopsy_session_user_email'];?>');" value="<?php if($this->lang->line('resend_mail') != '') { echo stripslashes($this->lang->line('resend_mail')); } else echo 'Resend Confirmation Email'; ?>">

                </div>

            </div>

		</div>

    </div>

</section>    

<?php 

$this->load->view('site/templates/footer');

?>