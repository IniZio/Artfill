<?php 
$this->load->view('site/templates/shop_header'); 

?>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<?php } ?>
<div class="clear"></div>
<div id="shop_page_seller">

<section class="container">

    <div class="main" >    	


		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
		   <span>&rsaquo;</span>
		   <li><?php if($this->lang->line('shop_transaction') != '') { echo stripslashes($this->lang->line('shop_transaction')); } else echo 'Shop transaction'; ?></li>
        </li>
        </ul>	
<div class="clear"></div>
                <?php

					if (count($shop_trans_details) > 0){						

				?>

                <form class="tab_form_list">

                     <table class="tab_form_list_table" align="center" width="100">

                        <thead>     

                            <tr class="table-header">

                                <th><span><?php if($this->lang->line('transaction_mode') != '') { echo stripslashes($this->lang->line('transaction_mode')); } else echo 'Tranaction Mode'; ?></span></th>

                                <th><span><?php if($this->lang->line('transaction_date') != '') { echo stripslashes($this->lang->line('transaction_date')); } else echo 'Tranaction Date'; ?></span></th>        

                                <th><span><?php if($this->lang->line('transaction_amt') != '') { echo stripslashes($this->lang->line('transaction_amt')); } else echo 'Tranaction Amount'; ?></span></th>        

                                <th><span><?php if($this->lang->line('transaction_num_product') != '') { echo stripslashes($this->lang->line('transaction_num_product')); } else echo 'Number of Products'; ?></span></th>        

                                <th><span><?php if($this->lang->line('transaction_action') != '') { echo stripslashes($this->lang->line('transaction_action')); } else echo 'Action'; ?></span></th> 
                            </tr>

                        </thead>

                        <tbody align="center">          

                        <?php foreach ($shop_trans_details as $details){ ?>          

                            <tr>                            

                                <td><?php echo $details['pay_type'];?></td>        

                                <td><?php echo $details['pay_date'];?></td>        

                                <td><?php echo $currencySymbol.' '.number_format($currencyValue*$details['pay_amount'],2);?></td>

                                <td><?php echo $details['totPrd'];?></td>

                                <td><a href="shops/<?php echo $this->uri->segment(2,0); ?>/view-transaction/<?php echo strtotime($details['pay_date']);?>" title="View"><?php if($this->lang->line('transaction_view') != '') { echo stripslashes($this->lang->line('transaction_view')); } else echo 'View'; ?></a></td>

                            </tr>

                        <?php } ?>

                        </tbody>

                     </table>     

                 </form>

        		<?php }else{ ?>

                <div class=" warning-error">

                    <h3>

                        <span style="margin:0 0 0 3px; color:#000; font-weight:bold"><?php if($this->lang->line('no_shop_transaction') != '') { echo stripslashes($this->lang->line('no_shop_transaction')); } else echo 'No Transaction in your Shop yet.'; ?></span>

                    </h3>

                </div>

                <?php } ?>

    </div>
</section>	
</div>


<?php $this->load->view('site/templates/footer'); ?>