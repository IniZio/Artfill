<script type="text/javascript">
		var baseURL = '<?php echo base_url();?>';
		var BaseURL = '<?php echo base_url();?>';
		var currencySymbol = '<?php echo $currencySymbol;?>';
		var siteTitle = '<?php echo $siteTitle;?>';
		var can_show_signin_overlay = false;
		var currUrls = '<?php echo addslashes($this->uri->segment(4)); ?>';		


<?php if ($this->lang->line('atleast_one_del')!=''){?> 
var atleast_one_del = '<?php echo addslashes($this->lang->line('atleast_one_del'));?>';
<?php }else {?>
var atleast_one_del = 'You should select atleast one message to delete.';
<?php }?>


<?php if ($this->lang->line('are_u_sure')!=''){?> 
var are_u_sure = '<?php echo addslashes($this->lang->line('are_u_sure'));?>';
<?php }else {?>
var are_u_sure = 'Are you sure want to Continue?';
<?php }?>

<?php if ($this->lang->line('folder_empty')!=''){?> 
var folder_empty = '<?php echo addslashes($this->lang->line('folder_empty'));?>';
<?php }else {?>
var folder_empty = 'This Folder is Empty';
<?php }?>

<?php if ($this->lang->line('whn_mke')!=''){?> 
var whn_mke = '<?php echo addslashes($this->lang->line('whn_mke'));?>';
<?php }else {?>
var whn_mke = 'When did you make it?';
<?php }?>

<?php if ($this->lang->line('shop_mke')!=''){?> 
var shop_mke = '<?php echo addslashes($this->lang->line('shop_mke'));?>';
<?php }else {?>
var shop_mke = 'When did your shop make it?';
<?php }?>

<?php if ($this->lang->line('whn_made')!=''){?> 
var whn_made = '<?php echo addslashes($this->lang->line('whn_made'));?>';
<?php }else {?>
var whn_made = 'When was it made?';
<?php }?>

<?php if ($this->lang->line('atleast_one_payment')!=''){?> 
var atleast_one_payment = '<?php echo addslashes($this->lang->line('atleast_one_payment'));?>';
<?php }else {?>
var atleast_one_payment = 'Please Select atleast one payment option';
<?php }?>

<?php //aaaa

if ($this->lang->line('enter_shop_name')!=''){?> 
var enter_shop_name = '<?php echo addslashes($this->lang->line('enter_shop_name'));?>';
<?php }else {?>
var enter_shop_name = 'Enter Your Shop name';
<?php }?>


<?php 

if ($this->lang->line('conf_mail_sent')!=''){?> 
var conf_mail_sent = '<?php echo addslashes($this->lang->line('conf_mail_sent'));?>';
<?php }else {?>
var conf_mail_sent = 'Confirmation Mail Sent Successfully';
<?php }?>

<?php if ($this->lang->line('credit_card_num')!=''){?> 
var credit_card_num = '<?php echo addslashes($this->lang->line('credit_card_num'));?>';
<?php }else {?>
var credit_card_num = 'Please enter a credit card number.';
<?php }?>

<?php if ($this->lang->line('credit_card_num_digit')!=''){?> 
var credit_card_num_digit = '<?php echo addslashes($this->lang->line('credit_card_num_digit'));?>';
<?php }else {?>
var credit_card_num_digit = 'The credit card number must contain only digits.';
<?php }?>

<?php if ($this->lang->line('cvv_num')!=''){?> 
var cvv_num = '<?php echo addslashes($this->lang->line('cvv_num'));?>';
<?php }else {?>
var cvv_num = 'Please enter a CCV number';
<?php }?>

<?php if ($this->lang->line('cvv_num_digit')!=''){?> 
var cvv_num_digit = '<?php echo addslashes($this->lang->line('cvv_num_digit'));?>';
<?php }else {?>
var cvv_num_digit = 'The CCV number must contain only digits.';
<?php }?>

<?php if ($this->lang->line('enter_name')!=''){?> 
var enter_name = '<?php echo addslashes($this->lang->line('enter_name'));?>';
<?php }else {?>
var enter_name = 'Please enter a name';
<?php }?>

