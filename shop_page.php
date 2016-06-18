<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php	
require_once 'theme_index.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--<meta name="viewport" content="width=device-width, initial-scale=1">
-->

<meta name="viewport" content="width=device-width, initial-scale=1">



<?php
	$base_path= $instance->config->item('base_url');
?>
<base href="<?php echo $base_path; ?>" />

			<title>Shopsy Admin Shopy on Shopsy V2</title>
		
<meta name="Title" content="Shopsy Admin Shopy on Shopsy V2" />
<meta name="keywords" content="Shopsy V2" />
<meta name="description" content="Shopsy V2" />
	
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $base_path;?>images/logo/logo4.png">    
	
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/default/front/bootstrap.css" rel="stylesheet">
<link href="css/default/front/font-awesome.css" rel="stylesheet">
<link href="css/default/front/main.css" rel="stylesheet">
<link href="css/default/front/deal.css" rel="stylesheet">
<link href="css/default/front/browse.css" rel="stylesheet">
<link href="css/default/front/home.css" rel="stylesheet">
<link href="css/default/front/art.css" rel="stylesheet">
<link href="css/default/front/seller.css" rel="stylesheet">
<link href="css/default/front/custom.css" rel="stylesheet"> 
<link href="css/default/site/responsive-dev.css" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/shopsy_style.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/shopsy_style_1.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/account_master.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/popup.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/help.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/front/auction.css"/>
<!---<link rel="stylesheet" type="text/css" media="all" href="css/default/site/my_shop.css"/>
 <link href="css/default/front/new-style.css" rel="stylesheet">  -->
<link href="css/default/front/edit-css.css" rel="stylesheet">
<link href="css/default/site/shop-add.css" rel="stylesheet">
<link href="css/default/front/zo-cas-style.css" rel="stylesheet">
<link href="css/default/front/style-responsive.css" rel="stylesheet">
<link href="css/default/front/responsive-style-sheet.css" rel="stylesheet">






 
 
<script>
	$('a').click(function(){
		alert('You are in preview mode');
		return false;
	});
</script>
<script type="text/javascript">
		var baseURL = '<?php echo $base_path; ?>';
		var BaseURL = '<?php echo $base_path; ?>';
		var currencySymbol = '$';
		var siteTitle = 'Shopsy V2';
		var can_show_signin_overlay = false;
		var currUrls = '';		


 
var atleast_one_del = 'You should select atleast one message to delete.';


 
var are_u_sure = 'Are you sure want to Continue?';

 
var folder_empty = 'This Folder is Empty';

 
var whn_mke = 'When did you make it?';

 
var shop_mke = 'When did your shop make it?';

 
var whn_made = 'When was it made?';

 
var atleast_one_payment = 'Please Select atleast one payment option';

 
var enter_shop_name = 'Enter Your Shop name';


 
var conf_mail_sent = 'Confirmation Mail Sent Successfully';

 
var credit_card_num = 'Please enter a credit card number.';

 
var credit_card_num_digit = 'The credit card number must contain only digits.';

 
var cvv_num = 'Please enter a CCV number';

 
var cvv_num_digit = 'The CCV number must contain only digits.';

 
var enter_name = 'Please enter a name';

 
var enter_phone_num = 'Please enter a phone number.';

 
var phone_num_digit = 'The phone number must have at least 10 digits.';

 
var enter_street = 'Please enter a street';

 
var enter_city = 'Please enter a city.';

 
var enter_province = 'Please enter a state / province / region.';

 
var enter_zipcode = 'Please enter a zip / postal code.';


 
var sel_country = 'Please select a country.';


 
var sel_month = 'Please select a month.';


 
var sel_year = 'Please select a year.';

 
var gift_code = 'Enter Gift Code';

 
var shop_country = 'Select Country';

 
var cant_blank = 'Cant blank';

 
var prod_add_cart = 'Product Added in your cart';

 
var lg_show = 'Show';

 
var lg_entries = 'entries';

 
var seller_srch = 'Search';

 
var no_record = 'No Record Found';

 
var lg_showing = 'Showing';

 
var lg_to = 'to';

 
var lg_of = 'of';

 
var lg_first = 'First';

 
var lg_previous = 'Previous';

 
var lg_next = 'Next';

 
var lg_last = 'Last';

 
var enter_ur_cmt = 'Please enter your comments';

 
var u_want_continue_action = 'Whether you want to continue this action?';


 
var field_req = 'This field is required';


 
var enter_list_name = 'Enter List Name!';

 
var enter_same_value = 'Please enter the same value again';

 
var sel_checkbox = 'Please Select the CheckBox';

 
var no_records_found = 'No records found';

 
var choose = 'Choose ';

 
var no_match_records = 'No matching records found';

var lg_add_btn = 'ADD';
var lg_about_list_item ='About the Item,';

var lg_category = 'Category,';
var lg_photo ='Photo,';

var lg_description = 'Description,';
var lg_price ='Price,';

var lg_shipping_time ='Shipping Duration,';
var lg_shipping_from ='Shipping from,';
var lg_shipping_tax ='shipping cost,';
var lg_shipping_one ='Shipping cost With an Item,';

var lg_title ='Title,';

var lg_starting_price='Starting price,';

var lg_Duration='Duration,';

var lg_Quantity='Quantity,';

var lg_required_field = 'This Field required';

var lg_email_reg_already = 'This Email id already registered.';

var lg_user_name_already = 'Username already exists! Choose another';

var lg_user_name_not_valid = 'User name not valid. Only alphanumeric allowed';

var lg_accept_terms_policy = 'Please accept our Terms of Use and Privacy Policy';

var lg_email_pwd_notsame = 'Email Id and password cannot be same';

var lg_pwd_username_notsame = 'Username and password cannot be same';

var lg_pwd_firstname_notsame = 'First name and password cannot be same';

var lg_username_25_max = 'Username must be maximum of 25 characters';
var lg_firstname_25_max = 'Firstname must be maximum of 25 characters';
var lg_lastname_25_max = 'Lastname must be maximum of 25 characters';

var lg_pwd_not_match = 'password not match';

var lg_pwd_12_char = 'Password must be maximum of 12 characters ';

var lg_pwd_6_char = 'Password must be minimum of 6 characters';

var lg_invalid_email = 'Invalid e-mail address';
var lg_alphabets = 'This field allowed only alphabets';

var lg_pls_enter_valid_email= 'Please enter valid e-mail addresss';
var lg_Pls_select_one = 'Please select one';
var lg_pls_enter_receiver_email = 'Please Enter the Receiver Email';
var lg_pls_enter_receiver_name = 'Please enter the recipient\'s name';
var lg_Please_enter_your_name = 'Please enter your name';
var lg_Please_Enter_Valid_Email_Address = 'Please Enter Valid Email Address';
var lg_Please_Re_Enter_the_Receiver_Email = 'Please Re-Enter the Receiver Email';
var lg_Receiver_Email_doest_matched = 'Receiver Email doesn\'t matched';
var lg_add_your_tag_here = 'add your tag here!!!';
var lg_enter_shopname='Enter Your Shop name.';
var lg_choose_color= 'choose color..';
var lg_Enter_List_Name='Enter List Name!';
var lg_please_enter_the_amount='please enter the amount';
var lg_characters_not_allowed='characters not allowed';
var lg_Are_you_Sure_to_Cancel_it='Are you Sure to Cancel it?';
var lg_msg_min='Type message minimum 5 characters';
var lg_sure='Are you sure?';
var lg_select_reason='You should select any one reason.';
var lg_pls_add_subject='Please add subject.';
var lg_Entered_code_is_invalid='Entered code is invalid';
var lg_Please_select_one='Please select one';
var lg_Please_enter_the_recipientname='Please enter the recipients name ';
var lg_payment_gateway='Please Choose the Payment Gateway';
var lg_All_the_fields_are_required='All the fields are required.';
var lg_pls_enter_sub_5char='please enter the subject more than 5 character';
var lg_pls_enter_des_5char='please enter the Description more than 5 character';
var lg_pld_selct_priority='please select the priority';
var lg_pls_enter_valid_amt='please enter a valid amount';
var lg_Selec_both_fromand_todate='Select both from and to date';
var pls_entre_same_value='Please enter the same value';
var lg_scroll_more_results='Scroll for  more results or click here';
</script>
<!--
<script type="text/javascript" src="js/site/jquery-1.9.0.js"></script>
<script type="text/javascript" src="js/site/plugin.js"></script>
<script type="text/javascript" src="js/site/SpryTabbedPanels.js"></script>
<script src="js/jquery.colorbox.js"></script>
<script type="text/javascript" src="js/site/verticaltabs.pack.js"></script>-->
<!-------------Old script lines--------->
<script type="text/javascript" src="js/site/jquery-1.7.1.min.js"></script> 
<script type="text/javascript" src="js/validation.js"></script>
<!---------------New script lines -------->
<script src="js/front/jquery.raty.min.js"></script>
<!--[if lt IE 9]>
<script src="js/html5shiv/dist/html5shiv.js"></script>
<![endif]-->

