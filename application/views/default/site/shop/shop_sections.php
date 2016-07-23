<?php  

$this->load->view('site/templates/shop_header');

#echo "<pre>"; print_r($shop_section_details); die;

?>


<script type="text/javascript" src="js/site/jquery-1.7.1.min.js"></script> 
<script type="text/javascript" src="js/site/SpryTabbedPanels.js"></script>
<script type="text/javascript" src="js/site/verticaltabs.pack.js"></script>		

<script type="text/ecmascript" src="js/site/custom_validation.js" ></script>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<?php } ?>
<div class="clear"></div>
<div id="shop_page_seller">
 	<section class="container">

    	<div class="main">
		
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
		   <span>&rsaquo;</span>
		   <li>Shop sections</li>
        </ul>

        	

            <div style="margin: 20px 0;" class="manage-listing-heading">

                <h1><?php if($this->lang->line('shopsec_shop') != '') { echo "商店部份"; } else echo 'Shop Sections'; ?></h1>

                <p>

                <?php if($this->lang->line('shop_createsections') != '') { echo stripslashes($this->lang->line('shop_createsections')); } else echo 'Create sections to help shoppers browse your shop'; ?><?php if($footstop = $this->_ci_cached_vars["languageCode"] == "zh_HK") echo "。"; else echo "." ?>

                <br>

                <?php if($this->lang->line('shop_sectionsappear') != '') { echo stripslashes($this->lang->line('shop_sectionsappear')); } else echo "Sections appear in your shop's left navigation"; ?><?php if($footstop = $this->_ci_cached_vars["languageCode"] == "zh_HK") echo "。"; else echo "." ?>

                </p>

            </div>

            <?php $seourl=$selectSeller_details[0]['seourl'] ?>

            <?php if($shop_section_count==0){ ?>

            <div class="middle-section">

            	<form action="site/shop/add_shop_section_list" method="post">

                <label> <?php if($this->lang->line('shop_createsection') != '') { echo stripslashes($this->lang->line('shop_createsection')); } else echo 'Create a Section'; ?> </label>

                <input class="head-text" type="text" id="name" maxlength="24" name="name" />

                <input class="primary-button" type="submit" value="<?php if($this->lang->line('user_save') != '') { echo stripslashes($this->lang->line('user_save')); } else echo 'Save'; ?>" onclick="return validate_shop_section();" />

                </form>

            </div>

            <p class="details"><?php if($this->lang->line('shop_organizeitems') != '') { echo stripslashes($this->lang->line('shop_organizeitems')); } else echo 'You can organize your items by product line, category, size, etc'; ?>.<a target="_blank" href="#"><?php if($this->lang->line('user_learn_more') != '') { echo stripslashes($this->lang->line('user_learn_more')); } else echo 'Learn more'; ?></a>.</p>

            <?php } else {  ?>

            	<div class="shop-sections-container " id="shop-info">

                <?php #echo "<pre>"; print_r($shop_section_details); ?>

                    <div class="shop-sections-container_left">

                    <h3><?php if($this->lang->line('shop_yoursections') != '') { echo stripslashes($this->lang->line('shop_yoursections')); } else echo 'Your Sections'; ?></h3>

                    <!--<p><h7>Click & drag</h7><span class="recorder"> </span><label>to reorder.</label></p>-->

                        <ul>

                            <li class="selection <?php if($section_id=='All'){ echo 'selected_selection'; }?>">

                            <?php if($section_id=='All'){  echo '<input type="hidden" name="old_sec_id" id="old_sec_id" value="All" />'; }?>

                            	<a href="shops/<?php echo $seourl; ?>/sections/All"><label> <?php if($this->lang->line('shop_allitems') != '') { echo stripslashes($this->lang->line('shop_allitems')); } else echo 'All Items'; ?></label><span class="nomber"><?php echo count($product); ?></span></a>

                            </li>

                            <?php foreach($shop_section_details as $section) { 

							if($section_id==$section['section_id']){ echo '<input type="hidden" name="old_sec_id" id="old_sec_id" value="'.$section['section_id'].'" />'; 

							}?> 

                            <li class="selection <?php if($section_id==$section['section_id']){ echo 'selected_selection'; }?>">

                            	<div id="<?php echo $section['section_id']; ?>">

                                    <div class="section-listing">

                                        <a href="shops/<?php echo $seourl; ?>/sections/<?php echo $section['section_id']; ?>">

                                            <span class="titlers" title="jp"><?php echo $section['section_name']; ?></span>

                                            <span class="nomber"><?php echo $section['shop_prod_count']; ?></span>

                                        </a>

                                    </div>

                                    <div class="action">

                                        <a class="editabe" onclick="return edit_section('<?php echo $section['section_id']; ?>','edit');"><?php if($this->lang->line('user_edit') != '') { echo stripslashes($this->lang->line('user_edit')); } else echo 'Edit'; ?></a>

                                        <form method="post" action="site/shop/delete_shop_sections" class="deletable">

                                            <input type="hidden" name="status" value="delete" />

                                            <input type="hidden" name="name" value="<?php echo $section['section_name']; ?>" />

                                            <input type="hidden" name="section" value="<?php echo $section['section_id']; ?>" />

                                            <button class="deletable" value="x" name="delete" type="submit" onclick="return validate_shop_section();" ></button>

                                        </form>

                                    </div>

                                </div>

                                <div class="selected_selection" style="display:none;" id="edit_<?php echo $section['section_id']; ?>">

                                    <form action="site/shop/edit_shop_section" method="post">

                                        <input class="head-text" type="text" id="name" maxlength="20" name="name" value="<?php echo $section['section_name']; ?>" />

                                        <input type="hidden" name="section" value="<?php echo $section['id']; ?>" />

                                        <input class="primary-button" type="submit" value="<?php if($this->lang->line('user_save') != '') { echo stripslashes($this->lang->line('user_save')); } else echo 'Save'; ?>" onclick="return validate_shop_section();"  />

                                        <a class="creating-button" onclick="return edit_section('<?php echo $section['section_id']; ?>','cancel');" ><?php if($this->lang->line('user_cancel') != '') { echo stripslashes($this->lang->line('user_cancel')); } else echo 'Cancel'; ?></a>

                                    </form>

                                </div>

                            </li>

                            <?php } ?>

                        </ul>

                        <div class="new-shoping" id="create_sec">

                        	<a class="creating-new create_shop_sec"><?php if($this->lang->line('shop_newsection') != '') { echo stripslashes($this->lang->line('shop_newsection')); } else echo 'Create new section'; ?></a>

                        </div>

                        <div style="clear:both;"></div>

                        <div class="selected_selection" style="display:none;" id="create_sec_div">

                        	<form action="site/shop/add_shop_section_list" method="post">

                                <input class="head-text" type="text" id="name" maxlength="20" name="name" />

                                <input class="primary-button" type="submit" value="<?php if($this->lang->line('user_save') != '') { echo stripslashes($this->lang->line('user_save')); } else echo 'Save'; ?>" onclick="return validate_shop_section();"  />

                                <a class="creating-new cancel_create_shop_sec"><?php if($this->lang->line('user_cancel') != '') { echo stripslashes($this->lang->line('user_cancel')); } else echo 'Cancel'; ?></a>

                            </form>

                        </div>

                    </div>

                    <div class="shop-sections-container_right">

                    	<?php if(count($productDetail)==0) { ?>

                        	<p><?php if($this->lang->line('shop_anylistings') != '') { echo stripslashes($this->lang->line('shop_anylistings')); } else echo "You haven't placed any listings in this section"; ?>.</p>

                         <?php } else { ?>

                        <table width="646" class="shop-section_table">

                            <thead>

                                <tr class="load">

                                    <td>

                                        <span>

                                        <input class="load-all" type="checkbox" name="check_all">

                                        </span>

                                    </td>

                                    <td colspan="2">

                                    	<select name="section_id" id="top_selection">

                                            <option value=""><?php if($this->lang->line('shop_changesection') != '') { echo stripslashes($this->lang->line('shop_changesection')); } else echo 'Change Section'; ?></option>

                                            <optgroup label="----------">

												<?php foreach($shop_section_details as $section) { ?>

                                                <option value="<?php echo $section['section_id']; ?>"><?php echo $section['section_name']; ?></option>

                                                <?php } ?>

                                            </optgroup>                                            

                                            <optgroup label="----------">

                                            <option value=""><?php if($this->lang->line('shop_nosection') != '') { echo stripslashes($this->lang->line('shop_nosection')); } else echo 'No section'; ?></option>

                                            </optgroup>

                                        </select>

                                        <button class="button_save" type="submit" onclick="return update_section_list('top_selection')"><?php if($this->lang->line('user_save') != '') { echo stripslashes($this->lang->line('user_save')); } else echo 'Save'; ?></button> 

                                    </td>

                                </tr>

                            </thead>

                            <tbody>

                                <?php 

									foreach($productDetail as $product) { 

									$imgArr=explode(',',$product['image']);

								?>

                                <?php if($product['price'] != 0.00) { $price=$currencyValue*$product['price'];  } else { $price=$currencyValue*$product['pricing'].'+';  }?>

                                <tr class="listed">

                                    <td class="list-select">

                                        <input type="checkbox" value="<?php echo $product['id']; ?>" name="listings[]" class="checkbox" />

                                    </td>

                                    <td class="list-title">

                                        <div class="contrl">

                                            <a class="image" href="products/<?php echo $product['seourl']; ?>"><img src="images/product/list-image/<?php echo $imgArr[0]; ?>"  /></a>

                                            <a class="title-info" title="headset" href="products/<?php echo $product['seourl']; ?>"><?php echo $product['product_name']; ?></a>

                                            <!--<p class="dat-section" data-section="15287114"><?php echo $product['id']; ?></p>-->

                                        </div>

                                    </td>

                                    <td class="dolar-price">

                                        <span class="dolar-symbol"><?php echo $currencySymbol;?></span>

                                        <span class="dolar-value"><?php echo number_format($price,2); ?></span>

                                        <span class="dolar-code currencyType"><?php echo $currencyType;?></span>

                                    </td>

                                </tr> 

                                <?php } ?>                               

                            </tbody>

                           

                        </table>

                        <?php } ?>

                    </div>

                </div>

            <?php } ?>

            

            <div style="min-height:40px" class="minhei">

            </div>

        </div>

    </section> 	
