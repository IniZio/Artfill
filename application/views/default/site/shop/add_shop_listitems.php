<?php 
$this->load->view('site/templates/shop_header'); 
$shopEditArr = array('admin-edit-product','admin-preview'); $shopAddArr = array('admin-listitem','admin-preview');
$showShopHeadList = 0;
if(in_array($this->uri->segment(1),$shopEditArr)){
	$showShopHeadList = 1;
}elseif(in_array($this->uri->segment(2),$shopAddArr)){ 
   $showShopHeadList = 1;
} 
?>
<script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script>
	function syncDescription(inst) {
        // alert("Some one modified something");
        $('#goo_item_desc').html(inst.getBody().innerHTML);
        // console.log(inst.getBody().innerHTML);
        // change(inst.getBody().innerHTML, "goo_item_desc");
}

</script>
<script type="text/javascript">
tinyMCE.init({
		// General options
		mode : "specific_textareas",
		editor_selector : "mceEditor",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
		width: "715",
        height: "275",
		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
   		theme_advanced_toolbar_location : "top",
 		theme_advanced_toolbar_align : "left",
 		theme_advanced_statusbar_location : "bottom",
 		theme_advanced_resizing : true,
		file_browser_callback : "ajaxfilemanager",
		relative_urls : false,
		convert_urls: false,
		// Example content CSS (should be your site CSS)
		content_css : "css/default/example.css",
		 
		// Drop lists for link/image/media/template dialogs
		//template_external_list_url : "js/template_list.js",
		external_link_list_url : "js/link_list.js",
		external_image_list_url : "js/image_list.js",
		media_external_list_url : "js/media_list.js",
		onchange_callback : "syncDescription",
		 
		// Replace values for the template plugin
		template_replace_values : {
		username : "Some User",
		staffid : "991234"
		}
		});
		
		function ajaxfilemanager(field_name, url, type, win) {
			var ajaxfilemanagerurl = '<?php echo base_url();?>js/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php';
			switch (type) {
				case "image":
					break;
				case "media":
					break;
				case "flash": 
					break;
				case "file":
					break;
				default:
					return false;
			}
            tinyMCE.activeEditor.windowManager.open({
                url: '<?php echo base_url();?>js/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php',
                width: 782,
                height: 440,
                inline : "yes",
                close_previous : "no"
            },{
                window : win,
                input : field_name
            });
            
            return false;			
			var fileBrowserWindow = new Array();
			fileBrowserWindow["file"] = ajaxfilemanagerurl;
			fileBrowserWindow["title"] = "Ajax File Manager";
			fileBrowserWindow["width"] = "782";
			fileBrowserWindow["height"] = "440";
			fileBrowserWindow["close_previous"] = "no";
			tinyMCE.openWindow(fileBrowserWindow, {
			  window : win,
			  input : field_name,
			  resizable : "yes",
			  inline : "yes",
			  editor_id : tinyMCE.getWindowArg("editor_id")
			});
			
			return false;
		}
</script>

<style>
#When_is{margin:0px !important;}
</style>
<link rel="stylesheet" href="css/default/jquery.tagbox.css" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/default/font-awesome.min.css">
<script type="text/javascript" src="js/site/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
	var DealOfDay = '<?php echo $this->config->item('deal_of_day')?>';
</script>
<script type="text/javascript" src="js/jquery.tagbox.js"></script>
<script type="text/javascript" src="js/site/add_shop_listitems.js"></script>
<script type="text/javascript" src="js/site/timepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/site/timepicker/jquery.timepicker.js"></script>
<link rel="stylesheet" media="screen" type="text/css" href="css/default/site/timepicker/bootstrap-datepicker.css" />
<link rel="stylesheet" media="screen" type="text/css" href="css/default/site/timepicker/jquery.timepicker.css"/>
<script src="js/accordion.jquery.js"></script>
<script src="js/ui-accordion.jquery.js"></script>
<script type="text/javascript">
jQuery(function(){
	jQuery("#jquery-tagbox-tags").tagBox();
	jQuery("#jquery-tagbox-materials").tagBox();
});
jQuery(function() {
	  jQuery('.accordion_mnu').initMenu();
});
</script>
<!-- 
<form method="post" action="site/product/add_shop_product">
<input type="file" class="image-upload" id="image_upload" name="image_upload">
<input type="submit" value="submit"/>
<form>
 -->
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<?php } ?>
<div class="list_inner_fields" id="shop_page_seller">   
	<div class="sh_content">
		<div class="col-lg-12" >
			<p><a href="#"><i class="fa fa-right-arrow"></i><?php if($this->lang->line('prod_back_to_listing') != '') { echo stripslashes($this->lang->line('prod_back_to_listing')); } else echo 'Back to listing'; ?></a></p>
			<h3><?php if($this->lang->line('prod_add_new_listing') != '') { echo stripslashes($this->lang->line('prod_add_new_listing')); } else echo 'Add a new listing'; ?>
			
			
<?php if($languagesList->num_rows() > 0 ) {?>
<span style="float: right;margin: 0px 20px 0px 0px;">
<input type="button" onclick="
if($('#sidenav').css('display') == 'none')
{
$('#sidenav').show();
}else{
$('#sidenav').hide();
}
" value="<?php echo af_lg('lg_add-lang',' Add Language');?>" class="save_btn"/>
</span>
<?php }?>
</h3>	

