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

			<title>Cart</title>
		
<meta name="Title" content="Cart" />
<meta name="keywords" content="Shopsy V2" />
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






 
<script>
	$('a').click(function(){
		alert('You are in preview mode');
		return false;
	});
</script>
<script type="text/javascript">
		var baseURL = '<?php echo $base_path; ?>';
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
		<link href="./theme/themecss_<?php echo $instance->session->userdata('Curr_theme_name'); ?>Cart-page.css" rel="stylesheet">
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
						<a href="cart"><i class="fa fa-shopping-cart"></i>Cart						<span id="CartCount1" class="CartCount1"> 1</span> 
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
								<span id="CartCount1" class="CartCount1"> 1</span>
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
<div id="cart_div">
	<section class="container">
		<div class="s-cart">
			<!-- Cart Content Starts-->
				
			
			<div class="">
               	<h1><span id="Shop_id_count">1</span> Items in Your Cart </h1>
            	<a href="home" class="search-bt col-md-6 col-xs-4 op-bt s-cart-button">Keep Shopping</a>
				
			
   
				
         	</div>
			
				<div id="UserCartTable_1" class="s-cart-bl">
				<div class="s-cart-bl-header">
                	<h2>
                    	 Order from 
						<a href="shop-section/chennai">Chennai</a>
                        <span class="cart_icons"><a href="javascript:void(0);" class="close-btn" onclick="sellerCartdelete(1);"></a>
                        </span>
                    </h2>
				</div>

				<form method="post" name="cartSubmit" id="cartSubmit" class="continue_payment" enctype="multipart/form-data" action="site/cart/usercartcheckout">
				<div class="order-wrapper card_for_temp">
                    <div class="order-wrapper-left col-md-9 card_for_temp"><div class="s-item-details" id="UsercartdivId_0">
															<a href="products/sdfg" class="s-item-details-img">
																<img src="images/theme/1438867882-61ilzr59kbl.jpg" alt="item">
															</a>
															<div class="s-item-details-right col-md-8">
																<h3>
																	<a href="products/sdfg"> sdfg</a></h3>
																<div class="s-quality"><label>Quantity : </label>
																	<select name="userquantity0" id="userquantity0" data-mqty="14" onchange="javascript:update_cart_user(333,0,1)"><option selected="selected" value="1"  >1</option><option  value="2"  >2</option><option  value="3"  >3</option><option  value="4"  >4</option><option  value="5"  >5</option><option  value="6"  >6</option><option  value="7"  >7</option><option  value="8"  >8</option><option  value="9"  >9</option><option  value="10"  >10</option><option  value="11"  >11</option><option  value="12"  >12</option><option  value="13"  >13</option><option  value="14"  >14</option></select><br/><span> 
																	$1000.00 USD + $0.00 USD Shipping 
																	</span><span id="UserIndTotalVal0_1" >
																		Total : $1000.00 USD
																	</span>
																</div><ul class="s-actions"><li><a href="javascript:void(0);" onclick="javascript:delete_cart_user(333,0,1)">Remove</a></li>
																	</ul></div>
																</div><div class="s-opninon-box">
																<label>Note to chennai Optional</label>
																<textarea name="note" data-id="cart-note" placeholder="You can enter any info needed to complete your order or write a note to the shop"></textarea>
															</div>
														</div>
														
					<div class="col-md-3 order-summay"><p class="ship_to">Ship to</p>
						<select id="address-cart" class="ship_to" onchange="UserCartChangeAddress(this.value,1);">
							<option value="" id="address-select">Choose Your Shipping Address</option></select>
						
						<p class=""><span id="Chg_Add_Val_1"></span></p>
						<span style="color:#FF0000;" id="User_Ship_err_1"></span>
						<a href="settings/cart-shipping-address" class="add_addr add_" onclick="shipping_address_cart();">Add new shipping address</a><input type="hidden" name="Ship_address_val" id="User_Ship_address_val_1" value="" />
						<input type="hidden" name="digital_item" value="No" />
						<div class="order-payment">
							<h4>How You will Pay</h4>
							<ul class="payment-option"><li><input type="radio"  name="payment_value" value="Paypal" ><label><span class="paypal-plus-cards">paypal</span></label></li><li><input type="radio"  name="payment_value" value="Credit-Card" ><label><span class="cc-icons ">Credit Card</span></label></li><li><input type="radio"  name="payment_value" value="twocheckout" ><img width="100px" src="images/twocheckout.png" /></li><li><input type="radio"  name="payment_value" value="Stripe" ><label><span class=" "><img src="images/stripe.png" /></span></label></li><li><input type="radio"  name="payment_value" value="pesapal" ><label><span class=" "><img src="images/pesapal.jpg" /></label></li><li><input type="radio"  name="payment_value" value="BrainTree" ><img width="100px" src="images/braintree.jpg" /></li><li><input type="radio"  name="payment_value" value="COD" ><label><span class=" "><img src="images/cod.png" /></span></label></li>
									<li>
									<input name="userCredits" id="userCredit_1" value="" type="hidden">
									<input type="radio" name="payment_value" value="userCredits" onclick="apply_userCredits(this,1)"><label>Use Your Credits ($<span>0.00</span></b> USD)</label><div id="creditErr" style="color:#FF0000;"></div></li>
									</ul>
									<!--<a href="javascript:void(0);" id="shopcoupon1" onclick="apply_coupon_code(1);">Apply shop coupon code</a>-->
									<div class="clear"></div><div class="copun_apply" id="Coupon_apply_1" style="display:none;">
												<span id="CouponErr_1" style="color:#FF0000;"></span>
												<label>Coupon Codes</label>
												<input id="is_coupon_1" name="is_coupon" class="coupon" placeholder="Have a coupon code?" type="text">
												<input type="button" id="CheckCodeButton" class="keep_btn" onclick="javascript:checkCode(1);" value="Apply" style="cursor:pointer;margin: 4px 0px 0px 75px;" />
											</div><table width="100%" class="payment-total" id="payment-total">
                            	<tbody>
                                	<tr>
                                    	<td class="txt_right">Item Details</td>
                                        <td>$<span id="UserCartAmt_1">1000.00</span> USD</td>
                                    </tr>
                                    <tr>
                                    	<td>Shipping</td>
                                        <td class="txt_right">$<span id="UserCartSAmt_1">0.00</span></b> USD</td>
                                    </tr>
                                    <tr>									
                                    	<td>Tax (<span id="UsercarTamt_1">0</span>%) of $<span id="UserCartAmtDup_1">1000</span></td>
                                        <td class="txt_right">$<span id="UserCartTAmt_1">0.00</span></b> USD</td>
                                    </tr><tr class="divider">
																<td colspan="2"></td>
															</tr>
															<tr class="grand-total">
																<td>Order total</td>
																<td class="monetary"> <strong>$<span id="UserCartGAmt_1">1000.00</span></b> USD</strong> </td>
															</tr>
														</tbody>
								</table>
		    <input name="user_id" value="936623" type="hidden">
			 <input name="sell_id" value="1" type="hidden">
			<input name="user_cart_amount" id="user_cart_amount_1" value="1000.00" type="hidden">
			<input name="user_cart_ship_amount" id="user_cart_ship_amount_1" value="0.00" type="hidden">
			<input name="user_cart_tax_amount" id="user_cart_tax_amount_1" value="0.00" type="hidden">
			<input name="user_cart_tax_Value" id="user_cart_tax_Value_1" value="0.00" type="hidden">
			<input name="user_cart_total_amount" id="user_cart_total_amount_1" value="1000.00" type="hidden">
			<input name="user_discount_Amt" id="user_discount_Amt_1" value="0.00" type="hidden"><input name="CouponCode" id="CouponCode" value="" type="hidden">
				<input name="Coupon_id" id="Coupon_id" value="0" type="hidden">
				<input name="couponType" id="couponType" value="" type="hidden"><input type="submit" class="order-submit btn-transaction" name="cartPayment" id="button-submit-merchant" value="Proceed to checkout"/></div>
									</div>
								</div>
							</form>
					</div>
			
			 <div class="cart_items" id="EmptyCart" style="display:none;">
                	<h2>
                    	<span class="shop-name"><span class="shop-name1">Your Shopping Cart is Empty</span></span>
                        <span class="cart_icons">
                            <!--<a href="#" class="close-btn"></a>-->
                        </span>
                    </h2>
					 <div class="cart_details">
					 <div  class="empty-alert card_for_temp" >
					<p style="text-align:center;"><img src="images/site/shopping_empty.jpg" alt="Shopping Cart Empty"></p>
					<p style="text-align:center;"><b></b></p>
					<p style="text-align:center;">Don`t miss out on awesome sales right here on Shopsy V2. Let`s fill that cart, shall we?</p>
				</div>
					 </div>
			</div>		
			
							<!-- Cart Content Ends-->
				<!-- Related Itrem Starts-->
							<h1>You might also like…  </h1>
				<ul class="suggestion-list">					 
																												<li class="suggestion col-md-4">																					
												<div class="listing-details"> 												
																										<a href="http://192.168.1.251:8081/shopsy-v2/products/hjy">
														<img alt="1431936075-464736728_452.jpg" src="images/product/thumb/1431936075-464736728_452.jpg">
													</a>
													<div class="listing-text">												
														<div class="title">
															<a href="http://192.168.1.251:8081/shopsy-v2/products/hjy">
																hjy															</a>
														</div>
														<div class="shop-name">By 
															<a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a>
														</div>
													</div>
												</div>
												<div class="cart-tools">
													<div class="price"> 
														$															123 
														USD 
													</div>
													<a class="btn-transaction order-submit cart-btn" href="http://192.168.1.251:8081/shopsy-v2/products/hjy"> Detail </a>
												</div>
											</li>
																																						<li class="suggestion col-md-4">																					
												<div class="listing-details"> 												
																										<a href="http://192.168.1.251:8081/shopsy-v2/products/hgh-1">
														<img alt="1436965252-lighthouse.jpg" src="images/theme/1436965252-lighthouse.jpg">
													</a>
													<div class="listing-text">												
														<div class="title">
															<a href="http://192.168.1.251:8081/shopsy-v2/products/hgh-1">
																hgh															</a>
														</div>
														<div class="shop-name">By 
															<a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a>
														</div>
													</div>
												</div>
												<div class="cart-tools">
													<div class="price"> 
														$															23 
														USD 
													</div>
													<a class="btn-transaction order-submit cart-btn" href="http://192.168.1.251:8081/shopsy-v2/products/hgh-1"> Detail </a>
												</div>
											</li>
																																						<li class="suggestion col-md-4">																					
												<div class="listing-details"> 												
																										<a href="http://192.168.1.251:8081/shopsy-v2/products/art-test">
														<img alt="1437132029-3-fixtures.jpg" src="images/theme/1437132029-3-fixtures.jpg">
													</a>
													<div class="listing-text">												
														<div class="title">
															<a href="http://192.168.1.251:8081/shopsy-v2/products/art-test">
																Art Test															</a>
														</div>
														<div class="shop-name">By 
															<a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a>
														</div>
													</div>
												</div>
												<div class="cart-tools">
													<div class="price"> 
														$															100 
														USD 
													</div>
													<a class="btn-transaction order-submit cart-btn" href="http://192.168.1.251:8081/shopsy-v2/products/art-test"> Detail </a>
												</div>
											</li>
																																						<li class="suggestion col-md-4">																					
												<div class="listing-details"> 												
																										<a href="http://192.168.1.251:8081/shopsy-v2/products/product-title">
														<img alt="1437031693-1024.png" src="images/theme/1437031693-1024.png">
													</a>
													<div class="listing-text">												
														<div class="title">
															<a href="http://192.168.1.251:8081/shopsy-v2/products/product-title">
																Product title															</a>
														</div>
														<div class="shop-name">By 
															<a href="http://192.168.1.251:8081/shopsy-v2/shop-section/chennai">chennai</a>
														</div>
													</div>
												</div>
												<div class="cart-tools">
													<div class="price"> 
														$															10 
														USD 
													</div>
													<a class="btn-transaction order-submit cart-btn" href="http://192.168.1.251:8081/shopsy-v2/products/product-title"> Detail </a>
												</div>
											</li>
																																						<li class="suggestion col-md-4">																					
												<div class="listing-details"> 												
																										<a href="http://192.168.1.251:8081/shopsy-v2/products/newproduct">
														<img alt="1438350393-spots.jpg" src="images/theme/1438350393-spots.jpg">
													</a>
													<div class="listing-text">												
														<div class="title">
															<a href="http://192.168.1.251:8081/shopsy-v2/products/newproduct">
																newproduct															</a>
														</div>
														<div class="shop-name">By 
															<a href="http://192.168.1.251:8081/shopsy-v2/shop-section/rko">rko</a>
														</div>
													</div>
												</div>
												<div class="cart-tools">
													<div class="price"> 
														$															122 
														USD 
													</div>
													<a class="btn-transaction order-submit cart-btn" href="http://192.168.1.251:8081/shopsy-v2/products/newproduct"> Detail </a>
												</div>
											</li>
																																		 
						
				</ul>
						<!-- Related Item Ends-->
		</div>
	</section>
</div>
<style>
.error_message {
    background-color: #fedfdf;
	color: #333;
}
</style>
<a href="#contact_shop_owner_pop" id="contact_shop_owner_link" data-toggle="modal"></a>

	<div id='contact_shop_owner_pop' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="contact_shopowner_content">
			
			
			</div>
		</div>
	</div>



<script type="text/javascript" src="js/site/jquery.validate.js"></script>
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
													
									<input type="hidden" name="returnUrl" value="http://192.168.1.251:8081/shopsy-v2/cart">
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