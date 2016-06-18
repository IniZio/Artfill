<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * 
 * User related functions
 * @author Teamtweaks
 *
 **/ 
class Invite_friends extends MY_Controller { 

	function __construct(){
	
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->library('session');
		$this->load->model('invite_model');
		  
		
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
	 }
	 
	 /** 
	 * 
	 * Displaying the invite friends list
	 *
	 */
	 public function display_invite_friends(){
	 
	 
	 	$id =  $this->checkLogin('U');
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('id'=>$id));
		$this->data['userProfileDetails'] =$this->user_model->get_all_details(USERS,array('id'=>$id));	 
		$this->data['get_admin_details'] = $get_admin_details = $this->invite_model->get_all_details(ADMIN_SETTINGS,array())->result();	 
	 if($this->checkLogin('U')==''){
	 
			redirect('signup');
	 }else{
			$this->data['heading'] = 'Invite friends';
			$this->load->view('site/invite/display_invite_friends',$this->data);
		}
	}	 

	/** 
	 * 
	 * retrive the google friends invite
	 *
	 */
 public function google_invites(){

  	$id =  $this->checkLogin('U');
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('id'=>$id));
		$this->data['userProfileDetails'] =$this->user_model->get_all_details(USERS,array('id'=>$id)); 
	
 $this->data['get_admin_details'] = $get_admin_details = $this->invite_model->get_all_details(ADMIN_SETTINGS,array())->result();
 $this->data['get_admin_details'] = $get_admin_details = $this->invite_model->get_all_details(ADMIN_SETTINGS,array())->result();
 $this->data['get_useradmin_details'] = $get_useradmin_details = $this->invite_model->get_all_details(ADMIN,array())->result();
 $this->data['get_userall_details'] = $get_userall_details = $this->invite_model->get_all_details(USERS,array('id' =>$this->checkLogin('U')))->result();
 $this->data['get_userallglobal_details'] = $get_userallglobal_details = $this->invite_model->get_all_details(USERS,array())->result();

 $client_id = $get_admin_details[0]->google_invite_client_id;
 $client_secret = $get_admin_details[0]->google_invite_client_secret_id;
 $redirect_uri = $get_admin_details[0]->google_invite_redirect_url;
	$max_results = 1000;

	$auth_code = $_GET["code"];

				function curl_file_get_contents($url)
				{
				 $curl = curl_init();
				 $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
				 
				 curl_setopt($curl,CURLOPT_URL,$url);	//The URL to fetch. This can also be set when initializing a session with curl_init().
				 curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);	//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
				 curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);	//The number of seconds to wait while trying to connect.	
				 
				 curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);	//The contents of the "User-Agent: " header to be used in a HTTP request.
				 curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);	//To follow any "Location: " header that the server sends as part of the HTTP header.
				 curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);	//To automatically set the Referer: field in requests where it follows a Location: redirect.
				 curl_setopt($curl, CURLOPT_TIMEOUT, 10);	//The maximum number of seconds to allow cURL functions to execute.
				 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);	//To stop cURL from verifying the peer's certificate.
				 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
				 
				 $contents = curl_exec($curl);
				 curl_close($curl);
				 return $contents;
				}

						$fields=array(
							'code'=>  urlencode($auth_code),
							'client_id'=>  urlencode($client_id),
							'client_secret'=>  urlencode($client_secret),
							'redirect_uri'=>  urlencode($redirect_uri),
							'grant_type'=>  urlencode('authorization_code')
						);
						
						$post = '';
						foreach($fields as $key=>$value) { $post .= $key.'='.$value.'&'; }
						$post = rtrim($post,'&');

						$curl = curl_init();
						curl_setopt($curl,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
						curl_setopt($curl,CURLOPT_POST,5);
						curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
						curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
						curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
						$result = curl_exec($curl);
						curl_close($curl);

	$response =  json_decode($result);
	$accesstoken = $response->access_token;

$url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&oauth_token='.$accesstoken;
$xmlresponse =  curl_file_get_contents($url);
if((strlen(stristr($xmlresponse,'Authorization required'))>0) && (strlen(stristr($xmlresponse,'Error '))>0))
{
	echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
	exit();
}
$xml =  new SimpleXMLElement($xmlresponse);
$xmls = simplexml_load_string($xmlresponse, 'SimpleXMLElement', LIBXML_NOCDATA);
$array = json_decode(json_encode($xmls), TRUE);

$xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
$result = $xml->xpath('//gd:email');

foreach ($result as $title) {
					$MyEmailAddressNew[] = $title->attributes()->address;
		}

foreach($MyEmailAddressNew as $MyEmailAddressNewLists){
					$MyEmailAddressNewListsArr[] = $MyEmailAddressNewLists;
		}
		
		
  $MyEmailAddressNews = implode(',',$MyEmailAddressNewListsArr);
  
  
   $this->session->set_userdata('frnd_id',$MyEmailAddressNews); 
  $this->session->set_userdata('my_id',$array['id']); 
  $this->session->set_userdata('my_title',$array['title']); 

redirect('settings/google-invites-return');

}
	/** 
	 * 
	 * Displaying the retrive invite list
	 *
	 */
	public function display_return_invite_list(){
if($this->checkLogin('U')==''){
	 
			redirect('signup');
}else{

 	$id =  $this->checkLogin('U');
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('id'=>$id));
		$this->data['userProfileDetails'] =$this->user_model->get_all_details(USERS,array('id'=>$id)); 
	 $this->data['get_admin_details'] = $get_admin_details = $this->invite_model->get_all_details(ADMIN_SETTINGS,array())->result();
 $this->data['get_admin_details'] = $get_admin_details = $this->invite_model->get_all_details(ADMIN_SETTINGS,array())->result();	
  $this->data['get_useradmin_details'] = $get_useradmin_details = $this->invite_model->get_all_details(ADMIN,array())->result();
  
    $this->data['get_userall_details'] = $get_userall_details = $this->invite_model->get_all_details(USERS,array('id' =>$this->checkLogin('U')))->result();
    $this->data['get_userallglobal_details'] = $get_userallglobal_details = $this->invite_model->get_all_details(USERS,array())->result();


		$de_my_frnds_lists = $this->session->userdata('frnd_id');
		$de_my_email_list = $this->session->userdata('my_id');
		$de_my_title_list = $this->session->userdata('my_title');

		$ex_my_frnds_list = explode(',',$de_my_frnds_lists);
		$my_email_list = $de_my_email_list;

		foreach($ex_my_frnds_list as $ex_my_frnds_listArr){
			if($my_email_list!=$ex_my_frnds_listArr){
							$ex_my_frnds_listArrlists[] = $ex_my_frnds_listArr;
		}
}
$this->data['FriendsEmailAddress'] = $FriendsEmailAddress = $ex_my_frnds_listArrlists;
$this->data['MyemailAddressOrg'] = $MyemailAddressOrg = $my_email_list;
$de_my_title_list_new = str_replace("Contacts","",$de_my_title_list);
$this->data['MyNameTitleOrg'] = $MyNameTitleOrg = $de_my_title_list_new;
			$this->data['heading'] = 'Invite friends';
		if($this->session->userdata('frnd_id')!=''){
			$this->load->view('site/invite/display_return_invite_list',$this->data);
		}else{
				redirect('settings/invite-friends');		
		}
		}
	}		
	
	/** 
	 * 
	 * Retrive the facebook friends for invite
	 *
	 */
 public function facebook_invites(){
	 
	 	 print_r('facebook');

	 if($this->checkLogin('U')==''){
	 
			redirect('signup');
	 }else{
			$this->data['heading'] = 'Invite friends';
			$this->load->view('site/invite/display_invite_friends',$this->data);
		}
	}	  	 	
	
	/** 
	 * 
	 * Send the invitation mail for all friends
	 *
	 */