<form class="form-horizontal" method="post" action="add-product" name="common_list" e>
<?php // multiple language update?>
<?php if($languagesList->num_rows() > 0 ) {?>
<ul id="sidenav" class="accordion_mnu collapsible" style="display:none;">
<?php foreach($languagesList->result() as $lang){ if($lang->name != 'English'){?>
<li>
		<a style="margin: 0px 0px 0 0px; href="#">
				<div class="panel-heading"><h4><?php echo $lang->name;?><span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span></h4></div>
		</a>
			
			<ul id="acitem<?php echo $lang->lang_code;?>" class="acitem" style="display: none; padding: 0px;">
			<div class="sh_content">
			<div class="col-lg-12">
	 			<div class="col-lg-12 sh_border" >
<!-- 	 			<form class="form-horizontal" method="post" action="site/product/add_shop_product" name="common_list_ln" enctype="multi-part/data" onsubmit="return language_edit('<?php echo $lang->lang_code;?>')">  -->
					<h4><?php if($this->lang->line('prod_listing_details') != '') { echo stripslashes($this->lang->line('prod_listing_details')); } else echo 'Listing Details'; ?> : <?php echo $lang->name;?></h4>
					<p class="sub-title"><?php if($this->lang->line('prod_listing_details_text') != '') { echo stripslashes($this->lang->line('prod_listing_details_text')); } else echo "Tell the world about Your item and why they'll love it"; ?></p>
						<div class="form-group">
						<label for="product_name" class="col-xs-12 col-sm-2 control-label"><?php if($this->lang->line('prod_title') != '') { echo stripslashes($this->lang->line('prod_title')); } else echo 'Title'; ?></label>
						<div class="col-sm-7 col-xs-12">
							<input type="text" id="product_name_<?php echo $lang->lang_code;?>" name="product_name_<?php echo $lang->lang_code;?>" class="form-control" id="maxtextval" maxlength="140" value=""> 
						</div>
						<div class="col-md-3 col-sm-12 col-xs-12">
							<span class="list_div_note" ><?php if($this->lang->line('shop_maximum') != '') { echo stripslashes($this->lang->line('shop_maximum')); } else echo 'Maximum 140 characters'; ?>:</span>
							<span class="list_div_note" id="maxtext_notify">140</span>
							<span class="list_div_note" > &nbsp; <?php if($this->lang->line('shop_remaining') != '') { echo stripslashes($this->lang->line('shop_remaining')); } else echo 'remaining'; ?> </span>
						</div>
					</div>

					<div class="form-group">
						<label id="Description" for="inputEmail3" class="col-sm-2 col-xs-12 control-label"><?php if($this->lang->line('shop_description') != '') { echo stripslashes($this->lang->line('shop_description')); } else echo 'Description'; ?></label>
						<div class="col-md-7 col-sm-12">
						<!-- <div id="<?php echo $lang->lang_code;?>_loading">
								<div id="loader1"><img src="images/ajax-loader/ajax-loader-pop.gif" alt="loading subcategory" /></div>
							</div> -->
							<textarea class="form-control" name="description_<?php echo $lang->lang_code;?>"  id="desc_<?php echo $lang->lang_code;?>" rows="13"></textarea>
						</div>
						<!-- <div class="col-md-3 col-sm-12">
							<p><?php if($this->lang->line('shop_quantity_text2') != '') { echo stripslashes($this->lang->line('shop_quantity_text2')); } else echo ''; ?></p>
						</div> -->
					</div>
	                
	               <!-- </form>  --> 
					</div>
				</div>
				</div>
			</ul>
			
</li>
<?php }}?>
</ul>
<?php }?>
									
			
			<div class="col-lg-12 sh_border" >
				<h4><?php if($this->lang->line('prod_listing_details') != '') { echo stripslashes($this->lang->line('prod_listing_details')); } else echo 'Listing Details'; ?></h4>
				<p class="sub-title"><?php if($this->lang->line('prod_listing_details_text') != '') { echo stripslashes($this->lang->line('prod_listing_details_text')); } else echo "Tell the world about Your item and why they'll love it"; ?></p>
				<div class="form-group">
					<label id="title" for="product_name" class="col-xs-12 col-sm-2 control-label"><?php if($this->lang->line('prod_title') != '') { echo stripslashes($this->lang->line('prod_title')); } else echo 'Title'; ?></label>
					<div class="col-sm-7 col-xs-12">
						<input type="text" name="product_name" class="form-control" id="maxtextval" maxlength="140" style="width: 50%;" onKeyUp="change('maxtextval','goo_item_title')">
						 
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12">
						<span class="list_div_note" ><?php if($this->lang->line('shop_maximum') != '') { echo stripslashes($this->lang->line('shop_maximum')); } else echo 'Maximum 140 characters'; ?>:</span>
						<span class="list_div_note" id="maxtext_notify">140</span>
						<span class="list_div_note" > &nbsp; <?php if($this->lang->line('shop_remaining') != '') { echo stripslashes($this->lang->line('shop_remaining')); } else echo 'remaining'; ?> </span>
					</div>
				</div>
				<div class="form-group">
					<label id="about_fields" for="inputEmail3" class="col-sm-2 col-xs-12 control-label"><?php if($this->lang->line('prod_about_listing') != '') { echo stripslashes($this->lang->line('prod_about_listing')); } else echo 'About this listing'; ?></label>
					<div class="col-md-2 col-sm-3 col-xs-12">
						<select name="about_item" id="about_item">
							<option value=""><?php if($this->lang->line('shop_selectmaker') != '') { echo stripslashes($this->lang->line('shop_selectmaker')); } else echo 'Select a maker'; ?>...</option>

							<option value="1"><?php if($this->lang->line('shop_idid') != '') { echo stripslashes($this->lang->line('shop_idid')); } else echo 'I did'; ?></option>

							<option value="2" ><?php if($this->lang->line('shop_membershop') != '') { echo stripslashes($this->lang->line('shop_membershop')); } else echo 'A member of my shop'; ?></option>

							<option value="3" ><?php if($this->lang->line('shop_company') != '') { echo stripslashes($this->lang->line('shop_company')); } else echo 'Another company or person'; ?></option>
						</select>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12" id="What_is" style="display:none;">
						<select name="what_item" id="what_item">
							<option value=""><?php if($this->lang->line('shop_selectuse') != '') { echo stripslashes($this->lang->line('shop_selectuse')); } else echo 'Select a use'; ?>...</option>

                             <option value="1" ><?php if($this->lang->line('shop_finishedproduct') != '') { echo stripslashes($this->lang->line('shop_finishedproduct')); } else echo 'A finished product'; ?></option>

                             <option value="2" ><?php if($this->lang->line('shop_supplytool') != '') { echo stripslashes($this->lang->line('shop_supplytool')); } else echo 'A supply or tool to make things'; ?></option>
						</select>
					</div>
					<div class="col-sm-2 col-xs-12" id="When_is" style="display:none;">
						<select name="when_made" id="when_made">
							<optgroup label="<?php echo af_lg('lg_notyetmade','Not yet made');?>">
								<option value="made_to_order" ><?php if($this->lang->line('shop_madeorder') != '') { echo stripslashes($this->lang->line('shop_madeorder')); } else echo 'Made to order'; ?></option>
							</optgroup>
							<optgroup label="<?php echo af_lg('lg_recently','Recently');?>">
								<option value="2010,<?php echo date("Y"); ?>">2010 - <?php echo date("Y"); ?></option>
								<option value="2000,2009">2000  - 2009</option>
								<option value="1995,1999">1995  - 1999</option>
							</optgroup>
							<optgroup label="<?php echo af_lg('lg_vintage','Vintage');?>">
								<option value="0,1994"><?php if($this->lang->line('shop_sometimebefore') != '') { echo stripslashes($this->lang->line('shop_sometimebefore')); } else echo 'Sometime before'; ?> 1995</option>
								<option value="1990,1994">1990  - 1994</option>
								<option value="1980,1989">1980s</option>
								<option value="1970,1979">1970s</option>
								<option value="1960,1969">1960s</option>
								<option value="1950,1959">1950s</option>
								<option value="1940,1949">1940s</option>
								<option value="1930,1939">1930s</option>
								<option value="1920,1929">1920s</option>
								<option value="1910,1919">1910s</option>
								<option value="1900,1909">1900 - 1909</option>
								<option value="1800,1899">1800s</option>
								<option value="1700,1799">1700s</option>
								<option value="0,1699"><?php if($this->lang->line('shop_before') != '') { echo stripslashes($this->lang->line('shop_before')); } else echo 'Before'; ?> 1700</option>
							</optgroup>
						</select>
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12 right P8">
						<p><a href="#" target="_blank"> <?php if($this->lang->line('prod_about_listing_text') != '') { echo stripslashes($this->lang->line('prod_about_listing_text')); } else echo 'Learn more about what types of itemsare allowedon Easy'; ?></a></p>
					</div>
				</div>
				<div class="form-group">
					<label  id="category_fields" for="inputEmail3" class="col-sm-2 control-label"><?php if($this->lang->line('shop_categories') != '') { echo stripslashes($this->lang->line('shop_categories')); } else echo 'Categories'; ?></label>
					<div class=" col-sm-3 col-md-2 col-xs-12">
						<select name="main_cat_id" id="main_cat_id">
							<option value=""><?php if($this->lang->line('shop_selectcategory') != '') { echo stripslashes($this->lang->line('shop_selectcategory')); } else echo 'Select a category'; ?></option>
							<?php foreach($mainCategories->result() as $MaincatValues) {?>
                                <option value="<?php echo $MaincatValues->id;?>"><?php echo $MaincatValues->cat_name;?></option>
							<?php }?>
						</select>
					</div>
					<div class="" style="display:none" id="level1_sub_cat_loading">
                        <div id="loader1" class=""><img src="images/ajax_loading.gif" alt="loading subcategory" /></div>
					</div>
					<div class="col-sm-2" style="display:none" id="level1_sub_cat_result">
						<select id="level1_sub_cat" name="level1_sub_cat">
							<option value=""><?php if($this->lang->line('shop_sub_selectcategory') != '') { echo stripslashes($this->lang->line('shop_sub_selectcategory')); } else echo 'Select a sub category'; ?></option>
						</select>
					</div>
					<div class="" style="display:none" id="level2_sub_cat_loading">
						<div id="loader2" class=""><img src="images/ajax_loading.gif" alt="loading subcategory" /></div>
					</div>
					<div class="col-sm-3" style="display:none" id="level2_sub_cat_result">
						<select id="level2_sub_cat" name="level2_sub_cat">
							<option value=""><?php if($this->lang->line('shop_sub_selectcategory') != '') { echo stripslashes($this->lang->line('shop_sub_selectcategory')); } else echo 'Select a sub category'; ?></option>
						</select>
					</div>
				</div>
					<input type="radio" name="pricing_type" data-pricing="fixed" id="type_fixed" value="Fixed" checked style="display:none">
				<div class="form-group">
					<label id="PriceLab" for="price" class="col-sm-2 control-label"><?php if($this->lang->line('giftcard_price') != '') { echo stripslashes($this->lang->line('giftcard_price')); } else echo 'Price'; echo "   (  ".$currencySymbol ."   )";  ?></label>
					<div class="col-sm-2 input-group" id="price_div_disp">
						<span class="input-group-addon">$</span>
						<input type="text" class="form-control" placeholder="<?php echo $currencySymbol;?>:" value="" id="price" name="price">
					</div>
					<div  class="list_inner_right" id="price_div_hid" style="display:none;">
						<span class="price-input-variations-notice">
							<?php if($this->lang->line('shop_pricevariation') != '') { echo stripslashes($this->lang->line('shop_pricevariation')); } else echo 'Price has been set by variation'; ?>.<br>
							<?php if($this->lang->line('shop_generalprice') != '') { echo stripslashes($this->lang->line('shop_generalprice')); } else echo 'To set a general price'; ?> <a href="javascript:void(0)" id="remove_attr_pricing"><?php if($this->lang->line('shop_pricingvariation') != '') { echo stripslashes($this->lang->line('shop_pricingvariation')); } else echo 'turn off pricing by variation'; ?></a>
						</span>
					</div>
					<!-- <div class="col-md-3 col-sm-12 right P8">
						<p><?php if($this->lang->line('giftcard_price_text') != '') { echo stripslashes($this->lang->line('giftcard_price_text')); } else echo 'Factor in the costs of materials and labor, plus any related business expenses.'; ?></p>
					</div> -->
					<input type="hidden" name="price_status"  id="price_status" value="1" />
				</div>
				
				<!--<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Renewal option</label>
					<div class="col-sm-3">
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>Manual
							</label>
						</div>
						<p>I'll renew expired listings myself. </p>
					</div>
					<div class="col-sm-4">
						<div class="radio">
							<label>
								<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">Automatic
							</label>
						</div>
						<p>This listing will renew as it expires for $0.20 USD each time. </p>
					</div>
					<div class="col-sm-3">
						<p>Get more details on Auto-renew <a href="#">here. </a></p>
					</div>
				</div>-->
				<div class="form-group">
					<!--<label for="inputEmail3" class="col-sm-2 control-label"><?php if($this->lang->line('shop_itemtype') != '') { echo stripslashes($this->lang->line('shop_itemtype')); } else echo 'Item type'; ?></label>
					<div class="col-md-2 col-sm-4 col-xs-12">
						<div class="radio">
							<label>
								<input type="radio" name="item_name" id="physical_item" value="physical" onclick="return dis_val('variation_wrapper')" checked><?php if($this->lang->line('shop_physical') != '') { echo stripslashes($this->lang->line('shop_physical')); } else echo 'Physical item'; ?>
							</label>
						</div>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-12">
						<div class="radio">
							<label>
								<input type="radio" name="item_name" id="digital_item" value="digital" onclick="return dis_val('file_wrapper')"><?php if($this->lang->line('shop_digitalfile') != '') { echo stripslashes($this->lang->line('shop_digitalfile')); } else echo 'Digital file'; ?>
							</label>
						</div>
					</div>-->
					<div class="form-group" data-pricing-type="Fixed">
					<label id="QuantityLab" for="quantity" class="col-sm-2 control-label"><?php if($this->lang->line('shop_quantity') != '') { echo stripslashes($this->lang->line('shop_quantity')); } else echo 'Quantity'; ?></label>
					<div class="col-sm-2 input-group">
						<input type="text" class="form-control" id="quantity" name="quantity" value="1">
						<span class="input-group-addon"> <?php echo af_lg('quantity_piece','piece'); ?>
					</div>
					<div class="col-sm-5"></div>
					<div class="col-md-3 col-sm-12" id="qty_text_div">
						<p><?php if($this->lang->line('shop_quantity_text') != '') { echo stripslashes($this->lang->line('shop_quantity_text')); } else echo ''; ?> </p>
					</div>
				</div>
					<div class="col-sm-3 display-ntng"></div>
					
				
					
				<div class="form-group">
					<label id="Description" for="inputEmail3" class="col-sm-2 col-xs-12 control-label"><?php if($this->lang->line('shop_description') != '') { echo stripslashes($this->lang->line('shop_description')); } else echo 'Description'; ?></label>
					<div class="col-md-7 col-sm-12">
