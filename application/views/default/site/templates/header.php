<?php
$this->load->view('site/templates/commonheader');
$this->load->model('user_model');
#echo $CurrUserImg;die;
?>
<?php
if ($CurrUserImg != '') {
    $user_pic = 'users/thumb/' . $CurrUserImg;
} else {
    $user_pic = 'default_avat.png';
}
?>

<!-- START UNUSED STYLE to be deleted -->
<style>
#you1{
	background-image:url("<?php echo base_url() . "images/" . $user_pic; ?>");
	background-position:center;
	border-radius: 50%;
	box-shadow: 0 0 1px rgba(0, 0, 0, 0.5);
	float: left;
	height: 31px !important;
	margin-top: 0;
	vertical-align: middle;
	width: 31px;
	background-size: cover;
}
</style>
<!-- END UNUSED STYLE to be deleted -->

</head>
                <div class="errorContainer" id="message-red" style="position:fixed;top:0;">
                  <!-- <script>setTimeout("hideErrDiv('<?php echo $this->session->flashdata('sErrMSGType'); ?>')", 5000);</script> -->
                  <p><span> <?php echo af_lg('no_real_transactions', '現為封測版，所有交易不涉及真實金錢及貨品'); ?> </span></p>
                </div>
 		<?php
if ($this->session->flashdata('sErrMSG') != '') {?>
                <div class="errorContainer" id="<?php echo $this->session->flashdata('sErrMSGType'); ?>">
                  <script>setTimeout("hideErrDiv('<?php echo $this->session->flashdata('sErrMSGType'); ?>')", 5000);</script>
                  <p><span> <?php echo $this->session->flashdata('sErrMSG'); ?> </span></p>
                </div>
   		 <?php }?>
