<?php 

$this->load->view('site/templates/shop_header'); 

#

?>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<?php } ?>
<div class="clear"></div>
<div id="shop_page_seller">

<section class="container">

    <div class="main">    			

                <?php

					if ($commision_log->num_rows()> 0){						

				?>

                <form class="tab_form_list">

                     <table class="tab_form_list_table" align="center" width="100">

                        <thead>     

                            <tr class="table-header">

                            	<th>#</th>

                                <th><span><?php if($this->lang->line('transaction_date') != '') { echo stripslashes($this->lang->line('transaction_date')); } else echo 'Tranaction Date'; ?></span></th>        

                                <th><span><?php if($this->lang->line('transaction_method') != '') { echo stripslashes($this->lang->line('transaction_method')); } else echo 'Tranaction Method'; ?></span></th>        

                                <th><span><?php if($this->lang->line('user_amount') != '') { echo stripslashes($this->lang->line('user_amount')); } else echo 'Amount'; ?></span></th>  
                            </tr>

                        </thead>

                        <tbody align="center">          

                        <?php $i=0; foreach ($commision_log->result() as $row){ $i++; ?>          

                            <tr>      

                            	<td><?php echo $i; ?></td>                          

                                <td><?php echo $row->created;?></td>        

                                <td><?php echo $row->payment_type;?></td>

                                <td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$row->amount,2);?></td>

                            </tr>

                        <?php } ?>

                        </tbody>

                     </table>     

                 </form>

        		<?php }else{ ?>
				<div class="clear"></div>
                <div class=" warning-error community_right">

                    <h3>

                        <span style="margin:0 0 0 3px; color:#000; font-weight:bold"><?php if($this->lang->line('no_records') != '') { echo stripslashes($this->lang->line('no_records')); } else echo 'No Records Available.'; ?></span>

                    </h3>

                </div>

                <?php } ?>

    </div>
	
</section>
</div>

<?php $this->load->view('site/templates/footer'); ?>