<!--header-->
<!--Theme settings-->
<link href="./theme/themecss_.css" rel="stylesheet">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--<meta name="viewport" content="width=device-width, initial-scale=1">
-->

<meta name="viewport" content="width=device-width, initial-scale=1">





			<title>Shopsy Admin Shopy on Shopsy V2</title>
		
<meta name="Title" content="Shopsy Admin Shopy on Shopsy V2" />
<meta name="keywords" content="Shopsy V2" />
<meta name="description" content="Shopsy V2" />
	
<link rel="shortcut icon" type="image/x-icon" href="images/logo/logo4.png">    
	
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/default/front/bootstrap.css" rel="stylesheet">
<link href="css/default/front/font-awesome.css" rel="stylesheet">
<link href="css/default/front/main.css" rel="stylesheet">
<link href="css/default/front/deal.css" rel="stylesheet">
<link href="css/default/front/browse.css" rel="stylesheet">
<link href="css/default/front/home.css" rel="stylesheet">
<link href="css/default/front/art.css" rel="stylesheet">
<link href="css/default/front/seller.css" rel="stylesheet">
<link href="css/default/front/custom.css" rel="stylesheet"> 
<link href="css/default/site/responsive-dev.css" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/shopsy_style.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/shopsy_style_1.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/account_master.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/popup.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/help.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/front/auction.css"/>
<!---<link rel="stylesheet" type="text/css" media="all" href="css/default/site/my_shop.css"/>
 <link href="css/default/front/new-style.css" rel="stylesheet">  -->
<link href="css/default/front/edit-css.css" rel="stylesheet">
<link href="css/default/site/shop-add.css" rel="stylesheet">
<link href="css/default/front/zo-cas-style.css" rel="stylesheet">
<link href="css/default/front/style-responsive.css" rel="stylesheet">
<link href="css/default/front/responsive-style-sheet.css" rel="stylesheet">






 

<script type="text/javascript">
		var baseURL = '<?php echo $base_path;?>';
		var BaseURL = '<?php echo $base_path;?>';
		var currencySymbol = '$';
		var siteTitle = 'Shopsy V2';
		var can_show_signin_overlay = false;
		var currUrls = '';		


 
var atleast_one_del = 'You should select atleast one message to delete.';


 
var are_u_sure = 'Are you sure want to Continue?';

 
var folder_empty = 'This Folder is Empty';

 
var whn_mke = 'When did you make it?';

 
var shop_mke = 'When did your shop make it?';

 
var whn_made = 'When was it made?';

 
var atleast_one_payment = 'Please Select atleast one payment option';

 
var enter_shop_name = 'Enter Your Shop name';


 
var conf_mail_sent = 'Confirmation Mail Sent Successfully';

 
var credit_card_num = 'Please enter a credit card number.';

 
var credit_card_num_digit = 'The credit card number must contain only digits.';

 
var cvv_num = 'Please enter a CCV number';

 
var cvv_num_digit = 'The CCV number must contain only digits.';

 
var enter_name = 'Please enter a name';

 
var enter_phone_num = 'Please enter a phone number.';

 
var phone_num_digit = 'The phone number must have at least 10 digits.';

 
var enter_street = 'Please enter a street';

 
var enter_city = 'Please enter a city.';

 
var enter_province = 'Please enter a state / province / region.';

 
var enter_zipcode = 'Please enter a zip / postal code.';


 
var sel_country = 'Please select a country.';


 
var sel_month = 'Please select a month.';


 
var sel_year = 'Please select a year.';

 
var gift_code = 'Enter Gift Code';

 
var shop_country = 'Select Country';

 
var cant_blank = 'Cant blank';

 
var prod_add_cart = 'Product Added in your cart';

 
var lg_show = 'Show';

 
var lg_entries = 'entries';

 
var seller_srch = 'Search';

 
var no_record = 'No Record Found';

 
var lg_showing = 'Showing';

 
var lg_to = 'to';

 
var lg_of = 'of';

 
var lg_first = 'First';

 
var lg_previous = 'Previous';

 
var lg_next = 'Next';

 
var lg_last = 'Last';

 
var enter_ur_cmt = 'Please enter your comments';

 
var u_want_continue_action = 'Whether you want to continue this action?';


 
var field_req = 'This field is required';


 
var enter_list_name = 'Enter List Name!';

 
var enter_same_value = 'Please enter the same value again';

 
var sel_checkbox = 'Please Select the CheckBox';

 
var no_records_found = 'No records found';

 
var choose = 'Choose ';

 
var no_match_records = 'No matching records found';

var lg_add_btn = 'ADD';
var lg_about_list_item ='About the Item,';

var lg_category = 'Category,';
var lg_photo ='Photo,';

var lg_description = 'Description,';
var lg_price ='Price,';

var lg_shipping_time ='Shipping Duration,';
var lg_shipping_from ='Shipping from,';
var lg_shipping_tax ='shipping cost,';
var lg_shipping_one ='Shipping cost With an Item,';

var lg_title ='Title,';

var lg_starting_price='Starting price,';

var lg_Duration='Duration,';

var lg_Quantity='Quantity,';

var lg_required_field = 'This Field required';

var lg_email_reg_already = 'This Email id already registered.';

var lg_user_name_already = 'Username already exists! Choose another';

var lg_user_name_not_valid = 'User name not valid. Only alphanumeric allowed';

var lg_accept_terms_policy = 'Please accept our Terms of Use and Privacy Policy';

var lg_email_pwd_notsame = 'Email Id and password cannot be same';

var lg_pwd_username_notsame = 'Username and password cannot be same';

var lg_pwd_firstname_notsame = 'First name and password cannot be same';

var lg_username_25_max = 'Username must be maximum of 25 characters';
var lg_firstname_25_max = 'Firstname must be maximum of 25 characters';
var lg_lastname_25_max = 'Lastname must be maximum of 25 characters';

var lg_pwd_not_match = 'password not match';

var lg_pwd_12_char = 'Password must be maximum of 12 characters ';

var lg_pwd_6_char = 'Password must be minimum of 6 characters';

var lg_invalid_email = 'Invalid e-mail address';
var lg_alphabets = 'This field allowed only alphabets';

