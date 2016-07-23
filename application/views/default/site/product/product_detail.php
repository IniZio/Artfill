<?php
$this->load->view('site/templates/header');
?>
<!-- Bootstrap -->
<script src="js/front/auction_script.js"></script>
<!--<link href="css/default/front/fancyzoom.css" rel="stylesheet">-->
<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>
<?php if (isset($active_theme) && $active_theme->num_rows() != 0) {?>
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Product-Detail-page.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>footer.css" rel="stylesheet">
<?php }?>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/jquery.galleryview-3.0-dev.css"/>
<link rel="stylesheet" href="css/default/flexslider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/default/lightbox.css">
<script type="text/javascript" src="js/site/jquery.countdown.js"></script>
<script defer src="js/jquery.flexslider.js"></script>
<!--<script type="text/javascript" src="js/lightbox.js"></script>-->
<script type="text/javascript" src="js/front/freewall.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<div id="product_detail_div" style="width:80%;margin-right:auto;margin-left:auto;">
	<div class="content-seller" style="width:100%;">
		<div class="col-md-12">
			<div class="seller-right col-md-7">
				<?php /* <div class="cart-slide-block">
					<?php $imageArr=explode(',',$added_item_details[0]['image']); ?>
					<img src="images/product/<?php echo $imageArr[0]; ?>" alt="<?php echo stripslashes($added_item_details[0]['product_name']); ?>">
					<div class="photoblock-many"><a  href="images/product/org-image/<?php echo $imageArr[0]; ?>" id="prodZoom"><i class="fa fa-search"></i> Zoom</a>
				</div>
			</div> */?>
			<div id="gallery" class="flexslider" >
				<ul class="slides">
					<?php
					$imageArr = explode(',', $added_item_details[0]['image']);
					$imgCount = count($imageArr);
					for ($i = 0; $i < $imgCount; $i++) {
					?>
					<li data-thumb="<?php echo PRODUCTPATHTHUMB . $imageArr[$i]; ?>">
						<a rel="example2" href="<?php echo 'images/product/org-image/' . $imageArr[$i]; ?>" data-lightbox="example-set">
							<img src="<?php echo PRODUCTPATH . $imageArr[$i]; ?>" class="image0">
						</a>
					</li>
					<?php
					}
					?>
				</ul>
			</div>
			<div class="">
		<?php if ($added_item_details[0]['tag'] != '') {
		?>
		<h2><?php if ($this->lang->line('shop_relateditem') != '') {echo stripslashes($this->lang->line('shop_relateditem'));} else {
		echo 'Related to this Item';
		}
		?></h2>
		<ul class="tag">
			<?php $Related = explode(',', $added_item_details[0]['tag'])?>
			<?php foreach ($Related as $tag) {?>
			<li><a href="market/<?php echo url_title($tag); ?>"><?php echo $tag; ?></a></li>
			<?php }?>
		</ul>
		<?php }?>
	</div>
		</div>
		<div class="col-md-5">
			
			<div class="listing-page-cart">
				<div class="listing-page-cart-inner">
					<h1><?php echo $added_item_details[0]['product_name']; ?></h1>
					<!-- deal start -->
					<?php
					if ($this->config->item('deal_of_day') == 'Yes') {
					$starttime  = $added_item_details[0]['deal_date'] . " " . $added_item_details[0]['deal_time_from'];
					$endatedeal = $added_item_details[0]['deal_date_to'] . " " . $added_item_details[0]['deal_time_to'];
					if ($added_item_details[0]['action'] == 'DOD' && $added_item_details[0]['discount'] != 0 && strtotime($starttime) <= strtotime(date('Y-m-d H:i')) && strtotime($endatedeal) >= strtotime(date('Y-m-d H:i'))) {
					?>
					<?php date('Y-m-d H:i');
					$style = "style='text-decoration:line-through;'";
					if ($added_item_details[0]['price'] != 0) {
					$price_tot = $added_item_details[0]['price'];
					} else {
					$price_tot = $variations_one_values[0]['pricing'] . '+';
					}
					$offer   = ($added_item_details[0]['discount'] / 100) * $price_tot;
					$enddeal = date('Y-m-d H:i:s', strtotime($endatedeal));
					?>
					<div data-countdown="<?php echo $enddeal; ?>" >
					</div>
					<?php }} else {
					$style = '';
					$offer = 0;
					}
					?>
					<?php if ($added_item_details[0]['price'] != 0) {
					$price_tot = $added_item_details[0]['price'];
					} else {
					$price_tot = $variations_one_values[0]['pricing'];
					}?>
					<span class="cart-price" <?php echo $style; ?>><?php echo $currencySymbol;
						echo number_format($price_tot * $currencyValue, 2); ?> <span class="currencyType"><?php echo $currencyType; ?></span></span>
						<input type="hidden" id="price_val" value="<?php echo $price_tot; ?>" />
						<?php
						$withoutdealprice = $price_tot;
						$price_tot        = $price_tot - $offer;
						?>
						<?php if ($this->config->item('deal_of_day') == 'Yes') {
						?>
						<?php if ($added_item_details[0]['action'] == 'DOD' && $added_item_details[0]['discount'] != 0 && strtotime($starttime) <= strtotime(date('Y-m-d H:i')) && strtotime($endatedeal) >= strtotime(date('Y-m-d H:i'))) {
						?>
						<span class="cart-price" ><?php echo $currencySymbol;
							echo number_format($price_tot * $currencyValue, 2); ?> <span class="currencyType"><?php echo $currencyType; ?></span></span>
							<?php }}?>
							<!-- end of deal -->
							
							
							
							
							
							
							
						<?php if ($loginCheck != '') {
						?>
						<?php if ($added_item_details[0]['user_id'] == $loginCheck) {?>
						<a href="javascript:void(0);" onclick="return ownProductFav();">
							<div class="btn-secondary">
								<i id="prodfav" class="fa fa-heart"></i><?php if ($this->lang->line('user_favorite') != '') {echo stripslashes($this->lang->line('user_favorite'));} else {
								echo 'Favorite';
								}
								?>
							</div>
						</a>
						<?php
						} else {
						$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($added_item_details[0]['id']));
						#print_r($favArr); die;
						if (empty($favArr)) {
						?>
						<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($added_item_details[0]['id']); ?>','Fresh',this);">
							<div class="btn-secondary"> <i id="prodfav" class="fa fa-heart"></i><?php if ($this->lang->line('user_favorite') != '') {echo stripslashes($this->lang->line('user_favorite'));} else {
								echo 'Favorite';
								}
							?></div>
						</a>
						<?php } else {
						?>
						<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($added_item_details[0]['id']); ?>','Old',this);">
							<div class="btn-secondary"> <i id="prodfav" class="fav-icon-sel"></i><?php if ($this->lang->line('user_favorite') != '') {echo stripslashes($this->lang->line('user_favorite'));} else {
								echo 'Favorite';
								}
							?></div>
						</a>
						<?php }}} else {
						?>
						<a href="#signin" data-toggle="modal">
							<div class="btn-secondary"> <i id="prodfav" class="fa fa-heart"></i><?php if ($this->lang->line('user_favorite') != '') {echo stripslashes($this->lang->line('user_favorite'));} else {
								echo 'Favorite';
								}
							?></div>
						</a>
						<?php }?>
							
							
							
							
							
							
							
							<!--
							<div class="btn-secondary">
								<?php if ($this->session->userdata['shopsy_session_user_id'] != '') {
								if ($this->session->userdata['shopsy_session_user_id'] == $selectedSeller_details[0]['seller_id']) {
								?>
								<a data-toggle="modal" href="#ownshop_ask"><?php if ($this->lang->line('ask_question') != '') {echo stripslashes($this->lang->line('ask_question'));} else {
									echo 'Ask Question';
									}
								?></a>
								<?php } else {
								?>
								<a data-toggle="modal" href="#ask_reg"><?php if ($this->lang->line('ask_question') != '') {echo stripslashes($this->lang->line('ask_question'));} else {
									echo 'Ask Question';
									}
								?></a>
								<?php }} else {
								?>
								<a href="login?action=<?php echo current_url(); ?>"><?php if ($this->lang->line('ask_question') != '') {echo stripslashes($this->lang->line('ask_question'));} else {
									echo 'Ask Question';
									}
								?></a>
								<?php }?>
							</div>
							-->
						</div>
						<div class="related-listings">
							<div class="related-listing-inner">
								<div class="shop-info">
									<?php if($selectedSeller_details[0]['thumbnail']!=""){ $Pro_pic=$selectedSeller_details[0]['thumbnail']; }else { $Pro_pic='profile_pic.png';} ?>
									<span class="avatar"><a href="shop-section/<?php echo $selectedSeller_details[0]['seourl']; ?>"><img style="border-radius:50%;" src="images/users/thumb/<?php echo $Pro_pic; ?>" width="75" height="75" /></a></span>
									<div class="shop-name"> <a href="shop-section/<?php echo $selectedSeller_details[0]['seourl']; ?>"><?php echo $selectedSeller_details[0]['seller_businessname']; ?></a></div>
									<?php if (trim($selectedSeller_details[0]['city']) != '' && trim($selectedSeller_details[0]['city']) != 0) {
									?>
									<span class="ship-label">
										<span><?php if ($this->lang->line('prod_in') != '') {echo stripslashes($this->lang->line('prod_in'));} else {
											echo 'in';
											}
										?></span> <?php echo $selectedSeller_details[0]['city']; ?>
									</span>
									<?php } else {
									if (trim($selectedSeller_details[0]['country']) != '' && trim($selectedSeller_details[0]['country']) != 0) {
									?>
									<span class="ship-label">
										<span><?php if ($this->lang->line('prod_in') != '') {echo stripslashes($this->lang->line('prod_in'));} else {
											echo 'in';
											}
										?></span> <?php echo $selectedSeller_details[0]['country']; ?>
									</span>
									<?php }}?>
								</div>
								<?php if (count($shopProductDetails) < 4) {$c = count($shopProductDetails);} else { $c = 4;}
								if($c > 2){$c = 2;}
								for ($i = 0; $i < $c; $i++) {
								$imgArry = explode(',', $shopProductDetails[$i]['image']);
								if ($shopProductDetails[$i]['price'] != 0) {$price = $currencyValue * $shopProductDetails[$i]['price'];} else { $price = $currencyValue * $shopProductDetails[$i]['base_price'] . '+';}
								?>
								<div class="realated-brick col-md-6 odd">
									<a href="products/<?php echo $shopProductDetails[$i]['seourl']; ?>">
										<img src="images/product/thumb/<?php echo $imgArry[0] ?>" alt="<?php echo $shopProductDetails[$i]['product_name']; ?>" title="<?php echo $shopProductDetails[$i]['product_name']; ?>" />
									</a>
									<div class="info">
										<h3><a href="products/<?php echo $shopProductDetails[$i]['seourl']; ?>"><?php echo character_limiter($shopProductDetails[$i]['product_name'], 15); ?></a></h3>
										<span class="cat-name cat-price"><?php echo $currencySymbol;
											echo number_format($price, 2); ?> <span class="currencyType"><?php echo $currencyType; ?></span></span>
										</div>
										<div class="collections-ui" style="display:none;">
											<div  class="favorite-container">
												<?php if ($loginCheck != '') {
												?>
												<?php if ($shopProductDetails[$i]['user_id'] == $loginCheck) {?>
												<button data-toggle="modal" onclick="return ownProductFav();" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button">
												<span class="icon"></span> <span class="ie-fix">&nbsp;</span>
												</button>
												<?php
												} else {
												$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($shopProductDetails[$i]['id']));
												if (empty($favArr)) {?>
												<button data-toggle="modal" onclick="return changeProductToFavourite('<?php echo stripslashes($shopProductDetails[$i]['id']); ?>','Fresh',this);" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button">
												<span class="icon"></span> <span class="ie-fix">&nbsp;</span>
												</button>
												<?php } else {?>
												<?php echo "hshshshdhsdh"; ?>
												<button data-toggle="modal" onclick="return changeProductToFavourite('<?php echo stripslashes($shopProductDetails[$i]['id']); ?>','Old',this);" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button">
												<span class="icon"></span> <span class="ie-fix">&nbsp;</span>
												</button>
												<?php }}} else {?>
												<button data-toggle="modal" onclick="return changeProductToFavourite('<?php echo stripslashes($shopProductDetails[$i]['id']); ?>','Fresh',this);" class="btn-fave  inline-overlay-trigger btn-fave-action" type="button">
												<span class="icon"></span> <span class="ie-fix">&nbsp;</span>
												</button>
												<?php }?>
											</div>
											<div  class="collect-container">
												<button onclick="return hoverView('<?php echo $shopProductDetails[$i]['id']; ?>');" class="btn-collect btn-dropdown  inline-overlay-trigger ollection-add-action" type="button">
												<span class="icon"></span>
												<span class="icon-dropdown"></span>
												<span class="ie-fix">&nbsp;</span>
												</button>
												<div id="hoverlist<?php echo $shopProductDetails[$i]['id']; ?>" class="hover_lists">
													<h2><?php if ($this->lang->line('user_your_lists') != '') {echo stripslashes($this->lang->line('user_your_lists'));} else {
													echo 'Your Lists';
													}
													?></h2>
													<div class="lists_check">
														<?php foreach ($userLists as $Lists) {
														$haveListIn = $this->user_model->check_list_products(stripslashes($shopProductDetails[$i]['id']), $Lists['id'])->num_rows();
														#echo $haveListIn;
														if ($haveListIn > 0) {$chk = 'checked="checked"';} else { $chk = '';}
														?>
														<input type="checkbox" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo stripslashes($shopProductDetails[$i]['id']); ?>');" <?php echo $chk; ?> />
														<label><?php echo $Lists['name']; ?></label><br/>
														<?php }?>
														<?php if (!empty($userRegistry)) {
														$haveRegisryIn = $this->user_model->check_registry_products($shopProductDetails[$i]['id'], $userRegistry->user_id)->num_rows();
														if ($haveRegisryIn > 0) {$chk = 'checked="checked"';} else { $chk = '';}
														?>
														<input type="checkbox"  onclick="return manageRegisrtyProduct('<?php echo $userRegistry->user_id; ?>','<?php echo $shopProductDetails[$i]['id']; ?>');" <?php echo $chk; ?> />
														<label><span class="registry_icon"></span><?php if ($this->lang->line('prod_wedding') != '') {echo stripslashes($this->lang->line('prod_wedding'));} else {
														echo 'Wedding Registry';
														}
													?></label>
													<?php }?>
												</div>
												<div class="new_list">
													<form action="site/user/add_list" method="post">
														<input type="hidden" value="1" name="ddl" />
														<input type="hidden" value="<?php echo $shopProductDetails[$i]['id']; ?>" name="productId" />
														<input type="text" placeholder="<?php if ($this->lang->line('user_new_list') != '') {echo stripslashes($this->lang->line('user_new_list'));} else {
														echo 'New list';
														}
														?>" class="list_scroll" name="list" id="creat_list_<?php echo $i; ?>" />
														<input type="submit" value="<?php if ($this->lang->line('user_add') != '') {echo stripslashes($this->lang->line('user_add'));} else {
														echo 'Add';
														}
														?>" class="primary-button" onclick="return validate_create_list('<?php echo $i; ?>');" />
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php }?>
							</div>
						</div>
						<div class="price_left">
							<p id="QtyErr"></p><p id="ADDCartErr"></p>
						</div>
						<?php if ($subProduct->row()->digital_item == '') {
						?>
						<div class="price_left">
							<?php if ($added_item_details[0]['quantity'] > 1) {?>
							<label style="float:left; width:100%"><?php if ($this->lang->line('shop_quantity') != '') {echo stripslashes($this->lang->line('shop_quantity'));} else {
								echo 'Quantity';
								}
							?></label>
							<select id="quantity_list" data-mqty="<?php echo $added_item_details[0]['quantity']; ?>">
								<?php for ($i = 1; $i <= $added_item_details[0]['quantity']; $i++) {echo '<option>' . $i . '</option>';}?>
							</select>
							<?php } else if ($added_item_details[0]['quantity'] == 1) {
							?>
							<input type="hidden" id="quantity_list" data-mqty="<?php echo $added_item_details[0]['quantity']; ?>"  />
							<label style="float:left; width:100%"><?php if ($this->lang->line('prod_only') != '') {echo stripslashes($this->lang->line('prod_only'));} else {
								echo 'Only 1 available';
								}
							?></label>
							<?php } else if ($added_item_details[0]['quantity'] <= 0) {
							?>
							<label style="float:left; width:100%"><h2 style="color:#F0F"><?php if ($this->lang->line('prod_stock') != '') {echo stripslashes($this->lang->line('prod_stock'));} else {
								echo 'Out Of Stock';
								}
								?>!</h2>
							</label>
							<?php }?>
						</div>
						<?php } else {?>
						<input type="hidden" id="quantity_list" data-mqty="<?php echo $added_item_details[0]['quantity']; ?>"  />
						<?php }?>
						<?php if ($variations_one != '' && $variations_two != '') {$var = 2;} else if ($variations_one != '' || $variations_two != '') {$var = 1;} else { $var = 0;}?>
						<p id="variation_count" style="display:none;" ><?php echo $var; ?></p>
						<?php if ($variations_one != '') {
						?>
						<div class="price_left">
							<label style="float:left; width:100%" id="var_one"><?php echo $variations_one; ?></label>
							<select id="variation_one" onchange="change_variationone(this);">
								<option value="" selected="selected"><?php if ($this->lang->line('user_select') != '') {echo stripslashes($this->lang->line('user_select'));} else {
									echo 'Select';
									}
									?> <?php if ($variations_one == "color") {
									if ($this->lang->line('lg_color') != '') {echo stripslashes($this->lang->line('lg_color'));} else {
									echo 'color';
									}
									} elseif ($variations_one == "size") {
									if ($this->lang->line('lg_size') != '') {echo stripslashes($this->lang->line('lg_size'));} else {
									echo 'size';
									}
									} elseif ($variations_one == "weight") {
									if ($this->lang->line('lg_weight') != '') {echo stripslashes($this->lang->line('lg_weight'));} else {
									echo 'weight';
									}
									} elseif ($variations_one == "flavor") {
									if ($this->lang->line('lg_flavor') != '') {echo stripslashes($this->lang->line('lg_flavor'));} else {
									echo 'flavor';
									}
									} elseif ($variations_one == "length") {
									if ($this->lang->line('lg_length') != '') {echo stripslashes($this->lang->line('lg_length'));} else {
									echo 'length';
									}
									} elseif ($variations_one == "height") {
									if ($this->lang->line('lg_height') != '') {echo stripslashes($this->lang->line('lg_height'));} else {
									echo 'height';
									}
								}?></option>
								<?php
								for ($i = 0; $i < count($variations_one_values); $i++) {
								$val = $variations_one_values[$i]['attr_value'];
								if ($variations_one_values[$i]['pricing']) {
								$val = $variations_one_values[$i]['attr_value'] . ' [' . $currencySymbol . ' ' . number_format($variations_one_values[$i]['pricing'] * $currencyValue, 2) . ']';
								}
								if ($variations_one_values[$i]['stock_status'] == 0) {
								$stock = 'disabled="disabled"';
								$val .= ' - out of stock';
								} else {
								$stock = '';
								}
								echo '<option ' . $stock . ' >' . $val . '</option>';
								}
								?>
							</select>
							<span class="error" id="Err_variation_one"></span>
						</div>
						<?php }?>
						<?php if ($variations_two != '') {
						?>
						<div class="price_left">
							<label style="float:left; width:100%"  id="var_two"><?php echo $variations_two; ?></label>
							<select id="variation_two" name="variationVal[]">
								<option value="" selected="selected"><?php if ($this->lang->line('user_select') != '') {echo stripslashes($this->lang->line('user_select'));} else {
									echo 'Select';
									}
								?> <?php echo $variations_two; ?></option>
								<?php
								for ($i = 0; $i < count($variations_two_values); $i++) {
								$val1 = $variations_two_values[$i]['attr_value'];
								if ($variations_two_values[$i]['pricing']) {
								$val1 = $variations_two_values[$i]['attr_value'] . ' [$' . $variations_two_values[$i]['pricing'] . ']';
								}
								if ($variations_two_values[$i]['stock_status'] == 0) {
								$stock1 = 'disabled="disabled"';
								$val1 .= ' - out of stock';
								} else {
								$stock1 = '';
								}
								echo '<option ' . $stock1 . '>' . $val1 . '</option>';}
								?>
							</select>
							<span class="error" id="Err_variation_two"></span>
						</div>
						<?php }?>
						<div id="item-overview">
							<h3><?php if ($this->lang->line('shop_overview') != '') {echo stripslashes($this->lang->line('shop_overview'));} else {
							echo 'Overview';
							}
							?></h3>
							<ul class="properties">
								<li> <?php
									if ($added_item_details['0']['made_by'] == 1) {
									if ($this->lang->line('shop_handmad') != '') {echo stripslashes($this->lang->line('shop_handmad'));} else {
									echo 'Handmade';
									}
									} else
									if ($added_item_details['0']['made_by'] == 2) {
									if ($this->lang->line('shop_vint') != '') {echo stripslashes($this->lang->line('shop_vint'));} else {
									echo 'Vintage';
									}
									} else if ($added_item_details['0']['made_by'] == 3) {
									if ($this->lang->line('shop_vintagehandmade') != '') {echo stripslashes($this->lang->line('shop_vintagehandmade'));} else {
									echo 'Vintage Handmade';
									}
									}
									echo ' ';
									if ($this->lang->line('user_item_var') != '') {echo stripslashes($this->lang->line('user_item_var'));} else {
									echo 'Item';
									}
									?>
								</li>
								<?php if ($added_item_details[0]['materials'] != '') {
								?>
								<li>
									<?php if ($this->lang->line('shop_materials') != '') {echo stripslashes($this->lang->line('shop_materials'));} else {
									echo 'Materials';
									}
									?>:
									<span id="overview-materials"><?php $material = explode(',', $added_item_details[0]['materials']);foreach ($material as $materialList) {echo $materialList . ', ';}?></span>
								</li>
								<?php }?>
								<?php /*  if($added_item_details[0]['maked_on']!=''){ ?>
								<li>
									Making :
									<span><?php echo  $added_item_details[0]['maked_on'];?></span>
								</li>
								<?php } */?>
								<li><?php if ($this->lang->line('feedback:') != '') {echo stripslashes($this->lang->line('feedback:'));} else {
									echo af_lg('lg_feedback', 'Feedback:');
									}
									?>
									<a href="shop-section/<?php echo $selectedSeller_details[0]['seourl']; ?>/reviews" onclick="javascript: $('#reviewTabbar').trigger('click');">
										<?php echo $selectedSeller_details[0]['review_count']; ?> <?php if ($this->lang->line('shopsec_reviews') != '') {echo stripslashes($this->lang->line('shopsec_reviews'));} else {
										echo 'Reviews';
										}
										?>
									</a>
								</li>
								<!--<li>
									<?php if ($this->lang->line('shop_ships') != '') {echo stripslashes($this->lang->line('shop_ships'));} else {
									echo 'Ships';
									}
									?> <?php if (strpos($added_item_details[0]['ship_details'], 'Everywhere Else') != false) {echo 'worldwide';}?> <?php if ($this->lang->line('shop_from') != '') {echo stripslashes($this->lang->line('shop_from'));} else {
									echo 'from';
									}
									?> <?php echo $added_item_details[0]['ship_from']; ?>
								</li>-->
								<?php /*if($added_item_details[0]['pickup_option'] == 'collection'){?>
								<li>
									<?php if($this->lang->line('local_collection_only') != '') { echo stripslashes($this->lang->line('local_collection_only')); } else echo 'Local Collection Only'; ?>
								</li>
								<?php }elseif($added_item_details[0]['pickup_option'] == 'delivery'){?>
								<li>
									<?php if($this->lang->line('shop_ships') != '') { echo stripslashes($this->lang->line('shop_ships')); } else echo 'Ships'; ?> <?php if(strpos($added_item_details[0]['ship_details'],'Everywhere Else') != false){ echo 'worldwide';} ?> <?php if($this->lang->line('ship_postcode') != '') { echo stripslashes($this->lang->line('ship_postcode')); } else echo 'from'; ?> <?php echo $added_item_details[0]['ship_from']; ?>
								</li>
								<?php } else {?>
								<li>
									<?php if($this->lang->line('local_collection_or') != '') { echo stripslashes($this->lang->line('local_collection_or')); } else echo 'Local Collection (or) '; ?>
									<?php if($this->lang->line('shop_ships') != '') { echo stripslashes($this->lang->line('shop_ships')); } else echo 'Ships'; ?> <?php if(strpos($added_item_details[0]['ship_details'],'Everywhere Else') != false){ echo 'worldwide';} ?> <?php if($this->lang->line('ship_postcode') != '') { echo stripslashes($this->lang->line('ship_postcode')); } else echo 'from'; ?> <?php echo $added_item_details[0]['ship_from']; ?>
								</li>
								<?php  }*/?>
								<?php if ($selectedSeller_details[0]['gift_card'] == 'Yes') {
								?>
								<li>
									<?php if ($this->lang->line('giftCarg_accept') != '') {echo stripslashes($this->lang->line('giftCarg_accept'));} else {
									echo af_lg('lg_giftcart accepted', 'Gift Card Accepted');
									}
									?>
								</li>
								<?php }?>
							</ul>
						</div>
						
						
						
		<div class="clear inner" id="fineprint">
			<ul class="clear">
				<li><?php if ($this->lang->line('prod_listed') != '') {echo stripslashes($this->lang->line('prod_listed'));} else {
					echo 'Listed on';
					}
					?>
				<?php echo date('M d,Y', strtotime($added_item_details[0]['created'])); ?></li>
				<li> <?php echo $added_item_details[0]['view_count']; ?> <?php if ($this->lang->line('shopsec_views') != '') {echo stripslashes($this->lang->line('shopsec_views'));} else {
					echo 'views';
					}
				?> </li>
				<!--
				<li>
					<a href="product/<?php echo $added_item_details[0]['seourl']; ?>/favoriters"> <?php echo count($ProductFavoriteCount); ?> <?php if ($this->lang->line('user_favorites') != '') {echo stripslashes($this->lang->line('user_favorites'));} else {
						echo 'Favorites';
						}
					?> </a>
				</li>
				-->
				<?php /* <li> <a href="#"> 1 Treasury list </a> </li>
				<li id="add-treasury-item"> <a href="#" class="inline-overlay-trigger"> Add item to treasury </a> </li> */?>
				<!--
				<li id="item-reporter">
					<div id="reporter-link-container">
						<?php if ($this->session->userdata['shopsy_session_user_id'] != '') {
						if ($this->session->userdata['shopsy_session_user_id'] == $selectedSeller_details[0]['seller_id']) {
						?>
						<a href="#ownshop_report" style="color:rgb(1, 173, 220);" data-toggle="modal"><?php if ($this->lang->line('prod_report') != '') {echo stripslashes($this->lang->line('prod_report'));} else {
							echo 'Report this item to';
							}
						?> <?php echo $this->config->item('email_title'); ?></a>
						<?php } else {
						?>
						<a href="#detailreport_reg" style="color:rgb(1, 173, 220);" data-toggle="modal"><?php if ($this->lang->line('prod_report') != '') {echo stripslashes($this->lang->line('prod_report'));} else {
							echo 'Report this item to';
							}
						?> <?php echo $this->config->item('email_title'); ?></a>
						<?php }} else {
						?>
						<a href="login?action=<?php echo current_url(); ?>" style="color:rgb(1, 173, 220);"><?php if ($this->lang->line('prod_report') != '') {echo stripslashes($this->lang->line('prod_report'));} else {
							echo 'Report this item to';
							}
						?> <?php echo $this->config->item('email_title'); ?></a>
						<?php }?>
					</div>
					<div id="reporter-complete-container"> </div>
				</li>
				-->
			</ul>
		</div>
						
						
						
						
					</div>
					<?php if ($variations_one != '') {?>
					<input type="hidden" name="variationName[]" id="variation_one_name" value="<?php echo $variations_one; ?>" />
					<input type="hidden" name="variationVal[]" id="variation_one_val" value="" />
					<?php }?>
					<?php if ($variations_two != '') {?>
					<input type="hidden" name="variationName[]" id="variation_two_name" value="<?php echo $variations_two; ?>" />
					<input type="hidden" name="variationVal[]" id="variation_two_val" value="" />
					<?php }?>
					<?php if ($variations_one == '' && $variations_two == '' && $subProduct->row()->digital_item != '') {?>
					<input type="hidden" name="digital_files" id="digital_files" value="<?php echo $subProduct->row()->digital_item; ?>" />
					<?php } else {?>
					<input type="hidden" name="digital_files" id="digital_files" value="" />
					<?php }?>
					<input type="hidden" name="product_id" id="product_id" value="<?php echo $added_item_details[0]['id']; ?>">
					<input type="hidden" name="seller_id" id="sell_id" value="<?php echo $selectedSeller_details[0]['seller_id']; ?>">
					<input type="hidden" name="pickup_option" id="pickup_option" value="<?php echo $added_item_details[0]['pickup_option'] ?>">
					<?php if ($this->config->item('deal_of_day') == 'Yes') {
					if ($added_item_details[0]['action'] == 'DOD' && $added_item_details[0]['discount'] != 0 && date('Y-m-d H:i', strtotime($starttime)) <= strtotime(date('Y-m-d H:i')) && strtotime($endatedeal) >= strtotime(date('Y-m-d H:i'))) {
					?>
					<input type="hidden" name="discountprice" id="discountprice" value="<?php echo $added_item_details[0]['discount'] / 100; ?>">
					<?php }} else {?>
					<?php }?>
					<input type="hidden" name="price" id="price" value="<?php echo $withoutdealprice; ?>">
					<input type="hidden" name="qty" id="qty" value="1">
					<?php if ($added_item_details[0]['quantity'] > 0 || $subProduct->row()->digital_item != '') {?>
					<input class="btn-primary subscribe-link alert-popupcart" id="add_to_cart" type="submit" value="<?php echo af_lg('lg_add_to_cart', 'Add to Cart'); ?>" <?php if ($selectedSeller_details[0]['seller_id'] == $this->session->userdata['shopsy_session_user_id']) {?> onclick="javascript:$('#ownproduct-link').trigger('click');"<?php } else {?> onclick="return ajax_add_cart();" <?php }?><?php if ($added_item_details[0]['quantity'] <= 0) {echo 'disabled="disabled"';}?>  />
					<?php }?>
					<a href="#ownproduct-alert" id="ownproduct-link" data-toggle="modal"></a>
					<!-- 				<?php if ($added_item_details[0]['quantity'] > 0 || $subProduct->row()->digital_item != '') {?>
					<input class="btn-primary subscribe-link alert-popupcart" id="add_to_cart" type="submit" value="<?php if ($this->lang->line('add_cart') != '') {echo $this->lang->line('add_cart');} else {echo af_lg('lg_add to cart', 'Add to Cart');}?>" <?php if ($selectedSeller_details[0]['seller_id'] == $this->session->userdata['shopsy_session_user_id']) {?> onclick="javascript:$('#ownproduct-link').trigger('click');"<?php } else {?> onclick="return ajax_add_cart();" <?php }?><?php if ($added_item_details[0]['quantity'] <= 0) {echo 'disabled="disabled"';}?>  />
					<?php }?>
					<a href="#ownproduct-alert" id="ownproduct-link" data-toggle="modal"></a>
				</div> -->
				
				
				<!--
				<div id="favoriting-and-sharing">
					<div id="fav-box">
						<?php if ($loginCheck != '') {
						?>
						<?php if ($added_item_details[0]['user_id'] == $loginCheck) {?>
						<a href="javascript:void(0);" onclick="return ownProductFav();">
							<div class="btn-secondary">
								<i class="fa fa-heart"></i><?php if ($this->lang->line('user_favorite') != '') {echo stripslashes($this->lang->line('user_favorite'));} else {
								echo 'Favorite';
								}
								?>
							</div>
						</a>
						<?php
						} else {
						$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($added_item_details[0]['id']));
						#print_r($favArr); die;
						if (empty($favArr)) {
						?>
						<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($added_item_details[0]['id']); ?>','Fresh',this);">
							<div class="btn-secondary"> <i class="fa fa-heart"></i><?php if ($this->lang->line('user_favorite') != '') {echo stripslashes($this->lang->line('user_favorite'));} else {
								echo 'Favorite';
								}
							?></div>
						</a>
						<?php } else {
						?>
						<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($added_item_details[0]['id']); ?>','Old',this);">
							<div class="btn-secondary"> <i class="fav-icon-sel"></i><?php if ($this->lang->line('user_favorite') != '') {echo stripslashes($this->lang->line('user_favorite'));} else {
								echo 'Favorite';
								}
							?></div>
						</a>
						<?php }}} else {
						?>
						<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($added_item_details[0]['id']); ?>','Fresh',this);">
							<div class="btn-secondary"> <i class="fa fa-heart"></i><?php if ($this->lang->line('user_favorite') != '') {echo stripslashes($this->lang->line('user_favorite'));} else {
								echo 'Favorite';
								}
							?></div>
						</a>-->
						<?php }?>
						<!-- START: removed: Add to user list -->
						<!-- <div class="btn-secondary">
							<?php /* <a href="javascript:void(0);" onclick="return hoverView('123');">
								<span class="glyphicon glyphicon-align-justify"></span><?php if($this->lang->line('add_to') != '') { echo stripslashes($this->lang->line('add_to')); } else echo 'Add to '; ?> <i class="fa fa-sort-desc"></i>
							</a>
							*/?>
							<?php if ($loginCheck != '') {
							?>
							<a href="javascript:hoverView('123');">
								<span class="glyphicon glyphicon-align-justify"></span><?php if ($this->lang->line('add_to') != '') {echo stripslashes($this->lang->line('add_to'));} else {
								echo 'Add to';
								}
								?><i class="fa fa-sort-desc"></i>
							</a>
							<?php } else {
							?>
							<a href="login?action=<?php echo current_url(); ?>">
								<span class="glyphicon glyphicon-align-justify"></span><?php if ($this->lang->line('add_to') != '') {echo stripslashes($this->lang->line('add_to'));} else {
								echo 'Add to';
								}
								?><i class="fa fa-sort-desc"></i>
							</a>
							<?php }?>
						</div>
						<div id="hoverlist123" class="hover_lists">
							<h2><?php if ($this->lang->line('user_your_lists') != '') {echo stripslashes($this->lang->line('user_your_lists'));} else {
							echo 'Your Lists';
							}
							?></h2>
							<div class="lists_check">
								<?php foreach ($userLists as $Lists) {
								$haveListIn = $this->user_model->check_list_products(stripslashes($proddetails['id']), $Lists['id'])->num_rows();
								#echo $haveListIn;
								if ($haveListIn > 0) {$chk = 'checked="checked"';} else { $chk = '';}
								?>
								<input type="checkbox" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo stripslashes($proddetails['id']); ?>');" <?php echo $chk; ?> />
								<label><?php echo $Lists['name']; ?></label><br/>
								<?php }?>
								<?php if (!empty($userRegistry)) {
								$haveRegisryIn = $this->user_model->check_registry_products($proddetails['id'], $userRegistry->user_id)->num_rows();
								if ($haveRegisryIn > 0) {$chk = 'checked="checked"';} else { $chk = '';}
								?>
								<input type="checkbox"  onclick="return manageRegisrtyProduct('<?php echo $userRegistry->user_id; ?>','<?php echo $proddetails['id']; ?>');" <?php echo $chk; ?> />
								<label><span class="registry_icon"></span><?php if ($this->lang->line('prod_wedding') != '') {echo stripslashes($this->lang->line('prod_wedding'));} else {
								echo 'Wedding Registry';
								}
							?></label>
							<?php }?>
						</div>
						<div class="new_list">
							<form action="site/user/add_list" method="post">
								<input type="hidden" value="1" name="ddl" />
								<input type="hidden" value="<?php echo $proddetails['id']; ?>" name="productId" />
								<input type="text" placeholder="<?php if ($this->lang->line('user_new_list') != '') {echo stripslashes($this->lang->line('user_new_list'));} else {
								echo 'New list';
								}
								?>" class="list_scroll" name="list" id="creat_list_<?php echo $i; ?>" />
								<input type="submit" value="<?php if ($this->lang->line('user_add') != '') {echo stripslashes($this->lang->line('user_add'));} else {
								echo 'Add';
								}
								?>" class="primary-button" onclick="return validate_create_list('<?php echo $i; ?>');" />
							</form>
						</div>
					</div>-->
				<!--</div> -->
				<!-- END: removed: Add to user list -->
			<!--</div>-->
			
			
			
			
			<!-- AddThis Button BEGIN -->
			<?php if ($loginCheck == '') {$att = current_url();} else { $att = current_url() . "?aff=" . $userDetails->row()->affiliateId;}?>
			<!-- 			<div class="addthis_toolbox addthis_default_style " addthis:url="<?php echo $att; ?>">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
				<a class="addthis_button_tweet"></a>
				<a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal"></a>
				<a class="addthis_counter addthis_pill_style"></a>
			</div>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50ab628f64d148de"></script> -->
			<!-- AddThis Button END -->
			<?php //if($loginCheck==''){ $att= current_url(); } else{ $att= current_url()."?aff=".$userDetails->row()->affiliateId;}
			//$title=urlencode($added_item_details[0]['product_name']);
			//$url=urlencode("http://quickiz.com/deliverio/products/40mm-snakeskin-jasper-sphere-wicca-witch-magick-metaphysical-altar-tool-ceremonial-ritual-spell-pagan-scrying-crystal-ball/");
			//$summary=urlencode($added_item_details[0]['description']);
			//$image=urlencode("http://www.daddydesign.com/ClientsTemp/Tutorials/custom-iframe-share-button/images/thumbnail.jpg");
			?>
			<!--<a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title; ?>&amp;p[summary]=<?php echo $summary; ?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image; ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)">
				Insert text or an image here.
			</a>-->
		</div>
	</div>
