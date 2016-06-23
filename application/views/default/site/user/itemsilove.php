<?php 

$this->load->view('site/templates/header');

$this->load->model('user_model');

//echo "<pre>";print_r($viewprofile->row());

//echo $viewprofile->row()->full_name;die;

?>



<script src="js/site/scrolling_javascript.js"> </script>

<script>

$(document).ready(function() {

	$('#product_listing').scrollPagination({

		nop     : 4, // The number of posts per scroll to be loaded

		offset  : 8, // Initial offset, begins at 0 in this case

		error   : 'No More Activity!', // When the user reaches the end this is the message that is

		                            // displayed. You can change this if you want.

		path   : 'site/user/ajax_people_favorite_list_itemsilove/<?php echo $this->uri->segment(2,0); ?>',

		delay   : 500, // When you scroll down the posts will load after a delayed amount of time.

		               // This is mainly for usability concerns. You can alter this as you see fit

		scroll  : true // The main bit, if set to false posts will not load as the user scrolls. 

		               // but will still load if the user clicks.		

	});	

});

</script>

<style>

.loading-bar {

	border: 1px solid #DDDDDD;

    border-radius: 5px;

    box-shadow: 0 -45px 30px -40px rgba(0, 0, 0, 0.05) inset;

    clear: both;

    cursor: pointer;

    display: block;

    float: none;

    font-family: "museo-sans",sans-serif;

    font-size: 2em;

    font-weight: bold;

    margin: 20px 0px 20px 0;

    padding: 10px 0px;

    position: relative;

    text-align: center;

    width: 100%;

}

.loading-bar:hover {

	box-shadow: inset 0px 45px 30px -40px rgba(0, 0, 0, 0.05);

}
.main {
    padding: 0px;
}

</style>

<?php if($userProfileDetails[0]['thumbnail']!=''){ $profile_pic='users/thumb/'.$userProfileDetails[0]['thumbnail']; } else { $profile_pic='default_avat.png';}?>

<section class="container">

<div class="main">     

	<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="view-profile/<?php echo $userProfileDetails[0]['user_name'];?>" class="a_links"><?php echo $userProfileDetails[0]['user_name'];?></a></li>
		    <span>&rsaquo;</span>
           <li><?php echo artfill_lg('user_itmes_i_love','Items i love');?></li>
        </ul>

        <div class="favorite-mem">

            <a class="people" href="#">

                <img class="member" width="75" height="75" alt="<?php echo $userProfileDetails[0]['user_name'];?>" src="images/<?php echo $profile_pic; ?>">

            </a>

            <p>

            	<?php if($this->lang->line('curated-by') != '') { echo stripslashes($this->lang->line('curated-by')); } else echo 'Curated by'; ?>

            <a href="people/<?php echo $userProfileDetails[0]['user_name'];?>/favorites"> <?php if($loggeduserID==$userProfileDetails[0]['id']) {echo 'You';}else{echo $userProfileDetails[0]['full_name']; }?></a>.</p>

        </div>   

        <?php if($loggeduserID==$userProfileDetails[0]['id']) {?>   

        <div class="favo_image1">

            <a class="edit_trigger edit" href="javascript: void(0);" id="openitem"  onclick="return openItem();">

            	<span class="edit-icon">?</span><?php if($this->lang->line('user_edit') != '') { echo stripslashes($this->lang->line('user_edit')); } else echo 'Edit'; ?>

            </a>

        </div>

        <?php } ?>


</div>  