</div>
 
<script>

$(document).ready(function(e) {

    $(".load-all").click(function () {

        if ($(this).is(':checked')) {

			$('input:checkbox[name=check_all]').prop("checked", true);

            $(".checkbox").prop("checked", true);

        } else {

			$('input:checkbox[name=check_all]').prop("checked", false);

            $(".checkbox").prop("checked", false);

        }

    });

});

function update_section_list(val)

{

	old_sec_id=$('#old_sec_id').val();	

	new_sec_id=$('#'+val).val();

	

	/*if(old_sec_id=='All')

	{

		alert(old_sec_id);

		return false;

	}*/

	

	if(new_sec_id.trim()!="")

	{

		new_sec_prod='';

		old_sec_prod='';

		new_sec_count=0;

		old_sec_count=0;

		$('.checkbox').each(function(index, element) {

			if ($(this).is(':checked')) {

				new_sec_prod=new_sec_prod+$(this).val()+',';

				new_sec_count++;

			} else {

				old_sec_prod=old_sec_prod+$(this).val()+',';

				old_sec_count++;

			}

		});

		//alert(old_sec_id+'/'+new_sec_id+'/'+new_sec_prod+'/'+new_sec_count);

			$.ajax(

			{

				type: 'POST',

				url: baseURL+'site/shop/edit_shop_sections_list',

				data: {'old_sec_id': old_sec_id,'new_sec_id': new_sec_id,'new_sec_prod': new_sec_prod,'old_sec_prod':old_sec_prod,'new_sec_count':new_sec_count,'old_sec_count':old_sec_count},

				//dataType: 'json',

				success: function(data)

				{

					//alert(data);

					window.location.reload(true);

					

				}

			});

	}

	else

	{

		return false;

	}

}

</script>

<?php 

$this->load->view('site/templates/footer');

?>

