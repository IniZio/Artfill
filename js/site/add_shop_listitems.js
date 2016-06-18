/******** add shops list items ***** limited text fields *****************/
$(document).ready(function(){

var maxChars = $("#maxtextval");
var max_length = maxChars.attr('maxlength');
if (max_length > 0) {
    maxChars.bind('keyup', function(e){
        length = new Number(maxChars.val().length);
        counter = max_length-length;
        $("#maxtext_notify").text(counter);
    });
}
});

$(document).ready(function() {
	$("#about_item").change(function() {  
		var about= document.getElementById("about_item").value;
		if(about == 1){
		$("#when_option_p").html(whn_mke);
		}
		if(about == 2){
		$("#when_option_p").html(shop_mke);
		}
		if(about == 3){
		$("#when_option_p").html(whn_made);
		}
		if(about > 0){
			$("#What_is").css("display", "block");
			$("#what_item").change(function() {
			var what= document.getElementById("what_item").value;

			if(what > 0)
			{
				$("#When_is").css("display", "block");
			}
			});
		}
    });
 });


$(document).ready(function() {
	$("#main_cat_id").change(function() {   	
		//$("#level1_sub_cat_loading").css("display", "none");
		
		$("#level1_sub_cat").val(0);
		$("#level2_sub_cat").val(0);		
		$("#level1_sub_cat_result").css("display", "none");
		$("#level2_sub_cat_result").css("display", "none");
		$(this).after('<div id="loader1" style="display:none"><img src="images/loading.gif" alt="loading subcategory" /></div>');
		//alert($("#level1_sub_cat_result").val());
		$("#level1_sub_cat_loading").css("display", "block");
		$.get('site/product/select_ajax_level1_subcategory?main_cat_id=' + $(this).val(),function(data){
			if(data == 'Nocat') {
				$("#level1_sub_cat_loading").css("display", "none");
			} else {
				$("#level1_sub_cat_loading").css("display", "none");				
				$("#level1_sub_cat_result").css("display", "block");
				$("#level1_sub_cat").html(data);
				$('#loader').slideUp(200, function() {
					$(this).remove();
				});
			}
		});	
    });
	$("#level1_sub_cat").change(function(){  
		$("#level2_sub_cat_result").val(0);	
		$("#level2_sub_cat_result").css("display", "none");
		$(this).after('<div id="loader1" style="display:none"><img src="images/loading.gif" alt="loading subcategory" /></div>');
		$("#level2_sub_cat_loading").css("display", "block");
		$.get('site/product/select_ajax_level1_subcategory?main_cat_id=' + $(this).val(), function(data) {
			if(data == 'Nocat'){
				$("#level2_sub_cat_loading").css("display", "none");
			}else{
				$("#level2_sub_cat_loading").css("display", "none");
				$("#level2_sub_cat_result").css("display", "block");
				$("#level2_sub_cat").html(data);
				$('#loader').slideUp(200, function() {
					$(this).remove();
				});
			}
		});	
	});
});
$(document).ready(function() {
$("#image_upload").change(function(e) { 
        e.preventDefault();
		$("#loadedImg").css("display", "block");	
        var formData = new FormData($(this).parents('form')[0]);
        $.ajax({
			beforeSend: function()
 		      {
      	        document.getElementById("loadedImg").src='images/loader64.gif';
  			  },
            url: 'site/product/ajax_load_images',
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function(data) {
		      	var arr = data.split('|');
				
			  	if(arr[0] == 'Success'){
				  document.getElementById("loadedImg").src=arr[1];
				  $("#imgFormdata1").css("display", "block"); 
				  $("#imgAddData1").css("display", "block");
				  $( "#img_empty1" ).removeClass("image_empty");
				  $("#showImgErr").hide();
				}else{
					$("#showImgErr").html(arr[1]); 
					$("#image_upload").val('');
					$("#showImgErr").show();
					//$("#showImgErr").show().delay('3000').fadeOut();;
					$("#loadedImg").css("display", "none"); 
				}
			},
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
});



$("#image_upload1").change(function(e) {  
        e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);
		$("#loadedImg1").css("display", "block");
        $.ajax({
			 beforeSend: function()
 		      {
      	        document.getElementById("loadedImg1").src='images/loader64.gif';
  			  },
            url: 'site/product/ajax_load_images1',
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
				var arr = data.split('|');
			  	if(arr[0]=='Success'){
					$("#loadedImg1").css("display", "block");	
					document.getElementById("loadedImg1").src=arr[1];
					$("#imgFormdata2").css("display", "block"); 
					$("#imgAddData2").css("display", "block");
					$( "#img_empty2" ).removeClass( "image_empty" );
					 $("#showImgErr").hide();
				  }else{
				   	$("#showImgErr").html(arr[1]); 
					$("#image_upload1").val('');
					$("#showImgErr").show();
					//$("#showImgErr").show().delay('3000').fadeOut();
					$("#loadedImg1").css("display", "none");
				  }
		   },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
})
$("#image_upload2").change(function(e) {  
        e.preventDefault();
		$("#loadedImg2").css("display", "block");	
        var formData = new FormData($(this).parents('form')[0]);
        $.ajax({
			beforeSend: function()
 		      {
      	        document.getElementById("loadedImg2").src='images/loader64.gif';
  			  },
            url: 'site/product/ajax_load_images2',
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
			  var arr = data.split('|');
			  if(arr[0]=='Success'){
				  document.getElementById("loadedImg2").src=arr[1];
				  $("#imgFormdata3").css("display", "block"); 
				  $("#imgAddData3").css("display", "block");
				  $( "#img_empty3" ).removeClass( "image_empty" );
				   $("#showImgErr").hide();
			  }else{
				  $("#showImgErr").html(arr[1]); 
				  $("#image_upload2").val('');
				  $("#showImgErr").show();
				  //$("#showImgErr").show().delay('3000').fadeOut();
				  $("#loadedImg2").css("display", "none");
				  }
		    },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
})

$("#image_upload3").change(function(e) {  
        e.preventDefault();
		  $("#loadedImg3").css("display", "block");
        var formData = new FormData($(this).parents('form')[0]);
        $.ajax({
			beforeSend: function()
 		      {
      	        document.getElementById("loadedImg3").src='images/loader64.gif';
  			  },
            url: 'site/product/ajax_load_images3',
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
           success: function (data) {
		       var arr = data.split('|');
			   if(arr[0]=='Success'){
				  document.getElementById("loadedImg3").src=arr[1];
				  $("#imgFormdata4").css("display", "block"); 
				  $("#imgAddData4").css("display", "block");
				  $( "#img_empty4" ).removeClass( "image_empty" );
				   $("#showImgErr").hide();
			    }else{
				  $("#showImgErr").html(arr[1]); 
				  $("#image_upload3").val('');
				  $("#showImgErr").show();
				  //$("#showImgErr").show().delay('3000').fadeOut();
				  $("#loadedImg3").css("display", "none");
				  }
			 },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
})

$("#image_upload4").change(function(e) {  
        e.preventDefault();
		
		$("#loadedImg4").css("display", "block");
        var formData = new FormData($(this).parents('form')[0]);
        $.ajax({
			beforeSend: function()
 		      {
      	        document.getElementById("loadedImg4").src='images/loader64.gif';
  			  },
            url: 'site/product/ajax_load_images4',
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
			  var arr = data.split('|');
			  if(arr[0]=='Success'){
		         document.getElementById("loadedImg4").src=arr[1]; 
				 $("#showImgErr").hide();
			  }else{
				  $("#showImgErr").html(arr[1]); 
				  $("#image_upload4").val('');
				  $("#showImgErr").show();
				  //$("#showImgErr").show().delay('3000').fadeOut();
				  $("#loadedImg4").css("display", "none");
			 }	 
		   },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
})
});
function dis_val(val){	
	if(val == 'file_wrapper'){
		$('#shipping_wrapper').css('display','none');
		$('#variation_wrapper').css('display','none');
		$('#digital_wrapper').css('display','block');
		$('#QuantityLab').css('display','none');
		$('#quantity').css('display','none');
		$('#qty_text_div').css('display','none');
		
		
	}else{
		$('#digital_wrapper').css('display','none');
		$('#shipping_wrapper').css('display','block');
		$('#variation_wrapper').css('display','block');
		$('#QuantityLab').css('display','block');
		$('#quantity').css('display','block');
		$('#qty_text_div').css('display','block');
	}
}

function dis_val_attach(val){	
	document.getElementById(val).style.display="block";	
}
 
function hid_msg(val)
{
	document.getElementById(val).style.display="none";
}
function Goog_SR(status)
{
	var txt=document.getElementById(status).innerHTML;
	if(txt=='Show preview')
	{
		document.getElementById(status).innerHTML='Hide preview';
		document.getElementById('preview').style.display="block";
	}
	else if(txt=='Hide preview')
	{
		document.getElementById(status).innerHTML='Show preview';
		document.getElementById('preview').style.display="none";
	}
}
function change(boxid,divtoaffect) 
{ 
content = document.getElementById(boxid).value; 
document.getElementById(divtoaffect).innerHTML = content; 
} 
function processing_time_shipping(val)
{
	if(val=='custom')
	{
		document.getElementById('custom_shipping_time').style.display="block";
	}
	else
	{
		document.getElementById('custom_shipping_time').style.display="none";
	}
}


/***************************************************************************************************************************************************/
function alpha_check(val)
{
	var selected=document.getElementById(val.id).value;
	if(selected != ''){
			var status="none";
					if($('#price_opt').html()=="Add Pricing")	
					{
						status="none";
					}
					else
					{
						status="block";
					}
			$(document).ready(function() {
				$(".scale_change").each(function() {
					$(this).html(selected);
				});
			});
			$(document).ready(function() {
				$(".scale_change_txt").each(function() {
					$(this).val(selected);
				});
			});
			
			var data_val=selected.length;
			var scale=document.getElementById('have_scalling').innerHTML;
			var scale_check="";
			//alert(scale);
			
			if(selected == 'alpha')
			{ 
				 //$("#options_level").css("display", "block");
				 $("#attr_options_val").css("display", "block");
				 $("#add_textbox_button").css("display", "none");
				 
			}
			 else
			{   	
				   if(scale=="No" || val.id=="checked_alpha_value" )
					{
						$('#variation_add_loading1').show();
						var ads=0; 
						$("#options_list tr td").each(function() {
							var text = $(this).text();
							if(text.trim()==selected){
								ads++;
								$(this).parent().fadeTo('fast',1.0,function(){$(this).css('background-color','#FCC')}).fadeTo('slow',1.0,function(){$(this).css('background-color','white')}); 
								 $('#variation_add_loading1').hide();
								return false;
							}
						});
						if(ads== 0){
					  $.get('site/product/load_ajax_options_table_noScale/'+selected+'/'+status, function(data) {
					  $("#options_table").css("display", "block");
					  //$("#options_list").css("display","block");
					  $("#options_list tr:last").after(data);
					  $('#variation_add_loading1').hide();
					 });	
}					 
					}
					
			  //alert(val.id)
				$("#attr_options_val").css("display", "none");
				$("#add_textbox_button").css("display", "block");
				if(val.id=="checked_alpha_value"){$("#attr_options_val").css("display", "block");$("#add_textbox_button").css("display", "none");}
			  //  $("#enter_options").css("display", "block");
				
			}
	}
	
}
function alpha_check1(val)
{
	
	var selected=document.getElementById(val.id).value;
	if(selected != ''){
			var status="none";
			if($('#price_opt1').html()=="Add Pricing")	
			{
				status="none";
			}
			else
			{
				status="block";
			}
	
			$(document).ready(function() {
				$(".scale_change1").each(function() {
					$(this).html(selected);
				});
	       });
	
	      $(document).ready(function() {
				$(".scale_change_txt1").each(function() {
					$(this).val(selected);
				});
	      });
	
		var data_val=selected.length;
		var scale=document.getElementById('have_scalling1').innerHTML;
		var scale_check="";
		
		if(selected == 'alpha')
		{ 
			 $("#checked_alpha_value1").css("display", "block");
			 $("#attr_options_val1").css("display", "block");
		}
		 else
		{   
				
			   if(scale=="No" || val.id=="checked_alpha_value1" )
				{
					$('#variation_add_loading2').show();
				  $.get('site/product/load_ajax_options_table_noScale1/'+selected+'/'+status, function(data) {
				  $("#options_table1").css("display", "block");
				  $("#options_list1 tr:last").after(data);
				  $('#variation_add_loading2').hide();
				 });	 
				}
				
		
			$("#attr_options_val1").css("display", "none");
			$("#add_textbox_button1").css("display", "block");
			if(val.id=="checked_alpha_value1"){$("#attr_options_val1").css("display", "block");$("#add_textbox_button1").css("display", "none");}
		  //  $("#enter_options").css("display", "block");
			
		}
	}
	
}





$(document).ready(function() {
  
	    
	$("#property_level").change(function() { 
			
			var variatios=document.getElementById('property_level').value; 
			if(variatios != ''){
				$('#variation_one').css("display", "block");
				$("#attr_loader").css("display", "block");
				$("#close_var_one").css("display", "block");
				$("#property_level").css("display", "none");
				$('#variations_level_div').html('<label id="selected_variation">'+variatios+'</label><input type="hidden" value="'+variatios+'" name="property_level"/>');
				
				$.get('site/product/select_ajax_attr_options?property_level=' + $(this).val(), function(data) {
				$("#attr_loader").css("display", "none");
				$("#options_level").css("display", "block");
				$("#options_level").html(data);
					 $('#loader').slideUp(200, function() {
						$(this).remove();
					 });
				});	
			}
    }); 
	$('#options_list td a.close_icon').click(function() { 	
		$(this).parent().parent().remove();
		var x = document.getElementById("options_list").rows.length;
		if(x == 1){
			$('#price_opt').html('Remove Pricing');
			price_opt_click();
			$('#remove_attr_pricing').trigger('click');
			$('#options_table').css('display','none');		
		}
		var y = document.getElementById("options_table1").rows.length;
		if(y == 1){
			$('#options_table1').css('display','none');
		}
	});
 
});



$(document).ready(function() {
 
 	$("#property_level1").change(function() { 
			var variatios=document.getElementById('property_level1').value;
			if(variatios != ''){
				$('#variation_two').css("display", "block");
				$("#attr_loader1").css("display", "block");
				$("#close_var_two").css("display", "block");
				$("#property_level1").css("display", "none");
					
				$('#variations_level_div1').html('<div id="variations_level_div"><label id="selected_variation1">'+variatios+'</label><input type="hidden" name="property_level1" value="'+variatios+'"><input type="hidden" value="'+variatios+'" name="property_level1"/></div>');
				$.get('site/product/select_ajax_attr_options1?property_level1=' + $(this).val(), function(data) {
				$("#attr_loader1").css("display", "none");
				$("#options_level1").css("display", "block");
				$("#options_level1").html(data);
				  $('#loader').slideUp(200, function() {
					$(this).remove();
				  });
			  });
			}
    }); 
	$('#options_list1 td a.close_icon1').click(function() { 		
		$(this).parent().parent().remove();
	});
	$('#options_list1 > tbody > tr > td a.close_icon').click(function() { 	
		$(this).parent().parent().remove();
	});
 
 
});


$(document).ready(function() {
            $(".vari_option").change(function() { 
			$(".vari_option").find("option[value="+ $(this).val() + "]").attr('disabled', true);
		
    });
 
 });


$(document).ready(function() {
            $("#checked_alpha_value").change(function() { 
			$("#checked_alpha_value").find("option[value="+ $(this).val() + "]").attr('disabled', true);		
    }); 
});

function varaClose(id){
	$('#tab_'+id).remove();
	var x = document.getElementById("options_list").rows.length;
	if(x == 1){
		$('#price_opt').html('Remove Pricing');
		price_opt_click();
		$('#remove_attr_pricing').trigger('click');
		$('#options_table').css('display','none');		
	}
	var y = document.getElementById("options_table1").rows.length;
	if(y == 1){
		$('#options_table1').css('display','none');
	}
	
}

function close_shipping(id){
		rem_ship_loc="#shipping_to_"+id;
		var selected_value = $("#shipping_to_"+id+"_lab").text();
		vals=$(rem_ship_loc).val()+':';
		var arraySelects = document.getElementsByClassName('shipping_to');
	   	var selectedOption = $(rem_ship_loc).attr("selectedIndex")
		/*
		for(var k=0; k<arraySelects.length; k++) 
		{
			if(id!=2){
			//console.log(arraySelects[k]);
		//	arraySelects[k].options[selectedOption].removeAttr("disabled");
			}
			
		}*/
		
		var selected_country=$('#selected_country').html();
		var rem=selected_country.replace(vals,"");
		rem=selected_country.replace(selected_value+':',"");
		$('#selected_country').html(rem);
		$('#tab_'+id).remove();
}

/*shipping block script starts here*/

$(document).ready(function() {
	$i=3;
	var vals="";
	$('#btnAdd').click(function() {
		$i++;
		$selected_country=$('#selected_country').html();
		$selected_country=encodeURIComponent($selected_country);
		//alert($selected_country);
		$('#stimg').show();
		$.get('site/shop/load_ajax_shipping_list/'+$i+'/'+$selected_country, function(data) {
			$("#tbNames tr:last").after(data);
			$('#stimg').hide();
		});	          
      }
    );

    $('#tbNames td a.close_icon').click(function() { 	
		rem_ship_loc="#shipping_to_"+this.id;
		vals=$(rem_ship_loc).val()+':';
		var arraySelects = document.getElementsByClassName('shipping_to');
	   	var selectedOption = $(rem_ship_loc).attr("selectedIndex")
		for(var k=0; k<arraySelects.length; k++) 
		{
			if(this.id!=2){
			//arraySelects[k].options[selectedOption].disabled = false;	
			}
		}
		
		
		var selected_country=$('#selected_country').html();
		var rem=selected_country.replace(vals,"");
		$('#selected_country').html(rem);
		$(this).parent().parent().remove();
	});	
    }
	
);
	
$(document).ready(function() {
	$('#shipping_from').change(function() {
		//$("#shipping_to_1_lab").html($(this).val());
		$("#shipping_to_1").val($(this).val());
		$("#shiping_to_default").val($(this).val());
		str=$('#selected_country').html();
		$val=str.substring(str.indexOf(":") + 1);
		
		$vals=$(this).val().substring($(this).val().indexOf("|") + 1);
		$cid=$(this).val().substring(0,$(this).val().indexOf("|"));
		$("#shipping_to_1_lab").html($vals);
		$("#shipping_to_1_id").val($cid);
		$('#selected_country').html($(this).val()+':'+$val);
		});	          
    }	
);

function display_sel_val(val)
{
	var shipFrom = $('#shipping_from option:selected').val();
	if(shipFrom == ''){
		$(val).val('');
		alert("Please select the Shipfrom");
		return false;
	}
	sel='#'+val.id;
	lab='#'+val.id+'_lab';
	sid='#'+val.id+'_id';
	$vals=$(sel).val().substring($(sel).val().indexOf("|") + 1);
	$cid=$(sel).val().substring(0,$(sel).val().indexOf("|"));
	$(sid).val($cid);
	$(lab).html($vals);
	$(lab).css("display", "block");
	$(sel).css("display", "none");
	
}
function toggleDisability(selectElement){
   var arraySelects = document.getElementsByClassName('shipping_to');
   var selectedOption = selectElement.selectedIndex;
   for(var i=0; i<arraySelects.length; i++) {
    if(arraySelects[i] == selectElement)
     continue; 
	val=selectElement.options[selectedOption].text;
    arraySelects[i].options[selectedOption].disabled = true;	
   }
   $('#selected_country').append(val+':');
   
}

function toggleDisabilityfrom(selectElement){
   var arraySelects = document.getElementsByClassName('shipping_to');
   var selectedOption = selectElement.selectedIndex;
   for(var i=0; i<arraySelects.length; i++) {
    if(arraySelects[i] == selectElement)
     continue; 
	val=selectElement.options[selectedOption].text;
    arraySelects[i].options[selectedOption].disabled = true;	
   }
}
/*shipping block script ends here*/



/*adding and removing price option for variationone scripting starts here */
/*$(document).ready(function(){
    $('#price_opt').click(function(){*/
function price_opt_click()
{	
		$status=$('#price_opt').html();
		if($status=="Add Pricing")	
		{	
			$(".price_box").each(function(){
				$(this).css('display','block');
				$('#price_div_hid').css('display','block');
				$('#price_div_disp').css('display','none')
			});
			$('#price_opt').html('Remove Pricing');
			$('#price_status').val('0');
		}
		if($status=="Remove Pricing")	
		{	
			$(".price_box").each(function(){
				$(this).css('display','none');
				$('#price_div_hid').css('display','none');
				$('#price_div_disp').css('display','block');
			});
			$('#price_opt').html('Add Pricing');
			$('#price_status').val('1');
			var i=0;
			$('.enable-variations-pricing').each(function() {
              
				if($(this).html()=="Add Pricing"){  i++;}
            });
			if(i==2){$('#price_div_hid').css('display','none');$('#price_div_disp').css('display','block')}
			
			
		}
}
 /*   });
});*/
/*adding and removing price option for variation one scripting ends here */

/*adding and removing price option for variation two scripting starts here */
/*$(document).ready(function(){
    $('#price_opt1').click(function(){*/
function price_opt_click1()
{		
		$status=$('#price_opt1').html();
		if($status=="Add Pricing")	
		{	
			$(".price_box1").each(function(){
				$(this).css('display','block');
				$('#price_div_hid').css('display','block');
				$('#price_div_disp').css('display','none')
			});
			$('#price_opt1').html('Remove Pricing');
		}
		if($status=="Remove Pricing")	
		{	
			$(".price_box1").each(function(){
				$(this).css('display','none');
				
			});
			$('#price_opt1').html('Add Pricing');
			var i=0;
			$('.enable-variations-pricing').each(function() {
              
				if($(this).html()=="Add Pricing"){ i=i+1;}
            });
			if(i==2){$('#price_div_hid').css('display','none');$('#price_div_disp').css('display','block')}
			
			
		}
}
    /*});
});*/

/*adding and removing price option for variation two scripting ends here */
function add_options_with_scal()
{
		var status="none";
		if($('#price_opt').html()=="Add Pricing")	
		{
			status="none";
		}
		else
		{
			status="block";
		}
	  var optionval=document.getElementById("option_value").value;
	  optionval=optionval;
	  
		 if(optionval=="")
		 {
			  $('#option_value').val('');
			 $('#option_value').addClass('errors'); 
		 }
		 else
		 {
			$('#option_value').removeClass('errors'); 
		  var scale=document.getElementById("attr_options").value; 
		  
		  var scal_check=scale.length;
		  if(scal_check > 0)
		  {
			  $('#variation_add_loading1').show(); 
			  
			   var ads=0;
			  if(scale=="new-val"){scale='No';} 
			  $("#options_list tr td").each(function() {
			  	var text = $(this).text();
					vals=text.replace(scale,'');
					if(vals.trim()==optionval){
						ads++;
					$(this).parent().fadeTo('fast',1.0,function(){$(this).css('background-color','#FCC')}).fadeTo('slow',1.0,function(){$(this).css('background-color','white')});
						$('#variation_add_loading1').hide();
					}
				});
			  
			  if(ads == 0){
			$.get('site/product/load_ajax_options_table/'+optionval+'/'+scale+'/'+status, function(data) {
				//alert(data);
			 document.getElementById("option_value").value='';
			 $("#options_table").css("display", "block");
			$("#options_list tr:last").after(data);
			$('#variation_add_loading1').hide();
			});
				}  
		  }
		 }
	
}
function add_options_without_scale()
{
	
		var status="none";
		if($('#price_opt').html()=="Add Pricing")	
		{
			status="none";
		}
		else
		{
			status="block";
		}
	     var optionval=document.getElementById("option_value").value;		 
		 optionval=optionval;
		 if(optionval=="")
		 {
			  $('#option_value').val('');
			 $('#option_value').addClass('errors'); 
		 }
		 else
		 {
			 
			$('#option_value').removeClass('errors');
			 var scale="No";
			 $('#variation_add_loading1').show();  
			 $.get('site/product/load_ajax_options_table/'+optionval+'/'+scale+'/'+status, function(data) {
				 //alert(data);
			 document.getElementById("option_value").value='';
			 $("#options_table").css("display", "block");
			 $("#options_list tr:last").after(data);
			 $('#variation_add_loading1').hide();
			 });	
		 }

}
function add_options_with_scal1()
{
		var status="none";
		if($('#price_opt1').html()=="Add Pricing")	
		{
			status="none";
		}
		else
		{
			status="block";
		}
	  var optionval=document.getElementById("option_value1").value;
	  optionval=optionval;
		 if(optionval=="")
		 {
			  $('#option_value1').val('');
			 $('#option_value1').addClass('errors'); 
		 }
		 else
		 {
			$('#option_value1').removeClass('errors'); 
		  var scale=document.getElementById("attr_options1").value; 
		  var scal_check=scale.length;
		  if(scal_check > 0)
		  {
			  $('#variation_add_loading2').show();
			$.get('site/product/load_ajax_options_table1/'+optionval+'/'+scale+'/'+status, function(data) {
			 document.getElementById("option_value1").value='';
			 $("#options_table1").css("display", "block");
			$("#options_list1 tr:last").after(data);
			$('#variation_add_loading2').hide();
			});
				  
		  }
		 }
	
	
}
function add_options_without_scale1()
{
		var status="none";
		if($('#price_opt1').html()=="Add Pricing")	
		{
			status="none";
		}
		else
		{
			status="block";
		}
	     var optionval=document.getElementById("option_value1").value;
		 optionval=optionval;
		 if(optionval=="")
		 {
			  $('#option_value1').val('');
			 $('#option_value1').addClass('errors'); 
		 }
		 else
		 {
				$('#option_value1').removeClass('errors'); 
			 var scale="";
			 $('#variation_add_loading2').show();
			 $.get('site/product/load_ajax_options_table1/'+optionval+'/'+scale, function(data) {
				 //alert(data);
			 document.getElementById("option_value1").value='';
			 $("#options_table1").css("display", "block");
			 $("#options_list1 tr:last").after(data);
			 $('#variation_add_loading2').hide();
			 });
		 }

}
function clear_data() {
	$("#selected_variation").css("display", "none");
	$('#variation_one').css("display", "none");
	$.get('site/product/load_ajax_options_div/', function(data) {
		 //alert(data);
		 $('#variation_one').html(data);
		}); 
	$("#property_level").css("display", "block");
    $("#property_level").find('option').removeAttr("disabled");
	 $('#property_level').val('');
       // var myTag = element.attr("myTag"); 
		
		 //$('$variations_level_div').remove();
		 $('#price_opt').html('Remove Pricing');
		price_opt_click();
		$('#remove_attr_pricing').trigger('click');

}
function clear_data1() {
	$("#selected_variation1").css("display", "none");
	$('#variation_two').css("display", "none");
	$.get('site/product/load_ajax_options_div1/', function(data) {
		 //alert(data);
		 $('#variation_two').html(data);
		});
	$("#property_level1").css("display", "block");
	 $("#property_level1").find('option').removeAttr("disabled");
	 $('#property_level1').val('');

}

$(document).ready(function(e) {
    $('#remove_attr_pricing').click(function(e) {
        $('.price_box').each(function(index, element) {
            $(this).css('display','none');
        });
		/*$('.price_box1').each(function(index, element) {
            $(this).css('display','none');
        });*/
		$('#price_status').val('1');
		$('.enable-variations-pricing').html('Add Pricing');
		$('#price_div_hid').css('display','none');
		$('#price_div_disp').css('display','block');
    });
});


/*Script for stock option*/
function stock_check(val)
{
	if($('#'+val.id).is(':checked')){$('#stock_opt_'+val.id).val('1');}else{$('#stock_opt_'+val.id).val('0');}
}

/* Script for selection auction method
*/
var director = 'input[name="pricing_type"]';
$(document).on('change',director,function(){
if($(this).attr('data-pricing').toLowerCase() == 'auction'){
	$('div[data-pricing-type="Auction"]').show();
	$('div[data-pricing-type="Fixed"]').hide();
}else{
	$('div[data-pricing-type="Auction"]').hide();
	$('div[data-pricing-type="Fixed"]').show();
}
});
$(document).ready(function(){
	$(director+':checked').trigger('change');
});

/*validation for edit form starts here*/
$(document).ready(function(){
    $('#save_b').click(function(){
		var regx = /^[A-Za-z0-9 _.-]+$/;
		var sub_cat1=$("#level1_sub_cat").val();
			$("#level1_sub_cat").val(sub_cat1);
		var sub_cat2=$("#level2_sub_cat").val();
			$("#level2_sub_cat").val(sub_cat2);
		/*validation for about the item block*/
		if($('#about_item').val()==""){
			$('#about_fields').addClass('errors_msg'); 
			$('#err_blocks').html(lg_about_list_item);
		}else{
			if($('#what_item').val()==""){  
				$('#about_fields').addClass('errors_msg'); 
				$('#err_blocks').html(lg_about_list_item);
			}else{
				if($('#when_made').val()==""){ 
					$('#about_fields').addClass('errors_msg'); 
					$('#err_blocks').html(lg_about_list_item);
				}else{
					$('#about_fields').removeClass('errors_msg');
					$('#err_blocks').html('');
					/*str=$('#err_blocks').html();
					$('#err_blocks').html(str.replace("About the Item,",""));*/
				}
			}
			
		}
		if(DealOfDay =='Yes'){
			/*validation for deal discount */
			if($('#deal_date_from').val() !="" || $('#deal_date_to').val() !=""){
				if($('#discount').val() <= 0){
					$('#discount_name').addClass('errors_msg'); 
					$('#discount').addClass('errors'); 
					$('#err_blocks').append('Discount, ');
				} else{
						$('#discount_name').removeClass('errors_msg'); 
						$('#discount').removeClass('errors');
						str=$('#err_blocks').html();
						$('#err_blocks').html(str.replace('Discount, ',""));
				}if($('#deal_date_to').val() == $('#deal_date_from').val()){
					if($('#deal_time_from').val() != "" && $('#deal_time_to').val() != ""){
						var starttime1= $('#deal_time_from').val().substring(($('#deal_time_from').val().length )-2,$('#deal_time_from').val().length);
						var endtime1 = $('#deal_time_to').val().substring(($('#deal_time_to').val().length)-2,$('#deal_time_to').val().length);
						 
						//var start_time = $('#deal_time_from').val().substring(0,($('#deal_time_from').val().length)-2);
						//var end_time = $('#deal_time_to').val().substring(0,($('#deal_time_to').val().length )-2);	
						
						 
						if(starttime1 == 'pm')
						{						
							var timeElements = $('#deal_time_from').val().substring(0,($('#deal_time_from').val().length)-2).split(":");    
							//alert(timeElements);
							var theHour = parseInt(timeElements[0]);
							var theMintute = timeElements[1];
							var newHour = theHour + 12;
							start_time= newHour + ":" + theMintute;
						}else{
							
							var timeElements= $('#deal_time_from').val().substring(0,($('#deal_time_from').val().length)-2).split(":");    
							//alert(timeElements);
							var theHour = parseInt(timeElements[0]);
							var theMintute = timeElements[1];
							if(theHour == 12){
								var newHour = theHour + 12;
								start_time= newHour + ":" + theMintute;
							}else{
								start_time= theHour + ":" + theMintute;
							}
						}
						//alert(start_time);
						if(endtime1 == 'pm')
						{						
							var timeElements = $('#deal_time_to').val().substring(0,($('#deal_time_to').val().length )-2).split(":");    
							//alert(timeElements);
							var theHour = parseInt(timeElements[0]);
							var theMintute = timeElements[1];
							var newHour = theHour + 12;
							end_time= newHour + ":" + theMintute;
						}else{
							var timeElements= $('#deal_time_to').val().substring(0,($('#deal_time_to').val().length )-2).split(":");    
							//alert(timeElements);
							var theHour = parseInt(timeElements[0]);
							var theMintute = timeElements[1];
							if(theHour == 12){
								var newHour = theHour - 12;						
								end_time= newHour + ":" + theMintute;
							}else{
								end_time= theHour + ":" + theMintute;
							}
						}
						//alert(end_time);
						var start = new Date($('#deal_date_from').val()+" "+start_time);
						var endtime = new Date($('#deal_date_to').val()+" "+end_time);
						var hours =(endtime - start)/1000/60/60;
						//alert(hours); 
						
						if($('#deal_time_from').val() == $('#deal_time_to').val())
						{
							$('#price_div_disp').addClass('errors_msg');
							$('#deal_time_to').addClass('errors'); 
							$('#deal_time_from').addClass('errors'); 
							$('#err_blocks').append('Please check the deal timings, ');
						}else if(hours <=0){
								$('#price_div_disp').addClass('errors_msg');
								$('#deal_time_to').addClass('errors'); 
								$('#deal_time_from').addClass('errors'); 
								$('#err_blocks').append('Please check the deal timings, ');
						}
						else{
							$('#price_div_disp').removeClass('errors_msg'); 
							$('#deal_time_to').removeClass('errors');
							$('#deal_time_from').removeClass('errors');
							str=$('#err_blocks').html();
							$('#err_blocks').html(str.replace('Please check the deal timings, ',""));
						}
					}
				}
		   }
	   }
		/*validation for category block*/		
		if($('#main_cat_id').val()==""){ 
			$('#category_fields').addClass('errors_msg'); 
			$('#err_blocks').append(lg_category);
		}else{
			$('#category_fields').removeClass('errors_msg');
			str=$('#err_blocks').html();
			$('#err_blocks').html(str.replace(lg_category,""));
		}
		/*validation for item,photo,desc block*/
		if($('#maxtextval').val()==""){  
			$('#title').addClass('errors_msg'); 
			$('#maxtextval').addClass('errors'); 
			$('#err_blocks').append(lg_title);
			//return false;
		}/*else if(!(regx.test($('#maxtextval').val()))){
			$('#title').addClass('errors_msg'); 
			$('#maxtextval').addClass('errors'); 
			$('#err_blocks').append(lg_title);
		}*/
		else{
			$('#title').removeClass('errors_msg');
			$('#maxtextval').removeClass('errors');
			str=$('#err_blocks').html();
			$('#err_blocks').html(str.replace(lg_title,""));
		}
		
		if($('#edit_product_id').val()=="")
		{
			
			if($('#image_upload').val()=="")
			{  
			
				//var ftype = $('#image_upload')[0].files[0].type; // get file type
				$('#photoErr').addClass('errors_msg'); 
				$('#err_blocks').append(lg_photo);
				//return false;
			}
			else
			{
				$('#photoErr').removeClass('errors_msg');
				str=$('#err_blocks').html();
				$('#err_blocks').html(str.replace(lg_photo,""));
			}	
		}else{
			
//			alert($('#image_upload').val());
//			alert($('#existImage0').val());
			
			if($('#existImage0').val() == '')
			{  
				//var ftype = $('#image_upload')[0].files[0].type; // get file type
				$('#photoErr').addClass('errors_msg'); 
				$('#err_blocks').append(lg_photo);
				//return false;
			}
			else
			{
				$('#photoErr').removeClass('errors_msg');
				str=$('#err_blocks').html();
				$('#err_blocks').html(str.replace(lg_photo,""));
			}
		}
		
		var text = tinyMCE.get('desc').getContent();
		//alert(text);
		//alert((regx.test(text)));
		
		if(text=="")
		{  
			$('#desc').addClass('errors'); 
			$('#Description').addClass('errors_msg'); 
			$('#err_blocks').append(lg_description);
			//return false;
		}
		else
		{
			$('#Description').removeClass('errors_msg');
			$('#desc').removeClass('errors');
			str=$('#err_blocks').html();
			$('#err_blocks').html(str.replace(lg_description,""));
		}
		
		
		/*		if($('#desc').val()=="")
		{  
			
			$('#desc').addClass('errors'); 
			$('#Description').addClass('errors_msg'); 
			$('#err_blocks').append(lg_description);
			//return false;
		}
		else
		{
			$('#Description').removeClass('errors_msg');
			$('#desc').removeClass('errors');
			str=$('#err_blocks').html();
			$('#err_blocks').html(str.replace(lg_description,""));
		}
		
*/		
		/*validation for Price and Quantity block*/
/*		
		if($('#price_status').val()==1)
		{
			if($('#price').val()=="" || $('#price').val()==0 || isNaN($('#price').val()))
			{  
				$('#PriceLab').addClass('errors_msg'); 
				$('#price').addClass('errors'); 
				$('#err_blocks').append('Price,');
				//return false;
			}
			else
			{
				$('#PriceLab').removeClass('errors_msg'); 
				$('#price').removeClass('errors');
				str=$('#err_blocks').html();
				$('#err_blocks').html(str.replace("Price,",""));
			}
		}
		else if($('#price_status').val()==0)
		{
			$('#err_blocks').append('Variation,'); 
			$p=1;
			$(".priceingbox").each(function(){
				$p++;
				if($(this).val().length == 0  || $(this).val()==0  || isNaN($(this).val())) 
				{
					$(this).addClass('errors');
				}
				else
				{
					$(this).removeClass('errors');
					$p--;
				}
			});
			if($p==1)
			{					
				str=$('#err_blocks').html();$('#err_blocks').html(str.replace("Variation,",""));
			}
		}
		if($('#quantity').val()==""  || $('#quantity').val()==0  || isNaN($('#quantity').val()))
		{  
			$('#QuantityLab').addClass('errors_msg'); 
			$('#quantity').addClass('errors'); 
			$('#err_blocks').append('Quantity,');
			//return false;
		}
		else
		{
			$('#QuantityLab').removeClass('errors_msg'); 
			$('#quantity').removeClass('errors');
			str=$('#err_blocks').html();
			$('#err_blocks').html(str.replace("Quantity,",""));
		}*/
		                /****Validation for auction and fixed pricing   *****/
       if($('input[name="pricing_type"]:checked').attr('data-pricing').toLowerCase() == 'auction'){
           if($('#starting_price').val()=="" || $('#starting_price').val()==0 || isNaN($('#starting_price').val())){
				$('#startingPrice').addClass('errors_msg'); 
				$('#starting_price').addClass('errors'); 
				$('#err_blocks').append(lg_starting_price);                        
           }else{
				$('#startingPrice').removeClass('errors_msg'); 
				$('#starting_price').removeClass('errors');
				str=$('#err_blocks').html();
				$('#err_blocks').html(str.replace(lg_starting_price,""));
           }
           if($('#price').val()=="" || $('#price').val()==0 || isNaN($('#price').val()) ){
                            if($('#price_status').val()!=0){
				$('#PriceLab').addClass('errors_msg'); 
				$('#price').addClass('errors'); 
				$('#err_blocks').append(lg_price);
                            }else{
				$('#PriceLab').removeClass('errors_msg'); 
				$('#price').removeClass('errors');
				str=$('#err_blocks').html();
				$('#err_blocks').html(str.replace(lg_price,""));                                
                            }
           }else{
				$('#PriceLab').removeClass('errors_msg'); 
				$('#price').removeClass('errors');
				str=$('#err_blocks').html();
				$('#err_blocks').html(str.replace(lg_price,""));
           } 
           if($('#duration').val()=="" || $('#duration').val()==0 || isNaN($('#duration').val()) || !($('#duration').val() % 1 == 0)){
				$('#auctionDuration').addClass('errors_msg'); 
				$('#duration').addClass('errors'); 
				$('#err_blocks').append(lg_Duration);                        
           }else{
				$('#auctionDuration').removeClass('errors_msg'); 
				$('#duration').removeClass('errors');
				str=$('#err_blocks').html();
				$('#err_blocks').html(str.replace(lg_Duration,""));
           } 
       }else{
           if($('#price').val()=="" || $('#price').val()==0 || isNaN($('#price').val())){
               if($('#price_status').val()!=0){
				$('#PriceLab').addClass('errors_msg'); 
				$('#price').addClass('errors'); 
				$('#err_blocks').append(lg_price);   
                }else{
				$('#PriceLab').removeClass('errors_msg'); 
				$('#price').removeClass('errors');
				str=$('#err_blocks').html();
				$('#err_blocks').html(str.replace(lg_price,""));                    
                }
           }else{
				$('#PriceLab').removeClass('errors_msg'); 
				$('#price').removeClass('errors');
				str=$('#err_blocks').html();
				$('#err_blocks').html(str.replace(lg_price,""));
           }
           if($('#quantity').val()==""  || $('#quantity').val()==0  || isNaN($('#quantity').val()))
           {  
           	$('#QuantityLab').addClass('errors_msg'); 
           	$('#quantity').addClass('errors'); 
           	$('#err_blocks').append(lg_Quantity);
           	//return false;
           }
           else
           {
           	$('#QuantityLab').removeClass('errors_msg'); 
           	$('#quantity').removeClass('errors');
           	str=$('#err_blocks').html();
           	$('#err_blocks').html(str.replace(lg_Quantity,""));
           }                    
       }
	   
		/*validation for Shipping block*/
		if($("#physical_item").is(':checked')){
		/*
		$("#ship_duration").each(function(){
				if($(this).val()==""){  
				$(this).addClass('errors');
				$('#err_blocks').append(lg_shipping_time); 				
				}
				else{
					if($('#pickup_local:checked').val() !='collection'){
					$o=1;
					$(this).removeClass('errors');
					//$('#err_blocks').append(lg_shipping_time); 
					$(".ship_duration").each(function(){
						if($(this).val()==""){$(this).addClass('errors'); $o++;}
					});		
					$(".shipping_txt_bax").each(function(){
						//alert("sdf");
						$o++;
						if($(this).val().length == 0  || isNaN($(this).val())) {							
							$(this).addClass('errors');
							$('#err_blocks').append(lg_shipping_tax); 
						}
						else{$(this).removeClass('errors');
						$o--;
						}
					}); 
					if($o==1)
					{					
						str=$('#err_blocks').html();$('#err_blocks').html(str.replace(lg_shipping_time,""));
						str=$('#err_blocks').html();$('#err_blocks').html(str.replace(lg_shipping_from,""));
						str=$('#err_blocks').html();$('#err_blocks').html(str.replace(lg_shipping_tax,""));
					}
				}}
			});	
		if($('#pickup_local:checked').val() !='collection'){
			if(!$('#pickup_local').is(':checked')){
				$("#shipping_from").each(function(){
					if($(this).val()==""){  
						$(this).addClass('errors');
						$('#err_blocks').append(lg_shipping_from); 				
					}
					else{
						$o=1;
						$(this).removeClass('errors');					 
						$(".shipping_to").each(function(){
							
							if($(this).val()==""){
								$(this).addClass('errors'); 
								$o++;
							}
						});		
						$(".shipping_txt_bax").each(function(){
							$o++;
							
							if($(this).val().length == 0  || isNaN($(this).val())) {
								$(this).addClass('errors');
							}
							else{
								$(this).removeClass('errors');
								$o--;
							}
						}); 
						
						if($o > 1){
							$('#err_blocks').append(lg_shipping_from);
						}
						if($o==1)
						{					
							str=$('#err_blocks').html();$('#err_blocks').html(str.replace(lg_shipping_from,""));
						}
					}
				});	
			}}*/
		} else if($("#digital_item").is(':checked')){
			$digiCount=0;
			$('.DigiFiles').each(function(){ 
				if($(this).val() != ''){
					$digiCount++;
				}
			});
			if($digiCount==0){
				$('#digital_label').addClass('errors_msg'); 
				$('#digiErrmsg').html('Please upload at least one file.');
				$('#err_blocks').append('Variation,'); 	
			} else {
				$('#digital_label').removeClass('errors_msg'); 
				$('#digiErrmsg').html('');
				str=$('#err_blocks').html();$('#err_blocks').html(str.replace("Variation,",""));
			}
		} 
		
		if($('#err_blocks').html().length<1)
		{
			$('#errMsg').css('display','none');
			return true;
		}
		else
		{
			$('#errMsg').css('display','block');
			return false;
		}
    });
});
/*validation for form ends here*/

/* Digital Files Upload Starts here*/
$(document).ready(function(e) {	
	$("#file_upload").change(function(e) {		
		var filecount=parseInt($('#filecount').html());
		$("#file_uploadErr").html("");
		if(filecount>0){
		$("#loadedFile").css("display", "block");
		var formData = new FormData($(this).parents('form')[0]);
		$.ajax({
			beforeSend: function(){
				document.getElementById("loadedFile").src='images/loading.gif';
				},
			url: 'site/shop/ajax_load_Files',
			type: 'POST',
			xhr: function() {
				var myXhr = $.ajaxSettings.xhr();
				return myXhr;
			},
			success: function (datas) {
				//load_ajax_DigiFiles_list
				var arr = datas.split('|');
				
			  	if(arr[0] = 'Success'){
					
					$.get('site/shop/load_ajax_DigiFiles_list/'+arr[1], function(data) {
						$("#DigiFiles tr:last").after(data);
					});	
					$("#loadedFile").css("display", "none");
					$('#filecount').html(filecount-1);		
				}else if(arr[0] = 'Errors'){	
					
					$("#file_uploadErr").html(arr[1]);
					$("#loadedFile").css("display", "none");
				}
			},
			data: formData,
			cache: false,
			contentType: false,
			processData: false			
			});
			
		}
		else
		{alert('Maximum five files are Allowed to upload');}
    });
	return false;
	
});
/* Digital Files Upload Ends here*/

/* Remove the Uploaded Digital File Starts here*/
$(document).ready(function(e) {
$('#DigiFiles tr td a.close_icon').click(function() {
		$(this).parent().parent().remove();
		var filecount=parseInt($('#filecount').html());
		$('#filecount').html(filecount+1);
	});
});
function digitalfile_remove(evt){
	$(evt).parent().parent().remove();
	var filecount=parseInt($('#filecount').html());
	$('#filecount').html(filecount+1);
}
/* Remove the Uploaded Digital File Ends here*/
/*Delete Products from Manage Listings Checkbox*/
$(document).ready(function(e) {
    $(".find-all").click(function () {
        if ($(this).is(':checked')) {
			$('input:checkbox[name=find_all]').prop("checked", true);
            $(".chkProd").prop("checked", true);
        } else {
			$('input:checkbox[name=find_all]').prop("checked", false);
            $(".chkProd").prop("checked", false);
        }
    });
});
function confirmDeletePrd(){
	var countVAl=0;
    $('.chkProd').each(function() {
        if ($(this).is(':checked')) {
		   countVAl=countVAl+1;
		}			
    });
	if(countVAl == 0){
		alert('You should select atleast one product to delete.');
		return false;
	}else if(countVAl>0){
		if(confirm('Are you sure want to delete?')){
			return true;
		}else{
			return false;
		}
	}
}

function confirmEditPrd(pos){
	var category=$("#category_"+pos).val();
	var quantity=$("#quantity_"+pos).val();
	var status=$("#status_"+pos).val();
	if(category<1 || quantity=='' || quantity<=0 || isNaN(quantity) || status==''){
		alert('Enter Valid Fields')
		return false;
	}
	var countVAl=0;
	var Ids=[],i=0;
    $('.chkProd').each(function() {
        if ($(this).is(':checked')) {
		   countVAl=countVAl+1;
		   Ids[i]=$(this).val();
			i++;
		}			
    });
	if(countVAl == 0){
		alert('You should select atleast one product to edit.');
		return false;
	}else if(countVAl>0){
		var products=Ids.join();
		if(confirm('Are you sure want to edit?')){
			$.ajax({
				url: 'site/product/edit_bulk_product',
				type: 'POST',			
				data: {'products':products,'category':category,'quantity':quantity,'status':status},
				success: function (response) {	
					//alert(response); return false;
					window.location.reload();
				}	
			});
		}else{
			return false;
		}
	}
}


function show_description_preview(){ 
	$('#dec_container').css('display','block');
	$('#ship_policy_container').css('display','none');
	$('#show_ship_policy_preview').css('background','rgb(236, 233, 233)');
	$('#show_description_preview').css('background','none');
}

function show_ship_policy_preview(){
	$('#ship_policy_container').css('display','block');
	$('#dec_container').css('display','none');
	$('#show_description_preview').css('background','rgb(236, 233, 233)');
	$('#show_ship_policy_preview').css('background','none');
}
function pickupoption(evt){
	var val = evt.id;
	//alert(val);
	if(val == 'pickup_local'){
		$('#ship_from_option').css('display','none');
		$('#shipping_cost_option').css('display','none');
	}else{
		$('#ship_from_option').css('display','block');
		$('#shipping_cost_option').css('display','block');
	}
}
