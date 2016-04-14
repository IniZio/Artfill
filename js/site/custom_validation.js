/*---------------------------------------Add Shop GetPaid Page Validations--------------------------------------------------------------------*/
		function shop_payment_disp2(id,dis)
		{
			if(document.getElementById(id).checked==true)
			{
				document.getElementById(dis).style.display="block";
			}else if(document.getElementById(id).checked==false)
			{
				document.getElementById(dis).style.display="none";
				$('#authorize_id').val('');
				$('#authorize_idErr').html('');		
				$('#authorize_id').removeClass('errors');	
				
				$('#authorize_key').val('');
				$('#authorize_keyErr').html('');		
				$('#authorize_key').removeClass('errors');				
					
			}
		
		}
		
		// ************ Strip validation on shopper page Siva********************
		
		function shop_payment_disp4(id,dis)
		{
			if(document.getElementById(id).checked==true)
			{
				document.getElementById(dis).style.display="block";
			}else if(document.getElementById(id).checked==false)
			{
				document.getElementById(dis).style.display="none";
				//$('# Secret Key').val('');
				$('# Secret KeyErr').html('');		
				$('# Secret Key').removeClass('errors');	
				
				//$('#stripe_publish_key').val('');
				$('#stripe_publish_keyErr').html('');		
				$('#stripe_publish_key').removeClass('errors');				
					
			}
		
		}
		
		
			// ************ cod validate on shopper page  by udhaya********************
		
		function shop_payment_disp3(id,dis)
		{
			if(document.getElementById(id).checked==true)
			{
				document.getElementById(dis).style.display="block";
			}else if(document.getElementById(id).checked==false)
			{
				document.getElementById(dis).style.display="none";
					
					
			}
		
		}
		
		
		
		function shop_payment_disp1(id,dis)
		{
			if(document.getElementById(id).checked==true)
			{
				document.getElementById(dis).style.display="block";
			}else if(document.getElementById(id).checked==false)
			{
				document.getElementById(dis).style.display="none";
				$('#emailaddress').val('');
				$('#emailaddressErr').html('');		
				$('#emailaddress').removeClass('errors');	
				
				$('#APIUsername').val('');
				$('#APIUsernameErr').html('');		
				$('#APIUsername').removeClass('errors');
				
				$('#APIPassword').val('');
				$('#APIPasswordErr').html('');		
				$('#APIPassword').removeClass('errors');
				
				$('#APISignature').val('');
				$('#APISignatureErr').html('');		
				$('#APISignature').removeClass('errors');		
			}
		
		}		
		function shop_payment_disp()
		{
			if(document.getElementById('money_order').checked==true || document.getElementById('personal_check').checked==true)
			{
				document.getElementById('money__wrap').style.display="block";
			}
			else
			{
				document.getElementById('money__wrap').style.display="none";
				$('#country').val('');
				$('#fullname').val('');
				$('#street').val('');
				$('#city').val('');
				$('#zippostalcode').val('');
				$('#Pay_aso').val('');
				$('#Pay_state').val('');
				$('#countryErr').html('');			
				$('#fullnameErr').html('');			
				$('#streetErr').html('');			
				$('#cityErr').html('');			
				$('#zippostalcodeErr').html('');	
				$('#country').removeClass('errors');
				$('#fullname').removeClass('errors');
				$('#street').removeClass('errors');
				$('#city').removeClass('errors');
				$('#zippostalcode').removeClass('errors');		
			}
		}
		function shop_payment_validation()
		{
			if($('.payment_mode:checked').length==0){
				$('#overall_err').html(atleast_one_payment);	
				return false;
			}
			else
			{
				$('#overall_err').html('');
			
				if(document.getElementById('paypal').checked==true)
				{
					err=0;	
					if(document.getElementById('pplive').checked==false && document.getElementById('ppsandbox').checked==false)
					{			
						$('#PayPal_modeErr').html('This field is required');
						err=1;	
					}			
					var email = $('#emailaddress').val();				
					if(email =='' || email==null){
						$('#emailaddressErr').html('This field is required');
						$('#emailaddress').addClass('errors');
						err=1;		
					}else if( !IsEmail(email)) { 
						$('#emailaddressErr').html('Please Enter Valid Email Address');		
						$('#emailaddress').addClass('errors');
						err=1;		
					}else{
						$('#emailaddressErr').html('');	
						$('#emailaddress').removeClass('errors');
						//err=0;	
					}
					
					/*$('#APIUsernameErr').html('');
					$('#APIPasswordErr').html('');					
					$('#APISignatureErr').html('');
					
					$('#APIUsername').removeClass('errors');
					$('#APIPassword').removeClass('errors');
					$('#APISignature').removeClass('errors');
					
					var APIUsername = $('#APIUsername').val();
					var APIPassword = $('#APIPassword').val();
					var APISignature = $('#APISignature').val();
					
					
					if(APIUsername =='' || APIUsername ==null){
						$('#APIUsernameErr').html('This field is required');
						$('#APIUsername').addClass('errors');
						err=1;				
					}
					if(APIPassword =='' || APIPassword ==null) { 
						$('#APIPasswordErr').html('This field is required');	
						$('#APIPassword').addClass('errors');	
						err=1;		
					}
					if(APISignature =='' || APISignature ==null) { 
						$('#APISignatureErr').html('This field is required');	
						$('#APISignature').addClass('errors');	
						err=1;		
					}*/
					
				}
				if(document.getElementById('Authorize').checked==true)
				{
					//err=0;
					$('#authorize_idErr').html('');
					$('#authorize_keyErr').html('');					
					$('#authorize_modeErr').html('');
					
					$('#authorize_id').removeClass('errors');
					$('#authorize_key').removeClass('errors');
					
					var authorize_id = $('#authorize_id').val();
					var authorize_key = $('#authorize_key').val();
					
					if(document.getElementById('live').checked==false && document.getElementById('sandbox').checked==false)
					{			
						$('#authorize_modeErr').html('This field is required');
						err=1;	
					}
					if(authorize_id =='' || authorize_id ==null){
						$('#authorize_idErr').html('This field is required');
						$('#authorize_id').addClass('errors');
						err=1;				
					}
					if(authorize_key =='' || authorize_key ==null) { 
						$('#authorize_keyErr').html('This field is required');	
						$('#authorize_key').addClass('errors');	
						err=1;		
					}
				}
				/*if(document.getElementById('money_order').checked==true || document.getElementById('personal_check').checked==true)
				{
					err=0;
					$('#countryErr').html('');
					$('#fullnameErr').html('');
					$('#streetErr').html('');
					$('#cityErr').html('');
					$('#zippostalcodeErr').html('');
					$('#country').removeClass('errors');
					$('#fullname').removeClass('errors');
					$('#street').removeClass('errors');
					$('#city').removeClass('errors');
					$('#zippostalcode').removeClass('errors');
					
					
					var country = $('#country').val();
					var fullname = $('#fullname').val();
					var street = $('#street').val();
					var city = $('#city').val();
					var zippostalcode = $('#zippostalcode').val();
					
					if(country =='' || country ==null){
						$('#countryErr').html('This field is required');
						$('#country').addClass('errors');
						err=1;				
					}
					if(fullname =='' || fullname ==null) { 
						$('#fullnameErr').html('This field is required');	
						$('#fullname').addClass('errors');	
						err=1;		
					}
					if(street =='' || street ==null){
						$('#streetErr').html('This field is required');
						$('#street').addClass('errors');
						err=1;				
					}
					if(city =='' || city ==null) { 
						$('#cityErr').html('This field is required');	
						$('#city').addClass('errors');	
						err=1;		
					}
					if(zippostalcode =='' || zippostalcode ==null){
						$('#zippostalcodeErr').html('This field is required');
						$('#zippostalcode').addClass('errors');
						err=1;				
					}					
				}*/
				if(err==1)
				{
					return false;
				}
			}
		}
		function IsEmail(email) 
		{
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			return regex.test(email);
		}

