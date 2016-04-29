<?php
$this->load->view('site/templates/header');
$this->load->model('product_model');
$this->load->model('user_model');
?> 

<style>

header{
	margin-bottom: 0px;
}

</style>

<section class="content-wrap-inner content-wrap">
  <section class="container ">
    <div class="feed-heading">
      <h1><?php if($this->lang->line('landing_your_feed') != '') { echo stripslashes($this->lang->line('landing_your_feed')); } else echo 'Your Feed'; ?></h1>
      <ul class="toggle-tabs filter-options">
        <li class="first"> 
			<a class="active"  href="<?php echo base_url();?>"><?php if($this->lang->line('landing_following') != '') { echo stripslashes($this->lang->line('landing_following')); } else echo 'Following'; ?> </a> 
		</li>
		<li class="last">
			<a href="activity/interaction"><?php if($this->lang->line('landing_interaction') != '') { echo stripslashes($this->lang->line('landing_interaction')); } else echo 'Interactions'; ?>  </a> 
		</li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-8">	 
	    <?php if(count($recentFavorites->result()) > 0){?>
			<div class="trending-item">
			    <div class="items-group-wrap">
					<div class=""> 
					<?php foreach($recentFavorites->result() as $trends){
					
	                 $trend_img=@explode(',',$trends->image); 
						if($trend_img[0] != ''){
							$trend_src='images/product/thumb/'.$trend_img[0];
						} else {
							$trend_src='images/noimage.jpg';
						}
						
					?>
						<a class="item-link item-link-trend" href="products/<?php echo $trends->seourl;?>">
							<img src="<?php echo $trend_src;?>" alt="<?php echo $trends->product_name;?>">
						</a> 
					<?php }?>
					</div>
			    </div>
			  <h3><?php if($this->lang->line('landing_recently_favorited_items') != '') { echo stripslashes($this->lang->line('landing_recently_favorited_items')); } else echo 'Recently Favorited Items'; ?></h3>
			</div>
        <?php } else { ?>
			 <div class="trending-item" style="border: medium none;"></div>
		<?php } ?>
		
	<?php  $i=0; 
	//echo count($productDetails);
				foreach($productDetails as $proddetails){
    
    #print_r($proddetails);
    #exit;
                  	$imgSplit = @explode(",",$proddetails['image']); 
					if($imgSplit[0] != ''){
						$prod_img='images/product/'.stripslashes($imgSplit[0]);
					}else{
						$prod_img="images/dummyProductImage.jpg";
					}	
						if($proddetails['thumbnail'] != ''){
							$owner_pic='images/users/thumb/'.$proddetails['thumbnail']; 
						}else{ 
							$owner_pic='images/default_avat.png';
						} 
					$shopDet = $this->product_model->get_business_name($proddetails['user_id']);			
			?>	
	<div class="story-block col-md-5">
		<!---<div class="story-count-items">
			<a href="#">10items</a>
		</div>-->
			<div class="object-items listing"> 
				 <a class="item-link" href="products/<?php echo $proddetails['seourl']?>">				
					<img src="<?php echo $prod_img; ?>"  alt="object">
				</a>
    <?php 
		  
		  if($this->config->item('deal_of_day')=='Yes')
		  {
		  
		  $starttime=$proddetails['deal_date']." ".$proddetails['deal_time_from'];
		  if($proddetails['action']=='DOD' && $proddetails['discount']!=0   && date('Y-m-d H:i',strtotime($starttime)) <=date('Y-m-d H:i')) {
 
		  ?>
		<div class="offer-tag">
									<p class="off-price"><?php echo $proddetails['discount']; ?>% 0ff</p>
								</div>
								
	     <?php }} ?>
			</div>
			<div class="object-info clear"> 						
				<a class="shop-avatar-link" href="view-people/<?php echo $proddetails['user_name']?>"> 
					<img alt="ssamnichols" src="<?php echo $owner_pic; ?>"> 
				</a>
				<div class="branding">
				     <h3>
						<a title="<?php echo $proddetails['product_name']?>" href="products/<?php echo $proddetails['seourl']?>" class="shop-name"><?php echo character_limiter($proddetails['product_name'],25);?></a> 
				     </h3>
										 <?php  if($this->config->item('deal_of_day')=='Yes')
		  { 
    #echo "s";
    #echo $proddetails['deal_date'];
		   #$starttime=$proddetails['deal_date']." ".$proddetails['deal_time_from'];
     #echo $starttime;
     #echo date('Y-m-d H:i');
     
		  if($proddetails['action']=='DOD' && $proddetails['discount']!=0 && date('Y-m-d H:i',strtotime($starttime)) <=date('Y-m-d H:i')) {
 
 
   ?>	  
		  <?php  	  
		   if($proddetails['price'] != 0.00) {
		  $style="style='text-decoration:line-through;'";
		  $endatedeal=$proddetails['deal_date_to']." ".$proddetails['deal_time_to'];
		  $offer=($proddetails['discount']/100)*$proddetails['price'];
		  $enddeal=date('Y-m-d H:i:s',strtotime($endatedeal));
		  }else{
		   $style="style='text-decoration:line-through;'";
		  $endatedeal=$proddetails['deal_date_to']." ".$proddetails['deal_time_to'];
		  $offer=($proddetails['discount']/100)*$proddetails['base_price'];
		  #echo $offer;
		  $enddeal=date('Y-m-d H:i:s',strtotime($endatedeal));
		  }
		  ?>
		  <!--<div data-countdown="<?php echo $enddeal; ?>" >
		  </div>-->
		  <?php } }
		  else
		  {
		  $style='';
		  $offer=0;
		  }
		  ?>
				    <p class="listing-meta"> 
						
						<span class="listing-price"> 							
							<?php if($proddetails['price'] != 0.00) {?>
								<?php if($proddetails['action']=='DOD' && $this->config->item('deal_of_day')=='Yes' && date('Y-m-d H:i',strtotime($starttime)) <=date('Y-m-d H:i')){?>
                        <span class="currency_value" style="text-decoration:line-through;"><?php echo $currencySymbol; echo number_format($currencyValue*$proddetails['price'],2)?></span>
						<?php $remain=$proddetails['price']-$offer;?>
						<span class="currency_value" ><?php echo $currencySymbol; echo number_format($currencyValue*$remain,2)?></span>
						<?php }else{?>
						 <span class="currency_value" ><?php echo $currencySymbol; echo number_format($currencyValue*$proddetails['price'],2)?></span>
						<?php }?>
							<?php } else { ?> 
                          <?php if($proddetails['action']=='DOD' && $this->config->item('deal_of_day')=='Yes' && date('Y-m-d H:i',strtotime($starttime)) <=date('Y-m-d H:i')){?>

                                 <span class="currency_value" style="text-decoration:line-through;"><?php echo $currencySymbol; echo number_format($currencyValue*$proddetails['base_price'],2)?></span>
						<?php $remain=$proddetails['base_price']-$offer;?>
						<span class="currency_value" ><?php echo $currencySymbol; echo number_format($currencyValue*$remain,2)?></span>
                               						  
								
							<?php }else{?>
							
							<span class="currency-symbol"><?php echo $currencySymbol;?></span>
								<span class="currency-value"><?php echo number_format($currencyValue*$proddetails['base_price'],2).'+';?></span> 
							<?php }}?>						
						</span> 
						<a title="<?php echo $shopDet->row()->shop_name; ?>" href="shop-section/<?php echo $shopDet->row()->shop_seourl; ?>"><?php echo $shopDet->row()->shop_name; ?>
						</a>						
				     </p>
				</div>
				<div class="object-actions">
				    <div class="">
				         <?php if($loginCheck !=''){ ?>
						 <?php if($proddetails['user_id']==$loginCheck){ ?>
						<button onclick="return ownProductFav();" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
								<span class="icon"></span> <span class="ie-fix">&nbsp;</span> 
						</button>
						<?php
						}else{
						$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($proddetails['id']));
						if(empty($favArr)){ ?>
							 <button onclick="return changeProductToFavourite('<?php echo stripslashes($proddetails['id']); ?>','Fresh',this);" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
								<span class="icon"></span> <span class="ie-fix">&nbsp;</span> 
							 </button>
						<?php } else {?>
							<button onclick="return changeProductToFavourite('<?php echo stripslashes($proddetails['id']); ?>','Old',this);" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
							<span class="icon fav-active"></span> <span class="ie-fix">&nbsp;</span> 
						 </button>
						<?php }} } else {?> 
							<button onclick="return changeProductToFavourite('<?php echo stripslashes($proddetails['id']); ?>','Fresh',this);" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
							<span class="icon"></span> <span class="ie-fix">&nbsp;</span> 
						 </button>
						<?php }?>
			
						<button onclick="return hoverView('<?php echo $proddetails['id'];?>');"" class="btn-collect btn-dropdown  inline-overlay-trigger ollection-add-action" type="button"> 
							<span class="icon"></span> 
							<span class="icon-dropdown"></span> 
							<span class="ie-fix">&nbsp;</span>
						</button>					
					
							<div id="hoverlist<?php echo $proddetails['id'];?>" class="hover_lists">
								<h2><?php if($this->lang->line('landing_your_lists') != '') { echo stripslashes($this->lang->line('landing_your_lists')); } else echo 'Your Lists'; ?></h2>
								<div class="lists_check">
									<?php foreach($userLists as $Lists){ 
										$haveListIn = $this->user_model->check_list_products(stripslashes($proddetails['id']),$Lists['id'])->num_rows();
										#echo $haveListIn;
										if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}
									?>
									 <input type="checkbox" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo stripslashes($proddetails['id']); ?>');" <?php echo $chk; ?> />
									 <label><?php echo $Lists['name']; ?></label><br/>
									 <?php } ?>
									 
									 <?php if(!empty($userRegistry)){ 
											$haveRegisryIn = $this->user_model->check_registry_products($proddetails['id'],$userRegistry->user_id)->num_rows();
											if($haveRegisryIn>0){$chk='checked="checked"';}else{ $chk='';}
										?>
										<input type="checkbox"  onclick="return manageRegisrtyProduct('<?php echo $userRegistry->user_id; ?>','<?php echo $proddetails['id']; ?>');" <?php echo $chk; ?> /> 
										<label><span class="registry_icon"></span><?php if($this->lang->line('prod_wedding') != '') { echo stripslashes($this->lang->line('prod_wedding')); } else echo 'Wedding Registry'; ?></label>
										<?php }  ?>						
								  </div>       							  
							<div class="new_list">
								<form action="site/user/add_list" method="post">
									<input type="hidden" value="1" name="ddl" />
									<input type="hidden" value="<?php echo $proddetails['id']; ?>" name="productId" />
									<input type="text" placeholder="<?php if($this->lang->line('user_new_list') != '') { echo stripslashes($this->lang->line('user_new_list')); } else echo 'New list'; ?>" class="list_scroll" name="list" id="creat_list_<?php echo $i; ?>" />
									<input type="submit" value="<?php if($this->lang->line('user_add') != '') { echo stripslashes($this->lang->line('user_add')); } else echo 'Add'; ?>" class="primary-button" onclick="return validate_create_list('<?php echo $i; ?>');" />
								</form>
							</div>
							
						</div> 
				    </div>
				</div>
			</div>
			<div class="context clear">
				<?php /* <div class="btn-group"> <a class="small story-options dropdown-toggle" href="#"><span class="ss-icon ss-ellipsis"></span></a> </div> */?>
				<div><?php if($this->lang->line('landing_one_of_our_most_popular_shops') != '') { echo stripslashes($this->lang->line('landing_one_of_our_most_popular_shops')); } else echo 'One of our most popular shops'; ?></div>
			  </div>
			</div>
		
	<?php  $i++;}?>	
        
       
    </div>
      <div class="col-md-4 right-sideblock">
	   <?php if($recentFavorites->row()->category_id != '') { ?>
	  
        <div class="story-block col-md-5 odd brand-prize">
          <?php foreach ($mainCategories->result() as $trendCat){  
				$trendingCat=@explode(',',$recentFavorites->row()->category_id);

				if($trendingCat[0] == $trendCat->id){
				
				if($trendCat->image==''){
					$caterogysrc='images/noimage.jpg';
				
				} else {
					$caterogysrc='images/category/'.$trendCat->image;
				}
				?>
		  <div class="object-items listing">
				<a class="item-link" href="category-list/<?php echo $trendCat->id;?>-<?php echo $trendCat->seourl;?>">
					<img src="<?php echo $caterogysrc; ?>" width="170" height="135" alt="<?php echo $trendCat->cat_name;?>">
				</a> 
			</div>       
          <div class="poster-title"> 
		  <a href="category-list/<?php echo $trendCat->id;?>-<?php echo $trendCat->seourl;?>" title="Wall Hangings"> <?php echo $trendCat->cat_name;?> <span class="rsquo"></span> </a> </div>
		  
		  <?php }}?>
        </div>
        <?php } ?>
		<div class="gift-box">
          <h3><?php if($this->lang->line('landing_let_them_pick_the_gift') != '') { echo stripslashes($this->lang->line('landing_let_them_pick_the_gift')); } else echo 'Let them pick the gift.'; ?></h3>
          <a href="gift-cards">
			<div class="cta">
				<?php if($this->lang->line('landing_buy_an') != '') { echo stripslashes($this->lang->line('landing_buy_an')); } else echo 'Buy an'; ?><?php echo $this->config->item('email_title');?><?php if($this->lang->line('landing_gift_card') != '') { echo stripslashes($this->lang->line('landing_gift_card')); } else echo 'Gift Card'; ?>
			</div>
		  </a>
		  <span class="product-img-logo"><img src="images/logo/<?php echo $this->config->item('logo_image'); ?>" alt="<?php echo $this->config->item('email_title'); ?>" title="<?php echo $this->config->item('email_title'); ?>" /></span>        
		  </div>
        <div class="inner">
          <div class="side-section browse-ca">
            <h3><?php if($this->lang->line('landing_browse_category') != '') { echo stripslashes($this->lang->line('landing_browse_category')); } else echo 'Browse category'; ?></h3>
            <ul id="category-list">
			 <?php $i=1; foreach ($mainCategories->result() as $browseCat){ 
			 ?>
              <li class="promotional first"> 
				<a href="category-list/<?php echo $browseCat->id;?>-<?php echo $browseCat->seourl;?>"><?php echo $browseCat->cat_name;?></a> 
			</li>
              <?php  if($i>15){ ?>
				 <li class="promotional first" style="color: rgb(30, 146, 211);"> 
					<a href="category"><?php if($this->lang->line('landing_view_all_category') != '') { echo stripslashes($this->lang->line('landing_view_all_category')); } else echo 'View all category'; ?></a> 
				</li>
			 <?php break; } $i++;}?>
            </ul>
          </div>
          <div class="side-section blog">
            <h3><?php if($this->lang->line('landing_more_from_the') != '') { echo stripslashes($this->lang->line('landing_more_from_the')); } else echo 'More From the';?> <?php echo $this->config->item('email_title');?> <?php if($this->lang->line('landing_blog') != '') { echo stripslashes($this->lang->line('landing_blog')); } else echo 'Blog';?>  <a href="blog"><?php if($this->lang->line('landing_see_more') != '') { echo stripslashes($this->lang->line('landing_see_more')); } else echo 'See more'; ?></a></h3>
           
		   
			
			<?php foreach($recentBlogPosts as $posts){ ?>
			<div class="blog-post clear"> 
				<a href="<?php echo $posts->guid;?>" class="post-image hover-fade"> 				
				<?php 
				$postImg=$this->product_model->GetBlogimage(array('a.post_parent' => $posts->ID,'a.post_type' => 'attachment','meta_key' => '_wp_attached_file'));       
				if($postImg->num_rows() > 0) { 
					
					if($postImg->row()->meta_value !=''){
						$blogImg='blog/wp-content/uploads/'.$postImg->row()->meta_value;
						if(file_exists($blogImg)){
							$blogimgShow = 'blog/wp-content/uploads/'.$postImg->row()->meta_value;
						} else {
							$blogimgShow = 'images/blogpicks.jpg';
						}
					}
				
				?>

				<img src="blog/wp-content/uploads/<?php echo $postImg->row()->meta_value;?>" alt="<?php echo $postImg->row()->meta_value;?>" title="<?php echo $posts->post_title;?>" />
			   <?php } else {?>
			   <img src="images/blogpicks.jpg" alt="<?php echo $posts->post_title;?>" title="<?php echo $posts->post_title;?>" />

			   <?php }?>
				
				 <div class="post-content">
					<p class="post-title"><a href="<?php echo $posts->guid;?>"><?php echo $posts->post_title;?></a></p>
					<p><a href="<?php echo $posts->guid;?>" class="post-link"><?php if($this->lang->line('landing_read_more') != '') { echo stripslashes($this->lang->line('landing_read_more')); } else echo 'Read more';?></a></p>
				 </div>
            </div>
			<?php }?>
           
		   
          </div>
          
		    <form method="post" action="site/user/loginsubscribeUser" name="subscribe">
                    <div class="side-section finds">
                    	<h3><?php echo $this->config->item('email_title');?><?php if($this->lang->line('landing_UK') != '') { echo stripslashes($this->lang->line('landing_UK')); } else echo 'UK';?> </h3>
                        <p><?php echo $this->config->item('email_title');?><?php if($this->lang->line('landing_team') != '') { echo stripslashes($this->lang->line('landing_team')); } else echo 'Handpicked shopping inspiration, news, and upcoming events from our UK team';?></p>
                        <input type="submit" value="<?php if($this->lang->line('landing_subscribe') != '') { echo stripslashes($this->lang->line('landing_subscribe')); } else echo 'Subscribe';?>"  class="btn-secondary" />
					<?php 	/* <p class="goto-link"><a href="#">See our other newsletters.</a></p>    */       ?>              
                    </div>
            </form>
		  
          <div class="side-section">
            <h3><?php if($this->lang->line('landing_more_ways_to_shop') != '') { echo stripslashes($this->lang->line('landing_more_ways_to_shop')); } else echo 'More Ways to Shop';?></h3>
            <ul class="ways-to-shop">
              <?php /* <li><a href="#">Treasury</a></li> */?>
              <li><a href="find/local"><?php if($this->lang->line('landing_shop_local') != '') { echo stripslashes($this->lang->line('landing_shop_local')); } else echo 'Shop Local'; ?></a></li>
              <li><a href="category"><?php if($this->lang->line('landing_categories') != '') { echo stripslashes($this->lang->line('landing_categories')); } else echo 'Categories';?></a></li>
              <li><a href="find/people"><?php if($this->lang->line('landing_people_search') != '') { echo stripslashes($this->lang->line('landing_people_search')); } else echo 'People Search';?></a></li>
              <li><a href="find/shop"><?php if($this->lang->line('landing_shop_search') != '') { echo stripslashes($this->lang->line('landing_shop_search')); } else echo 'Shop Search'; ?></a></li>
            </ul>
          </div>
		 
			
			<?php if($advertisingListSide->num_rows()>0){
							if($advertisingListSide->row()->advertising_area=='side'){
			?>
					<div class="side-section">
					<?php if($advertisingListSide->row()->advertising_option=='image'){ 
									
					?>
						<?php if($advertisingListSide->row()->link!=''){ ?>
						<a href="<?php echo $advertisingListSide->row()->link; ?>" target="_blank"  >
						<?php } ?>
						<img src="images/advertising/<?php echo $advertisingListSide->row()->image; ?>" height="220px"/>
						<?php if($advertisingListSide->row()->link!=''){ ?>
						</a>
						<?php } ?>
					<?php  }else  if($advertisingListSide->row()->advertising_option=='script'){ 
										
					?>
						<?php echo $advertisingListSide->row()->advertising_content; ?>
					<?php } }?>
					</div>
					<?php } ?>
        </div>
      </div>
    </div>

	
	
	
			   <?php 
			   
			   
			   if($advertisingListBottom->num_rows()>0){ 
			  
							if($advertisingListBottom->row()->advertising_area=='bottom'){
			   ?>
				<div class="trending-item">
					
					<?php if($advertisingListBottom->row()->advertising_option=='image'){ 
									
					?>
						<?php if($advertisingListBottom->row()->link!=''){ ?>
						<a href="<?php echo $advertisingListBottom->row()->link; ?>" target="_blank" >
						<?php } ?>
						<img src="images/advertising/<?php echo $advertisingListBottom->row()->image; ?>" width="970" height="90" />
						<?php if($advertisingListBottom->row()->link!=''){ ?>
						</a>
						<?php } ?>
					<?php  }else  if($advertisingListBottom->row()->advertising_option=='script'){ 
												
					?>
						<?php echo $advertisingListBottom->row()->advertising_content; ?>
					<?php  } ?>
			
					</div>
					<?php } } ?>
			<!--  <h3><?php if($this->lang->line('landing_recently_favorited_items') != '') { echo stripslashes($this->lang->line('landing_recently_favorited_items')); } else echo 'Recently Favorited Items'; ?></h3>-->
			
		
  </section>
</section>


<?php 

     $this->load->view('site/templates/footer');

?>