<!--  					<textarea onkeyup="change('desc','goo_item_desc');" class="form-control" name="description"  id="desc" rows="13"></textarea> -->
						<textarea onkeyup="change('desc','goo_item_desc');" style=" width:295px" class="tipTop mceEditor" name="description"  id="desc" title="Please enter the description"></textarea>
						<p><?php if($this->lang->line('shop_searchresults') != '') { echo stripslashes($this->lang->line('shop_searchresults')); } else echo 'Preview how your listing will appear in Google search results'; ?> <a href="javascript:void(0)" id="preview_GSR" onclick="return Goog_SR('preview_GSR');"><?php if($this->lang->line('shop_hidepreview') != '') { echo stripslashes($this->lang->line('shop_hidepreview')); } else echo 'Hide preview'; ?></a></p>
						<div class="list_inner_fields preview_div" id="preview">
                        <div class="list_inner_right">
                        	<p class="goo_title">
                            <span id="goo_item_title"><?php if($this->lang->line('shop_itemtitle') != '') { echo stripslashes($this->lang->line('shop_itemtitle')); } else echo 'Item Title'; ?></span>
                            <?php if($this->lang->line('shop_by') != '') { echo stripslashes($this->lang->line('shop_by')); } else echo 'by'; ?> <?php  echo stripslashes($selectSeller_details[0]['seller_businessname']); ?> <?php if($this->lang->line('shop_on') != '') { echo stripslashes($this->lang->line('shop_on')); } else echo 'on'; ?> <?php echo $this->config->item('email_title'); ?>
                            </p>
                    		<p class="goo_desc" id="goo_item_desc"><?php if($this->lang->line('shop_descriptionappear') != '') { echo stripslashes($this->lang->line('shop_descriptionappear')); } else echo 'Your description will appear here'; ?>...</p>
                        </div>
                    </div>
						
					</div>
					
				
				<!--<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Section
						<p>optional</p>
					</label>
					<div class="col-sm-3">
						<select>
							<option class="select">None</option>
							<option class="select">Ghn</option>
							<option class="select">Add a section</option>
						</select>
					</div>
					<div class="col-sm-7"></div>
				</div>-->
			</div>
			
			
			<?php if($this->config->item('deal_of_day')=='Yes') {?>
			<div class="col-lg-12 sh_border" data-pricing-type="Fixed">
				<h4><?php echo af_lg('lg_deal_of_the_day','Deal Of The Day'); ?></h4>
				
				<div class="form-group">
					<label id="title" for="product_name" class="col-xs-12 col-sm-2 control-label"><?php echo af_lg('lg_deal_date','Deal Date'); ?></label>
					<div id="price_div_disp" class="col-sm-2">
						<input type="text"  name="deal_date_from" id="deal_date_from" value="" placeholder="<?php echo af_lg('lg_from_date','From Date'); ?>" class="form-control datepicker">
					</div>
					<div id="price_div_disp" class="col-sm-2">
						<input type="text" name="deal_date_to" id="deal_date_to" value="" placeholder="<?php echo af_lg('lg_to_date','To Date'); ?>" class="form-control datepicker2">
					</div>
					
				</div>
				
				
				<div class="form-group">
					<label id="title" for="product_name" class="col-xs-12 col-sm-2 control-label"><?php echo af_lg('lg_deal_time','Deal Time'); ?></label>
					<div id="price_div_disp" class="col-sm-2">
						<input type="text" name="deal_time_from" id="deal_time_from" value="" placeholder="<?php echo af_lg('lg_from_time','From Time'); ?>" class="form-control time">
					</div>
					<div id="price_div_disp" class="col-sm-2">
						<input type="text" name="deal_time_to" id="deal_time_to" value="" placeholder="<?php echo af_lg('lg_to_time','To Time'); ?>" class="form-control time">
					</div>
					
				</div>
				
				<div class="form-group">
					<label id="discount_name" for="product_name" class="col-xs-12 col-sm-2 control-label"><?php echo af_lg('lg_discount','Discount'); ?></label>
					<div id="price_div_disp" class="col-sm-2 input-group">
						<span class="input-group-addon">-</span>
						<input type="text" name="discount" id="discount" value="" placeholder="%" class="form-control">
						<span class="input-group-addon">%</span>
					</div>
					
				</div>
														
				
			</div>
<?php }?>
			<div class="col-lg-12 sh_border1" id="add-photos">
			
				<h4 id="photoErr"><?php if($this->lang->line('shop_photos') != '') { echo stripslashes($this->lang->line('shop_photos')); } else echo 'Photos'; ?></h4>
				<p><?php if($this->lang->line('add_atleast_onephoto') != '') { echo stripslashes($this->lang->line('add_atleast_onephoto')); } else echo "Add at least one photo. Use all five photos to show off your item's finest features."; ?></p>
				
				
				<div class="error" id="showImgErr" style="display:none; text-align:center;"></div>
				
				<!--<div class="col-lg-9 add-shop-main">
					<div class="add-shop-photos">
						<div class="photos-box">
							<div class="card-img-wrap-input">
								<input type="file" class="wrap-input-file image-upload" id="image_upload" name="image_upload">
							</div>	
							<img src="" id="loadedImg" style="display:none"> </img>
							<div class="card-img-wrap active-wrap">
								<i class="fa fa-camera icon-size"></i>
								<span><?php if($this->lang->line('shop_addphotos') != '') { echo stripslashes($this->lang->line('shop_addphotos')); } else echo 'ADD PHOTOS'; ?></span>
							</div>
							<div class="photos-box-bottom"></div>
						</div>
						<div class="photos-box">
							<div class="card-img-wrap-input" id="imgFormdata1" style="display:none">
								<input type="file" class="wrap-input-file image-upload" id="image_upload1" name="image_upload1">
							</div>
							<img src="" id="loadedImg1" style="display:none"> </img>
							<div class="card-img-wrap active-wrap">
								<div id="imgAddData1" style="display:none">
									<i class="fa fa-camera icon-size"></i>
									<span><?php if($this->lang->line('shop_addphotos') != '') { echo stripslashes($this->lang->line('shop_addphotos')); } else echo 'ADD PHOTOS'; ?></span>
								</div>
							</div>
							<div class="photos-box-bottom"></div>
						</div>
						<div class="photos-box">
							<div class="card-img-wrap-input" id="imgFormdata2" style="display:none">
								<input type="file" class="wrap-input-file image-upload" id="image_upload2" name="image_upload2">
							</div>
							<img src="" id="loadedImg2" style="display:none"> </img>
							<div class="card-img-wrap active-wrap">
								<div id="imgAddData2" style="display:none">
									<i class="fa fa-camera icon-size"></i>
									<span><?php if($this->lang->line('shop_addphotos') != '') { echo stripslashes($this->lang->line('shop_addphotos')); } else echo 'ADD PHOTOS'; ?></span>
								</div>
							</div>
							<div class="photos-box-bottom"></div>
						</div>
						<div class="photos-box">
							<div class="card-img-wrap-input" id="imgFormdata3" style="display:none">
								<input type="file" class="wrap-input-file image-upload" id="image_upload3" name="image_upload3">
							</div>
							<img src="" id="loadedImg3" style="display:none"> </img>
							<div class="card-img-wrap active-wrap">
								<div id="imgAddData3" style="display:none">
									<i class="fa fa-camera icon-size"></i>
									<span><?php if($this->lang->line('shop_addphotos') != '') { echo stripslashes($this->lang->line('shop_addphotos')); } else echo 'ADD PHOTOS'; ?></span>
								</div>
							</div>
							<div class="photos-box-bottom"></div>
						</div>
						<div class="photos-box">
							<div class="card-img-wrap-input" id="imgFormdata4" style="display:none">
								<input type="file" class="wrap-input-file image-upload" id="image_upload4" name="image_upload4">
							</div>
							<img src="" id="loadedImg4" style="display:none"> </img>
							<div class="card-img-wrap active-wrap">
								<div id="imgAddData4" style="display:none">
									<i class="fa fa-camera icon-size"></i>
									<span><?php if($this->lang->line('shop_addphotos') != '') { echo stripslashes($this->lang->line('shop_addphotos')); } else echo 'ADD PHOTOS'; ?></span>
								</div>
							</div>
							<div class="photos-box-bottom"></div>
						</div>
					</div>			
				</div>-->
				<div class="list_inner_fields">
                    	<label ></label>
                        <div class="list_inner_right">
                        	<ul class="photo_list">
                            	
                            	
                            	<li>
                                	<div>
                                    	<div class="photo_contain">
                                    		<span class="image-wrap" onclick="delete_image('image_upload','loadedImg')">X</span>
											<input type="file" class="image-upload" id="image_upload" name="image_upload"> 
                                        </div>
										<img class="upload-img1" src="" id="loadedImg" width="90px" height="71px" style="display:none"> </img>
                                        <div class="photo_add">
                                        	<span class="add_butn"></span>
                                            <span><?php if($this->lang->line('shop_addphotos') != '') { echo stripslashes($this->lang->line('shop_addphotos')); } else echo 'ADD PHOTOS'; ?></span>
                                        </div>
                                    </div>
                                </li>                              
                               <li class="image_empty" id="img_empty1">
                                    <div>
                                    	<div class="photo_contain" id="imgFormdata1" style="display:none">
                                    		<span class="image-wrap" onclick="delete_image('image_upload1','loadedImg1')">X</span>
                                        	<input type="file" class="image-upload" id="image_upload1" name="image_upload1">
                                        </div>
										<img class="upload-img1" src="" id="loadedImg1" width="90px" height="71px" style="display:none"> </img>
                                        <div class="photo_add" style="display:none" id="imgAddData1">
                                        	<span class="add_butn"></span>
                                            <span><?php if($this->lang->line('shop_addphotos') != '') { echo stripslashes($this->lang->line('shop_addphotos')); } else echo 'ADD PHOTOS'; ?></span>
                                        </div>
                                    </div>
                                </li>
                                <li class="image_empty" id="img_empty2">
                                    <div>
                                    	<div class="photo_contain" id="imgFormdata2" style="display:none">
                                    		<span class="image-wrap" onclick="delete_image('image_upload2','loadedImg2')">X</span>
                                        	<input type="file" class="image-upload" id="image_upload2" name="image_upload2">
                                        </div>
										<img class="upload-img1" src="" id="loadedImg2" width="90px" height="71px" style="display:none"> </img>
                                        <div class="photo_add" style="display:none" id="imgAddData2">
                                        	<span class="add_butn"></span>
                                            <span><?php if($this->lang->line('shop_addphotos') != '') { echo stripslashes($this->lang->line('shop_addphotos')); } else echo 'ADD PHOTOS'; ?></span>
                                        </div>
                                    </div>
                                </li>
                                <li class="image_empty" id="img_empty3">
                                    <div>
                                    	<div class="photo_contain" id="imgFormdata3" style="display:none">
                                    		<span class="image-wrap" onclick="delete_image('image_upload3','loadedImg3')">X</span>
                                        	<input type="file" class="image-upload" id="image_upload3" name="image_upload3">
                                        </div>
										<img class="upload-img1" src="" id="loadedImg3" width="90px" height="71px" style="display:none"> </img>
                                        <div class="photo_add" style="display:none" id="imgAddData3">
                                        	<span class="add_butn"></span>
                                            <span><?php if($this->lang->line('shop_addphotos') != '') { echo stripslashes($this->lang->line('shop_addphotos')); } else echo 'ADD PHOTOS'; ?></span>
                                        </div>
                                    </div>
                                </li>
                                <li class="image_empty" id="img_empty4">
                                    <div>
                                    	<div class="photo_contain" id="imgFormdata4" style="display:none">
                                    		<span class="image-wrap" onclick="delete_image('image_upload4','loadedImg4')">X</span>
                                        	<input type="file" class="image-upload" id="image_upload4" name="image_upload4">
                                        </div>
										<img class="upload-img1" src="" id="loadedImg4" width="90px" height="71px" style="display:none"> </img>
                                        <div class="photo_add" style="display:none" id="imgAddData4">
                                        	<span class="add_butn"></span>
                                            <span><?php if($this->lang->line('shop_addphotos') != '') { echo stripslashes($this->lang->line('shop_addphotos')); } else echo 'ADD PHOTOS'; ?></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
				<div class="col-md-3 col-sm-12"><p> <?php if($this->lang->line('std_img') != '') { echo stripslashes($this->lang->line('std_img')); } else echo 'Note: Standard Image size is 550 x 350 pixel.'; ?></p></div>
			</div>
			<div class="col-lg-12 sh_border1" id="variation_wrapper">
				<h4><?php if($this->lang->line('shop_variations') != '') { echo stripslashes($this->lang->line('shop_variations')); } else echo 'Variations'; ?></h4>
				<p><?php if($this->lang->line('shop_variations_text') != '') { echo stripslashes($this->lang->line('shop_variations_text')); } else echo 'Add Variations to your listing to highlight available options for buyers.'; ?></p>
				
				
				<div class="col-lg-12 variation_wrapper_list">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label"><?php if($this->lang->line('ask_for_variation') != '') { echo stripslashes($this->lang->line('ask_for_variation')); } else echo '加入特徵'; ?></label>
					<p id="have_scalling" style="display:none;"></p>					
					<div class="col-md-10 col-sm-12">
					<select id="property_level" class="vari_option" name="property_level">
						<option value=""><?php if($this->lang->line('shop_availableproperty') != '') { echo stripslashes($this->lang->line('shop_availableproperty')); } else echo 'Select available property'; ?>...</option>
						<?php foreach($variations_result as $variations) { ?>   <option value="<?php echo $variations->attr_seourl; ?>"><?php echo $variations->attr_name; ?></option> <?php } ?>               
					</select>	
					 <div id="variation_one">
					 <div class="list_inner_right list_small_width" id="variations_level_div"></div>
					<div style="float:right;">
						<a href="javascript:void(0)" onclick="return clear_data();" id="close_var_one" style="display:none;" class="close_icon"></a>
					</div>
					<div class="list_inner_right list_small_width" id="attr_loader" style="display:none"><img src="images/ajax_loading.gif" alt="loading variations" /></div>
					<div class="list_inner_right list_small_width" id="options_level" name="options_level" style="display:none"></div>
					<div class="list_inner_right list_small_width" id="attr_options_val" name="attr_options_val" style="display:none">
						<select style="width:30% " onchange="return alpha_check(this);" id="checked_alpha_value" class="alpha_value_one">
							<option value=""><?php if($this->lang->line('shop_selavailableoptions') != '') { echo stripslashes($this->lang->line('shop_selavailableoptions')); } else echo 'Select available options'; ?>...</option>
							<option>XXS</option>
							<option>XS</option>
							<option>S</option>
							<option>M</option>
							<option>L</option>
							<option>XL</option>
							<option>XXL</option>
							<option>3XL</option>
							<option>4XL</option>
							<option>5XL</option>                               
						</select>
					</div>
					<div class="list_inner_fields" style="border-bottom:none;">
						<div class="list_inner_right" id="options_table" style="display:none">
							<center><img src="images/ajax-loader/ajax-loader(14).gif" alt="Adding variations" style="display:none;" id="variation_add_loading1" /></center>
							<table width="100%" class="table table-striped" style="border: 1px solid #ccc;"  align="center" cellpadding="0" cellspacing="0" id="options_list">              
								<tbody>
									<tr style="background:#f9f9f9; margin: 0px; padding: 10px; width: 100%;">
										   <td width="25%" ><strong><?php if($this->lang->line('shop_options') != '') { echo stripslashes($this->lang->line('shop_options')); } else echo 'Options'; ?></strong></td>
										   <td width="25%">
												<span class="non-pricing-mode">
													<a href="javascript:void(0)" class="enable-variations-pricing" id="price_opt" onclick="price_opt_click();"><?php if($this->lang->line('shop_addpricing') != '') { echo stripslashes($this->lang->line('shop_addpricing')); } else echo 'Add Pricing'; ?></a>
												</span>
												<span class="pricing-mode retail">
													<a href="#variations-section" class="disable-variations-pricing remove button-remove"></a>
												</span>
											</td>
										   <td  width="25%" ><strong><?php if($this->lang->line('shop_instock') != '') { echo stripslashes($this->lang->line('shop_instock')); } else echo 'In Stock'; ?></strong></td>
										   <td  width="25%" ></td>
										</tr>
									</tbody>
								</table>
							</div>   
						</div> 
				   </div>
					</div>
				</div>

				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label"><?php if($this->lang->line('ask_for_variation') != '') { echo stripslashes($this->lang->line('ask_for_variation')); } else echo '加入特徵'; ?></label>
					<p id="have_scalling1" style="display:none;"></p>
					<div class="col-md-10 col-sm-12">
					<div class="list_inner_right list_small_width" id="variations_level_div1"></div>
					<select id="property_level1" class="vari_option">
						<option value=""><?php if($this->lang->line('shop_availableproperty') != '') { echo stripslashes($this->lang->line('shop_availableproperty')); } else echo 'Select available property'; ?>...</option>
						<?php foreach($variations_result as $variations) {?>   
						<option value="<?php echo $variations->attr_seourl; ?>"><?php echo $variations->attr_name; ?></option> 
						<?php }?>
					</select>					
					<div id="variation_two">
						 <div style="float:right;">
							<a href="javascript:void(0)" onclick="return clear_data1();" id="close_var_two" style="display:none;" class="close_icon"></a>
						 </div>
						 <div class="list_inner_right list_small_width" id="attr_loader1" style="display:none">
							<img src="images/ajax_loading.gif" alt="loading variations" />
						 </div>
						 <div class="list_inner_right list_small_width" id="options_level1" name="options_level1" style="display:none"></div>
						<div class="list_inner_right list_small_width" id="attr_options_val1" name="attr_options_val1" style="display:none">
						
						
							<select style="width:30%" onchange="return alpha_check1(this);" id="checked_alpha_value1" class="alpha_value_two">
								<option value=""><?php if($this->lang->line('shop_selavailableoptions') != '') { echo stripslashes($this->lang->line('shop_selavailableoptions')); } else echo 'Select available options'; ?>...</option>
								<option>XXS</option>
								<option>XS</option>
								<option>S</option>
								<option>M</option>
								<option>L</option>
								<option>XL</option>
								<option>XXL</option>
								<option>3XL</option>
								<option>4XL</option>
								<option>5XL</option>                               
							</select>
	
						</div>
						<div class="list_inner_fields" style="border-bottom:none;">
							<div class="list_inner_right" id="options_table1" style="display:none">
								<center><img src="images/ajax-loader/ajax-loader(14).gif" alt="Adding variations" style="display:none;" id="variation_add_loading2" /></center>
								<table width="100%" class="inner_table"  align="center" cellpadding="0" cellspacing="0" id="options_list1">              
									<tbody>
										<tr style="background:#f9f9f9; margin: 0px; padding: 10px; width: 100%;">
											<td width="25%" ><strong><?php if($this->lang->line('shop_options') != '') { echo stripslashes($this->lang->line('shop_options')); } else echo 'Options'; ?></strong></td>
											<td width="25%">
												<span class="non-pricing-mode">&nbsp;
													<!--<a href="javascript:void(0)" class="enable-variations-pricing" id="price_opt1" onclick="price_opt_click1();">Add Pricing</a>-->
												</span>
												<span class="pricing-mode retail">
													<a href="#variations-section" class="disable-variations-pricing remove button-remove"></a>
												</span>
											</td>
										   <td  width="25%" ><strong><?php if($this->lang->line('shop_instock') != '') { echo stripslashes($this->lang->line('shop_instock')); } else echo 'In Stock'; ?></strong></td>
										   <td  width="25%" ></td>
										</tr>
									</tbody>
								</table>
							</div>   
						</div>	                        
					</div>
					</div>
				</div>
				</div>
				
			</div>
			<div class="col-lg-12 sh_border1" id="digital_wrapper" style="display:none;">
				<h4 id="digital_label" ><?php if($this->lang->line('shop_digitalfile') != '') { echo stripslashes($this->lang->line('shop_digitalfile')); } else echo 'Digital file'; ?></h4>
				<p><?php if($this->lang->line('descriptive_titles_best') != '') { echo stripslashes($this->lang->line('descriptive_titles_best')); } else echo 'Descriptive titles are best. Try to describe your item the way a buyer would.'; ?>  </p>
				<span id="digiErrmsg" style="color: #a80308 !important;"></span>
				<div class="form-group">
					<div class="col-sm-8">
						<label for="file_upload" class="upload_button"><i class="fa fa-upload up-items"></i><?php if($this->lang->line('shop_addfile') != '') { echo stripslashes($this->lang->line('shop_addfile')); } else echo 'Add file'; ?></label>
                            <img src="images/loading.gif" id="loadedFile" style="display:none"> </img>
                            <input type="file" id="file_upload" name="file_upload" style="display:none;">
							
					<table width="100%" class="inner_table" border="0"  align="center" cellpadding="0" cellspacing="0" id="DigiFiles" >     
						<tr style="display:none;">
							<td width="70%"> &nbsp;<p id="Digi_Files_1"></p>
								<input type="hidden" value="" class="DigiFiles" name="DigiFiles[]">
							</td>
							<td width="30%">
								<a class="close_icon left" href="javascript:void(0)""javascript:void(0)" style="margin:7px 0 0 5px" id="" onclick ="digitalfile_remove(this);"></a>
							</td>
						</tr>
					</table>
					
					</div>
					
					<div class="col-sm-1">&nbsp;</div>
					
					<div class="col-sm-3">
						<span class="list_div_note list_rightalign"> <?php if($this->lang->line('shop_addupto') != '') { echo stripslashes($this->lang->line('shop_addupto')); } else echo 'Add up to'; ?> <span id="filecount">5</span> <?php if($this->lang->line('shop_fileslisting') != '') { echo stripslashes($this->lang->line('shop_fileslisting')); } else echo 'files to this listing'; ?> </span>
						 <p>  <?php if($this->lang->line('shop_guarantee') != '') { echo stripslashes($this->lang->line('shop_guarantee')); } else echo 'By adding files to this listing, you guarantee that you have rights to the content'; ?>. <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('shop_removecontent') != '') { echo stripslashes($this->lang->line('shop_removecontent')); } else echo 'may remove content per our'; ?><a href="pages/privacy-policy" class="google-preview_link"> <?php if($this->lang->line('shop_copyright') != '') { echo stripslashes($this->lang->line('shop_copyright')); } else echo 'Copyright and IP Policy'; ?></a>, <?php if($this->lang->line('shop_purchasedfiles') != '') { echo stripslashes($this->lang->line('shop_purchasedfiles')); } else echo 'at which point buyers may not be able to access purchased files. See our'; ?> <a href="pages/terms-conditions" class="google-preview_link" target="_blank"><?php if($this->lang->line('shop_terms') != '') { echo stripslashes($this->lang->line('shop_terms')); } else echo 'Terms'; ?></a> <?php if($this->lang->line('shop_moreinformation') != '') { echo stripslashes($this->lang->line('shop_moreinformation')); } else echo 'for more information'; ?>.<br />
						<a href="appearance/<?php echo $seller_info[0]['seourl']; ?>/shop-title" class="google-preview_link" target="_blank"><?php if($this->lang->line('shop_digitalitems') != '') { echo stripslashes($this->lang->line('shop_digitalitems')); } else echo 'Add a note for buyers who purchase digital items'; ?></a></p>
					</div>
				</div>
			</div>
			<div class="col-lg-12 sh_border1" id="shipping_wrapper" hidden="hidden">
				<h4><?php if($this->lang->line('shopsec_shipping') != '') { echo stripslashes($this->lang->line('shopsec_shipping')); } else echo 'Shipping'; ?></h4>
				<p><?php if($this->lang->line('shopsec_shipping_text') != '') { echo stripslashes($this->lang->line('shopsec_shipping_text')); } else echo 'Set clear and realistic shipping expectations for shoppers by providing accurate processing time and shipping rates.'; ?></p>
				<!--<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label"><?php if($this->lang->line('shopsec_shipping_weight') != '') { echo stripslashes($this->lang->line('shopsec_shipping_weight')); } else echo 'Item Weight'; ?></label>
					<div class="col-sm-3">
						<input type="email" class="form-control" id="inputEmail3">
					</div>
					<div class="col-sm-3">
						<input type="email" class="form-control" id="inputEmail3">
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-3">
						<p><?php if($this->lang->line('shopsec_shipping_weighttext') != '') { echo stripslashes($this->lang->line('shopsec_shipping_weighttext')); } else echo 'Weight and size are required for calculated profiles.<a href="#"> Learn more about calculated shipping.'; ?></a></p>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label"><?php if($this->lang->line('shopsec_shipping_weight') != '') { echo stripslashes($this->lang->line('shopsec_shipping_weight')); } else echo 'Item Weight'; ?>Item Size</label>
					<div class="col-sm-2">
						<label><?php if($this->lang->line('shopsec_shipping_length') != '') { echo stripslashes($this->lang->line('shopsec_shipping_length')); } else echo 'Length'; ?></label>
						<input type="email" class="form-control" id="inputEmail3" placeholder="in">
					</div>
					<div class="col-sm-3">
						<label><?php if($this->lang->line('shopsec_shipping_width') != '') { echo stripslashes($this->lang->line('shopsec_shipping_width')); } else echo 'width'; ?></label>
						<input type="email" class="form-control" id="inputEmail3"  placeholder="in">
					</div>
					<div class="col-sm-2">
						<label><?php if($this->lang->line('shopsec_shipping_height') != '') { echo stripslashes($this->lang->line('shopsec_shipping_height')); } else echo 'Height'; ?></label>
						<input type="email" class="form-control" id="inputEmail3"  placeholder="in">
					</div>
					<div class="col-sm-3">
						<p><?php if($this->lang->line('shopsec_shipping_sizetext') != '') { echo stripslashes($this->lang->line('shopsec_shipping_sizetext')); } else echo 'Enter the weight and size of the item plus packing materials. This will be used to determine package size.'; ?></p>
					</div>
				</div>-->
				<!--<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Shipping Profile</label>
					<div class="col-sm-4">
						<select>
							<option>None</option>
							<option>yhe</option>
						</select>
					</div>
					<div class="col-sm-2"></div>
				</div>-->
				<!--
				<div class="form-group">
					<label id="title" for="product_name" class="col-xs-12 col-sm-2 control-label"><?php echo af_lg('lg_pick_up_option','Delivery/Collection Options'); ?></label>
					<div class="col-md-2 col-sm-4 col-xs-12" style="width:20% !important;">
						<div class="radio">
							<label>
								<input type="radio" name="pickup_option" id="pickup_local_or_delivery" value="delivery-collecion" onclick="pickupoption(this);" checked><?php echo af_lg('lg_pick_up_or_delivery','Delivery & Collection'); ?>
							</label>
						</div>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-12">
						<div class="radio">
							<label>
								<input type="radio" name="pickup_option" id="pickup_delivery" value="delivery" onclick="pickupoption(this);"><?php echo af_lg('lg_pick_up_delivery','Delivery Only'); ?>
							</label>
						</div>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-12">
						<div class="radio">
							<label>
								<input type="radio" name="pickup_option" id="pickup_local" value="collection" onclick="pickupoption(this);"><?php echo af_lg('lg_local_pickup','Collection Only'); ?>
							</label>
						</div>
					</div>
				</div>-->
				<div class="form-group">
					<label id="title" for="product_name" class="col-xs-12 col-sm-2 control-label"><?php echo af_lg('lg_pick_up_option','Delivery/Collection Options'); ?></label>
					<div class="col-md-2 col-sm-4 col-xs-12" style="width:20% !important;">
						<div class="radio">
							<label>
								<input type="radio" name="pickup_option" id="pickup_local_or_delivery" value="delivery-collecion" onclick="pickupoption(this);" checked><?php echo af_lg('lg_pick_up_or_delivery','Delivery & Collection'); ?>
							</label>
						</div>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-12">
						<div class="radio">
							<label>
								<input type="radio" name="pickup_option" id="pickup_delivery" value="delivery" onclick="pickupoption(this);"><?php echo af_lg('lg_pick_up_delivery','Delivery Only'); ?>
							</label>
						</div>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-12">
						<div class="radio">
							<label>
								<input type="radio" name="pickup_option" id="pickup_local" value="collection" onclick="pickupoption(this);"><?php echo af_lg('lg_local_pickup','Collection Only'); ?>
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label"><?php //if($this->lang->line('shop_processingtime') != '') { echo stripslashes($this->lang->line('shop_processingtime')); } else echo 'Processing time'; ?></label>
					<div class="col-sm-4">
						  <select onchange="return processing_time_shipping(this.value);" name="ship_duration" id="ship_duration" hidden="hidden">
								<option value="0">No Date</option>
                            	    <option value=""><?php if($this->lang->line('shop_shipin') != '') { echo stripslashes($this->lang->line('shop_shipin')); } else echo 'Ready to ship in'; ?>...</option>
                                    <optgroup label="----------------------------"></optgroup>
                                    <option class="range-1-1">1 <?php if($this->lang->line('shop_businessday') != '') { echo stripslashes($this->lang->line('shop_businessday')); } else echo 'business day'; ?></option>
                                    <option class="range-1-2">1-2 <?php if($this->lang->line('shop_businessdays') != '') { echo stripslashes($this->lang->line('shop_businessdays')); } else echo 'business days'; ?></option>
                                    <option class="range-1-3">1-3 <?php if($this->lang->line('shop_businessdays') != '') { echo stripslashes($this->lang->line('shop_businessdays')); } else echo 'business days'; ?></option>
                                    <option class="range-3-5">3-5 <?php if($this->lang->line('shop_businessdays') != '') { echo stripslashes($this->lang->line('shop_businessdays')); } else echo 'business days'; ?></option>
                                    <option class="range-5-10">1-2 <?php if($this->lang->line('shop_weeks') != '') { echo stripslashes($this->lang->line('shop_weeks')); } else echo 'weeks'; ?></option>
                                    <option class="range-10-15">2-3 <?php if($this->lang->line('shop_weeks') != '') { echo stripslashes($this->lang->line('shop_weeks')); } else echo 'weeks'; ?></option>
                                    <option class="range-15-20">3-4 <?php if($this->lang->line('shop_weeks') != '') { echo stripslashes($this->lang->line('shop_weeks')); } else echo 'weeks'; ?></option>
                                    <option class="range-20-30">4-6 <?php if($this->lang->line('shop_weeks') != '') { echo stripslashes($this->lang->line('shop_weeks')); } else echo 'weeks'; ?></option>
                                    <option class="range-30-40">6-8 <?php if($this->lang->line('shop_weeks') != '') { echo stripslashes($this->lang->line('shop_weeks')); } else echo 'weeks'; ?></option>
                                    <option value="custom" ><?php if($this->lang->line('shop_customrange') != '') { echo stripslashes($this->lang->line('shop_customrange')); } else echo 'Custom range'; ?></option>
                            </select>
							<div style="margin-top:27px; display:none;" id="custom_shipping_time">
								<div style="float: left; width: 70%; margin: 10px 0px 0px 150px;">
									<input checked="checked" id="business-days" name="processing_time_units" type="radio" value="business days">
									<label for="business-days" style="float:none;"><?php if($this->lang->line('shop_businessdays') != '') { echo stripslashes($this->lang->line('shop_businessdays')); } else echo 'business days'; ?></label>
									<input  id="weeks" name="processing_time_units" type="radio" value="weeks">
									<label for="weeks"  style="float:none;"><?php if($this->lang->line('shop_weeks') != '') { echo stripslashes($this->lang->line('shop_weeks')); } else echo 'weeks'; ?></label>
								</div>
								<div style="float: left; margin: 10px 0px 0px 140px;">
									<select name="processing_min">
										<option><?php if($this->lang->line('user_from') != '') { echo stripslashes($this->lang->line('user_from')); } else echo 'From'; ?>...</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
									</select>
									<select name="processing_max">
										<option><?php if($this->lang->line('shop_to') != '') { echo stripslashes($this->lang->line('shop_to')); } else echo 'To'; ?>...</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
									</select>
                                </div>
							</div>							
						</div>
					<div class="col-sm-3"></div>
					<!--<div class="col-sm-3">
						<p><?php if($this->lang->line('shop_processingtime_text') != '') { echo stripslashes($this->lang->line('shop_processingtime_text')); } else echo 'The estimated time between purchase date and ship date.'; ?></p>
					</div>-->
				</div>
				<div class="form-group" id="ship_from_option">
					<label for="inputEmail3" class="col-sm-2 control-label"><?php //if($this->lang->line('shop_shipsfrom') != '') { echo stripslashes($this->lang->line('shop_shipsfrom')); } else echo 'Ships from'; ?></label>
					<div class="col-sm-4">
						<select name="shipping_from" id="shipping_from" onchange="toggleDisabilityfrom(this);" hidden="hidden">
						<option value="1">No shipping</option>
							<option value=""><?php if($this->lang->line('shop_sellocation') != '') { echo stripslashes($this->lang->line('shop_sellocation')); } else echo 'Select a location'; ?></option>
							<?php foreach($countryList as $countryVal) {?> 
							<option value="<?php echo $countryVal->id.'|'.$countryVal->name; ?>"><?php echo $countryVal->name; ?></option> 
							<?php }?>
						</select>
					</div>
					<div class="col-sm-2"></div>
				</div>
				<div class="form-group" id="shipping_cost_option">
					<label for="inputEmail3" class="col-sm-2 control-label"><?php //if($this->lang->line('shop_shippingcost') != '') { echo stripslashes($this->lang->line('shop_shippingcost')); } else echo 'Shipping Cost'; ?></label>
					<div class="col-md-10 col-sm-12 big-table">
						<input type="hidden" name="shipping_to[]" id="shiping_to_default" />
									 <select id="shipping_to_1" style="display:none;" class="shipping_to">
									 <option value="1">HK</option>
										<option value="" id="shiping_to_default"><?php if($this->lang->line('shop_countryname') != '') { echo stripslashes($this->lang->line('shop_countryname')); } else echo 'Country Name'; ?></option>
										<?php foreach($countryList as $countryVal) {?>   
										<option value="<?php echo $countryVal->id.'|'.$countryVal->name;  ?>"><?php echo $country->name; ?></option> 
										<?php }?>
                                	</select>   
						<input type="hidden" name="ship_to_id[]" id="shipping_to_1_id" />
						<input type="hidden" value="0" name="shipping_cost[]" class="form-control shipping_txt_bax" placeholder="<?php echo $currencySymbol;?>:"/>
						<input type="hidden" value="0" name="shipping_with_another[]" class="form-control shipping_txt_bax"  placeholder="<?php echo $currencySymbol;?>:"/>
						<!--<table class="table table-striped" style="border:1px solid #ccc;" id="tbNames">
							<tr>
								<th><?php if($this->lang->line('shop_shipsto') != '') { echo stripslashes($this->lang->line('shop_shipsto')); } else echo 'Ships to'; ?></th>
								<th><?php if($this->lang->line('shop_byitself') != '') { echo stripslashes($this->lang->line('shop_byitself')); } else echo 'By itself'; ?></th>
								<th><?php if($this->lang->line('shop_anotheritem') != '') { echo stripslashes($this->lang->line('shop_anotheritem')); } else echo 'With another item'; ?></th>
								<th></th>
							</tr>
							<tr>
								<td>
									<p id="shipping_to_1_lab"><?php if($this->lang->line('shop_countryname') != '') { echo stripslashes($this->lang->line('shop_countryname')); } else echo 'Country Name'; ?></p>
									 <input type="hidden" name="shipping_to[]" id="shiping_to_default" />
									 <select id="shipping_to_1" style="display:none;" class="shipping_to">
										<option value="" id="shiping_to_default"><?php if($this->lang->line('shop_countryname') != '') { echo stripslashes($this->lang->line('shop_countryname')); } else echo 'Country Name'; ?></option>
										<?php foreach($countryList as $countryVal) {?>   
										<option value="<?php echo $countryVal->id.'|'.$countryVal->name;  ?>"><?php echo $country->name; ?></option> 
										<?php }?>
                                	</select>      
									<input type="hidden" name="ship_to_id[]" id="shipping_to_1_id" />
								</td>
								<td>
									<input type="hidden" value="0" name="shipping_cost[]" class="form-control shipping_txt_bax" placeholder="<?php echo $currencySymbol;?>:"/>
								</td>
								<td>
									<input type="hidden" value="0" name="shipping_with_another[]" class="form-control shipping_txt_bax"  placeholder="<?php echo $currencySymbol;?>:"/>
								</td>
								<td></td>
							</tr>
							<tr>
								<td><p id="shipping_to_1_lab1"><?php if($this->lang->line('shop_everywhere') != '') { echo stripslashes($this->lang->line('shop_everywhere')); } else echo 'Everywhere Else'; ?></p>
									<input type="hidden" name="shipping_to[]" id="shipping_to_2" value="Everywhere Else" />
                                    <input type="hidden" id="shipping_to_2_id" name="ship_to_id[]" value="232">
								</td>
								<td>
									<input type="text" value="" class="form-control shipping_txt_bax" name="shipping_cost[]" placeholder="<?php echo $currencySymbol;?>:" />
								</td>
								<td>
									<input type="text" value="" class="form-control shipping_txt_bax" name="shipping_with_another[]"placeholder="<?php echo $currencySymbol;?>:"  />
								</td>
								<td>
									<a class="close_icon left" style="margin:7px 0 0 5px" href="javascript:void(0)" id="2"></a>
								</td>
							</tr>
							<tr>
								<td> 
									<p id="shipping_to_3_lab" style="margin:0px;"></p>
									<select id="shipping_to_3" class="shipping_to" onchange="display_sel_val(this); toggleDisability(this); " name="shipping_to[]" style="width:200px; padding: 3px 4px; box-shadow: none; margin: 0px; border: 1px solid rgb(205, 205, 205);">
										<option value=""><?php if($this->lang->line('shop_sellocation') != '') { echo stripslashes($this->lang->line('shop_sellocation')); } else echo 'Select a location'; ?></option>
                                            <?php foreach($countryList as $countryVal) {?>   
                                            <option value="<?php echo $countryVal->id.'|'.$countryVal->name; ?>"><?php echo $countryVal->name; ?></option> 
                                            <?php }?>
									</select>
									<input type="hidden" name="ship_to_id[]" id="shipping_to_3_id" />
								</td>
								<td>
									<input type="text" value="" class="form-control shipping_txt_bax" name="shipping_cost[]" placeholder="<?php echo $currencySymbol;?>:" />
								</td>
								<td>
									<input type="text" value="" class="form-control shipping_txt_bax" name="shipping_with_another[]"placeholder="<?php echo $currencySymbol;?>:"  />
								</td>
								<td>
									<a class="close_icon left" style="margin:7px 0 0 5px" href="javascript:void(0)" onclick="close_shipping(2)" id="2"></a>
								</td>
							</tr>
						</table>-->
						<p id="selected_country" style="display:none;"></p>
						<!--<input type="button" value="<?php if($this->lang->line('shop_location') != '') { echo stripslashes($this->lang->line('shop_location')); } else echo 'Add location'; ?>" class="search_btn" id="btnAdd"/>-->
						<img src="images/ajax-loader/ajax-loader(1).gif" alt="Loading" style="display:none;width:20px;height:20px;background:none;border:none;" class="search_btn" id="stimg" />
					</div>
				</div>
			</div>
			<div class="col-lg-12 sh_border1" >
				<h4><?php if($this->lang->line('shop_searchterms') != '') { echo stripslashes($this->lang->line('shop_searchterms')); } else echo 'Search terms'; ?></h4>
				<p><?php if($this->lang->line('shop_searchtermstext') != '') { echo stripslashes($this->lang->line('shop_searchtermstext')); } else echo 'Help more people discover your listing by using accurate and descriptive words or phrases.'; ?></p>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label"><?php if($this->lang->line('shop_tags') != '') { echo stripslashes($this->lang->line('shop_tags')); } else echo 'Tags'; ?></label>
					<div class="col-md-6 col-sm-8">
						<!--<div class="input-group">
							<input type="text" class="form-control" placeholder="Shape,color,Style">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button"><?php if($this->lang->line('shop_tagadd') != '') { echo stripslashes($this->lang->line('shop_tagadd')); } else echo 'Add'; ?></button>
							</span>
						</div>-->
						<div class="input-group">
							<span class="tagBox-list" id="tagBox-list-tags"></span>
							<input type="text" name="jquery-tagbox-tags" id="jquery-tagbox-tags"  onblur="testscript();" class="jQTagBox" style="display: block;">
						</div>
					</div>
					<div class="col-md-1 col-sm-3">
					
					
					<?php /* <p id="leftcount" ><?php if($this->lang->line('shop_lefttag') != '') { echo stripslashes($this->lang->line('shop_lefttag')); } else echo '13 left '; ?></p> */ ?></div>
					<div class="col-md-3 col-sm-12">
						<p ><?php if($this->lang->line('shop_searchtermstext1') != '') { echo stripslashes($this->lang->line('shop_searchtermstext1')); } else echo 'What words might someone use to search for your listings? Use all 13 tags to get found. Get ideas for tags'; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label"><?php if($this->lang->line('shop_materials') != '') { echo stripslashes($this->lang->line('shop_materials')); } else echo 'Materials'; ?></label>
					<div class="col-md-6 col-sm-8">
						<!--<div class="input-group">
							<input type="text" class="form-control" placeholder="ingrediants,componets..etc">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button"><?php if($this->lang->line('shop_tagadd') != '') { echo stripslashes($this->lang->line('shop_tagadd')); } else echo 'Add'; ?></button>
							</span>
						</div>-->
						<div class="input-group">
							<span class="tagBox-list" id="tagBox-list-materials"></span>
							<input type="text" name="jquery-tagbox-materials" id="jquery-tagbox-materials" class="jQTagBox" style="display: block;">
						</div>
					</div>
					<div class="col-md-1 col-sm-3"><?php /* <p id ="material_left_count"><?php if($this->lang->line('shop_lefttag') != '') { echo stripslashes($this->lang->line('shop_lefttag')); } else echo '13 left '; ?></p> */ ?></div>
					<div class="col-sm-3 display-ntng"></div>
				</div>
				<!--<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Occasions</label>
					<div class="col-sm-6">
						<select>
							<option>None</option> 
							<option>BirthDay</option> 
							<option>Canada Day</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Styles</label>
					<div class="col-sm-3">
						<select>
							<option>None</option> 
							<option>Abstract</option> 
							<option>Asian</option>
						</select>
					</div>
					<div class="col-sm-3">
						<select>
							<option>None</option> 
							<option>Abstract</option> 
							<option>Asian</option>
						</select> 
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Recipient</label>
					<div class="col-sm-6">
						<select>
							<option>None</option> 
							<option>BirthDay</option> 
							<option>Canada Day</option>
						</select>
					</div>
				</div>-->
			 </div>
			 <input type="hidden" value="" id="edit_product_id" />
			 <div class="col-lg-12 sh_border1">
				 <div class="shop_details">
					<input type="submit" value="<?php if($this->lang->line('lg_publish') != '') { echo stripslashes($this->lang->line('lg_publish')); } else echo 'Publish'; ?>" class="save_btn" id="save_b"  />   
					<div style="display:none;background: #fcf3ed !important;" class="list_div" id="errMsg">         
						<p style="color: #a80308 !important;"><?php if($this->lang->line('shop_followingproblems') != '') { echo stripslashes($this->lang->line('shop_followingproblems')); } else echo 'Wait! You need to fix the following problems with your item'; ?>: </p>         
						<span id="err_blocks" style="color:#003399 !important;"></span>     
					</div>
				</div> 
			</div>
			</form>			
		</div>
	</div>
