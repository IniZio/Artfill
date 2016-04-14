<?php 
$this->load->view('site/templates/header');
$this->load->model('product_model');
$this->load->model('user_model');
?>
	<section class="container">
    	<div class="main">
        	<ul class="bread_crumbs">
            	<li><a href="<?php echo base_url(); ?>">Home</a></li>
                <span>›</span>
                <li><a href="zendesk-tickets">Display Zendesk Tickets</a></li>
                <span>›</span>
                <li>View Ticket #<?php echo $this->uri->segment(2);?></li>
            </ul>
            <div class="convers">                
                <div class="conversation_container">
                    <div class="conversation_container_right"> 
						<div class="ticket_header">
							<span><h3>View Zendesk Ticket
								<a href="zendesk-tickets"><label class="addticket"> <h5><i class="fa fa-reply"></i> Back To Tickets </h5></label> </a></h3>  </span>
						</div>
					<?php if(count($ticket_details) > 0) { ?>
					
					 <div class="col-sm-12 controls" style="margin:1%; border: 1px solid; border-radius:5px; width: 98%;">
						  <?php if($ticket->status == 'open'){ ?>
							  <span class="btntic ticket_status" style="padding: 10px 13px;"><b> Status : <?php echo ucfirst($ticket->status); ?></b></span>
							<?php } else { ?>
							  <span class="btntic ticket_status" style="background-color: gray; padding: 10px 13px;"><b> Status : <?php echo ucfirst($ticket->status); ?></b></span>
							<?php } ?>
						<div style="padding: 1%; color: black;">
							 <h4> <b style="color:blue; ">Ticket #<?php echo $this->uri->segment(2);?></b> : <?php echo $ticket->subject; ?> </h4>
						</div>
					</div>
					
					<?php for($i=0; $i < count($ticket_details); $i++) {  
						
						$author = $this->zendeskclass->call('/users/'.$ticket_details[$i]->author_id,'','GET'); 
						$user_email=$this->session->userdata('shopsy_session_user_email');
						
						if($user_email == $author->user->email){
					?>
					
						<div class="col-sm-12 controls rht">
							
							<div class="arrow-right"></div>
							<div class="alert alert-success" style="min-width:30%;max-width:95%;float:right; ">
								<p class="message"><?php echo $ticket_details[$i]->html_body; ?></p>
								<div style="font-size:11px;float:right;">
									send by 
									<span style="color:black;"><?php echo ucfirst($author->user->name); ?></span> 
									<?php 
									$datediff = time()-strtotime($ticket_details[$i]->created_at); 
									$diffdate=floor($datediff/(60*60*24));
									if($diffdate!=0){
										if($diffdate<4){
											echo $diffdate.' days ago';
										}else{
											echo date('m/d/y',strtotime($ticket_details[$i]->created_at));
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
								</div>
							</div>
						</div>
						
						<?php  } else { ?> 
						
						
						<div class="col-sm-12 controls lft">
						<div class="arrow-left"></div>
						<div class="alert alert-success" style="min-width:30%;max-width:95%;float:left;">
							<p class="message"><?php echo $ticket_details[$i]->html_body; ?></p>
							<p style="font-size:11px; text-align:right; ">
								send by 
								<span style="color:black;"><?php echo ucfirst($author->user->name); ?></span>
								<?php 
									$datediff = time()-strtotime($ticket_details[$i]->created_at); 
									$diffdate=floor($datediff/(60*60*24));
									if($diffdate!=0){
										if($diffdate<4){
											echo $diffdate.' days ago';
										}else{
											echo date('m/d/y',strtotime($ticket_details[$i]->created_at));
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
							</p>								
						</div>
					</div>
						
						
						
						<?php } 
						}
						?>

					
				
				<?php } else {?>

					  <h2 style="margin: 1%;">No Messages Found!</h2>

			  <?php } ?>

           			</div>

                </div>

			</div>

		</div>

	</section>



<style>
.ticket_status{
	background-color: green;
    color: #fff;
    float: right;
    font-weight: bold;
    margin-top: 1%;
    padding: 6px;
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
    padding: 7%;
	cursor: pointer;
}

.ticket_header label{
	float:right;
	width: 15%;
}

.btntic {
    -moz-user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    cursor: default;
    display: inline-block;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.42857;
    margin-bottom: 0;
    padding: 6px 12px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
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