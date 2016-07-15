<?php $this->load->view('site/templates/header');
$this->load->model('user_model');
//echo $lnk;die;
?>

<!--<link rel="shortcut icon" type="image/ico" href="images/front/logo.ico"/>-->

<script type="text/javascript" src="js/front/freewall.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- css -->
<link href='//fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="css/default/site/style-menu.css" />
    

<script>
    $(document).ready(function(){
        $("#nav-mobile").html($("#nav-main").html());
        $("#nav-trigger span").click(function(){
            if ($("nav#nav-mobile ul").hasClass("expanded")) {
                $("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
                $(this).removeClass("open");
            } else {
                $("nav#nav-mobile ul").addClass("expanded").slideDown(250);
                $(this).addClass("open");
            }
        });
    });
</script>
			<div class="add_steps shop-menu-list">

				<div class="main">
				<div id="nav-trigger">
					<span>Menu</span>
				</div>
				<nav id="nav-main">
					<ul id="panel" class="add_steps nav-col" style="background:none; box-shadow:none;">
				
				
				<?php  $segmentvalues=$this->uri->segment_array();
					 
					foreach($subCats->result() as $catList) {
					if ($catList->cat_name != ''){ $commentData = $this->category_model->get_all_counts($catList->id,''); if($commentData[0]['disp']>0){
					$activeCatid=@explode('-',$this->uri->segment(count($segmentvalues)));
					?>			
				<li> 
				<a class="<?php if($activeCatid[0] == $catList->id) { echo 'active';}?>" href="<?php if($activeCatid[0] == $catList->id) { 
					echo 'javascript: void(0);'; 
						} else  if($super_sub_catStatus=='No') { 
							if($super_sub_catStatus=='No' && $super_sub_catID == $catList->id){ 
								echo $lnk;
							} else { 
								echo $lnk.$catList->id.'-'.$catList->seourl; 
							} 
						} else { 
							echo $lnk.$catList->id.'-'.$catList->seourl;
						}
					   ?>" name="<?php echo $catList->cat_name;?>" <?php if($activeCatid[0] == $catList->id) { echo 'style="cursor:default"';}?>  id="<?php echo $catList->id.'-'.$catList->seourl;?>"><?php echo $catList->cat_name;?>
				</a> 	   
				</li>
			 <?php } } }?>

				</ul>
				</nav>
				
				<nav id="nav-mobile"></nav>
				</div>
			
			</div>


<section class="browse-head">
    <div class="container">
		<div class="col-md-4" id="feed-breadcrumb">
			<?php $segmentvalues=$this->uri->segment_array(); 
				 for($i=1;$i<=count($segmentvalues);$i++) {
			$lnk=''; $lnk1='';
					for($j=1;$j<=$i;$j++){
						$lnk.=$segmentvalues[$j].'/';
						if($j==1)
						$lnk1.=$segmentvalues[$j].'/';
						else if($i!=$j)
						$lnk1.=$segmentvalues[$j].'/';	
					}  
		    if($i+1 != count($segmentvalues)){ ?>			
			    <h1>
					<span>
						 <a href="<?php echo $lnk.$segmentvalues[$j]; ?>">
							<?php if($i!=1 && $segmentvalues[$j] != ''){ echo '/'; } ?>
							<?php $catid=@explode('-',$segmentvalues[$j]); echo $this->product_model->get_all_details(CATEGORY,array('id' => $catid[0]))->row()->cat_name;  ?>				
					   </a>
				   </span>
				<?php } ?>
				 <?php  $curr_cat=$segmentvalues[$i+1];} ?></h1> <span class="bre-arrow">></span>
					<span id="feed-header"><?php echo $currentsubCategory->cat_name;?></span>
				 
				<input type="hidden" id="bigCatid" value="<?php echo $currentsubCategory->id.'-'.$currentsubCategory->seourl;?>" />
				<input type="hidden" name="current_url_prod_list" id="current_url_prod_list" value="<?php echo $this->uri->segment(count($segmentvalues));?>" />
		</div>
				
  </div>
</section>

<!-------------  Product List  section starts here ------->