</div>


<!--
<div class="col-md-12 realated-this-item">
	<div class="col-md-7">
		<?php if ($added_item_details[0]['tag'] != '') {
		?>
		<h2><?php if ($this->lang->line('shop_relateditem') != '') {echo stripslashes($this->lang->line('shop_relateditem'));} else {
		echo 'Related to this Item';
		}
		?></h2>
		<ul class="tag">
			<?php $Related = explode(',', $added_item_details[0]['tag'])?>
			<?php foreach ($Related as $tag) {?>
			<li><a href="market/<?php echo url_title($tag); ?>"><?php echo $tag; ?></a></li>
			<?php }?>
		</ul>
		<?php }?>
	</div>
	<div class="col-md-5">
		<div class="clear inner" id="fineprint">
			<ul class="clear">
				<li><?php if ($this->lang->line('prod_listed') != '') {echo stripslashes($this->lang->line('prod_listed'));} else {
					echo 'Listed on';
					}
					?>
				<?php echo date('M d,Y', strtotime($added_item_details[0]['created'])); ?></li>
				<li> <?php echo $added_item_details[0]['view_count']; ?> <?php if ($this->lang->line('shopsec_views') != '') {echo stripslashes($this->lang->line('shopsec_views'));} else {
					echo 'views';
					}
				?> </li>
				<li>
					<a href="product/<?php echo $added_item_details[0]['seourl']; ?>/favoriters"> <?php echo count($ProductFavoriteCount); ?> <?php if ($this->lang->line('user_favorites') != '') {echo stripslashes($this->lang->line('user_favorites'));} else {
						echo 'Favorites';
						}
					?> </a>
				</li>
				<?php /* <li> <a href="#"> 1 Treasury list </a> </li>
				<li id="add-treasury-item"> <a href="#" class="inline-overlay-trigger"> Add item to treasury </a> </li> */?>
				<li id="item-reporter">
					<div id="reporter-link-container">
						<?php if ($this->session->userdata['shopsy_session_user_id'] != '') {
						if ($this->session->userdata['shopsy_session_user_id'] == $selectedSeller_details[0]['seller_id']) {
						?>
						<a href="#ownshop_report" style="color:rgb(1, 173, 220);" data-toggle="modal"><?php if ($this->lang->line('prod_report') != '') {echo stripslashes($this->lang->line('prod_report'));} else {
							echo 'Report this item to';
							}
						?> <?php echo $this->config->item('email_title'); ?></a>
						<?php } else {
						?>
						<a href="#detailreport_reg" style="color:rgb(1, 173, 220);" data-toggle="modal"><?php if ($this->lang->line('prod_report') != '') {echo stripslashes($this->lang->line('prod_report'));} else {
							echo 'Report this item to';
							}
						?> <?php echo $this->config->item('email_title'); ?></a>
						<?php }} else {
						?>
						<a href="login?action=<?php echo current_url(); ?>" style="color:rgb(1, 173, 220);"><?php if ($this->lang->line('prod_report') != '') {echo stripslashes($this->lang->line('prod_report'));} else {
							echo 'Report this item to';
							}
						?> <?php echo $this->config->item('email_title'); ?></a>
						<?php }?>
					</div>
					<div id="reporter-complete-container"> </div>
				</li>
			</ul>
		</div>
	</div>
