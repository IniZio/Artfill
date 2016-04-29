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
		   <li><?php if($this->lang->line('Shop_billing') != '') { echo stripslashes($this->lang->line('Shop_billing')); } else echo 'Shop billing'; ?></li>
        </ul>
               
			   <?php if ($tax_list->num_rows() > 0){ ?>
				<!--<div>
    				<a href="shops/<?php echo $this->uri->segment(2); ?>/add-tax">Add a Location</a><br /><br />
                </div>-->
                <form class="tab_form_list">
                     <table class="tab_form_list_table" align="center" width="100">
                        <thead>     
                            <tr class="table-header">
                                <th><span><?php if($this->lang->line('shop_countryname') != '') { echo stripslashes($this->lang->line('shop_countryname')); } else echo 'Country Name'; ?></span></th>
                                <th><span><?php if($this->lang->line('shop_tax_state_name') != '') { echo stripslashes($this->lang->line('shop_tax_state_name')); } else echo 'State Name'; ?></span></th>        
                                <th><span><?php if($this->lang->line('shop_tax_amount') != '') { echo stripslashes($this->lang->line('shop_tax_amount')); } else echo 'Tax Amount'; ?> (%)</span></th>        
                                <th><span><?php if($this->lang->line('user_status') != '') { echo stripslashes($this->lang->line('user_status')); } else echo 'Status'; ?></span></th>        
                                <th><span><?php if($this->lang->line('disp_usr_cont_action') != '') { echo stripslashes($this->lang->line('disp_usr_cont_action')); } else echo 'Action'; ?></span></th> 
                            </tr>
                        </thead>
                        <tbody align="center">          
                        <?php foreach ($tax_list->result() as $tax){ ?>          
                            <tr>                            
                                <td><?php echo $tax->country_name;?></td>        
                                <td><?php echo $tax->state_name;?></td>        
                                <td><?php echo $tax->tax_amount;?></td>
								<td><?php echo $tax->status;?></td>
                                <td><a href="shops/<?php echo $this->uri->segment(2,0); ?>/edit-tax/<?php echo $tax->id;?>" title="Edit"><?php if($this->lang->line('dis_coupon_edit') != '') { echo stripslashes($this->lang->line('dis_coupon_edit')); } else echo 'Edit'; ?></a></td>
								
                            </tr>
                        <?php } ?>
                        </tbody>
                     </table>     
                 </form>
        		<?php }else{ ?>
                <div class=" warning-error">
                    <h3>
                        <span style="margin:0 0 0 3px; color:#000; font-weight:bold">
						<?php if($this->lang->line('shop_tax_amt_yet') != '') { echo stripslashes($this->lang->line('shop_tax_amt_yet')); } else echo 'No Tax amount set in your Shop yet'; ?>.</span>
						<a href="shops/<?php echo $this->uri->segment(2); ?>/add-tax">
                        	<span><?php if($this->lang->line('shop_tax_add') != '') { echo stripslashes($this->lang->line('shop_tax_add')); } else echo 'Add Tax'; ?></span>                  
                        </a>
                    </h3>
                </div>
                <?php } ?>
    </div>
</section>
</div>
<?php $this->load->view('site/templates/footer'); ?>