<section class="content-wrap-inner content-wrap">
  <section class="pin-s container">
  
  
  <!-------------  Filtering section starts here ------->
	
	<div class="col-md-12 browse-toogle-filter">
      
	  <div class="col-md-3 toogle-pad col-xs-12">
        <ul class="toggle-tabs filter-options clear">
            <li id="filter_by_all_products" > 
				 <a  id="m_place1" class="<?php if($this->input->get('marketplace') != ''){ echo '';} else { echo 'active'; }?>"   id="m_place1" href="<?php echo base_url().$lnk;  if($this->input->get('gift_cards') == '1'){ echo '?gift_cards=1'; }?>"> 
				 <?php if($this->lang->line('product_listpage_all_items') != '') { echo stripslashes($this->lang->line('product_listpage_all_items')); } else echo 'All Items'; ?> </a> 
		    </li>
			<li id="handmade"> 
				<a id="m_place2" class="<?php if($this->input->get('marketplace') == 'handmade'){ echo 'active';} else { echo ''; }?>" href="javascript:void(0);"> 
				<?php if($this->lang->line('product_listpage_handmade') != '') { echo stripslashes($this->lang->line('product_listpage_handmade')); } else echo 'Handmade'; ?> </a> 
			</li>
			<li class="last" id="vintage"> 
				<a  id="m_place3" href="javascript:void(0);" class="<?php if($this->input->get('marketplace') == 'vintage'){ echo 'active';} else { echo ''; }?>"> 
	<?php if($this->lang->line('product_listpage_vintage') != '') { echo stripslashes($this->lang->line('product_listpage_vintage')); } else echo 'Vintage'; ?> </a> 
			</li>
        </ul>
      </div>
	  
	  
	  <div class="accept_notification" style="display:none;">
        <input  type="checkbox" id="giftcard" name="giftcard" <?php if($this->input->get('gift_cards') == '1'){ echo 'checked="checked"';}?> >
        <label > Accepts <?php echo $this->config->item('email_title'); ?> Gift Cards</label>
      </div>
	  
	  
	  
      <!--<div class="col-md-9 pull-right filter-button-right col-xs-12 ">
        <div class="filter-button-inside"> 
		 
		 
		 <?php if($this->input->get('color') != '') {?>
			
			<div id="restore_color">	
				<div  style="display: inline-block;" class="filter-group selected-state">
					<div class="filter-input facet">
					  <label>Color 
						  <select class="filtering-input" name="filterByColor" id="filterByColor">
								<option value=""><?php echo af_lg('lg_choose color','choose color..');?></option>
								<?php foreach($colorfilter as $c_list) {?>
									<option value="<?php echo $c_list->attr_value;?>" <?php if($c_list->attr_value == $this->input->get('color')) { echo 'selected="selected"';} ?>><?php echo $c_list->attr_value;?></option>
								<?php }?>
						   </select>
					   </label>
					</div>
					<input class="filter-submit" type="button" id="remove_color" onclick="return remove_colorFilter();" value="x" />
				</div>			    
			</div>			
			<div  id="filter_byColor" class="filter-button" style="display:none;">
			<a href="javascript:void(0);"><?php echo af_lg('lg_color','color');?></a></div>	
			<?php } else {?>	
		   <div  id="filter_byColor" class="filter-button"><a href="javascript:void(0);"><?php echo af_lg('lg_color','color');?></a></div>
        <?php }?>
		
		
		 
			<?php if($this->input->get('shipto') != '') {?>
			
			<div id="restore_to">	
				<div  style="display: inline-block;" class="filter-group selected-state">
					<div class="filter-input facet">
					  <label><?php if($this->lang->line('list_deliver') != '') { echo stripslashes($this->lang->line('list_deliver')); } else echo ' Delivers to '; ?> 
						  <select class="filtering-input" name="filterByship_to" id="filterByship_to">
								<option value=""><?php if($this->lang->line('list_choose') != '') { echo stripslashes($this->lang->line('list_choose')); } else echo 'choose country'; ?>..</option>
								<?php foreach($countryList as $c_list) {?>
									<option value="<?php echo $c_list->id;?>" <?php if($c_list->id == $this->input->get('shipto')) { echo 'selected="selected"';} ?>><?php echo $c_list->name;?></option>
								<?php }?>
						   </select>
					   </label>
					</div>
					<input class="filter-submit" type="button" id="remove_to" onclick="return remove_toFilter();" value="x" />
				</div>			    
			</div>			
			<div  id="filter_byshipTo" class="filter-button" style="display:none;"><a href="javascript:void(0);"><?php if($this->lang->line('list_ship') != '') { echo stripslashes($this->lang->line('list_ship')); } else echo 'Ship to'; ?></a></div>	
			<?php } else {?>	
		   <div  id="filter_byshipTo" class="filter-button"><a href="javascript:void(0);"><?php if($this->lang->line('list_ship') != '') { echo stripslashes($this->lang->line('list_ship')); } else echo 'Ship to'; ?></a></div>
        <?php }?>
		
		
		
			 <?php if($this->input->get('location') != '') {?>
			 <div id="filter_bylocation">
				<div  class="filter-group selected-state">
					<div id="restore_from" style="display: inline-block;">
						<div class="filter-input facet">
						  <label><?php if($this->lang->line('list_items') != '') { echo stripslashes($this->lang->line('list_items')); } else echo 'Items from'; ?> <?php echo $this->input->get('location');?></label>
						  <input type="text" class="filtering-input" value="<?php echo $this->input->get('location');?>" name="filter_byshipFrom" id="filter_byshipFrom"/>
						</div>
						<input class="filter-submit" type="button" id="remove_from" onclick="return remove_fromFilter();" value="x">
					</div>	
				</div>
			</div>		
			<?php } else {?>		
			 <div  id="filter_bylocation" class="filter-button"><a href="javascript:void(0);"><?php if($this->lang->line('list_location') != '') { echo stripslashes($this->lang->line('list_location')); } else echo 'Shop Location'; ?></a></div>			
           
		   <?php }?>
			
           <?php if($this->input->get('min_price') != '' || $this->input->get('max_price') != '') {?>
			<div id="price_clicked">
				<div class="filter-group selected-state">
					<div  id="restore_price" style="display: inline-block;">
						<div class="filter-input facet">
							<label><?php if($this->lang->line('list_price') != '') { echo stripslashes($this->lang->line('list_price')); } else echo 'Price'; ?> 
								<select class="filtering-input" name="price_filter_index" id="filter_byprice">
								   <option value=""><?php if($this->lang->line('list_any') != '') { echo stripslashes($this->lang->line('list_any')); } else echo 'Any price'; ?></option>
									<option value="1" data-max="25" data-min="" <?php if($this->input->get('min_price') == 0){ echo 'selected="selected"';} ?> ><?php if($this->lang->line('list_under') != '') { echo stripslashes($this->lang->line('list_under')); } else echo 'Under'; ?> <?php echo $currencySymbol.'  '; echo '25'.$currencyType;?></option>
									<option value="2" data-max="50" data-min="25" <?php if($this->input->get('min_price') == 25){ echo 'selected="selected"';} ?>><?php echo $currencySymbol; echo '25 – '; echo $currencySymbol; echo '50 '.$currencyType;?></option>
									<option value="3" data-max="100" data-min="50" <?php if($this->input->get('min_price') == 50){ echo 'selected="selected"';} ?>><?php echo $currencySymbol; echo '50 – '; echo $currencySymbol; echo '100 '.$currencyType;?></option>
									<option value="4" data-max="250" data-min="100" <?php if($this->input->get('min_price') == 100){ echo 'selected="selected"';} ?>><?php echo $currencySymbol; echo '100 – '; echo $currencySymbol; echo '250 '.$currencyType;?></option>
									<option value="5" data-max="500" data-min="250" <?php if($this->input->get('min_price') == 250){ echo 'selected="selected"';} ?>><?php echo $currencySymbol; echo '250 – '; echo $currencySymbol; echo '500 '.$currencyType;?></option>
									<option value="6" data-max="" data-min="500" <?php if($this->input->get('min_price') == 500){ echo 'selected="selected"';} ?>>Over <?php echo $currencySymbol.' '; echo '500'.$currencyType;?></option>
								</select>
							</label>
						</div>				
						<input type="button" id="remove_price" onclick="return remove_priceFilter();"  value="×" class="filter-submit">
					</div>	
				</div>
			</div>	
		    <div id="filter_list_price" style="display:none"><div class="filter-button"><a href="javascript:void(0);"><?php if($this->lang->line('list_price') != '') { echo stripslashes($this->lang->line('list_price')); } else echo 'Price'; ?></a></div></div>
		    
			<?php } else {?>
			
			 <div id="filter_list_price" class="filter-button"><a href="javascript:void(0);"><?php if($this->lang->line('list_price') != '') { echo stripslashes($this->lang->line('list_price')); } else echo 'Price'; ?></a></div>
            
			<?php }?>

        </div>
      </div>-->
    </div>
	
	<div id="content">
	
	<div id="secondary" class="standardized_filters"></div>
	
	<div id="primary">
       
	<div id="freewall" class="free-wall" style="margin-bottom: 51px;"> 
	<?php if($product_list->num_rows() > 0){ ?>	
		<ul style="  background: none repeat scroll 0 0 #FFFFFF;box-shadow: 0 3px 0 0 #E1E1E1;float: left;padding: 20px;width: 95%; display:none" id="loader">
			<li style="text-align: center;" ><img src="images/spinner.gif" /></li>
		</ul>
		<div class="product-list" id="tiles">
		    <?php        
				$i=0; $hover=0; foreach($product_list->result_array() as $products) {
			   $hover++;
			   $Images=explode(',',$products['image']);
			   $shopDet = $this->product_model->get_business_name($products['user_id']);
			?>
			 <div class="brick"> 
				<a href="products/<?php echo $products['seourl'];?>"> 
					<img src="images/product/org-image/<?php echo $Images[0]?>" width="100%">
				</a>
				<div class="info">
					<h3><?php echo $products['product_name'];?></h3>
					<span class="cat-name"><a href="shop-section/<?php echo $shopDet->row()->shop_seourl;?>"><?php echo $shopDet->row()->shop_name;?></a></span>
					<span class="cat-name cat-price">
						<a href="products/<?php echo $products['seourl'];?>"> <?php echo $currencySymbol; if($products['price'] != 0.00) { echo number_format($currencyValue*$products['price'],2); } else { echo number_format($currencyValue*$products['base_price'],2); echo '+'; } echo  $currencyType;?></a> 
					</span> 
				 </div>
				 <div class="collections-ui">
			
					 <div  class="favorite-container">
					  <?php if($loginCheck !=''){
						if($products['user_id']==$loginCheck){ ?>
						<button onclick="return ownProductFav();" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
								<span class="icon"></span> <span class="ie-fix">&nbsp;</span> 
						</button>
						<?php
						}else{
						$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($products['id']));
						if(empty($favArr)){ ?>
							 <button onclick="return changeProductToFavourite('<?php echo stripslashes($products['id']); ?>','Fresh',thia);" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
								<span class="icon"></span> <span class="ie-fix">&nbsp;</span> 
							 </button>
						<?php } else {?>
							<button onclick="return changeProductToFavourite('<?php echo stripslashes($products['id']); ?>','Old',this);" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
							<span class="icon fav-active"></span> <span class="ie-fix">&nbsp;</span> 
						 </button>
						<?php }}} else {?> 
							<button onclick="return changeProductToFavourite('<?php echo stripslashes($products['id']); ?>','Fresh',this);" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
							<span class="icon"></span> <span class="ie-fix">&nbsp;</span> 
						 </button>
						<?php }?>
					 </div>
				
					 
					 <div  class="collect-container">
						 <button onclick="return hoverView('<?php echo $products['id'];?>');"" class="btn-collect btn-dropdown  inline-overlay-trigger ollection-add-action" type="button"> 
							<span class="icon"></span> 
							<span class="icon-dropdown"></span> 
							<span class="ie-fix">&nbsp;</span>
						</button>
						
					  <div id="hoverlist<?php echo $products['id'];?>" class="hover_lists">
						<h2>Your Lists</h2>
						<div class="lists_check">
						<?php foreach($userLists as $Lists){ 
							$haveListIn = $this->user_model->check_list_products(stripslashes($products['id']),$Lists['id'])->num_rows();
							#echo $haveListIn;
							if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}
						?>
						 <input type="checkbox" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo stripslashes($products['id']); ?>');" <?php echo $chk; ?> />
						 <label><?php echo $Lists['name']; ?></label> <br />
						 <?php } ?>
						 
						 <?php if(!empty($userRegistry)){ 
								$haveRegisryIn = $this->user_model->check_registry_products($products['id'],$userRegistry->user_id)->num_rows();
								if($haveRegisryIn>0){$chk='checked="checked"';}else{ $chk='';}
							?>
							<input type="checkbox"  onclick="return manageRegisrtyProduct('<?php echo $userRegistry->user_id; ?>','<?php echo $products['id']; ?>');" <?php echo $chk; ?> />
							<label><span class="registry_icon"></span><?php if($this->lang->line('prod_wedding') != '') { echo stripslashes($this->lang->line('prod_wedding')); } else echo 'Wedding Registry'; ?></label>
							<?php }  ?>						
						  </div>       
						  
						<div class="new_list">
							<form action="site/user/add_list" method="post">
								<input type="hidden" value="1" name="ddl" />
								<input type="hidden" value="<?php echo $products['id']; ?>" name="productId" />
								<input type="text" placeholder="<?php if($this->lang->line('user_new_list') != '') { echo stripslashes($this->lang->line('user_new_list')); } else echo 'New list'; ?>" class="list_scroll" name="list" id="creat_list_<?php echo $i; ?>" />
								<input type="submit" value="<?php if($this->lang->line('user_add') != '') { echo stripslashes($this->lang->line('user_add')); } else echo 'Add'; ?>" class="primary-button" onclick="return validate_create_list('<?php echo $i; ?>');" />
							</form>
						</div>
						
					</div> 		 
					
					 </div>
				</div> 
				
				
				
				
				
			</div>
		 <?php }?>
		 </div> 
  <?php } else { ?>
		<div style="margin:20px 0" class="search-error">
		  <h3 class="crumbs"> <?php if($this->lang->line('list_selections') != '') { echo stripslashes($this->lang->line('list_selections')); } else echo 'Darn. No items match your selections'; ?>. </h3>
		  <p class="newline"> <?php if($this->lang->line('list_try') != '') { echo stripslashes($this->lang->line('list_try')); } else echo 'Try'; ?> <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><?php if($this->lang->line('list_showing') != '') { echo stripslashes($this->lang->line('list_showing')); } else echo 'showing all items'; ?> .</a>  </p>
		</div>
	 <?php }?>
	 
	 
	 
	</div>
	
	</div>
	
	</div>
	 
	 <div id="infscr-loading" style="text-align: center; display: none;">
		<span><img src="images/spinner.gif" alt="Loading..." /></span>
	</div>
	<div class="landing_pagination" id="landing_page_id" style="display: none;">
		<?php echo $paginationDisplay;?>
	</div>
	 </div>
  </section>
