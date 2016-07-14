<section class="second-bl third-bl foot-bg">
	<footer class="container">
	
<style>
	ul.footer-list li{
		text-align:center;
	}
	.footer-margin{
		margin:10px;
	}
</style>
	
<?php
// adding chinese footer translations Kethen was here 25/1/2016
if ($this->_ci_cached_vars["languageCode"] == "en") {
    ?>
		<div class="col-md-12 col-xs-12 col-sm-12 row" style="margin-bottom:30px;">
			<div style="text-align:center;">
				<img src="./images/artfill_logo_footer_transparent.png">
			</div>
			<div class="">
				<ul class="footer-list">
					<li class="col-md-2"><a href="pages/about-us">About Us</a></li>
					<li class="col-md-2"><a href="company">Company Information</a></li>
					<li class="col-md-2"><a href="shop/sell">Join Us</a></li>
					<li class="col-md-2"><a href="terms">Terms and Conditions</a></li>
					<li class="col-md-2"><a href="privacy">Privacy Policy</a></li>
					<li class="col-md-2"><a href="reflection">Feedback to Us</a></li>
				</ul>
			</div>
		</div>
<?php
} else if ($this->_ci_cached_vars["languageCode"] == "zh_HK") {
?>
			<div class="col-md-12 col-xs-12 col-sm-12 row" style="margin-bottom:30px;">
				<div style="text-align:center;">
					<img src="./images/artfill_logo_footer_transparent.png">
				</div>
				<div class="">
					<ul class="footer-list">
						<li class="col-md-2"><a href="pages/about-us">關於我們</a></li>
						<li class="col-md-2"><a href="pages/company-info">公司資料</a></li>
						<li class="col-md-2"><a href="shop/sell">商店加盟</a></li>
						<li class="col-md-2"><a href="pages/terms-and-conditions">使用條款</a></li>
						<li class="col-md-2"><a href="pages/privacy-policy">私隱政策</a></li>
						<li class="col-md-2"><a href="reflection">意見諮詢</a></li>
					</ul>
				</div>
			</div>
<?php
}
?>

<br/>
<div class="row">
<div class="col-md-12 col-xs-10 col-sm-10 footer-margin" style="text-align:center;">
	<?php
if ($this->_ci_cached_vars["languageCode"] == "en") {
    ?>
	<span style="color:#8bdad4;">Payment Methods</span>&emsp; 
	<?php
} elseif ($this->_ci_cached_vars["languageCode"] == "zh_HK") {
    ?>
	<span>付款方式</span>&emsp;
	<?php }?>	
	<img style="height:20px;" src="./images/paypal.png" />
	<img style="height:20px;" src="./images/visa.jpg" />
	<img style="height:20px;" src="./images/master.jpg" /> &emsp;&emsp;
	
	
	<?php
if ($this->_ci_cached_vars["languageCode"] == "en") {
    ?>
	<span style="color:#8bdad4;">Contact Us</span> &emsp;
	<?php
} elseif ($this->_ci_cached_vars["languageCode"] == "zh_HK") {
    ?>
	<span>聯絡我們</span> &emsp;
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
<div class="col-md-12" style="text-align:center;">
	2016 Artfill.Co. All Rights Reserved
</div>
</div>
</div>
</section>
<!-- Geo Start -->
<?php /* if($GeoLocationVal==''){
$this->load->view('site/templates/geo_popup');
} $this->load->view('site/templates/geo_popup'); */?>

<!--
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
</div>-->


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
<link rel="stylesheet" type="text/css" href="a_data/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/default/site/themes-smoothness-jquery-ui.css" />
<script type="text/javascript" src="a_data/jquery.js"></script>
<script type="text/javascript" src="a_data/jquery-ui.js"></script>
<script type="text/javascript" src="js/currency/jquery.formatCurrency-1.4.0.js"></script>
<script src="js/jquery.lazyload.min.js" type="text/javascript"></script>
<script>$("img.lazy").lazyload();</script>
<?php if ($this->uri->segment(1) == 'search') {?>
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
<!-- <script type="text/javascript">if (window.location.protocol != "https:")
window.location.href = "https:" + window.location.href.substring(window.location.protocol.length);</script> -->

<?php }?>
<script>
<?php if ($userActivityCount > 0) {?>
	var favicon=new Favico({
    animation:'fade'
	});
	favicon.badge(<?php echo $userActivityCount; ?>);
<?php }?>
</script>
</body>
</html>