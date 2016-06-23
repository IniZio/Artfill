<?php
$this->load->view('site/templates/header');
$this->load->model('product_model');
$deal_of_day1 = $this->product_model->get_deal_today();
?>
<style>
header{
	margin-bottom: 0px;
}
</style>
<script type="text/javascript" src="js/site/jquery.countdown.js"></script>
<link href="css/animate.css" rel="stylesheet">
<?php if (isset($active_theme) && $active_theme->num_rows() != 0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Home-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>footer.css" rel="stylesheet">
<?php }?>
<!-- deal of the day  -->
<?php
$deal_of_day = $deal_of_day1->result();
if ($this->config->item('deal_of_day') == 'Yes' && $deal_of_day1->num_rows() > 0) {
$n = $deal_of_day1->num_rows();
// if($deal_of_day1->num_rows() > 3){
//     $n=3;
// }
// shuffle($deal_of_day);
?>
<section class="second-bl" style="display:none;">
	<div class="container">
		<h1 class="today-deal"><!--<a href="<?php echo base_url(); ?>search/all?&dealday=today"><?php echo shopsy_lg('lg_Today_Deal', 'Today\'s Deal'); ?><i class="fa fa-caret-right deal-arrow"></i></a>-->今日優惠</h1>
		<div data-countdown="<?php echo date('Y-m-d') . " 23:59:59" ?>" >
			</div><div id="timer"></div>
			<div class="">
				<div class="recent-fav">
					<?php for ($i = 0; $i < $n; $i++) {
					$img = explode(',', $deal_of_day[$i]->image);
					?>
					<div class="col-md-3 rf-bl" style="max-width: 293px; max-height: 369px;">
						<div class="rf-bl-pic">
							<!-- <a href="products/<?php echo $deal_of_day[$i]->seourl; ?>"><img src="images/product/<?php echo $img[0]; ?>" alt="recent"> </a>-->
							<a href="products/<?php echo $deal_of_day[$i]->seourl; ?>"><img src="images/product/cropmed/<?php echo $img[0]; ?>" alt="recent"> </a>
						</div>
						<?php
						$style     = '';
						$dealprice = '0';
						if ($this->config->item('deal_of_day') == 'Yes') {
						$starttime = $deal_of_day[$i]->deal_date . " " . $deal_of_day[$i]->deal_time_from;
						if ($deal_of_day[$i]->action == 'DOD' && $deal_of_day[$i]->discount != 0 && date('Y-m-d H:i', strtotime($starttime)) <= date('Y-m-d H:i')) {
						$offer = ($deal_of_day[$i]->discount / 100);
						if ($deal_of_day[$i]->price != 0.00) {
						$price = $deal_of_day[$i]->price;
						$pls   = '';
						$offer = ($deal_of_day[$i]->discount / 100) * $price;
						} else {
						$price = $deal_of_day[$i]->pricing;
						$pls   = '+';
						$offer = ($deal_of_day[$i]->discount / 100) * $price;
						}
						$dealprice = $price - $offer;
						$style     = "style='text-decoration:line-through;'";
						?>
						<div class="offer-tag">
							<p class="off-price"><?php echo $deal_of_day[$i]->discount; ?>% 0ff</p>
						</div>
						<?php }}?>
						<span class="cat-name">
							<a href="products/<?php echo $deal_of_day[$i]->seourl; ?>"><?php echo character_limiter($deal_of_day[$i]->product_name, 25); ?></a>
						</span>
						<?php if ($deal_of_day[$i]->price != 0.00) {
						$price = $deal_of_day[$i]->price;
						$pls   = '';
						} else {
						$price = $deal_of_day[$i]->pricing;
						$pls   = '+';
						}
						?>
						<span class="cat-name cat-price">
							<a href="products/<?php echo $deal_of_day[$i]->seourl; ?>" <?php echo $style; ?> <?php echo $currencySymbol . number_format($currencyValue * $price, 2) . $pls; ?> <span class="currencyType"> <?php echo $currencyType; ?></span></a><?php if ($dealprice != 0) {?><a><?php echo $currencySymbol . number_format($currencyValue * $dealprice, 2) . $pls; ?><span class="currencyType"> <?php echo $currencyType; ?></span></a><?php }?>
						</span>
						<div class="recent-bl">
						</div>
						<div class="recent-review" style="margin-top: -26px;"  >
							<?php if ($deal_of_day[$i]->thumbnail != '') {$profile_pic = 'users/thumb/' . $deal_of_day[$i]->thumbnail;} else { $profile_pic = 'default_avat.png';}?>
							<img src="images/<?php echo $profile_pic ?>" alt="<?php echo $deal_of_day[$i]->full_name; ?>" width="55px" class="img-circle" >
							<div class="recent-right">
								<p ><?php if ($this->lang->line('user_from') != '') {echo stripslashes($this->lang->line('user_from'));} else {
									echo 'From';
									}
									?> -  <a href="shop-section/<?php echo $deal_of_day[$i]->shop_seourls ?>"> <?php echo $deal_of_day[$i]->full_name; ?></a>
								</p>
								<div   class="rating-input rating readonly-rating" data-score="<?php echo number_format($deal_of_day[$i]->shop_ratting, 2); ?>" ></div>
								<span class="review-txt"> <?php echo $deal_of_day[$i]->review_count; ?> <?php if ($this->lang->line('shopsec_reviews') != '') {echo stripslashes($this->lang->line('shopsec_reviews'));} else {
									echo "Reviews";
									}
								?></span>
							</div>
						</div>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
	</section>
	<?php } // echo("<pre>");print_r($featured_product_details->result());die;
		if ($this->config->item('featured_prod') == 'active' && count($featured_product_details->result()) > 0) {
		?>
		<div id="landing_div">
			<section class="second-bl" style="display:none;">
				  <div class="container">
					<h1><?php echo shopsy_lg('lg_Featured_products', 'Featured Products'); ?></h1>
					<h5><?php /* if($this->lang->line('landing_text') != '') { echo stripslashes($this->lang->line('landing_text')); } else echo 'Discover finds from around the marketplace'; */?> </h5>
					    <div class="">
						      <div class="recent-fav">
							<?php for ($i = 0; $i < count($featured_product_details->result()); $i++) {
							        $img = explode(',', $featured_product_details->row($i)->image);
							?>
							<div class="col-md-4 rf-bl">
								  <div class="rf-bl-pic">
									<!--  <a href="products/<?php echo $featured_product_details->row($i)->seourl; ?>"><img src="images/product/<?php echo $img[0]; ?>" alt="recent"> </a>  -->
									<a href="products/<?php echo $featured_product_details->row($i)->seourl; ?>"><img src="images/product/cropmed/<?php echo $img[0]; ?>" alt="recent"> </a>
								  </div>
								<?php
								$style     = "";
								        $dealprice = '0';
								        if ($this->config->item('deal_of_day') == 'Yes') {
								            $starttime  = $featured_product_details->row($i)->deal_date . " " . $featured_product_details->row($i)->deal_time_from;
								            $endatedeal = $featured_product_details->row($i)->deal_date_to . " " . $featured_product_details->row($i)->deal_date_to;
								            if ($featured_product_details->row($i)->action == 'DOD' && $featured_product_details->row($i)->discount != 0 && date('Y-m-d H:i', strtotime($starttime)) <= strtotime(date('Y-m-d H:i')) && date('Y-m-d H:i', strtotime($endatedeal)) >= strtotime(date('Y-m-d H:i'))) {
								                $offer = ($featured_product_details->row($i)->discount / 100);
								                if ($featured_product_details->row($i)->price != 0.00) {
								                    $price = $featured_product_details->row($i)->price;
								                    $pls   = '';
								                    $offer = ($featured_product_details->row($i)->discount / 100) * $price;
								                } else {
								                    $price = $featured_product_details->row($i)->base_price;
								                    $pls   = '+';
								                    $offer = ($featured_product_details->row($i)->discount / 100) * $price;
								                }
								                $dealprice = $price - $offer;
								                $style     = "style='text-decoration:line-through;padding: 8px;float: left;'";
								?>
								<div class="offer-tag">
									<p class="off-price"><?php echo $featured_product_details->row($i)->discount; ?>% 0ff</p>
								</div>
								<?php }}?>
								          <span class="cat-name">
									<a href="products/<?php echo $featured_product_details->row($i)->seourl; ?>"><?php echo character_limiter($featured_product_details->row($i)->product_name, 25); ?></a>
								  </span>
								<?php if ($featured_product_details->row($i)->price != 0.00) {
								            $price = $featured_product_details->row($i)->price;
								            $pls   = '';
								        } else {
								            $price = $featured_product_details->row($i)->base_price;
								            $pls   = '+';
								        }
								?>
								  <span class="cat-name cat-price">
									<a href="products/<?php echo $featured_product_details->row($i)->seourl; ?>" <?php echo $style; ?> <?php echo $currencySymbol . number_format($currencyValue * $price, 2) . $pls; ?> <span class="currencyType"> <?php echo $currencyType; ?></span></a>
									<?php if ($dealprice != 0) {?>
									&nbsp;&nbsp;&nbsp;<a style='font-size:large;margin-top: 5px;' ><?php echo $currencySymbol . number_format($currencyValue * $dealprice, 2) . $pls; ?> <span class="currencyType"><?php echo $currencyType; ?> </span></a>
									<?php }?>
								</span>
								  <div class="recent-bl">
								          </div>
								    <div class="recent-review" style="margin-top: -26px;"  >
									<?php if ($featured_product_details->row($i)->thumbnail != '') {$profile_pic = 'users/thumb/' . $featured_product_details->row($i)->thumbnail;} else { $profile_pic = 'default_avat.png';}?>
									<img src="images/<?php echo $profile_pic ?>" alt="<?php echo $featured_product_details->row($i)->full_name; ?>" width="55px" class="img-circle" >
									            <div class="recent-right">
										<p ><?php if ($this->lang->line('user_from') != '') {echo stripslashes($this->lang->line('user_from'));} else {
											            echo 'From';
											        }
											?> -  <a href="shop-section/<?php echo $featured_product_details->row($i)->shop_seourls ?>"> <?php echo $featured_product_details->row($i)->full_name; ?></a>
										                </p>
										<div   class="rating-input rating readonly-rating" data-score="<?php echo number_format($featured_product_details->row($i)->shop_ratting, 2); ?>" ></div>
										<span class="review-txt"> <?php echo $featured_product_details->row($i)->review_count; ?> <?php if ($this->lang->line('shopsec_reviews') != '') {echo stripslashes($this->lang->line('shopsec_reviews'));} else {
											            echo "Reviews";
											        }
										?></span>
									              </div>
								          </div>
							        </div>
							<?php }?>
						      </div>
					    </div>
				  </div>
			</section>
			<?php }?>
			<?php
			//echo "<pre>"; print_r($new_promote); die;
				//foreach($recentpromote->result() as $testiMoni){
				//if( $new_promote->seller_banner!=''){
				if ($this->config->item('testimonial') == 'active' && $new_promote->id != '') { /*
				?>
				<section class="testimonial-img" >
					<?php  if($new_promote->seller_banner !=''){ ?>
					<img class="middel-banner" src="images/banner/<?php echo $new_promote->seller_banner; ?>"   alt="<?php echo $new_promote->user_name; ?>" >
					<?php
					}
					else{?>
					<img src="images/fullview01.jpg" style="width:1350px;height: 350px;"   alt="<?php echo $new_promote->user_name; ?>" >
					<?php }?>
					<div class="testimonial-block container">
						<div class="testi-in col-md-10">
							<span class="testi">
								<?php if($new_promote->thumbnail!=''){
								$tuser_pic='users/thumb/'.$new_promote->thumbnail;
								}else{
								$tuser_pic='default_avat.png';
								} ?>
								<!--<a href="view-profile/<?php echo $new_promote->user_name; ?>"> -->
								<img src="images/<?php echo $tuser_pic;?>" alt<?php echo $new_promote->user_name; ?> class="img-circle  ct-clock-img">
								<!--</a>-->
							</span>
							<h3><a href="<?php echo base_url().'blog/'.$new_promote->post_name; ?>"  target="_blank"><?php echo $new_promote->post_title; ?></a> </h3>
							<span class="owner-details">
								<em><?php echo shopsy_lg('lg_meet','Meet');?></em>
								<a class="shop-name" href="shop-section/<?php echo $new_promote->seourl; ?>">
									<span class="user-name"><?php echo $new_promote->full_name; ?></span> of <?php echo $new_promote->shop_title; ?>
								</a>
								<?php
								$promote_city = $new_promote->city;
								if ($new_promote->country != '' && $new_promote->country != '0'){
								if ($promote_city != '' && $promote_city != '0'){
								$promote_city .= ', '.$new_promote->country;
								} else {
								$promote_city = $new_promote->country;
								}
								}
								if ($promote_city=='0'){
								$promote_city = '';
								}
								if ($promote_city!=''){
								?>
								<em>in</em>
								<span class="location"><?php echo $promote_city; ?></span>
								<?php }?>
							</span>
						</div>
					</div>
				</section>
				<?php */}
				//}?>
				<?php if ($this->config->item('featured_shop') == 'active') {?>
				<section class="third-bl">
					<div class="container">
						<h1><br/></h1>
						<!--<h1><?php //echo shopsy_lg('lg_Featured_shop','Featured shops');?></h1>-->
						<style>
						.sub-box{
						border:thin solid black;
						width:80%;
						height:50px;
						text-align:center;
						top:-30px;
						background-color:#ffffff;
						position:relative;
						margin-left:auto;
						margin-right:auto;
						}
						</style>
						<!--
						<a href="coming-soon">
							<div class="col-md-3" style="overflow:hidden;">
								<img src="./images/editor_pick.png" />
								<div class="sub-box" style="">
									Artfill 商店
								</div>
							</div>
						</a>
						<a href="coming-soon">
							<div class="col-md-3">
								<img src="./images/editor_pick2.png" />
								<div class="sub-box" style="">
									新到貨品<br/>
									逢星期二更新
								</div>
							</div>
						</a>
						<a href="coming-soon">
							<div class="col-md-3">
								<img src="./images/editor_pick3.png" />
								<div class="sub-box" style="">
									SALE 減價優惠
								</div>
							</div>
						</a>
						<a href="coming-soon">
							<div class="col-md-3">
								<img src="./images/editor_pick4.png" />
								<div class="sub-box" style="">
									深刻購物體驗
								</div>
							</div>
						</a>
						-->
						<ul class="hme-container col-md-12">
							<?php /*$i=0;//echo "<pre>"; print_r($featured_shop_details->result()); die;
								    foreach($featured_shop_details->result() as $UsersPick){
								    if($i== "0"){
								?>
								    <li class="col-md-6">
									<a href="shop-section/<?php echo $UsersPick->seourl; ?>">
										    <div class="image-container">
											<?php if($UsersPick->seller_banner != ""){?>
											<img src="images/banner/<?php echo $UsersPick->seller_banner; ?>">
											<?php } else{?>
											    <img src="images/dummyProductImage.jpg">
											<?php }?>
										    </div>
									    </a>
									    <div class="shop-text-box">
										<?php if($UsersPick->thumbnail != ""){?>
										<img  src="images/users/<?php echo $UsersPick->thumbnail; ?>" altgary="" class="shop-text-box-img">
										<?php }else{?>
										    <img src="images/users/user-thumb1.png" altgary="" class="shop-text-box-img">
										<?php }?>
										<span><?php echo $UsersPick->user_name; ?></span>
									    </div>
								</li> <?php } if($i== "1"){?>
								    <li class="col-md-3">
									<a href="shop-section/<?php echo $UsersPick->seourl; ?>">
										    <div class="image-container">
											<?php if($UsersPick->seller_banner != ""){?>
											<img src="images/banner/<?php echo $UsersPick->seller_banner; ?>">
											<?php } else{?>
											    <img src="images/dummyProductImage.jpg">
											<?php }?>
										    </div>
									    </a>
									    <div class="shop-text-box">
										<?php if($UsersPick->thumbnail != ""){?>
										<img  src="images/users/<?php echo $UsersPick->thumbnail; ?>" altgary="" class="shop-text-box-img">
										<?php }else{?>
										    <img src="images/users/user-thumb1.png" altgary="" class="shop-text-box-img">
										<?php }?>
										<span><?php echo $UsersPick->user_name; ?></span>
									    </div>
								    </li>
								<?php } if($i== "2"){?>
								    <li class="col-md-3 height-min">
									<a href="shop-section/<?php echo $UsersPick->seourl; ?>">
										    <div class="image-container">
											<?php if($UsersPick->seller_banner != ""){?>
											<img src="images/banner/<?php echo $UsersPick->seller_banner; ?>">
											<?php } else{?>
											    <img src="images/dummyProductImage.jpg">
											<?php }?>
										    </div>
									    </a>
									    <div class="shop-text-box">
										<?php if($UsersPick->thumbnail != ""){?>
										<img  src="images/users/<?php echo $UsersPick->thumbnail; ?>" altgary="" class="shop-text-box-img">
										<?php }else{?>
										    <img src="images/users/user-thumb1.png" altgary="" class="shop-text-box-img">
										<?php }?>
										<span><?php echo $UsersPick->user_name; ?></span>
									    </div>
								    </li>
								<?php }  if($i== "3"){?>
								    <li class="col-md-3 height-min">
									<a href="shop-section/<?php echo $UsersPick->seourl; ?>">
										    <div class="image-container">
											<?php if($UsersPick->seller_banner != ""){?>
											<img src="images/banner/<?php echo $UsersPick->seller_banner; ?>">
											<?php } else{?>
											    <img src="images/dummyProductImage.jpg">
											<?php }?>
										    </div>
									    </a>
									    <div class="shop-text-box">
										<?php if($UsersPick->thumbnail != ""){?>
										<img  src="images/users/<?php echo $UsersPick->thumbnail; ?>" altgary="" class="shop-text-box-img">
										<?php }else{?>
										    <img src="images/users/user-thumb1.png" altgary="" class="shop-text-box-img">
										<?php }?>
										<span><?php echo $UsersPick->user_name; ?></span>
									    </div>
								    </li>
								<?php }  if($i== "4"){ ?>
								    <li class="col-md-3">
									<a href="shop-section/<?php echo $UsersPick->seourl; ?>">
										    <div class="image-container">
											<?php if($UsersPick->seller_banner != ""){?>
											<img src="images/banner/<?php echo $UsersPick->seller_banner; ?>">
											<?php } else{?>
											    <img src="images/dummyProductImage.jpg">
											<?php }?>
										    </div>
									    </a>
									    <div class="shop-text-box">
										<?php if($UsersPick->thumbnail != ""){?>
										<img  src="images/users/<?php echo $UsersPick->thumbnail; ?>" altgary="" class="shop-text-box-img">
										<?php }else{?>
										    <img src="images/users/user-thumb1.png" altgary="" class="shop-text-box-img">
										<?php }?>
										<span><?php echo $UsersPick->user_name; ?></span>
									    </div>
								    </li>
								<?php }  if($i== "5"){?>
								    <li class="col-md-6">
									<a href="shop-section/<?php echo $UsersPick->seourl; ?>">
										    <div class="image-container">
											<?php if($UsersPick->seller_banner != ""){?>
											<img src="images/banner/<?php echo $UsersPick->seller_banner; ?>">
											<?php } else{?>
											    <img src="images/dummyProductImage.jpg">
											<?php }?>
										    </div>
									    </a>
									    <div class="shop-text-box">
										<?php if($UsersPick->thumbnail != ""){?>
										<img  src="images/users/<?php echo $UsersPick->thumbnail; ?>" altgary="" class="shop-text-box-img">
										<?php }else{?>
										    <img src="images/users/user-thumb1.png" altgary="" class="shop-text-box-img">
										<?php }?>
										<span><?php echo $UsersPick->user_name; ?></span>
									    </div>
								    </li>
								<?php } if($i== "6"){?>
								    <li class="col-md-3">
									<a href="shop-section/<?php echo $UsersPick->seourl; ?>">
										    <div class="image-container">
											<?php if($UsersPick->seller_banner != ""){?>
											<img src="images/banner/<?php echo $UsersPick->seller_banner; ?>">
											<?php } else{?>
											    <img src="images/dummyProductImage.jpg">
											<?php }?>
										    </div>
									    </a>
									    <div class="shop-text-box">
										<?php if($UsersPick->thumbnail != ""){?>
										<img  src="images/users/<?php echo $UsersPick->thumbnail; ?>" altgary="" class="shop-text-box-img">
										<?php }else{?>
										    <img src="images/users/user-thumb1.png" altgary="" class="shop-text-box-img">
										<?php }?>
										<span><?php echo $UsersPick->user_name; ?></span>
									    </div>
								    </li>
								<?php } $i++; }*/?>
							</ul>
						</div>
					</section>
					<?php }?>
					<?php if ($this->config->item('top_seller') == 'active' && count($maxfavourite->result()) > 0) { /* ?>
					<section class="second-bl third-bl">
						<div class="container">
							<h1><?php echo shopsy_lg('lg_top_seller','Top Sellers');?></h1>
							<div class="col-md-12 ct-block-cover-outside">
								<?php  //echo "<pre>"; print_r($maxfavourite->result()); die;
									foreach($maxfavourite->result() as $FavourPick){
									?>
									<div class="ct-block-cover">
										<div class="tastemaker-desc">
											<?php if($FavourPick->thumbnail != ""){?>
											<img class="img-circle ct-clock-img"  src="images/users/<?php echo $FavourPick->thumbnail; ?>">
											<?php }else{?>
											<img class="img-circle ct-clock-img"  src="images/users/user-thumb1.png">
											<?php }?>
											<p class="tastemaker-name">
											<a class="member-name" href="shop-section/<?php echo $FavourPick->seourl; ?>"><?php echo $FavourPick->seller_firstname; ?> </p>
										</div>
										<div class="col-md-3  ct-block animateblock left">
											<?php  $product_details2=$this->product_model->get_fav_product_details($FavourPick->seller_id);
											//echo("<pre>");print_r($product_details2->result());die;
												//for($i=0;$i<count($product_details());$i++){
												for($i=0;$i<4;$i++){
												//echo("<br><br>".$product_details2->row($i)->image."hghg");
												if( $i < count($product_details2->result()) ){
												$img= explode(',', $product_details2->row($i)->image);
												?>
												<div class="ct-img" >
													<a href="shop-section/<?php echo $FavourPick->seourl; ?>" class="favorite-<?php echo $i; ?>">
														<!-- <div style="width=126px;height=92px;">    <img src="images/product/thumb/<?php echo $img[0]; ?>" width="126px" height="92px"  alt="<?php echo $product_details2->row($i)->product_name; ?>"></div> -->
														<div style="width=126px;height=92px;">    <img src="images/product/cropsmall/<?php echo $img[0]; ?>" width="126px" height="92px"  alt="<?php echo $product_details2->row($i)->product_name; ?>"></div>
													</a>
												</div>
												<?php }else{
												$img[0]= "dummyProductImage.jpg"; ?>
												<div class="ct-img" >
													<a href="shop-section/<?php echo $FavourPick->seourl; ?>" class="favorite-<?php echo $i; ?>">
														<div style="width=126px;height=92px;"><img  width="126px" height="92px"  ></div>
													</a>
												</div>
												<?php }
												?>
												<?php } ?>
												<span class="ct-txt">
													<h3> <?php echo $FavourPick->seller_firstname; ?></h3>
													<p> <?php echo $FavourPick->new_id; ?> <?php echo shopsy_lg('lg_fav','Favourites');?></p>
												</span> <i class="fa fa-chevron-circle-right arrow-ic"></i>
											</div>
										</div>
										<?php }
										//}?>
									</div>
								</div>
							</section>
							<?php */}?>
							<?php
    if ($this->config->item('recent_prod') == 'active' && count($recent_product_details->result()) > 0) {
        ?>
		<section class="second-bl">
		  <div class="container">
			<h1 class="today-deal">熱門商品</h1>
			    <div class="row">
					<div class="recent-fav" >
					<?php
for ($i = 0; $i < count($recent_product_details->result()); $i++) {
$img = explode(',', $recent_product_details->row($i)->image);
?>
					<div class="col-lg-4 col-sm-4 col-xs-6">
						<div class=" rf-bl hoverrf-bl">
							<div class="rf-blheader">
								<div class="carousel slide" data-ride="carousel" id="<?php echo 'productCarousel' . $i; ?>">
									<!-- Wrapper for slides -->
									<div class="carousel-inner" role="listbox" style="max-width: 205px !important; max-height: 203px !important;">
										<div class="item active">
											<a  href="products/<?php echo $recent_product_details->row($i)->product_seourl; ?>"><img src="images/product/cropmed/<?php echo $img[0]; ?>" alt="recent" style="max"> </a>
										</div>
										<?php foreach (array_slice($img,1) as $element) { ?>
											<div class="item">
												<a href="products/<?php echo $recent_product_details->row($i)->product_seourl; ?>"><img src="images/product/cropmed/<?php echo $element; ?>" alt="recent" style="max"> </a>
											</div>
										<?php } ?>
									</div>
		                            <a class="left carousel-control" data-slide="prev" href="<?php echo '#productCarousel' . $i; ?>" role="button">
			                                <span aria-hidden="true" class="glyphicon glyphicon-chevron-left">
			                                </span>
			                                <span class="sr-only">
				                                    Previous
			                                </span>
		                            </a>
		                            <a class="right carousel-control" data-slide="next" href="<?php echo '#productCarousel' . $i; ?>" role="button">
			                                <span aria-hidden="true" class="glyphicon glyphicon-chevron-right">
			                                </span>
			                                <span class="sr-only">
				                                    Next
			                                </span>
		                            </a>
	                            </div>
	                        </div>
	                        <!-- owner avatar -->
	                        <div class="col-md-6 col-md-offset-3 col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 avatar"> 
	                        	<?php if ($recent_product_details->row($i)->thumbnail != '') {$profile_pic = 'users/thumb/' . $recent_product_details->row($i)->thumbnail;} else { $profile_pic = 'default_avat.png';}?>
	                        	<img src="images/<?php echo $profile_pic ?>" alt="<?php echo $recent_product_details->row($i)->full_name; ?>" width="55px"  />
	                        </div>
	                        <div class="info" style="display: block;">
	                        	<!-- product name -->
    							<div class="title text-center" style="font-size: medium;">
    								<a href="products/<?php echo $recent_product_details->row($i)->product_seourl; ?>" alt="<?php echo character_limiter($recent_product_details->row($i)->product_name, 25); ?>"><?php echo character_limiter($recent_product_details->row($i)->product_name, 25); ?></a>
    							</div>
    							<div class="desc row" style="font-size:large;position: absolute;bottom: 0;left: 0;right: 0">
    							    <div class="col-md-8 col-xs-7">
    							    	<?php
											$style     = 'style="font-size:medium;"';
								            $dealprice = '0';
								            if ($this->config->item('deal_of_day') == 'Yes') {
								                $starttime  = $recent_product_details->row($i)->deal_date . " " . $recent_product_details->row($i)->deal_time_from;
								                $endatedeal = $recent_product_details->row($i)->deal_date_to . " " . $recent_product_details->row($i)->deal_time_to;
								                if ($recent_product_details->row($i)->action == 'DOD' && $recent_product_details->row($i)->discount != 0 && date('Y-m-d H:i', strtotime($starttime)) <= date('Y-m-d H:i') && date('Y-m-d H:i', strtotime($endatedeal)) >= strtotime(date('Y-m-d H:i'))) {
								                    $offer = ($recent_product_details->row($i)->discount / 100);
								                    if ($recent_product_details->row($i)->price != 0.00) {
								                        $price = $recent_product_details->row($i)->price;
								                        $pls   = '';
								                        $offer = ($recent_product_details->row($i)->discount / 100) * $price;
								                    } else {
								                        $price = $recent_product_details->row($i)->base_price;
								                        $pls   = '+';
								                        $offer = ($recent_product_details->row($i)->discount / 100) * $price;
								                    }
								                    $dealprice = $price - $offer;
								                    $style     = "style='text-decoration:line-through;padding: 8px;float: left;'";
								?>
														<div class="offer-tag">
															<p class="off-price"><?php echo $recent_product_details->row($i)->discount; ?>% Off</p>
														</div>
														<?php }}?>
													<?php if ($recent_product_details->row($i)->price != 0.00) {
													                $price = $recent_product_details->row($i)->price;
													                $pls   = '';
													            } else {
													                $price = $recent_product_details->row($i)->base_price;
													                $pls   = '+';
													}?>
														<a href="products/<?php echo $recent_product_details->row($i)->product_seourl; ?>" <?php echo $style; ?>> <?php echo $currencySymbol . number_format($currencyValue * $price, 2) . $pls; ?> <span class="currencyType"> <?php echo $currencyType; ?> <span> </a> &nbsp;&nbsp; <?php if ($dealprice != 0) {?><a style='font-size:large;margin-top: 5px;'><?php echo $currencySymbol . number_format($currencyValue * $dealprice, 2) . $pls; ?> <span class="currencyType"> <?php echo $currencyType; ?> <span></a><?php }?>
    							    </div>
    							    <!-- recent reviews -->
    							    <div class="col-md-4 col-md-offset-0 col-xs-offset-1 col-xs-4 desc" style="text-align: right;">
    							        <?php echo $recent_product_details->row($i)->review_count; ?> <?php if ($this->lang->line('shopsec_reviews') != '') {echo stripslashes($this->lang->line('shopsec_reviews'));} else {
    							                        echo "Reviews";}?>
    							    </div>
    							</div>
    						</div>
    						<div class="info" style="display: none;">
    							<!-- owner name and later details -->
    						    <div class="title text-center">
    						        <a href="shop-section/<?php echo $recent_product_details->row($i)->seourl ?>"> <?php echo $recent_product_details->row($i)->full_name; ?>
    						        </a>
    						    </div>
    						</div>
    					</div>
					</div>
					<?php }?>
					</div>
		    	</div>
	  		</div>
		</section>
			<?php }?>

						<?php if ($this->config->item('app_store_link') != "" || $this->config->item('play_store_link') != "") {?>
						<section>
							<div class="bottom-phone-main">
								<div class="container">
									<div class="bottom-phone-bg"><img src="images/site/section-footer.png"></div>
									<div class="bottom-phone-content-main">
										<div class="bottom-phone-content">
											<h1><?php echo $this->config->item('email_title'); ?></h1>
											<h2><?php echo shopsy_lg('lg_For_your_phone', 'For Your Phone'); ?></h2>
											<ul>
												<?php if ($this->config->item('app_store_link') != "") {?>
												<li><a href="<?php echo $this->config->item('app_store_link'); ?>" target="blank"><img src="images/site/apple.png"></a></li>
												<?php }if ($this->config->item('play_store_link') != "") {?>
												<li><a href="<?php echo $this->config->item('play_store_link'); ?>" target="blank"><img src="images/site/android.png"></a></li>
												<?php }?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</section>
						<?php }?>
						<script type="text/javascript">
						 $(document).ready(function() {
						    $("#emailtext").blur(function() {
						 $("#msgbox").html('');
						var a = $("#emailtext").val();
						var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
						if(filter.test(a)) {
						        //remove all the class add the messagebox classes and start fading
						        //$("#msgbox").removeClass().addClass('messagebox').text('Checking...').fadeIn("slow");
						        //check the username exists or not from ajax keyup mouseout
						        $.post("site/user/check_user_availability",{ emaill:$(this).val() } ,function(data) {
						            if(data=='no') {
						                $("#msgbox").fadeTo(200,0.1,function() {  //start fading the messagebox
						                    //add message and change the class of the box and start fading
						                    $(this).html('Email Id is Already exists').addClass('messageboxerror').fadeTo(900,1);
						                });
						            }
						            else if(data=='yes') {
						                $("#msgbox").fadeTo(200,0.1,function() {  //start fading the messagebox
						                    //add message and change the class of the box and start fading
						                    $(this).html('Email Id is Available').addClass('messageboxok').fadeTo(900,1);
						                });
						            }
						        });
						}
						/*else{
						$("#msgbox").fadeTo(200,0.1,function() {  //start fading the messagebox
						//add message and change the class of the box and start fading
						$(this).html('Please enter valid email id').addClass('messageboxerror').fadeTo(900,1);
						});
						}*/
						    });
						/*$('.rating.readonly-rating').raty({
						readOnly: true,
						path:'js/img',
						score: function() {
						return $(this).attr('data-score');
						}
						 });
						*/
						});
						</script>
						<script>
        $('.avatar').click(function(){
    if ($(this).next('.info').css('display') == 'block'){
    $(this).next('.info').css('display', 'none');
    $(this).next('.info').next('.info').addClass('animated fadeIn');
    $(this).next('.info').next('.info').css('display', 'block');
    } else {
    $(this).next('.info').addClass('animated fadeIn');
    $(this).next('.info').css('display', 'block');
    $(this).next('.info').next('.info').css('display', 'none');
    }
    });
    </script>
						<?php $this->load->view('site/templates/footer');?>
						<script type="text/javascript">
						$(function(){
						  var $elems = $('.animateblock');
						  var winheight = $(window).height();
						  var fullheight = $(document).height();
						  $(window).scroll(function(){
						    animate_elems();
						  });
						  function animate_elems() {
						    wintop = $(window).scrollTop(); // calculate distance from top of window
						    // loop through each item to check when it animates
						    $elems.each(function(){
						      $elm = $(this);
						      if($elm.hasClass('animated')) { return true; } // if already animated skip to the next item
						      topcoords = $elm.offset().top; // element's distance from top of page in pixels
						      if(wintop > (topcoords - (winheight*.75))) {
						        // animate when top of the window is 3/4 above the element
						        $elm.addClass('animated');
						      }
						    });
						  } // end animate_elems()
						});
						</script>
						