</div>
-->
<div class="col-md-12 middel-detail" style="width:80%;margin-right:auto;margin-left:auto;">

</div>

<div class="col-md-7" style="width:100%;">
	<div role="tabpanel" class="tab-content">
		<!-- Nav tabs -->
		
		<ul class="nav nav-tabs cart-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#itemdetails" aria-controls="itemdetails" role="tab" data-toggle="tab"><?php if ($this->lang->line('shop_itemdetails') != '') {echo stripslashes($this->lang->line('shop_itemdetails'));} else {
					echo 'Item Details';
					}
				?></a>
			</li>
			<?php
			#echo "<pre>";print_r($productReview);
				$rew_Pro_arr = array();
				if (count($productReview) > 0) {
				    $rew_Pro_arr = array_column($productReview, 'seo_url');
				}
				$rev_flg = 0;
				if (in_array($added_item_details[0]['seourl'], $rew_Pro_arr)) {
				    $rev_flg = 1;
				}
				?>
				<li role="presentation" id="reviewTabbar">
					<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
						<span class="reviews">
							<div class="stars small" style="width: <?php if ($rev_flg == 1) {echo $selectedSeller_details[0]['shop_ratting'] * 17.2;} else {
								    echo 0;
								}
							?>px !important;"> </div>
						</span>(<?php if ($rev_flg == 1) {
						    echo $selectedSeller_details[0]['review_count'];
						} else {
						    echo 0;
						}
						?>)
					</a>
				 </li>
				 <!--
				<li role="presentation">
					<a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><?php if ($this->lang->line('shop_shippingpolicy') != '') {echo stripslashes($this->lang->line('shop_shippingpolicy'));} else {
						    echo 'Shipping & Policies';
						}
						?>
					</a>
				</li>
				-->
			        </ul>
			<!-- Tab panes -->
			        <div class="tab-content cart-content">
				            <div role="tabpanel" class="tab-pane fade in active" id="itemdetails">
					                <div id="description-text">
						<?php if ($added_item_details[0]['description'] != '') {
						?>
						<?php echo $added_item_details[0]['description'];
						}
						?><br>
						<?php if ($variations_one == '' && $variations_two == '' && $subProduct->row()->digital_item != '') {
						?>
						   <br>
						  ......................................................................................<br>
						  <br>
						<h4><b><u>
						<?php if ($this->lang->line('prod_buyers') != '') {echo stripslashes($this->lang->line('prod_buyers'));} else {
						        echo 'Message to buyers for digital items';
						    }
						?>
						</u></b></h4>
						<?php
						echo $selectedSeller_details[0]['msg_to_buyers_for_digiitem'];
						} ?>
					</div>
				             </div>
				             <div role="tabpanel" class="tab-pane fade" id="profile">
					<?php $i = 1;foreach ($productReview as $review) {
					    if ($i > 4) {break;}
					    if ($review['thumbnail'] != '') {$profile_pic = 'users/thumb/' . $review['thumbnail'];} else { $profile_pic = 'default_avat.png';}
					    # echo "asdfasdf".$added_item_details[0]['seo_url'] ;
					    #echo "review".$review['seo_url'];die;
					    if ($added_item_details[0]['seourl'] == $review['seo_url']) {
					?>
					<div class="feedback-row" id="reviews<?php echo $review['id']; ?>">
						  <div class="col-md-3 feedback-reviewer">
							<a href="view-people/<?php echo ''; ?>"><img src="images/<?php echo $profile_pic; ?>" width="45" height="45" alt="jusa" class="img-circle"></a>
							<p class="feedback-reviewer"><?php if ($this->lang->line('shop_reviewedby') != '') {echo stripslashes($this->lang->line('shop_reviewedby'));} else {
								            echo 'Reviewed by ';
								        }
								?> <a href="view-people/<?php echo $review['userName']; ?>"><?php echo $review['fullname'] . ' ' . $review['last_name']; ?></a></p>
							  </div>
							  <div class="col-md-9 review-commnt">
								<p class="feedback-date"><?php echo date("d M, Y", strtotime($review['dateAdded'])); ?></p>
								<!---<span class="star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>-->
								<span class="reviews star">
									<div class="stars small" style="width: <?php echo $review['rating'] * 17.2 ?>px !important;"> </div>
								</span>
								<br/><br/>
								<p class="feedback-comment" style="display: inline-block;
									width: 100%;
									font-weight: bold;
								line-height: 2;"><?php echo $review['title']; ?></p>
								<p class="feedback-comment"><?php echo $review['description']; ?></p>
								<!--<a href="products/<?php echo $review['seo_url']; ?>" class="review-img">
									<?php $imaArr = explode(',', $review['image']);?>
									<img src="images/product/thumb/<?php echo $imaArr[0]; ?>" width="75" height="75" />
								</a>-->
								<!--<a class="feedback-title" href="products/<?php echo $review['seo_url']; ?>"><?php echo $review['product_name']; ?></a>--> </div>
							</div>
							<?php $i++;}}if ($selectedSeller_details[0]['review_count'] > 4) {
							?>
							<div class="help-bt review-cart-bt">
								<a href="shop-section/<?php echo $selectedSeller_details[0]['seourl']; ?>/reviews"><?php if ($this->lang->line('read_all_revieews') != '') {echo stripslashes($this->lang->line('read_all_revieews'));} else {
									        echo 'Read All Reviews ';
									    }
								?> (<?php echo $selectedSeller_details[0]['review_count']; ?>)</a>
							</div>
							<?php }?>
						            </div>
									<!--
						             <div role="tabpanel" class="tab-pane fade" id="messages">
							                 <div class="shipping-tab">
								<h4 class="processing-time"> <?php if ($this->lang->line('prod_payment') != '') {echo stripslashes($this->lang->line('prod_payment'));} else {
								    echo 'Payment Methods';
								}
								?></h4>
								              <img src="images/front/icon_cc_all.20141104214316.png" width="234" height="23" alt="payment">
								<?php if (($added_item_details[0]['pickup_option'] == 'collection') || ($added_item_details[0]['pickup_option'] == 'delivery-collecion')) {
								?>
								<h4 class="processing-time"> <img src="images/pickup.png" width="" height="" alt="Product Pickup"><?php if ($this->lang->line('prod_local_pickup') != '') {echo stripslashes($this->lang->line('prod_local_pickup'));} else {
								        echo 'This product can be collected locally';
								    }
								?></h4>
								<?php if ($added_item_details[0]['pickup_option'] == 'delivery-collecion') {
								?>
								<span style="font-weight:bold; margin-left:100px;"><?php if ($this->lang->line('collection_or') != '') {echo stripslashes($this->lang->line('collection_or'));} else {
									            echo '(OR)';
									        }
								?></span>
								<?php }?>
								<?php }?>
								<?php if ($subProduct->row()->digital_item == '') {
								?>
								<?php if (($added_item_details[0]['pickup_option'] == 'delivery') || ($added_item_details[0]['pickup_option'] == 'delivery-collecion')) {?>
								  <div class="shipping-information clearfix">
									<?php if ($subProduct->row()->ship_duration == '') {?>
									<h4 class="processing-time"> <?php if ($this->lang->line('shop_shipin') != '') {echo stripslashes($this->lang->line('shop_shipin'));} else {
									        echo 'Ready to ship in';
									    }
									?><?php echo $added_item_details[0]['ship_duration']; ?> </h4>
									<?php }?>
									<span class="estimate-shipping-title"><?php if ($this->lang->line('shipping_costs') != '') {echo stripslashes($this->lang->line('shipping_costs'));} else {
										        echo 'Shipping Costs';
										    }
									?></span>
									                <div class="common-form form-small" id="listing-shipping-estimate">
										    <table class="list-table shipping">
											<thead class="tabbled">
												<tr class="column-headers">
													<th class="shipping-destination"><?php if ($this->lang->line('shop_shipto') != '') {echo stripslashes($this->lang->line('shop_shipto'));} else {
														            echo 'Ship To';
														        }
													?></th>
													<th class="shipping-first-price"><?php if ($this->lang->line('shop_cost') != '') {echo stripslashes($this->lang->line('shop_cost'));} else {
														            echo 'Cost';
														        }
													?></th>
													<th class="shipping-amount"><?php if ($this->lang->line('prod_another') != '') {echo stripslashes($this->lang->line('prod_another'));} else {
														            echo 'With Another Item';
														        }
													?></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($shipping_details as $shippingVals) {?>
												<tr>
													<td class="shipping-area"><?php echo $shippingVals['ship_name']; ?></td>
													<td class="shipping-value">
														<span class="dolar-symbol"><?php echo $currencySymbol; ?></span>
														<span class="dolar-value"><?php echo number_format($currencyValue * $shippingVals['ship_cost'], 2); ?></span>
														<span class="dolar-code currencyType"><?php echo $currencyType; ?></span>
													</td>
													<td class="shipping-value">
														<span class="dolar-symbol"><?php echo $currencySymbol; ?></span>
														<span class="dolar-value"><?php echo number_format($currencyValue * $shippingVals['ship_other_cost'], 2); ?></span>
														<span class="dolar-code currencyType"><?php echo $currencyType; ?></span>
													</td>
												</tr>
												<?php }?>
											   </tbody>
										    </table>
									                </div>
								              </div>
								<?php }}?>
								<?php if ($selectedSeller_details[0]['payment_policy'] != "" || $selectedSeller_details[0]['shipping_policy'] != "" || $selectedSeller_details[0]['refund_policy'] != "" || $selectedSeller_details[0]['additional_information'] != "" || $selectedSeller_details[0]['seller_information'] != "") {
								?>
								<div id="shop-policies">
									<table class="list-table shipping">
										<thead class="tabbled">
											<tr class="column-headers">
												<th class="shipping-destination"><?php if ($this->lang->line('shopsec_policy') != '') {echo stripslashes($this->lang->line('shopsec_policy'));} else {
													        echo 'Policies';
													    }
												?></th>
												<th class="shipping-amount"></th>
											</tr>
										</thead>
										<tbody>
											<?php if ($selectedSeller_details[0]['payment_policy'] != "") {
											?>
											<tr class="column-headers">
												<td class="shipping-destination"><?php if ($this->lang->line('shopsec_payment') != '') {echo stripslashes($this->lang->line('shopsec_payment'));} else {
													            echo 'Payment';
													        }
												?></td>
												<td class="shipping-amount"><?php echo $selectedSeller_details[0]['payment_policy']; ?></td>
											</tr>
											<?php }?>
											<?php if ($selectedSeller_details[0]['shipping_policy'] != "" && $subProduct->row()->digital_item == '') {
											?>
											<tr class="column-headers">
												<td class="shipping-destination"><?php if ($this->lang->line('shopsec_shipping') != '') {echo stripslashes($this->lang->line('shopsec_shipping'));} else {
													            echo 'Shipping';
													        }
												?></td>
												<td class="shipping-amount"><?php echo $selectedSeller_details[0]['shipping_policy']; ?></td>
											</tr>
											<?php }?>
											<?php if ($selectedSeller_details[0]['refund_policy'] != "") {
											?>
											<tr class="column-headers">
												<td class="shipping-destination"><?php if ($this->lang->line('shopsec_refunds') != '') {echo stripslashes($this->lang->line('shopsec_refunds'));} else {
													            echo 'Refunds and Exchanges';
													        }
												?></td>
												<td class="shipping-amount"><?php echo $selectedSeller_details[0]['refund_policy']; ?></td>
											</tr>
											<?php }?>
											<?php if ($selectedSeller_details[0]['additional_information'] != "") {
											?>
											<tr class="column-headers">
												<td class="shipping-destination"><?php if ($this->lang->line('shop_additional') != '') {echo stripslashes($this->lang->line('shop_additional'));} else {
													            echo 'Additional Policies and FAQs';
													        }
												?></td>
												<td class="shipping-amount"><?php echo $selectedSeller_details[0]['additional_information']; ?></td>
											</tr>
											<?php }?>
											<?php if ($selectedSeller_details[0]['seller_information'] != "") {
											?>
											<tr class="column-headers">
												<td class="shipping-destination"><?php if ($this->lang->line('shop_sellerinformation') != '') {echo stripslashes($this->lang->line('shop_sellerinformation'));} else {
													            echo 'Seller Information';
													        }
												?></td>
												<td class="shipping-amount"><?php echo $selectedSeller_details[0]['seller_information']; ?></td>
											</tr>
											<?php }?>
										     </tbody>
									    </table>
								 </div>
								<?php }?>
							            </div>
						          </div>
								  -->
					        </div>
				      </div>
			    </div>
		 </div>
	  </div>
