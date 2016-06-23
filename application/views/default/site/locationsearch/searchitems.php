<?php $this->load->view('site/templates/header'); ?>
<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&amp;sensor=false"></script>
<section>
<div class="add_steps shop-menu-list">
	<div class="main">
		<ul>
			<li class="event-icon"><a href="view-local-events"><?php echo af_lg('lg_view_localevents','View Local Events');?></a></li>
			<li class="location-icon"><a href="shop-by-location"><?php echo af_lg('lg_shop_by_location','Shop by location');?></a></li>
			<li class="items-icon"><a href="shop-by-items"><?php echo af_lg('lg_shop_by_items','Shop by items');?></a></li>
		</ul>
	</div>
</div>
<div id="loading" style="left: 463px; position: fixed; z-index: 111;"></div>
<div class="col-lg-12 search-location" id="profile_div">
	<div class="col-lg-3 search-location-left">
		<div class="col-lg-12">
			<input type="text" class="form-control " placeholder="<?php echo af_lg('lg_enter your addr','Enter your address');?>" id="autocomplete" name="task_location">
		</div>
		<!--<div class="col-lg-12 margin-top-15">
			<select id="main-subCat" onchange="changeFilter(this);" style="height:30px;">
				<option value=""><?php echo af_lg('lg_filter_by_categ','Filter by Category');?></option>
				<?php if($categories->num_rows()>0){?>
					<?php foreach($categories->result() as $_categories){?>
						<option value="<?php echo $_categories->id;?>"><?php echo $_categories->cat_name;?></option>
					<?php }?>
				<?php }?>
			</select>
			<div id="app-subcat" style="margin-top:10px;"></div>
		</div>-->
		<div class="col-lg-12 margin-top-15">
			<p><?php echo af_lg('lg_itemlist','Item List');?></p>
		</div>
		<div id="side_bar" class="col-lg-12 margin-top-15 overflow">
			
		</div>
	</div>
	<div class="col-lg-9 map-box">
		<div id="map-container">
			<div id="map"></div>
		</div>
	</div>
</div>
</section>
<script type="text/javascript"> 
//////////// Declare the Global Variables///////////////
var purl = '<?php echo base_url()?>site/locationsearch/filteritems';
var gurl = '<?php echo base_url()?>site/locationsearch/getitems';
var componentForm = {
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name'
};
var iconBase = '<?php echo base_url()?>images/map-locator.png';  
var side_bar_html = "";
var gmarkers = []; 
var map = null;
var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var d = new Date();
///////////End///////////////////
///////////Marker///////////////
function createMarker(product){
	var totalLength = product.length;
	if(totalLength > 0){
		jQuery.each(product, function(i, item){
			var point = new google.maps.LatLng(item.latitude,item.longitude);
			if(item.image!=''){
			var images = item.image;
			var imgArr = images.split(",");
			var image = imgArr[0];
			}else{
				var image = 'no-image.png';
			}
			var titleText = item.product_name;
			var price = item.base_price;
			var sellername = item.user_name;
			var banner = '<?php echo base_url() ?>images/product/'+image;
			if (titleText == '') {
			  titleText = 'No title';
			}
			var url = '<?php echo base_url() ?>products/'+item.seourl;
			var fileurl = '<?php echo base_url() ?>images/product/'+image;
			var html = '<div class="info"><h3>'+titleText+'</h3><div class="info-body">'+'<a href="'+ url+'" target="_blank"><img src="'+fileurl+'" class="info-img"/></a></div>';
			var contentString = html;
			var marker = new google.maps.Marker({
				animation: google.maps.Animation.DROP,
				position: point,
				map: map,
				icon: iconBase,
				title: titleText,
				zIndex: 1
			});
			google.maps.event.addListener(map, 'idle', function(event) {   
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.setContent(contentString); 
				infowindow.open(map,marker);
			});
			gmarkers.push(marker);
			side_bar_html += '<a href="javascript: myclick(' + (gmarkers.length - 1) + ')"><div class="col-lg-12 padding" ><div class="col-lg-12 cart"><img src="'+banner+'" width="100%" height="116px"/><h6 style="font-weight:bold; margin-bottom:6px;">'+titleText+'</h6><p style="font-size: 12px;">'+sellername+'<span style="float:right;"><?php echo $currencySymbol;?>'+price+'</span></p></div></div></a>';
		});	
		$("#side_bar").html(side_bar_html);
	}else{ 
		$("#side_bar").html('<span><?php echo af_lg('lg_no products are found','No Products are found.....');?></span>');
	}
	side_bar_html = "";
}
///////////End///////////////////
///////Sidebar Click ///////////
function myclick(i){
  google.maps.event.trigger(gmarkers[i], "click");
}
///////////End///////////////////
jQuery('#loading').html('<img src="<?php echo base_url()?>images/loading-map.gif">');
jQuery.get(gurl,function(json){
	initialize(json.address);
	createMarker(json.product);
	jQuery('#loading').html('');
},"json");