var lg_pls_enter_valid_email= 'Please enter valid e-mail addresss';
var lg_Pls_select_one = 'Please select one';
var lg_pls_enter_receiver_email = 'Please Enter the Receiver Email';
var lg_pls_enter_receiver_name = 'Please enter the recipient\'s name';
var lg_Please_enter_your_name = 'Please enter your name';
var lg_Please_Enter_Valid_Email_Address = 'Please Enter Valid Email Address';
var lg_Please_Re_Enter_the_Receiver_Email = 'Please Re-Enter the Receiver Email';
var lg_Receiver_Email_doest_matched = 'Receiver Email doesn\'t matched';
var lg_add_your_tag_here = 'add your tag here!!!';
var lg_enter_shopname='Enter Your Shop name.';
var lg_choose_color= 'choose color..';
var lg_Enter_List_Name='Enter List Name!';
var lg_please_enter_the_amount='please enter the amount';
var lg_characters_not_allowed='characters not allowed';
var lg_Are_you_Sure_to_Cancel_it='Are you Sure to Cancel it?';
var lg_msg_min='Type message minimum 5 characters';
var lg_sure='Are you sure?';
var lg_select_reason='You should select any one reason.';
var lg_pls_add_subject='Please add subject.';
var lg_Entered_code_is_invalid='Entered code is invalid';
var lg_Please_select_one='Please select one';
var lg_Please_enter_the_recipientname='Please enter the recipients name ';
var lg_payment_gateway='Please Choose the Payment Gateway';
var lg_All_the_fields_are_required='All the fields are required.';
var lg_pls_enter_sub_5char='please enter the subject more than 5 character';
var lg_pls_enter_des_5char='please enter the Description more than 5 character';
var lg_pld_selct_priority='please select the priority';
var lg_pls_enter_valid_amt='please enter a valid amount';
var lg_Selec_both_fromand_todate='Select both from and to date';
var pls_entre_same_value='Please enter the same value';
var lg_scroll_more_results='Scroll for  more results or click here';
</script>
<!--
<script type="text/javascript" src="js/site/jquery-1.9.0.js"></script>
<script type="text/javascript" src="js/site/plugin.js"></script>
<script type="text/javascript" src="js/site/SpryTabbedPanels.js"></script>
<script src="js/jquery.colorbox.js"></script>
<script type="text/javascript" src="js/site/verticaltabs.pack.js"></script>-->
<!-------------Old script lines--------->
<script type="text/javascript" src="js/site/jquery-1.7.1.min.js"></script> 
<script type="text/javascript" src="js/validation.js"></script>
<!---------------New script lines -------->
<script src="js/front/jquery.raty.min.js"></script>
<!--[if lt IE 9]>
<script src="js/html5shiv/dist/html5shiv.js"></script>
<![endif]-->

<!--header-->
<!--Theme settings-->
<?php	
	$instance->load->library('session');
	if($instance->session->userdata('Curr_theme_name') != "") {
?>
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>header.css" rel="stylesheet">
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>footer.css" rel="stylesheet">
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>Shop-page.css" rel="stylesheet">
<?php 
	}
?>

#you1{
	background-image:url("<?php echo $base_path; ?>images/default_avat.png");
	background-position:center;
	border-radius: 50%;
	box-shadow: 0 0 1px rgba(0, 0, 0, 0.5);
	float: left;
	height: 31px !important;
	margin-top: 0;
	vertical-align: middle;
	width: 31px;
	background-size: cover;
}
</style>
</head>
 		<body>
<!-- header_start -->
 <header>
 
 <div class="header_top">
 
					<div class="container top">
				<div class="row">
				    <div class="col-md-12 signin sign-mobile"> 
					     <a href="register">Register</a> | <a href="login">Sign in</a>
						 
						 <span class="shop-cart"> 
						<a href="cart"><i class="fa fa-shopping-cart"></i>Cart						<span id="CartCount1" class="CartCount1"> 0</span> 
						</a> 
						</span>
				    </div>
					<div class="col-md-2 col-xs-2" id="logo">  
						<a href="http://192.168.1.251:8081/shopsy-v2/">
							<img src="images/theme/logo2.png" alt="Shopsy V2" title="Shopsy V2" />
						</a>
					</div>				 
					<div class="col-md-3 search-bl col-xs-6">				
						<form name="search" action="search/all" method="get">
							<input type="text" class="search" name="item" placeholder="Search for items and shops" value="" id="search_items" autocomplete="off" >
														 								 																				
							<input type="submit" value="Search" class="search-bt">			
						</form>
						<div id="sugglist"></div>
					</div>
				  
					<div class="btn-group col-md-1 act-browse-bt">
						<button type="button" class="btn btn-default dropdown-toggle browse " data-toggle="dropdown" aria-expanded="false">
							Browse  
							<span class="caret"></span> 
						</button>
						<ul class="dropdown-menu" role="menu">
														<li><a href="category-list/66-aaa">aaa</a></li>
														<li><a href="category-list/67-bbb">bbb</a></li>
														<li><a href="category-list/5-women">women</a></li>
														<li><a href="category-list/6-kids">Kids</a></li>
														<li><a href="category-list/7-books">Books& Media</a></li>
														<li><a href="category-list/8-electronics">Electronics</a></li>
														<li><a href="category-list/13-sports">Sports</a></li>
														<li><a href="category-list/14-kitchen-appliances">Kitchen Appliances</a></li>
														<li><a href="category-list/3-everything-else">Everything Else</a></li>
							 
						</ul>				 
					</div>					
                      <div class="col-md-2 pull-right signin cart-top">
					  
						  <span class="shop-cart"> 
							<a href="cart"><i class="fa fa-shopping-cart icon-shopping"></i></a>
							<a class="cart-txt" href="cart">
								Cart 
								<span id="CartCount1" class="CartCount1"> 0</span>
							</a>
							</span> 
						
					    </div>					
					<div class="col-md-5 col-xs-5 top-login"> 				
						<ul class="header_menu">
							<li>
								<a href="http://192.168.1.251:8081/shopsy-v2/" id="home" title="Home">
									<span class="icon-text">Home</span>
								</a>
							</li>					
							<li>
								<a href="shop/sell" id="shop" title="You Shop">
									<span class="icon-text">Shop</span>
									 
								</a>
								
							</li>
							
							<li>
								<a id="location" href="shop-by-location">
								<span class="icon-text">By Location</span>															
								</a>
								
							</li>
							
														
							<li>
								
								<a id="register" data-toggle="modal" href="#signin" onclick="javascript:$('#registerTab').trigger('click');"><span class="icon-text">Register</span></a>
								
							</li>
							
							
							<li>
		
								<a id="signin-icon" data-toggle="modal" href="#signin" onclick="javascript:$('#loginTab').trigger('click');"><span class="icon-text">Sign In</span></a>
									
							</li>
							
														

							
									   
						</ul>
						
						
						</div>
					
					  <!--					     <a data-toggle="modal" href="#signin" onclick="javascript:$('#registerTab').trigger('click');">Register</a> <span class="btn">
					     <a data-toggle="modal" href="#signin" onclick="javascript:$('#loginTab').trigger('click');">Sign In</a></span> 
					  -->
					  
				
					
				</div>
			</div>	

		
		
</div>


		 




</header>			  
			  
	<div class="col-md-4 search-bl col-xs-12 hidesearch">
		<div class="hidesearch-cover">
			<form name="search" action="search/all" method="get">
				<input type="text" class="search" name="item" placeholder="Search for items and shops" value="" id="search_items" autocomplete="off" >
								 					 												<input type="submit" class="search-bt" value="Browse" />
				<div id="sugglist"></div>
			</form>
		</div>
	</div>
			
<script type="text/javascript">
function hoverView(val){
	if($('#hoverlist'+val).css('display')=='block'){
		$('#hoverlist'+val).hide('');	
	}else{
		$('#hoverlist'+val).show('');
	}		
}
</script>
</body>
<div class="add_shop">
	<div class="main">
		<ul class="add_steps shop-menu-list">
			<li><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">Shop home<span></span></a></li>
					</ul>
	</div>
