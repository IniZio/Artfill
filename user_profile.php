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

<script>
	$('a').click(function(){
		alert('You are in preview mode');
		return false;
	});
</script>		<title>Shopsy V2 - Public Profile</title>
		
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
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>User-Profile-page.css" rel="stylesheet">
<?php 
	}
?>
#you1{
	background-image:url("images/users/thumb/9002.jpg");
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
						<span class="shop-cart"> 
							<a href="cart"><i class="fa fa-shopping-cart icon-shopping"></i> Cart 
							<span id="CartCount1" class="CartCount1"> 0</span>
						</a>
						</span>
				</div>
				  
				  
				  
				     <div class="col-md-2 col-xs-2" id="logo">
						<a href="http://192.168.1.251:8081/shopsy-v2/">
							<img src="images/theme/logo2.png"  alt="Shopsy V2" title="Shopsy V2">
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
								<a href="http://192.168.1.251:8081/shopsy-v2/home" id="home" title="Home">
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
										<!--<div class="drop_right_main">
											<div class="user_img">
												<img src="images/default_avat.png">
											</div>
											<div class="drop_right"><strong>shunmugapriya</strong><span><a href="view-profile/shunmugapriya" class="view-btn1">View Profile</a></span></div>							
										</div>-->
										
								<a class="dropdown-toggle browse "  data-toggle="dropdown" id="you1" title="You">
									<span class="icon-text">
									You									
																		<span class="notification-count" id="notificationCount">2</span> 
																		</span>
								</a>
								<i></i>
															<ul class="dropdown-menu browse-nav-inner showlist2" role="you">
											<span class="menuarrow"></span>
									 <li class="first">
										<div class="drop_right_main">
											<div class="user_img">
																							<img src="images/theme/9002.jpg" />
											</div>
											
											<!-- <div class="drop_right"><strong>admin</strong><span><a href="view-profile/admin" class="view-btn1">View Profile</a></span></div> -->							
											<div class="drop_right"><strong>admin</strong><span><a href="public-profile" class="view-btn1">View Profile</a></span></div>							
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
</body><script src="js/popup.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jcarousellite_1.0.1.pack.js"></script>
<!-- header_end -->
<!-- section_start -->
		<div class="add_steps shop-menu-list">
			<div class="main">
				<!-- css -->
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

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

<div id="nav-trigger">
					<span>Menu</span>
				</div>
				<nav id="nav-main">
					<ul id="panel" class="add_steps" style="background:none; box-shadow:none;">

    <li class="side_active">

    	<a href="public-profile">Public Profile</a>

        </li>

    <li >

    	<a href="settings/my-account/admin">

			Settings
        </a>

     </li>

    <li >

    	<a href="settings/giftcards">

        	Gift Cards
        </a>

    </li>

   
    <li >

    	<a href="manage-community" ><i class="ic-credit"></i>

        	Community
        </a>

    </li>
	<li >

    	<a href="manage-notification" ><i class="ic-credit"></i>
        	Notification Settings

        </a>

    </li>
			<li >

    	<a href="people/admin/conversations" ><i class="ic-credit"></i>
        	Conversations

        </a>

    </li>
	<li >

    	<a href="settings/invite-friends" ><i class="ic-credit"></i>
        	Invite Friends

        </a>

    </li>
		
	
    
                        <li><a href="logout">Sign Out</a></li>

                        
    

    <!-- <li class="side_active"><a href="#">Teams</a></li>-->

  </ul>

</nav>
				
				<nav id="nav-mobile"></nav>

     
			</div>
		</div>
		
