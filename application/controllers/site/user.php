<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
/** 
 * 
 * User related functions
 * @author Teamtweaks
 *
 **/ 

class User extends MY_Controller { 

	function __construct(){
		error_reporting(E_ALL ^ (E_NOTICE));
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->library('session');
		$this->load->model(array('user_model','product_model','seller_model','product_attribute_model','featurekey_model'));
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
	 	if ($this->data['loginCheck'] != ''){
	 		$this->data['likedProducts'] = $this->product_model->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
	 	}
		
		
    }
    
    /**
     * 
     * Function for quick signup
     */
	public function quickSignup(){
		$email = $this->input->post('email');
		$returnStr['success'] = '0';
		if (valid_email($email)){
			$condition = array('email'=>$email);
			$duplicateMail = $this->user_model->get_all_details(USERS,$condition);
			if ($duplicateMail->num_rows()>0){
				$returnStr['msg'] = 'Email id already exists';	
			}else {
				$fullname = substr($email, 0,strpos($email, '@'));
				$checkAvail = $this->user_model->get_all_details(USERS,array('user_name'=>$fullname));
				if ($checkAvail->num_rows()>0){
					$avail = FALSE;
				}else {
					$avail = TRUE;
					$username = $fullname;
				}
				while (!$avail){
					$username = $fullname.rand(1111, 999999);
					$checkAvail = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
					if ($checkAvail->num_rows()>0){
						$avail = FALSE;
					}else {
						$avail = TRUE;
					}
				}
				if ($avail){
					$pwd = $this->get_rand_str('6');
					$this->user_model->insertUserQuick($fullname,$username,$email,$pwd);
					$this->session->set_userdata('quick_user_name',$email);
					$returnStr['msg'] = 'Successfully registered';
					$returnStr['full_name'] = $fullname;
					$returnStr['user_name'] = $username;
					$returnStr['password'] = $pwd;
					$returnStr['email'] = $email;
					$returnStr['success'] = '1';
				}
			}
		}else {
			$returnStr['msg'] = "Invalid email id";
		}
		echo json_encode($returnStr);
	}
    
    /**
     * 
     * Function for quick signup update
     */
	public function quickSignupUpdate(){
		$returnStr['success'] = '0';
		$unameArr = $this->config->item('unameArr');
		$username = $this->input->post('username');
		if (!preg_match('/^\w{1,}$/', trim($username))){
			$returnStr['msg'] = 'User name not valid. Only alphanumeric allowed';
		}elseif (in_array($username, $unameArr)){
			$returnStr['msg'] = 'User name already exists';
		}else {
			$email = $this->input->post('email');
			$condition = array('user_name'=>$username,'email !='=>$email);
			$duplicateName = $this->user_model->get_all_details(USERS,$condition);
			if ($duplicateName->num_rows()>0){
				$returnStr['msg'] = 'Username already exists';	
			}else {
				$pwd = $this->input->post('password');
				$fullname = $this->input->post('fullname');
				$this->user_model->updateUserQuick($fullname,$username,$email,$pwd);
				$this->session->set_userdata('quick_user_name',$email);
				$returnStr['msg'] = 'Successfully registered';
				$returnStr['success'] = '1';
			}
		}
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * Send the register mail confirmation
	 * 
	 */
	public function send_quick_register_mail(){

		if ($this->checkLogin('U') != ''){
			redirect(base_url());
		}else {
			$quick_user_name = $this->session->userdata('quick_user_name');
			if ($quick_user_name == ''){
				redirect(base_url());
			}else {
				$condition = array('email'=>$quick_user_name);
				$userDetails = $this->user_model->get_all_details(USERS,$condition);
				if ($userDetails->num_rows() == 1){
					$this->send_confirm_mail($userDetails);
					$this->login_after_signup($userDetails);
					
					$this->session->set_userdata('quick_user_name','');
					if ($userDetails->row()->is_brand == 'yes'){
						redirect(base_url().'create-brand');
					}else {
									$this->setErrorMessage('success','You are sucessfully Registered!!!');

						redirect(base_url());
					}
				}else {
					redirect(base_url());
				}
			}
		}
	}
	
	
	/**
	 * 
	 * Send the register mail confirmation
	 * 
	 */
	public function send_register_mail(){

		if ($this->checkLogin('U') != ''){
			redirect(base_url());
		}else {			
			$email = $this->session->userdata('shopsy_session_user_email');
			if ($email == ''){
				redirect(base_url());
			}else {
				$condition = array('email'=>$email);
				$userDetails = $this->user_model->get_all_details(USERS,$condition);
				###echo "<pre>"; print_r($userDetails); die;
				if ($userDetails->num_rows() == 1){
					$this->send_confirm_mail($userDetails);
					$this->login_after_signup($userDetails);
					
					$this->session->set_userdata('shopsy_session_user_email','');					
				}else {
					redirect(base_url());
				}
			}
		}
	}
	
	/**
	 * 
	 * Post the feedback for products
	 * 
	 */
	public function feedback(){
			$voter_id = $this->input->post('user_id');
			$shop_id = $this->input->post('shop_id');
			$seller_product_id = $this->input->post('product_id');
			$deal_code = $this->input->post('deal_code');
			$description = trim($this->input->post('description'));
			$rating = $this->input->post('rating');
			$status="Active";
			$title=$this->input->post('title');
			// if(trim($this->input->post('old_msg')) !=$description || $this->input->post('old_rating') !=$rating ){
			// 	$status="Inactive";
			// }
			$dataArray=array('voter_id' => $voter_id,
							'shop_id' => $shop_id,
							'seller_product_id'=>$seller_product_id,
							'deal_code'=>$deal_code, 
							'description' => $description, 
							'rating' => $rating,
							'status'=>$status,
							'title'=>$title);
			if($voter_id!='')
			{
				if($this->input->post("mode")==''){
					$this->user_model->simple_insert(PRODUCT_FEEDBACK,$dataArray);
					$lastIid=$this->db->insert_id(); 
					$activity="review";
					
					/*Push Message Starts*/
					//$message=$this->session->set_userdata('shopsy_session_user_name','').' has rated you item on '.$this->config->item('email_title');
					$message=$this->session->userdata('shopsy_session_user_name').' has rated you item on '.$this->config->item('email_title');
					$type='review';
					$this->sendPushNotification($shop_id,$message,$type,array($lastIid,$voter_id));
					/*Push Message Ends*/	
					
				}else if($this->input->post("mode")!=''){
					$dataArr = array('description'=>$description,'rating' => $rating);
					$condition = array('id'=>$this->input->post("mode"));
					$this->user_model->update_details(PRODUCT_FEEDBACK,$dataArr,$condition);
					$lastIid=$this->input->post("mode");
					$activity="review-update";
				}
				
				$actArr = array('activity'=>$activity,
										'activity_id'=>$shop_id,
										'user_id'	=>$voter_id,
										'activity_ip'=>$this->input->ip_address(),
										'created'=>date("Y-m-d H:i:s"),
										'comment_id'=>$lastIid);
				$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
				
				
		
		
				$query="SELECT AVG(rating) as shop_ratting,COUNT(*) as review_count  FROM ".PRODUCT_FEEDBACK." WHERE status='Active' and shop_id=".$shop_id; 
				$shop_ratting=$this->user_model->ExecuteQuery($query)->row();
				$ratting=round($shop_ratting->shop_ratting,2);
				$review_count=$shop_ratting->review_count;
				$condition = array('seller_id'=>$shop_id);
				$dataArr = array('shop_ratting'=>$ratting,'review_count'=>$review_count);
				$this->user_model->update_details(SELLER,$dataArr,$condition);			
			}
			//redirect($base_url.'view-order/'.$voter_id.'/'.$deal_code);
			redirect('purchase-review');
	}
	
	/**
	 * 
	 * Find friends view page
	 * 
	 */
	public function find_friends(){
		if ($this->checkLogin('U') == ''){
			redirect(base_url());
		}else {
			$this->load->view('site/user/find_friends',$this->data);
		}
	}
	
	/**
	 * 
	 * Invite Friends
	 * 
	 */	
	public function app_twitter(){
		$returnStr['status_code'] = 1;
		$returnStr['url'] = base_url().'twtest/get_twitter_user';
		$returnStr['message'] = '';
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * Find the twitter Friends
	 * 
	 */
	public function find_friends_twitter(){
		$returnStr['status_code'] = 1;
		$returnStr['url'] = base_url().'twtest/invite_friends';
		$returnStr['message'] = '';
		echo json_encode($returnStr);
	}

	/**
	 * 
	 * Find the gmail Friends
	 * 
	 */
	public function find_friends_gmail(){
		$returnStr['status_code'] = 1;
		error_reporting(0);
		include_once './invite_friends/GmailOath.php';
		include_once './invite_friends/Config.php';
		$oauth =new GmailOath($consumer_key, $consumer_secret, $argarray, $debug, $callback);
		$getcontact=new GmailGetContacts();
		$access_token=$getcontact->get_request_token($oauth, false, true, true);
		$this->session->set_userdata('oauth_token',$access_token['oauth_token']);
		$this->session->set_userdata('oauth_token_secret',$access_token['oauth_token_secret']);
		$returnStr['url'] = "https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token=".$oauth->rfc3986_decode($access_token['oauth_token']);
		$returnStr['message'] = '';
		echo json_encode($returnStr);
	}

	/**
	 * 
	 * Find the gmail Friends and call back function
	 * 
	 */
	public function find_friends_gmail_callback(){
		include_once './invite_friends/GmailOath.php';
		include_once './invite_friends/Config.php';
		error_reporting(0);
		$oauth =new GmailOath($consumer_key, $consumer_secret, $argarray, $debug, $callback);
		$getcontact_access=new GmailGetContacts();
		
		$request_token=$oauth->rfc3986_decode($this->input->get('oauth_token'));
		$request_token_secret=$oauth->rfc3986_decode($this->session->userdata('oauth_token_secret'));
		$oauth_verifier= $oauth->rfc3986_decode($this->input->get('oauth_verifier'));

		$contact_access = $getcontact_access->get_access_token($oauth,$request_token, $request_token_secret,$oauth_verifier, false, true, true);
		$access_token=$oauth->rfc3986_decode($contact_access['oauth_token']);
		$access_token_secret=$oauth->rfc3986_decode($contact_access['oauth_token_secret']);
		$contacts= $getcontact_access->GetContacts($oauth, $access_token, $access_token_secret, false, true,$emails_count);
		#echo "/<pre>"; print_r($contacts); die;
		$count = 0;
		foreach($contacts as $k => $a)
		{
			$final = end($contacts[$k]);
			foreach($final as $email)
			{
				$this->send_invite_mail($email["address"]);
				$count++;
			}
		}
		if ($count>0){
			echo "
			<script>
				alert('Invitations sent successfully');
				window.close();
			</script>
			";
		}else {
			echo "
			<script>
				window.close();
			</script>
			";
		}
	}


	/**
	 * 
	 * To register the new user
	 * 
	 */
	public function registerUser(){

		$returnStr['success'] = '0';
		$unameArr = $this->config->item('unameArr');
		//$featurekey_id = $this->input->post('featurekey_id');
		$fullname = $this->input->post('fullname');
		$lastname = $this->input->post('lastname');
		$gender = $this->input->post('gender');
		$email = $this->input->post('email');
		$pwd = md5($this->input->post('pwd'));
		$Confirmpwd = $this->input->post('Confirmpwd');
		$username = stripslashes(trim($this->input->post('username')));
		$subscription= $this->input->post('subscription');
		
	//if (($featurekey_id=='') || ($this->use_key($feature_id)==FALSE)){
	//redirect('wrong', 302);

		//$returnStr['msg'] = 'Invalid beta key';
	//}
		if (!preg_match('/^\w{1,}$/', trim($username))){
			$returnStr['msg'] = 'User name not valid';
		}
		elseif (in_array($username, $unameArr)){
			$returnStr['msg'] = 'User name already exists';
		}else {
			if (valid_email($email)){
				$condition = array('user_name'=>$username);
				$duplicateName = $this->user_model->get_all_details(USERS,$condition);
				if ($duplicateName->num_rows()>0){
					$returnStr['msg'] = 'User name already exists';	
				}else {
					$condition = array('email'=>$email);
					$duplicateMail = $this->user_model->get_all_details(USERS,$condition);
					if ($duplicateMail->num_rows()>0){
						$returnStr['msg'] = 'Email id already exists';	
					}else {
						
						$time = time();
						$aff = $username.$time;
						
						$dataArr = array('full_name'=>$fullname,'user_name'=>$username,'last_name'=>$lastname,'email'=>$email,'password'=>$pwd,'status'=>'Active','gender'=>$gender,'is_verified'=>'No','commision'=>$this->config->item('product_commission'),'affiliateId'=> $aff,'update_email'=>'Yes','notification_email'=>'follow,msg,like,lik_of_like,fav_shop');
						$this->user_model->simple_insert(USERS,$dataArr);
						
						$register_id = $this->db->insert_id();
						//print_r($register_id);
						
						
						//if(isset($affi) && $affi!=''){
						$this->user_model->increaseUserCredits($register_id,$username,$email);
						//}
/*						}
						$refererId = '';
						$affi = get_cookie('affiliateId');
						$refererId = base64_decode($affi);
						//$refererId = get_cookie('affiliateId');
						
						$result = $this->user_model->get_all_details(AFFILIATE,array());
						
						if($refererId !=''){
							$referer = $this->user_model->get_all_details(USERS,array('affiliateId'=>$refererId));
							$this->user_model->update_details(USERS,array('referId'=>$referer->row()->id),array('id'=>$register_id));
						
							if($result->num_rows > 0){
								if($result->row()->aff_status == 'Active'){
									$referArr = array();
									$referArr['dateAdded'] = date("Y-m-d H:i:s");
									$referArr['register_id'] = $register_id;
									$referArr['registered'] = $username;
									$referArr['registeredemail'] = $email;
									$referArr['referer_id'] = $referer->row()->id;
									$referArr['referer'] = $referer->row()->user_name;
									$referArr['referer_email'] = $referer->row()->email;
									$referArr['status'] = 'Pending';
									$referArr['credit'] =  $result->row()->aff_amount * $result->row()->aff_point;
									$this->user_model->simple_insert(AFFCOOKIE,$referArr);
								}
							}
						}
						
						if($result->num_rows > 0){
							$fbArray =array();
							if($result->row()->fb_discount == 'Active'){
								$fbArray['fb_purchase_count'] = $result->row()->purchase_count;
								$fbArray['fb_discounttype'] = $result->row()->fb_discounttype;
								$fbArray['fb_discountvalue'] = $result->row()->fb_discountvalue;
							}
							$this->user_model->update_details(USERS,$fbArray,array('id'=>$register_id));
						}
						
						if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != ""){
							$this->user_model->update_details(USERS,array('HttpReferer'=>$_SERVER['HTTP_REFERER']),array('id'=>$register_id));
						}
						
*/						
						try{
						include('./constantcontact_settings.php');
						if($config['constantcontact_status'] = 'Yes'){
							$con_var=include('./constantcontact/examples/addcontact.php');
						}
						}catch(Exception $e){
						}
					
						
						include('./zohocrm_settings.php');
						
						if($config['zoho_status'] = 'Yes'){
							$zoho_var=include('./zohocrm/zohocrmapi.php');
						}
						
						#echo $zoho_var;die;
						
						
					/*	if($this->session->userdata('referenceName') != '')
						{
							$this->session->unset_userdata('referenceName');
						} */
						
						
						
						include('./mailchimp_settings.php');
						
						if($config['mailchimp_status'] = 'Yes'){
							$mailchimp = 1;
							$mail_var=include('./mailchimp/mailchimpapi.php');
						}
						
						$checkUser = $this->user_model->get_all_details(USERS,array('email'=>$email));
						//$this->user_model->insertUserQuick($fullname,$username,$lastname,$email,$pwd,$brand);
						$this->session->set_userdata('quick_user_name',$email);
						$userdata = array(
								'shopsy_session_user_id' => $checkUser->row()->id,
								'shopsy_session_user_name' => $checkUser->row()->user_name,
								'shopsy_session_full_name' => $checkUser->row()->full_name,
								'shopsy_session_user_email' => $checkUser->row()->email,
								'shopsy_session_user_confirm' => $checkUser->row()->is_verified,
								'userType'=>$checkUser->row()->group
							);
						if($subscription=='on'){
							$this->subscribeUserRegister($checkUser->row()->email);
						}
						$this->session->set_userdata($userdata);
						$userDetails=$checkUser;
						$this->send_confirm_mail($userDetails);
						$returnStr['msg'] = 'Successfully registered';
						
						$returnStr['success'] = '1';
					}
				}
			}else {
				$returnStr['msg'] = "Invalid email id";
			}
		}
		if($this->lang->line('acc_registered')!='') { $acc_registered= stripslashes($this->lang->line('acc_registered')); } else $acc_registered ="Your account Registerd with ";
		$this->setErrorMessage('success',$acc_registered.$this->config->item('email_title'));
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * To subscribe the user register
	 * 
	 */
	public function subscribeUserRegister($email)
	{
			
			$checkUser = $this->user_model->get_all_details(SUBSCRIBERS_LIST,array('subscrip_mail'=>$email));
			
			if($checkUser->num_rows()==0){
				$condition = array('email'=>$email);
				
				$randStr = $this->get_rand_str('10');	
				$dataArr = array('subscrip_mail'=>$email,'active'=>0,'status'=>'Active','dateAdded'=>$createdTime,'verification_mail'=>$randStr); 
				$this->user_model->simple_insert(SUBSCRIBERS_LIST,$dataArr);
				$maxidd = $this->db->insert_id();
			}
	}
	
	/**
	 * 
	 * Login to the subscribe user
	 * 
	 */
	public function loginsubscribeUser(){
		if($this->checkLogin('U')!='')	{
			$email = $this->session->userdata['shopsy_session_user_email']; //exit;
			
			$checkUser = $this->user_model->get_all_details(SUBSCRIBERS_LIST,array('subscrip_mail'=>$email,'status' => 'Active'));
			
			if($checkUser->num_rows()==0){

				$condition = array('email'=>$email);
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time();
				$createdTime = mdate($datestring,$time);
				$randStr = $this->get_rand_str('10');
				
		
				$dataArr = array('subscrip_mail'=>$email,'active'=>0,'status'=>'Active','dateAdded'=>$createdTime,'verification_mail'=>$randStr); 
				$this->user_model->simple_insert(SUBSCRIBERS_LIST,$dataArr);
				$maxidd = $this->db->insert_id();
				
				$cfmurl = base_url().'site/user/confirm_register_subscribe/'.$maxidd.'/confirmation/'.$randStr;
				#$cfmurl = base_url().'site/user/confirm_register_subscribe/'.$maxidd."/";
				//$this->setErrorMessage('success','Thanks for subscribing newsletter !');
				//redirect(base_url());
				
				$newsid='16';
				$template_values=$this->user_model->get_newsletter_template_details($newsid);
				$subject = 'Newsletter Confirmation From : '.$this->config->item('email_title'); 
				$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
				extract($adminnewstemplateArr);
				$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
				
				$message .= '<!DOCTYPE HTML>
				<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<meta name="viewport" content="width=device-width"/><body>';
				include('./newsletter/registeration'.$newsid.'.php');	
				$message .= '</body>
				</html>';
				//$returnStr['msg'] = 'Successfully registered';
				//$returnStr['success'] = '1';
					#echo '<pre>'; print_r($template_values); die;
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
				$email_send_to_common = $this->user_model->common_email_send($email_values);
				
				$this->setErrorMessage('success','Thanks for subscribing newsletter !');
				//redirect(base_url());
				redirect('home');
			}
			else
			{
				$this->user_model->commonDelete(SUBSCRIBERS_LIST,array('subscrip_mail' => $email));
				$this->setErrorMessage('success','You have un subscribed newsletter!!!');
				//redirect(base_url());
				redirect('home');
			}
		}
	}
	
	/**
	 * 
	 * Landing page subscribition option
	 * 
	 */
	public function subscribeUser()
	{
		$email = $this->input->post('emaill');
		
		if(valid_email($email)){
			$sel_qry = $this->db->query("SELECT * FROM ".SUBSCRIBERS_LIST." WHERE subscrip_mail='$email'");
			
			if($sel_qry->num_rows()==0){
				$condition = array('email'=>$email);
				$datestring = "%Y-%m-%d %h:%i:%s"; 
				$time = time();
				$createdTime = mdate($datestring,$time); //exit;
				$randStr = $this->get_rand_str('10');
				
				$dataArr = array('subscrip_mail'=>$email,'active'=>0,'status'=>'Active','dateAdded'=>$createdTime,'verification_mail'=>$randStr); 
				$this->user_model->simple_insert(SUBSCRIBERS_LIST,$dataArr);
				$maxidd = $this->db->insert_id();
				
				$cfmurl = base_url().'site/user/confirm_register_subscribe/'.$maxidd.'/confirmation/'.$randStr;
				
				$newsid='16';
				$template_values=$this->user_model->get_newsletter_template_details($newsid);
				$subject = 'From: '.$this->config->item('email_title');
				$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
				extract($adminnewstemplateArr);
				$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
				
				$message .= '<!DOCTYPE HTML>
				<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<meta name="viewport" content="width=device-width"/><body>';
				include('./newsletter/registeration'.$newsid.'.php');	
				$message .= '</body>
				</html>';
				//$returnStr['msg'] = 'Successfully registered';
				//$returnStr['success'] = '1';
					
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
				$email_send_to_common = $this->user_model->common_email_send($email_values);
				
				$this->setErrorMessage('success','Thanks for subscribing newsletter !');
				redirect(base_url());
			}else{
				$this->setErrorMessage('error','Email Id Already Exists !');
				redirect(base_url());
			}
		}else{
			$returnStr['msg'] = "Invalid email id";
			$this->setErrorMessage('error','Invalid email id !');
			redirect(base_url());
		}	
	}
	
	/**
	 * 
	 * Subscribe the user events
	 * 
	 */
	public function subscribeUserEvent()
	{
		$email = $this->session->userdata('shopsy_session_user_email');
		
		if(valid_email($email)){
			$sel_qry = $this->db->query("SELECT * FROM ".SUBSCRIBERS_LIST." WHERE subscrip_mail='".$email."'");
			
			if($sel_qry->num_rows()==0){
				$condition = array('email'=>$email);
				$datestring = "%Y-%m-%d %h:%i:%s"; 
				$time = time();
				$createdTime = mdate($datestring,$time); //exit;
				$randStr = $this->get_rand_str('10');
				
				$dataArr = array('subscrip_mail'=>$email,'active'=>0,'status'=>'Active','dateAdded'=>$createdTime,'verification_mail'=>$randStr); 
				$this->user_model->simple_insert(SUBSCRIBERS_LIST,$dataArr);
				$maxidd = $this->db->insert_id();
				
				$cfmurl = base_url().'site/user/confirm_register_subscribe/'.$maxidd.'/confirmation/'.$randStr;
				
				$newsid='16';
				$template_values=$this->user_model->get_newsletter_template_details($newsid);
				$subject = 'From: '.$this->config->item('email_title');
				$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
				extract($adminnewstemplateArr);
				$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
				
				$message .= '<!DOCTYPE HTML>
				<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<meta name="viewport" content="width=device-width"/><body>';
				include('./newsletter/registeration'.$newsid.'.php');	
				$message .= '</body>
				</html>';
				//$returnStr['msg'] = 'Successfully registered';
				//$returnStr['success'] = '1';
					
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
				$email_send_to_common = $this->user_model->common_email_send($email_values);
				
				$this->setErrorMessage('success','Thanks for subscribing newsletter !');
				redirect(base_url());
			}else{
				//echo "asdf";die;
			 $email_exist=addslashes(af_lg('lg_email_exist','Email Id Already Exists '));
				//echo $email_exist;die;
				$this->setErrorMessage('error',$email_exist);
				redirect(base_url());
			}
		}else{
			$returnStr['msg'] = "Invalid email id";
			$this->setErrorMessage('error','Invalid email id !');
			redirect(base_url());
		}	
	}
	
	/**
	 * 
	 * Check the user email exists or not
	 * 
	 */
	public function emailExists($email='')
	{
		$condition = array('email'=>$this->input->post('email'));
		$duplicateName = $this->user_model->get_all_details(USERS,$condition);
		if ($duplicateName->num_rows()>0){
			//echo 'exist';
			$returnStr['msg']=0;
		}else{
			//echo 'new';
			$returnStr['msg']=1;
		}
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * Check the user availability
	 * 
	 */
	function check_user_availability()
    {
        $emaill = $this->input->post('emaill');
        //$existing_users=$this->user_model->get_all_usernames();
		$query = $this->db->query("SELECT * FROM ".SUBSCRIBERS_LIST." WHERE subscrip_mail='$emaill'");
        //$emaill= $emaill;

        /*if (in_array($emaill, $existing_users))
        {
            echo "no";
        } 
        else
        {
            echo "yes";
        }*/
		//if (valid_email('email@somesite.com'))
		//if($emaill!='')
		if($emaill!='')
		{
			if($query->num_rows()>0)
			{
				//return true;
				echo "no";
			}
			else
			{
				//return false;
				echo "yes";
			}
		}
	}
	
	/**
	 * 
	 * Verification mail processing in that function 
	 * 
	 */
	public function verify_user_email(){
		$this->data['heading'] = 'Verify'; 
		$this->load->view('site/user/verify_email.php',$this->data);
	}
	
	/**
	 * 
	 * Resend the confirmation mail to user
	 * 
	 */
	public function resend_confirm_mail(){
		$mail = $this->input->post('mail');
		if ($mail == ''){
			echo '0';
		}else {
			$condition = array('email'=>$mail);
			$userDetails = $this->user_model->get_all_details(USERS,$condition);
			$this->send_confirm_mail($userDetails);
			echo '1';
		}
	}
	
	/**
	 * 
	 * Resend the confirmation mail to user
	 * 
	 */
	public function send_email_confirmation(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') == ''){
			$returnStr['message'] = 'Login required';
		}else {
			$this->send_confirm_mail($this->data['userDetails']);
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * Resend the confirmation mail to user
	 * param String $userDetails
	 * 
	 */
	public function send_confirm_mail($userDetails=''){
	
		$uid = $userDetails->row()->id;
		$email = $userDetails->row()->email;
		$name = $userDetails->row()->full_name;
		
		$randStr = $this->get_rand_str('10');
		$condition = array('id'=>$uid);
		$dataArr = array('verify_code'=>$randStr);
		$this->user_model->update_details(USERS,$dataArr,$condition);
		$newsid='3';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);
		
		$cfmurl = base_url().'site/user/confirm_register/'.$uid."/".$randStr."/confirmation";
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'));
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
		#echo "<pre>"; print_r($email_values);				
		$email_send_to_common = $this->user_model->common_email_send($email_values);
	}
	
	/**
	 * 
	 * Signup form view page
	 * 
	 */
	public function signup_form(){

		if ($this->checkLogin('U') != ''){
			redirect('');
		}else {
			$this->data['next'] = $this->input->get('next');
			$this->data['heading'] = 'Sign in'; 
			$this->load->view('site/user/signup.php',$this->data);
		}
	}
	
	/**
	 * 
	 * Register form view page
	 * 
	 */
	public function register_form(){
		if ($this->checkLogin('U') != ''){
			redirect('');
		}else {
			$this->data['next'] = $this->input->get('next');
			$this->data['heading'] = 'Sign up'; 
			$this->db->select("id,name");
			$this->db->from("shopsy_country");
			$data_country=$this->db->get();
			$this->data["country_list"]=$data_country;
			$this->load->view('site/user/register.php',$this->data);
		}
	}
	
	/**
	 * 
	 * Loading login page
	 */
	public function login_form(){
		if ($this->checkLogin('U')!=''){
			redirect(base_url());
		}else {
			$this->data['next'] = $this->input->get('next');
			//echo $this->data['next'];die;
			
			
			
			$this->data['heading'] = 'Sign in'; 
			$this->load->view('site/user/signup.php',$this->data);
		}
	}
	
	/**
	 * 
	 * Check the login user and set the user session
	 * 
	 */
	public function login_user(){
	//die;
		$this->form_validation->set_rules('emailAddr', 'Email Address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$next = $this->input->post('next_url');	
		if ($this->form_validation->run() === FALSE)
		{
			$this->setErrorMessage('error','Email and password fields required');
			if($next!=''){
				redirect('login?action='.urlencode($next));
			}else {
				redirect('login');
			}
		} 
		else { 
			$email = $this->input->post('emailAddr');
			$pwd = md5($this->input->post('password'));
			$stay_signed_in=$this->input->post('stay_signed_in');
			//echo $stay_signed_in;die;
			//$condition = array('email'=>$email,'password'=>$pwd,'status'=>'Active');
			$condition = '(email = \''.addslashes($email).'\' OR user_name = \''.addslashes($email).'\') AND password=\''.$pwd.'\''; //checking for active or inactive
			$checkUser = $this->user_model->get_all_details(USERS,$condition);
			#echo $this->db->last_query(); 
			#echo '<pre>'; print_r($checkUser); die;
			if ($checkUser->num_rows() == 1){
				$condition = '(email = \''.addslashes($email).'\' OR user_name = \''.addslashes($email).'\') AND password=\''.$pwd.'\' AND status=\'Active\'';
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
					//echo $this->session->userdata('shopsy_session_user_id');die;
				
					//echo '<pre>'; print_r($next); die;
						if($stay_signed_in=="yes")
						{
							$CookieVal = array( 'name'   => 'Shopsy_NewUser','value'  => $this->session->userdata('shopsy_session_user_id'),'expire' => 3600*24*7);
							$this->input->set_cookie($CookieVal); 
						}
					$datestring = "%Y-%m-%d %h:%i:%s";
					$time = time();
					$newdata = array(
	               'last_login_date' => mdate($datestring,$time),
	               'last_login_ip' => $this->input->ip_address()
	    	        );
					
					$condition = array('id' => $checkUser->row()->id);
				   $this->user_model->update_details(USERS,$newdata,$condition);
				
			   	   $this->user_model->updategiftcard(GIFTCARDS_TEMP,$this->checkLogin('T'),$checkUser->row()->id);
				   $this->user_model->updateShopingCart(SHOPPING_CART,$this->checkLogin('T'),$checkUser->row()->id);
				   $this->user_model->updateUserShopingCart(USER_SHOPPING_CART,$this->checkLogin('T'),$checkUser->row()->id);
				   
				 		
				   if($this->checkLogin('U')!=''){
						$checkUserPreference=$this->product_model->get_all_details(USER,array('id' => $this->checkLogin('U')));
						
						if($this->session->userdata('currency_data')){	
								$this->session->unset_userdata('currency_data');
							}
						
						$condition = array('currency_code'=> $checkUserPreference->row()->currency);
						$result=$this->product_model->get_all_details(CURRENCY,$condition);
						$nCVal=array();
						foreach($result->row() as $cKey=>$cVal){
							$nCVal[$cKey]=base64_encode ($cVal);
						}
						$this->session->set_userdata('currency_data',$nCVal);
						
						//$this->session->set_userdata('currency_data',$result->row_array());
							if($this->session->userdata('region')){	
							$this->session->unset_userdata('region');
							}
						$result=$this->product_model->get_all_details(COUNTRY_LIST,array('country_code' => $checkUserPreference->row()->region));	
						$this->session->set_userdata('region',$result->row_array());
					}
				    if($this->lang->line('u_r_logged')!='') { $log_in = stripslashes($this->lang->line('u_r_logged')); } else $log_in ="You are Logged In!";
				   $this->setErrorMessage('success',$u_r_logged); 
				  //if($this->input->post("redirect")!=NULL){
					//redirect($this->input->post("redirect"));
				  //}
				  // $this->wploginUser($checkUser->row()->user_name);
				 // if($checkUser->row()->group =='Seller'){
						if($next!=''){
							redirect('wp_user_login.php?un='.$checkUser->row()->user_name.'&next='.$next);
						}else {
							redirect('wp_user_login.php?un='.$checkUser->row()->user_name.'&next='.base_url());
						}
					
					  
				  /*}else{
						if($next!=''){
							redirect(base_url().$next);
						}else {
							redirect('home');
						}
				  }*/
			    } else{		
                    $ur_ac_is_inactive=addslashes(af_lg('lg_ur_ac is inactive','Your Account Is In-Active'));				
					$this->setErrorMessage('error',$ur_ac_is_inactive);
					if($next!=''){
						redirect('login?action='.urlencode($next));
					}else {
						//echo "last".$this->input->post("redirect"); die();
						redirect('login');
					}
				
				  }
			
		}else {
		$invalid_login=addslashes(af_lg('lg_invalid_login_details','Invalid login details'));
				$this->setErrorMessage('error',$invalid_login);
				
				//$this->session->set_userdata('ErrTypeSess','TYPES');
				//$this->session->set_userdata('ErrMSGSess','MSGS');
				
				
			 
				
				
				//redirect('signup?next='.urlencode($next));
				
					if($next!=''){
						redirect('login?action='.urlencode($next));
					}else {
						redirect('login');
					}	
		}
	}
}
	

	/**
	 * 
	 * Load the after login page
	 * 
	 */
	public function after_login()
	{
		if ($this->checkLogin('U') == ''){
			redirect('');
		}else{
			
			
			redirect('');
			
/*			
			if($this->config->item('product_cost')==0)
				$condition = " where p.status='Publish' and p.pay_status='Paid' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.user_id=0 group by p.id order by p.product_featured desc limit 10";
			else	
				$condition = " where p.status='Publish' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.user_id=0 group by p.id order by p.product_featured desc limit 10";
			$products_list_s = $this->product_model->view_product_details($condition);
			#echo $this->db->last_query();die;
			
			#echo "<pre>";print_r($products_list_s->result());die;	
			$this->data['productDetails'] = $this->product_model->get_sorted_array($products_list_s,$products_list_u,'product_featured','desc');
			$bannerLists =	$this->data['bannerList'] = $this->product_model->get_all_details(BANNER_CATEGORY,array('status'=>'Publish'));
			
			#$this->data['featuredShopDetails'] =$featuredShopDetails= $this->product_model->get_order_by_details_Blog_post();
			
			$this->data['recentFavorites'] =$recentFavorites= $this->product_model->recentlyFavoritItems();
			
			#`echo $recentFavorites->num_rows();
			#$this->data['GiftCardList'] = $this->product_model->get_all_details(GIFTCARDS_SETTINGS,array('status'=>'Enabled'));
			
			//$condition=" where p.status='Publish' and u.group='Seller' and u.status='Active' and p.user_id=".$featuredShopDetails->row()->user_id." or p.status='Publish' and p.user_id=".$featuredShopDetails->row()->user_id." and a.pricing IS NOT NULL group by p.id order by p.created desc";
			#$this->data['featuredShopProducts'] = $this->product_model->view_product_details($condition);

			$this->data['recentBlogPosts'] = $this->product_model->getBlogDetails();
			#echo '<pre>'; print_r($this->data['recentFavorites']->result());die;
			$this->data['getAdminBlogDetails'] = $getAdminBlogDetails;
			$this->data['getBlogDetails'] = $getBlogDetails;
			$this->data['sellerDetails'] = $sellerDetails;
			$this->data['advertisingListSide'] = $this->product_model->get_all_details(ADVERTISING,array('status'=>'Publish' ,'advertising_area'=> 'side'),array(array('field' => 'id','type' => 'desc')));
			$this->data['advertisingListBottom'] = $this->product_model->get_all_details(ADVERTISING,array('status'=>'Publish' ,'advertising_area'=> 'bottom'),array(array('field' => 'id','type' => 'desc')));
			//$this->setErrorMessage('success','You have login successfully');
			$this->data['heading'] = $this->config->item('email_title').' - Your place to buy and sell all things handmade, vintage, and supplies';
			$this->load->view('site/landing/after_login',$this->data);
			
			
			*/
		}
		
	}
	
	/**
	 * 
	 * Login the user after signup automatically
	 * 
	 */
	public function login_after_signup($userDetails=''){
		
		if ($userDetails->num_rows() == 1){
			$userdata = array(
							'shopsy_session_user_id' => $userDetails->row()->id,
							'shopsy_session_user_name' => $userDetails->row()->user_name,
							'shopsy_session_full_name' => $userDetails->row()->full_name,
							'shopsy_session_user_email' => $userDetails->row()->email,
							'shopsy_session_user_confirm' => $userDetails->row()->is_verified
						);
			$this->session->unset_userdata($userdata);
			$this->session->set_userdata($userdata);	
			$CookieVal = array( 'name'   => 'Shopsy_NewUser','value'  =>$userDetails->row()->id,'expire' => time()+3600*24*365,'secure' => FALSE);
			$this->input->set_cookie($CookieVal); 
			
			
			$datestring = "%Y-%m-%d %h:%i:%s";
			$time = time();
			$newdata = array(
               'last_login_date' => mdate($datestring,$time),
               'last_login_ip' => $this->input->ip_address()
            );
            $condition = array('id' => $userDetails->row()->id);
			$this->user_model->update_details(USERS,$newdata,$condition);
			
			#$this->user_model->updategiftcard(GIFTCARDS_TEMP,$this->checkLogin('T'),$userDetails->row()->id);

		}else {
			redirect(base_url());
		}
	}
	
	/**
	 * 
	 * Check the verify the user mail id
	 * 
	 */
	public function confirm_register(){
		$uid = $this->uri->segment(4,0);
		$code = $this->uri->segment(5,0);
		$mode = $this->uri->segment(6,0);
		if($mode=='confirmation'){
			$condition = array('verify_code'=>$code,'id'=>$uid);
			$checkUser = $this->user_model->get_all_details(USERS,$condition);
			if ($checkUser->num_rows() == 1){
				$conditionArr = array('id'=>$uid,'verify_code'=>$code);
				$dataArr = array('is_verified'=>'Yes');
				$this->user_model->update_details(USERS,$dataArr,$condition);				
				$checkUser = $this->user_model->get_all_details(USERS,$condition);
				$this->setErrorMessage('success','Great going ! Your mail ID has been verified');
				$this->login_after_signup($checkUser);	
				redirect(base_url());
			}else {
				$this->setErrorMessage('error','Invalid confirmation link');
				redirect(base_url());
			}
		}else {
			$this->setErrorMessage('error','Invalid confirmation link');
			redirect(base_url());
		}
	}
	
	/**
	 * 
	 * Verify the user subscribe mail id
	 * 
	 */
	public function confirm_register_subscribe(){
		$uid = $this->uri->segment(4,0);
		//echo '<pre>';
		//print_r($uid);
		$code = $this->uri->segment(6,0);
		$mode = $this->uri->segment(5,0);
		if($mode=='confirmation'){
			$condition = array('verification_mail'=>$code,'id'=>$uid);
			$checkUser = $this->user_model->get_all_details(SUBSCRIBERS_LIST,$condition);
			if ($checkUser->num_rows() == 1){
				$conditionArr = array('id'=>$uid,'verification_mail'=>$code);
				$dataArr = array('active'=>'1');
				$this->user_model->update_details(SUBSCRIBERS_LIST,$dataArr,$condition);
				$this->setErrorMessage('success','Great going ! Your mail ID has been verified');
				//$this->login_after_signup($checkUser);
				if($this->checkLogin('U') != ''){
					redirect(base_url().'/home');
				} else {
					redirect(base_url());
				}
			} else {
				$this->setErrorMessage('error','Invalid confirmation link');
				if($this->checkLogin('U') != ''){
					redirect(base_url().'/home');
				} else {
					redirect(base_url());
				}
			}
		}else {
			$this->setErrorMessage('error','Invalid confirmation link');
			if($this->checkLogin('U') != ''){
					redirect(base_url().'/home');
			} else {
				redirect(base_url());
			}
		}
	}
	
	/*public function confirm_register_subscribe(){
		$uid = $this->uri->segment(4,0);
		$code = $this->uri->segment(5,0);
		$mode = $this->uri->segment(6,0);
		if($mode=='confirmation'){
			$condition = array('verification_mail'=>$code,'id'=>$id);
			$checkUser = $this->user_model->get_all_details(SUBSCRIBERS_LIST,$condition);
			if ($checkUser->num_rows() == 1){
				$conditionArr = array('id'=>$id,'verification_mail'=>$code);
				$dataArr = array('active'=>'1');
				//$this->user_model->update_details(USERS,$dataArr,$condition);
				$this->user_model->update_details(SUBSCRIBERS_LIST,$dataArr,$condition);
				$this->setErrorMessage('success','Great going ! Your mail ID has been verified');
				//$this->login_after_signup($checkUser);
				redirect(base_url());
			}else {
				$this->setErrorMessage('error','Invalid confirmation link');
				redirect(base_url());
			}
		}else {
			$this->setErrorMessage('error','Invalid confirmation link');
			redirect(base_url());
		}
	}*/
	
	/**
	 * 
	 * clear all the user session
	 * 
	 */
	public function logout_user(){
		//echo $this->input->cookie('Shopsy_NewUser');die;
		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = time();
		$newdata = array(
               'last_logout_date' => mdate($datestring,$time)
		);
		$condition = array('id' => $this->checkLogin('U'));
		$this->user_model->update_details(USERS,$newdata,$condition);
		$userdata = array(
						'shopsy_session_user_id'=>'',
						'shopsy_session_user_name'=>'',
						'shopsy_session_full_name'=>'',
						'shopsy_session_user_email'=>'',
						'shopsy_session_temp_id'=>'',
						'FBlogout'=>''
					);
		$_SESSION['email']='';
		$_SESSION['first_name']='';
		$_SESSION['last_name']='';
		$_SESSION['FBlogout']='';			
		unset($_SESSION['email']);
		unset($_SESSION['first_name']);
		unset($_SESSION['last_name']);
		unset($_SESSION['FBlogout']);			
		
		$this->session->unset_userdata($userdata);
		$this->session->unset_userdata('currency_data');
		$this->session->unset_userdata('language_code');
		$this->session->unset_userdata('region');
		
		
		@session_start();
		unset($_SESSION['token']);
		$twitter_return_values = array('tw_status'=>'',
										'tw_access_token'=>''
										);
		
		$this->session->unset_userdata($twitter_return_values);
		delete_cookie("Shopsy_NewUser");
		$this->setErrorMessage('success','Successfully logout from your account');
		redirect('wp_user_logout.php');
		//redirect(base_url());
	}
	
	/**
	 * 
	 * Forgot password view page
	 * 
	 */
	public function forgot_password_form(){
		$this->data['heading'] = $this->config->item('email_title').' - Forgot Password';
		
		
		$this->load->view('site/user/forgot_password.php',$this->data);
	}
	
	/**
	 * 
	 * View the reopen account page
	 * 
	 */
	public function reopen_account(){		
		$this->data['heading'] = $this->config->item('email_title').' - Reopen Your Account'; 
		$this->load->view('site/user/reopen_account.php',$this->data);
	} 
	
	/**
	 * 
	 * Check the forgot password and update the new password
	 * 
	 */
	public function forgot_password_user(){
	
		$this->form_validation->set_rules('emailids', 'Email Address', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->setErrorMessage('error','Email address required');
			redirect('forgot-password');
		}else {
			$email = $this->input->post('emailids');
			if (valid_email($email)){
				$condition = array('email'=>$email);
				$checkUser = $this->user_model->get_all_details(USERS,$condition);
				if ($checkUser->num_rows() == '1'){
					$pwd = $this->get_rand_str('6');
					$newdata = array('password' => md5($pwd));
					$condition = array('email' => $email);
					if($checkUser->row()->id==1){
						$this->setErrorMessage('error','Hi,'.$checkUser->row()->user_name.' You couldn\'t retrieve your password from here.');
						redirect('login');
					}
					//$this->user_model->update_details(USERS,$newdata,$condition);
					$reset_code=time();
					$this->user_model->update_details(USERS,array('resetcode'=>$reset_code,'resettime'=>date('Y-m-d h:i:s'),'resetstatus'=>'0'),array('email' => $email));
					$id=$checkUser->row()->id;
					$this->send_user_password($pwd,$checkUser,$reset_code,$id);
					$new_password=addslashes(af_lg('lg_new_password send tour mail','New password sent to your mail'));
					$this->setErrorMessage('success',$new_password);
					redirect('wp_update_user.php?un='.$checkUser->row()->user_name.'&pw='.$pwd.'&pg=2');
					//redirect('signup');
					//redirect('login');
				}else {
				$not_match=addslashes(af_lg('lg_email mismatch','Your email id not matched in our records'));
					$this->setErrorMessage('error',$not_match);
					redirect('forgot-password');
				}
			}else {
			$not_valid=addslashes(af_lg('lg_email_not_valid','Email id not valid'));
				$this->setErrorMessage('error',$not_valid);
				redirect('forgot-password');
			}
		}
	}
	
	
	/**
	 * 
	 * user change password page
	 * 
	 */
	public function change_password(){
		/* echo "<pre>";
		print_r($this->session->userdata);
		print_r($this->input->post());
	die; */
		$this->form_validation->set_rules('pass_email', 'Email Address', 'required');
		$this->form_validation->set_rules('pass_password','Password', 'required');
		$this->form_validation->set_rules('pass_confirm_password', 'Confirm Password', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->setErrorMessage('error','Enter valid information for required fields');
			redirect('settings/my-account/'.$this->session->userdata['shopsy_session_user_name']);
		}else {
			$email = $this->input->post('pass_email');
			$password = $this->input->post('pass_password');
			if($email == $this->session->userdata('shopsy_session_user_name') || $email ==$this->session->userdata('shopsy_session_user_email') ){
				if (!in_array($this->session->userdata('shopsy_session_user_name'),$this->config->item('demo_user_arr'))){
								$newdata = array('password' => md5($password));
					$condition = 'email = \''.$email.'\' OR user_name = \''.$email.'\'';
					$this->user_model->update_details(USERS,$newdata,$condition);
	
					if($this->db->affected_rows()>0){
							$this->setErrorMessage('success','Password changed successfully');
							redirect('wp_update_user.php?un='.$this->session->userdata['shopsy_session_user_name'].'&pw='.$password.'&pg=1');
							//redirect('settings/my-account/'.$this->session->userdata['shopsy_session_user_name']);
					}else {
						$this->setErrorMessage('error','Your new password must be different from your previous password');
						redirect('settings/my-account/'.$this->session->userdata['shopsy_session_user_name']);
					}
				}else{
					$this->setErrorMessage('error','Password cannot be changed for demo account');
					redirect('settings/my-account/'.$this->session->userdata['shopsy_session_user_name']);
				}
				
			}
			else{
				$this->setErrorMessage('error','Please Enter The Correct User Name/Email');
				redirect('settings/my-account/'.$this->session->userdata['shopsy_session_user_name']);
			}
		}
	}
	
	/**
	 * 
	 * Change the user First and Last name
	 * 
	 */

	function change_name($pops='')
	{
		if ($this->checkLogin('U') == ''){
				$this->setErrorMessage('error','Login require');
				redirect(base_url());
			}
		else
		{
			$first_name=$this->input->post("new-first-name");
			$last_name=$this->input->post("new-last-name");	
			$newdata = array('full_name' => $first_name,'last_name'=>$last_name);
			$condition = array('id'=>$this->checkLogin('U'));
			$this->user_model->update_details(USERS,$newdata,$condition);	
			$this->session->set_userdata('shopsy_session_full_name',$first_name);
			if($pops==""){
				redirect('public-profile');
			}
		}
	}


	
	/**
	 * 
	 * Change the user email ID 
	 * 
	 */
	public function change_email_older($oldEmailId=''){
		
		
		$newsid='12';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);
		$userName=$this->session->userdata['shopsy_session_user_name'];
		$oldMailID=$oldEmailId;
		
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'));
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
		$email=$this->session->userdata['shopsy_session_user_email'];
		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$oldMailID,
							'subject_message'=>$template_values['news_subject'],
							'body_messages'=>$message
							);
		$email_send_to_common = $this->user_model->common_email_send($email_values);
	}
	
	/**
	 * 
	 * Change the user email ID confirmation mail
	 * 
	 */
	public function change_email_confirm(){
		
	$this->form_validation->set_rules('email_email', 'Email Address', 'required');
		$this->form_validation->set_rules('email_confirm_email', 'Confirm Email Address', 'required');
		$this->form_validation->set_rules('email_password', 'Password', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->setErrorMessage('error','Enter valid information for required fields');
			redirect('settings/my-account/'.$this->session->userdata['shopsy_session_user_name']);
		}else {
	$new_email=$this->input->post('email_email');
	$password=$this->input->post('email_password');
	$uid=$this->session->userdata['shopsy_session_user_id'];
	$email=$this->session->userdata['shopsy_session_user_email'];
	$userName=$this->session->userdata['shopsy_session_user_name'];
	$condition = array('password'=>md5($password),'email'=>$email);
	$checkUser = $this->user_model->get_all_details(USERS,$condition);
	//print_r($condition);
	//echo $checkUser->num_rows();die;
			if ($checkUser->num_rows() == '0'){
				$this->setErrorMessage('error','Invalid Password');
				redirect('settings/my-account/'.$this->session->userdata['shopsy_session_user_name']);	
			}
			  $this->change_email_older($email);
	//$encode_uid=base64_encode($uid);
	#$encode_email=base64_encode($new_email);
	//echo $uid."<br>".$encode_email;die;
	$encode_email=urlencode($new_email);
	//echo "<pre>";print_r($this->session->all_userdata());die;
		//$uid = $userDetails->row()->id;
		//$email = $userDetails->row()->email;
		$randStr = $this->get_rand_str('10');
		$condition = array('id'=>$uid);
		$dataArr = array('verify_code'=>$randStr);
		$this->user_model->update_details(USERS,$dataArr,$condition);
		$newsid='13';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);
		
		$cfmurl = base_url().'site/user/confirm_change_email/'.$uid."/".$encode_email."/".$randStr."/confirmation";
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'));
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
							'to_mail_id'=>$new_email,
							'subject_message'=>$template_values['news_subject'],
							'body_messages'=>$message
							);
		$email_send_to_common = $this->user_model->common_email_send($email_values);
		$this->setErrorMessage('success','Confirm email has sent to your email id');
		redirect('settings/my-account/'.$this->session->userdata['shopsy_session_user_name']);
	
	}

	}
	
