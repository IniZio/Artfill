<?php 
$this->load->view('site/templates/shop_header'); 
$shopEditArr = array('admin-edit-product','admin-preview'); $shopAddArr = array('admin-listitem','admin-preview');
$showShopHeadList = 0; if(in_array($this->uri->segment(1),$shopEditArr)){
		  		$showShopHeadList = 1;
		   }elseif(in_array($this->uri->segment(2),$shopAddArr)){ 
	           $showShopHeadList = 1;
        }
#echo date("Y-m-d");die;		?>
<?php // Kethen here, adding Chinese footstop 26/1/2016 ?>
<?php $footstop = $this->_ci_cached_vars["languageCode"] == "zh_HK" ? "。" : "." ?>

<div class="add_shop" id="shop_page_seller">
<div class="main">
<div id="tabs">

    <?php  if($showShopHeadList == 0){  if(count($shopDetail)>0) { ?>
    <div id="tabs-2">    
            <div class="manage-listing-heading">
                <h1><?php if($this->lang->line('shop_yourlistings') != '') { echo stripslashes($this->lang->line('shop_yourlistings')); } else echo 'Your Listings'; ?><span>(<?php echo count($shopDetail); ?>)</span> </h1>
                <p><?php if($this->lang->line('shop_stockup') != '') { echo stripslashes($this->lang->line('shop_stockup')); } else echo 'Stock up! Listing 10 or more items gives buyers more opportunities to find your shop'; ?><?php echo $footstop ?> </p>
            </div>
             <form class="tab_form_list" action="site/product/DeleteShopProducts" method="post">
				<div class="manage-table">
                 <table class="tab_form_list_table">
                    <thead>
                      <tr class="look">
                            <td colspan="7">
                            <span class="shuffle">
                            <input class="find-all" onchange="select_multiple(this);" type="checkbox" value="on" name="find_all[]">
							<!--<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">-->
                            <button class="secondary-button-delete" value="<?php if($this->lang->line('com_delete') != '') { echo stripslashes($this->lang->line('com_delete')); } else echo 'Delete'; ?>" name="action" type="submit" onClick="return confirmDeletePrd();"><?php if($this->lang->line('com_delete') != '') { echo stripslashes($this->lang->line('com_delete')); } else echo 'Delete'; ?></button>
                            </span>
                            </td>
                        </tr>   
                        <tr class="table-header">
                            <th class="list-display"></th>
                            <th class="list-heading"><?php if($this->lang->line('user_title') != '') { echo stripslashes($this->lang->line('user_title')); } else echo 'Title'; ?><span class="sort-arrow"></span></th>        
                            <th class="list-wid"><span><?php if($this->lang->line('shop_instock') != '') { echo stripslashes($this->lang->line('shop_instock')); } else echo 'In Stock'; ?></span></th>        
                            <th class="price-wid"><span><?php if($this->lang->line('giftcard_price') != '') { echo stripslashes($this->lang->line('giftcard_price')); } else echo 'Price'; ?></span></th>        
                            <th class="date-wid"><?php if($this->lang->line('shop_listed') != '') { echo stripslashes($this->lang->line('shop_listed')); } else echo 'Listed'; ?><span class="sort-arrow"></span></th>
                            
                           
                           <th class="date-wid"><?php if($this->lang->line('shop_status') != '') { echo stripslashes($this->lang->line('shop_status')); } else echo 'Status'; ?><span class="sort-arrow"></span></th>
                            
                           <th class="listgap"><?php if($this->lang->line('shop_action_manage') != '') { echo stripslashes($this->lang->line('shop_action_manage')); } else echo 'Action'; ?></th>
                               
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php for($i=0;$i<count($shopDetail);$i++) {  ?>
                    <?php $imgArr=explode(',',$shopDetail[$i]->image); ?>
                        <tr id="listing-<?php echo $shopDetail[$i]->id; ?>" class="row-1 odd">
                            <td class=""><input class="chkProd" type="checkbox" value="<?php echo $shopDetail[$i]->id; ?>" name="deleteProducts[]"></td>
                            <td class="">
                                <div class="">
                                    <a class="list-image12" title="<?php echo $shopDetail[$i]->product_name; ?>" href="<?php echo base_url().'products/'.$shopDetail[$i]->seourl; ?>">
                                        <img class="" width="50" height="50" alt="." src="images/product/list-image/<?php echo $imgArr[0]; ?>">
                                    </a>
                                    <span class="center-text">
                                        <div>
                                            <a title="" href="<?php echo base_url().'products/'.$shopDetail[$i]->seourl; ?>"><?php echo $shopDetail[$i]->product_name; ?></a>
                                        </div>
                                    </span>
                                </div>
                            </td>        
                            <td class=""><?php echo $shopDetail[$i]->quantity; ?></td>        
                            <td class="">
                                <span class="dolar-symbol"><?php echo $currencySymbol;?></span>
                                <span class="dolar-value"><?php if($shopDetail[$i]->price != 0.00) { echo number_format($currencyValue*$shopDetail[$i]->price,2); } else { echo number_format($currencyValue*$shopDetail[$i]->base_price,2); echo '+'; } ?></span>
                                <span class="dolar-code"><?php echo $currencyType;?></span>

                            </td>
                            <td class=""><?php echo substr($shopDetail[$i]->created,0,10); ?></td>
                             <td class=""><?php echo$shopDetail[$i]->status; ?></td>
                            <td class="">
                                
										<a title="<?php echo af_lg('lg_Edit_listing','Edit listing'); ?>" href="edit-product/<?php echo $shopDetail[$i]->seourl; ?>" style="margin-right: 15%;"><image src="images/site/edit_icon.png" /></a>
									   <a title="<?php echo af_lg('lg_copy_listing','Copy listing'); ?>" href="copy-product/<?php echo $shopDetail[$i]->seourl; ?>"><image src="images/site/copy-icon.png" /></a>
									 
										<a class="<?php if($shopDetail[$i]->status != "Publish"){echo "not-active";} ?>" title="<?php echo af_lg('lg_make_feature','Make it Feature'); ?>" href="site/cart/makeFeatrue/<?php echo $shopDetail[$i]->seourl; ?>" style="margin-right: 15%;"><image src="images/site/activity.png" /></a>
												
											
									 
									
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>       
                        <tr class="look styleback">
                            <td colspan="7">
                                <span class="shuffle">
                                  <input class="find-all" onchange="select_multiple(this);" type="checkbox" value="on" name="find_all[]">
                                    <button class="secondary-button-delete" value="<?php if($this->lang->line('com_delete') != '') { echo stripslashes($this->lang->line('com_delete')); } else echo 'Delete'; ?>" name="action" onClick="return confirmDeletePrd();" type="submit"><?php if($this->lang->line('com_delete') != '') { echo stripslashes($this->lang->line('com_delete')); } else echo 'Delete'; ?></button>
                                </span>
                            </td>
                        </tr>
                    </tfoot>
                 </table>  
				</div>
                 <span id="CPDel"></span>   
   
             </form>
   
   
    </div>
    <?php }}  ?>
</div>
</div>
</div>
<a href="#feature_list" id="btn_popup" data-toggle="modal"></a>
<div id='feature_list' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				 <div style='background:#fff;'>  
					<div class="conversation" style="width: 340px; margin-left: 191px; margin-top: 171px;">
						<div class="conversation_container">
							<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;">  <?php echo af_lg('lg_Valid_Till',' Valid Till '); ?>
							<label id="exp" name="exp"></label> <?php echo af_lg('lg_Date',' Date'); ?>
							<?php echo af_lg('lg_Are_You_Sure_Unfeature',' Are You Sure To Unfeature This Product');?>  </h2>
							<form action="site/cart/proceed2unfeature"  method="post">
								
								<input type="hidden" id="product_seourl" name="product_seourl" value="">							
							
								<div class="modal-footer footer_tab_footer">
										<div class="btn-group">
												<input type="submit" class="btn btn-default submit_btn" id="submit_pay" value="<?php echo af_lg('lg_yes','YES'); ?>">
												<input type="submit" class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel" value="<?php echo af_lg('lg_cancel','Cancel'); ?>">
										</div>
								</div>	
							</form>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>	
<script>
function makepopup(seourl,expdate)
{
	$('#product_seourl').val(seourl);
	document.getElementById('exp').innerHTML=expdate;
	
	//document.getElementById('product_seourl').value=seourl;
	$('#btn_popup').trigger('click');
}
function select_multiple(evt){
	var val= $(evt).val();
	if(val == "on")
	{
		$('.chkProd').prop('checked', true);
		$('.find-all').prop('checked', true);
		$(evt).val("off")
	} else if(val == "off"){
		$('.chkProd').prop('checked', false);
		$('.find-all').prop('checked', false);
		$(evt).val("on")
	}
	
}
$('.chkProd').change(function(){
	if($('.chkProd:checked').length == $('.chkProd').length  ){
		$('.find-all').prop('checked', true);
		$('.find-all').val("off")
	}else{
		$('.find-all').prop('checked', false);
		$('.find-all').val("on")
	}/* $('.abc:checked').length == $('.abc').length */
});
/* function pay_feature()
{
	var pid=$('#product_seourl').val();
	var pack_id=$('#pack_id').val();
	if(pack_id != ""){
		$.ajax({
			type:'post',
				url	: baseURL+'site/checkout/pay_feature',
				dataType: 'json',			
				data:{'p_seo':pid,'pack_id':pack_id},
				success: function(response){
					
					alert(response);
				}
			
		});
	}else{
	}
	
} */
</script>

 <style>
.not-active {
 pointer-events: none;
 cursor: default;
}
</style>
<?php $this->load->view('site/templates/footer');?>