<?php 
$this->load->view('site/templates/header.php');
?>
<link rel="stylesheet" media="all" type="text/css" href="css/default/site/<?php echo SITE_COMMON_DEFINE ?>developer.css">
<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
<div id="profile_div">
<section>    
  	<div class="main">
    <div class="payment_sucess community_right">
        <div class="container" style="margin:0">
        
         <div class="cart_items">
        
         <h2><?php if($this->lang->line('cart_ord_confirm') != '') { echo stripslashes($this->lang->line('cart_ord_confirm')); } else echo "Order Confirmation"; ?></h2>
        
        <div class="clear"></div>
        
            <div class="cart-list chept2">
					
					
			<?php  if($Confirmation=="Cod")
				{
				?>                    
					<div class="cart-payment-wrap card-payment new-card-payment">
						<strong><?php if($this->lang->line('cod_success') != '') { echo stripslashes($this->lang->line('cod_success')); } else echo "Your purchased product(s) will be deliver in short"; ?></strong>
                        <div class="payment_success"><img src="images/site/cod_success.jpg" /></div>
					</div>
                    
            <?php
			 #$this->output->set_header('refresh:5;url='.base_url().'purchase-review'); 
			 }
			else if($Confirmation=="wiretransfer")
				{
				?>                    
					<div class="cart-payment-wrap card-payment new-card-payment">
						<strong><?php if($this->lang->line('wiretransfer_success') != '') { echo stripslashes($this->lang->line('wiretransfer_success')); } else echo " You placed the order successfully"; ?></strong>
                        <div class="payment_success"><img src="images/wire_transfer.jpg" /></div>
					</div>
                    
            <?php
			 #$this->output->set_header('refresh:5;url='.base_url().'purchase-review'); 
			 }
			 else if($Confirmation=="westernunion")
				{
				?>                    
					<div class="cart-payment-wrap card-payment new-card-payment">
						<strong><?php if($this->lang->line('western_union _success') != '') { echo stripslashes($this->lang->line('western_union__success')); } else echo " You placed the order successfully"; ?></strong>
                        <div class="payment_success"><img src="images/western_union.jpg" /></div>
					</div>
                    
            <?php
			 #$this->output->set_header('refresh:5;url='.base_url().'purchase-review'); 
			 }
			 
			else  if($Confirmation =='Success'){ ?>                    
					<div class="cart-payment-wrap card-payment new-card-payment">
						<strong><?php if($this->lang->line('order_tran_sucss') != '') { echo stripslashes($this->lang->line('order_tran_sucss')); } else echo "Your Transaction Success"; ?></strong>
                        <div class="payment_success"><img src="images/site/success_payment.png" /></div>
					</div>
                    
            <?php
			 #$this->output->set_header('refresh:5;url='.base_url().'purchase-review'); 
			 }elseif($Confirmation =='Failure'){ ?>        
            
            					<div class="cart-payment-wrap card-payment new-card-payment">
				<strong><?php if($this->lang->line('order_tran_failure') != '') { echo stripslashes($this->lang->line('order_tran_failure')); } else echo "Your Transaction Failure"; ?></strong>
                <div class="payment_success"><b><?php echo urldecode($errors); ?></b></div>
                        <div class="payment_success"><img src="images/site/failure_payment.png" /></div>
					</div>

            
            <?php
			if($productPage!=''){
			 $this->output->set_header('refresh:5;url='.base_url().'shop/billing'); 
			}else{
			 $this->output->set_header('refresh:5;url='.base_url().'cart'); 	
			}
			 } 
			 
			 if($this->uri->segment(3) == 'subscribe'){
			 	$this->output->set_header('refresh:5;url='.base_url().'fancyybox/manage'); 
			 }elseif($this->uri->segment(3) == 'gift'){
			 	$this->output->set_header('refresh:5;url='.base_url().'settings/giftcards'); 
			 }elseif($this->uri->segment(3) == 'cart'){
			    if($this->uri->segment(2) == 'cod'){
				$this->output->set_header('refresh:5;url='.base_url().'purchases/cod'); 
				}
				elseif($this->uri->segment(2) == 'wiretransfer'){
			 	$this->output->set_header('refresh:5;url='.base_url().'purchases/wiretransfer'); 
				}elseif($this->uri->segment(2) == 'westernunion'){
			    $this->output->set_header('refresh:5;url='.base_url().'purchases/westernunion'); 
				}else{
				  $this->output->set_header('refresh:5;url='.base_url().'purchase-review'); 
			    }
			}elseif($this->uri->segment(3) == 'product'){
			 	$this->output->set_header('refresh:5;url='.base_url().'shop/sell');
			 }
			  ?>
            



				</div>
	  </div>
	  <!-- / content -->
	</div>
    
    </div>
     </div>
     </div>
     </div>   
	
	
 
<script type="text/javascript" src="js/site/jquery.validate.js"></script>

<?php $this->load->view('site/templates/footer'); ?>



<!--<script>
	$("#shippingAddForm").validate();
	
	jQuery(function($) {
		var $select = $('.gift-recommend select.select-round');
		$select.selectBox();
		$select.each(function(){
			var $this = $(this);
			if($this.css('display') != 'none') $this.css('visibility', 'visible');
		});
	});
</script>
<script>
    //emulate behavior of html5 textarea maxlength attribute.
    jQuery(function($) {
        $(document).ready(function() {
            var check_maxlength = function(e) {
                var max = parseInt($(this).attr('maxlength'));
                var len = $(this).val().length;
                if (len > max) {
                    $(this).val($(this).val().substr(0, max));
                }
                if (len >= max) {
                    return false;
                }
            }
            $('textarea[maxlength]').keypress(check_maxlength).change(check_maxlength);
            
            
        });
    });
</script>-->