<body>
<!-- header_start -->
 <header>
 <div class="header_top animated bounceInDown hidden-xs" style="position:relative;">
		<?php if ($this->session->userdata['shopsy_session_user_name'] == '' || true) {
    ?>
			<div class="container top">
				<div class="row" style="margin-top:40px;">    <!-- padding-bottom:30px;magrin-bottom:30px;margin-top:40px;"> -->
				    <!--<div class="col-md-12 signin sign-mobile">
					     <a href="register"><?php if ($this->lang->line('headind_register') != '') {echo stripslashes($this->lang->line('headind_register'));} else {
        echo 'Register';
    }
    ?></a> | <a href="login"><?php if ($this->lang->line('headind_sign_in') != '') {echo stripslashes($this->lang->line('headind_sign_in'));} else {
        echo 'Sign in';
    }
    ?></a>

						 <span class="shop-cart">
						<a href="cart" title =" Cart"><i class="fa fa-shopping-cart"></i><?php if ($this->lang->line('heading_cart') != '') {echo stripslashes($this->lang->line('heading_cart'));} else {
        echo 'Cart';
    }
    ?>
						<span id="CartCount1" class="CartCount1"> <?php if ($MiniCartViewSet > 0) {?><?php echo $MiniCartViewSet; ?><?php } else {echo '0';}?></span>
						</a>
						</span>
				    </div>-->
					<!--new elements-->
					<div class="hidden-xs">
						<a href="<?php echo base_url(); ?>" title="<?php echo af_lg('lg_home', 'Home'); ?>"><span style="color:white;">首頁</span></a>
						<span style="color:white;">&emsp;|&emsp;</span>
						<a href="pages/about-us"><span style="color:white;">關於我們</span></a>
						<span style="color:white;">&emsp;|&emsp;</span>
						<a href="faq"><span style="color:white;">常見問題</span></a>
						<span style="color:white;">&emsp;|&emsp;</span>
						<a href="coming-soon"><span style="color:white;">購物指南</span></a>
						<span style="color:white;">&emsp;|&emsp;</span>
						<a href="shop/sell"><span style="color:white;">立即開店</span></a>
						<span style="color:white;">&emsp;</span>
						<a data-toggle="modal" id="language_href" href="#Language" onclick="javascript:$('#languageTab').trigger('click');">
						<img src="./images/zh.png" style="width:30px;" />
						</a>
					</div>

					<div class="col-xs-12" style="text-align:center;width:100%;padding-top:5px;padding-bottom: 5px">
						<a href="."><img src="./images/<?php echo $this->config->item('logo_image'); ?>" alt="<?php echo $this->config->item('email_title'); ?>" title="<?php echo $this->config->item('email_title'); ?>" style="width:20%;min-width:200px;" /></a>
					</div>

					<div style="clear:both;padding-top:30px;padding-bottom:30px;">
					</div>


					<div class="" style="width:100%;padding-bottom:20px;">
						<div class="col-xs-6 col-sm-3 header-menu" style="text-align:center;">
							<div style="width:100%;" >
								<div style="">
								<a href="search/vintage/4-clothing?" style="color:#8dbad4">
								<span style="padding:5px;font-size:120%;">衣物配件</span>
								</a>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-3 header-menu" style="text-align:center;">
							<div style="width:100%;" >
								<div style="">
								<a href="search/supplies?" style="color:#8dbad4">
								<span style="padding:5px;font-size:120%;">工藝用品</span>
								</a>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-3 header-menu" style="text-align:center;">
							<div style="width:100%;" >
								<div style="">
								<a href="search/all?min_price=0&max_price=100" style="color:#8dbad4">
								<span style="padding:5px;font-size:120%;">100元內筍貨</span>
								</a>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-3 header-menu" style="text-align:center;">
							<div style="width:100%;" >
								<div style="">
								<a href="search/supplies/11-tailor-made?" style="color:#8dbad4">
								<span style="padding:5px;font-size:120%;">度身訂做</span>
								</a>
								</div>
							</div>
						</div>
					</div>


				</div>
				<!--
				<div class="row">

					<div class="col-md-2 col-xs-2" id="logo">
						<a href="<?php echo base_url(); ?>">
							<img src="images/logo/<?php echo $this->config->item('logo_image'); ?>" alt="<?php echo $this->config->item('email_title'); ?>" title="<?php echo $this->config->item('email_title'); ?>" />
						</a>
					</div>
					<div class="col-md-3 search-bl col-xs-6">
						<form name="search" action="search/all" method="get">
							<input type="text" class="search" name="item" placeholder="<?php if ($this->lang->line('temp_srchitems') != '') {echo stripslashes($this->lang->line('temp_srchitems'));} else {
        echo 'Search for items and shops';
    }
    ?>" value="<?php if ($this->input->get('item') != '') {echo htmlspecialchars($this->input->get('item'));}?>" id="search_items" autocomplete="off" >
							<?php if ($this->input->get('gift_cards') == 'on') {?>
							<input type="hidden" name="gift_cards" value="<?php echo $gift; ?>" /> <?php }?>
							 <?php if ($minVal != '') {?>
							<input type="hidden" name="min_price" value="<?php echo $minVal; ?>" /> <?php }?>
								 <?php if ($maxVal != '') {?>
							<input type="hidden" name="max_price" value="<?php echo $maxVal; ?>" /> <?php }?>
							<?php if ($locVal != '') {?>
							<input type="hidden" name="location" value="<?php echo $locVal; ?>" /> <?php }?>
							<?php if ($shipVal != '') {?>
							<input type="hidden" name="shipto" value="<?php echo $shipVal; ?>" /> <?php }?>
							<input type="submit" value="<?php echo af_lg('heading_search', 'Search'); ?>" class="search-bt">
						</form>
						<div id="sugglist"></div>
					</div>
				<?php if ($this->config->item('mega_menu') == 'No') {
        ?>
					<div class="btn-group col-md-1 act-browse-bt">
						<button type="button" class="btn btn-default dropdown-toggle browse " data-toggle="dropdown" aria-expanded="false">
							<?php if ($this->lang->line('heading_browse') != '') {echo stripslashes($this->lang->line('heading_browse'));} else {
            echo 'Browse';
        }
        ?>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<?php $p = 0;
        foreach ($mainCategories->result() as $row) {
            if ($row->cat_name != '') {
                if ($p <= 14) {

                    //$commentData = $this->category_model->get_all_counts($row->id,'');
                    //if($commentData[0]['disp']>0){
                    ?>
							<li><a href="category-list/<?php echo $row->id; ?>-<?php echo $row->seourl; ?>"><?php echo $row->cat_name; ?></a></li>
							<?php
//}
                } else {
                    ?>
								<li><a href="<?php echo base_url() . 'category'; ?>"><?php if ($this->lang->line('com_more') != '') {echo stripslashes($this->lang->line('com_more'));} else {
                        echo "More";
                    }
                    ?></a></li>

								<?php
break;}
                $p++;
            }
        }
        ?>
						</ul>
					</div>
				<?php }?>
                      <div class="col-md-2 pull-right signin cart-top">

						  <span class="shop-cart">
							<a href="cart"  title =" Cart"><i class="fa fa-shopping-cart icon-shopping"></i></a>
							<a class="cart-txt" href="cart" title="Cart">
								<?php if ($this->lang->line('comm_cart') != '') {echo stripslashes($this->lang->line('comm_cart'));} else {
        echo 'Cart';
    }
    ?>
								<span id="CartCount1" class="CartCount1"> <?php if ($MiniCartViewSet > 0) {?><?php echo $MiniCartViewSet; ?><?php } else {echo '0';}?></span>
							</a>
							</span>

					    </div>
					<div class="col-md-5 col-xs-5 top-login">
						<ul class="header_menu">
							<li>
								<a href="<?php echo base_url(); ?>" id="home" title="<?php echo af_lg('lg_home', 'Home'); ?>">
									<span class="icon-text"><?php if ($this->lang->line('landing_home') != '') {echo stripslashes($this->lang->line('landing_home'));} else {
        echo 'Home';
    }
    ?></span>
								</a>
							</li>
							<li>
								<a href="shop/sell" id="shop" title="<?php echo af_lg('lg_you_shop', 'You Shop'); ?>">
									<span class="icon-text"><?php if ($this->lang->line('header_shop') != '') {echo stripslashes($this->lang->line('header_shop'));} else {
        echo 'Shop';
    }
    ?></span>

								</a>

							</li>

							<li>
								<a id="location" href="shop-by-location" title =" Search by location">
								<span class="icon-text"><?php if ($this->lang->line('header_search_shops') != '') {echo stripslashes($this->lang->line('header_search_shops'));} else {
        echo 'By Location';
    }
    ?></span>
								</a>

							</li>

							<?php if ($this->uri->segment(1) == 'register' || $this->uri->segment(1) == 'login') {
        ?>

							<li>

								<a id="register" href="register"><span class="icon-text"><?php if ($this->lang->line('user_register') != '') {echo stripslashes($this->lang->line('user_register'));} else {
            echo 'Register';
        }
        ?></span></a>

							</li>


							<li>

								<a id="signin-icon" href="login"><span class="icon-text"><?php if ($this->lang->line('user_signin') != '') {echo stripslashes($this->lang->line('user_signin'));} else {
            echo 'Sign In';
        }
        ?></span></a>

							</li>

							<?php } else {
        ?>

							<li>

								<a id="register" data-toggle="modal" href="#signin" onclick="javascript:$('#registerTab').trigger('click');"><span class="icon-text"><?php if ($this->lang->line('user_register') != '') {echo stripslashes($this->lang->line('user_register'));} else {
            echo 'Register';
        }
        ?></span></a>

							</li>


							<li>

								<a id="signin-icon" data-toggle="modal" href="#signin" onclick="javascript:$('#loginTab').trigger('click');"><span class="icon-text"><?php if ($this->lang->line('user_signin') != '') {echo stripslashes($this->lang->line('user_signin'));} else {
            echo 'Sign In';
        }
        ?></span></a>

							</li>

							<?php }?>




						</ul>


						</div>-->

					  <!--<?php if ($this->uri->segment(1) == 'register' || $this->uri->segment(1) == 'login') {
        ?>
						  <a  href="register"><?php if ($this->lang->line('user_register') != '') {echo stripslashes($this->lang->line('user_register'));} else {
            echo 'Register';
        }
        ?></a> <span class="btn">
					     <a  href="login"><?php if ($this->lang->line('user_signin') != '') {echo stripslashes($this->lang->line('user_signin'));} else {
            echo 'Sign In';
        }
        ?></a></span>
					  <?php } else {
        ?>
					     <a data-toggle="modal" href="#signin" onclick="javascript:$('#registerTab').trigger('click');"><?php if ($this->lang->line('user_register') != '') {echo stripslashes($this->lang->line('user_register'));} else {
            echo 'Register';
        }
        ?></a> <span class="btn">
					     <a data-toggle="modal" href="#signin" onclick="javascript:$('#loginTab').trigger('click');"><?php if ($this->lang->line('user_signin') != '') {echo stripslashes($this->lang->line('user_signin'));} else {
            echo 'Sign In';
        }
        ?></a></span>
					  <?php }?>-->


					<!--
				</div>
				-->
			</div>

		<?php } else {
    ?>

			 <div class="container top">
				<div class="row">
				 <!--
				<div class="col-md-12 signin sign-mobile">
						<span class="shop-cart" >
							<a href="cart" title ="cart"><i class="fa fa-shopping-cart icon-shopping"></i> <?php if ($this->lang->line('comm_cart') != '') {echo stripslashes($this->lang->line('comm_cart'));} else {
        echo 'Cart';
    }
    ?>
							<span id="CartCount1" class="CartCount1"> <?php if ($MiniCartViewSet > 0) {?><?php echo $MiniCartViewSet; ?><?php } else {echo '0';}?></span>
						</a>
						</span>
				</div>-->


				  <!--
				     <div class="col-md-2 col-xs-2" id="logo">
						<a href="<?php echo base_url(); ?>">
							<img src="images/logo/<?php echo $this->config->item('logo_image'); ?>"  alt="<?php echo $this->config->item('email_title'); ?>" title="<?php echo $this->config->item('email_title'); ?>">
						</a>
				     </div>

				   <div class="col-md-3 search-bl col-xs-6 ">
						<form name="search" action="search/all" method="get">
							<input type="text" class="search" name="item" placeholder="<?php if ($this->lang->line('temp_srchitems') != '') {echo stripslashes($this->lang->line('temp_srchitems'));} else {
        echo 'Search for items and shops';
    }
    ?>" value="<?php if ($this->input->get('item') != '') {echo htmlspecialchars($this->input->get('item'));}?>" id="search_items" autocomplete="off" >
							<?php if ($this->input->get('gift_cards') == 'on') {?>
							<input type="hidden" name="gift_cards" value="<?php echo $gift; ?>" /> <?php }?>
							 <?php if ($minVal != '') {?>
							<input type="hidden" name="min_price" value="<?php echo $minVal; ?>" /> <?php }?>
								 <?php if ($maxVal != '') {?>
							<input type="hidden" name="max_price" value="<?php echo $maxVal; ?>" /> <?php }?>
							<?php if ($locVal != '') {?>
							<input type="hidden" name="location" value="<?php echo $locVal; ?>" /> <?php }?>
							<?php if ($shipVal != '') {?>
							<input type="hidden" name="shipto" value="<?php echo $shipVal; ?>" /> <?php }?>
							<input type="submit" value="<?php if ($this->lang->line('heading_search') != '') {echo stripslashes($this->lang->line('heading_search'));} else {
        echo 'Search';
    }
    ?>" class="search-bt">
						</form>
						<div id="sugglist"></div>
				  </div>-->



				<?php if ($this->config->item('mega_menu') == 'No') {
        ?>
				<!--
				 <div class="btn-group col-md-1 act-browse-bt col-xs-6">
					<button type="button" class="btn btn-default dropdown-toggle browse " data-toggle="dropdown" aria-expanded="false"> <?php if ($this->lang->line('heading_browse') != '') {echo stripslashes($this->lang->line('heading_browse'));} else {
            echo 'Browse';
        }
        ?>
						<span class="caret"></span>
					</button>
							<ul class="dropdown-menu" role="menu">

								<?php
$p = 0;
        foreach ($mainCategories->result() as $row) {
            if ($row->cat_name != '') {
                if ($p <= 14) {

                    //$commentData = $this->category_model->get_all_counts($row->id,'');
                    //if($commentData[0]['disp']>0){
                    ?>
							<li><a href="category-list/<?php echo $row->id; ?>-<?php echo $row->seourl; ?>"><?php echo $row->cat_name; ?></a></li>
							<?php
//}
                } else {
                    ?>
								<li><a href="<?php echo base_url() . 'category'; ?>"><?php echo $recentFavorites[0]['full_name']; ?> <em><?php if ($this->lang->line('com_more') != '') {echo stripslashes($this->lang->line('com_more'));} else {
                        echo "More";
                    }
                    ?></a></li>

								<?php
break;}
                $p++;
            }
        }
        ?>
						</ul>
				 </div>-->
				 <?php }?>

				 <!--<div class="col-md-2 pull-right signin cart-top">  -->
						<!--<i class="fa fa-bell"></i>-->
						 <!--<span class="shop-cart">
						     <a href="cart" title="cart"><i class="fa fa-shopping-cart icon-shopping"></i> </a>
						     <a class="cart-txt" href="cart"><?php if ($this->lang->line('heading_cart') != '') {echo stripslashes($this->lang->line('heading_cart'));} else {
        echo 'Cart';
    }
    ?>
							<span id="CartCount1" class="CartCount1"> <?php if ($MiniCartViewSet > 0) {?><?php echo $MiniCartViewSet; ?><?php } else {echo '0';}?></span>
							 </a>
						</span>
					 </div>-->

				  <!--
				    <div class="col-md-5 col-xs-5 top-login">

						<ul class="header_menu">


							<li>
								<a href="<?php echo base_url(); ?>home" id="home" title="<?php echo af_lg('lg_home', 'Home'); ?>">
									<span class="icon-text"><?php if ($this->lang->line('landing_home') != '') {echo stripslashes($this->lang->line('landing_home'));} else {
        echo 'Home';
    }
    ?></span>
								</a>
							</li>

							<li>
								<a id="favorites" href="people/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>/favorites" title="<?php echo af_lg('lg_favorites', 'Favorites'); ?>">
									<span class="icon-text"><?php if ($this->lang->line('landing_favorites') != '') {echo stripslashes($this->lang->line('landing_favorites'));} else {
        echo 'Favorites';
    }
    ?></span>
								</a>
							</li>

							<li>
								<a href="shop/sell" id="shop" title="<?php echo af_lg('lg_you_shop', 'You Shop'); ?>">
									 <?php if ($curruserGroup == 'Seller') {
        ?>
									<span class="icon-text"><?php if ($this->lang->line('landing_your_shop') != '') {echo stripslashes($this->lang->line('landing_your_shop'));} else {
            echo 'Your Shop';
        }
        ?></span>
									<?php } else {
        ?>
									<span class="icon-text"><?php if ($this->lang->line('landing_sell') != '') {echo stripslashes($this->lang->line('landing_sell'));} else {
            echo 'Sell';
        }
        ?></span>
									<?php }?>
								</a>

							</li>

							<li>
								<a id="location" href="shop-by-location" title ="Search by location">
								<span class="icon-text"><?php if ($this->lang->line('header_search_shops') != '') {echo stripslashes($this->lang->line('header_search_shops'));} else {
        echo 'By Location';
    }
    ?></span>
								</a>

							</li>

							<li>-->
										<!--<div class="drop_right_main">
											<div class="user_img">
												<img src="images/default_avat.png">
											</div>
											<div class="drop_right"><strong>shunmugapriya</strong><span><a href="view-profile/shunmugapriya" class="view-btn1">View Profile</a></span></div>
										</div>-->
									<!--
								<a class="dropdown-toggle browse "  data-toggle="dropdown" id="you1" title="<?php echo af_lg('lg_you', 'You'); ?>">
									<span class="icon-text">
									<?php echo af_lg('lg_you', 'You'); ?>

									<?php if ($notificationCount > 0) {?>
									<span class="notification-count" id="notificationCount"><?php echo $notificationCount; ?></span>
									<?php }?>
									</span>
									<i></i>
								</a>-->

							<?php //echo $CurrUserImg; die; ?>
								<ul class="dropdown-menu browse-nav-inner showlist2" role="you">
											<span class="menuarrow"></span>
									 <li class="first">
										<div class="drop_right_main">
											<div class="user_img">
												<?php