</div>
<div id="shop_page_seller">
<section class="container">
	<div class="main">
		<div class="container">
            <ul class="breadcrumb_top">
				<li><a href="#">Home</a></li>
				<li>></li>
				<li>chennai</li>
            </ul>
			<div class="right_side width-full">
				<div class="add_listimg shop-detail shopview_info">
					<span class="gallery-banner"><img height="315" src="http://192.168.1.251:8081/shopsy-v2/images/store-banner/Hydrangeas.jpg"/>
					
					<div class="shop_view_left1">
					<div class="shopview_info profile-info-img">
						 
                        
                        	<a href="view-people/admin"><img  width="120" height="120"  src="images/theme/9002.jpg" /></a>

                                                <a class="names-it" href="view-people/admin">admin   </a>
						 <div class="places"> 
							fff 
													 </div>
					</div>
				</div>
					
					</span>
					
					
					
					
					
						<div class="shop_view_text">
							<a style="font-size:14px; font-weight:bold; line-height:24px; float:left;  text-decoration:none;" href="shop-section/chennai">chennai</a>
							<div class="opented" style="font-size:11px; color:#fff;">Opened on </div>
						</div>
						<div class="shop-owner-text">
							<ul>
								<li>
																<a class="contact_shop_owner-popup" href="login?action=http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">
									Contact the shop owner								</a>
															</li>
							<li>	
														<form action="login" method="get" id="my_form">
								<input type="hidden" value="shop-section/chennai" name="action" />
								<a class="favorites" onclick="document.getElementById('my_form').submit();" ><input type="submit" value="" class="hoverfav_icon" /></a>
							</form>
							 
						</li>
					</ul>
					<ul class="reviews-bg">
						<li>
							<span>Reviews</span>
							<span class="reviews">
                                <div class="stars small" style="width: 0px !important;"> </div>
                            </span>
							
						</li>
					</ul>
				</div>
				<div id="shop-detail-info" class="shopview_info">
					<ul>
												<li><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai/about">About</a></li>     
						<li class="policies">
							<a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai/policy">Policies</a>
						</li>
						<li class="seller_info">
							<a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai/seller-information">Seller Information</a>
						</li> 
						<!--<li><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai/sales">21 sales</a></li>
						<li><a href="shops/chennai/favoriters">6 admirers</a></li>
						<li>
							<span class="reviews">
                                <div class="stars small" style="width: 0px !important;"> </div>
                            </span>
						</li>-->
					</ul>
					<ul style="float:right;">
					
										<li>
					<div class="addthis_toolbox addthis_default_style addthis_32x32_style" addthis:url="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">
						<a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai" class="addthis_button_facebook"></a><!--facebook-->
						<a class="addthis_button_twitter"></a>                              <!--twitter-->
					</div>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50ab628f64d148de"></script>
					</li>
					
						
						
						<li>
                          	 
                            <form action="login" method="get" id="my_form">
                                <input type="hidden" value="shop-section/chennai" name="action" />
                                <a onclick="document.getElementById('my_form').submit();" >Report this shop to Shopsy V2</a>
                            </form>
                                                      </li> 	
					</ul>
				</div>
				<div class="art">
						<ul>
							<li>
								<a  href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai/sales">
									<span class="shop-icon icon-37"></span>
									<span><span>21</span> Sales</span>
								</a>						
							</li>
							<li>
								<a  href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai/favorites">
									<span class="shop-icon icon-37"></span>
									<span><span>6</span> Favorites									</span></span>
								</a>
							</li>
							<li>
								<a class="art-active" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">
									<span class="shop-icon icon-37"></span>
									<span>16   Products</span>
								</a>
							</li>
							<!--<li>
								<a href="">
									<span class="shop-icon icon-37"></span>
									<span><span>6</span> Watched Stores</span>
								</a>
							</li>-->
							<li style="float:right">
								<a  href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai/followings">
									<span class="shop-icon icon-39"></span>
									<span><span>3</span>  Follow</span>
								</a>
							</li>
							<li style="float:right">
								<a  href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai/followers">
									<span class="shop-icon icon-38"></span>
									<span><span>1</span> Followers</span>
								</a>							
							</li>
						</ul>
					</div>
					
				</div>	
				
				<div class="liner"><div class="imgaddres"></div></div>  
                                                    <div class="listings-title">
               <form method="post" name="shop_section_search" id="shop_section_search" action="site/shop_section/shop_section_search_form" autocomplete="off">
                   <input class="text_box" type="text" placeholder="Search in this shop" name="search_query" id="search_query" value="">
                   <input type="hidden" name="current_page_url" id="current_page_url" value="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?" />
                   <!--<input type="text" name="current_page_url" id="current_page_url" value="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?" />-->
                   <input class="subscribe_btn" type="submit" value="Search">
               </form>
			   <div style=" margin-top: 10px;padding-left: 55px;float: left;">
												<b>This Shop Accepts Shopsy Gift Cards.<b>
										
			   </div>
               <div class="sorting-options">
               <label> Sort by: </label>
                <ul id="menu">
                              <li><a href="javascript:void(0);">Custom<img src="images/down_arrow.png" /></a>
                <ul style="left: -62px;" class="sub-menu">
                <span class="cursor"></span>
                              		 <li>
                        <a class="" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?order=custom&">Custom</a>
                    </li>
                                        <li>
                        <a class="" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?order=date_desc&">Most Recent</a>
                    </li>
                    <li>
                        <a class="" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?order=price_asc&">Lowest Price</a>
                    </li>
                    <li>
                        <a class="" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?order=price_desc&">Highest Price</a>
                    </li>                    
                </ul>
            </li>
    		             </ul>
                <ul class="view-options">
										<li class="icon1">
						<a class="view_icons selected" data-type="gallery" title="Gallery view" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?view_type=gallery&"></a>
					</li>
					<li class="icon2">
						<a class="view_icons selected" data-type="gallery" title="List view" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?view_type=list&"></a>
					</li>
                </ul>
               </div>
               </div>      
                    
 
 <script type="text/javascript" src="js/front/freewall.js"></script>
 
 
 <div class="product_box">     

 	               

    <div id="freewall" class="free-wall" style="margin-bottom: 51px;"> 
	
	<div id="tiles">

    	
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('1');">  </a>

                                        	<div class="hover_lists" id="hoverlist1">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1700" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_1" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('1');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/pivot-alibaba-light-8">   <img src="images/theme/1439906515-pics-of-mehndi-designs-3-600x450.jpg" alt="Pivot Alibaba Light" title="Pivot Alibaba Light" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/pivot-alibaba-light-8">Pivot Alibaba Light</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$456.00</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('2');">  </a>

                                        	<div class="hover_lists" id="hoverlist2">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1689" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_2" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('2');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/clothes">   <img src="images/theme/1438934784-12pc-white-sport-goose-font-b-feather-b-font-font-b-shuttlecocks-b-font-birdies-badminton.jpg" alt="clothes" title="clothes" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/clothes">clothes</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$100.00</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('3');">  </a>

                                        	<div class="hover_lists" id="hoverlist3">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1679" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_3" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('3');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/shopsy">   <img src="images/theme/1438944331-colorful-flowers-flower-hd-wallpaper.jpg" alt="shopsy" title="shopsy" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/shopsy">shopsy</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$12,123.00</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('4');">  </a>

                                        	<div class="hover_lists" id="hoverlist4">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1669" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_4" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('4');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/asdf">   <img src="images/theme/1438869239-3d_equalizer_music_wallpapers_hd_48_photos_wus.jpg" alt="asdf" title="asdf" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/asdf">asdf</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$16,273.65</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('5');">  </a>

                                        	<div class="hover_lists" id="hoverlist5">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1668" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_5" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('5');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/sdfg">   <img src="images/theme/1438867882-61ilzr59kbl.jpg" alt="sdfg" title="sdfg" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/sdfg">sdfg</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$1,000.00</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('6');">  </a>

                                        	<div class="hover_lists" id="hoverlist6">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1667" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_6" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('6');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/jewelery">   <img src="images/theme/1438866142-81iovdzwofl._UL1500_" alt="jewelery" title="jewelery" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/jewelery">jewelery</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$100.00</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('7');">  </a>

                                        	<div class="hover_lists" id="hoverlist7">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1663" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_7" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('7');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/barbie-1">   <img src="images/theme/1438848465-free-shipping-font-b-black-b-font-clothes-font-b-dress-b-font-for-font-b.jpg" alt="barbie" title="barbie" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/barbie-1">barbie</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$1,000.00</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('8');">  </a>

                                        	<div class="hover_lists" id="hoverlist8">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1662" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_8" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('8');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/barbie">   <img src="images/theme/1438848303-12pc-white-sport-goose-font-b-feather-b-font-font-b-shuttlecocks-b-font-birdies-badminton.jpg" alt="barbie" title="barbie" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/barbie">barbie</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$1,089,326.84</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('9');">  </a>

                                        	<div class="hover_lists" id="hoverlist9">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1661" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_9" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('9');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/rodeo-rocking-chair-black">   <img src="images/theme/1438847960-220-volt-kitchenaid-artisan-stand-mixer-grape.jpg" alt="Rodeo Rocking Chair Black" title="Rodeo Rocking Chair Black" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/rodeo-rocking-chair-black">Rodeo Rocking Chair Black</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$64.00</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('10');">  </a>

                                        	<div class="hover_lists" id="hoverlist10">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1658" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_10" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('10');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/furnitures">   <img src="images/theme/1438699140-modern-dining-tables-brisbane.jpg" alt="Furnitures" title="Furnitures" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/furnitures">Furnitures</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$10.65</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('11');">  </a>

                                        	<div class="hover_lists" id="hoverlist11">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1657" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_11" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('11');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/art-painiting-1">   <img src="images/theme/1438696243-home-living-room-good-design-2-on-living-design-ideas.jpg" alt="Art Painiting" title="Art Painiting" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/art-painiting-1">Art Painiting</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$224.08</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('12');">  </a>

                                        	<div class="hover_lists" id="hoverlist12">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1656" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_12" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('12');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/testing-product-for-rs">   <img src="images/theme/1438695879-eyeglasses-frame-men-titanium-glasses-box-ultra-light-tr90-male-big-frame-glasses-1.png" alt="Testing product for Rs" title="Testing product for Rs" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/testing-product-for-rs">Testing product for Rs</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$10.60</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('13');">  </a>

                                        	<div class="hover_lists" id="hoverlist13">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1654" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_13" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('13');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/new-tesr">   <img src="images/theme/1438693107-lane-crawford-the-portfolio-menswear-spring-summer-2010-but-sou-lai-06.jpg" alt="New Tesr" title="New Tesr" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/new-tesr">New Tesr</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$200.00</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('14');">  </a>

                                        	<div class="hover_lists" id="hoverlist14">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1653" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_14" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('14');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/art-painiting">   <img src="images/theme/1438692843-menswear-monday-pinterest-inspiration-4.jpg" alt="Art Painiting" title="Art Painiting" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/art-painiting">Art Painiting</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$2.12</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('15');">  </a>

                                        	<div class="hover_lists" id="hoverlist15">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1652" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_15" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('15');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/test-art-work">   <img src="images/theme/1438689337-menswear-monday-pinterest-inspiration-4.jpg" alt="Test Art work" title="Test Art work" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/test-art-work">Test Art work</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$200.00</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
            <div class="brick">   
			
                    <div class="brick-hover">             

                    <div class="product_hide">

                                    	<div class="product_fav">

                                            
											<a href="login" >

												<input type="submit" value="" class="hoverfav_icon" />

											</a>

											                                             

                                            <div class="hoverdrop_icon">

                                    		<a href="javascript:hoverView('16');">  </a>

                                        	<div class="hover_lists" id="hoverlist16">

                                               	<h2>Your Lists</h2>

                                                <div class="lists_check">

                                                	
                                                    
                                                    </div>                                                    

                                                    <div class="new_list">

                                                    <form method="post" action="site/user/add_list">

                                                        <input type="hidden" value="1" name="ddl" />

                                                        <input type="hidden" value="1650" name="productId" />

                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_16" />

                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('16');" />

                                                    </form>

                                                </div>

                                        	</div>

                                    	

                                   	</div>

                                        </div>

                                    </div>

                  

               <a href="products/test-product-for-tax">   <img src="images/theme/1438675255-img_2445.jpg" alt="Test Product for tax" title="Test Product for tax" /></a></div>

                <div class="info">

                <div class="product_title"><a href="products/test-product-for-tax">Test Product for tax</a></div>

                

                <div class="product_maker"><a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a></div>

            

                <div class="product_price">

                
                    <span class="currency_value">$500.00</span>

                    <span class="currency_code">USD</span>

                 

                    

      

                    

                

                </div>
				<a title="1" class="landing-btn-more" href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai?pg=1" style="display: none;">See More Products</a>				</div>

            

            </div>

        
    </div>

    	
	</div>
	
	
	<script type="text/javascript">
									var wall = new freewall("#freewall");
									wall.reset({
										selector: '.brick',
										animate: true,
										cellW: 230,
										cellH: 'auto',
										onResize: function() {
											wall.fitWidth();
										}
									});
									
									wall.container.find('.brick img').load(function() {
										wall.fitWidth();
									});


						</script> 