public function invite_send_mail(){


 if($this->checkLogin('U')==''){
	 
			redirect('signup');
 }else{

$newsid='18';


$template_values=$this->invite_model->get_newsletter_template_details($newsid);
		
		$site_url=base_url();
		$friend_name=$_GET['MyNameTitleOrg'];

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
		
		
		 $email = implode(",",$_GET['emailID']);
		

		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$_GET['MyemailAddressOrg'],
							'mail_name'=>$_GET['MyNameTitleOrg'],
							'to_mail_id'=>$sender_email,
							'bcc_mail_id' =>$email,
							'subject_message'=>$_GET['MyNameTitleOrg'].' '.$template_values['news_subject'],
							'body_messages'=>$message
							);
		$email_send_to_common = $this->invite_model->common_email_send($email_values);
    	$this->setErrorMessage('success','Invitation send successfully');
	
			$this->session->unset_userdata('frnd_id');
			$this->session->unset_userdata('my_id');
			$this->session->unset_userdata('my_title');

		redirect('home');
		}


}

	/** 
	 * 
	 * Retrive the data from url using curl
	 *
	 */
public function curl_file_get_contents($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
} 	

public function twitter_friends(){
		$returnStr['status_code'] = 1;
		$returnStr['url'] = base_url().'site/invite_friends/get_twitter';
		$returnStr['message'] = '';
		echo json_encode($returnStr);
	}
	
	public function get_twitter(){
		require("twitter/twitteroauth.php");
		require "twitter/config.php";
		session_start();
		$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
		$request_token = $twitteroauth->getRequestToken(base_url().'site/invite_friends/getTwitterData');
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		if ($twitteroauth->http_code == 200) {
			$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
			header('Location: ' . $url);
		} else {
			die('Something wrong happened.');
		}
	}	
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
				//print_r($tw_friends_list); die;
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
					var url = '".base_url()."site/invite_friends/twitter_request';
					$.post(url,{'twid':id},function(data){
						if(data == 'send'){
							$(evt).parent().find('img:last').remove();
							$(evt).val('Invited');
						} else {
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
	public function twitter_request(){
		$userDetails = $this->invite_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
		$link = base_url();
		$full_name = $userDetails->row()->full_name;
		if ($full_name=='') $full_name = $userDetails->row()->user_name;
		//$invite_text = 'Invites you to join on '.$this->data['siteTitle'].' ('.base_url().'?ref='.$userDetails->row()->user_name.')';
		$invite_text = 'Invites you to join on '.$this->data['siteTitle'].' ('.base_url().'?aff='.$userDetails->row()->affiliateId.')';
		//$invite_text = $full_name.' invites you to join on '.$this->data['siteTitle'];
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
}
/* End of file user.php */
/* Location: ./application/controllers/site/user.php */