</section>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script>
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script> 

<input type="hidden" name="madebyFilter" id="madebyFilter" value="<?php if($this->input->get('marketplace') != ''){ echo $this->input->get('marketplace');}?>"/>
<input type="hidden" name="pricebyFilter" id="pricebyFilter" value="<?php if($this->input->get('min_price') != ''){ echo '&min_price='.$this->input->get('min_price');} if($this->input->get('max_price') != ''){ echo '&max_price='.$this->input->get('max_price');}?>"/>
<input type="hidden" name="shipfromFilter" id="shipfromFilter" value="<?php if($this->input->get('location') != ''){ echo $this->input->get('location');}?>"/>
<input type="hidden" name="shiptoFilter" id="shiptoFilter" value="<?php if($this->input->get('shipto') != ''){ echo $this->input->get('shipto');}?>"/>
<input type="hidden" name="colorFilter" id="colorFilter" value="<?php if($this->input->get('color') != ''){ echo $this->input->get('color');}?>"/>

<input type="hidden" name="fullurl" id="fullurl" value="<?php echo $lnk;?>"/>
 <input type="hidden" value="<?php if($filtervals != ''){ echo 'Yes';} else { echo 'No';}?>" id="backstatus">
<!-- section_end -->

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
						var wall = new freewall("#freewall");
							wall.reset({
								selector: '.brick',
								animate: true,
								cellW: 280,
								cellH: 'auto',
								onResize: function() {
									wall.fitWidth();
								}
						});
			
						wall.container.find('.brick img').load(function() {
							wall.fitWidth();
						});
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
			        itemWidth: 280 // Optional, the width of a grid item
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
<!-- include jQuery 

