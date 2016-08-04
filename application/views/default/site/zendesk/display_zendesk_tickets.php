<?php 
$this->load->view('site/templates/commonheader'); 
$this->load->view('site/templates/shop_header');
?>

<div id="shop_page_seller">
	<section class="container">
    	<div class="main">
        	<ul class="bread_crumbs">
            	<li><a href="<?php echo base_url(); ?>"><?php echo af_lg('lg_home','Home');?></a></li>
                <span>›</span>
                <li><a href="shop/sell"><?php echo af_lg('lg_ur_shop','Your Shop');?></a></li>
                <span>›</span>
                <li><?php echo af_lg('lg_display_zendesk_ticket','Display Zendesk Tickets');?></li>
            </ul>
            <div class="convers community_right">                
                <div class="conversation_container" style="margin-bottom: 12px;">
				   <div class="conversation_container_right" style="width:100%;">     
                        <div>
                            <center><img id="MessageStatus" src="images/ajax-loader/ajax-loader(6).gif" alt="Loading" style="display:none;" /></center>
                        </div>  
						
						<?php if($zen_user_id != '' && $zen_user_id != 0) { ?>
						
                        <div class="ticket_header">
							<span><h3><?php echo af_lg('lg_display_zendesk_ticket','Display Zendesk Tickets');?>
								<a href="#create_ticket_popup" data-toggle="modal">
									<label class="addticket"> <h5><i class="fa fa-plus"></i><?php echo af_lg('lg_add_ticket','Add Ticket');?></h5></label> </h3> 
								</a>
							</span>
						</div>
						
						<?php } ?>
						
						<?php if (count($tickets) > 0){ ?> 
                       <?php  for($i=0; $i < count($tickets); $i++){  ?>
						 <a href="view-zendesk-tickets/<?php echo $tickets[$i]->id;?>">
							<ul  class="message-box" id="Msg_<?php echo $tickets[$i]->id;?>">
								<li>
									<div class="avatar_view" style="border-radius:50%; text-align: center; color: #000; width: 80px; background: none repeat scroll 0 0 #ddddff;"> 
									  #<?php echo $tickets[$i]->id;?>
									</div>
								</li>
								<li>
									<span class="re-order">
									   <?php echo $tickets[$i]->subject;?>
									</span>
								</li>

								<li  class="statusLi">
									<?php if($tickets[$i]->status == 'open'){ ?>
								   <span class="ticket_status"><?echo af_lg('lg_open','Open');?></span>
								   <?php } else { ?>
								   <span class="ticket_status" style="background-color: gray;"><?php echo $tickets[$i]->status; ?></span>
								   <?php } ?>
								</li>
								
								<li style="float:right">
									
									<span>
									<?php  $dateForm = date( "Y-m-d H:i:s", strtotime($tickets[$i]->updated_at) ); 
										$datediff = time()-strtotime($dateForm); 
										$diffdate=floor($datediff/(60*60*24));
										if($diffdate!=0){
											if($diffdate<4){
												echo $diffdate.' days ago';
											}else{
												echo date('m/d/y',strtotime($dateForm));
											}
										}else{
											if(floor($datediff/(60*60))<1){
												if(floor($datediff/(60))>0){
													echo floor($datediff/(60)).' mins ago';
												}else{
													echo 'just now';
												}
											}else{
												echo floor($datediff/(60*60)).' hours ago';
											}
										}
									?>
									</span>								
								</li>
							</ul>
						</a>
						
						<?php } ?>
						
                        <?php 
						}else{  
							 if($zen_user_id != '' && $zen_user_id != 0) {
							
					
							?>
                         <span style="text-align:center;"><h3 style="margin:5%; text-align:center; "><?php echo af_lg('lg_no_ticket_found','No Tickets Found');?></h3></span>
                        <?php } else { ?>
						<form action="site/zendesk/create_zendesk_user" method="post" id="zendesk_form">
							<a href="javascript:void(0);" onclick="javascript: $('#zendesk_form').submit();">
								<span style="text-align:center;"><h3 CLASS="createZenAccount"><?php echo af_lg('clk_here','Click Here To Create Account With Zendesk');?></h3></span>
							</a>
							<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('shopsy_session_user_id'); ?>" />
							<input type="hidden" name="user_name" value="<?php echo $this->session->userdata('shopsy_session_user_name'); ?>" />
							<input type="hidden" name="email_id" value="<?php echo $this->session->userdata('shopsy_session_user_email'); ?>" />
							<input type="hidden" name="return_url" value="<?php echo current_url(); ?>" />
						</form>
						
					<?php  }
					} ?>
           			</div>
				   

                </div>

			</div>

		</div>

	</section>	
