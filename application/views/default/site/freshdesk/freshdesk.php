<?php 
//error_reporting(-1);
$this->load->view('site/templates/commonheader');  
$this->load->view('site/templates/header');  
$this->load->view('site/freshdesk/menu_bar');  
			
?>

<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<?php } ?>

<div id="shop_page_seller">
    <section class="container">
    	<div class="main">
		
			<div class="community_right">      
			     <div class="split_prefile">
					<h2> <?php if($this->lang->line('create_support_ticket') != '') { echo stripslashes($this->lang->line('create_support_ticket')); } else echo 'Create New Support Ticket'; ?></h2>
			     </div>
			     <div class="pass">
					<form action="site/seller_support/create_ticket" method="post" enctype="multipart/form-data">
					<div class="profile_field">
						<label ><?php if($this->lang->line('support_subject') != '') { echo stripslashes($this->lang->line('support_subject')); } else echo 'Subject'; ?><span style="color:red;float: right;">*</span> </label>
						<input type="text" name="support_subject" id="support_subject" value="" style="width:250px;" />
							<span id="errorSub" ></span>
					</div>
					<div class="profile_field">
						<label ><?php if($this->lang->line('support_description') != '') { echo stripslashes($this->lang->line('support_description')); } else echo 'Description'; ?><span style="color:red;float: right;">*</span> </label>
						<textarea type="textarea" name="support_description" id="support_description" value="" style="height:80px;width:250px;"></textarea>
						<span id="errorDesc"></span>
					</div>
					<div class="profile_field">
						<label ><?php if($this->lang->line('support_priority') != '') { echo stripslashes($this->lang->line('support_priority')); } else echo 'Priority'; ?><span style="color:red;float: right;">*</span> </label>
						<select name="support_priority" id="support_priority" >
								<option value="Select Priority"><?php echo af_lg('lg_select_priority','Select Priority');?></option>
							<option value="1"><?php echo af_lg('lg_low','Low');?></option>
							<option value="2"><?php echo af_lg('lg_medium','Medium');?></option>
							<option value="3"><?php echo af_lg('lg_high_pri','High Priority');?></option>
							<option value="4"><?php echo af_lg('lg_urgent','Urgent');?></option>
						</select>
						<span id="errorPri"></span>
					</div>
					<div class="profile_field" style="display:none;">
						<label ><?php if($this->lang->line('support_priority') != '') { echo stripslashes($this->lang->line('support_priority')); } else echo 'Priority'; ?> </label>
						<select name="support_status" id="support_status" >
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>
					<?php /*  <div class="profile_field">
						<label>Attachment<span style="color:#F00;" class="redFont" id="attachmentsErr"></span></label>          
						<input type="file" name="AttachmentFile" value="" id="attachments">
					</div> */   ?>
					<div class="profile_field">
						<input type="hidden" name="email" value="<?php echo $this->session->userdata['shopsy_session_user_email']; ?>"/>
						<input type="submit" class="password_btn" value="<?php if($this->lang->line('support_new_ticket') != '') { echo stripslashes($this->lang->line('support_new_ticket')); } else echo 'Create Ticket'; ?>" style=" margin-left:250px; margin-top:40px;" id="support_submit" onclick="return ticket_validation();"/>
					</div>	
					 </form>
			    </div>
			</div> 
		</div>
	</section>
</div>
<style>
.filter-button-inside input, select {
    margin-left: 0;
    padding: 0 5px;
    width: 27%;
}
</style>

<?php 
$this->load->view('site/templates/footer');
?>