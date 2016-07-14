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

	    
		<title>Search items in Shopsy V2</title>
		
<meta name="Title" content="Search items in Shopsy V2" />
<meta name="keywords" content="Search items in Shopsy V2" />
<meta name="description" content="Shopsy V2" />
	
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $base_path; ?>images/logo/logo4.png">    
	
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
<?php	
	$instance->load->library('session');
	if($instance->session->userdata('Curr_theme_name') != "") {
?>
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>header.css" rel="stylesheet">
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>footer.css" rel="stylesheet">
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>Search-page.css" rel="stylesheet">
<?php 
	}
?>

#you1{
	background-image:url("<?php echo $base_path;?>images/default_avat.png");
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
						<a href="#">
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
														<li><a href="#">aaa</a></li>
														<li><a href="#">bbb</a></li>
														<li><a href="#">women</a></li>
														<li><a href="#">Kids</a></li>
														<li><a href="#">Books& Media</a></li>
														<li><a href="#">Electronics</a></li>
														<li><a href="#">Sports</a></li>
														<li><a href="#">Kitchen Appliances</a></li>
														<li><a href="#">Everything Else</a></li>
							 
						</ul>				 
					</div>					
                      <div class="col-md-2 pull-right signin cart-top">
					  
						  <span class="shop-cart"> 
							<a href="#"><i class="fa fa-shopping-cart icon-shopping"></i></a>
							<a class="cart-txt" href="#">
								Cart 
								<span id="CartCount1" class="CartCount1"> 0</span>
							</a>
							</span> 
						
					    </div>					
					<div class="col-md-5 col-xs-5 top-login"> 				
						<ul class="header_menu">
							<li>
								<a href="#" id="home" title="Home">
									<span class="icon-text">Home</span>
								</a>
							</li>					
							<li>
								<a href="#" id="shop" title="You Shop">
									<span class="icon-text">Shop</span>
									 
								</a>
								
							</li>
							
							<li>
								<a id="#" href="shop-by-location">
								<span class="icon-text">By Location</span>															
								</a>
								
							</li>
							
														
							<li>
								
								<a id="register" data-toggle="modal" href="# " onclick="javascript:$('#registerTab').trigger('click');"><span class="icon-text">Register</span></a>
								
							</li>
							
							
							<li>
		
								<a id="signin-icon" data-toggle="modal" href="# " onclick="javascript:$('#loginTab').trigger('click');"><span class="icon-text">Sign In</span></a>
									
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
			<form name="search" action="#" method="get">
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
<script type="text/javascript" src="a_data/jquery.js"></script>
<link rel="stylesheet" href="<?php echo $base_path; ?>css/default/site/themes-smoothness-jquery-ui.css" />
<script type="text/javascript" src="a_data/jquery-ui.js"></script>
<script type="text/javascript" src="js/currency/jquery.formatCurrency-1.4.0.js"></script>
<link rel="stylesheet" type="text/css" href="a_data/jquery-ui.css">  
<script type="text/javascript" src="js/front/freewall.js"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="css/default/site/style-menu.css" />


<style>
.color-filter li{ 
	display:inline-block;
	width:25px;
	height:25px;
	border-radius:4px;
} 

.color-filter li a {
  display: block;
  font-weight: bold;
  margin: 0 8px;
  padding: 5px;
  border-radius: 4px;
  width: 25px;
  height: 25px;
}  

.list-inline-item span img {
	width: inherit;
  	height: inherit;
 } 
</style>

<script>

