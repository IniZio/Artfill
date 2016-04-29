<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php	
require_once 'theme_index.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!---->

<meta name="viewport" content="width=device-width, initial-scale=1">





<?php
	$base_path= $instance->config->item('base_url');
?>
<base href="<?php echo $base_path; ?>" />

<script>
	$('a').click(function(){
		alert('You are in preview mode');
		return false;
	});
</script>

			<title>Shop</title>
		
<meta name="Title" content="Shop" />
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
<link href="./theme/themecss_.css" rel="stylesheet">
<div class="errorContainer" id="message-green"> 
  <script>setTimeout("hideErrDiv('message-green')", 5000);</script>
 
  
  <p><span> Welcome, Admin </span></p>
</div>

<body class="bodybg">


<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- css -->
<link href='//fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/default/site/base.css" />
<link rel="stylesheet" href="css/default/site/style-menu.css" />
   
<!-- js -->
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<script>
    $(document).ready(function(){
        $("#nav-mobile").html($("#nav-main").html());
        $("#nav-trigger span").click(function(){
            if ($("nav#nav-mobile ul").hasClass("expanded")) {
                $("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
                $(this).removeClass("open");
            } else {
                $("nav#nav-mobile ul").addClass("expanded").slideDown(250);
                $(this).addClass("open");
            }
        });
    });
</script>

<style>

<?php	
	$instance->load->library('session');
	if($instance->session->userdata('Curr_theme_name') != "") {
?>
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>header.css" rel="stylesheet">
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>footer.css" rel="stylesheet">
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>User-Shop-page.css" rel="stylesheet">
<?php 
	}
?>

#you1{
	background: url(images/users/thumb/9002.jpg) no-repeat scroll ;
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
<header>
  <div class="main-4">
    <div class="header_top">
	<div class="container top">
	<div class="row">
	
		<div class="col-md-12 signin sign-mobile"> 					
						<span class="shop-cart"> 
							<a href="cart"><i class="fa fa-shopping-cart icon-shopping"></i> Cart 
							<span id="CartCount1" class="CartCount1"> 0</span>
						</a>
						</span>
				</div>
				
				
      <div class="col-md-2 col-xs-2" id="logo">
						<a href="http://192.168.1.251:8081/shopsy-v2/">
							<img src="images/logo/logo2.png"  alt="Shopsy V2" title="Shopsy V2">
						</a>
				     </div>
      
	  <div class="col-md-3 search-bl col-xs-6 ">				
						<form name="search" action="search/all" method="get">
							<input type="text" class="search" name="item" placeholder="Search for items and shops" value="" id="search_items" autocomplete="off" >
														 								 																				
							<input type="submit" value="Search" class="search-bt">			
						</form>
						<div id="sugglist"></div>
				  </div>
					
				 <div class="btn-group col-md-1 act-browse-bt col-xs-6">
					<button type="button" class="btn btn-default dropdown-toggle browse " data-toggle="dropdown" aria-expanded="false"> Browse						<span class="caret"></span> 
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
						<!--<i class="fa fa-bell"></i>-->
						 <span class="shop-cart"> 
						     <a href="cart"><i class="fa fa-shopping-cart icon-shopping"></i> </a>
						     <a class="cart-txt" href="cart">Cart							<span id="CartCount1" class="CartCount1"> 0</span>
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
								<a id="favorites" href="people/admin/favorites" title="Favorites">
									<span class="icon-text">Favorites</span>
								</a>
							</li>
							
							<li>
								<a href="shop/sell" id="shop" title="You Shop">
									 									<span class="icon-text">Your Shop</span>
																	</a>
								
							</li>
							
							
						    <li>
								<a id="location" href="shop-by-location">
								<span class="icon-text">By Location</span>															
								</a>
								
							</li>
							
							<li>

								<a class="dropdown-toggle browse "  data-toggle="dropdown" id="you1" title="You">
									<span class="icon-text">
									You									
																		<span class="notification-count" id="notificationCount">2</span> 
																		</span>
								</a>
								<i></i>
							
								<ul class="dropdown-menu browse-nav-inner showlist2" role="you">
											<span class="menuarrow"></span>
											`
									
									 <li class="first">
										<div class="drop_right_main">
											<div class="user_img">
																							<img src="images/users/thumb/9002.jpg" />
											</div>
											<div class="drop_right"><strong>admin</strong><span><a href="view-profile/admin" class="view-btn1">View Profile</a></span></div>							
										</div>
									</li>
									<li><a style="padding: 0 20px;" href="activity">
									<small>Activity</small>
																		</a>
									</li>
									
																		<li>
										<a style="padding: 0 20px;" href="admin/notifications">
										<small>Notifications</small>
										<span class="notification-list-count">2</span> 
										</a>
									</li>
																		
									
									<li><a href="purchase-review">Purchases</a></li>
									<li><a href="reviews">Reviews</a></li>
									<li><a href="disputes">Disputes</a></li>
									<li><a href="manage-community">Manage Community</a></li>
									<li><a href="public-profile">Public Profile</a></li>
									<li><a href="settings/my-account/admin">Account Settings</a></li>
									<li><a href="affiliate_clicks">Affiliate clicks</a></li>									
									<li class="last"><a href="logout">Sign Out</a></li> 																		
								</ul>							
							</li>									   
						</ul>
				  
				    </div>
			</div>
		</div>
    </div>

  </div>
</header>
 <div class="add_shop">
  <div class="main">
	
	<!--<div id="flip">Menu</div>-->
	<div id="nav-trigger">
            <span>Menu</span>
    </div>
	<nav id="nav-main">
    <ul id="panel" class="add_steps" style="background:none; box-shadow:none;">
      
      
      
      <li  >
      <a title="Choose Your Shop Name" 
            href="appearance/chennai/banner" 
            class=" ">
      <div class="name-inner">Shop Info<span class="complete-indicator"></span></div>
      </a>
      </li>
        
        
      <li   >
					<a href="shops/chennai/sections/All">
				<div class="name-inner">Shop Section<span class="complete-indicator"></span></div>
			</a>
			
	 </li>
	 
      <li >
                	<a title="What are you going to sell? Add and edit listings here." href="shop/listitem" class=" "> 
			<div class="name-inner">Add Items</div></a>
              </li>

		 <li  >
                  	<a title="Manage your listings here." href="shop/managelistings" class=""> 
				<div class="name-inner">Manage items</div>
			</a>
                </li>
		
      <li  ><a style="padding:0px !important;" href="javascript:void(0)"><div class="name-inner">Payment Settings<b class="caret" style="position: static;"></b></div></a>
	
		<ul class="add_shop_drop_down">
		   <li>
		        		        <a title="Choose your shop payment methods." href="shop/payment" class="  " ><div class="name-inner">Get Paid</div></a>
		        			</li>
			
			   
		        
		</ul>
   	</li>     
        
        
                	<li  >
                	<a href="offers/1/my-offer/sell">
						<div class="name-inner">
							Your Offers						</div>
					</a>
                </li>
                        
              
    </ul>
  </nav>
        <nav id="nav-mobile"></nav>
  </div>
</div>
<script>
function hideErrDiv(arg) {
    document.getElementById(arg).style.display = 'none';
}
</script> 
<script src="js/site/main.js" type="text/javascript"></script>
<div style='display:none'>
  <div id='inline' style='background:#F5F5F1; border-radius:5px'> 
  <div style="padding: 20px 30px; border-radius:5px 5px 0 0" class="global-header"><h2 style="color: #555555;">Welcome to our Global Community of Sellers!</h2></div>
   <div style="background:#fff; border-radius:0 0 5px 5px" class="global-section glob-sugession">
   <p>Reach Shopsy Buyers, I already sell full time</p>
   <p>Quit my day job to sell full time</p>
    <p>Sell in my spare time</p>
     <p>other</p><input type="text" placeholder="other"></div>
    
    
  </div>
</div>




<style>

#{
	position:absolute;
	border:1px solid #333;
	background:#333333;
	padding:2px 5px;
	color:#FFFFFF;
	display:none;
    
    top:40px;
	border-radius: 3px;
	width:200px;
	float:left;
	padding: 3px 6px;
	
	font-size: 13px;
	z-index:9999;
    font-weight: normal;
}




</style>
	
		
		<link rel="stylesheet" href="css/default/front/main.css">

<div class="clear"></div>
<section class="container">

		<div class="main">
		
		<ul class="bread_crumbs">
        	<li><a href="http://192.168.1.251:8081/shopsy-v2/" class="a_links">Home</a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links">Your Shop</a></li>
        </ul>
		
		
		
        	<div  class="shop_view">
			
			<div class="shop-main-1">
            	
                <div class="shop_view_right">


					
                    <!---  Shop Owner section Ends---->
					</div>
                	   <div class="shopview_info shop-detail" style="text-align:center; margin-bottom:0; background:#fff;">                
                    	  
                         
							<div class="shp-sell-banner">
                            <a href="shop/sell">
                                <img src="images/store-banner/Hydrangeas.jpg" width="1000px" height="315px">
                            </a>
							</div>
                        						
                    	
							
							<div class="shop_view_left1">
					
						
                    
                    <!--- Shop Owner section Starts---->
						<div class="shopview_info profile-info-img">                    							
						<!--<div class="shop-info-detail">
                    	<p style="font-size:12px; float:left;"><strong>Shop Owner</strong></p>
                        <a href="shops/chennai/profile" style="float:right; margin:0 10px 0 0px">Edit</a>
						
						</div>-->
                        <div style="float:left; width:100%; margin:0" >
                        	<a  style="cursor:default;float:left; width:100%; "><img src="images/users/thumb/9002.jpg"  /></a>
                                                    </div>
                        <a  style="cursor:default;float:left; text-align: center; font-size:12px; color:#666666; width:100%; font-weight:bold">admin</a>
                        
                    </div>
							
					</div></div>		
							<div class="shop_view_text">
								<a style="cursor:default;font-size:14px; font-weight:bold; line-height:24px; float:left;  text-decoration:none;">
								chennai								</a>
								<div class="opented" style="font-size:11px; color:#fff;">Opened on </div>
							</div>
							<div class="shop-owner-text">
								<ul><li>
								<a href="appearance/chennai/banner" class="inline-edit-link" style="font-size:15px; font-weight:bold;">Edit</a> 
								</li></ul>
							</div>
							 <!--- Shop Policy section Starts---->
                                        
                    <div id="shop-info" class="shopview_info">
                    	<ul>
                    	<li>
                    	<a href="policies/chennai/shop-policy">Add shop policies</a>
                    	</li>
                    	<li style="margin-left:450px;"><input type="checkbox" name="gcardaccept" id="gcardaccept" value="yes" checked onchange="valchecked(this);"> Accept gift card</li>
							</ul>
                    </div>
                    							
                        
                    
                    
                    
                    <!--                    	<div class="shop_name2" style="background:#E9E9E9;">
                        <a href="appearance/chennai/shop-announcement" class="inline-edit-link1" style="font-size:9px; font-weight:bold;">Edit</a>
                    	<span style="float:left; margin:5px 0 5px 18px;">hi this my shop,come to the shopping world!!!!</span>
                        </div>
                    -->			   
                    <div class="list_wrap">
                    	<link rel="stylesheet" href="css/default/front/main.css">
 <script type="text/javascript" src="js/front/freewall.js"></script>


 <div style="text-align: center;padding: 0px 0px 12px 0px;"><h4>Published Products</h4></div>

 <div id="freewall" class="free-wall" style="margin-bottom: 51px;"> 
 
 
					<div id="tiles">                       	

                            
                             <div class="brick">  
                            <a href="edit-product/pivot-alibaba-light-8">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1439906515-pics-of-mehndi-designs-3-600x450.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Pivot Alibaba Light. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 456.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/clothes">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438934784-12pc-white-sport-goose-font-b-feather-b-font-font-b-shuttlecocks-b-font-birdies-badminton.jpg"  />
																																				  <div class="offer-tag" >
									<p class="off-price">224% 0ff</p>
								</div>
		  
		  
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">clothes. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    		  
		  		  <div data-countdown="2015-08-14 00:30:00" >
		  </div>
		  			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" style='text-decoration:line-through;'><span>$</span> 100.00</span>
                                        <span class="currency_code"> AUD</span>
												 <span class="dolar-value">100.00</span>

                                        <span class="currency_code">AUD</span>
		
									
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/shopsy">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438944331-colorful-flowers-flower-hd-wallpaper.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">shopsy. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 12,123.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/asdf">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438869239-3d_equalizer_music_wallpapers_hd_48_photos_wus.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">asdf. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 16,273.65</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/sdfg">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438867882-61ilzr59kbl.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">sdfg. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 1,000.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/jewelery">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438866142-81iovdzwofl._UL1500_"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">jewelery. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 100.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/barbie-1">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438848465-free-shipping-font-b-black-b-font-clothes-font-b-dress-b-font-for-font-b.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">barbie. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 1,000.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/barbie">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438848303-12pc-white-sport-goose-font-b-feather-b-font-font-b-shuttlecocks-b-font-birdies-badminton.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">barbie. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 1,089,326.84</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/furnitures">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438699140-modern-dining-tables-brisbane.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Furnitures. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 10.65</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/art-painiting-1">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438696243-home-living-room-good-design-2-on-living-design-ideas.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Art Painiting. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 224.08</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/testing-product-for-rs">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438695879-eyeglasses-frame-men-titanium-glasses-box-ultra-light-tr90-male-big-frame-glasses-1.png"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Testing product for Rs. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 10.60</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/new-tesr">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438693107-lane-crawford-the-portfolio-menswear-spring-summer-2010-but-sou-lai-06.jpg"  />
																																				  <div class="offer-tag" >
									<p class="off-price">10% 0ff</p>
								</div>
		  
		  
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">New Tesr. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    		  
		  		  <div data-countdown="2015-08-29 02:00:00" >
		  </div>
		  			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" style='text-decoration:line-through;'><span>$</span> 200.00</span>
                                        <span class="currency_code"> AUD</span>
												 <span class="dolar-value">200.00</span>

                                        <span class="currency_code">AUD</span>
		
									
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/art-painiting">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438692843-menswear-monday-pinterest-inspiration-4.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Art Painiting. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 2.12</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/test-art-work">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438689337-menswear-monday-pinterest-inspiration-4.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Test Art work. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 200.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/test-product-for-tax">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438675255-img_2445.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Test Product for tax. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 500.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/casual-shirtsss">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438580249-ffgfgf.jpeg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Casual Shirtsss. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 40.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/classic-wardrobe">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438579726-images_5.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">classic wardrobe. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 100.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/as">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1437996795-chrysanthemum.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">as. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 10.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/testing-a-product-listing">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1437989094-menswear-monday-pinterest-inspiration-4.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Testing a Product listing. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        +
                                        <span class="currency_value" ><span>$</span> 200.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/234">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1437730206-chrysanthemum.jpg"  />
																																				  <div class="offer-tag" >
									<p class="off-price">10% 0ff</p>
								</div>
		  
		  
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">234. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    		  
		  		  <div data-countdown="2015-07-25 01:00:00" >
		  </div>
		  			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" style='text-decoration:line-through;'><span>$</span> 123.00</span>
                                        <span class="currency_code"> AUD</span>
												 <span class="dolar-value">123.00</span>

                                        <span class="currency_code">AUD</span>
		
									
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/dgh">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1437659832-16c03d44-d7b1-4c4f-aa54-a8ae2ab88d13.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">dgh. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 234.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/max-audio-controller">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1437481667-max.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Max audio controller. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 10.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/adf">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1437478128-beech80.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">adf. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 213.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/auction-quantity-test-product">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1437472979-iphone_4s.png"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Auction quantity test product. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        +
                                        <span class="currency_value" ><span>$</span> 10.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/art-test">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1437132029-3-fixtures.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Art Test. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 100.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/product-title">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1437031693-1024.png"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Product title. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 10.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/hgh-1">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1436965252-lighthouse.jpg"  />
																																				  <div class="offer-tag" >
									<p class="off-price">60% 0ff</p>
								</div>
		  
		  
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">hgh. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    		  
		  		  <div data-countdown="2015-07-30 02:00:00" >
		  </div>
		  			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" style='text-decoration:line-through;'><span>$</span> 23.00</span>
                                        <span class="currency_code"> AUD</span>
												 <span class="dolar-value">23.00</span>

                                        <span class="currency_code">AUD</span>
		
									
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/bag">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1436851583-chrysanthemum.jpg"  />
																																				  <div class="offer-tag" >
									<p class="off-price">20% 0ff</p>
								</div>
		  
		  
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">bag. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    		  
		  		  <div data-countdown="2015-07-28 02:00:00" >
		  </div>
		  			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" style='text-decoration:line-through;'><span>$</span> 25.00</span>
                                        <span class="currency_code"> AUD</span>
												 <span class="dolar-value">25.00</span>

                                        <span class="currency_code">AUD</span>
		
									
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/hgh">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1436794610-chrysanthemum.jpg"  />
																																				  <div class="offer-tag" >
									<p class="off-price">10% 0ff</p>
								</div>
		  
		  
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">hyyfgh. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    		  
		  		  <div data-countdown="2015-07-31 01:30:00" >
		  </div>
		  			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" style='text-decoration:line-through;'><span>$</span> 485.00</span>
                                        <span class="currency_code"> AUD</span>
												 <span class="dolar-value">485.00</span>

                                        <span class="currency_code">AUD</span>
		
									
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/tv">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1435320035-lg-tv.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">TV. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 200.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/spray-away-cleaner-for-horses">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1435216911-464736728_452.jpg"  />
																																				  <div class="offer-tag" >
									<p class="off-price">5% 0ff</p>
								</div>
		  
		  
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">SPRAY-AWAY CLEANER FOR HORSES. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    		  
		  		  <div data-countdown="2015-07-31 01:30:00" >
		  </div>
		  			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" style='text-decoration:line-through;'><span>$</span> 23.00</span>
                                        <span class="currency_code"> AUD</span>
												 <span class="dolar-value">23.00</span>

                                        <span class="currency_code">AUD</span>
		
									
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/dining-table">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1435211201-48a81.jpg"  />
																																				  <div class="offer-tag" >
									<p class="off-price">5% 0ff</p>
								</div>
		  
		  
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Dining Table. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    		  
		  		  <div data-countdown="2015-06-30 00:00:47" >
		  </div>
		  			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" style='text-decoration:line-through;'><span>$</span> 100.00</span>
                                        <span class="currency_code"> AUD</span>
												 <span class="dolar-value">100.00</span>

                                        <span class="currency_code">AUD</span>
		
									
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/test-product-for-fixed-type">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1434633729-converse.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Test product for fixed type. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 21.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/dddddd">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1434633236-max.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">dddddd. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 10.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/wedge-sandals">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1433249606-2013-womens-fashion-platformed-wedge-sandals.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">wedge sandals. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 200.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/flat-shoes">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1433249465-flat-shoes-for-women-5.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">flat shoes. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 10.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/suits">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1433249329-16c03d44-d7b1-4c4f-aa54-a8ae2ab88d13.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">suits. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        +
                                        <span class="currency_value" ><span>$</span> 100.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/high-heel-cut-shoe">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1433246639-luxury-heels-womens-shoes-30092402-800-600.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">high heel cut shoe. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        +
                                        <span class="currency_value" ><span>$</span> 200.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/hjy">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1431936075-464736728_452.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">hjy. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 123.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  
                            <a href="edit-product/rodeo-rocking-chair-black">
                            	<div class="brick-hover">

                                	<img src="images/product/thumb/1438847960-220-volt-kitchenaid-artisan-stand-mixer-grape.jpg"  />
																																		
                                </div>

                                <div class="info">

                                    <div class="product_title">

                                        <div class="headline">Rodeo Rocking Chair Black. </div>

                                    </div>
									
									<div class="product_maker">chennai</div>

                                    			
                                    <div class="product_price">
                                        

                                        
                                        <span class="currency_value" ><span>$</span> 64.00</span>
                                        <span class="currency_code"> AUD</span>
																			
                                    </div>

                                </div>

                            </a>
                            </div>

                            
                             <div class="brick">  

                            	<a class="listing-thumb" href="shop/listitem">

                                	<span class="button_add"></span>List your item
                                </a>

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
						
						</div>

                    </div>
                </div>
				 </div>
				
            </div>
         
       
        </section>
<input type="hidden" name="sell_id" id="sell_id" value="1">


<script>
$(document).ready(function(){
  $("#giftcardcheck").click(function(){ 
    var Gstatus=$("#giftcardcheck").is(':checked') ? 1 : 0; 
	var sell_id=$("#sell_id").val();  
		$.get('site/shop/ajax_gift_card_status?sell_id='+sell_id+'&status='+Gstatus, function(data) { 
		});
		if(Gstatus == 1){
		$('#giftcardstatus').css('display','block');
		} else {
		$('#giftcardstatus').css('display','none');
		}
  });
});  
</script>
	<a href="#shop_review_popup" class="contact-popup" id="review_popup_link"  data-toggle="modal"></a>
	
    <div id='shop_review_popup' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div id='reportReview'>
					        
				</div>
			</div>
		</div>
	</div>

 <script src="js/jquery.colorbox.js"></script>
<script>
$(document).ready(function(){

		$(".cboxClose1").click(function(){
			$("#cboxOverlay,#colorbox").hide();
			});
		//Example of preserving a JavaScript event for inline calls.
			$("#onLoad").click(function(){ 
				$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});

});
</script>


<style>

#cboxLoadedContent{background:none;}
.shop-owner-text {width:8% ;} 
.shop-owner-text ul li a {width:100%; margin-right:30px;}
</style>


<script>

function valchecked(e){
	if(e.checked==true){
	$.ajax({	
			type:'post',
			url	: baseURL+'site/shop/gcard_status_change',
			dataType: 'html',			
			data:{'status':'yes'},
			success: function(response){
			$(".choose-subcata-container").html(response);
			$('#infscr-loading').hide();
				
			}
		});
	} else {
	$.ajax({	
			type:'post',
			url	: baseURL+'site/shop/gcard_status_change',
			dataType: 'html',			
			data:{'status':'No'},
			success: function(response){
			$(".choose-subcata-container").html(response);
			$('#infscr-loading').hide();
				
			}
		});
	
	
	

	}
}


</script>



<!---

========================================================================================================================

-  SMS OTP verification   popup   starts  
- This includes popup html , css , jquery 
- Just copy and paste this code in your shop preview file ( paste anywhere in this file )  : View/site/shop/shop_preview.php 
- Developer Suresh Kumar R

========================================================================================================================
---->	

		
<!-------------        SMS OTP verification   popup   starts  ----------->	
 <!-------------        SMS OTP verification   popup   ends  ----------->	
<section class="second-bl third-bl foot-bg">  
  <footer class="container">
    <div class="row">
      <div class="col-md-3 footer-block"> 
				
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
        <li><a data-toggle="modal" id="currency_href" href="#Language" onclick="javascript:$('#currencyTab').trigger('click');"> $ AUD</a></li>
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
                                                                                           	<li class="currencyLi  currencyactive" id="AUD">
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
                                                                                        	<li class="currencyLi  " id="USD">
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
										<span id="selectedCurrency">$ Australian Dollar </span>
										<!--/ <span id="selectedReligion"> </span>-->
									</div>	
													
									<input type="hidden" name="returnUrl" value="http://192.168.1.251:8081/shopsy-v2/shop/sell">
									<input type="hidden" name="currency" id="currency" value="AUD" />  
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