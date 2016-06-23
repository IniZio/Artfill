<?php
$this->load->view('site/templates/commonheader');
$this->load->view('site/templates/shop_header',$this->data);
?>
<div class="clear"></div>
<section class="container">
	<div class="main">
		<div class="shop_details">   
			<span class="shop_title"><?php echo af_lg('lg_pls_choose_your_csv_file','Please choose your CSV file');?></span>
			<div class="payment_div"></div>	
				<div class="list_div" style="border-radius:5px 5px 0 0; margin:5px 0 0">
					<div class="payment_check">
						<div class="import-list">
							<form name="csvdata" method="post" action="site/product_import/import_from_etsy" id="csvdata" enctype="multipart/form-data">
								<div class="chart-wrap col-md-12">
								<div>
									<input type="button" onclick="document.getElementById('user_profile_img').click()" value="<?php if($this->lang->line('choose_file') != '') { echo stripslashes($this->lang->line('choose_file')); } else echo 'Choose File'; ?> ..." /><b id="no_file_selected"><?php if($this->lang->line('no_file_selected') != '') { echo stripslashes($this->lang->line('no_file_selected')); } else echo 'No File Selected'; ?> </b>
									<input type='file' name="etsy_upload" id="etsy_upload" class="col-md-4" /> &nbsp;&nbsp;&nbsp;
									 <label id="ErrImage" class="img-size"></label>
								</div>	
								
									<input type="submit" id="btn-etsy" value="<?php echo af_lg('lg_upload','Upload');?>" class="btn btn-primary">
								</div>
								<div class="col-md-1"></div>
								<div id="etsy_upload_warn" class="col-md-10" style="color:#FF0000;"></div>
							</form>
						</div>
					</div>	   
				</div> 
			</form>
		</div>
	</div>
</section>

<a data-toggle="modal" href="#load_import" data-keyboard="false" data-backdrop="static" aria-hidden="true" id="loadingPop"></a>
<div class="modal fade" id="load_import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-wrapper" id="popWrapper">
				<div class="text-center" id="popUpLoad">
					<img src="images/ajax-loader/ajax-loader-pop.gif" class="icon" width="50" />
					<h4><?php echo af_lg('lg_import_product_pls_wait','Importing Product, Please Wait...');?></h4>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
#etsy_upload {
    margin: 0 10px;
    padding: 7px;
}
#loadingPop {
    display:none;
}
</style>
<script type="text/javascript">
$(function() {
	$("#btn-etsy").click(function(){
		$("#etsy_upload_warn").html('');
		var c=0;
		if(jQuery.trim($("#etsy_upload").val()) == ''){
			$("#etsy_upload_warn").html(lg_pls_choose_file_before);
			$("#etsy_upload").focus();
			c++;
			return false;
		}else{
			if( document.getElementById("etsy_upload").value.toLowerCase().lastIndexOf(".csv")==-1) {
				$("#etsy_upload_warn").html(lg_pls_upload_file_withcsv_extension);
				c++;
				return false;
			}
		}
		if(c > 0){
			$("#btn-etsy").attr('disabled','disabled');
		}
		$("#loadingPop").trigger('click');
	});
});
</script>
<?php 
$this->load->view('site/templates/footer',$this->data);
?>