if ($CurrUserImg != '') {
        $user_pic = 'users/thumb/' . $CurrUserImg;
        #die;
    } else {
        $user_pic = 'default_avat.png';
    }
    ?>
											<img src="images/<?php echo $user_pic; ?>" />
											</div>

											<!-- <div class="drop_right"><strong><?php echo $this->session->userdata['shopsy_session_user_name']; ?></strong><span><a href="view-profile/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>" class="view-btn1"><?php if ($this->lang->line('landing_view_profile') != '') {echo stripslashes($this->lang->line('landing_view_profile'));} else {
        echo 'View Profile';
    }
    ?></a></span></div> -->
											<div class="drop_right"><strong><?php echo $this->session->userdata['shopsy_session_user_name']; ?></strong><span><a href="public-profile" class="view-btn1"><?php if ($this->lang->line('landing_view_profile') != '') {echo stripslashes($this->lang->line('landing_view_profile'));} else {
        echo 'View Profile';
    }
    ?></a></span></div>
										</div>
									</li>
									<li><a style="padding: 0 20px;" href="activity">
									<small><?php if ($this->lang->line('activity_count') != '') {echo stripslashes($this->lang->line('activity_count'));} else {
        echo 'Activity';
    }
    ?></small>
									<?php if ($userActivityCount > 0) {?>
									<span class="activity-count"><?php echo $userActivityCount; ?></span>
									<?php }?>
									</a>
									</li>

									<?php if ($notificationCount > 0) {
        ?>
									<li>
										<a onclick="return clear_notyfi();" style="padding: 0 20px;" href="<?php echo $this->session->userdata['shopsy_session_user_name']; ?>/notifications">
										<small><?php if ($this->lang->line('notify_notifications') != '') {echo stripslashes($this->lang->line('notify_notifications'));} else {
            echo 'Notifications';
        }
        ?></small>
										<span class="notification-list-count"><?php echo $notificationCount; ?></span>
										</a>
									</li>
									<?php }?>

									<!--pull-down-menu-->

									<!--
									<li><a href="purchase-review"><?php if ($this->lang->line('user_purchases') != '') {echo stripslashes($this->lang->line('user_purchases'));} else {
        echo 'Purchases';
    }
    ?></a></li>
									<li><a href="reviews"><?php if ($this->lang->line('lg_reviews') != '') {echo stripslashes($this->lang->line('lg_reviews'));} else {
        echo 'Reviews';
    }
    ?></a></li>
									<li><a href="disputes"><?php if ($this->lang->line('lg_disputes') != '') {echo stripslashes($this->lang->line('lg_disputes'));} else {
        echo 'Disputes';
    }
    ?></a></li>
									<li><a href="manage-community"><?php if ($this->lang->line('comm_community') != '') {echo stripslashes($this->lang->line('comm_community'));} else {
        echo 'Manage Community';
    }
    ?></a></li>
									<li><a href="public-profile"><?php if ($this->lang->line('user_pub_profile') != '') {echo stripslashes($this->lang->line('user_pub_profile'));} else {
        echo 'Public Profile';
    }
    ?></a></li>
									<li><a href="settings/my-account/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>"><?php if ($this->lang->line('landing_account_ettings') != '') {echo stripslashes($this->lang->line('landing_account_ettings'));} else {
        echo 'Account Settings';
    }
    ?></a></li>

									<li class="last"><a href="logout"><?php if ($this->lang->line('sign_out') != '') {echo stripslashes($this->lang->line('sign_out'));} else {
        echo 'Sign Out';
    }
    ?></a></li>
									-->
								</ul>
							</li>
						</ul>

				    </div>




				</div>

			</div>

		<?php }?>


		<!--another new elements-->

		<!--<div>
		<hr/>
		</div>-->


		<script>
		$(function(){
			var menu = $('.header_fixed_menu'), pos = menu.offset();

			$(window).scroll(function(){
				//$('.header_fixed_menu').css({"position":"fixed"});
				//alert("haha");
				if($(this).scrollTop() > pos.top){
					//alert("haha");
					$('.header_fixed_menu').css({"position":"fixed"});
						//$('#menu').addClass('header_top');
				} else if($(this).scrollTop() <= pos.top ){
					//alert("hehe");
					$('.header_fixed_menu').css({"position":"relative"});
						//$('#menu').removeClass('header_top');
				}else{
					//alert("hoho");
				}
				//alert("hohi");
			});
		});
		</script>
		</div>
		<div class="header_top header_fixed_menu hidden-xs" style="background-image:none;position:relative;height:40px">
				<div class="container top">
				<div class="row">

					<div class="col-md-4 search-bl col-xs-12">
						<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="col-md-3 col-sm-4 vcenter text-right"><a href="search/all" style="color:#8dbad4; font-weight: bold;font-size:150%;">分類</a></div>
						<div class="col-md-9 col-sm-8 vcenter"><form name="search" action="search/all" method="get" style="padding: 0;width: 100%;"> <!--style="width:80%;"> -->
							<div class="input-group">
								<input type="text" class="search" name="item" placeholder="<?php if ($this->lang->line('temp_srchitems') != '') {echo stripslashes($this->lang->line('temp_srchitems'));} else {
    echo 'Search for items and shops';
}
?>" value="<?php if ($this->input->get('item') != '') {echo htmlspecialchars($this->input->get('item'));}?>" id="search_items" autocomplete="off" />
								<div class="input-group-btn">
									<button type="submit" class="btn btn-default search-bt"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
							<?php if ($this->input->get('gift_cards') == 'on') {?>
							<input type="hidden" name="gift_cards" value="<?php echo $gift; ?>" /> <?php }?>
							 <?php if ($minVal != '') {?>
							<input type="hidden" name="min_price" value="<?php echo $minVal; ?>" /> <?php }?>
								 <?php if ($maxVal != '') {?>
							<input type="hidden" name="max_price" value="<?php echo $maxVal; ?>" /> <?php }?>
							<?php if ($locVal != '') {?>
							<input type="hidden" name="location" value="<?php echo $locVal; ?>" /> <?php }?>
							<?php if ($shipVal != '') {?>
							<input type="hidden" name="shipto" value="<?php echo $shipVal; ?>" /> <?php }?>						<!--
							<input type="submit" value="      " class="search-bt" style="color:white;background-image:url('./images/magnifier.png');background-size: 70%;background-repeat: no-repeat;" /> -->

							<ul id="suggestions" class="results"></ul>
						</form>
						</div>
						</div>
						<div id="sugglist"></div>
					</div>
				<?php if ($this->config->item('mega_menu') == 'No') { /*?>
<div class="btn-group col-md-1 act-browse-bt">
<button type="button" class="btn btn-default dropdown-toggle browse " data-toggle="dropdown" aria-expanded="false">
<?php if($this->lang->line('heading_browse') != '') { echo stripslashes($this->lang->line('heading_browse')); } else echo 'Browse'; ?>
<span class="caret"></span>
</button>
<ul class="dropdown-menu" role="menu">
<?php $p=0;
foreach ($mainCategories->result() as $row){
if ($row->cat_name != ''){
if($p<=14){

//$commentData = $this->category_model->get_all_counts($row->id,'');
//if($commentData[0]['disp']>0){
?>
<li><a href="category-list/<?php echo $row->id;?>-<?php echo $row->seourl;?>"><?php echo $row->cat_name;?></a></li>
<?php
//}
}else{ ?>
<li><a href="<?php echo base_url().'category'; ?>"><?php if($this->lang->line('com_more') != '') { echo stripslashes($this->lang->line('com_more')); } else echo "More"; ?></a></li>

<?php
break; }
$p++;
}
}
?>
</ul>
</div>
<?php */}?>

				<style>
					.hot{
						color:#c8b0b0;
						font-size:120%;
						border-bottom:thin solid #c8b0b0;;
					}
				</style>
						<div class="col-md-3 col-xs-3 col-sm-5 hidden-xs" style="text-align: left;">
							<span style="color:#c5c6c6;font-size:150%;">熱門搜尋﹕</span>
							<a href="<?php echo base_url(); ?>./search/all?item=陶瓷"><span class="hot">陶瓷</span></a>
							<a href="<?php echo base_url(); ?>./search/all?item=花瓶"><span class="hot">花瓶</span></a>
							<a href="<?php echo base_url(); ?>./search/all?item=頸鍊"><span class="hot">頸鍊</span></a>
						 <!--<span class="shop-cart">
							<a href="cart"  title =" Cart"><i class="fa fa-shopping-cart icon-shopping"></i></a>
							<a class="cart-txt" href="cart" title="Cart">
								<?php if ($this->lang->line('comm_cart') != '') {echo stripslashes($this->lang->line('comm_cart'));} else {
        echo 'Cart';
    }
    ?>
								<span id="CartCount1" class="CartCount1"> <?php if ($MiniCartViewSet > 0) {?><?php echo $MiniCartViewSet; ?><?php } else {echo '0';}?></span>
							</a>
						</span> -->

					    </div>

					<div class="col-md-2 col-xs-3 top-login">
						<ul class="header_menu">
						<!--
							<li>
								<a href="<?php echo base_url(); ?>" id="home" title="<?php echo af_lg('lg_home', 'Home'); ?>">
									<span class="icon-text"><?php if ($this->lang->line('landing_home') != '') {echo stripslashes($this->lang->line('landing_home'));} else {
        echo 'Home';
    }
    ?></span>
								</a>
							</li>
							<li>
								<a href="shop/sell" id="shop" title="<?php echo af_lg('lg_you_shop', 'You Shop'); ?>">
									<span class="icon-text"><?php if ($this->lang->line('header_shop') != '') {echo stripslashes($this->lang->line('header_shop'));} else {
        echo 'Shop';
    }
    ?></span>

								</a>

							</li>
							<li>
								<a id="location" href="shop-by-location" title =" Search by location">
								<span class="icon-text"><?php if ($this->lang->line('header_search_shops') != '') {echo stripslashes($this->lang->line('header_search_shops'));} else {
        echo 'By Location';
    }
    ?></span>
								</a>

							</li>
						-->

							<?php if ($this->session->userdata['shopsy_session_user_name'] != '') {
        ?>
							<li>
								<a class="dropdown-toggle browse" data-toggle="dropdown"><img src="./images/user-silhouette.png" style="width:20px;" /><span style=" font-weight: bold;font-size:120%;margin-left:5px;vertical-align: middle;">你好，<?php echo $this->session->userdata['shopsy_session_user_name']; ?></span></a>

								<ul class="dropdown-menu browse-nav-inner showlist2" role="you">
											<span class="menuarrow"></span>
									 <li class="first">
										<div class="drop_right_main">
											<div class="user_img">
												<?php
if ($CurrUserImg != '') {
            $user_pic = 'users/thumb/' . $CurrUserImg;
            #die;
        } else {
            $user_pic = 'default_avat.png';
        }
        ?>
											<img src="images/<?php echo $user_pic; ?>" />
											</div>

											<!-- <div class="drop_right"><strong><?php echo $this->session->userdata['shopsy_session_user_name']; ?></strong><span><a href="view-profile/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>" class="view-btn1"><?php if ($this->lang->line('landing_view_profile') != '') {echo stripslashes($this->lang->line('landing_view_profile'));} else {
            echo 'View Profile';
        }
        ?></a></span></div> -->
											<div class="drop_right"><strong><?php echo $this->session->userdata['shopsy_session_user_name']; ?></strong><span><a href="public-profile" class="view-btn1"><?php if ($this->lang->line('landing_view_profile') != '') {echo stripslashes($this->lang->line('landing_view_profile'));} else {
            echo 'View Profile';
        }
        ?></a></span></div>
										</div>
									</li>
									<li><a style="padding: 0 20px;" href="activity">
									<small><?php if ($this->lang->line('activity_count') != '') {echo stripslashes($this->lang->line('activity_count'));} else {
            echo 'Activity';
        }
        ?></small>
									<?php if ($userActivityCount > 0) {?>
									<span class="activity-count"><?php echo $userActivityCount; ?></span>
									<?php }?>
									</a>
									</li>

									<?php if ($notificationCount > 0) {
            ?>
									<li>
										<a onclick="return clear_notyfi();" style="padding: 0 20px;" href="<?php echo $this->session->userdata['shopsy_session_user_name']; ?>/notifications">
										<small><?php if ($this->lang->line('notify_notifications') != '') {echo stripslashes($this->lang->line('notify_notifications'));} else {
                echo 'Notifications';
            }
            ?></small>
										<span class="notification-list-count"><?php echo $notificationCount; ?></span>
										</a>
									</li>
									<?php }?>

									<!--pull-down-menu-->


									<li><a href="shop/sell">我的商店</a></li>

									<li><a href="purchase-review"><?php if ($this->lang->line('user_purchases') != '') {echo stripslashes($this->lang->line('user_purchases'));} else {
            echo 'Purchases';
        }
        ?></a></li>
									<li><a href="reviews"><?php if ($this->lang->line('lg_reviews') != '') {echo stripslashes($this->lang->line('lg_reviews'));} else {
            echo 'Reviews';
        }
        ?></a></li>
									<li><a href="disputes"><?php if ($this->lang->line('lg_disputes') != '') {echo stripslashes($this->lang->line('lg_disputes'));} else {
            echo 'Disputes';
        }
        ?></a></li>
									<li><a href="manage-community"><?php if ($this->lang->line('comm_community') != '') {echo stripslashes($this->lang->line('comm_community'));} else {
            echo 'Manage Community';
        }
        ?></a></li>
									<li><a href="public-profile"><?php if ($this->lang->line('user_pub_profile') != '') {echo stripslashes($this->lang->line('user_pub_profile'));} else {
            echo 'Public Profile';
        }
        ?></a></li>
									<li><a href="settings/my-account/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>"><?php if ($this->lang->line('landing_account_ettings') != '') {echo stripslashes($this->lang->line('landing_account_ettings'));} else {
            echo 'Account Settings';
        }
        ?></a></li>

									<li class="last"><a href="logout"><?php if ($this->lang->line('sign_out') != '') {echo stripslashes($this->lang->line('sign_out'));} else {
            echo 'Sign Out';
        }
        ?></a></li>

								</ul>



								<!--<ul class="dropdown-menu browse-nav-inner showlist2" role="you">
											<span class="menuarrow"></span>
									<li class="first">
										<div class="drop_right_main">
											<div class="user_img">-->
												<?php
if ($CurrUserImg != '') {
            $user_pic = 'users/thumb/' . $CurrUserImg;
            #die;
        } else {
            $user_pic = 'default_avat.png';
        }
        ?><!--
											<img src="images/<?php echo $user_pic; ?>" />
											</div>-->

											<!-- <div class="drop_right"><strong><?php echo $this->session->userdata['shopsy_session_user_name']; ?></strong><span><a href="view-profile/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>" class="view-btn1"><?php if ($this->lang->line('landing_view_profile') != '') {echo stripslashes($this->lang->line('landing_view_profile'));} else {
            echo 'View Profile';
        }
        ?></a></span></div> -->
											<!--<div class="drop_right"><strong><?php echo $this->session->userdata['shopsy_session_user_name']; ?></strong><span><a href="public-profile" class="view-btn1"><?php if ($this->lang->line('landing_view_profile') != '') {echo stripslashes($this->lang->line('landing_view_profile'));} else {
            echo 'View Profile';
        }
        ?></a></span></div>
										</div>
									</li>
									<li><a href="shop/sell">我的商店</a></li>
									<li><a href="purchase-review">設定</a></li>
									<li class="last"><a href="logout">登出</a></li>


								</ul>		-->
							</li>
							<?php } else {?>
							<li>
								<a data-toggle="modal" href="#signin"><img src="./images/shape.png" style="width:20px;" /><span style=" font-weight: bold;font-size:120%;margin-left:5px;">登入</span></a>
							</li>

							<li>
								<a data-toggle="modal" href="#signup"><img src="./images/notes.png" style="width:20px;" /><span style=" font-weight: bold;font-size:120%;margin-left:5px;">註冊</span></a>
							</li>
							<?php }?>

							<li>

							<a class="cart-txt" href="cart" title="Cart">
							<img src="./images/commerce.png" style="width:20px;" /><span style=" font-weight: bold;font-size:120%;margin-left:10px;">購物車</span>
								<span id="CartCount1" class="CartCount1" style="vertical-align: middle;"> <?php if ($MiniCartViewSet > 0) {?><?php echo $MiniCartViewSet; ?><?php } else {echo '0';}?></span>
							</a>
							</li>



						</ul>


						</div>


				</div>
				</div>