function initialize(address, Zoomval, cLat, cLong){
	if(typeof Zoomval != 'undefined'){
		var Zoomval = parseInt(Zoomval);
	}else{
		var Zoomval = 5;
	} 
	var output = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='+address+'&sensor=false');
	var obj = jQuery.parseJSON(output);
	if(obj.status =='OK'){
		var latitude = obj.results[0].geometry.location.lat;
		var longitude = obj.results[0].geometry.location.lng;
		
		if(typeof cLat !='undefined'){
			var latv = cLat;
		}else{
			var latv = latitude;
		}
		if(typeof cLong !='undefined'){
			var lngv = cLong;
		}else{
			var lngv = longitude;
		} ;
		var myOptions = {
			zoom: Zoomval,
			zoomControl:true,
			zoomControlOptions: {
				style:google.maps.ZoomControlStyle.SMALL
			},
			center: new google.maps.LatLng(latv,lngv),
			mapTypeControl: true,
			mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
			navigationControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById("map"),myOptions);
		google.maps.event.addListener(map, 'click', function() {infowindow.close();});
		google.maps.event.addListener(map,'zoom_changed',function() {
			var zoom = map.getZoom();
			var bounds = map.getBounds();
			zoomChanged(bounds,zoom);
		}); 
		google.maps.event.addListener(map,'dragend',function(){
			var zoom = map.getZoom();
			var bounds = map.getBounds();
			zoomChanged(bounds,zoom);
		});
	}
}

var infowindow = new google.maps.InfoWindow({ 
    size: new google.maps.Size(150,50)
});

function locationAddress(){
	autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')),{ types: ['geocode'] });
	google.maps.event.addListener(autocomplete, 'place_changed', function(){
		var place = autocomplete.getPlace();
		var address = '';
		for (var i = 0; i < place.address_components.length; i++) {
			var addressType = place.address_components[i].types[0];
			if(componentForm[addressType]) {
				var val = place.address_components[i][componentForm[addressType]];
				address += val+',';
			}
		}
		var filter = jQuery('.filter-date option:selected').val();
		jQuery('#loading').html('<img src="<?php echo base_url()?>images/loading-map.gif">');
		jQuery.post(purl,{'address':address,'filter':filter},function(json){	
			initialize(json.address);
			createMarker(json.product);
			jQuery('#loading').html('');
		},"json");
	}); 
}
function changeFilter(evt){
	var filter = evt.value;
	var curl = '<?php echo base_url()?>site/locationsearch/getSubCat';
	jQuery.post(curl,{'cid':filter},function(json){
		if(json.subCat!=0){
			jQuery('#app-subcat').append(json.subCat);
		}else{
			jQuery('#app-subcat').html('');
		}	
	},"json");
} 
function changesubFilter(evt){
	var filter = evt.value;
	jQuery(evt).next().remove();
	var address = jQuery('#autocomplete').val();
	var zoom = map.getZoom();
	var bounds = map.getBounds();
	var minLat = bounds.getSouthWest().lat();
	var minLong = bounds.getSouthWest().lng();
	var maxLat = bounds.getNorthEast().lat();
	var maxLong = bounds.getNorthEast().lng();
	var cLat = bounds.getCenter().lat(); 
	var cLong = bounds.getCenter().lng();
	jQuery('#loading').html('<img src="<?php echo base_url()?>images/loading-map.gif">');
	jQuery.post(purl,{'minLat':minLat,'minLong':minLong,'maxLat':maxLat,'maxLong':maxLong,'address':address,'filter':filter,'zoom':zoom,'cLat':cLat,'cLong':cLong},function(json){
		initialize(json.address, json.zoomValue, cLat, cLong);
		createMarker(json.product);
		var curl = '<?php echo base_url()?>site/locationsearch/getSubCat';
		jQuery.post(curl,{'cid':filter},function(json){
			if(json.subCat!=0){
				jQuery('#app-subcat').append(json.subCat);
			}
			jQuery('#loading').html('');
		},"json");
	},"json")
}

function zoomChanged(bounds,zoom){
	var filter = jQuery('.filter-date option:selected').val();
	var address = jQuery('#autocomplete').val();
	
	var minLat = bounds.getSouthWest().lat();
	var minLong = bounds.getSouthWest().lng();
	var maxLat = bounds.getNorthEast().lat();
	var maxLong = bounds.getNorthEast().lng();

	var cLat = bounds.getCenter().lat(); 
	var cLong = bounds.getCenter().lng();  
	var zcurl = '<?php echo base_url()?>site/locationsearch/ZoomChangeditems';
	jQuery.post(zcurl,{'minLat':minLat,'minLong':minLong,'maxLat':maxLat,'maxLong':maxLong,'address':address,'zoom':zoom,'cLat':cLat,'cLong':cLong},function(json){
		/* google.maps.event.addListener(map, "idle", function() {
			var sw = new google.maps.LatLng(minLat, minLong);
			var ne = new google.maps.LatLng(maxLat, maxLong);
			var bounds = new google.maps.LatLngBounds(sw, ne);
			map.fitBounds(bounds);
		}); */
		setAllMap(null);
		gmarkers = [];
		createMarker(json.product);
	},"json")
} 
function setAllMap(map) {
  for (var i = 0; i < gmarkers.length; i++) {
    gmarkers[i].setMap(map);
  }
}
function file_get_contents(url) {
	var xmlhttp = null;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	if (xmlhttp == null) throw new Error('XMLHttpRequest not supported');
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	return xmlhttp.responseText;
} 
google.maps.event.addDomListener(window, 'load', initialize);    
google.maps.event.addDomListener(window, 'load', locationAddress);
</script> 
<link rel="stylesheet" href="css/default/locationsearch.css"/>
<?php $this->load->view('site/templates/footer'); ?>