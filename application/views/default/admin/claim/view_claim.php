<?php
$this->load->view('admin/templates/header',$this->data);
?>
<script>
function ValidateForm(){
	if((document.getElementById('sent_claim1').checked==false) && (document.getElementById('sent_claim2').checked==false))
	{
		alert("Please Choose Checkbox");
		document.getElementById('sent_claim1').focus();
		return false;
	}

	if(document.getElementById('post_message').value=="") {
		alert("Please enter your comment");
		document.getElementById('post_message').focus();
		return false;
	}else{
		$("#postmsg").val(document.getElementById('post_message').value);
	}
}
</script>
<script>
function insertcomment() {
	if(document.getElementById('post_message').value=="") {
		alert("Please enter your comment");
		document.getElementById('post_message').focus();
		return false;
	}
}
</script>
<style>
.button:hover {
	background: #3e73b7;
}
.button {
	cursor: pointer;
	overflow: visible;
	margin: 5px 62px;
	padding: 8px 8px 10px 7px;
	border: 0;
	border-radius: 4px;
	font-weight: bold;
	font-size: 13px;
	line-height: 15px;
	text-align: center;
	color: #fff;
	background: #588cc7;
}
.notifications{
	float: left;
	width: 93%;
	background-color: white;
	padding: 20px;
	margin: 20px;
	box-shadow: 0px 0px 10px rgb(213, 190, 190);
}
ol.commentContainer{
	height: 80px;
	width: 1000px;
}
li.comment{
	position: relative;
	padding: 17px 0 12px 43px;
	z-index: 1;
	min-height: 20px;
	border-bottom: 1px solid #ECEEF4;
	clear: both;
	margin-top:20px;
}
li.comment span.vcard{
	font-weight: bold;
	top: -5px;
	position: absolute;
	left: 0;
	z-index: 1;
	float: none;
}
a.url img{
	margin: 4px 4px 0 0;
	display: inline-block;
	float: none;
	max-width: 50px;
	max-height: 50px;
	border-radius: 3px;
	vertical-align: top;
}
span.nickname{
	color: #2a5f95;
	padding: -3px 0 0 6px;
	display: inline-block;
	font-size: 11px;
	line-height: 51px;
	font-style: normal;
}
li.comment p.c-text{
	font-size: 13px;
	position: relative;
	z-index: 2;
	display: inline-block;
	vertical-align: middle;
	line-height: 18px;
	padding: 0;
	margin: 1px 0;
	color: #3a3d41;
	word-break: normal;
}
li.comment p:last{
	font-size: 10px;
	font-style: italic;
	color: green;
	padding: 0;
	line-height: 18px;
	margin: 0;
}

.inline-message {
	margin-left: 55px;
	width: 80%;
	font-size: 12px;
	line-height: 17px;
	color: #111110;
	display: inline-block;
	margin-bottom: 0;
	padding-top: 3px;
	background-color: rgb(246, 240, 232);
	padding-left: 11px;
	min-height: 43%;
}
.update_btn{
	float:right; 
	background-color:floralwhite;
	cursor:pointer;
	margin: 3px 15px;
}

.update_btn:hover{
	background-color:rgb(235, 163, 10);
}
</style>
		
<script>
function ansEditform(val,ansId,rowNo){ 
 var ans = $("#ansVal-"+rowNo).val();
 $("#"+val.id).hide();
$("#"+ansId).html('<textarea style="margin: 2px; width: 97%; height: 50px;" id="upAns-'+rowNo+'">'+ans+'</textarea> <input id="upbtn-'+rowNo+'" onclick="return update_answer(this,'+rowNo+');" type="button" value="Update" class="update_btn" />'); 

}

