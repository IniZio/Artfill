<?php

$this->load->view('site/templates/header');

?>

		<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
			<div class="add_steps shop-menu-list">

			<div class="main">
			
				<?php $this->load->view('site/user/sidebar');?>
			
			</div>
			
			</div>
<div id="profile_div"> 
<section class="container">

    	<div class="main">
		
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="view-profile/<?php echo $this->session->userdata['shopsy_session_user_name'];?>" class="a_links"><?php echo $this->session->userdata['shopsy_session_user_name'];?></a></li>
		   <span>&rsaquo;</span>
		   <li><?php echo artfill_lg('lg_gift_card','Gift cards');?></li>
        </ul>
        	

            <div class="community_page">

            	

                <div class="community_div">


                    <div class="community_right">

		



		<h2 class="ptit"><?php if($this->lang->line('giftcard_cards') != '') { echo stripslashes($this->lang->line('giftcard_cards')); } else echo "Gift Cards"; ?></h2>

		<?php if($giftcardsList->num_rows()>0){ ?>	

                 <div class="gifts">

            <h3><?php if($this->lang->line('giftcard_urlist') != '') { echo stripslashes($this->lang->line('giftcard_urlist')); } else echo "Your giftcards list"; ?>.</h3>

            <div class="chart-wrap">

            <table width="100%" cellpadding="7px" cellspacing="0" align="left" class="chart">

                <thead style="background:#DDEDF3">

                    <tr>

                        <th><?php if($this->lang->line('giftcard_code') != '') { echo stripslashes($this->lang->line('giftcard_code')); } else echo "Code"; ?></th>

                        <th><?php if($this->lang->line('giftcard_sendername') != '') { echo stripslashes($this->lang->line('giftcard_sendername')); } else echo "Sender Name"; ?></th>

                        <th><?php if($this->lang->line('giftcard_sender_mail') != '') { echo stripslashes($this->lang->line('giftcard_sender_mail')); } else echo "Sender Mail"; ?></th>

                        <th><?php if($this->lang->line('giftcard_price') != '') { echo stripslashes($this->lang->line('giftcard_price')); } else echo "Price"; ?></th>

                        <th><?php if($this->lang->line('giftcard_usedamount') != '') { echo stripslashes($this->lang->line('giftcard_usedamount')); } else echo "Used Amount"; ?></th>

                        <th><?php if($this->lang->line('giftcard_expireson') != '') { echo stripslashes($this->lang->line('giftcard_expireson')); } else echo "Expires on"; ?></th>

                        <th><?php if($this->lang->line('giftcard_card_stats') != '') { echo stripslashes($this->lang->line('giftcard_card_stats')); } else echo "Card Status"; ?></th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($giftcardsList->result() as $row){

                    	$status = $row->card_status;

                    	if ($status == 'not used'){

                    		$expDate = strtotime($row->expiry_date);

                    		if ($expDate<time()){

                    			$status = 'expired';

                    		}

                    	}

                    ?>

                    <tr>

                        <td><?php echo $row->code;?></td>

                        <td><?php echo $row->sender_name;?></td>

                        <td><?php echo $row->sender_mail;?></td>

                        <td><?php echo $currencySymbol;?> <?php echo  number_format($currencyValue*$row->price_value,2);?></td>

                        <td><?php echo $currencySymbol;?> <?php echo  number_format($currencyValue*$row->used_amount,2);?></td>                        

                        <td><?php echo $row->expiry_date;?></td>

                        <td><?php echo ucwords($status);?></td>

                    </tr>

                    <?php }?>

                    

                </tbody>

            </table>

			</div>

            <p>

				<a class="send-gift-cards" href="gift-cards"><?php if($this->lang->line('giftcard_send') != '') { echo stripslashes($this->lang->line('giftcard_send')); } else echo "Send a Gift Card"; ?></a>

			</p>

			</div>

		

		<?php } if($sendgiftcardsList->num_rows()>0){ ?>	


            <div class="clear"></div>

            <div class="gifts">

            <h3><?php if($this->lang->line('giftcard_urlist_sent') != '') { echo stripslashes($this->lang->line('giftcard_urlist_sent')); } else echo "Sent giftcards list"; ?>.</h3>

            <div class="chart-wrap">

            <table width="100%" cellpadding="7px" cellspacing="0" align="left" class="chart">

                <thead style="background:#eef0f3">

                    <tr>

                        <th><?php if($this->lang->line('giftcard_code') != '') { echo stripslashes($this->lang->line('giftcard_code')); } else echo "Code"; ?></th>

                        <th><?php if($this->lang->line('giftcard_receivername') != '') { echo stripslashes($this->lang->line('giftcard_sendername')); } else echo "Receiver Name"; ?></th>

                        <th><?php if($this->lang->line('giftcard_receiver_mail') != '') { echo stripslashes($this->lang->line('giftcard_sender_mail')); } else echo "Receiver Mail"; ?></th>

                        <th><?php if($this->lang->line('giftcard_price') != '') { echo stripslashes($this->lang->line('giftcard_price')); } else echo "Price"; ?></th>

                        <th><?php if($this->lang->line('giftcard_usedamount') != '') { echo stripslashes($this->lang->line('giftcard_usedamount')); } else echo "Used Amount"; ?></th>

                        <th><?php if($this->lang->line('giftcard_expireson') != '') { echo stripslashes($this->lang->line('giftcard_expireson')); } else echo "Expires on"; ?></th>

                        <th><?php if($this->lang->line('giftcard_card_stats') != '') { echo stripslashes($this->lang->line('giftcard_card_stats')); } else echo "Card Status"; ?></th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($sendgiftcardsList->result() as $row){

                    	$status = $row->card_status;

                    	if ($status == 'not used'){

                    		$expDate = strtotime($row->expiry_date);

                    		if ($expDate<time()){

                    			$status = 'expired';

                    		}

                    	}

                    ?>

                    <tr>

                        <td><?php echo $row->code;?></td>

                        <td><?php echo $row->recipient_name;?></td>

                        <td><?php echo $row->recipient_mail;?></td>

                        <td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$row->price_value,2);?></td>

                        <td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$row->used_amount,2);?></td>                        

                        <td><?php echo $row->expiry_date;?></td>

                        <td><?php echo ucwords($status);?></td>

                    </tr>

                    <?php }?>

                    

                </tbody>

            </table>

			</div>

            <p>

				<a class="send-gift-cards" href="gift-cards"><?php if($this->lang->line('giftcard_send') != '') { echo stripslashes($this->lang->line('giftcard_send')); } else echo "Send a Gift Card"; ?></a>

			</p>

			</div>

        <?php }

		

		$new_rowsVal = $giftcardsList->num_rows() + $sendgiftcardsList->num_rows();

		if($new_rowsVal == 0){

		 ?>

				<div class="giftcard">

			

			<span class="icon"><i class="ic-card"></i></span>

			<p>

				<?php if($this->lang->line('giftcard_not_receive') != '') { echo stripslashes($this->lang->line('giftcard_not_receive')); } else echo "You haven't received any gift cards yet"; ?>.

				<br>

				<a class="gift-card-sending"  href="gift-cards"><?php if($this->lang->line('giftcard_send') != '') { echo stripslashes($this->lang->line('giftcard_send')); } else echo "Send a Gift Card"; ?></a>

		</p>

			

		</div>

		<?php } ?>

	</div>



		

	</div>

	<!-- / container -->

</div>



 </div>

 </section>   
 </div>
<!-- Section_start -->



<?php 

$this->load->view('site/templates/footer');

?>