/*---------------------------------------Add Shop Billing Page Validations--------------------------------------------------------------------*/

function checkUsername(element)
{
	err=element+'_err';
	els='#'+element;
	
	if(element=='card_number')
	{	
		if(document.getElementById(element).value.length==0)     
		{
			document.getElementById(err).innerHTML= credit_card_num;
			$(els).addClass('errors');
		}else if(isNaN(document.getElementById(element).value))     
		{
			document.getElementById(err).innerHTML= credit_card_num_digit;
			$(els).addClass('errors');
		}
		else
		{
			document.getElementById(err).innerHTML="";
			$(els).removeClass('errors');
		}
	}
	if(element=='cvv_number')
	{	
		if(document.getElementById(element).value.length==0)     
		{
			document.getElementById(err).innerHTML= cvv_num;
			$(els).addClass('errors');
		}else if(isNaN(document.getElementById(element).value))     
		{
			document.getElementById(err).innerHTML= cvv_num_digit;
			$(els).addClass('errors');
		}
		else
		{
			document.getElementById(err).innerHTML="";
			$(els).removeClass('errors');
		}
	}
	if(element=='name')
	{	
		if(document.getElementById(element).value.length==0)     
		{
			document.getElementById(err).innerHTML= enter_name;
			$(els).addClass('errors');
		}
		else
		{
			document.getElementById(err).innerHTML="";
			$(els).removeClass('errors');
		}
	}
	if(element=='phone')
	{	
		if(document.getElementById(element).value.length==0)     
		{
			document.getElementById(err).innerHTML= enter_phone_num;
			$(els).addClass('errors');
		}else if(isNaN(document.getElementById(element).value))     
		{
			document.getElementById(err).innerHTML= phone_num_digit;
			$(els).addClass('errors');
		}
		else
		{
			document.getElementById(err).innerHTML="";
			$(els).removeClass('errors');
		}
	}
	if(element=='street')
	{	
		if(document.getElementById(element).value.length==0)     
		{
			document.getElementById(err).innerHTML= enter_street;
			$(els).addClass('errors');
		}
		else
		{
			document.getElementById(err).innerHTML="";
			$(els).removeClass('errors');
		}
	}
	if(element=='city')
	{	
		if(document.getElementById(element).value.length==0)     
		{
			document.getElementById(err).innerHTML= enter_city;
			$(els).addClass('errors');
		}
		else
		{
			document.getElementById(err).innerHTML="";
			$(els).removeClass('errors');
		}
	}
	if(element=='state')
	{	
		if(document.getElementById(element).value.length==0)     
		{
			document.getElementById(err).innerHTML= enter_province;
			$(els).addClass('errors');
		}
		else
		{
			document.getElementById(err).innerHTML="";
			$(els).removeClass('errors');
		}
	}
	if(element=='postalcode')
	{	
		if(document.getElementById(element).value.length==0)     
		{
			document.getElementById(err).innerHTML= enter_zipcode;
			$(els).addClass('errors');
		}
		else
		{
			document.getElementById(err).innerHTML="";
			$(els).removeClass('errors');
		}
	}
	if(element=='country')
	{	
		if(document.getElementById(element).value=="")     
		{
			document.getElementById(err).innerHTML= sel_country;
			$(els).addClass('errors');
		}
		else
		{
			document.getElementById(err).innerHTML="";
			$(els).removeClass('errors');
		}
	}
	if(element=='exp_month'  || element=='exp_year')
	{	
		if(element=='exp_month')
		{
			if(document.getElementById(element).value=="")     
			{
				document.getElementById('exp_err').innerHTML= sel_month;
				$(els).addClass('errors');
			}else
		{
			document.getElementById('exp_err').innerHTML="";
			$(els).removeClass('errors');
		}
		}
		else if(element=='exp_year')
		{
			if(document.getElementById(element).value=="")     
			{
				document.getElementById('exp_err').innerHTML= sel_year;
				$(els).addClass('errors');
			}else
		{
			document.getElementById('exp_err').innerHTML="";
			$(els).removeClass('errors');
		}
		}
		
	}
	
	
	if(!isNaN($('#card_number').val()) && !isNaN($('#cvv_number').val()) && $('#exp_month').val()!="" &&  $('#exp_year').val()!="" &&  $('#name').val()!="" && !isNaN($('#phone').val()) && $('#country').val()!="" && $('#street').val()!="" && $('#city').val()!="" && $('#state').val()!="" && $('#postalcode').val()!="")
	{
		$('#validate_card').removeClass('btn_save');
		$('#validate_card').addClass('save_btn');
	}
	else
	{
		$('#validate_card').removeClass('save_btn');
		$('#validate_card').addClass('btn_save');
	}
	
}
function billing_validation(id)
{ 
	var count=0;
	if(id == 'credit'){
		if(document.getElementById('card_number').value.length==0)     
		{
			document.getElementById('card_number_err').innerHTML="Please enter a credit card number.";
			$('#card_number').addClass('errors');count=1;
		}else if(isNaN(document.getElementById('card_number').value))     
		{
			document.getElementById('card_number_err').innerHTML="The credit card number must contain only digits.";
			$('#card_number').addClass('errors');count=1;
		}
		else
		{
			document.getElementById('card_number_err').innerHTML="";
			$('#card_number').removeClass('errors');
		}
		
		if(document.getElementById('cvv_number').value.length==0)     
		{
			document.getElementById('cvv_number_err').innerHTML="Please enter a CCV number.";
			$('#cvv_number').addClass('errors');count=1;
		}else if(isNaN(document.getElementById('cvv_number').value))     
		{
			document.getElementById('cvv_number_err').innerHTML="The CCV number must contain only digits.";
			$('#cvv_number').addClass('errors');count=1;
		}
		else
		{
			document.getElementById('cvv_number_err').innerHTML="";
			$('#cvv_number').removeClass('errors');
		}
		
		
		if(document.getElementById('name').value.length==0)     
		{
			document.getElementById('name_err').innerHTML="Please enter a name.";
			$('#name').addClass('errors');count=1;
		}
		else
		{
			document.getElementById('name_err').innerHTML="";
			$('#name').removeClass('errors');
		}
		if(document.getElementById('exp_month').value=="")     
		{
			document.getElementById('exp_err').innerHTML="Please select a month.";
			$('#exp_month').addClass('errors');count=1;
		}else
		{
			document.getElementById('exp_err').innerHTML="";
			$('#exp_month').removeClass('errors');
		}
		
		if(document.getElementById('exp_year').value=="")     
		{
			document.getElementById('exp_err').innerHTML="Please select a year.";
			$('#exp_year').addClass('errors');count=1;
		}else
		{
			document.getElementById('exp_err').innerHTML="";
			$('#exp_year').removeClass('errors');
		}
		
	}
	
	if(document.getElementById('phone').value.length==0)     
	{
		document.getElementById('phone_err').innerHTML="Please enter a phone number.";
		$('#phone').addClass('errors');count=1;
	}else if(isNaN(document.getElementById('phone').value))     
	{
		document.getElementById('phone_err').innerHTML="The phone number must have at least 10 digits.";
		$('#phone').addClass('errors');count=1;
	}
	else
	{
		document.getElementById('phone_err').innerHTML="";
		$('#phone').removeClass('errors');
	}
	
	if(document.getElementById('street').value.length==0)     
	{
		document.getElementById('street_err').innerHTML="Please enter a street.";
		$('#street').addClass('errors');count=1;
	}
	else
	{
		document.getElementById('street_err').innerHTML="";
		$('#street').removeClass('errors');
	}
	
	if(document.getElementById('city').value.length==0)     
	{
		document.getElementById('city_err').innerHTML="Please enter a city.";
		$('#city').addClass('errors');count=1;
	}else if(!isNaN(document.getElementById('city').value))     
	{
		document.getElementById('city_err').innerHTML="Please enter valide city.";
		$('#city').addClass('errors');count=1;
	}else
	{
		document.getElementById('city_err').innerHTML="";
		$('#city').removeClass('errors');
	}	
	if(document.getElementById('state').value.length==0)     
	{
		document.getElementById('state_err').innerHTML="Please enter a state / province / region.";
		$('#state').addClass('errors');count=1;
	}else if(!isNaN(document.getElementById('state').value))     
	{
		document.getElementById('state_err').innerHTML="Please enter valide state.";
		$('#state').addClass('errors');count=1;
	}else
	{
		document.getElementById('state_err').innerHTML="";
		$('#state').removeClass('errors');
	}			
	if(document.getElementById('postalcode').value.length==0 || document.getElementById('postalcode').value == 0)     
	{
		document.getElementById('postalcode_err').innerHTML="Please enter a zip / postal code.";
		$('#postalcode').addClass('errors');count=1;
	}
	else
	{
		document.getElementById('postalcode_err').innerHTML="";
		$('#postalcode').removeClass('errors');
	}
	
		
	if(document.getElementById('country').value=="")     
	{
		document.getElementById('country_err').innerHTML="Please select a country.";
		$('#country').addClass('errors');count=1;
	}
	else
	{
		document.getElementById('country_err').innerHTML="";
		$('#country').removeClass('errors');
	}
	
	
	if(count==0)
	{	
		if(id != 'credit'){  
			var full_name = $("#full_name").val();
			var street = $("#street").val();
			var city = $("#city").val();
			var state = $("#state").val();
			var country = $("#country").val();
			var postalcode = $("#postalcode").val();
			var phone = $("#phone").val();
			$('#billLoder').css('display','block'); 
			$.ajax({
				url : baseURL+'site/shop/addBillingAjax',
				type:'post',
				data : {'full_name' : full_name,'street' : street,'city' : city,'state' : state,'country' : country,'postalcode' : postalcode,'phone' : phone},
				success : function (data) {
				$('#billLoder').css('display','none');
				},
			});
			return true;
		} else {
			return true;
		}
	}
	else
	{
		return false;
	}
	
	
}
/*******************************************************************************************************************************************************/

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