<div class="favorite bg-body">

     <div class="main">    

      <div class="top_list">

        <h1 class="fav-header">

        <a href="#"><?php if($this->lang->line('user_itmes_i_love') != '') { echo stripslashes($this->lang->line('user_itmes_i_love')); } else echo "Items I Love"; ?></a>

        </h1>

       	<form method="get">

            <input name="a" id="a" class="input-forms" type="text" value="<?php if(isset($_GET['a'])){ echo $_GET['a']; } ?>" placeholder="<?php if($this->lang->line('user_search_avail') != '') { echo stripslashes($this->lang->line('user_search_avail')); } else echo 'Search available items'; ?>">

            <span class="search-icon">??</span>

        </form>

        <form method="get" id="frm">

        <div>

        <input type="checkbox" class="checkbox" name="filter"  id="filter" onchange="javascript:$('#frm').submit();" <?php if(isset($_GET['filter'])){ if($_GET['filter']=='on'){ echo 'checked="checked"'; }} ?>  />

        <label>

        	<?php if($this->lang->line('avail-item') != '') { echo stripslashes($this->lang->line('avail-item')); } else echo 'Show only available items'; ?>

        </label>

        </div>

        </form>

      </div> 

       <div class="favorite_list">

       				<div class="product_box">

                     <?php if($loggeduserID!=$userProfileDetails[0]['id']){ ?>

                    <?php if($userProfileDetails[0]['favorites_visibility']=='Public'){ ?>

                    <?php if(!empty($userFavoriteItems)){ ?>

                        <ul class="product_listing" id="product_listing">

                        	<?php $i=1;  foreach($userFavoriteItems as $products){ $img=explode(',',$products['image']);?>

                        	<li>

                            	<div class="product_img">

                                	<div class="product_hide">

                                    	<div class="product_fav">

                                            <?php if($loginCheck !=''){?>											
											<?php if($products['user_id']==$loginCheck){ ?>
											<a href="javascript:void(0);" onclick="return ownProductFav();">
												<input type="submit" value="" class="hoverfav_icon" />
											</a>
											<?php
											}else{

											$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($products['id']));

											#print_r($favArr); die;

											if(empty($favArr)){ ?>

											<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($products['id']); ?>','Fresh',this);">

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											<?php  } else { ?>                        

											<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($products['id']); ?>','Old',this);">

												<input type="submit" value="" class="hoverfav_icon1" />

											</a>

											<?php }}} else { ?>

											<a href="login"  >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											<?php  } ?> 

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('<?php echo $i; ?>');">  </a>

                                        	<div class="hover_lists" id="hoverlist<?php echo $i; ?>">

                                               	<h2><?php if($this->lang->line('user_your_lists') != '') { echo stripslashes($this->lang->line('user_your_lists')); } else echo 'Your Lists'; ?></h2>

                                                <div class="lists_check">

                                                	<?php foreach($userLists as $Lists){ 

													$haveListIn = $this->user_model->check_list_products(stripslashes($products['id']),$Lists['id'])->num_rows();

													#echo $haveListIn;

													if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}

													?>

                                                    <input type="checkbox" class="check_box" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo stripslashes($products['id']); ?>');" <?php echo $chk; ?> />

                                                    <label><?php echo $Lists['name']; ?></label>

                                                    <?php } ?>

                                                    <?php if(!empty($userRegistry)){ 

														$haveRegisryIn = $this->user_model->check_registry_products($products['id'],$userRegistry->user_id)->num_rows();

														if($haveRegisryIn>0){$chk='checked="checked"';}else{ $chk='';}

													?>

													<input type="checkbox" class="check_box" onclick="return manageRegisrtyProduct('<?php echo $userRegistry->user_id; ?>','<?php echo $products['id']; ?>');" <?php echo $chk; ?> />

													<label><span class="registry_icon"></span><?php if($this->lang->line('prod_wedding') != '') { echo stripslashes($this->lang->line('prod_wedding')); } else echo 'Wedding Registry'; ?></label>

													<?php }  ?>

                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

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

                                    <a href="products/<?php echo $products['seourl']?>">

                                    <img src="images/product/<?php echo $img[0]; ?>" alt="Product-1" title="Product-1" />

                                    </a>

                                </div>

                                <div class="product_title"><a href="products/<?php echo $products['seourl']?>"><?php echo $products['product_name']?></a></div>

                                <div class="product_maker"><a href="shop-section/<?php echo $products['seller_seourl']?>"><?php echo $products['seller_businessname']?></a></div>

                                <div class="product_price">

                                <?php if($products['price'] != 0.00) {?>

                                <span class="currency_value"><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$products['price'],2)?></span>

                                <span class="currency_code">

                                <?php echo $currencyType;?>

                                	<?php #if($this->lang->line('user_usd') != '') { echo stripslashes($this->lang->line('user_usd')); } else echo "USD"; ?>

                                </span>

                                <?php } else { ?> 

                                <span class="currency_value"><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$products['pricing'],2).'+';?></span>

                                <span class="currency_code"><?php echo $currencyType;?>

                                	<?php #if($this->lang->line('user_usd') != '') { echo stripslashes($this->lang->line('user_usd')); } else echo "USD"; ?>

                                </span>

                                <?php }?>

                                </div>

                            </li>

                            <?php $i++;  } ?>                            

                        </ul>

                    <?php }else{ 

                    if(isset($_GET['a'])){

					?>

                    <div class=" warning-error">

                  <h3> <?php if($this->lang->line('not-avail') != '') { echo stripslashes($this->lang->line('not-avail')); } else echo "We didn't find any available items for"; ?><span style="margin:0 0 0 3px; color:#000; font-weight:bold"><?php echo $_GET['a']; ?></span>

                    <a href="people/<?php echo $this->session->userdata('shopsy_session_user_name'); ?>/favorites/items-i-love"><span>X</span>

                    	<?php if($this->lang->line('clear_search') != '') { echo stripslashes($this->lang->line('clear_search')); } else echo "Clear this search"; ?>

                    </a>

                    <?php }else{ ?>

						<?php if($this->lang->line('fav_item') != '') { echo stripslashes($this->lang->line('fav_item')); } else echo "No items in this favoites list yet."; ?>

					<?php } ?> </h3></div>

					<?php } ?>

                    <?php }else{ ?>

                    <div class="warning-error">

                        <h3>

                        	<span style="margin:0 0 0 3px; color:#000">This member has no public favorites</span>

                        </h3>

                    </div>

                    <?php } }else{?>

                    <?php if(!empty($userFavoriteItems)){ ?>

                        <ul class="product_listing" id="product_listing">

                        	<?php $i=1;  foreach($userFavoriteItems as $products){ $img=explode(',',$products['image']);?>

                        	<li>

                            	<div class="product_img">

                                	<div class="product_hide">

                                    	<div class="product_fav">

                                            <?php if($loginCheck !=''){?>											
											<?php if($products['user_id']==$loginCheck){ ?>
											<a href="javascript:void(0);" onclick="return ownProductFav();">
												<input type="submit" value="" class="hoverfav_icon" />
											</a>
											<?php
											}else{

											$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($products['id']));

											#print_r($favArr); die;

											if(empty($favArr)){ ?>

											<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($products['id']); ?>','Fresh',this);">

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											<?php  } else { ?>                        

											<a href="javascript:void(0);" onclick="return changeProductToFavourite('<?php echo stripslashes($products['id']); ?>','Old',this);">

												<input type="submit" value="" class="hoverfav_icon1" />

											</a>

											<?php }}} else { ?>

											<a href="login"  >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											<?php  } ?> 

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('<?php echo $i; ?>');">  </a>

                                        	<div class="hover_lists" id="hoverlist<?php echo $i; ?>">

                                               	<h2><?php if($this->lang->line('user_your_lists') != '') { echo stripslashes($this->lang->line('user_your_lists')); } else echo 'Your Lists'; ?></h2>

                                                <div class="lists_check">

                                                	<?php foreach($userLists as $Lists){ 

													$haveListIn = $this->user_model->check_list_products(stripslashes($products['id']),$Lists['id'])->num_rows();

													#echo $haveListIn;

													if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}

													?>

                                                    <input type="checkbox" class="check_box" onclick="return addproducttoList('<?php echo $Lists['id']; ?>','<?php echo stripslashes($products['id']); ?>');" <?php echo $chk; ?> />

                                                    <label><?php echo $Lists['name']; ?></label>

                                                    <?php } ?>

                                                    <?php if(!empty($userRegistry)){ 

														$haveRegisryIn = $this->user_model->check_registry_products($products['id'],$userRegistry->user_id)->num_rows();

														if($haveRegisryIn>0){$chk='checked="checked"';}else{ $chk='';}

													?>

													<input type="checkbox" class="check_box" onclick="return manageRegisrtyProduct('<?php echo $userRegistry->user_id; ?>','<?php echo $products['id']; ?>');" <?php echo $chk; ?> />

													<label><span class="registry_icon"></span><?php if($this->lang->line('prod_wedding') != '') { echo stripslashes($this->lang->line('prod_wedding')); } else echo 'Wedding Registry'; ?></label>

													<?php }  ?>

                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

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

                                    <a href="products/<?php echo $products['seourl']?>">

                                    <img src="images/product/<?php echo $img[0]; ?>" alt="Product-1" title="Product-1" />

                                    </a>

                                </div>

                                <div class="product_title"><a href="products/<?php echo $products['seourl']?>"><?php echo $products['product_name']?></a></div>

                                <div class="product_maker"><a href="shop-section/<?php echo $products['seller_seourl']?>"><?php echo $products['seller_businessname']?></a></div>

                                <div class="product_price">

                                <?php if($products['price'] != 0.00) {?>

                                <span class="currency_value"><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$products['price'],2)?></span>

                                <span class="currency_code">

                                <?php echo $currencyType;?>

                                	<?php #if($this->lang->line('user_usd') != '') { echo stripslashes($this->lang->line('user_usd')); } else echo "USD"; ?>

                                </span>

                                <?php } else { ?> 

                                <span class="currency_value"><?php echo $currencySymbol;?> <?php echo number_format($currencyValue*$products['pricing'],2).'+';?></span>

                                <span class="currency_code">

                                <?php echo $currencyType;?>

                                	<?php #if($this->lang->line('user_usd') != '') { echo stripslashes($this->lang->line('user_usd')); } else echo "USD"; ?>

                                </span>

                                <?php }?>

                                </div>

                            </li>

                            <?php $i++;  } ?>                            

                        </ul>

                    <?php }else{ 

                    if(isset($_GET['a'])){

					?>

                    <div class=" warning-error">

                  <h3> <?php if($this->lang->line('not-avail') != '') { echo stripslashes($this->lang->line('not-avail')); } else echo "We didn't find any available items for"; ?><span style="margin:0 0 0 3px; color:#000; font-weight:bold"><?php echo $_GET['a']; ?></span>

                    <a href="people/<?php echo $this->session->userdata('shopsy_session_user_name'); ?>/favorites/items-i-love"><span>X</span>

                    	<?php if($this->lang->line('clear_search') != '') { echo stripslashes($this->lang->line('clear_search')); } else echo "Clear this search"; ?>

                    </a>

                    <?php }else{ ?>

						<?php if($this->lang->line('fav_item') != '') { echo stripslashes($this->lang->line('fav_item')); } else echo "No items in this favoites list yet."; ?>

					<?php } ?> </h3></div>

					<?php } ?>

                    <?php } ?>

                    </div>

       </div> 

    </div>