<script src="js/site/jquery.wookmark.js"></script> -->

<script type="text/javascript">
    $(document).ready(new function() {
      // Prepare layout options.
      var options = {
        autoResize: true, // This will auto-update the layout when the browser window is resized.
        container: $('#freewall'), // Optional, used for some extra CSS styling
        offset: 8, // Optional, the distance between grid items
        itemWidth: 280 // Optional, the width of a grid item
      };

      // Get a reference to your grid items.
      var handler = $('#tiles').next("div");

      // Call the layout function.
      //handler.wookmark(options);

      // Capture clicks on grid items.
     
    });
  </script>

 <script type="text/javascript">
	$(document).ready(function() {
	  window.setTimeout(function(){ $("html, body").animate({ scrollTop: 50 }, 100); },100);
    });
 

</script>
<script>
$("#filter_byprice").trigger('click'); 
$(document).ready(function(){ 
 if (window.history && window.history.pushState) { 
		$(window).on('popstate', function() {
			if($("#backstatus").val() == 'Yes'){
			var fullUrl=$('#fullurl').val();
			var consta=confirm('You want to completely leave this page? you will loss your filters.');
				if(consta){
					window.location.href=baseURL+'category-list/<?php echo $this->uri->segment(2);?>';
				}
		    } 
		});
 }


  
  
  $("#filter_list_price").click(function(){ 
    $("#filter_list_price").html('<div class="filter-group selected-state"><div  id="restore_price" style="display: inline-block;"><div class="filter-input facet"><label><?php if($this->lang->line('list_price') != '') { echo stripslashes($this->lang->line('list_price')); } else echo 'Price'; ?> <select name="price_filter_index" class="filtering-input" id="filter_byprice"><option value=""><?php if($this->lang->line('list_any') != '') { echo stripslashes($this->lang->line('list_any')); } else echo 'Any price'; ?></option><option value="1" data-max="25" data-min="" <?php if($this->input->get('min_price') == 0){ echo 'selected="selected"';} ?> ><?php if($this->lang->line('list_under') != '') { echo stripslashes($this->lang->line('list_under')); } else echo 'Under'; ?> <?php echo $currencySymbol.'  '; echo '25'.$currencyType;?></option><option value="2" data-max="50" data-min="25" <?php if($this->input->get('min_price') == 25){ echo 'selected="selected"';} ?>><?php echo $currencySymbol; echo '25 – '; echo $currencySymbol; echo '50 '.$currencyType;?></option><option value="3" data-max="100" data-min="50" <?php if($this->input->get('min_price') == 50){ echo 'selected="selected"';} ?>><?php echo $currencySymbol; echo '50 – '; echo $currencySymbol; echo '100 '.$currencyType;?></option><option value="4" data-max="250" data-min="100" <?php if($this->input->get('min_price') == 100){ echo 'selected="selected"';} ?>><?php echo $currencySymbol; echo '100 – '; echo $currencySymbol; echo '250 '.$currencyType;?></option><option value="5" data-max="500" data-min="250" <?php if($this->input->get('min_price') == 250){ echo 'selected="selected"';} ?>><?php echo $currencySymbol; echo '250 – '; echo $currencySymbol; echo '500 '.$currencyType;?></option><option value="6" data-max="" data-min="500" <?php if($this->input->get('min_price') == 500){ echo 'selected="selected"';} ?>>Over <?php echo $currencySymbol.' '; echo '500'.$currencyType;?></option></select></label></div><input type="button" id="remove_price" onclick="return remove_priceFilter();" value="<?php if($this->lang->line('list_go') != '') { echo stripslashes($this->lang->line('list_go')); } else echo 'Go'; ?>" class="filter-submit"></div></div>');
	$('#filter_list_price').removeClass('filter-button');
	$('#filter_list_price').attr('id', 'price_clicked');
	//filter_list_price
	  });
});





$(document).ready(function(){
  $("#filter_bylocation").click(function(){ 
    $("#filter_bylocation").html('<div  class="filter-group selected-state"><div id="restore_from" style="display: inline-block;"><div class="filter-input facet"><label><?php if($this->lang->line('list_items') != '') { echo stripslashes($this->lang->line('list_items')); } else echo 'Items from'; ?> <?php echo $this->input->get('location');?></label><input type="text" class="filtering-input" value="<?php echo $this->input->get('location');?>" name="filter_byshipFrom" id="filter_byshipFrom"/></div><input class="filter-submit" type="button" id="remove_from" onclick="return ship_fromFilter();" value="<?php if($this->lang->line('list_go') != '') { echo stripslashes($this->lang->line('list_go')); } else echo 'Go'; ?>"></div></div>');
	$('#filter_bylocation').removeClass('filter-button');
	$('#filter_bylocation').attr('id', 'fromloc_clicked');
	  });
});

		

$(document).ready(function(){
  $("#filter_byshipTo").click(function(){ 
    $("#filter_byshipTo").html('<div  style="display: inline-block;" class="filter-group selected-state"><div class="filter-input facet"><label><?php if($this->lang->line('list_deliver') != '') { echo stripslashes($this->lang->line('list_deliver')); } else echo ' Delivers to '; ?><select class="filtering-input" name="filterByship_to" id="filterByship_to"><option value=""><?php if($this->lang->line('list_choose') != '') { echo stripslashes($this->lang->line('list_choose')); } else echo 'choose country'; ?>..</option><?php foreach($countryList as $c_list) {?><option value="<?php echo $c_list->id;?>" <?php if($c_list->id == $this->input->get('shipto')) { echo 'selected="selected"';} ?>><?php echo $c_list->name;?></option><?php }?></select></label></div><input class="filter-submit" type="button" id="remove_to" onclick="return remove_toFilter();" value="<?php if($this->lang->line('list_go') != '') { echo stripslashes($this->lang->line('list_go')); } else echo 'Go'; ?>" /></div>');
	$('#filter_byshipTo').removeClass('filter-button');
	$('#filter_byshipTo').attr('id', 'toloc_clicked');
	  }); 
});


