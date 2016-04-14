<?php 

$this->load->view('site/templates/shop_header'); 

?>

<div class="clear"></div>
<section class="container">

    <div class="main">  
	
	<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
		   <span>&rsaquo;</span>
		   <li>Shop contacts</li>
        </ul>
    			<div>

    				<a href="shops/<?php echo $this->uri->segment(2); ?>/contact-user">Back</a><br /><br />

                </div>   			

                <?php if ($contactUserInfo->num_rows() > 0){ ?>                               

                <form class="tab_form_list">

                	<?php foreach ($contactUserInfo->result() as $row){ ?>

                     <table class="tab_form_list_table" align="center" width="100">

                        <thead>     

                            <tr class="table-header">

                                <th><span>Sender Name :</span> <?php echo $row->username;?></th>

                                <th><span>Email :</span> <?php echo $row->useremail;?></th>                                

                                <th><span><a href="#shop_contacts_popup" class="contact-popup"  data-toggle="modal">Replay</a></span></th>

                            </tr>

                        </thead>

                        <tbody align="center">

                            <tr>                            

                                <td colspan="3" align="left"><strong><?php echo $row->product_name;?></strong></td>

                            </tr>

                            <tr>

                                <td colspan="3" align="left"><?php echo $row->description;?></td>

                            </tr>

                        </tbody>

                        <tfoot>     

                            <tr class="table-header">

                                <th><span>Sender Name :</span> <?php echo $row->username;?></th>

                                <th><span>Email :</span> <?php echo $row->useremail;?></th>                                

                                <th><span><a href="#shop_contacts_popup" class="contact-popup"  data-toggle="modal">Replay</a></span></th>

                            </tr>

                        </tfoot>

                     </table>  

                     <?php } ?>   

                 </form>

        		<?php }else{ ?>

                <div class=" warning-error">

                    <h3>

                        <span style="margin:0 0 0 3px; color:#000; font-weight:bold">No Message Found.</span>                        

                    </h3>

                </div>

                <?php } ?>

    </div>
	
	</section>


	<div id='shop_contacts_popup' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div  style='background:#fff;'>  

					<div class="conversation">

							<div style="padding:20px; " class="conversation_container">

								<h2 class="conversation_headline">Replay to : <?php echo $row->username;?></h2>

								<div class="conversation_right">

									<form name="contactpeople" id="contactpeople" method="post" action="site/user/contactpeople" onsubmit="return contactsCheck();">

										<input class="conversation-subject" type="text" name="subject" id="subject" placeholder="Subject" value="Re:<?php echo $row->product_name;?>" >

										<textarea class="conversation-textarea" rows="11" name="message_text" id="message_text" placeholder="<?php if($this->lang->line('user_msgtxt') != '') { echo stripslashes($this->lang->line('user_msgtxt')); } else echo 'Message text'; ?>"></textarea>

										<input type="hidden" name="sender_email" id="sender_email" value="<?php echo $this->session->userdata['shopsy_session_user_email']; ?>" >

										<input type="hidden" name="sender_id" id="sender_id" value="<?php echo $this->session->userdata['shopsy_session_user_id']; ?>" >

										<input type="hidden" name="receiver_email" id="receiver_email" value="<?php echo $row->useremail;?>" >

										<input type="hidden" name="receiver_id" id="receiver_id" value="<?php echo $row->user_id;?>" >

										<input type="hidden" name="current_user" value="<?php echo $this->session->userdata['shopsy_session_user_name']; ?>" >

										<input type="hidden" name="FromURL" value="ContactUser" >
										<span class="error" id="ErrPUP"></span>

											

								</div> 
								
								<div class="modal-footer footer_tab_footer">
									<div class="btn-group">
										<input class="submit_btn" type="submit" value="send" />
										<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel">Cancel</a>
									</div>
								</div>	

							</div>
						</form>
					</div>

				</div>
			</div>
		</div>		
	</div>


<style>



#cboxLoadedContent{background:none;}





#cboxClose {  right: 15px;

    text-indent: -9999px;

    top: 11px;}

</style>

<?php $this->load->view('site/templates/footer'); ?>