<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invitefriend extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('product_model','product');
		$this->load->model('user_model');
	}
	
	/**
	 * 
	 * This function is used for invite the twitter friends
	 * 
	 */
	public function twitter_login(){
		require("twitter/twitteroauth.php");
		require "twitter/config.php";
		session_start();
		$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
		$request_token = $twitteroauth->getRequestToken(base_url().'site/invitefriend/TwitterloginRedirect');
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		if($twitteroauth->http_code == 200){
			$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
			header('Location: ' . $url);
		}else{
			die('Something wrong happened.');
		}
	}
	
	/**
	 * 
	 * This function is used for redirect the twitter login
	 * 
	 */
	public function TwitterloginRedirect(){
		require("twitter/twitteroauth.php");
		require "twitter/config.php";
		session_start();
		if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
			$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
			$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
			$_SESSION['access_token'] = $access_token;
			$user_info = $twitteroauth->get('account/verify_credentials');
			$twitterId = $user_info->id;
			
			$twitterLoginCheck = $this->user_model->googleTwitterCheck($twitterId);
			
			if($twitterLoginCheck > 0)
			{
				//echo "login";
				$getTwitterLoginDetails = $this->user_model->twitter_user_login_details($twitterId);
				//echo "<pre>";print_r($getGoogleLoginDetails);die;
				$userdata = array(
							'shopsy_session_user_id' => $getTwitterLoginDetails['id'],
							'shopsy_session_user_name' => $getTwitterLoginDetails['user_name'], 
							'shopsy_session_user_email' => $getTwitterLoginDetails['email'], 
							'shopsy_session_full_name' => $getTwitterLoginDetails['full_name'],
							'shopsy_session_user_confirm' => $getTwitterLoginDetails['is_verified'],
							'userType'=>$getTwitterLoginDetails['group']
													
							
						);
				$this->session->set_userdata($userdata);
	
				$this->setErrorMessage('success','You are Logged In!');
				redirect('wp_user_login.php?un='.$getFacebookLoginDetails['user_name']);
				
				
				
				
			}else{
				$getFileNameArray = explode('/',$user_info->profile_image_url);
				$fileNameDetails = $getFileNameArray[5];
				if($fileNameDetails != ''){
					$fileNameDetails = $getFileNameArray[5];
				}else{
					$fileNameDetails = '';
				}
				$twitter_login_details = array('social_login_name'=>$user_info->name,'social_login_unique_id'=>$user_info->id,'screen_name'=>$user_info->screen_name,'social_image_name'=>$fileNameDetails);
				$url = $user_info->profile_image_url;
				$img = 'images/users/'.$fileNameDetails ;
				$img1 = 'images/users/thumb/'.$fileNameDetails ;
				file_put_contents($img, file_get_contents($url));
				file_put_contents($img1, file_get_contents($url));
				//echo "redirect to registration page";
				$social_login_name = $user_info->name;
				$this->session->set_userdata($twitter_login_details);
				//echo $a =$this->session->userdata($twise);
				redirect('twitter-update');
			}
		}else{
			redirect('signup');
		}
	}
	
	/**
	 * 
	 * This function is used for get the twitter friends
	 * 
	 */
	public function twitter_friends(){
		$returnStr['status_code'] = 1;
		$returnStr['url'] = base_url().'site/invitefriend/get_twitter';
		$returnStr['message'] = '';
		echo json_encode($returnStr);
	}
	
	/**
	 * 
	 * This function is used for twitter request
	 * 
	 */
	public function twitter_request(){
		$userDetails = $this->product->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
		$link = base_url();
		$full_name = $userDetails->row()->full_name;
		if ($full_name=='') $full_name = $userDetails->row()->user_name;
//		$invite_text = 'Invites you to join on '.$this->data['siteTitle'].' ('.base_url().'?ref='.$userDetails->row()->user_name.')';
		$invite_text = $full_name.' invites you to join on '.$this->data['siteTitle'];
		require_once('twitter/codebird.php');
		require "twitter/config.php";
		\Codebird\Codebird::setConsumerKey(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
		$cb = \Codebird\Codebird::getInstance();
		$cb->setToken($this->config->item('twitter_access_token'), $this->config->item('twitter_access_token_secret'));
		$reply = $cb->directMessages_new(array(
			'text' => $invite_text,
			'user_id'=>$this->input->post('twid'),
		));
		if($reply->httpstatus == 200){
			echo "send";
		}else{
			echo $reply->errors[0]->message;
		}
	}
	
	/**
	 * 
	 * This function is used for get twitter request
	 * 
	 */
	public function get_twitter(){
		require("twitter/twitteroauth.php");
		require "twitter/config.php";
		session_start();
		$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
		$request_token = $twitteroauth->getRequestToken(base_url().'site/invitefriend/getTwitterData');
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		if ($twitteroauth->http_code == 200) {
			$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
			header('Location: ' . $url);
		} else {
			die('Something wrong happened.');
		}
	}
	
	/**
	 * 
	 * This function is used for retrive the twitter data
	 * 
	 */
	public function getTwitterData(){
		require("twitter/twitteroauth.php");
		require "twitter/config.php";
		session_start();
		if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
			$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
			$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
			$_SESSION['access_token'] = $access_token;
			$user_info = $twitteroauth->get('account/verify_credentials');
			$uid = $user_info->id;
			$username = $user_info->name;
			$friends = $user_info->friends_count;
			if($friends>0){
				$param_arr = array(
				'screen_name'=>$user_info->screen_name
				);
				$tw_friends_list = $twitteroauth->get('https://api.twitter.com/1.1/friends/list.json',$param_arr);
				
				print_r($tw_friends_list);
				$html = "<html><body><div style='height:auto; text-align:center;'>";
				foreach($tw_friends_list->users as $tw_friends_detail){
					$html .= '<div style="float:left; width:100%; height:75px; border-bottom:1px solid #ddd; padding-top:5px; padding-bottom:5px;">';
					$html .= '<div style="float:left; width:11%"><img style="float:left; height:75px; width:75px;" src="'.$tw_friends_detail->profile_image_url.'" /></div>';
					$html .= '<div style="text-align:left;float:left; width:30%; margin:20px 0 0 20px">'.$tw_friends_detail->name.'</div>';
					$html .= '<div style="float:right; margin:20px 0 0 20px"><input style="cursor:pointer; width:100px; color:white; font-size:17px; border-radius:5px; background:rgb(58, 126, 199); border:none; height:40px; margin-right:20px;" type="button" id="'.$tw_friends_detail->id.'" onclick="TwitterInvite(this);" value="Invite"></div>';
					$html .= '</div>';
				}
				$html .= '<input class="twitter_done" type="button" value="Done" style="cursor:pointer;width:100px; color:white; font-size:13px; background:rgb(58, 126, 199); border:none; height:40px; margin-top:10px; border-radius:5px;">';
				$html .= '</div></body></html>';
			}
			echo $html;
			echo "<script type='text/javascript' src='".base_url()."js/site/jquery-1.7.1.min.js'></script>
			<script type='text/javascript'>
				function TwitterInvite(evt){
					if($(evt).hasClass('processing')) return;
					$(evt).addClass('processing');
					$(evt).parent().append('<img src=\'".base_url()."images/twit_loader.gif\'>');
					var id =evt.id;
					var url = '".base_url()."site/invitefriend/twitter_request';
					$.post(url,{'twid':id},function(data){
						if(data == 'send'){
							$(evt).parent().find('img:last').remove();
							$(evt).val('Invited');
						}else{
							alert(data);
							$(evt).parent().find('img:last').remove();
						}
					});
				}
				$('.twitter_done').click(function(){
					window.close();
				});
			</script>";
		}else{
			echo "<script type='text/javascript'>
					window.close();
				</script>";
		}
	}
}

