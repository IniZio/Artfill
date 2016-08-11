<?php
$this->load->view('site/templates/commonheader');
$this->load->model('user_model');
?>
<?php
if ($CurrUserImg != '') {
    $user_pic = 'users/thumb/' . $CurrUserImg;
} else {
    $user_pic = 'default_avat.png';
}
?>

</head>
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
 <div class="header_top animated hidden-xs" style="position:relative;">
		<?php if ($this->session->userdata['shopsy_session_user_name'] == '' || true) {
    ?>
			<div class="container top">
        <div class="row">    
         	<!--new elements-->
					<div class="hidden-xs">
						<a href="<?php echo base_url(); ?>" title="<?php echo af_lg('lg_home', 'Home'); ?>"><span style="color:white;">首頁</span></a>
						<span style="color:white;">&emsp;|&emsp;</span>
						<a href="pages/about-us"><span style="color:white;">關於我們</span></a>
						<span style="color:white;">&emsp;|&emsp;</span>
						<a href="faq"><span style="color:white;">常見問題</span></a>
						<span style="color:white;">&emsp;|&emsp;</span>
						<a href="shop/sell"><span style="color:white;">立即開店</span></a>
						<span style="color:white;">&emsp;</span>
						<a data-toggle="modal" id="language_href" href="#Language" onclick="javascript:$('#languageTab').trigger('click');">
						<img src="./images/zh.png" style="width:30px;" />
						</a>
					</div>

					<div class="col-xs-12" style="text-align:center;width:100%;padding-top:5px;padding-bottom: 5px">
						<a href="."><img class="" src="./images/<?php echo $this->config->item('logo_image'); ?>" alt="<?php echo $this->config->item('email_title'); ?>" title="<?php echo $this->config->item('email_title'); ?>" style="width:20%;min-width:200px;" /></a>
					</div>

					<div style="clear:both;padding-top:20px;padding-bottom:20px;">
					</div>

				</div>
			</div>

		<?php } else {
    ?>

			 <div class="container top">
				<div class="row">
				<?php if ($this->config->item('mega_menu') == 'No') {
        ?>
				<?php }?>
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

									</ul>
							</li>
						</ul>

				    </div>




				</div>

			</div>

		<?php }?>


		<!--another new elements-->

				</div>
		<div class="header_top header_fixed_menu hidden-xs" style="background-image:none;position:relative;height:40px">
				<div class="container top">
				<div class="row">

					<div class="col-md-4 search-bl col-xs-12">
						<div class="col-md-3 col-sm-4 vcenter text-right"><a href="search/all" style="color:#8dbad4; font-weight: bold;font-size:120%;">商品</a></div>
						<div class="col-md-9 col-sm-8 vcenter" style="top: -2px;padding:0"><form name="search" action="search/all" method="get" style="padding: 0;width: 100%;"> <!--style="width:80%;"> -->
							<div class="input-group">
								<input type="text" class="search" name="item" placeholder="<?php if ($this->lang->line('temp_srchitems') != '') {echo stripslashes($this->lang->line('temp_srchitems'));} else {
    echo 'Search for items and shops';
}
?>" value="<?php if ($this->input->get('item') != '') {echo htmlspecialchars($this->input->get('item'));}?>" id="search_items" autocomplete="off" style="width:100% !important" />
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
						<div id="sugglist"></div>
					</div>
					<div class="col-md-2 col-xs-3 top-login">
						<ul class="header_menu">
							<?php if ($this->session->userdata['shopsy_session_user_name'] != '') {
        ?>
							<li>
								<a class="dropdown-toggle browse" data-toggle="dropdown"><img src="./images/user-silhouette.png" style="width:20px;" /><span style=" font-weight: bold;font-size:120%;margin-left:5px;vertical-align: middle;"><?php echo $this->session->userdata['shopsy_session_user_name']; ?></span></a>

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

									<li><a href="purchase-review">交易紀錄</a></li>
									<!--<li><a href="reviews">意見回饋</a></li>-->
									<li><a href="settings/my-account/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>"><?php if ($this->lang->line('landing_account_ettings') != '') {echo stripslashes($this->lang->line('landing_account_ettings'));} else {
            echo 'Account Settings';
        }
        ?></a></li>

									<li class="last"><a href="logout"><?php if ($this->lang->line('sign_out') != '') {echo stripslashes($this->lang->line('sign_out'));} else {
            echo 'Sign Out';
        }
        ?></a></li>

								</ul>



								<?php
if ($CurrUserImg != '') {
            $user_pic = 'users/thumb/' . $CurrUserImg;
            #die;
        } else {
            $user_pic = 'default_avat.png';
        }
        ?>

												</li>
							<?php } else {?>
							<li>
								<a id="signin-modal" data-toggle="modal" href="#signin"><img src="./images/shape.png" style="width:20px;" /><span style=" font-weight: bold;font-size:120%;margin-left:5px;">登入</span></a>
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
                    	<a href="purchase-review">交易紀錄</a>
                    </li>
					<!--
                    <li class="page-scroll">
                    	<a href="reviews">意見回饋</a>
                    </li>
					-->
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


			<div class="jumbotron hero" style="margin-top:inherit;">

			<img class="lazy" src="images/sliders/front_page_.png" style="width:100%;" />

					  <!-- Wrapper for slides -->
						  <?php $FavShops = explode(',', rtrim($FavoriteShops, ','));
        echo $FavoriteShopsProducts[$FavShops[0]]['image'];

        if (count($FavoriteShopsProducts[$FavShops[0]]) > 0) {
            ?>
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