</div>
<script>
$(function($) {
				$('.time').timepicker({
                    'showDuration': true,
                    'timeFormat': 'g:ia',
					 minDate: 0,
					 'disableTimeRanges':  [['<?php echo $GetAllExtrasCharge[0]->time_frame_from; ?>', '<?php echo $GetAllExtrasCharge[0]->time_frame_to; ?>']]

                });				
						var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
				$('.date').datepicker({				
                    'format': 'm/d/yyyy',
                    'autoclose': true,
					 minDate: 0,
						 startDate: today 
					
                });

  });

function delete_image(file,img){
	$("#"+file).val('');
	$("#"+img).hide();
}

	$( ".datepicker" ).datepicker({ 
		dateFormat: "yy-mm-dd" ,
		changeYear: true,
		changeMonth: true,
		autoclose: true,
		startDate: new Date(),
		onClose: function(selectedDate) {
	        $(".datepicker2").datepicker("option", "minDate", selectedDate);
	    }
	}).on('changeDate', function (e) {
        $('.datepicker2').datepicker({ autoclose: true}).datepicker('setStartDate', e.date).focus();
	});
	$( ".datepicker2" ).datepicker({ 
		dateFormat: "yy-mm-dd" ,
		changeYear: true,
		changeMonth: true,
		startDate: new Date()
	});  
</script>
<!--<script  type="text/javascript" src="js/custom-scripts.js"></script>-->
<script>
function changeleftvalue(evt,count,type){
var count = 13 - (parseInt (count));
//$(evt).parents().parents().find('#leftcount').html( count+ " left");
if(type == 'jquery-tagbox-tags'){
$('#leftcount').html( count+ " left")
}else{
$("#material_left_count").html( count+ " left");
}

}
</script>
<script>
function testscript(){
alert('l');
}
$(document).ready(function(){
    $('i[data-toggle="tooltip"]').hover(function(){ $(this).tooltip('show'); },function(){ $(this).tooltip('destroy'); });
});

</script>

<?php $this->load->view('site/templates/footer');?>