</div>

<script type="text/javascript">
var loading = true;
$(window).scroll(function(){
	if(loading==true){
		if(($(document).scrollTop()+$(window).height())>($(document).height()-1)){
			//alert("asdfasdf");
			//wall.fitWidth();
			 $url = $(document).find('.landing-btn-more').attr('href');
			console.log($url);
			if($url){
				loading = false;
				$(document).find('#load_ajax_img').append('<img id="theImg" src="http://192.168.1.251:8081/shopsy-v2/images/loader64.gif" />');
				$.ajax({
					type : 'get',
					url : $url,
					dataType : 'html',
					success : function(html){
						
						$html = $($.trim(html));
						//console.log($html);
						$(document).find('.landing-btn-more').remove();
						$(document).find('#tiles').append($html.find('#tiles').html());
						$(document).find('#tiles').after($html.find('.landing-btn-more'));
						wall.fitWidth();
						setTimeout(function(){wall.fitWidth();},100);
						
					},
					error : function(a,b,c){
						console.log(c);
					},
					complete : function(){
						$("#load_ajax_img img:last-child").remove()
						loading = true;
						
					}
				});
			} 
		}
	}
});

</script>                    <div class="clear"></div>
					<div id="load_ajax_img" style="text-align:center;"> </div>
                    <!--<ul style="width: 55%;" class="page_nav">
						<li>
													</li>
                    </ul>  -->
                                </div>   
								
            </div>        
        </div>
    </section>
	</div>
	<div id='report_reg' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div style='background:#fff;'>  
					<form action="spam-report" name="span-form" method="post" onsubmit="return validate_spamreport();">
						<div class="conversation" style="width: 86%;">
							<div class="conversation_container">
								<a href="javascript:void(0);" onclick="javascript:$('#report-cancel').trigger('click');">X</a>
								<h5 class="reportspan-head">Report Spam</h5>
								<br /><br />

								<p style="margin:0 0 0 5px;">

								<a target="_blank" href="pages/intellectual-property-policy">This is my intellectual property</a><br />

								<a target="_blank" href="pages/report-a-problem"> I ordered this item and have not received it.</a>
								</p>
								<ul> 
									<li>
										<input type="radio" value="The item may not comply with Shopsy V2'\''s handmade guidelines" name="spam_title" class="spamchk">
										<label> The item may not comply with <a target="_blank" href="pages/guidelines">Shopsy V2's handmade guidelines</a> . </label>
									</li>
									<li>
										<input  type="radio" value="The item may not be vintage" name="spam_title" class="spamchk">
										<label> The item may not be <a target="_blank" href="pages/guidelines">vintage</a> (20+ years old). </label>
									</li>
									<li>
										<input  type="radio" value="The item is not a supply for crafting or shipping" name="spam_title" class="spamchk">
										<label> The item is not a <a target="_blank" href="pages/guidelines">supply for crafting or shipping</a> . </label>
									</li>
									<li>
										<input type="radio" value="The item may be prohibited on Shopsy V2." name="spam_title" class="spamchk">
										<label > The item may be <a target="_blank" href="pages/prohibited-items">prohibited</a> on Shopsy V2. </label>
									</li>
									<li>
										<input  type="radio" value="The listing is not labeled as mature content." name="spam_title"  class="spamchk">
										<label>The listing is not labeled as <a target="_blank" href="pages/guidelines">mature content</a> . </label>
									</li>
									<input type="hidden" name="p_id" value="" id="p_id" />
									<input type="hidden" name="s_id" value="1" id="s_id" />
									<input type="hidden" name="p_seourl" value="" id="p_seourl" />
									<input type="hidden" name="s_seourl" value="chennai" id="s_seourl" />
								</ul>
								<textarea name="complaint" placeholder="Please explain why this item violates Shopsy V2 Policies."  id="spam_text"></textarea>
								<center><span class="error" id="spamErr"></span></center>
							</div>				
							<div class="modal-footer footer_tab_footer">
								<div class="btn-group">
										<input class="submit_btn" type="submit" value="Report Spam" />
										<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel">Cancel</a>
								</div>
							</div>	
						</div>

					</form>
			    </div>
			</div>
		</div>
    </div>

    
	<div id='contact_shop_owner' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div  style='background:#fff;'>  
					<div class="conversation" style="width: 91%;">
						<form name="contactshopowener" id="contactshopowener" method="post" action="site/user/purchasecontactshopowner">
							<div class="conversation_container">
								<h2 class="conversation_headline">New conversation with admin  from chennai</h2>

								<div class="conversation_thumb">
									<img width="75" height="75" src="images/theme/9002.jpg">
								</div>
								<div class="conversation_right">
									
									<input type="hidden" name="productseourl" id="productseourl" value="" >
										<input class="conversation-subject" type="text" name="subject" id="subject" placeholder="Subject" />
										<textarea class="conversation-textarea" rows="11" name="message_text" id="message_text" placeholder="Message text"></textarea>
										<input type="hidden" name="username" id="username" value="" >
										<input type="hidden" name="useremail" id="useremail" value="" >
										<input type="hidden" name="userid" id="userid" value="" >
										<input type="hidden" name="selleremail" id="selleremail" value="vinu@teamtweaks.com" >
										<input type="hidden" name="sellerid" id="sellerid" value="1" >
										<input type="hidden" name="dealcode_number" id="dealcode_number" value="" >
										<input type="hidden" name="subject_name" id="subject_name" value="New conversation with admin  from chennai">									
								</div> 
							</div>										
							<div class="modal-footer footer_tab_footer">
								<div id="contact_popupErr" style="color:red;"></div>
								<div class="btn-group">
										<input class="submit_btn" type="submit" value="send" onclick="return validat_popup_send();" />
										<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel">Cancel</a>
								</div>
							</div>	
						</form>
					</div>
				</div>
			</div>
		</div>	
	</div>
	
	
    <div id='announce_more_popup' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			    <div style='background:#fff;'>  
					 <div class="conversation" style="margin-top: 25%;">
						<div class="conversation_container">
							<div style=" padding: 25px 10px; width: 95.8%;" class="popup-body">
								 hi this my shop,come to the shopping world!!!!							</div>
						
							<div class="modal-footer footer_tab_footer">
								<div class="btn-group"><a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel">Close</a></div>
							</div>	
						</div>	
					</div>  
			    </div>
			 </div>
		</div>
	</div>
	<div id='ownshop_contact' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				 <div style='background:#fff;'>  
					<div class="conversation" style="width: 340px; margin-left: 191px; margin-top: 171px;">
						<div class="conversation_container">
							<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;"> Whoa!You can't contact your own shop.  </h2>
							<div class="modal-footer footer_tab_footer">
									<div class="btn-group">
											<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel">okay</a>
									</div>
							</div>		
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>	

	<div id='ownshop_report' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				 <div style='background:#fff;'>  
					<div class="conversation" style="width: 340px; margin-left: 191px; margin-top: 171px;">
						<div class="conversation_container">
							<h2 class="conversation_headline" style="margin: 8px;color: #9E612F;"> Whoa!You can't report your own shop.							 </h2>
							<div class="modal-footer footer_tab_footer">
									<div class="btn-group">
											<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel">okay</a>
									</div>
							</div>		
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>	
<style>
#shop-detail-info ul li.seller_info{border-right: 1px solid #c8c9cd;}

