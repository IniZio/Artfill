<?php

$this->load->view('site/templates/shop_header',$this->data);

?>

<link rel="stylesheet" media="all" type="text/css" href="css/default/site/<?php echo SITE_COMMON_DEFINE ?>setting.css">

<style>

.note_con{

	float: left;

	width: 90%;

	padding: 5%;

	background-color: #F2F7F8;

	border-radius: 10px;

	box-shadow: 0 0 2px #ccc;

	margin-bottom: 10px;

	color: rgb(98, 102, 0);

}

.note_con p{

	padding-bottom: 3px;

	padding-left: 10px;

}

</style>

<div class="clear"></div>


	  <section class="container">

    	<div class="main">  	

        <div  class="shop_details">

        <div id="content">

		<h2 class="ptit">Upload CSV</h2>

	

	<div class=" shipping">

            <h3>Please choose your CSV file</h3>

            <form name="csvdata" method="post" action="site/product/upload_the_file" id="csvdata" enctype="multipart/form-data">

                	<div class="chart-wrap">                   

            			<input type='file' name="upload_csv" id="upload_csv"/>

                 		<div id="upload_csv_warn"  style="float:left; color:#FF0000;"></div>     

					</div>

                    <label>Note: The first row of CSV file must be in the following format.</label> 

                    <a href="<?php echo base_url();?>shopsycsv-products.csv">Click here</a> to download sample file<br /><br />

						<div class="note_con">

                    	<p style="padding:left:0;padding-bottom:10px;font-weight:bold;">Total 12 Columns</p>

                    	<p>Column1 : type</p>

                    	<p>Column2 : product_condition</p>

                    	<p>Column3 : when_did_you_make_it</p>

                    	<p>Column4 : category</p>

                    	<p>Column5 : name</p>

                    	<p>Column6 : description</p>

                    	<p>Column7 : image</p>

                    	<p>Column8 : price</p>

                    	<p>Column9 : quantity</p>

                    	<p>Column10 : country</p>

                    	<p>Column11 : ship_cost</p>

                    	<p>Column12 : ship_cost_with_other</p>

                        <br>

                        <p><strong>Note:</strong> type is like (handmade,vintage,craft supply),  product_condition is like (finished,unfinished) </p>

						</div>

						<input type="submit" value="Upload" class="btn-shipping">

						</form>

					</div>

	

				</div>

			</div>

		</div>
	
	</section>

</div>

<!-- Section_start -->

<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>address_helper.js"></script>

<script type="text/javascript" src="js/site/jquery.validate.js"></script>

<script>

	$("#shippingEditForm").validate();

	$("#shippingAddForm").validate({});



	jQuery(function($) {

		var $select = $('.gift-recommend select.select-round');

		$select.selectBox();

		$select.each(function(){

			var $this = $(this);

			if($this.css('display') != 'none') $this.css('visibility', 'visible');

		});

	});

</script>

<script type="text/javascript">

$(function() {

			$("#csvdata").submit(function(){

				

				 $("#upload_csv_warn").html('');

				 

				if(jQuery.trim($("#upload_csv").val()) == ''){

						

						$("#upload_csv_warn").html('Please choose a file before you upload');

						$("#upload_csv").focus();

						return false;

						

					}

					else

					{	

					      	$("#csvdata").submit();

					}

					

					return false;	

				});

		});

<?php 

$this->load->view('site/templates/footer',$this->data);

?>

