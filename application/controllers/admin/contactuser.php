<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to payment gateway management
 * @author Teamtweaks
 *
 */

class Contactuser extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('contactseller_model');
		if ($this->checkPrivileges('contactseller',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the paygateway list
     */
   	public function index(){	
	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/contactuser/display_contact_user');
		}
	}
	
	/**
	 * 
	 * This function loads the Contact user list
	 */
	public function display_contact_user(){

		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Contact Seller';
			$condition = array();
			$this->data['ContactList'] = $this->contactseller_model->get_all_details(CONTACTUSER,$condition);
			$this->load->view('admin/contactuser/display_contact_user',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the edit gateway form
	 */
	public function view_contactuser_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Contact Seller Settings';
			$cont_Id = $this->uri->segment(4,0);
			$condition = array('id' => $cont_Id);
			$this->data['contact_user_status'] = $this->contactseller_model->get_all_details(CONTACTSELLER,$condition);
			if ($this->data['contact_user_status']->num_rows() == 1){
				$this->data['prodDetails'] = $this->contactseller_model->get_all_details(PRODUCT,array('id'=>$this->data['contact_user_status']->row()->product_id));
				$this->load->view('admin/contactuser/view_contact_user',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function change the contact user status
	 */
	public function change_contact_user_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if (!$this->data['demoserverChk']){
				$mode = $this->uri->segment(4,0);
				$gateway_id = $this->uri->segment(5,0);
				$status = ($mode == '0')?'Disable':'Enable';
				$newdata = array('status' => $status);
				$condition = array('id' => $gateway_id);
				$this->contactseller_model->update_details(PAYMENT_GATEWAY,$newdata,$condition);
				$this->contactseller_model->savePaymentSettings();
				$this->setErrorMessage('success','Payment Gateway Status Changed Successfully');
				redirect('admin/paygateway/display_gateway');
			}else {
				$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
				redirect('admin/paygateway/display_gateway');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user request records
	 */
	public function change_contact_user_status_global(){
		if (!$this->data['demoserverChk']){
			if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
				$this->contactseller_model->activeInactiveCommon(PAYMENT_GATEWAY,'id');
				$this->contactseller_model->savePaymentSettings();
				$this->setErrorMessage('success','Payment gateway records status changed successfully');
				redirect('admin/paygateway/display_gateway');
			}
		}else {
			$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
			redirect('admin/paygateway/display_gateway');
		}
	}
}

/* End of file contactuser.php */
/* Location: ./application/controllers/admin/contactuser.php */