<?php if ($this->lang->line('enter_phone_num')!=''){?> 
var enter_phone_num = '<?php echo addslashes($this->lang->line('enter_phone_num'));?>';
<?php }else {?>
var enter_phone_num = 'Please enter a phone number.';
<?php }?>

<?php if ($this->lang->line('phone_num_digit')!=''){?> 
var phone_num_digit = '<?php echo addslashes($this->lang->line('phone_num_digit'));?>';
<?php }else {?>
var phone_num_digit = 'The phone number must have at least 10 digits.';
<?php }?>

<?php if ($this->lang->line('enter_street')!=''){?> 
var enter_street = '<?php echo addslashes($this->lang->line('enter_street'));?>';
<?php }else {?>
var enter_street = 'Please enter a street';
<?php }?>

<?php if ($this->lang->line('enter_city')!=''){?> 
var enter_city = '<?php echo addslashes($this->lang->line('enter_city'));?>';
<?php }else {?>
var enter_city = 'Please enter a city.';
<?php }?>

<?php if ($this->lang->line('enter_province')!=''){?> 
var enter_province = '<?php echo addslashes($this->lang->line('enter_province'));?>';
<?php }else {?>
var enter_province = 'Please enter a state / province / region.';
<?php }?>

<?php if ($this->lang->line('enter_zipcode')!=''){?> 
var enter_zipcode = '<?php echo addslashes($this->lang->line('enter_zipcode'));?>';
<?php }else {?>
var enter_zipcode = 'Please enter a zip / postal code.';
<?php }?>


<?php if ($this->lang->line('sel_country')!=''){?> 
var sel_country = '<?php echo addslashes($this->lang->line('sel_country'));?>';
<?php }else {?>
var sel_country = 'Please select a country.';
<?php }?>


<?php if ($this->lang->line('sel_month')!=''){?> 
var sel_month = '<?php echo addslashes($this->lang->line('sel_month'));?>';
<?php }else {?>
var sel_month = 'Please select a month.';
<?php }?>


<?php if ($this->lang->line('sel_year')!=''){?> 
var sel_year = '<?php echo addslashes($this->lang->line('sel_year'));?>';
<?php }else {?>
var sel_year = 'Please select a year.';
<?php }?>

<?php if ($this->lang->line('gift_code')!=''){?> 
var gift_code = '<?php echo addslashes($this->lang->line('gift_code'));?>';
<?php }else {?>
var gift_code = 'Enter Gift Code';
<?php }?>

<?php if ($this->lang->line('shop_country')!=''){?> 
var shop_country = '<?php echo addslashes($this->lang->line('shop_country'));?>';
<?php }else {?>
var shop_country = 'Select Country';
<?php }?>

<?php if ($this->lang->line('cant_blank')!=''){?> 
var cant_blank = '<?php echo addslashes($this->lang->line('cant_blank'));?>';
<?php }else {?>
var cant_blank = 'Can\'t be blank';
<?php }?>

<?php if ($this->lang->line('prod_add_cart')!=''){?> 
var prod_add_cart = '<?php echo addslashes($this->lang->line('prod_add_cart'));?>';
<?php }else {?>
var prod_add_cart = 'Product Added in your cart';
<?php }?>

<?php //aaa

if ($this->lang->line('show')!=''){?> 
var lg_show = '<?php echo addslashes($this->lang->line('show'));?>';
<?php }else {?>
var lg_show = 'Show';
<?php }?>

<?php if ($this->lang->line('lg_entries')!=''){?> 
var lg_entries = '<?php echo addslashes($this->lang->line('lg_entries'));?>';
<?php }else {?>
var lg_entries = 'entries';
<?php }?>

<?php if ($this->lang->line('seller_srch')!=''){?> 
var seller_srch = '<?php echo addslashes($this->lang->line('seller_srch'));?>';
<?php }else {?>
var seller_srch = 'Search';
<?php }?>

<?php if ($this->lang->line('no_record')!=''){?> 
var no_record = '<?php echo addslashes($this->lang->line('no_record'));?>';
<?php }else {?>
var no_record = 'No Record Found';
<?php }?>

