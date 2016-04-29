<?php 

$this->load->view('site/templates/header');

$this->load->model('user_model');

?>

<section class="container">

    <div class="main">

    	<ul class="breadcrumb_top">

        	<li><a href="#"><?php if($this->lang->line('landing_home') != '') { echo stripslashes($this->lang->line('landing_home')); } else echo "Home"; ?></a></li>

        	<li>></li>

        	<li><?php if($this->lang->line('seller_shopsearch') != '') { echo stripslashes($this->lang->line('seller_shopsearch')); } else echo "Shop Search Results"; ?></li>

        </ul>

        <div class="treasury-headline">

        	<h3><?php if($this->lang->line('seller_browsing') != '') { echo stripslashes($this->lang->line('seller_browsing')); } else echo "Browsing all Shops"; ?></h3>

        </div>

        <div class="shop_search">

            <div class="listings-title">

            	<form action="find/shop" method="get">

                    <input class="text_box" type="text" placeholder="<?php if($this->lang->line('seller_searchshops') != '') { echo stripslashes($this->lang->line('seller_searchshops')); } else echo "Search for Shops"; ?>" name="search_query" value="<?php echo htmlspecialchars($search_query); ?>" id="search_key" />

                    <input type="hidden" name="order" value="<?php if(isset($_GET['order'])){ echo $_GET['order'];}else{ echo 0; } ?>" id="order" />

            		<input class="subscribe_btn" type="submit" value="<?php if($this->lang->line('seller_srch') != '') { echo stripslashes($this->lang->line('seller_srch')); } else echo "Search"; ?>">

                

                <div class="sorting-options">

                	<label> <?php if($this->lang->line('seller_sortby') != '') { echo stripslashes($this->lang->line('seller_sortby')); } else echo "Sort by"; ?>: </label>

                    <ul id="menu">

                        <li>

                            <a><?php if(isset($_GET['order'])){ if($_GET['order']==0) { if($this->lang->line('seller_relevancy') != '') { echo stripslashes($this->lang->line('seller_relevancy')); } else echo "Relevancy";}else if($_GET['order']==1){ if($this->lang->line('seller_hotness') != '') { echo stripslashes($this->lang->line('seller_hotness')); } else echo "Hotness"; }else { if($this->lang->line('seller_alphabetical') != '') { echo stripslashes($this->lang->line('seller_alphabetical')); } else echo "Alphabetical";}} else{if($this->lang->line('seller_relevancy') != '') { echo stripslashes($this->lang->line('seller_relevancy')); } else echo "Relevancy";}?><img src="images/down_arrow.png"></a>

                            <ul class="sub-menu" style="top: 21px; margin-right: 4px;">

                                <span class="cursor"></span>

                                <li>

                                	<a id="Relevancy" <?php if(isset($_GET['order'])){ if($_GET['order']==0){echo 'class="active"';} }else{echo 'class="active"';}?>><?php if($this->lang->line('seller_relevancy') != '') { echo stripslashes($this->lang->line('seller_relevancy')); } else echo "Relevancy"; ?></a>

                                </li>

                                <li>

                                	<a id="Hotness" <?php if(isset($_GET['order'])){ if($_GET['order']==1){echo 'class="active"';} }?>><?php if($this->lang->line('seller_hotness') != '') { echo stripslashes($this->lang->line('seller_hotness')); } else echo "Hotness"; ?></a>

                                </li>

                                <li>

                                	<a id="Alphabetical" <?php if(isset($_GET['order'])){ if($_GET['order']==2){echo 'class="active"';} }?>><?php if($this->lang->line('seller_alphabetical') != '') { echo stripslashes($this->lang->line('seller_alphabetical')); } else echo "Alphabetical"; ?></a>

                                </li>

                            </ul>

                        </li>

                    </ul>                    

                </div>
			</form>

            </div>
			
			<div class="product-list" id="tiles">

            <?php if($start==0){ ?>

            <?php if(!empty($shopList)){ ?>

            <?php 

				for($i=0;$i<count($shopList);$i++){

					foreach($shopList as $shopList){
					
					
					$ShopListDetails = $this->user_model->get_count_all_product($shopList->sellerid);
					
					$ShopListProdDetails = $this->user_model->get_shop_product_limit($shopList->sellerid);
					//echo '<br>'.$ShopListDetails;
					//echo '<pre>'; print_r($ShopListProdDetails);die;

			?>

            <?php if($shopList->thumbnail!=''){ $profile_pic='users/thumb/'.$shopList->thumbnail; } else { $profile_pic='default_avat.png';}?>

            <div class="seller-links local-shop">

              <div class="local-shop-list" >

                    <a class="fav-item-name" href="shop-section/<?php echo $shopList->shop_seourl; ?>"><?php echo $shopList->shop_name; ?> </a>

                    <div class="fav-owner fav-owner-1">

                        <a href="view-profile/<?php echo $shopList->user_name; ?>">

                        	<img class="thumbnail" width="35" height="35" src="images/<?php echo $profile_pic; ?>">

                        </a>

                    </div>

                    <div class="fav_min_text">

                    	<a class="fav_min_text_link" href="view-profile/<?php echo $shopList->user_name; ?>"><?php echo $shopList->full_name; ?></a>

                        <span><?php if($this->lang->line('user_shop_owner') != '') { echo stripslashes($this->lang->line('user_shop_owner')); } else echo "Shop Owner"; ?></span>

                    </div>

                </div>
				
				<ul class="find-shop-search">

                <?php if($ShopListDetails>5){$cond=6;}else{$cond=$ShopListDetails;} ?>
						
                 <?php if($cond<6){ for($l=6-$cond;$l>0;$l--) { ?>

                        <li>
                          <div class="seller-outer" style="background-color: rgb(255, 255, 255); padding: 2px; height: 78px; width: 74px;">

<div style="background: #eef0f3; height:72px;"></div>

</div>

                        </li>

                        <?php } } ?>

                <?php 
				for($l=0;$l<$cond;$l++) {
					
					$img=explode(',',$ShopListProdDetails[$l]['image']); 

				?>

                <li>

                    <a href="products/<?php echo $ShopListProdDetails[$l]['seourl']; ?>">

                    <div class="seller-outer">

                        <div class="seller-inner">

                        	<!-- <img src="images/product/list-image/<?php echo $img[0]; ?>" width="75" height="75"> -->
							<img src="images/product/cropthumb/<?php echo $img[0]; ?>" width="75" height="75">
                        </div>

                    </div>

                    </a>

                </li>

                <?php }?>

            	<li>

                    <a href="shop-section/<?php echo $shopList->shop_seourl; ?>">

                    <div class="seller-outer count-box">

                        <div class="seller-inner">

                            <span class="count-number"><?php  echo $ShopListDetails; ?></span>

                            <?php if($this->lang->line('user_items') != '') { echo stripslashes($this->lang->line('user_items')); } else echo "items"; ?>

                        </div>

                    </div>

                    </a>

                </li>
				
				</ul>

            </div>

            <?php } } }else{ ?>

            <div class="outer_tab1">

                <div class="outer_tab_2">

                    <div class="tab_content">

                    	<h1><?php if($this->lang->line('seller_noresult') != '') { echo stripslashes($this->lang->line('seller_noresult')); } else echo "No Result Found"; ?>.</h1>

                    </div>

                </div>

            </div>

            <?php } } ?>
			
			<div class="clear"></div>
			<div id="infscr-loading" style="text-align: center; display: none;">
		<span><img src="images/spinner.gif" alt="Loading..." /></span>
	</div>
	<div class="landing_pagination" id="landing_page_id" style="display: none;">
		<?php echo $paginationDisplay;?>
	</div>
			
			</div>
        </div>

    </div>

