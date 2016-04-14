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

	    
		<title>Shopsy V2</title>
		
<meta name="Title" content="Shopsy V2" />
<meta name="keywords" content="Shopsy V2" />
<meta name="description" content="Shopsy V2" />
	
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $$base_path; ?>images/logo/logo4.png">    
	
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
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>Home-page.css" rel="stylesheet">
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>header.css" rel="stylesheet">
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>footer.css" rel="stylesheet">
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
						<a href="#">
							<img src="<?php echo $base_path; ?>images/theme/logo2.png" alt="Shopsy V2" title="Shopsy V2" />
						</a>
					</div>				 
					<div class="col-md-3 search-bl col-xs-6">				
						<form name="search" action="#" method="get">
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
								<a id="location" href="#">
								<span class="icon-text">By Location</span>															
								</a>
								
							</li>
							
														
							<li>
								
								<a id="register" data-toggle="modal" href="#" ><span class="icon-text">Register</span></a>
								
							</li>
							
							
							<li>
		
								<a id="signin-icon" data-toggle="modal" href="#" ><span class="icon-text">Sign In</span></a>
									
							</li>
							
														

							
									   
						</ul>
						
						
						</div>
					
					 
				
					
				</div>
			</div>	

		
		
</div>


			
					
			 <!--<div class="jumbotron hero" >-->
				  
			<div class="jumbotron hero" style="background-image:" > 
			
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			
					  <ol class="carousel-indicators">

					                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                <li data-target="#carousel-example-generic" data-slide-to="1" ></li>
                                                <li data-target="#carousel-example-generic" data-slide-to="2" ></li>
                                                <li data-target="#carousel-example-generic" data-slide-to="3" ></li>
                        				
					
					  </ol> 

					  <!-- Wrapper for slides -->
					  <div class="carousel-inner">
						  	
						<div class="item active">
						
									<div class=" container hero-in hero-in-1">
									  <div class="container">
									  <div class="col-md-7" style="padding-left: 78px;">
									  										<h2>slider1</h2> 																				<p>welcome to shopsy</p>																		
										<a class="banner-bt" href="#" target="_blank" />Read More</a> 									 
									  </div>
									 
									  </div>
									</div>
									
			             
						<img src="<?php $base_path; ?>images/theme/m,.j,_._1.jpg" /> 					
						 
						</div>
						
							  	
						<div class="item ">
						
									<div class=" container hero-in hero-in-1">
									  <div class="container">
									  <div class="col-md-7" style="padding-left: 78px;">
									  										<h2>slider2</h2> 																				<p>hello shopsy</p>																		
										<a class="banner-bt" href="#" target="_blank" />Read More</a> 									 
									  </div>
									 
									  </div>
									</div>
									
			             
						<img src="<?php echo $base_path; ?>images/theme/banner-admin2.jpg" /> 					
						 
						</div>
						
							  	
						<div class="item ">
						
									<div class=" container hero-in hero-in-1">
									  <div class="container">
									  <div class="col-md-7" style="padding-left: 78px;">
									  										<h2>slider3</h2> 																				<p>We connect the world</p>																		
										<a class="banner-bt" href="#" />Read More</a> 									 
									  </div>
									 
									  </div>
									</div>
									
			             
						<img src="<?php echo $base_path; ?>images/theme/Kalkkoegel-Senderstal_1.jpg" /> 					
						 
						</div>
						
							  	
						<div class="item ">
						
									<div class=" container hero-in hero-in-1">
									  <div class="container">
									  <div class="col-md-7" style="padding-left: 78px;">
									  										<h2>slider4</h2> 																				<p>dg dnbfvd nbfd</p>																			 
									  </div>
									 
									  </div>
									</div>
									
			             
						<img src="<?php echo $base_path; ?>images/theme/banner-admin3.jpg" /> 					
						 
						</div>
						
											  </div>
					  
					  
					 
	  
						 
						  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						  </a>
						  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						  </a>
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
</body><style>
header{
	margin-bottom: 0px;
}
</style>
<link href="css/animate.css" rel="stylesheet">
<!-- recent favorites  -->
<div id="landing_div">
<section class="second-bl">
  <div class="container">
    <h1>Featured Products</h1>
    <h5> </h5>
    <div class="">
      <div class="recent-fav">
        
		     
		<div class="col-md-4 rf-bl">
		  <div class="rf-bl-pic">
			<a href="#"><img src="images/theme/1439959362-art-941-dressing-table-dressing-tables-with-mirror.jpg" alt="recent"> </a>
		  </div>
		          <span class="cat-name">
			<a href="#">fghf</a>
		  </span> 
		   		  <span class="cat-name cat-price">
			<a href="#" > $0.72+ <span class="currencyType"> USD</span></a>
			 
		</span>
  
		  <div class="recent-bl">
           
          </div>
		  
		    <div class="recent-review" style="margin-top: -26px;"  > 
		  			<img src="<?php echo $base_path; ?>images/theme/280154645907643307_5d9a79396a30.jpg" alt="asdf" width="55px" class="img-circle" >
            <div class="recent-right">
              <p >From -  <a href="#"> asdf</a>
                </p>
				 <div   class="rating-input rating readonly-rating" data-score="4.50" ></div>
			  <span class="review-txt"> 2 Reviews</span>
              </div>
          </div>
         
        </div>
		
		     
		<div class="col-md-4 rf-bl">
		  <div class="rf-bl-pic">
			<a href="#"><img src="<?php echo $base_path; ?>images/theme/1439906515-pics-of-mehndi-designs-3-600x450.jpg" alt="recent"> </a>
		  </div>
		          <span class="cat-name">
			<a href="#">Pivot Alibaba Light</a>
		  </span> 
		   		  <span class="cat-name cat-price">
			<a href="#" > $456.00 <span class="currencyType"> USD</span></a>
			 
		</span>
  
		  <div class="recent-bl">
           
          </div>
		  
		    <div class="recent-review" style="margin-top: -26px;"  > 
		  			<img src="<?php echo $base_path; ?>images/theme/9002.jpg" alt="admin" width="55px" class="img-circle" >
            <div class="recent-right">
              <p >From -  <a href="shop-section/chennai"> admin</a>
                </p>
				 <div   class="rating-input rating readonly-rating" data-score="0.00" ></div>
			  <span class="review-txt"> 0 Reviews</span>
              </div>
          </div>
         
        </div>
		
		     
		<div class="col-md-4 rf-bl">
		  <div class="rf-bl-pic">
			<a href="#"><img src="<?php echo $base_path; ?>images/theme/1438696243-home-living-room-good-design-2-on-living-design-ideas.jpg" alt="recent"> </a>
		  </div>
		          <span class="cat-name">
			<a href="#">Art Painiting</a>
		  </span> 
		   		  <span class="cat-name cat-price">
			<a href="#" > $224.08 <span class="currencyType"> USD</span></a>
			 
		</span>
  
		  <div class="recent-bl">
           
          </div>
		  
		    <div class="recent-review" style="margin-top: -26px;"  > 
		  			<img src="images/theme/9002.jpg" alt="admin" width="55px" class="img-circle" >
            <div class="recent-right">
              <p >From -  <a href="#"> admin</a>
                </p>
				 <div   class="rating-input rating readonly-rating" data-score="0.00" ></div>
			  <span class="review-txt"> 0 Reviews</span>
              </div>
          </div>
         
        </div>
		
		        
      </div>
    </div>
  </div>
