<?php  

$this->load->view('site/templates/header'); 

?>

<section class="browse-head">


<div id="sell-on-header">

  <h1><?php if($this->lang->line('shop_passion') != '') { echo stripslashes($this->lang->line('shop_passion')); } else echo 'Turn Your Passion Into a Business'; ?></h1>

  <p class="create-shop-wrap "><a href="login?action=shop/sell" class="shopsy_shop"><?php echo af_lg('lg_open_an','Open an');?> <?php echo ucfirst($this->config->item('email_title')); ?> <?php if($this->lang->line('user_list_shop') != '') { echo stripslashes($this->lang->line('user_list_shop')); } else echo 'Shop'; ?></a></p>

</div>

<!--
  <div class="container">
  
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
		   <li><?php echo af_lg('lg_open_new_shop','Open new shop');?></li>
        </ul>
  

     <?php echo stripslashes($this->config->item('shop_index_page')); ?>
	</div>-->

</section>
  
<?php $this->load->view('site/templates/footer');?>