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
		   <li><?php if($this->lang->line('shop_contacts') != '') { echo stripslashes($this->lang->line('shop_contacts')); } else echo "Shop contacts"; ?></li>
        </ul>

                <?php if ($contactUserList->num_rows() > 0){ ?>                

                <form class="tab_form_list">

                     <table class="tab_form_list_table" align="center" width="100">

                        <thead>     

                            <tr class="table-header">

                                <th width="15%"><span class="a_links"> <?php if($this->lang->line('disp_usr_cont_usrname') != '') { echo stripslashes($this->lang->line('disp_usr_cont_usrname')); } else echo "UserName"; ?></span></th>

                                <th width="20%"><span class="a_links"><?php if($this->lang->line('disp_usr_cont_email') != '') { echo stripslashes($this->lang->line('disp_usr_cont_email')); } else echo "Email"; ?></span></th>        

                                <th width="15%"><span class="a_links"><?php if($this->lang->line('disp_usr_cont_prd_name') != '') { echo stripslashes($this->lang->line('disp_usr_cont_prd_name')); } else echo "Product Name"; ?></span></th> 

                                <th width="25%"><span class="a_links"><?php if($this->lang->line('disp_usr_cont_msg') != '') { echo stripslashes($this->lang->line('disp_usr_cont_msg')); } else echo "Message"; ?></span></th>       

                                <th width="15%"><span class="a_links"><?php if($this->lang->line('disp_usr_cont_date') != '') { echo stripslashes($this->lang->line('disp_usr_cont_date')); } else echo "Date"; ?></span></th> 

                                <th width="10%"><span class="a_links"><?php if($this->lang->line('disp_usr_cont_action') != '') { echo stripslashes($this->lang->line('disp_usr_cont_action')); } else echo "Action"; ?></span></th>

                            </tr>

                        </thead>

                        <tbody align="center">                    

                        <?php foreach ($contactUserList->result() as $row){ ?>

                            <tr id="contactuser-<?php echo $row->id;?>" >                            

                                <td><?php echo $row->username;?></td>        

                                <td><?php echo $row->useremail;?></td>        

                                <td><?php echo $row->product_name;?></td>

                                <td><a href="shops/<?php echo $this->uri->segment(2); ?>/view-contact-user/<?php echo $row->id;?>"><?php echo $row->description; ?></a></td>

                                <td><?php echo $row->dateAdded;?></td>

                                <td>

                                	<a href="javascript:void(0);" onclick="contactUser('<?php echo $row->id;?>');" class="contact-popup" title="Replay"><?php if($this->lang->line('disp_usr_cont_replay') != '') { echo stripslashes($this->lang->line('disp_usr_cont_replay')); } else echo "Replay"; ?></a><br />

                                    <a href="shops/<?php echo $this->uri->segment(2); ?>/view-contact-user/<?php echo $row->id;?>" title="View"><?php if($this->lang->line('disp_usr_cont_view') != '') { echo stripslashes($this->lang->line('disp_usr_cont_view')); } else echo "View"; ?></a><br />

                                    <a href="shops/<?php echo $this->uri->segment(2); ?>/delete-contact-user/<?php echo $row->id;?>" title="Delete"><?php if($this->lang->line('disp_usr_cont_delete') != '') { echo stripslashes($this->lang->line('disp_usr_cont_delete')); } else echo "Delete"; ?></a>

                                </td>

                            </tr>

                        <?php } ?>

                        </tbody>

                     </table>     

                 </form>

        		<?php }else{ ?>
				<div class="clear"></div>
                <div class=" warning-error">

                    <h3>

                        <span style="margin:0 0 0 3px; color:#000; font-weight:bold"><?php if($this->lang->line('no_contact_shop') != '') { echo stripslashes($this->lang->line('no_contact_shop')); } else echo "No Contacts in your Shop yet."; ?></span>                        

                    </h3>

                </div>

                <?php } ?>

    </div>
	
	</section>


	<a href="#shop_contacts_popup" id="shop_contacts_link" data-toggle="modal"></a>

	<div id='shop_contacts_popup' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div id='shop_contacts' style='background:#fff;'>  

				  
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