</section>



<section class="testimonial-img" > 
	<img src="images/fullview01.jpg" style="width:1350px;height: 350px;"   alt="usha" >
		  <div class="testimonial-block container">
		<div class="testi-in col-md-10"> 
			<span class="testi"> 
			
						
			<!--<a href="view-profile/usha"> -->
			<img src="images/theme/sun.jpg" altusha class="img-circle  ct-clock-img">
			<!--</a>-->	
			</span>
		    <h3><a href="#"  target="_blank"></a> </h3>
		     <span class="owner-details">
				 <em>Meet</em>
				 <a class="shop-name" href="shop-section/dhoni">
					<span class="user-name">usha</span> of Dhoni				</a>
				 				 <em>in</em> 
				 <span class="location">chennai</span>
				 			 </span> 
		</div>
	  </div>
</section>



<section class="second-bl third-bl">

	<div class="main-4">
	
	 <h1>Featured shop</h1>
	
		<ul class="hme-container col-md-12">
		
		
				
			<li class="col-md-6">
			
				<a href="#">
				
					<div class="image-container">
					
											<img src="images/dummyProductImage.jpg">
					
										
					</div>
										
				</a>
				
				<div class="shop-text-box">
				
						<img src="images/theme/user-thumb1.png" altgary="" class="shop-text-box-img">
						
					
					
						<span>jimmy</span>
								
				</div>
							
			</li> 			
			<li class="col-md-3">
			
				<a href="#">
				
					<div class="image-container">
										<img src="images/dummyProductImage.jpg">
					
										</div>
											
				</a>
				
				<div class="shop-text-box">
				
						<img  src="images/theme/sun.jpg" altgary="" class="shop-text-box-img">
						
					
					<span>usha</span>
								
				</div>
			
			</li>
						
			<li class="col-md-3 height-min">
			
				<a href="#">
				
					<div class="image-container">
					
										<img src="images/dummyProductImage.jpg">
					
										
					</div>
						
				</a>
				
				<div class="shop-text-box">
				
						<img src="images/theme/user-thumb1.png" altgary="" class="shop-text-box-img">
						
					
					
					<span>vijiprakash</span>
								
				</div>
			
			</li>
						
			<li class="col-md-3 height-min">
			
				<a href="#">
				
					<div class="image-container">
					
										
					<img src="images/banner/1431682090-decent-and-elegant-white-dresses-collection-for-girls-2013-12.jpg">
					
										
					</div>
					
				</a>
				
				<div class="shop-text-box">
				
						<img  src="images/theme/Gucci-brand-sunglasses-for-men-in-luxury-winter-style-2014-2015-2.jpg" altgary="" class="shop-text-box-img">
				
		
				
					
					
					<span>kumar</span>
								
				</div>
			
			</li>
						
			<li class="col-md-3">
			
				<a href="#">
				
					<div class="image-container">
					
										
					<img src="images/banner/banner-admin.jpg">
					
										
					</div>
					
				</a>
				
				<div class="shop-text-box">
				
						<img  src="images/theme/9002.jpg" altgary="" class="shop-text-box-img">
						
					
					<span>admin</span>
								
				</div>
			
			</li>
			
						
	
		</ul>
		
	
	
	</div>




