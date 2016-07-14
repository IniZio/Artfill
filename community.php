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

	 

			<title>Shopsy V2 - All Post</title>
		
<meta name="Title" content="Shopsy V2 - All Post" />
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
		var currencySymbol = 'Rs';
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
<script>
	$('a').click(function(){
		alert('You are in preview mode');
		return false;
	});
</script>

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
																		<span class="notification-count" id="notificationCount">6</span> 
																		</span>
								</a>
								<i></i>
															<ul class="dropdown-menu browse-nav-inner showlist2" role="you">
											<span class="menuarrow"></span>
									 <li class="first">
										<div class="drop_right_main">
											<div class="user_img">
																							<img src="images/users/thumb/9002.jpg" />
											</div>
											
											<!-- <div class="drop_right"><strong>admin</strong><span><a href="view-profile/admin" class="view-btn1">View Profile</a></span></div> -->							
											<div class="drop_right"><strong>admin</strong><span><a href="public-profile" class="view-btn1">View Profile</a></span></div>							
										</div>
									</li>
									<li><a style="padding: 0 20px;" href="activity">
									<small>Activity</small>
																		<span class="activity-count">1</span> 
																		</a>
									</li>
									
																		<li>
										<a style="padding: 0 20px;" href="admin/notifications">
										<small>Notifications</small>
										<span class="notification-list-count">6</span> 
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
</body>
<link rel="stylesheet" type="text/css" href="css/default/community.css"/>
<link type="text/css" href="css/default/blog-jquery-search.css" />
<link rel="stylesheet" href="css/default/site/my-account.css" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/master.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/form1.css"/>
<link rel="stylesheet" type="text/css" media="all" href="js/markerclusterer/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/redmond/jquery-ui.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/jquery.ptTimeSelect.css"/>
<script src="js/jquery.dataTables.js"></script>
<script src="js/CustomSearchJquery.js"></script>
<script src="js/jquery.validate.js"></script>  
<script src="js/markerclusterer/datepicker.js"></script> 
<script>$(document).ready(function(){$("#addevent_form").validate(); });</script>
<script src="js/site/jquery.ptTimeSelect.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&amp;sensor=false"</script>
<script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
 $(function() {
	tinyMCE.init({
		// General options
		mode : "specific_textareas",
		editor_selector : "addPostTiny",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
		 
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		file_browser_callback : "ajaxfilemanager",
		relative_urls : false,
		// Example content CSS (should be your site CSS)
		content_css : "css/default/example.css",
		 
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "js/template_list.js",
		external_link_list_url : "js/link_list.js",
		external_image_list_url : "js/image_list.js",
		media_external_list_url : "js/media_list.js",
		 
		// Replace values for the template plugin
		template_replace_values : {
		username : "Some User",
		staffid : "991234"
		}
	});
});
function ajaxfilemanager(field_name, url, type, win) {
var ajaxfilemanagerurl = '<?php echo $base_path; ?>js/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php';
switch (type) {
	case "image":
		break;
	case "media":
		break;
	case "flash": 
		break;
	case "file":
		break;
	default:
		return false;
}
tinyMCE.activeEditor.windowManager.open({
	url: '<?php echo $base_path; ?>js/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php',
	width: 782,
	height: 440,
	inline : "yes",
	close_previous : "no"
},{
	window : win,
	input : field_name
});
return false;			
var fileBrowserWindow = new Array();
fileBrowserWindow["file"] = ajaxfilemanagerurl;
fileBrowserWindow["title"] = "Ajax File Manager";
fileBrowserWindow["width"] = "782";
fileBrowserWindow["height"] = "440";
fileBrowserWindow["close_previous"] = "no";
tinyMCE.openWindow(fileBrowserWindow, {
  window : win,
  input : field_name,
  resizable : "yes",
  inline : "yes",
  editor_id : tinyMCE.getWindowArg("editor_id")
});
return false;
}
</script>
<style>
.error{color:#FF0000!important;}
</style><!-- css -->
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="css/default/site/style-menu.css" />
    
<?php	
	$instance->load->library('session');
	if($instance->session->userdata('Curr_theme_name') != "") {
?>
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>Community-Page.css" rel="stylesheet">
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>header.css" rel="stylesheet">
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>footer.css" rel="stylesheet">
<?php 
	}
?>
<script>
	$('a').click(function(){
		alert('You are in preview mode');
		return false;
	});
</script>
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
			<div class="add_steps shop-menu-list">

			<div class="main">


<div id="nav-trigger">
					<span>Menu</span>
				</div>
				<nav id="nav-main">
					<ul id="panel" class="add_steps" style="background:none; box-shadow:none;">
				<li  class="active" ><a href="manage-community" >All News</a></li>
 
       <li ><a href="community-post-comments" >Comments</a></li>
        <li ><a href="manage-events">All Events</a></li>
                <li ><a href="manage-teams" >All Teams</a></li>
                <li ><a href="manage-discussions">Discussions</a></li>  	
  </ul>
</nav>				
				<nav id="nav-mobile"></nav>
			</div>			
			</div>
<div id="community_tag">
<section class="container">
    	<div class="main">
        <div class="wrapper">
        <ul class="bread_crumbs">
        	 <li> <a href="" class="a_links">Home</a></li>
             <span>&rsaquo;</span>
             <li> <a href="settings/my-account/admin" class="a_links">Your Account</a></li>
             <span>&rsaquo;</span>
            <li> News</li>
        </ul>
     <div class="clear"></div>
     <div class="hole_content">
      <div class="heading">News</div>
        	
             <form name="seekerActionForm" id="seekerActionForm" method="post" enctype="multipart/form-data" action="site/community/productActiveInactiveDeleteFunction" >	
            <input type="hidden" name="statusMode" id="statusMode" />	
            <input type="hidden" name="pagename" id="pagename" value="manage-community" />	
            <div class="right_split">
                	<div class="full_detail">
                    <div id="activeInactiveTop" class="act-ina-del-common">
                    <a class="btn btn-success see_more" style="float:left" href="community-new-post" ><i class="icon-ok"></i> Add News</a>
                       <a class="btn btn-success see_more" href="javascript:void(0);" onClick="return checkBoxValidationUser('active','123')" ><i class="icon-ok"></i> Active </a>
                       <a class="btn btn-warning inact see_more" href="javascript:void(0);" onClick="return checkBoxValidationUser('inactive','123')" ><i class="icon-ban-circle"></i> Inactive</a>
                       <a class="btn btn-danger see_more" href="javascript:void(0);" onClick="return checkBoxValidationUser('delete','123')"><i class="icon-trash icon-white"></i> Delete</a>     
                            
                    </div>
					
					<div class="news-table">
                     <table width="99%" border="0" cellspacing="0" cellpadding="0" class="property_table" id="property_table">
                     <thead>
  <tr style="background:#f4f4f4;">
   <td width="5%"><input type="checkbox" name ="seekerCheckbox[]" id="seekerCheckbox"  onclick="return checkBoxController(this.form,'seekerCheckbox[]',this.checked);"/> </td>
   <td width="20%" ><strong>Title</strong></td>
<!--    <td width="20%" ><strong>Event Type</strong></td>
  <td width="20%" ><strong>Comments Count</strong></td>-->
   <td width="20%" ><strong>Date</strong></td>
   <td width="20%" ><strong>Time</td>
   <td width="20%" ><strong>In Response To</strong></td>
 </tr>
 <thead>
 <tbody>
   <tr>
 <td><input type="checkbox" class="caseSeeker" name="seekerCheckbox[]" value="4" /></td>
   <td><a href="4/news-details">check</a></td>
 <!--    <td>admin</td>
 <td></td>-->
   <td>Jul-21,2015</td>
   <td>12:35:53</td>
   <td><div class="edit">
   		 <a  href="site/community/update_posts/4/" onclick="return changeStatusCommon('');"><img src="images/inactive.png" title=""  /></a>
           <a href="site/community/blogeditpost/4" style="padding-left:0px;"><img src="images/edit.png" title="Edit"   /></a>
   <a href="site/community/delete_posts/4" onclick="return changeStatusCommon('delete');"><img src="images/delete.png" title="Delete"  /></a>

   </div>
   </td>
 </tr>
   <tr>
 <td><input type="checkbox" class="caseSeeker" name="seekerCheckbox[]" value="3" /></td>
   <td><a href="3/news-details">change</a></td>
 <!--    <td>admin</td>
 <td></td>-->
   <td>Jul-21,2015</td>
   <td>12:29:59</td>
   <td><div class="edit">
   		 <a  href="site/community/update_posts/3/" onclick="return changeStatusCommon('');"><img src="images/inactive.png" title=""  /></a>
           <a href="site/community/blogeditpost/3" style="padding-left:0px;"><img src="images/edit.png" title="Edit"   /></a>
   <a href="site/community/delete_posts/3" onclick="return changeStatusCommon('delete');"><img src="images/delete.png" title="Delete"  /></a>

   </div>
   </td>
 </tr>
 </tbody>
</table>
         </div>               
      </div>                   
  </div>
  </form>
            </div>
            </div>
        </div>
         </div>
    
 
	
</section>
</div>
<!--selection-->

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
        <li><a data-toggle="modal" id="currency_href" href="#Language" onclick="javascript:$('#currencyTab').trigger('click');"> Rs INR</a></li>
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
                                                                                        	<li class="currencyLi  currencyactive" id="INR">
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
										<span id="selectedCurrency">Rs indian Rupee </span>
										<!--/ <span id="selectedReligion"> </span>-->
									</div>	
													
									<input type="hidden" name="returnUrl" value="http://192.168.1.251:8081/shopsy-v2/manage-community">
									<input type="hidden" name="currency" id="currency" value="INR" />  
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