<?php if ($this->lang->line('lg_showing')!=''){?> 
var lg_showing = '<?php echo addslashes($this->lang->line('lg_showing'));?>';
<?php }else {?>
var lg_showing = 'Showing';
<?php }?>

<?php if ($this->lang->line('lg_to')!=''){?> 
var lg_to = '<?php echo addslashes($this->lang->line('lg_to'));?>';
<?php }else {?>
var lg_to = 'to';
<?php }?>

<?php if ($this->lang->line('lg_of')!=''){?> 
var lg_of = '<?php echo addslashes($this->lang->line('lg_of'));?>';
<?php }else {?>
var lg_of = 'of';
<?php }?>

<?php if ($this->lang->line('lg_first')!=''){?> 
var lg_first = '<?php echo addslashes($this->lang->line('lg_first'));?>';
<?php }else {?>
var lg_first = 'First';
<?php }?>

<?php if ($this->lang->line('lg_previous')!=''){?> 
var lg_previous = '<?php echo addslashes($this->lang->line('lg_previous'));?>';
<?php }else {?>
var lg_previous = 'Previous';
<?php }?>

<?php if ($this->lang->line('lg_next')!=''){?> 
var lg_next = '<?php echo addslashes($this->lang->line('lg_next'));?>';
<?php }else {?>
var lg_next = 'Next';
<?php }?>

<?php if ($this->lang->line('lg_last')!=''){?> 
var lg_last = '<?php echo addslashes($this->lang->line('lg_last'));?>';
<?php }else {?>
var lg_last = 'Last';
<?php }?>

<?php if ($this->lang->line('enter_ur_cmt')!=''){?> 
var enter_ur_cmt = '<?php echo addslashes($this->lang->line('enter_ur_cmt'));?>';
<?php }else {?>
var enter_ur_cmt = 'Please enter your comments';
<?php }?>

<?php if ($this->lang->line('u_want_continue_action')!=''){?> 
var u_want_continue_action = '<?php echo addslashes($this->lang->line('u_want_continue_action'));?>';
<?php }else {?>
var u_want_continue_action = 'Whether you want to continue this action?';
<?php }?>


<?php if ($this->lang->line('field_req')!=''){?> 
var field_req = '<?php echo addslashes($this->lang->line('field_req'));?>';
<?php }else {?>
var field_req = 'This field is required';
<?php }?>


<?php if ($this->lang->line('enter_list_name')!=''){?> 
var enter_list_name = '<?php echo addslashes($this->lang->line('enter_list_name'));?>';
<?php }else {?>
var enter_list_name = 'Enter List Name!';
<?php }?>

<?php if ($this->lang->line('enter_same_value')!=''){?> 
var enter_same_value = '<?php echo addslashes($this->lang->line('enter_same_value'));?>';
<?php }else {?>
var enter_same_value = 'Please enter the same value again';
<?php }?>

<?php if ($this->lang->line('sel_checkbox')!=''){?> 
var sel_checkbox = '<?php echo addslashes($this->lang->line('sel_checkbox'));?>';
<?php }else {?>
var sel_checkbox = 'Please Select the CheckBox';
<?php }?>

<?php if ($this->lang->line('no_records_found')!=''){?> 
var no_records_found = '<?php echo addslashes($this->lang->line('no_records_found'));?>';
<?php }else {?>
var no_records_found = 'No records found';
<?php }?>

<?php if ($this->lang->line('choose')!=''){?> 
var choose = '<?php echo addslashes($this->lang->line('choose'));?>';
<?php }else {?>
var choose = 'Choose ';
<?php }?>

<?php if ($this->lang->line('no_match_records')!=''){?> 
var no_match_records = '<?php echo addslashes($this->lang->line('no_match_records'));?>';
<?php }else {?>
var no_match_records = 'No matching records found ';
<?php }?>

var lg_add_btn = '<?php echo addslashes(shopsy_lg('shop_tagadd','ADD')); ?>';
var lg_about_list_item ='<?php echo addslashes(shopsy_lg('lg_about_list_item','About the Item,')); ?>';

