<section class="second-bl third-bl foot-bg">
	<footer class="container">
		<?php
// adding chinese footer translations Kethen was here 25/1/2016
if ($this->_ci_cached_vars["languageCode"] == "en") {
    ?>
		<div class="row">
			<div>
				<img src="./images/artfill_logo_footer.png">
			</div>
			<div class="col-md-6  footer-block">
				<ul class="footer-list">
					<li><a href="pages/about-us">關於我們</a></li>
					<li><a href="company">公司資料</a></li>
					<li><a href="shop/sell">商店加盟</a></li>
					<li><a href="terms">使用條款</a></li>
					<li><a href="privacy">Privacy Policy</a></li>
					<li><a href="reflection">Feedback to Us</a></li>
				</ul>
			</div>
			<div class="col-md-6 col-xs-6 col-sm-6 footer-block">
				<ul class="footer-list">
					<li>Payment Method</li>
					<img style="background-size:cover;" src="./images/paymentmethod.png" />
				</ul>
			</div>
			<?php
} else if ($this->_ci_cached_vars["languageCode"] == "zh_HK") {
    ?>
			<div class="row">
				<div>
					<img src="./images/artfill_logo_footer_transparent.png">
				</div>
				<div class="col-md-6 footer-block">
					<?php if ($shopProduc == 0) {
        ?>
					<!--<span class="footer-head no-ul"><?php if ($this->lang->line('footer_business') != '') {echo stripslashes($this->lang->line('footer_business'));} else {
            echo '';
        }
        ?></span>-->
					<!--<a href="shop/sell"><div class="search-bt col-md-6 col-xs-4 op-bt"><?php if ($this->lang->line('footer_open_a_shop') != '') {echo stripslashes($this->lang->line('footer_open_a_shop'));} else {
            echo 'Open a Shop';
        }
        ?></div></a>-->
					<?php }?>
					<!--<span class="footer-head"><?php if ($this->lang->line('footer_sell_on') != '') {echo stripslashes($this->lang->line('footer_sell_on'));} else {
        echo 'Sell on';
    }
    ?> <?php echo $this->config->item('email_title'); ?></span>-->
					<!--<ul class="footer-list">-->
					<!--<li><a href="find/shop"><?php if ($this->lang->line('footer_browse_all_shops') != '') {echo stripslashes($this->lang->line('footer_browse_all_shops'));} else {
        echo 'Browse all shops';
    }
    ?></a></li>
					<li><a href="shop-by-location"><?php if ($this->lang->line('footer_search_shops') != '') {echo stripslashes($this->lang->line('footer_search_shops'));} else {
        echo 'Search by Location';
    }
    ?></a></li>-->
					<!--<li><a href="" > 購物指南</li>
					<li><a href="" > 商品評價排行榜</li>
					<li><a href="" > 全場商品分類</li>
					<li><a href="" > 商品列表</li>
					<li><a href="" > 購買特集</li>-->
				<!--</ul>
			</div>-->
			<div class="col-md-4  footer-block">
				<ul class="footer-list">
					<li><a href="pages/about-us">關於我們</a></li>
					<li><a href="company">公司資料</a></li>
					<li><a href="shop/sell">商店加盟</a></li>
					<li><a href="terms">使用條款</a></li>
					<li><a href="privacy">私隱政策</a></li>
					<li><a href="reflection">意見諮詢</a></li>
				</ul>
			</div>
		</div>
		<div class="col-md-6 col-xs-6 col-sm-6 footer-block">
			<ul class="footer-list">
				<li>付款方式</li>
				<img style="background-size:cover;" src="./images/paymentmethod.png" />
			</ul>
		</div>
		<?php
}
?>
		<!--</div>-->
		<!--<div class="footer-row">-->
		<!--
		<div id="google_translate_element"></div><script type="text/javascript">
			function googleTranslateElementInit() {
			new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ml,ta,zh-CN', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
			}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		<style>
		.goog-te-banner-frame.skiptranslate {display: none !important;}
		body { top: 0px !important; }
		</style>
		-->
		<!--<ul class="locale-settings">-->
		<!--<li><a href="javascript:void(0);"> <i class="fa fa-globe"></i><?php echo $regionName; ?></a></li>-->
		<!--<li><a data-toggle="modal" id="language_href" href="#Language" onclick="javascript:$('#languageTab').trigger('click');">  <?php echo $languageName; ?></a></li>
		<li><a data-toggle="modal" id="currency_href" href="#Language" onclick="javascript:$('#currencyTab').trigger('click');"> <?php echo $currencySymbol; ?> <?php echo $currencyType; ?></a></li>
	</ul>
	<a href="pages/help"><div class="help-bt"><?php if ($this->lang->line('footer_help') != '') {echo stripslashes($this->lang->line('footer_help'));} else {
    echo 'Help';
}
?></div></a>
</div>
<ul class="bt-menu">
	<li id="copy"> <?php echo stripslashes($this->config->item('footer_content')); ?></li>
	<li><a href="pages/privacy-policy"><?php if ($this->lang->line('user_privacy_policy') != '') {echo stripslashes($this->lang->line('user_privacy_policy'));} else {
    echo 'Privacy';
}
?></a></li>
</ul>
-->
</div>
<br/>
<div class="row">
<div class="col-md-6 col-xs-6 col-sm-6 footer-block">
	<?php
