<?php $this->load->view('site/templates/header'); ?>
<script type="text/javascript" src="js/site/jquery-1.7.1.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&amp;sensor=false"></script>
<script type="text/javascript">
  var script = '<script type="text/javascript" src="js/markerclusterer/markerclusterer';
  if (document.location.search.indexOf('packed') !== -1) {
	script += '_packed';
  }
  script += '.js"><' + '/script>';
  document.write(script);
</script>
<script type="text/javascript">
function $(element) {
  return document.getElementById(element);
}
var purl = '<?php echo base_url()?>site/locationsearch/filterevents';
function initialize(){
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
	jQuery('#loading').html('<img src="<?php echo base_url()?>images/loading-map.gif">');
	jQuery.post(purl,{'address':address},function(json){
		speedTest.init(json.country , json.events);
		jQuery('#loading').html('');
	},"json")
  }); 
}
function filterdate(evt){
	var filter = evt.value;
	var address = jQuery('#autocomplete').val();
	jQuery('#loading').html('<img src="<?php echo base_url()?>images/loading-map.gif">');
	jQuery.post(purl,{'address':address,'filter':filter},function(json){
		speedTest.init(json.country , json.events);
		jQuery(evt).val(filter);
		jQuery('#loading').html('');
	},"json")
}
var gurl = '<?php echo base_url()?>site/locationsearch/getevents';
jQuery.get(gurl,function(json){
	speedTest.init(json.country , json.events);
	jQuery('#loading').html('');
},"json");

var speedTest = {};
speedTest.map = null;
speedTest.markerClusterer = null;
speedTest.markers = [];
speedTest.infoWindow = null;

speedTest.init = function(country, events){
	jQuery('#loading').html('<img src="<?php echo base_url()?>images/loading-map.gif">');
	var addr = country;
	var output = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='+addr+'&sensor=false');
	var obj = jQuery.parseJSON(output);
	if(obj.status =='OK'){
	var latitude = obj.results[0].geometry.location.lat;
	var longitude = obj.results[0].geometry.location.lng; 

	var latlng = new google.maps.LatLng(latitude, longitude);
	var options = {
	'zoom': 5,
	'center': latlng,
	'mapTypeId': google.maps.MapTypeId.ROADMAP
	};

	speedTest.map = new google.maps.Map($('map'), options);
	speedTest.data = events;
	var useGmm = document.getElementById('usegmm');
	google.maps.event.addDomListener(useGmm, 'click', speedTest.change);

	var numMarkers = document.getElementById('nummarkers');
	google.maps.event.addDomListener(numMarkers, 'change', speedTest.change);

	speedTest.infoWindow = new google.maps.InfoWindow();

	speedTest.showMarkers();
	}
};

speedTest.showMarkers = function(){
  speedTest.markers = [];
  var type = 1;
  if($('usegmm').checked){
    type = 0;
  }
  if(speedTest.markerClusterer){
    speedTest.markerClusterer.clearMarkers();
  }
  var panel = $('markerlist');
  panel.innerHTML = '';
  var numMarkers = $('nummarkers').value;
  if(speedTest.data.length > 0){
	 jQuery.each(speedTest.data, function(i, item){
		if(item.imagePath!=''){
			var banner = '<img width= "100%" height= "95px" src="<?php echo base_url()?>images/community/events/'+item.imagePath+'"/>';
		}else{
			var banner ='';
		}
		var titleText = item.eventTitle;
		if (titleText == '') {
		  titleText = 'No title';
		}
		var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
		var d = new Date();
		var items = document.createElement('DIV');
		var title = document.createElement('A');
		title.href = '#';
		title.className = 'title';
		title.innerHTML = '<div class="col-lg-12 padding"><h5>'+titleText+'</h5><div class="col-lg-6" style="width:100%;">'+banner+'</div><div class="col-lg-6 cart" style="margin-top:23px; width:100%;"><p style="float:left; width:50%;font-size: 11px;"> Time: '+item.eventstartTime+' - '+item.eventendTime+'</p><div class="color"><p style="font-size:13px; color:#000; padding:5px;">'+monthNames[d.getMonth(item.eventDate)]+' '+d.getDate(item.eventDate)+'</p></div></div></div>';
		items.appendChild(title);
		panel.appendChild(items);
		
		var address = item.eventLocation;
		var preaddr = address.replace('+',' ');
		var outputs = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='+preaddr+'&sensor=false');
		var objs = jQuery.parseJSON(outputs);
		if(objs.status =='OK'){
		var latitudes = objs.results[0].geometry.location.lat;
		var longitudes = objs.results[0].geometry.location.lng;
		var latLng = new google.maps.LatLng(latitudes, longitudes);
		//var imageUrl = 'http://chart.apis.google.com/chart?cht=mm&chs=24x32&chco=' + 'FFFFFF,008CFF,000000&ext=.png';

		var imageUrl = '<?php echo base_url()?>images/map-locator.png';
        
		var markerImage = new google.maps.MarkerImage(imageUrl, new google.maps.Size(24, 32));
		
		var marker = new google.maps.Marker({
		  'position': latLng,
		  'icon': imageUrl
		});

		var fn = speedTest.markerClickFunction(item, banner, latLng);
		google.maps.event.addListener(marker, 'click', fn);
		google.maps.event.addDomListener(title, 'click', fn);
		speedTest.markers.push(marker);
		}
	});
	}else{
		var items = document.createElement('DIV');
		var title = document.createElement('A');
		title.href = 'javascript:void(0)';
		title.className = 'title';
		title.innerHTML = '<span><?php echo af_lg('lg_no products are found','No Products are found.....');?></span>';
		items.appendChild(title);
		panel.appendChild(items);
	}
  window.setTimeout(speedTest.time, 0);
};