function update_answer(val,ansNo){  
var answer = $("#upAns-"+ansNo).val();
  $('#'+val.id).val('Updating..');
  $.post('admin/faq/edit_faq_ansAjax',{ answer : answer,thread_id : ansNo }, function(data){ 
  $('#'+val.id).val('Updated'); 
  $("#ans-"+ansNo).html(answer+' <label style="float:right; font-size: 10px;font-style:italic;color:green; padding: 41px 8px 0px 11px;"> <?php echo date('M d- Y h:s',time());?></label>  ');
  $("#ansVal-"+ansNo).val(answer);
  $("#edit-"+ansNo).show();
  
  });
}

function insertAnswer(rowNo,product_id){
   var newAns = $("#newAns-"+rowNo).val();
   if(newAns == ''){
     $("#newAns-"+rowNo).css('border-color','#F00');
	 $("#ansErr-"+rowNo).html('Your answer is empty!...');
   } else { 
     $("#loader-"+rowNo).css('display','block');
     $.post('admin/faq/insertAnswerAjax',{ answer : newAns,thread_id : rowNo,product_id : product_id}, function(data){ 
     $("#ans-"+rowNo).html(newAns+' <label style="float:right; font-size: 10px;font-style:italic;color:green; padding: 41px 8px 0px 11px;"> <?php echo date('M d- Y h:s',time());?></label>  ');
    $("#ansVal-"+rowNo).val(newAns);
    $("#action-"+rowNo).css('display','block'); 
	$("#status-"+rowNo).css('display','block'); 
	 
      });
   }
}


</script>

	<div id="content">
		<?php //if ($claimDetails->num_rows()>0){ ?>   	
			<div class="review_top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="float:left;border:1px solid #cecece; width:99.5%;">
				<tbody>
				<tr bgcolor="#f3f3f3">
					<td width="14%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Image</span></td>
			        <td width="42%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Name</span></td>
				</tr>
				<?php 
					foreach($claimDetails->result() as $product_info) {
					$image=explode(',',$product_info->image);
				?>	
					<tr>
						<td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;">
							<span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">
								<a href="products/<?php echo $product_info->prdurl;?>" target="_blank"><img src="images/product/list-image/<?php echo $image[0];?>" alt="<?php echo $product_info->product_name;?>" width="70"></a>
							</span>
						</td>
						<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;">
							<span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">
								<a href="products/<?php echo $product_info->prdurl; ?>" target="_blank" style="color:#0066FF"><?php echo $product_info->product_name;?></a>
							</span>
						</td>
					</tr>
				
				<?php } ?>
				</tbody>
				</table>
			</div>
