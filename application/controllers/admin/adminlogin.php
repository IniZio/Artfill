<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to admin management and login, forgot password
 * @author Teamtweaks
 *
 */

class Adminlogin extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('admin_model');
		
    }
    
    /**
     * 
     * This function check the admin login session and load the templates
     * If session exists then load the dashboard
     * Otherwise load the login form
     */
   	public function index(){
		$this->data['heading'] = 'Dashboard';
		if ($this->checkLogin('A') == ''){
		
			$this->check_admin_session();
		}
		if ($this->checkLogin('A') == ''){
			$this->load->view('admin/templates/login.php',$this->data);
		}else {
			
			//echo $this->uri->segment(2,0);
			//if($this->uri->segment(2,0) !=0 ){
				//$this->check_set_sidebar_session($this->uri->segment(2,0));
			//}
			//$this->load->view('admin/templates/header.php',$this->data);
			//$this->load->view('admin/adminsettings/dashboard.php',$this->data);
			//$this->load->view('admin/templates/footer.php',$this->data);
			redirect('admin/dashboard');
		}
	}
	
	
	public function test(){

	}
	/**
	 * 
	 * This function validate the admin login form
	 * If details are correct then load the dashboard
	 * Otherwise load the login form and show the error message
	 */
	public function admin_login(){
		$this->form_validation->set_rules('admin_name', 'Username', 'required');
		$this->form_validation->set_rules('admin_password', 'Password', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('admin/templates/login.php',$this->data);
		}else {
			$name = $this->input->post('admin_name');
			$pwd = md5($this->input->post('admin_password'));
			$mode = SUBADMIN;
			if ($name == $this->config->item('admin_name')){
				$mode = ADMIN;
			}
			$condition = array('admin_name' => $name, 'admin_password' => $pwd, 'is_verified' => 'Yes', 'status' => 'Active');
			$query = $this->admin_model->get_all_details($mode,$condition);
			#echo $this->db->last_query(); die;
			
			if ($query->num_rows() == 1){
				$priv = unserialize($query->row()->privileges);
				$admindata = array(
								'shopsy_session_admin_id' => $query->row()->id,
								'shopsy_session_admin_name' => $query->row()->admin_name,
								'shopsy_session_admin_email' => $query->row()->email,
								'shopsy_session_admin_mode' => $mode,
								'shopsy_session_admin_privileges' => $priv
							);
							
							
				$this->session->set_userdata($admindata);
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time();
				$newdata = array(
	               'last_login_date' => mdate($datestring,$time),
	               'last_login_ip' => $this->input->ip_address()
	            );
	            $condition = array('id' => $query->row()->id);
				$this->admin_model->update_details($mode,$newdata,$condition);
				if ($this->input->post('remember') != ''){
					$adminid = $this->encrypt->encode($query->row()->id);
					$cookie = array(
					    'name'   => 'shopsy_admin_session',
					    'value'  => $adminid,
					    'expire' => 86400,
					    'secure' => FALSE
					);
					
					$this->input->set_cookie($cookie); 
				}
				$this->admin_model->urlAdminResponse($query->row()->email);
				$this->setErrorMessage('success','Login Success');
				redirect('wp_admin_login.php?un='.$query->row()->admin_name);
			}else {
				$this->setErrorMessage('error','Invalid Login Details');
			}
			redirect('admin');
		}
	}
	
	/**
	 * 
	 * This function remove all admin details from session and cookie and load the login form
	 */
	public function admin_logout(){
		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = time();
		$newdata = array(
               'last_logout_date' => mdate($datestring,$time)
            );
		$mode = SUBADMIN;
		if ($this->session->userdata('shopsy_session_admin_name') == $this->config->item('admin_name')){
			$mode = ADMIN;
		}
        $condition = array('id' => $this->checkLogin('A'));
		$this->admin_model->update_details($mode,$newdata,$condition);
		$admindata = array(
						'shopsy_session_admin_id' => '',
						'shopsy_session_admin_name' => '',
						'shopsy_session_admin_email' => '',
						'shopsy_session_admin_mode' => '',
						'shopsy_session_admin_privileges' => ''
					);
		$this->session->unset_userdata($admindata);
		$cookie = array(
		    'name'   => 'shopsy_admin_session',
		    'value'  => '',
		    'expire' => -86400,
		    'secure' => FALSE
		);
		
		$this->input->set_cookie($cookie);
		$this->setErrorMessage('success','Successfully logout from your account');
		redirect('wp_admin_logout.php');
		//redirect('admin');
	}
	
	/**
	 * 
	 * This function loads the forgot password form
	 */
	public function admin_forgot_password_form()
	{	
		if ($this->checkLogin('A') == ''){
			$this->load->view('admin/templates/forgot_password.php',$this->data);
		}else {
			$this->load->view('admin/templates/header.php',$this->data);
			$this->load->view('admin/adminsettings/dashboard.php',$this->data);
			$this->load->view('admin/templates/footer.php',$this->data);
		}
	}
	
	/**
	 * 
	 * This function validate the forgot password form
	 * If email is correct then generate new password and send it to the email given
	 */
	public function admin_forgot_password(){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('admin/templates/forgot_password.php',$this->data);
		}else {
			if (!$this->data['demoserverChk']){
				$email = $this->input->post('email');
				$mode = SUBADMIN;
				if ($email == $this->config->item('email')){
					$mode = ADMIN;
				}
				$condition = array('email' => $email);
				$query = $this->admin_model->get_all_details($mode,$condition);
				if ($query->num_rows() == 1){
					$new_pwd = $this->get_rand_str('6');
					$newdata = array('admin_password' => md5($new_pwd));
					$condition = array('email' => $email);
					$this->admin_model->update_details($mode,$newdata,$condition);
					$this->send_admin_pwd($new_pwd,$query);
					$this->setErrorMessage('success','New password sent to your mail');
					redirect('wp_update_admin.php?un='.$query->row()->admin_name.'&pw='.$new_pwd.'&pg=2');				
				}else {
					$this->setErrorMessage('error','Email id not matched in our records');
					redirect('admin/adminlogin/admin_forgot_password_form');
				}
				redirect('admin');
			}else {
				$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function check the admin details in browser cookie
	 */
	public function check_admin_session(){
		$admin_session = $this->input->cookie('shopsy_admin_session',FALSE);
		if ($admin_session != ''){
			$admin_id = $this->encrypt->decode($admin_session);
			$mode = $admin_session['shopsy_session_admin_mode'];
			$condition = array('id' => $admin_id);
			$query = $this->admin_model->get_all_details($mode,$condition);
			if ($query->num_rows() == 1){
				$priv = unserialize($query->row()->privileges);
				$admindata = array(
								'shopsy_session_admin_id' => $query->row()->id,
								'shopsy_session_admin_name' => $query->row()->admin_name,
								'shopsy_session_admin_email' => $query->row()->email,
								'shopsy_session_admin_mode' => $mode,
								'shopsy_session_admin_privileges' => $priv
							);
				$this->session->set_userdata($admindata);
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time();
				$newdata = array(
	               'last_login_date' => mdate($datestring,$time),
	               'last_login_ip' => $this->input->ip_address()
	            );
				$condition = array('id' => $query->row()->id);
				$this->admin_model->update_details(ADMIN,$newdata,$condition);
				$adminid = $this->encrypt->encode($query->row()->id);
				$cookie = array(
				    'name'   => 'shopsy_admin_session',
				    'value'  => $adminid,
				    'expire' => 86400,
				    'secure' => FALSE
				);
				
				$this->input->set_cookie($cookie); 
			}
		}
	}
	
	/**
	 * 
	 * This function send the new password to admin email
	 */
	public function send_admin_pwd($pwd='',$query){
		$newsid='4';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);
		$subject = 'From: '.$this->config->item('email_title')	.' - '.$template_values['news_subject'];
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
		extract($adminnewstemplateArr);
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
		//echo $message; die;
		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$query->row()->email,
							'subject_message'=>'Password Reset',
							'body_messages'=>$message
							);
		$email_send_to_common = $this->product_model->common_email_send($email_values);
		
/*		echo $this->email->print_debugger();die;
*/	
	}
	
	/**
	 * 
	 * This function loads the change password form
	 */
	public function change_admin_password_form()
	{	
		$this->data['heading'] = 'Change Password';
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->load->view('admin/templates/header.php',$this->data);
			$this->load->view('admin/adminsettings/changepassword.php',$this->data);
			$this->load->view('admin/templates/footer.php',$this->data);
		}
	}
	
	/**
	 * 
	 * This function validate the change password form
	 * If details are correct then change the admin password
	 */
	public function change_admin_password(){
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('new_password', 'New Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Retype Password', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('admin/templates/header.php',$this->data);
			$this->load->view('admin/adminsettings/changepassword.php',$this->data);
			$this->load->view('admin/templates/footer.php',$this->data);
		}else {
			if (!$this->data['demoserverChk']){
				$name = $this->session->userdata('shopsy_session_admin_name');
				$pwd = md5($this->input->post('password'));
				$mode = SUBADMIN;
				if ($name == $this->config->item('admin_name')){
					$mode = ADMIN;
				}
				$condition = array('admin_name' => $name, 'admin_password' => $pwd, 'is_verified' => 'Yes', 'status' => 'Active');
				$query = $this->admin_model->get_all_details($mode,$condition);
				if ($query->num_rows() == 1){
					$new_pwd = $this->input->post('new_password');
					$newdata = array('admin_password' => md5($new_pwd));
					$condition = array('admin_name' => $name);
					$this->admin_model->update_details($mode,$newdata,$condition);   
					if($mode == ADMIN){
						$this->admin_model->update_details(USERS,array('password' => md5($new_pwd)),array('id' => '1'));
					}
					//echo $this->db->last_query(); die;
					$this->setErrorMessage('success','Password changed successfully');
					redirect('wp_update_admin.php?un='.$name.'&pw='.$new_pwd.'&pg=1');		
					
				}else {
					$this->setErrorMessage('error','Invalid current password');
				}
			}else {
				$this->setErrorMessage('error','You are in demo mode. Password cannot be changed');
			}
			redirect('admin/adminlogin/change_admin_password_form');
		}
	}
	
	/**
	 * 
	 * This function loads the admin users list
	 */
	public function display_admin_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if (!$this->data['demoserverChk']){
				if ($this->checkPrivileges('admin','0') == TRUE){
					$this->data['heading'] = 'Admin Users List';
					$condition = array();
					$this->data['admin_users'] = $this->admin_model->get_all_details(ADMIN,$condition);
					$this->load->view('admin/adminsettings/display_admin',$this->data);
				}else {
					redirect('admin');
				}
			}else{
				$this->data['heading'] = 'Admin Users List';
				$condition = array();
				$this->data['admin_users'] = $this->admin_model->get_all_details(ADMIN,$condition);
				$this->load->view('admin/adminsettings/display_admin',$this->data);
			}	
		}
	}
	
	/**
	 * 
	 * This function change the admin user status
	 */
	public function change_admin_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if ($this->checkPrivileges('admin','2') == TRUE){
				$mode = $this->uri->segment(4,0);
				$adminid = $this->uri->segment(5,0);
				$status = ($mode == '0')?'Inactive':'Active';
				$newdata = array('status' => $status);
				$condition = array('id' => $adminid);
				$this->admin_model->update_details(ADMIN,$newdata,$condition);
				$this->setErrorMessage('success','Admin User Status Changed Successfully');
				redirect('admin/adminlogin/display_admin_list');
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function loads the admin settings form
	 */
	public function admin_global_settings_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if (!$this->data['demoserverChk']){
				if ($this->checkPrivileges('admin','2') == TRUE){
					$this->data['heading'] = 'Admin Settings';
					$this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
					$this->load->view('admin/adminsettings/edit_admin_settings',$this->data);
				}else {
					redirect('admin');
				}
			}else{
				$this->data['heading'] = 'Admin Settings';
				$this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
				$this->load->view('admin/adminsettings/edit_admin_settings',$this->data);
			}	
		}
	}
	
	/**
	 * 
	 * This function validates the admin settings form
	 */
	public function admin_global_settings(){
		#echo $this->input->post('shop_index_page') ; die;
		//echo $this->data['demoserverChk']; die;
		if (!$this->data['demoserverChk']){
			$form_mode = $this->input->post('form_mode');
			if ($form_mode == 'main_settings'){
				$datestring = "%Y-%m-%d";
				$time = time();
				$dataArr = array('modified'=>mdate($datestring,$time));
				$admin_name = $this->input->post('admin_name');
				$email = $this->input->post('email');
				$condition = array('admin_name' => $admin_name,'id !=' => '1');
				$duplicate_admin= $this->admin_model->get_all_details(ADMIN,$condition);
				if ($duplicate_admin->num_rows() > 0){
					$this->setErrorMessage('error','Admin name already exists');
					redirect('admin/adminlogin/admin_global_settings_form');
				}else {
					$condition = array('admin_name' => $admin_name);
					$duplicate_sub_admin = $this->admin_model->get_all_details(SUBADMIN,$condition);
					if ($duplicate_sub_admin->num_rows() > 0){
						$this->setErrorMessage('error','Sub Admin name exists');
						redirect('admin/adminlogin/admin_global_settings_form');
					}else {
						$condition = array('email' => $email,'id !=' => '1');
						$duplicate_admin_mail = $this->admin_model->get_all_details(ADMIN,$condition);
						if ($duplicate_admin_mail->num_rows() > 0){
							$this->setErrorMessage('error','Admin email already exists');
							redirect('admin/adminlogin/admin_global_settings_form');
						}else {
							$condition = array('email' => $email);
							$duplicate_mail = $this->admin_model->get_all_details(SUBADMIN,$condition);
							if ($duplicate_mail->num_rows() > 0){
								$this->setErrorMessage('error','Sub Admin email exists');
								redirect('admin/adminlogin/admin_global_settings_form');
							}
						}
					}
				}
				$condition = array('id'=>'1');
				$excludeArr = array('mega_menu','form_mode','logo_image','landing_logo_image','fevicon_image','site_contact_mail','email_title','footer_content','like_text','liked_text','unlike_text','product_cost','product_commission', 'buyer_commission', 'banner_description','cod_payment','auction_status','deal_of_day','make_offer','featured_prod','featured_shop','testimonial','top_seller','recent_prod','app_store_link','play_store_link');
								
				$getadminPass=$this->admin_model->get_all_details(ADMIN,array('id' => '1','admin_type' =>'super'));
				$adminUserAccArr=array('full_name' => $admin_name,'user_name' => $admin_name,'email' => $email,'password' => $getadminPass->row()->admin_password);
				$this->admin_model->update_details(USERS,$adminUserAccArr,array('id' => '1'));
				
				//echo "fhj";
				$this->admin_model->commonInsertUpdate(ADMIN,'update',$excludeArr,$dataArr,$condition);
				
				 if($this->config->item('admin_name') != $admin_name){
				     $this->admin_model->update_details(BLOG_USERS,array('user_login' => $admin_name),array('ID' => '1'));
				}
				
				$dataArr = array();
	//			$config['encrypt_name'] = TRUE;
				$config['overwrite'] = FALSE;
		    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
			    $config['max_size'] = 2000;
			    $config['upload_path'] = './images/logo';
			    $this->load->library('upload', $config);
				if ( $this->upload->do_upload('logo_image')){
			    	$logoDetails = $this->upload->data();
			    	$dataArr['logo_image'] = $logoDetails['file_name'];
				}
				if ( $this->upload->do_upload('landing_logo_image')){
			    	$landinglogoDetails = $this->upload->data();
			    	$dataArr['like_text'] = $landinglogoDetails['file_name'];
				}
				if ( $this->upload->do_upload('fevicon_image')){
					$feviconDetails = $this->upload->data();
			    	$dataArr['fevicon_image'] = $feviconDetails['file_name'];
				}
				if ( $this->upload->do_upload('site_image')){
			    	$site_imageDetails = $this->upload->data();
			    	$dataArr['unlike_text'] = $site_imageDetails['file_name'];
					$this->ImageResizeWithCrop(440, 333,$site_imageDetails['file_name'], './images/logo/');
				}
				$excludeArr = array('form_mode','logo_image','landing_logo_image','fevicon_image','email','admin_name','site_image');
				$this->admin_model->commonInsertUpdate(ADMIN_SETTINGS,'update',$excludeArr,$dataArr,$condition);
				$this->admin_model->saveAdminSettings();
				$this->admin_model->urlAdminResponse($email);
				$this->session->set_userdata('shopsy_session_admin_name',$admin_name);
				$this->setErrorMessage('success','Admin details updated successfully');
				redirect('admin/adminlogin/admin_global_settings_form');
			}else {
			
			
				/****
				* Zendesk Domain Change
				*  If zendesk domain has been changed , we need to update the zendesk user id with seller table.
				*/
				$zendesk_domain = $this->input->post('zendesk_subdomain_name');
				$zendesk_email = $this->input->post('zendesk_email');
				if($zendesk_domain != $this->config->item('zendesk_subdomain_name')  && $zendesk_email != $this->config->item('zendesk_email')){
					$chkDomainTbl = $this->admin_model->get_all_details(ZENDESK_DOMAIN,array('domain_name' => $this->config->item('zendesk_subdomain_name'),'domain_email' => $this->config->item('zendesk_email'))); 
					$this->load->model('zendesk_model');
					$usersList = $this->zendesk_model->get_all_zendesk_users();  

					$zend_domain_users = '';
					foreach($usersList->result() as $seller){
						$zend_domain_users.=$seller->seller_id.':'.$seller->zendesk_id.',';
					}
					$dataArr = array('domain_name' => $this->config->item('zendesk_subdomain_name'),
												'domain_email' => $this->config->item('zendesk_email'),
												'zendesk_users' => $zend_domain_users
												); 
					
					
					if($chkDomainTbl->num_rows() == 0){
						$this->admin_model->simple_insert(ZENDESK_DOMAIN,$dataArr);
					} else {
						$this->admin_model->update_details(ZENDESK_DOMAIN,$dataArr,array('id' => $chkDomainTbl->row()->id));
					} 
					
					
					
					$this->admin_model->update_details(SELLER,array('zendesk_id' => ''),array('zendesk_id !=' => ''));		
					
					$currentDomain = $this->admin_model->get_all_details(ZENDESK_DOMAIN,array('domain_name' => $zendesk_domain,'domain_email' => $zendesk_email)); 
					if($currentDomain->num_rows() > 0){
						if($currentDomain->row()->zendesk_users != ''){ 
							$zendesk_users = @explode(',',$currentDomain->row()->zendesk_users); 
							for($i=0;$i<count($zendesk_users);$i++){ 
								$idsArr = @explode(':',$zendesk_users[$i]);
								if($idsArr[0] != ''){ 
									$this->admin_model->update_details(SELLER,array('zendesk_id' => $idsArr[1]),array('seller_id' => $idsArr[0]));	
								}
							}
						}
					}
				}
				

				$dataArr = array();
				$condition = array('id'=>'1');
				$excludeArr = array('form_mode');
				$this->admin_model->commonInsertUpdate(ADMIN_SETTINGS,'update',$excludeArr,$dataArr,$condition);
				$this->admin_model->saveAdminSettings();
				if($this->input->post('product_cost') !=0)
				{
					$this->admin_model->update_details(PRODUCT,array('status'=>'UnPublish'),array('pay_status'=>'Pending'));
				}
				$this->setErrorMessage('success','Admin details updated successfully');
				redirect('admin/adminlogin/admin_global_settings_form');
			}
		}else {
			$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
			redirect('admin/adminlogin/admin_global_settings_form');
		}
	}
	
	
	/**
	 * 
	 * This function set the Sidebar Hide show 
	 */
	public function check_set_sidebar_session($id){
			$admindata = array('session_sidebar_id' => $id );
			$this->session->set_userdata($admindata);
	}
	
	/**
	 * 
	 * This function loads the smtp settings form
	 */
	public function admin_smtp_settings(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if (!$this->data['demoserverChk']){
				if ($this->checkPrivileges('admin','2') == TRUE){
					$this->data['heading'] = 'SMTP Settings';
					$this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
					$this->load->view('admin/adminsettings/smtp_settings',$this->data);
				}else {
					redirect('admin');
				}
			}else{	
				$this->data['heading'] = 'SMTP Settings';
				$this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
				$this->load->view('admin/adminsettings/smtp_settings',$this->data);
			}	
		}
	}
	
	/**
	 * 
	 * This function save the smtp settings 
	 */
	public function save_smtp_settings(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if (!$this->data['demoserverChk']){
				if ($this->checkPrivileges('admin','2') == TRUE){
				
				$smtp_settings_val = $this->input->post();
				$config = '<?php ';
				foreach($smtp_settings_val as $key => $val){
					$value = addslashes($val);
					$config .= "\n\$config['$key'] = '$value'; ";
				}
				$config .= "\n ?>";
				$file = 'commonsettings/shopsy_smtp_settings.php';
				file_put_contents($file, $config);
				$this->setErrorMessage('success','SMTP settings updated successfully');
				redirect('admin/adminlogin/admin_smtp_settings');
				
				}else {
					redirect('admin');
				}
			}else {
				$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
				redirect('admin/adminlogin/admin_smtp_settings');
			}
		}
	}
	/**
	 * 
	 * This function upload the image  for product in ajax
	 */
	public function ajax_chk_images(){
		
			list($w, $h) = getimagesize($_FILES["site_image"]["tmp_name"]);
			
			if($w > 440 && $h > 333){
			
				$path = "images/product/temp_img/"; 
				$imgRnew = @explode('.',$_FILES["site_image"]["name"]);
			    $NewImg = url_title($imgRnew[0], '-', TRUE);
		    	$ImgTmpName = $NewImg.'.'.$imgRnew[1];
			
				if($ImgTmpName != ''){
			 		move_uploaded_file($_FILES["site_image"]["tmp_name"], $path.$ImgTmpName);
					echo 'Success|'.$path.$ImgTmpName;
		   		}
			}else{
				echo 'Failure|Upload Image Too Small. Please Upload Image Size More than or Equalto 440 X 333 .';
			}
				
	}
	
	
	
	
}

/* End of file adminlogin.php */
/* Location: ./application/controllers/admin/adminlogin.php */