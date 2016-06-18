<?php 

$this->load->view('site/templates/header');

$this->load->model('user_model');

//echo "<pre>";print_r($viewprofile->row());

//echo $viewprofile->row()->full_name;die;

?>

<?php if($userProfileDetails[0]['thumbnail']!=''){ $profile_pic='users/thumb/'.$userProfileDetails[0]['thumbnail']; } else { $profile_pic='default_avat.png';}?>
<section class="container">
<div class="main">     

	<div class="container">

        <div class="favorite-mem">

            <a class="people" href="people/<?php echo $userProfileDetails[0]['user_name'];?>/favorites">

                <img class="member" width="75" height="75" alt="<?php echo $userProfileDetails[0]['user_name'];?>" src="images/<?php echo $profile_pic; ?>">

            </a>

            <p>

            	<?php if($this->lang->line('curated-by') != '') { echo stripslashes($this->lang->line('curated-by')); } else echo "Curated by"; ?>

            <a href="people/<?php echo $userProfileDetails[0]['user_name'];?>/favorites"> <?php if($loggeduserID==$userProfileDetails[0]['id']) {echo 'You';}else{echo $userProfileDetails[0]['full_name']; }?></a>.</p>

        </div>      

        <?php if($loggeduserID==$userProfileDetails[0]['id']) {?>   

        <div class="favo_image1">

            <a class="edit_trigger edit" href="#edit_list_popup" data-toggle="modal" >

            	<span class="edit-icon">?</span><?php if($this->lang->line('user_edit') != '') { echo stripslashes($this->lang->line('user_edit')); } else echo "Edit"; ?>

            </a>

        </div>

        <?php } ?>

    </div>

</div>  



<div style="background:#fff; float:left; width:100%; padding: 0 0 60px;" class="favorite">

     <div class="main">    

      <div class="top_list">

        <h1 class="fav-header edit">

        <a href="people/<?php echo $userProfileDetails[0]['user_name'];?>/favorites/list/<?php echo $listId.'-'.$listName; ?>"><?php echo $listName; ?></a>

        </h1>

       	<form method="get">

            <input name="a" id="a" class="input-forms" type="text" placeholder="<?php if($this->lang->line('user_search_avail') != '') { echo stripslashes($this->lang->line('user_search_avail')); } else echo 'Search available items'; ?>" value="<?php if(isset($_GET['a'])){ echo $_GET['a']; } ?>">

            <span class="search-icon">??</span>

        </form>

        <form method="get" id="frm">

        <div>

        <input type="checkbox" class="checkbox" name="filter"  id="filter" onchange="javascript:$('#frm').submit();" <?php if(isset($_GET['filter'])){ if($_GET['filter']=='on'){ echo 'checked="checked"'; }} ?>  />

        <label>

        	<?php if($this->lang->line('avail-item') != '') { echo stripslashes($this->lang->line('avail-item')); } else echo "Show only available items"; ?>

        </label>

        </div>

        </form>

        

        

        

      </div> 

       <div class="favorite_list">

       				<div class="product_box ">

                    <?php if($loggeduserID!=$userProfileDetails[0]['id']){ ?>

                    <?php if($listProductVal[0]['privacy']=='Public'){ ?>

                    <?php if(!empty($listProduct)){ ?>

                        <ul class="product_listing">

                        	<?php $i=1;  foreach($listProduct as $products){ $img=explode(',',$products['image']);?>

                        	<li>

                            	<div class="product_img">

                                	<div class="product_hide">

                                    	<div class="product_fav">

                                            <?php if($loginCheck !=''){ ?>
											
											
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

											<a href="#" class="reg-popup" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											<?php  } ?>                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('<?php echo $i; ?>');">  </a>

                                        	<div class="hover_lists" id="hoverlist<?php echo $i; ?>">

                                               	<h2><?php if($this->lang->line('user_your_lists') != '') { echo stripslashes($this->lang->line('user_your_lists')); } else echo "Your Lists"; ?></h2>

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

                                <div class="product_maker"><a href="shop-section/<?php echo $products['shop_seourl']?>"><?php echo $products['shop_name']?></a></div>

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

                    <div class="warning-error"><h3>

                    <?php if($this->lang->line('not-avail') != '') { echo stripslashes($this->lang->line('not-avail')); } else echo "We didn't find any available items for"; ?><span style="margin:0 0 0 3px; color:#000"><?php echo $_GET['a']; ?></span>

                    <a href="<?php echo current_url(); ?>"><span>X</span>

                    	<?php if($this->lang->line('clear_search') != '') { echo stripslashes($this->lang->line('clear_search')); } else echo "Clear this search"; ?>

                    </a>

                    <?php }else{ ?>

						<?php if($this->lang->line('no_items') != '') { echo stripslashes($this->lang->line('no_items')); } else echo "No items in this list yet."; ?>

					<?php } ?></h3>

                    </div>

                    <?php } ?>

                    <?php }else{ ?>

                    <div class="warning-error">

                        <h3>

                        	<span style="margin:0 0 0 3px; color:#000">This member has no public favorites</span>

                        </h3>

                    </div>

                    <?php } }else{?>

                    <?php if(!empty($listProduct)){ ?>

                        <ul class="product_listing">

                        	<?php $i=1;  foreach($listProduct as $products){ $img=explode(',',$products['image']);?>

                        	<li>

                            	<div class="product_img">

                                	<div class="product_hide">

                                    	<div class="product_fav">

                                            <?php if($loginCheck !=''){ ?>										
											
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

											<a href="#" class="reg-popup" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											<?php  } ?>                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('<?php echo $i; ?>');">  </a>

                                        	<div class="hover_lists" id="hoverlist<?php echo $i; ?>">

                                               	<h2><?php if($this->lang->line('user_your_lists') != '') { echo stripslashes($this->lang->line('user_your_lists')); } else echo "Your Lists"; ?></h2>

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

                                <div class="product_maker"><a href="shop-section/<?php echo $products['shop_seourl']?>"><?php echo $products['shop_name']?></a></div>

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

                    <div class="warning-error"><h3>

                    <?php if($this->lang->line('not-avail') != '') { echo stripslashes($this->lang->line('not-avail')); } else echo "We didn't find any available items for"; ?><span style="margin:0 0 0 3px; color:#000"><?php echo $_GET['a']; ?></span>

                    <a href="<?php echo current_url(); ?>"><span>X</span>

                    	<?php if($this->lang->line('clear_search') != '') { echo stripslashes($this->lang->line('clear_search')); } else echo "Clear this search"; ?>

                    </a>

                    <?php }else{ ?>

						<?php if($this->lang->line('no_items') != '') { echo stripslashes($this->lang->line('no_items')); } else echo "No items in this list yet."; ?>

					<?php } ?></h3>

                    </div>

                    <?php } ?>

                    <?php } ?>

                    </div>

       </div> 

    </div>



