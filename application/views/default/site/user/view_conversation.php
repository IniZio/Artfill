<?php 
$this->load->view('site/templates/header');
$this->load->model('product_model');
$this->load->model('user_model');
?>
	<section class="container">
    	<div class="main">
        	<ul class="bread_crumbs">
            	<li><a href="<?php echo base_url(); ?>"><?php echo artfill_lg('lg_home','Home'); ?></a></li>
                <span>›</span>
                <li><a href="view-profile/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>"><?php echo artfill_lg('lg_profile','Profile'); ?></a></li>
                <span>›</span>
                <li><a href="people/<?php echo $this->session->userdata['shopsy_session_user_name'];?>/conversations"><?php echo artfill_lg('lg_conversations','Conversations') ?></a></li>
            </ul>
            <div class="convers">                
                <div class="conversation_container">
                    <?php /* <div class="conversation_container_left">
                        <div class="side_bar">
                            <ul>
                                <li <?php if($viewfolder=='inbox'){ echo 'class="active"'; }?> style="background-color:#4197b3;">
                                    <a href="people/<?php echo $this->session->userdata['shopsy_session_user_name'];?>/conversations">
										<i class="fa fa-chevron-circle-left" style="color: white;"></i> 
										<span style="color:white;">Back to Conversation</span>
									</a>
                                </li>
                            </ul>
                        </div>
                    </div>     */        ?>       

                    <div class="conversation_container_right"> 
					<?php 
					if ($MessageDetail->num_rows() > 0){
						$this->db->order_by('id','desc');
						$prevMsg =$MessageDetail;# $this->user_model->get_message($MessageDetail->row()->tid); 
						if($MessageDetail->row()->sender_id != $this->session->userdata('shopsy_session_user_id')){
							$chatterId = $MessageDetail->row()->sender_id;
						} else {
							$chatterId = $MessageDetail->row()->receiver_id;
						}
						$chatperson=$this->user_model->get_all_details(USERS,array('id' => $chatterId));
						$receiverEmail=$row->sender_email; $receiverID=$row->sender_id; $action='Reply';
					?>
					 <div class="col-sm-12 controls" style="margin:1%; border: 1px solid; border-radius:5px; width: 98%;">
						  <a href="#contact_reg" class="btn" data-toggle="modal" style="float:right;font-weight:bold; padding:6px; margin-top: 1%;">
							<i class="fa fa-reply"></i>  <?php echo $action; ?>
						  </a>
						<div class="user_img">
							<?php 
							if($chatperson->row()->thumbnail!=''){ 
								$profile_pic='users/thumb/'.$chatperson->row()->thumbnail; 
							} else { 
								$profile_pic='default_avat.png';
							} 
							?>
							<img src="images/<?php echo $profile_pic;?>">
						</div>
						<div class="col-sm-6" style="margin-top: 1%; color: black;">
							<h4><?php echo $chatperson->row()->user_name;?> </h4>
						</div>
					</div>
					<?php
					$count=0;
					foreach($prevMsg->result_array() as $row){
						if(($row['sender_id']== $this->session->userdata('shopsy_session_user_id') && ($row['sender_status'] == 'Read' || $row['sender_status'] == 'Unread')) || ($row['receiver_id']== $this->session->userdata('shopsy_session_user_id') && ($row['receiver_status'] == 'Read' || $row['receiver_status'] == 'Unread'))){
						  if($row['sender_id']== $this->session->userdata('shopsy_session_user_id')){
					?>
							<div class="col-sm-12 controls rht">
								<?php $user_id=$this->session->userdata('shopsy_session_user_id')?>
								<div class="arrow-right"></div>
								<div class="alert alert-success" style="min-width:30%;max-width:95%;float:right; ">
									<p><strong><?php echo $row['subject'];?></strong></p>
									<p class="message"><?php echo $row['message'];?></p>
									<i style="font-size:11px;float:right;">
										 <?php echo artfill_lg('lg_sent_by','send by'); ?>
										<span style="color:black;"><?php echo $row['sender_name'];?></span> 
										<?php echo $row['dataAdded'];?>
										<a href="site/email/deleteconversation/<?php echo $user_id;?>/<?php echo $row['id'];?>" class="tmsg">
											<i class="fa fa-trash-o"></i>
										</a>
									</i>
								</div>
							</div>
					<?php }else { ?>
					<div class="col-sm-12 controls lft">
						<?php $user_id=$this->session->userdata('shopsy_session_user_id')?>
						<div class="arrow-left"></div>
						<div class="alert alert-success" style="min-width:30%;max-width:95%;float:left;">
							<p><strong><?php echo $row['subject'];?></strong></p>
							<p class="message"><?php echo $row['message'];?></p>
							<p style="font-size:11px; text-align:right; ">
								 <?php echo artfill_lg('lg_sent_by','send by'); ?>
								<span style="color:black;"><?php echo $row['sender_name'];?> </span>
								<?php echo $row['dataAdded'];?> 
								<a href="site/email/deleteconversation/<?php echo $user_id;?>/<?php echo $row['id'];?>" class="tmsg">
									<i class="fa fa-trash-o"></i>
								</a>
							</p>								
						</div>
					</div>
					<?php 
							}
						}else{
							$count++;
						}
								
					}
					if($MessageDetail->num_rows()==$count){
					?>
						<h2 style="margin: 1%;"><?php echo artfill_lg('lg_no_message_found','No Messages Found!');?></h2>
					<?php
					}
								

				} else {
				?>

					  <h2 style="margin: 1%;"><?php echo artfill_lg('lg_no_message_found','No Messages Found!');?></h2>

			  <?php } ?>

           			</div>

                </div>

			</div>

		</div>

	</section>
	<?php 
		if($row['receiver_email']!=$this->session->userdata['shopsy_session_user_email']){
	?>
	<div id='contact_reg' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">	
		


			<div id='' style='background:#fff;'>  

				<div style="" class="conversation">

					<div class="conversation_container">

						<!--<h2 class="conversation_headline">Replay to : <?php echo $row->username;?></h2>-->

						<div class="conversation_right">

							<form name="contactpeople" id="contactpeople" method="post" action="site/user/contactpeople" onsubmit="return contactsCheck();">
							

								<input class="conversation-subject" type="text" name="subject" id="subject" placeholder="Subject of the Conversation" style="width:610px;" value="" >

								<textarea class="conversation-textarea" style="width:610px;" rows="11" name="message_text" id="message_text" placeholder="<?php if($this->lang->line('user_msgtxt') != '') { echo stripslashes($this->lang->line('user_msgtxt')); } else echo 'Type Your Message Here'; ?>"></textarea>

								<input type="hidden" name="tid" id="tid" value="<?php echo $row['tid']; ?>" >
								<input type="hidden" name="sender_email" id="sender_email" value="<?php echo $this->session->userdata['shopsy_session_user_email']; ?>" >

								<input type="hidden" name="sender_id" id="sender_id" value="<?php echo $this->session->userdata['shopsy_session_user_id'];?>" >

								<input type="hidden" name="receiver_email" id="receiver_email" value="<?php echo $row['receiver_email'];?>" >

								<input type="hidden" name="receiver_id" id="receiver_id" value="<?php echo $row['receiver_id'];?>" >

								<input type="hidden" name="current_user" value="<?php echo $this->session->userdata['shopsy_session_user_name']; ?>" >

								<input type="hidden" name="FromURL" value="Conversation" >


								
								<div class="modal-footer footer_tab_footer">
									<div class="btn-group">
											<input class="submit_btn" type="submit" value="<?php if($this->lang->line('user_send') != '') { echo stripslashes($this->lang->line('user_send')); } else echo 'send'; ?>" />
											<a class="btn btn-default submit_btn" data-dismiss="modal" id="contact_reg">Cancel</a>
									</div>
								</div>
								

								<span class="error" id="ErrPUP"></span>

							</form>		

						</div> 

					</div>

				</div>

			</div>

				</div>
			</div>
		</div>
<?php } else {?>
	<div id='contact_reg' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">	
				<div id='' style='background:#fff;'>  
					<div style="" class="conversation">

						<div class="conversation_container">

							<!--<h2 class="conversation_headline">Replay to : <?php echo $row->username;?></h2>-->

							<div class="conversation_right">

								<form name="contactpeople" id="contactpeople" method="post" action="site/user/contactpeople" onsubmit="return contactsCheck();">
								

									<input class="conversation-subject" type="text" name="subject" id="subject" placeholder="Subject of the Conversation" style="width:610px;" value="" >

									<textarea class="conversation-textarea" style="width:610px;" rows="11" name="message_text" id="message_text" placeholder="<?php if($this->lang->line('user_msgtxt') != '') { echo stripslashes($this->lang->line('user_msgtxt')); } else echo 'Type Your Message Here'; ?>"></textarea>

									<input type="hidden" name="tid" id="tid" value="<?php echo $row['tid']; ?>" >
									<input type="hidden" name="sender_email" id="sender_email" value="<?php echo $this->session->userdata['shopsy_session_user_email']; ?>" >

									<input type="hidden" name="sender_id" id="sender_id" value="<?php echo $this->session->userdata['shopsy_session_user_id']; ?>" >

									<input type="hidden" name="receiver_email" id="receiver_email" value="<?php echo $row['sender_email'];?>" >

									<input type="hidden" name="receiver_id" id="receiver_id" value="<?php echo $row['sender_id'];?>" >

									<input type="hidden" name="current_user" value="<?php echo $this->session->userdata['shopsy_session_user_name']; ?>" >

									<input type="hidden" name="FromURL" value="Conversation" >


									
									<div class="modal-footer footer_tab_footer">
										<div class="btn-group">
												<input class="submit_btn" type="submit" value="<?php if($this->lang->line('user_send') != '') { echo stripslashes($this->lang->line('user_send')); } else echo 'send'; ?>" />
												<a class="btn btn-default submit_btn" data-dismiss="modal" id="contact_reg">Cancel</a>
										</div>
									</div>
									

									<span class="error" id="ErrPUP"></span>

								</form>		

							</div> 

						</div>

					</div>

				</div>
			<?php }?>
				</div>
			</div>
		</div>






<script>
$(document).ready(function(){
		$(".cboxClose1").click(function(){
			$("#cboxOverlay,#colorbox").hide();
		});
		$(".contact-popup").colorbox({width:"765", height:"auto", inline:true, href:"#contact_reg"});
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
    top: 11px;
}
.message{
	color:#9d8377;
}
.tmsg{
	float:none !important;
	width:10px !important;
}
.arrow-right {
    border-bottom: 15px solid transparent;
    border-left: 15px solid #6cbdc2;
    border-top: 15px solid transparent;
    display: block;
    float: right;
    height: 0;
    margin-top: 30px;
    width: 0;
}
.arrow-left {
    border-bottom: 15px solid transparent;
    border-right: 15px solid gray;
    border-top: 15px solid transparent;
    display: block;
    float: left;
    height: 0;
    margin-top: 30px;
    width: 0;
}
.rht .alert.alert-success {
    border-right: 6px solid #6cbdc2;
	background-color:#E9F6FC;
}
.lft .alert.alert-success {
    border-left: 5px solid gray;
	background-color:#fff;
}
.convers .conversation_container_right {
    border: 1px solid #d9d9d9;
    width: 100%;
}
</style>
<?php $this->load->view('site/templates/footer'); ?>