$(document).ready(function(){
	  $("#filter_byColor").click(function(){ 
	    $("#filter_byColor").html('<div  style="display: inline-block;" class="filter-group selected-state"><div class="filter-input facet"><label><?php echo af_lg('lg_color','color');?> <select class="filtering-input" name="filterByColor" id="filterByColor"><option value=""><?php echo af_lg('lg_choose color','choose color..');?></option><?php foreach($colorfilter as $c_list) {?><option value="<?php echo $c_list->attr_value;?>" <?php if($c_list->attr_value == $this->input->get('color')) { echo 'selected="selected"';} ?>><?php echo $c_list->attr_value;?></option><?php }?></select></label></div><input class="filter-submit" type="button" id="remove_to" onclick="return remove_colorFilter();" value="<?php if($this->lang->line('list_go') != '') { echo stripslashes($this->lang->line('list_go')); } else echo 'Go'; ?>" /></div>');
		$('#filter_byColor').removeClass('filter-button');
		$('#filter_byColor').attr('id', 'color_clicked');
		  }); 
	});



$(document).ready(function(){
  $("#handmade").click(function(){    
       
	  $("#backstatus").val('Yes'); 
	  $('#loader').css('display','block');
	  $('#tiles').css('display','none');	  
         
	  $('#m_place1').removeClass('active'); 
	  $('#m_place3').removeClass('active');
	  $('#m_place2').addClass('active');
	  $('#madebyFilter').val('handmade'); 
		  var shipfrom='';
		  if($('#shipfromFilter').val() != '')
		  {
			  var shipfrom='&location='+$('#shipfromFilter').val();
		  }
		  var shipto='';
		  if($('#shiptoFilter').val() != '')
		  {
			  var shipto='&shipto='+$('#shiptoFilter').val();
		  }
		  var pricefilter='';
		  if($('#pricebyFilter').val() != '')
		  {
			  var pricefilter=$('#pricebyFilter').val();
		  }

		  var color='';
		  if($('#colorFilter').val() != '')
		  {
			  var color='&color='+$('#colorFilter').val();
		  }
		   
		  var filtergiftcard=document.getElementById('giftcard').checked;
		  if(filtergiftcard){
		   var giftcard='&gift_cards='+1;
		  } else {
		   var giftcard='';
		  }
	  var fullUrl=$('#fullurl').val(); //fullurl
	  var filterid=document.getElementById('bigCatid').value;  
	  if (history.pushState) {
	     window.history.pushState("object or string", "Title",fullUrl+"?marketplace="+this.id+shipfrom+shipto+pricefilter+giftcard+color);
	  }
	  window.location.reload();
	  /* $.get('site/product/Load_ajax_products_list?cat_id='+filterid+'&marketplace='+this.id+shipfrom+shipto+pricefilter+giftcard, function(data) {
	  
	  $('#loader').css('display','none');
	  $('#tiles').css('display','block');		
	  $("#tiles").html(data);
			
			//closeActionAfter();
	}); */
    
  });
});

$(document).ready(function(){
  $("#vintage").click(function(){
	  $("#backstatus").val('Yes'); 
	  $('#loader').css('display','block');
	  $('#tiles').css('display','none');	
	  
	  $('#filter_by_all_products').removeClass('first_list_seleted first_list');
	  $('#handmade').removeClass('first_list_seleted first_list');
	  $('#vintage').addClass('first_list first_list_seleted');
	  $('#madebyFilter').val('vintage');
		  var shipfrom='';
		  if($('#shipfromFilter').val() != '')
		  {
			  var shipfrom='&location='+$('#shipfromFilter').val();
		  }
		  var shipto='';
		  if($('#shiptoFilter').val() != '')
		  {
			  var shipto='&shipto='+$('#shiptoFilter').val();
		  }
		  var pricefilter='';
		  if($('#pricebyFilter').val() != '')
		  {
			  var pricefilter=$('#pricebyFilter').val();
		  }
		  var color='';
		  if($('#colorFilter').val() != '')
		  {
			  var color='&color='+$('#colorFilter').val();
		  }
		  var filtergiftcard=document.getElementById('giftcard').checked;
		  if(filtergiftcard){
		   var giftcard='&gift_cards='+1;
		  } else {
		   var giftcard='';
		  }
	  var fullUrl=$('#fullurl').val();
	  var filterid=document.getElementById('bigCatid').value; 
	  if (history.pushState) {
        window.history.pushState("object or string", "Title",fullUrl+"?marketplace="+this.id+shipfrom+shipto+pricefilter+giftcard+color);
	  }
	  window.location.reload();
	  /* $.get('site/product/Load_ajax_products_list?cat_id='+filterid+'&marketplace='+this.id+shipfrom+pricefilter+shipto+giftcard, function(data) {
	 
	  
	  $('#loader').css('display','none');
	  $('#tiles').css('display','block');
	  $("#tiles").html(data);
			//closeActionAfter();
	}); */
    
  });
});