</section>





<section class="second-bl third-bl">
  <div class="container">
    <h1>Top Sellers</h1>
    
    <div class="col-md-12 ct-block-cover-outside">
     
		
	<div class="ct-block-cover">
        <div class="tastemaker-desc"> 
				<img class="img-circle ct-clock-img"  src="images/theme/9002.jpg">
		          <p class="tastemaker-name"> 
			<a class="member-name" href="shop-section/chennai">Admin </p>
        </div>
        <div class="col-md-3  ct-block animateblock left">
		
														 
										 <div class="ct-img" >
								<a href="#" class="favorite-0">
								<div style="width=126px;height=92px;">	<img src="images/theme/1439906515-pics-of-mehndi-designs-3-600x450.jpg" width="126px" height="92px"  alt="Pivot Alibaba Light"></div>
								 </a>
							</div>
										
										                           
							
                            										 
										 <div class="ct-img" >
								<a href="#" class="favorite-1">
								<div style="width=126px;height=92px;">	<img src="images/theme/1438934784-12pc-white-sport-goose-font-b-feather-b-font-font-b-shuttlecocks-b-font-birdies-badminton.jpg" width="126px" height="92px"  alt="clothes"></div>
								 </a>
							</div>
										
										                           
							
                            										 
										 <div class="ct-img" >
								<a href="#" class="favorite-2">
								<div style="width=126px;height=92px;">	<img src="images/theme/1438944331-colorful-flowers-flower-hd-wallpaper.jpg" width="126px" height="92px"  alt="shopsy"></div>
								 </a>
							</div>
										
										                           
							
                            										 
										 <div class="ct-img" >
								<a href="#" class="favorite-3">
								<div style="width=126px;height=92px;">	<img src="images/theme/1438869239-3d_equalizer_music_wallpapers_hd_48_photos_wus.jpg" width="126px" height="92px"  alt="asdf"></div>
								 </a>
							</div>
										
										                           
							
                            			  
			 
			 
			 <span class="ct-txt">
			  <h3> Admin</h3>
			 <p> 7 Favourites</p>
						  
			  </span> <i class="fa fa-chevron-circle-right arrow-ic"></i> 
		</div>
      </div>

	  	
	<div class="ct-block-cover">
        <div class="tastemaker-desc"> 
				<img class="img-circle ct-clock-img"  src="images/theme/Gucci-brand-sunglasses-for-men-in-luxury-winter-style-2014-2015-2.jpg">
		          <p class="tastemaker-name"> 
			<a class="member-name" href="#">kumar </p>
        </div>
        <div class="col-md-3  ct-block animateblock left">
		
														 
										 <div class="ct-img" >
								<a href="#" class="favorite-0">
								<div style="width=126px;height=92px;">	<img src="images/theme/1440408152-latest-hitlife-vintage-jewelry-pearl-necklace-bracelet-storage-organizer-wood-case-gift-box-02-save-up.jpg" width="126px" height="92px"  alt="auction product"></div>
								 </a>
							</div>
										
										                           
							
                            										 
										 <div class="ct-img" >
								<a href="#" class="favorite-1">
								<div style="width=126px;height=92px;">	<img src="images/theme/1439885628-women.jpg" width="126px" height="92px"  alt="rings"></div>
								 </a>
							</div>
										
										                           
							
                            										 
										 <div class="ct-img" >
								<a href="#" class="favorite-2">
								<div style="width=126px;height=92px;">	<img src="images/theme/1439532955-penguins.jpg" width="126px" height="92px"  alt="new123"></div>
								 </a>
							</div>
										
										                           
							
                            										 
										 <div class="ct-img" >
								<a href="#" class="favorite-3">
								<div style="width=126px;height=92px;">	<img src="images/theme/1439461022-chrysanthemum.jpg" width="126px" height="92px"  alt="asa"></div>
								 </a>
							</div>
										
										                           
							
                            			  
			 
			 
			 <span class="ct-txt">
			  <h3> kumar</h3>
			 <p> 3 Favourites</p>
						  
			  </span> <i class="fa fa-chevron-circle-right arrow-ic"></i> 
		</div>
      </div>

	  	
	<div class="ct-block-cover">
        <div class="tastemaker-desc"> 
				<img class="img-circle ct-clock-img"  src="images/theme/280154645907643307_5d9a79396a30.jpg">
		          <p class="tastemaker-name"> 
			<a class="member-name" href="#">Ganesh </p>
        </div>
        <div class="col-md-3  ct-block animateblock left">
		
														 
										 <div class="ct-img" >
								<a href="#" class="favorite-0">
								<div style="width=126px;height=92px;">	<img src="images/theme/1440487733-371084868567696069_aacff9dc484d.jpg" width="126px" height="92px"  alt="Test Product1234"></div>
								 </a>
							</div>
										
										                           
							
                            										 
										 <div class="ct-img" >
								<a href="#" class="favorite-1">
								<div style="width=126px;height=92px;">	<img src="images/theme/1440425230-945494201330568516_51faf264a4a8.jpg" width="126px" height="92px"  alt="Murder Snapback by SSUR"></div>
								 </a>
							</div>
										
										                           
							
                            										 
										 <div class="ct-img" >
								<a href="#" class="favorite-2">
								<div style="width=126px;height=92px;">	<img src="images/theme/1439959362-art-941-dressing-table-dressing-tables-with-mirror.jpg" width="126px" height="92px"  alt="fghf"></div>
								 </a>
							</div>
										
										                           
							
                            										 
										 <div class="ct-img" >
								<a href="#" class="favorite-3">
								<div style="width=126px;height=92px;">	<img src="images/theme/1439959323-art-941-dressing-table-dressing-tables-with-mirror.jpg" width="126px" height="92px"  alt="fghf"></div>
								 </a>
							</div>
										
										                           
							
                            			  
			 
			 
			 <span class="ct-txt">
			  <h3> Ganesh</h3>
			 <p> 3 Favourites</p>
						  
			  </span> <i class="fa fa-chevron-circle-right arrow-ic"></i> 
		</div>
      </div>

	  	
	<div class="ct-block-cover">
        <div class="tastemaker-desc"> 
				<img class="img-circle ct-clock-img"  src="images/theme/Eyeglasses-frame-Men-titanium-glasses-box-ultra-light-tr90-male-big-frame-glasses_(1).png">
		          <p class="tastemaker-name"> 
			<a class="member-name" href="#">Jayaprakash </p>
        </div>
        <div class="col-md-3  ct-block animateblock left">
		
														 
										 <div class="ct-img" >
								<a href="#" class="favorite-0">
								<div style="width=126px;height=92px;">	<img src="images/theme/1438751621-3-fixtures.jpg" width="126px" height="92px"  alt="Men Dresses"></div>
								 </a>
							</div>
										
										                           
							
                            										 
										 <div class="ct-img" >
								<a href="#" class="favorite-1">
								<div style="width=126px;height=92px;">	<img src="images/theme/1438675430-modern-dining-tables-brisbane.jpg" width="126px" height="92px"  alt="Sample Product"></div>
								 </a>
							</div>
										
										                           
							
                            										 
										 <div class="ct-img" >
								<a href="#" class="favorite-2">
								<div style="width=126px;height=92px;">	<img src="images/theme/8f96e3e6f2377922d61cf9c5f4c3ddcb.jpg" width="126px" height="92px"  alt="Tussie Mussies Mothers Grandmothers Bridal Party Bouquets"></div>
								 </a>
							</div>
										
										                           
							
                            										 
										 <div class="ct-img" >
								<a href="#" class="favorite-3">
								<div style="width=126px;height=92px;">	<img src="images/theme/002d4341aa6cca12a01fe35e3a160d1b.jpg" width="126px" height="92px"  alt="Navy and Ivory Custom Satin Brooch Bridal Bouquet"></div>
								 </a>
							</div>
										
										                           
							
                            			  
			 
			 
			 <span class="ct-txt">
			  <h3> Jayaprakash</h3>
			 <p> 2 Favourites</p>
						  
			  </span> <i class="fa fa-chevron-circle-right arrow-ic"></i> 
		</div>
      </div>

	  	  
      
    </div>
   
  </div>