</div>
<?php if ($this->config->item('mega_menu') == 'Yes' && false) { /*?>
<div class="below-header clearfix">
<div class="hero1">
<div class="container">
<div class="clickablemenu ttmenu dark-style menu-red-gradient">
<div class="navbar navbar-default" role="navigation">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span> <span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>
<!-- end navbar-header -->

<div class="navbar-collapse collapse">
<?php $MainCat = $this->user_model->get_all_details(CATEGORY,array('status'=>'Active','rootID'=>'0'))?>
<ul class="nav navbar-nav">
<?php foreach($MainCat->result() as $_MainCat){
if($_MainCat->sub_mega_menu == "Yes"){
?>
<?php
if($_MainCat->image!=''){
$catImg = $_MainCat->image;
}else{
$catImg = "dummy-category.png";
}
?>
<li class="dropdown ttmenu-full"> <a href="category-list/<?php echo $_MainCat->id;?>-<?php echo $_MainCat->cat_name; ?>" class="dropdown-toggle"><?php echo $_MainCat->cat_name; ?></a>
<?php $SubCat = $this->user_model->get_all_details(CATEGORY,array('status'=>'Active','rootID'=>$_MainCat->id));
if($SubCat->num_rows() != 0){
?>
<ul id="first-menu" class="dropdown-menu">
<li>
<div class="ttmenu-content">
<div class="tabbable row">
<div class="col-md-3">

<ul class="nav nav-pills nav-stacked">
<?php $x = 0;?>
<?php foreach($SubCat->result() as $_SubCat){
if($_SubCat->sub_mega_menu == "Yes"){
?>
<li class="<?php if($x ==0){?>active<?php }?>"><a href="search/all/<?php echo $_MainCat->id;?>-<?php echo $_MainCat->cat_name; ?>/<?php echo $_SubCat->id;?>-<?php echo $_SubCat->cat_name; ?>#tabs5-pane<?php echo $_SubCat->id;?>" ><?php echo $_SubCat->cat_name;?></a></li>
<?php $x++; ?>
<?php }} ?>
</ul>

</div>
<div class="col-md-9">
<div class="tab-content">
<?php $count = 1;?>
<?php

foreach($SubCat->result() as $_SubCat){
if($_SubCat->sub_mega_menu == "Yes"){
?>
<div id="tabs5-pane<?php echo $_SubCat->id;?>" class="tab-pane <?php if($count ==1){?>active<?php }?>">
<?php
$innerSub = $this->user_model->get_all_details(CATEGORY,array('status'=>'Active','rootID'=>$_SubCat->id))->result_array();
$keysLength = count($innerSub);
?>
<div class="row">
<div class="col-md-8 col-sm-6 col-xs-12">
<div class="box">
<ul>
<?php for($i=0; $i< min($keysLength, 10); $i++){
if($innerSub[$i]['sub_mega_menu'] == "Yes"){
?>
<li>
<a href="search/all/<?php echo $_MainCat->id?>-<?php echo $_MainCat->seourl?>/<?php echo $_SubCat->id?>-<?php echo $_SubCat->seourl?>/<?php echo $innerSub[$i]['id']?>-<?php echo $innerSub[$i]['seourl'];?>?"><?php echo $innerSub[$i]['cat_name'];?></a>
</li>
<?php }}?>
</ul>
</div>
</div>
<?php if ($keysLength >= 10){?>
<div class="col-md-8 col-sm-6 col-xs-12">
<div class="box">
<ul>
<?php for ($i = 10; $i < min($keysLength, 20); $i++) { ?>
<?php if($i < 19){?>
<li>
<a href="search/all/<?php echo $_MainCat->id?>-<?php echo $_MainCat->seourl?>/<?php echo $_SubCat->id?>-<?php echo $_SubCat->seourl?>/<?php echo $innerSub[$i]['id']?>-<?php echo $innerSub[$i]['seourl'];?>?"><?php echo $innerSub[$i]['cat_name'];?></a>
</li>
<?php } else{?>
<li>
<a href="search/all/<?php echo $_MainCat->id?>-<?php echo $_MainCat->seourl?>/<?php echo $_SubCat->id?>-<?php echo $_SubCat->seourl?>?">And Much More...</a>
</li>
<?php } ?>
<?php } ?>
</ul>
</div>
</div>
<div class="col-md-4 col-sm-6 col-xs-12"> <img src="images/category/<?php echo $catImg;?>" alt="" class="img-responsive"> </div>
<?php } else{?>
<div class="col-md-4 col-sm-6 col-xs-12"> <img src="images/category/<?php echo $catImg;?>" alt="" class="img-responsive"> </div>
<?php } ?>
</div>
</div>
<?php $count++;?>
<?php }}?>
</div>
<!-- /.tab-content -->
</div>
<!-- end col -->
</div>
<!-- /.tabbable -->
</div>
<!-- end ttmenu-content -->
</li>
</ul><?php }?>
</li>
<!-- end mega menu -->
<?php }} ?>
<!-- end mega menu -->
</ul>
<!-- end nav navbar-nav -->
</div>
<!--/.nav-collapse -->
</div>
</div>
<!-- end navbar navbar-default clearfix -->
</div>
<!-- end menu 1 -->
</div>
<!-- end hero -->
</div>
<?php */}?>