</div>
<div id='create_ticket_popup' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">	
			<div id='' style='background:#fff;'>  
				<div style="" class="conversation">
					<div class="conversation_container">				
						<div class="conversation_right">
							<form name="contactpeople" id="create_zendesk_ticket_form" method="post" action="site/zendesk/create_vendor_zendesk_ticket" onsubmit="return zenCheck();">
								<input class="conversation-subject" type="text" name="subject" id="subject" placeholder="<?php echo af_lg('lg_subject_conv','Subject of the Conversation');?>" style="width:610px;" value="" >
								<textarea class="conversation-textarea" style="width:610px;" rows="11" name="description" id="message_text" placeholder="<?php if($this->lang->line('lg_type ur msg here') != '') { echo stripslashes($this->lang->line('lg_type ur msg here')); } else echo 'Type Your Message Here'; ?>"></textarea>
								<span style="float:right; margin-bottom: 2%; margin-right: 7%;">
									<?php echo af_lg('lg_priority','Priority : ');?>
									<select name="priority" id="priority">
										<option selected="selected" value="low"><?php echo af_lg('lg_low','Low');?></option>
										<option value="normal"><?php echo af_lg('lg_home','Normal');?></option>
										<option value="high"><?php echo af_lg('lg_high','High');?></option>
										<option value="urgent"><?php echo af_lg('lg_urgent','Urgent');?></option>
									</select>
								</span>
								<input type="hidden" name="requester" id="requester" value="<?php echo $this->session->userdata['shopsy_session_user_email']; ?>" />
								<input type="hidden" name="type" id="type" value="problem"/>
								
								<div class="modal-footer footer_tab_footer">
								 <span style="float:left;" id="ErrPUP" class="error"></span>
									<div class="btn-group">
											<input class="submit_btn" type="submit" value="<?php if($this->lang->line('user_send') != '') { echo stripslashes($this->lang->line('user_send')); } else echo 'send'; ?>" />
											<a class="btn btn-default submit_btn" data-dismiss="modal" id="contact_reg"><?php echo af_lg('lg_cancel','Cancel');?></a>
									</div>
								</div>
								
							</form>		

						</div> 

					</div>

				</div>

			</div>
		</div>
	</div>
</div>	


<script>
function zenCheck(){
	var c=0; 
	if($('#subject').val() == ''){
		c++;
	}
	if($('#message_text').val() == ''){
		c++;
	}
	if($('#priority').val() == ''){
		c++;
	}
	if(c > 0){
		$('#ErrPUP').html(lg_All_the_fields_are_required);
		return false;
	}
}
</script>

<style>

.ticket_status{
	background-color: green;
    border-radius: 12px;
    color: #fff;
    font-weight: bold;
    margin-right: 8%;
    padding: 5px;
}

.createZenAccount {
	border: medium solid;
    margin: 5%;
    padding: 2%;
    text-align: center;
	background-color: #C9F5EA;
}

.ticket_header{
	background: none repeat scroll 0 0 #ddddff;
    border-bottom: medium solid;
} 

.ticket_header h3{
	padding: 2%; 
	color: #6cae44;

}

.ticket_header h5{
	background: none repeat scroll 0 0 #01a9db;
    border: 2px solid;
    border-radius: 6px;
    color: #ffffff;
    margin: 0;
    padding: 5%;
	text-align: center;
	cursor: pointer;
}

.ticket_header label{
	float:right;
	width: 15%;
}

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