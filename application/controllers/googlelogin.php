<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Googlelogin extends MY_Controller {

	function __construct()
    {	
        parent::__construct();
		$this->load->model('user_model');
    }
	public function index()
	{
		$this->googleLoginProcess();
	}
	
	/* Job seeker login, registraiton and forgot password start*/

	function googleLoginProcess()
	{
	
		$getFileNameArray = explode('/',$profile_image_url);
	
		 $fileNameDetails = $getFileNameArray[7];
		 
		 $url = $twConnectId->profile_image_url;
		$img = 'images/users/'.$fileNameDetails ;
		file_put_contents($img, file_get_contents($url));
		
		
		$url = $profile_image_url;
		$img = 'images/users/'.$fileNameDetails ;
		file_put_contents($img, file_get_contents($url));
		
		/*@mysql_query("INSERT INTO google_users (api_id, full_name,email, thumbnail) VALUES ($user_id, '$user_name','$email','$fileNameDetails')");*/
		
		$google_login_details = array('social_login_name'=>$user_name,'social_login_unique_id'=>$user_id,'screen_name'=>$user_name,'social_image_name'=>$fileNameDetails);
		
		$_SESSION['social_login_name']=$user_name;
		$_SESSION['social_login_unique_id']=$user_id;
		$_SESSION['screen_name']=$user_name;
		$_SESSION['social_image_name']=$fileNameDetails;
		//redirect('signup');
		header( 'Location: '.$originalBasePath.'signup' );
		
	}
	
	function googleRedirect()
	{
		require_once 'google-login-mats/index.php';
		
		 $user_name  = '';
		 $email = '';
		if (isset($_GET['code'])) 
		{ 
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			//header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
			return;
		}
		
		
		if (isset($_SESSION['token'])) 
		{ 
				$gClient->setAccessToken($_SESSION['token']);
		}
		
		
		if ($gClient->getAccessToken()) 
		{
			  //Get user details if user is logged in
			  $user 				= $google_oauthV2->userinfo->get();
			  $user_id 				= $user['id'];
			 $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
			  $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
			  $profile_url 			= filter_var($user['link'], FILTER_VALIDATE_URL);
			  $profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
			  $personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
			
			  $_SESSION['token'] 	= $gClient->getAccessToken();
		}
		else 
		{
			//get google login url
			$authUrl = $gClient->createAuthUrl();
		}
		
		
		
		
		
		 
		if($email != '')
		{
			$googleLoginCheck = $this->user_model->googleLoginCheck($email);
			 
			
			if($googleLoginCheck > 0)
			{
				$getGoogleLoginDetails = $this->user_model->google_user_login_details($email);
				//echo "<pre>";print_r($getGoogleLoginDetails);die;
				$userdata = array(
							'shopsy_session_user_id' => $getGoogleLoginDetails['id'],
							'shopsy_session_user_name' => $getGoogleLoginDetails['user_name'], 
							'shopsy_session_user_email' => $getGoogleLoginDetails['email'], 
							'shopsy_session_full_name' => $getGoogleLoginDetails['full_name'],
							'shopsy_session_user_confirm' => $getGoogleLoginDetails['is_verified'],
							'userType'=>$getGoogleLoginDetails['group']
						);
				$this->session->set_userdata($userdata);
	
				$this->setErrorMessage('success','You are Logged In!');
				redirect('wp_user_login.php?un='.$getFacebookLoginDetails['user_name']);
				
			}
			else
			{				
				$google_login_details = array('social_login_name'=>$user_name,'social_login_unique_id'=>'','screen_name'=>$user_name,'social_image_name'=>'','social_email_name'=>$email,'loginUserType'=>'google');
				//echo "<pre>";print_r($google_login_details);die;
				//echo "redirect to registration page";
				$social_login_name = $user_name;
				$this->session->set_userdata($google_login_details);			
				#redirect('signup');	

				$firstname = $user_name;
				$lastname = '';
				$orgPass = time();
				$pwd = md5($orgPass);
				$Confirmpwd = $orgPass;
				$username = $user_name;
		
				
				$condition = array('user_name'=>$username);
			$duplicateName = $this->user_model->get_all_details(USERS,$condition);
			if ($duplicateName->num_rows()>0){
				$username = $username.$duplicateName->num_rows;
			}
				
			$time = time();
			$aff = $username.$time;
			
			$dataArr = array('user_name'=>$username,'full_name'=>$username,'email'=>$email,'password'=>$pwd,'status'=>'Active','is_verified'=>'Yes','affiliateId'=> $aff);
			$this->user_model->simple_insert(USERS,$dataArr);
						
			$register_id = $this->db->insert_id();
			//$this->user_model->increaseUserCredits($register_id);
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
				
				///////////////////////
				$this->setErrorMessage('success','Registered & Login Successfully');
				redirect('wpconnect.php?un='.$username.'&pd='.$orgPass.'&em='.$email);
			}
		}
		else
		{
			redirect('');
		}
	}
	
	function facebookRedirect()
	{
		@session_start();
		//echo $_SESSION['email'];
		
		if($_SESSION['email'] !='')
		{
			$facebookLoginCheck = $this->user_model->googleLoginCheck($_SESSION['email']);
			
			if($facebookLoginCheck > 0)
			{
				//echo "login";
				$getFacebookLoginDetails = $this->user_model->google_user_login_details($_SESSION['email']);
				//echo "<pre>";print_r($getGoogleLoginDetails);die;
				$userdata = array(
							'shopsy_session_user_id' => $getFacebookLoginDetails['id'],
							'shopsy_session_user_name' => $getFacebookLoginDetails['user_name'], 
							'shopsy_session_user_email' => $getFacebookLoginDetails['email'], 
							'shopsy_session_full_name' => $getFacebookLoginDetails['full_name'],
							'shopsy_session_user_confirm' => $getFacebookLoginDetails['is_verified'],
							'userType'=>$getFacebookLoginDetails['group'],
							'FBlogout'=>$_SESSION['FBlogout']							
							
						);
				$this->session->set_userdata($userdata);
	
				$this->setErrorMessage('success','You are Logged In!');
				redirect('wp_user_login.php?un='.$getFacebookLoginDetails['user_name']);
				//redirect(base_url());
			}
			else
			{
				
			$google_login_details = array('social_login_name'=>$_SESSION['first_name'],'social_login_unique_id'=>'','screen_name'=>$_SESSION['first_name'],'social_image_name'=>'','social_email_name'=>$_SESSION['email'],'loginUserType'=>'facebook');
			
			
			$social_login_name = $_SESSION['first_name'];
			$this->session->set_userdata($google_login_details);
			
			$fullname = $_SESSION['first_name'];
			$email = $_SESSION['email'];
			$orgPass = time();
			$pwd = md5($orgPass);
			$Confirmpwd = $orgPass;
			$username = stripslashes($_SESSION['first_name'].trim());
		
		
			$condition = array('user_name'=>$username);
			$duplicateName = $this->user_model->get_all_details(USERS,$condition);
			if ($duplicateName->num_rows()>0){
				$username = $username.$duplicateName->num_rows;
			}
				
			$time = time();
			$aff = $username.$time;
			
			$dataArr = array('user_name'=>$username,'full_name'=>$fullname,'email'=>$email,'password'=>$pwd,'status'=>'Active','is_verified'=>'Yes','affiliateId'=> $aff);
			$this->user_model->simple_insert(USERS,$dataArr);
						
			$register_id = $this->db->insert_id();
			//$this->user_model->increaseUserCredits($register_id);
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
						
			$this->setErrorMessage('success','Registered & Login Successfully');
					
			redirect('wpconnect.php?un='.$username.'&pd='.$orgPass.'&em='.$email);
	
			}
		}
		else
		{
			redirect('');
		}
		
		
	//echo "<pre>";print_r($_REQUEST);die;
	//echo "hi";die;
	}
	
	
	

}