<nav class="navbar navbar-default navbar-fixed-top hidden-md hidden-sm hidden-lg header_fixed_menu header_top" style="width:100%;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=".">Artfill</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolio">產品分類</a>
                    </li>
                    
                    <?php if($this->session->userdata['shopsy_session_user_name'] != ''){ ?>
                    <li class="page-scroll">
                    	<a href="public-profile">檢查個人檔案</a>
                    </li>
                    <li class="page-scroll">
                    	<a href="activity">動態消息</a>
       			
			<?php if ($userActivityCount > 0) {?>
			<span class="activity-count"><?php echo $userActivityCount; ?></span>
			<?php }?>
                    </li>
                    <li class="page-scroll">
                    	<a onclick="return clear_notyfi();" href="<?php echo $this->session->userdata['shopsy_session_user_name']; ?>/notifications">
			通知
			<span class="notification-list-count"><?php echo $notificationCount; ?></span>
			</a>
       			
                    </li>
                    <li class="page-scroll">
                    	<a href="shop/sell">我的商店</a>
                    </li>
                    <li class="page-scroll">
                    	<a href="purchase-review">所有購買</a>
                    </li>
                    <li class="page-scroll">
                    	<a href="reviews">評價</a>
                    </li>
                    <li class="page-scroll">
                    	<a href="disputes">糾紛</a>
                    </li>
                    <li class="page-scroll">
                    	<a href="manage-community">管理社區</a>
                    </li>
                    <li class="page-scroll">
                    	<a href="public-profile">公開個人檔案</a>
                    </li>
                    <li class="page-scroll">
                    	<a href="settings/my-account/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>">帳戶設置</a>
                    </li>
                    <li class="page-scroll">
                    	<a href="logout">登出</a>
                    </li>
                    <?php }else{?>
                    <li class="page-scroll">
                        <a data-toggle="modal" href="#signin"><img src="./images/shape.png" style="width:20px;" /><span style="margin-left:5px;">登入</span></a>
                    </li>
                    <li class="page-scroll">
                        <a data-toggle="modal" href="#signup"><img src="./images/notes.png" style="width:20px;" /><span style="margin-left:5px;">註冊</span></a>
                    </li>
                    <?php }?>
                    <li class="page-scroll">
                        <a href="cart">
                        <span>購物車</span>
			<span class="notification-list-count" > <?php if ($MiniCartViewSet > 0) { echo $MiniCartViewSet; } else {echo '0';}?></span>
			</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>






		<?php if ($this->uri->segment(1) == '') {
        ?>
			<?php
$image_name = "images/landingbanner/banner-admin.jpg";
        if ($banner_settings->row()->status == 'Active') {
            if ($bannerSlide_image[0]['image'] != '') {
                $image_name = 'images/landingbanner/' . $bannerSlide_image[0]['image'];
            }
        } else {
            if ($recentFavorites[0]['seller_banner'] != '') {
                $image_name = 'images/banner/' . $recentFavorites[0]['seller_banner'];
            }
        }

        $banner_description = '';
        if ($banner_settings->row()->banner_description != '' && $banner_settings->row()->show_banner_text == 'Yes') {
            $banner_description = $banner_settings->row()->banner_description;
        } else {
            $banner_description = $this->config->item('banner_description');
        }
        ?>

			 <!--<div class="jumbotron hero" <?php if ($recentFavorites[0]['seller_banner'] != '') {?>style="background-image:url(images/banner/<?php echo $recentFavorites[0]['seller_banner']; ?>)" <?php }?>>-->

			<div class="jumbotron hero" style="margin-top:inherit;">

			<img class="lazy" src="images/sliders/front_page_.png" style="width:100%;" />

			<!--
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

					  <ol class="carousel-indicators">

					<?php
//    print_r($sliderslist);
        $i = 0;
        foreach ($sliderslist->result() as $sliders) {
            ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0) {?>class="active"<?php }?>></li>
                        <?php
$i++;
        }
        ?>


					  </ol> -->

					  <!-- Wrapper for slides -->
					  <!--
					  <div class="carousel-inner">
					<?php $i = 0;foreach ($sliderslist->result() as $sliders) {
            ?>
						<div class="item <?php if ($i == 0) {echo 'active';}?>">

									<div class=" container hero-in hero-in-1">
									  <div class="container">
									  <div class="col-md-7" style="padding-left: 78px;color:#8dbad4;">
									  <?php if ($sliders->title != '') {?>
										<h2><?php echo trim($sliders->title); ?></h2> <?php }?>
										<?php if ($sliders->description != '') {?>
										<p><?php echo trim($sliders->description); ?></p><?php }?>
										<?php if ($sliders->link != '') {?>

										<a class="banner-bt" href="<?php echo trim(prep_url($sliders->link)); ?>" target="_blank" /><?php echo af_lg('lg_readmore', 'Read More'); ?></a> <?php }?>

									  </div>

									  </div>
									</div>

			            <?php if ($sliders->image != '') {?>
						<img src="images/sliders/<?php echo $sliders->image; ?>" /> <?php }?>


						</div>

						<?php $i++;}
        ?>
					  </div>





						  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						  </a>
						  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						  </a>
						  </div> -->

						  <?php $FavShops = explode(',', rtrim($FavoriteShops, ','));
        echo $FavoriteShopsProducts[$FavShops[0]]['image'];

        if (count($FavoriteShopsProducts[$FavShops[0]]) > 0) {
            ?>

				<!--<div class="image-credit-wrap">
				  <div class="container">
					<div class="recent-review banner-user">
					<?php
$shop_user_name = $recentFavorites[0]['full_name'];
            if ($shop_user_name == '' || $shop_user_name == '0') {
                $shop_user_name = $recentFavorites[0]['last_name'];
            }
            if ($shop_user_name == '' || $shop_user_name == '0') {
                $shop_user_name = $recentFavorites[0]['user_name'];
            }
            $shop_name = $recentFavorites[0]['shop_name'];
            if ($shop_name == '') {
                $shop_name = $recentFavorites[0]['full_name'];
            }
            if ($shop_name == '') {
                $shop_name = $recentFavorites[0]['user_name'];
            }

            $shop_name = $shop_user_name . ' of ' . $shop_name;

            ?>
						<img class="img-circle" alt="<?php echo $recentFavorites[0]['full_name']; ?>" src="images/<?php if ($recentFavorites[0]['thumbnail'] != '') {echo 'users/thumb/' . $recentFavorites[0]['thumbnail'];} else {echo 'default_avat.png';}?>">

					  <div class="recent-right banner-user-right">
						<p> <?php echo $shop_name; ?></p>
						<?php
$tag_txt = $recentFavorites[0]['city'];
            if ($recentFavorites[0]['country'] != '' && $recentFavorites[0]['country'] != '0' && $tag_txt != '') {
                $tag_txt .= ', ' . $recentFavorites[0]['country'];
            }
            ?>
						<p class="user-txt"><?php echo $tag_txt; ?> </p>
					  </div>
					</div>
					<div class="banner-user-profile">

					 <?php if (count($FavoriteShopsProducts[$FavShops[0]]) > 4) {$cnt = 4;} else { $cnt = count($FavoriteShopsProducts[$FavShops[0]]);}

            for ($l = 0; $l < $cnt; $l++) {
                ?>
                        <?php $img = @explode(',', $FavoriteShopsProducts[$FavShops[0]][$l]['image']);
                if ($img[0] != '') {
                    $img_src = 'images/product/list-image/' . $img[0];
                } else {
                    $img_src = 'images/noimage.jpg';
                }
                ?>
						<div class="rf-small">
							<a href="products/<?php echo $FavoriteShopsProducts[$FavShops[0]][$l]['seourl']; ?>">
								<img alt="small" src="<?php echo $img_src; ?>">
							 </a>
						</div>
                        <?php }?>

					  <div class="rf-small">
						<a href="shop-section/<?php echo $recentFavorites[0]['shop_seourl']; ?>" class="shop-listing-count"> <span class="listing-count"><?php echo count($FavoriteShopsProducts[$FavShops[0]]); ?> </span><?php if ($this->lang->line('shop_items') != '') {echo stripslashes($this->lang->line('shop_items'));} else {
                echo 'items';
            }
            ?>
						</a>

					  </div>
					</div>
				  </div>
				</div>	-->
				<?php }?>