</section>






<section class="second-bl">
  <div class="container">
    <h1>Recent Products</h1>
    <h5> </h5>
    <div class="">
      <div class="recent-fav">
        
		     
		<div class="col-md-4 rf-bl animateblock right1">
		  <div class="rf-bl-pic">
			<a href="#"><img src="images/theme/1440487733-371084868567696069_aacff9dc484d.jpg" alt="recent"> </a>
      
		  </div>
		
          <span class="cat-name">
			<a href="#">Test Product1234</a>
		  </span> 
		   		  <span class="cat-name cat-price">
			<a href="#" style="font-size:large;"> $100.00 <span class="currencyType"> USD <span> </a> &nbsp;&nbsp;  
		</span>
		  
		  <div class="recent-bl">
          </div>
		  
		    <div class="recent-review" style="margin-top: -26px;" > 
		  			<img src="images/theme/280154645907643307_5d9a79396a30.jpg" alt="asdf" width="55px" class="img-circle" >
            <div class="recent-right" >
              <p >From -  <a href="shop-section/ganesh-shop"> asdf</a>
                </p>
				 <div   class="rating-input rating readonly-rating" data-score="4.50" ></div>
			  <span class="review-txt"> 2 Reviews</span>
              </div>
          </div>
         
        </div>
		
		     
		<div class="col-md-4 rf-bl animateblock right1">
		  <div class="rf-bl-pic">
			<a href="#"><img src="images/theme/1440425230-945494201330568516_51faf264a4a8.jpg" alt="recent"> </a>
      
		  </div>
		
          <span class="cat-name">
			<a href="#">Murder Snapback by SSUR</a>
		  </span> 
		   		  <span class="cat-name cat-price">
			<a href="#" style="font-size:large;"> $24.00 <span class="currencyType"> USD <span> </a> &nbsp;&nbsp;  
		</span>
		  
		  <div class="recent-bl">
          </div>
		  
		    <div class="recent-review" style="margin-top: -26px;" > 
		  			<img src="images/theme/280154645907643307_5d9a79396a30.jpg" alt="asdf" width="55px" class="img-circle" >
            <div class="recent-right" >
              <p >From -  <a href="#"> asdf</a>
                </p>
				 <div   class="rating-input rating readonly-rating" data-score="4.50" ></div>
			  <span class="review-txt"> 2 Reviews</span>
              </div>
          </div>
         
        </div>
		
		     
		<div class="col-md-4 rf-bl animateblock right1">
		  <div class="rf-bl-pic">
			<a href="#"><img src="images/theme/1440408152-latest-hitlife-vintage-jewelry-pearl-necklace-bracelet-storage-organizer-wood-case-gift-box-02-save-up.jpg" alt="recent"> </a>
      
		  </div>
		
          <span class="cat-name">
			<a href="#">auction product</a>
		  </span> 
		   		  <span class="cat-name cat-price">
			<a href="#" style="font-size:large;"> $100.00 <span class="currencyType"> USD <span> </a> &nbsp;&nbsp;  
		</span>
		  
		  <div class="recent-bl">
          </div>
		  
		    <div class="recent-review" style="margin-top: -26px;" > 
		  			<img src="images/theme/Gucci-brand-sunglasses-for-men-in-luxury-winter-style-2014-2015-2.jpg" alt="kumar" width="55px" class="img-circle" >
            <div class="recent-right" >
              <p >From -  <a href="#"> kumar</a>
                </p>
				 <div   class="rating-input rating readonly-rating" data-score="5.00" ></div>
			  <span class="review-txt"> 2 Reviews</span>
              </div>
          </div>
         
        </div>
		
		        
      </div>
    </div>
  </div>