var lg_category = '<?php echo addslashes(shopsy_lg('lg_category','Category,')); ?>';
var lg_photo ='<?php echo addslashes(shopsy_lg('lg_photo','Photo,')); ?>';

var lg_description = '<?php echo addslashes(shopsy_lg('lg_description','Description,')); ?>';
var lg_price ='<?php echo addslashes(shopsy_lg('lg_price','Price,')); ?>';

var lg_shipping_time ='<?php echo addslashes(shopsy_lg('lg_shipping','Shipping Duration,')); ?>';
var lg_shipping_from ='<?php echo addslashes(shopsy_lg('lg_shipping_from','Shipping from,')); ?>';
var lg_shipping_tax ='<?php echo addslashes(shopsy_lg('lg_shipping_from','shipping cost,')); ?>';
var lg_shipping_one ='<?php echo addslashes(shopsy_lg('lg_shipping_from','Shipping cost With an Item,')); ?>';

var lg_title ='<?php echo addslashes(shopsy_lg('lg_title','Title,')); ?>';

var lg_starting_price='<?php echo addslashes(shopsy_lg('lg_starting_price','Starting price,')); ?>';

var lg_Duration='<?php echo addslashes(shopsy_lg('lg_Duration','Duration,')); ?>';

var lg_Quantity='<?php echo addslashes(shopsy_lg('lg_Quantity','Quantity,')); ?>';

var lg_required_field = '<?php echo addslashes(shopsy_lg('lg_required_field','This Field required')); ?>';

var lg_email_reg_already = '<?php echo addslashes(shopsy_lg('lg_email_reg_already','This Email id already registered.'))?>';

var lg_user_name_already = '<?php echo addslashes(shopsy_lg('lg_user_name_already','Username already exists! Choose another'))?>';

var lg_user_name_not_valid = '<?php echo addslashes(shopsy_lg('lg_user_name_not_valid','User name not valid. Only alphanumeric allowed'))?>';

var lg_accept_terms_policy = '<?php echo addslashes(shopsy_lg('lg_accept_terms_policy','Please accept our Terms of Use and Privacy Policy'))?>';

var lg_email_pwd_notsame = '<?php echo addslashes(shopsy_lg('lg_email_pwd_notsame','Email Id and password cannot be same'))?>';

var lg_pwd_username_notsame = '<?php echo addslashes(shopsy_lg('lg_pwd_username_notsame','Username and password cannot be same'))?>';

var lg_pwd_firstname_notsame = '<?php echo addslashes(shopsy_lg('lg_pwd_firstname_notsame','First name and password cannot be same'))?>';

var lg_username_25_max = '<?php echo addslashes(shopsy_lg('lg_username_25_max','Username must be maximum of 25 characters'))?>';
var lg_firstname_25_max = '<?php echo addslashes(shopsy_lg('lg_firstname_25_max','Firstname must be maximum of 25 characters'))?>';
var lg_lastname_25_max = '<?php echo addslashes(shopsy_lg('lg_lastname_25_max','Lastname must be maximum of 25 characters'))?>';

var lg_pwd_not_match = '<?php echo addslashes(shopsy_lg('lg_pwd_not_match','password not match'))?>';

var lg_pwd_12_char = '<?php echo addslashes(shopsy_lg('lg_pwd_12_char','Password must be maximum of 12 characters'))?>';

var lg_pwd_6_char = '<?php echo addslashes(shopsy_lg('lg_pwd_6_char','Password must be minimum of 6 characters'))?>';

var lg_invalid_email = '<?php echo addslashes(shopsy_lg('lg_invalid_email','Invalid e-mail address'))?>';
var lg_alphabets = '<?php echo addslashes(shopsy_lg('lg_alphabets','This field allowed only alphabets'))?>';