<div id="profile_div">
	<section class="container">

    	<div class="main">

        	 <ul id="breadcrumbs" class="clear">

                <li>

                    <a itemprop="url" href="http://192.168.1.251:8081/shopsy-v2/"><span itemprop="title">Home</span></a>

                    <span class="separator">›</span>            

                </li>

                <li> admin 's profile  </li>

            </ul>

            <div class="community_page">
			
			
            	

                <div class="community_div">


                    <div class="community_right">                    	   

             <div class="split_prefile">

            <h2> Your Public Profile</h2>

            <p>Everything on this page can be seen by anyone </p>

            <a href="view-profile/admin" class="button_view" >View Profile</a>

            <div class="clear"></div>

            <div class="close_content" id="alert_div" style="display:none">

            <p id="alert_message">We recently updated the way we store and display your profile location to support new features.Check your location below and please update if necessary.</p>

			<a class="close_profile" onclick="hide_me()" style="cursor:pointer !important;"></a>

            </div>

          </div>

          

          			<div class="pass">

          <form action="site/user/update_public_profile" method="post" enctype="multipart/form-data" id="profile_form" name="profile_form">  

          <div class="profile_field">

        	<label >Profile Picture </label>

           <div class="picture_edit" style="margin-left:13px">

             <img src="images/theme/9002.jpg" />

            </div>

            <input type="file" class="shipping_fiel" style="margin:10px 0 0 10px; width: 22%;" name="profile_pict"/>

            

            

        </div>

        <div class="clear"></div>

        <div class="profile_bor"></div>

          

           <div class="profile_field">

        	<label >Full Name </label>

            <span style="margin-left:20px" id="display_first_name">admin </span>

            <a id="button" style="cursor:pointer !important;">Change or Remove</a>

            </div>

            

         <div class="clear"></div>

       <div class="profile_bor"></div>

       <p class="text_profi">Gender</p>

       

        <div class="pro_check">

        	        <input name="gender" type="radio" value="Female"  style="float:left; margin-left:21px;cursor:pointer !important;" id="Female"/>

                     <label style=" margin:3px 0 0 3px;" >Female</label>

         </div>

          <div class="pro_check">

         

        	        <input name="gender" type="radio" value="Male"  style="float:left;cursor:pointer !important;" id="Male"/>

                     <label style=" margin:3px 0 0 3px;" >Male</label>

          </div>

          <div class="pro_check">

         

        	        <input name="gender" type="radio" value=""  style="float:left;cursor:pointer !important;" id="Unspecified"/>

                     <label style=" margin:3px 0 0 3px;" >Rather not say</label>

          </div>

          

            <div class="clear"></div>

       <div class="profile_bor"></div>

      

        <div class="text_arrow_main">

        <div style="background:none" class="text_arrow">

         <p>City</p>

       </div>

       </div>
	   <div class="pro_check" style="width:79%; float:right; ">

        	        <input name="city" type="text" value="fff"  style=" width:38%; margin-left:20px;" class="shipping_fiel"/>

                    <div class="clear"></div>

                  <!--  <span style="margin:10px 0 0 35px; float:left;">Start typing and choose from a suggested city to help others find you. </span>-->

                    

         </div>
		   <div class="clear"></div>

       <div class="profile_bor"></div>
		
		<div class="text_arrow_main">

        <div style="background:none" class="text_arrow">

         <p>Country </p>

       </div>

       </div>
        <div class="pro_check" style="width:79%; float:right; ">

        	        <select class="preview_pro" name="country" id="country" style="cursor:pointer !important;  margin-left: 20px; width: 278px;">
             	<option value="">Select</option>
                	                        <option  value="Afghanistan">Afghanistan</option>
                                            <option  value="Aland Islands">Aland Islands</option>
                                            <option  value="Albania">Albania</option>
                                            <option  value="Algeria">Algeria</option>
                                            <option  value="American Samoa">American Samoa</option>
                                            <option  value="Andorra">Andorra</option>
                                            <option  value="Angola">Angola</option>
                                            <option  value="Antarctica">Antarctica</option>
                                            <option  value="Antigua And Barbuda">Antigua And Barbuda</option>
                                            <option  value="Argentina">Argentina</option>
                                            <option  value="Armenia">Armenia</option>
                                            <option  value="Aruba">Aruba</option>
                                            <option  value="Australia">Australia</option>
                                            <option  selected="selected" value="Austria">Austria</option>
                                            <option  value="Azerbaijan">Azerbaijan</option>
                                            <option  value="Bahamas">Bahamas</option>
                                            <option  value="Bahrain">Bahrain</option>
                                            <option  value="Bangladesh">Bangladesh</option>
                                            <option  value="Barbados">Barbados</option>
                                            <option  value="Belarus">Belarus</option>
                                            <option  value="Belgium">Belgium</option>
                                            <option  value="Belize">Belize</option>
                                            <option  value="Benin">Benin</option>
                                            <option  value="Bermuda">Bermuda</option>
                                            <option  value="Bhutan">Bhutan</option>
                                            <option  value="Bolivia">Bolivia</option>
                                            <option  value="Bonaire, Saint Eustatius And Saba ">Bonaire, Saint Eustatius And Saba </option>
                                            <option  value="Bosnia And Herzegovina">Bosnia And Herzegovina</option>
                                            <option  value="Botswana">Botswana</option>
                                            <option  value="Bouvet Island">Bouvet Island</option>
                                            <option  value="Brazil">Brazil</option>
                                            <option  value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                            <option  value="Brunei">Brunei</option>
                                            <option  value="Bulgaria">Bulgaria</option>
                                            <option  value="Burkina Faso">Burkina Faso</option>
                                            <option  value="Burundi">Burundi</option>
                                            <option  value="Cambodia">Cambodia</option>
                                            <option  value="Cameroon">Cameroon</option>
                                            <option  value="Canada">Canada</option>
                                            <option  value="Cape Verde">Cape Verde</option>
                                            <option  value="Central African Republic">Central African Republic</option>
                                            <option  value="Chad">Chad</option>
                                            <option  value="Chile">Chile</option>
                                            <option  value="China">China</option>
                                            <option  value="Colombia">Colombia</option>
                                            <option  value="Comoros">Comoros</option>
                                            <option  value="Costa Rica">Costa Rica</option>
                                            <option  value="Croatia">Croatia</option>
                                            <option  value="Cuba">Cuba</option>
                                            <option  value="Cyprus">Cyprus</option>
                                            <option  value="Czech Republic">Czech Republic</option>
                                            <option  value="Democratic Republic Of The Congo">Democratic Republic Of The Congo</option>
                                            <option  value="Denmark">Denmark</option>
                                            <option  value="Djibouti">Djibouti</option>
                                            <option  value="Dominica">Dominica</option>
                                            <option  value="Dominican Republic">Dominican Republic</option>
                                            <option  value="East Timor">East Timor</option>
                                            <option  value="Ecuador">Ecuador</option>
                                            <option  value="Egypt">Egypt</option>
                                            <option  value="El Salvador">El Salvador</option>
                                            <option  value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option  value="Eritrea">Eritrea</option>
                                            <option  value="Estonia">Estonia</option>
                                            <option  value="Ethiopia">Ethiopia</option>
                                            <option  value="Everywhere Else">Everywhere Else</option>
                                            <option  value="Faroe Islands">Faroe Islands</option>
                                            <option  value="Fiji">Fiji</option>
                                            <option  value="Finland">Finland</option>
                                            <option  value="France">France</option>
                                            <option  value="French Guiana">French Guiana</option>
                                            <option  value="French Polynesia">French Polynesia</option>
                                            <option  value="French Southern Territories">French Southern Territories</option>
                                            <option  value="Gabon">Gabon</option>
                                            <option  value="Gambia">Gambia</option>
                                            <option  value="Georgia">Georgia</option>
                                            <option  value="Germany">Germany</option>
                                            <option  value="Ghana">Ghana</option>
                                            <option  value="Greece">Greece</option>
                                            <option  value="Greenland">Greenland</option>
                                            <option  value="Grenada">Grenada</option>
                                            <option  value="Guadeloupe">Guadeloupe</option>
                                            <option  value="Guam">Guam</option>
                                            <option  value="Guatemala">Guatemala</option>
                                            <option  value="Guernsey">Guernsey</option>
                                            <option  value="Guinea">Guinea</option>
                                            <option  value="Guinea-Bissau">Guinea-Bissau</option>
                                            <option  value="Guyana">Guyana</option>
                                            <option  value="Haiti">Haiti</option>
                                            <option  value="Honduras">Honduras</option>
                                            <option  value="Hong Kong">Hong Kong</option>
                                            <option  value="Hungary">Hungary</option>
                                            <option  value="Iceland">Iceland</option>
                                            <option  value="India">India</option>
                                            <option  value="Indonesia">Indonesia</option>
                                            <option  value="Iran">Iran</option>
                                            <option  value="Iraq">Iraq</option>
                                            <option  value="Ireland">Ireland</option>
                                            <option  value="Isle Of Man">Isle Of Man</option>
                                            <option  value="Israel">Israel</option>
                                            <option  value="Italy">Italy</option>
                                            <option  value="Ivory Coast">Ivory Coast</option>
                                            <option  value="Jamaica">Jamaica</option>
                                            <option  value="Japan">Japan</option>
                                            <option  value="Jersey">Jersey</option>
                                            <option  value="Jordan">Jordan</option>
                                            <option  value="Kazakhstan">Kazakhstan</option>
                                            <option  value="Kenya">Kenya</option>
                                            <option  value="Kiribati">Kiribati</option>
                                            <option  value="Kosovo">Kosovo</option>
                                            <option  value="Kuwait">Kuwait</option>
                                            <option  value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option  value="Laos">Laos</option>
                                            <option  value="Latvia">Latvia</option>
                                            <option  value="Lebanon">Lebanon</option>
                                            <option  value="Lesotho">Lesotho</option>
                                            <option  value="Liberia">Liberia</option>
                                            <option  value="Libya">Libya</option>
                                            <option  value="Liechtenstein">Liechtenstein</option>
                                            <option  value="Lithuania">Lithuania</option>
                                            <option  value="Luxembourg">Luxembourg</option>
                                            <option  value="Macao">Macao</option>
                                            <option  value="Macedonia">Macedonia</option>
                                            <option  value="Madagascar">Madagascar</option>
                                            <option  value="Malawi">Malawi</option>
                                            <option  value="Malaysia">Malaysia</option>
                                            <option  value="Maldives">Maldives</option>
                                            <option  value="Mali">Mali</option>
                                            <option  value="Marshall Islands">Marshall Islands</option>
                                            <option  value="Martinique">Martinique</option>
                                            <option  value="Mauritania">Mauritania</option>
                                            <option  value="Mauritius">Mauritius</option>
                                            <option  value="Mayotte">Mayotte</option>
                                            <option  value="Mexico">Mexico</option>
                                            <option  value="Micronesia">Micronesia</option>
                                            <option  value="Moldova">Moldova</option>
                                            <option  value="Monaco">Monaco</option>
                                            <option  value="Mongolia">Mongolia</option>
                                            <option  value="Montenegro">Montenegro</option>
                                            <option  value="Montserrat">Montserrat</option>
                                            <option  value="Morocco">Morocco</option>
                                            <option  value="Mozambique">Mozambique</option>
                                            <option  value="Myanmar">Myanmar</option>
                                            <option  value="Namibia">Namibia</option>
                                            <option  value="Nauru">Nauru</option>
                                            <option  value="Nepal">Nepal</option>
                                            <option  value="Netherlands">Netherlands</option>
                                            <option  value="New Caledonia">New Caledonia</option>
                                            <option  value="New Zealand">New Zealand</option>
                                            <option  value="Nicaragua">Nicaragua</option>
                                            <option  value="Niger">Niger</option>
                                            <option  value="Nigeria">Nigeria</option>
                                            <option  value="North Korea">North Korea</option>
                                            <option  value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option  value="Norway">Norway</option>
                                            <option  value="Oman">Oman</option>
                                            <option  value="Pakistan">Pakistan</option>
                                            <option  value="Palau">Palau</option>
                                            <option  value="Palestinian Territory">Palestinian Territory</option>
                                            <option  value="Panama">Panama</option>
                                            <option  value="Papua New Guinea">Papua New Guinea</option>
                                            <option  value="Paraguay">Paraguay</option>
                                            <option  value="Peru">Peru</option>
                                            <option  value="Philippines">Philippines</option>
                                            <option  value="Poland">Poland</option>
                                            <option  value="Portugal">Portugal</option>
                                            <option  value="Puerto Rico">Puerto Rico</option>
                                            <option  value="Qatar">Qatar</option>
                                            <option  value="Republic Of The Congo">Republic Of The Congo</option>
                                            <option  value="Reunion">Reunion</option>
                                            <option  value="Romania">Romania</option>
                                            <option  value="Russia">Russia</option>
                                            <option  value="Rwanda">Rwanda</option>
                                            <option  value="Saint Helena">Saint Helena</option>
                                            <option  value="Saint Kitts And Nevis">Saint Kitts And Nevis</option>
                                            <option  value="Saint Lucia">Saint Lucia</option>
                                            <option  value="Saint Pierre And Miquelon">Saint Pierre And Miquelon</option>
                                            <option  value="Saint Vincent And The Grenadines">Saint Vincent And The Grenadines</option>
                                            <option  value="Samoa">Samoa</option>
                                            <option  value="San Marino">San Marino</option>
                                            <option  value="Sao Tome And Principe">Sao Tome And Principe</option>
                                            <option  value="Saudi Arabia">Saudi Arabia</option>
                                            <option  value="Senegal">Senegal</option>
                                            <option  value="Serbia">Serbia</option>
                                            <option  value="Seychelles">Seychelles</option>
                                            <option  value="Sierra Leone">Sierra Leone</option>
                                            <option  value="Singapore">Singapore</option>
                                            <option  value="Slovakia">Slovakia</option>
                                            <option  value="Slovenia">Slovenia</option>
                                            <option  value="Solomon Islands">Solomon Islands</option>
                                            <option  value="Somalia">Somalia</option>
                                            <option  value="South Africa">South Africa</option>
                                            <option  value="South Korea">South Korea</option>
                                            <option  value="South Sudan">South Sudan</option>
                                            <option  value="Spain">Spain</option>
                                            <option  value="Sri Lanka">Sri Lanka</option>
                                            <option  value="Sudan">Sudan</option>
                                            <option  value="Suriname">Suriname</option>
                                            <option  value="Svalbard And Jan Mayen">Svalbard And Jan Mayen</option>
                                            <option  value="Swaziland">Swaziland</option>
                                            <option  value="Sweden">Sweden</option>
                                            <option  value="Switzerland">Switzerland</option>
                                            <option  value="Syria">Syria</option>
                                            <option  value="Taiwan">Taiwan</option>
                                            <option  value="Tajikistan">Tajikistan</option>
                                            <option  value="Tanzania">Tanzania</option>
                                            <option  value="Thailand">Thailand</option>
                                            <option  value="Togo">Togo</option>
                                            <option  value="Tokelau">Tokelau</option>
                                            <option  value="Tonga">Tonga</option>
                                            <option  value="Trinidad And Tobago">Trinidad And Tobago</option>
                                            <option  value="Tunisia">Tunisia</option>
                                            <option  value="Turkey">Turkey</option>
                                            <option  value="Turkmenistan">Turkmenistan</option>
                                            <option  value="Tuvalu">Tuvalu</option>
                                            <option  value="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                            <option  value="Uganda">Uganda</option>
                                            <option  value="Ukraine">Ukraine</option>
                                            <option  value="United Arab Emirates">United Arab Emirates</option>
                                            <option  value="United Kingdom">United Kingdom</option>
                                            <option  value="United States">United States</option>
                                            <option  value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                            <option  value="Uruguay">Uruguay</option>
                                            <option  value="Uzbekistan">Uzbekistan</option>
                                            <option  value="Vanuatu">Vanuatu</option>
                                            <option  value="Venezuela">Venezuela</option>
                                            <option  value="Vietnam">Vietnam</option>
                                            <option  value="Wallis And Futuna">Wallis And Futuna</option>
                                            <option  value="Western Sahara">Western Sahara</option>
                                            <option  value="Yemen">Yemen</option>
                                            <option  value="Zambia">Zambia</option>
                                            <option  value="Zimbabwe">Zimbabwe</option>
                                 </select>

                    <div class="clear"></div>

                  <!--  <span style="margin:10px 0 0 35px; float:left;">Start typing and choose from a suggested city to help others find you. </span>-->

                    

         </div>

          <div class="clear"></div>

       <div class="profile_bor"></div>

        <div class="profile_field">

        	<label > Birthday</label>

             <select class="preview_pro" name="month" id="month" style="cursor:pointer !important;">

                     <option>Month</option>

                     	<option value="1">January</option>

                        <option value="2">February</option>

                        <option value="3">March</option>

                        <option value="4">April</option>

                        <option value="5">May</option>

                        <option value="6">June</option>

                        <option value="7">July</option>

                        <option value="8">August</option>

                        <option value="9">September</option>

                        <option value="10">October</option>

                        <option value="11">November</option>

                        <option value="12">December</option>

             </select>

             

              <select class="preview_pro" style="width:12%;cursor:pointer !important;" name="day" id="day">

                     <option>Day</option>

                     
                      <option value="1">1</option>

                     
                      <option value="2">2</option>

                     
                      <option value="3">3</option>

                     
                      <option value="4">4</option>

                     
                      <option value="5">5</option>

                     
                      <option value="6">6</option>

                     
                      <option value="7">7</option>

                     
                      <option value="8">8</option>

                     
                      <option value="9">9</option>

                     
                      <option value="10">10</option>

                     
                      <option value="11">11</option>

                     
                      <option value="12">12</option>

                     
                      <option value="13">13</option>

                     
                      <option value="14">14</option>

                     
                      <option value="15">15</option>

                     
                      <option value="16">16</option>

                     
                      <option value="17">17</option>

                     
                      <option value="18">18</option>

                     
                      <option value="19">19</option>

                     
                      <option value="20">20</option>

                     
                      <option value="21">21</option>

                     
                      <option value="22">22</option>

                     
                      <option value="23">23</option>

                     
                      <option value="24">24</option>

                     
                      <option value="25">25</option>

                     
                      <option value="26">26</option>

                     
                      <option value="27">27</option>

                     
                      <option value="28">28</option>

                     
                      <option value="29">29</option>

                     
                      <option value="30">30</option>

                     
                      <option value="31">31</option>

                     
             </select>

           

            <span style="color:red" id="date_error"></span>

            </div>

            

            <div class="clear"></div>

       <div class="profile_bor"></div>

       <div class="profile_field">

        	<label > About </label>

            <textarea class="shipping_fiel width_fileld_scroll" name="about"></textarea>

            <div class="clear"></div>

           <span style="margin:10px 0 0 189px; float: left;"> Tell people a little about yourself.</span>

         

           

            

            </div>

              <div class="clear"></div>

       <div class="profile_bor"></div>

       <div class="profile_field">

        	<label > Favorite Materials </label>

            <textarea class="shipping_fiel width_fileld_scroll" style="height:30px; ;" name="favorite_materials" id="favorite_materials"></textarea>

            <span class="error" id="favorite_materialsErr"></span>

            <div class="clear"></div>

           <span style="margin:10px 0 0 189px; float: left;"> Share up to 13 materials that you like. Separate each material with a comma.</span>

         

           </div>

           <div class="clear"></div>

       <div class="profile_bor"></div>

           <p class="text_profi">Include on Your Profile</p>

           

           
           

           

            <div class="field_account" style="margin-bottom:15px; margin-left:46px;">

        	        <input name="include_profile[]" type="checkbox" value="Shop" class="chkb"  style="float:left;cursor:pointer !important;" id="Shop" />

                    <label style=" margin:0px 0 0 3px;" >Shop</label>

                    <div class="clear"></div>

                   <input name="include_profile[]" type="checkbox" class="chkb" value="Favorite_items" id="Favorite_items"  style="float:left;cursor:pointer !important;" />

                    <label style=" margin:0px 0 0 3px;" >Favorite items</label>

                    <div class="clear"></div>

                     <input name="include_profile[]" type="checkbox" class="chkb" value="Favorite_shops" id="Favorite_shops"  style="float:left;cursor:pointer !important;" />

                    <label style=" margin:0px 0 0 3px;" >Favorite shops</label>

                    <!--<div class="clear"></div>

                    <input name="include_profile[]" type="checkbox" class="chkb" value="Treasury_lists" id="Treasury_lists"  style="float:left;cursor:pointer !important;" />

                    <label style=" margin:0px 0 0 3px;" >Treasury lists</label>-->

                    <div class="clear"></div>

                    <input name="include_profile[]" type="checkbox" class="chkb" value="Teams" id="Teams"  style="float:left;cursor:pointer !important;" />

                    <label style=" margin:0px 0 0 3px;" >Teams</label>

                  </div>

                  
    

              </div>

          

            		

            <div class="clear"></div>

         

          	<input type="submit" class="password_btn" value="Save Changes" style=" margin-left:10px; margin-top:1px;" id="profile_submit" onclick="return date_validation();"/>

        

         

                    

                   </div>

           </form>

                </div>

            </div>

        </div>

    </section>

  </div>

  <div id="popupContact">

		



        

    <div class="overlay-content"  id="namechange-overlay">

                <form class="namechange-overlay-form" method="post" action="site/user/change_name" onsubmit="return validateName();">

               <!-- <input type="hidden" name="_nnc" value="input" class="hidden csrf">

                <input type="hidden" name="member-id" value="45155540">

                <input type="hidden" name="current-first-name" value="Saravana" >

                <input type="hidden" name="current-last-name" value="S">

                <input type="hidden" name="action" value="namechange"> -->



                <div class="overlay-header">

                    <h2>Change or Remove Your Name</h2>

                    <p>These fields are for your full name.</p>

                </div>

                <div class="overlay-body change-name-overlay">

                    <div class="input-group input-group-stacked">

                        <label for="new-first-name">First Name</label>

                        <div class="pop-input">

                        <input value="admin" name="new-first-name" id="new-first-name" maxlength="40" class="text" type="text" >

                        </div>

                       

                    </div>

            		<div class="input-group input-group-stacked">

			            <label for="new-last-name">Last Name</label>

                        <div class="pop-input">

                        <input value="" id="new-last-name" name="new-last-name" maxlength="40" class="text" type="text">

                        </div>

                        

                    </div>

                </div>

                <span class="error" id="splErr"></span>

                <div class="overlay-footer">

                    <div class="primary-actions">

                        <div class="save-changes"><input type="submit" name="save" value="Save Changes"></div>

                       <div class="popup-cancel"><input type="button" name="cancel" value="Cancel" id="popupContactClose"></div>

                    </div>

                </div>

            </form>

            </div>    

        

        

        

        

	</div>

	<div id="backgroundPopup"></div>

  

  <script>