	/**
	 * 
	 * Change the user email ID confirmation confirmed email id to be changed
	 * 
	 */
	public function confirm_change_email(){
		$cfmurl = base_url().'site/user/confirm_change_email/'.$uid."/".$encode_email."/".$randStr."/confirmation";
		$uid = $this->uri->segment(4,0);
		$email =urldecode($this->uri->segment(5,0));
		$randStr = $this->uri->segment(6,0);
		$mode = $this->uri->segment(7,0);
		if($mode=='confirmation'){
			$condition = array('id'=>$uid,'status'=>'Active');
			$checkUser = $this->user_model->get_all_details(USERS,$condition);
			if ($checkUser->num_rows() == 1){
				$conditionArr = array('id'=>$uid);
				$dataArr = array('email'=>$email,'is_verified'=>'Yes');
				$this->user_model->update_details(USERS,$dataArr,$condition);
				$this->setErrorMessage('success','Great going ! Your Account is Changed successfully.');
				//$this->login_after_signup($checkUser);
				redirect('wp_update_user.php?un='.$checkUser->row()->user_name.'&em='.$email.'&pg=1');
				redirect(base_url());
			}else {
				$this->setErrorMessage('error','Invalid confirmation link');
				redirect(base_url());
			}
		}else {
			$this->setErrorMessage('error','Invalid confirmation link');
			redirect(base_url());
		}
	}

	/**
	 * 
	 * Reopen the account user
	 * 
	 */
	public function reopen_account_user(){
		
		$this->form_validation->set_rules('emailid', 'Email Address', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->setErrorMessage('error','Email address required');
			redirect('reopen-account');
		}else {
			$email = $this->input->post('emailid');
			if (valid_email($email)){
				$condition = array('email'=>$email);
				$checkUser = $this->user_model->get_all_details(USERS,$condition);
				$row=$checkUser->result_array(); 
				if($row[0]['status']=='Active')
				{
				$ur_account=addslashes(af_lg('lg_ur_ac_already_activated','Your account already activated'));
				$this->setErrorMessage('success',$ur_account);
				//redirect('signup');
				redirect('');
				}elseif ($checkUser->num_rows() == '1'){
					$this->send_reopen_account($checkUser);
					$acc_activate=addslashes(af_lg('lg_ur ac willbe activated soon','your account will be activated soon'));
					#$uid = $row[0]['id'];
					#$email = $row[0]['email'];					
					$this->setErrorMessage('success',$acc_activate);
					redirect('reopen-account');
				}else {
				$lg_notmatch=addslashes(af_lg('lg_email mismatch','Your email id not matched in our records'));

					$this->setErrorMessage('error',$lg_notmatch);
					redirect('reopen-account');
				}
			}else {
		$lg_invalid_email=addslashes(af_lg('lg_email_not_valid','Email id not valid'));
				$this->setErrorMessage('error',$lg_invalid_email);
				redirect('reopen-account');
			}
		}
	}
	
	/**
	 * 
	 * Confirmation the reopen account 
	 * 
	 */
	public function confirm_reopen(){
		$uid = $this->uri->segment(4,0);
		
		$secret_key = "myReopoNOccountSEcKytcoDeKeyvaLs";				
		$url_decodedArr =@explode('<-i*i->',urldecode($uid));  
		$decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $secret_key, $url_decodedArr[0], MCRYPT_MODE_CBC, $url_decodedArr[1]);		  			
		$uid=$decrypted_string; 
		
		$mode = $this->uri->segment(5,0);
		if($mode=='reopen'){
			$condition = array('id'=>$uid,'status'=>'Inactive');
			$checkUser = $this->user_model->get_all_details(USERS,$condition);
			if ($checkUser->num_rows() == 1){
				$conditionArr = array('id'=>$uid);
				$dataArr = array('status'=>'Active');
				$this->user_model->update_details(USERS,$dataArr,$condition);
				$this->user_model->update_details(SELLER,array('status' => 'active'),array('seller_id'=>$uid));
				$this->setErrorMessage('success','Great going ! Your Account is reopened successfully.');
				$this->login_after_signup($checkUser);
				#echo $this->session->userdata['shopsy_session_user_id']; die;	
				redirect(base_url());
			}else {
				$this->setErrorMessage('error','Invalid reopened link');
				redirect(base_url());
			}
		}else {
			$this->setErrorMessage('error','Invalid reopened link');
			redirect(base_url());
		}
	}
	
	/**
	 * 
	 * Send the reopen account request
	 * 
	 */
	public function send_reopen_account($query){

			$row=$query->result_array(); 
			#echo "<pre>"; print_r($row); 
			$userName = $row[0]['user_name']; 
			$uid = $row[0]['id']; 
			$User_EmailAddress = $row[0]['email']; 
		
		
		$secret_key = "myReopoNOccountSEcKytcoDeKeyvaLs";
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB), MCRYPT_RAND);
		$encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $secret_key, $uid, MCRYPT_MODE_CBC, $iv);
		$url_encoded_id=urlencode($encrypted_string.'<-i*i->'.$iv);
		$uid = $url_encoded_id; 
		/* echo $url_encoded_id;
		die; */
		$newsid='14';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);
		
		$cfmurl = base_url().'site/user/confirm_reopen/'.$uid."/reopen";  #echo $cfmurl; die;
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'));
		extract($adminnewstemplateArr);
				
		
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
  		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title>
			<body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		
		$message .= '</body>
			</html>';
			

		if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->config->item('site_contact_mail');
			
			$sender_name=$this->config->item('email_title');
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}
		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$query->row()->email,
							'subject_message'=>'Request for reopen account',
							'body_messages'=>$message
							);
#echo "<pre>"; print_r($email_values); die;
		$email_send_to_common = $this->product_model->common_email_send($email_values);
		

	//echo $this->email->print_debugger();die;
	
	}
	
	/**
	 * 
	 * Send the user password to user mail id
	 * 
	 */
	public function send_user_password($pwd='',$query,$code,$id){
	
		$newsid='5';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);

		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
		extract($adminnewstemplateArr);
		$pwdlnk=base_url().'resetPassword/'.$code.'/'.$id.''; 
		
		//$cfmurl = base_url().'site/user/confirm_change_email/'.$uid."/".$encode_email."/".$randStr."/confirmation";
		
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
  		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title>
			<body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		
		$message .= '</body>
			</html>';
			

		if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->config->item('site_contact_mail');
			
			$sender_name=$this->config->item('email_title');
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}
		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$query->row()->email,
							'subject_message'=>'Password Reset',
							'body_messages'=>$message
							);
							
		//echo '<pre>'; print_r($email_values); die;

		$email_send_to_common = $this->user_model->common_email_send($email_values);
		//echo '<pre>'; print_r($email_send_to_common); die;

	//echo $this->email->print_debugger();die;
	
	}

	/**
	 * 
	 * My account settings
	 * 
	 */
	public function display_user_profile(){
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect(base_url());
		}
	
		$username =  urldecode($this->uri->segment(3,0));
		if ($username == 'administrator'){
			$this->data['heading'] = $username;
			$this->load->view('site/user/display_admin_profile');
		}else {
			$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username,'status'=>'Active'));
			if ($userProfileDetails->num_rows()==1){ 
				if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
					$this->load->view('site/user/display_user_profile_private',$this->data);
				}else {
					
					$this->data['productLikeDetails'] = $this->user_model->get_like_details_fully($userProfileDetails->row()->id);
					$this->data['userProductLikeDetails'] = $this->user_model->get_like_details_fully_user_products($userProfileDetails->row()->id);
					$this->data['userProfileDetails'] = $userProfileDetails;
					$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
					$this->data['featureProductDetails'] = $this->product_model->get_featured_details($userProfileDetails->row()->feature_product);
					$this->data['heading'] = $this->config->item('email_title').' - '.$username.' Account Settings';
					$this->load->view('site/user/account_settings',$this->data);
				}
			}else {
				
				$this->setErrorMessage('error','User details not available');
				redirect(base_url());
			}
		}
	}
	
	

	/**
	 * 
	 * Load the public profile page 
	 * 
	 */
	function public_profile()
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',	$lg_login);
				redirect(base_url());
		}
		$this->db->select("id,name");
		$this->db->from(COUNTRY_LIST);
		$this->db->order_by("name","asc");
		$this->data['data_country']=$this->db->get();
		//echo $this->db->last_query(); 
		//echo '<pre>'; print_r($this->data['data_country']);die;
		
		$this->data['PublicProfile'] = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U'),'status'=>'Active'));
		$this->data['heading'] = $this->config->item('email_title').' - Public Profile';
		$this->load->view("site/user/public_profile",$this->data);
		
	}
	
	
	/**
	 *
	 * Load the public profile page
	 *
	 */
	function affiliate_clicks()
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
			redirect(base_url());
		}
		
		$from = $_GET['from'];
		$to = $_GET['to'];
		
		//$this->data['affiliates'] = $this->user_model->get_all_details(AFFCOOKIE,array('status'=>'Approved','referer_id'=>$this->checkLogin('U')));
		
		if(isset($from) && isset($to)){
				$this->data['affiliates'] = $this->user_model->ExecuteQuery("SELECT *,(SELECT SUM(credit) FROM ".AFFCOOKIE." where `status`='Approved' and `referer_id`= '".$this->checkLogin('U')."' ) as creditsum FROM ".AFFCOOKIE." WHERE `referer_id`= '".$this->checkLogin('U')."' and `status`='Approved' and `dateAdded` >= '".$from."' and `dateAdded` <= '".$to."' ");
		}else{
				//$this->data['affiliates'] = $this->user_model->ExecuteQuery("select *,SUM(credit) as creditsum from ".AFFCOOKIE." where `status`='Approved' and  `referer_id`= '".$this->checkLogin('U')."' ");
				
				$this->data['affiliates'] = $this->user_model->ExecuteQuery("select *,(SELECT SUM(credit) FROM ".AFFCOOKIE." where `status`='Approved' and `referer_id`= '".$this->checkLogin('U')."' ) as creditsum from ".AFFCOOKIE." where `status`='Approved' and `referer_id`= '".$this->checkLogin('U')."' group by `register_id` ORDER BY `dateAdded` DESC");

		}
		
