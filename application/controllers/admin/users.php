<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Users extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('user_model','seller_model'));
	
		if ($this->checkPrivileges('user',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the users list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/users/display_user_list');
		}
	}
	
	/**
	 * 
	 * This function loads the users list page
	 */
	public function display_user_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Users List';
			
			$usersCount = $this->user_model->get_total_user_count();
			//echo '<pre>'; print_r($usersCount);die;
			
			$this->data['UsersCount'] = $usersCount;
			$this->data['activeCount'] = $this->user_model->get_total_user_count('active');
			$this->data['inactiveCount'] = $this->user_model->get_total_user_count('inactive');
			$this->data['deletedCount'] =  $this->user_model->get_total_user_count('deleted');

			$status = '';
			if($_GET['status']){$status = $_GET['status'];}
			if($status == 'active'){ $usersCount = $this->data['activeCount']; }
			if($status == 'inactive'){ $usersCount = $this->data['inactiveCount']; $status == 'Inactive'; }
			if($status == 'deleted'){ $usersCount = $this->data['deletedCount']; $status == 'Deleted';}
		
			if($usersCount > 1000){
				$searchPerPage = 50;
// 			if($usersCount > 10){
// 				$searchPerPage = 5;
				$paginationNo = $this->uri->segment(4);  	
				if($paginationNo == ''){
					$paginationNo = 0;
				} else {
					$paginationNo = $paginationNo;
				}
				
				$this->db->select('*');
				$this->db->from(USERS);
				$this->db->where('group','User');
				if($status !=''){
					$this->db->where('status',''.$status.'');
				}
				$this->db->order_by('created','desc');
				$this->db->limit($searchPerPage,$paginationNo);
				$this->data['usersList'] = $this->db->get();
				//echo $this->db->last_query();die;
				
				$searchbaseUrl = 'admin/users/display_user_list/';
				$config['num_links'] = 3;
				$config['display_pages'] = TRUE; 
				$config['base_url'] = $searchbaseUrl;
				$config['total_rows'] = $usersCount;
				$config["per_page"] = $searchPerPage;
				$config["uri_segment"] = 4;
				$config['first_link'] = '';
				$config['last_link'] = '';
				$config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
				$config['full_tag_close'] = '</ul>';
				$config['prev_link'] = 'Prev';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = 'Next';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="current"><a href="javascript:void(0);" style="cursor:default;">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['first_link'] = 'First';
				$config['last_link'] = 'Last';
				
				
				if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
				
				$this->pagination->initialize($config); 
				$paginationLink = $this->pagination->create_links(); 
				$this->data['paginationLink'] = $paginationLink;

				$this->load->view('admin/users/display_userlist_pagination',$this->data);
			} else {
				//$condition = array('group'=>'User');
					$condition['group'] = 'User';
				if($status != ''){
					$condition['status'] = $status;
				}
				
				$sortArr2 = array('field'=>'created','type'=>'desc');
				$sortArr1 = array($sortArr2);
				
				$this->data['usersList'] = $this->user_model->get_all_details(USERS,$condition,$sortArr1);
				$this->load->view('admin/users/display_userlist',$this->data);
			}
		}
	}
	
	/**
	 * 
	 * This function loads the users dashboard
	 */
	public function display_user_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Users Dashboard';
			$condition = 'order by `created` desc';
			$this->data['usersList'] = $this->user_model->get_users_details($condition);
			$this->load->view('admin/users/display_user_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new user form
	 */
	public function add_user_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New User';
			$this->load->view('admin/users/add_user',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditUser(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$user_id = $this->input->post('user_id');
			$user_name = $this->input->post('user_name');
			$password = md5($this->input->post('new_password'));
			$newPass = $this->input->post('new_password');
			$email = $this->input->post('email');
			if ($user_id == ''){
				$unameArr = $this->config->item('unameArr');
				if (!preg_match('/^\w{1,}$/', trim($user_name))){
					$this->setErrorMessage('error','User name not valid. Only alphanumeric allowed');
					echo "<script>window.history.go(-1);</script>";exit;
				}
				if (in_array($user_name, $unameArr)){
					$this->setErrorMessage('error','User name already exists');
					echo "<script>window.history.go(-1);</script>";exit;
				}
				$condition = array('user_name' => $user_name);
				$duplicate_name = $this->user_model->get_all_details(USERS,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','User name already exists');
					redirect('admin/users/add_user_form');
				}else {
					$condition = array('email' => $email);
					$duplicate_mail = $this->user_model->get_all_details(USERS,$condition);
					if ($duplicate_mail->num_rows() > 0){
						$this->setErrorMessage('error','User email already exists');
						redirect('admin/users/add_user_form');
					}
				}
			}
			$excludeArr = array("user_id","thumbnail","new_password","confirm_password","group","status");
			if ($this->input->post('group') != ''){
				$user_group = 'User';
			}else {
				$user_group = 'Seller';
			}
			if ($this->input->post('status') != ''){
				$user_status = 'Active';
			}else {
				$user_status = 'Inactive';
			}
			$inputArr = array('group' => $user_group, 'status' => $user_status);
			if ($user_group == 'Seller'){
				$inputArr['request_status'] = 'Approved';
			}
			$datestring = "%Y-%m-%d";
			$time = time();
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
	    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
		    $config['max_size'] = 2000;
		    $config['upload_path'] = './images/users';
		    $this->load->library('upload', $config);
			if ( $this->upload->do_upload('thumbnail')){
		    	$logoDetails = $this->upload->data(); 
				$this->ImageResizeWithCrop(600, 600, $logoDetails['file_name'], './images/users/');
				@copy('./images/users/'.$logoDetails['file_name'], './images/users/thumb/'.$logoDetails['file_name']);
				$this->ImageResizeWithCrop(210, 210, $logoDetails['file_name'], './images/users/thumb/');
				$profile_image=$logoDetails['file_name'];				
		    	$inputArr['thumbnail'] = $logoDetails['file_name'];
			}
			if ($user_id == ''){
				$user_data = array(
					'password'	=>	$password,
					'is_verified'	=>	'Yes',
					'created'	=>	mdate($datestring,$time),
					'modified'	=>	mdate($datestring,$time),
				);
			}else {
				$user_data = array('modified' =>	mdate($datestring,$time));
			}
			$dataArr = array_merge($inputArr,$user_data);
			$condition = array('id' => $user_id);
			if ($user_id == ''){
				$this->user_model->commonInsertUpdate(USERS,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','User added successfully');
				redirect('wpconnectuser.php?un='.$user_name.'&pd='.$newPass.'&em='.$email);
			}else {
				$this->user_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','User updated successfully');
				redirect('admin/users/display_user_list');
			}
			
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_user_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit User';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['user_details'] = $this->user_model->get_all_details(USERS,$condition);
			if ($this->data['user_details']->num_rows() == 1){
				$this->load->view('admin/users/edit_user',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function change the user status
	 */
	public function change_user_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->user_model->update_details(USERS,$newdata,$condition);
			$this->setErrorMessage('success','User Status Changed Successfully');
			redirect('admin/users/display_user_list');
		}
	}
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_user(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View User';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['user_details'] = $this->user_model->get_all_details(USERS,$condition);
			if ($this->data['user_details']->num_rows() == 1){
				$this->load->view('admin/users/view_user',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_user(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$user_id = $this->uri->segment(4,0);
			$group = $this->uri->segment(5,0);
			$condition = array('id' => $user_id);
			$condition1 = array('seller_id' => $user_id);
			
			$user_details = $this->user_model->get_all_details(USERS,$condition);
			
			if($group=='Seller')
			{
				//$this->seller_model->commonDelete(SELLER,$condition1);
				//$this->user_model->commonDelete(USERS,$condition);
			}else{

			//$this->user_model->commonDelete(USERS,$condition);
			}
			
			$this->user_model->update_details(USERS,array('status'=>'Deleted'),$condition);
			
			$this->setErrorMessage('success','User deleted successfully');
			redirect('admin/users/display_user_list');
			//redirect('wp_delete_user.php?un='.$user_details->row()->user_name);
		}
	}
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_user_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->user_model->activeInactiveCommon(USERS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','User records deleted successfully');
			}else {
				$this->setErrorMessage('success','User records status changed successfully');
			}
			redirect('admin/users/display_user_list');
		}
	}
	/**
	 * 
	 * This function sends mail to user to reopen the account
	 */
	 
	public function reopen_user(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$user_id=$this->input->get('user_id');
			$condition = array('id' => $user_id);			
			$pwd = mt_rand(100000,999999); 
			$user_details = $this->user_model->get_all_details(USERS,$condition);
			$this->user_model->update_details(USERS,array('status'=>'Active','password'=>md5($pwd)),$condition);
			
			$userName=$user_details->row()->user_name;
			
			$newsid='24';
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
							'to_mail_id'=>$user_details->row()->email,
							'subject_message'=>$template_values['news_subject'],
							'body_messages'=>$message
							);
			$email_send_to_common = $this->user_model->common_email_send($email_values);
			
			$this->setErrorMessage('success','User account reopened successfully!');
			
			redirect('wpconnect.php?un='.$user_details->row()->user_name.'&pd='.$pwd.'&em='.$user_details->row()->email.'&next=admin/users/edit_user_form/'.$user_id);
		}
		
	}
	
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */