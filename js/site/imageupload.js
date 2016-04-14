function upload_product(evt){
	
	//alert(evt);
	var $submit = $(evt),file,filename,extension;
	if(($submit).hasClass('uploading'))return;
	$submit.addClass('uploading').val('Uploading...').css({'opacity':'0.5','cursor': 'wait'});
	file = document.getElementById('upload_product_img').files[0];
	if(!file){
		alert('Please select a file to upload');
		$submit.removeClass('uploading').val('Upload').css({'opacity':'1','cursor': 'pointer'});
		return false;
	}
	if(!/([^\\\/]+\.(jpe?g|png|gif))$/i.test(file.name||file.filename)){
		alert('The image must be in one of the following formats: .jpeg, .jpg, .gif or .png.');
		$submit.removeClass('uploading').val('Upload').css({'opacity':'1','cursor': 'pointer'});
		return false;
	}
	filename  = RegExp.$1;
	extension = RegExp.$2;
	if(!window.FileReader || !window.XMLHttpRequest) {
		var null_counter = 0, completed = false;
		window._upload_image_callback = function(json){ completed = true; upload_complete(json) };
	}
	
	var reader = new FileReader(), xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(e){
		if(xhr.readyState !== 4) return;
		if(xhr.status === 200){
			// success
			var data = xhr.responseText, json;
			try {
				if(window.JSON) json = window.JSON.parse(data);
			} catch(e){
				try { json = new Function('return '+data)(); } catch(ee){ json = null };
			}
			upload_complete(json);
		}
	};
	xhr.open('POST', baseURL+'site/shop/upload_product_image_banner?filename='+filename, true);
	xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	xhr.setRequestHeader('X-Filename', filename);
// xhr.send(file);

	var formData = new FormData();
	formData.append("thefile", file);
	xhr.send(formData);
	return false;
	
}
function upload_complete(json){	
	if(!json || typeof(json.status_code) == 'undefined') return;
	if(json.status_code == 1){
		if(json.image && json.image.url){
			set_uploaded_image(json.image);
			//$('.example22').trigger('click');
		} else {
			alert('Something went wrong. Please upload again.');
		}
	}else if(json.status_code == 0){
		if(json.message) alert(json.message);
	}
	$('#upSubmit').removeClass('uploading').val('Upload').css({'opacity':'1','cursor': 'pointer'});
}
function set_uploaded_image(image_info){
	//alert(image_info.name);
	
	$('#BannerImg').html('<img src="'+image_info.url+'" width="1000" height="108" alt="Shop Banner" />');
	$('#cboxClose').trigger('click');
	
	$('#changeBannner').css('display','Block');
	
	/*var $this = $('#inline_example17 .post_product');
	$this
		.data('req_url', baseURL+'site/product/add_new_thing')
		.data('img_name', image_info.name)
		.data('fields', 'name link category note price')
		.find('#add_photo_url').val(image_info.name).end()
		.find('.controls').hide().end()
		.find('img.photo').attr('src', image_info.url).end()
		.find('.size').width('100%').html(image_info.width+' &times; '+image_info.height).end();*/
}


function json_handler(json){
	if(!json) return;
	if(json.status_code == 1){
		location.href = json.thing_url;
	} else if (json.status_code == 0 && json.message){
		alert(json.message);
	}
}

//Fetch Images From Web
function fetch_images(evt){
	var $btn=$(evt),$step=$btn.closest('.post_product'),$pg,$ind,url;
//	if($btn.hasClass('fetching')) return;
	url = $step.find('input.url_').val().trim().replace(/^https?:\/\//i,'');
	if(!url.length) return alert('Please enter a website address.');
	$btn.addClass('fetching').val('Wait...');
	if(/\.(jpe?g|png|gif)$/i.test(url)) return check(['http://'+url]);
	function check(images){
		
		var fn=[], list=[], cur=80, step=30/images.length;
		for(var i=0,c=images.length; i < c; i++) fn[i] = load(images[i],i,c);
		
		function load(src,i,c){
			var def = $.Deferred(), img = new Image();
			img.onload = function(){
				cur += step;
				if(cur > 100) cur = 100;
//				$ind.stop().animate({'width':cur+'%'},100);
				if(this.width > 99 || this.height > 99) list.push(this);
				def.resolve(this);
				set_images(list);
				$('#add_link').val('http://'+url);
				$btn.removeClass('fetching').val('Submit');
				$('.example22').trigger('click');
			};
			img.onerror = function(){ 
				def.reject(this);
				if(i==c) alert("Oops! Couldn't find any good images for the page.");
			};
			img.src = src;
			return def;
		};
/*		$.when.apply($,fn).then(function(){
			if(list.length){
				set_images(list);
				$('#add_link').val('http://'+url); 
				$('.example22').trigger('click');
			}else{
				alert("Oops! Couldn't find any good images for the page.");
			}
		});
*/	};
	$.ajax({
		type : 'get',
		url  : baseURL+'site/product/extract_image_urls?url=http://'+url,
		dataType : 'json',
		success  : function(json){
			if(!json) return;
			if(json.response){
				check(json.response);
			} else if(json.error && json.error.message){
				alert(json.error.message);
			}
		},
		complete : function(){
			$btn.removeClass('fetching').val('Submit');
		}
	});
}
function set_images(images){
	var $this=$('#inline_example17 .post_product'), title;
	if(!$.isArray(images)) images = [images];

	$this
		.data('req_url', baseURL+'site/product/add_new_thing')
		.data('fields', 'name link category note photo_url price')
		.data('index', 0)
		.data('images', images)
		.find('.controls .size').text('').end();
		set_index(0);
		if(images.length > 2) {
			$this.find('.controls').show();
		} else {
			$this.find('.controls').hide();
		}
}
function set_index(idx){
	var $this=$('#inline_example17 .post_product'),images=$this.data('images'),img;
	if(!images || idx > images.length-1 || idx < 0) return;
	$this.data('index',idx)
		.find('#add_photo_url').val(images[idx].src).end()
		.find('.size').html(images[idx].width+' &times; '+images[idx].height).end()
		.find('.cur_').text((idx+1)+' of '+images.length).end()
//		.find('.prev').disable(idx < 1).end()
//		.find('.next').disable(idx > images.length-2).end()
		.find('.photo').attr('src', images[idx].src);
}
function set_next(){
	var $this=$('#inline_example17 .post_product'),idx=$this.data('index')||0;
	if(typeof idx != 'number') idx = parseInt(idx);
	set_index(idx+1);
}
function set_prev(){
	var $this=$('#inline_example17 .post_product'),idx=$this.data('index')||0;
	if(typeof idx != 'number') idx = parseInt(idx);
	set_index(idx-1);
}




function upload_profile_product(evt){
	
	//alert(evt);
	
	var $submit = $(evt),file,filename,extension;
	if(($submit).hasClass('uploading'))return;
	$submit.addClass('uploading').val('Uploading...').css({'opacity':'0.5','cursor': 'wait'});
	file = document.getElementById('upload_profile_img').files[0];
	if(!file){
		alert('Please select a file to upload');
		$submit.removeClass('uploading').val('Upload').css({'opacity':'1','cursor': 'pointer'});
		return false;
	}
	if(!/([^\\\/]+\.(jpe?g|png|gif))$/i.test(file.name||file.filename)){
		alert('The image must be in one of the following formats: .jpeg, .jpg, .gif or .png.');
		$submit.removeClass('uploading').val('Upload').css({'opacity':'1','cursor': 'pointer'});
		return false;
	}
	filename  = RegExp.$1;
	extension = RegExp.$2;

	if(!window.FileReader || !window.XMLHttpRequest) {
		var null_counter = 0, completed = false;
		window._upload_image_callback = function(json){ completed = true; upload_complete(json) };
	}
	//alert(extension+filename);
	
	var reader = new FileReader(), xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(e){
		if(xhr.readyState !== 4) return;
		if(xhr.status === 200){
			// success
			var data = xhr.responseText, json;
			try {
				if(window.JSON) json = window.JSON.parse(data);
			} catch(e){
				try { json = new Function('return '+data)(); } catch(ee){ json = null };
			}
			upload_complete_profile(json);
		}
	};
	xhr.open('POST', baseURL+'site/shop/upload_product_image_profile?filename='+filename, true);
	xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	xhr.setRequestHeader('X-Filename', filename);
	// xhr.send(file);
	
	var formData = new FormData();
	formData.append("thefile", file);
	xhr.send(formData);
	return false;
	
}
function upload_complete_profile(json){	
	if(!json || typeof(json.status_code) == 'undefined') return;
	if(json.status_code == 1){
		if(json.image && json.image.url){
			set_uploaded_image_profile(json.image);
			//$('.example22').trigger('click');
		} else {
			alert('Something went wrong. Please upload again.');
		}
	}else if(json.status_code == 0){
		if(json.message) alert(json.message);
	}
	$('#upSubmit1').removeClass('uploading').val('Upload').css({'opacity':'1','cursor': 'pointer'});
}
function set_uploaded_image_profile(image_info){
	//alert(image_info.name);
	
	$('#userImg').html('<img src="'+image_info.url+'" width="75" alt="Profile Image" />');
	$('#cboxClose').trigger('click');
	
	$('.example21').html('Edit Profile Image');
	
	/*var $this = $('#inline_example17 .post_product');
	$this
		.data('req_url', baseURL+'site/product/add_new_thing')
		.data('img_name', image_info.name)
		.data('fields', 'name link category note price')
		.find('#add_photo_url').val(image_info.name).end()
		.find('.controls').hide().end()
		.find('img.photo').attr('src', image_info.url).end()
		.find('.size').width('100%').html(image_info.width+' &times; '+image_info.height).end();*/
}