</div>
		<?php }?>





</header>

	<div class="col-md-4 search-bl col-xs-12 hidesearch">
		<div class="hidesearch-cover">
			<form name="search" action="search/all" method="get">
				<input type="text" class="search" name="item" placeholder="<?php if ($this->lang->line('temp_srchitems') != '') {echo stripslashes($this->lang->line('temp_srchitems'));} else {
        echo 'Search for items and shops';
    }
    ?>" value="<?php if ($this->input->get('item') != '') {echo $this->input->get('item');}?>" id="search_items" autocomplete="off" >
				<?php if ($this->input->get('gift_cards') == 'on') {?>
				<input type="hidden" name="gift_cards" value="<?php echo $gift; ?>" /> <?php }?>
				 <?php if ($minVal != '') {?>
				<input type="hidden" name="min_price" value="<?php echo $minVal; ?>" /> <?php }?>
					 <?php if ($maxVal != '') {?>
				<input type="hidden" name="max_price" value="<?php echo $maxVal; ?>" /> <?php }?>
				<?php if ($locVal != '') {?>
				<input type="hidden" name="location" value="<?php echo $locVal; ?>" /> <?php }?>
				<?php if ($shipVal != '') {?>
				<input type="hidden" name="shipto" value="<?php echo $shipVal; ?>" /> <?php }?>
				<input type="submit" class="search-bt" value="<?php if ($this->lang->line('heading_browse') != '') {echo stripslashes($this->lang->line('heading_browse'));} else {
        echo 'Browse';
    }
    ?>" />
				<div id="sugglist"></div>
			</form>
		</div>
	</div>

<script type="text/javascript">

function hoverView(val){
	if($('#hoverlist'+val).css('display')=='block'){
		$('#hoverlist'+val).hide('');
	}else{
		$('#hoverlist'+val).show('');
	}
}
</script>