<?php 
//error_reporting(-1);
$this->load->view('site/templates/commonheader');  
$this->load->view('site/templates/header');  
$this->load->view('site/freshdesk/menu_bar');  
			
?>
<div class="main">   

	<ul class="bread_crumbs">
        	<li>
				<a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a>
			</li>
            <span>&rsaquo;</span>
           <li>
			   <a href="<?php echo base_url(); ?>view-ticket-list/<?php echo $seller_info->seourl;?>" class="a_links">
					<?php if($this->lang->line('comm_view_freshdesk_tickets') != '') { echo stripslashes($this->lang->line('comm_view_freshdesk_tickets')); } else echo 'Tickets'; ?>
				</a>
			</li>
		   <span>&rsaquo;</span>
		   <li><?php if($this->lang->line('comm_view_freshdesk_ticket') != '') { echo stripslashes($this->lang->line('comm_view_freshdesk_ticket')); } else echo 'Ticket'; ?> #<?php echo $freshdesk_view->helpdesk_ticket->display_id; ?></a></li>
     </ul>

<div class="community_right">      
	 <div class="split_prefile" >
		<h2 style="color: #22BEEF;"> <?php if($this->lang->line('create_support_ticket1') != '') { echo stripslashes($this->lang->line('create_support_ticket1')).$freshdesk_view->helpdesk_ticket->display_id; } else echo 'Seller Support Ticket View #'.$freshdesk_view->helpdesk_ticket->display_id; ?></h2>
	 </div>
	  <div class="pass">
		<?php $count=count($freshdesk_view);?>
			<?php if($count>0){ ?>   
					
												<?php  $createdOn= date('Y-m-d H:i:s',strtotime($freshdesk_view->helpdesk_ticket->created_at));
													$datediff = time()-strtotime($createdOn); 
													$diffdate=floor($datediff/(60*60*24));
													if($diffdate!=0){
														if($diffdate<4){
															$msgtime= $diffdate.addslashes(shopsy_lg('lg_days_ago','days ago'));
														}else{
															$msgtime= date('m/d/Y',strtotime($createdOn));
														}
													}else{
														if(floor($datediff/(60*60))<1){
															if(floor($datediff/(60))>0){
																$msgtime= floor($datediff/(60)).addslashes(shopsy_lg('lg_mins_ago',' mins ago'));
															}else{
																$msgtime= addslashes(shopsy_lg('lg_justnow',' Just now'));
															}
														}else{
															$msgtime= floor($datediff/(60*60)).addslashes(shopsy_lg('lg_hrs_ago',' hours ago'));
														}
													}
												?>
			<div class="profile_field1" >
				<label style="font-size:25px;color:white;"><?php  echo $freshdesk_view->helpdesk_ticket->subject; ?> </label>
			</div>
			
			<div class="profile_field1">
					 <label><?php echo shopsy_lg('lg_des','Description:');?> <?php  echo $freshdesk_view->helpdesk_ticket->description; ?> </label>
			</div>
				<span style="float:right;color:black;"><i><?php echo shopsy_lg('lg_posted','Posted');?> <?php echo $msgtime; ?></i> </span>
						<?php } ?>
				<?php //echo"<pre>";print_r($freshdesk_view); ?>
	  </div>
	 <?php if(count($freshdesk_view->helpdesk_ticket->notes)>1){?>
	 
		<?php for($i=1;$i<count($freshdesk_view->helpdesk_ticket->notes);$i++){ ?>
			
				<?php if($freshdesk_view->helpdesk_ticket->notes[$i]->note->source != 0)
															{$conv_name=addslashes( shopsy_lg('lg_report','Reported by')).$freshdesk_view->helpdesk_ticket->requester_name;
															 $color="background-color:rgb(216, 240, 198);color:rgb(102, 3, 26);";
															}
																
															else{$conv_name=addslashes(shopsy_lg('lg_reply','Replied by')).$freshdesk_view->helpdesk_ticket->responder_name; 
																		 $color="color:rgb(0, 2, 3)";	
															}
															?>
														<?php  $createdOn= date('Y-m-d H:i:s',strtotime($freshdesk_view->helpdesk_ticket->notes[$i]->note->created_at));
													
													$datediff = time()-strtotime($createdOn); 
													$diffdate=floor($datediff/(60*60*24));
													if($diffdate!=0){
														if($diffdate<4){
															$msgtime= $diffdate.addslashes(shopsy_lg('lg_days_ago',' days ago'));
														}else{
															$msgtime= date('m/d/Y',strtotime($createdOn));
														}
													}else{
														if(floor($datediff/(60*60))<1){
															if(floor($datediff/(60))>0){
																$msgtime= floor($datediff/(60)).addslashes(shopsy_lg('lg_mins_ago',' mins ago'));
															}else{
																$msgtime= addslashes(shopsy_lg('lg_justnow',' Just now'));
															}
														}else{
															$msgtime= floor($datediff/(60*60)).addslashes(shopsy_lg('lg_hrs_ago',' hours ago'));
														}
													}
												?>
			<div class="col-sm-12 controls" style="margin:1%; border: 1px solid; border-radius:5px; width: 98%;<?php echo $color; ?>">
						<label ><?php echo $freshdesk_view->helpdesk_ticket->notes[$i]->note->body_html; ?> </label>
					<span style="float:right;"><i><p ><?php  echo $conv_name; ?></p><?php echo $msgtime; ?></i></span>
			</div>			  
		 
			<?php } ?>
	  <?php } ?>
</div>	


 
<div class="community_right">  
	<form action="send-ticket-message" method="post" onsubmit="return validateTktCommt();">
	<div class="profile_field">
		<textarea type="textarea" name="ticket_reply_textarea" id="ticket_reply_textarea" class="ticket_reply_textarea" value="" ></textarea>
	</div>
	<div class="profile_field">
		<input type="submit" class="password_btn" style="" value="<?php if($this->lang->line('user_send') != '') { echo stripslashes($this->lang->line('user_send')); } else echo 'SEND'; ?>" style="  margin-top:40px;" id="support_submit" />
		<input type="hidden" name="ticket_id" value="<?php echo $freshdesk_view->helpdesk_ticket->display_id; ?>" />
		
	</div>	
	</form>
</div>
</div>

<style>
.pass {
    border: 1px solid #dadbd6;
    border-radius: 5px;
    float: left;
    padding: 0;
	min-height:50%;
	background: rgb(97, 180, 206);
}
.ticket_reply_textarea{
    float: left;
    height: 100px;
    width: 97%;
}
.showup{
 border: 1px solid;
    border-radius: 5px;
    margin: 1% 1% 1% -115px;
    width: 99%;
	margin-left:-125px;

}


.profile_field1 label {
    color: #4c4c4c;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
    font-weight: bold;
    padding: 0;
    text-align: right;
	 margin: 20px 0 0 35px;
}
</style>

<?php 
$this->load->view('site/templates/footer');
?>