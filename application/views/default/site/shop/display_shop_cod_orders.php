<?php 
$this->load->view('site/templates/shop_header'); 
?>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<?php } ?>
<div class="clear"></div>
<div id="shop_page_seller">
<section class="container">
    <div class="main">    			
                <?php
					if (count($orderList) > 0){						
				?>
                <form class="tab_form_list">
                     <table class="tab_form_list_table" align="center" width="100">
                        <thead>     
                            <tr class="table-header">
                            	<th>#</th>
                                 <th><span><?php if($this->lang->line('user_email') != '') { echo stripslashes($this->lang->line('user_email')); } else echo 'User Email'; ?></span></th>
                                <th><span><?php if($this->lang->line('payment_date') != '') { echo stripslashes($this->lang->line('payment_date')); } else echo 'Payment Date'; ?></span></th>        
                                <th><span><?php if($this->lang->line('transaction_id') != '') { echo stripslashes($this->lang->line('transaction_id')); } else echo 'Transaction ID'; ?></span></th>        
                                <th><span><?php if($this->lang->line('lg_shop_total') != '') { echo stripslashes($this->lang->line('lg_shop_total')); } else echo 'Total'; ?></span></th>  
                                <th><span><?php if($this->lang->line('payment_type') != '') { echo stripslashes($this->lang->line('payment_type')); } else echo 'Payment Type'; ?></span></th>  
                                <th><span><?php if($this->lang->line('payment_status') != '') { echo stripslashes($this->lang->line('payment_status')); } else echo 'Payment Status'; ?></span></th>     
                                <th><span><?php if($this->lang->line('lg_action') != '') { echo stripslashes($this->lang->line('lg_action')); } else echo 'Action'; ?></span></th> 
                            </tr>
                        </thead>
                        <tbody align="center">          
                        <?php $i=0; foreach ($orderList->result() as $row){ $i++; ?>          
                            <tr>      
                            	<td><?php echo $i; ?></td>                      
                                <td><?php echo $row->email;?></td>        
                                <td><?php echo $row->created;?></td>        
                                <td><?php echo $row->dealCodeNumber;?></td>
                                <td><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$row->total,2);?></td>
                                <td><?php echo $row->payment_type;?></td>
                                <td>
                                <select id="<?php echo $row->id; ?>" class="changePaymentStatusOrder" data-val-id="<?php echo $row->dealCodeNumber;?>">
                                <option <?php if($row->status=="Paid"){ echo 'selected="selected"'; } ?>><?php if($this->lang->line('paid') != '') { echo stripslashes($this->lang->line('paid')); } else echo 'Paid'; ?></option>
                                <option <?php if($row->status=="Pending"){ echo 'selected="selected"'; } ?>><?php if($this->lang->line('pending') != '') { echo stripslashes($this->lang->line('pending')); } else echo 'Pending'; ?></option>
                               </select>
								</td>
                                <td>
                                <a href="site/shop/vieworder/<?php echo $row->user_id; ?>/<?php echo $row->dealCodeNumber; ?>" target="_blank" title="View"><?php if($this->lang->line('shop_cod_view') != '') { echo stripslashes($this->lang->line('shop_cod_view')); } else echo 'View'; ?></a>
                                <br />
                                <a href="discussion/<?php echo $row->dealCodeNumber; ?>" title="View Discussion"><?php if($this->lang->line('shop_ord_view_discus') != '') { echo stripslashes($this->lang->line('shop_ord_view_discus')); } else echo 'View Discussion'; ?></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                     </table>     
                 </form>
        		<?php }else{ ?>
                <div class=" warning-error">
                    <h3>
                        <span style="margin:0 0 0 3px; color:#000; font-weight:bold"><?php if($this->lang->line('shop_ord_no_trans_yet') != '') { echo stripslashes($this->lang->line('shop_ord_no_trans_yet')); } else echo 'No Transaction in your Shop yet'; ?>.</span>
                    </h3>
                </div>
                <?php } ?>
    </div>
</section>
</div>
<?php $this->load->view('site/templates/footer'); ?>