.reviews-bg {
  background: rgba(255, 255, 255, 0.82);
  display: inline-block;
  padding: 0 0 0 15px;
  width: 95%;
  margin-top: 6px!important;
}
</style>	


<section class="second-bl third-bl foot-bg">  
  <footer class="container">
    <div class="row">
      <div class="col-md-3 footer-block"> 
				<span class="footer-head no-ul">Turn Your Passion Into a Business</span>
        <a href="shop/sell"><div class="search-bt col-md-6 col-xs-4 op-bt">Open a Shop</div></a>
				
		<span class="footer-head">Sell on Shopsy V2</span>
		
        <ul class="footer-list">
          
          <li><a href="find/shop">Browse all shops</a></li>
			<li><a href="shop-by-location">Search by location</a></li>
        </ul>
      </div>
	  
	    <div class="col-lg-3  footer-block"><span class="footer-head no-ul">Join the Community</span> 
<ul class="footer-list">
<li><a href="community">Community</a></li>
<li><a href="teams">Teams</a></li>
<li><a href="events">Upcoming Events</a></li>
</ul>
</div>		<div class="col-md-2 footer-block"><span class="footer-head">Discover and Shop</span> 
<ul class="footer-list">
<li><a href="gift-cards">Gift Cards</a></li>
<li><a href="blog">Blog</a>s</li>
<li><a href="registry">Gift Registries</a></li>
</ul>
</div>		<div class="col-md-2 footer-block"><span class="footer-head">Get to Know Us</span> 
<ul class="footer-list">
<li><a href="pages/about-us">About</a></li>
<li><a href="pages/careers">Careers</a></li>
<li><a href="pages/contact-us">Contact</a></li>
</ul>
</div>	    <div class="col-md-2 footer-block"><span class="footer-head">Follow Shopsy</span> 
<ul class="footer-list">
<li> <a href="https://www.facebook.com/zoplay" target="_blank"> <img src="uploaded/facebook-icon.png" alt="" width="16" height="16" /> Facebook </a> </li>
<li> <a href="https://twitter.com/ZoplayCom" target="_blank"> <img src="uploaded/twitter-icon.png" alt="" width="16" height="16" /> Twitter </a> </li>
<li> <a href="http://www.pinterest.com/zoplay/" target="_blank"> <img src="uploaded/pinterest-icon.png" alt="" width="16" height="16" /> Pintrest </a> </li>
</ul>
</div>	  

     
    </div>
    <div class="footer-row">
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
      <ul class="locale-settings">
        <!--<li><a href="javascript:void(0);"> <i class="fa fa-globe"></i></a></li>-->
        <li><a data-toggle="modal" id="language_href" href="#Language" onclick="javascript:$('#languageTab').trigger('click');">  English</a></li>
        <li><a data-toggle="modal" id="currency_href" href="#Language" onclick="javascript:$('#currencyTab').trigger('click');"> $ USD</a></li>
      </ul>
      <a href="pages/help"><div class="help-bt">Help</div></a>
    </div>
    <ul class="bt-menu">
      <li id="copy"> @ 2015 Shopsy, Inc.</li>
      <li><a href="pages/terms-conditions">Terms</a></li>
      <li><a href="pages/privacy-policy">Privacy</a></li>
      <li><a href="pages/copyright">Copyright</a></li>
   </ul>
	
  </footer>