<!-- 			<hr class="review_hr"> -->
		
		<h2> Dispute details for this product. </h2>
		<?php foreach ($claimComments->result() as $comments) { ?>
			<?php 
				$posterinfo=$this->claim_model->get_all_details(USERS,array('id'=>$comments->posted_id));
				if($posterinfo->row()->thumbnail!=''){
					$post_img=USERIMAGEPATH.$posterinfo->row()->thumbnail;
				}else{
					$post_img='images/default_avat.png';
				}
				/*time frame*/
				$datediff = time()-strtotime($comments->post_time); 
				$diffdate=floor($datediff/(60*60*24));
				if($diffdate!=0){
					if($diffdate<4){
						$cmtTime =$diffdate.' days ago';
					}else{
						$cmtTime =date('m/d/y',strtotime($comments->post_time));
					}
				}else{
					if(floor($datediff/(60*60))<1){
						if(floor($datediff/(60))>0){
							$cmtTime =floor($datediff/(60)).' mins ago';
						}else{
							$cmtTime ='just now';
						}
					}else{
						$cmtTime= floor($datediff/(60*60)).' hours ago';
					}
				}
			?>	
	        <div class="review_comments" style="float: left;">
	        	
	        	 <?php 
	        	 if($faq->user_img != ''){
				    $userImg = USERIMAGEPATH.$faq->user_img;
				 } else {
			    	$userImg = 'images/default_avat.png';
				 }
	        	 ?>
				 <?php $i=0; ?>
	        	 <section class="comments comments-list comments-list-new">
		        	 <ol class="commentContainer">	        
		        		<!--<li class="comment" style="position: relative;padding: 17px 0 12px 43px;z-index: 1;min-height: 20px; margin-bottom: 12px;">-->
		        		<li class="comment" style="position: relative;padding: 18px 0 12px 65px;z-index: 1;min-height: 20px; margin-bottom: 12px;">
							<a class="milestone" id="comment-1866615"></a>
							<span class="vcard" style="width: 99%; height:10%;">
								<a class="url" href="view-profile/<?php echo $posterinfo->row()->user_name;?>" target="_blank">
									<img src="<?php echo $post_img;?>" alt="<?php echo $posterinfo->row()->full_name;?>" style="width:70px !important" class="photo">
									<span class="fn nickname"><?php echo ucfirst($posterinfo->row()->full_name);?></span>
								</a>
                               <p style="font-size: 10px;font-style:italic;color:green; float:right; padding: 41px 2px; height:1px;"><?php echo $cmtTime; ?></p>
							</span>
                             <p class="c-text" style="font-size:14px; padding-left: 14px; font-family: cursive; color: rgb(235, 163, 10); margin-top: 14px;"><?php echo $comments->post_message;?></p>
							<?php if($comments->image!='') { ?>
								<p>
									<?php 
										$dispute_string=substr($comments->image,0,-1);
										$dispute_img=explode(',',$dispute_string);
										$count_img=count($dispute_img);
										for($i=0;$i<$count_img;$i++){
									?>
										<a href="images/dispute_images/<?php echo $dispute_img[$i]; ?>" target="_blank"><img src="images/dispute_images/<?php echo $dispute_img[$i]; ?>" style="width:40px; height:40px;" class="photo"></a>&nbsp;&nbsp;
									<?php } ?>
								</p>
							<?php } ?>	 
						</li>      
					</ol>
				</section>		
				<?php } ?>
				<span class="vcard" style="width: 99%; height:10%;">
					<form name="comments" method="post" action="admin/claim/add_comments">
						<div class="inline-message" id="ans-<?php echo $faq->thread_id;?>" style="margin-top:35px;">
							<!--<textarea class="text" style="margin: 2px; width: 97%; height: 50px;" name="post_message" placeholder="Write your comment..." id="post_message"></textarea>-->
							<textarea class="text" style="margin: 2px; width: 97%; height: 50px;" name="post_message" id="post_message"></textarea>
							<br />
							<input type="submit" class="submit button" onclick="return insertcomment()" value="Post Comment " />
							<img alt="loading" src="images/site/loading.gif" style="display: none; margin: -34px 199px 0px 205px;"/>
						</div>
						<input type="hidden" value="<?php echo $this->uri->segment(4); ?>" name="dealCodeNumber" id="dealCodeNumber" />
						<input type="hidden" value="<?php echo $posterinfo->row()->email; ?>">
					</form>
                </span>
				<br><br>
				<form name="claim" method="post" action="admin/claim/update_claim">
				<input type="hidden" name="dealCodeNumber" id="dealCodeNumber" value="<?php echo $this->uri->segment(4); ?>" >
					<table border="0" width="100%">
						<tr>
							<td>
								<input type="radio"<?php if($claimSent->row()->sent_claim==1) { echo 'checked=checked'; } ?> value="1" name="sent_claim" id="sent_claim1">To Buyer
								<input type="radio"<?php if($claimSent->row()->sent_claim==2) { echo 'checked=checked'; } ?> value="2" name="sent_claim" id="sent_claim2">To Seller
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
							<input type="hidden" name="post_message" id="postmsg" value="">
								<input type="submit" class="submit button" value="Update" onClick="return ValidateForm()">
								<input type="button" class="submit button" value="Back" onclick="javascipt:history.back();">
							</td>
						</tr>
					</table>
				</form>
	        </div>
	      <?php 
			#}
		#}
	      ?>  
	       <?php exit; //}else { ?>
	       <h3>No queries available..</h3>
	       <?php //} ?> 
		</div>
		
	</div>
   		

	<!-- / container -->
<?php
$this->load->view('admin/templates/footer',$this->data);
?>