var lg_pls_enter_valid_email= '<?php echo addslashes(shopsy_lg('lg_pls enter valid email','Please enter valid e-mail addresss'))?>';
var lg_Pls_select_one = '<?php echo addslashes(shopsy_lg('lg_Pls_select_one','Please select one'))?>';
var lg_pls_enter_receiver_email = '<?php echo addslashes(shopsy_lg('lg_pls_enter_receiver_email','Please Enter the Receiver Email'))?>';
var lg_pls_enter_receiver_name = '<?php echo addslashes(shopsy_lg('lg_pls_enter_receiver_name','Please enter the recipient\'s name'))?>';
var lg_Please_enter_your_name = '<?php echo addslashes(shopsy_lg('lg_Please_enter_your_name','Please enter your name'))?>';
var lg_Please_Enter_Valid_Email_Address = '<?php echo addslashes(shopsy_lg('lg_Please_Enter_Valid_Email_Address','Please Enter Valid Email Address'))?>';
var lg_Please_Re_Enter_the_Receiver_Email = '<?php echo addslashes(shopsy_lg('lg_Please_Re_Enter_the_Receiver_Email','Please Re-Enter the Receiver Email'))?>';
var lg_Receiver_Email_doest_matched = '<?php echo addslashes(shopsy_lg('lg_Receiver_Email_doest_matched','Receiver Email doesn\'t matched'))?>';
var lg_add_your_tag_here = '<?php echo addslashes(shopsy_lg('lg_add_your_tag_here','add your tag here!!!'))?>';
var lg_enter_shopname='<?php echo addslashes(shopsy_lg('lg_enter shopname','Enter Your Shop name.'))?>';
var lg_choose_color= '<?php echo addslashes(shopsy_lg('lg_choose color','Choose color'))?>';
var lg_Enter_List_Name='<?php echo addslashes(shopsy_lg('lg_enter listname','Enter List Name!'));?>';
var lg_please_enter_the_amount='<?php echo addslashes(shopsy_lg('lg_please_enterthe_amount','please enter the amount'));?>';
var lg_characters_not_allowed='<?php echo addslashes(shopsy_lg('lg_characters_not_allowed','characters not allowed'));?>';
var lg_Are_you_Sure_to_Cancel_it='<?php echo addslashes(shopsy_lg('lg_Are_you_Sure_to_Cancel_it','Are you Sure to Cancel it?'));?>';
var lg_msg_min='<?php echo addslashes(shopsy_lg('lg_Typemessage_minimum_5_characters','Type message minimum 5 characters'));?>';
var lg_sure='<?php echo addslashes(shopsy_lg('lg_Are you sure?','Are you sure?'));?>';
var lg_select_reason='<?php echo addslashes(shopsy_lg('lg_select_reason','You should select any one reason.'));?>';
var lg_pls_add_subject='<?php echo addslashes(shopsy_lg('lg_pls_add_subject','Please add subject.'));?>';
var lg_Entered_code_is_invalid='<?php echo addslashes(shopsy_lg('lg_Entered_code_is_invalid','Entered code is invalid '));?>';
var lg_Please_select_one='<?php echo addslashes(shopsy_lg('lg_Please_select_one','Please select one '));?>';
var lg_Please_enter_the_recipientname='<?php echo addslashes(shopsy_lg('lg_Please_enter_the_recipientname','Please enter the recipients name '));?>';
var lg_payment_gateway='<?php echo addslashes(shopsy_lg('lg_Please_Choose_the_Payment_Gateway','Please Choose the Payment Gateway '));?>';
var lg_All_the_fields_are_required='<?php echo addslashes(shopsy_lg('lg_All_the_fields_are_required','All the fields are required.'));?>';
var lg_pls_enter_sub_5char='<?php echo addslashes(shopsy_lg('lg_please_enterthe_subject_morethan_5character','please enter the subject more than 5 character'));?>';
var lg_pls_enter_des_5char='<?php echo addslashes(shopsy_lg('lg_please_enterthe_Description_morethan_5character','please enter the Description more than 5 character'));?>';
var lg_pld_selct_priority='<?php echo addslashes(shopsy_lg('lg_please_selectthe_priority','please select the priority'));?>';
var lg_pls_enter_valid_amt='<?php echo addslashes(shopsy_lg('lg_pls_enter_amt','please enter a valid amount'));?>';
var lg_Selec_both_fromand_todate='<?php echo addslashes(shopsy_lg(' lg_Selec_both_fromand_todate','Select both from and to date'));?>';
var pls_entre_same_value='<?php echo addslashes(shopsy_lg('pls_entre_same_value','Please enter the same value'));?>';
var lg_scroll_more_results='<?php echo addslashes(shopsy_lg('lg_scroll_more_results','Scroll for  more results or click here'));?>';
var lg_enter_your_location='<?php echo addslashes(shopsy_lg('lg_enter_your_location','Enter Your Location.'));?>';
var lg_shopname_already_exist='<?php echo addslashes(shopsy_lg('lg_shopname_already_exist','Sorry! This shop name already exist,Please enter another name'));?>';
var lg_enter_email_orusername='<?php echo addslashes(shopsy_lg('lg_enter_email_orusername','Enter email id or username'));?>';
var lg_password_mismatch='<?php echo addslashes(shopsy_lg('lg_password_mismatch','Password and Confirm Password are missmatch'));?>';
var lg_enter_valid_email='<?php echo addslashes(shopsy_lg('lg_enter_valid_email','Enter valid email id'));?>';
var lg_enter_valid_email='<?php echo addslashes(shopsy_lg('lg_emailmisssmatch','Email and Confirm Email are missmatch'));?>';
var lg_enter_new_email='<?php echo addslashes(shopsy_lg('lg_enter_new_email','Enter New email id'));?>';
var lg_pls_choose_file_before='<?php echo addslashes(shopsy_lg('lg_pls_choose_file_before','Please choose a file before you upload'));?>';
var lg_pls_upload_file_withcsv_extension='<?php echo addslashes(shopsy_lg('lg_pls_upload_file_withcsv_extension','Please upload a file with .csv extension.'));?>';
var lg_enter_correct_phno='<?php echo addslashes(shopsy_lg('lg_enter_correct_phno','Please Enter the Correct phone number'));?>';
var lg_success='<?php echo addslashes(shopsy_lg('lg_success','Success'));?>';
var lg_shop_exist='<?php echo addslashes(shopsy_lg('lg_shop_exist','Sorry! This shop name already exist,Please enter another name'));?>';
var lg_img_small='<?php echo addslashes(shopsy_lg('lg_img_small','Upload Image Too Small. Please Upload Image Size More than or Equalto 760 X 100 .'));?>';
var lg_pls_select_price_value='<?php echo addslashes(shopsy_lg('lg_pls_select_price_value','Please Select the Price Value'));?>';
var lg_enter_rxr_name='<?php echo addslashes(shopsy_lg('lg_enter_rxr_name','Please Enter the Receiver Name'));?>';
var lg_pls_enter_rxr_email='<?php echo addslashes(shopsy_lg('lg_pls_enter_rxr_email','Please Enter the Receiver Email'));?>';
var lg_enter_email_address='<?php echo addslashes(shopsy_lg('lg_enter_email_address','Please Enter Valid Email Address'));?>';
var lg_add_to_fav='<?php echo addslashes(shopsy_lg('lg_add_to_fav','Add To Favorite'));?>';
var lg_remove_from_fav='<?php echo addslashes(shopsy_lg('lg_remove_from_fav','Remove from Favorite'));?>';

</script>
<?php ?>
<!-------------Old script lines--------->
<script type="text/javascript" src="js/site/jquery-1.7.1.min.js"></script> 
<script type="text/javascript" src="js/validation.js"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<!-------------Old script lines--------->

<!---------------New script lines -------->
<script src="js/front/jquery.raty.min.js"></script>
<script src="js/front/jquery-1.9.1.min.js"></script>
<script src="js/front/bootstrap.min-v3.3.4.js"></script>
<!---------------New script lines -------->

<script type="text/javascript" src="js/jquery.elastislide.js"></script>
<script type="text/javascript" src="js/jcarousellite_1.0.1.pack.js"></script>
<?php if($this->uri->segment(1) =='gift-cards'){?>
<script type="text/javascript" src="js/jquery.tmpl.min.js"></script>
<script type="text/javascript" src="js/gallery.js"></script>
<?php }?>