</section>











<!---------- Testmonial banners section ----->



<section class="second-bl" style="padding-bottom:0;">
  <div class="container">
  
  <div class="row icon-bloclk">
<div class="col-md-4 icon-bl"><img src="uploaded/icon-1.png" alt="" />
<h1>Customer Satification</h1>
<p>Get to know shops and items with reviews from our community.</p>
</div>
<div class="col-md-4 icon-bl"><img src="uploaded/icon-2.png" alt="" />
<h1>Unlimited Sellers.</h1>
<p>Buy from creative people who care about quality and craftsmanship.</p>
</div>
<div class="col-md-4 icon-bl"><img src="uploaded/icon-3.png" alt="" />
<h1>Secure Transactions</h1>
<p>Feel confident knowing our Trust &amp; Safety team is here to protect you.</p>
</div>
</div>  
    <div class="col-md-12 get-pro">  
		Get top trends and fresh editors' picks<br>
		in your inbox with Shopsy V2 
		Finds.
	  
	  <span class="subcribe-box ">
	  
	  <form method="post" class="subscribe-form" action="#">

        <input type="text" placeholder="Enter Your E-mail address"  name="emaill" id="emailtext">
		<input type="submit" value="Subscribe" onClick="return subscribe_user();"class="search-bt">	<br/>
		<span id="suscribeemailErr" style="background:#FFEEEE;border:1px solid #FFC0CB;color:#000000;color:#F00;font-size: 12px !important;padding: 4px 5px;display:none;"></span>
		<span id="SpecialErr" style="background:#FFEEEE;border:1px solid #FFC0CB;color:#000000;color:#F00;font-size: 12px !important;padding: 4px 5px;display:none;"></span>

    </form>
      </span> </div>
  </div>