// 		echo "<pre>";
//  		echo $this->db->last_query();
//  		print_r($this->data['affiliates']); die;
		
		$this->data['heading'] = 'Affiliates';
		$this->load->view("site/user/affiliate_clicks",$this->data);
	
	}
	
	
	
	/**
	 * 
	 * Update the public profile page
	 * 
	 */
	public function update_public_profile(){
		//echo "hello";
		//print_r($_POST);
		//print_r($_FILES);
		
		if ($this->checkLogin('U')==''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
			redirect(base_url());
		}
			 $gender=addslashes(trim($this->input->post('gender')));
			 $city=addslashes(strip_tags(trim($this->input->post('city'))));
			 $country=addslashes(strip_tags(trim($this->input->post('country'))));
			 $birth=addslashes(trim($this->input->post('month')))."-".addslashes(trim($this->input->post('day')));
			 $about=addslashes(strip_tags(trim($this->input->post('about'))));
			 $favorite_materials=addslashes(strip_tags(trim($this->input->post('favorite_materials'))));
			 
			 $include_profile=implode(',',$this->input->post('include_profile'));
			 
			if($_FILES['profile_pict']['name']!="")
			{
			$config['overwrite'] = FALSE;
	    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
	    	$config['upload_path'] = 'images/users';
		    $this->load->library('upload', $config);
			 if ($this->upload->do_upload('profile_pict')){
		   		$logoDetails = $this->upload->data(); 
		    	$this->ImageResizeWithCrop(600, 600, $logoDetails['file_name'], './images/users/');
				@copy('./images/users/'.$logoDetails['file_name'], './images/users/thumb/'.$logoDetails['file_name']);
		    	$this->ImageResizeWithCrop(210, 210, $logoDetails['file_name'], './images/users/thumb/');
			 	$profile_image=$logoDetails['file_name'];
				//echo $profile_image;die;
				 $dataArr=array('city'=>$city,'country'=>$country,'gender'=>$gender,'birthday'=>$birth,'about'=>strip_tags($about),'favorite_materials'=>strip_tags($favorite_materials),'include_profile'=>$include_profile,'thumbnail'=>$logoDetails['file_name']);
			 }
			 else
			 {
				$this->setErrorMessage('error',"There was a problem with your image");
			 	 redirect("public-profile");
			 }
			}
			else
			{
			 $dataArr=array('city'=>$city,'country'=>$country,'gender'=>$gender,'birthday'=>$birth,'about'=>strip_tags($about),'favorite_materials'=>strip_tags($favorite_materials),'include_profile'=>$include_profile);
			}
			
			
			// echo "<pre>";print_r($dataArr);die;
			$this->user_model->update_details(USERS,$dataArr,array('id'=>$this->checkLogin('U')));
			if($this->db->affected_rows()>0)
			{
			$profile_update=addslashes(af_lg('lg_ur_profile_updated','Your profile successfully updated'));
			$this->setErrorMessage('success',$profile_update);
			 	 redirect("public-profile");	
			}
			else{
			 $no_updation=addslashes(af_lg('lg_noupdation','No updation on your profile'));
			$this->setErrorMessage('success', $no_updation);
		 	redirect("public-profile");
			}
	}

	/**
	 * 
	 * Load the prototypes
	 * 
	 */
	function prototypes()
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect(base_url());
		}
		$this->data['heading'] = $this->config->item('email_title').' - Protypes';
		$this->load->view("site/user/prototypes");
		
	}

	/**
	 * 
	 * Load the view people page
	 * 
	 */
	function view_people()
	{
		$username =  urldecode($this->uri->segment(2,0));
		$this->data['viewprofile'] = $this->user_model->get_all_details(USERS,array('user_name'=>$username,'status'=>'Active'));
		if($this->data['viewprofile']->num_rows()==0){
			show_404();
		}
		$username =  urldecode($this->uri->segment(2,0));
		$this->data['userProfileDetails']= $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		$userProfileDetails=$this->data['viewprofile']->result_array();
		//echo '<pre>'; print_r($userProfileDetails); die;
		if($this->checkLogin('U')!=""){
			$activity_id=$userProfileDetails[0]['id'];
			$this->product_model->ExecuteQuery("UPDATE ".NOTIFICATIONS." SET `view_mode` = 'No' WHERE user_id=".$activity_id." AND (activity='favorite shop' OR activity='unfavorite shop' OR activity='follow' OR activity='unfollow')");
		}
		$include_profile=@explode(',',$userProfileDetails[0]['include_profile']);
		
		if(in_array('Shop',$include_profile)){
			/*Get the shop own shop products*/
			$this->data['ownShop'] = $this->product_model->get_all_details(SELLER,array('seller_id' => $userProfileDetails[0]['id']))->result_array();
			$this->data['ownProduct'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $userProfileDetails[0]['id'],'status'=>"Publish",'pay_status'=>"Paid"))->result_array();
			//echo $this->db->last_query(); die;
		}
		if(in_array('Teams',$include_profile)){
			/*Get the teams list*/			
			$userId=$userProfileDetails[0]['id'];
			if($userId!=''){
				$this->load->model('community_model');
				$condition=array(TEAMS.'.teamCaptainId !='=>$userId);
				$condition1=array(TEAMS.'.teamCaptainId '=>$userId);
				$this->db->limit(3);
				$UserteamsList=$this->community_model->get_all_Teams($condition1);
				$this->data['ownTeamList'] = $UserteamsList->result_array();
			}
			#echo '<pre>'; print_r($UserteamsList); die;
		}
		
		if(in_array('Favorite_items',$include_profile)){
			/*Get the favorite items details*/
			$this->data['userFavoriteItems']=$userFavoriteItems = $this->product_model->getFavoriteProduct($userProfileDetails[0]['id'])->result_array();
			/*Get the List items details*/
			$this->data['userListDetails']=$userListDetails = $this->user_model->get_all_details(LISTS_DETAILS,array('user_id'=>$userProfileDetails[0]['id']))->result_array();
		} 
		if(in_array('Favorite_shops',$include_profile)){
			/*Get the favorite shop details*/
			$this->data['userFavoriteShops']=$userFavoriteShops = $this->product_model->getFavoriteShops($userProfileDetails[0]['id'])->result_array();
			$userFavoriteShopsProducts=array();
			foreach($userFavoriteShops as $shops){
				$condition="p.user_id=".$shops['seller_id']." GROUP BY a.product_id";
				$products=$this->product_model->get_product_from_favorite_shop($condition)->result_array();
				$userFavoriteShopsProducts[$shops['seller_id']]=$products; #array_merge($userFavoriteShopsProducts,$products);	
			}
			$this->data['userFavoriteShopsProducts']=$userFavoriteShopsProducts ;
		}
		//echo "<pre>"; print_r($userListDetails); die;
		$this->data['heading'] = $this->config->item('email_title').' - Profile';
		$this->load->view("site/user/view_profile",$this->data);	
	}
	/**
	 * 
	 * Load Purchase and Review
	 * 
	 */
	
	
	
	
	
	function purchase_review($pType='')
	{

		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect(base_url());
		}	
		$this->data['purchasestatus']='';			
		$this->data['PublicProfile'] = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U'),'status'=>'Active'));
		$this->data['userPurchase']= $userPurchase=$this->user_model->get_user_purchase_list($this->checkLogin('U'),'',"Paid");
		
		//echo "<pre>"; print_r($this->data['userPurchase']->result()); die;
		
		if($this->input->get('query')!=''){
			$this->data['userPurchase']= $userPurchase=$this->user_model->get_user_purchase_list($this->checkLogin('U'),$this->input->get('query'));
		}		
		if($pType!=''){
			if($pType=='processing'){
				$condition='Not received yet';
				$this->data['userPurchase']= $userPurchase=$this->user_model->get_user_purchase_list($this->checkLogin('U'),'',$condition);
			}else if($pType=='received'){
				$condition='Product received';
				$this->data['userPurchase']= $userPurchase=$this->user_model->get_user_purchase_list($this->checkLogin('U'),'',$condition);
			}else if($pType=='cancelled'){
				$condition='Pending';
				$this->data['userPurchase']= $userPurchase=$this->user_model->get_user_purchase_Clist($this->checkLogin('U'),'',$condition);
				#echo $this->db->last_query();die;
			}
			#echo "<pre>";print_r($this->data['userPurchase']);die;
			//$this->data['userPurchase']= $userPurchase=$this->user_model->get_user_purchase_list($this->checkLogin('U'),'',$condition);
			$this->data['purchasestatus']='Cancelled';
		}
		//********* Cash on Delivery Checking ****************	
		if($pType=="cod"){ 
			$condition='COD';
			$this->data['userPurchase']= $userPurchase=$this->user_model->get_user_purchase_list1($this->checkLogin('U'),'',$condition);
			$this->data['purchasestatus']='Cash on Delivery';
			//$this->load->view("site/user/purchase_review",$this->data);
		}
			
			//********* Cash on Delivery Checking ends ****************	
			//********wire transfer checks starts****************
		if($pType=="wiretransfer"){ 
			$condition='wire_transfer';
			$this->data['userPurchase']= $userPurchase=$this->user_model->get_user_purchase_list1($this->checkLogin('U'),'',$condition);
			$this->data['purchasestatus']='Wire Transfer';
		}
		
	      //********wire transfer checks ends****************//
		if($pType=="westernunion"){ 
			$condition='western_union';
			$this->data['userPurchase']= $userPurchase=$this->user_model->get_user_purchase_list1($this->checkLogin('U'),'',$condition);
			$this->data['purchasestatus']='Western Union';
		}
		//$this->data['purchaseProducts']= $purchaseProducts=$userPurchase->result();	
		$purchaseProducts=$userPurchase->result();	
		 
		
		foreach($purchaseProducts as $key => $pro){
			$review = $this->user_model->get_all_details(PRODUCT_FEEDBACK,array('voter_id'=>$pro->user_id,'seller_product_id'=>$pro->product_id,'deal_code'=>$pro->dealCodeNumber))->row('rating');
			if(empty($review)){
				$review = '';
			}
			//echo "<pre>"; print_r($review);
			$purchaseProducts[$key]->starrating = $review ;
			
			$seourl = $this->user_model->get_all_details(PRODUCT,array('id'=>$pro->product_id))->row('seourl');
			if(empty($seourl)){
				$seourl = '';
			}
			$purchaseProducts[$key]->productSeourl = $seourl ;
			
		}
		
		//echo "<pre>"; print_r($purchaseProducts); die;
		
		$this->data['purchaseProducts']= $purchaseProducts;
		
		$this->data['heading'] = $this->config->item('email_title').' - Purchases and Review';
		$this->load->view("site/user/purchase_review",$this->data);
		
	}

	/**
	 * 
	 * Load Account preferences
	 * 
	 */
	function account_preferences()
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect(base_url());
		}
		//$data['PublicProfile'] = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U'),'status'=>'Active'));
		//$this->load->view("site/user/preferences",$this->data);
		
	}
	
	/**
	 * 
	 * Load Account privacy
	 * 
	 */
	function account_privacy()
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect(base_url());
		}
		//$data['PublicProfile'] = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U'),'status'=>'Active'));
		$this->data['heading'] = $this->config->item('email_title').' - Privacy';
		$this->load->view("site/user/privacy",$this->data);
	
	}
	
	/**
	 * 
	 * Load Account security
	 * 
	 */
	function account_security()
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect(base_url());
		}
		//$data['PublicProfile'] = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U'),'status'=>'Active'));
		$this->data['heading'] = $this->config->item('email_title').' - Public Security';
		$this->load->view("site/user/security",$this->data);
	
	}
	
	/**
	 * 
	 * Load Account Shipping
	 * 
	 */
	function account_shipping_address()
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect(base_url());
		}
		$this->data['shipping_address']=$this->user_model->get_all_details(SHIPPING_ADDRESS,array('user_id'=>$this->checkLogin('U')))->result_array();
		$this->data['country']=$this->user_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')))->result_array();
		//echo $this->db->last_query();
		//echo "<pre>";print_r($data['country']->result_array());die;
		$this->data['heading'] = $this->config->item('email_title').' - Shipping Address';
		$this->load->view("site/user/shipping_address",$this->data);
	
	}
	
	/**
	 * 
	 * Add Account Shipping Address
	 * 
	 */
	function add_shipping_address()
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect(base_url());
		}
		$country=trim(addslashes($this->input->post("country")));
		$full_name=trim(addslashes($this->input->post("full_name")));
		$address1=trim(addslashes($this->input->post("address1")));
		$address2=trim(addslashes($this->input->post("address2")));
		$city=trim(addslashes($this->input->post("city")));
		$state=trim(addslashes($this->input->post("state")));
		$postal_code=trim(addslashes($this->input->post("postal_code")));
		$phone=trim(addslashes($this->input->post("phone")));
		
		if($full_name!="" && $address1!="" && $city!="" && $state!="" && $postal_code!="" && $phone!="")
		{
			
			$dataArr=array('user_id'=>$this->checkLogin('U'),'full_name'=>$full_name,'address1'=>$address1,'address2'=>$address2,'city'=>$city,'state'=>$state,'country'=>$country,'postal_code'=>$postal_code,'phone'=>$phone);
			$result=$this->user_model->get_all_details(SHIPPING_ADDRESS,$dataArr);
			if($result->num_rows()>0)
			{
				$this->setErrorMessage('error','This address already exist');
				redirect('settings/account-shipping-address');
				
			}
			
			$dataArr=array('user_id'=>$this->checkLogin('U'));
			$result=$this->user_model->commonInsertUpdate(SHIPPING_ADDRESS,'insert','',$dataArr,'');
			
			if($result)
			{
			$ship_address=addslashes(af_lg('lg_ship_addr_added_sucesss','Shipping address added successfully'));
				$this->setErrorMessage('success',$ship_address);
				redirect('settings/account-shipping-address');
			}
			else
			{
				$this->setErrorMessage('error','Failed to add shipping address');
				redirect('settings/account-shipping-address');
				
			}
		}
		else
		{
		if($this->lang->line('details_req_fields') != '') { $details_req_fields= stripslashes($this->lang->line('details_req_fields')); } else { $details_req_fields = "Enter details in required fields"; }
			$this->setErrorMessage('error',$details_req_fields);
				redirect('settings/account-shipping-address');
		}
		
			
	}
	
	
	/**
	 * 
	 * Cart Load Shipping Address
	 * 
	 */
	function cart_shipping_address()
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect(base_url()."login?redirect=cart");
		}

		$this->data['country']=$this->user_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')))->result_array();
		$this->data['heading'] = $this->config->item('email_title').' - Shipping Address';
		$this->load->view("site/user/cart_shipping_address",$this->data);
	
	}
	
	/**
	 * 
	 * Add Cart Shipping Address
	 * 
	 */
	function cart_add_shipping_address()
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect('cart');
		}
		
		$country=trim(addslashes($this->input->post("country")));
		$full_name=trim(addslashes($this->input->post("name")));
		$address1=trim(addslashes($this->input->post("address1")));
		$address2=trim(addslashes($this->input->post("address2")));
		$city=trim(addslashes($this->input->post("city")));
		$state=trim(addslashes($this->input->post("state")));
		$postal_code=trim(addslashes($this->input->post("postal_code")));
		$phone=trim(addslashes($this->input->post("phone")));
		
		
		if($full_name!="" && $address1!="" && $city!="" && $state!="" && $postal_code!="" && $phone!=""){
			
			$dataArr=array('user_id'=>$this->checkLogin('U'),'full_name'=>$full_name,'address1'=>$address1,'address2'=>$address2,'city'=>$city,'state'=>$state,'country'=>$country,'postal_code'=>$postal_code,'phone'=>$phone);
			$result=$this->user_model->get_all_details(SHIPPING_ADDRESS,$dataArr);
			
			if($result->num_rows()>0){
			$ship_add_alreadyexist=addslashes(af_lg('lg_shipad_alreadyexist','This address already exist'));
				$this->setErrorMessage('error',$ship_add_alreadyexist);
				redirect('settings/cart-shipping-address');
			}
			$ship_address=addslashes(af_lg('lg_ship_addr_added_sucesss','Shipping address added successfully'));
			$this->user_model->simple_insert(SHIPPING_ADDRESS,$dataArr);
			$this->setErrorMessage('success',$ship_address);
			redirect('cart');
		}else{
		if($this->lang->line('details_req_fields') != '') { $details_req_fields= stripslashes($this->lang->line('details_req_fields')); } else { $details_req_fields = "Enter details in required fields"; }
			$this->setErrorMessage('error',$details_req_fields);
			redirect('settings/cart-shipping-address');
		}
	}
	
	/**
	 * 
	 * Remove Shipping Address user
	 * 
	 */
	function remove_shipping_address($id)
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect(base_url());
		}
		//echo $id;die;
		$this->user_model->commonDelete(SHIPPING_ADDRESS,array('id'=>$id));
		$delete_ship_address=addslashes(af_lg('lg_delete_ship_address','Shipping address deleted successfully'));
		$this->setErrorMessage('success',$delete_ship_address);
				redirect('settings/account-shipping-address');
		}
	
	/**
	 * 
	 * Remove Credit card options
	 * 
	 */
	function remove_creadit_card($id)
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect('login');
		}
		//echo $id;die;
		$this->user_model->commonDelete(CREDITCARDS,array('user_id'=>$this->checkLogin('U')));
		$remove_card=addslashes(af_lg('lg_remove_card','Your Credit Card Informations Removed successfully'));
		$this->setErrorMessage('success',$remove_card);
				redirect('settings/account-creditcard');
		}
	
	/**
	 * 
	 * Remove Account Shipping 
	 * 
	 */
	function remove_order($dealCodeNumber)
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect(base_url());
		}
		$this->user_model->commonDelete(USER_PAYMENT,array('dealCodeNumber'=>$dealCodeNumber));
		$this->setErrorMessage('success','Order deleted successfully');
				redirect('purchase-review');
		}
	
	/**
	 * 
	 * Display creditcard information
	 * 
	 */
	function account_creditcard()
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect(base_url());
		}
		$this->data['CardsDetails'] = $this->user_model->get_all_details(CREDITCARDS,array('user_id'=>$this->checkLogin('U')));
		$this->data['heading'] = $this->config->item('email_title').' - Credit Card Informations';
		$this->load->view("site/user/creditcard",$this->data);
	
	}
	
	/**
	 * 
	 * Add Credit card information 
	 * 
	 */
	public function add_credit_cards(){
		$card_number=$this->input->post('card_number');
		$card_type=$this->input->post('card_type');
		$expiry_month=$this->input->post('expiry_month');
		$expiry_year=$this->input->post('expiry_year');
		$cvv=$this->input->post('cvv');
		$dataArr=array('user_id' => $this->checkLogin('U'),'card_number' => $card_number,'card_type' => $card_type,'exp_month' => $expiry_month,'exp_year' => $expiry_year,'security_code' => $cvv);
		$this->user_model->simple_insert(CREDITCARDS,$dataArr);
		$save_card=addslashes(af_lg('lg_save_card','Your card saved  successfully'));
	    $this->setErrorMessage('success',$save_card);		
		redirect("settings/account-creditcard");
	}
	
	/**
	 * 
	 * Load account email
	 * 
	 */
	function account_email()
	{
		if ($this->checkLogin('U') == ''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
				redirect(base_url());
		}
		//$data['PublicProfile'] = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U'),'status'=>'Active'));
		$this->data['heading'] = $this->config->item('email_title').' - Email Settings';
		$this->load->view("site/user/email",$this->data);
	
	}
	
	
	
	/**
	 * 
	 * add follow to the user
	 * 
	 */
	
	public function add_follow(){
		#die;echo "<pre>";print_r($this->data['notification_emailArr']);die;
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') != ''){
			$follow_id = $this->input->post('user_id');
			
			$checkloginIDarr=$this->session->all_userdata(); 
		 	$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
			$userDetails = $this->user_model->get_all_details(USERS,array('id'=>$loggeduserID));
			#echo $this->data['userDetails']->row()->following;die;
			$followingListArr = explode(',', $userDetails->row()->following);
			if (!in_array($follow_id, $followingListArr)){
				$followingListArr[] = $follow_id;
				$newFollowingList = implode(',', $followingListArr);
				$followingCount = $userDetails->row()->following_count;
				$followingCount++;
				$dataArr = array('following'=>$newFollowingList,'following_count'=>$followingCount);
				$condition = array('id'=>$this->checkLogin('U'));
				$this->user_model->update_details(USERS,$dataArr,$condition);
				$followUserDetails = $this->user_model->get_all_details(USERS,array('id'=>$follow_id));
				if ($followUserDetails->num_rows() == 1){
					$followersListArr = explode(',', $followUserDetails->row()->followers);
					if (!in_array($this->checkLogin('U'), $followersListArr)){
						$followersListArr[] = $this->checkLogin('U');
						$newFollowersList = implode(',', $followersListArr);
						$followersCount = $followUserDetails->row()->followers_count;
						$followersCount++;
						$dataArr = array('followers'=>$newFollowersList,'followers_count'=>$followersCount);
						$condition = array('id'=>$follow_id);
						$this->user_model->update_details(USERS,$dataArr,$condition);
					}
				}
				$actArr = array('activity'=>'follow',
										'activity_id'=>$follow_id,
										'user_id'	=>$loggeduserID,
										'activity_ip'=>$this->input->ip_address(),
										'created'=>date("Y-m-d H:i:s"));
				$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
				$sent_email=$this->user_model->get_all_details(USERS,array('id'=>$follow_id));
				$noty_email_arr=explode(',',$sent_email->row()->notification_email);
				if(in_array('follow',$noty_email_arr)){
					//$query=$this->user_model->get_all_details(USERS, array('id'= $follow_id));
					$full_name=$sent_email->row()->full_name;
					$cfull_name=$userDetails->row()->full_name;
					$user_name=$userDetails->row()->user_name;
					$newsid='9';
					$template_values=$this->user_model->get_newsletter_template_details($newsid);

					$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
					extract($adminnewstemplateArr);
					$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
					$message .= '<!DOCTYPE HTML>
						<html>
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
						<meta name="viewport" content="width=device-width"/>
						<title>'.$template_values['news_subject'].'</title>
						<body>';
					include('./newsletter/registeration'.$newsid.'.php');	
					
					$message .= '</body>
						</html>';
						

					if($template_values['sender_name']=='' && $template_values['sender_email']==''){
						$sender_email=$this->config->item('site_contact_mail');
						
						$sender_name=$this->config->item('email_title');
					}else{
						$sender_name=$template_values['sender_name'];
						$sender_email=$template_values['sender_email'];
					}
					$email_values = array('mail_type'=>'html',
										'from_mail_id'=>$sender_email,
										'mail_name'=>$sender_name,
										'to_mail_id'=>$sent_email->row()->email,
										'subject_message'=>'Follows',
										'body_messages'=>$message
										);
										
					//echo '<pre>'; print_r($email_values); die;

					$email_send_to_common = $this->product_model->common_email_send($email_values);#die;
				}
				$message=$checkloginIDarr['shopsy_session_user_name'].' started following you on '.$this->config->item('email_title');
				$type='follow';
				$this->sendPushNotification($follow_id,$message,$type,array($follow_id));
				$returnStr['status_code'] = 1;
			}else {
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr); 
	}
	
	/**
	 * 
	 * delete follow to the user
	 * 
	 */
	public function delete_follow(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') != ''){
			$follow_id = $this->input->post('user_id');
			$checkloginIDarr=$this->session->all_userdata(); 
		 	$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];			
			$userDetails = $this->user_model->get_all_details(USERS,array('id'=>$loggeduserID));			
			$followingListArr = explode(',', $userDetails->row()->following);
			if (in_array($follow_id,$followingListArr)){
				if(($key = array_search($follow_id, $followingListArr)) !== false) {
				    unset($followingListArr[$key]);
				}
				$newFollowingList = @implode(',', $followingListArr);
				$followingCount = $userDetails->row()->following_count;
				$followingCount--;
				$dataArr = array('following'=>$newFollowingList,'following_count'=>$followingCount);
				$condition = array('id'=>$loggeduserID);
				$this->user_model->update_details(USERS,$dataArr,$condition);
				$followUserDetails = $this->user_model->get_all_details(USERS,array('id'=>$follow_id));
				if ($followUserDetails->num_rows() == 1){
					$followersListArr = explode(',', $followUserDetails->row()->followers);
					if (in_array($this->checkLogin('U'), $followersListArr)){
						if(($key = array_search($this->checkLogin('U'), $followersListArr)) !== false) {
						    unset($followersListArr[$key]);
						}
						$newFollowersList = implode(',', $followersListArr);
						$followersCount = $followUserDetails->row()->followers_count;
						$followersCount--;
						$dataArr = array('followers'=>$newFollowersList,'followers_count'=>$followersCount);
						$condition = array('id'=>$follow_id);
						$this->user_model->update_details(USERS,$dataArr,$condition);
					}
				}
				
				$actArr = array('activity'=>'unfollow',
										'activity_id'=>$follow_id,
										'user_id'	=>$loggeduserID,
										'activity_ip'=>$this->input->ip_address(),
										'created'=>date("Y-m-d H:i:s"));
				$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
				$returnStr['status_code'] = 1;
			}else {
				$returnStr['status_code'] = 1;
			}
		} 
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * Display the user option private or public
	 * 
	 */
	public function display_user_added(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->data['heading'] = $this->config->item('email_title').' - Profile';
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				$this->data['heading'] = $username;
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$this->data['addedProductDetails'] = $this->product_model->view_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"');
				$this->data['notSellProducts'] = $this->product_model->view_notsell_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"');
				$this->data['heading'] = $this->config->item('email_title').' - Profile';
				$this->load->view('site/user/display_user_added',$this->data);
			}
		}else {
			redirect(base_url());
		}
	}
	
	/**
	 * 
	 * Add the public or private option 
	 * 
	 */
	public function display_user_add(){
				
				$this->data['heading'] =$this->config->item('meta_title').' - Add product'; 
					$userProfileDetailss = $this->seller_model->get_sellers_store_details();
					$attribute_Val = $this->product_attribute_model->view_attribute_details(PRODUCT_ATTRIBUTE,array('status'=>'Active'));
					$shipping = $this->seller_model->get_all_details(SHIPPING,array('status'=>'Active'));
					$this->data['userProfileDetailss'] = $userProfileDetailss;
					$this->data['shipping'] = $shipping;
					$this->data['attribute_Val'] = $attribute_Val;
					$this->load->view('site/user/display_user_add',$this->data);
		
	}
	/*	public function user_add(){
							echo "<pre>";print_r($_POST); die;

					$userProfileDetailss = $this->seller_model->get_sellers_store_details();
					$this->data['userProfileDetailss'] = $userProfileDetailss;
					$this->load->view('site/user/display_user_add',$this->data);
		
	}*/
	
	/**
	 * 
	 * Display the user lists
	 * 
	 */
	public function display_user_lists(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				$this->data['heading'] = $username;
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$this->data['listDetails'] = $this->product_model->get_all_details(LISTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id));
				if ($this->data['listDetails']->num_rows()>0){
					foreach ($this->data['listDetails']->result() as $listDetailsRow){
						$this->data['listImg'][$listDetailsRow->id] = '';
						if ($listDetailsRow->product_id != ''){
							$pidArr = array_filter(explode(',', $listDetailsRow->product_id));
							
							$productDetails = '';
							if (count($pidArr)>0){
								foreach ($pidArr as $pidRow){
									if ($pidRow!=''){
										$productDetails = $this->product_model->get_all_details(PRODUCT,array('seller_product_id'=>$pidRow,'status'=>'Publish'));
										if ($productDetails->num_rows()==0){
											$productDetails = $this->product_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pidRow,'status'=>'Publish'));
										}
										if ($productDetails->num_rows()==1)break;
									}
								}
							}
							if ($productDetails != '' && $productDetails->num_rows()==1){
								$this->data['listImg'][$listDetailsRow->id] = $productDetails->row()->image;
							}
						}
					}
				}
				$this->load->view('site/user/display_user_lists',$this->data);
			}
		}else {
			redirect(base_url());
		}
	}
	
	/**
	 * 
	 * Display the user wants
	 * 
	 */
	public function display_user_wants(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				$this->data['heading'] = $username;
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$wantList = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id));
				$this->data['wantProductDetails'] = $this->product_model->get_wants_product($wantList);
				$this->data['notSellProducts'] = $this->product_model->get_notsell_wants_product($wantList);
				$this->load->view('site/user/display_user_wants',$this->data);
			}
		}else {
			redirect(base_url());
		}
	}
	
	/**
	 * 
	 * Display the user owns
	 * 
	 */
	public function display_user_owns(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				$this->data['heading'] = $username;
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$productIdsArr = array_filter(explode(',', $userProfileDetails->row()->own_products));
				$productIds = '';
				if (count($productIdsArr)>0){
					foreach ($productIdsArr as $pidRow){
						if ($pidRow != ''){
							$productIds .= $pidRow.',';
						}
					}
					$productIds = substr($productIds, 0,-1);
				}
				if ($productIds != ''){
					$this->data['ownsProductDetails'] = $this->product_model->view_product_details(' where p.seller_product_id in ('.$productIds.') and p.status="Publish"');
					$this->data['notSellProducts'] = $this->product_model->view_notsell_product_details(' where p.seller_product_id in ('.$productIds.') and p.status="Publish"');
				}else {
					$this->data['addedProductDetails'] = '';
					$this->data['notSellProducts'] = '';
				}
				$this->load->view('site/user/display_user_owns',$this->data);
			}
		}else {
			redirect(base_url());
		}
	}
	
	/**
	 * 
	 * Display the user followings
	 * 
	 */
	public function display_user_following(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		#echo "<pre>"; print_r($userProfileDetails->result_array()); 
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/following_list',$this->data);
			}else {
				$this->data['heading'] = $username;
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$fieldsArr = array('*');
				$searchName = 'id';
				$searchArr = explode(',', $userProfileDetails->row()->following);
				$joinArr = array();
				$sortArr = array();
				$limit = '';
				$followingUserDetails = $this->product_model->get_fields_from_many(USERS,$fieldsArr,$searchName,$searchArr,$joinArr,$sortArr,$limit);				
				$this->data['followingUserDetails'] = $followingUserDetails->result_array();
				if ($followingUserDetails->num_rows()>0){
					foreach ($followingUserDetails->result() as $followingUserRow){
						$this->data['followingUserfavDetails'][$followingUserRow->id] = $this->user_model->get_userfav_products($followingUserRow->id);
						$this->data['followingUserfavProdDetails'][$followingUserRow->id] = $this->user_model->get_userfav_products($followingUserRow->id)->result_array();						
					}
				}
				#echo "<pre>"; print_r($this->data['followingUserDetails']); 
				#echo "<pre>"; print_r($this->data['followingUserfavProdDetails']); die;
				$this->data['heading'] = $this->config->item('email_title').' - Following List';
				$this->load->view('site/user/following_list',$this->data);
			}
		}else {
			redirect(base_url());
		}
	}
	
	/**
	 * 
	 * Display the user followers
	 * 
	 */
	public function display_user_followers(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		$this->data['userProfileDetails'] =$this->user_model->get_all_details(USERS,array('user_name'=>$username)); 
		#echo "<pre>"; print_r($this->data['userProfileDetails']); die;
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				#$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				$this->data['heading'] = $username;
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$fieldsArr = array('*');
				$searchName = 'id';
				$searchArr = explode(',', $userProfileDetails->row()->followers);
				$joinArr = array();
				$sortArr = array();
				$limit = '';
				$followingUserDetails = $this->product_model->get_fields_from_many(USERS,$fieldsArr,$searchName,$searchArr,$joinArr,$sortArr,$limit);
				$this->data['followingUserDetails'] = $followingUserDetails->result_array();				
				if ($followingUserDetails->num_rows()>0){
					foreach ($followingUserDetails->result() as $followingUserRow){
						$this->data['followingUserfavDetails'][$followingUserRow->id] = $this->user_model->get_userfav_products($followingUserRow->id);
						$this->data['followingUserfavProdDetails'][$followingUserRow->id] = $this->user_model->get_userfav_products($followingUserRow->id)->result_array();
						
					}
				}
				#echo "<pre>"; print_r($this->data['followingUserfavProdDetails']);
				#echo "<pre>"; print_r($this->data['followingUserfavDetails']); #die;
				$this->data['heading'] = $this->config->item('email_title').' - Follower List';
				$this->load->view('site/user/followers_list',$this->data);
			}
		}else {
			redirect(base_url());
		}
	}
	
	/**
	 * 
	 * To Create a new list for user
	 * param String $name
	 * 
	 */
	public function add_list($name=''){		
		if ($this->checkLogin('U')!=''){
			$username =  urldecode($this->uri->segment(2,0));
			if($name==''){
				$name=$this->input->post('list');
			}else{
				$rdir=1;	
			}						
			$listConditionArr = array('name'=>$name,'user_id'=>$this->checkLogin('U'));
			if($this->input->post('ddl'))
			{
				$productId=$this->input->post('productId');
				$listArr = array('name'=>$name,'product_id'=>$productId.',','user_id'=>$this->checkLogin('U'),'product_count'=>1);
			}
			else
			{
				$listArr = array('name'=>$name,'user_id'=>$this->checkLogin('U'));
			}
			$listCheck = $this->user_model->get_all_details(LISTS_DETAILS,$listConditionArr);
			#print_r($listCheck);
			#echo "<pre>"; print_r($listConditionArr); die;
			if ($listCheck->num_rows()==0){
				$this->user_model->simple_insert(LISTS_DETAILS,$listArr);
				$this->setErrorMessage('success', af_lg('lg_list','List').' '.$name.' '.af_lg('lg_created_success','created successfully'));			
				if($this->input->post('ddl')){ redirect('');}
				redirect('/people/'.$this->session->userdata('shopsy_session_user_name').'/favorites');
			}
			else 
			{
				$this->setErrorMessage('error',$name.' '.af_lg('lg_already_in_list','is already in you List'));
				if($rdir){
					redirect('/people/'.$this->session->userdata('shopsy_session_user_name').'/favorites');
				}
				redirect('/people/'.$this->session->userdata('shopsy_session_user_name').'/favorites');
			}
			
		}
		else
		{
			$this->setErrorMessage('error','Login Required');
			redirect('login?redirect='.$this->input->post("redirect"));
			#redirect('login?action='.urlencode('site/user/add_list/'.$this->input->post('list')));
		}
	}
	
	/**
	 * 
	 * To update a list for user
	 * param String $id
	 * 
	 */
	public function update_list($id=''){		
		if ($this->checkLogin('U')!=''){
			$username =  urldecode($this->uri->segment(2,0));								
			$listId=$list_name=$this->input->post('list_Id');
			$list_name=$this->input->post('list_name');
			$privacy_level=$this->input->post('privacy_level');
			
			if ($listId!=''){
				$dataArr = array('name'=>$list_name,'privacy'=>$privacy_level);
				$condition = array('id'=>$listId);
				#echo "<pre>"; print_r($dataArr); print_r($condition); die;
				$this->user_model->update_details(LISTS_DETAILS,$dataArr,$condition);		
						
				$this->setErrorMessage('success',af_lg('lg_list','List').' '.$list_name.' '.af_lg('lg_update_success','Updated successfully'));
				            
				redirect('/people/'.$this->session->userdata('shopsy_session_user_name').'/favorites/list/'.$listId.'-'.$list_name);
			}
		}
		else
		{
			$this->setErrorMessage('error','Login Required');
			redirect('login');
		}
	}
	
	/**
	 * 
	 * To add the product to the list
	 * 
	 */
	public function add_item_to_lists(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
		$lg_login=addslashes(af_lg('lg_login','You must login'));
			$returnStr['message'] =$lg_login;
		}else {
			$tid = $this->input->post('tid');
			$lid = $this->input->post('list_ids');
			$listDetails = $this->user_model->get_all_details(LISTS_DETAILS,array('id'=>$lid));
			if ($listDetails->num_rows()==1){
				$product_ids = explode(',', $listDetails->row()->product_id);
				if (!in_array($tid, $product_ids)){
					array_push($product_ids, $tid);
				}
				$new_product_ids = implode(',', $product_ids);
				$this->user_model->update_details(LISTS_DETAILS,array('product_id'=>$new_product_ids),array('id'=>$lid));
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * To remove the product from the list
	 * 
	 */
	public function remove_item_from_lists(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('tid');
			$lid = $this->input->post('list_ids');
			$listDetails = $this->user_model->get_all_details(LISTS_DETAILS,array('id'=>$lid));
			if ($listDetails->num_rows()==1){
				$product_ids = explode(',', $listDetails->row()->product_id);
				if (in_array($tid, $product_ids)){
					if(($key = array_search($tid, $product_ids)) !== false) {
					    unset($product_ids[$key]);
					}
				}
				$new_product_ids = implode(',', $product_ids);
				$this->user_model->update_details(LISTS_DETAILS,array('product_id'=>$new_product_ids),array('id'=>$lid));
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * To add the want tag
	 * 
	 */
	public function add_want_tag(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('thing_id');
			$wantDetails = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$this->checkLogin('U')));
			if ($wantDetails->num_rows()==1){
				$product_ids = explode(',', $wantDetails->row()->product_id);
				if (!in_array($tid, $product_ids)){
					array_push($product_ids, $tid);
				}
				$new_product_ids = implode(',', $product_ids);
				$this->user_model->update_details(WANTS_DETAILS,array('product_id'=>$new_product_ids),array('user_id'=>$this->checkLogin('U')));
			}else {
				$dataArr = array('user_id'=>$this->checkLogin('U'),'product_id'=>$tid);
				$this->user_model->simple_insert(WANTS_DETAILS,$dataArr);
			}
			$wantCount = $this->data['userDetails']->row()->want_count;
			if ($wantCount<=0 || $wantCount==''){
				$wantCount = 0;
			}
			$wantCount++;
			$dataArr = array('want_count'=>$wantCount);
			$ownProducts = explode(',', $this->data['userDetails']->row()->own_products);
			if (in_array($tid, $ownProducts)){
				if (($key = array_search($tid, $ownProducts)) !== false){
					unset($ownProducts[$key]);
				}
				$ownCount = $this->data['userDetails']->row()->own_count;
				$ownCount--;
				$dataArr['own_count'] = $ownCount;
				$dataArr['own_products'] = implode(',', $ownProducts);
			}
			$this->user_model->update_details(USERS,$dataArr,array('id'=>$this->checkLogin('U')));
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * To delete the want tag
	 * 
	 */
	public function delete_want_tag(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('thing_id');
			$wantDetails = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$this->checkLogin('U')));
			if ($wantDetails->num_rows()==1){
				$product_ids = explode(',', $wantDetails->row()->product_id);
				if (in_array($tid, $product_ids)){
					if(($key = array_search($tid, $product_ids)) !== false) {
					    unset($product_ids[$key]);
					}
				}
				$new_product_ids = implode(',', $product_ids);
				$this->user_model->update_details(WANTS_DETAILS,array('product_id'=>$new_product_ids),array('user_id'=>$this->checkLogin('U')));
				$wantCount = $this->data['userDetails']->row()->want_count;
				if ($wantCount<=0 || $wantCount==''){
					$wantCount = 1;
				}
				$wantCount--;
				$this->user_model->update_details(USERS,array('want_count'=>$wantCount),array('id'=>$this->checkLogin('U')));
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * To create a new list
	 * 
	 */
	public function create_list(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('tid');
			$list_name = $this->input->post('list_name');
			$category_id = $this->input->post('category_id');
			$checkList = $this->user_model->get_all_details(LISTS_DETAILS,array('name'=>$list_name,'user_id'=>$this->checkLogin('U')));
			if ($checkList->num_rows() == 0){
				$dataArr = array('user_id'=>$this->checkLogin('U'),'name'=>$list_name,'product_id'=>$tid);
				if ($category_id != ''){
					$dataArr['category_id'] = $category_id;
				}
				$this->user_model->simple_insert(LISTS_DETAILS,$dataArr);
				$userDetails = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
				$listCount = $userDetails->row()->lists;
				if ($listCount<0 || $listCount == ''){
					$listCount = 0;
				}
				$listCount++;
				$this->user_model->update_details(USERS,array('lists'=>$listCount),array('id'=>$this->checkLogin('U')));
				$returnStr['list_id'] = $this->user_model->get_last_insert_id();
				$returnStr['new_list'] = 1;
			}else {
				$productArr = explode(',', $checkList->row()->product_id);
				if (!in_array($tid, $productArr)){
					array_push($productArr, $tid);
				}
				$product_id = implode(',', $productArr);
				$dataArr = array('product_id'=>$product_id);
				if ($category_id != ''){
					$dataArr['category_id'] = $category_id;
				}	
				$this->user_model->update_details(LISTS_DETAILS,$dataArr,array('user_id'=>$this->checkLogin('U'),'name'=>$list_name));
				$returnStr['list_id'] = $checkList->row()->id;
				$returnStr['new_list'] = 0;
			}
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * To search the particular user
	 * 
	 */
	public function search_users(){
		$search_key = $this->input->post('term');
		$returnStr = array();
		if ($search_key != ''){
			$userList = $this->user_model->get_search_user_list($search_key,$this->checkLogin('U'));
			if ($userList->num_rows()>0){
				$i=0;
				foreach ($userList->result() as $userRow){
					$userArr['id'] = $userRow->id;
					$userArr['fullname'] = $userRow->full_name;
					$userArr['username'] = $userRow->user_name;
					if ($userRow->thumbnail != ''){
						$userArr['image_url'] = 'images/users/'.$userRow->thumbnail;
					}else {
						$userArr['image_url'] = 'images/users/user-thumb1.png';
					}
					array_push($returnStr, $userArr);
					$i++;
				}
			}
		}
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * Seller Registration form
	 * 
	 */
	public function seller_signup_form(){

		if ($this->checkLogin('U')==''){
			redirect(base_url());
		}else {
			if ($this->data['userDetails']->row()->is_verified == 'No'){
				$this->setErrorMessage('error','Please confirm your email first');
				redirect(base_url());
			}
						else {
				$this->data['heading'] = 'Seller Signup';
				$this->load->view('site/user/seller_register',$this->data);
			}
		}
	}
	
	/**
	 * 
	 * To seller view form
	 * 
	 */
	public function create_brand_form(){
		if ($this->checkLogin('U')==''){
			redirect(base_url());
		}else {
			$this->data['heading'] = 'Seller Signup';
			$this->load->view('site/user/seller_register',$this->data);
		}
	}
	
	
	/**
	 * 
	 * Seller Registration form
	 * 
	 */
	public function seller_signup(){
	
		if ($this->checkLogin('U')==''){
			redirect(base_url());
		}else {
			if ($this->data['userDetails']->row()->is_verified == 'No'){
				$this->setErrorMessage('error','Please confirm your email first');
				redirect('create-brand');
//				echo "<script>window.history.go(-1)/script>";
			}else {
				$dataArr = array(
					'request_status'	=>	'Pending'
				);
				$this->user_model->commonInsertUpdate(USERS,'update',array(),$dataArr,array('id'=>$this->checkLogin('U')));
				$this->setErrorMessage('success','Welcome onboard ! Our team is evaluating your request. We will contact you shortly');
				redirect(base_url());
			}
		}
	}
	
	/*public function find_friends_twitter(){
		$returnStr['status_code'] = 1;
//		$returnStr['url'] = base_url().'twfollows.php';
		$returnStr['url'] = 'https://api.twitter.com/oauth/authorize?oauth_token=395839017-A1lVlw1uWXwDnzPFQuOBGGypMxYHLP3nrEICkyIs';
		$returnStr['message'] = '';
		echo json_encode($returnStr);
	}*/
	
	
	/**
	 * 
	 * View purchase details for user
	 * 
	 */
	public function view_purchase(){ 
		if ($this->checkLogin('U') == ''){
			show_404();
		}else {
			$uid = $this->uri->segment(2,0);
			$dealCode = $this->uri->segment(3,0);
			if ($uid != $this->checkLogin('U')){
				#show_404();
				redirect('login');
			}else {
				$purchaseList = $this->user_model->get_purchase_list($uid,$dealCode);
				//echo '<pre>'; print_r($purchaseList->result()); die;
				$invoice = $this->get_invoice($purchaseList);
				echo $invoice;
			}
		}
	}
	
	/**
	 * 
	 * view purchase details for seller
	 * 
	 */
	public function view_seller_purchase(){ 
		if ($this->checkLogin('U') == ''){
			show_404();
		}else {
			$uid = $this->uri->segment(2,0);
			$dealCode = $this->uri->segment(3,0);
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$purchaseList = $this->user_model->get_seller_purchase_list($uid,$dealCode);
				$invoice = $this->get_invoice($purchaseList);
				echo $invoice;
			}
		}
	}
	
	/**
	 * 
	 * view order details for user
	 * 
	 */
	public function view_order(){
		if ($this->checkLogin('U') == ''){
			show_404();
		}else {
			$uid = $this->uri->segment(2,0);
			$dealCode = $this->uri->segment(3,0);
			if ($uid != $this->checkLogin('U')){
				
				show_404();
			}else {
				//$orderList = $this->user_model->get_user_purchase_list($uid,$dealCode);
				##echo "<pre>"; print_r($orderList); die;
				
				$invoice = $this->get_invoice($uid,$dealCode);
				echo $invoice; die;
			}
		}
	}
	
	
	
	public function view_order_pre(){
	
		if ($this->checkLogin('U') == ''){
			show_404();	
		}else {
	
			$uid = $this->uri->segment(2,0);
			$dealCode = $this->uri->segment(3,0);
			$check = "select * from ".USER_PAYMENT." where user_id=".$uid." and dealCodeNumber ='".$dealCode."' GROUP BY dealCodeNumber";		
			$sell_id = $this->user_model->ExecuteQuery($check)->row()->sell_id;
			if ($uid == $this->checkLogin('U') || $sell_id ==  $this->checkLogin('U') ){				
			$dealCode = $this->uri->segment(3,0);
			$check = "select * from ".USER_PAYMENT." where user_id=".$uid." and dealCodeNumber ='".$dealCode."' GROUP BY dealCodeNumber";
			$checkStatus = $this->user_model->ExecuteQuery($check)->first_row();
			$this->data['PublicProfile'] = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U'),'status'=>'Active'));
			if(($checkStatus->payment_type == 'COD' || $checkStatus->payment_type == 'wire_transfer'|| $checkStatus->payment_type == 'western_union') && ($checkStatus->status == 'Pending')){
				$status = "Pending";
			}else{
				$status = "Paid";
			} 
			$this->data['userPurchase']= $userPurchase=$this->user_model->get_user_purchase_list($uid,$dealCode, $status);
			
			$purchaseProducts=$userPurchase->result();
			
			foreach($purchaseProducts as $key => $pro){
				$review = $this->user_model->get_all_details(PRODUCT_FEEDBACK,array('voter_id'=>$pro->user_id,'seller_product_id'=>$pro->product_id,'deal_code'=>$pro->dealCodeNumber))->row('rating');
				if(empty($review)){
					$review = '';
				}
				//echo "<pre>"; print_r($review);
				$purchaseProducts[$key]->starrating = $review ;
			}
			
			//echo "<pre>"; print_r($purchaseProducts); die;
			
			$this->data['purchaseProducts']= $purchaseProducts;
			
			$this->data['buyerDetails'] = $buyerDetails = $this->user_model->get_all_details(USERS,array('id'=>$purchaseProducts[0]->user_id));

			//echo "<pre>".$this->db->last_query(); print_r($buyerDetails->result()); die;
			$this->data['sellerDetails'] = $sellerDetails = $this->user_model->get_all_details(USERS,array('id'=>$purchaseProducts[0]->sell_id));
			$this->load->view("site/user/purchase_view", $this->data);
			
				
				
		}else { 
			show_404();
		}
		}
	}
	
	/**
	 * 
	 * view order details for seller
	 * 
	 */
	public function view_seller_order(){
		if ($this->checkLogin('U') == ''){
			show_404();
		}else {
			$uid = $this->uri->segment(2,0);
			$dealCode = $this->uri->segment(3,0);
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$orderList = $this->user_model->get_seller_order_list($uid,$dealCode);
				$invoice = $this->get_invoice($orderList);
				echo $invoice;
			}
		}
	}
	
	/**
	 * 
	 * view invoice details for user
	 * param String $userId
	 * param String $randomid
	 * 
	 */
	public function get_invoice($userid,$randomId){
		//DIE;
		$this->db->select('p.*,u.email,u.full_name,u.user_name,u.last_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_type,pd.product_name,pd.image,pd.id as PrdID,pAr.attr_name,s.msg_to_buyers,s.msg_to_buyers_for_digiitem');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = p.attribute_values','left');
		$this->db->join(SELLER.' as s ','pd.user_id = s.seller_id');
		$this->db->where('p.user_id = "'.$userid.'" and p.dealCodeNumber="'.$randomId.'"');
		$PrdList = $this->db->get();
		//echo "<pre>";print_r($PrdList->result());die;
	$shipAddRess = $this->user_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $PrdList->row()->shippingid ));
	$BillAddRess = $this->user_model->get_all_details(BILLING_ADDRESS,array( 'id' => $PrdList->row()->billingid ));
	$sellerDetails = $this->user_model->get_all_details(USERS,array( 'id' => $PrdList->row()->sell_id ));
	
	$enc_dealCodeNumber=strtr($this->encrypt->encode($PrdList->row()->dealCodeNumber), '+/=', '-.~');
	$enc_user_id=strtr($this->encrypt->encode($PrdList->row()->user_id), '+/=', '-.~');
	
	
	$digital_item = 'Yes';
	
	foreach($PrdList->result() as $userCartItems){
		if($userCartItems->digital_files == ''){
			$digital_item = 'No';
			break;
		}
	}
	$phyflg=0;$digflg=0;$phymsg="";$digmsg="";
	foreach($PrdList->result() as $userCartItems){
	
		if($userCartItems->product_type == 'physical'){
			$phyflg = 1;
			$phymsg=$userCartItems->msg_to_buyers;			
		}else{
			$digflg=1;
			$digmsg=$userCartItems->msg_to_buyers_for_digiitem;
		}
	}	
	
	
	if($this->lang->line('discussion_order_id') != '') { $discussion_order_id = stripslashes($this->lang->line('discussion_order_id')); } else { $discussion_order_id = "Order Id'"; }
	
	if($this->lang->line('discussion_order_date') != '') { $discussion_order_date = stripslashes($this->lang->line('discussion_order_date')); } else { $discussion_order_date = "Order Date'"; }
	
	if($this->lang->line('shipp_add') != '') { $shipp_add = stripslashes($this->lang->line('shipp_add')); } else { $shipp_add = "Shipping Address'"; }
	
	if($this->lang->line('user_full_name') != '') { $user_full_name = stripslashes($this->lang->line('user_full_name')); } else { $user_full_name= "Full Name'"; }
	
	if($this->lang->line('shipping_address_comm') != '') { $shipping_address_comm = stripslashes($this->lang->line('shipping_address_comm')); } else { $shipping_address_comm = "Address'"; }
	
	
	if($this->lang->line('add2') != '') { $add2 = stripslashes($this->lang->line('add2')); } else { $add2 = "Address 2'"; }
	
	if($this->lang->line('user_city') != '') { $user_city = stripslashes($this->lang->line('user_city')); } else { $user_city = "City'"; }
	
	if($this->lang->line('header_country') != '') { $header_country = stripslashes($this->lang->line('header_country')); } else { $header_country = "Country'"; }
	
	if($this->lang->line('checkout_state') != '') { $checkout_state = stripslashes($this->lang->line('checkout_state')); } else { $checkout_state = "State'"; }
	
	if($this->lang->line('zip_code') != '') { $zip_code = stripslashes($this->lang->line('zip_code')); } else { $zip_code = "Zipcode'"; }
	
	if($this->lang->line('user_phone_no') != '') { $user_phone_no = stripslashes($this->lang->line('user_phone_no')); } else { $user_phone_no = "Phone Number'"; }
	
	if($this->lang->line('discussion_bag_items') != '') { $discussion_bag_items = stripslashes($this->lang->line('discussion_bag_items')); } else { $discussion_bag_items = "Bag Items"; }
 
 if($this->lang->line('discussion_product_name') != '') { $discussion_product_name = stripslashes($this->lang->line('discussion_product_name')); } else { $discussion_product_name = "Product Name"; }
 if($this->lang->line('discussion_qty') != '') { $discussion_qty = stripslashes($this->lang->line('discussion_qty')); } else { $discussion_qty = "Qty"; }
 
 if($this->lang->line('discussion_unit_price') != '') { $discussion_unit_price = stripslashes($this->lang->line('discussion_unit_price')); } else { $discussion_unit_price = "Unit Price"; }
 
 if($this->lang->line('discussion_sub_total') != '') { $discussion_sub_total = stripslashes($this->lang->line('discussion_sub_total')); } else { $discussion_sub_total = "Sub Total"; }
 
 if($this->lang->line('discussion_review') != '') { $discussion_review = stripslashes($this->lang->line('discussion_review')); } else { $discussion_review = "Review"; }
 if($this->lang->line('discussion_shipping_tax') != '') { $discussion_shipping_tax = stripslashes($this->lang->line('discussion_shipping_tax')); } else { $discussion_shipping_tax = "Shipping Tax"; }
 
 if($this->lang->line('discussion_shipping_cost') != '') { $discussion_shipping_cost = stripslashes($this->lang->line('discussion_shipping_cost')); } else { $discussion_shipping_cost = "Shipping Cost"; }
 
 if($this->lang->line('discussion_grand_total') != '') { $discussion_grand_total = stripslashes($this->lang->line('discussion_grand_total')); } else { $discussion_grand_total = "Grand Total"; }
 
 if($this->lang->line('thnk_purchase') != '') { $thnk_purchase = stripslashes($this->lang->line('thnk_purchase')); } else { $thnk_purchase = ",thank you for your purchase."; }
 
 if($this->lang->line('concerns_contact_us') != '') { $concerns_contact_us = stripslashes($this->lang->line('concerns_contact_us')); } else { $concerns_contact_us = "If you have any concerns please contact us."; }
 
 if($this->lang->line('shop_billing') != '') { $shop_billing = stripslashes($this->lang->line('shop_billing')); } else { $shop_billing = "Billing Address"; }
	
	
	$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<title>View Invoice</title>
<body>
<div style="width:1016px;background:#FFFFFF; margin:0 auto;">			
<!--END OF LOGO-->
    
 <!--start of deal-->
    <div id="printDiv" style="width:100%;background:#FFFFFF;float:left;">
    
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		
				<tr><td colspan="2" style="text-align: center; border-bottom:1px solid #515151; border-top:1px solid #515151; background:#e0e0e0;" ><span style="font-size:21px; font-family:Arial, Helvetica, sans-serif; text-align:center;  font-weight:bold; color:#000000; line-height:29px;">RETAIL INVOICE</td>
				</tr>
				
				<tr>
				
				<td width="50%"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; font-weight:bold; color:#000000; line-height:29px;">INVOICE NUMBER :</span>
				<span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:29px; text-align:center;">'.$PrdList->row()->dealCodeNumber.'</span>
				</td>
				
				<td width="49%"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; font-weight:bold; color:#000000; line-height:29px;">INVOICE DATE :</span><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:29px; text-align:center;">'.date("F j, Y g:i a",strtotime($PrdList->row()->created)).'</span></td>
			
				</tr>
				
			</table>
		
		
    <table width="100%" border="0" cellspacing="0" cellpadding="0">';
	if($shipAddRess->row()->full_name!=''){
		$message.='<td width="49%" style="vertical-align: top;  border-right: 1px solid #515151;">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:30px; text-transform: capitalize; background:#e0e0e0; border-bottom:1px solid #515151; border-top:1px solid #515151; ">
					
						<tr>
							<td><span style="padding:5px 10px 5px 0px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305; ">SELLER</span></td>					
						</tr>
					
					</table>
		    	
            	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:18px; text-transform: capitalize;">
                	<tr><td><strong>'.stripslashes($sellerDetails->row()->full_name).'</strong></td></tr>
                    <tr><td>'.stripslashes($sellerDetails->row()->address1).'</td></tr>
					<tr><td>'.stripslashes($sellerDetails->row()->address2).'</td></tr>
					<tr><td>'.stripslashes($sellerDetails->row()->city).'</td></tr>
					<tr><td>'.stripslashes($sellerDetails->row()->country).'</td></tr>
					<tr><td>'.stripslashes($sellerDetails->row()->state).'</td></tr>
					<tr><td>'.stripslashes($sellerDetails->row()->postal_code).'</td></tr>
					<tr><td>'.stripslashes($sellerDetails->row()->phone).'</td></tr>
            	</table>
     </td>';
	}else{
		$message.='<td></td>';
	}
    
    $message.='<td width="49%" style="vertical-align: top;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:30px; text-transform: capitalize; background:#e0e0e0; border-bottom:1px solid #515151; border-top:1px solid #515151;">
					
						<tr>
							<td><span style="padding:5px 10px 5px 10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305; ">BUYER</span></td>					
						</tr>
					
					</table>
	
            	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:18px; padding-left: 10px; text-transform: capitalize;">
                	<tr><td><strong>'.stripslashes($BillAddRess->row()->full_name).'</strong></td></tr>
                    <tr><td>'.stripslashes($BillAddRess->row()->address1).'</td></tr>
					<tr><td>'.stripslashes($BillAddRess->row()->address2).'</td></tr>
					<tr><td>'.stripslashes($BillAddRess->row()->city).'</td></tr>
					<tr><td>'.stripslashes($BillAddRess->row()->country).'</td></tr>
					<tr><td>'.stripslashes($BillAddRess->row()->state).'</td></tr>
					<tr><td>'.stripslashes($BillAddRess->row()->postal_code).'</td></tr>
					<tr><td>'.stripslashes($BillAddRess->row()->phone).'</td></tr>
            	</table>
    </td>
	</tr>
</table>
	    
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    	<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #515151; width:99.5%;">
        <tr bgcolor="#e0e0e0">
        	<td width="8%" style="border-right:1px solid #515151; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">'.$discussion_bag_items.'</span></td>
            <td width="39%" style="border-right:1px solid #515151;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">'.$discussion_product_name.'</span></td>';
            if($digital_item == 'No'){			
				$message.='<td width="12%" style="border-right:1px solid #515151;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">'.$discussion_qty.'</span></td>';
			}
            $message.='<td width="14%" style="border-right:1px solid #515151;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">'.$discussion_unit_price.'</span></td>
            <td width="15%" style="text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">'.$discussion_sub_total.'</span></td>
         </tr>';	   
			
$disTotal =0; $shipCost = $grantTotal = 0;$digiDownload=0;
foreach ($PrdList->result() as $cartRow) { $InvImg = @explode(',',$cartRow->image); 
$unitPrice = $cartRow->price; 
$uTot = $unitPrice*$cartRow->quantity;
if($cartRow->attribute_values != ''){ $atr = '<br>'.$cartRow->attribute_values; }elseif($catRow->attribute_values !=''){$atr = '<br>'.$cartRow->attribute_values; }else{ $atr = '';}
if($cartRow->digital_files != ''){ $digiDownload++; }
$message.='<tr>
            <td style="border-right:1px solid #515151; text-align:center;border-top:1px solid #515151;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">1</span></td>
			<td style="border-right:1px solid #515151;text-align:center;border-top:1px solid #515151;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->product_name).$atr.'</span></td>';
            if($digital_item == 'No'){			
				$message.='<td style="border-right:1px solid #515151;text-align:center;border-top:1px solid #515151;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.strtoupper($cartRow->quantity).'</span></td>';			
			}
            $message.='<td style="border-right:1px solid #515151;text-align:center;border-top:1px solid #515151;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($unitPrice * $this->data['currencyValue'],2,'.','').'</span></td>
            <td style="text-align:center;border-top:1px solid #515151;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($uTot * $this->data['currencyValue'],2,'.','').'</span></td>
        </tr>';
	$grantTotal = $grantTotal + $uTot;
	$shipCost = $shipCost + $cartRow->shippingcost;
}
	$private_total = $grantTotal - $PrdList->row()->discountAmount;
	$private_total = $private_total - $PrdList->row()->giftdiscountAmount;	
	$private_total = $private_total + $PrdList->row()->tax + $shipCost;
				 
$message.='</table></td> </tr><tr><td colspan="3"><table border="0" cellspacing="0" cellpadding="0" style=" margin:10px 0px; width:99.5%;"><tr>
			<td width="460" valign="top" >';
			if($PrdList->row()->note !=''){
$message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"><tr>
                <td width="87" ><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Note:</span></td>
               
            </tr>
			<tr>
                <td width="87"  style="border:1px solid #515151;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">'.stripslashes($PrdList->row()->note).'</span></td>
            </tr></table>';
			}
			
			if($PrdList->row()->order_gift == 1){
$message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"  style="margin-top:10px;"><tr>
                <td width="87"  style="border:1px solid #515151;"><span style="font-size:16px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">This Order is a gift</span></td>
            </tr></table>';
			}
			
$message.='</td>
            <td width="174" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #515151;">
            <tr bgcolor="#e0e0e0">
                <td width="87"  style="border-right:1px solid #515151;border-bottom:1px solid #515151;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">'.$discussion_sub_total.'</span></td>
                <td style="border-bottom:1px solid #515151;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($grantTotal * $this->data['currencyValue'],'2','.','').'</span></td>
            </tr>';
			
			if($PrdList->row()->discountAmount !='0.00'){
			$message.='<tr>
                <td width="87"  style="border-right:1px solid #515151;border-bottom:1px solid #515151;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Coupon Discount</span></td>
                <td  style="border-bottom:1px solid #515151;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->discountAmount * $this->data['currencyValue'],'2','.','').'</span></td>
            </tr>';
			}
			if($PrdList->row()->giftdiscountAmount !='0.00'){
			$message.='<tr>
                <td width="87"  style="border-right:1px solid #515151;border-bottom:1px solid #515151;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Gift Discount</span></td>
                <td  style="border-bottom:1px solid #515151;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->giftdiscountAmount * $this->data['currencyValue'],'2','.','').'</span></td>
            </tr>';
			}
		$message.='<tr bgcolor="#e0e0e0">            <td width="31" style="border-right:1px solid #515151;border-bottom:1px solid #515151;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">'.$discussion_shipping_cost.'</span></td>
                <td  style="border-bottom:1px solid #515151;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($shipCost * $this->data['currencyValue'],2,'.','').'</span></td>
              </tr>
			  <tr>
            <td width="31" style="border-right:1px solid #515151;border-bottom:1px solid #515151;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">'.$discussion_shipping_tax.'</span></td>
                <td  style="border-bottom:1px solid #515151;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->tax * $this->data['currencyValue'],2,'.','').'</span></td>
              </tr>
			  <tr bgcolor="#e0e0e0">
                <td width="87" style="border-right:1px solid #515151;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$discussion_grand_total.'</span></td>
                <td width="31"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($private_total * $this->data['currencyValue'],'2','.','').'</span></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        </tr>
    </table>
        
        <!--end of left--> 
		<div style="width:50%; float:left;">';
		if($digiDownload>0){
				$message.='<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:38px; ">'.$digiDownload.' Products are having the digital files in this order, Click <span><a href="'.base_url().'digital-files/'.$enc_user_id.'/'.$enc_dealCodeNumber.'"> here</a> </span>to download these.</div>';
		}
		 if($phyflg == 1){
			$message.='<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:20px; ">'.$phymsg.'</div>';
		} 
		if($digflg == 1){
			$message.='<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:20px; ">'.$digmsg.'</div>';
		} 
            	
		if($PrdList->row()->full_name != ''){
			$message.='<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:20px; "><span>'.stripslashes($PrdList->row()->full_name).'</span>, thank you for your purchase.</div>';
		}else if($PrdList->row()->user_name != ''){	
           	$message.='<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:20px; "><span>'.stripslashes($PrdList->row()->user_name).'</span>, thank you for your purchase.</div>';
		}else{
			$message.='<div style="float:left; width:100%;font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; width:100%; color:#000000; line-height:20px; "><span>thank you for your purchase.</div>';
		}   	
               
               $message.='<ul style="width:100%; margin:0px; padding:0; list-style:none; float:left; font-size:12px; font-weight:normal; line-height:20px; font-family:Arial, Helvetica, sans-serif; color:#000;">
                    <li>If you have any concerns please contact us.</li>
                    <li>Email: <span>'.stripslashes($this->data['siteContactMail']).' </span></li>
               </ul>
        	</div>
            <div style="float:right; margin:40px 100px 40px 80px"><button onclick="window.print();">Print</button></div>        		
</body>
</html>';	
		return $message;
	}
	
	/**
	 * 
	 * Change order status to user
	 * 
	 */
	public function change_order_status(){
		if ($this->checkLogin('U') == ''){
			show_404();
		}else {
			$uid = $this->input->post('seller');
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$returnStr['status_code'] = 0;
				$dealCode = $this->input->post('dealCode');
				$status = $this->input->post('value');
				$dataArr = array('shipping_status'=>$status);
				$conditionArr = array('dealCodeNumber'=>$dealCode,'sell_id'=>$uid);
				$this->user_model->update_details(PAYMENT,$dataArr,$conditionArr);
				$returnStr['status_code'] = 1;
				echo json_encode($returnStr);
			}
		}
	}
	/**
	 * 
	 * Display the user list homes
	 * 
	 */
	public function display_user_lists_home(){
		$lid = $this->uri->segment('4','0');
		$uname = $this->uri->segment('2','0');
		$this->data['user_profile_details'] = $userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$uname));
		if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
			$this->load->view('site/user/display_user_profile_private',$this->data);
		}else {
			$this->data['list_details'] = $list_details = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$this->data['user_profile_details']->row()->id));
			if ($this->data['list_details']->num_rows()==0){
				show_404();
			}else {
				$searchArr = array_filter(explode(',', $list_details->row()->product_id));
				if (count($searchArr)>0){
					$fieldsArr = array(PRODUCT.'.*',USERS.'.user_name',USERS.'.full_name');
					$condition = array(PRODUCT.'.status'=>'Publish');
					$joinArr1 = array('table'=>USERS,'on'=>USERS.'.id='.PRODUCT.'.user_id','type'=>'');
					$joinArr = array($joinArr1);
					$this->data['product_details'] = $product_details = $this->product_model->get_fields_from_many(PRODUCT,$fieldsArr,PRODUCT.'.seller_product_id',$searchArr,$joinArr,'','',$condition);
					$this->data['totalProducts'] = count($searchArr);
					$fieldsArr = array(USER_PRODUCTS.'.*',USERS.'.user_name',USERS.'.full_name');
					$condition = array(USER_PRODUCTS.'.status'=>'Publish');
					$joinArr1 = array('table'=>USERS,'on'=>USERS.'.id='.USER_PRODUCTS.'.user_id','type'=>'');
					$joinArr = array($joinArr1);
					$this->data['notsell_product_details'] = $this->product_model->get_fields_from_many(USER_PRODUCTS,$fieldsArr,USER_PRODUCTS.'.seller_product_id',$searchArr,$joinArr,'','',$condition);
				}else {
					$this->data['notsell_product_details'] = '';
					$this->data['product_details'] = '';
					$this->data['totalProducts'] = 0;
				}
				$this->load->view('site/user/user_list_home',$this->data);
			}
		}
	}
	
	/**
	 * 
	 * Display the user list followers
	 * 
	 */
	public function display_user_lists_followers(){
		$lid = $this->uri->segment('4','0');
		$uname = $this->uri->segment('2','0');
		$this->data['user_profile_details'] = $userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$uname));
		if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
			$this->load->view('site/user/display_user_profile_private',$this->data);
		}else {
			$this->data['list_details'] = $list_details = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$this->data['user_profile_details']->row()->id));
			if ($this->data['list_details']->num_rows()==0){
				show_404();
			}else {
				$fieldsArr = '*';
				$searchArr = explode(',', $list_details->row()->followers);
				$this->data['user_details'] = $user_details = $this->product_model->get_fields_from_many(USERS,$fieldsArr,'id',$searchArr);
				if ($user_details->num_rows()>0){
					foreach ($user_details->result() as $userRow){
						$fieldsArr = array(PRODUCT_LIKES.'.*',PRODUCT.'.product_name',PRODUCT.'.image',PRODUCT.'.id as PID');
						$searchArr = array($userRow->id);
						$joinArr1 = array('table'=>PRODUCT,'on'=>PRODUCT_LIKES.'.product_id='.PRODUCT.'.seller_product_id','type'=>'');
						$joinArr = array($joinArr1);
						$sortArr1 = array('field'=>PRODUCT.'.created','type'=>'desc');
						$sortArr = array($sortArr1);
						$this->data['product_details'][$userRow->id] = $this->product_model->get_fields_from_many(PRODUCT_LIKES,$fieldsArr,PRODUCT_LIKES.'.user_id',$searchArr,$joinArr,$sortArr,'5');
					}
				}
				$fieldsArr = array(PRODUCT.'.*',USERS.'.user_name',USERS.'.full_name');
				$searchArr = array_filter(explode(',', $list_details->row()->product_id));
				if (count($searchArr)>0){
					$this->data['totalProducts'] = count($searchArr);
				}else {
					$this->data['totalProducts'] = 0;
				}
				
				$this->load->view('site/user/user_list_followers',$this->data);
			}
		}
	}
	
	/**
	 * 
	 * Display the follow list
	 * 
	 */
	public function follow_list(){
		$returnStr['status_code'] = 0;
		$lid = $this->input->post('lid');
		if ($this->checkLogin('U') != ''){
			$listDetails = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid));
			$followersArr = explode(',', $listDetails->row()->followers);
			$followersCount = $listDetails->row()->followers_count;
			$oldDetails = explode(',', $this->data['userDetails']->row()->following_user_lists);
			if (!in_array($lid, $oldDetails)){
				array_push($oldDetails, $lid);
			}
			if (!in_array($this->checkLogin('U'), $followersArr)){
				array_push($followersArr, $this->checkLogin('U'));
				$followersCount++;
			}
			$this->product_model->update_details(USERS,array('following_user_lists'=>implode(',', $oldDetails)),array('id'=>$this->checkLogin('U')));
			$this->product_model->update_details(LISTS_DETAILS,array('followers'=>implode(',', $followersArr),'followers_count'=>$followersCount),array('id'=>$lid));
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * To update the unfollow list
	 * 
	 */
	public function unfollow_list(){
		$returnStr['status_code'] = 0;
		$lid = $this->input->post('lid');
		if ($this->checkLogin('U') != ''){
			$listDetails = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid));
			$followersArr = explode(',', $listDetails->row()->followers);
			$followersCount = $listDetails->row()->followers_count;
			$oldDetails = explode(',', $this->data['userDetails']->row()->following_user_lists);
			if (in_array($lid, $oldDetails)){
				if ($key = array_search($lid, $oldDetails) !== false){
					unset($oldDetails[$key]);
				}
			}
			if (in_array($this->checkLogin('U'), $followersArr)){
				if ($key = array_search($this->checkLogin('U'), $followersArr) !== false){
					unset($followersArr[$key]);
				}
				$followersCount--;
			}
			$this->product_model->update_details(USERS,array('following_user_lists'=>implode(',', $oldDetails)),array('id'=>$this->checkLogin('U')));
			$this->product_model->update_details(LISTS_DETAILS,array('followers'=>implode(',', $followersArr),'followers_count'=>$followersCount),array('id'=>$lid));
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * To edit the user lists
	 * 
	 */
	public function edit_user_lists(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$lid = $this->uri->segment('4','0');
			$uname = $this->uri->segment('2','0');
			if ($uname != $this->data['userDetails']->row()->user_name){
				show_404();
			}else {
				$this->data['user_profile_details'] = $this->user_model->get_all_details(USERS,array('user_name'=>$uname));
				$this->data['list_details'] = $list_details = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$this->data['user_profile_details']->row()->id));
				if ($this->data['list_details']->num_rows()==0){
					show_404();
				}else {
					$this->data['list_category_details'] = $this->user_model->get_all_details(CATEGORY,array('id'=>$this->data['list_details']->row()->category_id));
					$this->data['heading'] = 'Edit List';
					$this->load->view('site/user/edit_user_list',$this->data);
				}
			}
		}
	}
	
	/**
	 * 
	 * To edit the user lists details
	 * 
	 */
	public function edit_user_list_details(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$lid = $this->input->post('lid');
			$uid = $this->input->post('uid');
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$list_title = $this->input->post('setting-title');
				$catID = $this->input->post('category');
				$duplicateCheck = $this->user_model->get_all_details(LISTS_DETAILS,array('user_id'=>$uid,'id !='=>$lid,'name'=>$list_title));
				if ($duplicateCheck->num_rows()>0){
					$this->setErrorMessage('error','List title already exists');
					echo '<script>window.history.go(-1);</script>';
				}else {
					if ($catID == ''){
						$catID = 0;
					}
					$this->user_model->update_details(LISTS_DETAILS,array('name'=>$list_title,'category_id'=>$catID),array('id'=>$lid,'user_id'=>$uid));
					$this->setErrorMessage('success','List updated successfully');
					echo '<script>window.history.go(-1);</script>';
				}
			}
		}
	}
	
	/**
	 * 
	 * To delete the user lists
	 * 
	 */
	public function delete_user_list(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			$returnStr['message'] = 'Login required';
		}else {
			$lid = $this->input->post('lid');
			$uid = $this->input->post('uid');
			if ($uid != $this->checkLogin('U')){
				$returnStr['message'] = 'You can\'t delete other\'s list';
			}else {
				$list_details = $this->user_model->get_all_details(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$uid));
				if ($list_details->num_rows() == 1){
					$followers_id = $list_details->row()->followers;
					if ($followers_id != ''){
						$searchArr = array_filter(explode(',', $followers_id));
						$fieldsArr = array('following_user_lists','id');
						$followersArr = $this->user_model->get_fields_from_many(USERS,$fieldsArr,'id',$searchArr);
						if ($followersArr->num_rows()>0){
							foreach ($followersArr->result() as $followersRow){
								$listArr = array_filter(explode(',', $followersRow->following_user_lists));
								if (in_array($lid, $listArr)){
									if (($key = array_search($lid, $listArr)) != false){
										unset($listArr[$key]);
										$this->user_model->update_details(USERS,array('following_user_lists'=>implode(',', $listArr)),array('id'=>$followersRow->id));
									}
								}
							}
						}
					}
					$this->user_model->commonDelete(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$this->checkLogin('U')));
					$listCount = $this->data['userDetails']->row()->lists;
					$listCount--;
					if ($listCount == '' || $listCount < 0){
						$listCount = 0;
					}
					$this->user_model->update_details(USERS,array('lists'=>$listCount),array('id'=>$this->checkLogin('U')));
					$returnStr['url'] = base_url().'people/'.$this->data['userDetails']->row()->user_name.'/favorites';
					$list_delete=addslashes(af_lg('lg_list_delete','List deleted successfully'));
	
					$this->setErrorMessage('success',$list_delete);
					$returnStr['status_code'] = 1;
				}else {
					$returnStr['message'] = 'List not available';
				}
			}
		}
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * To crop the images for user profile picture
	 * 
	 */
	public function image_crop(){
		if($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$uid = $this->uri->segment(2,0);
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$this->data['heading'] = 'Cropping Image';
				$this->load->view('site/user/crop_image',$this->data);
			}
		}
	}
	
	/**
	 * 
	 * To crop the images for user profile picture processing
	 * 
	 */
	public function image_crop_process(){
		if($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$targ_w = $targ_h = 240;
			$jpeg_quality = 90;
		
			$src = 'images/users/'.$this->data['userDetails']->row()->thumbnail;
			$ext = substr($src, strpos($src , '.')+1);
			if ($ext == 'png'){
				$jpgImg = imagecreatefrompng($src);
				imagejpeg($jpgImg, $src, 90);
			}
			$img_r = imagecreatefromjpeg($src);
			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
			
//			list($width, $height) = getimagesize($src);
		
			imagecopyresampled($dst_r,$img_r,0,0,$_POST['x1'],$_POST['y1'],	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
//		imagecopyresized($dst_r,$img_r,0,0,$_POST['x1'],$_POST['y1'],	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
//		imagecopyresized($dst_r, $img_r,0,0, $_POST['x1'],$_POST['y1'], $_POST['x2'],$_POST['y2'],1024,980);
//			header('Content-type: image/jpeg');
			imagejpeg($dst_r,'images/users/'.$this->data['userDetails']->row()->thumbnail);
			$this->setErrorMessage('success','Profile photo changed successfully');
			redirect('settings');
			exit;
		}
	}
	
	/**
	 * 
	 * To send the notify mail to followers
	 * param String $followUserDetails
	 * 
	 */
	public function send_noty_mail($followUserDetails=array()){
		if (count($followUserDetails)>0){
			$emailNoty = explode(',', $followUserDetails[0]['email_notifications']);
			if (in_array('following', $emailNoty)){
				$newsid='7';
		  		$template_values=$this->product_model->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array('logo'=> $this->data['logo'],'meta_title'=>$this->config->item('meta_title'),'full_name'=>$followUserDetails[0]['full_name'],'cfull_name'=>$this->data['userDetails']->row()->full_name,'user_name'=>$this->data['userDetails']->row()->user_name);
        extract($adminnewstemplateArr);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
  		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title><body>';
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
									'to_mail_id'=>$followUserDetails[0]['email'],
									'subject_message'=>$subject,
									'body_messages'=>$message
									);
				$email_send_to_common = $this->product_model->common_email_send($email_values);
			}
		}
	}
	
	/**
	 * 
	 * To send the notify mails to followers
	 * param String $followUserDetails
	 * 
	 */
	public function send_noty_mails($followUserDetails=array()){
		if (count($followUserDetails)>0){
			$emailNoty = explode(',', $followUserDetails->email_notifications);
			if (in_array('following', $emailNoty)){
            
            $newsid='9';
		  		$template_values=$this->product_model->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array('logo'=> $this->data['logo'],'meta_title'=>$this->config->item('meta_title'),'full_name'=>$followUserDetails[0]['full_name'],'cfull_name'=>$this->data['userDetails']->row()->full_name,'user_name'=>$this->data['userDetails']->row()->user_name);
        extract($adminnewstemplateArr);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
  		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title><body>';
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
									'to_mail_id'=>$followUserDetails->email,
									'subject_message'=>$subject,
									'body_messages'=>$message
									);
				$email_send_to_common = $this->product_model->common_email_send($email_values);
			}
		}
	}
	
	/**
	 * 
	 * To display the order reviews for user
	 * 
	 */
	public function order_review(){
		if ($this->checkLogin('U')==''){
			show_404();
		}else {
			$uid = $this->uri->segment(2,0);
			$sid = $this->uri->segment(3,0);
			$dealCode = $this->uri->segment(4,0);
			if ($uid == $this->checkLogin('U')){
				$view_mode = 'user';
			}else if ($sid == $this->checkLogin('U')){
				$view_mode = 'seller';
			}else {
				$view_mode = '';
			}
			if ($view_mode == ''){
				show_404();
			}else {
				if ($view_mode == 'seller'){
					$this->db->select('p.*,pAr.attr_name');
					$this->db->from(PAYMENT.' as p');
					$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = p.attribute_values','left');
					$this->db->where('p.sell_id = "'.$sid.'" and p.status = "Paid" and p.dealCodeNumber = "'.$dealCode.'"');
					$order_details = $this->db->get();
					
					//$order_details = $this->user_model->get_all_details(PAYMENT,array('dealCodeNumber'=>$dealCode,'status'=>'Paid','sell_id'=>$sid));
				}else {
				
				//$order_details = $this->user_model->get_all_details(PAYMENT,array('dealCodeNumber'=>$dealCode,'status'=>'Paid'));
					$this->db->select('p.*,pAr.attr_name');
					$this->db->from(PAYMENT.' as p');
					$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = p.attribute_values','left');
					$this->db->where("p.status = 'Paid' and p.dealCodeNumber = '".$dealCode."'");
					$order_details = $this->db->get();

					
				}
				
				if ($order_details->num_rows()==0){
					show_404();
				}else {
					if ($view_mode == 'user'){
						$this->data['user_details'] = $this->data['userDetails'];
						$this->data['seller_details'] = $this->user_model->get_all_details(USERS,array('id'=>$sid));
					}elseif ($view_mode == 'seller'){
						$this->data['user_details'] = $this->user_model->get_all_details(USERS,array('id'=>$uid));
						$this->data['seller_details'] = $this->data['userDetails'];
					}
					foreach ($order_details->result() as $order_details_row){
						$this->data['prod_details'][$order_details_row->product_id] = $this->user_model->get_all_details(PRODUCT,array('id'=>$order_details_row->product_id));
					}
					$this->data['view_mode'] = $view_mode;
					$this->data['order_details'] = $order_details;
					$sortArr1 = array('field'=>'date','type'=>'desc');
					$sortArr = array($sortArr1);
					$this->data['order_comments'] = $this->user_model->get_all_details(REVIEW_COMMENTS,array('deal_code'=>$dealCode),$sortArr);
					$this->load->view('site/user/display_order_reviews',$this->data);
				}
			}
		}
	}
	
	/**
	 * 
	 * To display the order reviews for seller
	 * 
	 */
	public function order_seller_review(){
		if ($this->checkLogin('U')==''){
			show_404();
		}else {
			$uid = $this->uri->segment(2,0);
			$sid = $this->uri->segment(3,0);
			$dealCode = $this->uri->segment(4,0);
			if ($uid == $this->checkLogin('U')){
				$view_mode = 'user';
			}else if ($sid == $this->checkLogin('U')){
				$view_mode = 'seller';
			}else {
				$view_mode = '';
			}
			if ($view_mode == ''){
				show_404();
			}else {
				if ($view_mode == 'seller'){
					$this->db->select('p.*');
					$this->db->from(USER_PAYMENT.' as p');
					$this->db->where('p.sell_id = "'.$sid.'" and p.status = "Paid" and p.dealCodeNumber = "'.$dealCode.'"');
					$order_details = $this->db->get();
					
					//$order_details = $this->user_model->get_all_details(PAYMENT,array('dealCodeNumber'=>$dealCode,'status'=>'Paid','sell_id'=>$sid));
				}else {
				
				//$order_details = $this->user_model->get_all_details(PAYMENT,array('dealCodeNumber'=>$dealCode,'status'=>'Paid'));
					$this->db->select('p.*');
					$this->db->from(USER_PAYMENT.' as p');
					$this->db->where("p.status = 'Paid' and p.dealCodeNumber = '".$dealCode."'");
					$order_details = $this->db->get();

					
				}
				
				if ($order_details->num_rows()==0){
					show_404();
				}else {
					if ($view_mode == 'user'){
						$this->data['user_details'] = $this->data['userDetails'];
						$this->data['seller_details'] = $this->user_model->get_all_details(USERS,array('id'=>$sid));
					}elseif ($view_mode == 'seller'){
						$this->data['user_details'] = $this->user_model->get_all_details(USERS,array('id'=>$uid));
						$this->data['seller_details'] = $this->data['userDetails'];
					}
					foreach ($order_details->result() as $order_details_row){
						$this->data['prod_details'][$order_details_row->product_id] = $this->user_model->get_all_details(USER_PRODUCTS,array('id'=>$order_details_row->product_id));
					}
					$this->data['view_mode'] = $view_mode;
					$this->data['order_details'] = $order_details;
					$sortArr1 = array('field'=>'date','type'=>'desc');
					$sortArr = array($sortArr1);
					$this->data['order_comments'] = $this->user_model->get_all_details(REVIEW_COMMENTS,array('deal_code'=>$dealCode),$sortArr);
					$this->load->view('site/user/display_order_reviews',$this->data);
				}
			}
		}
	}
	
	
	/**
	 * 
	 * Seller shop product settings
	 * 
	 */
	public function shop_temp() 
	{
    	extract($_POST);
			if ($this->checkLogin('U')!=''){
				 
				$this->user_model->updateUserQuickTemp();
				$this->setErrorMessage('success','Shop Product Setup Updated Successfully');	
				redirect('settings');
				
			}else {
				$this->data['next'] = $this->input->get('next');
				//echo $this->data['next'];die;
				$this->data['heading'] = 'Sign in'; 
				$this->load->view('site/user/signup.php',$this->data);
			}

  	}
	
	
	/**
	 * 
	 * To display the poost comments
	 * 
	 */
	public function post_order_comment(){
		if ($this->checkLogin('U') != ''){
			$this->user_model->commonInsertUpdate(REVIEW_COMMENTS,'insert',array(),array(),'');
		}
	}
	
	/**
	 * 
	 * To change the received status
	 * 
	 */
	public function change_received_status(){
		if ($this->checkLogin('U')!=''){
			$status = $this->input->post('status');
			$rid = $this->input->post('rid');
			$this->user_model->update_details(PAYMENT,array('received_status'=>$status),array('id'=>$rid));
		}
	}
	
	/**
	 * 
	 * To update the favorite status 
	 * 
	 */
	public function update_favorite_status(){
		if ($this->checkLogin('U')!=''){
			$status = $this->input->post('status');
			$rid = $this->input->post('rid');
			$this->user_model->commonDelete(FAVORITE,array('received_status'=>$status),array('id'=>$rid));
		}
	}
	
	/**
	 * 
	 * To insert the favorite status
	 * param String $shopid
	 * param String $type
	 * 
	 */
	
	public function insert_favorite_status($shopid='',$type=''){
		$returnStr['status_code'] = 0;
		if($shopid!=''){
			$rdir=1;
		}
		if ($this->checkLogin('U')!=''){
			$userid = $this->checkLogin('U');
			if($shopid==''){
				$shopid = $this->input->post('shopid');
			}
			
			if($shopid == $this->checkLogin('U')){
				$returnStr['status_code'] = 2; 
				echo json_encode($returnStr);  die;
			}
			
			
			if($type==''){
			$type = $this->input->post('type');}
			if($type == 'Fresh'){
				$checkShopStaus = $this->user_model->get_all_details(FAVORITE,array('shop_id'=>$shopid,'user_id'=>$userid,'favorite'=>'Yes'));
				if ($checkShopStaus->num_rows() < 1){
					$dataArr = array('shop_id'=>$shopid,'user_id'=>$userid,'favorite'=>'Yes');
					$this->user_model->simple_insert(FAVORITE,$dataArr);
					# addding favorites shop count and add to activity table
					$checkShopLike = $this->user_model->get_all_details(FAVORITE,array('shop_id'=>$shopid));
					if ($checkShopLike->num_rows() > 0){
						$userDetails = $this->user_model->get_all_details(USERS,array('id'=>$shopid));
						if ($userDetails->num_rows()>0){
							$likes = $userDetails->row()->likes;
							$actArr = array(
								'activity_name'	=>	'favorite shop',
								'activity_id'	=>	$shopid,
								'user_id'		=>	$this->checkLogin('U'),
								'activity_time'		=>time(),
								'activity_ip'	=>	$this->input->ip_address()
							);
							$checkShopStatus = $this->user_model->get_all_details(USER_ACTIVITY,array('activity_id'=>$shopid,'user_id'=>$this->checkLogin('U')));
							if ($checkShopStatus->num_rows() < 1){
							$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
							}
							else
							{
								$this->user_model->commonDelete(USER_ACTIVITY,array('activity_id'=>$shopid,'user_id'=>$this->checkLogin('U')));
								$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
							}
							
							$this->user_model->commonDelete(NOTIFICATIONS,array('activity'=>'favorite shop','activity_id'=>$shopid,'user_id'=>$this->checkLogin('U')));
							$this->user_model->commonDelete(NOTIFICATIONS,array('activity'=>'unfavorite shop','activity_id'=>$shopid,'user_id'=>$this->checkLogin('U')));
							$actArr = array('activity'=>'favorite shop',
													'activity_id'=>$shopid,
													'user_id'	=>$userid,
													'activity_ip'=>$this->input->ip_address(),
													'created'=>date("Y-m-d H:i:s"));
							$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
							
							
							$likes++;
							$dataArr = array('likes'=>$likes);
							$condition = array('id'=>$shopid);
							$this->user_model->update_details(USERS,$dataArr,$condition);					
							#$returnStr['status_code'] = 1;
						}
					}
				}
				//$seller_id_fav=$this->user_model->get_all_details(SELLER,array('id'=
				$sent_email=$this->user_model->get_all_details(USERS,array('id'=>$shopid));//,'fav_shop'=>'Yes'));
				$noty_email_arr=explode(',',$sent_email->row()->notification_email);
				if(in_array('fav_shop',$noty_email_arr)){
					//$query=$this->user_model->get_all_details(USERS, array('id'= $follow_id));
					$full_name=$sent_email->row()->full_name;
					$cfull_name=$this->data['userDetails']->row()->full_name;
					$user_name=$this->data['userDetails']->row()->user_name;
					$newsid='31';
					$template_values=$this->user_model->get_newsletter_template_details($newsid);

					$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
					extract($adminnewstemplateArr);
					$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
					$message .= '<!DOCTYPE HTML>
						<html>
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
						<meta name="viewport" content="width=device-width"/>
						<title>'.$template_values['news_subject'].'</title>
						<body>';
					include('./newsletter/registeration'.$newsid.'.php');	
					
					$message .= '</body>
						</html>';
						

					if($template_values['sender_name']=='' && $template_values['sender_email']==''){
						$sender_email=$this->config->item('site_contact_mail');
						
						$sender_name=$this->config->item('email_title');
					}else{
						$sender_name=$template_values['sender_name'];
						$sender_email=$template_values['sender_email'];
					}
					$email_values = array('mail_type'=>'html',
										'from_mail_id'=>$sender_email,
										'mail_name'=>$sender_name,
										'to_mail_id'=>$sent_email->row()->email,
										'subject_message'=>'Shop favorite',
										'body_messages'=>$message
										);
										
					//echo '<pre>'; print_r($email_values); die;

					$email_send_to_common = $this->product_model->common_email_send($email_values);#die;
				}
				$add_shopfav_list=addslashes(af_lg('lg_add_shopfav_list','This Shop Added to Your Favorite List!'));
				//$this->setErrorMessage('success',$add_shopfav_list);	
				$returnStr['status_code'] = 1;
				/*Push Message Starts*/
				$message=$this->session->userdata('shopsy_session_user_name').' favorited your shop on '.$this->config->item('email_title');
				$type='favorite shop';
				$this->sendPushNotification($shopid,$message,$type,array($userid));
				/*Push Message Ends*/	
				if($rdir){
					redirect('people/'.$this->session->userdata('shopsy_session_user_name').'/favorites/shop');
				}
			}else if($type == 'Old'){
				# Updating favorites shop count and update to activity table
				$checkShopLike = $this->user_model->get_all_details(FAVORITE,array('shop_id'=>$shopid));
				if ($checkShopLike->num_rows() > 0){
				$userDetails = $this->user_model->get_all_details(USERS,array('id'=>$shopid));
				if ($userDetails->num_rows()>0){
					$likes = $userDetails->row()->likes;
					$actArr = array(
						'activity_name'	=>	'Unfavorite shop',
						'activity_id'	=>	$shopid,
						'user_id'		=>	$this->checkLogin('U'),
						'activity_time'		=>time(),
						'activity_ip'	=>	$this->input->ip_address()
					);
					$condition = array('activity_id'=>$shopid,'user_id'=>$this->checkLogin('U'));
					$this->user_model->update_details(USER_ACTIVITY,$actArr,$condition);		
					//print_r($this->user_model->db->last_query());
					$this->user_model->commonDelete(NOTIFICATIONS,array('activity'=>'favorite shop','activity_id'=>$shopid,'user_id'=>$this->checkLogin('U')));
					$this->user_model->commonDelete(NOTIFICATIONS,array('activity'=>'unfavorite shop','activity_id'=>$shopid,'user_id'=>$this->checkLogin('U')));
					$actArr = array('activity'=>'unfavorite shop',
													'activity_id'=>$shopid,
													'user_id'	=>$userid,
													'activity_ip'=>$this->input->ip_address(),
													'created'=>date("Y-m-d H:i:s"));
					$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
					
					$likes--;
					$dataArr = array('likes'=>$likes);
					$condition = array('id'=>$shopid);
					$this->user_model->update_details(USERS,$dataArr,$condition);					
					#$returnStr['status_code'] = 1;
				}
				$remove_shop =af_lg('lg_remove_shop','This Shop Removed From Your Favorite List!');
				$this->user_model->fav_delete($userid,$shopid);
				//$this->setErrorMessage('success',$remove_shop);
				if($rdir){
					redirect('people/'.$this->session->userdata('shopsy_session_user_name').'/favorites/shop');
				}
				
			}
			$returnStr['status_code'] = 1;			
			}
		}
		else
		{
		$lg_login_reg_toadd_shopto_fav=addslashes(af_lg('lg_login_reg_toadd_shopto_fav','Login Required for Adding this shop to your favorites'));
			$this->setErrorMessage('error',$lg_login_reg_toadd_shopto_fav);
			$returnStr['status_code'] = 0;
			$returnStr['next_url']=urlencode('site/user/insert_favorite_status/'.$this->input->post('shopid').'/'.$this->input->post('type'));
		}
		echo json_encode($returnStr);
	}	
	
	
	/**
	 * 
	 * To add the product favorite list
	 * param String $pid
	 * param String $type 
	 * 
	 */
	public function product_favorite_status($pid='',$type=''){
		
		error_reporting(0);
		$returnStr['status_code'] = 0;
		if($type!=''){
			$rdir = 1;
		}
		if ($this->checkLogin('U')!=''){
			$userid = $this->checkLogin('U');
			if($pid==''){
				$pid = $this->input->post('pid');
			}
			$productDetails = $this->user_model->get_all_details(PRODUCT,array('id'=>$pid));
			if($productDetails->row()->user_id == $this->checkLogin('U')){
				$returnStr['status_code'] = 2; 
				//$this->setErrorMessage('error','You Can\t favorite your own item.');
				echo json_encode($returnStr);  die;
			}
			if($type==''){
			$type = $this->input->post('type');
			}//echo $type;die;
			if($type == 'Fresh'){
				//echo "afdgf";die;
				$checkFavStatus = $this->user_model->get_all_details(FAVORITE,array('p_id'=>$pid,'user_id'=>$userid,'favorite'=>'Yes'));
				if ($checkFavStatus->num_rows() < 1){
					$favorite_list=$this->product_model->get_all_details(FAVORITE,array('p_id'=>$p_id));
					foreach($favorite_list->result() as $fav_list){
						#echo "<pre>";print_r($fav_list);#die;
						$sentfav_list=$this->product_model->get_all_details(USERS, array('id'=>$fav_list->user_id));//'like_of_like'=>'Yes'));						
						//echo $this->db->last_query();
						//echo "<pre>";print_r($sentfav_list->row());die;
						if($sentfav_list->num_rows >0){
						$noty_email_arr=explode(',',$sentfav_list->row()->notification_email);
						#echo "<pre>";print_r($noty_email_arr);#die;
						if(in_array('lik_of_like',$noty_email_arr)){	
							$full_name=$sentfav_list->row()->full_name;
								#echo "<pre>";print_r($this->data['userDetails']);die;
								$user_name=$this->data['userDetails']->row()->full_name;
								$product_seo=$productDetails->row()->seourl;
								
								$newsid='30';
								
								$template_values=$this->user_model->get_newsletter_template_details($newsid);

								$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'meta_title'=>$this->config->item('meta_title'));
								extract($adminnewstemplateArr);
								$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
								$message .= '<!DOCTYPE HTML>
									<html>
									<head>
									<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
									<meta name="viewport" content="width=device-width"/>
									<title>'.$template_values['news_subject'].'</title>
									<body>';
									$bp=base_url();
									#echo $bp;die;
								include_once('./newsletter/registeration'.$newsid.'.php');	
								
								$message .= '</body>
									</html>';
									

								if($template_values['sender_name']=='' && $template_values['sender_email']==''){
									$sender_email=$this->config->item('site_contact_mail');
									
									$sender_name=$this->config->item('email_title');
								}else{
									$sender_name=$template_values['sender_name'];
									$sender_email=$template_values['sender_email'];
								}
								$email_values = array('mail_type'=>'html',
													'from_mail_id'=>$sender_email,
													'mail_name'=>$sender_name,
													'to_mail_id'=>$sentfav_list->row()->email,
													'subject_message'=>'Favourite',
													'body_messages'=>$message
												);
													
								#echo '<pre>'; print_r($email_values); die;

								$email_send_to_common = $this->product_model->common_email_send($email_values);#die;
						}
					}
					$dataArr = array('p_id'=>$pid,'user_id'=>$userid,'favorite'=>'Yes');
					$this->user_model->simple_insert(FAVORITE,$dataArr);	
					
					# addding favorites count and add to activity table
					$checkProductLike = $this->user_model->get_all_details(FAVORITE,array('p_id'=>$pid));
					if ($checkProductLike->num_rows() > 0){						
						if ($productDetails->num_rows()>0){
							$likes = $productDetails->row()->likes;
							$actArr = array(
								'activity_name'	=>	'favorite item',
								'activity_id'	=>	$pid,
								'user_id'		=>	$this->checkLogin('U'),
								'activity_time'		=>time(),
								'activity_ip'	=>	$this->input->ip_address()
							);
							$checkProductStatus = $this->user_model->get_all_details(USER_ACTIVITY,array('activity_id'=>$pid,'user_id'=>$this->checkLogin('U')));
							if ($checkProductStatus->num_rows() < 1){
							$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
							}
							else
							{
								$this->user_model->commonDelete(USER_ACTIVITY,array('activity_id'=>$pid,'user_id'=>$this->checkLogin('U')));
								$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
							}
							
							$this->user_model->commonDelete(NOTIFICATIONS,array('activity'=>'favorite item','activity_id'=>$pid,'user_id'=>$this->checkLogin('U')));
							$this->user_model->commonDelete(NOTIFICATIONS,array('activity'=>'unfavorite item','activity_id'=>$pid,'user_id'=>$this->checkLogin('U')));
							$actArr = array('activity'=>'favorite item',
													'activity_id'=>$pid,
													'user_id'	=>$userid,
													'activity_ip'=>$this->input->ip_address(),
													'created'=>date("Y-m-d H:i:s"));
							$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
							
							$likes++;
							$dataArr = array('likes'=>$likes);
							$condition = array('id'=>$pid);
							$this->user_model->update_details(PRODUCT,$dataArr,$condition);					
							$returnStr['status_code'] = 1;
							$shopid = $productDetails->row()->user_id;
							/*Push Message Starts*/
							$message=$this->session->userdata('shopsy_session_user_name').' favorited your item on '.$this->config->item('email_title');
							$type='favorite item';
							$this->sendPushNotification($shopid,$message,$type,array($pid));
							/*Push Message Ends*/	
							$sent_email=$this->user_model->get_all_details(USERS,array('id'=>$shopid));//,'like'=>'Yes'));
							$noty_email_arr=explode(',',$sent_email->row()->notification_email);
							if(in_array('like',$noty_email_arr)){													
								$full_name=$sent_email->row()->full_name;
								#echo "<pre>";print_r($this->data['userDetails']);die;
								$user_name=$this->data['userDetails']->row()->full_name;
								$product_seo=$productDetails->row()->seourl;
								
								$newsid='29';
								
								$template_values=$this->user_model->get_newsletter_template_details($newsid);

								$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'meta_title'=>$this->config->item('meta_title'));
								extract($adminnewstemplateArr);
								$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
								$message .= '<!DOCTYPE HTML>
									<html>
									<head>
									<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
									<meta name="viewport" content="width=device-width"/>
									<title>'.$template_values['news_subject'].'</title>
									<body>';
								include('./newsletter/registeration'.$newsid.'.php');	
								
								$message .= '</body>
									</html>';
									

								if($template_values['sender_name']=='' && $template_values['sender_email']==''){
									$sender_email=$this->config->item('site_contact_mail');
									
									$sender_name=$this->config->item('email_title');
								}else{
									$sender_name=$template_values['sender_name'];
									$sender_email=$template_values['sender_email'];
								}
								$email_values = array('mail_type'=>'html',
													'from_mail_id'=>$sender_email,
													'mail_name'=>$sender_name,
													'to_mail_id'=>$sent_email->row()->email,
													'subject_message'=>'Favourite',
													'body_messages'=>$message
												);
													
								//echo '<pre>'; print_r($email_values); die;

								$email_send_to_common = $this->product_model->common_email_send($email_values);#die;
							}
						}
					}
					}
					// echo "finished";
				$returnStr['status_code'] = 1;
				$returnStr['fav'] = 1;
				
				}
				if($this->lang->line('product_add_fav') != '') { $product_add_fav= stripslashes($this->lang->line('product_add_fav')); } else { $product_add_fav = "Product Added to Favorite List!"; }
				//$this->setErrorMessage('success',$product_add_fav);
				if($rdir){
					redirect('people/'.$this->session->userdata('shopsy_session_user_name').'/favorites/items-i-love');		
				}
			}else if($type == 'Old'){
				$checkFavStatus = $this->user_model->get_all_details(FAVORITE,array('p_id'=>$pid,'user_id'=>$userid,'favorite'=>'Yes'));
				if ($checkFavStatus->num_rows() > 0){
					# Updating favorites count and update to activity table
					$checkProductLike = $this->user_model->get_all_details(FAVORITE,array('p_id'=>$pid));
					
					if ($checkProductLike->num_rows() > 0){
					$productDetails = $this->user_model->get_all_details(PRODUCT,array('id'=>$pid));
					if ($productDetails->num_rows()>0){
						$likes = $productDetails->row()->likes;
						$actArr = array(
							'activity_name'	=>	'Unfavorite item',
							'activity_id'	=>	$pid,
							'user_id'		=>	$this->checkLogin('U'),
							'activity_time'		=>time(),
							'activity_ip'	=>	$this->input->ip_address()
						);
						$condition = array('activity_id'=>$pid,'user_id'=>$this->checkLogin('U'));
						$this->user_model->update_details(USER_ACTIVITY,$actArr,$condition);		
						
						$this->user_model->commonDelete(NOTIFICATIONS,array('activity'=>'favorite item','activity_id'=>$pid,'user_id'=>$this->checkLogin('U')));
						$this->user_model->commonDelete(NOTIFICATIONS,array('activity'=>'unfavorite item','activity_id'=>$pid,'user_id'=>$this->checkLogin('U')));
						$actArr = array('activity'=>'unfavorite item',
													'activity_id'=>$pid,
													'user_id'	=>$userid,
													'activity_ip'=>$this->input->ip_address(),
													'created'=>date("Y-m-d H:i:s"));
						$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
													
						$likes--;
						$dataArr = array('likes'=>$likes);
						$condition = array('id'=>$pid);
						$this->user_model->update_details(PRODUCT,$dataArr,$condition);					
						$returnStr['status_code'] = 1;
						$returnStr['fav'] = 1;
					}
					$this->user_model->product_fav_delete($userid,$pid);
					if($this->lang->line('product_remove_fav') != '') { $product_remove_fav= stripslashes($this->lang->line('product_remove_fav')); } else { $product_remove_fav = "Product Removed from Favorite List!"; }
					//$this->setErrorMessage('success',$product_remove_fav);
					if($rdir){
						redirect('people/'.$this->session->userdata('shopsy_session_user_name').'/favorites/items-i-love');
					}
				}
				$returnStr['status_code'] = 1;
				
			}
			$returnStr['status_code'] = 1;
		}
		}
		else
		{
		$login_required=addslashes(af_lg('lg_login req to add this product','Login Required for Adding this product to your favorites'));
			$this->setErrorMessage('error',$login_required);
			$returnStr['status_code'] = 0;
			$returnStr['next_url'] =urlencode('site/user/product_favorite_status/'.$this->input->post('pid').'/'.$this->input->post('type'));
			
		}
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * To view the people favorite list
	 * 
	 */
	public function people_favorite_list(){ 
		#echo 'KL';  die;
		#if ($this->checkLogin('U')!=''){
			$this->data['currUser']=$checkloginIDarr=$this->session->all_userdata(); 
		 	$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
			$username =  urldecode($this->uri->segment(2,0));
			$userDetails= $this->user_model->get_all_details(USERS,array('user_name'=>$username))->result_array();
			$uid=$userDetails[0]['id'];
			$this->data['userProfileDetailsAll']=$userProfileDetailsAll = $this->user_model->get_all_details(USERS,array('id'=>$userDetails[0]['id'],'status'=>'Active'))->result_array();
			$this->data['userFavoriteItems']=$userFavoriteItems = $this->product_model->getFavoriteProduct($userDetails[0]['id'])->result_array();
			#echo $this->db->last_query();die;
			$this->data['userListDetails']=$userListDetails = $this->user_model->get_all_details(LISTS_DETAILS,array('user_id'=>$userDetails[0]['id']))->result_array();
			#echo "<pre>"; print_r($userListDetails); die;
			if(sizeof($userFavoriteItems)>0){
			if($_GET['a']){
				$search_key=$_GET['a'];				
				$this->data['searchtProducts']= $searchtProducts= $this->user_model->get_search_favorite_list($search_key,$uid)->result_array();
				#echo "<pre>"; print_r($searchtProducts); die;
			}
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->data['userProfileDetails'] = $this->user_model->get_all_details(USERS,array('user_name'=>$username))->result_array();
		
			$this->data['heading'] = $username.' Favorites on '.$this->config->item('email_title');
			$this->load->view('site/user/favorites',$this->data);
			
		}else{

					redirect('');

		}		
			
		#}
		
	}
	
	/**
	 * 
	 * To view the people favorite list and view the favorite list items
	 * 
	 */
	public function people_favorite_list_itemsilove(){//die;
		#if ($this->checkLogin('U')!=''){
			$this->data['currUser']=$checkloginIDarr=$this->session->all_userdata(); 
		 	$this->data['loggeduserID']=$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
			$username =  urldecode($this->uri->segment(2,0));
			$userDetails= $this->user_model->get_all_details(USERS,array('user_name'=>$username))->result_array();
			$userDetails[0]['id'];
				$condition='';
				if($_GET['a']){
					$search_key=$_GET['a'];
					$condition="p.product_name LIKE '%".$search_key."%' and";
				}	
				if($_GET['filter']){
					$condition="p.status='Publish' and p.quantity>2 and";
				}
			$this->data['userProfileDetails']=$userProfileDetails = $this->user_model->get_all_details(USERS,array('id'=>$userDetails[0]['id'],'status'=>'Active'))->result_array();
			$this->data['userFavoriteItems']=$userFavoriteItems = $this->product_model->getFavoriteProduct($userDetails[0]['id'],$condition,8,0)->result_array();
			#echo "<pre>"; print_r($userProfileDetails); print_r($userFavoriteItems); die;
			$this->data['heading'] = 'Items I love by '.$username.' on '.$this->config->item('email_title');
			$this->load->view('site/user/itemsilove',$this->data);
			
		#}
		
	}
	
	/**
	 * 
	 * To view the people favorite list 
	 * 
	 */
	
	public function people_list_items(){
		#if ($this->checkLogin('U')!=''){
			$urlValArr=$this->uri->segment_array();
			$urlVal=explode('-',$urlValArr[count($urlValArr)]);
			$this->data['listId']=$listId=$urlVal[0];
			#$this->data['listName']=$listName=$urlVal[1];
			$listProduct=array();
			$this->data['listProductVal']=$listProductVal= $this->user_model->get_all_details(LISTS_DETAILS,array('id'=>$listId))->result_array();
			$this->data['listName']=$listName=$listProductVal[0]['name'];
			#echo '<pre>'; print_r($listProductVal); die;
			$products=explode(',',$listProductVal[0]['product_id']);
			for($i=0;$i<count($products);$i++)
			{	
				$condition='';
				if($_GET['a']){
					$search_key=$_GET['a'];
					$condition="p.product_name LIKE '%".$search_key."%' and";
				}
				if($_GET['filter']){
					$condition="p.status='Publish' and p.quantity>0 and";
				}
				$listProduct=array_merge($listProduct,$this->product_model->get_list_product_details($products[$i],$condition)->result_array());
				#echo $this->db->last_query();
			}
			#die;
			$this->data['listProduct']=$listProduct;
			$checkloginIDarr=$this->session->all_userdata(); 
		 	$this->data['loggeduserID']= $loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
			$username =  urldecode($this->uri->segment(2,0));
			$userDetails= $this->user_model->get_all_details(USERS,array('user_name'=>$username))->result_array();
			$userDetails[0]['id'];
			$this->data['userProfileDetails']=$userProfileDetails = $this->user_model->get_all_details(USERS,array('id'=>$userDetails[0]['id'],'status'=>'Active'))->result_array();
			$this->data['heading'] = $urlVal[1].' by '.$username.' on '.$this->config->item('email_title');
			$this->load->view('site/user/favorites_list_items',$this->data);
			
		#}
		
	}
	
	/**
	 * 
	 * To view the people favorite shop list 
	 * 
	 */
	public function people_favorite_shoplist(){
		#if ($this->checkLogin('U')!=''){
			$this->data['currUser']=$checkloginIDarr=$this->session->all_userdata(); 
		 	$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
			$username =  urldecode($this->uri->segment(2,0));
			$this->data['userDetails']=$userDetails= $this->user_model->get_all_details(USERS,array('user_name'=>$username))->result_array();
			#$userDetails[0]['id'];
			$this->data['userProfileDetails']=$userProfileDetails = $this->user_model->get_all_details(USERS,array('id'=>$userDetails[0]['id'],'status'=>'Active'))->result_array();
			$this->data['userFavoriteShops']=$userFavoriteShops = $this->product_model->getFavoriteShops($userDetails[0]['id'])->result_array();
			$userFavoriteShopsProducts=array();
			foreach($userFavoriteShops as $shops)
			{
				$condition="p.user_id=".$shops['seller_id']." GROUP BY p.id";
				$products=$this->product_model->get_product_from_favorite_shop($condition)->result_array();
				//echo $this->db->last_query(); die;
				$userFavoriteShopsProducts=array_merge($userFavoriteShopsProducts,$products);	
				#echo "<pre>"; print_r($this->data["'shop_'".$shop_product.'"']);
			}
			$this->data['userFavoriteShopsProducts']=$userFavoriteShopsProducts ;
			#echo "<pre>"; print_r($userProfileDetails); print_r($userFavoriteShops); print_r($userFavoriteShopsProducts); die;
			$username =  urldecode($this->uri->segment(2,0));
			$userProfileDetails =$this->data['userProfileDetails']= $this->user_model->get_all_details(USERS,array('user_name'=>$username));
			$this->data['heading'] = $username.'\'s Favorites on '.$this->config->item('email_title');
			$this->load->view('site/user/favorite_shop',$this->data);
			
		#}
		
	}	
	
	/**
	 * 
	 * User AddEdit products to List
	 * 
	 */
	public function user_addproducttolist(){
		if ($this->checkLogin('U')!=''){
			$listId=$this->input->post('listId');
			$prodId=$this->input->post('prodId');
			echo '/'.$listId; echo '/'.$prodId;
			$this->data['listProduct']=$listProduct = $this->user_model->get_all_details(LISTS_DETAILS,array('id'=>$listId))->result_array();
			$productArr=explode(',',$listProduct[0]['product_id']);
			if(in_array($prodId,$productArr))
			{ 
				$newproductlist=str_replace($prodId.',','',$listProduct[0]['product_id']);
				$productCount=$listProduct[0]['product_count']-1; 
				 
			}
			else
			{ 
				$newproductlist=$listProduct[0]['product_id'].$prodId.','; $productCount=$listProduct[0]['product_count']+1; 
			}
			$ur_list_updated=addslashes(af_lg('lg_your list_updated','Your List has been updated'));
			//echo "<pre>"; print_r($listProduct); print_r($productArr);  echo $newproductlist;echo '/'.$productCount; die;
			$this->user_model->update_details(LISTS_DETAILS,array('product_id'=>$newproductlist,'product_count'=>$productCount),array('id'=>$listId));
			$this->setErrorMessage('success',$ur_list_updated);
			
		}
	}
	
	/**
	 * 
	 * update user favorite status
	 * param Int $id
	 * 
	 */
	public function update_user_favorite_status($id=''){		
		if ($this->checkLogin('U')!=''){
			$username =  urldecode($this->uri->segment(2,0));
			
			$privacy_level=$this->input->post('privacy_level');
			
				$dataArr = array('favorites_visibility'=>$privacy_level);
				$condition = array('id'=>$this->session->userdata('shopsy_session_user_id'));
				#echo "<pre>"; print_r($dataArr); print_r($condition); die;
				$this->user_model->update_details(USERS,$dataArr,$condition);
				
	         	$list_updated_successfully=addslashes(af_lg('lg_List_Updated_successfully','List Updated successfully'));
						
				$this->setErrorMessage('success',$list_updated_successfully);
				redirect('/people/'.$this->session->userdata('shopsy_session_user_name').'/favorites/items-i-love');
			
		}
		else
		{
			$this->setErrorMessage('error','Login Required');
			redirect('login');
		}
	}
	
	/**
	 * 
	 * update user favorite shop visibility
	 * param Int $id
	 * 
	 */
	public function update_user_favorite_shop_staus($id=''){		
		if ($this->checkLogin('U')!=''){
			$username =  urldecode($this->uri->segment(2,0));
			
			$privacy_level=$this->input->post('privacy_level');
			
				$dataArr = array('shop_visibility'=>$privacy_level);
				$condition = array('id'=>$this->session->userdata('shopsy_session_user_id'));
				#echo "<pre>"; print_r($dataArr); print_r($condition); die;
				$this->user_model->update_details(USERS,$dataArr,$condition);	
                 $shop_visiblity=addslashes(af_lg('lg_your_shop_visible_changed','your shop visibilty changed successfully'));				
						
				$this->setErrorMessage('success', $shop_visiblity);
				redirect('/people/'.$this->session->userdata('shopsy_session_user_name').'/favorites/shop');
			
		}
		else
		{
			$this->setErrorMessage('error','Login Required');
			redirect('login');
		}
	}
	
	/**
	 * 
	 * Contact Shop Owner Check product popup function  
	 * 
	 */
	public function contactshop(){
	
		$usrId = $this->input->post('usrId'); 
		$orderId = $this->input->post('orderId'); 
		
		$userPurchase=$this->user_model->get_user_purchase_list($usrId,$orderId);
		$purchaseProducts=$userPurchase->result();
		$UserVal = $this->user_model->get_all_details(USERS,array( 'id' => $this->data['common_user_id']));	
		
		
		if($purchaseProducts[0]->thumbnail !=''){
			$srcVal = 'images/users/'.$purchaseProducts[0]->thumbnail;
			
		}else{
			$srcVal = 'images/default_avat.png';
		}
		$datestring ="%M %d,%Y "; $time = $purchaseProducts[0]->inserttime;
		$transactionon=mdate($datestring,$time);
		
		$popupVal = '<form name="contactshopowener" id="contactshopowener" method="post" action="site/user/purchasecontactshopowner">
					<div class="conversation">
					<div class="conversation_container">
					<h2 class="conversation_headline">New conversation with '.ucfirst($purchaseProducts[0]->full_name).' from '.ucfirst($purchaseProducts[0]->shopname).'</h2>
					<div class="conversation_thumb"><img width="75" height="75" src="'.$srcVal.'"></div>
					<div class="conversation_right">
					
					<input class="conversation-subject" type="text" name="subject" placeholder="Subject" value="Re: Order #'.$purchaseProducts[0]->dealCodeNumber.' on '.$transactionon.'">
	    			<textarea class="conversation-textarea" rows="11" name="message_text" placeholder="Message text">Invoice: '.base_url().'view-order/'.$UserVal->row()->id.'/'.$purchaseProducts[0]->dealCodeNumber.'</textarea>
					
					<input type="hidden" name="username" id="username" value="'.$UserVal->row()->full_name.'" >
					<input type="hidden" name="useremail" id="useremail" value="'.$UserVal->row()->email.'" >
					<input type="hidden" name="userid" id="userid" value="'.$UserVal->row()->id.'" >
					<input type="hidden" name="selleremail" id="selleremail" value="'.$purchaseProducts[0]->seller_email.'" >
					<input type="hidden" name="sellerid" id="sellerid" value="'.$purchaseProducts[0]->sell_id.'" >
					<input type="hidden" name="dealcode_number" id="dealcode_number" value="'.$purchaseProducts[0]->dealCodeNumber.'" >
					<input type="hidden" name="subject_name" id="subject_name" value="New conversation with '.ucfirst($purchaseProducts[0]->full_name).' from '.ucfirst($purchaseProducts[0]->shopname).'">
					
  				</div> 				
					<div class="modal-footer footer_tab_footer">
						<div class="btn-group">
							<input class="submit_btn" type="submit" value="send">
								<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel">Cancel</a>
						</div>
					</div>	
				
    			</div>
			    </div>
				
				
				</form>';
				
		echo $popupVal;		
		
		return;
	
	}
	
	/**
	 * 
	 * Contact Shop Owner Check product shop owners
	 * 
	 */
	public function purchasecontactshopowner(){
		#echo "<pre>";print_r($this->input->post());die;
		$dataArr = array('username'=>$this->input->post('username'),'useremail'=>$this->input->post('useremail'),'user_id'=>$this->input->post('userid'),'selleremail'=>$this->input->post('selleremail'),'sellerid'=>$this->input->post('sellerid'),'dealcode_number'=>$this->input->post('dealcode_number'),'description'=>$this->input->post('message_text'));
		$tid=time();
		$this->user_model->simple_insert(CONTACTSHOPSELLER,$dataArr);
		$dataArry = array('sender_email'=>$this->input->post('useremail'),'sender_id'=>$this->input->post('userid'),'receiver_email'=>$this->input->post('selleremail'),'receiver_id'=>$this->input->post('sellerid'),'subject'=>$this->input->post('subject'),'message'=>$this->input->post('message_text'),'dataAdded'=>date('Y-m-d H:i:s'),'tid'=>$tid);
		$this->user_model->simple_insert(CONTACTPEOPLE,$dataArry);
		$actArr = array('activity'=>"message",
								'activity_id'=>$this->input->post('sellerid'),
								'user_id'	=>$this->input->post('userid'),
								'activity_ip'=>$this->input->ip_address(),
								'created'=>date("Y-m-d H:i:s"),
								'comment_id'=>$tid);
		$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
		
		$receiver_id=$this->input->post('sellerid');
		$sender_id=$this->input->post('userid');
		/*Push Message Starts*/
		$message='You received a message from '.$this->input->post('username').' on '.$this->config->item('email_title');
		$type='contact';
		$this->sendPushNotification($receiver_id,$message,$type,array($tid,$sender_id));
		/*Push Message Ends*/
		
		
		$userid = $this->input->post('user_id');
		$dealcode_number = $this->input->post('dealcode_number');
		$userrname = $this->input->post('username');
		$description = $this->input->post('message_text');
		$email = $this->input->post('selleremail');
		$sent_mail=$this->user_model->get_all_details(USERS,array('email'=>$email));//,'fav_shop'=>'Yes'));
		//echo '<pre>'; print_r($sent_mail->result()); 
		
		$noty_email_arr=explode(',',$sent_mail->row()->notification_email);
		if(in_array('msg',$noty_email_arr)){
			$newsid='17';
			$template_values=$this->user_model->get_newsletter_template_details($newsid);
			
			if($dealcode_number!=''){
				$dealcode_number = '<p><strong>Order Id :</strong>'.$dealcode_number.'</p>';
				$ClickDetails = 'Click <a href="'.base_url().'view-order/'.$userid.'/'.$dealcode_number.'">here</a>&nbsp;to see order details';
			}
			
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
			//echo '<pre>'; print_r($email_values); die;
			$email_send_to_common = $this->user_model->common_email_send($email_values);
			$contact_shop_owner=addslashes(af_lg('lg_contact_shop_owner','Contact Shop Owner Mail Sent Successfully.'));
			
			$this->setErrorMessage('success',$contact_shop_owner);
		}
		if($dealcode_number!=''){
			redirect('purchase-review');
		}else{
			//echo $_SERVER['HTTP_REFERER'];die;
			
			if (isset($_SERVER['HTTP_REFERER']))
			{
			redirect($_SERVER['HTTP_REFERER']);
			}else{
				redirect(base_url());
			}
		}	
			
	}
	
	/**
	 * 
	 * Product Detail Page Contact Shop Owner  
	 * 
	 */
	public function prddetailaskQues(){
		$tid=time(); 
		$dataArr = array('username'=>$this->input->post('username'),
									'useremail'=>$this->input->post('useremail'),
									'user_id'=>$this->input->post('userid'),
									'selleremail'=>$this->input->post('selleremail'),
									'sellerid'=>$this->input->post('sellerid'),
									'product_id'=>$this->input->post('productid'),
									'product_name'=>$this->input->post('productname'),
									'description'=>$this->input->post('message_text'));
		$this->user_model->simple_insert(CONTACTSELLER,$dataArr);
		
		$dataArry = array('sender_email'=>$this->input->post('useremail'),
									'sender_id'=>$this->input->post('userid'),
									'receiver_email'=>$this->input->post('selleremail'),
									'receiver_id'=>$this->input->post('sellerid'),
									'subject'=>$this->input->post('subject'),
									'message'=>$this->input->post('message_text'),
									'dataAdded'=>date('Y-m-d H:i:s'),
									'tid'=>$tid);
		$this->user_model->simple_insert(CONTACTPEOPLE,$dataArry);		
		
		
		$actArr = array('activity'=>"question",
								'activity_id'=>$this->input->post('sellerid'),
								'user_id'	=>$this->input->post('userid'),
								'activity_ip'=>$this->input->ip_address(),
								'created'=>date("Y-m-d H:i:s"),
								'comment_id'=>$tid);
		$this->user_model->simple_insert(NOTIFICATIONS,$actArr);	
		
		$receiver_id=$this->input->post('sellerid');
		$sender_id=$this->input->post('userid');
		/*Push Message Starts*/
		$message='You received a message from '.$this->input->post('username').' on '.$this->config->item('email_title');
		$type='contact';
		$this->sendPushNotification($receiver_id,$message,$type,array($tid,$sender_id));
		/*Push Message Ends*/	
		
		$productName = $this->input->post('productname');
		$userrname = $this->input->post('username');
		$description = $this->input->post('message_text');
		$email = $this->input->post('selleremail');
		
		$newsid='15';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);
		
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
		//echo '<pre>'; print_r($email_values); die;
		$email_send_to_common = $this->user_model->common_email_send($email_values);
		
		
		
		$this->setErrorMessage('success','Contact Shop Owner Mail Sent Successfully.');
		redirect('products/'.$this->input->post('productseourl'));
			
	}
	
	/**
	 * 
	 * Make the review box to get the review
	 * 
	 */
	public function makeReviewBox(){
	
	if($this->lang->line('write_review') != '') { $rew= stripslashes($this->lang->line('write_review')); } else $rew= "Write a Review"; 
   
   if($this->lang->line('review_by') != '') { $rewby= stripslashes($this->lang->line('review_by')); } else $rewby= "Reviewed by"; 
   
   if($this->lang->line('msg_txt') != '') { $msg= stripslashes($this->lang->line('msg_txt')); } else $msg= "Message text"; 
   if($this->lang->line('msg_title') != '') { $msg1= stripslashes($this->lang->line('msg_title')); } else $msg1= "Message title"; 
   
    if($this->lang->line('post_review') != '') { $post_review= stripslashes($this->lang->line('post_review')); } else $post_review= "Post your Review"; 
   
   if($this->lang->line('user_cancel') != '') { $user_cancel= stripslashes($this->lang->line('user_cancel')); } else $user_cancel= "Cancel"; 
	
		$userId = $this->input->post('userId'); 
		$product_id = $this->input->post('product_id'); 
		$dealCode=$this->input->post('dealCode'); 
		$review = $this->user_model->get_all_details(PRODUCT_FEEDBACK,array('voter_id'=>$userId,'seller_product_id'=>$product_id,'deal_code'=>$dealCode))->row();
		$review_status = $this->user_model->get_all_details(PRODUCT_FEEDBACK,array('voter_id'=>$userId,'seller_product_id'=>$product_id,'deal_code'=>$dealCode));
		$UserVal = $this->user_model->get_all_details(USERS,array('id'=>$userId));
		$ProdVal = $this->user_model->get_all_details(PRODUCT,array('id'=>$product_id));	
		
		
		if($UserVal->row()->thumbnail !=''){
			$revByImg = 'images/users/'.$UserVal->row()->thumbnail;
		}else{
			$revByImg = 'images/default_avat.png';
		}
		
		if($ProdVal->row()->image !=''){
			$img=explode(',',$ProdVal->row()->image);
			$prdImg = 'images/product/thumb/'.$img[0];
		}else{
			$prdImg = 'images/dummyProductImage.jpg';
		}
		
		if($review_status->num_rows == 0){				
		$popupVal=' 
				<div style="background:#EAF7FD; margin:0px" class="sign_in_form">
				<form action="'.base_url().'site/user/feedback" method="post" onSubmit="return rattingValidation();" >
				<input type="hidden" value="" name="mode" />
					<div style="border:none;" class="sign_in_form-inner">
						<div style="float:left; width:93%;" class="sign_head">
							<div class="sign_text">
							 <h2>'.$rew.'</h2>
							</div>
						</div>
						<div style="float:left; width:100%; background:#FFF;" class="sign-in-middle">
							<div style="float:left; width:20%" class="sign-in-middle-left">
								
								<img style="height:60px ;  margin: 21px 0 0 20px; width:60px" src="'.base_url().$prdImg.'" />
							</div>
							<div style="float:left; width:69%; padding:20px 0 0 0" class="sign-in-middle-right">
								<h3>'.$ProdVal->row()->product_name.'</h3>
								<!--<img src="'.base_url().'images/starrating.png" />-->
								<input type="radio" id="1" value="1" name="rating" style="display:none;">
								<label for="1" onClick="ratting_star(1)"  class="star-active" id="r1"></label>
								<input type="radio" id="2" value="3" name="rating" style="display:none;">
								<label for="2" onClick="ratting_star(2)" class="star-active" id="r2"></label>
								<input type="radio" id="3" value="3" name="rating" style="display:none;">
								<label for="3" onClick="ratting_star(3)"  class="star-active"  id="r3"></label>
								<input type="radio" id="4" value="4" name="rating" style="display:none;">
								<label for="4" onClick="ratting_star(4)" class="star-active" id="r4"></label>
								<input type="radio" id="5" value="5" name="rating" style="display:none;" checked="checked">
								<label for="5"  onclick="ratting_star(5)" class="star-active" id="r5"></label>
								<input type="hidden" value="'.$dealCode.'" name="deal_code" />
								<input type="hidden" value="'.$ProdVal->row()->id.'" name="product_id" />
								<input type="hidden" value="'.$ProdVal->row()->user_id.'" name="shop_id" />
								<input type="hidden" value="'.$UserVal->row()->id.'" name="user_id" />
								<br><input type="text" name="title" placeholder="'.$msg1.'">
								<textarea style="width:382px; margin:10px 0;" class="conversation-textarea" placeholder="'.$msg.'" name="description" rows="8" id="description"></textarea>
								<span id="descriptionErr" style="color:red;"></span><br>
								<img style="border-radius:60px; height:30px; width:30px" src="'.base_url().$revByImg.'" />
								<span style="color:#999; margin:0 3px 0 0">'.$rewby.'</span>
								<a href="'.base_url().'view-people/'.$UserVal->row()->user_name.'">'.ucfirst($UserVal->row()->full_name).'</a>
							</div>
						</div>
					</div>
					<div style="float:left; width:100%;  border-top:1px solid #77B3CD; " class="popup-page-footer">	
						<div class="popup_login" style="margin-bottom: 15px; margin-right: 15px; float: right; width: auto;">
							<input style="margin:0 10px 0 0" class="submit_btn" type="submit" value="'.$post_review.'">
							<input class="submit_btn" type="button" value="'.$user_cancel.'" onClick="javascript:$.colorbox.close();">
						</div>
					</div>
				</form>
				</div>';
		}else{
			$ratting_value=round($review->rating);
			$RTT='';
			for($i=1;$i<=5;$i++){
				if($i<=$ratting_value){
					$RTT.='<input type="radio" id="'.$i.'" value="'.$i.'" name="rating" style="display:none;"';
					if($i==$ratting_value){
						$RTT.=' checked="checked"';
					}
					$RTT.='>
					<label for="'.$i.'"  class="star-active" id="r'.$i.'"></label>';
				}else{
					$RTT.='<input type="radio" id="'.$i.'" value="'.$i.'" name="rating" style="display:none;">
					<label for="'.$i.'"  class="star-inactive" id="r'.$i.'"></label>';
				}
			}
			$popupVal=' 
				<div style="background:#EAF7FD; margin:0px" class="sign_in_form">
				<form action="'.base_url().'site/user/feedback" method="post" onSubmit="return rattingValidation();" >
				<input type="hidden" value="'.$review->id.'" name="mode" />
					<div style="border:none;" class="sign_in_form-inner">
						<div style="float:left; width:93%;" class="sign_head">
							<div class="sign_text">
							 <h2>View Your Review</h2>
							</div>
						</div>
						<div style="float:left; width:100%; background:#FFF;" class="sign-in-middle">
							<div style="float:left; width:20%" class="sign-in-middle-left">
								
								<img style="height:60px ;  margin: 21px 0 0 20px; width:60px" src="'.base_url().$prdImg.'" />
							</div>
							<div style="float:left; width:69%; padding:20px 0 0 0" class="sign-in-middle-right">
								<h3>'.$ProdVal->row()->product_name.'</h3>
								<!--<img src="'.base_url().'images/starrating.png" />-->
								'.$RTT.'
								<input type="hidden" value="'.$dealCode.'" name="deal_code" />
								<input type="hidden" value="'.$ProdVal->row()->id.'" name="product_id" />
								<input type="hidden" value="'.$ProdVal->row()->user_id.'" name="shop_id" />
								<input type="hidden" value="'.$UserVal->row()->id.'" name="user_id" />
								<input type="hidden" value="'.$UserVal->row()->rating.'" name="old_rating" />
								<input type="hidden" value="'.$review->description.'" name="old_msg"/>
								<br><br><input type="text" name="title" readonly value="'.$review->title.'" placeholder="'.$msg1.'">
								<textarea style="width:382px; margin:10px 0;" readonly class="conversation-textarea" placeholder="Message text" name="description" rows="8" id="description">'.$review->description.'</textarea>
								<span id="descriptionErr" style="color:red;"></span><br>
								<img style="border-radius:60px; height:30px; width:30px" src="'.base_url().$revByImg.'" />
								<span style="color:#999; margin:0 3px 0 0">Reviewd by</span>
								<a href="'.base_url().'view-order/'.$UserVal->row()->id.'">'.ucfirst($UserVal->row()->full_name).'</a>
							</div>
						</div>
					</div>
					<div style="float:left; width:100%;  border-top:1px solid #77B3CD; " class="popup-page-footer">	
						<div class="popup_login" style="margin-bottom: 15px; margin-right: 15px; float: right; width: auto;">							
							<input class="submit_btn" type="button" value="Ok" onClick="javascript:$(\'#cboxClose\').trigger(\'click\');">
						</div>
					</div>
				</form>
				</div>';
		}
		echo $popupVal;		
		return;	
	}	
	
	/**
	 * 
	 * To view the user activity 
	 * 
	 */
	public function activity(){
		if ($this->checkLogin('U')!=''){		
			$this->data['currUser']=$checkloginIDarr=$this->session->all_userdata(); 
		 	$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
			/*Update the user last Visited Activity Time */
			#$datestring = "%Y-%m-%d %H:%i:%s";
			#$time = time();
			$newdata = array(
               'last_activity_visit' => time()
            );
            $condition = array('id' => $loggeduserID);
			$this->user_model->update_details(USERS,$newdata,$condition);
			/*
			$newArr = array(
               'view_action' => 'Seen'
            );
            $cond = array('user_id' => $loggeduserID);
			$this->user_model->update_details(USER_ACTIVITY,$newArr,$cond);
			*/
			
			
			/*Get the  user details*/
			$this->data['userProfileDetails']=$userProfileDetails= $this->user_model->get_all_details(USERS,array('id'=>$loggeduserID))->result_array();
			$userList=explode(',',$userProfileDetails[0]['following']);
			$userList[0]=$loggeduserID;$condition='';
			foreach($userList as $userIds){
				/*$this->data['userDetails']->$userIds=$userDetails->$userIds= $this->user_model->get_all_details(USER,array('id'=>$userIds))->result();
				$this->data['userActivity'][$userIds]=$userActivity[$userIds]= $this->user_model->get_all_details(USER_ACTIVITY,array('user_id'=>$userIds),array('field'=>'activity_time','type'=>'desc'))->result_array();*/
				$condition.="ua.user_id = ".$userIds." or ";
			}
			$len=strlen($condition);
			$condition=substr($condition,0,$len-4);
			$this->data['userActivity']=$userActivity= $this->user_model->get_activity($condition)->result_array();
			$this->data['heading'] = $this->config->item('email_title').'-Your Activity';
			$this->load->view('site/user/activity',$this->data);
		}else{
			redirect('login');
		}
	}
	
	/**
	 * 
	 * To view the user interaction 
	 * 
	 */
	public function activity_interaction(){
		if ($this->checkLogin('U')!=''){		
			$this->data['currUser']=$checkloginIDarr=$this->session->all_userdata(); 
		 	$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];			
			/*Get the  user details*/
			$this->data['userProfileDetails']=$userProfileDetails= $this->user_model->get_all_details(USERS,array('id'=>$loggeduserID))->result_array();
			#print_r($userProfileDetails);
			$followersArr=explode(',',ltrim($userProfileDetails[0]['followers'],','));
			#print_r($followersArr);
			foreach($followersArr as $followersList){
				$this->data['userfollowersDetails'][$followersList]=$userfollowersDetails[$followersList]= $this->user_model->get_all_details(USERS,array('id'=>$followersList))->row();
			}
			#echo "<pre>";print_r($this->data['userfollowersDetails'][$followersList]);die;
			$this->data['heading'] = $this->config->item('email_title').'-Your Activity';
			$this->load->view('site/user/activity_interaction',$this->data);
		}else{
			redirect('login');
		}
	}

	/**
	 * 
	 * To view the user pickup 
	 * 
	 */
	public function activity_pickup(){
		if ($this->checkLogin('U')!=''){		
			$this->data['currUser']=$checkloginIDarr=$this->session->all_userdata(); 
		 	$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
			/*Get the buyer pickup details*/
			// $isBuyerPickupActivities = $this->user_model->get_activity_details($loggeduserID, $this->user_model->get_activity_count($loggeduserID))->result_array();
			$this->date['isBuyerPickupActivities'] = $this->user_model->get_all_details(USER_ACTIVITY, array('user_id'=>$loggeduserID, 'activity_name'=> 'pickup item'))->result_array();
			// print_r($isBuyerPickupActivities);
			$this->data['sellerProfileDetails']=array();
			foreach ($this->date['isBuyerPickupActivities'] as $buyerPickupActivity) {
				// print_r($buyerPickupActivity['seller_id']);die;
				array_push($this->data['sellerProfileDetails'], $this->seller_model->get_all_details(SELLER, array('seller_id'=>$buyerPickupActivity['seller_id']))->result_array());
			}
			// print_r($this->data['sellerProfileDetails']);
			/*Get the seller pickup details*/

			$this->data['heading'] = $this->config->item('email_title').'-Your Pickup';
			$this->load->view('site/user/activity_pickup',$this->data);	
		}else{
			redirect('login');
		}
	}
	
	/**
	 * 
	 * To view the shop activity for user
	 * 
	 */
	public function activity_shop(){
		if ($this->checkLogin('U')!=''){
			$this->data['currUser']=$checkloginIDarr=$this->session->all_userdata(); 
		 	$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];			
			/*Get the  user details*/
			$this->data['userProfileDetails']=$userProfileDetails= $this->user_model->get_all_details(USERS,array('id'=>$loggeduserID))->result_array();
			/*get my shop products*/
			$myshopproductArr= $this->user_model->get_all_details(PRODUCT,array('user_id'=>$loggeduserID))->result_array();
			$prd='';
			foreach($myshopproductArr as $prdId){
				$prd.=$prdId['id'].',';
			}
			/*My Shop Activity*/
			$condition="ua.activity_id =".$loggeduserID." or FIND_IN_SET(ua.activity_id,'".rtrim($prd,',')."')";
			$this->data['myshopactivity']=$myshopactivity= $this->user_model->get_myshopactivity($condition)->result_array();
			
			$this->data['heading'] = $this->config->item('email_title').'-Your Shop Activity';
			$this->load->view('site/user/activity_shop',$this->data);
		}else{
			redirect('login');
		}
	}
	
	/**
	 * 
	 * to view the category list
	 * 
	 */
	public function category(){
		$this->data['MainCategoriesLists'] = $this->user_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),array(array('field'=>'cat_name','type'=>'asc')));
		$this->data['heading'] =$this->config->item('email_title').' - Browse Shopping Categories';
		$this->load->view('site/list/category',$this->data);
	}
	
	
	/**
	 * 
	 * Contact People to view the list
	 * 
	 */
	public function contactpeople(){
		$tid=$this->input->post('tid');
		
		$dataArr = array('sender_email'=>$this->input->post('sender_email'),
									'sender_id'=>$this->input->post('sender_id'),
									'receiver_email'=>$this->input->post('receiver_email'),
									'receiver_id'=>$this->input->post('receiver_id'),
									'subject'=>$this->input->post('subject'),
									'message'=>$this->input->post('message_text'),
									'dataAdded'=>date('Y-m-d H:i:s'),'tid'=>$tid);
		$this->user_model->simple_insert(CONTACTPEOPLE,$dataArr);
		
		$actArr = array('activity'=>"message",
								'activity_id'=>$this->input->post('receiver_id'),
								'user_id'	=>$this->input->post('sender_id'),
								'activity_ip'=>$this->input->ip_address(),
								'created'=>date("Y-m-d H:i:s"),
								'comment_id'=>$tid);
		$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
		
		$receiver_id=$this->input->post('receiver_id');
		$sender_id=$this->input->post('sender_id');
		/*Push Message Starts*/
		$message='You received a message from '.$this->input->post('current_user').' on '.$this->config->item('email_title');
		$type='message';
		$this->sendPushNotification($receiver_id,$message,$type,array($tid,$sender_id));
		/*Push Message Ends*/
		
		//echo $this->input->post('FromURL'); die;
		$this->setErrorMessage('success','Message Sent Successfully.');
		if($this->input->post('FromURL')=='ContactUser'){
			redirect('shops/'.$this->input->post('current_user').'/contact-user');
		}
		if($this->input->post('FromURL')=='Conversation'){
		
		
			redirect('people/'.$this->input->post('current_user').'/conversations/all/'.$tid);
		}
		redirect('view-people/'.$this->input->post('current_user'));
			
	}
	
	/**
	 * 
	 * Manage the registry product from the user
	 * 
	 */
	public function user_manageRegistryProduct(){
		if ($this->checkLogin('U')!=''){
			$userId=$this->input->post('userId');
			$prodId=$this->input->post('prodId');
			
			$registryProduct = $this->user_model->get_all_details(REGISTRY_LISTINGS,array('collection_id'=>$userId,'listing_id'=>$prodId))->result_array();
			if(empty($registryProduct)){
				$dataArr = array('collection_id'=>$userId,'listing_id'=>$prodId);
				$this->user_model->simple_insert(REGISTRY_LISTINGS,$dataArr);
				
				$registryProduct1 = $this->user_model->get_all_details(REGISTRY_REQUEST,array('collection_id'=>$userId,'listing_id'=>$prodId));
				if($registryProduct1->num_rows()>0)
				{
					//$Sql="update shopsy_registry_requests set requested=requested+1 where collection_id='".$userId."' and listing_id='".$prodId."'";
					//$result=$this->category_model->ExecuteQuery($Sql);			
					//$count1=$result->num_rows();
					
					$newCnt = int($registryProduct1->row()->requested) + 1;
					
					$dataArr1 = array('requested'=>$newCnt);
					$condition1 = array('collection_id' => $userId, 'listing_id'=> $prodId);
					$this->user_model->update_details(REGISTRY_REQUEST,$dataArr1,$condition1);
					
					
				}
				else
				{
				 //$Sql="insert into  shopsy_registry_requests(collection_id,listing_id) values('".$userId."','".$prodId."')";
				 //$result=$this->category_model->ExecuteQuery($Sql);			
					
					$dataArr2 = array('collection_id' => $userId, 'listing_id'=> $prodId);
					$this->user_model->simple_insert(REGISTRY_REQUEST,$dataArr2);
			
				
			 
				}
				
			}else{
				    $this->user_model->commonDelete(REGISTRY_LISTINGS,array('collection_id'=>$userId,'listing_id'=>$prodId));
					$this->user_model->commonDelete(REGISTRY_REQUEST,array('collection_id'=>$userId,'listing_id'=>$prodId));	
			}
			$ur_reg_updated=addslashes(af_lg('lg_ur_reg_updated','Your Registry has been updated'));
			
			$this->setErrorMessage('success',$ur_reg_updated);		
		}
	}	
	
	/**
	 * 
	 * To change the language
	 * 
	 */	
	public function language_change(){
		$language_code= $this->uri->segment('2');
		$selectedLangCode = $this->session->set_userdata('language_code',$language_code);
		redirect('');
	}
	
	
	/**
	 * 
	 * To display the conversations
	 * 
	 */
	public function display_conversations(){
			#echo "<pre>";print_r($this->input->post());die;
		if ($this->checkLogin('U')!=''){
			$this->data['heading'] =$this->config->item('email_title').' - Conversation';		
			if(isset($_GET['qv'])){
			$typev= $_GET['qv'];
			}else{
			$typev= 'all';
			}
		
				
			#echo $this->db->last_query();die;
			$typev= 'all';
			$this->data['viewfolder'] =$typev;
			#$this->data['conversations'] = $this->user_model->get_conversation_details($this->checkLogin('U'),$typev);
			$this->data['conversations'] = $this->user_model->get_conversation_list($this->checkLogin('U'),$typev);
			#echo "<pre>"; print_r($this->data['conversations']->result()); die;
			$this->load->view('site/user/conversation',$this->data);
		}else{
			$this->setErrorMessage('error','Login Required');	
			redirect('login');
		}
	}
	
	/**
	 * 
	 * To display the view messages
	 * 
	 */
	public function view_message(){
		
		if ($this->checkLogin('U')!=''){
			$msgid=$this->uri->segment(5,0);
			$this->data['viewfolder'] =$this->uri->segment(4,0);
			$this->data['MessageDetail'] = $this->user_model->get_full_message_details($msgid);
			
				$this->product_model->ExecuteQuery("UPDATE ".NOTIFICATIONS." SET `view_mode` = 'No' WHERE comment_id=".$msgid." AND (activity='favorite item' OR activity='unfavorite item' OR activity='message' OR activity='question')");
	
			if($this->data['MessageDetail']->num_rows()<=0){
				$this->setErrorMessage('error','sorry! this conversation is not available.');	
				redirect('people/'.$this->uri->segment(2).'/conversations');
			}
			
			/* update notification*/
			$dataArrw = array('view_count'=>$this->data['preview_item_detail'][0]['view_count']+1);
			$conditionw = array('seourl'=>$seourl);
			$this->product_model->update_details(PRODUCT,$dataArrw,$conditionw);
			if($this->checkLogin('U')!=""){
				$activity_id=$this->checkLogin('U');
				$this->product_model->ExecuteQuery("UPDATE ".NOTIFICATIONS." SET `view_mode` = 'No' WHERE activity_id=".$activity_id." AND (activity='message' OR activity='question') AND comment_id=".$msgid."");
			}
			
			foreach($this->data['MessageDetail']->result() as $row){
				if($row->sender_id==$this->checkLogin('U')){
					$newdata=array('sender_status'=>'Read');
					$condition = array('id' => $row->id,'receiver_status !='=>'Trash');
				}else if($row->receiver_id==$this->checkLogin('U')){
					$newdata=array('receiver_status'=>'Read');
					$condition = array('id' => $row->id,'receiver_status !='=>'Trash');
				}				
				$this->product_model->update_details(CONTACTPEOPLE,$newdata,$condition);
				//echo $this->db->last_query(); die;
			}
			
			$this->data['heading'] =$this->config->item('email_title').' - Conversation';
			$this->load->view('site/user/view_conversation',$this->data);
		}else{
			$this->setErrorMessage('error','Login Required');	
			redirect('login');
		}
	}
	
	/**
	 * 
	 * To upload teh ajax conversions
	 * 
	 */
	public function ajax_conversation_action(){
		$MsgId=$this->input->post('MsgId');
		$UsrId=$this->input->post('UsrId');
		$folder=$this->input->post('folder');
		$actionTake=$this->input->post('actionTake');
		$chkMsgArr=@explode('|',rtrim($MsgId,'|'));   
		$chgId='';
		foreach($chkMsgArr as $MsgId){
			$msgDetail = $this->user_model->get_all_details(CONTACTPEOPLE,array('id'=>$MsgId));
			if($msgDetail->row()->sender_id==$UsrId){
				$colstatus='sender_status';
			}else if($msgDetail->row()->receiver_id==$UsrId){
				$colstatus='receiver_status';
			}
			$actionTake='Trash';
			$newdata=array($colstatus=>$actionTake);
			$condition = array('id' => $MsgId);
			if($this->user_model->update_details(CONTACTPEOPLE,$newdata,$condition)){
				$chgId=$chgId.$MsgId.'|';  
			}
		}	
		echo rtrim($chgId,'|');	
	}
	
	/**
	 * 
	 * To add the ajax activity
	 * 
	 */
	public function ajax_activity(){
		if ($this->checkLogin('U')!=''){		
			$this->data['currUser']=$checkloginIDarr=$this->session->all_userdata(); 
		 	$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
			$datestring = "%Y-%m-%d %H:%i:%s";
			$time = time();
			$newdata = array(
               'last_activity_visit' => time()
            );
            $condition = array('id' => $loggeduserID);
			$this->user_model->update_details(USERS,$newdata,$condition);
			$this->data['userProfileDetails']=$userProfileDetails= $this->user_model->get_all_details(USERS,array('id'=>$loggeduserID))->result_array();
			$userList=explode(',',$userProfileDetails[0]['following']);
			$userList[0]=$loggeduserID;$condition='';
			foreach($userList as $userIds){
				$condition.="ua.user_id = ".$userIds." or ";
			}
			$len=strlen($condition);
			$condition=substr($condition,0,$len-4);
			$offset = is_numeric($_POST['offset']) ? $_POST['offset'] : die();
			$postnumbers = is_numeric($_POST['number']) ? $_POST['number'] : die();
			$this->data['userActivity']=$userActivity= $this->user_model->get_activity($condition,$postnumbers,$offset)->result_array();
			$this->data['heading'] = $this->config->item('email_title').'-Your Activity';
			$loginCheck = $this->checkLogin('U');
			if(!empty($userActivity)){ 
         	//$content ='<ul id="activity-list">';
         	$content ='';
                $hover=0; $s=0;$l=1; 
				foreach($userActivity as $actFav){ 
                if($s<3 && $l<4){ $cls="small"; $s++; } else if($s>2 && $l<4){ $cls="large"; $l++;} else {$s=0;$l=1;}
              
				$userProfileDetails= $this->user_model->get_all_details(USERS,array('id'=>$actFav['user_id']))->result_array();
				if($actFav['activity_name']=='Unfavorite item' || $actFav['activity_name']=='favorite item') { 
				$hover++;
					$productDetail = $this->user_model->get_all_details(PRODUCT,array('id'=>$actFav['activity_id']))->row();
					$imgArr=explode(',',$productDetail->image);
                     $content .='<li class="activity small-wid '.$cls.'">
                        <div class="activity-desc">
                            <div class="activity-avatar trigger-action-toolbox" data-source="hp_tastemaker">
                                <a href="view-profile/'.$userProfileDetails[0]['user_name'].'" >';
                                	if($userProfileDetails[0]['thumbnail']!=''){ $profile_pic='users/thumb/'.$userProfileDetails[0]['thumbnail']; } else { $profile_pic='default_avat.png';}
                                    $content .='<img width="75" height="75" src="images/'.$profile_pic.'">
                                </a>
                            </div>
                            <p class="activity-name">';
                               if($userProfileDetails[0]['id']!=$loginCheck){ $content .= $userProfileDetails[0]['user_name']; } else { $content .= 'You';} 
							    $content .=' ';
                               		if($this->lang->line('favorited') != '') { $content .= stripslashes($this->lang->line('favorited')); } else {$content .= "favorited";}
									 $content .=' ';
                               $content .='<a class="member-name" href="products/'.$productDetail->seourl.'">'; 
							   if($this->lang->line('user_thisitem') != '') { $content .=stripslashes($this->lang->line('user_thisitem')); } else $content .='"this item"';
                               $content .='..</a>';
                            $content .='</p>
                        </div>
                        <div class="activity-favorites  full-wid">
                            <a href="products/'.$productDetail->seourl.'" class="activity-full">
                                <img alt="'.$productDetail->product_name.'" src="images/product/'.$imgArr[0].'">
                            </a>
                        </div>
                        <div class="story-info clear">
                            <div class="product-dtl">'.$productDetail->product_name.'</div>
                            <div class="product_fv">';
                            		 if($loginCheck !=''){
											if($productDetail->user_id==$loginCheck){ 
												$prod_list.='<a href="javascript:void(0);" onclick="return ownProductFav();">
																		<input type="submit" value="" class="hoverfav_icon" />
																	</a>';
											}else{
                                        $favArr = $this->product_model->getUserFavoriteProductDetails($productDetail->id);
                                        if(empty($favArr)){ 
                                       $content .='<a href="javascript:void(0);" onClick="return changeProductToFavourite(\''.$productDetail->id.'\',\'Fresh\');">
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>';
                                        } else {                       
                                        $content .='<a href="javascript:void(0);" onClick="return changeProductToFavourite(\''.$productDetail->id.'\',\'Old\');">
                                            <input type="submit" value="" class="hoverfav_icon1" />
                                        </a>';
                                        }}} else {
                                        $content .='<a href="login" class="reg-popup" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>';
                                 }  
                                $content .='<div class="hoverdrop2_icon">
                                    <a href="javascript:hoverView(\''.$hover.'\');">
                                        <div class="hover_lists" id="hoverlist'.$hover.'">
                                            <h2>Your Lists</h2> 
                                            <div class="lists_check">';                                            
											foreach($this->data['userLists'] as $Lists){ 
                                            $haveListIn = $this->user_model->check_list_products(stripslashes($productDetail->id),$Lists['id'])->num_rows();
                                            if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}
                                            
                                            $content .='<input type="checkbox" class="check_box" onClick="return addproducttoList(\''.$Lists['id'].'\',\''.$productDetail->id.'\');" '.$chk.'/>';
                                            $content .='<label>'.$Lists['name'].'</label>';
                                            } 
                                            $content .='</div>                                                    
                                            <div class="new_list">
                                                <form method="post" action="site/user/add_list">
                                                    <input type="hidden" value="1" name="ddl" />
                                                    <input type="hidden" value="'.$productDetail->id.'" name="productId" />
                                                    <input type="text" placeholder="';
													if($this->lang->line('user_new_list') != '') { 
													$content .=stripslashes($this->lang->line('user_new_list')); 
													} else {
													$content .='New list';}
													$content .='" class="list_scroll" name="list" id="creat_list_'.$hover.'" />
                                                    <input type="submit" value="';
													if($this->lang->line("user_add") != "") { 
													$content .=stripslashes($this->lang->line('user_add')); 
													} else{ $content .='Add'; }
													$content .='" class="primary-button" onclick="return validate_create_list(\''.$hover.'\');" />
                                                </form>
                                            </div>   
                                        </div>
                                    </a>
                                </div>
                            </div>	
                        </div>
                    </li> ';
                }else if($actFav['activity_name']=='Unfavorite shop' || $actFav['activity_name']=='favorite shop') {                  
                 
					$shopproductDetail = $this->user_model->getfavshops_activity($actFav['activity_id'])->result_array();
				
                $content .='<li class="activity '.$cls.'">
                    <div class="activity-desc">
                        <div class="activity-avatar trigger-action-toolbox" data-source="hp_tastemaker">
                            <a href="view-profile/'.$userProfileDetails[0]['user_name'].'" >';
                                	if($userProfileDetails[0]['thumbnail']!=''){ $profile_pic='users/thumb/'.$userProfileDetails[0]['thumbnail']; } else { $profile_pic='default_avat.png';}
                                    $content .='<img width="75" height="75" src="images/'.$profile_pic.'">
                                </a>
                        </div>
                        <p class="activity-name">';
                            if($userProfileDetails[0]['id']!=$loginCheck){ $content .=$userProfileDetails[0]['user_name']; } else { if($this->lang->line('user_you')!='') { $content .= stripslashes($this->lang->line('user_you')); } else $content .="You"; } 
							$content .=' ';
							if($this->lang->line('favorited') != '') { $content .= stripslashes($this->lang->line('favorited')); } else $content .="favorited"; 
							$content .=' ';
							$content .='<a class="member-name" href="shop-section/'.$shopproductDetail[0]['shopurl'].'">'; 
							$content .=' ';
							if($this->lang->line('user_thisshop') != '') { 
							$content .= stripslashes($this->lang->line('user_thisshop')); } else $content .= "this shop"; 
							$content .='</a> 
                        </p>
                    </div>
                    <div class="activity-favorites">';
                    	if(count($shopproductDetail)<4){$count=count($shopproductDetail); } else{ $count=4; } for($i=0;$i<$count;$i++){ 
                            $content .='<a href="shop-section/'.$shopproductDetail[0]['shopurl'].'" class="favorite">';
                            	$imgArr=explode(',',$shopproductDetail[$i]['image']); 
                                $content .='<img  width="170" height="135" alt="'.$shopproductDetail[$i]['product_name'].'" src="images/product/'.$imgArr[0].'">
                            </a> ';                       
                         } 
                        if($count!=4) {for($j=4-$count;$j<$count;$j++){ 
                           $content .=' <a class="favorite">
                            </a>       ';                 
                         } } 
                    $content .='</div>
                    <div class="activity-link clear">
                        <div class="activeright">
                            <span class="newimages"></span>
                            <p class="line-type">';
                            	if($this->lang->line('shop') != '') { $content .= stripslashes($this->lang->line('shop')); } else $content .= "SHOP"; 
                            $content .='</p>
                            <p><a class="name_line" href="shop-section/'.$shopproductDetail[0]['shopurl'].'">'.$shopproductDetail[0]['shopname'].'</a></p>
                        </div>';
                        if($loginCheck !=''){
                        $favArr = $this->product_model->getUserFavoriteShopDetails($actFav['activity_id']);
                        if(empty($favArr)){ 
                        $content .='<a href="javascript:void(0);" onClick="return changeShopToFavourite(\''.$actFav['activity_id'].'\',\'Fresh\');">
						<input type="submit" value="" class="hoverfav_icon">
                        </a>';
                          } else { 
                        $content .='<a href="javascript:void(0);" onClick="return changeShopToFavourite(\''.$actFav['activity_id'].'\',\'Old\');">
                        <input type="submit" value="" class="hoverfav_icon1">
                        </a>';
                        }} else { 
                        $content .='<input type="submit" value="" class="hoverfav_icon">';
                          }
                    $content .='</div>
                </li>';
                 } }
                //$content .='</ul>';
                //$content .='</ul>';
                 } else { 
                $content ='';
                 }
		 echo $content;}else{
			redirect('login');
		}		
	}
	
	/**
	 * 
	 * To add the shop activity for user using ajax
	 * 
	 */
	public function ajax_activity_shop(){
		if ($this->checkLogin('U')!=''){
		$loginCheck = $this->checkLogin('U');
			$this->data['currUser']=$checkloginIDarr=$this->session->all_userdata(); 
		 	$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];	
			$this->data['userProfileDetails']=$userProfileDetails= $this->user_model->get_all_details(USERS,array('id'=>$loggeduserID))->result_array();
			$myshopproductArr= $this->user_model->get_all_details(PRODUCT,array('user_id'=>$loggeduserID))->result_array();
			$prd='';
			foreach($myshopproductArr as $prdId){
				$prd.=$prdId['id'].',';
			}
			$condition="ua.activity_id =".$loggeduserID." or FIND_IN_SET(ua.activity_id,'".rtrim($prd,',')."')";
			$offset = is_numeric($_POST['offset']) ? $_POST['offset'] : die();
			$postnumbers = is_numeric($_POST['number']) ? $_POST['number'] : die();
			$this->data['myshopactivity']=$myshopactivity= $this->user_model->get_myshopactivity($condition,$postnumbers,$offset)->result_array();
			
			$this->data['heading'] = $this->config->item('email_title').'-Your Shop Activity';
			if(!empty($myshopactivity)){   
                $content ='<ul id="activity-list">';
                $hover=0; $s=0;$l=1; foreach($myshopactivity as $actFav){ 
                 if($s<3 && $l<4){ $cls="small"; $s++; } else if($s>2 && $l<4){ $cls="large"; $l++;} else {$s=0;$l=1;}
				$userProfileDetails= $this->user_model->get_all_details(USERS,array('id'=>$actFav['user_id']))->result_array();
				if($actFav['activity_name']=='Unfavorite item' || $actFav['activity_name']=='favorite item') { 
				$hover++;
					$productDetail = $this->user_model->get_all_details(PRODUCT,array('id'=>$actFav['activity_id']))->row();
					$imgArr=explode(',',$productDetail->image);
                    $content .='<li class="activity small-wid '.$cls.'">
                        <div class="activity-desc">
                            <div class="activity-avatar trigger-action-toolbox" data-source="hp_tastemaker">
                                <a href="view-profile/'.$userProfileDetails[0]['user_name'].'" >';
                                	if($userProfileDetails[0]['thumbnail']!=''){ $profile_pic='users/thumb/'.$userProfileDetails[0]['thumbnail']; } else { $profile_pic='default_avat.png';}
                                    $content .='<img width="75" height="75" src="images/'.$profile_pic.'">
                                </a>
                            </div>
                            <p class="activity-name">';
                               if($userProfileDetails[0]['id']!=$loginCheck){ $content .= $userProfileDetails[0]['user_name']; } else { $content .= 'You';}
                               		if($this->lang->line('favorited') != '') { $content .= stripslashes($this->lang->line('favorited')); } else $content .= "favorited"; 
                               $content .='<a class="member-name" href="products/'.$productDetail->seourl.'"> your item..</a>
                            </p>
                        </div>
                        <div class="activity-favorites  full-wid">
                            <a href="products/'.$productDetail->seourl.'" class="activity-full">
                                <img alt="'.$productDetail->product_name.'" src="images/product/'.$imgArr[0].'">
                            </a>
                        </div>
                        <div class="story-info clear">
                            <div class="product-dtl">'.$productDetail->product_name.'</div>
                            <div class="product_fv">';
                            	if($loginCheck !=''){
									if($productDetail->user_id==$loginCheck){ 
												$prod_list.='<a href="javascript:void(0);" onclick="return ownProductFav();">
																		<input type="submit" value="" class="hoverfav_icon" />
																	</a>';
											}else{
                                        $favArr = $this->product_model->getUserFavoriteProductDetails($productDetail->id);
                                        if(empty($favArr)){ 
                                        $content .='<a href="javascript:void(0);" onClick="return changeProductToFavourite(\''.$productDetail->id.'\',\'Fresh\');">
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>';
                                        } else {   
                                        $content .='<a href="javascript:void(0);" onClick="return changeProductToFavourite(\''.$productDetail->id.'\',\'Old\');">
                                            <input type="submit" value="" class="hoverfav_icon1" />
                                        </a>';
                                        }}} else {
                                        $content .='<a href="login" class="reg-popup" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>';
                                } 
                                $content .='<div class="hoverdrop2_icon">
                                    <a href="javascript:hoverView('.$hover.');">
                                        <div class="hover_lists" id="hoverlist'.$hover.'">
                                            <h2>';
											if($this->lang->line('user_your_lists') != '') { $content .= stripslashes($this->lang->line('user_your_lists')); } else $content .= "Your Lists"; $content .='</h2> 
                                            <div class="lists_check">';
                                            foreach($this->data['userLists'] as $Lists){ 
                                            $haveListIn = $this->user_model->check_list_products(stripslashes($productDetail->id),$Lists['id'])->num_rows();
                                            if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}
                                            
                                            $content .='<input type="checkbox" class="check_box" onClick="return addproducttoList(\''.$Lists['id'].'\',\''.$productDetail->id.'\');" '.$chk.'/>
                                            <label>'.$Lists["name"].'</label>';
                                             } 
                                            $content .='</div>                                                    
                                            <div class="new_list">
                                                <form method="post" action="site/user/add_list">
                                                    <input type="hidden" value="1" name="ddl" />
                                                    <input type="hidden" value="'.$productDetail->id.'" name="productId" />
                                                    <input type="text" placeholder="';if($this->lang->line('user_new_list') != '') { $content .= stripslashes($this->lang->line('user_new_list')); } else $content .= 'New list';$content .='" class="list_scroll" name="list" id="creat_list_'.$hover.'" />
                                                    <input type="submit" value="';if($this->lang->line('user_add') != '') { $content .= stripslashes($this->lang->line('user_add')); } else $content .= 'Add'; $content .='" class="primary-button" onClick="return validate_create_list(\''.$hover.'\');" />
                                                </form>
                                            </div>   
                                        </div>
                                    </a>
                                </div>
                            </div>	
                        </div>
                    </li> ';
                 }else if($actFav['activity_name']=='Unfavorite shop' || $actFav['activity_name']=='favorite shop') {  
					$shopproductDetail = $this->user_model->getfavshops_activity($actFav['activity_id'])->result_array();
               $content .=' <li class="activity '.$cls.'">
                    <div class="activity-desc">
                        <div class="activity-avatar trigger-action-toolbox" data-source="hp_tastemaker">
                            <a href="view-profile/'.$userProfileDetails[0]['user_name'].'" >';
                             if($userProfileDetails[0]['thumbnail']!=''){ $profile_pic='users/thumb/'.$userProfileDetails[0]['thumbnail']; } else { $profile_pic='default_avat.png';}
                                   $content .=' <img width="75" height="75" src="images/'.$profile_pic.'">
                                </a>
                        </div>
                        <p class="activity-name">';
                            if($userProfileDetails[0]['id']!=$loginCheck){ $content .= $userProfileDetails[0]['user_name']; } else { $content .= 'You';} 
                            	if($this->lang->line('favorited') != '') { $content .= stripslashes($this->lang->line('favorited')); } else $content .= "favorited"; 
                            $content .='<a class="member-name" href="shop-section/'.$shopproductDetail[0]['shopurl'].'"> your shop.</a> 
                        </p>
                    </div>
                    <div class="activity-favorites">';
                    	if(count($shopproductDetail)<4){$count=count($shopproductDetail); } else{ $count=4; } for($i=0;$i<$count;$i++){ 
                           $content .=' <a href="shop-section/'.$shopproductDetail[0]['shopurl'].'" class="favorite">';
                            	$imgArr=explode(',',$shopproductDetail[$i]['image']); 
                                $content .='<img  width="170" height="135" alt="'.$shopproductDetail[$i]['product_name'].'" src="images/product/'.$imgArr[0].'">
                            </a>   ';                     
                        } 
                        if($count!=4) {for($j=4-$count;$j<$count;$j++){ 
                            $content .='<a class="favorite">
                            </a>        ';                
                         } } 
                    $content .='</div>
                    <div class="activity-link clear">
                        <div class="activeright">
                            <span class="newimages"></span>
                            <p class="line-type">';
								if($this->lang->line('shop') != '') { $content .= stripslashes($this->lang->line('shop')); } else $content .= "SHOP"; 
                           $content .=' </p>
                            <p><a class="name_line" href="shop-section/'.$shopproductDetail[0]['shopurl'].'">'.$shopproductDetail[0]['shopname'].'</a></p>
                        </div>';
                        if($loginCheck !=''){
                        $favArr = $this->product_model->getUserFavoriteShopDetails($actFav['activity_id']);
                        if(empty($favArr)){ 
                        $content .='<a href="javascript:void(0);" onClick="return changeShopToFavourite(\''.$actFav['activity_id'].'\',\'Fresh\');">
						<input type="submit" value="" class="hoverfav_icon">
                        </a>';
                         } else { 
                        $content .='<a href="javascript:void(0);" onClick="return changeShopToFavourite(\''.$actFav['activity_id'].'\',\'Old\');">
                        <input type="submit" value="" class="hoverfav_icon1">
                        </a>';
                        }} else { 
                        $content .='<input type="submit" value="" class="hoverfav_icon">';
                         } 
                    $content .='</div>
                </li>';
                 } }
                $content .='</ul>     ';
                }else { 
               $content ='';
                 } 
				 echo $content;
		}else{
			redirect('login');
		}
	}
	
	/**
	 * 
	 * To add the item to favorite list using ajax 
	 * 
	 */
	public function ajax_people_favorite_list_itemsilove(){
		$loginCheck = $this->checkLogin('U');
			$this->data['currUser']=$checkloginIDarr=$this->session->all_userdata(); 
		 	$this->data['loggeduserID']=$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
			$username =  urldecode($this->uri->segment(4,0));
			$userDetails= $this->user_model->get_all_details(USERS,array('user_name'=>$username))->result_array();
			$userDetails[0]['id'];
				$condition='';
				if($_GET['a']){
					$search_key=$_GET['a'];
					$condition="p.product_name LIKE '%".$search_key."%' and";
				}	
				if($_GET['filter']){
					$condition="p.status='Publish' and p.quantity>2 and";
				}
			$this->data['userProfileDetails']=$userProfileDetails = $this->user_model->get_all_details(USERS,array('id'=>$userDetails[0]['id'],'status'=>'Active'))->result_array();			
			$offset = is_numeric($_POST['offset']) ? $_POST['offset'] : die();
			$postnumbers = is_numeric($_POST['number']) ? $_POST['number'] : die();
			$this->data['userFavoriteItems']=$userFavoriteItems = $this->product_model->getFavoriteProduct($userDetails[0]['id'],$condition,$postnumbers,$offset)->result_array();
			$i=1;  foreach($userFavoriteItems as $products){ $img=explode(',',$products['image']);
                        	$content .='<li>
                            	<div class="product_img">
                                	<div class="product_hide">
                                    	<div class="product_fav">';
                                            if($loginCheck !=''){
											if($products['user_id']==$loginCheck){ 
												$prod_list.='<a href="javascript:void(0);" onclick="return ownProductFav();">
																		<input type="submit" value="" class="hoverfav_icon" />
																	</a>';
											}else{
											$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($products['id']));
											if(empty($favArr)){ 
		$content .='<a href="javascript:void(0);" onClick="return changeProductToFavourite(\''.stripslashes($products['id']).'\',\'Fresh\');">
												<input type="submit" value="" class="hoverfav_icon" />
											</a>';
											} else { 
	$content .='<a href="javascript:void(0);" onClick="return changeProductToFavourite(\''.stripslashes($products['id']).'\',\'Old\');">
												<input type="submit" value="" class="hoverfav_icon1" />
											</a>';
											}} }else {
											$content .='<a href="login"  >
												<input type="submit" value="" class="hoverfav_icon" />
											</a>';
											 } 
	$content .='<div class="hoverdrop_icon">
                                    		<a href="javascript:hoverView('.$i.');">  </a>
                                        	<div class="hover_lists" id="hoverlist'.$i.'">
                                               	<h2>';
												if($this->lang->line('user_your_lists') != '') { $content .=stripslashes($this->lang->line('user_your_lists')); } else $content .= 'Your Lists'; $content .='</h2>
                                                <div class="lists_check">';
                                                	foreach($this->data['userLists'] as $Lists){ 
													$haveListIn = $this->user_model->check_list_products(stripslashes($products['id']),$Lists['id'])->num_rows();
													if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}
                                                     $content .='<input type="checkbox" class="check_box" onClick="return addproducttoList(\''.$Lists['id'].'\',\''.stripslashes($products['id']).'\');" '.$chk.' />
                                                    <label>'.$Lists['name'].'</label>';
                                                    }
                                                    if(!empty($userRegistry)){ 
														$haveRegisryIn = $this->user_model->check_registry_products($products['id'],$userRegistry->user_id)->num_rows();
														if($haveRegisryIn>0){$chk='checked="checked"';}else{ $chk='';}
													 $content .='<input type="checkbox" class="check_box" onClick="return manageRegisrtyProduct(\''.$userRegistry->user_id.'\',\''.$products['id'].'\');" '.$chk.' />
													<label><span class="registry_icon"></span>';
													if($this->lang->line('prod_wedding') != '') {  $content .= stripslashes($this->lang->line('prod_wedding')); } else  $content .= 'Wedding Registry';  $content .='</label>';
													 }  
                                                     $content .='</div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="site/user/add_list">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="'.$products['id'].'" name="productId" />
                                                        <input type="text" placeholder="';if($this->lang->line('user_new_list') != '') {  $content .= stripslashes($this->lang->line('user_new_list')); } else  $content .= 'New list';  $content .='" class="list_scroll" name="list" id="creat_list_'.$i.'" />
                                                        <input type="submit" value="';if($this->lang->line('user_add') != '') {  $content .= stripslashes($this->lang->line('user_add')); } else  $content .= 'Add';  $content .='" class="primary-button" onClick="return validate_create_list(\''.$i.'\');" />
                                                    </form>
                                                </div>
                                        	</div>
                                    	
                                   	</div>
                                        </div>
                                    </div>
                                    <a href="products/'.$products['seourl'].'">
                                    <img src="images/product/'.$img[0].'" alt="Product-1" title="Product-1" />
                                    </a>
                                </div>
                                <div class="product_title"><a href="products/'.$products['seourl'].'">'.$products['product_name'].'</a></div>
                                <div class="product_maker"><a href="shop-section/'.$products['seller_seourl'].'">'.$products['seller_businessname'].'</a></div>
                                <div class="product_price">';
                                if($products['price'] != 0.00) {
                                $content .=' <span class="currency_value">'.$this->data['currencySymbol'].' '.number_format($this->data['currencyValue']*$products['price'],2).'</span>
                                <span class="currency_code">';
                                	#if($this->lang->line('user_usd') != '') {  $content .= stripslashes($this->lang->line('user_usd')); } else  $content .= "USD"; 
                                $content .=$this->data['currencyType'].' </span>';
                                } else { 
                                 $content .='<span class="currency_value">'.$this->data['currencySymbol'].' '.number_format($this->data['currencyValue']*$products['pricing'],2).'+'.'</span>
                                <span class="currency_code">';
                                 #if($this->lang->line('user_usd') != '') {  $content .= stripslashes($this->lang->line('user_usd')); } else  $content .= "USD"; 
                                 $content .=$this->data['currencyType'].'</span>';
                                 }
                                 $content .='</div>
                            </li>';
                             $i++;  }
							 echo $content;
			
		
	}
	
	/**
	 * 
	 * To display the user invite list
	 * 
	 */
	public function display_user_invite(){
	
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		$this->data['userProfileDetails'] =$this->user_model->get_all_details(USERS,array('user_name'=>$username)); 
		if ($userProfileDetails->num_rows()==1){
				$this->data['heading'] = $this->config->item('email_title').' - Follower List';
				$this->load->view('site/user/invite_friends',$this->data);
		
		}else {
			redirect(base_url());
		}
	
	
	
	}
	
	/**
	 * 
	 * To enable the browse javascripts
	 * 
	 */
	public function enable_javascript(){
		$this->load->view('site/user/javascripts',$this->data);
	}
	
	/**
	 * 
	 * To view the twitter login page
	 * 
	 */
	public function twitter_update(){
		
		$this->load->view('site/user/twitter_settings',$this->data);
	}
	
	
	/**
	 * 
	 * To view the twitter signup page
	 * 
	 */
	public function twitter_signup(){
		
		$twitter_id = $this->session->userdata('social_login_unique_id');
		$twitter_images = $this->session->userdata('social_image_name');
		
		
		$unameArr = $this->config->item('unameArr');		
		$fullname = $this->session->userdata('social_login_name');
		$lastname = '';
		
		if($fullname==''){
			$fullname =stripslashes($this->session->userdata('screen_name').trim());
		}
		
		$email = $this->input->post('pass_email');
		$pwd = md5($this->input->post('pass_password'));
		$Confirmpwd = $this->input->post('pass_confirm_password');
		$username = stripslashes($this->session->userdata('screen_name').trim());
		
		
		if (!preg_match('/^\w{1,}$/', trim($username))){
			$this->setErrorMessage('error','User name not valid');	
			redirect('twitter-update');
		}
		elseif (in_array($username, $unameArr)){
			$this->setErrorMessage('error','User name already exists');	
			redirect('twitter-update');
		}else {
			if (valid_email($email)){
				$condition = array('user_name'=>$username);
				$duplicateName = $this->user_model->get_all_details(USERS,$condition);
				if ($duplicateName->num_rows()>0){
					$this->setErrorMessage('error','User name already exists');	
					redirect('twitter-update');
				}else {
					$condition = array('email'=>$email);
					$duplicateMail = $this->user_model->get_all_details(USERS,$condition);
					if ($duplicateMail->num_rows()>0){
						$this->setErrorMessage('error','Email id already exists');	
						redirect('twitter-update');
					}else {
						
						$time = time();
						$aff = $username.$time;
						
						$dataArr = array('full_name'=>$fullname,'user_name'=>$username,'last_name'=>$lastname,'email'=>$email,'password'=>$pwd,'status'=>'Active','twitter_id'=>$twitter_id,'thumbnail'=>$twitter_images,'is_verified'=>'Yes','commision'=>$this->config->item('product_commission'),'affiliateId'=> $aff);
						$this->user_model->simple_insert(USERS,$dataArr);
						
						$register_id = $this->db->insert_id();
						
						$this->user_model->increaseUserCredits($register_id,$username,$email);
						
						$checkUser = $this->user_model->get_all_details(USERS,array('email'=>$email));
						
						$this->session->set_userdata('quick_user_name',$email);
						$userdata = array(
								'shopsy_session_user_id' => $checkUser->row()->id,
								'shopsy_session_user_name' => $checkUser->row()->user_name,
								'shopsy_session_full_name' => $checkUser->row()->full_name,
								'shopsy_session_user_email' => $checkUser->row()->email,
								'shopsy_session_user_confirm' => $checkUser->row()->is_verified,
								'userType'=>$checkUser->row()->group
							);
						
						$this->session->set_userdata($userdata);
						$userDetails=$checkUser;
						$this->send_confirm_mail($userDetails);
						$this->setErrorMessage('success','Register and Login Successfully');	
						redirect('wpconnect.php?un='.$username.'&pd='.$pwd.'&em='.$email);
						
					}
				}
			}else {
				$this->setErrorMessage('error','Invalid email id');	
				redirect('twitter-update');
			}
		}
		
	}

	public function resetPassword(){
		
		$id=$this->uri->segment(3);
		$code=$this->uri->segment(2);
		
		$chkCode=$this->user_model->get_all_details(USERS,array('resetcode'=>$code,'resetstatus'=>'0'),array('id'=>$id));		
		if($chkCode->num_rows()>0 ){
			
			$currenttime=date('Y-m-d h:i:s');
			$password_time=$chkCode->row()->resettime;
			
			$time=date('Y-m-d h:i:s',strtotime('+1 hour',strtotime($password_time)));
			$datetime1 = new DateTime($time);
			$datetime2 = new DateTime($currenttime);

			$datetime1->diff($datetime2);	
			if($datetime2 > $datetime1){
				$this->setErrorMessage('Error','Link is Expired ! You cant reset your password');
				redirect('login');
			} else {
			$this->data['user_id']=$id;
			$this->data['heading'] = 'Password Reset'; 
			//echo "Not Expired";
			$this->load->view('site/user/password_reset',$this->data);
			}
			die;			
		} else {
			
			$this->setErrorMessage('Error','Link is invalid (or) Already Used ! You cant reset your password');
				redirect('login');
		}
	}
	public function changePasssword(){
	
		$user_id=$this->input->post('user_id');
		$password=md5($this->input->post('newPassword'));
		$this->user_model->update_details(USERS,array('password'=>$password,'resetstatus'=>'1'),array('id'=>$user_id));
		$this->setErrorMessage('success','Password Reset Successfull');
		redirect('login');
	}
	public function reflection_form()
	{
		//if ($this->checkLogin('U') == ''){
		//$lg_login=addslashes(af_lg('lg_login','You must login'));
		//	$this->setErrorMessage('error',	$lg_login);
		//		redirect(base_url());
		//}
//redirect('http://google.com',302);
$this->data['j']='j';
		$this->load->view('site/user/reflection', $this->data);
	}
	public function reflection(){
	

        //if ($this->checkLogin('U')==''){
        //$lg_login=addslashes(af_lg('lg_login','You must login'));
        //    $this->setErrorMessage('error',$lg_login);
        //    redirect(base_url());
        //}
        $reflection_type    = $this->input->post('reflection_type');
        $reflecion_url      = $this->input->post('reflection_url');
        $reflection_message = $this->input->post('reflection_message');
        $time               = time();

        $dataArr = array('user_id' => $this->checkLogin('U'), 'type' => $reflection_type, 'message' => $reflection_message, 'url' => $reflecion_url, 'time' => date("Y-m-d h:i:s"));
        if ($_FILES["reflection_img"]["name"] != "") {
            $config['overwrite']     = true;
            $config['allowed_types'] = 'jpg|jpeg|gif|png';
            $config['upload_path']   = 'images/reflection';
            $this->load->library('upload', $config);
            // echo "<pre".$_FILES["reflection_img"]["name"]."not dead</pre>";die;
            if ($this->upload->do_upload('reflection_img')) {
                $logoDetails = $this->upload->data();
                $this->ImageResizeWithCrop(1000, 1000, $logoDetails['file_name'], './images/reflection');
                @copy('./images/reflection' . $logoDetails['file_name'], './images/reflection/thumb/' . $logoDetails['file_name']);
                $this->ImageResizeWithCrop(210, 210, $logoDetails['file_name'], './images/reflection/thumb/');
                $reflection_image = $logoDetails['file_name'];
                // $dataArr=array('user_id'=> $this->checkLogin('U'),'type'=>$reflection_type,'message'=>$reflection_message,'screenshot'=>$logoDetails['file_name'], 'time'=>date("Y-m-d h:i:s"));
                $dataArr+= array('screenshot' => $reflection_image);
                // echo "<pre>not dead".$dataArr['screenshot'];die;
            } else {
                $this->setErrorMessage('error', "There was a problem with your image");
                redirect("/reflection");
            }
        } else {
            $dataArr+=array('screenshot' => 'not uploaded');
        }
        $this->user_model->simple_insert(REFLECTION, $dataArr);
        if ($this->db->affected_rows() > 0) {
            $this->setErrorMessage('success', 'Thanks for your reflection');
            redirect("/");
        } else {
            $this->setErrorMessage('error', 'Error submitting reflection');
            redirect("/reflection");
        }

    }
}

/* End of file user.php */
/* Location: ./application/controllers/site/user.php */