</section>
</div>
<?php //echo("<pre>");print_r($product_list->result());die;
if ($product_list->num_rows() > 0) {
?>
<div id="product_search_div">
	<section class="container">
		  <div id="content">
			        <div class="purchase_review product-search-main">
				            <div class="content-wrap-inner1">
					                    <div id="primary">
						<div id="freewall" class="free-wall" style="margin-bottom: 51px;">
							                            <div id="tiles">
								<?php $productsDetail = $product_list->result_array();
								    if (!empty($productsDetail)) {
								        $i = 0;
								        foreach ($productsDetail as $proddetails) {
								            #echo $i;
								            $imgSplit = explode(",", $proddetails['image']);
								            $shopDet  = $this->product_model->get_business_name($proddetails['user_id']);
								?>
								             <div class="brick">
									                    <div class="brick-hover">
										                                <div class="product_hide">
											                                    <div class="product_fav">
												<?php if ($loginCheck != '') {
												?>
												<?php if ($proddetails['user_id'] == $loginCheck) {?>
												<a href="javascript:void(0);" onclick="return ownProductFav();">
													                                            <input type="submit" value="" class="hoverfav_icon" />
												                                        </a>
												<?php
												} else {
												                    $favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($proddetails['id']));
												                    #print_r($favArr); die;
												if (empty($favArr)) {?>
												<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($proddetails['id']); ?>','Fresh',this);">
													                                            <input type="submit" value="" class="hoverfav_icon" />
												                                        </a>
												<?php } else {?>
												<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($proddetails['id']); ?>','Old',this);">
													                                            <input type="submit" value="" class="hoverfav_icon1" />
												                                        </a>
												<?php }}} else {?>
												                                        <a href="login" >
													                                            <input type="submit" value="" class="hoverfav_icon" />
												                                        </a>
												<?php }?>
											                                    </div>
											                                    <div class="hoverdrop_icon">
												<a href="javascript:hoverView('<?php echo $i; ?>');">  </a>
												<div class="hover_lists" id="hoverlist<?php echo $i; ?>">
													<h2><?php if ($this->lang->line('user_your_lists') != '') {echo stripslashes($this->lang->line('user_your_lists'));} else {
													                echo "Your Lists";
													            }
													?></h2>
													                                                <div class="lists_check">
														<?php foreach ($userLists as $Lists) {
														                $haveListIn = $this->user_model->check_list_products(stripslashes($proddetails['id']), $Lists['id'])->num_rows();
														                #echo $haveListIn;
														                if ($haveListIn > 0) {$chk = 'checked="checked"';} else { $chk = '';}
														?>
														<input type="checkbox" class="check_box" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo stripslashes($proddetails['id']); ?>');" <?php echo $chk; ?> />
														<label><?php echo $Lists['name']; ?></label>
														<?php }?>
														<?php if (!empty($userRegistry)) {
														                $haveRegisryIn = $this->user_model->check_registry_products($proddetails['id'], $userRegistry->user_id)->num_rows();
														                if ($haveRegisryIn > 0) {$chk = 'checked="checked"';} else { $chk = '';}
														?>
														<input type="checkbox" class="check_box" onclick="return manageRegisrtyProduct('<?php echo $userRegistry->user_id; ?>','<?php echo $proddetails['id']; ?>');" <?php echo $chk; ?> />
														<label><span class="registry_icon"></span><?php if ($this->lang->line('prod_wedding') != '') {echo stripslashes($this->lang->line('prod_wedding'));} else {
														                    echo "Wedding Registry";
														                }
													?></label>
													<?php }?>
												                                                    </div>
												                                                    <div class="new_list">
													                                                    <form method="post" action="site/user/add_list">
														                                                        <input type="hidden" value="1" name="ddl" />
														<input type="hidden" value="<?php echo $proddetails['id']; ?>" name="productId" />
														<input type="text" placeholder="<?php if ($this->lang->line('user_new_list') != '') {echo stripslashes($this->lang->line('user_new_list'));} else {
														                echo "New list";
														            }
														?>" class="list_scroll" name="list" id="creat_list_<?php echo $i; ?>" />
														<input type="submit" value="<?php if ($this->lang->line('user_add') != '') {echo stripslashes($this->lang->line('user_add'));} else {
														                echo "Add";
														            }
														?>" class="primary-button" onclick="return validate_create_list('<?php echo $i; ?>');" />
													                                                    </form>
												                                                </div>
											                                        </div>
										                                   </div>
									                               </div>
									<a href="products/<?php echo $proddetails['seourl']; ?>">
										<img  src="<?php if (!empty($imgSplit[0])) {?>images/product/thumb/<?php echo stripslashes($imgSplit[0]);} else {echo "images/dummyProductImage.jpg";} ?>"
										alt="<?php echo stripslashes($proddetails['product_name']); ?>" title="<?php echo stripslashes($proddetails['product_name']); ?>" width="100%" />
									                        </a>
									<?php
									$starttime  = $proddetails['deal_date'] . " " . $proddetails['deal_time_from'];
									            $endatedeal = $proddetails['deal_date_to'] . " " . $proddetails['deal_time_to'];
									            if ($this->config->item('deal_of_day') == 'Yes') {
									                //print_r($proddetails);die;
									                // echo "enddeal". $endatedeal .">=".date("Y-m-d H:i:s");
									                if ($proddetails['action'] == 'DOD' && $proddetails['discount'] != 0 && date('Y-m-d H:i', strtotime($starttime)) <= (date('Y-m-d H:i')) && date('Y-m-d H:i', strtotime($endatedeal)) >= (date('Y-m-d H:i'))) {
									?>
									<div class="offer-tag">
										<p class="off-price"><?php echo $proddetails['discount']; ?>% 0ff</p>
									</div>
									<?php }}?>
								                    </div>
								<?php if ($this->config->item('deal_of_day') == 'Yes') {
								                if ($proddetails['action'] == 'DOD' && $proddetails['discount'] != 0 && date('Y-m-d H:i', strtotime($starttime)) <= date('Y-m-d H:i') && date('Y-m-d H:i', strtotime($endatedeal)) >= (date('Y-m-d H:i'))) {
								?>
								<?php
								                    $style      = "style='text-decoration:line-through;'";
								                    $endatedeal = $proddetails['deal_date_to'] . " " . $proddetails['deal_time_to'];
								                    $offer = ($proddetails['discount'] / 100) * $proddetails['price'];
								                    #echo $offer;
								                    $enddeal = date('Y-m-d H:i:s', strtotime($endatedeal));
								?>
								<!--<div data-countdown="<?php echo $enddeal; ?>" >
								</div>-->
								<?php }} else {
								                $style = '';
								                $offer = 0;
								            }
								?>
								                    <div class="info">
									<h3><?php echo $proddetails['product_name'] ?></h3>
									<span class="cat-name"><a href="shop-section/<?php echo $shopDet->row()->shop_seourl; ?>"><?php echo $shopDet->row()->shop_name ?></a></span>
									 <span class="cat-name cat-price">
										<?php if ($proddetails['price'] != 0.00) {
										?>
										<?php if ($proddetails['action'] == 'DOD' && $this->config->item('deal_of_day') == 'Yes' && date('Y-m-d H:i', strtotime($starttime)) <= date('Y-m-d H:i') && date('Y-m-d H:i', strtotime($endatedeal)) >= (date('Y-m-d H:i'))) {?>
										<span class="currency_value" style="text-decoration:line-through;"><?php echo $currencySymbol;
										echo number_format($currencyValue * $proddetails['price'], 2) ?></span>
										<span class="currency_value" ><?php echo $currencySymbol;
										echo number_format($currencyValue * $proddetails['price'] - $offer, 2) ?></span>
										<?php } else {
										?>
										<span class="currency_value" ><?php echo $currencySymbol;
										echo number_format($currencyValue * $proddetails['price'], 2) ?></span>
										<?php }?>
										<span class="currency_code"><?php echo $currencyType; ?></span>
										<?php } else {
										?>
										<span class="currency_value"><?php echo $currencySymbol;
											                echo number_format($currencyValue * $proddetails['base_price'], 2);
										echo '+'; ?></span>
										<span class="currency_code"><?php echo $currencyType; ?></span>
										<?php }?>
									                    </span>
								</div>
							                </div>
							<?php
							            $i++;}}
							?>
							<?php echo $paginationDisplay; ?>
						                        </div>
					</div>
					<div id="load_ajax_img" style="text-align: center;"></div>
					<script type="text/javascript">
					var wall = new freewall("#freewall");
					wall.reset({
					selector: '.brick',
					animate: true,
					cellW: 230,
					cellH: 'auto',
					onResize: function() {
					wall.fitWidth();
					}
					});
					wall.container.find('.brick img').load(function() {
					wall.fitWidth();
					setTimeout(function(){wall.fitWidth();},100);
					});
					setTimeout(function(){ wall.fitWidth(); }, 100);
					</script>
				                        </div>
			                    </div>
		</div>
	            </div>
        </div>
    </section>
