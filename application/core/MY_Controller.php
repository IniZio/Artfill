<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/* 
 * 
 * This controller contains the common functions
 * @author Teamtweaks
 *
 */

date_default_timezone_set('Asia/Hong_Kong'); 
define('TIMEZONE_GMT',     '+8');

class MY_Controller extends CI_Controller {  
	public $privStatus;	
	public $data = array();
	
	//public $geo_data=array();
	function __construct()
    { 
        parent::__construct(); 
		ob_start();
		ob_clean();
 		//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		//error_reporting(E_ALL ^ (E_NOTICE));
		//error_reporting(E_ALL);
		//error_reporting(0);
		$this->load->helper(array('url','cookie','directory','text','language','lg'));
		$this->load->library(array('pagination','session'));
		$this->load->library('custom_pagination');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('sliders_model');

		$currentipaddress=$this->input->ip_address();
		$condition = array('ip_address' => $currentipaddress);
        $whitelisters=$this->sliders_model->get_all_details(IPWHITELIST,$condition);
		//print_r($whitelisters);die;
		if ($whitelisters->num_rows() > 0){ 
		
			$this->load->view('site/templates/loaderror');die;
				
		}

	    if($this->session->userdata('language_code') == ''){
				
			$defaultLanguage_details = $this->db->query("select * from ".LANGUAGES." where `default_language`='Yes' and `status`='Active'");
			if ($defaultLanguage_details->num_rows()>0){
				$defaultLanguage = $defaultLanguage_details->row()->lang_code;
			}
			if ($defaultLanguage==''){
				//$defaultLanguage = 'ar';
				define('PRODUCT',						TBL_PREF.'product');
				define('CMS',							TBL_PREF.'cms');
				define('CATEGORY',						TBL_PREF.'category');
			}else{
				if($defaultLanguage == 'en'){
					define('PRODUCT',						TBL_PREF.'product');
					define('CMS',							TBL_PREF.'cms');
					define('CATEGORY',						TBL_PREF.'category');
				}else{	
					define('PRODUCT',						TBL_PREF.'product'.'_'.$defaultLanguage);
					define('CMS',							TBL_PREF.'cms'.'_'.$defaultLanguage);
					define('CATEGORY',						TBL_PREF.'category'.'_'.$defaultLanguage);
				}
			}
		
// 			define('PRODUCT',						TBL_PREF.'product_'.$defaultLanguage);
// 			define('CMS',							TBL_PREF.'cms_'.$defaultLanguage);
// 			define('CATEGORY',						TBL_PREF.'category_'.$defaultLanguage);
		
		}elseif($this->session->userdata('language_code') != '' && $this->session->userdata('language_code') != 'en'){
			$ln = $this->session->userdata('language_code');
			define('PRODUCT',						TBL_PREF.'product'.'_'.$ln);
			define('CMS',							TBL_PREF.'cms'.'_'.$ln);
			define('CATEGORY',						TBL_PREF.'category'.'_'.$ln);
		
		}else{
			define('PRODUCT',						TBL_PREF.'product');
			define('CMS',							TBL_PREF.'cms');
			define('CATEGORY',						TBL_PREF.'category');
		}
		//$this->load->library('session');
		//$this->load->helper("geo_location");		
		$this->load->model('category_model');
		$this->load->model('seller_model');
		$this->load->model('user_model');
		$this->load->model('order_model');
		$this->load->model('multilanguage_model');
		$this->data['active_theme']=$this->user_model->get_all_details(THEME,array('status'=>'Active'));
		//echo $this->input->get('active_theme');die;
		if($this->input->get('active_theme') != ''){
			
			$this->data['active_theme']=$this->user_model->get_all_details(THEME,array('theme_name'=>$this->input->get('active_theme')));
			//echo $this->db->last_query();die;
		}
		//$feedbackCount = $this->category_model->getFeedbackCount();
		//$this->data['cmsPages'] = count($feedbackCount);
		/*
		 * Connecting Database
		 */
		$this->load->database();
		
		#echo $this->config->item('landing_widget1'); die;
		
		$this->data['demoserverChk1'] = $demoserverChk = strpos($this->input->server('DOCUMENT_ROOT'),'casperon/');
		/* $this->data['product_pay_status']="Paid";
		if($this->config->item('product_cost') == 0){
			//$this->data['product_pay_status']=""
		} */	
/* 
	  */
	 
    
	  
		
		if($this->checkLogin('U')!=''){
			$userProfileDetails = $this->db->query('select * from '.USERS.' where `id`="'.$this->checkLogin('U').'"')->result_array();
			$this->data['curruserGroup']=$userProfileDetails[0]['group'];
			$this->data['userDetails']=$userProfileDetails;
			
			#echo "<pre>";print_r($this->data['notification_emailArr']);die;
			$this->data['CurrUserImg']=$userProfileDetails[0]['thumbnail'];
			
			$this->data['userDetails_notify']=$userProfileDetails;
			#echo '<pre>';print_r($userProfileDetails); die;
			$userList=explode(',',$userProfileDetails[0]['following']);
			$this->data['following_user_list']=$userList;
			$userList[0]=$this->checkLogin('U');$condition='(';
			foreach($userList as $userIds){
				$condition.="ua.user_id = ".$userIds." or ";
			}
			$len=strlen($condition);
			$condition=substr($condition,0,$len-4);
			$condition.=') and ua.activity_time >= "'.$userProfileDetails[0]['last_activity_visit'].'"';	 
			$followersAll=$userActivityCount= $this->user_model->get_activity($condition)->num_rows();
			
			
			//$update_product_feature=$this->user_model->update_details(PRODUCT,array('product_featured'=>'No'),array('feature_expire' => date("Y-m-d")));
			$shopActivityCount=$userActivityCount= $this->user_model->get_activity_shop($this->checkLogin('U'),$userProfileDetails[0]['last_activity_visit'])->num_rows();	  #echo $this->db->last_query(); die;
			$shopPrdActivityCount=$userActivityCount= $this->user_model->get_activity_shopPrd($this->checkLogin('U'),$userProfileDetails[0]['last_activity_visit'])->num_rows();	 
			#echo 'follerwers--'.$followersAll;
			#echo 'shopActivirty--'.$shopActivityCount;
			#echo 'shopPrdActivityCount--'.$shopPrdActivityCount;

			$this->data['userActivityCount']=$followersAll+$shopActivityCount+$shopPrdActivityCount;
			#echo $this->db->last_query(); die;
			
		} 
	 
		
		/*
		
		if($this->checkLogin('U')!=''){
			$this->data['userActivityCount']=$userActivityCount= $this->user_model->get_activity_count($this->checkLogin('U'));	
		}
		*/
		
		/*
		 * Loading CMS Pages
		 */
		/*if ($_SESSIO 	N['cmsPages'] == ''){
			$cmsPages = $this->db->query('select * from '.CMS.' where `status`="Publish" and `hidden_page`="No"');
			$_SESSION['cmsPages'] = $cmsPages->result_array();
		}
		$this->data['cmsPages'] = $_SESSION['cmsPages'];*/
		
		$_SESSION['cmsPages'] == '';
		//$cmsPages = $this->db->query('select * from '.CMS.' where `status`="Publish" and `hidden_page`="No"');
		//$cmsPages = $this->db->get_where(CMS, array('status'=>"Publish", 'hidden_page'=> "No"));
		$cmsPages = $this->db->query('select * from '.CMS.' where `status`="Publish" and `hidden_page`="No"');
		$this->data['cmsPages'] = $cmsPages->result_array();
				
		$this->load->model('minicart_model');
		$this->load->model('product_model');
			
		/*
		 * Loading Theme Layouts
		 */
   unset($_SESSION['themeLayout']);
		if ($_SESSION['themeLayout'] == ''){
			$themeLayout = $this->db->query("select * from ".THEME." where `status`='Active'");
			$_SESSION['themeLayout'] = $themeLayout->result_array();
		}
		$this->data['themeLayout'] = $_SESSION['themeLayout'];
		
		/*
		 * affiliate Cookie
		 */

		if($this->input->get('aff') != '')
		{
			$affiliateID = $this->input->get('aff');
			//echo $affiliateID; die;
			
			$affiliate = base64_encode ($affiliateID);
		
			$result = $this->user_model->get_all_details(AFFILIATE,array());
			if($result->num_rows > 0){
				$today = time();
				$interval = $result->row()->cookie_duration;
				$period = $result->row()->cookie_period;
		
				if($period == 'mins'){
					$expire = $interval * 60;
				}else if($period == 'hrs'){
					$expire = $interval * 60 * 60;
				}else if($period == 'days'){
					$expire = $interval * 60 * 60 * 24;
				}else if($period == 'months'){
					$MonthsLater = strtotime("+".$interval." months", $today); echo "<br>";
					$expire = $MonthsLater - $today;
				}
				else if($period == 'years'){
					$futureDate = strtotime("+".$interval." year", $today);
					$expire = $futureDate - $today;
				}
					
				$cookie = array(
						'name'   => 'affiliateId',
						'value'  => $affiliate,
						'expire' => $expire,
				);
				$this->input->set_cookie($cookie);
			}
		}
		/*
		*/
		/* $edit_digital_check=$this->user_model->get_all_details(SUBPRODUCT,array());		
		$this->product_model->ExecuteQuery("UPDATE `shopsy_product` SET `product_type` = 'physical'");
		 foreach($edit_digital_check->result() as $dig_check){		 
			 if($dig_check->digital_item != '')
			{
				$this->product_model->ExecuteQuery("UPDATE `shopsy_product` SET `product_type` = 'digital' WHERE id='".$dig_check->product_id."'");
			} 			
		} */
		
		/*
		 * User activity Count
		 
		*/		
		if (substr($uriMethod, 0,7) == 'display' || substr($uriMethod, 0,4) == 'view' || $uriMethod == '0'){
			$this->privStatus = '0';
		}else if (substr($uriMethod, 0,3) == 'add'){
			$this->privStatus = '1';
		}else if (substr($uriMethod, 0,4) == 'edit' || substr($uriMethod, 0,6) == 'insert' || substr($uriMethod, 0,6) == 'change'){
			$this->privStatus = '2';
		}else if (substr($uriMethod, 0,6) == 'delete'){
			$this->privStatus = '3';
		}else {
			$this->privStatus = '0';
		}
		$this->data['title'] = $this->config->item('meta_title');;
		$this->data['heading'] = '';
		
		$this->data['flash_data'] = $this->session->flashdata('sErrMSG');
		$this->data['flash_data_type'] = $this->session->flashdata('sErrMSGType');
		
		$this->data['adminPrevArr'] = $this->config->item('adminPrev');
 		$this->data['adminEmail'] = $this->config->item('email');	
		$this->data['privileges'] = $this->session->userdata('shopsy_session_admin_privileges');
		$this->data['subAdminMail'] = $this->session->userdata('shopsy_session_admin_email');				
		$this->data['loginID'] = $this->session->userdata('shopsy_session_user_id');				
    	$this->data['allPrev'] = '0';
    	$this->data['logo'] = $this->config->item('logo_image');
    	$this->data['fevicon'] = $this->config->item('fevicon_image');
    	$this->data['footer'] = $this->config->item('footer_content');
    	$this->data['siteContactMail'] = $this->config->item('site_contact_mail');
		$this->data['WebsiteTitle'] = $this->config->item('email_title');
    	$this->data['siteTitle'] = $this->config->item('email_title');
    	$this->data['meta_title'] = $this->config->item('meta_title');
    	$this->data['meta_keyword'] = $this->config->item('meta_keyword');
    	$this->data['meta_description'] = $this->config->item('meta_description');
    	$this->data['giftcard_status'] = $this->config->item('giftcard_status');
		$this->data['sidebar_id'] = $this->session->userdata('session_sidebar_id');
		if ($this->session->userdata('shopsy_session_admin_name') == $this->config->item('admin_name')){
			$this->data['allPrev'] = '1';
		}
		$this->data['paypal_ipn_settings'] = unserialize($this->config->item('payment_0'));
		$this->data['authorize_net_settings'] = unserialize($this->config->item('payment_1'));
		$this->data['paypal_adaptive_settings'] = unserialize($this->config->item('payment_2'));
		$this->data['stripe_settings'] = unserialize($this->config->item('payment_3'));
		
		
		$this->data['datestring'] = "%Y-%m-%d %h:%i:%s";
		if($this->checkLogin('U')!=''){
 			$this->data['common_user_id'] = $this->checkLogin('U'); 
		}elseif($this->checkLogin('T')!=''){
 			$this->data['common_user_id'] = $this->checkLogin('T'); 
		}else{
			$temp_id = substr(number_format(time() * rand(),0,'',''),0,6);
			$this->session->set_userdata('shopsy_session_temp_id',$temp_id);
			$this->data['common_user_id'] = $temp_id;
		}
		$this->data['emailArr'] = $this->config->item('emailArr');
		$this->data['notyArr'] = $this->config->item('notyArr');
		
		$this->data['MiniCartViewSet'] = $this->minicart_model->mini_cart_view($this->data['common_user_id']); 
		
		/****** Stay signed in process ****/
		if($this->checkLogin('U')==''){
			$UserCookieData = $this->input->cookie("Shopsy_NewUser");
			if($UserCookieData != ''){
				$condition = array('id'=>$UserCookieData);
				$checkUser = $this->user_model->get_all_details(USERS,$condition);
				if ($checkUser->num_rows() == 1){ 
					$userdata = array(
									'shopsy_session_user_id' => $checkUser->row()->id,
									'shopsy_session_user_name' => $checkUser->row()->user_name,
									'shopsy_session_full_name' => $checkUser->row()->full_name,
									'shopsy_session_user_email' => $checkUser->row()->email,
									'shopsy_session_user_confirm' => $checkUser->row()->is_verified,
									'userType'=>$checkUser->row()->group
								);
					
					$this->session->set_userdata($userdata);
				}
			}
		}
		
		
		/*
		 * Checking user language and loading user details
		 */
		 

		 $group=0;
		if($this->checkLogin('U')!=''){
		
			$this->data['userDetails'] = $this->db->query('select * from '.USERS.' where `id`="'.$this->checkLogin('U').'"');
			$selectedLangCode = $this->session->userdata('language_code');
	 		if ($this->data['userDetails']->row()->language != $selectedLangCode){
	 			$this->session->set_userdata('language_code',$this->data['userDetails']->row()->language);
	 			$this->session->keep_flashdata('sErrMSGType');
	 			$this->session->keep_flashdata('sErrMSG');				
	 			redirect($this->uri->uri_string());
	 		}
			$group=1;
		}
		
		//echo '<pre>'; print_r($this->data['MiniCartViewSet']); die;
		$this->data['userLists'] = $this->minicart_model->get_all_details(LISTS_DETAILS,array('user_id'=>$this->data['common_user_id']))->result_array();
		$this->data['userRegistry'] = $this->minicart_model->get_all_details(REGISTRY,array('user_id'=>$this->data['common_user_id']))->row();
		#echo '<pre>'; print_r($this->data['userRegistry']); die;
		
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
		$this->data['mainCategories'] = $this->minicart_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		
		
		
		/* Geo Location */
		$this->data['GeoLocationVal'] = $GeoLocationVal = $this->input->cookie('shopsy_geo_locate',TRUE);
		
		if($GeoLocationVal==''){
			$this->load->library('geoloc');
			if(GeoCountryCode!=''){
			$GeoLoc = array('GeoCountry'=>GeoCountryCode,'GoeCurrency'=>GeoCurrencyCode);
			$this->product_model->geoloc_currecy_update();
			$this->data['GeoCountryCode']=GeoCountryCode;
			}else{
				$GeoCurList=$this->product_model->get_all_details(CURRENCY,array('status' => 'Active','default_currency'=>'Yes'));
				$GeoLoc = array('GeoCountry'=>$GeoCurList->row()->currency_code,'GoeCurrency'=>$GeoCurList->row()->currency_code);
				$this->data['GeoCountryCode']=$GeoCurList->row()->currency_code;
				
			}
						
		}else{
			$GeoLoc = unserialize($GeoLocationVal);	
			//$GeoLoc['GeoCountry']; $GeoLoc['GoeCurrency'];
		}
		
		$this->data['GeoCurrencyArr'] = $GeoCurrencyArr = $this->product_model->get_all_details(CURRENCY,array('status'=>'Active','currency_code'=>$GeoLoc['GoeCurrency']));
		$this->data['GeoCountryArr'] = $this->product_model->get_all_details(COUNTRY_LIST,array('status'=>'Active','country_code'=>$GeoLoc['GeoCountry']));
		
		$this->data['currencyList']=$this->product_model->get_all_details(CURRENCY,array('status' => 'Active'));
		
		if($GeoCurrencyArr->num_rows() > 0){
			$dcurrencySymbol=$GeoCurrencyArr->row()->currency_symbol;
			$dcurrencyType=$GeoCurrencyArr->row()->currency_code;
		}else{
			$DefCurrencyList=$this->product_model->get_all_details(CURRENCY,array('status' => 'Active','default_currency'=>'Yes'));
			$dcurrencySymbol=$DefCurrencyList->row()->currency_symbol;
			$dcurrencyType=$DefCurrencyList->row()->currency_code;
		}
		$this->data['dcurrencySymbol']=$dcurrencySymbol;
		$this->data['dcurrencyType']=$dcurrencyType;		
		if(!$this->session->userdata('currency_data'))	{
	 	    if($this->checkLogin('U')!=''){
				$checkUserPreference=$this->product_model->get_all_details(USER,array('id' => $this->checkLogin('U')));
				$condition = array('currency_code'=> $checkUserPreference->row()->currency);
			} else {
				$condition = array('currency_code'=>$GeoLoc['GoeCurrency']);	
			}  
			$result=$this->product_model->get_all_details(CURRENCY,$condition);
			//print_r($result); die;
			$nCVal=array();
			foreach($result->row() as $cKey=>$cVal){
				$nCVal[$cKey]=base64_encode ($cVal);
			}
			$this->session->set_userdata('currency_data',$nCVal);			
		}
		
		/* Multilanguage start*/
		$defaultLanguage_details = $this->product_model->get_all_details(LANGUAGES,array('default_language'=>'Yes','status'=>'Active'));
		if($this->uri->segment('1') != 'admin')
		{
			if ($defaultLanguage_details->num_rows()>0){
				$defaultLanguage = $defaultLanguage_details->row()->lang_code;
			}
			$selectedLanguage = $this->session->userdata('language_code');
// 			$defaultLanguage = $this->data['defaultLg'][0]['lang_code'];
			if ($defaultLanguage==''){
				$defaultLanguage = 'en';
			}
			$filePath = APPPATH."language/".$selectedLanguage."/".$selectedLanguage."_lang.php";
			if($selectedLanguage != '')
			{	
				if (!session_id()){
					session_start();
				}
				$_SESSION['template'] = 'default';
				$_SESSION['old_template'] = 'default';
				
				if ($_SESSION['old_template']!=$_SESSION['template']){
					$this->session->keep_flashdata('sErrMSGType');
					$this->session->keep_flashdata('sErrMSG');
					$_SESSION['old_template'] = $_SESSION['template'];
					redirect($this->uri->uri_string());
				}
								
				if(!(is_file($filePath)))
				{
					$this->lang->load($defaultLanguage, $defaultLanguage);
				}
				else
				{				
					$this->lang->load($selectedLanguage, $selectedLanguage);
				}

			}
			else
			{
				if (!session_id()){
					session_start();
				}
				$_SESSION['template'] = 'default';
				$_SESSION['old_template'] = 'default';
				
				if ($_SESSION['old_template']!=$_SESSION['template']){
					$this->session->keep_flashdata('sErrMSGType');
					$this->session->keep_flashdata('sErrMSG');
					$_SESSION['old_template'] = $_SESSION['template'];
					if (!in_array($this->uri->segment(1),array('json','android','ios','cms','seller','mobile'))){
						redirect($this->uri->uri_string());
					}
				}
				
				$this->lang->load($defaultLanguage, $defaultLanguage);
			}
		}
		/* Multilanguage end*/
		
		/*Shop Header Navigation  */			
		$this->data['selectSellershop_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
		//$this->data['shopProduc'] =$this->product_model->view_product_details_from_section($condition1)->result_array();
		
		$shopProductsv =$this->product_model->view_product_details_from_section_all($this->checkLogin('U'));
		$this->data['shopProduc'] = $shopProductsv->row()->totalCount;
		
        $this->data['countryList'] = $this->product_model->get_all_details(COUNTRY_LIST,array())->result();
		$this->data['currencyList']=$this->product_model->get_all_details(CURRENCY,array('status' => 'Active'));
		
		/*LAnguage List*/
		
/* For multiLangusge*/		
		$this->data['languagesList']=$this->product_model->get_all_details(LANGUAGES,array('status' => 'Active'));
		$this->data['languages']=$this->multilanguage_model->get_language_list()->result_array();
		$this->data['mulitiLangTable'] = array(CATEGORY_EN,CMS_EN,PRODUCT_EN);
		
		$this->multilanguage_model->CreateLanguagetables();
 		
		
		
		
		
		if(!$this->session->userdata('currency_data'))	{
	 	    if($this->checkLogin('U')!=''){
				$checkUserPreference=$this->product_model->get_all_details(USER,array('id' => $this->checkLogin('U')));
				$condition = array('currency_code'=> $checkUserPreference->row()->currency);
			} else {
				$condition = array('default_currency'=>'Yes');	
			}  
			$result=$this->product_model->get_all_details(CURRENCY,$condition);
			$nCVal=array();
			foreach($result->row() as $cKey=>$cVal){
				$nCVal[$cKey]=base64_encode ($cVal);
			}
			#$this->session->set_userdata('currency_data',$result->row_array());
			$this->session->set_userdata('currency_data',$nCVal);
			
		}	#echo $this->session->userdata('language_code'); die;
		
		if ($defaultLanguage_details->num_rows()>0){
			$defaultLanguage = $defaultLanguage_details->row()->lang_code;
		}
		
		$selectedLanguage = $this->session->userdata('language_code');
		if ($defaultLanguage==''){
			$defaultLanguage = 'en';
		}
		if ($selectedLanguage==''){
			$selectedLanguage = $defaultLanguage;
		}
		
		$LangName=$this->product_model->get_all_details(LANGUAGES,array('lang_code'=>$selectedLanguage))->row(); 
		
		$this->data['languageName'] = $LangName->name;
		$this->data['languageCode'] = $selectedLanguage; 	
		$this->data['currencySymbol'] = base64_decode($this->session->userdata['currency_data']['currency_symbol']);
        $this->data['currencyValue'] = base64_decode($this->session->userdata['currency_data']['currency_value']);
		$this->data['currencyType'] = base64_decode($this->session->userdata['currency_data']['currency_code']); 
		$this->data['currencyName'] = base64_decode($this->session->userdata['currency_data']['currency_name']);
			 
		//$this->data['social_links'] = $this->user_model->get_all_details(ADMIN_SETTINGS,array('id'=>1));
		$this->data['notificationCount']=0;
		if($group==1){
			$ownProductsArr=$this->product_model->ExecuteQuery("SELECT GROUP_CONCAT(p.id) as ids FROM ".PRODUCT." p 	WHERE p.user_id=".$this->checkLogin('U'));
			$ownOrdersArr=$this->product_model->ExecuteQuery("SELECT GROUP_CONCAT(p.dealCodeNumber) as ids FROM ".USER_PAYMENT." p 	WHERE p.sell_id=".$this->checkLogin('U')." AND p.status='Paid'");
			$participatedOrdersArr=$this->product_model->ExecuteQuery("SELECT GROUP_CONCAT(note.activity_id) as ids FROM ".NOTIFICATIONS." note WHERE note.user_id=".$this->checkLogin('U')." AND note.activity='order'");
			$ownProductList="";
			$ownOrderList="";
			$participatedOrdersList="";
			
			if($ownProductsArr->num_rows()>0){
				$ownProductList=$ownProductsArr->row()->ids;
			}
			if($ownOrdersArr->num_rows()>0){
				$ownOrderList=$ownOrdersArr->row()->ids;
			}
			if($participatedOrdersArr->num_rows()>0){
				$participatedOrdersList=$participatedOrdersArr->row()->ids;
			}
			
			$this->data["ownProductList"]=$ownProductList;
			$this->data["ownOrderList"]=$ownOrderList;
			$this->data["participatedOrdersList"]=$participatedOrdersList;
			
			$checkNotifications=$this->user_model->get_all_notification_list($this->checkLogin('U'),$ownProductList,$ownOrderList,$participatedOrdersList);
			$this->data['notificationCount']=$checkNotifications->row()->notificationCount;
		}
		
// 				$this->thumbimage_resize('images/product/org-image/','images/product/thumb/','245');
// 				$this->thumbimage_resize('images/product/org-image/','images/product/','550');
// 				$this->thumbimage_resize('images/product/org-image/','images/product/list-image/','75');
    }
 
	
	/**
     * 
     * This function return the session value based on param
     * @param $type
     */
    public function checkLogin($type=''){
	
    	if ($type == 'A'){
    		return $this->session->userdata('shopsy_session_admin_id');
    	}else if ($type == 'N'){
    		return $this->session->userdata('shopsy_session_admin_name');
    	}else if ($type == 'M'){
    		return $this->session->userdata('shopsy_session_admin_email');
    	}else if ($type == 'P'){
    		return $this->session->userdata('shopsy_session_admin_privileges');
    	}else if ($type == 'U'){
    		return $this->session->userdata('shopsy_session_user_id');
    	}else if ($type == 'T'){
    		return $this->session->userdata('shopsy_session_temp_id');
    	}
    }
    
    /**
     * 
     * This function set the error message and type in session
     * @param string $type
     * @param string $msg
     */
    public function setErrorMessage($type='',$msg=''){
	#@session_start();
    	($type == 'success') ? $msgVal = 'message-green' : $msgVal = 'message-red';
		$this->session->set_flashdata('sErrMSGType', $msgVal);
		$this->session->set_flashdata('sErrMSG', $msg);
		
		
		#$_SESSION['sErrMSGType'] = $msgVal;
		#$_SESSION['sErrMSG'] = $msg;
		
		
		#echo $msg; die;
		
    }
   /**
    * 
    * This function check the admin privileges
    * @param String $name	->	Management Name
    * @param Integer $right	->	0 for view, 1 for add, 2 for edit, 3 delete
    */ 
   public function checkPrivileges($name='',$right=''){
   		$prev = '0';
		$privileges = $this->session->userdata('shopsy_session_admin_privileges');
		extract($privileges);
		$userName =  $this->session->userdata('shopsy_session_admin_name');
		$adminName = $this->config->item('admin_name');
		if ($userName == $adminName){
			$prev = '1';
		}
		if (isset(${$name}) && is_array(${$name}) && in_array($right, ${$name})){
			$prev = '1';
		}
		if ($prev == '1'){
			return TRUE;
		}else {
			return FALSE;
		}
   }
   
   /**
    * 
    * Generate random string
    * @param Integer $length
    */
   public function get_rand_str($length='6'){
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
   }
   
   /**
    * 
    * Unsetting array element
    * @param Array $productImage
    * @param Integer $position
    */
	public function setPictureProducts($productImage,$position){
		unset($productImage[$position]);
		return $productImage;
	}
	
	/**
	 * 
	 * Resize the image
	 * @param int target_width
	 * @param int target_height
	 * @param string image_name
	 * @param string target_path
	 */
	public function imageResizeWithSpace($box_w,$box_h,$userImage,$savepath){
			
			$thumb_file = $savepath.$userImage;
				
			list($w, $h, $type, $attr) = getimagesize($thumb_file);
				
				$size=getimagesize($thumb_file);
			    switch($size["mime"]){
			        case "image/jpeg":
            			$img = imagecreatefromjpeg($thumb_file); //jpeg file
			        break;
			        case "image/gif":
            			$img = imagecreatefromgif($thumb_file); //gif file
				      break;
			      case "image/png":
			          $img = imagecreatefrompng($thumb_file); //png file
			      break;
				
				  default:
				        $im=false;
				    break;
				}
				
			$new = imagecreatetruecolor($box_w, $box_h);
			if($new === false) {
				//creation failed -- probably not enough memory
				return null;
			}
		
		
			$fill = imagecolorallocate($new, 255, 255, 255);
			imagefill($new, 0, 0, $fill);
		
			//compute resize ratio
			$hratio = $box_h / imagesy($img);
			$wratio = $box_w / imagesx($img);
			$ratio = min($hratio, $wratio);
		
			if($ratio > 1.0)
				$ratio = 1.0;
		
			//compute sizes
			$sy = floor(imagesy($img) * $ratio);
			$sx = floor(imagesx($img) * $ratio);
		
			$m_y = floor(($box_h - $sy) / 2);
			$m_x = floor(($box_w - $sx) / 2);
		
			if(!imagecopyresampled($new, $img,
				$m_x, $m_y, //dest x, y (margins)
				0, 0, //src x, y (0,0 means top left)
				$sx, $sy,//dest w, h (resample to this size (computed above)
				imagesx($img), imagesy($img)) //src w, h (the full size of the original)
			) {
				//copy failed
				imagedestroy($new);
				return null;
				
			}
			imagedestroy($i);
			imagejpeg($new, $thumb_file, 99);
			
	}
	
	
	function getAddEditDetails($excludeArray)
	{
		$inputArrayDetails = array();
		
		foreach($this->input->post() as $key=>$val)
		{
			if(!(in_array($key,$excludeArray)))
			{
				$inputArrayDetails[$key] = trim(addslashes($val));
			}
		}
		return $inputArrayDetails;
	}
	
	
	/**
	 * Image resize
	 * @param int $width
	 * @param int $height
	 * @param string $targetImage Name
	 * @param string $savepath 
	 */
	
	public function thumbimage_resize($source ,$destination ,$width, $height='') {
		
		//$destination = "images/product/thumb/";
		
		
// 		if( is_dir( $destination ) ) {
// 			//echo "The Directory {$new_path} exists";
// 		}else{
// 			//echo "The Directory {$new_path} not exists";
// 			mkdir($destination);
// 		}
		
		
 		$files = scandir($destination);
 		//$files = glob('images/product/thumb/*.*');
 		//echo "<pre>";print_r($files); 
 		 
		foreach($files as $file) {
			if (!is_dir("$destination/$file")){
				//echo $file."<br>";
				unlink($destination.$file);
			}
		}
		
		
		//$source = "images/product/org-image/";
		$sfiles = scandir($source);
		//$sfiles = glob('images/product/thumb/*.*');
		
		foreach($sfiles as $file) {
			if (!is_dir("$source/$file")){
				
				if (in_array($file, array(".",".."))) continue;
				
				if (copy($source.$file, $destination.$file)) {
					
				}
			
			}
		}
		
		$newfiles = scandir($destination);
		//$newfiles = glob($destination.'*.*');;
		
		foreach($newfiles as $file) {
			if (!is_dir("$destination/$file")){
				
				if (in_array($file, array(".",".."))) continue;
				//echo $file."<br>";
				if($file != 'Thumbs.db'){
					
					if($height == ''){
						$this->ImageResizeWithCrop($width, '', $file, './'.$destination.'');
					}else{
						$this->ImageResizeWithCropping($width, $height, $file, './'.$destination.'');
					}
				}
			
			}
		}
		
	}
	
	
	
	
	public function ImageResizeWithCrop($width, $height='', $thumbImage, $savePath){
		
		
// 		if( is_dir( $savePath ) ) {
// 			//echo "The Directory {$new_path} exists";
// 		}else{
// 			//echo "The Directory {$new_path} not exists";
// 			mkdir($savePath);
// 		}
		
		$thumb_file = $savePath.$thumbImage;
		//echo $thumb_file;
		$newimgPath = base_url().substr($savePath,2).$thumbImage;
		
		/* Get original image x y*/
		list($w, $h) = getimagesize($thumb_file);
		$size=getimagesize($thumb_file);
		if ($w>0 && $h>0){
			if ($w >= $width) {
				$height = ($width / $w) * $h;
				$width = $width;
			}else{
				$height = $h;
				$width = $w;
			}
			
			/* calculate new image size with ratio 
			$ratio = max($width/$w, $height/$h);
			$h = ceil($height / $ratio);
			$x = ($w - $width / $ratio) / 2;
			$w = ceil($width / $ratio);
			/* new file name */
			
			
			$path = $savePath.$thumbImage;
			/* read binary data from image file */
			
			$imgString = file_get_contents($newimgPath);
			/* create image from string */
			$image = imagecreatefromstring($imgString);
			
			//var_dump($width);
			//var_dump($height);
			$tmp = imagecreatetruecolor($width, $height);
			
			//imagecopyresampled($tmp, $image, 0, 0, $x, 0, $width, $height, $w, $h); 
			imagecopyresampled($tmp, $image, 0, 0, 0, 0, $width, $height, $w, $h); 
		
			/* Save image */
			switch ($size["mime"]) {
				case 'image/jpeg':
					imagejpeg($tmp, $path, 100);
					break;
				case 'image/png':
					imagepng($tmp, $path, 0);
					break;
				case 'image/gif':
					imagegif($tmp, $path);
					break;
				default:
					exit;
				break;
			}
			return $path;
			/* cleanup memory */
			imagedestroy($image);
			imagedestroy($tmp);
		}
	}
	
	
	public function ImageResizeWithCropping($width, $height, $thumbImage, $savePath){
		
		$thumb_file = $savePath.$thumbImage;
	
		$newimgPath = base_url().substr($savePath,2).$thumbImage;
	
		/* Get original image x y*/
		list($w, $h) = getimagesize($thumb_file);
		$size=getimagesize($thumb_file);
		if ($w>0 && $h>0){
			/* calculate new image size with ratio */
			$ratio = max($width/$w, $height/$h);
			$h = ceil($height / $ratio);
			$x = ($w - $width / $ratio) / 2;
			$w = ceil($width / $ratio);
			/* new file name */
			$path = $savePath.$thumbImage;
			/* read binary data from image file */
		
			$imgString = file_get_contents($newimgPath);
			/* create image from string */
			$image = imagecreatefromstring($imgString);
			$tmp = imagecreatetruecolor($width, $height);
			imagecopyresampled($tmp, $image, 0, 0, $x, 0, $width, $height, $w, $h);
		
			/* Save image */
			switch ($size["mime"]) {
				case 'image/jpeg':
					imagejpeg($tmp, $path, 100);
					break;
				case 'image/png':
					imagepng($tmp, $path, 0);
					break;
				case 'image/gif':
					imagegif($tmp, $path);
					break;
				default:
					exit;
					break;
			}
			return $path;
			/* cleanup memory */
			imagedestroy($image);
			imagedestroy($tmp);
		}
	}
	
	
	public function image_crop_process_auto($dwidth, $dheight, $x, $y, $srcwidth, $srcheight, $thumbImage, $savePath){
		if($this->checkLogin('U') == ''){
			redirect('login');
		}else {
				
			$thumb_file = $savePath.$thumbImage;
			
			$newimgPath = base_url().substr($savePath,2).$thumbImage;
			$imgString = file_get_contents($newimgPath);
			
			$size=getimagesize($thumb_file);
		
			$image = imagecreatefromstring($imgString);
			
			$path = $savePath.$thumbImage;
	
			/* create image from string */
			
			$tmp = imagecreatetruecolor($dwidth, $dheight);
			
			imagecopyresampled($tmp,$image,0,0,$x,$y,$dwidth,$dheight,$srcwidth,$srcheight);
			//		imagecopyresized($dst_r,$img_r,0,0,$_POST['x1'],$_POST['y1'],	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
			//		imagecopyresized($dst_r, $img_r,0,0, $_POST['x1'],$_POST['y1'], $_POST['x2'],$_POST['y2'],1024,980);
			//			header('Content-type: image/jpeg');
			
			switch ($size["mime"]) {
				case 'image/jpeg':
					imagejpeg($tmp, $path, 100);
					break;
				case 'image/png':
					imagepng($tmp, $path, 0);
					break;
				case 'image/gif':
					imagegif($tmp, $path);
					break;
				default:
					exit;
					break;
			}
			return $path;
			/* cleanup memory */
			imagedestroy($image);
			imagedestroy($tmp);
			
			if($this->lang->line('prof_photo_change_succ') != '')
				$lg_err_msg = $this->lang->line('prof_photo_change_succ');
			else
				$lg_err_msg = 'Profile photo changed successfully';
			$this->setErrorMessage('success',$lg_err_msg);
			echo $lg_err_msg; die;
			exit;
		}
	}
	
	
	
	/**
	 * Image Compress
	 * @param int $quality
	 * @param string $source_url 
	 * @param string $destination_url 
	 */
	public function ImageCompress($source_url, $destination_url='', $quality=50){
		$info = getimagesize($source_url);
		$savePath = $source_url;
		
		if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($savePath);
		elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($savePath);
		elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($savePath);
		### Saving Image
		imagejpeg($image, $savePath, $quality);
	}
	
	/**
	 * This function send the notification for mobile app
	 * @param int $userId
	 * @param string $message 
	 * @param string $type 
	 * @param string $urlval 
	 */
	 /*
	public function sendPushNotification($userId='', $message='',$type='',$urlval=array()) {
		$userChkKey=$this->product_model->ExecuteQuery("SELECT gcm_buyer_id,gcm_seller_id,ios_device_id FROM ".USERS." WHERE id=".$userId);
		#echo "<pre>";print_r($userChkKey);
		#echo $this->db->last_query();die;
		if($userChkKey->num_rows()>0){			
			$msg =array();
			$regIds=array();
			$msg ['message']=$message;
			$msg ['type']=$type;
			$pmusers=array('follow','message');
			$pmsellers=array('follow','favorite item','favorite shop','order ','contact','review','discussion','message');
			
			$msg ['app_type']='';
			$msg ['url_key1']=(string)$urlval[0];
			$msg ['url_key2']=(string)$urlval[1];
			$userPN=NULL;
			$sellerPN=NULL;
			if(in_array($type,$pmusers)){
				if($userChkKey->row()->gcm_buyer_id!=NULL){
					$userPN=1;
					$regIds[]=$userChkKey->row()->gcm_buyer_id;
				}
			}
			if(in_array($type,$pmsellers)){
				if($userChkKey->row()->gcm_seller_id!=NULL){
					$sellerPN=1;
					$regIds[]=$userChkKey->row()->gcm_seller_id;
				}
			}
			if(!empty($regIds)){
				if($userPN==1 && $sellerPN==1){
					$msg ['app_type']='both';
				}else if($userPN==1){
					$msg ['app_type']='user';
				}else if($sellerPN==1){
					$msg ['app_type']='seller';
				}
				$this->sendPushNotificationToGCMOrg($regIds,$msg);
			}						
			if($userChkKey->row()->ios_device_id!=NULL){
				$this->push_notification($userChkKey->row()->ios_device_id,$msg);
			}
		}
	}*/
	
	
	public function sendPushNotification($userId='', $message='',$type='',$urlval=array()) {
		$userChkKey=$this->product_model->ExecuteQuery("SELECT gcm_buyer_id,gcm_seller_id,ios_device_id FROM ".USERS." WHERE id=".$userId);
		
		if($userChkKey->num_rows()>0){			
			$msg =array();
			$regIds=array();
			$msg ['message']=$message;
			$msg ['type']=$type;
			
			$pmusers=array('follow','message');
			$pmsellers=array('follow','favorite item','favorite shop','order ','contact','review','discussion','message');
			
			$msg ['app_type']='';
			$msg ['url_key1']=(string)$urlval[0];
			$msg ['url_key2']=(string)$urlval[1];
			$msg ['url_key3']=(string)$urlval[2];
			$msg ['url_key4']=(string)$urlval[3];
			$msg ['url_key5']=(string)$urlval[4];
			$msg ['url_key6']=(string)$urlval[5];
			$msg ['url_key7']=(string)$urlval[6];
			
			$userPN=NULL;
			$sellerPN=NULL;
			
			/*
			if(in_array($type,$pmusers)){
				if($userChkKey->row()->gcm_buyer_id!=NULL){
					$userPN=1;
					$regIds[]=$userChkKey->row()->gcm_buyer_id;
				}
			}
			if(in_array($type,$pmsellers)){
				if($userChkKey->row()->gcm_seller_id!=NULL){
					$sellerPN=1;
					$regIds[]=$userChkKey->row()->gcm_seller_id;
				}
			}*/
			
			// changes on 11-08-2015 
			if($userChkKey->row()->gcm_buyer_id!=NULL){
			$regIds[]=$userChkKey->row()->gcm_buyer_id;
			$sellerPN=1;
			$userPN=1;
			}
			
			
			
			
			
			if(!empty($regIds)){
				if($userPN==1 && $sellerPN==1){
					$msg ['app_type']='both';
				}else if($userPN==1){
					$msg ['app_type']='user';
				}else if($sellerPN==1){
					$msg ['app_type']='seller';
				}
				
				
				
				$this->sendPushNotificationToGCMOrg($regIds,$msg);
			}						
			
			if($userChkKey->row()->ios_device_id!=NULL && strlen($userChkKey->row()->ios_device_id)>5 && $userChkKey->row()->ios_device_id!='0'){
			
				$this->push_notification($userChkKey->row()->ios_device_id,$msg);
			}
		}
	}
	/**
	 * This function send the notification for Anriod app
	 * @param string $registatoin_ids
	 * @param string $message 
	 */
	public function sendPushNotificationToGCMOrg($registatoin_ids, $message) {
		//Google cloud messaging GCM-API url
		$url = 'https://android.googleapis.com/gcm/send';
		$fields = array(
					'registration_ids' => $registatoin_ids,
					'data' => $message,
					);
		// Google Cloud Messaging GCM API Key
		#define("GOOGLE_API_KEY", "AIzaSyD0VJs5nLcm0j34eHCIpP7I8iNI-yRycqo"); 		
		define("GOOGLE_API_KEY", "AIzaSyDKdzKRknMspcpGgzTVicpF18yrwbpFU2o"); 		
		$headers = array(
					'Authorization: key=' . GOOGLE_API_KEY,
					'Content-Type: application/json'
					);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);				
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}
	
		public function getImageShape($width, $height, $target_file){
		list($w, $h) = getimagesize($target_file);
		if($w==$width && $h==$height){
			$option="exact";
		}else if($w==$h){
			$option="exact";
		}else if($w>$h){
			$option="landscape";
		}else if($w<$h){
			$option="portrait";
		}else{
			$option="crop";
		}
		return $option;
	}
	
	/**
	 * This function send the notification for IOS app
	 * @param string $deviceId
	 * @param string $message 
	 */
	public function push_notification($deviceId,$message){
		/* echo $deviceId;
		var_dump($message); */
	  	//$deviceId = "6b1763dfa8393319c851800288f1cd1251793ecd8053012a0818d44c802a1961";
	   	//$message = "test message for shopsy succeeded";
	   	$this->load->library('apns');
	   	$this->apns->send_push_message($deviceId,$message);
	}
	
}