$(document).change(function(){
  $("#filter_byprice").click(function(){ //remove_price
      $("#backstatus").val('Yes'); 
      $('#loader').css('display','block');
	  $('#tiles').css('display','none');	
  
      $("#remove_price").val('x');
	  var filterPrice=document.getElementById('filter_byprice').value;
	  if(filterPrice==1)
	  {
		  var minPrice=0;
		  var maxPrice=25;
	  }
	 if(filterPrice==2)
	  {
		  var minPrice=25;
		  var maxPrice=50;
	  }
	  if(filterPrice==3)
	  {
		  var minPrice=50;
		  var maxPrice=100;
	  }
	  if(filterPrice==4)
	  {
		  var minPrice=100;
		  var maxPrice=250;
	  }
	  if(filterPrice==5)
	  {
		  var minPrice=250;
		  var maxPrice=500;
	  }
	   if(filterPrice==6) 
	  {
		  var minPrice=500;
		  var maxPrice='';
	  }
	      var madeby='';
		  if($('#madebyFilter').val() != '')
		  {
			  var madeby='&marketplace='+$('#madebyFilter').val();
		  }
	      var shipfrom='';
		  if($('#shipfromFilter').val() != '')
		  {
			  var shipfrom='&location='+$('#shipfromFilter').val();
		  }
		  var shipto='';
		  if($('#shiptoFilter').val() != '')
		  {
			  var shipto='&shipto='+$('#shiptoFilter').val();
		  }
		  var color='';
		  if($('#colorFilter').val() != '')
		  {
			  var color='&color='+$('#colorFilter').val();
		  }
		  var filtergiftcard=document.getElementById('giftcard').checked;
		  if(filtergiftcard){
		   var giftcard='&gift_cards='+1;
		  } else {
		   var giftcard='';
		  }
	  if(minPrice != '' || maxPrice != '')
	  {
		  var minp='&min_price='+minPrice;
		  if(maxPrice != '')
		  {
			var maxp= '&max_price='+maxPrice;
		  } else 
		  {
			var maxp='';  
		  }
		  var Catid=document.getElementById('current_url_prod_list').value;
		  var fullUrl=$('#fullurl').val();
		  if(filterPrice!=''){
			  $('#pricebyFilter').val(minp+maxp);
			  if (history.pushState) {
			    window.history.pushState("object or string", "Title",fullUrl+'?'+minp+maxp+shipto+giftcard+madeby+shipfrom+color);
			  }
			  window.location.reload();
			  /* $.get('site/product/Load_ajax_products_list?cat_id='+Catid+minp+maxp+giftcard+madeby+shipto+shipfrom, function(data) {
			  
			  $('#loader').css('display','none');
	          $('#tiles').css('display','block');
			  $("#tiles").html(data); 
		  	  });  */
		  } else {
		      if (history.pushState) {
		      window.history.pushState("object or string", "Title",fullUrl+'?'+giftcard+madeby+shipto+shipfrom+color);
			  }
			  window.location.reload();
			  /* $.get('site/product/Load_ajax_products_list?cat_id='+Catid+'?'+giftcard+madeby+shipto+shipfrom, function(data) {
				
			  $('#loader').css('display','none');
	          $('#tiles').css('display','block');
			  $("#tiles").html(data); 
		  	  });  */
			  $('#pricebyFilter').val('');
		  }
	  } 
  });
});
//
$(document).click(function(){ 
  $("#filterByship_to").change(function(){ 
           $("#backstatus").val('Yes'); 
		  $('#loader').css('display','block');
		  $('#tiles').css('display','none');	
	  
	      var filtercountry=document.getElementById('filterByship_to').value;
		  $("#remove_to").val('x');
		  var madeby='';
		  if($('#madebyFilter').val() != '')
		  {
			  var madeby='&marketplace='+$('#madebyFilter').val();
		  }
		  var shipfrom='';
		  if($('#shipfromFilter').val() != '')
		  {
			  var shipfrom='&location='+$('#shipfromFilter').val();
		  }
		  var color='';
		  if($('#colorFilter').val() != '')
		  {
			  var color='&color='+$('#colorFilter').val();
		  }
		  var pricefilter='';
		  if($('#pricebyFilter').val() != '')
		  {
			  var pricefilter=$('#pricebyFilter').val();
		  }
		  var filtergiftcard=document.getElementById('giftcard').checked;
		  if(filtergiftcard){
		   var giftcard='&gift_cards='+1;
		  } else {
		   var giftcard='';
		  } 
		  var Catid=document.getElementById('current_url_prod_list').value;
		  var fullUrl=$('#fullurl').val();
		  if(filtercountry != ''){  
			  $('#shiptoFilter').val(filtercountry);
			  if (history.pushState) {
			   window.history.pushState("object or string", "Title",fullUrl+'?shipto='+filtercountry+giftcard+madeby+shipfrom+pricefilter+color);
			  }
			  window.location.reload();
			  /* $.get('site/product/Load_ajax_products_list?cat_id='+Catid+'&shipto='+filtercountry+madeby+giftcard+shipfrom+pricefilter, function(data) {
			  
			  $('#loader').css('display','none');
	          $('#tiles').css('display','block');
			  $("#tiles").html(data); 
			  });  */
		  } else {
		       if (history.pushState) { 
		       window.history.pushState("object or string", "Title",fullUrl+'?'+giftcard+madeby+shipfrom+pricefilter+color);
			   }
			   window.location.reload();
			  /* $.get('site/product/Load_ajax_products_list?cat_id='+Catid+'?'+madeby+giftcard+shipfrom+pricefilter, function(data) {
			  
		      $('#loader').css('display','none');
	          $('#tiles').css('display','block');
			  $("#tiles").html(data); 
			  }); */ 
			  $('#shiptoFilter').val('');
		  }
  });
});

function ship_fromFilter(){
	
	      $("#backstatus").val('Yes'); 
	      $('#loader').css('display','block');
		  $('#tiles').css('display','none');
	
	      var filtercountry=document.getElementById('filter_byshipFrom').value; 
		  
		
		$('#fromloc_clicked').html('<div  class="filter-group selected-state"><div id="restore_from" style="display: inline-block;"><div class="filter-input facet"><label><?php if($this->lang->line('list_items') != '') { echo stripslashes($this->lang->line('list_items')); } else echo 'Items from'; ?> </label><input type="hidden" class="filtering-input" value="'+filtercountry+'" name="filter_byshipFrom" id="filter_byshipFrom"/> '+filtercountry+'</div><input class="filter-remove filter-submit" type="button" id="remove_from" onclick="return remove_fromFilter();" value="x"></div></div>');
		
				
	      var madeby='';
		  if($('#madebyFilter').val() != '')
		  {
			  var madeby='&marketplace='+$('#madebyFilter').val();
		  }
		  var pricefilter='';
		  if($('#pricebyFilter').val() != '')
		  {
			  var pricefilter=$('#pricebyFilter').val();
		  }
		  var shipto='';
		  if($('#shiptoFilter').val() != '')
		  {
			  var shipto='&shipto='+$('#shiptoFilter').val();
		  }
		  var color='';
		  if($('#colorFilter').val() != '')
		  {
			  var color='&color='+$('#colorFilter').val();
		  }

		  
	      var filtergiftcard=document.getElementById('giftcard').checked;
		  if(filtergiftcard){
		  var giftcard='&gift_cards='+1;
		  } else {
		   var giftcard='';
		  } 
		  var Catid=document.getElementById('current_url_prod_list').value;
		  var fullUrl=$('#fullurl').val();
		  if(filtercountry != ''){
			  $('#shipfromFilter').val(filtercountry);
			  if (history.pushState) {
			   window.history.pushState("object or string", "Title",fullUrl+'?location='+filtercountry+shipto+giftcard+madeby+pricefilter+color);
			  }
			  window.location.reload();
			 /*  $.get('site/product/Load_ajax_products_list?cat_id='+Catid+'&location='+filtercountry+giftcard+shipto+madeby+pricefilter, function(data) {
			  
			  $('#loader').css('display','none');
	          $('#tiles').css('display','block');
			  $("#tiles").html(data); 
		      });  */
		  } else {
		      if (history.pushState) {
		        window.history.pushState("object or string", "Title",fullUrl+'?'+filtercountry+giftcard+shipto+madeby+pricefilter+color);
			  }
			  window.location.reload();
		      /* $.get('site/product/Load_ajax_products_list?cat_id='+Catid+'?'+giftcard+madeby+shipto+pricefilter, function(data) {
		      
			  $('#loader').css('display','none');
	          $('#tiles').css('display','block');
			  $("#tiles").html(data); 
			   });  */
			  $('#shipfromFilter').val('');
		  }
	//}
}