/**************************************Shop Section ******************************/
function validate_shop_section()
{
	if($('#name').val()=="")
	{
		$('#name').addClass('errors');
		return false;
	}
	else
	{
		$('#name').removeClass('errors');
	}
}
$(document).ready(function(e) {
    $('.create_shop_sec').click(function() {
        $('#create_sec').css('display','none');
		$('#create_sec_div').css('display','block');
    });
	$('.cancel_create_shop_sec').click(function() {
        $('#create_sec').css('display','block');
		$('#create_sec_div').css('display','none');
    });
});
function confirm_section_delete()
{
	return confirm('Are you sure want to delete this section? Listings currently in this section will appear under All Items');
}
function edit_section(val,status)
{
	if(status=='edit')
	{
		$('#'+val).hide();
		$('#edit_'+val).show();
	}
	else if(status=='cancel')
	{
		$('#'+val).show();
		$('#edit_'+val).hide();
	}
}

/**************************************Shop Coupon Coedes ******************************/
function couponcodeValidate(){
	var count=0;
	$('#quantityErr').hide();
	$('#datefromErr').hide();
	$('#datetoErr').hide();
	$('#price_valueErr').hide();
	$('#descriptionErr').hide();
	
	$('#quantityErr').html('');
	$('#datefromErr').html('');
	$('#datetoErr').html('');
	$('#price_valueErr').html('');
	$('#descriptionErr').html('');
	
	$('#quantity').removeClass('errors');
	$('#datefrom').removeClass('errors');
	$('#dateto').removeClass('errors');
	$('#price_value').removeClass('errors');
	$('#description').removeClass('errors');
	
	if($('#quantity').val()==0 || isNaN($('#quantity').val())){
		$('#quantityErr').show();
		$('#quantityErr').html('Enter Maximun number of coupons.');	
		$('#quantity').addClass('errors');
		count=1;	
	}
	if($('#datefrom').val()==''){
		$('#datefromErr').show();
		$('#datefromErr').html('Enter Coupon Valid From Date.');	
		$('#datefrom').addClass('errors');
		count=1;	
	}
	if($('#dateto').val()==''){
		$('#datetoErr').show();
		$('#datetoErr').html('Enter Coupon Expiry Date.');		
		$('#dateto').addClass('errors');
		count=1;
	}
	if($('#price_value').val()==0 || isNaN($('#price_value').val())){
		$('#price_valueErr').show();
		$('#price_valueErr').html('Enter Discount Price Value of Coupon.');
		$('#price_value').addClass('errors');		
		count=1;
	}else{
		if($('#price_value').val() > 100 || $('#price_value').val() <= 0){
			$('#price_valueErr').show();
			$('#price_valueErr').html('Discount Price should be with in 1  to 100.');
			$('#price_value').addClass('errors');		
			count=1;
		}
	}
	if($('#description').val()=='' ){
		$('#descriptionErr').show();
		$('#descriptionErr').html('Enter Description.');		
		$('#description').addClass('errors');
		count=1;
	}
	if(count==0){
		return true;
	}
	else{
		return false;
	}
}



// function by udhay  	 	 	
function checkrecords(recid,userid)
{
  if(userid=="nil")
  {
  if(confirm("Do you want remove this listing?")==true)
  {
     $.get('site/market/deleteRegistryListing?listingid='+recid, function(data) {
	  window.location=location.href;
	  }); 
 }
 else
 {
   
 }	  
 }
 else
 {
    $.get('site/market/insertRegistryListing?listingid='+recid+'&count='+$("#"+userid).val(), function(data) {
	if(data!="no")
	{   
	  	 window.location=location.href;
	}
	
   }); 
 }
}
// checkrecords ends 
/**/