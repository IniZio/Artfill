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

			<title>Shop Orders</title>
		
<meta name="Title" content="Shopsy V2" />
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


 <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script> 
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});
</script>
  <style> 
#panel, #flip {
    padding: 5px;
    text-align: left;
    border: solid 1px #c3c3c3;
}

#panel {
    padding: 50px;
    display: none;
}
</style>-->
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
<?php	
	$instance->load->library('session');
	if($instance->session->userdata('Curr_theme_name') != "") {
?>
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>Shop-Orders-page.css" rel="stylesheet">
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>header.css" rel="stylesheet">
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>footer.css" rel="stylesheet">
<?php 
	}
?>
<style>
#you1{
	background: url(images/users/thumb/280154645907643307_5d9a79396a30.jpg) no-repeat scroll ;
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
							<span id="CartCount1" class="CartCount1"> 2</span>
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
						     <a class="cart-txt" href="cart">Cart							<span id="CartCount1" class="CartCount1"> 2</span>
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
								<a id="favorites" href="people/ganesh1988/favorites" title="Favorites">
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
																		<span class="notification-count" id="notificationCount">10</span> 
																		</span>
								</a>
							<i></i>
							
								<ul class="dropdown-menu browse-nav-inner showlist2" role="you">
											<span class="menuarrow"></span>
											`
									
									 <li class="first">
										<div class="drop_right_main">
											<div class="user_img">
																							<img src="images/users/thumb/280154645907643307_5d9a79396a30.jpg" />
											</div>
											<div class="drop_right"><strong>ganesh1988</strong><span><a href="view-profile/ganesh1988" class="view-btn1">View Profile</a></span></div>							
										</div>
									</li>
									<li><a style="padding: 0 20px;" href="activity">
									<small>Activity</small>
																		<span class="activity-count">1</span> 
																		</a>
									</li>
									
																		<li>
										<a style="padding: 0 20px;" href="ganesh1988/notifications">
										<small>Notifications</small>
										<span class="notification-list-count">10</span> 
										</a>
									</li>
																		
									
									<li><a href="purchase-review">Purchases</a></li>
									<li><a href="reviews">Reviews</a></li>
									<li><a href="disputes">Disputes</a></li>
									<li><a href="manage-community">Manage Community</a></li>
									<li><a href="public-profile">Public Profile</a></li>
									<li><a href="settings/my-account/ganesh1988">Account Settings</a></li>
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
            href="appearance/ganesh-shop/banner" 
            class=" ">
      <div class="name-inner">Shop Info<span class="complete-indicator"></span></div>
      </a>
      </li>
        
        
      <li   >
					<a href="shops/Ganesh Shop/sections/All">
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
			
						<li>
		        		        	<a title="Enter the credit card you want to use to pay your bill." href="shop/billing" class=" "> <div class="name-inner">Billing</div></a>
		        		       
		     </li>
		        
		        
		</ul>
   	</li>     
        
        
                        
              	
                
        <li ><a href="shops/ganesh-shop/coupon-code"><div class="name-inner">Coupon Codes </div></a></li>
		
		<li ><a href="shops/ganesh-shop/tax-list"><div class="name-inner">Your Tax</div></a></li>
						
							<li  >
                	<a href="offers/9/my-offer/sell">
						<div class="name-inner">
							Your Offers						</div>
					</a>
                </li>
			            
			
					
		<li  class="side_active" ><a href="shops/ganesh-shop/shop-orders"><div class="name-inner">Orders <b class="caret" style="position: static;"></b> </div></a>
		
		<ul class="add_shop_drop_down">
									
						
						   <li><a title="" href="shops/ganesh-shop/shop-orders?order=Processed" class="" ><div class="name-inner">Processed (6)</div></a></li>
			   
			   <li><a title="" href="shops/ganesh-shop/shop-orders?order=Shipped" class="" ><div class="name-inner">Shipped (0)</div></a></li>
						   <li><a title="" href="shops/ganesh-shop/shop-orders?order=Delivered" class="" ><div class="name-inner">Delivered (3)</div></a></li>
						   <li><a title="" href="shops/ganesh-shop/shop-orders?order=Cancelled" class="" ><div class="name-inner">Cancelled (5)</div></a></li>
			  
			   <li><a title="" href="shops/ganesh-shop/shop-orders?order=dispute" class="" ><div class="name-inner">Return / Replace (8)</div></a></li>
		
		</ul>
		
		</li>
		
		<li><a style="padding:0px !important;" href="javascript:void(0)"><div class="name-inner">More<b class="caret" style="position: static;"></b></div></a>
		
			<ul class="add_shop_drop_down">
					<li><a href="promote-shop">Your Main Image</a></li>
					
					<li><a href="shop/reviews">Reviews</a></li>
					
					<li><a href="shops/ganesh-shop/shop-transaction">Transaction</a></li>
					
					<!--<li><a href="shops/ganesh-shop/shop-orders">Orders</a></li>-->
					
					<li><a href="shops/ganesh-shop/commision-tracking">Earnings List</a></li>
					
					<li><a href="shops/ganesh-shop/withdraw-req">Withdrawal Request					</a></li>
					
					<li><a href="shops/ganesh-shop/shop-cod">Cash on Delivery Orders</a></li>
                    <!-- <li>Active  1    Active    Active</li>                 -->
									                                          <li>
                                        <a href="shops/ganesh-shop/my-auctions">
					My Auctions</a>                                            
                                        </li>
                                        <li>
                                        <a href="shops/ganesh-shop/blocked-bidders">
					Blocked Bidders</a>                                            
                                        </li>
                                        					
										
												<li>
							<a href="zendesk-tickets">Zendesk Support</a>
						</li>
												 						<li>
							<a href="freshdesk-tickets">
							Freshdesk Support</a>
						</li>
											
										
					<li>
						<a href="import-items">
							Import Listings						</a>
					</li>
						
			</ul>

		
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

<script type="text/javascript" src="js/site/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" href="css/default/jquery.ptTimeSelect.css" type="text/css" />
<script language="javascript" src="js/jquery.ptTimeSelect.js"></script>
<link href="css/default/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="js/1.8.24-jquery-ui.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	    $("#eventDate").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true  }).val()
	    $("#datefrom").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true  }).val()
	    $("#orderfrom").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true  }).val()
	    $("#orderto").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true  }).val()
		//$("#dateto").datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true   }).val()
});
</script>

<style>
.table-header th {
    text-align: center;
    height: 39px;
    vertical-align: middle;
}
</style>

<div class="clear"></div>
<section class="container">


     <div class="main">    			

     
		 <ul class="bread_crumbs">
        	<li><a href="http://192.168.1.251:8081/shopsy-v2/" class="a_links">Home</a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links">Your Shop</a></li>
		   <span>&rsaquo;</span>
		   <li>Shop orders</li>
         </ul>

  
                				<div class="section">
						<div class="heading_account">Delivered Orders</div>
						<div class="account_info">
							<h1 style="text-align:center !important;">3</h1>
						</div>             
					</div>
					
					<div class="section">
						<div class="heading_account">Total Earnings $</div>
						<div class="account_info">
							<h1 style="text-align:center !important;">
								1,494.19 
							</h1>
							
						</div>             
					</div>
					
					<div class="section">
						<div class="heading_account">Withdrawal Earnings $</div>
						<div class="account_info">
							<h1 style="text-align:center !important;">
								0.00							</h1>
						</div>             
					</div>
					
					<div class="section">
						<div class="heading_account">Balance Earnings $</div>
						<div class="account_info">
							<h1 style="text-align:center !important;">
																1,494.19							</h1>
							<h2 style="text-align:center !important;">(Total Earnings - Withdrawal Earnings)
							
							</h2>
						</div>             
					</div>
										
<div class="purchase_review container">     					
				
				
			<div style="width: 100%;text-align: center;padding-bottom: 20px;margin-top:20px;">
						<input type="text" id="transaction" name="transaction" value="" title="Transaction ID"/>
						<input type="text" id="orderfrom" name="orderfrom" title="Order from" value="" />
						<input type="text" id="orderto" name="orderto" title="Order to" value="" />
						<input type="button" class="search-bt" id="search" name="search" value="search" onclick="search_Orders()"/>
			</div>
			
                <form class="tab_form_list" style="width: 100%;">
					                     <table id="order_table_view" class="tab_form_list_table" align="center" width="100">
                        <thead>     
                            <tr class="table-header">
                            	<th>#</th>
                               <th><span>User Email</span></th>
                                <th><span>Payment Date</span></th>        
                                <th><span>Transaction ID</span></th>        
                                <th><span>Total</span></th>  
                                <th><span>Payment Type</span></th>  
                                <th><span>Status</span></th>     
                                <th><span>Action</span></th> 
                            </tr>
                        </thead>
                        <tbody align="center">   
							
                                  
                            <tr style="height: 50px;">      
                            	<td>1</td>                      
                                <td>vinu@teamtweaks.com</td>        
                                <td>2015-09-02 13:40:43</td>        
                                <td>1441178536</td>
                                <td>$ 36.00</td>
                                <td>twocheckout</td>
                                <td>
                                
                                <span style="color:red;"></span>
                                <span style="color:red;"></span>
                                
                                                                <select id="488" class="changeShipstatusShopCustom" data-val-id="1441178536">
                                    <!--<option >Pending</option>-->
                                    <option selected="selected">Processed</option>
                                    <option >Shipped</option>
                                    <option >Delivered</option>
                                    <option >Cancelled</option>
                                </select>
                                
																</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/1/1441178536" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/1/1441178536" target="_blank" title="View">View</a>
                                <br />
								
								
																
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>2</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-09-01 20:41:30</td>        
                                <td>1441120290</td>
                                <td>$ 100.00</td>
                                <td>Credit-Card</td>
                                <td>
                                
                                <span style="color:red;"></span>
                                <span style="color:red;"></span>
                                
                                                                <select id="474" class="changeShipstatusShopCustom" data-val-id="1441120290">
                                    <!--<option >Pending</option>-->
                                    <option >Processed</option>
                                    <option >Shipped</option>
                                    <option selected="selected">Delivered</option>
                                    <option >Cancelled</option>
                                </select>
                                
																</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1441120290" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1441120290" target="_blank" title="View">View</a>
                                <br />
								
								
																
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>3</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-26 17:58:31</td>        
                                <td>1440592111</td>
                                <td>$ 1,212.00</td>
                                <td>Paypal</td>
                                <td>
                                
                                <span style="color:red;"></span>
                                <span style="color:red;"></span>
                                
                                                                <select id="471" class="changeShipstatusShopCustom" data-val-id="1440592111">
                                    <!--<option >Pending</option>-->
                                    <option selected="selected">Processed</option>
                                    <option >Shipped</option>
                                    <option >Delivered</option>
                                    <option >Cancelled</option>
                                </select>
                                
																</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1440592111" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1440592111" target="_blank" title="View">View</a>
                                <br />
								
								
																
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>4</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-26 17:08:54</td>        
                                <td>1440589134</td>
                                <td>$ 1,212.00</td>
                                <td>Paypal</td>
                                <td>
                                
                                <span style="color:red;">Refund</span>
                                <span style="color:red;"></span>
                                
                                								</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1440589134" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1440589134" target="_blank" title="View">View</a>
                                <br />
								
								
									
																									
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>5</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-26 16:38:40</td>        
                                <td>1440587320</td>
                                <td>$ 1,212.00</td>
                                <td>Paypal</td>
                                <td>
                                
                                <span style="color:red;"></span>
                                <span style="color:red;">Cancelled</span>
                                
                                								</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1440587320" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1440587320" target="_blank" title="View">View</a>
                                <br />
								
								
									
																									
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>6</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-26 15:27:38</td>        
                                <td>1440583058</td>
                                <td>$ 1,212.00</td>
                                <td>Paypal</td>
                                <td>
                                
                                <span style="color:red;"></span>
                                <span style="color:red;">Cancelled</span>
                                
                                								</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1440583058" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1440583058" target="_blank" title="View">View</a>
                                <br />
								
								
									
																									
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>7</td>                      
                                <td>sureshkumar@casperon.in</td>        
                                <td>2015-08-25 20:03:42</td>        
                                <td>1440513222</td>
                                <td>$ 36.00</td>
                                <td>Credit-Card</td>
                                <td>
                                
                                <span style="color:red;">Requested Refund</span>
                                <span style="color:red;"></span>
                                
                                								</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/12/1440513222" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/12/1440513222" target="_blank" title="View">View</a>
                                <br />
								
								
									
																									
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>8</td>                      
                                <td>vinu@teamtweaks.com</td>        
                                <td>2015-08-25 19:32:53</td>        
                                <td>1440511373</td>
                                <td>$ 2.09</td>
                                <td>twocheckout</td>
                                <td>
                                
                                <span style="color:red;"></span>
                                <span style="color:red;"></span>
                                
                                                                <select id="452" class="changeShipstatusShopCustom" data-val-id="1440511373">
                                    <!--<option >Pending</option>-->
                                    <option selected="selected">Processed</option>
                                    <option >Shipped</option>
                                    <option >Delivered</option>
                                    <option >Cancelled</option>
                                </select>
                                
																</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/1/1440511373" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/1/1440511373" target="_blank" title="View">View</a>
                                <br />
								
								
																
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>9</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-25 11:11:28</td>        
                                <td>1440480649</td>
                                <td>$ 1,212.00</td>
                                <td>Credit-Card</td>
                                <td>
                                
                                <span style="color:red;"></span>
                                <span style="color:red;"></span>
                                
                                                                <select id="444" class="changeShipstatusShopCustom" data-val-id="1440480649">
                                    <!--<option selected="selected">Pending</option>-->
                                    <option >Processed</option>
                                    <option >Shipped</option>
                                    <option >Delivered</option>
                                    <option >Cancelled</option>
                                </select>
                                
																</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1440480649" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1440480649" target="_blank" title="View">View</a>
                                <br />
								
								
																
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>10</td>                      
                                <td>vinu@teamtweaks.com</td>        
                                <td>2015-08-24 21:09:19</td>        
                                <td>1440430759</td>
                                <td>$ 36.00</td>
                                <td>Credit-Card</td>
                                <td>
                                
                                <span style="color:red;">Refund</span>
                                <span style="color:red;"></span>
                                
                                								</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/1/1440430759" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/1/1440430759" target="_blank" title="View">View</a>
                                <br />
								
								
									
																									
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>11</td>                      
                                <td>testing2@gmail.com</td>        
                                <td>2015-08-24 20:22:26</td>        
                                <td>1440427718</td>
                                <td>$ 36.00</td>
                                <td>Credit-Card</td>
                                <td>
                                
                                <span style="color:red;"></span>
                                <span style="color:red;"></span>
                                
                                                                <select id="441" class="changeShipstatusShopCustom" data-val-id="1440427718">
                                    <!--<option >Pending</option>-->
                                    <option selected="selected">Processed</option>
                                    <option >Shipped</option>
                                    <option >Delivered</option>
                                    <option >Cancelled</option>
                                </select>
                                
																</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/78/1440427718" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/78/1440427718" target="_blank" title="View">View</a>
                                <br />
								
								
																
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>12</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-24 18:44:42</td>        
                                <td>1440422082</td>
                                <td>$ 1,212.00</td>
                                <td>Credit-Card</td>
                                <td>
                                
                                <span style="color:red;">Requested Refund</span>
                                <span style="color:red;"></span>
                                
                                								</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1440422082" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1440422082" target="_blank" title="View">View</a>
                                <br />
								
								
									
																									
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>13</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-24 18:34:22</td>        
                                <td>1440421462</td>
                                <td>$ 1,212.00</td>
                                <td>Credit-Card</td>
                                <td>
                                
                                <span style="color:red;">Requested Refund</span>
                                <span style="color:red;"></span>
                                
                                								</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1440421462" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1440421462" target="_blank" title="View">View</a>
                                <br />
								
								
									
																			<a href="discussion/1440421462" title="View Discussion">View Discussion </a>
																									
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>14</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-24 18:27:32</td>        
                                <td>1440421052</td>
                                <td>$ 1,212.00</td>
                                <td>Credit-Card</td>
                                <td>
                                
                                <span style="color:red;"></span>
                                <span style="color:red;">Cancelled</span>
                                
                                								</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1440421052" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1440421052" target="_blank" title="View">View</a>
                                <br />
								
								
									
																									
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>15</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-24 16:51:48</td>        
                                <td>1440415308</td>
                                <td>$ 1,212.00</td>
                                <td>Credit-Card</td>
                                <td>
                                
                                <span style="color:red;"></span>
                                <span style="color:red;"></span>
                                
                                                                <select id="421" class="changeShipstatusShopCustom" data-val-id="1440415308">
                                    <!--<option >Pending</option>-->
                                    <option selected="selected">Processed</option>
                                    <option >Shipped</option>
                                    <option >Delivered</option>
                                    <option >Cancelled</option>
                                </select>
                                
																</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1440415308" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1440415308" target="_blank" title="View">View</a>
                                <br />
								
								
																
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>16</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-24 13:47:18</td>        
                                <td>1440404238</td>
                                <td>$ 1,212.00</td>
                                <td>Credit-Card</td>
                                <td>
                                
                                <span style="color:red;">Requested Refund</span>
                                <span style="color:red;"></span>
                                
                                								</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1440404238" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1440404238" target="_blank" title="View">View</a>
                                <br />
								
								
									
																									
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>17</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-24 11:14:15</td>        
                                <td>1440395055</td>
                                <td>$ 1,212.00</td>
                                <td>Credit-Card</td>
                                <td>
                                
                                <span style="color:red;"></span>
                                <span style="color:red;">Cancelled</span>
                                
                                								</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1440395055" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1440395055" target="_blank" title="View">View</a>
                                <br />
								
								
									
																									
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>18</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-20 19:36:17</td>        
                                <td>1440079577</td>
                                <td>$ 1,212.00</td>
                                <td>Credit-Card</td>
                                <td>
                                
                                <span style="color:red;"></span>
                                <span style="color:red;">Cancelled</span>
                                
                                								</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1440079577" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1440079577" target="_blank" title="View">View</a>
                                <br />
								
								
									
																									
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>19</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-20 19:32:18</td>        
                                <td>1440079338</td>
                                <td>$ 1,212.00</td>
                                <td>Credit-Card</td>
                                <td>
                                
                                <span style="color:red;">Refund</span>
                                <span style="color:red;"></span>
                                
                                								</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1440079338" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1440079338" target="_blank" title="View">View</a>
                                <br />
								
								
									
																									
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>20</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-20 19:00:50</td>        
                                <td>1440077393</td>
                                <td>$ 1,212.00</td>
                                <td>Credit-Card</td>
                                <td>
                                
                                <span style="color:red;"></span>
                                <span style="color:red;"></span>
                                
                                                                <select id="358" class="changeShipstatusShopCustom" data-val-id="1440077393">
                                    <!--<option >Pending</option>-->
                                    <option >Processed</option>
                                    <option >Shipped</option>
                                    <option >Delivered</option>
                                    <option >Cancelled</option>
                                </select>
                                
																</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1440077393" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1440077393" target="_blank" title="View">View</a>
                                <br />
								
								
																
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>21</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-06 18:18:01</td>        
                                <td>1438865281</td>
                                <td>$ 1,212.00</td>
                                <td>BrainTree</td>
                                <td>
                                
                                <span style="color:red;">Requested Refund</span>
                                <span style="color:red;"></span>
                                
                                								</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1438865281" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1438865281" target="_blank" title="View">View</a>
                                <br />
								
								
									
																			<a href="discussion/1438865281" title="View Discussion">View Discussion </a>
																									
								
                                </td>
                            </tr>
                            
                            
                                  
                            <tr style="height: 50px;">      
                            	<td>22</td>                      
                                <td>kumar@casperon.in</td>        
                                <td>2015-08-06 18:15:41</td>        
                                <td>1438865141</td>
                                <td>$ 10.00</td>
                                <td>twocheckout</td>
                                <td>
                                
                                <span style="color:red;"></span>
                                <span style="color:red;"></span>
                                
                                                                <select id="252" class="changeShipstatusShopCustom" data-val-id="1438865141">
                                    <!--<option >Pending</option>-->
                                    <option selected="selected">Processed</option>
                                    <option >Shipped</option>
                                    <option >Delivered</option>
                                    <option >Cancelled</option>
                                </select>
                                
																</td>
                                <td>
                                <!-- <a href="site/shop/vieworder/6/1438865141" target="_blank" title="View">View</a> -->
                                <a href="view-order-pre/6/1438865141" target="_blank" title="View">View</a>
                                <br />
								
								
																
								
                                </td>
                            </tr>
                            
                            
                        						
						
                        </tbody>
                     </table>  
		 
                 </form>
                 
</div>                 
        		        </div>
        
        <input type="hidden" id="sellerurl" value="ganesh-shop"/>
        <input type="hidden" id="orderType" value=""/>
 
        
 </section>


<a href="#shipped_container" id="show_orderPopup" data-toggle="modal"></a>

<div class="modal fade language-popup" id='shipped_container' role="dialog" aria-hidden="true" style="display:none">
		<div class="modal-dialog">
			<div class="modal-content">
				
			<div id='cancel_order_popup' style='background:#fff;'>
			<div class="conversation">
			<div class="conversation_container">
					
				
				<form method="post" action="site/shop/shoporder_update">
				<span id="edd" style="display:none;">Estimed Delivery Date:<input name="eventDate" id="eventDate" type="text" tabindex="6" class="required small tipTop" title="Please select the date" value=""/><br></span>
				<span id="sid" style="display:none;">Shipping Id : <input type="text" name="trackingId" id="trackingId"><br></span>
				<span>Comment : <textarea name="shippingMessage" style="z-index:99999999"></textarea><br></span>
				<input type="hidden" name="shipping_status" id="shipping_status" value=""/>
				<input type="hidden" name="dealCodeNumber" id="dealCodeNumber" value=""/>

			
			<div class="modal-footer footer_tab_footer" style="width: 100%; ">
						<div class="btn-group">
							<input class="submit_btn" type="submit" value="submit">
								<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel">Cancel</a>
						</div>
			</div>	
			</form>
			
			</div>
			</div>
			</div>	
			
		</div>
	</div>
</div>

 
 
 
<script>
						
$(document).ready(function(){

	$(".changeShipstatusShopCustom").change(function(){
// 		$('#show_orderPopup').trigger('click');
// 		return false;

		var dealCodeNumber=$(this).attr('data-val-id');
		var shipping_status=$(this).val();

		var con = confirm('Whether you want to continue this action?');
		if (con) {

				$("#dealCodeNumber").val(dealCodeNumber);
				$("#shipping_status").val(shipping_status);

				if(shipping_status == 'Shipped'){
					$("#edd").show();
					$("#sid").show();
				}else{
					$("#edd").hide();
					$("#sid").hide();
				}	

 				$('#show_orderPopup').trigger('click');

//  				$('#show_orderPopup').on('shown.bs.modal', function () {
//  					  $(this).find('input:text:visible:first').focus();
//  				})
 					
//  				$('#show_orderPopup').on('shown.bs.modal', function() {
//    	 				$(document).off('focusin.modal');
// 				});	
 					

// 				return false;
//				$('#show_orderPopup').modal('toggle');

//$.colorbox({width:"360px", height:"auto",overflow:"auto", open:true, inline:true, href:"#alert"});
				
		} else {

				return false;
		}
	 	
		$('html, body').animate({
	        scrollTop: 0
	    });
		
	});	
	});


function search_Orders(){
	var shop = $("#sellerurl").val();
	
	var from = $("#orderfrom").val();
	var to = $("#orderto").val();
	var id = $("#transaction").val();
	//var order = $("#orderType").val();

	if(id !=''){
		window.location.href= "shops/"+shop+"/shop-orders?id="+id+"";
	}else{

		if((from == '' && to != '') || (from != '' && to == '')){
			alert(lg_Selec_both_fromand_todate);
			return false;
		}

		window.location.href= "shops/"+shop+"/shop-orders?from="+from+"&to="+to+"&id="+id+"";
				
	}
		//window.location.href= "shops/"+shop+"/shop-orders?from="+from+"&to="+to+"&id="+id+"&order="+order+"";
	
}

</script> 
 
<style type="text/css">
.section {
    height: 128px;
    width: 24%;
}
.section:first-child {
	margin-left:0px;
}
.heading_account{
	text-align: center;
}
</style>

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
													
									<input type="hidden" name="returnUrl" value="http://192.168.1.251:8081/shopsy-v2/shops/ganesh-shop/shop-orders">
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
		dataType: 'html',
		success: function(data){ 
			var sel = $("#selectedLanguage").text()
			//alert(sel);
			$("#language_href").text(sel);
			//$("#currency_href").text($("#selectedCurrency").text());
			//$("#currency_href").text(currency);
			
			var curr = $("#cursymbol"+currency).val() +" "+currency;
			//alert(curr);
			$("#currency_href").text(curr);


			//var txt; 
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