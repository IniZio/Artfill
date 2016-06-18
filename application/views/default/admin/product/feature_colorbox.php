								<?php  
									$pages=array();
									//echo count($product_feature);
									//echo "<pre>";print_r($product_feature);
									if( count($product_feature) > 0) {
										$pages= array_column($product_feature,'page');
									}
									//print_r($pages);die;
								?>
								<form action ="admin/product/change_featuredproduct_ajax" id="featured_date" method="get">
									<input type="hidden" id="featured_product_id" name="featured_product_id" value="<?php echo $pid;?>">
									<input type="hidden" id="fstatus" name="fstatus">
									<?php if(!(in_array('home',$pages) && in_array('search',$pages) && in_array('product detail',$pages)) ){?>
									<div class="table-new-1">
										<table class="table-new-2">
											<thead style="color: darkgoldenrod;">
											<tr>
												
												<td width="150px"><?php echo shopsy_lg('lg_name','Name');?></td>
												<td width="50px"><?php echo shopsy_lg('lg_days','Days');?></td>
												<td width="50px"><?Php echo shopsy_lg('lg_amount','Amount');?></td>
											</tr>
											</thead>
											<tbody>
											<?php
												if(count($feature_Pack_list)>0){
													foreach($feature_Pack_list as $fl){
											?>
														<tr>
															<td width="50px"><input type="radio" class="required small tipTop" title="Please select the Pack"  name="pack_id" id="pack_id" value="<?php echo $fl->id;?>">
															<?php echo $fl->name;?></td>
															<td width="50px"><?php echo $fl->days;?></td>
															<td width="50px"><?php echo $fl->amount;?></td>
														</tr>
											<?php
													}
												}
											?>
											</tbody>
										</table>
									</div>
									<br><br>
									Start Date<input name="eventDate" id="eventDate" type="text" tabindex="6" class="required small tipTop" title="Please select the date" value=""/>
									<br><br>
										
											<table><tr class="tbl_row_home"><td>page</td>
												<?php if(!(in_array('home',$pages))){?>	<td width="306px"> <input type="radio" class="required small tipTop" title="Please select the Page"  name="Page" id="Page" value="home">Home page</td><?php }else{?><td width="306px"><a style="margin-left: 96px; color:blue;" href="javscript:void(0)" id="unfeature" onclick="unfeature_prod('<?php echo $p_seourl;?>','home',this)">Unfeature From Home</a></td><?php }?>
												</tr>
												<tr><td class="tbl_row_search"></td>
													<?php if(!(in_array('search',$pages))){?>	<td width="306px"><input type="radio" class="required small tipTop" title="Please select the Page"  name="Page" id="Page" value="search" >Search page</td><?php }else{?><td width="306px"><a style="margin-left: 96px; color:blue;" href="javscript:void(0)" id="unfeature" onclick="unfeature_prod('<?php echo $p_seourl;?>','search',this)">Unfeature From search </a></td><?php }?>
												</tr>
												<tr><td class="tbl_row_detail"></td>
													<?php if(!(in_array('product detail',$pages))){?>	<td width="306px"><input type="radio" class="required small tipTop" title="Please select the Page"  name="Page" id="Page" value="product detail"  >Product Detail page</td><?php }else{?><td width="306px"><a style="margin-left: 96px; color:blue;" href="javscript:void(0)" id="unfeature" onclick="unfeature_prod('<?php echo $p_seourl;?>','product detail',this)">Unfeature From detail </a></td><?php }?>
												</tr>
												
											</table>
											<input type="hidden" name="un_feature" id="un_feature" value=0>
									<?php }else{ ?>
											<h3>Unfeature Product</h3>
											<input type="hidden" name="un_feature" id="un_feature" value=1>
										<?php }?>
										<div class="modal-footer footer_tab_footer">
											<div class="btn-group">		
													<input type="submit" style=" margin-left: 70px;margin-top: 10px; padding-left: 40px;padding-right: 40px;padding-bottom: 10px;padding-top: 5px;float: left;" class="btn btn-default submit_btn" value="Ok">
													
											</div>
									</div>
								</form>
<script src="js/datepicker.js"></script>
<script>$(document).ready(function(){$("#featured_date").validate(); });</script>
<script>
  $(function() {
    $( "#eventDate" ).datepicker();

 });
  </script>