<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to seller management
 * @author Teamtweaks
 *
 */

class Seller extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('seller_model','user_model'));
		if ($this->checkPrivileges('seller',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the seller requests page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/seller/display_seller_dashboard');
		}
	}
	
	/**
	 * 
	 * This function loads the sellers dashboard
	 */
	public function display_seller_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Sellers Dashboard';
			$condition = array('group'=>'Seller');
			$this->data['sellerList'] = $this->seller_model->get_all_details(USERS,$condition);
			
			$Query = "select p.sell_id,MAX(p.total) as topAmt,sum(p.quantity) as totQty, u.user_name,u.full_name from ".USER_PAYMENT." p 
						LEFT JOIN ".USERS." u on u.id=p.sell_id
						Where p.status='Paid'
						group by p.dealCodeNumber
						order by p.total+0 desc";
			$this->data['topSellDetails'] = $this->seller_model->ExecuteQuery($Query);
			$condition = array('request_status'=>'Pending','group'=>'User');
			$this->data['pendingList'] = $this->seller_model->get_all_details(USERS,$condition);
			$this->load->view('admin/seller/display_seller_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the seller requests page
	 */
	public function display_seller_requests(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Seller Requests';
			//$condition = array('status' => 'inactive');
			//$this->data['sellerRequests'] = $this->seller_model->get_all_details(SELLER,$condition);
			//echo '<pre>'; print_r($this->data['sellerRequests']); die;
			$this->data['sellerRequests'] = $this->seller_model->display_seller_list_request_view($condition);
			
			$this->load->view('admin/seller/display_seller_requests',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the sellers list page
	 */
	public function display_seller_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Seller List';

			$usersCount = $this->seller_model->get_total_seller_count();
			#echo '<pre>'; print_r($usersCount);die;
			
			if($usersCount > 1000){			
				$searchPerPage = 50;
				$paginationNo = $this->uri->segment(4);  
				if($paginationNo == ''){
					$paginationNo = 0;
				} else {
					$paginationNo = $paginationNo;
				}
				
				$this->data['sellersList'] = $this->seller_model->display_seller_list_view($paginationNo,$searchPerPage);
				//echo $this->db->last_query(); echo '<pre>'; print_r($this->data['sellersList']);die;
				
				$searchbaseUrl = 'admin/seller/display_seller_list/';
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
				$this->pagination->initialize($config);
				$paginationLink = $this->pagination->create_links(); 
				$this->data['paginationLink'] = $paginationLink;
				
				$this->load->view('admin/seller/display_sellerlist_pagination',$this->data);
				
			} else {
				$condition = array('group'=>'Seller');
				$this->data['sellersList'] = $this->seller_model->display_seller_list_view();
				
				//echo $this->db->last_query(); die;
				$this->load->view('admin/seller/display_sellerlist',$this->data);
			}
		}
	}
	
	/**
	 * 
	 * This function insert and edit a seller
	 */
	public function insertEditSeller(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$seller_id = $this->input->post('seller_id');
			$excludeArr = array("seller_id");
			$paymethod = $this->seller_model->get_all_details(SELLER,array('seller_id'=>$seller_id))->row()->payment_mode;
			$payment_mode = explode(',',$paymethod);
			//$payment_mode[(count($payment_mode))] = 'COD';
			if($this->input->post('paypal_email') != ""){
				if(!(in_array('PayPal Adaptive',$payment_mode))){
					$payment_mode[(count($payment_mode))] = 'PayPal Adaptive';
					
				}
			}
			
			$payment_mode = implode(',',$payment_mode);
			$payment_mode1 = explode(',',$payment_mode);
			if($this->input->post('cod_available') == 'Yes'){
				if(!(in_array('COD',$payment_mode1))){
					$payment_mode1[(count($payment_mode1))] = 'COD';
				}
			}
			$payment_mode = implode(',',$payment_mode1);
			//echo "<pre>";print_r($this->input->post());die;
			if ($seller_id == ''){
				$this->setErrorMessage('success','Seller added successfully');
			}else {
				$dataArr = array('payment_mode'=>$payment_mode,'Paypal_merchant_email'=>$this->input->post('paypal_email') );
				$this->seller_model->update_details(SELLER,$dataArr,array('seller_id'=>$seller_id));
				$dataArr = array();
				$condition = array('id' => $seller_id);
				$this->seller_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Seller updated successfully');
			}
			redirect('admin/seller/display_seller_list');
		}
	}
	
	/*public SetErrorSeller()
	{
	if ($this->checkLogin('A') == ''){
			redirect('admin');
		}
		else
		{
		$status = $this->input->post('seller_id');
		}
	}*/
	
	/**
	 * 
	 * This function change the seller request status
	 */
	public function change_seller_request(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
				
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$seller_id = $this->uri->segment(6,0);
			$status = ($mode == '0')?'Rejected':'Approved';
			$newdata = array('request_status' => $status);
			if ($status == 'Rejected'){
				$newdata['group'] = 'User';
				$condition = array('id' => $user_id);
				$condition1 = array('id' => $seller_id);
			$this->seller_model->commonDelete(SELLER,$condition1); 
			$this->seller_model->update_details(USERS,$newdata,$condition);
			
/******** Send Mail for Reject Seller Account ***************/

			$this->data['sellerList'] = $this->seller_model->get_all_details(USERS,$condition);
			$MyVal = $this->data['sellerList']->result_array();
			$user_email_id = $MyVal[0]['email'];
			$userName = $MyVal[0]['full_name'];
			
			$newsid='17';
			$template_values=$this->user_model->get_newsletter_template_details($newsid);
			$admin_email = $template_values['sender_email'];
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
			
		if($template_values['sender_name']=='' && $admin_email==''){
			$sender_email=$this->config->item('site_contact_mail');
			
			$sender_name=$this->config->item('email_title');
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$admin_email;
		}
		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$user_email_id,
							'subject_message'=>'Request for reopen account',
							'body_messages'=>$message
							);
		$email_send_to_common = $this->product_model->common_email_send($email_values);
			
/******** Send Mail for Reject Seller Account ***************/
			
			}else if ($status == 'Approved'){
				$newdata['group'] = 'Seller';
				$newdata1['status'] = 'active';
			$condition = array('id' => $seller_id);
			$condition1 = array('id' => $user_id);
			$this->seller_model->update_details(USERS,$newdata,$condition);
			$this->seller_model->update_details(SELLER,$newdata1,$condition1);
			$this->setErrorMessage('success','Seller Request '.$status.' Successfully');
			}
			
			$this->setErrorMessage('success','Seller Request '.$status.' Successfully');
			redirect('admin/seller/display_seller_requests');
		}
	}
	
	/**
	 * 
	 * This function change the seller status
	 */
	public function change_seller_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			echo $mode; die;
			$status = ($mode == '0')?'Rejected':'Approved';
			$newdata = array('request_status' => $status);
			if ($status == 'Rejected'){
				$newdata['group'] = 'User';
			}else if ($status == 'Approved'){
				$newdata['group'] = 'Seller';
			}
			$condition = array('id' => $user_id);
			$this->seller_model->update_details(USERS,$newdata,$condition);
			
			$this->setErrorMessage('success','Seller Status Changed Successfully');
			redirect('admin/seller/display_seller_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit seller form
	 */
	public function edit_seller_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Seller';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['seller_details'] = $this->seller_model->get_all_details(USERS,$condition);
			$this->data['seller_paypal_id'] = $this->seller_model->get_all_details(SELLER,array('seller_id'=>$user_id))->row()->Paypal_merchant_email;
			$this->data['seller_payment_mode'] = $this->seller_model->get_all_details(SELLER,array('seller_id'=>$user_id))->row()->payment_mode;
			if ($this->data['seller_details']->num_rows() == 1 && $this->data['seller_details']->row()->group == 'Seller'){
				$this->load->view('admin/seller/edit_seller',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function loads the seller view page
	 */
	public function view_seller(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Seller';
			$seller_id = $this->uri->segment(4,0);
			$this->data['seller_details'] = $this->seller_model->display_seller_view_admin($seller_id);
			#echo "<pre>";print_r($this->data['seller_details']);die;
			if (count($this->data['seller_details'])== 1){
				$this->load->view('admin/seller/view_seller',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the seller record from db
	 */
	public function delete_seller(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$seller_id = $this->uri->segment(4,0);
			//$condition = array('id' => $seller_id);
			$condition1 = array('seller_id' => $seller_id);

			$this->user_model->update_details(USERS,array('group'=>'User'),array('id'=>$seller_id));
			$this->seller_model->commonDelete(SELLER,$condition1);
			
			$this->user_model->update_details(PRODUCT,array('status'=>'Deleted'),array('user_id'=>$seller_id));
			
			$this->setErrorMessage('success','Seller deleted successfully');
			redirect('admin/seller/display_seller_list');
		}
	}
	
	/**
	 * 
	 * This function delete the seller request records
	 */
	public function change_seller_status_global(){
	
	//print_r("dfg"); die;
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->seller_model->activeInactiveCommon(USERS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Seller records deleted successfully');
			}else {
				$this->setErrorMessage('success','Seller records status changed successfully');
			}
			redirect('admin/seller/display_seller_list');
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
			#echo $mode;
			$status = ($mode == '0')?'inactive':'active';

			$group = ($mode == '0')?'User':'Seller';
			$newdata = array('group' => $group);
			$condition = array('id' => $user_id);
			#echo "<pre>";print_r($newdata);die;
			$this->seller_model->update_details(USERS,$newdata,$condition);
			#echo $this->db->last_query();
			$newdata = array('status' => $status);
			$condition = array('seller_id' => $user_id);
			#echo "<pre>";print_r($newdata);die;
			$this->seller_model->update_details(SELLER,$newdata,$condition);			
			$this->setErrorMessage('success','Seller Status Changed Successfully');
			redirect('admin/seller/display_seller_list');
		}
	}
	/**
	 * 
	 * This function update the Refund amount in db
	 */
	public function update_refund(){
		if ($this->checkLogin('A') != ''){
			$uid = $this->input->post('uid');
			$refund_amount = $this->input->post('amt');
		
			if ($uid != ''){
				$this->seller_model->update_details(USERS,array('refund_amount'=>$refund_amount),array('id'=>$uid));
			}
		}
	}
	/**
	 * 
	 * This function update the cod amount in db
	 */
	public function update_cod(){
		if ($this->checkLogin('A') != ''){
			$uid = $this->input->post('uid');
			$cod_amount = $this->input->post('amt');
			if ($uid != ''){
				$dataArr=array('dateAdded'=>date('Y-m-d H:i:s'),
											'seller_id'=>$uid,
											'amount'=>$cod_amount);
				$this->seller_model->simple_insert(COD_PAYMENT,$dataArr);
			}
		}
	}
	
	function change_promoteseller(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
	
			$mode = $this->uri->segment(4,0);
			$seller_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Unpromote':'Promote';
			$newdata = array('seller_promote' => $status);
			$condition = array('seller_id' => $seller_id);
			$this->seller_model->update_details(SELLER,$newdata,$condition);
			$this->setErrorMessage('success','Seller Promote Status Changed Successfully');
			redirect('admin/seller/display_seller_list');
				
	
		}
	}
	
}

/* End of file seller.php */
/* Location: ./application/controllers/admin/seller.php */