<div class="clear"></div>

</section>

<script>

$(document).ready(function(e) {

    $('#Relevancy').click(function(e) {

        path='find/shop?search_query='+$('#search_key').val()+'&order=0';

		window.location = BaseURL+path;

    });

	$('#Hotness').click(function(e) {

        path='find/shop?search_query='+$('#search_key').val()+'&order=1';

		window.location = BaseURL+path;

    });

	$('#Alphabetical').click(function(e) {

        path='find/shop?search_query='+$('#search_key').val()+'&order=2';

		window.location = BaseURL+path;

    });

});

</script>

<script type="text/javascript">
var loading=false;
var $win     = $(window),
$stream  = $('div.product-list'); 
$(window).scroll(function() { //detect page scroll
	if($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
	{
		var $url = $('.landing-btn-more').attr('href');
		if(!$url) $url='';
		if($url != '' && loading==false) //there's more data to load
		{
			loading = true; //prevent further ajax loading
			$('#infscr-loading').show(); //show loading image
			//var vmode = $('.figure.classic').css('display');
			//load data from the server using a HTTP POST request
			
			$.ajax({
					type:'post',
					url:$url,
					success:function(html){
						//alert(data);	
				
				
						var $html = $($.trim(html)),
					    $more = $('.landing_pagination > a'),
					    $new_more = $html.find('.landing_pagination > a');

					if($html.find('div.product-list').text() == ''){
						//alert('test');
						//$stream.append('<ul class="product_main_thumb"><li style="width: 100%;"><p class="noproducts">No more products available</p></li></ul>');
						
						
					}else {
						
						$stream.append( $html.find('div.product-list').html());
						
					}

					if($new_more.length) $('.landing_pagination').append($new_more);	
					$more.remove();
					
				
				
				//hide loading image
				$('#infscr-loading').hide(); //hide loading image once data is received
				
				loading = false; 
				 var options = {
			        autoResize: true, // This will auto-update the layout when the browser window is resized.
			        container: $('#freewall'), // Optional, used for some extra CSS styling
			        offset: 8, // Optional, the distance between grid items
			        itemWidth: 230 // Optional, the width of a grid item
			      };
			 	var handler = $('#tiles').next("div");	
				
			 	//handler.wookmark(options);
			 
				},
				fail:function(xhr, ajaxOptions, thrownError) { //any errors?
					
					alert(thrownError); //alert with HTTP error
					$('#infscr-loading').hide(); //hide loading image
					loading = false;
				
				}
			});
			
		}
	}
});
</script>
<!-- include jQuery -->

<script src="js/site/jquery.wookmark.js"></script> 

<script type="text/javascript">
    $(document).ready(new function() {
      // Prepare layout options.
      var options = {
        autoResize: true, // This will auto-update the layout when the browser window is resized.
        container: $('#freewall'), // Optional, used for some extra CSS styling
        offset: 8, // Optional, the distance between grid items
        itemWidth: 230 // Optional, the width of a grid item
      };

      // Get a reference to your grid items.
      var handler = $('#tiles').next("div");

      // Call the layout function.
      handler.wookmark(options);

      // Capture clicks on grid items.
     
    });
  </script>

 <script type="text/javascript">
	$(document).ready(function() {
	  window.setTimeout(function(){ $("html, body").animate({ scrollTop: 50 }, 100); },100);
    });
 

</script>

<?php 

$this->load->view('site/templates/footer');

?>