</section>
</div>





<script type="text/javascript"><!--
 $(document).ready(function() {
    $("#emailtext").blur(function() {
		 $("#msgbox").html('');
		var a = $("#emailtext").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		if(filter.test(a)) {
        //remove all the class add the messagebox classes and start fading
        //$("#msgbox").removeClass().addClass('messagebox').text('Checking...').fadeIn("slow");
        //check the username exists or not from ajax keyup mouseout

        $.post("site/user/check_user_availability",{ emaill:$(this).val() } ,function(data) {
            if(data=='no') {
                $("#msgbox").fadeTo(200,0.1,function() {  //start fading the messagebox

                    //add message and change the class of the box and start fading
                    $(this).html('Email Id is Already exists').addClass('messageboxerror').fadeTo(900,1);
                });

            }
            else if(data=='yes') {
                $("#msgbox").fadeTo(200,0.1,function() {  //start fading the messagebox
                    //add message and change the class of the box and start fading
                    $(this).html('Email Id is Available').addClass('messageboxok').fadeTo(900,1);    
                });
            }
        });

		}
		/*else{
		$("#msgbox").fadeTo(200,0.1,function() {  //start fading the messagebox
		//add message and change the class of the box and start fading
		$(this).html('Please enter valid email id').addClass('messageboxerror').fadeTo(900,1);    
		});
		}*/
    });
	
	/*$('.rating.readonly-rating').raty({

			readOnly: true,
			path:'js/img',
			score: function() {
				return $(this).attr('data-score');
			}
		 });	
*/
});  
</script>    
<section class="second-bl third-bl foot-bg">  
  <footer class="container">
    <div class="row">
      <div class="col-md-3 footer-block"> 
				<span class="footer-head no-ul">Turn Your Passion Into a Business</span>
        <a href="#"><div class="search-bt col-md-6 col-xs-4 op-bt">Open a Shop</div></a>
				
		<span class="footer-head">Sell on Shopsy V2</span>
		
        <ul class="footer-list">
          
          <li><a href="#">Browse all shops</a></li>
			<li><a href="#">Search by location</a></li>
        </ul>
      </div>
	  
	    <div class="col-lg-3  footer-block"><span class="footer-head no-ul">Join the Community</span> 