speedTest.markerClickFunction = function(pic, banner, latlng) {
  return function(e) {
    e.cancelBubble = true;
    e.returnValue = false;
    if (e.stopPropagation) {
      e.stopPropagation();
      e.preventDefault();
    }
    var title = pic.eventTitle;
	var url = '<?php echo base_url() ?>events';
	var fileurl = banner;
    var infoHtml = '<div class="info"><h3>' + title +
      '</h3><div class="info-body">' +
      '<a href="' + url + '" target="_blank"><img src="' +
      fileurl + '" class="info-img"/></a></div><br/>';
	if(fileurl ==''){
		var infoHtml = '<div style="border:none;" class="info"><h3><a href="'+url+'" target="_blank">'+title+'</a></h3>'+'<span><b>Location: </b>'+pic.eventLocation+'</span></div>';
	}else{
		var infoHtml = '<div style="border:none;" class="info"><h3><a href="'+url+'" target="_blank">'+title+'</a></h3><div class="info-body">'+'<a href="'+url+'" target="_blank">'+fileurl+'</a><span><b>Location: </b>'+pic.eventLocation+'</span></div>';
	}
    speedTest.infoWindow.setContent(infoHtml);
    speedTest.infoWindow.setPosition(latlng);
    speedTest.infoWindow.open(speedTest.map);
  };
};

speedTest.clear = function() {
  $('timetaken').innerHTML = 'cleaning...';
  for (var i = 0, marker; marker = speedTest.markers[i]; i++) {
    marker.setMap(null);
  }
};

speedTest.change = function() {
  speedTest.clear();
  speedTest.showMarkers();
};

speedTest.time = function() {
  $('timetaken').innerHTML = 'timing...';
  var start = new Date();
  if ($('usegmm').checked) {
    speedTest.markerClusterer = new MarkerClusterer(speedTest.map, speedTest.markers);
  } else {
    for (var i = 0, marker; marker = speedTest.markers[i]; i++) {
      marker.setMap(speedTest.map);
    }
  }
  var end = new Date();
  $('timetaken').innerHTML = end - start;
};
var placeSearch, autocomplete;
var componentForm = {
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name'
};
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
</script>
<script type="text/javascript">      
	google.maps.event.addDomListener(window, 'load', speedTest.init);
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
<section>
<div class="col-lg-12 add_steps shop-menu-list">
	<!--<div class="col-lg-3"></div>-->
	<div class="main">
		<ul>
			<li>
				<a href="view-local-events">
					<!--<img src="images/3.png" class="img-responsive">-->
					<?php echo af_lg('lg_view_localevents','View Local Events');?>
				</a>
			</li>
			<li>
				<a href="shop-by-location">
					<!--<img src="images/5.png" class="img-responsive">-->
				<?php echo af_lg('lg_shop_by_location','Shop by location');?>
				</a>
			</li>
			<li>
				<a href="shop-by-items">
					<!--<img src="images/4.png" class="img-responsive">-->
				<?php echo af_lg('lg_shop_by_items','Shop by items');?>
				</a>
			</li>
		</ul>


	</div>
</div>
<div id="loading" style="left: 463px; position: fixed; z-index: 111;"></div>
<div class="col-lg-12 margin-top-15">
	<div class="col-lg-3">
		<div class="col-lg-12">
			<input type="text" class="form-control " placeholder="<?php echo af_lg('lg_enter your addr','Enter your address');?>" id="autocomplete" name="task_location">
			<input style="display:none;" type="checkbox" checked="checked" id="usegmm"/>
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
		<div class="col-lg-12 margin-top-15" style="padding: 3px;">
			<div class="col-lg-5" style="margin-top: 5px;"><p><?php echo af_lg('lg_show events','Show Events');?></p></div>
			<div class="col-lg-7">
				<select id="nummarkers" >
				<option value="10" style="padding:7px;">10</option>
				<option value="50" selected="selected">50</option>
				<option value="100">100</option>
				<option value="500">500</option>
				<option value="1000">1000</option>
				</select>
			</div>
		</div>
		<div class="col-lg-12 margin-top-15"><p><?php echo af_lg('lg_events list','Events List');?></p></div>
		<div id="markerlist" class="col-lg-12 margin-top-15 overflow"></div>
		<span style="display:none;">Time used: <span id="timetaken"></span> ms</span>
	</div>
	<div class="col-lg-9"><div id="map-container"><div id="map"></div></div></div>
</div>	
</section>
<link rel="stylesheet" href="css/default/locationsearch.css"/>
<?php $this->load->view('site/templates/footer'); ?>