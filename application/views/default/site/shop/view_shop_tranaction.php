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
		   <li><?php if($this->lang->line('shop_transaction') != '') { echo stripslashes($this->lang->line('shop_transaction')); } else echo "Shop transaction"; ?></li>
        </ul>
        </ul>

    			<div>

    				<a href="shops/<?php echo $this->uri->segment(2); ?>/shop-transaction"><?php if($this->lang->line('back_transaction_list') != '') { echo stripslashes($this->lang->line('back_transaction_list')); } else echo "Back to Transaction List."; ?></a><br /><br />

                </div>
			<div class="view-trans">
				<table class="tab_form_list_table">

                    <thead>

                        <tr class="table-header">

                            <th class="date-wid"><?php if($this->lang->line('transaction_img') != '') { echo stripslashes($this->lang->line('transaction_img')); } else echo "Image"; ?></th>

                            <th class="list-heading"><?php if($this->lang->line('discussion_product_name') != '') { echo stripslashes($this->lang->line('discussion_product_name')); } else echo "Product Name"; ?><span class="sort-arrow"></span></th>   

                            <th class="price-wid"><span><?php if($this->lang->line('list_price') != '') { echo stripslashes($this->lang->line('list_price')); } else echo "Price"; ?></span></th>     

                            <th class="list-wid"><span><?php if($this->lang->line('shop_quantity') != '') { echo stripslashes($this->lang->line('shop_quantity')); } else echo "Quantity"; ?></span></th>    

                            <th class="date-wid"><?php if($this->lang->line('shop_listed') != '') { echo stripslashes($this->lang->line('shop_listed')); } else echo "Listed"; ?><span class="sort-arrow"></span></th>

                           	<th class="date-wid"><?php if($this->lang->line('user_status') != '') { echo stripslashes($this->lang->line('user_status')); } else echo "Status"; ?><span class="sort-arrow"></span></th>

                            <th class="date-wid"><?php if($this->lang->line('transaction_action') != '') { echo stripslashes($this->lang->line('transaction_action')); } else echo "Action"; ?><span class="sort-arrow"></span></th>

                           <!--<th class="listgap"></th>-->

                        </tr>

                    </thead>

                    <tbody>

                    	<?php foreach($productList->result() as $product){ ?>

                        <?php $imgArr=explode(',',$product->image); ?>

                        <tr class="row-1 odd">

                            <td class="">

                                <div class="">

                                    <a class="list-image12" title="<?php echo $product->product_name; ?>" href="products/<?php echo $product->seourl; ?>">

                                        <img class="" width="75" height="75" alt="<?php echo $product->product_name; ?>" src="images/product/list-image/<?php echo $imgArr[0]; ?>">

                                    </a>

                                </div>

                            </td>        

                            <td class=""><?php echo $product->product_name; ?></td>        

                            <td class="" align="center">

                                <span class="dolar-symbol"><?php echo $currencySymbol;?></span>

                                <span class="dolar-value"><?php if($product->price != 0.00) { echo number_format($currencyValue*$product->price,2); } else { echo number_format($currencyValue*$product->pricing,2); echo '+'; } ?></span>

                                <span class="dolar-code"><?php echo $currencyType;?></span>

                            </td>

                            <td class="" align="center"><?php echo $product->quantity; ?></td>

                            <td class="" align="center"><?php echo substr($product->created,0,10); ?></td>

                            <td class="" align="center"><?php echo $product->status; ?></td>

                            <td class="" align="center">

                                <ul>

                                   <li style="text-align:center !important;"><a title="View" href="products/<?php echo $product->seourl; ?>"><?php if($this->lang->line('transaction_view') != '') { echo stripslashes($this->lang->line('transaction_view')); } else echo "View"; ?></a></li>

                                </ul>

                            </td>

                        </tr>

                        <?php } ?>

                    </tbody>

                 </table>
			</div>
	</div>
	
	</section>


<?php $this->load->view('site/templates/footer'); ?>