document.getElementById("Male").checked=true;




document.getElementById("month").value="Month";

document.getElementById("day").value="Day";





 $('#Shop').attr('checked',true);


 $('#Favorite_items').attr('checked',true);


 $('#Favorite_shops').attr('checked',true);


 $('#Teams').attr('checked',true);


</script>

<script>

function validateName(){

	$('#splErr').hide();

	$('#splErr').html('');

	if($('#new-first-name').val().trim()==''){		

		$('#splErr').show();

		$('#splErr').html('Enter Your First Name.');

		return false;

	}

	if($('#new-last-name').val().trim()==''){		

		$('#splErr').show();

		$('#splErr').html('Enter Your Last Name.');

		return false;

	}

}

function date_validation()

{



var favorite_materials=$('#favorite_materials').val().split(',');

	$('#favorite_materialsErr').hide();

if(favorite_materials.length>13){

	$('#favorite_materialsErr').show();	

	$('#favorite_materialsErr').html('Maximum 13 materials are added');

	return false;

}



$("#date_error").html("");

var day=document.getElementById("day").value;

var month=document.getElementById("month").value;

	if(month==2)

	{

		if(day>28)

		{

			$("#date_error").html("Invalid date");

			return false;

		}

	}

	if(month==4||month==6||month==9||month==11)

	{

		if(day>30)

		{

			$("#date_error").html("Invalid date");

			return false;

		}

	}

	if((day>0&&month=="Month")||(month>0&&day=="Day"))	

	{

		$("#date_error").html("Invalid date");

			return false;

	}

}



function hide_me()

{

	//alert(element_id);

$("#alert_div").hide();	

}

</script>



<script>

//function change_name()

//{

//	var first_name=document.getElementById("new-first-name").value;

//	var last_name=document.getElementById("new-last-name").value;

	

//	$.ajax({

//			url : 'http://192.168.1.251:8081/shopsy-v2/site/user/change_name',

			//data : {firstname : first_name,lastname : last_name},

			//type : "post",

			

//			success:function(e){

//				alert(e);

				//$("#display_first_name_header").html(response.first_name);

				//$("#display_first_name").html(response.first_name);

				//$("#new-first-name").val(response.first_name);

				//$("#new-last-name").val(response.last_name);

				//$("#alert_div").css("display", "block");

				//$("#alert_message").html(response.msg);

//			},

//			error: function(er){

				

//				alert("error");

//			}

//			});

	

	

//}

</script>





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
													
									<input type="hidden" name="returnUrl" value="http://192.168.1.251:8081/shopsy-v2/public-profile">
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