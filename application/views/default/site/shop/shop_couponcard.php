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
	
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
		   <span>&rsaquo;</span>
		    <li><?php if($this->lang->line('coupon_card') != '') { echo stripslashes($this->lang->line('coupon_card')); } else echo "Shop coupon cards"; ?></li>
        </ul>	
<div class="clear"></div>
                <?php if ($couponCardsList->num_rows() > 0){ ?>

                <div>

    				<a href="shops/<?php echo $this->uri->segment(2); ?>/add-coupon-code"><?php if($this->lang->line('create_coupon') != '') { echo stripslashes($this->lang->line('create_coupon')); } else echo 'Create New Coupon.'; ?></a><br /><br />

                </div>

                <form class="tab_form_list">

                     <table class="tab_form_list_table" align="center" width="100">

                        <thead>     

                            <tr class="table-header">

                                <th><span><?php if($this->lang->line('dis_coupon_code') != '') { echo stripslashes($this->lang->line('dis_coupon_code')); } else echo 'Code'; ?> </span></th>

                                <th><span><?php if($this->lang->line('dis_coupon_value') != '') { echo stripslashes($this->lang->line('dis_coupon_value')); } else echo 'Value'; ?></span></th>        

                                <th><span><?php if($this->lang->line('dis_coupon_remain') != '') { echo stripslashes($this->lang->line('dis_coupon_remain')); } else echo 'Remain'; ?></span></th>        

                                <th><span><?php if($this->lang->line('dis_coupon_purchased') != '') { echo stripslashes($this->lang->line('dis_coupon_purchased')); } else echo 'Purchased'; ?></span></th>        

                                <th><span><?php if($this->lang->line('dis_coupon_date_from') != '') { echo stripslashes($this->lang->line('dis_coupon_date_from')); } else echo 'Date From'; ?></span></th> 

                                <th><span><?php if($this->lang->line('dis_coupon_date_to') != '') { echo stripslashes($this->lang->line('dis_coupon_date_to')); } else echo 'Date To'; ?></span></th> 

                                <th><span><?php if($this->lang->line('dis_coupon_card_status') != '') { echo stripslashes($this->lang->line('dis_coupon_card_status')); } else echo 'Card Status'; ?></span></th>   

                                <th><span><?php if($this->lang->line('dis_coupon_action') != '') { echo stripslashes($this->lang->line('dis_coupon_action')); } else echo 'Action'; ?></span></th>

                            </tr>

                        </thead>

                        <tbody align="center">                    

                        <?php foreach ($couponCardsList->result() as $row){ ?>

                            <tr id="couponcard-<?php echo $row->id;?>" >                            

                                <td><?php echo $row->code;?></td>        

                                <td><?php echo round($row->price_value,2);?> %</td>        

                                <td><?php echo ($row->quantity - $row->purchase_count);?></td>

                                <td><?php echo $row->purchase_count;?></td>

                                <td><?php echo $row->datefrom;?></td>

                                <td><?php echo $row->dateto;?></td>

                                <td><?php if(strtotime($row->dateto) < strtotime(date('Y-m-d'))){ echo 'Expired'; }else{ 

												if($row->purchase_count > 0){ echo 'Redeemed'; }else{ echo 'Not Used'; }}?></td>

                                <td><a href="shops/<?php echo $this->uri->segment(2); ?>/edit-coupon-code/<?php echo $row->id;?>">Edit</a></td>

                            </tr>

                        <?php } ?>

                        </tbody>

                     </table>     

                 </form>

        		<?php }else{ ?>

                <div class=" warning-error">

                    <h3>

                        <span style="margin:0 0 0 3px; color:#000; font-weight:bold"><?php if($this->lang->line('no_coupon') != '') { echo stripslashes($this->lang->line('no_coupon')); } else echo 'No Coupon Code in your Shop yet.'; ?></span>

                        <a href="shops/<?php echo $this->uri->segment(2); ?>/add-coupon-code">

                        	<span><?php if($this->lang->line('create_coupon') != '') { echo stripslashes($this->lang->line('create_coupon')); } else echo 'Create New Coupon.'; ?></span>                  

                        </a>

                    </h3>

                </div>

                <?php } ?>

    </div>
	
	</section>

</div>
<?php $this->load->view('site/templates/footer'); ?>