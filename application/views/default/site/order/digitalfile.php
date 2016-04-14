<?php $this->load->view('site/templates/header.php');

$this->load->model('order_model');

?>

<?php #echo "<pre>"; print_r($ViewList); die; ?>

<section class="container">

<div style="background:none repeat scroll 0 0 #FFFFFF;border-bottom:1px solid #DDDDDD;border-top:1px solid #DDDDDD;padding: 20px 0;" class="add_shop">

  <div class="main">

  	<?php if($orderInfo->row()->digital_files!=''){ ?>

  	<center><span class="error">Note: This link will be available only once. </span></center>

    <table class="tab_form_list_table" style="padding:none;">

      <thead>

        <tr class="table-header">

          <th class="date-wid" style="width:80px;"><?php if($this->lang->line('discussion_bag_items') != '') { echo stripslashes($this->lang->line('discussion_bag_items')); } else echo 'Bag Items'; ?></th>

          <th align="center">Files to Download<span class="sort-arrow"></span></th>          

        </tr>

      </thead>

      <tbody style="background:#F2F2F2;">

        <?php foreach($orderInfo->result() as $product){ ?>

        	<?php if($product->digital_files!=''){ ?>

			<?php $imgArr=explode(',',$product->image); ?>

            <tr class="row-1 odd">

              <td class="colsli" style="padding:0px !important; text-align:center;">

                  <div class="colsli"> 

                      <a href="products/<?php echo $product->prdurl; ?>" class="list-image12" title="<?php echo $product->product_name; ?>" style="float:none;border:none;"> 

                        <img class="" width="75" height="75" alt="<?php echo $imgArr[0]; ?>" src="images/product/list-image/<?php echo $imgArr[0]; ?>"> 

                      </a> 

                  </div>

              </td>

              <td class="colsli">

			  <?php $digiFiles=@explode(',',$product->digital_files); ?>

              <?php foreach($digiFiles as $fileList){ ?>

              	<a href="download-file/<?php echo $fileList.'/'.$product->dealCodeNumber.'/'.$product->user_id; ?>" class="download"><?php echo $fileList; ?></a><br />

              <?php } ?>

              </td>          

            </tr>

            <?php } ?>

        <?php } ?>

      </tbody>

    </table>  

    <?php }else{ ?>

    

    <?php 		

		redirect('link-expire');

	} 

	?>

  </div>

</div>

</section>
<script type="application/javascript">

$(document).ready(function(e) {

   $(".download").click(function () {

	   $(this).remove();

    });

});

</script>

<?php $this->load->view('site/templates/footer'); ?>

