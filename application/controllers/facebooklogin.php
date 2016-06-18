<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Facebooklogin extends MY_Controller {

	function __construct()
    {	
        parent::__construct();
		$this->load->model('user_model');
    }
    
    function index(){
    	$this->login_process();
    }
    
	function login_process(){
		require APPPATH.'third_party/facebook/facebook.php';
		$basepathurl = base_url();
		
		/** Check whether the user cancelled the process start **/
		$error = '';
		if ($this->input->get('error')!=''){
			$error = $this->input->get('error');
		}
		if ($error!=''){
			$this->setErrorMessage('error',$error);
			redirect(base_url().'login');exit();
		} else {
			if ($this->input->get('close')!=''){
				$this->setErrorMessage('error','Something went wrong');
				redirect(base_url().'login');exit();
			}
		} 
		/** Check whether the user cancelled the process end **/
		
		$app_id = $this->config->item('facebook_app_id');
		$app_secret = $this->config->item('facebook_app_secret');
		$my_url = base_url().'facebooklogin/login_process';
		
		if($this->input->get("code")!='')
		{
			$code = $this->input->get("code");
		}
		else
		{
			$code = 0;
		}
		if(empty($code)) {
			$this->session->set_userdata('state',md5(uniqid(rand(), TRUE))); // CSRF protection
			$dialog_url = "https://www.facebook.com/dialog/oauth?client_id="
					. $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
							. $this->session->userdata('state') . "&scope=email";
		
			redirect($dialog_url);exit();
		}
		
		if(($this->session->userdata('state')!='') && ($this->session->userdata('state') === $this->input->get('state'))) {
			$token_url = "https://graph.facebook.com/oauth/access_token?"
					. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
					. "&client_secret=" . $app_secret . "&code=" . $code;
		
			$URL = $token_url;
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$URL);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
			$pageContent = curl_exec($curl_handle);
			curl_close($curl_handle);
		
			$response = $pageContent;
			//echo "<pre>";print_r($response);//die;
			$params = null;
			parse_str($response, $params);
		
			$this->session->set_userdata('access_token',$params['access_token']);
		
			$graph_url = "https://graph.facebook.com/me?access_token="
					. $params['access_token'].'&fields=email,first_name,last_name';
		
			$FBlogout='https://www.facebook.com/logout.php?next='.$basepathurl.'logout%3Fsecret%3D&access_token='.$params['access_token'];
		
		
			$URL1 = $graph_url;
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$URL1);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
			$pageContent1 = curl_exec($curl_handle);
			curl_close($curl_handle);
		
			$user = json_decode($pageContent1);
			
// 			echo "<pre>";print_r($user);die;
			
			if(!empty($user))
			{
				$username = @explode('@',$user->email);
		
				$facebookLoginCheck = $this->user_model->googleLoginCheck($user->email);
					
				if($facebookLoginCheck > 0)
				{
					//echo "login";
					$getFacebookLoginDetails = $this->user_model->google_user_login_details($user->email);
					//echo "<pre>";print_r($getGoogleLoginDetails);die;
					$userdata = array(
							'shopsy_session_user_id' => $getFacebookLoginDetails['id'],
							'shopsy_session_user_name' => $getFacebookLoginDetails['user_name'],
							'shopsy_session_user_email' => $getFacebookLoginDetails['email'],
							'shopsy_session_full_name' => $getFacebookLoginDetails['full_name'],
							'shopsy_session_user_confirm' => $getFacebookLoginDetails['is_verified'],
							'userType'=>$getFacebookLoginDetails['group'],
							'FBlogout'=>$FBlogout
								
					);
					$this->session->set_userdata($userdata);
				
					$this->setErrorMessage('success','You are Logged In!');
					redirect('wp_user_login.php?un='.$getFacebookLoginDetails['user_name']);
					//redirect(base_url());
				}
				else
				{
				
					$google_login_details = array('social_login_name'=>$user->first_name,'social_login_unique_id'=>$user->id,'screen_name'=>$user->first_name,'social_image_name'=>'','social_email_name'=>$user->email,'loginUserType'=>'facebook');
						
						
					$social_login_name = $user->first_name;
					$this->session->set_userdata($google_login_details);
						
					$fullname = $user->first_name;
					$email = $user->email;
					$orgPass = time();
					$pwd = md5($orgPass);
					$Confirmpwd = $orgPass;
					$username = stripslashes($user->first_name.trim());
				
				
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
				$this->setErrorMessage('error','Something went wrong');
				redirect(base_url().'login');
			}
			 
		} else {
			$this->setErrorMessage('error','Something went wrong');
			redirect(base_url().'login');
		}
	}
	
}