</section>
    
<!-- Geo Start -->

<!-- Geo End --> 	


<!-- <script src="js/front/bootstrap-rating-input.min.js"></script>  -->

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/front/bootstrap.min.js"></script>
 
<a href="#ownShopFavAlertCommon" id="alert_ownshopfav" data-toggle="modal"></a>
 <div id='ownShopFavAlertCommon' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
 <div id='ownProdFavAlertCommon' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<style>
.popup_google  {
    background: url("images/fb1.png") no-repeat scroll 25px 6px #ff6a6f;
    border: 1px solid #c4c4c4;
    color: #fff;
    cursor: pointer;
    float: left;
    font-family: opensansbold;
    padding: 12px 0;
    font-size: 14px;
    width: 229px;
}
</style>
 
<div id="signin" class="modal sign-popup in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="tabbable-panel">
				<div class="tabbable-line">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#tab_default_3" id="loginTab" data-toggle="tab">
							Sign in</a>
						</li>
						<li>
							<a href="#tab_default_4" data-toggle="tab" id="registerTab">
							Register</a>
						</li>	
						
						<li style="margin-bottom:0 !important;">
							<a class="btn btn-default " href="javascript:void(0);" data-dismiss="modal">X</a>
						</li>
							
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_default_3">
						
							 <div class="tab-content">
							<div class="tab_box">
							
								<div class="popup_tab_content" style="padding: 20px 0px;">
									
									 
										<div class="fb_div">
											<a style="margin:0" id="fbsignin" class="" href="http://192.168.1.251:8081/shopsy-v2/facebook/user.php">
											<img src="images/facebook_login.png" alt="facebook">
											</a>
										</div>
										
																														<div class="fb_div">
											<a href="javascript:void(0);" class="" onclick="window.location.href='https://accounts.google.com/o/oauth2/auth?response_type=code&redirect_uri=http%3A%2F%2F192.168.1.251%3A8081%2Fshopsy-v2%2Fgooglelogin%2FgoogleRedirect&client_id=659326530893-vphpvf75hpmeie8rhl5bn65k3vqfer7e.apps.googleusercontent.com&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email&access_type=offline&approval_prompt=force'"><img src="images/google_login.png" alt="google"></a>
										</div>	
											
																				<p class="sign-register-text">                            
											 
											. 
										</p>
										<div class="or_div">
											<span>OR</span>
										</div>
									
									<form method="post" action="site/user/login_user" class="frm clearfix" onSubmit="return loginVal();">
										<div class="popup_login">
											<label>Email or Username</label><span style="color:#F00;" class="redFont" id="emailAddr_Warn"></span> 
											<input type="text" class="search" style="margin:0" name="emailAddr" id="emailAddr"/>
										</div> 
										<div class="popup_login">
											<label>Password</label><span style="color:#F00;" class="redFont" id="password_Warn"></span>  
											<input type="password" class="search" style="margin:0" name="password" id="password"/>
										</div>
										<div class="popup_login">
											<input  style="margin: 0px 5px 0px 0px;" type="checkbox" name="stay_signed_in" value="yes" checked/>Stay Signed in										</div>
										<div class="popup_login" style="margin-bottom:15px">
											<input type="submit" class="submit_btn" value="Sign In" />
											 <span id="loginloadErr" style="display:none;padding: 12px;"><img src="images/indicator.gif" alt="Loading..."></span>									 									 
										</div>
									</form>
									
									<div style=" margin: 0 0 10px 45px;" class="div_line"></div>
									<a href="forgot-password" style="float:left;font-size: 12px; width:100%;    line-height: 23px; margin:0 0 0px 44px;">Forgot your password?</a>
									<a href="reopen-account" style="float:left;font-size: 12px; width:100%;    line-height: 13px; margin:0 0 0px 44px;">Reopen your account?</a>
								</div>
									
							</div>
						</div>
						
						<!--<div class="modal-footer footer_tab_footer">
								<div class="btn-group">
								<a class="btn btn-default submit_btn" href="javascript:void(0);" data-dismiss="modal">Cancel</a>
							</div>
						</div>-->
							
						</div>
						<div class="tab-pane" id="tab_default_4">					
							 <div class="tab-content">							 
								<div class="popup_tab_content">
									 
										<div class="fb_div">
											<a style="margin:0" id="fbsignin" class="" href="http://192.168.1.251:8081/shopsy-v2/facebook/user.php">
											<img src="images/facebook_login.png" alt="facebook">
											</a>
										</div>
										
																														<div class="fb_div">
											<a href="javascript:void(0);" class="" onclick="window.location.href='https://accounts.google.com/o/oauth2/auth?response_type=code&redirect_uri=http%3A%2F%2F192.168.1.251%3A8081%2Fshopsy-v2%2Fgooglelogin%2FgoogleRedirect&client_id=659326530893-vphpvf75hpmeie8rhl5bn65k3vqfer7e.apps.googleusercontent.com&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email&access_type=offline&approval_prompt=force'"><img src="images/google_login.png" alt="google"></a>
										</div>	
											
																				<p class="sign-register-text">                            
											 
											. 
										</p>
										<div class="or_div">
											<span>OR</span>
										</div>
									
									
									<form  method="post" action=""  onSubmit="return register_user(this);">
										<div class="popup_login">
											<label>First Name</label><span style="color:#F00;" class="redFont" id="fullnameErr"></span> 
											<input type="text" class="search" style="margin:0" name="fullname" id="fullname"/>
										</div>
										<div class="popup_login">
											<label>Last Name</label><span style="color:#F00;" class="redFont" id="lastnameErr"></span> 
											<input type="text" class="search" style="margin:0" name="lastname" id="lastname"/>
										</div>
										<div class="popup_login">
											<input type="radio" style="float:left;margin: 6px 6px 0 2px;" name="gender" value="Male" checked/><span class="gen_check">Male</span>
											<input type="radio" style="float:left;margin: 6px 6px 0 12px;" name="gender" value="Female"/><span class="gen_check">Female</span>
											<input type="radio" style="float:left;margin: 6px 6px 0 12px;" name="gender" value="Unspecified"/><span class="gen_check">Rather not say</span>
										</div>
										<div class="div_line" style="margin:20px 0 0px 45px"></div>
									   
										<div class="popup_login">
											<label>User Email</label><span style="color:#F00;" class="redFont" id="emailErr"></span> 
											<input type="text" class="search" style="margin:0" name="email" id="email"/>
										</div>
										<div class="popup_login">
											<label>Password</label><span style="color:#F00;" class="redFont" id="user_passwordErr"></span> 
											<input type="password" class="search" style="margin:0" name="pwd" id="pwd"/>
										</div>
										<div class="popup_login">
											<label>Confirm Password</label><span style="color:#F00;" class="redFont" id="user_ConfirmpasswordErr"></span> 
											<input type="password" class="search" style="margin:0" name="Confirmpwd" id="Confirmpwd"/>
										</div>
										
										<div class="popup_login">
												<label>Username</label>
												<span style="color:#F00;" class="redFont" id="usernameErr"></span> 
												 <input type="text" class="search" style="margin:0" name="username" id="username"/>
										</div>
										<p style="font-size:12px;  margin: 5px 0 4px 42px; color:#666; width:auto; float:left">								
										  <span style=" color: #999999;font-size: 11px;margin: 12px 0 5px;"> 
										  <input type="checkbox" name="privacychecking" id="privacychecking"  checked/> 
										  By clicking Register, you confirm that you accept our 
											<a href="pages/terms-conditions" target="_blank">Terms of Use</a> and<a href="pages/privacy-policy" target="_blank"> Privacy Policy</a></span>
											<br />
											
											 <input type="checkbox" name="subscription" id="subscription" style="display:none;" />
											  											<span class="error" id="PrivacyErr"></span>
										</p>
										
										<div class="popup_login" style="margin-bottom:15px">
											<input type="submit" class="submit_btn" value="Register"/>
											<span id="loadErr"></span>
										</div>
									</form>
								</div>						
							</div>			
							<!--<div class="modal-footer footer_tab_footer">
								<div class="btn-group">
									<a class="btn btn-default submit_btn" data-dismiss="modal"  href="javascript:void(0);">Cancel</a>
								</div>
							</div>-->					
						</div>
					</div>
				</div>
			</div>          
		</div>
	</div>