if ($this->_ci_cached_vars["languageCode"] == "en") {
    ?>
	<span style="color:#8bdad4;">Contact Us</span> &emsp;
	<?php
} elseif ($this->_ci_cached_vars["languageCode"] == "zh_HK") {
    ?>
	<span style="color:#8bdad4;">聯絡我們</span> &emsp;
	<?php }?>
	<a href="https://www.facebook.com/artfillco/"><img style="width:30px;"src="./images/Facebook-64.png"/></a> &emsp;
	<a href="https://www.instagram.com/artfill.hk/"><img style="width:30px;" src="./images/Instagram-64.png"/></a> &emsp;
	<img style="width:30px;" src="./images/Youtube-64.png"/>
</div>
</div>
</footer>
<!--<hr style="background-color: #66f4cf"/>-->
<div class="container">
<div class="row">
<div class="col-md-12">
	2016 Artfill.Co. All Rights Reserved
</div>
</div>
</div>
</section>
<!-- Geo Start -->
<?php /* if($GeoLocationVal==''){
$this->load->view('site/templates/geo_popup');
} $this->load->view('site/templates/geo_popup'); */?>
<div class="language-setting" style="display:none;">
<div class="main" id="content_geo">
<div style="text-align:left" class="regional-setting-left">
<h5><?php if ($this->lang->line('lg_preferences_saved') != '') {echo stripslashes($this->lang->line('lg_preferences_saved'));} else {
    echo "Your preferences have been saved. You can always update these regional and currency settings later at the bottom of any page.";
}
?>.</h5>
<h3><?php if ($this->lang->line('lg_preferences_reload') != '') {echo stripslashes($this->lang->line('lg_preferences_reload'));} else {
    echo "Your Changes can be seen on Reload.";
}
?></h3>
</div>
<div class="regional-setting-right">
<input class="ok-button"  onclick="getReloadVal(1);" value="<?php if ($this->lang->line('lg_reload') != '') {echo stripslashes($this->lang->line('lg_reload'));} else {
    echo "Reload";
}
?>" type="button">
<input class="canceling-button3" onClick="getReloadVal(2);" value="<?php if ($this->lang->line('land_nothanks') != '') {echo stripslashes($this->lang->line('land_nothanks'));} else {
    echo "No thanks";
}
?>" type="button">
</div>
</div>
</div>
<script>
function getReloadVal(val)
{
	if(val == '1'){
		window.location.reload();
	}else{
		setTimeout(function() {
		$('.language-setting').fadeOut('fast');
		}, 1000);
	}
}
</script>
<!-- Geo End -->
<!-- <script src="js/front/bootstrap-rating-input.min.js"></script>  -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<a href="#ownShopFavAlertCommon" id="alert_ownshopfav" data-toggle="modal"></a>
<div id='ownShopFavAlertCommon' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div style='background:#fff;'>
	<div class="conversation" style="width: 54%; margin-left: 191px; margin-top: 171px;">
		<div class="conversation_container">
			<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;"> Whoa! You can't favourite own item. </h2>
			<div class="modal-footer footer_tab_footer">
				<div class="btn-group">
					<a class="btn btn-default submit_btn" data-dismiss="modal">Okay</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