</div>
<?php }?>
<div id="ask_reg" class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
	<form name="contactshopowener" id="contactshopowener" method="post" action="site/user/prddetailaskQues">
		<div style='background:#fff;'>
			<div class="conversation">
				<div class="conversation_container">
					<a href="javascript:void(0);" onclick="javascript:$('#ask-cancel').trigger('click');" style="float: right;margin-right: 2%;">X</a>
					<h2 class="conversation_headline"><?php if ($this->lang->line('new_conversation') != '') {echo stripslashes($this->lang->line('new_conversation'));} else {
					    echo 'New conversation with';
					}
					?> <?php echo ucfirst($selectedSeller_details[0]['full_name']); ?>' <?php if ($this->lang->line('shop_from') != '') {echo stripslashes($this->lang->line('shop_from'));} else {
					    echo 'from';
					}
					?> <?php echo ucfirst($selectedSeller_details[0]['seller_businessname']); ?></h2>
					<div class="conversation_thumb">
						<img width="75" height="75" src="images/users/thumb/<?php echo $Pro_pic; ?>">
					</div>
					<div class="conversation_right">
						<input type="hidden" name="productseourl" id="productseourl" value="<?php echo $added_item_details[0]['seourl']; ?>" >
						<input class="conversation-subject" type="text" name="subject" placeholder="<?php if ($this->lang->line('user_subject') != '') {echo stripslashes($this->lang->line('user_subject'));} else {
						    echo 'Subject';
						}
						?>" value="<?php echo $added_item_details[0]['product_name']; ?>">
						<textarea class="conversation-textarea" rows="11" name="message_text" placeholder="<?php if ($this->lang->line('user_msg_txt') != '') {echo stripslashes($this->lang->line('user_msg_txt'));} else {
						    echo 'Message text';
						}
						?>"><?php if ($this->lang->line('prod_product') != '') {echo stripslashes($this->lang->line('prod_product'));} else {
						    echo 'Product';
						}
						?>: '<?php echo base_url() . 'products/' . $added_item_details[0]['seourl']; ?>'</textarea>
						<input type="hidden" name="productid" id="productid" value="<?php echo $added_item_details[0]['id']; ?>" >
						<input type="hidden" name="productname" id="productname" value="<?php echo $added_item_details[0]['product_name']; ?>" >
						<input type="hidden" name="username" id="username" value="<?php echo $this->session->userdata['shopsy_session_user_name']; ?>" >
						<input type="hidden" name="useremail" id="useremail" value="<?php echo $this->session->userdata['shopsy_session_user_email']; ?>" >
						<input type="hidden" name="userid" id="userid" value="<?php echo $this->session->userdata['shopsy_session_user_id']; ?>" >
						<input type="hidden" name="selleremail" id="selleremail" value="<?php echo $selectedSeller_details[0]['seller_email']; ?>" >
						<input type="hidden" name="sellerid" id="sellerid" value="<?php echo $selectedSeller_details[0]['seller_id']; ?>" >
						<input type="hidden" name="subject_name" id="subject_name" value="New conversation with <?php echo ucfirst($selectedSeller_details[0]['full_name']); ?>' from <?php echo ucfirst($selectedSeller_details[0]['seller_businessname']); ?>">
					</div>
				</div>
				<div class="modal-footer footer_tab_footer">
					<div class="btn-group">
						<input class="submit_btn" type="submit" value="<?php if ($this->lang->line('user_send') != '') {echo stripslashes($this->lang->line('user_send'));} else {
						    echo 'send';
						}
						?>" />
						<a class="btn btn-default submit_btn" data-dismiss="modal" id="ask-cancel"><?php if ($this->lang->line('user_cancel') != '') {echo stripslashes($this->lang->line('user_cancel'));} else {
							    echo 'Cancel';
							}
						?></a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