</div>



<script type="text/javascript">
function loginVal(){ 
	$('#loginloadErr').show();
	$("#emailAddr_Warn").html('');
	$("#password_Warn").html('');
	
	var emailAddr = $("#emailAddr").val();
	var password = $("#password").val();
	
	if(emailAddr.length==0){
	$("#emailAddr_Warn").html(lg_required_field);
	$('#loginloadErr').hide();
	return false;
	}else if(password==''){
	$("#password_Warn").html(lg_required_field);
	$('#loginloadErr').hide();
	return false;
	}
	//return false;
}
</script>




<!-- Language Popup --> 

<form action="currency" method="post" id="preferencesForm" name="preferencesForm" onsubmit="return change_currency_ajax()" >
	<div id="Language" class="modal in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
            
            <div class="tabbable-panel">
				<div class="tabbable-line">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#tab_default_1"  id="languageTab" data-toggle="tab">
								Language 
							</a>
						</li>
						<li>
							<a href="#tab_default_2" id="currencyTab" data-toggle="tab">
								Currency							</a>
						</li>						
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_default_1">
							<div class="tab-content">
								<div class="tab_box">
									<div class="popup_tab_content" style="min-height: 400px;">
										<div class="footer_popup_left">
											<h2>Choose your Language:</h2>
											<div class="verticalslider">
												<ul style="border:none;" class="preference_split">                                       
													 														<li class="languageLi  currencyactive" id="en"  data-name="English">
														<a>English</a>
													</li>
																											<li class="languageLi  " id="es"  data-name="Español">
														<a>Español</a>
													</li>
																											<li class="languageLi  " id="ar"  data-name="Arabic">
														<a>Arabic</a>
													</li>
																											<li class="languageLi  " id="zh"  data-name="Chinese">
														<a>Chinese</a>
													</li>
																											<li class="languageLi  " id="ta"  data-name="tamil">
														<a>tamil</a>
													</li>
																										
												</ul>
											</div>
										</div>
									</div>										
								</div>
							</div>    
							
							<!--<div class="modal-footer footer_tab_footer">
									<div class="btn-group">
									<a class="btn btn-default submit_btn" data-dismiss="modal">Cancel</a>
									<button class="btn btn-default submit_btn">Save</button>
								</div>
							</div>-->
								
						</div>
					    <div class="tab-pane" id="tab_default_2">						
						    <div class="tab-content">
                                <div class="popup_tab_content" style="min-height: 400px;">
                                   <div class="footer_popup_left">
                                    	<h2>Choose your Currency:</h2>
                                        <div class="pass">
                                            <ul style="border:none;" class="preference_split" id="currency_pop">
                                                                                           	<li class="currencyLi  " id="AUD">
                                                    <input type="hidden" id="curAUD" value="$ Australian Dollar" />
                                                    <input type="hidden" id="cursymbolAUD" value="$">
                                                    <span>$</span>
                                                    <a class="split_link" >Australian Dollar</a>
                                                    <span style="margin:4px 0 0 0px;"> AUD</span>
                                                </li>
                                                                                        	<li class="currencyLi  " id="445">
                                                    <input type="hidden" id="cur445" value="545 ghfuj" />
                                                    <input type="hidden" id="cursymbol445" value="545">
                                                    <span>545</span>
                                                    <a class="split_link" >ghfuj</a>
                                                    <span style="margin:4px 0 0 0px;"> 445</span>
                                                </li>
                                                                                        	<li class="currencyLi  " id="INR">
                                                    <input type="hidden" id="curINR" value="Rs indian Rupee" />
                                                    <input type="hidden" id="cursymbolINR" value="Rs">
                                                    <span>Rs</span>
                                                    <a class="split_link" >indian Rupee</a>
                                                    <span style="margin:4px 0 0 0px;"> INR</span>
                                                </li>
                                                                                        	<li class="currencyLi  currencyactive" id="USD">
                                                    <input type="hidden" id="curUSD" value="$ United States Dollar" />
                                                    <input type="hidden" id="cursymbolUSD" value="$">
                                                    <span>$</span>
                                                    <a class="split_link" >United States Dollar</a>
                                                    <span style="margin:4px 0 0 0px;"> USD</span>
                                                </li>
                                               
                                            </ul>
                                        </div>
                                    </div>
                                </div>                           
                	        </div>
                		
							
						</div>
						
						<div class="modal-footer footer_tab_footer">
						
						<div class="footer_tab_content">
							<span id="selectedLanguage">dansk</span>/
							<span id="selectedCurrency">RS Indian Rupee</span>
						</div>
								<div class="btn-group">
									<div style="float:left; display:none;">
										<span id="selectedLanguage">English</span>/ 
										<span id="selectedCurrency">$ United States Dollar </span>
										<!--/ <span id="selectedReligion"> </span>-->
									</div>	
													
									<input type="hidden" name="returnUrl" value="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">
									<input type="hidden" name="currency" id="currency" value="USD" />  
									<input type="hidden" name="language" id="language" value="en" />
									
									
									<a class="btn btn-default submit_btn" id="cancel" data-dismiss="modal">Cancel</a>
 									<button class="btn btn-default submit_btn">Save</button>
									
								</div>
							</div>

					</div>
				</div>
			</div>
            
            </div>
        </div>
	</div>
</form>	

<script>
function change_currency_ajax(){

	var currency = $("#currency").val();
	var language = $("#language").val();

// 	alert(currency);
// 	alert(language);
	
	$.ajax({
		type:'post',
		url:baseURL+'site/user_settings/change_currency_ajax',
		data:{'currency':currency,'language':language},
		dataType:"json",
		success: function (json) {
//			alert("asas");
			$("#language_href").text($("#selectedLanguage").text());
			//$("#currency_href").text($("#selectedCurrency").text());
			//$("#currency_href").text(currency);
			$("#currency_href").text($("#cursymbol"+currency).val() +" "+currency);



			var txt;
			var r = confirm("Press Ok to reload");
			if (r == true) {
			    window.location.reload();
			} else {
			    
			}


			
		}
	});

	$('#Language').modal('toggle');
	return false;
}
</script>


<script>
$(document).ready(function(e) {

	//For footer
	$('.footer-block .footer-head').click(function(){
// 		alert($(this).parent().find('ul.footer-list').css('display'));
		if($(this).hasClass('no-ul')){
			if($(this).next().css('display')=='none'){
				$('.footer-block ul.footer-list').slideUp();
// 				$('.footer-block ul.footer-list').css('display','none');
				$(this).next().css('display','block');
			}
		}else{
			if($(this).parent().find('ul.footer-list').css('display')=='none'){
				$('.footer-block ul.footer-list').slideUp();
// 				$('.footer-block ul.footer-list').css('display','none');
				$(this).parent().find('ul.footer-list').css('display','block');
				$('.footer-block .footer-head.no-ul').next().slideUp();
// 				$('.footer-block .footer-head.no-ul').next().css('display','none');
			}
		}
	});
	
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


</body>
</html>