$(document).ready(function(){ 
  $("#giftcard").change(function(){
	      $("#backstatus").val('Yes'); 
	      $('#loader').css('display','block');
		  $('#tiles').css('display','none');
	  
		   var shipfrom='';
		   if($('#shipfromFilter').val() != '')
		   {
			   var shipfrom='&location='+$('#shipfromFilter').val();
		   }
	       var madeby='';
		  if($('#madebyFilter').val() != '')
		  {
			  var madeby='&marketplace='+$('#madebyFilter').val();
		  }
		  var pricefilter='';
		  if($('#pricebyFilter').val() != '')
		  {
			  var pricefilter=$('#pricebyFilter').val();
		  }
	      var shipto='';
		  if($('#shiptoFilter').val() != '')
		  {
			  var shipto='&shipto='+$('#shiptoFilter').val();
		  }
		  var color='';
		  if($('#colorFilter').val() != '')
		  {
			  var color='&color='+$('#colorFilter').val();
		  }
		  var Catid=document.getElementById('current_url_prod_list').value;
		  var filtergiftcard=document.getElementById('giftcard').checked;
		  if(filtergiftcard){
		   var giftcard='&gift_cards='+1;
		  } else {
		   var giftcard='';
		  }
		  var Catid=document.getElementById('current_url_prod_list').value;
		  var fullUrl=$('#fullurl').val();
		  if (history.pushState) {
		    window.history.pushState("object or string", "Title",fullUrl+'?'+giftcard+shipto+shipfrom+madeby+pricefilter+color);
		  }
		  window.location.reload();
		  /* $.get('site/product/Load_ajax_products_list?cat_id='+Catid+giftcard+shipfrom+madeby+shipto+pricefilter, function(data) {
		  
		  $('#loader').css('display','none');
	      $('#tiles').css('display','block');
		  $("#tiles").html(data); 
		 }); */ 
		
  });
  
 
  
});

function remove_priceFilter(){
$('#filter_byprice').val('');  //
var selectedPrice=$('#filter_byprice').val();
$('#pricebyFilter').val('');
$("#filter_byprice").click(); 
if($('#remove_price').val() == 'x'){   
$('#filter_list_price').html('<li>Price</li>');
}
$('#price_clicked').attr('id', 'filter_list_price'); 
}



function remove_priceFilter1(){
$('#filter_byprice').val('');  //
var selectedPrice=$('#filter_byprice').val();
$('#pricebyFilter').val('');

$("#backstatus").val('Yes'); 
$('#loader').css('display','block');
$('#tiles').css('display','none');

var filterPrice=document.getElementById('filter_byprice').value;
	  if(filterPrice==1)
	  {
		  var minPrice=0;
		  var maxPrice=25;
	  }
	 if(filterPrice==2)
	  {
		  var minPrice=25;
		  var maxPrice=50;
	  }
	  if(filterPrice==3)
	  {
		  var minPrice=50;
		  var maxPrice=100;
	  }
	  if(filterPrice==4)
	  {
		  var minPrice=100;
		  var maxPrice=250;
	  }
	  if(filterPrice==5)
	  {
		  var minPrice=250;
		  var maxPrice=500;
	  }
	   if(filterPrice==6) 
	  {
		  var minPrice=500;
		  var maxPrice='';
	  }
	      var madeby='';
		  if($('#madebyFilter').val() != '')
		  {
			  var madeby='&marketplace='+$('#madebyFilter').val();
		  }
	      var shipfrom='';
		  if($('#shipfromFilter').val() != '')
		  {
			  var shipfrom='&location='+$('#shipfromFilter').val();
		  }
		  var shipto='';
		  if($('#shiptoFilter').val() != '')
		  {
			  var shipto='&shipto='+$('#shiptoFilter').val();
		  }
		  var color='';
		  if($('#colorFilter').val() != '')
		  {
			  var color='&color='+$('#colorFilter').val();
		  }
		  
		  var filtergiftcard=document.getElementById('giftcard').checked;
		  if(filtergiftcard){
		   var giftcard='&gift_cards='+1;
		  } else {
		   var giftcard='';
		  }
	  if(minPrice != '' || maxPrice != '')
	  {
		  var minp='&min_price='+minPrice;
		  if(maxPrice != '')
		  {
			var maxp= '&max_price='+maxPrice;
		  } else 
		  {
			var maxp='';  
		  }
		  var Catid=document.getElementById('current_url_prod_list').value;
		  var fullUrl=$('#fullurl').val();
		  if(filterPrice!=''){
			  $('#pricebyFilter').val(minp+maxp);
			  if (history.pushState) {
			  window.history.pushState("object or string", "Title",fullUrl+'?'+minp+maxp+shipto+giftcard+madeby+shipfrom+color);
			  }
			  window.location.reload();
			  /* $.get('site/product/Load_ajax_products_list?cat_id='+Catid+minp+maxp+giftcard+shipto+madeby+shipfrom, function(data) {
			  
			  $('#loader').css('display','none');
	          $('#tiles').css('display','block');
			  $("#tiles").html(data); 
		  	  });  */
		  } else {
		      if (history.pushState) {
		      window.history.pushState("object or string", "Title",fullUrl+'?'+giftcard+shipto+madeby+shipfrom+color);
			  }
			  window.location.reload();
			  /* $.get('site/product/Load_ajax_products_list?cat_id='+Catid+'?'+giftcard+shipto+madeby+shipfrom, function(data) {
			 
			 
			  $('#loader').css('display','none');
	          $('#tiles').css('display','block');
			  $("#tiles").html(data); 
		  	  }); */ 
			  $('#pricebyFilter').val('');
		  }
	  } 

if($('#remove_price').val() == 'x'){   
$('#filter_list_price').html('<li>Price</li>');
}
$('#remove_price').val('Go');
$('#price_clicked').attr('id', 'filter_list_price'); 
}