</div>
</div>
<div id='detailreport_reg' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<form action="spam-report" name="span-form" method="post" onsubmit="return validate_spamreport();">
		<div style='background:#fff;'>
			<div class="conversation">
				<div class="conversation_container">
					<a href="javascript:void(0);" onclick="javascript:$('#report-cancel').trigger('click');">X</a>
					<h5 class="reportspan-head"><?php if ($this->lang->line('shopsec_spam') != '') {echo stripslashes($this->lang->line('shopsec_spam'));} else {
					    echo 'Report Spam';
					}
					?></h5><br /><br />
					<p style="margin:0 0 0 5px"><a target="_blank" href="pages/intellectual-property-policy"><?php if ($this->lang->line('shopsec_property') != '') {echo stripslashes($this->lang->line('shopsec_property'));} else {
						    echo 'This is my intellectual property';
						}
					?>.</a><br />
					<a target="_blank" href="pages/report-a-problem"><?php if ($this->lang->line('shopsec_ordered') != '') {echo stripslashes($this->lang->line('shopsec_ordered'));} else {
						    echo 'I ordered this item and have not received it';
						}
					?>.</a>
				</p>
				<ul>
					<li>
						<input type="radio" value="The item may not comply with <?php echo $this->config->item('email_title'); ?>'s handmade guidelines" name="spam_title" class="spamchk">
						<label> <?php if ($this->lang->line('shopsec_comply') != '') {echo stripslashes($this->lang->line('shopsec_comply'));} else {
							    echo 'The item may not comply with';
							}
							?> <a target="_blank" href="pages/guidelines"><?php echo $this->config->item('email_title'); ?><?php if ($this->lang->line('shopsec_guidelines') != '') {echo stripslashes($this->lang->line('shopsec_guidelines'));} else {
								    echo "'s handmade guidelines";
								}
							?></a> . </label>
						</li>
						<li>
							<input  type="radio" value="The item may not be vintage" name="spam_title" class="spamchk">
							<label> <?php if ($this->lang->line('shopsec_maynot') != '') {echo stripslashes($this->lang->line('shopsec_maynot'));} else {
								    echo "The item may not be";
								}
								?> <a target="_blank" href="pages/guidelines"><?php if ($this->lang->line('shopsec_vintage') != '') {echo stripslashes($this->lang->line('shopsec_vintage'));} else {
									    echo 'vintage';
									}
								?></a> <?php if ($this->lang->line('shopsec_years') != '') {echo stripslashes($this->lang->line('shopsec_years'));} else {
								    echo "(20+ years old)";
								}
							?>. </label>
						</li>
						<li>
							<input  type="radio" value="The item is not a supply for crafting or shipping" name="spam_title" class="spamchk">
							<label> <?php if ($this->lang->line('shopsec_itemnot') != '') {echo stripslashes($this->lang->line('shopsec_itemnot'));} else {
								    echo "The item is not a";
								}
								?> <a target="_blank" href="pages/guidelines"><?php if ($this->lang->line('shopsec_supply') != '') {echo stripslashes($this->lang->line('shopsec_supply'));} else {
									    echo "supply for crafting or shipping";
									}
								?></a> . </label>
							</li>
							<li>
								<input type="radio" value="The item may be prohibited on <?php echo $this->config->item('email_title'); ?>." name="spam_title" class="spamchk">
								<label > <?php if ($this->lang->line('shopsec_itemmay') != '') {echo stripslashes($this->lang->line('shopsec_itemmay'));} else {
									    echo "The item may be";
									}
									?> <a target="_blank" href="pages/prohibited-items"><?php if ($this->lang->line('prod_prohibited') != '') {echo stripslashes($this->lang->line('prod_prohibited'));} else {
										    echo "prohibited";
										}
									?></a> <?php if ($this->lang->line('shop_on') != '') {echo stripslashes($this->lang->line('shop_on'));} else {
									    echo "on";
									}
								?> <?php echo $this->config->item('email_title'); ?>. </label>
							</li>
							<li>
								<input  type="radio" value="The listing is not labeled as mature content." name="spam_title" class="spamchk">
								<label><?php if ($this->lang->line('shopsec_labeled') != '') {echo stripslashes($this->lang->line('shopsec_labeled'));} else {
									    echo "The listing is not labeled as";
									}
									?> <a target="_blank" href="pages/guidelines"><?php if ($this->lang->line('prod_content') != '') {echo stripslashes($this->lang->line('prod_content'));} else {
										    echo "mature content";
										}
									?></a> . </label>
								</li>
								<input type="hidden" name="p_id" value="<?php echo $added_item_details[0]['id']; ?>" id="p_id" />
								<input type="hidden" name="s_id" value="" id="s_id" />
								<input type="hidden" name="p_seourl" value="<?php echo $added_item_details[0]['seourl']; ?>" id="p_seourl" />
							</ul>
							<textarea name="complaint" placeholder="<?php if ($this->lang->line('shopsec_violates') != '') {echo stripslashes($this->lang->line('shopsec_violates'));} else {
							    echo "Please explain why this item violates";
							}
							?> <?php echo $this->config->item('email_title'); ?> <?php if ($this->lang->line('shopsec_policy') != '') {echo stripslashes($this->lang->line('shopsec_policy'));} else {
							    echo "Policies";
							}
							?>." id="spam_text"></textarea>
							<center><span class="error" id="spamErr"></span></center>
							<div class="modal-footer footer_tab_footer">
								<div class="btn-group">
									<input class="submit_btn" type="submit" value="<?php if ($this->lang->line('shopsec_spam') != '') {echo stripslashes($this->lang->line('shopsec_spam'));} else {
									    echo "Report Spam";
									}
									?>" />
									<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php if ($this->lang->line('user_cancel') != '') {echo stripslashes($this->lang->line('user_cancel'));} else {
										    echo 'Cancel';
										}
									?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div id='ownproduct-alert' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			 <div style='background:#fff;'>
				<div class="conversation" style="width: 340px; margin-left: 191px; margin-top: 171px;">
					<div class="conversation_container">
						<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;"> <?php if ($this->lang->line('cant_buy_ur_item') != '') {echo stripslashes($this->lang->line('cant_buy_ur_item'));} else {
						    echo 'Whoa! You can\'t buy your own item.';
						}
						?> </h2>
						<div class="modal-footer footer_tab_footer">
							<div class="btn-group">
								<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"> <?php if ($this->lang->line('land_okay') != '') {echo stripslashes($this->lang->line('land_okay'));} else {
									    echo 'Okay';
									}
								?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id='ownshop_ask' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			 <div style='background:#fff;'>
				<div class="conversation" style="width: 340px; margin-left: 191px; margin-top: 171px;">
					<div class="conversation_container">
						<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;"> <?php if ($this->lang->line('cant_question_ur_shop') != '') {echo stripslashes($this->lang->line('cant_question_ur_shop'));} else {
						    echo 'Whoa!You can\'t question your own shop.';
						}
						?>  </h2>
						<div class="modal-footer footer_tab_footer">
							<div class="btn-group">
								<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php if ($this->lang->line('land_okay') != '') {echo stripslashes($this->lang->line('land_okay'));} else {
									    echo 'Okay';
									}
								?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
        <div style='display:none'>
	        <div id='contact_reg' style=' background: none repeat scroll 0 0 rgba(0, 0, 0, 0.3); border-radius:8px; padding:15px'>
		            <div style="background:#fff;border-radius:8px;">
			                <div class="contact_reg-header">
				<h2><?php if ($this->lang->line('confirm_acct') != '') {echo stripslashes($this->lang->line('confirm_acct'));} else {
				    echo 'Hold on! You still need to confirm your account.';
				}
				?></h2>
				                    <div class="contact_reg-body">
					<p><?php if ($this->lang->line('confirmation_email') != '') {echo stripslashes($this->lang->line('confirmation_email'));} else {
						    echo "We'll resend your confirmation email to";
						}
					?> <?php echo $this->session->userdata['shopsy_session_user_email']; ?>.</p>
				                    </div>
			                </div>
			                <div class="contact_reg-footer">
				<span><input class="resending" type="button" value="<?php if ($this->lang->line('user_cancel') != '') {echo stripslashes($this->lang->line('user_cancel'));} else {
					    echo 'Cancel';
					}
				?>" onclick="javascript:$('#cboxClose').trigger('click');"></span>
				<span><input class="resending" type="submit" value="<?php if ($this->lang->line('prod_resend') != '') {echo stripslashes($this->lang->line('prod_resend'));} else {
					    echo 'Resend Email';
					}
				?>" onClick="return resendConfirmationPopUp('<?php echo $this->session->userdata['shopsy_session_user_email']; ?>');"></span>
			                </div>
		            </div>
	        </div>
    </div>
 <div id='ownshop_report' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			 <div style='background:#fff;'>
				<div class="conversation" style="width: 340px; margin-left: 191px; margin-top: 171px;">
					<div class="conversation_container">
						<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;"><?php if ($this->lang->line('cant_report_ur_shop') != '') {echo stripslashes($this->lang->line('cant_report_ur_shop'));} else {
						    echo 'Whoa!You can\'t report your own shop.';
						}
						?>  </h2>
						<div class="modal-footer footer_tab_footer">
							<div class="btn-group">
								<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php if ($this->lang->line('land_okay') != '') {echo stripslashes($this->lang->line('land_okay'));} else {
									    echo 'Okay';
									}
								?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<a href="#product_add_cart_popup" id="product_add_cart" data-toggle="modal"></a>
 <div id='product_add_cart_popup' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			 <div style='background:#fff;'>
				<div class="conversation" style="width: 64%; margin-left: 191px; margin-top: 171px;">
					<div class="conversation_container">
						<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;"><?php echo af_lg('lg_product_addeed_tocart', 'Product Added to cart'); ?> </h2>
						<div class="modal-footer footer_tab_footer">
							<div class="btn-group">
								<a class="btn btn-default submit_btn" data-dismiss="modal" ><?php echo af_lg('lg_continue_shop', 'Continue Shopping'); ?></a>
								<a class="btn btn-default submit_btn" href="cart"><?php echo af_lg('lg_go_to_checkout', 'Go to Checkout'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
span.label{
color:#000;
}
.quant-input .arrows {
height: 100%;
position: absolute;
right: -100;
top: -4;
z-index: 2;
}
.arrows .arrow {
box-sizing: border-box;
cursor: pointer;
display: block;
margin-left:10px;
text-align: center;
width: 40px;
}
#zoom{
position: fixed !important;
z-index: 9999 !important;
 top: 50px !important;
}
#content #primary {
    float: left;
    padding-top: 0;
    width: 100%;
}
</style>
<script src="js/front/jquery.fancyzoom.js"></script>
<script type="text/javascript" src="js/validation.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery("#prodZoom").fancyZoom();
jQuery('[data-toggle="tooltip"]').tooltip();
jQuery('[data-countdown]').each(function() {
   var $this = $(this), finalDate = jQuery(this).data('countdown');
   $this.countdown(finalDate, function(event) {
 $this.html(event.strftime('%D days %H:%M'));
   });
 });
});
jQuery(window).load(function(){
jQuery('.flexslider').flexslider({
animation: "slide",
controlNav: "thumbnails",
start: function(slider){
jQuery('body').removeClass('loading');
}
});
});
function change_variationone(evt){
var split_val = evt.value;
var variation1 = split_val.split('[<?php echo $currencySymbol ?>');
var variation = variation1[1].split(']');
var currencyVal = '<?php echo $currencyValue ?>';
var price = (parseFloat(variation[0])/parseFloat(currencyVal)).toFixed(2);
$('#price').val($.trim(price));
}
var loading = true;
jQuery(window).scroll(function(){
if(loading==true){
if(($(document).scrollTop()+$(window).height())>($(document).height()-200)){
//wall.fitWidth();
$url = $(document).find('.landing-btn-more').attr('href');
console.log($url);
if($url){
loading = false;
$(document).find('#load_ajax_img').append('<img id="theImg" src="<?php echo base_url(); ?>images/loader64.gif" />');
$.ajax({
type : 'get',
url : $url,
dataType : 'html',
success : function(html){
$html = $($.trim(html));
//console.log($html);
$(document).find('.landing-btn-more').remove();
$(document).find('#tiles').append($html.find('#tiles').html());
$(document).find('#tiles').after($html.find('.landing-btn-more'));
},
error : function(a,b,c){
console.log(c);
},
complete : function(){
//alert("Asdf");
$("#load_ajax_img img:last-child").remove();
loading = true;
}
});
}
}
}
});
</script>
<?php $this->load->view('site/templates/footer');?>