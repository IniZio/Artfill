<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User Settings related functions
 * @author Teamtweaks
 *
 */

class User_settings extends MY_Controller {
	function __construct(){ 
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation','pagination'));		
		$this->load->model(array('user_model','currency_model'));
		$this->load->model('commission_model','commission');
		
		$this->data['loginCheck'] = $this->checkLogin('U');
    }
	
	/** 
	 * 
	 * Loading the user settings page
	 *
	 */
    
    public function index(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
			$this->data['heading'] = $this->config->item('meta_title').' - Settings';
    		$this->load->view('site/user/settings',$this->data);
    	}
    }
    
	/** 
	 * 
	 * This function update the user profile
	 *
	 */
    public function update_profile(){
    	$inputArr = array();
    	$response['success'] = '0';
    	if ($this->checkLogin('U') == ''){
    		$response['msg'] = 'You must login';
    	}else {
	    	$update = '0';
	    	$email = $this->input->post('email');
	    	if ($email!=''){
	    		if (valid_email($email)){
	    			$condition = array('email'=>$email,'id !='=>$this->checkLogin('U'));
	    			$duplicateMail = $this->user_model->get_all_details(USERS,$condition);
	    			if ($duplicateMail->num_rows()>0){
						$response['msg'] = 'Email already exists';
	    			}else {
	    				$inputArr['email'] = $email;
	    				$update = '1';
	    			}
	    		}else {
	    			$response['msg'] = 'Invalid email';
	    		}
	    	}else {
	    		$update = '1';
	    	}
	    	if ($update == '1'){
	    		
				$usersid = $this->checkLogin('U');
				$condition = array('id'=>$usersid);
				
				$MailCheckCond = $this->user_model->get_all_details(USERS,$condition);
				if($MailCheckCond->row()->email != $email ){
					$dateArrayNew = array('is_verified'=>'No');
					$this->user_model->update_details(USERS,$dateArrayNew,$condition);
					$this->resend_confirm_mail_profile($email);
					
				}
				
				$birthday = $this->input->post('b_year').'-'.$this->input->post('b_month').'-'.$this->input->post('b_day');
	    		$excludeArr = array('b_year','b_month','b_day','email');
	    		$inputArr['birthday'] = $birthday;
	    		
	    		$this->user_model->commonInsertUpdate(USERS,'update',$excludeArr,$inputArr,$condition);
	    		$this->setErrorMessage('success','Done ! Your profile looks even better now');
	    		$response['success'] = '1';
	    	}
    	}
	    echo json_encode($response);
    }
    
	/** 
	 * 
	 * This function resend the  confirmation mail to user
	 * param String $mail
	 *
	 */
	public function resend_confirm_mail_profile($mail){
			$condition = array('email'=>$mail);
			$userDetails = $this->user_model->get_all_details(USERS,$condition);
			$this->send_confirm_mail_profile($userDetails);
			return 1;
	}
	
	/** 
	 * 
	 * This function send the confirmation mail to user
	 * param Array $userDetails
	 *
	 */
	public function send_confirm_mail_profile($userDetails=''){
		$uid = $userDetails->row()->id;
		$email = $userDetails->row()->email;
		$randStr = $this->get_rand_str('10');
		$condition = array('id'=>$uid);
		$dataArr = array('verify_code'=>$randStr);
		$this->user_model->update_details(USERS,$dataArr,$condition);
		$newsid='3';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);
		
		$cfmurl = base_url().'site/user/confirm_register/'.$uid."/".$randStr."/confirmation";
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
		extract($adminnewstemplateArr);
		//$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
		
		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		
		$message .= '</body>
			</html>';
		
		if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->data['siteContactMail'];
			$sender_name=$this->data['siteTitle'];
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}

		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$email,
							'subject_message'=>$template_values['news_subject'],
							'body_messages'=>$message
							);
		$email_send_to_common = $this->product_model->common_email_send($email_values);
		return 1;
	}
	
	/** 
	 * 
	 * This function update the user profile image
	 *
	 */
    public function changePhoto(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
					

	    	$config['overwrite'] = FALSE;
	    	$config['remove_spaces'] = TRUE;
	    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
	    	$config['max_size'] = 2000;
	    	$config['max_width']  = '1000';
			$config['max_height']  = '1000';
	    	$config['upload_path'] = './images/users';
	    	$this->load->library('upload', $config);
	    	if ( $this->upload->do_upload('upload-file')){
	    		$imgDetails = $this->upload->data();
	    		$dataArr['thumbnail'] = $imgDetails['file_name'];
	    		$condition = array('id'=>$this->checkLogin('U'));
	    		$this->user_model->update_details(USERS,$dataArr,$condition);
	    		redirect('image-crop/'.$this->checkLogin('U'));
	    	}else {
	    		$this->setErrorMessage('error',strip_tags($this->upload->display_errors()));
	    	}
	    	redirect(base_url().'settings');
    	}
    }
    
	/** 
	 * 
	 * This function delete the user profile image
	 *
	 */
    public function delete_user_photo(){
    	$response['success'] = '0';
    	if ($this->checkLogin('U')==''){
    		$response['msg'] = 'You must login';
    	}else {
    		$condition = array('id'=>$this->checkLogin('U'));
    		$dataArr = array('thumbnail'=>'');
    		$this->user_model->update_details(USERS,$dataArr,$condition);
    		$this->setErrorMessage('success','Profile photo deleted successfully');
    		$response['success'] = '1';
    	}
    	echo json_encode($response);
    }
    
	/** 
	 * 
	 * This function send the confirmation mail to user
	 * param Array $userDetails
	 *
	 */
    public function delete_user_account(){
    	if ($this->checkLogin('U')!=''){
    		$datestring = "%Y-%m-%d %h:%i:%s";
			$time = time();
			$newdata = array(
	               'last_logout_date' => mdate($datestring,$time),
				   'status'=>'Inactive'
			);
			$condition = array('id' => $this->checkLogin('U'));
			$this->user_model->update_details(USERS,$newdata,$condition);
			$this->user_model->update_details(SELLER,array('status' => 'inactive'),array('seller_id'=>$this->checkLogin('U')));
			$userdata = array(
							'shopsy_session_user_id'=>'',
							'shopsy_session_user_name'=>'',
							'shopsy_session_full_name'=>'',
							'shopsy_session_user_email'=>'',
							'shopsy_session_temp_id'=>''
						);
			$this->session->set_userdata($userdata);
			$this->session->unset_userdata($userdata);
			delete_cookie("Shopsy_NewUser");
			$acc_inactive=addslashes(shopsy_lg('lg_ur_acc_inactivated','Your account inactivated successfully'));
    		$this->setErrorMessage('success',$acc_inactive);
			//redirect('');
    	}
    }
    
	/** 
	 * 
	 * This function displays the change password page
	 *
	 */
    public function password_settings(){ //et
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
	    	$this->data['heading'] = 'Password Settings';
    		$this->load->view('site/user/setting_changepass',$this->data);
    	}
    }
    
	/** 
	 * 
	 * This function change the user password 
	 *
	 */
    public function change_user_password(){ //et
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$pwd = $this->input->post('pass');
    		$cfmpwd = $this->input->post('confirmpass');
    		if ($pwd != '' && $cfmpwd != '' && strlen($pwd) > 5){
    			if ($pwd == $cfmpwd){
    				$dataArr = array('password'=>md5($pwd));
    				$condition = array('id'=>$this->checkLogin('U'));
    				$this->user_model->update_details(USERS,$dataArr,$condition);
    				$this->setErrorMessage('success','Password changed successfully');
    			}else {
    				$this->setErrorMessage('error','Passwords does not match');
    			}
    		}else {
    			$this->setErrorMessage('error','Password and Confirm password fields required');
    		}
    		redirect(base_url().'settings/password');
    	}
    }
    
	/** 
	 * 
	 * This function change the user preferences 
	 *
	 */
    public function preferences_settings(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
			$this->data['heading'] = $this->config->item('email_title').' -Preference Settings';
	    	$this->data['languages'] = $this->user_model->get_all_details(LANGUAGES,array());
    		$this->load->view('site/user/change_preferences',$this->data);
    	}
    }
    

	/** 
	 * 
	 * This function Load Account preferences
	 *
	 */
	function account_preferences()
	{
		if ($this->checkLogin('U') == ''){
			$this->setErrorMessage('error','You must login');
				redirect(base_url());
		}
	    	//$this->data['languagesList'] = $this->user_model->get_all_details(LANGUAGES,array('status' => 'Active'));
		$this->data['heading'] = $this->config->item('email_title').' - Preference Settings';
		$this->load->view("site/user/preferences",$this->data);
		
	}    
	
	/** 
	 * 
	 * This function Load Account Privacy
	 *
	 */
	function account_privacy()
	{
		if ($this->checkLogin('U') == ''){
			$this->setErrorMessage('error','You must login');
				redirect(base_url());
		}
		$this->data['privacy'] = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
		$this->data['heading'] = $this->config->item('email_title').' - Privacy';
		$this->load->view("site/user/privacy",$this->data);
	
	}
	
	
	/** 
	 * 
	 * This function update the user preference and also set the user currency session values
	 *
	 */
	public function update_preference_settings(){

    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {  
			if($this->session->userdata('currency_data')){	
				
			$this->session->unset_userdata('currency_data');
				if($this->input->get('currency_code') != ''){
			    	$currencyCode=$this->input->get('currency_code');  
						
					$this->user_model->update_details(USERS,array('currency' => $currencyCode),array('id'=>$this->checkLogin('U')));
					$this->setErrorMessage('success','Currency Changed successfully');
    		         redirect('gift-cards');
				
				} else if($this->input->post('currency') != ''){ 
	
					$this->user_model->commonInsertUpdate(USERS,'update',array(),array(),array('id'=>$this->checkLogin('U')));
					$currencyCode=$this->input->post('currency');
				}
			$result=$this->currency_model->get_currency_details($currencyCode); // echo '<pre>'; print_r($result); die;
			$nCVal=array();
			foreach($result as $cKey=>$cVal){
				$nCVal[$cKey]=base64_encode($cVal);
			}
			#$this->session->set_userdata('currency_data',$result);
			$this->session->set_userdata('currency_data',$nCVal);
			
			
			$condition=array('id'=>$this->checkLogin('U'));
			$result=$this->currency_model->get_all_details(USERS,$condition); 
        	$codee=$result->result_array();
			$condition=array("country_code"=>$codee[0]["region"]);
			$result=$this->product_model->get_all_details(COUNTRY_LIST,$condition);
			
			$this->session->set_userdata('region',$result->row_array());
          
			}
		
		
    		if($this->lang->line('preferences')!='') { $preference= stripslashes($this->lang->line('preferences')); } else $preference ="Preferences saved successfully";
    		$this->setErrorMessage('success',$preference);
    		redirect('settings/account-preferences');
    	}
    }
	
	/** 
	 * 
	 * This function update the user updates privacy settings
	 *
	 */
	public function update_privacy_settings(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {  
		$privacy_saved=addslashes(shopsy_lg('lg_privacy_saved_successfully','Your privacy saved successfully'));
    		$this->user_model->commonInsertUpdate(USERS,'update',array(),array(),array('id'=>$this->checkLogin('U')));
    		$this->setErrorMessage('success',$privacy_saved);
    		redirect('settings/account-privacy');
    	}
    }
	
	
	/** 
	 * 
	 * This function update the user preference
	 *
	 */
    public function update_preferences(){
	
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->user_model->commonInsertUpdate(USERS,'update',array(),array(),array('id'=>$this->checkLogin('U')));
    		if($this->lang->line('preferences')!='') { $prefer= stripslashes($this->lang->line('preferences')); } else $prefer ="Preferences saved successfully";
    		$this->setErrorMessage('success',$prefer);
    		redirect(base_url().'settings/preferences');
    	}
    }
    
	/** 
	 * 
	 * This function display the user notification settings
	 *
	 */
	public function notifications_settings(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
	    	$this->data['heading'] = 'Notifications Settings';
	    	$this->data['languages'] = $this->user_model->get_all_details(LANGUAGES,array());
    		$this->load->view('site/user/change_notifications',$this->data);
    	}
    }
    
	/** 
	 * 
	 * This function update the user notification settings
	 *
	 */
    public function update_notifications(){
		
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
	    	$emailArr = $this->data['emailArr'];
	    	$notyArr = $this->data['notyArr'];
	    	$emailStr = '';
	    	$notyStr = '';
	    	foreach ($this->input->post() as $key=>$val){
	    		if (in_array($key, $emailArr)){
	    			$emailStr .= $key.',';
	    		}else if (in_array($key, $notyArr)){
	    			$notyStr .= $key.',';
	    		}
	    	}
	    	$updates = $this->input->post('updates');
	    	$updates = ($updates == '')?'0':'1';
	    	$emailStr = substr($emailStr, 0,strlen($emailStr)-1);
	    	$notyStr = substr($notyStr, 0,strlen($notyStr)-1);
	    	$dataArr = array(
	    		'email_notifications'	=>	$emailStr,
	    		'notifications'			=>	$notyStr,
	    		'updates'				=>	$updates
	    	);
	    	$condition = array('id'=>$this->checkLogin('U'));
	    	$this->user_model->update_details(USERS,$dataArr,$condition);
	    	$this->setErrorMessage('success','Notifications settings saved successfully');
	    	redirect(base_url().'settings/notifications');
    	}
    }
    
	/** 
	 * 
	 * This function display the user purchase
	 *
	 */
    public function user_purchases(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'Merchant Purchases';
	    	$this->data['purchasesList'] = $this->user_model->get_purchase_details($this->checkLogin('U'));
    		$this->load->view('site/user/user_purchases',$this->data);
    	}
    }
	
	/** 
	 * 
	 * This function display the seller purchase
	 *
	 */
	public function seller_purchases(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'Seller Purchases';
	    	$this->data['SellerpurchasesList'] = $this->user_model->get_seller_purchase_details($this->checkLogin('U'));			
    		$this->load->view('site/user/seller_purchases',$this->data);
    	}
    }
    
	/** 
	 * 
	 * This function display the merchant order
	 *
	 */
    public function user_orders(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'Merchant Orders';
	    	$this->data['ordersList'] = $this->user_model->get_user_orders_list($this->checkLogin('U'));
			//echo '<pre>';print_r($this->data['ordersList']->num_rows()); 
    		$this->load->view('site/user/user_orders_list',$this->data);
    	}
    }
	
	/** 
	 * 
	 * This function display the seller order
	 *
	 */
	 public function seller_orders(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'Seller Orders';
	    	$this->data['ordersList'] = $this->user_model->get_seller_orders_list($this->checkLogin('U'));
    		$this->load->view('site/user/seller_orders_list',$this->data);
    	}
    }
    
	/** 
	 * 
	 * This function display the fancybox
	 *
	 */
    public function manage_fancyybox(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'Subscriptions';
	    	$this->data['subscribeList'] = $this->user_model->get_subscriptions_list($this->checkLogin('U'));
    		$this->load->view('site/user/manage_fancyybox',$this->data);
    	}
    }
    
	/** 
	 * 
	 * This function display the shipping address
	 *
	 */
    public function shipping_settings(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'Shipping Address';
    		$this->data['countryList'] = $this->user_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')));
	    	$this->data['shippingList'] = $this->user_model->get_all_details(SHIPPING_ADDRESS,array('user_id'=>$this->checkLogin('U')));
    		$this->load->view('site/user/shipping_settings',$this->data);
    	}
    }
    
	
	/** 
	 * 
	 * This function add the shipping address
	 *
	 */
	public function display_shippings(){
		if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'Add Shipping Address';
			$this->data['meta_title'] = 'Add Shipping Address';
    		$this->data['countryList'] = $this->user_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')));
	    	$this->data['shippingList'] = $this->user_model->get_all_details(SHIPPING_ADDRESS,array('user_id'=>$this->checkLogin('U')));
    		$this->load->view('site/user/add_shipping_settings',$this->data);
    	}
	}
	
	/** 
	 * 
	 * This function edit the shipping address
	 *
	 */
    public function edit_shippings(){
		
		$id = $this->uri->segment(4);
		print_r($second_segment);
		
		if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'Edit Shipping Address';
			$this->data['meta_title'] = 'Edit Shipping Address';
    		$this->data['countryList'] = $this->user_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')));
	    	$this->data['shippingList'] = $this->user_model->get_all_details(SHIPPING_ADDRESS,array('id'=>$id,'user_id'=>$this->checkLogin('U')));
    		$this->load->view('site/user/edit_shipping_settings',$this->data);
    	}
	}
	
	
	/** 
	 * 
	 * This function insert / update the shipping address
	 *
	 */
	public function insertEdit_shipping_address(){
		
		
		$excludeArr = array('ship_id','set_default');
    		$dataArr = array('primary'=>$primary);
    		$condition = array('id'=>$shipID);
		 
		 
		 $cart_page_url = $this->input->post('cart_page_url');
    	
		if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$shipID = $this->input->post('ship_id');
    		$is_default = $this->input->post('set_default');
    		if ($is_default == ''){
    			$primary = 'No';
    		}else{
    			$primary = 'Yes';
    		}
    		$checkAddrCount = $this->user_model->get_all_details(SHIPPING_ADDRESS,array('user_id'=>$this->checkLogin('U')));
    		if ($checkAddrCount->num_rows == 0){
    			$primary = 'Yes';
    		}
    		$excludeArr = array('ship_id','set_default','cart_page_url');
    		$dataArr = array('primary'=>$primary);
    		$condition = array('id'=>$shipID);
			//	print_r($condition); die;

    		if ($shipID==''){
    			$this->user_model->commonInsertUpdate(SHIPPING_ADDRESS,'insert',$excludeArr,$dataArr,$condition);

    			$shipID = $this->user_model->get_last_insert_id();

    			$this->setErrorMessage('success','Your Shipping address is added successfully !');
    		}else {
    			$this->user_model->commonInsertUpdate(SHIPPING_ADDRESS,'update',$excludeArr,$dataArr,$condition);
    			$this->setErrorMessage('success','Shipping address updated successfully');
    		}
    		if ($primary == 'Yes'){
	    		$condition = array('id !='=>$shipID,'user_id'=>$this->checkLogin('U'));
    			$dataArr = array('primary'=>'No');
    			$this->user_model->update_details(SHIPPING_ADDRESS,$dataArr,$condition);

    		}else {
    			$condition = array('primary'=>'Yes','user_id'=>$this->checkLogin('U'));
    			$checkPrimary = $this->user_model->get_all_details(SHIPPING_ADDRESS,$condition);
    			if ($checkPrimary->num_rows()==0){
    				$condition = array('id'=>$shipID,'user_id'=>$this->checkLogin('U'));
	    			$dataArr = array('primary'=>'Yes');
	    			$this->user_model->update_details(SHIPPING_ADDRESS,$dataArr,$condition);
    			}
    		}
			if($cart_page_url=='cart')
			{
    		redirect(base_url().'cart');
			}else
			{
			    redirect(base_url().'settings/shipping');
			}
    	}
    }
    
	/** 
	 * 
	 * This function edit the shipping address
	 *
	 */
	public function Edit_shipping_address(){
	//echo '<pre>'; print_r($_POST); die;
	
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$shipID = $this->input->post('ship_id');
    		$is_default = $this->input->post('set_default');
    		if ($is_default == ''){
    			$primary = 'No';
    		}else{
    			$primary = 'Yes';
    		}
    		$checkAddrCount = $this->user_model->get_all_details(SHIPPING_ADDRESS,array('user_id'=>$this->checkLogin('U')));
    		if ($checkAddrCount->num_rows == 0){
    			$primary = 'Yes';
    		}
    		$excludeArr = array('ship_id','set_default');
    		$dataArr = array('primary'=>$primary);
    		$condition = array('id'=>$shipID);
			//	print_r($condition); die;

    		if ($shipID==''){
    			$this->user_model->commonInsertUpdate(SHIPPING_ADDRESS,'insert',$excludeArr,$dataArr,$condition);

    			$shipID = $this->user_model->get_last_insert_id();

    			$this->setErrorMessage('success','Your Shipping address is added successfully !');
    		}else {
    			$this->user_model->commonInsertUpdate(SHIPPING_ADDRESS,'update',$excludeArr,$dataArr,$condition);
    			$this->setErrorMessage('success','Shipping address updated successfully');
    		}
    		if ($primary == 'Yes'){
	    		$condition = array('id !='=>$shipID,'user_id'=>$this->checkLogin('U'));
    			$dataArr = array('primary'=>'No');
    			$this->user_model->update_details(SHIPPING_ADDRESS,$dataArr,$condition);

    		}else {
    			$condition = array('primary'=>'Yes','user_id'=>$this->checkLogin('U'));
    			$checkPrimary = $this->user_model->get_all_details(SHIPPING_ADDRESS,$condition);
    			if ($checkPrimary->num_rows()==0){
    				$condition = array('id'=>$shipID,'user_id'=>$this->checkLogin('U'));
	    			$dataArr = array('primary'=>'Yes');
	    			$this->user_model->update_details(SHIPPING_ADDRESS,$dataArr,$condition);
    			}
    		}
    		redirect(base_url().'settings/shipping');
    	}
    }
	
	/** 
	 * 
	 * This function retrieve the shipping address
	 *
	 */
    public function get_shipping(){
    	$shipID = $this->input->post('shipID');
    	$shipDetails = $this->user_model->get_all_details(SHIPPING_ADDRESS,array('id'=>$shipID));
    	$returnStr['full_name'] = $shipDetails->row()->full_name;
    	$returnStr['nick_name'] = $shipDetails->row()->nick_name;
    	$returnStr['address1'] = $shipDetails->row()->address1;
    	$returnStr['address2'] = $shipDetails->row()->address2;
    	$returnStr['city'] = $shipDetails->row()->city;
    	$returnStr['state'] = $shipDetails->row()->state;
    	$returnStr['country'] = $shipDetails->row()->country;
    	$returnStr['postal_code'] = $shipDetails->row()->postal_code;
    	$returnStr['phone'] = $shipDetails->row()->phone;
    	$returnStr['primary'] = $shipDetails->row()->primary;
    	echo json_encode($returnStr);
    }
    
	/** 
	 * 
	 * This function delete the shipping address
	 *
	 */
    public function remove_shipping_addr(){
    	$returnStr['status_code'] = 0;
    	if ($this->checkLogin('U')==''){
    		$returnStr['message'] = 'You must login';
    	}else {
    		$shipID = $this->input->post('id');
    		$this->user_model->commonDelete(SHIPPING_ADDRESS,array('id'=>$shipID));
    		$returnStr['status_code'] = 1;
    	}
    	echo json_encode($returnStr);
    }
	
	/** 
	 * 
	 * This function display the my earnings
	 *
	 */
    public function user_credits(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'My Earnings';
			$orderDetails = $this->data['orderDetails'] = $this->commission->get_total_order_amount($this->checkLogin('U'));
			$commission_to_admin = 0;
			$amount_to_vendor = 0;
			$total_amount = 0;
			$this->data['total_amount'] = $total_amount;
			$total_orders = 0;
			$this->data['except_refunded'] = 0;
    		if ($orderDetails->num_rows()==1){
				$commission_percentage = $this->data['userDetails']->row()->commision;
				$total_amount = $orderDetails->row()->TotalAmt;
				$this->data['total_amount'] = $total_amount;
				$total_amount = $total_amount-$this->data['userDetails']->row()->refund_amount;
				$this->data['except_refunded'] = $total_amount;
				$commission_to_admin = $total_amount*($commission_percentage*0.01);
				if ($commission_to_admin<0)$commission_to_admin=0;
				$amount_to_vendor = $total_amount-$commission_to_admin;
				if ($amount_to_vendor<0)$amount_to_vendor=0;
				$total_orders = $orderDetails->row()->orders;
			}
			$paidDetails = $this->commission->get_total_paid_details($this->checkLogin('U'));
			$paid_to = 0;
			if ($paidDetails->num_rows()==1){
				$paid_to = $paidDetails->row()->totalPaid;
				if ($paid_to<0)$paid_to=0;
			}
			$paid_to_balance = $amount_to_vendor-$paid_to;
			if ($paid_to_balance<0)$paid_to_balance=0;
			$this->data['commission_to_admin'] = $commission_to_admin;
			$this->data['amount_to_vendor'] = $amount_to_vendor;
			$this->data['total_orders'] = $total_orders;
			$this->data['paid_to'] = $paid_to;
			$this->data['paid_to_balance'] = $paid_to_balance;
			$sortArr1 = array('field'=>'date','type'=>'desc');
			$sortArr = array($sortArr1);
			$this->data['paidDetailsList'] = $this->commission->get_all_details(VENDOR_PAYMENT,array('vendor_id'=>$this->checkLogin('U'),'status'=>'success'),$sortArr);
    		$this->load->view('site/user/user_credits',$this->data);
    	}
    }
	
	/** 
	 * 
	 * This function display the user referrals
	 *
	 */
    public function user_referrals(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
		//echo "hi";die;
		$paginationNo = $this->uri->segment('2');
		
		if($paginationNo == '')
		{
			$paginationNo = 0;
		}
		else
		{
			$paginationNo = $paginationNo;
		}
		
		$searchPerPage = $this->config->item('pagination_per_page');
		//echo "DSf".$this->uri->segment('2');die;
		
		$referalBaseUrl = base_url().'referrals';
		
		
		$getReferalListCount = $this->user_model->getReferalList();
		$getReferalList = $this->user_model->getReferalList($searchPerPage,$paginationNo);
		
		$config['base_url'] = $referalBaseUrl;
		$config['total_rows'] = count($getReferalListCount);
		$config["per_page"] = $searchPerPage;
		$config["uri_segment"] =2;
		$this->pagination->initialize($config); 
		$paginationLink = $this->pagination->create_links();//die;
		
		
		
		$this->data['heading'] = 'Referrals';
		$this->data['getReferalList'] = $getReferalList;
		$this->data['paginationLink'] = $paginationLink;
			
			
		//	echo "<pre>";print_r($getReferalList);die;
			
			
//	    	$this->data['purchasesList'] = $this->user_model->get_group_gifts_list($this->checkLogin('U'));
    		$this->load->view('site/user/user_referrals',$this->data);
    	}
    }
	
	/** 
	 * 
	 * This function display the user giftcards
	 *
	 */
    public function user_giftcards(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'Gift Cards';
			$condition = array('id'=>$this->checkLogin('U'));
    		$userDetails = $this->user_model->get_all_details(USERS,$condition);
	    	$this->data['giftcardsList'] = $this->user_model->get_gift_cards_list($userDetails->row()->email);
			$this->data['sendgiftcardsList'] = $this->user_model->get_send_gift_cards_list($userDetails->row()->email);
    		$this->load->view('site/user/user_giftcards',$this->data);
    	}
    }
    public function manage_notification(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'Manage Notifications';
			$condition = array('user_id'=>$this->checkLogin('U'));
	    	$this->load->view('site/user/manage_notification',$this->data);
    	}
    }
	public function save_noty_change(){
		if($this->checkLogin('U') == ''){
			redirect(base_url().'login');
		}
		else{
			
			$notification_email=explode(',',$this->data['userDetails']->row()->notification_email);			
			foreach ($this->input->post() as $key=>$val){
			if($key != 'updates' )
				{					
					$notyStr .= $key.',';					
				}
	    	}
			$update_email='No';
			$updates = $this->input->post('updates');
			if(!empty($updates)){
				$update_email='Yes';
			}
			$dataArr=array(
						'update_email'=>$update_email,
						'notification_email'=>$notyStr						
					);
			#echo "<pre>";print_r($dataArr);die;
			$this->user_model->update_details(USERS,$dataArr,array('id'=>$this->checkLogin('U')));
			$change_email_notification=addslashes(shopsy_lg('lg_sucess_email_notification','Successfully changes made on Email Notification'));
			$this->setErrorMessage('success',$change_email_notification);
			redirect(base_url().'manage-notification');
		}
		
	}
	/** 
	 * 
	 * This function change the user profile photo
	 *
	 */
    public function change_photo(){
    	if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
		

	    	$config['overwrite'] = FALSE;
	    	$config['remove_spaces'] = TRUE;
	    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
	    	$config['max_size'] = 2000;
	    	$config['max_width']  = '600';
			$config['max_height']  = '600';
	    	$config['upload_path'] = './images/users';
	    	$this->load->library('upload', $config);
	    	if ( $this->upload->do_upload('upload-file')){
	    		$imgDetails = $this->upload->data();
	    		$dataArr['thumbnail'] = $imgDetails['file_name'];
	    		$condition = array('id'=>$this->checkLogin('U'));
	    		$this->user_model->update_details(USERS,$dataArr,$condition);
	    		redirect('image-crop/'.$this->checkLogin('U'));
	    	}else {
	    		$this->setErrorMessage('error',strip_tags($this->upload->display_errors()));
	    	}
	    	echo "<script>window.history.go(-1);</script>";
    	}
    }
	
	/** 
	 * 
	 * This function changes the site default currency in footer
	 *
	 */
	public function change_currency($id){
		if ($this->checkLogin('U')==''){
    		
			if($this->session->userdata('currency_data')){	
			$this->session->unset_userdata('currency_data');
			$result=$this->currency_model->get_currency_details($this->input->post('currency')); // echo '<pre>'; print_r($result); die;
			$nCVal=array();
			foreach($result as $cKey=>$cVal){
				$nCVal[$cKey]=base64_encode($cVal);
			}
			#$this->session->set_userdata('currency_data',$result);
			$this->session->set_userdata('currency_data',$nCVal);
			
			
			/*$resultcountry=$this->currency_model->get_all_details(COUNTRY_LIST,array('country_code' => $this->input->post('region'))); // echo '<pre>'; print_r($result); die;
			$this->session->set_userdata('region',$resultcountry->row_array());*/
			$selectedLangCode = $this->session->set_userdata('language_code',$this->input->post('language'));
			redirect($this->input->post('returnUrl'));
			}
    	}else {  
		
    		$this->user_model->commonInsertUpdate(USERS,'update',array('returnUrl'),array(),array('id'=>$this->checkLogin('U')));

    		//echo $this->db->last_query(); die;
			if($this->session->userdata('currency_data')){	
			$this->session->unset_userdata('currency_data');
			$result=$this->currency_model->get_currency_details($this->input->post('currency')); // echo '<pre>'; print_r($result); die;
			$nCVal=array();
			foreach($result as $cKey=>$cVal){
				$nCVal[$cKey]=base64_encode($cVal);
			}
			#$this->session->set_userdata('currency_data',$result);
			$this->session->set_userdata('currency_data',$nCVal);
			
			
			$selectedLangCode = $this->session->set_userdata('language_code',$this->input->post('language'));
			/*$resultcountry=$this->currency_model->get_all_details(COUNTRY_LIST,array('country_code' => $this->input->post('region'))); // echo '<pre>'; print_r($result); die;
			$this->session->set_userdata('region',$resultcountry->row_array());*/
			}
    		 if($this->lang->line('preferences')!='') { $preferences= stripslashes($this->lang->line('preferences')); } else $preferences ="Preferences saved successfully";
    		$this->setErrorMessage('success',$preferences);
    		redirect($this->input->post('returnUrl'));
    	}
	} 

	
	
	public function change_currency_ajax(){
		if ($this->checkLogin('U')==''){
	
			if($this->session->userdata('currency_data')){
				$this->session->unset_userdata('currency_data');
				$result=$this->currency_model->get_currency_details($this->input->post('currency')); // echo '<pre>'; print_r($result); die;
				$nCVal=array();
				foreach($result as $cKey=>$cVal){
					$nCVal[$cKey]=base64_encode($cVal);
				}
				#$this->session->set_userdata('currency_data',$result);
				$this->session->set_userdata('currency_data',$nCVal);
					
				/*$resultcountry=$this->currency_model->get_all_details(COUNTRY_LIST,array('country_code' => $this->input->post('region'))); // echo '<pre>'; print_r($result); die;
				 $this->session->set_userdata('region',$resultcountry->row_array());*/
				$selectedLangCode = $this->session->set_userdata('language_code',$this->input->post('language'));
				
				echo "success";
				//redirect($this->input->post('returnUrl'));
			}
		}else {
			$this->user_model->commonInsertUpdate(USERS,'update',array('returnUrl'),array(),array('id'=>$this->checkLogin('U')));
			if($this->session->userdata('currency_data')){
				$this->session->unset_userdata('currency_data');
				$result=$this->currency_model->get_currency_details($this->input->post('currency')); // echo '<pre>'; print_r($result); die;
				$nCVal=array();
				foreach($result as $cKey=>$cVal){
					$nCVal[$cKey]=base64_encode($cVal);
				}
				#$this->session->set_userdata('currency_data',$result);
				$this->session->set_userdata('currency_data',$nCVal);
					
					
				$selectedLangCode = $this->session->set_userdata('language_code',$this->input->post('language'));
				/*$resultcountry=$this->currency_model->get_all_details(COUNTRY_LIST,array('country_code' => $this->input->post('region'))); // echo '<pre>'; print_r($result); die;
				 $this->session->set_userdata('region',$resultcountry->row_array());*/
			}
			if($this->lang->line('preferences')!='') { $preferences= stripslashes($this->lang->line('preferences')); } else $preferences ="Preferences saved successfully";
			
			echo "success";
			//$this->setErrorMessage('success',$preferences);
			//redirect($this->input->post('returnUrl'));
		}
	}
	
}

/* End of file user_settings.php */
/* Location: ./application/controllers/site/user_settings.php */