function remove_fromFilter(){
	if($('#remove_from').val() == 'x'){
	$('#filter_byshipFrom').val('');  
	 ship_fromFilter();   
	$('#shipfromFilter').val(''); 
	$('#restore_from').html('<div  class="filter-group selected-state"><div id="restore_from" style="display: inline-block;"><div class="filter-input facet"><label><?php if($this->lang->line('list_items') != '') { echo stripslashes($this->lang->line('list_items')); } else echo 'Items from'; ?> </label><input type="text" class="filtering-input" value="" name="filter_byshipFrom" id="filter_byshipFrom"/></div><input class="filter-submit" type="button" id="remove_from" onclick="return ship_fromFilter();" value="<?php if($this->lang->line('list_go') != '') { echo stripslashes($this->lang->line('list_go')); } else echo 'Go'; ?>"></div></div>'); 
	$('#filter_bylocation').attr('id', 'fromloc_clicked'); 
	
	//$('#fromloc_clicked').attr('id', 'filter_bylocation'); 
	} else {
	ship_fromFilter();
	}

}

function remove_toFilter(){
	if($("#remove_to").val() == 'x') {
$('#filterByship_to').val(''); 
$("#filterByship_to").trigger('click');
$("#filterByship_to").change();
$('#shiptoFilter').val('');

//alert($('#shiptoFilter').val());
$('#restore_to').html('<div  style="display: inline-block;" class="filter-group selected-state"><div class="filter-input facet"><label><?php if($this->lang->line('list_deliver') != '') { echo stripslashes($this->lang->line('list_deliver')); } else echo ' Delivers to '; ?><select class="filtering-input" name="filterByship_to" id="filterByship_to"><option value=""><?php if($this->lang->line('list_choose') != '') { echo stripslashes($this->lang->line('list_choose')); } else echo 'choose country'; ?>..</option><?php foreach($countryList as $c_list) {?><option value="<?php echo $c_list->id;?>" <?php if($c_list->id == $this->input->get('shipto')) { echo 'selected="selected"';} ?>><?php echo $c_list->name;?></option><?php }?></select></label></div><input class="filter-submit" type="button" id="remove_to" onclick="return remove_toFilter();" value="<?php if($this->lang->line('list_go') != '') { echo stripslashes($this->lang->line('list_go')); } else echo 'Go'; ?>" /></div>');




$('#toloc_clicked').attr('id', 'filter_byshipTo'); 
	} 
}


function remove_colorFilter(){
	if($("#remove_color").val() == 'x') {
$('#filterByColor').val(''); 
$("#filterByColor").trigger('click');
$("#filterByColor").change();
$('#colorFilter').val('');

//alert($('#shiptoFilter').val());
$('#restore_color').html('<div  style="display: inline-block;" class="filter-group selected-state"><div class="filter-input facet"><label>Color<select class="filtering-input" name="filterByColor" id="filterByColor"><option value="">choose color ..</option><?php foreach($colorfilter as $c_list) {?><option value="<?php echo $c_list->attr_value;?>" <?php if($c_list->attr_value == $this->input->get('color')) { echo 'selected="selected"';} ?>><?php echo $c_list->attr_value;?></option><?php }?></select></label></div><input class="filter-submit" type="button" id="remove_color" onclick="return remove_colorFilter();" value="<?php if($this->lang->line('list_go') != '') { echo stripslashes($this->lang->line('list_go')); } else echo 'Go'; ?>" /></div>');


$('#color_clicked').attr('id', 'filter_byColor'); 
	} 
}




function load_producs(val)
{
	
	var Catid=val.id; //alert(Catid); changedsubCatstatus
	var Catname=val.name; 
	$("#bigCatid").val(Catid);
	$("#feed-header").html(Catname);
	//$('#changedsubCatstatus').css('display','block');
	$("#current_url_prod_list").val(Catid); 
	$("#filter_by_all_products").attr("href", "browse/"+Catid)
	//window.location.hash = '/'+Catid;
	
   window.history.pushState("object or string", "Title","browse/"+Catid);
	window.location.reload();
	//$('#tiles').before('<div><img src="images/loading.gif" alt="Loading products List" /></div>');
	/* $.get('site/product/Load_ajax_products_list?cat_id='+Catid, function(data) {
			//$("#tiles").html(data);
	}); */
	
   

}


$(document).click(function(){ 
	  $("#filterByColor").change(function(){ 
	           $("#backstatus").val('Yes'); 
			  $('#loader').css('display','block');
			  $('#tiles').css('display','none');	
		  
		      var filtercolor=document.getElementById('filterByColor').value;
			  $("#remove_color").val('x');
			  var madeby='';
			  if($('#madebyFilter').val() != '')
			  {
				  var madeby='&marketplace='+$('#madebyFilter').val();
			  }
			  var shipfrom='';
			  if($('#shipfromFilter').val() != '')
			  {
				  var shipfrom='&location='+$('#shipfromFilter').val();
			  }
			  var pricefilter='';
			  if($('#pricebyFilter').val() != '')
			  {
				  var pricefilter=$('#pricebyFilter').val();
			  }
			  var shipto='';
			  if($('#shiptoFilter').val() != '')
			  {
				  var shipto='&shipto='+$('#shiptoFilter').val();
			  }

			  
			  var filtergiftcard=document.getElementById('giftcard').checked;
			  if(filtergiftcard){
			   var giftcard='&gift_cards='+1;
			  } else {
			   var giftcard='';
			  } 
			  
			  var Catid=document.getElementById('current_url_prod_list').value;
			  var fullUrl=$('#fullurl').val();

			  if(filtercolor != ''){  
				  $('#colorFilter').val(filtercolor);
				  if (history.pushState) {
				   window.history.pushState("object or string", "Title",fullUrl+'?color='+filtercolor+giftcard+madeby+shipfrom+pricefilter+shipto);
				  }
				  window.location.reload();
				  /* $.get('site/product/Load_ajax_products_list?cat_id='+Catid+'&shipto='+filtercountry+madeby+giftcard+shipfrom+pricefilter, function(data) {
				  
				  $('#loader').css('display','none');
		          $('#tiles').css('display','block');
				  $("#tiles").html(data); 
				  });  */
			  } else {
			       if (history.pushState) { 
			       window.history.pushState("object or string", "Title",fullUrl+'?'+giftcard+madeby+shipfrom+pricefilter+shipto);
				   }
				   window.location.reload();
				  /* $.get('site/product/Load_ajax_products_list?cat_id='+Catid+'?'+madeby+giftcard+shipfrom+pricefilter, function(data) {
				  
			      $('#loader').css('display','none');
		          $('#tiles').css('display','block');
				  $("#tiles").html(data); 
				  }); */ 
				  $('#colorFilter').val('');
			  }
	  });
	});



</script> 

<?php $this->load->view('site/templates/footer'); ?>