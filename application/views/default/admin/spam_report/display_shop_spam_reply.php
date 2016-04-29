<?php  //echo '<pre>'; print_r($spamList); die;
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View and Reply</h6>
					</div>
					<div class="widget_content">
					<?php 
				//	echo '<pre>';
				//	print_r($shop_details); die;
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin/spam/spam_admin_reply',$attributes) 
						
					?>
	 						<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Shop Name </label>
									<div class="form_input">
										<?php echo $spamList->shop_name;?>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">complainted on</label>
									<div class="form_input">
										<?php echo $spamList->complaint_date;?>
									</div>
								</div>
								</li>
                               
                               <li>
								<div class="form_grid_12">
									<label class="field_title">Shop Owner Details</label>
									<div  class="form_input"> <?php $imG=explode(',',$spamList->seller_thumbnail);?>
										<?php if($imG[0] != '') {?><img src="images/users/thumb/<?php echo $imG[0];?>" style="width:70px; height:65px;background-color: #FFFFFF;
border: 1px solid #ECECEC;" />
									<?php } else {?><img src="images/dummyProductImage.jpg" style="width:70px; height:65px;background-color: #FFFFFF;
border: 1px solid #ECECEC;" /> <?php }?>
                                   <br />  <span><b>Name : </b><?php echo $spamList->seller_name;?></span> <br />
                                    <span><b>Email : </b><?php echo $spamList->seller_email;?></span>
                                    </div>
                                    
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Reporter details</label>
									<div class="form_input">
                                    <img src="images/users/thumb/<?php echo $spamList->reporter_thumbnail;?>" style="width:70px; height:65px;background-color: #FFFFFF;
border: 1px solid #ECECEC;" />     
                                    <br />  <span><b>Name : </b><?php echo $spamList->reporter_name;?></span> <br />
									<span><b>Email : </b><?php echo $spamList->reporter_email;?></span> <br />
									</div>
								</div>
								</li>
	 							
                               <li>
								<div class="form_grid_12">
									<label class="field_title">complaint title</label>
									<div class="form_input">
										<p>	<?php echo $spamList->spam_title;?></p>	
									</div>
								</div>
								</li>	
                               <li>
								<div class="form_grid_12">
									<label class="field_title">complaint description</label>
									<div class="form_input">
									<p>	<?php echo $spamList->complaint;?></p>
									</div>
								</div>
								</li>	
                                <li>
								
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/spam/spam_shop_List" class="tipLeft" title="Go to lists"><span class="badge_style b_done">Back</span></a>
                                        &nbsp; &nbsp;	<a href="javascript:void(0);" id="replybtn" class="" title="Go to lists"><span class="badge_style b_done">Reply</span></a>
									</div>
								</div>
								</li>
                                
                                
                                
                                <form action="admin/spam/spam_admin_reply" method="post">
                                
                                
									<li id="changerply1" style="display:none">
                                      <div class="form_grid_12">
                                      
                                        <label class="field_title" for="subject">Subject</label>
                                        
                                        <div class="form_input">
                                          <textarea name="subject" id="subject" title="Please enter the Subject"></textarea>
                                        </div>
                                      </div>
                                 </li>
                                
                                
                                
									<li id="changerply" style="display:none">
                                      <div class="form_grid_12">
                                      
                                        <label class="field_title" for="message">Message</label><span class="req" style="color:#F00">*</span>
                                        
                                        <div class="form_input"><div id="msgerr" style="color:#F00; display:block;"></div>
                                          <textarea name="message" id="message" tabindex="4" class="large tipTop  mceEditor" title="Please enter the message"></textarea>
                                          
                                        </div>
                                        <input type="hidden" name="to_mail" value="<?php echo $spamList->reporter_email;?>">
                                        <input type="hidden" name="to_name" value="<?php echo $spamList->reporter_name;?>">
                                        
                                      </div>
                                 </li>
                                 
                                 <li  id="changerply2" style="display:none">
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" id="sndsubmit" class="btn_small btn_blue"><span>SEND</span></button>
									
										<button type="button" id="canclreply" class="btn_small btn_blue"><span>CANCEL</span></button>
									</div>
								</div>
								</li>
								</form>	
                                
                                
                                
								</ul>
							
							
							
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>
<script>
$(document).ready(function(e) {
    $('#replybtn').click(function() {
	$('#changerply1').css('display','block');
	$('#changerply').css('display','block');
	$('#changerply2').css('display','block');
	});
});
$(document).ready(function(e) {  //sndsubmit
    $('#canclreply').click(function() {
	$('#changerply1').css('display','none');
	$('#changerply').css('display','none');
	$('#changerply2').css('display','none');
	});
});
$(document).ready(function(e) {  //
    $('#sndsubmit').click(function() {
		var msgval=(tinyMCE.get('message').getContent()); 
	if(msgval=='')
	{
		$('#msgerr').html('Message is empty');
		return false;
	}
	});
});
$(document).ready(function(e) {  //
    $('#message').click(function() {
	$('#msgerr').css('display','none');
	});
});
</script>