<ul class="footer-list">
<li><a href="#">Community</a></li>
<li><a href="#">Teams</a></li>
<li><a href="#">Upcoming Events</a></li>
</ul>
</div>		<div class="col-md-2 footer-block"><span class="footer-head">Discover and Shop</span> 
<ul class="footer-list">
<li><a href="#">Gift Cards</a></li>
<li><a href="#">Blog</a>s</li>
<li><a href="#">Gift Registries</a></li>
</ul>
</div>		<div class="col-md-2 footer-block"><span class="footer-head">Get to Know Us</span> 
<ul class="footer-list">
<li><a href="#">About</a></li>
<li><a href="#">Careers</a></li>
<li><a href="#">Contact</a></li>
</ul>
</div>	    <div class="col-md-2 footer-block"><span class="footer-head">Follow Shopsy</span> 
<ul class="footer-list">
<li> <a href="#" target="_blank"> <img src="uploaded/facebook-icon.png" alt="" width="16" height="16" /> Facebook </a> </li>
<li> <a href="#" target="_blank"> <img src="uploaded/twitter-icon.png" alt="" width="16" height="16" /> Twitter </a> </li>
<li> <a href="#" target="_blank"> <img src="uploaded/pinterest-icon.png" alt="" width="16" height="16" /> Pintrest </a> </li>
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
        <li><a data-toggle="modal" id="language_href" href="#" onclick="javascript:$('#languageTab').trigger('click');">  English</a></li>
        <li><a data-toggle="modal" id="currency_href" href="#" onclick="javascript:$('#currencyTab').trigger('click');"> $ USD</a></li>
      </ul>
      <a href="#"><div class="help-bt">Help</div></a>
    </div>
    <ul class="bt-menu">
      <li id="copy"> @ 2015 Shopsy, Inc.</li>
      <li><a href="#">Terms</a></li>
      <li><a href="#">Privacy</a></li>
      <li><a href="#">Copyright</a></li>
   </ul>
	
  </footer>
</section>
    
<!-- Geo Start -->

<!-- Geo End --> 	


<!-- <script src="js/front/bootstrap-rating-input.min.js"></script>  -->

<!-- Include all compiled plugins (below), or include individual files as needed --> 
 
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
													
									<input type="hidden" name="returnUrl" value="http://192.168.1.251:8081/shopsy-v2/">
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
<!-- footer_end -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function(){
  var $elems = $('.animateblock');
  var winheight = $(window).height();
  var fullheight = $(document).height();
  
  $(window).scroll(function(){
    animate_elems();
  });
  
  function animate_elems() {
    wintop = $(window).scrollTop(); // calculate distance from top of window
 
    // loop through each item to check when it animates
    $elems.each(function(){
      $elm = $(this);
      
      if($elm.hasClass('animated')) { return true; } // if already animated skip to the next item
      
      topcoords = $elm.offset().top; // element's distance from top of page in pixels
      
      if(wintop > (topcoords - (winheight*.75))) {
        // animate when top of the window is 3/4 above the element
        $elm.addClass('animated');
      }
    });
  } // end animate_elems()
});
</script>
<script>
	$('a').click(function(){
		alert('You are in preview mode');
		return false;
	});
</script>