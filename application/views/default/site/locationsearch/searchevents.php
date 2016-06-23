<?php $this->load->view('site/templates/header'); ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&amp;sensor=false"></script>
<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
<section>
<div class="col-lg-12 add_steps shop-menu-list">
	<div class="main">
		<ul>
			<li>
				<a href="view-local-events">
					<?php echo af_lg('lg_view_localevents','View Local Events');?>
				</a>
			</li>
			<li>
				<a href="shop-by-location">
				<?php echo af_lg('lg_shop_by_location','Shop by location');?>
				</a>
			</li>
			<li>
				<a href="shop-by-items">
				<?php echo af_lg('lg_shop_by_items','Shop by items');?>
				</a>
			</li>
		</ul>
	</div>
</div>
<div id="loading" style="left: 463px; position: fixed; z-index: 111;"></div>
<div class="col-lg-12 margin-top-15" id="profile_div">
	<div class="col-lg-3">
		<div class="col-lg-12">
			<input type="text" class="form-control " placeholder="<?php echo af_lg('lg_enter your addr','Enter your address');?>" id="autocomplete" name="task_location">
		</div>
		<div class="col-lg-12 margin-top-15">
			<select class="filter-date" name="filter-date" onchange="filterdate(this);">
				<option value=""  style="padding:7px;"><?php echo af_lg('lg_filter by date','Filter by Date');?></option>
				<option value="today"><?php echo af_lg('lg_today','Today');?></option>
				<option value="week"><?php echo af_lg('lg_this week','This Week');?></option>
				<option value="cmonth"><?php echo af_lg('lg_this month','This Month');?></option>
				<option value="nmonth"><?php echo af_lg('lg_next month','Next Month');?></option>
				<option value="year"><?php echo af_lg('lg_this year','This Year');?></option>
			</select>
		</div>
		<div class="col-lg-12 margin-top-15">
			<p><?php echo af_lg('lg_events list','Events List');?></p>
			<div id="side_bar" class="col-lg-12 margin-top-15 overflow">
			</div>
		</div>
	</div>
	<div class="col-lg-9">
		<div id="map-container">
			<div id="map"></div>
		</div>
	</div>
</div>
</section>
<script type="text/javascript"> 
//////////// Declare the Global Variables///////////////
var purl = '<?php echo base_url()?>site/locationsearch/filterevents';
var gurl = '<?php echo base_url()?>site/locationsearch/getevents';
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
function createMarker(events){
	var totalLength = events.length;
	if(totalLength > 0){
		jQuery.each(events, function(i, item){
			var point = new google.maps.LatLng(item.latitude,item.longitude);
			var titleText = item.eventTitle;
			if(titleText == '') {
				titleText = 'No title';
			}
			var url = '<?php echo base_url() ?>events';
			if(item.imagePath!=''){
				var fileurl = '<img width= "100%" height= "95px" src="<?php echo base_url()?>images/community/events/'+item.imagePath+'"/>';
			}else{
				var fileurl ='';
			}
			
			var html = '<div class="info"><h3>' + titleText +
			  '</h3><div class="info-body">' +
			  '<a href="' + url + '" target="_blank"><img src="' +
			  fileurl + '" class="info-img"/></a></div><br/>';
			if(fileurl ==''){
				var html = '<div style="border:none;" class="info"><h3><a href="'+url+'" target="_blank">'+titleText+'</a></h3>'+'<span><b>Location: </b>'+item.eventLocation+'</span></div>';
			}else{
				var html = '<div style="border:none;" class="info"><h3><a href="'+url+'" target="_blank">'+titleText+'</a></h3><div class="info-body">'+'<a href="'+url+'" target="_blank">'+fileurl+'</a><span><b>Location: </b>'+item.eventLocation+'</span></div>';
			}
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
			side_bar_html += '<a href="javascript: myclick(' + (gmarkers.length - 1) + ')">' + '<div class="col-lg-12 padding"><h5>'+titleText+'</h5><div class="col-lg-6" style="width:100%;">'+fileurl+'</div><div class="col-lg-6 cart" style="margin-top:23px; width:100%;"><p style="float:left; width:50%;font-size: 11px;"> Time: '+item.eventstartTime+' - '+item.eventendTime+'</p><div class="color"><p style="font-size:13px; color:#000; padding:5px;">'+monthNames[d.getMonth(item.eventDate)]+' '+d.getDate(item.eventDate)+'</p></div></div></div>' + '<\/a>';
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
	createMarker(json.events);
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
			createMarker(json.events);
			jQuery('#loading').html('');
		},"json");
	}); 
}
function filterdate(evt){
	var filter = evt.value;
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
		createMarker(json.events);
		jQuery(evt).val(filter);
		jQuery('#loading').html('');
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
	var zcurl = '<?php echo base_url()?>site/locationsearch/ZoomChangedevents';
	jQuery.post(zcurl,{'minLat':minLat,'minLong':minLong,'maxLat':maxLat,'maxLong':maxLong,'address':address,'filter':filter,'zoom':zoom,'cLat':cLat,'cLong':cLong},function(json){
		/* google.maps.event.addListener(map, "idle", function() {
			var sw = new google.maps.LatLng(minLat, minLong);
			var ne = new google.maps.LatLng(maxLat, maxLong);
			var bounds = new google.maps.LatLngBounds(sw, ne);
			map.fitBounds(bounds);

		}); */
		setAllMap(null);
		gmarkers = [];
		createMarker(json.events);
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