</div>

<?php 

#$this->load->view('site/templates/footer');

?>



<script src="js/jquery.colorbox.js"></script>

<script>

$(document).ready(function(){



		$(".cboxClose1").click(function(){

			$("#cboxOverlay,#colorbox").hide();

			});

		

			

		//	$(".edit").colorbox({width:"470px", height:"auto", inline:true, href:"#inline_reg11"});

						

		

		//Example of preserving a JavaScript event for inline calls.

			$("#onLoad").click(function(){ 

				$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");

				return false;

			});



});



function openItem(){

		//	$("#openitem").colorbox({width:"470px", height:"auto", inline:true, href:"#inline_reg11"});

}

</script>

<div id="edit_list_popup" class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
			
			<input type="hidden" name="uid" id="uid" value="<?php echo $this->session->userdata('shopsy_session_user_id'); ?>"  />
				<div>  

				  <div style="background:#fff">

					<h2 class="edit_popup_header"><?php if($this->lang->line('user_edit_list') != '') { echo stripslashes($this->lang->line('user_edit_list')); } else echo 'Edit List'; ?></h2> 

					<form action="site/user/update_list"  method="post">

						<div class="edit_popup_section">

							<span><?php if($this->lang->line('user_title') != '') { echo stripslashes($this->lang->line('user_title')); } else echo "Title"; ?></span>

							<div class="radio-popup">

								<input type="text" name="list_name" id="list_name" autocomplete="off" value="<?php echo $listName; ?>" />

								<input type="hidden" name="list_Id" id="list_Id" value="<?php echo $listId; ?>"  />

							</div>

							<span><?php if($this->lang->line('user_who_can_list') != '') { echo stripslashes($this->lang->line('user_who_can_list')); } else echo "Who can see this list?"; ?></span>

							<div class="radio-popup">

								<input  class="radio" type="radio" value="public" name="privacy_level" <?php if($listProductVal[0]['privacy']=="Public"){ echo 'checked="checked"';} ?>></input>

								<label class="editpop-label"><?php if($this->lang->line('user_anyone_see_list') != '') { echo stripslashes($this->lang->line('user_anyone_see_list')); } else echo "Anyone can see this list"; ?></label>

							</div>

							<div class="radio-popup">

								<input  class="radio" type="radio" value="private" name="privacy_level" <?php if($listProductVal[0]['privacy']=="Private"){ echo 'checked="checked"';} ?>></input>

								<label class="editpop-label"><?php if($this->lang->line('user_only_i_can') != '') { echo stripslashes($this->lang->line('user_only_i_can')); } else echo "Only I can see this list"; ?></label>

							</div>

						</div>  


							<div class="modal-footer footer_tab_footer">
								<input class="submit_btn" type="button" onclick="delete_user_list();" value="<?php if($this->lang->line('user_delete_list') != '') { echo stripslashes($this->lang->line('user_delete_list')); } else echo 'Delete this list'; ?>" style="background: none repeat scroll 0 0 #f85d2c; float:left;"></input>
								<div class="btn-group">								
										<input class="submit_btn" type="submit" value="<?php if($this->lang->line('user_save') != '') { echo stripslashes($this->lang->line('user_save')); } else echo 'Save'; ?>" onclick="return validate_list_edit();"></input>
											
										<a class="btn btn-default submit_btn" data-dismiss="modal" id="ask-cancel"><?php echo shopsy_lg('lg_cancel','Cancel');?></a>
								</div>
							</div>		


					</form>    

				  </div>
				 </div>
			
			
				
			</div>
		</div>
	</div>



</section>
<script>

function validate_list_edit(){

	if($('#list_name').val().trim()=='' || $('#list_name').val().trim()==NULL){

		alert('You Must Enter List Name!');

		return false;

	}

}

</script>





<style>

#cboxLoadedContent{background:none;}



.edit_popup_footer{ width: 90.6%;

}





#cboxClose {    right: 12px;  top: 10px;}





</style>



<?php 

$this->load->view('site/templates/footer');

?>

