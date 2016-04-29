<?php
//print_r($this->data);
$this->load->view('site/templates/header',$this->data);
?>

<div class="tabs-sections">
	<div class="container">
		<?php /* <ul class="tabs-list">
			<li><a class="active" href="#">Menu 1</a></li>
			<li><a href="#">Menu 2</a></li>
			<li><a href="#">Menu 3</a></li>
			<li><a href="#">Menu 4</a></li>
			<li><a href="#">Menu 5</a></li>
			<li><a href="#">Menu 6</a></li>
			<li><a href="#">Menu 7</a></li>
		</ul> */ ?>

		<div class="detaisect-container">
			<?php if(count($notificationList)>0){ ?>
			<ul class="section-li-list">
				<?php foreach($notificationList as $row){ ?>
				<?php
					$type=$row["type"];
					switch($type){
						case "follow":
							$hLink="view-people/".$row["userName"];
						break;
						case "Make offer":
							//received-offer/1621/1/9
							$hLink="received-offer/".$row["activity_id"]."/".$loginCheck."/".$row['userId'];
						break;
						case "Edit offer":
							//received-offer/1621/1/9
							$hLink="received-offer/".$row["activity_id"]."/".$loginCheck."/".$row['userId'];
						break;
						case "Decline offer":
							//received-offer/1621/1/9
							$hLink="request-offer/".$row["activity_id"]."/".$row['userId']."/".$loginCheck;
						break;
						case "Accept offer":
							//received-offer/1621/1/9
							$hLink="request-offer/".$row["activity_id"]."/".$row['userId']."/".$loginCheck;
						break;
						case "Reject offer":
							//received-offer/1621/1/9
							$hLink="request-offer/".$row["activity_id"]."/".$row['userId']."/".$loginCheck;
						break;
						case "favorite item":
							$hLink="products/".$row["productUrl"];
						break;
						case "favorite shop":
							$hLink="view-people/".$row["userName"];
						break;
						case "question":
							$hLink="people/".$row["userName"]."/conversations/all/".$row["comment_id"];
						break;
						case "message":
							$hLink="people/".$row["userName"]."/conversations/all/".$row["comment_id"];
						break;
						case "discussion":
							$hLink="discussion/".$row["activity_id"];
						break;
						case "order":
							$hLink="view-people/".$row["userName"];
							$hLink="site/shop/vieworder/".$row["userId"]."/".$row["activity_id"];
						break;
						case "review":
							$hLink="shop/reviews#".$row["comment_id"];
						break;
						case "review-update":
							$hLink="shop/reviews#".$row["comment_id"];
						break;
						case "own-order-discussion":
							$hLink="discussion/".$row["activity_id"];
						break;
					}
				?>
				<li>
					<div class="left-img">
						<a href="view-people/<?php echo $row["userName"]; ?>"> 	
							<img src="<?php echo $row["userImage"]; ?>">
						</a>
					</div>
					<div class="right-contetn">
						<div class="right-contetn-top">
						
							<a href="<?php echo $hLink; ?>">
								<p>
									<?php echo $row["userName"]; ?> <?php echo $row["textDis"]; ?>  <?php if($row["message"]!=""){ echo $row["message"]; } ?>
								</p>
								
							</a>
							
						
						</div>
						<div class="right-contetn-bottom">
							<i class="date-ates"><?php echo $row["notifyTime"]; ?></i>
							<?php if($row["productUrl"]!=""){ ?>
							<a href="products/<?php echo $row["productUrl"]; ?>">   	
								<img class="ims-ritd" src="<?php echo $row["productImage"]; ?>">
							</a>
							<?php } ?>
						</div>
					</div>
				</li>
				<?php } ?>
			</ul>
			<?php }else{ ?>
				<h1><?php if($this->lang->line('no_notifications') != '') { echo stripslashes($this->lang->line('no_notifications')); } else echo 'No notifications available'; ?></h1>
			<?php } ?>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
$(".notification-list-count").remove();
$("#notificationCount").remove();
        
});
</script>
<?php
$this->load->view('site/templates/footer',$this->data);
?>