</div>

<script src="js/jquery.colorbox.js"></script>

<script>

$(document).ready(function(){



		$(".cboxClose1").click(function(){

			$("#cboxOverlay,#colorbox").hide();

			});

		

			//alert("sfdsfdsa");

			$(".edit").colorbox({width:"470px", height:"auto", inline:true, href:"#inline_reg11"});

						

		

		//Example of preserving a JavaScript event for inline calls.

			$("#onLoad").click(function(){ 

				$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");

				return false;

			});



});



function openItem(){

			$("#openitem").colorbox({width:"470px", height:"auto", inline:true, href:"#inline_reg11"});

}



</script>

<div style='display:none'>

<input type="hidden" name="uid" id="uid" value="<?php echo $this->session->userdata('shopsy_session_user_id'); ?>"  />

  <div id='inline_reg11'  style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0.4); padding:10px ;float:left; width:95%"> 

  <div style="background:#fff ; border-radius:5px 5px 0 0">

	<h2 class="edit_popup_header"><?php if($this->lang->line('user_edit_list') != '') { echo stripslashes($this->lang->line('user_edit_list')); } else echo 'Edit List'; ?></h2> 

    <form action="site/user/update_user_favorite_status"  method="post">

        <div class="edit_popup_section">

            <span>

            	<?php if($this->lang->line('user_who_can_list') != '') { echo stripslashes($this->lang->line('user_who_can_list')); } else echo 'Who can see this list?'; ?>

            </span>

            <div class="radio-popup">

                <input  class="radio" type="radio" value="public" name="privacy_level" <?php if($userProfileDetails[0]['favorites_visibility']=="Public"){ echo 'checked="checked"';} ?>></input>

                <label class="editpop-label">

                	<?php if($this->lang->line('user_anyone_see_list') != '') { echo stripslashes($this->lang->line('user_anyone_see_list')); } else echo 'Anyone can see this list'; ?>

                </label>

            </div>

            <div class="radio-popup">

                <input  class="radio" type="radio" value="private" name="privacy_level" <?php if($userProfileDetails[0]['favorites_visibility']=="Private"){ echo 'checked="checked"';} ?>></input>

                <label class="editpop-label">

                	<?php if($this->lang->line('user_only_i_can') != '') { echo stripslashes($this->lang->line('user_only_i_can')); } else echo 'Only I can see this list'; ?>

                </label>

            </div>

        </div>  

        <div class="edit_popup_footer">

            <div class="popup_login" style="margin-bottom:15px">

                <input class="submit_btn" type="submit" value="<?php if($this->lang->line('user_save') != '') { echo stripslashes($this->lang->line('user_save')); } else echo 'Save'; ?>" ></input>

            </div>

        </div>  

    </form>    

  </div>

  </div>

  

</div>

</section>

<?php 

$this->load->view('site/templates/footer');

?>





<style>

#cboxLoadedContent{background:none;}



.edit_popup_footer{ width: 90.6%;

}





/*#cboxClose {    right: 12px;  top: 10px;}*/

#cboxClose
{
	right: auto;
	top: auto;
	bottom: 37px;
	position: absolute;
	height: 37px;
	float: left;
	width: 50px;
	background: #B8B8B8 none repeat scroll 0% 0%;
	left: 130px;
	border:0;
	color:#FFF !important;
	background: #b8b8b8 none repeat scroll 0 0;
    border: medium none;
    border-radius: 3px;
    font-size: 15px;
    font-weight: bold;
    line-height: 17px;
}

#cboxClose:hover {
    background: #a8a8a8 none repeat scroll 0 0 !important;
}


</style>