$(window).load(function(){


  $(function () {
		var minPrice =  0.00,
          maxPrice = 1089326.84,
          $filter_lists = $("#filters ul"),
          $filter_checkboxes = $("#filters :checkbox"),
          $items = $("#container li.element");
		//$filter_checkboxes.click(filterSystem);
		
		
				$('#slider-container').slider({
					
				  range: true,
				  min: minPrice,
				  max: maxPrice,
				  				   values: [minPrice, maxPrice],
				  				  slide: function (event, ui) {  
						//alert(event);
						//alert(ui);
					  //$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
					  var minPriceDisp = Number('1.00')*(Number(ui.values[0]));
					  var maxPriceDisp = Number('1.00')*(Number(ui.values[1]));

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
					
		
	 // $("#amount").val("$"+minPrice + " - $"+ maxPrice);
	  $("#minPriceVal").val(minPrice);
	   $("#maxPriceVal").val(maxPrice);
	   $("#minPriceDisp").html(ui.values[0]);
	   $("#maxPriceDisp").html(ui.values[1]);
	    $('#minPriceDisp').formatCurrency();
		 $('#maxPriceDisp').formatCurrency();
  });
});

</script>

<div id="product_search_div">
<section class="container">
    
  		<div id="content">
        	<div class="purchase_review product-search-main">
            	<div class="content-wrap-inner1">
                	
					
                        <div id="secondary" class="standardized_filters">
                        	<div id="search-filters" class="secondary-liner">
                            	<ul class="filter marketplaces">
                                	<li class="input-group side-selected side-1 selected">
                                    <a href="#">All Items</a></li>
                                    <li class="input-group ">
                                    <a href="#">Handmade</a></li>
                                    <li class="input-group ">
                                    <a href="#">Vintage</a></li>
                                    <li class="input-group ">
                                    <a href="#">Craft Supplies</a></li>
                                </ul>
                                <ul class="filter categories">
                                
                                                        <li >
                        
                        <a href="#">aaa                        </a>
                        
                        
                      </li>
                                              <li >
                        
                        <a href="#">bbb                        </a>
                        
                        
                      </li>
                                              <li >
                        
                        <a href="#">women                        </a>
                        
                        
                      </li>
                                              <li >
                        
                        <a href="#">Kids                        </a>
                        
                        
                      </li>
                                              <li >
                        
                        <a href="#">Books& Media                        </a>
                        
                        
                      </li>
                                              <li >
                        
                        <a href="#">Electronics                        </a>
                        
                        
                      </li>
                                              <li >
                        
                        <a href="#">Sports                        </a>
                        
                        
                      </li>
                                              <li >
                        
                        <a href="#">Kitchen Appliances                        </a>
                        
                        
                      </li>
                                              <li >
                        
                        <a href="#">Everything Else                        </a>
                        
                        
                      </li>
                                                      
                                </ul>
                                </ul>   
                                </ul>
								
									<!--------- Price Filter with Slider starts --->
													
                                    <ul id="facet-price" class="filter first">
                                	<ul class="price-input">
                                    	<li class="changeable selected">Price,</li>
										<li class="price-slider-max">
																										    <span style="float:left; margin-left: 2%;" class="currency">$<span id="minPriceDisp" >0</span></span> 
														<span style="float:right; margin-right: 2%;" class="currency">$<span id="maxPriceDisp">1,089,327</span></span>
													  													
													<div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="slider-container" style="margin-bottom: 10%;">
														<p align="center" style="margin-top:10px;">
															<input type="hidden" value="" id="amount" style="background-color: #f9f9f9;border: none;text-align: center;">
														</p>
														<div style="left: 0%; " class="ui-slider-range ui-widget-header"></div>
													</div> 
														<div class="rating_slider">
													  <span class="minus_img"></span>
													  <div id="slider-range"></div>
														<span class="plus_img"></span>
													  </div>
													<span>
													
													<form method="get" action="#" id="priceFilterForm">
																												<input type="hidden" id="minPriceVal" value="" name="min_price" class="text" />
														<input type="hidden" id="maxPriceVal" value="" name="max_price" class="text" />										
																																																								 																																								</form>
										</li>	
										
										
                                    </ul>
                                </ul>
                                
<!--------- Color Filter with Slider starts --->                                
                                 <ul id="facet-price" class="filter first">
                                	<ul class="price-input">
                                    	<li class="changeable selected">color</li>
                                    </ul>
                                </ul>
                                
								<ul class="color-filter">
								
								
								<li class="list-inline-item">
									<a href="#" style="background-color: red;">
									<span><img src="images/white_tick.png" style="display:none;"></span>
									</a>
								</li>

								
								<li class="list-inline-item">
									<a href="#" style="background-color: blue;">
									<span><img src="images/white_tick.png" style="display:none;"></span>
									</a>
								</li>

								
								<li class="list-inline-item">
									<a href="#" style="background-color: yellow;">
									<span><img src="images/white_tick.png" style="display:none;"></span>
									</a>
								</li>

								
								<li class="list-inline-item">
									<a href="#" style="background-color: green;">
									<span><img src="images/white_tick.png" style="display:none;"></span>
									</a>
								</li>

								
								<li class="list-inline-item">
									<a href="#" style="background-color: black;">
									<span><img src="images/white_tick.png" style="display:none;"></span>
									</a>
								</li>

								
								<li class="list-inline-item">
									<a href="#" style="background-color: brown;">
									<span><img src="images/white_tick.png" style="display:none;"></span>
									</a>
								</li>

								
								<li class="list-inline-item">
									<a href="#" style="background-color: gray;">
									<span><img src="images/white_tick.png" style="display:none;"></span>
									</a>
								</li>

								
								<li class="list-inline-item">
									<a href="#" style="background-color: pink;">
									<span><img src="images/white_tick.png" style="display:none;"></span>
									</a>
								</li>

								
								<li class="list-inline-item">
									<a href="#" style="background-color: orange;">
									<span><img src="images/white_tick.png" style="display:none;"></span>
									</a>
								</li>

								
								<li class="list-inline-item">
									<a href="#" style="background-color: purple;">
									<span><img src="images/white_tick.png" style="display:none;"></span>
									</a>
								</li>

								
								<li class="list-inline-item">
									<a href="#" style="background-color: white;">
									<span><img src="images/white_tick.png" style="display:none;"></span>
									</a>
								</li>

								
								<li class="list-inline-item">
									<a href="#" style="background-color: violet;">
									<span><img src="images/white_tick.png" style="display:none;"></span>
									</a>
								</li>

																	
								</ul>
								
<!--------- Color Filter with Slider ends--->   
                                
                                
                                
                               <ul class="filter shop-in">
                                	<li class="input-group selected" id="locationbox"><a href="#">Any Shop Location</a></li>
                                                                       <form action="#" method="get">
                                        <input style="width:155px" type="text" id="" value="" name="location" class="location-change">
                                        <span class="button-small button-small-grey">
                                        <span><input style="width:30px;padding: 7px 0;margin: 0;" type="submit" title="OK" value="►" id="locchangeButton">
                                        </span></span>
                                                                                                                                                                                                                                                                                                                   </form>
                                    </li>   
                                                                  </ul> 
                               <ul class="filter shop-in">
                               <li class="input-group selected" id="shiptobox"><a href="#">Ships Anywhere</a></li>
                                                                       <form action="#" method="get"> 
                                       <div class="shiping-region">
                                      <select  name="shipto" onchange="this.form.submit()" id="shipto">
                                       <option value="">Choose country...  </option>
                                       <optgroup label="————————">
                                       										   
										    <option value="1" >Andorra</option>
                                            										   
										    <option value="2" >United Arab Emirates</option>
                                            										   
										    <option value="3" >Afghanistan</option>
                                            										   
										    <option value="4" >Antigua And Barbuda</option>
                                            										   
										    <option value="5" >Albania</option>
                                            										   
										    <option value="6" >Armenia</option>
                                            										   
										    <option value="7" >Angola</option>
                                            										   
										    <option value="8" >Antarctica</option>
                                            										   
										    <option value="9" >Argentina</option>
                                            										   
										    <option value="10" >American Samoa</option>
                                            										   
										    <option value="11" >Austria</option>
                                            										   
										    <option value="12" >Australia</option>
                                            										   
										    <option value="13" >Aruba</option>
                                            										   
										    <option value="14" >Aland Islands</option>
                                            										   
										    <option value="15" >Azerbaijan</option>
                                            										   
										    <option value="16" >Bosnia And Herzegovina</option>
                                            										   
										    <option value="17" >Barbados</option>
                                            										   
										    <option value="18" >Bangladesh</option>
                                            										   
										    <option value="19" >Belgium</option>
                                            										   
										    <option value="20" >Burkina Faso</option>
                                            										   
										    <option value="21" >Bulgaria</option>
                                            										   
										    <option value="22" >Bahrain</option>
                                            										   
										    <option value="23" >Burundi</option>
                                            										   
										    <option value="24" >Benin</option>
                                            										   
										    <option value="25" >Bermuda</option>
                                            										   
										    <option value="26" >Brunei</option>
                                            										   
										    <option value="27" >Bolivia</option>
                                            										   
										    <option value="28" >Bonaire, Saint Eustatius And Saba </option>
                                            										   
										    <option value="29" >Brazil</option>
                                            										   
										    <option value="30" >Bahamas</option>
                                            										   
										    <option value="31" >Bhutan</option>
                                            										   
										    <option value="32" >Bouvet Island</option>
                                            										   
										    <option value="33" >Botswana</option>
                                            										   
										    <option value="34" >Belarus</option>
                                            										   
										    <option value="35" >Belize</option>
                                            										   
										    <option value="36" >Canada</option>
                                            										   
										    <option value="37" >Democratic Republic Of The Congo</option>
                                            										   
										    <option value="38" >Central African Republic</option>
                                            										   
										    <option value="39" >Republic Of The Congo</option>
                                            										   
										    <option value="40" >Switzerland</option>
                                            										   
										    <option value="41" >Ivory Coast</option>
                                            										   
										    <option value="42" >Chile</option>
                                            										   
										    <option value="43" >Cameroon</option>
                                            										   
										    <option value="44" >China</option>
                                            										   
										    <option value="45" >Colombia</option>
                                            										   
										    <option value="46" >Costa Rica</option>
                                            										   
										    <option value="47" >Cuba</option>
                                            										   
										    <option value="48" >Cape Verde</option>
                                            										   
										    <option value="49" >Cyprus</option>
                                            										   
										    <option value="50" >Czech Republic</option>
                                            										   
										    <option value="51" >Germany</option>
                                            										   
										    <option value="52" >Djibouti</option>
                                            										   
										    <option value="53" >Denmark</option>
                                            										   
										    <option value="54" >Dominica</option>
                                            										   
										    <option value="55" >Dominican Republic</option>
                                            										   
										    <option value="56" >Algeria</option>
                                            										   
										    <option value="57" >Ecuador</option>
                                            										   
										    <option value="58" >Estonia</option>
                                            										   
										    <option value="59" >Egypt</option>
                                            										   
										    <option value="60" >Western Sahara</option>
                                            										   
										    <option value="61" >Eritrea</option>
                                            										   
										    <option value="62" >Spain</option>
                                            										   
										    <option value="63" >Ethiopia</option>
                                            										   
										    <option value="64" >Finland</option>
                                            										   
										    <option value="65" >Fiji</option>
                                            										   
										    <option value="66" >Micronesia</option>
                                            										   
										    <option value="67" >Faroe Islands</option>
                                            										   
										    <option value="68" >France</option>
                                            										   
										    <option value="69" >Gabon</option>
                                            										   
										    <option value="70" >United Kingdom</option>
                                            										   
										    <option value="71" >Grenada</option>
                                            										   
										    <option value="72" >Georgia</option>
                                            										   
										    <option value="73" >French Guiana</option>
                                            										   
										    <option value="74" >Guernsey</option>
                                            										   
										    <option value="75" >Ghana</option>
                                            										   
										    <option value="76" >Greenland</option>
                                            										   
										    <option value="77" >Gambia</option>
                                            										   
										    <option value="78" >Guinea</option>
                                            										   
										    <option value="79" >Guadeloupe</option>
                                            										   
										    <option value="80" >Equatorial Guinea</option>
                                            										   
										    <option value="81" >Greece</option>
                                            										   
										    <option value="82" >Guatemala</option>
                                            										   
										    <option value="83" >Guam</option>
                                            										   
										    <option value="84" >Guinea-Bissau</option>
                                            										   
										    <option value="85" >Guyana</option>
                                            										   
										    <option value="86" >Hong Kong</option>
                                            										   
										    <option value="87" >Honduras</option>
                                            										   
										    <option value="88" >Croatia</option>
                                            										   
										    <option value="89" >Haiti</option>
                                            										   
										    <option value="90" >Hungary</option>
                                            										   
										    <option value="91" >Indonesia</option>
                                            										   
										    <option value="92" >Ireland</option>
                                            										   
										    <option value="93" >Israel</option>
                                            										   
										    <option value="94" >Isle Of Man</option>
                                            										   
										    <option value="95" >India</option>
                                            										   
										    <option value="96" >British Indian Ocean Territory</option>
                                            										   
										    <option value="97" >Iraq</option>
                                            										   
										    <option value="98" >Iran</option>
                                            										   
										    <option value="99" >Iceland</option>
                                            										   
										    <option value="100" >Italy</option>
                                            										   
										    <option value="101" >Jersey</option>
                                            										   
										    <option value="102" >Jamaica</option>
                                            										   
										    <option value="103" >Jordan</option>
                                            										   
										    <option value="104" >Japan</option>
                                            										   
										    <option value="105" >Kenya</option>
                                            										   
										    <option value="106" >Kyrgyzstan</option>
                                            										   
										    <option value="107" >Cambodia</option>
                                            										   
										    <option value="108" >Kiribati</option>
                                            										   
										    <option value="109" >Comoros</option>
                                            										   
										    <option value="110" >Saint Kitts And Nevis</option>
                                            										   
										    <option value="111" >North Korea</option>
                                            										   
										    <option value="112" >South Korea</option>
                                            										   
										    <option value="113" >Kuwait</option>
                                            										   
										    <option value="114" >Kazakhstan</option>
                                            										   
										    <option value="115" >Laos</option>
                                            										   
										    <option value="116" >Lebanon</option>
                                            										   
										    <option value="117" >Saint Lucia</option>
                                            										   
										    <option value="118" >Liechtenstein</option>
                                            										   
										    <option value="119" >Sri Lanka</option>
                                            										   
										    <option value="120" >Liberia</option>
                                            										   
										    <option value="121" >Lesotho</option>
                                            										   
										    <option value="122" >Lithuania</option>
                                            										   
										    <option value="123" >Luxembourg</option>
                                            										   
										    <option value="124" >Latvia</option>
                                            										   
										    <option value="125" >Libya</option>
                                            										   
										    <option value="126" >Morocco</option>
                                            										   
										    <option value="127" >Monaco</option>
                                            										   
										    <option value="128" >Moldova</option>
                                            										   
										    <option value="129" >Montenegro</option>
                                            										   
										    <option value="130" >Madagascar</option>
                                            										   
										    <option value="131" >Marshall Islands</option>
                                            										   
										    <option value="132" >Macedonia</option>
                                            										   
										    <option value="133" >Mali</option>
                                            										   
										    <option value="134" >Myanmar</option>
                                            										   
										    <option value="135" >Mongolia</option>
                                            										   
										    <option value="136" >Macao</option>
                                            										   
										    <option value="137" >Northern Mariana Islands</option>
                                            										   
										    <option value="138" >Martinique</option>
                                            										   
										    <option value="139" >Mauritania</option>
                                            										   
										    <option value="140" >Montserrat</option>
                                            										   
										    <option value="141" >Mauritius</option>
                                            										   
										    <option value="142" >Maldives</option>
                                            										   
										    <option value="143" >Malawi</option>
                                            										   
										    <option value="144" >Mexico</option>
                                            										   
										    <option value="145" >Malaysia</option>
                                            										   
										    <option value="146" >Mozambique</option>
                                            										   
										    <option value="147" >Namibia</option>
                                            										   
										    <option value="148" >New Caledonia</option>
                                            										   
										    <option value="149" >Niger</option>
                                            										   
										    <option value="150" >Nigeria</option>
                                            										   
										    <option value="151" >Nicaragua</option>
                                            										   
										    <option value="152" >Netherlands</option>
                                            										   
										    <option value="153" >Norway</option>
                                            										   
										    <option value="154" >Nepal</option>
                                            										   
										    <option value="155" >Nauru</option>
                                            										   
										    <option value="156" >New Zealand</option>
                                            										   
										    <option value="157" >Oman</option>
                                            										   
										    <option value="158" >Panama</option>
                                            										   
										    <option value="159" >Peru</option>
                                            										   
										    <option value="160" >French Polynesia</option>
                                            										   
										    <option value="161" >Papua New Guinea</option>
                                            										   
										    <option value="162" >Philippines</option>
                                            										   
										    <option value="163" >Pakistan</option>
                                            										   
										    <option value="164" >Poland</option>
                                            										   
										    <option value="165" >Saint Pierre And Miquelon</option>
                                            										   
										    <option value="166" >Puerto Rico</option>
                                            										   
										    <option value="167" >Palestinian Territory</option>
                                            										   
										    <option value="168" >Portugal</option>
                                            										   
										    <option value="169" >Palau</option>
                                            										   
										    <option value="170" >Paraguay</option>
                                            										   
										    <option value="171" >Qatar</option>
                                            										   
										    <option value="172" >Reunion</option>
                                            										   
										    <option value="173" >Romania</option>
                                            										   
										    <option value="174" >Serbia</option>
                                            										   
										    <option value="175" >Russia</option>
                                            										   
										    <option value="176" >Rwanda</option>
                                            										   
										    <option value="177" >Saudi Arabia</option>
                                            										   
										    <option value="178" >Solomon Islands</option>
                                            										   
										    <option value="179" >Seychelles</option>
                                            										   
										    <option value="180" >Sudan</option>
                                            										   
										    <option value="181" >Sweden</option>
                                            										   
										    <option value="182" >Singapore</option>
                                            										   
										    <option value="183" >Saint Helena</option>
                                            										   
										    <option value="184" >Slovenia</option>
                                            										   
										    <option value="185" >Svalbard And Jan Mayen</option>
                                            										   
										    <option value="186" >Slovakia</option>
                                            										   
										    <option value="187" >Sierra Leone</option>
                                            										   
										    <option value="188" >San Marino</option>
                                            										   
										    <option value="189" >Senegal</option>
                                            										   
										    <option value="190" >Somalia</option>
                                            										   
										    <option value="191" >Suriname</option>
                                            										   
										    <option value="192" >South Sudan</option>
                                            										   
										    <option value="193" >Sao Tome And Principe</option>
                                            										   
										    <option value="194" >El Salvador</option>
                                            										   
										    <option value="195" >Syria</option>
                                            										   
										    <option value="196" >Swaziland</option>
                                            										   
										    <option value="197" >Chad</option>
                                            										   
										    <option value="198" >French Southern Territories</option>
                                            										   
										    <option value="199" >Togo</option>
                                            										   
										    <option value="200" >Thailand</option>
                                            										   
										    <option value="201" >Tajikistan</option>
                                            										   
										    <option value="202" >Tokelau</option>
                                            										   
										    <option value="203" >East Timor</option>
                                            										   
										    <option value="204" >Turkmenistan</option>
                                            										   
										    <option value="205" >Tunisia</option>
                                            										   
										    <option value="206" >Tonga</option>
                                            										   
										    <option value="207" >Turkey</option>
                                            										   
										    <option value="208" >Trinidad And Tobago</option>
                                            										   
										    <option value="209" >Tuvalu</option>
                                            										   
										    <option value="210" >Taiwan</option>
                                            										   
										    <option value="211" >Tanzania</option>
                                            										   
										    <option value="212" >Ukraine</option>
                                            										   
										    <option value="213" >Uganda</option>
                                            										   
										    <option value="214" >United States Minor Outlying Islands</option>
                                            										   
										    <option value="215" >United States</option>
                                            										   
										    <option value="216" >Uruguay</option>
                                            										   
										    <option value="217" >Uzbekistan</option>
                                            										   
										    <option value="218" >Saint Vincent And The Grenadines</option>
                                            										   
										    <option value="219" >Venezuela</option>
                                            										   
										    <option value="220" >U.S. Virgin Islands</option>
                                            										   
										    <option value="221" >Vietnam</option>
                                            										   
										    <option value="222" >Vanuatu</option>
                                            										   
										    <option value="223" >Wallis And Futuna</option>
                                            										   
										    <option value="224" >Samoa</option>
                                            										   
										    <option value="225" >Kosovo</option>
                                            										   
										    <option value="226" >Yemen</option>
                                            										   
										    <option value="227" >Mayotte</option>
                                            										   
										    <option value="228" >South Africa</option>
                                            										   
										    <option value="229" >Zambia</option>
                                            										   
										    <option value="230" >Zimbabwe</option>
                                            										   
										    <option value="232" >Everywhere Else</option>
                                                                                      </optgroup>
                                       </select>
                                           </div>
                                                                                                                                                                                                                                                                                                                         
                                       </form>
                                    </li>   
                                	                                </ul>
                                                                <ul class="filter shop-in">
                                    <li class="input-group selected" id="shiptobox">Auction</li>
                                    
                                                                        
                                    <a href="#"><p style="margin: 5px 5px 5px 15px;"> Active </p></a>                                    <a href="http://192.168.1.251:8081/shopsy-v2/search/all?&product_type=Ended"><p style="margin: 5px 5px 5px 15px;"> Ended </p></a>                                </ul>
                                                            </div>
                        </div>
                   
					
					
                
                    	<div id="primary">
                        	<div id="search-header">
                            	
                                
                                
                                
                                	<ul class="search-restrictions">
                                                                        	<li> 71 Items</li>
                                        
                                    </ul>
                                    
                                    
                               
                     <div id="sort_header">
                         <div class="sort-options no-views btn-secondary">
                            <label>Sort by:</label>
                            <ul id="menu">
                                <li><a href="javascript:void(0);" id="order">
								
																
                                <img src="images/down_arrow.png"></a>
                                    <ul class="sub-menu">
                                    <span class="cursor"></span>
                                    <li><a href="#" id="Relevancy" class="">Most Recent</a></li>
                                    
                                    
                                    <li><a href="#" id="Alphabetical" class="">Relevancy</a></li>
                                     <li><a href="#" id="Highest" class="">Highest Price</a></li>
                                    <li><a href="#" id="Lowest" class="">Lowest Price</a></li>
                                </li>
                             </ul>
                                
                            </div>
                        </div>
                                
   
                            
                                <ul class="shiping-list">
                                                                
                          			                                
                                   	                                	                                   
                                </ul>
                            
                                
                            </div>
							
							<div id="freewall" class="free-wall" style="margin-bottom: 51px;"> 
							
                            <div id="tiles">
                        
                        	            	 <div class="brick">     
                    <div class="brick-hover">
                                <div class="product_hide">                                    
                                    <div class="product_fav">                             
										                                        <a href="#" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                         
                                    </div>  
                                     
                                    <div class="hoverdrop_icon">
                                    	<a href="javascript:hoverView('0');">  </a>
                                        	<div class="hover_lists" id="hoverlist0">
                                               	<h2>Your Lists</h2>
                                                <div class="lists_check">
                                                	                                                                                                         </div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="#">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="1703" name="productId" />
                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_0" />
                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('0');" />
                                                    </form>
                                                </div>
                                        	</div>
                                    	
                                   	</div>  
                               </div>
                      
                        <a href="#">
                            <img  src="images/theme/1439959362-art-941-dressing-table-dressing-tables-with-mirror.jpg" 
                              alt="fghf" title="fghf" width="100%" />
                        </a>
																									                    </div>
                                          
                    <div class="info">
						<h3>fghf</h3>
						<span class="cat-name"><a href="shop-section/ganesh-shop">Ganesh Shop</a></span>
						
						 <span class="cat-name cat-price">
					 
                        <span class="currency_value">$0.72+</span>
                        <span class="currency_code">USD</span>
                                            </span>
						
						</div>
                    
                   
                            
                </div> 
			            	 <div class="brick">     
                    <div class="brick-hover">
                                <div class="product_hide">                                    
                                    <div class="product_fav">                             
										                                        <a href="login" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                         
                                    </div>  
                                     
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
                      
                        <a href="#">
                            <img  src="images/theme/1439906515-pics-of-mehndi-designs-3-600x450.jpg" 
                              alt="Pivot Alibaba Light" title="Pivot Alibaba Light" width="100%" />
                        </a>
																									                    </div>
                                          
                    <div class="info">
						<h3>Pivot Alibaba Light</h3>
						<span class="cat-name"><a href="shop-section/chennai">chennai</a></span>
						
						 <span class="cat-name cat-price">
																	 <span class="currency_value" >$456.00</span>
						                        <span class="currency_code">USD</span>
                                            </span>
						
						</div>
                    
                   
                            
                </div> 
			            	 <div class="brick">     
                    <div class="brick-hover">
                                <div class="product_hide">                                    
                                    <div class="product_fav">                             
										                                        <a href="login" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                         
                                    </div>  
                                     
                                    <div class="hoverdrop_icon">
                                    	<a href="javascript:hoverView('2');">  </a>
                                        	<div class="hover_lists" id="hoverlist2">
                                               	<h2>Your Lists</h2>
                                                <div class="lists_check">
                                                	                                                                                                         </div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="#">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="1657" name="productId" />
                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_2" />
                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('2');" />
                                                    </form>
                                                </div>
                                        	</div>
                                    	
                                   	</div>  
                               </div>
                      
                        <a href="#">
                            <img  src="images/theme/1438696243-home-living-room-good-design-2-on-living-design-ideas.jpg" 
                              alt="Art Painiting" title="Art Painiting" width="100%" />
                        </a>
																									                    </div>
                                          
                    <div class="info">
						<h3>Art Painiting</h3>
						<span class="cat-name"><a href="shop-section/chennai">chennai</a></span>
						
						 <span class="cat-name cat-price">
																	 <span class="currency_value" >$224.08</span>
						                        <span class="currency_code">USD</span>
                                            </span>
						
						</div>
                    
                   
                            
                </div> 
			            	 <div class="brick">     
                    <div class="brick-hover">
                                <div class="product_hide">                                    
                                    <div class="product_fav">                             
										                                        <a href="#" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                         
                                    </div>  
                                     
                                    <div class="hoverdrop_icon">
                                    	<a href="javascript:hoverView('3');">  </a>
                                        	<div class="hover_lists" id="hoverlist3">
                                               	<h2>Your Lists</h2>
                                                <div class="lists_check">
                                                	                                                                                                         </div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="site/user/add_list">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="1563" name="productId" />
                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_3" />
                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('3');" />
                                                    </form>
                                                </div>
                                        	</div>
                                    	
                                   	</div>  
                               </div>
                      
                        <a href="#">
                            <img  src="images/theme/1433249329-16c03d44-d7b1-4c4f-aa54-a8ae2ab88d13.jpg" 
                              alt="suits" title="suits" width="100%" />
                        </a>
																									                    </div>
                                          
                    <div class="info">
						<h3>suits</h3>
						<span class="cat-name"><a href="shop-section/chennai">chennai</a></span>
						
						 <span class="cat-name cat-price">
					 
                        <span class="currency_value">$100.00+</span>
                        <span class="currency_code">USD</span>
                                            </span>
						
						</div>
                    
                   
                            
                </div> 
			            	 <div class="brick">     
                    <div class="brick-hover">
                                <div class="product_hide">                                    
                                    <div class="product_fav">                             
										                                        <a href="login" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                         
                                    </div>  
                                     
                                    <div class="hoverdrop_icon">
                                    	<a href="javascript:hoverView('4');">  </a>
                                        	<div class="hover_lists" id="hoverlist4">
                                               	<h2>Your Lists</h2>
                                                <div class="lists_check">
                                                	                                                                                                         </div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="site/user/add_list">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="1620" name="productId" />
                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_4" />
                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('4');" />
                                                    </form>
                                                </div>
                                        	</div>
                                    	
                                   	</div>  
                               </div>
                      
                        <a href="#">
                            <img  src="images/theme/1437472979-iphone_4s.png" 
                              alt="Auction quantity test product" title="Auction quantity test product" width="100%" />
                        </a>
																									                    </div>
                                          
                    <div class="info">
						<h3>Auction quantity test product</h3>
						<span class="cat-name"><a href="shop-section/chennai">chennai</a></span>
						
						 <span class="cat-name cat-price">
					 
                        <span class="currency_value">$10.00+</span>
                        <span class="currency_code">USD</span>
                                            </span>
						
						</div>
                    
                   
                            
                </div> 
			            	 <div class="brick">     
                    <div class="brick-hover">
                                <div class="product_hide">                                    
                                    <div class="product_fav">                             
										                                        <a href="#" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                         
                                    </div>  
                                     
                                    <div class="hoverdrop_icon">
                                    	<a href="javascript:hoverView('5');">  </a>
                                        	<div class="hover_lists" id="hoverlist5">
                                               	<h2>Your Lists</h2>
                                                <div class="lists_check">
                                                	                                                                                                         </div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="#">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="1560" name="productId" />
                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_5" />
                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('5');" />
                                                    </form>
                                                </div>
                                        	</div>
                                    	
                                   	</div>  
                               </div>
                      
                        <a href="#">
                            <img  src="images/theme/1433246639-luxury-heels-womens-shoes-30092402-800-600.jpg" 
                              alt="high heel cut shoe" title="high heel cut shoe" width="100%" />
                        </a>
																									                    </div>
                                          
                    <div class="info">
						<h3>high heel cut shoe</h3>
						<span class="cat-name"><a href="shop-section/chennai">chennai</a></span>
						
						 <span class="cat-name cat-price">
					 
                        <span class="currency_value">$200.00+</span>
                        <span class="currency_code">USD</span>
                                            </span>
						
						</div>
                    
                   
                            
                </div> 
			            	 <div class="brick">     
                    <div class="brick-hover">
                                <div class="product_hide">                                    
                                    <div class="product_fav">                             
										                                        <a href="#" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                         
                                    </div>  
                                     
                                    <div class="hoverdrop_icon">
                                    	<a href="javascript:hoverView('6');">  </a>
                                        	<div class="hover_lists" id="hoverlist6">
                                               	<h2>Your Lists</h2>
                                                <div class="lists_check">
                                                	                                                                                                         </div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="#">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="1590" name="productId" />
                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_6" />
                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('6');" />
                                                    </form>
                                                </div>
                                        	</div>
                                    	
                                   	</div>  
                               </div>
                      
                        <a href="#">
                            <img  src="images/theme/1435211201-48a81.jpg" 
                              alt="Dining Table" title="Dining Table" width="100%" />
                        </a>
																											<div class="offer-tag">
									<p class="off-price">5% 0ff</p>
								</div>
								
	                         </div>
                     		  
		  		  <!--<div data-countdown="2015-08-28 11:31:26" >
		  </div>-->
		                       
                    <div class="info">
						<h3>Dining Table</h3>
						<span class="cat-name"><a href="shop-section/chennai">chennai</a></span>
						
						 <span class="cat-name cat-price">
											                        <span class="currency_value" style="text-decoration:line-through;">$100.00</span>
						<span class="currency_value" >$95.00</span>
						                        <span class="currency_code">USD</span>
                                            </span>
						
						</div>
                    
                   
                            
                </div> 
			            	 <div class="brick">     
                    <div class="brick-hover">
                                <div class="product_hide">                                    
                                    <div class="product_fav">                             
										                                        <a href="#" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                         
                                    </div>  
                                     
                                    <div class="hoverdrop_icon">
                                    	<a href="javascript:hoverView('7');">  </a>
                                        	<div class="hover_lists" id="hoverlist7">
                                               	<h2>Your Lists</h2>
                                                <div class="lists_check">
                                                	                                                                                                         </div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="site/user/add_list">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="1611" name="productId" />
                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_7" />
                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('7');" />
                                                    </form>
                                                </div>
                                        	</div>
                                    	
                                   	</div>  
                               </div>
                      
                        <a href="#	">
                            <img  src="images/theme/1436851583-chrysanthemum.jpg" 
                              alt="bag" title="bag" width="100%" />
                        </a>
																											<div class="offer-tag">
									<p class="off-price">20% 0ff</p>
								</div>
								
	                         </div>
                     		  
		  		  <!--<div data-countdown="2015-08-28 11:31:26" >
		  </div>-->
		                       
                    <div class="info">
						<h3>bag</h3>
						<span class="cat-name"><a href="shop-section/chennai">chennai</a></span>
						
						 <span class="cat-name cat-price">
											                        <span class="currency_value" style="text-decoration:line-through;">$25.00</span>
						<span class="currency_value" >$20.00</span>
						                        <span class="currency_code">USD</span>
                                            </span>
						
						</div>
                    
                   
                            
                </div> 
			            	 <div class="brick">     
                    <div class="brick-hover">
                                <div class="product_hide">                                    
                                    <div class="product_fav">                             
										                                        <a href="#" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                         
                                    </div>  
                                     
                                    <div class="hoverdrop_icon">
                                    	<a href="javascript:hoverView('8');">  </a>
                                        	<div class="hover_lists" id="hoverlist8">
                                               	<h2>Your Lists</h2>
                                                <div class="lists_check">
                                                	                                                                                                         </div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="#">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="1593" name="productId" />
                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_8" />
                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('8');" />
                                                    </form>
                                                </div>
                                        	</div>
                                    	
                                   	</div>  
                               </div>
                      
                        <a href="#">
                            <img  src="images/theme/1435320035-lg-tv.jpg" 
                              alt="TV" title="TV" width="100%" />
                        </a>
																									                    </div>
                                          
                    <div class="info">
						<h3>TV</h3>
						<span class="cat-name"><a href="#">chennai</a></span>
						
						 <span class="cat-name cat-price">
																	 <span class="currency_value" >$200.00</span>
						                        <span class="currency_code">USD</span>
                                            </span>
						
						</div>
                    
                   
                            
                </div> 
			            	 <div class="brick">     
                    <div class="brick-hover">
                                <div class="product_hide">                                    
                                    <div class="product_fav">                             
										                                        <a href="login" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                         
                                    </div>  
                                     
                                    <div class="hoverdrop_icon">
                                    	<a href="javascript:hoverView('9');">  </a>
                                        	<div class="hover_lists" id="hoverlist9">
                                               	<h2>Your Lists</h2>
                                                <div class="lists_check">
                                                	                                                                                                         </div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="#">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="1637" name="productId" />
                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_9" />
                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('9');" />
                                                    </form>
                                                </div>
                                        	</div>
                                    	
                                   	</div>  
                               </div>
                      
                        <a href="#">
                            <img  src="images/theme/1437730206-chrysanthemum.jpg" 
                              alt="234" title="234" width="100%" />
                        </a>
																											<div class="offer-tag">
									<p class="off-price">10% 0ff</p>
								</div>
								
	                         </div>
                     		  
		  		  <!--<div data-countdown="2015-08-28 11:31:26" >
		  </div>-->
		                       
                    <div class="info">
						<h3>234</h3>
						<span class="cat-name"><a href="shop-section/chennai">chennai</a></span>
						
						 <span class="cat-name cat-price">
											                        <span class="currency_value" style="text-decoration:line-through;">$123.00</span>
						<span class="currency_value" >$110.70</span>
						                        <span class="currency_code">USD</span>
                                            </span>
						
						</div>
                    
                   
                            
                </div> 
			            	 <div class="brick">     
                    <div class="brick-hover">
                                <div class="product_hide">                                    
                                    <div class="product_fav">                             
										                                        <a href="#" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                         
                                    </div>  
                                     
                                    <div class="hoverdrop_icon">
                                    	<a href="javascript:hoverView('10');">  </a>
                                        	<div class="hover_lists" id="hoverlist10">
                                               	<h2>Your Lists</h2>
                                                <div class="lists_check">
                                                	                                                                                                         </div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="#">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="1639" name="productId" />
                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_10" />
                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('10');" />
                                                    </form>
                                                </div>
                                        	</div>
                                    	
                                   	</div>  
                               </div>
                      
                        <a href="#">
                            <img  src="images/theme/1437989094-menswear-monday-pinterest-inspiration-4.jpg" 
                              alt="Testing a Product listing" title="Testing a Product listing" width="100%" />
                        </a>
																									                    </div>
                                          
                    <div class="info">
						<h3>Testing a Product listing</h3>
						<span class="cat-name"><a href="shop-section/chennai">chennai</a></span>
						
						 <span class="cat-name cat-price">
					 
                        <span class="currency_value">$200.00+</span>
                        <span class="currency_code">USD</span>
                                            </span>
						
						</div>
                    
                   
                            
                </div> 
			            	 <div class="brick">     
                    <div class="brick-hover">
                                <div class="product_hide">                                    
                                    <div class="product_fav">                             
										                                        <a href="login" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>
                                         
                                    </div>  
                                     
                                    <div class="hoverdrop_icon">
                                    	<a href="javascript:hoverView('11');">  </a>
                                        	<div class="hover_lists" id="hoverlist11">
                                               	<h2>Your Lists</h2>
                                                <div class="lists_check">
                                                	                                                                                                         </div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="site/user/add_list">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="1676" name="productId" />
                                                        <input type="text" placeholder="New list" class="list_scroll" name="list" id="creat_list_11" />
                                                        <input type="submit" value="Add" class="primary-button" onclick="return validate_create_list('11');" />
                                                    </form>
                                                </div>
                                        	</div>
                                    	
                                   	</div>  
                               </div>
                      
                        <a href="#">
                            <img  src="images/theme/1438934784-12pc-white-sport-goose-font-b-feather-b-font-font-b-shuttlecocks-b-font-birdies-badminton.jpg" 
                              alt="Pivot Alibaba Light" title="Pivot Alibaba Light" width="100%" />
                        </a>
																									                    </div>
                                          
                    <div class="info">
						<h3>Pivot Alibaba Light</h3>
						<span class="cat-name"><a href="shop-section/ganesh-shop">Ganesh Shop</a></span>
						
						 <span class="cat-name cat-price">
																	 <span class="currency_value" >$564.10</span>
						                        <span class="currency_code">USD</span>
                                            </span>
						
						</div>
                    
                   
                            
                </div> 
									
						 <a title="1" class="landing-btn-more" href="#" style="display: none;">See More Products</a>                        </div>
						
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
						<div id="load_ajax_img" style="text-align: center;"></div>
                        </div>
						
						
                    </div>
						
						
						
						</div>
            </div>
        </div>
    
    
    </section>

<script>
$(document).ready(function(e) {
    $('#change_location').click(function(){
	$('#shop-location-display').html('<form action="http://192.168.1.251:8081/shopsy-v2/search/all" method="get"> <input style="width:155px" type="text" id="" value="" name="location" class="location-change"><span class="button-small button-small-grey"><span><input style="width:30px;padding: 7px 0;margin: 0;" type="submit" title="OK" value="►" id="locchangeButton"></span></span></form>');
	});
});



$(document).ready(function(e) {
    $('#change_shipto').click(function(){
	$('#ship-to-change').html('<form action="http://192.168.1.251:8081/shopsy-v2/search/all" method="get"><div class="shiping-region"><select name="shipto" onchange="this.form.submit()" id="shipto"><option value="">Choose country...</option><optgroup label="————————"><option value="1">Andorra</option><option value="2">United Arab Emirates</option><option value="3">Afghanistan</option><option value="4">Antigua And Barbuda</option><option value="5">Albania</option><option value="6">Armenia</option><option value="7">Angola</option><option value="8">Antarctica</option><option value="9">Argentina</option><option value="10">American Samoa</option><option value="11">Austria</option><option value="12">Australia</option><option value="13">Aruba</option><option value="14">Aland Islands</option><option value="15">Azerbaijan</option><option value="16">Bosnia And Herzegovina</option><option value="17">Barbados</option><option value="18">Bangladesh</option><option value="19">Belgium</option><option value="20">Burkina Faso</option><option value="21">Bulgaria</option><option value="22">Bahrain</option><option value="23">Burundi</option><option value="24">Benin</option><option value="25">Bermuda</option><option value="26">Brunei</option><option value="27">Bolivia</option><option value="28">Bonaire, Saint Eustatius And Saba </option><option value="29">Brazil</option><option value="30">Bahamas</option><option value="31">Bhutan</option><option value="32">Bouvet Island</option><option value="33">Botswana</option><option value="34">Belarus</option><option value="35">Belize</option><option value="36">Canada</option><option value="37">Democratic Republic Of The Congo</option><option value="38">Central African Republic</option><option value="39">Republic Of The Congo</option><option value="40">Switzerland</option><option value="41">Ivory Coast</option><option value="42">Chile</option><option value="43">Cameroon</option><option value="44">China</option><option value="45">Colombia</option><option value="46">Costa Rica</option><option value="47">Cuba</option><option value="48">Cape Verde</option><option value="49">Cyprus</option><option value="50">Czech Republic</option><option value="51">Germany</option><option value="52">Djibouti</option><option value="53">Denmark</option><option value="54">Dominica</option><option value="55">Dominican Republic</option><option value="56">Algeria</option><option value="57">Ecuador</option><option value="58">Estonia</option><option value="59">Egypt</option><option value="60">Western Sahara</option><option value="61">Eritrea</option><option value="62">Spain</option><option value="63">Ethiopia</option><option value="64">Finland</option><option value="65">Fiji</option><option value="66">Micronesia</option><option value="67">Faroe Islands</option><option value="68">France</option><option value="69">Gabon</option><option value="70">United Kingdom</option><option value="71">Grenada</option><option value="72">Georgia</option><option value="73">French Guiana</option><option value="74">Guernsey</option><option value="75">Ghana</option><option value="76">Greenland</option><option value="77">Gambia</option><option value="78">Guinea</option><option value="79">Guadeloupe</option><option value="80">Equatorial Guinea</option><option value="81">Greece</option><option value="82">Guatemala</option><option value="83">Guam</option><option value="84">Guinea-Bissau</option><option value="85">Guyana</option><option value="86">Hong Kong</option><option value="87">Honduras</option><option value="88">Croatia</option><option value="89">Haiti</option><option value="90">Hungary</option><option value="91">Indonesia</option><option value="92">Ireland</option><option value="93">Israel</option><option value="94">Isle Of Man</option><option value="95">India</option><option value="96">British Indian Ocean Territory</option><option value="97">Iraq</option><option value="98">Iran</option><option value="99">Iceland</option><option value="100">Italy</option><option value="101">Jersey</option><option value="102">Jamaica</option><option value="103">Jordan</option><option value="104">Japan</option><option value="105">Kenya</option><option value="106">Kyrgyzstan</option><option value="107">Cambodia</option><option value="108">Kiribati</option><option value="109">Comoros</option><option value="110">Saint Kitts And Nevis</option><option value="111">North Korea</option><option value="112">South Korea</option><option value="113">Kuwait</option><option value="114">Kazakhstan</option><option value="115">Laos</option><option value="116">Lebanon</option><option value="117">Saint Lucia</option><option value="118">Liechtenstein</option><option value="119">Sri Lanka</option><option value="120">Liberia</option><option value="121">Lesotho</option><option value="122">Lithuania</option><option value="123">Luxembourg</option><option value="124">Latvia</option><option value="125">Libya</option><option value="126">Morocco</option><option value="127">Monaco</option><option value="128">Moldova</option><option value="129">Montenegro</option><option value="130">Madagascar</option><option value="131">Marshall Islands</option><option value="132">Macedonia</option><option value="133">Mali</option><option value="134">Myanmar</option><option value="135">Mongolia</option><option value="136">Macao</option><option value="137">Northern Mariana Islands</option><option value="138">Martinique</option><option value="139">Mauritania</option><option value="140">Montserrat</option><option value="141">Mauritius</option><option value="142">Maldives</option><option value="143">Malawi</option><option value="144">Mexico</option><option value="145">Malaysia</option><option value="146">Mozambique</option><option value="147">Namibia</option><option value="148">New Caledonia</option><option value="149">Niger</option><option value="150">Nigeria</option><option value="151">Nicaragua</option><option value="152">Netherlands</option><option value="153">Norway</option><option value="154">Nepal</option><option value="155">Nauru</option><option value="156">New Zealand</option><option value="157">Oman</option><option value="158">Panama</option><option value="159">Peru</option><option value="160">French Polynesia</option><option value="161">Papua New Guinea</option><option value="162">Philippines</option><option value="163">Pakistan</option><option value="164">Poland</option><option value="165">Saint Pierre And Miquelon</option><option value="166">Puerto Rico</option><option value="167">Palestinian Territory</option><option value="168">Portugal</option><option value="169">Palau</option><option value="170">Paraguay</option><option value="171">Qatar</option><option value="172">Reunion</option><option value="173">Romania</option><option value="174">Serbia</option><option value="175">Russia</option><option value="176">Rwanda</option><option value="177">Saudi Arabia</option><option value="178">Solomon Islands</option><option value="179">Seychelles</option><option value="180">Sudan</option><option value="181">Sweden</option><option value="182">Singapore</option><option value="183">Saint Helena</option><option value="184">Slovenia</option><option value="185">Svalbard And Jan Mayen</option><option value="186">Slovakia</option><option value="187">Sierra Leone</option><option value="188">San Marino</option><option value="189">Senegal</option><option value="190">Somalia</option><option value="191">Suriname</option><option value="192">South Sudan</option><option value="193">Sao Tome And Principe</option><option value="194">El Salvador</option><option value="195">Syria</option><option value="196">Swaziland</option><option value="197">Chad</option><option value="198">French Southern Territories</option><option value="199">Togo</option><option value="200">Thailand</option><option value="201">Tajikistan</option><option value="202">Tokelau</option><option value="203">East Timor</option><option value="204">Turkmenistan</option><option value="205">Tunisia</option><option value="206">Tonga</option><option value="207">Turkey</option><option value="208">Trinidad And Tobago</option><option value="209">Tuvalu</option><option value="210">Taiwan</option><option value="211">Tanzania</option><option value="212">Ukraine</option><option value="213">Uganda</option><option value="214">United States Minor Outlying Islands</option><option value="215">United States</option><option value="216">Uruguay</option><option value="217">Uzbekistan</option><option value="218">Saint Vincent And The Grenadines</option><option value="219">Venezuela</option><option value="220">U.S. Virgin Islands</option><option value="221">Vietnam</option><option value="222">Vanuatu</option><option value="223">Wallis And Futuna</option><option value="224">Samoa</option><option value="225">Kosovo</option><option value="226">Yemen</option><option value="227">Mayotte</option><option value="228">South Africa</option><option value="229">Zambia</option><option value="230">Zimbabwe</option><option value="232">Everywhere Else</option></optgroup></select></div></form>');
	});
});
</script><!--
<script src="js/site/scrolling_javascript.js"> </script>
<script>

$(document).ready(function() {

		$('#search_results').scrollPagination({
		
		//alert('site/product/ajax_search_product/search/all?violet');
			nop     : 10, // The number of posts per scroll to be loaded
			offset  : 6, // Initial offset, begins at 0 in this case
			error   : '', // When the user reaches the end this is the message that is
		                            // displayed. You can change this if you want.
			path   : 'site/product/ajax_search_product/search/all?violet',
			delay   : 200, // When you scroll down the posts will load after a delayed amount of time.
		               // This is mainly for usability concerns. You can alter this as you see fit
			scroll  : false // The main bit, if set to false posts will not load as the user scrolls. 
		               // but will still load if the user clicks.		
		});	
	
});

</script> -->

<style>
.loading-bar {
	border: 1px solid #DDDDDD;
    border-radius: 5px;
    box-shadow: 0 -45px 30px -40px rgba(0, 0, 0, 0.05) inset;
    clear: both;
    cursor: pointer;
    display: block;
    float: none;
    font-family: "museo-sans",sans-serif;
    font-size: 2em;
    font-weight: bold;
    margin: 20px 0px 20px 0;
    padding: 10px 0px;
    position: relative;
    text-align: center;
    width: 100%;
}
.loading-bar:hover {
	box-shadow: inset 0px 45px 30px -40px rgba(0, 0, 0, 0.05);
}
.standardized_filters {
    float: left;
    width: 30%;
}
.product-search-page {
    float: left;
    width: 70%;
}
.product-search-page .product_listing li {
    height: 220px;
    margin: 0 0 24px 25px;
    width: 208px;
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
													
									<input type="hidden" name="returnUrl" value="http://192.168.1.251:8081/shopsy-v2/search/all">
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
<script>
	$('a').click(function(){
		alert('You are in preview mode');
		return false;
	});
</script>

</body>
</html>