<a href="#ownProdFavAlertCommon" id="ownProdFavAlertCommonlink" data-toggle="modal"></a>
<div id='ownProdFavAlertCommon' class="modal language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div style='background:#fff;'>
	<div class="conversation" style="width: 54%; margin-left: 191px; margin-top: 171px;">
		<div class="conversation_container">
			<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;"> Whoa! You can't favourite own item. </h2>
			<div class="modal-footer footer_tab_footer">
				<div class="btn-group">
					<a class="btn btn-default submit_btn" data-dismiss="modal">Okay</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
<!-- Sign In Popup -->
<?php $this->load->view('site/templates/login_popup');?>
<!-- Language Popup -->
<?php $this->load->view('site/templates/lang_popup');?>
<script>
$(document).ready(function(e) {
	if($(window).width()<465){
		//For footer
		$('.footer-block .footer-head').click(function(){
			if($(this).hasClass('no-ul')){
				if($(this).next().css('display')=='none'){
					$('.footer-block ul.footer-list').slideUp();
					$(this).next().slideDown();
				}else{
					$('.footer-block .footer-head.no-ul').next().slideUp();
				}
			}else{
				if($(this).parent().find('ul.footer-list').css('display')=='none'){
					$('.footer-block ul.footer-list').slideUp();
					$(this).parent().find('ul.footer-list').slideDown();
					$('.footer-block .footer-head.no-ul').next().slideUp();
				}else{
					$('.footer-block ul.footer-list').slideUp();
				}
			}
		});
	}
$('.currencyLi').each(function() {
$(this).click(function(e) {
		$('.currencyLi').removeClass('currencyactive');
		var curId=$(this).attr('id');
		$('#'+curId).addClass('currencyactive');
		var changeVal=$('#cur'+curId).val();
		$('#selectedCurrency').html(changeVal);
		$('#currency').val(curId);// alert(changeVal);
	});
});
	$('.languageLi').each(function() {
$(this).click(function(e) {
		$('.languageLi').removeClass('currencyactive');
		var langId=$(this).attr('id');
		$('#'+langId).addClass('currencyactive');
		var changeVal=$('#'+langId).data('name');
		$('#selectedLanguage').html(changeVal);
		$('#language').val(langId);
	});
});
/*$('#region').change(function(e) {
	if($('#region').val())
	alert($('#region').val());
	$('#selectedReligion').html($('#region').val());
});*/
$('#footerPopCancel').click(function(e) {
$('#cboxClose').trigger('click');
});
	if(currUrls == 'shop'){
		$('body').attr('class','');
	}
});
function activeCurrency(){
$('#currencyTab').trigger('click');
}
function activeLanguage(){
//$('#languageTab').addClass('TabbedPanelsTabSelected');
$('#languageTab').trigger('click');
}
</script>
<script src="js/site/ttmenu.js"></script>
<?php if ($this->uri->segment(1) == 'search') {?>
<link rel="stylesheet" type="text/css" href="a_data/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/default/site/themes-smoothness-jquery-ui.css" />
<script type="text/javascript" src="a_data/jquery.js"></script>
<script type="text/javascript" src="a_data/jquery-ui.js"></script>
<script type="text/javascript" src="js/currency/jquery.formatCurrency-1.4.0.js"></script>
<?php /*?>
<script>
$(window).load(function(){
$(function () {
var minPrice =  <?php echo $min_base_price;?>,
maxPrice = <?php echo $max_base_price;?>,
$filter_lists = $("#filters ul"),
$filter_checkboxes = $("#filters :checkbox"),
$items = $("#container li.element");
//$filter_checkboxes.click(filterSystem);
$('#slider-container').slider({
range: true,
min: minPrice,
max: maxPrice,
<?php if($minVal != '' && $maxVal !=''){?>
values: [<?php echo $minVal;?>, <?php echo $maxVal;?>],
<?php } else {?>
values: [minPrice, maxPrice],
<?php } ?>
slide: function (event, ui) {
//alert(event);
//alert(ui);
//$("#amount").val("<?php echo $currencySymbol ?>" + ui.values[0] + " - <?php echo $currencySymbol ?>" + ui.values[1]);
var minPriceDisp = Number('<?php echo $currencyValue; ?>')*(Number(ui.values[0]));
var maxPriceDisp = Number('<?php echo $currencyValue; ?>')*(Number(ui.values[1]));
$("#minPriceVal").val(ui.values[0]);
$("#maxPriceVal").val(ui.values[1]);
$("#minPriceDisp").html(minPriceDisp);
$("#maxPriceDisp").html(maxPriceDisp);
$('#minPriceDisp').formatCurrency();
$('#maxPriceDisp').formatCurrency();
minPrice = ui.values[0];
maxPrice = ui.values[1];
$('#slider-container').mouseout(function(){
$('#priceFilterForm').submit();
});
// filterSystem();
}
});
// $("#amount").val("<?php echo $currencySymbol ?>"+minPrice + " - <?php echo $currencySymbol ?>"+ maxPrice);
$("#minPriceVal").val(minPrice);
$("#maxPriceVal").val(maxPrice);
$("#minPriceDisp").html(ui.values[0]);
$("#maxPriceDisp").html(ui.values[1]);
$('#minPriceDisp').formatCurrency();
$('#maxPriceDisp').formatCurrency();
});
});
</script>
<?php */?>
<script>
var $j = jQuery.noConflict();
$j(window).load(function(){
$j(function () {
var minPrice =  <?php echo $min_base_price; ?>,
maxPrice = <?php echo $max_base_price; ?>,
$jfilter_lists = $j("#filters ul"),
$jfilter_checkboxes = $j("#filters :checkbox"),
$jitems = $j("#container li.element");
//$filter_checkboxes.click(filterSystem);
$j('#slider-container').slider({
range: true,
min: minPrice,
max: maxPrice,
<?php if ($minVal != '' && $maxVal != '') {?>
values: [<?php echo $minVal; ?>, <?php echo $maxVal; ?>],
<?php } else {?>
values: [minPrice, maxPrice],
<?php }?>
slide: function (event, ui) {
//alert(minVal);
//$("#amount").val("<?php echo $currencySymbol ?>" + ui.values[0] + " - <?php echo $currencySymbol ?>" + ui.values[1]);
$j("#minPriceVal").val(ui.values[0]);
$j("#maxPriceVal").val(ui.values[1]);
$j("#minPriceDisp").html(ui.values[0]);
$j("#maxPriceDisp").html(ui.values[1]);
minPrice = ui.values[0];
maxPrice = ui.values[1];
$j('#slider-container').mouseout(function(){
$j('#priceFilterForm').submit();
});
// filterSystem();
}
});
// $("#amount").val("<?php echo $currencySymbol ?>"+minPrice + " - <?php echo $currencySymbol ?>"+ maxPrice);
$j("#minPriceVal").val(minPrice);
$j("#maxPriceVal").val(maxPrice);
$("#minPriceDisp").html(ui.values[0]);
$("#maxPriceDisp").html(ui.values[1]);
});
});
</script>
<script type="text/javascript">if (window.location.protocol != "https:")
window.location.href = "https:" + window.location.href.substring(window.location.protocol.length);</script>
<?php }?>
</body>
</html>